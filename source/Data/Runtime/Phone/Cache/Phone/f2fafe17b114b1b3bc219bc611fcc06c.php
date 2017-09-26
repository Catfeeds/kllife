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
	<!--特殊专题额济纳标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_ejina'): ?>
		<title>额济纳旅游的首选__领袖户外旅行网__好玩不贵的小团慢旅行</title>
		<meta content="额济纳旅游的首选,领袖户外旅行网,好玩不贵的小团慢旅行" name="title"/>
	    <meta content="额济纳旅游,额济纳旅游攻略,额济纳旅游费用,额济纳旅游价格,额济纳胡杨林,额济纳旅游景点大全" name="keywords"/>
	    <meta content="额济纳旗，掉落在童话里的秋日，颠覆传统旅行方式，化腐朽为神奇的国庆精品线路。领袖户外：好玩不贵的小团慢旅行！,精品小团，享受一次恰到好处的慢旅行！在最美的风景中漫步、深呼吸，为不期而遇的惊艳停车，品味夕阳晨曦的美好，尽可能与美景相拥而眠，旅途中从陌生，变成朋友……" name="description"/>	
	<!--特殊专题新疆标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_xinjiang'): ?>
	    <title>新疆旅游的首选_领袖户外旅行网_好玩不贵的小团慢旅行_领袖户外官方网站</title>	
	    <meta content="新疆旅游的首选,领袖户外旅行网,好玩不贵的小团慢旅行,领袖户外官方网站" name="title"/>
	    <meta content="新疆旅游,新疆旅游攻略,新疆旅游费用,新疆旅游价格,新疆旅游景点大全,新疆驴友网,禾木驴友网,新疆驴友攻略,喀纳斯驴友网,新疆定制游" name="keywords"/>
	    <meta content="新疆旅游攻略，小团慢旅行,新疆自助游攻略，包括小团慢旅行,新疆热门景点、户外俱乐部、游记攻略、出行交通、餐饮等旅游信息，以及小团慢旅行,新疆驴友交流、驴友俱乐部信息。小团慢旅行,新疆旅游怎么订制。" name="description"/>	
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
<link rel="stylesheet" href="/source/Static/phone/css/xiaotuan.css">
<header class="bar bar-nav">
    <a class="button button-link button-nav pull-left back" href="javascript:history.back();">
        <i class="iconfont">&#xe606;</i>
    </a>
    <h1 class="title">小团慢旅行</h1>
