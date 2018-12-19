<?php

require_once '../../../common/index.php';
require_once '../../../common/EmergencyContact.php';
verify_session( false );

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ) {
  if ( isset( $_GET[ 'client_id' ] ) ) {
    foreach ( EmergencyContact::query_from_client( $_GET[ 'client_id' ] ) as $contact ) {
      if ( $contact->isActiveContact() )
        echo "<p><button type='button' class='btn btn-sm btn-danger' data-delete='emergency_contact' data-id='" . $contact->getEmergencyContactId() . "'>X</button> " .
          $contact->getFirstName() . " " . $contact->getLastName() . ", " .
          render_phone_number($contact->getPhone()) . " " . render_phone_number($contact->getAlternatePhone()) .
          "</p>";
    }
  }
}