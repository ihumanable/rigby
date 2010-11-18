<?php
/**
 * The environment.config.php configuration has one purpose, to set up the environment constants
 * 
 * In a multi hosted environment you can define the URL_SUFFIX, this is useful for shared hosting and local development
 *
 * Leave the URL_SUFFIX blank if on a dedicated host, the code in common.config.php will understand this
 *
 * This file should be deployed once to an environment, this will cause route.php to load the correct environment configuration.
 */
  
  /**
   * ENVIRONMENT - The human readable environment flag.  This will also determine what configuration file will be loaded.
   */
  define('ENVIRONMENT', 'development');
  
  /** 
   * URL_SUFFIX - An optional suffix useful for shared hosting, non-root installs, and local development.
   */
  define('URL_SUFFIX', 'rigby');
  
  define('TIMEZONE', 'UTC');

?>