<?php
/**
 * #####################################################################################################################
 * Client.php
 *
 * Queries can be executed using the static methods to get data, or insert data once populated.
 *
 * Author: Caleb Snoozy
 * Date: 2/15/18
 * #####################################################################################################################
 */

require_once 'DBTable.php';
require_once 'Contact.php';
require_once 'DietRestriction.php';
require_once 'EmergencyContact.php';
require_once 'MedicalAlert.php';
require_once 'Medication.php';
require_once 'PhysicalLimitation.php';
require_once 'DB.php';

/** Class Client PHP Representation of the Clients Table. */
class Client extends DBTable {

### GET QUERIES ########################################################################################################

  /** Request all clients from the database, does not check active status. */
  const QUERY_ALL = "SELECT * FROM Clients;";

  /** Request a client from the database via ID. */
  const QUERY_FROM_ID = "SELECT * FROM Clients WHERE client_id = :client_id LIMIT 1;";

### POST QUERIES #######################################################################################################

  /** Update a client's data. */
  const QUERY_UPDATE = "UPDATE Clients SET 
  middle_name = :middle_name, 
  phone = :phone, 
  address = :address,
  address_city = :address_city,
  address_zip = :address_zip, 
  address_state = :address_state, 
  last_update = :last_update,
  active_client = :active_client
  WHERE client_id = :client_id;";

