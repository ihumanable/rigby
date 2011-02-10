<?php

//We need to get a hold of the application class
$root = realpath(dirname(__FILE__));
include $root . '/foundation/fApplication.php';
include $root . '/foundation/fRigby.php';

//Now that we have the rApplication class we can use it to set up our application
fApplication::setPath('source', realpath(dirname(__FILE__) . '/../../../') . '/');
  fApplication::setSubpath('source', 'error');
  fApplication::setSubpath('source', 'protected');
    fApplication::setSubpath('protected', 'config');
      fApplication::setSubpath('config', 'environments');
    fApplication::setSubpath('protected', 'database');
    fApplication::setSubpath('protected', 'lib');
      fApplication::setSubpath('lib', 'classes');
      fApplication::setSubpath('lib', 'flourish');
      fApplication::setSubpath('lib', 'rigby');
        fApplication::setSubpath('rigby', 'foundation');
    fApplication::setSubpath('protected', 'scripts');
  fApplication::setSubpath('source', 'resources');
    fApplication::setSubpath('resources', 'css');
    fApplication::setSubpath('resources', 'images');
    fApplication::setSubpath('resources', 'js');
    fApplication::setSubpath('resources', 'sass');
    fApplication::setSubpath('resources', 'templates');

fRigby::registerClass('ActiveRecord');
fRigby::registerClass('fAJAX');
fRigby::registerClass('fApplication');
fRigby::registerClass('fErrors');
fRigby::registerClass('fResponse');
fRigby::registerClass('fRigby');
fRigby::registerClass('fRouter');
fRigby::registerClass('fTransaction');
fRigby::registerClass('fValues');

/**
 * Special Rigby __autoload function which handles core, Rigby, and Flourish classes
 * @param string $class The class to autoload
 */
function __autoload($class) {
  if(fRigby::isRegistered($class)) {
    $candidate = fApplication::getPath('foundation', $class . '.php');
  } else if($class[0] === 'f') {
    $candidate = fApplication::getPath('flourish', $class . '.php');
  } else {
    $candidate = fApplication::getPath('classes', $class . '.php');
  }
  
  if(is_file($candidate)) {
    include $candidate;
    return;
  } else {
    throw new Exception('The class ' . $class . ' could not be loaded');
  }
}

include fApplication::getPath('config', 'environment.config.php');
include fApplication::getPath('config', 'common.config.php');
include fApplication::getPath('environments', fApplication::getEnvironment() . '.config.php');

/**
 * At this point all filesystem constants are set up and all classes should be automatically accessible.
 */