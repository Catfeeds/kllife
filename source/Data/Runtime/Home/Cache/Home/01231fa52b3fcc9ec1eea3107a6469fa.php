<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="领袖户外" name="author"/>
	<!--特殊专题新疆标题关键字-->
	<?php if(C('MENU_CURRENT') == 'subject_xinjiang'): ?><title>新疆旅游的首选_领袖户外旅行网_好玩不贵的小团慢旅行_领袖户外官方网站</title>	
	    <meta content="新疆旅游的首选,领袖户外旅行网,好玩不贵的小团慢旅行,领袖户外官方网站" name="title"/>
	    <meta content="新疆旅游,新疆旅游攻略,新疆旅游费用,新疆旅游价格,新疆旅游景点大全,新疆驴友网,禾木驴友网,新疆驴友攻略,喀纳斯驴友网,新疆定制游" name="keywords"/>
	    <meta content="新疆旅游攻略，小团慢旅行,新疆自助游攻略，包括小团慢旅行,新疆热门景点、户外俱乐部、游记攻略、出行交通、餐饮等旅游信息，以及小团慢旅行,新疆驴友交流、驴友俱乐部信息。小团慢旅行,新疆旅游怎么订制。" name="description"/>
	<!--特殊专题额济纳标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_ejina'): ?>
		<title>额济纳旅游的首选__领袖户外旅行网__好玩不贵的小团慢旅行</title>
		<meta content="额济纳旅游的首选,领袖户外旅行网,好玩不贵的小团慢旅行" name="title"/>
	    <meta content="额济纳旅游,额济纳旅游攻略,额济纳旅游费用,额济纳旅游价格,额济纳胡杨林,额济纳旅游景点大全" name="keywords"/>
	    <meta content="额济纳旗，掉落在童话里的秋日，颠覆传统旅行方式，化腐朽为神奇的国庆精品线路。领袖户外：好玩不贵的小团慢旅行！,精品小团，享受一次恰到好处的慢旅行！在最美的风景中漫步、深呼吸，为不期而遇的惊艳停车，品味夕阳晨曦的美好，尽可能与美景相拥而眠，旅途中从陌生，变成朋友……" name="description"/>		
	<!--特殊专题丝绸之路标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_silk'): ?>
	    <meta content="青海湖旅游攻略,青海湖旅游价格,敦煌旅游景点,敦煌旅游价格,青海驴友线路,青海驴友攻略,茶卡盐湖门票多钱,茶卡盐湖什么时候去好玩" name="keywords"/>
	    <meta content="300度环青海湖旅行，长达三天湖边游玩时间，避开顶光去茶卡，这是丝绸之路线路中最好的体验。丝绸之路旅游去哪儿玩？领袖户外为您独家定制专属线路,从青海湖到敦煌莫高窟,从嘉峪关到祁连山....更多的西北旅游信息就来领袖户外旅行网。" name="description"/>
		<title>丝绸之路旅游线路推荐-青海驴友俱乐部-甘肃驴友俱乐部-领袖户外旅行网-好玩不贵的小团慢旅行-茶卡盐湖驴友俱乐部</title>	
	<!--通用标题关键字-->
	<?php elseif(empty($PageKeyword) == false): ?>
		<meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
		<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
		<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
		<title><?php echo ($PageKeyword["title"]); ?></title>
	<?php else: ?>
		<title><?php echo C('PAGE_TITLE');?>-领袖户外</title><?php endif; ?>
	<!-- css Reset -->
	<link rel="stylesheet" href="/source/Static/home/common/css/cssreset.css">
	<!-- 轮播样式 -->
	<link rel="stylesheet" href="/source/Static/home/common/css/slide.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="/source/Static/home/common/css/common.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="/source/Static/common/css/common.css">
	<!--图标-->
	<link type="image/x-icon" rel="shortcut icon" href="/source/Static/home/common/images/favicon.ico" />
	<!-- 引用jq -->
	<script src="/source/Static/home/common/js/jquery-1.11.3.min.js"></script>
	
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="/source/Static/common/js/functions.js"></script>

	<!--[if lt IE 9]>
		<script>
			(function() {
				if (! 
					/*@cc_on!@*/
				0) return;
				var e = "abbr, article, aside, audio, canvas, datalist, details, dialog, eventsource, figure, footer, header, hgroup, mark, menu, meter, nav, output, progress, section, time, video".split(', ');
				var i= e.length;
				while (i--){
					document.createElement(e[i])
				} 
			})() ;
		</script>
    	<script src="../common/js/html5shiv.min.js"></script>
    <![endif]-->
	
