<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title></title>
<meta name="" content="">
<script src="http://open.web.meitu.com/sources/xiuxiu.js" type="text/javascript"></script>
<script type="text/javascript">
	window.onload=function(){
		/*第1个参数是加载编辑器div容器，第2个参数是编辑器类型，第3个参数是div容器宽，第4个参数是div容器高*/
		xiuxiu.embedSWF("upload_face",5,"100%","100%");
		//修改为您自己的图片上传接口
		xiuxiu.setUploadURL("<?php echo ($upload_url); ?>");
		xiuxiu.setUploadType(2);
		xiuxiu.setUploadDataFieldName("face_file");
		xiuxiu.onInit = function ()
		{
			xiuxiu.loadPhoto("http://open.web.meitu.com/sources/images/1.jpg");//修改为要处理的图片url
		}
		xiuxiu.onUploadResponse = function (data)
		{
		//alert("上传响应" + data); 可以开启调试
			console.log(JSON.stringify(data));
		}
	}
</script>
<body>
	<div id="upload_face"></div>
	<input type="file" name="face_file" id="face_file"/>
</body>
</html>