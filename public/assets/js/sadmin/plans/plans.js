/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************************!*\
  !*** ./resources/assets/js/sadmin/plans/plans.js ***!
  \***************************************************/
document.addEventListener('DOMContentLoaded', loadPlanTable);
var planTable = '#planTable';

function loadPlanTable() {
  if (!$('#planTable').length) {
    return;
  }

  var planTbl = $(planTable).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    ajax: {
      url: route('plans.index')
    },
    order: [1, 'desc'],
    columnDefs: [{
      'targets': [0],
      'width': '25%'
    }, {
      'targets': [3],
      'width': '18%'
    }, {
      'targets': [4],
      'orderable': false,
      'className': 'text-center text-nowrap',
      'width': '10%'
    }],
    columns: [{
      data: 'name',
      name: 'name'
    }, {
      data: function data(row) {
        return row.currency.currency_icon + ' ' + row.price;
      },
      name: 'price'
    }, {
      data: function data(row) {
        if (row.frequency == 1) {
          return "<a class=\"badge badge-light-info fs-7 m-1\">\n                                    ".concat(Monthly, "</a>");
        } else if (row.frequency == 2) {
          return "<a class=\"badge badge-light-primary fs-7 m-1\">\n                                    ".concat(Yearly, "</a>");
        } else {
          return "<a class=\"badge badge-light-info fs-7 m-1\">\n                                  ".concat(Monthly, "</a>");
        }
      },
      name: 'frequency'
    }, {
      data: function data(row) {
        if (row.is_default == 1) {
          return "<span class=\"badge badge-light-success\">".concat(Default, "</span>");
        } else {
          return "<div class=\"form-check form-switch\">\n                                <input class=\"form-check-input is_default\" type=\"checkbox\" name=\"is_default\"\n                                data-id=\"".concat(row.id, "\">\n                            </div>");
        }
      },
      name: 'is_default'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'editUrl': route('plans.edit', row.id),
          'isDefault': row.is_default
        }];
        return prepareTemplateRender('#actionsTemplates', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(planTbl);
}

listenClick('#planStatus', function () {
  var planId = $(this).data('id');
  var updateUrl = route('plan.status', planId);
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
  deleteItem(route('plans.destroy', recordId), planTable, 'Plan');
});
listenChange('.is_default', function (event) {
  var subscriptionPlanId = $(event.currentTarget).data('id');
  $.ajax({
    url: route('make.plan.default', subscriptionPlanId),
    method: 'post',
    cache: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $(planTable).DataTable().ajax.reload(null, false);
      }
    }
  });
});
/******/ })()
;