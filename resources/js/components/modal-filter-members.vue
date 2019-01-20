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
        </div>
        <div class="modal-body">
          <div class="custom-control custom-radio">
            <input type="radio" id="radio-member-select-team" name="select-member" class="custom-control-input" />
            <label class="custom-control-label" for="radio-member-select-team">Select by Team</label>
          </div>
          <div class="row teams">
            <template v-for="team in teams">
              <div class="col-xl-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" :id="`checkbox-team-${team.id}`" :data-team-id="team.id" :data-team-name="team.name" class="custom-control-input" />
                  <label class="custom-control-label" :for="`checkbox-team-${team.id}`">{{ team.name }}</label>
                </div>
              </div>
            </template>
          </div>
        </div>
        <div class="modal-body">
          <div class="custom-control custom-radio">
            <input type="radio" id="radio-member-select-custom" name="select-member" class="custom-control-input" />
            <label class="custom-control-label" for="radio-member-select-custom">Select by Member</label>
          </div>
          <div class="row members">
            <template v-for="member in members">
              <div class="col-xl-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" :id="`checkbox-member-${member.id}`" :data-member-id="member.id" :data-member-name="member.name" class="custom-control-input" />
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
        teams: [],
        members: []
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

        let radioSelectAll = document.querySelector('#radio-member-select-all')
        if(radioSelectAll.checked) {
          return []
        }

        let radioSelectTeam = document.querySelector('#radio-member-select-team')
        if(radioSelectTeam.checked) {
          let teamIds = []
          let memberIds = []

          let checkboxes = self.$refs.modal.querySelectorAll('.teams input[type="checkbox"]:checked')
          checkboxes.forEach(function(checkbox) {
            teamIds.push(checkbox.dataset.teamId)
          })

          self.members.forEach(function(member) {
            let team = teamIds.find(function(teamId) {
              return parseInt(teamId) === member.team_id
            })
            if(team !== undefined) {
              memberIds.push(member.id)
            }
          })

          return memberIds
        }

        let radioSelectCustom = document.querySelector('#radio-member-select-custom')
        if(radioSelectCustom.checked) {
          let memberIds = []

          let checkboxes = self.$refs.modal.querySelectorAll('.members input[type="checkbox"]:checked')
          checkboxes.forEach(function(checkbox) {
            memberIds.push(checkbox.dataset.memberId)
          })

          return memberIds
        }
      },

      getChartData: function() {
        let self = this

        let radioSelectAll = document.querySelector('#radio-member-select-all')
        if(radioSelectAll.checked) {
          return self.members.map(function(member) {
            return {
              id: member.id,
              name: member.name,
              value: 0
            }
          })
        }

        let radioSelectTeam = document.querySelector('#radio-member-select-team')
        if(radioSelectTeam.checked) {
          let teamIds = []

          let checkboxes = self.$refs.modal.querySelectorAll('.teams input[type="checkbox"]:checked')
          checkboxes.forEach(function(checkbox) {
            teamIds.push(parseInt(checkbox.dataset.teamId))
          })

          let members = self.members.filter(function(member) {
            let team = teamIds.find(function(teamId) {
              return parseInt(teamId) === member.team_id
            })
            return team === undefined ? false : true
          })

          return members.map(function(member) {
            return {
              id: member.id,
              name: member.name,
              value: 0
            }
          })
        }

        let radioSelectCustom = document.querySelector('#radio-member-select-custom')
        if(radioSelectCustom.checked) {
          let members = []
          let checkboxes = self.$refs.modal.querySelectorAll('.members input[type="checkbox"]:checked')
          checkboxes.forEach(function(checkbox) {
            members.push({
              id: parseInt(checkbox.dataset.memberId),
              name: checkbox.dataset.memberName,
              value: 0
            })
          })

          return members
        }
      }
    },
    mounted() {
      let self = this

      document.querySelector("#radio-member-select-all").checked = true

      axios.get('/api/teams', {
        params: self.params
      })
      .then(function (res) {
        self.teams = res.data
      })
      .catch(function (error) {
        // handle error
        console.log(error);
      })

      axios.get('/api/members', {
        params: self.params
      })
      .then(function (res) {
        self.members = res.data
      })
      .catch(function (error) {
        // handle error
        console.log(error);
      })
    }
  }
</script>
