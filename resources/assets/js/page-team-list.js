
export default {

  loaded: function() {
    let layout = document.querySelector('.page-team-list')

    if(layout === null) {
      return
    }

    activeNaviItem('team')
  }
}
