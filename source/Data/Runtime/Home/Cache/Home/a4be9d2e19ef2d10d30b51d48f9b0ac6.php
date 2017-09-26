<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta name="baidu-site-verification" content="7JiPIVdZ6K" />
	<meta charset="UTF-8">
	<meta content="领袖户外" name="author"/>
	<?php if(strpos($_SERVER['HTTP_HOST'], '.kllife.com') !== FALSE): ?><meta name="robots" content="noindex,nofollow"/><?php endif; ?>	
	<!--特殊专题新疆标题关键字-->
	<?php if(C('MENU_CURRENT') == 'subject_xinjiang'): ?><title>新疆旅游的首选_领袖户外旅行网_好玩不贵的小团慢旅行_领袖户外官方网站</title>	
	    <meta content="新疆旅游的首选,领袖户外旅行网,好玩不贵的小团慢旅行,领袖户外官方网站" name="title"/>
	    <meta content="新疆旅游,新疆旅游攻略,新疆旅游费用,新疆旅游价格,新疆旅游景点大全,新疆驴友网,禾木驴友网,新疆驴友攻略,喀纳斯驴友网,新疆定制游" name="keywords"/>
	    <meta content="新疆旅游攻略，小团慢旅行,新疆自助游攻略，包括小团慢旅行,新疆热门景点、户外俱乐部、游记攻略、出行交通、餐饮等旅游信息，以及小团慢旅行,新疆驴友交流、驴友俱乐部信息。小团慢旅行,新疆旅游怎么订制。" name="description"/>
	<!--特殊专题额济纳标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_ejina'): ?>
		<title>额济纳旅游的首选__领袖户外旅行网__好玩不贵的小团慢旅行</title>
		<meta content="额济纳旅游的首选,领袖户外旅行网,好玩不贵的小团慢旅行" name="title"/>
	    <meta content="额济纳旅游,额济纳旅游攻略,额济纳旅游费用,额济纳旅游价格,额济纳胡杨林,额济纳旅游景点大全" name="keywords"/>
	    <meta content="额济纳旗，掉落在童话里的秋日，颠覆传统旅行方式，化腐朽为神奇的国庆精品线路。领袖户外：好玩不贵的小团慢旅行！,精品小团，享受一次恰到好处的慢旅行！在最美的风景中漫步、深呼吸，为不期而遇的惊艳停车，品味夕阳晨曦的美好，尽可能与美景相拥而眠，旅途中从陌生，变成朋友……" name="description"/>		
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
	<!-- css Reset -->
	<link rel="stylesheet" href="/source/Static/home/common/css/cssreset.css">
	<!-- 轮播样式 -->
	<link rel="stylesheet" href="/source/Static/home/common/css/slide.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="/source/Static/home/common/css/common.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="/source/Static/common/css/common.css">
	<!--图标-->
	<link type="image/x-icon" rel="shortcut icon" href="/source/Static/home/common/images/favicon.ico" />
	<!-- 引用jq -->
	<script src="/source/Static/home/common/js/jquery-1.11.3.min.js"></script>
	
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="/source/Static/common/js/functions.js"></script>

	<!--[if lt IE 9]>
		<script>
			(function() {
				if (! 
					/*@cc_on!@*/
				0) return;
				var e = "abbr, article, aside, audio, canvas, datalist, details, dialog, eventsource, figure, footer, header, hgroup, mark, menu, meter, nav, output, progress, section, time, video".split(', ');
				var i= e.length;
				while (i--){
					document.createElement(e[i])
				} 
			})() ;
		</script>
    	<script src="../common/js/html5shiv.min.js"></script>
    <![endif]-->
