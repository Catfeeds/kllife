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
				
			} else {
				if ('<?php echo ($duser["id"]); ?>' == '' && '<?php echo ($duid); ?>' == '') {
					vurl = vurl.replace(/phone/g,'home');
				}
			}
			
            if(vurl != window.location.href) {
				window.location.href = vurl;
			}
		}
		browserRedirect();
		
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
<link rel="stylesheet" href="/source/Static/phone/css/northwest.css">
<style>
    .module{padding:10px;background: #fff;}
    .module .sm{font-size: 14px;height:40px;overflow: hidden;
        display: -webkit-box;
        text-overflow:ellipsis;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        word-break: break-all;}
</style>
<header class="bar bar-nav">
    <a class="button button-link button-nav pull-left back" href="javascript:history.back();">
        <i class="iconfont">&#xe606;</i>
    </a>
    <h1 class="title">西北专题</h1>
</header>
<div class="content">
    <div class="xinjiang northwest">
        <!--banner-->
        <div class="top">
            <img class="img-responsive" src="/source/Static/phone/images/northwest/banner.jpg" alt="">
            <!--<video poster="/source/Static/phone/images/silk/video.jpg" width="100%" height="100%" controls="controls"  x5-video-player-type="h5"/>-->
            <!--<source src="/source/Static/home/mp4/10029799-1.mp4" type="video/mp4">-->
            <!--</video>-->
        </div>
        <!--标签切换-->
        <div class="tit-tag">
            <span class="active">推荐</span>
            <span>小团慢旅行</span>
            <span>写真旅行</span>
            <span>摄影游</span>
            <span>民族行</span>
            <div class="border"><!--此div只用于border--></div>
        </div>
        <!--推荐线路-->
        <div class="recommend-result line_container">
            <div class="item" data-id="<?php echo ($l["id"]); ?>">
                <img class="img-responsive" src="/source/Static/phone/images/northwest/img.jpg" alt="">
                <div class="detail">
                    <p class="lg">丝绸之路巅峰体验九日游</p>
                    <p class="sm">沙岛-青海湖-茶卡盐湖-祁连-张掖-嘉峪关-敦煌9日游</p>
                    <p class="sm">本线路已有 <span>600</span> 人已报名</p>
                </div>
                <div class="price">
                    <span class="place">出发地 : 西安</span>
                    <span class="right">￥<span class="money">3280</span></span>
                </div>
                <a href="javascript" external></a>
            </div>
            <div class="item" data-id="<?php echo ($l["id"]); ?>">
                <img class="img-responsive" src="/source/Static/phone/images/northwest/img.jpg" alt="">
                <div class="detail">
                    <p class="lg">丝绸之路巅峰体验九日游</p>
                    <p class="sm">沙岛-青海湖-茶卡盐湖-祁连-张掖-嘉峪关-敦煌9日游</p>
                    <p class="sm">本线路已有 <span>600</span> 人已报名</p>
                </div>
                <div class="price">
                    <span class="place">出发地 : 西安</span>
                    <span class="right">￥<span class="money">3280</span></span>
                </div>
                <a href="javascript" external></a>
            </div>
        </div>
        <!--小团慢每刻美切换-->
        <div class="photo">
            <div class="tit">
                <span id="kllife"><img class="img-responsive" src="/source/Static/phone/images/xinjiang/kllife-phone.png" alt=""></span>
                <span id="meikemei"><img class="img-responsive" src="/source/Static/phone/images/xinjiang/meikemei-phone1.png" alt=""></span>
            </div>
            <div class="photo-list kllife-photo-list">
                <span><img class="img-responsive" src="/source/Static/phone/images/xinjiang/kllife-photo-list.png" alt=""></span>
            </div>
            <div class="photo-list meikemei-photo-list" style="display: none;">
                <span><img class="img-responsive" src="/source/Static/phone/images/xinjiang/meikemei-photo-list.png" alt=""></span>
            </div>
        </div>
        <!--往期游记-->
        <div class="review">
            <div class="tit"><img src="/source/Static/home/images/northwest/review-tit.png" alt=""></div>
            <!--<video style="background: #fff;" height="100%" width="100%" controls="controls"  x5-video-player-type="h5"/>-->
            <!--<source src="/source/Static/home/mp4/10029799-1.mp4" type="video/mp4">-->
            <!--</video>-->
            <div class="module">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" style="position: relative">
                            <div><img style="width:100%;" src="/source/Static/phone/images/northwest/youji1.jpg" alt=""></div>
                            <p class="sm">七月的丝路之行！</p>
                            <a href="http://shequ.kllife.com/Mobile/Index/youjidetail/id/1495.html" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%" external></a>
                        </div>
                        <div class="swiper-slide" style="position: relative">
                            <div><img style="width:100%;" src="/source/Static/phone/images/northwest/youji2.jpg" alt=""></div>
                            <p class="sm">西北偏北———额济纳</p>
                            <a href="http://shequ.kllife.com/Mobile/Index/youjidetail.html?id=2034" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%" external></a>
                        </div>
                        <div class="swiper-slide" style="position: relative">
                            <div><img style="width:100%;" src="/source/Static/phone/images/northwest/youji3.jpg" alt=""></div>
                            <p class="sm">兰州集合，丝路经典9天西北大环线领略水上魔鬼城--2016.8.7</p>
                            <a href="http://shequ.kllife.com/Mobile/Index/youjidetail.html?id=1783" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%" external></a>
                        </div>
                        <div class="swiper-slide" style="position: relative">
                            <div><img style="width:100%;" src="/source/Static/phone/images/northwest/youji4.jpg" alt=""></div>
                            <p class="sm">有了纵情丝路，其它的都弱爆了——直播，有大量美女，看的时候口水不要滴键盘上</p>
                            <a href="http://shequ.kllife.com/Mobile/Index/youjidetail.html?id=3050" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%" external></a>
                        </div>
                        <div class="swiper-slide" style="position: relative">
                            <div><img style="width:100%;" src="/source/Static/phone/images/northwest/youji5.jpg" alt=""></div>
                            <p class="sm">西北行漫记——大漠传奇意象</p>
                            <a href="http://shequ.kllife.com/Mobile/Index/youjidetail.html?id=2186" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%" external></a>
                        </div>
                        <div class="swiper-slide" style="position: relative">
                            <div><img style="width:100%;" src="/source/Static/phone/images/northwest/youji6.jpg" alt=""></div>
                            <p class="sm">穆穆带你与新疆有个美丽的约会</p>
                            <a href="http://shequ.kllife.com/Mobile/Index/youjidetail.html?id=3065" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%" external></a>
                        </div>
                    </div>
                    <!-- Add Pagination -->
                    <!--<div class="swiper-pagination"></div>-->
                </div>
            </div>
        </div>

        <!--其他推荐-->
        <div class="other">
            <div class="tit">
                <span class="left"><img class="img-responsive" src="/source/Static/home/images/northwest/qita-tit.png" alt=""></span>
            </div>
            <div class="recommend-result">
                <div class="item" data-id="<?php echo ($l["id"]); ?>">
                    <img class="img-responsive" src="/source/Static/phone/images/northwest/img.jpg" alt="">
                    <div class="detail">
                        <p class="lg">丝绸之路巅峰体验九日游</p>
                        <p class="sm">本线路已有 <span>600</span> 人已报名</p>
                    </div>
                    <div class="price">
                        <span class="place">出发地 : 西安</span>
                        <span class="right">￥<span class="money">3280</span></span>
                    </div>
                    <a href="javascript" external></a>
                </div>
                <div class="item" data-id="<?php echo ($l["id"]); ?>">
                    <img class="img-responsive" src="/source/Static/phone/images/northwest/img.jpg" alt="">
                    <div class="detail">
                        <p class="lg">丝绸之路巅峰体验九日游</p>
                        <p class="sm">本线路已有 <span>325</span> 人已报名</p>
                    </div>
                    <div class="price">
                        <span class="place">出发地 : 西安</span>
                        <span class="right">￥<span class="money">3280</span></span>
                    </div>
                    <a href="javascript" external></a>
                </div>
                <div class="item" data-id="<?php echo ($l["id"]); ?>">
                    <img class="img-responsive" src="/source/Static/phone/images/northwest/img.jpg" alt="">
                    <div class="detail">
                        <p class="lg">丝绸之路巅峰体验九日游</p>
                        <p class="sm">本线路已有 <span>250</span> 人已报名</p>
                    </div>
                    <div class="price">
                        <span class="place">出发地 : 西安</span>
                        <span class="right">￥<span class="money">3280</span></span>
                    </div>
                    <a href="javascript" external></a>
                </div>
                <div class="item" data-id="<?php echo ($l["id"]); ?>">
                    <img class="img-responsive" src="/source/Static/phone/images/northwest/img.jpg" alt="">
                    <div class="detail">
                        <p class="lg">丝绸之路巅峰体验九日游</p>
                        <p class="sm">本线路已有 <span>25</span> 人已报名</p>
                    </div>
                    <div class="price">
                        <span class="place">出发地 : 西安</span>
                        <span class="right">￥<span class="money">3280</span></span>
                    </div>
                    <a href="javascript" external></a>
                </div>
            </div>
        </div>

        <!--周边游-->
        <div class="zhoubian">
            <span class="zhoubian-img"><img class="img-responsive" src="/source/Static/home/images/northwest/zhoubian-tit.png" alt=""></span>
            <div class="recommend-result">
                <div class="item" data-id="<?php echo ($l["id"]); ?>">
                    <img class="img-responsive" src="/source/Static/phone/images/northwest/img.jpg" alt="">
                    <div class="detail">
                        <p class="lg">丝绸之路巅峰体验九日游</p>
                        <p class="sm">本线路已有 <span>25</span> 人已报名</p>
                    </div>
                    <div class="price">
                        <span class="place">出发地 : 西安</span>
                        <span class="right">￥<span class="money">3280</span></span>
                    </div>
                    <a href="javascript" external></a>
                </div>
                <div class="item" data-id="<?php echo ($l["id"]); ?>">
                    <img class="img-responsive" src="/source/Static/phone/images/northwest/img.jpg" alt="">
                    <div class="detail">
                        <p class="lg">丝绸之路巅峰体验九日游</p>
                        <p class="sm">本线路已有 <span>50</span> 人已报名</p>
                    </div>
                    <div class="price">
                        <span class="place">出发地 : 西安</span>
                        <span class="right">￥<span class="money">3280</span></span>
                    </div>
                    <a href="javascript" external></a>
                </div>
                <div class="item" data-id="<?php echo ($l["id"]); ?>">
                    <img class="img-responsive" src="/source/Static/phone/images/northwest/img.jpg" alt="">
                    <div class="detail">
                        <p class="lg">丝绸之路巅峰体验九日游</p>
                        <p class="sm">本线路已有 <span>568</span> 人已报名</p>
                    </div>
                    <div class="price">
                        <span class="place">出发地 : 西安</span>
                        <span class="right">￥<span class="money">3280</span></span>
                    </div>
                    <a href="javascript" external></a>
                </div>
                <div class="item" data-id="<?php echo ($l["id"]); ?>">
                    <img class="img-responsive" src="/source/Static/phone/images/northwest/img.jpg" alt="">
                    <div class="detail">
                        <p class="lg">丝绸之路巅峰体验九日游</p>
                        <p class="sm">本线路已有 <span>486</span> 人已报名</p>
                    </div>
                    <div class="price">
                        <span class="place">出发地 : 西安</span>
                        <span class="right">￥<span class="money">3280</span></span>
                    </div>
                    <a href="javascript" external></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- swiper -->
<script src="/source/Static/phone/common/js/swiper-3.3.1.min.js"></script>
<script>
    var swiper = new Swiper('.module .swiper-container', {
        slidesPerView: 2.4,
        paginationClickable: true,
        spaceBetween: 20,
        freeMode: true
    });
    //推荐标签切换
    $(".tit-tag span").on("click",function(){
        $(this).addClass("active").siblings().removeClass("active")
    })
    //图片列表切换
    $("#kllife").on("click",function(){
        $(".kllife-photo-list").show();
        $(".meikemei-photo-list").hide();
        $(this).find("img").attr("src","/source/Static/phone/images/xinjiang/kllife-phone.png")
        $("#meikemei").find("img").attr("src","/source/Static/phone/images/xinjiang/meikemei-phone1.png")
    })
    $("#meikemei").on("click",function(){
        $(".meikemei-photo-list").show();
        $(".kllife-photo-list").hide();
        $(this).find("img").attr("src","/source/Static/phone/images/xinjiang/meikemei-phone.png")
        $("#kllife").find("img").attr("src","/source/Static/phone/images/xinjiang/kllife-phone1.png")
    })
</script>


<!-- light7 -->
<script src="/source/Static/phone/common/js/light7.js"></script>
<!-- i18n 中文 -->
<script src="/source/Static/phone/common/js/cn.js"></script>
<!--公用JS文件-->
<script src="/source/Static/common/js/functions.js"></script>

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
</html>