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
<!-- swiper -->
<link rel="stylesheet" href="/source/Static/phone/common/css/swiper-3.3.1.min.css">
<!-- mycss -->
<link rel="stylesheet" href="/source/Static/phone/css/line_content_test.css">
<style>
	.xingcheng-href{
		width:100%;
		background: #fff;
		overflow: hidden;
		margin:10px 0px;
	}
	.xingcheng-href a{
		display: inline;
		float: left;
		margin:auto;
		text-align: center;
		text-align: -webkit-center;
	}
	.xingcheng-href a:nth-child(1){width:40%;}
	.xingcheng-href a:nth-child(2){width:30%;}
	.xingcheng-href a:nth-child(3){width:30%;}
	.xingcheng-href a img{width:auto!important;height:45px;}
	.choose-startday h3{padding: .7rem 0.5rem 0;}
</style>
		<header class="bar bar-nav">
			<?php if(empty($duid) == true): ?><a class="button button-link button-nav pull-left back" href="<?php echo U('line/list');?>">
			      <i class="iconfont">&#xe606;</i>
			    </a>
			<?php else: ?>
				<a class="button button-link button-nav pull-left back" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>">
			      <i class="iconfont">&#xe606;</i>
			    </a><?php endif; ?>
		    <h1 class="title">产品详情</h1>
		</header>
		<nav class="bar bar-tab">
			<a class="tab-item active" href="<?php echo ($pcset["askfor_link"]); ?>" external>
		      <i class="iconfont">&#xe602;</i>
		      <span>咨询</span>
		    </a>
			<?php if(empty($duid) == true): ?><a class="tab-item" style="width: 3%; background-color: #ff7200; color: #fff;" href="<?php echo U('line/order');?>/type/create/id/<?php echo ($line["id"]); ?>" external>
			      <span>立即预定</span>
			    </a>
			<?php else: ?>
			    <a class="tab-item" style="width: 3%; background-color: #ff7200; color: #fff;" href="<?php echo U('line/order');?>/type/create/id/<?php echo ($line["id"]); ?>/duid/<?php echo ($duid); ?>" external>
			      <span>立即预定</span>
			    </a><?php endif; ?>
		</nav>

		<div class="content">
			<div class="content-top">
				<img src="<?php echo ($line["img1"]); ?>" alt="">
				<p>产品编号：<?php echo ($line["id"]); ?></p>
				<h3><?php echo ($line["title"]); ?></h3>
				<h5><?php echo ($line["subheading"]); ?></h5>
				<div class="card-footer">
					<a href="#" class="link">出发地：<?php echo ($line["assembly_point_show_text"]); ?></a>
					<a href="#" class="link">
						<?php if(empty($line['check_price'])): ?><strong>核算中</strong>
						<?php else: ?>
							<span>￥</span><strong><?php echo ($line["start_price_adult"]); ?></strong>元/人起<?php endif; ?>
					</a>
			    </div>
			</div>
			<!-- 选择出发日期和人数 -->
			<div class="choose-startday">
				<?php if(empty($duid) == true): ?><a href="<?php echo U('line/order');?>/type/create/id/<?php echo ($line["id"]); ?>" external><h3>选择：查看出行日期和人数</h3></a>
				<?php else: ?>
					<a href="<?php echo U('line/order');?>/type/create/id/<?php echo ($line["id"]); ?>/duid/<?php echo ($duid); ?>" external><h3>选择：查看出行日期和人数</h3></a><?php endif; ?>
				<?php if(empty($line['batch_top']) != true): ?><div class="swiper-container tuanqi">
						<div class="swiper-wrapper">
							<?php if(is_array($line["batch_top"])): $i = 0; $__LIST__ = $line["batch_top"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bt): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
									<div class="div" data-batch-id="<?php echo ($bt["id"]); ?>">
										<span><?php echo ($bt["start_date_show_str"]); ?></span><span><?php echo ($bt["start_date_show_week"]); ?></span>
										<p>￥<?php echo ($bt["price_adult"]); ?></p>
									</div>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div><?php endif; ?>
				
			</div>
			<!-- 切换 -->
			<div id="tabs">
				<a href="javascript:;" class="a1 active" title="line-special" external>线路特色</a>
				<a class="a2" href="javascript:;" external title="travel-introduction">行程介绍</a>
				<a class="a3" href="javascript:;" external title="reserve-notes">预订须知</a>
			</div>
			<!-- 线路特色 -->
			<div id="line-special">
				<div class="content-padded">
					<h4>线路特色</h4>
					<?php if(is_array($line["phone_points"])): $i = 0; $__LIST__ = $line["phone_points"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i; if(empty($p[image_url]) == true): ?><span><?php echo ($p["content"]); ?></span>
						<?php else: ?>
						<img src="<?php echo ($p["image_url"]); ?>" /><?php endif; ?>
						<?php if($line['id'] == 337 and $p['index'] == 2): ?><p style="text-align: center; line-height:0;margin:10px 0px;">
								<video poster="http://old.kllife.com/uploadfile/allimg/161110/1423554921-1.jpg" height="100%" width="100%" controls="controls"  x5-video-player-type="h5"/>
								<source src="http://7xosrp.com1.z0.glb.clouddn.com/xb_ssyd_sp.mp4" type="video/mp4">
								</video>
							</p><?php endif; ?>
						<?php if($line['id'] == 337 and $p['index'] == 9): ?><p style="text-align: center; line-height:0;margin:10px 0px;">
								<video poster="/source/Static/home/common/images/silk_video_banner-phone.jpg" height="100%" width="100%" controls="controls"  x5-video-player-type="h5"/>
								<source src="/source/Static/home/mp4/haibin-house.mp4" type="video/mp4">
								</video>
							</p><?php endif; ?>
						<?php if($line['id'] == 274 and $p['index'] == 20): ?><p style="text-align: center; line-height:0;margin:10px 0px;">
								<video poster="/source/Static/home/common/images/silk_video_banner-phone.jpg" height="100%" width="100%" controls="controls"  x5-video-player-type="h5"/>
								<source src="/source/Static/home/mp4/haibin-house.mp4" type="video/mp4">
								</video>
							</p><?php endif; ?>
						<?php if($line['id'] == 273 and $p['index'] == 26): ?><p style="text-align: center;line-height:0;margin:10px 0px;">
								<video poster="/source/Static/home/common/images/silk_video_banner-phone.jpg" height="100%" width="100%" controls="controls"  x5-video-player-type="h5"/>
								<source src="/source/Static/home/mp4/haibin-house.mp4" type="video/mp4">
								</video>
							</p><?php endif; ?>
						<?php if($line['id'] == 272 and $p['index'] == 7): ?><p style="text-align: center; line-height:0;margin:10px 0px;">
								<video poster="/source/Static/home/common/images/silk_video_banner-phone.jpg" height="100%" width="100%" controls="controls"  x5-video-player-type="h5"/>
								<source src="/source/Static/home/mp4/haibin-house.mp4" type="video/mp4">
								</video>
							</p><?php endif; ?>
						<?php if($line['id'] == 341 and $p['index'] == 10): ?><p style="text-align: center; line-height:0;margin:10px 0px;">
								<video poster="/source/Static/home/common/images/silk_video_banner-phone.jpg" height="100%" width="100%" controls="controls"  x5-video-player-type="h5"/>
								<source src="/source/Static/home/mp4/haibin-house.mp4" type="video/mp4">
								</video>
							</p><?php endif; ?>

						<?php if($line['id'] == 273 and $p['index'] == 31): ?><div class="xingcheng-href">
								<a href="http://kllife.com/phone/index.php?s=/phone/line/info/id/337" external><img src="/source/Static/phone/images/content_img/1.png" alt=""></a>
								<a href="http://kllife.com/phone/index.php?s=/phone/line/info/id/273" external><img src="/source/Static/phone/images/content_img/2.png" alt=""></a>
								<a href="http://kllife.com/phone/index.php?s=/phone/line/info/id/341" external><img src="/source/Static/phone/images/content_img/3.png" alt=""></a>
							</div><?php endif; ?>
						<?php if($line['id'] == 337 and $p['index'] == 31): ?><div class="xingcheng-href">
								<a href="http://kllife.com/phone/index.php?s=/phone/line/info/id/337" external><img src="/source/Static/phone/images/content_img/1.png" alt=""></a>
								<a href="http://kllife.com/phone/index.php?s=/phone/line/info/id/273" external><img src="/source/Static/phone/images/content_img/2.png" alt=""></a>
								<a href="http://kllife.com/phone/index.php?s=/phone/line/info/id/341" external><img src="/source/Static/phone/images/content_img/3.png" alt=""></a>
							</div><?php endif; ?>
						<?php if($line['id'] == 341 and $p['index'] == 27): ?><div class="xingcheng-href">
								<a href="http://kllife.com/phone/index.php?s=/phone/line/info/id/337" external><img src="/source/Static/phone/images/content_img/1.png" alt=""></a>
								<a href="http://kllife.com/phone/index.php?s=/phone/line/info/id/273" external><img src="/source/Static/phone/images/content_img/2.png" alt=""></a>
								<a href="http://kllife.com/phone/index.php?s=/phone/line/info/id/341" external><img src="/source/Static/phone/images/content_img/3.png" alt=""></a>
							</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
			<!-- 行程介绍 -->
			<div id="travel-introduction">
				<div class="travel-introduction-header">
					<p></p>
					<h4>行程介绍</h4>
				</div>
				<div class="content-padded">
					<div class="day-introduction">
						<?php if(is_array($line["travels"])): $i = 0; $__LIST__ = $line["travels"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i;?><div class="content-padded">
								<img src="/source/Static/phone/images/line_content/sublist_logo.png" alt="">
								<span>Day<?php echo ($t["day_id"]); ?></span>
								<span><?php echo ($t["title"]); ?></span>
								<?php if($line['id'] == 273 and $t['day_id'] == 10): ?><a style="display: inline-block;margin-top:20px;" href="<?php echo U('line/info');?>/id/341" target="_blank">
										<img style="width:100%;" src="http://img.kllife.com/2017-06-30_5955f72d16b40.gif" alt="">
									</a><?php endif; ?>
								<div class="days-list">
									<i class="iconfont">&#xe60c;</i>
									<div class="days-sublist">
										住宿：<?php echo ($t["hotel"]); ?>
									</div>
								</div>
								<div class="days-list">
									<i class="iconfont">&#xe60a;</i>
									<div class="days-sublist">
										餐饮：<?php echo ($t["eat_way"]); ?>
									</div>
								</div>
								<div class="days-list">
									<i class="iconfont">&#xe60b;</i>
									<div class="days-sublist">
										浏览重点：<?php echo ($t["view_point"]); ?>
										<p><?php echo ($t["intro"]); ?></p>
									</div>
								</div>
								<div class="days-list">
									<i class="iconfont">&#xe60d;</i>
									<div class="days-sublist">
										温馨提示：<?php echo ($t["kindly_reminder"]); ?>
										<div class="days-img">
											<?php if(empty($t['img1']) == false): ?><img src="<?php echo ($t["img1"]); ?>" alt=""><?php endif; ?>
											<?php if(empty($t['img2']) == false): ?><img src="<?php echo ($t["img2"]); ?>" alt=""><?php endif; ?>
											<?php if(empty($t['img3']) == false): ?><img src="<?php echo ($t["img3"]); ?>" alt=""><?php endif; ?>
										</div>
									</div>
								</div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
			</div>
			<!-- end 行程介绍 -->
			<!-- 预订须知 -->
			<div id="reserve-notes">
				<div class="reserve-notes-header">
					<p></p>
					<h4>预定须知</h4>
				</div>
				<div class="content-padded">
					<!-- 费用说明等 -->
					<div class="reserve-notes-list">
						<div class="content-padded">
							<img src="/source/Static/phone/images/order_create/sublist_logo.png" alt="">
							<span>费用说明</span>
							<div class="reserve-notes-sublist">
								<?php echo ($line["cost_description"]); ?>
							</div>
						</div>
						<!-- 预订须知 -->
						<div class="content-padded">
							<img src="/source/Static/phone/images/order_create/sublist_logo.png" alt="">
							<span>预订须知</span>
							<div class="reserve-notes-sublist">
								<?php echo ($line["booking_notes"]); ?>
							</div>
						</div>
						<!-- 沿途风光 -->
						<div class="content-padded">
							<img src="/source/Static/phone/images/order_create/sublist_logo.png" alt="">
							<span>沿途风光</span>
							<div class="reserve-notes-sublist">
								<?php if(is_array($line["scenery"])): $i = 0; $__LIST__ = $line["scenery"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i; if(empty($s[image_url]) == true): ?><span><?php echo ($s["content"]); ?></span>
									<?php else: ?>
									<img src="<?php echo ($s["image_url"]); ?>" /><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
	        <!--相关线路-->
	        <div class="recommend" id="recommend">
	            <div class="recommend-tit"><img src="/source/Static/phone/images/order_create/recommend-tit.png" alt=""></div>
	            <div class="recommend-group">
			    	<?php if(is_array($line["sets"])): $i = 0; $__LIST__ = $line["sets"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i; if(stripos($s['key'], 'recommend_line') !== FALSE): ?><div class="recommend-item">
			                    <div class="img"><img src="<?php echo ($s['value']['img1']); ?>" alt="<?php echo ($s['value']['title']); ?>"></div>
			                    <div class="div">
			                        <p class="lg"><?php echo ($s['value']['title']); ?></p>
			                        <p class="sm"><?php echo ($s['value']['subheading']); ?></p>
		                			<?php if(empty($s['value']['check_price'])): ?><p class="money"><span>核算中</span></p>
					                <?php else: ?>
					                	<?php $price = explode('.',$s['value']['start_price_adult']); ?>
					                	<p class="money">￥<span><?php echo ($price[0]); ?></span>元起</p><?php endif; ?>
			                    </div>
		            			<a href="<?php echo U('line/info');?>/id/<?php echo ($s['value']['id']); ?>" target="_blank" title="<?php echo ($s['value']['title']); ?>：<?php echo ($s['value']['subheading']); ?>"></a>
			                </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
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
<!-- swiper -->
<script src="/source/Static/phone/common/js/swiper-3.3.1.min.js"></script>
<script>
	//批次滚动
	var swiper = new Swiper('.swiper-container', {
            slidesPerView: 4.3,
            paginationClickable: true,
            spaceBetween: 15,
            freeMode: true
        });
        
    $(function(){

        $.init();

    });
    //等元素加载完在启用，防止高度获取不准确
    window.onload = function() {
        //元素滚动到指定位置
        //tabs高度
        var tabsHeight = $('#tabs').height();
        //header高度
        var headerHeight = $('header').height();
        //获取content滚动的距离
        var g = 0;
        //线路特色距离顶部距离
        var q = $('#line-special').offset().top;
        //行程介绍距离顶部距离
        var w = $('#travel-introduction').offset().top;
        //预定须知距离顶部距离
        var z = $('#reserve-notes').offset().top;
        //content距顶部距离
        var contentHeight = parseInt($('.content').css('top'));
        //相差距离
        var calculateHeight = tabsHeight + headerHeight + contentHeight;
        $('.content').on( "scroll", function() {

            g = $('.content').scrollTop();
            //-1:有1px边框误差
            //判断距离，给相应元素添加删除class
            if( g > ( q - calculateHeight - 1 ) && g < ( w - calculateHeight - 1 ) ) {
                $('.a1').siblings().removeClass('active');
                $('.a1').addClass('active');
            }else if ( g >= ( w - calculateHeight - 1 ) && g < ( z - calculateHeight - 1 ) ){
                $('.a2').siblings().removeClass('active');
                $('.a2').addClass('active');
            }else if ( g >= ( z - calculateHeight -3 )){
                $('.a3').siblings().removeClass('active');
                $('.a3').addClass('active');
            }

        });

        //tabs点击时处理事件
        $('#tabs a').click(
            //
            function( event ){
                var $anchor = $(this);
                //定位元素距离顶部距离
                var eleHeight = $('#' + $anchor.attr('title')).offset().top;
                //当tabs是固定定位时
                if($('#tabs').css('position') == 'fixed'){

                    $('.content').stop().animate({scrollTop: g + eleHeight - headerHeight }, 600);

                }else{

                    $('.content').stop().animate({scrollTop: g + eleHeight - calculateHeight }, 600);

                }
                //取消默认操作
                event.preventDefault();
            }
        );
        //切换
        $('#tabs a').click( function (){
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
        } );
        // tab固定
        function changeTab(){

            var elm = $('#tabs');
            //获取tabs距离顶部距离-header
            var startPos = $(elm).offset().top -44 ;
            //绑定滚动事件
            $('.content').on( "scroll", function() {
                //content滚动距离
                var p = $('.content').scrollTop();
                //当tabs距离顶部距离-header <= content滚动距离时
                if( startPos <= p ){
                    //固定tabs
                    $('#tabs').css({'position':'fixed',
                        'top':'0',
                        'left':'0',
                        'width':'100%',
                        'z-index':'999'});
                    //解决ios header盖住content
                    $('header').hide();
                    $('.content').css('top','0');
                }else{
                    //清除固定
                    $('#tabs').css('position','static');
                    //解决ios header盖住content
                    $('header').show();
                    $('.content').css('top','2.2rem');
                }

            });

        }

        changeTab();
    }
    //		$(function(){
    //   			pushHistory();
    //			window.addEventListener("popstate", function(e) {
    //				alert("我监听到了浏览器的返回按钮事件啦");//根据自己的需求实现自己的功能
    //			}, false);
    //		    function pushHistory() {
    //		        var state = {
    //		            title: "title",
    //		            url: "#"
    //		        };
    //		        window.history.pushState(state, "title", "#");
    //		    };
    //
    //		});
    
    // 团期点击事件
    $('.tuanqi .div').click(function(){
    	var batchId = $(this).attr('data-batch-id');
    	if ('<?php echo ($duid); ?>' != '') {
    		location.href = '<?php echo U("line/order");?>'+'/id/<?php echo ($line["id"]); ?>/duid/<?php echo ($duid); ?>/type/create/b/'+batchId;
    	} else {
    		location.href = '<?php echo U("line/order");?>'+'/id/<?php echo ($line["id"]); ?>/type/create/b/'+batchId;
    	}
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