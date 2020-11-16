<template>
  <div class="row">
    <div class="col-lg-8 m-auto">
      <card :title="$t('auth.login')">
        <my-form method="post"
                 @submit="login"
                 :url="url"
                 :success-message="$t('alert.you_are_logged_in')"
                 :inputs="inputs">
        </my-form>
      </card>
    </div>
  </div>
</template>

<script>

import Card from "~/components/Card";
import store from "~/store";
import MyForm from "~/components/form/MyForm";
import Cookies from 'js-cookie'

export default {

  middleware: 'guest',
  components: {
    MyForm,
    Card,
  },

  computed: {
    url: _ => "/api/login",
    inputs: _ => [
      {name: 'email', type: 'email'},
      {name: 'password', type: 'password'},
      {name: 'remember', type: 'checkbox'},
    ],

  },

  methods: {
    async login({data}) {
      const {token, remember} = data
      try {

        // Save the token.
        await store.dispatch('saveToken', {token, remember})

        // Fetch the user.
        await store.dispatch('setAuthUser')

        // Redirect home.
        this.redirect()

      } catch (err) {
        console.error(err.message)
      }
    },

    redirect() {
      const intendedUrl = Cookies.get('intended_url')

      if (intendedUrl) {
        Cookies.remove('intended_url')
        this.$router.push({path: intendedUrl})
      }

      const to = {};
      const {is_admin, user: {company_id}, is_client} = store.getters

      to.name = is_admin ? 'admin' : 'dashboard';

      if(is_client)
        to.params = {company_id}

      this.$router.push(to)

    }
  }
}
</script>
