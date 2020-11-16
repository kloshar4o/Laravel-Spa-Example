<template>
  <div>
    <div class="top-right links">
      <template v-if="check_auth">
        <router-link :to="{ name: app_link }">
          {{ $t('menu.' + app_link) }}
        </router-link>
      </template>
      <template v-else>
        <router-link :to="{ name: 'auth.login' }">
          {{ $t('auth.login') }}
        </router-link>
      </template>
    </div>

    <div class="text-center">
      <div class="title mb-4">
        {{ title }}
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import store from "~/store";


export default {
  layout: 'centeredLayout',

  data: () => ({
    title: window.config.app_name
  }),

  computed: {
    ...mapGetters(['check_auth']),
    app_link: () => {
      return store.getters.is_admin ? 'admin' : 'dashboard'
    }
  },

}
</script>

<style scoped>
.top-right {
  position: absolute;
  right: 10px;
  top: 18px;
}

.title {
  font-size: 85px;
}
</style>
