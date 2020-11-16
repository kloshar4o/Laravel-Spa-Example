import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import {
  faUser, faUsers, faLock, faSignOutAlt, faCog, faBuilding, faChartArea, faMapMarkerAlt, faPen, faTimes, faPlus, faTrash
} from '@fortawesome/free-solid-svg-icons'

library.add(
  faUser,
  faUsers,
  faLock,
  faSignOutAlt,
  faCog,
  faBuilding,
  faChartArea,
  faMapMarkerAlt,
  faPen,
  faTimes,
  faPlus,
  faTrash,
)

Vue.component('Fa', FontAwesomeIcon)
