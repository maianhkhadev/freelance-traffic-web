
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

    self.renderChart('chart', window.weeks)
  }
}
