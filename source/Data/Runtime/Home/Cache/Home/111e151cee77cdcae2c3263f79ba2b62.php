<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>领袖户外</title>
	<!-- css Reset -->
	<link rel="stylesheet" href="/source/Static/home/common/css/cssreset.css">
	<!-- 轮播样式 -->
	<link rel="stylesheet" href="/source/Static/home/common/css/slide.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="/source/Static/home/common/css/common.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="/source/Static/common/css/common.css">
	<!-- echo -->
	<script src="/source/Static/home/common/js/echo.min.js"></script>
	<!-- 引用jq -->
	<script src="/source/Static/home/common/js/jquery-1.11.3.min.js"></script>
	<script>
		//echo
		echo.init({
		    offset: 0, //离可视区域多少像素的图片可以被加载
		    throttle: 0 //图片延迟多少毫秒加载
		});
	</script>
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
	<header>
		<div class="nav01">
			<div class="nav-top">
				<div class="nav-top-left">
					<?php if(is_array($stations)): $i = 0; $__LIST__ = $stations;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$station): $mod = ($i % 2 );++$i;?><a href="javascript:;" target="_blank"><?php echo ($station["name"]); ?> |<?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
				<div class="nav-top-right">
					<img src="/source/Static/home/common/images/login_header.png" alt=""></a>
					<?php if(empty($user) == true): ?><a href="<?php echo U('user/login');?>">登录</a> |
						<a href="<?php echo U('user/register');?>">注册</a>
					<?php else: ?>
						你好<a href="<?php echo U('user/info');?>" style="color: blue;"><?php echo ($user["show_name"]); ?></a>欢迎光临，
						<a href="<?php echo U('user/exit');?>" style="color: blue;">安全退出</a>！<?php endif; ?>
					<a href="<?php echo U('line/order');?>/type/center" target="_blank"> | 我的订单</a>
					<a href="javascript:;" target="_blank"> | 加入收藏</a>
					<a href="<?php echo U('service/center');?>" target="_blank"> | 服务中心</a>
					<img src="/source/Static/home/common/images/tel_header.png" alt="联系电话">
					<span><?php echo ($set["cs_tel"]); ?></span>
				</div>
			</div>
		</div>
		<div class="nav02">
			<div class="nav-list">
				<!--<a href="<?php echo U('index/welcome');?>"><img src="/source/Static/home/common/images/logo_header.png" alt="领袖户外"></a>-->
				<!--logo图片加链接会导致样式混乱-->
				<img src="/source/Static/home/common/images/logo_header.png" alt="领袖户外">
				<ul>
					<?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; switch($menu['item_desc']) { case '首页': $href=U('index/welcome'); break; default: $href=U('line/list'); break; } ?>
						<li class="nav-list-top"><a href="<?php echo ($href); ?>"><?php echo ($menu["item_desc"]); ?></a>
							<?php if(!empty($menu["child"])): ?><div>
								<?php if(is_array($menu["child"])): $i = 0; $__LIST__ = $menu["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><ul>
									<li><a href="<?php echo ($href); ?>"><?php echo ($c["item_desc"]); ?></a></li>
									<?php if(!empty($c["child"])): if(is_array($c["child"])): $i = 0; $__LIST__ = $c["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cc): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($href); ?>"><?php echo ($cc["item_desc"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
								</ul><?php endforeach; endif; else: echo "" ;endif; ?>
							</div><?php endif; ?>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<div class="search-header">
					<img src="/source/Static/home/common/images/search_header.png" alt="">
					<input type="text" placeholder="特惠线路...">
					<a href="javascript:;">搜索</a>
				</div>
				<script type="text/javascript">
					$('.search-header').find('a').click(function(){
						location.href = '<?php echo U("line/list");?>/cds/title|'+$(this).prev().val();						
					});
				</script>
			</div>
		</div>		
	</header>
	<!-- 私有样式 -->
	<link rel="stylesheet" href="/source/Static/home/css/pay_success.css">
	<style>
		.success-information img { top: 87px; }
	</style>
	<div id="content">
		<div class="pay-success">
			<div class="success-information">
				<img src="/source/Static/home/images/pay_success_img/error.png" alt="">
				<h3>错误信息提示</h3>
			</div>
		</div>
		<!-- 精彩专题 -->
		

	<div class="bg-gray">

		<div class="special main">

			<h2>超级目的地</h2>

			<div class="special-exhibition">

				<ul>

					<li>

						<a class="special-exhibition-product" href="javascript:;">

							<img src="/source/Static/home/images/index_img/special01.png" alt="">

							<img class="special-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">

							<div class="special-exhibition-describe">

								<h4>海口5日跟团游</h4>

								<h4>看见自己最真实的心灵</h4>

								<p>迭部是如此令人惊叹，如果不把这绝佳的地方拍摄下来，我会感到是一种罪恶……我平生未见如此绮丽的景色</p>

							</div>

						</a>

						<a class="special-exhibition-product" href="javascript:;">

							<img src="/source/Static/home/images/index_img/special02.png" alt="">

							<img class="special-img" src="/source/Static/home/images/index_img/special02_01.png" alt="">

							<div class="special-exhibition-describe">

								<h4>圣地西藏</h4>

								<h4>看见自己最真实的心灵</h4>

								<p>迭部是如此令人惊叹，如果不把这绝佳的地方拍摄下来，我会感到是一种罪恶……我平生未见如此绮丽的景色</p>

							</div>

						</a>

						<a class="special-exhibition-product" href="javascript:;">

							<img src="/source/Static/home/images/index_img/special03.png" alt="">

							<img class="special-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">

							<div class="special-exhibition-describe">

								<h4>圣地西藏</h4>

								<h4>看见自己最真实的心灵</h4>

								<p>迭部是如此令人惊叹，如果不把这绝佳的地方拍摄下来，我会感到是一种罪恶……我平生未见如此绮丽的景色</p>

							</div>

						</a>

						<a class="special-exhibition-product" href="javascript:;">

							<img src="/source/Static/home/images/index_img/special04.png" alt="">

							<img class="special-img" src="/source/Static/home/images/index_img/special03_01.png" alt="">

							<div class="special-exhibition-describe">

								<h4>圣地西藏</h4>

								<h4>看见自己最真实的心灵</h4>

								<p>迭部是如此令人惊叹，如果不把这绝佳的地方拍摄下来，我会感到是一种罪恶……我平生未见如此绮丽的景色</p>

							</div>

						</a>

					</li>

					<li>

						<a class="special-exhibition-product" href="javascript:;">

							<img src="/source/Static/home/images/index_img/special04.png" alt="">

							<img class="special-img" src="/source/Static/home/images/index_img/special03_01.png" alt="">

							<div class="special-exhibition-describe">

								<h4>圣地西藏</h4>

								<h4>看见自己最真实的心灵</h4>

								<p>迭部是如此令人惊叹，如果不把这绝佳的地方拍摄下来，我会感到是一种罪恶……我平生未见如此绮丽的景色</p>

							</div>

						</a>

						<a class="special-exhibition-product" href="javascript:;">

							<img src="/source/Static/home/images/index_img/special03.png" alt="">

							<img class="special-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">

							<div class="special-exhibition-describe">

								<h4>圣地西藏</h4>

								<h4>看见自己最真实的心灵</h4>

								<p>迭部是如此令人惊叹，如果不把这绝佳的地方拍摄下来，我会感到是一种罪恶……我平生未见如此绮丽的景色</p>

							</div>

						</a>

						<a class="special-exhibition-product" href="javascript:;">

							<img src="/source/Static/home/images/index_img/special02.png" alt="">

							<img class="special-img" src="/source/Static/home/images/index_img/special03_01.png" alt="">

							<div class="special-exhibition-describe">

								<h4>圣地西藏</h4>

								<h4>看见自己最真实的心灵</h4>

								<p>迭部是如此令人惊叹，如果不把这绝佳的地方拍摄下来，我会感到是一种罪恶……我平生未见如此绮丽的景色</p>

							</div>

						</a>

						<a class="special-exhibition-product" href="javascript:;">

							<img src="/source/Static/home/images/index_img/special01.png" alt="">

							<img class="special-img" src="/source/Static/home/images/index_img/special02_01.png" alt="">

							<div class="special-exhibition-describe">

								<h4>圣地西藏</h4>

								<h4>看见自己最真实的心灵</h4>

								<p>迭部是如此令人惊叹，如果不把这绝佳的地方拍摄下来，我会感到是一种罪恶……我平生未见如此绮丽的景色</p>

							</div>

						</a>

					</li>

					<li>

						<a class="special-exhibition-product" href="javascript:;">

							<img src="/source/Static/home/images/index_img/special03.png" alt="">

							<img class="special-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">

							<div class="special-exhibition-describe">

								<h4>圣地西藏</h4>

								<h4>看见自己最真实的心灵</h4>

								<p>迭部是如此令人惊叹，如果不把这绝佳的地方拍摄下来，我会感到是一种罪恶……我平生未见如此绮丽的景色</p>

							</div>

						</a>

						<a class="special-exhibition-product" href="javascript:;">

							<img src="/source/Static/home/images/index_img/special01.png" alt="">

							<img class="special-img" src="/source/Static/home/images/index_img/special02_01.png" alt="">

							<div class="special-exhibition-describe">

								<h4>圣地西藏</h4>

								<h4>看见自己最真实的心灵</h4>

								<p>迭部是如此令人惊叹，如果不把这绝佳的地方拍摄下来，我会感到是一种罪恶……我平生未见如此绮丽的景色</p>

							</div>

						</a>

						<a class="special-exhibition-product" href="javascript:;">

							<img src="/source/Static/home/images/index_img/special04.png" alt="">

							<img class="special-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">

							<div class="special-exhibition-describe">

								<h4>圣地西藏</h4>

								<h4>看见自己最真实的心灵</h4>

								<p>迭部是如此令人惊叹，如果不把这绝佳的地方拍摄下来，我会感到是一种罪恶……我平生未见如此绮丽的景色</p>

							</div>

						</a>

						<a class="special-exhibition-product" href="javascript:;">

							<img src="/source/Static/home/images/index_img/special02.png" alt="">

							<img class="special-img" src="/source/Static/home/images/index_img/special03_01.png" alt="">

							<div class="special-exhibition-describe">

								<h4>圣地西藏</h4>

								<h4>看见自己最真实的心灵</h4>

								<p>迭部是如此令人惊叹，如果不把这绝佳的地方拍摄下来，我会感到是一种罪恶……我平生未见如此绮丽的景色</p>

							</div>

						</a>					

					</li>

				</ul>

			</div>

		</div>

	</div>
	<!-- 顶部轮播 -->
<script src="/source/Static/home/common/js/showAndHide.js"></script>
<script src="/source/Static/home/js/unslider.min.js"></script>
		<!-- 热卖单品 -->
		<div class="bg-white">
			<div class="hot-sale main">                                     
				<h2>热卖单品</h2>
				<p><a href="javascript:;">更多</a></p>
				<ul class="tab-list">
					<li><a href="javascript:;" class="g cur" title="tab-hot-sale01">推荐</a></li>
					<li><a href="javascript:;" title="tab-hot-sale02">目的地</a></li>
					<li><a href="javascript:;" title="tab-hot-sale03">深度游</a></li>
					<li><a href="javascript:;" title="tab-hot-sale04">摄影游</a></li>
					<li><a href="javascript:;" title="tab-hot-sale05">主题游</a></li>
					<div class="move-bg"></div>
				</ul>
				
				<div class="hot-sale-product" id="tab-hot-sale01">
					<div class="hot-sale-product-small">
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale01.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/hot01_01.png" alt="">
							<div class="aaa">
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale03.jpg" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
					</div>
					<a href="javascript:;" class="hot-sale-big">
						<img src="/source/Static/home/images/index_img/hot_sale03.jpg" alt="">
						<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">
						<div>
							<h4>探索秘境茂兰</h4>
							<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
							<p>￥<em>5680</em>起</p>
							<strong>查看详情></strong>
						</div>
					</a>
					<div class="hot-sale-product-small">
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale02.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/hot01_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale01.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/hot02_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
					</div>
				</div>
				<div class="hot-sale-product" id="tab-hot-sale02">
					<div class="hot-sale-product-small">
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale01.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/hot01_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale01.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/hot02_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
					</div>
					<a href="javascript:;" class="hot-sale-big">
						<img src="/source/Static/home/images/index_img/hot_sale03.jpg" alt="">
						<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">
						<div>
							<h4>探索秘境茂兰</h4>
							<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
							<p>￥<em>5680</em>起</p>
							<strong>查看详情></strong>
						</div>
					</a>
					<div class="hot-sale-product-small">
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale01.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale01.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
					</div>
				</div>
				<div class="hot-sale-product" id="tab-hot-sale03">
					<div class="hot-sale-product-small">
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale01.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale02.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
					</div>
					<a href="javascript:;" class="hot-sale-big">
						<img src="/source/Static/home/images/index_img/hot_sale03.jpg" alt="">
						<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">
						<div>
							<h4>探索秘境茂兰</h4>
							<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
							<p>￥<em>5680</em>起</p>
							<strong>查看详情></strong>
						</div>
					</a>
					<div class="hot-sale-product-small">
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale01.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale01.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
					</div>
				</div>
				<div class="hot-sale-product" id="tab-hot-sale04">
					<div class="hot-sale-product-small">
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale01.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale02.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
					</div>
					<a href="javascript:;" class="hot-sale-big">
						<img src="/source/Static/home/images/index_img/hot_sale02.png" alt="">
						<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">
						<div>
							<h4>探索秘境茂兰</h4>
							<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
							<p>￥<em>5680</em>起</p>
							<strong>查看详情></strong>
						</div>
					</a>
					<div class="hot-sale-product-small">
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale01.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale01.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
					</div>
				</div>
				<div class="hot-sale-product" id="tab-hot-sale05">
					<div class="hot-sale-product-small">
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale01.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale02.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/hot01_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
					</div>
					<a href="javascript:;" class="hot-sale-big">
						<img src="/source/Static/home/images/index_img/hot_sale02.png" alt="">
						<img class="hot-sale-img" src="/source/Static/home/images/index_img/hot02_01.png" alt="">
						<div>
							<h4>探索秘境茂兰</h4>
							<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
							<p>￥<em>5680</em>起</p>
							<strong>查看详情></strong>
						</div>
					</a>
					<div class="hot-sale-product-small">
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale01.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
						<a href="javascript:;">
							<img src="/source/Static/home/images/index_img/hot_sale01.png" alt="">
							<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">
							<div>
								<h4>探索秘境茂兰</h4>
								<span>在瑶族民宿内用过老乡早早准备好的特色早餐打油茶后，我们驱车前往侗族大歌的发源地——小黄村</span>
								<p>￥<em>5680</em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- 更改tab-bg -->
	<script src="/source/Static/home/common/js/movebg.js"></script>
	<!-- tab -->
	<script src="/source/Static/home/common/js/tab.js"></script>

	<script>
		//small轮播
		$('.special-exhibition').unslider({ 
			dots: true
		});
		//精彩专题
		$('.special-exhibition-product').fadeInAndOut('special-img', 'div');
		//move-bg
	 	$(".tab-list").movebg({	
	 		width:78/*滑块的大小*/,
	        extra:0/*额外反弹的距离*/,
	        speed:500/*滑块移动的速度*/,
	        rebound_speed:400/*滑块反弹的速度*/
	    });
	    //热门单品
		$('.hot-sale-product a').hover( 
			function () {
				$(this).find('.hot-sale-img').stop().hide(500);			
			},
			function () {
				$(this).find('.hot-sale-img').stop().show(1000);	
			}
		);
	</script>

	<!-- 右侧侧边栏 -->
	<aside>
		<div class="join-us">
			<a href="javascript:;"></a>
		</div>
		<a class="aside_hot" href="javascript:;">
			<i></i>
			<div class="aside_show aside_show_hot">
				<p>热门推荐</p>
			</div>
		</a>
		<a class="aside_mine" href="<?php echo U('user/info');?>">
			<i></i>
			<div class="aside_show aside_show_mine">
				<p>个人中心</p>
			</div>
		</a>
		<a class="aside_order" href="<?php echo U('line/order');?>/type/center">
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
		<a class="aside_qq" href="http://pqt.zoosnet.net/LR/Chatpre.aspx?id=PQT43116159&lng=cn" target="_blank">
			<i></i>
			<div class="aside_show aside_show_qq">
				<p>我的QQ</p>
			</div>
		</a>
		<a class="aside_top" href="#">
			<i></i>
		</a>
	</aside>

	<footer>
		<div class="footer-content">
			<div class="footer-content-left">
				<?php if(is_array($question_type)): $i = 0; $__LIST__ = $question_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$qt): $mod = ($i % 2 );++$i;?><ul class="<?php echo ($qt["class"]); ?>">
						<li><?php echo ($qt["type_desc"]); ?></li>
						<?php if(is_array($qt["questions"])): $i = 0; $__LIST__ = $qt["questions"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$quest): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('service/question');?>/id/<?php echo ($quest["id"]); ?>"><?php echo ($quest["content"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul><?php endforeach; endif; else: echo "" ;endif; ?>
				<div class="small-link small-link-top">
					<p>
						主题旅游：
						<a href="javascript:;">华东</a>
						<a href="javascript:;">坝上</a>
						<a href="javascript:;">柬埔寨</a>
						<a href="javascript:;">西藏</a>
						<a href="javascript:;">额济纳旗</a>
						<a href="javascript:;">雪乡旅游</a>
						<a href="javascript:;">云南摄影</a>
						<a href="javascript:;">行摄陕西</a>
						<a href="javascript:;">黔东南</a>
						<a href="javascript:;">四川</a>
						<a href="javascript:;">青海</a>
						<a href="javascript:;">新疆</a>
						<a href="javascript:;">甘南</a>
						<a href="javascript:;">川藏</a>
						<a href="javascript:;">呼伦贝尔</a>
					</p>
				</div>
				<div class="small-link small-link-bottom">
					<p>
						友情链接：
						<a href="javascript:;">蓬莱</a>
						<a href="javascript:;">北京会展</a>
						<a href="javascript:;">驴友论坛</a>
						<a href="javascript:;">天涯户外</a>
						<a href="javascript:;">户外轨迹路线</a>
						<a href="javascript:;">张家界旅游</a>
						<a href="javascript:;">渭南户外港</a>
						<a href="javascript:;">农家院旅游</a>
						<a href="javascript:;">行者物语网</a>
						<a href="javascript:;">携程主题游</a>
					</p>
				</div>
			</div>
			<div class="footer-content-right">
				<img src="/source/Static/home/common/images/footer_erweima.png" alt="">
			</div>
		</div>
	</footer>
	<div class="footer-bottom">
		<div class="footer-bottom-content">
			<p>
				领袖户外服务信息：
				<a href="javascript:;">关于我们</a>
				|
				<a href="javascript:;">联系我们</a>
				|
				<a href="javascript:;">招贤纳士</a>
				|
				<a href="javascript:;">帮助中心</a>
				|
				<a href="javascript:;">商务合作</a>
			</p>
			<span>Copyright © 2006-2014 kllife.com | 陕西浪客国际旅行社有限责任公司版权所有</span><em>公司地址：陕西省西安市雁塔区太白南路上上国际</em>
			<br>
			<span>领袖户外经营许可证号：L-SNX00306 陕ICP备14011728号-1</span>
		</div>
	</div>
	
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
</body>
</html>