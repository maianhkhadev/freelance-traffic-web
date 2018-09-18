
export default {

  loaded: function() {
    let page = document.querySelector('.page-week-create') || document.querySelector('.page-week-edit')

    if(page === null) {
      return
    }

    flatpickr('.form-date-range input', {
      mode: "range",
      dateFormat: "d-m-Y",
      disable: [
        function(date) {
          // // disable every multiple of 8
          // return !(date.getDate() % 5);
        }
      ]
    })

    let rules = {
      require: {
        names: [
          'name',
          'date_range'
        ]
      }
    }

    window.Validation('form', rules)
  }
}
