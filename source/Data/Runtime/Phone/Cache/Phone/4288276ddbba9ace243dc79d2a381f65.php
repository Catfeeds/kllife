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
<link rel="stylesheet" href="/source/Static/phone/css/welcome1.css">
<!--小团慢css-->
<link rel="stylesheet" href="/source/Static/phone/css/slow-travel.css">
<style>
	.page .content {margin-bottom: 1.5rem;}
	.background-img-loading{background-image: url(/source/Static/home/common/images/background-img-loading.gif);background-repeat: no-repeat;background-position: center center;z-index:100;}
	.hot-sale .background-img-loading{min-height:110px;}
	/*.destination .background-img-loading{min-height:240px;}*/
</style>
	    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>游记</p>
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
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
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
<div class="page">
	<div class="content">
		<!-- 这里是页面内容区 -->
		<!-- slider -->
		<div class="module01">
			<div class="swiper-container" >
				<div class="swiper-wrapper">
					<?php $__FOR_START_1411008197__=1;$__FOR_END_1411008197__=7;for($i=$__FOR_START_1411008197__;$i <= $__FOR_END_1411008197__;$i+=1){ $img = $set['lunbo'.$i]; $url = $set['lunbo'.$i.'_url']; ?>
						<div class="swiper-slide"><a href="<?php echo ($url); ?>" external><img src="<?php echo ($img); ?>?imageMogr2/gravity/Center/crop/1000x" alt=""></a></div><?php } ?>
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
			<?php $__FOR_START_337506382__=0;$__FOR_END_337506382__=4;for($i=$__FOR_START_337506382__;$i < $__FOR_END_337506382__;$i+=1){ $rowClass = intval($i / 2) == 0 ? 'border-bottom: 1px solid #dcdcdc;' : ''; $zt = $set['zhuanti'.$i]; ?>
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
		<div class="bournBoxTitle"><span>超级目的地</span></div>
		<div class="module02">
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

		<!-- 精选热卖 -->
		<div class="bournBoxTitle bournBoxTitle-remai"><span>精选热卖</span></div>
		<div class="hot-sale">
			<div class="recommend-result">
				<?php $__FOR_START_35843736__=0;$__FOR_END_35843736__=10;for($i=$__FOR_START_35843736__;$i < $__FOR_END_35843736__;$i+=1){ $hotLine = $set['hot_line_recommend'.$i]; ?>
					<?php if(empty($hotLine) == false): ?><div class="item">
							<span class="img-width"><img class="img-responsive background-img-loading" data-echo="<?php echo ($hotLine['img1']); ?>" alt=""></span>
							<div class="detail">
								<p class="lg"><?php echo ($hotLine['title']); ?></p>
								<p class="sm"><?php echo ($hotLine['subheading']); ?></p>
							</div>
							<div class="price">
								<?php if (empty($hotLine['check_price'])) { echo('<span class="right"><span class="money">未审核</span></span>'); }else { $price = explode('.', $hotLine['start_price_adult']); echo('<span class="right">￥<span class="money">'.$price[0].'</span>元起</span>'); } ?>
							</div>
							<a href="<?php echo U('line/info');?>/id/<?php echo ($hotLine['id']); ?>" external></a>
						</div><?php endif; } ?>
			</div>
		</div>
		<div class="bournBoxTitle"><span>目的地精选</span></div>
		<!--目的地选择-->
		<div id="j-bournBox">
			<div class="bournTopList" id="bournFixed">
				<div class="scrollBox" id="scrollBox">
					<ul class="bournList displayBox" id="j-bournTitle">
						<?php $themeMap = array('pc_home_menu_xtmlx'=>true, 'pc_home_menu_xinlvpai'=>true, 'pc_home_menu_sheying'=>true, 'pc_home_menu_zhuti'=>true); ?>
						<?php if(is_array($menus)): $mk = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tm): $mod = ($mk % 2 );++$mk; if(empty($themeMap[$tm['item_key']]) == false): if($tm['item_key'] == 'pc_home_menu_zhuti'): ?><li data-id="<?php echo ($tm["id"]); ?>" class="open-preloader">深度游</li>
									<?php else: ?>
									<li data-id="<?php echo ($tm["id"]); ?>" class="open-preloader"><?php echo ($tm["item_desc"]); ?></li><?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<div class="bournChildList fn-clear" id="j-bournTitleChild">
					<!--<?php if(is_array($left_menus)): $i = 0; $__LIST__ = $left_menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lm): $mod = ($i % 2 );++$i;?>-->
					<!--<?php if($lm['item_key'] == 'pc_home_left_menu_hot'): ?>-->
					<!--<ul style="display: none;" data-key="<?php echo ($lm['item_key']); ?>">								-->
					<!--<li class="hover" data-key="default">推荐</li>-->
					<!--<?php if(is_array($lm["child"])): $i = 0; $__LIST__ = $lm["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lmc): $mod = ($i % 2 );++$i;?>-->
					<!--<li data-id="<?php echo ($lmc["id"]); ?>"><?php echo ($lmc["item_desc"]); ?></li>-->
					<!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
					<!--</ul>-->
					<!--<?php endif; ?>-->
					<!--<?php endforeach; endif; else: echo "" ;endif; ?>-->

					<?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tm): $mod = ($i % 2 );++$i; if(empty($themeMap[$tm['item_key']]) == false): ?><ul style="display: none;" data-key="<?php echo ($tm['item_key']); ?>">
								<li class="hover open-preloader" data-key="default">推荐</li>
								<?php if(is_array($tm["child"])): $i = 0; $__LIST__ = $tm["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tmc): $mod = ($i % 2 );++$i;?><li data-id="<?php echo ($tmc["id"]); ?>" class="open-preloader"><?php echo ($tmc["item_desc"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
		</div>
		<!--目的地线路-->
		<div class="item template_item hidden_ctrl">
			<img class="img-responsive background-img-loading" data-echo="" alt="">
			<div class="detail">
				<p class="lg line-title"><span class="span"></span><span class="sm subheading"></span></p>
			</div>
			<div class="price">
				<span class="place"></span>
				<span class="right">￥<span class="money"></span>元起</span>
			</div>
			<a href="javascript:;" external></a>
		</div>
		<div class="destination">
			<div class="recommend-result list_container list_active" data-index="0" data-more="1">
			</div>
		</div>
	</div>
</div>





<!-- light7 -->
<script src="/source/Static/phone/common/js/light7.js"></script>
<!-- i18n 中文 -->
<script src="/source/Static/phone/common/js/cn.js"></script>
<!--公用JS文件-->
<script src="/source/Static/common/js/functions.js"></script>

<script>		
    //加载指示
    function PageLoading() {
    	this.loading = false;
    }
    
    PageLoading.prototype.isLoading() = function () {
    	return this.loading;
    }
    
    PageLoading.prototype.loading = function (bshow) {
    	this.loading = bshow;
    	if (bshow) {
       		$.showPreloader();
    	} else {
            $.hidePreloader();	
    	}
    }
</script>
<!-- swiper -->
<script src="/source/Static/phone/common/js/swiper-3.3.1.min.js"></script>
<!--图片延时加载-->
<script src="/source/Static/home/common/js/echo.min.js"></script>
<script>
    //初始化图片延迟加载
    echo.init({
        offset: 200,
        throttle: 0
    });
    //加载指示
    $(document).on('click','.open-preloader', function () {
        $.showPreloader();
        setTimeout(function () {
            $.hidePreloader();
        }, 2000);
    });
    $('#j-bournTitleChild').find('ul:first').css('display', 'block');

    //精选目的地
    $(".bournList li").on("click",function(){
        var index = $(this).index();
        $(this).addClass("active").siblings().removeClass("active");
        $(".bournChildList").find("ul").eq(index).show().siblings().hide();
        // 标签切换
        changeTab();
    })

    // 目的地框固定
    $(window).load(function() {
        var jheight = $("#j-bournBox").height() + 80;
        var startPos = $('#j-bournBox').offset().top - jheight;

        function fixedDestination() {
            //content滚动距离
            var p = $(".content").scrollTop();
            //当tabs距离顶部距离 <= content滚动距离时
            if( startPos <= p ){
                //固定tabs
                $('#j-bournBox').css({'position':'fixed',
                    'top':'0',
                    'left':'0',
                    'width':'100%',
                    'z-index':'999'});
                $(".destination").css("margin-top",jheight-80)
            }else{
                //清除固定
                $('#j-bournBox').css('position','static');
                $(".destination").css("margin-top","0px")
            }
        }

        // 滚动加载
        function scrollLoadData() {
            var b = $("document").scrollTop()+$(window).height();
            var t = $('.destination').offset().top;
            if (t <= b) {
                loadMoreData();
            }
        }

        //    固定目的地选择框
        window.onload = function() {
            //绑定滚动事件
            $(".content").on( "scroll", function() {
                // 目的地框固定
                fixedDestination();
                // 滚动加载
                scrollLoadData();
            });
        }

    })

    //地方选择
    $(".bournChildList ul li").on("click",function(){
        $(this).addClass("hover").siblings().removeClass("hover");
        // 标签切换
        changeTab();
    })
    //swiper
    $(function(){
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

    function changeTab() {

        // 清空所有内容
        $('.list_container').attr('data-index', 0);
        $('.list_container').attr('data-more', 1);
        $('.list_container').children().remove();
        $('.no-more-data').remove();

        // 加载更多
        loadMoreData();
    }

    // 获取条件
    function getConditions() {
        var cdsstr = '';
        var theme = $('#j-bournTitle').find('li.active');
        if ($(theme).length > 0 && $(theme).attr('data-key') != 'default') {
            cdsstr = 'theme_type|'+$(theme).html();
        }
        var dest = $('#j-bournTitleChild').find('ul:visible').find('li.hover');
        if ($(dest).length > 0 && $(dest).attr('data-key') != 'default') {
            if (cdsstr != '') {
                cdsstr += '|';
            }
            cdsstr = 'destination|'+$(dest).html();
        }
        return cdsstr;
    }

    // 查找产品
    var loading = false;	// 是否在加载中
    function loadMoreData() {
        var containerObj = $('.list_container');
        var noMoreData = $(containerObj).attr('data-more');
        if (noMoreData == '0' || loading == true) {
            return false;
        }
        var p = parseInt($(containerObj).attr('data-index'));
        var jsonData = {
            page: p,
        }

        var cdsstr = getConditions();
        if (cdsstr != '') {
            jsonData['cds'] = cdsstr;
        }

        console.log(JSON.stringify(jsonData));
        loading = true;
        $.post('<?php echo U("line/list");?>', jsonData, function(data){
            loading = false;
            if (data.result.errno == 0) {
                if (data.ds != null && data.ds != 'undefined') {
                    for (var i=0; i < data.ds.length; i++) {
                        var d = data.ds[i];
                        var itemObj = $('.template_item').clone(true);
                        $(itemObj).removeClass('template_item');
                        $(itemObj).removeClass('hidden_ctrl');
                        $(itemObj).find('.background-img-loading').attr('src', d.img1);
                        $(itemObj).find('p.line-title .span').html('【'+d.title+'】');
                        $(itemObj).find('.subheading').html(d.subheading);
                        $(itemObj).find('.place').html('出发地：'+d.assembly_point_show_text);
                        if (d.check_price == 0) {
                            $(itemObj).find('.price .right').html('未审核');
                        } else {
                            $(itemObj).find('.price .money').html(d.start_price_adult);
                        }
                        $(itemObj).find('a').attr('href', '<?php echo U("line/info");?>/id/'+d.id);
                        // 添加新条目
                        $(containerObj).append(itemObj);
                        $(containerObj).attr('data-index', p+1);
                    } // end for
                } else {
                    if ($(containerObj).parent().find('.no-more-data').length > 0) {
                        $(containerObj).find('.no-more-data').html('没有更多数据...');
                    } else {
                        var vhtml = '<div class="no-more-data">没有更多数据...</div>';
                        $(containerObj).parent().append(vhtml);
                    }
                    // 处理么有数据可加载情况
                    $(containerObj).attr('data-more', '0');
                }
            } else {
                console.log(data.result.message);
            }
        });
    }

    // 首次加载数据
    loadMoreData();

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