<?php
/**
 * @file
 * Templates for plugins displays.
 */

$NODEJS_PM_TEMPLATE['MENU'] = '
<ul class="nav navbar-nav navbar-right" id="nodejs-pm">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
            <span class="badge"></span>
            <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li></li>
        </ul>
    </li>
</ul>';

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
