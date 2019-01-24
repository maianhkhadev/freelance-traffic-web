<template>
  <div ref="modal" class="modal modal-filter modal-filter-projects fade" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Filter projects</h5>
        </div>
        <div class="modal-body">
          <div class="custom-control custom-radio">
            <input type="radio" id="radio-project-select-all" name="select-project" class="custom-control-input" checked="checked" />
            <label class="custom-control-label" for="radio-week-select-all">Select All</label>
          </div>
        </div>
        <div class="modal-body">
          <div class="custom-control custom-radio">
            <input type="radio" id="radio-project-select-custom" name="select-project" class="custom-control-input" />
            <label class="custom-control-label" for="radio-project-select-custom">Custom Select</label>
          </div>
          <div class="row">
            <template v-for="project in projects">
              <div class="col-xl-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" :id="`checkbox-project-${project.id}`" :data-project-id="project.id" :data-project-name="project.name" class="custom-control-input" />
                  <label class="custom-control-label" :for="`checkbox-project-${project.id}`">{{ project.name }}</label>
                </div>
              </div>
            </template>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-gold" v-on:click="filter()">Filter</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        projects: []
      }
    },
    props: {
      params: {
        default: function() {
          return {}
        }
      }
    },
    methods: {
      show: function() {
        let self = this

        $(self.$refs.modal).modal('show')
      },

      hide: function() {
        let self = this

        $(self.$refs.modal).modal('hide')
      },

      filter: function() {
        let self = this

        self.$emit('click-filter', self.getSelected())

        $(self.$refs.modal).modal('hide')
      },

      getSelected: function() {
        let self = this

        let radioSelectAll = document.querySelector('#radio-project-select-all')
        if(radioSelectAll.checked) {
          return []
        }
        else {
          let projectIds = []
          let checkboxes = self.$refs.modal.querySelectorAll('input[type="checkbox"]:checked')
          checkboxes.forEach(function(checkbox) {
            projectIds.push(checkbox.dataset.projectId)
          })

          return projectIds
        }
      },

      getChartData: function() {
        let self = this

        let radioSelectAll = document.querySelector('#radio-project-select-all')
        if(radioSelectAll.checked) {

          return self.projects.map(function(project) {
            return {
              id: project.id,
              name: project.name,
              value: 0
            }
          })
        }
        else {
          let projects = []
          let checkboxes = self.$refs.modal.querySelectorAll('input[type="checkbox"]:checked')
          checkboxes.forEach(function(checkbox) {
            projects.push({
              id: parseInt(checkbox.dataset.projectId),
              name: checkbox.dataset.projectName,
              value: 0
            })
          })

          return projects
        }
      }
    },
    mounted() {
      let self = this

      document.querySelector("#radio-project-select-all").checked = true

      axios.get('/api/tasks', {
        params: self.params
      })
      .then(function (res) {

        res.data.forEach(function(task) {
          let project = self.projects.find(function(project) {
            return project.id === task.project_id
          })

          if(project === undefined) {
            project = {
              id: task.project_id,
              name: task.project_name,
            }

            self.projects.push(project)
          }
        })
      })
      .catch(function (error) {
        // handle error
        console.log(error);
      })
    }
  }
</script>
