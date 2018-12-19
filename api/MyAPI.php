<?php
/**
 * MyAPI.php
 *
 * Contains all of the endpoints for the api system.
 *
 * Author: Caleb Snoozy
 * Date: 2/16/18
 */

require_once '../common/index.php';
require_once '../common/Account.php';
require_once '../common/Client.php';
require_once 'API.php';

class MyAPI extends API {

  public function __construct( $request ) {
    try {
      parent::__construct( $request );
    } catch ( Exception $e ) {
      die( $e->getMessage() . PHP_EOL . $e->getTraceAsString() );
    }

    // Authentication Check
    verify_session( false );
  }

  protected function remove_participant() {
    if ( $this->method == 'GET' ) {
      if ( empty( $this->args ) || $this->args[ 0 ] <= 0 )
        return "Missing or Invalid Client ID";

      try {
        $id = $this->args[ 0 ];
        $participant = Participant::query_from_client_id( $id );
        $participant->setActiveClient( false );
        $_SESSION[ 'update_status' ] = $participant->update( array() );
        log_file( __FILE__, "Removed Participant with ID: " . $id );
        return "Update Successful";
      } catch ( Exception $ex ) {
        return "Update Failed";
      }
    } else {
      return "Invalid request";
    }
  }

  protected function remove_contact() {
    if ( $this->method == 'GET' ) {
      if ( empty( $this->args ) || $this->args[ 0 ] <= 0 )
        return "Missing or Invalid Contact ID";

      try {
        $id = $this->args[ 0 ];
        $contact = Contact::query_from_id( $id );
        $contact->setActiveContact( false );
        $_SESSION[ 'update_status' ] = $contact->update();
        log_file( 'remove_contact', "Removed Contact with ID: " . $id );
        return "Update Successful";
      } catch ( Exception $ex ) {
        return "Update Failed";
      }
    } else {
      return "Invalid request";
    }
  }

  protected function remove_emergency_contact() {
    if ( $this->method == 'GET' ) {
      if ( empty( $this->args ) || $this->args[ 0 ] <= 0 )
        return "Missing or Invalid Emergency Contact ID";

      try {
        $id = $this->args[ 0 ];
        $contact = EmergencyContact::query_from_id( $id );
        $contact->setActiveContact( false );
        $_SESSION[ 'update_status' ] = $contact->update();
        log_file( 'remove_emergency_contact', "Removed Emergency Contact with ID: " . $id );
        return "Update Successful";
      } catch ( Exception $ex ) {
        return "Update Failed";
      }
    } else {
      return "Invalid request";
    }
  }

  protected function remove_medication() {
    if ( $this->method == 'GET' ) {
      if ( empty( $this->args ) || $this->args[ 0 ] <= 0 )
        return "Missing or Invalid ID";

      try {
        $id = $this->args[ 0 ];
        $obj = Medication::query_from_id( $id );
        $obj->setActive( false );
        $_SESSION[ 'update_status' ] = $obj->update();
        log_file( 'remove_medication', "Removed Medication with ID: " . $id );
        return "Update Successful";
      } catch ( Exception $ex ) {
        return "Update Failed";
      }
    } else {
      return "Invalid request";
    }
  }

  protected function remove_medical_alert() {
    if ( $this->method == 'GET' ) {
      if ( empty( $this->args ) || $this->args[ 0 ] <= 0 )
        return "Missing or Invalid ID";

      try {
        $id = $this->args[ 0 ];
        $obj = MedicalAlert::query_from_id( $id );
        $obj->setActive( false );
        $_SESSION[ 'update_status' ] = $obj->update();
        log_file( 'remove_medical_alert', "Removed Medical Alert with ID: " . $id );
        return "Update Successful";
      } catch ( Exception $ex ) {
        return "Update Failed";
      }
    } else {
      return "Invalid request";
    }
  }

