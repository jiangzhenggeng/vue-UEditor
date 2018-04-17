import Vue from 'vue'
import App from './app.vue'
import vueCreate from '../../../libs'

Vue.use(vueCreate)

new Vue({
	el: '#ueditorContentBox',
	render: _ => _(App)
})

