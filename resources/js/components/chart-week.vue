<template>
  <div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal-filter-members">
      Filter the data
    </button>

    <div class="chart-container">
      <chart ref="chart" :options="options"></chart>
    </div>

    <modal-filter-members ref="modal" v-on:click-filter="requestData"></modal-filter-members>
  </div>
</template>

<script>
  import Chart from './chart'
  import ModalFilterMembers from './modal-filter-members'

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
      week: {
        default: function () {
          return null
        }
      }
    },
    components: {
      'chart': Chart,
      'modal-filter-members': ModalFilterMembers
    },
    methods: {
      tranformTaskToDataset: function(tasks) {
        let self = this
        let labels = []
        let datasets = []

        let members = self.$refs.modal.getChartData()
        members.forEach(function(member) {
          labels.push(member.name)
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
              members: members,
              data: []
            }

            datasets.push(dataset)
          }

          let member = dataset.members.find(function(member) {
            return member.id === task.member_id
          })
          member.value += task.value
        })

        datasets.forEach(function(dataset) {
          dataset.members.forEach(function(member) {
            dataset.data.push(member.value)
          })

          delete dataset.members
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
            'member_ids': self.$refs.modal.getSelected(),
            'week_ids': [self.week.id]
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
