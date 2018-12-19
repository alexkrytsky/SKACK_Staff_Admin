<?php
/**
 * index.php.old
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/14/18
 */

require_once '../../../common/index.php';
require_once '../../../common/Client.php';
require_once '../../../common/Account.php';
require_once '../components/StaffNavbar.php';
require_once '../components/StaffSidebar.php';
require_once '../components/Link.php';

verify_session( true );

if ( empty( $_GET ) ) {
  header( "Location: ../dashboard" );
  die( "Relocating to ../dashboard" );
}

$client_id = $_GET[ 'client_id' ];

$participant = Participant::query_from_client_id( $client_id );

$first_name = htmlentities( $participant->getFirstName(), ENT_QUOTES, 'UTF-8' );
$last_name = htmlentities( $participant->getLastName(), ENT_QUOTES, 'UTF-8' );
$middle_name = htmlentities( $participant->getMiddleName(), ENT_QUOTES, 'UTF-8' );
$full_name = htmlentities( $participant->getFirstName() . ' ' . $participant->getLastName(), ENT_QUOTES, 'UTF-8' );
$email = htmlentities( $participant->getEmail(), ENT_QUOTES, 'UTF-8' );
$phone = htmlentities( $participant->getPhone(), ENT_QUOTES, 'UTF-8' );
$address = htmlentities( $participant->getAddress(), ENT_QUOTES, 'UTF-8' );
$address_city = htmlentities( $participant->getAddressCity(), ENT_QUOTES, 'UTF-8' );
$address_zip = htmlentities( $participant->getAddressZip(), ENT_QUOTES, 'UTF-8' );
$address_state = htmlentities( $participant->getAddressState(), ENT_QUOTES, 'UTF-8' );
$last_update = htmlentities( $participant->getLastUpdate(), ENT_QUOTES, 'UTF-8' );
$active_client = htmlentities( $participant->isActiveClient(), ENT_QUOTES, 'UTF-8' );


$contacts = $participant->get_contacts();

$links = [
  new Link( "Dashboard", "/staff/dashboard", "home" ),
  new Link( "Current Information", "/staff/dashboard/client?client_id=$client_id", "layers", true ),
  new Link( "Medical Information", "/staff/dashboard/client/medical?client_id=$client_id", "layers" ),
  new Link( "Emergency Contact Information", "/staff/dashboard/client/emergency?client_id=$client_id", "user" ),
  new Link( "Sign-out", "/staff/signout/", "minus" )
];


/**
 * @param $contact Contact
 */
