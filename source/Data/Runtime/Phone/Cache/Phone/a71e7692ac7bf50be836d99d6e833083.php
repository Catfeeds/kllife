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
<link rel="stylesheet" href="/source/Static/qlpphone/common/css/top2.css">
<link rel="stylesheet" href="/source/Static/qlpphone/css/index.css">
<link rel="stylesheet" href="/source/Static/phone/css/content.css">
<style type="text/css">
	.active { background: #ff1c77; border-color: #ff1c77;}
	.content .travel .may-apply div .active p{color: #fff; }
	h2,h3,h4{font-weight: 500}
	.detail img{width:100%;height:auto;}
/*	.content .travel .may-apply div .active .color {color: #3BB412; }*/
</style>
<div class="phone index content">
	<div class="top" style="background: #fff;">
		<div href="javascript:;" style="position: relative;display: block">
			<img class="img-responsive" style="width:100%;" src="<?php echo ($line["img1"]); ?>" alt="">
			<div style="position: absolute;bottom:5px;left:0px;height:40px;line-height:40px;padding-left:10px;font-size:15px;width:100%;color:#fff;background: rgba(0,0,0,0.5)">编号：<?php echo ($line["id"]); ?></div>
		</div>
		<div class="recommend">
			<h2><?php echo ($line["title"]); ?></h2>
			<p><?php echo ($line["subheading"]); ?></p>
			<div>
				<span class="price">
					<?php if(empty($line['check_price'])): ?><span class="number">核算中</span>
					<?php else: ?>
						¥<span class="number"><?php echo ($line["start_price_adult"]); ?></span><span class="yuan">元起</span><?php endif; ?>
				</span>
				<span class="place">出发地：<?php echo ($line["assembly_point_show_text"]); ?></span>
			</div>
		</div>
	</div>
    <!-出行日期->
    <div class="travel">
        <div class="data"><span class="see">查看出行日期</span> <span style="float: right;margin-top:-5px;"><i id="down" class="iconfont">&#xe632;</i></span></div>
        <div class="may-apply">
        	<?php if(is_array($line["batchs"])): $i = 0; $__LIST__ = $line["batchs"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bv): $mod = ($i % 2 );++$i;?><div class="batch-container">
	                <div class="batch-item" data-id="<?php echo ($bv['id']); ?>">
	                    <p class="color" data-id="<?php echo ($bv['id']); ?>"><?php echo ($bv['start_date_show']); ?></p>
	                    <p>[<?php echo ($bv['state_data']['type_desc']); ?>]</p>
	                </div>
	            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="detail">
        	<?php if(is_array($line["phone_points"])): $i = 0; $__LIST__ = $line["phone_points"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$point): $mod = ($i % 2 );++$i; if($point["image_url"] != ''): ?><img class="img-responsive" src="<?php echo ($point["image_url"]); ?>" alt=""><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <!-行程说明->
    <div class="line explain">
        <h2>行程说明</h2>
        <div class="border-bottom"><!-此div只用于显示birder-></div>
		<?php if(is_array($line["travels"])): $i = 0; $__LIST__ = $line["travels"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$travel): $mod = ($i % 2 );++$i;?><div class="item">
        		<?php if(empty($travel['img1']) == false): ?><img class="img-responsive" src="<?php echo ($travel['img1']); ?>" alt="">
        		<?php elseif(empty($travel['img2']) == false): ?>
	            	<img class="img-responsive" src="<?php echo ($travel['img2']); ?>" alt="">
        		<?php elseif(empty($travel['img3']) == false): ?>
	            	<img class="img-responsive" src="<?php echo ($travel['img3']); ?>" alt=""><?php endif; ?>
	            <?php if($key == 0): ?><div>
	            <?php else: ?>
            	<div class="background-color"><?php endif; ?>
	                <h4>Day<?php echo ($travel["day_id"]); ?>：<?php echo ($travel["title"]); ?></h4>
					<?php if(!empty($travel["view_point"])): ?><div class="div">> 浏览重点：<?php echo ($travel["view_point"]); ?></div><?php endif; ?>
	                <div><?php echo ($travel["intro"]); ?></div>
	                <?php if(!empty($travel["hotel"])): ?><div class="div">> 住宿：<?php echo ($travel["hotel"]); ?></div><?php endif; ?>
					<?php if(!empty($travel["eat_way"])): ?><div class="div">> 餐饮：<?php echo ($travel["eat_way"]); ?></div><?php endif; ?>
					<?php if(!empty($travel["kindly_reminder"])): ?><div>> 温馨提示：<?php echo ($travel["kindly_reminder"]); ?></div><?php endif; ?>
	            </div>
	        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <!-费用说明->
    <div class="line reserve">
        <h2>预定须知</h2>
        <div class="border-bottom"><!-此div只用于显示birder-></div>
        <div class="item">
            <h4><span>|</span>费用说明</h4>
        	<div><?php echo ($line["cost_description"]); ?></div>
        </div>
    </div>
    <!-预定须知->
    <div class="line reserve reserve-two">
        <div class="item">
            <h4><span>|</span>预订须知</h4>
			<div><?php echo ($line["booking_notes"]); ?></div>
        </div>
    </div>
    <!-沿途风光->
    <div class="line reserve reserve-two scenery">
        <div class="item">
            <h4><span>|</span>沿途风光</h4>
        </div>
		<?php if(is_array($scenery)): $i = 0; $__LIST__ = $scenery;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sc): $mod = ($i % 2 );++$i;?><div class="scenery-two">
	            <img class="img-responsive" src="<?php echo ($sc["image"]); ?>" alt="">
	            <div><?php echo ($sc["text"]); ?></div>
	        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    
    <!--footer-->
    <div class="footer-two" style="z-index:99999999">
        <a href="javascript:;"><div class="div"><img class="img-responsive" src="/source/Static/qlpphone/images/content/zx2.jpg" alt=""></div></a>
        <a href="javascript:;"><div class="reserve-btn book_order_now">立即预定</div></a>
    </div>
	<!--点击返回顶部-->
	<div class="return-top" style="z-index:100000000;"><i class="iconfont" style="font-size: 50px;">&#xe68f;</i></div>
</div>

<script>
    //点击展开出行日期
    $("#down").on("click",function(){
        if($(".may-apply").is(":hidden")){
            $(".may-apply").slideDown(700);
            $(this).addClass("rotate").removeClass("rotate1");
        }else{
            $(".may-apply").slideUp(700);
            $(this).removeClass("rotate").addClass("rotate1")
        }
    })


	// 选择定日期
	$('.batch-container').click(function(){
		$(this).parent().find('.batch-item').removeClass('active');
		$(this).find('.batch-item').addClass('active');
		var batchId = $(this).find('.batch-item').attr('data-id');
		location.href = '<?php echo U("line/order");?>/id/<?php echo ($line["id"]); ?>/type/create/b/'+batchId+'/m/0/w/0/ch/0';
	});

	// 立即预定
	$('.book_order_now').click(function(){
//		if ($('.may-apply').find('.active').length == 0) {
//			alert('请选择出行的日期');	
//			return false;
//		}			
//		var batchId = $('.may-apply').find('active').attr('data-id');

		location.href = '<?php echo U("line/order");?>/id/<?php echo ($line["id"]); ?>/type/create/b/0/m/0/w/0/ch/0';
	});

    //屏幕滚动显示一键返回顶部按钮
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $(".return-top").show();
        }else{
            $(".return-top").hide();
        }
    });
    //点击返回顶部
    $(".return-top").on("click",function(){
        $("html,body").animate({scrollTop: 0}, 1000);
    });
</script>