</head>
<body>
	<div class="mp_video hidden_ctrl">
	</div>
	<header>
		<div class="nav01">
			<div class="nav-top">
				<div class="nav-top-left">
					<?php if(is_array($stations)): $i = 0; $__LIST__ = $stations;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i; if($s['forbidden'] === '0'): if($station['id'] == $s['id']): ?><a href="<?php echo U('index/welcome');?>/station/<?php echo ($s["key"]); ?>" style="color: #ff8000"> <?php echo ($s["name"]); ?> </a> |
							<?php else: ?>
								<a href="<?php echo U('index/welcome');?>/station/<?php echo ($s["key"]); ?>"> <?php echo ($s["name"]); ?> </a> |<?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
				</div>
				<div class="nav-top-right">
					<img src="/source/Static/home/common/images/login_header.png" alt=""></a>
					<?php if(empty($user) == true): ?><a href="<?php echo U('user/login');?>">登录</a> |
						<a href="<?php echo U('user/register');?>">注册</a>
					<?php else: ?>
						你好<a href="<?php echo U('user/info');?>" style="color: blue;"><?php echo ($user["show_name"]); ?></a>欢迎光临，
						<a href="javascript:;" style="color: blue;" class="user_logout">安全退出</a>！<?php endif; ?>
					<a href="<?php echo U('line/order');?>/type/center" target="_blank"> | 我的订单</a>
					<a href="<?php echo U('Subject/brand');?>" target="_blank"> | 关于我们</a>
					<a href="<?php echo U('service/center');?>" target="_blank"> | 服务中心</a>
					<img src="/source/Static/home/common/images/tel_header.png" alt="联系电话">
					<span>400-080-5860<!--<?php echo ($cs_tel); ?>--></span>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$('.user_logout').click(function(){
				logoutShequ('<?php echo U("user/exit");?>');	
			});
		</script>
		<div class="nav02">
			<div class="nav-list">
				<a class="go-welcome" href="<?php echo U('index/welcome');?>"><img src="/source/Static/home/common/images/logo1.png" alt="领袖户外"></a>
				<!--logo图片加链接会导致样式混乱-->
				<!--<img src="/source/Static/home/common/brand/logo_header.png" alt="领袖户外">-->
				<ul>
					<?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; if (is_array($menu) === false) { continue; } $jumpToLineList = false; switch($menu['item_desc']) { case '首页': $href=U('index/welcome'); break; case '跟拍游': $href=U('line/xiezhenlvxing'); break; case '私人定制': { $href=$pcset['team_link']; $target = '_blank'; }break; case '论坛': { $href = "http://shequ.kllife.com"; $target = '_blank'; }break; default: { $jumpToLineList = true; $href=U('line/list','cache=1'); } break; } ?>
						<li class="nav-list-top">
							<?php $nav = $href; if ($jumpToLineList === true) { $nav = $href.'/m0/'.$menu['id']; } ?>
							<a href="<?php echo ($nav); ?>" target="<?php echo ($target); ?>"><?php echo ($menu["item_desc"]); ?></a>
							<?php if(!empty($menu["child"])): ?><div>
								<?php if(is_array($menu["child"])): $i = 0; $__LIST__ = $menu["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><ul>
									<li>
										<?php $nav = $href; if (!empty($jumpToLineList)) { $nav = $href.'/m0/'.$menu['id'].'/m1/'.$c['id']; } ?>
										<a href="<?php echo ($nav); ?>" target="<?php echo ($target); ?>"><?php echo ($c["item_desc"]); ?></a>
									</li>
									<?php if(!empty($c["child"])): if(is_array($c["child"])): $i = 0; $__LIST__ = $c["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cc): $mod = ($i % 2 );++$i;?><li>
												<?php $nav = $href; if (!empty($jumpToLineList)) { $nav = $href.'/m0/'.$menu['id'].'/m1/'.$c['id'].'/m2/'.$cc['id']; } ?>
												<a href="<?php echo ($nav); ?>"  target="<?php echo ($target); ?>"><?php echo ($cc["item_desc"]); ?></a>
											</li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
								</ul><?php endforeach; endif; else: echo "" ;endif; ?>
							</div><?php endif; ?>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<div class="search-header" style="margin-right: 17px;">
					<img src="/source/Static/home/common/images/search_header.png" alt="">
					<input type="text" value="<?php echo ($searchval); ?>" placeholder="身未动 心已远..."/>
					<a href="javascript:;">搜索</a>
				</div>
				<script type="text/javascript">
					$(document).ready(function(){
						// 定位首页菜单
						positionTopMenu();
					});
					
					// 首页菜单动态定位
					function positionTopMenu(){
						var rootObj = $('.nav02').find('.nav-list');
						var firstMenuLeft = $(rootObj).find('.nav-list-top:first').offset().left;
						var startLeft = $(rootObj).offset().left;
						var leftOffset = parseInt(firstMenuLeft)-parseInt(startLeft);
						
						$(rootObj).find('.nav-list-top').each(function(i,el){
							if ($(this).find('div').length > 0) {						
								var childLength = $(this).find('div').find('ul').length;
								var ulObj = $(this).find('div').find('ul:first');
								var childWidth = parseInt($(ulObj).css('margin-left')) + parseInt($(ulObj).width());
								var totalWidth = parseInt(childWidth) * parseInt(childLength) + 30;
								$(this).find('div').css('width', totalWidth);
								
								var menuOffset = parseInt($(rootObj).width())-parseInt(totalWidth);
								if (menuOffset > leftOffset) {
									menuOffset = leftOffset;
								}
								$(this).find('div').css('left',menuOffset);								
							}
						});
						
					}
					
					function topSearchLine() {
						var search_val = $('.search-header').find('input').val();
						$.post('<?php echo U("line/search");?>', {searchval:search_val}, function(data){
							if (data.jumpUrl != null) {
								location.href = data.jumpUrl;
							}
						});
					}
					// 绑定回车时间
					bindKeyUp($('.search-header').find('input'),topSearchLine);
					$('.search-header').find('a').click(function(){
						topSearchLine();
					});					
				</script>
			</div>
		</div>		
	</header>	
<!-- 私有样式 -->
<link rel="stylesheet" href="/source/Static/home/css/index.css">
<link rel="stylesheet" href="/source/Static/home/css/subject.css">
<link rel="stylesheet" href="/source/Static/home/css/ejina.css">
<style css="text/css">	
	.hot-sale-product a .hot-sale-img { position: absolute; top: 85px; left: 0; width: 100%; height: 31px; text-align: center; font-size: 24px; text-decoration: none; text-shadow: 1px 1px 1px #000; }
	.hot-sale-product .hot-sale-big .hot-sale-img { width: 287px; top: 200px; left: 136px; }
	.main-two > ul{position:initial;width:100%;display: block}
	.main-two > ul li a{font-size:26px;padding-bottom:0px;}
	.clear-margin{margin:0 !important;}
	.clear-margin{margin-top:20px !important;}
	#content .zt-main>div{font-size: 16px;color:#666;line-height:25px;}
</style>
<!--主要内容-->
<div class="zt-top">
	<img src="http://img.kllife.com/2017-06-13_593fbe2d3853a.jpg" original="http://img.kllife.com/2017-06-13_593fbe2d3853a.jpg">
</div>
<!--订单滚动-->
<style>
	.user-tel{width:1200px;margin:auto;padding:20px 0px;text-align: right;overflow: hidden}
.user-tel .user-tel-img{
    float: left;
    width:100px;
    padding-right:20px;
}
.user-tel .user-tel-img img{width:100%;}
#demo {
    background: #FFF;
    overflow:hidden;
    width: 1070px;
    float: left;
    margin-top:7px;
    font-size: 14px;
}
#indemo {
    float: left;
    width: 1500%;
}
#indemo a{color:#333;margin:0px 1px;}
#indemo a span{display:inline-block;color:#2c6eb7;}
#indemo a .span{color:orange;}
#demo1 {
    float: left;
}
#demo2 {
    float: left;
}
</style>

