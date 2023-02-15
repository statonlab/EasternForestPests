<template>
  <div>
    <div class="card rounded-3 overflow-hidden">
      <div class="card-header border-bottom d-flex align-items-center">
        <div class="flex-grow-1 text-muted mt-3" style="flex-direction: column">
          <p>{{ 'Page ' + page + ' of ' + lastPage + '. ' + total + ' pests found' }}</p>
        </div>
        <div class="flex-shrink-0">
          <button class="btn btn-primary" type="button" @click.prevent="showpestsForm = true">
            <icon name="add"/>
            <span class="text-white">{{ 'New Pest' }}</span>
          </button>
        </div>
      </div>

      <div v-if="pests.length === 0 && loading" class="p-4 d-flex align-items-center justify-content-center">
        <inline-spinner class="text-primary"/>
      </div>
      <div v-if="pests.length === 0 && !loading" class="p-4 d-flex align-items-center justify-content-center">
        {{ 'No ' + selected + ' found' }}
      </div>
      <pests-list v-if="pests.length > 0" :pests="pests" @select="goToPest"/>
    </div>

    <!--    <pests-form v-if="showpestsForm" @create="created" @close="showpestsForm = false"/>-->
  </div>
</template>

<script>
import icon from "./Icon.vue";
import InlineSpinner from "./helpers/InlineSpinner.vue";
import PestsList from "./PestsList.vue";


export default {
  name: "GlossaryCard",
  components: {PestsList, icon, InlineSpinner},
  props: {
    pests: {type: Array, default: false, required: false},
    loading: {type: Boolean, default: true, required: false},
    page: {type: Number, default: 1, required: false},
    lastPage: {type: Number, default: 1, required: false},
    total: {type: Number, default: 1, required: false},
  },
  data() {
    return {
      showpestsForm: false,
    }
  },

  methods: {
    goToPest(pest) {
      this.$router.push({
        path: `/app/pests/${pest.id}`,
      })
    },

    created(pest) {
      // this.loadPests()
      this.showpestForm = false
      // this.$notify({
      //   text: `pest "${pest.title}" has been created successfully`,
      //   type: 'success',
      // })
    },
    // goTopests(pests) {
    //   this.$router.push({name: 'pests', params: {pestsId: pests.id}})
    // },
    // created(pests) {
    //   this.pests.unshift(pests)
    //   this.showpestsForm = false
    // },
  },
}
</script>

<style scoped>

</style>