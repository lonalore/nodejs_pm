<?php

/**
 * @file
 *
 */


/**
 * Class nodejs_pm_nodejs_notify.
 */
class nodejs_pm_nodejs_notify
{

	/**
	 * NodeJS Notify configuration items.
	 *
	 * @return array
	 *    The list of configuration items.
	 */
	public function configurationItems()
	{
		$items = array();

		// "Be notified when you receive new private message" item.
		$items[] = array(
			// Use global language file.
			'label'       => LAN_PLUGIN_NODEJS_PM_NOTIFY_CONFIG_02,
			// Extended User Field name from plugin.xml to store configuration by user.
			// plugin_nodejs_pm_alert
			'field_alert' => 'new_pm_alert',
			// Extended User Field name from plugin.xml to store configuration by user.
			// plugin_nodejs_pm_sound
			'field_sound' => 'new_pm_sound',
		);

		// "Be notified when others open your private message" item.
		$items[] = array(
			// Use global language file.
			'label'       => LAN_PLUGIN_NODEJS_PM_NOTIFY_CONFIG_03,
			// Extended User Field name from plugin.xml to store configuration by user.
			// plugin_nodejs_pm_alert
			'field_alert' => 'read_pm_alert',
			// Extended User Field name from plugin.xml to store configuration by user.
			// plugin_nodejs_pm_sound
			'field_sound' => 'read_pm_sound',
		);

		return array(
			'group_title'       => LAN_PLUGIN_NODEJS_PM_NOTIFY_CONFIG_01,
			'group_description' => '',
			'group_items'       => $items,
		);
	}

}
