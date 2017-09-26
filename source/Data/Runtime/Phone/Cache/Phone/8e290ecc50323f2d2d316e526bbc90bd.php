<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- 优先使用 IE 最新版本和 Chrome -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <!-- 1:1显示 -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- 忽略页面中的数字识别为电话号码和邮箱 -->
	<meta name="format-detection" content="telephone=no,email=no" />
	<!-- 允许全屏浏览 ios -->
	<meta content="yes" name="apple-mobile-web-app-capable" />
	<!-- 启用360浏览器的极速模式(webkit) -->
    <meta name="renderer" content="webkit">
    <!-- 避免IE使用兼容模式 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 不让百度转码 -->
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!-- 针对手持设备优化，主要是针对一些老的不识别viewport的浏览器，比如黑莓 -->
    <meta name="HandheldFriendly" content="true">
    <!-- 微软的老式浏览器 -->
    <meta name="MobileOptimized" content="320">
    <!-- uc强制竖屏 -->
    <meta name="screen-orientation" content="portrait">
    <!-- QQ强制竖屏 -->
    <meta name="x5-orientation" content="portrait">
	<!-- windows phone 点击无高光 -->
    <meta name="msapplication-tap-highlight" content="no">    
	<meta content="领袖户外" name="author"/>	
	<!--分销标题关键字-->
	<?php if(empty($duid) == false): if(C('MENU_CURRENT') == 'line_content'): ?><title><?php echo ($line["title"]); ?>-<?php echo ($line["subheading"]); ?></title>
		<?php else: ?>
			<title><?php echo ($fxset["shop_title"]["data"]["value"]); ?></title><?php endif; ?>
	<!--特殊专题新疆标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_xinjiang'): ?>
	    <meta content="新疆驴友网,禾木驴友网,新疆驴友攻略,新疆景点大全,喀纳斯驴友网,新疆定制游,新疆旅游价格,新疆旅游费用" name="keywords"/>
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
	
	<link rel="stylesheet" href="/source/Static/phone/common/css/light7.css">
	<link rel="stylesheet" href="/source/Static/common/css/common.css">
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="/source/Static/common/js/jquery-1.11.1.min.js"></script>
	<script src="/source/Static/common/js/functions.js"></script>

	<!-- jq -->
	<!--<script src="/source/Static/phone/common/js/jquery.min.js"></script>-->
	<style>
		.black-mark { display: none; position: fixed; top:0; left:0; width: 100%; height: 100%; text-align: center; color:#ececec; background: rgba(0,0,0,.5); z-index:3000; }
		.black-mark p { margin-top: 230px; color: #fff; text-align: center; }
	</style>
	<script>			
		function ShowMark(){
			$('.black-mark').show();
		};
		function HideMark(){
			$('.black-mark').hide();
		};		
	</script>
</head>
<body>
	<div class="black-mark">
		<p>稍等一会儿...</p>
	</div>
<!-- swiper -->
<link rel="stylesheet" href="/source/Static/phone/common/css/swiper-3.3.1.min.css">
<!-- mycss -->
<link rel="stylesheet" href="/source/Static/phone/css/welcome.css">
<!--小团慢css-->
<link rel="stylesheet" href="/source/Static/phone/css/slow-travel.css">
<div class="page">
    	    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/list');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>目的地</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>论坛</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a>
	    	<?php else: ?>
			    <a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('fenxiao/list');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>目的地</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a><?php endif; ?>
		</nav>
		<!--<script src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>-->
		<script type="text/javascript">
//            jQuery(document).ready(function($){
//                $("img").lazyload({
//                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
//                    effect      : "fadeIn",
//                    threshold : 0,
//                    failure_limit : 10,
//                    skip_invisible : false
//                });
//            });

			$('nav').find('a:last-child').click(function(){
				$.post('<?php echo U("index/url");?>', {type:'nav_mine'}, function(data){
					if (data.result.errno == 0) {
						if (data.jumpUrl != null) {
							location.href = data.jumpUrl;
						}
					} else {
						alert(data.result.message);
					}
				});
			});
		</script>
    <div class="content">
        <!-- 这里是页面内容区 -->
        <!-- slider -->
        <div class="module01">
            <div class="swiper-container" >
                <div class="swiper-wrapper">
                    <?php $__FOR_START_583758206__=1;$__FOR_END_583758206__=7;for($i=$__FOR_START_583758206__;$i <= $__FOR_END_583758206__;$i+=1){ $img = $set['lunbo'.$i]; $url = $set['lunbo'.$i.'_url']; ?>
                        <div class="swiper-slide"><a href="<?php echo ($url); ?>" external><img src="<?php echo ($img); ?>" alt=""></a></div><?php } ?>
                </div>
            </div>
        </div>
        <!-- slide 点点点-->
        <div class="swiper-pagination swiper-pagination-bullets"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>
        <!-- 电话 -->
        <div class="telephone">
            <a href="tel:400-080-5860" external><img src="/source/Static/phone/images/index/telephone.png" alt=""></a>
        </div>
        <!-- logo 搜索 -->
        <div class="logo-search">
            <div class="logo-search-content">
                <div class="searchbar">
                    <img src="/source/Static/phone/images/index/logo.png" alt="">
                    <div class="search-input">
                        <i class="iconfont">&#xe607;</i>
                        <label class="icon icon-search" for="search"></label>
                        <input type="search" id="search" value="<?php echo ($station_id); ?>" style="padding-left: 1.2rem;" placeholder="搜索产品...">

                    </div>
                    <script type="text/javascript">
                        $("#search").keydown(function(event){
                            if(event.which == 13){
                                $('#search').blur();
                            }
                        });

                        $('#search').blur(function(){
                            var search_val = $(this).val();
                            $.post('<?php echo U("line/search");?>', {searchval:search_val}, function(data){
                                if (data.jumpUrl != null) {
                                    location.href = data.jumpUrl;
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
        <!-- 顶部 -->
        <div class="top-div">
            <!-- 顶部分类 -->
            <div class="content-padded grid-demo">
                <div class="top-list">
                    <div class="top-sublist">
                        <a href="<?php echo U('line/list');?>/t/sd" external>
                            <img src="/source/Static/phone/images/index/2.png" alt="">
                            <p>小团慢旅行</p>
                        </a>
                    </div>
                    <div class="top-sublist">
                        <a href="<?php echo U('line/xiezhenlvxing');?>" external>
                            <img src="/source/Static/phone/images/index/5.png" alt="">
                            <p>写真旅行</p>
                        </a>
                    </div>
                    <div class="top-sublist">
                        <a href="<?php echo U('line/list');?>/t/sy" external>
                            <img src="/source/Static/phone/images/index/3.png" alt="">
                            <p>摄影游</p>
                        </a>
                    </div>
                    <div class="top-sublist">
                        <a href="<?php echo U('line/book');?>" external>
                            <img src="/source/Static/phone/images/index/4.png" alt="">
                            <p>定制游</p>
                        </a>
                    </div>
                </div>
                <!--<div class="top-list">
                    <div class="top-sublist">
                        <a href="<?php echo U('line/list');?>/t/zb" external>
                            <img src="/source/Static/phone/images/index/1.png" alt="">
                            <p>周边游</p>
                        </a>
                    </div>
                    <div class="top-sublist">
                        <a href="javascript:;" external>
                            <img src="/source/Static/phone/images/index/6.png" alt="">
                            <p>深度游</p>
                        </a>
                    </div>
                    <div class="top-sublist">
                        <a href="javascript:;" external>
                            <img src="/source/Static/phone/images/index/7.png" alt="">
                            <p>摄影游</p>
                        </a>
                    </div>
                    <div class="top-sublist">
                        <a href="javascript:;" external>
                            <img src="/source/Static/phone/images/index/8.png" alt="">
                            <p>出境游</p>
                        </a>
                    </div>
                </div>-->
            </div>
            <!-- end 顶部分类 -->
            <!-- 报名动态 -->
            <div class="swiper_wrap">
                <img src="/source/Static/phone/images/index/baoming.png" alt="报名动态">
                <ul class="font_inner">
                    <?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('line/info');?>/id/<?php echo ($order["lineid"]); ?>">
                            <?php echo ($order["addtime_short_show"]); ?>
                            <span><?php echo ($order["mob_show"]); ?></span>
                            <?php echo ($order["title_short_show"]); ?>
                        </a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
        <!-- end 顶部 -->
        <!--小团慢-->
        <div class="slow-travel">
            <a href="<?php echo U('subject/brand');?>" external>
                <img src="/source/Static/phone/images/index/xiaotuanman.jpg" alt="">
            </a>
        </div>
        <!-- 小专题 -->
        <!--<div class="special">
            <?php $titleColor = array('f60','75b168','41d3fd','f50c3d'); $divStyle=array('border-right: 1px solid #dcdcdc;', '', 'border-right: 1px solid #dcdcdc;', ''); ?>
            <?php $__FOR_START_1236761097__=0;$__FOR_END_1236761097__=4;for($i=$__FOR_START_1236761097__;$i < $__FOR_END_1236761097__;$i+=1){ $rowClass = intval($i / 2) == 0 ? 'border-bottom: 1px solid #dcdcdc;' : ''; $zt = $set['zhuanti'.$i]; ?>
                <?php if($i % 2 == 0): ?><div class="special-list" style="<?php echo ($rowClass); ?>"><?php endif; ?>
                    <div class="special-sublist" style="<?php echo ($divStyle[$i]); ?>">
                        <a href="<?php echo ($zt["url"]); ?>" external>
                            <span style="color: #<?php echo ($titleColor[$i]); ?>;"><?php echo ($zt["title"]); ?></span>
                            <p><?php echo ($zt["subheading"]); ?></p>
                            <img src="<?php echo ($zt["img_main"]); ?>" alt="">
                        </a>
                    </div>
                <?php if($i % 2 == 1): ?></div><?php endif; } ?>
        </div>-->
        <!--超级目的地-->
        <div class="module02">
            <div class="tit">超级目的地</div>
            <div class="swiper-container" style="padding-left:3%;padding-right:3%;">
                <div class="swiper-wrapper">
                    <?php if(is_array($set)): $i = 0; $__LIST__ = $set;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zt): $mod = ($i % 2 );++$i; if(strpos($key,'zhuanti') === 0): ?><div class="swiper-slide" style="position: relative;">
                                <?php $url = str_replace('home','phone',$zt['url']); ?>
                                <a href="<?php echo ($url); ?>" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%" external></a>
                                <div><img src="<?php echo ($zt["img_main"]); ?>" alt=""></div>
                                <p class="lg"><?php echo ($zt["title"]); ?></p>
                                <p class="sm"><?php echo ($zt["subheading"]); ?></p>
                            </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <!-- Add Pagination -->
                <!--<div class="swiper-pagination"></div>-->
            </div>
        </div>
        <!-- end 小专题 -->

        <!-- 热卖专区 -->
        <div class="hot-sale">
            <h3>热卖专区</h3>
            <div class="hot-sale-content">
                <!-- 切换 -->
                <div class="buttons-tab">
                    <?php if(is_array($set["hot_line_tab"])): $i = 0; $__LIST__ = $set["hot_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key < 5): if($key == 0): ?><a href="#<?php echo ($tab["type_key"]); ?>" class="tab-link active button"><?php echo ($tab["type_desc"]); ?></a>
                                <?php else: ?>
                                <a href="#<?php echo ($tab["type_key"]); ?>" class="tab-link button"><?php echo ($tab["type_desc"]); ?></a><?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="tabs">
                    <?php if(is_array($set["hot_line_tab"])): $i = 0; $__LIST__ = $set["hot_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><div id="<?php echo ($tab["type_key"]); ?>" class="tab active">
                                <?php else: ?>
                                <div id="<?php echo ($tab["type_key"]); ?>" class="tab"><?php endif; ?>
                        <!-- 深度游 -->
                        <div class="depth-travel">
                            <div class="depth-travel-content">
                                <div class="travel-content">
                                    <?php $__FOR_START_359124862__=0;$__FOR_END_359124862__=5;for($i=$__FOR_START_359124862__;$i < $__FOR_END_359124862__;$i+=1){ $v = $set[$tab['type_key'].$i]; if (empty($v)) { continue; } ?>
                                        <div class="card demo-card-header-pic">
                                            <div class="card-content">
                                                <img src="<?php echo ($v["img1"]); ?>" alt="">
                                                <div class="card-content-inner">
                                                    <p><?php echo ($v["title"]); ?></p>
                                                    <p><?php echo ($v["subheading"]); ?></p>
                                                </div>
                                                <!-- 跳转a -->
                                                <a href="<?php echo U('line/info');?>/id/<?php echo ($v["id"]); ?>" external></a>
                                            </div>
                                            <div class="card-footer">
                                                <span>出发地：<?php echo ($v['assembly_point_show_text']); ?></span>
                                                <a href="<?php echo U('line/info');?>/id/<?php echo ($v["id"]); ?>" class="link active-recommend">
                                                    <?php if(empty($v['check_price'])): ?><span>核算中</span>
                                                        <?php else: ?>
                                                        <span>￥<?php echo ($v["start_price_adult"]); ?>元起</span><?php endif; ?>
                                                </a>
                                            </div>
                                        </div><?php } ?>

                                    <!-- 查看更多超值热卖 -->
                                    <a href="<?php echo U('line/list');?>" external>查看更多超值热卖</a>
                                </div>
                            </div>
                        </div>
                </div> <!--结束tab--><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
    </div>

    <!-- 小团慢旅行 -->
    <div class="hot-sale">
        <h3>小团慢旅行</h3>
        <div class="hot-sale-content">
            <!-- 切换 -->
            <div class="buttons-tab">
                <?php if(is_array($set["depth_line_tab"])): $i = 0; $__LIST__ = $set["depth_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key < 5): if($key == 0): ?><a href="#<?php echo ($tab["type_key"]); ?>" class="tab-link active button"><?php echo ($tab["type_desc"]); ?></a>
                            <?php else: ?>
                            <a href="#<?php echo ($tab["type_key"]); ?>" class="tab-link button"><?php echo ($tab["type_desc"]); ?></a><?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="tabs">
                <?php if(is_array($set["depth_line_tab"])): $i = 0; $__LIST__ = $set["depth_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><div id="<?php echo ($tab["type_key"]); ?>" class="tab active">
                            <?php else: ?>
                            <div id="<?php echo ($tab["type_key"]); ?>" class="tab"><?php endif; ?>
                    <!-- 小团慢旅行 -->
                    <div class="depth-travel">
                        <div class="depth-travel-content">
                            <div class="travel-content">
                                <?php $__FOR_START_847729994__=0;$__FOR_END_847729994__=6;for($i=$__FOR_START_847729994__;$i < $__FOR_END_847729994__;$i+=1){ $v = $set[$tab['type_key'].$i]; if (empty($v)) { continue; } ?>
                                    <div class="card demo-card-header-pic">
                                        <div class="card-content">
                                            <img src="<?php echo ($v["img1"]); ?>" alt="">
                                            <div class="card-content-inner">
                                                <p><?php echo ($v["title"]); ?></p>
                                                <p><?php echo ($v["subheading"]); ?></p>
                                            </div>
                                            <!-- 跳转a -->
                                            <a href="<?php echo U('line/info');?>/id/<?php echo ($v["id"]); ?>" external></a>
                                        </div>
                                        <div class="card-footer">
                                            <span>出发地：<?php echo ($v['assembly_point_show_text']); ?></span>
                                            <a href="<?php echo U('line/info');?>/id/<?php echo ($v["id"]); ?>" class="link active-recommend">
                                                <?php if(empty($v['check_price'])): ?><span>核算中</span>
                                                    <?php else: ?>
                                                    <span>￥<?php echo ($v["start_price_adult"]); ?>元起</span><?php endif; ?>
                                            </a>
                                        </div>
                                    </div><?php } ?>

                                <!-- 查看更多周边游 -->
                                <a href="<?php echo U('line/list');?>/t/sd/" external>查看更多产品</a>

                            </div>
                        </div>
                    </div>
            </div> <!--结束tab--><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>

<!-- 写真旅行 -->
<div class="hot-sale">
    <h3>写真旅行</h3>
    <div class="hot-sale-content">
        <!-- 切换 -->
        <div class="buttons-tab">
            <?php if(is_array($set["qinglvpai_line_tab"])): $i = 0; $__LIST__ = $set["qinglvpai_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key < 5): if($key == 0): ?><a href="#<?php echo ($tab["type_key"]); ?>" class="tab-link active button"><?php echo ($tab["type_desc"]); ?></a>
                        <?php else: ?>
                        <a href="#<?php echo ($tab["type_key"]); ?>" class="tab-link button"><?php echo ($tab["type_desc"]); ?></a><?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="tabs">
            <?php if(is_array($set["qinglvpai_line_tab"])): $i = 0; $__LIST__ = $set["qinglvpai_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><div id="<?php echo ($tab["type_key"]); ?>" class="tab active">
                        <?php else: ?>
                        <div id="<?php echo ($tab["type_key"]); ?>" class="tab"><?php endif; ?>
                <!-- 写真旅行 -->
                <div class="depth-travel">
                    <div class="depth-travel-content">
                        <div class="travel-content">
                            <?php $__FOR_START_1380798036__=0;$__FOR_END_1380798036__=6;for($i=$__FOR_START_1380798036__;$i < $__FOR_END_1380798036__;$i+=1){ $v = $set[$tab['type_key'].$i]; if (empty($v)) { continue; } ?>
                                <div class="card demo-card-header-pic">
                                    <div class="card-content">
                                        <img src="<?php echo ($v["img1"]); ?>" alt="">
                                        <div class="card-content-inner">
                                            <p><?php echo ($v["title"]); ?></p>
                                            <p><?php echo ($v["subheading"]); ?></p>
                                        </div>
                                        <!-- 跳转a -->
                                        <a href="<?php echo U('line/info');?>/id/<?php echo ($v["id"]); ?>" external></a>
                                    </div>
                                    <div class="card-footer">
                                        <span>出发地：<?php echo ($v['assembly_point_show_text']); ?></span>
                                        <a href="<?php echo U('line/info');?>/id/<?php echo ($v["id"]); ?>" class="link active-recommend">
                                            <?php if(empty($v['check_price'])): ?><span>核算中</span>
                                                <?php else: ?>
                                                <span>￥<?php echo ($v["start_price_adult"]); ?>元起</span><?php endif; ?>
                                        </a>
                                    </div>
                                </div><?php } ?>

                            <!-- 查看更多周边游 -->
                            <a href="<?php echo U('line/list');?>/t/qlp/" external>查看更多产品</a>

                        </div>
                    </div>
                </div>
        </div> <!--结束tab--><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
</div>

<!-- 摄影游 -->
<div class="hot-sale">
    <h3>摄影游</h3>
    <div class="hot-sale-content">
        <!-- 切换 -->
        <div class="buttons-tab">
            <?php if(is_array($set["photograph_line_tab"])): $i = 0; $__LIST__ = $set["photograph_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key < 5): if($key == 0): ?><a href="#<?php echo ($tab["type_key"]); ?>" class="tab-link active button"><?php echo ($tab["type_desc"]); ?></a>
                        <?php else: ?>
                        <a href="#<?php echo ($tab["type_key"]); ?>" class="tab-link button"><?php echo ($tab["type_desc"]); ?></a><?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="tabs">
            <?php if(is_array($set["photograph_line_tab"])): $i = 0; $__LIST__ = $set["photograph_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><div id="<?php echo ($tab["type_key"]); ?>" class="tab active">
                        <?php else: ?>
                        <div id="<?php echo ($tab["type_key"]); ?>" class="tab"><?php endif; ?>
                <!-- 摄影游 -->
                <div class="depth-travel">
                    <div class="depth-travel-content">
                        <div class="travel-content">
                            <?php $__FOR_START_2132659396__=0;$__FOR_END_2132659396__=6;for($i=$__FOR_START_2132659396__;$i < $__FOR_END_2132659396__;$i+=1){ $v = $set[$tab['type_key'].$i]; if (empty($v)) { continue; } ?>
                                <div class="card demo-card-header-pic">
                                    <div class="card-content">
                                        <img src="<?php echo ($v["img1"]); ?>" alt="">
                                        <div class="card-content-inner">
                                            <p><?php echo ($v["title"]); ?></p>
                                            <p><?php echo ($v["subheading"]); ?></p>
                                        </div>
                                        <!-- 跳转a -->
                                        <a href="<?php echo U('line/info');?>/id/<?php echo ($v["id"]); ?>" external></a>
                                    </div>
                                    <div class="card-footer">
                                        <span>出发地：<?php echo ($v['assembly_point_show_text']); ?></span>
                                        <a href="<?php echo U('line/info');?>/id/<?php echo ($v["id"]); ?>" class="link active-recommend">
                                            <?php if(empty($v['check_price'])): ?><span>核算中</span>
                                                <?php else: ?>
                                                <span>￥<?php echo ($v["start_price_adult"]); ?>元起</span><?php endif; ?>
                                        </a>
                                    </div>
                                </div><?php } ?>

                            <!-- 查看更多周边游 -->
                            <a href="<?php echo U('line/list');?>/t/sy/" external>查看更多产品</a>

                        </div>
                    </div>
                </div>
        </div> <!--结束tab--><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
</div>

<!-- 民族行 -->
<div class="hot-sale">
    <h3>民族行</h3>
    <div class="hot-sale-content">
        <!-- 切换 -->
        <div class="buttons-tab">
            <?php if(is_array($set["theme_line_tab"])): $i = 0; $__LIST__ = $set["theme_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key < 5): if($key == 0): ?><a href="#<?php echo ($tab["type_key"]); ?>" class="tab-link active button"><?php echo ($tab["type_desc"]); ?></a>
                        <?php else: ?>
                        <a href="#<?php echo ($tab["type_key"]); ?>" class="tab-link button"><?php echo ($tab["type_desc"]); ?></a><?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="tabs">
            <?php if(is_array($set["theme_line_tab"])): $i = 0; $__LIST__ = $set["theme_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><div id="<?php echo ($tab["type_key"]); ?>" class="tab active">
                        <?php else: ?>
                        <div id="<?php echo ($tab["type_key"]); ?>" class="tab"><?php endif; ?>
                <!-- 民族行 -->
                <div class="depth-travel">
                    <div class="depth-travel-content">
                        <div class="travel-content">
                            <?php $__FOR_START_1221422051__=0;$__FOR_END_1221422051__=6;for($i=$__FOR_START_1221422051__;$i < $__FOR_END_1221422051__;$i+=1){ $v = $set[$tab['type_key'].$i]; if (empty($v)) { continue; } ?>
                                <div class="card demo-card-header-pic">
                                    <div class="card-content">
                                        <img src="<?php echo ($v["img1"]); ?>" alt="">
                                        <div class="card-content-inner">
                                            <p><?php echo ($v["title"]); ?></p>
                                            <p><?php echo ($v["subheading"]); ?></p>
                                        </div>
                                        <!-- 跳转a -->
                                        <a href="<?php echo U('line/info');?>/id/<?php echo ($v["id"]); ?>" external></a>
                                    </div>
                                    <div class="card-footer">
                                        <span>出发地：<?php echo ($v['assembly_point_show_text']); ?></span>
                                        <a href="<?php echo U('line/info');?>/id/<?php echo ($v["id"]); ?>" class="link active-recommend">
                                            <?php if(empty($v['check_price'])): ?><span>核算中</span>
                                                <?php else: ?>
                                                <span>￥<?php echo ($v["start_price_adult"]); ?>元起</span><?php endif; ?>
                                        </a>
                                    </div>
                                </div><?php } ?>

                            <!-- 查看更多周边游 -->
                            <a href="<?php echo U('line/list');?>/t/mz/" external>查看更多产品</a>

                        </div>
                    </div>
                </div>
        </div> <!--结束tab--><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
</div>
<!-- 周边游 -->
<div class="hot-sale">
    <?php if($station111['key'] != 'main'): ?><h3><?php echo ($station111["name"]); ?>周边游</h3>
        <?php else: ?>
        <h3>周边游</h3><?php endif; ?>
    <div class="hot-sale-content">
        <!-- 切换 -->
        <div class="buttons-tab">
            <?php if(is_array($set["surrounding_line_tab"])): $i = 0; $__LIST__ = $set["surrounding_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key < 5): if($key == 0): ?><a href="#<?php echo ($tab["type_key"]); ?>" class="tab-link active button"><?php echo ($tab["type_desc"]); ?></a>
                        <?php else: ?>
                        <a href="#<?php echo ($tab["type_key"]); ?>" class="tab-link button"><?php echo ($tab["type_desc"]); ?></a><?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="tabs">
            <?php if(is_array($set["surrounding_line_tab"])): $i = 0; $__LIST__ = $set["surrounding_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><div id="<?php echo ($tab["type_key"]); ?>" class="tab active">
                        <?php else: ?>
                        <div id="<?php echo ($tab["type_key"]); ?>" class="tab"><?php endif; ?>
                <!-- 周边游 -->
                <div class="depth-travel">
                    <div class="depth-travel-content">
                        <div class="travel-content">
                            <?php $__FOR_START_652463714__=0;$__FOR_END_652463714__=6;for($i=$__FOR_START_652463714__;$i < $__FOR_END_652463714__;$i+=1){ $v = $set[$tab['type_key'].$i]; if (empty($v)) { continue; } ?>
                                <div class="card demo-card-header-pic">
                                    <div class="card-content">
                                        <img src="<?php echo ($v["img1"]); ?>" alt="">
                                        <div class="card-content-inner">
                                            <p><?php echo ($v["title"]); ?></p>
                                            <p><?php echo ($v["subheading"]); ?></p>
                                        </div>
                                        <!-- 跳转a -->
                                        <a href="<?php echo U('line/info');?>/id/<?php echo ($v["id"]); ?>" external></a>
                                    </div>
                                    <div class="card-footer">
                                        <span>出发地：<?php echo ($v['assembly_point_show_text']); ?></span>
                                        <a href="<?php echo U('line/info');?>/id/<?php echo ($v["id"]); ?>" class="link active-recommend">
                                            <?php if(empty($v['check_price'])): ?><span>核算中</span>
                                                <?php else: ?>
                                                <span>￥<?php echo ($v["start_price_adult"]); ?>元起</span><?php endif; ?>
                                        </a>
                                    </div>
                                </div><?php } ?>

                            <!-- 查看更多周边游 -->
                            <a href="<?php echo U('line/list');?>/t/zb" external>查看更多产品</a>

                        </div>
                    </div>
                </div>
        </div> <!--结束tab--><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
</div>


<!-- 活动回顾 -->
<div class="active-review">
    <div class="active-review-content">
        <div class="active-review-header">
            <img src="/source/Static/phone/images/index/sublist_logo.png" alt="">
            <span>活动回顾</span>
        </div>
        <div class="active-review-list">
            <?php $__FOR_START_496376692__=0;$__FOR_END_496376692__=8;for($i=$__FOR_START_496376692__;$i < $__FOR_END_496376692__;$i+=1){ $act = $set['activity'.$i] ?>
                <div class="active-review-sublist">
                    <div class="card demo-card-header-pic">
                        <div class="card-content">
                            <img src="<?php echo ($act["img"]); ?>" alt="">
                            <div class="card-content-inner">
                                <p><?php echo ($act["subheading"]); ?></p>
                            </div>
                            <!-- 跳转a -->
                            <a href="<?php echo ($act["url"]); ?>" external></a>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo ($act["url"]); ?>" class="link">
                                <!--<img src="/source/Static/phone/images/index/people.png" alt="">-->
                                作者：<span><?php echo ($act["author"]); ?></span>
                            </a>
                            <!--<a href="#" class="link active-recommend">
                            <strong>重点推荐腾冲银杏</strong>
                            &nbsp;|&nbsp;
                            <span>5892元</span></a>-->
                        </div>
                    </div>
                </div><?php } ?>

        </div>
        <!-- 更多往期回顾 -->
        <a href="http://shequ.kllife.com/" external>更多往期回顾</a>
    </div>
</div>
<!-- end 活动回顾 -->

<!-- 精彩分享 -->
<div class="active-review">
    <div class="active-review-content">
        <div class="active-review-header">
            <img src="/source/Static/phone/images/index/sublist_logo.png" alt="">
            <span>精彩分享</span>
        </div>
        <div class="active-review-list">

            <?php $__FOR_START_541758246__=0;$__FOR_END_541758246__=4;for($i=$__FOR_START_541758246__;$i < $__FOR_END_541758246__;$i+=1){ $article = $set['article'.$i] ?>
                <div class="active-review-sublist">
                    <div class="card demo-card-header-pic">
                        <div class="card-content">
                            <img src="<?php echo ($article["face_image"]); ?>" alt="">
                            <div class="card-content-inner">
                                <p><?php echo ($article["short_title"]); ?></p>
                            </div>
                            <!-- 跳转a -->
                            <a href="<?php echo U('line/article');?>/id/<?php echo ($article["id"]); ?>" external></a>
                        </div>
                    </div>
                </div><?php } ?>

        </div>
        <!-- 更多往期回顾 -->
        <a href="<?php echo U('line/article');?>" external>更多精彩分享</a>
    </div>

</div>
<!-- end 精彩分享 -->

</div>
</div>
<!--每刻美弹出框-->
<!--<div class="meikemei" style="position:fixed;top:0px;left:0px;width:100%;height:100%;background: rgba(0,0,0,0.5);z-index:10000000;">-->
<!--<div style="position: relative;">-->
<!--<div id="meikemei-img" style="position: fixed;top:10%;left:10%;width:80%;"><img style="width:100%;" src="/source/Static/phone/images/index/phone-tc.png" alt=""></div>-->
<!--<div id="remove-tc" style="position: fixed;top:12%;right:12%;"><img src="/source/Static/phone/images/index/remove-tc.png" alt=""></div>-->
<!--</div>-->
<!--</div>-->


<!-- light7 -->
<script src="/source/Static/phone/common/js/light7.js"></script>
<!-- i18n 中文 -->
<script src="/source/Static/phone/common/js/cn.js"></script>
<!--公用JS文件-->
<script src="/source/Static/common/js/functions.js"></script>

<!-- swiper -->
<script src="/source/Static/phone/common/js/swiper-3.3.1.min.js"></script>

<script>
    $(function(){

        $.init();
        var swiper = new Swiper('.module01 .swiper-container', {
            pagination: '.swiper-pagination',
            slidesPerView: 1,
            paginationClickable: true,
            spaceBetween: 10,
            loop: true,
            centeredSlides: true,
            autoplay: 2500,
            autoplayDisableOnInteraction: false
        });
        var swiper = new Swiper('.module02 .swiper-container', {
            slidesPerView: 2.7,
            paginationClickable: true,
            spaceBetween: 20,
            freeMode: true
        });
    });
</script>
<!--超级目的地-->
<script>

</script>
<script>
    //每刻美弹出框
    //        $("#remove-tc").on("click",function(){
    //            $(".meikemei").hide();
    //		})
    //		$("#meikemei-img").on("click",function(){
    //		    window.location.href="<?php echo U('line/xiezhenlvxing');?>";
    //            $(".meikemei").hide();
    //		})
    //图片垂直居中
    $(document).ready(function(){
        $("#meikemei-img").on("load",function(){
            var imgh = $(this).height();
            var body = $("body").height();
            var top = (body-imgh)/2;
            var topRemove = top+1;
            $(this).css("top",top+"px");
            $("#remove-tc").css("top",topRemove+"px");
        });
    });

    //小团慢旅行
    $(".slow-travel-detail .click").on("click",function(){
        var Index = $(this).index();
        $(this).find("div").addClass("active").parents(".click").siblings(".click").find("div").removeClass("active");
        $(".slow-travel-explain div").eq(Index).show().siblings("div").hide();
    })
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
    });


</script>
<!--百度统计-->
<script>
	var _hmt = _hmt || [];
	(function() {
		var hm = document.createElement("script");
		hm.src = "//hm.baidu.com/hm.js?a6f69a2a062b07c67a4ae301e0963ca8";
		var s = document.getElementsByTagName("script")[0]; 
		s.parentNode.insertBefore(hm, s);
	})();
</script> 
<!--商务通统计-->
<script language="javascript" src="http://pqt.zoosnet.net/JS/LsJS.aspx?siteid=PQT43116159&lng=cn"></script>
<!--CNZZ统计-->
<script type="text/javascript">
	var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
	document.write(unescape("%3Cdiv id='cnzz_stat_icon_1000019958'%3E%3C/div%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1000019958%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>