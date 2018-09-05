webpackJsonp([2],{

/***/ 230:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(231);


/***/ }),

/***/ 231:
/***/ (function(module, exports) {

window.week = {

  show: {

    findCheckedItems: function findCheckedItems(items, checkBoxes) {
      var checkedItems = [];
      checkBoxes.forEach(function (checkBox) {
        items.forEach(function (item) {
          if (item.id == checkBox.value) {
            checkedItems.push(item);
          }
        });
      });
      return checkedItems;
    },

    calculateTasksForMember: function calculateTasksForMember() {
      var checkBoxes = document.querySelectorAll('.member input[type=checkbox]:checked');
      var members = window.week.show.findCheckedItems(window.members, checkBoxes);

      var labels = [];
      members.forEach(function (member) {
        labels.push(member.name);
      });

      var datasets = [];
      projects.forEach(function (project) {

        var data = [];
        members.forEach(function (member) {

          var value = 0;
          tasks.forEach(function (task) {
            if (task.memberId === member.id && task.projectId === project.id) {
              value += task.value;
            }
          });

          data.push(value);
        });

        datasets.push({
          label: project.name,
          backgroundColor: project.color,
          data: data
        });
      });
      console.log({
        labels: labels,
        datasets: datasets
      });
      return {
        labels: labels,
        datasets: datasets
      };
    },

    calculateTasksForProject: function calculateTasksForProject() {
      var checkBoxes = document.querySelectorAll('.project input[type=checkbox]:checked');
      var projects = window.week.show.findCheckedItems(window.projects, checkBoxes);

      var labels = [];
      projects.forEach(function (project) {
        labels.push(project.name);
      });

      var datasets = [];
      members.forEach(function (member) {

        var data = [];
        projects.forEach(function (project) {

          var value = 0;
          tasks.forEach(function (task) {
            if (task.memberId === member.id && task.projectId === project.id) {
              value += task.value;
            }
          });

          data.push(value);
        });

        datasets.push({
          label: member.name,
          backgroundColor: member.color,
          data: data
        });
      });

      return {
        labels: labels,
        datasets: datasets
      };
    },

    renderChart: function renderChart(chartId, labels, datasets) {

      var context = document.getElementById(chartId).getContext('2d');
      var chart = new Chart(context, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: datasets
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          tooltips: {
            mode: 'index',
            intersect: false
          },
          scales: {
            xAxes: [{
              stacked: true,
              ticks: {
                display: false
              }
            }],
            yAxes: [{
              stacked: true,
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });

      return chart;
    },

    fetchData: function fetchData(chart, items) {
      chart.data.labels = [];
      chart.data.datasets.forEach(function (dataset) {
        dataset.data = [];
      });
      items.forEach(function (item) {
        chart.data.labels.push(item.name);
        chart.data.datasets.forEach(function (dataset) {
          dataset.data.push(item.value);
        });
      });
      chart.update();
    }
  }
};

document.addEventListener('DOMContentLoaded', function () {
  var limit = 30;

  $('.team input[type=checkbox]').on('change', function (event) {
    if (event.target.checked) {
      var teamId = event.target.dataset.teamId;
      var checkBoxes = document.querySelectorAll('.team-' + teamId + ' input[type=checkbox]');
      checkBoxes.forEach(function (checkBox) {
        checkBox.checked = true;
      });

      var sdcds = document.querySelectorAll('.member input[type=checkbox]:checked');
      var _members = findCheckedItems(window.members, sdcds);
      fetchData(window.chart.members, _members);
    }
  });

  $('.member input[type=checkbox]').on('change', function (event) {
    if ($('.member input[type=checkbox]:checked').length > limit) {
      $(this).prop('checked', false);
    } else {
      var checkBoxes = document.querySelectorAll('.member input[type=checkbox]:checked');
      var _members2 = findCheckedItems(window.members, checkBoxes);
      fetchData(window.chart.members, _members2);
    }
  });

  $('.project input[type=checkbox]').on('change', function (event) {
    if ($('.project input[type=checkbox]:checked').length > limit) {
      $(this).prop('checked', false);
    } else {
      var checkBoxes = document.querySelectorAll('.project input[type=checkbox]:checked');
      var _projects = findCheckedItems(window.projects, checkBoxes);
      fetchData(window.chart.projects, _projects);
    }
  });

  window.chart = {};

  var memberChartData = window.week.show.calculateTasksForMember();
  window.chart.members = window.week.show.renderChart('chart', memberChartData.labels, memberChartData.datasets);

  var projectChartData = window.week.show.calculateTasksForProject();
  window.chart.projects = window.week.show.renderChart('chart-projects', projectChartData.labels, projectChartData.datasets);
  // checkSelected(members, '.member #select-member')

  // let projects = _.take(window.projects, limit)
  // window.chart.projects = renderChart('chart-projects', projects)
  // checkSelected(projects, '.project #select-project')
});

/***/ })

},[230]);