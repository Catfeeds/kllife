<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta name="baidu-site-verification" content="7JiPIVdZ6K" />
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
	<?php if(strpos($_SERVER['HTTP_HOST'], '.kllife.com') !== FALSE): ?><meta name="robots" content="noindex,nofollow"/><?php endif; ?>
	<!--分销标题关键字-->
	<?php if(empty($duid) == false): if(C('MENU_CURRENT') == 'line_content'): ?><title><?php echo ($line["title"]); ?>-<?php echo ($line["subheading"]); ?></title>
		<?php else: ?>
			<title><?php echo ($fxset["shop_title"]["data"]["value"]); ?></title><?php endif; ?>
	<!--特殊专题额济纳标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_ejina'): ?>
		<title>额济纳旅游的首选__领袖户外旅行网__好玩不贵的小团慢旅行</title>
		<meta content="额济纳旅游的首选,领袖户外旅行网,好玩不贵的小团慢旅行" name="title"/>
	    <meta content="额济纳旅游,额济纳旅游攻略,额济纳旅游费用,额济纳旅游价格,额济纳胡杨林,额济纳旅游景点大全" name="keywords"/>
	    <meta content="额济纳旗，掉落在童话里的秋日，颠覆传统旅行方式，化腐朽为神奇的国庆精品线路。领袖户外：好玩不贵的小团慢旅行！,精品小团，享受一次恰到好处的慢旅行！在最美的风景中漫步、深呼吸，为不期而遇的惊艳停车，品味夕阳晨曦的美好，尽可能与美景相拥而眠，旅途中从陌生，变成朋友……" name="description"/>	
	<!--特殊专题新疆标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_xinjiang'): ?>
	    <title>新疆旅游的首选_领袖户外旅行网_好玩不贵的小团慢旅行_领袖户外官方网站</title>	
	    <meta content="新疆旅游的首选,领袖户外旅行网,好玩不贵的小团慢旅行,领袖户外官方网站" name="title"/>
	    <meta content="新疆旅游,新疆旅游攻略,新疆旅游费用,新疆旅游价格,新疆旅游景点大全,新疆驴友网,禾木驴友网,新疆驴友攻略,喀纳斯驴友网,新疆定制游" name="keywords"/>
	    <meta content="新疆旅游攻略，小团慢旅行,新疆自助游攻略，包括小团慢旅行,新疆热门景点、户外俱乐部、游记攻略、出行交通、餐饮等旅游信息，以及小团慢旅行,新疆驴友交流、驴友俱乐部信息。小团慢旅行,新疆旅游怎么订制。" name="description"/>	
	<!--特殊专题丝绸之路标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_silk'): ?>
	    <meta content="青海湖旅游攻略,青海湖旅游价格,敦煌旅游景点,敦煌旅游价格,青海驴友线路,青海驴友攻略,茶卡盐湖门票多钱,茶卡盐湖什么时候去好玩" name="keywords"/>
	    <meta content="300度环青海湖旅行，长达三天湖边游玩时间，避开顶光去茶卡，这是丝绸之路线路中最好的体验。丝绸之路旅游去哪儿玩？领袖户外为您独家定制专属线路,从青海湖到敦煌莫高窟,从嘉峪关到祁连山....更多的西北旅游信息就来领袖户外旅行网。" name="description"/>
		<title>丝绸之路旅游线路推荐-青海驴友俱乐部-甘肃驴友俱乐部-领袖户外旅行网-好玩不贵的小团慢旅行-茶卡盐湖驴友俱乐部</title>	
	<!--特殊专题西北标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_xibei'): ?>
	    <meta content="西北旅游,西北旅游线路,西北摄影旅游,青海湖旅游,青海湖旅游线路,青海湖摄影旅游,额济纳旅游线路,额济纳摄影旅游,额济纳旅游,额济纳旅游线路,额济纳摄影旅游,甘肃旅游,甘肃旅游线路,甘肃摄影旅游" name="keywords"/>
	    <meta content="西北摄影旅游去哪儿玩？领袖户外为您独家定制专属线路,从青海湖到敦煌莫高窟,从嘉峪关到祁连山....更多的西北旅游信息就来路星河" name="description"/>
		<title>西北旅游-青海湖旅游-额济纳旅游-甘肃旅游-西北旅游线路推荐-领袖户外</title>
	<!--特殊专题川西标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_chuanxi'): ?>
	    <meta content="川西旅游,甘南旅游,川西甘南" name="keywords"/>
	    <meta content="川西甘南旅游推荐，色达甘南稻城亚丁，你无法拒绝的美景" name="description"/>
		<title>川西甘南-川西甘南大环线-川西甘南景点推荐-领袖户外旅游网</title>	
	<!--特殊专题brand标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_brand'): ?>
	    <meta content="领袖户外,发展历程,品牌故事,联系方式" name="keywords"/>
	    <meta content="领袖户外成立于2005年，致力于为客户提供小团慢旅行、摄影游、户外游以及定制游等旅游产品。领袖户外以“享受旅行，品味人生”为愿景，以“为用户提供参与感强体验度高的旅行”为使命，精心为游客提供深度旅行服务。" name="description"/>
		<title>领袖户外品牌故事-领袖户外发展历程-领袖户外联系方式-领袖户外旅行网-驴友网</title>
	<!--通用标题关键字-->
	<?php elseif(empty($PageKeyword) == false): ?>
		<meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
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
	<!--<script src="/source/Static/phone/common/js/jquery.min.js"></script>-->
	<style>
		.black-mark { display: none; position: fixed; top:0; left:0; width: 100%; height: 100%; text-align: center; color:#ececec; background: rgba(0,0,0,.5); z-index:3000; }
		.black-mark p { margin-top: 230px; color: #fff; text-align: center; }
	</style>
	<script>			
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
<body>
	<!-- mycss -->
	<link rel="stylesheet" href="/source/Static/phone/css/user_info.css">
	<div class="page page-current" id="router">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="#">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">个人中心</h1>
		</header>
			    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>游记</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a>
	    	<?php else: ?>
			    <a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a><?php endif; ?>
		</nav>
		<!--<script src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>-->
		<script type="text/javascript">
//            jQuery(document).ready(function($){
//                $("img").lazyload({
//                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
//                    effect      : "fadeIn",
//                    threshold : 0,
//                    failure_limit : 10,
//                    skip_invisible : false
//                });
//            });

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
			<div class="my-header">
				<div class="my-header-img">
					<img src="<?php echo ($user["face"]); ?>" alt="">
				</div>
				<input type="file" accept="image/*" id="change-img">
				<!-- 登录后显示名字 -->
				<p><?php echo ($user["show_name"]); ?>(<?php echo ($user["id"]); ?>)</p>
			</div>
			<!-- 订单列表 -->
			<div class="my-order-list">
				<div class="row no-gutter">
					<div class="col-20">
						<img src="/source/Static/phone/images/user_info/1.png" alt="">
						<p><span style="display: block;">全部订单</span>(<?php echo ($OrderAllCount); ?>)</p>
						<a href="<?php echo U('line/order');?>/type/center" external></a>
					</div>
					<div class="col-20">
						<img src="/source/Static/phone/images/user_info/2.png" alt="">
						<p><span style="display: block;">待付款</span>(<?php echo ($OrderReviewCount); ?>)</p>
						<a href="<?php echo U('line/order');?>/type/center/state/review" external></a>
					</div>
					<div class="col-20">
						<img src="/source/Static/phone/images/user_info/3.png" alt="">
						<p><span style="display: block;">已付部分款</span>(<?php echo ($OrderPayPartCount); ?>)</p>
						<a href="<?php echo U('line/order');?>/type/center/state/pay_part" external></a>
					</div>
					<div class="col-20">
						<img src="/source/Static/phone/images/user_info/4.png" alt="">
						<p><span style="display: block;">已付全款</span>(<?php echo ($OrderPayComplateCount); ?>)</p>
						<a href="<?php echo U('line/order');?>/type/center/state/pay_complate" external></a>
					</div>
					<div class="col-20">
						<img src="/source/Static/phone/images/user_info/5.png" alt="">
						<p><span style="display: block;">待评价</span>(<?php echo ($OrderComplatedCount); ?>)</p>
						<a href="<?php echo U('line/order');?>/type/center/state/complated" external></a>
					</div>
				</div>
			</div>
			<!-- 我的消息等 -->
			<div class="personal-center-content">
				<div class="personal-center">
					<div class="personal-center-fir">	
						<!-- 我的消息 -->
						<div class="my-msg personal-center-list">
							<div class="content-padded">
								<a href="#routers-index-inner-1"></a>
								<i class="iconfont">&#xe61a;</i>
								<span>我的消息</span>
								<i class="iconfont">&#xe60f;</i>
							</div>
						</div>
						<!-- 我的订单 -->
						<div class="my-order personal-center-list">
							<div class="content-padded">
								<a href="<?php echo U('line/order');?>/type/center" external></a>
								<i class="iconfont">&#xe612;</i>
								<span>我的订单</span>
								<i class="iconfont">&#xe60f;</i>
							</div>
						</div>
						<!-- 我的优惠券 -->
						<div class="my-coupon personal-center-list">
							<div class="content-padded">
								<a href="#routers-index-inner-3"></a>
								<i class="iconfont">&#xe617;</i>
								<span>我的优惠券</span>
								<i class="iconfont">&#xe60f;</i>
							</div>
						</div>
						<!-- 我的积分 -->
						<div class="my-code personal-center-list">
							<div class="content-padded">
								<a href="#routers-index-inner-4"></a>
								<i class="iconfont">&#xe614;</i>
								<span>我的积分</span>
								<i class="iconfont">&#xe60f;</i>
							</div>
						</div>
					</div>
					<div class="personal-center-sec">
						<!-- 个人信息 -->
						<div class="personal-msg personal-center-list">
							<div class="content-padded">
								<a href="#routers-index-inner-5"></a>
								<i class="iconfont">&#xe616;</i>
								<span>个人信息</span>
								<i class="iconfont">&#xe60f;</i>
							</div>
						</div>
						<!-- 绑定手机 -->
						<div class="bind-phone personal-center-list">
							<div class="content-padded">
								<a href="#routers-index-inner-6"></a>
								<i class="iconfont">&#xe610;</i>
								<span>绑定手机</span>
								<i class="iconfont">&#xe60f;</i>
							</div>
						</div>
						<!-- 绑定邮箱 -->
						<div class="bind-mail personal-center-list">
							<div class="content-padded">
								<a href="#routers-index-inner-7"></a>
								<i class="iconfont">&#xe618;</i>
								<span>绑定邮箱</span>
								<i class="iconfont">&#xe60f;</i>
							</div>
						</div>
						<!-- 修改密码 -->
						<div class="change-psd personal-center-list">
							<div class="content-padded">
								<a href="#routers-index-inner-8"></a>
								<i class="iconfont">&#xe613;</i>
								<span>修改密码</span>
								<i class="iconfont">&#xe60f;</i>
							</div>
						</div>
						<!-- 绑定授权 -->
						<div class="bind-authority personal-center-list">
							<div class="content-padded">
								<a href="#routers-index-inner-9"></a>
								<i class="iconfont">&#xe615;</i>
								<span>绑定授权</span>
								<i class="iconfont">&#xe60f;</i>
							</div>
						</div>
						<!-- 帮助中心 -->
						<div class="bind-help personal-center-list">
							<div class="content-padded">
								<a href="<?php echo U('service/center');?>" external></a>
								<i class="iconfont">&#xe683;</i>
								<span>帮助中心</span>
								<i class="iconfont">&#xe60f;</i>
							</div>
						</div>
						<!-- 退出账号 -->
						<div class="bind-exit personal-center-list">
							<div class="content-padded">
								<a href="javascript:;" class="user_logout" external></a>
								<i class="iconfont">&#xe611;</i>
								<span>注销账号</span>
							</div>
						</div>
					</div>

				</div>
			</div>			
			<script type="text/javascript">
				$('.user_logout').click(function(){
					logoutShequ('<?php echo U("user/exit");?>', 1);
				});
			</script>
		</div>
	</div>
	<!-- 我的消息 -->
	<div class="page" id="routers-index-inner-1">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="#">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">我的消息</h1>
		</header>
			    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>游记</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a>
	    	<?php else: ?>
			    <a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a><?php endif; ?>
		</nav>
		<!--<script src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>-->
		<script type="text/javascript">
//            jQuery(document).ready(function($){
//                $("img").lazyload({
//                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
//                    effect      : "fadeIn",
//                    threshold : 0,
//                    failure_limit : 10,
//                    skip_invisible : false
//                });
//            });

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
				<?php if(is_array($messages)): $i = 0; $__LIST__ = $messages;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$msg): $mod = ($i % 2 );++$i;?><div class="my-msg-content">
						<h6><?php echo ($msg["send_time"]); ?></h6>
						<div class="my-msg-information">
							<div class="content-padded">
								<div class="row no-gutter">
									<div class="col-10"><img src="/source/Static/phone/images/user_info/msg.png" alt=""></div>
									<div class="col-90"><p><?php echo ($msg["content"]); ?></p></div>
								</div>
							</div>
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	</div>
	<!-- 我的订单跳转订单页 -->
	
	<!-- 我的优惠券 -->
	<div class="page" id="routers-index-inner-3">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="#">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">我的优惠券</h1>
		</header>
			    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>游记</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a>
	    	<?php else: ?>
			    <a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a><?php endif; ?>
		</nav>
		<!--<script src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>-->
		<script type="text/javascript">
//            jQuery(document).ready(function($){
//                $("img").lazyload({
//                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
//                    effect      : "fadeIn",
//                    threshold : 0,
//                    failure_limit : 10,
//                    skip_invisible : false
//                });
//            });

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
			<div class="buttons-tab">
				<a href="#tab1" class="tab-link coupon-link active button">未使用</a>
				<a href="#tab2" class="tab-link coupon-link button">已使用</a>
				<a href="#tab3" class="tab-link coupon-link button">已失效</a>
			</div>
			<div class="my-coupon-content">
				<div class="tabs">
					<!-- 未使用 -->
					<div id="tab1" class="tab active my-coupon-information">
						<div class="content-padded">
							<?php if(is_array($coupon_normal)): $i = 0; $__LIST__ = $coupon_normal;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$coupon): $mod = ($i % 2 );++$i;?><div class="row no-gutter">
									<div class="col-70">
										<div class="content-padded">
											<p>每人每次限用一张</p>
											<span>本劵有效期<?php echo ($coupon["valid_time"]); ?>到<?php echo ($coupon["invalid_time"]); ?></span>
										</div>
									</div>
									<div class="col-30">
										<div class="content-padded">
											<p><span data-money='<?php echo ($coupon["money"]); ?>'><?php echo ($coupon["money"]); ?></span>元</p>
											<strong>现金券</strong>
										</div>
									</div>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<!-- 已使用 -->
					<div id="tab2" class="tab my-coupon-information">
						<div class="content-padded">
							<?php if(is_array($coupon_use)): $i = 0; $__LIST__ = $coupon_use;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$coupon): $mod = ($i % 2 );++$i;?><div class="row no-gutter">
									<div class="col-70">
										<div class="content-padded">
											<p>每人每次限用一张</p>
											<span>本劵有效期<?php echo ($coupon["valid_time"]); ?>到<?php echo ($coupon["invalid_time"]); ?></span>
										</div>
									</div>
									<div class="col-30 my-coupon-used">
										<div class="content-padded">
											<p><span data-money='<?php echo ($coupon["money"]); ?>'><?php echo ($coupon["money"]); ?></span>元</p>
											<strong>现金券</strong>
											<img src="/source/Static/phone/images/user_info/used.png" alt="">
										</div>
									</div>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>							
						</div>
					</div>
					<!-- 已失效 -->
					<div id="tab3" class="tab my-coupon-information">
						<div class="content-padded">
							<?php if(is_array($coupon_invalid)): $i = 0; $__LIST__ = $coupon_invalid;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$coupon): $mod = ($i % 2 );++$i;?><div class="row no-gutter">
									<div class="col-70">
										<div class="content-padded">
											<p>每人每次限用一张</p>
											<span>本劵有效期<?php echo ($coupon["valid_time"]); ?>到<?php echo ($coupon["invalid_time"]); ?></span>
										</div>
									</div>
									<div class="col-30 my-coupon-invalid">
										<div class="content-padded">
											<p><span data-money='<?php echo ($coupon["money"]); ?>'><?php echo ($coupon["money"]); ?></span>元</p>
											<strong>现金券</strong>
											<img src="/source/Static/phone/images/user_info/invalid.png" alt="">
										</div>
									</div>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- 我的积分 -->
	<div class="page" id="routers-index-inner-4">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="#">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">我的积分</h1>
		</header>
			    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>游记</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a>
	    	<?php else: ?>
			    <a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a><?php endif; ?>
		</nav>
		<!--<script src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>-->
		<script type="text/javascript">
