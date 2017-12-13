<link rel="stylesheet" type="text/css" href="<?php echo CDN;?>css/index.css" xmlns="http://www.w3.org/1999/html"/>
<link rel="stylesheet" type="text/css" href="<?php echo CDN;?>css/article.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo CDN;?>css/viewMobilePage2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo CDN;?>css/score.css"/>
<script type="text/javascript" src="<?php echo CDN;?>js/viewMobilePage3.js"></script>

<!-- 主题部分 -->
<style>
    .Z-header .Z-main{ width:910px;}
    .checkbox input[type=radio]:checked:before {
        content: '\e443';
        color: #ed4f37 !important;
    }
    .checkbox input[type=radio]{
        position: relative;
        display: inline-block;
        -webkit-appearance: none;
        background-color: transparent;
        border: 0;
        outline: 0!important;
        margin-right: 5px;
        display: inline-block;
        font-family: Muiicons;
        font-size: 18px;
        font-style: normal;
        font-weight: 400;
        line-height: 1;
        text-decoration: none;
        -webkit-font-smoothing: antialiased;
        box-sizing: border-box;
    }
    .checkbox input[type=radio]:before {
        content: '\e413';
    }
    .radio2{
        margin-left: 14px;
    }
    .alert-box{
        width: auto !important;
    }
    .alert-inner{
        padding: 0 10px !important;
    }
</style>

