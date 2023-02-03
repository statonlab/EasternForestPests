<template>
    <span :class="['spinner-grow', {'spinner-grow-sm': small}]" role="status" aria-hidden="true"></span>
</template>

<script>
  export default {
    name: 'InlineSpinner',
    props: {
      small: {required: false, type: Boolean, default: true}
    }
  }
</script>

<style scoped>
.btn .spinner-grow {
    margin-right: 10px;
}
</style>
