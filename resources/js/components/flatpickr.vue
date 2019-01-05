<template>
  <input type="text" ref="flatpickr" placeholder="Select Date..">
</template>

<script>
  import flatpickr from 'flatpickr'
  import weekSelectPlugin from 'flatpickr/dist/plugins/weekSelect/weekSelect.js'

  if (process.browser) {
    require('flatpickr/dist/flatpickr.min.css')
    require('flatpickr/dist/themes/airbnb.css')
  }

  export default {
    props: {
      options: {
        type: Object,
        default: function () {
          return {
            weekNumbers: true,
            plugins: [new weekSelectPlugin({})],
            onChange: function(selectedDates, dateStr, instance) {
                // extract the week number
                // note: "this" is bound to the flatpickr instance
                const weekNumber = this.selectedDates[0]
                    ? this.config.getWeek(this.selectedDates[0])
                    : null;

                console.log(weekNumber);
            }
          }
        }
      }
    },
    mounted() {
      let self = this

      flatpickr(self.$refs.flatpickr, self.options)
    }
  }
</script>
