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
        projects: [],
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
  					},
            tooltips: {
              callbacks: {
                label: function(tooltipItem, data) {
                  let label = data.labels[tooltipItem.datasetIndex]
                  let dataValue = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]

                  let total = data.datasets[0].data.reduce(function(total, value) {
                    return total + value;
                  })

                  return `${label}: ${Math.floor(dataValue / total * 100)}%`;
                }
              }
            }
    			}
    		}
      }
    },
    props: {
      projectIds: {
        default: function () {
          return []
        }
      },
      weekId: {
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

        tasks.forEach(function(task) {
          let project = self.projects.find(function(project) {
            return project.id === task.project_id
          })

          if(project === undefined) {
            project = {
              id: task.project_id,
              name: task.project_name,
              color: task.project_color,
              value: 0
            }

            self.projects.push(project)
          }

          project.value += task.value
        })

        let labels = []
        let dataset = {
          data: [],
          backgroundColor: []
        }

        self.projects.forEach(function(project) {
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

      fetchData: function() {
        let self = this

        let params = {
          'week_ids': [self.weekId]
        }

        if(self.projectIds.length !== 0) {
          params['project_ids'] = self.projectIds
        }

        axios.get('/api/tasks', {
          params: params
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

      self.fetchData()

      self.$refs['chart'].addClickEvent(function(label, value) {
        self.projects.forEach(function(project) {
          if(project.name === label) {
            window.open(`/projects/${project.id}`, '_blank')
          }
        })
      })
    }
  }
</script>
