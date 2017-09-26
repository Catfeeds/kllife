<?php if (!defined('THINK_PATH')) exit();?><html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="领袖户外" name="author"/>
	<?php if(empty($PageKeyword) == false): ?><meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
	<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
	<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
	<title><?php echo ($PageKeyword["title"]); ?></title>
	<?php else: ?>
	<title>登录-领袖户外</title><?php endif; ?>	
	<!-- css Reset -->
	<link rel="stylesheet" href="/source/Static/home/common/css/cssreset.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="/source/Static/home/common/css/common.css">
	<!-- 私有样式 -->
	<link rel="stylesheet" href="/source/Static/home/css/login.css">
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
				window.location.href = window.location.href.replace(/home/g,'phone');
				
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
				<a class="go-welcome" href="<?php echo U('index/welcome');?>">
					<img src="/source/Static/home/images/login_img/logo.png" alt="logo">	
				</a>
				<h2>登录领袖户外</h2>
				<div class="msg-login">
					<img src="/source/Static/home/images/login_img/phone.png" alt="">
					<a href="<?php echo U('user/smslogin');?>" style="color: #666;">短信快捷登录</a>
				</div>
				<input id="login_account" type="text" placeholder="用户名/手机/邮箱">
				<input id="login_password" type="password" placeholder="请输入你的登录密码">
				<a class="login_btn" href="javascript:;">登录</a>
				<div class="automatic-forget">
					<p><i></i>自动登录</p>
					<a href="<?php echo U('user/forgotpassword');?>">忘记密码？</a>
				</div>
				<img src="/source/Static/home/images/login_img/1.png" alt="">
				<div class="else-login">
					<a class="qq-login" href="<?php echo U('thirdLogin/login');?>/type/qq/">
						<img src="/source/Static/home/images/login_img/qq.png" alt="">
					</a>
					<a class="wx-login" href="<?php echo U('thirdLogin/login');?>/type/weixin/">
						<img src="/source/Static/home/images/login_img/wx.png" alt="">
					</a>
				</div>
				<p>还没有领袖账号？<a class="to-register" href="<?php echo U('user/register');?>">点击注册»</a></p>
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
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="/source/Static/common/js/functions.js"></script>
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
						jumpUrl = 'http://kllife.com';
					}
					
					// 登录社区
					if (data.user != null && data.user != 'undefined') {
						loginShequ(data.user, jumpUrl);
					}
					
					// 所有跳转转至社区来实现
//					var jumpUrl = document.referrer;
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
			} );
		}
		
		
		bindKeyUp('#login_password', loginAccount);
		bindKeyUp('#login_phone', loginAccount);
				
		// 登录
		$('.login_btn').click(loginAccount);
		$('.login_btn').on("click",function(){
			$(this).attr('disabled',"true").addClass('disabled');
		})
		
	</script>
	
</body>
</html>