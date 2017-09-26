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
	<?php if(empty($PageKeyword) == false): ?><meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
	<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
	<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
	<title><?php echo ($PageKeyword["title"]); ?></title>
	<?php elseif(empty($duid) == false): ?>
		<?php if(C('MENU_CURRENT') == 'line_content'): ?><title><?php echo ($line["title"]); ?>-<?php echo ($line["subheading"]); ?></title>
		<?php else: ?>
		<title><?php echo ($fxset["shop_title"]["data"]["value"]); ?></title><?php endif; ?>
	<?php else: ?>
	<title><?php echo C('PAGE_TITLE');?>-领袖户外</title><?php endif; ?>
	
	<link rel="stylesheet" href="/source/Static/phone/common/css/light7.css">
	<link rel="stylesheet" href="/source/Static/common/css/common.css">
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="/source/Static/common/js/jquery-1.11.1.min.js"></script>
	<script src="/source/Static/common/js/functions.js"></script>
	<!-- jq -->
	<script src="/source/Static/phone/common/js/jquery.min.js"></script>
	<style>
		.black-mark { display: none; position: fixed; top:0; left:0; width: 100%; height: 100%; text-align: center; color:#ececec; background: rgba(0,0,0,.5); z-index:3000; }
		.black-mark p { margin-top: 230px; color: #fff; text-align: center; }
	</style>
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
			if (bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM)
			{
			}else{
				window.location.href = window.location.href.replace(/phone/g,'home');
			}
		}
		
		if ('{duser.id}' == '' && '<?php echo ($duid); ?>' == '') {
			browserRedirect();	
		}
		
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
<!--<link rel="stylesheet" href="/source/Static/phone/css/bootstrap.min.css">-->
<link rel="stylesheet" href="/source/Static/phone/css/slow-travel.css">
<style>
    .module02{margin-left:3%;}
    .module02 .tit{font-size: 1.17em;padding:10px 0px;}
    .module02 .lg{font-size: 18px;text-align: center;}
    .module02 .sm{font-size: 14px;text-align: center;color:#666;}
</style>
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
			    <a class="tab-item" href="http://shequ.kllife.com" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>社区</p>
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
		<script type="text/javascript">
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
                    <?php $__FOR_START_2117663834__=1;$__FOR_END_2117663834__=4;for($i=$__FOR_START_2117663834__;$i < $__FOR_END_2117663834__;$i+=1){ $img = $set['lunbo'.$i]; $url = $set['lunbo'.$i.'_url']; ?>
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
                            var searchval = $(this).val();
                            if (searchval != '') {
                                var cdsstr = 'title|LIKE|%'+searchval+'%|OR';
                                cdsstr += '|subheading|LIKE|%'+searchval+'%|OR';
                                cdsstr += '|theme_type|LIKE|%'+searchval+'%|OR';
                                cdsstr += '|play_type|LIKE|%'+searchval+'%|OR';
                                cdsstr += '|dismiss_place|LIKE|%'+searchval+'%|OR';
                                cdsstr += '|assembly_point|LIKE|%'+searchval+'%|OR';
                                cdsstr += '|destination|LIKE|%'+searchval+'%|OR';
                                cdsstr += '|view_point|LIKE|%'+searchval+'%|OR';
                                cdsstr += '|hotel_type|LIKE|%'+searchval+'%|OR';
                                $.post('<?php echo U("line/search");?>', {cds:cdsstr}, function(data){
                                    if (data.jumpUrl != null) {
                                        location.href = data.jumpUrl;
                                    }
                                });
                            } else {
                                alert('请输出查询内容');
                            }
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
                        <a href="<?php echo U('line/list');?>/type/zt/t/sd" external>
                            <img src="/source/Static/phone/images/index/2.png" alt="">
                            <p>小团慢旅行</p>
                        </a>
                    </div>
                    <div class="top-sublist">
                        <a href="<?php echo U('line/list');?>/type/zt/t/sy" external>
                            <img src="/source/Static/phone/images/index/3.png" alt="">
                            <p>摄影游</p>
                        </a>
                    </div>
                    <div class="top-sublist">
                        <a href="<?php echo U('line/list');?>/type/zt/t/mz" external>
                            <img src="/source/Static/phone/images/index/4.png" alt="">
                            <p>民族行</p>
                        </a>
                    </div>
                    <div class="top-sublist">
                        <a href="<?php echo U('line/book');?>" external>
                            <img src="/source/Static/phone/images/index/5.png" alt="">
                            <p>定制游</p>
                        </a>
                    </div>
                </div>
                <!--<div class="top-list">
                    <div class="top-sublist">
                        <a href="<?php echo U('line/list');?>/type/zt/t/zb" external>
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
            <!--<div class="background"><img style="display:block;max-width:100%;height:auto;" src="/source/Static/phone/images/index/slow-travel-background.png" alt=""></div>-->
            <!--<div class="slow-travel-tit">-->
            <!--<div class="left"><img src="/source/Static/phone/images/index/slow-travel-forward.gif" alt=""></div>-->
            <!--<div class="right">-->
            <!--<p>好玩不贵的小团慢旅行</p>-->
            <!--<img style="display:block;max-width:100%;height:auto;" src="/source/Static/phone/images/index/slow-travel-down.png" alt="">-->
            <!--</div>-->
            <!--</div>-->
            <!--<div class="slow-travel-detail">-->
            <!--<div class="click"><div class="active">好玩</div></div>-->
            <!--<div class="click"><div>慢旅行</div></div>-->
            <!--<div class="click"><div>小团</div></div>-->
            <!--<div class="click"><div>不贵</div></div>-->
            <!--</div>-->
            <!--<div class="slow-travel-explain">-->
            <!--<div>-->
            <!--<p>生活已无奈 旅行不苟且</p>-->
            <!--<p>28人精品小团，享受一次恰到好处的慢旅行</p>-->
            <!--<p>创业12年，历经铅华之后回归初心，</p>-->
            <!--<p>我们都该享受旅行品味人生</p>-->
            <!--</div>-->
            <!--<div style="display:none;">-->
            <!--<p>世界太匆忙，日复一日，</p>-->
            <!--<p>或许让你无法奢享悠然的生活。</p>-->
            <!--<p>难得的旅行为何不能慢一点？</p>-->
            <!--<p>我们痛恶匆忙奔波的旅行，</p>-->
            <!--<p>守护慢旅行之于我们，</p>-->
            <!--<p>就是体验另一趟人生。</p>-->
            <!--</div>-->
            <!--<div style="display:none;">-->
            <!--<p>常规旅行大团充斥吵杂与等待，</p>-->
            <!--<p>你是否就是那团最后的一个人？</p>-->
            <!--<p>来了就是白赚利润的尾单？</p>-->
            <!--<p>我们反对毫无节制的大团，</p>-->
            <!--<p>毫无体验可言。</p>-->
            <!--</div>-->
            <!--<div style="display:none;">-->
            <!--<p>不贵等于廉价吗？</p>-->
            <!--<p>28人以内的小团，</p>-->
            <!--<p>每位队员都是不可或缺的珍视。</p>-->
            <!--<p>舍弃边际利润的小团慢旅行，</p>-->
            <!--<p>我们为你守护旅行本真体验。</p>-->
            <!--</div>-->
            <!--</div>-->
            <!--<div class="slow-travel-history">-->
            <!--<div style="text-align: center;text-align: -webkit-center"><img style="display:block;max-width:100%;height:auto;" src="/source/Static/phone/images/index/slow-travel-up.png" alt=""></div>-->
            <!--<a href="http://baidu.com" style="text-decoration: none;"><p style="text-align: center;text-align: -webkit-center;font-size: 15px;color:#000;font-weight: 500;line-height:30px;padding-top:10px;">2005年创立以来，遭遇了3次破产危机，也经历过2波爆炸式增长。进入12岁的本命年，我们 <span style="color:#2c6fb7;">“找回初心”</span></p></a>-->
            <!--</div>-->
        </div>
        <!-- 小专题 -->
        <div class="special">
            <?php $titleColor = array('f60','75b168','41d3fd','f50c3d'); $divStyle=array('border-right: 1px solid #dcdcdc;', '', 'border-right: 1px solid #dcdcdc;', ''); ?>
            <?php $__FOR_START_1766804761__=0;$__FOR_END_1766804761__=4;for($i=$__FOR_START_1766804761__;$i < $__FOR_END_1766804761__;$i+=1){ $rowClass = intval($i / 2) == 0 ? 'border-bottom: 1px solid #dcdcdc;' : ''; $zt = $set['zhuanti'.$i]; ?>
                <?php if($i % 2 == 0): ?><div class="special-list" style="<?php echo ($rowClass); ?>"><?php endif; ?>
                <div class="special-sublist" style="<?php echo ($divStyle[$i]); ?>">
                    <a href="<?php echo ($zt["url"]); ?>" external>
                        <span style="color: #<?php echo ($titleColor[$i]); ?>;"><?php echo ($zt["title"]); ?></span>
                        <p><?php echo ($zt["subheading"]); ?></p>
                        <img src="<?php echo ($zt["img_main"]); ?>" alt="">
                    </a>
                </div>
                <?php if($i % 2 == 1): ?></div><?php endif; } ?>
    </div>
    <!--超级目的地-->
    <div class="module02">
        <div class="tit">超级目的地</div>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div><img src="/source/Static/phone/images/index/tination1.jpg" alt=""></div>
                    <p class="lg">大美青海</p>
                    <p class="sm">每个人都该去的环湖路</p>
                </div>
                <div class="swiper-slide">
                    <div><img src="/source/Static/phone/images/index/tination2.jpg" alt=""></div>
                    <p class="lg">大美青海</p>
                    <p class="sm">每个人都该去的环湖路</p>
                </div>
                <div class="swiper-slide">
                    <div><img src="/source/Static/phone/images/index/tination3.jpg" alt=""></div>
                    <p class="lg">大美青海</p>
                    <p class="sm">每个人都该去的环湖路</p>
                </div>
                <div class="swiper-slide">
                    <div><img src="/source/Static/phone/images/index/tination1.jpg" alt=""></div>
                    <p class="lg">大美青海</p>
                    <p class="sm">每个人都该去的环湖路</p>
                </div>
                <div class="swiper-slide">
                    <div><img src="/source/Static/phone/images/index/tination2.jpg" alt=""></div>
                    <p class="lg">大美青海</p>
                    <p class="sm">每个人都该去的环湖路</p>
                </div>
                <div class="swiper-slide">
                    <div><img src="/source/Static/phone/images/index/tination3.jpg" alt=""></div>
                    <p class="lg">大美青海</p>
                    <p class="sm">每个人都该去的环湖路</p>
                </div>
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
                <?php if(is_array($set["hot_line_tab"])): $i = 0; $__LIST__ = $set["hot_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><a href="#<?php echo ($tab["type_key"]); ?>" class="tab-link active button"><?php echo ($tab["type_desc"]); ?></a>
                        <?php else: ?>
                        <a href="#<?php echo ($tab["type_key"]); ?>" class="tab-link button"><?php echo ($tab["type_desc"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="tabs">
                <?php if(is_array($set["hot_line_tab"])): $i = 0; $__LIST__ = $set["hot_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><div id="<?php echo ($tab["type_key"]); ?>" class="tab active">
                            <?php else: ?>
                            <div id="<?php echo ($tab["type_key"]); ?>" class="tab"><?php endif; ?>
                    <!-- 深度游 -->
                    <div class="depth-travel">
                        <div class="depth-travel-content">
                            <div class="travel-content">
                                <?php $__FOR_START_2122129797__=0;$__FOR_END_2122129797__=5;for($i=$__FOR_START_2122129797__;$i < $__FOR_END_2122129797__;$i+=1){ $v = $set[$tab['type_key'].$i]; if (empty($v)) { continue; } ?>
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
                                                <?php if(empty($v['min_batch']['price_state'])): ?><span>￥<?php echo ($v["min_batch"]["price_adult"]); ?>元起</span></a>
                                            <?php else: ?>
                                            <span>￥核算中</span></a><?php endif; ?>
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

<!-- 周边游 -->
<div class="hot-sale">
    <?php if($station111['key'] != 'main'): ?><h3><?php echo ($station111["name"]); ?>周边游</h3>
        <?php else: ?>
        <h3>周边游</h3><?php endif; ?>
    <div class="hot-sale-content">
        <!-- 切换 -->
        <div class="buttons-tab">
            <?php if(is_array($set["surrounding_line_tab"])): $i = 0; $__LIST__ = $set["surrounding_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><a href="#<?php echo ($tab["type_key"]); ?>" class="tab-link active button"><?php echo ($tab["type_desc"]); ?></a>
                    <?php else: ?>
                    <a href="#<?php echo ($tab["type_key"]); ?>" class="tab-link button"><?php echo ($tab["type_desc"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="tabs">
            <?php if(is_array($set["surrounding_line_tab"])): $i = 0; $__LIST__ = $set["surrounding_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><div id="<?php echo ($tab["type_key"]); ?>" class="tab active">
                        <?php else: ?>
                        <div id="<?php echo ($tab["type_key"]); ?>" class="tab"><?php endif; ?>
                <!-- 深度游 -->
                <div class="depth-travel">
                    <div class="depth-travel-content">
                        <div class="travel-content">
                            <?php $__FOR_START_1520562331__=0;$__FOR_END_1520562331__=6;for($i=$__FOR_START_1520562331__;$i < $__FOR_END_1520562331__;$i+=1){ $v = $set[$tab['type_key'].$i]; if (empty($v)) { continue; } ?>
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
                                            <?php if(empty($v['min_batch']['price_state'])): ?><span>￥<?php echo ($v["min_batch"]["price_adult"]); ?>元起</span></a>
                                        <?php else: ?>
                                        <span>￥核算中</span></a><?php endif; ?>
                                    </div>
                                </div><?php } ?>

                            <!-- 查看更多周边游 -->
                            <a href="<?php echo U('line/list');?>" external>查看更多线路产品</a>

                        </div>
                    </div>
                </div>
        </div> <!--结束tab--><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>

</div>
</div>

<!-- 精彩分享 -->
<div class="active-review">
    <div class="active-review-content">
        <div class="active-review-header">
            <img src="/source/Static/phone/images/index/sublist_logo.png" alt="">
            <span>精彩分享</span>
        </div>
        <div class="active-review-list">

            <?php $__FOR_START_1702386445__=0;$__FOR_END_1702386445__=4;for($i=$__FOR_START_1702386445__;$i < $__FOR_END_1702386445__;$i+=1){ $article = $set['article'.$i] ?>
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
<!-- end 活动回顾 -->

<!-- 活动回顾 -->
<div class="active-review">
    <div class="active-review-content">
        <div class="active-review-header">
            <img src="/source/Static/phone/images/index/sublist_logo.png" alt="">
            <span>活动回顾</span>
        </div>
        <div class="active-review-list">

            <?php $__FOR_START_65676642__=0;$__FOR_END_65676642__=3;for($i=$__FOR_START_65676642__;$i < $__FOR_END_65676642__;$i+=1){ $act = $set['activity'.$i] ?>
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
</div>
</div>



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

</body>
</html>