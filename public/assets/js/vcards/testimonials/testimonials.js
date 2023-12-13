/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************************************!*\
  !*** ./resources/assets/js/vcards/testimonials/testimonials.js ***!
  \*****************************************************************/
document.addEventListener('DOMContentLoaded', loadTestimonialTable);
var testimonialTable = '#testimonialTable';

function loadTestimonialTable() {
  if (!$('#testimonialTable').length) {
    return;
  }

  var testimonialTbl = $(testimonialTable).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    ajax: {
      url: route('testimonial.index', vcardId)
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
        return "<div class=\"symbol-label cursor-default\">\n                                        <img src=\"".concat(row.image_url, "\" alt=\"\"\n                                             class=\"custom-circle\" width=\"80\" height=\"80\">\n                                    </div>");
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
listenSubmit('#addTestimonialForm', function (e) {
  e.preventDefault();
  $('#testimonialSave').prop('disabled', true);
  $.ajax({
    url: route('testimonial.store'),
    type: 'POST',
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#addTestimonialModal').modal('hide');
        $(testimonialTable).DataTable().ajax.reload(null, false);
        $('#testimonialSave').prop('disabled', false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#testimonialSave').prop('disabled', false);
    }
  });
});
listenClick('.edit-btn', function (event) {
  var testimonialId = $(event.currentTarget).data('id');
  edittestimonialRenderData(testimonialId);
});
var testimonialImgUrl = '';

function edittestimonialRenderData(id) {
  $.ajax({
    url: route('testimonial.edit', id),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#testimonialId').val(result.data.id);
        $('#editName').val(result.data.name);
        $('#editDescription').val(result.data.description);
        $('#editTestimonialPreview').attr('src', result.data.image_url);
        $('#editTestimonialModal').modal('show');
        testimonialImgUrl = result.data.image_url;
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

listenChange('#editTestimonialImg', function () {
  changeImg(this, '#editTestimonialImgValidation', '#editTestimonialPreview', testimonialImgUrl);
  $(".cancel-edit-testimonial").show();
});
listenClick('.cancel-edit-testimonial', function () {
  $('#editTestimonialPreview').attr('src', testimonialImgUrl);
});
listenHiddenBsModal('#showTestimonialModal', function () {
  $('#showName,#showDesc').empty();
  $('#servicePreview').attr('src', defaultProfileUrl);
});
listenSubmit('#editTestimonialForm', function (event) {
  event.preventDefault();
  var testimonialId = $('#testimonialId').val();
  $.ajax({
    url: route('testimonial.update', testimonialId),
    type: 'POST',
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editTestimonialModal').modal('hide');
        $(testimonialTable).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listenClick('.delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('testimonial.destroy', recordId), testimonialTable, vcard_testimonial);
});
listenClick('.view-btn', function (event) {
  var vcardTestimonailId = $(event.currentTarget).data('id');
  vcardTestimonailRenderDataShow(vcardTestimonailId);
});

function vcardTestimonailRenderDataShow(id) {
  $.ajax({
    url: route('testimonial.edit', id),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#showName').append(result.data.name);
        var element = document.createElement('textarea');
        element.innerHTML = result.data.description;
        $('#showDesc').append(element.value);
        $('#showTestimonialIcon').attr('src', result.data.image_url);
        $('#showTestimonialModal').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

;
/******/ })()
;