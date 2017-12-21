import Vue from 'vue'
import VueRouter from 'vue-router'

const Select = () => import('../pages/select.vue')

if (process.env['vue-router']!=='VueRouter') {
	Vue.use(VueRouter);
}

const debug = process.env.NODE_ENV !== 'production'
const router = new VueRouter({
	mode: debug ? '' : 'history',
	routes: [
		{
			path: '/select(.*)',
			component: Select
		},
		{
			path: '*',
			redirect: '/select'
		},
	]
})

export default router










