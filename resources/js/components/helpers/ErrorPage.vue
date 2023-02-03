<template>
  <div>Error</div>
</template>

<script>
export default {
  name: 'ErrorPage',

  mounted() {
    this.$alert('Unable to load page. Please try refreshing the page or contact us to resolve this issue.')
  },
}
</script>

<style scoped>

</style>
