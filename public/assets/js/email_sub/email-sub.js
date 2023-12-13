/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************************!*\
  !*** ./resources/assets/js/email_sub/email-sub.js ***!
  \****************************************************/
document.addEventListener('DOMContentLoaded', loadEmailSubTable);
var emailSubTable = '#emailSubTable';

function loadEmailSubTable() {
  var emailTbl = $(emailSubTable).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    'order': [[0, 'asc']],
    ajax: {
      url: route('email.sub.index')
    },
    columnDefs: [{
      'targets': [0],
      'width': '15%'
    }, {
      'targets': [1],
      'orderable': false,
      'className': 'text-center',
      'width': '1%'
    }],
    columns: [{
      data: 'email',
      name: 'email'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id
        }];
        return prepareTemplateRender('#emailSubTemplate', data);
      },
      name: 'id'
    }]
  });
}

listenClick('.delete-btn', function (event) {
  var deleteRecordId = $(event.currentTarget).data('id');
  deleteItem(route('email.sub.destroy', deleteRecordId), emailSubTable, 'Subscription');
});
/******/ })()
;