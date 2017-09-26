<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>    
    <meta charset="UTF-8">
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
    
	<?php if(empty($PageKeyword) == false): ?><meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
	<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
	<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
	<title><?php echo ($PageKeyword["title"]); ?></title>
	<?php else: ?>
	<title><?php echo C('PAGE_TITLE');?></title><?php endif; ?>
		
	<!-- 引用jq -->
	<script src="http://kllife.com/source/Static/home/common/js/jquery-1.11.3.min.js"></script>
	
    <link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/common/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/common/css/swiper-3.4.1.min.css">
    <link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/common/css/animate.css">
    <link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/common/css/common.css">
	<!-- 首页样式 -->
    <link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/css/index.css">
</head>
<body>
    <div class="phone index list content">
        <!-头部菜单和搜索->
        <div class="header">
            <div class="menu animated bounceInLeft">
                <!--<i class="iconfont">&#xe603;</i>-->
            </div>
            <div class="logo"><a href="<?php echo U('index/welcome');?>"><img class="animated bounceInDown" src="http://kllife.com/source/Static/qlpphone/common/images/logo-qinglvpai.png" alt=""></a>			</div>
            <div class="search animated bounceInRight">
                <!--<i class="iconfont">&#xe67a;</i>-->
            </div>
            <div class="search-block" style="z-index:100000">
                <div class="input-group" style="text-align: center">
                    <input type="text" class="form-control" placeholder="特惠线路...<?php echo C('MENU_ACTIVE');?>">
                    <span class="input-group-btn">
                        <button class="btn btn-orange-one" type="button">搜索</button>
                    </span>
                </div>
            </div>
        </div>
	    <div class="top" style="z-index:100;">
			<?php if(C('MENU_ACTIVE') == 'index'): ?><a href="javascript:;"><img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/index/index-top.jpg" alt=""></a>
		    <?php elseif(C('MENU_ACTIVE') == 'article'): ?>
		    <?php elseif(C('MENU_ACTIVE') == 'user'): ?>
		    <?php elseif(C('MENU_CURRENT') == 'line_list'): ?>
		    	<a href="javascript:;"><img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/list/top-image.jpg" alt=""></a>
		    <?php elseif(C('MENU_CURRENT') == 'line_main_list'): ?>
		    	<a href="javascript:;"><img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/list/slowly-top-image.jpg" alt=""></a>
		    <?php elseif(C('MENU_CURRENT') == 'line_content' or C('MENU_CURRENT') == 'line_main_content'): ?>
				<a href="javascript:;" style="position: relative;display: block">
		            <img class="img-responsive" src="<?php echo ($line["img1"]); ?>" alt="">
		            <div style="position: absolute;bottom:0px;left:0px;height:4rem;line-height:4rem;padding-left:1rem;font-size:1.5rem;width:100%;color:#fff;background: rgba(0,0,0,0.5)">编号：<?php echo ($line["id"]); ?></div>
		        </a>
		    <?php else: ?>
		    	<a href="javascript:;"><img class="img-responsive" src="<?php echo ($set["content_banner"]); ?>" alt=""></a><?php endif; ?>
	        <div class="menu-block">
	            <ul>
	                <a href="<?php echo U('index/welcome');?>"><li>首页</li></a>
	                <a href="javascript:;"><li>品牌故事</li></a>
	                <a href="<?php echo U('line/list');?>"><li>新旅拍</li></a>
	                <a href="http://kllife.com/phone/index.php?s=/phone/line/list"><li>小团慢旅行</li></a>
	                <a href="<?php echo U('Leader/list');?>"><li>摄影师</li></a>
	                <!--<a href="<?php echo U('line/artile');?>"><li>线路回顾</li></a>-->
	            </ul>
	        </div>
	    </div>