</head>
<body>
	<div class="mp_video hidden_ctrl">
	</div>
	<header>
		<div class="nav01">
			<div class="nav-top">
				<div class="nav-top-left">
					<!--新增顶部左侧链接开始（17.08.02）-->
					<?php if(is_array($pcset_top_link)): $i = 0; $__LIST__ = array_slice($pcset_top_link,0,8,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$set_val): $mod = ($i % 2 );++$i; if(!empty($fk)): ?>&nbsp;|&nbsp;<?php endif; ?>
						<?php $fk = json_decode($set_val['value'], true); ?>
						<a href="<?php echo ($fk["url"]); ?>" target="_blank"><?php echo ($fk["text"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
					
					<div class="more">
						<div class="div1">| 更多</div>
						<div class="div2">
							<ul>
								<?php if(is_array($pcset_top_link)): $i = 0; $__LIST__ = array_slice($pcset_top_link,8,9,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$set_val): $mod = ($i % 2 );++$i; $fk = json_decode($set_val['value'], true); ?>
									<li><a href="<?php echo ($fk["url"]); ?>" target="_blank"><?php echo ($fk["text"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
					<!--新增顶部左侧链接结束-->
				</div>
				<div class="nav-top-right">
					<img src="/source/Static/home/common/images/login_header.png" alt=""></a>
					<?php if(empty($user) == true): ?><a href="<?php echo U('user/login');?>">登录</a> |
						<a href="<?php echo U('user/register');?>">注册</a>
					<?php else: ?>
						你好<a href="<?php echo U('user/info');?>" style="color: blue;"><?php echo ($user["show_name"]); ?></a>欢迎光临，
						<a href="javascript:;" style="color: blue;" class="user_logout">安全退出</a>！<?php endif; ?>
					<a href="<?php echo U('line/order');?>/type/center" target="_blank"> | 我的订单</a>
					<a href="<?php echo U('Subject/brand');?>" target="_blank"> | 关于我们</a>
					<a href="<?php echo U('service/center');?>" target="_blank"> | 服务中心</a>
					<img src="/source/Static/home/common/images/tel_header.png" alt="联系电话">
					<span>400-080-5860<!--<?php echo ($cs_tel); ?>--></span>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$('.user_logout').click(function(){
				logoutShequ('<?php echo U("user/exit");?>');	
			});
		</script>
		<div class="nav02">
			<div class="nav-list">
				<a class="go-welcome" href="<?php echo U('index/welcome');?>"><img src="/source/Static/home/common/images/logo1.png" alt="领袖户外"></a>
				<!--logo图片加链接会导致样式混乱-->
				<!--<img src="/source/Static/home/common/brand/logo_header.png" alt="领袖户外">-->
				<ul>
					<?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; if (is_array($menu) === false) { continue; } $jumpToLineList = false; switch($menu['item_desc']) { case '首页': $href=U('index/welcome'); break; case '跟拍游': $href=U('line/xiezhenlvxing'); break; case '私人定制': { $href=$pcset['team_link']; $target = '_blank'; }break; case '论坛': { $href = "http://shequ.kllife.com"; $target = '_blank'; }break; default: { $jumpToLineList = true; $href=U('line/list','cache=1'); } break; } ?>
						<li class="nav-list-top">
							<?php $nav = $href; if ($jumpToLineList === true) { $nav = $href.'/m0/'.$menu['id']; } ?>
							<a href="<?php echo ($nav); ?>" target="<?php echo ($target); ?>"><?php echo ($menu["item_desc"]); ?></a>
							<?php if(!empty($menu["child"])): ?><div>
								<?php if(is_array($menu["child"])): $i = 0; $__LIST__ = $menu["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><ul>
									<li>
										<?php $nav = $href; if (!empty($jumpToLineList)) { $nav = $href.'/m0/'.$menu['id'].'/m1/'.$c['id']; } ?>
										<a href="<?php echo ($nav); ?>" target="<?php echo ($target); ?>"><?php echo ($c["item_desc"]); ?></a>
									</li>
									<?php if(!empty($c["child"])): if(is_array($c["child"])): $i = 0; $__LIST__ = $c["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cc): $mod = ($i % 2 );++$i;?><li>
												<?php $nav = $href; if (!empty($jumpToLineList)) { $nav = $href.'/m0/'.$menu['id'].'/m1/'.$c['id'].'/m2/'.$cc['id']; } ?>
												<a href="<?php echo ($nav); ?>"  target="<?php echo ($target); ?>"><?php echo ($cc["item_desc"]); ?></a>
											</li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
								</ul><?php endforeach; endif; else: echo "" ;endif; ?>
							</div><?php endif; ?>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<div class="search-header" style="margin-right: 17px;">
					<img src="/source/Static/home/common/images/search_header.png" alt="">
					<input type="text" value="<?php echo ($searchval); ?>" placeholder="身未动 心已远..."/>
					<a href="javascript:;">搜索</a>
				</div>
				<script type="text/javascript">
					$(document).ready(function(){
						// 定位首页菜单
						positionTopMenu();
					});
					
					// 首页菜单动态定位
					function positionTopMenu(){
						var rootObj = $('.nav02').find('.nav-list');
						var firstMenuLeft = $(rootObj).find('.nav-list-top:first').offset().left;
						var startLeft = $(rootObj).offset().left;
						var leftOffset = parseInt(firstMenuLeft)-parseInt(startLeft);
						
						$(rootObj).find('.nav-list-top').each(function(i,el){
							if ($(this).find('div').length > 0) {						
								var childLength = $(this).find('div').find('ul').length;
								var ulObj = $(this).find('div').find('ul:first');
								var childWidth = parseInt($(ulObj).css('margin-left')) + parseInt($(ulObj).width());
								var totalWidth = parseInt(childWidth) * parseInt(childLength) + 30;
								$(this).find('div').css('width', totalWidth);
								
								var menuOffset = parseInt($(rootObj).width())-parseInt(totalWidth);
								if (menuOffset > leftOffset) {
									menuOffset = leftOffset;
								}
								$(this).find('div').css('left',menuOffset);								
							}
						});
						
					}
					
					function topSearchLine() {
						var search_val = $('.search-header').find('input').val();
						$.post('<?php echo U("line/search");?>', {searchval:search_val}, function(data){
							if (data.jumpUrl != null) {
								location.href = data.jumpUrl;
							}
						});
					}
					// 绑定回车时间
					bindKeyUp($('.search-header').find('input'),topSearchLine);
					$('.search-header').find('a').click(function(){
						topSearchLine();
					});	
					
					//更多
					    $(".more .div1").on("mouseover",function(){
					        $(".more .div2").show()
					    })
					
					    $(".more").on("mouseleave",function(){
					         $(".more .div2").hide()
					    })
				</script>
			</div>
		</div>		
	</header>
	<!-- 私有样式 -->
	<link rel="stylesheet" href="/source/Static/home/css/order_center.css">
	<div id="content">
		<div class="order-center-content">
			<div class="order-center-left">
				<div class="order-center-mine">
					<img src="<?php echo ($user["face"]); ?>" alt="">
					<p><?php echo ($user["name"]); ?></p>
					<a href="<?php echo U('user/info');?>">进入个人中心</a>
				</div>
				<div class="order-question">
					<?php if(is_array($order_center_question)): $i = 0; $__LIST__ = $order_center_question;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$qt): $mod = ($i % 2 );++$i;?><h4><?php echo ($qt["type_desc"]); ?></h4>
						<div class="order-question-content">
							<?php if(is_array($qt["questions"])): $i = 0; $__LIST__ = $qt["questions"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$quest): $mod = ($i % 2 );++$i;?><p>· <a href="<?php echo U('service/question');?>/id/<?php echo ($quest["id"]); ?>"><?php echo ($quest["content"]); ?></a></p><?php endforeach; endif; else: echo "" ;endif; ?>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
			<div class="order-center-right">
				<div class="order-center-list">
					<?php if($state == 'all'): ?><a class="active" href="#all-order">全部订单</a>
					<?php else: ?>
						<a href="#all-order">全部订单</a><?php endif; ?>
					<?php if($state == 'review'): ?><a class="active" href="#obligation-order">待付款订单</a>
					<?php else: ?>
						<a href="#obligation-order">待付款订单</a><?php endif; ?>
					<?php if($state == 'pay_part'): ?><a class="active" href="#part-money-order">已付部分款订单<span><img src="/source/Static/home/images/order_center_img/ready_pay.png" /></span></a>
					<?php else: ?>
						<a href="#part-money-order">已付部分款订单<span><img src="/source/Static/home/images/order_center_img/ready_pay.png" /></span></a><?php endif; ?>
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
										<a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info">
											<?php echo ($order["lineid_title"]); ?><br><?php echo ($order["lineid_subheading"]); ?>
										</a>
									</td>
									<td>￥<?php echo ($order["need_pay_money"]); ?>元</td>
									<td class="order-status">
										<span><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></span>
										<p><a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info">订单详情</a></p>
									</td>
									<td class="contract-status">
										<?php if(empty($order[agreenment])): ?><span>未生效</span>
										<?php else: ?>
											<span>已生效</span>
											<p><a href="http://kllife.com/fpdf/domo/pdf.php?did=<?php echo ($order["id"]); ?>&new_line=<?php echo ($order["new_line"]); ?>" target="_blank">下载</a></p><?php endif; ?>
									</td>
									<td class="order-operate">
										<?php if($order['operate'] == 'pay'): ?><a class="online-pay-small" href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/payment">在线支付</a>
											<p><a class="online-pay-other" href="javascript:;">其他支付方式</a></p>
										<?php elseif($order['operate'] == 'wait_review'): ?>
											<span>等待审核</span>
										<?php elseif($order['operate'] == 'team_end'): ?>
											<span>团期已结束</span>
										<?php else: ?>
											<span>按时参团</span><?php endif; ?>
									</td>
									<td class="other-operate">
										<?php if($order['new_line'] == '1'): ?><p><a href="<?php echo U('line/info');?>/id/<?php echo ($order["lineid"]); ?>/schedule/1">查看行程</a></p><?php endif; ?>
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
										<a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info">
											<?php echo ($order["lineid_title"]); ?><br><?php echo ($order["lineid_subheading"]); ?>
										</a>
									</td>
									<td>￥<?php echo ($order["need_pay_money"]); ?>元</td>
									<td class="order-status">
										<span><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></span>
										<p><a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info">订单详情</a></p>
									</td>
									<td class="contract-status">
										<?php if(empty($order[agreenment])): ?><span>未生效</span>
										<?php else: ?>
											<span>已生效</span>
											<p><a href="http://kllife.com/fpdf/domo/pdf.php?did=<?php echo ($order["id"]); ?>&new_line=<?php echo ($order["new_line"]); ?>" target="_blank">下载</a></p><?php endif; ?>
									</td>
									<td class="order-operate">
										<?php if($order['operate'] == 'pay'): ?><a class="online-pay-small" href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/payment">在线支付</a>
											<p><a class="online-pay-other" href="javascript:;">其他支付方式</a></p>
										<?php elseif($order['operate'] == 'wait_review'): ?>
											<span>等待审核</span>
										<?php elseif($order['operate'] == 'team_end'): ?>
											<span>团期已结束</span>
										<?php else: ?>
											<span>按时参团</span><?php endif; ?>
									</td>
									<td class="other-operate">
										<p><a href="<?php echo U('line/info');?>/id/<?php echo ($order["lineid"]); ?>/schedule/1">查看行程</a></p>
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
										<a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info">
											<?php echo ($order["lineid_title"]); ?><br><?php echo ($order["lineid_subheading"]); ?>
										</a>
									</td>
									<td>￥<?php echo ($order["need_pay_money"]); ?>元</td>
									<td class="order-status">
										<span><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></span>
										<p><a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info">订单详情</a></p>
									</td>
									<td class="contract-status">
										<?php if(empty($order[agreenment])): ?><span>未生效</span>
										<?php else: ?>
											<span>已生效</span>
											<p><a href="http://kllife.com/fpdf/domo/pdf.php?did=<?php echo ($order["id"]); ?>&new_line=<?php echo ($order["new_line"]); ?>" target="_blank">下载</a></p><?php endif; ?>
									</td>
									<td class="order-operate">
										<?php if($order['operate'] == 'pay'): ?><a class="online-pay-small" href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/payment">在线支付</a>
											<p><a class="online-pay-other" href="javascript:;">其他支付方式</a></p>
										<?php elseif($order['operate'] == 'wait_review'): ?>
											<span>等待审核</span>
										<?php elseif($order['operate'] == 'team_end'): ?>
											<span>团期已结束</span>
										<?php else: ?>
											<span>按时参团</span><?php endif; ?>
									</td>
									<td class="other-operate">
										<p><a href="<?php echo U('line/info');?>/id/<?php echo ($order["lineid"]); ?>/schedule/1">查看行程</a></p>
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
										<a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info">
											<?php echo ($order["lineid_title"]); ?><br><?php echo ($order["lineid_subheading"]); ?>
										</a>
									</td>
									<td>￥<?php echo ($order["need_pay_money"]); ?>元</td>
									<td class="order-status">
										<span><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></span>
										<p><a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info">订单详情</a></p>
									</td>
									<td class="contract-status">
										<?php if(empty($order[agreenment])): ?><span>未生效</span>
										<?php else: ?>
											<span>已生效</span>
											<p><a href="http://kllife.com/fpdf/domo/pdf.php?did=<?php echo ($order["id"]); ?>&new_line=<?php echo ($order["new_line"]); ?>" target="_blank">下载</a></p><?php endif; ?>
									</td>
									<td class="order-operate">
										<?php if($order['operate'] == 'pay'): ?><a class="online-pay-small" href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/payment">在线支付</a>
											<p><a class="online-pay-other" href="javascript:;">其他支付方式</a></p>
										<?php elseif($order['operate'] == 'wait_review'): ?>
											<span>等待审核</span>
										<?php elseif($order['operate'] == 'team_end'): ?>
											<span>团期已结束</span>
										<?php else: ?>
											<span>按时参团</span><?php endif; ?>
									</td>
									<td class="other-operate">
										<p><a href="<?php echo U('line/info');?>/id/<?php echo ($order["lineid"]); ?>/schedule/1">查看行程</a></p>
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
										<a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info">
											<?php echo ($order["lineid_title"]); ?><br><?php echo ($order["lineid_subheading"]); ?>
										</a>
									</td>
									<td>￥<?php echo ($order["need_pay_money"]); ?>元</td>
									<td class="order-status">
										<span><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></span>
										<p><a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info">订单详情</a></p>
									</td>
									<td class="contract-status">
										<?php if(empty($order[agreenment])): ?><span>未生效</span>
										<?php else: ?>
											<span>已生效</span>
											<p><a href="http://kllife.com/fpdf/domo/pdf.php?did=<?php echo ($order["id"]); ?>&new_line=<?php echo ($order["new_line"]); ?>" target="_blank">下载</a></p><?php endif; ?>
									</td>
									<td class="order-operate">
										<?php if($order['operate'] == 'pay'): ?><a class="online-pay-small" href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/payment">在线支付</a>
											<p><a class="online-pay-other" href="javascript:;">其他支付方式</a></p>
										<?php elseif($order['operate'] == 'wait_review'): ?>
											<span>等待审核</span>
										<?php elseif($order['operate'] == 'team_end'): ?>
											<span>团期已结束</span>
										<?php else: ?>
											<span>按时参团</span><?php endif; ?>
									</td>
									<td class="other-operate">
										<p><a href="<?php echo U('line/info');?>/id/<?php echo ($order["lineid"]); ?>/schedule/1">查看行程</a></p>
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
										<a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info">
											<?php echo ($order["lineid_title"]); ?><br><?php echo ($order["lineid_subheading"]); ?>
										</a>
									</td>
									<td>￥<?php echo ($order["need_pay_money"]); ?>元</td>
									<td class="order-status">
										<span><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></span>
										<p><a href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/info">订单详情</a></p>
									</td>
									<td class="contract-status">
										<?php if(empty($order[agreenment])): ?><span>未生效</span>
										<?php else: ?>
											<span>已生效</span>
											<p><a href="http://kllife.com/fpdf/domo/pdf.php?did=<?php echo ($order["id"]); ?>&new_line=<?php echo ($order["new_line"]); ?>" target="_blank">下载</a></p><?php endif; ?>
									</td>
									<td class="order-operate">
										<?php if($order['operate'] == 'pay'): ?><a class="online-pay-small" href="<?php echo U('line/order');?>/id/<?php echo ($order["id"]); ?>/type/payment">在线支付</a>
											<p><a class="online-pay-other" href="javascript:;">其他支付方式</a></p>
										<?php elseif($order['operate'] == 'wait_review'): ?>
											<span>等待审核</span>
										<?php elseif($order['operate'] == 'team_end'): ?>
											<span>团期已结束</span>
										<?php else: ?>
											<span>按时参团</span><?php endif; ?>
									</td>
									<td class="other-operate">
										<p><a href="<?php echo U('line/info');?>/id/<?php echo ($order["lineid"]); ?>/schedule/1">查看行程</a></p>
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
<script src="/source/Static/home/js/page.js"></script>
<!--图片延迟加载-->
<script type="text/javascript" src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>
<script type="text/javascript">
    jQuery(document).ready(
        function($){
            $("img").lazyload({
                placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
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
					var hostUrl = 'http://kllife.com/';
					for(var i=0; i < data.ds.length; i++) {
						var d = data.ds[i];
						var vhtml=  '<tr>'+
									'	<td colspan="3">'+d.hdid_show_text+'</td>'+
									'	<td colspan="3">订单号'+d.order_sn+'</td>'+
									'</tr>'+
									'<tr>'+
									'	<td class="order-name">'+
									'		<a href="'+'<?php echo U("line/order");?>'+'/id/'+d.id+'/type/info">'+
									'			'+d.lineid_title+'<br>'+d.lineid_subheading+
									'		</a>'+
									'	</td>'+
									'	<td>￥'+d.need_pay_money+'元</td>'+
									'	<td class="order-status">'+
									'		<span>'+d.zhuangtai_data.type_desc+'</span>'+
									'		<p><a href="'+'<?php echo U("line/order");?>'+'/id/'+d.id+'/type/info">订单详情</a></p>'+
									'	</td>'+
									'	<td class="contract-status">';
									
									if (d.agreenment) {
										vhtml += '<span>已生效</span><p><a href="'+hostUrl+'fpdf/domo/pdf.php?did='+d.id+'&new_line='+d.new_line+'" target="_blank">下载</a></p>';
									} else {
										vhtml += '<span>未生效</span>';
									}
									vhtml += '	</td><td class="order-operate">';
									if (d.operate == 'pay') {
										vhtml += '<a class="online-pay-small" href="'+'<?php echo U("line/order");?>'+'/id/'+d.id+'/type/payment">在线支付</a>';
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
									'		<p><a href="'+'<?php echo U("line/info");?>'+'/id/'+d.lineid+'/schedule/1">查看行程</a></p>'+
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

	<!-- 右侧侧边栏 -->
	<aside>
		<div class="join-us" style="margin-top:50px;">
			<a href="<?php echo U('subject/brand');?>"></a>
		</div>
		<a class="aside_hot" href="<?php echo U('service/center');?>" target="_blank">
			<i></i>
			<div class="aside_show aside_show_hot">
				<p>帮助中心</p>
			</div>
		</a>
		<a class="aside_mine" href="<?php echo U('user/info');?>" target="_blank">
			<i></i>
			<div class="aside_show aside_show_mine">
				<p>个人中心</p>
			</div>
		</a>
		<a class="aside_order" href="<?php echo U('line/order');?>/type/center" target="_blank">
			<i></i>
			<div class="aside_show aside_show_order">
				<p>订单中心</p>
			</div>
		</a>
		<a class="aside_weixin" href="javascript:;">
			<i></i>
			<div class="aside_show aside_show_weixin">
				<img src="/source/Static/home/common/images/aside_erweima.png" alt="二维码">
			</div>
		</a>
		<a class="aside_tel" href="javascript:;">
			<i></i>
			<div class="aside_show aside_show_tel">
				<p>400-080-5860</p>
			</div>
		</a>
		<a class="aside_qq" onclick="openZoosUrl('chatwin');">
			<i></i>
			<div class="aside_show aside_show_qq">
				<p>在线咨询</p>
			</div>
		</a>
		<a class="aside_top" href="#">
			<i></i>
		</a>
	</aside>

	<footer>
		<div class="footer-content">
			<div class="footer-content-left">
				<?php if(is_array($question_type)): $i = 0; $__LIST__ = $question_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$qt): $mod = ($i % 2 );++$i; if ($key === 'config_update_time') { continue; } ?>
					<ul class="<?php echo ($qt["class"]); ?>">
						<li><?php echo ($qt["type_desc"]); ?></li>
						<?php if(is_array($qt["questions"])): $i = 0; $__LIST__ = $qt["questions"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$quest): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('service/question');?>/id/<?php echo ($quest["id"]); ?>"><?php echo ($quest["content"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<div class="footer-content-right">
				<img src="/source/Static/home/common/images/footer_erweima.png" alt="">
			</div>
		</div>
	</footer>
	<div class="footer-bottom">
		<div class="footer-bottom-content">
			<p>
				友情链接：
				<?php if(is_array($pcset)): $i = 0; $__LIST__ = $pcset;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$set_val): $mod = ($i % 2 );++$i; if(stripos($key, 'pc_friend_link') === 0): if(!empty($fk)): ?>&nbsp;|&nbsp;<?php endif; ?>
						<?php $fk = json_decode($set_val, true); ?>
						<a href="<?php echo ($fk["url"]); ?>" target="_blank" this.onclick();><?php echo ($fk["text"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</p>
			<p class="zhutilvyou">
				主题旅游：
					<?php if(is_array($pcset_top_link)): $i = 0; $__LIST__ = $pcset_top_link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$set_val): $mod = ($i % 2 );++$i; if(!empty($bot_fk)): ?>&nbsp;|&nbsp;<?php endif; ?>
						<?php $bot_fk = json_decode($set_val['value'], true); ?>
						<a href="<?php echo ($bot_fk["url"]); ?>" target="_blank"><?php echo ($bot_fk["text"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
			</p>
			<span style="margin-top: 20px;">Copyright © 2006-2014 kllife.com | 陕西浪客国际旅行社有限责任公司版权所有</span><em>公司地址：陕西省西安市雁塔区太白南路上上国际</em>
			<br>
			<span>领袖户外经营许可证号：L-SNX00306 陕ICP备14011728号-1</span>
            <?php echo ($pcset["statistic_script"]); ?>
		</div>
	</div>
	
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="/source/Static/common/js/functions.js"></script>
	<!-- 日期 -->
	<script src="/source/Static/home/common/js/jQuery-jcDate.js"></script>
	<!-- 轮播 -->
	<script src="/source/Static/home/js/unslider.min.js"></script>
	<!-- 自绑定 -->
	<script src="/source/Static/home/common/js/showAndHide.js"></script>
	<!-- 头部js -->
	<script src="/source/Static/home/common/js/headroom.js"></script>
	<!-- 侧边栏&头部 -->
	<script src="/source/Static/home/common/js/aside-header.js"></script>
	<script type="text/javascript">

	</script>
</body>
</html>