/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************************************!*\
  !*** ./resources/assets/js/vcards/products/products.js ***!
  \*********************************************************/
document.addEventListener('DOMContentLoaded', loadProductsTable);
var productsTable = '#productsTable';

function loadProductsTable() {
  if (!$('#productsTable').length) {
    return;
  }

  var serviceTbl = $(productsTable).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    ajax: {
      url: route('vcard.products.index', vcardId)
    },
    order: [1, 'asc'],
    columnDefs: [{
      'targets': [0],
      'orderable': false,
      'width': '20%'
    }, {
      'targets': [2]
    }, {
      'targets': [3],
      'className': 'text-center text-nowrap',
      'orderable': false,
      'width': '12%'
    }],
    columns: [{
      data: function data(row) {
        return "<div class=\"symbol-label cursor-default\">\n                                        <img src=\"".concat(row.product_icon, "\" alt=\"\"\n                                             class=\"custom-circle\" width=\"80\" height=\"80\">\n                                    </div>");
      },
      name: 'id'
    }, {
      data: 'name',
      name: 'name'
    }, {
      data: function data(row) {
        if (row.currency_id && row.price != null) {
          return row.currency.currency_icon + ' ' + row.price;
        } else if (row.price != null) {
          return row.price;
        } else {
          return "N/A";
        }
      },
      name: 'price'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'editUrl': 'javascript:void(0)'
        }];
        return prepareTemplateRender('#productActionTemplate', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(serviceTbl);
}

listenClick('#addProductBtn', function () {
  $('#addProductModal').modal('show');
});
listenHiddenBsModal('#addProductModal', function (e) {
  $('#addProductForm')[0].reset();
  $('#vcardProduct').val(null).trigger('change');
  $('#productPreview').attr('src', defaultServiceIconUrl);
  $(".cancel-service").hide();
});
listenHiddenBsModal('#showProductModal', function () {
  $('#showName,#showDesc,#showPrice').empty();
  $('#productPreview').attr('src', defaultServiceIconUrl);
});
listenChange('#productIcon', function () {
  changeImg(this, '#productIconValidationErrors', '#productPreview', defaultServiceIconUrl);
  $(".cancel-service").show();
});
listenClick('.cancel-service', function () {
  $('#productPreview').attr('src', defaultServiceIconUrl);
});
listenSubmit('#addProductForm', function (e) {
  e.preventDefault();
  $('#productSave').prop('disabled', true);
  $.ajax({
    url: route('vcard.products.store'),
    type: 'POST',
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#addProductModal').modal('hide');
        $(productsTable).DataTable().ajax.reload(null, false);
        $('#productSave').prop('disabled', false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#productSave').prop('disabled', false);
    }
  });
});
listenHiddenBsModal('#editProductModal', function (e) {
  $(".cancel-edit-service").hide();
});
listenClick('.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('vcard.products.destroy', recordId), productsTable, products);
});
listenClick('.edit-btn', function (event) {
  var vcardProductId = $(event.currentTarget).data('id');
  editVcardProductRenderData(vcardProductId);
});
var productIconUrl = '';

function editVcardProductRenderData(id) {
  $.ajax({
    url: route('vcard.products.edit', id),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#productId').val(result.data.id);
        $('#editName').val(result.data.name);

        if (result.data.currency_id != null) {
          $('#editCurrencyId').val(result.data.currency.id).trigger('change');
        }

        $('#editPrice').val(result.data.price);
        $('#editDescription').val(result.data.description);
        $('#editProductPreview').attr('src', result.data.product_icon);
        $('#editProductModal').modal('show');
        productIconUrl = result.data.product_icon;
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

listenChange('#editProductIcon', function () {
  changeImg(this, '#editProductIconValidation', '#editProductPreview', productIconUrl);
  $(".cancel-edit-service").show();
});
listenClick('.cancel-edit-service', function () {
  $('#editProductPreview').attr('src', productIconUrl);
});
listenSubmit('#editProductForm', function (event) {
  event.preventDefault();
  var vcardProductId = $('#productId').val();
  $.ajax({
    url: route('vcard.products.update', vcardProductId),
    type: 'POST',
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editProductModal').modal('hide');
        $(productsTable).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenClick('.view-btn', function (event) {
  var vcardProductId = $(event.currentTarget).data('id');
  vcardProductRenderDataShow(vcardProductId);
});

function vcardProductRenderDataShow(id) {
  $.ajax({
    url: route('vcard.products.edit', id),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#showName').append(result.data.name);

        if (result.data.currency_id && result.data.price != null) {
          $('#showPrice').append(result.data.currency.currency_icon + " " + result.data.price);
        } else if (result.data.price != null) {
          $('#showPrice').append(result.data.price);
        } else {
          $('#showPrice').append("N/A");
        }

        var element = document.createElement('textarea');
        element.innerHTML = result.data.description;
        $('#showDesc').append(element.value);
        $('#showServiceIcon').attr('src', result.data.product_icon);
        $('#showProductModal').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}
/******/ })()
;