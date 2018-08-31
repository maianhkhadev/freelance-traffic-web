webpackJsonp([4],{

/***/ 226:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(227);


/***/ }),

/***/ 227:
/***/ (function(module, exports) {

$(document).ready(function () {
  document.querySelector('select[name=week_id]').addEventListener('change', function (event) {
    window.location.href = '/members/' + memberId + '/week/' + event.target.value;
  });
});

/***/ })

},[226]);