<?php
/**
 * /staff/dashboard/client/medical/index.php
 *
 * Lists all of the participants medical information, includes modals to update and add new information.
 *
 * Author: Caleb Snoozy
 * Date: 2/14/18
 */

require_once '../../../../common/index.php';
require_once '../../../../common/Client.php';
require_once '../../../../common/Account.php';
require_once '../../components/StaffNavbar.php';
require_once '../../components/StaffSidebar.php';
require_once '../../components/Link.php';

verify_session( true );

if ( empty( $_GET ) ) {
  header( "Location: ../../dashboard" );
  die( "Relocating to ../../dashboard" );
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

$physical_limitations = $participant->get_physical_limitations();
$diet_restrictions = $participant->get_diet_restrictions();
$medical_alerts = $participant->get_medical_alerts();
$medications = $participant->get_medications();

$links = [
  new Link( "Dashboard", "/staff/dashboard", "home" ),
  new Link( "Current Information", "/staff/dashboard/client?client_id=$client_id", "layers" ),
  new Link( "Medical Information", "/staff/dashboard/client/medical?client_id=$client_id", "layers", true ),
  new Link( "Emergency Contact Information", "/staff/dashboard/client/emergency?client_id=$client_id", "user" ),
  new Link( "Sign-out", "/staff/signout/", "minus" )
];

function medication_table_row( array $columns, int $id, string $type ) {
  echo "<tr>";
  foreach ( $columns as $col ) {
    echo "<td class='p-0 m-0 align-middle'>$col</td>";
  }
  echo "
    <td class='text-right p-0 m-0'>
      <button class='btn btn-secondary btn-sm dropdown-toggle w-100'
      type='button' 
      data-toggle='dropdown' 
      aria-haspopup='true' 
      aria-expanded='false'
      form='javascript.void(0)'>
        <span class='d-none d-sm-inline'>Menu </span><span data-feather='menu'>...</span>
      </button>
      <div class='dropdown-menu p-0 m-0'>
        <div class='btn-group-vertical p-0 m-0 d-none d-xl-block'>
          <button class='btn btn-sm btn-secondary' 
          data-toggle='modal' 
          data-target='#edit-$type' 
          data-id='" . $id . "' 
          data-tooltip='tooltip' 
          data-placement='top' 
          form='javascript.void(0)'
          title='Edit $type'>
            <span class='d-none d-xl-inline'>Edit </span><span data-feather='edit'>Edit</span>
          </button>
          <button class='btn btn-sm btn-danger' 
          data-" . $type . "='" . $id . "'
          form='javascript.void(0)'
            <span class='d-none d-xl-inline'>Remove </span><span data-feather='delete'>X</span>
          </button>
        </div>
        <div class='btn-group p-0 m-0 d-xl-none'>
          <button class='btn btn btn-secondary' 
          data-toggle='modal' 
          data-target='#edit-$type' 
          data-id='" . $id . "' 
          data-tooltip='tooltip' 
          data-placement='top' 
          form='javascript.void(0)'
          title='Edit $type'>
            <span class='d-none d-xl-inline'>Edit </span><span data-feather='edit'>Edit</span>
          </button>
          <button class='btn btn btn-danger'
          data-" . $type . "='" . $id . "'
          form='javascript.void(0)'
          >
            <span class='d-none d-xl-inline'>Remove </span><span data-feather='delete'>X</span>
          </button>
        </div>
      </div>
    </td>              
  </tr>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Client: <?php echo $full_name ?></title>
  <link rel="stylesheet"
        href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet"
        href="//fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet"
        href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet"
        href="../../../css/dashboard.css">
  <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>

<?php staffNavbar( $links ) ?>

<div class="container-fluid">
  <div class="row">
    <?php staffSidebar( $links ) ?>

    <main role="main"
          class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 shadow-inset">

      <!-- === Name and Buttons =====================================================================================-->
      <div class='card shadow mb-5'>
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
              <button class="btn btn-sm btn-secondary"
                      data-tooltip='tooltip'
                      data-placement='top'
                      title='Create a new Registration'>
                <span class="d-none d-md-inline">Update Registration </span>
                <span data-feather="book">Update Registration</span>
              </button>
              <button class="btn btn-sm btn-secondary"
                      data-tooltip='tooltip'
                      data-placement='top'
                      title='Export This Participants Information to PDF'>
                <span class="d-none d-md-inline">Export </span>
                <span data-feather="external-link"></span>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- === Name and Buttons End =================================================================================-->

      <!-- === Medications Table =================================================================================== -->
      <div class='card text-center shadow my-3'>
        <div class="card-body bg-light p-0">
          <form action='/api/client/<?php echo $client_id ?>/medication'
                id='medication-add-form'
                method='post'>
            <table class="table table-hover table-striped table-sm table-light m-0">
              <thead class="bg-dark text-light">
              <tr>
                <th>Medication</th>
                <th>Dosage</th>
                <th>Frequency</th>
                <th>Time Taken</th>
                <th class="text-right fit">Controls</th>
              </tr>
              </thead>
              <tbody class='shadow-inset'>
              <?php
              foreach ( $medications as $medication ) {
                if ($medication->isActive()) {
                  medication_table_row( array( $medication->getMedication(),
                    $medication->getDosage(),
                    $medication->getFrequency(),
                    $medication->getTimeTaken()
                  ), $medication->getId(), "medication" );
                }
              }
              ?>
              <tr class='bg-secondary'>
                <td class='p-0 m-0'>
                  <div class='input-group input-group-sm'>
                    <input class='form-control'
                           id='medication-add-input-medication'
                           name='medication'
                           type='text'
                           placeholder='Medication'
                           aria-label='Medication'
                           required>
                    <div class='input-group-append'>
                      <span class='input-group-text d-none d-lg-inline'>
                        <small>
                          <i data-feather='circle'></i>
                        </small>
                      </span>
                    </div>
                  </div>
                </td>
                <td class='p-0 m-0'>
                  <div class='input-group input-group-sm'>
                    <input class='form-control'
                           id='medication-add-input-dosage'
                           name='dosage'
                           type='text'
                           placeholder='Dosage'
                           aria-label='Dosage'
                           required>
                    <div class='input-group-append'>
                      <span class='input-group-text d-none d-lg-inline'>
                        <small>
                          <i data-feather='circle'></i>
                        </small>
                      </span>
                    </div>
                  </div>
                </td>
                <td class='p-0 m-0'>
                  <div class='input-group input-group-sm'>
                    <input class='form-control'
                           id='medication-add-input-frequency'
                           name='frequency'
                           type='text'
                           placeholder='Frequency'
                           aria-label='Frequency'
                           required>
                    <div class='input-group-append'>
                      <span class='input-group-text d-none d-lg-inline'>
                        <small>
                          <i data-feather='circle'></i>
                        </small>
                      </span>
                    </div>
                  </div>
                </td>
                <td class='p-0 m-0'>
                  <div class='input-group input-group-sm'>
                    <input class='form-control'
                           id='medication-add-input-time-taken'
                           name='time_taken'
                           type='text'
                           placeholder='Time Taken'
                           aria-label='Time Taken'
                           required>
                    <div class='input-group-append'>
                      <span class='input-group-text d-none d-lg-inline'>
                        <i data-feather='circle'></i>
                      </span>
                    </div>
                  </div>
                </td>
                <td class='text-right p-0 m-0'>
                  <button class='btn btn-sm btn-success w-100'
                          form='medication-add-form'>
                    <span class='d-none d-sm-inline'>Add Medication </span>
                    <i data-feather='plus'>+</i></button>
                </td>
              </tr>
              </tbody>
              <tfoot class='bg-secondary text-light'>
              <tr>
                <th>
                  <small>Medication name and information</small>
                </th>
                <th>
                  <small>Dosage in mg</small>
                </th>
                <th>
                  <small>Frequency Taken</small>
                </th>
                <th>
                  <small>Taken At</small>
                </th>
                <th></th>
              </tr>
              </tfoot>
            </table>
          </form>
        </div>
      </div>
      <!-- === Medications Table End =============================================================================== -->

      <!-- === Medical Alerts Table ================================================================================ -->
      <div class='card text-center shadow my-3'>
        <div class="card-body bg-light p-0">
          <form action='/api/client/<?php echo $client_id ?>/medical_alert'
                id='medical-add-form'
                method='post'>
            <table class="table table-hover table-striped table-sm table-light m-0">
              <thead class="bg-dark text-light">
              <tr>
                <th>Medical Alert</th>
                <th class="text-right fit">Controls</th>
              </tr>
              </thead>
              <tbody class='shadow-inset'>
              <?php
              foreach ( $medical_alerts as $alert ) {
                if ($alert->isActive()) {
                  medication_table_row( array( $alert->getAlert() ), $alert->getId(), 'medical-alert' );
                }
              }
              ?>
              <tr class='bg-secondary'>
                <td class='p-0 m-0'>
                  <div class='input-group input-group-sm'>
                    <input class='form-control'
                           id='medical-add-input-alert'
                           name='alert'
                           type='text'
                           placeholder='Medical Alert'
                           aria-label='Medical Alert'
                           required>
                    <div class='input-group-append'>
                      <span class='input-group-text d-none d-sm-inline'>
                        <small>
                          <i data-feather='circle'></i>
                        </small>
                      </span>
                    </div>
                  </div>
                </td>
                <td class='text-right p-0 m-0'>
                  <button class='btn btn-sm btn-success w-100'
                          form='medical-add-form'>
                    <span class='d-none d-sm-inline'>Add Alert </span>
                    <i data-feather='plus'>+</i></button>
                </td>
              </tr>
              </tbody>
              <tfoot class='bg-secondary text-light'>
              <tr>
                <th>
                  <small>Description of Medical Alert</small>
                </th>
                <th></th>
              </tr>
              </tfoot>
            </table>
          </form>
        </div>
      </div>
      <!-- === Medical Alerts Table End ============================================================================ -->

      <!-- === Physical Limitations Table ========================================================================== -->
      <div class='card text-center shadow my-3'>
        <div class="card-body bg-light p-0">
          <form action='/api/client/<?php echo $client_id ?>/physical_limitation'
                id='physical-add-form'
                method='post'>
            <table class="table table-hover table-striped table-sm table-light m-0">
              <thead class="bg-dark text-light">
              <tr>
                <th>Physical Limitations</th>
                <th class="text-right fit">Controls</th>
              </tr>
              </thead>
              <tbody class='shadow-inset'>
              <?php
              foreach ( $physical_limitations as $limitation ) {
                if ($limitation->isActive()) {
                  medication_table_row( array( $limitation->getLimitation() ), $limitation->getId(), 'physical-limitation' );
                }
              }
              ?>
              <tr class='bg-secondary'>
                <td class='p-0 m-0'>
                  <div class='input-group input-group-sm'>
                    <input class='form-control'
                           id='physical-add-input-limitation'
                           name='limitation'
                           type='text'
                           placeholder='Physical Limitation'
                           aria-label='Physical Limitation'
                           required>
                    <div class='input-group-append'>
                      <span class='input-group-text d-none d-sm-inline'>
                        <small>
                          <i data-feather='circle'></i>
                        </small>
                      </span>
                    </div>
                  </div>
                </td>
                <td class='text-right p-0 m-0'>
                  <button class='btn btn-sm btn-success w-100'
                          form='physical-add-form'>
                    <span class='d-none d-sm-inline'>Add Limitation </span>
                    <i data-feather='plus'>+</i></button>
                </td>
              </tr>
              </tbody>
              <tfoot class='bg-secondary text-light'>
              <tr>
                <th>
                  <small>Description of Physical Limitation</small>
                </th>
                <th></th>
              </tr>
              </tfoot>
            </table>
          </form>
        </div>
      </div>
      <!-- === Physical Limitations Table End ====================================================================== -->

      <!-- === Diet Restrictions Table ============================================================================= -->
      <div class='card text-center shadow my-3'>
        <div class="card-body bg-light p-0">
          <form action='/api/client/<?php echo $client_id ?>/diet_restriction'
                id='diet-add-form'
                method='post'>
            <table class="table table-hover table-striped table-sm table-light m-0">
              <thead class="bg-dark text-light">
              <tr>
                <th>Diet Restriction</th>
                <th class="text-right fit">Controls</th>
              </tr>
              </thead>
              <tbody class='shadow-inset'>
              <?php
              foreach ( $diet_restrictions as $restriction ) {
                if ($restriction->isActive()) {
                  medication_table_row( array( $restriction->getRestriction() ), $restriction->getId(), "diet-restriction" );
                }
              }
              ?>
              <tr class='bg-secondary'>
                <td class='p-0 m-0'>
                  <div class='input-group input-group-sm'>
                    <input class='form-control'
                           id='diet-add-input-restriction'
                           name='restriction'
                           type='text'
                           placeholder='Diet Restriction'
                           aria-label='Diet Restriction'
                           required>
                    <div class='input-group-append'>
                      <span class='input-group-text d-none d-sm-inline'>
                        <small>
                          <i data-feather='circle'></i>
                        </small>
                      </span>
                    </div>
                  </div>
                </td>
                <td class='text-right p-0 m-0'>
                  <button class='btn btn-sm btn-success w-100'
                          form='diet-add-form'>
                    <span class='d-none d-sm-inline'>Add Restriction </span>
                    <i data-feather='plus'>+</i></button>
                </td>
              </tr>
              </tbody>
              <tfoot class='bg-secondary text-light'>
              <tr>
                <th>
                  <small>Dietary Restriction and additional information</small>
                </th>
                <th></th>
              </tr>
              </tfoot>
            </table>
          </form>
        </div>
      </div>
      <!-- === Diet Restrictions Table End ========================================================================= -->

      <?php
      require '../modals/edit_medication.html';
      require '../modals/edit_alert.html';
      require '../modals/edit_physical.html';
      require '../modals/edit_diet.html';
      ?>

      <?php require '../../components/footer.html'?>
    </main>
  </div>
</div>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace()
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

  $('[data-medication]').on('click', function(){
    let id = $(this).data('medication');
    $.ajax("/api/remove_medication/" + id);
    setTimeout(window.location.reload(true), 1500);
  });

  $('[data-medical-alert]').on('click', function(){
    let id = $(this).data('medical-alert');
    $.ajax("/api/remove_medical_alert/" + id);
    setTimeout(window.location.reload(true), 1500);
  });

  $('[data-physical-limitation]').on('click', function(){
    let id = $(this).data('physical-limitation');
    $.ajax("/api/remove_physical_limitation/" + id);
    setTimeout(window.location.reload(true), 1500);
  });

  $('[data-diet-restriction]').on('click', function(){
    let id = $(this).data('diet-restriction');
    $.ajax("/api/remove_diet_restriction/" + id);
    setTimeout(window.location.reload(true), 1500);
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