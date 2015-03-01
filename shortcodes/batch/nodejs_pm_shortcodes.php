<?php
/**
 * @file
 * Class installation to define shortcodes.
 */

if (!defined('e107_INIT'))
{
	exit;
}

/**
 * Class nodejs_pm_shortcodes.
 */
class nodejs_pm_shortcodes extends e_shortcode
{

	private $plugPrefs = array();


	function __construct()
	{
		$this->plugPrefs = e107::getPlugConfig('nodejs_pm')->getPref();
	}


	function sc_avatar()
	{
		$tp = e107::getParser();
		$tp->thumbWidth = 40;
		$tp->thumbHeight = 40;

		return $tp->toAvatar($this->var);
	}


	function sc_links()
	{
		$uid = (int) $this->var['uid'];

		if ($uid === 0)
		{
			return $this->var['user_name'];
		}

		return '<a href="' . e_HTTP . 'user.php?id.' . $uid . '">' . $this->var['user_name'] . '</a>';
	}


	function sc_message()
	{
		$tp = e107::getParser();

		$emotes_active = $this->plugPrefs['nodejs_chatbox_emote'] ? 'USER_BODY, emotes_on' : 'USER_BODY, emotes_off';
		$wordwrap = $this->plugPrefs['nodejs_chatbox_wordwrap'];

		$message = $tp->toHTML($this->var['message'], false, $emotes_active, $this->var['uid'], $wordwrap);

		return $message;
	}
}
