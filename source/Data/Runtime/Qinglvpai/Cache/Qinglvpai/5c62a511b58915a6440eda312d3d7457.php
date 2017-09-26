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
	
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/style.css">
	<!-- css Reset -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/cssreset.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/common.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/common/css/common.css">
    <link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/iconfont.css">
    <!--图标-->
    <link type="image/x-icon" rel="shortcut icon" href="http://kllife.com/source/Static/qinglvpai/common/images/favicon.ico" />
    <style>
        .top-ask{position: fixed;right:50px;bottom:100px;display: none;z-index:1000;}
        .top-ask div{margin:2px 0px;cursor: pointer;}
        .top-ask div img{width:50px;height:50px;}
    </style>
	<!-- 引用jq -->
	<script src="http://kllife.com/source/Static/home/common/js/jquery-1.11.3.min.js"></script>
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
            <a href="javascript:;"><img class="logo-white" src="http://kllife.com/source/Static/qinglvpai/images/index/logo-qinglvpai.png" alt=""></a>
            <ul>
                <a class="active" href="<?php echo U('index/welcome');?>" target="_blank">首页</a>
                <a href="<?php echo U('index/story');?>" target="_blank">品牌故事</a>
                <a href="<?php echo U('line/list');?>" target="_blank">跟拍游</a>
                <a href="<?php echo U('line/slowly');?>" target="_blank">小团慢旅行</a>
                <a href="<?php echo U('Leader/list');?>" target="_blank">摄影师</a>
                <!--<a href="javascript:;">客户回顾</a>-->
            </ul>
            <div class="tel">
                <img style="height:auto;" src="http://kllife.com/source/Static/qinglvpai/images/index/tel-img.png" alt="">
                <img style="height:auto;" src="http://kllife.com/source/Static/qinglvpai/images/index/tel-number.png" alt="">
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
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/css/order_center.css">
	<style type="text/css">
		.order-center-right {
			margin: auto;
			float: none;
		}
		#content{margin-top:50px;}
		.order-center-content{width:1000px;}
		.order-center-list a{width:159px;}
		.all-order{width:920px;}
		.order-center-right{margin-bottom:30px;height:auto;}
		.order-center-list a.active,.order-status span,.order-center-list a:hover,.all-order-page a, .obligation-order-page a, .part-money-order-page a, .all-money-order-page a, .evaluate-order-page a, .done-order-page a{color:#ff1c77;}
		.all-order-page span.current, .obligation-order-page span.current, .part-money-order-page span.current, .all-money-order-page span.current, .evaluate-order-page span.current, .done-order-page span.current{background: #ff1c77;border-color:#ff1c77;}
	</style>
	<div id="content">
		<div class="order-center-content">
			<div class="order-center-right">
				<div class="order-center-list">
					<?php if($state == 'all'): ?><a class="active" href="#all-order">全部订单</a>
					<?php else: ?>
						<a href="#all-order">全部订单</a><?php endif; ?>
					<?php if($state == 'review'): ?><a class="active" href="#obligation-order">待付款订单</a>
					<?php else: ?>
						<a href="#obligation-order">待付款订单</a><?php endif; ?>
					<?php if($state == 'pay_part'): ?><a class="active" href="#part-money-order">已付部分款订单<span><img src="http://kllife.com/source/Static/qinglvpai/images/article/ready_pay.png" /></span></a>
					<?php else: ?>
						<a href="#part-money-order">已付部分款订单<span><img src="http://kllife.com/source/Static/qinglvpai/images/article/ready_pay.png" /></span></a><?php endif; ?>
					<?php if($state == 'pay_complate'): ?><a class="active" href="#all-money-order">已付全款订单</a>
					<?php else: ?>
						<a href="#all-money-order">已付全款订单</a><?php endif; ?>
					<?php if($state == 'pay_comment'): ?><a class="active" href="#evaluate-order">待评价订单</a>
					<?php else: ?>
						<a href="#evaluate-order">待评价订单</a><?php endif; ?>
					<?php if($state == 'complated'): ?><a class="active" href="#done-order">已完成订单</a>
					<?php else: ?>
						<a href="#done-order">已完成订单</a><?php endif; ?>
				</div>
				<div id="all-order" class="all-order">
					<table>
						<thead>
							<tr>
								<th>产品名称</th>
								<th>金额</th>
								<th>订单状态</th>
								<th>合同状态</th>
								<th>操作</th>
								<th>其他操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($all_orders)): $i = 0; $__LIST__ = $all_orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><tr>
									<td colspan="3"><?php echo ($order["hdid_show_text"]); ?></td>
									<td colspan="3">订单号：<?php echo ($order["order_sn"]); ?></td>
								</tr>
								<tr>
									<td class="order-name">
										<a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info" target="_blank">
											<?php echo ($order["lineid_title"]); ?><br><?php echo ($order["lineid_subheading"]); ?>
										</a>
									</td>
									<td>￥<?php echo ($order["need_pay_money"]); ?>元</td>
									<td class="order-status">
										<span><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></span>
										<p><a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info" target="_blank">订单详情</a></p>
									</td>
									<td class="contract-status">
										<?php if(empty($order[agreenment])): ?><span>未生效</span>
										<?php else: ?>
											<span>已生效</span>
											<p><a href="http://kllife.comfpdf/domo/pdf.php?did=<?php echo ($order["id"]); ?>&new_line=<?php echo ($order["new_line"]); ?>" target="_blank">下载</a></p><?php endif; ?>
									</td>
									<td class="order-operate">
										<?php if($order['operate'] == 'pay'): ?><a class="online-pay-small" href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/payment" target="_blank">在线支付</a>
											<p><a class="online-pay-other" href="javascript:;">其他支付方式</a></p>
										<?php elseif($order['operate'] == 'wait_review'): ?>
											<span>等待审核</span>
										<?php elseif($order['operate'] == 'team_end'): ?>											
											<span>团期已结束</span>
										<?php else: ?>
											<span>按时参团</span><?php endif; ?>
									</td>
									<td class="other-operate">
										<?php if($order['new_line'] == '1'): ?><p><a href="<?php echo U('line/info');?>/id/<?php echo ($order["lineid"]); ?>/schedule/1" target="_blank">查看行程</a></p><?php endif; ?>
										<p><a href="javascript:;">退出活动</a></p>
									</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
					<!-- 翻页 -->
					<div class="all-order-page" data-page-count="<?php echo ($page_count); ?>" data-page-index="1"></div>
				</div>
				<!-- end 全部订单-->
				<!-- 待付款订单 -->
				<div id="obligation-order" class="obligation-order">
					<table>
						<thead>
							<tr>
								<th>产品名称</th>
								<th>金额</th>
								<th>订单状态</th>
								<th>合同状态</th>
								<th>操作</th>
								<th>其他操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($review_orders)): $i = 0; $__LIST__ = $review_orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><tr>
									<td colspan="3"><?php echo ($order["hdid_show_text"]); ?></td>
									<td colspan="3">订单号：<?php echo ($order["order_sn"]); ?></td>
								</tr>
								<tr>
									<td class="order-name">
										<a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info" target="_blank">
											<?php echo ($order["lineid_title"]); ?><br><?php echo ($order["lineid_subheading"]); ?>
										</a>
									</td>
									<td>￥<?php echo ($order["need_pay_money"]); ?>元</td>
									<td class="order-status">
										<span><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></span>
										<p><a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info" target="_blank">订单详情</a></p>
									</td>
									<td class="contract-status">
										<?php if(empty($order[agreenment])): ?><span>未生效</span>
										<?php else: ?>
											<span>已生效</span>
											<p><a href="http://kllife.comfpdf/domo/pdf.php?did=<?php echo ($order["id"]); ?>&new_line=<?php echo ($order["new_line"]); ?>" target="_blank">下载</a></p><?php endif; ?>
									</td>
									<td class="order-operate">
										<?php if($order['operate'] == 'pay'): ?><a class="online-pay-small" href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/payment" target="_blank">在线支付</a>
											<p><a class="online-pay-other" href="javascript:;">其他支付方式</a></p>
										<?php elseif($order['operate'] == 'wait_review'): ?>
											<span>等待审核</span>
										<?php elseif($order['operate'] == 'team_end'): ?>											
											<span>团期已结束</span>
										<?php else: ?>
											<span>按时参团</span><?php endif; ?>
									</td>
									<td class="other-operate">
										<p><a href="<?php echo U('line/info');?>/id/<?php echo ($order["lineid"]); ?>/schedule/1" target="_blank">查看行程</a></p>
										<p><a href="javascript:;">退出活动</a></p>
									</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
					<!-- 翻页 -->
					<div class="obligation-order-page" data-page-count="<?php echo ($page_count); ?>" data-page-index="1"></div>
				</div>
				<!-- end 待付款订单 -->
				<!-- 已付部分款订单 -->
				<div id="part-money-order" class="part-money-order">
					<table>
						<thead>
							<tr>
								<th>产品名称</th>
								<th>金额</th>
								<th>订单状态</th>
								<th>合同状态</th>
								<th>操作</th>
								<th>其他操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($pay_part_orders)): $i = 0; $__LIST__ = $pay_part_orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><tr>
									<td colspan="3"><?php echo ($order["hdid_show_text"]); ?></td>
									<td colspan="3">订单号：<?php echo ($order["order_sn"]); ?></td>
								</tr>
								<tr>
									<td class="order-name">
										<a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info" target="_blank">
											<?php echo ($order["lineid_title"]); ?><br><?php echo ($order["lineid_subheading"]); ?>
										</a>
									</td>
									<td>￥<?php echo ($order["need_pay_money"]); ?>元</td>
									<td class="order-status">
										<span><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></span>
										<p><a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info" target="_blank">订单详情</a></p>
									</td>
									<td class="contract-status">
										<?php if(empty($order[agreenment])): ?><span>未生效</span>
										<?php else: ?>
											<span>已生效</span>
											<p><a href="http://kllife.comfpdf/domo/pdf.php?did=<?php echo ($order["id"]); ?>&new_line=<?php echo ($order["new_line"]); ?>" target="_blank">下载</a></p><?php endif; ?>
									</td>
									<td class="order-operate">
										<?php if($order['operate'] == 'pay'): ?><a class="online-pay-small" href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/payment" target="_blank">在线支付</a>
											<p><a class="online-pay-other" href="javascript:;">其他支付方式</a></p>
										<?php elseif($order['operate'] == 'wait_review'): ?>
											<span>等待审核</span>
										<?php elseif($order['operate'] == 'team_end'): ?>											
											<span>团期已结束</span>
										<?php else: ?>
											<span>按时参团</span><?php endif; ?>
									</td>
									<td class="other-operate">
										<p><a href="<?php echo U('line/info');?>/id/<?php echo ($order["lineid"]); ?>/schedule/1" target="_blank">查看行程</a></p>
										<p><a href="javascript:;">退出活动</a></p>
									</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
					<!-- 翻页 -->
					<div class="part-money-order-page" data-page-count="<?php echo ($page_count); ?>" data-page-index="1"></div>
				</div>
				<!-- end 已付部分款订单 -->
				
				
				<!-- 已付全款订单 -->
				<div id="all-money-order" class="all-money-order">
					<table>
						<thead>
							<tr>
								<th>产品名称</th>
								<th>金额</th>
								<th>订单状态</th>
								<th>合同状态</th>
								<th>操作</th>
								<th>其他操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($pay_complate_orders)): $i = 0; $__LIST__ = $pay_complate_orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><tr>
									<td colspan="3"><?php echo ($order["hdid_show_text"]); ?></td>
									<td colspan="3">订单号：<?php echo ($order["order_sn"]); ?></td>
								</tr>
								<tr>
									<td class="order-name">
										<a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info" target="_blank">
											<?php echo ($order["lineid_title"]); ?><br><?php echo ($order["lineid_subheading"]); ?>
										</a>
									</td>
									<td>￥<?php echo ($order["need_pay_money"]); ?>元</td>
									<td class="order-status">
										<span><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></span>
										<p><a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info" target="_blank">订单详情</a></p>
									</td>
									<td class="contract-status">
										<?php if(empty($order[agreenment])): ?><span>未生效</span>
										<?php else: ?>
											<span>已生效</span>
											<p><a href="http://kllife.comfpdf/domo/pdf.php?did=<?php echo ($order["id"]); ?>&new_line=<?php echo ($order["new_line"]); ?>" target="_blank">下载</a></p><?php endif; ?>
									</td>
									<td class="order-operate">
										<?php if($order['operate'] == 'pay'): ?><a class="online-pay-small" href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/payment" target="_blank">在线支付</a>
											<p><a class="online-pay-other" href="javascript:;">其他支付方式</a></p>
										<?php elseif($order['operate'] == 'wait_review'): ?>
											<span>等待审核</span>
										<?php elseif($order['operate'] == 'team_end'): ?>											
											<span>团期已结束</span>
										<?php else: ?>
											<span>按时参团</span><?php endif; ?>
									</td>
									<td class="other-operate">
										<p><a href="<?php echo U('line/info');?>/id/<?php echo ($order["lineid"]); ?>/schedule/1" target="_blank">查看行程</a></p>
										<p><a href="javascript:;">退出活动</a></p>
									</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
					<!-- 翻页 -->
					<div class="all-money-order-page" data-page-count="<?php echo ($page_count); ?>" data-page-index="1"></div>
				</div>
				<!-- end 已付全款订单 -->
				
				
				
				<!-- 待评价订单 -->
				<div id="evaluate-order" class="evaluate-order">
					<table>
						<thead>
							<tr>
								<th>产品名称</th>
								<th>金额</th>
								<th>订单状态</th>
								<th>合同状态</th>
								<th>操作</th>
								<th>其他操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($comment_orders)): $i = 0; $__LIST__ = $comment_orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><tr>
									<td colspan="3"><?php echo ($order["hdid_show_text"]); ?></td>
									<td colspan="3">订单号：<?php echo ($order["order_sn"]); ?></td>
								</tr>
								<tr>
									<td class="order-name">
										<a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info" target="_blank">
											<?php echo ($order["lineid_title"]); ?><br><?php echo ($order["lineid_subheading"]); ?>
										</a>
									</td>
									<td>￥<?php echo ($order["need_pay_money"]); ?>元</td>
									<td class="order-status">
										<span><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></span>
										<p><a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info" target="_blank">订单详情</a></p>
									</td>
									<td class="contract-status">
										<?php if(empty($order[agreenment])): ?><span>未生效</span>
										<?php else: ?>
											<span>已生效</span>
											<p><a href="http://kllife.comfpdf/domo/pdf.php?did=<?php echo ($order["id"]); ?>&new_line=<?php echo ($order["new_line"]); ?>" target="_blank">下载</a></p><?php endif; ?>
									</td>
									<td class="order-operate">
										<?php if($order['operate'] == 'pay'): ?><a class="online-pay-small" href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/payment" target="_blank">在线支付</a>
											<p><a class="online-pay-other" href="javascript:;">其他支付方式</a></p>
										<?php elseif($order['operate'] == 'wait_review'): ?>
											<span>等待审核</span>
										<?php elseif($order['operate'] == 'team_end'): ?>											
											<span>团期已结束</span>
										<?php else: ?>
											<span>按时参团</span><?php endif; ?>
									</td>
									<td class="other-operate">
										<p><a href="<?php echo U('line/info');?>/id/<?php echo ($order["lineid"]); ?>/schedule/1" target="_blank">查看行程</a></p>
										<p><a href="javascript:;">退出活动</a></p>
									</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
					<!-- 翻页 -->
					<div class="evaluate-order-page" data-page-count="<?php echo ($page_count); ?>" data-page-index="1"></div>
				</div>
				<!-- end 待评价订单-->
				<!-- 已完成订单 -->
				<div id="done-order" class="done-order">
					<table>
						<thead>
							<tr>
								<th>产品名称</th>
								<th>金额</th>
								<th>订单状态</th>
								<th>合同状态</th>
								<th>操作</th>
								<th>其他操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($complated_orders)): $i = 0; $__LIST__ = $complated_orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><tr>
									<td colspan="3"><?php echo ($order["hdid_show_text"]); ?></td>
									<td colspan="3">订单号：<?php echo ($order["order_sn"]); ?></td>
								</tr>
								<tr>
									<td class="order-name">
										<a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info" target="_blank">
											<?php echo ($order["lineid_title"]); ?><br><?php echo ($order["lineid_subheading"]); ?>
										</a>
									</td>
									<td>￥<?php echo ($order["need_pay_money"]); ?>元</td>
									<td class="order-status">
										<span><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></span>
										<p><a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info" target="_blank">订单详情</a></p>
									</td>
									<td class="contract-status">
										<?php if(empty($order[agreenment])): ?><span>未生效</span>
										<?php else: ?>
											<span>已生效</span>
											<p><a href="http://kllife.comfpdf/domo/pdf.php?did=<?php echo ($order["id"]); ?>&new_line=<?php echo ($order["new_line"]); ?>" target="_blank">下载</a></p><?php endif; ?>
									</td>
									<td class="order-operate">
										<?php if($order['operate'] == 'pay'): ?><a class="online-pay-small" href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/payment" target="_blank">在线支付</a>
											<p><a class="online-pay-other" href="javascript:;">其他支付方式</a></p>
										<?php elseif($order['operate'] == 'wait_review'): ?>
											<span>等待审核</span>
										<?php elseif($order['operate'] == 'team_end'): ?>											
											<span>团期已结束</span>
										<?php else: ?>
											<span>按时参团</span><?php endif; ?>
									</td>
									<td class="other-operate">
										<p><a href="<?php echo U('line/info');?>/id/<?php echo ($order["lineid"]); ?>/schedule/1" target="_blank">查看行程</a></p>
										<p><a href="javascript:;">退出活动</a></p>
									</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
					<!-- 翻页 -->
					<div class="done-order-page" data-page-count="<?php echo ($page_count); ?>" data-page-index="1"></div>
				</div>			
			</div>
		</div>
	</div>
	
