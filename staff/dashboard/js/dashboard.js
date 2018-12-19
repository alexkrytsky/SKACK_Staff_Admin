let target = null;
let offset = 0;
let search = "";
let column = "name";
let order = true;

function queryDatabase() {
  let pageInput = $('#page');
  let tableName = $('#table-name');
  let tableEmail = $('#table-email');
  let tablePhone = $('#table-phone');
  let tableLast = $('#table-last');
  $.ajax({
    url: '/staff/dashboard/components/DashboardTable.php',
    type: 'post',
    data: {
      'offset': offset,
      'search': search,
      'column': column,
      'order': order
    },
    success: function (data) {
      $('#table-wrapper').html(data);
      $('[data-tooltip="tooltip"]').tooltip();

      tableName.html('Name <i data-feather="circle"></i>');
      tableEmail.html('Email <i data-feather="circle"></i>');
      tablePhone.html('Phone <i data-feather="circle"></i>');
      tableLast.html('Last Updated <i data-feather="circle"></i>');

      switch (column) {
        case 'name':
          tableName.html('Name <i data-feather="' + (order ? 'arrow-up-circle' : 'arrow-down-circle') + '"></i>');
          break;
        case 'email':
          tableEmail.html('Email <i data-feather="' + (order ? 'arrow-up-circle' : 'arrow-down-circle') + '"></i>');
          break;
        case 'phone':
          tablePhone.html('Phone <i data-feather="' + (order ? 'arrow-up-circle' : 'arrow-down-circle') + '"></i>');
          break;
        case 'last_update':
          tableLast.html('Last Updated <i data-feather="' + (order ? 'arrow-up-circle' : 'arrow-down-circle') + '"></i>');
          break;
      }
      feather.replace();
      pageInput.val(offset / 25 + 1);
    }
  });
}

$(function () {
  target = $('#client-list');
  let backButton = $('#back');
  let pageInput = $('#page');
  let nextButton = $('#next');
  let tableName = $('#table-name');
  let tableEmail = $('#table-email');
  let tablePhone = $('#table-phone');
  let tableLast = $('#table-last');
  let timeoutID = 0;

  $('#search-bar').on('input', function () {
    search = this.value;
    window.clearTimeout(timeoutID);
    offset = 0;
    timeoutID = window.setTimeout(queryDatabase, 1000);
  });

  queryDatabase();

  tableName.on('click', function () {
    if (column === 'name') {
      order = !order;
    } else {
      order = true;
    }
    column = 'name';
    offset = 0;
    window.clearTimeout(timeoutID);
    timeoutID = window.setTimeout(queryDatabase, 10);
  });

  tableEmail.on('click', function () {
    if (column === 'email') {
      order = !order;
    } else {
      order = true;
    }
    column = 'email';
    offset = 0;
    window.clearTimeout(timeoutID);
    timeoutID = window.setTimeout(queryDatabase, 10);
  });

  tablePhone.on('click', function () {
    if (column === 'phone') {
      order = !order;
    } else {
      order = true;
    }
    column = 'phone';
    offset = 0;
    window.clearTimeout(timeoutID);
    timeoutID = window.setTimeout(queryDatabase, 10);
  });

  tableLast.on('click', function () {
    if (column === 'last_update') {
      order = !order;
    } else {
      order = true;
    }
    column = 'last_update';
    offset = 0;
    window.clearTimeout(timeoutID);
    timeoutID = window.setTimeout(queryDatabase, 10);
  });

  // PAGE BUTTONS

  backButton.on('click', function () {
    if (offset > 0)
      offset -= 25;

    window.clearTimeout(timeoutID);
    timeoutID = window.setTimeout(queryDatabase, 200);
  });

  nextButton.on('click', function () {
    offset += 25;

    window.clearTimeout(timeoutID);
    timeoutID = window.setTimeout(queryDatabase, 200);
  });

  pageInput.on('input', function () {
    offset = (this.value - 1) * 25;

    window.clearTimeout(timeoutID);
    timeoutID = window.setTimeout(queryDatabase, 200);
  });

  feather.replace()
});