<!--报名状态显示-->
<div class="user-tel">
	<div class="user-tel-img"><img src="/source/Static/home/images/index_img/sign_up.png" alt=""></div>
	<div id="demo">
		<div id="indemo">
			<div id="demo1">
				<?php if(is_array($top_signup_orders)): $i = 0; $__LIST__ = $top_signup_orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><a href="<?php echo U('line/info');?>/id/<?php echo ($order["lineid"]); ?>" target="_blank">用户 <span class="span"><?php echo ($order["mob_show"]); ?></span> 预订 <span><?php echo ($order["lineid_title"]); ?> |</span></a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<div id="demo2"></div>
		</div>
	</div>
</div>
<script>
	//预订用户滚动显示
    var speed=20;
    var tab=document.getElementById("demo");
    var tab1=document.getElementById("demo1");
    var tab2=document.getElementById("demo2");
    tab2.innerHTML=tab1.innerHTML;
    function Marquee(){
        if(tab2.offsetWidth-tab.scrollLeft<=0)
            tab.scrollLeft-=tab1.offsetWidth
        else{
            tab.scrollLeft++;
        }
    }
    var MyMar=setInterval(Marquee,speed);
    tab.onmouseover=function() {clearInterval(MyMar)};
    tab.onmouseout=function() {MyMar=setInterval(Marquee,speed)};

