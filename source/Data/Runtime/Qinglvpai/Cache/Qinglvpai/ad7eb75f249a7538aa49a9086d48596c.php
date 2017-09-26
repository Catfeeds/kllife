<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title></title>
<meta name="" content="">
<!-- 引用jq -->
<script src="http://kllife.com/source/Static/home/common/js/jquery-1.11.3.min.js"></script>
</head>
<body>
<a class="login" href="javascript:;">登录</a><br />
<a href="http://kllife.com/home" target="_blank">跳转到主站</a>
<div></div>
<script type="text/javascript">
	$('.login').click(function(){
//		$.post('http://kllife.com/home/index.php?s=/home/user/login', 
//			{account:'15991164339', password:'a1b2c3'}, 
//			function(data){		
//				alert(data.result.message);
//			});
		$.post('<?php echo U("index/test");?>', {}, function(data){
			
		});
	});
	
	
</script>
</body>
</html>