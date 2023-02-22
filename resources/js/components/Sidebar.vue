<template>
  <div class="sidebar" ref="sidebar">
    <div class="pb-3 pt-2">
      <div class="nav nav-pills flex-column">
        <div class="nav-item" v-for="(item, key) in items" :key="key">
<!--          <a :href="item.to" target="_blank" class="nav-link">-->
<!--            <icon :name="item.icon"/>-->
<!--            <span class="my-auto">{{ item.label }}</span>-->
<!--          </a>-->
          <div @click=""
              class="nav-link pr-0">
            <icon :name="item.icon"/>
            <span class="my-auto">{{ item.label }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Icon from "./helpers/Icon.vue";

export default {
  name: "Sidebar.vue",
  components: {Icon},

  data() {
    return {
      opened: null,
      items: [
        {
          label: 'Pest Creation',
          icon: 'ios-leaf',
          to: '/admin',
        },
        {
          label: 'pages.publicMap',
          icon: 'ios-filing',
          to: '/adminn',
        },
      ],
    }
  },
}
</script>

<style scoped>

</style>