<div class="Z-body-main">
    <div class="Z-main">
        <!-- 有侧内容 -->
        <div class="Z-content" style="margin:auto">
            <form id="formDataAjaxSend">

                <!-- 文章信息 -->
                <div class="Z-sub-main">
                    <div class="Z-info">
                        <div class="Z-title">文章信息</div>
                        <div class="Z-list-info">
                            <div class="Z-row" data-scaleplate>
                                <span class="Z-name">文章名称：</span>
                                <input class="Z-input" data-scaleplate name="article[title]" value="<?php echo $blog['title'];?>" id="A-name" placeholder="产品名称"/>
                                <input class="Z-input" name="article[id]" value="<?php echo $blog['blogid'];?>" type="hidden"/>
                                <input class="Z-input" name="article[blog_type]" value="<?php echo $_GET['blog_type'];?>" type="hidden"/>
                                <?php echo $this->renderPartial('/layouts/scaleplate'); ?>
                            </div>
                            <div class="Z-row">
                                <span class="Z-name">特色描述：</span>
                                <input class="Z-input" data-scaleplate name="article[desc]" value="<?php echo $blog['feature'];?>" placeholder="特色描述" id="desc"/>
                            </div>
                            <div class="Z-row">
                                <span class="Z-name">作者：</span>
                                <div class="Z-edit-author" onclick="editArticleAuthor(this,'<?php echo $blog['uid'];?>')">
                                    <div class="Z-edit-author-face">
                                        <img src="http://s1.jiguo.com/avatar<?php echo $blog['uid'];?>/230x230?time=<?php echo time();?>">
                                    </div>
                                    <span class="Z-edit-author-query blue">更换</span>
                                    <div class="Z-gray Z-edit-author-name"><?php echo $blog['author'];?></div>
                                    <input type="hidden" data-input-author name="article[author]" value="<?php echo $blog['author'];?>">
                                    <input type="hidden" data-input-uid name="article[uid]" value="<?php echo $blog['uid'];?>">
                                </div>
                            </div>
                            <!--<div class="Z-row label <?php echo ($blog['type']==4)?'none':''?>">
                                <span class="Z-name">标签：</span>
                                <div class="input-group" id="P-tag">
                                    <div class="input-row checkbox">
                                        <label><input class="icon" name="article[tag][]" <?php if(in_array(2,$tags)) echo 'checked';?> value="2" type="checkbox"/>最低</label>
                                    </div>
                                </div>
                            </div>-->
                            <div class="Z-row">
                                <span class="Z-name">入流：</span>
                                <div class="input-group" id="P-tag">
                                    <div class="input-row checkbox">
                                        <label><input class="icon" name="article[tag][]" <?php if(in_array(1,$tags)) echo 'checked';?> value="1" type="checkbox"/>首页精选</label>
                                    </div>
                                    <div class="experience dib <?php echo ($blog['type']==4)?'':'none'?>">
                                        <div class="input-row checkbox">
                                            <label><input class="icon select-tag" id="ex-select" name="article[tag][]" <?php if(in_array(3,$tags)) echo 'checked';?> value="3" type="checkbox"/>体验精选</label>
                                        </div>
                                        <div class="input-row checkbox">
                                            <label><input class="icon select-tag" id="ex-class" name="article[tag][]" <?php if(in_array(4,$tags)) echo 'checked';?> value="4" type="checkbox"/>体验分类</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Z-row">
                                <span class="Z-name">是否含视频:</span>
                                <div class="input-group" id="P-tag">
                                    <div class="input-row checkbox">
                                        <label><input class="icon" name="article[video]" <?php if($blog['video']==0) echo 'checked';?> value="0" type="radio">否</label>
                                    </div>
                                    <div class="input-row checkbox radio2">
                                        <label><input class="icon" name="article[video]" <?php if($blog['video']==1) echo 'checked';?> value="1" type="radio">是</label>
                                    </div>
                                </div>
                            </div>
                            <div class="Z-row">
                                <span class="Z-name">精华:</span>
                                <div class="input-group" id="P-tag">
                                    <div class="input-row checkbox">
                                        <label><input class="icon" name="article[jinghua]" <?php if($blog['jinghua']!=1) echo 'checked';?> value="0" type="radio">否</label>
                                    </div>
                                    <div class="input-row checkbox radio2">
                                        <label><input class="icon" name="article[jinghua]" <?php if($blog['jinghua']==1) echo 'checked';?> value="1" type="radio">是</label>
                                    </div>
                                </div>
                            </div>
                            <div class="Z-row">
                                <span class="Z-name">文章类型：</span>
                                <div data-Z-select class="Z-select-box" data-show-order>
                                    <input data-Z-select-value value="<?php echo $blog['type'];?>" name="article[type]" id="P-sale" type="hidden"/>
                                    <div class="Z-select-selected"><span><?php if($blog['type']==1){ echo '清单'; }else if($blog['type']==2){ echo '新品';}else if($blog['type']==4){ echo '测评';}else if($blog['type']==3){ echo '其他';}else if($blog['type']==0){ echo '折扣';}else{ echo '请选择';}?></span></div>
                                    <div class="Z-select-arrow"></div>
                                    <div class="Z-select-list">
                                        <ul data-selected-ceping>
                                            <li data-value="请选择"><span>请选择</span></li>
                                            <li data-value="0"><span>折扣</span></li>
                                            <li data-value="1"><span>清单</span></li>
                                            <li data-value="2"><span>新品</span></li>
                                            <li data-value="4"><span>测评</span></li>
                                            <li data-value="3"><span>其他</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php if(($blog['type']==4 && $blog['report_status']==3)||($blog['is_original']==1)){ ?>
                                <div class="ceping-article <?php if($blog['status']!=1 && $blog['type']!=4){ ?>none<?php } ?>">
                                    <div class="Z-row">
                                        <span class="Z-name">报告评级:</span>
                                        <div class="input-group">
                                            <div class="input-row radiobox" id="reportCheck">
                                                <label><input class="icon" id="reportScore"
                                                              name="article[displayorder]" value="1" type="radio" <?php echo ($blog['displayorder']>=0)? 'checked' : '';?>>评分</label>
                                                <label class="ml40"><input class="icon" id="needChange"
                                                                           name="article[displayorder]" value="-3" type="radio" <?php echo ($blog['displayorder']==-3)? 'checked' : '';?>>需修改</label>
                                                <?php if($blog['is_edit']==1){ ?>
                                                    <label class="ml40"><input class="icon" id="notPass"
                                                                               name="article[displayorder]" value="-4" type="radio" <?php echo ($blog['displayorder']==-4)? 'checked' : '';?>>不通过</label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="<?php if($blog['displayorder'] < 0){ ?>none<?php } ?>" id="score">
                                        <div class="report-star-box">
                                            <div class="report-star-wrap">
                                                <!--   评星模板    -->
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="not-ceping-article <?php if(!($blog['status']!=1 && $blog['type']!=4)){ ?>none<?php } ?>">
                                    <div class="Z-row">
                                        <span class="Z-name">报告状态：</span>
                                        <div data-Z-select class="Z-select-box">
                                            <input data-Z-select-value value="<?php echo $blog['displayorder'];?>" name="article[displayorder]" id="P-sale" type="hidden"/>
                                            <div class="Z-select-selected"><span>
                                    <?php
                                    if($blog['displayorder'] == 5){
                                        echo '优秀';
                                    }else if($blog['displayorder'] == 3) {
                                        echo '良好';
                                    }else if($blog['displayorder'] == 1) {
                                        echo '较差';
                                    }else if($blog['displayorder'] == 0) {
                                        echo '待审核';
                                    }else if($blog['displayorder'] == -4 && $blog['is_edit'] ==1) {
                                        echo '不通过';
                                    } else if($blog['displayorder'] == -3) {
                                        echo '需修改';
                                    }else if($blog['displayorder'] == -2) {
                                        echo '草稿';
                                    }
                                    ?></span></div>
                                            <div class="Z-select-arrow"></div>
                                            <div class="Z-select-list">
                                                <ul data-selected-displayorder>
                                                    <li data-value="5"><span>优秀</span></li>
                                                    <li data-value="3"><span>良好</span></li>
                                                    <li data-value="1"><span>较差</span></li>
                                                    <li data-value="0"><span>待审核</span></li>
                                                    <?php if($blog['is_edit']==1){ ?>
                                                        <li data-value="-4"><span>不通过</span></li>
                                                    <?php } ?>
                                                    <li data-value="-3"><span>需修改</span></li>
                                                    <li data-value="-2"><span>草稿</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="Z-row <?php if($blog['displayorder']!=-3 ){ ?>none<?php }?>" id="changeReason">
                                    <span class="Z-name">需修改：</span>
                                    <textarea class="Z-txt" data-scaleplate name="article[describe]" placeholder="修改理由"><?php echo $blog['describe'];?></textarea>
                                </div>
                                <?php if($blog['type']==4 && ($blog['displayorder']>0 || $blog['displayorder']==-4) && !$blog['is_original'] && $blog['meta_type']==1){ ?>
                                    <div class="Z-row">
                                        <span class="Z-name">奖励类型：</span>
                                        <?php if ($blog['isgift'] == 0) { ?>
                                            没有回报
                                        <?php } elseif ($blog['isgift'] == 1) { ?>
                                            赠予产品
                                        <?php } elseif ($blog['isgift'] == 2) { ?>
                                            其他奖励
                                        <?php } ?>
                                    </div>
                                    <?php if ($blog['isgift'] != 1) { ?>
                                        <?php if($blog['describe']){?>
                                            <div class="Z-row">
                                                <span class="Z-name">其他奖励：</span>
                                                <?php echo $blog['describe']; ?>
                                            </div>
                                        <?php }?>
                                        <div class="Z-row">
                                            <span class="Z-name">收货人：</span>
                                            <?php echo $blog['jiguo_receiver_name']; ?>
                                        </div>
                                        <div class="Z-row">
                                            <span class="Z-name">电话：</span>
                                            <?php echo $blog['jiguo_tel']; ?>
                                        </div>
                                        <div class="Z-row">
                                            <span class="Z-name">收货地址：</span>
                                            <?php echo $blog['jiguo_address']; ?>
                                        </div>
                                        <div class="Z-row clearfix">
                                            <span class="Z-name l">退货备注：</span>
                                            <div style="margin-left: 75px">
                                                <?php echo $blog['return_message']; ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            <div class="Z-row">
                                <span class="Z-name">发布时间：</span>
                                <!--                                <input class="Z-input Z-w-340" name="article[updatetime]" value="--><?php //echo date('Y-m-d H:i:s',$blog->updatetime);?><!--" placeholder="默认为上线时间" id="start"/>-->
                                <input class="Z-input Z-w-340" name="article[updatetime]" value="<?php if($blog['updatetime']>time()) echo date('Y-m-d H:i:s',$blog['updatetime']);?>" placeholder="默认是上线时间" id="start"/>
                                <span class="Z-row-line"><i></i></span>
                                <input class="Z-input Z-w-340 Z-right" type="hidden" name="" placeholder="2016-02-26"  id="end" />
                            </div>
                            <div class="Z-row">
                                <?php
                                $pic = 'http://s1.jiguo.com/'.$blog['cover'];
                                $arr = getimagesize($pic);
                                ?>
                                <span class="Z-name">封面图：<br>640x400<br>原图大小：<br><em style="color: red"><?php echo ($arr[0]).'x'.($arr[1])?></em></span>
                                <div class="Z-product-image">
                                    <div class="Z-product-image-box" id="Z-product-image-box">
                                        <ul>
                                            <li id="file-temp">
                                                <img src="http://s1.jiguo.com/<?php echo $blog['cover'];?>/640" />
                                                <input name="article[cover]" value="<?php echo $blog['cover'];?>" type="hidden">
                                                <div class="setting-query-wrap">
                                                    <div class="cropper" data-aspect-ratio="1.6">裁剪</div>
                                                </div>
                                            </li>
                                            <li id="file">
                                                <img src="<?php echo CDN;?>images/input-img-tpl.png" />
                                            </li>
                                        </ul>
                                        <div class="Z-clear"></div>
                                    </div>
                                </div>
                                <div class="Z-clear"></div>
                            </div>
                            <!-- banner -->
                            <div class="Z-row">
                                <span class="Z-name">banner：<br>800x400</span>
                                <div class="Z-product-image">
                                    <div class="Z-product-image-box" id="Z-product-image-box">
                                        <ul>
                                            <?php if($blog['banner']!=''){ ?>
                                                <li id="banner-temp">
                                                    <input name="article[banner]" value="<?php echo $blog['banner'];?>" type="hidden">
                                                    <img src="http://s1.jiguo.com/<?php echo $blog['banner'];?>/640">
                                                    <div class="setting-query-wrap">
                                                        <div class="cropper" data-aspect-ratio="2">裁剪</div>
                                                    </div>
                                                </li>
                                            <?php }else{ ?>
                                                <li id="banner-temp" style="display:none"></li>
                                            <?php } ?>
                                            <li id="banner">
                                                <img src="<?php echo CDN;?>images/input-img-tpl.png" />
                                            </li>
                                        </ul>
                                        <div class="Z-clear"></div>
                                    </div>
                                </div>
                                <div class="Z-clear"></div>
                            </div>

                            <div class="Z-row">
                                <span class="Z-name">跳转链接：</span>
                                <input class="Z-input" data-scaleplate name="article[button_link]" value="<?php echo $blog['button_link'];?>" placeholder="跳转链接"/>

                            </div>

                            <div class="Z-row">
                                <span class="Z-name">按钮名称：</span>
                                <input class="Z-input" data-scaleplate name="article[button]" value="<?php echo $blog['button'];?>" placeholder="按钮名称"/>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- 描述信息 -->
                <div class="Z-sub-main">
                    <div class="Z-list-info Z-event">
                        <div class="Z-row">
                            <span class="Z-name">关联产品：</span>
                            <span class="Z-buyBtn Z-link-product">
                                <p><a href="javascript:getProductListLinkEvent('/admin/search/index','zdm');">关联产品</a></p>
                            </span>
                            <span class="Z-red" id="__addLinkProduct__">
                                <?php if($product->id){ ?>
                                    <?php echo $product->brand.' '.$product->model.' '.$product->name;?>
                                    <input data-goods_id="" name="event[goods_id]" value="<?php echo $product->id;?>" type="hidden">
                                <?php }else{
                                    echo '没有关联产品';
                                }?>
                            </span>
                        </div>
                        <!-- 体验文章 7原创投稿-->
                        <div class="Z-row <?php if($blog['type']!=2 && $blog['type']!=4){ ?>none<?php }?>" data-category-wrap>
                            <div class="Z-row">
                                <span class="Z-name">文章分类：</span>
                                <div class="dib category-wrap">
                                    <input class="Z-input Z-w-270" id="P-category-show" autocomplete="off" readonly="readonly"  placeholder="请选择分类" value="<?php echo ($cate_data_name['child']['name']) ? $cate_data_name['grandfather']['name'] . '>' . $cate_data_name['parent']['name'] . '>' . $cate_data_name['child']['name']:"";?>" />
                                    <input data-category-id id="P-category" name="article[category]" type="hidden" value="<?php echo $blog['cid3'];?>">
                                    <i class="icon-down"></i>
                                    <div class="category-list" id="category-list">
                                        <!-- 产品分类列表 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 非原创投稿 -->
                        <?php if(!$blog['is_original'] && $change_order && ($blog['type']==4 || $blog['type']==7)){ ?>
                            <div class="Z-row">
                                <span class="Z-name">关联订单：</span>
                                <?php $_num_order = 0; ?>
                                <span id="link-order-info">
                                    <?php foreach ($order as $k=>$v){ ?>
                                        <?php if($blog['orderid']==$v['orderid']){ ?>
                                            <?php echo $v['title'];?>
                                            <?php $_num_order--; ?>
                                        <?php } ?>
                                        <?php $_num_order++; ?>
                                    <?php } ?>
                                </span>
                                <?php if( $_num_order>0){ ?>
                                    <a class="blue" id="changeOrderid">修改关联订单</a>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <link rel="stylesheet" type="text/css" href="<?php echo CDN;?>css/event.css"/>
                        <script type="text/javascript" src="<?php echo CDN;?>js/layer/layer.js"></script>
                        <script type="text/javascript" src="<?php echo CDN;?>js/event.js"></script>
                    </div>
                    <div class="Z-info">
                        <div class="Z-title">文章正文</div>
                        <div class="Z-list-info">
                            <div class="Z-desciption">
                              <script>window.ueditorContent = "<?php echo str_replace('"','\\"',$field->message);?>"</script>
                                <!-- 描述信息富文本编辑器 -->
                                <div id="ueditorContentBox"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 关联的产品 -->
                <div class="Z-sub-main">
                    <div class="Z-info">
                        <div class="Z-title">关联产品</div>
                        <div class="Z-list-info">
                            <div class="Z-link-product">
                                <ul class="Z-list-ul">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- seo优化 -->
                <div class="Z-sub-main">
                    <div class="Z-info">
                        <div class="Z-title">seo优化</div>
                        <div class="Z-list-info">
                            <div class="Z-row">
                                <span class="Z-name">关键词：<br><a class="blue" id="query-write-keyword" href="javascript:;">一键推荐</a></span>
                                <textarea class="Z-txt" name="article[keyword]" id="A-keywords" placeholder="关键词"><?php echo $blog['keyword'];?></textarea>
                                <span class="red" style="margin-left: 70px;">请使用英文逗号分隔关键词</span>
                                <div class="advice-keyword none"></div>
                            </div>
                            <div class="Z-row">
                                <span class="Z-name">文章描述：<br><a class="blue" id="query-write-seo_desc" href="javascript:;">一键填写</a></span>
                                <textarea class="Z-txt" name="article[seo_desc]" id="A-seodesc" placeholder="文章描述"><?php echo $blog['seo_desc'];?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 信息提交按钮 -->
                <div class="Z-sub-main Z-center">
                    <div class="Z-tips Z-m-15">请检查并提交文章录入信息</div>
                    <button id="SubmitFormDataAjaxSend" type="button" class="Z-btn Z-w-270">提交信息</button>
                    <button id="viewArticle" type="button" class="Z-btn Z-w-130" onClick="viewMobilePage()">预览</button>
                </div>
            </form>
        </div>
        <div class="Z-clear"></div>

    </div>
</div>

<script type="text/javascript" src="<?php echo CDN;?>js/addProduct.js"></script>

<?php //include dirname(__FILE__).'/_ceping.php';?>

<?php //echo $this->renderPartial('/article/card2/insert_card_block',array('category_top'=>$category_top)); ?>
<?php //echo $this->renderPartial('/article/card2/search_list_block',array('category_top'=>$category_top)); ?>
<?php //echo $this->renderPartial('/article/card2/add_link_block',array('category_top'=>$category_top)); ?>
<!---->
<!--<!--编辑器等js代码-->-->
<?php //echo $this->renderPartial('/article/card2/init_ueditor_block',array('category_top'=>$category_top)); ?>

<!-- seo优化 -->
<?php include dirname(__FILE__) . '/_seo_block.php';?>

<!--产品分类-->
<?php include dirname(__FILE__) . '/../product/_category.php';?>

<script>
	var cid = '<?php echo $product->category;?>';
	/*********************
	 //获取全部产品分类
	 *********************/
	$(function () {
		getAllCategory(cid);
	});

	$('[data-selected-ceping]').on('click','li',function () {
		if( $(this).attr('data-value')==2 || $(this).attr('data-value')==4){
			$('[data-category-wrap]').show();
		}else{
			$('[data-category-wrap]').hide();
		}
		if( $(this).attr('data-value')==4 ){
			$('.ceping-article').show();
			$('.not-ceping-article').hide();
			$('.label').hide();
			$('.experience').removeClass('none');
		}else{
			$('.ceping-article').hide();
			$('.not-ceping-article').show();
			$('.label').show();
			$('.experience').addClass('none');
		}
	});

	$('#reportCheck .icon').change(function () {
		changeStatus();
	});
	changeStatus();

	//改变评级状态
	function changeStatus() {
		if($('#needChange').prop('checked')){
			$('#changeReason').show();
			$('#score').hide();
		}else if($('#notPass').prop('checked')){
			$('#changeReason').hide();
			$('#score').show();
		}else{
			$('#changeReason').hide();
			$('#score').show();
		}
		if($('#notPass').prop('checked')){
			$('.report-star-box').hide();
		}else{
			$('.report-star-box').show();
		}
	}

	//入流标签点击联动
	$('.select-tag').change(function () {
		if($('#ex-select').prop('checked')){
			$('#ex-class').prop('checked',true);
		}
		if($(this).attr('id')=='ex-class'&&$('#ex-select').prop('checked')&&$(this).prop('checked')){
			$('#ex-select').prop('checked',false);
			$(this).prop('checked',false);
		}
	});

	$('[data-selected-displayorder]').on('click','li',function () {
		if( $(this).attr('data-value')==-3 ){
			$('#changeReason').show();
		}else{
			$('#changeReason').hide();
		}
	});
	/*********************
	 ajax提价数据
	 *********************/
	var flag =true;
	$('#SubmitFormDataAjaxSend').click(function(){
		if(!flag) return false;
		//同步编辑器内容
		_editor.sync();
		//表单验证
		if(!formValidation()) return false;
		var time = 3000;
		var tips = layer.msg('数据提交中...',{time:999999999});
		flag = false;

		//非测评文章去除评分
		if($('[name="article[type]"]').val()==4){
			$('.not-ceping-article').remove();
		}else{
			$('.ceping-article').remove();
		}
		$.ajax({
			url:"<?php echo $this->createUrl('/admin/article/edit');?>",
			data:$('#formDataAjaxSend').serialize(),
			dataType:'json',
			type:'post',
			timeout:30000,
			complete: function(xhr,status){
				flag = true;
				layer.close(tips);
				xhr.responseText = $.parseJSON(xhr.responseText);
				if(status=='timeout'){
					layer.msg('数据提交超时！',{time:time});
				} else {
					var t_id = layer.msg(xhr.responseText.message,{time:time});
					if(xhr.responseText.status==0){
						url = "<?php echo $_SERVER['HTTP_REFERER'];?>";
						window.location = url?url:'<?php echo $this->createUrl('/admin/article/waitcheck');?>';
					} else if(xhr.responseText.status==-11){
						layer.close(t_id);
						var html = '<p class="tc">图片地址错误，请执行远程抓取</p>\
                                    <p class="tc"><button type="button" id="button" class="Z-btn Z-w-170">远程图片抓取</button></p>';
						var lid = layer.open({
							title: '图片地址错误',
							scrollbar: false,
							content: html,
							success: function (layero, index) {
								layero.find('#button').click(function () {
									_editor.execCommand('catchbutton');
									layer.close(lid);
								});
							}
						});
					}
				}
			}
		});
	});

	/*********************
	 ajax提价数据之前做表单验证
	 *********************/
	function formValidation(){
		var time = 1200;
		if($('#A-name').val().toString().trim().length<=0){
			layer.msg('文章名称不能为空',{time:time});
			return false;
		}
		if($('[name="article[type]"]').val()=='请选择'){
			layer.msg('请选择文章类型',{time:time});
			return false;
		}
		if($('#file-temp').find('img').length<=0){
			layer.msg('封面图不能为空',{time:time});
			return false;
		}
		if($('[name="article[video]"]:checked').length<1){
			layer.msg('请先选择是否含视频',{time:time});
			return;
		}
		if($('[name="article[type]"]').val()==4){
			if($('#reportCheck .icon:checked').length>0){
				//有视频
				if($('#reportScore').is(':checked') && $('.rating-level .current').length<4 && $('[name="article[video]"]:checked').val()==1){
					layer.msg('评分数量不足');
					return;
				}
				//无视频
				if($('#reportScore').is(':checked') && $('.rating-level .current').length<3 && $('[name="article[video]"]:checked').val()==0){
					layer.msg('评分数量不足');
					return;
				}
			}else{
				layer.msg('请先评级',{time:time});
				return false;
			}
		}

		if($('[data-category-wrap]').css('display')=='block' && ($('[name="article[type]"]').val()==4||$('[name="article[type]"]').val()==2)){
			if( $('#P-category').val()==''){
				layer.msg('请选择文章分类',{time:time});
				return false;
			}
		}
		if($('#orderid').length){
			if( $('#orderid').val()==''){
				layer.msg('请选择订单',{time:time});
				return false;
			}
		}
		if($('[name="article[keyword]"]').val()==''){
			layer.msg('请填写关键词',{time:time});
			return false;
		}
		if($('[name="article[seo_desc]"]').val()==''){
			layer.msg('请填写文章描述',{time:time});
			return false;
		}

		return true;
	}

	$('#__addLinkProduct__').change(function (e,pid) {
		$.get('/admin/product/GetCateNameForProduct',{
			id:pid
		},function (replayData) {
			if(replayData.resultCode==0){
				var result = replayData.result;
				var txt = '',
					fname = result.grandfather.name,
					sname = result.parent.name,
					name = result.child.name,
					id = result.child.id;
				txt = fname + '>' + sname + '>' + name;
				$('#P-category-show').val(txt);
				$('#P-category').val(id);
				getAllCategory(id);
			}
		},'json');
	});

	$(function () {
		var order = <?php echo json_encode(is_array($order)?$order:array(),true);?>;
		var cacheOrderidTpl = newTplEngine( $('#changeOrderid-tpl').html() );
		$('#changeOrderid').on('click',function () {
			layer.open({
				title: '可关联订单',
				scrollbar:false,
				area:['660px','500px'],
				content: cacheOrderidTpl( {data:order} ),
				success:function (layero, index) {
					function relationOrder(data) {
						$.post('/admin/article/LinkOrder',data,function (repalyData) {
							layer.closeAll();
							for (var i in order){
								if(order[i].orderid==data.orderid){
									$('#link-order-info').html(order[i].title);
								}
							}
							window.orderid = data.orderid;
							if(repalyData.result.blog&&(repalyData.result.blog.blogid>0)){
								var changeOrderid2 = newTplEngine( $('#changeOrderid2-tpl').html() );
								openLayer(repalyData.result);
							}
						},'json');
					}
					layero.find('[data-relation]').on('click',function () {
						var orderid=$(this).closest('[data-orderid]').data('orderid');
						var articleid="<?php echo $_GET['id'];?>";
						var data={orderid:orderid, id:articleid};
						relationOrder(data);
					});
				}

			});
		});


		var changeOrderid2 = newTplEngine( $('#changeOrderid2-tpl').html() );

		function openLayer(blogData) {
			layer.open({
				title: '报告"'+blogData.blog.title+'"未关联订单，需关联后生效',
				scrollbar: false,
				area: ['660px', '500px'],
				content: changeOrderid2({data: blogData}),
				success: function (layero, index) {
					function relationOrder(data) {
						$.post('/admin/article/LinkOrder',data,function (repalyData) {
							layer.closeAll();
							if(repalyData.result.blog&&(repalyData.result.blog.blogid>0)){
								var changeOrderid2 = newTplEngine( $('#changeOrderid2-tpl').html() );
								openLayer(repalyData.result);
							}
						},'json');
					}
					layero.find('[data-relation]').on('click',function () {
						var orderid=$(this).closest('[data-orderid]').data('orderid');
						var articleid=$(this).closest('[data-blogid]').data('blogid');
						var data={orderid:orderid, id:articleid};
						relationOrder(data);
					});
				}

			});
		}

		//获取评星列表
		$('[name="article[video]"]').change(function () {
			reportScore();
		});
		reportScore(true);

		// 报告评级
		function reportScore(first) {
			if(first){
				var scoreTpl = newTplEngine( $('#report-score-tpl').html() ),
					url = '/admin2/work/GetReportFirstCheckStatus',
					data = {
						blogid: '<?php echo $blog['blogid'];?>'
					};
			}else{
				var scoreTpl = newTplEngine( $('#report-empty-score-tpl').html() ),
					url = '/admin2/work/GetScoreRule.html',
					video = $('[name="article[video]"]:checked').val(),
					data = {
						video: video
					};
			}

			//获取评分
			$.post(url,data,function (repalyData) {
				var html = scoreTpl({data: repalyData.result});
				$('.report-star-wrap').html(html);
			},'json');
		}
		//评星
		$('#score').on('click','.rating-level li:not(.disabled)',function () {
			var v = $(this).data('value'),
				evaluate = $(this).data('evaluate'),
				idx = v/2-1,
				tips = $(this).closest('div').find('.result'),
				ipt = $(this).closest('div').find('.stars-input'),
				isVideo = $('[name="article[video]"]:checked');
			if(isVideo.length<1){
				layer.msg('请先选择是否含视频');
				return;
			}
			$(this).closest('ul').find('li').removeClass('current on');
			$(this).addClass('current').addClass('on').prevAll().addClass('on');
			tips.html(evaluate);
			ipt.val(v);
			totalScore();
		});

		//总评分
		function totalScore() {
			var totalScore=0,
				sum=0,
				totalLevel,
				tipsArr = ['很差','较差','普通','良好','优秀'];
			$('.rating-level .current').each(function () {
				var v = $(this).data('value'),
					ratio = $(this).closest('ul').data('ratio'),
					score = v*ratio;
				sum += score;
			});
			totalScore = sum/100;
			if(totalScore<10){
				totalScore = (totalScore).toFixed(1);
			}

			if(totalScore>=2.0&&totalScore<=3.6){
				totalLevel = tipsArr[0];
			}else if(totalScore>=3.7&&totalScore<=5.2){
				totalLevel = tipsArr[1];
			}else if(totalScore>=5.3&&totalScore<=6.8){
				totalLevel = tipsArr[2];
			}else if(totalScore>=6.9&&totalScore<=8.4){
				totalLevel = tipsArr[3];
			}else if(totalScore>=8.5&&totalScore<=10){
				totalLevel = tipsArr[4];
			}else{
				totalLevel = '评分不足';
			}
			if(totalScore>=6.9){
				$('#ex-select').prop('checked',true);
				$('#ex-class').prop('checked',true);
			}else if(totalScore>=3.7){
				$('#ex-class').prop('checked',true);
				$('#ex-select').prop('checked',false);
			}else{
				$('#ex-select').prop('checked',false);
				$('#ex-class').prop('checked',false);
			}
			$('.total-score-text').html(totalScore);
			$('.total-level-text').html(totalLevel);
		}

	});

	window.orderid = '<?php echo $blog['orderid'];?>';
</script>

<script type="text/html" id="changeOrderid-tpl">
    <ul class="link-order-box">
        <% for(var i in data){ %>
        <% var v = data[i];%>
        <% if(window.orderid==v.orderid){continue;} %>
        <li>
            <div class="order-item-head">
                <span class="Z-gray">订单号：<%=v.orderid%></span>
                <span class="Z-gray ml20">下单时间：<%=v.addtime%></span>

                <span class="Z-red Z-right"><%if(v.status==3){%>待提报告<%}else{%>报告审核中<%}%></span>
            </div>
            <div class="order-item-body">
                <div class="order-item-title">
                    <strong><%=v.event_title%></strong>
                    <span class="event-tag"><%if(v.type==0){%>免费试用<%}else{%>折扣试用<%}%></span>
                    <div class="r">
                        <span>总金额：<font class="Z-red"><%=v.price%></font></span>
                        <span>押金：<font class="Z-red"><%=v.deposit%></font></span>
                    </div>
                </div>
                <div class="order-item-des">
                    <div class="order-item-info">
                        <span>姓名：<%=v.username%></span>
                        <span class="ml10">支付方式：<%=v.payment%></span>
                        <span class="ml10">极果用户名：<%=v.jiguo_name%></span>
                    </div>
                    <div class="order-item-info clearfix">
                        <span>电话：<%=v.tel%></span>
                        <span class="r"><%if(v.status==3){%>待提报告<%}else{%>报告审核中<%}%></span>
                    </div>
                    <div class="order-item-info">
                    </div>
                    <div class="order-item-info clearfix">
                        <span><%=v.province%><%=v.city%><%=v.county%><%=v.address%></span>
                        <div class="r blue" data-orderid="<%=v.orderid%>">
                            <a class="blue" href="http://zdm.jiguo.com/admin2/work/UserProfile?uid=<%=v.uid%>" target="_blank">用户</a>
                            /
                            <a class="blue" href="http://zdm.jiguo.com/admin2/work/OrderDetail/orderid/<%=v.orderid%>" target="_blank">查看订单</a>

                            <a class="blue ml20" data-relation href="javascript:;">关联</a>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <% } %>
    </ul>
</script>


<script type="text/html" id="changeOrderid2-tpl">
    <%var blog=data.blog%>
    <div class="main-content-wrap" data-blogid="<%=blog.blogid%>">
        <div class="clearfix blog-infor">
            <div class="Z-list-image Z-left">
                <img src="http://s1.jiguo.com/<%=blog.cover%>/230x230" alt="">
            </div>
            <div class="Z-list-desc">
                <div class="Z-list-title">
                    <strong><%=blog.title%></strong>
                    <span class="Z-time Z-right"><%=blog.addtime%></span>
                </div>
                <div class="text-ellipsis"><%=blog.message%></div>
                <div class="Z-list-subscribe">订单号：<%if(blog.orderid){%><%=blog.orderid%><%}else{%>无<%}%></div>

                <div class="Z-list-subscribe">
                    <div class="Z-red">关联产品：<%=blog.product_name%></div>
                    <span>作者：<font class="Z-green"><%=blog.author%></font></span>
                    <span class="ml20">uid：<font class="Z-green"><%=blog.uid%></font></span>
                    <div class="r">
                        <span class="Z-gray">折扣试用</span>
                        <span class="Z-gray ml20">报告待审核</span>
                    </div>
                </div>
                <div class="Z-list-subscribe blue">
                    <a class="blue" href="http://zdm.jiguo.com/admin/article/articleedit?id=<%=blog.blogid%>" target="_blank">编辑</a>
                    /
                    <a class="blue" href="http://zdm.jiguo.com/admin2/work/UserProfile?uid=<%=blog.uid%>" target="_blank">用户信息</a>
                    /
                    <a class="blue" href="http://zdm.jiguo.com/admin2/work/OrderDetail/orderid/<%=orderid%>" target="_blank">订单信息</a>
                    /
                    <a class="blue" href="http://www.jiguo.com/article/article/<%=blog.blogid%>.html?jguo=zhidx&code=<?php echo base64_encode(time()+12*3600) ?>" target="_blank">预览</a>
                </div>
            </div>
        </div>
        <ul class="link-order-box pt20">
            <% var order=data.order%>
            <% for(var i in order){ %>
            <% var v = order[i];%>
            <li>
                <div class="order-item-head">
                    <span class="Z-gray">订单号：<%=v.orderid%></span>
                    <span class="Z-gray ml20">下单时间：<%=v.addtime%></span>
                    <span class="Z-gray ml20">关联报告：<%=v.number_blog%></span>

                    <span class="Z-red Z-right"><%if(v.status==3){%>待提报告<%}else{%>报告审核中<%}%></span>
                </div>
                <div class="order-item-body">
                    <div class="order-item-title">
                        <strong><%=v.title%></strong>
                        <span class="event-tag"><%if(v.type==0){%>免费试用<%}else{%>折扣试用<%}%></span>
                        <div class="r">
                            <span>总金额：<font class="Z-red"><%=v.price%></font></span>
                            <span>押金：<font class="Z-red"><%=v.deposit%></font></span>
                        </div>
                    </div>
                    <div class="order-item-des">
                        <div class="order-item-info">
                            <span>姓名：<%=v.username%></span>
                            <span class="ml10">支付方式：<%=v.payment%></span>
                            <span class="ml10">极果用户名：<%=v.jiguo_name%></span>
                        </div>
                        <div class="order-item-info clearfix">
                            <span>电话：<%=v.tel%></span>
                            <span class="r"><%if(v.status==3){%>待提报告<%}else{%>报告审核中<%}%></span>
                        </div>
                        <div class="order-item-info">
                        </div>
                        <div class="order-item-info clearfix">
                            <span><%=v.province%><%=v.city%><%=v.county%><%=v.address%></span>
                            <div class="r blue" data-orderid="<%=v.orderid%>">
                                <a class="blue" href="http://zdm.jiguo.com/admin2/work/UserProfile?uid=<%=v.uid%>" target="_blank">用户</a>
                                /
                                <a class="blue" href="http://zdm.jiguo.com/admin2/work/OrderDetail/orderid/<%=v.orderid%>" target="_blank">查看订单</a>

                                <a class="blue ml20" data-relation href="javascript:;">关联</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <% } %>
        </ul>
    </div>
</script>

<script type="text/html" id="report-score-tpl">
    <div class="star-wrap l">
        <%var score_meta = data.score_meta%>
        <%for(var i in score_meta){%>
        <%var item=score_meta[i]%>
        <div class="<%=i%>-rating">
            <span class="title"><%=item.title%><%if(item.show_percentage>0){%>（<%=item.show_percentage%>%）<%}%>:</span>
            <ul class="rating-level" data-ratio="<%=item.back_percentage%>">
                <%for(var j in item.score_rule){%>
                <li class="<%if(item.back_percentage>0){%><%if(j==item.score){%>current<%}%> <%if(j-item.score<=0){%>on<%}%><%}else{%>disabled<%}%>" data-value="<%=j%>" data-evaluate="<%=item.score_rule[j]%>"></li>
                <%}%>
            </ul>
            <span class="result"><%if(item.score<=0){%>暂无<%}else{%><%=item.score_content%><%}%></span>
            <input type="hidden" class="stars-input" name="score[<%=i%>]" value="<%if((i=='video_score')&&(data.video==0)){%><%}else{%><%=item.score%><%}%>" />
        </div>
        <%}%>
    </div>
    <div class="total-score-wrap r">
        <div class="total-score">
            <span class="total-score-text Z-red ft28"><%if(data.count_score.score){%><%=data.count_score.score%><%}else{%>0<%}%></span> / <span class="Z-gray">10</span>
        </div>
        <div class="total-level">
            <span class="total-level-text ft30"><%if(data.count_score.title){%><%=data.count_score.title%><%}else{%>暂无<%}%></span>
        </div>
    </div>
</script>

<script type="text/html" id="report-empty-score-tpl">
    <div class="star-wrap l">
        <%for(var i in data){%>
        <%var item=data[i]%>
        <div class="<%=i%>-rating">
            <span class="title"><%=item.title%><%if(item.show_percentage>0){%>（<%=item.show_percentage%>%）<%}%>:</span>
            <ul class="rating-level" data-ratio="<%=item.back_percentage%>">
                <%for(var j in item.score_rule){%>
                <li class="<%if(item.back_percentage==0){%>disabled<%}%>" data-value="<%=j%>" data-evaluate="<%=item.score_rule[j]%>"></li>
                <%}%>
            </ul>
            <span class="result"></span>
            <input type="hidden" class="stars-input" name="score[<%=i%>]" value="" />
        </div>
        <%}%>
    </div>
    <div class="total-score-wrap r">
        <div class="total-score">
            <span class="total-score-text Z-red ft28">0</span> / <span class="Z-gray">10</span>
        </div>
        <div class="total-level">
            <span class="total-level-text ft30">暂无</span>
        </div>
    </div>
</script>
<style>
    .link-order-box{
        height: 380px;
        overflow-y:auto;
    }
    .link-order-box li {
        position: relative;
        border: 1px solid #ededed;
        margin-bottom: 15px;
        font-size: 12px;
    }
    .link-order-box li .icon {
        position: absolute;
        top: 0;
        left: -30px;
    }
    .link-order-box .cancle * {
        color: #b2b2b2 !important;
    }
    .link-order-box font {
        color: #ff0000;
    }
    .link-order-box .blue {
        color: #369ad1 ;
    }
    .order-item-head {
        line-height: 30px;
        border-bottom: 1px solid #ededed;
        padding: 0 10px;
        background: #f7f7f7;
    }
    .order-item-title strong {
        color: #000;
        font-size: 16px;
        max-width: 260px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: inline-block;
        vertical-align: middle;
    }
    .order-item-title .event-tag {
        margin: 0 5px;
        padding: 4px 10px;
        border: 1px solid #ededed;
        border-radius: 5px;
        font-size: 12px;
        font-weight: 100;
        color: #b2b2b2;
    }
    .order-item-title span {
        color: #b2b2b2;
    }
    .order-item-body {
        padding: 10px;
    }
    .order-item-des {
        margin-top: 15px;
    }
    .order-item-info i {
        position: relative;
        top: -3px;
        display: inline-block;
        width: 3px;
        height: 3px;
        font-size: 0;
        margin: 0 10px 0 8px;
        background: #369ad1;
    }
    .Z-gray {
        color: #999!important;
    }
    .btm-tips{
        margin-top:10px;
    }
    .main-content-wrap{
        height: 400px;
        overflow-y: auto;
    }
    .blog-infor{
        border-bottom: 1px solid #ccc;
        padding-bottom: 10px;
    }
    .text-ellipsis{
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
        text-overflow: ellipsis;
        word-break: break-all;
    }
</style>




