<template>
    <div class="spinner-container d-flex justify-content-center align-items-center"
         :style="`background-color: ${background};${fixed ? 'position: fixed !important;' : ''}left: ${left};`">
        <div class="spinner-grow text-primary" role="status">
            <span class="sr-only">{{ $t('general.loading') }}...</span>
        </div>
        <p v-if="message !== ''" class="spinner-message">{{ message }}</p>
    </div>
</template>
<script>
  export default {
    props: {
      background: {default: 'rgba(0,0,0,0.5)', type: String},
      message   : {default: '', type: String},
      fixed     : {default: false, type: Boolean},
      left      : {default: '250px', required: false, type: String}
    }
  }
</script>

<style scoped lang="scss">
    .spinner-container {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 100vh;
    }
</style>
