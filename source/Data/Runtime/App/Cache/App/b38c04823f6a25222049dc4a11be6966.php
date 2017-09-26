<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>测试动态加载文本</title>
<meta name="" content="">
<script src="/kllife/source/Static/js/jquery-1.11.1.min.js"></script>

<script type="text/javascript" >
	function appendText(front) {
		$.post('<?php echo U("index/ajaxTest");?>','',function(data){
			alert('收到ajax回应的消息');
			var flag = parseInt($("#flag").val())+1;
			$("#flag").val(flag);
			var strHtml = $("#test").html();	
			if (front==false) {
				$("#test").html(strHtml+"<br>"+data['t2']+flag);
			} else {
				$("#test").html(data['t2']+flag+"<br>"+strHtml);
			}
		});
	}
</script>
</head>
<body>

<div id="test">
	<?php echo ($t1); ?>
</div>
<input type="hidden" id="flag" value="0"/>
<input type="button" value="点此动态添加文本到前面" onclick="appendText(true);" />
<input type="button" value="点此动态添加文本到后面" onclick="appendText(false);" />
<?php if(is_array($stra)): $i = 0; $__LIST__ = $stra;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ch): $mod = ($i % 2 );++$i; echo ($ch); ?><br><?php endforeach; endif; else: echo "" ;endif; ?>
</body>
</html>