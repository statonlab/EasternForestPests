<template>
  <div>
    <div class="card rounded-3 overflow-hidden">
      <div class="card-header border-bottom d-flex align-items-center">
        <div class="flex-grow-1 text-muted mt-3" style="flex-direction: column">
          <p>{{ 'Page ' + page + ' of ' + lastPage + '. ' + total + ' glossary entries found' }}</p>
        </div>
        <div class="flex-shrink-0">
          <button class="btn btn-primary" type="button" @click.prevent="showGlossariesForm = true">
            <icon name="add"/>
            <span class="text-white">{{ 'New Glossary Entry' }}</span>
          </button>
        </div>
      </div>

      <div v-if="glossaries.length === 0 && loading" class="p-4 d-flex align-items-center justify-content-center">
        <inline-spinner class="text-primary"/>
      </div>
      <div v-if="glossaries.length === 0 && !loading" class="p-4 d-flex align-items-center justify-content-center">
        {{ 'No glossary entries found' }}
      </div>
      <glossaries-list v-if="glossaries.length > 0" :glossaries="glossaries" @select="goToGlossary"/>
    </div>
    <div class="px-4 py-4" v-if="lastPage > 1">
      <dropdown-pager
          class="card-footer"
          :page="page"
          :last-page="lastPage"
          @change="pageChanged"
      />
    </div>

    <!--    <glossaries-form v-if="showglossariesForm" @create="created" @close="showglossariesForm = false"/>-->
  </div>
</template>

<script>
import icon from "./helpers/Icon.vue";
import InlineSpinner from "./helpers/InlineSpinner.vue";
import GlossariesList from "./GlossariesList.vue";
import axios from "axios";
import DropdownPager from "./helpers/DropdownPager.vue";


export default {
  name: "GlossaryCard",
  components: {GlossariesList, icon, InlineSpinner, DropdownPager},
  data() {
    return {
      showGlossariesForm: false,
      ready: false,
      glossaries: [],
      loading: true,
      page: 1,
      lastPage: 1,
      total: 1,
      perPage: 10,
      requestToken: null,
      search: '',
    }
  },

  mounted() {
    this.setOptionsFromHistory()
    this.loadGlossary()
  },

  methods: {
    setOptionsFromHistory() {
      // if (this.$route.query.page) {
      //   this.page = parseInt(this.$route.query.page)
      // }

      this.ready = true
    },

    goToGlossary(glossary) {
      this.$router.push({
        path: `/app/glossaries/${glossary.id}`,
      })
    },

    created(glossary) {
      // this.loadglossaries()
      this.showglossaryForm = false
      // this.$notify({
      //   text: `glossary "${glossary.title}" has been created successfully`,
      //   type: 'success',
      // })
    },
    // goToglossaries(glossaries) {
    //   this.$router.push({name: 'glossaries', params: {glossariesId: glossaries.id}})
    // },
    // created(glossaries) {
    //   this.glossaries.unshift(glossaries)
    //   this.showglossariesForm = false
    // },

    async loadGlossary() {
      if (!this.ready) {
        return
      }

      this.loading = true

      if (this.requestToken !== null) {
        this.requestToken.cancel()
      }

      this.requestToken = axios.CancelToken.source()

      try {
        const {data} = await axios.get('/web/glossaries', {
          cancelToken: this.requestToken.token,
          params: {
            perPage: this.perPage,
            page: this.page,
            // filters: this.filters,
          },
        })

        this.glossaries = data.data
        this.lastPage = data.last_page
        this.total = data.total
        // this.perPage      = this.observations.length

        // if (this.page !== 1 && data.data.length === 0) {
        //   this.page = 1
        // }
      } catch (e) {
        console.error(e)
      }

      this.requestToken = null
      this.loading = false
    },


    pageChanged(page) {
      this.loading = true
      this.page = page
      // this.$scrollTo(0, 0)
    },
  },
}
</script>

<style scoped>

</style>