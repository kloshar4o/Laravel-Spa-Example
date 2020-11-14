<template>
  <card>
    <my-form :url="url"
             :inputs="inputs"
             :data="default_values"
             :reset="true"
             class="mb-5"
             method="post">
    </my-form>
  </card>
</template>

<script>

import Card from "~/components/Card";
import MyForm from "~/components/form/MyForm";
import GroupColumn from "~/components/form/GroupColumn";
import {mapGetters} from "vuex";
import store from "~/store";

export default {
  scrollToTop: true,

  components: {
    MyForm,
    Card,
    GroupColumn
  },

  computed: {
    url: _ => {
      return `/api/users`
    },
    inputs: _ => [
      {name: 'first_name', type: 'text'},
      {name: 'last_name', type: 'text'},
      {name: 'email', type: 'email'},
      {name: 'company_id', type: 'select'},
      {name: 'role', type: 'radio', options: store.getters.roles},
      {name: 'password', type: 'password'},
      {name: 'password_confirmation', type: 'password'},
    ],
    default_values: _ => ({
      role: 'user'
    }),
    ...mapGetters(['roles'])
  },

  async beforeRouteEnter(to, from, next) {
    if (!store.getters.roles)
      await store.dispatch('fetchRoles')
    next()
  },

}
</script>
