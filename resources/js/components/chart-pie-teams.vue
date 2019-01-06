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
        options: {
    			type: 'pie',
    			data: {
            labels: [],
    				datasets: [],
    			},
    			options: {
    				responsive: true,
            legend: {
  						position: 'left'
  					}
    			}
    		}
      }
    },
    props: {
      week: {
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

        let teams = []

        tasks.forEach(function(task) {
          let team = teams.find(function(team) {
            return team.id === task.team_id
          })

          if(team === undefined) {
            team = {
              id: task.team_id,
              name: task.team_name,
              value: 0
            }

            teams.push(team)
          }

          team.value += task.value
        })

        let labels = []
        let dataset = {
          data: [],
          backgroundColor: [
            'rgba(255, 99, 132, 0.75)',
          	'rgba(255, 159, 64, 0.75)',
          	'rgba(255, 205, 86, 0.75)',
          	'rgba(75, 192, 192, 0.75)',
          	'rgba(54, 162, 235, 0.75)',
          	'rgba(153, 102, 255, 0.75)',
          	'rgba(201, 203, 207, 0.75)'
          ]
        }

        teams.forEach(function(team) {
          labels.push(team.name)
          dataset.data.push(team.value)
        })

        return { labels, datasets: [dataset] }
      },

      runChart: function(tasks) {
        let self = this

        let options = self.options
        options.data = self.tranformTaskToDataset(tasks)
        self.$refs['chart'].update(options)
      },

      requestData: function() {
        let self = this

        axios.get('/api/tasks', {
          params: {
            'week_ids': [self.week.id]
          }
        })
        .then(function (res) {
          self.runChart(res.data)
        })
        .catch(function (error) {
          console.log(error)
        })
      }
    },
    mounted() {
      let self = this

      self.requestData()
    }
  }
</script>
