(function ($) {
    e107Nodejs.Nodejs.callbacks.pmNodejsMenu = {
        callback: function (message) {
            if (parseInt(message.data) > 0) {
                $('#nodejs-pm a.dropdown-toggle span.badge').html(message.data);
            }
        }
    };
}(jQuery));
