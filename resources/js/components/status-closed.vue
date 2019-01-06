<template>
  <div v-if="status === 0">
    <span class="badge badge-success">opened</span>
  </div>
  <div v-else>
    <span class="badge badge-danger">closed</span>
  </div>
</template>

<script>
  export default {
    props: {
      status: {
        default: function () {
          return 0
        }
      }
    }
  }
</script>
