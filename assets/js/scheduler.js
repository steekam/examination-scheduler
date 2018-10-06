var schedulerJS = () => {
    /**
     * Handler for examination rooms page
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

    return {
        init: () =>{
            let page = window.location.pathname;
            if(page.includes('scheduler/rooms')){
                initSchedulerRooms();
            }
        }
    }
};

$(document).ready( schedulerJS().init() );