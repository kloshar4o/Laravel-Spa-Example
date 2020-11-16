<template>
  <div>
    <div class="top-right links">
      <template v-if="check_auth">
        <router-link :to="{ name: 'dashboard' }">
          {{ $t('button.dashboard') }}
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


export default {
  layout: 'centeredLayout',

  data: () => ({
    title: window.config.app_name
  }),

  computed: mapGetters(['check_auth']),

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
