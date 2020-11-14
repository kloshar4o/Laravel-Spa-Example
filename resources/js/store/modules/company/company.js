import axios from 'axios'

const state = {
  company: null,
  company_statuses: null,
}

const getters = {
  company: state => state.company,
  company_statuses: state => state.company_statuses,
}

const mutations = {
  UPDATE_COMPANY(state, data) {
    state.company = data
    if (data.status_options)
      state.company_statuses = data.status_options
  },
  SET_COMPANY_STATUSES(state, data){
    state.company_statuses = data
  }
}

const actions = {
  fetchCompany({commit, rootGetters}) {

    const {company_id} = rootGetters.user
    const url = `/api/company/${company_id}/edit`;

    return axios.get(url)
      .then(({data}) => commit('UPDATE_COMPANY', data))
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
