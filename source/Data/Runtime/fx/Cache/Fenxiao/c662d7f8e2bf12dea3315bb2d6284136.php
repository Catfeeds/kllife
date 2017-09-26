<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Xenon Boostrap Admin Panel" />
	<meta name="author" content="" />
	<title><?php echo C('PAGE_TITLE');?> - 分销系统</title>
	<link rel="stylesheet" href="/source/Static/assets/css/fonts/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/source/Static/assets/css/bootstrap.css">
	<link rel="stylesheet" href="/source/Static/assets/css/xenon-core.css">
	<link rel="stylesheet" href="/source/Static/assets/css/xenon-forms.css">
	<link rel="stylesheet" href="/source/Static/assets/css/xenon-components.css">
	<link rel="stylesheet" href="/source/Static/assets/css/xenon-skins.css">
	<link rel="stylesheet" href="/source/Static/assets/css/custom.css">
	<script src="/source/Static/assets/js/jquery-1.11.1.min.js"></script>

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<body class="page-body login-page">

	
	<div class="login-container">
	
		<div class="row">
		
			<div class="col-sm-6">
			
				<script type="text/javascript">
					jQuery(document).ready(function($)
					{
						// Reveal Login form
						setTimeout(function(){ $(".fade-in-effect").addClass('in'); }, 1);
						
						
						// Validation and Ajax action
						$("form#login").validate({
							rules: {
								username: {
									required: true
								},
								
								passwd: {
									required: true
								}
							},
							
							messages: {
								username: {
									required: '请输入您的用户名/手机/邮箱.'
								},
								
								passwd: {
									required: '请输入您的密码.'
								}
							},
							
							// Form Processing via AJAX
							submitHandler: function(form)
							{
								show_loading_bar(70); // Fill progress bar to 70% (just a given value)
								
								var opts = {
									"closeButton": true,
									"debug": false,
									"positionClass": "toast-top-full-width",
									"onclick": null,
									"showDuration": "300",
									"hideDuration": "1000",
									"timeOut": "5000",
									"extendedTimeOut": "1000",
									"showEasing": "swing",
									"hideEasing": "linear",
									"showMethod": "fadeIn",
									"hideMethod": "fadeOut"
								};
									
								var jsonData = {
									acct: $('#acct').val(),
									pwd: $('#passwd').val(),
								};
								
								$.ajax({
									url: '<?php echo U("user/login");?>',
									method: 'POST',
									dataType: 'json',
									data: jsonData,
									success: function(resp){
										show_loading_bar({
											delay: .5,
											pct: 100,
											finish: function(){												
												// Redirect after successful login page (when progress bar reaches 100%)
												if(resp.result.errno == 0)
												{
//													toastr.error(resp.result.message, "登录失败!", opts);
													window.location.href = resp.jumpUrl;
												} else {
													toastr.error(resp.result.message, "登录失败!", opts);
													$('#passwd').select();
												}
											} // end finish
										});
									}, // end success
								});
								
							}
						});
						
						// Set Form focus
						$("form#login .form-group:has(.form-control):first .form-control").focus();
					});
				</script>
				
				<!-- Errors container -->
				<div class="errors-container">
				
									
				</div>
				
				<!-- Add class "fade-in-effect" for login form effect -->
				<form method="post" role="form" id="login" class="login-form fade-in-effect">
					
					<div class="login-header">
						<a href="dashboard-1.html" class="logo">
							<img src="/source/Static/assets/images/logo@2x.png" alt="" width="80" />
						</a>
					</div>	
					
					<div class="form-group">
						<label class="control-label" for="acct">用户名</label>
						<input type="text" class="form-control input-dark" name="acct" id="acct" autocomplete="off" placeholder="用户名/手机/邮箱" />
					</div>
					
					<div class="form-group">
						<label class="control-label" for="passwd">密码</label>
						<input type="password" class="form-control input-dark" name="passwd" id="passwd" autocomplete="off" />
					</div>
					
					<div class="form-group">
						<button id="btn_login" type="submit" class="btn btn-dark  btn-block text-left">
							<i class="fa-lock"></i>
							登 录
						</button>
					</div>				
				</form>			
			</div>
			
		</div>
		
	</div>

<!-- Imported scripts on this page -->
	<script src="/source/Static/assets/js/jquery-ui/jquery-ui.min.js"></script>
	<script src="/source/Static/assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<!-- Bottom Scripts -->
	<script src="/source/Static/assets/js/bootstrap.min.js"></script>
	<script src="/source/Static/assets/js/TweenMax.min.js"></script>
	<script src="/source/Static/assets/js/resizeable.js"></script>
	<script src="/source/Static/assets/js/joinable.js"></script>
	<script src="/source/Static/assets/js/xenon-api.js"></script>
	<script src="/source/Static/assets/js/xenon-toggles.js"></script>
	<script src="/source/Static/assets/js/jquery-validate/jquery.validate.min.js"></script>
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>


	<!-- JavaScripts initializations and stuff -->
	<script src="/source/Static/assets/js/xenon-custom.js"></script>
	
</body>
</html>