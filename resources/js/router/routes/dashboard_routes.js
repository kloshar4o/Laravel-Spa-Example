import dashboard_index from "~/pages/dashboard/index";
import dashboard_overview from "~/pages/dashboard/overview";
import dashboard_settings from "~/pages/dashboard/settings";

//Users
import dashboard_users from "~/pages/dashboard/users/all";
import dashboard_users_add from "~/pages/dashboard/users/add";
import dashboard_users_edit from "~/pages/dashboard/users/edit";

//Users
import dashboard_addresses from "~/pages/dashboard/addresses/all";
import dashboard_addresses_add from "~/pages/dashboard/addresses/add";
import dashboard_addresses_edit from "~/pages/dashboard/addresses/edit";

const dashboard_routes = [
  {
    path: '/dashboard',
    name: 'dashboard',
    component: dashboard_index,
    redirect: {name: 'dashboard.overview'},
    children: [
      {path: 'overview', name: 'dashboard.overview', component: dashboard_overview},
      {path: 'settings', name: 'dashboard.settings', component: dashboard_settings},

      //Users
      {path: 'users', name: 'dashboard.users', component: dashboard_users},
      {path: 'users/add/', name: 'dashboard.user.add', component: dashboard_users_add},
      {path: 'users/edit/:id', name: 'dashboard.user.edit', component: dashboard_users_edit},

      //Addresses
      {path: 'addresses', name: 'dashboard.addresses', component: dashboard_addresses},
      {path: 'addresses/add/', name: 'dashboard.address.add', component: dashboard_addresses_add},
      {path: 'addresses/edit/:id', name: 'dashboard.address.edit', component: dashboard_addresses_edit},
    ]
  },
]

export default dashboard_routes
