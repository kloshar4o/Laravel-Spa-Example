import Vue from 'vue'
import Meta from 'vue-meta'
import Router from 'vue-router'
import {sync} from 'vuex-router-sync'
import store from '~/store'
import admin_routes from "~/router/routes/admin_routes";
import public_routes from "~/router/routes/public_routes";
import profile_routes from "~/router/routes/profile_routes";
import dashboard_routes from "~/router/routes/dashboard_routes";
import {getComponents, callMiddlewares} from "~/router/methods/guard";
import scrollBehavior from "~/router/methods/scrollBehabior";

Vue.use(Meta)
Vue.use(Router)


const router = new Router({
  scrollBehavior,
  mode: 'history',
  routes: [
    ...admin_routes,
    ...profile_routes,
    ...dashboard_routes,
    ...public_routes,
  ]
})

sync(store, router)


router.beforeEach( async (to, from, next) => {

  let components = await getComponents(to);

  if (components.length === 0)
    return next()

  // Start the loading bar.
  if (components[components.length - 1].loading !== false)
    router.app.$nextTick(() => router.app.$loading.start())

  // Call each middleware
  callMiddlewares(to, from, next, components, router)
})

router.afterEach(async () => {
    await router.app.$nextTick()
    router.app.$loading.finish()
  }
)

export default router



