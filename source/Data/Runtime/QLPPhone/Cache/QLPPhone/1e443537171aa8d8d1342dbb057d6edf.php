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
                var vhref = vurl.replace(/m\./g, '').replace(/qlpphone/g,'qinglvpai');
               	window.location.href = vhref;
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
	<link rel="stylesheet" href="http://kllife.com/source/Static/phone/css/order_center.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/common/css/animate.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/common/css/top2.css">
	<style>
		.content{width:100%;margin-bottom:60px;}
		.buttons-tab{position: fixed;top:60px;}
		.order-list{top:2.8rem;}
		.buttons-tab .button.active{color:#ff1c77;border-color:#ff1c77;}
		.order-sublist p > span > strong,.order-sublist-money p span{color:#ff1c77;}
		.order-sublist-handle a{background: #ff1c77;border-color:#ff1c77;}
	</style>
		<div class="header">
    <div class="menu animated bounceInLeft">
        <!--<i class="iconfont">&#xe603;</i>-->
    </div>
    <div class="logo"><a href="javascript:;"><img style="width:155px;" class="animated bounceInDown" src="http://kllife.com/source/Static/qlpphone/common/images/logo-qinglvpai.png" alt=""></a></div>
    <div class="search animated bounceInRight">
        <!--<i class="iconfont">&#xe67a;</i>-->
    </div>
    <div class="search-block">
        <div class="input-group" style="text-align: center">
            <input type="text" class="form-control" placeholder="特惠线路...">
            <span class="input-group-btn">
                        <button class="btn btn-orange-one" type="button">搜索</button>
                    </span>
        </div>
    </div>
    <div class="top">
        <div class="menu-block">
            <ul>
                <a href="<?php echo U('index/welcome');?>" external><li>首页</li></a>
                <a href="javascript:;" external><li>品牌故事</li></a>
                <a href="<?php echo U('line/list');?>" external><li>新旅拍</li></a>
                <a href="http://kllife.com/phone/index.php?s=/phone/line/list" external><li>小团慢旅行</li></a>
                <a href="<?php echo U('Leader/list');?>" external><li>摄影师</li></a>
                <!--<a href="<?php echo U('line/artile');?>" external><li>线路回顾</li></a>-->
            </ul>
        </div>
    </div>
</div>
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
			<p>写真旅行</p>
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
		<div class="content infinite-scroll" data-distance="100">
			<div class="buttons-tab">
				<?php if($state == 'all'): ?><a href="#tab1" class="tab-link button active" data-page-index='1' data-page-end='0'>全部</a>
				<?php else: ?>
					<a href="#tab1" class="tab-link button" data-page-index='0' data-page-end='0'>全部</a><?php endif; ?>
				<?php if($state == 'review'): ?><a href="#tab2" class="tab-link button active" data-page-index='1' data-page-end='0'>待付款</a>
				<?php else: ?>
					<a href="#tab2" class="tab-link button" data-page-index='0' data-page-end='0'>待付款</a><?php endif; ?>
				<?php if($state == 'pay_part'): ?><a href="#tab3" class="tab-link button active" data-page-index='1' data-page-end='0'>已付部分款</a>
				<?php else: ?>
					<a href="#tab3" class="tab-link button" data-page-index='0' data-page-end='0'>已付部分款</a><?php endif; ?>
				<?php if($state == 'pay_complate'): ?><a href="#tab4" class="tab-link button active" data-page-index='1' data-page-end='0'>已付全款</a>
				<?php else: ?>
					<a href="#tab4" class="tab-link button" data-page-index='0' data-page-end='0'>已付全款</a><?php endif; ?>
				<?php if($state == 'complated'): ?><a href="#tab5" class="tab-link button active" data-page-index='1' data-page-end='0'>待评价</a>
				<?php else: ?>
					<a href="#tab5" class="tab-link button" data-page-index='0' data-page-end='0'>待评价</a><?php endif; ?>
			</div>
			<div class="order-list infinite-scroll" data-distance="100">
				<div class="tabs">
					<!-- 全部 -->
					<div id="tab1" class="tab active">
						<?php if(is_array($all_orders)): $i = 0; $__LIST__ = $all_orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><div class="order-sublist">
								<div class="card-footer">
									<a href="#" class="link">
										<img src="http://kllife.com/source/Static/qlpphone/images/create/sublist_logo.png" alt="">订单号：<?php echo ($order["order_sn"]); ?>
									</a>
							    </div>
							    <div class="content-padded">
							    	<div class="content-padded">
							    		<h5><?php echo ($order["lineid_title"]); ?></h5>
							    		<p><?php echo ($order["hdid_show_text"]); ?></p>
							    		<p>
							    			<span>订单状态：<strong><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></strong></span>
											<?php if(empty($order[agreenment])): ?><span>&nbsp;&nbsp;&nbsp;&nbsp;合同状态：<strong>未生效</strong></span>
											<?php else: ?>
												<span>&nbsp;&nbsp;&nbsp;&nbsp;合同状态：<strong>已生效</strong></span>
												<!--<p><a href="http://kllife.comfpdf/domo/pdf.php?did=<?php echo ($order["id"]); ?>" target="_blank">下载</a></p>--><?php endif; ?>
							    		</p>
							    	</div>
							    </div>
							    <div class="order-sublist-handle-content">
							    	<div class="content-padded">
							    		<div class="order-sublist-money">
							    			<p>金额：<span>￥<?php echo ($order["need_pay_money"]); ?>元</span></p>
							    		</div>
							    		<div class="order-sublist-handle">
							    			<?php if($order['operate'] == pay): ?><a href="<?php echo U('line/order');?>/type/pay/id/<?php echo ($order["id"]); ?>" external>在线支付</a>
							    			<?php elseif($order['operate'] == 'wait_review'): ?>
												<span>等待审核</span>
											<?php elseif($order['operate'] == 'team_end'): ?>											
												<span>团期已结束</span>
											<?php else: ?>
												<span>按时参团</span><?php endif; ?>
							    			<a href="<?php echo U('line/order');?>/type/info/id/<?php echo ($order["id"]); ?>" external>订单详情</a>
							    		</div>
							    	</div>
							    </div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<!-- end 全部订单-->
					
					<!-- 待付款 -->
					<div id="tab2" class="tab">
						<?php if(is_array($review_orders)): $i = 0; $__LIST__ = $review_orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><div class="order-sublist">
								<div class="card-footer">
									<a href="#" class="link">
										<img src="http://kllife.com/source/Static/qlpphone/images/create/sublist_logo.png" alt="">订单号：<?php echo ($order["order_sn"]); ?>
									</a>
							    </div>
							    <div class="content-padded">
							    	<div class="content-padded">
							    		<h5><?php echo ($order["lineid_title"]); ?></h5>
							    		<p><?php echo ($order["hdid_show_text"]); ?></p>
							    		<p>
							    			<span>订单状态：<strong><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></strong></span>
											<?php if(empty($order[agreenment])): ?><span>&nbsp;&nbsp;&nbsp;&nbsp;合同状态：<strong>未生效</strong></span>
											<?php else: ?>
												<span>&nbsp;&nbsp;&nbsp;&nbsp;合同状态：<strong>已生效</strong></span>
												<!--<p><a href="http://kllife.comfpdf/domo/pdf.php?did=<?php echo ($order["id"]); ?>" target="_blank">下载</a></p>--><?php endif; ?>
							    		</p>
							    	</div>
							    </div>
							    <div class="order-sublist-handle-content">
							    	<div class="content-padded">
							    		<div class="order-sublist-money">
							    			<p>金额：<span>￥<?php echo ($order["need_pay_money"]); ?>元</span></p>
							    		</div>
							    		<div class="order-sublist-handle">
							    			<?php if($order['operate'] == pay): ?><a href="<?php echo U('line/order');?>/type/pay/id/<?php echo ($order["id"]); ?>" external>在线支付</a>
							    			<?php elseif($order['operate'] == 'wait_review'): ?>
												<span>等待审核</span>
											<?php elseif($order['operate'] == 'team_end'): ?>											
												<span>团期已结束</span>
											<?php else: ?>
												<span>按时参团</span><?php endif; ?>
							    			</if>
							    			<a href="<?php echo U('line/order');?>/type/info/id/<?php echo ($order["id"]); ?>" external>订单详情</a>
							    		</div>
							    	</div>
							    </div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					
					
					<!-- 预付部分款 -->
					<div id="tab3" class="tab">						
						<?php if(is_array($pay_part_orders)): $i = 0; $__LIST__ = $pay_part_orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><div class="order-sublist">
								<div class="card-footer">
									<a href="#" class="link">
										<img src="http://kllife.com/source/Static/qlpphone/images/create/sublist_logo.png" alt="">订单号：<?php echo ($order["order_sn"]); ?>
									</a>
							    </div>
							    <div class="content-padded">
							    	<div class="content-padded">
							    		<h5><?php echo ($order["lineid_title"]); ?></h5>
							    		<p><?php echo ($order["hdid_show_text"]); ?></p>
							    		<p>
							    			<span>订单状态：<strong><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></strong></span>
											<?php if(empty($order[agreenment])): ?><span>&nbsp;&nbsp;&nbsp;&nbsp;合同状态：<strong>未生效</strong></span>
											<?php else: ?>
												<span>&nbsp;&nbsp;&nbsp;&nbsp;合同状态：<strong>已生效</strong></span>
												<!--<p><a href="http://kllife.comfpdf/domo/pdf.php?did=<?php echo ($order["id"]); ?>" target="_blank">下载</a></p>--><?php endif; ?>
							    		</p>
							    	</div>
							    </div>
							    <div class="order-sublist-handle-content">
							    	<div class="content-padded">
							    		<div class="order-sublist-money">
							    			<p>金额：<span>￥<?php echo ($order["need_pay_money"]); ?>元</span></p>
							    		</div>
							    		<div class="order-sublist-handle">
							    			<?php if($order['operate'] == pay): ?><a href="<?php echo U('line/order');?>/type/pay/id/<?php echo ($order["id"]); ?>" external>在线支付</a>
							    			<?php elseif($order['operate'] == 'wait_review'): ?>
												<span>等待审核</span>
											<?php elseif($order['operate'] == 'team_end'): ?>											
												<span>团期已结束</span>
											<?php else: ?>
												<span>按时参团</span><?php endif; ?>
							    			</if>
							    			<a href="<?php echo U('line/order');?>/type/info/id/<?php echo ($order["id"]); ?>" external>订单详情</a>
							    		</div>
							    	</div>
							    </div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<!-- 已付全款 -->
					<div id="tab4" class="tab">					
						<?php if(is_array($pay_complate_orders)): $i = 0; $__LIST__ = $pay_complate_orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><div class="order-sublist">
								<div class="card-footer">
									<a href="#" class="link">
										<img src="http://kllife.com/source/Static/qlpphone/images/create/sublist_logo.png" alt="">订单号：<?php echo ($order["order_sn"]); ?>
									</a>
							    </div>
							    <div class="content-padded">
							    	<div class="content-padded">
							    		<h5><?php echo ($order["lineid_title"]); ?></h5>
							    		<p><?php echo ($order["hdid_show_text"]); ?></p>
							    		<p>
							    			<span>订单状态：<strong><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></strong></span>
											<?php if(empty($order[agreenment])): ?><span>&nbsp;&nbsp;&nbsp;&nbsp;合同状态：<strong>未生效</strong></span>
											<?php else: ?>
												<span>&nbsp;&nbsp;&nbsp;&nbsp;合同状态：<strong>已生效</strong></span>
												<!--<p><a href="http://kllife.comfpdf/domo/pdf.php?did=<?php echo ($order["id"]); ?>" target="_blank">下载</a></p>--><?php endif; ?>
							    		</p>
							    	</div>
							    </div>
							    <div class="order-sublist-handle-content">
							    	<div class="content-padded">
							    		<div class="order-sublist-money">
							    			<p>金额：<span>￥<?php echo ($order["need_pay_money"]); ?>元</span></p>
							    		</div>
							    		<div class="order-sublist-handle">
							    			<?php if($order['operate'] == pay): ?><a href="<?php echo U('line/order');?>/type/pay/id/<?php echo ($order["id"]); ?>" external>在线支付</a>
							    			<?php elseif($order['operate'] == 'wait_review'): ?>
												<span>等待审核</span>
											<?php elseif($order['operate'] == 'team_end'): ?>											
												<span>团期已结束</span>
											<?php else: ?>
												<span>按时参团</span><?php endif; ?>
							    			</if>
							    			<a href="<?php echo U('line/order');?>/type/info/id/<?php echo ($order["id"]); ?>" external>订单详情</a>
							    		</div>
							    	</div>
							    </div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					
					
					<!-- 待评价 -->
					<div id="tab5" class="tab">					
						<?php if(is_array($comment_orders)): $i = 0; $__LIST__ = $comment_orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><div class="order-sublist">
								<div class="card-footer">
									<a href="#" class="link">
										<img src="http://kllife.com/source/Static/qlpphone/images/create/sublist_logo.png" alt="">订单号：<?php echo ($order["order_sn"]); ?>
									</a>
							    </div>
							    <div class="content-padded">
							    	<div class="content-padded">
							    		<h5><?php echo ($order["lineid_title"]); ?></h5>
							    		<p><?php echo ($order["hdid_show_text"]); ?></p>
							    		<p>
							    			<span>订单状态：<strong><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></strong></span>
											<?php if(empty($order[agreenment])): ?><span>&nbsp;&nbsp;&nbsp;&nbsp;合同状态：<strong>未生效</strong></span>
											<?php else: ?>
												<span>&nbsp;&nbsp;&nbsp;&nbsp;合同状态：<strong>已生效</strong></span>
												<!--<p><a href="http://kllife.comfpdf/domo/pdf.php?did=<?php echo ($order["id"]); ?>" target="_blank">下载</a></p>--><?php endif; ?>
							    		</p>
							    	</div>
							    </div>
							    <div class="order-sublist-handle-content">
							    	<div class="content-padded">
							    		<div class="order-sublist-money">
							    			<p>金额：<span>￥<?php echo ($order["need_pay_money"]); ?>元</span></p>
							    		</div>
							    		<div class="order-sublist-handle">
							    			<?php if($order['operate'] == pay): ?><a href="<?php echo U('line/order');?>/type/pay/id/<?php echo ($order["id"]); ?>" external>在线支付</a>
							    			<?php elseif($order['operate'] == 'wait_review'): ?>
												<span>等待审核</span>
											<?php elseif($order['operate'] == 'team_end'): ?>											
												<span>团期已结束</span>
											<?php else: ?>
												<span>按时参团</span><?php endif; ?>
							    			</if>
							    			<a href="<?php echo U('line/order');?>/type/info/id/<?php echo ($order["id"]); ?>" external>订单详情</a>
							    		</div>
							    	</div>
							    </div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					
		          <!-- 加载提示符 -->
		          <!--<div class="infinite-scroll-preloader">
		              <div class="preloader"></div>
		          </div>-->					
				</div>
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

<script>
	$( function(){
		$.init();
		//点击标签内容回到顶部
		$('.buttons-tab a').click( 
			function () {
				$('.content').stop().animate({'scrollTop': '0'},100);
				_ajaxOrderList(this);
			}
		 );
	} );
	
	var loading = false;	// 是否在加载中	
	var noMoreData = false;
	// 加载订单
	function _ajaxOrderList(obj) {
		var stateMap = {
			"#tab1": 'all',
			"#tab2": 'review',
			"#tab3": 'pay_part',
			"#tab4": 'pay_complate',
			"#tab5": 'complated',
		}
		
		var tab = $(obj).attr('href');
		var p = parseInt($(obj).attr('data-page-index'));
		var end = parseInt($(obj).attr('data-page-end'));
		// 没有更多可加载的
		if (end == 1) {
			noMoreData = false;
			return false;
		}
		var jsonData = {
			op_type: 'list',
			page: p,
			state: stateMap[tab],
		}
		
		//loading = true;
		$.post('<?php echo U("line/order");?>', jsonData, function(data){
			//loading = false;
			$(tab).find('tbody').empty();
			var newPageCount = 1;
			if (data.result.errno == 0) {	
				if (data.ds == null || data.ds == 'undefined') {
					$(obj).attr('data-page-index', p+1);
					$(obj).attr('data-page-end', 1);
					noMoreData = true;					
					if ($(tab).find('.no-more-data').length == 0) {
						var vhtml = '<div class="order-sublist no-more-data">'+'没有更多数据'+'</div>';
						$(tab).append(vhtml);	
					} else {
						$(tab).find('.no-more-data').html('没有更多数据');
					}
				} else {	
					$(obj).attr('data-page-index', p+1);
					var hostUrl = 'http://kllife.com';
					for(var i=0; i < data.ds.length; i++) {
						var d = data.ds[i];
						var vhtml = '<div class="order-sublist">'+
									'	<div class="card-footer">'+
									'		<a href="#" class="link">'+
									'			<img src="http://kllife.com/source/Static/qlpphone/images/create/sublist_logo.png" alt="">订单号：'+d.order_sn+
									'		</a>'+
									'		<a href="#" class="link">取消订单</a>'+
									'    </div>'+
									'    <div class="content-padded">'+
									'   	<div class="content-padded">'+
									'    		<h5>'+d.lineid_title+'</h5>'+
									'    		<p>'+d.hdid_show_text+'</p>'+
									'    		<p>';
									'    			<span>订单状态：<strong>'+d.zhuangtai_data.type_desc+'</strong></span>';
						if (d.agreenment) {
							vhtml += '				<span>&nbsp;&nbsp;&nbsp;&nbsp;合同状态：<strong>已生效</strong></span>';
//							vhtml += '				<p><a href="'+hostUrl+'fpdf/domo/pdf.php?did='+d.id+'" target="_blank">下载</a></p>';
						} else {
							vhtml += '				<span>&nbsp;&nbsp;&nbsp;&nbsp;合同状态：<strong>未生效</strong></span>';
						}
							vhtml +='    		</p>'+
									'    	</div>'+
									'    </div>'+
									'    <div class="order-sublist-handle-content">'+
									'    	<div class="content-padded">'+
									'    		<div class="order-sublist-money">'+
									'    			<p>金额：<span>￥'+d.need_pay_money+'元</span></p>'+
									'    		</div>'+
									'    		<div class="order-sublist-handle">';
						if (d.operate == 'pay') {
							vhtml +='				<a class="online-pay-small" href="'+'<?php echo U("line/order");?>'+'/id/'+d.id+'/type/pay" external>在线支付</a>';
						} else if (d.operate == 'wait_review') {
							vhtml +='				<span>等待审核</span>';
						} else if (d.operate == 'team_end') {
							vhtml +='				<span>团期已结束</span>';
						} else {
							vhtml +='				<span>按时参团</span>';	
						}
							vhtml +='    			<a href="<?php echo U("line/order");?>/type/info/id/'+d.id+'" external>订单详情</a>'+
									'    		</div>'+
									'    	</div>'+
									'    </div>'+
									'</div>';				
						$(tab).append(vhtml);
					}					
				}
			} else {
				if ($(tab).find('.no-more-data').length == 0) {
					var vhtml = '<div class="order-sublist no-more-data">'+data.result.message+'</div>';
					$(tab).append(vhtml);	
				} else {
					$(tab).find('.no-more-data').html(data.result.message);
				}
			}
		});
	}
		
	// 注册'infinite'事件处理函数
	$(document).on('infinite', '.infinite-scroll',function() {
		
		// 如果正在加载，则退出
		if (loading) return;

		// 设置flag
		loading = true;
		
		// 模拟1s的加载过程
		setTimeout(function() {
			// 重置加载flag
			loading = false;
			
			if (noMoreData == true) {
				// 加载完毕，则注销无限加载事件，以防不必要的加载
				$.detachInfiniteScroll($('.infinite-scroll'));
				// 删除加载提示符
				$('.infinite-scroll-preloader').remove();
				return;
			}
			
			_ajaxOrderList($('.buttons-tab').find('a.active'));
			// 容器发生改变,如果是js滚动，需要刷新滚动
			$.refreshScroller();			
		}, 1000);
	});	
</script>
</body>
</html>