</script>
<div style="width:100%;text-align: center;background:#3474bb;"><a href="http://kllife.com/home/index.php?s=/home/subject/brand" target="_blank"><img src="/source/Static/home/images/index_img/index-code.jpg" alt=""></div></a>
<div id="content">
		<div class="zt-list main main-two">
			<div>
				<ul class="tab-list-tit">
					<li><a href="javascript:;">游玩种类</a></li>
					<li><a href="javascript:;">集合地</a></li>
					<li><a href="javascript:;">乘车方式</a></li>
					<li><a href="javascript:;">目的地</a></li>
					<li><a href="javascript:;">价格</a></li>
					<li><a href="javascript:;">天数</a></li>
				</ul>
			</div>
			<div class="tab-list-group">
				<ul class="tab-list-item line_theme">
					<li><a href="javascript:;">全部</a></li>
					<li data-val="line_theme_xtmlx"><a href="javascript:;">小团慢旅行</a></li>
					<li data-val="line_theme_sheying"><a href="javascript:;">摄影游</a></li>
					<li data-val="line_theme_qlp"><a href="javascript:;">跟拍游</a></li>
				</ul>
				<ul class="tab-list-item line_assembly">
					<li><a href="javascript:;">全部</a></li>
					<li data-val="line_assembly_point_xian"><a href="javascript:;">西安</a></li>
					<li data-val="line_assembly_point_xining"><a href="javascript:;">西宁</a></li>
					<li data-val="line_assembly_point_lanzhou"><a href="javascript:;">兰州</a></li>
					<li data-val="line_assembly_point_jiayuguan"><a href="javascript:;">嘉峪关</a></li>
				</ul>
				<ul class="tab-list-item line_traffic">
					<li><a href="javascript:;">全部</a></li>
					<li data-val="line_trip_traffic_automobile"><a href="javascript:;">汽车</a></li>
					<li data-val="line_trip_traffic_motorcar"><a href="javascript:;">动车+汽车</a></li>
				</ul>
				<ul class="tab-list-item line_view_point" >
					<li><a href="javascript:;">额济纳</a></li>
					<li data-val="鸣沙山|莫高窟"><a href="javascript:;">额济纳+敦煌</a></li>
					<li data-val="青海湖|茶卡"><a href="javascript:;">额济纳+青海湖+茶卡</a></li>
				</ul>
				<ul class="tab-list-item line_price">
					<li><a href="javascript:;">全部</a></li>
					<li data-min-val="2000" data-max-val="3000"><a href="javascript:;">2000-3000</a></li>
					<li data-min-val="3000" data-max-val="4000"><a href="javascript:;">3000-4000</a></li>
					<li data-min-val="4001"><a href="javascript:;">4000以上</a></li>
				</ul>
				<ul class="tab-list-item line_travel_day">
					<li><a href="javascript:;">全部</a></li>
					<li data-min-val="5" data-max-val="7"><a href="javascript:;">5—7天</a></li>
					<li data-min-val="8" data-max-val="9"><a href="javascript:;">8-9天</a></li>
					<li data-min-val="10"><a href="javascript:;">10天及以上</a></li>
				</ul>
			</div>
		
			<div class="zt-sublist-content line_template hidden_ctrl">
				<a class="zt-href" href="" target="_blank"></a>
				<div class="zt-sublist-img">
					<img class="face_image" src=""/>
					<div class="jiriyou">
						<p><span class="day"><?php echo ($line["travel_day"]); ?></span>日游</p>
					</div>
					<div class="indulgence">
						<img src="/source/Static/home/images/index_img/indulgence.png" alt="">
					</div>
				</div>
				<div class="zt-sublist-describe">
					<h5>
						<a href="javascript:;" target="_blank" class="title"></a>
						<u class="theme-travel">
							<a href="javascript:;"></a>
						</u>
					</h5>
					<h3></h3>
					<p class="zt-sublist-line">线路简介：<span class="send_word"></span></p>
					<p>价格：<strong>成人：￥<em class="adult_price"></em>元起</strong></p>
					<p>活动时间：<span class="batch_list"></span></p>
					<p>集合地点：<span class="assembly"></span></p>
					<p>目的地：<span class="dest"></span></p>
				</div>
				<a class="baoming" href="javascript:;">立即报名</a>
			</div>
	
			<div class="zt-sublist">
				<?php if(is_array($dest_line_ejina)): $i = 0; $__LIST__ = $dest_line_ejina;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$line): $mod = ($i % 2 );++$i;?><div class="zt-sublist-content" data-id="<?php echo ($line["id"]); ?>">											
							<a class="zt-href" href="<?php echo U('line/info');?>/id/<?php echo ($line["id"]); ?>" target="_blank"></a>
							<div class="zt-sublist-img">
								<img class="face_image" src="<?php echo ($line["img1"]); ?>"/>
								<div class="jiriyou">
									<p><span class="day"><?php echo ($line["travel_day"]); ?></span>日游</p>
								</div>
								<?php if(empty($line['time_preference']) == false): ?><div class="indulgence">
										<img src="/source/Static/home/images/index_img/indulgence.png" alt="">
									</div><?php endif; ?>
							</div>
							<div class="zt-sublist-describe">
								<h5>
									<a href="<?php echo U('line/info');?>/id/<?php echo ($line["id"]); ?>" target="_blank" class="title"><?php echo ($line["title"]); ?></a>
									<?php $theme = $line['theme_type_list'][0]; ?>
									<u class="theme-travel">
										<a class="<?php echo ($theme["type_key"]); ?>" href="javascript:;"><?php echo ($theme["type_desc"]); ?></a>
										<div class="qj-box">
	
											<img src="/source/Static/home/images/content_img/yellow_arrow_top.png" alt="">
	
											<div class="qj-box-content">
	
												<h6><?php echo ($theme["type_desc"]); ?></h6>
	
												<?php if($theme['type_desc'] == '小团慢旅行'): ?><p>小团慢旅行是指在单团人数控制在28人以内，让旅行整体节奏和行进速度慢下来的同时，还要在美景中漫步呼吸，品味悠然新心情，为不期而遇的风景停车，与当地人充分互动，尽量与美景相拥而眠的高品质旅行。</p>
	
												<?php elseif($theme['type_desc'] == '免费活动'): ?>
	
												<p>领袖户外旅行网提供的免费游玩活动，包括郊游、徒步、桌游等项目。</p>
	
												<?php elseif($theme['type_desc'] == '周边游'): ?>
	
												<p>领袖户外或领袖户外严选本地有旅行社资质的户外旅游合作商提供的周边游产品。</p>
	
												<?php elseif($theme['type_desc'] == '摄影游'): ?>
	
												<p>领袖户外摄影创作团，为摄影爱好者提供全面、深度、准确的摄影创作服务。</p>
	
												<?php elseif($theme['type_desc'] == '民族行'): ?>
	
												<p>户外旅游综合平台，由具有完整资质的户外旅游机构提供服务的旅行服务。</p>
	
												<?php else: ?>
	
												<p>本产品由领袖户外提供相关服务</p><?php endif; ?>
	
											</div>
	
										</div>
									</u>
								</h5>
								<h3><?php echo ($line["subheading"]); ?></h3>
								<p class="zt-sublist-line">线路简介：<span class="send_word"><?php echo ($line["send_word"]); ?></span></p>							
								<p>价格：
									<?php if(empty($line['check_price'])): ?><strong>核算中</strong>
									<?php else: ?>
										<strong>成人：￥<em class="adult_price"><?php echo ($line["start_price_adult"]); ?></em>元起</strong><?php endif; ?>
								</p>
								<p>活动时间：<span class="batch_list"><?php echo ($line["start_time"]); ?> 至 <?php echo ($line["end_time"]); ?></span></p>
								<p>集合地点：<span class="assembly"><?php echo ($line["assembly_point_show_text"]); ?></span></p>
								<p>目的地：<span class="dest"><?php echo ($line["destination_show_text"]); ?></span></p>
							</div>
							<a class="baoming" href="<?php echo U('line/info');?>/id/<?php echo ($line["id"]); ?>">立即报名</a>
	
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<!--图片链接-->
		<div class="ejina-img">
			<div class="ejina-group">
				<div class="ejina-item"></div>
				<a href="http://kllife.com/home/index.php?s=/home/line/info/id/207" target="_blank"><div class="ejina-item ejina-item-hover"></div></a>
				<a href="http://kllife.com/home/index.php?s=/home/line/info/id/209" target="_blank"><div class="ejina-item ejina-item-hover"></div></a>
				<div class="ejina-item"></div>
				<a href="http://kllife.com/home/index.php?s=/home/line/info/id/356" target="_blank"><div class="ejina-item ejina-item-hover"></div></a>
				<a href="http://kllife.com/home/index.php?s=/home/line/info/id/353" target="_blank"><div class="ejina-item ejina-item-hover"></div></a>
				<a href="http://kllife.com/home/index.php?s=/home/line/info/id/346" target="_blank"><div class="ejina-item ejina-item-hover"></div></a>
				<a href="http://kllife.com/home/index.php?s=/home/line/info/id/348" target="_blank"><div class="ejina-item ejina-item-hover"></div></a>
				<a href="http://kllife.com/home/index.php?s=/home/line/info/id/347" target="_blank"><div class="ejina-item ejina-item-hover"></div></a>
				<a href="http://kllife.com/home/index.php?s=/home/line/info/id/338" target="_blank"><div class="ejina-item ejina-item-hover"></div></a>
				<a href="http://kllife.com/home/index.php?s=/home/line/info/id/349" target="_blank"><div class="ejina-item ejina-item-hover"></div></a>
				<a href="http://kllife.com/home/index.php?s=/home/line/info/id/214" target="_blank"><div class="ejina-item ejina-item-hover"></div></a>
			</div>
		</div>
	<!--精彩游记-->
	<div class="wonderful-travels">
		<h3>精彩游记</h3>
		<ul>
			<?php if(is_array($subject_youji_ejina)): $i = 0; $__LIST__ = $subject_youji_ejina;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$youji): $mod = ($i % 2 );++$i;?><li>
				<a href="<?php echo ($youji["url"]); ?>" target="_blank">
					<img src="<?php echo ($youji["img"]); ?>"/>
					<div style="background: #f4f4f4;">
						<p style="padding-right:10px;"><?php echo ($youji["desc"]); ?></p>
					</div>
				</a>		
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>
</div>
<!--小团慢每刻美切换-->
    <div class="xiaotuanman">
        <div class="xiaotuanman2">
            <div class="kllife"><a href="javascript:;"><img src="/source/Static/home/images/xinjiang/kllife.png" alt=""></a></div>
            <div class="meikemei"><a href="javascript:;"><img src="/source/Static/home/images/xinjiang/meikemei1.png" alt=""></a></div>
        </div>
        <div class="box box-one">
            <!--第一行-->
            <div class="lineS" style="top:-166px;">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina1.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/01.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina2.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/02.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina3.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/03.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina4.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/04.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina5.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/05.PNG">
                        </div>
                    </div>
                </div>
            </div>
            <!--第2行-->
            <div class="lineF" style="padding-left:222px">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina6.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/06.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina7.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/07.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina8.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/08.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina9.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/09.PNG">
                        </div>
                    </div>
                </div>
            </div>
            <!--第3行-->
            <div class="lineS">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina10.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/10.JPG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina11.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/11.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina12.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/12.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina13.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/13.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF">
                    <div class="boxS">
                        <a href="<?php echo U('index/welcome');?>" target="_blank"><div class="boxT" style="background: url(/source/Static/home/images/xinjiang/kllife-add.png);"></div></a>
                    </div>
                </div>
            </div>
            <div class="lg-left"></div>
            <div class="lg-right"></div>
        </div>
        <div class="box box-two">
            <!--第一行-->
            <div class="lineS" style="top:-166px;">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina14.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/14.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina15.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/15.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina16.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/16.JPG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina17.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/17.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina18.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/18.PNG">
                        </div>
                    </div>
                </div>
            </div>
            <!--第2行-->
            <div class="lineF" style="padding-left:222px;">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina19.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/19.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina20.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/20.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina21.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/21.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina22.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/22.PNG">
                        </div>
                    </div>
                </div>
            </div>
            <!--第3行-->
            <div class="lineS">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina23.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/23.JPG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina24.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/24.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina25.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/25.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/ejina/ejina26.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/26.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF">
                    <div class="boxS">
                        <a href="http://xiezhenlvxing.com" target="_blank"><div class="boxT" style="background: url(/source/Static/home/images/xinjiang/meikemei-add.png);"></div></a>
                    </div>
                </div>
            </div>
            <div class="lg-left" style="background-color: #fff;background-repeat: no-repeat;background-position: center center;background-size:auto 100%;"></div>
            <div class="lg-right" style="background-color: #fff;background-repeat: no-repeat;background-position: center center;background-size:auto 100%;"></div>
        </div>
    </div>
