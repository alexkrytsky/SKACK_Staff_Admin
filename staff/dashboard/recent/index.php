<?php
/**
 * index.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 3/8/18
 */

require '../../../common/index.php';
require_once '../components/StaffNavbar.php';
require_once '../components/StaffSidebar.php';
require_once '../components/Link.php';

verify_session( true );

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

// Set this pages links

$links = [
  new Link( "Dashboard", "/staff/dashboard", "home"),
  new Link( "Recent Updates", "/staff/dashboard/recent", "layers", true),
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
        href="../../css/dashboard.css">
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
                  <h3>Dashboard - Recent</h3>
                  <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                      <button class="btn btn-sm btn-outline-secondary"
                              disabled
                              data-tooltip='tooltip'
                              data-placement='top'
                              title='Export to Spreadsheet'><span
                          class="d-none d-md-inline">Export </span><span data-feather="external-link"></span></button>
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
            <?php require '../components/footer.html' ?>
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

<script>
  feather.replace();
</script>
</body>
</html>