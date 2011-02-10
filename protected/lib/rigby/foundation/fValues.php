<?php

/** 
 * This class serializes form values on response so forms can be repopulated
 *
 * @see fSession
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
class fValues {
  private static $values;
  private static $init = false;
  private static $key = 'rigby-values';
  
  /**
   * Set the session key to use for registering values
   * @see fValues::reset()
   * @param string $key The key to use for the values registry
   * @return nothing
   */
  static function registerKey($key) {
    self::reset();
    self::$key = $key;
  }
  
  /**
   * If needed, initialize the static $values member
   * Initializing also clears the values out of session so they don't become "sticky"
   * @return nothing
   */
  static function init() {
    if(!self::$init) {
      self::$values = fSession::get(self::$key, array());
      self::$init = true;
      fSession::delete(self::$key);
    }
  }
  
  /**
   * Resets both reading and writing
   * @return nothing
   */
  static function reset() {
    rSession::delete(self::$key);
    self::$values = array();
    self::$init = false;
  }
  
  /**
   * Get the value out of the session
   * @see fValues::init()
   * @param string $key The key to retrieve
   * @param optional mixed $default The value to return if the key can not be found, defaults to null
   * @return mixed The value if the key is present, $default otherwise
   */
  static function get($key, $default = null) {
    self::init();
    if(array_key_exists($key, self::$values)) {
      return self::$values[$key];
    }
    return $default;
  } 
  
  /**
   * Sets a key to a value
   * @param string $key The key to set
   * @param mixed $value The value to set
   * @return nothing
   */
  static function set($key, $value) {
    self::$values[$key] = $value;
  }
  
  /**
   * Encodes all $_GET and $_POST values
   * @return nothing
   */
  static function encodeGlobals() {
    foreach($_GET as $key => $value) {
      fValues::set($key, $value);
    }
    
    foreach($_POST as $key => $value) {
      fValues::set($key, $value);
    }    
  }
  
  /** 
   * Encodes all $_GET and $_POST values and writes the internal array into session
   * @return nothing
   */
  static function persist() {
    fSession::set(self::$key, self::$values);
  }
  
}