  /** Insert a Client based of this object. */
  const QUERY_INSERT = "INSERT INTO Clients (
    middle_name, 
    phone, 
    address, 
    address_city, 
    address_zip, 
    address_state, 
    last_update, 
    active_client
    ) VALUE (
    :middle_name, 
    :phone, 
    :address, 
    :address_city, 
    :address_zip, 
    :address_state, 
    :last_update, 
    :active_client
    )";

  protected $client_id,
    $account_id,
    $middle_name,
    $phone,
    $address,
    $address_city,
    $address_zip,
    $address_state,
    $last_update,
    $active_client;


  /**
   * @param $client_id int Client Id.
   * @return Client|bool
   */
  static function query_from_id( $client_id ) {
    return self::queryOne( self::QUERY_FROM_ID, array( ':client_id' => $client_id ) );
  }


  /** @return Client[] Requests All Clients. */
  public static function query_All() {
    return self::queryAll( self::QUERY_ALL );
  }

  /**
   * Update matching client in the database.
   *
   * @param array $changes
   * @return bool True if successful.
   */
  public function update( $changes ) {
    if ( isset( $changes[ 'middle_name' ] ) && !empty( $changes[ 'middle_name' ] ) ) {
      $this->setMiddleName( $changes[ 'middle_name' ] );
    }

    if ( isset( $changes[ 'phone' ] ) && !empty( $changes[ 'phone' ] ) ) {
      $this->setPhone( $changes[ 'phone' ] );
    }

    if ( isset( $changes[ 'address' ] ) && !empty( $changes[ 'address' ] ) ) {
      $this->setAddress( $changes[ 'address' ] );
    }

    if ( isset( $changes[ 'address_city' ] ) && !empty( $changes[ 'address_city' ] ) ) {
      $this->setAddressCity( $changes[ 'address_city' ] );
    }

    if ( isset( $changes[ 'address_zip' ] ) && !empty( $changes[ 'address_zip' ] ) ) {
      $this->setAddressZip( $changes[ 'address_zip' ] );
    }

    if ( isset( $changes[ 'address_state' ] ) && !empty( $changes[ 'address_state' ] ) ) {
      $this->setAddressState( $changes[ 'address_state' ] );
    }

    if ( isset( $changes[ 'last_update' ] ) && !empty( $changes[ 'last_update' ] ) ) {
      $this->setLastUpdate( $changes[ 'last_update' ] );
    }

    if ( isset( $changes[ 'active_client' ] ) && !empty( $changes[ 'active_client' ] ) ) {
      $this->setActiveClient( $changes[ 'active_client' ] );
    }

    try {
      $db = new DB();
      $stmt = $db->prepare( self::QUERY_UPDATE );
      $stmt->bindParam( ':middle_name', $this->middle_name, PDO::PARAM_STR );
      $stmt->bindParam( ':phone', $this->phone, PDO::PARAM_INT );
      $stmt->bindParam( ':address', $this->address, PDO::PARAM_STR );
      $stmt->bindParam( ':address_city', $this->address_city, PDO::PARAM_STR );
      $stmt->bindParam( ':address_zip', $this->address_zip, PDO::PARAM_STR );
      $stmt->bindParam( ':address_state', $this->address_state, PDO::PARAM_STR );
      $stmt->bindParam( ':last_update', $this->last_update, PDO::PARAM_STR );
      $stmt->bindParam( ':active_client', $this->active_client, PDO::PARAM_BOOL );
      $stmt->bindParam( ':client_id', $this->client_id, PDO::PARAM_INT );
      return $stmt->execute();
    } catch ( PDOException $ex ) {
      die( $ex->getMessage() . PHP_EOL . $ex->getTraceAsString() );
    }
  }

  /**
   * @return Contact[] This clients contacts.
   */
  public function get_contacts() {
    return Contact::query_from_client( $this->client_id );
  }


  /**
   * @param int $id Specific Contacts ID.
   * @return Contact Specified Contact.
   */
  public function get_contact( $id ) {
    return Contact::query_from_id( $id );
  }

  /**
   * @return EmergencyContact[] This Clients Emergency Contacts.
   */
  public function get_emergency_contacts() {
    return EmergencyContact::query_from_client( $this->client_id );
  }

  /**
   * @param int $id Specific Emergency Contacts ID.
   * @return EmergencyContact Specified Emergency Contact.
   */
  public function get_emergency_contact( $id ) {
    return EmergencyContact::query_from_id( $id );
  }

  /**
   * @return MedicalAlert[] Clients Medical Alerts.
   */
  public function get_medical_alerts() {
    return MedicalAlert::query_from_client( $this->client_id );
  }

  /**
   * @param int $id Specific Alert ID.
   * @return MedicalAlert Specified Alert.
   */
  public function get_medical_alert( $id ) {
    return MedicalAlert::query_from_id( $id );
  }

  /**
   * @return PhysicalLimitation[] Clients Physical Limitations.
   */
  public function get_physical_limitations() {
    return PhysicalLimitation::query_from_client( $this->client_id );
  }

  /**
   * @param int $id Specific Limitations ID.
   * @return PhysicalLimitation Specified Limitation.
   */
  public function get_physical_limitation( $id ) {
    return PhysicalLimitation::query_from_id( $id );
  }

  /**
   * @return DietRestriction[] Clients Diet Restrictions.
   */
  public function get_diet_restrictions() {
    return DietRestriction::query_from_client( $this->client_id );
  }

  /**
   * @param int $id Specific Restrictions ID.
   * @return DietRestriction Specified Restriction.
   */
  public function get_diet_restriction( $id ) {
    return DietRestriction::query_from_id( $id );
  }

  /**
   * @return Medication[] Clients Medications.
   */
  public function get_medications() {
    return Medication::query_from_client( $this->client_id );
  }

  /**
   * @param int $id Specific Medications ID.
   * @return Medication Specified Medication.
   */
  public function get_medication( $id ) {
    return Medication::query_from_id( $id );
  }

  /**
   * @return int
   */
  public function getClientId() {
    return $this->client_id;
  }

  /**
   * @return int
   */
  public function getAccountId() {
    return $this->account_id;
  }

  /**
   * @return string
   */
  public function getMiddleName() {
    return $this->middle_name;
  }

  /**
   * @param string $middle_name
   */
  public function setMiddleName( $middle_name ) {
    $this->middle_name = $middle_name;
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
  public function getAddress() {
    return $this->address;
  }

  /**
   * @param string $address
   */
  public function setAddress( $address ) {
    $this->address = $address;
  }

  /**
   * @return string
   */
  public function getAddressCity() {
    return $this->address_city;
  }

  /**
   * @param string $address_city
   */
  public function setAddressCity( $address_city ) {
    $this->address_city = $address_city;
  }

  /**
   * @return string
   */
  public function getAddressZip() {
    return $this->address_zip;
  }

  /**
   * @param string $address_zip
   */
  public function setAddressZip( $address_zip ) {
    $this->address_zip = $address_zip;
  }

  /**
   * @return string
   */
  public function getAddressState() {
    return $this->address_state;
  }

  /**
   * @param string $address_state
   */
  public function setAddressState( $address_state ) {
    $this->address_state = $address_state;
  }

  /**
   * @return string
   */
  public function getLastUpdate() {
    return $this->last_update;
  }

  /**
   * @param string $last_update
   */
  public function setLastUpdate( $last_update ) {
    $this->last_update = $last_update;
  }

  /**
   * @return bool
   */
  public function isActiveClient() {
    return $this->active_client;
  }

  /**
   * @param bool $active_client
   */
  public function setActiveClient( $active_client ) {
    $this->active_client = $active_client;
  }

}