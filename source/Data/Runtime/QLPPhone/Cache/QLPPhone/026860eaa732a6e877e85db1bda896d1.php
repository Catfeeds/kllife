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

<!--这里写品牌故事代码-->
<link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/css/stroy.css">
<div class="stroy">
    <div class="banner"><img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/stroy/story.jpg" alt=""></div>
    <!--<div class="item">-->
        <!--<img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/stroy/background-three.jpg" alt="">-->
    <!--</div>-->
    <!--<div class="brand-story" style="padding-bottom:0px;">-->
        <!--<h1 class="h1">品牌故事</h1>-->
        <!--<div class="tit">-->
            <!--<img src="http://kllife.com/source/Static/qlpphone/images/stroy/story-tit.jpg" alt="">-->
            <!--<h2 class="h2">队友心声</h2>-->
        <!--</div>-->
        <!--<div style="border-bottom:2px solid #ff1c77;margin:auto;width:60px;margin-bottom:40px;">&lt;!&ndash;此div只用于显示border&ndash;&gt;</div>-->
        <!--&lt;!&ndash;<div class="bottom">&ndash;&gt;-->
            <!--&lt;!&ndash;<p>此生不长，有些精彩只会经历一次，有些风景只能路过一回。</p>&ndash;&gt;-->
        <!--&lt;!&ndash;</div>&ndash;&gt;-->
        <!--&lt;!&ndash;<div class="bottom">&ndash;&gt;-->
            <!--&lt;!&ndash;<p>我们总忙着实现事业目标，</p>&ndash;&gt;-->
            <!--&lt;!&ndash;<p>追寻社会存在感的光影里，</p>&ndash;&gt;-->
            <!--&lt;!&ndash;<p>每每有时间停下来，</p>&ndash;&gt;-->
            <!--&lt;!&ndash;<p>翻看那些旅途中的照片，</p>&ndash;&gt;-->
            <!--&lt;!&ndash;<p>才发现诸多照片中自己的身影少之又少，</p>&ndash;&gt;-->
            <!--&lt;!&ndash;<p>有几张还丑的不像样，</p>&ndash;&gt;-->
            <!--&lt;!&ndash;<p>一种说不出的落寞萦绕在心间。</p>&ndash;&gt;-->
        <!--&lt;!&ndash;</div>&ndash;&gt;-->
        <!--<img class="img-responsive story-two-img" src="http://kllife.com/source/Static/qlpphone/images/stroy/story-two.jpg" alt="">-->
        <!--&lt;!&ndash;<div class="bottom">&ndash;&gt;-->
            <!--&lt;!&ndash;<p>所以，我们创立了新旅拍，小团慢旅行+共享摄影师。</p>&ndash;&gt;-->
            <!--&lt;!&ndash;<p>让一群喜欢美，追求美的姐妹们欢聚在一起，</p>&ndash;&gt;-->
            <!--&lt;!&ndash;<p>一边享受美景，美食，好心情；</p>&ndash;&gt;-->
            <!--&lt;!&ndash;<p>一边拍美照，交流美的秘籍。</p>&ndash;&gt;-->
            <!--&lt;!&ndash;<p>再也不怕时间紧张，匆匆赶场，</p>&ndash;&gt;-->
            <!--&lt;!&ndash;<p>再也不怕除了剪刀手，就是大头照了。</p>&ndash;&gt;-->
            <!--&lt;!&ndash;<p>你的美需要发现、需要珍藏、需要炫耀！</p>&ndash;&gt;-->
            <!--&lt;!&ndash;<p>人生总有一天会疲倦，会老去，</p>&ndash;&gt;-->
            <!--&lt;!&ndash;<p>但我们拍摄的每一张照片，都蕴含着一个故事。</p>&ndash;&gt;-->
            <!--&lt;!&ndash;<p>记录着一段过往。</p>&ndash;&gt;-->
            <!--&lt;!&ndash;<p>那些重要的人，不可遗忘的事，曾经漂洋过海去看的风景，</p>&ndash;&gt;-->
            <!--&lt;!&ndash;<p>都会通过照片让记忆变得丰满而生动。</p>&ndash;&gt;-->
        <!--&lt;!&ndash;</div>&ndash;&gt;-->
        <!--&lt;!&ndash;<div class="bottom">&ndash;&gt;-->
            <!--&lt;!&ndash;<p>愿你旅途中的每一刻美好都有光影为伴，都有照片为鉴！</p>&ndash;&gt;-->
            <!--&lt;!&ndash;<p>每刻美由此而来。</p>&ndash;&gt;-->
        <!--&lt;!&ndash;</div>&ndash;&gt;-->
    <!--</div>-->
    <!--<div class="brand-story">-->
        <!--<h1 class="h1">队友分享</h1>-->
        <!--<div style="border-bottom:2px solid #ff1c77;margin:auto;width:60px;margin-bottom:40px;">&lt;!&ndash;此div只用于显示border&ndash;&gt;</div>-->
        <!--<div class="item-group">-->
            <!--<img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/stroy/share.jpg" alt="">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="my">-->
        <!--<h1 class="h1">关于我们的队友</h1>-->
        <!--<div style="border-bottom:2px solid #ff1c77;margin:auto;width:60px;margin-bottom:40px;">&lt;!&ndash;此div只用于显示border&ndash;&gt;</div>-->
        <!--<div class="padding">-->
            <!--<img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/stroy/friend.jpg" alt="">-->
            <!--&lt;!&ndash;<div class="background">&ndash;&gt;-->
                <!--&lt;!&ndash;<div class="border">&ndash;&gt;-->
                    <!--&lt;!&ndash;<div>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p>出发前你是否在纠结</p>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p>碰到喜欢碎碎念、爱抱怨的人怎么办？</p>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p>碰到爱磨蹭，喜欢插队的人会影响我的旅拍计划吗？</p>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p>碰到爱争抢摄影师的人，能否拍到足够多的美照？</p>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p>……</p>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p>接触后，才发现，原先的顾虑都是多余的</p>&ndash;&gt;-->
                    <!--&lt;!&ndash;</div>&ndash;&gt;-->
                    <!--&lt;!&ndash;<div>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p>热情爱美的王姨，气质优雅的李姐</p>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p>超级温柔贴心的蓓蓓，团里的开心果小瑞</p>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p>……</p>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p>她们每一位都是热情善良，好相处</p>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p>相由心生，我信了</p>&ndash;&gt;-->
                    <!--&lt;!&ndash;</div>&ndash;&gt;-->
                    <!--&lt;!&ndash;<div>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p>游玩时，我们结伴而行</p>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p>遇到美食，我们分而食之，再也不纠结 </p>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p>拍照时，交流pose，共享拍照小道具</p>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p>休息时，畅谈生活中所有美的秘籍</p>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p>感恩这23位旅伴</p>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p>让我的拍照过程不再枯燥，满满的都是欢笑和温暖</p>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p>美照很重要，但跟大家一起交流美更可贵</p>&ndash;&gt;-->
                    <!--&lt;!&ndash;</div>&ndash;&gt;-->
                <!--&lt;!&ndash;</div>&ndash;&gt;-->
            <!--&lt;!&ndash;</div>&ndash;&gt;-->
            <!--&lt;!&ndash;<img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/stroy/friend2.jpg" alt="">&ndash;&gt;-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="difference">-->
        <!--<h1 class="h1">新旅拍与传统旅拍的区别</h1>-->
        <!--<div style="border-bottom:2px solid #ff1c77;margin:auto;width:60px;margin-bottom:40px;">&lt;!&ndash;此div只用于显示border&ndash;&gt;</div>-->
        <!--<div class="img"><img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/stroy/difference.jpg" alt=""></div>-->
        <!--<div class="contact"><img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/stroy/my.jpg" alt=""></div>-->
    <!--</div>-->
