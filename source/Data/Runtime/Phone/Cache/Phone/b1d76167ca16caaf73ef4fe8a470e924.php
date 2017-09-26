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
<style>
    .page{background: #fff;}
</style>
<div class="page">
    <!-- mycss -->
    <link rel="stylesheet" href="/source/Static/phone/css/xinjiang.css">
    <header class="bar bar-nav">
        <a class="button button-link button-nav pull-left back" href="javascript:history.back();">
            <i class="iconfont">&#xe606;</i>
        </a>
        <h1 class="title">新疆专题</h1>
    </header>
    
    <div class="item template_item hidden_ctrl">
        <img class="img-responsive" src="" alt="">
        <div class="detail">
            <p class="lg"></p>
            <p class="sm"></p>
        </div>
        <div class="price">
            <span class="place">出发地 : </span>
            <span class="right">￥<span class="money"></span></span>
        </div>
        <a href="javascript:;" external></a>
    </div>
    <div class="content">
        <div class="xinjiang">   
            <div class="top">
                <img class="img-responsive" src="/source/Static/phone/images/xinjiang/xinjiang_01.jpg" alt="">
                <a href="http://shequ.kllife.com/Mobile/Index/youjidetail/id/3049.html" external>
                    <img class="img-responsive" src="/source/Static/phone/images/xinjiang/xinjiang_02.jpg" alt="">
                </a>
                <img class="img-responsive" src="/source/Static/phone/images/xinjiang/promotion-phone.jpg" alt="">
                <img class="img-responsive" src="/source/Static/phone/images/xinjiang/xinjiang_03.jpg" alt="">
            </div>
            <div class="recommend">
                <div class="tit"><img src="/source/Static/phone/images/xinjiang/Recommend.png" alt=""></div>
                <div class="recommend1 find_line"><img src="/source/Static/phone/images/xinjiang/Recommend1.png" alt=""></div>
                <div class="recommend2 find_line" data-theme="line_theme_xtmlx"><img src="/source/Static/phone/images/xinjiang/Recommend2.png" alt=""></div>
                <div class="recommend3 find_line" data-theme="line_theme_sheying"><img src="/source/Static/phone/images/xinjiang/Recommend3.png" alt=""></div>
                <div class="recommend4 find_line" data-qlp="show"><img src="/source/Static/phone/images/xinjiang/Recommend4.png" alt=""></div>
            </div>
            <div class="recommend-result line_container">
            	<?php if(is_array($line)): $i = 0; $__LIST__ = $line;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?><div class="item" data-id="<?php echo ($l["id"]); ?>">
				        <img class="img-responsive" src="<?php echo ($l["img1"]); ?>" alt="">
				        <div class="detail">
				            <p class="lg"><?php echo ($l["title"]); ?></p>
				            <p class="sm"><?php echo ($l["subheading"]); ?></p>
				        </div>
				        <div class="price">
				            <span class="place">出发地 : <?php echo ($l["assembly_point_show_text"]); ?></span>
				            <span class="right">￥
				                <?php if(empty($l['check_price'])): ?><span class="money">核算中</span>
				                <?php else: ?>
				                	<span class="money"><?php echo ($l["start_price_adult"]); ?></span><?php endif; ?>
				            </span>
				        </div>
				        <a href="<?php echo U('line/info');?>/id/<?php echo ($l["id"]); ?>" external></a>
				    </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <!--新疆金秋-->
	        <!--<div class="recommend-two">
	            <div class="tit"><img src="/source/Static/phone/images/xinjiang/xinjiang-jinqiu.png" alt=""></div>
	            <div class="tit-tag">
	                <span class="active" data-tab="line_theme_recommend">推荐</span>
	                <span data-tab="line_theme_xtmlx">小团慢旅行</span>
	                <span data-tab="line_theme_qlp">跟拍游</span>
	                <span data-tab="line_theme_shendu">深度游</span>
	            </div>
	            <div class="recommend-result line_container">
	                <div class="item">
	                    <img class="img-responsive" src="http://img.kllife.com/2017-06-01_592fac733dfd9.jpg" alt="">
	                    <div class="detail">
	                        <p class="lg">新疆全景</p>
	                        <p class="sm subheading">喀纳斯-禾木-赛里木湖-薰衣草农场-喀拉峻-那拉提-巴音布鲁克-江布拉克-五彩滩-吐鲁番13日游</p>
	                        <p class="sm">本线路已有 <span>337</span> 人已报名</p>
	                    </div>
	                    <div class="price">
	                        <span class="place">出发地 : 西安</span>
	                        <span class="right">￥<span class="money">4080</span>元起</span>
	                    </div>
	                    <a href="javascript:;" external></a>
	                </div>
	                <div class="item">
	                    <img class="img-responsive" src="http://img.kllife.com/2017-06-01_592fac733dfd9.jpg" alt="">
	                    <div class="detail">
	                        <p class="lg">新疆全景</p>
	                        <p class="sm subheading">喀纳斯-禾木-赛里木湖-薰衣草农场-喀拉峻-那拉提-巴音布鲁克-江布拉克-五彩滩-吐鲁番13日游</p>
	                        <p class="sm">本线路已有 <span>337</span> 人已报名</p>
	                    </div>
	                    <div class="price">
	                        <span class="place">出发地 : 西安</span>
	                        <span class="right">￥<span class="money">4080</span>元起</span>
	                    </div>
	                    <a href="javascript:;" external></a>
	                </div>
	            </div>
	        </div>-->
	        <!--照片切换-->
            <div class="photo">
                <div class="tit">
                    <span id="kllife"><img class="img-responsive" src="/source/Static/phone/images/xinjiang/kllife-phone.png" alt=""></span>
                    <span id="meikemei"><img class="img-responsive" src="/source/Static/phone/images/xinjiang/meikemei-phone1.png" alt=""></span>
                </div>
                <div class="photo-list kllife-photo-list">
                    <span><img class="img-responsive" src="/source/Static/phone/images/xinjiang/kllife-photo-list.png" alt=""></span>
                    <!--<a href="<?php echo U('index/welcome');?>" external><span class="add"><img class="img-responsive" src="/source/Static/phone/images/xinjiang/kllife-add.png" alt=""></span></a>-->
                </div>
                <div class="photo-list meikemei-photo-list" style="display: none;">
                    <span><img class="img-responsive" src="/source/Static/phone/images/xinjiang/meikemei-photo-list.png" alt=""></span>
                    <!--<a href="http://m.xinlvpai.com/" external><span class="add"><img class="img-responsive" src="/source/Static/phone/images/xinjiang/meikemei-add.png" alt=""></span></a>-->
                </div>
            </div>
            <div class="other">
                <div class="tit">
                    <span class="left"><img class="img-responsive" src="/source/Static/phone/images/xinjiang/other.jpg" alt=""></span>
                    <span class="right"><img class="img-responsive" src="/source/Static/phone/images/xinjiang/recommend2.gif" alt=""></span>
                </div>
            </div>
            <div class="recommend-result">
            	<?php if(is_array($recommend)): $i = 0; $__LIST__ = $recommend;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rd): $mod = ($i % 2 );++$i;?><div class="item">
	                    <img class="img-responsive" src="<?php echo ($rd["img1"]); ?>" alt="">
	                    <div class="detail">
	                        <p class="lg"><?php echo ($rd["title"]); ?></p>
	                        <p class="sm"><?php echo ($rd["subheading"]); ?></p>
	                    </div>
	                    <div class="price">
	                        <span>出发地 : <?php echo ($rd["assembly_point_show_text"]); ?></span>
	                        <span class="right">
	                        	<?php if(empty($rd['check_price'])): ?>核算中
	                        	<?php else: ?>
	                        		￥<span class="money"><?php echo ($rd["start_price_adult"]); ?></span>起<?php endif; ?>
	                        </span>
	                    </div>
	                    <a href="<?php echo U('line/info');?>/id/<?php echo ($rd["id"]); ?>" external></a>
	                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <!--私人定制-->
            <div class="customized">
                <span class="span1"><img src="/source/Static/phone/images/xinjiang/earth.gif" alt=""></span>
                <span class="span2"><img src="/source/Static/phone/images/xinjiang/customized1.png" alt=""></span>
                <span class="span3"><img src="/source/Static/phone/images/xinjiang/customized2.png" alt=""></span>
                <a href="<?php echo U('line/book');?>" class="btn-customized" external>定制我的旅行</a>
            </div>
            <!--活动回顾-->
            <div class="review">
                <div class="goods-group">
                    <div class="review-img"><img src="/source/Static/phone/images/xinjiang/review-phone.png" alt=""></div>
                    <div class="item">
                        <img class="img-responsive" src="/source/Static/home/images/xinjiang/youji2016-07-14_57873ece175e4.jpg" alt="">
                        <div class="detail">
                            <p class="sm">新疆天山9日环游记</p>
                        </div>
                        <a href="http://shequ.kllife.com/Mobile/Index/youjidetail/id/1438.html" external></a>
                    </div>
                    <div class="item">
                        <img class="img-responsive" src="/source/Static/home/images/xinjiang/youji2016-10-14_5800e59965059.jpg" alt="">
                        <div class="detail">
                            <p class="sm">金秋，行走在迷人的北疆--北疆九日游</p>
                        </div>
                        <a href="http://shequ.kllife.com/Mobile/Index/youjidetail/id/1966.html" external></a>
                    </div>
                    <div class="item">
                        <img class="img-responsive" src="/source/Static/home/images/xinjiang/youji2016-10-13_57ff241ad12ae.jpg" alt="">
                        <div class="detail">
                            <p class="sm">这里是新疆，一个美丽的地方！</p>
                        </div>
                        <a href="http://shequ.kllife.com/Mobile/Index/youjidetail/id/1960.html" external></a>
                    </div>
                    <div class="item">
                        <img class="img-responsive" src="/source/Static/home/images/xinjiang/youji2016-10-26_5810bb50157de.jpg" alt="">
                        <div class="detail">
                            <p class="sm">2016额济纳全景游——赴一场黄金盛宴</p>
                        </div>
                        <a href="http://shequ.kllife.com/Mobile/Index/youjidetail/id/2026.html" external></a>
                    </div>
                    <div class="item">
                        <img class="img-responsive" src="/source/Static/home/images/xinjiang/youji2016-11-30_583e6c0cbffef.jpg" alt="">
                        <div class="detail">
                            <p class="sm">西北行漫记——大漠传奇意象</p>
                        </div>
                        <a href="http://shequ.kllife.com/Mobile/Index/youjidetail/id/2186.html" external></a>
                    </div>
                    <div class="item">
                        <img class="img-responsive" src="/source/Static/home/images/xinjiang/youji2016-10-17_5804e218278b0.jpg" alt="">
                        <div class="detail">
                            <p class="sm">菲林下的西域，带着胶卷游新疆（反转片）</p>
                        </div>
                        <a href="http://shequ.kllife.com/Mobile/Index/youjidetail/id/1972.html" external></a>
                    </div>
                </div>
            </div>
            <!--周边游-->
            <!--<div class="zhoubian">
                <span class="zhoubian-img"><img class="img-responsive" src="/source/Static/phone/images/xinjiang/zhoubian.jpg" alt=""></span>
                <div class="recommend-result">
                	<?php if(is_array($surrounding)): $i = 0; $__LIST__ = $surrounding;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sur): $mod = ($i % 2 );++$i; if(stripos($key, 'surrounding') === 0): ?><div class="item">
		                        <img class="img-responsive" src="<?php echo ($sur["img1"]); ?>" alt="">
		                        <div class="detail">
		                            <p class="lg"><?php echo ($sur["title"]); ?></p>
		                            <p class="sm"><?php echo ($sur["subheading"]); ?></p>
		                        </div>
		                        <div class="price">
		                            <span>出发地 : <?php echo ($sur["assembly_point_show_text"]); ?></span>
		                            <span class="right">
			                        	<?php if(empty($sur['check_price'])): ?>核算中
			                        	<?php else: ?>
			                        		￥<span class="money"><?php echo ($sur["start_price_adult"]); ?></span>起<?php endif; ?>
			                        </span>
		                        </div>
		                        <a href="<?php echo U('line/info');?>/id/<?php echo ($sur["id"]); ?>" external></a>
		                    </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>-->
        </div>
        <div style="margin-bottom:60px;">
        	<p style="text-align: center;">长按二维码了解更多</p>
        	<img style="width:90%;display:block;margin:auto;" src="/source/Static/phone/images/xinjiang/xinjiang-ewm.jpg" alt="" />
        	<p style="text-align: center;">微信号：lingxiuyouyou</p>
        </div>
        

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
    </div>
