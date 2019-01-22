document.addEventListener('DOMContentLoaded', function() {

  let page = document.querySelector('.page-tasks-create')

  if(page === null) {
    return
  }

  let selectWeekId = document.querySelector('select[name="week_id"]')
  selectWeekId.addEventListener('change', function(e) {
    vm.$refs['float'].fetch()
  })
})

window.test = function() {

}
