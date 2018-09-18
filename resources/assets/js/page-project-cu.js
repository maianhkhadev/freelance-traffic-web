
export default {

  loaded: function() {
    let page = document.querySelector('.page-project-create') || document.querySelector('.page-project-edit')

    if(page === null) {
      return
    }

    let rules = {
      require: {
        names: [
          'name',
        ]
      }
    }

    window.Validation('form', rules)
  }
}
