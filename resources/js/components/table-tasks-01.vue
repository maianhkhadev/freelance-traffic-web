<template>
  <div ref="float" class="float" v-if="tasks.length > 0">
    <button class="btn btn-secondary" v-on:click="toggleFloat">{{ tasks.length }} Tasks</button>
    <div class="float-content">
      <div class="table table-tasks-01">
        <div class="table-header">
          <span class="table-column-title">
            #
          </span>
          <span class="table-column-title">
            Project
          </span>
          <span class="table-column-title">
            Member
          </span>
          <span class="table-column-title">
            Time Estimate
          </span>
        </div>
        <div class="table-content">
          <template v-for="(task, index) in tasks">
            <div class="table-row">
              <span class="table-cell">{{ index + 1 }}</span>
              <span class="table-cell">{{ task.project_name }}</span>
              <span class="table-cell">{{ task.member_name }}</span>
              <span class="table-cell">{{ task.value }}</span>
            </div>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        tasks: []
      }
    },
    methods: {
      toggleFloat: function() {
        let self = this

        self.$refs.float.classList.toggle('show')
      },

      fetch: function() {
        let self = this

        let week_id = document.querySelector('select[name="week_id"]').value
        let name = document.querySelector('select[name="name"]').value

        axios.get('/api/tasks', {
          params: {
            'week_ids': [week_id],
            'name': name
          }
        })
        .then(function (res) {
          self.tasks = res.data
        })
        .catch(function (error) {
          console.log(error)
        })
      }
    },
    mounted() {
      let self = this

      self.fetch()
    }
  }
</script>

<style lang="scss" scoped>
  .float {
    display: grid;
    grid-template-columns: 6rem 44rem;
    position: fixed;
    top: 50%;
    right: 0;
    width: 50rem;
    max-height: 100vh;
    transform: translate(calc(100% - 6rem), -50%);
    transition: all 0.25s ease-in;
    z-index: 100;

    &.show {
      transform: translate(0, -50%);
    }

    button {
      height: 2.5rem;
      border-radius: unset;
    }

    .float-content {
      background-color: #ffffff;
      border: 1px solid rgba(0, 0, 0, 0.05);
      padding: 0 1.25rem 1.25rem;
    }
  }
</style>
