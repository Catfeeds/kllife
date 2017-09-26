<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php if(empty($PageKeyword) == false): ?><meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
	<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
	<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
	<title><?php echo ($PageKeyword["title"]); ?></title>
	<?php else: ?>
	<title><?php echo C('PAGE_TITLE');?></title><?php endif; ?>    
	<!-- 引用jq -->
	<script src="http://kllife.com/source/Static/home/common/js/jquery-1.11.3.min.js"></script>	
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
				var vhref = window.location.href.replace(/xinlvpai/g,'m.xinlvpai').replace(/qinglvpai/g,'qlpphone');
				window.location.href = vhref;
			}else{
				
			}
		}
		browserRedirect();	
	</script>
	
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/animate.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/style/style.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/style.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/iconfont.css">
	<!-- css Reset -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/cssreset.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/common.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/common/css/common.css">
    <style>
        .top-ask{position: fixed;right:50px;bottom:100px;display: none;z-index:1000;}
        .top-ask div{margin:2px 0px;cursor: pointer;}
        .top-ask div img{width:50px;height:50px;}
    </style>
</head>
<body>
<!--header-->
<div class="header">
    <?php if(C('MENU_CURRENT') === 'index_welcome'): ?><a href="<?php echo U('index/story');?>" target="_blank"><div class="banner" style="background-image: url(<?php echo ($set["banner"]); ?>);"></div></a>
   	<?php elseif(C('MENU_CURRENT') === 'line_list'): ?>
        <div class="banner" style="background-image: url(<?php echo ($set["content_banner"]); ?>);"></div>
    <?php elseif(C('MENU_CURRENT') === 'line_content'): ?>
        <div class="banner-content" style="background-image: url(<?php echo ($set["qinglvpai_content_banner"]); ?>);"></div>
   	<?php elseif(C('MENU_CURRENT') === 'line_main_list'): ?>
        <div class="banner" style="background-image: url(<?php echo ($set["xiaomantuan_banner"]); ?>);"></div>
    <?php elseif(C('MENU_CURRENT') === 'line_main_content'): ?>
        <div class="banner-content" style="background-image: url(<?php echo ($set["xiaomantuan_content_banner"]); ?>);"></div>
    <?php elseif(C('MENU_CURRENT') === 'book_line' or C('MENU_CURRENT') === 'line_pay_result' or C('MENU_CURRENT') === 'index_story' or stripos(C('MENU_CURRENT'),'leader_list') !== FALSE): ?>
    <?php else: ?>
        <div class="banner-content" style="background-image: url(<?php echo ($set["qinglvpai_content_banner"]); ?>);"></div><?php endif; ?>
    <div class="div-two">
        <div class="list">
            <a href="<?php echo U('Index/welcome');?>" target="_blank"><img class="logo-white" src="http://kllife.com/source/Static/qinglvpai/images/index/logo-qinglvpai.png" alt=""></a>
            <ul>
                <a class="active" href="<?php echo U('index/welcome');?>" target="_blank">首页</a>
                <a href="<?php echo U('index/story');?>" target="_blank">品牌故事</a>
                <a href="<?php echo U('line/list');?>" target="_blank">写真旅行</a>
                <a href="<?php echo U('line/slowly');?>" target="_blank">小团慢旅行</a>
                <a href="<?php echo U('article/list');?>" target="_blank">写真作品</a>
                <!--<a href="javascript:;">客户回顾</a>-->
            </ul>
            <div class="tel">
                <img src="http://kllife.com/source/Static/qinglvpai/images/index/tel-img.png" alt="">
                <img src="http://kllife.com/source/Static/qinglvpai/images/index/tel-number.png" alt="">
                <!--<em><?php echo ($pcset["askfor_tel"]); ?></em>-->
            </div>
            <div class="tel login" style="line-height:80px;color:#fff;font-size: 14px;width:170px;text-align: center;text-align: -webkit-center">
				<?php if(empty($user) == true): ?><a href="<?php echo U('user/login');?>" target="_blank">登录</a> |
					<a href="<?php echo U('user/register');?>" target="_blank">注册</a>
				<?php else: ?>
					<a href="<?php echo U('line/order');?>/type/center" target="_blank">我的订单</a> |
					<a href="<?php echo U('user/exit');?>" target="_blank">退出</a><?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!--返回顶部，咨询-->
