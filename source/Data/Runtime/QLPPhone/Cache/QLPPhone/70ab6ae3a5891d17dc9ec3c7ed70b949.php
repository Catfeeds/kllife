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
    <!--公司简介-->
    <!--<div class="brief">-->
        <!--<h2>公司简介</h2>-->
        <!--<a href="javascript:;"><img class="img-responsive" src="<?php echo ($set["company_background"]); ?>" alt=""></a>-->
        <!--<p><?php echo ($set["company_intro"]); ?></p>-->
    <!--</div>-->
    <!--新旅拍-->
	<!--品牌故事-->
	<div class="background-two" onclick="location.href='<?php echo U('index/story');?>'">
		<img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/index/phone+.jpg" alt="">
	</div>
    <!--每刻美 初体验-->
    <div class="line travel" style="margin-top:10px;">
        <h2 style="color:#ff1c77;padding-bottom:20px;">每刻美 初体验</h2>
		<p style="text-align: center;font-size: 20px;">拼个摄影师去旅行</p>
		<!--<p style="text-align: center;font-size: 20px;">精选热卖</p>-->
        <div class="border-bottom"><!-此div只用于显示birder-></div>
        <?php if(is_array($set)): $i = 0; $__LIST__ = $set;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$travel_tab): $mod = ($i % 2 );++$i; if(stripos($key, 'travel_tab') === 0 and stripos($key, '_line_') === false): $__FOR_START_1367616022__=0;$__FOR_END_1367616022__=4;for($i=$__FOR_START_1367616022__;$i < $__FOR_END_1367616022__;$i+=1){ $line = $set[$key.'_line_'.$i]; if (!empty($line)) { $lineBackground = $line['img2']; } ?>
					<a href="<?php echo U('line/info');?>/id/<?php echo ($line["id"]); ?>">
						<div class="item">
							<img class="img-responsive" src="<?php echo ($lineBackground); ?>" alt="">
							<div class="background">
								<h3><?php echo ($line["title"]); ?></h3>
								<p><?php echo ($line["subheading"]); ?></p>
								<span>Time：<?php echo ($line["start_time"]); ?></span>
								<a type="button" class="btn btn-orange-two" href="<?php echo U('line/info');?>/id/<?php echo ($line["id"]); ?>">查看线路</a>
							</div>
						</div>
					</a><?php } endif; endforeach; endif; else: echo "" ;endif; ?>
        <a href="<?php echo U('line/list');?>"><h4 class="whole">查看全部每刻美初体验线路 <span><i class="iconfont">&#xe624;</i></span></h4></a>
    </div>
    <!--每刻美 定制款-->
    <div class="line travel index-customized" style="margin-top:10px;">
        <h2 style="color:#ff1c77;padding-bottom:20px;">每刻美 定制款</h2>
		<p style="text-align: center;font-size: 20px;">你的每一刻美好都值得珍藏</p>
        <div class="border-bottom" style="width:245px;"><!-此div只用于显示birder-></div>
		<a href="javascript:;">
			<div class="item">
				<img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/index/index-customized.jpg" alt="">
				<div class="background">
					<p class="color">满足你的需求</p>
					<h3>随时随地给你拍最美旅行照</h3>
					<p>无需做攻略，旅行琐事统统帮你搞定</p>
					<p>玩你想玩的，专属于你的旅行计划</p>
					<p>不拼团，私家小团独享完美旅程</p>
					<p>随心预约，选你喜欢的摄影师</p>
					<p>每刻美</p>
					<p>让你的每张旅行照，都因惊艳时光而得以珍藏</p>
					<a type="button" class="btn btn-orange-two" href="javascript:;">定制我的旅行</a>
				</div>
				<a href="<?php echo U('line/book');?>" class="href-customized"></a>
			</div>
		</a>
    </div>
	<!--摄影师-->
	<div class="line index-photographer" style="margin-top: 10px;">
		<h2 style="padding-bottom:12px;">摄影师</h2>
		<div class="border-bottom" style="width:72px;"><!-此div只用于显示birder-></div>
		<div class="group">
			<?php if(is_array($leaders)): $i = 0; $__LIST__ = $leaders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$leader): $mod = ($i % 2 );++$i;?><div class="item">
					<div class="img"><img src="<?php echo ($leader["face_image"]); ?>" alt=""></div>
					<div class="name"><?php echo ($leader["show_name"]); ?></div>
					<a href="<?php echo U('Leader/info');?>/id/<?php echo ($leader["id"]); ?>"></a>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<a href="<?php echo U('Leader/list');?>"><h4 class="whole" style="line-height:2">查看全部摄影师 <span><i class="iconfont">&#xe624;</i></span></h4></a>
	</div>
	<!--小团慢旅行-->
    <div class="line" style="margin-top: 10px;">
        <h2 style="padding-bottom:12px;">小团慢旅行</h2>
		<div class="border-bottom" style="width:120px;"><!-此div只用于显示birder-></div>
        <!-- Swiper -->
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php $__FOR_START_532000290__=0;$__FOR_END_532000290__=5;for($k=$__FOR_START_532000290__;$k < $__FOR_END_532000290__;$k+=1){ $line = $set['slowly_line_'.$k]; ?>
					<a href="<?php echo U('line/content');?>/id/<?php echo ($line["id"]); ?>">
						<div class="swiper-slide travel_tab_line"  style="width:100%">
							<img class="img-responsive" src="<?php echo ($line["img1"]); ?>" alt="">
							<div class="background">
								<h3><?php echo ($line["title"]); ?></h3>
								<p><?php echo ($line["subheading"]); ?></p>
								<span>Time：<?php echo ($line["start_time"]); ?></span>
								<a type="button" class="btn btn-orange-two" href="<?php echo U('line/content');?>/id/<?php echo ($line["id"]); ?>">查看线路</a>
								<div style="background: #fff;height:50px;"></div>
							</div>
						</div>
					</a><?php } ?>
			</div>
			<!-- Add Pagination -->
			<div class="swiper-pagination"></div>
		</div>
        <a href="<?php echo U('line/slowly');?>"><h4 class="whole">查看全部小团慢旅行 <span><i class="iconfont">&#xe624;</i></span></h4></a>
    </div>
    <!--写真作品-->
    <!--<div class="works">-->
        <!--<div style="background:#efeff4;width:100%;height:.8rem;"><!-此div只用于显示灰色背景条-></div>-->
        <!--<a href="<?php echo U('article/list');?>"><img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/index/works-one.jpg" alt=""></a>-->
        <!--<?php $__FOR_START_108559368__=0;$__FOR_END_108559368__=6;for($i=$__FOR_START_108559368__;$i < $__FOR_END_108559368__;$i+=1){ ?>-->
        	<!--<?php $art = $set['travel_article_'.$i]; ?>-->
	        <!--<a href="<?php echo U('article/info');?>/id/<?php echo ($art["id"]); ?>">-->
	            <!--<div class="works-one">-->
	                <!--<img class="img-responsive" src="<?php echo ($art["face_image"]); ?>" alt="">-->
	                <!--<div class="mask">-->
	                    <!--<h3><?php echo ($art["title"]); ?></h3>-->
	                    <!--<h4>发布时间：<?php echo ($art["create_time"]); ?></h4>-->
	                <!--</div>-->
	            <!--</div>-->
	        <!--</a>-->
        <!--<?php } ?>-->
        <!--<div style="background:#efeff4;width:100%;height:.8rem;"><!-此div只用于显示灰色背景条-></div>-->
    <!--</div>-->
    
    <!-线路回顾->
    <!--<div class="line review">-->
        <!--<h2>线路回顾</h2>-->
        <!--&lt;!&ndash;<p class="tit">用拍照见证瞬间的永恒用拍照见证瞬间的永恒</p>&ndash;&gt;-->
        <!--<div class="border-bottom"><!-此div只用于显示birder-></div>-->
	    <!--<?php $__FOR_START_1851784804__=0;$__FOR_END_1851784804__=3;for($i=$__FOR_START_1851784804__;$i < $__FOR_END_1851784804__;$i+=1){ ?>-->
	        <!--<?php $art = $set['travel_review_article_'.$i]; ?>-->
	        <!--<a href="<?php echo U('line/article');?>/id/<?php echo ($art["id"]); ?>">-->
	        <!--<div class="item">-->
	            <!--<img class="img-responsive" src="<?php echo ($art["face_image"]); ?>" alt="">-->
	            <!--<h4><?php echo ($art["short_title"]); ?></h4>-->
	        <!--</div>-->
	        <!--</a>-->
		<!--<?php } ?>-->
        <!--<a href="<?php echo U('line/article');?>"><h4 class="whole">查看全部新旅拍线路 <span><i class="iconfont">&#xe624;</i></span></h4></a>-->
    <!--</div>-->

