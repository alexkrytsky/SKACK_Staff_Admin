<?php
/**
 * Account.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/17/18
 */

require_once 'DBTable.php';
require_once 'Client.php';

class Account extends DBTable {
  protected $account_id;
  protected $email;
  protected $first_name;
  protected $last_name;
  protected $salt;
  protected $password;
  protected $is_staff;
  protected $is_admin;
  protected $account_created;

  /**
   * @param string $email
   * @return Account|bool
   */
  public static function query_from_email( $email ) {
    return self::queryOne( "CALL query_account_email(:email);",
      array( ':email' => $email ) );
  }

  /**
   * @param int $account_id
   * @return Account|bool
   */
  public static function query_from_id( $account_id ) {
    return self::queryOne( "CALL query_account_id(:account_id);",
      array( ':account_id' => $account_id ) );
  }

  /**
   * @return Account[]
   */
  public static function query_all() {
    return self::queryAll( "CALL query_account_all();" );
  }

  /**
   * @return Account[]
   */
  public static function query_staff() {
    return self::queryAll( "CALL query_account_staff();" );
  }

  /**
   * @return Account[]
   */
  public static function query_participants() {
    return self::queryAll( "CALL query_account_participants();" );
  }

  /**
   * @param array $changes
   * @return Account|bool
   */
  public function update( $changes ) {
    if ( isset( $changes[ 'email' ] ) && !empty( $changes[ 'email' ] ) ) {
      $this->setEmail( $changes[ 'email' ] );
    }

    if ( isset( $changes[ 'first_name' ] ) && !empty( $changes[ 'first_name' ] ) ) {
      $this->setFirstName( $changes[ 'first_name' ] );
    }

    if ( isset( $changes[ 'last_name' ] ) && !empty( $changes[ 'last_name' ] ) ) {
      $this->setLastName( $changes[ 'last_name' ] );
    }

    if ( isset( $changes[ 'salt' ] ) && !empty( $changes[ 'salt' ] ) ) {
      $this->setSalt( $changes[ 'salt' ] );
    }

    if ( isset( $changes[ 'password' ] ) && !empty( $changes[ 'password' ] ) ) {
      $this->setPassword( $changes[ 'password' ] );
    }

    if ( isset( $changes[ 'is_staff' ] ) && !empty( $changes[ 'is_staff' ] ) ) {
      $this->setIsStaff( $changes[ 'is_staff' ] );
    }

    if ( isset( $changes[ 'is_admin' ] ) && !empty( $changes[ 'is_admin' ] ) ) {
      $this->setIsAdmin( $changes[ 'is_admin' ] );
    }

    return self::queryOne( "CALL update_account_id(:account_id, :email, :first_name, :last_name, :salt, :password, :is_staff, :is_admin);",
      array(
        ":account_id" => $this->getAccountId(),
        ":email" => $this->getEmail(),
        ":first_name" => $this->getFirstName(),
        ":last_name" => $this->getLastName(),
        ":salt" => $this->getSalt(),
        ":password" => $this->getPassword(),
        ":is_staff" => ( $this->isStaff() ? 1 : 0 ),
        ":is_admin" => ( $this->isAdmin() ? 1 : 0 )
      ) );
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
  public function getSalt() {
    return $this->salt;
  }

  /**
   * @param string $salt
   */
  public function setSalt( $salt ) {
    $this->salt = $salt;
  }

  /**
   * @return string
   */
  public function getPassword() {
    return $this->password;
  }

  /**
   * @param string $password
   */
  public function setPassword( $password ) {
    $this->password = $password;
  }

  /**
   * @return bool
   */
  public function isStaff() {
    return $this->is_staff;
  }

  /**
   * @param bool $is_staff
   */
  public function setIsStaff( $is_staff ) {
    $this->is_staff = $is_staff;
  }

  /**
   * @return bool
   */
  public function isAdmin() {
    return $this->is_admin;
  }

  /**
   * @param bool $is_admin
   */
  public function setIsAdmin( $is_admin ) {
    $this->is_admin = $is_admin;
  }

  /**
   * @return string
   */
  public function getAccountCreated() {
    return $this->account_created;
  }

  /**
   * @param string $account_created
   */
  public function setAccountCreated( $account_created ) {
    $this->account_created = $account_created;
  }
}

class Participant extends Account {
  const QUERY_FROM_ACCOUNT_ID = "SELECT * FROM Clients 
    INNER JOIN Account ON Clients.account_id = Account.account_id WHERE Account.account_id = :account_id LIMIT 1;";

  const QUERY_FROM_CLIENT_ID = "SELECT * FROM Clients 
    INNER JOIN Account ON Clients.account_id = Account.account_id WHERE client_id = :client_id LIMIT 1;";

  const QUERY_FROM_EMAIL = "SELECT * FROM Clients 
    INNER JOIN Account ON Clients.account_id = Account.account_id WHERE email = :email LIMIT 1;";

  const QUERY_ALL = "SELECT * FROM Clients 
    INNER JOIN Account ON Clients.account_id = Account.account_id";

  const QUERY_DATA_TABLE = "SELECT client_id, CONCAT(last_name, ', ', first_name) AS name, email, phone, last_update FROM Clients
    INNER JOIN Account ON Clients.account_id = Account.account_id;";

