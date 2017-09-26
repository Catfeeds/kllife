<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php if(empty($PageKeyword) == false): ?><meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
	<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
	<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
	<title><?php echo ($PageKeyword["title"]); ?></title>
	<?php else: ?>
	<title><?php echo C('PAGE_TITLE');?></title><?php endif; ?>    
	<!-- 引用jq -->
	<script src="http://kllife.com/source/Static/home/common/js/jquery-1.11.3.min.js"></script>
	
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/animate.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/style/style.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/style.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/iconfont.css">
	<!-- css Reset -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/cssreset.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/common.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/common/css/common.css">
    <!--图标-->
    <link type="image/x-icon" rel="shortcut icon" href="http://kllife.com/source/Static/qinglvpai/common/images/favicon.ico" />
    <style>
        .top-ask{position: fixed;right:50px;bottom:100px;display: none;z-index:1000;}
        .top-ask div{margin:2px 0px;cursor: pointer;}
        .top-ask div img{width:50px;height:50px;}
    </style>
</head>
<body>
<!--header-->
<div class="header">
    <?php if(C('MENU_CURRENT') === 'index_welcome'): ?><a href="<?php echo U('index/story');?>" target="_blank"><div class="banner" style="background-image: url(<?php echo ($set["banner"]); ?>);"></div></a>
   	<?php elseif(C('MENU_CURRENT') === 'line_list'): ?>
        <div class="banner" style="background-image: url(<?php echo ($set["content_banner"]); ?>);"></div>
    <?php elseif(C('MENU_CURRENT') === 'line_content'): ?>
        <div class="banner-content" style="background-image: url(<?php echo ($set["qinglvpai_content_banner"]); ?>);"></div>
   	<?php elseif(C('MENU_CURRENT') === 'line_main_list'): ?>
        <div class="banner" style="background-image: url(<?php echo ($set["xiaomantuan_banner"]); ?>);"></div>
    <?php elseif(C('MENU_CURRENT') === 'line_main_content'): ?>
        <div class="banner-content" style="background-image: url(<?php echo ($set["xiaomantuan_content_banner"]); ?>);"></div>
    <?php elseif(C('MENU_CURRENT') === 'book_line' or C('MENU_CURRENT') === 'line_pay_result' or C('MENU_CURRENT') === 'index_story' or stripos(C('MENU_CURRENT'),'leader_list') !== FALSE): ?>
    <?php else: ?>
        <div class="banner-content" style="background-image: url(<?php echo ($set["qinglvpai_content_banner"]); ?>);"></div><?php endif; ?>
    <div class="div-two">
        <div class="list">
            <a href="<?php echo U('Index/welcome');?>" target="_blank"><img class="logo-white" src="http://kllife.com/source/Static/qinglvpai/images/index/logo-qinglvpai.png" alt=""></a>
            <ul>
                <a class="active" href="<?php echo U('index/welcome');?>" target="_blank">首页</a>
                <a href="<?php echo U('index/story');?>" target="_blank">品牌故事</a>
                <a href="<?php echo U('line/list');?>" target="_blank">跟拍游</a>
                <a href="<?php echo U('line/slowly');?>" target="_blank">小团慢旅行</a>
                <a href="<?php echo U('Leader/list');?>" target="_blank">摄影师</a>
                <!--<a href="javascript:;">客户回顾</a>-->
            </ul>
            <div class="tel">
                <img src="http://kllife.com/source/Static/qinglvpai/images/index/tel-img.png" alt="">
                <img src="http://kllife.com/source/Static/qinglvpai/images/index/tel-number.png" alt="">
                <!--<em><?php echo ($pcset["askfor_tel"]); ?></em>-->
            </div>
            <div class="tel login" style="line-height:80px;color:#fff;font-size: 14px;width:170px;text-align: center;text-align: -webkit-center">
				<?php if(empty($user) == true): ?><a href="<?php echo U('user/login');?>" target="_blank">登录</a> |
					<a href="<?php echo U('user/register');?>" target="_blank">注册</a>
				<?php else: ?>
					<a href="<?php echo U('line/order');?>/type/center" target="_blank">我的订单</a> |
					<a href="<?php echo U('user/exit');?>">退出</a><?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!--返回顶部，咨询-->
