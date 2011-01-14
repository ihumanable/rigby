<?php
  
  /**
   * Special Rigby __autoload function which handles core, Rigby, and Flourish classes
   * @param string $class The class to autoload
   */
  function __autoload($class) {
    if($class[0] === 'f') {
      $candidate = rApplication::getPath('flourish', $class . '.php');
    } else if($class[0] === 'r') {
      $candidate = rApplication::getPath('rigby', $class . '.php');
    } else {
      $candidate = rApplication::getPath('classes', $class . '.php');
    }

    if(is_file($candidate)) {
      include $candidate;
      return;
    } else {
      throw new Exception('The class ' . $class . ' could not be loaded');
    }
  }
  
  
?>