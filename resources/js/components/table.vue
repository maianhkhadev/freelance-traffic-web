<template>
  <div class="table">
    <div class="table-header">
      <slot name="table-header"></slot>
    </div>
    <div class="table-content">
      <slot name="table-content"></slot>
    </div>
    <div class="table-footer">
      <slot name="table-footer"></slot>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      index: {
        type: Number,
        default: function () {
          return 0
        }
      },
      options: {
        type: Object,
        default: function () {
          return {}
        }
      }
    }
    mounted() {
      console.log('Component mounted.')
    }
  }
</script>
