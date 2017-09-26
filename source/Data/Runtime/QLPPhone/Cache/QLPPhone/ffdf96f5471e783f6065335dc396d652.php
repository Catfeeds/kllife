<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
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
    
	<meta content="新旅拍" name="author"/>
	<?php if(empty($PageKeyword) == false): ?><meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
	<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
	<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
	<title><?php echo ($PageKeyword["title"]); ?></title>
	<?php else: ?>
	<title><?php echo C('PAGE_TITLE');?>-新旅拍</title><?php endif; ?>
	<!-- jq -->
	<script src="http://kllife.com/source/Static/phone/common/js/jquery.min.js"></script>
	<script type="text/javascript">	
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
			    var vurl = window.location.href;
			    if (vurl.indexOf('www.') != -1) {
                    vurl = window.location.href.replace(/www./g, '');
                }
                var vhref = vurl.replace(/m\./g, '').replace(/qinglvpai/g,'qlpphone');
               	window.location.href = vhref;
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
	
	<link rel="stylesheet" href="http://kllife.com/source/Static/phone/common/css/light7.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/common/css/common.css">
	<!-- Imported toastr -->
	<script src="http://kllife.com/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="http://kllife.com/source/Static/common/js/jquery-1.11.1.min.js"></script>
	<script src="http://kllife.com/source/Static/common/js/functions.js"></script>
	<style>
		.black-mark { display: none; position: fixed; top:0; left:0; width: 100%; height: 100%; text-align: center; color:#fff; background: rgba(0,0,0,.5); z-index:3000; }
		.black-mark p { margin-top: 230px; color: #fff; text-align: center; }
	</style>
</head>
<body>
	<div class="black-mark">
		<p>稍等一会儿...</p>
	</div>
	<!-- mycss -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/phone/css/order_detail.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/common/css/animate.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/common/css/top2.css">
	<style>
		.content{top:60px;width:100%;margin-bottom:60px;}
		.content-padded{margin-top:0px;}
		.order-details-money .row .col-30:last-child,.order-details-header p span{color:#ff1c77;}
	</style>
	<div class="page">
		<div class="header">
    <div class="menu animated bounceInLeft">
        <!--<i class="iconfont">&#xe603;</i>-->
    </div>
    <div class="logo"><a href="javascript:;"><img style="width:155px;" class="animated bounceInDown" src="http://kllife.com/source/Static/qlpphone/common/images/logo-qinglvpai.png" alt=""></a></div>
    <div class="search animated bounceInRight">
        <!--<i class="iconfont">&#xe67a;</i>-->
    </div>
    <div class="search-block">
        <div class="input-group" style="text-align: center">
            <input type="text" class="form-control" placeholder="特惠线路...">
            <span class="input-group-btn">
                        <button class="btn btn-orange-one" type="button">搜索</button>
                    </span>
        </div>
    </div>
    <div class="top">
        <div class="menu-block">
            <ul>
                <a href="<?php echo U('index/welcome');?>" external><li>首页</li></a>
                <a href="javascript:;" external><li>品牌故事</li></a>
                <a href="<?php echo U('line/list');?>" external><li>新旅拍</li></a>
                <a href="http://kllife.com/phone/index.php?s=/phone/line/list" external><li>小团慢旅行</li></a>
                <a href="<?php echo U('Leader/list');?>" external><li>摄影师</li></a>
                <!--<a href="<?php echo U('line/artile');?>" external><li>线路回顾</li></a>-->
            </ul>
        </div>
    </div>
</div>
		<div class="footer">
	<a href="<?php echo U('index/welcome');?>" external>
		<div class="selected active">
			<i class="iconfont">&#xe629;</i>
			<p>首页</p>
		</div>
	</a>
	<a href="<?php echo U('line/list');?>" external>
		<div class="selected">
			<i class="iconfont">&#xe633;</i>
			<p>写真旅行</p>
		</div>
	</a>
	<a href="<?php echo ($pcset["askfor_link"]); ?>" external>
		<div class="selected">
			<i class="iconfont">&#xe66e;</i>
			<p>咨询</p>
		</div>
	</a>
	<a href="<?php echo U('Leader/list');?>" external>
		<div class="selected">
			<i class="iconfont">&#xe60f;</i>
			<p>摄影师</p>
		</div>
	</a>
	<a href="<?php echo U('user/info');?>" external>
		<div class="selected">
			<i class="iconfont">&#xe6a3;</i>
			<p>我的</p>
		</div>
	</a>
</div>
<script type="text/javascript" src="http://kllife.com/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>
<script type="text/javascript">
    jQuery(document).ready(
        function($){
            $("img").lazyload({
                placeholder : "http://kllife.com/source/Static/qinglvpai/common/js/grey.gif",
                effect      : "fadeIn",
                threshold : 0
            });
        });
</script>
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
<script type="text/javascript">
    //点击显示与隐藏菜单
//    $(".header .menu").on("click",function(){
//        $(".header .search-block").slideUp(500);
//        if(!$(".header .top").is(':visible')){
//            $(".header .top").slideDown(500);
//		}
//    })
//    $(".header .menu i").on("click",function(){
//        $(".header .search-block").slideUp(500);
//            $(".header .top").slideUp(500);
//    })

    //点击显示与隐藏搜索
//    $(".header .search").on("click",function(){
//        $(".header .top").slideUp(500);
//        if(!$(".header .search-block").is(':visible')){
//            $(".header .search-block").slideDown(500);
//        }
//    })
//    $(".header .search i").on("click",function(){
//        $(".header .top").slideUp(500);
//        $(".header .search-block").slideUp(500);
//    })

    //底部点击切换选中状态
//    $(".footer div").on("click",function(){
//        $(this).addClass("active").find("p").addClass("active");
//        $(this).addClass("active").find("i").addClass("active");
//        $(this).parent("a").siblings().find("div").removeClass("active").find("p").removeClass("active");
//        $(this).parent("a").siblings().find("div").removeClass("active").find("i").removeClass("active");
//    })
    $('.footer a').each(function(){
        if($($(this))[0].href==String(window.location)){
            $(this).find(".selected").addClass('active').parent("a").siblings("a").find(".selected").removeClass("active");
//            alert($($(this))[0].href==String(window.location))
//            alert(String(window.location))
        }
    });

    //屏幕滚动显示一键返回顶部按钮
    $(window).scroll( function (){
        if ($(this).scrollTop() > 100) {
            $('.return-top').fadeIn();
        }else{
            $('.return-top').fadeOut();
        };
    });

    //点击返回顶部
    $(".return-top").click(
        function(){
            $("html,body").animate({scrollTop: 0}, 1000);
        }
    );
</script>
		<div class="content">
			<div class="order-details-header">
				<div class="content-padded">
					<p>亲爱的用户 <span><?php echo ($user["show_name"]); ?></span> ，您好！您于<?php echo ($order["addtime_show"]); ?> 的订单（订单号：<?php echo ($order["order_sn"]); ?>）详情如下，请您再次认真核实该订单信息，如您发现当前订单错误或有任何疑问请与客服联系，客服电话：400-080-5860或咨询在线客服；当前订单状态为<span>已审核</span>请进入个人中心进行付款，以免耽误行程。</p>
				</div>
			</div>
			<!-- 订单详情 -->
			<div class="order-details-content">
				<div class="content-padded">
					<h4>订单详情</h4>
					<div class="row no-gutter">
						<div class="col-25">订单号</div><div class="col-75"><?php echo ($order["order_sn"]); ?></div>
						<div class="col-25">订单状态</div><div class="col-75"><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></div>
						<div class="col-25">活动名称</div><div class="col-75"><?php echo ($order["lineid_title"]); ?></div>
						<div class="col-25">活动时间</div><div class="col-75"><?php echo ($order["hdid_show_text"]); ?></div>
						<div class="col-25">联系人</div><div class="col-75"><?php echo ($order["names"]); ?></div>
						<div class="col-25">联系电话</div><div class="col-75"><?php echo ($order["mob"]); ?></div>
						<div class="col-25">参团人数</div><div class="col-75"><span><?php echo ($order["male"]); ?></span> 男[成人]   <span><?php echo ($order["woman"]); ?></span> 女[成人]    <span><?php echo ($order["child"]); ?></span> 儿童</div>
						<div class="col-25">其他费用</div><div class="col-75">
							<p>额外费用:
								<?php if(empty($order["extra_cash"])): ?>无<?php endif; ?>
								<?php if(is_array($order["extra_cash"])): $i = 0; $__LIST__ = $order["extra_cash"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ec): $mod = ($i % 2 );++$i; echo ($ec["cash_use_id_data"]["type_desc"]); ?>  <strong><?php echo ($ec["cash"]); ?>元</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
							</p>
							<p>
								系统优惠:
								<?php if(empty($order["extra_cash"])): ?>无<?php endif; ?>
								<?php if(is_array($order["order_coupon"])): $i = 0; $__LIST__ = $order["order_coupon"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$oc): $mod = ($i % 2 );++$i; echo ($oc["coupon_type_id_data"]["type_desc"]); ?>  <i><?php echo ($oc["cash"]); ?>元</i><?php endforeach; endif; else: echo "" ;endif; ?>
							</p>
						</div>
					</div>
				</div>
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
			<!-- 订单联系人信息 -->
			<div class="order-details-contact">
				<div class="content-padded">
					<h4>订单联系人信息</h4>
					<?php if(is_array($order["members"])): $i = 0; $__LIST__ = $order["members"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?><div class="row no-gutter">
							<div class="col-25">姓名</div><div class="col-75"><?php echo ($m["name"]); ?></div>
							<div class="col-25">手机号码</div><div class="col-75"><?php echo ($m["tel"]); ?></div>
							<div class="col-25">证件</div><div class="col-75"><p><?php echo ($m["certificate_type_id_data"]["type_desc"]); ?> <?php echo ($m["certificate_num"]); ?></p><p>出生日期 <?php echo ($m["birthday"]); ?></p></div>
							<div class="col-25">性别</div><div class="col-75"><?php echo ($m["type_id_data"]["type_desc"]); ?></div>
							<div class="col-25">状态</div><div class="col-75"><?php if($m['exit'] == 0): ?>在团<?php else: ?>已退团<?php endif; ?></div>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
			<!-- 订单消费 -->
			<div class="order-details-money">
				<div class="content-padded">
					<div class="row no-gutter">
						<div class="col-70">订单需支付</div><div class="col-30">￥<?php echo ($order["need_pay_money"]); ?></div>
						<div class="col-70">团费(含活动减免)</div><div class="col-30">￥<?php echo ($order["team_cut_price"]); ?></div>
						<div class="col-70">其他(额外费用与系统优惠)</div><div class="col-30">￥<?php echo ($order["other_money"]); ?></div>
						<div class="col-70">优惠券</div><div class="col-30">-￥<?php echo ($order["coupon_money"]); ?></div>
						<div class="col-70">实付金额</div><div class="col-30"><p>￥<?php echo ($order["pay_money"]); ?></p></div>
					</div>
				</div>
			</div>

		</div>
	</div>
	
	

<!-- light7 -->
<script src="http://kllife.com/source/Static/phone/common/js/light7.js"></script>
<!-- i18n 中文 -->
<script src="http://kllife.com/source/Static/phone/common/js/cn.js"></script>
<!--公用JS文件-->
<script src="http://kllife.com/source/Static/common/js/functions.js"></script>
<!--商务通代码--> 
<script language="javascript" src="http://pqt.zoosnet.net/JS/LsJS.aspx?siteid=PQT43116159&lng=cn"></script>
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
	<script>
		$( function(){
			$.init();
		})
	</script>

</body>
</html>