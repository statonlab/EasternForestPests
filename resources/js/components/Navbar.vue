<template>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        {{ 'Eastern Forest Pests' }}
      </a>
      this is navbar
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
        <ul class="navbar-nav ms-auto">
          <!-- Authentication Links -->
          <!--          @guest-->

          <!--          @else-->
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              <!--              {{ Auth::user()->name }}-->
              me
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="{}">
                              {{ 'Logout1' }}
                            </a>

                            <form action="/logout" method="post">
                              <input type="hidden" name="_token" :value="csrf">
                              <button type="submit" class="dropdown-item" @click.prevent="this.logout">
                                <!--                  <icon name="log-out"/>-->
                                <span>{{ 'users.logout2' }}</span>
                              </button>
                            </form>
<!--              <button class='dropdown-item'-->
<!--                      onclick="event.preventDefault();document.getElementById('logout-form').submit();">-->
<!--                <span>{{ 'Logout3' }}</span>-->
<!--              </button>-->
<!--              <form id="logout-form" action="/logout" method="POST" class="d-none">-->
<!--                <input type="hidden" name="_token" :value="csrf">-->
<!--                @csrf log OUT-->
<!--              </form>-->
            </div>
          </li>
          <!--          @endguest-->
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import User from "./helpers/User";

export default {
  name: "Navbar",
  data() {
    return {
      user: User.get(),
      csrf: window.app.csrf,
    }
  },
  methods:
      {
        async logout() {
          try {
            const {data} = await axios.get(`/logout`)
            this.$router.push({
              path: '/welcome',
            })
            // window.location.href = "http://easternforestpests.test/"
          } catch (e) {
            console.error(e)
          }
        }
      }
}
</script>

<style scoped>

</style>