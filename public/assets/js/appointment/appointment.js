/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************************!*\
  !*** ./resources/assets/js/appointment/appointment.js ***!
  \********************************************************/
document.addEventListener('DOMContentLoaded', loadAppointmentTable);
var appointmentTable = '#appointmentTable';

function loadAppointmentTable() {
  if (!appointmentTable.length) {
    return;
  }

  var appointmentTbl = $(appointmentTable).DataTable({
    processing: true,
    serverSide: true,
    'order': [[4, 'desc']],
    ajax: {
      url: route('appointments.index')
    },
    columnDefs: [{
      'targets': [4, 5, 6],
      'className': 'text-nowrap'
    }],
    columns: [{
      data: 'vcard.name',
      name: 'vcard.name'
    }, {
      data: 'name',
      name: 'name'
    }, {
      data: 'email',
      name: 'email'
    }, {
      data: function data(row) {
        if (row.phone) {
          return row.phone;
        } else {
          return 'N/A';
        }
      },
      name: 'email'
    }, {
      data: 'date',
      name: 'date'
    }, {
      data: 'from_time',
      name: 'from_time'
    }, {
      data: 'to_time',
      name: 'to_time'
    }]
  });
  handleSearchDatatable(appointmentTbl);
}
/******/ })()
;