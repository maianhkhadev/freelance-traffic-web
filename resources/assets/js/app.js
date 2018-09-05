
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

require('./members-show');
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


// PAGE TASK CREATE
document.addEventListener('DOMContentLoaded', function() {

  let page = document.querySelector('.page-task-create')

  if(page === null) {
    return
  }

  $('select').selectize({
    onChange: function(value) {
      console.log(1)
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
