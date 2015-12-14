var e107 = e107 || {'settings': {}, 'behaviors': {}};

(function ($)
{
	e107.Nodejs.callbacks.pmNodejsAlert = {
		callback: function (message)
		{
			var msgData = {
				playsound: false,
				data: {
					subject: '',
					body: message.markup
				}
			};

			switch(message.type)
			{
				case "new_pm":
					if(parseInt(e107.settings.nodejs_pm.new_pm_alert) === 1)
					{
						e107.Nodejs.callbacks.nodejsNotify.callback(msgData);
					}

					if(parseInt(e107.settings.nodejs_pm.new_pm_sound) === 1)
					{
						e107.Nodejs.callbacks.nodejsNotifySoundAlert.callback();
					}
					break;

				case "read_pm":
					if(parseInt(e107.settings.nodejs_pm.read_pm_alert) === 1)
					{
						e107.Nodejs.callbacks.nodejsNotify.callback(msgData);
					}

					if(parseInt(e107.settings.nodejs_pm.read_pm_sound) === 1)
					{
						e107.Nodejs.callbacks.nodejsNotifySoundAlert.callback();
					}
					break;
			}
		}
	};

}(jQuery));
