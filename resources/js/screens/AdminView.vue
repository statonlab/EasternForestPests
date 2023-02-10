<template>
  <div class="">
    <h1 class="title mb-4">
      {{ 'Admin Panel' }}
    </h1>
    <div class="row">
      <div class="col-sm-6 col-md-4 col-xl-3 border">
        filters here?
      </div>
      <div class="col-lg-8">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link fw-bold" :class="{ active: pestsActive }" aria-current="page" href="#" @click="select('pests')">Pests</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold" :class="{ active: glossaryActive }" href="#" @click="select('glossary')">Glossary</a>
          </li>
        </ul>
        <pests-card :pests="pests" :loading="loading" :page="page" :lastPage="lastPage" :total="total"/>
        <div class="px-4 py-4" v-if="lastPage > 1">
          <dropdown-pager
              class="card-footer"
              :page="page"
              :last-page="lastPage"
              @change="pageChanged"
          />
        </div>
<!--        <div class="card-footer px-4 py-3 bg-light d-flex justify-content-end" v-if="lastPage > 1">-->
<!--          <dropdown-pager-->
<!--              class="card-footer"-->
<!--              :page="page"-->
<!--              :last-page="lastPage"-->
<!--              @change="pageChanged"-->
<!--          />-->
<!--        </div>-->
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import PestsCard from "../components/PestsCard.vue";
import DropdownPager from "../components/DropdownPager.vue";

export default {
  name: "AdminView.vue",
  components: {PestsCard, DropdownPager},
  data() {
    return {
      ready: true, // false
      loading: true,
      pests: [],
      glossary: [],
      pestsActive: true,
      glossaryActive: false,
      page: 1,
      lastPage: 1,
      total:null,
      requestToken: null,
    };
  },

  mounted() {
    this.loadPests();
  },

  watch: {
    // search(search) {
    //   if (this.timer) {
    //     clearTimeout(this.timer)
    //   }
    //   this.timer = setTimeout(() => {
    //     this.updateHistory({search})
    //     this.page = 1
    //     this.loadPosts()
    //   }, 500)
    // },

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
      if (this.$route.query.page) {
        this.page = parseInt(this.$route.query.page)
      }

      this.ready = true
    },

    select(view) {
      if (view === 'pests') {
        this.pestsActive = true
        this.glossaryActive = false
      } else {
        this.pestsActive = false
        this.glossaryActive = true
      }
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
        const url = '/pests'
        const {data} = await axios.get(url, {
          cancelToken: this.requestToken.token,
          params: {
            perPage: this.view === 'table' ? 50 : 20,
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
        // if (!axios.isCancel(e)) {
        console.error(e)
        // }
      }

      this.requestToken = null
      this.loading = false
    },

    pageChanged(page) {
      this.loading = true
      this.page = page
      // this.$scrollTo(0, 0)
    },
  }
}
</script>

<style scoped>

</style>