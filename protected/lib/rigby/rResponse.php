<?php

/**
 * Provides common response functions
 * @author Matt Nowack
 * @package Rigby
 */
class rResponse {
  
  /**
   * Redirect with an error message
   * @see rResponse::message()
   * @see rErrors::persist()
   * @global BASE_URL The default base url of the application
   * @param array | string $message The message to display, if an array it will be turned into a suitable string for display
   * @param optional string $target The url to redirect to, defaults to BASE_URL
   * @return nothing
   */
  static function error($message, $target = BASE_URL) {
    rErrors::persist();
    self::message('error', $message, $target);
  }
  
  /**
   * Redirect with a success message
   * @see rResponse::message()
   * @see BASE_URL The default base url of the application
   * @param array | string $message The message to display, if an array it will be turned into a suitable string for display
   * @param optional string $target The url to redirect to, default to BASE_URL
   * @return nothing
   */
  static function success($message, $target = BASE_URL) {
    self::message('success', $message, $target);
  }
  
  /**
   * Perform a redirect with a flash message
   * @see fMessaging::create()
   * @see fResponse::redirect()
   * @param string $type The type of message to create
   * @param array | string $message The message to display, if an array it will be turned into a suitable string for display
   * @param string $target The url to redirect to
   * @return nothing
   */
  static function message($type, $message, $target) {
    if(is_array($message)) {
      $message = '<ul><li>' . implode('</li><li>', $message) . '</li></ul>';
    }
    rMessaging::create($type, $message);
    self::redirect($target);
  }
  
  /**
   * Perform a redirect with Value persistence, causes script to immediately terminate
   * @see rValues
   * @see rRouter::url()
   * @see rURL::redirect()
   * @param string $target The url to redirect to
   * @return nothing
   */
  static function redirect($target) {    
    rValues::reset();
    
    foreach($_GET as $key => $value) {
      rValues::set($key, $value);
    }
    
    foreach($_POST as $key => $value) {
      rValues::set($key, $value);
    }
    
    rValues::persist();
    
    rURL::redirect($target);
    exit();
  }
}