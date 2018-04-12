export function getFormatHtmlToJSON(fragmentDiv) {
	fragmentDiv = fragmentDiv.childNodes
	let nodeArray = []
	let nodeAttrs = {}
	for (var i = 0; i < fragmentDiv.length; i++) {
		nodeAttrs = getNodeAttrs(fragmentDiv[i])
		if (fragmentDiv[i].hasChildNodes() && fragmentDiv[i].nodeType == 1) {
			nodeAttrs.children = getFormatHtmlToJSON(fragmentDiv[i])
			nodeArray.push(nodeAttrs)
		} else {
			nodeArray.push(nodeAttrs)
		}
	}
	return nodeArray
}

export function getNodeAttrs(node) {
	let vnode = {}
	if (node.nodeType == 1) {
		vnode.name = node.tagName.toLowerCase()
		vnode.type = 'node'
		if (node.hasAttributes()) {
			vnode.attrs = {}
			let attrs = node.attributes
			for (let i = attrs.length - 1; i >= 0; i--) {
				vnode.attrs[attrs[i].name] = attrs[i].value || ''
			}
		}
	} else if (node.nodeType == 3) {
		vnode.type = 'text'
		vnode.text = node.nodeValue
	}
	return vnode
}