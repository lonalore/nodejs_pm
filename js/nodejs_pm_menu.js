var e107 = e107 || {'settings': {}, 'behaviors': {}};

(function ($) {
    e107.Nodejs.callbacks.pmNodejsMenu = {
        callback: function (message) {
            switch (message.type) {
                case "pmNodejsMenu":
                    if (parseInt(message.data) > 0) {
                        $('#nodejs-pm a.dropdown-toggle span.badge').html(message.data);
                    }
                    else
                    {
                        $('#nodejs-pm a.dropdown-toggle span.badge').html('');
                    }
                    break;
            }
        }
    };
}(jQuery));
