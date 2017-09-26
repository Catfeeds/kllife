<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="/source/Static/home/common/js/jquery-1.11.3.min.js"></script>
	<script src="/source/Static/common/js/functions.js"></script>
</head>
<body>
	<div class="black-mark">
		<p>正在跳转，请稍等...</p>
	</div>
	<script type="text/javascript">
        jQuery(document).ready(
            function($){
         		var userstr = '<?php echo my_json_encode($user);?>';
         		if(userstr != ''){
         			var user = $.parseJSON(userstr);
					loginShequ(user, '<?php echo ($jumpUrl); ?>', 1);
         		}
            });
	</script>
</body>
</html>