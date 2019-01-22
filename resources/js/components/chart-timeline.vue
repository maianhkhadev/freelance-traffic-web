<template>
  <div class="chart-container">
    <chart ref="chart" class="chart" :options="options"></chart>
  </div>
</template>

<script>
  import Chart from './chart'

  export default {
    data() {
      return {
        weeks: [],
        options: {
  				type: 'line',
  				data: {
      			labels: [],
      			datasets: []
      		},
          options: {
            title: {
  						display: false
  					},
            tooltips: {
  						mode: 'index',
  						intersect: false
  					},
            hover: {
    					mode: 'nearest',
    					intersect: true
    				},
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
  			}
      }
    },
    props: {
      project: {
        default: function () {
          return null
        }
      }
    },
    components: {
      'chart': Chart
    },
    methods: {
      tranformTaskToDataset: function(tasks) {
        let self = this

        let labels = []
        let dataset = {
          label: self.project.name,
          backgroundColor: self.project.color,
					borderColor: self.project.color,
          data: []
        }

        tasks.forEach(function(task) {
          let week = self.weeks.find(function(week) {
            return week.id === task.week_id
          })

          if(week === undefined) {
            labels.push(task.week_name)

            self.weeks.push({
              id: task.week_id,
              name: task.week_name,
              value: 0
            })
          }
        })

        tasks.forEach(function(task) {
          let week = self.weeks.find(function(week) {
            return week.id === task.week_id
          })
          week.value += task.value
        })

        self.weeks.forEach(function(week) {
          dataset.data.push(week.value)
        })

        return { labels, datasets: [dataset] }
      },

      runChart: function(tasks) {
        let self = this

        let options = self.options
        options.data = self.tranformTaskToDataset(tasks)
        self.$refs['chart'].update(options)
      },

      fetchData: function() {
        let self = this

        axios.get('/api/tasks', {
          params: {
            'project_ids': [self.project.id]
          }
        })
        .then(function (res) {
          self.runChart(res.data)
        })
        .catch(function (error) {
          console.log(error)
        })
      },
    },
    mounted() {
      let self = this

      self.fetchData()

      self.$refs['chart'].addClickEvent(function(label, value) {
        self.weeks.forEach(function(week) {
          if(week.name === label) {
            window.open(`/weeks/${week.id}`, '_blank')
          }
        })
      })
    }
  }
</script>
