var coreJS = function(){

    /**
     * Function with custom event for the error-checking event in the forms to add the error classes 
     * Add has-error class to form-group for fields with errors
     * This function is loaded by default in all pages
     */
    var initFormErrorCheck = function () {
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
    };

    $('input').attr('autocomplete','off');
    
    /*
    * Notifications
    */
    function notify(message,from, align, icon, type, animIn, animOut){
        $.growl({
            icon: icon,
            title: '',
            message: message,
            url: ''
        },{
                element: 'body',
                type: type,
                allow_dismiss: true,
                placement: {
                        from: from,
                        align: align
                },
                offset: {
                    x: 20,
                    y: 85
                },
                spacing: 10,
                z_index: 1031,
                delay: 2500,
                timer: 1000,
                url_target: '_blank',
                mouse_over: false,
                animate: {
                        enter: animIn,
                        exit: animOut
                },
                icon_type: 'class',
                template: '<div data-growl="container" class="alert" role="alert">' +
                                '<button type="button" class="close" data-growl="dismiss">' +
                                    '<span aria-hidden="true">&times;</span>' +
                                    '<span class="sr-only">Close</span>' +
                                '</button>' +
                                '<span data-growl="icon"></span>' +
                                '<span data-growl="title"></span>' +
                                '<span data-growl="message"></span>' +
                                '<a href="#" data-growl="url"></a>' +
                            '</div>'
        });
    };
    
    //Notification message when a new course is added.
    $('.succesful-course-notification > .btn-success').click(function(e){
        e.preventDefault();
        var nFrom = $(this).attr('data-from');
        var nAlign = $(this).attr('data-align');
        var nIcons = $(this).attr('data-icon');
        var nType = $(this).attr('data-type');
        var nAnimIn = $(this).attr('data-animation-in');
        var nAnimOut = $(this).attr('data-animation-out');
        
        notify("Course has been succesfully registered",nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut);
    }); 
    //Notification message when a new course is not added.
    $('.failed-course-notification > .btn').click(function(e){
        e.preventDefault();
        var nFrom = $(this).attr('data-from');
        var nAlign = $(this).attr('data-align');
        var nIcons = $(this).attr('data-icon');
        var nType = $(this).attr('data-type');
        var nAnimIn = $(this).attr('data-animation-in');
        var nAnimOut = $(this).attr('data-animation-out');
        
        notify("Course has not been succesfully registered",nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut);
    }); 

    //Call functions only used in the page
    var page = window.location.pathname;
    if( page.includes('admin/register_user') ){
        adminUserRegistration();
    } else if (page.includes('faculty/view_course')){
        faculty_view_course();
    }
    

    //General utility
    $(document).on('show.bs.collapse','.collapse',function(event){
        //Change the plus icon to minus
        let $this = event.currentTarget;
        let pullLeft = $($this).parent().siblings()[0];
        let label = $(pullLeft).children()[0];
        let icon = $(label).children()[0];
        $(icon).removeClass('zmdi-plus').addClass('zmdi-minus');
    });

    $(document).on('hide.bs.collapse', '.collapse', function (event) {
        //Change the plus icon to minus
        let $this = event.currentTarget;
        let pullLeft = $($this).parent().siblings()[0];
        let label = $(pullLeft).children()[0];
        let icon = $(label).children()[0];
        $(icon).removeClass('zmdi-minus').addClass('zmdi-plus');
    });
    
    return {
        init: ()=> {
            initFormErrorCheck();
        }
    }
}();

/**
 *  Faculty representative registration helper
 */
function adminUserRegistration() {
    var role = document.querySelector('select[name="role"]');
    var faculty = document.querySelector('#faculty-select');

    if (role.value == "faculty representative") {
        faculty.classList.remove('hidden');
    } else {
        faculty.classList.add('hidden');
    }
    role.addEventListener('change', function () {
        var faculty = document.querySelector('#faculty-select');
        if (role.value == "faculty representative") {
            faculty.classList.remove('hidden');
        } else {
            faculty.classList.add('hidden');
        }
    });

    /**
     * Add faculty option
     */
    var btnAddNewFaculty = document.querySelector('#addNewFaculty');

    btnAddNewFaculty.addEventListener('click', function (event) {
        event.preventDefault();
        $('#addFacultyModal').modal('show');
    }, false);

    var addFaculty = document.querySelector('#addFaculty');
    addFaculty.addEventListener('click', function (event) {
        event.preventDefault();
        var facultyName = document.querySelector("#facultyName").value;
        var url = document.querySelector("#facultyName").closest('form').action;

        $.ajax({
            method: "POST",
            url: url,
            data: { name: facultyName }
        }).done(() => {
            $('#addFacultyModal').modal('hide');
            swal({
                title: "Success",
                text: "Faculty added",
                type: "success",
                showConfirmButton: false,
                timer: 2000
            });
        }).fail(() => {
            swal({
                title: "Could not update faculty",
                text: "Try again later",
                type: "warning",
                showConfirmButton: false,
                timer: 2000
            });
            $('#addFacultyModal').modal('hide');
        });

    /**
     * Toggle the content of the footer based on the access
     */
    var initFooterToggle = function(){
        const footerUl =  $('footer ul');
        const sideNav = $('aside');
        
        if(sideNav.length == 0){
            $(footerUl).parent().addClass('p-l-0');
            $(footerUl).hide();
        }
    };

    //Remove autocomplete attribute on all input fields
    $('input').attr('autocomplete','off');



    return {
        init: function(){
            initFormErrorCheck();
            initFooterToggle();
        }
    };
    });

    $('#addFacultyModal').on('hidden.bs.modal', function () {
        document.querySelector("#facultyName").value = "";
    });

    /**
     * Update the faculties from the database
     */
    var fetchUrl = document.querySelector("select[name=faculty]").getAttribute('data-source');

    /**
     * 
     * @param {Array} data 
     */
    function fillFaculties(data) {
        data.forEach(element => {
            var option = '<option value="' + element["id"] + '"<?php echo  set_select("faculty", ' + element["name"] + ', TRUE); ?>' + element['name'] + '</option>';
            $(document.querySelector("select[name=faculty]")).append(option);
        });
    }

    $.post(fetchUrl, function (data) {
        fillFaculties(data);
    }, "json")
        .fail(() => {
            console.log("Error in fetch");
        });
}

