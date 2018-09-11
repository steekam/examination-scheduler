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
    function notify(from, align, icon, type, animIn, animOut){
        $.growl({
            icon: icon,
            title: ' ',
            message: 'You are logged in',
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
        
        notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut);
    });


    
});