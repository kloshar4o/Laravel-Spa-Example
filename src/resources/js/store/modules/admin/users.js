import axios from 'axios'

const state = {
  users: null,
  user_edit: null,
  users_meta: null,
  roles: null,
}

const getters = {
  users: state => state.users,
  user_edit: state => state.user_edit,
  users_meta: state => state.users_meta,
  roles: state => state.roles,
}

const mutations = {
  UPDATE_USER_EDIT(state, data) {
    state.user_edit = data
  },
  UPDATE_USERS(state, {data, meta}) {
    state.users = data
    state.users_meta = meta
  },
  SET_ROLES(state, data){
    state.roles = data
  }
}

const actions = {
  fetchUserEdit({commit, rootGetters}, user_id) {

    return axios.get('/api/users/' + user_id)
      .then(({data}) => commit('UPDATE_USER_EDIT', data))
  },

  fetchRoles({commit}, ) {
    return axios.get('/api/roles')
      .then(({data}) => commit('SET_ROLES', data))
  },

  fetchUsers({commit, rootGetters}, page) {
    return axios.get('/api/users?page=' + page)
      .then(({data}) => {
        commit('UPDATE_USERS', data)
        return data
      })
  },
  deleteUser({commit, dispatch}, {id, page}) {

    const url = `/api/users/${id}?page=${page}`;

    return axios.delete(url)
      .then(({data}) => commit('UPDATE_USERS', data))
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
