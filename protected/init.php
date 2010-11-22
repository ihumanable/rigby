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

include CONFIG_ROOT . 'rigby.config.php';
include CONFIG_ROOT . 'environment.config.php';
include CONFIG_ROOT . 'common.config.php';
include CONFIG_ROOT . ENVIRONMENT . '.config.php';

/**
 * At this point all filesystem constants are set up and all classes should be automatically accessible.
 */