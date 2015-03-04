<?php
/**
 * @file
 *
 */


/**
 * Class nodejs_pm_nodejs.
 */
class nodejs_pm_nodejs
{

	private $plugPrefs = array();

	/**
	 * Node.js Javascript handlers.
	 *
	 * @return array
	 *    The list of JavaScript handler files.
	 */
	public function jsHandlers()
	{
		$this->plugPrefs = e107::getPlugConfig('nodejs_pm')->getPref();

		$handlers = array();

		// Menu handler.
		$handlers[] = 'js/nodejs_pm_menu.js';

		// Show alert messages.
		if((int) $this->plugPrefs['nodejs_pm_alert'] === 1)
		{
			$handlers[] = 'js/nodejs_pm_alert.js';
		}

		return $handlers;
	}


	/**
	 * Node.js message handlers.
	 *
	 * @return array
	 *    The list of message callbacks.
	 */
	public function msgHandlers()
	{
		return array();
	}


	/**
	 * Node.js user channels.
	 *
	 * @return array
	 *    The list of user channels.
	 */
	public function userChannels()
	{
		return array(// 'nodejs_notify_',
		);
	}


	/**
	 * Node.js user presence list.
	 *
	 * @param $account
	 *
	 * @return array
	 *    List of users who can see presence notifications about me.
	 */
	public function userPresenceList($account)
	{
		return array();
	}

}
