<template>
  <card>
    Company Overview
  </card>
</template>

<script>

import store from "~/store";

import Card from "~/components/Card";
export default {

  middleware: 'auth',

  components: {
    Card
  },

  computed: {
    title(){
      return this.$route.name
    }
  },

  async beforeRouteEnter(to, from, next){
    store.commit('SET_COMPANY_ID', null)
    next()
  }

}
</script>
