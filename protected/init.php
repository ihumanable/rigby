<?php

define('SRC_ROOT', realpath(dirname(__FILE__) . '/../') . '/');
  define('ERROR_ROOT', SRC_ROOT . 'error/');
  define('PROTECTED_ROOT', SRC_ROOT . 'protected/');
    define('CONFIG_ROOT', PROTECTED_ROOT . 'config/');
    define('DATABASE_ROOT', PROTECTED_ROOT . 'database/');
    define('LIB_ROOT', PROTECTED_ROOT . 'lib/');
      define('CLASS_ROOT', LIB_ROOT . 'classes/');
      define('RIGBY_ROOT', LIB_ROOT . 'rigby/');
      define('FLOURISH_ROOT', LIB_ROOT . 'flourish/');
        define('FLOURISH_CLASS_ROOT', FLOURISH_ROOT . 'classes/');
        define('FLOURISH_TEST_ROOT', FLOURISH_ROOT . 'tests/');
    define('SCRIPT_ROOT', PROTECTED_ROOT . 'scripts/');
  define('RESOURCE_ROOT', SRC_ROOT . 'resources/');
    define('CSS_ROOT', RESOURCE_ROOT . 'css/');
    define('IMAGE_ROOT', RESOURCE_ROOT . 'images/');
    define('JS_ROOT', RESOURCE_ROOT . 'js/');
    define('SASS_ROOT', RESOURCE_ROOT . 'sass/');
    define('TEMPLATE_ROOT', RESOURCE_ROOT . 'templates/');

/**
 * Special Rigby __autoload function which handles core, Rigby, and Flourish classes
 * @param string $class The class to autoload
 */
function __autoload($class) {
  if($class[0] === 'f') {
    $candidate = FLOURISH_CLASS_ROOT . $class . '.php';
  } else if($class[0] === 'r') {
    $candidate = RIGBY_ROOT . $class . '.php';
  } else {
    $candidate = CLASS_ROOT . $class . '.php';
  }
  
  if(is_file($candidate)) {
    include $candidate;
    return;
  } else {
    throw new Exception('The class ' . $class . ' could not be loaded');
  }
}

/**
 * At this point all filesystem constants are set up and all classes should be automatically accessible.
 */