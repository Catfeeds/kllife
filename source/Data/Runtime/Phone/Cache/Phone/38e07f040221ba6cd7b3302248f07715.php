<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
    
	<meta content="领袖户外" name="author"/>
	<?php if(empty($PageKeyword) == false): ?><meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
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
	<script src="/source/Static/phone/common/js/jquery.min.js"></script>
	<style>
		.black-mark { display: none; position: fixed; top:0; left:0; width: 100%; height: 100%; text-align: center; color:#fff; background: rgba(0,0,0,.5); z-index:3000; }
		.black-mark p { margin-top: 230px; color: #fff; text-align: center; }
	</style>
	<script>
		
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
				window.location.href = window.location.href.replace(/phone/g,'home');
			}
		}
		browserRedirect();
	
		
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
	<link rel="stylesheet" href="/source/Static/phone/css/images.css">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="<?php echo U('line/images_list');?>">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <h1 class="title"></h1>
		</header>
			    <nav class="bar bar-tab">
		    <a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
		      <i class="iconfont">&#xe605;</i>
		      <p>首页</p>
		    </a>
		    <a class="tab-item" href="<?php echo U('line/list');?>" external>
		      <i class="iconfont">&#xe604;</i>
		      <p>目的地</p>
		    </a>
		    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
		      <i class="iconfont">&#xe602;</i>
		      <p>咨询</p>
		    </a>
		    <a class="tab-item" href="http://shequ.kllife.com" external>
		      <i class="iconfont">&#xe603;</i>
		      <p>社区</p>
		    </a>
		    <a class="tab-item" href="<?php echo U('user/info');?>" external>
		      <i class="iconfont">&#xe601;</i>
		      <p>我的</p>
		    </a>
		</nav>
		<script type="text/javascript">
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
		
			<div class="images-top">
			
				<img src="http://img.kllife.com/2017-01-11_5875ffed9383a.jpg" alt="">
			
			</div>
			
			<div class="images-content">
				
				<div class="content-padded">
					<h4><img src="/source/Static/phone/images/index/images.png" alt="">春节罗平赏油菜花最全攻略</h4>
					<p>厚厚的"雪毯"、金红的雪山、蘑菇状的雪屋顶...雪乡，当你置身这个东北最美的雪世界，坐在狗拉雪橇上一路滑过梦幻般的雾凇林时，你会觉得雪乡这个地方似乎天生为影像而生，为追寻纯净梦想的旅游摄影爱好者而生。下面，跟随领袖户外脚步，一起到雪乡领略赏雪、玩雪的乐趣吧!</p>
					<p>对于旅游摄影爱好者而言，雪乡可谓名气不小。这颗镶嵌在黑龙江省东南部张广才岭东南坡的璀璨“明珠”，由于受山区小气候的偏爱，每年十月便开始瑞雪飘飘，一直飘到来年的阳春三月。整个冬季积雪厚度可达2米深，不仅雪质优良，雪量也堪称中国之最。</p>
					<p>驴友们可以从哈尔滨出发，拼车前往雪乡，近300公里的路程，将行驶6个小时左右。当车子进入盘山公路后，窗外的风景发生了奇异的变化。盘山公路宛如一条白色的玉带缠绕在群山的腰间，覆盖着厚厚白雪的红松林，瞬间化身为漫山美丽的圣诞树，而远处的山坡就像一幅水墨画般美不胜收。</p>
					<p>终于到了宁静的山村雪世界，下车跳到雪地上，踏着脚下松松软软的瑞雪，感觉舒服极了。放眼望去，半山上有一片小村庄，大概二十来户人家，家家门前挂着喜气的红灯笼，墙上挂满苞米、红辣椒和野兔等山间野味。再看炊烟袅袅的屋顶上，厚实的白雪就像大蛋糕上流淌下来的奶油，让人忍不住想抓一块下来尝尝。</p>
					<p>与东北其他地方不同的是，这里的白雪在负力的作用下，随物具形，千姿百态，厚度可达1米多，形状则好似奔马、卧兔、神龟、巨蘑……仿佛天上的朵朵白云飘落。雪乡从初冬冰花乍放的清晰，到早春雾凇涓流的婉约，无时无刻不散发着雪的神韵，成了一个冰雕玉琢的童话世界。</p>
					<p>雪乡的雪，千姿百态。似奔马、卧兔，又似神龟、巨蘑...</p>
					
					<img src="http://img.kllife.com/2017-01-11_5875ffed9383a.jpg" alt="">
					
					<img src="http://img.kllife.com/2017-01-11_5875ffed9383a.jpg" alt="">
					
					<p>在村里看不到日落与日出，因为在山沟里，尽管山并不高但日出与日落时的金黄色光线，还是毫无吝啬地照耀着满眼的白雪，给雪地染上一抹暖色。不过，仍有地方可看日出——出村庄，坐当地的土坦克，左摇右晃半个小时后，到达村外的羊草山顶。黎明时分，太阳从远处的云雾中若隐若现地露出笑脸，火红火红的，把整个山顶都染上了神秘的金红色。澄净的天空、白雪覆盖的松树林，树下的小草也结满了雾凇，似一朵朵盛开的棉花。面对这梦幻般的图画，你会觉得雪乡似乎天生为影像而生，为每一个寻找纯净梦想的人而生。</p>
					
					<img src="http://img.kllife.com/2017-01-11_5875ffed9383a.jpg" alt="">
					
					<p>东北的滑雪场几乎无处不在。雪乡附近也有两个滑雪场，八一滑雪场据说不向外界开放，但允许游客去观赏，幸运的话，还可以看到“八一”滑雪队的专业表演。而在村子东南边的另一个雪乡滑雪场，则已成为游客的乐园。除高山滑雪和越野滑雪外，这里还有高山雪橇、马拉爬犁、雪雕城、雪迷宫、雪吧、赏雪摄影等娱乐项目。</p>
					<p>滑雪场有缆车可以把滑雪者送到高处，不过这里雪道很陡，下去也没有供减速的平缓雪道，只有拦在山崖上的一道防撞网，所以新手们还是小心点好。村里的狗拉雪橇很吸引游客，据说这些狗都是从瑞典进口的，很壮，看上去有点吓人，但其实非常温顺。山上也有用汽车轮胎做的滑雪工具，坐在上面一推，就从山上的雪道里滑了下来，像过山车。当地人用两块木板脚底一绑，也能潇洒自如在雪中滑行，很有当年《林海雪原》里的飒爽英姿。</p>
				</div>
				
			</div>
		
		</div>
		
		
		


<!-- light7 -->
<script src="/source/Static/phone/common/js/light7.js"></script>
<!-- i18n 中文 -->
<script src="/source/Static/phone/common/js/cn.js"></script>
<!--公用JS文件-->
<script src="/source/Static/common/js/functions.js"></script>
		
		
		

</body>
</html>