<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">

      <router-link :to="{ name: 'home' }" class="navbar-brand">
        {{ app_name }}
      </router-link>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
              aria-controls="navbarToggler" aria-expanded="false">
        <span class="navbar-toggler-icon"/>
      </button>

      <div id="navbarToggler" class="collapse navbar-collapse">
        <!-- Auth -->
        <ul v-if="user" class="navbar-nav ml-auto">
          <!-- User menu-->

          <li v-if="is_admin" v-for="name in admin_menu" :key="name" class="nav-item">
            <router-link :to="{ name }" class="nav-link">
              {{ $t(`menu.${name}`) }}
            </router-link>
          </li>

          <li v-if="is_client" v-for="name in client_menu" :key="name" class="nav-item">
            <router-link :to="{ name }" class="nav-link">
              {{ $t(`menu.${name}`) }}
            </router-link>
          </li>


          <!-- Profile menu-->
          <div class="nav-item dropdown border-left ml-5">
            <a class="nav-link dropdown-toggle"
               href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img :src="user.photo_url" class="rounded-circle profile-photo mr-1">
              {{ user.first_name }}
            </a>

            <div class="dropdown-menu">
              <router-link v-for="({name, icon}) in profile_menu"
                           :to="{ name }"
                           :key="name"
                           class="dropdown-item pl-3">
                <fa :icon="icon" fixed-width/>
                {{ $t(`menu.${name}`) }}
              </router-link>

              <div class="dropdown-divider"/>

              <a href="#" class="dropdown-item pl-3" @click.prevent="logout">
                <fa icon="sign-out-alt" fixed-width/>
                {{ $t('menu.logout') }}
              </a>
            </div>
          </div>

        </ul>

        <!-- Guest -->
        <ul v-else class="navbar-nav ml-auto">
          <li class="nav-item">
            <router-link :to="{ name: 'auth.login' }" class="nav-link" active-class="active">
              {{ $t('auth.login') }}
            </router-link>
          </li>
        </ul>

      </div>

    </div>
  </nav>
</template>

<script>
import {mapGetters} from 'vuex'

export default {

  data() {
    return {
      admin_menu: [
        'admin'
      ],
      client_menu: [
        'dashboard'
      ],
      profile_menu: [
        {name: "profile", icon: "cog"},
      ],
      guest_menu: [
        'auth.login'
      ],
      app_name: window.config.app_name
    }
  },

  computed: {
    ...mapGetters(['user', 'is_admin', 'is_client'])
  },

  methods: {
    async logout() {
      // Log out the user.
      await this.$store.dispatch('logout')

      // Redirect to login.
      this.$router.push({name: 'auth.login'})
    }
  }
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
</style>
