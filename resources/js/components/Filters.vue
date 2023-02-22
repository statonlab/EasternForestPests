<template>
  <div class="card mb-3">
    <div class="card-header">
      <!--      <div v-if="user.isSuperUser()" class="mt-2">-->
      <!--        <a href="#" @click.prevent="showForm = true">-->
      <!--          <icon name="settings"/>-->
      <!--          <strong>Manage Categories</strong>-->
      <!--        </a>-->
      <!--      </div>-->
      <div class="mt-1">
        <icon name="settings"/>
        <strong>Chapters</strong>
      </div>
    </div>
    <div class="p-2">
      <div v-if="!loading && this.categories.length > 0" class="nav nav-pills flex-column">
        <a href="#" class="nav-link d-flex"
           @click.prevent="select(category)"
           v-for="category in categories">
          <div class="flex-shrink-0">
            <span class="color-box d-block rounded"
                  :style="`background-color: ${category.color}`"/>
          </div>
          <div class="px-2 text-wrap flex-grow-1 overflow-hidden">
            <div class="leading-1">{{ category.title }}</div>
            <!--            <div class="text-muted text-xs leading-1 text-nowrap overflow-hidden text-ellipsis"-->
            <!--                 v-if="category.description">-->
            <!--              {{ category.description }}-->
            <!--            </div>-->
          </div>
          <div class="flex-shrink-0 d-flex justify-content-end">
            <!--            <icon name="checkmark" class="text-success w-auto"/>-->
            <span class="text-muted">{{ category.pests_count }}</span>
          </div>
        </a>
        <!--        <a v-if="showClearAll" href="#" @click.prevent="clearAll" class="nav-link d-flex mt-2 mb-2">-->
        <!--          <icon name="close"/>-->
        <!--          <span>Clear Filter</span>-->
        <!--        </a>-->
        <!--        <div class="text-muted text-center p-3" v-if="categories.length === 0 && !loading">-->
        <!--          No categories found. Please use the manage categories link above to add new categories.-->
        <!--        </div>-->
      </div>
      <div class="p-3" v-if="loading">
        <inline-spinner class="text-primary"/>
      </div>
    </div>
  </div>
</template>

<script>
import Icon from "./helpers/Icon.vue";
import User from "./helpers/User";
import InlineSpinner from "./helpers/InlineSpinner.vue";
import axios from "axios";

export default {
  name: "Filters",

  components: {InlineSpinner, Icon},

  props: {
    value: {
      required: false,
      type: Array,
      default: () => []
    }
  },

  data() {
    return {
      user: User,
      loading: true,
      categories: [],
      showForm: false,
      showClearAll: false,
      // value: []
    }
  },

  mounted() {
    this.loadCategories()
  },

  methods: {
    async loadCategories() {
      try {
        const {data} = await axios.get(`/chapters`)
        this.categories = data
      } catch (e) {
        if (e.response && e.response.status === 403) {
          // this.$alert(this.$t('errors.unauthorized'))
        } else {
          // this.$alert(this.$t('errors.general'))
        }
        console.error(e)
      }
      this.loading = false
    },

    select(category) {
      if (this.isSelected(category)) {
        this.$emit('input', [])
        this.showClearAll = false
      } else {
        this.$emit('input', [category.id])
        this.showClearAll = true
      }
    },

    isSelected(category) {
      if (this.value.includes(category.id)) {
        this.showClearAll = true
        return true
      }
      return false
    },

    clearAll() {
      this.$emit('input', [])
      this.showClearAll = false
    },
  },
}
</script>

<style scoped>
.color-box {
  width: 15px;
  height: 15px;
}
</style>