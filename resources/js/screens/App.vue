<template>
  <div class="main-container">
<!--    <sidebar v-if="this.user"/>-->
    <div class="main-content">
      <navbar ref="navbar"/>
      <div class="py-3 px-2 content-container">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <router-view></router-view>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from "../components/Navbar.vue";
import Sidebar from "../components/Sidebar.vue";
import User from "../components/helpers/User";

export default {
  name: "App.vue",
  components: {Navbar, Sidebar},
  mounted() {
  },
  data() {
    return {
      user: User.get()
    }
  }
}
</script>

<style scoped>

</style>