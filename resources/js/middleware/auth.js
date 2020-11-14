import store from '~/store'
import Cookies from 'js-cookie'

export default async (to, from, next) => {
  if (!store.getters.check_auth) {
    Cookies.set('intended_url', to.path)
    next({ name: 'auth.login' })
  } else {
    next()
  }
}
