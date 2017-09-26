<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta name="baidu-site-verification" content="7JiPIVdZ6K" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- 优先使用 IE 最新版本和 Chrome -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <!-- 1:1显示 -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- 忽略页面中的数字识别为电话号码和邮箱 -->
	<meta name="format-detection" content="telephone=no,email=no" />
	<!-- 允许全屏浏览 ios -->
	<meta content="yes" name="apple-mobile-web-app-capable" />
	<!-- 启用360浏览器的极速模式(webkit) -->
    <meta name="renderer" content="webkit">
    <!-- 避免IE使用兼容模式 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 不让百度转码 -->
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!-- 针对手持设备优化，主要是针对一些老的不识别viewport的浏览器，比如黑莓 -->
    <meta name="HandheldFriendly" content="true">
    <!-- 微软的老式浏览器 -->
    <meta name="MobileOptimized" content="320">
    <!-- uc强制竖屏 -->
    <meta name="screen-orientation" content="portrait">
    <!-- QQ强制竖屏 -->
    <meta name="x5-orientation" content="portrait">
	<!-- windows phone 点击无高光 -->
    <meta name="msapplication-tap-highlight" content="no">    
	<meta content="领袖户外" name="author"/>
	<?php if(strpos($_SERVER['HTTP_HOST'], '.kllife.com') !== FALSE): ?><meta name="robots" content="noindex,nofollow"/><?php endif; ?>
	<!--分销标题关键字-->
	<?php if(empty($duid) == false): if(C('MENU_CURRENT') == 'line_content'): ?><title><?php echo ($line["title"]); ?>-<?php echo ($line["subheading"]); ?></title>
		<?php else: ?>
			<title><?php echo ($fxset["shop_title"]["data"]["value"]); ?></title><?php endif; ?>
	<!--特殊专题额济纳标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_ejina'): ?>
		<title>额济纳旅游的首选__领袖户外旅行网__好玩不贵的小团慢旅行</title>
		<meta content="额济纳旅游的首选,领袖户外旅行网,好玩不贵的小团慢旅行" name="title"/>
	    <meta content="额济纳旅游,额济纳旅游攻略,额济纳旅游费用,额济纳旅游价格,额济纳胡杨林,额济纳旅游景点大全" name="keywords"/>
	    <meta content="额济纳旗，掉落在童话里的秋日，颠覆传统旅行方式，化腐朽为神奇的国庆精品线路。领袖户外：好玩不贵的小团慢旅行！,精品小团，享受一次恰到好处的慢旅行！在最美的风景中漫步、深呼吸，为不期而遇的惊艳停车，品味夕阳晨曦的美好，尽可能与美景相拥而眠，旅途中从陌生，变成朋友……" name="description"/>	
	<!--特殊专题新疆标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_xinjiang'): ?>
	    <title>新疆旅游的首选_领袖户外旅行网_好玩不贵的小团慢旅行_领袖户外官方网站</title>	
	    <meta content="新疆旅游的首选,领袖户外旅行网,好玩不贵的小团慢旅行,领袖户外官方网站" name="title"/>
	    <meta content="新疆旅游,新疆旅游攻略,新疆旅游费用,新疆旅游价格,新疆旅游景点大全,新疆驴友网,禾木驴友网,新疆驴友攻略,喀纳斯驴友网,新疆定制游" name="keywords"/>
	    <meta content="新疆旅游攻略，小团慢旅行,新疆自助游攻略，包括小团慢旅行,新疆热门景点、户外俱乐部、游记攻略、出行交通、餐饮等旅游信息，以及小团慢旅行,新疆驴友交流、驴友俱乐部信息。小团慢旅行,新疆旅游怎么订制。" name="description"/>	
	<!--特殊专题丝绸之路标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_silk'): ?>
	    <meta content="青海湖旅游攻略,青海湖旅游价格,敦煌旅游景点,敦煌旅游价格,青海驴友线路,青海驴友攻略,茶卡盐湖门票多钱,茶卡盐湖什么时候去好玩" name="keywords"/>
	    <meta content="300度环青海湖旅行，长达三天湖边游玩时间，避开顶光去茶卡，这是丝绸之路线路中最好的体验。丝绸之路旅游去哪儿玩？领袖户外为您独家定制专属线路,从青海湖到敦煌莫高窟,从嘉峪关到祁连山....更多的西北旅游信息就来领袖户外旅行网。" name="description"/>
		<title>丝绸之路旅游线路推荐-青海驴友俱乐部-甘肃驴友俱乐部-领袖户外旅行网-好玩不贵的小团慢旅行-茶卡盐湖驴友俱乐部</title>	
	<!--特殊专题西北标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_xibei'): ?>
	    <meta content="西北旅游,西北旅游线路,西北摄影旅游,青海湖旅游,青海湖旅游线路,青海湖摄影旅游,额济纳旅游线路,额济纳摄影旅游,额济纳旅游,额济纳旅游线路,额济纳摄影旅游,甘肃旅游,甘肃旅游线路,甘肃摄影旅游" name="keywords"/>
	    <meta content="西北摄影旅游去哪儿玩？领袖户外为您独家定制专属线路,从青海湖到敦煌莫高窟,从嘉峪关到祁连山....更多的西北旅游信息就来路星河" name="description"/>
		<title>西北旅游-青海湖旅游-额济纳旅游-甘肃旅游-西北旅游线路推荐-领袖户外</title>
	<!--特殊专题川西标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_chuanxi'): ?>
	    <meta content="川西旅游,甘南旅游,川西甘南" name="keywords"/>
	    <meta content="川西甘南旅游推荐，色达甘南稻城亚丁，你无法拒绝的美景" name="description"/>
		<title>川西甘南-川西甘南大环线-川西甘南景点推荐-领袖户外旅游网</title>	
	<!--特殊专题brand标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_brand'): ?>
	    <meta content="领袖户外,发展历程,品牌故事,联系方式" name="keywords"/>
	    <meta content="领袖户外成立于2005年，致力于为客户提供小团慢旅行、摄影游、户外游以及定制游等旅游产品。领袖户外以“享受旅行，品味人生”为愿景，以“为用户提供参与感强体验度高的旅行”为使命，精心为游客提供深度旅行服务。" name="description"/>
		<title>领袖户外品牌故事-领袖户外发展历程-领袖户外联系方式-领袖户外旅行网-驴友网</title>
	<!--通用标题关键字-->
	<?php elseif(empty($PageKeyword) == false): ?>
		<meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
		<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
		<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
		<title><?php echo ($PageKeyword["title"]); ?></title>	
	<?php else: ?>
		<title><?php echo C('PAGE_TITLE');?>-领袖户外</title><?php endif; ?>
	
	<link rel="stylesheet" href="/source/Static/phone/common/css/light7.css">
	<link rel="stylesheet" href="/source/Static/common/css/common.css">
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="/source/Static/common/js/jquery-1.11.1.min.js"></script>
	<script src="/source/Static/common/js/functions.js"></script>

	<!-- jq -->
	<!--<script src="/source/Static/phone/common/js/jquery.min.js"></script>-->
	<style>
		.black-mark { display: none; position: fixed; top:0; left:0; width: 100%; height: 100%; text-align: center; color:#ececec; background: rgba(0,0,0,.5); z-index:3000; }
		.black-mark p { margin-top: 230px; color: #fff; text-align: center; }
	</style>
	<script>			
		function ShowMark(){
			$('.black-mark').show();
		};
		function HideMark(){
			$('.black-mark').hide();
		};		
	</script>
</head>
<body>
	<div class="black-mark">
		<p>稍等一会儿...</p>
	</div>
	<!-- mycss -->
	<link rel="stylesheet" href="/source/Static/phone/css/user_login.css">
	

<!-- light7 -->
<script src="/source/Static/phone/common/js/light7.js"></script>
<!-- i18n 中文 -->
<script src="/source/Static/phone/common/js/cn.js"></script>
<!--公用JS文件-->
<script src="/source/Static/common/js/functions.js"></script>

<script>		
    //加载指示
    function PageLoading() {
    	this.loaded = false;
    }
    
    PageLoading.prototype.isLoading = function () {
    	return this.loaded;
    }
    
    PageLoading.prototype.loading = function (bshow, bstyle) {
    	this.loaded = bshow;
    	if (bstyle == null || bstyle == true) {
	    	if (bshow) {
	       		$.showPreloader();
	    	} else {
	            $.hidePreloader();	
	    	}
    	}
    }
</script>
	<style>
.stage{position:relative;padding: 0 15px;height:55px;}
.slider{position:absolute; width: 200px; height:32px;box-shadow:0 0 3px #999;background-color:#ddd;left:6px;top:-17px;}
.slider-text {
    background: -webkit-gradient(linear, left top, right top, color-stop(0, #4d4d4d), color-stop(.4, #4d4d4d), color-stop(.5, white), color-stop(.6, #4d4d4d), color-stop(1, #4d4d4d));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    -webkit-animation: slidetounlock 3s infinite;
    -webkit-text-size-adjust: none;
    line-height: 32px;
    height: 32px;
    text-align: center;
    font-size: 16px;
    width: 200px;
    color: #aaa;
}
@keyframes slidetounlock
{
    0%     {background-position:-200px 0;}
    100%   {background-position:200px 0;}
}
@-webkit-keyframes slidetounlock
{
    0%     {background-position:-200px 0;}
    100%   {background-position:200px 0;}
}
.button-off{
    position: absolute;
    left: 0;
    top: 0;
    width: 32px;
    height: 32px;
    background-color: #fff;
    transition: left 0s;
    -webkit-transition: left 0s;
}
.button-on{
    position: absolute;
    left: 0;
    top: 0;
    width: 32px;
    height: 32px;
    background-color: #fff;
    transition: left 1s;
    -webkit-transition: left .5s;
}
.track{
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 0;
    overflow: hidden;
    transition: width 0s;
    -webkit-transition: width 0s;
    z-index: 10;
}
.track-on{
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 0;
    overflow: hidden;
    transition: width 1s;
    -webkit-transition: width .5s;
}
.icon-move  {
    width: 32px;
    height: 32px;
    position: relative;
    top:1px;
    left:0;
    font-family: sans-serif;
}
.icon-move:before{
    content:'>>';
    color:#ccc;
    line-height:32px;
}
.spinner {
    width: 20px;
    height: 20px;	
	background: url('/source/Static/phone/images/order_create/code_ok.png') no-repeat;
    position: relative;
    top:6px;
    left:6px;
    background-size: 100% 100%;
    display: none;
}

@-webkit-keyframes bouncedelay {
    0%, 80%, 100% { -webkit-transform: scale(0.0) }
    40% { -webkit-transform: scale(1.0) }
}
@keyframes bouncedelay {
    0%, 80%, 100% {
        transform: scale(0.0);
        -webkit-transform: scale(0.0);
    } 40% {
          transform: scale(1.0);
          -webkit-transform: scale(1.0);
      }
}
.bg-green {
    line-height: 32px;
    height: 32px;
    text-align: center;
    font-size: 16px;
    background-color: #78c430;
}
.bg-red{background-color: rgb(255, 223, 223) !important;}
</style>
	<div class="page page-current" id="router">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="#">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">第三方登录绑定领袖户外账号</h1>
		</header>
			    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>游记</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a>
	    	<?php else: ?>
			    <a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a><?php endif; ?>
		</nav>
		<!--<script src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>-->
		<script type="text/javascript">
//            jQuery(document).ready(function($){
//                $("img").lazyload({
//                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
//                    effect      : "fadeIn",
//                    threshold : 0,
//                    failure_limit : 10,
//                    skip_invisible : false
//                });
//            });

			$('nav').find('a:last-child').click(function(){
				$.post('<?php echo U("index/url");?>', {type:'nav_mine'}, function(data){
					if (data.result.errno == 0) {
						if (data.jumpUrl != null) {
							location.href = data.jumpUrl;
						}
					} else {
						alert(data.result.message);
					}
				});
			});
		</script>
		<div class="content">
			<input type="hidden" name="logintype" id="logintype" value="<?php echo ($type); ?>" />
			<input type="hidden" name="openid" id="openid" value="<?php echo ($openid); ?>" />
			<div class="login-header">
				<div class="login-header-img">
					<img src="/source/Static/phone/images/user_login/myhead.png" alt="">				    
				</div>
				<div class="buttons-tab set-bind">
					<a href="" id="tab-bot-1" class="tab-link active button">查找帐号</a>
					<a href="" id="tab-bot-2" class="tab-link button">绑定帐号</a>
				</div>
				
				<div class="buttons-tab set-password" style="display: none;">
					<a href="" class="tab-link active button">设置密码</a>
				</div>
				
				<div class="tabs">
					<div id="tab1" class="tab active">
						
						<p class="arrow-up"></p>
						
						<div class="list-block">
							<div class="item-content">
								<div class="item-inner">
									<div class="item-input">
							  			<input type="text" class="search-account" placeholder="请输入帐号的手机号码/邮箱/用户名">
									</div>
								</div>
				           </div>
				       	</div>				        
				        
						<div class="login-btn">							
							<a class="search-account-btn" href="javascript:;">查找</a>
						</div>
						<div class="register-btn">
							<a class="creat-account" href="javascript:;">没有帐号？跳过，创建>></a>
						</div>
						
					</div>
					<div id="tab2" class="tab">
						
						<p class="arrow-up"></p>
						
						<div class="list-block">
							<div class="item-content">
								<div class="item-inner">
									<div class="item-input">
							  			<input type="checkbox" class="is_bind">
										<p class="show_name"></p>
										<input type="hidden" name="userid" id="userid" value="" />
									</div>
								</div>
				           </div>
				       	</div>
				       	
				       	<div class="login-btn" id="bind-account-box">							
							<a class="bind-account" href="javascript:;">绑定并登录</a>							
						</div>
						<div class="login-btn" id="creat-account-box">							
							<a class="creat-account" href="javascript:;">跳过，创建新账号并登录</a>							
						</div>
						<div class="register-btn">
							<a class="return-search" href="javascript:;"><<返回上一步</a>
						</div>
						
					</div>
					
					<div id="tab3" class="tab">
						
			            <div class="list-block">
							<div class="item-content">
								<div class="item-inner">
									<div class="item-input">
							  			<input type="text" class="nick_name" placeholder="一个个性的昵称">
									</div>
								</div>
				           </div>
				       	</div>
				       	<div class="list-block">
							<div class="item-content">
								<div class="item-inner">
									<div class="item-input">
							  			<input type="password" class="login_password" placeholder="一个安全的密码">
									</div>
								</div>
				           </div>
				       	</div>	
						
						<div class="list-block">
							<div class="item-content">
								<div class="item-inner">
									<div class="item-input">
							  			<input type="password" class="confirm_password" placeholder="安全的密码一定要输入两遍">
									</div>
								</div>
				           </div>
				       	</div>	
			
			            
			            <div class="login-btn">							
							<a class="creat-account-btn" href="javascript:;">创建并登录</a>
						</div>
						
						
					</div>
					
					<div class="login-btn">							
						<a class="bind-return" href="javascript:;">返回账号登录>></a>
					</div>
			    </div>

			</div>
		</div>
	</div>

	<script src="/source/Static/common/js/verify.js" > </script>
	<script type="text/javascript">
		//跳转到帐号登录
		$('.bind-return').click(function(){
			location.href = '<?php echo U("user/login");?>';
		});
		
		//查找帐号
		$('.search-account-btn').click(function(){
			$('#userid').val('');
			var jsonData = {
				account: $('.search-account').val(),
			};
			$.post('<?php echo U("thirdLogin/findUser");?>', jsonData, function(data){
				$('#tab1').removeClass('active');
				$('#tab-bot-1').removeClass('active');
				$('#tab2').addClass('active');
				$('#tab-bot-2').addClass('active');
				if(data.result.errno == 0){
					$('.is_bind').attr("checked", true);
					$('.show_name').html(data.user.show_name);
					$('#userid').val(data.user.id);
					$('#creat-account-box').css('display', 'none');
					$('#bind-account-box').css('display', 'block');
				}else{
					$('.is_bind').css("display", 'none');
					$('.show_name').html('未找到相关信息');
					$('#creat-account-box').css('display', 'block');
					$('#bind-account-box').css('display', 'none');
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
			$.post('<?php echo U("thirdLogin/bindAccount");?>', jsonData, function(data){
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
			
			$.post('<?php echo U("thirdLogin/bindAccount");?>', jsonData, function(data){
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
				$('#creat-account-box').css('display', 'none');
				$('#bind-account-box').css('display', 'block');
			}else{				
				$('#creat-account-box').css('display', 'block');
				$('#bind-account-box').css('display', 'none');
			}
		});
		
		//返回上一步
		$('.return-search').click(function(){
			$('#tab1').addClass('active');
			$('#tab-bot-1').addClass('active');
			$('#tab2').removeClass('active');
			$('#tab-bot-2').removeClass('active');
		});
		
		//创建帐号登录填写密码
		$('.creat-account').click(function(){
			$('#tab1').removeClass('active');
			$('#tab2').removeClass('active');
			$('.set-bind').css('display', 'none');
			$('.set-password').css('display', 'block');
			$('#tab3').addClass('active');
		});
		
		//改变时清楚出错格式
		$('.login_password').keyup(function(){
			$(this).removeClass('bg-red');
		});
		$('.confirm_password').keyup(function(){
			$(this).removeClass('bg-red');
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