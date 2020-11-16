<template>
  <nav aria-label="breadcrumb" v-if="breadcrumbs.length">
    <ol class="breadcrumb">
      <li v-for="({name, translate}, key) in breadcrumbs"
          :key="key"
          class="breadcrumb-item">
        <router-link :to="{name}">{{ translate }}</router-link>
      </li>
      <li class="breadcrumb-item" >
        <span>{{ current_route.translate }}</span>
      </li>
    </ol>
  </nav>
</template>

<script>
export default {
name: "Breadcrumbs",

  data(){
    return {
      current_route: null
    }
  },

  computed: {
    breadcrumbs() {
      const links = []
      const matched = this.$route.matched.map( ({name, parent}) => { return {name, parent} } )
      const route_length = matched.length;
      const current = matched[route_length - 1];

      if (!current || !current.name) return []

      this.current_route = current;
      this.current_route.translate = this.$t(`breadcrumb.${current.name.replace('.', '-')}`);

      let match = matched.pop();

      while (match.parent) {
        links.push(match.parent)
        match = matched.pop();
      }

      if(!links.length)
        return []
      if(links[0].name === current.name)
        links.shift()

      return links.reverse().map(breadcrumb => {
          breadcrumb.translate = this.$t(`breadcrumb.${breadcrumb.name.replace('.', '-')}`)
          return breadcrumb
        }
      )
    }
  }

}
</script>

<style scoped>

</style>
