
export default {

  loaded: function() {
    let layout = document.querySelector('.page-task-create')

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
