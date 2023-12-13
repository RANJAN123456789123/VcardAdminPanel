/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************************!*\
  !*** ./resources/assets/js/vcards/gallery/gallery.js ***!
  \*******************************************************/
document.addEventListener('DOMContentLoaded', loadGallery);
var galleryTable = '#galleryTable';

function loadGallery() {
  if (!$('#galleryTable').length) {
    return;
  }

  var galleryTbl = $(galleryTable).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    ajax: {
      url: route('gallery.index', vcard_Id)
    },
    order: [1, 'asc'],
    columnDefs: [{
      'targets': [0],
      'orderable': false,
      'width': '20%'
    }, {
      'targets': [1],
      'orderable': true,
      'width': '70%'
    }, {
      'targets': [2],
      'orderable': false,
      'className': 'text-center text-nowrap'
    }],
    columns: [{
      data: 'type_name',
      name: 'type_name'
    }, {
      data: function data(row) {
        if (row.link == null && row.type == 0) {
          return "<a href=\" ".concat(row.gallery_image, " \" target=\"_blank\">").concat(row.gallery_image, "</a>");
        } else {
          return "<a href=\" ".concat(row.link, " \" target=\"_blank\">").concat(row.link, "</a>");
        }
      },
      name: 'link'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id,
          'editUrl': 'javascript:void(0)'
        }];
        return prepareTemplateRender('#galleryActionTemplate', data);
      },
      name: 'id'
    }]
  });
  handleSearchDatatable(galleryTbl);
  listenClick('#addGalleryBtn', function () {
    $('#addGalleryModal').modal('show');
  });
  listenHiddenBsModal('#addGalleryModal', function (e) {
    $('#addGalleryForm')[0].reset();
    $('#typeId').val(null).trigger('change');
    $('#addGalleryPreview').attr('src', defaultGalleryUrl);
    $('.youtube_link').addClass('d-none');
    $('.image_link').removeClass('d-none');
    $('.cancel-gallery').hide();
  });
  listenClick('.cancel-gallery', function () {
    $('#addGalleryPreview').attr('src', defaultGalleryUrl);
  });
  listenChange('#typeId', function () {
    var type = $(this).val();

    if (type == 0) {
      $('.youtube_link').addClass('d-none');
      $('.image_link').removeClass('d-none');
      $('#linkRequired').attr('required', false);
    } else if (type == 1) {
      $('.image_link').addClass('d-none');
      $('.youtube_link').removeClass('d-none');
      $('#linkRequired').attr('required', true);
    }
  });
  listenChange('#editTypeId', function () {
    var type = $(this).val();

    if (type == 0) {
      $('.editYouTubeLink').addClass('d-none');
      $('.editImagelink').removeClass('d-none');
      $('#editYouTube_Link').attr('required', false);
    } else if (type == 1) {
      $('.editYouTubeLink').removeClass('d-none');
      $('.editImagelink').addClass('d-none');
      $('#editYouTube_Link').attr('required', true);
    }
  });
  listenSubmit('#addGalleryForm', function (e) {
    e.preventDefault();
    $('#GallerySave').prop('disabled', true);
    $.ajax({
      url: route('gallery.store'),
      type: 'POST',
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function success(result) {
        if (result.success) {
          displaySuccessMessage(result.message);
          $('#addGalleryModal').modal('hide');
          $('#addGalleryForm').trigger('reset');
          $('#GallerySave').prop('disabled', false);
          $(galleryTable).DataTable().ajax.reload(null, false);
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
        $('#GallerySave').prop('disabled', false);
      }
    });
  });
  listenClick('.edit-btn', function (event) {
    var GalleryId = $(event.currentTarget).data('id');
    editGalleryRenderData(GalleryId);
  });
  var galleryUrl = '';

  function editGalleryRenderData(id) {
    $.ajax({
      url: route('gallery.edit', id),
      type: 'GET',
      success: function success(result) {
        if (result.success) {
          $('#galleryId').val(result.data.id);
          $('#editTypeId').val(result.data.type).trigger('change');
          $('#editGalleryPreview').attr('src', result.data.gallery_image);
          $('#editYouTube_Link').val(result.data.link);
          $('#editGalleryModal').modal('show');
          galleryUrl = result.data.gallery_image;
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      }
    });
  }

  listenHiddenBsModal('#editGalleryModal', function () {
    $('.edit-cancel-gallery').hide();
  });
  listenChange('#editImage', function () {
    changeImg(this, '#editGalleryValidationErrors', '#editGalleryPreview', galleryUrl);
    $('.edit-cancel-gallery').show();
  });
  listenClick('.edit-cancel-gallery', function () {
    $('#editGalleryPreview').attr('src', galleryUrl);
  });
  listenChange('#addImage', function () {
    changeImg(this, '#addGalleryValidationErrors', '#addGalleryPreview', galleryUrl);
    $('.cancel-gallery').show();
  });
  listenSubmit('#editGalleryForm', function (event) {
    event.preventDefault();
    $('#editGallerySave').prop('disabled', true);
    var galleryId = $('#galleryId').val();
    $.ajax({
      url: route('gallery.update', galleryId),
      type: 'POST',
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function success(result) {
        if (result.success) {
          displaySuccessMessage(result.message);
          $('#editGalleryModal').modal('hide');
          $('#editGalleryForm').trigger('reset');
          $('#editGallerySave').prop('disabled', false);
          $(galleryTable).DataTable().ajax.reload(null, false);
          $('.edit-cancel-gallery').hide();
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      }
    });
  });
  listenClick('.delete-btn', function (event) {
    var recordId = $(event.currentTarget).data('id');
    deleteItem(route('gallery.destroy', recordId), galleryTable, gallery);
  });
}
/******/ })()
;