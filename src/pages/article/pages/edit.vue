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


			}
		}
	}
</script>



