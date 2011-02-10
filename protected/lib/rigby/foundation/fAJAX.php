<?php

/**
 * Helper class to respond from Asynchronous Handlers
 *
 * @see fJSON
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
class fAJAX {
  
  /**
   * Reply with an error message
   * @see fAJAX::message()
   * @param string $message The message to report back
   * @return nothing
   */
  static function error($message) {
    self::message('error', $message);
  }
  
  /**
   * Reply with a success message
   * @see fAJAX::message()
   * @param string $message The message to report back
   * @return nothing
   */
  static function success($message) {
    self::message('success', $message);
  }
  
  /**
   * Reply with a message
   * @see fAJAX::output()
   * @param string $status The status to report back
   * @param string $message The message to report back
   * @return nothing
   */
  static function message($status, $message) {
    self::output(array('status' => $status,
                       'message' => $message));
  }
  
  /**
   * Outputs an object as a JSON object and exits execution
   * @see fJSON::output()
   * @param mixed $object The object to output
   * @return nothing
   */
  static function output($object) {
    fJSON::output($object);
    exit();
  }
  
}