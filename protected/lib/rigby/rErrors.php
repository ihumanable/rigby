<?php

/**
 * Error registry to persist errors across requests
 * @see rSession
 * @author Matt Nowack
 * @package Rigby
 */
class rErrors {
  private static $errors;
  private static $init = false;
  
  /**
   * If needed, initialize the static $errors member
   * Initializing also clears the values out of session so they don't become "sticky"
   * @return nothing
   */
  static function init() {
    if(!self::$init) {
      self::$errors = rSession::get('rigby-errors', array());
      self::$init = true;
      rSession::delete('rigby-errors');
    }
  }
  
  /**
   * Resets both reading and writing
   * @return nothing
   */
  static function reset() {
    rSession::delete('rigby-errors');
    self::$errors = array();
    self::$init = false;
  }
  
  /**
   * Get the value out of the session
   * @see rErrors::init()
   * @param string $key The key to retrieve
   * @param optional mixed $default The value to return if the key can not be found, defaults to null
   * @return mixed The value if the key is present, $default otherwise
   */
  static function get($key, $default = null) {
    self::init();
    if(array_key_exists($key, self::$errors)) {
      return self::$errors[$key];
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
    self::init();
    self::$errors[$key] = $value;
  }
  
  /** 
   * Writes the internal array into session
   * @return nothing
   */
  static function persist() {
    rSession::set('rigby-errors', self::$errors);
  }
}