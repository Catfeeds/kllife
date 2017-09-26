<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
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
    
	<meta content="新旅拍" name="author"/>
	<?php if(empty($PageKeyword) == false): ?><meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
	<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
	<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
	<title><?php echo ($PageKeyword["title"]); ?></title>
	<?php else: ?>
	<title><?php echo C('PAGE_TITLE');?>-新旅拍</title><?php endif; ?>
	<!-- jq -->
	<script src="http://kllife.com/source/Static/phone/common/js/jquery.min.js"></script>
	<script type="text/javascript">	
		function ShowMark(){
			$('.black-mark').show();
		};
		function HideMark(){
			$('.black-mark').hide();
		};	
	</script>
	
	<link rel="stylesheet" href="http://kllife.com/source/Static/phone/common/css/light7.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/common/css/common.css">
	<!-- Imported toastr -->
	<script src="http://kllife.com/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="http://kllife.com/source/Static/common/js/jquery-1.11.1.min.js"></script>
	<script src="http://kllife.com/source/Static/common/js/functions.js"></script>
	<style>
		.black-mark { display: none; position: fixed; top:0; left:0; width: 100%; height: 100%; text-align: center; color:#fff; background: rgba(0,0,0,.5); z-index:3000; }
		.black-mark p { margin-top: 230px; color: #fff; text-align: center; }
	</style>
</head>
<body>
	<div class="black-mark">
		<p>稍等一会儿...</p>
	</div>
<!-- mycss -->
<link rel="stylesheet" href="http://kllife.com/source/Static/phone/css/order_create.css">
<link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/common/css/animate.css">
<link rel="stylesheet" href="http://kllife.com/source/Static/qlpphone/common/css/top2.css">
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
.contact-information .list-block .get-code{background: #ff1c77;}
.travel-people-information .content-padded > p,.change-people-num span{color:#ff1c77;}
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
    left:10px;
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
	background: url('http://kllife.com/source/Static/phone/images/order_create/code_ok.png') no-repeat;
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
.content{top:60px;width:100%;}
</style>
	<div class="page">
		<div class="header">
    <div class="menu animated bounceInLeft">
        <!--<i class="iconfont">&#xe603;</i>-->
    </div>
    <div class="logo"><a href="javascript:;"><img style="width:155px;" class="animated bounceInDown" src="http://kllife.com/source/Static/qlpphone/common/images/logo-qinglvpai.png" alt=""></a></div>
    <div class="search animated bounceInRight">
        <!--<i class="iconfont">&#xe67a;</i>-->
    </div>
    <div class="search-block">
        <div class="input-group" style="text-align: center">
            <input type="text" class="form-control" placeholder="特惠线路...">
            <span class="input-group-btn">
                        <button class="btn btn-orange-one" type="button">搜索</button>
                    </span>
        </div>
    </div>
    <div class="top">
        <div class="menu-block">
            <ul>
                <a href="<?php echo U('index/welcome');?>" external><li>首页</li></a>
                <a href="javascript:;" external><li>品牌故事</li></a>
                <a href="<?php echo U('line/list');?>" external><li>新旅拍</li></a>
                <a href="http://kllife.com/phone/index.php?s=/phone/line/list" external><li>小团慢旅行</li></a>
                <a href="<?php echo U('Leader/list');?>" external><li>摄影师</li></a>
                <!--<a href="<?php echo U('line/artile');?>" external><li>线路回顾</li></a>-->
            </ul>
        </div>
    </div>
</div>
		<nav class="bar bar-tab">
		    <a class="tab-item active" style="width: 2%; color: #000;" href="#">
		      <span>总价 <strong style="color: #ff1c77; font-size: 1.25rem;">￥</strong><strong class="total_money" style="color: #ff1c77; font-size: 1.25rem;">0</strong></span>
		    </a>
		    <a id="comfirm_order" class="tab-item" style="background-color: #ff1c77; color: #fff;" href="javascript:;" external>
		      <span>提交订单</span>
		    </a>
		</nav>
		<div class="content">
			<div class="order-write">
				<div class="order-write-information">
					<h4> <?php echo ($line["title"]); ?></h4>
					<p class="err_msg"></p>
					<div class="list-block">
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">出发日期：</div>
								<div class="item-input">
									<input id="batch_select" class="batch_select" type="text" readonly data-id="<?php echo ($cur_batch["id"]); ?>" value="<?php echo ($cur_batch["start_date_show"]); ?>至<?php echo ($cur_batch["end_date_show"]); ?>">
								</div>
							</div>
						</div>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label"></div>
								<div class="item-input">
									<p class="cur_sel_batch">* <?php echo ($cur_batch["start_date_show"]); ?>出发 , <?php echo ($cur_batch["end_date_show"]); ?>返回 </p>
								</div>
							</div>
						</div>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">线路价格：</div>
								<div class="item-input">
									<span class="price_adult">￥<?php echo ($cur_batch["price_adult"]); ?>/成人</span>
									<span class="price_child">￥<?php echo ($cur_batch["price_child"]); ?>/儿童</span>
								</div>
							</div>
						</div>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">出游人数：</div>
								<div class="item-input">
									<div class="people-num">
										<div class="row">
											<?php if(empty($check['only_child']) == true): ?><div class="col-50">
													<div class="change-people-num adult_man" data-type="adult_man">
														<a href="javascript:;" external>-</a>
														<span><?php echo ($member_male_count); ?></span>
														<a href="javascript:;" external>+</a>
													</div>	
													成人男
												</div>
												<div class="col-50">
													<div class="change-people-num adult_woman" data-type="adult_woman">
														<a href="javascript:;" external>-</a>
														<span><?php echo ($member_woman_count); ?></span>
														<a href="javascript:;" external>+</a>
													</div>
													成人女
												</div><?php endif; ?>
											<?php if(empty($check['only_adult']) == true): ?><div class="col-90">
													<div class="change-people-num child" data-type="child">
														<a href="javascript:;" external>-</a>
														<span><?php echo ($member_child_count); ?></span>
														<a href="javascript:;" external>+</a>
													</div>
													儿童
												</div><?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- 联系人信息 -->
				<div class="contact-information">
					<h5><img src="http://kllife.com/source/Static/qlpphone/images/create/sublist_logo.png" alt="">联系人信息</h5>
					<div class="content-padded">
						<div class="list-block">
							<div class="item-inner">
								<div class="item-title label">姓名：</div>
								<div class="item-input">
									<input id="contact_name" type="text" placeholder="请输入您的姓名">
								</div>
							</div>
							<div class="item-inner">
								<div class="item-title label">联系电话：</div>
								<div class="item-input">
									<input id="contact_phone" type="text" placeholder="请输入您的联系电话">
								</div>
							</div>
							<div class="item-inner">
								<div class="item-title label">验证码：</div>
								<div class="item-input">
									<div class="slider" id="slider">
										<div class="slider-text">向右滑动验证</div>
										<div class="track" id="track">
											<div class="bg-green"></div>
										</div>
										<div class="button-off" id="btn">
											<div class="icon-move" id="icon"></div>
											<div class="spinner" id="spinner"></div>
										</div>
									</div>
								</div>
							</div>
							<?php if(empty($user) == true): ?><div class="item-inner">
									<div class="item-title label">校验码：</div>
									<div class="item-input">
										<input id="contact_verify_code" type="text" placeholder="请输入校验码">
										<input id="btnSendCode" class="get-code" type="button" value="发送校验码" readonly="">
										<span id="contact_result"></span>
									</div>
								</div><?php endif; ?>
						</div>
					</div>
				</div>


				<!-- 旅客信息 -->
				<div class="passenger-information">
					<h5><img src="http://kllife.com/source/Static/qlpphone/images/create/sublist_logo.png" alt="">旅客信息</h5>
					<div class="list-block">
						
					</div>
				</div>


				<!-- 出游人信息 -->
				<div class="travel-people-information">
					<h5>出游人信息</h5>
					<div class="content-padded">
						<div class="travel-people-list old-man">
							出游人中是否有60周岁(含)至80周岁(不含)的老人？
							<p><span data-id="1"><img src="http://kllife.com/source/Static/phone/images/order_create/no_checked.png" alt="">有</span><span class="has-checked" data-id="0"><img src="http://kllife.com/source/Static/qlpphone/images/create/checked.png" alt="">没有</span></p>
						</div>
						<div class="travel-people-list foreign-man">
							出游人中是否有港澳同胞？
							<p><span data-id="1"><img src="http://kllife.com/source/Static/phone/images/order_create/no_checked.png" alt="">有</span><span class="has-checked" data-id="0"><img src="http://kllife.com/source/Static/qlpphone/images/create/checked.png" alt="">没有</span></p>
						</div>
						<div class="travel-people-list gat-man">
							出游人中是否有外籍友人？
							<p><span data-id="1"><img src="http://kllife.com/source/Static/phone/images/order_create/no_checked.png" alt="">有</span><span class="has-checked" data-id="0"><img src="http://kllife.com/source/Static/qlpphone/images/create/checked.png" alt="">没有</span></p>
						</div>
						<p>本产品不支持孕妇或者80周岁(含)以上的老人出游，18周岁以下的未成年人必须有成年人陪同出游，敬请谅解！</p>
					</div>
				</div>
			</div>
		</div>
	</div>



<!-- light7 -->
<script src="http://kllife.com/source/Static/phone/common/js/light7.js"></script>
<!-- i18n 中文 -->
<script src="http://kllife.com/source/Static/phone/common/js/cn.js"></script>
<!--公用JS文件-->
<script src="http://kllife.com/source/Static/common/js/functions.js"></script>
<!--商务通代码--> 
<script language="javascript" src="http://pqt.zoosnet.net/JS/LsJS.aspx?siteid=PQT43116159&lng=cn"></script>
<script language="javascript" type="text/javascript" src="http://kllife.com/swt_xlp/js/swt.js"></script>
<!--CNZZ统计--> 
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1261595265'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1261595265%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
<!--百度统计-->
<script>
	var _hmt = _hmt || [];
	(function() {
		var hm = document.createElement("script");
		hm.src = "https://hm.baidu.com/hm.js?5b19bad2c5e7328683965e7447d46f4c";
		var s = document.getElementsByTagName("script")[0]; 
		s.parentNode.insertBefore(hm, s);
	})();
</script>
<script>
	$(function(){
		$.init();
		
		//验证码
		
	    var oBtn = document.getElementById('btn');
	    var oW,oLeft;
	    var oSlider=document.getElementById('slider');
	    var oTrack=document.getElementById('track');
	    var oIcon=document.getElementById('icon');
	    var oSpinner=document.getElementById('spinner');
		var flag=1;
		//限制最大宽度
		var oWidth = $('.slider').width();
	 
	    oBtn.addEventListener('touchstart',function(e){
			if(flag==1){
				console.log(e);
				var touches = e.touches[0];
				oW = touches.clientX - oBtn.offsetLeft;
				oBtn.className="button-off";
				oTrack.className="track";
			}
	        
	    },false);
	 
	    oBtn.addEventListener("touchmove", function(e) {
			if(flag==1){
				var touches = e.touches[0];
				oLeft = touches.clientX - oW;
				if(oLeft < 0) {
					oLeft = 0;
				}else if(oLeft > oWidth - oBtn.offsetWidth) {
					oLeft = (oWidth - oBtn.offsetWidth);
				}
				oBtn.style.left = oLeft + "px";
				oTrack.style.width=oLeft+ 'px';			
			}
	        
	    },false);
	 
	    oBtn.addEventListener("touchend",function() {
	        if(oLeft>= oWidth - oBtn.clientWidth ){
	            oBtn.style.left = (oWidth - oBtn.offsetWidth);
	            oTrack.style.width= (oWidth - oBtn.offsetWidth);
	            oIcon.style.display='none';
	            oSpinner.style.display='block';				
				flag=0;			
	        }else{
	            oBtn.style.left = 0;
	            oTrack.style.width= 0;
	        }
	        oBtn.className="button-on";
	        oTrack.className="track-on";       
	    },false);
 
    

		
		$('.travel-people-list span').click( function (){
			$(this).addClass('has-checked');
			$(this).siblings().removeClass('has-checked');
			$(this).children('img').attr('src','http://kllife.com/source/Static/qlpphone/images/create/checked.png');
			$(this).siblings().children('img').attr('src','http://kllife.com/source/Static/phone/images/order_create/no_checked.png');
		} );
				
		
		// 计算总价
		function calcTotalMoney() {
			var adultCount = 0, childCount = 0;
			$('.change-people-num').each(function(i, ev){
				if ($(this).hasClass('child')) {
					childCount += parseInt($(this).find('span').html());
				} else {
					adultCount += parseInt($(this).find('span').html());
				}
			});
			
			var jsonData = {
				op_type: 'calc_money',
				batch_id: $('#batch_select').attr('data-id'),
				adult_count: adultCount,
				child_count: childCount,
			}
			
			$.post('<?php echo U("line/order");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					if (data.batch != null && data.batch != 'undefined') {
						$('.price_adult').html('￥'+data.batch.price_adult+'/成人');
						$('.price_child').html('￥'+data.batch.price_child+'/儿童');
					}
					
					if (data.money != null && data.money != 'undefined') {
						$('.total_money').html(data.money.cut);
						$('.total_money').attr('data-no-cut',data.money.full);
					} else {				
						$('.total_money').html(0);
						$('.total_money').attr('data-no-cut',0);
					}
				} else {
					alert(data.result.message);
				}
			});			
		}
			
		// 添加筛选条件
		var prevSelect = {};
		function attachSelect(obj, title, data) {
			var ds = $.parseJSON(data);
			var ids = [], vals = [], invalids = [], uses = [];
			for (var i = 0; i < ds.length; i ++) {
				ids.push(ds[i].id);
				vals.push(ds[i].text);
				invalids.push(ds[i].invalid);
				uses.push(ds[i].use);
			}
			
			$(obj).picker({
				toolbarTemplate:'<header class="bar bar-nav">'+
								'	<button class="button button-link pull-right close-picker">确定</button>'+
								'	<h1 class="title">'+title+'</h1>'+
								'</header>',
				cols: [{
					textAlign:'center',
					values: vals,
				}],
				onOpen: function() {
					var itemsObj = $('.picker-item');
					for (var i = 0; i < $(ids).length; i++) {
						$(itemsObj[i]).attr('data-val', ids[i]);
						if ($(obj).hasClass('batch_select')) {
							$(itemsObj[i]).attr('data-invalid', invalids[i]);
							$(itemsObj[i]).attr('data-use', uses[i]);
						}
					}
					if ($(obj).hasClass('batch_select')) {
						prevSelect['id'] = $(obj).attr('data-id');
						prevSelect['value'] = $(obj).val();
					}
				},
				onClose: function(){
					if ($('.picker-selected').length > 0) {
						if ($(obj).hasClass('batch_select')) {
							if ($('.picker-selected').attr('data-invalid') == 1) {
								$(obj).attr('data-id', prevSelect.id);
								$(obj).val(prevSelect.value);
								$('.err_msg').html('该批次已过期报名时间，详情请咨询客服MM');
								return false;
							}
							if ($('.picker-selected').attr('data-use') == 0) {
								$(obj).attr('data-id', prevSelect.id);
								$(obj).val(prevSelect.value);
								$('.err_msg').html('该批次已被禁用或已经下架，详情请咨询客服MM');
								return false;
							}
							$('.err_msg').html('');
						}
						// 设置选中的编号
						var dataVal = $('.picker-selected').attr('data-val');
						$(obj).attr('data-id', dataVal);			
						// 特殊处理批次选择
						if ($(obj).hasClass('batch_select')) {
							var dates = $(obj).val().split('至');
							$('.cur_sel_batch').html('* '+dates[0]+'出发 , '+dates[1]+'返回');
							//  重新计算价格
							calcTotalMoney();
						}
					}
				}
			});			
		}
			
		// 批次选择
		attachSelect('#batch_select', '选择您的出发日期', '<?php echo ($batch_list); ?>');
		
		// 移除参团人信息
		$('.change-people-num a:first-child').click( function () {			
			//判断原本span中的值，小于0则不在计算
			if( parseInt($(this).next('span').html()) <= 0 ){
				return;
			}else {
				$(this).next('span').html( parseInt($(this).next('span').html()) - 1 );
				// 删除最后一个该类型的旅客信息
				var memberType = $(this).closest('.change-people-num').attr('data-type');
				$('.passenger-information').find('.'+memberType+':last').closest('.passenger-information-list').remove();
				// 刷新参团人编号
				$('.passenger-information-list').find('.sort').each(function(i, ev){
					$(this).html(i+1);	
				});
				// 重新核实总价
				calcTotalMoney();
			}
		} );
		
		// 添加参团人信息
		function appendMemberHtml(memberType) {
			//声明旅客人数
			var spanNum = $('.passenger-information-list').length + 1;
			// 游客类型
			var mt = null;
			var memberTypes = $.parseJSON('<?php echo ($member_types); ?>');
			for (var i = 0; i < $(memberTypes).length; i ++) {
				var t = memberTypes[i];
				if (t.type_key == memberType) {
					mt = t;
				}
			}
			//添加
			var passengerHtml = '<div class="passenger-information-list">'
									+'<div class="item-inner">'
										+'<div class="item-title label">游客<span class="sort">'+ spanNum +'</span>：</div>'
										+'<div class="item-input">'
											+'<input class="name" type="text" placeholder="请输入您的真实姓名">'
										+'</div>'
									+'</div>'
									+'<div class="item-inner">'
										+'<div class="item-title label">游客类型：</div>'
										+'<div class="item-input">'
											+'<span class="member_type '+mt.type_key+'" data-id="'+mt.id+'">'+mt.type_desc+'</type>'
										+'</div>'
									+'</div>'
									+'<div class="item-inner">'
										+'<div class="item-title label">证件类型：</div>'
										+'<div class="item-input">'
											+'<input class="cert" type="text" placeholder="请选择您的证件类型" readonly="">'
										+'</div>'
									+'</div>'
									+'<div class="item-inner">'
										+'<div class="item-title label">证件号码：</div>'
										+'<div class="item-input">'
											+'<input class="cert_num" type="text" placeholder="请输入您的证件号码">'
										+'</div>'
									+'</div>'
									+'<div class="item-inner">'
										+'<div class="item-title label">联系电话：</div>'
										+'<div class="item-input">'
											+'<input class="tel" type="text" placeholder="请输入您的联系电话">'
										+'</div>'
									+'</div>'
								+'</div>';

			$('.passenger-information .list-block').append(passengerHtml);
			//旅客选择证件
			attachSelect($('.passenger-information-list').find('.cert'), '证件类型', '<?php echo ($certs); ?>');
		}
		
		// 出游人数增加
		$('.change-people-num a:last-child').click( function () {			
			$(this).prev('span').html( parseInt($(this).prev('span').html()) + 1 );
			// 添加参团人
			var memberType = $(this).closest('.change-people-num').attr('data-type');
			appendMemberHtml(memberType);
			// 重新计算总价
			calcTotalMoney();
		} );


		//旅客选择证件（防止子页面刷新）
		attachSelect($('.passenger-information-list').find('.cert'), '证件类型', '<?php echo ($certs); ?>');
		
		// 联系人手机效验码验证
		var IntervalContactSend = 0, sub_send_second = 600, contact_phone='';
		$('#btnSendCode').click(function(data){			
			if ($(this).is(":disabled") == false) {
				contact_phone = $('#contact_phone').val();
				if (checkMobile(contact_phone) == false) {
					alert('电话号码有误');
					return false;
				}
				var jsonData = {
					type: 'send',
					tel: contact_phone,
					use: 'phone_order_contact_phone',
					interval: 600,
					rd: '<?php echo ($pagerd); ?>',
				};
				
				$.post('<?php echo U("common/sms");?>', jsonData, function(data){
					if (data.result.errno == 0) {
						sub_send_second = 600;
						$('#btnSendCode').val(sub_send_second+'秒后重新发送');
						$("#btnSendCode").attr("disabled", "disabled");
						IntervalContactSend = window.setInterval(refreshContactPhoneCode, 1000);
					} else {
						alert(data.result.message);
					}
				});
			} else {
				alert('验证码已经发送，请随后在此发送');
			}
		});
		
		// 刷新发送联系人手机验证码时间
		function refreshContactPhoneCode() {
			if (sub_send_second == 0) {
				window.clearInterval(IntervalContactSend);
				$('#btnSendCode').val('发送验证码');
				$('#btnSendCode').removeAttr('disabled');
			} else {
				sub_send_second--;
				$('#btnSendCode').val(sub_send_second+'秒后重新发送');
			}
		}
		
		
		// 更换联系人电话号码
		$('#contact_phone').blur(function(){
			var phone = $('#contact_phone').val();
			if (phone != contact_phone) {
				$('#contact_result').html('');
			}
		});
		
		// 验证联系人发送的验证码
		$('#contact_verify_code').blur(function(){
			if ($('#contact_result').html() != '') {
				return false;
			}
			var sCode = $(this).val();
			if (sCode == '') {
				alert('验证码不能为空');
				return false;
			}
			var phone = $('#contact_phone').val();
			if (checkMobile(phone) == false) {
				alert('验证码有误');
				return false;
			}
			var jsonData = {
				type: 'check',
				tel: phone,
				use: 'phone_order_contact_phone',
				code: sCode,
			};
			
			$.post('<?php echo U("common/sms");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					$('#contact_result').html('验证通过');
					window.clearInterval(IntervalContactSend);
					$('#btnSendCode').val('发送验证码');
					$('#btnSendCode').removeAttr('disabled');
				} else {
					alert(data.result.message);
				}
			});
		});
		
		// 检查订单信息
		function checkOrder() {			
			// 联系人检查
			if ($('#contact_name').val() == '') {
				alert("联系人姓名不能为空");
				return false;
			}
			
			// 联系人手机确认
			if ('<?php echo ($user["id"]); ?>' == '') {
				if ($('#contact_result').html() != '验证通过') {
					alert("联系人手机未验证确认");
					return false;
				}	
			} else {
				if (checkMobile($('#contact_phone').val()) == false) {
					alert("联系人手机错误");
					return false;
				}
			}
			
			return true;
		}
		
		
		// 获取参团人信息
		function getMemberData() {
			var jsonData = []; err = false;
			$('.passenger-information-list').each(function(i, ev){
				var mobilePhone = $(this).find('.tel').val();
				if (mobilePhone != '' && checkMobile(mobilePhone) == false) {
					var typeDesc = $(this).find('.member_type').html();
					alert('第'+i+'位'+typeDesc+'的电话号码错误！');
					return false;	
				}
				
				var obj = {
					name: $(this).find('.name').val(),
					type_id: $(this).find('.member_type').attr('data-id'),
					certificate_type_id: $(this).find('.cert').attr('data-id'),
					certificate_num: $(this).find('.cert_num').val(),
					tel: mobilePhone,
				};
				jsonData.push(obj);
			});		
			
			if (err == true) {
				return false;
			}
				
			return jsonData;
		}
		
		// 获取订单数据
		function getOrderData() {
//			var receiptType = $('.order-details-invoice').find('.order-details-invoice-choose').find('input:checked').val();
			var  manCount = $('.adult_man').find('span').html();
			var  womanCount = $('.adult_woman').find('span').html();
			var  childCount = $('.child').find('span').html();
			var receiptType = 0;
			
			var memberData = getMemberData();
			if (memberData === false) {
				return false;
			}
			
			var jsonData = {
				op_type: 'create',
				lineid: '<?php echo ($line["id"]); ?>',
				hdid: $('#batch_select').attr('data-id'),
				userid: '<?php echo ($user["id"]); ?>',
				duid: '<?php echo ($duid); ?>',
				male: manCount == '' || manCount == null ? 0 : manCount,
				woman: womanCount == '' || womanCount == null ? 0 : womanCount,
				child: childCount == '' || childCount == null ? 0 : childCount,
				types: '成人', //联系人类型
				names: $('#contact_name').val(), //联系人名称
				gendar: '男', // 联系人性别
				mob: $('#contact_phone').val(),
				members: memberData,
				oldman: $('.travel-people-information').find('.old-man').find('.has-checked').attr('data-id'),
				foreigner: $('.travel-people-information').find('.foreign-man').find('.has-checked').attr('data-id'),
				hk_mc: $('.travel-people-information').find('.gat-man').find('.has-checked').attr('data-id'),
				receipt_type: receiptType,
				book_account_type: '<?php echo ($user["account_type"]["id"]); ?>',
			}			
			jsonData['member_total_count'] = parseInt(jsonData['male']) + parseInt(jsonData['woman']) + parseInt(jsonData['child']);
			if ('<?php echo ($user["id"]); ?>' == '') {
				jsonData['mob_code'] = $('#contact_verify_code').val();
			}
			
//			if (receiptType != 0) {
//				var parentClass = receiptType == 1 ? '.order-details-invoice-write-enterprise' : '.order-details-invoice-write-personal';
//				if (receiptType == 1) {
//					jsonData['receipt_company'] = $(parentClass).find('.receipt_company').val();
//					jsonData['receipt_company_no'] = $(parentClass).find('.receipt_company_no').val();
//					jsonData['receipt_company_address'] = $(parentClass).find('.receipt_company_addr').val();
//					jsonData['receipt_company_phone'] = $(parentClass).find('.receipt_company_tel').val();
//				}
//				jsonData['receipt_receiver'] = $(parentClass).find('.receipt_receiver').val();
//				jsonData['receipt_receiver_phone'] = $(parentClass).find('.receipt_receiver_tel').val();
//				jsonData['receipt_receiver_address'] = $(parentClass).find('.receipt_receiver_addr').val();
//			}
			return jsonData;
		}		
		
		// 下单
		$('#comfirm_order').click(function(){
			if (checkOrder() == false) {
				return false;
			}
			//判断验证码滑动成功
			if (flag != 0){
				alert('请滑动验证码');
				return false;
			}
			
			var jsonData = getOrderData();	
			if (jsonData === false) {
				return false;
			}
			
			if (parseInt(jsonData['member_total_count']) == 0) {
				alert('出游人数总和不能为0');
				return false;
			}
			
//			console.log(JSON.stringify(jsonData));
			ShowMark();
			$.post('<?php echo U("line/order");?>', jsonData, function(data){
				HideMark();
				if (data.result.errno != 0) {
					alert(data.result.message);
				}
				if (data.jumpUrl != null && data.jumpUrl != 'undefined') {
					location.href = data.jumpUrl;
				}
			});
		});
	})
</script>
	</body>
</html>