<div class="top-ask">
    <div onclick="openZoosUrl('chatwin');"><img src="http://kllife.com/source/Static/qinglvpai/common/images/ask1.jpg" alt=""></div>
    <div class="return-top"><img src="http://kllife.com/source/Static/qinglvpai/common/images/return-top.jpg" alt=""></div>
</div>
<script type="text/javascript">	
	// 导航划过变色
	$('.list ul a').mouseenter(function(){
		$(this).toggleClass('active');
	});
	$('.list ul a').mouseleave(function(){
		$(this).toggleClass('active');
	});

	// 登录我的订单点击选中
    $(".login a").on("click",function(){
        $(this).addClass("active").siblings("a").removeClass("active");
    })
    
    //屏幕滚动显示一键返回顶部按钮
    $(window).scroll( function (){
        if ($(this).scrollTop() > 150) {
            $('.top-ask').fadeIn();
        }else{
            $('.top-ask').fadeOut();
        };
    });

    //点击返回顶部
    $(".return-top").click(
        function(){
            $("html,body").animate({scrollTop: 0}, 1000);
        }
    );

</script>
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/swiper.3.1.7.min.css">
	<!-- <link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/datepicker.min.css"> -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/css/private_book.css">
	<style>
		
		#section { margin-top: 80px; }
