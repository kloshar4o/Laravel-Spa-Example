import axios from 'axios'

const state = {
  company_user: null,
  company_users: null,
  company_users_meta: null,
}

const getters = {
  company_user: state => state.company_user,
  company_users: state => state.company_users,
  company_users_meta: state => state.company_users_meta,
}

const mutations = {
  UPDATE_COMPANY_USER(state, data) {
    state.company_user = data
  },
  UPDATE_COMPANY_USERS(state, {data, meta}) {
    state.company_users = data
    state.company_users_meta = meta
  },
}

const actions = {
  fetchCompanyUser({commit, rootGetters}, user_id) {

    const {company_id} = rootGetters.user
    const url = `/api/company/${company_id}/users/${user_id}`;

    return axios.get(url)
      .then(({data}) => commit('UPDATE_COMPANY_USER', data))
  },
  fetchCompanyUsers({commit, rootGetters}, page) {

    const {company_id} = rootGetters.user
    const url = `/api/company/${company_id}/users?page=${page}`;

    return axios.get(url)
      .then(({data}) => {
        commit('UPDATE_COMPANY_USERS', data)
        return data
      })
  },
  fetchCompanyUsersAll({commit, rootGetters}, page) {

    const {company_id} = rootGetters.user
    const url = `/api/company/${company_id}/users?page=${page}`;

    return axios.get(url)
      .then(({data}) => {
        commit('UPDATE_COMPANY_USERS', data)
        return data
      })
  },
  deleteCompanyUser({commit, dispatch}, {id, company_id, page}) {

    const url = `/api/company/${company_id}/users/${id}?page=${page}`;

    return axios.delete(url)
      .then(({data}) => commit('UPDATE_COMPANY_USERS', data))
      .catch(err => {
        dispatch('fetchCompanyUsers', page)
        console.error(err.message)
      })
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
