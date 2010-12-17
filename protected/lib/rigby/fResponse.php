<?php

/**
 * Provides common response functions
 * @author Matt Nowack
 * @package Rigby
 */
class fResponse {
  
  /**
   * Redirect with an error message
   * @see fResponse::message()
   * @see fErrors::persist()
   * @global BASE_URL The default base url of the application
   * @param array | string $message The message to display, if an array it will be turned into a suitable string for display
   * @param optional string $target The url to redirect to, defaults to BASE_URL
   * @return nothing
   */
  static function error($message, $target = BASE_URL) {
    fErrors::persist();
    self::message('error', $message, $target);
  }
  
  /**
   * Redirect with a success message
   * @see fResponse::message()
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
    fMessaging::create($type, $message);
    self::redirect($target);
  }
  
  /**
   * Perform a redirect with Value persistence, causes script to immediately terminate
   * @see fValues
   * @see fRouter::url()
   * @see fURL::redirect()
   * @param string $target The url to redirect to
   * @return nothing
   */
  static function redirect($target) {    
    fValues::reset();
    
    foreach($_GET as $key => $value) {
      fValues::set($key, $value);
    }
    
    foreach($_POST as $key => $value) {
      fValues::set($key, $value);
    }
    
    fValues::persist();
    
    fURL::redirect($target);
    exit();
  }
}