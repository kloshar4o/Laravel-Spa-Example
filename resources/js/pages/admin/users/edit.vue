<template>
  <card>
    <my-form :url="url"
             :inputs="info_inputs"
             :search_options="[search_selected]"
             :search_selected="search_selected"
             :data="user_edit"
             @submit="update"
             class="mb-5"
             method="patch">
    </my-form>

    <my-form :url="url"
             :inputs="password_inputs"
             :data="user_edit"
             :key="password_forms"
             method="patch">

      <template v-slot:form_title>
        Change password
      </template>

    </my-form>
  </card>
</template>

<script>

import Card from "~/components/Card";
import store from "~/store";
import {mapGetters} from "vuex";
import MyForm from "~/components/form/MyForm";
import GroupColumn from "~/components/form/GroupColumn";

export default {
  scrollToTop: true,

  components: {
    MyForm,
    Card,
    GroupColumn
  },

  data: () => ({
    password_forms: 1,
  }),

  methods: {
    update({data}){
      store.commit('UPDATE_USER_EDIT', data)
      this.password_forms++
    }
  },

  computed: {
    url: _ => {
      const {id} = store.getters.user_edit;
      return '/api/users/' + id
    },
    search_selected: _ => ({
      company_id: store.getters.user_edit.company
    }),
    info_inputs: _ => [
      {name: 'first_name', type: 'text'},
      {name: 'last_name', type: 'text'},
      {name: 'email', type: 'email'},
      {name: 'company_id', type: 'search', label: 'company_name'},
      {name: 'role', type: 'radio', options: store.getters.roles},
    ],
    password_inputs: _ => [
      {name: 'first_name', type: 'hidden'},
      {name: 'last_name', type: 'hidden'},
      {name: 'email', type: 'hidden'},
      {name: 'password', type: 'password'},
      {name: 'password_confirmation', type: 'password'},
    ],
    ...mapGetters(['user_edit']),
  },

  async beforeRouteEnter(to, from, next) {
    if (!store.getters.user_edit)
      await store.dispatch('fetchUserEdit', to.params.id)

    if (!store.getters.roles)
      await store.dispatch('fetchRoles')

    next()
  },
}
</script>
