<?php if (!defined('THINK_PATH')) exit();?><html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="跟拍游" name="author"/>
	<?php if(empty($PageKeyword) == false): ?><meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
	<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
	<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
	<title><?php echo ($PageKeyword["title"]); ?></title>
	<?php else: ?>
	<title>用户注册-跟拍游</title><?php endif; ?>
	<!-- css Reset -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/cssreset.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/common.css">
	<!-- 私有样式 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/css/login-qinglvpai.css">
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
    	<script src="../common/js/html5shiv.min.js"></script>
    <![endif]-->
	<style>
		.register .get-code a,.register-now > a,.alert-modal-top{background: #ff1c77;}
		.register-now h6 a{color:#ff1c77;}
		.register > .go-welcome{width:inherit;text-align: center;text-align: -webkit-center;}
	</style>
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
			    var vurl = window.location.href;
			    if (vurl.indexOf('www.') != -1) {
                    vurl = window.location.href.replace(/www./g, '');
                }
                var vhref = vurl.replace(/qinglvpai/g,'qlpphone');
                if (vhref.indexOf('http://') != -1) {
                	vhref = 'http://m.'+vhref.substr(7);
                } else if (vhref.indexOf('https://') != -1) {
                	vhref = 'http://m.'+vhref.substr(8);
                } else {
                	vhref = 'm.'+vhref;
                }
               	window.location.href = vhref;
			}else{
			}
		}
		browserRedirect();
    </script>
</head>
<body>
	<div id="content">
		<div class="register-content">
			<div class="register">
				<a class="go-welcome" href="<?php echo U('index/welcome');?>" target="_blank"><img src="http://kllife.com/source/Static/qinglvpai/images/login/logo.png" alt="logo"></a>
				<h2>欢迎注册每刻美账号</h2>
				<p><strong>手机号码:</strong><input id="phone" type="text" placeholder="请输入你的手机号码"></p>
				<p class="verification-code"><strong>验证码:</strong><input id="Txtidcode" type="text" placeholder="请输入你的验证码"><span id="idcode"></span></p>
				<p class="get-code"><strong>校验码:</strong><input id="code_text" type="text"><a class="msg-send-code" href="javascript:;">获取校验码</a></p>
				<p><strong>登录密码:</strong><input id="password_login" type="password"></p>
				<p><strong>确认密码:</strong><input id="password_confirm" type="password"></p>
				<div class="register-now">
					<p><i class="checked"></i>我已阅读并同意<a href="javascript:;">《每刻美用户协议》</a></p>
					<a class="register_btn" href="javascript:;">立即注册</a>
					<h6>已有账号？<a class="to-login" href="<?php echo U('user/login');?>" target="_blank">登录</a></h6>
				</div>
			</div>
		</div>
	</div>
	
	<div class="mark"></div>
	<div id="alert-modal">
		
		<div class="alert-modal-top">
			<a href="javascript:;"><img src="http://kllife.com/source/Static/home/common/images/video_close.png"/></a>
		</div>
		<div class="alert-modal-content">
			<p></p>
		</div>
		
	</div>
	
	<!-- 引用jq -->
	<script src="http://kllife.com/source/Static/home/common/js/jquery-1.11.3.min.js"></script>
	<script src="http://kllife.com/source/Static/home/js/vcode.js"></script>
	<!-- Imported toastr -->
	<script src="http://kllife.com/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="http://kllife.com/source/Static/common/js/functions.js"></script>
	<script>
		$('.alert-modal-top a').click(function(){
			$('.mark').hide();
			$('#alert-modal').hide();
		});
	
		//切换选中
		$('.register-now i').click( function () {
			$(this).toggleClass('checked');
		} );
		//验证码
		$.idcode.setCode();   

		function checkVerifyCode(){
			// 验证码
			var IsBy = $.idcode.validateCode()  
	        //调用返回值，返回值结果为true或者false
	        if(IsBy){
	        	$('#Txtidcode').removeClass('bg-red');
	        }else {
	            $('#Txtidcode').addClass('bg-red');
	        }
	        return IsBy;
		}
		
		// 获取效验码
		var InterValObj; //timer变量，控制时间
		var count = 600; //间隔函数，1秒执行
		var curCount;//当前剩余秒数
		$('.msg-send-code').click( function () {			
			if(curCount < count){
				return false;
			}else{				
				var jsonData = {
					type: 'send',
					tel: $('#phone').val(),
					use: 'qinglvpai_register',
					interval: 600,
					rd: '<?php echo ($pagerd); ?>',
				}
				$.post('<?php echo U("common/sms");?>', jsonData, function(data){
					if (data.result.errno == 0) {
						sendMessage();					
					} else {
						$('.mark').show()
						$('#alert-modal').show();
						$('#alert-modal').find('p').html(data.result.message);
						//alert(data.result.message);
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
				$(".msg-send-code").removeAttr("disabled");//启用按钮
				$(".msg-send-code").html("重新发送");
				curCount = 600;
			}
			else {
				curCount--;
				$(".msg-send-code").attr("disabled", "true");
				$(".msg-send-code").html(curCount + "秒内输入");
			}
		}
		//改变时清楚出错格式
		$('#phone').keyup(function(){
			$(this).removeClass('bg-red');
		});
		$('#Txtidcode').keyup(function(){
			$(this).removeClass('bg-red');
		});
		$('#code_text').keyup(function(){
			$(this).removeClass('bg-red');
		});
		$('#password_confirm').keyup(function(){
			$(this).removeClass('bg-red');
		});
		
		function registerUser() {
			var phone = $('#phone').val();
			if (phone == '' && $('#phone').length!=11) {
				$('#phone').addClass('bg-red');
				return false;
			}
			
			if (checkVerifyCode() == false) {
				$('.mark').show()
				$('#alert-modal').show();
				$('#alert-modal').find('p').html('您输入的验证码有误');
				return false;
			}
						
			// 两次输入密码验证
			var password_login = $('#password_login').val();
			var password_confirm = $('#password_confirm').val();
			if (password_login != password_confirm) {
				$('#password_confirm').addClass('bg-red');
				return false;
			}
			// 验证效验码
			var jsonData = {
				phone: phone,
				password: password_login,
				code: $('#code_text').val(),				
			}
			$.post('<?php echo U("user/register");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					$('.mark').show()
					$('#alert-modal').show();
					$('#alert-modal').find('p').html('注册成功！3秒后自动跳转');
					$('.alert-modal-top a').unbind('click');
					setTimeout(function(){
						$('.mark').hide()
						$('#alert-modal').hide();
						// 跳转登录
						//如果是从登录页进入
						if( document.referrer.indexOf('/user/login') != -1){
							location.href = '<?php echo U("index/welcome");?>';
						}else{
							location.href = document.referrer;
						};
					},3000);
					//alert('注册成功！');
					

										
				} else {
					$('#code_text').addClass('bg-red');
					$('.mark').show()
					$('#alert-modal').show();
					$('#alert-modal').find('p').html(data.result.message);
					//alert(data.result.message);
				}
			});
		}
		
		bindKeyUp('#phone', registerUser);
		bindKeyUp('#Txtidcode', registerUser);
		bindKeyUp('#code_text', registerUser);
		bindKeyUp('#password_login', registerUser);
		bindKeyUp('#password_confirm', registerUser);
		
		// 开始注册
		$('.register_btn').click(registerUser);		
	</script>
</body>
</html>