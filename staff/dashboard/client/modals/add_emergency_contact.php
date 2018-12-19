<div class='modal fade'
     id='add-emergency-contact'
     tabindex='-1'
     role='dialog'
     aria-labelledby='add-emergency-contact-label'
     aria-hidden='true'>
  <div class='modal-dialog modal-lg'
       role='document'>
    <div class='modal-content'>
      <!-- Modal Header -->
      <div class='modal-header bg-dark text-light'>
        <h5 class='modal-title'
            id='add-emergency-contact-label'>
          Add Emergency Contact Information
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
        <form id='emergency-contact-add-form'
              action='/api/client/<?php echo $client_id ?>/emergency_contact'
              method='post'>
          <ul class='list-group list-group-flush'>
            <!--First Name-->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='emergency-contact-add-input-first-name'>
                  First Name
                </label>
                <small class='form-text text-muted text-right'>
                  Contacts First Name.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input class='form-control'
                       id='emergency-contact-add-input-first-name'
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
                       for='emergency-contact-add-input-last-name'>
                  Last Name
                </label>
                <small class='form-text text-muted text-right'>
                  Contacts Last Name.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input class='form-control'
                       id='emergency-contact-add-input-last-name'
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
                       for='emergency-contact-add-input-phone'>
                  Phone Number
                </label>
                <small class='form-text text-muted text-right'>
                  Contacts 10 Digit Phone Number.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input class='form-control'
                       id='emergency-contact-add-input-phone'
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
            <!-- Alternative Phone Number-->
            <li class='list-group-item py-1'>
              <div class='d-flex justify-content-between'>
                <label class='h6'
                       for='emergency-contact-add-input-phone'>
                  Alternate Phone Number
                </label>
                <small class='form-text text-muted text-right'>
                  Contacts 10 Digit Alternate Phone Number.
                </small>
              </div>
              <div class='input-group input-group-sm'>
                <input class='form-control'
                       id='emergency-contact-add-input-phone-alt'
                       name='alternate_phone'
                       type='tel'
                       placeholder='##########'
                       aria-label='Alternate Phone Number'
                       maxlength='10'>
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
      <div class='modal-footer bg-secondary btn-toolbar '>
        <button type='button'
                class='btn btn-secondary'
                data-dismiss='modal'>
          Cancel
        </button>
        <button type='submit'
                class='btn btn-warning'
                form='emergency-contact-add-form'>
          Confirm add
        </button>
      </div>
    </div>
  </div>
</div>
