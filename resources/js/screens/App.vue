<template>
  <div class="bg-gray-lighter">
<!--    <sidebar v-if="this.user"/>-->
    <div>
      <navbar ref="navbar"/>
      <div class="py-4 px-2">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <router-view></router-view>
            </div>
          </div>
        </div>
      </div>
    </div>
    <notifications class="notifications"/>
  </div>
</template>

<script>
import Navbar from "../components/Navbar.vue";
import Sidebar from "../components/Sidebar.vue";
import User from "../components/helpers/User";

export default {
  name: "App",
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