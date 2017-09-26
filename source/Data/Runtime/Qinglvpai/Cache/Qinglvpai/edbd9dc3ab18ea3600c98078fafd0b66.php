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
    <!--图标-->
    <link type="image/x-icon" rel="shortcut icon" href="http://kllife.com/source/Static/qinglvpai/common/images/favicon.ico" />
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
                <a href="<?php echo U('line/list');?>" target="_blank">跟拍游</a>
                <a href="<?php echo U('line/slowly');?>" target="_blank">小团慢旅行</a>
                <a href="<?php echo U('Leader/list');?>" target="_blank">摄影师</a>
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
					<a href="<?php echo U('user/exit');?>">退出</a><?php endif; ?>
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
<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/bootstrap.min.css" />
<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/animate.css" />
<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/fresco/fresco.css" />
<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/article_list.css"/>
<!-- 弹出图片 -->
<div class="popup">
	<div class="header">
		搞笑
	</div>
	<div class="content">
		<a href="javascript:;" style="position: relative;display: inline-block;overflow: hidden;">
			<img class="img" src="http://kllife.com/source/Static/qinglvpai/images/index/banner.png" />
			<div class="word" style="position: absolute;padding-left:30px;font-size:16px;bottom:0px;color:#fff;width:100%;height:60px;line-height:60px;background: rgba(0,0,0,0.7);">
				这里是描述文字
			</div>
			<!--分享-->
			<a href="javascript:;" style="position: absolute;display: inline;top:0px;right:-50px;height:100px;height:100px;"><img src="http://kllife.com/source/Static/qinglvpai/images/article/share.png" alt=""></a>
			<!--关闭-->
			<a class="closed" href="javascript:;" style="position: absolute;display: inline;top:0px;right:-150px;height:100px;height:100px;text-decoration: none;"><span class="glyphicon glyphicon-remove" style="display:block;color:#fff;font-size: 30px;"></span></a>
		</a>
		<div class="div_perview_button"><span class="glyphicon glyphicon-menu-left"></span></div>
		<div class="div_next_button"><span class="glyphicon glyphicon-menu-right"></span></div>
	</div>
</div>

<!--列表-->
<div class="list-group">
	<div class="line">
		<h3>写真作品</h3>
	</div>
</div>

<div id='page'>
	<div class='demonstrations'>
		<?php if(is_array($articles)): $i = 0; $__LIST__ = $articles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i;?><a href='<?php echo U("article/info");?>/id/<?php echo ($art["id"]); ?>' target="_blank" class='fresco' data-fresco-group='example' data-id="<?php echo ($art["id"]); ?>">
				<img style="height:289px;" class="img-responsive" src='<?php echo ($art["face_image"]); ?>' alt=''/>
				<div class="animated"><!-此div只用于遮罩层-></div>
				<span class="lg animated"><?php echo ($art["title"]); ?></span>
				<span class="sm animated">作者：<?php echo ($art["account"]["show_name"]); ?></span>
			</a><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
</div>

<div class="block popup-layer-title"></div>
<div class="block popup-layer-content"></div>
<a href="javascript:;">
	<div class="block popup-layer-image">
		<img style="position: fixed;top:90px;right:225px;" src='' alt=''/>
	</div>
</a>
<!--查看更多-->
<div class="add more" data-more="1" data-page-index="0">查看更多</div>
<!--[if lt IE 9]-->
<!--<script type='text/javascript' src='http://kllife.com/source/Static/qinglvpai/js/css3-mediaqueries.js'></script>-->
<!--&lt;!&ndash; Fresco &ndash;&gt;-->
<!--<script type="text/javascript" src="http://kllife.com/source/Static/qinglvpai/js/fresco.js"></script>-->
<script>

    //头部点击选中状态
    $(".header ul a").on("click",function(){
        $(this).addClass("active").siblings("a").removeClass("active");
    })

    //旅拍作品鼠标滑过显示与隐藏旅拍作品遮罩层
    $(".fresco").on("mouseenter",function() {
        $(this).find(".animated").show();
        $(this).find("div").addClass("slideInLeft")
        $(this).find(".lg").addClass("fadeInDown")
        $(this).find(".sm").addClass("fadeInUp")
    })

    $(".fresco").on(" mouseleave",function() {
        $(this).find(".animated").hide();
    })

    // 刷新列表
    function findMore() {
    	if ($('.more').attr('data-more') != '1') {
			$('.more').attr('data-more','0');
			$('.more').html('没有更多的数据了');
    		return false;
    	}
		var pageIndex = parseInt($('.more').attr('data-page-index'))+1;
		var jsonData = {
			op_type: 'list',
			page: pageIndex,
		};
		
		$.post('<?php echo U("article/list");?>', jsonData, function(data){
			if (data.result.errno == 0) {
				if (data.ds != null && data.ds != 'undefined') {
					for (var i=0; i < data.ds.length; i++) {
						var d = data.ds[i];
						var linePrice = '0.00';
						if (d.min_batch != null) {
							linePrice = d.min_batch.price_state != null ? '核算中' : d.min_batch.price_adult;
						} else {
							linePrice = d.free_line == 0 ? '0.00' : '核算中';		   	
						}
						
						
						var vhtml = '<a href="'+'<?php echo U("article/info");?>/id/'+d.id+'" target="_blank" class="fresco" data-fresco-group="example" data-id="'+d.id+'">'+
									'	<img style="height:289px;" class="img-responsive" src="'+d.face_image+'" alt=""/>'+
									'	<div class="animated"><!-此div只用于遮罩层-></div>'+
									'	<span class="lg animated">'+d.title+'</span>'+
									'	<span class="sm animated">作者：'+d.account.show_name+'</span>'+
									'</a>';
						$('.demonstrations').append(vhtml);
						$('.more').attr('data-page-index', pageIndex);
					}
					if (data.ds.length < data.page_size || pageIndex >= data.page_count) {
						$('.more').attr('data-more','0');
						$('.more').html('没有更多的数据了');
					}
				} else {
					$('.more').attr('data-more','0');
					$('.more').html('没有更多的数据了');
				}
			} else {
				$('.more').html(data.result.message);
			}
		});
    }
    
    $('.more').click(findMore);
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
			<span style="margin-top: 20px;">Copyright  2017 <a href="http://xiezhenlvxing.com" target="_blank" style="color:#fff;">xiezhenlvxing.com</a> | 杭州浪客旅行社有限公司版权所有</span>
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