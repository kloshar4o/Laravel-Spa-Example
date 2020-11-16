import store from '~/store'

export default (to, from, next) => {
  const user = store.getters.user;

  const user_company_id = user ? user.company_id : 0
  const param_company_id = to.params.company_id

  if(!param_company_id) {

    if(!user_company_id)
      next('home')

    to.params.company_id = user_company_id
    next(to)
  }

  store.commit('SET_COMPANY_ID', param_company_id)

  next()
}
