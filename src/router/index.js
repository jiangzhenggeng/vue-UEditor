import Vue from 'vue'
import VueRouter from 'vue-router'

const Edit = () => import('../pages/article/pages/edit.vue')

if (process.env['vue-router']!=='VueRouter') {
	Vue.use(VueRouter);
}

const debug = process.env.NODE_ENV !== 'production'
const router = new VueRouter({
  mode: debug ? '' : 'history',
  routes: [
    {
      path: '/admin/article/add(.*)',
      component: Edit
    },
		{
			path: '/admin/article/edit(.*)',
			component: Edit
		},
    {
      path: '*',
      redirect: '/admin/article/add.html'
    },
  ]
})

export default router
