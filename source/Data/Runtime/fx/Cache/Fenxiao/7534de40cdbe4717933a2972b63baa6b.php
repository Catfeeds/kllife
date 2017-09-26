<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Xenon Boostrap Admin Panel" />
	<meta name="author" content="" />
	
	<title><?php echo C('PAGE_TITLE');?> - 分销系统</title>

	<!--<link rel="stylesheet" href="http://fonts.useso.com/css?family=Arimo:400,700,400italic">-->
	<link rel="stylesheet" href="/source/Static/assets/css/fonts/linecons/css/linecons.css">
	<link rel="stylesheet" href="/source/Static/assets/css/fonts/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/source/Static/assets/css/fonts/elusive/css/elusive.css">
	<link rel="stylesheet" href="/source/Static/assets/css/bootstrap.css">
	<link rel="stylesheet" href="/source/Static/assets/css/xenon-core.css">
	<link rel="stylesheet" href="/source/Static/assets/css/xenon-forms.css">
	<link rel="stylesheet" href="/source/Static/assets/css/xenon-components.css">
	<link rel="stylesheet" href="/source/Static/assets/css/xenon-skins.css">
	<link rel="stylesheet" href="/source/Static/assets/css/custom.css">
	<!--Import dropzone css-->
	<link rel="stylesheet" href="/source/Static/assets/js/dropzone/css/dropzone.css">	
	<link rel="stylesheet" href="/source/Static/common/css/common.css">

	<script src="/source/Static/assets/js/jquery-1.11.1.min.js"></script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="/source/Static/assets/js/html5shiv.min.js"></script>
		<script src="/source/Static/assets/js/respond.min.js"></script>
	<![endif]-->
	
	<style>
		.loading { position: fixed; z-index: 999; background: rgba(0,0,0,.5); top: 0; left: 0; width: 100%; text-align: center; display: none;}
		.loading .dashboard { position: absolute; top: 50%; left: 50%; margin-top: -125px; }
	</style>
	<script>
		$(document).ready(function(){
			var LoadingHeight = document.body.scrollHeight;
			$('.loading').css("height",LoadingHeight);	
		});
		
		function showLoading(bshow, tips) {
			if (bshow == false) {
				$('.loading').css('display', 'none');
			} else {
				$('.loading').css('display', 'block');
				if (tips != null && tips != 'undefined') {
					$('.loading').find('span').html(tips);	
				}
			}
		}
	</script>
	
</head>
<body class="page-body">
	<?php if(!empty($modal_modify_password)): ?><div class="modal fade" id="modal-modify-password">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">更改密码</h4>
			</div>
			
			<div class="modal-body">
								
				<div class="row">
					<div class="col-md-12">
						
						<div class="form-group">
							<label for="cur_password" class="control-label">当前密码</label>
							
							<input type="password" class="form-control" id="cur_password" placeholder="请输入当前密码">
						</div>	
						
					</div>
				</div>
								
				<div class="row">
					<div class="col-md-12">
						
						<div class="form-group">
							<label for="new_password" class="control-label">新密码</label>
							
							<input type="password" class="form-control" id="new_password" placeholder="请输入新设置的密码">
						</div>	
						
					</div>
				</div>
								
				<div class="row">
					<div class="col-md-12">
						
						<div class="form-group">
							<label for="confirm_password" class="control-label">确认密码</label>
							
							<input type="password" class="form-control" id="confirm_password" placeholder="请再次输入新设置的密码">
						</div>	
						
					</div>
				</div>
				
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-info comfirm">更改密码</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
var modifyPassword = modifyPassword || {};

;(function($, window, undefined){
	
	"use strict";

	$(document).ready(function(){
		
		modifyPassword.$container = $('#modal-modify-password');
		
		$.extend(modifyPassword, {
			
			$confirmCallBack: null,
			
			showModal: function(backFunc) {
				
				modifyPassword.$container.modal('show', {backdrop: 'false'});
				
				modifyPassword.$confirmCallBack = backFunc;
			}
			
		});
		
		// 确认修改密码		
		modifyPassword.$container.find('.comfirm').on('click', function(){			
			var $cur_password = modifyPassword.$container.find('#cur_password').val();
			var $new_password = modifyPassword.$container.find('#new_password').val();
			var $confirm_password = modifyPassword.$container.find('#confirm_password').val();
			
			if ($cur_password == '' || $new_password == '' || $confirm_password == '') {
				toastr.info('当前密码、新密码、确认密码不能为空!!!');
				return false;
			}
			
			if ($new_password != $confirm_password) {
				toastr.error('两次输入的新密码不一样，请检查后重新输入!!!');
				return false;
			}
			
			if (typeof(modifyPassword.$confirmCallBack) == 'function') {
				modifyPassword.$confirmCallBack($cur_password, $new_password);				
			}
		});
		
	});
	
})(jQuery, window);
	
