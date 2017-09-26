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
<!-- 日历 -->
<link rel="stylesheet" href="/source/Static/home/common/css/jcDate.css">
<!-- 私有样式 -->
<link rel="stylesheet" href="/source/Static/home/css/content.css">
<style type="text/css">
	.location-station-tel {
		font: 20px '微软雅黑';
		font-weight: 900 !important;
		color: #ff7200 !important;
		margin-left: 18px;
	}
	.fixed{position: fixed;top:0px;left:0px;width:100%;z-index:100;}
	.xingcheng-href{
		width:869px;
		background: #fff;
		margin-left:100px;
		padding-left:131px;
		overflow: hidden;
	}
	.xingcheng-href a{
		display: inline-block;
		width:267px;
		float: left;
		margin-right:20px;
	}
</style>

<!-- 日历项模板 -->

<div class="information template_date_item hidden_ctrl">

	<img src="/source/Static/home/images/content_img/yellow_arrow_bottom.png" alt="" />

	<p class="information-state"></p>

	<p class="information-money">元</p>

	<div class="information-details">

		<div class="information-details-content">

			<p><span class="information-people">余</span></p>

			<p>成人价格：<span class="adult-money"></span>元/人</p>

			<p>儿童价格：<span class="children-money"></span>元/人</p>

		</div>

	</div>

</div>


<!-- 已报名列表 -->

