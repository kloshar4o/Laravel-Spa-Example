import Vuex from 'vuex'
import Vue from 'vue'

import global from './global'
import auth from './auth'

//Admin
import users from './modules/admin/users'
import companies from "~/store/modules/admin/companies";

//Client
import company from './modules/company/company'
import company_user from './modules/company/company-user'
import company_address from './modules/company/company-address'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules:  {
    global,
    auth,

    //Admin
    users,
    companies,

    //Client
    company,
    company_user,
    company_address,
  }
})

export default store
