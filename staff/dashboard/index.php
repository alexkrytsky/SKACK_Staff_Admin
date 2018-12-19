<?php
/**
 * index.php.old
 *
 * SKCAC Staff Portal
 *
 * Author: Caleb Snoozy
 * Date: 2/12/18
 */

require '../../common/index.php';
require_once 'components/StaffNavbar.php';
require_once 'components/StaffSidebar.php';
require_once 'components/Link.php';

verify_session( true );

// Set this pages links

$links = [
  new Link( "Dashboard", "/staff/dashboard", "home", true ),
  new Link( "Recent Updates", "/staff/dashboard/recent", "layers" ),
  new Link( "My Participants", "/staff/dashboard/clients", "users" ),
  new Link( "Add a new Participant", "/staff/dashboard/new", "plus-circle" ),
  new Link( "Send Email", "/staff/dashboard/email", "mail" ),
  new Link( "Sign-out", "/staff/signout/", "minus" ),
  new Link("Logs", "/staff/dashboard/logs", "activity")
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SKCAC Staff Portal</title>
  <link rel="stylesheet"
        href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet"
        href="//fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet"
        href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet"
        href="../css/dashboard.css">
</head>
<body>

<!-- Render the Staff Navigation Bar -->
<?php staffNavbar( $links, true ) ?>

<div class="container-fluid">
  <div class="row">
    <!-- Render The Staff Sidebar -->
    <?php staffSidebar( $links ) ?>

    <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 shadow-inset"
          role="main">
      <div class='container-fluid'>
        <div class='row'>
          <div class='col'>
            <div class='card shadow my-2 mb-3'>
              <div class='card-body py-1 px-2'>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                  <h3>Dashboard - All Participants</h3>
                  <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                      <button id="back"
                              class="btn btn-sm btn-outline-secondary">&lt;&lt;
                      </button>
                      <input id="page"
                             type="number"
                             value="1"
                             min="1">
                      <button id="next"
                              class="btn btn-sm btn-outline-secondary">&gt;&gt;
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class='row'>
          <div class='col'>
            <div class="table-responsive-xl shadow">
              <table class='table table-striped table-sm table-hover table-light'>
                <thead class='bg-dark text-light'>
                <tr>
                  <th class='border-right'><a class='text-light d-flex justify-content-between'
                         href='#'
                         id='table-name'><span>Name</span> <i data-feather='circle'></i></a></th>
                  <th class='border-right'><a class='text-light d-flex justify-content-between'
                         href='#'
                         id='table-email'><span>Email</span> <i data-feather='circle'></i></a></th>
                  <th class='border-right'><a class='text-light d-flex justify-content-between'
                         href='#'
                         id='table-phone'><span>Phone</span> <i data-feather='circle'></i></a></th>
                  <th class='d-none d-lg-table-cell border-right'><a class='text-light d-flex justify-content-between'
                                                        href='#'
                                                        id='table-last'><span>Last Updated</span>
                      <i data-feather='circle'></i></a></th>
                  <th>Emergency Info</th>
                </tr>
                </thead>
                <tbody id='table-wrapper'
                       class='shadow-inset'>
                <!-- The Table will be inserted here -->
                </tbody>
                <tfoot class='bg-secondary'>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th class='d-none d-lg-table-cell'></th>
                  <th></th>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <div class='row'>
          <div class='col'>
            <?php require 'components/footer.html' ?>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>

<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>
<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>

<script src="js/dashboard.js"></script>

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

if ( isset( $_SESSION[ 'mail_result' ] ) ) {
  if ( $_SESSION[ 'mail_result' ] ) {
    echo "<script language='javascript'>";
    echo "alert('Emails Sent Successful.')";
    echo "</script>";
  } else {
    echo "<script language='javascript'>";
    echo "alert('Emails Sent Failed.')";
    echo "</script>";
  }
  unset( $_SESSION[ 'mail_result' ] );
}
?>

</body>
</html>