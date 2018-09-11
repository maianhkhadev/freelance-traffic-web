
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Validation = require('./plugins/validation').default

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

const root = new Vue({
  el: '#root',
  data () {
    return {
      name: 'maianhkha',
      tasks_create: {
        value: 0,
        tasks: []
      }
    }
  }
})

window.root = root

require('./weeks-show');

// GOLBAL FUNCTION
function findTasks() {

  let page = document.querySelector('.page-task-create')

  if(page === null) {
    return
  }

  let weekId = document.querySelector('select[name=week_id]').value
  let memberId = document.querySelector('select[name=member_id').value

  axios.get('/api/findTasks', {
    params: {
      week_id: weekId,
      member_id: memberId
    }
  }).then(response => {

    let value = 0
    response.data.forEach(function(task) {
      value += task.value
    })

    root.tasks_create.value = value
    root.tasks_create.tasks = response.data
  })
}

// LAYOUT SIDEBAR
document.addEventListener('DOMContentLoaded', function() {

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
})

// LAYOUT DEFAULT
document.addEventListener('DOMContentLoaded', function() {

  let layout = document.querySelector('.layout-default')

  if(layout === null) {
    return
  }
})

// PAGE HOME
document.addEventListener('DOMContentLoaded', function() {

  let page = document.querySelector('.page-home')

  if(page === null) {
    return
  }

  let slides = document.querySelectorAll('.slide')
  slides.forEach(function(slide) {
    slide.style.zIndex = '10'
  })

  let firstSlide = document.querySelector('.slide:last-child')
  firstSlide.classList.add('active')

  setInterval(function() {
    let slide = document.querySelector('.slide.active')
    slide.style.zIndex = '30'

    let nextSlide = slide.nextElementSibling === null ? document.querySelector('.slide:first-child') : slide.nextElementSibling
    nextSlide.classList.add('active')
    nextSlide.style.zIndex = '20'

    slide.classList.remove('active')
    slide.classList.add('hide')

    setTimeout(function() {
      nextSlide.style.zIndex = '40'
      slide.style.zIndex = '10'
    }, 1000)

    setTimeout(function() {
      slide.classList.remove('hide')
    }, 2000)

  }, 5000)
})

document.addEventListener('DOMContentLoaded', function() {

  let page = document.querySelector('.page-member-create') || document.querySelector('.page-member-edit')

  if(page === null) {
    return
  }

  $('select').selectize()

  let rules = {
    require: {
      names: [
        'name',
        'email'
      ]
    },
    email: {
      names: [
        'email'
      ]
    }
  }

  window.Validation('.member-validation form', rules)
})

// PAGE PROJECT
document.addEventListener('DOMContentLoaded', function() {

  let page = document.querySelector('.page-project')

  if(page === null) {
    return
  }

  let naviItem = document.querySelector('.navi-bar .navi .navi-item-project')

  if(naviItem === null) {
    return
  }

  naviItem.classList.add('active')
})

// PAGE WEEK
document.addEventListener('DOMContentLoaded', function() {

  let page = document.querySelector('.page-week')

  if(page === null) {
    return
  }

  let naviItem = document.querySelector('.navi-bar .navi .navi-item-week')

  if(naviItem === null) {
    return
  }

  naviItem.classList.add('active')
})

// PAGE TEAM
document.addEventListener('DOMContentLoaded', function() {

  let page = document.querySelector('.page-team')

  if(page === null) {
    return
  }

  let naviItem = document.querySelector('.navi-bar .navi .navi-item-team')

  if(naviItem === null) {
    return
  }

  naviItem.classList.add('active')
})

// PAGE MEMBER
document.addEventListener('DOMContentLoaded', function() {

  let page = document.querySelector('.page-member')

  if(page === null) {
    return
  }

  let naviItem = document.querySelector('.navi-bar .navi .navi-item-member')

  if(naviItem === null) {
    return
  }

  naviItem.classList.add('active')
})


// PAGE MEMBER LIST
document.addEventListener('DOMContentLoaded', function() {

  let page = document.querySelector('.page-member-list')

  if(page === null) {
    return
  }

  let deleteButtons = document.querySelectorAll('.block-table .delete')
  deleteButtons.forEach(function(deleteButton) {
    let memberId = deleteButton.dataset.memberId
    deleteButton.addEventListener('click', function(event) {
      event.preventDefault()

      // let input = document.querySelector('.modal-member-delete input[name="id"]')
      // input.value = memberId

      $('.modal-member-delete').modal('show')
    })
  })

  // let confirmDelete = document.querySelector('.modal-member-delete .confirm-button')
  // confirmDelete.addEventListener('click', function() {
  //
  //   axios.get('/api/members/', {
  //     params: {
  //       week_id: weekId,
  //       member_id: memberId
  //     }
  //   }).then(response => {
  //
  //     let value = 0
  //     response.data.forEach(function(task) {
  //       value += task.value
  //     })
  //
  //     root.tasks_create.value = value
  //     root.tasks_create.tasks = response.data
  //   })
  // })
})

// PAGE MEMBER SHOW
document.addEventListener('DOMContentLoaded', function() {

  let page = document.querySelector('.page-member-show')

  if(page === null) {
    return
  }

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
})

// PAGE TASK CREATE
document.addEventListener('DOMContentLoaded', function() {

  let page = document.querySelector('.page-task-create')

  if(page === null) {
    return
  }

  $('select').selectize({
    onChange: function(value) {
      findTasks()
    }
  })

  document.querySelector('select[name=week_id]').addEventListener('change', function () {
    findTasks()
  })
  document.querySelector('select[name=member_id]').addEventListener('change', function () {
    findTasks()
  })

  findTasks()
})
