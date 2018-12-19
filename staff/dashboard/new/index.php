<?php
/**
 * index.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 3/8/18
 */

require_once '../../../common/index.php';
require_once '../../../common/Account.php';
require_once '../components/StaffNavbar.php';
require_once '../components/StaffSidebar.php';
require_once '../components/Link.php';

verify_session( true );

// Set this pages links

$links = [
  new Link( "Dashboard", "/staff/dashboard", "home" ),
  new Link( "Recent Updates", "/staff/dashboard/recent", "layers" ),
  new Link( "My Participants", "/staff/dashboard/clients", "users" ),
  new Link( "Add a new Participant", "/staff/dashboard/new", "plus-circle", true ),
  new Link( "Send Email", "/staff/dashboard/email", "mail" ),
  new Link( "Sign-out", "/staff/signout/", "minus" ),
  new Link( "Logs", "/staff/dashboard/logs", "activity" )
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
<?php staffNavbar( $links ) ?>

<div class="container-fluid">
  <div class="row">
    <!-- Render The Staff Sidebar -->
    <?php staffSidebar( $links ) ?>

    <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 shadow-inset"
          role="main">
      <div class='container-fluid'>
        <div class='row'>
          <div class='col'>
            <form action='/api/client' method='post'>
              <div class="card shadow">
                <div class='card-header bg-dark text-light'>
                  <h3>Dashboard - New Participant</h3>
                </div>
                <div class='container-fluid bg-light'>
                  <div class='row'>
                    <div class='card col-12 col-lg-4 p-2'>
                      <div class='d-flex justify-content-between'>
                        <label class='h6'
                               for='participant-add-input-first-name'>
                          First Name
                        </label>
                        <small class='form-text text-muted text-right'>
                          Participants First Name.
                        </small>
                      </div>
                      <div class='input-group input-group-sm'>
                        <input id="participant-add-input-first-name"
                               name="first_name"
                               type="text"
                               class="form-control"
                               placeholder="First Name"
                               aria-label="First Name"
                               required>
                        <div class='input-group-append'>
                          <span class='input-group-text text-light'>
                            <i data-feather='circle'></i>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class='card col-12 col-lg-4 p-2'>
                      <div class='d-flex justify-content-between'>
                        <label class='h6'
                               for='participant-add-input-last-name'>
                          Last Name
                        </label>
                        <small class='form-text text-muted text-right'>
                          Participants Last Name.
                        </small>
                      </div>
                      <div class='input-group input-group-sm'>
                        <input id="participant-add-input-last-name"
                               name="last_name"
                               type="text"
                               class="form-control"
                               placeholder="Last Name"
                               aria-label="Last Name"
                               required>
                        <div class='input-group-append'>
                          <span class='input-group-text text-light'>
                            <i data-feather='circle'></i>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class='card col-12 col-lg-4 p-2'>
                      <div class='d-flex justify-content-between'>
                        <label class='h6'
                               for='participant-add-input-middle-name'>
                          Middle Name
                        </label>
                        <small class='form-text text-muted text-right'>
                          Participants Middle Name.
                        </small>
                      </div>
                      <div class='input-group input-group-sm'>
                        <input id="participant-add-input-middle-name"
                               name="middle_name"
                               type="text"
                               class="form-control"
                               placeholder="Middle Name"
                               aria-label="Middle Name">
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='card col-12 col-lg-8 p-2'>
                      <div class='d-flex justify-content-between'>
                        <label class='h6'
                               for='participant-add-input-email'>
                          Email
                        </label>
                        <small class='form-text text-muted text-right'>
                          Participants Email Address.
                        </small>
                      </div>
                      <div class='input-group input-group-sm'>
                        <input id="participant-add-input-email"
                               name="email"
                               type="email"
                               class="form-control"
                               placeholder="Email Address"
                               aria-label="Email Address"
                               required>
                        <div class='input-group-append'>
                            <span class='input-group-text text-light'>
                              <i data-feather='circle'></i>
                            </span>
                        </div>
                      </div>
                    </div>
                    <div class='card col-12 col-lg-4 p-2'>
                      <div class='d-flex justify-content-between'>
                        <label class='h6'
                               for='participant-add-input-phone'>
                          Phone Number
                        </label>
                        <small class='form-text text-muted text-right'>
                          Participants 10 digit Phone Number.
                        </small>
                      </div>
                      <div class='input-group input-group-sm'>
                        <input id="participant-add-input-phone"
                               name="phone"
                               type="tel"
                               class="form-control"
                               placeholder="##########"
                               aria-label="Phone Number"
                               required>
                        <div class='input-group-append'>
                            <span class='input-group-text text-light'>
                              <i data-feather='circle'></i>
                            </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='card col-12 col-lg-7 p-2'>
                      <div class='d-flex justify-content-between'>
                        <label class='h6'
                               for='participant-add-input-address'>
                          Address
                        </label>
                        <small class='form-text text-muted text-right'>
                          Participants Address of Residence.
                        </small>
                      </div>
                      <div class='input-group input-group-sm'>
                        <input id="participant-add-input-address"
                               name="address"
                               type="text"
                               class="form-control"
                               placeholder="Address"
                               aria-label="Address"
                               required>
                        <div class='input-group-append'>
                            <span class='input-group-text text-light'>
                              <i data-feather='circle'></i>
                            </span>
                        </div>
                      </div>
                    </div>
                    <div class='card col-12 col-lg-5 p-2'>
                      <div class='d-flex justify-content-between'>
                        <label class='h6'
                               for='participant-add-input-address-city'>
                          Address City
                        </label>
                        <small class='form-text text-muted text-right'>
                          Participants City of Residence.
                        </small>
                      </div>
                      <div class='input-group input-group-sm'>
                        <input id="participant-add-input-address-city"
                               name="address_city"
                               type="text"
                               class="form-control"
                               placeholder="Address City"
                               aria-label="Address City"
                               required>
                        <div class='input-group-append'>
                            <span class='input-group-text text-light'>
                              <i data-feather='circle'></i>
                            </span>
                        </div>
                      </div>
                    </div>
                    <div class='card col-12 col-lg-4 p-2'>
                      <div class='d-flex justify-content-between'>
                        <label class='h6'
                               for='participant-add-input-address-zip'>
                          Address Zip
                        </label>
                        <small class='form-text text-muted text-right'>
                          Participants Zip Code of Residence.
                        </small>
                      </div>
                      <div class='input-group input-group-sm'>
                        <input id="participant-add-input-address-zip"
                               name="address_zip"
                               type="text"
                               class="form-control"
                               placeholder="Address Zip Code"
                               aria-label="Address Zip Code"
                               required>
                        <div class='input-group-append'>
                            <span class='input-group-text text-light'>
                              <i data-feather='circle'></i>
                            </span>
                        </div>
                      </div>
                    </div>
                    <div class='card col-12 col-lg-8 p-2'>
                      <div class='d-flex justify-content-between'>
                        <label class='h6'
                               for='participant-add-input-address-state'>
                          Address State
                        </label>
                        <small class='form-text text-muted text-right'>
                          Participants State of Residence.
                        </small>
                      </div>
                      <div class='input-group input-group-sm'>
                        <select class='custom-select custom-select-sm'
                                id="participant-add-input-address-state"
                                name="address_state"
                                aria-label="State"
                                required>
                          <option value="AL">Alabama</option>
                          <option value="AK">Alaska</option>
                          <option value="AZ">Arizona</option>
                          <option value="AR">Arkansas</option>
                          <option value="CA">California</option>
                          <option value="CO">Colorado</option>
                          <option value="CT">Connecticut</option>
                          <option value="DE">Delaware</option>
                          <option value="DC">District Of Columbia</option>
                          <option value="FL">Florida</option>
                          <option value="GA">Georgia</option>
                          <option value="HI">Hawaii</option>
                          <option value="ID">Idaho</option>
                          <option value="IL">Illinois</option>
                          <option value="IN">Indiana</option>
                          <option value="IA">Iowa</option>
                          <option value="KS">Kansas</option>
                          <option value="KY">Kentucky</option>
                          <option value="LA">Louisiana</option>
                          <option value="ME">Maine</option>
                          <option value="MD">Maryland</option>
                          <option value="MA">Massachusetts</option>
                          <option value="MI">Michigan</option>
                          <option value="MN">Minnesota</option>
                          <option value="MS">Mississippi</option>
                          <option value="MO">Missouri</option>
                          <option value="MT">Montana</option>
                          <option value="NE">Nebraska</option>
                          <option value="NV">Nevada</option>
                          <option value="NH">New Hampshire</option>
                          <option value="NJ">New Jersey</option>
                          <option value="NM">New Mexico</option>
                          <option value="NY">New York</option>
                          <option value="NC">North Carolina</option>
                          <option value="ND">North Dakota</option>
                          <option value="OH">Ohio</option>
                          <option value="OK">Oklahoma</option>
                          <option value="OR">Oregon</option>
                          <option value="PA">Pennsylvania</option>
                          <option value="RI">Rhode Island</option>
                          <option value="SC">South Carolina</option>
                          <option value="SD">South Dakota</option>
                          <option value="TN">Tennessee</option>
                          <option value="TX">Texas</option>
                          <option value="UT">Utah</option>
                          <option value="VT">Vermont</option>
                          <option value="VA">Virginia</option>
                          <option value="WA">Washington</option>
                          <option value="WV">West Virginia</option>
                          <option value="WI">Wisconsin</option>
                          <option value="WY">Wyoming</option>
                        </select>
                        <div class='input-group-append'>
                            <span class='input-group-text text-light'>
                              <i data-feather='circle'></i>
                            </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class='card-footer bg-secondary text-light d-flex justify-content-between'>
                  <p>Add a new participant. Once created, they will be sent a new password in their email they can use to login.</p>
                  <div class='btn-toolbar'>
                    <?php
                      if (Account::query_from_email($_SESSION['user'])->isAdmin()){
                        echo "
                          <div class='input-group'>
                            <div class='input-group-prepend'>
                              <label class='input-group-text' for='participant-add-input-staff'>Create as Staff</label>
                            </div>
                            <div class='input-group-append'>
                              <div class='input-group-text'>
                                <input id='participant-add-input-staff' type='checkbox' name='is_staff' value='false'>
                              </div>
                            </div>
                          </div>
                          ";
                      }
                    ?>
                    <button class='btn btn-warning'
                            type='submit'>Add new Participant
                    </button>
                  </div>
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
</script>
</body>
</html>