<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<!-- iPhone 手机上设置手机号码不被显示为拨号链接 -->
	<meta name="format-detection" content="telephone=no" />
	<meta content="telephone=no, address=no" name="format-detection" />
	<!--  IOS私有属性，可以添加到主屏幕 -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!--  IOS私有属性，网站开启对 web app 程序的支持 -->
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<title>领袖户外</title>
	<link rel="stylesheet" href="/source/Static/phone/css/bootstrap.min.css">
	<link rel="stylesheet" href="/source/Static/phone/css/datepicker.min.css">
	<link rel="stylesheet" href="/source/Static/phone/css/dingzhi.css">
	<script src="/source/Static/phone/common/js/jquery-1.11.3.min.js"></script>
	<script src="/source/Static/phone/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
      <script src="/source/Static/phone/js/html5shiv.js"></script>
      <script src="/source/Static/phone/js/respond.js"></script>
    <![endif]-->
	<style>#footer{position: fixed;bottom:0px;width:100%;}</style>
</head>
<body class="page-body">
	<!-- 头部 -->
	<header id="header">
		<nav id="nav">
			<div class="nav-left">
				<a href="<?php echo U('index/welcome');?>"></a>
			</div>
		</nav>
	</header>
	
	<!-- 主体 -->
	<section id="section">
		<!-- 大图 -->
		<div class="swiper-container"></div>
		<div class="main">
			<div class="xinxi">
				<h4>玩你想玩，玩你精彩</h4>
				<input type="text" id="name" placeholder="姓名">
				<input type="text" id="mudidi" placeholder="目的地">
				<!--<input type="text" id="riqi" placeholder="出团日期">
				<input type="text" id="tianshu" placeholder="天数">-->
				<input type="number" id="renshu" placeholder="参团人数">
				<input type="text" id="shouji" placeholder="手机">
				<!-- <input type="text" id="yanzhengma" placeholder="验证码"> -->
				<!-- <button disabled="disabled" onclick="sendMessage()" id="send_verify_code">获取验证码</button> -->
				<textarea name="comment" id="comment" placeholder="备注内容"></textarea>
				<a class="begin" href="javascript:;">开始我的定制</a>
			</div>
		</div>
	</section>	

	<!-- 底部 -->
	<footer id="footer">
		<a href="tel:4000805860" style="color: #fff; display: block; padding-top: 20px; margin-bottom: 5px;">点击拨打联系电话 400-080-5860</a>
		<p>Copyright © 2006-2014 kllife.com</p>
		<p>领袖户外经营许可证号：L-SNX00306 陕ICP备14011728号-1 </p>
	</footer>
	<!-- 遮罩层 -->
	<div class="mark"></div>
	<!-- 提交成功 -->
	<div class="success">
		<h2>提交成功</h2>
		<img src="/source/Static/phone/images/dzzt/icon_success.png" alt="提交成功">
		<p>领袖的旅行顾问将尽快与您取得联系,</p>
		<p>您也可直接拨打 400-080-5860 查询预订进展</p>
		<a class="success-sure" href="javascript:;">确定</a>
	</div>
	<!-- 提交失败-->
	<div class="lose">
		<h2>提交失败</h2>
		<p>请保证您的信息正确且完整!</p>
		<a class="lose-sure" href="javascript:;">确定</a>
	</div>




	<script>
		
			var isMobile = /^(?:13\d|15\d|18\d|17\d|14\d)\d{5}(\d{3}|\*{3})$/; //手机号码验证规则
			//获取验证码
			var InterValObj; //timer变量，控制时间
			var count = 60; //间隔函数，1秒执行
			var curCount;//当前剩余秒数
			$('#shouji').on('input propertychange',function(){
				//手机号的判断
				if( isNaN($.trim($("#shouji").val())) || $.trim($("#shouji").val()).length != 11 || !isMobile.test($("#shouji").val())) {
					$('#send_verify_code').css('background','#ccc');
				}else {
					$('#send_verify_code').css('background','#f90');
					$('#send_verify_code').attr('disabled',false);
				};
			})
			
			function sendMessage() {
				curCount = count;
			　　//设置button效果，开始计时
				$("#send_verify_code").attr("disabled", "true");
				$("#send_verify_code").text("请在" + curCount + "秒内输入");
				$('#send_verify_code').css('background','#ccc');
				InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
			　　  //向后台发送处理数据
				$.ajax({
		　　		type: "POST", //用POST方式传输
		　　		dataType: "", //数据格式:JSON
		　　		url: '', //目标地址
		　　 		data:'',
		　　		success: function (msg){
					}
				});
			};
			//timer处理函数
			function SetRemainTime() {
				if (curCount == 0) {                
					window.clearInterval(InterValObj);//停止计时器
					$("#send_verify_code").removeAttr("disabled");//启用按钮
					$('#send_verify_code').css('background','#f90');
					$("#send_verify_code").text("重新发送");
				}
				else {
					curCount--;
					$("#send_verify_code").attr("disabled", "disabled");
					$('#send_verify_code').css('background','#ccc');
					$("#send_verify_code").text("请在" + curCount + "秒内输入");
				};
			};
			//提交按钮
			$('.begin').click(function(){
				//提交失败
				if($.trim($('#name').val()) == '' || $.trim($('#mudidi').val()) == '' || $.trim($('#shouji').val()) == '' || (!isMobile.test($.trim($('#shouji').val())))){
					$('.lose').fadeIn(1000);
					$('.mark').fadeIn(1000);
					$('.lose-sure').click(function(){
						$('.lose').fadeOut(1000);
						$('.mark').fadeOut(1000);
					});
				}else {
					//提交成功
					//提交数据
					var jsonData = {
						'linkman': $('#name').val(),
						'tel': $('#shouji').val(),
//						'days': $('#tianshu').val(),
//						'start_date': $('#riqi').val(),
						'member_count': $('#renshu').val(),
						'destination': $('#mudidi').val(),
						'other_request': $('#comment').val()
					};
		    		$.ajax({
						url: "<?php echo U('line/book');?>",
			            type: "post",
			            dataType: 'json',
			            data: jsonData,
			            success: function (data) {
							if (data.result.errno == 0){
								//提交成功
								$('.success').fadeIn(1000);
								$('.mark').fadeIn(1000);
								$('.success-sure').click(function(){
									$('.success').fadeOut(1000);
									$('.mark').fadeOut(1000);
								})
							} else {
								alert(data.result.message);
							}
			            }
			            
		    		});
				}
			});
		
		
	</script>
<!--百度统计-->
<script>
	var _hmt = _hmt || [];
	(function() {
		var hm = document.createElement("script");
		hm.src = "//hm.baidu.com/hm.js?a6f69a2a062b07c67a4ae301e0963ca8";
		var s = document.getElementsByTagName("script")[0]; 
		s.parentNode.insertBefore(hm, s);
	})();
</script> 
<!--商务通统计-->
<script language="javascript" src="http://pqt.zoosnet.net/JS/LsJS.aspx?siteid=PQT43116159&lng=cn"></script>
<!--CNZZ统计-->
<script type="text/javascript">
	var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
	document.write(unescape("%3Cdiv id='cnzz_stat_icon_1000019958'%3E%3C/div%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1000019958%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>