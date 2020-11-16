<template>
  <div class="row">
    <div class="col-md-3">
      <card :title="$t('menu.profile')" class="profile-card">
        <ul class="nav flex-column nav-pills">
          <li v-for="({name, icon}, key) in tabs"
              :key="key"
              class="nav-item">
            <router-link :to="{ name }" class="nav-link" active-class="active">
              <fa :icon="icon" fixed-width />
              {{ $t(name) }}
            </router-link>
          </li>
        </ul>
      </card>
    </div>

    <div class="col-md-9">
      <transition name="fade" mode="out-in">
        <router-view />
      </transition>
    </div>
  </div>
</template>

<script>
import Card from "~/components/Card";

export default {
  middleware: 'auth',
  components: {
    Card
  },

  computed: {
    tabs () {
      return [
        {icon: 'cog', name: "profile.settings"},
        {icon: 'lock', name: "profile.password"},
      ]
    }
  }
}
</script>

<style>
.profile-card .card-body {
  padding: 0;
}
</style>
