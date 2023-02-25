<template>
  <div>

  </div>
</template>
<script>
import axios from "axios";
import Required from "../components/helpers/Required.vue";

export default {
  name: 'chapter-select',
  components: {Required},
  props: ['modelValue'],
  emits: ['update:modelValue'],
  // props: {
  //   value: {
  //     required: true,
  //   },
  //   // chapters: {},
  //   // form: {type: Function}
  // },

  data() {
    return {
      loading: false,
      chapters: null,
      selected: '',
    }
  },

  mounted() {
    this.loadChapters()
  },

  watch: {
    selected(selected) {
      // this.$emit('input', selected)
    this.$emit('update:modelValue', selected)
    }
  },

  methods: {

  }
}
</script>
<style>

</style>