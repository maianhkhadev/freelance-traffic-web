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

        let projects = []

        tasks.forEach(function(task) {
          let project = projects.find(function(project) {
            return project.id === task.project_id
          })
          if(project === undefined) {
            project = {
              id: task.project_id,
              name: task.project_name,
              color: task.project_color,
              value: 0
            }

            projects.push(project)
          }

          project.value += task.value
        })

        let labels = []
        let dataset = {
          data: [],
          backgroundColor: []
        }

        projects.forEach(function(project) {
          labels.push(project.name)
          dataset.data.push(project.value)
          dataset.backgroundColor.push(project.color)
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
