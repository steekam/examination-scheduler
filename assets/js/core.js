/*
 * *********************************************************************************
 *                                                                                 *
 * Utility functions                                                               *
 *                                                                                 * 
 * *********************************************************************************
 */

/**
 * 
 * @param {String} icon An icon class to be used for the notification.
 * @param {Strin} type success || danger || warning || info(default)
 * @param {String} message Message to be displayed in the notification body
 * @param {Sting} url If you want the notification to be a link (Optional)
 * @param {String} align Position to be aligned on page right(default) || left
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

/**
 * Sets sweet alert defaults
 * @returns {Object} A swal object
 */
var mySwal =  () => {
    // Set default properties
    return swal.mixin({
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonClass: 'btn btn-lg btn-success m-5',
                cancelButtonClass: 'btn btn-lg btn-danger m-5',
                inputClass: 'form-control'
            });
};

/**
 * Set form validatorjquery defaults
 */
var initDefaultValidator = () => {
    console.log("Loaded defaults");
    
    $.validator.setDefaults({
        debug: true,
        ignore: ':hidden',
        errorClass: 'has-error animated fadeInDown',
        errorElement: 'span',
        errorPlacement: function(error, e) {
            jQuery(e).closest('.form-group').find('.help-block').append(error);
        },
        highlight: function(e) {
            jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
        },
        success: function(e) {
            jQuery(e).closest('.form-group').removeClass('has-error');
            jQuery(e).remove();
        }
    });
}