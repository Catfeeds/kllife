<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- 优先使用 IE 最新版本和 Chrome -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <!-- 1:1显示 -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- 忽略页面中的数字识别为电话号码和邮箱 -->
	<meta name="format-detection" content="telephone=no,email=no" />
	<!-- 允许全屏浏览 ios -->
	<meta content="yes" name="apple-mobile-web-app-capable" />
	<!-- 启用360浏览器的极速模式(webkit) -->
    <meta name="renderer" content="webkit">
    <!-- 避免IE使用兼容模式 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 不让百度转码 -->
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!-- 针对手持设备优化，主要是针对一些老的不识别viewport的浏览器，比如黑莓 -->
    <meta name="HandheldFriendly" content="true">
    <!-- 微软的老式浏览器 -->
    <meta name="MobileOptimized" content="320">
    <!-- uc强制竖屏 -->
    <meta name="screen-orientation" content="portrait">
    <!-- QQ强制竖屏 -->
    <meta name="x5-orientation" content="portrait">
	<!-- windows phone 点击无高光 -->
    <meta name="msapplication-tap-highlight" content="no">
	<title>领袖户外</title>
	<link rel="stylesheet" href="/source/Static/phone/common/css/light7.css">
	<link rel="stylesheet" href="/source/Static/common/css/common.css">
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="/source/Static/common/js/functions.js"></script>
	<!-- jq -->
	<script src="/source/Static/phone/common/js/jquery.min.js"></script>
	<style>
		.black-mark { display: none; position: fixed; top:0; left:0; width: 100%; height: 100%; text-align: center; color:#fff; background: rgba(0,0,0,.5); z-index:3000; }
		.black-mark p { margin-top: 230px; color: #fff; text-align: center; }
	</style>
	<script>
		
		function browserRedirect() {
			var sUserAgent = navigator.userAgent.toLowerCase();
			var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
			var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
			var bIsMidp = sUserAgent.match(/midp/i) == "midp";
			var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
			var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
			var bIsAndroid = sUserAgent.match(/android/i) == "android";
			var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
			var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
			if (bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM)
			{
				
				
			}else{
				window.location.href = window.location.href.replace(/phone/g,'home');
			}
		}
		browserRedirect();
	
		
		function ShowMark(){
			$('.black-mark').show();
		};
		function HideMark(){
			$('.black-mark').hide();
		};
		
	</script>
</head>
<body>
	<div class="black-mark">
		<p>稍等一会儿...</p>
	</div>
<div class="page">
	<!-- mycss -->
	<link rel="stylesheet" href="/source/Static/phone/css/help_center.css">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="javascript:history.back();">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">帮助中心</h1>
		</header>
			    <nav class="bar bar-tab">
		    <a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
		      <i class="iconfont">&#xe605;</i>
		      <p>首页</p>
		    </a>
		    <a class="tab-item" href="<?php echo U('line/list');?>" external>
		      <i class="iconfont">&#xe604;</i>
		      <p>目的地</p>
		    </a>
		    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
		      <i class="iconfont">&#xe602;</i>
		      <p>咨询</p>
		    </a>
		    <a class="tab-item" href="http://shequ.kllife.com" external>
		      <i class="iconfont">&#xe603;</i>
		      <p>社区</p>
		    </a>
		    <a class="tab-item" href="<?php echo U('user/info');?>" external>
		      <i class="iconfont">&#xe601;</i>
		      <p>我的</p>
		    </a>
		</nav>
		<script type="text/javascript">
			$('nav').find('a:last-child').click(function(){
				$.post('<?php echo U("index/url");?>', {type:'nav_mine'}, function(data){
					if (data.result.errno == 0) {
						if (data.jumpUrl != null) {
							location.href = data.jumpUrl;
						}
					} else {
						alert(data.result.message);
					}
				});
			});
		</script>
		
		<div class="content">
		
			<div class="content-padded">
				
				<!--付款与发票-->
				<div class="help-list">
					
					<h4>|<span>付款与发票</span></h4>
					
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					
				</div>
				
				<!--预定相关-->
				<div class="help-list">
					
					<h4>|<span>预定相关</span></h4>
					
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					
				</div>
				
				<!--账户管理-->
				<div class="help-list">
					
					<h4>|<span>账户管理</span></h4>
					
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					
				</div>
				
				<!--账户管理-->
				<div class="help-list">
					
					<h4>|<span>账户管理</span></h4>
					
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					
				</div>
				
				<!--合同相关-->
				<div class="help-list">
					
					<h4>|<span>合同相关</span></h4>
					
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					
				</div>
				
				<!--旅游保险-->
				<div class="help-list">
					
					<h4>|<span>旅游保险</span></h4>
					
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					
				</div>
				
				<!--其他问题-->
				<div class="help-list">
					
					<h4>|<span>其他问题</span></h4>
					
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					<a href="javascript:;" external>签约可以刷卡吗？</a>
					
				</div>
				
			</div>
		
		</div>
	
	
	

<!-- light7 -->
<script src="/source/Static/phone/common/js/light7.js"></script>
<!-- i18n 中文 -->
<script src="/source/Static/phone/common/js/cn.js"></script>
<!--公用JS文件-->
<script src="/source/Static/common/js/functions.js"></script>
</body>
</html>