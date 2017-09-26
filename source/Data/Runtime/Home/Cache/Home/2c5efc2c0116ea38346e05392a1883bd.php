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
	<link rel="stylesheet" href="/source/Static/home/css/pay_immediately.css">
	<style>
		.pay-mark { display: none; position: fixed; top:0; left:0; width: 100%; height: 100%; background:rgba(0,0,0,.5); z-index:999; }
		.pay-code-content { display: none; position: fixed; top: 50%; left: 37.5%; margin-top: -150px; width:25%; height: 330px; padding: 10px 15px; background: #fff; z-index:1000; }
		.pay-code-content h4 { position: relative; margin-bottom: 17px; font-size: 20px; line-height:2; text-align: center;text-align: -webkit-center;}
		.pay-code-content a { 
			width: 16px;
		    height: 16px;
		    position: absolute;
		    right: 0;
		    top: -2px;
		    color: #999;
		    text-decoration: none;
		    font-size: 16px;
		 }
		.pay-code { text-align:center; }
		.pay-code img { width:185px; height: 185px; }
		.pay-code-content .btn_pay {
			display: block;
			width: 60%;
			height: 2.7rem;
			line-height: 2.7rem;
			margin-top: 17.5rem;
			color: #fff;
			background-color: #ff7200;
			border-radius: 5px;
			text-align: center;
			right:20%;
			cursor:pointer;
		}
	</style>
	<!-- 主要内容 -->
	<div id="content">
		<!-- 总金额 -->
		<div class="all-money">
			<h5>订单提交成功，请您尽快付款！ 订单号：<?php echo ($order["order_sn"]); ?></h5>
			<!--<p>请您在提交订单后 <i>24小时</i> 内完成支付，否则订单会自动取消。</p>-->
			<span>总金额：<strong>￥<?php echo ($order["need_pay_money"]); ?></strong>元</span>
		</div>
		<!-- 选择支付形式 -->
		<div class="payment-form">
			<div class="choose-payment-form">
				<div class="all-or-part">
					<h3>请选择你的支付形式</h3>
					<div class="choose-all-or-part">
						<a class="pay-checked all" href="javascript:;">支付全款</a>
						<?php if($order['exist_pay_log'] == 0): ?><a class="part" href="javascript:;">支付部分款</a>
							<span>* （为了方便您的出行领袖户外为您提供了两种付款方式：1支付全款，一次性支付所有费用：2支付预付款,支付订单金额都50%作为预付款，剩   余尾款在参团前一并付清。请您根据实际情况选择一项适合您定方式进行付）</span><?php endif; ?>
					</div>
					<p>你本次付款需支付：<strong>￥</strong><strong class="final_pay_money"><?php echo ($order["final_pay_money"]); ?></strong>元</p>
				</div>
				<div class="card-pay" style="display: none;">
					<h3><i class="card-pay-checked"></i>储蓄卡/信用卡支付</h3>
					<a id="chuxuka" class="card-checked" href="javascript:;">网上银行</a>
					<a id="xinyongka" href="javascript:;">信用卡</a>
					<div class="choose-card">
						<!-- 网上银行 -->
						<div class="choose-bank-card">
							<ul>
								<li id="bank-gongshang" data-bank="ICBC"><i></i></li>
								<li id="bank-jianshe" data-bank="CCB"><i></i></li>
								<li id="bank-zhaoshang" data-bank="CMB"><i></i></li>
								<li id="bank-xingye" data-bank="CIB"><i></i></li>
								<li id="bank-zhongguo" data-bank="BOC"><i></i></li>
								<li id="bank-jiaotong" data-bank="COMM"><i></i></li>
								<li id="bank-minsheng" data-bank="CMBC"><i></i></li>
								<li id="bank-youzheng" data-bank="PSBC"><i></i></li>
								<li id="bank-nongye" data-bank="ABC"><i></i></li>
								<li id="bank-zhongxin" data-bank="CITIC"><i></i></li>
								<li id="bank-guangda" data-bank="CEB"><i></i></li>
								<li id="bank-guangfa" data-bank="GDB"><i></i></li>
								<li id="bank-beijing" data-bank="BCCB"><i></i></li>
								<li id="bank-huaxia" data-bank="HXB"><i></i></li>
								<li id="bank-pingan" data-bank="SZPAB"><i></i></li>
								<li id="bank-pufa" data-bank="SPDB"><i></i></li>
								<li id="bank-bohai" data-bank="CBHB"><i></i></li>
								<!--<li id="bank-fazhan" data-bank="bank-fazhan"><i></i></li>-->
							</ul>
						</div>
						<!-- 信用卡 -->
						<div class="choose-credit-card">
							<ul>
								<li id="credit-gongshang" data-bank="ICBC"><i></i></li>
								<li id="credit-jianshe" data-bank="CCB"><i></i></li>
								<li id="credit-zhaoshang" data-bank="CMB"><i></i></li>
								<li id="credit-xingye" data-bank="CIB"><i></i></li>
								<li id="credit-zhongguo" data-bank="BOC"><i></i></li>
								<li id="credit-jiaotong" data-bank="COMM"><i></i></li>
								<li id="credit-minsheng" data-bank="CMBC"><i></i></li>
								<li id="credit-guangda" data-bank="PSBC"><i></i></li> <!--邮政-->
								<li id="credit-guangfa" data-bank="BCCB"><i></i></li> <!--北京-->
								<li id="credit-pingan" data-bank="SZPAB"><i></i></li>
								<li id="credit-pufa" data-bank="SPDB"><i></i></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="platform-pay">
					<h3><i class="platform-pay-checked"></i>平台支付</h3>
					<ul style="display: block;">
						<li id="zhifubao" class="platform-checked"><i></i></li>
						<li id="weixin"><i></i></li>
					</ul>
				</div>
				<?php if($order['id'] == '27364'): ?><div class="xiyin-pay">
						<h3><i></i>西银在线</h3>
					</div><?php endif; ?>
				<a class="btn_pay" href="javascript:;">立即支付</a>
				<div id="popup_pay"></div>
			</div>
		</div>           
	</div>
	
	
	<!--弹出二维码-->
	<div class="pay-mark"></div>
	<div class="pay-code-content">
		<h4>微信扫描二维码完成付款<a href="javascript:;">x</a></h4>
		<div class="pay-code">
			<img src="" alt="二维码"/><br>
			<a id="btn_pay_complated" class="btn_pay" type="button" >付款完成，点击查看结果</a>
		</div>
	</div>


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

		function showPayQrcode(img, order_sn) {
			$('.pay-mark').show();
			$('.pay-code-content').show();
			$('.pay-code-content').find('img').attr('src', img);
			$('.pay-code-content').find('#btn_pay_complated').attr('data-val', order_sn);
		}
		$('.pay-code-content a').click(function(){
			$('.pay-mark').hide();
			$('.pay-code-content').hide();
		});
		
		$('#btn_pay_complated').click(function(){				
			$.post('<?php echo U("line/wxpayresult");?>', 
			{'order_sn': $(this).attr('data-val')},
			function(data){
				if (data.result != null && data.result.errno != 0) {
					alert (data.result.message);
				}
				if (data.jumpUrl != null) {
					location.href = data.jumpUrl;
				} 
			})
		});
	
		//选择储蓄卡、银行卡支付
		$('.card-pay h3 i').click( function () {
			//添加选定样式
			$(this).addClass('card-pay-checked');
			//移除选择平台
			$('.platform-pay h3 i').removeClass('platform-pay-checked');
			$('.xiyin-pay h3 i').removeClass('xiyin-pay-checked');
			
			
			$('.choose-card').show();
			$('.card-pay > a').show();
			$('.platform-pay ul').hide();
			//移除已经选择的平台样式
			$('.platform-pay li').removeClass('platform-checked');
		} );
		//选择平台支付
		$('.platform-pay h3 i').click( function () {
			//添加选定样式
			$(this).addClass('platform-pay-checked');
			//移除选择储蓄卡、银行卡支付
			$('.card-pay h3 i').removeClass('card-pay-checked');
			$('.xiyin-pay h3 i').removeClass('xiyin-pay-checked');
			$('.platform-pay ul').show();
			$('.choose-card').hide();
			$('.card-pay > a').hide();
			//移除已经选择的银行样式
			$('.choose-card li').removeClass('bank-checked');
		} );
		//选择西银支付
		$('.xiyin-pay h3 i').click( function () {
			//添加选定样式
			$(this).addClass('xiyin-pay-checked');
			//移除选择储蓄卡、银行卡支付
			$('.card-pay h3 i').removeClass('card-pay-checked');
			$('.platform-pay h3 i').removeClass('platform-pay-checked');
			$('.choose-card').hide();
			$('.card-pay > a').hide();
			$('.platform-pay ul').hide();
			//移除已经选择的银行样式
			$('.choose-card li').removeClass('bank-checked');
			//移除已经选择的平台样式
			$('.platform-pay li').removeClass('platform-checked');
		} );
		
		//改变class
		function changeClass(a , b , c){
			$(a).click( function () {
				$(this).siblings(c).removeClass(b);
				$(this).addClass(b);
				if ($(this).parent().hasClass('choose-all-or-part')) {
					var finalPayMoney = '<?php echo ($order["final_pay_money"]); ?>';
					if ($(this).hasClass('part')) {
						finalPayMoney = 0.5 * parseFloat('<?php echo ($order["final_pay_money"]); ?>');		
					}
					$(this).parent().next().find('.final_pay_money').html(finalPayMoney);
				}
			} );
		};
		changeClass('.choose-all-or-part > a', 'pay-checked' , 'a');
		changeClass('.card-pay > a', 'card-checked' , 'a');
		changeClass('.choose-bank-card li', 'bank-checked' , 'li');
		changeClass('.choose-credit-card li', 'bank-checked' , 'li');
		changeClass('.platform-pay li', 'platform-checked' , 'li');

		//网上银行、信用卡切换
		$('#chuxuka').click( function () {
			$('.choose-bank-card').show();
			$('.choose-credit-card').hide();
			//信用卡选择移除样式
			$('.choose-credit-card li').removeClass('bank-checked');
		} );
		$('#xinyongka').click( function () {
			$('.choose-bank-card').hide();
			$('.choose-credit-card').show();
			//储蓄卡选择移除样式
			$('.choose-bank-card li').removeClass('bank-checked');
		} );
		
		$('.btn_pay').click(function(){			
			var payType = '', payChannel='', payBank='';
			var payTypeObj = $('.platform-pay-checked').parent().parent();
			if ($(payTypeObj).hasClass('platform-pay')) {
				//西银在线支付
				if($('.xiyin-pay').find('h3').find('i').hasClass('xiyin-pay-checked')){
					payType = 'pay_menu_xianbank_pay';
					payChannel = 'pay_menu_xianbank_pay';
				}else{
					payType = 'platform';
					payChannel = $('.platform-checked').attr('id');
				}	
			} else {	
				payType = 'chuxuxinyong';
				payChannel = $('.card-checked').attr('id');
				payBank = $('.bank-checked').attr('data-bank');		
			}
			var payMoneyType = $('.choose-all-or-part').find('.pay-checked').hasClass('all') ?  1 : 0;
			var jsonData = {
				op_type: 'pay',
				id: '<?php echo ($order["id"]); ?>',
				pay_money_all: payMoneyType,
				pay_type: payType,
				pay_channel: payChannel,
				pay_bank: payBank,
			}
			$.post('<?php echo U("line/order");?>', jsonData, function(data){
//				console.log(JSON.stringify(data));
//				alert('支付接口正在维护，请稍后再试，谢谢配合!!!');
				if (data.html != null) {
					$('#popup_pay').html(data.html);
					return true;
				}
				if (data.image != null) {
					showPayQrcode(data.image, data.order_sn);
				}
			 	if (data.result != null) {
			 		alert(data.result.message);
			 	}
				if (data.jumpUrl != null) {
			 		location.href = data.jumpUrl;
			 	}
			});
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