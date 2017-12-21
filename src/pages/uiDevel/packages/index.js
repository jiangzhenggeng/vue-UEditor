import Select from './moduls/select/index'

const components = [
	Select
]

function install(Vue, options) {
	components.forEach((component) => {
		component.install(Vue, options)
	})
}

export default {
	install,
	versions: '0.1.0'
}













