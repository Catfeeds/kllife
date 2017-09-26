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
<link rel="stylesheet" href="/source/Static/home/css/list.css">
<style type="text/css">
	body { background-color:#f3f5f6; }
</style>

	<!-- 主要内容 -->
	<div id="content">

		<!-- 面包屑导航 -->
		<div class="bread-nav">
			<?php if(is_array($navigation)): $i = 0; $__LIST__ = $navigation;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i; $param = $param.'/m'.$key.'/'.$nav['id']; ?>
				<?php if($key >= (count($navigation) - 1)): ?>> <a style="color: #f60;" href="javascript:;"><?php echo ($nav["item_desc"]); ?></a>
				<?php else: ?>
					> <a href="<?php echo U('line/list'); echo ($param); ?>"><?php echo ($nav["item_desc"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			<script type="text/javascript">
//				$(document).ready(function(){
//					$('.bread-nav').find('a:last').addClass('bread-final');
//					$('.bread-nav').find('a:last').attr('href','javascript:;');
//				});
			</script>
		</div>
		<!-- 商品菜单 -->
		<div class="commodity-menu">
			<ul class="select">
				<li class="select-mine">
					<div class="select-head">
						<span>您的选择:</span>
					</div>
					<div class="select-body">
						<a class="select-clear" href="javascript:;">清除筛选条件</a>
					</div>
				</li>
				<li class="select-list">
					<div class="select-head">
						<span>产品主题:</span>
						<a class="select-all" href="javascript:;" data-id="-1">全部</a>
					</div>
					<div class="select-body select-cpzt select-list">
						<?php if(is_array($line_theme)): $i = 0; $__LIST__ = $line_theme;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lt): $mod = ($i % 2 );++$i; if($lt["type_desc"] != '新旅拍'): ?><a href="javascript:;" data-id="<?php echo ($lt["id"]); ?>"><?php echo ($lt["type_desc"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<div class="select-foot">
						
					</div>
				</li>
				<li class="select-list">
					<div class="select-head">
						<span>产品区域:</span>
						<a class="select-all" href="javascript:;" data-id="-1">全部</a>
					</div>
					<div class="select-body select-cpqy select-list">
						<?php if(is_array($line_area)): $i = 0; $__LIST__ = $line_area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$la): $mod = ($i % 2 );++$i;?><a href="javascript:;" data-id="<?php echo ($la["id"]); ?>"><?php echo ($la["type_desc"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<div class="select-foot">
						
					</div>
				</li>
				<li>
					<div class="select-head">
						<span>目的地:</span>
						<a class="select-all" href="javascript:;" data-id="-1">全部</a>
					</div>
					<div class="select-body select-mdd select-list">
						<?php if(is_array($dest)): $i = 0; $__LIST__ = $dest;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$d): $mod = ($i % 2 );++$i;?><a href="javascript:;" data-id="<?php echo ($d["id"]); ?>"><?php echo ($d["type_desc"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>		
					</div>
					<div class="select-foot">
						<a class="select-more select-more02" href="javascript:;">更多<i class="show-more"></i></a>
					</div>
				</li>
				<li class="select-hide">
					<div class="select-head">
						<span>包含景点:</span>
						<a class="select-all" href="javascript:;" data-id="-1">全部</a>
					</div>
					<div class="select-body select-jd select-list multiselect">
						<?php if(is_array($view_point)): $i = 0; $__LIST__ = $view_point;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vp): $mod = ($i % 2 );++$i;?><a href="javascript:;"  data-id="<?php echo ($vp["id"]); ?>">
								<span class="no-checked multiselect-span multiselect-hide"></span>
								<span><?php echo ($vp["type_desc"]); ?></span>
							</a><?php endforeach; endif; else: echo "" ;endif; ?>						
						<div class="btns btn-hide">
							<button type="button" class="btn-submit">确定</button>
							<button type="button" class="btn-cancel">取消</button>
						</div>
					</div>
					<div class="select-foot">
						<a class="select-checkbox" href="javascript:;"><span>+</span>多选</a>
						<a class="select-more select-more01" href="javascript:;">更多<i class="show-more"></i></a>
					</div>
				</li>
				<li class="select-hide">
					<div class="select-head">
						<span>集合地:</span>
						<a class="select-all" href="javascript:;" data-id="-1">全部</a>
					</div>
					<div class="select-body select-cfd select-list">
						<?php if(is_array($assembly_place)): $i = 0; $__LIST__ = $assembly_place;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ap): $mod = ($i % 2 );++$i;?><a href="javascript:;" data-id="<?php echo ($ap["id"]); ?>"><?php echo ($ap["type_desc"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>	
					</div>
				</li>
				
				<li class="select-hide">
					<div class="select-head">
						<span>旅行时间:</span>
						<a class="select-all" href="javascript:;" data-id="-1">全部</a>
					</div>
					<div class="select-body select-lxsj select-list">
						<?php if(is_array($month)): $i = 0; $__LIST__ = $month;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?><a href="javascript:;" data-id="<?php echo ($m["id"]); ?>"><?php echo ($m["type_desc"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>	
					</div>
				</li>
				<li class="select-hide">
					<div class="select-head">
						<span>行程天数:</span>
						<a class="select-all" href="javascript:;" data-id="-1">全部</a>
					</div>
					<div class="select-body select-xcts select-list ">
						<?php $__FOR_START_1799583005__=1;$__FOR_END_1799583005__=31;for($i=$__FOR_START_1799583005__;$i < $__FOR_END_1799583005__;$i+=1){ ?><a href="javascript:;" data-id="<?php echo ($i); ?>"><?php echo ($i); ?>天</a><?php } ?>
					</div>
				</li>
			</ul>
			<a class="select-up-down" href="javascript:;">
				<span>查看更多选项<i class="show-more"></i></span>
			</a>
		</div>
		<!--单排列表模板-->		
		<div class="single-row-content template_single_row hidden_ctrl">
			<a href="javascript:;" target="_blank"></a>
			<div class="single-row-img">
				<img src="" alt="">
			</div>
			<div class="jiriyou">
				<p><span class="day"></span>日游</p>
			</div>
			<div class="single-row-describe">
				<div class="single-row-describe-top">
					<h4 class="title"><span class="span"></span><span class="subheading"></span></h4>
					<span class="send_word"></span>
					<p><u class="assembly">集合地点：</u><u class="batch">批次：全年0期</u></p>
					<p class="destination">目的地：</p>
					<div class="single-row-describe-price">
						<h6><!--<s class="price">0元</s>--><strong class="cut_price"></strong>元起</h6>
					</div>
				</div>
				<div class="single-row-describe-bottom">
					<span class="travel_date">旅行时间：</span>
					<em class="appointment""></em>
				</div>
			</div>
		</div>

		<!--双排列表模板-->
		<div class="double-row-content template_double_row hidden_ctrl">
			<div class="template_content"> <!--double-row-left/double-row-right-->
				<a href="javascript:;" target="_blank"></a>
				<div class="template_img"> <!--double-row-left-top/double-row-right-top-->
					<img src="" alt="">
				</div>
				<div class="jiriyou">
					<p><span class="day"></span>日游</p>
				</div>
				<div class="double-row-describe">
					<h4 class="title"></h4>
					<h5 class="subheading"></h5>
					<p class="send_word describe-content"></p>
					<p><u class="assembly">集合地点：</u><u class="batch">批次：全年0期</u></p>
					<p class="destination">目的地：</p>
					<div class="double-row-describe-price">
						<h6><!--<s class="price">0元</s>--><strong class="cut_price"></strong>元起</h6>
					</div>
				</div>
			</div>
		</div>
		<!-- 列表菜单 -->
		<div class="list-menu">
			<div class="list-menu-sort">
				<div class="list-menu-sort-left">
					<a class="list-menu-sort-comprehensive sort-checked" href="javascript:;">综合排序</a>
					<a class="list-menu-sort-sales" href="javascript:;">销量<i></i></a>
					<!--<a class="list-menu-sort-price" href="javascript:;">价格<i></i></a>-->
				</div>
				<div class="list-menu-sort-right">
					<a class="list-menu-sort-y" href="javascript:;"><i class="sort-y"></i></a>
					<a class="list-menu-sort-x" href="javascript:;"><i></i></a>
				</div>
			</div>

			<!-- 单排列表 -->
			<div class="single-row">
				<?php if(is_array($lines)): $i = 0; $__LIST__ = $lines;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$line): $mod = ($i % 2 );++$i;?><div class="single-row-content" data-id="<?php echo ($line["id"]); ?>">
						<a href="<?php echo U('line/info');?>/id/<?php echo ($line["id"]); ?>" target="_blank"></a>
						<div class="single-row-img">
							<img src="<?php echo ($line["img1"]); ?>" alt="">
						</div>
						<div class="jiriyou">
							<p><span class="day"><?php echo ($line["travel_day"]); ?></span>日游</p>
						</div>
						<div class="single-row-describe">
							<div class="single-row-describe-top">
								<h4 class="title"><span class="span">【<?php echo ($line["title"]); ?>】</span><span class="subheading"><?php echo ($line["subheading"]); ?></span></h4>

								<span class="send_word"><?php echo ($line["send_word_show"]); ?></span>
								<p>
									<u class="assembly">集合地点：<?php echo ($line["assembly_point_show_text"]); ?></u>
									<u class="batch">批次：全年<?php echo count($line['batchs']);?>期</u>
								</p>
								<p class="destination">目的地：<?php echo ($line["destination_show_text"]); ?></p>
								<div class="single-row-describe-price">
									<h6>
										<?php if(empty($line['check_price'])): ?><strong class="cut_price">核算中</strong>
										<?php else: ?>
											<strong class="cut_price"><?php echo ($line["start_price_adult"]); ?></strong>元起<?php endif; ?>
									</h6>
								</div>
							</div>
							<div class="single-row-describe-bottom">
								<span class="travel_date">旅行时间： <?php echo ($line["start_time"]); ?>&nbsp;至&nbsp;<?php echo ($line["end_time"]); ?></span>
								<em class="appointment" href="<?php echo U("line/info");?>/id/<?php echo ($line["id"]); ?>"></em>
							</div>
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<!-- 双排列表 -->
			<div class="double-row">
				<?php if(is_array($lines)): $i = 0; $__LIST__ = $lines;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$line): $mod = ($i % 2 );++$i; if($key % 2 == 0): ?><div class="double-row-content">
							<div class="double-row-left">
								<div class="double-row-left-top">
					<?php else: ?>
							<div class="double-row-right">
								<div class="double-row-right-top"><?php endif; ?>
									<img src="<?php echo ($line["img1"]); ?>" alt="">
								</div>
								<div class="jiriyou">
									<p><span class="day"><?php echo ($line["travel_day"]); ?></span>日游</p>
								</div>
								<a href="<?php echo U('line/info');?>/id/<?php echo ($line["id"]); ?>" target="_blank"></a>
								<div class="double-row-describe">
									<h4 class="title"><?php echo ($line["title"]); ?></h4>
									<h5 class="subheading"><?php echo ($line["subheading_show"]); ?></h5>
									<p class="send_word describe-content"><?php echo ($line["send_word_show"]); ?></p>
									<p>
										<u class="assembly">集合地点：<?php echo ($line["assembly_point_show_text"]); ?></u>
										<u class="batch">批次：全年<?php echo count($line['batchs']);?>期</u>
									</p>
									<p class="destination">目的地：<?php echo ($line["destination_show_text"]); ?></p>
									<div class="double-row-describe-price">
										<h6>
											<?php if(empty($line['check_price'])): ?><strong class="cut_price">核算中</strong>
											<?php else: ?>
												<strong class="cut_price"><?php echo ($line["start_price_adult"]); ?></strong>元起<?php endif; ?>
										</h6>
									</div>
								</div>
							</div>
					<?php if($key % 2 > 0): ?></div> <!--double-row-content 结束符--><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					<!--数据为单数时添加double-row-content 结束符-->
					<?php if(count($lines) % 2 > 0): ?></div> <!--double-row-content 结束符--><?php endif; ?>
			</div>
			<!--<?php if(empty($lines) == true): ?><span class="no-more-data" style="text-indent:2em;">领袖户外暂时没有你所要查询的信息，产品经理们正在努力开发线路中...</span><?php endif; ?>-->
			<!-- 翻页 -->
			<div class="list-page" data-page-count="<?php echo ($page_count); ?>" data-page-index="1"></div>
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
					
					<?php $__FOR_START_1285615779__=0;$__FOR_END_1285615779__=12;for($k=$__FOR_START_1285615779__;$k < $__FOR_END_1285615779__;$k+=1){ $zt = $set_subjects['zhuanti'.$k]; if (empty($zt['url'])) { continue; } ?>
						
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
	<!-- 为什么选择我们 -->
	<!--<div class="why-choose-us">
		<a href="javascript:;">
			<img src="/source/Static/home/brand/index_img/choose_us.png" alt="">
		</a>
	</div>-->
	<!-- 分页 -->
	<script src="/source/Static/home/js/page.js"></script>
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
	<script type="text/javascript">
//		$('.appointment').click(function(){
//			location.href = '<?php echo U("line/info");?>/id/'+$(this).closest('.single-row-content').attr('data-id');
//		});

		// 添加已选条件
		function appendCondition(rootClass, did, type, only) {
			var aObj = $('.'+rootClass).find('a[data-id="'+did+'"]');
			var did = $(aObj).attr('data-id');
			var dtext = $(aObj).html();

			var vhtml = '<a class="'+ rootClass +'0" href="javascript:;" data-id="'+did+'">'
					  + '	<b class="b0">'+type+'</b>'
					  + '	<b class="b1">'+dtext+'</b>'
					  + '	<span></span>'
					  + '</a>';

			$('.select-mine').show();
			if (only != null) {
				$('.select-mine .select-body' + ' .' + rootClass + '0' ).remove();
			}
			$('.select-mine .select-body').prepend(vhtml);
		}

		// 初始化已选条件
		var curTheme = null;
		function initCondition() {
			var cdsstr = '<?php echo ($cdsstr); ?>';
			console.log('initialize condition:'+cdsstr);
			if (cdsstr != '') {
				var vhtml = '';
				var cdList = cdsstr.split('|');
				for (var i=0; i<$(cdList).length; i+=2) {
					var key = cdList[i];
					var val = cdList[i+1];
					if (cdList[i] == 'c0') {
						curTheme = cdList[i+1];
						appendCondition('select-cpzt', cdList[i+1], '产品主题-', true);
					} else if (key == 'c1') {
						appendCondition('select-mdd', cdList[i+1], '目的地-', true);
					} else if (key == 'c2') {
						appendCondition('select-jd', cdList[i+1], '包含景点-');
					} else if (key == 'c3') {
						appendCondition('select-cfd', cdList[i+1], '集合地-', true);
					} else if (key == 'c4') {
						appendCondition('select-lxsj', cdList[i+1], '旅行时间-', true);
					} else if (key == 'c5') {
						appendCondition('select-xcts', cdList[i+1], '行程天数-', true);
					} else if (key == 'c6') {
						appendCondition('select-cpqy', cdList[i+1], '产品区域-', true);
					}
				}
			}
		}

		$(document).ready(function(){
			// 初始化已选条件
			initCondition();
			// 从第二页还是加载
			pageIndex = 1;
			// 绑定滚动事件
			$(document).scroll(scrollDocument);	
		});

		// 获取基本信息
		function getConditions() {
			var cdsstr = '';
			var aObj = $('.select-mine').find('.select-body').find('a').each(function(i,el){
//				var txt = $(this).find('.b1').text()
				var cdstr = '';
				var did = $(this).attr('data-id');
				if ($(this).hasClass('select-cpzt0')) {
					cdstr = 'c0|'+did;
					curTheme = did;
				} else if ($(this).hasClass('select-mdd0')) {
					cdstr = 'c1|'+did;
				} else if ($(this).hasClass('select-jd0')) {
//					var t = textstr.replace(/(^\s*)|(\s*$)/g, "");
					cdstr = 'c2|'+did;
				} else if ($(this).hasClass('select-cfd0')) {
					cdstr = 'c3|'+did;
				} else if ($(this).hasClass('select-lxsj0')) {
					cdstr = 'c4|'+did;
				} else if ($(this).hasClass('select-xcts0')) {
//					var day = daystr.substring(0,daystr.length - 1);
					cdstr = 'c5|'+did;
				} else if ($(this).hasClass('select-cpqy0')) {
					cdstr = 'c6|'+did;
				}
				if (cdstr != '') {
					if (cdsstr != '') {
						cdsstr += '|';
					}
					cdsstr += cdstr;
				}
			});
			return cdsstr;
		}

		// 获取排序规则
		function getSorts() {
			var ssort = '';
			var sortObj = $('.list-menu-sort').find('.sort-checked');
			var iclass = $(sortObj).find('i').attr('class');
			if ($(sortObj).hasClass('list-menu-sort-sales')) {
				ssort = 'sell_count|'+(iclass == ''?'desc':'asc');
			} else if ($(sortObj).hasClass('list-menu-sort-price')) {
				ssort = 'start_price_adult|'+(iclass == ''?'desc':'asc');
			}
			return ssort;
		}

		// 初始化页码数据
//		constructionPage('.list-page', 1, '<?php echo ($page_count); ?>', findLine, true);

		// 查找产品
		var pageIndex = 0, bLoading = false, bEnd = false;
//		function findLine(pageIndex, brefresh) {
		function findLine(brefresh) {
		    if (brefresh != null && brefresh != false) {
                bEnd = false;
			}
		    if (bLoading == true || bEnd == true) {
		        return false;
			}

			var jsonData = {
//				page: pageIndex - 1,
				page: pageIndex,
				cds: getConditions(),
				sorts: getSorts(),
				refresh: brefresh,
			}

			console.log(JSON.stringify(jsonData));
            bLoading = true;
			$.post('<?php echo U("line/list");?>', jsonData, function(data){
                bLoading = false;
				if (data.jumpUrl != null) {
					location.href = data.jumpUrl;
					return false;
				}

				if (data.result.errno == 0) {
				    pageIndex ++;
				    if (brefresh != null && brefresh != false) {
						$('.single-row').empty();
						$('.double-row').empty();	
				    }
					if (data.ds != null && data.ds != 'undefined') {
						if ($('.no-more-data').length > 0) {
							console.log('开始加载新数据...');
							$('.no-more-data').addClass('hidden_ctrl');
                            bEnd = false;
						}

						for (var i=0; i < data.ds.length; i++) {
							var d = data.ds[i];
							// 单排
							var lineObj = $('.template_single_row').clone(true);
							$(lineObj).removeClass('hidden_ctrl');
							$(lineObj).removeClass('template_single_row');
							$(lineObj).attr('data-id', d.id);

							$(lineObj).find('img').attr('src',d.img1);
							$(lineObj).find('.day').html(d.travel_day);
							$(lineObj).find('.title .span').html('【'+ d.title +'】');
							$(lineObj).find('.subheading').html(d.subheading);
							$(lineObj).find('.send_word').html(d.send_word_show);
							$(lineObj).find('a').attr('href','<?php echo U("line/info");?>/id/'+ d.id);
							$(lineObj).find('.assembly').html('集合地点：'+d.assembly_point_show_text);
							$(lineObj).find('.batch').html('批次：全年'+d.batchs==null?0:$(d.batchs).length+'期');
							$(lineObj).find('.destination').html('目的地：'+d.destination_show_text);
							if (d.check_price == 0) {
								$(lineObj).find('.cut_price').parent().html('<strong class="cut_price">核算中</strong>');
							} else {
								$(lineObj).find('.cut_price').html(d.start_price_adult);
							}
							$(lineObj).find('.travel_date').html('旅行时间： '+d.start_time+'&nbsp;至&nbsp;'+d.end_time);
							$('.single-row').append(lineObj);

							// 双排
							var mLineObj = null, mRootObj = null, mContentClass = '', mImageClass = '';
							if (i % 2 == 0) {
								mRootObj = $('.template_double_row').clone(true);
								$(mRootObj).removeClass('template_double_row');
								$(mRootObj).removeClass('hidden_ctrl');
								mLineObj = $(mRootObj).find('.template_content');
								mContentClass = 'double-row-left';
								mImageClass = 'double-row-left-top';
							} else {
								mRootObj = $('.double-row').find('.double-row-content:last');
								mLineObj = $('.template_double_row').find('.template_content').clone(true);
								mContentClass = 'double-row-right';
								mImageClass = 'double-row-right-top';
							}

							$(mLineObj).removeClass('template_content');
							$(mLineObj).addClass(mContentClass);
							$(mLineObj).attr('data-id', d.id);
							var imgObj = $(mLineObj).find('.template_img');
							$(imgObj).removeClass('template_img');
							$(imgObj).addClass(mImageClass);
							$(imgObj).find('img').attr('src',d.img1);
							$(mLineObj).find('.day').html(d.travel_day);
							$(mLineObj).find('.title').html(d.title);
							$(mLineObj).find('.subheading').html(d.subheading_show);
							$(mLineObj).find('.send_word').html(d.send_word_show);
							$(mLineObj).find('a').attr('href','<?php echo U("line/info");?>/id/'+ d.id);
							$(mLineObj).find('.assembly').html('集合地点：'+d.assembly_point_show_text);
							$(mLineObj).find('.batch').html('批次：全年'+d.batchs==null?0:$(d.batchs).length+'期');
							$(mLineObj).find('.destination').html('目的地：'+d.destination_show_text);
//							$(mLineObj).find('.price').html(d.start_price_adult+'元');
							if (d.check_price == 0) {
								$(mLineObj).find('.cut_price').parent().html('<strong class="cut_price">核算中</strong>');
							} else {
								$(mLineObj).find('.cut_price').html(d.start_price_adult);
							}
							if (i % 2 == 0) {
								$('.double-row').append(mRootObj);
							} else {
								$(mRootObj).append(mLineObj);
							}
						} // end for
					} else {
						if ($('.no-more-data').length > 0) {
							$('.no-more-data').removeClass('hidden_ctrl');
							console.log('没有更多的数据可供加载...');
                            bEnd = true;
						} else {
//							var vhtml = '<span class="no-more-data" style="text-indent:2em;">领袖户外暂时没有你所要查询的信息，产品经理们正在努力开发线路中...</span>';
//							$('.list-page').before(vhtml);
							console.log('没有更多的数据可供加载1...');
                            bEnd = true;
						}
					}

					// 判断页面总数是否发生变化
//					constructionPage('.list-page', pageIndex, data.page_count, findLine);
//					double('.double-row-left', '.double-row-left-top');
//					double('.double-row-right', '.double-row-right-top');
				} else {
					console.log(data.result.message);
				}
			});
		}

		// 查询线路
		function refreshLine() {
//			var thisPageIndex = $('.list-page').attr('data-page-index');
//			findLine(thisPageIndex, 1);
			pageIndex = 0;
			findLine(1);
		}
		
		//滚动加载
//    	var lastBottom = null;
//		$(document).scroll(function(){
//	    	var b = $(document).scrollTop()+$(window).height();
//	    	if (lastBottom != null && lastBottom > b) {
//	    		return false;
//	    	}
//	    	lastBottom = b;
//	    	var destB = $('.list-page').offset().top + $('.list-page').height();
//	    	if (destB - b < 500) {
//	    		findLine();
//	    	}
//		});

		function scrollDocument() {
			var bheight = $(document).height();//获取窗口高度
			var sheight = $("body")[0].scrollHeight;//获取滚动条高度，[0]是为了把jq对象转化为js对象
			var stop = $("body").scrollTop();//滚动条距离顶部的距离
			if(stop>=sheight-bheight){
                findLine();
			}
		}
		
// 重置查询条件
		function resetCondition() {
			$.post('<?php echo U("line/resetcd");?>', '', function(){
				refreshLine();
			});
		}

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
<!-- 私有js -->
<script src="/source/Static/home/js/list.js"></script>