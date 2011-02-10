<?php

/**
 * This class encapsulates the core of the Rigby Framework
 *
 * @copyright  Copyright (c) 2011 Matt Nowack
 * @author     Matt Nowack [mdn] <ihumanable@gmail.com>
 * @license    http://ihumanable.com/rigby/license
 * 
 * @package    Rigby
 * @link       http://ihumanable.com/rigby/
 * 
 * @version    1.0.0b
 */
class fRigby {
  private static $classes = array();
  private static $version = 0.1;
  
  /**
   * Registers a class as a Rigby Foundation class for autoloading
   * @param string $class The class to register
   * @return nothing
   */
  static function registerClass($class) {
    self::$classes[] = $class;
  }
  
  /**
   * Checks if a class is registered as a Rigby Foundation class
   * @param string $class The class to check
   * @return boolean True if registered, false otherwise
   */
  static function isRegistered($class) {
    return in_array($class, self::$classes);
  }
  
  /**
   * Avoid the overhead of autoloading by statically linking all registered classes
   * @return nothing
   */
  static function staticInclude() {
    foreach(self::$classes as $class) {
      include_once fApplication::getPath('foundation', $class . '.php');
    }
  }
  
  /**
   * Sets the Rigby version number
   * @param float $version The Rigby version number
   * @return nothing
   */
  static function setVersion($version) {
    self::$version = $version;
  }
  
  /**
   * Gets the Rigby version number
   * @return float The Rigby version number
   */
  static function getVersion() {
    return self::$version;
  }
}