<template>
  <div class="block-record">
    <span class="block-cell">{{ data.name }}</span>
    <span class="block-cell">{{ data.date_range }}</span>
    <span class="block-cell">
      <span class="badge badge-success" v-if="data.closed === 0">opened</span>
      <span class="badge badge-secondary" v-else>closed</span>
    </span>
    <span class="block-cell flex-center">
      <time-from-now :date="data.updated_at"></time-from-now>
    </span>
    <span class="block-cell">
      <a class="" v-bind:href="`/weeks/${data.id}`">Show</a>
      <a class="" v-bind:href="`/weeks/${data.id}/edit`">Edit</a>
    </span>
  </div>
</template>

<script>
  export default {
    props: {
      data: {
        type: Object,
        default: function () {
          return {}
        }
      }
    }
  }
</script>
