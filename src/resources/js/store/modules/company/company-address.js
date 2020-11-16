import axios from 'axios'

const state = {
  company_address: null,
  company_addresses: null
}

const getters = {
  company_address: state => state.company_address,
  company_addresses: state => state.company_addresses,
}

const mutations = {
  UPDATE_COMPANY_ADDRESS(state, data) {
    state.company_address = data
  },
  UPDATE_COMPANY_ADDRESSES(state, {data}) {
    state.company_addresses = data
  },
}

const actions = {
  fetchCompanyAddress({commit, rootGetters}, address_id) {

    const {company_id} = rootGetters.user
    const url = `/api/company/${company_id}/addresses/${address_id}`;

    return axios.get(url)
      .then(({data}) => commit('UPDATE_COMPANY_ADDRESS', data))
  },

  fetchCompanyAddresses({commit, rootGetters}) {

    const {company_id} = rootGetters.user
    const url = `/api/company/${company_id}/addresses`;

    return axios.get(url)
      .then(({data}) => commit('UPDATE_COMPANY_ADDRESSES', data))
  },

  deleteCompanyAddress({commit, dispatch}, {id, company_id}) {

    const url = `/api/company/${company_id}/addresses/${id}`;

    return axios.delete(url)
      .then(({data}) => commit('UPDATE_COMPANY_ADDRESSES', data))
      .catch(({message}) => {
        dispatch('fetchCompanyAddresses')
        console.error(message)
      })
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
