/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************!*\
  !*** ./resources/assets/js/users/users.js ***!
  \********************************************/
document.addEventListener('DOMContentLoaded', loadUserTable);
var userTable = '#userTable';

function loadUserTable() {
  if (!$('#userTable').length) {
    return;
  }

  var userTbl = $(userTable).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    'order': [[7, 'desc']],
    ajax: {
      url: route('users.index')
    },
    columnDefs: [{
      'targets': [0],
      'width': '40%'
    }, {
      'targets': [1],
      'visible': false
    }, {
      'targets': [2],
      'width': '18%',
      'orderable': false
    }, {
      'targets': [3],
      'width': '13%',
      'orderable': false
    }, {
      'targets': [4],
      'width': '15%',
      'orderable': false
    }, {
      'targets': [5],
      'width': '8%'
    }, {
      'targets': [6],
      'orderable': false,
      'className': 'text-center',
      'width': '10%'
    }, {
      'targets': [7],
      'visible': false
    }],
    columns: [{
      data: function data(row) {
        return "<div class=\"d-flex\">\n                            <div class=\"symbol symbol-circle symbol-50px overflow-hidden me-3\">\n                                <a href=\"javascript:void(0)\">\n                                    <div class=\"symbol-label\">\n                                        <img src=\"".concat(row.profile_image, "\" alt=\"\"\n                                             class=\"w-100 cursor-default\">\n                                    </div>\n                                </a>\n                            </div>\n                            <div>\n                                <a href=\"").concat(route('users.show', row.id), "\"\n                                   class=\"text-primary-800 mb-1 d-block\">").concat(row.full_name, "</a>\n                                   <span class=\"d-block\">").concat(row.email, "</span>\n                            </div>\n                            </div>");
      },
      name: 'first_name'
    }, {
      data: 'last_name',
      name: 'last_name'
    }, {
      data: 'plan_name',
      name: 'id'
    }, {
      data: function data(row) {
        return "<div class=\"form-check form-switch\">\n                                <input class=\"form-check-input\" type=\"checkbox\" id=\"emailVerified\" name=\"email_verified_at\"\n                                data-id=\"".concat(row.id, "\" ").concat(!isEmpty(row.email_verified_at) ? 'disabled checked' : '', ">\n                            </div>");
      },
      name: 'email_verified_at'
    }, {
      data: function data(row) {
        if (row.is_active == 1) {
          return "<a href=\"javascript:void(0)\" data-id=\"".concat(row.id, "\" class=\"btn btn-sm btn-primary user-impersonate\">\n                               ").concat(impersonate, "\n                            </a>");
        } else {
          return "<a href=\"javascript:void(0)\" data-id=\"".concat(row.id, "\" style=\"pointer-events: none;\n  cursor: default;\" class=\"btn btn-sm btn-secondary user-impersonate\">\n                                ").concat(impersonate, "\n                            </a>");
        }
      },
      name: 'id'
    }, {
      data: function data(row) {
        return "<div class=\"form-check form-switch\">\n                                <input class=\"form-check-input\" type=\"checkbox\" id=\"userStatus\" name=\"is_active\"\n                                ".concat(row.is_active == 1 ? 'checked' : '', " data-id=\"").concat(row.id, "\">\n                            </div>");
      },
      name: 'is_active'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'editUrl': route('users.edit', row.id)
        }];
        return prepareTemplateRender('#actionsTemplates', data);
      },
      name: 'id'
    }, {
      data: function data(row) {
        return "<div class=\"badge badge-light\">\n                        <div>".concat(moment(row.created_at).format('YYYY-MM-DD'), "</div>\n                    </div>");
      },
      name: 'created_at'
    }]
  });
  handleSearchDatatable(userTbl);
}

listenClick('#emailVerified', function () {
  var userId = $(this).data('id');
  var updateUrl = route('users.email-verified', userId);
  $.ajax({
    type: 'get',
    url: updateUrl,
    success: function success(response) {
      displaySuccessMessage(response.message);
      $('#userTable').DataTable().ajax.reload();
    }
  });
});
listenClick('#userStatus', function () {
  var userId = $(this).data('id');
  var updateUrl = route('users.status', userId);
  $.ajax({
    type: 'get',
    url: updateUrl,
    success: function success(response) {
      displaySuccessMessage(response.message);
      $('#userTable').DataTable().ajax.reload();
    }
  });
});
listenClick('.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('users.destroy', recordId), userTable, 'User');
});
listen('contextmenu', '.user-impersonate', function (e) {
  e.preventDefault(); // Stop right click on link

  return false;
});
var control = false;
listen('keyup keydown', function (e) {
  control = e.ctrlKey;
});
listenClick('.user-impersonate', function () {
  if (control) {
    return false; // Stop ctrl + click on link
  }

  var id = $(this).data('id');
  var element = document.createElement('a');
  element.setAttribute('href', route('impersonate', id));
  document.body.appendChild(element);
  element.click();
  document.body.removeChild(element);
  $('.user-impersonate').prop('disabled', true);
});
/******/ })()
;