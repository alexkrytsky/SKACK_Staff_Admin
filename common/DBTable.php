<?php
/**
 * DBTable.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/17/18
 */

abstract class DBTable {

  /**
   * Converts the object into a json string by converting it into an array of itself.
   *
   * @return string
   */
  public function to_json() {
    $result = array();
    foreach ( $this as $key => $value ) {
      $result[ $key ] = $value;
    }
    return json_encode( $result );
  }

  /**
   * Transforms the current data set into json and back for http sending.
   *
   * @return mixed
   */
  public function decode() {
    return json_decode( $this->to_json() );
  }

  /**
   * @param $query string
   * @param $args array|null
   * @return mixed
   */
  protected static final function queryOne( $query, $args = null ) {
    try {
      $db = new DB();
      $stmt = $db->prepare( $query );
      if ( $args !== null ) {
        foreach ( $args as $key => &$val ) {
          $stmt->bindParam( $key, $val, (is_numeric( $val ) ? PDO::PARAM_INT : PDO::PARAM_STR) );
        }
      }
      $stmt->execute();
      return $stmt->fetchObject( static::class );
    } catch ( PDOException $ex ) {
      return false;
    }
  }

  /**
   * @param $query string
   * @param $args array|null
   * @return array|mixed
   */
  protected static final function queryAll( $query, $args = null ) {
    try {
      $db = new DB();
      $stmt = $db->prepare( $query );
      if ( $args !== null ) {
        foreach ( $args as $key => &$val ) {
          $stmt->bindParam( $key, $val, (is_numeric( $val ) ? PDO::PARAM_INT : PDO::PARAM_STR) );
        }
      }
      $stmt->execute();
      $data = $stmt->fetchAll( PDO::FETCH_CLASS, static::class );
      return $data;
    } catch ( PDOException $ex ) {
      return false;
    }
  }
}