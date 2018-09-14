
export default {

  loaded: function() {
    let layout = document.querySelector('.page-member-list')

    if(layout === null) {
      return
    }

    activeNaviItem('task-create')

    $('select').selectize({
      onChange: function(value) {
        findTasks()
      }
    })
  }
}
