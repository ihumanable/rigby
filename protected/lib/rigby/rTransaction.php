<?php

/**
 * Database Transaction helper class
 * @see rORMDatabase
 * @author Matt Nowack
 * @package Rigby
 */
class rTransaction {
  
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