document.addEventListener('DOMContentLoaded', function() {

  // document.querySelector('select[name=week_id]').addEventListener('change', function (event) {
  //
  //   axios.get(`/tasks-filter?week_id=${event.target.value}&member_id=${memberId}`).then(response => {
  //
  //     console.log(response.data)
  //   })
  // })

  // renderChart('chart', window.tasks)
  console.log(window.tasks)
})

function renderChart (chartId, members) {
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
