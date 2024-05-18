import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import SingUpVue from '@/views/SingUp.vue'
import SingUppVue from '@/views/SingUpp.vue'
import LogInVue from '@/views/LogIn.vue'
import CraftsMan from '@/views/CraftsMan.vue'
import CraftsMen from '@/views/CraftsMen.vue'
import Message from '@/views/Message.vue'
import PostItem from '@/views/PostItem.vue'
import ProjectDetails from '@/views/ProjectDetails.vue'
import CraftsManSettings from '@/views/CraftsManSettings.vue'
import CustomerDash from '@/views/CustomerDash.vue'
import PoliciesAndTerms from '@/views/PoliciesAndTerms.vue'
import AdminDashboard from '@/views/AdminDashboard.vue'
import CraftsManProfile from '@/views/CraftsManProfile.vue'
import NotFound from '@/components/NotFound.vue'

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
      path: '/singupp',
      name: 'singupp',
      component: SingUppVue
    },
    {
      path: '/craftsman',
      name: 'craftsman',
      component: CraftsMan
    },
    {
      path: '/craftsmanprofile/:id',
      name: 'craftsmanprofile',
      component: CraftsManProfile,
      props: true,
    },
    {
      path: '/craftsmen',
      name: 'craftsmen',
      component: CraftsMen
    },
    {
      path: '/message',
      name: 'message',
      component: Message
    },
    {
      path: '/postes',
      name: 'postes',
      component: PostItem
    },
    {
      path: '/projectdetails',
      name: 'projectdetails',
      component: ProjectDetails
    },
    {
      path: '/craftsmansettings',
      name: 'craftsmansettings',
      component: CraftsManSettings,
    },
    {
      path: '/CustomerDash',
      name: 'CustomerDash',
      component: CustomerDash,
    },
    {
      path: '/policiesandterms',
      name: 'policiesandterms',
      component: PoliciesAndTerms,
    },
    {
      path: '/admindashboard',
      name: 'admindashboard',
      component: AdminDashboard,
    },
    {
      path: '/:catchAll(.*)',
      name: 'NotFound',
      component: NotFound,
    },
  ]
})

export default router
