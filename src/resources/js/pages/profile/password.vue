<template>
  <card :title="$t('user.your_password')">
    <my-form method="patch"
             :url="url"
             :reset="true"
             :inputs="inputs">
    </my-form>
  </card>
</template>

<script>
import Card from "~/components/Card";
import MyForm from "~/components/form/MyForm";

export default {
  scrollToTop: false,
  components: {
    MyForm,
    Card
  },

  computed: {
    url: _ => '/api/profile/update-password',
    inputs: _ => [
      {name: 'password', type: 'password'},
      {name: 'password_confirmation', type: 'password'},
    ]
  },
}
</script>
