
export default {

  loaded: function() {
    let layout = document.querySelector('.page-week-list')

    if(layout === null) {
      return
    }

    activeNaviItem('week')

    let input = document.querySelector('.block-search input')
    input.addEventListener('change', function(event) {

      axios.get('/api/weeks-search', {
        params: {
          name: event.target.value
        }
      }).then(response => {

        console.log(response)
      })
    })
  }
}
