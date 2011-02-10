<?php

/**
 * This class encapsulates the work of parsing and creating urls and links to reduce the amount of url building we need to do
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
class fRouter {
  private static $parsed = null;
  private static $routes = array();
  
  /**
   * Gets a saved route for a key
   * @param string $key The key to look up a route for
   * @param optional string $append A child to append to the route, defaults to ''
   * @return mixed The route if found, false otherwise
   */
  static function getRoute($key, $append = '') {
    if(array_key_exists($key, self::$routes)) {
      return self::$routes[$key] . $append;
    }
    return false;
  }
  
  /**
   * Sets a key to a saved route
   * @param string $key The key to use
   * @param string $route The route to save
   * @return nothing
   */
  static function setRoute($key, $route) {
    self::$routes[$key] = $route;
  }
  
  /**
   * Sets a subroute under an existing route
   * @see fRouter::getRoute()
   * @see fRouter::setRoute()
   * @param string $parent The parent key to create a subroute under
   * @param string $child The child key and directory
   * @return nothing
   */
  static function setSubroute($parent, $child) {
    $parentRoute = self::getRoute($parent);
    if($parentRoute) {
      self::setRoute($child, $parentRoute . $child . '/');
    }
  }
  
  /**
   * Helper function, self is common enough this shortcut is nice
   * @return string The current url
   */
  static function self() {
    return self::getRoute('self');
  }
  
  /**
   * Helper function, base is common enough this shortcut is nice
   * @return string The base url
   */
  static function base() {
    return self::getRoute('base');
  }
  
  /**
   * Parses the Request URI
   * This function memoizes its result so it is safe to call it multiple times without paying a penalty
   * @see fApplication::getSuffix()
   * @see fRouter::$parsed
   * @return array<string> The components of the URI broken into an array
   */
  static function parse() {
    if(self::$parsed === null) {    
      $elements = explode('/', fURL::get());
      
      //Remove the first element if blank
      if(count($elements)) {
        if(empty($elements[0])) {
          array_shift($elements);
        }
      }
      
      //Remove the URL_SUFFIX
      if(count($elements)) {
        if($elements[0] == fApplication::getSuffix()) {
          array_shift($elements);
        }
      }
      
      //Remove the last element if blank
      if(count($elements)) {
        if(empty($elements[count($elements) - 1])) {
          array_pop($elements);
        }
      }
      
      self::$parsed = $elements;
    }
    return self::$parsed;
  }
  
  /**
   * Returns the array of reserved actions.
   *
   * @return array<string> Reserved actions.
   */
  static function reserved() {
    return array('new',       // GET  resource/new
                 'create',    // POST resource/new
                 'edit',      // GET  resource/$id/edit
                 'update',    // POST resource/$id/edit
                 'delete',    // GET  resource/$id/delete
                 'destroy',   // POST resource/$id/delete
                 'view',      // GET  resource/$id
                 'process',   // POST resource/$id
                 'index',     // GET  resource/
                 'post');     // POST resource/
  }
  
  
  /**
   * Creates a fully qualified url from a collection of parts
   * Ex:
   *  fRouter::url('cart', 'items', 8) => http://example.com/cart/items/8/
   * @see fRouter::base()
   * @param mixed varargs The parts of the url to put together
   * @return string The fully qualified url
   */
  static function url() {
    $result = self::base();
    $arguments = func_get_args();
    if(is_array($arguments)) {
      foreach($arguments as $argument) {
        if(is_array($argument)) {
          $result .= '?' . implode('&', $argument);
        } else {
          $result .= $argument . (strpos($argument, '?') === false ? '/' : '');
        }
      }
    }
    return $result;
  }
  
  /**
   * Adds segments onto the current url
   * Ex:
   *  At http://example.com/cart/items/
   *  fRouter::push('new') => http://example.com/cart/items/new/
   *  fRouter::push(7, 'edit') => http://example.com/cart/items/7/edit/
   * @see fRouter::self()
   * @param mixed varargs Segments to add
   * @return string The url with the action added
   */
  static function push() {
    $result = self::self();
    $arguments = func_get_args();
    if(is_array($arguments)) {
      foreach($arguments as $argument) {
        if(is_array($argument)) {
          $result .= '?' . implode('&', $argument);
        } else {
          $result .= $argument . (strpos($argument, '?') === false ? '/' : '');
        }
      }
    }
    return $result;
  }
  
  /**
   * Pops segments off a url and returns the result
   * @see fRouter::self()
   * @param optional int $count The number of segments to remove, defaults to 1
   * @param optional string $url The url to pop, defaults to fRouter::self()
   * @return string The remaining url
   */
  static function pop($count = 1, $url = null) {
    $url = ($url ? $url : self::self());
    
    $parse = explode('/', $url);
    array_pop($parse);
    
    for($i = 0; $i < $count; ++$i) {
      array_pop($parse);
    }
    
    return implode('/', $url);
  }
  
  /**
   * Route to the error handle for a certain HTTP error code
   * @see fResponse::redirect()
   * @param integer $code The HTTP error code to handle
   * @return nothing
   */
  static function error($code) {
    fResponse::redirect(self::url('error', $code));
  }
}