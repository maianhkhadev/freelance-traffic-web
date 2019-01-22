<template>
  <select ref="select" :name="name" placeholder="Select..."></select>
</template>

<script>
  if (process.browser) {
    require('selectize/dist/js/selectize.js')
  }

  export default {
    props: {
      name: {
        default: 'work_id'
      },
      value: {
        default: null
      },
      onchange: {
        type: Function,
        default: undefined
      }
    },
    mounted() {
      let self = this

      let $select = $(self.$refs.select).selectize({
        valueField: 'name',
        optgroupValueField: 'name',
        labelField: 'name',
        optgroupLabelField: 'name',
				optgroupField: 'parent_name',
				searchField: 'name',
        onChange: function(value) {
          self.onchange !== undefined && self.onchange()
        }
      })

      let selectize = $select[0].selectize

      axios.get('/api/works')
      .then(res => {
        res.data.forEach(function(item, index) {
          if(item.parent_id === null) {
            selectize.addOptionGroup(item.name, item)
          }
          else {
            selectize.addOption(item)
          }
        })

        if(self.value !== null) {
          selectize.addItem(self.value)
        }
      })
      .catch(error => {

      })
    }
  }
</script>
