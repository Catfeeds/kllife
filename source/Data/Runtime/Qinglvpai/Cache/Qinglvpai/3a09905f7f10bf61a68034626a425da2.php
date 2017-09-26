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
	<!-- 日历 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/jcDate.css">
	<!-- 私有样式 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/css/content.css">
	
	<style type="text/css">
		.right-content-top h3{text-align: left;}
		.fixed-top { 		
			top: 80px; 			
    		border-top: 1px solid #e1e1e1; 
    		border-bottom: 1px solid #e1e1e1;     		
    	}
    	
    	#jcDayWrap ul li.jcDateColor {
    		min-width: 88px;
    		min-height: 57px;
    	}
		.qj-box-content p{color:#333;}
		.content-list-to .content-list-to-reserve{background: #ff1c77;}
		.content-list-to a:hover,.information-details-content p span,.information-details-content p span,.information-details-content p span,.qj-explain-content h6,.qj-box-content h6{color:#ff1c77;}
		.immediate-reservation a{background: #ff1c77;}
		.right-content-top > .right-content-money > span > strong,.swiper_wrap a,.right-content-top > .right-content-money > a,.travel-arrangements-days > span,.bread-nav,.information-money{color:#ff1c77;}
		#jcDayCon dt:first-child,#jcDayCon dt:last-child,.bread-nav u .shendu{background:#ff1c77;color:#fff;}
		.information-money{text-align: left;}
		.travel-arrangements-list a.arrangements-checked,.travel-arrangements-list a:hover{background: url(http://kllife.com/source/Static/qinglvpai/images/list/travel_arrangements_day_bg_checked.png);}
		.jiriyou{background: url('http://kllife.com/source/Static/qinglvpai/images/list/day_bg.png')}
	
			
		.location-station-tel {
			
			font: 20px '微软雅黑';
			
			font-weight: 900 !important;
			
			color: #ff1477 !important;
			
		}
		
		.immediate-reservation a {
			
			padding-top: 9px;
			
			height: 52px;
		}
			
	</style>
	
	<!-- 日历项模板 -->	

	<div class="information template_date_item hidden_ctrl">

		<img src="http://kllife.com/source/Static/home/images/content_img/yellow_arrow_bottom.png" alt="" />

		<p class="information-state"></p>

		<p class="information-money">元</p>

		<div class="information-details">

			<div class="information-details-content">

				<p><span class="information-people">余</span></p>

				<p>成人价：<span class="adult-money"></span>元/人</p>

				<p>儿童价：<span class="children-money"></span>元/人</p>

			</div>

		</div>

	</div>	

	
	<!-- 已报名列表 -->
	
	<?php if(empty($orders) == false): ?><div class="enrol-mark"></div>

	<div class="enrol-list">

		<a class="close-enrol-list" href="javascript:;">

			<img src="http://kllife.com/source/Static/home/images/content_img/close_enrol.png" alt="">

		</a>

		<a class="backTop-enrol-list" href="javascript:;">

			<img src="http://kllife.com/source/Static/home/images/content_img/top_enrol.png" alt="">

		</a>
		
		<h2>报名列表 >> <?php echo ($line["subheading"]); ?></h2>

		<div class="enrol-list-content">

			<div class="enrol-list-content-head">

				<span>用户昵称</span><span>地区</span><span>申请人数</span><span>报名时间</span><span>审核状态</span>

			</div>

			<table>
				
				<?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order_list): $mod = ($i % 2 );++$i;?><thead>

						<tr>

							<th colspan="5"><?php echo ($order_list["hdid_show_text"]); ?></th>

						</tr>

					</thead>

					<tbody>
				
					<?php if(is_array($order_list['data'])): $idx = 0; $__LIST__ = $order_list['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($idx % 2 );++$idx;?><tr>

							<td>
								<?php if(empty($order['names']) == false): echo ($order["names_show"]); ?>
								<?php else: ?>
									<?php echo ($order["mob_show"]); endif; ?>
							</td>

							<td><?php echo ($order["city"]); ?></td>

							<td><?php echo ($order["member_total_count"]); ?>人</td>

							<td><?php echo ($order["addtime_show"]); ?></td>

							<td style="color: <?php echo ($order["zhuangtai_color"]); ?>;"><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></td>

						</tr><?php endforeach; endif; else: echo "" ;endif; ?>

					</tbody><?php endforeach; endif; else: echo "" ;endif; ?>

			</table>

		</div>

	</div><?php endif; ?>



	<!-- 主要内容 -->

	<div id="content">
		<!-- 面包屑导航 -->

		<div class="bread-nav">
			<u>
				<?php if($line['station_data'][0]['attached'] == '1'): $themeClasses=array('shendu','sheying','zhuti') ?>
					
					<?php if(is_array($line["theme_type_list"])): $i = 0; $__LIST__ = $line["theme_type_list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$theme): $mod = ($i % 2 );++$i; $theme_class = $themeClasses[$key % count(themeClasses)] ?>

						<a class="<?php echo ($theme_class); ?>" href="javascript:;"><?php echo ($theme["type_desc"]); ?></a>
						
						<div class="qj-box">
						
							<img src="http://kllife.com/source/Static/home/images/content_img/yellow_arrow_top.png" alt="">
							
							<div class="qj-box-content">
							
								<h6><?php echo ($theme["type_desc"]); ?></h6>
								
								<?php if($theme["type_desc"] == '小团慢旅行'): ?><p>小团慢旅行是指在单团人数控制在28人以内，让旅行整体节奏和行进速度慢下来的同时，还要在美景中漫步呼吸，品味悠然新心情，为不期而遇的风景停车，与当地人充分互动，尽量与美景相拥而眠的高品质旅行。</p>
									
								<?php elseif($theme['type_desc'] == '免费活动'): ?>
								
									<p>领袖户外旅行网提供的免费游玩活动，包括郊游、徒步、桌游等项目。</p>
									
								<?php elseif($theme['type_desc'] == '周边游'): ?>
								
									<p>领袖户外或领袖户外严选本地有旅行社资质的户外旅游合作商提供的周边游产品。</p>
								
								<?php elseif($theme['type_desc'] == '摄影游'): ?>
								
									<p>领袖户外摄影创作团，为摄影爱好者提供全面、深度、准确的摄影创作服务。</p>
									
								<?php elseif($theme['type_desc'] == '民族行'): ?>
								
									<p>户外旅游综合平台，由具有完整资质的户外旅游机构提供服务的旅行服务。</p>
									
								<?php else: ?>	
								
									<p>本产品由领袖户外提供相关服务</p><?php endif; ?>
								
							</div>
							
						</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
				
				产品编号：<?php echo ($line["id"]); ?>
				
				<?php if ($line['station_data'][0]['attached'] == '1') { ?>
				
					<?php if($line['theme_type_show_text'] == '小团慢旅行'): ?><span>本产品由领袖户外独立策划并独立发团</span>
					
					<?php else: ?>				
					
						<?php if($line["extra"] == 1): ?><span>本产品由领袖户外或领袖户外委托有资质的合作旅行社及户外机构提供相关服务</span>
						
						<?php else: ?>
						
						<span>本产品由领袖户外提供相关服务</span><?php endif; endif; ?>
					
				<?php } else { ?>
						
					<span>本产品由<?php echo ($line['station_data'][0]['intro']); ?>提供相关服务</span>				
				
				<?php } ?>
			</u>
		</div>

		<!-- 行程概览 -->

		<div class="travel-overview">

			<div class="travel-overview-left">

				<div class="travel-overview-left-top">

					<img src="<?php echo ($line["img1"]); ?>" alt="">

				</div>

				<div class="travel-overview-left-bottom">

					<div class="jcDate"></div>

				</div>

			</div>

			<div class="travel-overview-right">
			
				<div class="jiriyou">
					<p><?php echo ($line["travel_day"]); ?>日游</p>
				</div>

				<div class="travel-overview-right-content">

					<div class="right-content-top">

						<div class="line-title">
							<h2>
								<span id="line-title"><?php echo ($line["title"]); ?></span>
							</h2>
							<div class="share">
								<i class="weibo" onclick="window.open('http://service.weibo.com/share/share.php?url='+encodeURIComponent(document.location.href)+'&title='+ document.getElementById('line-title').innerText +'————' + document.getElementById('line-subheading').innerText);return false;"></i>
								<i class="weixin"></i>
								<div class="share-code">
									<h4>分享到朋友圈<a href="javascript:;">x</a></h4>
									<div id="code"></div>
									<p>打开微信，点击底部的"发现"，</p>
									<p>使用"扫一扫"即可将网页分享至朋友圈。</p>
								</div>
								<i class="qzone" onclick="window.open('http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+encodeURIComponent(document.location.href)+'&title='+ document.getElementById('line-title').innerText +'————' + document.getElementById('line-subheading').innerText );return false;"></i>
							</div>
						</div>

						<h3 id="line-subheading"><?php echo ($line["subheading"]); ?></h3>
						
						<div class="right-content-money">

							<span>
									
								<?php if(empty($line['check_price'])): ?><strong>核算中</strong>
								
								<?php else: ?>
								
									￥<strong><?php echo ($line["start_price_adult"]); ?></strong>元/成人

									<i>(<?php echo ($line["start_price_child"]); ?>/儿童)</i><?php endif; ?>

							</span>
							
							<?php if(!empty($line["start_price_explain"])): ?><a href="javascript:;">起价说明</a>

								<div class="qj-explain">

									<img src="http://kllife.com/source/Static/home/images/content_img/yellow_arrow_top.png" alt="">

									<div class="qj-explain-content">

										<h6>起价说明</h6>

										<p><?php echo ($line["start_price_explain"]); ?></p>

									</div>

								</div><?php endif; ?>

						</div>

					</div>

				</div>

				<div class="right-content-bottom">

					<?php if(empty($line['batch']) == false): ?><p><i class="ctrs"></i><b>成团人数：</b><?php echo ($line["success_team_count"]); ?>人 &nbsp;&nbsp; <b>满团人数：</b><?php echo ($line["max_team_count"]); ?>人 </p>

					<?php else: ?>

						<p><i class="ctrs"></i><b>成团人数：</b>0人 &nbsp;&nbsp; <b>满团人数：</b><?php echo ($line["max_team_count"]); ?>人</p><?php endif; ?>

					<?php if(empty($line['assembly_point_show_text']) == false): ?><p><i class="jhdd"></i><b>集合地点：</b><?php echo ($line["assembly_point_show_text"]); ?></p>

					<?php else: ?>

						<p><i class="jhdd"></i><b>集合地点：</b>全国各地</p><?php endif; ?>

					<p><i class="rcsj"></i><b>发团时间：</b><?php echo ($line["start_time"]); ?>-<?php echo ($line["end_time"]); ?></p>

					<div id="xlcjl">

						<i class="xlcjl"></i><a href="javascript:;">线路成交量</a>：<?php echo ($order_member_count); ?>

						<!-- 滚动报名 -->

						<div class="swiper_wrap">

							<ul class="font_inner">
							
								<?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order_list): $mod = ($i % 2 );++$i; if(is_array($order_list["data"])): $i = 0; $__LIST__ = $order_list["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><li><a href="javascript:;">用户<?php echo ($order["mob_show"]); ?>预订<?php echo ($order["hdid_data"]["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>

							</ul>

						</div>

					</div>
					
					<?php if(!empty($line["send_word"])): ?><p id="cpjy"><i class="cpjy"></i><span><b>产品寄语：</b><?php echo ($line["send_word"]); ?></span></p><?php endif; ?>

					<p id="xcgy"><i class="xcgy"></i><em>[详情请点击]</em><span><b>行程概要：</b>

						<?php $travelCount = count($line['travels']); foreach($line['travels'] as $tk=>$travel){ echo('D'.($tk+1).' > <u>'.$travel['title'].'</u>'); } ?>

					<div id="cfrq">

						<i class="cfrq"></i><b>出发日期：</b>

						<div class="cfrq-choose">

							<span class="cfrq_select_batch" data-id="0">请选择出发日期</span>

							<div class="cfrq-show hidden_ctrl">

								<u>未知时间</u>出发

								,

								<u>未知时间</u>返回

							</div>

							<img src="http://kllife.com/source/Static/home/images/content_img/down.png" alt="">

							<ul class="cfrq_batch_list">

								<?php foreach($line['batchs'] as $bk=>$bv) { echo('<li data-id="'.$bv['id'].'" data-val="'.$bv['start_date_show'].'" data-end-date="'.$bv['end_date_show'].'" data-state="'.$bv['state_data']['type_key'].'">'.$bv['start_date_show'].'['.$bv['state_data']['type_desc'].']</li>'); } ?>

							</ul>

						</div>

					</div>

					<div id="cyrs">

						<i class="cyrs"></i><b>出游人数：</b>
						<?php if(empty($check['only_child']) == true): ?><div class="adult-num adult_male">
								<u>成人男</u>
								<a class="add-adult add-adult-woman" href="javascript:;"><i class="adult-add"></i></a>
								<span>0</span>
								<a class="minus-adult minus-adult-man" href="javascript:;"><i class="adult-minus"></i></a>
							</div>
							<div class="adult-num adult_woman">
								<u>成人女</u>
								<a class="add-adult add-adult-woman" href="javascript:;"><i class="adult-add"></i></a>
								<span>0</span>
								<a class="minus-adult minus-adult-woman" href="javascript:;"><i class="adult-minus"></i></a>
							</div><?php endif; ?>		
						<?php if(empty($check['only_adult']) == true): ?><div class="children-num">
								<u>儿童</u>
								<a class="add-children" href="javascript:;"><i class="children-add"></i></a>
								<span>0</span>
								<a class="minus-children" href="javascript:;"><i class="children-minus"></i></a>
							</div><?php endif; ?>						

					</div>

					<div class="immediate-reservation">
						
						<?php if($line['station_data'][0]['attached'] == 1): ?><p style="height: 52px; position: relative;">
						
								<img src="http://kllife.com/source/Static/qinglvpai/images/index/tel.png" alt="">
								
							</p>
						
							<span class="zixun"><img src="http://kllife.com/source/Static/qinglvpai/images/list/zixun.gif" alt=""></span>
						
						<?php else: ?>

							<p style="height: 52px; position: relative;">
						
								<img style="margin-left: 58px;" src="http://kllife.com/source/Static/qinglvpai/images/list/tel_location.png" alt=""> <br>
								
								<b class="location-station-tel"><?php echo ($line['station_data'][0]['tel']); ?></b>
								
							</p><?php endif; ?>

						<a class="book_order_now" href="javascript:;">立即预定</a>
						
						<div>
						
							本产品在线咨询讨论QQ群：<em><?php echo ($line["seek_qq"]); ?></em>
							
							<?php if(empty($line['qq_verify']) == false): ?><em>( 进群验证“<?php echo ($line["qq_verify"]); ?>”)</em><?php endif; ?>
						
						</div>
						
					</div>

					<div class="srdz">

						<a href="<?php echo ($pcset["team_link"]); ?>" target="_blank"><img src="http://kllife.com/source/Static/home/images/content_img/content_srdz.gif" alt=""></a>

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- 导航栏 -->

	<div class="content-list">

		<div class="content-list-to">

			<a class="content-list-to-highlights" href="#travel-highlights">行程亮点</a>

			|

			<a class="content-list-to-arrangements" href="#travel-arrangements">行程说明</a>

			|

			<a class="content-list-to-notes" href="#travel-notes">游记攻略</a>

			|

			<a class="content-list-to-attention" href="#content-money">费用详细</a>

			|

			<a class="content-list-to-visa" href="#content-reserve">预定须知</a>

			|

			<a class="content-list-to-scenery" href="#content-scenery">沿途风光</a>

			<!--|-->

			<!--<a class="content-list-to-question" href="#ask-question">产品问答</a>-->
			
			<?php if(empty($duid) == false): ?><a class="content-list-to-reserve" href="<?php echo U('line/order');?>/id/<?php echo ($line["id"]); ?>/duid/<?php echo ($duid); ?>/type/create" target="_blank">立即预定</a>
				
			<?php else: ?>
			
				<a class="content-list-to-reserve" href="<?php echo U('line/order');?>/id/<?php echo ($line["id"]); ?>/type/create" target="_blank">立即预定</a><?php endif; ?>			

		</div>

	</div>



	<!-- 行程亮点 -->

	<div class="travel-highlights">

		<h3 id="travel-highlights">行程亮点</h3>

		<div style="width: 100%; overflow: hidden;">

			<?php if(is_array($line["points"])): $i = 0; $__LIST__ = $line["points"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lp): $mod = ($i % 2 );++$i; if($lp["content"] != ''): ?><p><?php echo ($lp["content"]); ?></p><?php endif; ?>

				<?php if($lp["image_url"] != ''): ?><img src="<?php echo ($lp["image_url"]); ?>" alt=""><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			
			<!--在这里添加文字-->
			
			<!--<span></span>-->

		</div>

	</div>

	

	<!-- 行程说明 -->

	<div class="travel-arrangements">

		<div class="travel-arrangements-content">

			<h3 id="travel-arrangements">行程说明</h3>

			<div class="travel-arrangements-list">

				<span>

					<img src="http://kllife.com/source/Static/home/images/content_img/travel_arrangements_day_begin.png" alt="">

				</span>

				<em>——</em>
				<?php $__FOR_START_1074133311__=1;$__FOR_END_1074133311__=$line['real_travel_day'];for($i=$__FOR_START_1074133311__;$i <= $__FOR_END_1074133311__;$i+=1){ ?><a class="day<?php echo ($i); ?>" href="#day<?php echo ($i); ?>">

						<p><?php echo ($i); ?></p>

						Day

					</a>

					<em>——</em><?php } ?>

				<span>

					<img src="http://kllife.com/source/Static/home/images/content_img/travel_arrangements_day_end.png" alt="">

				</span>

			</div>

			<div class="travel-arrangements-alldays">

				<input id="travel_day" type="hidden" value="<?php echo ($line["real_travel_day"]); ?>"/>

				<?php if(is_array($line["travels"])): $i = 0; $__LIST__ = $line["travels"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$travel): $mod = ($i % 2 );++$i;?><div id="day<?php echo ($travel["day_id"]); ?>" class="travel-arrangements-days">

						<h4>Day<?php echo ($travel["day_id"]); ?>：<?php echo ($travel["title"]); ?></h4>
						
						<?php if(!empty($travel["view_point"])): ?><span><i class="days-zd"></i>浏览重点：<?php echo ($travel["view_point"]); ?></span><?php endif; ?>

						<p><?php echo ($travel["intro"]); ?></p>

						<div class="days-information">
						
							<?php if(!empty($travel["hotel"])): ?><span><i class="days-zs"></i>住宿：<?php echo ($travel["hotel"]); ?></span><?php endif; ?>
						
							<?php if(!empty($travel["eat_way"])): ?><span><i class="days-cy"></i>餐饮：<?php echo ($travel["eat_way"]); ?></span><?php endif; ?>

						
							

						</div>
						
						<?php if(!empty($travel["kindly_reminder"])): ?><div class="days-prompt">

								<span><i class="days-ts"></i>温馨提示：</span>

								<div class="prompt"><?php echo ($travel["kindly_reminder"]); ?></div>

							</div><?php endif; ?>

						<div class="days-img">					
						
							<?php if(!empty($travel["img1"])): ?><div class="days-img-left">

									<img src="<?php echo ($travel["img1"]); ?>" alt="">

									<p><?php echo ($travel["img1_desc"]); ?></p>

								</div><?php endif; ?>
							
						
							<?php if(!empty($travel["img2"])): ?><div class="days-img-left">

									<img src="<?php echo ($travel["img2"]); ?>" alt="">

									<p><?php echo ($travel["img2_desc"]); ?></p>

								</div><?php endif; ?>
							
						
							<?php if(!empty($travel["img3"])): ?><div class="days-img-left">

									<img src="<?php echo ($travel["img3"]); ?>" alt="">

									<p><?php echo ($travel["img3_desc"]); ?></p>

								</div><?php endif; ?>

						</div>

					</div><?php endforeach; endif; else: echo "" ;endif; ?>

			</div>

		</div>	

	</div>
	

	<!-- 费用详细 --> 

	<div class="content-money">

		<h3 id="content-money">费用详细</h3>

		<div class="content-money-describe">

			<div class="money-describe">

				<div class="describe-content">

				<?php echo ($line["cost_description"]); ?>

				</div>

			</div>

		</div>

	</div>

	<!-- 预定须知 -->

	<div class="content-reserve">

		<h3 id="content-reserve">预订须知</h3>

		<div class="content-money-describe">

			<div class="money-describe">

				<div class="describe-content">
				
					<p style="padding: 10px 0; color: #00f;">公告：领袖户外的行程安排可能会根据实际突发情况和队员反馈进行调整和优化，但调整不会涉及费用包含的景区、游览天数、集散地点以及住宿标准，最终行程安排以合同内容为准。</p>

					<?php echo ($line["booking_notes"]); ?>

				</div>

			</div>

		</div>

	</div>	

	<!-- 沿途风光 -->

	<div class="content-scenery">

		<h3 id="content-scenery">沿途风光</h3>

		<div class="scenery">

			<?php if(is_array($line["scenery"])): $i = 0; $__LIST__ = $line["scenery"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sc): $mod = ($i % 2 );++$i; if($sc["content"] != ''): ?><p><?php echo ($sc["content"]); ?></p><?php endif; ?>

				<?php if($sc["image_url"] != ''): ?><img src="<?php echo ($sc["image_url"]); ?>" alt=""><?php endif; endforeach; endif; else: echo "" ;endif; ?>

		</div>

	</div>
	
	
	<div class="mark"></div>
	<div id="alert-modal">
		
		<div class="alert-modal-top">
			<a href="javascript:;"><img src="http://kllife.com/source/Static/home/common/images/video_close.png"/></a>
		</div>
		<div class="alert-modal-content">
			<p></p>
		</div>
		
	</div>

<!-- 滚动 -->

<script src="http://kllife.com/source/Static/home/js/gundong.js"></script>
<script src="http://kllife.com/source/Static/home/js/jquery.qrcode.min.js"></script>
<!-- 日期 -->
<script src="http://kllife.com/source/Static/home/common/js/jQuery-jcDate.js"></script>
<!-- 轮播 -->
<script src="http://kllife.com/source/Static/home/js/unslider.min.js"></script>
<!-- 自绑定 -->
<script src="http://kllife.com/source/Static/home/common/js/showAndHide.js"></script>

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



	<script>
	
		//摄影游，民族行，深度游
		$('.bread-nav u a').each(function(){
			
			if($(this).text() == '摄影游') {
				$(this).addClass('sheying');
			}else if($(this).text() == '民族行'){
				$(this).addClass('zhuti');
			}
		});
		
		
		//识别中文二维码
		var oUrl = window.location.href;
		function toUtf8(oUrl) {    
		    var out, i, len, c;    
		    out = "";    
		    len = str.length;    
		    for(i = 0; i < len; i++) {    
		        c = str.charCodeAt(i);    
		        if ((c >= 0x0001) && (c <= 0x007F)) {    
		            out += str.charAt(i);    
		        } else if (c > 0x07FF) {    
		            out += String.fromCharCode(0xE0 | ((c >> 12) & 0x0F));    
		            out += String.fromCharCode(0x80 | ((c >>  6) & 0x3F));    
		            out += String.fromCharCode(0x80 | ((c >>  0) & 0x3F));    
		        } else {    
		            out += String.fromCharCode(0xC0 | ((c >>  6) & 0x1F));    
		            out += String.fromCharCode(0x80 | ((c >>  0) & 0x3F));    
		        }    
		    }    
		    return out;    
		} 
		
		$('.weixin').click(function(){
			if($(".share-code").css('display') != 'none'){
				return false;
			}else{
				$(".share-code").show();
			}
			
			$("#code").qrcode({
				render: "canvas", //canvas方式 
			    width: 185, //宽度 
			    height:185, //高度 
			    text: oUrl //任意内容 
			});
		});
		
		$('.share-code > h4 a').click(function(){
			$('.share-code').hide();
			$('#code').html('');
		});
		
		//详情点击
		$('#xcgy em').click(function(){
			$("html,body").animate({scrollTop: $('.travel-arrangements').offset().top - 200}, 500);
		});
	
		
		$('.alert-modal-top a').click(function(){
			$('.mark').hide();
			$('#alert-modal').hide();
		});
		
		// 在线咨询
		$('.immediate-reservation').find('.zixun').click(function(){
			window.open('<?php echo ($pcset["askfor_link"]); ?>');
		});
		
		// 立即预定
		$('.book_order_now').click(function(){
			
			var batchId = $('.cfrq_select_batch').attr('data-id');
			
			if (batchId == '0') {
				
				$('.mark').show()
				$('#alert-modal').show();
				$('#alert-modal').find('p').html('请选择出行的日期');
				setTimeout(function(){
					$('.mark').hide()
					$('#alert-modal').hide();
				},3000);
				//alert('请选择出行的日期');
				
				return false;
				
			}
			
			var male = parseInt($('.adult_male').find('span').html());
			
			var woman = parseInt($('.adult_woman').find('span').html());
			
			var child = parseInt($('.children-num').find('span').html());
			
			if ((male + woman + child) == 0) {
				
				$('.mark').show()
				$('#alert-modal').show();
				$('#alert-modal').find('p').html('出行的总人数不能小于1人');
				setTimeout(function(){
					$('.mark').hide()
					$('#alert-modal').hide();
				},3000);
				
				//alert('出行的总人数不能小于1人');
				
				return false;
				
			}
			
			if ('<?php echo ($duid); ?>' != '') {

                window.open( '<?php echo U("line/order");?>'+'/id/<?php echo ($line["id"]); ?>/duid/<?php echo ($duid); ?>/type/create/b/'+batchId+'/m/'+male+'/w/'+woman+'/ch/'+child);
				
			} else {

                window.open( '<?php echo U("line/order");?>'+'/id/<?php echo ($line["id"]); ?>/type/create/b/'+batchId+'/m/'+male+'/w/'+woman+'/ch/'+child);
				
			}
			
		});
		
		function testBatchClick(liObj) {		
			
			$('.cfrq_select_batch').attr('data-id', $(liObj).attr('data-id'));
			
			$('.cfrq_select_batch').html($(liObj).html());
			
			$('.cfrq-show').removeClass('hidden_ctrl');			
			
			var uObj = $('.cfrq-show').find('u');
			
			$(uObj[0]).html($(liObj).attr('data-val'));
			
			$(uObj[1]).html($(liObj).attr('data-end-date'));
			
			//高亮显示
			
			
			var dateNum = $(liObj).attr('data-val');
			
			var dateArray2 = [];
			
			dateArray2 = dateNum.split('-');
			
			if(parseInt(dateArray2[1])<10){
				
				dateArray2[1] = dateArray2[1].replace('0','');
				
			}
			
			if(parseInt(dateArray2[2])<10){
				
				dateArray2[2] = dateArray2[2].replace('0','');
				
			}
			
			dateNum = dateArray2.join('-');
			
			$('.jcDateColor').each(function(){
				
				if(dateNum == $(liObj).attr('data-date')){
					
					$(liObj).addClass('bg-high-color');

				}
				
			});
				
		}
		
		$(function(){
			// 批次列表选择跳转
			$('.cfrq_batch_list').find('li').click(function(){	
				
				testBatchClick($(this));
				
			});
		});
		
	
		// 页面加载完成
		$(document).ready(function(){
			
			var schedule = '<?php echo ($schedule); ?>';
			
			if (schedule != 'undefined') {
				
				$('html, body').stop().animate({scrollTop: $('.travel-arrangements-content').offset().top - 160 }, 0);
				
			}
			
			var fireJumped = false;
			$('.cfrq_batch_list').find('li').each(function(i, ev){
				var batchState = $(this).attr('data-state');
				if (batchState != 'line_batch_state_overdue') {
					if (fireJumped == false) {
						$(this).trigger('click');
						fireJumped = true;
					}
				}	
			});
			
		});

		//搜索栏

		$('.search-header input').focus(

			function () {

				$(this).stop().animate({width: '250px'}, 1000);

				$(this).next().stop().animate({left: '286px'}, 1000);

			}

		);

		$('.search-header input').blur(

			function () {

				$(this).stop().animate({width: '135px'}, 1000);

				$(this).next().stop().animate({left: '171px'}, 1000);

			}

		);

		//显示与隐藏

		$('.nav-list-top').showAndHide();

		//日历

		$(".jcDate").jcDate({					       

			IcoClass : "jcDateIco",

			Event : "click",

			Speed : 100,

			Left : 0,

			Top : 28,

			format : "-",

			Timeout : 100,
			
			funcRedraw: initCalendarBatch,

		});

		

		//判断哪一日为发团日

		$(document).ready(function(){
			var d = new Date();
			var year = d.getFullYear();

			// 初始化批次信息
			initCalendarBatch(year);

		});

		

		function finalDay() {

			for (var n = 1; n < $('.dateV li.jcDateColor').length + 1; n++) {

				if (n % 7 == 0) {

					$('.dateV li.jcDateColor:eq('+ (n - 1) +')').addClass('final-day');

				}

			};

		}

		

		// 初始化批次信息

		function initCalendarBatch(y) {

			var lineId = '<?php echo ($line["id"]); ?>';
			
			$.post('<?php echo U("line/content");?>', {type:'find_batch',line_id: lineId, year:y}, function(data){

				if (data.result.errno == 0) {

					var batchs = new Object();
					
					if (data.ds != null && typeof(data.ds) != 'undefined') {						
						for (var i = 0; i < data.ds.length; i++) {
										
							var tempDate = new Date(Date.parse(data.ds[i]['start_time'].replace(/-/g,"/")));
							var td = tempDate.getFullYear()+'-'+(tempDate.getMonth()+1)+'-'+tempDate.getDate();							
							batchs[td] = data.ds[i]; 
						}
					}				
					
					$('#jcDateMax li.jcDateColor').each( function(){
						
						var curDate = $(this).attr('data-date');
														
						if (typeof(batchs[curDate]) != 'undefined') {
						
							var b = batchs[curDate];

							var itemObj = $('.template_date_item').clone(true);

							$(itemObj).removeClass('template_date_item');

							$(itemObj).removeClass('hidden_ctrl');

							$(itemObj).find('img').attr('__PUBLIC_/home/images/content_img/yellow_arrow_bottom.png');

							$(itemObj).find('.information-people').html('余'+b.sub_member);

							var state = $.parseJSON(b.state);

							$(itemObj).find('.information-state').html(state.type_desc);
								
							if (b.price_adult == 0 && b.price_child == 0 && '<?php echo ($line["free_line"]); ?>' == '0') {

								$(itemObj).find('.adult-money').parent().html('成人价：<span class="adult-money">核算中</span>');

								$(itemObj).find('.children-money').parent().html('儿童价：<span class="children-money">核算中</span>');

								$(itemObj).find('.information-money').html('核算中');
									
							} else {

								$(itemObj).find('.adult-money').html(b.price_adult);

								$(itemObj).find('.children-money').html(b.price_child);

								$(itemObj).find('.information-money').html(b.price_adult+'元');
								
							}	
														
							$(this).addClass('gogogo');

							$(this).append(itemObj);
							
							
						}
						
					});
					
				} else {

					console.log(data.result.message);

				}
				
				finalDay();

			});			

		}

		

		//有备注的日期鼠标进入与移出

		$(document).on('mouseover mouseout', '.gogogo', function (event) {

			if(event.type == "mouseover"){

			  	$(this).find('.information-details').show();

				$(this).find('img').show();

			}else if(event.type == "mouseout"){

			 	$(this).find('.information-details').hide();

				$(this).find('img').hide();

			}

		});

		

		//有备注的日期点击后弹出周几

		$(document).on('click', '.gogogo', function () {
			//高亮显示
			$(this).parent('.dateV').find('.gogogo').removeClass('bg-high-color');
			
			$(this).addClass('bg-high-color');
			
			//获取日历上被点击的日期
			var  dateNum = $(this).attr('data-date'); 
			
			if(parseInt(dateNum.substr(5,2)) < 10){
				
				var dateArr1 = dateNum.split('-');
				
				dateArr1[1] = '0' + dateArr1[1];
				
				dateNum = dateArr1.join('-');
									
			};
			if(parseInt(dateNum.substr(-2,2)) < 10){
				
				var dateArr2 = dateNum.split('-');
				
				dateArr2[2] = '0' + dateArr2[2];
				
				dateNum = dateArr2.join('-');
									
			};
			
			$('.cfrq_batch_list li').each(function(){
				
				//当日历所点击日期与下拉列表日期一致时
				
				if( dateNum == $(this).attr('data-val') ){
					
					$('.cfrq_select_batch').attr('data-id', $(this).attr('data-id'));
					
					$('.cfrq-show').removeClass('hidden_ctrl');	
					
					$('.cfrq_select_batch').html($(this).html());
					
					var dObj = $('.cfrq-show').find('u');
				
					$(dObj[0]).html($(this).attr('data-val'));
					
					$(dObj[1]).html($(this).attr('data-end-date'));
					
				}
				
			});

		});
		//鼠标移出，下拉框收起
		$('.cfrq-choose').mouseleave(function(){
			
			$('.cfrq-choose').find('ul').hide();
				
		});
		

		//起价说明

		$('.right-content-money > a').hover( 
			function () {
				$('.qj-explain').show();
			} ,
			function () {
				$('.qj-explain').hide();
			}

		);
		
		// 产品主题类型浮动框
		
		$('.shendu').hover(
			function () {
				$('.qj-box').show();
			} ,
			function () {
				$('.qj-box').hide();
			}

		);

		

		$('.qj-explain').hover( 
			function () {
				$(this).show();
			},
			function () {
				$(this).hide();
			}
		);
		$('.qj-box').hover(
			function () {
				$(this).show();
			},
			function () {
				$(this).hide();
			}
		);

		

		//儿童标准

		$('.child-standard').hover( 

			function () {

				$('.childern-explain').show();

			} ,

			function () {

				$('.childern-explain').hide();

			}

		);

		

		$('.childern-explain').hover( 

			function () {

				$(this).show();

			},

			function () {

				$(this).hide();

			}

		);

		

		//出游人数增加

		function addNum( a ) {

			$(a).click(

				function () {

					var adult = parseInt($(this).next('span').html());

					$(this).next('span').html(++adult);

				}

			)

		};

		//出游人数减少

		function minusNum( b ) {

			$(b).click(

				function () {

					var adult1 = parseInt($(this).prev('span').html());

					//当出游人数大于1时

					if ( adult1 >= 1 ){

						$(this).prev('span').html(--adult1);

					}else {

						return;

					}	

				}

			);

		};

		addNum('.add-adult');

		minusNum('.minus-adult');

		addNum('.add-children');

		minusNum('.minus-children');


		//days图片描述

		$('.days-img-left').hover(

			function () {

				$(this).children('p').stop().animate({ bottom: '0' }, 500);

			},

			function () {

				$(this).children('p').stop().animate({ bottom: '-42px' }, 500);

			}

		);


		

		//游记

		$('.travel-notes-lunbo').unslider({ 

			dots: true

		});

		//点击线路成交量弹出

		$('#xlcjl').click( function () {

			$("html,body").animate({scrollTop: 0}, 500);

			$('.enrol-mark').show();

			$('.enrol-list').show();

		} );

		

		//点击遮罩层隐藏

		$('.enrol-mark').click( function () {

			$('.enrol-mark').hide();

			$('.enrol-list').hide();

		} );

			

		//点击关闭按钮隐藏

		$('.close-enrol-list').click( function () {

			$('.enrol-mark').hide();

			$('.enrol-list').hide();

		} );

		

		//列表回到顶部

		$('.backTop-enrol-list').click( function () {

			$("html,body").animate({scrollTop: 0}, 500);

		});
		
		//下部立即预定返回顶部
		$('.content-list-to-reserve').click(function(){
			$("html,body").animate({scrollTop: 120}, 500);
		});
		
		
		
	</script>

	<script>

		//滚动文字
		$(function(){
			//1文字轮播(2-5页中间)开始
			$(".font_inner li:eq(0)").clone(true).appendTo($(".font_inner"));//克隆第一个放到最后(实现无缝滚动)
			var liHeight = $(".swiper_wrap").height();//一个li的高度
			//获取li的总高度再减去一个li的高度(再减一个Li是因为克隆了多出了一个Li的高度)
			var totalHeight = ($(".font_inner li").length *  $(".font_inner li").eq(0).height()) -liHeight;
			$(".font_inner").height(totalHeight);//给ul赋值高度
			var index = 0;
			var autoTimer = 0;//全局变量目的实现左右点击同步
			var clickEndFlag = true; //设置每张走完才能再点击
			function tab(){
				$(".font_inner").stop().animate({
					top: -index * liHeight
				},400,function(){
					clickEndFlag = true;//图片走完才会true
					if(index == $(".font_inner li").length -1) {
						$(".font_inner").css({top:0});
						index = 0;
					}
				})
			};
			function nextword() {
				index++;
				if(index > $(".font_inner li").length - 1) {
					//判断index为最后一个Li时index为0
					index = 0;
				}
				tab();
			};
			function prevword() {
				index--;
				if(index < 0) {
					index = $(".font_inner li").size() - 2;//因为index的0 == 第一个Li，减二是因为一开始就克隆了一个LI在尾部也就是多出了一个Li，减二也就是_index = Li的长度减二
					$(".font_inner").css("top",- ($(".font_inner li").size() -1) * liHeight);//当_index为-1时执行这条，也就是走到li的最后一个
				}
				tab();
			};
			//自动轮播
			autoTimer = setInterval(nextword,3000);
			$(".font_inner a").hover(function(){
				clearInterval(autoTimer);
			},function() {
				autoTimer = setInterval(nextword,3000);
			});
		})

	</script>