  protected function remove_physical_limitation() {
    if ( $this->method == 'GET' ) {
      if ( empty( $this->args ) || $this->args[ 0 ] <= 0 )
        return "Missing or Invalid ID";

      try {
        $id = $this->args[ 0 ];
        $obj = PhysicalLimitation::query_from_id( $id );
        $obj->setActive( false );
        $_SESSION[ 'update_status' ] = $obj->update();
        log_file( 'remove_physical_limitation', "Removed Physical Limitation with ID: " . $id );
        return "Update Successful";
      } catch ( Exception $ex ) {
        return "Update Failed";
      }
    } else {
      return "Invalid request";
    }
  }

  protected function remove_diet_restriction() {
    if ( $this->method == 'GET' ) {
      if ( empty( $this->args ) || $this->args[ 0 ] <= 0 )
        return "Missing or Invalid ID";

      try {
        $id = $this->args[ 0 ];
        $obj = DietRestriction::query_from_id( $id );
        $obj->setActive( false );
        $_SESSION[ 'update_status' ] = $obj->update();
        log_file( 'remove_diet_restriction', "Removed Diet Restriction with ID: " . $id );
        return "Update Successful";
      } catch ( Exception $ex ) {
        return "Update Failed";
      }
    } else {
      return "Invalid request";
    }
  }

