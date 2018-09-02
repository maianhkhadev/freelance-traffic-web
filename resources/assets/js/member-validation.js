document.addEventListener('DOMContentLoaded', function() {

  let memberValidation = document.querySelector('.member-validation')

  if(memberValidation === null) {
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
