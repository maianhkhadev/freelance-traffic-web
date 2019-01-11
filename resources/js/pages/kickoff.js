document.addEventListener('DOMContentLoaded', function() {

  let page = document.querySelector('.page-kickoff')

  if(page === null) {
    return
  }

  let element = page.querySelector('.btn-white')
  element.addEventListener('click', function(e) {
    e.preventDefault()
    
    vm.$refs.tasks.addOne()
  })
})
