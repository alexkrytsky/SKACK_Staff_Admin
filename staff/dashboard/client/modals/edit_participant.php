<?php
/**
 * edit_participant.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 2/27/18
 */
?>

<div class="modal fade"
     id="edit-client"
     tabindex="-1"
     role="dialog"
     aria-labelledby="edit-client-label"
     aria-hidden="true">
  <div class="modal-dialog modal-lg"
       role="document">
    <div class="modal-content">
      <!-- === Modal Header ===== -->
      <div class="modal-header bg-dark text-light">
        <h5 class="modal-title"
            id="edit-client-label">
          Edit Participant Information
        </h5>
        <button class="close text-light"
                type="button"
                data-dismiss="modal"
                aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- === Modal Header End ===== -->
      <div class="modal-body bg-light p-0 m-0">
        <form id="client-edit-form"
              action="/api/client/<?php echo $client_id ?>"
              method="post">
          <ul class='list-group list-group-flush'>

            <!-- === First Name Input ===== -->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='client-edit-input-first-name'>
                  First Name
                </label>
                <small class='form-text text-muted text-right'>
                  Participants First Name.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input id="client-edit-input-first-name"
                       name="first_name"
                       type="text"
                       class="form-control"
                       value="<?php echo $first_name ?>"
                       placeholder="First Name"
                       aria-label="First Name"
                       required>
                <div class='input-group-append'>
                  <span class='input-group-text text-light'>
                    <i data-feather='circle'></i>
                  </span>
                </div>
              </div>
              <small class='form-text text-muted'>
                Original:
                <span class='font-italic'
                      id='client-edit-input-first-name-original'>
                  <?php echo $first_name ?>
                </span>
              </small>
            </li>

            <!-- === Middle Name Input ===== -->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='client-edit-input-middle-name'>
                  Middle Name
                </label>
                <small class='form-text text-muted text-right'>
                  Participants Middle Name, Optional.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input id="client-edit-input-middle-name"
                       name="middle_name"
                       type="text"
                       class="form-control"
                       value="<?php echo $middle_name ?>"
                       placeholder="Middle Name"
                       aria-label="Middle Name">
                <div class='input-group-append'>
                  <span class='input-group-text text-light'>
                    <i data-feather='circle'></i>
                  </span>
                </div>
              </div>
              <small class='form-text text-muted'>
                Original:
                <span class='font-italic'
                      id='client-edit-input-middle-name-original'>
                  <?php echo $middle_name ?>
                </span>
              </small>
            </li>

            <!-- === Last Name Input ===== -->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='client-edit-input-last-name'>
                  Last Name
                </label>
                <small class='form-text text-muted text-right'>
                  Participants Last Name.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input id="client-edit-input-last-name"
                       name="last_name"
                       type="text"
                       class="form-control"
                       value="<?php echo $last_name ?>"
                       placeholder="Last Name"
                       aria-label="Last Name"
                       required>
                <div class='input-group-append'>
                  <span class='input-group-text text-light'>
                    <i data-feather='circle'></i>
                  </span>
                </div>
              </div>
              <small class='form-text text-muted'>
                Original:
                <span class='font-italic'
                      id='client-edit-input-last-name-original'>
                  <?php echo $last_name ?>
                </span>
              </small>
            </li>

            <!-- === Phone Number Input ===== -->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='client-edit-input-phone'>
                  Phone Number
                </label>
                <small class='form-text text-muted text-right'>
                  Participants Phone Number.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input id="client-edit-input-phone"
                       name="phone"
                       type="tel"
                       class="form-control"
                       value="<?php echo $phone ?>"
                       placeholder="Phone"
                       aria-label="Phone"
                       required>
                <div class='input-group-append'>
                  <span class='input-group-text text-light'>
                    <i data-feather='circle'></i>
                  </span>
                </div>
              </div>
              <small class='form-text text-muted'>
                Original:
                <span class='font-italic'
                      id='client-edit-input-phone-original'>
                  <?php echo $phone ?>
                </span>
              </small>
            </li>

            <!-- === Email Address Input ===== -->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='client-edit-input-email'>
                  Email Address
                </label>
                <small class='form-text text-muted text-right'>
                  Participants Email Address.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input id="client-edit-input-email"
                       name="email"
                       type="email"
                       class="form-control"
                       value="<?php echo $email ?>"
                       placeholder="Email Address"
                       aria-label="Email Address"
                       required>
                <div class='input-group-append'>
                  <span class='input-group-text text-light'>
                    <i data-feather='circle'></i>
                  </span>
                </div>
              </div>
              <small class='form-text text-muted'>
                Original:
                <span class='font-italic'
                      id='client-edit-input-email-original'>
                  <?php echo $email ?>
                </span>
              </small>
            </li>

            <!-- === Address Input ===== -->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='client-edit-input-address'>
                  Address
                </label>
                <small class='form-text text-muted text-right'>
                  Participants Street Address of Residence.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input id="client-edit-input-address"
                       name="address"
                       type="text"
                       class="form-control"
                       value="<?php echo $address ?>"
                       placeholder="Address"
                       aria-label="Address"
                       required>
                <div class='input-group-append'>
                  <span class='input-group-text text-light'>
                    <i data-feather='circle'></i>
                  </span>
                </div>
              </div>
              <small class='form-text text-muted'>
                Original:
                <span class='font-italic'
                      id='client-edit-input-address-original'>
                  <?php echo $address ?>
                </span>
              </small>
            </li>

            <!-- === Address City Input ===== -->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='client-edit-input-address-city'>
                  City
                </label>
                <small class='form-text text-muted text-right'>
                  Participants City of Residence.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input id="client-edit-input-address-city"
                       name="address_city"
                       type="text"
                       class="form-control"
                       value="<?php echo $address_city ?>"
                       placeholder="City"
                       aria-label="City"
                       required>
                <div class='input-group-append'>
                  <span class='input-group-text text-light'>
                    <i data-feather='circle'></i>
                  </span>
                </div>
              </div>
              <small class='form-text text-muted'>
                Original:
                <span class='font-italic'
                      id='client-edit-input-address-city-original'>
                  <?php echo $address_city ?>
                </span>
              </small>
            </li>

            <!-- === Address Zip Code Input ===== -->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='client-edit-input-address-zip'>
                  Zip Code
                </label>
                <small class='form-text text-muted text-right'>
                  Participants Zip Code of Residence.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input id="client-edit-input-address-zip"
                       name="address_zip"
                       type="text"
                       class="form-control"
                       value="<?php echo $address_zip ?>"
                       placeholder="Zip Code"
                       aria-label="Zip Code"
                       required>
                <div class='input-group-append'>
                  <span class='input-group-text text-light'>
                    <i data-feather='circle'></i>
                  </span>
                </div>
              </div>
              <small class='form-text text-muted'>
                Original:
                <span class='font-italic'
                      id='client-edit-input-address-zip-original'>
                  <?php echo $address_zip ?>
                </span>
              </small>
            </li>

            <!-- === Address State Input ===== -->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='client-edit-input-address-state'>
                  State
                </label>
                <small class='form-text text-muted text-right'>
                  Participants State of Residence.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <select class='custom-select custom-select-sm'
                        id="client-edit-input-address-state"
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
              <small class='form-text text-muted'>
                Original:
                <span class='font-italic'
                      id='client-edit-input-address-state-original'>
                  <?php echo $address_state ?>
                </span>
              </small>
            </li>
          </ul>
        </form>
      </div>
      <!-- === Button Toolbar ===== -->
      <div class="modal-footer bg-secondary btn-toolbar ">
        <button class="btn btn-secondary"
                type="button"
                data-dismiss="modal">
          Cancel
        </button>
        <button class="btn btn-warning"
                type="submit"
                form="client-edit-form">
          Confirm Edit
        </button>
      </div>
      <!-- === Button Toolbar End ===== -->
    </div>
  </div>
</div>

<script>
  $('#client-edit-input-address-state').val('<?php echo $address_state?>');
</script>