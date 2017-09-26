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
<!-- mycss -->
<link rel="stylesheet" href="/source/Static/phone/css/order_create_test.css">
<style>
.stage{position:relative;padding: 0 15px;height:55px;}
.slider{position:absolute; width: 200px; height:32px;box-shadow:0 0 3px #999;background-color:#ddd;left:6px;top:-17px;}
.slider-text {
    background: -webkit-gradient(linear, left top, right top, color-stop(0, #4d4d4d), color-stop(.4, #4d4d4d), color-stop(.5, white), color-stop(.6, #4d4d4d), color-stop(1, #4d4d4d));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    -webkit-animation: slidetounlock 3s infinite;
    -webkit-text-size-adjust: none;
    line-height: 32px;
    height: 32px;
    text-align: center;
    font-size: 16px;
    width: 200px;
    color: #aaa;
}
@keyframes slidetounlock
{
    0%     {background-position:-200px 0;}
    100%   {background-position:200px 0;}
}
@-webkit-keyframes slidetounlock
{
    0%     {background-position:-200px 0;}
    100%   {background-position:200px 0;}
}
.button-off{
    position: absolute;
    left: 0;
    top: 0;
    width: 32px;
    height: 32px;
    background-color: #fff;
    transition: left 0s;
    -webkit-transition: left 0s;
}
.button-on{
    position: absolute;
    left: 0;
    top: 0;
    width: 32px;
    height: 32px;
    background-color: #fff;
    transition: left 1s;
    -webkit-transition: left .5s;
}
.track{
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 0;
    overflow: hidden;
    transition: width 0s;
    -webkit-transition: width 0s;
    z-index: 10;
}
.track-on{
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 0;
    overflow: hidden;
    transition: width 1s;
    -webkit-transition: width .5s;
}
.icon-move  {
    width: 32px;
    height: 32px;
    position: relative;
    top:1px;
    left:10px;
    font-family: sans-serif;
}
.icon-move:before{
    content:'>>';
    color:#ccc;
    line-height:32px;
}
.spinner {
    width: 20px;
    height: 20px;	
	background: url('/source/Static/phone/images/order_create/code_ok.png') no-repeat;
    position: relative;
    top:6px;
    left:6px;
    background-size: 100% 100%;
    display: none;
}

@-webkit-keyframes bouncedelay {
    0%, 80%, 100% { -webkit-transform: scale(0.0) }
    40% { -webkit-transform: scale(1.0) }
}
@keyframes bouncedelay {
    0%, 80%, 100% {
        transform: scale(0.0);
        -webkit-transform: scale(0.0);
    } 40% {
          transform: scale(1.0);
          -webkit-transform: scale(1.0);
      }
}
.bg-green {
    line-height: 32px;
    height: 32px;
    text-align: center;
    font-size: 16px;
    background-color: #78c430;
}
</style>

<!--<?php echo p_a($cur_batch);;?>-->
<!-- 日历项模板 -->

<div class="information template_date_item hidden_ctrl">

	<p class="information-money"></p>

	<div class="information-details">

	</div>

</div>
	<div class="page">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="<?php echo U('line/info');?>/id/<?php echo ($line["id"]); ?>" external>
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">领袖户外欢迎您</h1>
		</header>
		<nav class="bar bar-tab">
		    <a class="tab-item active" style="width: 2%; color: #000;" href="#">
		      <span>总价 <strong style="color: #ff7200; font-size: 1.25rem;">￥</strong><strong class="total_money" style="color: #ff7200; font-size: 1.25rem;">0</strong></span>
		    </a>
		    <a id="comfirm_order" class="tab-item" style="background-color: #ff7200; color: #fff;" href="javascript:;" external>
		      <span>提交订单</span>
		    </a>
		</nav>
		<div class="content">
			<div class="order-write">
				<div class="order-write-information">
					<h4><?php echo ($line["title"]); ?></h4>
					<p class="err_msg"></p>
					<div class="list-block">
						<!-- 套餐内容开始 -->
						<?php if(empty($line['taocan_list']) != true): ?><div class="tclx">
								<div class="item-content">
									<div class="item-inner">
										<div class="item-title label">套餐类型：</div>
									</div>
								</div>
								<?php if(is_array($line["taocan_list"])): $i = 0; $__LIST__ = $line["taocan_list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$taocan): $mod = ($i % 2 );++$i;?><span data-id="<?php echo ($taocan["id"]); ?>"><?php echo ($taocan["name"]); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>	
							</div><?php endif; ?>
						<!-- 套餐内容结束 -->
						<div style="clear: both;"></div>
						<div class="item-content" style="border-top: 1px solid #eee;">
							<div class="item-inner">
								<div class="item-title label">线路价格：</div>
								<div class="item-input">
									<span class="price_adult">成人￥<?php echo ($cur_batch["price_adult"]); ?></span>
									<span class="price_child">儿童￥<?php echo ($cur_batch["price_child"]); ?></span>
								</div>
							</div>
						</div>
						<div class="item-content" style="border-top: 1px solid #eee;">
							<div class="item-inner">
								<div class="item-title label">出游人数：</div>
								<div class="item-input">
									<div class="people-num">
										<div class="row">
											<?php if(empty($check['only_child']) == true): ?><div class="col-50">
													<div class="change-people-num adult_man" data-type="adult_man">
														<a href="javascript:;" external>-</a>
														<span><?php echo ($member_male_count); ?></span>
														<a href="javascript:;" external>+</a>
													</div>	
													成人男
												</div>
												<div class="col-50">
													<div class="change-people-num adult_woman" data-type="adult_woman">
														<a href="javascript:;" external>-</a>
														<span><?php echo ($member_woman_count); ?></span>
														<a href="javascript:;" external>+</a>
													</div>
													成人女
												</div><?php endif; ?>
											<?php if(empty($check['only_adult']) == true): ?><div class="col-90">
													<div class="change-people-num child" data-type="child">
														<a href="javascript:;" external>-</a>
														<span><?php echo ($member_child_count); ?></span>
														<a href="javascript:;" external>+</a>
													</div>
													儿童
												</div><?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--日历-->
				<div class="rili">
					<p class="riqi">出发日期: <span id="chufa">2017-07-07</span>出发 , <span id="fanhui">2017-07-12</span>返回</p>
					<div class="calendar" id="calendar">
	            		<div  class="calendar-nav">
							<!--<a href="javascript:;" class="fa  fa-2x fa-angle-left arrow"><i class="iconfont">&#xe649;</i></a>-->
							<!--<a href="javascript:;" class="fa fa-2x fa-angle-right arrow"><i class="iconfont">&#xe600;</i></a>-->
							<div class="calendar_nav" id="calendar_nav"></div>
						</div> 
						<ul class="calendar_week">
							<li>日</li>
							<li>一</li>
							<li>二</li>
							<li>三</li>
							<li>四</li>
							<li>五</li>
							<li>六</li>
						</ul>
						<div class="calendar_content"  id="calendarDiv"></div>
					</div>
				</div>
				<!-- 联系人信息 -->
				<div class="contact-information">
					<h5><img src="/source/Static/phone/images/order_create/sublist_logo.png" alt="">联系人信息</h5>
					<div class="content-padded">
						<div class="list-block">
							<div class="item-inner">
								<div class="item-title label">姓名：</div>
								<div class="item-input">
									<input id="contact_name" type="text" placeholder="请输入您的姓名">
								</div>
							</div>
							<div class="item-inner">
								<div class="item-title label">联系电话：</div>
								<div class="item-input">
									<input id="contact_phone" type="text" placeholder="请输入您的联系电话">
								</div>
							</div>
							<div class="item-inner">
								<div class="item-title label">验证码：</div>
								<div class="item-input">
									<div class="slider" id="slider">
										<div class="slider-text">向右滑动验证</div>
										<div class="track" id="track">
											<div class="bg-green"></div>
										</div>
										<div class="button-off" id="btn">
											<div class="icon-move" id="icon"></div>
											<div class="spinner" id="spinner"></div>
										</div>
									</div>
								</div>
							</div>
							<?php if(empty($user) == true): ?><div class="item-inner">
									<div class="item-title label">校验码：</div>
									<div class="item-input">
										<input id="contact_verify_code" type="text" placeholder="请输入校验码">
										<input id="btnSendCode" class="get-code" type="button" value="发送校验码" readonly="">
										<span id="contact_result"></span>
									</div>
								</div><?php endif; ?>
						</div>
					</div>
				</div>

				<!-- 旅客信息模板 -->				
				<div class="passenger-information-list template_member hidden_ctrl">
					<div class="item-inner">
						<div class="item-title label">游客<span class="sort"></span>：</div>
						<div class="item-input">
							<input class="name" type="text" placeholder="请输入您的真实姓名">
						</div>
					</div>
					<div class="item-inner">
						<div class="item-title label">游客类型：</div>
						<div class="item-input">
							<span class="member_type" data-id=""></type>
						</div>
					</div>
					<div class="item-inner">
						<div class="item-title label">证件类型：</div>
						<div class="item-input">
							<input class="cert" type="text" placeholder="请选择您的证件类型" readonly="">
						</div>
					</div>
					<div class="item-inner">
						<div class="item-title label">证件号码：</div>
						<div class="item-input">
							<input class="cert_num" type="text" placeholder="请输入您的证件号码">
						</div>
					</div>
					<div class="item-inner">
						<div class="item-title label">联系电话：</div>
						<div class="item-input">
							<input class="tel" type="text" placeholder="请输入您的联系电话">
						</div>
					</div>
					<?php if(empty($largess) == false): ?><div class="largess-root">
							<div style="width:100%;padding:10px 0px 5px 12%;color:#000;border-bottom:1px solid #ddd;">赠品：</div>
							<?php if(is_array($largess)): $i = 0; $__LIST__ = $largess;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?><div class="item-inner largess-item" data-id="<?php echo ($l["id"]); ?>">
									<div class="item-title label"><?php echo ($l["type_desc"]); ?>：</div>
									<div class="item-input">
					        			<input class="largess" data-key="<?php echo ($l["type_key"]); ?>" data-desc="<?php echo ($l["type_desc"]); ?>" type="text" placeholder="请选择" readonly="">
									</div>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div><?php endif; ?>
				</div>
				<!-- 旅客信息 -->
				<div class="passenger-information">
					<h5><img src="/source/Static/phone/images/order_create/sublist_logo.png" alt="">旅客信息</h5>
					<div class="list-block">
						<?php if(is_array($members)): $i = 0; $__LIST__ = $members;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?><div class="passenger-information-list">
								<div class="item-inner">
									<div class="item-title label">游客<span class="sort"><?php echo ($key+1); ?></span>：</div>
									<div class="item-input">
										<input class="name" type="text" placeholder="请输入您的真实姓名">
									</div>
								</div>
								<div class="item-inner">
									<div class="item-title label">游客类型：</div>
									<div class="item-input">
										<span class="member_type <?php echo ($m["type_key"]); ?>" data-id="<?php echo ($m["id"]); ?>"><?php echo ($m["type_desc"]); ?></type>
									</div>
								</div>
								<div class="item-inner">
									<div class="item-title label">证件类型：</div>
									<div class="item-input">
										<input class="cert" type="text" placeholder="请选择您的证件类型" readonly="">
									</div>
								</div>
								<div class="item-inner">
									<div class="item-title label">证件号码：</div>
									<div class="item-input">
										<input class="cert_num" type="text" placeholder="请输入您的证件号码">
									</div>
								</div>
								<div class="item-inner">
									<div class="item-title label">联系电话：</div>
									<div class="item-input">
										<input class="tel" type="text" placeholder="请输入您的联系电话">
									</div>
								</div>
								<?php if(empty($largess) == false): ?><div class="largess-root">
										<div style="width:100%;padding:10px 0px 5px 12%;color:#000;border-bottom:1px solid #ddd;">赠品：</div>
										<?php if(is_array($largess)): $i = 0; $__LIST__ = $largess;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?><div class="item-inner largess-item" data-id="<?php echo ($l["id"]); ?>">
												<div class="item-title label"><?php echo ($l["type_desc"]); ?>：</div>
												<div class="item-input">
					        						<input class="largess" data-key="<?php echo ($l["type_key"]); ?>" data-desc="<?php echo ($l["type_desc"]); ?>" type="text" placeholder="请选择" readonly="">
												</div>
											</div><?php endforeach; endif; else: echo "" ;endif; ?>
									</div><?php endif; ?>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>


				<!-- 出游人信息 -->
				<div class="travel-people-information">
					<h5>出游人信息</h5>
					<div class="content-padded">
						<div class="travel-people-list old-man">
							出游人中是否有60周岁(含)至80周岁(不含)的老人？
							<p><span data-id="1"><img src="/source/Static/phone/images/order_create/no_checked.png" alt="">有</span><span class="has-checked" data-id="0"><img src="/source/Static/phone/images/order_create/checked.png" alt="">没有</span></p>
						</div>
						<div class="travel-people-list foreign-man">
							出游人中是否有港澳同胞？
							<p><span data-id="1"><img src="/source/Static/phone/images/order_create/no_checked.png" alt="">有</span><span class="has-checked" data-id="0"><img src="/source/Static/phone/images/order_create/checked.png" alt="">没有</span></p>
						</div>
						<div class="travel-people-list gat-man">
							出游人中是否有外籍友人？
							<p><span data-id="1"><img src="/source/Static/phone/images/order_create/no_checked.png" alt="">有</span><span class="has-checked" data-id="0"><img src="/source/Static/phone/images/order_create/checked.png" alt="">没有</span></p>
						</div>
						<p>本产品不支持孕妇或者80周岁(含)以上的老人出游，18周岁以下的未成年人必须有成年人陪同出游，敬请谅解！</p>
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
	var selectBatchId = '<?php echo ($cur_batch["id"]); ?>';
	
	//日历
	var oDiv = document.getElementById('calendar_nav');
	var oDate = new Date();
	var Syear = oDate.getFullYear();
    var Smonth = oDate.getMonth()+1;
    if(Smonth<10){
    	Smonth = "0"+ Smonth
    }else{
    	Smonth = Smonth
    }
	var oCalendar = document.getElementById('calendarDiv');
	calendarTit(oDiv,oCalendar,Syear,parseInt(Smonth));
	var bBtn = true;
		
	function finalDay() {
        for (var n = 1; n < $('#calendarDiv tr td').length + 1; n++) {
            if (n % 7 == 0) {
                $('#calendarDiv tr td:eq('+ (n - 1) +')').addClass('final-day');
            }
        };
    }

    // 初始化批次信息
    function initCalendarBatch(y) {
        var lineId = '<?php echo ($line["id"]); ?>';
        var type = 'find_batch';
        
        //套餐选中
        var taocanIds = ',';
		$('.tclx').find('span.active').each(function(){
			taocanIds += $(this).attr('data-id') + ',';
		});
		if (taocanIds != ',') {
        	type = 'find_taocan_batch';
        }
		
		//批次选中
		var batchId = '';

        var jsonData = {
        	op_type:type,
        	line_id:lineId,
        	year:y,
        	taocan_ids:taocanIds,
        	batch_id:batchId,	
        };
        $.post('<?php echo U("line/order");?>', jsonData, function(data){
			console.log(data)
            if (data.result.errno == 0) {				
                var batchs = new Object();
                if (data.ds != null && typeof(data.ds) != 'undefined') {
                    for (var i = 0; i < data.ds.length; i++) {
                        var tempDate = new Date(Date.parse(data.ds[i]['start_time'].replace(/-/g,"/")));
                        var td = tempDate.getFullYear()+'-'+(tempDate.getMonth()+1)+'-'+tempDate.getDate();
                        batchs[td] = data.ds[i];
                    }
                }

                $('#calendarDiv tr td').each( function(){
                	$(this).find('.information').remove();
                	$(this).removeClass('black');
                	$(this).removeClass('gogogo');
                    var curDate = $(this).attr('data-date');                    
                    if (typeof(batchs[curDate]) != 'undefined') {						
                        var b = batchs[curDate];
                        var itemObj = $('.template_date_item').clone(true);
                        $(itemObj).removeClass('template_date_item');
                        $(itemObj).removeClass('hidden_ctrl');
                        $(itemObj).find('img').attr('__PUBLIC_/home/images/content_img/yellow_arrow_bottom.png');
 						$(itemObj).attr("data-number",b.end_date_show); 						
                        var state = $.parseJSON(b.state);                       
						
                        if (b.price_adult == 0 && b.price_child == 0 && '<?php echo ($line["free_line"]); ?>' == '0') {
                            $(itemObj).find('.information-money').html('核算中');
                        } else {
                            $(itemObj).attr('data-adult-money', b.price_adult);
                            $(itemObj).attr('data-children-money', b.price_child);
                            $(itemObj).find('.information-money').html('￥'+b.price_adult.substring(0,4));
                        }
                        
                        $(this).addClass('gogogo');
                        $(this).attr('data-batch-id', b.id);
                        $(this).append(itemObj);
                    }
                });
                if (selectBatchId != '') {
                	$('#calendarDiv').find('td[data-batch-id="'+selectBatchId+'"]').trigger('click');
                	selectBatchId = '';
                }
            } else {
                console.log(data.result.message);
            }
            finalDay();
        });
    }
	
	 // calendar_nav里span的内容 
	 function  calendarTit(obj,obj1,year,month){

		 var oDate = new Date(year,month-1);
		//var oDate;
		 for(var i=-12; i<12; i++){
			 var ospan = document.createElement('span');
			 obj.appendChild(ospan);
			 ospan.innerHTML ='<b>'+year+'年</b>'+(month+i)+'月';
			 ospan.setAttribute("mouth",(month+i));
			 ospan.setAttribute("year",year);
			 if((month+i)>12){
				 year = oDate.getFullYear()+1;
				 ospan.innerHTML ='<b>'+year+'年</b>'+((month+i)-12)+'月';
				 ospan.setAttribute("mouth",((month+i)-12));
				 ospan.setAttribute("year",year);
			 }
			 if((month+i)<1){
				 year = oDate.getFullYear()-1;
				 ospan.innerHTML ='<b>'+year+'年</b>'+((month+i)+12)+'月';
				 ospan.setAttribute("mouth",((month+i)+12));
				 ospan.setAttribute("year",year);
			 }
			 if((month+i)>0 && (month+i)<12){
				 year = oDate.getFullYear();
				 ospan.innerHTML ='<b>'+year+'年</b>'+((month+i))+'月';
				 ospan.setAttribute("mouth",((month+i)));
				 ospan.setAttribute("year",year);
			 }
			 if((month+i)>0 && (month+i)<10){
				 year = oDate.getFullYear();
				 ospan.innerHTML ='<b>'+year+'年</b>'+((month+i))+'月';
				 ospan.setAttribute("mouth", ((month+i)));
				 ospan.setAttribute("year",year);
			 }
			 var oCon = document.createElement('div');
			 obj1.appendChild(oCon);
			 $(".calendar_nav").children().hide();
			 $(".calendar_nav").children().slice(12,18).show();

		 }

		 for(var j=0; j<24; j++){
			 var aSpan = obj.children;
			 var aCon = obj1.children;
			 aSpan[12].className = 'active';
			 var oDate = new Date();
			 showDate(aCon[12],aSpan[12].getAttribute("year"),aSpan[12].getAttribute("mouth"),true);
			 aSpan[j].index = j;

		 }

	 }
	 //获取当天
		var spanlength =  oCalendar.getElementsByTagName('span');
		var now = new Date();
		for(var i=0;i<spanlength.length; i++) {
			if(spanlength[i].getAttribute("day")==now.getDate() && spanlength[i].getAttribute("month")==(now.getMonth()+1) && spanlength[i].getAttribute("year")==now.getFullYear() ){
				spanlength[i].className='today';
			}
		}
	 
	 function showDate(obj,year,month,bBtn){
		 var oDate = new Date();
		 var dayNum = 0;
		 if(!obj.bBtn){
			 var oTable = document.createElement('table');
			 var oTbody = document.createElement('tBody');
			 for(var i=0;i<6;i++){
				 var oTr = document.createElement('tr');
				 for(var j=0;j<7;j++){
					 var ospan = document.createElement('span');
					 var oTd = document.createElement('td');
					 oTd.appendChild(ospan);
					 oTr.appendChild(oTd);
				 }
				 oTbody.appendChild(oTr);

			 }
			 oTable.appendChild(oTbody);
			 obj.appendChild(oTable);

			 obj.bBtn = true;
		 }
		 //添加天数
		 var aTd = obj.getElementsByTagName('span');
		 for(var i=0;i<aTd.length;i++){
			 aTd[i].innerHTML = ''; 
		 }

		 if(month==1 || month==3 || month==5 || month==7 || month==8 || month==10 || month==12){
			 dayNum = 31;
		 }
		 else if(month==4 || month==6 || month==9 || month==11){
			 dayNum = 30;
		 }
		 else if(month==2 && isLeapYear(year)){
			 dayNum = 29;
		 }
		 else{
			 dayNum = 28;
		 }
		
		 oDate.setFullYear(year);
		 oDate.setMonth(month-1);
		 oDate.setDate(1); 
		 for(var i=0;i<dayNum;i++){
			 aTd[i+oDate.getDay()].innerHTML = i+1;
			 $(aTd[i+oDate.getDay()]).attr('year',year);
			 $(aTd[i+oDate.getDay()]).attr('month',month);
			 $(aTd[i+oDate.getDay()]).attr('day',i+1);
			 $(aTd[i+oDate.getDay()]).parent("td").attr('data-date',year+"-"+month+"-"+(i+1));
		 }
		 
		for(var i=0;i<aTd.length;i++){
			if(aTd[i].innerHTML==''){
				aTd[i].parentNode.className='bg_black';
			}
		}
		
		//润年
		function isLeapYear(year){
			if(year%4==0 && year%100!=0){
				return true;
			}
			else{
				if(year%400==0){
					return true;
				}else{
					return false;
				}
			}
		}
	 }
	 
	 // 计算总价
	function calcTotalMoney() {
		var adultCount = 0, childCount = 0;
		$('.change-people-num').each(function(i, ev){
			if ($(this).hasClass('child')) {
				childCount += parseInt($(this).find('span').html());
			} else {
				adultCount += parseInt($(this).find('span').html());
			}
		});
		
		var jsonData = {
			op_type: 'calc_money',
			batch_id: $('#calendarDiv div[style="display: block;"]').find('td.bg-high-color').attr('data-batch-id'),
			adult_count: adultCount,
			child_count: childCount,
		}
		
		var taocanIds = ',';
		$('.tclx').find('span.active').each(function(){
			taocanIds += $(this).attr('data-id') + ',';
		});
		if (taocanIds != ',') {
			jsonData['taocan_ids'] = taocanIds;
		}
		
		$.post('<?php echo U("line/order");?>', jsonData, function(data){
			console.log(data);
			if (data.result.errno == 0) {
				if (data.money != null && data.money != 'undefined') {
					$('.price_adult').html('￥'+data.money.price_adult+'/成人');
					$('.price_child').html('￥'+data.money.price_child+'/儿童');
				}
				
				if (data.money != null && data.money != 'undefined') {
					$('.total_money').html(data.money.cut);
					$('.total_money').attr('data-no-cut',data.money.full);
				} else {				
					$('.total_money').html(0);
					$('.total_money').attr('data-no-cut',0);
				}
			} else {
				alert(data.result.message);
			}
		});			
	}
    
    //点击批次选中
	$(document).on('click', '.gogogo', function () {
		//修改出发返回日期
		var chufa = $(this).attr("data-date");
		var fanhui = $(this).find(".information").attr("data-number");
		$("#chufa").html(chufa);
		$("#fanhui").html(fanhui);
		//高亮显示
        $(this).parents('#calendarDiv div').find('.gogogo').removeClass('bg-high-color');
        $(this).parents('#calendarDiv div').siblings().find('.gogogo').removeClass('bg-high-color');
        $(this).addClass('bg-high-color');
        
        //获取日历上被点击的日期
        var  dateNum = $(this).attr('data-date');
        if(parseInt(dateNum.substr(5,2)) < 10){
            var dateArr1 = dateNum.split('-');
            dateArr1[1] = '0' + dateArr1[1];
            dateNum = dateArr1.join('-');
        };
        if(parseInt(dateNum.substr(-2,2)) < 10){
            var dateArr2 = dateNum.split('-');
            dateArr2[2] = '0' + dateArr2[2];
            dateNum = dateArr2.join('-');
        };

        
        //设置套餐可选状态
		$('.tclx span').each(function(){
			if (!$(this).hasClass('active')) {
				$(this).removeClass();
				$(this).addClass('disabled');
			}
		});
        var lineId = '<?php echo ($line["id"]); ?>';
        var mouth = $('#calendar_nav').find('span.active').attr("mouth");
		var year = $('#calendar_nav').find('span.active').attr("year");
		if(mouth <= 9){
			mouthnext= "0"+mouth
		}else{
			mouthnext= mouth
		}
		
		var batchId = $(this).attr('data-batch-id');		
        var jsonData = {
        	op_type:'find_taocan_batch',
        	line_id:lineId,
        	year:year+"-"+mouthnext,
        	batch_id:batchId,
        };
        $.post('<?php echo U("line/order");?>', jsonData, function(data){
        	console.log(data);
        	if (data.result.errno == 0) {
        		if (data.taocan_ids != null && typeof(data.taocan_ids) != 'undefined') {
                     for(i = 0; i < data.taocan_ids.length; i++){
					 	if (!$('.tclx').find('span[data-id="'+data.taocan_ids[i]+'"]').hasClass('active')) {
					 		$($('.tclx').find('span[data-id="'+data.taocan_ids[i]+'"]').removeClass());
					 	}
					 }
                }
        	}
        });
        
        // 设置总价
        calcTotalMoney();
    });
    
	 
	   	//前后追加日期
		function  addri(){
			var index = $(".calendar_nav").find(".active").index();
			var month = $(".calendar_nav").find(".active").attr("mouth");
			var number = 1;
			var tds = $("#calendarDiv div:visible").find("tr:first").find(".bg_black"); 
			var tdss = $("#calendarDiv div:visible").find("tr:nth-child(5)").find(".bg_black");
			var tdsss = $("#calendarDiv div:visible").find("tr:last").find(".bg_black")
			for(var a=0;a<tdsss.length;a++){
				tdss.push(tdsss[a]);
			}
			var daysanshiyi = 31-tds.length;
			var daysanshi = 30-tds.length;
			var dayershiba = 28-tds.length;
			if(month==2 || month==4 || month==6 || month==8 || month==9 || month==11 || month==1){
				for(var i=0;i<tds.length;i++){
					daysanshiyi++;
					$(tds[i]).find("span").html(daysanshiyi);
				}
			}else if(month==5 || month==7 || month==10 || month==12){
				for(var i=0;i<tds.length;i++){
					daysanshi++;
					$(tds[i]).find("span").html(daysanshi);
				}
			}else if(month==3){
				for(var i=0;i<tds.length;i++){
					dayershiba++;
					$(tds[i]).find("span").html(dayershiba);
				}
			}
			for(var d=0;d<tdss.length;d++){
				$(tdss[d]).find("span").html(number);
				number++;
			}
			
		}
	 
	 //点击月份
	 $("#calendar_nav").on("click","span",function(){
		 var mouth = $(this).attr("mouth");
		 var year = $(this).attr("year");
		 
		 if(mouth <= 9){
		 	mouthnext= "0"+mouth
		 }else{
		 	mouthnext= mouth
		 }
		 var index = $(this).index();
		 console.log(index)
		 if(index==0 || isNaN(index)){
			 $(".calendar_nav").children().eq(0).addClass("active").show();
			 $(".calendar_content").children().eq(0).show();
			 e.stopPropagation();

			 return false;
		 }
		 $(".calendar_nav").children().slice(index,index+7).show();
		 $(".calendar_nav").children().removeClass("active");
		 $(this).addClass("active").show();
		 $(".calendar_content").children().hide();
		 $(".calendar_content").children().eq(index).show();
		 if($(".calendar_content").children().eq(index).hasClass("load") || $(".calendar_content").children().eq(index).hasClass("load-left") ||$(".calendar_content").children().eq(index).hasClass("load-right")){
		 }else{
		 	showDate($(".calendar_content").children().eq(index)[0],$(".calendar_nav").children("span[class=active]").attr("year"),$(".calendar_nav").children("span[class=active]").attr("mouth"),true);
			 if(index>11){
				 $(".calendar_nav").children().eq(index+7).hide();
			 }
		 }
		 // 初始化批次信息
         initCalendarBatch(year+"-"+mouthnext);
         console.log(year+"-"+mouthnext);
		 $(".calendar_content").children().eq(index).addClass("load");
		 addri();
	 });
	 
	 // 套餐类型
	$(".tclx span").on("click",function(){
		if ($(this).hasClass('disabled')) {
			return false;
		}
		var number = $(this).attr("data-date")
		if(number == 1){
			$(this).addClass("disabled")
		}else{
			$(this).toggleClass("active").siblings().removeClass("active");
		}
		
		var mouth = $('#calendar_nav').find('span.active').attr("mouth");
		var year = $('#calendar_nav').find('span.active').attr("year");
		if(mouth <= 9){
			mouthnext= "0"+mouth
		}else{
			mouthnext= mouth
		}
		initCalendarBatch(year+"-"+mouthnext);
			
		// 设置总价
		var batchId = $('#calendarDiv tr td.bg-high-color').attr('data-batch-id');
		if (batchId != null && typeof(batchId) != 'undefined' && batchId != '') {
			calcTotalMoney();
		}        
	});
	
	
	$(function(){
		$.init();
		
		//验证码
		
	    var oBtn = document.getElementById('btn');
	    var oW,oLeft;
	    var oSlider=document.getElementById('slider');
	    var oTrack=document.getElementById('track');
	    var oIcon=document.getElementById('icon');
	    var oSpinner=document.getElementById('spinner');
		var flag=1;
		//限制最大宽度
		var oWidth = $('.slider').width();
	 
	    oBtn.addEventListener('touchstart',function(e){
			if(flag==1){
				console.log(e);
				var touches = e.touches[0];
				oW = touches.clientX - oBtn.offsetLeft;
				oBtn.className="button-off";
				oTrack.className="track";
			}
	        
	    },false);
	 
	    oBtn.addEventListener("touchmove", function(e) {
			if(flag==1){
				var touches = e.touches[0];
				oLeft = touches.clientX - oW;
				if(oLeft < 0) {
					oLeft = 0;
				}else if(oLeft > oWidth - oBtn.offsetWidth) {
					oLeft = (oWidth - oBtn.offsetWidth);
				}
				oBtn.style.left = oLeft + "px";
				oTrack.style.width=oLeft+ 'px';			
			}
	        
	    },false);
	 
	    oBtn.addEventListener("touchend",function() {
	        if(oLeft>= oWidth - oBtn.clientWidth ){
	            oBtn.style.left = (oWidth - oBtn.offsetWidth);
	            oTrack.style.width= (oWidth - oBtn.offsetWidth);
	            oIcon.style.display='none';
	            oSpinner.style.display='block';				
				flag=0;			
	        }else{
	            oBtn.style.left = 0;
	            oTrack.style.width= 0;
	        }
	        oBtn.className="button-on";
	        oTrack.className="track-on";       
	    },false);
		
		$('.travel-people-list span').click( function (){
			$(this).addClass('has-checked');
			$(this).siblings().removeClass('has-checked');
			$(this).children('img').attr('src','/source/Static/phone/images/order_create/checked.png');
			$(this).siblings().children('img').attr('src','/source/Static/phone/images/order_create/no_checked.png');
		} );
			
		// 添加筛选条件
		var prevSelect = {};
		function attachSelect(obj, title, data) {
			var ds = $.parseJSON(data);
			var ids = [], vals = [], invalids = [], uses = [];
			for (var i = 0; i < ds.length; i ++) {
				ids.push(ds[i].id);
				vals.push(ds[i].text);
				invalids.push(ds[i].invalid);
				uses.push(ds[i].use);
			}
			
			$(obj).picker({
				toolbarTemplate:'<header class="bar bar-nav">'+
								'	<button class="button button-link pull-right close-picker">确定</button>'+
								'	<h1 class="title">'+title+'</h1>'+
								'</header>',
				cols: [{
					textAlign:'center',
					values: vals,
				}],
				onOpen: function() {
					var itemsObj = $('.picker-item');
					for (var i = 0; i < $(ids).length; i++) {
						$(itemsObj[i]).attr('data-val', ids[i]);
						if ($(obj).hasClass('batch_select')) {
							$(itemsObj[i]).attr('data-invalid', invalids[i]);
							$(itemsObj[i]).attr('data-use', uses[i]);
						}
					}
					if ($(obj).hasClass('batch_select')) {
						prevSelect['id'] = $(obj).attr('data-id');
						prevSelect['value'] = $(obj).val();
					}
				},
				onClose: function(){
					if ($('.picker-selected').length > 0) {
						if ($(obj).hasClass('batch_select')) {
							if ($('.picker-selected').attr('data-invalid') == 1) {
								$(obj).attr('data-id', prevSelect.id);
								$(obj).val(prevSelect.value);
								$('.err_msg').html('该批次已过期报名时间，详情请咨询客服MM');
								return false;
							}
							if ($('.picker-selected').attr('data-use') == 0) {
								$(obj).attr('data-id', prevSelect.id);
								$(obj).val(prevSelect.value);
								$('.err_msg').html('该批次已被禁用或已经下架，详情请咨询客服MM');
								return false;
							}
							$('.err_msg').html('');
						}
						// 设置选中的编号
						var dataVal = $('.picker-selected').attr('data-val');
						$(obj).attr('data-id', dataVal);			
						// 特殊处理批次选择
						if ($(obj).hasClass('batch_select')) {
							var dates = $(obj).val().split('至');
							$('.cur_sel_batch').html('* '+dates[0]+'出发 , '+dates[1]+'返回');
							//  重新计算价格
							calcTotalMoney();
						}
					}
				}
			});			
		}
			
		// 批次选择
		attachSelect('#batch_select', '选择您的出发日期', '<?php echo ($batch_list); ?>');
		
		// 移除参团人信息
		$('.change-people-num a:first-child').click( function () {			
			//判断原本span中的值，小于0则不在计算
			if( parseInt($(this).next('span').html()) <= 0 ){
				return;
			}else {
				$(this).next('span').html( parseInt($(this).next('span').html()) - 1 );
				// 删除最后一个该类型的旅客信息
				var memberType = $(this).closest('.change-people-num').attr('data-type');
				$('.passenger-information').find('.'+memberType+':last').closest('.passenger-information-list').remove();
				// 刷新参团人编号
				$('.passenger-information-list').find('.sort').each(function(i, ev){
					$(this).html(i+1);	
				});
				// 重新核实总价
				calcTotalMoney();
			}
		} );
		
		// 添加参团人信息
		function appendMemberHtml(memberType) {
			//声明旅客人数
			var spanNum = $('.list-block').find('.passenger-information-list').length + 1;
			// 游客类型
			var mt = null;
			var memberTypes = $.parseJSON('<?php echo ($member_types); ?>');
			for (var i = 0; i < $(memberTypes).length; i ++) {
				var t = memberTypes[i];
				if (t.type_key == memberType) {
					mt = t;
				}
			}
			
			//添加
			var rootObj = $('.template_member').clone(true);
			$(rootObj).removeClass('template_member');
			$(rootObj).removeClass('hidden_ctrl');
			$(rootObj).find('.sort').html(spanNum);
			$(rootObj).find('.member_type').attr('data-id', mt.id);
			$(rootObj).find('.member_type').addClass(mt.type_key);
			$(rootObj).find('.member_type').html(mt.type_desc);
			$('.passenger-information .list-block').append(rootObj);
			
			// 旅客选择证件
			attachSelect($(rootObj).find('.cert'), '证件类型', '<?php echo ($certs); ?>');
			// 赠品初始化
			initLargessSelect($(rootObj).find('.largess'));
		}
		
		// 出游人数增加
		$('.change-people-num a:last-child').click( function () {			
			$(this).prev('span').html( parseInt($(this).prev('span').html()) + 1 );
			// 添加参团人
			var memberType = $(this).closest('.change-people-num').attr('data-type');
			appendMemberHtml(memberType);
			// 重新计算总价
			calcTotalMoney();
		} );


		//旅客选择证件（防止子页面刷新）
		attachSelect($('.passenger-information-list').find('.cert'), '证件类型', '<?php echo ($certs); ?>');
		
		// 赠品选择
		function initLargessSelect(largessObj) {
			var dataKey = $(largessObj).attr('data-key');
			var showDesc = $(largessObj).attr('data-desc');
			$.post('<?php echo U("line/largess");?>', {data_type:dataKey}, function(data){
				if(data.result.errno == 0 && data.ds != null) {
					attachSelect(largessObj, showDesc, JSON.stringify(data.ds));	
				} else {
					console.log(data.result.message);
				}
			});
		}
		
		$(document).ready(function(){						
			// 初始化赠品选择项			
			$('.passenger-information-list').find('.largess').each(function(i, ev){
				initLargessSelect(this);
			});
			
			//初始化批次日历
			var selectBData = '<?php echo ($cur_batch["start_date_show"]); ?>';
			if (selectBData != '') {
				var selectArr = selectBData.split("-");
				$('#calendar_nav').find('span[year="'+selectArr[0]+'"]').each(function(){
					if ($(this).attr('mouth') == parseInt(selectArr[1])) {
						$(this).trigger('click');
					}
				});		
			} else {				
				var d = new Date();
	        	var year = d.getFullYear();
	        	initCalendarBatch(year+'-'+d);
			}
			
			addri();
		});
		
		// 联系人手机效验码验证
		var IntervalContactSend = 0, sub_send_second = 600, contact_phone='';
		$('#btnSendCode').click(function(data){			
			if ($(this).is(":disabled") == false) {
				contact_phone = $('#contact_phone').val();
				if (checkMobile(contact_phone) == false) {
					alert('电话号码有误');
					return false;
				}
				var jsonData = {
					type: 'send',
					tel: contact_phone,
					use: 'phone_order_contact_phone',
					interval: 600,
					rd: '<?php echo ($pagerd); ?>',
				};
				
				$.post('<?php echo U("common/sms");?>', jsonData, function(data){
					if (data.result.errno == 0) {
						sub_send_second = 600;
						$('#btnSendCode').val(sub_send_second+'秒后重新发送');
						$("#btnSendCode").attr("disabled", "disabled");
						IntervalContactSend = window.setInterval(refreshContactPhoneCode, 1000);
					} else {
						alert(data.result.message);
					}
				});
			} else {
				alert('验证码已经发送，请随后在此发送');
			}
		});
		
		// 刷新发送联系人手机验证码时间
		function refreshContactPhoneCode() {
			if (sub_send_second == 0) {
				window.clearInterval(IntervalContactSend);
				$('#btnSendCode').val('发送验证码');
				$('#btnSendCode').removeAttr('disabled');
			} else {
				sub_send_second--;
				$('#btnSendCode').val(sub_send_second+'秒后重新发送');
			}
		}
		
		
		// 更换联系人电话号码
		$('#contact_phone').blur(function(){
			var phone = $('#contact_phone').val();
			if (phone != contact_phone) {
				$('#contact_result').html('');
			}
		});
		
		// 验证联系人发送的验证码
		$('#contact_verify_code').blur(function(){
			if ($('#contact_result').html() != '') {
				return false;
			}
			var sCode = $(this).val();
			if (sCode == '') {
				alert('验证码不能为空');
				return false;
			}
			var phone = $('#contact_phone').val();
			if (checkMobile(phone) == false) {
				alert('验证码有误');
				return false;
			}
			var jsonData = {
				type: 'check',
				tel: phone,
				use: 'phone_order_contact_phone',
				code: sCode,
			};
			
			$.post('<?php echo U("common/sms");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					$('#contact_result').html('验证通过');
					window.clearInterval(IntervalContactSend);
					$('#btnSendCode').val('发送验证码');
					$('#btnSendCode').removeAttr('disabled');
				} else {
					alert(data.result.message);
				}
			});
		});
		
		// 检查订单信息
		function checkOrder() {			
			// 联系人检查
			if ($('#contact_name').val() == '') {
				alert("联系人姓名不能为空");
				return false;
			}
			
			// 联系人手机确认
			if ('<?php echo ($user["id"]); ?>' == '') {
				if ($('#contact_result').html() != '验证通过') {
					alert("联系人手机未验证确认");
					return false;
				}	
			} else {
				if (checkMobile($('#contact_phone').val()) == false) {
					alert("联系人手机错误");
					return false;
				}
			}
			
			return true;
		}
		
		// 获取赠品信息
		function getLargessData(obj) {
			var largess = [];
			$(obj).find('.largess-item').each(function(i,ev){
				var l = {
					largess_id: $(this).attr('data-id'),
					data_id: $(this).find('.largess').attr('data-id'),
				};
				largess.push(l);
			});
			return largess;
		}
		
		
		// 获取参团人信息
		function getMemberData() {
			var jsonData = [];
			$('.list-block').find('.passenger-information-list').each(function(i, ev){
				var mobilePhone = $(this).find('.tel').val();
				if (mobilePhone != '' && (checkMobile(mobilePhone) == false || checkTel(mobilePhone) == false)) {
					var typeDesc = $(this).find('.member_type').html();
					alert('第'+i+'位'+typeDesc+'的电话号码错误！');
					return false;	
				}
				
				var obj = {
					name: $(this).find('.name').val(),
					type_id: $(this).find('.member_type').attr('data-id'),
					certificate_type_id: $(this).find('.cert').attr('data-id'),
					certificate_num: $(this).find('.cert_num').val(),
					tel: mobilePhone,
					largess: getLargessData($(this)),
				};
				jsonData.push(obj);
			});		
			return jsonData;
		}
		
		// 获取订单数据
		function getOrderData() {
//			var receiptType = $('.order-details-invoice').find('.order-details-invoice-choose').find('input:checked').val();
			var  manCount = $('.adult_man').find('span').html();
			var  womanCount = $('.adult_woman').find('span').html();
			var  childCount = $('.child').find('span').html();
			var receiptType = 0;
			
			var memberData = getMemberData();
			if (memberData === false) {
				return false;
			}
			
			var jsonData = {
				op_type: 'create',
				lineid: '<?php echo ($line["id"]); ?>',
				hdid: $('#calendarDiv tr td.bg-high-color').attr('data-batch-id'),
				userid: '<?php echo ($user["id"]); ?>',
				duid: '<?php echo ($duid); ?>',
				male: manCount == '' || manCount == null ? 0 : manCount,
				woman: womanCount == '' || womanCount == null ? 0 : womanCount,
				child: childCount == '' || childCount == null ? 0 : childCount,
				types: '成人', //联系人类型
				names: $('#contact_name').val(), //联系人名称
				gendar: '男', // 联系人性别
				mob: $('#contact_phone').val(),
				members: memberData,
				oldman: $('.travel-people-information').find('.old-man').find('.has-checked').attr('data-id'),
				foreigner: $('.travel-people-information').find('.foreign-man').find('.has-checked').attr('data-id'),
				hk_mc: $('.travel-people-information').find('.gat-man').find('.has-checked').attr('data-id'),
				receipt_type: receiptType,
				book_account_type: '<?php echo ($user["account_type"]["id"]); ?>',
			}			
			jsonData['member_total_count'] = parseInt(jsonData['male']) + parseInt(jsonData['woman']) + parseInt(jsonData['child']);
			if ('<?php echo ($user["id"]); ?>' == '') {
				jsonData['mob_code'] = $('#contact_verify_code').val();
			}
			
//			if (receiptType != 0) {
//				var parentClass = receiptType == 1 ? '.order-details-invoice-write-enterprise' : '.order-details-invoice-write-personal';
//				if (receiptType == 1) {
//					jsonData['receipt_company'] = $(parentClass).find('.receipt_company').val();
//					jsonData['receipt_company_no'] = $(parentClass).find('.receipt_company_no').val();
//					jsonData['receipt_company_address'] = $(parentClass).find('.receipt_company_addr').val();
//					jsonData['receipt_company_phone'] = $(parentClass).find('.receipt_company_tel').val();
//				}
//				jsonData['receipt_receiver'] = $(parentClass).find('.receipt_receiver').val();
//				jsonData['receipt_receiver_phone'] = $(parentClass).find('.receipt_receiver_tel').val();
//				jsonData['receipt_receiver_address'] = $(parentClass).find('.receipt_receiver_addr').val();
//			}
			return jsonData;
		}		
		
		// 下单
		$('#comfirm_order').click(function(){
			if (checkOrder() == false) {
				return false;
			}
			//判断验证码滑动成功
			if (flag != 0){
				alert('请滑动验证码');
				return false;
			}
			
			var jsonData = getOrderData();	
			if (jsonData === false) {
				return false;
			}
			
			if (parseInt(jsonData['member_total_count']) == 0) {
				alert('出游人数总和不能为0');
				return false;
			}
			
			// 已选套餐
			var taocanIds = ',';
			$('.tclx').find('span.active').each(function(){
				taocanIds += $(this).attr('data-id') + ',';
			});
			if (taocanIds != ',') {
				jsonData['taocan_ids'] = taocanIds;
			}
			
			console.log(JSON.stringify(jsonData));
			ShowMark();
			$.post('<?php echo U("line/order");?>', jsonData, function(data){
				HideMark();
				if (data.result.errno != 0) {
					alert(data.result.message);
				}
				if (data.jumpUrl != null && data.jumpUrl != 'undefined') {
					location.href = data.jumpUrl;
				}
			});
		});

	})
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