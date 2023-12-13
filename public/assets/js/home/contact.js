/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************************!*\
  !*** ./resources/assets/js/home/contact.js ***!
  \*********************************************/
document.addEventListener('DOMContentLoaded', loadContact);

function displayError(selector, msg) {
  var selectorAttr = $(selector);
  selectorAttr.removeClass('d-none');
  selectorAttr.show();
  selectorAttr.text(msg);
  setTimeout(function () {
    $(selector).slideUp();
  }, 3000);
}

listenSubmit('#myForm', function (event) {
  event.preventDefault();
  $.ajax({
    url: route('contact.store'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#myForm')[0].reset();
      }
    },
    error: function error(result) {
      displayError('#contactError', result.responseJSON.message);
    }
  });
});

function loadContact() {
  if (window.location.href === route('contact.contactus')) {
    var contactTable = '#ContactTable';
    var contactTbl = $(contactTable).DataTable({
      processing: true,
      serverSide: true,
      'language': {
        'lengthMenu': 'Show _MENU_'
      },
      'order': [[0, 'asc']],
      ajax: {
        url: route('contact.contactus')
      },
      columnDefs: [{
        'targets': [0],
        'width': '15%'
      }],
      columns: [{
        data: 'name',
        name: 'name'
      }, {
        data: 'email',
        name: 'email'
      }, {
        data: 'subject',
        name: 'subject'
      }, {
        data: 'message',
        name: 'message'
      }]
    });
    handleSearchDatatable(contactTbl);
  }
}
/******/ })()
;