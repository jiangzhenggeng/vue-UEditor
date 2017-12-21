import Vue from 'vue'
import App from './app.vue'
import router from './router'
import packages from './packages'

Vue.use(packages)

new Vue({
	el: '#app',
	render: _ => _(App),
	router
})

