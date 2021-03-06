<template>
  <div class="chart-container">
    <button type="button" class="btn btn-white" data-toggle="modal" data-target=".modal-filter-members">
      Filter the data
    </button>

    <chart ref="chart" class="chart" :options="options"></chart>

    <modal-filter-members ref="modal" :params="{ week_ids: [weekId] }" v-on:click-filter="fetchData"></modal-filter-members>
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
                maxBarThickness: 50,
                ticks: {
                  display: false,
                }
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
              members: self.$refs.modal.getChartData(),
              data: []
            }

            datasets.push(dataset)
          }

          let member = dataset.members.find(function(member) {
            return member.id === task.member_id
          })

          if(member !== undefined) {
            member.value += task.value
          }
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

      fetchData: function() {
        let self = this

        let params = {
          'member_ids': self.$refs.modal.getSelected(),
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
      },
    },
    mounted() {
      let self = this

      self.fetchData()

      self.$refs['chart'].addClickEvent(function(label, value) {
        let members = self.$refs.modal.getMembers()
        members.forEach(function(member) {
          if(member.name === label) {
            window.open(`/members/${member.id}`, '_blank')
          }
        })
      })
    }
  }
</script>
