<template>
  <canvas ref="chart"></canvas>
</template>

<script>
  import Chart from 'chart.js'

  export default {
    data() {
      return {
        chart: null
      }
    },
    props: {
      options: {
        type: Object,
        default: function () {
          return {}
        }
      }
    },
    methods: {
      update: function(options) {
        let self = this

        self.chart.destroy()
        self.run(options)
      },
      run: function(options) {
        let self = this

        let context = self.$refs.chart.getContext('2d')
        self.chart = new Chart(context, options)
      }
    },
    mounted() {
      let self = this

      self.run(self.options)
    }
  }
</script>
