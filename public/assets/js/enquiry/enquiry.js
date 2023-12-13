/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/assets/js/enquiry/enquiry.js ***!
  \************************************************/
document.addEventListener('DOMContentLoaded', loadEnquiryTable);
document.addEventListener('DOMContentLoaded', loadEnquiriesTable);
var enquiryTable = '#enquiryTable';

function loadEnquiryTable() {
  var EnquiryTbl = $(enquiryTable).DataTable({
    processing: true,
    serverSide: true,
    'order': [[3, 'desc']],
    ajax: {
      data: function data(row) {
        url: route('vcards.index', row.vcard_id);
      }
    },
    columnDefs: [{
      'targets': [4],
      'visible': true,
      'orderable': false
    }, {
      'targets': [3]
    }],
    columns: [{
      data: 'name',
      name: 'name'
    }, {
      data: function data(row) {
        return "<a\n                                href=\"mailto:".concat(row.email, "\"\n                                class=\"event-name text-center pt-3 mb-0\">").concat(row.email, "</a>");
      },
      name: 'email'
    }, {
      data: function data(row) {
        if (row.phone) {
          return row.phone;
        } else {
          return "N/A";
        }
      },
      name: 'phone'
    }, {
      data: function data(row) {
        return format(row.created_at, 'Do MMM, YYYY');
      },
      name: 'created_at'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id
        }];
        return prepareTemplateRender('#EnquiryActionTemplate', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(EnquiryTbl);
}

listenClick('.view-btn', function (event) {
  var frontEnquiryTestimonialsId = $(event.currentTarget).data('id');
  renderDataShow(frontEnquiryTestimonialsId);
});

function renderDataShow(id) {
  $.ajax({
    url: route('enquiry.show', id),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#showName').text(result.data.name);
        $('#showEmail').text(result.data.email);

        if (result.data.phone != null) {
          $('#showPhone').text(result.data.phone);
        } else {
          $('#showPhone').text("N/A");
        }

        $('#showMessage').text(result.data.message);
        $('#showEnquiryModal').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

function loadEnquiriesTable() {
  var enquiriesTable = $('#enquiriesTable').DataTable({
    processing: true,
    serverSide: true,
    'order': [[4, 'desc']],
    ajax: {
      url: route('enquiries.index')
    },
    columnDefs: [{
      'targets': [5],
      'orderable': false
    }],
    columns: [{
      data: 'vcard.name',
      name: 'vcard.name'
    }, {
      data: 'name',
      name: 'name'
    }, {
      data: function data(row) {
        return "<a\n                                href=\"mailto:".concat(row.email, "\"\n                                class=\"event-name text-center pt-3 mb-0\">").concat(row.email, "</a>");
      },
      name: 'email'
    }, {
      data: function data(row) {
        if (row.phone) {
          return row.phone;
        } else {
          return "N/A";
        }
      },
      name: 'phone'
    }, {
      data: function data(row) {
        return format(row.created_at, 'Do MMM, YYYY');
      },
      name: 'created_at'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id
        }];
        return prepareTemplateRender('#EnquiryActionTemplate', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(enquiriesTable);
}

listenClick('.view-btn', function (event) {
  var viewId = $(event.currentTarget).data('id');
  $.ajax({
    url: route('enquiry.show', viewId),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#vcardName').text(result.data.vcard.name);
        $('#showName').text(result.data.name);
        $('#showEmail').text(result.data.email);

        if (result.data.phone != null) {
          $('#showPhone').text(result.data.phone);
        } else {
          $('#showPhone').text("N/A");
        }

        $('#showMessage').text(result.data.message);
        $('#showEnquiriesModal').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
/******/ })()
;