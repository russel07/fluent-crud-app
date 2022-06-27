<template>
  <span>{{ message }}</span>
</template>

<script>
  export default {
    name: 'ErrorMessage',
    props: ['message']
  }
</script>