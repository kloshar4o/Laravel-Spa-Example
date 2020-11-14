import store from '~/store'

export default async (to, from, next) => {

  if (!store.getters.user && store.getters.user_token) {
    try {
      await store.dispatch('setAuthUser')
    } catch (e) {
      console.error(e.message)
    }
  }
  next()
}
