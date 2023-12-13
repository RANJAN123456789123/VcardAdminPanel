/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************************!*\
  !*** ./resources/assets/js/subscription/subscription.js ***!
  \**********************************************************/
document.addEventListener('DOMContentLoaded', loadSubscriptionTable);
document.addEventListener('DOMContentLoaded', loadPaymentTable);
document.addEventListener('DOMContentLoaded', loadSubscriptionUserPlanTable);
var subscriptionTable = '#subscriptionTable';

function loadSubscriptionTable() {
  if (!$('#subscriptionTable').length) {
    return;
  }

  var subscriptionTbl = $(subscriptionTable).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    'order': [4, 'desc'],
    ajax: {
      url: route('subscription.index')
    },
    columnDefs: [{
      'targets': [0],
      'width': '24%'
    }, {
      'targets': [4],
      'width': '10%'
    }],
    columns: [{
      data: 'plan.name',
      name: 'plan.name'
    }, {
      data: function data(row) {
        return row.plan.currency.currency_icon + ' ' + row.plan.price;
      },
      name: 'plan.price'
    }, {
      data: function data(row) {
        return moment(row.starts_at).format('Do MMM, Y');
      },
      name: 'starts_at'
    }, {
      data: function data(row) {
        return moment(row.ends_at).format('Do MMM, Y');
      },
      name: 'ends_at'
    }, {
      data: function data(row) {
        if (row.status) {
          if (isExpire == false) {
            return "<span class=\"badge badge-light-success\">\n                                    ".concat(Active, "\n                                </span>");
          } else {
            return "<span class=\"badge badge-light-danger\">\n                                    ".concat(Close, "\n                                </span>");
          }
        }

        return "<span class=\"badge badge-light-danger\">\n                              ".concat(Close, "\n                            </span>");
      },
      name: 'status'
    }]
  });
  handleSearchDatatable(subscriptionTbl);
}

var paymentTable = '#paymentTable';

function loadPaymentTable() {
  if (!$('#paymentTable').length) {
    return;
  }

  var paymentTbl = $(paymentTable).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    ajax: {
      url: route('subscription.cash')
    },
    order: [3, 'desc'],
    columnDefs: [{
      'targets': [4],
      'width': '10%'
    }, {
      'targets': [5],
      'className': 'text-center',
      'orderable': false,
      'width': '15%'
    }],
    columns: [{
      data: function data(row) {
        return row.tenant.user.full_name;
      },
      name: 'tenant.user.full_name'
    }, {
      data: function data(row) {
        return row.plan.name;
      },
      name: 'plan.name'
    }, {
      data: function data(row) {
        return row.plan.currency.currency_icon + ' ' + row.plan_amount;
      },
      name: 'plan_amount'
    }, {
      data: function data(row) {
        return moment(row.starts_at).format('Do MMM, Y');
      },
      name: 'starts_at'
    }, {
      data: function data(row) {
        return moment(row.ends_at).format('Do MMM, Y');
      },
      name: 'ends_at'
    }, {
      data: function data(row) {
        if (row.payment_type == 'Cash') {
          return "<div class=\"form-check form-switch ms-sm-15\">\n                                <input class=\"form-check-input\" type=\"checkbox\" id=\"planStatus\"  name=\"is_active\"\n                                ".concat(row.status == 1 ? 'disabled checked' : '', " data-id=\"").concat(row.id, "\" data-tenant=\"").concat(row.tenant_id, "\">\n                            </div>");
        } else {
          return "<span class=\"badge badge-light-success\">\n                                    Received\n                                </span>";
        }
      },
      name: 'status'
    }]
  });
  handleSearchDatatable(paymentTbl);
}

listenClick('#planStatus', function () {
  $(this).attr('disabled', true);
  var planId = $(this).data('id');
  var tenantId = $(this).data('tenant');
  var updateStatus = route('subscription.status', planId);
  $.ajax({
    type: 'get',
    url: updateStatus,
    data: {
      'id': planId,
      'tenant_id': tenantId
    },
    success: function success(response) {
      displaySuccessMessage(response.message);
      $('#paymentTable').DataTable().ajax.reload();
    }
  });
});
var SubscriptionUserPlanTable = '#SubscriptionUserPlanTable';

function loadSubscriptionUserPlanTable() {
  if (!$('#SubscriptionUserPlanTable').length) {
    return;
  }

  var SubscriptionUserPlanTbl = $(SubscriptionUserPlanTable).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    order: [2, 'desc'],
    ajax: {
      url: route('subscription.user.plan')
    },
    columnDefs: [{
      'targets': [5],
      'orderable': false
    }],
    columns: [{
      data: function data(row) {
        return row.tenant.user.full_name;
      },
      name: 'tenant.user.full_name'
    }, {
      data: 'plan.name',
      name: 'plan.name'
    }, {
      data: function data(row) {
        return moment(row.starts_at).format('Do MMM, Y');
      },
      name: 'starts_at'
    }, {
      data: function data(row) {
        return moment(row.ends_at).format('Do MMM, Y');
      },
      name: 'ends_at'
    }, {
      data: function data(row) {
        return "<div class=\"form-check form-switch\">\n                                <input class=\"form-check-input\" type=\"checkbox\" id=\"planStatus\"  name=\"is_active\"\n                                ".concat(row.status == 1 ? 'disabled checked' : '', " data-id=\"").concat(row.id, "\" data-tenant=\"").concat(row.tenant_id, "\">\n                            </div>");
      },
      name: 'status'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'editUrl': 'javascript:void(0)'
        }];
        return prepareTemplateRender('#subscriptionPlanTemplate', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(SubscriptionUserPlanTbl);
}

listenClick('.edit-btn', function (event) {
  var SubscriptionId = $(event.currentTarget).data('id');
  $('#editSubscriptionModal').modal('show');
  editSubscriptionRenderData(SubscriptionId);
});

function editSubscriptionRenderData(id) {
  var SubscriptionUrl = route('subscription.user.plan.edit', id);
  $.ajax({
    url: SubscriptionUrl,
    type: 'GET',
    data: {
      'id': id
    },
    success: function success(result) {
      if (result.success) {
        $('#SubscriptionId').val(result.data.id);
        $('#EndDate').val(result.data.ends_at);
      }

      $('#EndDate').flatpickr({
        minDate: result.data.ends_at,
        disableMobile: true,
        dateFormat: 'Y-m-d'
      });
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

listenSubmit('#editForm', function (event) {
  event.preventDefault();
  var subscriptionId = $('#SubscriptionId').val();
  var subscriptionUrl = route('subscription.user.plan.update', subscriptionId);
  $.ajax({
    url: subscriptionUrl,
    type: 'get',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editSubscriptionModal').modal('hide');
        $(SubscriptionUserPlanTable).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenHiddenBsModal('#editSubscriptionModal', function (e) {
  $('#editForm')[0].reset();
});
/******/ })()
;