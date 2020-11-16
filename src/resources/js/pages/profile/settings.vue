<template>
  <card :title="$t('user.your_info')">
    <my-form :data="user"
             method="patch"
             :url="url"
             @submit="update"
             :inputs="inputs">
    </my-form>
  </card>
</template>

<script>
import {mapGetters} from 'vuex';
import Card from "~/components/Card";
import store from "~/store";
import MyForm from "~/components/form/MyForm";

export default {
  scrollToTop: false,
  components: {
    MyForm,
    Card
  },

  computed: {
    url: _=> '/api/profile/update-info',
    inputs: _ => [
      {name: 'first_name', type: 'text'},
      {name: 'last_name', type: 'text'},
      {name: 'email', type: 'email'},
    ],
    ...mapGetters(['user'])
  },

  methods: {
    update({data}) {
      this.$store.commit('SET_USER', data)
    }
  },

  beforeRouteEnter(to, from, next) {
    store.dispatch('setAuthUser')
      .then(_ => next());
  },

}
</script>
