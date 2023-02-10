<template>
    <nav aria-label="Page navigation" v-if="lastPage > 1">
        <ul class="pagination justify-content-center mb-0">
            <li :class="['page-item', {disabled: page === 1}]">
                <a class="page-link"
                   href="#"
                   tabindex="-1"
                   :aria-disabled="page === 1 ? 'true' : 'false'"
                   @click.prevent="previous()">Previous</a>
            </li>
            <li v-for="i in lastPage" :class="['page-item', {active: page === i}]">
                <a class="page-link" href="#" @click.prevent="change(i)">{{ i }}</a>
            </li>
            <li :class="['page-item', {disabled: lastPage === page}]">
                <a class="page-link"
                   href="#"
                   :aria-disabled="lastPage === page ? 'true' : 'false'"
                   @click.prevent="next()">Next</a>
            </li>
        </ul>
    </nav>
</template>

<script>
  import Dropdown from './Dropdown.vue'
  export default {
    name: 'Pager',
    components: {Dropdown},
    props: {
      lastPage: {required: true, type: Number},
      page    : {required: true, type: Number},
    },

    methods: {
      previous() {
        if (this.page === 1) {
          return
        }

        this.$emit('change', this.page - 1)
      },

      next() {
        if (this.lastPage === this.page) {
          return
        }

        this.$emit('change', this.page + 1)
      },

      change(page) {
        if (this.page === page) {
          return
        }

        this.$emit('change', page)
      },
    },
  }
</script>

<style scoped>

</style>