//            jQuery(document).ready(function($){
//                $("img").lazyload({
//                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
//                    effect      : "fadeIn",
//                    threshold : 0,
//                    failure_limit : 10,
//                    skip_invisible : false
//                });
//            });

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
			<div class="buttons-tab">
				<a href="#tab11" class="tab-link active button">论坛积分</a>
				<a href="#tab22" class="tab-link button">网站积分</a>
			</div>
			<div class="content-padded">
				<div class="tabs">
					<div id="tab11" class="tab active">
						<p>论坛积分：<?php echo ($user["score_forum"]); ?></p>
					</div>
					<div id="tab22" class="tab">
						<p>网站积分：<?php echo ($user["score_net"]); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- 个人信息 -->
	<div class="page" id="routers-index-inner-5">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="#">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">个人信息</h1>
		</header>
			    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>游记</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a>
	    	<?php else: ?>
			    <a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a><?php endif; ?>
		</nav>
		<!--<script src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>-->
		<script type="text/javascript">
//            jQuery(document).ready(function($){
//                $("img").lazyload({
//                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
//                    effect      : "fadeIn",
//                    threshold : 0,
//                    failure_limit : 10,
//                    skip_invisible : false
//                });
//            });

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
		<div class="content personal-msg-content">
			<div class="list-block">
				<div class="item-content">
					<div class="item-inner">
						<div class="item-title label">姓名</div>
						<div class="item-input">
				  			<input id="name" type="text" placeholder="输入您的姓名" value="<?php echo ($user["name"]); ?>">
						</div>
					</div>
	            </div>
				<div class="item-content">
					<div class="item-inner">
						<div class="item-title label">昵称</div>
						<div class="item-input">
				  			<input id="nickname" type="text" placeholder="输入您的昵称" value="<?php echo ($user["nickname"]); ?>">
						</div>
					</div>
	            </div>
	            <div class="item-content">
					<div class="item-inner">
						<div class="item-title label">性别</div>
						<div class="item-input">
				  			<input type="text" placeholder="请选择您的性别" id="picker-sex" readonly="" value="<?php echo get_sex($user['sex']);?>">
						</div>
					</div>
	            </div>
	            <div class="item-content">
					<div class="item-inner">
						<div class="item-title label">星座</div>
						<div class="item-input">
				  			<input type="text" placeholder="请选择您的星座" id="picker-constellation" readonly="" value="<?php echo get_constellation($user['constellation']);?>">
						</div>
					</div>
	            </div>
	            <div class="item-content">
					<div class="item-inner">
						<div class="item-title label">出生日期</div>
						<div class="item-input">
				  			<input type="text" placeholder="请选择您的出生日期" id="picker-birth" readonly="" value="<?php echo ($user["birthday"]); ?>" data-toggle='date'>
						</div>
					</div>
	            </div>
	            <div class="item-content">
					<div class="item-inner">
						<div class="item-title label">个性签名</div>
						<div class="item-input">
				  			<input id="signature" type="text" maxlength="20" placeholder="输入您的个性签名" value="<?php echo ($user["signature"]); ?>">
						</div>
					</div>
	            </div>
	            <div class="item-content" style="color: #a00;">
	            </div>
			</div>
			<a class="save_user_info" href="javascript:;" external>保存</a>
		</div>
	</div>
	<script type="text/javascript">
		// 		
		$('#routers-index-inner-5').find('.save_user_info').click(function(){
			var brithDate = $('#routers-index-inner-5').find('#picker-birth').val();
			var birth = ''
			if (brithDate.indexOf('-') != -1){
				birth = brithDate;
			} else {
				brithDate = brithDate.split(' ')
				birth = brithDate[0] + '-' + brithDate[1] + '-' + brithDate[2];
			}
			
			var userId = '<?php echo ($user["id"]); ?>';
			var jsonData = {
				type: 'modify_base',
				name: $('#routers-index-inner-5').find('#name').val(),
				nickname: $('#routers-index-inner-5').find('#nickname').val(),
				birthday: birth,
				sex: getSex($('#routers-index-inner-5').find('#picker-sex').val()),
				constellation: getConstellation($('#routers-index-inner-5').find('#picker-constellation').val()),
				signature:	$('#routers-index-inner-5').find('#signature').val(),
			};
			
			$.post('<?php echo U("user/manager");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					location.href = '<?php echo U("user/info");?>';
				} else {
					$('#routers-index-inner-5').find('.item-content:last').html(data.result.message);
				}				
			});
		});
	</script>
	
	<!-- 绑定手机 -->
	<div class="page" id="routers-index-inner-6">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="#">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">设置绑定手机1/2</h1>
		</header>
			    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>游记</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a>
	    	<?php else: ?>
			    <a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a><?php endif; ?>
		</nav>
		<!--<script src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>-->
		<script type="text/javascript">
