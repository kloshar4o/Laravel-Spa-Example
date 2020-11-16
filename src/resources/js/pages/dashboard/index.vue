<template>
  <div class="row">
    <div class="col-md-3">
      <side-menu :menu="client_menu" :title="$t('menu.dashboard')"/>
    </div>

    <div class="col-md-9">
      <transition name="fade" mode="out-in">
        <router-view/>
      </transition>
    </div>
  </div>
</template>

<script>
import SideMenu from "~/components/sidebar/SideMenu";
import {mapGetters} from "vuex";
import store from "~/store";

export default {
  middleware: ['auth', 'dashboard'],
  components: {
    SideMenu
  },

  computed: {
    client_menu() {
      return [
        {icon: 'chart-area', name: "dashboard.overview"},
        {icon: 'users', name: "dashboard.users"},
        {icon: 'map-marker-alt', name: "dashboard.addresses"},
        {icon: 'cog', name: "dashboard.settings"},
      ]
    },
    ...mapGetters(['company'])

  },

  async beforeRouteEnter(to, from, next) {
    if (
      store.getters.company_id &&
      store.getters.company &&
      store.getters.company.id === store.getters.company_id
    ) next()

    await store.dispatch('fetchCompany')
    next()
  }

}
</script>

<style>
.settings-card .card-body {
  padding: 0;
}
</style>
