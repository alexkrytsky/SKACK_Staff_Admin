<div class='modal fade'
     id='add-contact'
     tabindex='-1'
     role='dialog'
     aria-labelledby='add-contact-label'
     aria-hidden='true'>
  <div class='modal-dialog modal-lg'
       role='document'>
    <div class='modal-content'>
      <!-- Modal Header -->
      <div class='modal-header bg-dark text-light'>
        <h5 class='modal-title'
            id='add-contact-label'>
          Add Contact Information
        </h5>
        <button class='close text-light'
                type='button'
                data-dismiss='modal'
                aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <!-- Modal Header End -->
      <div class='modal-body bg-light p-0 m-0'>
        <form id='contact-add-form'
              action='/api/client/<?php echo $client_id ?>/contact'
              method='post'>
          <ul class='list-group list-group-flush'>

            <!--Relation-->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='contact-add-select-relation'>
                  Relation
                </label>
                <small class='form-text text-muted text-right'>
                  Contacts relation to the Participant.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <select class='custom-select custom-select-sm'
                        id='contact-add-select-relation'
                        name='relation'
                        aria-label='Relation'
                        required>
                  <option value='Residential Provider'>Residential Provider</option>
                  <option value='Guardian'>Guardian</option>
                  <option value='NSA (Client Rep.)'>NSA (Client Rep.)</option>
                </select>
                <div class='input-group-append'>
                  <span class='input-group-text text-light'>
                    <i data-feather='circle'></i>
                  </span>
                </div>
              </div>
            </li>

            <!--First Name-->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='contact-add-input-first-name'>
                  First Name
                </label>
                <small class='form-text text-muted text-right'>
                  Contacts First Name.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input class='form-control'
                       id='contact-add-input-first-name'
                       name='first_name'
                       type='text'
                       placeholder='First Name'
                       aria-label='First Name'
                       required>
                <div class='input-group-append'>
                  <span class='input-group-text text-light'>
                    <i data-feather='circle'></i>
                  </span>
                </div>
              </div>
            </li>

            <!--Last Name-->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='contact-add-input-last-name'>
                  Last Name
                </label>
                <small class='form-text text-muted text-right'>
                  Contacts Last Name.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input class='form-control'
                       id='contact-add-input-last-name'
                       name='last_name'
                       type='text'
                       placeholder='Last Name'
                       aria-label='Last Name'
                       required>
                <div class='input-group-append'>
                  <span class='input-group-text text-light'>
                    <i data-feather='circle'></i>
                  </span>
                </div>
              </div>
            </li>

            <!--Phone Number-->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='contact-add-input-phone'>
                  Phone Number
                </label>
                <small class='form-text text-muted text-right'>
                  Contacts 10 Digit Phone Number.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input class='form-control'
                       id='contact-add-input-phone'
                       name='phone'
                       type='tel'
                       placeholder='##########'
                       aria-label='Phone Number'
                       maxlength='10'
                       required>
                <div class='input-group-append'>
                  <span class='input-group-text text-light'>
                    <i data-feather='circle'></i>
                  </span>
                </div>
              </div>
            </li>

            <!--Email-->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='contact-add-input-email'>
                  Email Address
                </label>
                <small class='form-text text-muted text-right'>
                  Contacts Email Address.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input class='form-control'
                       id='contact-add-input-email'
                       name='email'
                       type='email'
                       placeholder='example@site.com'
                       aria-label='Email Address'
                       required>
                <div class='input-group-append'>
                  <span class='input-group-text text-light'>
                    <i data-feather='circle'></i>
                  </span>
                </div>
              </div>
            </li>

            <!--Address-->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='contact-add-input-address'>
                  Address
                </label>
                <small class='form-text text-muted text-right'>
                  Contacts Street Address of Residence.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input class='form-control'
                       id='contact-add-input-address'
                       name='address'
                       type='text'
                       placeholder='Address'
                       aria-label='Address'
                       required>
                <div class='input-group-append'>
                  <span class='input-group-text text-light'>
                    <i data-feather='circle'></i>
                  </span>
                </div>
              </div>
            </li>

            <!-- City -->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='contact-add-input-address-city'>
                  City
                </label>
                <small class='form-text text-muted text-right'>
                  Contacts City of Residence.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input class='form-control'
                       id='contact-add-input-address-city'
                       name='address_city'
                       type='text'
                       placeholder='City'
                       aria-label='City'
                       required>
                <div class='input-group-append'>
                  <span class='input-group-text text-light'>
                    <i data-feather='circle'></i>
                  </span>
                </div>
              </div>
            </li>

            <!-- Zip Code -->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='contact-add-input-address-zip'>
                  Zip Code
                </label>
                <small class='form-text text-muted text-right'>
                  Contacts Zip Code of Residence.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input class='form-control'
                       id='contact-add-input-address-zip'
                       name='address_zip'
                       type='text'
                       placeholder='Zip Code'
                       aria-label='Zip Code'
                       required>
                <div class='input-group-append'>
                  <span class='input-group-text text-light'>
                    <i data-feather='circle'></i>
                  </span>
                </div>
              </div>
            </li>

            <!-- State -->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='contact-add-input-address-state'>
                  State
                </label>
                <small class='form-text text-muted text-right'>
                  Contacts State of Residence.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <select class='custom-select custom-select-sm'
                        id='contact-add-input-address-state'
                        name='address_state'
                        aria-label='State'
                        required>
                  <option value='AL'>Alabama</option>
                  <option value='AK'>Alaska</option>
                  <option value='AZ'>Arizona</option>
                  <option value='AR'>Arkansas</option>
                  <option value='CA'>California</option>
                  <option value='CO'>Colorado</option>
                  <option value='CT'>Connecticut</option>
                  <option value='DE'>Delaware</option>
                  <option value='DC'>District Of Columbia</option>
                  <option value='FL'>Florida</option>
                  <option value='GA'>Georgia</option>
                  <option value='HI'>Hawaii</option>
                  <option value='ID'>Idaho</option>
                  <option value='IL'>Illinois</option>
                  <option value='IN'>Indiana</option>
                  <option value='IA'>Iowa</option>
                  <option value='KS'>Kansas</option>
                  <option value='KY'>Kentucky</option>
                  <option value='LA'>Louisiana</option>
                  <option value='ME'>Maine</option>
                  <option value='MD'>Maryland</option>
                  <option value='MA'>Massachusetts</option>
                  <option value='MI'>Michigan</option>
                  <option value='MN'>Minnesota</option>
                  <option value='MS'>Mississippi</option>
                  <option value='MO'>Missouri</option>
                  <option value='MT'>Montana</option>
                  <option value='NE'>Nebraska</option>
                  <option value='NV'>Nevada</option>
                  <option value='NH'>New Hampshire</option>
                  <option value='NJ'>New Jersey</option>
                  <option value='NM'>New Mexico</option>
                  <option value='NY'>New York</option>
                  <option value='NC'>North Carolina</option>
                  <option value='ND'>North Dakota</option>
                  <option value='OH'>Ohio</option>
                  <option value='OK'>Oklahoma</option>
                  <option value='OR'>Oregon</option>
                  <option value='PA'>Pennsylvania</option>
                  <option value='RI'>Rhode Island</option>
                  <option value='SC'>South Carolina</option>
                  <option value='SD'>South Dakota</option>
                  <option value='TN'>Tennessee</option>
                  <option value='TX'>Texas</option>
                  <option value='UT'>Utah</option>
                  <option value='VT'>Vermont</option>
                  <option value='VA'>Virginia</option>
                  <option value='WA'
                          selected>Washington
                  </option>
                  <option value='WV'>West Virginia</option>
                  <option value='WI'>Wisconsin</option>
                  <option value='WY'>Wyoming</option>
                </select>
                <div class='input-group-append'>
                  <span class='input-group-text text-light'>
                    <i data-feather='circle'></i>
                  </span>
                </div>
              </div>
            </li>
          </ul>
        </form>
      </div>
      <div class='modal-footer bg-secondary btn-toolbar'>
        <button type='button'
                class='btn btn-secondary'
                data-dismiss='modal'>
          Cancel
        </button>
        <button type='submit'
                class='btn btn-warning'
                form='contact-add-form'>
          Confirm Addition
        </button>
      </div>
    </div>
  </div>
</div>

<script>

</script>