<style lang="less">
  @import "../components/animate";

  .editor__wrap {
    width: 850px;
    margin: auto;
  }
</style>

<template>
  <div class="editor__wrap">
    <create-editor
      @editor-ready="editorReady"
      @trigger:click:event="TriggerClickEvent"
      :content="content"
      name="article[message]"
    />
    <inert-video
      :visibile.sync="InsertVideoVisibile"
      @insert:html="InsertHtml"
    />
    <inert-image
      :visibile.sync="InsertImageVisibile"
      @insert:html="InsertHtml"
    />
    <inert-card
      :visibile.sync="InsertCardVisibile"
      @insert:html="InsertHtml"
    />
    <inert-link
      :visibile.sync="InsertLinkVisibile"
      @insert:html="InsertHtml"
    />
  </div>
</template>

<script>

	import {mapState, mapActions} from 'vuex'
	import InertVideo from '../components/insert-video.vue'
	import InertImage from '../components/insert-image.vue'
	import InertCard from '../components/insert-card.vue'
	import InertLink from '../components/insert-link.vue'
  import $ from 'jquery'

	export default {
		data() {
			return {
				InsertVideoVisibile: false,
				InsertImageVisibile: false,
				InsertCardVisibile: false,
				InsertLinkVisibile: false,
				content: window.ueditorContent || ''
			}
		},
		components: {
			InertVideo,
			InertImage,
			InertCard,
			InertLink
		},
		methods: {
			editorReady(editor) {
				this.$nextTick(() => {
					this.hidePageLoading()
				})
				this.editor = editor
			},
			TriggerClickEvent(eventType) {
				switch (eventType) {
					case 'insert_video': {
						this.InsertVideoVisibile = true
						break
					}
					case 'insert_image': {
						this.InsertImageVisibile = true
						break
					}
					case 'insert_card': {
						this.InsertCardVisibile = true
						break
					}
					case 'new_link': {
						this.InsertLinkVisibile = true
						break
					}
				}
			},
			InsertHtml(html, callBack) {
				if (typeof callBack == 'function') {
					if (callBack(this.editor)) {
						this.editor.execCommand('inserthtml', html)
					}
				} else {
					this.editor.execCommand('inserthtml', html)
				}
			},
			...mapActions(['hidePageLoading'])
		}
	}
</script>



