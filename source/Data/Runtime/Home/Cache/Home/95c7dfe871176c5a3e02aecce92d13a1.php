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
	<link rel="stylesheet" href="/source/Static/home/common/css/swiper.3.1.7.min.css">
	<!-- <link rel="stylesheet" href="/source/Static/home/common/css/datepicker.min.css"> -->
	<link rel="stylesheet" href="/source/Static/home/css/private_book.css">
	<style>
		
		#section { margin-top: 127px; }
		.nav-top a { font: 12px/1 微软雅黑, Tahoma, Helvetica, Arial, 宋体, sans-serif; }
		.tianxiexinxi input { font: 12px/1 微软雅黑, Tahoma, Helvetica, Arial, 宋体, sans-serif; }
		#aside { background: none; }
		.nav-top-right { font-size:12px; }
		.footer-content-left ul li,.footer-bottom{font-size:14px;}
	</style>
	
	
	<!-- 主体 -->
	<section id="section">
		<!-- 轮播 -->
		<div class="swiper-container">
	        <div class="swiper-wrapper">
	            <div class="swiper-slide"><img src="/source/Static/home/images/private_book/banner01.jpg" alt="轮播"></div>
	            <div class="swiper-slide"><img src="/source/Static/home/images/private_book/banner02.jpg" alt="轮播"></div>
	        </div>
	        <!-- 定位按钮 -->
	        <div class="swiper-pagination"></div>
	        <!-- 左右控制 -->
	        <div class="swiper-button-next"></div>
	        <div class="swiper-button-prev"></div>
	    </div>
	    <!-- 定制信息 -->
	    <div class="gerenxinxi">
	    	<div class="tianxiexinxi">
	    		<img src="/source/Static/home/images/private_book/dingzhi.png" alt="定制我的专属旅程">
	    		<p class="first-p">想玩的景点</p>
	    		<input type="text" class="jingdian" placeholder="请输入您想玩的景点 例如：婺源">
	    		<p>出行人数</p>
                <input type="number" class="renshu" placeholder="出行人数">
	    		<p>联系人</p>
	    		<input type="text" class="lianxiren" placeholder="您的称呼">
	    		<p>联系方式</p>
	    		<input type="text" class="lianxifangshi" placeholder="您的座机或手机号码">
	    		<p style="display: none; color: #e03905; font-size: 14px;">*请输入正确的联系方式</p>
	    		<a href="javascript:;" target="_parent" class="btn-warning xuqiu">您的需求</a>
	    	</div>
	    </div>
	    <div class="wenzixinxi">
	    	<h1>领袖户外定制游</h1>
	    	<h1>玩你想玩，玩的精彩</h1>
	    	<p>24h接机/站，1对1旅行顾问，金牌领队，全程跟拍</p>
	    	<p>我们拥有11年户外旅游经验及5年的中高端旅游运营经验，</p>
	    	<p>是旅游线路革新的标杆机构。</p>
	    </div>
	    <!-- 主体内容 -->
	    <div class="neirong">
	    	<div class="neirong01">
	    		<p><img src="/source/Static/home/images/private_book/big-wenzi01.png" alt=""></p>
	    		<img src="/source/Static/home/images/private_book/wenzi01.png" alt="超乎想象的精彩旅行">
	    		<p>旅游像赶集，游览像赶鸭，老人小孩跟不上趟？</p>
	    		<p>时间不自由，行程不随心，还有各种旅游陷阱隐形消费？</p>
	    		<p>攻略查到吐，临时开销大，旅途聊无趣味还附赠各种冤枉钱？</p>
	    		<p>放心，你所担心的我们都懂！</p>
	    		<a class="mytrip dingzhiall" href="javascript:void(0);" target="_parent">定制我的旅行</a>
	    	</div>
	    	<div class="neirong02">
	    		<div class="neirong02-left">
	    			<a href="javascript:;">
	    				<img src="/source/Static/home/images/private_book/xizang.jpg" alt="西藏">
	    				<img src="/source/Static/home/images/private_book/xizangwenzi.png" class="xizangwenzi" alt="西藏">
	    			</a>
	    		</div>
	    		<div class="neirong02-right">
	    			<div class="neirong02-right-top">
	    				<a href="javascript:;">
	    					<img src="/source/Static/home/images/private_book/yunnan.jpg" alt="云南">
	    					<img class="yunnanwenzi" <img src="/source/Static/home/images/private_book/yunnanwenzi.png" alt="云南">
	    				</a>
	    				<a href="javascript:;">
		    				<img class="xinjiang" <img src="/source/Static/home/images/private_book/xinjiang.jpg" alt="新疆">
		    				<img class="xinjiangwenzi" <img src="/source/Static/home/images/private_book/xinjiangwenzi.png" alt="新疆">
		    			</a>
	    			</div>
	    			<div class="neirong02-right-bottom">
	    				<a href="javascript:;">
		    				<img src="/source/Static/home/images/private_book/sichuan.jpg" alt="四川">
		    				<img class="sichuanwenzi" <img src="/source/Static/home/images/private_book/sichuanwenzi.png" alt="四川">
		    			</a>
	    			</div>
	    		</div>
	    	</div>
	    </div>
	    <div class="neirong-bottom">
	    	<div class="neirong-bottom01">
	    		<img src="/source/Static/home/images/private_book/banner_bottom.jpg" alt="">
	    		<div class="neirong-bottom-main">
	    			<p><img src="/source/Static/home/images/private_book/big-wenzi02.png" alt=""></p>
		    		<img src="/source/Static/home/images/private_book/wenzi02.png" alt="你想要的旅行其实无比简单">
		    		<p>一旦开始定制，你就相当于拥有了一群专业旅行策划服务团队。</p>
		    		<p>我们的旅行顾问和线路规划师将完全按照你的想法、兴趣以及需求，为您设计专属旅行线路。</p>
		    		<p>价格透明，无隐形消费，你想要的我们都能满足！</p>
	    		</div>
	    		<a class="mytrip mytrip01 dingzhiall" href="javascript:void(0);" target="_parent">定制我的旅行</a>
	    	</div>
	    	<div class="neirong-bottom02">
	    		<p><img src="/source/Static/home/images/private_book/big-wenzi03.png" alt=""></p>
	    		<img src="/source/Static/home/images/private_book/wenzi03.png" alt="给您一次无与伦比的精彩旅行">
	    		<ul>
	    			<li>
	    				<img src="/source/Static/home/images/private_book/1bu.png" alt="">
	    				<h1>1.[提交需求]</h1>
	    				<p>收到您提交的定制需求后，</p>
	    				<p>领袖户外的旅行顾问将主动与您联系，</p>
	    				<p>就我们需要了解的问题与您进一步沟通。</p>
	    			</li>
	    			<li>
	    				<img src="/source/Static/home/images/private_book/2bu.png" alt="">
	    				<h1>2 .[设计方案]</h1>
	    				<p>我们将根据需求，为您量身定</p>
	    				<p>制旅行方案和报价，对于部分复杂</p>
	    				<p>需求，报价将在旅行方案确认后提供。</p>
	    			</li>
	    			<li>
	    				<img src="/source/Static/home/images/private_book/3bu.png" alt="">
	    				<h1>3. [确认预订]</h1>
	    				<p>旅行方案和报价确认后，</p>
	    				<p>我们将为您预留旅行资源库存，</p>
	    				<p>并与您签署旅游合同，收取旅行费用。</p>
	    			</li>
	    			<li>
	    				<img src="/source/Static/home/images/private_book/4bu.png" alt="">
	    				<h1>4. [尊贵出行]</h1>
						<p>领袖户外的专业团队将全程为</p>
						<p>您提供全方位服务，您只管享受精</p>
						<p>彩旅程，剩下的麻烦事儿都交给我们。</p>
	    			</li>
	    		</ul>
	    	</div>
	    	<div class="neirong-bottom03">
	    		<img src="/source/Static/home/images/private_book/wenzi04.png" alt="">
	    		<h1>领袖户外定制游</h1>
	    		<p>世界这么大，只要你告诉我想去哪，剩下的都交给我们！</p>
	    		<a class="mytrip dingzhiall" href="javascript:void(0);" target="_parent">定制我的旅行</a>
	    	</div>
	    </div>
	</section>

	<!-- 侧边栏 -->
	<aside id="aside">
		<div class="aside-phone">
			<img src="/source/Static/home/images/private_book/phone.svg" alt="电话">
			<div class="aside-show aside-phone-show">
				400-080-5860
				<div class="arrow-right"></div>
			</div>
		</div>
		<div class="aside-weixin">
			<img src="/source/Static/home/images/private_book/weixin.svg" alt="微信">
			<div class="aside-show aside-weixin-show">
				<img style="width: 92px; height: 92px;" <img src="/source/Static/home/images/private_book/erweima.jpg" alt="二维码">
				<div class="arrow-right"></div>
			</div>
		</div>
		<div class="aside-up">
			<img src="/source/Static/home/images/private_book/up.svg" alt="回到顶部">
		</div>
	</aside>

	<!-- 遮罩层 -->
	<div class="mark"></div>
	<!-- Modal small-->
	<div class="modal-small">
		<div class="my-small-modal">
			<img src="/source/Static/home/images/private_book/smallmodal.png" alt="模态框图">
			<img class="small-close" <img src="/source/Static/home/images/private_book/close.svg" alt="关闭模态框">
			<div class="small-ziliao">
				<img src="/source/Static/home/images/private_book/smallmodal01.png" alt="模态框图">
				<div class="small-tianxie">
					<i>*</i><span>想玩的景点</span><input type="text" class="small-jingdian" placeholder="请输入您想玩的景点，例如：婺源"><br>
					<i>*</i><span>出 行 人 数</span><input type="number" class="small-renshu" placeholder="1"><br>
					<i>*</i><span>联 系 人</span><input type="text" class="small-lianxiren" placeholder="请输入您的姓名"><br>
					<i>*</i><span>联 系 方 式</span><input type="text" class="small-lianxifangshi" placeholder="请输入您的座机或手机号码">
					<p style="display: none; color: #e03905; font-size: 14px; margin-bottom: -15px;">*请输入正确的联系方式</p>
				</div>
				<a href="javascript:;" class="btn-warning small-dingzhi" target="_parent">立即定制</a>
			</div>
		</div>
	</div>
	<!-- Modal large -->
	<div class="modal-large">
		<div class="modal-large-left">
			<img class="large-close" <img src="/source/Static/home/images/private_book/close.svg" alt="关闭模态框">
			<h2>其他需求</h2>
			<div class="modal-large-left-container">
				<i>*</i><span>出 行 日 期</span><input type="text" class="large-riqi"><br>
				<i>*</i><span>游 玩 天 数</span><input type="text" class="large-tianshu" placeholder="游玩天数"><br>
				<i class="bai">*</i><span>住 宿 条 件</span><select class="large-zhusu">
					<?php if(is_array($hotel_request)): $i = 0; $__LIST__ = $hotel_request;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hr): $mod = ($i % 2 );++$i;?><option value="<?php echo ($hr["id"]); ?>"><?php echo ($hr["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select><br>
				<i class="bai">*</i><span>领 队 需 求</span><select class="large-lingdui">
					<?php if(is_array($leader_request)): $i = 0; $__LIST__ = $leader_request;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lr): $mod = ($i % 2 );++$i;?><option value="<?php echo ($lr["id"]); ?>"><?php echo ($lr["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select><br>
				<!-- <i class="bai">*</i><span>车 辆 需 求</span><select class="large-cheliang">
				</select><br> -->
				<i class="bai">*</i><span>特 色 服 务</span><select class="large-tese">
					<?php if(is_array($especial_request)): $i = 0; $__LIST__ = $especial_request;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$er): $mod = ($i % 2 );++$i;?><option value="<?php echo ($er["id"]); ?>"><?php echo ($er["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select><br>
				<i>*</i><span>联 系 时 间</span><select class="large-shijian">
					<?php if(is_array($contact_time)): $i = 0; $__LIST__ = $contact_time;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ct): $mod = ($i % 2 );++$i;?><option value="<?php echo ($ct["id"]); ?>"><?php echo ($ct["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select><br>
				<i class="bai">*</i><span>其它联系方式</span><input type="text" class="large-lianxifangshi" placeholder="QQ/微信/邮箱"><br>
				<i class="bai">*</i><span class="special">其它需求/特别说明</span><br>
				<textarea name="" id="special" class="large-more" placeholder="其他需要帮助安排的事宜"></textarea>
			</div>
			<a class="chongtian" href="javascript:void(0);">重新填写订单</a>
			<a class="tijiao" href="javascript:void(0);" target="_parent">提交完整需求</a>
			<p style="display: none; color: #e03905; font-size: 14px; margin-bottom: -10px; margin-left: 45px;">* 请将您的信息填写完整</p>
		</div>
		<div class="modal-large-right">
			<h2>我的需求单</h2>
			<span>想玩的景点</span><p class="large-right-jingdian"></p><br>
			<span>出行人数</span><p class="large-right-renshu"></p><br>
			<span>联系人</span><p class="large-right-lianxiren"></p><br>
			<span>联系方式</span><p class="large-right-lianxifangshi"></p><br>
			<span>出行日期</span><p class="large-right-riqi"></p><br>
			<span>游玩天数</span><p class="large-right-tianshu"></p><br>
			<span>住宿条件</span><p class="large-right-zhusu"></p><br>
			<span>领队需求</span><p class="large-right-lingdui"></p><br>
			<!-- <span>车辆需求</span><p class="large-right-cheliang"></p><br> -->
			<span>特色服务</span><p class="large-right-tese"></p><br>
			<span>联系时间</span><p class="large-right-shijian"></p><br>
			<span>其它联系方式</span><p class="large-right-qitalianxifangshi"></p><br>
			<span>其他需求</span><textarea name="" id="" class="large-right-more" rows="5"></textarea>
		</div>
	</div>
	<!-- 提交成功 -->
	<div class="success">
		<img class="success-close" <img src="/source/Static/home/images/private_book/close.svg" alt="关闭模态框">
		<h2>提交成功</h2>
		<img src="/source/Static/home/images/private_book/icon_success.png" alt="提交成功">
		<p>领袖的旅行顾问将尽快与您取得联系,</p>
		<p>您也可直接拨打 400-080-5860 查询预订进展</p>
	</div>


	<script src="/source/Static/home/common/js/swiper.3.1.7.jquery.min.js"></script>
	<!-- <script src="/source/Static/home/common/js/datepicker.min.js"></script> -->
	<!-- <script src="/source/Static/home/common/js/datepicker.en.js"></script> -->
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
		//轮播
	    var swiper = new Swiper('.swiper-container', {
	        pagination: '.swiper-pagination',
	        nextButton: '.swiper-button-next',
	        prevButton: '.swiper-button-prev',
	        paginationClickable: true,
	        spaceBetween: 0,
	        centeredSlides: true,
	        autoplay: 3000,
	        autoplayDisableOnInteraction: false
	    });
    </script>
    <script>
    	// 图片渐显
    	function showAndHide (e){
    		e.hover(function(){
    			$(this).children('img:eq(1)').fadeIn(1000);
    		},
    		function(){
    			$(this).children('img:eq(1)').fadeOut(1000);
    		});
    	}
    	showAndHide($('.neirong02-left a'));
    	showAndHide($('.neirong02-right-top a:eq(0)'));
    	showAndHide($('.neirong02-right-top a:eq(1)'));
    	showAndHide($('.neirong02-right-bottom a'));

    	//提交成功 关闭
    	$('.success-close').click(function(){
    		$('.success').fadeOut(1000);
    		$('.mark').fadeOut(1000);
    	});

    	//二维码和电话显示
    	$('.aside-phone').hover(function(){
    		$(this).children('.aside-show').show();
    	},function(){
    		$(this).children('.aside-show').hide();
    	});
    	$('.aside-weixin').hover(function(){
    		$(this).children('.aside-show').show();
    	},function(){
    		$(this).children('.aside-show').hide();
    	});

    	//回到顶部
    	function upShow(){
    		$(window).scroll(function(){
				if ($(window).scrollTop()>300){
					$(".aside-up").fadeIn(500);
				}else{
					$(".aside-up").fadeOut(500);
				}
			});
    	}
    	upShow();
    	$('.aside-up').click(function(){
    		var speed=200;//滑动的速度
        	$('body,html').animate({ scrollTop: 0 }, speed);
        	return false;
    	});
    </script>
    <script>
    	var isMobile = /^(?:13\d|15\d|18\d|17\d|14\d)\d{5}(\d{3}|\*{3})$/; //手机号码验证规则
        var isPhone = /^((0\d{2,3})-)?(\d{8})(-(\d{3,}))?$/;   //座机验证规则
		$(".lianxifangshi").on("blur", function () {
			var dianhua = $.trim($(".lianxifangshi").val());
			if (!isMobile.test(dianhua) && !isPhone.test(dianhua)) { //如果用户输入的值不同时满足手机号和座机号的正则
				$(this).next("p").show();
			} else {
				$(this).next("p").hide();
			}
		});
		$(".small-lianxifangshi").on("blur", function () {
			var dianhua = $.trim($(".small-lianxifangshi").val());
			if (!isMobile.test(dianhua) && !isPhone.test(dianhua)) { //如果用户输入的值不同时满足手机号和座机号的正则
				$(this).next("p").show();
				return false;
			} else {
				$(this).next("p").hide();
			}
		});


    	//打开按钮
    	$('.dingzhiall').click(function(){
    		$('.my-small-modal').animate({top: '50%'},1000);
    		$('.mark').fadeIn('fast');
    	});
    	//关闭按钮
    	$('.small-close').click(function(){
    		$('.my-small-modal').animate({top: '-300%'},1000);
    		$('.my-small-modal input').val('');
    		$('.mark').fadeOut(1000);
    		$('.small-dingzhi').next('span').remove();
    		$('.small-lianxifangshi').next('p').remove();
    	});
    	$('.large-close').click(function(){
    		$('.modal-large').animate({top: '-300%'},1000);
    		$('.mark').fadeOut(1000);
    		clearAllData();
    		$('.tijiao').next('p').hide();
    	});

    	// 模态框
    		//通过nav打开大模态框
    		$(function(){
    			$('.small-dingzhi').click(function(){
	    			var dianhua01 = $.trim($(".small-lianxifangshi").val());
	    			if( $.trim($('.small-jingdian').val()) == '' || $.trim($('.small-renshu').val()) == '' || $.trim($('.small-renshu').val()) < 1 || $.trim($('.small-lianxiren').val()) =='' || $.trim($('.small-lianxifangshi').val()) == '' && (!isMobile.test(dianhua01) || !isPhone.test(dianhua01)) ){
	    				$('.small-dingzhi').next('span').remove();
	    				$('.small-dingzhi').after('<span style="color:#e03905;">*请填写完整的正确信息</span>');
	    				return false;
	    			}
	    			var ds = {
	    				destination: $('.small-jingdian').val(),
	    				member_count: $('.small-renshu').val(),
	    				linkman: $('.small-lianxiren').val(),
	    				tel: $('.small-lianxifangshi').val(),
	    			}
	    			commitData(ds, 'small-');
//					$('.small-tianxie').next('span').remove();
//					$('.my-small-modal').animate({top: '-300%'},1000);
//					$('.modal-large').animate({top: '50%'},1000);
//					$('.large-right-jingdian').html($('.small-jingdian').val());	//景点名称
//					$('.large-right-renshu').html($('.small-renshu').val());	//人数
//					$('.large-right-lianxiren').html($('.small-lianxiren').val());	//联系人
//					$('.large-right-lianxifangshi').html($('.small-lianxifangshi').val());	//联系方式
//					$('.my-small-modal input').val('');
	    		});
    		})
    		
    		//通过需求打开大模态框
    		$('.xuqiu').click(function(){
    			var dianhua02 = $.trim($(".lianxifangshi").val());
				//判断如果填的值为空
				if ($.trim($('.jingdian').val()) == '' || $.trim($('.lianxiren').val()) == '' || $.trim($('.renshu').val()) == '' || $.trim($('.renshu').val()) < 1 || $.trim($('.lianxifangshi').val()) == '' || (!isMobile.test(dianhua02) && !isPhone.test(dianhua02)) ) {
    				$('.xuqiu').next('span').remove();
    				$('.xuqiu').after('<span class="error" style="color:#e03905;">*请将信息填写完整</span>');
    				return false;
    			} else {
//    				$('.xuqiu').next('span').remove();
//    				$('.mark').fadeIn('fast');
//    				$('.modal-large').animate({top: '50%'},1000);
//    				$('.large-right-jingdian').html($('.jingdian').val());	//景点名称
//    				$('.large-right-renshu').html($('.renshu').val());	//人数
//    				$('.large-right-lianxiren').html($('.lianxiren').val());	//联系人
//    				$('.large-right-lianxifangshi').html($('.lianxifangshi').val());	//联系方式
	    			var ds = {
	    				destination: $('.jingdian').val(),
	    				member_count: $('.renshu').val(),
	    				linkman: $('.lianxiren').val(),
	    				tel: $('.lianxifangshi').val(),
	    			}
	    			commitData(ds, '');
    			}

    		});

    	//数据变更
    	$(function(){
    		function changeDate(a,b){
    			a.blur(function(){
    				b.html($(this).val());
    			});
    		};
    		function change(c,d){
    			c.change(function(){
    				d.html($(this).val());
    			});
    		};
    		function changeData(e,f){
    			e.keyup(function(){
    				f.html($(this).val());
    			});
    		};
    		function changeval(g,h){
    			g.change(function(){
    				h.html($(this).find("option:selected").text());
    			});
    		}
    		changeDate($('.large-riqi'),$('.large-right-riqi'));	//日期
    		change($('.large-tianshu'),$('.large-right-tianshu'));  //游玩天数
    		changeval($('.large-zhusu'),$('.large-right-zhusu'));		//住宿条件
    		changeval($('.large-lingdui'),$('.large-right-lingdui'));	//领队需求
    		changeval($('.large-shijian'),$('.large-right-shijian'));	//联系时间
    		// changeval($('.large-cheliang'),$('.large-right-cheliang'));
    		changeval($('.large-tese'),$('.large-right-tese'));
    		changeData($('.large-lianxifangshi'),$('.large-right-qitalianxifangshi'));	//其它联系方式
    		changeData($('.large-more'),$('.large-right-more'));	//其它需求
    	})

    	//大模态框数据重置
    	function clearAllData(){
    		$('.large-riqi').val('');
    		$('.large-tianshu').val('');
    		$('.large-lianxifangshi').val('');
    		$('.large-more').val('');
    		$('.large-right-riqi').html('');
    		$('.large-right-tianshu').html('');
    		$('.large-right-zhusu').html('');
    		$('.large-right-lingdui').html('');
    		// $('.large-right-cheliang').html('');
    		$('.large-right-tese').html('');
    		$('.large-right-shijian').html('');
    		$('.large-right-qitalianxifangshi').html('');
    		$('.large-right-more').html('');
    	};
    	//重置数据
    	$('.chongtian').click(function(){
    		clearAllData();
    		$('.tijiao').next('p').hide();
    	});
    	//提交数据
    	$('.tijiao').click(function(){
    		var jingdian = $('.large-right-jingdian').html(),
    			renshu = $('.large-right-renshu').html(),
    			lianxiren = $('.large-right-lianxiren').html(),
    			lianxifangshi = $('.large-right-lianxifangshi').html(),
    			riqi = $('.large-right-riqi').html(),
    			tianshu = $('.large-right-tianshu').html(),
    			zhusu = $('.large-zhusu').val(),
    			lingdui = $('.large-lingdui').val(),
    			cheliang = $('.large-cheliang').val(),
    			tese = $('.large-tese').val(),
    			shijian = $('.large-shijian').val(),
    			qitalianxifangshi = $('.large-right-qitalianxifangshi').html(),
    			more = $.trim($('.large-right-more').html());
			//如果不填游玩日期和游玩天数
    		if ( riqi == '' || tianshu == ''){
    			$(this).next('p').show();
    			return false;
    		} else {
    			$(this).next('p').hide();
	    		var jsonData = {
	    			destination : jingdian,
	    			member_count : renshu,
	    			linkman : lianxiren,
	    			tel : lianxifangshi,
	    			car_request : cheliang,
	    			especial_request : tese,
	    			start_date : riqi,
	    			days : tianshu,
	    			hotel_request : zhusu,
	    			leader_request : lingdui,
	    			contact_time : shijian,
	    			other_contact : qitalianxifangshi,
	    			other_request : more,
	    			from_id: "client" 
	    		};

    		}
    		$.ajax({
				url: "<?php echo U('line/book');?>",
	            type: "post",
	            dataType: 'json',
	            data: jsonData,
	            success: function (data) {
	            	if (data.result.errno == 0){
						//提交成功
						$('.success').fadeIn(1000);
						$('.modal-large').animate({top: '-300%'},1000); //隐去
						clearAllData(); //清除数据
					}else {
						alert(data.result.message);
					}
	            }

    		});
    	})
    	
    	function commitData(ds, prefix) {
    		ds['from_id'] = 'client';
    		$.ajax({
				url: "<?php echo U('line/book');?>",
	            type: "post",
	            dataType: 'json',
	            data: ds,
	            success: function (data) {
	            	if (data.result.errno == 0){
						//提交成功
						$('.success').fadeIn(1000);
	    				$('.'+prefix+'jingdian').val('');
	    				$('.'+prefix+'renshu').val('');
	    				$('.'+prefix+'lianxiren').val('');
	    				$('.'+prefix+'lianxifangshi').val('');
					}else {
						alert(data.result.message);
					}
	            }

    		});
    	}
    </script>

    <script>
	var _hmt = _hmt || [];
	(function() {
	  var hm = document.createElement("script");
	  hm.src = "//hm.baidu.com/hm.js?a6f69a2a062b07c67a4ae301e0963ca8";
	  var s = document.getElementsByTagName("script")[0]; 
	  s.parentNode.insertBefore(hm, s);
	})();
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