</script><?php endif; ?>
<?php if(!empty($modal_line_list)): ?><link rel="stylesheet" href="/source/Static/home/common/css/cssreset.css" />
<link rel="stylesheet" href="/source/Static/home/css/fline_list.css"/>

<div class="modal fade custom-width" id="modalLineSelect">
	<div class="modal-dialog" style="width: 90%;">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2 class="modal-title">线路选择</h2>
			</div>
			
			<div class="modal-body">
				<div class="modal-search">
					<input id="line_title" type="text" placeholder="输入您想要的线路标题"><a class="modal_fline_search" href="javascript:;">搜索</a>
				</div>
				<div class="modal-list">
				</div>
				<!-- 翻页 -->
				<div class="modal-page"></div>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>

<script src="/source/Static/home/js/page.js"></script>
<script>
	//打开modal
	var funcModalLineCallBack = null;
	var modalLineFireObject = null;
	var modalLineFindConds = null;
	function showModalLineSelect(obj, func, cds, send) {
		modalLineFireObject = obj;
		funcModalLineCallBack = func;
		modalLineFindConds = cds;
		if (send != null && send != 'undefined'){
			changeModalLineSelectPage(1);
		}		
		modalLineSelectClearChecked();
		$("#modalLineSelect").modal('show', {backdrop: 'static'});	
	}
	
	// 清除所有选择
	function modalLineSelectClearChecked () {
		$("#modalLineSelect").find('.article-choosed').removeClass('article-choosed');
	}
	
	// 切换选择
	function modalLineSelectChangeChecked (){
		$(this).toggleClass('article-choosed');
	}
	
	//切换选中
	$("#modalLineSelect").find('.article-choose').click(function(){
		$(this).toggleClass('article-choosed');
	});
	
	$("#modalLineSelect").find('.modal_fline_search').click(function(){
		changeModalLineSelectPage($('.modal-page').attr('data-page-index'));
	});

	// 初始化翻页
	constructionPage($('#modalLineSelect').find('.modal-page'), 1, 1, changeModalLineSelectPage, true);
    
    // 切换页码
    function changeModalLineSelectPage(p) {
    	var conds = modalLineFindConds;
    	var title = $('#line_title').val();
    	if (title != '') {
    		conds == null || conds == '' ? conds = 'title|LIKE|%'+title+'%' : conds += '|title|LIKE|%'+title+'%';
    	}
    	var jsonData = {
    		op_type: 'find_list',
    		page: p - 1 ,
    	}
    	
    	    	
    	jsonData['cds'] = conds;
    	
    	$.post('<?php echo U("line/list");?>', jsonData, function(data){	
			$("#modalLineSelect").find('.modal-list').empty();
			if (typeof(data.ds) != 'undefined' && data.ds != null) {
//				console.log('===================================================');
				for (var i=0; i<$(data.ds).length; i++) { 
					var d = data.ds[i];   	
					var assemblyPoint = '';
					if (d.assembly_point != null && d.assembly_point != '') {
						var apData = $.parseJSON(d.assembly_point);
						for (var ap = 0; ap < apData.length; ap ++) {
							assemblyPoint += apData[ap].type_desc + ' ';
						}
					}
					var destination = '';
					if (d.destination != null && d.destination != '') {
						var apData = $.parseJSON(d.destination);
						for (var ap = 0; ap < apData.length; ap ++) {
							destination += apData[ap].type_desc + ' ';
						}
					}   	
					var batchCount = d.batchs = null ? 0 : $(d.batchs).length;
					var img_src = d.img1 == null ? '' : d.img1;
//    				console.log(d.id + ':' + d.title+',assembly:'+assemblyPoint+',dest:'+destination+',batch_count:'+batchCount+',img:'+img_src);    				
					
					var commision = '0.00/0.00';
					if (d.commision_adult != null && d.commision_child != null) {
						commision = d.commision_adult+'/'+d.commision_child;
					}
					var curPrice = '0.00/0.00';
					if (d.min_batch != null) {
						curPrice = d.min_batch.adult_cut+'/'+d.min_batch.child_cut;	
					}
					
					var vhtml = '<div class="single-row">'+
								'	<div class="single-row-content">'+
								'		<div class="article-choose-content">'+
								'			<i class="article-choose" data-id="'+d.id+'">选中</i>'+
								'			<i class="article-choose-use">选中并使用</i>'+
								'		</div>'+
								'		<div class="single-row-img">'+
								'			<a href="'+'<?php echo U("line/preview");?>/id/'+d.id+'" target="_blank">'+
								'				<img src="'+img_src+'" alt="">'+
								'			</a>'+
								'		</div>'+
								'		<div class="single-row-describe">'+
								'			<div class="single-row-describe-top">'+
								'				<h4><a href="'+'<?php echo U("line/preview");?>/id/'+d.id+'" target="_blank">'+d.title+'</a></h4>'+
								'				<h5><a href="'+'<?php echo U("line/preview");?>/id/'+d.id+'" target="_blank">'+d.subheading+'</a></h5>'+
								'				<span><a href="'+'<?php echo U("line/preview");?>/id/'+d.id+'" target="_blank">'+d.send_word_show+'</a></span>'+
								'				<p><u>集合地点：'+assemblyPoint+'</u><u>批次：全年'+batchCount+'期</u></p>'+
								'				<p>目的地：'+destination+'</p>'+
								'				'+
								'			</div>'+
								'			<div class="single-row-describe-bottom">'+
								'				<span>旅行时间： '+d.start_time+'至'+d.end_time+'</span>'+
								'				<span style="float:right;">分销佣金(成人/儿童)： '+commision+'</span>'+
								'			</div>'+
								'		</div>'+
								'	</div>'+
								'</div>';
					$("#modalLineSelect").find('.modal-list').append(vhtml);
					$("#modalLineSelect").find('.article-choose-use:last').click(modalLineSelectComfirm);
					$("#modalLineSelect").find('.article-choose:last').click(modalLineSelectChangeChecked);
				}
				
				// 根据情况判断是否重构分页
				constructionPage($('#modalLineSelect').find('.modal-page'), p, data.page_count, changeModalLineSelectPage);
			} 
    	});
    }
    
    $(document).ready(function(){
    	changeModalLineSelectPage(1);
    });
    
    function modalLineSelectComfirm() {
    	if ($(this).prev().hasClass('article-choosed') == false) {
    		$(this).prev().addClass('article-choosed');
    	}
    	
    	var selIds = [];	    	
    	$("#modalLineSelect").find('.article-choosed').each(function(i,ev){
    		selIds.push($(this).attr('data-id'));
    	});
    	
		$("#modalLineSelect").modal('hide');
    	funcModalLineCallBack(modalLineFireObject, selIds);
    }	    
