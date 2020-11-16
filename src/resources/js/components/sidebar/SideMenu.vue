<template>

  <card :title="title" class="settings-card">
    <ul class="nav flex-column nav-pills">
      <li v-for="({name, icon}, key) in menu"
          :key="key"
          class="nav-item">
        <router-link :to="{ name }" class="nav-link" active-class="active">
          <fa :icon="icon" fixed-width/>
          {{ $t(name) }}
        </router-link>
      </li>
    </ul>
  </card>

</template>

<script>
import Card from "~/components/Card";

export default {
  name: "SideMenu",
  components: {
    Card,
  },
  props: {
    title: {type: String},
    menu: {type: Array}
  }
}
</script>

