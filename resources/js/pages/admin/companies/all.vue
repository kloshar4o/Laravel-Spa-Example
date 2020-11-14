<template>
  <card v-if="companies_meta">

    <template v-slot:header>
      <router-link :to="{name: 'admin.company.add'}" class="btn btn-outline-primary">
        <fa icon="plus"/>
      </router-link>
    </template>

    <table v-if="companies && companies.length" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">{{ $t('company.company_name') }}</th>
        <th class="text-center">{{ $t('company.company_status') }}</th>
        <th></th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(company, key) in companies" :key="key">
        <th class="text-right">{{ company.id }}</th>
        <td>
          <a @click="goToCompany(company.id)" role="button"
            class="text-primary">
            {{ company.company_name }}
          </a>
        </td>
        <td class="text-center">{{ company.company_status }}</td>
        <td class="text-center">
          <fa icon="cog" class="mr-2 text-primary" @click="goToCompanySettings(company.id)" role="button"/>
          <fa icon="trash" class="text-danger" @click="destroy(company.id)" role="button"/>
        </td>
      </tr>
      </tbody>
    </table>

    <div v-else class="alert alert-warning" role="alert">
      {{ $t('alert.empty_pagination_page') }}
    </div>

    <template v-if="companies_meta" v-slot:footer>
      <div class="row align-items-center">
        <div class="col col-xs-8">
          <ul class="pagination hidden-xs my-0">
            <li class="page-item "
                v-for="({url, active, label}, key) in companies_meta.links"
                :key="key"
                :class="{active, 'disabled': !url || active}">
              <a class="page-link text-nowrap"
                 :href="url"
                 @click.prevent="goTo(url)"
                 v-html="label">
              </a>
            </li>
          </ul>
        </div>
        <div class="col col-xs-4 text-right">
          Page {{ companies_meta.current_page }} of {{ companies_meta.last_page }}
        </div>
      </div>
    </template>

  </card>
</template>

<script>

import {mapGetters} from 'vuex'
import Card from "~/components/Card";
import store from "~/store";
import router from "~/router";

export default {
  scrollToTop: true,

  components: {Card},

  methods: {
    goToCompany(id) {
      store.commit("SET_COMPANY_ID", id)
      router.push({name: 'dashboard'})
    },
    goToCompanySettings(id) {
      store.commit('SET_COMPANY_ID', id)
      router.push({name: 'dashboard.settings'})
    },
    destroy(id) {
      const page = this.getPage()
      store.dispatch('deleteCompany', {id, page})
    },
    getPage(url = location.href) {
      return new URL(url).searchParams.get('page') || 1
    },
    goTo(url) {
      const page = this.getPage(url)
      router.replace({query: {page}})
    }
  },

  computed: {
    ...mapGetters(['companies', 'companies_meta'])
  },

  async beforeRouteEnter(to, from, next) {
    await store.dispatch('fetchCompanies', to.query.page)
    next()
  },

  async beforeRouteUpdate(to, from, next) {
    await store.dispatch('fetchCompanies', to.query.page)
    next()
  },

}
</script>