  protected $client_id,
    $middle_name,
    $phone,
    $address,
    $address_city,
    $address_zip,
    $address_state,
    $last_update,
    $active_client;


  /**
   * @return Participant[]
   */
  public static function query_all() {
    return self::queryAll( self::QUERY_ALL );
  }

  /**
   * @param int $offset
   * @param string $search
   * @param string $column
   * @param bool $order
   * @return Participant[]
   */
  public static function query_search( $offset = 0, $search = "", $column = "name", $order = true ) {
    return self::queryAll( "CALL query_participant_search(:search, :offset, :column, :order);",
      array(
        ':search' => $search,
        ':offset' => $offset,
        ':column' => $column,
        ':order' => ( $order ? 1 : 0 )
      ) );
  }

//  /**
//   * @return Participant[]
//   */
//  public static function query_for_data_table(): array {
//    try {
//      $db = new DB();
//      $stmt = $db->prepare( self::QUERY_DATA_TABLE );
//      $stmt->execute();
//      $data = $stmt->fetchAll( PDO::FETCH_CLASS, 'Participant' );
//      return $data;
//    } catch ( PDOException $ex ) {
//      die( $ex->getMessage() . '\n' . $ex->getTraceAsString() );
//    }
//  }

  /**
   * @param int $account_id
   * @return Participant|bool
   */
  public static function query_from_account_id( $account_id ) {
    return self::queryOne( self::QUERY_FROM_ACCOUNT_ID, array( ':account_id' => $account_id ) );
  }

  /**
   * @param int $client_id
   * @return Participant|bool
   */
  public static function query_from_client_id( $client_id ) {
    return self::queryOne( self::QUERY_FROM_CLIENT_ID, array( ':client_id' => $client_id ) );
  }

  /**
   * @param string $email
   * @return Participant|bool
   */
  public static function query_from_account_email( $email ) {
    return self::queryOne( self::QUERY_FROM_EMAIL, array( ':email' => $email ) );
  }

  /**
   * @param array $request
   * @return Participant|bool
   */
  public static function insert( $request ) {
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
    if ( isset( $request[ 'middle_name' ] ) ) {
      $middle_name = $request[ 'middle_name' ];
    } else {
      $middle_name = "";
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
    if ( isset( $request[ 'salt' ] ) ) {
      $salt = $request[ 'salt' ];
    } else {
      $salt = dechex( mt_rand( 0, 2147483647 ) ) . dechex( mt_rand( 0, 2137483647 ) );
    }
    if ( isset( $request[ 'password' ] ) ) {
      $password = $request[ 'password' ];
    } else {
      $password = dechex( mt_rand( 0, 2147483647 ) ) . dechex( mt_rand( 0, 2137483647 ) );
      for ( $round = 0; $round < 65537; $round++ ) {
        $password = hash( 'sha256', $password . $salt );
      }
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
    if ( isset( $request[ 'is_staff' ] ) ) {
      $is_staff = $request[ 'is_staff' ] ? 1 : 0;
    } else {
      $is_staff = 0;
    }

    return self::queryOne( "CALL insert_participant(:first_name, :last_name, :middle_name, :email, :phone, :password, :salt, :address, :address_city, :address_zip, :address_state, :is_staff)",
      array(
        ':first_name' => $first_name,
        ':last_name' => $last_name,
        ':middle_name' => $middle_name,
        ':email' => $email,
        ':phone' => $phone,
        ':password' => $password,
        ':salt' => $salt,
        ':address' => $address,
        ':address_city' => $address_city,
        ':address_zip' => $address_zip,
        ':address_state' => $address_state,
        ':is_staff' => $is_staff
      ) );
  }

  /**
   * @param array $changes
   * @return bool
   */
  public function update( $changes ) {
    if ( $this->get_client()->update( $changes ) )
      if ( $this->get_account()->update( $changes ) instanceof Account )
        return true;
    return false;
  }

  /**
   * Create a client object based of this Participants current fields.
   *
   * @return Client
   */
  public function get_client() {
    $client = Client::query_from_id( $this->getClientId() );
    $client->setMiddleName( $this->getMiddleName() );
    $client->setPhone( $this->getPhone() );
    $client->setAddress( $this->getAddress() );
    $client->setAddressCity( $this->getAddressCity() );
    $client->setAddressZip( $this->getAddressZip() );
    $client->setAddressState( $this->getAddressState() );
    $client->setLastUpdate( $this->getLastUpdate() );
    $client->setActiveClient( $this->isActiveClient() );
    return $client;
  }

  /**
   * Create a account object based of this Participants current fields.
   *
   * @return Account
   */
  public function get_account() {
    $account = Account::query_from_id( $this->getAccountId() );
    $account->setEmail( $this->getEmail() );
    $account->setFirstName( $this->getFirstName() );
    $account->setLastName( $this->getLastName() );
    $account->setPassword( $this->getPassword() );
    $account->setIsStaff( $this->isStaff() );
    $account->setIsAdmin( $this->isAdmin() );
    $account->setAccountCreated( $this->getAccountCreated() );
    return $account;
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