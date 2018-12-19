<?php
/**
 * index.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 3/7/18
 */

require_once '../../../common/index.php';
require_once '../../../common/Logging.php';
require_once '../components/StaffNavbar.php';
require_once '../components/StaffSidebar.php';
require_once '../components/Link.php';

verify_session( true );

$logs = Logging::query_all();

$links = [
  new Link( "Dashboard", "/staff/dashboard", "home" ),
  new Link( "Recent Updates", "/staff/dashboard/recent", "layers" ),
  new Link( "My Participants", "/staff/dashboard/clients", "users" ),
  new Link( "Add a new Participant", "/staff/dashboard/new", "plus-circle" ),
  new Link( "Send Email", "/staff/dashboard/email", "mail" ),
  new Link( "Sign-out", "/staff/signout/", "minus" ),
  new Link("Logs", "/staff/dashboard/logs", "activity", true)
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard: Logs</title>
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
            <div class='h3'>Dashboard - Logs</div>
            <div class="btn-group">
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
      <div class="row pb-3">
        <div class='col'>
          <div class="table-responsive-xl shadow">
            <table class='table table-striped table-sm table-hover table-light'>
              <thead class='bg-dark text-light'>
              <tr>
                <th>Timestamp</th>
                <th>Message</th>
              </tr>
              </thead>
              <tbody id='table-wrapper'
                     class='shadow-inset'>
              <?php
                foreach ($logs as $log){
                  echo "<tr>
                    <td>" . $log->getTimestamp() . "</td>
                    <td>" . $log->getMessage() . "</td>
                  </tr>";
                }
              ?>
              </tbody>
              <tfoot class='bg-secondary'>
              <tr>
                <th></th>
                <th></th>
              </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      <?php require '../components/footer.html'?>
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
</script>