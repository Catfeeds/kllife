<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
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
    
	<meta content="新旅拍" name="author"/>
	<?php if(empty($PageKeyword) == false): ?><meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
	<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
	<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
	<title><?php echo ($PageKeyword["title"]); ?></title>
	<?php else: ?>
	<title><?php echo C('PAGE_TITLE');?>-新旅拍</title><?php endif; ?>
	<!-- jq -->
	<script src="http://kllife.com/source/Static/phone/common/js/jquery.min.js"></script>
	<script type="text/javascript">	
		function ShowMark(){
			$('.black-mark').show();
		};
		function HideMark(){
			$('.black-mark').hide();
		};	
	</script>
	
	<link rel="stylesheet" href="http://kllife.com/source/Static/phone/common/css/light7.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/common/css/common.css">
	<!-- Imported toastr -->
	<script src="http://kllife.com/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="http://kllife.com/source/Static/common/js/jquery-1.11.1.min.js"></script>
	<script src="http://kllife.com/source/Static/common/js/functions.js"></script>
	<style>
		.black-mark { display: none; position: fixed; top:0; left:0; width: 100%; height: 100%; text-align: center; color:#fff; background: rgba(0,0,0,.5); z-index:3000; }
		.black-mark p { margin-top: 230px; color: #fff; text-align: center; }
	</style>
</head>
<body>
	<div class="black-mark">
		<p>稍等一会儿...</p>
	</div>
<div class="page">
	<!-- mycss -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/common/css/top2.css">
	<style>
		body , .content { background:#fff;padding-bottom:60px;}
		.bar { z-index: 9; }
		.bar-nav { position: static; }
		.questions-content p { margin-bottom: .5rem; font-size: .65rem; color:#333; text-indent: 2em; line-height:1.8; }
		.help-list h4 span{display:inline-block;font-size: .8rem!important;}
		.bar .button-link{color:#ff1c77;}
		.question-content{ position: relative; }
		.question-content > img { width: 100%; }
		img{width:100%;}
		.content-padded h5{font-size: 16px}
		.content-padded h3,.content-padded b{font-size: 15px}
	</style>
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="javascript:history.back();">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">帮助中心</h1>
		</header>
		
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
		
		<div class="content">
		
			<div class="questions-content">
				
				<div class="content-padded">
					<h5><?php echo ($show_question["content"]); ?></h5>
					<?php if(count($show_question['answers']) > 0): ?><p class="question-content"><?php echo ($show_question['answers'][0]['content']); ?></p>
					<?php else: ?>
						<p class="question-content">暂时没有更好的答案</p><?php endif; ?>
					
				</div>
				
			</div>
		
		</div>
		


<!-- light7 -->
<script src="http://kllife.com/source/Static/phone/common/js/light7.js"></script>
<!-- i18n 中文 -->
<script src="http://kllife.com/source/Static/phone/common/js/cn.js"></script>
<!--公用JS文件-->
<script src="http://kllife.com/source/Static/common/js/functions.js"></script>
<!--商务通代码--> 
<script language="javascript" src="http://pqt.zoosnet.net/JS/LsJS.aspx?siteid=PQT43116159&lng=cn"></script>
<script language="javascript" type="text/javascript" src="http://kllife.com/swt_xlp/js/swt.js"></script>
<!--CNZZ统计--> 
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1261595265'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1261595265%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
<!--百度统计-->
<script>
	var _hmt = _hmt || [];
	(function() {
		var hm = document.createElement("script");
		hm.src = "https://hm.baidu.com/hm.js?5b19bad2c5e7328683965e7447d46f4c";
		var s = document.getElementsByTagName("script")[0]; 
		s.parentNode.insertBefore(hm, s);
	})();
</script>


</body>
</html>