<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title></title>
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
	<script src="/source/Static/common/js/jquery-1.11.1.min.js"></script>
</head>
<body>
	station_id=><?php echo ($station_id); ?><br />
	station=><?php echo p_a($station);?><br />
	set=><br />
	<?php if(is_array($set)): $i = 0; $__LIST__ = $set;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?>id:<?php echo ($s["id"]); ?>,title:<?php echo ($s["title"]); ?><br /><?php endforeach; endif; else: echo "" ;endif; ?>
	
	<a class="test_pay" href="javascript:;">支付测试</a>
	<script type="text/javascript">
		$('.test_pay').click(function(){
			var dt = new Date();
			$.post('http://www.kllife.com/back/index.php?s=/back/external/alipayresult',
				{
					out_trade_no: '123213',
					trade_no: 'kdpoqwkdpqwkd',
					total_fee: '0.01',
					notify_time: 1486475700,
				},
				function(data){
					console.log(JSON.stringify(data));
				});
		});
	</script>
</body>
</html>