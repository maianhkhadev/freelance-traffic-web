<template>
  <div class="block-record">
    <span class="block-cell">
      <span class="avatar-name">HL</span>
      {{ data.name }}
    </span>
    <span class="block-cell">{{ data.email }}</span>
    <span class="block-cell">
      <span class="badge badge-success" v-if="data.disabled === 0">actived</span>
      <span class="badge badge-secondary" v-else>disabled</span>
    </span>
    <span class="block-cell">
      <a class="" v-bind:href="`/members/${data.id}`">Show</a>
      <a class="" v-bind:href="`/members/${data.id}/edit`">Edit</a>
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
