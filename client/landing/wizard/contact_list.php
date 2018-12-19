<?php

require_once '../../../common/index.php';
require_once '../../../common/Contact.php';
verify_session( false );

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ) {
  if ( isset( $_GET['client_id'] ) ) {
    foreach ( Contact::query_from_client($_GET['client_id']) as $contact) {
      if ($contact->isActiveContact())
        echo "<p><button type='button' class='btn btn-sm btn-danger' data-delete='contact' data-id='" . $contact->getContactId() . "'>X</button> " .
          $contact->getFirstName() . " " . $contact->getLastName() . ", " .
          $contact->getEmail() . " " . render_phone_number($contact->getPhone()) . " " .
          "</p>";
    }
  }
}