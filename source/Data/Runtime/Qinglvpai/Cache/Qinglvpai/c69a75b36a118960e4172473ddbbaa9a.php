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
<!-- 私有样式 -->
<link rel="stylesheet" href="http://kllife.com/source/Static/home/css/common_problem.css">
<style type="text/css">
	#content {margin-top: 0px;}
	.common-problem-left { width: 260px; }
	.common-problem-right { width: 900px; }
	.answer-problem img { width: 100%; }
</style>
	<div id="content">
		<!-- 面包屑导航 -->
		<div class="bread-nav">
			<a href="<?php echo U('index/welcome');?>" target="_blank">轻旅拍首页</a>
			>
			<a class="bread-final" href="javascript:;">常见问题</a>
		</div>
		<div class="common-problem-content">
			<!-- 左半部分 -->
			<div class="common-problem-left">
				<?php if(is_array($service_question)): $i = 0; $__LIST__ = $service_question;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$qt): $mod = ($i % 2 );++$i;?><div class="<?php echo ($qt["class"]); ?>">
						<h3 style="text-align: left;"><?php echo ($qt["type_desc"]); ?></h3>
						<?php if(is_array($qt["questions"])): $i = 0; $__LIST__ = $qt["questions"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$quest): $mod = ($i % 2 );++$i; if($quest['id'] == $show_question['id']): ?><p><a class="checked-problem" href="javascript:;" data-id="<?php echo ($quest["id"]); ?>"><?php echo ($quest["content"]); ?></a></p>
							<?php else: ?>
								<p><a href="javascript:;" data-id="<?php echo ($quest["id"]); ?>"><?php echo ($quest["content"]); ?></a></p><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<!-- 右半部分 -->
			<div class="common-problem-right">
				<div class="answer-problem">
					<h4><?php echo ($show_question["content"]); ?></h4>
					<?php if(is_array($show_question["answers"])): $i = 0; $__LIST__ = $show_question["answers"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$answer): $mod = ($i % 2 );++$i; echo ($answer["content"]); endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
		</div>
	</div>	
	
	<script>
	
		//左部-to-右部
		$('.common-problem-left a').click( function () {
			var jsonData = {
				id: $(this).attr('data-id'),
			}
			
			$('.common-problem-left a').removeClass('checked-problem');
			$(this).addClass('checked-problem');		
			
			$.post('<?php echo U("service/question");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					if (data.ds != null) {
						var vhtml = '<div class="answer-problem">'+						
									'	<h4>'+data.ds.content+'</h4>';
						for (var i = 0; i < data.ds.answer_count; i++) {
							var d = data.ds.answers[i];							
							vhtml += d.content;
						}
						vhtml += '</div>';
						$('.common-problem-right').html(vhtml);
					}
				} else {					
					alert(data.result.message);
				}
			});
			
			var scollPosition = parseInt($('.common-problem-right').offset().top)-150;
			$('html,body').animate({scrollTop: scollPosition},500);
		} );
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
<script type="text/javascript" src="http://kllife.com/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>
<script type="text/javascript">
    jQuery(document).ready(
        function($){
            $("img").lazyload({
                placeholder : "http://kllife.com/source/Static/qinglvpai/common/js/grey.gif",
                effect      : "fadeIn",
                threshold : 100,
                failure_limit : 10
            });
        });
</script>