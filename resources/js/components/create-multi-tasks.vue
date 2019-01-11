<template>
  <div class="row">
    <div class="col-xl-12">
      <small class="text-muted">{{ tasks.length }} tasks created.</small>
    </div>
    <template v-for="(task, index) in tasks">
      <div class="col-xl-4">
        <div class="task">
          <div class="form-group">
            <label>Project</label>
            <select name="project_ids[]" class="form-control" tabindex="1">
              <template v-for="project in projects">
                <option :value="project.id">{{ project.name }}</option>
              </template>
            </select>
          </div>

          <div class="form-group">
            <label>Member</label>
            <select name="member_ids[]" class="form-control" tabindex="3">
              <template v-for="member in members">
                <option :value="member.id">{{ member.name }}</option>
              </template>
            </select>
          </div>

          <div class="form-group">
            <label>Name of Task</label>
            <field-task-name name="names[]" tabindex="4"></field-task-name>
          </div>

          <div class="form-group">
            <label>Value</label>
            <input type="number" name="values[]" class="form-control" placeholder="Ex: 50" autocomplete="off" tabindex="5" required>
          </div>

          <div class="form-group">
            <label>Comment</label>
            <textarea type="text" name="comments[]" class="form-control" rows="2" tabindex="6"></textarea>
          </div>

          <button class="btn btn-danger btn-sm" v-on:click.prevent="deleteOne(index)">Delete</button>
        </div>
      </div>
    </template>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        tasks: []
      }
    },
    props: {
      projects: {
        default: function () {
          return []
        }
      },
      members: {
        default: function () {
          return []
        }
      }
    },
    methods: {
      addOne: function() {
        let self = this

        self.tasks.push({
          id: self.tasks.length + 1
        })
      },

      deleteOne: function(index) {
        let self = this

        self.tasks.splice(index, 1)
      }
    }
  }
</script>
