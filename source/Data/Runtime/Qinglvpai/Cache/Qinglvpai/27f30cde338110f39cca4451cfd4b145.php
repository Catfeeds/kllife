<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php if(empty($PageKeyword) == false): ?><meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
	<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
	<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
	<title><?php echo ($PageKeyword["title"]); ?></title>
	<?php else: ?>
	<title><?php echo C('PAGE_TITLE');?></title><?php endif; ?>
	<!-- 引用jq -->
	<script src="http://kllife.com/source/Static/home/common/js/jquery-1.11.3.min.js"></script>	
	
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/style.css">
	<!-- css Reset -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/cssreset.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/common.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/common/css/common.css">
    <link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/iconfont.css">
    <!--图标-->
    <link type="image/x-icon" rel="shortcut icon" href="http://kllife.com/source/Static/qinglvpai/common/images/favicon.ico" />
    <style>
        .top-ask{position: fixed;right:50px;bottom:100px;display: none;z-index:1000;}
        .top-ask div{margin:2px 0px;cursor: pointer;}
        .top-ask div img{width:50px;height:50px;}
    </style>
	<!-- 引用jq -->
	<script src="http://kllife.com/source/Static/home/common/js/jquery-1.11.3.min.js"></script>
</head>
<body>
<!--header-->
<div class="header">
    <?php if(C('MENU_CURRENT') === 'index_welcome'): ?><a href="<?php echo U('index/story');?>" target="_blank"><div class="banner" style="background-image: url(<?php echo ($set["banner"]); ?>);"></div></a>
   	<?php elseif(C('MENU_CURRENT') === 'line_list'): ?>
        <div class="banner" style="background-image: url(<?php echo ($set["content_banner"]); ?>);"></div>
    <?php elseif(C('MENU_CURRENT') === 'line_content'): ?>
        <div class="banner-content" style="background-image: url(<?php echo ($set["qinglvpai_content_banner"]); ?>);"></div>
   	<?php elseif(C('MENU_CURRENT') === 'line_main_list'): ?>
        <div class="banner" style="background-image: url(<?php echo ($set["xiaomantuan_banner"]); ?>);"></div>
    <?php elseif(C('MENU_CURRENT') === 'line_main_content'): ?>
        <div class="banner-content" style="background-image: url(<?php echo ($set["xiaomantuan_content_banner"]); ?>);"></div>
    <?php elseif(C('MENU_CURRENT') === 'book_line' or C('MENU_CURRENT') === 'line_pay_result' or C('MENU_CURRENT') === 'index_story' or stripos(C('MENU_CURRENT'),'leader_list') !== FALSE): ?>
    <?php else: ?>
        <div class="banner-content" style="background-image: url(<?php echo ($set["qinglvpai_content_banner"]); ?>);"></div><?php endif; ?>
    <div class="div-two">
        <div class="list">
            <a href="javascript:;"><img class="logo-white" src="http://kllife.com/source/Static/qinglvpai/images/index/logo-qinglvpai.png" alt=""></a>
            <ul>
                <a class="active" href="<?php echo U('index/welcome');?>" target="_blank">首页</a>
                <a href="<?php echo U('index/story');?>" target="_blank">品牌故事</a>
                <a href="<?php echo U('line/list');?>" target="_blank">跟拍游</a>
                <a href="<?php echo U('line/slowly');?>" target="_blank">小团慢旅行</a>
                <a href="<?php echo U('Leader/list');?>" target="_blank">摄影师</a>
                <!--<a href="javascript:;">客户回顾</a>-->
            </ul>
            <div class="tel">
                <img style="height:auto;" src="http://kllife.com/source/Static/qinglvpai/images/index/tel-img.png" alt="">
                <img style="height:auto;" src="http://kllife.com/source/Static/qinglvpai/images/index/tel-number.png" alt="">
                <!--<em><?php echo ($pcset["askfor_tel"]); ?></em>-->
            </div>
            <div class="tel login" style="line-height:80px;color:#fff;font-size: 14px;width:170px;text-align: center;text-align: -webkit-center">
				<?php if(empty($user) == true): ?><a href="<?php echo U('user/login');?>" target="_blank">登录</a> |
					<a href="<?php echo U('user/register');?>" target="_blank">注册</a>
				<?php else: ?>
					<a href="<?php echo U('line/order');?>/type/center" target="_blank">我的订单</a> |
					<a href="<?php echo U('user/exit');?>">退出</a><?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!--返回顶部，咨询-->
