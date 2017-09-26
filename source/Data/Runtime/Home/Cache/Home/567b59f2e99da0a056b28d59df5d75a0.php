<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="领袖户外" name="author"/>
	<!--特殊专题新疆标题关键字-->
	<?php if(C('MENU_CURRENT') == 'subject_xinjiang'): ?><meta content="新疆驴友网,禾木驴友网,新疆驴友攻略,新疆景点大全,喀纳斯驴友网,新疆定制游,新疆旅游价格,新疆旅游费用" name="keywords"/>
	    <meta content="新疆旅游攻略，小团慢旅行,新疆自助游攻略，包括小团慢旅行,新疆热门景点、户外俱乐部、游记攻略、出行交通、餐饮等旅游信息，以及小团慢旅行,新疆驴友交流、驴友俱乐部信息。小团慢旅行,新疆旅游怎么订制。" name="description"/>
		<title>新疆旅游新玩法-领袖户外官方网站-新疆驴友网-好玩不贵的小团慢旅行</title>	
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
	
	<script>
	
		function browserRedirect() {
			var sUserAgent = navigator.userAgent.toLowerCase();
			var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
			var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
			var bIsMidp = sUserAgent.match(/midp/i) == "midp";
			var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
			var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
			var bIsAndroid = sUserAgent.match(/android/i) == "android";
			var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
			var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
			
            var vurl = window.location.href;
            if (vurl.indexOf('www.') != -1) {
                vurl = window.location.href.replace(/www./g, '');
            }
            
			if (bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM) {
				var vhref = vurl.replace(/home/g,'phone');
				window.location.href = vhref;
			} else {
				
			}
			
            if(vurl != window.location.href){
                window.location.href = vurl;
			}
		}
		browserRedirect();
	
	</script>
	
	
