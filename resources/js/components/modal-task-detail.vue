<template>
  <div ref="modal" class="modal modal-detail fade" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail</h5>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-xl-6">
              <div class="form-group">
                <label class="form-control-label">Project</label>
                <input type="email" class="form-control-plaintext" :value="task.project_name">
              </div>
              <div class="form-group">
                <label class="form-control-label">Week</label>
                <input type="email" class="form-control-plaintext" :value="task.week_name">
              </div>
              <div class="form-group">
                <label class="form-control-label">Member</label>
                <input type="email" class="form-control-plaintext" :value="task.member_name">
              </div>
            </div>
            <div class="col-xl-6">
              <div class="form-group">
                <label class="form-control-label">Name</label>
                <input type="email" class="form-control-plaintext" :value="task.name">
              </div>
              <div class="form-group">
                <label class="form-control-label">Value</label>
                <input type="email" class="form-control-plaintext" :value="task.value">
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group">
                <label class="form-control-label">Comment</label>
                <input type="email" class="form-control-plaintext" :value="task.comment">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        task: {

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

      setTask: function(task) {
        let self = this

        self.task = task
      }
    },
    mounted() {
      let self = this


    }
  }
</script>