</script><?php endif; ?>
<?php if(!empty($modal_choose_image)): ?><div id="div_upload"></div>	
<input type="file" name="upload_file" id="upload_file" style="display: none"/>
<div class="xiuxiu-mark"></div>

<!--美图秀秀-->
<script src="http://open.web.meitu.com/sources/xiuxiu.js" type="text/javascript"></script>
<script type="text/javascript">
	function showXiuxiu(uploadUrl, callbackFunc) {
		$('#xiuxiuEditor').show();
		$('.xiuxiu-mark').show();
		
		/*第1个参数是加载编辑器div容器，第2个参数是编辑器类型，第3个参数是div容器宽，第4个参数是div容器高*/
		xiuxiu.embedSWF("div_upload",5,"100%","100%");
		//修改为您自己的图片上传接口
		xiuxiu.setUploadURL(uploadUrl);
		xiuxiu.setUploadType(2);
		xiuxiu.setUploadDataFieldName("upload_file");
		xiuxiu.onInit = function ()
		{
			xiuxiu.loadPhoto("http://open.web.meitu.com/sources/images/1.jpg");//修改为要处理的图片url
		}
		xiuxiu.onUploadResponse = callbackFunc
		
		
		$('.xiuxiu-mark').click(function(){
			$(this).hide();
			$('#xiuxiuEditor').hide();
		});
	}
	
	function hideXiuxiu() {		
		$('.xiuxiu-mark').hide();
		$('#xiuxiuEditor').hide();
	}
