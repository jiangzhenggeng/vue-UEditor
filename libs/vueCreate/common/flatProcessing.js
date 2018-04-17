export function flatProcessing(nodeListArray) {
	let flatProcessingArray = []
	nodeListArray.forEach((node) => {
		if (node.children) {
			let flatProcessingArraySun = []
			let flatProcessingTextStr = undefined
			flatProcessingChildren(node.children).forEach((subNode) => {
				if (subNode.type == 'txt') {
					flatProcessingTextStr = (flatProcessingTextStr || '') + subNode.content
				} else {
					if (flatProcessingTextStr !== undefined) {
						flatProcessingArraySun.push({
							type: 'txt',
							content: flatProcessingTextStr || '',
						})
					}
					flatProcessingArraySun.push(subNode)
					flatProcessingTextStr = undefined
				}
			})
			if (flatProcessingTextStr !== undefined) {
				flatProcessingArraySun.push({
					type: 'txt',
					content: flatProcessingTextStr || '',
				})
			}
			flatProcessingTextStr = undefined

			flatProcessingArray = flatProcessingArray.concat(flatProcessingArraySun)
		} else {
			flatProcessingArray.push(flatProcessingChildren([node]))
		}
	})
	return flatProcessingArray
}

//扁平化处理
export function flatProcessingChildren(nodeListArray) {
	let flatProcessingArray = []
	nodeListArray.forEach((node) => {
		//有子元素
		if (node.children && ({}).toString.call(node.children) === '[object Array]') {
			flatProcessingArray = flatProcessingArray.concat(flatProcessingChildren(node.children))
		}
		//标签
		else if (node.type == 'node') {
			//图片
			if (
				node.name == 'img' &&
				typeof node.attrs == 'object' &&
				node.attrs.src
			) {
				flatProcessingArray.push({
					type: 'img',
					content: node.attrs.src || '',
					height: node.attrs['data-height'] || '',
					width: node.attrs['data-width'] || '',
				})
			}
			//换行
			else if (node.name == 'br') {
				flatProcessingArray.push({
					type: 'br',
					content: ''
				})
			}
			//空标签<p></p> 或者 <div></div>等
			else if (node.name) {
				flatProcessingArray.push({
					type: 'br',
					content: ''
				})
			}
		}
		//文本
		else if (node.type == 'text') {
			flatProcessingArray.push({
				type: 'txt',
				content: node.text || '',
			})
		}
	})

	return flatProcessingArray
}