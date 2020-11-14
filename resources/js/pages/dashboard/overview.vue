<template>
  <card :title="company.company_name">
    Overview...
  </card>
</template>

<script>

import Card from "~/components/Card";
import {mapGetters} from "vuex";
export default {

  middleware: 'auth',

  components: {
    Card
  },

  computed: {
    ...mapGetters(['company'])
  },
}
</script>
