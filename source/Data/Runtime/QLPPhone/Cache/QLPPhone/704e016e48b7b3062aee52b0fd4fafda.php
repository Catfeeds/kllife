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
<link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/css/content.css">
<style type="text/css">
	.active { background: #ff1c77; border-color: #ff1c77;}
	.content .travel .may-apply div .active p{color: #fff; }
/*	.content .travel .may-apply div .active .color {color: #3BB412; }*/
</style>
<div class="phone index content">
	<div class="top">
		<div class="recommend">
			<h2><?php echo ($line["title"]); ?></h2>
			<p><?php echo ($line["subheading"]); ?></p>
			<div>
				<span class="price">¥<span class="number"><?php echo ($line["start_price_adult"]); ?></span><span class="yuan">元起</span></span>
				<span class="place">出发地：<?php echo ($line["assembly_point_show_text"]); ?></span>
			</div>
		</div>
	</div>
    <!-出行日期->
    <div class="travel">
        <div class="data"><span class="see">查看出行日期</span> <span style="float: right;margin-top:-5px;"><i id="down" class="iconfont">&#xe632;</i></span></div>
        <div class="may-apply">
        	<?php if(is_array($line["batchs"])): $i = 0; $__LIST__ = $line["batchs"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bv): $mod = ($i % 2 );++$i;?><div class="batch-container">
	                <div class="batch-item" data-id="<?php echo ($bv['id']); ?>">
	                    <p class="color" data-id="<?php echo ($bv['id']); ?>"><?php echo ($bv['start_date_show']); ?></p>
	                    <p>[<?php echo ($bv['state_data']['type_desc']); ?>]</p>
	                </div>
	            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="detail">
        	<?php if(is_array($line["phone_points"])): $i = 0; $__LIST__ = $line["phone_points"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$point): $mod = ($i % 2 );++$i; if($point["image_url"] != ''): ?><img class="img-responsive" src="<?php echo ($point["image_url"]); ?>" alt=""><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <!-行程说明->
    <div class="line explain">
        <h2>行程说明</h2>
        <div class="border-bottom"><!-此div只用于显示birder-></div>
		<?php if(is_array($line["travels"])): $i = 0; $__LIST__ = $line["travels"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$travel): $mod = ($i % 2 );++$i;?><div class="item">
        		<?php if(empty($travel['img1']) == false): ?><img class="img-responsive" src="<?php echo ($travel['img1']); ?>" alt="">
        		<?php elseif(empty($travel['img2']) == false): ?>
	            	<img class="img-responsive" src="<?php echo ($travel['img2']); ?>" alt="">
        		<?php elseif(empty($travel['img3']) == false): ?>
	            	<img class="img-responsive" src="<?php echo ($travel['img3']); ?>" alt=""><?php endif; ?>
	            <?php if($key == 0): ?><div>
	            <?php else: ?>
            	<div class="background-color"><?php endif; ?>
	                <h4>Day<?php echo ($travel["day_id"]); ?>：<?php echo ($travel["title"]); ?></h4>
					<?php if(!empty($travel["view_point"])): ?><div class="div">> 浏览重点：<?php echo ($travel["view_point"]); ?></div><?php endif; ?>
	                <p><?php echo ($travel["intro"]); ?></p>
	                <?php if(!empty($travel["hotel"])): ?><div class="div">> 住宿：<?php echo ($travel["hotel"]); ?></div><?php endif; ?>
					<?php if(!empty($travel["eat_way"])): ?><div class="div">> 餐饮：<?php echo ($travel["eat_way"]); ?></div><?php endif; ?>
	                <p>> 温馨提示：<?php echo ($travel["kindly_reminder"]); ?></p>
	            </div>
	        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <!-费用说明->
    <div class="line reserve">
        <h2>预定须知</h2>
        <div class="border-bottom"><!-此div只用于显示birder-></div>
        <div class="item">
            <h4><span>|</span>费用说明</h4>
        	<div><?php echo ($line["cost_description"]); ?></div>
        </div>
    </div>
    <!-预定须知->
    <div class="line reserve reserve-two">
        <div class="item">
            <h4><span>|</span>预订须知</h4>
			<div><?php echo ($line["booking_notes"]); ?></div>
        </div>
    </div>
    <!-沿途风光->
    <div class="line reserve reserve-two scenery">
        <div class="item">
            <h4><span>|</span>沿途风光</h4>
        </div>
		<?php if(is_array($scenery)): $i = 0; $__LIST__ = $scenery;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sc): $mod = ($i % 2 );++$i;?><div class="scenery-two">
	            <img class="img-responsive" src="<?php echo ($sc["image"]); ?>" alt="">
	            <div><?php echo ($sc["text"]); ?></div>
	        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    
    <!--footer-->
    <div class="footer-two" style="z-index:99999999">
        <a href="javascript:;"><div class="div"><img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/content/zx2.jpg" alt=""></div></a>
        <a href="javascript:;"><div class="reserve-btn book_order_now">立即预定</div></a>
    </div>
</div>
<script type="text/javascript" src="http://kllife.com/source/Static/qinglvpai/js/vmc.slider.full.min.js"></script>
<script>

    //点击展开出行日期
    $("#down").on("click",function(){
        if($(".may-apply").is(":hidden")){
            $(".may-apply").slideDown(700);
            $(this).addClass("rotate").removeClass("rotate1");
        }else{
            $(".may-apply").slideUp(700);
            $(this).removeClass("rotate").addClass("rotate1")
        }
    })

	// 选择定日期
	$('.batch-container').click(function(){
		$(this).parent().find('.batch-item').removeClass('active');
		$(this).find('.batch-item').addClass('active');
		var batchId = $(this).find('.batch-item').attr('data-id');
		location.href = '<?php echo U("line/order");?>/id/<?php echo ($line["id"]); ?>/type/create/b/'+batchId+'/m/0/w/0/ch/0';
	});

	// 立即预定
	$('.book_order_now').click(function(){
//		if ($('.may-apply').find('.active').length == 0) {
//			alert('请选择出行的日期');	
//			return false;
//		}			
//		var batchId = $('.may-apply').find('active').attr('data-id');

		location.href = '<?php echo U("line/order");?>/id/<?php echo ($line["id"]); ?>/type/create/b/0/m/0/w/0/ch/0';
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