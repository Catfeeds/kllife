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
	<!-- swiper -->
	<link rel="stylesheet" href="/source/Static/phone/common/css/swiper-3.3.1.min.css">
	<!-- mycss -->
	<link rel="stylesheet" href="/source/Static/phone/css/welcome.css">
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
			<!-- 这里是页面内容区 -->
			<!-- slider -->
			<div class="swiper-container" >
				<div class="swiper-wrapper">
					
						
						<div class="swiper-slide"><a href="javascript:;" external><img src="<?php echo ($img); ?>" alt=""></a></div>
					
				</div>
			</div>

			<!-- 电话 -->
			<div class="telephone">
				<a href="tel:400-080-5860" external><img src="/source/Static/phone/images/index/telephone.png" alt=""></a>
			</div>
			
		

			<!-- 热卖专区 -->
			<div class="hot-sale">
			
				<div class="hot-sale-content">
					<!-- 切换 -->
					<div class="buttons-tab">
						<?php if(is_array($set["hot_line_tab"])): $i = 0; $__LIST__ = $set["hot_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><a href="#<?php echo ($tab["type_key"]); ?>" class="tab-link active button"><?php echo ($tab["type_desc"]); ?></a>
							<?php else: ?>
							<a href="#<?php echo ($tab["type_key"]); ?>" class="tab-link button"><?php echo ($tab["type_desc"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</div>
				    <div class="tabs">
						<?php if(is_array($set["hot_line_tab"])): $i = 0; $__LIST__ = $set["hot_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><div id="<?php echo ($tab["type_key"]); ?>" class="tab active">
							<?php else: ?>
							<div id="<?php echo ($tab["type_key"]); ?>" class="tab"><?php endif; ?>								
								<!-- 深度游 -->
								<div class="depth-travel">
									<div class="depth-travel-content">
										<div class="travel-content">
											<?php $__FOR_START_1733826024__=0;$__FOR_END_1733826024__=5;for($i=$__FOR_START_1733826024__;$i < $__FOR_END_1733826024__;$i+=1){ $v = $set[$tab['type_key'].$i] ?>												
												<div class="card demo-card-header-pic">
													<div class="card-content">
														<img src="<?php echo ($v["img"]); ?>" alt="">
														<div class="card-content-inner">
															<p><?php echo ($v["title"]); ?></p>
															<p><?php echo ($v["subheading"]); ?></p>
														</div>
														<!-- 跳转a -->
														<a href="<?php echo U('line/info');?>/id/<?php echo ($v["id"]); ?>" external></a>
													</div>
													<div class="card-footer">
														<span>出发地：<?php echo ($tab['type_desc']); ?></span>
														<a href="<?php echo U('line/info');?>/id/<?php echo ($v["id"]); ?>" class="link active-recommend"> 
														<span>￥<?php echo ($v["cut_price"]); ?>元起</span></a>
													</div>
												</div><?php } ?>

											<!-- 查看更多超值热卖 -->
											<!--<a href="<?php echo U('line/list');?>" external>查看更多超值热卖</a>-->
										</div>
									</div>
								</div>
							</div> <!--结束tab--><?php endforeach; endif; else: echo "" ;endif; ?>
				    </div>
				    
				</div>
			</div>
			<!-- 精彩游记 -->
			<div class="active-review">
				<div class="active-review-content">
					<div class="active-review-header">
						<img src="/source/Static/phone/images/index/sublist_logo.png" alt="">
						<span>精彩游记</span>
					</div>
					<div class="active-review-list">
						
						<?php $__FOR_START_637612955__=0;$__FOR_END_637612955__=3;for($i=$__FOR_START_637612955__;$i < $__FOR_END_637612955__;$i+=1){ $act = $set['activity'.$i] ?>
							<div class="active-review-sublist">
								<div class="card demo-card-header-pic">
									<div class="card-content">
										<img src="<?php echo ($act["img"]); ?>" alt="">
										<div class="card-content-inner">
											<p>主标题</p>
											<p><?php echo ($act["subheading"]); ?></p>
										</div>
										<!-- 跳转a -->
										<a href="<?php echo ($act["url"]); ?>" external></a>
									</div>
									
								</div>
							</div><?php } ?>						

						<div class="active-review-sublist">
							<div class="card demo-card-header-pic">
								<div class="card-content">
									<img src="/source/Static/phone/images/index/22.jpg" alt="">
									<div class="card-content-inner">
										<p>主标题</p>
										<p>2016年腾冲银杏、热海火山、北海湿地和顺古镇、瑞丽、大理双廊8日深度游</p>
									</div>
									<!-- 跳转a -->
									<a href="javascript:;" external></a>
								</div>
								
							</div>
						</div>

						<div class="active-review-sublist">
							<div class="card demo-card-header-pic">
								<div class="card-content">
									<img src="/source/Static/phone/images/index/33.jpg" alt="">
									<div class="card-content-inner">
										<p>主标题</p>
										<p>2016年腾冲银杏、热海火山、北海湿地和顺古镇、瑞丽、大理双廊8日深度游</p>
									</div>
									<!-- 跳转a -->
									<a href="javascript:;" external></a>
								</div>
								
							</div>
						</div>
					</div>
					<!-- 更多往期回顾 -->
					<a href="http://shequ.kllife.com/" external>更多精彩游记</a>
				</div>
				
			</div>
			<!-- end 活动回顾 -->
		</div>
	</div>
	
	

<!-- light7 -->
<script src="/source/Static/phone/common/js/light7.js"></script>
<!-- i18n 中文 -->
<script src="/source/Static/phone/common/js/cn.js"></script>
<!--公用JS文件-->
<script src="/source/Static/common/js/functions.js"></script>
	<!-- swiper -->
	<script src="/source/Static/phone/common/js/swiper-3.3.1.min.js"></script>
	
	<script>
		$(function(){
			
			$.init();

		});
	</script>


</body>
</html>