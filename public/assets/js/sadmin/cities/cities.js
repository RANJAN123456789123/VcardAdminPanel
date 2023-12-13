/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************************!*\
  !*** ./resources/assets/js/sadmin/cities/cities.js ***!
  \*****************************************************/
document.addEventListener('DOMContentLoaded', loadCityTable);
var cityTable = '#cityTable';

function loadCityTable() {
  if (!$('#cityTable').length) {
    return;
  }

  var cityTbl = $(cityTable).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    ajax: {
      url: route('cities.index')
    },
    columnDefs: [{
      'targets': [2],
      'orderable': false,
      'className': 'text-center text-nowrap' // 'width': '200px',

    }],
    columns: [{
      data: 'name',
      name: 'name'
    }, {
      data: 'state.name',
      name: 'state.name'
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
  handleSearchDatatable(cityTbl);
}

listenClick('#newCityBtn', function () {
  $('#addCityModal').modal('show');
});
$(document).on('select2:open', function () {
  document.querySelector('.select2-search__field').focus();
});
listenHiddenBsModal('#addCityModal', function (e) {
  $('#addNewForm')[0].reset();
  $('#StateCity').val(null).trigger('change');
});
listenSubmit('#addNewForm', function (e) {
  e.preventDefault();
  var cityUrl = route('cities.store');
  $.ajax({
    url: cityUrl,
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#addCityModal').modal('hide');
        $(cityTable).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenClick('.edit-btn', function (event) {
  var cityId = $(event.currentTarget).data('id');
  EditCityRenderData(cityId);
});

function EditCityRenderData(id) {
  var cityUrl = route('cities.edit', id);
  $.ajax({
    url: cityUrl,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#cityId').val(result.data.id);
        $('#editName').val(result.data.name);
        $('#editStateId').val(result.data.state_id).trigger('change');
        $('#editCityModal').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

listenSubmit('#editForm', function (event) {
  event.preventDefault();
  var cityId = $('#cityId').val();
  var cityUrl = route('cities.update', cityId);
  $.ajax({
    url: cityUrl,
    type: 'put',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editCityModal').modal('hide');
        $(cityTable).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenClick('.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('cities.destroy', recordId), cityTable, City);
});
/******/ })()
;