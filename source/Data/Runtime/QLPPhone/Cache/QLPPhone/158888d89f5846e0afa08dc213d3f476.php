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
                if (vurl.indexOf('xiezhenlvxing') != -1) {
                    var vhref = vurl.replace(/m.xiezhenlvxing/g,'xiezhenlvxing').replace(/qlpphone/g,'qinglvpai');
                    window.location.href = vhref;
                } else {
                    var vhref = vurl.replace(/m.xinlvpai/g,'xinlvpai').replace(/qlpphone/g,'qinglvpai');
                    window.location.href = vhref;
                }
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
	                <a href="<?php echo U('line/article');?>"><li>新旅拍作品</li></a>
	                <!--<a href="<?php echo U('line/artile');?>"><li>线路回顾</li></a>-->
	            </ul>
	        </div>
	    </div>
	<!--私有样式-->
	<link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/css/article_list.css">

	<div class="page" style="position: absolute;top:60px;padding-bottom:50px;">
		<div class="content">
			<div class="banner"><img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/article_list/banner.jpg" alt=""></div>
			<div class="group">
				<div class="item">
					<img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/article_list/article_list1.jpg" alt="">
					<p>张三</p>
					<a href="<?php echo U('line/article_info');?>"></a>
				</div>
				<div class="item">
					<img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/article_list/article_list2.jpg" alt="">
					<p>李四</p>
					<a href="<?php echo U('line/article_info');?>"></a>
				</div>
				<div class="item">
					<img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/article_list/article_list3.jpg" alt="">
					<p>王五</p>
					<a href="<?php echo U('line/article_info');?>"></a>
				</div>
				<div class="item">
					<img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/article_list/article_list4.jpg" alt="">
					<p>赵六</p>
					<a href="<?php echo U('line/article_info');?>"></a>
				</div>
				<div class="item">
					<img class="img-responsive" src="http://kllife.com/source/Static/qlpphone/images/article_list/article_list5.jpg" alt="">
					<p>刘七</p>
					<a href="<?php echo U('line/article_info');?>"></a>
				</div>
			</div>
			<div class="add">查看更多摄影师</div>
		</div>
	</div>
	
<script>
	// 无限加载
	var loading = false;
	// 最多可加载的条目
	var maxItems = parseInt('<?php echo ($page_count); ?>');

	// 上次加载的序号
	var thisPageIndex = 0;

	function addItems(pageIndex) {
		if (parseInt(pageIndex) == parseInt(maxItems)) {		
			$('.load-more').html('没有更多的数据...');
			return false;
		}
		console.log('page:'+pageIndex+',max:'+maxItems);
						
		var jsonData = {
			op_type: 'list',
			page: pageIndex,
		}
		$.post('<?php echo U("line/article");?>', jsonData, function(data){
			if (data.result.errno == 0) {
				if (typeof(data.ds) != 'undefined' && data.ds != null) {				
					var nowLiCount = $('li').length;		
					for (var i=0; i<data.ds.length; i++) {
						var thisLiIndex = nowLiCount + i;
						var liClass = thisLiIndex % 2 == 0 ? 'li0' : 'li1';												
						var d = data.ds[i];
						var include_image = typeof(d.face_image)=='undefined' ? false : true;
						
						var html = '<div class="active-review-sublist">';
							html +='	<div class="card demo-card-header-pic">';
							html +='		<div class="card-content">';
							html +='			<img src="'+d.face_image+'" alt="">';
							html +='			<div class="card-content-inner">';
							html +='				<p>'+d.title+'</p>';
							html +='			</div>';
							html +='			<a href="'+'<?php echo U("line/article");?>/id/'+d.id+'" external></a>';
							html +='		</div>';
							html +='	</div>';
							html +='</div>';
						// 添加新条目
						$('.infinite-scroll-bottom').append(html);
					}
					// 下拉次数累加
					thisPageIndex += 1;					
					if (data.ds.length < data.page_size || thisPageIndex >= data.page_count) {
						$('.load-more').html('没有更多的数据...');
					}
				} else {
					$('.load-more').html('没有更多的数据...');
				}
			} else {
				console.log(data.result.message);
			}
		});

		// 生成新条目的HTML

	}

	//预先加载
	addItems(thisPageIndex);

	//鼠标滚动到下方在加载二十条
    $(document).scroll(function(){
        var bheight = $(document).height();//获取窗口高度
        var sheight = $("body")[0].scrollHeight;//获取滚动条高度，[0]是为了把jq对象转化为js对象
        var stop = $("body").scrollTop();//滚动条距离顶部的距离
        if(stop>=sheight-bheight){
            addItems(thisPageIndex);
        }
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
            <a href="<?php echo U('article/list');?>">
                <div class="selected">
                    <i class="iconfont">&#xe60f;</i>
                    <p>写真作品</p>
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