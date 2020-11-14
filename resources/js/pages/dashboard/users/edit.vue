<template>
  <card>
    <my-form :url="url"
             :inputs="info_inputs"
             :data="company_user"
             @submit="update"
             class="mb-5"
             method="patch">
    </my-form>

    <my-form :url="url"
             :inputs="password_inputs"
             :data="company_user"
             :key="password_forms"
             @submit="password_forms++"
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
      store.commit('UPDATE_COMPANY_USER', data)
      this.password_forms++
    }
  },

  computed: {
    url: _ => {
      const {company_id} = store.getters.user;
      const {id} = store.getters.company_user;
      return `/api/company/${company_id}/users/${id}`
    },
    info_inputs: _ => [
      {name: 'first_name', type: 'text'},
      {name: 'last_name', type: 'text'},
      {name: 'email', type: 'email'},
    ],
    password_inputs: _ => [
      {name: 'first_name', type: 'hidden'},
      {name: 'last_name', type: 'hidden'},
      {name: 'email', type: 'hidden'},
      {name: 'password', type: 'password'},
      {name: 'password_confirmation', type: 'password'},
    ],
    ...mapGetters(['company_user']),
  },

  async beforeRouteEnter(to, from, next) {
    if (!store.getters.company_user)
      await store.dispatch('fetchCompanyUser', to.params.id)

    next()
  },
}
</script>
