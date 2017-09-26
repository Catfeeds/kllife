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
    
	<meta content="领袖户外" name="author"/>
	<?php if(empty($PageKeyword) == false): ?><meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
	<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
	<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
	<title><?php echo ($PageKeyword["title"]); ?></title>
	<?php else: ?>
	<title><?php echo C('PAGE_TITLE');?>-领袖户外</title><?php endif; ?>
	
	<link rel="stylesheet" href="/source/Static/phone/common/css/light7.css">
	<link rel="stylesheet" href="/source/Static/common/css/common.css">
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="/source/Static/common/js/jquery-1.11.1.min.js"></script>
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
	<link rel="stylesheet" href="/source/Static/phone/css/images_list.css">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="javascript:history.back();">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">精彩分享</h1>
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
		
			<!-- 列表内容 -->
			<div class="list">
				<div class="list-content">
					<div class="content infinite-scroll infinite-scroll-bottom" data-distance="100">
			          <div class="list-block">
			              <ul class="list-container">
			              </ul>
			          </div>
			          
			      </div>
				</div>
			</div>
		
		</div>
		

</div>






<!-- light7 -->
<script src="/source/Static/phone/common/js/light7.js"></script>
<!-- i18n 中文 -->
<script src="/source/Static/phone/common/js/cn.js"></script>
<!--公用JS文件-->
<script src="/source/Static/common/js/functions.js"></script>
<script>
		
	
	
	
	$(function (){
		$.init();				
		// 无限加载
		var loading = false;
		// 最多可加载的条目
		var maxItems = 100;

		// 每次加载添加多少条目
		var itemsPerLoad = 8;

		function addItems(number, lastIndex) {
			// 生成新条目的HTML
			var html = '';
			for (var i = lastIndex + 1; i <= lastIndex + number; i++) {
				html += '<li class="item-content">' + '<div class="travel-content-list">'
											+'<div class="travel-content-sublist">'
												+'<div class="travel-content-img">'
													+'<img src="http://img.kllife.com/2017-02-06_5898247827dea.jpg" alt="">'
												+'</div>'
												+'<div class="travel-content-word">'
													+'<h4>喀纳斯-白哈巴-禾木-五彩滩-魔鬼城可可托海 9日深度游2</h4>'
												+'</div>'
												+'<a href="../content/content.html" external></a>'
											+'</div>'
										+'</div>' + '</li>';
			}
			// 添加新条目
			$('.infinite-scroll-bottom .list-container').append(html);

		}
		//预先加载20条
		addItems(itemsPerLoad, 0);

		// 上次加载的序号

		var lastIndex = 8;

		// 注册'infinite'事件处理函数
		$(document).on('infinite', '.infinite-scroll-bottom',function() {

			// 如果正在加载，则退出
			if (loading) return;

			// 设置flag
			loading = true;

			// 模拟1s的加载过程
			setTimeout(function() {
				// 重置加载flag
				loading = false;

				if (lastIndex >= maxItems) {
					// 加载完毕，则注销无限加载事件，以防不必要的加载
					$.detachInfiniteScroll($('.infinite-scroll'));
					// 删除加载提示符
					$('.infinite-scroll-preloader').remove();
					return;
				}

				// 添加新条目
				addItems(itemsPerLoad, lastIndex);
				// 更新最后加载的序号
				lastIndex = $('.list-container li').length;
				//容器发生改变,如果是js滚动，需要刷新滚动
				$.refreshScroller();
			}, 1000);
		});

		
	});
	</script>
</body>
</html>