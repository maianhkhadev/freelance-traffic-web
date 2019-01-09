<template>
  <div v-if="status === 0">
    <span class="badge badge-success">enabled</span>
  </div>
  <div v-else>
    <span class="badge badge-secondary">disabled</span>
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