/*		.nav-top a { font: 12px/1 微软雅黑, Tahoma, Helvetica, Arial, 宋体, sans-serif; }*/
		.tianxiexinxi input { font: 12px/1 微软雅黑, Tahoma, Helvetica, Arial, 宋体, sans-serif; }
		#aside { background: none; }
		.btn-warning,.btn-warning:hover,.btn-warning.active,.btn-warning.focus,.btn-warning:focus{background: #ff1c77;}
		.mytrip{color:#ff1c77;border-color:#ff1c77;}
		.modal-large-right p{padding-top:0px;}
		.modal-large-left .tijiao,.modal-large-left .tijiao:hover{background: #ff1c77;}
		.mytrip:hover{background: #ff1c77;border-color:#ff1c77;}
		.footer-content-left ul li,.footer-bottom-content span{font-size: 12px;}
		.tianxiexinxi input{margin:7px 0px;}
		.small-tianxie{line-height:25px;}
	</style>
	
	
	<!-- 主体 -->
	<section id="section">
		<!-- 轮播 -->
		<div class="swiper-container">
	        <div class="swiper-wrapper">
	            <div class="swiper-slide"><img src="http://kllife.com/source/Static/qinglvpai/images/book/banner01.jpg" alt="轮播"></div>
	        </div>
	        <!-- 定位按钮 -->
	        <!--<div class="swiper-pagination"></div>-->
	        <!-- 左右控制 -->
	        <!--<div class="swiper-button-next"></div>-->
	        <!--<div class="swiper-button-prev"></div>-->
	    </div>
	    <!-- 定制信息 -->
	    <div class="gerenxinxi">
	    	<div class="tianxiexinxi">
	    		<img src="http://kllife.com/source/Static/qinglvpai/images/book/dingzhi.png" alt="定制我的专属旅程">
	    		<p class="first-p">想玩的景点</p>
	    		<input type="text" class="jingdian" placeholder="请输入您想玩的景点 例如：婺源">
	    		<p>出行人数</p>
                <input type="text" class="renshu" placeholder="出行人数">
	    		<p>联系人</p>
	    		<input type="text" class="lianxiren" placeholder="您的称呼">
	    		<p>联系方式</p>
	    		<input type="text" class="lianxifangshi" placeholder="您的座机或手机号码">
	    		<p style="display: none; color: #e03905; font-size: 14px;">*请输入正确的联系方式</p>
	    		<a href="javascript:;" target="_parent" class="btn-warning xuqiu">您的需求</a>
	    	</div>
	    </div>
	    <!--<div class="wenzixinxi">-->
	    	<!--<h1>每刻美定制游</h1>-->
	    	<!--<h1>玩你想玩，玩的精彩</h1>-->
	    	<!--<p>24h接机/站，1对1旅行顾问，金牌领队，全程跟拍</p>-->
	    	<!--<p>我们拥有11年户外旅游经验及5年的中高端旅游运营经验，</p>-->
	    	<!--<p>是旅游线路革新的标杆机构。</p>-->
	    <!--</div>-->
	    <!-- 主体内容 -->
	    <div class="neirong">
	    	<div class="neirong01">
	    		<p><img src="http://kllife.com/source/Static/home/images/private_book/big-wenzi01.png" alt=""></p>
	    		<img src="http://kllife.com/source/Static/qinglvpai/images/book/wenzi01.png" alt="超乎想象的精彩旅行">
	    		<p>旅游像赶集，游览像赶鸭，老人小孩跟不上趟？</p>
	    		<p>时间不自由，行程不随心，还有各种旅游陷阱隐形消费？</p>
	    		<p>攻略查到吐，临时开销大，旅途聊无趣味还附赠各种冤枉钱？</p>
	    		<p>放心，你所担心的我们都懂！</p>
	    		<a class="mytrip dingzhiall" href="javascript:void(0);" target="_parent">定制我的旅行</a>
	    	</div>
	    	<div class="neirong02">
	    		<div class="neirong02-left">
	    			<a href="javascript:;">
	    				<img src="http://kllife.com/source/Static/home/images/private_book/xizang.jpg" alt="西藏">
	    				<img src="http://kllife.com/source/Static/home/images/private_book/xizangwenzi.png" class="xizangwenzi" alt="西藏">
	    			</a>
	    		</div>
	    		<div class="neirong02-right">
	    			<div class="neirong02-right-top">
	    				<a href="javascript:;">
	    					<img src="http://kllife.com/source/Static/home/images/private_book/yunnan.jpg" alt="云南">
	    					<img class="yunnanwenzi" <img src="http://kllife.com/source/Static/home/images/private_book/yunnanwenzi.png" alt="云南">
	    				</a>
	    				<a href="javascript:;">
		    				<img class="xinjiang" <img src="http://kllife.com/source/Static/home/images/private_book/xinjiang.jpg" alt="新疆">
		    				<img class="xinjiangwenzi" <img src="http://kllife.com/source/Static/home/images/private_book/xinjiangwenzi.png" alt="新疆">
		    			</a>
	    			</div>
	    			<div class="neirong02-right-bottom">
	    				<a href="javascript:;">
		    				<img src="http://kllife.com/source/Static/home/images/private_book/sichuan.jpg" alt="四川">
		    				<img class="sichuanwenzi" <img src="http://kllife.com/source/Static/home/images/private_book/sichuanwenzi.png" alt="四川">
		    			</a>
	    			</div>
	    		</div>
	    	</div>
	    </div>
	    <div class="neirong-bottom">
	    	<div class="neirong-bottom01">
	    		<img src="http://kllife.com/source/Static/home/images/private_book/banner_bottom.jpg" alt="">
	    		<div class="neirong-bottom-main">
	    			<p><img src="http://kllife.com/source/Static/home/images/private_book/big-wenzi02.png" alt=""></p>
		    		<img src="http://kllife.com/source/Static/home/images/private_book/wenzi02.png" alt="你想要的旅行其实无比简单">
		    		<p>一旦开始定制，你就相当于拥有了一群专业旅行策划服务团队。</p>
		    		<p>我们的旅行顾问和线路规划师将完全按照你的想法、兴趣以及需求，为您设计专属旅行线路。</p>
		    		<p>价格透明，无隐形消费，你想要的我们都能满足！</p>
	    		</div>
	    		<a class="mytrip mytrip01 dingzhiall" href="javascript:void(0);" target="_parent">定制我的旅行</a>
	    	</div>
	    	<div class="neirong-bottom02">
	    		<p><img src="http://kllife.com/source/Static/home/images/private_book/big-wenzi03.png" alt=""></p>
	    		<img src="http://kllife.com/source/Static/qinglvpai/images/book/wenzi03.png" alt="给您一次无与伦比的精彩旅行">
	    		<ul>
	    			<li>
	    				<img src="http://kllife.com/source/Static/qinglvpai/images/book/1bu.png" alt="">
	    				<h1>1.[提交需求]</h1>
	    				<p>收到您提交的定制需求后，</p>
	    				<p>每刻美的旅行顾问将主动与您联系，</p>
	    				<p>就我们需要了解的问题与您进一步沟通。</p>
	    			</li>
	    			<li>
	    				<img src="http://kllife.com/source/Static/qinglvpai/images/book/2bu.png" alt="">
	    				<h1>2 .[设计方案]</h1>
	    				<p>我们将根据需求，为您量身定</p>
	    				<p>制旅行方案和报价，对于部分复杂</p>
	    				<p>需求，报价将在旅行方案确认后提供。</p>
	    			</li>
	    			<li>
	    				<img src="http://kllife.com/source/Static/qinglvpai/images/book/3bu.png" alt="">
	    				<h1>3. [确认预订]</h1>
	    				<p>旅行方案和报价确认后，</p>
	    				<p>我们将为您预留旅行资源库存，</p>
	    				<p>并与您签署旅游合同，收取旅行费用。</p>
	    			</li>
	    			<li>
	    				<img src="http://kllife.com/source/Static/qinglvpai/images/book/4bu.png" alt="">
	    				<h1>4. [尊贵出行]</h1>
						<p>每刻美的专业团队将全程为</p>
						<p>您提供全方位服务，您只管享受精</p>
						<p>彩旅程，剩下的麻烦事儿都交给我们。</p>
	    			</li>
	    		</ul>
	    	</div>
	    	<div class="neirong-bottom03">
	    		<img src="http://kllife.com/source/Static/home/images/private_book/wenzi04.png" alt="">
	    		<h1>每刻美定制游</h1>
	    		<p>世界这么大，只要你告诉我想去哪，剩下的都交给我们！</p>
	    		<a class="mytrip dingzhiall" href="javascript:void(0);" target="_parent">定制我的旅行</a>
	    	</div>
	    </div>
	</section>

	<!-- 遮罩层 -->
	<div class="mark"></div>
	<!-- Modal small-->
	<div class="modal-small">
		<div class="my-small-modal">
			<img src="http://kllife.com/source/Static/qinglvpai/common/images/smallmodal.png" alt="模态框图">
			<img class="small-close" <img src="http://kllife.com/source/Static/home/images/private_book/close.svg" alt="关闭模态框">
			<div class="small-ziliao">
				<img src="http://kllife.com/source/Static/home/images/private_book/smallmodal01.png" alt="模态框图">
				<div class="small-tianxie">
					<i>*</i><span>想玩的景点</span><input type="text" class="small-jingdian" placeholder="请输入您想玩的景点，例如：婺源"><br>
					<i>*</i><span>出 行 人 数</span><input type="text" class="small-renshu" placeholder="1"><br>
					<i>*</i><span>联 系 人</span><input type="text" class="small-lianxiren" placeholder="请输入您的姓名"><br>
					<i>*</i><span>联 系 方 式</span><input type="text" class="small-lianxifangshi" placeholder="请输入您的座机或手机号码">
					<p style="display: none; color: #e03905; font-size: 14px; margin-bottom: -15px;">*请输入正确的联系方式</p>
				</div>
				<a href="javascript:;" class="btn-warning small-dingzhi" target="_parent">立即定制</a>
			</div>
		</div>
	</div>
	<!-- Modal large -->
	<div class="modal-large">
		<div class="modal-large-left">
			<img class="large-close" <img src="http://kllife.com/source/Static/home/images/private_book/close.svg" alt="关闭模态框">
			<h2>其他需求</h2>
			<div class="modal-large-left-container">
				<i>*</i><span>出 行 日 期</span><input type="text" class="large-riqi"><br>
				<i>*</i><span>游 玩 天 数</span><input type="text" class="large-tianshu" placeholder="游玩天数"><br>
				<i class="bai">*</i><span>住 宿 条 件</span><select class="large-zhusu">
					<?php if(is_array($hotel_request)): $i = 0; $__LIST__ = $hotel_request;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hr): $mod = ($i % 2 );++$i;?><option value="<?php echo ($hr["id"]); ?>"><?php echo ($hr["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select><br>
				<i class="bai">*</i><span>领 队 需 求</span><select class="large-lingdui">	
					<?php if(is_array($leader_request)): $i = 0; $__LIST__ = $leader_request;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lr): $mod = ($i % 2 );++$i;?><option value="<?php echo ($lr["id"]); ?>"><?php echo ($lr["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>				
				</select><br>
				<!-- <i class="bai">*</i><span>车 辆 需 求</span><select class="large-cheliang">					
				</select><br> -->
				<i class="bai">*</i><span>特 色 服 务</span><select class="large-tese">	
					<?php if(is_array($especial_request)): $i = 0; $__LIST__ = $especial_request;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$er): $mod = ($i % 2 );++$i;?><option value="<?php echo ($er["id"]); ?>"><?php echo ($er["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>				
				</select><br>
				<i>*</i><span>联 系 时 间</span><select class="large-shijian">
					<?php if(is_array($contact_time)): $i = 0; $__LIST__ = $contact_time;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ct): $mod = ($i % 2 );++$i;?><option value="<?php echo ($ct["id"]); ?>"><?php echo ($ct["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select><br>
				<i class="bai">*</i><span>其它联系方式</span><input type="text" class="large-lianxifangshi" placeholder="QQ/微信/邮箱"><br>
				<i class="bai">*</i><span class="special">其它需求/特别说明</span><br>
				<textarea name="" id="special" class="large-more" placeholder="其他需要帮助安排的事宜"></textarea>
			</div>
			<a class="chongtian" href="javascript:void(0);">重新填写订单</a>
			<a class="tijiao" href="javascript:void(0);" target="_parent">提交完整需求</a>
			<p style="display: none; color: #e03905; font-size: 14px; margin-bottom: -10px; margin-left: 45px;">* 请将您的信息填写完整</p>
		</div>
		<div class="modal-large-right">
			<h2>我的需求单</h2>
			<span>想玩的景点</span><p class="large-right-jingdian"></p><br>
			<span>出行人数</span><p class="large-right-renshu"></p><br>
			<span>联系人</span><p class="large-right-lianxiren"></p><br>
			<span>联系方式</span><p class="large-right-lianxifangshi"></p><br>
			<span>出行日期</span><p class="large-right-riqi"></p><br>
			<span>游玩天数</span><p class="large-right-tianshu"></p><br>
			<span>住宿条件</span><p class="large-right-zhusu"></p><br>
			<span>领队需求</span><p class="large-right-lingdui"></p><br>
			<!-- <span>车辆需求</span><p class="large-right-cheliang"></p><br> -->
			<span>特色服务</span><p class="large-right-tese"></p><br>
			<span>联系时间</span><p class="large-right-shijian"></p><br>
			<span>其它联系方式</span><p class="large-right-qitalianxifangshi"></p><br>
			<span>其他需求</span><textarea name="" id="" class="large-right-more" rows="5"></textarea>
		</div>
	</div>
	<!-- 提交成功 -->
	<div class="success">
		<img class="success-close" <img src="http://kllife.com/source/Static/home/images/private_book/close.svg" alt="关闭模态框">
		<h2>提交成功</h2>
		<img src="http://kllife.com/source/Static/home/images/private_book/icon_success.png" alt="提交成功">
		<p>领袖的旅行顾问将尽快与您取得联系,</p>
		<p>您也可直接拨打 400-080-5860 查询预订进展</p>
	</div>

	
	<script src="http://kllife.com/source/Static/home/common/js/swiper.3.1.7.jquery.min.js"></script>
	<!-- <script src="http://kllife.com/source/Static/home/common/js/datepicker.min.js"></script> -->
	<!-- <script src="http://kllife.com/source/Static/home/common/js/datepicker.en.js"></script> -->
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
	<script>
		//轮播
	    var swiper = new Swiper('.swiper-container', {
	        pagination: '.swiper-pagination',
	        nextButton: '.swiper-button-next',
	        prevButton: '.swiper-button-prev',
	        paginationClickable: true,
	        spaceBetween: 0,
	        centeredSlides: true,
	        autoplay: 3000,
	        autoplayDisableOnInteraction: false
	    });
    </script>
    <script>
    	// 图片渐显
    	function showAndHide (e){
    		e.hover(function(){
    			$(this).children('img:eq(1)').fadeIn(1000);
    		},
    		function(){
    			$(this).children('img:eq(1)').fadeOut(1000);
    		});
    	}
    	showAndHide($('.neirong02-left a'));
    	showAndHide($('.neirong02-right-top a:eq(0)'));
    	showAndHide($('.neirong02-right-top a:eq(1)'));
    	showAndHide($('.neirong02-right-bottom a'));
    	
    	//提交成功 关闭
    	$('.success-close').click(function(){
    		$('.success').fadeOut(1000);
    		$('.mark').fadeOut(1000);
    	});

    	//二维码和电话显示
    	$('.aside-phone').hover(function(){
    		$(this).children('.aside-show').show();
    	},function(){
    		$(this).children('.aside-show').hide();
    	});
    	$('.aside-weixin').hover(function(){
    		$(this).children('.aside-show').show();
    	},function(){
    		$(this).children('.aside-show').hide();
    	});

    	//回到顶部
    	function upShow(){
    		$(window).scroll(function(){
				if ($(window).scrollTop()>300){
					$(".aside-up").fadeIn(500);
				}else{
					$(".aside-up").fadeOut(500);
				}
			});
    	}
    	upShow();
    	$('.aside-up').click(function(){
    		var speed=200;//滑动的速度
        	$('body,html').animate({ scrollTop: 0 }, speed);
        	return false;
    	});
    </script>
    <script>
    	var isMobile = /^(?:13\d|15\d|18\d|17\d|14\d)\d{5}(\d{3}|\*{3})$/; //手机号码验证规则
        var isPhone = /^((0\d{2,3})-)?(\d{8})(-(\d{3,}))?$/;   //座机验证规则
		$(".lianxifangshi").on("blur", function () {
			var dianhua = $.trim($(".lianxifangshi").val());
			if (!isMobile.test(dianhua) && !isPhone.test(dianhua)) { //如果用户输入的值不同时满足手机号和座机号的正则
				$(this).next("p").show();
			} else {
				$(this).next("p").hide();
			}
		});
		$(".small-lianxifangshi").on("blur", function () {
			var dianhua = $.trim($(".small-lianxifangshi").val());
			if (!isMobile.test(dianhua) && !isPhone.test(dianhua)) { //如果用户输入的值不同时满足手机号和座机号的正则
				$(this).next("p").show();
				return false;
			} else {
				$(this).next("p").hide();
			}
		});


    	//打开按钮
    	$('.dingzhiall').click(function(){
    		$('.my-small-modal').animate({top: '50%'},1000);
    		$('.mark').fadeIn('fast');
    	});
    	//关闭按钮
    	$('.small-close').click(function(){
    		$('.my-small-modal').animate({top: '-300%'},1000);
    		$('.my-small-modal input').val('');
    		$('.mark').fadeOut(1000);
    		$('.small-dingzhi').next('span').remove();
    		$('.small-lianxifangshi').next('p').remove();
    	});
    	$('.large-close').click(function(){
    		$('.modal-large').animate({top: '-300%'},1000);
    		$('.mark').fadeOut(1000);
    		clearAllData();
    		$('.tijiao').next('p').hide();
    	});

    	// 模态框
		//通过nav打开大模态框
		$(function(){
			$('.small-dingzhi').click(function(){
    			var dianhua01 = $.trim($(".small-lianxifangshi").val());
    			if( $.trim($('.small-jingdian').val()) == '' || $.trim($('.small-renshu').val()) == '' || $.trim($('.small-renshu').val()) < 1 || $.trim($('.small-lianxiren').val()) =='' || $.trim($('.small-lianxifangshi').val()) == '' && (!isMobile.test(dianhua01) || !isPhone.test(dianhua01)) ){
    				$('.small-dingzhi').next('span').remove();
    				$('.small-dingzhi').after('<span style="color:#ff1c77;">*请填写完整的正确信息</span>');
    				return false;
    			}
    			var ds = {
    				destination: $('.small-jingdian').val(),
    				member_count: $('.small-renshu').val(),
    				linkman: $('.small-lianxiren').val(),
    				tel: $('.small-lianxifangshi').val(),
    			}
	    		commitData(ds, 'small-');
	    		
//				$('.small-tianxie').next('span').remove();
//				$('.my-small-modal').animate({top: '-300%'},1000);
//				$('.modal-large').animate({top: '50%'},1000);
//				$('.large-right-jingdian').html($('.small-jingdian').val());	//景点名称
//				$('.large-right-renshu').html($('.small-renshu').val());	//人数
//				$('.large-right-lianxiren').html($('.small-lianxiren').val());	//联系人
//				$('.large-right-lianxifangshi').html($('.small-lianxifangshi').val());	//联系方式
//				$('.my-small-modal input').val('');    			
    		});
		})
		//通过需求打开大模态框
		$('.xuqiu').click(function(){
			var dianhua02 = $.trim($(".lianxifangshi").val());
				//判断如果填的值为空
				if ($.trim($('.jingdian').val()) == '' || $.trim($('.lianxiren').val()) == '' || $.trim($('.renshu').val()) == '' || $.trim($('.renshu').val()) < 1 || $.trim($('.lianxifangshi').val()) == '' || (!isMobile.test(dianhua02) && !isPhone.test(dianhua02)) ) {
				$('.xuqiu').next('span').remove();
				$('.xuqiu').after('<span class="error" style="color:#ff1c77;">*请将信息填写完整</span>');
				return false;
			} else {
//				$('.xuqiu').next('span').remove();
//				$('.mark').fadeIn('fast');
//				$('.modal-large').animate({top: '50%'},1000);
//				$('.large-right-jingdian').html($('.jingdian').val());	//景点名称
//				$('.large-right-renshu').html($('.renshu').val());	//人数
//				$('.large-right-lianxiren').html($('.lianxiren').val());	//联系人
//				$('.large-right-lianxifangshi').html($('.lianxifangshi').val());	//联系方式	
//				$('.jingdian').val('');
//				$('.renshu').val('');
//				$('.lianxiren').val('');
//				$('.lianxifangshi').val('');
				
    			var ds = {
    				destination: $('.jingdian').val(),
    				member_count: $('.renshu').val(),
    				linkman: $('.lianxiren').val(),
    				tel: $('.lianxifangshi').val(),
    			}
    			commitData(ds, '');
			}
		});
    		
    	//数据变更
    	$(function(){
    		function changeDate(a,b){
    			a.blur(function(){
    				b.html($(this).val());
    			});
    		};
    		function change(c,d){
    			c.change(function(){
    				d.html($(this).val());
    			});
    		};
    		function changeData(e,f){
    			e.keyup(function(){
    				f.html($(this).val());
    			});
    		};
    		function changeval(g,h){
    			g.change(function(){
    				h.html($(this).find("option:selected").text());
    			});
    		}
    		changeDate($('.large-riqi'),$('.large-right-riqi'));	//日期
    		change($('.large-tianshu'),$('.large-right-tianshu'));  //游玩天数
    		changeval($('.large-zhusu'),$('.large-right-zhusu'));		//住宿条件
    		changeval($('.large-lingdui'),$('.large-right-lingdui'));	//领队需求
    		changeval($('.large-shijian'),$('.large-right-shijian'));	//联系时间
    		// changeval($('.large-cheliang'),$('.large-right-cheliang'));
    		changeval($('.large-tese'),$('.large-right-tese'));
    		changeData($('.large-lianxifangshi'),$('.large-right-qitalianxifangshi'));	//其它联系方式
    		changeData($('.large-more'),$('.large-right-more'));	//其它需求
    	})
		
    	//大模态框数据重置
    	function clearAllData(){
    		$('.large-riqi').val('');
    		$('.large-tianshu').val('');
    		$('.large-lianxifangshi').val('');
    		$('.large-more').val('');
    		$('.large-right-riqi').html('');
    		$('.large-right-tianshu').html('');
    		$('.large-right-zhusu').html(''); 
    		$('.large-right-lingdui').html('');
    		// $('.large-right-cheliang').html('');
    		$('.large-right-tese').html('');
    		$('.large-right-shijian').html('');
    		$('.large-right-qitalianxifangshi').html(''); 
    		$('.large-right-more').html('');		
    	};
    	//重置数据
    	$('.chongtian').click(function(){
    		clearAllData();
    		$('.tijiao').next('p').hide();
    	});
    	//提交数据
    	$('.tijiao').click(function(){
    		var jingdian = $('.large-right-jingdian').html(),
    			renshu = $('.large-right-renshu').html(),
    			lianxiren = $('.large-right-lianxiren').html(),
    			lianxifangshi = $('.large-right-lianxifangshi').html(),
    			riqi = $('.large-right-riqi').html(),
    			tianshu = $('.large-right-tianshu').html(),
    			zhusu = $('.large-zhusu').val(),
    			lingdui = $('.large-lingdui').val(),
    			cheliang = $('.large-cheliang').val(),
    			tese = $('.large-tese').val(),
    			shijian = $('.large-shijian').val(),
    			qitalianxifangshi = $('.large-right-qitalianxifangshi').html(),
    			more = $.trim($('.large-right-more').html());
			//如果不填游玩日期和游玩天数
    		if ( riqi == '' || tianshu == ''){
    			$(this).next('p').show();
    			return false;
    		} else {
    			$(this).next('p').hide();
	    		var jsonData = {
	    			destination : jingdian, 
	    			member_count : renshu, 
	    			linkman : lianxiren, 
	    			tel : lianxifangshi, 
	    			car_request : cheliang, 
	    			especial_request : tese, 
	    			start_date : riqi, 
	    			days : tianshu, 
	    			hotel_request : zhusu, 
	    			leader_request : lingdui, 
	    			contact_time : shijian, 
	    			other_contact : qitalianxifangshi,
	    			other_request : more,
	    			from: "client" };
	    		
    		}
    		$.ajax({
				url: "<?php echo U('line/book');?>",
	            type: "post",
	            dataType: 'json',
	            data: jsonData,
	            success: function (data) {
	            	if (data.result.errno == 0){
						//提交成功
						$('.success').fadeIn(1000);
						$('.modal-large').animate({top: '-300%'},1000); //隐去
						clearAllData(); //清除数据
					}else {
						alert(data.result.message);
					}
	            }
	            
    		});
    	})
    	
    	function commitData(ds, prefix) {
    		ds['from_id'] = 'client';
    		$.ajax({
				url: "<?php echo U('line/book');?>",
	            type: "post",
	            dataType: 'json',
	            data: ds,
	            success: function (data) {
	            	if (data.result.errno == 0){
						//提交成功
						$('.success').fadeIn(1000);
	    				$('.'+prefix+'jingdian').val('');
	    				$('.'+prefix+'renshu').val('');
	    				$('.'+prefix+'lianxiren').val('');
	    				$('.'+prefix+'lianxifangshi').val('');
					}else {
						alert(data.result.message);
					}
	            }

    		});
    	}
    </script>
    
    <script>
	var _hmt = _hmt || [];
	(function() {
	  var hm = document.createElement("script");
	  hm.src = "//hm.baidu.com/hm.js?a6f69a2a062b07c67a4ae301e0963ca8";
	  var s = document.getElementsByTagName("script")[0]; 
	  s.parentNode.insertBefore(hm, s);
	})();
	</script>

<style>
	.footer-bottom-content span{margin-right:0px;}
</style>
	<footer>
		<!--<?php echo p_a($question_type);?>-->
		<div class="footer-content">
			<div class="footer-content-left">
				<?php if(is_array($question_type)): $i = 0; $__LIST__ = $question_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$qt): $mod = ($i % 2 );++$i; if ($key === 'config_update_time') { continue; } ?>
					<ul class="<?php echo ($qt["class"]); ?>">
						<li><?php echo ($qt["type_desc"]); ?></li>
						<?php if(is_array($qt["questions"])): $i = 0; $__LIST__ = $qt["questions"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$quest): $mod = ($i % 2 );++$i;?><li><a target="_blank" href="<?php echo U('service/question');?>/id/<?php echo ($quest["id"]); ?>"><?php echo ($quest["content"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<div class="footer-content-right">
				<img src="http://kllife.com/source/Static/qinglvpai/common/images/footer_erweima.png" alt="">
			</div>
		</div>
	</footer>
	<div class="footer-bottom">
		<div class="footer-bottom-content">
			<!--<p>
				友情链接：
				<?php if(is_array($pcset)): $i = 0; $__LIST__ = $pcset;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$set_val): $mod = ($i % 2 );++$i; if(stripos($key, 'pc_friend_link') === 0): if(!empty($fk)): ?>&nbsp;|&nbsp;<?php endif; ?>
						<?php $fk = json_decode($set_val, true); ?>
						<a href="<?php echo ($fk["url"]); ?>" target="_blank"><?php echo ($fk["text"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</p>-->
			<span style="margin-top: 20px;">Copyright  2017 <a href="http://xiezhenlvxing.com" target="_blank" style="color:#fff;">xiezhenlvxing.com</a> | 杭州浪客旅行社有限公司版权所有</span>
			<br>
			<span>旅行社经营许可证号：ZJ30301 浙ICP备17010959号
			<span>
				<!--商务通代码--> 
				<script language="javascript" src="http://pqt.zoosnet.net/JS/LsJS.aspx?siteid=PQT43116159&float=1&lng=cn"></script>
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
			</span>
		</div>
	</div>
	
	<!-- Imported toastr -->
	<script src="http://kllife.com/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="http://kllife.com/source/Static/common/js/functions.js"></script>

	
</body>
</html>