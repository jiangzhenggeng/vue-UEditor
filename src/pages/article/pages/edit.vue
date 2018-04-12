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
	import {flatProcessing} from '../../../common/flatProcessing'
	import {getFormatHtmlToJSON} from '../../../common/getFormatHtmlToJSON'
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
				editor.addListener("contentChange", function () {
					let tempDiv = document.createElement('div')
					tempDiv.innerHTML = this.getContent()
					let nodeListArray = flatProcessing(getFormatHtmlToJSON(tempDiv))
					console.log(nodeListArray)
				})
			}
		}
	}
</script>