//            jQuery(document).ready(function($){
//                $("img").lazyload({
//                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
//                    effect      : "fadeIn",
//                    threshold : 0,
//                    failure_limit : 10,
//                    skip_invisible : false
//                });
//            });

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
		<div class="content bind-phone-content">
			<div class="list-block">
				<div class="item-content">
					<div class="item-inner">
						<div class="item-title label">手机号</div>
						<div class="item-input">
				  			<input class="phone_text" type="number" maxlength="11" placeholder="输入您的手机号">
						</div>
					</div>
	            </div>
	        </div>
			<a class="send-phone-code" href="#routers-index-inner-6-1">下一步验证手机号</a>
		</div>
	</div>
	<script type="text/javascript">
		// 电话数据发送
		function _ajaxPhone(sPhone, sCode, nCheck) {
			var msgObj = $('#routers-index-inner-6-1').find('.content-padded p');
			var codeObj = $('#routers-index-inner-6-1').find('.write-phone-code');
			$(msgObj).css('color', '#a00');
			if (sPhone == '') {
				$(msgObj).html('电话不能为空');
				return false;
			}
			if (nCheck == 1 && sCode == '') {
				$(msgObj).html('验证码不能为空');
				return false;
			}
			var userId = '<?php echo ($user["id"]); ?>';
			var jsonData = {
				type: 'modify_phone',
				user_id: userId,
				phone: sPhone,
				code: sCode,
				check: nCheck,
			};
			$.post('<?php echo U("user/manager");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					if (nCheck == 0) {
						$(msgObj).css('color', '#0a0;');
						$(msgObj).html('验证码已发送至'+sPhone);
					} else {
						location.href = '<?php echo U("user/info");?>';
					}
				} else {
					$(msgObj).html(data.result.message);
					$(codeObj).val('');
				}				
			});
		}
		// 发送电话验证码
		$('#routers-index-inner-6').find('.send-phone-code').click(function(data){
			var phone = $('#routers-index-inner-6').find('.phone_text').val();
			_ajaxPhone(phone, '', 0);
		});		
	</script>
	<div class="page" id="routers-index-inner-6-1">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="#">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">设置绑定手机2/2</h1>
		</header>
			    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>游记</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a>
	    	<?php else: ?>
			    <a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a><?php endif; ?>
		</nav>
		<!--<script src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>-->
		<script type="text/javascript">
