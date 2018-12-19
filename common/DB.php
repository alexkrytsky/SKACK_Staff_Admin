<?php
/**
 * DB.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/19/18
 */

class DB extends PDO {
  const DB_HOST = '127.0.0.1';
  const DB_USER = 'jacadeve_php';
  const DB_PASS = '5]D2!Jtk[8c2';
  const DB_NAME = 'jacadeve_skcac_dev';
  const DB_CHAR = 'utf8';

  function __construct() {
    $opt = array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS,
      PDO::ATTR_EMULATE_PREPARES => TRUE
    );
    $dsn = 'mysql:host=' . static::DB_HOST . ';dbname=' . static::DB_NAME . ';charset=' . static::DB_CHAR;
    parent::__construct( $dsn, static::DB_USER, static::DB_PASS, $opt );
  }
}