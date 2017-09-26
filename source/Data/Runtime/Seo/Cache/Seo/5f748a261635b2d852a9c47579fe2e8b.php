<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Xenon Boostrap Admin Panel" />
	<meta name="author" content="" />
	
	<title><?php echo C('PAGE_TITLE');?> - 优化系统</title>

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
    		conds == null || conds == '' ? conds = 'title|'+title : conds += '|title|'+title;
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
						<a href="http://kllife.com/seo" class="logo-expanded">
							<img src="/source/Static/assets/images/logo.png" width="80" alt="" />
						</a>
						
						<a href="http://kllife.com/seo" class="logo-collapsed">
							<img src="/source/Static/assets/images/logo.png" width="40" alt="" />
						</a>
					</div>
					
					<!-- This will toggle the mobile menu and will be visible only on mobile devices -->
					<div class="mobile-menu-toggle visible-xs">
						<a href="http://kllife.com/seo" data-toggle="user-info-menu">
							<i class="fa-bell-o"></i>
							<span class="badge badge-success">7</span>
						</a>
						
						<a href="http://kllife.com/seo" data-toggle="mobile-menu">
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
					<li <?php echo C('MENU_ACTIVE')=='line_article' ? 'class="active opened"' : '';?>>
						<a href="<?php echo U('line/article');?>/type/list">
							<i class="el-th"></i>
							<span class="title">我的文章</span>
						</a>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='lock_screen' ? 'class="active opened"' : '';?>>
						<a href="<?php echo U('user/lockscreen');?>">
							<i class="el-off"></i>
							<span class="title">锁屏</span>
						</a>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='question' ? 'class="active opened"' : '';?>>
						<a href="<?php echo U('index/question');?>">
							<i class="el-help"></i>
							<span class="title">关于</span>
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
<script src="/source/Static/assets/js/ckeditor/ckeditor.js"></script>
<style type="text/css">		
	.selectboxit-btn {background: #fff;border-color: #4EC83B;}	
	.selectboxit-list {	background-color: #fff;	border: 1px solid #4EC83B;}	
	.selectboxit-list .selectboxit-option-anchor {color: #979898;}	
	
</style>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"> 
					<?php echo C('CONTENT_TITLE');?>
					<input id="article_id" type="hidden" value="<?php echo ($article["id"]); ?>"/>
				</h3>
			</div>
			<div class="panel-body row">
				<div id="dingdan_main" class="col-sm-12">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="title">文章标题</label> <!--data-validate="required"-->
								<input class="form-control" maxlength="32" name="title" id="title" value="<?php echo ($article["title"]); ?>" placeholder="请输入文章的标题" />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label" for="short_title">文章短标题</label> <!--data-validate="required"-->
								<input class="form-control" maxlength="16" name="short_title" id="short_title" value="<?php echo ($article["short_title"]); ?>" placeholder="请输入文章的标题" />
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label class="control-label" for="keyword">关键字</label> <!--data-validate="required"-->
								<input class="form-control" name="keyword" id="keyword" value="<?php echo ($article["keywords"]); ?>" placeholder="请输入文章的关键字,多个关键字请用“，”隔开" />
							</div>
						</div>		
					</div>
					<div class="row">											
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label" for="send_word">文章寄语</label>
								<textarea class="form-control autogrow" name="send_word" id="send_word" placeholder="请输入文章寄语"><?php echo ($article["send_word"]); ?></textarea>
							</div>
						</div>					
					</div>
					<div class="row">		
						<div class="col-md-1">						
							<div class="form-group">
								<label class="control-label" for="hot">热点文章</label><br />
								<?php if($article["hot"] == 1): ?><input id="hot" name="hot" type="checkbox" checked="checked" class="iswitch iswitch-secondary">
								<?php else: ?>
							    	<input id="hot" name="hot" type="checkbox" class="iswitch iswitch-secondary"><?php endif; ?>
							</div>						
						</div>
						
						<div class="col-md-1">											
							<div class="form-group">
								<label class="control-label" for="recommend">推荐文章</label><br />						
								<?php if($article["recommend"] == 1): ?><input id="recommend" name="recommend"  type="checkbox" checked="checked" class="iswitch iswitch-secondary">
								<?php else: ?>
							    	<input id="recommend" name="recommend"  type="checkbox" class="iswitch iswitch-secondary"><?php endif; ?>	
							</div>							
						</div>	
						
						<div class="col-md-2">
							<div class="form-group">						
								<label class="control-label" for="classid">所属栏目</label>
								<script type="text/javascript">
									$(document).ready(function(){
										var classid_type = $("#classid").selectBoxIt();
										$(classid_type).data('selectBox-selectBoxIt').add({value:0, text:'首页'});
										$(classid_type).data('selectBox-selectBoxIt').add({value:1, text:'新疆专题'});
										$(classid_type).data('selectBox-selectBoxIt').add({value:38, text:'坝上专题'});
										$(classid_type).data('selectBox-selectBoxIt').add({value:43, text:'额济纳专题'});
									});
								</script>
								<select name="classid" id="classid" class="form-control">
								</select>						
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="form-group">
							<label class="control-label" for="keyword">文章内容</label>
							<textarea id="body" name="body" class="form-control ckeditor" rows="20" style="visibility: hidden; display: none;"><?php echo ($article["body"]); ?></textarea>
						</div>
					</div>
					
					<div class="row">							
						<div class="col-md-8">
							<div class="form-group">
								<button class="btn btn-secondary save_article">保存文章基本信息</button>
							</div>							
						</div>	
					</div>

					
				</div>
			</div>
		</div>
	</div>
</div>
<link rel="stylesheet" href="/source/Static/assets/js/wysihtml5/src/bootstrap-wysihtml5.css">
<script src="/source/Static/assets/js/wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
<script src="/source/Static/assets/js/wysihtml5/src/bootstrap-wysihtml5.js"></script>
<script src="/source/Static/assets/js/formwizard/jquery.bootstrap.wizard.min.js"></script>

<script>
	// 保存文章基本信息
	$('.save_article').click(function(){			
		var stitle = $('#title').val();
		if (stitle == '') {
			toastr.warning('文章标题不能为空');
			return false;
		}
		
		var shortTitle = $('#short_title').val();
		if (shortTitle == '') {
			toastr.warning('文章短标题标题不能为空');
			return false;
		}
		
		var keyWords = $('#keyword').val();
		var sendWords = $('#send_word').val();
		
		var jsonData = {
			op_type: 'create',
			id: $('#article_id').val(),
			title: stitle,
			short_title: shortTitle,
			keywords: keyWords,
			send_word: sendWords,
			hot: $('#hot').prop('checked') ? 1 : 0,
			recommend: $('#recommend').prop('checked') ? 1 : 0,
			classid: $('#classid').val(),
			body:$('#body').val(),
		}
		
		
		var articleId = $('#article_id').val();
		if (articleId != '' || articleId != 0) {
			jsonData['id'] = articleId;
		}
		
		$.post('<?php echo U("line/article");?>', jsonData, function(data){
			if (data.result.errno == 0) {
				$('#article_id').val(data.id);
				toastr.success('保存文章基本信息成功');
				$('.save_success_tip').html('请将鼠标移至横线下方开始添加修改文章内容...');
			} else {
				toastr.error(data.result.message);
				if (typeof(data.jumpUrl) != 'undefined') {
					location.href = data.jumpUrl;
				}
			}
		});
	});	
	
	// 初始化页面
	$(document).ready(function(){
		// 文章显示板块
		$('#classid').val('<?php echo ($article["classid"]); ?>').trigger('change');
	});
</script>
			<!-- Main Footer -->
			<!-- Choose between footer styles: "footer-type-1" or "footer-type-2" -->
			<!-- Add class "sticky" to  always stick the footer to the end of page (if page contents is small) -->
			<!-- Or class "fixed" to  always fix the footer to the end of page -->
			<footer class="main-footer sticky footer-type-1">
				
				<div class="footer-inner">
				
					<!-- Add your copyright text here -->
					<div style="text-align: center; font-family: '微软雅黑';">
						&copy; 版权所有&nbsp;[领袖户外-后台系统]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						更多信息请关注<a href="http://kllife.com/" target="_blank" title="领袖户外">[<strong><u>领袖户外</u></strong>]</a>
					</div>
					
					
				</div>
				
			</footer>
		</div>		
		
	</div> <!--div:page-container-->	
				
	<a class="main_scroll_top" href="javascript:;" style="position: fixed; left: 80px; bottom: 10px; display: block; width: 50px; height: 50px; z-index: 999; background-image: url(/source/Static/back/images/up.png); background-size: 100% 100%;"></a>
	<div class="page-loading-overlay">
		<div class="loader-2"></div>
	</div>
	
	<script type="text/javascript">
		$('.main_scroll_top').click(function(){
			$('html,body').animate({scrollTop: 0}, 1000);
		})
	</script>
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>

	<link rel="stylesheet" href="/source/Static/assets/js/select2/select2.css">
	<link rel="stylesheet" href="/source/Static/assets/js/select2/select2-bootstrap.css">
	<!--Import daterangepicker css-->
	<link rel="stylesheet" href="/source/Static/assets/js/daterangepicker/daterangepicker-bs3.css">
	<link rel="stylesheet" href="/source/Static/assets/js/datetimepicker/css/bootstrap-datetimepicker.min.css">	
	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="/source/Static/assets/js/fullcalendar/fullcalendar.min.css">
	
	<!-- Bottom Scripts -->
	<script src="/source/Static/assets/js/bootstrap.min.js"></script>
	<script src="/source/Static/assets/js/TweenMax.min.js"></script>
	<script src="/source/Static/assets/js/resizeable.js"></script>
	<script src="/source/Static/assets/js/joinable.js"></script>
	<script src="/source/Static/assets/js/xenon-api.js"></script>
	<script src="/source/Static/assets/js/xenon-toggles.js"></script>
	<script src="/source/Static/assets/js/moment.min.js"></script>
	
	<!-- Imported scripts on this page -->
	<script src="/source/Static/assets/js/fullcalendar/fullcalendar.min.js"></script>
	<script src="/source/Static/assets/js/jquery-ui/jquery-ui.min.js"></script>
	
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

	<!-- Import fileupload on this page -->
	<script src="/source/Static/assets/js/fileupload/js/jquery.fileupload.js"></script>
	<script src="/source/Static/assets/js/fileupload/js/vendor/jquery.ui.widget.js"></script>
	<script src="/source/Static/assets/js/fileupload/js/jquery.iframe-transport.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){$('footer').css('margin-top', '10px');});
	</script>
</body>
</html>