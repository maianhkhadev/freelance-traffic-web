
export default {

  loaded: function() {
    let layout = document.querySelector('.page-week-list')

    if(layout === null) {
      return
    }

    activeNaviItem('week')

    root.isSearch = false

    let input = document.querySelector('.block-search input')
    input.addEventListener('change', function(event) {

      if(event.target.value === '') {
        root.isSearch = false
      }
      else {
        root.isSearch = true
        axios.get('/api/weeks-search', {
          params: {
            name: event.target.value
          }
        }).then(res => {
          console.log(res)
          root.weeks = res.data
        })
      }
    })
  }
}
