import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/post/:id',
      name: 'post',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/OnePostView.vue')
    },
		{
		path: '/register',
		name: 'register',
		component: () => import('../views/RegisterView.vue')
		},
		{
		path: '/login',
		name: 'login',
		component: () => import('../views/LoginView.vue')
		},
		{
			path: '/submit',
			name: 'submit',
			component: () => import('../views/CreatePostView.vue')
		},
		{
			path: '/update/:id',
			name: 'update',
			component: () => import('../views/UpdateUserAccountView.vue'),
			props: true,
		},
		{
			path: '/my_Account/:id',
			name: 'userAccount',
			component: () => import('../views/IndexUserAccountView.vue'),
			props: true,
		},
		{
			path: '/edit-post/:id',
			name: 'edit-post',
			component: () => import('../views/EditPostView.vue'),
			props: true,
		}
  ]
})

export default router
