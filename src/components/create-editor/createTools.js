import $ from 'jquery'
import tools from '../../tools'

export function createId() {
	return 'id-' + (new Date().getTime()) + '' + (Math.random() + '').replace('.', '')
}

export function editorAddEventListener(vm, editor) {

	editor.addListener("beforepaste", function (type, html) {
		//过滤多余的空标签
		var content = html.html;
		content = content.replace(/<p[^>]*><\/p>/ig, '')
			.replace(/<p[^>]*><br[^>]*\/><\/p>/ig, '')
			.replace(/<p[^>]*><span[^>]*><\/span><\/p>/ig, '')
			.replace(/<p[^>]*><span[^>]*><br[^>]*\/><\/span><\/p>/ig, '')
		html.html = content;
	});

	var checkImageStyleId = createId()
	editor.addListener("afterpaste", function () {
		//检查图片地址合法性
		//如果不合法就加上红色的边框
		if (!$(this.document).find('#' + checkImageStyleId).length) {
			$(this.document).find('head').append('<style id="' + checkImageStyleId + '">.edui-image-not-jiguo-zdm-addr{box-shadow: 0 0 0px 8px red;}</style>');
		}
		$(this.body).find('img[src]').each(function () {
			var src = $(this).attr('src')
			//出去视频图片地址
			if (
				$(this).hasClass('edui-faked-video') ||
				//自己服务器绝对地址
				(src.substr(0, 1) == '/' && src != '//') ||
				//自己服务器相对地址
				(src.substr(0, 8) != 'https://' && src.substr(0, 7) != 'http://')
			) {
				return
			}
			//打上红色边框
			if ($(this).attr('src').indexOf('s1.jiguo.com') === -1) {
				$(this).addClass('edui-image-not-jiguo-zdm-addr');
			}
		});
	});

	var ContentChangeDebounce = tools.debounce(() => {
		editor.sync()
	}, 800)

	editor.addListener("contentChange", function () {
		ContentChangeDebounce()
	})

}

export function editorReady(vm, editor) {
	vm.$emit('editor-ready', vm.editor = editor)
	vm.content && editor.setContent(vm.content)
	vm['EditorWrap'] = $(vm.$refs['editor__wrap'])
	vm['EditorWrap'].offsetTop = vm['EditorWrap'].offset().top
	vm['ToolBarWrap'] = vm['EditorWrap'].find('.edui-editor-toolbarbox-position:first')
	vm['ToolBarBox'] = vm['ToolBarWrap'].find('.edui-editor-toolbarbox:first')
	vm['ToolBarInner'] = vm['ToolBarWrap'].find('.edui-editor-toolbarbox-inner:first')
	editorRefresh(vm, editor)
	editorBindScrollFun(vm, editor)

	var resizeFn = tools.debounce(() => {
		editorRefresh(vm, editor)
	})
	$(window).resize(function () {
		resizeFn()
	})
}

export function editorRefresh(vm, editor) {
	if (editor.fullScreen) {
		$('html').addClass('editor-full-screen')
		editor.setHeight($(window).height() - 60)
	} else {
		$('html').removeClass('editor-full-screen')
		if (!editorRefresh.first) {
			$(window).scrollTop(vm['EditorWrap'].offsetTop - $(window).height() / 2)
		}
		editor.setAutoHeight()
	}
	delete editorRefresh.first
	editorBindScrollFun(vm, editor)
}

editorRefresh.first = true

//浏览器滚动固定导航栏逻辑
export function editorBindScrollFun(vm, editor) {
	if (!vm['ToolBarBox'] || !vm['ToolBarBox'].length) {
		return
	}
	if (editor.fullScreen) {
		vm['EditorWrap'].addClass('full__screen')
		vm['ToolBarInner'].css({
			width: vm['ToolBarWrap'].width()
		})
		vm['ToolBarBox'].css({
			position: 'fixed',
			left: 0,
			top: 0,
			width: '100%'
		})
	} else {
		vm['EditorWrap'].removeClass('full__screen')
		var scrollTop = $(window).scrollTop()
		var offset = vm['EditorWrap'].offset()
		if (scrollTop >= offset.top) {
			vm['ToolBarBox'].css({
				position: 'fixed',
				left: vm['ToolBarWrap'].offset().left,
				top: 0,
				width: vm['ToolBarInner'].width()
			})
			var posFix = scrollTop - offset.top - vm['EditorWrap'].height() + 60
			if (posFix >= 0) {
				vm['ToolBarBox'].css({
					top: -(posFix > 60 ? 60 : posFix)
				})
			}
		} else {
			vm['ToolBarBox'].removeAttr('style')
		}
	}
}

//hover tool bar text tips
import EditorRoowUp from './icon/editor_roow.svg'
import EditorRoowDown from './icon/editor_roow2.svg'

export function editorBindToolBarTips(vm, editor) {
	var EditorToolsTips = $('#' + vm.editorId + '-tools-tips')
	var EditorToolsTipsText = EditorToolsTips.find('.editor__tools-tips-text')
	if (EditorToolsTips.length <= 0) {
		$('body').append(`
			<div id="${vm.editorId}-tools-tips" class="editor__tools-tips-wrap">
				<div class="editor__tools-tips-text"></div>
				<img class="editor__tools-tips-roow" src="${EditorRoowUp}" />
				<img class="editor__tools-tips-roow editor__tools-tips-roow2" src="${EditorRoowDown}" />
			</div>`
		);
		EditorToolsTips = $('#' + vm.editorId + '-tools-tips')
		EditorToolsTipsText = EditorToolsTips.find('.editor__tools-tips-text')
	}

	//hover提示
	vm['ToolBarWrap'].on('mouseenter.editor', '.edui-button-body,.edui-arrow', function () {
		var title = $(this).attr('data-title')
		EditorToolsTipsText.html(title);
		var offset = $(this).offset();
		var tips_w = EditorToolsTips.outerWidth()
		var tips_h = EditorToolsTips.outerHeight()
		var scrollTop = $(window).scrollTop()
		EditorToolsTips.hide()
		if (offset.top - 40 <= scrollTop) {
			EditorToolsTips.addClass('editor__tools-arrow-down').css({
				left: offset.left - (tips_w / 2) + 20,
				top: offset.top + tips_h + 18,
			});
		} else {
			EditorToolsTips.removeClass('editor__tools-arrow-down').css({
				left: offset.left - (tips_w / 2) + 20,
				top: offset.top - tips_h - 8,
			});
		}
		EditorToolsTips.stop(true, false).fadeIn(260)

	}).on('mouseleave.editor', '.edui-button-body,.edui-arrow', function () {
		EditorToolsTips.stop(true, false).fadeOut(260)
	});
}