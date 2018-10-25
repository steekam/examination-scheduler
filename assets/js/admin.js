initDefaultValidator();

/**
 * !User  register page
 * Register user page handler
 */
var initRegisterUser = function (){
    /**
     * Function with custom event for the error-checking event in the forms to add the error classes 
     * Add has-error class to form-group for fields with errors
     * This function is loaded by default in all pages
     */
    var errorHelper = () => {
        //Add has-error class if there is an error
        const errorBlock = document.querySelectorAll('.form-group .help-block');
        
        //Custom event
        let event = new CustomEvent('formError', {
            bubbles: true,
        });
        
        //Listen for event
        errorBlock.forEach(element => {
            element.addEventListener('formError', function (e) {
                const block = e.currentTarget;
                if ($(block).text() !== "") {
                    $(block).parent().parent().addClass('has-error');
                }
            }, false);
            //Dispatch event
            element.dispatchEvent(event);
        });
    }

    /*
    **  Faculty representative helper
    **  Reveals a faculty dropdown if the role of added user is a faculty representative
    **  
    */
    var facultyRepHelper = () => {
        let role = $('select[name="role"]');
        let faculty = $('#faculty-select');
    
        if ($(role).value == "2") {
            $(faculty).show();
        } else {
            $(faculty).hide();
        }
        role.addEventListener('change', function () {
            var faculty = document.querySelector('#faculty-select');
            if ($(role).value == "2") {
                $(faculty).show();
            } else {
                $(faculty).hide();
            }    
        });
    }

    return {
        init: () => {
            facultyRepHelper();
            errorHelper();
        }
    }
}();

/**
 * !Institution
 */
var initInstitution = function(){
    
    var initFaculty = () => {
        //?Faculty Validator setup
        var facultyValidator = $('form.js-faculty').validate({
            rules: {
                "faculty_code": {
                    required: true,
                    remote: {
                        url: $('#check_code_url').val(),
                        type: "POST",
                        data: { 
                            code : () => { return $('form.js-faculty input[name="faculty_code"]').val();},
                        },
                        dataType: 'json'
                    }
                },
                "faculty_name": {
                    required: true,
                    remote: {
                        url: $('#check_name_url').val(),
                        type: "POST",
                        data: { 
                            name : () => { return $('form.js-faculty input[name="faculty_name"]').val();},
                        },
                        dataType: 'json'
                    }
                }

            },
            messages: {
                "faculty_code": {
                    remote: "Faculty code already exists"
                },
                "faculty_name": {
                    remote: "Faculty name already exists"
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
                    reloadFacultyList();
                });
            }
        });

        //?Edit event for faculty details
        $('#faculty-list').on('click','.edit-faculty',event => {
            let _this = event.target;
            let form = $('form.js-faculty');
            $(form).removeClass('add-action').addClass('edit-action');
            $(form).closest('.card').find('.card-header>h2').text('EDIT FACULTY DETAILS');
            $(form).find('button[type="submit"]').text('SAVE CHANGES');

            let code = $(_this).closest('.dropdown-menu').data('code');
            let name = $(_this).closest('.dropdown-menu').data('name');
            $(form).find('[name="faculty_code"]').val(code).prop('disabled',true)
            $(form).find('[name="faculty_code"]').rules('remove','remote');
            $(form).find('[name="faculty_code"]').rules('add',{
                required:true,
                remote: {
                    url: $('#check_code_edit_url').val(),
                    type: "POST",
                    data: { 
                        code : () => { return $('form.js-faculty input[name="faculty_code"]').val();},
                    },
                    dataType: 'json'
                }
            });
            
            $(form).find('[name="faculty_name"]').val(name);
            $(form).find('[name="faculty_name"]').rules('remove','remote');
            $(form).find('[name="faculty_name"]').rules('add',{
                required:true,
                remote: {
                    url: $('#check_name_edit_url').val(),
                    type: "POST",
                    data: { 
                        code : () => { return $('form.js-faculty input[name="faculty_code"]').val();},
                        name : () => { return $('form.js-faculty input[name="faculty_name"]').val();},
                    },
                    dataType: 'json'
                }
            });
        });

        //?Cancel editing
        $(document).on('click','form.js-faculty button[type="reset"]',event => {
            let form = $('form.js-faculty');
            if($(form).hasClass('edit-action')){
                $(form).find('[name="faculty_code"]').prop('disabled',false);
                $(form).removeClass('edit-action').addClass('add-action');
                $(form).closest('.card').find('.card-header>h2').text('ADD DETAILS');
                $(form).find('button[type="submit"]').text('ADD FACULTY');
            }

            //Reset validator
            facultyValidator.resetForm();
            $(form).find('.help-block, .form-group').removeClass('has-error');     
        });

        //?Delete
        $('#faculty-list').on('click','.delete-faculty',event => {
            let _this = event.target;
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
                    ajaxComm(target,{faculty_code: code},"json")
                    .done(data => {
                        notify(data.icon,data.type,data.message);
                        reloadFacultyList();
                    });
                }    
            });
        });
        
        var reloadFacultyList = () => {
            let target = window.location.pathname;
            $('#faculty-list').load(target+' #faculty-list');
        }
    }


    return {
        init: () => {
            initFaculty();
        }
    }
}();

$(document).ready( () => {
    let page = window.location.pathname;
    if(page.includes('admin/register_user')){
        initRegisterUser.init();
    }else if(page.includes('admin/institution')){
        initInstitution.init();
    }
} );