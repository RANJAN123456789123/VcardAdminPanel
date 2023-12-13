/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************************!*\
  !*** ./resources/assets/js/sadmin/countries/countries.js ***!
  \***********************************************************/
document.addEventListener('DOMContentLoaded', loadCountryTable);
var countryTable = '#countryTable';

function loadCountryTable() {
  if (!$('#countryTable').length) {
    return;
  }

  var countryTbl = $(countryTable).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    ajax: {
      url: route('countries.index')
    },
    columnDefs: [{
      'targets': [3],
      'orderable': false,
      'className': 'text-center text-nowrap',
      'width': '8%'
    }],
    columns: [{
      data: 'name',
      name: 'name'
    }, {
      data: 'short_code',
      name: 'short_code'
    }, {
      data: function data(row) {
        if (row.phone_code != null) {
          return '+' + row.phone_code;
        } else {
          return "N/A";
        }
      },
      name: 'phone_code'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'editUrl': 'javascript:void(0)'
        }];
        return prepareTemplateRender('#actionsTemplates', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(countryTbl);
}

listenClick('#newCountryBtn', function () {
  $('#addCountryModal').modal('show');
});
listenHiddenBsModal('#addCountryModal', function () {
  resetModalForm('#addCountryForm');
});
listenSubmit('#addCountryForm', function (e) {
  e.preventDefault();
  var countryUrl = route('countries.store');
  $.ajax({
    url: countryUrl,
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#addCountryModal').modal('hide');
        $(countryTable).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenClick('.edit-btn', function (event) {
  var countryId = $(event.currentTarget).data('id');
  EditCountryRenderData(countryId);
});

function EditCountryRenderData(id) {
  var countryUrl = route('countries.edit', id);
  $.ajax({
    url: countryUrl,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#countryId').val(result.data.id);
        $('#editName').val(result.data.name);
        $('#editShortCode').val(result.data.short_code);
        $('#editPhoneCode').val(result.data.phone_code);
        $('#editCountryModal').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

;
listenSubmit('#editForm', function (event) {
  event.preventDefault();
  var countryId = $('#countryId').val();
  var countryUrl = route('countries.update', countryId);
  $.ajax({
    url: countryUrl,
    type: 'put',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editCountryModal').modal('hide');
        $(countryTable).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenClick('.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('countries.destroy', recordId), countryTable, 'Country');
});
/******/ })()
;