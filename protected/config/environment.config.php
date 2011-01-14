<?php
/**
 * The environment.config.php configuration has one purpose, to set up the environment constants
 * 
 * In a multi hosted environment you can define the suffix, this is useful for shared hosting and local development
 *
 * There is no need to set a suffix in a dedicated environment, the code in common.config.php will understand this
 *
 * If you wish to use a default timezone other than UTC, use rApplication::setTimezone()
 *
 * This file should be deployed once to an environment, this will cause route.php to load the correct environment configuration.
 */
  
  //The human readable environment flag.  This will also determine what configuration file will be loaded.
  rApplication::setEnvironment('development');
  
  //An optional suffix useful for shared hosting, non-root installs, and local development.
  rApplication::setSuffix('rigby');
  
  //Set up the Application Version
  rApplication::setVersion(0.1);
  
?>