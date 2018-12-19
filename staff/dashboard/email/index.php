<?php
/**
 * index.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 3/5/18
 */

require '../../../common/index.php';
require_once '../components/StaffNavbar.php';
require_once '../components/StaffSidebar.php';
require_once '../components/Link.php';

verify_session( true );

// Set this pages links

$links = [
  new Link( "Dashboard", "/staff/dashboard", "home" ),
  new Link( "Recent Updates", "/staff/dashboard/recent", "layers" ),
  new Link( "My Participants", "/staff/dashboard/clients", "users" ),
  new Link( "Add a new Participant", "/staff/dashboard/new", "plus-circle" ),
  new Link( "Send Email", "/staff/dashboard/email", "mail", true),
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
                  <h3>Email Participants</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class='row'>
          <div class='col'>
            <form action='bulk_email.php'
                  method='post'>
              <div class='card text-center shadow'>
                <div class='card-header bg-dark text-light d-flex w-100 justify-content-between'>
                  <label class='h5'
                         for='email-input-message'>
                    Message
                  </label>
                  <small class='form-text text-muted text-right'>
                    Message to be sent to Recipients.
                  </small>
                </div>
                <div class='card-body p-0 m-0'>
                  <ul class='list-group list-group-flush'>
                    <li class='list-group-item py-1 bg-light'>
                      <textarea class='form-control'
                                id='email-input-message'
                                rows='15'
                                name='message'
                                placeholder='Message'
                                aria-label='Message'
                                required></textarea>
                    </li>
                    <li class='list-group-item py-1 bg-light'>
                      <div class='d-flex w-100 justify-content-between'>
                        <label class='h5'
                               for='email-input-subject'>
                          Subject
                        </label>
                        <small class='form-text text-muted text-right'>
                          Subject of the message.
                        </small>
                      </div>
                      <input class='form-control'
                             id='email-input-subject'
                             name='subject'
                             type='text'
                             placeholder='Subject'
                             aria-label='Subject'
                             required>
                    </li>
                    <li class='list-group-item py-1 bg-light'>
                      <div class='d-flex w-100 justify-content-between'>
                        <label class='h5'
                               for='email-select-target'>
                          Recipient(s)
                        </label>
                        <small class='form-text text-muted text-right'>
                          Who you are sending this message to.
                        </small>
                      </div>
                      <select class='custom-select'
                              id='email-select-target'
                              name='target'>
                        <option value='all'>All Accounts</option>
                        <option value='staff'>All Staff</option>
                        <option value='participants'>All Participants</option>
                      </select>
                    </li>
                  </ul>
                </div>
                <div class='card-footer bg-secondary d-flex w-100 justify-content-between'>
                  <button class='btn btn-primary'>
                    Send <i data-feather='mail'></i>
                  </button>
                </div>
              </div>
            </form>
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
