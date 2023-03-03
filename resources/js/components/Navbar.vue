<template>
  <div class="bg-white">
    <nav class="py-3 navbar navbar-expand-lg navbar-light shadow-sm">
        <a class="navbar-brand" href='#' @click="goto('/')">
          {{ 'Eastern Forest Pests' }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav me-auto">

          </ul>

          <!-- Right Side Of Navbar -->
          <div class="navbar-nav ms-auto">
            <a class="nav-item nav-link" :class="this.path == '/admin' ? 'nav-active' : null" href='#' @click="goto('/admin')" v-if="this.user">{{ 'Admin' }}</a>
            <a class="nav-item nav-link" href='#' @click="goto('/')">{{ 'Search' }}</a>
            <a class="nav-item nav-link" href='#' @click="goto('/glossary')">{{ 'Glossary' }}</a>
            <a class="nav-item nav-link" href='#' @click="goto('/about')">{{ 'About' }}</a>

            <div class="nav-item dropdown" v-if="this.user">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                 data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ this.user.name }}
              </a>

              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <button class="dropdown-item"
                        @click.prevent="this.logout">
                  {{ 'Logout' }}
                </button>

                <!--              <form action="/logout" method="post">-->
                <!--                <input type="hidden" name="_token" :value="csrf">-->
                <!--                <button type="submit" class="dropdown-item" @click.prevent="this.logout">-->
                <!--                  &lt;!&ndash;                  <icon name="log-out"/>&ndash;&gt;-->
                <!--                  <span>{{ 'users.logout2' }}</span>-->
                <!--                </button>-->
                <!--              </form>-->
                <!--              <button class='dropdown-item'-->
                <!--                      onclick="event.preventDefault();document.getElementById('logout-form').submit();">-->
                <!--                <span>{{ 'Logout3' }}</span>-->
                <!--              </button>-->
                <!--              <form id="logout-form" action="/logout" method="POST" class="d-none">-->
                <!--                <input type="hidden" name="_token" :value="csrf">-->
                <!--                @csrf log OUT-->
                <!--              </form>-->
              </div>
            </div>
            <!--          @endguest-->
          </div>
        </div>
    </nav>
  </div>
</template>

<script>
import User from "./helpers/User";

export default {
  name: "Navbar",
  data() {
    return {
      user: User.get(),
      csrf: window.app.csrf,
      path: null,
    }
  },
  mounted() {
    // get the route from vue router, and highlight the appropriate button in the header
    // console.log(this.$router.currentRoute.rawValue.path)
    this.path = this.$route.path
    // console.log(this.$route)
    // console.log(this.$router)

    // console.log(this.$route.query)
    // console.log(this.$router.history.current.path)
  },
  methods:
      {
        async logout() {
          try {
            const {data} = await axios.get(`/web/logout`)
            // this.$router.push({
            //   path: '/',
            // })
            window.location.href = "http://easternforestpests.test/"
          } catch (e) {
            console.error(e)
          }
        },

        goto(path) {
          this.$router.push({
            path: path,
          })
        }
      }
}
</script>

<style scoped>

</style>