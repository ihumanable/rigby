<?php

/**
 * The fIdentity class allows for easy User management by creating a 
 * persistent, clean, identity system
 *
 * @see fAuthorization
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
class fIdentity {
  
  /**
   * Sets a type of identity, this allows multiple Authorizable entities to coexist 
   * within an application.  Modeled after the fAuthorization::setUserToken() function.
   * @see fAuthorization::setUserToken()
   * @see fSession::regenerateID()
   * @param string $type The type identifier
   * @param mixed $token An identification token
   * @param optional boolean $persistent Flag for long term persistence of identity information, defaults to true
   * @return nothing
   */
  function set($type, $token, $persistent = true) {
    fSession::set(__CLASS__ . '::' . $type . '::token', $token);
    fSession::regenerateID();
    if($persistent) {
      fSession::enablePersistence();
    }
  }
  
  /**
   * Gets a token for a given type of identity.
   * @see fIdentity::set()
   * @param string $type The type identifier
   * @return mixed The stored token, if no token is available returns null
   */
  function get($type) {
    return fSession::get(__CLASS__ . '::' . $type . '::token', null);
  }
  
  /**
   * Destroys identity information for a given type
   * @see fIdentity::set()
   * @param string $type The type identifier
   * @return nothing
   */
  function destroy($type) {
    fSession::delete(__CLASS__ . '::' . $type . '::token');
  }
}