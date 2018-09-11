window.week = {

  show: {

    findCheckedItems: function(items, checkBoxes) {
      let checkedItems = []
      checkBoxes.forEach(function (checkBox) {
        items.forEach(function (item) {
          if (item.id == checkBox.value) {
            checkedItems.push(item)
          }
        })
      })
      return checkedItems
    },

    calculateTasksForMember: function() {
      let checkBoxes = document.querySelectorAll('.member input[type=checkbox]:checked')
      let members = window.week.show.findCheckedItems(window.members, checkBoxes)

      let labels = []
      members.forEach(function(member) {
        labels.push(member.name)
      })

      let datasets = []
      projects.forEach(function(project) {

        let data = []
        members.forEach(function(member) {

          let value = 0
          tasks.forEach(function(task) {
            if(task.memberId === member.id && task.projectId === project.id) {
              value += task.value
            }
          })

          data.push(value)
        })

        datasets.push({
          label: project.name,
          backgroundColor: project.color,
          data: data
        })
      })
      console.log({
        labels,
        datasets
      })
      return {
        labels,
        datasets
      }
    },

    calculateTasksForProject: function() {
      let checkBoxes = document.querySelectorAll('.project input[type=checkbox]:checked')
      let projects = window.week.show.findCheckedItems(window.projects, checkBoxes)

      let labels = []
      projects.forEach(function(project) {
        labels.push(project.name)
      })

      let datasets = []
      members.forEach(function(member) {

        let data = []
        projects.forEach(function(project) {

          let value = 0
          tasks.forEach(function(task) {
            if(task.memberId === member.id && task.projectId === project.id) {
              value += task.value
            }
          })

          data.push(value)
        })

        datasets.push({
          label: member.name,
          backgroundColor: member.color,
          data: data
        })
      })

      return {
        labels,
        datasets
      }
    },

    renderChart: function(chartId, labels, datasets) {

      let context = document.getElementById(chartId).getContext('2d')
      let chart = new Chart(context, {
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
						intersect: false,
            callbacks: {
              label: function(tooltipItem, data) {
                  if(tooltipItem.yLabel === 0) {
                    return
                  }

                  let label = data.datasets[tooltipItem.datasetIndex].label || '';

                  if (label) {
                      label += ': ';
                  }

                  label += Math.round(tooltipItem.yLabel * 100) / 100;
                  return label;
              }
            }
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
      })

      return chart
    },

    fetchData: function(chart, labels, datasets) {
      chart.data.labels = labels
      chart.data.datasets = datasets

      chart.update()
    }
  }
}

document.addEventListener('DOMContentLoaded', function() {

  let page = document.querySelector('.page-week-show')

  if(page === null) {
    return
  }

  $('.team input[type=checkbox]').on('change', function(event) {

    let teamId = event.target.value
    let checkboxes = document.querySelectorAll(`[data-team-id="${teamId}"]`)

    if(event.target.checked === true) {

      checkboxes.forEach(function(checkbox) {
        checkbox.checked = true
      })
    }
    else {

      checkboxes.forEach(function(checkbox) {
        checkbox.checked = false
      })
    }

    let { labels, datasets } = window.week.show.calculateTasksForMember()
    window.week.show.fetchData(window.chart.members, labels, datasets)
  })

  $('.member input[type=checkbox]').on('change', function(event) {

    let teamId = event.target.dataset.teamId

    if(event.target.checked === true) {
      let allCheckboxChecked = true

      let checkboxes = document.querySelectorAll(`[data-team-id="${teamId}"]`)
      checkboxes.forEach(function(checkbox) {
        if(checkbox.checked === false) {
          allCheckboxChecked = false
        }
      })

      if(allCheckboxChecked === true) {
        let checkbox = document.querySelector(`#select-team-${teamId}`)
        checkbox.checked = true
      }
    }
    else {
      let checkbox = document.querySelector(`#select-team-${teamId}`)
      checkbox.checked = false
    }

    let { labels, datasets } = window.week.show.calculateTasksForMember()
    window.week.show.fetchData(window.chart.members, labels, datasets)
  })

  $('.project input[type=checkbox]').on('change', function(event) {

    let { labels, datasets } = window.week.show.calculateTasksForProject()
    window.week.show.fetchData(window.chart.projects, labels, datasets)
  })

  window.chart = {}

  let memberChartData = window.week.show.calculateTasksForMember()
  window.chart.members =  window.week.show.renderChart('chart-members', memberChartData.labels, memberChartData.datasets)

  let projectChartData = window.week.show.calculateTasksForProject()
  window.chart.projects =  window.week.show.renderChart('chart-projects', projectChartData.labels, projectChartData.datasets)
})
