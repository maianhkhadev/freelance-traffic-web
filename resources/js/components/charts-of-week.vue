<template>
  <div>
    <button class="btn btn-white mb-3" data-toggle="modal" data-target=".modal-filter-projects">Filter by Projects</button>

    <div class="row">
      <div class="col-xl-6">
        <div class="form-group">
          <label class="form-control-label">Projects</label>
          <chart-pie-projects ref="chart-01" :project-ids="projectIds" :week-id="week.id"></chart-pie-projects>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="form-group">
          <label class="form-control-label">Teams</label>
          <chart-pie-teams ref="chart-02" :project-ids="projectIds" :week-id="week.id"></chart-pie-teams>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="form-control-label">Members</label>
      <chart-bar-members ref="chart-03" :project-ids="projectIds" :week-id="week.id"></chart-bar-members>
    </div>

    <modal-filter-projects :params="{ week_ids: [week.id] }" v-on:click-filter="fetchData"></modal-filter-projects>
  </div>
</template>

<script>
  import ModalFilterProjects from './modal-filter-projects'

  export default {
    data() {
      return {
        projectIds: []
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
      'modal-filter-projects': ModalFilterProjects
    },
    methods: {
      fetchData: function(projectIds) {
        let self = this

        self.projectIds.splice(0, self.projectIds.length)
        projectIds.forEach(function(projectId) {
          self.projectIds.push(parseInt(projectId))
        })

        self.$refs['chart-01'].fetchData()
        self.$refs['chart-02'].fetchData()
        self.$refs['chart-03'].fetchData()
      },
    },
  }
</script>
