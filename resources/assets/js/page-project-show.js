
export default {

  renderChart: function(chartId, members) {
    let labels = []
    let values = []
    members.forEach(function (member) {
      labels.push(member.name)
      values.push(member.value)
    })

    var context = document.getElementById(chartId).getContext('2d')
    let chart = new Chart(context, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          data: values,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)'
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
            display: false
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
  },

  loaded: function() {
    let self = this
    let layout = document.querySelector('.page-project-show')

    if(layout === null) {
      return
    }

    activeNaviItem('project')
    addEventForNoteLink()

    self.renderChart('chart', window.weeks)

    $('select').selectize({
      onChange: function(value) {

        let weekId = document.querySelector('.select-week').value
        let memberId = document.querySelector('.select-member').value

        let blocks = document.querySelectorAll('.block-record')

        if(memberId === 'none' || weekId === 'none') {
          blocks.forEach(function(block) {
            block.classList.remove('hidden')
          })
        }

        blocks.forEach(function(block) {
          if(memberId !== 'none' && block.classList.contains(`member-${memberId}`)) {
            block.classList.remove('hidden')
          }
          else if(weekId !== 'none' && block.classList.contains(`week-${weekId}`)) {
            block.classList.remove('hidden')
          } else {
            block.classList.add('hidden')
          }
        })
      }
    })
  }
}
