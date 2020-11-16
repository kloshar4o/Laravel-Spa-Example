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
import store from "~/store";
import MyForm from "~/components/form/MyForm";
import GroupColumn from "~/components/form/GroupColumn";
import {mapGetters} from "vuex";

export default {
  scrollToTop: true,

  components: {
    MyForm,
    Card,
    GroupColumn
  },

  computed: {
    url: _ => {
      return `/api/companies`
    },
    inputs: _ => [
      {name: 'company_name', type: 'text'},
      {name: 'company_status', type: 'radio', options: store.getters.company_statuses},
    ],
    default_values: _ => ({
      company_status: 'disabled'
    }),
    ...mapGetters(['company_statuses'])
  },

  async beforeRouteEnter(to, from, next) {
    if (!store.getters.company_statuses)
      await store.dispatch('fetchCompanyStatuses')
    next()
  },

}
</script>
