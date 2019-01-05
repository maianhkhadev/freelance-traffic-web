<template>
  <input type="text" ref="field" name="name" class="form-control" placeholder="Ex: Meeting" autocomplete="off" />
</template>

<script>

  if (process.browser) {
    require('selectize')
    require('selectize/dist/css/selectize.css')
    require('selectize/dist/css/selectize.default.css')
  }

  export default {
    mounted() {
      let self = this

      $(self.$refs.field).selectize({
        maxItems: 1,
        persist: false,
        valueField: 'email',
        labelField: 'name',
        searchField: ['name', 'email'],
        options: [
            {email: 'brian@thirdroute.com', name: 'Brian Reavis'},
            {email: 'nikola@tesla.com', name: 'Nikola Tesla'},
            {email: 'someone@gmail.com'}
        ],
        create: function(input) {
          return {
            email: input,
            name: input
          }
        }
      })
    }
  }
</script>
