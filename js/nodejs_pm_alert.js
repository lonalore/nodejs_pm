(function ($) {
    e107Nodejs.Nodejs.callbacks.pmNodejsAlert = {
        callback: function (message) {
            if (parseInt(e107NodejsPM.settings.nodejs_pm_alert) === 1) {
                if (!$('body').find('.nodejs-messages-wrapper').length) {
                    $('body').append('<div class="nodejs-messages-wrapper" />');
                }

                $messageAlert = $(message.markup);
                $('.nodejs-messages-wrapper').prepend($messageAlert);

                // Remove alert after 10 seconds.
                nodejs_pm_remove_alert($messageAlert, 10000, 500);

                if (parseInt(e107NodejsPM.settings.nodejs_pm_sound) === 1) {
                    // Play sound.
                    nodejs_pm_sound_alert();
                }

                // Remove alert on close button.
                $messageAlert.find('.close-button').bind('click', function (e) {
                    nodejs_pm_remove_alert($(this).parent(), 1, 500);
                    e.stopPropagation();
                });
            }
        }
    };

    /**
     * Remove alert.
     *
     * @param $alert
     *   jQuery object of alert message.
     * @param timeout
     *   Timeout to message show.
     * @param speed
     *   Animation speed.
     */
    function nodejs_pm_remove_alert($alert, timeout, speed) {
        timeout = timeout || 5000;
        speed = speed || 500;
        setTimeout(function () {
            $alert.animate({
                'opacity': 0.1
            }, speed, function () {
                $(this).remove();
            });
        }, timeout);
    }

    /**
     * Sound alert.
     *
     * @param type
     *   Type of sound alert, can be 'message' or 'alert' string.
     *
     * @todo Change this in future.
     */
    function nodejs_pm_sound_alert() {
        var settings = e107NodejsPM.settings,
            audioSel = 'audio[id*="pm-alert"]',
            html;

        if (parseInt(settings.nodejs_pm_sound) == 1) {
            var soundPath = settings.nodejs_pm_sound_path + '/sounds/message.mp3';
            html = '<audio id="pm-alert-2" class="alert" src="' + soundPath + '"></audio>';

            $('body').append(html);

            if ($(audioSel).length) {
                $(audioSel).parent('.audiojs').find('.pause').click();
                $(audioSel).parent('.audiojs').remove();
            }

            $audionInstance = audiojs.create($(audioSel));

            if ($audionInstance[0].settings.hasFlash && $audionInstance[0].settings.useFlash) {
                $audionInstance[0].settings.autoplay = true;
            }

            $(audioSel).parent('.audiojs').find('.play').click();
            $(audioSel).parent('.audiojs').addClass('pn-nj-audiojs').hide();
        }
    }

}(jQuery));
