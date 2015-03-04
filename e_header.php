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
		e107::js('nodejs_pm', 'libraries/audiojs/audio.min.js', 'jquery', 2);

		$js_options = array(
			'nodejs_pm_alert'      => (int) $this->plugPrefs['nodejs_pm_alert'],
			'nodejs_pm_sound'      => (int) $this->plugPrefs['nodejs_pm_sound'],
			'nodejs_pm_sound_path' => SITEURLBASE . e_PLUGIN_ABS . 'nodejs_pm',
		);

		$options = nodejs_json_encode($js_options);
		$js_config = 'var e107NodejsPM = e107NodejsPM || { settings: ' . $options . ' };';

		e107::js('inline', $js_config, null, 3);
	}
}


// Class instantiation.
new nodejs_pm_e_header;