<div class="top-ask">
    <div onclick="openZoosUrl('chatwin');"><img src="http://kllife.com/source/Static/qinglvpai/common/images/ask1.jpg" alt=""></div>
    <div class="return-top"><img src="http://kllife.com/source/Static/qinglvpai/common/images/return-top.jpg" alt=""></div>
</div>
<script type="text/javascript">	
	// 导航划过变色
	$('.list ul a').mouseenter(function(){
		$(this).toggleClass('active');
	});
	$('.list ul a').mouseleave(function(){
		$(this).toggleClass('active');
	});
	
	// 登录我的订单点击选中
    $(".login a").on("click",function(){
        $(this).addClass("active").siblings("a").removeClass("active");
    })
    
    //屏幕滚动显示一键返回顶部按钮
    $(window).scroll( function (){
        if ($(this).scrollTop() > 150) {
            $('.top-ask').fadeIn();
        }else{
            $('.top-ask').fadeOut();
        };
    });

    //点击返回顶部
    $(".return-top").click(
        function(){
            $("html,body").animate({scrollTop: 0}, 1000);
        }
    );
</script>
<!-- 私有样式 -->
<link rel="stylesheet" href="http://kllife.com/source/Static/home/css/payment.css">
<style>
	#content{margin-top:50px;}
	#content > p strong,.coupon p span, .promotion-code span{color:#ff1c77;}
	#content > a{background: #ff1c77;}
	.benefit .use-benefit{color:#ff1c77;border-color:#ff1c77;}
</style>
	<!-- 主要内容 -->
	<div id="content">
		<h2>核对订单信息</h2>
		<div class="payment-content" data-id="<?php echo ($order["id"]); ?>">
			<!-- 联系人信息 -->
			<div class="consignee-information">
				<h3>联系人信息</h3>
				<p><?php echo ($order["names"]); ?> <?php echo ($order["mob"]); ?></p>
			</div>
			<!-- 订单详情 -->
			<div class="order-details">
				<h3>订单详情</h3>
				<p>订 单 号：<?php echo ($order["order_sn"]); ?></p>
				<p>订单状态：<?php echo ($order["zhuangtai_data"]["type_desc"]); ?></p>
				<p>活动名称：<?php echo ($order["lineid_title"]); ?></p>
				<p>活动时间：<?php echo ($order["hdid_show_text]"]); ?></p>
				<p>联系人：<?php echo ($order["names"]); ?></p>
				<p>联系人电话：<?php echo ($order["mob"]); ?></p>
				<p>参团人数：   <span><?php echo ($order["male"]); ?></span> 男[成人]     <span><?php echo ($order["woman"]); ?></span>  女[成人]      <span><?php echo ($order["child"]); ?></span> 儿童 </p>
				<p>其他费用：
					<?php if(empty($order["extra_cash"])): ?>无<?php endif; ?>
					<?php if(is_array($order["extra_cash"])): $i = 0; $__LIST__ = $order["extra_cash"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ec): $mod = ($i % 2 );++$i; echo ($ec["cash_use_id_data"]["type_desc"]); ?>  <i><?php echo ($ec["cash"]); ?>元</i><?php endforeach; endif; else: echo "" ;endif; ?>
				</p>
				<p>
					系统优惠券:
					<?php if(empty($order["extra_cash"])): ?>无<?php endif; ?>
					<?php if(is_array($order["order_coupon"])): $i = 0; $__LIST__ = $order["order_coupon"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$oc): $mod = ($i % 2 );++$i; echo ($oc["coupon_type_id_data"]["type_desc"]); ?>  <i><?php echo ($oc["cash"]); ?>元</i><?php endforeach; endif; else: echo "" ;endif; ?>
				</p>
			</div>
			<!-- 发票信息 -->
			<?php if($order["receipt_type"] == 1): ?><div class="invoice-information">
					<h3>发票信息 <span>(企业发票)</span></h3>
					<p>单位名称：<?php echo ($oreder["receipt_company"]); ?></p>
					<p>纳税人识别号：<?php echo ($order["receipt_company_no"]); ?></p>
					<p>单位地址：<?php echo ($order["receipt_company_address"]); ?></p>
					<p>电话号码：<?php echo ($order["receipt_company_phone"]); ?></p>
					<p>收件人：<?php echo ($order["receipt_receiver"]); ?></p>
					<p>收件电话：<?php echo ($order["receipt_receiver_phone"]); ?></p>
					<p>收件地址：<?php echo ($order["receipt_receiver_address"]); ?></p>
				</div>
			<?php elseif($order["receipt_type"] == 2): ?>
				<div class="invoice-information">
					<h3>发票信息 <span>(个人发票)</span></h3>
					<p>收件人：<?php echo ($order["receipt_receiver"]); ?></p>
					<p>收件电话：<?php echo ($order["receipt_receiver_phone"]); ?></p>
					<p>收件地址：<?php echo ($order["receipt_receiver_address"]); ?></p>
				</div><?php endif; ?>
			<!--<?php echo p_a($user_coupons);?>-->
			<!-- 优惠券，优惠码 -->
			<div class="benefit">
				<h3>使用优惠/礼品券/抵用<i></i></h3>
				<div class="benefit-div">
					<a class="use-benefit show-coupon" href="javascript:;">优惠券</a>
					<a class="show-code" href="javascript:;">优惠码</a>
					<div class="coupon">
						<?php if(is_array($user_coupons)): $i = 0; $__LIST__ = $user_coupons;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$coupon): $mod = ($i % 2 );++$i; if($coupon['invalid'] == 0 and $coupon['disabled'] == 0 and $c['use'] == 0): ?><a href="javascript:;" title="<?php echo ($coupon["money"]); ?>" data-id="<?php echo ($coupon["id"]); ?>">								<div class="coupon-box">
										<div class="coupon-common coupon-bg-color-3" data-id="<?php echo ($coupon["id"]); ?>">
											<p class="coupon-money">￥<span><?php echo ($coupon["money"]); ?></span>元</p>
											<p><?php echo ($coupon["title"]); ?></p>
											<p>每人每次限用一张</p>
											<p>有效期<?php echo ($coupon["valid_date"]); ?>到<?php echo ($coupon["invalid_date"]); ?></p>
										</div>
									</div>
								</a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						<br/>
						<p>金额抵用<span>￥0.00</span></p>
					</div>
					<div class="promotion-code">
						<h6>请输入优惠券兑换码:</h6>
						<input type="text" maxlength="4">
						-
						<input type="text" maxlength="4">
						-
						<input type="text" maxlength="4">
						-
						<input type="text" maxlength="4">
						<p>金额抵用<span>￥0.00</span></p>
					</div>
				</div>
			</div>
		</div>
		<p>结算信息：<strong>￥</strong><strong class="final_pay_money"><?php echo ($order["final_pay_money"]); ?></strong> 元</p>
		<a class="btn_pay" href="javascript:;">去结算</a>
	</div>
