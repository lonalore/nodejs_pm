<?php

/**
 * @file
 * Templates for plugins displays.
 */

$NODEJS_PM_TEMPLATE['MENU'] = '
<ul class="nav navbar-nav navbar-right nodejs-pm" id="nodejs-pm">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
            <span class="badge">{NEWCOUNT}</span>
            <b class="caret"></b>
        </a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="nodejs-pm">
            <li role="presentation" class="nav-header dropdown-header">{HEADER}</li>
	        <li role="presentation">
	            {INBOX}
            </li>
	        <li role="presentation">
	            {OUTBOX}
            </li>
	        <li role="presentation">
	            {COMPOSE}
            </li>
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

$NODEJS_PM_TEMPLATE['ALERT_READ'] = '
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
        {MESSAGE_READ}
    </div>
  </div>
</div>
';
