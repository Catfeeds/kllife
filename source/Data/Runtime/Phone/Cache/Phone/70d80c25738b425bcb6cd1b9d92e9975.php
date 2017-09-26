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
	<link rel="stylesheet" href="/source/Static/phone/css/phonestyle.css">
	<link rel="stylesheet" href="/source/Static/phone/css/private_book_footer2.css">
	<script src="/source/Static/phone/common/js/jquery-1.11.3.min.js"></script>
	<script src="/source/Static/phone/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
      <script src="/source/Static/phone/js/html5shiv.js"></script>
      <script src="/source/Static/phone/js/respond.js"></script>
    <![endif]-->
	<script type="text/javascript">
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
				
			}else{
				window.location.href = 'http://kllife.com/home/index.php?s=/home/line/book';
			}
		}
		browserRedirect();
	</script>
</head>
<body class="page-body">
	<!-- 头部 -->
	<header id="header">
		<nav id="nav">
			<div class="nav-left">
				<a href="<?php echo U('index/welcome');?>"></a>
			</div>
			<div class="nav-right">
				<a class="btn-warning dingzhi dingzhiall" href="<?php echo U('line/private_book1');?>">立即定制</a>
			</div>
		</nav>
	</header>


	<!-- 主体 -->
	<section id="section">
		<!-- 大图 -->
		<div class="swiper-container">
			<div class="swiper-mark"></div>
		</div>

	    <!-- 定制信息 -->
	    <div class="gerenxinxi" style="display: none;">
	    	<div class="tianxiexinxi">
	    		<img src="/source/Static/phone/images/dzzt/dingzhi.png" alt="定制我的专属旅程">
	    		<p class="first-p">想玩的景点</p>
	    		<input type="text" class="jingdian" placeholder="请输入您想玩的景点 例如：婺源">
	    		<p>出行人数</p>
	    		<select name="renshu" id="">
	    			<option value="1">1</option>
	    			<option value="2">2</option>
	    			<option value="3">3</option>
	    			<option value="4">4</option>
	    			<option value="5">5</option>
	    		</select>
	    		<p>联系人</p>
	    		<input type="text" class="lianxiren" placeholder="您的称呼">
	    		<p>联系方式</p>
	    		<input type="text" class="lianxifangshi" placeholder="您的座机或手机号码">
	    		<p style="display: none; color: #e03905; font-size: 14px;">*请输入正确的联系方式</p>
	    		<a href="javascript:void(0);" class="btn-warning xuqiu">您的需求</a>
	    	</div>
	    </div>
	    <div class="wenzixinxi">
	    	<h4>领袖户外定制游</h4>
	    	<p>24h接机/站,1对1旅行顾问,金牌领队,全程跟拍</p>
	    	<p>11年户外旅游经验,5年的中高端旅游运营。</p>
	    	<p>旅游线路革新的标杆机构。</p>
	    </div>
	    <div class="gray"></div>
	    <!-- 主体内容 -->
	    <div class="neirong">
	    	<div class="neirong01">
	    		<h4>不跟团，不自助</h4>
	    		<img src="/source/Static/phone/images/dzzt/wenzi01.png" alt="超乎想象的精彩旅行">
	    		<p>旅游像赶集,游览像赶鸭,老人小孩跟不上趟？</p>
	    		<p>时间不自由,行程不随心,旅游陷阱隐形消费？</p>
	    		<p>攻略查到吐,临时开销大,旅途无趣味,冤枉钱？</p>
	    		<p>放心,你所担心的我们都懂！</p>
	    		<a class="mytrip dingzhiall" href="<?php echo U('line/private_book1');?>">定制我的旅行</a>
	    	</div>
	    	<div class="neirong02">
    			<a href="javascript:void(0);">
    				<img src="/source/Static/phone/images/dzzt/xizang.jpg" class="xizang" alt="西藏">
    				<img src="/source/Static/phone/images/dzzt/xizangwenzi.png" class="xizangwenzi" alt="西藏">
    			</a>
				<div class="neirong02-small">
					<a href="javascript:void(0);">
						<img src="/source/Static/phone/images/dzzt/yunnan.jpg" class="yunnan" alt="云南">
						<img class="yunnanwenzi" src="/source/Static/phone/images/dzzt/yunnanwenzi.png" alt="云南">
					</a>
					<a href="javascript:void(0);">
	    				<img class="xinjiang" class="xinjiang" src="/source/Static/phone/images/dzzt/xinjiang.jpg" alt="新疆">
	    				<img class="xinjiangwenzi" src="/source/Static/phone/images/dzzt/xinjiangwenzi.png" alt="新疆">
	    			</a>
				</div>
				<a href="javascript:void(0);">
    				<img src="/source/Static/phone/images/dzzt/sichuan.jpg" class="sichuan" alt="四川">
    				<img class="sichuanwenzi" src="/source/Static/phone/images/dzzt/sichuanwenzi.png" alt="四川">
    			</a>
	    	</div>
	    </div>
	    <div class="gray"></div>
	    <div class="neirong-bottom">
	    	<div class="neirong-bottom01">
	    		<div class="neirong-bottom-main">
	    			<h4>随心所欲，定制出行</h4>
		    		<img src="/source/Static/phone/images/dzzt/wenzi02.png" alt="你想要的旅行其实无比简单">
		    		<p>一旦开始定制,你就相当于拥有了一群专业旅行策划服务团队。</p>   		
		    		<p>为您设计专属旅行线路。</p>
		    		<p>价格透明,无隐形消费</p>
		    		<p>你想要的我们都能满足！</p>
		    		<a class="mytrip mytrip01 dingzhiall" href="<?php echo U('line/private_book1');?>">定制我的旅行</a>
	    		</div>
	    	</div>
	    	<div class="neirong-bottom02">
	    		<h1>只需4步</h1>
	    		<img src="/source/Static/phone/images/dzzt/wenzi03.png" alt="给您一次无与伦比的精彩旅行">
	    		<ul>
	    			<li>
	    				<img src="/source/Static/phone/images/dzzt/1bu.png" alt="">
	    				<h1>1.[提交需求]</h1>
	    				<p>收到您提交的定制需求后，</p>
	    				<p>领袖户外的旅行顾问将主动与您联系，</p>
	    				<p>就我们需要了解的问题与您进一步沟通。</p>
	    			</li>
	    			<li>
	    				<img src="/source/Static/phone/images/dzzt/2bu.png" alt="">
	    				<h1>2 .[设计方案]</h1>
	    				<p>我们将根据需求，为您量身定</p>
	    				<p>制旅行方案和报价，对于部分复杂</p>
	    				<p>需求，报价将在旅行方案确认后提供。</p>
	    			</li>
	    			<li>
	    				<img src="/source/Static/phone/images/dzzt/3bu.png" alt="">
	    				<h1>3. [确认预订]</h1>
	    				<p>旅行方案和报价确认后，</p>
	    				<p>我们将为您预留旅行资源库存，</p>
	    				<p>并与您签署旅游合同，收取旅行费用。</p>
	    			</li>
	    			<li style="border: none;">
	    				<img src="/source/Static/phone/images/dzzt/4bu.png" alt="">
	    				<h1>4. [尊贵出行]</h1>
						<p>领袖户外的专业团队将全程为</p>
						<p>您提供全方位服务，您只管享受精</p>
						<p>彩旅程，剩下的麻烦事儿都交给我们。</p>
	    			</li>
	    		</ul>
	    	</div>
	    	<div class="neirong-bottom03">
	    		<img src="/source/Static/phone/images/dzzt/wenzi04.png" alt="">
	    		<h4>领袖户外定制游</h4>
	    		<p>世界这么大,只要告诉我想去哪,剩下的都交给我！</p>
	    		<a class="mytrip dingzhiall" href="<?php echo U('line/private_book1');?>">定制我的旅行</a>
	    	</div>
	    </div>
	</section>


	<nav class="bar bar-tab">
		<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
				<i class="iconfont">&#xe66d;</i>
				<p>首页</p>
			</a>
			<a class="tab-item" href="<?php echo U('line/book');?>" external>
				<i class="iconfont">&#xe600;</i>
				<p>定制游</p>
			</a>
			<a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
				<i class="iconfont">&#xe8e7;</i>
				<p>咨询</p>
			</a>
			<a class="tab-item" href="http://shequ.kllife.com/" external>
				<i class="iconfont">&#xe66c;</i>
				<p>游记</p>
			</a>
			<a class="tab-item" href="<?php echo U('user/info');?>" external>
				<i class="iconfont">&#xe60d;</i>
				<p>我的</p>
			</a>
			<?php else: ?>
			<a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
				<i class="iconfont">&#xe66d;</i>
				<p>首页</p>
			</a>
			<a class="tab-item" href="<?php echo U('line/book');?>" external>
				<i class="iconfont">&#xe600;</i>
				<p>定制游</p>
			</a>
			<a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
				<i class="iconfont">&#xe8e7;</i>
				<p>咨询</p>
			</a>
			<a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
				<i class="iconfont">&#xe60d;</i>
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
	<!-- 底部 -->
	<footer id="footer">
		<a href="tel:4000805860" style="color: #fff; display: block; padding-top: 15px;">点击拨打联系电话 400-080-5860</a>
		<p>Copyright © 2006-2014 kllife.com</p>
		<p>领袖户外经营许可证号：L-SNX00306 陕ICP备14011728号-1 </p>
	</footer>
    <script>
    	var isMobile = /^(?:13\d|15\d|18\d|17\d|14\d)\d{5}(\d{3}|\*{3})$/; //手机号码验证规则
        var isPhone = /^((0\d{2,3})-)?(\d{8})(-(\d{3,}))?$/;   //座机验证规则
		$(".lianxifangshi").on("blur", function () {
			var dianhua = $.trim($(".lianxifangshi").val());
			if (!isMobile.test(dianhua) && !isPhone.test(dianhua)) { //如果用户输入的值不同时满足手机号和座机号的正则
				$(this).next("p").show();
			} else {
				$(this).next("p").hide();
			}
		});
		$(".small-lianxifangshi").on("blur", function () {
			var dianhua = $.trim($(".small-lianxifangshi").val());
			if (!isMobile.test(dianhua) && !isPhone.test(dianhua)) { //如果用户输入的值不同时满足手机号和座机号的正则
				$(this).next("p").show();
				return false;
			} else {
				$(this).next("p").hide();
			}
		});


    	
    	//提交数据
    	$('.tijiao').click(function(){
    		var jingdian = $('.large-right-jingdian').html(),
    			renshu = $('.large-right-renshu').html(),
    			lianxiren = $('large-right-lianxiren').html(),
    			lianxifangshi = $('.large-right-lianxifangshi').html(),
    			cheliang = $('.large-cheliang').val(),
    			tese = $('.large-tese').val(),
    			riqi = $('.large-right-riqi').html(),
    			tianshu = $('.large-right-tianshu').html(),
    			zhusu = $('.large-right-zhusu').html(),
    			lingdui = $('.large-right-lingdui').html(),
    			shijian = $('.large-right-shijian').html(),
    			qitalianxifangshi = $('.large-right-qitalianxifangshi').html(),
    			more = $.trim($('.large-right-more').html());
    		if ( cheliang == '' || tese == '' || riqi == '' || tianshu == '' || zhusu == '' || lingdui == '' || shijian == '' || qitalianxifangshi == '' || more == '' ){
    			$(this).next('p').show();
    			return false;
    		} else {
    			$(this).next('p').hide();
    			$('.modal-large').animate({top: '-50%'},1000); //隐去
	    		$('.mark').fadeOut(1000);
	    		AllData = { jingdian : jingdian, renshu : renshu, lianxiren : lianxiren, lianxifangshi : lianxifangshi, cheliang : cheliang, tese : tese, riqi : riqi, tianshu : tianshu, zhusu : zhusu, lingdui : lingdui, shijian : shijian, qitalianxifangshi : qitalianxifangshi, more : more };
	    		clearAllData(); //清除数据
    		}
    		$.ajax({
				url: "",
	            type: "post",
	            dataType: 'json',
	            data: AllData,
	            async: true,
	            cache: false,
	            success: function (data) {
	            }
    		})
    	})
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