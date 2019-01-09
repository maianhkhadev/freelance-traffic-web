<template>
  <div class="chart-container">
    <button type="button" class="btn btn-white" data-toggle="modal" data-target=".modal-filter-weeks">
      Filter the data
    </button>

    <chart ref="chart" class="chart" :options="options"></chart>

    <modal-filter-weeks ref="modal" :params="{ member_ids: [member.id] }" v-on:click-filter="requestData"></modal-filter-weeks>
  </div>
</template>

<script>
  import Chart from './chart'
  import ModalFilterWeeks from './modal-filter-weeks'

  export default {
    data() {
      return {
        options: {
  				type: 'bar',
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
            scales: {
  						xAxes: [{
  							stacked: true,
  						}],
  						yAxes: [{
  							stacked: true
  						}]
  					}
          }
  			}
      }
    },
    props: {
      member: {
        default: function () {
          return null
        }
      }
    },
    components: {
      'chart': Chart,
      'modal-filter-weeks': ModalFilterWeeks
    },
    methods: {
      tranformTaskToDataset: function(tasks) {
        let self = this

        let labels = []
        let datasets = []

        let weeks = self.$refs.modal.getChartData()
        weeks.forEach(function(week) {
          labels.push(week.name)
        })

        tasks.forEach(function(task) {
          let dataset = datasets.find(function(dataset) {
            return dataset.id === task.project_id
          })

          if(dataset === undefined) {
            dataset = {
              id: task.project_id,
              label: task.project_name,
              backgroundColor: task.project_color,
              weeks: weeks,
              data: []
            }

            datasets.push(dataset)
          }

          let week = dataset.weeks.find(function(week) {
            return week.id === task.week_id
          })

          if(week !== undefined) {
            week.value += task.value
          }
        })

        datasets.forEach(function(dataset) {
          dataset.weeks.forEach(function(week) {
            dataset.data.push(week.value)
          })

          delete dataset.weeks
        })

        return { labels, datasets }
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
            'member_ids': [self.member.id],
            'week_ids': self.$refs.modal.getSelected(),
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

      self.requestData()
    }
  }
</script>