<!--私人定制-->

	<div class="private-custom">
		<h2>上述产品不符合您的需求？</h2>
		<p>欢迎填写下表提交，即刻联系领袖户外的私人旅行顾问</p>
		<p>我们将为您和您的亲友量身定制专属行程</p>
		<a href="<?php echo ($pcset["team_link"]); ?>" target="_blank">私人定制</a>
	</div>

<!-- 精选热卖 -->
	<div class="bg-white">
		<div class="hot-sale main">
			<h2>精选热卖</h2>
			<div class="hot-sale-product set_root" id="hot_line_recommend" data-set="hot_line_recommend">
				<div class="hot-sale-product-small">
					<?php $rd0 = $subject_hot_line_ejina['hot_line_recommend0'] ?>
					<a href="<?php echo U('line/info');?>/id/<?php echo ($rd0["id"]); ?>">
						<img src="<?php echo ($rd0["img1"]); ?>" alt="">
						<u class="hot-sale-img"><?php echo ($rd0["title"]); ?></u>
						<div class="aaa">
							<h4><?php echo ($rd0["title"]); ?></h4>
							<span><?php echo ($rd0["subheading"]); ?></span>
							<?php if(empty($rd0['check_price'])): ?><p><em>核算中</em></p>
							<?php else: ?>
								<p>￥<em><?php echo ($rd0["start_price_adult"]); ?></em>元起</p><?php endif; ?>						
							<strong>查看详情></strong>
						</div>
					</a>
					<?php $rd1 = $subject_hot_line_ejina['hot_line_recommend1'] ?>
					<a href="<?php echo U('line/info');?>/id/<?php echo ($rd1["id"]); ?>">
						<img src="<?php echo ($rd1["img1"]); ?>" alt="">
						<u class="hot-sale-img"><?php echo ($rd1["title"]); ?></u>
						<div class="aaa">
							<h4><?php echo ($rd1["title"]); ?></h4>
							<span><?php echo ($rd1["subheading"]); ?></span>
							<?php if(empty($rd1['check_price'])): ?><p><em>核算中</em></p>
							<?php else: ?>
								<p>￥<em><?php echo ($rd1["start_price_adult"]); ?></em>元起</p><?php endif; ?>						
							<strong>查看详情></strong>
						</div>
					</a>
				</div>
				<?php $rd2 = $subject_hot_line_ejina['hot_line_recommend2'] ?>
				<a class="hot-sale-big" href="<?php echo U('line/info');?>/id/<?php echo ($rd2["id"]); ?>">
					<img src="<?php echo ($rd2["img1"]); ?>" alt="">
					<u class="hot-sale-img"><?php echo ($rd2["title"]); ?></u>
					<div>
						<h4><?php echo ($rd2["title"]); ?></h4>
						<span><?php echo ($rd2["subheading"]); ?></span>
						<?php if(empty($rd2['check_price'])): ?><p><em>核算中</em></p>
						<?php else: ?>
							<p>￥<em><?php echo ($rd2["start_price_adult"]); ?></em>元起</p><?php endif; ?>						
						<strong>查看详情></strong>
					</div>
				</a>
				<div class="hot-sale-product-small">
					<?php $rd3 = $subject_hot_line_ejina['hot_line_recommend3'] ?>
					<a href="<?php echo U('line/info');?>/id/<?php echo ($rd3["id"]); ?>">
						<img src="<?php echo ($rd3["img1"]); ?>" alt="">
						<u class="hot-sale-img"><?php echo ($rd3["title"]); ?></u>
						<div class="aaa">
							<h4><?php echo ($rd3["title"]); ?></h4>
							<span><?php echo ($rd3["subheading"]); ?></span>
							<?php if(empty($rd3['check_price'])): ?><p><em>核算中</em></p>
							<?php else: ?>
								<p>￥<em><?php echo ($rd3["start_price_adult"]); ?></em>元起</p><?php endif; ?>						
							<strong>查看详情></strong>
						</div>
					</a>
					<?php $rd4 = $subject_hot_line_ejina['hot_line_recommend4'] ?>
					<a href="<?php echo U('line/info');?>/id/<?php echo ($rd4["id"]); ?>">
						<img src="<?php echo ($rd4["img1"]); ?>" alt="">
						<u class="hot-sale-img"><?php echo ($rd4["title"]); ?></u>
						<div class="aaa">
							<h4><?php echo ($rd4["title"]); ?></h4>
							<span><?php echo ($rd4["subheading"]); ?></span>
							<?php if(empty($rd4['check_price'])): ?><p><em>核算中</em></p>
							<?php else: ?>
								<p>￥<em><?php echo ($rd4["start_price_adult"]); ?></em>元起</p><?php endif; ?>						
							<strong>查看详情></strong>
						</div>
					</a>
				</div>
			</div>

		</div>
	</div>