//            jQuery(document).ready(function($){
//                $("img").lazyload({
//                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
//                    effect      : "fadeIn",
//                    threshold : 0,
//                    failure_limit : 10,
//                    skip_invisible : false
//                });
//            });

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
		<div class="content bind-phone-content">
			<div class="content-padded">
				<p></p>
			</div>
			<div class="list-block">
				<div class="item-content">
					<div class="item-inner">
						<div class="item-title label">验证码</div>
						<div class="item-input">
				  			<input class="write-phone-code" type="text" maxlength="6" placeholder="输入您的验证码">
						</div>
					</div>
	            </div>
	        </div>
			<a class="sure-phone" href="javascript:;" external>完成</a>
		</div>
	</div>
	<script type="text/javascript">		
		// 修改电话
		$('#routers-index-inner-6-1').find('.sure-phone').click(function(data){
			var phone = $('#routers-index-inner-6').find('.phone_text').val();
			var code = $('#routers-index-inner-6-1').find('.write-phone-code').val();
			_ajaxPhone(phone, code, 1);
		});
	</script>
	
	<!-- 绑定邮箱 -->
	<div class="page" id="routers-index-inner-7">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="#">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">设置绑定邮箱1/2</h1>
		</header>
			    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>游记</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a>
	    	<?php else: ?>
			    <a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a><?php endif; ?>
		</nav>
		<!--<script src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>-->
		<script type="text/javascript">
