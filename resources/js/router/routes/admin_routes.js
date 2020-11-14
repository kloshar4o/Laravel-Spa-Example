import admin_index from "~/pages/admin/index";
import admin_overview from "~/pages/admin/overview";

//Users
import admin_users from "~/pages/admin/users/all";
import admin_users_add from "~/pages/admin/users/add";
import admin_users_edit from "~/pages/admin/users/edit";

//Companies
import admin_companies from "~/pages/admin/companies/all";
import admin_companies_add from "~/pages/admin/companies/add";

import dashboard_routes from "~/router/routes/dashboard_routes";


const admin_routes = [
  {
    path: '/admin',
    name: 'admin',
    component: admin_index,
    redirect: {name: 'admin.overview'},
    children: [
      {path: 'overview', name: 'admin.overview', component: admin_overview},

      //Users
      {path: 'users', name: 'admin.users', component: admin_users},
      {path: 'users/add/', name: 'admin.user.add', component: admin_users_add},
      {path: 'users/edit/:id', name: 'admin.user.edit', component: admin_users_edit},

      //Companies
      {path: 'companies', name: 'admin.companies', component: admin_companies},
      {path: 'companies/add/', name: 'admin.company.add', component: admin_companies_add},

      //dashboard
      ...dashboard_routes

    ]
  },
]

export default admin_routes
