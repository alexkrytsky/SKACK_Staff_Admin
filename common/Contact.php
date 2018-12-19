<?php
/**
 * Contact.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/17/18
 */

require_once 'DBTable.php';
require_once 'DB.php';

class Contact extends DBTable {

  # GET QUERIES
  const QUERY_FROM_CLIENT = "SELECT * FROM Clients_Contacts WHERE client_id = :client_id;";
  const QUERY_FROM_ID = "SELECT * FROM Clients_Contacts WHERE contact_id = :contact_id LIMIT 1;";

  const QUERY_UPDATE = "UPDATE Clients_Contacts SET
    first_name = :first_name,
    last_name = :last_name,
    relation = :relation,
    email = :email,
    phone = :phone,
    address = :address,
    address_city = :address_city,
    address_zip = :address_zip,
    address_state = :address_state,
    active_contact = :active_contact
  WHERE contact_id = :contact_id";

  protected $contact_id,
    $client_id,
    $first_name,
    $last_name,
    $relation,
    $email,
    $phone,
    $address,
    $address_city,
    $address_zip,
    $address_state,
    $active_contact;

  /**
   * @param int $client_id
   * @return Contact[]
   */
  public static function query_from_client( $client_id ) {
    return self::queryAll( self::QUERY_FROM_CLIENT, array( ':client_id' => $client_id ) );
  }

  /**
   * @param int $id
   * @return Contact|bool
   */
  static function query_from_id( $id ) {
    return self::queryOne( self::QUERY_FROM_ID, array( ':contact_id' => $id ) );
  }

  /**
   * @param int $client_id
   * @param array $request
   * @return Contact|bool
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
    if ( isset( $request[ 'relation' ] ) ) {
      $relation = $request[ 'relation' ];
    } else {
      return false;
    }
    if ( isset( $request[ 'email' ] ) ) {
      $email = $request[ 'email' ];
    } else {
      return false;
    }
    if ( isset( $request[ 'phone' ] ) ) {
      $phone = $request[ 'phone' ];
    } else {
      return false;
    }
    if ( isset( $request[ 'address' ] ) ) {
      $address = $request[ 'address' ];
    } else {
      return false;
    }
    if ( isset( $request[ 'address_city' ] ) ) {
      $address_city = $request[ 'address_city' ];
    } else {
      return false;
    }
    if ( isset( $request[ 'address_zip' ] ) ) {
      $address_zip = $request[ 'address_zip' ];
    } else {
      return false;
    }
    if ( isset( $request[ 'address_state' ] ) ) {
      $address_state = $request[ 'address_state' ];
    } else {
      return false;
    }

    return self::queryOne( "CALL insert_client_contact(:client_id, :first_name, :last_name, :relation, :email, :phone, :address, :address_city, :address_zip, :address_state);", array(
      ':client_id' => $client_id,
      ':first_name' => $first_name,
      ':last_name' => $last_name,
      ':relation' => $relation,
      ':email' => $email,
      ':phone' => $phone,
      ':address' => $address,
      ':address_city' => $address_city,
      ':address_zip' => $address_zip,
      ':address_state' => $address_state
    ) );
  }

  public function update() {
    try {
      $db = new DB();
      $stmt = $db->prepare( self::QUERY_UPDATE );
      $stmt->bindParam( ':first_name', $this->first_name, PDO::PARAM_STR );
      $stmt->bindParam( ':last_name', $this->last_name, PDO::PARAM_STR );
      $stmt->bindParam( ':relation', $this->relation, PDO::PARAM_STR );
      $stmt->bindParam( ':email', $this->email, PDO::PARAM_STR );
      $stmt->bindParam( ':phone', $this->phone, PDO::PARAM_INT );
      $stmt->bindParam( ':address', $this->address, PDO::PARAM_STR );
      $stmt->bindParam( ':address_city', $this->address_city, PDO::PARAM_STR );
      $stmt->bindParam( ':address_zip', $this->address_zip, PDO::PARAM_STR );
      $stmt->bindParam( ':address_state', $this->address_state, PDO::PARAM_STR );
      $stmt->bindParam( ':contact_id', $this->contact_id, PDO::PARAM_INT );
      $stmt->bindParam( ':active_contact', $this->active_contact, PDO::PARAM_BOOL );
      return $stmt->execute();
    } catch ( PDOException $ex ) {
      die( $ex->getMessage() . PHP_EOL . $ex->getTraceAsString() );
    }
  }

  /**
   * @return int
   */
  public function getContactId() {
    return $this->contact_id;
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
  public function getRelation() {
    return $this->relation;
  }

  /**
   * @param string $relation
   */
  public function setRelation( $relation ) {
    $this->relation = $relation;
  }

  /**
   * @return string
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * @param string $email
   */
  public function setEmail( $email ) {
    $this->email = $email;
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
   * @return mixed
   */
  public function getAddressZip() {
    return $this->address_zip;
  }

  /**
   * @param mixed $address_zip
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