<template>
    <button type="button" class="btn btn-close btn-sm ms-auto text-muted float-right" @click.stop="$emit('click', $event)">
        <icon name="close"/>
    </button>
</template>

<script>
  import icon from "./Icon.vue";
  export default {
    name: 'Close',
    components: {icon},
  }
</script>

<style scoped>

</style>
