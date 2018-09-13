
export default {

  loaded: function() {
    
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
  }
}
