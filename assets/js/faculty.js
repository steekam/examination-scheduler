//?Home tab
var initHome = function (){

    //?Course
    var initCourse = () =>{
        //?Validator
        let courseValidator = $('form.js-course').validate({
            rules: {
                'course_code':{
                    required: true,
                    remote:{
                        url: $('#check_course_code').val(),
                        type: "POST",
                        data: { 
                            course_code : () => { return $('form.js-course input[name="course_code"]').val();},
                        },
                        dataType: 'json'
                    }
                },
                'course_name': {
                    required: true,
                    remote:{
                        url: $('#check_course_name').val(),
                        type: "POST",
                        data: { 
                            course_name : () => { return $('form.js-course input[name="course_name"]').val();},
                        },
                        dataType: 'json'
                    }
                }
            },
            messages: {
                'course_code': {
                    remote: "Code already exists"
                },
                'course_name': {
                    remote: "Course name already exists"
                }

            },
            submitHandler: form => {
                let target;
                let dataSend = $(form).serializeArray();

                if($(form).hasClass('add-action')){
                    target = $(form).data('add-action');
                }else if($(form).hasClass('edit-action')){
                    target = $(form).data('edit-action');
                }
                ajaxComm(target,dataSend,"json")
                .done(data => {
                    notify(data.icon,data.type,data.message);
                    $(form).find('button[type="reset"]').trigger('click');
                    reloadCourseList();
                });
            }
        });

        //?Edit event for faculty details
        $('#course-list').on('click','.edit-course',event => {
            let _this = event.target;
            $(_this).closest('.actions').removeClass('open');
            let form = $('form.js-course');
            $(form).removeClass('add-action').addClass('edit-action');
            $(form).closest('.card').find('.card-header#course>h4').text('EDIT COURSE DETAILS').addClass('c-red').removeClass('c-cyan');
            $(form).find('button[type="submit"]').text('SAVE CHANGES');

            let code = $(_this).closest('.dropdown-menu').data('code');
            let name = $(_this).closest('.dropdown-menu').data('name');
            let type = $(_this).closest('.dropdown-menu').data('type');
            $(form).find('[name="course_code"]').val(code).prop('disabled',true);
            $(form).find('[name="course_code_edit"]').val(code);
            $(form).find('[name="course_name"]').val(name);
            $(form).find('[name="course_type"]').val(type);
            $(form).find('[name="course_code"]').rules('remove','remote');
            $(form).find('[name="course_name"]').rules('add',{
                required:true,
                remote: {
                    url: $('#check_course_name_edit').val(),
                    type: "POST",
                    data: { 
                        course_code : () => { return $('form.js-course input[name="course_code"]').val();},
                        course_name : () => { return $('form.js-course input[name="course_name"]').val();},
                        course_type : () => { return $('form.js-course [name="course_type"]').val();},
                    },
                    dataType: 'json'
                }
            });
        });

        //?Cancel editing
        $(document).on('click','form.js-course button[type="reset"]',event => {
            let form = $('form.js-course');
            if($(form).hasClass('edit-action')){
                $(form).find('[name="course_code"]').prop('disabled',false);
                $(form).removeClass('edit-action').addClass('add-action');
                $(form).closest('.card').find('.card-header>h4').text('ADD COURSE').addClass('c-cyan').removeClass('c-red');
                $(form).find('button[type="submit"]').text('ADD COURSE');
            }

            //Reset validator
            courseValidator.resetForm();
            $(form).find('.help-block, .form-group').removeClass('has-error');     
        });

        //?Delete
        $('#course-list').on('click','.delete-course',event => {
            let _this = event.target;
            $(_this).closest('.actions').removeClass('open');

            let code = $(_this).closest('.dropdown-menu').data('code');
            let target = $(_this).closest('.dropdown-menu').data('delete-target');

            const deleteSwal = mySwal();
            deleteSwal({   
                title: "Are you sure?",   
                text: "This record will be deleted permanently",   
                type: "warning",       
                confirmButtonText: "Yes, delete!",
            })
            .then((result)=>{
                if(result.value){
                    ajaxComm(target,{course_code: code},"json")
                    .done(data => {
                        notify(data.icon,data.type,data.message);
                        reloadCourseList();
                    });
                }    
            });
        });
        
        var reloadCourseList = () => {
            let target = window.location.pathname;
            $('#course-list').load(target+' #course-list');
        }
    }


    //?Unit
    var initUnit = () => {

    }

    return{
        init: () => {
            $('form label').addClass('c-cyan').addClass('f-15');
            initCourse();
            initUnit();
        }
    }
}();


$(document).ready( () => {
    $('form input.form-control').attr('autocomplete','off');
    let page = window.location.pathname;
    if(page.includes('faculty/examination')){

    }else if(page.includes('faculty')){
        initHome.init();
    }
} );