<!-- 超级目的地 -->


	<div class="bg-gray">

		<div class="special main">

			<h2>超级目的地</h2>

			<div class="special-exhibition">

				<ul>
					<?php $idx = '0'; ?>
					
					<?php $__FOR_START_1487777355__=0;$__FOR_END_1487777355__=12;for($k=$__FOR_START_1487777355__;$k < $__FOR_END_1487777355__;$k+=1){ $zt = $set_subjects['zhuanti'.$k]; if (empty($zt['url'])) { continue; } ?>
						
						<?php if($idx % 4 == 0): ?><li><?php endif; ?>

						<a class="special-exhibition-product" href="<?php echo ($zt["url"]); ?>" target="_blank">

							<img class="special-bg" src="<?php echo ($zt["img_main"]); ?>" alt="">

							<img class="special-img" src="<?php echo ($zt["img_banner"]); ?>" alt="">

							<div class="special-exhibition-describe">

								<h4><?php echo ($zt["title"]); ?></h4>

								<h4><?php echo ($zt["subheading"]); ?></h4>

								<p><?php echo ($zt["desc"]); ?></p>

							</div>

						</a>
						
						<?php if($idx % 4 == 3): ?></li><?php endif; ?>						
						
						<?php $idx ++; } ?>
					
				</ul>

			</div>

		</div>

	</div>
	<!-- 顶部轮播 -->
<script src="/source/Static/home/common/js/showAndHide.js"></script>
<script src="/source/Static/home/js/unslider.min.js"></script>

<script type="text/javascript">
	//精彩专题
	$('.special-exhibition').unslider({ 
		dots: true
	});

	$('.special-exhibition-product').fadeInAndOut('special-img', 'div');
</script>


<!--专题新闻资讯开始-->
<div class="arcitle_con" style="display: none;">
	<h2>新闻资讯</h2>
	<p><a href="<?php echo U('line/news');?>/classid/<?php echo ($subject["id"]); ?>" target="_blank">更多</a></p>
	<ul class="arcitle_li">
		<?php if(is_array($seoarticles)): $i = 0; $__LIST__ = $seoarticles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><li>
				<p class="arc_title"><a href="<?php echo U('line/news');?>/id/<?php echo ($article["id"]); ?>"></a><?php echo ($article["title"]); ?></p>
				<p class="arc_keyword"><?php echo ($article["keywords"]); ?></p>
				<p class="arc_description"><?php echo ($article["send_word"]); ?></p>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
