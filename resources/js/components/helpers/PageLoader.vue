<template>
    <spinner/>
</template>

<script>
  import Modal from './Modal.vue'
  import ModalCard from './ModalCard.vue'
  import Spinner from './Spinner.vue'
  export default {
    name: 'PageLoader',
    components: {Spinner, ModalCard, Modal},
  }
</script>

<style scoped>

</style>
