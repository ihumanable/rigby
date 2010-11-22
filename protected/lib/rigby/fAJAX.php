<?php

/**
 * Helper class to respond from Asynchronous Handlers
 * @see fJSON
 * @author Matt Nowack
 * @package Rigby
 */
class fAJAX {
  
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
   * @see fJSON::output()
   * @param string $status The status to report back
   * @param string $message The message to report back
   * @return nothing
   */
  static function message($status, $message) {
    fJSON::output(array('status' => $status,
                        'message' => $message));
    exit();
  }
  
}