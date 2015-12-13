<?php
/**
 * @file
 * Class installations to handle configuration forms on Admin UI.
 */

require_once('../../class2.php');

if(!getperms('P'))
{
  header('location:' . e_BASE . 'index.php');
  exit;
}

// [PLUGINS]/nodejs_pm/languages/[LANGUAGE]/[LANGUAGE]_admin.php
e107::lan('nodejs_pm', true, true);


/**
 * Class nodejs_pm_admin.
 */
class nodejs_pm_admin extends e_admin_dispatcher
{

  protected $modes = array(
      'main' => array(
          'controller' => 'nodejs_pm_admin_ui',
          'path'       => null,
      ),
  );

  protected $adminMenu = array(
      'main/prefs' => array(
          'caption' => LAN_NPMA_01,
          'perm'    => 'P',
      ),
  );

  protected $menuTitle = LAN_PLUGIN_NODEJS_PM_NAME;

}


/**
 * Class nodejs_pm_admin.
 */
class nodejs_pm_admin_ui extends e_admin_ui
{

  protected $pluginTitle = LAN_PLUGIN_NODEJS_PM_NAME;
  protected $pluginName  = "nodejs_pm";
  protected $preftabs    = array(
      LAN_NPMA_01,
  );
  protected $prefs       = array(
      'nodejs_pm_alert'      => array(
          'title'      => LAN_NPMA_02,
          'type'       => 'boolean',
          'writeParms' => 'label=yesno',
          'data'       => 'int',
          'tab'        => 0,
      ),
      'nodejs_pm_alert_read' => array(
          'title'      => LAN_NPMA_06,
          'type'       => 'boolean',
          'writeParms' => 'label=yesno',
          'data'       => 'int',
          'tab'        => 0,
      ),
      'nodejs_pm_length'     => array(
          'title'       => LAN_NPMA_03,
          'description' => LAN_NPMA_04,
          'type'        => 'number',
          'data'        => 'int',
          'tab'         => 0,
      ),
      'nodejs_pm_sound'      => array(
          'title'      => LAN_NPMA_05,
          'type'       => 'boolean',
          'writeParms' => 'label=yesno',
          'data'       => 'int',
          'tab'        => 0,
      ),
  );
}


new nodejs_pm_admin();

require_once(e_ADMIN . "auth.php");
e107::getAdminUI()->runPage();
require_once(e_ADMIN . "footer.php");
exit;
