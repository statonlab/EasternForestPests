<template>
  <div>
<!--    <alerts/>-->

    <div :class="'main-container'">
      <!-- Navbar -->
<!--      <navbar @toggle="toggleSidebar" ref="navbar"/>-->
      <!-- sidebar -->
<!--      <sidebar ref="sidebar" @close="smClose"/>-->
      <div class="main-content">
        <!-- main content -->
        <div class="py-3">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                this is app.vue
<!--                <router-view></router-view>-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<!--    <notifications class="notifications"/>-->
  </div>
</template>

<script>
import Navbar from "../components/Navbar.vue";

export default {
  name: "App.vue",
  components: {Navbar},
  // props: {
  //   user       : {required: false, type: Number},
  // },
  // mounted() {
  //   console.log(this.user)
  // }
}
</script>

<style scoped>

</style>