  /**
   * Client api endpoint, allows inserting and extracting client data from the database
   * through ajax requests.
   *
   * /api/client
   *
   * @return array|mixed|string JSON array or object containing requested data or results.
   */
  protected function client() {
    // Check request method.
    if ( $this->method == 'GET' ) {

      // There is no default get action.
      if ( empty( $this->args ) || $this->args[ 0 ] <= 0 )
        return "Missing or Invalid Client ID";


      $id = $this->args[ 0 ];  // The ID passed in with the request.
      $client = Client::query_from_id( $id ); // Get Client from database.

      // GET /api/client/#
      if ( count( $this->args ) == 1 ) {
        return $client->decode();
      } // GET /api/client/#/
      else if ( count( $this->args ) == 2 ) {
        switch ( $this->args[ 1 ] ) {
          // List of the participants contacts.
          case 'contacts':
            $data = $client->get_contacts();
            break;
          // List if the participants diet restrictions.
          case 'diet_restrictions':
            $data = $client->get_diet_restrictions();
            break;
          // List of the participants emergency contacts.
          case 'emergency_contacts':
            $data = $client->get_emergency_contacts();
            break;
          // List of the participants medical alerts.
          case 'medical_alerts':
            $data = $client->get_medical_alerts();
            break;
          // List of the participants medications.
          case 'medications':
            $data = $client->get_medications();
            break;
          // List of the participants physical limitations.
          case 'physical_limitations':
            $data = $client->get_physical_limitations();
            break;
          // request was improperly formatted or invalid.
          default:
            return "Invalid argument";
        }
        return array_map( function ( DBTable $table ) {
          return $table->decode();
        }, $data );
      } else if ( count( $this->args ) == 3 ) { // return client addition info by id
        $id = $this->args[ 2 ];
        $data = null;
        switch ( $this->args[ 1 ] ) {
          case 'contact':
            $data = $client->get_contact( $id )->decode();
            break;
          case 'diet_restriction':
            $data = $client->get_diet_restriction( $id )->decode();
            break;
          case 'emergency_contact':
            $data = $client->get_emergency_contact( $id )->decode();
            break;
          case 'medical_alert':
            $data = $client->get_medical_alert( $id )->decode();
            break;
          case 'medication':
            $data = $client->get_medication( $id )->decode();
            break;
          case 'physical_limitation':
            $data = $client->get_physical_limitation( $id )->decode();
            break;
          default:
            return "Invalid argument";
        }
        return $data;
      } else {
        return "Invalid number of arguments";
      }
    } else if ( $this->method == 'POST' ) {
      if ( empty( $this->args ) || $this->args[ 0 ] <= 0 ) {
        $newParticipant = Participant::insert( $this->request );
        $_SESSION[ 'update_status' ] = $newParticipant instanceof Participant;
        header( "Location: /staff/dashboard/client/?client_id=" . $newParticipant->getClientId() );
        die();
      }
      $id = $this->args[ 0 ];  // Request Client ID
      $participant = Participant::query_from_client_id( $id ); // Get Participant from database

      if ( count( $this->args ) === 1 ) { // Participant update

        $_SESSION[ 'update_status' ] = $participant->update( $this->request );

        header( "Location: /staff/dashboard/client/?client_id=" . $participant->getClientId() );
        die();
      } else if ( count( $this->args ) === 2 ) { // Insert new Data
        switch ( $this->args[ 1 ] ) {
          case 'contact':
            $_SESSION[ 'update_status' ] = Contact::insert( $id, $this->request ) instanceof Contact;
            header( "Location: /staff/dashboard/client/?client_id=" . $participant->getClientId() );
            die();
            break;
          case 'diet_restriction':
            $_SESSION[ 'update_status' ] = DietRestriction::insert( $id, $this->request ) instanceof DietRestriction;
            header( "Location: /staff/dashboard/client/medical/?client_id=" . $participant->getClientId() );
            die();
            break;
          case 'emergency_contact':
            $_SESSION[ 'update_status' ] = EmergencyContact::insert( $id, $this->request ) instanceof EmergencyContact;
            header( "Location: /staff/dashboard/client/emergency/?client_id=" . $participant->getClientId() );
            die();
            break;
          case 'medical_alert':
            $_SESSION[ 'update_status' ] = MedicalAlert::insert( $id, $this->request ) instanceof MedicalAlert;
            header( "Location: /staff/dashboard/client/medical/?client_id=" . $participant->getClientId() );
            die();
            break;
          case 'medication':
            $_SESSION[ 'update_status' ] = Medication::insert( $id, $this->request ) instanceof Medication;
            header( "Location: /staff/dashboard/client/medical/?client_id=" . $participant->getClientId() );
            die();
            break;
          case 'physical_limitation':
            $_SESSION[ 'update_status' ] = PhysicalLimitation::insert( $id, $this->request ) instanceof PhysicalLimitation;
            header( "Location: /staff/dashboard/client/medical/?client_id=" . $participant->getClientId() );
            die();
            break;
          default:
            return "Invalid argument";
        }
      } else if ( count( $this->args ) === 3 ) { // Update additional Participant data
        $id = $this->args[ 2 ];
        switch ( $this->args[ 1 ] ) {
          case 'contact':
            $contact = $participant->get_contact( $id );

            $contact->setFirstName( $this->request[ 'first_name' ] );
            $contact->setLastName( $this->request[ 'last_name' ] );
            $contact->setRelation( $this->request[ 'relation' ] );
            $contact->setEmail( $this->request[ 'email' ] );
            $contact->setPhone( $this->request[ 'phone' ] );
            $contact->setAddress( $this->request[ 'address' ] );
            $contact->setAddressCity( $this->request[ 'address_city' ] );
            $contact->setAddressZip( $this->request[ 'address_zip' ] );
            $contact->setAddressState( $this->request[ 'address_state' ] );

            $_SESSION[ 'update_status' ] = $contact->update();
            header( "Location: /staff/dashboard/client/?client_id=" . $participant->getClientId() );
            die();
            break;
          case 'diet_restriction':
            $diet = $participant->get_diet_restriction( $id );

            $diet->setRestriction( $this->request[ 'restriction' ] );

            $_SESSION[ 'update_status' ] = $diet->update();

            header( "Location: /staff/dashboard/client/medical/?client_id=" . $participant->getClientId() );
            die();
            break;
          case 'emergency_contact':
            $contact = $participant->get_emergency_contact( $id );

            $contact->setFirstName( $this->request[ 'first_name' ] );
            $contact->setLastName( $this->request[ 'last_name' ] );
            $contact->setPhone( $this->request[ 'phone' ] );
            $contact->setAlternatePhone( $this->request[ 'alternate_phone' ] );

            $_SESSION[ 'update_status' ] = $contact->update();
            header( "Location: /staff/dashboard/client/emergency/?client_id=" . $participant->getClientId() );
            die();
            break;
          case 'medical_alert':
            $alert = $participant->get_medical_alert( $id );

            $alert->setAlert( $this->request[ 'alert' ] );

            $_SESSION[ 'update_status' ] = $alert->update();
            header( "Location: /staff/dashboard/client/medical/?client_id=" . $participant->getClientId() );
            die();
            break;
          case 'medication':
            $medication = $participant->get_medication( $id );

            $medication->setMedication( $this->request[ 'medication' ] );
            $medication->setDosage( $this->request[ 'dosage' ] );
            $medication->setFrequency( $this->request[ 'frequency' ] );
            $medication->setTimeTaken( $this->request[ 'time_taken' ] );

            $_SESSION[ 'update_status' ] = $medication->update();
            header( "Location: /staff/dashboard/client/medical/?client_id=" . $participant->getClientId() );
            die();
            break;
          case 'physical_limitation':
            $physical = $participant->get_physical_limitation( $id );

            $physical->setLimitation( $this->request[ 'limitation' ] );

            $_SESSION[ 'update_status' ] = $physical->update();
            header( "Location: /staff/dashboard/client/medical/?client_id=" . $participant->getClientId() );
            die();
            break;
          default:
            return "Invalid argument";
        }
      }
    } else {
      return "Unknown Request";
    }
  }

