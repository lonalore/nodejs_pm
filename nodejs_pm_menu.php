<?php
/**
 * @file
 * Class to render an e107 menu for plugin.
 */

if(!defined('e107_INIT'))
{
	exit();
}

if(!e107::isInstalled('nodejs_pm'))
{
	exit;
}

e107::lan('nodejs_pm', false, true);


/**
 * Class nodejs_pm_menu.
 */
class nodejs_pm_menu
{

	private $plugPrefs = null;

	function __construct()
	{
		if (USER) {
			$this->plugPrefs = e107::getPlugConfig('nodejs_pm')->getPref();
			$this->renderMenu();
		}
	}


	function renderMenu()
	{
		$template = e107::getTemplate('nodejs_pm');
		$sc = e107::getScBatch('nodejs_pm', true);
		$tp = e107::getParser();
		$db = e107::getDb();

		$new = $db->count('private_msg', '(*)', "WHERE pm_read = 0 AND pm_to = '" . USERID . "' AND pm_read_del != 1");

		$sc->setVars(array(
			'new' => $new,
		));

		$text = $tp->parseTemplate($template['MENU'], true, $sc);

		e107::getRender()->tablerender(LAN_NODEJS_PM_MENU_01, $text);
		unset($text);
	}
}


new nodejs_pm_menu();
