import store from '~/store'

export default (to, from, next) => {
  if (store.getters.check_auth) {
    next({ name: 'home' })
  } else {
    next()
  }
}
