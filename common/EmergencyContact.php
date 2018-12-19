<?php
/**
 * EmergencyContact.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/17/18
 */

require_once 'DBTable.php';
require_once 'DB.php';

class EmergencyContact extends DBTable {

  # GET QUERIES
  const QUERY_FROM_CLIENT = "SELECT * FROM Clients_Emergency_Contacts WHERE client_id = :client_id;";
  const QUERY_FROM_ID = "SELECT * FROM Clients_Emergency_Contacts WHERE emergency_contact_id = :id LIMIT 1;";

  const QUERY_UPDATE = "UPDATE Clients_Emergency_Contacts SET
    first_name = :first_name, 
    last_name = :last_name, 
    phone = :phone, 
    alternate_phone = :alternate_phone,
    active_contact = :active_contact
  WHERE emergency_contact_id = :id";

  protected $emergency_contact_id,
    $client_id,
    $first_name,
    $last_name,
    $phone,
    $alternate_phone,
    $active_contact;


  /**
   * @param int $client_id
   * @return EmergencyContact[]
   */
  public static function query_from_client( $client_id ) {
    return self::queryAll( self::QUERY_FROM_CLIENT, array( ':client_id' => $client_id ) );
  }


  /**
   * @param int $id
   * @return EmergencyContact|bool
   */
  public static function query_from_id( $id ) {
    return self::queryOne( self::QUERY_FROM_ID, array( ':id' => $id ) );
  }

  /**
   * @param $client_id int
   * @param $request array
   * @return EmergencyContact|bool
   */
  static function insert( $client_id, $request ) {
    if ( isset( $request[ 'first_name' ] ) ) {
      $first_name = $request[ 'first_name' ];
    } else {
      return false;
    }
    if ( isset( $request[ 'last_name' ] ) ) {
      $last_name = $request[ 'last_name' ];
    } else {
      return false;
    }
    if ( isset( $request[ 'phone' ] ) ) {
      $phone = $request[ 'phone' ];
    } else {
      return false;
    }
    if ( isset( $request[ 'alternate_phone' ] ) ) {
      $alternate_phone = $request[ 'alternate_phone' ];
    } else {
      return false;
    }

    return self::queryOne( "CALL insert_client_emergency_contact(:client_id, :first_name, :last_name, :phone, :alternate_phone);", array(
      ':client_id' => $client_id,
      ':first_name' => $first_name,
      ':last_name' => $last_name,
      ':phone' => $phone,
      ':alternate_phone' => $alternate_phone
    ) );
  }

  public function update() {
    try {
      $db = new DB();
      $stmt = $db->prepare( self::QUERY_UPDATE );
      $stmt->bindParam( ':first_name', $this->first_name, PDO::PARAM_STR );
      $stmt->bindParam( ':last_name', $this->last_name, PDO::PARAM_STR );
      $stmt->bindParam( ':phone', $this->phone, PDO::PARAM_INT );
      $stmt->bindParam( ':alternate_phone', $this->alternate_phone, PDO::PARAM_INT );
      $stmt->bindParam( ':active_contact', $this->active_contact, PDO::PARAM_BOOL);
      $stmt->bindParam( ':id', $this->emergency_contact_id, PDO::PARAM_INT );
      return $stmt->execute();
    } catch ( PDOException $ex ) {
      die( $ex->getMessage() . PHP_EOL . $ex->getTraceAsString() );
    }
  }

  /**
   * @return int
   */
  public function getEmergencyContactId() {
    return $this->emergency_contact_id;
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
  public function getFirstName() {
    return $this->first_name;
  }

  /**
   * @param string $first_name
   */
  public function setFirstName( $first_name ) {
    $this->first_name = $first_name;
  }

  /**
   * @return string
   */
  public function getLastName() {
    return $this->last_name;
  }

  /**
   * @param string $last_name
   */
  public function setLastName( $last_name ) {
    $this->last_name = $last_name;
  }

  /**
   * @return string
   */
  public function getPhone() {
    return $this->phone;
  }

  /**
   * @param string $phone
   */
  public function setPhone( $phone ) {
    $this->phone = $phone;
  }

  /**
   * @return string
   */
  public function getAlternatePhone() {
    return $this->alternate_phone;
  }

  /**
   * @param string $alternate_phone
   */
  public function setAlternatePhone( $alternate_phone ) {
    $this->alternate_phone = $alternate_phone;
  }

  /**
   * @return bool
   */
  public function isActiveContact() {
    return $this->active_contact;
  }

  /**
   * @param bool $active_contact
   */
  public function setActiveContact( $active_contact ) {
    $this->active_contact = $active_contact;
  }
}