//            jQuery(document).ready(function($){
//                $("img").lazyload({
//                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
//                    effect      : "fadeIn",
//                    threshold : 0,
//                    failure_limit : 10,
//                    skip_invisible : false
//                });
//            });

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
		<div class="content bind-phone-content">
			<div class="list-block">
				<div class="item-content">
					<div class="item-inner">
						<div class="item-title label">邮箱地址</div>
						<div class="item-input">
				  			<input class="email_text" type="text" placeholder="输入您的邮箱地址">
						</div>
					</div>
	            </div>
	        </div>
			<a class="send-mail-code" href="#routers-index-inner-7-1">下一步验证邮箱</a>
		</div>
	</div>
	<script type="text/javascript">		
		// 邮箱数据发送
		function _ajaxEmail(sEmail, sCode, nCheck) {
			var msgObj = $('#routers-index-inner-7-1').find('.content-padded p');
			var codeObj = $('#routers-index-inner-7-1').find('.write-mail-code');
			$(msgObj).css('color', '#a00');
			if (sEmail == '') {
				$(msgObj).html('邮件不能为空');
				return false;
			}
			if (nCheck == 1 && sCode == '') {
				$(msgObj).html('验证码不能为空');
				return false;
			}
			var userId = '<?php echo ($user["id"]); ?>';
			var jsonData = {
				type: 'modify_email',
				user_id: userId,
				email: sEmail,
				code: sCode,
				check: nCheck,
			};
			$.post('<?php echo U("user/manager");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					if (nCheck == 0) {
						$(msgObj).css('color', '#0a0');
						$(msgObj).html('验证码已发送至'+sEmail);
						location.href = '#routers-index-inner-7-1';
					} else {
						location.href = '<?php echo U("user/info");?>';
					}
				} else {
					$(msgObj).html(data.result.message);
					$(codeObj).val('');
				}				
			});
		}
		
		// 发送邮箱验证码
		$('#routers-index-inner-7').find('.send-mail-code').click(function(data){
			var email = $('#routers-index-inner-7').find('.email_text').val();
			_ajaxEmail(email, '', 0);
		});
	</script>
	<div class="page" id="routers-index-inner-7-1">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="#">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">设置绑定邮箱2/2</h1>
		</header>
			    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>游记</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a>
	    	<?php else: ?>
			    <a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a><?php endif; ?>
		</nav>
		<!--<script src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>-->
		<script type="text/javascript">
