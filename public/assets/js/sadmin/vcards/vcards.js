/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************************!*\
  !*** ./resources/assets/js/sadmin/vcards/vcards.js ***!
  \*****************************************************/
document.addEventListener('DOMContentLoaded', loadSAdminVcardTable);
var sAdminVcardTable = '#vcardTable';

function loadSAdminVcardTable() {
  if (!$('#vcardTable').length) {
    return;
  }

  var sAdminVcardTbl = $(sAdminVcardTable).DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: route('sadmin.templates.index')
    },
    order: [2, 'desc'],
    columnDefs: [{
      'targets': [1],
      'orderable': false,
      'width': '35%'
    }, {
      'targets': [2],
      'width': '30%',
      searchable: false
    }],
    columns: [{
      data: 'name',
      name: 'name'
    }, {
      data: function data(row) {
        return "<div class=\"d-flex\">\n                                <a href=\"/".concat(row.name, "\" target=\"_blank\">\n                                <div class=\"symbol me-5\">\n                                   <img src=\"").concat(row.template_url, "\" alt=\"\" class=\"w-60\">\n                                </div>\n                                </a>\n                            </div>");
      },
      name: 'name'
    }, {
      data: function data(row) {
        if (row.user_count) {
          return row.user_count;
        } else {
          return notUsed;
        }
      },
      name: 'user_count'
    }]
  });
  handleSearchDatatable(sAdminVcardTbl);
}

listenClick('.copy-clipboard', function () {
  var vcardId = $(this).data('id');
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($('#vcardUrl' + vcardId).text()).select();
  document.execCommand("copy");
  $temp.remove();
  displaySuccessMessage('copied successfully');
});
/******/ })()
;