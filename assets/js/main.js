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
     ** Update the faculties from the database
     */
    var fetchUrl = document.querySelector("select[name=faculty]").getAttribute('data-source');

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
        var dataTarget = $('.rooms-card').data('target');
        var errorMessage = "Could not reach the server";

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
     ** Add buidling form event
     */
    $(document).on('submit','#addNewBuildingForm',function(event){
        event.preventDefault();
        var dataTarget = $(this).attr('action');
        var dataSend = $(this).serialize();
        var errorMessage = "Could not reach the server";       
        
        ajaxComm(dataTarget,dataSend,"json",errorMessage,()=>{
            $('#addBuilding').modal('hide');
            $('input[name="building_name"]').val(' ');
            refreshBuildings();
        });
    });

    /*
     ** Edit building event
     */
    $('.rooms-card').on('click','li>a.edit-building',function(event){
        event.preventDefault();
        var building_id = $(this).data('building-id');
        var building_name = $(this).data('building-name');
        
        var modal_form = $("#addBuilding form");
        $(modal_form).attr('id','editBuildingForm');
        $('#editBuildingForm input[name="building_name"]').val(building_name);
        $('#editBuildingForm button[type="submit"]').html("Save changes");
        $('#addBuilding .modal-title').html("EDIT BUILDING DETAILS");
        $('#addBuilding').modal('show');

        //Submit form event
        $(modal_form).on('submit',function(event){
            event.preventDefault();
            var dataTarget = $(this).data('edit-action');
            var dataSend = $(this).serializeArray();
            dataSend.push({"name": "building_id","value": building_id});
            var errorMessage = "Could not reach the server";

            ajaxComm(dataTarget,dataSend,"json",errorMessage,()=>{
                $('#addBuilding').modal('hide');
                $('input[name="building_name"]').val(' ');
                //Revert form to default id
                $(modal_form).attr('id','addNewBuildingForm');

                //Revert button to default text
                $('#addNewBuildingForm button[type="submit"]').html("Submit details");
                refreshBuildings();
            });
            
        });      
    });

    /*
     ** Delete building event
     */
    $('.rooms-card').on('click','li>a.delete-building',function(event){
        event.preventDefault();
        var building_id = $(this).data('building-id');
        var dataTarget = $(this).data('delete-action');
        var dataSend = {"building_id":building_id};
        var errorMessage = "Could not reach the server";

        swal({   
            title: "Are you sure?",   
            text: "You will not be able to recover this record",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete building!",   
            closeOnConfirm: true
        }, function(){
            ajaxComm(dataTarget,dataSend,"json",errorMessage,()=>{
                refreshBuildings();
            });
        });

    });

    /*
    ** Add new room event
    */
    $(document).on('click','.add-room',function(event){
        var building_id = $(this).data('building-id');
        var building_name = $(this).data('building-name');
        $("#addRoom #building").text(building_name);

        $(document).on('submit','#addNewRoomForm',function(event){
            event.preventDefault();
            var dataTarget = $(this).attr('action');
            var dataSend = $(this).serializeArray();
            dataSend.push({"name": "building_id","value": building_id});
            var errorMessage = "Could not reach the server";
        
            ajaxComm(dataTarget,dataSend,"json",errorMessage,()=>{
                $('#addRoom').modal('hide');
                $('input[name="room_name"]').val(' ');
                refreshBuildings();
            });     
        });
    });

    /*
    **Edit room event
    **
    */
    $(document).on('click','.edit-room',function(event){
        var room_id = $(this).data('room-id');
        var room_name = $(this).data('room-name');
        var building = ($(this).closest('.list-group')).find('.building-name').text();

        var modal_form = $("#addRoom form");
        $(modal_form).attr('id','editRoomForm');
        $('#editRoomForm input[name="room_name"]').val(room_name);
        $('#editRoomForm button[type="submit"]').html("Save changes");
        $('#addRoom .modal-title').html(building+": EDIT ROOM DETAILS");
        $('#addRoom').modal('show');

        //Submit form event
        $(modal_form).on('submit',function(event){
            event.preventDefault();    
            let dataTarget = $(this).data('edit-action');
            let dataSend = $(this).serializeArray();
            dataSend.push({"name": "room_id","value": room_id});
            let errorMessage = "Could not reach the server";

            ajaxComm(dataTarget,dataSend,"json",errorMessage,()=>{
                $('#addRoom').modal('hide');
                $('input[name="room_name"]').val(' ');

                //Revert form to default id
                $(modal_form).attr('id','addNewRoomForm');
        
                $('#addRoom .modal-title').html("<span id='building'>"+building+"</span>: ADD NEW ROOM");

                //Revert submit button to default id
                $('#addNewRoomForm button[type="submit"]').html("Submit details");
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
 * @callback doneCallback
 * @param {String} dataTarget URL tp where to send the request
 * @param {Object} dataSend   An object with data to send with request
 * @param {String} dataType     json || text || html || xml This is whatever the server will respond with
 * @param {String} errorMessage  Message to be displayed when ajax call fails
 * @param {requestCallback} doneCallback  Function that is called when ajax call is done
 */
var ajaxComm = function(dataTarget,dataSend,dataType,errorMessage,doneCallback){
    $.ajax({
        url: dataTarget,
        type: "POST",
        data: dataSend,
        dataType: dataType ,
        success:(data) =>{
            /*
             **Server should return a response array
             **Elements: icon, message type, message
             */
            notify(data.icon,data.type,data.message);

        },
        error: (jqXHR,textStatus) => {
            var icon = "zmdi zmdi-alert-circle-o";
            notify(icon,"danger",errorMessage);
            console.log(textStatus);
            
        }

    }).done( function (event){
        doneCallback();
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