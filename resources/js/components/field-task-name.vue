<template>
  <input type="text" ref="field" name="name" :value="value" placeholder="Ex: Meeting" autocomplete="off" />
</template>

<script>

  if (process.browser) {
    require('selectize')
    require('selectize/dist/css/selectize.css')
    require('selectize/dist/css/selectize.default.css')
  }

  export default {
    props: {
      value: {
        default: function () {
          return ''
        }
      }
    },
    mounted() {
      let self = this

      axios.get('/api/hints').then(function (res) {
        $(self.$refs.field).selectize({
          maxItems: 1,
          persist: false,
          createOnBlur: true,
          labelField: 'value',
          options: res.data,
          create: function(input) {
            return {
              value: input
            }
          }
        })
      }).catch(function (error) {
        // handle error
        console.log(error);
      })
    }
  }
</script>
