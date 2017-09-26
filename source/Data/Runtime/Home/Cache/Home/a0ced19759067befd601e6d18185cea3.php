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
<link rel="stylesheet" href="/source/Static/qinglvpai/css/bootstrap.min.css">
<link rel="stylesheet" href="/source/Static/qinglvpai/css/animate.css">
<link rel="stylesheet" href="/source/Static/qinglvpai/css/style/style.css">
<link rel="stylesheet" href="/source/Static/qinglvpai/css/style.css">
<style>
    .list-group .line{padding-top:25px;}
    body { background-color: #ffffff; font-size:12px; }
    .nav02 { margin-top:-10px; }
    .nav-list .go-welcome img { vertical-align: inherit; }
    .search-header input { width: 171px; height: 35px; padding: 8px 0; padding-left: 35px; outline: none; line-height: 15px; font-family: '微软雅黑'; font-size: 14px; }
    a { text-decoration: none !important;}
</style>
<style>
    body { background-color: #ffffff; font-size:12px; }
    .nav02 { margin-top:-10px; }
    .nav-list .go-welcome img { vertical-align: inherit; }
    .search-header input { width: 171px; height: 35px; padding: 8px 0; padding-left: 35px; outline: none; line-height: 15px; font-family: '微软雅黑'; font-size: 14px; }
    a { text-decoration: none !important;}
    
	.vui-slider .vui-item{ background: #333;text-align: center;text-align: -webkit-center; }
	.product-number { margin-top:126px; }
	.product-detail .right p{margin-bottom:0px;}
</style>
<!--产品编号-->
<div class="product-number">
    <span class="orange" style="padding:10px 0px;">产品编号：<?php echo ($line["id"]); ?></span>
    <span style="padding:10px 0px;">本产品由每刻美跟拍游独立策划并独立发团 <span id="block" style="cursor: pointer;"><img src="/source/Static/qinglvpai/images/index/careful.png" alt=""></span></span>
	<span id="none" style="position: relative;display:none;">
		<span style="background: #f3f5f7;padding:10px 5px;margin-left:10px;">每刻美是领袖户外旗下专注于女性旅行的子品牌，是跟拍游的开创者。</span>
		<span style="position: absolute;top:7px;left:3px;width:0;height:0;border-top:10px solid transparent;border-bottom:10px solid transparent;border-right:10px solid #f3f5f7;"></span>
	</span>
</div>
<!--产品详情-->
<div style="background:#f3f5f7;">
    <div class="product-detail">
        <div class="left">
            <img class="img-responsive" src="<?php echo ($line["img1"]); ?>" alt="">
        </div>
        <div class="right">
            <h2><?php echo ($line["title"]); ?></h2>
            <h4><?php echo ($line["subheading"]); ?></h4>
            <div class="div">
            	<?php if(empty($line['check_price'])): ?>核算中
            	<?php else: ?>
            		<span class="price">￥<?php echo ($line["start_price_adult"]); ?></span>元起 <span style="padding-left:20px;">(<?php echo ($line["start_price_child"]); ?>元起/儿童)</span><?php endif; ?>
            </div>
            <div class="div div1">成团人数：<span><?php echo ($line["success_team_count"]); ?></span>人 &nbsp;&nbsp; 满团人数：<span><?php echo ($line["max_team_count"]); ?></span>人</div>
            <div class="div div1">集合地点：<span><?php echo ($line["assembly_point_show_text"]); ?></span></div>
            <div class="div div1 volume">
                <div>线路成交量：<span><?php echo ($order_member_count); ?></span></div>
                <ul class="font_inner">
					<?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order_list): $mod = ($i % 2 );++$i; if(is_array($order_list["data"])): $i = 0; $__LIST__ = $order_list["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><li><a href="javascript:;">用户<?php echo ($order["mob_show"]); ?>预订<?php echo ($order["hdid_data"]["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="message">产品寄语：<?php echo ($line["send_word"]); ?></div>
            <div class="time-number">
                <div class="time">
                    <span>出发日期：</span>
                    <select name="select_batch" id="select_batch">
                        <option value="0">请选择出发日期</option>
						<?php foreach($line['batchs'] as $bk=>$bv) { echo('<option value="'.$bv['id'].'">'.$bv['start_date_show'].'['.$bv['state_data']['type_desc'].']</option>'); } ?>
                    </select>
                </div>
                <div class="number">
                    <span class="span">出游人数：</span>
                    <div>
						<?php if(empty($check['only_child']) == true): ?><div class="man">
	                            <span class="span-two">成人男</span>
	                            <div>
	                                <span class="reduce">-</span>
	                                <span class="number">0</span>
	                                <span class="add">+</span>
	                            </div>
	                        </div>
	                        <div class="woman">
	                            <span class="span-two">成人女</span>
	                            <div>
	                                <span class="reduce">-</span>
	                                <span class="number">0</span>
	                                <span class="add">+</span>
	                            </div>
	                        </div><br/><?php endif; ?>
						<?php if(empty($check['only_adult']) == true): ?><div class="children">
	                            <span class="span-two">儿&nbsp;&nbsp;&nbsp;童</span>
	                            <div>
	                                <span class="reduce">-</span>
	                                <span class="number">0</span>
	                                <span class="add">+</span>
	                            </div>
	                        </div><?php endif; ?>
                    </div>
                </div>
            </div>
			<p>本产品在线咨询讨论QQ群：<?php echo ($line["seek_qq"]); ?></p>
            <div class="consult">
                <img class="tel" src="/source/Static/qinglvpai/images/index/tel.png" alt="">
                <div class="reserve">
                    <a href="javascript:;"><img src="/source/Static/qinglvpai/images/index/zx2.gif" alt=""></a>
                    <a type="button" class="btn btn-orange book_order_now">立即预定</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--行程亮点-->
<div class="highlights" id="liangdian">
    <h2 class="tit">行程亮点</h2>
    <div class="border-bottom"><!-此div只用于显示birder-></div>
    <?php if(is_array($line["points"])): $i = 0; $__LIST__ = $line["points"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$point): $mod = ($i % 2 );++$i; if($point["image_url"] != ''): ?><a href="javascript:;"><img src="<?php echo ($point["image_url"]); ?>" style="width: 1000px;" alt=""></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>

<!--行程说明-->
<div class="highlights explain" id="shuoming">
    <h2 class="tit">行程说明</h2>
    <div class="border-bottom"><!-此div只用于显示birder-></div>
	<?php if(is_array($line["travels"])): $i = 0; $__LIST__ = $line["travels"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$travel): $mod = ($i % 2 );++$i; if($key == 0): ?><div class="module">
		<?php else: ?>
	    <div class="module module-two"><?php endif; ?>
        	<?php if($key % 2 == 0): ?><div class="left">
	        		<?php if(empty($travel['img1']) == false): ?><a href="javascript:;"><img src="<?php echo ($travel['img1']); ?>" style="width: 600px;height: 450px;" alt=""></a>
	        		<?php elseif(empty($travel['img2']) == false): ?>
	        			<a href="javascript:;"><img src="<?php echo ($travel['img2']); ?>" style="width: 600px;height: 450px;" alt=""></a>
	        		<?php elseif(empty($travel['img3']) == false): ?>
	        			<a href="javascript:;"><img src="<?php echo ($travel['img3']); ?>" style="width: 600px;height: 450px;" alt=""></a>
	        		<?php else: ?>
	        			<a href="javascript:;"><img style="width: 600px;height: 450px;" alt=""></a><?php endif; ?>
		        </div>
        		<div class="right">
					<?php if($key == 0): ?><div class="active" style="background:#ff1c77">
					<?php else: ?>
		            <div class="active"><?php endif; ?>
		                <h2>Day<?php echo ($travel["day_id"]); ?>：<?php echo ($travel["title"]); ?></h2>
						<?php if(!empty($travel["view_point"])): ?><h4>浏览重点：<?php echo ($travel["view_point"]); ?></h4><?php endif; ?>
		                <div class="show height"><?php echo ($travel["intro"]); ?></div>
		                <h4>
		                	<?php if(!empty($travel["hotel"])): ?>住宿：<?php echo ($travel["hotel"]); endif; ?>
							<?php if(!empty($travel["eat_way"])): ?>餐饮：<?php echo ($travel["eat_way"]); endif; ?>
						</h4>
						<?php if(!empty($travel["kindly_reminder"])): ?><div class="prompt activ">温馨提示：<br/><span><?php echo ($travel["kindly_reminder"]); ?></span></div><?php endif; ?>
		            </div>
					<span class="none"><i class="iconfontyyy">&#xe610;</i></span>
		            <i class="iconfontyyy left-top">&#xe609;</i>
        		</div>
        	<?php else: ?>
        		<div class="right">
		            <div class="active">
		                <h2>Day<?php echo ($travel["day_id"]); ?>：<?php echo ($travel["title"]); ?></h2>
						<?php if(!empty($travel["view_point"])): ?><h4>浏览重点：<?php echo ($travel["view_point"]); ?></h4><?php endif; ?>
		                <div class="show height"><?php echo ($travel["intro"]); ?></div>
		                <h4>
		                	<?php if(!empty($travel["hotel"])): ?>住宿：<?php echo ($travel["hotel"]); endif; ?>
							<?php if(!empty($travel["eat_way"])): ?>餐饮：<?php echo ($travel["eat_way"]); endif; ?>
						</h4>
						<?php if(!empty($travel["kindly_reminder"])): ?><div class="prompt">温馨提示：<br/><span><?php echo ($travel["kindly_reminder"]); ?></span></div><?php endif; ?>
		            </div>
					<span class="none"><i class="iconfontyyy">&#xe610;</i></span>
		            <i class="iconfontyyy left-top">&#xe609;</i>
        		</div>
		        <div class="left">
	        		<?php if(empty($travel['img1']) == false): ?><a href="javascript:;"><img src="<?php echo ($travel['img1']); ?>" style="width: 600px;height: 450px;" alt=""></a>
	        		<?php elseif(empty($travel['img2']) == false): ?>
	        			<a href="javascript:;"><img src="<?php echo ($travel['img2']); ?>" style="width: 600px;height: 450px;" alt=""></a>
	        		<?php elseif(empty($travel['img3']) == false): ?>
	        			<a href="javascript:;"><img src="<?php echo ($travel['img3']); ?>" style="width: 600px;height: 450px;" alt=""></a>
	        		<?php else: ?>
	        			<a href="javascript:;"><img style="width: 600px;height: 450px;" alt=""></a><?php endif; ?>
		        </div><?php endif; ?>
	    </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<!--费用详情、预定须知-->
<div class="expense-details">
    <div class="tit">
        <div class="left">
            <span class="active">费用详情</span>
        </div>
        <div class="right">
            <span>预定须知</span>
        </div>
    </div>
    <div class="background">
        <div class="detail cost">
        	<?php echo ($line["cost_description"]); ?>
            <div class="top"><!-此div只用于显示三角形-></div>
        </div>
        <div class="detail notice">
        	<?php echo ($line["booking_notes"]); ?>
            <div class="top"><!-此div只用于显示三角形-></div>
        </div>
    </div>
</div>

<!--沿途风光-->
<div class="highlights scenery">
    <h2 class="tit">沿途风光</h2>
    <div class="border-bottom"><!-此div只用于显示birder-></div>
    <div class="content">
        <div id="slider" style="width:818px;">
			<?php if(is_array($scenery)): $i = 0; $__LIST__ = $scenery;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sc): $mod = ($i % 2 );++$i;?><span>
	                <a href="javascript:;">
						<div style="background-image: url(<?php echo ($sc["image"]); ?>);height:625px;background-repeat: no-repeat;background-position: center center;"></div>
						<!--<img id="center-top" src="<?php echo ($sc["image"]); ?>"/>-->
						</a>
	                <?php if(!empty($sc["text"])): ?><div style="position:absolute;left:0px;bottom:0px;height:60px;line-height:60px;width:1000px;padding:0px 30px;background:rgba(0,0,0,.5);color:#fff;font-size: 14px;"><?php echo ($sc["text"]); ?></div><?php endif; ?>
	            </span><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>

<!--私人定制-->
<div class="customized">
    <h1 style="color:#fff;">上述产品不满足您的需求？</h1>
    <h3>欢迎填写下表提交，即刻联系每刻美新旅拍的私人旅行顾问</h3>
    <h3>我们将为您和您的亲友量身定制专属行程</h3>
    <a type="button" href="<?php echo U('line/book');?>" target="_blank" class="btn btn-customized">私人定制</a>
</div>

<!--左侧定位导航-->
<div class="left-aside" id="left-aside">
    <div class="left-aside-problem active">行 程<br>亮 点</div>
    <div class="left-aside-explain">行 程<br>说 明</div>
    <div class="left-aside-detail">费 用<br>详 情</div>
    <div class="left-aside-reserve">预定<br>须知</div>
    <div class="left-aside-scenery">沿 途<br>风 光</div>
</div>

<script type="text/javascript" src="/source/Static/qinglvpai/js/vmc.slider.full.min.js"></script>
<script>
    //头部点击选中状态
    $(".header ul a").on("click",function(){
        $(this).addClass("active").siblings("a").removeClass("active");
    })
	//
    $('#block').hover(
        function () {
            $('#none').show();
        } ,
        function () {
            $('#none').hide();
        }

    );


    //预订用户滚动显示
    $(function(){
        $(".font_inner li:eq(0)").clone(true).appendTo($(".font_inner"));//克隆第一个放到最后(实现无缝滚动)

        var liHeight = $(".volume").height();                            //一个li的高度

        var totalHeight = ($(".font_inner li").length * $(".font_inner li").eq(0).height()) -liHeight;

        $(".font_inner").height(totalHeight);//给ul赋值高度

        var index = 0;

        function tab(){
            $(".font_inner").stop().animate({
                top: -index * liHeight
            },400,function(){
                if(index == $(".font_inner li").length -1) {
                    $(".font_inner").css({top:0});
                    index = 0;
                }
            })
        };

        function topword() {
            index++;
            if(index > $(".font_inner li").length - 1) {
                //判断index为最后一个Li时index为0
                index = 0;
            }
            tab();
        };

        autoTimer = setInterval(topword,3000);
        $(".font_inner li").hover(function(){
            clearInterval(autoTimer);
        },function() {
            autoTimer = setInterval(topword,3000);
        });
    })
    //人数递减
    $(".reduce").on("click",function(){
        var temp = $(this);
        var number = temp.next(".number").html();
        number--;
        if($(this).next(".number").html()=="0"){
            return false;
        }else{
            temp.next(".number").html(number);
        }
    })
    //人数递增
    $(".add").on("click",function(){
        var temp = $(this);
        var number = temp.prev(".number").html();
        number++;
        temp.prev(".number").html(number);
    })

    //行程说明鼠标滑入显示详情
    $(document).ready(function(){
        $(".explain .right").mouseover(function(){
            var p=$(this).find(".show");
            p.removeClass("height");
            $(this).find(".none").hide();

            $(this).find(".prompt").removeClass("activ");
        })
    })
    //行程说明鼠标滑出收起详情
    $(document).ready(function(){
        $(".explain .right").mouseout(function(){
            var p=$(this).find(".show");
            p.addClass("height")
            $(this).find(".none").show();

            $(this).find(".prompt").addClass("activ");
        })
    })

    //费用详情、预定须知切换
    $(".expense-details .left span").on("click",function(){
        $(".background .cost").show();
        $(".background .notice").hide();
    })
    $(".expense-details .right span").on("click",function(){
        $(".background .notice").show();
        $(".background .cost").hide();
    })
    $(".expense-details .tit div span").on("click",function(){
        $(this).addClass("active").parents("div").siblings("div").find("span").removeClass("active");
    })



    //点赞
    $(".zan i").on("click",function(){
        $(this).toggleClass("active");
    })

    $(".expense-details .left span").on("click",function(){
        $(".left-aside-detail").addClass("active").siblings().removeClass('active');
    })
    $(".expense-details .right span").on("click",function(){
        $(".left-aside-reserve").addClass("active").siblings().removeClass('active');
    })
    $(".left-aside .left-aside-reserve").on("click",function(){
        $(this).addClass("active").siblings().removeClass('active');
        $(".notice").show();
        $(".cost").hide();
        $(".expense-details .right span").addClass("active");
        $(".expense-details .left span").removeClass("active");

    })
    $(".left-aside .left-aside-detail").on("click",function(){
        $(this).addClass("active").siblings().removeClass('active');
        $(".cost").show();
        $(".notice").hide();
        $(".expense-details .left span").addClass("active");
        $(".expense-details .right span").removeClass("active");

    })
    window.onload=function (){
        var h1;
        var h2;
        var h3;
        var h4;
        var h5;
        var h6;
        var h7;
        $(function(){
            h1 = 750;  										//行程亮点锚点处
            h2 = $("#liangdian").height() + 760;      //行程说明锚点处
            h3 = $("#shuoming").height()+h2;			//费用详情锚点出
            h4 =  $(".cost").outerHeight(true)+h3+110;			//沿途风光锚点出
            h5 =  $(".notice").outerHeight(true)+h3+110;		//沿途风光锚点出
            h6 =  500+h4;									    //隐藏高度
            h7 =  500+h5;									    //隐藏高度


            //浮动定位导航
            function toTag(g, h) {
                $(g).click(
                    function(){
                        $("html,body").animate({scrollTop: h}, 1000);
                    }
                );
            };
            toTag('.left-aside .left-aside-problem', h1);
            toTag('.left-aside .left-aside-explain', h2+1);
            toTag('.left-aside .left-aside-detail', h3);
            toTag('.left-aside .left-aside-reserve', h3);
            $(".left-aside-scenery").on("click",function(){
                if($(".cost").css("display") == 'block'){
                    $("html,body").animate({scrollTop: h4}, 1000);
                }else{
                    $("html,body").animate({scrollTop: h5}, 1000);
                }
            })
        })

        $(window).scroll( function (){
            if($(".cost").css("display") == 'block') {
                if ($(this).scrollTop() > 749 && $(this).scrollTop() < h6 && $(window).width() > 1490 ) {
                    $('.left-aside').fadeIn();
                }else{
                    $('.left-aside').fadeOut();
                };

                if ($(this).scrollTop() >= h1 && $(this).scrollTop() < h2) {
                    $('.left-aside-problem').addClass('active').siblings().removeClass('active');
                }else if($(this).scrollTop() > h2 && $(this).scrollTop() < h3) {
                    $('.left-aside-explain').addClass('active').siblings().removeClass('active');
                }else if ($(this).scrollTop() >= h3 && $(this).scrollTop() < h4 && $(".cost").css("display") == 'block') {
                    $('.left-aside-detail').addClass('active').siblings().removeClass('active');
                }else if ($(this).scrollTop() >= h3 && $(this).scrollTop() < h5 && $(".notice").css("display") == 'block') {
                    $('.left-aside-reserve').addClass('active').siblings().removeClass('active');
                } else if ($(this).scrollTop() >= h3 && $(this).scrollTop() < h5 && $(".cost").css("display") == 'block'){
                    $('.left-aside-scenery').addClass('active').siblings().removeClass('active');
                }
            }else{
                if ($(this).scrollTop() > 749 && $(this).scrollTop() < h7 && $(window).width() > 1490) {
                    $('.left-aside').fadeIn();
                }else{
                    $('.left-aside').fadeOut();
                };

                if ($(this).scrollTop() >= h1 && $(this).scrollTop() < h2) {
                    $('.left-aside-problem').addClass('active').siblings().removeClass('active');
                }else if($(this).scrollTop() > h2 && $(this).scrollTop() < h3) {
                    $('.left-aside-explain').addClass('active').siblings().removeClass('active');
                }else if ($(this).scrollTop() >= h3 && $(this).scrollTop() < h4 && $(".cost").css("display") == 'block') {
                    $('.left-aside-detail').addClass('active').siblings().removeClass('active');
                }else if ($(this).scrollTop() >= h3 && $(this).scrollTop() < h5 && $(".notice").css("display") == 'block') {
                    $('.left-aside-reserve').addClass('active').siblings().removeClass('active');
                }else if ($(this).scrollTop() >= h5 && $(this).scrollTop() < h7 && $(".notice").css("display") == 'block') {
                    $('.left-aside-scenery').addClass('active').siblings().removeClass('active');
                }
            }

        });
	}






    /* 配置选项 */
    var options = {
        width: 1000, // 宽度
        height: 625, // 高度
        gridCol: 10, // 网格列数
        gridRow: 5, // 网格行数
        gridVertical: 20, // 栅格列数
        gridHorizontal: 10, // 栅格行数
        autoPlay: true, // 自动播放
        ascending: true, // 图片按照升序播放
//        effects: [ // 使用的转场动画效果
//            'fade', 'fadeLeft', 'fadeRight', 'fadeTop', 'fadeBottom', 'fadeTopLeft', 'fadeBottomRight',
//            'blindsLeft', 'blindsRight', 'blindsTop', 'blindsBottom', 'blindsTopLeft', 'blindsBottomRight',
//            'curtainLeft', 'curtainRight', 'interlaceLeft', 'interlaceRight', 'mosaic', 'bomb', 'fumes'
//        ],
        ie6Tidy: false, // IE6下精简效果
        random: false, // 随机使用转场动画效果
        duration: 3000, // 图片停留时长（毫秒）
        speed: 900, // 转场效果时长（毫秒）
    };
    /* 创建轮播效果 */
    $('#slider').vmcSlider(options);


//    //垂直居中
//
//    function margintop(){
//        $("#center-top").on("load",function(){
//            var imgh = $(this).height();
//            var top = parseInt((625-imgh))/2;
//            alert(top)
//            if(top<200){
//                $(this).css("margin-top",top+"px");
//            }
//        });
//    }
//    // 初始化回调函数
//    $('#slider').vmcSlider({
//        flip: margintop(),
//    });
//    // 绑定vmcsliderflip事件
//    $('#slider').on('vmcsliderflip', margintop());
//
//    // 初始化回调函数
//    $('#slider').vmcSlider({
//        create: margintop(),
//    });
//    // 绑定vmcslidercreate事件
//    $('#slider').on('vmcslidercreate', margintop());


	// 立即预定
	$('.book_order_now').click(function(){		
		var batchId = $('#select_batch').val();		
		if (batchId == '0') {
			alert('请选择出行的日期');			
			return false;			
		}
		
		var male = 0;
		if ($('.man').find('.number').length > 0) {
			male = parseInt($('.man').find('.number').html());
		}
		var woman = 0;
		if ($('.woman').find('.number').length > 0) {
			woman = parseInt($('.woman').find('.number').html());
		}
		var child = 0;
		if ($('.children').find('.number').length > 0) {
			child = parseInt($('.children').find('.number').html());
		}				
		if ((male + woman + child) == 0) {
			alert('出行的总人数不能小于1人');			
			return false;			
		}
		
		location.href = '<?php echo U("line/order");?>/type/create/id/<?php echo ($line["id"]); ?>/b/'+batchId+'/m/'+male+'/w/'+woman+'/ch/'+child;
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

<script type="text/javascript">
	$(document).ready(function(){
	    $('.search-header input').unbind();
	    // 搜索栏
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
	});
</script>