<template>
  <div id="app" class="before_disabled" :class="{'disabled': axios_loading}">
    <loading ref="loading"/>
    <transition name="page" mode="out-in">
      <component :is="layout" v-if="layout"/>
    </transition>
  </div>
</template>

<script>
import {mapGetters} from 'vuex'
import Loading from '~/components/header/Loading'
import defaultLayout from '~/layouts/defaultLayout'
import centeredLayout from "~/layouts/centeredLayout";


const layouts = {
  defaultLayout,
  centeredLayout,
}

export default {
  name: "App",
  el: '#app',

  components: {
    Loading
  },

  data: () => ({
    layout: null,
    defaultLayout: 'defaultLayout',
    app_name: window.config.app_name
  }),


  computed: {
    ...mapGetters(['axios_loading'])
  },

  metaInfo() {
    return {
      title: this.$t(this.$route.name) + ' ' + this.app_name
    }
  },

  mounted() {
    this.$loading = this.$refs.loading
  },

  methods: {
    setLayout(layout) {
      if (!layout || !layouts[layout]) {
        layout = this.defaultLayout
      }

      this.layout = layouts[layout]
    }
  }
}
</script>