<script type="text/javascript" src="http://kllife.com/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>
<script type="text/javascript">
    jQuery(document).ready(
        function($){
            $("img").lazyload({
                placeholder : "http://kllife.com/source/Static/qinglvpai/common/js/grey.gif",
                effect      : "fadeIn",
                threshold : 100,
                failure_limit : 10
            });
        });
</script>
	<script>
		//优惠券、优惠码隐藏与显示
		$('.benefit h3').click(
			function () {
				$(this).children('i').toggleClass('show-benefit');
				$('.benefit-div').toggle();
			}
		);
		//改变class
		function changeClass(a , b , c){
			$(a).click( function () {
				$(this).siblings(c).removeClass(b);
				$(this).addClass(b);
			} );
		};
		changeClass('.benefit-div > a', 'use-benefit' ,'a');
		
		
		$(document).on('click','.coupon > a',function(){
			$(this).siblings().find('.coupon-common').removeClass('use-coupon');
			$(this).find('.coupon-common').toggleClass('use-coupon');
			
		});

		$('.show-coupon').click( function () {
			$('.coupon').show();
			$('.promotion-code').hide();
		} );
		$('.show-code').click( function () {
			$('.coupon').hide();
			$('.promotion-code').show();
			$('.coupon > a').removeClass('use-coupon');
		} );
		
		//优惠券
		$('.coupon > a').click( function () {
			var couponMoney = $(this).attr('title');
			$('.coupon span').html('￥' + couponMoney + '.00');
			var needPayMoney = parseFloat('<?php echo ($order["final_pay_money"]); ?>') - parseFloat(couponMoney);
			$('.final_pay_money').html(needPayMoney + '.00');
		} );
		//TODO 优惠码
		
		$('.btn_pay').click(function(){
			var couponId = $('.coupon').find('.use-coupon').attr('data-id');
			if (typeof(couponId) == 'undefined') {
				couponId = 0;
			}
            window.open('<?php echo U("line/order");?>/type/pay/id/<?php echo ($order["id"]); ?>/cid/'+couponId) ;
		});
	</script>
