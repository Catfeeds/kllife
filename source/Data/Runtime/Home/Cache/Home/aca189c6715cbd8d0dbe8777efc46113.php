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
<link rel="stylesheet" href="/source/Static/home/css/silk.css">
<style type="text/css">
    .theme { background: #fd4e4e; padding:1px 6px 1px 6px; color:#fff;text-align: center;text-align: -webkit-center; }
    .background-img-loading{background-image: url(/source/Static/home/common/images/background-img-loading.gif);background-repeat: no-repeat;background-position: center center;z-index:100;}
</style>
<div class="xinjiang">
    <div class="banner">
        <div class="banner-video">
            <!--<video poster="/source/Static/phone/images/silk/video.jpg" style="position:relative;margin-top:66px;margin-left:71px;" height="409" width="547" controls="controls"  x5-video-player-type="h5"/>-->
                <!--<source src="/source/Static/home/mp4/10029799-1.mp4" type="video/mp4">-->
            <!--</video>-->
            <a href="http://shequ.kllife.com/Index/youjidetail.html?id=3050" target="_blank"><img src="/source/Static/phone/images/silk/video1.jpg" style="position:relative;margin-top:66px;margin-left:71px;height:409px;width:547px" alt=""></a>
        </div>
    </div>
    <div class="chart"></div>
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
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman1.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman1.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman2.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman2.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman3.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman3.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman4.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman4.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman5.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman5.jpg">
                        </div>
                    </div>
                </div>
            </div>
            <!--第2行-->
            <div class="lineF">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman6.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman6.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman7.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman7.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman8.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman8.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman9.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman9.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman10.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman10.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman11.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman11.jpg">
                        </div>
                    </div>
                </div>
            </div>
            <!--第3行-->
            <div class="lineS">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman12.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman12.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman13.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman13.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman14.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman14.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman15.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman15.jpg">
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
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman16.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman16.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman17.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman17.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman18.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman18.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman19.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman19.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman20.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman20.jpg">
                        </div>
                    </div>
                </div>
            </div>
            <!--第2行-->
            <div class="lineF">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman21.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman21.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman22.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman22.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman23.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman23.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman24.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman24.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman25.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman25.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman26.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman26.jpg">
                        </div>
                    </div>
                </div>
            </div>
            <!--第3行-->
            <div class="lineS">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman27.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman27.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman28.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman28.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman29.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman29.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman30.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/xinjiang/xiaotuanman30.jpg">
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
    <div class="select">
        <div class="to-go" style="z-index:90;display: block;text-align: center;padding:30px 0px 0px;">
            <img src="/source/Static/home/images/silk/silk-select.png" alt="">
            <div id="show" style="cursor: pointer"><img src="/source/Static/home/images/silk/click_me.png" alt=""></div>
        </div>
        <div class="to-go selectone" style="z-index:90;">
            <div class="img3">
                <img src="/source/Static/home/images/silk/select3.png" alt="">
                <div class="spot">
                    <div>
                        <span>青海湖</span>
                        <span>马蹄寺</span>
                        <span>茶卡盐湖</span>
                        <span>冰沟林海</span>
                        <span>雅丹魔鬼城</span>
                        <span>嘉峪关</span>
                        <span>莫高窟</span>
                        <span>卓尔山</span>
                        <span>张掖丹霞</span>
                        <span>阿柔大寺</span>
                        <span>鸣沙山月牙泉</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="selecttwo" style="z-index:90">
            <div class="img3" style="z-index:90">
                <img style="z-index:90" src="/source/Static/home/images/silk/select4.png" alt="">
                <div class="interest" style="z-index:90">
                    <span>骑行</span>
                    <span>荧光晚会</span>
                    <span>摄影</span>
                    <span>藏式祈福</span>
                    <span>慢旅行</span>
                    <span>跟拍游</span>
                </div>
                <div class="price" style="z-index:90">
                    <span data-min-val="2000" data-max-val="3000">2000-3000</span>
                    <span data-min-val="3000" data-max-val="4000">3000-4000</span>
                    <span data-min-val="4001">4000以上</span>
                </div>
                <div class="day" style="z-index:90">
                    <span data-min-val="6" data-max-val="7">6天-7天</span>
                    <span data-min-val="8" data-max-val="9">8天-9天</span>
                    <span data-min-val="11">10天以上</span>
                </div>
            </div>
        </div>
	    <div class="item template_item hidden_ctrl" style="z-index:90;">
	        <div class="img"><img src="" alt=""><p><span class="day"></span>日游</p></div>
	        <div class="tit">
	            <p><span class="theme"></span></p>
	            <p class="lg"></p>
	            <p class="money">
	                <span class="sm"></span>
	                <span class="sm1">¥<span class="lg1">0.00</span></span>
	            </p>
	        </div>
	        <a href="javascript:;" target="_blank"></a>
	    </div>
        <div class="goods-group line_container" style="z-index:95;">
        	<?php if(is_array($dest_line_silk)): $i = 0; $__LIST__ = $dest_line_silk;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?><div class="item" data-id="<?php echo ($l["id"]); ?>" style="z-index:90;">
			        <div class="img"><img src="<?php echo ($l["img1"]); ?>" alt=""><p><span class="day"><?php echo ($l["travel_day"]); ?></span>日游</p></div>
			        <div class="tit">
			            <p><span class="theme <?php echo ($l['theme_type_list'][0]['type_key']); ?>"><?php echo ($l["theme_type_show_text"]); ?></span></p>
			            <p class="lg"><?php echo ($l["title"]); ?></p>
			            <p class="money">
			                <span class="sm"><?php echo ($l["send_word_show"]); ?></span>
			                <span class="sm1">
				                <?php if(empty($l['check_price'])): ?><span class="lg1">核算中</span>
				                <?php else: ?>
				                	¥<span class="lg1"><?php echo ($l["start_price_adult"]); ?></span><?php endif; ?>
			                </span>
			            </p>
			        </div>
			        <a href="<?php echo U('line/info');?>/id/<?php echo ($l["id"]); ?>" target="_blank"></a>
			    </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <img class="background-img1" style="position: absolute;top:0px;left:0px;width:100%;" src="/source/Static/home/images/silk/select.png" alt="">
        <img class="background-img2" style="position: absolute;bottom:0px;left:0px;width:100%;" src="/source/Static/home/images/silk/select2.png" alt="">
    </div>
    <!--私人定制-->
    <div class="customized">
        <div class="earth"><img style="width:140px;" src="/source/Static/home/images/silk/earth.gif" alt=""></div>
        <div class="customized2"><img src="/source/Static/home/images/silk/customized2.png" alt=""></div>
        <a href="<?php echo U('line/book');?>" class="btn btn-customized" target="_blank">定制我的旅行</a>
    </div>
    <!--活动回顾-->
    <div class="review">
        <div class="goods-group">
            <div class="review-img"><img src="/source/Static/home/images/silk/review.png" alt=""></div>
            <div class="item">
                <div class="img"><img class="img-responsive" src="/source/Static/home/images/silk/youji2016-11-30_583e6f394b270.jpg" alt=""></div>
                <div class="tit">
                    <p>西北行漫记——大漠传奇意象</p>
                </div>
                <a href="http://shequ.kllife.com/Index/youjidetail/id/2186.html" target="_blank"></a>
            </div>
            <div class="item">
                <div class="img"><img class="img-responsive" src="/source/Static/home/images/silk/youji2016-08-16_57b3017e38bc2.jpg" alt=""></div>
                <div class="tit">
                    <p>苍茫的西北是我滴爱~（7.25号丝路经典游，领队胡媛媛）</p>
                </div>
                <a href="http://shequ.kllife.com/Index/youjidetail/id/1587.html" target="_blank"></a>
            </div>
            <div class="item">
                <div class="img"><img class="img-responsive" src="/source/Static/home/images/silk/youji2016-07-25_57957e6b6fa9a.jpeg" alt=""></div>
                <div class="tit">
                    <p>七月的丝路之行！</p>
                </div>
                <a href="http://shequ.kllife.com/Index/youjidetail/id/1495.html" target="_blank"></a>
            </div>
            <div class="item">
                <div class="img"><img class="img-responsive" src="/source/Static/home/images/silk/youji2016-07-19_578db6b2e547a.jpg" alt=""></div>
                <div class="tit">
                    <p>7/6丝路环线游</p>
                </div>
                <a href="http://shequ.kllife.com/Index/youjidetail/id/1458.html" target="_blank"></a>
            </div>
            <div class="item">
                <div class="img"><img class="img-responsive" src="/source/Static/home/images/silk/youji2016-09-01_57c84a8cc58a9.jpg" alt=""></div>
                <div class="tit">
                    <p>兰州集合，丝路经典9天西北大环线领略水上魔鬼城--2016.8.7</p>
                </div>
                <a href="http://shequ.kllife.com/Index/youjidetail/id/1783.html" target="_blank"></a>
            </div>
            <div class="item">
                <div class="img"><img class="img-responsive" src="/source/Static/home/images/silk/youji2016-08-03_57a20dc29c69c.jpg" alt=""></div>
                <div class="tit">
                    <p>来自五湖四海的我们一2016丝绸之路经典游</p>
                </div>
                <a href="http://shequ.kllife.com/Index/youjidetail/id/1538.html" target="_blank"></a>
            </div>
        </div>
    </div>
    <!--其他旅游-->
    <div class="other">
        <div class="tit-one"><img class="background-img-loading" src="/source/Static/home/images/silk/other.jpg" alt=""></div>
        <div class="goods-group">
        	<?php if(is_array($recommend)): $i = 0; $__LIST__ = $recommend;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rd): $mod = ($i % 2 );++$i;?><div class="item">
	                <div class="img"><img class="background-img-loading" src="<?php echo ($rd["img1"]); ?>" alt="">
	                    <p><span><?php echo ($rd["travel_day"]); ?></span>日游</p>
	                </div>
	                <div class="tit">
	                    <p><span class="theme <?php echo ($rd['theme_type_list'][0]['type_key']); ?>"><?php echo ($rd["theme_type_show_text"]); ?></span></p>
	                    <p class="lg"><?php echo ($rd["title"]); ?></p>
	                    <p class="money">
	                        <span class="sm"><?php echo ($rd["send_word_show"]); ?></span>
	                        <span class="sm1">
				                <?php if(empty($rd['check_price'])): ?><span class="lg1">核算中</span>
				                <?php else: ?>
				                	¥<span class="lg1"><?php echo ($rd['start_price_adult']); ?></span>起<?php endif; ?>
							</span>
	                    </p>
	                </div>
	                <a href="<?php echo U('line/info');?>/id/<?php echo ($rd["id"]); ?>" target="_blank"></a>
	            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <!--周边游-->
    <div class="other periphery">
        <div class="tit-one"><img class="background-img-loading" src="/source/Static/home/images/silk/periphery.jpg" alt=""></div>
        <div class="goods-group">
        	<?php if(is_array($surrounding)): $i = 0; $__LIST__ = $surrounding;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sur): $mod = ($i % 2 );++$i;?><div class="item">
	                <div class="img"><img class="background-img-loading" src="<?php echo ($sur["img1"]); ?>" alt="">
	                    <p><span><?php echo ($sur["travel_day"]); ?></span>日游</p>
	                </div>
	                <div class="tit">
	                    <p><span class="theme <?php echo ($sur['theme_type_list'][0]['type_key']); ?>"><?php echo ($sur["theme_type_show_text"]); ?></span></p>
	                    <p class="lg"><?php echo ($sur["title"]); ?></p>
	                    <p class="money">
	                        <span class="sm"><?php echo ($sur["send_word_show"]); ?></span>
	                        <span class="sm1">
				                <?php if(empty($sur['check_price'])): ?><span class="lg1">核算中</span>
				                <?php else: ?>
				                	¥<span class="lg1"><?php echo ($sur['start_price_adult']); ?></span>起<?php endif; ?>
			                </span>
	                    </p>
	                </div>
	                <a href="<?php echo U('line/info');?>/id/<?php echo ($rd["id"]); ?>" target="_blank"></a>
	            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div style="background: #fff;margin-top:-140px;"><img src="/source/Static/home/images/silk/bottom.png" alt=""></div>
    </div>