function render_contact( $contact ) {
  echo "
<div class='col-lg-6 p-2'>
  <div class='card text-center shadow'>
    <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center h6 card-header text-light bg-dark'>
      <div>" . $contact->getRelation() . " Information</div>
      <div class='btn-toolbar mb-2 mb-md-0'>
        <div class='btn-group mr-2 shadow'>
          <button class='btn btn-sm btn-secondary' 
                  data-toggle='modal' 
                  data-target='#edit-contact' 
                  data-contact-id='" . $contact->getContactId() . "' 
                  data-tooltip='tooltip' 
                  data-placement='top' 
                  title='Edit Contact'>
              <span class='d-lg-none d-inline'>Edit </span><span data-feather='edit'>Edit</span></button>
          <button class='btn btn-sm btn-danger'
                  data-tooltip='tooltip' 
                  data-placement='top' 
                  title='Remove This Contact'
                  data-remove-contact='" . $contact->getContactId() . "'>
            <span class='d-lg-none d-inline'>Remove </span><span data-feather='delete'>X</span></button>
        </div>
      </div>
    </div>
    <div class='card-body bg-light shadow-inset'>
      <h6 class='card-title'>" . $contact->getFirstName() . " " . $contact->getLastName() . "</h6>
      <div>Phone Number: " . render_phone_number( $contact->getPhone() ) . "</div>
      <div>Email: " . $contact->getEmail() . "</div>
    </div>
    <div class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center card-footer text-light bg-secondary'>
      <div>" . $contact->getAddress() . ", " . $contact->getAddressCity() . " " . $contact->getAddressState() . ", " . $contact->getAddressZip() . "</div>
    </div>
  </div>
</div>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Participant: <?php echo $full_name ?></title>
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

<!-- Render the Staff Navigation Bar -->
<?php staffNavbar( $links ) ?>

<div class="container-fluid">
  <div class="row">
    <?php staffSidebar( $links ) ?>

    <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 shadow-inset"
          role="main">
      <!-- === Name and Buttons =====================================================================================-->
      <div class='card shadow my-2 mb-5'>
        <div class='card-body py-1 px-3'>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <div class='h3'><?php echo $full_name ?></div>
            <div class="btn-group">
              <button class="btn btn-sm btn-dark disabled"
                      data-tooltip='tooltip'
                      data-placement='top'
                      title='Registration Date: <?php echo $last_update ?>'>
                <span class="d-none d-lg-block">Registration Date: <?php echo $last_update ?> </span>
                <span class="d-inline d-lg-none"
                      data-feather="calendar"></span>
              </button>
              <!--              <button class="btn btn-sm btn-secondary"-->
              <!--                      data-tooltip='tooltip'-->
              <!--                      data-placement='top'-->
              <!--                      title='Create a new Registration'>-->
              <!--                <span class="d-none d-md-inline">Update Registration </span>-->
              <!--                <span data-feather="book">Update Registration</span>-->
              <!--              </button>-->
              <button class="btn btn-sm btn-secondary"
                      data-tooltip='tooltip'
                      data-placement='top'
                      title='Export This Participants Information'>
                <a class='text-light'
                   href='export.php?client_id=<?php echo $client_id ?>'><span class="d-none d-md-inline">Export </span>
                  <span data-feather="external-link"></span></a>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- === Name and Buttons End =================================================================================-->
      <div class="row pb-3">
        <div class='col'>
          <div class='card text-center shadow'>
            <div
              class='d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center h6 card-header text-light bg-dark'>
              <div><?php echo $first_name . " " . $middle_name . " " . $last_name ?></div>
              <div class='btn-toolbar mb-2 mb-md-0'>
                <div class='btn-group mr-2 shadow'>
                  <button class="btn btn-sm btn-secondary"
                          data-toggle="modal"
                          data-target="#edit-client"
                          data-tooltip='tooltip'
                          data-placement='top'
                          title='Edit Participant Information'>
                    <span class='d-lg-none d-inline'>Edit </span><span data-feather='edit'>Edit</span></button>
                  <button class='btn btn-sm btn-danger'
                          data-tooltip='tooltip'
                          data-placement='top'
                          title='Remove This Participant'
                          data-remove-participant='<?=$client_id?>'
                          >
                    <span class='d-lg-none d-inline'>Remove </span><span data-feather='delete'>X</span></button>
                </div>
              </div>
            </div>
            <div class='card-body bg-light shadow-inset'>
              <h6>Phone Number: <?php echo render_phone_number( $phone ) ?></h6>
              <h6>Email: <?php echo $email ?></h6>
            </div>
            <div class='card-footer text-light bg-secondary'>
              <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center ">
                <?php echo $address . ", " . $address_city . " " . $address_state . ", " . $address_zip ?>
              </div>
            </div>
          </div>
          <!--================ Edit Participant / Client  Modal ===========================================-->
          <?php require "modals/edit_participant.php" ?>
          <!--================ Edit Participant / Client  Modal End========================================-->
        </div>
      </div>
      <div class='card shadow my-2'>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center card-body py-1 px-3">
          <h4>Contacts</h4>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="mr-2">
              <button class="btn btn-sm btn-secondary"
                      data-toggle="modal"
                      data-target="#add-contact"
                      data-tooltip='tooltip'
                      data-placement='top'
                      title='Add A New Contact'>
                New Contact <span data-feather="plus">+</span></button>
            </div>
          </div>
        </div>
      </div>
      <!--================ Add Contact Modal =============================================-->
      <?php require "modals/add_contact.php" ?>
      <!--================ Add Contact Modal End==========================================-->
      <div class="row">
        <?php foreach ( $contacts as $contact ) {
          if ( $contact->isActiveContact() ) {
            render_contact( $contact );
          }
        } ?>
      </div>
      <!--================ Edit Contact Modal =============================================-->
      <?php require "modals/edit_contact.html" ?>
      <!--================ Edit Contact Modal End==========================================-->
      <?php require '../components/footer.html' ?>
    </main>
  </div>
</div>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace();
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>

<script>
  $(function () {
    $('[data-tooltip="tooltip"]').tooltip()
  });

  $('.input-group').find('input').on('input', function () {
    let input = $(this);
    if (input.prop('required')) {
      let span = input.parent().find('span');
      if (input.val() === "") {
        span.removeClass('bg-success');
        span.addClass('bg-danger');
        span.html("<i data-feather='x-circle'>X</i>");
        feather.replace();
        input.addClass('is-invalid');
      } else {
        span.removeClass('bg-danger');
        span.addClass('bg-success');
        span.html("<i data-feather='check-circle'>:)</i>");
        feather.replace();
        input.removeClass('is-invalid');
      }
    }
  });

  $('[data-remove-contact]').on('click', function(){
    let contact_id = $(this).data('remove-contact');
    $.ajax("/api/remove_contact/" + contact_id);
    setTimeout(window.location.reload(true), 1500);
  });

  $('[data-remove-participant]').on('click', function(){
    let client_id = $(this).data('remove-participant');
    $.ajax("/api/remove_participant/" + client_id);
    setTimeout(window.location.replace("/staff/dashboard"), 1500);
  });
</script>

<?php
if ( isset( $_SESSION[ 'update_status' ] ) ) {
  if ( $_SESSION[ 'update_status' ] === true ) {
    echo "<script language='javascript'>";
    echo "alert('Update Successful.')";
    echo "</script>";
  } else {
    echo "<script language='javascript'>";
    echo "alert('Update Failed.')";
    echo "</script>";
  }
  unset( $_SESSION[ 'update_status' ] );
}
?>
</body>
</html>