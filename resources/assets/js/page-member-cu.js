
export default {

  loaded: function() {
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
  }
}
