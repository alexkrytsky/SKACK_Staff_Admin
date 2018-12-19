<?php
/**
 * Log.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 3/7/18
 */

require_once 'DBTable.php';
require_once 'DB.php';

class Logging extends DBTable {

  # GET QUERIES\
  const QUERY_FROM_ID = "SELECT * FROM Logging WHERE id = :id LIMIT 1;";
  const QUERY_ALL = "SELECT * FROM Logging ORDER BY timestamp DESC ;";

  const INSERT_LOG = "INSERT INTO Logging (message) VALUES (:message);";

  protected $id,
    $timestamp,
    $message;

  /**
   * @param int $id
   * @return Logging|bool
   */
  public static function query_from_id( int $id ) {
    return self::queryOne( self::QUERY_FROM_ID, array( ':id' => $id ) );
  }

  /**
   * @return Logging[]
   */
  public static function query_all(){
    return self::queryAll(self::QUERY_ALL);
  }

  public static function insert_log( $message){
    try {
      $db = new DB();
      $stmt = $db->prepare( self::INSERT_LOG );
      $stmt->bindParam( ':message', $message, PDO::PARAM_STR );
      return $stmt->execute();
    } catch ( PDOException $ex ) {
      die( $ex->getMessage() . PHP_EOL . $ex->getTraceAsString() );
    }
  }

  /**
   * @return int
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @return string
   */
  public function getTimestamp() {
    return $this->timestamp;
  }

  /**
   * @param string $timestamp
   */
  public function setTimestamp( $timestamp ) {
    $this->timestamp = $timestamp;
  }

  /**
   * @return string
   */
  public function getMessage() {
    return $this->message;
  }

  /**
   * @param string $message
   */
  public function setMessage( $message ) {
    $this->message = $message;
  }



}