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

	function __construct()
	{
		$this->plugPrefs = e107::getPlugConfig('nodejs_pm')->getPref();
		$this->include_components();
	}


	/**
	 * Include necessary CSS and JS files
	 */
	function include_components()
	{
		e107::css('nodejs_pm', 'css/nodejs_pm.css');

		// TODO: user defined values...
		$js_options = array(
			'nodejs_pm_alert' => (int) $this->plugPrefs['nodejs_pm_alert'],
			'nodejs_pm_sound' => (int) $this->plugPrefs['nodejs_pm_sound'],
		);

		e107::js('settings', array('nodejs_pm' => $js_options));

		e107::js('nodejs_pm', 'js/nodejs_pm_menu.js', 'jquery', 5);
		e107::js('nodejs_pm', 'js/nodejs_pm_alert.js', 'jquery', 5);
	}
}


// Class instantiation.
new nodejs_pm_e_header;
