<template>
  <div class="card">
    <div v-if="computed_title" class="card-header d-flex align-items-center justify-content-between">
      {{ computed_title }}

      <slot name="header"></slot>
    </div>

    <div class="card-body">
      <slot />
    </div>

    <div v-if="$slots.footer" class="card-footer">
      <slot name="footer"></slot>
    </div>

  </div>
</template>

<script>
export default {
  name: 'Card',

  props: {
    title: { type: String, default: null },
  },

  computed: {
    route_title(){ return  this.$route.name},
    computed_title(){ return this.title || this.$t(this.route_title) }
  }
}
</script>
