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
<div class="page">
	<!-- mycss -->
	<link rel="stylesheet" href="/source/Static/phone/css/mssyds.css">
	<style>
		.content{background: #fff;}
		.photomatch-content,.content{background: #fff;}
		.photomatch-content .photomatch-tabs{border-bottom:none;background: #fff;height:2.5rem;}
		.photomatch-content .photomatch-tabs-list a{width:23.8%;color:#666;height:2.5rem;line-height:2.5rem;}
		.award-publicity{padding-top:0}
		.photomatch-content .photomatch-tabs-list .checked{background: #fff;border-bottom:2px solid #ef6249}
		.contest-profile img,.all-works img,.hot-works img,.award-publicity img{width:100%;height:auto;display:block;}
		.contest-profile,.all-works,.hot-works,.award-publicity{padding-bottom:3rem;}
		.contest-profile div,.all-works div,.award-publicity div{width:80%;margin-left:10%;margin-top:30px;}
		.award-publicity div{width:90%;margin-left:5%;margin-top:30px;}
		.all-works div img{margin:10px 0px;}
		.all-works .div p{text-align: right;text-align: -webkit-right}
		.contest-profile{margin:0px;}
		div p{font-size: .6rem;line-height:1.3rem;color:#666;}
		.contest-profile div p{line-height:2}
		.contest-profile div p:first-child{font-size: .8rem}
		.contest-profile h3{margin-left: 10%;font-size: .9rem;color:#666}
		.hot-works .course{overflow: hidden;padding:30px;}
		.hot-works .course div{float: left;}
		.hot-works .course .left{width:50px;border-right:1px solid #eee;}
		.hot-works .course .left p{position: relative}
		.hot-works .course .left p span{position: absolute;display: inline-block;width:10px;height:10px;border-radius: 50%;background: #ff6600;top:7px;right:-6px;}
		.hot-works .course .right{width:calc(100% - 50px);padding-left:20px;}
		.hot-works .course .right div{margin-bottom:20px;}
		.hot-works .course .left .year1{margin-bottom:45px;}
		.hot-works .course .left .year2{margin-bottom:100px;}
		.hot-works .course .left .year3{margin-bottom:99px;}
		.hot-works .course .left .year4{margin-bottom:71px;}
		.hot-works .course .left .year5{margin-bottom:45px;}
		.hot-works .course .left .year6{margin-bottom:73px;}
		.hot-works .course .left .year7{margin-bottom:98px;}
		.hot-works .course .left .year8{margin-bottom:44px;}
		.hot-works .course .left .year9{margin-bottom:30px;}
		@media screen and (min-width: 375px) {
			.hot-works .course .left .year1{margin-bottom:22px;}
			.hot-works .course .left .year2{margin-bottom:97px;}
			.hot-works .course .left .year5{margin-bottom:47px;}
			.hot-works .course .left .year6{margin-bottom:46px;}
		}
		@media screen and (min-width: 414px) {
			.hot-works .course .left .year2{margin-bottom:75px;}
			.hot-works .course .left .year3{margin-bottom:105px;}
			.hot-works .course .left .year4{margin-bottom:75px;}
			.hot-works .course .left .year5{margin-bottom:49px;}
			.hot-works .course .left .year7{margin-bottom:105px;}
		}
		@media screen and (max-width: 320px) {
			.hot-works .course .left .year2{margin-bottom:127px;}
			.hot-works .course .left .year3{margin-bottom:123px;}
			.hot-works .course .left .year4{margin-bottom:97px;}
			.hot-works .course .left .year5{margin-bottom:47px;}
			.hot-works .course .left .year6{margin-bottom:71px;}
			.hot-works .course .left .year7{margin-bottom:98px;}
		}
	</style>
	<header class="bar bar-nav">
		<a class="button button-link button-nav pull-left back" href="javascript:history.back();">
			<i class="iconfont">&#xe606;</i>
		</a>
		<h1 class="title">公司简介</h1>
	</header>
	<div class="content">
		<div class="photomatch-content">
			<!-- tabs -->
			<div class="photomatch-tabs">
				<div class="photomatch-tabs-list">
					<a href="javascript:;" class="checked" title="tab1">品牌故事</a>
					<a href="javascript:;" title="tab2">关于我们</a>
					<a href="javascript:;" title="tab3">发展历程</a>
					<a href="javascript:;" title="tab4">联系我们</a>
				</div>
			</div>

			<div>
				<!-- 品牌故事 -->
				<div class="contest-profile" id="tab1">
					<img src="/source/Static/phone/images/brand/phone-brand1.jpg" alt="">
					<h3>好玩不贵的小团慢旅行</h3>
					<div>
						<p>- 好玩</p>
						<p>你是否因为爱玩在小时候被各种对比各种批评？</p>
						<p>是否也总是被迫去学我们不喜欢的各种才艺？</p>
						<p>而唯一我们喜欢的“玩”却成为最不被认可的，</p>
						<p>必须要舍弃的？</p>
						<p>少年时光的缺憾有时候会成为一生的心心念念。</p>
						<p>我们就是这样一群被人称赞“会玩”的人，</p>
						<p>我们追求童年的梦想，好玩、爱玩、会玩，</p>
						<p>把玩做到极致，把玩当成事业，</p>
						<p>让更多的人也能体会到这种快乐。</p>
					</div>
					<div>
						<p>- 慢旅行</p>
						<p>人们都说，旅行就是一次人生，你希望有什么样的人生？</p>
						<p>闲庭漫步、悠长品味还是行色匆匆？</p>
						<p>平常劳碌的生活，但旅行为何不对自己好一点呢？</p>
						<p>拥有一段恰到好处的慢旅行，在风景中漫步、深呼吸，</p>
						<p>为不期而遇的惊艳停车，与晨曦和夕阳相伴，</p>
						<p>尽可能与美景相拥而眠 ……</p>
						<p>时间就应该浪费在美好的旅行中。</p>
						<p>因为我们相信一段美好的旅行就如同一次新生</p>
						<p>正如美国诗人唐 • 赫罗尔德在 87 岁写出的这首诗：</p>
						<p>《我会采更多的雏菊》</p>
						<p>如果我能够从头活过，</p>
						<p>我会试着犯更多的错。</p>
						<p>我会放松一点。</p>
						<p>我会灵活一点。</p>
						<p>我会比这一趟过得傻。</p>
						<p>很少有什么事能让我当真。</p>
						<p>我会疯狂一点。</p>
						<p>我会少讲究些卫生。</p>
						<p>我会冒更多的险。</p>
						<p>我会更经常地旅行。</p>
						<p>我会爬更多的山，游更多的河，看更多的日落。</p>
						<p>我会多吃冰激淋，少吃豆子。</p>
						<p>我会惹更多麻烦，可是不在想象中担忧。</p>
						<p>你看，我小心翼翼地稳健地理智地活着，</p>
						<p>一个又一个小时，一天又一天。</p>
						<p>噢，我有过难忘的时刻，如果我能够重来一次，</p>
						<p>我会要更多这样的时刻。</p>
						<p>事实上，我不需要别的什么。</p>
						<p>仅仅是时刻，一个接着一个，</p>
						<p>而不是每天都操心着往后的漫长日子。</p>
						<p>我曾经不论到哪里去都不忘记带上</p>
						<p>温度计，热水壶，漱口杯，雨衣和降落伞。</p>
						<p>如果我能够重来一次，我会到处走走，</p>
						<p>什么都试试，并且轻装上路。</p>
						<p>如果我能够从头活过，我会延长打赤脚的时光，</p>
						<p>从尽早的春天到尽晚的秋天。</p>
						<p>我会更经常地逃学。</p>
						<p>我不会考那么高的分数，除非是一不小心。</p>
						<p>我会多骑些旋转木马。</p>
						<p>我会采更多的雏菊。</p>
					</div>
					<div>
						<p>- 小团</p>
						<p>坚持纯玩的慢旅行带来了前几年爆发式的增长。</p>
						<p>但2015年发现队员们的快乐变得比以前少了些，</p>
						<p>他们的那丝缺憾触动到了我们…</p>
						<p>叩问内心，除了追求利润外，什么才是我们想要的？</p>
						<p>我们义无反顾的投身到这里是为了什么？</p>
						<p>是不是更要重视体验和快乐？</p>
						<p>争论踌躇后回归初心是我们内部一致的答案。</p>
					</div>
					<div>
						<p>- 不贵</p>
						<p>情怀和现实总那么矛盾，如何兼顾体验与性价？</p>
						<p>对自己负责、对用户珍视，领袖户外在甘南、新疆、额济纳、西藏、贵州、坝上草原通过近两年156批次的测试，最终锁定28人以内的小团，平衡性价与体验，保障领队、队友们和谐互动。</p>
						<p>守护旅行本真体验，就是在守护我们自己的信仰。</p>
					</div>
				</div>
				<!-- 关于我们 -->
				<div class="all-works" id="tab2">
					<img src="/source/Static/phone/images/brand/phone-brand2.jpg" alt="">
					<div>
						<p>2015年，在即将进入创业的12个年头，我也进入不惑之年，偶尔会冒出关于人生意义的思考，也对领袖户外有了深层的回顾与叩问。</p>
						<p>10余年里遭遇3次破产危机、2波爆发式发展，这一路太坎坷，庆幸我们还健康并在坚持；</p>
						<p>在不断的摸索中，通过我们设计的旅行产品服务过无数队员，这一路收获了太多的肯定与欣赏，他们不仅自己多次参加甚至义务帮我们宣传，这是我们最大的财富；
							期间也见识了人性的各种阴暗、算计与背叛，很自豪，因为我和我们的伙伴依然热爱生活，相信人性的美好，相比以往更愿意信任伙伴、愿意与他们一起成长。</p>
					</div>
					<div>
						<p>正如罗曼•罗兰所说：“世界上只有一种真正的英雄主义，就是认清了生活的真相后还依然热爱它。”我希望我们的伙伴更加热爱生活，勇敢地去体验人生的苦辣酸甜。</p>
						<p>在接下来的数十年里，我们不应该再像前十年那样活得不明不白，于是有了总结梳理共创领袖户外企业文化的想法。</p>
						<p>仰慕于苏东坡这位中国五千年来最懂生活的旅行家。不管是高居庙堂还是被贬流放，都能过着秉性难改的乐天派生活：品茶、酿酒、美食、爱“诗和远方”的旅行。
							也只有那样热爱生活、热爱生命的人，才真正懂得旅行意义，才能真正做好旅行产品，这是过程也必须是结果！</p>
					</div>
					<div><img src="/source/Static/phone/images/brand/phone-brand2-1.jpg" alt=""></div>
					<div>
						<p>于是——</p>
						<p>“享受旅行 品味人生”的愿景跃然而出。</p>
						<p>包含三个层面：</p>
						<p>> 享受生活：爱生活，享受人生的酸甜苦辣，有原则有信念，自尊   也被人尊重。</p>
						<p>> 自我实现：爱玩会玩，以爱好为事业，为队员的衷心称赞而不断努力。</p>
						<p>> 合作共赢，“人”，一撇一捺，就应该相互支撑。团队内，合伙人、产品经理制度；团队外，产业上下游合作共赢。</p>
					</div>
					<div>
						<p>我们用了四个月持续的全员共创领袖户外的企业文化</p>
						<p>使命：为用户提供参与感强体验度高的旅行</p>
						<p>价值观：诚信自爱、开放融合、为爱工作、拥抱变化、专注高效、以人为本</p>
					</div>
					<div>
						<img src="/source/Static/phone/images/brand/phone-brand2-2.jpg" alt="">
						<img src="/source/Static/phone/images/brand/phone-brand2-3.jpg" alt="">
					</div>
					<div class="div">
						<p> ——领袖户外创始人洗澡</p>
					</div>
				</div>
				<!-- 发展历程 -->
				<div class="hot-works" id="tab3">
					<img src="/source/Static/phone/images/brand/phone-brand2.jpg" alt="">
					<div class="course">
						<div class="left">
							<p class="year1">2005 <span></span></p>
							<p class="year2">2006 <span></span></p>
							<p class="year3">2007 <span></span></p>
							<p class="year4">2008 <span></span></p>
							<p class="year5">2011 <span></span></p>
							<p class="year6">2012 <span></span></p>
							<p class="year7">2015 <span></span></p>
							<p class="year8">2016 <span></span></p>
							<p class="year9">2017 <span></span></p>
						</div>
						<div class="right">
							<div><p>投身户外行业，驴友AA制，只为亲近自然；</p></div>
							<div><p>领袖户外前身西安快乐年票驴友俱乐部成立，承包旅行社部门开始正轨运作，第一年经验不足、商业模式不清晰，亏损近10万元，靠借钱维持；</p></div>
							<div><p>户外+旅行模式的探索让团队规模和业务量很快达西安第一，同时逐渐认识到在一个以个人魅力为基础的行业里合伙人方式是最佳的抱团取暖方式；</p></div>
							<div><p>汶川地震后第二天，合作域名被盗。一切又回归原点……对旅行执着的爱支撑着我们，自建网站，重头再来；</p></div>
							<div><p>通过3年的努力，公司业务重新回到正轨，第一波爆发式增长；</p></div>
							<div><p>领袖户外慢旅行理念在本地市场已经没有足够的市场容量，发展全国客源是必须的方向；</p></div>
							<div>
								<p>经过前几年的爆炸式高速发展，我们在反思什么是我们想要的，我们给客户提供的最大价值在哪里？</p>
								<p>小团慢旅行产品开始内部测试；</p>
							</div>
							<div><p>领袖户外杭州公司成立，提炼共创确定领袖户外企业文化；</p></div>
							<div><p>3月15日，创业第12年，回归初心，小团慢旅行正式上线；</p></div>
						</div>
					</div>
				</div>
				<!-- 联系我们 -->
				<div class="award-publicity" id="tab4">
					<img src="/source/Static/phone/images/brand/phone-brand3.jpg" alt="">
					<div>
						<p>旅游行业的产业链漫长而复杂，复杂的不是链条本身，而是从业者之间的碰撞与磨合。</p>
						<p>领袖户外，2005年纯粹以爱为起点投入旅游行业，并致力于深度旅行产品的研发和服务，经过12年的摸爬滚打发现，我们其实一直是“体验式旅行”理念的推动者。</p>
						<p>我们深知，深度旅行这个旅游行业垂直细分出的非标品，是“体验式旅行”理念的承载品。想要更加深入的发展深度旅行，必须以合作共赢的心态以及行为准则，团结认同“体验式旅行”理念的“户外旅游”从业者，从而在更加广阔的市场里真正推行和践行“体验式旅行”。</p>
						<p>一直以来，我们秉承开放融合、诚信自爱的价值观，与产业链条上下游以及同行保持着密切且双赢的合作。同时，我们也在不断扩大合作范围。</p>
					</div>
					<div>
						<p>地接合作：</p>
						<p>您是愿为客户提供体验至上的旅行服务的目的地资源提供商。</p>
						<p>联系邮箱：505644981@qq.com</p>
					</div>
					<div>
						<p>同行合作：</p>
						<p>您是客源地同行，我们在中性发团、诚信返利的基础上，还可进行流量分享的深度合作业务。</p>
						<p>联系邮箱：65246623@qq.com</p>
					</div>
					<div>
						<p>网络技术合作：</p>
						<p>您有意使用我们独立开发的适用于旅游行业的网络技术。</p>
						<p>联系邮箱：chenwutao@188.com</p>
					</div>
					<div>
						<p>媒体垂询及合作：</p>
						<p>您是旅游行业媒体或者新媒体从业者，进行媒体垂询、公关传播或者其他合作等接洽事宜。</p>
						<p>联系邮箱：chenwutao@188.com</p>
					</div>
					<div style="width:100%;margin-left:0">
						<img src="/source/Static/phone/images/brand/phone-brand3-2.jpg" alt="">
					</div>
					<div style="width:100%;margin-left:0">
						<p>总公司（西安）：</p>
						<p>陕西省西安市高新区上上国际3号楼19层11903室</p>
						<p>电话：400-080-5860</p>
						<p>传真：029-89526056</p>
						<p>商务合作：505644981@qq.com</p>
					</div>
					<div style="width:50%;margin-left:25%;">
						<img src="/source/Static/phone/images/brand/phone-brand3-1.jpg" alt="">
					</div>
					<div style="width:100%;margin-left:0;margin-bottom:50px;">
						<img src="/source/Static/phone/images/brand/phone-brand3-4.jpg" alt="">
					</div>
					<div style="width:100%;margin-left:0">
						<p>分公司（杭州）：</p>
						<p>浙江省杭州市西湖区文三路553号浙江中小企业大厦2318</p>
						<p>电话：400-080-5860 转 3  0571-89839741</p>
						<p>传真：0571-89839742</p>
					</div>
					<div style="width:60%;margin-left:20%;margin-bottom:3rem">
						<img src="/source/Static/phone/images/brand/phone-brand3-3.jpg" alt="">
					</div>
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
                        })
                    }
                    //热门作品

                    if($('.hot-works').css("display") != "none"){
                        $('.content').scroll(function(){
                            var winH = $(window).height(),
                                domH = $(document).height(),
                                scrollTop = $(document).scrollTop();

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
	</html>