<style>
	.footer-bottom-content span{margin-right:0px;}
</style>
	<footer>
		<!--<?php echo p_a($question_type);?>-->
		<div class="footer-content">
			<div class="footer-content-left">
				<?php if(is_array($question_type)): $i = 0; $__LIST__ = $question_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$qt): $mod = ($i % 2 );++$i; if ($key === 'config_update_time') { continue; } ?>
					<ul class="<?php echo ($qt["class"]); ?>">
						<li><?php echo ($qt["type_desc"]); ?></li>
						<?php if(is_array($qt["questions"])): $i = 0; $__LIST__ = $qt["questions"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$quest): $mod = ($i % 2 );++$i;?><li><a target="_blank" href="<?php echo U('service/question');?>/id/<?php echo ($quest["id"]); ?>"><?php echo ($quest["content"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<div class="footer-content-right">
				<img src="http://kllife.com/source/Static/qinglvpai/common/images/footer_erweima.png" alt="">
			</div>
		</div>
	</footer>
	<div class="footer-bottom">
		<div class="footer-bottom-content">
			<!--<p>
				友情链接：
				<?php if(is_array($pcset)): $i = 0; $__LIST__ = $pcset;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$set_val): $mod = ($i % 2 );++$i; if(stripos($key, 'pc_friend_link') === 0): if(!empty($fk)): ?>&nbsp;|&nbsp;<?php endif; ?>
						<?php $fk = json_decode($set_val, true); ?>
						<a href="<?php echo ($fk["url"]); ?>" target="_blank"><?php echo ($fk["text"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</p>-->
			<span style="margin-top: 20px;">Copyright  2017 <a href="http://xiezhenlvxing.com" target="_blank" style="color:#fff;">xiezhenlvxing.com</a> | 杭州浪客旅行社有限公司版权所有</span>
			<br>
			<span>旅行社经营许可证号：ZJ30301 浙ICP备17010959号
			<span>
				<!--商务通代码--> 
				<script language="javascript" src="http://pqt.zoosnet.net/JS/LsJS.aspx?siteid=PQT43116159&float=1&lng=cn"></script>
				<script language="javascript" type="text/javascript" src="http://kllife.com/swt_xlp/js/swt.js"></script>
				<!--CNZZ统计--> 
				<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1261595265'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1261595265%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
				<!--百度统计-->
				<script>
					var _hmt = _hmt || [];
					(function() {
						var hm = document.createElement("script");
						hm.src = "https://hm.baidu.com/hm.js?5b19bad2c5e7328683965e7447d46f4c";
						var s = document.getElementsByTagName("script")[0]; 
						s.parentNode.insertBefore(hm, s);
					})();
				</script>
			</span>
		</div>
	</div>
	
	<!-- Imported toastr -->
	<script src="http://kllife.com/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="http://kllife.com/source/Static/common/js/functions.js"></script>

	
</body>
</html>