</head>
<body>
	<header>
		<div class="nav01">
			<div class="nav-top">
				<div class="nav-top-left">
					<?php if(is_array($stations)): $i = 0; $__LIST__ = $stations;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$station): $mod = ($i % 2 );++$i; if($station['forbidden'] === '0'): if($station_id == $station['id']): ?><a href="<?php echo U('index/welcome');?>/station/<?php echo ($station["key"]); ?>" style="color: #ff8000"> <?php echo ($station["name"]); ?> </a> |
							<?php else: ?>
								<a href="<?php echo U('index/welcome');?>/station/<?php echo ($station["key"]); ?>"> <?php echo ($station["name"]); ?> </a> |<?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
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
					<?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; if (is_array($menu) === false) { continue; } $jumpToLineList = false; switch($menu['item_desc']) { case '首页': $href=U('index/welcome'); break; case '写真旅行': $href=U('line/xiezhenlvxing'); break; case '私人定制': { $href=$pcset['team_link']; $target = '_blank'; }break; case '论坛': { $href = "http://shequ.kllife.com"; $target = '_blank'; }break; default: { $jumpToLineList = true; $href=U('line/list'); } break; } ?>
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
<link rel="stylesheet" href="/source/Static/home/css/northwest.css">
<div class="northwest">
    <!--banner-->
    <div class="banner"></div>
    <!--小团-->
    <div class="xiaotuan"></div>
    <!--推荐线路-->
    <div class="recommend">
        <div class="content">
            <div class="tit">
                <ul>
                    <li class="active">推荐</li>
                    <li>小团慢旅行</li>
                    <li>写真旅行</li>
                    <li>摄影游</li>
                    <li>民族行</li>
                </ul>
                <div class="border"><!--此div只用于border--></div>
            </div>
            <div class="item">
                <div class="left"><img src="/source/Static/home/images/northwest/commodity.jpg" alt=""></div>
                <div class="right">
                    <h1>纵情丝路写真旅行</h1><span class="tag">写真旅行</span>
                    <p>沙岛-青海湖-茶卡盐湖-祁连-张掖-嘉峪关-敦煌9日游</p>
                    <p class="brief">丝路简介：<span>3大主题人像拍摄，3天300度环青海湖游玩，最长日车程不超400公里，轻奢住宿，巅峰体验！</span></p>
                    <div class="choice-time">
                        <div class="time"><p>活动时间：<span>2017-05-27 至 2017-08-11</span></p></div>
                        <div class="time">
                            <span class="span">出发日期：</span>
                            <select name="" id="">
                                <option value="">2017-07-12[可报名]</option>
                                <option value="">2017-08-12[可报名]</option>
                                <option value="">2017-09-12[可报名]</option>
                                <option value="">2017-10-12[可报名]</option>
                            </select>
                        </div>
                    </div>
                    <p>集合地点：<span>兰州</span></p>
                    <p>目的地：<span>甘南</span></p>
                    <p class="price">￥<span>3180</span>(成人)</p>
                    <div class="sig-up">
                        <p>本条线路已有 <span>6</span> 人已报名</p>
                        <span class="btn">立即报名</span>
                    </div>
                </div>
                <a href="javascript:;"></a>
            </div>
            <div class="item">
                <div class="left"><img src="/source/Static/home/images/northwest/commodity.jpg" alt=""></div>
                <div class="right">
                    <h1>纵情丝路写真旅行</h1><span class="tag">写真旅行</span>
                    <p>沙岛-青海湖-茶卡盐湖-祁连-张掖-嘉峪关-敦煌9日游</p>
                    <p class="brief">丝路简介：<span>3大主题人像拍摄，3天300度环青海湖游玩，最长日车程不超400公里，轻奢住宿，巅峰体验！</span></p>
                    <div class="choice-time">
                        <div class="time"><p>活动时间：<span>2017-05-27 至 2017-08-11</span></p></div>
                        <div class="time">
                            <span class="span">出发日期：</span>
                            <select name="" id="">
                                <option value="">2017-07-12[可报名]</option>
                                <option value="">2017-08-12[可报名]</option>
                                <option value="">2017-09-12[可报名]</option>
                                <option value="">2017-10-12[可报名]</option>
                            </select>
                        </div>
                    </div>
                    <p>集合地点：<span>兰州</span></p>
                    <p>目的地：<span>甘南</span></p>
                    <p class="price">￥<span>3180</span>(成人)</p>
                    <div class="sig-up">
                        <p>本条线路已有 <span>6</span> 人已报名</p>
                        <span class="btn">立即报名</span>
                    </div>
                </div>
                <a href="javascript:;"></a>
            </div>
            <div class="item">
                <div class="left"><img src="/source/Static/home/images/northwest/commodity.jpg" alt=""></div>
                <div class="right">
                    <h1>纵情丝路写真旅行</h1><span class="tag">写真旅行</span>
                    <p>沙岛-青海湖-茶卡盐湖-祁连-张掖-嘉峪关-敦煌9日游</p>
                    <p class="brief">丝路简介：<span>3大主题人像拍摄，3天300度环青海湖游玩，最长日车程不超400公里，轻奢住宿，巅峰体验！</span></p>
                    <div class="choice-time">
                        <div class="time"><p>活动时间：<span>2017-05-27 至 2017-08-11</span></p></div>
                        <div class="time">
                            <span class="span">出发日期：</span>
                            <select name="" id="">
                                <option value="">2017-07-12[可报名]</option>
                                <option value="">2017-08-12[可报名]</option>
                                <option value="">2017-09-12[可报名]</option>
                                <option value="">2017-10-12[可报名]</option>
                            </select>
                        </div>
                    </div>
                    <p>集合地点：<span>兰州</span></p>
                    <p>目的地：<span>甘南</span></p>
                    <p class="price">￥<span>3180</span>(成人)</p>
                    <div class="sig-up">
                        <p>本条线路已有 <span>6</span> 人已报名</p>
                        <span class="btn">立即报名</span>
                    </div>
                </div>
                <a href="javascript:;"></a>
            </div>
            <div class="item">
                <div class="left"><img src="/source/Static/home/images/northwest/commodity.jpg" alt=""></div>
                <div class="right">
                    <h1>纵情丝路写真旅行</h1><span class="tag">写真旅行</span>
                    <p>沙岛-青海湖-茶卡盐湖-祁连-张掖-嘉峪关-敦煌9日游</p>
                    <p class="brief">丝路简介：<span>3大主题人像拍摄，3天300度环青海湖游玩，最长日车程不超400公里，轻奢住宿，巅峰体验！</span></p>
                    <div class="choice-time">
                        <div class="time"><p>活动时间：<span>2017-05-27 至 2017-08-11</span></p></div>
                        <div class="time">
                            <span class="span">出发日期：</span>
                            <select name="" id="">
                                <option value="">2017-07-12[可报名]</option>
                                <option value="">2017-08-12[可报名]</option>
                                <option value="">2017-09-12[可报名]</option>
                                <option value="">2017-10-12[可报名]</option>
                            </select>
                        </div>
                    </div>
                    <p>集合地点：<span>兰州</span></p>
                    <p>目的地：<span>甘南</span></p>
                    <p class="price">￥<span>3180</span>(成人)</p>
                    <div class="sig-up">
                        <p>本条线路已有 <span>6</span> 人已报名</p>
                        <span class="btn">立即报名</span>
                    </div>
                </div>
                <a href="javascript:;"></a>
            </div>
        </div>
        <img class="bottom" style="margin-top:-400px;" src="/source/Static/home/images/northwest/recommend-bottom.jpg" alt="">
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
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman1.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/01.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman2.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/02.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman3.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/03.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman4.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/04.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman5.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/05.PNG">
                        </div>
                    </div>
                </div>
            </div>
            <!--第2行-->
            <div class="lineF" style="padding-left:222px">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman6.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/06.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman7.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/07.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman8.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/08.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman9.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/09.PNG">
                        </div>
                    </div>
                </div>
            </div>
            <!--第3行-->
            <div class="lineS">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman10.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/10.JPG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman11.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/11.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman12.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/12.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman13.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/13.PNG">
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
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman16.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/14.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman17.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/15.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman18.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/16.JPG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman19.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/17.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman20.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/18.PNG">
                        </div>
                    </div>
                </div>
            </div>
            <!--第2行-->
            <div class="lineF" style="padding-left:222px;">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman21.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/19.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman22.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/20.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman23.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/21.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman24.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/22.PNG">
                        </div>
                    </div>
                </div>
            </div>
            <!--第3行-->
            <div class="lineS">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman27.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/23.JPG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman28.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/24.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman29.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/25.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman30.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/26.PNG">
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
    <!--往期游记-->
    <div class="review">
        <div class="content">
            <div class="tit"><img src="/source/Static/home/images/northwest/review-tit.png" alt=""></div>
            <video style="position:absolute;left:0px;right:0px;margin:auto;margin-top:40px;background: #fff;" height="255" width="420" controls="controls"  x5-video-player-type="h5"/>
            <source src="/source/Static/home/mp4/10029799-1.mp4" type="video/mp4">
            </video>
            <div class="goods-group">
                <div class="item">
                    <div class="img"><img class="img-responsive" src="/source/Static/home/images/silk/youji2016-07-25_57957e6b6fa9a.jpeg" alt=""></div>
                    <div class="tit">
                        <p>七月的丝路之行！</p>
                    </div>
                    <a href="http://shequ.kllife.com/Index/youjidetail/id/1495.html" target="_blank"></a>
                </div>
                <div class="item">
                    <div class="img"><img class="img-responsive" src="http://7xosrp.com1.z0.glb.clouddn.com/youji2016-10-28_5812f55e8c4ab.jpg?imageView2/2/w/1000/q/100/|watermark/1/image/aHR0cDovLzd4b3NycC5jb20xLnowLmdsYi5jbG91ZGRuLmNvbS95b3VqaTIwMTYtMDYtMjRfNTc2Y2RmZTBiOWUzZi5wbmc=/dissolve/100/gravity/SouthEast" alt=""></div>
                    <div class="tit">
                        <p>西北偏北———额济纳</p>
                    </div>
                    <a href="http://shequ.kllife.com/Index/youjidetail.html?id=2034" target="_blank"></a>
                </div>
                <div class="item">
                    <div class="img"><img class="img-responsive" src="/source/Static/home/images/northwest/youji2.jpg" alt=""></div>
                    <div class="tit">
                        <p>兰州集合，丝路经典9天西北大环线领略水上魔鬼城--2016.8.7</p>
                    </div>
                    <a href="http://shequ.kllife.com/Index/youjidetail.html?id=1783" target="_blank"></a>
                </div>
                <div class="item">
                    <div class="img"><img class="img-responsive" src="http://7xosrp.com1.z0.glb.clouddn.com/youji2017-06-08_5938ce270a797.jpg?watermark/1/image/aHR0cDovLzd4b3NycC5jb20xLnowLmdsYi5jbG91ZGRuLmNvbS95b3VqaTIwMTYtMDYtMjRfNTc2Y2RmZTBiOWUzZi5wbmc=/dissolve/100/gravity/SouthEast" alt=""></div>
                    <div class="tit">
                        <p>有了纵情丝路，其它的都弱爆了——直播，有大量美女，看的时候口水不要滴键盘上</p>
                    </div>
                    <a href="http://shequ.kllife.com/Index/youjidetail.html?id=3050" target="_blank"></a>
                </div>
                <div class="item">
                    <div class="img"><img class="img-responsive" src="/source/Static/home/images/northwest/youji3.jpg" alt=""></div>
                    <div class="tit">
                        <p>西北行漫记——大漠传奇意象</p>
                    </div>
                    <a href="http://shequ.kllife.com/Index/youjidetail.html?id=2186" target="_blank"></a>
                </div>
                <div class="item">
                    <div class="img"><img class="img-responsive" src="http://7xosrp.com1.z0.glb.clouddn.com/youji2017-06-11_593d6452df02d.jpg?imageView2/2/w/1000/q/100/|watermark/1/image/aHR0cDovLzd4b3NycC5jb20xLnowLmdsYi5jbG91ZGRuLmNvbS95b3VqaTIwMTYtMDYtMjRfNTc2Y2RmZTBiOWUzZi5wbmc=/dissolve/100/gravity/SouthEast" alt=""></div>
                    <div class="tit">
                        <p>穆穆带你与新疆有个美丽的约会</p>
                    </div>
                    <a href="http://shequ.kllife.com/Index/youjidetail.html?id=3065" target="_blank"></a>
                </div>

                <a class="more" href="http://shequ.kllife.com" target="_blank"><img src="/source/Static/home/images/northwest/more.png" alt=""></a>
            </div>
        </div>
    </div>
    <!--其他线路推荐-->
    <div class="other">
        <div class="tit-one"><img class="background-img-loading" src="/source/Static/home/images/northwest/qita-tit.png" alt=""></div>
        <div class="goods-group">
            <div class="item">
                <div class="img"><img class="background-img-loading" src="/source/Static/home/images/silk/youji2016-07-25_57957e6b6fa9a.jpeg" alt="">
                    <p><span>10</span>日游</p>
                </div>
                <div class="tit">
                    <p><span class="theme">小团慢旅行</span></p>
                    <p class="lg">大美川藏</p>
                    <p class="money">
                        <span class="sm">网罗川藏，滇藏精华景点，精品10人小团，带你穿越中国最美景观大道！</span>
                        <span class="sm1">¥<span class="lg1">3280</span>起</span>
                    </p>
                </div>
                <div class="choice-time">
                    <div class="time1">
                        <span class="span">出发时间：</span>
                        <select name="" id="">
                            <option value="">2017-07-12[可报名]</option>
                            <option value="">2017-08-12[可报名]</option>
                            <option value="">2017-09-12[可报名]</option>
                            <option value="">2017-10-12[可报名]</option>
                        </select>
                    </div>
                    <div class="time2">本条线路已有 <span>6</span> 人报名</div>
                </div>
                <a href="JavaScript:;" target="_blank"></a>
            </div>
            <div class="item">
                <div class="img"><img class="background-img-loading" src="/source/Static/home/images/silk/youji2016-07-25_57957e6b6fa9a.jpeg" alt="">
                    <p><span>10</span>日游</p>
                </div>
                <div class="tit">
                    <p><span class="theme">小团慢旅行</span></p>
                    <p class="lg">大美川藏</p>
                    <p class="money">
                        <span class="sm">网罗川藏，滇藏精华景点，精品10人小团，带你穿越中国最美景观大道！</span>
                        <span class="sm1">¥<span class="lg1">3280</span>起</span>
                    </p>
                </div>
                <div class="choice-time">
                    <div class="time1">
                        <span class="span">出发时间：</span>
                        <select name="" id="">
                            <option value="">2017-07-12[可报名]</option>
                            <option value="">2017-08-12[可报名]</option>
                            <option value="">2017-09-12[可报名]</option>
                            <option value="">2017-10-12[可报名]</option>
                        </select>
                    </div>
                    <div class="time2">本条线路已有 <span>6</span> 人报名</div>
                </div>
                <a href="JavaScript:;" target="_blank"></a>
            </div>
            <div class="item">
                <div class="img"><img class="background-img-loading" src="/source/Static/home/images/silk/youji2016-07-25_57957e6b6fa9a.jpeg" alt="">
                    <p><span>10</span>日游</p>
                </div>
                <div class="tit">
                    <p><span class="theme">小团慢旅行</span></p>
                    <p class="lg">大美川藏</p>
                    <p class="money">
                        <span class="sm">网罗川藏，滇藏精华景点，精品10人小团，带你穿越中国最美景观大道！</span>
                        <span class="sm1">¥<span class="lg1">3280</span>起</span>
                    </p>
                </div>
                <div class="choice-time">
                    <div class="time1">
                        <span class="span">出发时间：</span>
                        <select name="" id="">
                            <option value="">2017-07-12[可报名]</option>
                            <option value="">2017-08-12[可报名]</option>
                            <option value="">2017-09-12[可报名]</option>
                            <option value="">2017-10-12[可报名]</option>
                        </select>
                    </div>
                    <div class="time2">本条线路已有 <span>6</span> 人报名</div>
                </div>
                <a href="JavaScript:;" target="_blank"></a>
            </div>
            <div class="item">
                <div class="img"><img class="background-img-loading" src="/source/Static/home/images/silk/youji2016-07-25_57957e6b6fa9a.jpeg" alt="">
                    <p><span>10</span>日游</p>
                </div>
                <div class="tit">
                    <p><span class="theme">小团慢旅行</span></p>
                    <p class="lg">大美川藏</p>
                    <p class="money">
                        <span class="sm">网罗川藏，滇藏精华景点，精品10人小团，带你穿越中国最美景观大道！</span>
                        <span class="sm1">¥<span class="lg1">3280</span>起</span>
                    </p>
                </div>
                <div class="choice-time">
                    <div class="time1">
                        <span class="span">出发时间：</span>
                        <select name="" id="">
                            <option value="">2017-07-12[可报名]</option>
                            <option value="">2017-08-12[可报名]</option>
                            <option value="">2017-09-12[可报名]</option>
                            <option value="">2017-10-12[可报名]</option>
                        </select>
                    </div>
                    <div class="time2">本条线路已有 <span>6</span> 人报名</div>
                </div>
                <a href="JavaScript:;" target="_blank"></a>
            </div>
            <div class="item">
                <div class="img"><img class="background-img-loading" src="/source/Static/home/images/silk/youji2016-07-25_57957e6b6fa9a.jpeg" alt="">
                    <p><span>10</span>日游</p>
                </div>
                <div class="tit">
                    <p><span class="theme">小团慢旅行</span></p>
                    <p class="lg">大美川藏</p>
                    <p class="money">
                        <span class="sm">网罗川藏，滇藏精华景点，精品10人小团，带你穿越中国最美景观大道！</span>
                        <span class="sm1">¥<span class="lg1">3280</span>起</span>
                    </p>
                </div>
                <div class="choice-time">
                    <div class="time1">
                        <span class="span">出发时间：</span>
                        <select name="" id="">
                            <option value="">2017-07-12[可报名]</option>
                            <option value="">2017-08-12[可报名]</option>
                            <option value="">2017-09-12[可报名]</option>
                            <option value="">2017-10-12[可报名]</option>
                        </select>
                    </div>
                    <div class="time2">本条线路已有 <span>6</span> 人报名</div>
                </div>
                <a href="JavaScript:;" target="_blank"></a>
            </div>
            <div class="item">
                <div class="img"><img class="background-img-loading" src="/source/Static/home/images/silk/youji2016-07-25_57957e6b6fa9a.jpeg" alt="">
                    <p><span>10</span>日游</p>
                </div>
                <div class="tit">
                    <p><span class="theme">小团慢旅行</span></p>
                    <p class="lg">大美川藏</p>
                    <p class="money">
                        <span class="sm">网罗川藏，滇藏精华景点，精品10人小团，带你穿越中国最美景观大道！</span>
                        <span class="sm1">¥<span class="lg1">3280</span>起</span>
                    </p>
                </div>
                <div class="choice-time">
                    <div class="time1">
                        <span class="span">出发时间：</span>
                        <select name="" id="">
                            <option value="">2017-07-12[可报名]</option>
                            <option value="">2017-08-12[可报名]</option>
                            <option value="">2017-09-12[可报名]</option>
                            <option value="">2017-10-12[可报名]</option>
                        </select>
                    </div>
                    <div class="time2">本条线路已有 <span>6</span> 人报名</div>
                </div>
                <a href="JavaScript:;" target="_blank"></a>
            </div>
        </div>
    </div>
    <!--周边线路推荐-->
    <div class="other zhoubian">
        <div class="tit-one"><img class="background-img-loading" src="/source/Static/home/images/northwest/zhoubian-tit.png" alt=""></div>
        <div class="goods-group">
            <div class="item">
                <div class="img"><img class="background-img-loading" src="/source/Static/home/images/silk/youji2016-07-25_57957e6b6fa9a.jpeg" alt="">
                    <p><span>10</span>日游</p>
                </div>
                <div class="tit">
                    <p><span class="theme">小团慢旅行</span></p>
                    <p class="lg">大美川藏</p>
                    <p class="money">
                        <span class="sm">网罗川藏，滇藏精华景点，精品10人小团，带你穿越中国最美景观大道！</span>
                        <span class="sm1">¥<span class="lg1">3280</span>起</span>
                    </p>
                </div>
                <div class="choice-time">
                    <div class="time1">
                        <span class="span">出发时间：</span>
                        <select name="" id="">
                            <option value="">2017-07-12[可报名]</option>
                            <option value="">2017-08-12[可报名]</option>
                            <option value="">2017-09-12[可报名]</option>
                            <option value="">2017-10-12[可报名]</option>
                        </select>
                    </div>
                    <div class="time2">本条线路已有 <span>6</span> 人报名</div>
                </div>
                <a href="JavaScript:;" target="_blank"></a>
            </div>
            <div class="item">
                <div class="img"><img class="background-img-loading" src="/source/Static/home/images/silk/youji2016-07-25_57957e6b6fa9a.jpeg" alt="">
                    <p><span>10</span>日游</p>
                </div>
                <div class="tit">
                    <p><span class="theme">小团慢旅行</span></p>
                    <p class="lg">大美川藏</p>
                    <p class="money">
                        <span class="sm">网罗川藏，滇藏精华景点，精品10人小团，带你穿越中国最美景观大道！</span>
                        <span class="sm1">¥<span class="lg1">3280</span>起</span>
                    </p>
                </div>
                <div class="choice-time">
                    <div class="time1">
                        <span class="span">出发时间：</span>
                        <select name="" id="">
                            <option value="">2017-07-12[可报名]</option>
                            <option value="">2017-08-12[可报名]</option>
                            <option value="">2017-09-12[可报名]</option>
                            <option value="">2017-10-12[可报名]</option>
                        </select>
                    </div>
                    <div class="time2">本条线路已有 <span>6</span> 人报名</div>
                </div>
                <a href="JavaScript:;" target="_blank"></a>
            </div>
            <div class="item">
                <div class="img"><img class="background-img-loading" src="/source/Static/home/images/silk/youji2016-07-25_57957e6b6fa9a.jpeg" alt="">
                    <p><span>10</span>日游</p>
                </div>
                <div class="tit">
                    <p><span class="theme">小团慢旅行</span></p>
                    <p class="lg">大美川藏</p>
                    <p class="money">
                        <span class="sm">网罗川藏，滇藏精华景点，精品10人小团，带你穿越中国最美景观大道！</span>
                        <span class="sm1">¥<span class="lg1">3280</span>起</span>
                    </p>
                </div>
                <div class="choice-time">
                    <div class="time1">
                        <span class="span">出发时间：</span>
                        <select name="" id="">
                            <option value="">2017-07-12[可报名]</option>
                            <option value="">2017-08-12[可报名]</option>
                            <option value="">2017-09-12[可报名]</option>
                            <option value="">2017-10-12[可报名]</option>
                        </select>
                    </div>
                    <div class="time2">本条线路已有 <span>6</span> 人报名</div>
                </div>
                <a href="JavaScript:;" target="_blank"></a>
            </div>
            <div class="item">
                <div class="img"><img class="background-img-loading" src="/source/Static/home/images/silk/youji2016-07-25_57957e6b6fa9a.jpeg" alt="">
                    <p><span>10</span>日游</p>
                </div>
                <div class="tit">
                    <p><span class="theme">小团慢旅行</span></p>
                    <p class="lg">大美川藏</p>
                    <p class="money">
                        <span class="sm">网罗川藏，滇藏精华景点，精品10人小团，带你穿越中国最美景观大道！</span>
                        <span class="sm1">¥<span class="lg1">3280</span>起</span>
                    </p>
                </div>
                <div class="choice-time">
                    <div class="time1">
                        <span class="span">出发时间：</span>
                        <select name="" id="">
                            <option value="">2017-07-12[可报名]</option>
                            <option value="">2017-08-12[可报名]</option>
                            <option value="">2017-09-12[可报名]</option>
                            <option value="">2017-10-12[可报名]</option>
                        </select>
                    </div>
                    <div class="time2">本条线路已有 <span>6</span> 人报名</div>
                </div>
                <a href="JavaScript:;" target="_blank"></a>
            </div>
            <div class="item">
                <div class="img"><img class="background-img-loading" src="/source/Static/home/images/silk/youji2016-07-25_57957e6b6fa9a.jpeg" alt="">
                    <p><span>10</span>日游</p>
                </div>
                <div class="tit">
                    <p><span class="theme">小团慢旅行</span></p>
                    <p class="lg">大美川藏</p>
                    <p class="money">
                        <span class="sm">网罗川藏，滇藏精华景点，精品10人小团，带你穿越中国最美景观大道！</span>
                        <span class="sm1">¥<span class="lg1">3280</span>起</span>
                    </p>
                </div>
                <div class="choice-time">
                    <div class="time1">
                        <span class="span">出发时间：</span>
                        <select name="" id="">
                            <option value="">2017-07-12[可报名]</option>
                            <option value="">2017-08-12[可报名]</option>
                            <option value="">2017-09-12[可报名]</option>
                            <option value="">2017-10-12[可报名]</option>
                        </select>
                    </div>
                    <div class="time2">本条线路已有 <span>6</span> 人报名</div>
                </div>
                <a href="JavaScript:;" target="_blank"></a>
            </div>
            <div class="item">
                <div class="img"><img class="background-img-loading" src="/source/Static/home/images/silk/youji2016-07-25_57957e6b6fa9a.jpeg" alt="">
                    <p><span>10</span>日游</p>
                </div>
                <div class="tit">
                    <p><span class="theme">小团慢旅行</span></p>
                    <p class="lg">大美川藏</p>
                    <p class="money">
                        <span class="sm">网罗川藏，滇藏精华景点，精品10人小团，带你穿越中国最美景观大道！</span>
                        <span class="sm1">¥<span class="lg1">3280</span>起</span>
                    </p>
                </div>
                <div class="choice-time">
                    <div class="time1">
                        <span class="span">出发时间：</span>
                        <select name="" id="">
                            <option value="">2017-07-12[可报名]</option>
                            <option value="">2017-08-12[可报名]</option>
                            <option value="">2017-09-12[可报名]</option>
                            <option value="">2017-10-12[可报名]</option>
                        </select>
                    </div>
                    <div class="time2">本条线路已有 <span>6</span> 人报名</div>
                </div>
                <a href="JavaScript:;" target="_blank"></a>
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
    //推荐标签切换
    $(".recommend .content .tit ul li").on("click",function(){
        $(this).addClass("active").siblings().removeClass("active")
    })
    //推荐线路背景图片定位
    if($(".recommend .content .item").length>2){
        $(".bottom").css("margin-top","-850px")
    }else{
        $(".bottom").css("margin-top","-400px")
    }
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

    //点击显示筛选
    $("#show").on("click",function(){
        $(this).slideUp();
        $(".xinjiang .select").slideDown(1000);
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