<div class="top-ask">
    <div onclick="openZoosUrl('chatwin');"><img src="http://kllife.com/source/Static/qinglvpai/common/images/ask1.jpg" alt=""></div>
    <div class="return-top"><img src="http://kllife.com/source/Static/qinglvpai/common/images/return-top.jpg" alt=""></div>
</div>
<script type="text/javascript">	
	// 导航划过变色
	$('.list ul a').mouseenter(function(){
		$(this).toggleClass('active');
	});
	$('.list ul a').mouseleave(function(){
		$(this).toggleClass('active');
	});

	// 登录我的订单点击选中
    $(".login a").on("click",function(){
        $(this).addClass("active").siblings("a").removeClass("active");
    })
    
    //屏幕滚动显示一键返回顶部按钮
    $(window).scroll( function (){
        if ($(this).scrollTop() > 150) {
            $('.top-ask').fadeIn();
        }else{
            $('.top-ask').fadeOut();
        };
    });

    //点击返回顶部
    $(".return-top").click(
        function(){
            $("html,body").animate({scrollTop: 0}, 1000);
        }
    );

</script>
<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/welcome.css">
<style type="text/css">
    #add{padding:2px 20px;}
    .tag{font-size: 18px;}
    .new-tag{position: relative;margin:0px 5px;}
    .new-tag .remove{color:#888;position: absolute;top:-7px;right:0px;cursor: pointer;font-size: 14px;padding:7px;border-left:1px solid #a9a9a9;border-right:1px solid #a9a9a9;background: #fff;}
    .new-tag .remove{position: absolute; top:-3px;right:8px;cursor: pointer;font-size: 14px;padding:7px;}
    .index-line .place-name .new-tag input{height:30px;font-size: 16px;color:#888;}
    /*.index-line .place-name .new-tag .active{background:#ef6249;color:#fff;}*/
    .index-line .left .travel-image0{width:567.997px;height:568.182px;}
    .index-line .right .travel-image1{width:610.994px;height:361.818px;}
    .index-line .right .travel-image2{width:295.994px;height:186.364px;}
    .bottom-p1 {line-height: 26px; margin-top:30px !important; }
</style>

<!--企业简介-->
<!--<div class="index-company-profile">-->
<!--<img class="img-responsive" src="<?php echo ($set["company_background"]); ?>" alt="">-->
<!--<div class="mask"><!-此div只用于显示遮罩层-></div>-->
<!--<h2>企业简介</h2>-->
<!--<div class="profile"><?php echo ($set["company_intro"]); ?></div>-->
<!--</div>-->
<!--新旅拍-->
<div class="background-two">
    <div class="tit">什么是写真旅行？</div>
    <div class="group">
        <div class="item">
            <p class="p1">游•拍黄金平衡</p>
            <p class="p2">玩好&拍美 黄金解决方案</p>
            <p class="p2">专为爱美女性旅游者设计</p>
        </div>
        <span></span>
        <div class="item">
            <p class="p1">主题写真+全程跟拍</p>
            <p class="p2">专业摄影师多年实地拍摄</p>
            <p class="p2">应景主题设计  旅行写真攻略</p>
        </div>
        <span></span>
        <div class="item">
            <p class="p1">女性专属旅行</p>
            <p class="p2">拒绝单男参加</p>
            <p class="p2">一心一意专为女性服务</p>
        </div>
        <span></span>
        <div class="item">
            <p class="p1">“3+1”美丽计划</p>
            <p class="p2">三大赠送项目</p>
            <p class="p2">后期增值服务</p>
        </div>
    </div>
    <p class="bottom-p1">每刻美拥有十年深度旅行策划经验及专业摄影师团队，让你玩好拍美，不再为没有旅行美照而遗憾。</p>
</div>
<div class="index-line">
    <div class="center">
        <h2 style="margin-bottom:25px;color:#ff1c77">每刻美 初体验</h2>
        <!--<p style="text-align: center;text-align: -webkit-center;font-size: 18px;margin-bottom:15px;">拼个摄影师去旅行</p>-->
        <div class="place-name">
            <a class="table-btn active" href="javascript:;">拼个摄影师去旅行</a>
            <!--<?php if(is_array($set)): $i = 0; $__LIST__ = $set;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$travel_tab): $mod = ($i % 2 );++$i; if(stripos($key, 'travel_tab') === 0 and stripos($key, '_line_') === false): $sortIndex = $set['sort_'.$key]; ?>
	            	<span class="new-tag">
	            		<?php if(empty($firstTab) == true): $firstTab = $key; ?>
            				<a class="table-btn active set_tab" data-set="<?php echo ($key); ?>" data-index="<?php echo ($sortIndex); ?>" href="javascript:;"><?php echo ($travel_tab); ?></a>
	            		<?php else: ?>
            				<a class="table-btn set_tab" data-set="<?php echo ($key); ?>" data-index="<?php echo ($sortIndex); ?>" href="javascript:;"><?php echo ($travel_tab); ?></a><?php endif; ?>
	            	</span><?php endif; endforeach; endif; else: echo "" ;endif; ?>-->
        </div>
        <div>
            <?php $classList = array('relative-line relative-line-one', 'right-top relative-line relative-line-two', 'left-two relative-line relative-line-three', 'right-two relative-line relative-line-three'); $beforeHtml = array('<div class="left">','<div class="right">', '<div class="right-bottom">', ''); $behindHtml = array('</div>','','','</div></div>'); $imgClass = array('travel-image0', 'travel-image1', 'travel-image2', 'travel-image2'); ?>
            <?php $__FOR_START_641437893__=0;$__FOR_END_641437893__=4;for($k=$__FOR_START_641437893__;$k < $__FOR_END_641437893__;$k+=1){ if (empty($firstTab)) { break; } $line = $set[$firstTab.'_line_'.$k]; if (!empty($line)) { $lineBackground = $line['img2']; $imgkey = 'img2'; if (!empty($set[$firstTab.'_line_image_'.$k])) { $lineBackground = $set[$firstTab.'_line_image_'.$k]; $imgkey = $firstTab.'_line_image_'.$k; } } ?>
                <?php echo ($beforeHtml[$k]); ?>
                <div class="<?php echo ($classList[$k]); ?> travel_tab_line">
                    <a href="<?php echo U('line/info');?>/id/<?php echo ($line["id"]); ?>" target="_blank">
                        <img class="img-responsive <?php echo ($imgClass[$k]); ?>" src="<?php echo ($lineBackground); ?>" alt="">
                    </a>
                    <a href="<?php echo U('line/info');?>/id/<?php echo ($line["id"]); ?>" target="_blank">
                        <div class="animated tab_set_image" data-set="<?php echo ($firstTab); ?>_line_image_<?php echo ($k); ?>"><!--此div只用于显示遮罩层--></div>
                    </a>
                    <h2 class="animated"><?php echo ($line["title"]); ?></h2>
                    <a type="button" class="btn btn-orange-three animated tab_set_line" data-set="line_<?php echo ($k); ?>" data-index="<?php echo ($k); ?>" href="<?php echo U('line/info');?>/id/<?php echo ($line["id"]); ?>" target="_blank">查看线路</a>
                </div>
                <?php echo ($behindHtml[$k]); } ?>
            <div style="clear: both"></div>
            <a href="<?php echo U('line/list');?>" target="_blank"><h3>查看全部每刻美初体验线路 <span><i class="iconfontyyy">&#xe624;</i></span></h3></a>
        </div>
    </div>
</div>
<!--每刻美   定制款-->
<div class="index-line index-customized">
    <div class="center">
        <h2 style="margin-bottom:25px;color:#ff1c77">每刻美 定制款</h2>
        <!--<p style="text-align: center;text-align: -webkit-center;font-size: 18px;margin-bottom:15px;">拼个摄影师去旅行</p>-->
        <div class="place-name">
            <a class="table-btn active" href="javascript:;">你的每一颗美好都值得珍藏</a>
        </div>
        <div class="width">
            <div class="left"><div><img src="http://kllife.com/source/Static/qinglvpai/images/index/customized-left.jpg" alt=""></div></div>
            <div class="right">
                <div>
                    <p class="color">满足你的需求</p>
                    <p class="color color-lg">给你拍最美写真旅行照</p>
                    <p>无需做攻略，旅行琐事统统帮你搞定</p>
                    <p>玩你想玩的，专属于你的旅行计划</p>
                    <p>不拼团，私家小团独享完美旅程</p>
                    <p>随心预约，选你喜欢的摄影师</p>
                    <p>每刻美</p>
                    <p>让你的每张旅行照，都因惊艳时光而得以珍藏</p>
                    <a class="btn">定制我的旅行</a>
                </div>
            </div>
            <a class="link-customized" href="<?php echo U('line/book');?>" target="_blank"></a>
        </div>
    </div>
</div>
<!--旅拍摄影师-->
<div class="index-travel index-photographer" style="background: #fff;">
    <h2 style="margin-bottom:45px;color:#ff1c77;font-size: 28px;text-align: center;text-align: -webkit-center;padding-top:70px;">摄影师</h2>
    <div class="circuit">
        <a href="javascript:;" target="_blank">
            <div class="circuit-item">
                <div class="img"><img class="img-responsive" src="http://kllife.com/source/Static/qinglvpai/images/index/photo-one.jpg" alt=""></div>
                <div class="name">刘野花</div>
            </div>
            <div class="circuit-item">
                <div class="img"><img class="img-responsive" src="http://kllife.com/source/Static/qinglvpai/images/index/photo-two.jpg" alt=""></div>
                <div class="name">刘野花</div>
            </div>
            <div class="circuit-item">
                <div class="img"><img class="img-responsive" src="http://kllife.com/source/Static/qinglvpai/images/index/photo-three.jpg" alt=""></div>
                <div class="name">刘野花</div>
            </div>
            <div class="circuit-item">
                <div class="img"><img class="img-responsive" src="http://kllife.com/source/Static/qinglvpai/images/index/photo-four.jpg" alt=""></div>
                <div class="name">刘野花</div>
            </div>
        </a>
    </div>
    <a href="<?php echo U('line/slowly');?>" target="_blank"><h3 class="whole">查看全部摄影师 <span><i class="iconfontyyy">&#xe624;</i></span></h3></a>
</div>
<!-小团慢旅行->
<div class="index-travel">
    <div class="tit">小团慢旅行</div>
    <?php $line = $set['slowly_line_0']; ?>
    <a href="<?php echo U('line/content');?>/id/<?php echo ($line["id"]); ?>" target="_blank">
        <div class="recommended-circuit">
            <div class="left"><img class="img-responsive" src="<?php echo ($line["img1"]); ?>" alt="" style="width: 500px; height: 374.545px;"></div>
            <div class="right">
                <h2><?php echo ($line["title"]); ?></h2>
                <h3><?php echo ($line["subheading"]); ?></h3>
                <p>产品寄语：<span><?php echo ($line["send_word"]); ?></span></p>
                <div class="time-zan">
                    <div class="time">Time：<?php echo ($line["start_time"]); ?> </div>
                    <!--<div class="zan">21<span class="glyphicon glyphicon-heart"></span></div>-->
                </div>
                <a href="<?php echo U('line/content');?>/id/<?php echo ($line["id"]); ?>" type="button" class="btn btn-orange-three" target="_blank">查看线路</a>
            </div>
        </div>
    </a>
    <div class="circuit">
        <?php $__FOR_START_1970388942__=1;$__FOR_END_1970388942__=5;for($i=$__FOR_START_1970388942__;$i < $__FOR_END_1970388942__;$i+=1){ $line = $set['slowly_line_'.$i]; ?>
            <a href="<?php echo U('line/content');?>/id/<?php echo ($line["id"]); ?>" target="_blank">
                <div class="circuit-item">
                    <div class="img"><img class="img-responsive" src="<?php echo ($line["img1"]); ?>" alt="" style="width: 274.517px; height: 206.364px;"></div>
                    <div class="background">
                        <h3><?php echo ($line["title"]); ?></h3>
                        <a type="buttom" class="btn btn-orange-four" href="<?php echo U('line/content');?>/id/<?php echo ($line["id"]); ?>" target="_blank">查看线路</a>
                    </div>
                </div>
            </a><?php } ?>
    </div>
    <a href="<?php echo U('line/slowly');?>" target="_blank"><h3 class="whole">查看全部小团慢旅行线路 <span><i class="iconfontyyy">&#xe624;</i></span></h3></a>
</div>

<!--新旅拍作品-->
<div class="index-works" style="background: #333;">
    <!--<img class="img-responsive" src="http://kllife.com/source/Static/qinglvpai/images/index/index-works-background.png" alt="">-->
    <div class="absolute">
        <h2>写真旅行作品</h2>
        <?php $__FOR_START_2140961711__=0;$__FOR_END_2140961711__=6;for($i=$__FOR_START_2140961711__;$i < $__FOR_END_2140961711__;$i+=1){ $art = $set['travel_article_'.$i]; ?>
            <a href="<?php echo U('article/info');?>/id/<?php echo ($art["id"]); ?>" target="_blank">
                <div class="works">
                    <img src="<?php echo ($art["face_image"]); ?>" alt="" style="width: 420.994px; height: 315.994px;">
                    <div class="animated fresco"  data-id="<?php echo ($art["id"]); ?>"><!--此div只用于遮罩层--></div>
                    <span class="lg animated"><?php echo ($art["short_title"]); ?></span>
                    <span class="sm animated">作者：<?php echo ($art["author"]); ?></span>
                </div>
            </a><?php } ?>
        <a href="<?php echo U('article/list');?>" target="_blank"><h3>查看全部写真旅行作品 <span><i class="iconfontyyy">&#xe624;</i></span></h3></a>
    </div>
</div>
<!--线路回顾-->
<!--<div class="index-review">-->
<!--<h2>线路回顾</h2>-->
<!--<?php $__FOR_START_1270238865__=0;$__FOR_END_1270238865__=3;for($i=$__FOR_START_1270238865__;$i < $__FOR_END_1270238865__;$i+=1){ ?>-->
<!--<?php $art = $set['travel_review_article_'.$i]; ?>-->
<!--<a href="http://kllife.com/home/index.php?s=/home/line/article/id/<?php echo ($art["id"]); ?>" target="_blank">-->
<!--<div class="review">-->
<!--<div style="overflow: hidden;">-->
<!--<img class="img-responsive" src="<?php echo ($art["face_image"]); ?>" alt="" style="width: 373.324px; height: 233.636px;">-->
<!--<div class="background">-->
<!--<h3><?php echo ($art["title"]); ?></h3>-->
<!--<div class="time-zan">-->
<!--<div class="time"><?php echo ($art["create_time"]); ?></div>-->
<!--&lt;!&ndash;<div class="zan">21 <span class="glyphicon glyphicon-heart"></span></div>&ndash;&gt;-->
<!--</div>-->
<!--<?php if($i == 1): ?>-->
<!--<p class="height">产品寄语：<span class="send_word"><?php echo ($art["send_word"]); ?></span></p>-->
<!--<?php else: ?>-->
<!--<p>产品寄语：<span class="send_word"><?php echo ($art["send_word"]); ?></span></p>-->
<!--<?php endif; ?>-->
<!--<a type="button" class="btn btn-orange-five" href="http://kllife.com/home/index.php?s=/home/line/article/id/<?php echo ($art["id"]); ?>" target="_blank">查看</a>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</a>-->
<!--<?php } ?>-->
<!--<a href="http://kllife.com/home/index.php?s=/home/line/article" target="_blank"><h3 class="h3">查看更多线路 <span><i class="iconfontyyy">&#xe624;</i></span></h3></a>-->
<!--</div>-->

<script type="text/javascript">
    $('body').css('background', '#f2f4f5');
    //circuit-item
    $(".circuit-item").on("mouseover",function(){
        $(this).find(".name").show();
    })
    $(".circuit-item").on("mouseout",function(){
        $(this).find(".name").hide();
    })

    // 切换标签页
    function changeTab() {
        clearTravelLines();
        var activeObj = $('.index-line').find('.place-name').find('.new-tag .active');
        if ($(activeObj).length == 0) {
            toastr.warning('没有选定旅拍产品的标签');
            return false;
        }

        var tabset = $(activeObj).attr('data-set');
        $('.travel_tab_line').each(function(i,obj){
            $(this).find('.tab_set_image').attr('data-set', tabset+'_line_image_'+i);
        });

        var findKeyValue = $(activeObj).attr('data-set')+'%';
        $.post('<?php echo U("line/find");?>', {op_type: 'find_config', key: findKeyValue, op:'LIKE'}, function(data){
            if (data.ds != null && data.ds != 'undefined') {
                var idx = 0;
                for (x in data.ds) {
                    if (x.indexOf('travel_tab_') == 0 && x.indexOf('_line_') != -1 && x.indexOf('_line_image_') == -1) {
                        var d = data.ds[x];
                        var rootObj = $('.index-line').find('.travel_tab_line:eq('+idx+')');
                        $(rootObj).find('h2').html(d.title);
                        var infoUrl = '<?php echo U("line/info");?>/id/'+d.id;
                        $(rootObj).find('.tab_set_line').attr('href', infoUrl);
                        var imgKey = $(rootObj).find('.tab_set_image').attr('data-set');
                        $.ajax({
                            url: '<?php echo U("line/find");?>',
                            async: false,
                            type: 'POST',
                            dataType: 'json',
                            data: {op_type: 'find_config', key:imgKey},
                            success : function(imgData){
                                if (imgData.ds == null || imgData.ds == 'undefined') {
                                    $(rootObj).find('img').attr('src', d.img1);
                                } else {
                                    $(rootObj).find('img').attr('src', imgData.ds[imgKey]);
                                }
                            }
                        });
                        idx ++;
                    }
                }
            }
            if (data.result != null && data.result != 'undefined') {
                toastr.error(data.result.errno);
            }
        });
    }

    function selectTag(ev) {
        ev.preventDefault();
        $(this).closest('.place-name').find('.new-tag a').removeClass('active');
        $(this).addClass('active');
        changeTab();
    }

    function clearTravelLines() {
        $('.index-line').find('.travel_tab_line').each(function(){
            $(this).find('.tab_set_image').attr('data-set', '');
            $(this).find('.tab_set_image').prev().find('img').attr('src', '');
            $(this).find('h2').html('');
        });
    }
    //鼠标滚动简介动画显示
    $(window).scroll( function (){
        if($(this).scrollTop() > 100 ) {
            $('.index-company-profile .mask').addClass('animated bounceInLeft');
            $('.index-company-profile h2').addClass('animated bounceInRight');
            $('.index-company-profile .profile').addClass('animated bounceInUp');
        }
    });
    //旅拍作品鼠标滑过显示与隐藏旅拍作品遮罩层
    $(".index-works .works").on("mouseenter",function() {
        $(this).find(".animated").show();
        $(this).find("div").addClass("slideInLeft")
        $(this).find(".lg").addClass("fadeInDown")
        $(this).find(".sm").addClass("fadeInUp")
    })
    $(".index-works .works").on(" mouseleave",function() {
        $(this).find(".animated").hide();
    })
    //旅拍线路鼠标滑过显示与隐藏旅拍作品遮罩层
    $(".index-line .relative-line").on("mouseenter",function() {
        $(this).find(".animated").show();
        $(this).find("div").addClass("slideInLeft")
        $(this).find("h2").addClass("fadeInDown")
        $(this).find(".btn").addClass("fadeInUp")
    })
    $(".index-line .relative-line").on(" mouseleave",function() {
        $(this).find(".animated").hide();
    })

    //慢旅行鼠标划入
    $(".index-travel .recommended-circuit").on("mouseenter",function() {
        $(this).find(".btn").addClass("btn-orange-active");
        $(this).find(".right h2").addClass("active");
        $(this).find(".right  h3").addClass("active");
    })
    $(".index-travel .recommended-circuit").on(" mouseleave",function() {
        $(this).find(".btn").removeClass("btn-orange-active");
        $(this).find(".right h2").removeClass("active");
        $(this).find(".right  h3").removeClass("active");
    })


    // 标签的选择
    $('.place-name').find('.new-tag').find('a.set_tab').click(selectTag);

</script>
<style>
	.footer-bottom-content span{margin-right:0px;}
</style>
	<footer>
		<!--<?php echo p_a($question_type);?>-->
		<div class="footer-content">
			<div class="footer-content-left">
				<?php if(is_array($question_type)): $i = 0; $__LIST__ = $question_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$qt): $mod = ($i % 2 );++$i; if ($key === 'config_update_time') { continue; } ?>
					<ul class="<?php echo ($qt["class"]); ?>">
						<li><?php echo ($qt["type_desc"]); ?></li>
						<?php if(is_array($qt["questions"])): $i = 0; $__LIST__ = $qt["questions"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$quest): $mod = ($i % 2 );++$i;?><li><a target="_blank" href="<?php echo U('service/question');?>/id/<?php echo ($quest["id"]); ?>"><?php echo ($quest["content"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<div class="footer-content-right">
				<img src="http://kllife.com/source/Static/qinglvpai/common/images/footer_erweima.png" alt="">
			</div>
		</div>
	</footer>
	<div class="footer-bottom">
		<div class="footer-bottom-content">
			<!--<p>
				友情链接：
				<?php if(is_array($pcset)): $i = 0; $__LIST__ = $pcset;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$set_val): $mod = ($i % 2 );++$i; if(stripos($key, 'pc_friend_link') === 0): if(!empty($fk)): ?>&nbsp;|&nbsp;<?php endif; ?>
						<?php $fk = json_decode($set_val, true); ?>
						<a href="<?php echo ($fk["url"]); ?>" target="_blank"><?php echo ($fk["text"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</p>-->
			<span style="margin-top: 20px;">Copyright  2017 <a href="http://www.kllife.com/qinglvpai" target="_blank" style="color:#fff;">xinlvpai.com</a> | 杭州浪客旅行社有限公司版权所有</span>
			<br>
			<span>旅行社经营许可证号：ZJ30301 浙ICP备17010959号
			<span>
				<!--商务通代码--> 
				<script language="javascript" src="http://pqt.zoosnet.net/JS/LsJS.aspx?siteid=PQT43116159&float=1&lng=cn"></script>
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
			</span>
		</div>
	</div>
	
	<!-- Imported toastr -->
	<script src="http://kllife.com/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="http://kllife.com/source/Static/common/js/functions.js"></script>
	
	
</body>
</html>