</header>
<div class="content">
    <div class="xinjiang xiaotuan">
        <!--banner-->
        <img class="banner img-responsive" src="/source/Static/phone/images/xiaotuan/banner.jpg" alt="">
        <!--标题选择-->
        <div class="tit" id="tabs">
            <div class="tit1">
                <div class="left-tit">
                    <a class="a1" title="remen">热门推荐</a>
                    <a class="a2" title="xiaotuanman">小团慢旅行</a>
                    <a class="a3" title="xiezhenlvxing">跟拍游</a>
                    <a class="a4" title="dingzhi">定制游</a>
                    <a class="a5" title="sheyingyou">摄影游</a>
                </div>
                <div class="right-more">
                    <i class="iconfont rotate1">&#xe633;</i>
                </div>
            </div>
            <div class="tit2">
                <a class="a6" title="shenduyou">深度游</a>
                <a class="a7" title="july">线路推荐</a>
                <a class="a8" title="hot">目的地</a>
                <a class="a9" title="hot-two">热门线路</a>
                <a class="a10" title="marvellous">精彩游记</a>
            </div>
        </div>
        <!--28人精品小团-->
        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/jingpin.jpg" alt="">
        <!--照片墙-->
        <div class="photo">
            <img style="width:45%" src="/source/Static/phone/images/xiaotuan/photo-tit.png" alt="">
            <div class="tit">
                <span id="kllife"><img class="img-responsive" src="/source/Static/phone/images/xinjiang/kllife-phone.png" alt=""></span>
                <span id="meikemei"><img class="img-responsive" src="/source/Static/phone/images/xinjiang/meikemei-phone1.png" alt=""></span>
            </div>
            <div class="photo-list kllife-photo-list">
                <span><img class="img-responsive" src="/source/Static/phone/images/xinjiang/kllife-photo-list.png" alt=""></span>
                <!--<a href="<?php echo U('index/welcome');?>" external><span class="add"><img class="img-responsive" src="/source/Static/phone/images/xinjiang/kllife-add.png" alt=""></span></a>-->
            </div>
            <div class="photo-list meikemei-photo-list" style="display: none;">
                <span><img class="img-responsive" src="/source/Static/phone/images/xinjiang/meikemei-photo-list.png" alt=""></span>
                <!--<a href="http://m.xinlvpai.com/" external><span class="add"><img class="img-responsive" src="/source/Static/phone/images/xinjiang/meikemei-add.png" alt=""></span></a>-->
            </div>
        </div>
        <!--热门推荐-->
        <div class="remen" id="remen">
            <div class="name"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/remen.png" alt=""></div>
            <div class="choice">
                <ul>
                    <li class="active"><span>西藏</span></li>
                    <li><span>茶卡盐湖</span></li>
                    <li><span>嘉峪关</span></li>
                    <li><span>张掖丹霞</span></li>
                    <li><span>塔尔寺</span></li>
                    <li><span>青海湖</span></li>
                    <li><span>大柴旦</span></li>
                    <li><span>鸣沙山</span></li>
                    <li><span>莫高窟</span></li>
                    <li><span>嘉峪关</span></li>
                    <li><span>旋臂长城</span></li>
                    <li><span>祁连山</span></li>
                </ul>
            </div>
            <div class="group">
                <div class="item">
                    <div class="img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt="">
                        <span class="resort">兰州集合</span>
                        <p>本线路已有 <span>110</span> 人报名 </p>
                    </div>
                    <div class="explain">
                        <h1>纵情丝路跟拍游</h1>
                        <p class="p">沙岛-青海湖-茶卡盐湖-祁连-张掖-嘉峪关-敦煌9日游</p>
                        <div class="price">
                            <div class="money"><p>￥4880 <span>元起/人</span></p></div>
                            <div class="sign_up"><span>立即报名</span></div>
                        </div>
                    </div>
                    <a href="javascript:;"></a>
                </div>
                <div class="item">
                    <div class="img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt="">
                        <span class="resort">兰州集合</span>
                        <p>本线路已有 <span>110</span> 人报名 </p>
                    </div>
                    <div class="explain">
                        <h1>纵情丝路跟拍游</h1>
                        <p class="p">沙岛-青海湖-茶卡盐湖-祁连-张掖-嘉峪关-敦煌9日游</p>
                        <div class="price">
                            <div class="money"><p>￥4880 <span>元起/人</span></p></div>
                            <div class="sign_up"><span>立即报名</span></div>
                        </div>
                    </div>
                    <a href="javascript:;"></a>
                </div>
            </div>
        </div>
        <!--小团慢旅行-->
        <div class="xiaotuanman" id="xiaotuanman">
            <div class="name"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman-tit.png" alt=""></div>
            <div class="group">
                <div class="item">
                    <div class="img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt="">
                        <span class="resort">兰州集合</span>
                        <p>本线路已有 <span>110</span> 人报名 </p>
                    </div>
                    <div class="explain">
                        <h1>纵情丝路跟拍游</h1>
                        <p class="p">沙岛-青海湖-茶卡盐湖-祁连-张掖-嘉峪关-敦煌9日游</p>
                        <div class="price">
                            <div class="money"><p>￥4880 <span>元起/人</span></p></div>
                            <div class="sign_up"><span>立即报名</span></div>
                        </div>
                    </div>
                    <a href="javascript:;"></a>
                </div>
                <div class="item">
                    <div class="img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt="">
                        <span class="resort">兰州集合</span>
                        <p>本线路已有 <span>110</span> 人报名 </p>
                    </div>
                    <div class="explain">
                        <h1>纵情丝路跟拍游</h1>
                        <p class="p">沙岛-青海湖-茶卡盐湖-祁连-张掖-嘉峪关-敦煌9日游</p>
                        <div class="price">
                            <div class="money"><p>￥4880 <span>元起/人</span></p></div>
                            <div class="sign_up"><span>立即报名</span></div>
                        </div>
                    </div>
                    <a href="javascript:;"></a>
                </div>
                <!--更多-->
                <a href="javasctipt:" class="more"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/more.jpg" alt=""></a>
            </div>
        </div>
        <!--跟拍游-->
        <div class="xiezhenlvxing" id="xiezhenlvxing">
            <div class="name"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiezhenlvxing-tit.png" alt=""></div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="javascript:;">
                            <div class="img">
                                <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt="">
                                <span>兰州集合 </span>
                            </div>
                            <div class="background">
                                <h3>纵情丝路跟拍游</h3>
                                <p class="p">沙岛-青海湖-茶卡盐湖-祁连-张掖-嘉峪关-敦煌9日游</p>
                                <span type="button" class="btn"><p>￥4880 <span>元起/人</span></p></span>
                                <div style="background: #054ce4;height:50px;"></div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="javascript:;">
                            <div class="img">
                                <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt="">
                                <span>兰州集合 </span>
                            </div>
                            <div class="background">
                                <h3>纵情丝路跟拍游</h3>
                                <p class="p">沙岛-青海湖-茶卡盐湖-祁连-张掖-嘉峪关-敦煌9日游</p>
                                <span type="button" class="btn"><p>￥4880 <span>元起/人</span></p></span>
                                <div style="background: #054ce4;height:50px;"></div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="javascript:;">
                            <div class="img">
                                <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt="">
                                <span>兰州集合 </span>
                            </div>
                            <div class="background">
                                <h3>纵情丝路跟拍游</h3>
                                <p class="p">沙岛-青海湖-茶卡盐湖-祁连-张掖-嘉峪关-敦煌9日游</p>
                                <span type="button" class="btn"><p>￥4880 <span>元起/人</span></p></span>
                                <div style="background: #054ce4;height:50px;"></div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="javascript:;">
                            <div class="img">
                                <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt="">
                                <span>兰州集合 </span>
                            </div>
                            <div class="background">
                                <h3>纵情丝路跟拍游</h3>
                                <p class="p">沙岛-青海湖-茶卡盐湖-祁连-张掖-嘉峪关-敦煌9日游</p>
                                <span type="button" class="btn"><p>￥4880 <span>元起/人</span></p></span>
                                <div style="background: #054ce4;height:50px;"></div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="javascript:;">
                            <div class="img">
                                <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt="">
                                <span>兰州集合 </span>
                            </div>
                            <div class="background">
                                <h3>纵情丝路跟拍游</h3>
                                <p class="p">沙岛-青海湖-茶卡盐湖-祁连-张掖-嘉峪关-敦煌9日游</p>
                                <span type="button" class="btn"><p>￥4880 <span>元起/人</span></p></span>
                                <div style="background: #054ce4;height:50px;"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <!--定制游-->
        <a href="<?php echo U('line/book');?>" external><div class="dingzhi" id="dingzhi"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/dingzhi.png" alt=""></div></a>
        <!--摄影游-->
        <div class="sheyingyou" id="sheyingyou">
            <div class="name">
                <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/sheyingyou-tit.png" alt="">
                <img class="img-responsive sheyingyou-photo" src="/source/Static/phone/images/xiaotuan/sheyingyou-photo.png" alt="">
            </div>
            <div class="good-group">
                <div class="good-item">
                    <div class="good-img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/sheyingyou.jpg" alt="">
                        <span>兰州集合 </span>
                        <p class="lg">坝上夏季摄影</p>
                        <p class="sm">6-8月生如夏花，坝上草原6日</p>
                    </div>
                    <div class="good-explain">
                        <p>￥4880 <span>元起/人</span></p>
                        <span class="span">立即购买</span>
                    </div>
                    <a href="javascript:;"></a>
                </div>
                <div class="good-item">
                    <div class="good-img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/sheyingyou.jpg" alt="">
                        <span>兰州集合 </span>
                        <p class="lg">坝上夏季摄影</p>
                        <p class="sm">6-8月生如夏花，坝上草原6日</p>
                    </div>
                    <div class="good-explain">
                        <p>￥4880 <span>元起/人</span></p>
                        <span class="span">立即购买</span>
                    </div>
                    <a href="javascript:;"></a>
                </div>
                <div class="good-item">
                    <div class="good-img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/sheyingyou.jpg" alt="">
                        <span>兰州集合 </span>
                        <p class="lg">坝上夏季摄影</p>
                        <p class="sm">6-8月生如夏花，坝上草原6日</p>
                    </div>
                    <div class="good-explain">
                        <p>￥4880 <span>元起/人</span></p>
                        <span class="span">立即购买</span>
                    </div>
                    <a href="javascript:;"></a>
                </div>
                <div class="good-item">
                    <div class="good-img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/sheyingyou.jpg" alt="">
                        <span>兰州集合 </span>
                        <p class="lg">坝上夏季摄影</p>
                        <p class="sm">6-8月生如夏花，坝上草原6日</p>
                    </div>
                    <div class="good-explain">
                        <p>￥4880 <span>元起/人</span></p>
                        <span class="span">立即购买</span>
                    </div>
                    <a href="javascript:;"></a>
                </div>
                <div class="good-item">
                    <div class="good-img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/sheyingyou.jpg" alt="">
                        <span>兰州集合 </span>
                        <p class="lg">坝上夏季摄影</p>
                        <p class="sm">6-8月生如夏花，坝上草原6日</p>
                    </div>
                    <div class="good-explain">
                        <p>￥4880 <span>元起/人</span></p>
                        <span class="span">立即购买</span>
                    </div>
                    <a href="javascript:;"></a>
                </div>
                <div class="good-item">
                    <div class="good-img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/sheyingyou.jpg" alt="">
                        <span>兰州集合 </span>
                        <p class="lg">坝上夏季摄影</p>
                        <p class="sm">6-8月生如夏花，坝上草原6日</p>
                    </div>
                    <div class="good-explain">
                        <p>￥4880 <span>元起/人</span></p>
                        <span class="span">立即购买</span>
                    </div>
                    <a href="javascript:;"></a>
                </div>
                <!--更多-->
                <a href="javasctipt:" class="more"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/more.jpg" alt=""></a>
            </div>
        </div>
        <!--深度游-->
        <div class="shenduyou" id="shenduyou">
            <div class="name">
                <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/shenduyou-tit.png" alt="">
            </div>
            <div class="good-group">
                <div class="good-item">
                    <div class="good-img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/sheyingyou.jpg" alt="">
                        <span>兰州集合 </span>
                        <p class="lg">坝上夏季摄影</p>
                        <p class="sm">6-8月生如夏花，坝上草原6日</p>
                    </div>
                    <div class="good-explain">
                        <p>￥4880 <span>元起/人</span></p>
                        <span class="span">立即购买</span>
                    </div>
                    <a href="javascript:;"></a>
                </div>
                <div class="good-item">
                    <div class="good-img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/sheyingyou.jpg" alt="">
                        <span>兰州集合 </span>
                        <p class="lg">坝上夏季摄影</p>
                        <p class="sm">6-8月生如夏花，坝上草原6日</p>
                    </div>
                    <div class="good-explain">
                        <p>￥4880 <span>元起/人</span></p>
                        <span class="span">立即购买</span>
                    </div>
                    <a href="javascript:;"></a>
                </div>
                <div class="good-item">
                    <div class="good-img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/sheyingyou.jpg" alt="">
                        <span>兰州集合 </span>
                        <p class="lg">坝上夏季摄影</p>
                        <p class="sm">6-8月生如夏花，坝上草原6日</p>
                    </div>
                    <div class="good-explain">
                        <p>￥4880 <span>元起/人</span></p>
                        <span class="span">立即购买</span>
                    </div>
                    <a href="javascript:;"></a>
                </div>
                <div class="good-item">
                    <div class="good-img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/sheyingyou.jpg" alt="">
                        <span>兰州集合 </span>
                        <p class="lg">坝上夏季摄影</p>
                        <p class="sm">6-8月生如夏花，坝上草原6日</p>
                    </div>
                    <div class="good-explain">
                        <p>￥4880 <span>元起/人</span></p>
                        <span class="span">立即购买</span>
                    </div>
                    <a href="javascript:;"></a>
                </div>
                <div class="good-item">
                    <div class="good-img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/sheyingyou.jpg" alt="">
                        <span>兰州集合 </span>
                        <p class="lg">坝上夏季摄影</p>
                        <p class="sm">6-8月生如夏花，坝上草原6日</p>
                    </div>
                    <div class="good-explain">
                        <p>￥4880 <span>元起/人</span></p>
                        <span class="span">立即购买</span>
                    </div>
                    <a href="javascript:;"></a>
                </div>
                <div class="good-item">
                    <div class="good-img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/sheyingyou.jpg" alt="">
                        <span>兰州集合 </span>
                        <p class="lg">坝上夏季摄影</p>
                        <p class="sm">6-8月生如夏花，坝上草原6日</p>
                    </div>
                    <div class="good-explain">
                        <p>￥4880 <span>元起/人</span></p>
                        <span class="span">立即购买</span>
                    </div>
                    <a href="javascript:;"></a>
                </div>
                <!--更多-->
                <a href="javasctipt:" class="more"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/more.jpg" alt=""></a>
            </div>
        </div>
        <!--7月推荐-->
        <div class="july" id="july">
            <div class="name">
                <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/july-tit.png" alt="">
            </div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="july-group">
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p class="lg">心花路放</p>
                                    <p class="sm">680人出游</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p class="lg">心花路放</p>
                                    <p class="sm">680人出游</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p class="lg">心花路放</p>
                                    <p class="sm">680人出游</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p class="lg">心花路放</p>
                                    <p class="sm">680人出游</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p class="lg">心花路放</p>
                                    <p class="sm">680人出游</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p class="lg">心花路放</p>
                                    <p class="sm">680人出游</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                        </div>
                        <div style="height:40px;"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="july-group">
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p class="lg">心花路放</p>
                                    <p class="sm">680人出游</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p class="lg">心花路放</p>
                                    <p class="sm">680人出游</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p class="lg">心花路放</p>
                                    <p class="sm">680人出游</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p class="lg">心花路放</p>
                                    <p class="sm">680人出游</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p class="lg">心花路放</p>
                                    <p class="sm">680人出游</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p class="lg">心花路放</p>
                                    <p class="sm">680人出游</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                        </div>
                        <div style="height:40px;"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="july-group">
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p class="lg">心花路放</p>
                                    <p class="sm">680人出游</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p class="lg">心花路放</p>
                                    <p class="sm">680人出游</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p class="lg">心花路放</p>
                                    <p class="sm">680人出游</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p class="lg">心花路放</p>
                                    <p class="sm">680人出游</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p class="lg">心花路放</p>
                                    <p class="sm">680人出游</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p class="lg">心花路放</p>
                                    <p class="sm">680人出游</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                        </div>
                        <div style="height:40px;"></div>
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <!--热门目的地-->
        <div class="hot" id="hot">
            <div class="name">
                <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/hot-tit.png" alt="">
            </div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="july-group">
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p>甘南</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p>甘南</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p>甘南</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p>甘南</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p>甘南</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p>甘南</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                        </div>
                        <div style="height:70px;"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="july-group">
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p>甘南</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p>甘南</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p>甘南</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p>甘南</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p>甘南</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p>甘南</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                        </div>
                        <div style="height:70px;"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="july-group">
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p>甘南</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p>甘南</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p>甘南</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p>甘南</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p>甘南</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                            <div class="july-item">
                                <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/xiaotuanman.jpg" alt=""></div>
                                <div class="background">
                                    <p>甘南</p>
                                </div>
                                <a href="javascript:;"></a>
                            </div>
                        </div>
                        <div style="height:70px;"></div>
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <!--热门线路-->
        <div class="hot-two" id="hot-two">
            <div class="name">
                <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/hot-two-tit.png" alt="">
            </div>
            <div class="hot-group">
                <div class="hot-item">
                    <div class="img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/hot-two.jpg" alt="">
                        <span>甘南集合</span>
                    </div>
                    <div class="hot-explain">
                        <p class="p">梦中天堂</p>
                        <p class="money">￥4880 <span>元起/人</span></p>
                    </div>
                </div>
                <div class="hot-item">
                    <div class="img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/hot-two.jpg" alt="">
                        <span>甘南集合</span>
                    </div>
                    <div class="hot-explain">
                        <p class="p">梦中天堂</p>
                        <p class="money">￥4880 <span>元起/人</span></p>
                    </div>
                </div>
                <div class="hot-item">
                    <div class="img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/hot-two.jpg" alt="">
                        <span>甘南集合</span>
                    </div>
                    <div class="hot-explain">
                        <p class="p">梦中天堂</p>
                        <p class="money">￥4880 <span>元起/人</span></p>
                    </div>
                </div>
                <div class="hot-item">
                    <div class="img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/hot-two.jpg" alt="">
                        <span>甘南集合</span>
                    </div>
                    <div class="hot-explain">
                        <p class="p">梦中天堂</p>
                        <p class="money">￥4880 <span>元起/人</span></p>
                    </div>
                </div>
                <div class="hot-item">
                    <div class="img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/hot-two.jpg" alt="">
                        <span>甘南集合</span>
                    </div>
                    <div class="hot-explain">
                        <p class="p">梦中天堂</p>
                        <p class="money">￥4880 <span>元起/人</span></p>
                    </div>
                </div>
                <div class="hot-item">
                    <div class="img">
                        <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/hot-two.jpg" alt="">
                        <span>甘南集合</span>
                    </div>
                    <div class="hot-explain">
                        <p class="p">梦中天堂</p>
                        <p class="money">￥4880 <span>元起/人</span></p>
                    </div>
                </div>
            </div>
        </div>
        <!--精彩游记-->
        <div class="marvellous" id="marvellous">
            <div class="name">
                <img class="img-responsive" src="/source/Static/phone/images/xiaotuan/marvellous-tit.png" alt="">
            </div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="javascript:;">
                            <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/marvellous.jpg" alt=""></div>
                            <div class="background">
                                <p>有了纵情丝路，其它的都弱爆直播，有大量美女</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="javascript:;">
                            <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/marvellous.jpg" alt=""></div>
                            <div class="background">
                                <p>七月的丝路之行！</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="javascript:;">
                            <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/marvellous.jpg" alt=""></div>
                            <div class="background">
                                <p>七月的丝路之行！</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="javascript:;">
                            <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/marvellous.jpg" alt=""></div>
                            <div class="background">
                                <p>有了纵情丝路，其它的都弱爆直播，有大量美女</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="javascript:;">
                            <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/marvellous.jpg" alt=""></div>
                            <div class="background">
                                <p>七月的丝路之行！</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="javascript:;">
                            <div class="img"><img class="img-responsive" src="/source/Static/phone/images/xiaotuan/marvellous.jpg" alt=""></div>
                            <div class="background">
                                <p>七月的丝路之行！</p>
                            </div>
                        </a>
                    </div>
                    <!--更多游记-->
                    <div class="swiper-slide">
                        <a href="http://shequ.kllife.com/Mobile/Index/index.html">
                            <div><img class="youji-more" src="/source/Static/phone/images/xiaotuan/youji-more.png" alt=""></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- swiper -->
