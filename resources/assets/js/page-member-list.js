
export default {

  loaded: function() {
    let layout = document.querySelector('.page-member-list')

    if(layout === null) {
      return
    }

    activeNaviItem('member')

    let input = document.querySelector('.block-search input')
    input.addEventListener('change', function(event) {

      axios.get('/api/members-search', {
        params: {
          name: event.target.value
        }
      }).then(res => {
        console.log(res)
        root.members = res.data
      })
    })
  }
}
