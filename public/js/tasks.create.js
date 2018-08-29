webpackJsonp([2],{

/***/ 53:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(54);


/***/ }),

/***/ 54:
/***/ (function(module, exports) {

$(document).ready(function () {
  document.querySelector('select[name=week_id]').addEventListener('change', function () {
    tasks();
  });
  document.querySelector('select[name=member_id]').addEventListener('change', function () {
    tasks();
  });

  tasks();
});

function tasks() {
  var weekId = document.querySelector('select[name=week_id]').value;
  var memberId = document.querySelector('select[name=member_id').value;

  axios.get('/api/week/' + weekId + '/member/' + memberId + '/tasks').then(function (response) {

    var value = 0;
    response.data.forEach(function (task) {
      value += task.value;
    });

    root.tasks_create.value = value;
    root.tasks_create.tasks = response.data;
  });
}

/***/ })

},[53]);