<?php if(empty($orders) == false): ?><div class="enrol-mark"></div>

	<div class="enrol-list">

		<a class="close-enrol-list" href="javascript:;">

			<img src="/source/Static/home/images/content_img/close_enrol.png" alt="">

		</a>

		<a class="backTop-enrol-list" href="javascript:;">

			<img src="/source/Static/home/images/content_img/top_enrol.png" alt="">

		</a>

		<h2>报名列表 >> <?php echo ($line["subheading"]); ?></h2>

		<div class="enrol-list-content">

			<div class="enrol-list-content-head">

				<span>用户昵称</span><span>地区</span><span>申请人数</span><span>报名时间</span><span>审核状态</span>

			</div>

			<table>

				<?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order_list): $mod = ($i % 2 );++$i;?><thead>

					<tr>

						<th colspan="5"><?php echo ($order_list["hdid_show_text"]); ?></th>

					</tr>

					</thead>

					<tbody>

					<?php if(is_array($order_list['data'])): $i = 0; $__LIST__ = $order_list['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><tr>

							<td>
								<?php if(empty($order['names']) == false): echo ($order["names_show"]); ?>
									<?php else: ?>
									<?php echo ($order["mob_show"]); endif; ?>
							</td>

							<td><?php echo ($order["city"]); ?></td>

							<td><?php echo ($order["member_total_count"]); ?>人</td>

							<td><?php echo ($order["addtime_show"]); ?></td>

							<td style="color: <?php echo ($order["zhuangtai_color"]); ?>;"><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></td>

						</tr><?php endforeach; endif; else: echo "" ;endif; ?>

					</tbody><?php endforeach; endif; else: echo "" ;endif; ?>

			</table>

		</div>

	</div><?php endif; ?>

<!-- 主要内容 -->
<div id="content">
	<!-- 面包屑导航 -->
	<div class="bread-nav">
		<u>
			<?php if($line['station_data'][0]['attached'] == '1'): if(is_array($line["theme_type_list"])): $i = 0; $__LIST__ = $line["theme_type_list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$theme): $mod = ($i % 2 );++$i;?><a class="<?php echo ($theme['type_key']); ?>" href="javascript:;"><?php echo ($theme["type_desc"]); ?></a>

					<div class="qj-box">

						<img src="/source/Static/home/images/content_img/yellow_arrow_top.png" alt="" />

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

					</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>

			产品编号：<?php echo ($line["id"]); ?>

			<?php if ($line['station_data'][0]['attached'] == '1') { ?>

			<?php if($line['theme_type_show_text'] == '小团慢旅行'): ?><span>本产品由领袖户外独立策划并独立发团</span>

				<?php elseif($line['theme_type_show_text'] == '民族行'): ?>

				<span>本产品由领袖户外或领袖户外委托有资质的合作旅行社及户外机构提供相关服务</span>

				<?php else: ?>

				<?php if($line['extra'] == 1): ?><span>本产品由领袖户外或领袖户外委托有资质的合作旅行社及户外机构提供相关服务</span>

					<?php else: ?>

					<span>本产品由领袖户外提供相关服务</span><?php endif; endif; ?>

			<?php } else { ?>

			<span>本产品由<?php echo ($line['station_data'][0]['intro']); ?>提供相关服务</span>

			<?php } ?>

		</u>
	</div>

	<!-- 行程概览 -->

	<div class="travel-overview">

		<div class="travel-overview-left">

			<div class="travel-overview-left-top">

				<img src="<?php echo ($line["img1"]); ?>" alt="">

			</div>

			<div class="travel-overview-left-bottom">

				<div class="calendar" id="calendar">
            		<div  class="calendar-nav">
						<a href="javascript:;" class="fa  fa-2x fa-angle-left arrow"><i class="iconfont">&#xe649;</i></a>
						<a href="javascript:;" class="fa fa-2x fa-angle-right arrow"><i class="iconfont">&#xe600;</i></a>
						<div class="calendar_nav" id="calendar_nav"></div>
					</div> 
					<ul class="calendar_week">
						<li>日</li>
						<li>一</li>
						<li>二</li>
						<li>三</li>
						<li>四</li>
						<li>五</li>
						<li>六</li>
					</ul>
					<div class="calendar_content"  id="calendarDiv"></div>
				</div>

			</div>

		</div>

		<div class="travel-overview-right">

            <div class="jiriyou">
                <p><?php echo ($line["travel_day"]); ?>日游</p>
            </div>

            <div class="travel-overview-right-content">

                <div class="right-content-top">

                    <div class="line-title">
                        <h2>
                            <span id="line-title"><?php echo ($line["title"]); ?></span>
                        </h2>
                        <div class="share" style="float:none;">
                            <i class="weibo" onclick="window.open('http://service.weibo.com/share/share.php?url='+encodeURIComponent(document.location.href)+'&title='+ document.getElementById('line-title').innerText +'————' + document.getElementById('line-subheading').innerText);return false;"></i>
                            <i class="weixin"></i>
                            <div class="share-code">
                                <h4>分享到朋友圈<a href="javascript:;">x</a></h4>
                                <div id="code"></div>
                                <p>打开微信，点击底部的"发现"，</p>
                                <p>使用"扫一扫"即可将网页分享至朋友圈。</p>
                            </div>
                            <i class="qzone" onclick="window.open('http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+encodeURIComponent(document.location.href)+'&title='+ document.getElementById('line-title').innerText +'————' + document.getElementById('line-subheading').innerText );return false;"></i>
                        </div>
                    </div>

                    <h3 id="line-subheading"><?php echo ($line["subheading"]); ?></h3>

                    <div class="right-content-money">
							<span>
								<?php if(empty($line['check_price'])): ?><strong>核算中</strong>
								<?php else: ?>
										￥<strong><?php echo ($line["start_price_adult"]); ?></strong>元起/成人
										<i>(<?php echo ($line["start_price_child"]); ?>元起/儿童)</i><?php endif; ?>
							</span>
							
							<?php if(!empty($line["start_price_explain"])): ?><a href="javascript:;">起价说明</a>
	                            <div class="qj-explain">
	                                <img src="/source/Static/home/images/content_img/yellow_arrow_top.png" alt="">
	                                <div class="qj-explain-content">
	                                    <h6>起价说明</h6>
	                                    <p><?php echo ($line["start_price_explain"]); ?></p>
	                                </div>
	                            </div><?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="right-content-bottom">
				<?php if(stripos($line['theme_type_show_text'], '民族行') === false): ?><p><b>成团人数</b><?php echo ($line["success_team_count"]); ?>人&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>满团人数：</b><?php echo ($line["max_team_count"]); ?>人 </p>
                <?php else: ?>
                	<p><b>成团人数</b><?php echo ($line["success_team_count"]); ?>人</p><?php endif; ?> 
                
                <?php if(empty($line['assembly_point_show_text']) == false): ?><p><b>集合地点</b><?php echo ($line["assembly_point_show_text"]); ?></p>
				<?php else: ?>
					<p><b>集合地点</b>全国各地</p><?php endif; ?>  
                    
                <p><b>日程时间</b><?php echo ($line["start_time"]); ?>-<?php echo ($line["end_time"]); ?></p>

                <div id="xlcjl">
                    <a href="javascript:;" style="width:90px;display:inline-block;">线路成交量</a><?php echo ($order_member_count); ?>
                    <!-- 滚动报名 -->
                    <div class="swiper_wrap">
                        <ul class="font_inner"> 
                            <?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order_list): $mod = ($i % 2 );++$i; if(is_array($order_list["data"])): $i = 0; $__LIST__ = $order_list["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><li><a href="javascript:;">用户<?php echo ($order["mob_show"]); ?>预订<?php echo ($order["hdid_data"]["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
                    <p id="cpjy" style="padding-bottom: 10px;"><span><b>产品寄语</b><?php echo ($line["send_word"]); ?></span></p>
                    
                    <div id="cfrq" class="tclx" style="margin:0px;">
						<?php if(empty($line['taocanList']) != true): ?><b style="height:70px;">套餐类型</b>						
							<div class="div taocan-list">
								<?php if(is_array($line["taocanList"])): $i = 0; $__LIST__ = $line["taocanList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$taocan): $mod = ($i % 2 );++$i;?><div data-id="<?php echo ($taocan["id"]); ?>" data-date="0">
										<p><?php echo ($taocan["name"]); ?></p>
										<img src="/source/Static/home/images/content_img/taocan_active.png" alt="" />
									</div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div><?php endif; ?>
					</div>
					
					<div id="cfrq">
						<b>出发日期</b>
						<div class="cfrq-choose">
							<span class="cfrq_select_batch" data-id="0">请选择出发日期</span>
							<div class="cfrq-show hidden_ctrl">
								<u>未知时间</u>集合
								,
								<u>未知时间</u>解散
							</div>
							<img src="/source/Static/home/images/content_img/down.png" alt="">
							<ul class="cfrq_batch_list">
								<?php foreach($line['batchs'] as $bk=>$bv) { echo('<li data-id="'.$bv['id'].'" data-val="'.$bv['start_date_show'].'" data-end-date="'.$bv['end_date_show'].'" data-state="'.$bv['state_data']['type_key'].'">'.$bv['start_date_show'].'['.$bv['state_data']['type_desc'].']</li>'); } ?>
							</ul>
						</div>
					</div>
					<div id="cyrs">
						<b style="height:22px;">出游人数</b>
						<?php if(empty($check['only_child']) == true): ?><div class="adult-num adult_male">
								<u>成人男</u>
								<input type="text" value ="0" style="width: 55px;height: 26px;padding-left:10px;"/>
								<ul class="ul">
									<li>1</li>
									<li>2</li>
									<li>3</li>
									<li>4</li>
									<li>5</li>
									<li>6</li>
									<li>7</li>
									<li>8</li>
									<li>9</li>
									<li>>9</li>
								</ul>
								<img src="/source/Static/home/images/content_img/down.png" alt="" />
							</div>
							<div class="adult-num adult_woman">
								<u>成人女</u>
								<input type="text" value ="0" style="width: 55px;height: 26px;padding-left:10px;"/>
								<ul class="ul">
									<li>1</li>
									<li>2</li>
									<li>3</li>
									<li>4</li>
									<li>5</li>
									<li>6</li>
									<li>7</li>
									<li>8</li>
									<li>9</li>
									<li>>9</li>
								</ul>
								<img src="/source/Static/home/images/content_img/down.png" alt="" />
							</div><?php endif; ?>
						<?php if(empty($check['only_adult']) == true): ?><div class="children-num">
								<u>儿童</u>
								<input type="text" value ="0" style="width: 55px;height: 26px;padding-left:10px;"/>
								<ul class="ul">
									<li>1</li>
									<li>2</li>
									<li>3</li>
									<li>4</li>
									<li>5</li>
									<li>6</li>
									<li>7</li>
									<li>8</li>
									<li>9</li>
									<li>>9</li>
								</ul>
								<img src="/source/Static/home/images/content_img/down.png" alt="" />
							</div><?php endif; ?>
					</div>

					<div class="immediate-reservation">
	                	<a class="book_order_now" href="javascript:;">立即预定</a>
	                	<span class="zixun"><img src="/source/Static/home/images/content_img/zixunkefu.png" alt="" /></span>
            		</div>
            		<div style="padding-left:120px;padding-bottom: 20px;padding-top: 15px;">
            			<img src="/source/Static/home/images/content_img/zixun_tel.png" alt="" />
            		</div>
		            <div style="padding-left:120px;color:#666;">
		                本产品在线咨询讨论QQ群：<em><?php echo ($line["seek_qq"]); ?></em>
		                <?php if(empty($line['qq_verify']) == false): ?><em>( 进群验证“<?php echo ($line["qq_verify"]); ?>”)</em><?php endif; ?>
		            </div>

		            <div class="srdz">
						<span class="span1">领袖户外 · 定制旅行</span>
						<span class="span2">定制游，玩你想玩，玩的精彩</span>
						<a href="http://kllife.com/home/index.php?s=/home/line/book" target="_blank">开启定制之旅</a>
		            </div>
       </div>
	</div>
</div>
</div>

<!-- 导航栏 -->

<div class="content-list">

	<div class="content-list-to">

		<a class="content-list-to-highlights" href="#travel-highlights">行程亮点</a>

		|

		<a class="content-list-to-arrangements" href="#travel-arrangements">行程说明</a>

		|

		<a class="content-list-to-notes" href="#travel-notes">活动游记</a>

		|

		<a class="content-list-to-attention" href="#content-money">费用详细</a>

		|

		<a class="content-list-to-visa" href="#content-reserve">预定须知</a>

		|

		<a class="content-list-to-scenery" href="#content-scenery">沿途风光</a>

		<!--|-->

		<!--<a class="content-list-to-question" href="#ask-question">产品问答</a>-->

		<?php if(empty($duid) == false): ?><a class="content-list-to-reserve" href="<?php echo U('line/order');?>/id/<?php echo ($line["id"]); ?>/duid/<?php echo ($duid); ?>/type/create">立即预定</a>

			<?php else: ?>

			<a class="content-list-to-reserve" href="<?php echo U('line/order');?>/id/<?php echo ($line["id"]); ?>/type/create">立即预定</a><?php endif; ?>

	</div>

</div>



<!-- 行程亮点 -->
<div class="travel-highlights">
	<h3 id="travel-highlights">行程亮点</h3>
	<div style="width: 100%; overflow: hidden;">
		<?php if(is_array($line["points"])): $i = 0; $__LIST__ = $line["points"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lp): $mod = ($i % 2 );++$i; if($lp["content"] != ''): ?><p><?php echo ($lp["content"]); ?></p><?php endif; ?>
			<?php if($lp["image_url"] != ''): ?><img src="<?php echo ($lp["image_url"]); ?>" alt=""><?php endif; ?>
			<?php if($line['id'] == 272 and $lp['index'] == 3): ?><p style="text-align: center; line-height:0;">
					<video poster="/source/Static/home/common/images/silk_video_banner.gif" height="565" width="1000" controls="controls"  x5-video-player-type="h5"/>
					<source src="/source/Static/home/mp4/haibin-house.mp4" type="video/mp4">
					</video>
				</p><?php endif; ?>
			<?php if($line['id'] == 273 and $lp['index'] == 19): ?><p style="text-align: center;line-height:0;">
					<video poster="/source/Static/home/common/images/silk_video_banner.gif" height="565" width="1000" controls="controls"  x5-video-player-type="h5"/>
					<source src="/source/Static/home/mp4/haibin-house.mp4" type="video/mp4">
					</video>
				</p><?php endif; ?>
			<?php if($line['id'] == 274 and $lp['index'] == 20): ?><p style="text-align: center; line-height:0;">
					<video poster="/source/Static/home/common/images/silk_video_banner.gif" height="565" width="1000" controls="controls"  x5-video-player-type="h5"/>
					<source src="/source/Static/home/mp4/haibin-house.mp4" type="video/mp4">
					</video>
				</p><?php endif; ?>
			<?php if($line['id'] == 334 and $lp['index'] == 7): ?><p style="text-align: center; line-height:0;">
					<video poster="/source/Static/home/common/images/silk_video_banner.gif" height="565" width="1000" controls="controls"  x5-video-player-type="h5"/>
					<source src="/source/Static/home/mp4/haibin-house.mp4" type="video/mp4">
					</video>
				</p><?php endif; ?>
			<?php if($line['id'] == 337 and $lp['index'] == 2): ?><p style="text-align: center; line-height:0;">
					<video poster="http://old.kllife.com/uploadfile/allimg/161110/1423554921-1.jpg" height="565" width="1000" controls="controls"  x5-video-player-type="h5"/>
					<source src="http://7xosrp.com1.z0.glb.clouddn.com/xb_ssyd_sp.mp4" type="video/mp4">
					</video>
				</p><?php endif; ?>
			<?php if($line['id'] == 337 and $lp['index'] == 8): ?><p style="text-align: center; line-height:0;">
					<video poster="/source/Static/home/common/images/silk_video_banner.gif" height="565" width="1000" controls="controls"  x5-video-player-type="h5"/>
					<source src="/source/Static/home/mp4/haibin-house.mp4" type="video/mp4">
					</video>
				</p><?php endif; ?>
			<?php if($line['id'] == 341 and $lp['index'] == 8): ?><p style="text-align: center; line-height:0;">
					<video poster="/source/Static/home/common/images/silk_video_banner.gif" height="565" width="1000" controls="controls"  x5-video-player-type="h5"/>
					<source src="/source/Static/home/mp4/haibin-house.mp4" type="video/mp4">
					</video>
				</p><?php endif; ?>
			<?php if($line['id'] == 273 and $lp['index'] == 24): ?><div class="xingcheng-href">
					<a href="http://kllife.com/home/index.php?s=/home/line/info/id/337" target="_blank"><img src="/source/Static/home/images/content_img/01.png" alt=""></a>
					<a href="http://kllife.com/home/index.php?s=/home/line/info/id/273" target="_blank"><img src="/source/Static/home/images/content_img/02.png" alt=""></a>
					<a href="http://kllife.com/home/index.php?s=/home/line/info/id/341" target="_blank"><img src="/source/Static/home/images/content_img/03.png" alt=""></a>
				</div><?php endif; ?>
			<?php if($line['id'] == 337 and $lp['index'] == 21): ?><div class="xingcheng-href">
					<a href="http://kllife.com/home/index.php?s=/home/line/info/id/337" target="_blank"><img src="/source/Static/home/images/content_img/01.png" alt=""></a>
					<a href="http://kllife.com/home/index.php?s=/home/line/info/id/273" target="_blank"><img src="/source/Static/home/images/content_img/02.png" alt=""></a>
					<a href="http://kllife.com/home/index.php?s=/home/line/info/id/341" target="_blank"><img src="/source/Static/home/images/content_img/03.png" alt=""></a>
				</div><?php endif; ?>
			<?php if($line['id'] == 341 and $lp['index'] == 24): ?><div class="xingcheng-href">
					<a href="http://kllife.com/home/index.php?s=/home/line/info/id/337" target="_blank"><img src="/source/Static/home/images/content_img/01.png" alt=""></a>
					<a href="http://kllife.com/home/index.php?s=/home/line/info/id/273" target="_blank"><img src="/source/Static/home/images/content_img/02.png" alt=""></a>
					<a href="http://kllife.com/home/index.php?s=/home/line/info/id/341" target="_blank"><img src="/source/Static/home/images/content_img/03.png" alt=""></a>
				</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
		<!--在这里添加文字-->
		<!--<span></span>-->
	</div>
</div>

<!--相关线路-->
<div class="recommend travel-recommend">
	<?php if(empty($line['exist_recommend_line']) === FALSE): ?><h3 id="recommend">相关线路</h3>
    <div class="recommend-group">
    	<?php if(is_array($line["sets"])): $i = 0; $__LIST__ = $line["sets"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i; if(stripos($s['key'], 'recommend_line') !== FALSE): ?><div class="recommend-item">
		            <div style="height:190.77px;padding:0px;"><img src="<?php echo ($s['value']['img1']); ?>" alt=""></div>
		            <div>
		                <p class="lg"><?php echo ($s['value']['title']); ?></p>
		                <p class="sm"><?php echo ($s['value']['subheading']); ?></p>
		                <?php if(empty($s['value']['check_price'])): ?><p class="money"><span>核算中</span></p>
		                <?php else: ?>
		                	<?php $price = explode('.',$s['value']['start_price_adult']); ?>
		                	<p class="money">￥<span><?php echo ($price[0]); ?></span>元起</p><?php endif; ?>
		            </div>
		            <a href="<?php echo U('line/info');?>/id/<?php echo ($s['value']['id']); ?>" title="<?php echo ($s['value']['title']); ?>：<?php echo ($s['value']['subheading']); ?>"  target="_blank"></a>
		        </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </div><?php endif; ?>
</div>

<!-- 行程说明 -->

<div class="travel-arrangements">

	<div class="travel-arrangements-content">

		<h3 id="travel-arrangements">行程说明</h3>

		<div class="travel-arrangements-list">

				<span>

					<img src="/source/Static/home/images/content_img/travel_arrangements_day_begin.png" alt="">

				</span>

			<em>——</em>
			<?php $__FOR_START_381037349__=1;$__FOR_END_381037349__=$line['real_travel_day'];for($i=$__FOR_START_381037349__;$i <= $__FOR_END_381037349__;$i+=1){ ?><a class="day<?php echo ($i); ?>" href="#day<?php echo ($i); ?>">

					<p><?php echo ($i); ?></p>

					Day

				</a>

				<em>——</em><?php } ?>

			<span>

				<img src="/source/Static/home/images/content_img/travel_arrangements_day_end.png" alt="">

			</span>

		</div>

		<div class="travel-arrangements-alldays">

			<input id="travel_day" type="hidden" value="<?php echo ($line["real_travel_day"]); ?>"/>

			<?php if(is_array($line["travels"])): $i = 0; $__LIST__ = $line["travels"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$travel): $mod = ($i % 2 );++$i;?><div id="day<?php echo ($travel["day_id"]); ?>" class="travel-arrangements-days">

					<h4>Day<?php echo ($travel["day_id"]); ?>：<?php echo ($travel["title"]); ?></h4>

					<?php if(!empty($travel["view_point"])): ?><span><i class="days-zd"></i>游览重点：<?php echo ($travel["view_point"]); ?></span><?php endif; ?>

					<p><?php echo ($travel["intro"]); ?></p>
					
					<?php if($line['id'] == 273 and $travel['day_id'] == 10): ?><a style="display: inline-block;margin-bottom: 30px;" href="<?php echo U('line/info');?>/id/341" target="_blank">
						
							<img src="http://img.kllife.com/2017-06-30_5955f51b63566.gif" alt="">	
													
						</a><?php endif; ?>

					<div class="days-information">

						<?php if(!empty($travel["hotel"])): ?><span><i class="days-zs"></i>住宿：<?php echo ($travel["hotel"]); ?></span><?php endif; ?>

						<?php if(!empty($travel["eat_way"])): ?><span><i class="days-cy"></i>餐饮：<?php echo ($travel["eat_way"]); ?></span><?php endif; ?>




					</div>

					<?php if(!empty($travel["kindly_reminder"])): ?><div class="days-prompt">

							<span><i class="days-ts"></i>温馨提示：</span>

							<div class="prompt"><?php echo ($travel["kindly_reminder"]); ?></div>

						</div><?php endif; ?>

					<div class="days-img">

						<?php if(!empty($travel["img1"])): ?><div class="days-img-left">

								<img src="<?php echo ($travel["img1"]); ?>" alt="">

								<p><?php echo ($travel["img1_desc"]); ?></p>

							</div><?php endif; ?>


						<?php if(!empty($travel["img2"])): ?><div class="days-img-left">

								<img src="<?php echo ($travel["img2"]); ?>" alt="">

								<p><?php echo ($travel["img2_desc"]); ?></p>

							</div><?php endif; ?>


						<?php if(!empty($travel["img3"])): ?><div class="days-img-left">

								<img src="<?php echo ($travel["img3"]); ?>" alt="">

								<p><?php echo ($travel["img3_desc"]); ?></p>

							</div><?php endif; ?>

					</div>

				</div><?php endforeach; endif; else: echo "" ;endif; ?>

		</div>

	</div>

</div>

<!-- 游记攻略 -->
<div class="travel-notes">

	<?php if($line["exist_youji"] == 1): ?><h3 id="travel-notes">活动游记 <span style="font-size: 14px;padding-left:5px;">领队带团直播及团友游记分享!</span></h3>

		<div class="travel-notes-lunbo">

			<ul>
			
				<?php if(is_array($line["sets"])): $i = 0; $__LIST__ = $line["sets"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><!--<?php echo ($s['key']); ?>-->
					<?php if(stripos($s['key'], 'youji') !== FALSE and empty($s['value']['url']) === FALSE): ?><li>

							<a href="<?php echo ($s['value']['url']); ?>" target="_blank"></a>

							<img src="<?php echo ($s['value']['img']); ?>" alt="">

							<div class="notes-describe">

								<h3><?php echo ($s['value']['title']); ?></h3>

								<div class="notes-xx">

									<p><?php echo ($s['value']['desc']); ?></p>

								</div>

							</div>

						</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>

			</ul>

		</div><?php endif; ?>

</div>



<!-- 费用详细 -->

<div class="content-money">

	<h3 id="content-money">费用详细</h3>

	<div class="content-money-describe">

		<div class="money-describe">

			<div class="describe-content">

				<?php echo ($line["cost_description"]); ?>

			</div>

		</div>

	</div>

</div>

<!-- 预定须知 -->

<div class="content-reserve">

	<h3 id="content-reserve">预订须知</h3>

	<div class="content-money-describe">

		<div class="money-describe">

			<div class="describe-content">

				<p style="padding: 10px 0; color: #00f;">公告：领袖户外的行程安排可能会根据实际突发情况和队员反馈进行调整和优化，但调整不会涉及费用包含的景区、游览天数、集散地点以及住宿标准，最终行程安排以合同内容为准。
				</p>

				<?php echo ($line["booking_notes"]); ?>

			</div>

		</div>

	</div>

</div>

<!-- 沿途风光 -->

<div class="content-scenery">

	<h3 id="content-scenery">沿途风光</h3>

	<div class="scenery">

		<?php if(is_array($line["scenery"])): $i = 0; $__LIST__ = $line["scenery"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sc): $mod = ($i % 2 );++$i; if($sc["content"] != ''): ?><p><?php echo ($sc["content"]); ?></p><?php endif; ?>

			<?php if($sc["image_url"] != ''): ?><img src="<?php echo ($sc["image_url"]); ?>" alt=""><?php endif; endforeach; endif; else: echo "" ;endif; ?>

	</div>

</div>

<!-- 私人定制 -->

	<div class="private-custom">
		<h2>上述产品不符合您的需求？</h2>
		<p>欢迎填写下表提交，即刻联系领袖户外的私人旅行顾问</p>
		<p>我们将为您和您的亲友量身定制专属行程</p>
		<a href="<?php echo ($pcset["team_link"]); ?>" target="_blank">私人定制</a>
	</div>

<!-- 精彩专题 -->



	<div class="bg-gray">

		<div class="special main">

			<h2>超级目的地</h2>

			<div class="special-exhibition">

				<ul>
					<?php $idx = '0'; ?>
					
					<?php $__FOR_START_1914930344__=0;$__FOR_END_1914930344__=12;for($k=$__FOR_START_1914930344__;$k < $__FOR_END_1914930344__;$k+=1){ $zt = $set_subjects['zhuanti'.$k]; if (empty($zt['url'])) { continue; } ?>
						
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

<!-- 产品提问 -->

<!--<div class="question-answer template_question" style="display: none;">-->

<!--<div class="question">-->

<!--<i class="good"></i>-->

<!--<span><a class="question_content" target="_blank" href=""></a></span>-->

<!--<u class="question_time"></u>-->

<!--</div>-->

<!--<div class="answer">-->

<!--<i class="question_agree">0</i>-->

<!--<span class="answer_content"></span>-->

<!--<u class="answer_time"></u>-->

<!--</div>-->

<!--</div>-->

<!--<div class="ask-question">-->

<!--<h3 id="ask-question">产品提问</h3>-->

<!--<div class="question-content">-->

<!--<div class="seacrch-question">-->

<!--<input id="question_content" type="text" placeholder="输入你的问题..."><a class="ask_question" href="javascript:;">提问</a>-->

<!--</div>-->

<!--<div class="question-list">-->

<!--<div class="question-choose">-->

<!--<a class="question-help question-checked" href="javascript:;">最有帮助</a>-->

<!--&lt;!&ndash;|&ndash;&gt;-->

<!--&lt;!&ndash;<a class="question-new" href="javascript:;">最新</a>&ndash;&gt;-->

<!--</div>-->

<!--<div>-->

<!--<div class="question-answer-list question-help-content">-->

<!--</div>-->

<!--<div class="question-answer-list question-new-content">-->

<!--</div>-->

<!--</div>-->

<!--</div>-->

<!--<div class="question-all-look">-->

<!--<a href="javascript:;">查看更多已回答的问题>></a>-->

<!--</div>-->

<!--</div>-->

<!--</div>-->

<!-- 为什么选择我们 -->

<!--<div class="why-choose-us">
		<a href="javascript:;">
			<img src="/source/Static/home/brand/index_img/choose_us.png" alt="">
		</a>
	</div>-->


<div class="mark"></div>
<div id="alert-modal">

	<div class="alert-modal-top">
		<a href="javascript:;"><img src="/source/Static/home/common/images/video_close.png"/></a>
	</div>
	<div class="alert-modal-content">
		<p></p>
	</div>

</div>

<!-- 滚动 -->

<script src="/source/Static/home/js/gundong.js"></script>
<script src="/source/Static/home/js/jquery.qrcode.min.js"></script>

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
<script>
	//日历
		var oDiv = document.getElementById('calendar_nav');
		var oDate = new Date();
		var Syear = oDate.getFullYear();
	    var Smonth = oDate.getMonth()+1;
	    if(Smonth<10){
	    	Smonth = "0"+ Smonth
	    }else{
	    	Smonth = Smonth
	    }
		var oCalendar = document.getElementById('calendarDiv');
		calendarTit(oDiv,oCalendar,Syear,parseInt(Smonth));
		var bBtn = true;
		
	function finalDay() {
        for (var n = 1; n < $('#calendarDiv tr td').length + 1; n++) {
            if (n % 7 == 0) {
                $('#calendarDiv tr td:eq('+ (n - 1) +')').addClass('final-day');
            }
        };
    }

    // 初始化批次信息
    function initCalendarBatch(y) {
        var lineId = '<?php echo ($line["id"]); ?>';
        var vtype = 'find_batch';
        
        //套餐选中
        var taocanIds = ',';
		$('.tclx .taocan-list').find('div.active').each(function(){
			taocanIds += $(this).attr('data-id') + ',';
		});
		if (taocanIds != ',') {
        	vtype = 'find_taocan_batch';
        }
		
		//批次选中
		var batchId = '';

        var jsonData = {
        	type:vtype,
        	line_id:lineId,
        	year:y,
        	taocan_ids:taocanIds,
        	batch_id:batchId,	
        };
        $.post('<?php echo U("line/info");?>', jsonData, function(data){
			console.log(data)
            if (data.result.errno == 0) {				
                var batchs = new Object();
                if (data.ds != null && typeof(data.ds) != 'undefined') {
                    for (var i = 0; i < data.ds.length; i++) {
                        var tempDate = new Date(Date.parse(data.ds[i]['start_time'].replace(/-/g,"/")));
                        var td = tempDate.getFullYear()+'-'+(tempDate.getMonth()+1)+'-'+tempDate.getDate();
                        batchs[td] = data.ds[i];
                    }
                }

                $('#calendarDiv tr td').each( function(){
                	$(this).find('.information').remove();
                	$(this).removeClass('black');
                	$(this).removeClass('gogogo');
                    var curDate = $(this).attr('data-date');                    
                    if (typeof(batchs[curDate]) != 'undefined') {						
                        var b = batchs[curDate];
                        var itemObj = $('.template_date_item').clone(true);
                        $(itemObj).removeClass('template_date_item');
                        $(itemObj).removeClass('hidden_ctrl');
                        $(itemObj).find('img').attr('__PUBLIC_/home/images/content_img/yellow_arrow_bottom.png');
                        $(itemObj).find('.information-people').html('余'+b.sub_member);
 						$(itemObj).attr("data-number",b.end_date_show); 						
                        var state = $.parseJSON(b.state);
                        
                        $(itemObj).find('.information-state').html(state.type_desc);
                        
                        if(state.type_desc == "确认成行"){
							$(itemObj).find('.information-state').addClass("orange");
						}
						if(state.type_desc == "可报名"){
							$(itemObj).find('.information-state').addClass("blue");
						}
						if(state.type_desc == "名额紧张"){
							$(itemObj).find('.information-state').addClass("red");
						}
						
                        if (b.price_adult == 0 && b.price_child == 0 && '<?php echo ($line["free_line"]); ?>' == '0') {
                            $(itemObj).find('.adult-money').parent().html('成人价格：<span class="adult-money">核算中</span>');
                            $(itemObj).find('.children-money').parent().html('儿童价格：<span class="children-money">核算中</span>');
                            $(itemObj).find('.information-money').html('核算中');
                        } else {
                            $(itemObj).find('.adult-money').html(b.price_adult);
                            $(itemObj).find('.children-money').html(b.price_child);
                            $(itemObj).find('.information-money').html(b.price_adult+'元');
                        }
                        
                        $(this).addClass('gogogo');
                        $(this).attr('data-batch-id', b.id);
                        $(this).append(itemObj);
                    }
                });
            } else {
                console.log(data.result.message);
            }
            finalDay();
        });
    }
	
	 // calendar_nav里span的内容 
	 function  calendarTit(obj,obj1,year,month){

		 var oDate = new Date(year,month-1);
		//var oDate;
		 for(var i=-12; i<12; i++){
			 var ospan = document.createElement('span');
			 obj.appendChild(ospan);
			 ospan.innerHTML ='<b>'+year+'年</b>'+(month+i)+'月';
			 ospan.setAttribute("mouth",(month+i));
			 ospan.setAttribute("year",year);
			 if((month+i)>12){
				 year = oDate.getFullYear()+1;
				 ospan.innerHTML ='<b>'+year+'年</b>'+((month+i)-12)+'月';
				 ospan.setAttribute("mouth",((month+i)-12));
				 ospan.setAttribute("year",year);
			 }
			 if((month+i)<1){
				 year = oDate.getFullYear()-1;
				 ospan.innerHTML ='<b>'+year+'年</b>'+((month+i)+12)+'月';
				 ospan.setAttribute("mouth",((month+i)+12));
				 ospan.setAttribute("year",year);
			 }
			 if((month+i)>0 && (month+i)<12){
				 year = oDate.getFullYear();
				 ospan.innerHTML ='<b>'+year+'年</b>'+((month+i))+'月';
				 ospan.setAttribute("mouth",((month+i)));
				 ospan.setAttribute("year",year);
			 }
			 if((month+i)>0 && (month+i)<10){
				 year = oDate.getFullYear();
				 ospan.innerHTML ='<b>'+year+'年</b>'+((month+i))+'月';
				 ospan.setAttribute("mouth",((month+i)));
				 ospan.setAttribute("year",year);
			 }
			 var oCon = document.createElement('div');
			 obj1.appendChild(oCon);
			 $(".calendar_nav").children().hide();
			 $(".calendar_nav").children().slice(12,18).show();

		 }

		 for(var j=0; j<24; j++){
			 var aSpan = obj.children;
			 var aCon = obj1.children;
			 aSpan[12].className = 'active';
			 var oDate = new Date();
			 showDate(aCon[12],aSpan[12].getAttribute("year"),aSpan[12].getAttribute("mouth"),true);
			 aSpan[j].index = j;

		 }

	 }
	 //获取当天
		var spanlength =  oCalendar.getElementsByTagName('span');
		var now = new Date();
		for(var i=0;i<spanlength.length; i++) {
			if(spanlength[i].getAttribute("day")==now.getDate() && spanlength[i].getAttribute("month")==(now.getMonth()+1) && spanlength[i].getAttribute("year")==now.getFullYear() ){
				spanlength[i].className='today';
			}
		}
	 
	 function showDate(obj,year,month,bBtn){
		 var oDate = new Date();
		 var dayNum = 0;
		 if(!obj.bBtn){
			 var oTable = document.createElement('table');
			 var oTbody = document.createElement('tBody');
			 for(var i=0;i<6;i++){
				 var oTr = document.createElement('tr');
				 for(var j=0;j<7;j++){
					 var ospan = document.createElement('span');
					 var oTd = document.createElement('td');
					 oTd.appendChild(ospan);
					 oTr.appendChild(oTd);
				 }
				 oTbody.appendChild(oTr);

			 }
			 oTable.appendChild(oTbody);
			 obj.appendChild(oTable);

			 obj.bBtn = true;
		 }
		 //添加天数
		 var aTd = obj.getElementsByTagName('span');
		 for(var i=0;i<aTd.length;i++){
			 aTd[i].innerHTML = ''; 
		 }

		 if(month==1 || month==3 || month==5 || month==7 || month==8 || month==10 || month==12){
			 dayNum = 31;
		 }
		 else if(month==4 || month==6 || month==9 || month==11){
			 dayNum = 30;
		 }
		 else if(month==2 && isLeapYear(year)){
			 dayNum = 29;
		 }
		 else{
			 dayNum = 28;
		 }
		
		 oDate.setFullYear(year);
		 oDate.setMonth(month-1);
		 oDate.setDate(1); 
		 for(var i=0;i<dayNum;i++){
			 aTd[i+oDate.getDay()].innerHTML = i+1;
			 $(aTd[i+oDate.getDay()]).attr('year',year);
			 $(aTd[i+oDate.getDay()]).attr('month',month);
			 $(aTd[i+oDate.getDay()]).attr('day',i+1);
			 $(aTd[i+oDate.getDay()]).parent("td").attr('data-date',year+"-"+month+"-"+(i+1));
		 }
		 
		for(var i=0;i<aTd.length;i++){
			if(aTd[i].innerHTML==''){
				aTd[i].parentNode.className='bg_black';
			}
		}
		
		//润年
		function isLeapYear(year){
			if(year%4==0 && year%100!=0){
				return true;
			}
			else{
				if(year%400==0){
					return true;
				}else{
					return false;
				}
			}
		}
	 }


	//有备注的日期鼠标进入与移出
	$(document).on('mouseover mouseout', '.gogogo', function (event) {
		if(event.type == "mouseover"){
			$(this).find('.information-details').show();
			$(this).find('img').show();			
		}else if(event.type == "mouseout"){
			$(this).find('.information-details').hide();
			$(this).find('img').hide();
		}
	});

	$(document).on('mouseover', '.gogogo', function () {
		$(this).addClass("bg_yellow");
//		var data_duibi = $(this).attr("data-date");
//		var panduan_yue = $(this).attr("data-date").substr(6,1);
//		if(panduan_yue == "-"){
//			var data_yue = parseInt($(this).attr("data-date").substr(5,1));
//			var data_date = parseInt($(this).attr("data-date").substr(7,2));
//		}else{
//			var data_yue = parseInt($(this).attr("data-date").substr(5,2));
//			var data_date = parseInt($(this).attr("data-date").substr(8,2));
//		}
//
//
//		var date = $(this).find(".information").attr("data-number");
//		var data_number = parseInt($(this).find(".information").attr("data-number").substr(8,2));
//		if(data_date < data_number){
//			var number = data_number - data_date
//		}else{
//			if(data_yue==1 || data_yue==3 || data_yue==5 || data_yue==7 || data_yue==8 || data_yue==10 || data_yue==12){
//				var number = (31-data_date)+data_number
//			}else if(data_yue==4 || data_yue==6 || data_yue==9 || data_yue==11){
//				var number = (30-data_date)+data_number
//			}else if(data_yue==2 && isLeapYear(year)){
//				var number = (29-data_date)+data_number
//			}else{
//				var number = (28-data_date)+data_number
//			}
//		}
//		var thisObj = this;
//		var day = number+1, startChange = false;
//		var tdObjs = $('#calendarDiv').find('table tbody td').each(function(i, ev){
//			if (this == thisObj) {
//				startChange = true;
//			}
//			if (startChange && day > 0) {
//				$(this).addClass("bg_yellow");
//				day--;
//			}
//		});
	})
	$(document).on('mouseout', '.gogogo', function () {
		$(this).removeClass("bg_yellow");
//		var data_duibi = $(this).attr("data-date");
//		var panduan_yue = $(this).attr("data-date").substr(6,1);
//		if(panduan_yue == "-"){
//			var data_yue = parseInt($(this).attr("data-date").substr(5,1));
//			var data_date = parseInt($(this).attr("data-date").substr(7,2));
//		}else{
//			var data_yue = parseInt($(this).attr("data-date").substr(5,2));
//			var data_date = parseInt($(this).attr("data-date").substr(8,2));
//		}
//
//
//		var date = $(this).find(".information").attr("data-number");
//		var data_number = parseInt($(this).find(".information").attr("data-number").substr(8,2));
//		if(data_date < data_number){
//			var number = data_number - data_date
//		}else{
//			if(data_yue==1 || data_yue==3 || data_yue==5 || data_yue==7 || data_yue==8 || data_yue==10 || data_yue==12){
//				var number = (31-data_date)+data_number
//			}else if(data_yue==4 || data_yue==6 || data_yue==9 || data_yue==11){
//				var number = (30-data_date)+data_number
//			}else if(data_yue==2 && isLeapYear(year)){
//				var number = (29-data_date)+data_number
//			}else{
//				var number = (28-data_date)+data_number
//			}
//		}
//		var thisObj = this;
//		var day = number+1, startChange = false;
//		var tdObjs = $('#calendarDiv').find('table tbody td').each(function(i, ev){
//			if (this == thisObj) {
//				startChange = true;
//			}
//			if (startChange && day > 0) {
//				$(this).removeClass("bg_yellow");
//				day--;
//			}
//		});
	});
    
    //点击批次选中
	$(document).on('click', '.gogogo', function () {
		//高亮显示
        $(this).parents('#calendarDiv div').find('.gogogo').removeClass('bg-high-color');
        $(this).parents('#calendarDiv div').siblings().find('.gogogo').removeClass('bg-high-color');
        $(this).addClass('bg-high-color');
        
        //获取日历上被点击的日期
        var  dateNum = $(this).attr('data-date');
        if(parseInt(dateNum.substr(5,2)) < 10){
            var dateArr1 = dateNum.split('-');
            dateArr1[1] = '0' + dateArr1[1];
            dateNum = dateArr1.join('-');
        };
        if(parseInt(dateNum.substr(-2,2)) < 10){
            var dateArr2 = dateNum.split('-');
            dateArr2[2] = '0' + dateArr2[2];
            dateNum = dateArr2.join('-');
        };

        $('.cfrq_batch_list li').each(function(){
            //当日历所点击日期与下拉列表日期一致时
            if( dateNum == $(this).attr('data-val') ){
                $('.cfrq_select_batch').attr('data-id', $(this).attr('data-id'));
                $('.cfrq-show').removeClass('hidden_ctrl');
                $('.cfrq_select_batch').html($(this).html());
                var dObj = $('.cfrq-show').find('u');
                $(dObj[0]).html($(this).attr('data-val'));
                $(dObj[1]).html($(this).attr('data-end-date'));
            }
        });
        
        //设置套餐可选状态
		$('.tclx .taocan-list div').each(function(){
			$(this).removeClass();
			$(this).addClass('disabled');
		});
        var lineId = '<?php echo ($line["id"]); ?>';
        var mouth = $('#calendar_nav').find('span.active').attr("mouth");
		var year = $('#calendar_nav').find('span.active').attr("year");
		if(mouth <= 9){
			mouthnext= "0"+mouth
		}else{
			mouthnext= mouth
		}
		
		var batchId = $(this).attr('data-batch-id');		
        var jsonData = {
        	type:'find_taocan_batch',
        	line_id:lineId,
        	year:year+"-"+mouthnext,
        	batch_id:batchId,
        };
        $.post('<?php echo U("line/info");?>', jsonData, function(data){
        	console.log(data);
        	if (data.result.errno == 0) {
        		if (data.taocan_ids != null && typeof(data.taocan_ids) != 'undefined') {
                     for(i = 0; i < data.taocan_ids.length; i++){
					 	$('.tclx .taocan-list').find('div[data-id="'+data.taocan_ids[i]+'"]').removeClass();
					 }
                }
        	}
        });        
        
		initCalendarBatch(year+"-"+mouthnext);
    });
    
    $('.cfrq_batch_list li').on("click",function(){
    	$('#calendarDiv div').find('.gogogo').removeClass('bg-high-color');
        $('#calendarDiv div').siblings().find('.gogogo').removeClass('bg-high-color');
        
        var nianyue = $(this).attr("data-val");
        var nian = nianyue.substr(0,4);
        var yue =  nianyue.substr(5,2);
       	if(yue<10){
        	var yueyue = yue.substr(1,1);
        }else(
        	yueyue = yue
        )
        var ri =  nianyue.substr(8,2);
        if(ri<10){
        	var ri = ri.substr(1,1);
        }else(
        	ri = ri
        )
        var nianyueri = nian+"-"+yueyue+"-"+ri
        var spans = $("#calendar_nav span");
        
        if (!!document.getBoxObjectFor || window.mozInnerScreenX != null) {
	    	HTMLElement.prototype.__defineSetter__("outerText", function(sText) {
		        var parsedText = document.createTextNode(sText);
		        this.parentNode.replaceChild(parsedText, this);
		        return parsedText;
    		});
		    HTMLElement.prototype.__defineGetter__("outerText", function() {
		        var r = this.ownerDocument.createRange();
		        r.selectNodeContents(this);
		        return r.toString();
		    });
		}	
        for(var i=0;i<spans.length;i++){
        	var rilinian = spans[i].outerText.substr(0,4)
        	var panduanyue  = spans[i].outerText.substr(6,1)
        	if(panduanyue == "月"){
        		var riliyue = "0"+spans[i].outerText.substr(5,1)
        	}else{
        		var riliyue = spans[i].outerText.substr(5,2)
        	}
        	if(rilinian == nian && riliyue == yue){
        		spans[i].click();
        	}
        }
        var tds = $("#calendarDiv div").find("td");
        for(var j=0;j<tds.length;j++){
        	if(tds[j].dataset.date == nianyueri){
        		$(tds[j]).addClass("bg-high-color");
        	}
		}
    });
    	//前后追加日期
		function  addri(){
			var index = $(".calendar_nav").find(".active").index();
			var month = $(".calendar_nav").find(".active").attr("mouth");
			var number = 1;
			var tds = $("#calendarDiv div:visible").find("tr:first").find(".bg_black"); 
			var tdss = $("#calendarDiv div:visible").find("tr:nth-child(5)").find(".bg_black");
			var tdsss = $("#calendarDiv div:visible").find("tr:last").find(".bg_black")
			for(var a=0;a<tdsss.length;a++){
				tdss.push(tdsss[a]);
			}
			var daysanshiyi = 31-tds.length;
			var daysanshi = 30-tds.length;
			var dayershiba = 28-tds.length;
			if(month==2 || month==4 || month==6 || month==8 || month==9 || month==11 || month==1){
				for(var i=0;i<tds.length;i++){
					daysanshiyi++;
					$(tds[i]).find("span").html(daysanshiyi);
				}
			}else if(month==5 || month==7 || month==10 || month==12){
				for(var i=0;i<tds.length;i++){
					daysanshi++;
					$(tds[i]).find("span").html(daysanshi);
				}
			}else if(month==3){
				for(var i=0;i<tds.length;i++){
					dayershiba++;
					$(tds[i]).find("span").html(dayershiba);
				}
			}
			for(var d=0;d<tdss.length;d++){
				$(tdss[d]).find("span").html(number);
				number++;
			}
			
		}
		//右箭头
	$(".fa-angle-right").click(function(){
		var mouth = $(".calendar_nav").children("span[class=active]").attr("mouth");
		var year = $(".calendar_nav").children("span[class=active]").attr("year");
		 
		var mouthnext = $(".calendar_nav").children("span[class=active]").next().attr("mouth");
		var yearnext = $(".calendar_nav").children("span[class=active]").next().attr("year");
		 
		if(mouthnext <= 9){
			mouthnext= "0"+mouthnext
		}else{
			mouthnext= mouthnext
		}
		var index = $(".calendar_nav").children("span[class=active]").index();
		console.log(index);
		if(index>22 || index<0 || isNaN(index)){
			$(".calendar_nav").children().eq(23).addClass("active").show();
			$(".calendar_content").children().eq(23).show();
			e.stopPropagation();
			return false;
		}
		$(".calendar_nav").children().removeClass("active");
		$(".calendar_nav").children().eq(index+1).addClass("active").show();

		$(".calendar_content").children().hide();
		$(".calendar_content").children().eq(index+1).show().addClass("load-right");
		$(".calendar_content").children().eq(index).addClass("load-right");
		if(index>=5){
			$(".calendar_nav").children().eq(index-5).hide();
		}
		if($(".calendar_content").children().eq(index+1).hasClass("load-left") || $(".calendar_content").children().eq(index+1).hasClass("load")){
		}else{
			showDate($(".calendar_content").children().eq(index+1)[0],$(".calendar_nav").children("span[class=active]").attr("year"),$(".calendar_nav").children("span[class=active]").attr("mouth"),true);
			if(index>=5){
				$(".calendar_nav").children().eq(index-5).hide();
			}
			
		}
		// 初始化批次信息
		initCalendarBatch(yearnext+"-"+mouthnext);
		console.log(yearnext+"-"+mouthnext);
		addri();
	 });
	 
	 //左箭头
	 $(".fa-angle-left").click(function(){
		 var mouth = $(".calendar_nav").children("span[class=active]").attr("mouth");
		 var year = $(".calendar_nav").children("span[class=active]").attr("year");
		 
		 var mouthnext = $(".calendar_nav").children("span[class=active]").prev().attr("mouth");
		 var yearnext = $(".calendar_nav").children("span[class=active]").prev().attr("year");
		 
		 if(mouthnext <= 9){
		 	mouthnext= "0"+mouthnext
		 }else{
		 	mouthnext= mouthnext
		 }
		 
		 var index = $(".calendar_nav").children("span[class=active]").index();
		 console.log(index)
		 if(index==0 || isNaN(index)){
			 $(".calendar_nav").children().eq(0).addClass("active").show();
			 $(".calendar_content").children().eq(0).show();
			 e.stopPropagation();

			 return false;
		 }
		 $(".calendar_nav").children().slice(index,index+7).show();
		 $(".calendar_nav").children().removeClass("active");
		 $(".calendar_nav").children().eq(index-1).addClass("active").show();
		 $(".calendar_content").children().hide();
		 $(".calendar_content").children().eq(index-1).show().addClass("load-left");
		 $(".calendar_content").children().eq(index).addClass("load-left");
		 if($(".calendar_content").children().eq(index-1).hasClass("load-right") || $(".calendar_content").children().eq(index-1).hasClass("load")){
//		 	console.log(index-1)
		 }else{
		 	showDate($(".calendar_content").children().eq(index-1)[0],$(".calendar_nav").children("span[class=active]").attr("year"),$(".calendar_nav").children("span[class=active]").attr("mouth"),true);
			 if(index>11){
				 $(".calendar_nav").children().eq(index+7).hide();
			 }
			 
		 }
		 // 初始化批次信息
         initCalendarBatch(yearnext+"-"+mouthnext);
         console.log(yearnext+"-"+mouthnext);
         addri();
	 });
	 
	 //点击月份
	 $("#calendar_nav").on("click","span",function(){
		 var mouth = $(this).attr("mouth");
		 var year = $(this).attr("year");
		 
		 if(mouth <= 9){
		 	mouthnext= "0"+mouth
		 }else{
		 	mouthnext= mouth
		 }
		 var index = $(this).index();
		 console.log(index)
		 if(index==0 || isNaN(index)){
			 $(".calendar_nav").children().eq(0).addClass("active").show();
			 $(".calendar_content").children().eq(0).show();
			 e.stopPropagation();

			 return false;
		 }
		 $(".calendar_nav").children().slice(index,index+7).show();
		 $(".calendar_nav").children().removeClass("active");
		 $(this).addClass("active").show();
		 $(".calendar_content").children().hide();
		 $(".calendar_content").children().eq(index).show();
		 if($(".calendar_content").children().eq(index).hasClass("load") || $(".calendar_content").children().eq(index).hasClass("load-left") ||$(".calendar_content").children().eq(index).hasClass("load-right")){
		 }else{
		 	showDate($(".calendar_content").children().eq(index)[0],$(".calendar_nav").children("span[class=active]").attr("year"),$(".calendar_nav").children("span[class=active]").attr("mouth"),true);
			 if(index>11){
				 $(".calendar_nav").children().eq(index+7).hide();
			 }
			 
		 }
		 // 初始化批次信息
         initCalendarBatch(year+"-"+mouthnext);
         console.log(year+"-"+mouthnext);
		 $(".calendar_content").children().eq(index).addClass("load");
		 addri();
	 });
	   
 	
</script>
<script>
    //摄影游，民族行，深度游
    $('.bread-nav u a').each(function(){
        if($(this).text() == '摄影游') {
            $(this).addClass('sheying');
        }else if($(this).text() == '民族行'){
            $(this).addClass('zhuti');
        }
    });


    //识别中文二维码
    var oUrl = window.location.href;
    function toUtf8(oUrl) {
        var out, i, len, c;
        out = "";
        len = str.length;
        for(i = 0; i < len; i++) {
            c = str.charCodeAt(i);
            if ((c >= 0x0001) && (c <= 0x007F)) {
                out += str.charAt(i);
            } else if (c > 0x07FF) {
                out += String.fromCharCode(0xE0 | ((c >> 12) & 0x0F));
                out += String.fromCharCode(0x80 | ((c >>  6) & 0x3F));
                out += String.fromCharCode(0x80 | ((c >>  0) & 0x3F));
            } else {
                out += String.fromCharCode(0xC0 | ((c >>  6) & 0x1F));
                out += String.fromCharCode(0x80 | ((c >>  0) & 0x3F));
            }
        }
        return out;
    }

    $('.weixin').click(function(){
        if($(".share-code").css('display') != 'none'){
            return false;
        }else{
            $(".share-code").show();
        }

        $("#code").qrcode({
            render: "canvas", //canvas方式
            width: 185, //宽度
            height:185, //高度
            text: oUrl //任意内容
        });
    });

    $('.share-code > h4 a').click(function(){
        $('.share-code').hide();
        $('#code').html('');
    });

    //详情点击
    $('#xcgy em').click(function(){
        $("html,body").animate({scrollTop: $('.travel-arrangements').offset().top - 200}, 500);
    });

	//套餐类型
	$(".tclx .taocan-list div").on("click",function(){
		if ($(this).hasClass('disabled')) {
			return false;
		}
		var number = $(this).attr("data-date")
		if(number == 1){
			$(this).addClass("disabled")
		}else{
			$(this).toggleClass("active").siblings().removeClass("active");
		}
		
		var mouth = $('#calendar_nav').find('span.active').attr("mouth");
		var year = $('#calendar_nav').find('span.active').attr("year");
		if(mouth <= 9){
			mouthnext= "0"+mouth
		}else{
			mouthnext= mouth
		}
		initCalendarBatch(year+"-"+mouthnext);		
	});

	
    $('.alert-modal-top a').click(function(){
        $('.mark').hide();
        $('#alert-modal').hide();
    });

    // 在线咨询
    $('.immediate-reservation').find('.zixun').click(function(){
        window.open('<?php echo ($pcset["askfor_link"]); ?>');
    });

    // 立即预定
    $('.book_order_now').click(function(){
        var batchId = $('.cfrq_select_batch').attr('data-id');
        if (batchId == '0') {
            $('.mark').show()
            $('#alert-modal').show();
            $('#alert-modal').find('p').html('请选择出行的日期');
            setTimeout(function(){
                $('.mark').hide()
                $('#alert-modal').hide();
            },3000);
            //alert('请选择出行的日期');
            return false;
        }
        var male = parseInt($('.adult_male').find('input').val());
        var woman = parseInt($('.adult_woman').find('input').val());
        var child = parseInt($('.children-num').find('input').val());
        if ((male + woman + child) == 0) {
            $('.mark').show()
            $('#alert-modal').show();
            $('#alert-modal').find('p').html('出行的总人数不能小于1人');
            setTimeout(function(){
                $('.mark').hide()
                $('#alert-modal').hide();
            },3000);
            //alert('出行的总人数不能小于1人');
            return false;
        }
        //套餐选中
        var taocanIds = '|';
		$('.tclx .taocan-list').find('div.active').each(function(){
			taocanIds += $(this).attr('data-id') + '|';
		});
		var tpUrlStr = '';
		if (taocanIds != '|') {
        	tpUrlStr = '/tpids/'+taocanIds;
        }
        
        if ('<?php echo ($duid); ?>' != '') {
            location.href = '<?php echo U("line/order");?>'+'/id/<?php echo ($line["id"]); ?>/duid/<?php echo ($duid); ?>/type/create/b/'+batchId+'/m/'+male+'/w/'+woman+'/ch/'+child+tpUrlStr;
        } else {
            location.href = '<?php echo U("line/order");?>'+'/id/<?php echo ($line["id"]); ?>/type/create/b/'+batchId+'/m/'+male+'/w/'+woman+'/ch/'+child+tpUrlStr;
        }
    });
    function testBatchClick(liObj) {
        $('.cfrq_select_batch').attr('data-id', $(liObj).attr('data-id'));
        $('.cfrq_select_batch').html($(liObj).html());
        $('.cfrq-show').removeClass('hidden_ctrl');
        var uObj = $('.cfrq-show').find('u');
        $(uObj[0]).html($(liObj).attr('data-val'));
        $(uObj[1]).html($(liObj).attr('data-end-date'));
        //高亮显示
        var dateNum = $(liObj).attr('data-val');
        var dateArray2 = [];
        dateArray2 = dateNum.split('-');
        if(parseInt(dateArray2[1])<10){
            dateArray2[1] = dateArray2[1].replace('0','');
        }
        if(parseInt(dateArray2[2])<10){
            dateArray2[2] = dateArray2[2].replace('0','');
        }
        dateNum = dateArray2.join('-');
        $('.jcDateColor').each(function(){
            if(dateNum == $(liObj).attr('data-date')){
                $(liObj).addClass('bg-high-color');
            }
        });
    }
    $(function(){
        // 批次列表选择跳转
        $('.cfrq_batch_list').find('li').click(function(){
            testBatchClick($(this));
        });
    });
    // 页面加载完成
    $(document).ready(function(){
        var schedule = '<?php echo ($schedule); ?>';
        if (schedule != 'undefined') {
            $('html, body').stop().animate({scrollTop: $('.travel-arrangements-content').offset().top - 160 }, 0);
        }
        var fireJumped = false;
        $('.cfrq_batch_list').find('li').each(function(i, ev){
            var batchState = $(this).attr('data-state');
            if (batchState != 'line_batch_state_overdue') {
                if (fireJumped == false) {
                    $(this).trigger('click');
                    fireJumped = true;
                }
            }
        });
        
        // 初始化批次信息
        /*var d = new Date();
        var year = d.getFullYear();
        initCalendarBatch(year+"-"+Smonth);*/
        
        //初始化问题
        changeQuestionPage();
    });
        
    //鼠标移出，下拉框收起
    $('.cfrq-choose').mouseleave(function(){
        $('.cfrq-choose').find('ul').hide();
    });

	//批次选择
	$('.cfrq-choose span').click(function(){
		$('.cfrq_batch_list').show();
	});
    
    //计算两天相差
    function diy_time(time1,time2){
	    time1 = Date.parse(new Date(time1));
	    time2 = Date.parse(new Date(time2));
	    return time3 = Math.abs(parseInt((time2 - time1)/1000/3600/24));
	}
    
    //搜索栏
    $('.search-header input').focus(
        function () {
            $(this).parent().animate({width: '240px'}, 1000);
            $(this).parent().animate({marginRight: '17px'}, 1000);
        }
    );
    $('.search-header input').blur(
        function () {
            $(this).parent().animate({width: '220px'}, 1000);
            $(this).parent().animate({marginRight: '17px'}, 1000);
        }
    );
    //显示与隐藏
    $('.nav-list-top').showAndHide();
    //鼠标移出，下拉框收起
    $('.cfrq-choose').mouseleave(function(){
        $('.cfrq-choose').find('ul').hide();
    });
    //起价说明
    $('.right-content-money > a').hover(
        function () {
            $('.qj-explain').show();
        } ,
        function () {
            $('.qj-explain').hide();
        }
    );
    // 产品主题类型浮动框
    $('.shendu').hover(
        function () {
            $('.qj-box').show();
        } ,
        function () {
            $('.qj-box').hide();
        }
    );
    $('.qj-explain').hover(
        function () {
            $(this).show();
        },
        function () {
            $(this).hide();
        }
    );
    $('.qj-box').hover(
        function () {
            $(this).show();
        },
        function () {
            $(this).hide();
        }
    );
    //儿童标准
    $('.child-standard').hover(
        function () {
            $('.childern-explain').show();
        } ,
        function () {
            $('.childern-explain').hide();
        }
    );
    $('.childern-explain').hover(
        function () {
            $(this).show();
        },
        function () {
            $(this).hide();
        }
    );
    //出游人数选择
    $("#cyrs div input").focus(function(){
    	$(this).parent("div").siblings().find("input").next("ul").hide();
    	$(this).next("ul").show();
    });
    //选择出游人数
    $("#cyrs div ul li").on("click",function(){
    	var number = $(this).html();
    	if(number == "&gt;9"){
    		$(this).parent("ul").prev("input").val("");
    		$(this).parent("ul").prev("input").focus();
    		$(this).parent("ul").prev("input").attr("placeholder","请输入");
    	}else(
    		$(this).parent("ul").prev("input").val(number)
    	)
    	$(this).parent("ul").hide();
    });
    //days图片描述
    $('.days-img-left').hover(
        function () {
            $(this).children('p').stop().animate({ bottom: '0' }, 500);
        },
        function () {
            $(this).children('p').stop().animate({ bottom: '-42px' }, 500);
        }
    );
    //游记
    $('.travel-notes-lunbo').unslider({
        dots: true
    });
    //精彩专题
    $('.special-exhibition').unslider({
        dots: true
    });
    $('.special-exhibition-product').fadeInAndOut('special-img', 'div');
    //专业保证
    var unslider01 = $('.professional-guarantee-slide').unslider({
            dots: true
        }),
        data04 = unslider01.data('unslider');
    $('.unslider-arrow01').click( function() {
        var fn = this.className.split(' ')[1];
        data04[fn]();
    });
    //提问
    $(document).on('click','.question i',function(){
        $(this).addClass('question-zan');
        var zanNum = parseInt($(this).parents('.question-answer').children('.answer').find('i').html());
        zanNum++;
        $(this).parents('.question-answer').children('.answer').find('i').html(zanNum);
    });
    var question_help_end = false, question_new_end = false;
    $('.question-choose a').click( function () {
        $(this).addClass('question-checked');
        $(this).siblings().removeClass('question-checked');
        // 切换page页面
        changeQuestionPage();
    });
    $('.question-help').clickShow('.question-help-content');
    $('.question-new').clickShow('.question-new-content');
    // 提问
    $('.ask_question').click(function(){
        var lineId = '<?php echo ($line["id"]); ?>';
        var cnt = $('#question_content').val();
        if (cnt == '') {
//				toastr.error('不能提交空问题哦');
            $('.mark').show()
            $('#alert-modal').show();
            $('#alert-modal').find('p').html('不能提交空问题哦!');
            setTimeout(function(){
                $('.mark').hide()
                $('#alert-modal').hide();
            },3000);
            return false;
        }
        var jsonData = {
            op_type: 'create_line_question',
            line_id: lineId,
            content: cnt,
        }
        $.post('<?php echo U("line/question");?>', jsonData, function(data){
            if (data.result.errno == 0) {
                $('#question_content').val('');
            }
            $('.mark').show();
            $('#alert-modal').show();
            $('#alert-modal').find('p').html(data.result.message);
            $('.alert-modal-top a').click(function(){
                $('.mark').hide();
                $('#alert-modal').hide();
                if (data.jumpUrl != null) {
                    location.href = data.jumpUrl;
                }
                clearTimeout(timer);
            });
            var timer = setTimeout(function(){
                $('.mark').hide()
                $('#alert-modal').hide();
                if (data.jumpUrl != null) {
                    location.href = data.jumpUrl;
                }
            },3000);
        });
    });
    // 获取问题列表
    function changeQuestionPage() {
        var lineId = '<?php echo ($line["id"]); ?>';
        var containerObj = $('.question-checked').hasClass('question-help') ? '.question-help-content' : '.question-new-content';
        var questType = $('.question-checked').hasClass('question-help') ? 'help' : 'new';
        var jsonData = {
            op_type: 'list',
            query_type: questType,
            start: $(containerObj).find('.question-answer').length,
            line_id: lineId,
        }
        $.post('<?php echo U("line/question");?>', jsonData, function(data){
            if (data.result.errno == 0) {
                if (data.ds != null && data.ds != 'undefined') {
                    for (var i = 0; i < data.ds.length; i ++) {
                        var d = data.ds[i];
                        var rootObj = $('.template_question').clone();
                        $(rootObj).removeClass('template_question');
                        $(rootObj).addClass('question-answer');
                        $(rootObj).addClass(i % 2 == 0 ? 'question-answer-left' : 'question-answer-right');
                        $(rootObj).css('display', 'block');
                        $(rootObj).find('.good').attr('data-id', d.q1_id);
                        $(rootObj).find('.question_content').html(d.q1_content_show);
                        $(rootObj).find('.question_content').attr('href', '<?php echo U("service/question");?>/id/'+d.q1_id);
                        $(rootObj).find('.question_time').html(d.q1_time_show.ago_show_text);
                        $(rootObj).find('.question_agree').html(d.q1_agree);
                        $(rootObj).find('.answer_content').html(d.q2_content);
                        $(rootObj).find('.answer_time').html(d.q2_time_show.ago_show_text);
                        $(rootObj).find('.good').click(agreementQuestion);
                        $(containerObj).append(rootObj);
                    }
                    $('.question-all-look').find('a').removeClass('no_more');
                    $('.question-all-look').find('a').html('查看更多已回答的问题');
                } else {
                    $('.question-all-look').find('a').addClass('no_more');

                    $('.question-all-look').find('a').html('没有更多问题可供查看');
                }
            } else {
                console.log(data.result.message);
                if (data.jumpUrl != null) {
                    location.href = data.jumpUrl;
                }
            }
        });
    }
    // 点击翻页
    $('.question-all-look').find('a').click(function(){
        if ($(this).hasClass('no_more') == false) {
            changeQuestionPage();
        }
    });
    var agreenQuestionIds = [];
    // 问题点赞
    function agreementQuestion() {
        var questionId = $(this).attr('data-id');
        for (var i = 0; i < questionId; i ++) {
            if (agreenQuestionIds[i] == questionId) {
                $('.mark').show()
                $('#alert-modal').show();
                $('#alert-modal').find('p').html('您已经对该问题点过赞了，谢谢您的支持!');
                setTimeout(function(){
                    $('.mark').hide()
                    $('#alert-modal').hide();
                },3000);
                return false;
            }
        }
        var agreeObj = $(this).closest('.question-answer').find('.question_agree');
        $.post('<?php echo U("line/question");?>', {op_type:'agree', id: questionId}, function(data){
            if (data.result.errno == 0) {
                if (data.ds != null) {
                    $(agreeObj).html(data.ds.agree);
                }
                agreenQuestionIds.push(questionId);
            } else {
                $('.mark').show()
                $('#alert-modal').show();
                $('#alert-modal').find('p').html(data.result.message);
                setTimeout(function(){
                    $('.mark').hide()
                    $('#alert-modal').hide();
                },3000);
                //alert(data.result.message);
            }
        });
    };

    //点击线路成交量弹出
    $('#xlcjl').click( function () {
        $("html,body").animate({scrollTop: 0}, 500);
        $('.enrol-mark').show();
        $('.enrol-list').show();
    } );
    //点击遮罩层隐藏
    $('.enrol-mark').click( function () {
        $('.enrol-mark').hide();
        $('.enrol-list').hide();
    } );
    //点击关闭按钮隐藏
    $('.close-enrol-list').click( function () {
        $('.enrol-mark').hide();
        $('.enrol-list').hide();
    } );
    //列表回到顶部
    $('.backTop-enrol-list').click( function () {
        $("html,body").animate({scrollTop: 0}, 500);
    });
    //下部立即预定返回顶部
    $('.content-list-to-reserve').click(function(){
        $("html,body").animate({scrollTop: 120}, 500);
    });
</script>
<script>
    //滚动文字
    $(function(){
        //1文字轮播(2-5页中间)开始
        $(".font_inner li:eq(0)").clone(true).appendTo($(".font_inner"));//克隆第一个放到最后(实现无缝滚动)
        var liHeight = $(".swiper_wrap").height();//一个li的高度
        //获取li的总高度再减去一个li的高度(再减一个Li是因为克隆了多出了一个Li的高度)
        var totalHeight = ($(".font_inner li").length *  $(".font_inner li").eq(0).height()) -liHeight;
        $(".font_inner").height(totalHeight);//给ul赋值高度
        var index = 0;
        var autoTimer = 0;//全局变量目的实现左右点击同步
        var clickEndFlag = true; //设置每张走完才能再点击
        function tab(){
            $(".font_inner").stop().animate({
                top: -index * liHeight
            },400,function(){
                clickEndFlag = true;//图片走完才会true
                if(index == $(".font_inner li").length -1) {
                    $(".font_inner").css({top:0});
                    index = 0;
                }
            })
        };
        function nextword() {
            index++;
            if(index > $(".font_inner li").length - 1) {
                //判断index为最后一个Li时index为0
                index = 0;
            }
            tab();
        };
        function prevword() {
            index--;
            if(index < 0) {
                index = $(".font_inner li").size() - 2;//因为index的0 == 第一个Li，减二是因为一开始就克隆了一个LI在尾部也就是多出了一个Li，减二也就是_index = Li的长度减二
                $(".font_inner").css("top",- ($(".font_inner li").size() -1) * liHeight);//当_index为-1时执行这条，也就是走到li的最后一个
            }
            tab();
        };
        //自动轮播
        autoTimer = setInterval(nextword,3000);
        $(".font_inner a").hover(function(){
            clearInterval(autoTimer);
        },function() {
            autoTimer = setInterval(nextword,3000);
        });
    })

    $("embed").on("click",function(){
        $(this).next("img").hide();
    })
    
    var Sindex = $("#calendar_nav .active").index();
	    $("#calendarDiv").find("div").eq(Sindex).addClass("load");
//	    console.log(Sindex);
</script>
<script>
	
</script>