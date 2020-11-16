import axios from 'axios'

const state = {
  companies: null,
  company_edit: null,
  companies_meta: null,
}

const getters = {
  companies: state => state.companies,
  company_edit: state => state.company_edit,
  companies_meta: state => state.companies_meta,
}

const mutations = {
  UPDATE_COMPANY_EDIT(state, data) {
    state.company_edit = data
  },
  UPDATE_COMPANIES(state, {data, meta}) {
    state.companies = data
    state.companies_meta = meta
  },
}

const actions = {
  fetchCompanyEdit({commit, rootGetters}, company_id) {

    return axios.get('/api/companies/' + company_id)
      .then(({data}) => commit('UPDATE_COMPANY_EDIT', data))
  },

  fetchCompanyStatuses({commit}, ) {
    return axios.get('/api/company-statuses')
      .then(({data}) => commit('SET_COMPANY_STATUSES', data))
  },

  fetchCompanies({commit, rootGetters}, page) {
    return axios.get('/api/companies?page=' + page)
      .then(({data}) => {
        commit('UPDATE_COMPANIES', data)
        return data
      })
  },
  deleteCompany({commit, dispatch}, {id, page}) {

    const url = `/api/companies/${id}?page=${page}`;

    return axios.delete(url)
      .then(({data}) => commit('UPDATE_COMPANIES', data))
      .catch(err => {
        dispatch('fetchUsers', page)
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