//            jQuery(document).ready(function($){
//                $("img").lazyload({
//                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
//                    effect      : "fadeIn",
//                    threshold : 0,
//                    failure_limit : 10,
//                    skip_invisible : false
//                });
//            });

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
		<div class="content bind-phone-content">
			<div class="content-padded">
				<p></p>
			</div>
			<div class="list-block">
				<div class="item-content">
					<div class="item-inner">
						<div class="item-title label">验证码</div>
						<div class="item-input">
				  			<input class="write-mail-code" type="text" maxlength="6" placeholder="输入您的邮箱验证码">
						</div>
					</div>
	            </div>
	        </div>
			<a class="sure-mail" href="javascript:;" external>完成</a>
		</div>
	</div>
	<script type="text/javascript">		
		// 修改邮箱
		$('#routers-index-inner-7-1').find('.sure-mail').click(function(data){
			var email = $('#routers-index-inner-7').find('.email_text').val();
			var code = $('#routers-index-inner-7-1').find('.write-mail-code').val();
			_ajaxEmail(email, code, 1);
		});
	</script>

	<!-- 修改密码 -->
	<div class="page" id="routers-index-inner-8">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="#">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">修改密码1/2</h1>
		</header>
			    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>游记</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a>
	    	<?php else: ?>
			    <a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a><?php endif; ?>
		</nav>
		<!--<script src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>-->
		<script type="text/javascript">
