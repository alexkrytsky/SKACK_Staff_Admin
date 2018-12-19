<?php
/**
 * export.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 3/12/18
 */

require_once '../../../common/index.php';
require_once '../../../common/Account.php';

verify_session( true );

if ( $_SERVER[ 'REQUEST_METHOD' ] != "GET" ) {
  header( "Location: /staff/dashboard" );
  die();
}

if ( !isset( $_GET[ 'client_id' ] ) ) {
  header( "Location: /staff/dashboard" );
  die();
}

$client_id = $_GET[ 'client_id' ];

$participant = Participant::query_from_client_id( $client_id );

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Participant: <?= $participant->getFirstName() . " " . $participant->getLastName() ?></title>
  <link rel="stylesheet"
        href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet"
        href="//fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet"
        href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet"
        href="../../css/dashboard.css">
  <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
<div class='container'>
  <div class='row'>
    <div class='col-2'>
      <img src='../../resources/skcaclogo.png'
           alt='logo'
           width='75'
           height='75'>
    </div>
    <div class='col-8'>
      <h3 class='text-muted pt-5'>MEDICAL & EMERGENCY INFORMATION</h3>
    </div>
  </div>

  <div class='d-flex flex-grow'>
    <div class='d-inline-flex flex-grow'>
      <p class='h6 mb-0 px-1'>Participant:</p>
      <p class='mb-0 px-5 border-bottom flex-grow'><?= $participant->getFirstName() . " " . $participant->getMiddleName() . " " . $participant->getLastName() ?></p>
    </div>
    <div class='d-inline-flex'>
      <p class='h6 mb-0 px-1'>Date:</p>
      <p class='mb-0 px-5 border-bottom'><?= date( "d / m / y" ) ?></p>
    </div>
  </div>

  <div class='d-flex flex-grow'>
    <div class='d-inline-flex flex-grow'>
      <span class='h6 mb-0 px-1'>Home Address:</span>
      <span class='mb-0 px-5 border-bottom flex-grow'><?= $participant->getAddress() ?></span>
    </div>
    <div class='d-inline-flex'>
      <span class='h6 mb-0 px-1'>Phone #:</span>
      <span class='mb-0 px-5 border-bottom'><?= render_phone_number( $participant->getPhone() ) ?></span>
    </div>
  </div>

  <div class='d-flex flex-grow'>
    <div class='d-inline-flex flex-grow'>
      <span class='mb-0 px-5 border-bottom flex-grow'><?= $participant->getAddressCity() . ", " . $participant->getAddressState() . ", " . $participant->getAddressZip() ?></span>
    </div>
    <div class='d-inline-flex'>
      <span class='h6 mb-0 px-1'>Email:</span>
      <span class='mb-0 px-5 border-bottom'><?= $participant->getEmail() ?></span>
    </div>
  </div>

  <br>
  <?php
  foreach ( $participant->get_contacts() as $contact ) {
    echo "
<div class='d-flex flex-grow'>
  <div class='d-inline-flex flex-grow'>
    <span class='h6 mb-0 px-1'>" . $contact->getRelation() . ":</span>          
    <span class='mb-0 px-5 border-bottom flex-grow'>" . $contact->getFirstName() . " " . $contact->getLastName() . "</span>
  </div>
  <div class='d-inline-flex'>
    <span class='h6 mb-0 px-1'>Phone #:</span>
    <span class='mb-0 px-5 border-bottom'>" . render_phone_number( $contact->getPhone() ) . "</span>
  </div>
</div>
<div class='d-flex flex-grow'>
  <div class='d-inline-flex flex-grow'>
    <span class='h6 mb-0 px-1'>Address:</span>
    <span class='mb-0 px-5 border-bottom flex-grow'>" . $contact->getAddress() . "</span>
  </div>
  <div class='d-inline-flex'>
    <span class='h6 mb-0 px-1'>Email:</span>
    <span class='mb-0 px-5 border-bottom'>" . $contact->getEmail() . "</span>
  </div>
</div>
<div class='d-flex flex-grow'>
  <div class='d-inline-flex flex-grow'>
    <span class='mb-0 px-5 border-bottom flex-grow'>" . $contact->getAddressCity() . ", " . $contact->getAddressState() . ", " . $contact->getAddressZip() . "</span>
  </div>
</div>
<br>";
  }
  foreach ( $participant->get_emergency_contacts() as $contact ) {
    echo "
<div class='d-flex flex-grow'>
  <div class='d-inline-flex flex-grow'>
    <span class='h6 mb-0 px-1'>Emergency Contact:</span>          
    <span class='mb-0 px-5 border-bottom flex-grow'>" . $contact->getFirstName() . " " . $contact->getLastName() . "</span>
  </div>
  <div class='d-inline-flex'>
    <span class='h6 mb-0 px-1'>Emerg. Phone #:</span>
    <span class='mb-0 px-5 border-bottom'>" . render_phone_number( $contact->getPhone() ) . "</span>
  </div>
</div>
<div class='d-flex flex-grow'>
  <div class='d-inline-flex flex-grow'>
    <span class='h6 mb-0 px-1'>Alternate Emergency Phone #s:</span>
    <span class='mb-0 px-5 border-bottom flex-grow'>" . render_phone_number( $contact->getAlternatePhone() ) . "</span>
  </div>
</div>
<br>";
  }
  ?>

  <div class='d-flex flex-grow'>
    <div class='d-inline-flex flex-grow'>
      <span class='h6 mb-0 px-1'>Medical Alerts (allergies, high blood pressure, diabetic, etc.):</span>
      <div class='mb-0 px-5 border-bottom flex-grow'></div>
    </div>
  </div>
  <?php
  foreach ( $participant->get_medical_alerts() as $alert ) {
    echo "
<div class='d-flex flex-grow'>
  <div class='d-inline-flex flex-grow'>
    <span class='mb-0 px-5 border-bottom flex-grow'>" . $alert->getAlert() . "</span>    
  </div>
</div>
    ";
  }
  ?>
  <br>

  <div class='d-flex flex-grow'>
    <div class='d-inline-flex flex-grow'>
      <span class='h6 mb-0 px-1'>Physical Limitations (bending, sitting, standing, etc.):</span>
      <div class='mb-0 px-5 border-bottom flex-grow'></div>
    </div>
  </div>
  <?php
  foreach ( $participant->get_physical_limitations() as $limitation ) {
    echo "
<div class='d-flex flex-grow'>
  <div class='d-inline-flex flex-grow'>
    <span class='mb-0 px-5 border-bottom flex-grow'>" . $limitation->getLimitation() . "</span>    
  </div>
</div>
    ";
  }
  ?>
  <br>

  <div class='d-flex flex-grow'>
    <div class='d-inline-flex flex-grow'>
      <span class='h6 mb-0 px-1'>Diet Restrictions:</span>
      <div class='mb-0 px-5 border-bottom flex-grow'></div>
    </div>
  </div>
  <?php
  foreach ( $participant->get_diet_restrictions() as $restriction ) {
    echo "
<div class='d-flex flex-grow'>
  <div class='d-inline-flex flex-grow'>
    <span class='mb-0 px-5 border-bottom flex-grow'>" . $restriction->getRestriction() . "</span>    
  </div>
</div>
    ";
  }
  ?>
  <br>

  <div class='d-flex'>
    <span class='h5 mb-0 px-1'>Medications (Please list all):</span>
  </div>
  <div class='row px-5'>
    <u class='h6 col-7 mb-0'>Medication and dosage</u>
    <u class='h6 col-3 mb-0'>Frequency taken</u>
    <u class='h6 col-2 mb-0'>Time taken</u>
  </div>
  <?php
  foreach ( $participant->get_medications() as $medication ) {
    echo "
<div class='row'>
  <span class='col-7 mb-0 border-bottom'>" . $medication->getMedication() . " - " . $medication->getDosage() . " mg</span>
  <span class='col-3 mb-0 border-bottom'>" . $medication->getFrequency() . "</span>
  <span class='col-2 mb-0 border-bottom'>" . $medication->getTimeTaken() . "</span>  
</div>
    ";
  }
  for ( $i = 0; $i < 5; $i++ ) {
    echo "
<div class='row'>
  <span class='col-12 mb-0 pt-4 border-bottom'></span>
</div>
      ";
  }
  ?>
  <div class='d-inline-flex flex-grow'>
    <span class='h6 mb-0 px-1'>(continue on back of page if necessary or attach medication list to this sheet.)</span>
  </div>
  <br>
  <br>

  <div class='d-flex flex-grow'>
    <span class='h6 mb-0 px-1'>Form Completed by:</span>
    <div class='mb-0 px-5 border-bottom flex-grow'></div>
  </div>
  <br>
  <div class='d-flex justify-content-center'>
    <small class='text-muted'>19731 Russell Road South, Kent, WA 98032-1117 ~ 253-395-1240 ~ TDD Relay: 711 ~ Equal
                              Opportunity Employer ~ www.skcac.org
    </small>
  </div>
</div>
</body>
</html>