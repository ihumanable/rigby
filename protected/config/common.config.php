<?php

/**
 * The common configuration is where non-environment specific application configuration goes.
 */

rRouter::setRoute('self', rURL::getDomain() . $_SERVER['REQUEST_URI'] . (substr($_SERVER['REQUEST_URI'], -1) == '/' ? '' : '/'));
rRouter::setRoute('base', rURL::getDomain() . '/' . (rApplication::getSuffix() ? rApplication::getSuffix() . '/' : ''));
  rRouter::setSubroute('base', 'error');
  rRouter::setSubroute('base', 'resources');
    rRouter::setSubroute('resources', 'css');
    rRouter::setSubroute('resources', 'images');
    rRouter::setSubroute('resources', 'js');

//Set up the default timezone
date_default_timezone_set(rApplication::getTimezone());

//Open the session here to avoid header errors
rSession::open();

//Set up timestamp formats
rTimestamp::defineFormat('atom', DATE_ATOM);
rTimestamp::defineFormat('cookie', DATE_COOKIE);
rTimestamp::defineFormat('iso8601', DATE_ISO8601);
rTimestamp::defineFormat('rfc822', DATE_RFC822);
rTimestamp::defineFormat('rfc850', DATE_RFC850);
rTimestamp::defineFormat('rfc1036', DATE_RFC1036);
rTimestamp::defineFormat('rfc1123', DATE_RFC1123);
rTimestamp::defineFormat('rfc2822', DATE_RFC2822);
rTimestamp::defineFormat('rss', DATE_RSS);
rTimestamp::defineFormat('w3c', DATE_W3C);
rTimestamp::defineFormat('american_date', 'm/d/Y');
rTimestamp::defineFormat('american_time', 'g:i a');
rTimestamp::defineFormat('american_datetime', 'm/d/Y g:i a');
rTimestamp::defineFormat('european_date', 'd/m/Y');
rTimestamp::defineFormat('european_time', 'g:i a');
rTimestamp::defineFormat('european_datetime', 'd/m/Y g:i a');
rTimestamp::defineFormat('computer_date', 'Y-m-d');
rTimestamp::defineFormat('computer_time', 'H:i');
rTimestamp::defineFormat('computer_datetime', 'Y-m-d H:i');

//Set up templating
$page = new rTemplating(rApplication::getPath('templates'));

//Pre-load the common partials
$page->set('header', 'header.tpl.php');
$page->set('footer', 'footer.tpl.php');
$page->set('secured', 'secured.tpl.php');

//Set up the common styles
$page->add('css', array('path' => rRouter::getRoute('css', 'blueprint/screen.css'), 'media' => 'screen, projection'));
$page->add('css', array('path' => rRouter::getRoute('css', 'blueprint/print.css'), 'media' => 'print'));
$page->add('css', array('path' => rRouter::getRoute('css', 'base/screen.css'), 'media' => 'screen, projection'));
$page->add('css', array('path' => rRouter::getRoute('css', 'base/print.css'), 'media' => 'print'));

?>