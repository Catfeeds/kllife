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
	<link rel="stylesheet" href="/source/Static/phone/css/order_detail.css">
	<div class="page">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="javascript:history.back();">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">订单详情</h1>
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
			<div class="order-details-header">
				<div class="content-padded">
					<p>亲爱的用户 <span><?php echo ($user["show_name"]); ?></span> ，您好！您于<?php echo ($order["addtime_show"]); ?> 的订单（订单号：<?php echo ($order["order_sn"]); ?>）详情如下，请您再次认真核实该订单信息，如您发现当前订单错误或有任何疑问请与客服联系，客服电话：400-080-5860或咨询在线客服；当前订单状态为<span><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></span>请尽快咨询客服人员，以免耽误行程。</p>
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
		$( function(){
			$.init();
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