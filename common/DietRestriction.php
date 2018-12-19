<?php
/**
 * DietRestriction.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/17/18
 */

require_once 'DBTable.php';
require_once 'DB.php';

class DietRestriction extends DBTable {

  # GET QUERIES
  const QUERY_FROM_CLIENT = "SELECT * FROM Clients_Diet_Restrictions WHERE client_id = :client_id;";
  const QUERY_FROM_ID = "SELECT * FROM Clients_Diet_Restrictions WHERE id = :id LIMIT 1;";

  const QUERY_UPDATE = "UPDATE Clients_Diet_Restrictions SET 
  restriction = :restriction,
  active = :active
  WHERE id = :id;";

  protected $id,
    $client_id,
    $restriction,
    $active;


  /**
   * @param int $client_id
   * @return DietRestriction[]
   */
  public static function query_from_client( $client_id ) {
    return self::queryAll( self::QUERY_FROM_CLIENT, array( ':client_id' => $client_id ) );
  }


  /**
   * @param int $id
   * @return DietRestriction|bool
   */
  public static function query_from_id( $id ) {
    return self::queryOne( self::QUERY_FROM_ID, array( ':id' => $id ) );
  }

  static function insert( $client_id, $request ) {
    if ( isset( $request[ 'restriction' ] ) ) {
      $restriction = $request[ 'restriction' ];
    } else {
      return false;
    }

    return self::queryOne( "CALL insert_client_diet_restriction(:client_id, :restriction);", array(
      ':client_id' => $client_id,
      ':restriction' => $restriction
    ) );
  }

  public function update() {
    try {
      $db = new DB();
      $stmt = $db->prepare( self::QUERY_UPDATE );
      $stmt->bindParam( ':restriction', $this->restriction, PDO::PARAM_STR );
      $stmt->bindParam( ':active', $this->active, PDO::PARAM_BOOL);
      $stmt->bindParam( ':id', $this->id, PDO::PARAM_INT );
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
   * @return int
   */
  public function getClientId() {
    return $this->client_id;
  }

  /**
   * @param int $client_id
   */
  public function setClientId( $client_id ) {
    $this->client_id = $client_id;
  }

  /**
   * @return string
   */
  public function getRestriction() {
    return $this->restriction;
  }

  /**
   * @param string $restriction
   */
  public function setRestriction( $restriction ) {
    $this->restriction = $restriction;
  }

  /**
   * @return bool
   */
  public function isActive() {
    return $this->active;
  }

  /**
   * @param bool $active
   */
  public function setActive( $active ) {
    $this->active = $active;
  }
}