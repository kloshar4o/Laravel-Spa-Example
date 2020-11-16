<template>
  <card>
    <my-form :data="company"
             :url="url"
             method="patch"
             @submit="updateCompany"
             :inputs="inputs">
    </my-form>
  </card>
</template>

<script>
import {mapGetters} from 'vuex';
import store from "~/store";
import Card from "~/components/Card";
import MyForm from "~/components/form/MyForm";

export default {
  scrollToTop: false,
  components: {
    MyForm,
    Card
  },

  computed: {
    url: _ => '/api/company/' + store.getters.company.id,
    inputs: _ => [
      {name: 'company_name', type: 'text'},
      {name: 'company_status', type: 'radio', options: store.getters.company_statuses},
    ],
    ...mapGetters(['company'])
  },

  methods: {
    updateCompany({data}) {
      store.commit('UPDATE_COMPANY', data)
    }
  },
}
</script>
