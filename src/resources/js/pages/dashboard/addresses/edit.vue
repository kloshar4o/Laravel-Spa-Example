<template>
  <card>
    <my-form :url="url"
             :inputs="inputs"
             :data="company_address"
             class="mb-5"
             method="patch">
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

  computed: {
    url: _ => {
      const {company_id} = store.getters.user;
      const {id} = store.getters.company_address;
      return `/api/company/${company_id}/addresses/${id}`
    },
    inputs: _ => [
      {name: 'country', type: 'text'},
      {name: 'city', type: 'text'},
      {name: 'town', type: 'text'},
      {name: 'street_address', type: 'text'},
      {name: 'state', type: 'text'},
      {name: 'zip', type: 'text'},
    ],
    ...mapGetters(['company_address']),
  },

  async beforeRouteEnter(to, from, next) {
    if (!store.getters.company_address)
      await store.dispatch('fetchCompanyAddress', to.params.id)
    next()
  },
}
</script>
