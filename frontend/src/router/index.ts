import { createRouter, createWebHistory } from '@ionic/vue-router';
import { RouteRecordRaw } from 'vue-router';

const routes: Array<RouteRecordRaw> = [
  {
    path: '',
    redirect: '/page/messages'
  },
  {
    path: '/page/messages',
    component: () => import ('../views/MessagesPage.vue')
  },
  {
    path: '/page/create-message',
    component: () => import ('../views/CreateMessagePage.vue')
  }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

export default router
