<template>
  <span class="avatar-name" :style="{ 'color': textColor, 'background-color': data.color }">
    {{ shortName }}
  </span>
</template>

<script>
  export default {
    data() {
      return {
        textColor: 'black',
        shortName: 'HL'
      }
    },
    props: {
      data: {
        type: Object,
        default: function () {
          return {}
        }
      }
    },
    mounted() {
      let self = this

      self.textColor = window.calcContrastYIQ(self.data.color)
      self.shortName = self.data.name.substr(0, 2)
    }
  }
</script>
