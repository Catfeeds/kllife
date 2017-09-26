<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<!-- iPhone 手机上设置手机号码不被显示为拨号链接 -->
	<meta name="format-detection" content="telephone=no" />
	<meta content="telephone=no, address=no" name="format-detection" />
	<!--  IOS私有属性，可以添加到主屏幕 -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!--  IOS私有属性，网站开启对 web app 程序的支持 -->
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<title>每刻美</title>
	<link rel="stylesheet" href="http://kllife.com/source/Static/phone/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/phone/css/datepicker.min.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/phone/css/phonestyle.css">
	<script src="http://kllife.com/source/Static/phone/common/js/jquery-1.11.3.min.js"></script>
	<script src="http://kllife.com/source/Static/phone/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
      <script src="http://kllife.com/source/Static/phone/js/html5shiv.js"></script>
      <script src="http://kllife.com/source/Static/phone/js/respond.js"></script>
    <![endif]-->
    
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
				window.location.href = 'http://kllife.com/home/index.php?s=/home/line/book';
			}
		}
		browserRedirect();
	</script>
	<style>
		.swiper-mark{background: initial;}
		#header{background:#fff;}
		.btn-warning,btn-warning:hover{background: #ff1c77;}
		.mytrip{color:#ff1c77;border-color:#ff1c77;}
		.mytrip:hover{background: #ff1c77;border-color:#ff1c77;}
		.nav-left a{background:url(http://kllife.com/source/Static/qlpphone/common/images/book-logo.png);background-size: 100% 90%;background-repeat: no-repeat;}
		.swiper-container{background:url(http://kllife.com/source/Static/qlpphone/images/book/phone.jpg);background-size: 100% 100%;}
	</style>
</head>
<body class="page-body">
	<!-- 头部 -->
	<header id="header">
		<nav id="nav">
			<div class="nav-left">
				<a href="<?php echo U('index/welcome');?>"></a>
			</div>
			<div class="nav-right">
				<a class="btn-warning dingzhi dingzhiall" href="<?php echo U('line/private_book1');?>">立即定制</a>
			</div>
		</nav>
	</header>

	<!-- 主体 -->
	<section id="section">
		<!-- 大图 -->
		<div class="swiper-container">
			<div class="swiper-mark"></div>
		</div>

	    <!-- 定制信息 -->
	    <div class="gerenxinxi" style="display: none;">
	    	<div class="tianxiexinxi">
	    		<img src="http://kllife.com/source/Static/phone/images/dzzt/dingzhi.png" alt="定制我的专属旅程">
	    		<p class="first-p">想玩的景点</p>
	    		<input type="text" class="jingdian" placeholder="请输入您想玩的景点 例如：婺源">
	    		<p>出行人数</p>
	    		<select name="renshu" id="">
	    			<option value="1">1</option>
	    			<option value="2">2</option>
	    			<option value="3">3</option>
	    			<option value="4">4</option>
	    			<option value="5">5</option>
	    		</select>
	    		<p>联系人</p>
	    		<input type="text" class="lianxiren" placeholder="您的称呼">
	    		<p>联系方式</p>
	    		<input type="text" class="lianxifangshi" placeholder="您的座机或手机号码">
	    		<p style="display: none; color: #e03905; font-size: 14px;">*请输入正确的联系方式</p>
	    		<a href="javascript:void(0);" class="btn-warning xuqiu">您的需求</a>
	    	</div>
	    </div>
	    <div class="gray"></div>
	    <!-- 主体内容 -->
	    <div class="neirong">
	    	<div class="neirong01">
	    		<h4>不跟团，不自助</h4>
	    		<img src="http://kllife.com/source/Static/qinglvpai/images/book/wenzi01.png" alt="超乎想象的精彩旅行">
	    		<p>旅游像赶集,游览像赶鸭,老人小孩跟不上趟？</p>
	    		<p>时间不自由,行程不随心,旅游陷阱隐形消费？</p>
	    		<p>攻略查到吐,临时开销大,旅途无趣味,冤枉钱？</p>
	    		<p>放心,你所担心的我们都懂！</p>
	    		<a class="mytrip dingzhiall" href="<?php echo U('line/private_book1');?>">定制我的旅行</a>
	    	</div>
	    	<div class="neirong02">
    			<a href="javascript:void(0);">
    				<img src="http://kllife.com/source/Static/phone/images/dzzt/xizang.jpg" class="xizang" alt="西藏">
    				<img src="http://kllife.com/source/Static/phone/images/dzzt/xizangwenzi.png" class="xizangwenzi" alt="西藏">
    			</a>
				<div class="neirong02-small">
					<a href="javascript:void(0);">
						<img src="http://kllife.com/source/Static/phone/images/dzzt/yunnan.jpg" class="yunnan" alt="云南">
						<img class="yunnanwenzi" src="http://kllife.com/source/Static/phone/images/dzzt/yunnanwenzi.png" alt="云南">
					</a>
					<a href="javascript:void(0);">
	    				<img class="xinjiang" class="xinjiang" src="http://kllife.com/source/Static/phone/images/dzzt/xinjiang.jpg" alt="新疆">
	    				<img class="xinjiangwenzi" src="http://kllife.com/source/Static/phone/images/dzzt/xinjiangwenzi.png" alt="新疆">
	    			</a>
				</div>
				<a href="javascript:void(0);">
    				<img src="http://kllife.com/source/Static/phone/images/dzzt/sichuan.jpg" class="sichuan" alt="四川">
    				<img class="sichuanwenzi" src="http://kllife.com/source/Static/phone/images/dzzt/sichuanwenzi.png" alt="四川">
    			</a>
	    	</div>
	    </div>
	    <div class="gray"></div>
	    <div class="neirong-bottom">
	    	<div class="neirong-bottom01">
	    		<div class="neirong-bottom-main">
	    			<h4>随心所欲，定制出行</h4>
		    		<img src="http://kllife.com/source/Static/phone/images/dzzt/wenzi02.png" alt="你想要的旅行其实无比简单">
		    		<p>一旦开始定制,你就相当于拥有了一群专业旅行策划服务团队。</p>   		
		    		<p>为您设计专属旅行线路。</p>
		    		<p>价格透明,无隐形消费</p>
		    		<p>你想要的我们都能满足！</p>
		    		<a class="mytrip mytrip01 dingzhiall" href="<?php echo U('line/private_book1');?>">定制我的旅行</a>
	    		</div>
	    	</div>
	    	<div class="neirong-bottom02">
	    		<h1>只需4步</h1>
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
	    			<li style="border: none;">
	    				<img src="http://kllife.com/source/Static/qinglvpai/images/book/4bu.png" alt="">
	    				<h1>4. [尊贵出行]</h1>
						<p>每刻美的专业团队将全程为</p>
						<p>您提供全方位服务，您只管享受精</p>
						<p>彩旅程，剩下的麻烦事儿都交给我们。</p>
	    			</li>
	    		</ul>
	    	</div>
	    	<div class="neirong-bottom03">
	    		<img src="http://kllife.com/source/Static/phone/images/dzzt/wenzi04.png" alt="">
	    		<h4>每刻美定制游</h4>
	    		<p>世界这么大,只要告诉我想去哪,剩下的都交给我！</p>
	    		<a class="mytrip dingzhiall" href="<?php echo U('line/private_book1');?>">定制我的旅行</a>
	    	</div>
	    </div>
	</section>

	

	<!-- 底部 -->
	<footer id="footer">
		<a href="tel:4000805860" style="color: #fff; display: block; padding-top: 15px;">点击拨打联系电话 400-836-0002</a>
		<p>Copyright 2017 xinlvpai.com</p>
		<p>每刻美经营许可证号：ZJ30301 浙ICP备17010959号 </p>
	</footer>
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


    	
    	//提交数据
    	$('.tijiao').click(function(){
    		var jingdian = $('.large-right-jingdian').html(),
    			renshu = $('.large-right-renshu').html(),
    			lianxiren = $('large-right-lianxiren').html(),
    			lianxifangshi = $('.large-right-lianxifangshi').html(),
    			cheliang = $('.large-cheliang').val(),
    			tese = $('.large-tese').val(),
    			riqi = $('.large-right-riqi').html(),
    			tianshu = $('.large-right-tianshu').html(),
    			zhusu = $('.large-right-zhusu').html(),
    			lingdui = $('.large-right-lingdui').html(),
    			shijian = $('.large-right-shijian').html(),
    			qitalianxifangshi = $('.large-right-qitalianxifangshi').html(),
    			more = $.trim($('.large-right-more').html());
    		if ( cheliang == '' || tese == '' || riqi == '' || tianshu == '' || zhusu == '' || lingdui == '' || shijian == '' || qitalianxifangshi == '' || more == '' ){
    			$(this).next('p').show();
    			return false;
    		} else {
    			$(this).next('p').hide();
    			$('.modal-large').animate({top: '-50%'},1000); //隐去
	    		$('.mark').fadeOut(1000);
	    		AllData = { jingdian : jingdian, renshu : renshu, lianxiren : lianxiren, lianxifangshi : lianxifangshi, cheliang : cheliang, tese : tese, riqi : riqi, tianshu : tianshu, zhusu : zhusu, lingdui : lingdui, shijian : shijian, qitalianxifangshi : qitalianxifangshi, more : more };
	    		clearAllData(); //清除数据
    		}
    		$.ajax({
				url: "",
	            type: "post",
	            dataType: 'json',
	            data: AllData,
	            async: true,
	            cache: false,
	            success: function (data) {
	            }
    		})
    	})
    </script>

</body>
</html>