//            jQuery(document).ready(function($){
//                $("img").lazyload({
//                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
//                    effect      : "fadeIn",
//                    threshold : 0,
//                    failure_limit : 10,
//                    skip_invisible : false
//                });
//            });

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
		<div class="content change-psd-content">
			<div class="list-block">
				<div class="item-content">
					<div class="item-inner">
						<div class="item-title label">原密码</div>
						<div class="item-input">
				  			<input id="password_old" type="password">
						</div>
					</div>
	            </div>
	            <div class="item-content">
	            	<div class="item-inner">
						<div class="item-title label">新密码</div>
						<div class="item-input">
				  			<input id="new_password" type="password">
						</div>
					</div>
	            </div>
	            <div class="item-content">
	            	<div class="item-inner">
						<div class="item-title label">重复密码</div>
						<div class="item-input">
				  			<input id="password_confirm" type="password">
						</div>
					</div>
	            </div>	
	        </div>
			<a class="sure-psd" href="#routers-index-inner-8-1">完成</a>
		</div>
	</div>
	<script type="text/javascript">
		// 修改密码
		$('#routers-index-inner-8').find('.sure-psd').click(function(){
			var newPassword = $('#new_password').val();
			var confirmPassword = $('#password_confirm').val();
			//原密码输入为空
			if($('#password_old').val() == ''){
				alert('密码输入不能为空');
				return false;
			}
			//两次输入密码不一致且为空
			if (newPassword != confirmPassword || newPassword == '' || confirmPassword == '') {
				alert('两次输入的密码不一致');
				return false;
			}
			var userId = '<?php echo ($user["id"]); ?>';
			var jsonData = {
				type: 'modify_password',
				id: userId,
				password: $('#password_old').val(),
				new_password: newPassword,
			};
			$.post('<?php echo U("user/manager");?>', jsonData, function(data){
				var pObj = $('#routers-index-inner-8-1').find('.change-psd-content-sub').find('p');
				if (data.result.errno == 0) {
					$(pObj).attr('style','color: green;');
					$(pObj).html('修改密码成功');
				} else {
					$(pObj).attr('style','color: red;');
					$(pObj).html(data.result.message);
				}				
			});
		});
	</script>
	<div class="page" id="routers-index-inner-8-1">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="#">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">修改密码2/2</h1>
		</header>
			    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>游记</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a>
	    	<?php else: ?>
			    <a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a><?php endif; ?>
		</nav>
		<!--<script src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>-->
		<script type="text/javascript">
//            jQuery(document).ready(function($){
//                $("img").lazyload({
//                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
//                    effect      : "fadeIn",
//                    threshold : 0,
//                    failure_limit : 10,
//                    skip_invisible : false
//                });
//            });

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
			<div class="change-psd-content-sub">
				<img src="/source/Static/phone/images/user_info/ok.png" alt="">
				<p></p>
				<a href="<?php echo U('index/welcome');?>" external>返回首页</a>
				<a href="<?php echo U('user/info');?>" external>返回个人中心</a>
			</div>
		</div>
	</div>
	
	<!-- 绑定授权 -->
	<div class="page" id="routers-index-inner-9">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="#">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">绑定授权</h1>
		</header>
			    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>游记</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a>
	    	<?php else: ?>
			    <a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a><?php endif; ?>
		</nav>
		<!--<script src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>-->
		<script type="text/javascript">
