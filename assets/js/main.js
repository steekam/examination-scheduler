$(document).ready(function (){
    //Toggle what is displayed in the footer
    var footerUl =  document.querySelector('footer ul');
    var sideNav = document.querySelector('aside');
    
    if(!sideNav){
        $(footerUl).parent().addClass('p-l-0');
        $(footerUl).hide();
    }

    //Add has-error class to form-group for fields with errors
    (function formErrorCheck() {
        //Add has-error class if there is an error
        const errorBlock = document.querySelectorAll('.form-group .help-block');
        
        //Custom event
        var event = new CustomEvent('formError', {
            bubbles: true,
        });
        
        //Listen for event
        errorBlock.forEach(element => {
            element.addEventListener('formError', function (e) {
                var block = e.currentTarget;
                if ($(block).text() !== "") {
                    $(block).parent().parent().addClass('has-error');
                }
            }, false);
            //Dispatch event
            element.dispatchEvent(event);
        });  
    })();

    // $('input').attr('autocomplete','off');
    
    /*
    * Notifications
    */
    function notify(message,from, align, icon, type, animIn, animOut){
        $.growl({
            icon: icon,
            title: ' ',
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
    
    $('.notification-demo > div > .btn').click(function(e){
        e.preventDefault();
        var nFrom = $(this).attr('data-from');
        var nAlign = $(this).attr('data-align');
        var nIcons = $(this).attr('data-icon');
        var nType = $(this).attr('data-type');
        var nAnimIn = $(this).attr('data-animation-in');
        var nAnimOut = $(this).attr('data-animation-out');
        
        notify("Welcome",nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut);
    }); 

    //Call functions only used in the page
    var page = window.location.pathname;
    if( page.includes('admin/register_user') ){
        adminUserRegistration();
    }
    
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
    

    
});

/**
     *  Faculty representative helper
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