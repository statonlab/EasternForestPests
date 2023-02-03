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
                test
                <router-view></router-view>
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
export default {
  name: "App.vue"
}
</script>

<style scoped>

</style>