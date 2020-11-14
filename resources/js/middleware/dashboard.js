import store from '~/store'

export default (to, from, next) => {
  if (store.getters.user && store.getters.user.company_id) {
    next()
  } else {
    next({name: 'admin'})
  }
}