<style>
    body{background: #fd7260;}
    .index .top{display: none;}
    .centent{margin-top:20px;  margin-bottom:100px;width:100%;max-width:750px;}
    .centent .prompt{width:90%;background: #fff;  border-radius: 3px;  padding:50px 0px 40px;  margin:auto;}
    .centent .prompt .top1{padding:0px 25px;}
    .centent .prompt .bottom .type{text-align: center;text-align: -webkit-center;padding:30px 0px;}
    .centent .prompt .bottom div p{font-size: 20px;text-align: center;text-align: -webkit-center;color:#999;line-height:22px;}
    .centent .prompt .bottom .border-top{text-align: center;border-top:1px solid #dfdfdf}
    .centent .prompt .bottom .border-top .btn-back{background: #ff1c77;border-color:#ff1c77;color:#fff;width:150px;margin-top:35px;}
</style>

<div class="centent">
    <div class="prompt">
        <div class="top1"><img class="img-responsive" src="http://kllife.com/source/Static/qinglvpai/common/images/error.jpg" alt=""></div>
        <div class="bottom">
            <div class="type">
            </div>
            <div style="margin-bottom:35px;">
                <p> <?php echo ($err["title"]); ?> </p>
                <p> <?php echo ($err["content"]); ?> </p>
            </div>
            <div class="border-top">
                <a href="<?php echo U('Index/welcome');?>" class="btn btn-lg btn-back">返回首页</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var errno = '<?php echo ($err["errno"]); ?>';
		var errnoList = errno.split('');
		for (var i = 0; i < $(errnoList).length; i ++) {		
			$('.type').append('<span><img src="http://kllife.com/source/Static/qinglvpai/common/images/'+errnoList[i]+'.png" alt=""></span>');
		}
	});
</script>

<div class="footer">
	<a href="<?php echo U('index/welcome');?>" external>
		<div class="selected active">
			<i class="iconfont">&#xe629;</i>
			<p>首页</p>
		</div>
	</a>
	<a href="<?php echo U('line/list');?>" external>
		<div class="selected">
			<i class="iconfont">&#xe633;</i>
			<p>跟拍游</p>
		</div>
	</a>
	<a href="<?php echo ($pcset["askfor_link"]); ?>" external>
		<div class="selected">
			<i class="iconfont">&#xe66e;</i>
			<p>咨询</p>
		</div>
	</a>
	<a href="<?php echo U('Leader/list');?>" external>
		<div class="selected">
			<i class="iconfont">&#xe60f;</i>
			<p>摄影师</p>
		</div>
	</a>
	<a href="<?php echo U('user/info');?>" external>
		<div class="selected">
			<i class="iconfont">&#xe6a3;</i>
			<p>我的</p>
		</div>
	</a>
</div>
<script type="text/javascript" src="http://kllife.com/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>
<script type="text/javascript">
    jQuery(document).ready(
        function($){
            $("img").lazyload({
                placeholder : "http://kllife.com/source/Static/qinglvpai/common/js/grey.gif",
                effect      : "fadeIn",
                threshold : 0
            });
        });
</script>
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
<script type="text/javascript">
    //点击显示与隐藏菜单
//    $(".header .menu").on("click",function(){
//        $(".header .search-block").slideUp(500);
//        if(!$(".header .top").is(':visible')){
//            $(".header .top").slideDown(500);
//		}
//    })
//    $(".header .menu i").on("click",function(){
//        $(".header .search-block").slideUp(500);
//            $(".header .top").slideUp(500);
//    })

    //点击显示与隐藏搜索
//    $(".header .search").on("click",function(){
//        $(".header .top").slideUp(500);
//        if(!$(".header .search-block").is(':visible')){
//            $(".header .search-block").slideDown(500);
//        }
//    })
//    $(".header .search i").on("click",function(){
//        $(".header .top").slideUp(500);
//        $(".header .search-block").slideUp(500);
//    })

    //底部点击切换选中状态
//    $(".footer div").on("click",function(){
//        $(this).addClass("active").find("p").addClass("active");
//        $(this).addClass("active").find("i").addClass("active");
//        $(this).parent("a").siblings().find("div").removeClass("active").find("p").removeClass("active");
//        $(this).parent("a").siblings().find("div").removeClass("active").find("i").removeClass("active");
//    })
    $('.footer a').each(function(){
        if($($(this))[0].href==String(window.location)){
            $(this).find(".selected").addClass('active').parent("a").siblings("a").find(".selected").removeClass("active");
//            alert($($(this))[0].href==String(window.location))
//            alert(String(window.location))
        }
    });

    //屏幕滚动显示一键返回顶部按钮
    $(window).scroll( function (){
        if ($(this).scrollTop() > 100) {
            $('.return-top').fadeIn();
        }else{
            $('.return-top').fadeOut();
        };
    });

    //点击返回顶部
    $(".return-top").click(
        function(){
            $("html,body").animate({scrollTop: 0}, 1000);
        }
    );
</script>