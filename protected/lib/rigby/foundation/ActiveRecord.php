<?php

/**
 * ActiveRecord extension with normalized id helper and automatic timestamps
 *
 * @see fActiveRecord
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
class ActiveRecord extends fActiveRecord {
  /**
   * Helper function to retrieve the id of a record instead of having to use the ->getClassNameId() provided by fActiveRecord
   * @return integer The ActiveRecord id
   */
  function id() {
    $function = 'get' . get_class($this) . 'Id';
    return $this->$function();
  }
  
  /**
   * Sets up the created_at and updated_at timestamp for all ActiveRecord objects
   * @see fORMDate::configureDateCreatedColumn()
   * @see fORMDate::configureDateUpdatedColumn()
   * @see fActiveRecord::configure()
   * @return nothing
   */
  protected function configure() {
    fORMDate::configureDateCreatedColumn($this, 'created_at');
    fORMDate::configureDateUpdatedColumn($this, 'updated_at');
  }
  
}