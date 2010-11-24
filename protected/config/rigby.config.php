<?php
  
  /**
   * RIGBY_VERSION - The version number of the Rigby Framework
   */
  define('RIGBY_VERSION', '0.1');
  
  /**
   * Special Rigby __autoload function which handles core, Rigby, and Flourish classes
   * @param string $class The class to autoload
   */
  function __autoload($class) {
    if($class[0] === 'f') {
      if(in_array($class, array('ActiveRecord',
                                'fAJAX',
                                'fForm',
                                'fResponse',
                                'fRouter',
                                'fTransaction',
                                'fValues'       ))) {
        $candidate = RIGBY_ROOT . $class . '.php';
      } else {
        $candidate = FLOURISH_CLASS_ROOT . $class . '.php';
      }
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
  
  
?>