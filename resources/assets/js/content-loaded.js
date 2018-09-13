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

// PAGE PROJECT LIST
document.addEventListener('DOMContentLoaded', function() {

  let page = document.querySelector('.page-project-list')

  if(page === null) {
    return
  }

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

// PAGE WEEK LIST
document.addEventListener('DOMContentLoaded', function() {

  let page = document.querySelector('.page-week-list')

  if(page === null) {
    return
  }

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

  let input = document.querySelector('.block-search input')
  input.addEventListener('change', function(event) {

    axios.get('/api/members-search', {
      params: {
        name: event.target.value
      }
    }).then(response => {

      console.log(response)
    })
  })
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


// // FORM FILE
// document.addEventListener('DOMContentLoaded', function() {
//
//   let formFile = document.querySelector('.form-file')
//
//   if(formFile === null) {
//     return
//   }
//
//   let avatar = document.querySelector('.form-file figure')
//   avatar.addEventListener('click', function() {
//     let cdss = avatar.nextElementSibling
//     cdss.click()
//   })
//
//   let file = document.querySelector('.form-file input[type="file"]')
//   file.addEventListener('change', function() {
//
//     var reader = new FileReader()
//
//     reader.onload = function(e) {
//       $('.form-file figure').css('background-image', `url(${e.target.result})`)
//     }
//
//     reader.readAsDataURL(this.files[0])
//   })
// })