/**
 * Faculty js interactions
 */
function faculty_view_course(){
    $(document).on('click','.edit-course, .edit-unit, .edit-units',function(event){
        let target = $(this).attr('data-target');

        switch(target)
        {
            case "#general":
            {
                let form = $(target).children()[0];
                var hideDiv = $(form).children()[1];
                $(hideDiv).toggleClass('hidden');
                $($(form).children()[0]).children().find('input').prop('disabled',(i,v)=>{return !v});
                $('.edit-course > i').toggleClass('zmdi-close zmdi-edit');
                
                //Cancel button
                $('.cancel-general').click(function(event){
                    event.preventDefault();
                    $('.edit-course > i').removeClass('zmdi-close').addClass('zmdi-edit');
                    $(hideDiv).addClass('hidden');
                });
                break;
                
            }
            case "#units":
            {
                $('.edit-units>i').toggleClass('zmdi-close zmdi-edit');                    
                $('#units .pull-right').toggleClass('hidden');
                $('.add-unit').toggleClass('hidden');
                break;
                
            }
            case '#unit':
            {
                console.log("unit");
                
                break;
            }
            default:
            {

            }
        }
        
    });
}
/*
 *  Faculty Add Course Js Interactions
 */
$('#register-course').on('click', function(event){
    //Prevents the browser from submitting the form
    event.preventDefault();
    //Serialize the form data
    var formdata = $('form').serialize();
    //Get the location of the script where the data will be sent to
    var action = $('form').attr('action');
    //Check the location of the action from the console
    $.ajax({
        url: action,
        type: "POST",
        data: formdata,
        //Function that interacts with the success interaction of the php file
        success: function(data){
            $('#feedback-result').addClass('alert-success');
            $('#feedback-result').val('Course inserted succesfully');
            $('#feedback-result').attr('style','visibility:visible');
            $('#name').val('');
            $('#name').focuout();
            $('#abbrev').val('');
            $('#abbrev').focuout();
        },
        error: function(jqXHR,textStatus){
            $('#feedback-result').addClass('alert-danger');
            $('#feedback-result').val('Course not inserted succesfully');
            $('#feedback-result').attr('style','visibility:visible');
            $('#name').val('');
            $('#name').focuout();
            $('#abbrev').val('');
            $('#abbrev').focuout();
        }
    });
});
/*
 *********************************************************************************
 **                                                                                 
 ** Utility functions                                                               
 **                                                                                  
 *********************************************************************************
 */

/**
 * Notification helper with bootstrap notify plugin
 */
var notify = function(icon,type,message,url,align){
    // Create notification
    $.notify({
        icon: icon || '',
        message: message,
        url: url || ''
    },
    {
        element: 'body',
        type: type || 'info',
        allow_dismiss: true,
        newest_on_top: true,
        showProgressbar: false,
        placement: {
            from: 'top',
            align: align || 'right'
        },
        mouse_over: 'pause',
        offset: 20,
        spacing: 10,
        z_index: 1033,
        delay: 5000,
        timer: 1000,
        template: '<div data-notify="container" class="col-11 col-sm-4 alert alert-{0}" role="alert">' +
                    '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                    '<span data-notify="icon"></span> ' +
                    '<span data-notify="title">{1}</span> ' +
                    '<span data-notify="message">{2}</span>' +
                    '<div class="progress" data-notify="progressbar">' +
                    '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                    '</div>' +
                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                    '</div>',
        animate: {
            enter: 'animated fadeIn',
            exit: 'animated fadeOutDown'
        }
    });
};

/**
 * Ajax comunication helper for data sending and receiving with the server
 *  
 * @param {String} dataTarget URL tp where to send the request
 * @param {Object} dataSend   An object with data to send with request
 * @param {String} dataType     json || text || html || xml This is whatever the server will respond with
 * @param {String} errorMessage  Message to be displayed when ajax call fails
 * 
 * @return {Object} an ajax object of the ajax call
 */
var ajaxComm = function(dataTarget,dataSend,dataType){
    return $.ajax({
                url: dataTarget,
                type: "POST",
                data: dataSend,
                dataType: dataType
            })
            .fail(error => {
                var icon = "zmdi zmdi-alert-circle-o";
                notify(icon,"danger","Error in server connection");
                console.log(error);
            });
}

$(document).ready( coreJS.init() );
