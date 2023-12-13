/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************************!*\
  !*** ./resources/assets/js/sadmin/states/states.js ***!
  \*****************************************************/
document.addEventListener('DOMContentLoaded', loadStateTable);
var stateTable = '#stateTable';

function loadStateTable() {
  if (!$('#stateTable').length) {
    return;
  }

  var StateTbl = $(stateTable).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    ajax: {
      url: route('states.index')
    },
    columnDefs: [{
      'targets': [2],
      'orderable': false,
      'className': 'text-center text-nowrap'
    }],
    columns: [{
      data: 'name',
      name: 'name'
    }, {
      data: 'country.name',
      name: 'country.name'
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
  handleSearchDatatable(StateTbl);
}

$(document).on('select2:open', function () {
  document.querySelector('.select2-search__field').focus();
});
listenClick('#newStateBtn', function () {
  $('#addStateModal').modal('show');
});
listenHiddenBsModal('#addStateModal', function (e) {
  $('#addNewForm')[0].reset();
  $('#countryState').val(null).trigger('change');
});
listenSubmit('#addNewForm', function (e) {
  e.preventDefault();
  var stateUrl = route('states.store');
  $.ajax({
    url: stateUrl,
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#addStateModal').modal('hide');
        $(stateTable).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenClick('.edit-btn', function (event) {
  var stateId = $(event.currentTarget).data('id');
  EditStateRenderData(stateId);
});

function EditStateRenderData(id) {
  var stateUrl = route('states.edit', id);
  $.ajax({
    url: stateUrl,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#stateId').val(result.data.id);
        $('#editName').val(result.data.name);
        $('#editCountryId').val(result.data.country_id).trigger('change');
        $('#editStateModal').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

listenSubmit('#editForm', function (event) {
  event.preventDefault();
  var stateId = $('#stateId').val();
  var stateUrl = route('states.update', stateId);
  $.ajax({
    url: stateUrl,
    type: 'put',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editStateModal').modal('hide');
        $(stateTable).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenClick('.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('states.destroy', recordId), stateTable, State);
});
/******/ })()
;