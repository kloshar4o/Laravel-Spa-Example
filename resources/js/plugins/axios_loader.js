import axios from 'axios'
import store from '~/store'
import router from '~/router'
import Swal from 'sweetalert2'
import i18n from "~/plugins/i18n";

// Request interceptor
axios.interceptors.request.use(request => {
  store.commit('AXIOS_LOADING', true)

  const token = store.getters.user_token
  if (token)
    request.headers.common.Authorization = `Bearer ${token}`

  const locale = store.getters.locale
  if (locale)
    request.headers.common['Accept-Language'] = locale

  return request
})

// Response interceptor
axios.interceptors.response.use(
  response => {
    store.commit('AXIOS_LOADING', false)
    return response
  },
  error => {
    store.commit('AXIOS_LOADING', false)

    const {status} = error.response

    if (status >= 500) {
      Swal.fire({
        icon: 'error',
        title: i18n.t('alert.error_alert_title'),
        text: i18n.t('alert.error_alert_text'),
        confirmButtonText: i18n.t('ok'),
      })
    }

    if (status === 401 && store.getters.check_auth) {
      Swal.fire({
        icon: 'warning',
        title: i18n.t('alert.token_expired_alert_title'),
        text: i18n.t('alert.token_expired_alert_text'),
        confirmButtonText: i18n.t('ok'),
      }).then(() => {
        store.commit('LOGOUT')
        router.push({name: 'auth.login'})
      })
    }

    if (status === 403 && store.getters.check_auth) {
      Swal.fire({
        icon: 'error',
        title: i18n.t('alert.error_alert_title'),
        text: i18n.t('alert.unauthorized'),
        confirmButtonText: i18n.t('ok'),
      })
    }

    return Promise.reject(error)
  })