</div>
<!--专题新闻资讯结束-->

<!--额济纳弹框-->
<div class="Popup" style="background: rgba(0,0,0,0.5);width:100%;height:100%;position: fixed;top:0px;left:0px;z-index:1000;">
	<div style="text-align: center;text-align: -webkit-center;margin-top:12%;">
        <span style="position: relative;display: inline-block;cursor: pointer;">
            <img src="/source/Static/home/images/subject/ejina.jpg" alt="">
            <img style="position: absolute;top:10px;right:10px;" src="/source/Static/home/images/index_img/xiaotuanmannone.png" alt="">
        </span>
	</div>
</div>

<!-- 更改tab-bg -->
<script src="/source/Static/home/common/js/movebg.js"></script>
<!-- tab -->
<script src="/source/Static/home/common/js/tab.js"></script>
<!--图片延迟加载-->
<script type="text/javascript" src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>
<script type="text/javascript">
    jQuery(document).ready(
        function($){
            $("img").lazyload({
                placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
                effect      : "fadeIn",
                threshold : 100,
                failure_limit : 10
            });
     });
        
    //关闭额济纳弹框
    $(".Popup , .GPopup").on("click",function(){
        $(this).fadeOut("slow");
    })
    
    
    
    //tab切换
    $(".tab-list-tit li").on("mouseover",function(){
    	var index = $(this).index();
    	$(this).addClass("active").siblings().removeClass("active");
    	$(".tab-list-group").find(".tab-list-item").eq(index).show().siblings(".tab-list-item").hide();
    })


	$('.zt-main ul li').mouseenter( function () {

    	$(this).find('.zt-text').stop().animate({top: 0}, 500);

    	$(this).find('.zt-img').stop().fadeOut(1000);

  	} );

  	$('.zt-main ul li').mouseleave( function () {

    	$(this).find('.zt-text').stop().animate({top: "-369px"}, 1000);

    	$(this).find('.zt-img').stop().fadeIn(1500);

  	} );
    
    // 查找线路
    function findLine() {
        var jsonData = {
        	op: 'ejina',
            assembly: $('.line_assembly').find('.active').attr('data-val'),
            traffic: $('.line_traffic').find('.active').attr('data-val'),
            theme: $('.line_theme').find('.active').attr('data-val'),
            view: $('.line_view_point').find('.active').attr('data-val'),
            min_price: $('.line_price').find('.active').attr('data-min-val'),
            min_day: $('.line_travel_day').find('.active').attr('data-min-val'),
        }

        var max_price = $('.line_price').find('.active').attr('data-max-val');
        if (max_price != null && max_price != 'undefined' && max_price != '') {
            jsonData['max_price'] = max_price;
        }

        var max_day = $('.line_travel_day').find('.active').attr('data-max-val');
        if (max_day != null && max_day != 'undefined' && max_day != '') {
            jsonData['max_day'] = max_day;
        }
        
        $.post('<?php echo U("subject/ejina");?>', jsonData, function(data){
			$('.zt-sublist').empty();
			if (data.ds != null) {
				for (var i = 0; i < data.ds.length; i ++) {
					var d = data.ds[i];
					var lineObj = $('.line_template').clone(true);
					$(lineObj).removeClass('line_template');
					$(lineObj).removeClass('hidden_ctrl');
					$(lineObj).attr('data-id', d.id);
					$(lineObj).find('.face_image').attr('src', d.img1);
					$(lineObj).find('.title').attr('href', '<?php echo U("line/info");?>/id/'+d.id);
					$(lineObj).find('.zt-href').attr('href', '<?php echo U("line/info");?>/id/'+d.id);
					$(lineObj).find('.title').html(d.title);
					$(lineObj).find('.day').html(d.travel_day);
					$(lineObj).find('h3').html(d.subheading);
					$(lineObj).find('.theme-travel a').html(d.theme_type_show_text);
					$(lineObj).find('.theme-travel a').addClass(d.theme_type_list[0].type_key);
					$(lineObj).find('.send_word').html(d.send_word_show);
					$(lineObj).find('.baoming').attr('href', '<?php echo U("line/info");?>/id/'+d.id);
					if (d.check_price == 0) {
						$(lineObj).find('.adult_price').parent().html('核算中');		
					} else {	
						$(lineObj).find('.adult_price').html(d.start_price_adult);
					}
					$(lineObj).find('.batch_list').html(d.start_time + ' 至 ' + d.end_time);				
					$(lineObj).find('.assembly').html(d.assembly_point_show_text);
					$(lineObj).find('.dest').html(d.destination_show_text);
					
					if (d.time_preference == 0) {
						$(lineObj).find('.indulgence').remove();
					}
					
					$('.zt-sublist').append(lineObj);
					
					$('.theme-travel a').each(function(){
						if($(this).html()=='民族行'){
							$(this).addClass('zhuti');
						}else if($(this).html()=='摄影游'){
							$(this).addClass('sheying');
						}
					});
				}
			} 
        });
    }
    //点击切换线路
    $(".tab-list-group .tab-list-item li").on("click",function(){
    	$(this).addClass("active").siblings().removeClass("active");
    	$(this).parent().siblings().find("li").removeClass("active");
    	findLine();
    })
    // 产品主题类型浮动框
    $("body").on("mouseover",".theme-travel",function () {
        $(this).find('.qj-box').show();
    });
    $("body").on("mouseout",".theme-travel",function () {
        $(this).find('.qj-box').hide();
    }); 
</script>

