<template>
  <input type="text" ref="flatpickr" class="form-control" placeholder="Select Date..">
</template>

<script>
  import flatpickr from 'flatpickr'
  import weekSelectPlugin from 'flatpickr/dist/plugins/weekSelect/weekSelect.js'

  export default {
    props: {
      defaultDate: {
        default: function() {
          return ''
        }
      },
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

      let options = self.options
      options.defaultDate = self.defaultDate
      flatpickr(self.$refs.flatpickr, options)
    }
  }
</script>
