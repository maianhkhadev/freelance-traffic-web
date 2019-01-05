<template>
  <div ref="modal" class="modal modal-filter modal-filter-members fade" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Filter members</h5>
        </div>
        <div class="modal-body">
          <div class="custom-control custom-radio">
            <input type="radio" id="radio-member-select-all" name="select-member" class="custom-control-input" checked="checked" />
            <label class="custom-control-label" for="radio-member-select-all">Select All</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" id="radio-member-select-custom" name="select-member" class="custom-control-input" />
            <label class="custom-control-label" for="radio-member-select-custom">Custom Select</label>
          </div>

          <div class="row">
            <template v-for="member in members">
              <div class="col-xl-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" :id="`checkbox-member-${member.id}`" :data-member-id="member.id" class="custom-control-input" />
                  <label class="custom-control-label" :for="`checkbox-member-${member.id}`">{{ member.name }}</label>
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
        members: []
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

        let radioSelectAll = document.querySelector('#radio-member-select-all')
        if(radioSelectAll.checked) {
          return []
        }
        else {
          let memberIds = []
          let checkboxes = self.$refs.modal.querySelectorAll('.input[type="checkbox"]:checked')
          checkboxes.forEach(function(checkbox) {
            memberIds.push(checkbox.dataset.memberId)
          })

          return memberIds
        }
      },

      getChartData: function() {
        let self = this

        return self.members.map(function(member) {
          return {
            id: member.id,
            name: member.name,
            value: 0
          }
        })
      }
    },
    mounted() {
      let self = this

      document.querySelector("#radio-member-select-all").checked = true

      axios.get('/api/members').then(function (res) {
        self.members = res.data
      }).catch(function (error) {
        // handle error
        console.log(error);
      })
    }
  }
</script>
