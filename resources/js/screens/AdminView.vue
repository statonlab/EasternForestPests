<template>
  <div>
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
      </div>
    </div>
  </div>
</template>

<script>
import PestsCard from "../components/PestsCard.vue";
import GlossaryCard from "../components/GlossaryCard.vue";
import Filters from "../components/Filters.vue";

export default {
  name: "AdminView",
  components: {Filters, GlossaryCard, PestsCard},
  data() {
    return {
      selectedChapters: [],
      active: 'pests',
    };
  },
}
</script>

<style scoped>

</style>