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
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/css/pay_immediately.css">
	<style>
		.pay-mark { display: none; position: fixed; top:0; left:0; width: 100%; height: 100%; background:rgba(0,0,0,.5); z-index:999; }
		.pay-code-content { display: none; position: fixed; top: 50%; left: 37.5%; margin-top: -150px; width:25%; height: 330px; padding: 10px 15px; background: #fff; z-index:1000; }
		.pay-code-content h4 { position: relative; margin-bottom: 17px; font-size: 20px; line-height:2; text-align: center;text-align: -webkit-center;}
		.pay-code-content a { 
			width: 16px;
		    height: 16px;
		    position: absolute;
		    right: 0;
		    top: -2px;
		    color: #999;
		    text-decoration: none;
		    font-size: 16px;
		 }
		.pay-code { text-align:center; }
		.pay-code img { width:185px; height: 185px; }
		.pay-code-content .btn_pay {
			display: block;
			width: 60%;
			height: 2.7rem;
			line-height: 2.7rem;
			margin-top: 17.5rem;
			color: #fff;
			background-color: #ff7200;
			border-radius: 5px;
			text-align: center;
			right:20%;
			cursor:pointer;
		}
		#content{margin-top:50px;}
		.all-money h5{margin-top:20px;}
		.all-money span strong,.all-or-part p strong,.payAmount-area .amount-font-22,.qrcode-header-money{color:#ff1c77;}
		.platform-pay .platform-checked{border-color:#ff1c77;}
		.choose-payment-form > a,.pay-code-content .btn_pay{background: #ff1c77;}
		.all-or-part p{margin-top:0px;}
		.payment-form{padding-top:30px;}
		.platform-pay h3 i{background-image: url(http://kllife.com/source/Static/qinglvpai/images/article/pay_immediately.png);}
	</style>
	<!-- 主要内容 -->
	<div id="content">
		<!-- 总金额 -->
		<div class="all-money">
			<h5>订单提交成功，请您尽快付款！ 订单号：<?php echo ($order["order_sn"]); ?></h5>
			<!--<p>请您在提交订单后 <i>24小时</i> 内完成支付，否则订单会自动取消。</p>-->
			<span>总金额：<strong>￥<?php echo ($order["need_pay_money"]); ?></strong>元</span>
		</div>
		<!-- 选择支付形式 -->
		<div class="payment-form">
			<div class="choose-payment-form">
				<div class="all-or-part">
					<!--<h3>请选择你的支付形式</h3>
					<div class="choose-all-or-part">
						<a class="pay-checked all" href="javascript:;">支付全款</a>
						<?php if($order['exist_pay_log'] == 0): ?><a class="part" href="javascript:;">支付部分款</a>
							<span>* （为了方便您的出行领袖户外为您提供了两种付款方式：1支付全款，一次性支付所有费用：2支付预付款,支付订单金额都50%作为预付款，剩   余尾款在参团前一并付清。请您根据实际情况选择一项适合您定方式进行付）</span><?php endif; ?>
					</div>-->
					<p>你本次付款需支付：<strong>￥</strong><strong class="final_pay_money"><?php echo ($order["final_pay_money"]); ?></strong>元</p>
				</div>
				<div class="platform-pay">
					<h3><i class="platform-pay-checked"></i>平台支付</h3>
					<ul>
						<li id="zhifubao" class="platform-checked"><i></i></li>
						<li id="weixin"><i></i></li>
					</ul>
				</div>
				<a class="btn_pay" href="javascript:;">立即支付</a>
				<div id="popup_pay"></div>
			</div>
		</div>           
	</div>
	
	<div id="ceshi"></div>
	
	<!--弹出二维码-->
	<div class="pay-mark"></div>
	<div class="pay-code-content">
		<h4>微信扫描二维码完成付款<a href="javascript:;">x</a></h4>
		<div class="pay-code">
			<img src="" alt="二维码"/><br>
			<a id="btn_pay_complated" class="btn_pay" type="button" >付款完成，点击查看结果</a>
		</div>
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
	
		//选择储蓄卡、银行卡支付
		$('.card-pay h3 i').click( function () {
			//添加选定样式
			$(this).addClass('card-pay-checked');
			//移除选择平台
			$('.platform-pay h3 i').removeClass('platform-pay-checked');
			$('.choose-card').show();
			$('.card-pay > a').show();
			$('.platform-pay ul').hide();
			//移除已经选择的平台样式
			$('.platform-pay li').removeClass('platform-checked');
		} );
		//选择平台支付
		$('.platform-pay h3 i').click( function () {
			//添加选定样式
			$(this).addClass('platform-pay-checked');
			//移除选择储蓄卡、银行卡支付
			$('.card-pay h3 i').removeClass('card-pay-checked');
			$('.platform-pay ul').show();
			$('.choose-card').hide();
			$('.card-pay > a').hide();
			//移除已经选择的银行样式
			$('.choose-card li').removeClass('bank-checked');
		} );
		$('.platform-pay h3 i').trigger('click');
		
		//改变class
		function changeClass(a , b , c){
			$(a).click( function () {
				$(this).siblings(c).removeClass(b);
				$(this).addClass(b);
				if ($(this).parent().hasClass('choose-all-or-part')) {
					var finalPayMoney = '<?php echo ($order["final_pay_money"]); ?>';
					if ($(this).hasClass('part')) {
						finalPayMoney = 0.5 * parseFloat('<?php echo ($order["final_pay_money"]); ?>');		
					}
					$(this).parent().next().find('.final_pay_money').html(finalPayMoney);
				}
			} );
		};
		changeClass('.choose-all-or-part > a', 'pay-checked' , 'a');
		changeClass('.card-pay > a', 'card-checked' , 'a');
		changeClass('.choose-bank-card li', 'bank-checked' , 'li');
		changeClass('.choose-credit-card li', 'bank-checked' , 'li');
		changeClass('.platform-pay li', 'platform-checked' , 'li');

		//网上银行、信用卡切换
		$('#wangyin').click( function () {
			$('.choose-bank-card').show();
			$('.choose-credit-card').hide();
			//信用卡选择移除样式
			$('.choose-credit-card li').removeClass('bank-checked');
		} );
		$('#xinyongka').click( function () {
			$('.choose-bank-card').hide();
			$('.choose-credit-card').show();
			//储蓄卡选择移除样式
			$('.choose-bank-card li').removeClass('bank-checked');
		} );
		
		$('.btn_pay').click(function(){			
			var payType = '', payChannel='', payBank='';
			var payTypeObj = $('.card-pay-checked').parent().parent();
			if ($(payTypeObj).hasClass('card-pay')) {
				payType = 'chuxuxinyong';
				payChannel = $('.card-checked').attr('id');
				payBank = $('.bank-checked').attr('data-bank');
			} else {
				payType = 'platform';
				payChannel = $('.platform-checked').attr('id');
			}
//			var payMoneyType = $('.choose-all-or-part').find('.pay-checked').hasClass('all') ?  1 : 0;
			var jsonData = {
				op_type: 'pay',
				id: '<?php echo ($order["id"]); ?>',
				pay_money_all: 1,
				pay_type: payType,
				pay_channel: payChannel,
				pay_bank: payBank,
			}
			$.post('<?php echo U("line/order");?>', jsonData, function(data){
//				console.log(JSON.stringify(data));
//				alert('支付接口正在维护，请稍后再试，谢谢配合!!!');
				if (data.html != null) {
					$('#popup_pay').html(data.html);
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
			});
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