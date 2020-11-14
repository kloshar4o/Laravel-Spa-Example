<template>
  <card>
    <my-form :url="url"
             :inputs="inputs"
             :reset="true"
             class="mb-5"
             method="post">
    </my-form>
  </card>
</template>

<script>

import store from "~/store";
import Card from "~/components/Card";
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
      return `/api/company/${company_id}/addresses`
    },
    inputs: _ => [
      {name: 'country', type: 'text'},
      {name: 'city', type: 'text'},
      {name: 'town', type: 'text'},
      {name: 'street_address', type: 'text'},
      {name: 'state', type: 'text'},
      {name: 'zip', type: 'text'},
    ],
  },

}
</script>
