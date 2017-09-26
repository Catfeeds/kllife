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
	<!-- mycss -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/phone/css/user_login.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/common/css/animate.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/common/css/top2.css">
	

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
	<style>
.stage{position:relative;padding: 0 15px;height:55px;}
.slider{position:absolute; width: 200px; height:32px;box-shadow:0 0 3px #999;background-color:#ddd;left:6px;top:-17px;}
.slider-text {
    background: -webkit-gradient(linear, left top, right top, color-stop(0, #4d4d4d), color-stop(.4, #4d4d4d), color-stop(.5, white), color-stop(.6, #4d4d4d), color-stop(1, #4d4d4d));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    -webkit-animation: slidetounlock 3s infinite;
    -webkit-text-size-adjust: none;
    line-height: 32px;
    height: 32px;
    text-align: center;
    font-size: 16px;
    width: 200px;
    color: #aaa;
}
.login-btn a,.register-content > a,.find-psd > a{background: #ff1c77;border-color:#ff1c77;}
.register-btn a,.register-content > a:last-child{border-color:#ff1c77;color:#ff1c77;}
.content{top:60px;width:100%;margin-bottom:60px;}
.list-block .item-content .get-code{background: #ff1c77;}
.help-list h4,.help-list h4 span,.bar .button-link{color:#ff1c77;}
.login-header,.buttons-tab,.register-header{background-color: #cee1f4}
@keyframes slidetounlock
{
    0%     {background-position:-200px 0;}
    100%   {background-position:200px 0;}
}
@-webkit-keyframes slidetounlock
{
    0%     {background-position:-200px 0;}
    100%   {background-position:200px 0;}
}
.button-off{
    position: absolute;
    left: 0;
    top: 0;
    width: 32px;
    height: 32px;
    background-color: #fff;
    transition: left 0s;
    -webkit-transition: left 0s;
}
.button-on{
    position: absolute;
    left: 0;
    top: 0;
    width: 32px;
    height: 32px;
    background-color: #fff;
    transition: left 1s;
    -webkit-transition: left .5s;
}
.track{
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 0;
    overflow: hidden;
    transition: width 0s;
    -webkit-transition: width 0s;
    z-index: 10;
}
.track-on{
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 0;
    overflow: hidden;
    transition: width 1s;
    -webkit-transition: width .5s;
}
.icon-move  {
    width: 32px;
    height: 32px;
    position: relative;
    top:1px;
    left:0;
    font-family: sans-serif;
}
.icon-move:before{
    content:'>>';
    color:#ccc;
    line-height:32px;
}
.spinner {
    width: 20px;
    height: 20px;
	background: url('http://kllife.com/source/Static/phone/images/order_create/code_ok.png') no-repeat;
    position: relative;
    top:6px;
    left:6px;
    background-size: 100% 100%;
    display: none;
}

@-webkit-keyframes bouncedelay {
    0%, 80%, 100% { -webkit-transform: scale(0.0) }
    40% { -webkit-transform: scale(1.0) }
}
@keyframes bouncedelay {
    0%, 80%, 100% {
        transform: scale(0.0);
        -webkit-transform: scale(0.0);
    } 40% {
          transform: scale(1.0);
          -webkit-transform: scale(1.0);
      }
}
.bg-green {
    line-height: 32px;
    height: 32px;
    text-align: center;
    font-size: 16px;
    background-color: #78c430;
}

</style>
	<div class="page page-current" id="router">
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
			<div class="login-header">
				<div class="login-header-img">
					<img src="http://kllife.com/source/Static/qlpphone/images/login/myhead.png" alt="">
				</div>
				<div class="buttons-tab">
					<a href="#tab1" class="tab-link active button">帐号登录</a>
					<a href="#tab2" class="tab-link button">短信登录</a>
				</div>
				<div class="tabs">
					<div id="tab1" class="tab active">
						<p class="arrow-up"></p>
						<div class="list-block">
							<div class="item-content">
								<div class="item-inner">
									<div class="item-title label">登录账户</div>
									<div class="item-input">
							  			<input class="account" type="text" placeholder="用户名/手机/邮箱">
									</div>
								</div>
				            </div>
				            <div class="item-content">
				            	<div class="item-inner">
									<div class="item-title label">密码</div>
									<div class="item-input">
							  			<input class="password" type="password" placeholder="请输入您的密码">
									</div>
								</div>
				            </div>
				        </div>
				        <a href="#routers-login-inner-2">忘记密码？</a>
						<div class="login-btn">
							<a href="javascript:;" external>登录</a>
						</div>
						<div class="register-btn">
							<a href="#routers-login-inner-1">还没有账号？立即注册</a>
						</div>
						<div class="help-center" >
							<a style="display: block; width: 90%; height: 2.2rem; line-height: 2.2rem; margin: 0 auto; margin-top: .5rem; background-color: #fff; border: 1px solid #ff1c77; color: #ff1c77; font-size: .9rem;" href="<?php echo U('service/center');?>" external>帮助中心</a>
						</div>
						<!--<div class="third-party">
							<div class="third-party-header">
								<p></p>
								<h6>使用第三方登录</h6>
							</div>
							<div class="third-party-btn">
								<a href="javascript:;" external><img src="http://kllife.com/source/Static/phone/images/user_login/qq.png" alt=""></a>
								<a href="javascript:;" external><img src="http://kllife.com/source/Static/phone/images/user_login/wx.png" alt=""></a>
							</div>
						</div>-->
					</div>
					<div id="tab2" class="tab">
						<p class="arrow-up"></p>
						<div class="list-block">
							<div class="item-content">
								<div class="item-inner">
									<div class="item-title label">手机号</div>
									<div class="item-input">
							  			<input class="phone" type="number" maxlength="11" placeholder="请输入您的手机号">
									</div>
								</div>
				            </div>
				            <div class="item-content">
								<div class="item-inner">
									<div class="item-title label">验证码</div>
									<div class="item-input">
							  			<div class="slider" id="msg-slider">
											<div class="slider-text">向右滑动验证</div>
											<div class="track" id="msg-track">
												<div class="bg-green"></div>
											</div>
											<div class="button-off" id="msg-btn">
												<div class="icon-move" id="msg-icon"></div>
												<div class="spinner" id="msg-spinner"></div>
											</div>
										</div>
									</div>
								</div>
				            </div>
				            <div class="item-content">
				            	<div class="item-inner">
									<div class="item-title label">校验码</div>
									<div class="item-input">
							  			<input class="verify_code" type="text" maxlength="6" >
							  			<input class="msg-send-code get-code" type="button" value="获取校验码" readonly="">
									</div>
								</div>
				            </div>

				            <div class="login-btn">
								<a href="javascript:;" external>登录</a>
							</div>

				        </div>
					</div>
			    </div>

			</div>
		</div>
	</div>

	<script type="text/javascript">
		//验证码
		var mBtn = document.getElementById('msg-btn');
	    var mW,mLeft;
	    var mSlider=document.getElementById('msg-slider');
	    var mTrack=document.getElementById('msg-track');
	    var mIcon=document.getElementById('msg-icon');
	    var mSpinner=document.getElementById('msg-spinner');
		var mflag=1;
		//限制最大宽度
		var mWidth = $('.slider').width();

	    mBtn.addEventListener('touchstart',function(e){
			if(mflag==1){
				console.log(e);
				var touches = e.touches[0];
				mW = touches.clientX - mBtn.offsetLeft;
				mBtn.className="button-off";
				mTrack.className="track";
			}

	    },false);

	    mBtn.addEventListener("touchmove", function(e) {
			if(mflag==1){
				var touches = e.touches[0];
				mLeft = touches.clientX - mW;
				if(mLeft < 0) {
					mLeft = 0;
				}else if(mLeft > mWidth - mBtn.offsetWidth) {
					mLeft = (mWidth - mBtn.offsetWidth);
				}
				mBtn.style.left = mLeft + "px";
				mTrack.style.width=mLeft+ 'px';
			}

	    },false);

	    mBtn.addEventListener("touchend",function() {
	        if(mLeft>= mWidth - mBtn.clientWidth ){
	            mBtn.style.left = (mWidth - mBtn.offsetWidth);
	            mTrack.style.width= (mWidth - mBtn.offsetWidth);
	            mIcon.style.display='none';
	            mSpinner.style.display='block';
				mflag=0;
	        }else{
	            mBtn.style.left = 0;
	            mTrack.style.width= 0;
	        }
	        mBtn.className="button-on";
	        mTrack.className="track-on";
	    },false);
		// 获取效验码
		var InterValObj2; //timer变量，控制时间
		var count2 = 600; //间隔函数，1秒执行
		var curCount2 = 600;//当前剩余秒数
		$('#tab2').find('.msg-send-code').click( function () {
			if(curCount2 < count2){
				return false;
			}else{
				var jsonData = {
					type: 'send',
					tel: $('#tab2').find('.phone').val(),
					use: 'phone_sms_login',
					interval: 600,
					rd: '<?php echo ($pagerd); ?>',
				}
				$.post('<?php echo U("common/sms");?>', jsonData, function(data){
					if (data.result.errno == 0) {
						sendMessage2();
					} else {
						alert(data.result.message);
					}
				});
			}
		} );

		//获取效验码
		function sendMessage2() {
			curCount2 = count2;
		　　//设置button效果，开始计时
			var sendBtnObj = $('#tab2').find('.msg-send-code');
			$(sendBtnObj).attr("disabled", "true");
			$(sendBtnObj).val(curCount2 + "秒内输入");
			InterValObj2 = setInterval(SetRemainTime2, 1000); //启动计时器，1秒执行一次
		}

		//timer处理函数
		function SetRemainTime2() {
			if (curCount2 == 0) {
				clearInterval(InterValObj2);//停止计时器
				$('#tab2').find(".msg-send-code").removeAttr("disabled");//启用按钮
				$('#tab2').find(".msg-send-code").val("重新发送");
				curCount2 = 600;
			} else {
				curCount2--;
				$('#tab2').find(".msg-send-code").attr("disabled", "true");
				$('#tab2').find(".msg-send-code").val(curCount2 + "秒内输入");
			}
		}

		$("#router").find(".login-btn").click(function(){
			var tab = $('.buttons-tab').find('a.active').attr('href');
			if (tab == '#tab1') {
				var jsonData = {
					account: $(tab).find('.account').val(),
					password: $(tab).find('.password').val(),
				};
				$.post('<?php echo U("user/login");?>', jsonData, function(data){
					if (data.result.errno == 0) {
						//登录成功后返回之前的页面
						var jumpUrl = document.referrer;
						if( jumpUrl.indexOf('/user/login') != -1 ||
							jumpUrl.indexOf('/user/forgotpassword') != -1 || 
							jumpUrl.indexOf('/user/register') != -1 || 
							jumpUrl.indexOf('/user/smslogin') != -1 ){
							jumpUrl = '<?php echo U("index/welcome");?>';
						}
						location.href = jumpUrl;
					} else {
						alert(data.result.message);
					}
				});
			} else {
				var sphone = $(tab).find('.phone').val();
				if (checkMobile(sphone) == false) {
					alert('错误的电话号码');
					return false;
				}
				//滑动验证码验证
				if(mflag != 0){
					alert('验证码滑动失败');
					return false;
				}

				var scode = $(tab).find('.verify_code').val();
				if (scode.length != 6) {
					alert('验证码有误');
					return false;
				}

				$.post('<?php echo U("user/smslogin");?>', {phone: sphone, code: scode}, function(data){
					if (data.result.errno == 0) {
						//登录成功后返回之前的页面
						var jumpUrl = document.referrer;
						if( jumpUrl.indexOf('/user/login') != -1 ||
							jumpUrl.indexOf('/user/forgotpassword') != -1 || 
							jumpUrl.indexOf('/user/register') != -1 || 
							jumpUrl.indexOf('/user/smslogin') != -1 ){
							jumpUrl = '<?php echo U("index/welcome");?>';
						}
						location.href = data.jumpUrl;
					} else {
						alert(data.result.message);
					}
				});
			}
		});
	</script>

	<div class="page" id="routers-login-inner-1">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="#">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">领袖户外欢迎您</h1>
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
			<div class="register-header">
				<div class="register-header-img">
					<img src="http://kllife.com/source/Static/qlpphone/images/login/myhead.png" alt="">
					<p>立即注册</p>
				</div>
				<div class="register-content">
					<div class="list-block">
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">手机号</div>
								<div class="item-input">
						  			<input class="phone" type="number" maxlength="11" placeholder="请输入您的手机号">
								</div>
							</div>
			            </div>
			            <div class="item-content">
							<div class="item-inner">
								<div class="item-title label">验证码</div>
								<div class="item-input">
						  			<div class="slider" id="slider">
										<div class="slider-text">向右滑动验证</div>
										<div class="track" id="track">
											<div class="bg-green"></div>
										</div>
										<div class="button-off" id="btn">
											<div class="icon-move" id="icon"></div>
											<div class="spinner" id="spinner"></div>
										</div>
									</div>
								</div>
							</div>
			            </div>
			            <div class="item-content">
							<div class="item-inner">
								<div class="item-title label">校验码</div>
								<div class="item-input">
						  			<input class="verify_code" type="text" maxlength="6">
						  			<input class="msg-send-code get-code" type="button" value="获取校验码" readonly="">
								</div>
							</div>
			            </div>
			            <div class="item-content">
							<div class="item-inner">
								<div class="item-title label">登录密码</div>
								<div class="item-input">
						  			<input class="password register_password" type="password">
								</div>
							</div>
			            </div>
			            <div class="item-content">
							<div class="item-inner">
								<div class="item-title label">确认密码</div>
								<div class="item-input">
						  			<input class="confirm_password register_confirm_password" type="password">
								</div>
							</div>
			            </div>
			        </div>
			        <a class="btn_register_user" href="javascript:;" external>注册</a>
			        <a href="<?php echo U('user/login');?>" external>已有账号，点击登录</a>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		//验证码
		var oBtn = document.getElementById('btn');
	    var oW,oLeft;
	    var oSlider=document.getElementById('slider');
	    var oTrack=document.getElementById('track');
	    var oIcon=document.getElementById('icon');
	    var oSpinner=document.getElementById('spinner');
		var flag=1;
		//限制最大宽度
		var oWidth = $('.slider').width();

	    oBtn.addEventListener('touchstart',function(e){
			if(flag==1){
				console.log(e);
				var touches = e.touches[0];
				oW = touches.clientX - oBtn.offsetLeft;
				oBtn.className="button-off";
				oTrack.className="track";
			}

	    },false);

	    oBtn.addEventListener("touchmove", function(e) {
			if(flag==1){
				var touches = e.touches[0];
				oLeft = touches.clientX - oW;
				if(oLeft < 0) {
					oLeft = 0;
				}else if(oLeft > oWidth - oBtn.offsetWidth) {
					oLeft = (oWidth - oBtn.offsetWidth);
				}
				oBtn.style.left = oLeft + "px";
				oTrack.style.width=oLeft+ 'px';
			}

	    },false);

	    oBtn.addEventListener("touchend",function() {
	        if(oLeft>= oWidth - oBtn.clientWidth ){
	            oBtn.style.left = (oWidth - oBtn.offsetWidth);
	            oTrack.style.width= (oWidth - oBtn.offsetWidth);
	            oIcon.style.display='none';
	            oSpinner.style.display='block';
				flag=0;
	        }else{
	            oBtn.style.left = 0;
	            oTrack.style.width= 0;
	        }
	        oBtn.className="button-on";
	        oTrack.className="track-on";
	    },false);
		// 获取效验码
		var InterValObj; //timer变量，控制时间
		var count = 600; //间隔函数，1秒执行
		var curCount;//当前剩余秒数
		$('#routers-login-inner-1').find('.msg-send-code').click( function () {
			if(curCount < count){
				return false;
			}else{
				var jsonData = {
					type: 'send',
					tel: $('#routers-login-inner-1').find('.phone').val(),
					use: 'phone_register',
					interval: 600,
					rd: '<?php echo ($pagerd); ?>',
				}
				$.post('<?php echo U("common/sms");?>', jsonData, function(data){
					if (data.result.errno == 0) {
						sendMessage();
					} else {
						alert(data.result.message);
					}
				});
			}
		} );
		//获取效验码

		function sendMessage() {
			curCount = count;
		　　//设置button效果，开始计时
			//$(this).attr("disabled", "true");
			$(this).html(curCount + "秒内输入");
			InterValObj = setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
		}

		//timer处理函数
		function SetRemainTime() {
			if (curCount == 0) {
				clearInterval(InterValObj);//停止计时器
				$('#routers-login-inner-1').find(".msg-send-code").removeAttr("disabled");//启用按钮
				$('#routers-login-inner-1').find(".msg-send-code").val("重新发送");
				curCount = 600;
			}
			else {
				curCount--;
				$('#routers-login-inner-1').find(".msg-send-code").attr("disabled", "true");
				$('#routers-login-inner-1').find(".msg-send-code").val(curCount + "秒内输入");
			}
		}

		$('#routers-login-inner-1').find('.btn_register_user').click(function(){
			var phone = $('#routers-login-inner-1').find('.phone').val();
			if (phone == '' && phone.length != 11) {
				//$('#phone').addClass('bg-red');
				alert('请输入正确的手机号');
				return false;
			}
			//验证码滑动验证
			if(flag != 0){
				alert('验证码滑动失败');
				return false;
			}

			//密码验证
			if($('.register_password').val() == '' || $('.register_confirm_password').val() == ''){
				alert('密码不能为空');
				return false;
			}

			// 两次输入密码验证
			var password_login = $('#routers-login-inner-1').find('.register_password').val();
			var password_confirm = $('#routers-login-inner-1').find('.register_confirm_password').val();
			if (password_login != password_confirm) {
				//$('#routers-login-inner-1').find('.confirm_password').addClass('bg-red');
				alert('两次输入密码不同');
				return false;
			}

			// 验证效验码
			var jsonData = {
				phone: phone,
				password: password_login,
				code: $('#routers-login-inner-1').find('.verify_code').val(),
			}
			$.post('<?php echo U("user/register");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					alert('注册成功！');
					// 跳转登录
					location.href = '<?php echo U("user/login");?>';
				} else {
					$('#routers-login-inner-1').find('.code_text').addClass('bg-red');
					alert(data.result.message);
				}
			});
		});
	</script>

	<!-- 找回密码 -->
	<div class="page" id="routers-login-inner-2">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="#">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">找回密码</h1>
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
			<div class="find-psd">
				<div class="list-block">
					<div class="item-content">
						<div class="item-inner">
							<div class="item-title label">手机号</div>
							<div class="item-input">
					  			<input class="phone" type="number" maxlength="11" placeholder="请输入您的手机号">
							</div>
						</div>
		            </div>
		            <div class="item-content">
						<div class="item-inner">
							<div class="item-title label">验证码</div>
							<div class="item-input">
					  			<div class="slider" id="getSlider">
									<div class="slider-text">向右滑动验证</div>
									<div class="track" id="getTrack">
										<div class="bg-green"></div>
									</div>
									<div class="button-off" id="getBtn">
										<div class="icon-move" id="getIcon"></div>
										<div class="spinner" id="getSpinner"></div>
									</div>
								</div>
							</div>
						</div>
		            </div>
		            <div class="item-content">
						<div class="item-inner">
							<div class="item-title label">校验码</div>
							<div class="item-input">
					  			<input class="verify_code" type="text" maxlength="6">
					  			<input class="forget-psd-send-code get-code" type="button" value="获取校验码" readonly="">
							</div>
						</div>
		            </div>
		            <div class="item-content">
						<div class="item-inner">
							<div class="item-title label">新密码</div>
							<div class="item-input">
					  			<input class="password find_password" type="password" placeholder="请输入新密码">
							</div>
						</div>
		            </div>
		            <div class="item-content">
						<div class="item-inner">
							<div class="item-title label">确认密码</div>
							<div class="item-input">
					  			<input class="confirm_password find_confirm_password" type="password" placeholder="请输入确认密码">
							</div>
						</div>
		            </div>
		        </div>
		        <a class="reset_password" href="javascript:;">重置密码</a>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		//验证码
		var gBtn = document.getElementById('getBtn');
	    var gW,gLeft;
	    var gSlider=document.getElementById('getSlider');
	    var gTrack=document.getElementById('getTrack');
	    var gIcon=document.getElementById('getIcon');
	    var gSpinner=document.getElementById('getSpinner');
		var getFlag=1;
		//限制最大宽度
		var gWidth = $('#getSlider').width();

	    gBtn.addEventListener('touchstart',function(e){
			if(getFlag==1){
				console.log(e);
				var touches = e.touches[0];
				gW = touches.clientX - gBtn.offsetLeft;
				gBtn.className="button-off";
				gTrack.className="track";
			}

	    },false);

	    gBtn.addEventListener("touchmove", function(e) {
	    	console.log(gLeft);
			if(getFlag==1){
				var touches = e.touches[0];
				gLeft = touches.clientX - gW;
				if(gLeft < 0) {
					gLeft = 0;
				}else if(gLeft > gWidth - gBtn.offsetWidth) {
					gLeft = (gWidth - gBtn.offsetWidth);
				}
				gBtn.style.left = gLeft + "px";
				gTrack.style.width = gLeft+ 'px';
			}

	    },false);

	    gBtn.addEventListener("touchend",function() {

	        if(gLeft >= gWidth - gBtn.clientWidth ){
	            gBtn.style.left = (gWidth - gBtn.offsetWidth);
	            gTrack.style.width= (gWidth - gBtn.offsetWidth);
	            gIcon.style.display='none';
	            gSpinner.style.display='block';
				getFlag=0;
	        }else{
	            gBtn.style.left = 0;
	            gTrack.style.width= 0;
	        }
	        gBtn.className="button-on";
	        gTrack.className="track-on";

	        console.log(getFlag);
	    },false);

		//发送动态密码

		var InterValObj1; //timer变量，控制时间
		var count1 = 600; //间隔函数，1秒执行
		var curCount1;//当前剩余秒数
		$('#routers-login-inner-2').find(".forget-psd-send-code").click( function(){
			var phone = $('#routers-login-inner-2').find('.phone').val();
			if (checkMobile(phone) == false) {
				alert('错误的电话号码');
				return false;
			}

			curCount1 = count1;
		　　//设置button效果，开始计时
			$(this).attr("disabled", "true");
			$(this).val(curCount1 + "秒内输入");
			InterValObj1 = setInterval(SetRemainTime1, 1000); //启动计时器，1秒执行一次
		　　 //向后台发送处理数据
			var jsonData = {
				type: 'send',
				tel: phone,
				use: 'phone_forgot_password',
				interval: 600,
				rd: '<?php echo ($pagerd); ?>',
			}
			$.post('<?php echo U("common/sms");?>', jsonData, function(data){
				if (data.result.errno == 0) {
				} else {
					alert(data.result.message);
				}
			});
		} );

		//timer处理函数
		function SetRemainTime1() {
			if (curCount1 == 0) {
				clearInterval(InterValObj1);//停止计时器
				$('#routers-login-inner-2').find(".forget-psd-send-code").removeAttr("disabled");//启用按钮
				$('#routers-login-inner-2').find(".forget-psd-send-code").val("重新发送");
			}
			else {
				curCount1--;
				$('#routers-login-inner-2').find(".forget-psd-send-code").attr("disabled", "disabled");
				$('#routers-login-inner-2').find(".forget-psd-send-code").val(curCount1 + "秒内输入");
				event.preventDefault();
			}
		}

		// 重置密码
		$('#routers-login-inner-2').find('.reset_password').click(function(){
			var sphone = $('#routers-login-inner-2').find('.phone').val();
			if (checkMobile(sphone) == false) {
				alert('错误的电话号码');
				return false;
			}

			//验证码滑动验证
			if (getFlag != 0){
				alert('验证码滑动失败');
				return false;
			}

			//若没有输入密码
			if($('.find_password').val() == '' || $('.find_confirm_password').val() == ''){
				alert('请输入密码');
				return false;
			}

			var scode = $('#routers-login-inner-2').find('.verify_code').val();
			if (scode.length != 6) {
				alert('验证码错误');
				return false;
			}

			var newPassword = $('#routers-login-inner-2').find('.password').val();
			var comfirmPassword = $('#routers-login-inner-2').find('.confirm_password').val();
			if (newPassword != comfirmPassword) {
				alert('两次输入的密码不一致');
				return false;
			}

			var jsonData = {
				phone: sphone,
				code: scode,
				password: newPassword,
			}

			$.post('<?php echo U("user/forgotPassword");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					location.href = '<?php echo U("index/welcome");?>';
				} else {
					alert(data.result.message);
				}
			});
		});
	</script>

	<script>
		$(function(){
			$.init();
		});
	</script>