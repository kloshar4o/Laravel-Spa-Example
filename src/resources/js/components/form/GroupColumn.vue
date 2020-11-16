<template>
  <div class="form-group row">
    <label class="col-md-3 col-form-label text-md-right"
           role="button"
           :for="for_computed">
      {{ label_text }}
    </label>
    <div class="pl-0 col-md-7">
      <slot></slot>
    </div>
  </div>
</template>

<script>

export default {
  name: "GroupColumn",
  props: {
    name: {type: String, default: null},
    label: {type: String, default: null},
    for: {type: String, default: null},
  },
  computed: {
    label_text() {
      return this.label ? this.label : this.name ? this.$t(`input.${this.name}`) : null;
    },
    for_computed() {
      return this.for || this.name || null;
    }
  }
}

</script>

<style scoped>

</style>
