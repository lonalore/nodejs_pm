<?php

/**
 * @file
 * This file is loaded every time the core of e107 is included. ie. Wherever
 * you see require_once("class2.php") in a script. It allows a developer to
 * modify or define constants, parameters etc. which should be loaded prior to
 * the header or anything that is sent to the browser as output. It may also be
 * included in Ajax calls.
 */

e107::lan('nodejs_pm', false, true);

// Register events.
$event = e107::getEvent();
$event->register('user_pm_sent', 'nodejs_pm_event_user_pm_sent_callback');
$event->register('user_pm_read', 'nodejs_pm_event_user_pm_read_callback');

/**
 * Event callback after triggering "user_pm_sent".
 *
 * @param array $info
 *  Details about private message.
 */
function nodejs_pm_event_user_pm_sent_callback($info)
{
	$to = (int) $info['pm_to'];

	if($to > 0)
	{
		e107_require_once(e_PLUGIN . 'nodejs/nodejs.main.php');
		$plugPrefs = e107::getPlugConfig('nodejs_pm')->getPref();

		// If show alert messages.
		if((int) vartrue($plugPrefs['nodejs_pm_alert']) === 1)
		{
			$template = e107::getTemplate('nodejs_pm');
			$sc = e107::getScBatch('nodejs_pm', true);
			$tp = e107::getParser();

			$sc_vars = array(
				'account' => e107::user($info['pm_from']),
				'pm'      => $info,
			);

			$sc->setVars($sc_vars);
			$markup = $tp->parseTemplate($template['ALERT'], true, $sc);

			$message = (object) array(
				'channel'  => 'nodejs_user_' . $to,
				'callback' => 'pmNodejsAlert',
				'type'     => 'new_pm',
				'markup'   => $markup,
				'action' => 'new_pm',
			);
			nodejs_enqueue_message($message);
		}

		// Count unread messages of targeted user.
		$db = e107::getDb();
		$new = $db->count('private_msg', '(*)', "WHERE pm_read = 0 AND pm_to = '" . $to . "' AND pm_read_del != 1");
		if($new)
		{
			// Push the number of unread messages to client.
			$message = (object) array(
				'channel'  => 'nodejs_user_' . $to,
				'callback' => 'pmNodejsMenu',
				'type'     => 'pmNodejsMenu',
				'data'     => $new,
				'delay'    => 3000,
			);
			nodejs_enqueue_message($message);
		}
	}
}

/**
 * Event callback after triggering "user_pm_read".
 *
 * @param int $pm_id
 *  PM ID.
 */
function nodejs_pm_event_user_pm_read_callback($pm_id = 0)
{
	$pm_id = (int) $pm_id;

	if($pm_id > 0)
	{
		$db = e107::getDb();
		$plugPrefs = e107::getPlugConfig('nodejs_pm')->getPref();

		// Notify sender.
		// If show alert messages.
		if((int) vartrue($plugPrefs['nodejs_pm_alert_read']) === 1)
		{
			$pm_from = $db->retrieve('private_msg', 'pm_from', 'pm_id = ' . $pm_id);
			$pm_to = $db->retrieve('private_msg', 'pm_to', 'pm_id = ' . $pm_id);
			if((int) $pm_from > 0 && (int) $pm_to > 0)
			{
				e107_require_once(e_PLUGIN . 'nodejs/nodejs.main.php');

				$template = e107::getTemplate('nodejs_pm');
				$sc = e107::getScBatch('nodejs_pm', true);
				$tp = e107::getParser();

				$sc_vars = array(
					'account' => e107::user($pm_to),
					'pm'      => array(),
				);

				$sc->setVars($sc_vars);
				$markup = $tp->parseTemplate($template['ALERT_READ'], true, $sc);

				$message = (object) array(
					'channel'  => 'nodejs_user_' . (int) $pm_from,
					'callback' => 'pmNodejsAlert',
					'type'     => 'read_pm',
					'markup'   => $markup,
					'delay'    => 5000,
				);
				nodejs_enqueue_message($message);
			}
		}

		// Update counter in menu.
		$pm_to = $db->retrieve('private_msg', 'pm_to', 'pm_id = ' . $pm_id);
		if((int) $pm_to > 0)
		{
			e107_require_once(e_PLUGIN . 'nodejs/nodejs.main.php');

			// Count unread messages of targeted user.
			$new = $db->count('private_msg', '(*)', "WHERE pm_read = 0 AND pm_to = '" . (int) $pm_to . "' AND pm_read_del != 1");

			// Push the number of unread messages to client.
			$message = (object) array(
				'channel'  => 'nodejs_user_' . (int) $pm_to,
				'callback' => 'pmNodejsMenu',
				'type'     => 'pmNodejsMenu',
				'data'     => (int) $new,
				'delay'    => 5000,
			);
			nodejs_enqueue_message($message);
		}
	}
}
