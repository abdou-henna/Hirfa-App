import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import SingUpVue from '@/views/SingUp.vue'
import LogInVue from '@/views/LogIn.vue'
import CraftsMan from '@/views/CraftsMan.vue'
import CraftsMen from '@/views/CraftsMen.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/login',
      name: 'login',
      component: LogInVue
    },
    {
      path: '/singup',
      name: 'singup',
      component: SingUpVue
    },
    {
      path: '/craftsman',
      name: 'craftsman',
      component: CraftsMan
    },
    {
      path: '/craftsmen',
      name: 'craftsmen',
      component: CraftsMen
    },
  ]
})

export default router