<!-- 分页 -->
<script src="http://kllife.com/source/Static/home/js/page.js"></script>
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
<script>
	//订单分类
	$('.order-center-list a').click( function (event) {
		var $anchor = $(this);
		$anchor.siblings().removeClass('active');
		$anchor.addClass('active');
		for ( var i = 0 ; i < $('.order-center-list a').length; i ++ ){
			$($('.order-center-list a:eq(' + i + ')').attr('href')).hide();
		}		
		
		var tab = $anchor.attr('href');
		var p = $(tab).find('table').next().attr('data-page-index');
		_ajaxOrderList(p);
		$(tab).show();		
		//阻止默认行为
		event.preventDefault();
	} );
	
	//表格样式（for IE8）
	function tableCss( obj ) {
			//偶数tr
		$( obj + ' tr:even').css({'backgroundColor': '#fff', 'height': '60px', 'color': '#666'});
			//奇数tr
		$( obj + ' tr:odd').css({'backgroundColor': '#f9f8f8', 'height': '34px'});
			//偶数第1个td
		$( obj + ' tr:even td:first-child').css({'width': '252px', 'padding': '0px 15px', 'wordBreak': 'break-all'});
			//奇数第1个td
		$( obj + ' tr:odd td:first-child').css({'textAlign': 'left', 'paddingLeft': '20px'});
			//奇数最后一个td
		$( obj + 'tr:odd td:last-child').css({'textAlign': 'right', 'paddingRight': '20px'});
			//偶数第2个td
		$( obj + 'tr:even td:nth-child(2)').css('width', '150px');
			//偶数第3个td
		$( obj + 'tr:even td:nth-child(3)').css('width', '130px');
			//偶数第4个td
		$( obj + 'tr:even td:nth-child(4)').css('width', '90px');
			//偶数第5个td
		$( obj + 'tr:even td:nth-child(5)').css('width', '120px');
			//偶数第6个td
		$( obj + 'tr:even td:nth-child(6)').css('width', '150px');
	};
	
	tableCss('.all-order');
	tableCss('.obligation-order');
	tableCss('.part-money-order');
	tableCss('.all-money-order');
	tableCss('.evaluate-order');
	tableCss('.done-order');
	
	function _ajaxOrderList(p) {
		var aObj = $('.order-center-list').find('a.active');
		var stateMap = {
			"#all-order": 'all',
			"#obligation-order": 'review',
			"#part-money-order": 'pay_part',
			"#all-money-order": 'pay_complate',
			"#evaluate-order": 'complated',
			"#done-order": 'complated',
		}
		var h = $(aObj).attr('href');
		var jsonData = {
			op_type: 'list',
			page: p-1,
			state: stateMap[h],
		}
		$.post('<?php echo U("line/order");?>', jsonData, function(data){
			$(h).find('tbody').empty();
			var newPageCount = 1;
			if (data.result.errno == 0) {
				if (data.ds != null) {
					var hostUrl = 'http://kllife.com';
					for(var i=0; i < data.ds.length; i++) {
						var d = data.ds[i];
						var vhtml=  '<tr>'+
									'	<td colspan="3">'+d.hdid_show_text+'</td>'+
									'	<td colspan="3">订单号'+d.order_sn+'</td>'+
									'</tr>'+
									'<tr>'+
									'	<td class="order-name">'+
									'		<a href="'+'<?php echo U("line/order");?>'+'/id/'+d.id+'/type/info" target="_blank">'+
									'			'+d.lineid_title+'<br>'+d.lineid_subheading+
									'		</a>'+
									'	</td>'+
									'	<td>￥'+d.need_pay_money+'元</td>'+
									'	<td class="order-status">'+
									'		<span>'+d.zhuangtai_data.type_desc+'</span>'+
									'		<p><a href="'+'<?php echo U("line/order");?>'+'/id/'+d.id+'/type/info" target="_blank">订单详情</a></p>'+
									'	</td>'+
									'	<td class="contract-status">';
									
									if (d.agreenment) {
										vhtml += '<span>已生效</span><p><a href="'+hostUrl+'fpdf/domo/pdf.php?did='+d.id+'&new_line='+d.new_line+'" target="_blank">下载</a></p>';
									} else {
										vhtml += '<span>未生效</span>';
									}
									vhtml += '	</td><td class="order-operate">';
									if (d.operate == 'pay') {
										vhtml += '<a class="online-pay-small" href="'+'<?php echo U("line/order");?>'+'/id/'+d.id+'/type/payment" target="_blank">在线支付</a>';
										vhtml += '<p><a class="online-pay-other" href="javascript:;">其他支付方式</a></p>';
									} else if (d.operate == 'wait_review') {
										vhtml += '<span>等待审核</span>';
									} else if (d.operate == 'team_end') {
										vhtml += '<span>团期已结束</span>';
									} else {
										vhtml += '<span>按时参团</span>';	
									}
									vhtml += '	</td>'+
									'	<td class="other-operate">'+
									'		<p><a href="'+'<?php echo U("line/info");?>'+'/id/'+d.lineid+'/schedule/1" target="_blank">查看行程</a></p>'+
									'		<p><a href="javascript:;">退出活动</a></p>'+
									'	</td>'+
									'</tr>';
						$(h).find('tbody').append(vhtml);
						newPageCount = data.page_count;
					}
				}
			} else {
				var vhtml = '<tr><td>'+data.result.message+'</td></tr>';
				$(h).find('tbody').html(vhtml);
			}
			
			// 分页
			var pageObj = $(h).find('table').next();
			var force = $(pageObj).html() == '' ? true : false;
			constructionPage(pageObj, p, data.page_count, _ajaxOrderList, force);
						
			tableCss('.all-order');
			tableCss('.obligation-order');
			tableCss('.part-money-order');
			tableCss('.all-money-order');
			tableCss('.evaluate-order');
			tableCss('.done-order');
		});		
	}
	
	$(document).ready(function(){	
		// 创建当前激活面本的分页	
		var tabObj = $('.order-center-list').find('a.active').attr('href');
		if ($(tabObj).length > 0) {
			for ( var i = 0 ; i < $('.order-center-list a').length; i ++ ){
				$($('.order-center-list a:eq(' + i + ')').attr('href')).hide();
			}		
			$(tabObj).show();
			
			if ($(tabObj).find('tbody').html() == '') {
				var vhtml = '<tr><td>'+'没有更多的数据'+'</td></tr>';
				$(tabObj).find('table').find('tbody').html(vhtml);	
			}
			var pageObj = $(tabObj).find('table').next();
			var forceCreatePage = $(pageObj).html() == '' ? true : false;
			constructionPage(pageObj, 1, '<?php echo ($page_count); ?>', _ajaxOrderList, forceCreatePage);
		}		
	});
	
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