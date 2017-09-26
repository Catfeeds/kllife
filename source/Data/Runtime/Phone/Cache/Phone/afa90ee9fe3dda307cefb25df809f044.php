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
	<style>
		body , .content { background:#fff; }
		.bar { z-index: 9; }
		.bar-nav { position: static; }
		.questions-content p { margin-bottom: .5rem; font-size: .65rem; color:#333; text-indent: 2em; line-height:1.8; }
	</style>
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
		
			<div class="questions-content">
				
				<div class="content-padded">
			
					<p>厚厚的"雪毯"、金红的雪山、蘑菇状的雪屋顶...雪乡，当你置身这个东北最美的雪世界，坐在狗拉雪橇上一路滑过梦幻般的雾凇林时，你会觉得雪乡这个地方似乎天生为影像而生，为追寻纯净梦想的旅游摄影爱好者而生。下面，跟随领袖户外脚步，一起到雪乡领略赏雪、玩雪的乐趣吧!</p>
					<p>对于旅游摄影爱好者而言，雪乡可谓名气不小。这颗镶嵌在黑龙江省东南部张广才岭东南坡的璀璨“明珠”，由于受山区小气候的偏爱，每年十月便开始瑞雪飘飘，一直飘到来年的阳春三月。整个冬季积雪厚度可达2米深，不仅雪质优良，雪量也堪称中国之最。</p>
					<p>驴友们可以从哈尔滨出发，拼车前往雪乡，近300公里的路程，将行驶6个小时左右。当车子进入盘山公路后，窗外的风景发生了奇异的变化。盘山公路宛如一条白色的玉带缠绕在群山的腰间，覆盖着厚厚白雪的红松林，瞬间化身为漫山美丽的圣诞树，而远处的山坡就像一幅水墨画般美不胜收。</p>
					<p>终于到了宁静的山村雪世界，下车跳到雪地上，踏着脚下松松软软的瑞雪，感觉舒服极了。放眼望去，半山上有一片小村庄，大概二十来户人家，家家门前挂着喜气的红灯笼，墙上挂满苞米、红辣椒和野兔等山间野味。再看炊烟袅袅的屋顶上，厚实的白雪就像大蛋糕上流淌下来的奶油，让人忍不住想抓一块下来尝尝。</p>
	
					
					
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