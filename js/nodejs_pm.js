(function ($) {
    e107Nodejs.Nodejs.callbacks.pmNodejsAlert = {
        callback: function (message) {

            if (parseInt(e107NodejsPM.settings.nodejs_pm_alert) === 1) {
                if (!$('body').find('.nodejs-messages-wrapper').length) {
                    $('body').append('<div class="nodejs-messages-wrapper" />')
                }

                $messageAlert = $(message.markup);
                $('.nodejs-messages-wrapper').prepend($messageAlert);

                // Remove alert after 10 seconds.
                pmNodejs.removeAlert($messageAlert, 10000, 500);

                if (parseInt(e107NodejsPM.settings.nodejs_pm_sound) === 1) {
                    // Play sound.
                    pmNodejs.soundAlert('alert');
                }

                // Remove alert on close button.
                $messageAlert.find('.close-button').bind('click', function (e) {
                    pmNodejs.removeAlert($(this).parent(), 1, 500);
                    e.stopPropagation();
                });

                // Go to main thread on bubble click.
                $messageAlert.click(function () {
                    window.location = threadPath;
                });
            }
        }
    };
}(jQuery));
