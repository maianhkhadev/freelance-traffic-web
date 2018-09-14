// GOLBAL FUNCTION
window.findTasks = function() {

  let page = document.querySelector('.page-task-create')

  if(page === null) {
    return
  }

  let weekId = document.querySelector('select[name=week_id]').value
  let memberId = document.querySelector('select[name=member_id').value

  axios.get('/api/findTasks', {
    params: {
      week_id: weekId,
      member_id: memberId
    }
  }).then(response => {

    let value = 0
    response.data.forEach(function(task) {
      value += task.value
    })

    root.tasks_create.value = value
    root.tasks_create.tasks = response.data
  })
}

// ACTIVE NAVIBAR
window.activeNaviItem = function(name) {

  let naviItem = document.querySelector(`.navi-bar .navi .navi-item-${name}`)

  if(naviItem === null) {
    return
  }

  naviItem.classList.add('active')
}

window.addEventForNoteLink = function() {

  let noteLinks = document.querySelectorAll('.block-table .block-content .block-record .note-link')
  noteLinks.forEach(function(noteLink) {
    noteLink.addEventListener('click', function(event) {
      event.preventDefault()

      let note = noteLink.dataset.note
      $('.modal-note').modal('show')
    })
  })
}
