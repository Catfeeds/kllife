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
<link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/css/index.css">
<link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/css/list.css">
<style>
	.travel a{text-decoration: none;}
	.list .travel .item:nth-child(5){border-top:none;}
	.line-list {margin-top: 3rem;}
</style>
<!-旅拍线路->
<div class="phone index list">
	<div class="travel">
		<h2>每刻美 初体验</h2>
		<div class="line-list">
			<?php if(is_array($lines)): $i = 0; $__LIST__ = $lines;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$line): $mod = ($i % 2 );++$i;?><a href="<?php echo U('line/info');?>/id/<?php echo ($line["id"]); ?>">
					<div class="item">
						<h3><?php echo ($line["title"]); ?></h3>
						<h4>- 每刻美 初体验 -</h4>
						<img class="img img-responsive" src="<?php echo ($line["img1"]); ?>" alt="">
						<p class="detail"><?php echo ($line["subheading"]); ?></p>
						<?php if(empty($line['check_price'])): ?><p class="price"><span>核算中</span></p>
						<?php else: ?>
						<p class="price">¥<span><?php echo ($line["start_price_adult"]); ?></span>元起</p><?php endif; ?>
						<a type="button" class="btn btn-orange-two" href="<?php echo U('line/info');?>/id/<?php echo ($line["id"]); ?>">查看线路</a>
					</div>
				</a><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<!-更多内容->
		<div class="more" data-more="1" data-page-index="0">更多线路</div>
	</div>
</div>
<script>    
    //更换目的地
    $(".place-name").on("click",function(){
        if($(".place-name-more").is(":hidden")==true){
            $(".place-name-more").slideDown(700);
            $(this).find(".span").addClass("rotate").removeClass("rotate1");
        }else{
            $(".place-name-more").slideUp(700)
            $(this).find(".span").removeClass("rotate").addClass("rotate1")
        }
    })
    
    $(".place-name-more li").on("click",function(){
        var html=$(this).html();
        $(".place-name .name").html(html);
        $(".place-name").find(".span").removeClass("rotate").addClass("rotate1");
		$('.more').attr('data-page-index', -1);
		$('.more').attr('data-more','1');
		$('.more').html('更多线路');
		$('.line-list').children().remove();
        findMore();
    })
    
    // 刷新列表
    function findMore() {
    	if ($('.more').attr('data-more') != '1') {
			$('.more').attr('data-more','0');
			$('.more').html('没有更多的数据了');
    		return false;
    	}
		var pageIndex = parseInt($('.more').attr('data-page-index'))+1;
		var jsonData = {
			op_type: 'list',
			page: pageIndex,
			slowly: 0,
		};
		
		var dest = $('.place-name').find('span.name').html();
		if (dest != '全部') {
			jsonData['cds'] = 'destination|LIKE|%'+dest+'%';
		}
		
		$.post('<?php echo U("line/list");?>', jsonData, function(data){
			if (data.result.errno == 0) {
				if (data.ds != null && data.ds != 'undefined') {
					for (var i=0; i < data.ds.length; i++) {
						var d = data.ds[i];
						var linePrice = '¥ <span>核算中</span>元起';
						if (d.check_price == 1) {
							linePrice = '¥<span>'+d.start_price_adult+'</span>元起';
						}
						var vhtml = '<a href="'+'<?php echo U("line/info");?>/id/'+d.id+'">'+
									'<div class="item">'+
								    '    <h3>'+d.title+'</h3>'+
								    '    <h4>— 新旅拍 —</h4>'+
								    '    <img class="img img-responsive" src="'+d.img1+'" alt="">'+
								    '    <p class="detail">'+d.subheading+'</p>'+
								    '    <p class="price">'+linePrice+'</p>'+
								    '    <a type="button" class="btn btn-orange-two" href="'+'<?php echo U("line/info");?>/id/'+d.id+'">查看线路</a>'+
								    '</div>'+
								    '</a>';
						$('.line-list').append(vhtml);
						$('.more').attr('data-page-index', pageIndex);
					}
					if (data.ds.length < data.page_size || pageIndex >= data.page_count) {
						$('.more').attr('data-more','0');
						$('.more').html('没有更多的数据了');
					}
				} else {
					$('.more').attr('data-more','0');
					$('.more').html('没有更多的数据了');
				}
			} else {
				$('.more').html(data.result.message);
			}
		});
    }
    	
	$('.more').click(findMore);
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