//            jQuery(document).ready(function($){
//                $("img").lazyload({
//                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
//                    effect      : "fadeIn",
//                    threshold : 0,
//                    failure_limit : 10,
//                    skip_invisible : false
//                });
//            });

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
			<div class="bind-authority-content">
				<div class="content-padded">
					<div class="row no-gutter">
						<div class="col-20"><img src="/source/Static/phone/images/user_info/qq.png" alt=""></div>
						<?php if(empty($user['openid'])): ?><div class="col-40">QQ<img src="/source/Static/phone/images/user_info/warn.png" alt=""><span>未绑定</span></div>
							<div class="col-40"><a href="<?php echo U('thirdLogin/login');?>/type/weixin/" target="_blank" external>添加绑定</a></div>
						<?php else: ?>
							<div class="col-40">QQ</div>
							<div class="col-40"><a external>已绑定</a></div><?php endif; ?>
					</div>
					<div class="row no-gutter">
						<div class="col-20"><img src="/source/Static/phone/images/user_info/wx.png" alt=""></div>
						<?php if(empty($user['unionid'])): ?><div class="col-40">微信<img src="/source/Static/phone/images/user_info/warn.png" alt=""><span>未绑定</span></div>
							<div class="col-40"><a href="<?php echo U('thirdLogin/login');?>/type/weixin/" target="_blank" external>添加绑定</a></div>
						<?php else: ?>
							<div class="col-40">微信</div>
							<div class="col-40"><a external>已绑定</a></div><?php endif; ?>
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
    //加载指示
    function PageLoading() {
    	this.loaded = false;
    }
    
    PageLoading.prototype.isLoading = function () {
    	return this.loaded;
    }
    
    PageLoading.prototype.loading = function (bshow, bstyle) {
    	this.loaded = bshow;
    	if (bstyle == null || bstyle == true) {
	    	if (bshow) {
	       		$.showPreloader();
	    	} else {
	            $.hidePreloader();	
	    	}
    	}
    }
</script>
	<script>
		$(function(){
			$.init();
			
			//优惠券等高以及文本垂直(防止子页面刷新)
			window.onload = function () {
				wh();
			};
			//点击后优惠券加载样式（100ms后）
			$('.my-coupon a').click( function(){
				setTimeout(function () { wh() }, 100);
			} );
			$('.coupon-link').click( function(){
				setTimeout(function () { wh() }, 100);
			} );
			function wh(){
				$('.my-coupon-information .row').each( 
					function () {
						var ww = $(this).children('.col-30').find('.content-padded').width();
						var www = parseInt(ww) / -2; 
						var hh = $(this).children('.col-30').find('.content-padded').height();
						var hhh = parseInt(hh) / -2;
						$(this).children('.col-30').height($(this).children('.col-70').height());
						$(this).children('.col-30').find('.content-padded').css({'marginTop':hhh,'marginLeft':www});
					}
				);
			}
			
			// 添加筛选条件
			function attachSelect(obj, title, colList) {
				$(obj).picker({
					toolbarTemplate:'<header class="bar bar-nav">'+
									'	<button data-id="'+obj+'" class="button button-link pull-right close-picker">确定</button>'+
									'	<h1 class="title">'+title+'</h1>'+
									'</header>',
					cols: colList,
					onClose: function(){
						$('.infinite-scroll-bottom .list-container').empty();
					}
				});
			}

			// 选择性别
			attachSelect("#picker-sex", '选择性别', [{textAlign:'center',values:['男', '女']}]);
			attachSelect("#picker-constellation",'选择星座',[{textAlign:'center',values:['白羊座','金牛座','双子座','巨蟹座','狮子座','处女座','天秤座','天蝎座','射手座','摩羯座','水瓶座','双鱼座']}]);
			//选择出生日期
			$("#my-input").calendar({
			    value: ['']
			});
			

			//头像改变（需要判断当登录后方可启用）
//			$('.my-header-img').find('img').click(function(){
//				location.href = '<?php echo U("User/face");?>';
//			});
			$(document).on("change","#change-img",function(){
				var thisimg=this;
//				var f = thisimg.files[0];
//				var upsrc = window.URL.createObjectURL(f);
//				$('.my-header-img img').attr("src",upsrc);
				
				var formData = new FormData();
				var name = $(this).val();
				formData.append('face_file', thisimg.files[0]);
				formData.append('name', name);
				
				$.ajax({
					url: '<?php echo U("user/face");?>',
					type: 'POST',
					data: formData,
					// 告诉jQuery不要去处理发送的数据
					processData : false, 
					// 告诉jQuery不要去设置Content-Type请求头
					contentType : false,
					// 发送内容前
					beforeSend: function(){
						console.log('正在上传文件,请稍后...');	
					},
					success: function (data) {
						if (data.result.errno == 0) {
							if (data.face_image != null) {
								$('.my-header-img img').attr("src",data.face_image);	
							}
						} else {
							alert(data.result.message);
						}
					}
				});
				
			});
		});
	</script>
<!--百度统计-->
<script>
	var _hmt = _hmt || [];
	(function() {
		var hm = document.createElement("script");
		hm.src = "//hm.baidu.com/hm.js?a6f69a2a062b07c67a4ae301e0963ca8";
		var s = document.getElementsByTagName("script")[0]; 
		s.parentNode.insertBefore(hm, s);
	})();
</script> 
<!--商务通统计-->
<script language="javascript" src="http://pqt.zoosnet.net/JS/LsJS.aspx?siteid=PQT43116159&lng=cn"></script>
<!--CNZZ统计-->
<script type="text/javascript">
	var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
	document.write(unescape("%3Cdiv id='cnzz_stat_icon_1000019958'%3E%3C/div%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1000019958%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>