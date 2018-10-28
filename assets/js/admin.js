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

        $(role).on('change', function () {
            if ($(role).val() == "2") {
                $(faculty).fadeIn();
            } else {
                $(faculty).fadeOut();
            }    
        });
    }

    return {
        init: () => {
            $('form label').addClass('c-teal');
            $('form input.form-control').attr('autocomplete','off');
            facultyRepHelper();
            errorHelper();
        }
    }
}();

/**
 * !Institution
 */
var initInstitution = function(){
    //?Faculty
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

    //?Invigilators
    var initInvigilators = () => {
        //TODO: Validator setup
        
        //?Form submit
        $('form.js-invigilator').on('submit',event=>{
            event.preventDefault();
            let _this = event.target;
            let target;
            let dataSend = $(_this).serializeArray();

            if($(_this).hasClass('add-action')){
                target = $(_this).data('add-action');                
            }else if($(_this).hasClass('edit-action')){
                target = $(_this).data('edit-action');                
            }
            
            ajaxComm(target,dataSend,"json")
            .done(data => {
                notify(data.icon,data.type,data.message);
                $('form.js-invigilator button[type="reset"]').trigger('click');
                reloadInvigilators();
            });
        });

        //?Edit event for invigilator
        $('#invigilator-list').on('click','.edit-invigilator',event=>{
            let _this = event.target;
            $(_this).closest('.actions').removeClass('open');
            let form = $('form.js-invigilator');
            $(form).removeClass('add-action').addClass('edit-action');
            $(form).closest('.card').find('.card-header>h2').text('EDIT INVIGILATOR DETAILS').addClass('c-red');
            $(form).find('button[type="submit"]').text('SAVE CHANGES');

            let fname = $(_this).closest('.dropdown-menu').data('fname');
            let lname = $(_this).closest('.dropdown-menu').data('lname');
            let faculty = $(_this).closest('.dropdown-menu').data('faculty-code');
            let status = $(_this).closest('.dropdown-menu').data('status');
            let id = $(_this).closest('.dropdown-menu').data('id');

            $(form).find('[name="first_name"]').val(fname);
            $(form).find('[name="last_name"]').val(lname);
            $(form).find('[name="faculty_code"]').val(faculty);
            $(form).find('[name="status"]').prop('checked',status);
            $(form).find('[name="id"]').val(id);
        });

        //?Cancel editing
        $(document).on('click','form.js-invigilator button[type="reset"]',event => {
            let form = $('form.js-invigilator');
            if($(form).hasClass('edit-action')){
                $(form).removeClass('edit-action').addClass('add-action');
                $(form).closest('.card').find('.card-header>h2').text('ADD INVIGILATOR').removeClass('c-red');
                $(form).find('button[type="submit"]').text('ADD INVIGILATOR');
            }
        });

        //?Delete invigilator
        $('#invigilator-list').on('click','.delete-invigilator',event=>{
            let _this = event.target;
            $(_this).closest('.actions').removeClass('open');
            let id = $(_this).closest('.dropdown-menu').data('id');
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
                    ajaxComm(target,{id: id},"json")
                    .done(data => {
                        notify(data.icon,data.type,data.message);
                        reloadInvigilators();
                    });
                }    
            });
        });

        var reloadInvigilators = () => {
            let target = window.location.pathname;
            $('#invigilator-list').load(target+' #invigilator-list');
        }

        //?Search
        $("#search-invigilators").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#invigilator-list .invi-item ").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        
    }

    //?Course types
    var initCourseType = () => {
        //?Validator setup
        var courseTypeValidator = $('form.js-coursetype').validate({
            rules:{
                "type_name":{
                    required: true,
                    remote: {
                        url: $('#check_typename_url').val(),
                        type: "POST",
                        data: { 
                            type_name : () => { return $('form.js-coursetype input[name="type_name"]').val();},
                        },
                        dataType: 'json'
                    }
                }
            },
            messages:{
                "type_name":{
                    remote: "Name is already taken"
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
                    reloadCourseTypeList();
                });
            }
        });

        //?Editing
        $('#coursetype-list').on('click','.edit-coursetype',event => {
            let _this = event.target;
            $(_this).closest('.actions').removeClass('open');
            let form = $('form.js-coursetype');
            $(form).removeClass('add-action').addClass('edit-action');
            $(form).closest('.card').find('.card-header>h2').text('EDIT COURSE TYPE DETAILS');
            $(form).find('button[type="submit"]').text('SAVE CHANGES');

            let id = $(_this).closest('.dropdown-menu').data('id');
            let name = $(_this).closest('.dropdown-menu').data('name');

            $(form).find('[name="id"]').val(id);
            $(form).find('[name="type_name"]').val(name);
            
            $(form).find('[name="type_name"]').rules('remove','remote');
            $(form).find('[name="type_name"]').rules('add',{
                required:true,
                remote: {
                    url: $('#check_typename_edit_url').val(),
                    type: "POST",
                    data: { 
                        id: $('form.js-coursetype input[name="id"]').val(),
                        type_name : () => { return $('form.js-coursetype input[name="type_name"]').val();}
                    },
                    dataType: 'json'
                }
            });
        });

        //?Cancel editing
        $(document).on('click','form.js-coursetype button[type="reset"]',event => {
            let form = $('form.js-coursetype');
            if($(form).hasClass('edit-action')){
                $(form).removeClass('edit-action').addClass('add-action');
                $(form).closest('.card').find('.card-header>h2').text('ADD TYPE');
                $(form).find('button[type="submit"]').text('ADD TYPE');
            }

            //Reset validator
            courseTypeValidator.resetForm();
            $(form).find('.help-block, .form-group').removeClass('has-error');
        });

        //?Deleting
        $('#coursetype-list').on('click','.delete-coursetype',event => {
            let _this = event.target;
            $(_this).closest('.actions').removeClass('open');
            let id = $(_this).closest('.dropdown-menu').data('id');
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
                    ajaxComm(target,{id: id},"json")
                    .done(data => {
                        notify(data.icon,data.type,data.message);
                        reloadCourseTypeList();
                    });
                }    
            });
        });

        var reloadCourseTypeList = () => {
            let target = window.location.pathname;
            $('#coursetype-list').load(target+' #coursetype-list');
        }
    }

    //?Intakes
    var initIntakes = () => {
        //?Validator
        var intakeValidator = $('form.js-intake').validate({
            rules:{
                "name" : {
                    required:true,
                    remote:{
                        url: $('#check_intake_url').val(),
                        type: "POST",
                        data: { 
                            name : () => { return $('form.js-intake input[name="name"]').val() },
                            course_type :() => {return $('form.js-intake select[name="course_type"]').val() }
                        },
                        dataType: 'json'
                    }
                }
            },
            messages:{
                "name": {
                    remote: "Intake combination already exists"
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
                    reloadIntakeList();
                });
            }
        });

        //?Editing
        $('#intake-list').on('click','.edit-intake',event => {
            let _this = event.target;
            $(_this).closest('.actions').removeClass('open');
            let form = $('form.js-intake');
            $(form).removeClass('add-action').addClass('edit-action');
            $(form).closest('.card').find('.card-header>h2').text('EDIT INTAKE DETAILS');
            $(form).find('button[type="submit"]').text('SAVE CHANGES');

            let id = $(_this).closest('.dropdown-menu').data('id');
            let name = $(_this).closest('.dropdown-menu').data('name');
            let course_type = $(_this).closest('.dropdown-menu').data('coursetype');

            $(form).find('[name="id"]').val(id);
            $(form).find('[name="name"]').val(name);
            $(form).find('[name="course_type"]').val(course_type);
            
            $(form).find('[name="name"]').rules('remove','remote');
            $(form).find('[name="name"]').rules('add',{
                required:true,
                remote: {
                    url: $('#check_intake_edit_url').val(),
                    type: "POST",
                    data: { 
                        id: $('form.js-intake input[name="id"]').val(),
                        name : () => {return $('form.js-intake input[name="name"]').val() },
                        course_type: () => {return $('form.js-intake select[name="course_type"]').val() },
                    },
                    dataType: 'json'
                }
            });
        });

        //?Cancel editing
        $(document).on('click','form.js-intake button[type="reset"]',event => {
            let form = $('form.js-intake');
            if($(form).hasClass('edit-action')){
                $(form).removeClass('edit-action').addClass('add-action');
                $(form).closest('.card').find('.card-header>h2').text('ADD INTAKE');
                $(form).find('button[type="submit"]').text('ADD INTAKE');
            }

            //Reset validator
            intakeValidator.resetForm();
            $(form).find('.help-block, .form-group').removeClass('has-error');
        });

        //?Deleting
        $('#intake-list').on('click','.delete-intake',event => {
            let _this = event.target;
            $(_this).closest('.actions').removeClass('open');
            let id = $(_this).closest('.dropdown-menu').data('id');
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
                    ajaxComm(target,{id: id},"json")
                    .done(data => {
                        notify(data.icon,data.type,data.message);
                        reloadIntakeList();
                    });
                }    
            });
        });

        var reloadIntakeList = () => {
            let target = window.location.pathname;
            $('#intake-list').load(target+' #intake-list');
        }
    }


    return {
        init: () => {
            $('form label').addClass('c-cyan');
            initFaculty();
            initInvigilators();
            initCourseType();
            initIntakes();
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