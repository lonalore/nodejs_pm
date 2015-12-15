<?php

/**
 * @file
 * Class instantiation to prepare JavaScript configurations and include css/js
 * files to page header.
 */

if(!defined('e107_INIT'))
{
	exit;
}


/**
 * Class nodejs_pm_e_header.
 */
class nodejs_pm_e_header
{

	private $plugPrefs = array();


	private $defaultValues = array();


	function __construct()
	{
		if(USERID > 0)
		{
			$db = e107::getDb();
			$this->plugPrefs = e107::getPlugConfig('nodejs_pm')->getPref();
			$this->defaultValues = $db->retrieve('user_extended', '*', 'user_extended_id = ' . USERID);

			if(is_array($this->defaultValues) && !empty($this->defaultValues))
			{
				$this->include_components();
			}
		}
	}


	/**
	 * Include necessary CSS and JS files
	 */
	function include_components()
	{
		e107::css('nodejs_pm', 'css/nodejs_pm.css');

		$eufPrefix = 'user_plugin_nodejs_pm_';

		// User defined settings.
		$new_pm_alert = vartrue($this->defaultValues[$eufPrefix . 'new_pm_alert'], 0);
		$new_pm_sound = vartrue($this->defaultValues[$eufPrefix . 'new_pm_sound'], 0);
		$read_pm_alert = vartrue($this->defaultValues[$eufPrefix . 'read_pm_alert'], 0);
		$read_pm_sound = vartrue($this->defaultValues[$eufPrefix . 'read_pm_sound'], 0);

		// If admin disabled it globally.
		if((int) $this->plugPrefs['nodejs_pm_alert'] === 0)
		{
			$new_pm_alert = 0;
			$read_pm_alert = 0;
		}

		// If admin disabled it globally.
		if((int) $this->plugPrefs['nodejs_pm_sound'] === 0)
		{
			$new_pm_sound = 0;
			$read_pm_sound = 0;
		}

		$js_options = array(
			'new_pm_alert'  => (int) $new_pm_alert,
			'new_pm_sound'  => (int) $new_pm_sound,
			'read_pm_alert' => (int) $read_pm_alert,
			'read_pm_sound' => (int) $read_pm_sound,
		);

		e107::js('settings', array('nodejs_pm' => $js_options));

		e107::js('nodejs_pm', 'js/nodejs_pm_menu.js', 'jquery', 5);
		e107::js('nodejs_pm', 'js/nodejs_pm_alert.js', 'jquery', 5);
	}
}


// Class instantiation.
new nodejs_pm_e_header;
