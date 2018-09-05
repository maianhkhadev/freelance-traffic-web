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
      })

      return chart
    },

    fetchData: function(chart, items) {
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
  }
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

  let memberChartData = window.week.show.calculateTasksForMember()
  window.chart.members =  window.week.show.renderChart('chart-members', memberChartData.labels, memberChartData.datasets)

  let projectChartData = window.week.show.calculateTasksForProject()
  window.chart.projects =  window.week.show.renderChart('chart-projects', projectChartData.labels, projectChartData.datasets)
  // checkSelected(members, '.member #select-member')

  // let projects = _.take(window.projects, limit)
  // window.chart.projects = renderChart('chart-projects', projects)
  // checkSelected(projects, '.project #select-project')
})