</script><?php endif; ?>
	<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
		<!--菜单-->
				<!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
		<!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
		<!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
		<div class="sidebar-menu toggle-others fixed">
			
			<div class="sidebar-menu-inner">	
				
				<header class="logo-env">
					
					<!-- logo -->+
					<div class="logo">
						<a href="http://kllife.com/fenxiao" class="logo-expanded">
							<img src="/source/Static/assets/images/logo.png" width="80" alt="" />
						</a>
						
						<a href="http://kllife.com/fenxiao" class="logo-collapsed">
							<img src="/source/Static/assets/images/logo.png" width="40" alt="" />
						</a>
					</div>
					
					<!-- This will toggle the mobile menu and will be visible only on mobile devices -->
					<div class="mobile-menu-toggle visible-xs">
						<a href="http://kllife.com/fenxiao" data-toggle="user-info-menu">
							<i class="fa-bell-o"></i>
							<span class="badge badge-success">7</span>
						</a>
						
						<a href="http://kllife.com/fenxiao" data-toggle="mobile-menu">
							<i class="fa-bars"></i>
						</a>
					</div>
					
					<!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
					<!--<div class="settings-icon">
						<a href="#" data-toggle="settings-pane" data-animate="true">
							<i class="linecons-cog"></i>
						</a>
					</div>-->		
								
				</header>
						
				
						
				<ul id="main-menu" class="main-menu">
					<!-- add class "multiple-expanded" to allow multiple submenus to open -->
					<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
					<li <?php echo C('MENU_ACTIVE')=='mine' ? 'class="active opened"' : '';?>><!-- class="active opened"-->
						<a href="<?php echo U('user/info');?>">
							<i class="el-torso"><!--<i class="linecons-cog">--></i>
							<span class="title">我的主页</span>
						</a>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='line' ? 'class="active opened"' : '';?>>
						<a href="<?php echo U('line/list');?>">
							<i class="el-th"></i>
							<span class="title">我的线路</span>
						</a>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='order' ? 'class="active opened"' : '';?>>
						<a href="<?php echo U('order/list');?>">
							<i class="el-th-list"></i>
							<span class="title">我的订单</span>
						</a>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='settle' ? 'class="active opened"' : '';?>>
						<a href="<?php echo U('settle/settle');?>">
							<i class="el-cog-circled"></i>
							<span class="title">我的设置</span>
						</a>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='lock_screen' ? 'class="active opened"' : '';?>>
						<a href="<?php echo U('user/lockscreen');?>">
							<i class="el-off"></i>
							<span class="title">锁屏</span>
						</a>
					</li>
				</ul>
						
			</div> <!--div:sidebar-menu-inner-->						
		</div> <!--div:sidebar-menu--> 
		<!--内容页-->
		<div class="main-content">
			<!--操作员信息-->
			
			<!-- User Info, Notifications and Menu Bar -->
			<nav class="navbar user-info-navbar" role="navigation">
				
				<!-- Left links for user info navbar -->
				<ul class="user-info-menu left-links list-inline list-unstyled">
					
					<li class="hidden-sm hidden-xs">
						<a href="#" data-toggle="sidebar">
							<i class="fa-bars"></i>
						</a>
					</li>
					
				</ul>
				
				<!-- Right links for user info navbar -->
				<ul class="user-info-menu right-links list-inline list-unstyled">
					
					<li class="dropdown user-profile">
						<a href="#" data-toggle="dropdown">
							<img src="/source/Static/assets/images/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
							<span>
								欢迎~!&nbsp;[<strong><?php echo ($user["show_name"]); ?></strong>]&nbsp;登录!!!								
							</span>
							<i class="fa-angle-down"></i>
						</a>
						
						<ul class="dropdown-menu user-profile-menu list-unstyled">
							<li class="last">
								<a href="<?php echo U('user/logout');?>">
									<i class="fa-lock"></i>
									退 出
								</a>
							</li>
						</ul>
					</li>					
				</ul>
			</nav>
			<!--加载页-->
			<div class="loading">		
				<div class="dashboard">
					<img src="/source/Static/back/images/aa.gif"/>
					<span class="tips"></span>
				</div>
			</div>
			<div class="face-mark"></div>
	
<!-- 私有样式 -->

<link rel="stylesheet" href="/source/Static/home/css/list.css">
<link rel="stylesheet" href="/source/Static/home/css/account_management.css">

<!-- 分页样式 -->
<link rel="stylesheet" href="/source/Static/home/common/css/page.css">

<!-- echo -->
<script src="/source/Static/home/common/js/echo.min.js"></script>

