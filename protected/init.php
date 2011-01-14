<?php

//We need to get a hold of the rApplication class
$applicationSource = realpath(dirname(__FILE__) . '/../') . '/protected/lib/rigby/rApplication.php';
include $applicationSource;

//Now that we have the rApplication class we can use it to set up our application
rApplication::setPath('source', realpath(dirname(__FILE__) . '/../') . '/');
  rApplication::setSubpath('source', 'error');
  rApplication::setSubpath('source', 'protected');
    rApplication::setSubpath('protected', 'config');
    rApplication::setSubpath('protected', 'database');
    rApplication::setSubpath('protected', 'lib');
      rApplication::setSubpath('lib', 'classes');
      rApplication::setSubpath('lib', 'flourish');
      rApplication::setSubpath('lib', 'rigby');
    rApplication::setSubpath('protected', 'scripts');
  rApplication::setSubpath('source', 'resources');
    rApplication::setSubpath('resources', 'css');
    rApplication::setSubpath('resources', 'images');
    rApplication::setSubpath('resources', 'js');
    rApplication::setSubpath('resources', 'sass');
    rApplication::setSubpath('resources', 'templates');

include rApplication::getPath('config', 'rigby.config.php');
include rApplication::getPath('config', 'environment.config.php');
include rApplication::getPath('config', 'common.config.php');
include rApplication::getPath('config', rApplication::getEnvironment() . '.config.php');

/**
 * At this point all filesystem constants are set up and all classes should be automatically accessible.
 */