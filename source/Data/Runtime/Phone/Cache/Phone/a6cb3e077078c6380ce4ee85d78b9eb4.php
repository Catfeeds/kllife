<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta name="baidu-site-verification" content="7JiPIVdZ6K" />
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
	<meta content="领袖户外" name="author"/>
	<?php if(strpos($_SERVER['HTTP_HOST'], '.kllife.com') !== FALSE): ?><meta name="robots" content="noindex,nofollow"/><?php endif; ?>
	<!--分销标题关键字-->
	<?php if(empty($duid) == false): if(C('MENU_CURRENT') == 'line_content'): ?><title><?php echo ($line["title"]); ?>-<?php echo ($line["subheading"]); ?></title>
		<?php else: ?>
			<title><?php echo ($fxset["shop_title"]["data"]["value"]); ?></title><?php endif; ?>
	<!--特殊专题额济纳标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_ejina'): ?>
		<title>额济纳旅游的首选__领袖户外旅行网__好玩不贵的小团慢旅行</title>
		<meta content="额济纳旅游的首选,领袖户外旅行网,好玩不贵的小团慢旅行" name="title"/>
	    <meta content="额济纳旅游,额济纳旅游攻略,额济纳旅游费用,额济纳旅游价格,额济纳胡杨林,额济纳旅游景点大全" name="keywords"/>
	    <meta content="额济纳旗，掉落在童话里的秋日，颠覆传统旅行方式，化腐朽为神奇的国庆精品线路。领袖户外：好玩不贵的小团慢旅行！,精品小团，享受一次恰到好处的慢旅行！在最美的风景中漫步、深呼吸，为不期而遇的惊艳停车，品味夕阳晨曦的美好，尽可能与美景相拥而眠，旅途中从陌生，变成朋友……" name="description"/>	
	<!--特殊专题新疆标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_xinjiang'): ?>
	    <title>新疆旅游的首选_领袖户外旅行网_好玩不贵的小团慢旅行_领袖户外官方网站</title>	
	    <meta content="新疆旅游的首选,领袖户外旅行网,好玩不贵的小团慢旅行,领袖户外官方网站" name="title"/>
	    <meta content="新疆旅游,新疆旅游攻略,新疆旅游费用,新疆旅游价格,新疆旅游景点大全,新疆驴友网,禾木驴友网,新疆驴友攻略,喀纳斯驴友网,新疆定制游" name="keywords"/>
	    <meta content="新疆旅游攻略，小团慢旅行,新疆自助游攻略，包括小团慢旅行,新疆热门景点、户外俱乐部、游记攻略、出行交通、餐饮等旅游信息，以及小团慢旅行,新疆驴友交流、驴友俱乐部信息。小团慢旅行,新疆旅游怎么订制。" name="description"/>	
	<!--特殊专题丝绸之路标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_silk'): ?>
	    <meta content="青海湖旅游攻略,青海湖旅游价格,敦煌旅游景点,敦煌旅游价格,青海驴友线路,青海驴友攻略,茶卡盐湖门票多钱,茶卡盐湖什么时候去好玩" name="keywords"/>
	    <meta content="300度环青海湖旅行，长达三天湖边游玩时间，避开顶光去茶卡，这是丝绸之路线路中最好的体验。丝绸之路旅游去哪儿玩？领袖户外为您独家定制专属线路,从青海湖到敦煌莫高窟,从嘉峪关到祁连山....更多的西北旅游信息就来领袖户外旅行网。" name="description"/>
		<title>丝绸之路旅游线路推荐-青海驴友俱乐部-甘肃驴友俱乐部-领袖户外旅行网-好玩不贵的小团慢旅行-茶卡盐湖驴友俱乐部</title>	
	<!--特殊专题西北标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_xibei'): ?>
	    <meta content="西北旅游,西北旅游线路,西北摄影旅游,青海湖旅游,青海湖旅游线路,青海湖摄影旅游,额济纳旅游线路,额济纳摄影旅游,额济纳旅游,额济纳旅游线路,额济纳摄影旅游,甘肃旅游,甘肃旅游线路,甘肃摄影旅游" name="keywords"/>
	    <meta content="西北摄影旅游去哪儿玩？领袖户外为您独家定制专属线路,从青海湖到敦煌莫高窟,从嘉峪关到祁连山....更多的西北旅游信息就来路星河" name="description"/>
		<title>西北旅游-青海湖旅游-额济纳旅游-甘肃旅游-西北旅游线路推荐-领袖户外</title>
	<!--特殊专题川西标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_chuanxi'): ?>
	    <meta content="川西旅游,甘南旅游,川西甘南" name="keywords"/>
	    <meta content="川西甘南旅游推荐，色达甘南稻城亚丁，你无法拒绝的美景" name="description"/>
		<title>川西甘南-川西甘南大环线-川西甘南景点推荐-领袖户外旅游网</title>	
	<!--特殊专题brand标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_brand'): ?>
	    <meta content="领袖户外,发展历程,品牌故事,联系方式" name="keywords"/>
	    <meta content="领袖户外成立于2005年，致力于为客户提供小团慢旅行、摄影游、户外游以及定制游等旅游产品。领袖户外以“享受旅行，品味人生”为愿景，以“为用户提供参与感强体验度高的旅行”为使命，精心为游客提供深度旅行服务。" name="description"/>
		<title>领袖户外品牌故事-领袖户外发展历程-领袖户外联系方式-领袖户外旅行网-驴友网</title>
	<!--通用标题关键字-->
	<?php elseif(empty($PageKeyword) == false): ?>
		<meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
		<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
		<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
		<title><?php echo ($PageKeyword["title"]); ?></title>	
	<?php else: ?>
		<title><?php echo C('PAGE_TITLE');?>-领袖户外</title><?php endif; ?>
	
	<link rel="stylesheet" href="/source/Static/phone/common/css/light7.css">
	<link rel="stylesheet" href="/source/Static/common/css/common.css">
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="/source/Static/common/js/jquery-1.11.1.min.js"></script>
	<script src="/source/Static/common/js/functions.js"></script>

	<!-- jq -->
	<!--<script src="/source/Static/phone/common/js/jquery.min.js"></script>-->
	<style>
		.black-mark { display: none; position: fixed; top:0; left:0; width: 100%; height: 100%; text-align: center; color:#ececec; background: rgba(0,0,0,.5); z-index:3000; }
		.black-mark p { margin-top: 230px; color: #fff; text-align: center; }
	</style>
	<script>			
		function ShowMark(){
			$('.black-mark').show();
		};
		function HideMark(){
			$('.black-mark').hide();
		};		
	</script>
</head>
<body>
	<div class="black-mark">
		<p>稍等一会儿...</p>
	</div>
	<!-- mycss -->
	<link rel="stylesheet" href="/source/Static/phone/css/user_login.css">
	

<!-- light7 -->
<script src="/source/Static/phone/common/js/light7.js"></script>
<!-- i18n 中文 -->
<script src="/source/Static/phone/common/js/cn.js"></script>
<!--公用JS文件-->
<script src="/source/Static/common/js/functions.js"></script>

<script>		
    //加载指示
    function PageLoading() {
    	this.loaded = false;
    }
    
    PageLoading.prototype.isLoading = function () {
    	return this.loaded;
    }
    
    PageLoading.prototype.loading = function (bshow, bstyle) {
    	this.loaded = bshow;
    	if (bstyle == null || bstyle == true) {
	    	if (bshow) {
	       		$.showPreloader();
	    	} else {
	            $.hidePreloader();	
	    	}
    	}
    }
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
	background: url('/source/Static/phone/images/order_create/code_ok.png') no-repeat;
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
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="#">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <?php if(empty($duid)): ?><h1 class="title">领袖户外欢迎您</h1>
		    <?php else: ?>
		    	<h1 class="title"><?php echo ($fxset["shop_title"]["data"]["value"]); ?></h1><?php endif; ?>
		</header>
			    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>游记</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a>
	    	<?php else: ?>
			    <a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a><?php endif; ?>
		</nav>
		<!--<script src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>-->
		<script type="text/javascript">
//            jQuery(document).ready(function($){
//                $("img").lazyload({
//                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
//                    effect      : "fadeIn",
//                    threshold : 0,
//                    failure_limit : 10,
//                    skip_invisible : false
//                });
//            });

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
		<div class="content">
			<div class="login-header">
				<div class="login-header-img">
				    <?php if(empty($duid)): ?><img src="/source/Static/phone/images/user_login/myhead.png" alt="">
				    <?php else: ?>
						<img src="/source/Static/phone/images/user_login/fxhead.jpg" alt=""><?php endif; ?>
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
							<a style="display: block; width: 90%; height: 2.2rem; line-height: 2.2rem; margin: 0 auto; margin-top: .5rem; background-color: #fff; border: 1px solid #ff7200; color: #ff7200; font-size: .9rem;" href="<?php echo U('service/center');?>" external>帮助中心</a>
						</div>
						
						<div class="third-party">
							<div class="third-party-header">
								<p></p>
								<h6>使用第三方登录</h6>
							</div>
							<div class="third-party-btn">
								<a href="<?php echo U('thirdLogin/login');?>/type/qq/" target="_blank" external><img src="/source/Static/phone/images/user_login/qq.png" alt=""></a>
								<a href="http://kllife.com/weixin/" target="_blank" external class="wx-login-bot"><img src="/source/Static/phone/images/user_login/wx.png" alt=""></a>
							</div>
						</div>
						
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
				            <!--<div class="item-content">
								<div class="item-inner">
									<div class="item-title label">验证码</div>
									<div class="item-input" style="position: relative;">
										<input class="phone t-code" type="text" maxlength="11" placeholder="请输入验证码">
										<img id="yanzhengma-img" style="position: absolute;top:0px;right:-.6rem;height:40px;width:97px;" alt="">
									</div>
								</div>
				            </div>-->
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

	<script src="/source/Static/common/js/verify.js" > </script>
	<script type="text/javascript">
		var verifyCode = null;
		$(document).ready(function(){
			// 初始化验证码
//			verifyCode = new Verify($('#yanzhengma-img'),130,40,4,18);

			if(!isWeiXin()){
				$('.wx-login-bot').css('display', 'none');
			}
		});
		// 获取效验码
		var InterValObj2; //timer变量，控制时间
		var count2 = 600; //间隔函数，1秒执行
		var curCount2 = 600;//当前剩余秒数
		$('#tab2').find('.msg-send-code').click( function () {
//            var code = $('.t-code').val();
//            if(verifyCode.check(code) == false){
//                alert("验证码不正确，请重新输入");
//				return false;
//			}else{
//                verifyCode.refresh();
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
//			}

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
				if ('<?php echo ($duid); ?>' != '') {
					jsonData['duid'] = '<?php echo ($duid); ?>';
				}
				$.post('<?php echo U("user/login");?>', jsonData, function(data){
					if (data.result.errno == 0) {
						//登录成功后返回之前的页面
						var jumpUrl = document.referrer;
						if( jumpUrl.indexOf('/user/login') != -1 ||
							jumpUrl.indexOf('/user/forgotpassword') != -1 || 
							jumpUrl.indexOf('/user/register') != -1 || 
							jumpUrl.indexOf('/user/smslogin') != -1 ){
							jumpUrl = 'http://kllife.com/phone';
						}						
						if ('<?php echo ($duid); ?>' != '') {
							jumpUrl = '<?php echo U("fenxiao/welcome");?>/duid/<?php echo ($duid); ?>';
						}
						
						// 登录社区
						if (data.user != null && data.user != 'undefined') {
							loginShequ(data.user, jumpUrl, 1);
						}
//						location.href = jumpUrl;
					} else {
						alert(data.result.message);
					}
				});
				$(this).find("a").attr('disabled',"true").addClass('disabled');
			} else {
				var sphone = $(tab).find('.phone').val();
				if (checkMobile(sphone) == false) {
					alert('错误的电话号码');
					return false;
				}

				var scode = $(tab).find('.verify_code').val();
				if (scode.length != 6) {
					alert('验证码有误');
					return false;
				}
				
				var jsonData = {
					phone: sphone, 
					code: scode
				}
				if ('<?php echo ($duid); ?>' != '') {
					jsonData['duid'] = '<?php echo ($duid); ?>';
				}
				
				$.post('<?php echo U("user/smslogin");?>', jsonData, function(data){
					if (data.result.errno == 0) {
						//登录成功后返回之前的页面
						var jumpUrl = document.referrer;
						if( jumpUrl.indexOf('/user/login') != -1 ||
							jumpUrl.indexOf('/user/forgotpassword') != -1 || 
							jumpUrl.indexOf('/user/register') != -1 || 
							jumpUrl.indexOf('/user/smslogin') != -1 ){
							jumpUrl = 'http://kllife.com/phone';
						}						
						if ('<?php echo ($duid); ?>' != '') {
							jumpUrl = '<?php echo U("fenxiao/welcome");?>/duid/<?php echo ($duid); ?>';
						}						
						// 登录社区
						if (data.user != null && data.user != 'undefined') {
							loginShequ(data.user, jumpUrl, 1);
						}
//						location.href = data.jumpUrl;
					} else {
						alert(data.result.message);
					}
				});
				$(this).find("a").attr('disabled',"true").addClass('disabled');
			}
		});
		
		//判断是否微信浏览器打开
		function isWeiXin(){
			var ua = window.navigator.userAgent.toLowerCase();
			if(ua.match(/MicroMessenger/i) == 'micromessenger'){
				return true;
			}else{
				return false;
			}
		}
	</script>

	<div class="page" id="routers-login-inner-1">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="#">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <?php if(empty($duid)): ?><h1 class="title">领袖户外欢迎您</h1>
		    <?php else: ?>
		    	<h1 class="title"><?php echo ($fxset["shop_title"]["data"]["value"]); ?></h1><?php endif; ?>
		</header>
			    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>游记</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a>
	    	<?php else: ?>
			    <a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a><?php endif; ?>
		</nav>
		<!--<script src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>-->
		<script type="text/javascript">
//            jQuery(document).ready(function($){
//                $("img").lazyload({
//                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
//                    effect      : "fadeIn",
//                    threshold : 0,
//                    failure_limit : 10,
//                    skip_invisible : false
//                });
//            });

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
		<div class="content">
			<div class="register-header">
				<div class="register-header-img">
				    <?php if(empty($duid)): ?><img src="/source/Static/phone/images/user_login/myhead.png" alt="">
				    <?php else: ?>
						<img src="/source/Static/phone/images/user_login/fxhead.jpg" alt=""><?php endif; ?>
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
			        <?php if(empty($duid)): ?><a href="<?php echo U('user/login');?>" external>已有账号，点击登录</a>
			        <?php else: ?>
			        	<a href="<?php echo U('user/login');?>/duid/<?php echo ($duid); ?>" external>已有账号，点击登录</a><?php endif; ?>
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
					if ('<?php echo ($duid); ?>' != '') {
						location.href = '<?php echo U("user/login");?>/duid/<?php echo ($duid); ?>';
					} else {
						location.href = '<?php echo U("user/login");?>';
					}
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
			    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>游记</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a>
	    	<?php else: ?>
			    <a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a><?php endif; ?>
		</nav>
		<!--<script src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>-->
		<script type="text/javascript">
//            jQuery(document).ready(function($){
//                $("img").lazyload({
//                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
//                    effect      : "fadeIn",
//                    threshold : 0,
//                    failure_limit : 10,
//                    skip_invisible : false
//                });
//            });

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
			if ('<?php echo ($duid); ?>' != '') {
				jsonData['duid'] = '<?php echo ($duid); ?>';
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
<!--百度统计-->
<script>
	var _hmt = _hmt || [];
	(function() {
		var hm = document.createElement("script");
		hm.src = "//hm.baidu.com/hm.js?a6f69a2a062b07c67a4ae301e0963ca8";
		var s = document.getElementsByTagName("script")[0]; 
		s.parentNode.insertBefore(hm, s);
	})();
</script> 
<!--商务通统计-->
<script language="javascript" src="http://pqt.zoosnet.net/JS/LsJS.aspx?siteid=PQT43116159&lng=cn"></script>
<!--CNZZ统计-->
<script type="text/javascript">
	var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
	document.write(unescape("%3Cdiv id='cnzz_stat_icon_1000019958'%3E%3C/div%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1000019958%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>