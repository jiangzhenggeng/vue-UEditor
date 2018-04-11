<template>
  <init-editor-index
    name="article[message]"
    public-key="ueditorContentBox"
    :content="content"
    @editor-ready="editorReady"
  />
</template>

<script>
	import InitEditorIndex from '../../../components/init-editor/index'
	import content from './content.html'

	export default {
		data() {
			return {
				content: process.env.NODE_ENV !== 'production' ? content : window.ueditorContent
			}
		},
		components: {
			InitEditorIndex
		},
		methods: {
			editorReady(editor) {
				let vm = this
				editor.addListener("contentChange", function () {
					let tempDiv = document.createElement('div')
					tempDiv.innerHTML = this.getContent()
					let nodeListArray = vm.getFormatHtmlToJSON(tempDiv)
				})
			},
			getFormatHtmlToJSON(fragmentDiv) {
				fragmentDiv = fragmentDiv.childNodes
				let nodeArray = []
				let nodeAttrs = {}
				for (var i = 0; i < fragmentDiv.length; i++) {
					nodeAttrs = this.getNodeAttrs(fragmentDiv[i])
					if (fragmentDiv[i].hasChildNodes() && fragmentDiv[i].nodeType == 1) {
						nodeAttrs.children = this.getFormatHtmlToJSON(fragmentDiv[i])
						nodeArray.push(nodeAttrs)
					} else {
						nodeArray.push(nodeAttrs)
					}
				}
				return nodeArray
			},
			getNodeAttrs(node) {
				let vnode = {}
				if (node.nodeType == 1) {
					vnode.name = node.tagName
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
		}
	}
</script>



