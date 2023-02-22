<template>
  <div class="form-group">
    <label>{{ 'What chapter is this pest location in?' }}</label>
    <select class="form-control" v-model="this.chapter">
      <option disabled :value="null">{{ 'select a chapter' }}</option>
      <option v-for="chapter in chapters" :value="chapter">
        {{ `Chapter ${chapter.id}: ${chapter.title}` }}
      </option>
    </select>
    <!--    <span class="form-text text-danger" v-if="form.errors.has('chapter')">-->
    <!--              {{ form.errors.first('chapter') }}-->
    <!--            </span>-->
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: 'chapter-select',
  props: {
    value: {
      required: false,
      type: Object,
      default: null,
    },
    // chapters: {},
    // form: {type: Function}
  },

  data() {
    return {
      loading: false,
      chapters: null,
    }
  },

  mounted() {
    this.loadChapters()
  },

  methods: {
    loadChapters() {
      this.loading = true
      axios.get(`/chapters`)
          .then(({data}) => {
            this.chapters = data
          })
          .catch(e => {
            console.error(e)
          })
          .finally(() => {
            this.loading = false
          })
    },
  }
}
</script>
<style>
.img-max-w-400 img {
  max-width: 800px !important;
  height: auto !important;
  display: block;
  /*margin: 0 auto;*/
}
</style>