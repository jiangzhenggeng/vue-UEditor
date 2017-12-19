<script src="<?php echo CDN;?>js/laydate/laydate.js"></script>
<script src="<?php echo CDN;?>js/select.js"></script>
<script src="<?php echo CDN;?>js/index.js"></script>
<script src="<?php echo CDN;?>js/product_comment.js"></script>


<script>
	/*********************
	 日历时间选择器
	 *********************/
	setTimeSelect();
	/*********************
	 模拟select
	 *********************/
	dataZselectBind($('[data-Z-select]'));

	function initUploadBtn(Dom,fileid,input_name,rot){

		function getWidth (o){
			return o.style.width || o.clientWidth || o.offsetWidth || o.scrollWidth || 0;
		}

		function getHeight (o){
			return o.style.height || o.clientHeight || o.offsetHeight || o.scrollHeight || 0;
		}
		var uploadUrl = window.FILE_UPLOAD_URL+'&action=uploadimage',
			imageFieldName = 'upfile',
			w =  getWidth(Dom) || 20,
			h =  getHeight(Dom) || 20,
			btnIframe = document.createElement('iframe'),
			btnStyle = 'display:block;width:' + w + 'px;height:' + h + 'px;overflow:hidden;border:0;margin:0;padding:0;position:absolute;top:0;left:0;filter:alpha(opacity=0);-moz-opacity:0;-khtml-opacity: 0;opacity: 0;cursor:pointer;';
		// console.log(h);
		// console.log(document.getElementById('file'));
		$(btnIframe).on('load', function(){

			var timestrap = (+new Date()).toString(36),
				wrapper,
				btnIframeDoc,
				btnIframeBody;

			btnIframeDoc = (btnIframe.contentDocument || btnIframe.contentWindow.document);
			btnIframeBody = btnIframeDoc.body;
			wrapper = btnIframeDoc.createElement('div');

			wrapper.innerHTML = '<form id="edui_form_' + timestrap + '" target="edui_iframe_' + timestrap + '" method="POST" enctype="multipart/form-data" action="' + uploadUrl + '" ' +
				'style="' + btnStyle + '">' +
				'<input id="edui_input_' + timestrap + '" type="file" accept="image/jpg,image/jpeg,image/png,image/gif" name="' + imageFieldName + '" ' +
				'style="' + btnStyle + '">' +
				'</form>' +
				'<iframe id="edui_iframe_' + timestrap + '" name="edui_iframe_' + timestrap + '" style="display:none;width:0;height:0;border:0;margin:0;padding:0;position:absolute;"></iframe>';

			wrapper.className = 'edui-';
			wrapper.id = '_iframeupload';
			btnIframeBody.style.cssText = btnStyle;
			btnIframeBody.style.width = w + 'px';
			btnIframeBody.style.height = h + 'px';
			btnIframeBody.appendChild(wrapper);

			if (btnIframeBody.parentNode) {
				btnIframeBody.parentNode.style.width = w + 'px';
				btnIframeBody.parentNode.style.height = w + 'px';
			}

			var form = btnIframeDoc.getElementById('edui_form_' + timestrap);
			var input = btnIframeDoc.getElementById('edui_input_' + timestrap);
			var iframe = btnIframeDoc.getElementById('edui_iframe_' + timestrap);

			$(input).on('change', function(){
				if(!input.value) return;
				var loadingId = 'loading_' + (+new Date()).toString(36);

				input.focus();

				function callback(){
					var link, json, loader,
						body = (iframe.contentDocument || iframe.contentWindow.document).body,
						result = body.innerText || body.textContent || '';

					json = (new Function("return " + result))();
//                    console.log( json )
					json.fileid = json.url.match(/https?:\/\/s1\.jiguo\.com\/([\w\-]+)\/?/i)[1];
					imgs = '<img src="'+json.url+'" />' +
						'<input name="'+input_name+'" value="'+json.fileid+'" type="hidden" />' +
						'<div class="setting-query-wrap">' +
						'<div class="cropper" data-aspect-ratio="'+(rot||1.5)+'">裁剪</div>' +
						'</div>';

					if('file'==fileid){
						//imgs += '<div class="Z-small-fenmian"><img src="'+json.url+'" /></div>';
					}

					$('#'+fileid+'-temp').show().html(imgs);
					form.reset();
					$(iframe).off('load', callback);
				}

				$('#'+fileid+'-temp').show().html('<img style="margin-top: 70px;" src="http://cdn.jiguo.com/p1/i/loading-icon.gif" />');

				$(iframe).on('load', callback);
				form.action = uploadUrl;
				form.submit();
			});
		});
		btnIframe.style.cssText = btnStyle;
		Dom.appendChild(btnIframe);
	}
	//封面图上传
	if( document.getElementById('file') ){
		initUploadBtn(document.getElementById('file'),'file','article[cover]',2);
	}
	if( document.getElementById('banner') ){
		initUploadBtn(document.getElementById('banner'),'banner','article[banner]',2);
	}
</script>

<link href="<?php echo CDN;?>js/cropper/cropper.css" rel="stylesheet" />
<script src="<?php echo CDN;?>js/cropper/cropper.js"></script>
<script>
	$('body').on('click','.cropper',function () {
		cropperImage($(this).closest('li').find('img:first'), {
			aspectRatio: $(this).data('aspect-ratio'),
			aspectType: $(this).data('aspect-type')
		});
	});
</script>
<script src="http://cdn.jiguo.com/static@2.0/permanent/vuejs/vue-2.5.3/dist/vue.runtime.min.js"></script>
<script src="http://cdn.jiguo.com/static@2.0/permanent/vuex/vuex-3.0.0/dist/vuex.min.js"></script>
<script src="http://cdn.jiguo.com/static@2.0/permanent/vue-router/vue-router-3.0.1/dist/vue-router.min.js"></script>

