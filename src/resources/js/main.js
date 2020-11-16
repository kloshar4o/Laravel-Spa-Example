import Vue from 'vue'
import App from './App.vue'
import store from './store'
import router from './router'
import i18n from './plugins/i18n'
import './plugins'

new Vue({
  ...App,
  i18n,
  store,
  router,
})
