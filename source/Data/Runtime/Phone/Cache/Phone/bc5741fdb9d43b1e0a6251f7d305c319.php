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
<div class="page">
	<!-- mycss -->
	<link rel="stylesheet" href="/source/Static/phone/css/mssyds.css">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="javascript:history.back();">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title">摄影大赛</h1>
		</header>
		<nav class="bar bar-tab">
			<a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
		      <i class="iconfont">&#xe605;</i>
		      <span>首页</span>
		    </a>
		    <a class="tab-item active" href="<?php echo ($pcset["askfor_link"]); ?>" external>
		      <i class="iconfont">&#xe602;</i>
		      <span>咨询</span>
		    </a>
		    <a class="tab-item" style="width: 3%; background-color: #ff7200; color: #fff;" href="http://shequ.kllife.com/User/fabu.html" external>
		      <span>上传作品</span>
		    </a>
		</nav>
		
		
		<div class="content">




      	<div class="photomatch-content">
      		<div class="photomatch-banner">
      			<img src="/source/Static/phone/images/mssyds/photomatch.jpg" alt="">

      		</div>
			<!-- tabs -->
      		<div class="photomatch-tabs">
      			<div class="photomatch-tabs-list">
					<a href="javascript:;" class="checked" title="tab1">大赛简介</a><a href="javascript:;" title="tab2">全部作品</a><a href="javascript:;" title="tab3">热门作品</a><a href="javascript:;" title="tab4">获奖公示</a>
				</div>
      		</div>

      		<div>
      			<!-- 大赛简介 -->
      			<div class="contest-profile" id="tab1">
      				<!-- 引言 -->
					<div class="contest-details">
						<h2>引言</h2>
						<p style="margin-top: 1.2rem;">满载历史的沧桑</p>
						<p>饱含岁月的艰辛</p>
						<p>蜿蜒而来，悄悄流淌</p>
						<p>没有喧嚣，没有誓言</p>
						<p>如飘逸的缎带连接南北</p>
						<p>似古老的赞歌唱响世界</p>
						<p>这便是大运河</p>
						<p style="margin-top: 1.2rem;">东南形胜，三吴都会</p>
						<p>钱塘自古繁华</p>
						<p>而流淌千年的大运河最南端</p>
						<p>则是人间天堂杭州</p>
						<p style="margin-top: 1.2rem;">千里桨声，千里灯影</p>
						<p>千里渔歌，千里花香</p>
						<p>关于运河你有怎样的印象</p>
					</div>

					<!-- 大赛时间 -->
					<div class="contest-time">
						<h2>大赛时间</h2>
						<img src="/source/Static/phone/images/mssyds/time02.jpg" alt="">
					</div>

					<!-- 奖项设置 -->
					<div class="awards">
						<h2>奖项设置</h2>
						<img src="/source/Static/phone/images/mssyds/one.jpg" alt="">
						<img src="/source/Static/phone/images/mssyds/two.jpg" alt="">
						<img src="/source/Static/phone/images/mssyds/three.jpg" alt="">
						<img src="/source/Static/phone/images/mssyds/four.jpg" alt="">
						
					</div>

					<!-- 投稿方式 -->
					<div class="contribution-method">
						<h2>投稿方式</h2>
						<p>登录账号点击 <i>"上传作品"</i> 按钮发作品帖，关联“<span style="color: #f00;">京杭大运河</span>”，在线投稿。</p>
						<p><a external href="http://shequ.kllife.com/Index/youjidetail.html?id=2819" target="_blank" style="padding: 3px 5px; background-color: #ffc92b; color: #fff; border-radius: 10px;">点击查看摄影比赛参赛流程指引</a></p>
						<p><a external href="http://shequ.kllife.com/Index/youjidetail.html?id=2822" target="_blank" style="padding: 3px 5px; background-color: #ffc92b; color: #fff; border-radius: 10px;">点击查看运河沿线历史遗迹介绍</a></p>
					</div>

					<!-- 评委会 -->
					<div class="jury">
						<h2>评委会</h2>
						<p>杭州市京杭运河综合保护中心、领袖户外摄影中心</p>
					</div>

					<!-- 评选方式 -->
					<div class="selection-method">
						<h2>评选方式</h2>
						<p>
							1、根据网络投票数由高至低选出若干名入围者；
						</p>
						<p>
							2、由大赛评委会在入围者中评选出最终等级奖。
						</p>
					</div>

					<!-- 参赛须知 -->
					<div class="entry-information">
						<h2>参赛须知</h2>
						<p><span>1</span> 参赛资格：所有摄影爱好者；</p>
						<p><span>2</span> 作品要求</p>
						<p style="margin-left: 1.5rem;">①作品应为表现运河杭州段的人文风光，特别是运河沿线的历史遗迹以及春节、元宵节期间的人文纪实，需具有较强的感染力、吸引力。</p>
						<p style="margin-left: 1.5rem;">②作品必须为作者原创作品，如发生侵权等行为，相应责任由参赛者承担。</p>
						<p style="margin-left: 1.5rem;">③作品以数字文件投稿，不接收纸质照片。组照以组为一个获奖单位，每组不超过10张；</p>
						<p style="margin-left: 1.5rem;">④本次活动相关组织对所有获奖作品享有使用权（包括网络展示、媒体发布、编辑成册、举办展览等），不再支付稿费。</p>
						<p style="margin-left: 1.5rem;">⑤本次活动不收参赛费、不退稿，获奖作品须提供成片及相机原始数码文件。凡不提供相机原始数码文件的，视为自动放弃获奖资格。</p>
						<p><span>3</span> 温馨提醒</p>
						<p style="margin-left: 1.5rem; color: #ff7200;">①运河杭州段沿线人文风光题材，例如塘栖古镇、西兴古镇、桥西历史街区、小河直街历史文化街区、大兜路历史街区、富义仓遗址公园等历史遗迹，特别是春节、元宵节期间举行的节庆活动。</p>
						<p style="margin-left: 1.5rem; color: #ff7200;">②运河沿线一带春节、元宵节期间民俗人文纪实类题材和历史遗迹、航拍等有较大入选优势，欢迎大家踊跃投稿此类作品。</p>
						<p><span>4</span> 凡投稿的作者均视为同意并遵守以上各条规定，凡不符合参赛要求的，一经发现将一律取消作品参评资格。</p>
						<p><span>5</span> 本活动最终解释权归领袖户外所有。</p>
						
					</div>
					
	      			<div class="photomatch-erweima">
						<p>
							<img src="/source/Static/phone/images/mssyds/photomatch_erweima.png" alt="">
							<span>领袖户外杭州站微信公众号</span>
						</p>
						
					</div>
      			</div>
      			<!-- 全部作品 -->
				<div class="all-works" id="tab2">
					<ul></ul>
				</div>
				<!-- end -->
				<!-- 热门作品 -->
				<div class="hot-works" id="tab3">
					<ul></ul>
				</div>
				<!-- 获奖公示 -->
				<div class="award-publicity" id="tab4">
					比赛正在火热进行中，暂无获奖公示哦！
				</div>
      		</div>
      	</div>

		<!--<div id="footer" class="foot">
			<ul>
				<li><a href="http://3g.kllife.com/"><i class="btn1"></i><p>首页</p></a></li>

                <li><a href="tel:4000805860"><i class="btn3"></i><p>咨询</p></a></li>

				<li style="width: 60%; background-color: #00a0e9"><a href="http://shequ.kllife.com/User/fabu.html"><i class="btn6"></i><p style="text-align: center; line-height: 4rem; font-size: 2rem;">上传作品</p></a></li>
			</ul>
   		</div>-->
	
	



	
	

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
	<script>
	
	function likeArc(id){
		$.ajax({
				type:"post",
				url:"http://shequ.kllife.com/mobile/api/LikesSJ/",
				async:true,
				dataType: "json",
				data:{"id":id},
				success:function(data){
					if(data.sta==1){
						$('#'+id+'_like').removeClass('zan');
						$('#'+id+'_like').addClass('zanguo');
						$('#'+id+'_like').next().html(parseInt($('#'+id+'_like').next().html()) + 1);
					}
				}
				
		});
		
	}
	
	//全部作品
	$.ajax({
		type:"post",
		url:"http://shequ.kllife.com/mobile/api/GetArcListSJ/",
		async:true,
		dataType: "json",
		data:{"address":23,"row":8,"rownum":0},
		success:function(data){
			if(data.length>0){
				var Html = '';
				for(var i=0;i<data.length;i++){
					Html += '<li>'
							+'<a external href="'+data[i]["arcurl"]+'" target="_blank" title="'+data[i]["youjiname"]+'">'
							+'<img src="'+data[i]["fengmiantp"]+'"  alt="'+data[i]["youjiname"]+'">'
							+'</a>'
							+'<div class="works-details">'
								+'<a external href="'+data[i]["userurl"]+'" class="whose" target="_blank">'
									+'<img src="'+data[i]["touxiang"]+'" target="_blank">'
								+'</a>'
								+'<a external href="'+data[i]["userurl"]+'" class="name" target="_blank">'+data[i]["writer"]+'</a>'
								+'<a external href="'+data[i]["arcurl"]+'" class="title" target="_blank" title="'+data[i]["youjiname"]+'">'+data[i]["youjiname"]+'</a>'
								+'<p>'
									+'<a href="javascript:;" class="zan" id="'+data[i]["id"]+'_like" onclick="likeArc('+data[i]["id"]+')"></a>'
									+'<span>'+data[i]["dianzan"]+'</span>'
								+'</p>'
							+'</div>'
							+'<a href="'+data[i]["arcurl"]+'" target="_blank" title="'+data[i]["youjiname"]+'"></a>'
						+'</li>'
				}
				$('.all-works > ul').append(Html); 
			}
		}
	});
	
	//热点作品
	$.ajax({
		type:"post",
		url:"http://shequ.kllife.com/mobile/api/GetArcListSJ/",
		async:true,
		dataType: "json",
		data:{"address":23,"row":8,"rownum":0,"orderby":"dianzan"},
		success:function(data){
			if(data.length>0){
				var Html = '';
				for(var i=0;i<data.length;i++){
					Html += '<li>'
							+'<a external href="'+data[i]["arcurl"]+'" target="_blank" title="'+data[i]["youjiname"]+'">'
							+'<img src="'+data[i]["fengmiantp"]+'"  alt="'+data[i]["youjiname"]+'">'
							+'</a>'
							+'<div class="works-details">'
								+'<a external href="'+data[i]["userurl"]+'" class="whose" target="_blank">'
									+'<img src="'+data[i]["touxiang"]+'" target="_blank">'
								+'</a>'
								+'<a external href="'+data[i]["userurl"]+'" class="name" target="_blank">'+data[i]["writer"]+'</a>'
								+'<a external href="'+data[i]["arcurl"]+'" class="title" target="_blank" title="'+data[i]["youjiname"]+'">'+data[i]["youjiname"]+'</a>'
								+'<p>'
									+'<a href="javascript:;" class="zan" id="'+data[i]["id"]+'_like" onclick="likeArc('+data[i]["id"]+')"></a>'
									+'<span>'+data[i]["dianzan"]+'</span>'
								+'</p>'
							+'</div>'
							+'<a href="'+data[i]["arcurl"]+'" target="_blank" title="'+data[i]["youjiname"]+'"></a>'
						+'</li>'
				}
				$('.hot-works > ul').append(Html); 
			}
		}
	});
	


		$('.photomatch-tabs-list a').click(
			function () {
				
				var row = 4;
				var rownum = 9;
				var isget = false;
				var isgethot = false;
				
				$(this).siblings().removeClass('checked');
				$(this).addClass('checked');
				var myId = $(this).attr('title');
				$('#' + myId).siblings().hide();
				$('#' + myId).show();
				
				//全部作品
				if($('.all-works').css("display") != "none"){
					$('.content').scroll(function(){
					    var winH = $(window).height(),
					        domH = $(document).height(),
					        scrollTop = $(document).scrollTop();
					        
					    //距离底部只有150px
					    if(domH - winH - scrollTop < 150){
					    	if (isget == false){
						    		isget = true;
						    		$.ajax({
										type:"post",
										url:"http://shequ.kllife.com/mobile/api/GetArcListSJ/",
										async:true,
										dataType: "json",
										data:{"address":23,"row":row,"rownum":rownum},
										success:function(data){
											if(data.length>0){
												var Html = '';
												for(var i=0;i<data.length;i++){
													Html += '<li>'
														+'<a external href="'+data[i]["arcurl"]+'" target="_blank" title="'+data[i]["youjiname"]+'">'
														+'<img src="'+data[i]["fengmiantp"]+'"  alt="'+data[i]["youjiname"]+'">'
														+'</a>'
														+'<div class="works-details">'
															+'<a external href="'+data[i]["userurl"]+'" class="whose" target="_blank">'
																+'<img src="'+data[i]["touxiang"]+'" target="_blank">'
															+'</a>'
															+'<a external href="'+data[i]["userurl"]+'" class="name" target="_blank">'+data[i]["writer"]+'</a>'
															+'<a external href="'+data[i]["arcurl"]+'" class="title" target="_blank" title="'+data[i]["youjiname"]+'">'+data[i]["youjiname"]+'</a>'
															+'<p>'
																+'<a href="javascript:;" class="zan" id="'+data[i]["id"]+'_like" onclick="likeArc('+data[i]["id"]+')"></a>'
																+'<span>'+data[i]["dianzan"]+'</span>'
															+'</p>'
														+'</div>'
														+'<a href="'+data[i]["arcurl"]+'" target="_blank" title="'+data[i]["youjiname"]+'"></a>'
													+'</li>'
												}
												$('.all-works > ul').append(Html); 
											}
											isget = false;
											rownum = rownum+row;
										}
									});
						    	}        	 
					    }             
					})
				}  
			    //热门作品
			    
				if($('.hot-works').css("display") != "none"){
					$('.content').scroll(function(){
					    var winH = $(window).height(),
					        domH = $(document).height(),
					        scrollTop = $(document).scrollTop();
					        
					    //距离底部只有150px
					    if(domH - winH - scrollTop < 150){
					    	
					    	if (isgethot == false){
						    		isgethot = true;
						    		$.ajax({
										type:"post",
										url:"http://shequ.kllife.com/mobile/api/GetArcListSJ/",
										async:true,
										dataType: "json",
										data:{"address":23,"row":row,"rownum":rownum,"orderby":"dianzan"},
										success:function(data){
											if(data.length>0){
												var Html = '';
												for(var i=0;i<data.length;i++){
													Html += '<li>'
														+'<a external href="'+data[i]["arcurl"]+'" target="_blank" title="'+data[i]["youjiname"]+'">'
														+'<img src="'+data[i]["fengmiantp"]+'"  alt="'+data[i]["youjiname"]+'">'
														+'</a>'
														+'<div class="works-details">'
															+'<a external href="'+data[i]["userurl"]+'" class="whose" target="_blank">'
																+'<img src="'+data[i]["touxiang"]+'" target="_blank">'
															+'</a>'
															+'<a external href="'+data[i]["userurl"]+'" class="name" target="_blank">'+data[i]["writer"]+'</a>'
															+'<a external href="'+data[i]["arcurl"]+'" class="title" target="_blank" title="'+data[i]["youjiname"]+'">'+data[i]["youjiname"]+'</a>'
															+'<p>'
																+'<a href="javascript:;" class="zan" id="'+data[i]["id"]+'_like" onclick="likeArc('+data[i]["id"]+')"></a>'
																+'<span>'+data[i]["dianzan"]+'</span>'
															+'</p>'
														+'</div>'
														+'<a href="'+data[i]["arcurl"]+'" target="_blank" title="'+data[i]["youjiname"]+'"></a>'
													+'</li>'
												}
												$('.hot-works > ul').append(Html); 
											}
											isgethot = false;
											rownum = rownum+row;
										}
									});
						    	}          	 
					    }             
					})
				}
			}
		);

		//回到顶部
		$('.back-top').click(
			function () {
				$('body,html').animate({ scrollTop: 0 }, 500);
			}
		);

	</script>		
</div>
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