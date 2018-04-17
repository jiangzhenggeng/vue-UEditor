<template>
  <init-editor
    name="article[message]"
    public-key="ueditorContentBox"
    :content="content"
    @editor-ready="editorReady"
  />
</template>

<script>
	import content from './content.html'

	export default {
		data() {
			return {
				content: process.env.NODE_ENV !== 'production' ? content : window.ueditorContent
			}
		},
		methods: {
			editorReady(editor) {


			}
		}
	}
</script>



