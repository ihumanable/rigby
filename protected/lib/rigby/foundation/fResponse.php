<?php

/**
 * Provides common response functions
 *
 * @see fErrors
 * @see fValues
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
class fResponse {
  
  /**
   * Redirect with an error message
   * @see fResponse::message()
   * @see fErrors::persist()
   * @see fValues::persist()
   * @see fRouter::base()
   * @param array | string $message The message to display, if an array it will be turned into a suitable string for display
   * @param optional string $target The url to redirect to, defaults to BASE_URL
   * @return nothing
   */
  static function error($message, $target = null) {
    $target = ($target ? $target : fRouter::base());
    fErrors::persist();
    fValues::persist();
    self::message('error', $message, $target);
  }
  
  /**
   * Redirect with a success message
   * @see fResponse::message()
   * @see fRouter::base()
   * @param array | string $message The message to display, if an array it will be turned into a suitable string for display
   * @param optional string $target The url to redirect to, default to BASE_URL
   * @return nothing
   */
  static function success($message, $target = null) {
    $target = ($target ? $target : fRouter::base());
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
   * @see fURL::redirect()
   * @param string $target The url to redirect to
   * @return nothing
   */
  static function redirect($target) {    
    fURL::redirect($target);
    exit();
  }
}