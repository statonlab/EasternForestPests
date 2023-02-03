<template>
  <transition name="fade">
    <div class="modal show fade d-block" tabindex="-1" role="dialog" :class="{'modal-scrollable': scrollable}">
      <div class="modal-backdrop bg-transparent-dark" @click.prevent="$emit('close')"></div>
      <div class="modal-dialog"
           :class="{'modal-lg':large, 'modal-xl': xlarge}"
           role="document"
           ref="modal"
           style="z-index: 1050">
        <slot></slot>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  name: 'Modal',

  props: {
    scrollable: {required: false, type: Boolean, default: false},
    large     : {required: false, default: false, type: Boolean},
    xlarge    : {required: false, default: false, type: Boolean},
  },

  data() {
    return {
      mounted: false,
    }
  },

  mounted() {

  },

  methods: {},
}
</script>

<style scoped>

</style>