<script src="/source/Static/phone/common/js/swiper-3.3.1.min.js"></script>
<script>
    //热门推荐选择
    $(".choice li").on("click",function(){
        $(this).addClass("active").siblings().removeClass("active")
    })
    //定位标题关闭显示切换
    $(".right-more i").on("click",function(){
        if($(".tit2").is(":hidden")){
            $(".tit2").slideDown(500);
            $(this).addClass("rotate").removeClass("rotate1");
        }else{
            $(".tit2").slideUp(500);
            $(this).removeClass("rotate").addClass("rotate1")
        }
    })
    //跟拍游
    var swiper = new Swiper('.xiezhenlvxing .swiper-container', {
        pagination: '.xiezhenlvxing .swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        slidesPerView: 1,
        paginationClickable: true,
        autoplay: 3000,
        loop: true
    });
    //7月推荐
    var swiper = new Swiper('.july .swiper-container', {
        pagination: '.july .swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        slidesPerView: 1,
        paginationClickable: true,
        autoplay: 3000,
        loop: true
    });
    //热门目的地
    var swiper = new Swiper('.hot .swiper-container', {
        pagination: '.hot .swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        slidesPerView: 1,
        paginationClickable: true,
        autoplay: 3000,
        loop: true
    });
    //精彩游记
    var swiper = new Swiper('.marvellous .swiper-container', {
        slidesPerView: 2.4,
        paginationClickable: true,
        spaceBetween: 10,
        freeMode: true
    });
    //照片墙切换
    $("#kllife").on("click",function(){
        $(".kllife-photo-list").show();
        $(".meikemei-photo-list").hide();
        $(this).find("img").attr("src","/source/Static/phone/images/xinjiang/kllife-phone.png");
        $("#meikemei").find("img").attr("src","/source/Static/phone/images/xinjiang/meikemei-phone1.png");
    })

    $("#meikemei").on("click",function(){
        $(".meikemei-photo-list").show();
        $(".kllife-photo-list").hide();
        $(this).find("img").attr("src","/source/Static/phone/images/xinjiang/meikemei-phone.png");
        $("#kllife").find("img").attr("src","/source/Static/phone/images/xinjiang/kllife-phone1.png");
    })



    //滚动事件
    window.onload = function() {
        //切换
        $('#tabs .tit1 .left-tit a').click( function (){
            $(this).addClass('active').siblings().removeClass('active');
            $(".tit2 a").removeClass('active');
        } );
        $('#tabs .tit2 a').click( function (){
            $(this).addClass('active').siblings().removeClass('active');
            $(".tit1 .left-tit a").removeClass('active');
        } );

        //元素滚动到指定位置
        //tabs高度
        var tabsHeight = $('#tabs').height();
        //header高度
        var headerHeight = $('header').height();
        //获取content滚动的距离
        var g = 0;
        //小团慢距离顶部距离
        var remen = $('#remen').offset().top;
        //小团慢距离顶部距离
        var xiaotuanman = $('#xiaotuanman').offset().top;
        //跟拍游距离顶部距离
        var xiezhenlvxing = $('#xiezhenlvxing').offset().top;
        //定制游距离顶部距离
        var dingzhi = $('#dingzhi').offset().top;
        //摄影游距离顶部距离
        var sheyingyou = $('#sheyingyou').offset().top;
        //深度游距离顶部距离
        var shenduyou = $('#shenduyou').offset().top;
        //线路推荐距离顶部距离
        var july = $('#july').offset().top;
        //热门目的地距离顶部距离
        var hot = $('#hot').offset().top;
        //热门线路距离顶部距离
        var hottwo = $('#hot-two').offset().top;
        //精彩游记距离顶部距离
        var marvellous = $('#marvellous').offset().top;


        //content距顶部距离
        var contentHeight = parseInt($('.content').css('top'));
        //相差距离
        var HcalculateHeight = tabsHeight + headerHeight + contentHeight;
        var BcalculateHeight = tabsHeight + headerHeight + contentHeight +40;
        $('.content').on( "scroll", function() {

            g = $('.content').scrollTop();
            //判断距离，给相应元素添加删除class
            if($(".tit2").is(":hidden")){
                if( g > ( remen - HcalculateHeight ) && g < ( xiaotuanman- HcalculateHeight ) ) {
                    $('.a1').addClass('active').siblings().removeClass('active');
                    $(".tit2 a").removeClass('active');
                } else if( g > ( xiaotuanman - HcalculateHeight ) && g < ( xiezhenlvxing- HcalculateHeight ) ) {
                    $('.a2').addClass('active').siblings().removeClass('active');
                    $(".tit2 a").removeClass('active');
                }else if ( g >= ( xiezhenlvxing - HcalculateHeight ) && g < ( dingzhi - HcalculateHeight ) ){
                    $('.a3').addClass('active').siblings().removeClass('active');
                    $(".tit2 a").removeClass('active');
                }else if ( g >= ( dingzhi - HcalculateHeight ) && g < ( sheyingyou - HcalculateHeight ) ) {
                    $('.a4').addClass('active').siblings().removeClass('active');
                    $(".tit2 a").removeClass('active');
                }else if ( g >= ( sheyingyou - HcalculateHeight ) && g < ( shenduyou - HcalculateHeight ) ) {
                    $('.a5').addClass('active').siblings().removeClass('active');
                    $(".tit2 a").removeClass('active');
                }else if ( g >= ( shenduyou - HcalculateHeight ) && g < ( july - HcalculateHeight ) ) {
                    $('.a6').addClass('active').siblings().removeClass('active');
                    $(".tit1 .left-tit a").removeClass('active');
                }else if ( g >= ( july - HcalculateHeight ) && g < ( hot - HcalculateHeight ) ) {
                    $('.a7').addClass('active').siblings().removeClass('active');
                    $(".tit1 .left-tit a").removeClass('active');
                }else if ( g >= ( hot - HcalculateHeight ) && g < ( hottwo - HcalculateHeight ) ) {
                    $('.a8').addClass('active').siblings().removeClass('active');
                    $(".tit1 .left-tit a").removeClass('active');
                }else if ( g >= ( hottwo - HcalculateHeight ) && g < ( marvellous - HcalculateHeight ) ) {
                    $('.a9').addClass('active').siblings().removeClass('active');
                    $(".tit1 .left-tit a").removeClass('active');
                }else if ( g >= ( marvellous - HcalculateHeight ) ) {
                    $('.a10').addClass('active').siblings().removeClass('active');
                    $(".tit1 .left-tit a").removeClass('active');
                }
            }else{
                if( g > ( remen - BcalculateHeight ) && g < ( xiaotuanman- BcalculateHeight ) ) {
                    $('.a1').addClass('active').siblings().removeClass('active');
                    $(".tit2 a").removeClass('active');
                } else if( g > ( xiaotuanman - BcalculateHeight ) && g < ( xiezhenlvxing- BcalculateHeight ) ) {
                    $('.a2').addClass('active').siblings().removeClass('active');
                    $(".tit2 a").removeClass('active');
                }else if ( g >= ( xiezhenlvxing - BcalculateHeight ) && g < ( dingzhi - BcalculateHeight ) ){
                    $('.a3').addClass('active').siblings().removeClass('active');
                    $(".tit2 a").removeClass('active');
                }else if ( g >= ( dingzhi - BcalculateHeight ) && g < ( sheyingyou - BcalculateHeight ) ) {
                    $('.a4').addClass('active').siblings().removeClass('active');
                    $(".tit2 a").removeClass('active');
                }else if ( g >= ( sheyingyou - BcalculateHeight ) && g < ( shenduyou - BcalculateHeight ) ) {
                    $('.a5').addClass('active').siblings().removeClass('active');
                    $(".tit2 a").removeClass('active');
                }else if ( g >= ( shenduyou - BcalculateHeight ) && g < ( july - BcalculateHeight ) ) {
                    $('.a6').addClass('active').siblings().removeClass('active');
                    $(".tit1 .left-tit a").removeClass('active');
                }else if ( g >= ( july - BcalculateHeight ) && g < ( hot - BcalculateHeight ) ) {
                    $('.a7').addClass('active').siblings().removeClass('active');
                    $(".tit1 .left-tit a").removeClass('active');
                }else if ( g >= ( hot - BcalculateHeight ) && g < ( hottwo - BcalculateHeight ) ) {
                    $('.a8').addClass('active').siblings().removeClass('active');
                    $(".tit1 .left-tit a").removeClass('active');
                }else if ( g >= ( hottwo - BcalculateHeight ) && g < ( marvellous - BcalculateHeight ) ) {
                    $('.a9').addClass('active').siblings().removeClass('active');
                    $(".tit1 .left-tit a").removeClass('active');
                }else if ( g >= ( marvellous - BcalculateHeight ) ) {
                    $('.a10').addClass('active').siblings().removeClass('active');
                    $(".tit1 .left-tit a").removeClass('active');
                }
            }


        });

        //tabs点击时处理事件
        $('#tabs a').click(
            //
            function( event ){
                var $anchor = $(this);
                //定位元素距离顶部距离
                var eleHeight = $('#' + $anchor.attr('title')).offset().top;
                //当tabs是固定定位时
                if($(".tit2").is(":hidden")){
                    if($('#tabs').css('position') == 'fixed'){

                        $('.content').stop().animate({scrollTop: g + eleHeight - headerHeight + 5 }, 600);

                    }else{

                        $('.content').stop().animate({scrollTop: g + eleHeight - HcalculateHeight +5 }, 600);

                    }
                }else{
                    if($('#tabs').css('position') == 'fixed'){

                        $('.content').stop().animate({scrollTop: g + eleHeight - headerHeight - 35 }, 600);

                    }else{

                        $('.content').stop().animate({scrollTop: g + eleHeight - BcalculateHeight -35 }, 600);

                    }
                }

                //取消默认操作
                event.preventDefault();
            }
        );

        function changeTab(){
            //获取tabs距离顶部距离-header
            var topheight =$('#tabs').offset().top -44 ;
            //绑定滚动事件
            $('.content').on( "scroll", function() {
                //content滚动距离
                var p = $('.content').scrollTop();
                //当tabs距离顶部距离-header <= p
                if( topheight <= p ){
                    //固定tabs
                    $('#tabs').css({'position':'fixed',
                        'top':'0',
                        'left':'0',
                        'width':'100%',
                        'z-index':'9999'});
                    //解决ios header盖住content
                    $('header').hide();
                    $('.content').css('top','0');
                }else{
                    //清除固定
                    $('#tabs').css('position','static');
                    //解决ios header盖住content
                    $('header').show();
                    $('.content').css('top','2.2rem');
                }

            });
        }
        changeTab();
    }
</script>


<!-- light7 -->
<script src="/source/Static/phone/common/js/light7.js"></script>
<!-- i18n 中文 -->
<script src="/source/Static/phone/common/js/cn.js"></script>
<!--公用JS文件-->
<script src="/source/Static/common/js/functions.js"></script>

<script>		
    //加载指示
    function PageLoading() {
    	this.loaded = false;
    }
    
    PageLoading.prototype.isLoading = function () {
    	return this.loaded;
    }
    
    PageLoading.prototype.loading = function (bshow, bstyle) {
    	this.loaded = bshow;
    	if (bstyle == null || bstyle == true) {
	    	if (bshow) {
	       		$.showPreloader();
	    	} else {
	            $.hidePreloader();	
	    	}
    	}
    }
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
</html>