$(document).ready(function () {

  $('#week_id').selectize()

  document.querySelector('select[name=week_id]').addEventListener('change', function () {
    tasks()
  })
  document.querySelector('select[name=member_id]').addEventListener('change', function () {
    tasks()
  })

  tasks()
})

function tasks () {
  let weekId = document.querySelector('select[name=week_id]').value
  let memberId = document.querySelector('select[name=member_id').value

  axios.get(`/api/week/${weekId}/member/${memberId}/tasks`).then(response => {

    let value = 0
    response.data.forEach(function(task) {
      value += task.value
    })

    root.tasks_create.value = value
    root.tasks_create.tasks = response.data
  })
}
