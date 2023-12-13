/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/assets/js/vcards/template.js ***!
  \************************************************/
document.addEventListener('DOMContentLoaded', loadTemplateTable);
var templateTable = '#templateTable';

function loadTemplateTable() {
  if (!$('#templateTable').length) {
    return;
  }

  var templateTbl = $(templateTable).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    ajax: {
      url: route('sadmin.vcards.index')
    },
    columnDefs: [{
      'targets': [0],
      'className': 'text-nowrap'
    }, {
      'targets': [2],
      'className': '  text-nowrap'
    }, {
      'targets': [1, 4],
      'className': 'text-center'
    }, {
      'targets': [3],
      'orderable': false,
      'searchable': false
    }],
    columns: [{
      data: function data(row) {
        return "<div class=\"d-flex\">\n                                <div class=\"symbol me-5\">\n                                   <img src=\"".concat(isEmpty(row.template) ? defaultTemplate : row.template.template_url, "\" alt=\"\" class=\"w-60\">\n                                </div>\n                                <div class=\"d-inline-block align-top\">\n                                   <span class=\"text-primary mb-1 d-block\"> ").concat(row.name, " </span>\n                                   <span class=\"d-block\"> ").concat(row.occupation, " </span>\n                                </div>\n                            </div>");
      },
      name: 'name'
    }, {
      data: function data(row) {
        return row.tenant.tenant_username;
      },
      name: 'tenant.tenant_username'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'status': row.status,
          'vcardViewUrl': route('vcard.defaultIndex') + '/' + row.url_alias
        }];
        return prepareTemplateRender('#vcardActionTemplate', data);
      },
      name: 'url_alias'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'analyticsUrl': route('sadmin.vcard.analytics', row.id)
        }];
        return prepareTemplateRender('#analyticsSadminTemplate', data);
      },
      name: 'stats'
    }, {
      data: function data(row) {
        return row;
      },
      render: function render(row) {
        if (row.created_at === null) {
          return 'N/A';
        }

        return "<div class=\"badge badge-light\">\n                                <div>".concat(moment(row.created_at).format('Do MMM, Y'), "</div>\n                            </div>");
      },
      name: 'created_at'
    }, {
      data: function data(row) {
        if (row.status == 1) {
          return "<span class=\"badge bg-success\">".concat(Active, "</span>");
        } else {
          return "<span class=\"badge bg-danger\">".concat(DeActive, "</span>");
        }
      },
      name: 'status'
    }]
  });
  handleSearchDatatable(templateTbl);
}

listenClick('.copy-clipboard', function () {
  var vcardId = $(this).data('id');
  var $temp = $('<input>');
  $('body').append($temp);
  $temp.val($('#vcardUrl' + vcardId).text()).select();
  document.execCommand('copy');
  $temp.remove();
  displaySuccessMessage('copied successfully');
});
/******/ })()
;