<template>
  <card class="text-center">
    <h3 class="mb-4">
      {{ $t('404.page_not_found') }}
    </h3>

    <div class="links">
      <router-link :to="{ name: 'home' }">
        {{ $t('404.go_home') }}
      </router-link>
    </div>
  </card>
</template>

<script>
import Card from "~/components/Card";

export default {
  name: 'NotFound',
  components: {
    Card
  }
}
</script>
