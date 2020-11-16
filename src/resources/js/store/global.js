const {locale} = window.config

const state = {
  locale: locale,
  axios_loading: false,
  global_middlewares: ['check-auth'],
}

const getters = {
  axios_loading: state => state.axios_loading,
  global_middlewares: state => state.global_middlewares
}

const mutations = {
  AXIOS_LOADING (state, loading) {
    state.axios_loading = loading
  },
}

export default {
  state,
  getters,
  mutations,
}