</div>

<script type="text/javascript">
</script>

        <!--footer-->
        <div class="footer">
            <a href="<?php echo U('index/welcome');?>">
                <div class="selected active">
                    <i class="iconfont">&#xe629;</i>
                    <p>首页</p>
                </div>
            </a>
            <a href="<?php echo U('line/list');?>">
                <div class="selected">
                    <i class="iconfont">&#xe633;</i>
                    <p>跟拍游</p>
                </div>
            </a>
            <a href="<?php echo ($pcset["askfor_link"]); ?>">
                <div class="selected">
                    <i class="iconfont">&#xe66e;</i>
                    <p>咨询</p>
                </div>
            </a>
            <a href="<?php echo U('Leader/list');?>">
                <div class="selected">
                    <i class="iconfont">&#xe60f;</i>
                    <p>摄影师</p>
                </div>
            </a>
            <a href="<?php echo U('user/info');?>">
                <div class="selected">
                    <i class="iconfont">&#xe6a3;</i>
                    <p>我的</p>
                </div>
            </a>
        </div>
	</div>
    <!--点击返回顶部-->
    <div class="return-top"><i class="iconfont" style="font-size: 50px;">&#xe68f;</i></div>
        <script type="text/javascript" src="http://kllife.com/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(
                function($){
                    $("img").lazyload({
                        placeholder : "http://kllife.com/source/Static/qinglvpai/common/js/grey.gif",
                        effect      : "fadeIn",
                        threshold : 100,
                        failure_limit : 10
                    });
                });
        </script>
    <script type="text/javascript">
	    //点击显示与隐藏菜单
//	    $(".menu").on("click",function(){
//	        if($(".menu-block").is(":hidden")==false){
//	            $(".menu-block").slideUp(500);
//	            $(".search-block").slideUp(500);
//	        }else{
//	            $(".menu-block").slideDown(500);
//	            $(".search-block").slideUp(500);
//	        }
//	    })
	    
	    //点击显示与隐藏搜索
//	    $(".search").on("click",function(){
//	        if($(".search-block").is(":hidden")==false){
//	            $(".search-block").slideUp(500);
//	            $(".menu-block").slideUp(500);
//	        }else{
//	            $(".search-block").slideDown(500);
//	            $(".menu-block").slideUp(500);
//	        }
//	    })
	    
	    //底部点击切换选中状态
//	    $(".footer div").on("click",function(){
//	        $(this).addClass("active").find("p").addClass("active");
//	        $(this).addClass("active").find("i").addClass("active");
//	        $(this).parent("a").siblings().find("div").removeClass("active").find("p").removeClass("active");
//	        $(this).parent("a").siblings().find("div").removeClass("active").find("i").removeClass("active");
//	    })
        $('.footer a').each(function(){
            if($($(this))[0].href==String(window.location)){
                $(this).find(".selected").addClass('active').parent("a").siblings("a").find(".selected").removeClass("active");
//                alert($($(this))[0].href==String(window.location))
//                alert(String(window.location))
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
</body>
</html>