<template>
  <div>
    <div class="card rounded-3 overflow-hidden">
      <div class="card-header border-bottom d-flex align-items-center">
        <!--        <div class="flex-grow-1 text-muted mt-3" style="flex-direction: column">-->
        <!--          <p>{{ 'Page ' + page + ' of ' + lastPage + '. ' + total + ' pests found' }}</p>-->
        <!--        </div>-->
        <div class="flex-grow-1">
          <input type="search"
                 class="form-control"
                 v-model="search"
                 placeholder="Search"
                 name="search"/>
        </div>
        <div class="flex-shrink-0">
          <button class="btn btn-primary" type="button" @click.prevent="showPestForm = true">
            <icon name="add"/>
            <span>{{ 'New Pest' }}</span>
          </button>
        </div>
      </div>

      <div v-if="pests.length === 0 && loading" class="p-4 d-flex align-items-center justify-content-center">
        <inline-spinner class="text-primary"/>
      </div>
      <div v-if="pests.length === 0 && !loading" class="p-4 d-flex align-items-center justify-content-center">
        {{ 'No pests found' }}
      </div>
      <pests-list v-if="pests.length > 0" :pests="pests" @select="goToPest"/>
    </div>
    <div class="px-4 py-4" v-if="lastPage > 1">
      <dropdown-pager
          class="card-footer"
          :page="page"
          :last-page="lastPage"
          @change="pageChanged"
      />
    </div>

    <pest-form v-if="showPestForm" :pest="selectedPest" @update="created" @close="showPestForm = false"/>
  </div>
</template>

<script>
import icon from "./helpers/Icon.vue";
import InlineSpinner from "./helpers/InlineSpinner.vue";
import PestsList from "./PestsList.vue";
import axios from "axios";
import DropdownPager from "./helpers/DropdownPager.vue";
import PestForm from "../screens/PestForm.vue";


export default {
  name: "PestsCard",
  components: {PestsList, icon, InlineSpinner, DropdownPager, PestForm},
  data() {
    return {
      ready: false,
      loading: true,
      pests: [],
      selectedPest: null,
      showPestForm: false,
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
    this.loadPests()
  },

  watch: {
    search(search) {
      if (this.timer) {
        clearTimeout(this.timer)
      }
      this.timer = setTimeout(() => {
        // this.updateHistory({search})
        this.page = 1
        this.loadPests()
      }, 600)
    },

    page(page) {
      // this.$router.push({
      //   query: {
      //     ...this.$route.query,
      //     page,
      //   },
      // }).catch((e) => {
      //   console.error(e)
      // })
      this.loadPests()
    },
  },

  methods: {
    setOptionsFromHistory() {
      // if (this.$route.query.page) {
      //   this.page = parseInt(this.$route.query.page)
      // }
      this.ready = true
    },

    goToPest(pest) {
      this.$router.push({
        path: `/pest/${pest.id}`,
      })
    },

    created(pest) {
      // this.loadPests()
      this.showPestForm = false
      this.loadPests()
      // this.$notify({
      //   text: `pest "${pest.title}" has been created successfully`,
      //   type: 'success',
      // })
    },


    async loadPests() {
      if (!this.ready) {
        return
      }

      this.loading = true

      if (this.requestToken !== null) {
        this.requestToken.cancel()
      }

      this.requestToken = axios.CancelToken.source()

      try {
        const {data} = await axios.get('/web/pests', {
          cancelToken: this.requestToken.token,
          params: {
            search: this.search,
            perPage: this.perPage,
            page: this.page,
            // filters: this.filters,
          },
        })

        this.pests = data.data
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