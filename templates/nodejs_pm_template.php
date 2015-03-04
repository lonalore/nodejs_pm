<?php
/**
 * @file
 * Templates for plugins displays.
 */

$NODEJS_PM_TEMPLATE['MENU'] = '';

$NODEJS_PM_TEMPLATE['ALERT'] = '
<div class="wrapper-alert">
  <div class="close-button"></div>
  <div class="picture">
    {AVATAR}
  </div>
  <div class="body">
    <span class="username">
      {USERNAME}
    </span>
    <div class="message">
        {MESSAGE}
    </div>
    <div class="links">
      {LINKS}
    </div>
  </div>
</div>
';