  /**
   * Request a subset of clients from the DB
   */
  protected function clients() {
    if ( $this->method == 'GET' ) {
      $list = array();
      $result = Client::query_all();

      foreach ( $result as $user ) {
        $list[ $user->getClientId() ] = $user->decode();
      }

      return $list;
    } else {
      return "Only accepts GET requests";
    }
  }

//  protected function account() {
//    if ( $this->method == 'GET' ) {
//      if ( empty( $this->args ) || $this->args[ 0 ] <= 0 )
//        return "Missing or Invalid Client ID";
//      $id = $this->args[ 0 ];  // Request Client ID
//      $account = Account::query_from_id( $id ); // Get Client from database
//
//      if ( count( $this->args ) == 1 ) { // return the client
//        return $account->decode();
//      } else if ( count( $this->args ) == 2 ) { // return array of client additional info
//        switch ( $this->args[ 1 ] ) {
//          case 'client':
//            $data = $account->get_client();
//            break;
//          default:
//            return "Invalid argument";
//        }
//        return $data->decode();
//      } else {
//        return "Invalid number of arguments";
//      }
//    } else if ( $this->method == 'POST' ) {
//      return "POST To Be Added!";
//    } else {
//      return "Unknown Request";
//    }
//  }

  /**
   * Request a subset of clients from the DB
   */
//  protected function accounts() {
//    if ( $this->method == 'GET' ) {
//      $list = array();
//      $result = Account::query_all();
//
//      foreach ( $result as $user ) {
//        $list[ $user->getAccountID() ] = $user->decode();
//      }
//
//      return $list;
//    } else {
//      return "Only accepts GET requests";
//    }
//  }

  /**
   * Request a subset of clients from the DB
   */
  protected function accounts_joined() {
    if ( $this->method == 'GET' ) {
      $list = array();
      $result = array();

      $offset = isset( $this->request[ 'offset' ] ) && is_numeric( $this->request[ 'offset' ] ) ? $this->request[ 'offset' ] : 0;
      $search = isset( $this->request[ 'search' ] ) ? $this->request[ 'search' ] : "";
      $column = isset( $this->request[ 'column' ] ) ? $this->request[ 'column' ] : "name";
      $order = isset( $this->request[ 'order' ] ) ? $this->request[ 'order' ] : true;

      $result = Participant::query_search( $offset, $search, $column, $order );

      foreach ( $result as $user ) {
        $list[ $user->getAccountID() ] = $user->decode();
      }
      $results[ 'data' ] = array_values( $list );

      return $results;
    } else {
      return "Only accepts GET requests";
    }
  }

  /**
   * Request all participants
   */
//  protected function data_table() {
//    if ( $this->method == 'GET' ) {
//      $list = array();
//
//      $result = Participant::query_for_data_table();
//
//      foreach ( $result as $user ) {
//        $list[ $user->getClientId() ] = $user->decode();
//      }
//      $results['data'] = array_values($list);
//
//      return $results;
//    } else {
//      return "Only accepts GET requests";
//    }
//  }
}