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

            //Switch tab
            $('.tab-nav.config a[href="#course-tab"]').trigger('click');
        });

        //?Cancel editing
        $(document).on('click','form.js-course button[type="reset"]',event => {
            let form = $('form.js-course');
            if($(form).hasClass('edit-action')){
                $(form).find('[name="course_code"]').prop('disabled',false);
                $(form).removeClass('edit-action').addClass('add-action');
                $(form).closest('.card').find('.card-header#course>h4').text('ADD COURSE').addClass('c-cyan').removeClass('c-red');
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
                text: "This and associated units record will be deleted permanently.",   
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
        
    }

    var reloadCourseList = () => {
        let target = window.location.pathname;
        $('#course-list').load(target+' #course-list');
    }

    //?Unit
    var initUnit = () => {
        //?Validator
        let unitValidator = $('form.js-unit').validate({
            rules: {
                'unit_code': {
                    required:true,
                    remote: {
                        url: $('#check_unit_code').val(),
                        type: "POST",
                        data: { 
                            unit_code : () => { return $('form.js-unit input[name="unit_code"]').val();},
                        },
                        dataType: 'json'
                    }
                },
                'unit_name': {
                    required: true,
                    remote: {
                        url: $('#check_unit_name').val(),
                        type: "POST",
                        data: { 
                            unit_name : () => { return $('form.js-unit input[name="unit_name"]').val();},
                            course_code : () => { return $('form.js-unit [name="course_code"]').val();},
                        },
                        dataType: 'json'
                    }
                },
                'exam_duration': {
                    required: true,
                    remote: {
                        url: $('#check_duration').val(),
                        type: "POST",
                        data: { 
                            exam_duration : () => { return $('form.js-unit input[name="exam_duration"]').val();},
                        },
                        dataType: 'json'
                    }
                }
            },
            messages:{
                'unit_code':{
                    remote: "Code already exists"
                },
                'unit_name':{
                    remote:'Unit already registered'
                },
                'exam_duration':{
                    remote:"Enter valid duration(02:00) below 4 hours"
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
        $('#course-list').on('click','.edit-unit',event => {
            let _this = event.target;
            $(_this).closest('.actions').removeClass('open');
            let form = $('form.js-unit');
            $(form).removeClass('add-action').addClass('edit-action');
            $(form).closest('.card').find('.card-header#unit>h4').text('EDIT UNIT DETAILS').addClass('c-red').removeClass('c-cyan');
            $(form).find('button[type="submit"]').text('SAVE CHANGES');

            let code = $(_this).closest('.dropdown-menu').data('code');
            let name = $(_this).closest('.dropdown-menu').data('name');
            let course = $(_this).closest('.dropdown-menu').data('course');
            let duration = () => {
                let dur_str = $(_this).closest('.dropdown-menu').data('duration');
                let mins = dur_str*60;
                let h = Math.floor(mins/60);
                let m = mins%60;
                if(m==0){
                    return h+":00";
                }
                return h+":"+m;
            };
            let year_group = $(_this).closest('.dropdown-menu').data('year');

            $(form).find('[name="unit_code"]').val(code).prop('disabled',true);
            $(form).find('[name="unit_code_edit"]').val(code);
            $(form).find('[name="unit_name"]').val(name);
            $(form).find('[name="course_code"]').val(course);
            $(form).find('[name="exam_duration"]').val(duration);
            $(form).find('[name="year_group"]').val(year_group);

            $(form).find('[name="unit_code"]').rules('remove','remote');
            $(form).find('[name="unit_name"]').rules('remove','remote');
            $(form).find('[name="unit_name"]').rules('add',{
                required:true,
                remote: {
                    url: $('#check_unit_name_edit').val(),
                    type: "POST",
                    data: { 
                        unit_code : () => { return $('form.js-course input[name="unit_code"]').val();},
                        unit_name : () => { return $('form.js-course [name="unit"]').val();},
                        course_code : () => { return $('form.js-course [name="course_code"]').val();},
                    },
                    dataType: 'json'
                }
            });

            //Switch tab
            $('.tab-nav.config a[href="#unit-tab"').trigger('click');
        });

        //?Cancel editing
        $(document).on('click','form.js-unit button[type="reset"]',event => {
            let form = $('form.js-unit');
            if($(form).hasClass('edit-action')){
                $(form).find('[name="unit_code"]').prop('disabled',false);
                $(form).removeClass('edit-action').addClass('add-action');
                $(form).closest('.card').find('.card-header#unit>h4').text('ADD UNIT').addClass('c-cyan').removeClass('c-red');
                $(form).find('button[type="submit"]').text('ADD UNIT');
            }

            //Reset validator
            unitValidator.resetForm();
            $(form).find('.help-block, .form-group').removeClass('has-error');     
        });

        //?Delete
        $('#course-list').on('click','.delete-unit',event => {
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
                    ajaxComm(target,{unit_code: code},"json")
                    .done(data => {
                        notify(data.icon,data.type,data.message);
                        reloadCourseList();
                    });
                }    
            });
        });

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