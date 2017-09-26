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
<!--<link rel="stylesheet" href="/source/Static/phone/css/bootstrap.css">-->
	<link rel="stylesheet" href="/source/Static/phone/css/order_pay.css">
	<style>
		.coupon-has-choosed { border: 1px solid #e4393c; }
		.coupon-content .row .coupon-has-choosed-bgcolor { background-color: #e4393c; }
	</style>
	<div class="page">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="<?php echo U('line/order');?>/type/center">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">支付</h1>
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
			<!-- 消费总额 -->
			<div class="all-money">
				<div class="content-padded" style="margin-bottom: 0; border-bottom: 1px solid #e7e7e7;">
					消费总额：<span>￥<?php echo ($order["need_pay_money"]); ?></span>
				</div>
			</div>
			<!--预付款-->
			<?php if($order['exist_pay_log'] == 0): ?><div class="list-block" style="background-color: #fff; font-size: .75rem;">
					<div class="item-content" style="margin: 0 1rem;">
					
						<div class="item-inner">
								<div class="item-title label" style="width: 85%;">仅支付预付款</div>
								<div class="item-input">
									<label class="label-switch pay-part">
										<input type="checkbox">
										<div class="checkbox"></div>
									</label>
								</div>
						</div>
	        		</div>
				</div><?php endif; ?>
			
			<!-- 优惠券 -->
			<div class="coupon">
				<div class="content-padded">
					<i class="iconfont">&#xe60e;</i>
					优惠券
					<?php if(count($coupons) == 0): ?><span>无可用</span><?php endif; ?>
					<i class="iconfont up-down">&#xe60f;</i>
				</div>
				<div class="coupon-content">
					<div class="content-padded">
						<?php if(is_array($coupons)): $i = 0; $__LIST__ = $coupons;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$coupon): $mod = ($i % 2 );++$i; if($coupon['invalid'] == 0 and $coupon['disabled'] == 0 and $coupon['use'] == 0): ?><div class="row no-gutter" data-id="<?php echo ($coupon["id"]); ?>">
									<div class="col-70">
										<div class="content-padded">
											<p>每人每次限用一张，仅限6日以上长线使用，不可与其他优惠活动同时使用</p>
											<span>本劵有效期<?php echo ($coupon["valid_time"]); ?>起到<?php echo ($coupon["invalid_time"]); ?></span>
										</div>
									</div>
									<div class="col-30">
										<div class="content-padded">
											<p><span data-money='<?php echo ($coupon["money"]); ?>'><?php echo ($coupon["money"]); ?></span>元</p>
											<strong>现金券</strong>
										</div>
									</div>
								</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
			</div>
			
			<!-- 优惠码 -->
			<div class="promo-codes hidden_ctrl">
				<div class="content-padded">
					<i class="iconfont">&#xe60e;</i>
					优惠码
					<span>无可用</span>
					<i class="iconfont up-down">&#xe60f;</i>
				</div>
				<div class="promo-codes-content">
					<div class="content-padded">
						<h5>请输入优惠兑换码：</h5>
						<div class="write-code">
							<input type="text" maxlength="4">
							—
							<input type="text" maxlength="4">
							—
							<input type="text" maxlength="4">
							—
							<input type="text" maxlength="4">
						</div>
						<a href="javascript:;" external>兑换</a>
					</div>
				</div>
			</div>

			<!-- 消费总额 -->
			<div class="pay-money">
				<div class="content-padded">
					<div class="row no-gutter">
						<div class="col-70">消费总额</div><div class="col-30">￥<?php echo ($order["need_pay_money"]); ?></div>
						<div class="col-70">已付金额</div><div class="col-30">-￥<span><?php echo ($order["paid_money"]); ?></span></div>
						<div class="col-70">优惠券</div><div class="col-30">-￥<span class="coupon_money">0</span></div>
						<div class="col-70">实付金额</div><div class="col-30">￥<span class="final_pay_money"><?php echo ($order["final_pay_money"]); ?></span></div>
					</div>
				</div>
			</div>

			<!-- 选择支付方式 -->
			<div class="pay-mode">
				<h5>选择支付方式</h5>
				<div class="content-padded">
					<div class="list-block media-list">
						<ul>
							<!--<li>
								<label class="label-checkbox item-content pay-has-checked">
									<input type="radio" name="my-radio" checked value="weixin">
									<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
									<div class="item-inner">
										<div class="item-subtitle"><img src="/source/Static/phone/images/order_pay/wx.png" alt="">微信支付</div>
									</div>
								</label>
							</li>-->
							<li>
								<label class="label-checkbox item-content pay-has-checked">
									<input type="radio" name="my-radio" value="zhifubao">
									<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
									<div class="item-inner">
										<div class="item-subtitle"><img src="/source/Static/phone/images/order_pay/ali.png" alt="">支付宝支付</div>
									</div>
								</label>
							</li>
							<!--<li>
								<label class="label-checkbox item-content" >
									<input type="radio" name="my-radio" value="wangyin">
									<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
									<div class="item-inner">
										<div class="item-subtitle"><img src="/source/Static/phone/images/order_pay/atm.png" alt="">银行卡支付</div>
									</div>
								</label>
							</li>-->
							<?php if($order['id'] == '27364'): ?><li>
									<label class="label-checkbox item-content" >
										<input type="radio" name="my-radio" value="xiyin">
										<div class="item-media"><i class="icon icon-form-checkbox"></i></div>
										<div class="item-inner">
											<div class="item-subtitle"><img src="/source/Static/phone/images/order_pay/xiyin.png" alt="">西银在线</div>
										</div>
									</label>
								</li><?php endif; ?>
						</ul>
					</div>
					<a class="comfirm_payment" href="javascript:;" external><span class="final_pay_money"><?php echo ($order["final_pay_money"]); ?></span>元 确认支付</a>
					<div class="popup_pay"></div>
					
				</div>
			</div>

			<!--弹出二维码-->
			<div class="pay-mark"></div>
			<div class="pay-code-content">
				<h4>微信扫描二维码完成付款<a href="javascript:;">x</a></h4>
				<div class="pay-code">
					<img style="width:185px;margin:0 auto;" src="" alt="二维码"/><br>
					<a id="btn_pay_complated" class="btn_pay" type="button" >付款完成，点击查看结果</a>
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
		function showPayQrcode(img, order_sn) {
			$('.pay-mark').show();
			$('.pay-code-content').show();
			$('.pay-code-content').find('img').attr('src', img);
			$('.pay-code-content').find('#btn_pay_complated').attr('data-val', order_sn);
		}
		
		$('.pay-code-content a').click(function(){
			$('.pay-mark').hide();
			$('.pay-code-content').hide();
		});
		
		$('#btn_pay_complated').click(function(){				
			$.post('<?php echo U("line/wxpayresult");?>', 
			{'order_sn': $(this).attr('data-val')},
			function(data){
				if (data.result != null && data.result.errno != 0) {
					alert (data.result.message);
				}
				if (data.jumpUrl != null) {
					location.href = data.jumpUrl;
				} 
			})
		});
		
		$( function(){
			$.init();
			//选择是否仅支付预付款
			$('.pay-part').click(function(){
				$(this).toggleClass('choosed-part');
								
				var couponMoney = parseFloat($('.coupon_money').html());
				var paidMoney = parseFloat('<?php echo ($order["paid_money"]); ?>');
				var needMoney = parseFloat('<?php echo ($order["need_pay_money"]); ?>');
				var finalPayMoney = parseFloat('$order.need_pay_money');
				if ($(this).hasClass('choosed-part')) {
					finalPayMoney = (needMoney - couponMoney - paidMoney) * 0.5;
				} else {
					finalPayMoney = needMoney - couponMoney - paidMoney;
				}				
				$('.final_pay_money').html(finalPayMoney);				
			});			
			
			//显示与隐藏优惠券
			$('.coupon > .content-padded').click( 
				function (){
					$(this).parent('.coupon').children('.coupon-content').slideToggle();
					//优惠券等高以及文本垂直
					$('.coupon-content .col-30').height($('.coupon-content .col-70').height());
					var ww = $('.coupon-content .row .col-30 .content-padded').width();
					var www = parseInt(ww) / -2; 
					var hh = $('.coupon-content .row .col-30 .content-padded').height();
					var hhh = parseInt(hh) / -2;
					$('.coupon-content .row').each( 
						function () {
							$(this).children('.col-30').height($(this).children('.col-70').height());
							$(this).children('.col-30').find('.content-padded').css({'marginTop':hhh,'marginLeft':www});
						}
					);
				}
			);
			
			//选择优惠券后
			$('.coupon-content .row').click( function () {
				var obj = this;
				$('.coupon').find('.row').each(function(){
					$(this).removeClass('coupon-has-choosed');
					$(this).find('.col-30').removeClass('coupon-has-choosed-bgcolor')
				});
				$(obj).addClass('coupon-has-choosed');
				$(obj).find('.col-30').addClass('coupon-has-choosed-bgcolor');
				
				//优惠券金额		
				var couponMoney = parseFloat($(this).find('.col-30 span').attr('data-money'));		
				$('.coupon_money').html(couponMoney);
				var finalPayMoney = parseFloat('<?php echo ($order["final_pay_money"]); ?>') - couponMoney;
				$('.final_pay_money').html(finalPayMoney);
			} );
			
			//显示与隐藏优惠码
			$('.promo-codes > .content-padded').click(
				function () {
					$(this).parent('.promo-codes').children('.promo-codes-content').slideToggle();
				}
			);
			$('.pay-mode').find('.label-checkbox').click(function(){
				$(this).parents('.pay-mode').find('.label-checkbox').removeClass('pay-has-checked');
				$(this).addClass('pay-has-checked');
			});
			
			
			$('.comfirm_payment').click(function(){
				var couponId = $('.coupon').find('.coupon-has-choosed').attr('data-id');
				if (typeof(couponId) == 'undefined') {
					couponId = 0;
				}
				var payType =  $('.pay-has-checked').find("input").val();					
				var payChannel = 'chuxuka';
				if (payType != 'wangyin' && payType != 'xiyin') {
					payChannel = payType;
					payType = 'platform';
				}
				if(payType == 'xiyin') {
					payType = 'pay_menu_xianbank_pay';
					payChannel = 'pay_menu_xianbank_pay';
				}
				var payMoneyAll = 1;
				if ($('.pay-part').length > 0) {
					payMoneyAll = $('.pay-part').hasClass('choosed-part') ? 0 : 1
				}
				
				var jsonData = {
					op_type: 'pay',
					id: '<?php echo ($order["id"]); ?>',
					coupon_id: couponId,
					pay_type: payType,
					pay_channel: payChannel,
					pay_bank: '',
					pay_money_all: payMoneyAll,
				}
//				ShowMark();
				$.post('<?php echo U("line/order");?>', jsonData, function(data){
					
					if (data.html != null) {
						console.log(data.html);
						$('.popup_pay').html(data.html);
						return true;
					}
					
					if (data.image != null) {
						showPayQrcode(data.image, data.order_sn);
					}
					
					if (data.result != null) {
						alert(data.result.message);
				 	}
					
					if (data.jumpUrl != null) {
				 		location.href = data.jumpUrl;
				 	}
				 	
//					HideMark();
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