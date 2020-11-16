<template>
  <div class="main-layout">
    <navbar/>

    <div class="container mt-4">
      <breadcrumbs/>

      <child/>
    </div>
  </div>
</template>

<script>
import Navbar from '~/components/header/Navbar'
import Child from '~/components/Child'
import Breadcrumbs from "~/components/header/Breadcrumbs";

export default {
  name: 'defaultLayout',

  components:
    {
      Navbar,
      Child,
      Breadcrumbs
    },

}
</script>
