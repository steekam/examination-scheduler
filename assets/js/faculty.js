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
        //Select 2 for the tags
        $('.js-select2-units').select2({
            placeholder: 'Select 2 tags',
            dropdownCssClass: 'select2-opt',
            containerCssClass: 'form-control',
            maximumSelectionLength: 2,
            allowClear: true
        });

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

        //?Edit
        $('#course-list').on('click','.edit-unit',event => {
            let _this = event.target;
            $(_this).closest('.actions').removeClass('open');
            let form = $('form.js-unit');
            $(form).removeClass('add-action').addClass('edit-action');
            $(form).closest('.card').find('.card-header#unit>h4').text('EDIT UNIT DETAILS').addClass('c-red').removeClass('c-cyan');
            $(form).find('button[type="submit"]').text('SAVE CHANGES');

            let unit = $(_this).closest('.dropdown-menu').data('unit');
            let tags = $(_this).closest('.dropdown-menu').data('tags');

            let code = unit.unit_code;
            let name = unit.name;
            let course = unit.course_code;
            let duration = () => {
                let dur_str = unit.exam_duration;
                let mins = dur_str*60;
                let h = Math.floor(mins/60);
                let m = mins%60;
                if(m==0){
                    return h+":00";
                }
                return h+":"+m;
            };
            let pref_invigilator = unit.pref_invigilator;

            $(form).find('[name="unit_code"]').val(code).prop('disabled',true);
            $(form).find('[name="unit_code_edit"]').val(code);
            $(form).find('[name="unit_name"]').val(name);
            $(form).find('[name="course_code"]').val(course);
            $(form).find('[name="exam_duration"]').val(duration);
            $(form).find('[name="pref_invigilator"]').val(pref_invigilator);

            if(tags.length !== 0){
                $(form).find('[name="unit_tags[]"]').val([tags[0].tag_id,tags[1].tag_id]).trigger('change');
            }else{
                $('.js-select2-units').val(' ').trigger('change');
            }

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

            //Reset select2
            $('.js-select2-units').val(' ').trigger('change');

            //Reset validator
            unitValidator.resetForm();
            $(form).find('.help-block, .form-group').removeClass('has-error');     
        });

        //?Delete
        $('#course-list').on('click','.delete-unit',event => {
            let _this = event.target;
            $(_this).closest('.actions').removeClass('open');

            let code = $(_this).closest('.dropdown-menu').data('unit').unit_code;
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

    //?Student groups
    var initStudentGroups = () => {
        //?Validator
        let studentsValidator = $('form.js-students').validate({
            rules: {
                'group_name':{
                    required: true,
                    remote: {
                        url: $('#check_group_name').val(),
                        type: "POST",
                        data: { 
                            group_name : () => { return $('form.js-students input[name="group_name"]').val();},
                            course_code : () => { return $('form.js-students [name="course_code"]').val();},
                            intake_id : () => { return $('form.js-students [name="intake_id"]').val();},
                        },
                        dataType: 'json'
                    }
                }
            },
            messages: {
                'group_name': {
                    remote: "Group already exists"
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
                    reloadGroupsList();
                });
            }
        });

        var reloadGroupsList = () => {
            let target = window.location.pathname;
            $('#student-group-list').load(target+' #student-group-list');
        }

        //?Edit event for faculty details
        $('#student-group-list').on('click','.edit-group',event => {
            let _this = event.target;
            $(_this).closest('.actions').removeClass('open');
            let form = $('form.js-students');
            $(form).removeClass('add-action').addClass('edit-action');
            $(form).closest('.card').find('.card-header#right>h2').text('EDIT GROUP DETAILS').addClass('c-red').removeClass('c-teal');
            $(form).find('button[type="submit"]').text('SAVE CHANGES');

            let group = $(_this).closest('.dropdown-menu').data('group');
            let group_id = group.group_id;
            let group_name = group.name;
            let group_size = group.size;
            let course_code = group.course_code;
            let intake_id = group.intake_id;
            
            let tag = $(_this).closest('.dropdown-menu').data('tag');
            let student_tag = tag[0].tag_id;
            
            $(form).find('[name="group_id"]').val(group_id);
            $(form).find('[name="group_name"]').val(group_name);
            $(form).find('[name="group_size"]').val(group_size);
            $(form).find('[name="course_code"]').val(course_code);
            $(form).find('[name="intake_id"]').val(intake_id);
            $(form).find('[name="student_tag"]').val(student_tag);

            $(form).find('[name="group_name"]').rules('remove','remote');
            $(form).find('[name="group_name"]').rules('add',{
                required:true,
                remote: {
                    url: $('#check_group_name_edit').val(),
                    type: "POST",
                    data: { 
                        group_id : () => { return $('form.js-students input[name="group_id"]').val();},
                        group_name : () => { return $('form.js-students input[name="group_name"]').val();},
                        course_code : () => { return $('form.js-students [name="course_code"]').val();},
                        intake_id : () => { return $('form.js-students [name="intake_id"]').val();},
                    },
                    dataType: 'json'
                }
            });
        });

        //?Cancel editing
        $(document).on('click','form.js-students button[type="reset"]',event => {
            let form = $('form.js-students');
            if($(form).hasClass('edit-action')){
                $(form).removeClass('edit-action').addClass('add-action');
                $(form).closest('.card').find('.card-header#right>h2').text('ADD COURSE').addClass('c-teal').removeClass('c-red');
                $(form).find('button[type="submit"]').text('ADD GROUP');
            }

            //Reset validator
            studentsValidator.resetForm();
            $(form).find('.help-block, .form-group').removeClass('has-error');     
        });

        //?Delete
        $('#student-group-list').on('click','.delete-group',event => {
            let _this = event.target;
            $(_this).closest('.actions').removeClass('open');

            let group_id = $(_this).closest('.dropdown-menu').data('group').group_id;
            let target = $(_this).closest('.dropdown-menu').data('delete-target');

            const deleteSwal = mySwal();
            deleteSwal({   
                title: "Are you sure?",   
                text: "This and associated records will be deleted permanently.",   
                type: "warning",       
                confirmButtonText: "Yes, delete!",
            })
            .then((result)=>{
                if(result.value){
                    ajaxComm(target,{group_id: group_id},"json")
                    .done(data => {
                        notify(data.icon,data.type,data.message);
                        reloadGroupsList();
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
            initStudentGroups();
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