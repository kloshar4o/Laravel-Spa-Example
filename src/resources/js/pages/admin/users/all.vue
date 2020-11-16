<template>
  <card v-if="users_meta">

    <template v-slot:header>
      <router-link :to="{name: 'admin.user.add'}" class="btn btn-outline-primary">
        <fa icon="plus"/>
      </router-link>
    </template>

    <table v-if="users && users.length" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">{{ $t('user.first_name') }}</th>
        <th class="text-center">{{ $t('user.last_name') }}</th>
        <th class="text-center">{{ $t('user.email') }}</th>
        <th></th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(user, key) in users" :key="key">
        <th class="text-right">{{ user.id }}</th>
        <td>{{ user.first_name }}</td>
        <td>{{ user.last_name }}</td>
        <td>{{ user.email }}</td>
        <td class="text-center">
          <router-link :to="companyLink(user.company_id)">
            <fa icon="building" class="mr-2 text-primary"/>
          </router-link>
          <fa icon="pen" class="mr-2 text-primary" @click="edit(user)" role="button"/>
          <fa icon="trash" class="text-danger" @click="destroy(user.id)" role="button"/>
        </td>
      </tr>
      </tbody>
    </table>

    <div v-else class="alert alert-warning" role="alert">
      {{ $t('alert.empty_pagination_page') }}
    </div>

    <template v-if="users_meta" v-slot:footer>
      <div class="row align-items-center">
        <div class="col col-xs-8">
          <ul class="pagination hidden-xs my-0">
            <li class="page-item "
                v-for="({url, active, label}, key) in users_meta.links"
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
          Page {{ users_meta.current_page }} of {{ users_meta.last_page }}
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
    edit(data) {
      store.commit('UPDATE_USER_EDIT', data)
      router.push({name: 'admin.user.edit', params: {id: data.id}})
    },
    destroy(id) {
      const page = this.getPage()
      store.dispatch('deleteUser', {id, page})
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
    companyLink() {
      return company_id => ({name: 'dashboard.users', params: {company_id}})
    },
    ...mapGetters(['users', 'users_meta'])
  },

  async beforeRouteEnter(to, from, next) {
    await store.dispatch('fetchUsers', to.query.page)
    next()
  },

  async beforeRouteUpdate(to, from, next) {
    await store.dispatch('fetchUsers', to.query.page)
    next()
  },

}
</script>
