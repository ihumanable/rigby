<?php

/**
 * The Application holds global information in a contained and easily accesible way
 * @author Matt Nowack
 * @package Rigby
 */
class rApplication {
  private static $environment = null;
  private static $paths = array();
  private static $suffix = null;
  private static $timezone = 'UTC';
  private static $version = null;
  
  /**
   * Gets a path for a key
   * @param string $key The key to lookup
   * @param optional string $append file in path, defaults to ''
   * @return mixed The string if the key is set, false otherwise
   */
  public static function getPath($key, $append = '') {
    if(array_key_exists($key, self::$paths)) {
      return self::$paths[$key] . $append;
    }
    return false;
  }
  
  /**
   * Saves a path to a certain key
   * @param string $key The key to save
   * @param string $path The path to associate with the key
   * @return nothing
   */
  public static function setPath($key, $path) {
    self::$paths[$key] = $path;
  }
  
  /**
   * Saves a subpath under an existing key
   * @see rApplication::getPath()
   * @see rApplication::setPath()
   * @param string $parent The existing key
   * @param string $child The child directory name and the key to use for the new path entry
   * @return nothing
   */
  public static function setSubpath($parent, $child) {
    $parentPath = self::getPath($parent);
    if($parentPath) {
      self::setPath($child, $parentPath . $child . '/');
    }
  }
  
  /**
   * Gets the environment string
   * @return string The environment string
   */
  public static function getEnvironment() {
    return self::$environment;
  }
  
  /**
   * Sets up the environment string
   * @param string $environment The environment string
   * @return nothing
   */
  public static function setEnvironment($environment) {
    self::$environment = $environment;
  }
  
  /**
   * Gets the application version number
   * @return float The application version number
   */
  public static function getVersion() {
    return self::$version;
  }
  
  /**
   * Sets the application version number
   * @param float $version The version number
   * @return nothing
   */
  public static function setVersion($version) {
    self::$version = $version;
  }
  
  /**
   * Gets the rigby version number
   * @return float The rigby version number
   */
  public static function getRigbyVersion() {
    return 0.1;
  }
  
  /**
   * Gets the url suffix
   * @return mixed suffix if it was set, null otherwise
   */
  public static function getSuffix() {
    return self::$suffix;
  }

  /**
   * Sets the url suffix
   * @param string $suffix The url suffix
   * @return nothing
   */
  public static function setSuffix($suffix) {
    self::$suffix = $suffix;
  }
  
  /**
   * Gets the application timezone
   * @return string Timezone identifier
   */
  public static function getTimezone() {
    return self::$timezone;
  }
  
  /**
   * Sets the application timezone
   * @param string $timezone The timezone identifier
   */
  public static function setTimezone($timezone) {
    self::$timezone = $timezone;
  }
}