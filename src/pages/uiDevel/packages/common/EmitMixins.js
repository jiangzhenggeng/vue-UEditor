function broadcast(componentName, eventName, params) {
	this.$children.forEach((child) => {
		if (child.$options.componentName == componentName) {
			child.$emit.apply(child, [eventName, params])
		} else {
			broadcast.apply(child, [componentName, eventName, params])
		}
	})
}

export default {
	methods: {
		broadcast(componentName, eventName, params) {
			broadcast.apply(this, [componentName, eventName, params])
		},
		dispatch(componentName, eventName, params) {
			var parent = this.$parent || this.$root
			var name = parent.$options.componentName
			while (parent && (!name || name != componentName)) {
				parent = parent.$parent || parent.$root
				if (parent) {
					name = parent.$options.componentName;
				}
			}
			parent && parent.$emit.apply(parent, [eventName, params])
		}
	}
}