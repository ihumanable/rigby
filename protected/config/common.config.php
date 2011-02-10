<?php

/**
 * The common configuration is where non-environment specific application configuration goes.
 */

fRouter::setRoute('self', fURL::getDomain() . $_SERVER['REQUEST_URI'] . (substr($_SERVER['REQUEST_URI'], -1) == '/' ? '' : '/'));
fRouter::setRoute('base', fURL::getDomain() . '/' . (fApplication::getSuffix() ? fApplication::getSuffix() . '/' : ''));
  fRouter::setSubroute('base', 'error');
  fRouter::setSubroute('base', 'resources');
    fRouter::setSubroute('resources', 'css');
    fRouter::setSubroute('resources', 'images');
    fRouter::setSubroute('resources', 'js');

//Set up the default timezone
date_default_timezone_set(fApplication::getTimezone());

//Open the session here to avoid header errors
fSession::open();

//Set up timestamp formats
fTimestamp::defineFormat('atom', DATE_ATOM);
fTimestamp::defineFormat('cookie', DATE_COOKIE);
fTimestamp::defineFormat('iso8601', DATE_ISO8601);
fTimestamp::defineFormat('rfc822', DATE_RFC822);
fTimestamp::defineFormat('rfc850', DATE_RFC850);
fTimestamp::defineFormat('rfc1036', DATE_RFC1036);
fTimestamp::defineFormat('rfc1123', DATE_RFC1123);
fTimestamp::defineFormat('rfc2822', DATE_RFC2822);
fTimestamp::defineFormat('rss', DATE_RSS);
fTimestamp::defineFormat('w3c', DATE_W3C);
fTimestamp::defineFormat('american_date', 'm/d/Y');
fTimestamp::defineFormat('american_time', 'g:i a');
fTimestamp::defineFormat('american_datetime', 'm/d/Y g:i a');
fTimestamp::defineFormat('european_date', 'd/m/Y');
fTimestamp::defineFormat('european_time', 'g:i a');
fTimestamp::defineFormat('european_datetime', 'd/m/Y g:i a');
fTimestamp::defineFormat('computer_date', 'Y-m-d');
fTimestamp::defineFormat('computer_time', 'H:i');
fTimestamp::defineFormat('computer_datetime', 'Y-m-d H:i');

//Set up templating
$page = new fTemplating(fApplication::getPath('templates'));

//Pre-load the common partials
$page->set('header', 'header.tpl.php');
$page->set('footer', 'footer.tpl.php');
$page->set('secured', 'secured.tpl.php');

//Set up the common styles
$page->add('css', array('path' => fRouter::getRoute('css', 'blueprint/screen.css'), 'media' => 'screen, projection'));
$page->add('css', array('path' => fRouter::getRoute('css', 'blueprint/print.css'), 'media' => 'print'));
$page->add('css', array('path' => fRouter::getRoute('css', 'base/screen.css'), 'media' => 'screen, projection'));
$page->add('css', array('path' => fRouter::getRoute('css', 'base/print.css'), 'media' => 'print'));

?>