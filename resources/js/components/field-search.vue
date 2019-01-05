<template>
  <div class="field-search">
    <img class="icon" src="/images/icon-search.png" alt="" />
    <input type="text" ref="field" class="form-control" :value="value" placeholder="Type to search..."/>
  </div>
</template>

<script>
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

      self.$refs.field.addEventListener('keydown', function(e) {
        if(e.keyCode === 13) {
          location.assign(`${location.origin}${location.pathname}?search=${self.$refs.field.value}`);
        }
      })
    }
  }
</script>
