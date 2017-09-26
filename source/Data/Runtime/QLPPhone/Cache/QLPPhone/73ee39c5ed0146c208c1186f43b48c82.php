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
	<script type="text/javascript">	
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
                var vurl = window.location.href;
                if (vurl.indexOf('www.') != -1) {
                    vurl = window.location.href.replace(/www./g, '');
                }
                var vhref = vurl.replace(/m\./g, '').replace(/qinglvpai/g,'qlpphone');
               	window.location.href = vhref;
			}
		}
		browserRedirect();
	</script>
	
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
	<!--私有样式-->
	<link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/css/article_info.css">
	<div class="page" style="position: absolute;top:60px;max-width:750px;">
		<div class="content">
			<div class="top-1">
				<img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/article_info/top.jpg" alt="">
			</div>
			<div class="photographer">
				<p class="tit">摄影师</p>
				<p>
					<span class="span name1">网名: <span>刘野花</span></span>
					<span class="span name2">艺名: <span>刘野花</span></span>
				</p>
				<p>
					<span class="span constellation">星座: <span>天蝎座</span></span>
					<span class="span type">血型: <span>AB</span></span>
				</p>
				<p class="brief-info">拍摄经历及简介：</p>
				<p>工作生活于北京、深圳。提倡Fashion Art的摄影创作，亦是国内首次提出Fashion Art摄影概念的摄影师。全职摄影前，曾任职国际4A广告公司创意部及身为时尚媒体资深编辑多年。</p>
				<div class="impression">
					<div class="left">印象 :</div>
					<div class="right">
						<span>女汉子</span>
						<span>女汉子</span>
						<span>女汉子</span>
						<span>女汉子</span>
						<span>女汉子</span>
						<p class="add">添加+</p>
					</div>
				</div>
				<div class="absolute">
					<div class="tit-two">
						对他的印象 <span class="remove-impress"><i class="iconfont">&#xe66c;</i></span>
					</div>
					<div class="impress">
						<span id="1" class="active">暖男</span>
						<span id="2">苗条</span>
						<span id="3">学霸</span>
						<span id="4">漂亮</span>
						<span id="5">热情</span>
						<span id="6">帅气</span>
						<span id="7">亲切</span>
						<span id="8">老司机</span>
						<span id="9">有耐心</span>
						<span id="10">小鲜肉</span>
						<span id="11">老腊肉</span>
						<span id="12">肌肉男</span>
						<span id="13">责任心强</span>
						<span id="14">风趣幽默</span>
						<span id="15">文艺青年</span>
						<span id="16">心宽体胖</span>
						<span id="17">摄影技术好</span>
					</div>
					<a class="btn btn-submit">提交</a>
				</div>
			</div>
			<div class="problem">
				<div class="item">
					<div class="wen">
						<div class="left">Q :</div>
						<div class="right">接触摄影有多久了？对于自己的作品，个人最关注的是什么？</div>
					</div>
					<div class="da">
						<div class="left">A :</div>
						<div class="right">当然记得(ノ=Д=)ノ┻━┻话都说不利索！</div>
					</div>
				</div>
				<div class="item">
					<div class="wen">
						<div class="left">Q :</div>
						<div class="right">你都去过哪些地方旅行和拍摄呢？</div>
					</div>
					<div class="da">
						<div class="left">A :</div>
						<div class="right">当然记得(ノ=Д=)ノ┻━┻话都说不利索！</div>
					</div>
				</div>
				<div class="item">
					<div class="wen">
						<div class="left">Q :</div>
						<div class="right">在去过的所有地方中，你认为最美最适合拍摄旅行写真人像的是哪？</div>
					</div>
					<div class="da">
						<div class="left">A :</div>
						<div class="right">当然记得(ノ=Д=)ノ┻━┻话都说不利索！</div>
					</div>
				</div>
				<div class="item">
					<div class="wen">
						<div class="left">Q :</div>
						<div class="right">你都去过哪些地方旅行和拍摄呢？</div>
					</div>
					<div class="da">
						<div class="left">A :</div>
						<div class="right">当然记得(ノ=Д=)ノ┻━┻话都说不利索！</div>
					</div>
				</div>
				<div class="item">
					<div class="wen">
						<div class="left">Q :</div>
						<div class="right">除了摄影，还有什么爱好吗？你理想中的生活是什么样子？</div>
					</div>
					<div class="da">
						<div class="left">A :</div>
						<div class="right">当然记得(ノ=Д=)ノ┻━┻话都说不利索！</div>
					</div>
				</div>
			</div>
			<div class="works">
				<h2>个人作品</h2>
				<div class="border"><!--此div只用于显示border--></div>
				<div class="works-group">
					<img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/article_info/works1.jpg" alt="">
					<img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/article_info/works2.jpg" alt="">
				</div>
			</div>
		</div>
	</div>


		
<!-- light7 -->
<!--<script src="http://kllife.com/source/Static/phone/common/js/light7.js"></script>-->
<!-- i18n 中文 -->
<script src="http://kllife.com/source/Static/phone/common/js/cn.js"></script>
<!--公用JS文件-->
<script src="http://kllife.com/source/Static/common/js/functions.js"></script>
<script>
    //点击添加弹出添加标签div
    $(".add").on("click",function(){
        $(".absolute").show();
    });
    //点击右上角关闭按钮关闭标签列表
    $(".remove-impress").on("click",function(){
        $(".absolute").hide();
    });
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
                    <p>写真旅行</p>
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
                        threshold : 0
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