const Validation = function(selector, rules) {
  let self = this

  let form = document.querySelector(selector)

  if(form === null) {
    return
  }

  function initValidation() {
    let groups = form.querySelectorAll('.form-group')
    groups.forEach(function(group) {
      let span = document.createElement('span')
      span.classList.add('error-message')
      group.insertAdjacentElement('beforeend', span)
    })
  }

  function checkRules() {
    let isClear = true

    let errorElements = form.querySelectorAll('.error')
    errorElements.forEach(function(errorElement) {
      errorElement.classList.remove('error')
    })

    rules.forEach(function(rule) {

      if(rule.require !== undefined) {

        let names = rule.require.names
        names.forEach(function(name) {

          let element = form.querySelector(`[name="${name}"]`)
          if(element === null || element.value === '') {
            isClear = false

            let group = element.closest('.form-group')

            if(group.classList.contains('error') === false) {

              group.classList.add('error')
              let error = group.querySelector('.error-message')
              error.innerHTML = '* This field is required.'
            }
          }
        })
      }
    })

    return isClear
  }

  function showErrors() {
    let errorElements = form.querySelectorAll('.error')
    errorElements.forEach(function(errorElement) {
      console.log(errorElement)
    })
  }

  form.addEventListener('submit', function(event) {
    event.preventDefault()

    if(checkRules()) {
      form.submit()
    }
    else {

      showErrors()
    }
  })

  initValidation()
}

export default Validation