</div>
<script>

//    // 初始加载新疆线路（不采用岩石加载）
//    findLine(null, null);  
	//新疆金秋标签切换
	$(".recommend-two .tit-tag span").on("click",function(){
       $(this).addClass("active").siblings().removeClass("active");
	})
    //图片列表切换
    $("#kllife").on("click",function(){
        $(".kllife-photo-list").show();
        $(".meikemei-photo-list").hide();
        $(this).find("img").attr("src","/source/Static/phone/images/xinjiang/kllife-phone.png")
        $("#meikemei").find("img").attr("src","/source/Static/phone/images/xinjiang/meikemei-phone1.png")
    })
    $("#meikemei").on("click",function(){
        $(".meikemei-photo-list").show();
        $(".kllife-photo-list").hide();
        $(this).find("img").attr("src","/source/Static/phone/images/xinjiang/meikemei-phone.png")
        $("#kllife").find("img").attr("src","/source/Static/phone/images/xinjiang/kllife-phone1.png")
    })
    
        
    // 查找产品
    function findLine(theme,qlp) {
    	var jsonData = {
    		theme_type:	theme,
    		qinglvpai:qlp,
    	}

    	$('.line_container').children().remove();
    	$.post('<?php echo U("subject/xinjiang");?>', jsonData, function(data){
    		if (data.ds != null) {
    			for (var i=0; i < data.ds.length; i++) {
    				var d = data.ds[i];    				
    				var rootObj = $('.template_item').clone(true);
    				$(rootObj).removeClass('template_item');
    				$(rootObj).removeClass('hidden_ctrl');
    				$(rootObj).attr('data-id', d.id);
    				$(rootObj).find('img').attr('src', d.img1);
    				$(rootObj).find('.detail .lg').html(d.title);
    				$(rootObj).find('.detail .sm').html(d.subheading);
    				$(rootObj).find('.price .place').html('出发地 : '+d.assembly_point_show_text);
    				if (d.check_price == 0) {
    					$(rootObj).find('.price .money').parent().html('核算中');	
    				} else {							
    					$(rootObj).find('.price .money').html(d.start_price_adult);	
    				}
    				$(rootObj).find('a').attr('href', '<?php echo U("line/info");?>/id/'+d.id);
    				$('.line_container').append(rootObj);
                    console.log(rootObj)
    			}
    		} else {
    			$('.line_container').html('<div style="text-align: center; font-size:20px;">亲，没有您要的线路，可以选择定制或者尝试其他选项哦</div>');
    		}
    	});
    }
    $('.find_line').click(function(){
    	var themeType = $(this).attr('data-theme');
    	var qlp = $(this).attr('data-qlp');
    	findLine(themeType, qlp);
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