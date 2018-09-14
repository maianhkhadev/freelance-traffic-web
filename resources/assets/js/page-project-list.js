
export default {

  loaded: function() {
    let layout = document.querySelector('.page-project-list')

    if(layout === null) {
      return
    }

    activeNaviItem('project')

    let input = document.querySelector('.block-search input')
    input.addEventListener('change', function(event) {

      axios.get('/api/projects-search', {
        params: {
          name: event.target.value
        }
      }).then(res => {

        root.projects = res.data
      })
    })
  }
}
