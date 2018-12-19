<?php
/**
 * PhysicalLimitation.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/17/18
 */

require_once 'DBTable.php';
require_once 'DB.php';

class PhysicalLimitation extends DBTable {

  # GET QUERIES
  const QUERY_FROM_CLIENT = "SELECT * FROM Clients_Physical_Limitations WHERE client_id = :client_id;";
  const QUERY_FROM_ID = "SELECT * FROM Clients_Physical_Limitations WHERE id = :id LIMIT 1;";

  const QUERY_UPDATE = "UPDATE Clients_Physical_Limitations SET 
  limitation = :limitation,
  active = :active
  WHERE id = :id;";

  protected $id,
    $client_id,
    $limitation,
    $active;

  /**
   * @param int $client_id
   * @return PhysicalLimitation[]
   */
  public static function query_from_client( $client_id ) {
    return self::queryAll( self::QUERY_FROM_CLIENT, array( ':client_id' => $client_id ) );
  }


  /**
   * @param int $id
   * @return PhysicalLimitation|bool
   */
  public static function query_from_id( $id ) {
    return self::queryOne( self::QUERY_FROM_ID, array( ':id' => $id ) );
  }

  /**
   * @param int $client_id
   * @param array $request
   * @return bool|PhysicalLimitation
   */
  static function insert( $client_id, $request ) {
    if ( isset( $request[ 'limitation' ] ) ) {
      $limitation = $request[ 'limitation' ];
    } else {
      return false;
    }

    return self::queryOne( "CALL insert_client_physical_limitation(:client_id, :limitation);", array(
      ':client_id' => $client_id,
      ':limitation' => $limitation
    ) );
  }

  public function update() {
    try {
      $db = new DB();
      $stmt = $db->prepare( self::QUERY_UPDATE );
      $stmt->bindParam( ':limitation', $this->limitation, PDO::PARAM_STR );
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
  public function getLimitation() {
    return $this->limitation;
  }

  /**
   * @param string $limitation
   */
  public function setLimitation( $limitation ) {
    $this->limitation = $limitation;
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