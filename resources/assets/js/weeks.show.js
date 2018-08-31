function checkSelected(items, prefix) {
  items.forEach(function (item) {
    document.querySelector(`${prefix}-${item.id}`).setAttribute('checked', true)
  })
}

function findCheckedItems(items, checkBoxes) {
  let checkedItems = []
  checkBoxes.forEach(function (checkBox) {
    items.forEach(function (item) {
      if (item.id == checkBox.value) {
        checkedItems.push(item)
      }
    })
  })
  return checkedItems
}

function renderChart(chartId, members) {
  let labels = []
  let values = []
  members.forEach(function (member) {
    labels.push(member.name)
    values.push(member.value)
  })

  var context = document.getElementById(chartId).getContext('2d')
  let chart = new Chart(context, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        data: values,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          ticks: {
            display: false
          }
        }],
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  })

  return chart
}

function fetchData(chart, items) {
  chart.data.labels = []
  chart.data.datasets.forEach((dataset) => {
      dataset.data = []
  })
  items.forEach((item) => {
    chart.data.labels.push(item.name)
    chart.data.datasets.forEach((dataset) => {
      dataset.data.push(item.value)
    })
  })
  chart.update()
}

document.addEventListener('DOMContentLoaded', function() {
  let limit = 30;

  $('.team input[type=checkbox]').on('change', function(event) {
    if(event.target.checked) {
      let teamId = event.target.dataset.teamId
      let checkBoxes = document.querySelectorAll(`.team-${teamId} input[type=checkbox]`)
      checkBoxes.forEach(function(checkBox) {
        checkBox.checked = true
      })

      let sdcds = document.querySelectorAll('.member input[type=checkbox]:checked')
      let members = findCheckedItems(window.members, sdcds)
      fetchData(window.chart.members, members)
    }
  })

  $('.member input[type=checkbox]').on('change', function(event) {
    if ($('.member input[type=checkbox]:checked').length > limit) {
      $(this).prop('checked', false)
    }
    else {
      let checkBoxes = document.querySelectorAll('.member input[type=checkbox]:checked')
      let members = findCheckedItems(window.members, checkBoxes)
      fetchData(window.chart.members, members)
    }
  })

  $('.project input[type=checkbox]').on('change', function(event) {
    if ($('.project input[type=checkbox]:checked').length > limit) {
      $(this).prop('checked', false)
    }
    else {
      let checkBoxes = document.querySelectorAll('.project input[type=checkbox]:checked')
      let projects = findCheckedItems(window.projects, checkBoxes)
      fetchData(window.chart.projects, projects)
    }
  })

  window.chart = {}

  let members = _.take(window.members, limit)
  window.chart.members = renderChart('chart', members)
  checkSelected(members, '.member #select-member')

  let projects = _.take(window.projects, limit)
  window.chart.projects = renderChart('chart-projects', projects)
  checkSelected(projects, '.project #select-project')
})
