/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************************************!*\
  !*** ./resources/assets/js/sadmin/testimonial/frontTestimonial.js ***!
  \********************************************************************/
document.addEventListener('DOMContentLoaded', loadTestimonialTable);
var frontTestimonial = '#frontTestimonialTable';

function loadTestimonialTable() {
  if (!$('#frontTestimonialTable').length) {
    return;
  }

  var testimonialTbl = $(frontTestimonial).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    ajax: {
      url: route('frontTestimonial.index')
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
        return "<div class=\"symbol-label cursor-default\">\n                                        <img src=\"".concat(row.testimonial_url, "\" alt=\"\"\n                                             class=\"custom-circle\" width=\"80\" height=\"80\">\n                                    </div>");
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
        return prepareTemplateRender('#TestimonialActionTemplate', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(testimonialTbl);
}

listenClick('#addTestimonialBtn', function () {
  $('#addTestimonialModal').modal('show');
});
listenHiddenBsModal('#addTestimonialModal', function () {
  resetModalForm('#addTestimonialForm');
  $('#testimonialPreview').attr('src', defaultProfileUrl);
  $(".cancel-testimonial").hide();
});
listenChange('#testimonialImg', function () {
  changeImg(this, '#testimonialImgValidation', '#testimonialPreview', defaultProfileUrl);
  $(".cancel-testimonial").show();
});
listenHiddenBsModal('#editTestimonialModal', function () {
  $(".cancel-edit-testimonial").hide();
});
listenClick('.cancel-testimonial', function () {
  $('#testimonialPreview').attr('src', defaultProfileUrl);
});
listenClick('.view-btn', function (event) {
  var frontTestimonailId = $(event.currentTarget).data('id');
  TestimonialRenderDataShow(frontTestimonailId);
});

function TestimonialRenderDataShow(id) {
  $.ajax({
    url: route('frontTestimonial.edit', id),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#showName').append(result.data.name);
        var element = document.createElement('textarea');
        element.innerHTML = result.data.description;
        $('#showDesc').append(element.value);
        $('#showTestimonialIcon').attr('src', result.data.testimonial_url);
        $('#showTestimonialModal').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

;
listenSubmit('#addTestimonialForm', function (e) {
  e.preventDefault();
  $.ajax({
    url: route('frontTestimonial.store'),
    type: 'POST',
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#addTestimonialModal').modal('hide');
        $(frontTestimonial).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenChange('#editTestimonialImg', function () {
  changeImg(this, '#editTestimonialImgValidation', '#editTestimonialPreview', testimonialImgUrl);
});
listenHiddenBsModal('#showTestimonialModal', function () {
  $('#showName,#showDesc').empty();
  $('#servicePreview').attr('src', defaultProfileUrl);
});
listenClick('.cancel-edit-testimonial', function () {
  $('#editTestimonialPreview').attr('src', testimonialImgUrl);
});
listenClick('.edit-btn', function (event) {
  var testimonialId = $(event.currentTarget).data('id');
  EditTestimonialRenderData(testimonialId);
});
var testimonialImgUrl = '';

function EditTestimonialRenderData(id) {
  $.ajax({
    url: route('frontTestimonial.edit', id),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#testimonialId').val(result.data.id);
        $('#editName').val(result.data.name);
        $('#editDescription').val(result.data.description);
        $('#editTestimonialPreview').attr('src', result.data.testimonial_url);
        $('#editTestimonialModal').modal('show');
        testimonialImgUrl = result.data.image_url;
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

;
listenSubmit('#editTestimonialForm', function (e) {
  e.preventDefault();
  var testimonialId = $('#testimonialId').val();
  $.ajax({
    url: route('frontTestimonial.updateData', testimonialId),
    method: 'post',
    processData: false,
    contentType: false,
    data: new FormData(this),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editTestimonialModal').modal('hide');
        $(frontTestimonial).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenClick('.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('frontTestimonial.destroy', recordId), frontTestimonial, vcard_testimonial);
});
/******/ })()
;