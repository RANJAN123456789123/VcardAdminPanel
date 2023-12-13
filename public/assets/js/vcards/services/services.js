/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************************************!*\
  !*** ./resources/assets/js/vcards/services/services.js ***!
  \*********************************************************/
document.addEventListener('DOMContentLoaded', loadServiceTable);
var serviceTable = '#serviceTable';

function loadServiceTable() {
  if (!$('#serviceTable').length) {
    return;
  }

  var serviceTbl = $(serviceTable).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    ajax: {
      url: route('vcard.service.index', vcardId)
    },
    order: [1, 'asc'],
    columnDefs: [{
      'targets': [0],
      'orderable': false,
      'width': '20%'
    }, {
      'targets': [2],
      'orderable': false,
      'className': 'text-center text-nowrap',
      'width': '12%'
    }],
    columns: [{
      data: function data(row) {
        return "<div class=\"symbol-label cursor-default\">\n                                        <img src=\"".concat(row.service_icon, "\" alt=\"\"\n                                             class=\"custom-circle\" width=\"80\" height=\"80\">\n                                    </div>");
      },
      name: 'id'
    }, {
      data: 'name',
      name: 'name'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'editUrl': 'javascript:void(0)'
        }];
        return prepareTemplateRender('#serviceActionTemplate', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(serviceTbl);
}

listenClick('#addServiceBtn', function () {
  $('#addServiceModal').modal('show');
});
listenHiddenBsModal('#addServiceModal', function () {
  resetModalForm('#addServiceForm');
  $('#servicePreview').attr('src', defaultServiceIconUrl);
  $(".cancel-service").hide();
});
listenHiddenBsModal('#showServiceModal', function () {
  $('#showName,#showDesc').empty();
  $('#servicePreview').attr('src', defaultServiceIconUrl);
});
listenHiddenBsModal('#editServiceModal', function () {
  $('.cancel-edit-service').hide();
});
listenChange('#serviceIcon', function () {
  changeImg(this, '#serviceIconValidationErrors', '#servicePreview', defaultServiceIconUrl);
  $(".cancel-service").show();
});
listenClick('.cancel-service', function () {
  $('#servicePreview').attr('src', defaultServiceIconUrl);
});
listenSubmit('#addServiceForm', function (e) {
  e.preventDefault();
  $('#serviceSave').prop('disabled', true);
  $.ajax({
    url: route('vcard.service.store'),
    type: 'POST',
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#addServiceModal').modal('hide');
        $(serviceTable).DataTable().ajax.reload(null, false);
        $('#serviceSave').prop('disabled', false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#serviceSave').prop('disabled', false);
    }
  });
});
listenClick('.edit-btn', function (event) {
  var vcardServiceId = $(event.currentTarget).data('id');
  editVcardServiceRenderData(vcardServiceId);
});
var serviceIconUrl = '';

function editVcardServiceRenderData(id) {
  $.ajax({
    url: route('vcard.service.edit', id),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#serviceId').val(result.data.id);
        $('#editName').val(result.data.name);
        $('#editDescription').val(result.data.description);
        $('#editServicePreview').attr('src', result.data.service_icon);
        $('#editServiceModal').modal('show');
        serviceIconUrl = result.data.service_icon;
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

listenChange('#editServiceIcon', function () {
  changeImg(this, '#editServiceIconValidation', '#editServicePreview', serviceIconUrl);
  $('.cancel-edit-service').show();
});
listenClick('.cancel-edit-service', function () {
  $('#editServicePreview').attr('src', serviceIconUrl);
});
listenSubmit('#editServiceForm', function (event) {
  event.preventDefault();
  var vcardServiceId = $('#serviceId').val();
  $.ajax({
    url: route('vcard.service.update', vcardServiceId),
    type: 'POST',
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editServiceModal').modal('hide');
        $(serviceTable).DataTable().ajax.reload(null, false);
        $('.cancel-edit-service').hide();
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenClick('.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('vcard.service.destroy', recordId), serviceTable, vcard_service);
});
listenClick('.view-btn', function (event) {
  var vcardServiceId = $(event.currentTarget).data('id');
  vcardServiceRenderDataShow(vcardServiceId);
});

function vcardServiceRenderDataShow(id) {
  $.ajax({
    url: route('vcard.service.edit', id),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        console.log(result.data.name);
        $('#showName').append(result.data.name);
        var element = document.createElement('textarea');
        element.innerHTML = result.data.description;
        $('#showDesc').append(element.value);
        $('#showServiceIcon').attr('src', result.data.service_icon);
        $('#showServiceModal').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}
/******/ })()
;