<style type="text/css">
	body { background-color:#f3f5f6; }
	.btn-line { width: 90px; height: 36px; float: right; background-size: 100% 100%; border-color: #aaaa55; width: 90px; height: 36px;}
	.single-row-describe-top { height: 243px; }	
	.single-row-describe-bottom { height: 37px; line-height: 37px; }		
	.single-row-qz { position: absolute; top: 10px; right: 10px; width:200px; }
	.single-row-qz i { cursor: pointer; }	
	.single-row-describe-price h6 b { margin-right: 12px; }
	.single-row {display: block;}
	
	.image-file-input {
		position: absolute;
		top: 0;
		width: 100%;
		height: 300px;
		opacity: 0;
	}
	
	.left-space {margin-left: 25px;}
	.lead { margin-top:50px; margin-bottom: 20px; border-bottom: 1px solid #dcdcdc; }
	.button-list { margin-top: 20px; }
</style>

	<div class="page-title">		
		<div class="title-env">
			<h1 class="title">首页设置</h1>
			<p class="description">这里你可以设置特卖或推荐的分销线路</p>
		</div>
	</div>
	<div class="row">

		<div class="hidden_ctrl template_line" data-id="">
			<div class="single-row-content">
				<div class="single-row-img">
					<img src="" alt="">
				</div>
				<div class="single-row-describe">
					<div class="single-row-describe-top">
						<div class="single-row-qz">
							<div class="input-group">
								<input id="" class="sort" type="text" maxlength="4" class="form-control no-right-border form-focus-purple">
								<div class="input-group-addon" data-for="" data-set="">
									<i>排序</i>
								</div>
							</div>							
						</div>
						<h4 class="title"></h4>
						<h5 class="subheading"></h5>
						<span class="send_word"></span>
						<p><u class="assembly">集合地点：</u><!--<u class="batch">批次：全年0期</u>--></p>
						<p class="destination">目的地：</p>
						<span class="travel_date">旅行时间：</span><br />
						<div class="single-row-describe-price">
							<h6>
								<b>线路价格(成人/儿童)：<i class="price"></i>元</b>
								<b>分销佣金(成人/儿童)：<i class="cut_price"></i>元</b>
							</h6>
						</div>
					</div>
					<div class="single-row-describe-bottom">
						<button class="btn btn-success test btn-line remove">移除</button>
					</div>
				</div>
			</div>
		</div>	
		
		<div class="left-space header">
			<p class="text-danger lead">店铺设置：</p>	
			
			<div class="banner_image" style="position: relative;">			
				<img src="<?php echo ($sets["shop_banner"]["data"]["value"]); ?>" style="width: 100%; height: 300px;"/> <br/>
				<input class="image-file-input" type="file" accept="image/*" id="change-img">
				<h5 style="margin-left: 30px; color: red;">点击上方以更换店铺首图，建议图片大小为800x334,不超过1M</h5>
			</div>
			<br /><br />
			<div class="input-group col-sm-10"> 
				<span class="input-group-btn"> 
					<button class="btn btn-gray" type="button">店铺标题：</button> 
				</span> 
				<input id="shop_title" type="text" class="form-control no-left-border no-right-border form-focus-warning" value="<?php echo ($sets["shop_title"]["data"]["value"]); ?>"> 
				<span class="input-group-btn"> 
					<button class="btn btn-secondary btn_set_text" data-for="shop_title" data-set="shop_title" type="button">设置</button> 
				</span>
			</div>
		</div>
		
		<div class="left-space">
			<p class="text-danger lead">分销操作：</p>	
			<div class="button-list">
				<a href="javascript:;" class="btn btn-warning update_cache"  data-set="fenxiao_index_config_<?php echo ($user["id"]); ?>">更新分销设置</a>
				<a class="btn btn-secondary btn-preview-line" href="http://kllife.com/phone/index.php?s=/phone/fenxiao/welcome/duid/<?php echo ($user["id"]); ?>" target="_blank">预览我的分销</a>
			</div>
		</div>
		
		<?php if(is_array($modal_types)): $i = 0; $__LIST__ = $modal_types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mt): $mod = ($i % 2 );++$i;?><!--线路设置-->
			<div class="left-space">
				<p class="text-danger lead"><?php echo ($mt["title"]); ?>：</p>		
				<div class="button-list">						
					<a href="javascript:;" class="btn btn-secondary btn-choice-line" data-type="<?php echo ($mt["type"]); ?>">设置首页<?php echo ($mt["title"]); ?>分销线路</a>
				</div>
			</div>
			
			<!-- 列表菜单 -->
			<div class="list-menu <?php echo ($mt["type"]); ?>">
				<?php $findstr = $mt['type'].'_line_'; ?>
				<?php if(is_array($sets)): $i = 0; $__LIST__ = $sets;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$set): $mod = ($i % 2 );++$i; if(stripos($key, $findstr) === 0): ?><div class="single-row" data-id="<?php echo ($set["data"]["id"]); ?>" data-group="<?php echo ($set["data"]["group"]); ?>" data-sort="<?php echo ($set["data"]["sort"]); ?>">
							<div class="single-row-content">
								<div class="single-row-img">
									<img src="<?php echo ($set["line"]["img1"]); ?>" alt="">
								</div>
								<div class="single-row-describe">
									<div class="single-row-describe-top">
										<div class="single-row-qz">
											<div class="input-group">
												<input id="<?php echo ($key); ?>_sort" class="sort" type="text" maxlength="4" value="<?php echo ($set["data"]["sort"]); ?>" class="form-control no-right-border form-focus-purple">
												<div class="input-group-addon" data-for="<?php echo ($key); ?>_sort" data-id="<?php echo ($set["data"]["id"]); ?>" data-set="<?php echo ($key); ?>">
													<i>排序</i>
												</div>
											</div>
											
										</div>
										<h4 class="title"><?php echo ($set["line"]["title"]); ?></h4>
										<h5 class="subheading"><?php echo ($set["line"]["subheading"]); ?></h5>
										<span class="send_word"><?php echo ($set["line"]["send_word_show"]); ?></span>
										<p>
											<u class="assembly">集合地点：<?php echo ($set["line"]["assembly_point_show_text"]); ?></u>
											<!--<u class="batch">批次：全年<?php echo count($set.line.batchs);?>期</u>-->
										</p>
										<p class="destination">目的地：<?php echo ($set["line"]["destination_show_text"]); ?></p>
										<span class="travel_date">旅行时间： <?php echo ($set["line"]["start_time"]); ?>&nbsp;至&nbsp;<?php echo ($set["line"]["end_time"]); ?></span><br/>
										<div class="single-row-describe-price">
											<h6>
												<b>线路价格(成人/儿童)：<i class="price"><?php echo ($set["line"]["start_price_adult"]); ?>/<?php echo ($set["line"]["start_price_child"]); ?></i>元</b>
												<b>分销佣金(成人/儿童)：<i class="cut_price"><?php echo ($set["line"]["commision_adult"]); ?>/<?php echo ($set["line"]["commision_child"]); ?></i>元</b>
											</h6>
										</div>
									</div>
									<div class="single-row-describe-bottom">
										<button class="btn btn-success test btn-line remove" data-id="<?php echo ($set["data"]["id"]); ?>" data-set="<?php echo ($key); ?>">移除</button>
									</div>
								</div>
							</div>
						</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		
	</div>
<!--选择图片遮罩层-->
<div class="face-mark"></div>
	
	<script type="text/javascript">
	
	$(document).on("change","#change-img",function(){
		var thisimg=this;
		
		var formData = new FormData();
		var name = $(this).val();
		formData.append('upload_file', thisimg.files[0]);
		formData.append('name', name);
		formData.append('set_name', 'shop_banner');
		$.ajax({
			url: '<?php echo U("settle/image");?>',
			type: 'POST',
			data: formData,
			// 告诉jQuery不要去处理发送的数据
			processData : false, 
			// 告诉jQuery不要去设置Content-Type请求头
			contentType : false,
			// 发送内容前
			beforeSend: function(){
				showLoading(true, '正在上传文件,请稍后...')
			},
			success: function (data) {
				if (data.result.errno == 0) {
					if (data.image != null) {
						var imgObj = $(thisimg).parent().find('img');
						$(imgObj).attr("src",data.image+'?t='+Math.random());
					}
				} else {
					alert(data.result.message);
				}
			},
			complete: function (data) {
				showLoading(false);
			}
		});
		
	});
	
	// 设置店铺内容
	function setShopConfig(key, val, nGroup, nSort, sql_type, keyLike) {		
		if (key == '' || key == 'undefined' || key == null) {
			toastr.warning('修改项错误');
			return false;
		}
		
		var jsonData = {
			op_type: 'set',
			key: key,
			value: val,
		}
		if (nGroup != 'undefined' && nGroup != null) {
			jsonData['group'] = nGroup;
		}
		if (nSort != 'undefined' && nSort != null) {
			jsonData['sort'] = nSort;
		}
		if (sql_type != 'undefined' && sql_type != null) {
			jsonData['sql_type'] = sql_type;
		}
		if (keyLike != 'undefined' && keyLike != null) {
			jsonData['key_like'] = 1;
		}
		
		var ds = {ds:null, result:{errno:-1, message:'设置为未功'}};
		$.ajax({
			url: '<?php echo U("settle/settle");?>',
			type: 'POST',
			async: false,
			data: jsonData,
			dataType: 'json',
			success: function(data) {
				if (data.jumpUrl != null) {
					location.href = data.jumpUrl;
				}
				ds = data;
			},
			complete: function(data) {
			}
		});			
		return ds;
	}
	
	// 设置店铺标题
	$('.btn_set_text').click(function(){
		var key = $(this).attr('data-set');
		var val = $('#'+$(this).attr('data-for')).val();
		var data = setShopConfig(key, val);
		if (data.result.errno == 0) {
			toastr.success(data.result.message);	
		} else {
			toastr.error(data.result.message);
		}
	});
	
	// 选择线路
	function chioceLine(obj, idList) {
		if (idList == null || idList.length == 0) {
			toast.info('没有选择线路');
			return false;
		}
		var groups = {'slowly':1, 'qinglvpai':2, 'hot':3}
		var groupName = $(obj).attr('data-type');
		
		// 排序索引
		var nSort = 0;
		var rootObj = $(obj).closest('.left-space').next();
		$(rootObj).find('.single-row').each(function(i, el){
			var thisSort = $(this).attr('data-sort');
			if (parseInt(thisSort) >= parseInt(nSort)) {
				nSort = parseInt(thisSort) + 1;
			}
		});
		
		var key = groupName+'_line_'+nSort;
		var data = setShopConfig(key, idList[0], groups[groupName], nSort, 'line');
		if (data.jumpUrl != null) {
			location.href = data.jumpUrl;
		}
		if (data.result.errno == 0) {
			if (data.line != null) {
				var d = data.line;
				var lineObj = $('.template_line').clone(true);
				$(lineObj).removeClass('hidden_ctrl');
				$(lineObj).removeClass('template_line');
				$(lineObj).addClass('single-row');
				$(lineObj).attr('data-bind-id', data.bind_id);
				$(lineObj).attr('data-id', d.id);
				$(lineObj).attr('data-group', groups[groupName]);
				$(lineObj).attr('data-sort', nSort);
				
				var commision = '0.00/0.00';
				if (d.commision_adult != null && d.commision_child != null) {
					commision = d.commision_adult+'/'+d.commision_child;
				}
				var curPrice = d.start_price_adult+'/'+d.start_price_child;
				
				$(lineObj).find('img').attr('src',d.img1);
				$(lineObj).find('.sort').val(data.ds.sort);
				$(lineObj).find('.title').html(d.title);
				$(lineObj).find('.subheading').html(d.subheading);
				$(lineObj).find('.send_word').html(d.send_word_show);
				$(lineObj).find('.assembly').html('集合地点：'+d.assembly_point_show_text);
//				$(lineObj).find('.batch').html('批次：全年'+d.batchs==null?0:$(d.batchs).length+'期');
				$(lineObj).find('.destination').html('目的地：'+d.destination_show_text);
				$(lineObj).find('.price').html(curPrice);
				$(lineObj).find('.cut_price').html(commision);
				$(lineObj).find('.travel_date').html('旅行时间： '+d.start_time+'&nbsp;至&nbsp;'+d.end_time);
				
				$(rootObj).append(lineObj);
				$(lineObj).find('.single-row-qz').find('.input-group-addon').click(sortLine);
				$(lineObj).find('.remove').click(removeLine);
				
			} else {
				toastr.success('设置分销线路错误');
			}
		} else {
			toastr.error(data.result.message);
		}	
	}
	
	// 设置首页分销产品
	$('.btn-choice-line').click(function(){
		var type = $(this).attr('data-type');		
		showModalLineSelect(this, chioceLine, 'set_type|=|'+type, true);
	});
	
	// 配置的分销线路排序
	function sortLine(ev) {
		ev.stopPropagation();
		var rootObj = $(this).closest('.single-row');
		var key = $(this).attr('data-set');
		var inputId = '#'+$(this).attr('data-for');
		var sortIndex = $(inputId).val();
		if (sortIndex == '') {
			toastr.warning('排序的值不能为空');
			return false;
		}
		var data = setShopConfig(key, sortIndex, '', '', 'sort');
		if (data.jumpUrl != null) {
			location.href = data.jumpUrl;
		}
		if (data.result != null) {
			toastr.error(data.result.message);
		}
	}
	$('.single-row-qz').find('.input-group-addon').click(sortLine);
	
	// 移除配置的分销线路
	function removeLine() {
		var rootObj = $(this).closest('.single-row');
		var bindId = $(this).attr('data-id');
		
		$.post('<?php echo U("settle/settle");?>', {op_type:'remove', id: bindId}, function(data){
			if (data.result.errno == 0) {
				$(rootObj).remove();	
			} else {
				toastr.error(data.result.message);
			}	
		});
	}
	$('.single-row-describe-bottom').find('.remove').click(removeLine);
		
	</script>
			<!-- Main Footer -->
			<!-- Choose between footer styles: "footer-type-1" or "footer-type-2" -->
			<!-- Add class "sticky" to  always stick the footer to the end of page (if page contents is small) -->
			<!-- Or class "fixed" to  always fix the footer to the end of page -->
			<footer class="main-footer sticky footer-type-1">
				
				<div class="footer-inner">
				
					<!-- Add your copyright text here -->
					<div class="footer-text">
						&copy; 版权所有&nbsp; 
						<strong>领袖户外-分销系统</strong> 
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						更多信息请关注<a href="http://kllife.com/" target="_blank" title="领袖户外">&lt;领袖户外&gt;</a>
					</div>
					
					
					<!-- Go to Top Link, just add rel="go-top" to any link to add this functionality -->
					<div class="go-up">
					
						<a href="#" rel="go-top">
							<i class="fa-angle-up">top</i>
						</a>
						
					</div>
					
				</div>
				
			</footer>
		</div>		
		
	</div> <!--div:page-container-->	
				
	<a href="#" style="position: fixed; left: 80px; bottom: 10px; display: block; width: 50px; height: 50px; z-index: 999; background-image: url(/source/Static/back/images/up.png); background-size: 100% 100%;"></a>
	<div class="page-loading-overlay">
		<div class="loader-2"></div>
	</div>
	

	<link rel="stylesheet" href="/source/Static/assets/js/select2/select2.css">
	<link rel="stylesheet" href="/source/Static/assets/js/select2/select2-bootstrap.css">
	
	<!--Import daterangepicker css-->
	<link rel="stylesheet" href="/source/Static/assets/js/daterangepicker/daterangepicker-bs3.css">
	<link rel="stylesheet" href="/source/Static/assets/js/datetimepicker/css/bootstrap-datetimepicker.min.css">	
	
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>
	
	<!-- Bottom Scripts -->
	<script src="/source/Static/assets/js/bootstrap.min.js"></script>
	<script src="/source/Static/assets/js/TweenMax.min.js"></script>
	<script src="/source/Static/assets/js/resizeable.js"></script>
	<script src="/source/Static/assets/js/joinable.js"></script>
	<script src="/source/Static/assets/js/xenon-api.js"></script>
	<script src="/source/Static/assets/js/xenon-toggles.js"></script>
	<script src="/source/Static/assets/js/moment.min.js"></script>	
	
	<!-- Imported scripts on this page -->
	<script src="/source/Static/assets/js/daterangepicker/daterangepicker.js"></script>
	<script src="/source/Static/assets/js/datepicker/bootstrap-datepicker.js"></script>
	<script src="/source/Static/assets/js/timepicker/bootstrap-timepicker.min.js"></script>
	<script src="/source/Static/assets/js/datetimepicker/js/bootstrap-datetimepicker.js"></script>
	<script src="/source/Static/assets/js/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>

	<!-- Imported scripts on this page -->
	<script src="/source/Static/assets/js/jquery-validate/jquery.validate.min.js"></script>
	
	<!-- Imported dropzone scripts -->
	<script src="/source/Static/assets/js/dropzone/dropzone.min.js"></script>
	
	<!-- Imported dataTables scripts -->
	<script src="/source/Static/assets/js/datatables/js/jquery.dataTables.min.js"></script>
	<script src="/source/Static/assets/js/datatables/dataTables.bootstrap.js"></script>
	<script src="/source/Static/assets/js/datatables/yadcf/jquery.dataTables.yadcf.js"></script>
	<script src="/source/Static/assets/js/datatables/tabletools/dataTables.tableTools.min.js"></script>
		
	<!-- Imported scripts on this page -->
	<script src="/source/Static/assets/js/ckeditor/ckeditor.js"></script>
	<script src="/source/Static/assets/js/ckeditor/adapters/jquery.js"></script>
		
	<!-- Imported selectBoxIt on this page -->
	<script src="/source/Static/assets/js/select2/select2.min.js"></script>
	<script src="/source/Static/assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<script src="/source/Static/assets/js/multiselect/js/jquery.multi-select.js"></script>
	<script src="/source/Static/assets/js/tagsinput/bootstrap-tagsinput.min.js"></script>
	
	<!-- JavaScripts initializations and stuff -->
	<script src="/source/Static/assets/js/xenon-custom.js"></script>
	
	<!--自己的全局JavaScript代码-->
	<script src="/source/Static/common/js/functions.js"></script>
</body>
</html>