/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************************!*\
  !*** ./resources/assets/js/sadmin/currencies/currencies.js ***!
  \*************************************************************/
document.addEventListener('DOMContentLoaded', loadCurrencyTable);
var currencyTable = '#currencyTable';

function loadCurrencyTable() {
  if (!$('#currencyTable').length) {
    return;
  }

  var currencyTbl = $(currencyTable).DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'lengthMenu': 'Show _MENU_'
    },
    ajax: {
      url: route('currencies.index')
    },
    columnDefs: [{
      'targets': [1, 2],
      'className': 'text-center'
    }],
    columns: [{
      data: 'currency_name',
      name: 'currency_name'
    }, {
      data: 'currency_icon',
      name: 'currency_icon'
    }, {
      data: 'currency_code',
      name: 'currency_code'
    }]
  });
  handleSearchDatatable(currencyTbl);
}
/******/ })()
;