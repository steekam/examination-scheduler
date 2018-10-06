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

/*
  ***********************************************************************
 ** 
 **Administrator module
 ** 
 ************************************************************************
 */
var initAdminRegisterUser = function(){
     /*
     **  Faculty representative helper
     **  Reveals a faculty dropdown if the role of added user is a faculty representative
     **  
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
     ** Add faculty option
     */
    let btnAddNewFaculty = document.querySelector('#addNewFaculty');
    
    btnAddNewFaculty.addEventListener('click',function(event){
        event.preventDefault();
        $('#addFacultyModal').modal('show');                
    },false);

    let addFaculty = document.querySelector('#addFaculty');
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
     ** Update the faculties from the database
     */
    let fetchUrl = $("select[name=faculty]").data('source');

    /**
     * 
     * @param {Array} data The faculty information to be inserted
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
 ***********************************************************************
 ** 
 ** Scheduler module
 ** 
 ***********************************************************************
 */
var initSchedulerRooms = function(){
    /**
     * Refreshes the building entries
     */
    var refreshBuildings = function(){
        let dataTarget = $('.rooms-card').data('target');
        let errorMessage = "Could not reach the server";

        fetch(dataTarget)
            .then(response => response.text())
            .then(data => {
                var content = $(data).find(".entries").html();
                $(".entries").html(content);
            })
            .catch((error) => {
                var icon = "zmdi zmdi-alert-circle-o";
                notify(icon,"danger",errorMessage);
            });        
    }

    /*
     ** Building modal shown from add event
     */
    $('.rooms-card').on('click','.add-building', event => {
        $('#modalBuilding form').addClass('add-action').removeClass('edit-action');
        $('#modalBuilding form [type="submit"]').html('Submit details');
        $('#modalBuilding .modal-title').html("ENTER BUILDING DETAILS");
    });

    /*
     ** Edit building event
     */
    $('.rooms-card').on('click','li>a.edit-building',function(event){
        event.preventDefault();
        
        $('#modalBuilding form').addClass('edit-action').removeClass('add-action');
        $('#modalBuilding form [type="submit"]').html('Save changes');
        $('#modalBuilding .modal-title').html("EDIT BUILDING NAME");

        let building_id = $(this).data('building-id');
        let building_name = $(this).data('building-name');
        
        $("#modalBuilding form input[name='building_id']").val(building_id);
        $('#modalBuilding form input[name="building_name"]').val(building_name);
        $('#modalBuilding').modal('show');
    });

    /*
     ** Bulding form submit event
     */
    $('#modalBuilding form').off('submit').on('submit',event => {
        event.preventDefault();
        let _this = event.target;
        let dataTarget = "";
        let dataSend = $(_this).serialize();
        let type = $('#modalBuilding form').attr('class');

        if(type=="add-action"){
            dataTarget = $(_this).data('add-action');
        }else if(type=="edit-action"){
            dataTarget = $(_this).data('edit-action');
        } 

        ajaxComm(dataTarget,dataSend,"json")
        .done(data => {
            notify(data.icon,data.type,data.message);
        })        
        .always( () =>{
            $('#modalBuilding').modal('hide');
            $('input[name="building_name"]').val(' ');
            refreshBuildings();
        });
        return false;
    }); 

    /*
     ** Delete building event
     */
    $('.rooms-card').on('click','li>a.delete-building',function(event){
        event.preventDefault();
        let dataTarget = $(this).data('delete-action');
        let building_id = $(this).data('building-id');
        let dataSend = {"building_id":building_id};

        swal({   
            title: "Are you sure?",   
            text: "You will not be able to recover this record",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete building!",   
            closeOnConfirm: true
        }, function(){
            ajaxComm(dataTarget,dataSend,"json")
            .done(data => {
                notify(data.icon,data.type,data.message);
                refreshBuildings();
            });
        });
    });

    /*
    ** Add new room event
    */
    $(document).on('click','.add-room',event => {
        $('#modalRoom form').addClass('add-action').removeClass('edit-action');
        $('#modalRoom form input[name="room_name"]').val('');

        let _this = event.target;
        let building_id = $(_this).data('building-id');
        $('#modalRoom form input[name="building_id"]').val(building_id);

        let building_name = $(_this).data('building-name');
        $("#modalRoom .modal-title").html(`${building_name}: ADD ROOM`);      
        $('#modalRoom form button[type="submit"]').html("Submit details");        
    });

    /*
    **Edit room event
    */
    $('.rooms-card').on('click','.edit-room',event => {
        $('#modalRoom form').addClass('edit-action').removeClass('add-action');

        let _this = event.target;
        let room_id = $($(_this).closest('.room-actions')).data('room-id');
        let room_name = $($(_this).closest('.room-actions')).data('room-name');
        let building = ($(_this).closest('.list-group')).find('.building-name').text();

        $('#modalRoom form input[name="room_name"]').val(room_name);
        $('#modalRoom form input[name="room_id"]').val(room_id);
        $('#modalRoom form button[type="submit"]').html("Save changes");
        $("#modalRoom .modal-title").html(`${building}: EDIT ROOM`);
        $('#modalRoom').modal('show');
    });

    /*
     ** Room modal form submit event 
     */
    $(document).off('submit').on('submit','#modalRoom form',event => {
        event.preventDefault();
        let _this = event.target;
        let dataTarget = "";
        let dataSend = $(_this).serializeArray();
        let type = $('#modalRoom form').attr('class');

        if(type=="add-action"){
            dataTarget = $(_this).data('add-action');
        }else if(type=="edit-action"){
            dataTarget = $(_this).data('edit-action');
        }

        ajaxComm(dataTarget,dataSend,"json")
        .done(data => {
            notify(data.icon,data.type,data.message);
        })        
        .always( () =>{
            $('#modalRoom').modal('hide');
            $('#modalRoom form input[name="room_name"]').val(' ');
            refreshBuildings();
        });
    });

    /*
     ** Delete room event
     */
    $('.rooms-card').on('click','.delete-room',function(event){
        event.preventDefault();
        let dataTarget = $($(this).closest('.room-actions')).data('delete-action');
        let room_id = $($(this).closest('.room-actions')).data('room-id');
        let dataSend = {"room_id":room_id};

        swal({   
            title: "Are you sure?",   
            text: "You will not be able to recover this record",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete room!",   
            closeOnConfirm: true
        }, function(){
            ajaxComm(dataTarget,dataSend,"json")
            .done(data => {
                notify(data.icon,data.type,data.message);
                refreshBuildings();
            });
        });
    });
}

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


$(document).ready(function (){
    //Script bit common in all pages
    coreJS.init();
    
    //Load function based on the page
    var page = window.location.pathname;
    if(page.includes('admin/register_user')){
        initAdminRegisterUser();
    }else if('scheduler/rooms'){
        initSchedulerRooms();
    }
});