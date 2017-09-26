<?php if (!defined('THINK_PATH')) exit();?><html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="跟拍游" name="author"/>
	<?php if(empty($PageKeyword) == false): ?><meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
	<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
	<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
	<title><?php echo ($PageKeyword["title"]); ?></title>
	<?php else: ?>
	<title>登录-跟拍游</title><?php endif; ?>
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
		.login > a{background: #ff1c77;}
		.automatic-forget a,.login > p a{color: #ff1c77;}
		.login > .go-welcome{width:inherit;}
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
		<div class="login-content">
			<div class="login">
				<a class="go-welcome" href="<?php echo U('index/welcome');?>" target="_blank">
					<img src="http://kllife.com/source/Static/qinglvpai/images/login/logo.png" alt="logo">
				</a>
				<h2>登录每刻美</h2>
				<div class="msg-login">
					<img src="http://kllife.com/source/Static/home/images/login_img/phone.png" alt="">
					<a href="<?php echo U('user/smslogin');?>" style="color: #666;">短信快捷登录</a>
				</div>
				<input id="login_account" type="text" placeholder="用户名/手机/邮箱">
				<input id="login_password" type="password" placeholder="请输入你的登录密码">
				<a class="login_btn" href="javascript:;">登录</a>
				<div class="automatic-forget">
					<p><i></i>自动登录</p>
					<a href="<?php echo U('user/forgotpassword');?>"  target="_blank">忘记密码？</a>
				</div>
				<!--<img src="http://kllife.com/source/Static/home/images/login_img/1.png" alt="">-->
				<!--<div class="else-login">
					<a class="qq-login" href="javascript:;">
						<img src="http://kllife.com/source/Static/home/images/login_img/qq.png" alt="">
					</a>
					<a class="wx-login" href="https://open.weixin.qq.com/connect/qrconnect?appid=APPID&redirect_uri=REDIRECT_URI&response_type=code&scope=SCOPE&state=STATE#wechat_redirect"  target="_blank">
						<img src="http://kllife.com/source/Static/home/images/login_img/wx.png" alt="">
					</a>
				</div>-->
				<p>还没有每刻美账号？<a class="to-register" href="<?php echo U('user/register');?>"  target="_blank">点击注册»</a></p>
			</div>
		</div>
	</div>
	
	<!-- 引用jq -->
	<script src="http://kllife.com/source/Static/home/common/js/jquery-1.11.3.min.js"></script>	
	<!-- Imported toastr -->
	<script src="http://kllife.com/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="http://kllife.com/source/Static/common/js/functions.js"></script>
	
	<script>
		// 切换选中
		$('.automatic-forget i').click( function () {
			$(this).toggleClass('checked');
		} );
		
		function loginAccount() {
			var jsonData = {
				account: $('#login_account').val(),
				password: $('#login_password').val(),
			};
			
			$.post('<?php echo U("user/login");?>', jsonData, function(data){
				if (data.result.errno == 0) {
//					//登录成功后返回之前的页面
					var jumpUrl = document.referrer;
					if( jumpUrl.indexOf('/user/login') != -1 ||
						jumpUrl.indexOf('/user/forgotpassword') != -1 || 
						jumpUrl.indexOf('/user/register') != -1 || 
						jumpUrl.indexOf('/user/smslogin') != -1 ){
						jumpUrl = '<?php echo U("index/welcome");?>';
					}
                    location.href =jumpUrl;
				} else {
					alert(data.result.message);
				}
			} );
		}
		
		
		bindKeyUp('#login_password', loginAccount);
		bindKeyUp('#login_phone', loginAccount);
				
		// 登录
		$('.login_btn').click(loginAccount);
	</script>
	
</body>
</html>