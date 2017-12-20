<style lang="less">
  @import "./components/animate";

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
	import InertVideo from './components/insert-video.vue'
	import InertImage from './components/insert-image.vue'
	import InertCard from './components/insert-card.vue'
	import InertLink from './components/insert-link.vue'
	import ProductList from './product-list'
	import tools from '../../tools'
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
				var vm = this
				this.$nextTick(() => {
					this.hidePageLoading()
				})
				this.editor = window.ueditorContentBox = editor

				//获取产品卡片数量，并在页面上显示相应信息
				this.editor.addListener("contentChange", function () {
					this.__listBox__ = this.__listBox__ || $('#editor-link-product-box')
					if (false && this.__listBox__.length <= 0) return

					var cid = ''
					var productLinkId = {}
					$(this.body).find('iframe[data-productid]').each(function () {
						cid += ',' + $(this).attr('data-cid');
						productLinkId['productLinkId' + $(this).attr('data-productid')] = $(this).attr('data-default-link-id');
					});
					cid = cid.substr(1);
					if (cid == '') {
						this.__listBox__.html('');
						return;
					}

					$.get('/admin/ajax/getproduct', {
						cardid_string: cid
					}, (replayDate) => {
						for (var i in  replayDate) {
							replayDate[i].productLinkId = productLinkId['productLinkId' + replayDate[i].id];
						}
						var tempVueTpl = new vm.constructor({
							render(createElement) {
								return createElement(ProductList, {
									props: {
										data: replayDate
									}
								})
							}
						})
						tempVueTpl.$mount()
						this.__listBox__.html(tempVueTpl.$el)
						tempVueTpl.$destroy()
					}, 'json')
				})
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