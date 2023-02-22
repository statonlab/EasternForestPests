<template>
  <div class="">
    <h1 class="title mb-4">
      {{ 'Admin Panel' }}
    </h1>
    <div class="row">
      <div class="col-sm-4">
        <filters v-model="selectedChapters"/>
      </div>
      <div class="col-lg-8">
        <ul class="nav nav-pills mb-3 bg-white p-2 shadow-sm rounded border">
          <li class="nav-item">
            <a class="nav-link fw-bold" :class="{ active: active === 'pests' }" aria-current="page" href="#"
               @click="active = 'pests'">Pests</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold" :class="{ active: active === 'glossaries' }" href="#"
               @click="active = 'glossaries'">Glossary</a>
          </li>
        </ul>
        <pests-card v-if="active === 'pests'"/>
        <glossary-card v-if="active === 'glossaries'"/>
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
import DropdownPager from "../components/helpers/DropdownPager.vue";
import GlossaryCard from "../components/GlossaryCard.vue";
import Filters from "../components/Filters.vue";

export default {
  name: "AdminView.vue",
  components: {Filters, GlossaryCard, PestsCard, DropdownPager},
  data() {
    return {
      ready: true, // false
      pests: [],
      glossaries: [],
      selectedChapters: [],
      active: 'pests',
      total: null,
      requestToken: null,
    };
  },

  mounted() {
    // this.setOptionsFromHistory();
    // this.loadPests();
    // this.loadGlossary();
  },

  // watch: {
  //   // search(search) {
  //   //   if (this.timer) {
  //   //     clearTimeout(this.timer)
  //   //   }
  //   //   this.timer = setTimeout(() => {
  //   //     this.updateHistory({search})
  //   //     this.page = 1
  //   //     this.loadPosts()
  //   //   }, 500)
  //   // },
  //
  //   pestsPage(page) {
  //     this.$router.push({
  //       query: {
  //         ...this.$route.query,
  //         page,
  //       },
  //     }).catch((e) => {
  //       console.error(e)
  //     })
  //     this.loadPests()
  //   },
  //
  //   glossariesPage(page) {
  //     this.$router.push({
  //       query: {
  //         ...this.$route.query,
  //         page,
  //       },
  //     }).catch((e) => {
  //       console.error(e)
  //     })
  //     this.loadGlossary()
  //   },
  //
  //   // active() {
  //   //   this.loadPests()
  //   // }
  // },

  methods: {

    // select(view) {
    //   if (view === 'pests') {
    //     this.active = 'pests'
    //   } else {
    //     this.active = 'glossaries'
    //   }
    // },
  }
}
</script>

<style scoped>

</style>