<script>
	//kliiife和meikemei图片切换
    $(".xiaotuanman2 .kllife").on("mouseover",function(){
        $(".box-one").show();
        $(".box-two").hide();
        $(this).find("img").attr("src","/source/Static/home/images/xinjiang/kllife.png")
        $(".meikemei").find("img").attr("src","/source/Static/home/images/xinjiang/meikemei1.png")
    })
    $(".xiaotuanman2 .meikemei").on("mouseover",function(){
        $(".box-two").show();
        $(".box-one").hide();
        $(this).find("img").attr("src","/source/Static/home/images/xinjiang/meikemei.png")
        $(".kllife").find("img").attr("src","/source/Static/home/images/xinjiang/kllife1.png")
    })
    $(".box-B").on("mouseover",function(){
        var index = $(this).index();
        var img = $(this).find(".boxT").attr("data-img");
        if(index<2){
            $(".lg-right").show();
            $(".lg-left").hide();
            $(".lg-right").css({"background":"url("+ img +")","background-repeat":"no-repeat","background-color":"#fff","background-position":"center center","background-size":"auto 100%"});
        }else{
            $(".lg-left").show();
            $(".lg-right").hide();
            $(".lg-left").css({"background":"url("+ img +")","background-repeat":"no-repeat","background-color":"#fff","background-position":"center center","background-size":"auto 100%"});
        }
    })
    $(".box-B").on("mouseout",function(){
        $(".lg-right").hide();
        $(".lg-left").hide();
    })


	//热门单品
	$('.hot-sale-product a').hover(
		function () {
			$(this).find('.hot-sale-img').stop().hide(500);
		},
		function () {
			$(this).find('.hot-sale-img').stop().show(1000);
		}
	);
	
	//move-bg
 	$(".tab-list").movebg({
 		width:60/*滑块的大小*/,
        extra:0/*额外反弹的距离*/,
        speed:500/*滑块移动的速度*/,
        rebound_speed:400/*滑块反弹的速度*/
    });
  	
</script>




	<!-- 右侧侧边栏 -->
	<aside>
		<div class="join-us" style="margin-top:50px;">
			<a href="<?php echo U('subject/brand');?>"></a>
		</div>
		<a class="aside_hot" href="<?php echo U('service/center');?>" target="_blank">
			<i></i>
			<div class="aside_show aside_show_hot">
				<p>帮助中心</p>
			</div>
		</a>
		<a class="aside_mine" href="<?php echo U('user/info');?>" target="_blank">
			<i></i>
			<div class="aside_show aside_show_mine">
				<p>个人中心</p>
			</div>
		</a>
		<a class="aside_order" href="<?php echo U('line/order');?>/type/center" target="_blank">
			<i></i>
			<div class="aside_show aside_show_order">
				<p>订单中心</p>
			</div>
		</a>
		<a class="aside_weixin" href="javascript:;">
			<i></i>
			<div class="aside_show aside_show_weixin">
				<img src="/source/Static/home/common/images/aside_erweima.png" alt="二维码">
			</div>
		</a>
		<a class="aside_tel" href="javascript:;">
			<i></i>
			<div class="aside_show aside_show_tel">
				<p>400-080-5860</p>
			</div>
		</a>
		<a class="aside_qq" onclick="openZoosUrl('chatwin');">
			<i></i>
			<div class="aside_show aside_show_qq">
				<p>在线咨询</p>
			</div>
		</a>
		<a class="aside_top" href="#">
			<i></i>
		</a>
	</aside>


	<footer>
		<div class="footer-content">
			<div class="footer-content-left">
				<?php if(is_array($question_type)): $i = 0; $__LIST__ = $question_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$qt): $mod = ($i % 2 );++$i; if ($key === 'config_update_time') { continue; } ?>
					<ul class="<?php echo ($qt["class"]); ?>">
						<li><?php echo ($qt["type_desc"]); ?></li>
						<?php if(is_array($qt["questions"])): $i = 0; $__LIST__ = $qt["questions"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$quest): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('service/question');?>/id/<?php echo ($quest["id"]); ?>"><?php echo ($quest["content"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<div class="footer-content-right">
				<img src="/source/Static/home/common/images/footer_erweima.png" alt="">
			</div>
		</div>
	</footer>
	<div class="footer-bottom">
		<div class="footer-bottom-content">
			<p>
				友情链接：
				<?php if(is_array($pcset)): $i = 0; $__LIST__ = $pcset;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$set_val): $mod = ($i % 2 );++$i; if(stripos($key, 'pc_friend_link') === 0): if(!empty($fk)): ?>&nbsp;|&nbsp;<?php endif; ?>
						<?php $fk = json_decode($set_val, true); ?>
						<a href="<?php echo ($fk["url"]); ?>" target="_blank" this.onclick();><?php echo ($fk["text"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</p>
			<span style="margin-top: 20px;">Copyright © 2006-2014 kllife.com | 陕西浪客国际旅行社有限责任公司版权所有</span><em>公司地址：陕西省西安市雁塔区太白南路上上国际</em>
			<br>
			<span>领袖户外经营许可证号：L-SNX00306 陕ICP备14011728号-1</span>
            <?php echo ($pcset["statistic_script"]); ?>
		</div>
	</div>
	
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="/source/Static/common/js/functions.js"></script>
	<!-- 日期 -->
	<script src="/source/Static/home/common/js/jQuery-jcDate.js"></script>
	<!-- 轮播 -->
	<script src="/source/Static/home/js/unslider.min.js"></script>
	<!-- 自绑定 -->
	<script src="/source/Static/home/common/js/showAndHide.js"></script>
	<!-- 头部js -->
	<script src="/source/Static/home/common/js/headroom.js"></script>
	<!-- 侧边栏&头部 -->
	<script src="/source/Static/home/common/js/aside-header.js"></script>
	<script type="text/javascript">

	</script>
</body>
</html>