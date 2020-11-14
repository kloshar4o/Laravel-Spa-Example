import axios from 'axios'
import Cookies from 'js-cookie'

const state = {
  user: null,
  token: Cookies.get('token')
}

const getters = {
  user: state => state.user,
  is_admin: state => state.user.role === 'admin',
  is_client: state => state.user.role !== 'admin',
  user_token: state => state.token,
  check_auth: state => state.user !== null
}

const mutations = {
  LOGOUT(state) {
    state.user = null
    state.token = null
    Cookies.remove('token')
  },
  SET_USER(state, data) {
    state.user = data
  },
  SET_COMPANY_ID(state, company_id) {
    state.user.company_id = company_id
  },
  SAVE_TOKEN(state, {token, remember}) {
    state.token = token
    Cookies.set('token', token, {expires: remember ? 365 : null})
  },
}

// actions
const actions = {
  saveToken({commit, dispatch}, payload) {
    commit('SAVE_TOKEN', payload)
  },

  setAuthUser({commit}) {
    return axios.get('/api/user')
      .then(({data}) => commit('SET_USER', data))
  },

  logout({commit}) {
    return axios.post('/api/logout')
      .then(_ => commit('LOGOUT'))
  },
}

export default {
  state,
  getters,
  actions,
  mutations
}
