
export default {

  loaded: function() {
    let layout = document.querySelector('.page-member-list')

    if(layout === null) {
      return
    }

    activeNaviItem('member')

    $('select').selectize({
      onChange: function(value) {

        let projectId = document.querySelector('.select-project').value
        let weekId = document.querySelector('.select-week').value

        let blocks = document.querySelectorAll('.block-record')

        if(projectId === 'none' || weekId === 'none') {
          blocks.forEach(function(block) {
            block.classList.remove('hidden')
          })
        }

        blocks.forEach(function(block) {
          if(projectId !== 'none' && block.classList.contains(`project-${projectId}`)) {
            block.classList.remove('hidden')
          }
          else if(weekId !== 'none' && block.classList.contains(`week-${weekId}`)) {
            block.classList.remove('hidden')
          } else {
            block.classList.add('hidden')
          }
        })
      }
    })
  }
}
