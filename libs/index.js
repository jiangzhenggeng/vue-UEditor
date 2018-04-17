import './UEditor'
import initEditor from './vueCreate/components/init-editor'
import CreateEditor from './vueCreate/components/create-editor/create'
import Uploader from './vueCreate/components/jui-simple-uploader'
import ElementUI from 'element-ui'

const install = {
	install(Vue) {
		Vue.component(initEditor.name, initEditor)
		Vue.component(CreateEditor.name, CreateEditor)
		if (Uploader.install) {
			Uploader.install(Vue)
		}
		if (ElementUI.install) {
			ElementUI.install(Vue)
		}
	}
}

export default install















