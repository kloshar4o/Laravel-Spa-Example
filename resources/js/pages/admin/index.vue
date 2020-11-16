<template>
  <div class="row" v-if="user && !user.company_id">

    <div class="col-md-3">
      <side-menu :menu="admin_menu" :title="$t('menu.admin')"/>
    </div>

    <div class="col-md-9">
      <transition name="fade" mode="out-in">
        <router-view/>
      </transition>
    </div>

  </div>

  <div v-else>
    <router-view/>
  </div>
</template>

<script>
import SideMenu from "~/components/sidebar/SideMenu";
import {mapGetters} from "vuex";

export default {
  middleware: 'auth',
  components: {
    SideMenu
  },
  computed: {
    admin_menu() {
      return [
        {icon: 'chart-area', name: "admin.overview"},
        {icon: 'building', name: "admin.companies"},
        {icon: 'users', name: "admin.users"},
      ]
    },
    ...mapGetters(['user'])
  },
}
</script>

<style>
.settings-card .card-body {
  padding: 0;
}
</style>
