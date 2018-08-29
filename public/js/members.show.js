webpackJsonp([3],{

/***/ 51:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(52);


/***/ }),

/***/ 52:
/***/ (function(module, exports) {

$(document).ready(function () {
  document.querySelector('select[name=week_id]').addEventListener('change', function (event) {
    window.location.href = '/members/' + memberId + '/week/' + event.target.value;
  });
});

/***/ })

},[51]);