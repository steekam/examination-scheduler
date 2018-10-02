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
    };

    /**
     * Toggle the content of the footer based on the access
     */
    var initFooterToggle = function(){
        var footerUl =  document.querySelector('footer ul');
        var sideNav = document.querySelector('aside');
        
        if(!sideNav){
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
}();

/**
 * Initialize the code to be used in the admin module gegister user page
 */
var initAdminRegisterUser = function(){
     /*
     *  Faculty representative helper
     *  Reveals a faculty dropdown if the role of added user is a faculty representative
     *  
     */
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
    

    /*
     * Add faculty option
     */
    var btnAddNewFaculty = document.querySelector('#addNewFaculty');
    
    btnAddNewFaculty.addEventListener('click',function(event){
        event.preventDefault();
        $('#addFacultyModal').modal('show');                
    },false);

    var addFaculty = document.querySelector('#addFaculty');
    addFaculty.addEventListener('click',function(event){
        event.preventDefault();
        var facultyName = document.querySelector("#facultyName").value;
        var url = document.querySelector("#facultyName").closest('form').action;
        
        $.ajax({
            method:"POST",
            url: url,
            data: {name: facultyName }
        }).done( ()=> {
            $('#addFacultyModal').modal('hide');
            swal({
                title: "Success",
                text: "Faculty added",
                type: "success",
                showConfirmButton: false,
                timer: 2000
            });            
        }).fail( () =>{
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

    $('#addFacultyModal').on('hidden.bs.modal', function (){
        document.querySelector("#facultyName").value = "";
    });

    /*
     * Update the faculties from the database
     */
    var fetchUrl = document.querySelector("select[name=faculty]").getAttribute('data-source');

    /**
     * 
     * @param {Array} data 
     */
    function fillFaculties(data) {
        data.forEach(element => {
            var option = '<option value="' + element["id"] + '"<?php echo  set_select("faculty", '+element["name"]+', TRUE); ?>'+element['name']+'</option>';
            $( document.querySelector("select[name=faculty]") ).append(option);
        });
    }
    
    $.post(fetchUrl,function(data){
        fillFaculties(data);        
    },"json")
    .fail(() => {
        console.log("Error in fetch");            
    });


};

/*
 * *********************************************************************************
 *                                                                                 *
 * Utility functions                                                               *
 *                                                                                 * 
 * *********************************************************************************
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
        template: '<div data-notify="container" class="col-11 col-sm-3 alert alert-{0}" role="alert">' +
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


$(document).ready(function (){
    //Script bit common in all pages
    coreJS.init();
    
    //Load function based on the page
    var page = window.location.pathname;
    if(page.includes('admin/register_user')){
        initAdminRegisterUser();
    }
});