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
      addClickEvent: function(callback) {
        let self = this

        self.$refs.chart.addEventListener('click', function(e) {
          let firstPoint = self.chart.getElementAtEvent(e)

          if (firstPoint) {
            var label = self.chart.data.labels[firstPoint[0]._index];
            var value = self.chart.data.datasets[firstPoint[0]._datasetIndex].data[firstPoint[0]._index];

            callback(label, value)
          }
        })
      },

      update: function(options) {
        let self = this

        self.chart.data = options.data
        self.chart.update()
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
