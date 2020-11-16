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

import Card from "~/components/Card";
import store from "~/store";
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
      return `/api/company/${company_id}/users`
    },
    inputs: _ => [
      {name: 'first_name', type: 'text'},
      {name: 'last_name', type: 'text'},
      {name: 'email', type: 'email'},
      {name: 'password', type: 'password'},
      {name: 'password_confirmation', type: 'password'},
    ],
  },

}
</script>
