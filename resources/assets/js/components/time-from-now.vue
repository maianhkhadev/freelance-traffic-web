<template>
  <span class="date">{{ timeFromNow }}</span>
</template>

<script>
  var moment = require('moment');

  export default {
    data() {
      return {
        timeFromNow: 'cds'
      }
    },
    props: {
      date: {
        type: String,
        default: function () {
          return ''
        }
      }
    },
    mounted() {
      let self = this

      self.timeFromNow = moment(self.date).fromNow()
    }
  }
</script>