</div>
<!--咨询-->
<div class="advice">
    <a href="<?php echo ($pcset["askfor_link"]); ?>" target="_blank"><img src="/source/Static/home/images/silk/tel.png" alt=""></a>
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

    function imgDisplay(){
        if($(".select").height() < 1000){
            $(".background-img2").css("display","none")
            $(".background-img1").css("height","850px")
        }else{
            $(".background-img2").css("display","block")
            $(".background-img1").css("height","auto")
        }
    }
    imgDisplay();

    // 查找产品
    function findLine() {
        var vp = '';
        $('.select').find('.spot').find('.active').each(function(){
            if (vp != '') {
                vp += '|';
            }
            vp += $(this).html();
        });

        var jsonData = {
            view: vp,
//            season: $('.season').find('.active').attr('data-val'),
            play: $('.interest').find('.active').html(),
            min_price: $('.price').find('.active').attr('data-min-val'),
            min_day: $('.day').find('.active').attr('data-min-val'),
        }
        
        if ('<?php echo ($refresh); ?>' != '') {
            jsonData['refresh'] = '<?php echo ($refresh); ?>';
        }

        var max_price = $('.price').find('.active').attr('data-max-val');
        if (max_price != null && max_price != 'undefined' && max_price != '') {
            jsonData['max_price'] = max_price;
        }

        var max_day = $('.day').find('.active').attr('data-max-val');
        if (max_day != null && max_day != 'undefined' && max_day != '') {
            jsonData['max_day'] = max_day;
        }

        $('.line_container').children().remove();
        $.post('<?php echo U("subject/silk");?>', jsonData, function(data){
            if (data.ds != null) {
                for (var i=0; i < data.ds.length; i++) {
                    var d = data.ds[i];
                    var rootObj = $('.template_item').clone(true);
                    $(rootObj).removeClass('template_item');
                    $(rootObj).removeClass('hidden_ctrl');
                    $(rootObj).attr('data-id', d.id);
                    $(rootObj).find('img').attr('src', d.img1);
                    $(rootObj).find('.img .day').html(d.travel_day);
                    $(rootObj).find('.tit .theme').addClass(d['theme_type_list'][0]['type_key']);
                    $(rootObj).find('.tit .theme').html(d.theme_type_show_text);
                    $(rootObj).find('.tit .lg').html(d.title);
                    $(rootObj).find('.tit .money').find('.sm').html(d.send_word_show);
                    $(rootObj).find('a').attr('href', '<?php echo U("line/info");?>/id/'+d.id);
                    if (d.check_price == 0) {
                        $(rootObj).find('.tit .money').find('.sm1 .lg1').parent().html('<span class="lg1">核算中</span>');
                    } else {
                        $(rootObj).find('.tit .money').find('.sm1 .lg1').html(d.start_price_adult);
                    }
                    $('.line_container').append(rootObj);
                }
                //背景图显示隐藏
                imgDisplay();
            } else {
                $('.line_container').html('<div style="text-align: center; font-size:20px;z-index:95">亲，没有您要的线路，可以选择定制或者尝试其他选项哦</div>');
                //背景图显示隐藏
                imgDisplay();
            }
        });
    }

    $(document).ready(function(){
//    	// 查找线路(不做首次加载)
//    	findLine();
    	//背景图显示隐藏
        imgDisplay();

        //多选想去的景点
        $(".spot div span").on("click",function(){
            $(this).toggleClass("active");
	    	// 查找线路
	    	findLine();
            //背景图显示隐藏
            imgDisplay();
        })
        //兴趣
        $(".interest span").on("click",function(){
            $(this).toggleClass("active").siblings("span").removeClass("active");
	    	// 查找线路
	    	findLine();
            //背景图显示隐藏
            imgDisplay();
        })
        //价格
        $(".price span").on("click",function(){
            $(this).toggleClass("active").siblings("span").removeClass("active");
	    	// 查找线路
	    	findLine();
            //背景图显示隐藏
            imgDisplay();
        })
        //天数
        $(".day span").on("click",function(){
            $(this).toggleClass("active").siblings("span").removeClass("active");
	    	// 查找线路
	    	findLine();
            //背景图显示隐藏
            imgDisplay();
        })

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
            if(index<3){
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
            $(".xinjiang .select .to-go").slideDown(500);
            $(".xinjiang .select .selecttwo").slideDown(1000);
        })
    });
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