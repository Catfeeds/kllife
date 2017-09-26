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
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/source/Static/home/css/brand.css">
	<style>
		.nav-list-one a{
			color:#333;
			display: block;
		}
	</style>
</head>

<body>
<div class="brand">

	<!--content-->
	<div class="content" style="margin-top:127px;">
		<p class="crumbs"></p>
		<div class="brand-detail">
			<div class="nav-list-one">
				<a class="active" href="#brand" name="brand" id="brand"><div>品牌故事</div></a>
				<a href="#about_my" name="about_my" id="about_my"><div>关于我们</div></a>
				<a href="#develop" name="develop" id="develop"><div name="develop">发展历程</div></a>
				<a href="#contact_my" name="contact_my" id="contact_my"><div>联系我们</div></a>
			</div>
			<div class="index-eq">
				<div class="one">
					<img src="/source/Static/home/images/brand/brand01.jpg" alt="">
					<div class="title" style="width:900px;">
						<!--<img src="/source/Static/home/images/brand/brand-story.jpg" alt="">-->
						<h3>领袖户外，好玩不贵的小团慢旅行</h3>
						<div class="detail">
							<div class="left"><h4>好玩</h4></div>
							<div class="right">
								<p>你是否因为爱玩在小时候被各种对比各种批评？</p>
								<p>是否也总是被迫去学我们不喜欢的各种才艺？</p>
								<p>而唯一我们喜欢的“玩”却成为最不被认可的，必须要舍弃的？</p>
								<p>少年时光的缺憾有时候会成为一生的心心念念。</p>
								<p>我们就是这样一群被人称赞“会玩”的人，</p>
								<p>我们追求童年的梦想，好玩、爱玩、会玩，把玩做到极致，把玩当成事业，</p>
								<p>让更多人也能体会到这种快乐。</p>
							</div>
						</div>
						<div class="detail">
							<div class="left"><h4>慢旅行</h4></div>
							<div class="right">
								<p>人们都说，旅行就是一次人生，你希望有什么样的人生？</p>
								<p>闲庭漫步、悠长品味还是行色匆匆？</p>
								<p>平常劳碌的生活，但旅行为何不对自己好一点呢？</p>
								<p>拥有一段恰到好处的慢旅行，在风景中漫步、深呼吸，为不期而遇的惊艳停车，与晨曦和夕阳相伴，尽可</p>
								<p>能与美景相拥而眠 ……</p>
								<p>时间就应该浪费在美好的旅行中。</p>
								<p>因为我们相信一段美好的旅行就如同一次新生。</p>
								<p>正如美国诗人唐 · 赫罗尔德在 87 岁写的这首诗：</p>
								<p>《我会采更多的雏菊》</p>
								<p>如果我能够从头活过，</p>
								<p>我会试着犯更多的错。</p>
								<p>我会放松一点。</p>
								<p>我会灵活一点。</p>
								<p>我会比这一趟过得傻。</p>
								<p>很少有什么事能让我当真。</p>
								<p>我会疯狂一点。</p>
								<p>我会少讲究些卫生。</p>
								<p>我会冒更多的险。</p>
								<p>我会更经常地旅行。</p>
								<p>我会爬更多的山，游更多的河，看更多的日落。</p>
								<p>我会多吃冰激淋，少吃豆子。</p>
								<p>我会惹更多麻烦，可是不在想象中担忧。</p>
								<p>你看，我小心翼翼地稳健地理智地活着，</p>
								<p>一个又一个小时，一天又一天。</p>
								<p>噢，我有过难忘的时刻，如果我能够重来一次，</p>
								<p>我会要更多这样的时刻。</p>
								<p>事实上，我不需要别的什么。</p>
								<p>仅仅是时刻，一个接着一个，</p>
								<p>而不是每天都操心着往后的漫长日子。</p>
								<p>我曾经不论到哪里去都不忘记带上</p>
								<p>温度计，热水壶，漱口杯，雨衣和降落伞。</p>
								<p>如果我能够重来一次，我会到处走走，</p>
								<p>什么都试试，并且轻装上路。</p>
								<p>如果我能够从头活过，我会延长打赤脚的时光，</p>
								<p>从尽早的春天到尽晚的秋天。</p>
								<p>我会更经常地逃学。</p>
								<p>我不会考那么高的分数，除非是一不小心。</p>
								<p>我会多骑些旋转木马。</p>
								<p>我会采更多的雏菊。</p>
							</div>
						</div>
						<div class="detail">
							<div class="left"><h4>小团</h4></div>
							<div class="right">
								<p>坚持纯玩的慢旅行带来了前几年爆发式的增长。</p>
								<p>但2015年发现队员们的快乐变得比以前少了些，他们的那丝缺憾触动到了我们…</p>
								<p>叩问内心，除了追求利润外，什么才是我们想要的？</p>
								<p>我们义无反顾的投身到这里是为了什么？</p>
								<p>是不是更要重视体验和快乐？</p>
								<p>争论踌躇后回归初心是我们内部一致的答案。</p>
							</div>
						</div>
						<div class="detail">
							<div class="left"><h4>不贵</h4></div>
							<div class="right">
								<p>情怀和现实总那么矛盾，如何兼顾体验与性价？</p>
								<p>对自己负责、对用户珍视，领袖户外在甘南、新疆、额济纳、西藏、贵州、坝上草原通过近两年156</p>
								<p>批次的测试，确定28人以内的小团，平衡性价与体验，保障领队与队友们和谐互动。</p>
								<p>守护旅行本真体验，就是在守护我们自己的信仰。</p>
							</div>
						</div>
					</div>
				</div>
				<div class="one" style="display:none;">
					<img src="/source/Static/home/images/brand/brand02.jpg" alt="">
					<div class="title" style="width:630px;">
						<div class="detail width">
							<div>
								<p>2015年，在即将进入创业的12个年头，我也进入不惑之年，偶尔会冒出关于人生意义的思考，也对领袖户外有了深层的回顾与叩问。</p>
								<p>10余年里遭遇3次破产危机、2波爆发式发展，这一路太坎坷，庆幸我们还健康并在坚持；</p>
								<p>在不断的摸索中，通过我们设计的旅行产品服务过无数队员，这一路收获了太多的肯定与欣赏，他们不仅自己多次参加甚至义务帮我们宣传，这是我们最大的财富；</p>
								<p>期间也见识了人性的各种阴暗、算计与背叛，很自豪，因为我和我们的伙伴依然热爱生活，相信人性的美好，相比以往更愿意信任伙伴、愿意与他们一起成长。</p>
							</div>
							<div>
								<p>正如罗曼·罗兰所说：“世界上只有一种真正的英雄主义，就是认清了生活的真相后还依然热爱它。”我希望我们的伙伴更加热爱生活，勇敢地去体验人生的苦辣酸甜。</p>
								<p>在接下来的数十年里，我们不应该再像前十年那样活得不明不白，于是有了总结梳理共创领袖户外企业文化的想法。</p>
								<p>仰慕于苏东坡这位中国五千年来最懂生活的旅行家。不管是高居庙堂还是被贬流放，都能过着秉性难改的乐天派生活：品茶、酿酒、美食、爱“诗和远方”的旅行。</p>
								<p>也只有那样热爱生活、热爱生命的人，才真正懂得旅行意义，才能真正做好旅行产品，这是过程也必须是结果！</p>
							</div>
							<div>
								<img src="/source/Static/home/images/brand/team1.jpg" alt="">
							</div>
							<div>
								<p>于是——</p>
								<p>“享受旅行 品味人生”的愿景跃然而出。</p>
								<p>包含三个层面：</p>
								<p>> 享受生活：爱生活，享受人生的酸甜苦辣，有原则有信念，自尊也被人尊重。</p>
								<p>> 自我实现：爱玩会玩，以爱好为事业，为队员的衷心称赞而不断努力。</p>
								<p>> 合作共赢，“人”，一撇一捺，就应该相互支撑。团队内，合伙人、产品经理制度；团队外，产业上下游合作共赢。</p>
							</div>
							<div>
								<p>我们用了四个月持续的全员共创领袖户外的企业文化</p>
								<p>使命：为用户提供参与感强体验度高的旅行</p>
								<p>价值观：诚信自爱、开放融合、为爱工作、拥抱变化、专注高效、以人为本</p>
							</div>
							<div>
								<img src="/source/Static/home/images/brand/team2.jpg" alt="">
								<img style="margin-top:30px;" src="/source/Static/home/images/brand/team3.jpg" alt="">
							</div>
							<div>
								<p style="text-align: right;text-align: -webkit-right">——领袖户外创始人洗澡</p>
							</div>
						</div>
					</div>
				</div>
				<div class="one" style="display:none;">
					<img src="/source/Static/home/images/brand/brand02.jpg" alt="">
					<div class="year">
						<div class="left">
							<img src="/source/Static/home/images/brand/year.jpg" alt="">
						</div>
						<div class="right">
							<p style="margin-top:20px;">投身户外行业，驴友AA制，只为亲近自然；</p>
							<p style="margin-top:30px;">领袖户外前身西安快乐年票驴友俱乐部成立，承包旅行社部门开始正轨运作，第一年经验不足、商业模式不清晰，亏损近10万元，靠借钱维持；</p>
							<p style="margin-top:45px;">户外+旅行模式的探索让团队规模和业务量很快达西安第一，同时逐渐认识到在一个以个人魅力为基础的行业里合伙人方式是最佳的抱团取暖方式；</p>
							<p style="margin-top:45px;">汶川地震后第二天，合作域名被盗。一切又回归原点……对旅行执着的爱支撑着我们，自建网站，重头再来；</p>
							<p style="margin-top:45px;">通过3年的努力，公司业务重新回到正轨，第一波爆发式增长；</p>
							<p style="margin-top:45px;">领袖户外慢旅行理念在本地市场已经没有足够的市场容量，发展全国客源是必须的方向；</p>
							<p style="margin-top:55px;">经过前几年的爆炸式高速发展，我们在反思什么是我们想要的，我们给客户提供的最大价值在哪里？小团慢旅行产品开始内部测试；</p>
							<p style="margin-top:75px;">领袖户外杭州公司成立，提炼共创确定领袖户外企业文化；</p>
							<p style="margin-top:45px;">3月15日，创业第12年，回归初心，小团慢旅行正式上线；</p>
						</div>
					</div>
				</div>
				<div class="one" style="display: none;">
					<img src="/source/Static/home/images/brand/brand03.jpg" alt="">
					<div class="xian size">
						<p>旅游行业的产业链漫长而复杂，复杂的不是链条本身，而是从业者之间的碰撞与磨合。</p>
						<p>领袖户外，2005年纯粹以爱为起点投入旅游行业，并致力于深度旅行产品的研发和服务，经过12年的摸爬滚打发现，我们其实一直是“体验式旅行”理念的推动者。</p>
						<p>我们深知，深度旅行这个旅游行业垂直细分出的非标品，是“体验式旅行”理念的承载品。想要更加深入的发展深度旅行，必须以合作共赢的心态以及行为准则，团结认同“体验式旅行”理念的“户外旅游”从业者，从而在更加广阔的市场里真正推行和践行“体验式旅行”。</p>
						<p>一直以来，我们秉承开放融合、诚信自爱的价值观，与产业链条上下游以及同行保持着密切且双赢的合作。同时，我们也在不断扩大合作范围。</p>
					</div>
					<div class="xian margin-top size">
						<p>地接合作：</p>
						<p>您是愿为客户提供体验至上的旅行服务的目的地资源提供商。</p>
						<p>联系邮箱：505644981@qq.com</p>
					</div>
					<div class="xian margin-top size">
						<p>同行合作：</p>
						<p>您是客源地同行，我们在中性发团、诚信返利的基础上，还可进行流量分享的深度合作业务。</p>
						<p>联系邮箱：65246623@qq.com</p>
					</div>
					<div class="xian margin-top size">
						<p>网络技术合作：</p>
						<p>您有意使用我们独立开发的适用于旅游行业的网络技术。</p>
						<p>联系邮箱：chenwutao@188.com</p>
					</div>
					<div class="xian margin-top size" style="margin-bottom:70px;">
						<p>媒体垂询及合作：</p>
						<p>您是旅游行业媒体或者新媒体从业者，进行媒体垂询、公关传播或者其他合作等接洽事宜。</p>
						<p>联系邮箱：chenwutao@188.com</p>
					</div>
					<img src="/source/Static/home/images/brand/xian-address.jpg" alt="">
					<div class="xian">
						<p>总公司（西安）：</p>
						<p>陕西省西安市高新区上上国际3号楼19层11903室</p>
						<p>电话：400-080-5860</p>
						<p>传真：029-89526056</p>
						<h3>微信公众号</h3>
						<img class="img" src="/source/Static/home/images/brand/xian.jpg" alt="">
					</div>
					<!--<img src="/source/Static/home/images/brand/hangzhou-address.jpg" alt="">
					<div class="xian hangzhou">
						<p>分公司（杭州）：</p>
						<p>浙江省杭州市西湖区文三路553号浙江中小企业大厦2318</p>
						<p>电话：400-080-5860转3  0571-89839741</p>
						<p>传真：0571-89839742</p>
						<h3>杭州站微信公众号</h3>
						<img class="img" src="/source/Static/home/images/brand/hangzhou.jpg" alt="">
					</div>-->
				</div>
			</div>
		</div>
	</div>
</div>
</body>
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
</script>
<script>
    //头部点击选中状态
    $(".nav-list-one a").on("click",function(){
        var i = $(this).index();
//        alert(i);
        $(this).addClass("active").siblings("a").removeClass("active");
        $(".one").eq(i).show().siblings().hide();
    })
    $(document).ready(function(){
		$("title").html("领袖户外旅行网-好玩不贵的小团慢旅行");
    });

    //页面加载获取锚点id值   对有这个id的元素执行一次点击事件
    $(document).ready(function(){
        var thisId=window.location.hash;
        if(thisId != "" && thisId != undefined){
            $(thisId).trigger("click");
        }
	})
</script>
</html>

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