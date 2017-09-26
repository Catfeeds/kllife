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
<link rel="stylesheet" href="/source/Static/home/css/index.css">
<link rel="stylesheet" href="/source/Static/home/css/subject.css">
<style css="text/css">	
	.hot-sale-product a .hot-sale-img { position: absolute; top: 85px; left: 0; width: 100%; height: 31px; text-align: center; font-size: 24px; text-decoration: none; text-shadow: 1px 1px 1px #000; }
	.hot-sale-product .hot-sale-big .hot-sale-img { width: 287px; top: 200px; left: 136px; }
	.main-two > ul{position:initial;width:100%;display: block}
	.main-two > ul li a{font-size:26px;padding-bottom:0px;}
	.clear-margin{margin:0 !important;}
	.clear-margin{margin-top:20px !important;}
	#xiaotuanman-none{
		background-image: url(/source/Static/home/images/index_img/xiaotuanman2.png);
		background-repeat: no-repeat;
		background-position: center center;
		height:180px;
	}
	#content .zt-main>div{font-size: 16px;color:#666;line-height:25px;}
</style>
<!--主要内容-->
	
<div class="zt-top">
	<img src="<?php echo ($subject["banner"]); ?>" />
</div>
<div id="content">
	<div class="zt-main" data-id="<?php echo ($subject["id"]); ?>">
		<h3><?php echo ($subject["recommend_subject_title"]["text"]); ?></h3>

		<p class="zt-slogan"><?php echo ($subject["recommend_subject_subheading"]["text"]); ?></p>

		<ul>

			<?php $__FOR_START_1071537035__=0;$__FOR_END_1071537035__=4;for($i=$__FOR_START_1071537035__;$i < $__FOR_END_1071537035__;$i+=1){ $idx=0; $liClass = $i % 4 == 0 ? 'clear-margin' : ''; $rcm_sub = $subject['recomment_subject'.$i]; if (empty($rcm_sub['url'])){ continue; } ?>
				<?php if($idx == 0): ?><li class="clear-margin" style="margin:0!important;">
				<?php else: ?>
				<li><?php endif; ?>

					<a href="<?php echo ($rcm_sub["url"]); ?>">

						<img src="<?php echo ($rcm_sub["bk_image"]); ?>" alt="">

						<div class="zt-content">

							<div class="zt-img">

								<img src="<?php echo ($rcm_sub["word_image"]); ?>" alt="">
							</div>

							<div class="zt-text">

		                        <div class="zt-text-introduce">

		                            <p class="zt-text-title"><?php echo ($rcm_sub["title"]); ?></p>

		                            <p><?php echo ($rcm_sub["desc"]); ?></p>

		                        </div>

		                    </div>

						</div>

					</a>

				</li><?php } ?>

		</ul>
	</div>

	<div class="zt-list main main-two">
		<div>
			<ul class="tab-list"> <!--tab样式用<?php echo ($subject["tab_line_style"]["text"]); ?>-->

				<?php if(is_array($subject["line_tab"])): $i = 0; $__LIST__ = $subject["line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i;?><li>
						<?php if($key == 0): ?><a href="javascript:;" class="g" data-id="<?php echo ($tab["id"]); ?>" data-key="<?php echo ($tab["type_key"]); ?>"><?php echo ($tab["type_desc"]); ?></a>
							<?php else: ?>
							<a href="javascript:;" data-id="<?php echo ($tab["id"]); ?>" data-key="<?php echo ($tab["type_key"]); ?>"><?php echo ($tab["type_desc"]); ?></a><?php endif; ?>
						<span>X</span>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>

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

		<div class="zt-sublist" id="zt-tuijian">
			<?php if(is_array($subject["show_tab_line_data"])): $i = 0; $__LIST__ = $subject["show_tab_line_data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$line): $mod = ($i % 2 );++$i;?><div class="zt-sublist-content" data-id="<?php echo ($line["id"]); ?>">											<a class="zt-href" href="<?php echo U('line/info');?>/id/<?php echo ($line["id"]); ?>" target="_blank"></a>
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
								<u class="theme-travel">
									<?php $theme = $line['theme_type_list'][0]; ?>
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

	<!--精彩游记-->

	<div class="wonderful-travels">

		<h3>精彩游记</h3>

		<ul>

			<?php $__FOR_START_2101166363__=0;$__FOR_END_2101166363__=20;for($i=$__FOR_START_2101166363__;$i < $__FOR_END_2101166363__;$i+=1){ if(empty($subject['youji'.$i]) == false): $youji = $subject['youji'.$i]; if (empty($youji['url'])) { continue; } ?>
					<li>
						<a href="<?php echo ($youji["url"]); ?>" target="_blank">
							<img src="<?php echo ($youji["img"]); ?>"/>
							<!--<div class="wonderful-describe">-->
								<!--<p align="center"><?php echo ($youji["desc"]); ?></p>-->
							<!--</div>-->
							<div style="background: #f4f4f4;">
								<p><?php echo ($youji["desc"]); ?></p>
							</div>
						</a>
					</li><?php endif; } ?>

		</ul>

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
					<!--<?php $k = 'hot_line.$i'; ?>-->
					<a class="hot_line_recommend" href="<?php echo U('line/info');?>/id/<?php echo ($subject['hot_line_recommend0']['id']); ?>" data-index="0" data-set="hot_line_recommend0">
						<img src="<?php echo ($subject['hot_line_recommend0']['img1']); ?>" alt="">
						<!--<img class="hot-sale-img" src="/source/Static/home/brand/index_img/hot01_01.png" alt="">-->
						<u class="hot-sale-img"><?php echo ($subject['hot_line_recommend0']['title']); ?></u>
						<div class="aaa" data-id="<?php echo ($subject['hot_line_recommend0']['id']); ?>">
							<h4><?php echo ($subject['hot_line_recommend0']['title']); ?></h4>
							<span><?php echo ($subject['hot_line_recommend0']['send_word_show']); ?></span>								
							<p>
								<?php if(empty($subject['hot_line_recommend0']['check_price'])): ?>核算中
								<?php else: ?>
									￥<em><?php echo ($subject['hot_line_recommend0']['start_price_adult']); ?></em>元起<?php endif; ?>
							</p>
							<strong>查看详情></strong>
						</div>
					</a>
					<a class="hot_line_recommend" href="<?php echo U('line/info');?>/id/<?php echo ($subject['hot_line_recommend1']['id']); ?>" data-index="1" data-set="hot_line_recommend1">
						<img src="<?php echo ($subject['hot_line_recommend1']['img1']); ?>" alt="">
						<!--<img class="hot-sale-img" src="/source/Static/home/brand/index_img/special01_01.png" alt="">-->
						<u class="hot-sale-img"><?php echo ($subject['hot_line_recommend1']['title']); ?></u>
						<div data-id="<?php echo ($subject['hot_line_recommend1']['id']); ?>">
							<h4><?php echo ($subject['hot_line_recommend1']['title']); ?></h4>
							<span><?php echo ($subject['hot_line_recommend1']['send_word_show']); ?></span>
							<p>
								<?php if(empty($subject['hot_line_recommend1']['check_price'])): ?>核算中
								<?php else: ?>
									￥<em><?php echo ($subject['hot_line_recommend1']['start_price_adult']); ?></em>元起<?php endif; ?>
							</p>
							<strong>查看详情></strong>
						</div>
					</a>
				</div>
				<a href="<?php echo U('line/info');?>/id/<?php echo ($subject['hot_line_recommend2']['id']); ?>" class="hot-sale-big hot_line_recommend" data-index="2" data-set="hot_line_recommend2">
					<img src="<?php echo ($subject['hot_line_recommend2']['img1']); ?>" alt="">
					<!--<img class="hot-sale-img" src="/source/Static/home/brand/index_img/special01_01.png" alt="">-->
					<u class="hot-sale-img"><?php echo ($subject['hot_line_recommend2']['title']); ?></u>
					<div data-id="<?php echo ($subject['hot_line_recommend2']['id']); ?>">
						<h4><?php echo ($subject['hot_line_recommend2']['title']); ?></h4>
						<span><?php echo ($subject['hot_line_recommend2']['send_word_show']); ?></span>
						<p>
							<?php if(empty($subject['hot_line_recommend2']['check_price'])): ?>核算中
							<?php else: ?>
								￥<em><?php echo ($subject['hot_line_recommend2']['start_price_adult']); ?></em>元起<?php endif; ?>
						</p>
						<strong>查看详情></strong>
					</div>
				</a>
				<div class="hot-sale-product-small">
					<a class="hot_line_recommend" href="<?php echo U('line/info');?>/id/<?php echo ($subject['hot_line_recommend3']['id']); ?>" data-index="3" data-set="hot_line_recommend3">
						<img src="<?php echo ($subject['hot_line_recommend3']['img1']); ?>" alt="">
						<!--<img class="hot-sale-img" src="/source/Static/home/brand/index_img/hot01_01.png" alt="">-->
						<u class="hot-sale-img"><?php echo ($subject['hot_line_recommend3']['title']); ?></u>
						<div data-id="<?php echo ($subject['hot_line_recommend3']['id']); ?>">
							<h4><?php echo ($subject['hot_line_recommend3']['title']); ?></h4>
							<span><?php echo ($subject['hot_line_recommend3']['send_word_show']); ?></span>
							<p>
								<?php if(empty($subject['hot_line_recommend3']['check_price'])): ?>核算中
								<?php else: ?>
									￥<em><?php echo ($subject['hot_line_recommend3']['start_price_adult']); ?></em>元起<?php endif; ?>
							</p>
							<strong>查看详情></strong>
						</div>
					</a>
					<a class="hot_line_recommend" href="<?php echo U('line/info');?>/id/<?php echo ($subject['hot_line_recommend4']['id']); ?>" data-index="4" data-set="hot_line_recommend4">
						<img src="<?php echo ($subject['hot_line_recommend4']['img1']); ?>" alt="">
						<!--<img class="hot-sale-img" src="/source/Static/home/brand/index_img/hot02_01.png" alt="">-->
						<u class="hot-sale-img"><?php echo ($subject['hot_line_recommend4']['title']); ?></u>
						<div data-id="<?php echo ($subject['hot_line_recommend4']['id']); ?>">
							<h4><?php echo ($subject['hot_line_recommend4']['title']); ?></h4>
							<span><?php echo ($subject['hot_line_recommend4']['send_word_show']); ?></span>
							<p>
								<?php if(empty($subject['hot_line_recommend4']['check_price'])): ?>核算中
								<?php else: ?>
									￥<em><?php echo ($subject['hot_line_recommend4']['start_price_adult']); ?></em>元起<?php endif; ?>
							</p>
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
					
					<?php $__FOR_START_245315300__=0;$__FOR_END_245315300__=12;for($k=$__FOR_START_245315300__;$k < $__FOR_END_245315300__;$k+=1){ $zt = $set_subjects['zhuanti'.$k]; if (empty($zt['url'])) { continue; } ?>
						
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
<!-- 视频 -->
<div class="bg-white">
	<div class="main video">
		<h2>视频中心<span style="font-size: 14px;color:#f00;padding-left:10px;">随时随地为您直播新鲜旅途！</span></h2>
		<p><a href="<?php echo U('line/video');?>" target="_blank">更多</a></p>
		<div class="video-product">
			<ul>
				
			</ul>
		</div>
	</div>
</div>

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
<div class="Popup" style="background: rgba(0,0,0,0.5);width:100%;height:100%;position: fixed;top:0px;left:0px;z-index:1000;display:none;">
	<div style="text-align: center;text-align: -webkit-center;margin-top:12%;">
        <span style="position: relative;display: inline-block;cursor: pointer;">
            <img src="/source/Static/home/images/subject/ejina.jpg" alt="">
            <img style="position: absolute;top:10px;right:10px;" src="/source/Static/home/images/index_img/xiaotuanmannone.png" alt="">
        </span>
	</div>
</div>
<!--贵州弹框-->
<div class="GPopup" style="background: rgba(0,0,0,0.5);width:100%;height:100%;position: fixed;top:0px;left:0px;z-index:1000;display:none;">
	<div style="text-align: center;text-align: -webkit-center;margin-top:12%;">
        <span style="position: relative;display: inline-block;cursor: pointer;">
            <img src="/source/Static/home/images/subject/guizhou.jpg" alt="">
            <img style="position: absolute;top:10px;right:10px;" src="/source/Static/home/images/index_img/guizhounone.png" alt="">
        </span>
	</div>
</div>

<!--好玩不贵小团慢旅行-->
<div id="xiaotuanmanblock" style="position: fixed;bottom:15px;width:174px;cursor: pointer;z-index:100;z-index:1001"><img src="/source/Static/home/images/index_img/xiaotuanman1.png" alt=""></div>
<a href="http://www.kllife.com/home/index.php?s=/home/subject/brand" target="_blank"><div id="xiaotuanman-none" style="position: fixed;bottom:0px;left:-0px;width:100%;z-index:1000;" ></div></a>
<img id="xiaotuanmannone" style="position: fixed;bottom:95px;cursor:pointer;z-index:1001;" src="/source/Static/home/images/index_img/xiaotuanmannone.png" alt="">
<!--结束周边游-->


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
</script>
<script>
    //关闭弹框
    $(".Popup , .GPopup").on("click",function(){
        $(this).fadeOut("slow");
    })
    //页面加载获取锚点id值   对有这个id的元素执行一次点击事件
    $(document).ready(function(){
        var url = location.search;
        var str = url.substring( url.length-2)
        if(str == 43) {
            $(".Popup").show();
        }
    })
    $(document).ready(function(){
        var url = location.search;
        var str = url.substring( url.length-2)
        if(str == 19) {
            $(".GPopup").show();
        }
    })
    // 产品主题类型浮动框

    $('.theme-travel').hover(function () {
            $(this).find('.qj-box').show();
        } , function () {
            $(this).find('.qj-box').hide();
        }

    );
    //小团慢显示于隐藏
    var width;
    $("#xiaotuanmanblock").on("click",function(){
        width = $(window).width();
        if(width<1600){
            $(this).animate({left: -174}, 300);
            setTimeout(function () {
                $("#xiaotuanman-none").animate({left: 0}, 700);
                $("#xiaotuanmannone").animate({left: "90%"}, 700);
            }, 300);
        }else{
            $(this).animate({left: -174}, 300);
            setTimeout(function () {
                $("#xiaotuanman-none").animate({left: 0}, 700);
                $("#xiaotuanmannone").animate({left: "80%"}, 700);
            }, 300);
        }
    })
    $("#xiaotuanmannone").on("click",function(){
        width = $(window).width();
        if(width<1600){
            $("#xiaotuanman-none").animate({left: "-100%"}, 700);
            $("#xiaotuanmannone").animate({left: -30}, 600);
            setTimeout(function () {
                $("#xiaotuanmanblock").animate({left: -132}, 300);
            }, 700);
        }else{
            $("#xiaotuanman-none").animate({left: "-100%"}, 700);
            $("#xiaotuanmannone").animate({left: -30}, 600);
            setTimeout(function () {
                $("#xiaotuanmanblock").animate({left: 0}, 300);
            }, 700);
        }
    })
</script>

<script>

	//热门单品
	$('.hot-sale-product a').hover(
		function () {
			$(this).find('.hot-sale-img').stop().hide(500);
		},
		function () {
			$(this).find('.hot-sale-img').stop().show(1000);
		}
	);

	//深度游，民族行，摄影游
	$('.theme-travel a').each(function(){
		if($(this).html()=='民族行'){
			$(this).addClass('zhuti');
		}else if($(this).html()=='摄影游'){
			$(this).addClass('sheying');
		}
	});



	//move-bg
 	$(".tab-list").movebg({
 		width:60/*滑块的大小*/,
        extra:0/*额外反弹的距离*/,
        speed:500/*滑块移动的速度*/,
        rebound_speed:400/*滑块反弹的速度*/
    });

	// 设置专题配置
	function setSubjectConfig(key, val, nSort, sql_type, keyLike) {
		if (key == '' || key == 'undefined' || key == null) {
			alert('查找的数据类型错误');
			return false;
		}
		var jsonData = {
			op_type: 'data',
			subject_id: $('.zt-main').attr('data-id'),
			key: key,
			value: val,
		}
		if (nSort != 'undefined' && nSort != null) {
			jsonData['sort'] = nSort;
		}
		if (sql_type != 'undefined' && sql_type != null) {
			jsonData['sql_type'] = sql_type;
		}
		if (keyLike != 'undefined' && keyLike != null) {
			jsonData['key_like'] = 1;
		}

		var ds = {ds:null, result:{errno:-1, message:'专题信息有误'}};
		$.ajax({
			url: '<?php echo U("line/subject");?>',
			type: 'POST',
			async: false,
			data: jsonData,
			dataType: 'json',
			success: function(data) {
				ds = data;
			}
		});
		return ds;
	}

	// 线路选择面板切换
	var curTabId = null;
	function changeTabPage() {
		var mainObj = $(this).closest('.main');
		var thisTabObj = $(mainObj).find('.tab-list a.g');
		
		if (curTabId != null && curTabId == $(this).attr('data-id')) {
			return false;
		}
		curTabId = $(this).attr('data-id');

		// 选中切换
		$(mainObj).find('.tab-list a').removeClass('g');
		$(this).addClass('g');

		// 设置面板当前的tab标签
		var tabKey = $(this).attr('data-key');

		$('.zt-sublist').empty();
		// 重新获取内容并填充
		var data = setSubjectConfig(tabKey, '', 0, 'find');
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
		} else {
			alert(data.result.message);
		}
	}		
	
	// 切换产品选择
	$('.zt-list').find('.tab-list').find('a').click(changeTabPage);
		
	$('.special-exhibition').unslider({ 
		dots: true
	});


	$('.zt-main ul li').mouseenter( function () {

    	$(this).find('.zt-text').stop().animate({top: 0}, 500);

    	$(this).find('.zt-img').stop().fadeOut(1000);

  	} );

  	$('.zt-main ul li').mouseleave( function () {

    	$(this).find('.zt-text').stop().animate({top: "-369px"}, 1000);

    	$(this).find('.zt-img').stop().fadeIn(1500);

  	} );
  	
  	 //精彩游记

	$('.wonderful-travels ul li').mouseenter( function () {

	 	$(this).find('.wonderful-describe').stop().fadeIn();

	} );

	$('.wonderful-travels ul li').mouseleave( function () {

	  	$(this).find('.wonderful-describe').stop().fadeOut();

	} );
	
	//视频
	var lastVideoId = null;
	function getMPList() {
		var jsonData = {
			op: 'list',
			topic_name: '领袖户外',
			count:8,
			feature: 'new',
		}
		if (lastVideoId != null) {
			jsonData['max_id'] = lastVideoId;
		}
		$.post('http://kllife.com/back/index.php?s=/back/help/meipai',jsonData,function(data){
			if (data.ds != null) {
				for (var i=0; i<data.ds.length; i++) {
					var d = data.ds[i];
					lastVideoId = d.id;
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