import Select from '../../components/select/select'
import Option from '../../components/select/option'
import Group from '../../components/select/group'

Select.install = function (Vue, options) {
	Vue.component('Ui' + Select.name, Select)
	Vue.component('Ui' + Option.name, Option)
	Vue.component('Ui' + Group.name, Group)
}
export default Select


