/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/assets/js/vcards/vcards.js ***!
  \**********************************************/
document.addEventListener('DOMContentLoaded', loadVcardTable);
var vcardTable = '#vcardTable';

function loadVcardTable() {
  var vcardTbl = $(vcardTable).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    ajax: {
      url: route('vcards.index')
    },
    columnDefs: [{
      'targets': [0],
      'className': 'text-nowrap'
    }, {
      'targets': [1],
      'visible': false
    }, {
      'targets': [2],
      'className': 'text-center text-nowrap'
    }, {
      'targets': [3],
      'visible': !!Analytics,
      'orderable': false,
      'searchable': false
    }, {
      'targets': [5],
      'className': 'text-center'
    }, {
      'targets': [6],
      'orderable': false,
      'className': 'text-center text-nowrap'
    }],
    columns: [{
      data: function data(row) {
        return "<div class=\"d-flex\">\n                                <div class=\"symbol me-5\">\n                                   <img src=\"".concat(isEmpty(row.template) ? defaultTemplate : row.template.template_url, "\" alt=\"\" class=\"w-60\">\n                                </div>\n                                <div class=\"d-inline-block align-top\">\n                                   <a class=\"text-primary mb-1 d-block\" href=\"").concat(route('vcards.edit', row.id), "\" > ").concat(row.name, " </a>\n                                   <span class=\"d-block\"> ").concat(row.occupation, " </span>\n                                </div>\n                            </div>");
      },
      name: 'name'
    }, {
      data: 'occupation',
      name: 'occupation'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'copy': copy,
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
          'analyticsUrl': route('vcard.analytics', row.id)
        }];
        return prepareTemplateRender('#analyticsTemplate', data);
      },
      name: 'stats'
    }, {
      data: function data(row) {
        return "<div class=\"form-check form-switch\">\n                                <input class=\"form-check-input\" type=\"checkbox\" id=\"vcardStatus\" name=\"is_active\"\n                                ".concat(row.status == 1 ? 'checked' : '', " data-id=\"").concat(row.id, "\">\n                            </div>");
      },
      name: 'status'
    }, {
      data: function data(row) {
        return format(row.created_at, 'Do MMM, YYYY');
      },
      name: 'created_at'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'editUrl': route('vcards.edit', row.id),
          'enquiryUrl': route('enquiry.index', row.id)
        }];
        return prepareTemplateRender('#actionsTemplates', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(vcardTbl);
}

$(document).on('click', '#vcardStatus', function () {
  var vcardId = $(this).data('id');
  var updateUrl = route('vcard.status', vcardId);
  $.ajax({
    type: 'get',
    url: updateUrl,
    success: function success(response) {
      displaySuccessMessage(response.message);
      $('#vcardTable').DataTable().ajax.reload();
    }
  });
});
$(document).on('click', '.copy-clipboard', function () {
  var vcardId = $(this).data('id');
  var $temp = $('<input>');
  $('body').append($temp);
  $temp.val($('#vcardUrl' + vcardId).text()).select();
  document.execCommand('copy');
  $temp.remove();
  displaySuccessMessage('copied successfully');
});
$(document).on('click', '.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteVcard(route('vcards.destroy', recordId), vcardTable, 'VCard');
});

window.deleteVcard = function (url, tableId, header) {
  var callFunction = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
  Swal.fire({
    title: Lang.get('messages.common.delete') + ' !',
    text: Lang.get('messages.common.are_you_sure') + '"' + header + '" ?',
    type: 'warning',
    icon: 'warning',
    showCancelButton: true,
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
    cancelButtonText: Lang.get('messages.common.no'),
    confirmButtonText: Lang.get('messages.common.yes'),
    confirmButtonColor: '#009ef7'
  }).then(function (result) {
    if (result.isConfirmed) {
      deleteVcardAjax(url, tableId, header, callFunction);
    }
  });
};

function deleteVcardAjax(url, tableId, header) {
  var callFunction = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
  $.ajax({
    url: url,
    type: 'DELETE',
    dataType: 'json',
    success: function success(obj) {
      if (obj.success) {
        if ($(tableId).DataTable().data().count() == 1) {
          $(tableId).DataTable().page('previous').draw('page');
        } else {
          $(tableId).DataTable().ajax.reload(null, false);
        }

        obj.data.make_vcard ? $('.create-vcard-btn').removeClass('d-none') : $('.create-vcard-btn').addClass('d-none');
      }

      Swal.fire({
        title: Lang.get('messages.common.deleted') + ' !',
        text: header + Lang.get('messages.common.has_been_deleted'),
        icon: 'success',
        timer: 2000,
        confirmButtonColor: '#009ef7'
      });

      if (callFunction) {
        eval(callFunction);
      }
    },
    error: function error(data) {
      Swal.fire({
        title: 'Error',
        icon: 'error',
        text: data.responseJSON.message,
        type: 'error',
        timer: 5000,
        confirmButtonColor: '#009ef7'
      });
    }
  });
}
/******/ })()
;