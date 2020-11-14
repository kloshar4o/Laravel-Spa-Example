<template>
  <card v-if="addresses && addresses.length">

    <template v-slot:header>
      <router-link :to="{name: 'dashboard.address.add'}" class="btn btn-outline-primary">
        <fa icon="plus"/>
      </router-link>
    </template>

    <div class="row">
      <div v-for="(address, index) in addresses"
           :key="index"
           class="col-sm-6 mb-4">
        <div class="card h-100">
          <div class="card-body ">

            <h5 class="card-title ">{{ address.country }}</h5>

            <p v-for="(value, key) in address"
               :key="`${index}_${key}`"
               v-if="visible.includes(key) && value"
               class="card-text">

              <b class="key">{{ $t(`input.${key}`) }}:<br></b>
              <span class="value">{{ value }}</span>
            </p>

            <div class="text-center">
              <a @click="edit(address)" class="card-link text-primary" role="button">
                <fa icon="pen"/>
                Edit
              </a>
              <a @click="destroy(address)" class="card-link text-danger" role="button">
                <fa icon="times"/>
                Delete
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </card>
</template>

<script>

import {mapGetters} from 'vuex'
import Card from "~/components/Card";
import store from "~/store";
import router from "~/router";

export default {

  data: () => ({
    visible: [
      'city',
      'town',
      'street_address',
      'state',
      'zip',
    ]
  }),

  components: {Card},

  computed: {
    ...mapGetters({
      addresses: 'company_addresses'
    })
  },

  methods: {
    async edit(data) {
      this.$store.commit('UPDATE_COMPANY_ADDRESS', data)
      router.push({name: 'dashboard.address.edit', params: {id: data.id}})
    },
    destroy({id, company_id}) {
      store.dispatch('deleteCompanyAddress', {id, company_id})
    },
  },
  async beforeRouteEnter(to, from, next) {
    await store.dispatch('fetchCompanyAddresses', to.query.page)
    next()
  },

  async beforeRouteUpdate(to, from, next) {
    await store.dispatch('fetchCompanyAddresses', to.query.page)
    next()
  }


}
</script>
