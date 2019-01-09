<template>
  <div ref="modal" class="modal modal-filter modal-filter-weeks fade" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Filter weeks</h5>
        </div>
        <div class="modal-body">
          <div class="custom-control custom-radio">
            <input type="radio" id="radio-week-select-all" name="select-week" class="custom-control-input" checked="checked" />
            <label class="custom-control-label" for="radio-week-select-all">Select All</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" id="radio-week-select-custom" name="select-week" class="custom-control-input" />
            <label class="custom-control-label" for="radio-week-select-custom">Custom Select</label>
          </div>

          <div class="row">
            <template v-for="week in weeks">
              <div class="col-xl-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" :id="`checkbox-week-${week.id}`" :data-week-id="week.id" :data-week-name="week.name" class="custom-control-input" />
                  <label class="custom-control-label" :for="`checkbox-week-${week.id}`">{{ week.name }}</label>
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
        weeks: []
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

        self.$emit('click-filter')

        $(self.$refs.modal).modal('hide')
      },

      getSelected: function() {
        let self = this

        let radioSelectAll = document.querySelector('#radio-week-select-all')
        if(radioSelectAll.checked) {
          return []
        }
        else {
          let weekIds = []
          let checkboxes = self.$refs.modal.querySelectorAll('input[type="checkbox"]:checked')
          checkboxes.forEach(function(checkbox) {
            weekIds.push(checkbox.dataset.weekId)
          })

          return weekIds
        }
      },

      getChartData: function() {
        let self = this

        let radioSelectAll = document.querySelector('#radio-week-select-all')
        if(radioSelectAll.checked) {

          return self.weeks.map(function(week) {
            return {
              id: week.id,
              name: week.name,
              value: 0
            }
          })
        }
        else {
          let weeks = []
          let checkboxes = self.$refs.modal.querySelectorAll('input[type="checkbox"]:checked')
          checkboxes.forEach(function(checkbox) {
            weeks.push({
              id: parseInt(checkbox.dataset.weekId),
              name: checkbox.dataset.weekName,
              value: 0
            })
          })

          return weeks
        }
      }
    },
    mounted() {
      let self = this

      document.querySelector("#radio-week-select-all").checked = true

      axios.get('/api/weeks', {
        params: self.params
      })
      .then(function (res) {
        self.weeks = res.data
      })
      .catch(function (error) {
        // handle error
        console.log(error);
      })
    }
  }
</script>
