<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta name="baidu-site-verification" content="7JiPIVdZ6K" />
	<meta charset="UTF-8">
	<meta content="领袖户外" name="author"/>
	<?php if(strpos($_SERVER['HTTP_HOST'], '.kllife.com') !== FALSE): ?><meta name="robots" content="noindex,nofollow"/><?php endif; ?>	
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
					<!--新增顶部左侧链接开始（17.08.02）-->
					<?php if(is_array($pcset_top_link)): $i = 0; $__LIST__ = array_slice($pcset_top_link,0,8,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$set_val): $mod = ($i % 2 );++$i; if(!empty($fk)): ?>&nbsp;|&nbsp;<?php endif; ?>
						<?php $fk = json_decode($set_val['value'], true); ?>
						<a href="<?php echo ($fk["url"]); ?>" target="_blank"><?php echo ($fk["text"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
					
					<div class="more">
						<div class="div1">| 更多</div>
						<div class="div2">
							<ul>
								<?php if(is_array($pcset_top_link)): $i = 0; $__LIST__ = array_slice($pcset_top_link,8,9,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$set_val): $mod = ($i % 2 );++$i; $fk = json_decode($set_val['value'], true); ?>
									<li><a href="<?php echo ($fk["url"]); ?>" target="_blank"><?php echo ($fk["text"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
					<!--新增顶部左侧链接结束-->
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
					
					//更多
					    $(".more .div1").on("mouseover",function(){
					        $(".more .div2").show()
					    })
					
					    $(".more").on("mouseleave",function(){
					         $(".more .div2").hide()
					    })
				</script>
			</div>
		</div>		
	</header>
<!-- 私有样式 -->
<link rel="stylesheet" href="/source/Static/home/common/css/common.css">
<link rel="stylesheet" href="/source/Static/home/css/index.css">
<link rel="stylesheet" href="/source/Static/home/css/box.css">
<link rel="stylesheet" href="/source/Static/home/css/slider-full.css">
<link rel="stylesheet" href="/source/Static/home/css/slow-travel.css">
<style>
	.debug_div { position: fixed; top: 0; left: 0; width: 100px; height: 100px; z-index: 9999; display: none;}
	.vui-slider{display: inline-block;text-align: center;text-align: -webkit-center;}
	#xiaotuanmanblock{left:-174px;}
	#xiaotuanmannone{left:80%;}
	#xiaotuanman-none{background-image: url(/source/Static/home/images/index_img/xiaotuanman2.png);background-repeat: no-repeat;background-position: center center;height:180px;}
	@media screen and (max-width: 1600px){#xiaotuanmannone{left:90%;}}
	.qinglvpai-product{margin-top:30px;}
	.background-img-loading{background-image: url(/source/Static/home/common/images/background-img-loading.gif);background-repeat: no-repeat;background-position: center center;z-index:90;}
</style>
<div class="debug_div">
</div>
<!-- 轮播 -->
<div style="position: relative">
	<div class="lunbo">
		<!-- 轮播 -->
		<div class="lubo">
			<ul class="lubo_box">
				<?php $__FOR_START_1925716356__=1;$__FOR_END_1925716356__=7;for($i=$__FOR_START_1925716356__;$i <= $__FOR_END_1925716356__;$i+=1){ $lunboKey = 'lunbo'.$i; $lunboUrl = 'lunbo'.$i.'_url'; ?>
					<?php if($i == 1): ?><li data-set="lunbo<?php echo ($i); ?>" style="display: block;"><a href="<?php echo ($set[$lunboUrl]); ?>" target="_blank" style="background-image:url(<?php echo ($set[$lunboKey]); ?>); background-size: 100% 100%;"></a></li>
						<?php else: ?>
						<li data-set="lunbo<?php echo ($i); ?>"><a href="<?php echo ($set[$lunboUrl]); ?>" target="_blank" style="background-image:url(<?php echo ($set[$lunboKey]); ?>); background-size: 100% 100%;"></a></li><?php endif; } ?>
			</ul>
		</div>
	</div>
	<div id="newnav">
		<div class="newnav-left">
			<?php if(is_array($left_menus)): $i = 0; $__LIST__ = $left_menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lm): $mod = ($i % 2 );++$i; if($lm['item_key'] == 'pc_home_left_menu_hot'): ?><div class="newnav-tit">
						<div class="newnav-position">
							<div>
								<h2><a href="<?php echo U('line/list');?>" class="lg"><?php echo ($lm["item_desc"]); ?></a></h2>
								<?php if(is_array($lm["child"])): $i = 0; $__LIST__ = $lm["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lmc): $mod = ($i % 2 );++$i; if(empty($lmc['left_menu_not_show'])): ?><a href="<?php echo U('line/list');?>/lm1/<?php echo ($lmc['id']); ?>/cache/1" target="_blank" class="sm"> <?php echo ($lmc["item_desc"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</div>
							<!--<i class="iconfontyyy iconfont-left">&#xe61d;</i>-->
							<i class="iconfontyyy iconfont-right">&#xe600;</i>
						</div>
					</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			<?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tm): $mod = ($i % 2 );++$i; if($tm['item_key'] == 'pc_home_menu_xtmlx' or $tm['item_key'] == 'pc_home_menu_xinlvpai' or $tm['item_key'] == 'pc_home_menu_sheying' or $tm['item_key'] == 'pc_home_menu_zhuti'): ?><div class="newnav-tit">
						<div class="newnav-position">
							<div>
								<?php if($tm['item_key'] == 'pc_home_menu_zhuti'): ?><h2><a href="<?php echo U('line/list');?>/m0/<?php echo ($tm["id"]); ?>/cache/1" target="_blank" class="lg">深度游</a></h2>
									<?php else: ?>
									<h2><a href="<?php echo U('line/list');?>/m0/<?php echo ($tm["id"]); ?>/cache/1" target="_blank" class="lg"><?php echo ($tm["item_desc"]); ?></a></h2><?php endif; ?>
								<?php if(is_array($tm["child"])): $i = 0; $__LIST__ = $tm["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tmc): $mod = ($i % 2 );++$i; if(empty($tmc['left_menu_not_show'])): ?><a href="<?php echo U('line/list');?>/m0/<?php echo ($tm["id"]); ?>/m1/<?php echo ($tmc["id"]); ?>/cache/1" target="_blank" class="sm"> <?php echo ($tmc["item_desc"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</div>
							<!--<i class="iconfontyyy iconfont-left">&#xe698;</i>-->
							<i class="iconfontyyy iconfont-right">&#xe600;</i>
						</div>
					</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			<div class="newnav-tit">
				<div class="newnav-position">
					<div>
						<h2><a href="http://shequ.kllife.com/" target="_blank" class="lg">驴友游记</a></h2>
						<a href="http://shequ.kllife.com/Index/gonglue/id/6.html" target="_blank" class="sm">新疆</a>
						<a href="http://shequ.kllife.com/Index/gonglue/id/5.html" target="_blank" class="sm">青海</a>
						<a href="http://shequ.kllife.com/Index/gonglue/id/9.html" target="_blank" class="sm">内蒙古</a>
						<a href="http://shequ.kllife.com/Index/gonglue/id/11.html" target="_blank" class="sm">贵州</a>
						<a href="http://shequ.kllife.com/Index/gonglue/id/2.html" target="_blank" class="sm">云南</a>
					</div>
					<i class="iconfontyyy iconfont-right">&#xe600;</i>
				</div>
			</div>
		</div>
		<div class="newnav-right">
			<?php if(is_array($left_menus)): $i = 0; $__LIST__ = $left_menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lm): $mod = ($i % 2 );++$i; if($lm['item_key'] == 'pc_home_left_menu_hot'): ?><div class="newnav-centent">
						<?php if(is_array($lm["child"])): $i = 0; $__LIST__ = $lm["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lmc): $mod = ($i % 2 );++$i;?><div class="newnav-item">
								<div>
									<a href="<?php echo U('line/list');?>/lm1/<?php echo ($lmc['id']); ?>/cache/1" target="_blank" class="region"><?php echo ($lmc["item_desc"]); ?></a>
									<?php if(is_array($lmc["child"])): $i = 0; $__LIST__ = $lmc["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lmcc): $mod = ($i % 2 );++$i;?><a href="<?php echo U('line/list');?>/lm1/<?php echo ($lmc['id']); ?>/lm2/<?php echo ($lmcc['id']); ?>/cache/1" target="_blank" class="region-name"><?php echo ($lmcc["item_desc"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			<?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tm): $mod = ($i % 2 );++$i; if($tm['item_key'] == 'pc_home_menu_xtmlx' or $tm['item_key'] == 'pc_home_menu_xinlvpai' or $tm['item_key'] == 'pc_home_menu_sheying' or $tm['item_key'] == 'pc_home_menu_zhuti'): ?><div class="newnav-centent">
						<?php if(is_array($tm["child"])): $i = 0; $__LIST__ = $tm["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tmc): $mod = ($i % 2 );++$i;?><div class="newnav-item">
								<div>
									<a href="<?php echo U('line/list');?>/m0/<?php echo ($tm["id"]); ?>/m1/<?php echo ($tmc["id"]); ?>/cache/1" target="_blank" class="region"><?php echo ($tmc["item_desc"]); ?></a>
									<?php if(is_array($tmc["child"])): $i = 0; $__LIST__ = $tmc["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tmcc): $mod = ($i % 2 );++$i;?><a href="<?php echo U('line/list');?>/m0/<?php echo ($tm["id"]); ?>/m1/<?php echo ($tmc['id']); ?>/m2/<?php echo ($tmcc['id']); ?>/cache/1" target="_blank" class="region-name"><?php echo ($tmcc["item_desc"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
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
<div style="width:100%;text-align: center;background:#3474bb;"><a href="http://kllife.com/home/index.php?s=/home/subject/brand" target="_blank"><img data-echo="/source/Static/home/images/index_img/index-code.jpg" alt=""></div></a>
<!-- 为什么选择我们 -->
<!--<div class="why-choose-us">
		<a href="javascript:;">
			<img src="/source/Static/home/brand/index_img/choose_us.png" alt="">
		</a>
	</div>-->
<div style="background: #f4f4f4;padding:20px 0;">
	<div class="box-father">
		<div class="box">
			<div class="boxh" id="boxtab">
				<div class="boxname">深度游</div>
				<?php if(is_array($set["depth_line_tab"])): $i = 0; $__LIST__ = $set["depth_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><div class="boxt g" data-id="<?php echo ($tab["id"]); ?>" data-title="tab1"><?php echo ($tab["type_desc"]); ?></div>
					<?php else: ?>
						<div class="boxt" data-id="<?php echo ($tab["id"]); ?>" data-title="tab2"><?php echo ($tab["type_desc"]); ?></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				<a href="javascript:;" class="line_more theme_shendu" target="_blank">更多</a>
			</div>
			
			<?php if(is_array($set["depth_line_tab"])): $i = 0; $__LIST__ = $set["depth_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; $deepIndex = '0'; ?>
				<div id="<?php echo ($tab["id"]); ?>" class="box-hidden">
					<ul>					
						<?php $__FOR_START_687414545__=0;$__FOR_END_687414545__=13;for($i=$__FOR_START_687414545__;$i < $__FOR_END_687414545__;$i+=1){ $deep_key = $tab['type_key'].$i; if (empty($set[$deep_key]['id'])) { continue; } $deepIndex ++; ?>						
						<li title="【<?php echo ($set[$deep_key]['title']); ?>】：<?php echo ($set[$deep_key]['subheading']); ?>">
							<div class="num"><?php echo ($deepIndex); ?></div>
							<dl>
								<dt><a href="<?php echo U('line/info');?>/id/<?php echo ($set[$deep_key]['id']); ?>" target="_blank">【<?php echo ($set[$deep_key]['title']); ?>】<?php echo ($set[$deep_key]['subheading']); ?></a></dt>
								<dd><a href="<?php echo U('line/info');?>/id/<?php echo ($set[$deep_key]['id']); ?>" target="_blank"><img src="<?php echo ($set[$deep_key]['img1']); ?>" width="194" height="144" /></a>
									<div class="">
										<a href="<?php echo U('line/info');?>/id/<?php echo ($set[$deep_key]['id']); ?>" target="_blank" style="font-weight: 500;">
											<strong style="position: relative;" class="jiyu">产品寄语：<span><?php echo ($set[$deep_key]['send_word']); ?></span></strong><br>
											<div style="height:10px;"></div>
											<strong>目的地：</strong><?php echo ($set[$deep_key]['destination_show_text']); ?><br>
											<strong>活动时间：</strong><?php echo ($set[$deep_key]['start_time']); ?> - <?php echo ($set[$deep_key]['end_time']); ?><br>
											<strong>集结地点：</strong><?php echo ($set[$deep_key]['assembly_point_show_text']); ?><br>
										</a>
										<?php if(empty($set[$deep_key]['check_price'])): ?><div><em>核算中</em><a href="<?php echo U('line/info');?>/id/<?php echo ($set[$deep_key]['id']); ?>" target="_blank">马上报名</a></div>
										<?php else: ?>
											<?php $price = explode('.', $set[$deep_key]['start_price_adult']); ?>
											<div><em>￥<?php echo ($price[0]); ?></em><a href="<?php echo U('line/info');?>/id/<?php echo ($set[$deep_key]['id']); ?>" target="_blank">马上报名</a></div><?php endif; ?>
									</div>
								</dd>
							</dl>
						</li><?php } ?>
					</ul>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<div class="box">
			<div class="boxh" id="boxtab">
				<div class="boxname">摄影游</div>
				<?php if(is_array($set["photograph_line_tab"])): $i = 0; $__LIST__ = $set["photograph_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><div class="boxt g" data-id="<?php echo ($tab["id"]); ?>" data-title="tab1"><?php echo ($tab["type_desc"]); ?></div>
					<?php else: ?>
						<div class="boxt" data-id="<?php echo ($tab["id"]); ?>" data-title="tab1"><?php echo ($tab["type_desc"]); ?></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				<a href="javascript:;" class="line_more theme_sheying" target="_blank">更多</a>
			</div>
			
			<?php if(is_array($set["photograph_line_tab"])): $i = 0; $__LIST__ = $set["photograph_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; $photoIndex = '0'; ?>
				<div id="<?php echo ($tab["id"]); ?>" class="box-hidden">
					<ul>					
						<?php $__FOR_START_182899365__=0;$__FOR_END_182899365__=13;for($i=$__FOR_START_182899365__;$i < $__FOR_END_182899365__;$i+=1){ $photo_key = $tab['type_key'].$i; if (empty($set[$photo_key]['id'])) { continue; } $photoIndex ++; ?>						
						<li title="【<?php echo ($set[$photo_key]['title']); ?>】：<?php echo ($set[$photo_key]['subheading']); ?>">
							<div class="num"><?php echo ($photoIndex); ?></div>
							<dl>
								<dt><a href="<?php echo U('line/info');?>/id/<?php echo ($set[$photo_key]['id']); ?>" target="_blank">【<?php echo ($set[$photo_key]['title']); ?>】<?php echo ($set[$photo_key]['subheading']); ?></a></dt>
								<dd><a href="<?php echo U('line/info');?>/id/<?php echo ($set[$photo_key]['id']); ?>" target="_blank"><img src="<?php echo ($set[$photo_key]['img1']); ?>" width="194" height="144" /></a>
									<div class="">
										<a href="<?php echo U('line/info');?>/id/<?php echo ($set[$photo_key]['id']); ?>" target="_blank" style="font-weight: 500;"> 
											<strong style="position: relative;" class="jiyu">产品寄语：<span><?php echo ($set[$photo_key]['send_word']); ?></span></strong><br>
											<div style="height:10px;"></div>
											<strong>目的地：</strong><?php echo ($set[$photo_key]['destination_show_text']); ?><br>
											<strong>活动时间：</strong><?php echo ($set[$photo_key]['start_time']); ?> - <?php echo ($set[$photo_key]['end_time']); ?><br>
											<strong>集结地点：</strong><?php echo ($set[$photo_key]['assembly_point_show_text']); ?><br>
										</a>
										<?php if(empty($set[$photo_key]['check_price'])): ?><div><em>核算中</em><a href="<?php echo U('line/info');?>/id/<?php echo ($set[$photo_key]['id']); ?>" target="_blank">马上报名</a></div>
										<?php else: ?>
											<?php $price = explode('.', $set[$photo_key]['start_price_adult']); ?>
											<div><em>￥<?php echo ($price[0]); ?></em><a href="<?php echo U('line/info');?>/id/<?php echo ($set[$photo_key]['id']); ?>" target="_blank">马上报名</a></div><?php endif; ?>
									</div>
								</dd>
							</dl>
						</li><?php } ?>
					</ul>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
</div>
<!-- 跟拍游 -->
<div class="bg-gray" style="background: #fff; display: none;">
	<div class="qinglvpai main">
		<h2 style="float: left;padding-left:10px;">跟拍游</h2>
		<h4 style="float: left; font-weight: normal; margin-left:10px; margin-top: 12px;color:#ff1c77">游世界拍美照，不是所有的旅行都专注女性！</h4>
		<p><a href="<?php echo U('line/xiezhenlvxing');?>" target="_blank">更多</a></p>
		<ul class="tab-list">
			<?php if(is_array($set["qinglvpai_line_tab"])): $i = 0; $__LIST__ = $set["qinglvpai_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><li><a href="javascript:;" class="g cur" data-id="<?php echo ($tab["id"]); ?>"><?php echo ($tab["type_desc"]); ?></a></li>
					<?php else: ?>
					<li><a href="javascript:;" data-id="<?php echo ($tab["id"]); ?>"><?php echo ($tab["type_desc"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			<div class="move-bg"></div>
		</ul>

		<?php if(is_array($set["qinglvpai_line_tab"])): $i = 0; $__LIST__ = $set["qinglvpai_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; $qinglvpaiIndex = '0'; ?>
			<div class="qinglvpai-product" id="<?php echo ($tab["id"]); ?>">
				<ul>
					<?php $__FOR_START_841716960__=0;$__FOR_END_841716960__=8;for($i=$__FOR_START_841716960__;$i < $__FOR_END_841716960__;$i+=1){ $qinglvpai_key = $tab['type_key'].$i; if (empty($set[$qinglvpai_key]['id'])) { continue; } $liClass = ''; if ($qinglvpaiIndex % 4 == 0) { $liClass = 'clear-margin'; } $qinglvpaiIndex ++; ?>
						<li class="<?php echo ($liClass); ?>" title="<?php echo ($set[$qinglvpai_key]['title']); ?>：<?php echo ($set[$qinglvpai_key]['subheading']); ?>">
							<div class="qinglvpai-product-content" data-id="<?php echo ($set[$qinglvpai_key]['id']); ?>" style="border:none;">
								<!--几日游-->
								<div class="jiriyou">
									<p><span><?php echo ($set[$qinglvpai_key]['travel_day']); ?></span>日游</p>
								</div>
								<?php if(empty($set[$qinglvpai_key]['line_especial_icon']) == false): ?><div class="today-hot">
										<img data-echo="/source/Static/home/images/index_img/<?php echo ($set[$qinglvpai_key]['line_especial_icon']); ?>" alt="">
									</div><?php endif; ?>
								<a class="background-img-loading" href="<?php echo U('line/info');?>/id/<?php echo ($set[$qinglvpai_key]['id']); ?>" target="_blank">
									<img data-echo="<?php echo ($set[$qinglvpai_key]['img1']); ?>" data-echo="" alt="">
								</a>
								<div class="qinglvpai-product-content-describe" style="background: #f4f4f4">
									<h5><a href="<?php echo U('line/info');?>/id/<?php echo ($set[$qinglvpai_key]['id']); ?>" target="_blank"><?php echo ($set[$qinglvpai_key]['title']); ?></a></h5>
									<p><?php echo ($set[$qinglvpai_key]['subheading']); ?></p>
									<?php if(empty($set[$qinglvpai_key]['check_price'])): ?><strong><em>核算中</em></strong>
										<?php else: ?>
										<?php $price = explode('.', $set[$qinglvpai_key]['start_price_adult']); ?>
										<strong>￥<em><?php echo ($price[0]); ?></em>起</strong><?php endif; ?>
								</div>
							</div>
						</li><?php } ?>
				</ul>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
</div>
<!-- 深度游 -->
<div class="bg-white"  style="background: #fff;">
	<div class="theme main">
		<h2 style="padding-left:10px;">小团慢旅行</h2>
		<p><a href="javascript:;" class="line_more theme_xtmlx" target="_blank" style="color:#333;">更多</a></p>
		<ul class="tab-list" style="right:80px;">
			<?php if(is_array($set["theme_line_tab"])): $i = 0; $__LIST__ = $set["theme_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><li><a href="javascript:;" class="g cur" data-id="<?php echo ($tab["id"]); ?>"><?php echo ($tab["type_desc"]); ?></a></li>
					<?php else: ?>
					<li><a href="javascript:;" data-id="<?php echo ($tab["id"]); ?>"><?php echo ($tab["type_desc"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			<div class="move-bg"></div>
		</ul>

		<?php if(is_array($set["theme_line_tab"])): $i = 0; $__LIST__ = $set["theme_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; $themeIndex = '0'; ?>
			<div class="theme-product" id="<?php echo ($tab["id"]); ?>">
				<ul>
					<?php $__FOR_START_1878591395__=0;$__FOR_END_1878591395__=8;for($i=$__FOR_START_1878591395__;$i < $__FOR_END_1878591395__;$i+=1){ $theme_key = $tab['type_key'].$i; if (empty($set[$theme_key]['id'])) { continue; } $liClass = ''; if ($themeIndex % 4 == 0) { $liClass = 'clear-margin'; } $themeIndex ++; ?>
						<li class="<?php echo ($liClass); ?>" title="<?php echo ($set[$theme_key]['title']); ?>：<?php echo ($set[$theme_key]['subheading']); ?>">
							<div class="theme-product-content" data-id="<?php echo ($set[$theme_key]['id']); ?>" style="border:none">
								<!--几日游-->
								<div class="jiriyou">
									<p><span><?php echo ($set[$theme_key]['travel_day']); ?></span>日游</p>
								</div>
								<?php if(empty($set[$theme_key]['line_especial_icon']) == false): ?><div class="today-hot">
										<img data-echo="/source/Static/home/images/index_img/<?php echo ($set[$theme_key]['line_especial_icon']); ?>" alt="">
									</div><?php endif; ?>
								<a class="background-img-loading" style="display:block;height:185px;" href="<?php echo U('line/info');?>/id/<?php echo ($set[$theme_key]['id']); ?>" target="_blank">
									<img style="height:185px;" data-echo="<?php echo ($set[$theme_key]['img1']); ?>" data-echo="" alt="">
								</a>
								<div class="theme-product-content-describe" style="background: #f4f4f4">
									<h5><a href="<?php echo U('line/info');?>/id/<?php echo ($set[$theme_key]['id']); ?>" target="_blank"><?php echo ($set[$theme_key]['title']); ?></a></h5>
									<p><?php echo ($set[$theme_key]['subheading']); ?></p>
									<?php if(empty($set[$theme_key]['check_price'])): ?><strong><em>核算中</em></strong>
										<?php else: ?>
										<?php $price = explode('.', $set[$theme_key]['start_price_adult']); ?>
										<strong>￥<em><?php echo ($price[0]); ?></em>起</strong><?php endif; ?>
								</div>
							</div>
						</li><?php } ?>
				</ul>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
</div>

<!-- 出境游 -->
<div class="bg-gray"  style="background: #f4f4f4;">
	<div class="line-tab abroad main">
		<h2 style="padding-left:10px;">出境游</h2>
		<p><a href="javascript:;" class="line_more theme_chujing" target="_blank">更多</a></p>
		<ul class="tab-list">
			<?php if(is_array($set["abroad_line_tab"])): $i = 0; $__LIST__ = $set["abroad_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><li><a href="javascript:;" class="g cur" data-id="<?php echo ($tab["id"]); ?>"><?php echo ($tab["type_desc"]); ?></a></li>
					<?php else: ?>
					<li><a href="javascript:;" data-id="<?php echo ($tab["id"]); ?>"><?php echo ($tab["type_desc"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			<div class="move-bg"></div>
		</ul>

		<?php if(is_array($set["abroad_line_tab"])): $i = 0; $__LIST__ = $set["abroad_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; $abroadIndex = '0'; ?>
			<div class="theme-product" id="<?php echo ($tab["id"]); ?>">
				<ul>
					<?php $__FOR_START_1567372094__=0;$__FOR_END_1567372094__=8;for($i=$__FOR_START_1567372094__;$i < $__FOR_END_1567372094__;$i+=1){ $abroad_key = $tab['type_key'].$i; if (empty($set[$abroad_key]['id'])) { continue; } $liClass = ''; if ($abroadIndex % 4 == 0) { $liClass = 'clear-margin'; } $abroadIndex ++; ?>
						<li class="<?php echo ($liClass); ?>" title="<?php echo ($set[$abroad_key]['title']); ?>：<?php echo ($set[$abroad_key]['subheading']); ?>">
							<div class="theme-product-content" data-id="<?php echo ($set[$abroad_key]['id']); ?>" style="border:none">
								<!--几日游-->
								<div class="jiriyou">
									<p><span><?php echo ($set[$abroad_key]['travel_day']); ?></span>日游</p>
								</div>
								<?php if(empty($set[$abroad_key]['line_especial_icon']) == false): ?><div class="today-hot">
										<img data-echo="/source/Static/home/images/index_img/<?php echo ($set[$abroad_key]['line_especial_icon']); ?>" alt="">
									</div><?php endif; ?>
								<a class="background-img-loading" style="display:block;height:185px;" href="<?php echo U('line/info');?>/id/<?php echo ($set[$abroad_key]['id']); ?>" target="_blank">
									<img style="height:185px;" data-echo="<?php echo ($set[$abroad_key]['img1']); ?>" data-echo="" alt="">
								</a>
								<div class="theme-product-content-describe" style="background: #fff">
									<h5><a href="<?php echo U('line/info');?>/id/<?php echo ($set[$abroad_key]['id']); ?>" target="_blank"><?php echo ($set[$abroad_key]['title']); ?></a></h5>
									<p><?php echo ($set[$abroad_key]['subheading']); ?></p>
									<?php if(empty($set[$abroad_key]['check_price'])): ?><strong><em>核算中</em></strong>
									<?php else: ?>
										<?php $price = explode('.', $set[$abroad_key]['start_price_adult']); ?>
										<strong>￥<em><?php echo ($price[0]); ?></em>起</strong><?php endif; ?>
								</div>
							</div>
						</li><?php } ?>
				</ul>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
</div>

<!-- 周边游 -->
<div class="bg-white"  style="background: #fff;">
	<div class="surrounding main">
		<?php if($station['key'] != 'main'): ?><h2 style="padding-left:10px;"><?php echo ($station["name"]); ?>周边游</h2>
			<p><a href="javascript:;" class="line_more theme_surrounding" data-station="<?php echo ($station['key']); ?>" target="_blank">更多</a></p>
			<?php else: ?>
			<h2 style="padding-left:10px;">周边游</h2>
			<p><a href="javascript:;" class="line_more theme_surrounding" target="_blank">更多</a></p><?php endif; ?>
		<ul class="tab-list">
			<?php if(is_array($set["surrounding_line_tab"])): $i = 0; $__LIST__ = $set["surrounding_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><li><a href="javascript:;" class="g cur" data-id="<?php echo ($tab["id"]); ?>"><?php echo ($tab["type_desc"]); ?></a></li>
					<?php else: ?>
					<li><a href="javascript:;" data-id="<?php echo ($tab["id"]); ?>"><?php echo ($tab["type_desc"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			<div class="move-bg"></div>
		</ul>

		<?php if(is_array($set["surrounding_line_tab"])): $i = 0; $__LIST__ = $set["surrounding_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; $surroundIndex = '0'; ?>
			<div class="surrounding-product" id="<?php echo ($tab["id"]); ?>">
				<ul>
					<?php $__FOR_START_571975871__=0;$__FOR_END_571975871__=8;for($i=$__FOR_START_571975871__;$i < $__FOR_END_571975871__;$i+=1){ $around_key = $tab['type_key'].$i; if (empty($set[$around_key]['id'])) { continue; } $liClass = ''; if ($surroundIndex % 4 == 0) { $liClass = 'clear-margin'; } $surroundIndex ++; ?>
						<li class="<?php echo ($liClass); ?>" title="<?php echo ($set[$around_key]['title']); ?>：<?php echo ($set[$around_key]['subheading']); ?>">
							<div class="surrounding-product-content" data-id="<?php echo ($set[$around_key]['id']); ?>" style="margin:0px 10px;">
								<!--几日游-->
								<div class="jiriyou">
									<p><span><?php echo ($set[$around_key]['travel_day']); ?></span>日游</p>
								</div>
								<?php if(empty($set[$around_key]['line_especial_icon']) == false): ?><div class="today-hot">
										<img data-echo="/source/Static/home/images/index_img/<?php echo ($set[$around_key]['line_especial_icon']); ?>" alt="">
									</div><?php endif; ?>
								<a class="background-img-loading" href="<?php echo U('line/info');?>/id/<?php echo ($set[$around_key]['id']); ?>" target="_blank">
									<img data-echo="<?php echo ($set[$around_key]['img1']); ?>" data-echo="" alt="">
								</a>
								<div class="surrounding-product-content-describe" style="background: #f4f4f4">
									<h5><a href="<?php echo U('line/info');?>/id/<?php echo ($set[$around_key]['id']); ?>" target="_blank"><?php echo ($set[$around_key]['title']); ?></a></h5>
									<p><?php echo ($set[$around_key]['subheading']); ?></p>
									<?php if(empty($set[$around_key]['check_price'])): ?><strong><em>核算中</em></strong>
										<?php else: ?>
										<?php $price = explode('.', $set[$around_key]['start_price_adult']); ?>
										<strong>￥<em><?php echo ($price[0]); ?></em>起</strong><?php endif; ?>
								</div>
							</div>
						</li><?php } ?>
				</ul>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
</div>
<!-- 精彩专题 -->


	<div class="bg-gray">

		<div class="special main">

			<h2>超级目的地</h2>

			<div class="special-exhibition">

				<ul>
					<?php $idx = '0'; ?>
					
					<?php $__FOR_START_143197375__=0;$__FOR_END_143197375__=12;for($k=$__FOR_START_143197375__;$k < $__FOR_END_143197375__;$k+=1){ $zt = $set_subjects['zhuanti'.$k]; if (empty($zt['url'])) { continue; } ?>
						
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
<!-- 活动回顾 -->
<div class="bg-gray" style="background: #f4f4f4">
	<div class="events-review main">
		<h2 style="padding-left:10px;">活动回顾 <span style="font-size: 14px;color:#f00;padding-left:10px;">最新活动直播与团友游记推荐</span></h2>
		<p><a href="http://shequ.kllife.com" target="_blank">更多</a></p>
		<div class="events-review-product">
			<ul>
				<?php $__FOR_START_1462365348__=0;$__FOR_END_1462365348__=12;for($i=$__FOR_START_1462365348__;$i < $__FOR_END_1462365348__;$i+=1){ $act = $set['activity'.$i] ?>
					<?php if(empty($act['url']) == false): if($i % 3 == 0): ?><li class="clear-margin">
								<?php else: ?>
							<li><?php endif; ?>
						<div class="events-review-product-content" title="<?php echo ($act["subheading"]); ?>">
							<a href="<?php echo ($act["url"]); ?>" target="_blank">
								<img class="background-img-loading" data-echo="<?php echo ($act["img"]); ?>" alt="">
							</a>
							<div class="events-review-product-content-describe" style="background:#fff;">
								<h5><a href="<?php echo ($act["url"]); ?>" target="_blank"><?php echo ($act["subheading"]); ?></a></h5>
								<p>作者：<?php echo ($act["author"]); ?></p>
								<span><?php echo ($act["title"]); ?></span>
								<em><?php echo ($act["price"]); ?></em>
							</div>
						</div>
						</li><?php endif; } ?>
			</ul>
		</div>
	</div>
</div>

<!-- 精彩分享 -->
<!--<div class="bg-gray">-->
<!--<div class="main commodity">-->
<!--<h2>精彩分享</h2>-->
<!--<p><a href="<?php echo U('line/article');?>/type/list" target="_blank">更多</a></p>-->
<!--<div class="commodity-product">-->
<!--<ul>-->
<!--<?php $__FOR_START_985055782__=0;$__FOR_END_985055782__=4;for($i=$__FOR_START_985055782__;$i < $__FOR_END_985055782__;$i+=1){ ?>-->
<!--<?php if($i % 4 == 0): ?>-->
<!--<li class="clear-margin">-->
<!--<?php else: ?>-->
<!--<li>-->
<!--<?php endif; ?>-->
<!--<?php $article = $set['article'.$i] ?>-->
<!--<div class="commodity-product-content">-->
<!--<a href="<?php echo U('line/article');?>/id/<?php echo ($article["id"]); ?>" target="_blank">-->
<!--<img class="background-img-loading" data-echo="<?php echo ($article["face_image"]); ?>" alt="">-->
<!--</a>-->
<!--<div class="commodity-product-content-describe">-->
<!--<h5><a href="<?php echo U('line/article');?>/id/<?php echo ($article["id"]); ?>" target="_blank"><?php echo ($article["short_title"]); ?></a></h5>-->
<!--</div>-->
<!--</div>-->
<!--</li>-->
<!--<?php } ?>-->
<!--</ul>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->

<!-- 领队风采 -->
<?php if(show_leader == 1): ?><div class="bg-white">
		<div class="leader main">
			<h2>领队风采</h2>
			<p><a href="javascript:;" target="_blank">更多</a></p>
			<div class="leader-product">
				<ul>
					<li class="clear-margin">
						<div class="leader-product-content">
							<a href="javascript:;">
								<img class="background-img-loading" data-echo="/source/Static/home/images/index_img/leader01.png" alt="">
								<div>
									<img class="background-img-loading" data-echo="/source/Static/home/images/index_img/leader_head.png" alt="">
									<h4>小B	</h4>
									<span>人文街拍教程、美拍专家</span>
									<p><em>TA的故事：</em>他的故事的人文街...</p>
								</div>
							</a>
						</div>
					</li>
					<li>
						<div class="leader-product-content">
							<a href="javascript:;">
								<img class="background-img-loading" data-echo="/source/Static/home/images/index_img/leader02.png" alt="">
								<div>
									<img class="background-img-loading" data-echo="/source/Static/home/images/index_img/leader_head.png" alt="">
									<h4>小C</h4>
									<span>人文街拍教程、美拍专家</span>
									<p><em>TA的故事：</em>他的故事的人文街...</p>
								</div>
							</a>
						</div>
					</li>
					<li>
						<div class="leader-product-content">
							<a href="javascript:;">
								<img class="background-img-loading" data-echo="/source/Static/home/images/index_img/leader03.png" alt="">
								<div>
									<img class="background-img-loading" data-echo="/source/Static/home/images/index_img/leader_head.png" alt="">
									<h4>小D</h4>
									<span>人文街拍教程、美拍专家</span>
									<p><em>TA的故事：</em>他的故事的人文街...</p>
								</div>
							</a>
						</div>
					</li>
					<li>
						<div class="leader-product-content">
							<a href="javascript:;">
								<img class="background-img-loading" data-echo="/source/Static/home/images/index_img/leader04.png" alt="">
								<div>
									<img class="background-img-loading" data-echo="/source/Static/home/images/index_img/leader_head.png" alt="">
									<h4>小D</h4>
									<span>人文街拍教程、美拍专家</span>
									<p><em>TA的故事：</em>他的故事的人文街...</p>
								</div>
							</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div><?php endif; ?>
<!-- 视频 -->
<div class="bg-white" style="background: #fff;">
	<div class="main video">
		<h2>视频中心</h2>
		<p><a href="<?php echo U('line/video');?>" target="_blank">更多</a></p>
		<div class="video-product">
			<ul>
				
			</ul>
		</div>
	</div>
</div>

<!-- 左侧导航栏 -->
<!--<div class="left-aside">-->
	<!--<ul>-->
		<!--<li><a class="left-aside-hot" data-obj="hot-sale" href="javascript:;">热卖</a></li>-->
		<!--<li><a class="left-aside-depth" data-obj="depth" href="javascript:;">小团</a></li>-->
		<!--<li><a class="left-aside-qinglvpai" data-obj="qinglvpai" href="javascript:;">写真<br/>旅行</a></li>-->
		<!--<li><a class="left-aside-photograph" data-obj="photograph" href="javascript:;">摄影</a></li>-->
		<!--<li><a class="left-aside-theme" data-obj="theme" href="javascript:;">民族</a></li>-->
		<!--<li><a class="left-aside-surrounding" data-obj="surrounding" href="javascript:;">周边</a></li>-->
	<!--</ul>-->
<!--</div>-->

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
<!--好玩不贵小团慢旅行-->
<!--<div id="xiaotuanmanblock" style="position: fixed;bottom:15px;width:174px;cursor: pointer;z-index:100;"><img src="/source/Static/home/images/index_img/xiaotuanman1.png" alt=""></div>-->
<!--<a href="http://www.kllife.com/home/index.php?s=/home/subject/brand" target="_blank"><div id="xiaotuanman-none" style="position: fixed;bottom:0px;left:-0px;width:100%;z-index:100;" ></div></a>-->
<!--<img id="xiaotuanmannone" style="position: fixed;bottom:95px;cursor:pointer;z-index:100;" src="/source/Static/home/images/index_img/xiaotuanmannone.png" alt="">-->

<!-- 更改tab-bg -->
<script src="/source/Static/home/common/js/movebg.js"></script>
<!-- tab -->
<script src="/source/Static/home/common/js/tab.js"></script>
<!-- 视频 -->
<script src="/source/Static/home/common/js/iframe.js"></script>
<!-- 顶部轮播 -->
<script src="/source/Static/home/js/lunbo.js"></script>
<!--图片延时加载-->
<script src="/source/Static/home/common/js/echo.min.js"></script>
<!--视频显示-->
<script src="/source/Static/common/js/video.js"></script>
<script>
    //初始化图片延迟加载
    echo.init();
</script>

<script>
    $(".box .boxh .boxt").on("mouseover",function() {
        $(this).addClass("g").siblings().removeClass("g")
        var eindex = $(this).index()-1;
        $(this).parents(".box").find(".box-hidden").siblings(".box-hidden").hide().eq(eindex).fadeIn();
    });
    $(".box div li").hover(function() {
        $(this).css("height", "191px");
        $(this).find("dl dt a").css({
            "color": "#2f71b8",
            "display": "block",
            "width": "512px",
            "height": "19px",
            "overflow": "hidden",
            "font-weight": "bold",
            "font-size": "16px"
        });
        $(this).siblings("li").css({
            "height": "19px"
        });
        $(this).siblings().find("dl dt a").css({
            "height": "19px",
            "font-weight": "normal",
            "font-size": "12px",
            "font-family": "宋体",
            "color": "#5e6060"
        });
    });


    //小团慢显示于隐藏
//    var width;
//    $("#xiaotuanmanblock").on("click",function(){
//        width = $(window).width();
//        if(width<1600){
//            $(this).animate({left: -174}, 500);
//            setTimeout(function () {
//                $("#xiaotuanman-none").animate({left: 0}, 700);
//                $("#xiaotuanmannone").animate({left: "90%"}, 700);
//            }, 500);
//        }else{
//            $(this).animate({left: -174},500);
//            setTimeout(function () {
//                $("#xiaotuanman-none").animate({left: 0}, 700);
//                $("#xiaotuanmannone").animate({left: "80%"}, 700);
//            }, 500);
//        }
//    })
//    $("#xiaotuanmannone").on("click",function(){
//        if(width<1600){
//            $("#xiaotuanman-none").animate({left: "-100%"}, 700);
//            $("#xiaotuanmannone").animate({left: -30}, 450);
//            setTimeout(function () {
//                $("#xiaotuanmanblock").animate({left: -132}, 700);
//            }, 700);
//        }else{
//            $("#xiaotuanman-none").animate({left: "-100%"}, 500);
//            $("#xiaotuanmannone").animate({left: -30}, 450);
//            setTimeout(function () {
//                $("#xiaotuanmanblock").animate({left: 0}, 500);
//            }, 700);
//        }
//    })
</script>

<script>
    //精选热卖
    $(".hot-sale-product .item").on("mouseover",function(){
        $(this).find(".background-img-loading").addClass("minus-top")
        $(this).find(".tit").removeClass("height").addClass("height-lg")
    })
    $(".hot-sale-product .item").on("mouseout",function(){
        $(this).find(".background-img-loading").removeClass("minus-top")
        $(this).find(".tit").addClass("height").removeClass("height-lg")
    })

    //newnav
    $(".newnav-left .newnav-tit").on("mouseover",function(){
        $("#newnav .newnav-right").css("height","500px")
        $(this).addClass("background").siblings().removeClass("background");
        $(this).prev().addClass("none").siblings().removeClass("none");
        $(this).find(".lg").addClass("black");
        $(this).siblings().find(".lg").removeClass("black");
        $(this).find("i").addClass("gray");
        $(this).siblings().find("i").removeClass("gray");
        var index = $(this).index();
        $(".newnav-right").find(".newnav-centent").siblings().hide().eq(index).show();
    })
    $("#newnav").on("mouseleave",function(){
        $(".newnav-right").find(".newnav-centent").hide();
        $(".newnav-tit").removeClass("background");
        $(".newnav-tit").removeClass("none")
        $(".newnav-tit").find(".lg").removeClass("black");
        $(".newnav-tit").find("i").removeClass("gray");
        $("#newnav .newnav-right").css("height","0px")
    })
    //big轮播
    $(".lubo").lubo({});
    //small轮播
    $('.special-exhibition').unslider({
        dots: true
    });
    //专业保证
    var unslider01 = $('.professional-guarantee-slide').unslider({
            dots: true
        }),
        data04 = unslider01.data('unslider');
    $('.unslider-arrow01').click(function() {
        var fn = this.className.split(' ')[1];
        data04[fn]();
    });

    //move-bg
    $(".tab-list").movebg({
        width:60/*滑块的大小*/,
        extra:0/*额外反弹的距离*/,
        speed:500/*滑块移动的速度*/,
        rebound_speed:400/*滑块反弹的速度*/
    });

    var Width = $(window).width();
    $('.left-aside').css('left', (Width - 1200)/2 - 80 );
    $(window).resize(function(){
        var WidthR = $(window).width();
        if( WidthR > 1300 ) {
            $('.left-aside').show();
            $(".left-aside").stop().animate({
                left: 60
            },150);
        }else {
            $('.left-aside').hide();
        }
    });


    function aside() {
        var vs = {
//            hot: {obj:'.left-aside-hot', top:$('.hot-sale').offset().top},
//            dep: {obj:'.left-aside-depth', top:$('.depth').offset().top},
//            qlp: {obj:'.left-aside-qinglvpai', top:$('.qinglvpai').offset().top},
//            photo: {obj:'.left-aside-photograph', top:$('.photograph').offset().top},
//            theme: {obj:'.left-aside-theme', top:$('.theme').offset().top},
//            sur: {obj:'.left-aside-surrounding', top:$('.surrounding').offset().top},
        }
//        var win = { top:$(window).scrollTop(), h: $(window).height() }
//
//        // 侧边栏显示隐藏
//        if ((vs.hot.top - win.top) < (win.h * 0.5)) {
//            $('.left-aside').fadeIn();
//        } else {
//            $('.left-aside').fadeOut();
//        }
//
//        // 侧边栏定位
//        var prev_height = 0;
//        var prev_obj = null;
//        var final_obj = null;
//        for (x in vs) {
//            var bindObj = '.'+$(vs[x]['obj']).attr('data-obj');
//            var cur = vs[x]['top'] - win.top;
//            var cur_bottom = cur + $(bindObj).height();
//            var cur_height = win.top+win.h-vs[x]['top'];
////			console.log(x+',cur:'+cur+',cur_bottom:'+cur_bottom+',win_top:'+win.top+',win_h:'+win.h+',cur_height:'+cur_height+',prev_height:'+prev_height);
//            if (cur < win.h && cur_bottom > 0) {
//                final_obj = null;
//                if (prev_height > cur_height) {
//                    final_obj = prev_obj;
//                } else {
//                    final_obj = vs[x]['obj'];
//                }
//                prev_height = cur_bottom;
//                prev_obj = vs[x]['obj'];
//            }
//            prev_height = cur + $(bindObj).height();
//            prev_obj = vs[x]['obj'];
//        }
//
//        if (final_obj != null) {
//            $('.left-aside').find('ul > li > a').removeClass('active');
//            $(final_obj).addClass('active');
//        } else {
//            $('.left-aside').find('ul > li > a').removeClass('active');
//        }
    }

    // 初始化侧边栏显示
//    aside();

    // 窗口滚动侧边栏处理
    $(window).scroll(aside);

    //左侧固定导航栏
    function toTag(g, h) {
        $(g).click(
            function(){
                $(this).closest('ul').find('a').removeClass('active');
                $(this).addClass('active');

                var obj = '.'+$(this).attr('data-obj');
                var h = parseInt($(obj).offset().top) - 100;
                $("html,body").animate({scrollTop: h}, 1000);
            }
        );
    };
//    toTag('.left-aside-hot');
//    toTag('.left-aside-depth');
    toTag('.left-aside-qinglvpai');
    toTag('.left-aside-photograph');
    toTag('.left-aside-theme');
    toTag('.left-aside-surrounding');

    //精彩专题
    $('.special-exhibition-product').fadeInAndOut('special-img', 'div');
    //热门单品
    $('.hot-sale-product a').hover(
        function () {
            $(this).find('.hot-sale-img').stop().hide(500);
        },
        function () {
            $(this).find('.hot-sale-img').stop().show(1000);
        }
    );
    
    // 跳转获取更多线路
    $('.line_more').click(function(){
    	var rootObj = $(this).parent();
    	var activeObj = null;
    	if ($(rootObj).hasClass('boxh')) {
    		activeObj = $(this).parent().find('.g');
    	} else {
    		activeObj = $(this).parent().next().find('.g');
    	}
    	if (activeObj == null || typeof(activeObj) == 'undefined') {
    		console.log('未能找到激活的TAB对象');
    		return false;
    	}
    	console.log($(activeObj).attr('class'));
    	var activeId = $(activeObj).attr('data-id');
    	if (activeId == null || activeId == '' || typeof(activeId) == 'undefined') {
    		console.log('选择的标签错误');
    		return false;
    	}
    	var url = '<?php echo U("line/list");?>/cache/1';
    	var cds = '';
    	if ($(this).hasClass('theme_xtmlx')) {
    		cds += (cds == '' ? 'c0|37' : '|c0|37');
    	} else if ($(this).hasClass('theme_sheying')) {
    		cds += (cds == '' ? 'c0|38' : '|c0|38');
    	} else if ($(this).hasClass('theme_shendu')) {
    		cds += (cds == '' ? 'c0|118' : '|c0|118');
    	} else if ($(this).hasClass('theme_chujing')) {
    		cds += (cds == '' ? 'c0|501' : '|c0|501');
    	} else if ($(this).hasClass('theme_surrounding')) {
    		cds += (cds == '' ? 'c0|876' : '|c0|876');
    		var station = $(this).attr('data-station');
    		if (station != '' && station != null) {
    			url += '/station/'+station;
    		}
    	}
    	var activeHtml = $(activeObj).html();
    	if (activeHtml != '推荐') {
    		cds += (cds == '' ? ('c1|'+activeId) : ('|c1|'+activeId));
    	}
    	if (cds != '') {
    		url += '/cds/'+cds;
    	}
    	window.open(url);
    });

	// 获取美拍视频
	function getMPList() {
		var jsonData = {
			op: 'list',
			topic_name: '小团慢旅行',
			count:8,
			feature:'new'
		}
		$.post('http://kllife.com/back/index.php?s=/back/help/meipai',jsonData,function(data){
			if (data.ds != null) {
				for (var i=0; i<data.ds.length; i++) {
					var d = data.ds[i];
					var liCount = $('.video-product ul').find('li').length;
					var className = parseInt(liCount) % 4 == 0 ? 'clear-margin' : '';
					var vhtml = '<li class="'+className+'">'+
								'	<div class="video-product-content" data-id="'+d.id+'" data-title="'+d.caption+'" data-url="'+d.url+'">'+
								'		<a href="'+d.url+'" target="_blank">'+
								'			<img src="'+d.cover_pic+'" alt="">'+
								'			<i></i>'+
								'		</a>'+
								'		<div class="video-product-content-describe">'+
								'			<h5><a href="'+d.url+'" target="_blank">'+d.caption+'</a></h5>'+
								'			<p>'+d.caption+'</p>'+
								'		</div>'+
								'	</div>'+
								'</li>';
					$('.video-product ul').append(vhtml);
					$('.video-product ul').find('li:last').find('a').click(showVideo);
				}
			}
		});
	}
	
	$(document).ready(function(){
		// 加载美拍视频列表
		getMPList();
	});
	
	//视频弹出
	function showVideo() {
		var rootObj = $(this).closest('.video-product-content');
		var url = $(rootObj).attr('data-url');
		var title = $(rootObj).attr('data-title');
		$('.myiframe').find('#titleIframe').html(title);
	}	
	//视频关闭
	function closeVideo() {
		$('.mark').hide();
		$('.myiframe').hide();
		$('#videoIframe').attr('src', '');
//		$('.myiframe').find('.iframe').children().remove();
	}
	$('.video_close').click(closeVideo);
	
	// 查找数据
	function showVideoData(ds, vhtml) {
		$('.myiframe').find('.iframe').html(vhtml);
		$('.myiframe').find('#titleIframe').html(ds.title);
	}	
	var myvideo = new MyVideo(showVideoData);
    
</script>
<!-- 功能脚本 -->
<script type="text/javascript">
    //	$(document).ready(function(){
    //		$('.special-exhibition-product').click(jumpToZhuanTi);
    //	});
    //
    //	// 专题跳转
    //	function jumpToZhuanTi() {
    //		location.href = '<?php echo U("line/list");?>';
    //	}



</script>

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
			<p class="zhutilvyou">
				主题旅游：
					<?php if(is_array($pcset_top_link)): $i = 0; $__LIST__ = $pcset_top_link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$set_val): $mod = ($i % 2 );++$i; if(!empty($bot_fk)): ?>&nbsp;|&nbsp;<?php endif; ?>
						<?php $bot_fk = json_decode($set_val['value'], true); ?>
						<a href="<?php echo ($bot_fk["url"]); ?>" target="_blank"><?php echo ($bot_fk["text"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
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