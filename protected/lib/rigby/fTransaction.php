<?php

/**
 * Database Transaction helper class
 * @see fORMDatabase
 * @author Matt Nowack
 * @package Rigby
 */
class fTransaction {
  
  /** 
   * Begins a database transaction
   * @see fORMDatabase::retrieve()
   * @return nothing
   */
  static function begin() {
    fORMDatabase::retrieve()->execute('begin');
  }
  
  /** 
   * Commits a database transaction
   * @see fORMDatabase::retrieve()
   * @return nothing
   */
  static function commit() {
    fORMDatabase::retrieve()->execute('commit');
  }
  
  /** 
   * Rolls back a database transaction
   * @see fORMDatabase::retrieve()
   * @return nothing
   */
  static function rollback() {
    fORMDatabase::retrieve()->execute('rollback');
  }
  
}

?>