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
}();

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