<?php

/**
 * Helper class to respond from Asynchronous Handlers
 * @see rJSON
 * @author Matt Nowack
 * @package Rigby
 */
class rAJAX {
  
  /**
   * Reply with an error message
   * @see AJAX::message()
   * @param string $message The message to report back
   * @return nothing
   */
  static function error($message) {
    self::message('error', $message);
  }
  
  /**
   * Reply with a success message
   * @see AJAX::message()
   * @param string $message The message to report back
   * @return nothing
   */
  static function success($message) {
    self::message('success', $message);
  }
  
  /**
   * Reply with a message
   * @see rJSON::output()
   * @param string $status The status to report back
   * @param string $message The message to report back
   * @return nothing
   */
  static function message($status, $message) {
    rAJAX::output(array('status' => $status,
                        'message' => $message));
  }
  
  static function output($object) {
    rJSON::output($object);
    exit();
  }
  
}