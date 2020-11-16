import profile from "~/pages/profile/index";
import settings from "~/pages/profile/settings";
import password from "~/pages/profile/password";

const profile_routes = [
  {
    path: '/profile',
    name: 'profile',
    component: profile,
    redirect: {name: 'profile.settings'},
    children: [
      {path: 'settings', name: 'profile.settings', component: settings},
      {path: 'password', name: 'profile.password', component: password},
    ]
  },
]

export default profile_routes
