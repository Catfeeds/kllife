<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="领袖户外" name="author"/>
	<?php if(empty($PageKeyword) == false): ?><meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
	<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
	<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
	<title><?php echo ($PageKeyword["title"]); ?></title>
	<?php else: ?>
	<title>短信登录-领袖户外</title><?php endif; ?>
	<!-- css Reset -->
	<link rel="stylesheet" href="/source/Static/home/common/css/cssreset.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="/source/Static/home/common/css/common.css">
	<!-- 私有样式 -->
	<link rel="stylesheet" href="/source/Static/home/css/login.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="/source/Static/common/css/common.css">
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>		
	<script src="/source/Static/common/js/functions.js"></script>
	<!--[if lt IE 9]>
		<script>
			(function() {
				if (! 
					/*@cc_on!@*/
				0) return;
				var e = "abbr, article, aside, audio, canvas, datalist, details, dialog, eventsource, figure, footer, header, hgroup, mark, menu, meter, nav, output, progress, section, time, video".split(', ');
				var i= e.length;
				while (i--){
					document.createElement(e[i])
				} 
			})() ;
		</script>
    	<script src="/source/Static/home/common/js/html5shiv.min.js"></script>
    <![endif]-->
    <script>
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
				window.location.href = 'http://test.quxingshe.com/phone/index.php?s=/phone/user/login';
				
			}else{
				
			}
		}
		browserRedirect();
    </script>
</head>
<body>
	<div id="content">
		<!-- 短信登录 -->
		<div class="msg-content">
			<div class="msg">
				<img src="/source/Static/home/images/login_img/logo.png" alt="logo">
				<h2>登录领袖户外</h2>
				<div class="msg-content-title">
					<img src="/source/Static/home/images/login_img/phone.png" alt="">短信快捷登录
				</div>
				<div class="msg-content-login">
					<input type="text" class="msg_write_phone" placeholder="请输入你的手机号码">
					<input type="text" class="msg-write-code">
					<input type="button" class="msg-send-code" value="发送动态密码">
				</div>
				<a class="msg-login" href="javascript:;">登录</a>
				<p class="msg-return">返回账号登录>></p>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="footer-bottom-content">
			<p>
				领袖户外服务信息：
				<a href="javascript:;">关于我们</a>
				|
				<a href="javascript:;">联系我们</a>
				|
				<a href="javascript:;">招贤纳士</a>
				|
				<a href="javascript:;">帮助中心</a>
				|
				<a href="javascript:;">商务合作</a>
			</p>
			<span>Copyright © 2006-2014 kllife.com | 陕西浪客国际旅行社有限责任公司版权所有</span><em>公司地址：陕西省西安市雁塔区太白南路上上国际</em>
			<br>
			<span>领袖户外经营许可证号：L-SNX00306 陕ICP备14011728号-1</span>
		</div>
	</div>



	<!-- 引用jq -->
	<script src="/source/Static/home/common/js/jquery-1.11.3.min.js"></script>
	<!--图片延迟加载-->
	<script type="text/javascript" src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>
	<script type="text/javascript">
        jQuery(document).ready(
            function($){
                $("img").lazyload({
                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
                    effect      : "fadeIn",
                    threshold : 100,
                    failure_limit : 10
                });
            });
	</script>
	
	<script>
		$('.msg-return').click(function(){
			location.href = '<?php echo U("user/login");?>';
		});
		
		function smsLogin() {			
			var sphone = $('.msg_write_phone').val();
			if (checkMobile(sphone) == false) {
				alert('错误的电话号码');
				return false;
			}
			
			var scode = $('.msg-write-code').val();
			if (scode.length != 6) {
				alert('验证码有误');
				return false;
			}
			
			$.post('<?php echo U("user/smslogin");?>', {phone: sphone, code: scode}, function(data){
				if (data.result.errno == 0) {
//					if (data.jumpUrl != null) {
//						location.href = data.jumpUrl;
//						return false;
//					}
					//登录成功后返回之前的页面
					var jumpUrl = document.referrer;
					if( jumpUrl.indexOf('/user/login') != -1 ||
						jumpUrl.indexOf('/user/forgotpassword') != -1 || 
						jumpUrl.indexOf('/user/register') != -1 || 
						jumpUrl.indexOf('/user/smslogin') != -1 ){
						jumpUrl = 'http://kllife.com';
					}
					// 登录社区
					if (data.user != null && data.user != 'undefined') {
						loginShequ(data.user, jumpUrl);
					}
					
					// 所有跳转转至社区来实现
					//location.href = '<?php echo U("index/welcome");?>';
//					if( document.referrer == 'http://kllife.com/home/index.php?s=/home/user/forgotpassword' || 
//						document.referrer == 'http://kllife.com/home/index.php?s=/home/user/register' || 
//						document.referrer == 'http://kllife.com/home/index.php?s=/home/user/smslogin' ){
//						location.href = '<?php echo U("index/welcome");?>';
//					} else {
//						location.href = document.referrer;
//					};
				} else {
					alert(data.result.message);
				}
			});
		}
		
		bindKeyUp('.msg_write_phone', smsLogin);
		bindKeyUp('.msg-write-code', smsLogin);;
		$('.msg-login').click(smsLogin);
		$('.msg-login').on("click",function(){
			$(this).attr('disabled',"true").addClass('disabled');
		})
		//发送动态密码
		//获取验证码
		var InterValObj; //timer变量，控制时间
		var count = 600; //间隔函数，1秒执行
		var curCount = 0;//当前剩余秒数
		$(".msg-send-code").click( function(){
			var phone = $('.msg_write_phone').val();
			if (checkMobile(phone) == false) {
				alert('错误的电话号码');
				return false;
			}
			
			alert('短信已经发往'+phone+',请耐心等待');
			if (curCount != 0) {
				return false;
			}
			
		　　  //向后台发送处理数据
			var jsonData = {
				type: 'send',
				tel: phone,
				use: 'sms_login',
				interval: 600,	
				rd: '<?php echo ($pagerd); ?>',			
			}
			var thisObj = this;
			$.post('<?php echo U("common/sms");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					curCount = count;
				　　//设置button效果，开始计时
					$(thisObj).attr("disabled", "true");
					$(thisObj).val(curCount + "秒内输入");
					InterValObj = setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
				} else {
					alert(data.result.message);
				}
			});
		} );
		
		//timer处理函数
		function SetRemainTime() {
			if (curCount == 0) {          
				clearInterval(InterValObj);//停止计时器
				$(".msg-send-code").removeAttr("disabled");//启用按钮
				$(".msg-send-code").val("重新发送");
			}
			else {
				curCount--;
				$(".msg-send-code").attr("disabled", "disabled");
				$(".msg-send-code").val(curCount + "秒内输入");
			}
		}

	</script>
</body>
</html>