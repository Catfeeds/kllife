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
	<title>忘记密码-领袖户外</title><?php endif; ?>	
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
		<!-- 忘记密码 -->
		<div class="forget-psd-content">
			<div class="forget-psd reset-psd">
				<a class="go-welcome" href="<?php echo U('index/welcome');?>"><img src="/source/Static/home/images/login_img/logo.png" alt="logo"></a>
				<h2>找回密码</h2>
				<p><input id="phone" type="text" placeholder="请输入你的手机号码"></p>
				<p class="get-code">
					<input id="verify_code" type="text">
					<a class="forget-psd-send-code" href="javascript:;">获取校验码</a>
				</p>
				<input id="new_password" type="password" placeholder="请输入新密码">
				<input id="comfirm_password" type="password" placeholder="请输入确认密码">
				<a class="forget-psd-sure" href="javascript:;">确定</a>
				<p class="forget-psd-bottom">已有账号？<a href="<?php echo U('user/login');?>">登录</a></p>
			</div>
		</div>
		<!-- 重置密码成功 -->
		<div class="reset-psd-success-content">
			<div class="reset-psd-success">
				<img src="/source/Static/home/images/login_img/logo.png" alt="logo">
				<h2>重置密码成功</h2>
				<img src="/source/Static/home/images/pay_success_img/ok.png" alt="">
				<span>密码修改成功</span>
				<p class="reset-success-return">返回账号登录>></p>
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
		function forgotPassword() {			
			var sphone = $('#phone').val();
			if (checkMobile(sphone) == false) {
				alert('错误的电话号码');
				return false;
			}			
			
			var scode = $('#verify_code').val();
			if (scode.length != 6) {
				alert('验证码错误');
				return false;
			}
			
			var newPassword = $('#new_password').val();
			var comfirmPassword = $('#comfirm_password').val();
			if (newPassword != comfirmPassword) {
				alert('两次输入的密码不一致');
				return false;
			}
			
			var jsonData = {
				phone: sphone,
				code: scode,
				password: newPassword,
			}
			
			$.post('<?php echo U(user/forgotPassword);?>', jsonData, function(data){
				if (data.result.errno == 0) {
					$('.forget-psd-content').hide();
					$('.reset-psd-success-content').show();
				} else {
					alert(data.result.message);
				}
			});
		}
		bindKeyUp('#phone', forgotPassword);
		bindKeyUp('#new_password', forgotPassword);
		bindKeyUp('#comfirm_password', forgotPassword);
		$('.forget-psd-sure').click(forgotPassword);
		
		$('.reset-success-return').click( function (){
			location.href = '<?php echo U("user/login");?>';
		} );
		
		//发送动态密码
		//获取验证码
		var InterValObj; //timer变量，控制时间
		var count = 600; //间隔函数，1秒执行
		var curCount;//当前剩余秒数
		$(".forget-psd-send-code").click( function(){
			var phone = $('#phone').val();
			if (checkMobile(phone) == false) {
				alert('错误的电话号码');
				return false;
			}
			
			curCount = count;
		　　//设置button效果，开始计时
			$(this).attr("disabled", "true");
			$(this).val(curCount + "秒内输入");
			InterValObj = setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
		　　 //向后台发送处理数据
			var jsonData = {
				type: 'send',
				tel: phone,
				use: 'forgot_password',
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
		function SetRemainTime() {
			if (curCount == 0) {          
				clearInterval(InterValObj);//停止计时器
				$(".forget-psd-send-code").removeAttr("disabled");//启用按钮
				$(".forget-psd-send-code").val("重新发送");
			}
			else {
				curCount--;
				$(".forget-psd-send-code").attr("disabled", "disabled");
				$(".forget-psd-send-code").val(curCount + "秒内输入");
				event.preventDefault();
			}
		}

	</script>
</body>
</html>