<script type="text/javascript" src="http://kllife.com/source/Static/qlpphone/js/swiper-3.4.1.jquery.min.js"></script>
<script type="text/javascript">
	$('body').css('background', '#f2f4f5');	
	
	// 切换标签页
	function changeTab() {
		clearTravelLines();
		var activeObj = $('.place-name').find('a.active');
		if ($(activeObj).length == 0) {
			toastr.warning('没有选定旅拍产品的标签');
			return false;
		}
		
		var tabset = $(activeObj).attr('data-set');
		$('.travel_tab_line').each(function(i,obj){
			$(this).find('.tab_set_image').attr('data-set', tabset+'_line_image_'+i);
		});
		
		var findKeyValue = $(activeObj).attr('data-set')+'%';
		$.post('<?php echo U("line/find");?>', {op_type: 'find_config', key: findKeyValue, op:'LIKE'}, function(data){
			if (data.ds != null && data.ds != 'undefined') {
				var idx = 0;
				for (x in data.ds) {
					if (x.indexOf('travel_tab_') == 0 && x.indexOf('_line_') != -1 && x.indexOf('_line_image_') == -1) {						
						var d = data.ds[x];
						var rootObj = $('.swiper-wrapper').find('.swiper-slide[data-swiper-slide-index="'+idx+'"]');	
						$(rootObj).find('h3').html(d.title);
						$(rootObj).find('p').html(d.subheading);
						var infoUrl = '<?php echo U("line/infon");?>/id/'+d.id;
						$(rootObj).find('.tab_set_line').attr('href', infoUrl);	
						var imgKey = $(rootObj).find('img').attr('data-set');
						$.ajax({
							url: '<?php echo U("line/find");?>',
							async: false,
							type: 'POST',
							dataType: 'json',
							data: {op_type: 'find_config', key:imgKey},
							success : function(imgData){
								if (imgData.ds == null || imgData.ds == 'undefined') {
									$(rootObj).find('img').attr('src', d.img1);
								} else {
									$(rootObj).find('img').attr('src', imgData.ds[imgKey]);
								}
							}
						});
						idx ++;
					}
				}
			}		
			if (data.result != null && data.result != 'undefined') {
				toastr.error(data.result.errno);
			}	
		});
	}

	function selectTag(ev) {
		ev.preventDefault();
		$(this).closest('.place-name').find('a').removeClass('active');
		$(this).addClass('active');
		changeTab();
	}
	
	function clearTravelLines() {
		$('.swiper-wrapper').find('.travel_tab_line').each(function(){
			$(this).find('.tab_set_image').attr('data-set', '');
			$(this).find('.tab_set_image').attr('src', '');
			$(this).find('h3').html('');
			$(this).find('p').html('');
			$(this).find('span').html('');
		});
	}

	// 标签的选择
	$('.place-name').find('a.set_tab').click(selectTag);
	    
    //swiper
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        slidesPerView: 1,
        paginationClickable: true,
        autoplay: 3000,
        loop: true
    });
    
    //慢旅行
    $(".place-name .btn").on("click",function(){
        $(this).addClass("active").siblings(".btn").removeClass("active");
    })

    //内容到可视区域显示遮罩层
    $(document).ready(function(){
        $(window).bind("scroll", function(event){
            $(".works-one").each(function(){
                var fold = $(window).height() + $(window).scrollTop();
                if( fold <= $(this).offset().top){
                    $(this).trigger("appear");
                }
            });
        });

        $(".works-one").each(function(){
            if( $(window).height() > $(this).offset().top){
                $(this).find(".mask").fadeOut();
            }
            $(this).one("appear",function(){
                $(this).find(".mask").fadeIn()
            });
        });
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