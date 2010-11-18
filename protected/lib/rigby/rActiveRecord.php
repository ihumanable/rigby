<?php

/**
 * Extend the base fActiveRecord to put in common timestamp code
 * @see fActiveRecord
 * @see fORMDate
 * @author Matt Nowack
 * @package Rigby
 */
class rActiveRecord extends fActiveRecord {
  
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