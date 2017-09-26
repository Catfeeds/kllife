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
	<title>第三方登陆绑定帐号-领袖户外</title><?php endif; ?>
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
   
</head>
<body>
	<div id="content">
		<!-- 短信登录 -->
		<div class="bind-content">
			
			<div class="bind">
				<img src="/source/Static/home/images/login_img/logo.png" alt="logo">
				<h2>绑定帐号</h2>
				<input type="hidden" name="logintype" id="logintype" value="<?php echo ($type); ?>" />
				<input type="hidden" name="openid" id="openid" value="<?php echo ($openid); ?>" />
				<div id="con_1">
					<div class="bind-content-title">
						第三方登录绑定领袖户外账号
					</div>				
					<div class="bind-content-login" id="search">
						<input type="text" class="search-account" placeholder="请输入帐号的手机号码/邮箱/用户名">
					</div>
					<a class="search-account-btn" href="javascript:;">查找</a>
					<p class="creat-account">没有帐号？跳过，创建>></p>
				</div>
				
				<div id="con_2" style="display:none;">
					<div class="bind-content-title">
						选择您要绑定的帐号
					</div>							
					<div class="bind-content-login">
						<input type="checkbox" class="is_bind">
						<p class="show_name"></p>
						<input type="hidden" name="userid" id="userid" value="" />
					</div>
					<a class="bind-account" href="javascript:;">绑定并登录</a>
					<p class="return-search"><<返回上一步</p>
					
				</div>
				
				<div id="con_3" style="display:none;">
					<div class="bind-content-title">
						设置您的帐号密码
					</div>
					<div class="bind-content-login">
						<input type="text" class="nick_name" placeholder="一个个性的昵称" style="margin-bottom: 18px;">
						
						<input type="password" class="login_password" placeholder="一个安全的密码" style="margin-bottom: 18px;">
					
						<input type="password" class="confirm_password" placeholder="安全的密码一定要输入两遍">
					</div>
					<a class="creat-account-btn" href="javascript:;">创建并登录</a>
				</div>
				
				<p class="bind-return">返回账号登录>></p>
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
		//跳转到帐号登录
		$('.msg-return').click(function(){
			location.href = '<?php echo U("user/login");?>';
		});
		
		//查找帐号
		$('.search-account-btn').click(function(){
			$('#userid').val('');
			var jsonData = {
				account: $('.search-account').val(),
			};
			$.post('<?php echo U("test/findUser");?>', jsonData, function(data){
				$('#con_1').css('display', 'none');
				$('#con_2').css('display', 'block');
				$('.is_bind').css("display", 'block');
				if(data.result.errno == 0){
					$('.is_bind').attr("checked", true);
					$('.show_name').html(data.user.show_name);
					$('#userid').val(data.user.id);
				}else{
					$('.is_bind').css("display", 'none');
					$('.show_name').html('未找到相关信息');
					$('.bind-account').html('跳过，创建新账号并登录');
					$('.bind-account').addClass('creat-account');
					
				}
			});
		});
		
		//绑定帐号登录
		$('.bind-account').click(function(){
			if($('#openid').val() == ''){				
				alert('授权信息有误，请重试！');
				return false;
			}
			if($('.is_bind').is(':checked') == true){
				var jsonData = {
					op_type: 'bind',
					userid: $('#userid').val(),
					logintype: $('#logintype').val(),
					openid: $('#openid').val(),
				};
			}			
			$.post('<?php echo U("test/bindAccount");?>', jsonData, function(data){
				if(data.result.errno == 0){
					location.href = 'http://kllife.com';
				}else{
					alert(data.result.message);
				}
			});
			
		});
				
		//创建帐号登录
		$('.creat-account-btn').click(function(){
			login_password = $('.login_password').val();
			confirm_password = $('.confirm_password').val();
			
			if(login_password == ''){
				$('.login_password').addClass('bg-red');
				return false;
			}
			
			if(confirm_password == ''){
				$('.confirm_password').addClass('bg-red');
				return false;
			}
			
			if(login_password != confirm_password){
				$('.confirm_password').addClass('bg-red');
				return false;
			}
			
			var jsonData = {
				op_type: 'creat',
				logintype: $('#logintype').val(),
				openid: $('#openid').val(),
				nickname: $('.nick_name').val(),
				password: $('.login_password').val(),
			};
			
			$.post('<?php echo U("test/bindAccount");?>', jsonData, function(data){
				if(data.result.errno == 0){
					location.href = 'http://kllife.com';
				}else{
					alert(data.result.message);
				}
			});
			
		});
		
		//复选框事件
		$('.is_bind').click(function(){
			if($(this).is(':checked') == true){				
				$('.bind-account').html('绑定并登录');
				$('.bind-account').removeClass('creat-account');
			}else{				
				$('.bind-account').html('跳过，创建新账号并登录');
				$('.bind-account').addClass('creat-account');
			}
		});
		
		//返回上一步
		$('.return-search').click(function(){
			$('#con_1').css('display', 'block');
			$('#con_2').css('display', 'none');	
		});
		
		//创建帐号登录填写密码
		$('.creat-account').click(function(){
			$('#con_1').css('display', 'none');
			$('#con_2').css('display', 'none');
			$('#con_3').css('display', 'block');
		});
		
		//改变时清楚出错格式
		$('.login_password').keyup(function(){
			$(this).removeClass('bg-red');
		});
		$('.confirm_password').keyup(function(){
			$(this).removeClass('bg-red');
		});

	</script>
</body>
</html>