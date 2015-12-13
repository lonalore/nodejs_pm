(function ($)
{
	e107.Nodejs.callbacks.pmNodejsAlert = {
		callback: function (message)
		{
			switch(message.type)
			{
				case "pmNodejsAlert":
					// TODO: user defined value...
					if(parseInt(e107.settings.nodejs_pm.nodejs_pm_alert) === 1)
					{
						var msgData = {
							playsound: false,
							data: {
								subject: '',
								body: message.markup
							}
						};

						// TODO: user defined value...
						if(parseInt(e107.settings.nodejs_pm.nodejs_pm_sound) === 1)
						{
							msgData.playsound = true;
						}

						e107.Nodejs.callbacks.nodejsNotify.callback(msgData);
					}
					break;
			}
		}
	};

}(jQuery));
