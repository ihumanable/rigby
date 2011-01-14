<?php

/**
 * Extend the base fActiveRecord to put in common timestamp code
 * @see ActiveRecord
 * @see fORMDate
 * @author Matt Nowack
 * @package Rigby
 */
class rActiveRecord extends fActiveRecord {
  
  /**
   * Sets up the created_at and updated_at timestamp for all ActiveRecord objects
   * @see rORMDate::configureDateCreatedColumn()
   * @see rORMDate::configureDateUpdatedColumn()
   * @see fActiveRecord::configure()
   * @return nothing
   */
  protected function configure() {
    rORMDate::configureDateCreatedColumn($this, 'created_at');
    rORMDate::configureDateUpdatedColumn($this, 'updated_at');
  }
  
}