
export default {

  loaded: function() {
    let layout = document.querySelector('.layout-sidebar')

    if(layout === null) {
      return
    }

    let menuItems = document.querySelectorAll('.menu-item.has-sub')
    menuItems.forEach(function(menuItem) {

      menuItem.addEventListener('click', function() {
        menuItem.classList.toggle('active')
      })
    })
  }
}
