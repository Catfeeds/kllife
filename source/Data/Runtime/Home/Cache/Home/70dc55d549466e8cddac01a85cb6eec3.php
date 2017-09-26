<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="领袖户外" name="author"/>
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
					<?php if(is_array($stations)): $i = 0; $__LIST__ = $stations;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i; if($s['forbidden'] === '0'): if($station['id'] == $s['id']): ?><a href="<?php echo U('index/welcome');?>/station/<?php echo ($s["key"]); ?>" style="color: #ff8000"> <?php echo ($s["name"]); ?> </a> |
							<?php else: ?>
								<a href="<?php echo U('index/welcome');?>/station/<?php echo ($s["key"]); ?>"> <?php echo ($s["name"]); ?> </a> |<?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
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
				</script>
			</div>
		</div>		
	</header>
	<style type="text/css">
		.btn-disabled { background-color: #ececec!important; }
	</style>
	<!-- 私有样式 -->
	<link rel="stylesheet" href="/source/Static/home/css/order.css">
	<!-- 验证码 -->
	<link rel="stylesheet" href="/source/Static/home/common/css/drag.css">
	<!-- 参团成人模板 -->
	<div class="adult-information hidden_ctrl template_adult">
		<div class="adult-information-num">
			<p>第<span></span>位</p>
			<u>成人</u>
		</div>
		<div class="adult-information-write">
			<p>
				<span>姓名：</span><input type="text" class="name" placeholder="请输入真实姓名">
			</p>
			<div class="adult-information-card">
				<span>证件类型：</span><div class="adult-information-card-choose">
					<?php if(count($certs) > 0): ?><span data-id="<?php echo ($certs[0]['id']); ?>"><?php echo ($certs[0]['type_desc']); ?></span><?php endif; ?>
					<img src="/source/Static/home/images/content_img/down.png" alt="">
					<ul>
						<?php if(is_array($certs)): $i = 0; $__LIST__ = $certs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cert): $mod = ($i % 2 );++$i; if($cert["type_desc"] == '港澳证'): ?><li class="hongkong-macao" data-id="<?php echo ($cert["id"]); ?>"><?php echo ($cert["type_desc"]); ?></li>
							<?php else: ?>
								<li data-id="<?php echo ($cert["id"]); ?>"><?php echo ($cert["type_desc"]); ?></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<input type="text" class="cert" placeholder="请输入证件号码">
			</div>
			<div class="adult-information-birth">
				<span>出生日期：</span><div class="adult-information-birth-year">
					<span>2016</span>
					<img src="/source/Static/home/images/content_img/down.png" alt="">
					<ul></ul>
				</div>
				<div class="adult-information-birth-month">
					<span>1</span>
					<img src="/source/Static/home/images/content_img/down.png" alt="">
					<ul></ul>
				</div>
				<div class="adult-information-birth-day">
					<span>1</span>
					<img src="/source/Static/home/images/content_img/down.png" alt="">
					<ul></ul>
				</div>
			</div>
			<p>
				<span>联系电话：</span><input type="text" class="phone" placeholder="请输入手机号码">
			</p>
		</div>		
		<?php if(empty($largess) == false): ?><div class="largess" style="margin-top:30px;padding:0px 140px;">
				<p style="margin:0px 0px 10px;padding:0px 0px 20px 29px;width:470px;border-bottom:1px solid #ddd;">赠品：</p>
				<?php if(is_array($largess)): $i = 0; $__LIST__ = $largess;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g): $mod = ($i % 2 );++$i;?><p class="largess_item" style="padding-top:10px" data-id="<?php echo ($g["id"]); ?>">
						<span style="width:65px;display: inline-block;text-align: right;"><?php echo ($g["type_desc"]); ?>：</span>
						<select class="largess_data" style="width:430px;height:32px;padding-left:5px;">
							<?php if(is_array($g["data"])): $i = 0; $__LIST__ = $g["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gd): $mod = ($i % 2 );++$i;?><option value="<?php echo ($gd["id"]); ?>"><?php echo ($gd["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</p><?php endforeach; endif; else: echo "" ;endif; ?>
			</div><?php endif; ?>
	</div>

	<!-- 参团儿童模板 -->
	<div class="children-information hidden_ctrl template_children">
		<div class="children-information-num">
			<p>第<span></span>位</p>
			<u>儿童</u>
		</div>
		<div class="children-information-write">
			<p>
				<span>姓名：</span><input type="text" class="name" placeholder="请输入真实姓名">
			</p>
			<div class="children-information-card">
				<span>证件类型：</span><div class="children-information-card-choose">
					<?php if(count($certs) > 0): ?><span data-id="<?php echo ($certs[0]['id']); ?>"><?php echo ($certs[0]['type_desc']); ?></span><?php endif; ?>
					<img src="/source/Static/home/images/content_img/down.png" alt="">
					<ul>
						<?php if(is_array($certs)): $i = 0; $__LIST__ = $certs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cert): $mod = ($i % 2 );++$i; if(cert.type_desc == '港澳证'): ?><li class="hongkong-macao" data-id="<?php echo ($cert["id"]); ?>"><?php echo ($cert["type_desc"]); ?></li>
							<?php else: ?>
								<li data-id="<?php echo ($cert["id"]); ?>"><?php echo ($cert["type_desc"]); ?></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<input type="text" class="cert" placeholder="请输入证件号码">
			</div>
			<div class="children-information-birth">
				<span>出生日期：</span><div class="children-information-birth-year">
					<span>2016</span>
					<img src="/source/Static/home/images/content_img/down.png" alt="">
					<ul></ul>
				</div>
				<div class="children-information-birth-month">
					<span>1</span>
					<img src="/source/Static/home/images/content_img/down.png" alt="">
					<ul></ul>
				</div>
				<div class="children-information-birth-day">
					<span>1</span>
					<img src="/source/Static/home/images/content_img/down.png" alt="">
					<ul></ul>
				</div>
			</div>
			<p>
				<span>联系电话：</span><input type="text" class="phone" placeholder="请输入手机号码">
			</p>
			<p class="children-no-card" style="margin-top: 20px; color: #e4393c;">*若无身份证，填写出生日期即可</p>
		</div>
		<?php if(empty($largess) == false): ?><div class="largess" style="margin-top:30px;padding:0px 140px;">
				<p style="margin:0px 0px 10px;padding:0px 0px 20px 29px;width:470px;border-bottom:1px solid #ddd;">赠品：</p>
				<?php if(is_array($largess)): $i = 0; $__LIST__ = $largess;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g): $mod = ($i % 2 );++$i;?><p class="largess_item" style="padding-top:10px" data-id="<?php echo ($g["id"]); ?>">
						<span style="width:65px;display: inline-block;text-align: right;"><?php echo ($g["type_desc"]); ?>：</span>
						<select class="largess_data" style="width:430px;height:32px;padding-left:5px;">
							<?php if(is_array($g["data"])): $i = 0; $__LIST__ = $g["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gd): $mod = ($i % 2 );++$i;?><option value="<?php echo ($gd["id"]); ?>"><?php echo ($gd["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</p><?php endforeach; endif; else: echo "" ;endif; ?>
			</div><?php endif; ?>
	</div>
	<!-- 主要内容 -->
	<div class="order-content" data-id="<?php echo ($line["id"]); ?>">
		<!-- 支付详情 -->
		<div class="order-details">
			<div class="order-details-left">
				<div class="order-details-place">
					<h3><?php echo ($line["title"]); ?></h3>
					<?php if(!empty($line["batchs"])): ?><div class="order-details-choose">
							出发日期：
							<div class="cfrq-choose">
								<span data-id="<?php echo ($cur_batch['id']); ?>"><?php echo ($cur_batch['start_date_show']); ?>--<?php echo ($cur_batch['end_date_show']); ?>  成人：<?php echo ($cur_batch['price_adult']); ?>元</span>
								<img src="/source/Static/home/images/content_img/down.png" alt="">
								<ul>
									<?php if(is_array($line["batchs"])): $i = 0; $__LIST__ = $line["batchs"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$batch): $mod = ($i % 2 );++$i;?><li data-id="<?php echo ($batch["id"]); ?>" data-title="<?php echo ($batch["title"]); ?>" data-price-adult="<?php echo ($batch["price_adult"]); ?>" data-price-child="<?php echo ($batch["price_child"]); ?>" data-use="<?php echo ($batch["can_use"]); ?>" data-invalid="<?php echo ($batch["signup_invalid"]); ?>">
											<?php echo ($batch["start_date_show"]); ?>--<?php echo ($batch["end_date_show"]); ?>  成人：<?php echo ($batch["price_adult"]); ?>元 [<?php echo ($batch["state_data"]["type_desc"]); ?>]
										</li><?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>
							</div>
						</div>
						<div class="order-details-line-money">
							线路价格：
							<div class="xljg">
								<span>成人/￥<?php echo ($cur_batch['price_adult']); ?></span>
								<span>儿童/￥<?php echo ($cur_batch['price_child']); ?></span>
							</div>
						</div>
						<div class="order-details-people">
							出游人数：
							<div class="cyrs">
								<?php if(empty($check['only_child']) == true): ?><div class="adult-num-man">
										<u>成人男</u>
										<a class="add-adult" href="javascript:;"><i class="adult-add"></i></a>
										<span class="member_count"><?php echo ($member_male_count); ?></span>
										<a class="minus-adult" href="javascript:;"><i class="adult-minus"></i></a>

									</div>
									<div class="adult-num-woman">
										<u>成人女</u>
										<a class="add-adult" href="javascript:;"><i class="adult-add"></i></a>
										<span class="member_count"><?php echo ($member_woman_count); ?></span>
										<a class="minus-adult" href="javascript:;"><i class="adult-minus"></i></a>
									</div><?php endif; ?>
								<?php if(empty($check['only_adult']) == true): ?><div class="children-num">
										<u>儿童</u>
										<a class="add-children" href="javascript:;"><i class="children-add"></i></a>
										<span class="member_count"><?php echo ($member_child_count); ?></span>
										<a class="minus-children" href="javascript:;"><i class="children-minus"></i></a>
									</div><?php endif; ?>
							</div>
						</div><?php endif; ?>
					<!-- 出游人确认 -->
					<div class="order-details-people-sure">
						<div class="people-sure-content">
							<h6>出游人确认</h6>
							<div>
								<p>出游人中是否有60周岁(含)至80周岁(不含)的老人？</p>
								<div class="old-man">
									<i></i><span>有</span>
									<i class="choose-man"></i><span>没有</span>
								</div>
							</div>
							<div>
								<p>出游人中是否有外籍友人？</p>
								<div class="foreign-man">
									<i></i><span>有</span>
									<i class="choose-man"></i><span>没有</span>
								</div>
							</div>
							<div>
								<p>出游人中是否有港澳台同胞？</p>
								<div class="gat-man">
									<i></i><span>有</span>
									<i class="choose-man"></i><span>没有</span>
								</div>
							</div>
							<p>本产品不支持孕妇或者80周岁(含)以上的老人出游，18周岁以下的未成年人必须有成年人陪同出游，敬请谅解！</p>
						</div>
					</div>
				</div>
				<!-- 联系人信息 -->
				<div class="order-details-contact">
					<h3>联系人信息</h3>
					<div class="order-details-contact-write">
						<p><span>姓名：</span><input id="contact_name" type="text"></p>
						<p><span>联系电话：</span><input id="contact_phone" type="text"></p>

						<?php if(empty($user)): ?><p class="send-code">
								<span>校验码：</span><input id="contact_verify_code" type="text">
								<input id="btnSendCode" type="button" value="发送校验码" />
								<span id="contact_result"></span>
							</p>
						<?php else: ?>
							<p><span>验证码：</span><span id="drag"></span></p><?php endif; ?>
					</div>
				</div>
				<!-- 发票信息 -->
				<div class="order-details-invoice">
					<h3>发票信息</h3>
					<div class="order-details-invoice-choose">
						<label><input id="no-invoice" name="invoice" type="radio" value="0" checked />不需要发票</label>
						<label><input id="enterprise-invoice" name="invoice" type="radio" value="1" />企业发票</label>
						<label><input id="personal-invoice" name="invoice" type="radio" value="2" />个人发票</label>
					</div>
					<div class="order-details-invoice-write-enterprise">
						<div class="invoice-write-enterprise01">
							<span>单位名称：<input class="receipt_company" type="text" placeholder="请输入单位名称"></span>
							<span>纳税人识别号：<input class="receipt_company_no" type="text" placeholder="请输入纳税人识别号"></span>
						</div>
						<div class="invoice-write-enterprise02">
							<span>单位地址：<input class="receipt_company_addr" type="text" placeholder="请输入单位地址"></span>
						</div>
						<div class="invoice-write-enterprise03">
							<span>单位电话：<input class="receipt_company_tel" type="text" placeholder="请输入单位电话"></span>
							<span>收件人：<input class="receipt_receiver" type="text" placeholder="请输入真实姓名"></span>
							<span>收件电话：<input class="receipt_receiver_tel" type="text" placeholder="请输入收件电话"></span>
						</div>
						<div class="invoice-write-enterprise04">
							<span>收件地址：</span><input class="receipt_receiver_addr" type="text" placeholder="请输入收件地址">
						</div>
						<p>备注：1、活动结束后的2个月内寄出；2、跨年度及超过2个月未索取发票的无法开具发票。<a style="color: #0000ff;" target="_blank" href="http://kllife.com/home/index.php?s=/home/service/question/id/133">详情请点击</a></p>
					</div>
					<div class="order-details-invoice-write-personal">
						<div class="invoice-write-personal01">
							<span>收件人：</span><input class="receipt_receiver" type="text" placeholder="请输入真实姓名">
							<span>电话：</span><input class="receipt_receiver_tel" type="text" placeholder="请输入手机号码">
						</div>
						<div class="invoice-write-personal02">
							<span>收件地址：</span><input class="receipt_receiver_addr" type="text" placeholder="请输入收件地址">
						</div>
						<p style="margin-top: 15px;">备注：1、活动结束后的2个月内寄出；2、跨年度及超过2个月未索取发票的无法开具发票。<a style="color: #0000ff;" target="_blank" href="http://kllife.com/home/index.php?s=/home/service/question/id/133">详情请点击</a></p>
					</div>
				</div>
				<!-- 出游人信息 -->
				<div class="order-details-travel-people">
					<h3>出游人信息</h3>
					<div class="travel-people-warning">
						<p>· 为了保障您的合法权益，请准确、完整地填写游客证件信息，错误的身份信息可能造成额外的退、改费用。</p>
						<p>· 儿童游客如无相关证件，证件类型请选择"其他"，并填写出生日期。</p>
						<p>· 出游人信息不完整会影响您的正常出游；因信息不完整、填写不正确造成的额外损失、保险拒赔等问题，我司不承担相应责任，需由客人自行承担。</p>
					</div>
					<div class="adult-div">
						<?php $adult_count = $member_male_count+$member_woman_count; ?>
						<?php $__FOR_START_413807261__=0;$__FOR_END_413807261__=$adult_count;for($m=$__FOR_START_413807261__;$m < $__FOR_END_413807261__;$m+=1){ ?><div class="adult-information">
								<div class="adult-information-num">
									<p>第<span><?php echo ($m+1); ?></span>位</p>
									<?php if($m < $member_male_count): ?><u>成人男</u>
									<?php else: ?>
										<u>成人女</u><?php endif; ?>
								</div>
								<div class="adult-information-write">
									<p>
										<span>姓名：</span><input type="text" class="name" placeholder="请输入真实姓名">
									</p>
									<div class="adult-information-card">
										<span>证件类型：</span><div class="adult-information-card-choose">
											<?php if(count($certs) > 0): ?><span data-id="<?php echo ($certs[0]['id']); ?>"><?php echo ($certs[0]['type_desc']); ?></span><?php endif; ?>
											<img src="/source/Static/home/images/content_img/down.png" alt="">
											<ul>
												<?php if(is_array($certs)): $i = 0; $__LIST__ = $certs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cert): $mod = ($i % 2 );++$i; if($cert["type_desc"] == '港澳证'): ?><li class="hongkong-macao" data-id="<?php echo ($cert["id"]); ?>"><?php echo ($cert["type_desc"]); ?></li>
													<?php else: ?>
														<li data-id="<?php echo ($cert["id"]); ?>"><?php echo ($cert["type_desc"]); ?></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
											</ul>
										</div>
										<input type="text" class="cert" placeholder="请输入证件号码">
									</div>
									<div class="adult-information-birth">
										<span>出生日期：</span><div class="adult-information-birth-year">
											<span>2016</span>
											<img src="/source/Static/home/images/content_img/down.png" alt="">
											<ul></ul>
										</div>
										<div class="adult-information-birth-month">
											<span>1</span>
											<img src="/source/Static/home/images/content_img/down.png" alt="">
											<ul></ul>
										</div>
										<div class="adult-information-birth-day">
											<span>1</span>
											<img src="/source/Static/home/images/content_img/down.png" alt="">
											<ul></ul>
										</div>
									</div>
									<p>
										<span>联系电话：</span><input type="text" onkeyup="this.value=this.value.replace(/\D/g,'')"  onafterpaste="this.value=this.value.replace(/\D/g,'')" class="phone" placeholder="请输入手机号码" maxlength="11">
									</p>
								</div>
								<?php if(empty($largess) == false): ?><div class="largess" style="margin-top:30px;padding:0px 140px;">
										<p style="margin:0px 0px 10px;padding:0px 0px 20px 29px;width:470px;border-bottom:1px solid #ddd;">赠品：</p>
										<?php if(is_array($largess)): $i = 0; $__LIST__ = $largess;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g): $mod = ($i % 2 );++$i;?><p class="largess_item" style="padding-top:10px" data-id="<?php echo ($g["id"]); ?>">
												<span style="width:65px;display: inline-block;text-align: right;"><?php echo ($g["type_desc"]); ?>：</span>
												<select class="largess_data" style="width:430px;height:32px;padding-left:5px;">
													<?php if(is_array($g["data"])): $i = 0; $__LIST__ = $g["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gd): $mod = ($i % 2 );++$i;?><option value="<?php echo ($gd["id"]); ?>"><?php echo ($gd["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
												</select>
											</p><?php endforeach; endif; else: echo "" ;endif; ?>
									</div><?php endif; ?>
							</div><?php } ?>
					</div>
					<div class="children-div">
						<?php $__FOR_START_950785788__=0;$__FOR_END_950785788__=$member_child_count;for($n=$__FOR_START_950785788__;$n < $__FOR_END_950785788__;$n+=1){ ?><div class="children-information">
								<div class="children-information-num">
									<p>第<span><?php echo ($n+1); ?></span>位</p>
									<u>儿童</u>
								</div>
								<div class="children-information-write">
									<p>
										<span>姓名：</span><input type="text" class="name" placeholder="请输入真实姓名">
									</p>
									<div class="children-information-card">
										<span>证件类型：</span><div class="children-information-card-choose">
											<?php if(count($certs) > 0): ?><span data-id="<?php echo ($certs[0]['id']); ?>"><?php echo ($certs[0]['type_desc']); ?></span><?php endif; ?>
											<img src="/source/Static/home/images/content_img/down.png" alt="">
											<ul>
												<?php if(is_array($certs)): $i = 0; $__LIST__ = $certs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cert): $mod = ($i % 2 );++$i; if(cert.type_desc == '港澳证'): ?><li class="hongkong-macao" data-id="<?php echo ($cert["id"]); ?>"><?php echo ($cert["type_desc"]); ?></li>
													<?php else: ?>
														<li data-id="<?php echo ($cert["id"]); ?>"><?php echo ($cert["type_desc"]); ?></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
											</ul>
										</div>
										<input type="text" class="cert" placeholder="请输入证件号码">
									</div>
									<div class="children-information-birth">
										<span>出生日期：</span><div class="children-information-birth-year">
											<span>2016</span>
											<img src="/source/Static/home/images/content_img/down.png" alt="">
											<ul></ul>
										</div>
										<div class="children-information-birth-month">
											<span>1</span>
											<img src="/source/Static/home/images/content_img/down.png" alt="">
											<ul></ul>
										</div>
										<div class="children-information-birth-day">
											<span>1</span>
											<img src="/source/Static/home/images/content_img/down.png" alt="">
											<ul></ul>
										</div>
									</div>
									<p>
										<span>联系电话：</span><input type="text" onkeyup="this.value=this.value.replace(/\D/g,'')"  onafterpaste="this.value=this.value.replace(/\D/g,'')"  class="phone" placeholder="请输入手机号码" maxlength="11">
									</p>
									<p class="children-no-card" style="margin-top: 20px; color: #e4393c;">*若无身份证，填写出生日期即可</p>
								</div>
								<?php if(empty($largess) == false): ?><div class="largess" style="margin-top:30px;padding:0px 140px;">
										<p style="margin:0px 0px 10px;padding:0px 0px 20px 29px;width:470px;border-bottom:1px solid #ddd;">赠品：</p>
										<?php if(is_array($largess)): $i = 0; $__LIST__ = $largess;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g): $mod = ($i % 2 );++$i;?><p class="largess_item" style="padding-top:10px" data-id="<?php echo ($g["id"]); ?>">
												<span style="width:65px;display: inline-block;text-align: right;"><?php echo ($g["type_desc"]); ?>：</span>
												<select class="largess_data" style="width:430px;height:32px;padding-left:5px;">
													<?php if(is_array($g["data"])): $i = 0; $__LIST__ = $g["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gd): $mod = ($i % 2 );++$i;?><option value="<?php echo ($gd["id"]); ?>"><?php echo ($gd["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
												</select>
											</p><?php endforeach; endif; else: echo "" ;endif; ?>
									</div><?php endif; ?>
							</div><?php } ?>
					</div>

				</div>
				<!-- 预定须知 -->
				<div class="order-details-reserve">
					<h3>预订须知</h3>
					<div class="reserve-content">
						<p style="padding: 10px 0; color: #00f;">特别声明：领袖户外的行程安排可能会根据实际突发情况和队员反馈进行调整和优化，但调整不会涉及费用包含的景区、游览天数、集散地点以及住宿标准，最终行程安排以合同内容为准。
</p>
						<?php echo ($line["booking_notes"]); ?>
					</div>
				</div>
				<!-- 提交订单 -->
				<div class="order-details-submit">
					<a href="javascript:;">我已阅读预定须知并同意,提交订单</a>
				</div>
				<!-- 旅游合同 -->
				<div class="order-details-contract">
					<h3>旅游合同<span>(为了保障双方的合法权益，我们将与您使用在线签约方式签署合同，此合同在得到资源确认并付款完成时正式生效。)</span></h3>
					<div class="contract-img">
						<img src="/source/Static/home/images/order_img/contract1.jpg" alt="">
						<img src="/source/Static/home/images/order_img/contract2.jpg" alt="">
						<img src="/source/Static/home/images/order_img/contract3.jpg" alt="">
						<img src="/source/Static/home/images/order_img/contract4.jpg" alt="">
						<img src="/source/Static/home/images/order_img/contract5.jpg" alt="">
						<img src="/source/Static/home/images/order_img/contract6.jpg" alt="">
						<img src="/source/Static/home/images/order_img/contract7.jpg" alt="">
						<img src="/source/Static/home/images/order_img/contract8.jpg" alt="">
					</div>
				</div>
			</div>
			<!-- 右侧 -->
			<div class="order-details-right">
				<h3>支付信息</h3>
				<div class="order-details-right-top">
					<h6>产品名称</h6>
					<?php if(empty($cur_batch) == false): ?><span><?php echo ($line["title"]); ?></span>
						<h6>旅行团费</h6>
						<div class="order-details-right-people">
							<p class="adult-money"><span><?php echo ($member_adult_count); ?></span> 成人 x ￥<u><?php echo ($adult_price); ?></u><i>￥<b><?php echo ($adult_total_price); ?></b></i></p>
							<p class="children-money"><span><?php echo ($member_child_count); ?></span> 儿童 x ￥<u><?php echo ($child_price); ?></u><i>￥<b><?php echo ($child_total_price); ?></b></i></p>
							<p>总团费</p>
							<p class="team-money">&nbsp&nbsp&nbsp&nbsp原价:<i>￥<b class="full"><?php echo ($team_money["full"]); ?></b></i> 现价:<i>￥<b class="cut"><?php echo ($team_money["cut"]); ?></b></i></p>
							<?php if(is_array($line_offer)): $i = 0; $__LIST__ = $line_offer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$offer): $mod = ($i % 2 );++$i;?><p class="line_offer <?php echo ($key); ?>">'+<?php echo ($offer["data"]["type_desc"]); ?>+': ￥<u>'+<?php echo ($offer["money"]); ?>+'</p><?php endforeach; endif; else: echo "" ;endif; ?>
							<p class="invoice-money" style="display: none;"><span>1</span> 发票邮寄 x ￥<u><?php echo ($line["receipt_price"]); ?></u><i>￥<b><?php echo ($line["receipt_price"]); ?></b></i></p>
						</div>
					<?php else: ?>
						<span>未知批次</span>
						<h6>旅行团费</h6>
						<div class="order-details-right-people">
							<p class="adult-money"><span>0</span> 成人 x ￥<u>0</u><i>￥<b>0</b></i></p>
							<p class="children-money"><span>0</span> 儿童 x ￥<u>0</u><i>￥<b>0</b></i></p>
							<p>总团费</p>
							<p class="team-money">&nbsp&nbsp&nbsp&nbsp原价:<i>￥<b class="full">0</b></i> 现价:<i>￥<b class="cut">0</b></i></p>
							<p class="invoice-money" style="display: none;"><span>1</span> 发票邮寄 x ￥<u>0</u><i>￥<b>0</b></i></p>
						</div><?php endif; ?>
				</div>
				<div class="order-details-right-money">
					<p>订单金额</p>
					<span>￥<strong class="need_pay_money"><?php echo ($team_money["cut"]); ?></strong></span>
				</div>
			</div>

		</div>
	</div>


	<div class="mark"></div>
	<div id="alert-modal">

		<div class="alert-modal-top">
			<a href="javascript:;"><img src="/source/Static/home/common/images/video_close.png"/></a>
		</div>
		<div class="alert-modal-content">
			<p></p>
		</div>

	</div>


	<!-- 出生日期 -->
	<script src="/source/Static/home/js/birthday.js"></script>
	<!-- 验证码 -->
	<script src="/source/Static/home/js/drag.js"></script>
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
	<script type="text/javascript">
		//modal关闭
		$('.alert-modal-top a').click(function(){
			$('.mark').hide();
			$('#alert-modal').hide();
		});
	
	
	
		//下拉框宽度一致
	
		$('.cfrq-choose ul').width($('.cfrq-choose span').width() + 98);	
		
		//验证码
		$('#drag').drag();
			
		// 出游人数
		$('.add-adult').click(changeMemberCount);
		$('.add-children').click(changeMemberCount);
		$('.minus-adult').click(changeMemberCount);
		$('.minus-children').click(changeMemberCount);
		
		// 重新核算总价
		function calcOrderTotal() {			
			var adultCount = 0, childCount = 0;
			$('.order-details-people').find('.member_count').each(function(i, ev){
				if ($(this).parent().hasClass('children-num')) {
					childCount += parseInt($(this).html());
				} else {
					adultCount += parseInt($(this).html());
				}
			});
			
			var jsonData = {
				op_type: 'calc_money',
				batch_id: $('.cfrq-choose').find('span').attr('data-id'),
				adult_count: adultCount,
				child_count: childCount,
			}
			
			$.post('<?php echo U("line/order");?>', jsonData, function(data){
				if (data.result.errno == 0) {					
					// 优惠后的单价
					var adultPrice = parseFloat('<?php echo ($cur_batch["price_adult"]); ?>');
					var childPrice = parseFloat('<?php echo ($cur_batch["price_child"]); ?>');					
					if (data.offer != null) {
						if (data.offer.line_special_offer_adult != null) {
							adultPrice = parseFloat(data.offer.line_special_offer_adult.money);
						}
						if (data.offer.line_special_offer_child != null) {
							childPrice = parseFloat(data.offer.line_special_offer_child.money);
						}
					}
					
					// 优惠后的各类型总价
					var adultTotalPrice = adultPrice * adultCount;
					var childTotalPrice = childPrice * childCount;
					
					var vhtml = '';
					// 各类型团费
					vhtml += '<p class="adult-money"><span>'+adultCount+'</span> 成人 x ￥<u>'+adultPrice+'</u><i>￥<b>'+adultTotalPrice+'</b></i></p>'
					vhtml += '<p class="children-money"><span>'+childCount+'</span> 儿童 x ￥<u>'+childPrice+'</u><i>￥<b>'+childTotalPrice+'</b></i></p>'
					
					// 优惠信息
					if (data.offer != null) {
						for (k in data.offer) {
							var f = data.offer[k];
							vhtml += '<p class="line_offer '+k+'">'+f.data.type_desc+': ￥<u>'+f.money+'</p>';								
						}
					}					
					vhtml += '<p>总团费</p>';
					vhtml += '<p class="team-money">&nbsp;&nbsp;&nbsp;&nbsp;原价:<i>￥<b class="full">'+data.money.full+'</b></i> 现价:<i>￥<b class="cut">'+data.money.cut+'</b></i></p>'		
					
					// 发票类型
					var receiptType = $('.order-details-invoice').find('.order-details-invoice-choose').find('input:checked').val();
					var receiptClass = receiptType == 0 ? 'hidden_ctrl' : '';				
					vhtml += '<p class="invoice-money '+receiptClass+'"><span>1</span> 发票邮寄 x ￥<u>'+'<?php echo ($line["receipt_price"]); ?>'+'</u><i>￥<b>'+'<?php echo ($line["receipt_price"]); ?>'+'</b></i></p>';
					
					// 显示计算内容
					$('.order-details-right-people').empty();
					$('.order-details-right-people').html(vhtml);
					
					// 总价格
					var needPayMoney = parseFloat(data.money.cut);
					if (receiptType != 0) {
					  needPayMoney += parseFloat('<?php echo ($line["receipt_price"]); ?>');						
					}					
					$('.order-details-right-money').find('.need_pay_money').html(needPayMoney);										
				} else {
					$('.mark').show()
					$('#alert-modal').show();
					$('#alert-modal').find('p').html(data.result.message);
					setTimeout(function(){
						$('.mark').hide()
						$('#alert-modal').hide();
					},3000);
					//alert(data.result.message);
				}
			});	
		}
		
		// 添加参团人HTML
		function appendMember(isAdult, isMan) {
			var obj_attach = isAdult == true ? '.adult' : '.children'; 
			var containerObj = isAdult == true ? '.adult-div' : '.children-div';
			var index = $(containerObj).find(obj_attach+'-information').length + 1;
			var rootClass = 'template_'+(isAdult==true?'adult':'children');
			var rootObj = $('.'+rootClass).clone(true);
			$(rootObj).removeClass(rootClass);
			$(rootObj).removeClass('hidden_ctrl');
			// 名次人员类型
			var snObj = $(rootObj).find(obj_attach+'-information-num');
			$(snObj).find('p span').html(index);
			$(snObj).find('u').html(isAdult == false ? '儿童' : (isMan == false ? '成人女' : '成人男'));
			$(containerObj).append(rootObj);
		}
		
		// 改变出游人数
		function changeMemberCount() {
			var isAdult = true, isAdd = true, isMan = false;
			if ($(this).parent().hasClass('children-num')) {
				isAdult = false;
			}
			if ($(this).attr('class').indexOf('add') == -1) {
				isAdd = false;
			}
			if ($(this).parent().attr('class').indexOf('woman') == -1) {
				isMan = true
			}
						
			var nNum = parseInt($(this).parent().find('span').html());
			// 是否需要减少人数HTML
			var needReduce = isAdd == false && nNum == 0 ? false : true;
			nNum = isAdd ? nNum + 1 : nNum - 1;
			if (nNum < 0) {
				nNum = 0;
			}						
			// 设置当前参团人数
			$(this).parent().find('span').html(nNum);
						
			// 设置计价单总价
			calcOrderTotal();
			
			// 添加参团人HTML
			if (isAdd == false) {
				var rootObj = isAdult?'.adult-div':'.children-div';
				var reduceObj = isAdult?'.adult-information:last':'.children-information:last';
				$(rootObj).find(reduceObj).remove();
			} else {
				appendMember(isAdult, isMan);
			} 
		}
			
		// 选择批次后
		function chooseBatch(id, title, adult_price, child_price) {
			$('.order-details-right').find('h6').html(title);
			$('.order-details-right').find('.adult-money u').html(adult_price);
			$('.order-details-right').find('.children-money u').html(child_price);
			$('.order-details-left').find('.xljg span:first').html('￥'+adult_price+'/成人');
			$('.order-details-left').find('.xljg span:last').html('￥'+child_price+'/儿童');
			// 重新计算订单价格
			calcOrderTotal();			
		}
		
		//鼠标离开，关闭下拉框
		$('.adult-information-card-choose').mouseleave(function(){
			$(this).children('ul').hide();
		});
		$('.children-information-card-choose').mouseleave(function(){
			$(this).children('ul').hide();
		});
		$('.children-information-birth-year').mouseleave(function(){
			$(this).children('ul').hide();
		});
		$('.children-information-birth-month').mouseleave(function(){
			$(this).children('ul').hide();
		});
		$('.children-information-birth-day').mouseleave(function(){
			$(this).children('ul').hide();
		});
		//选择下拉框
		function chooseDown( f ) {
			$( '.' + f + ' span').click( function () {
				$(this).parent( '.' + f ).children('ul').show();
			} );
			$( '.' + f + ' img').click( function () {
				$(this).parent( '.' + f ).children('ul').show();
			} );
			$( '.' + f + ' ul li').click( function () {
				if (f == 'cfrq-choose') {
					if ($(this).attr('data-invalid') == 1) {
						alert('该批次已过期报名时间，详情请咨询客服MM');
						return false;
					}
					if ($(this).attr('data-use') == 0) {
						alert('该批次已被禁用或已经下架，详情请咨询客服MM');
						return false;
					}
				}
				$(this).parents( '.' + f ).children('span').html($(this).html());
				$(this).parents( '.' + f ).children('span').attr('data-id', $(this).attr('data-id'))
				$(this).parent('ul').hide();
				
				if (f == 'cfrq-choose') {
					var batchId = $(this).attr('data-id');
					var title = $(this).attr('data-title');
					var adult_price = $(this).attr('data-price-adult');
					var child_price = $(this).attr('data-price-child');
					chooseBatch(batchId, title, adult_price, child_price);
				}
			} );
		};
		$('.adult-information').birthday('.adult-information-birth-year', '.adult-information-birth-month' , '.adult-information-birth-day' , '.adult-information-birth' , 100);
		$('.children-information').birthday('.children-information-birth-year', '.children-information-birth-month' , '.children-information-birth-day' , '.children-information-birth' , 16);
		//选择出发日期
		chooseDown('cfrq-choose');
		//成人选择证件
		chooseDown('adult-information-card-choose');
		//儿童选择证件
		chooseDown('children-information-card-choose');		
		//成人出生日期
		chooseDown('adult-information-birth-year');
		chooseDown('adult-information-birth-month');
		chooseDown('adult-information-birth-day');
		//儿童出生日期
		chooseDown('children-information-birth-year');
		chooseDown('children-information-birth-month');
		chooseDown('children-information-birth-day');
				
		// 港澳证
		$('.hongkong-macao').click( function () {
			$(this).parents('.adult-information-write').find('.adult-information-birth').show();
		} );
		
		$('.hongkong-macao').siblings('li').click( function () {
			$(this).parents('.adult-information-write').find('.adult-information-birth').hide();
		} );
		
		
		
		// 老人&外国友人
		$('.old-man i , .foreign-man i , .gat-man i ').click( function () {
			$(this).addClass('choose-man');
			$(this).siblings('i').removeClass('choose-man');
		} );
		
		//发票
		$('.order-details-invoice-choose label').click( function () {
			if ( $('#enterprise-invoice').is(':checked') ) {
				$('.order-details-invoice-write-enterprise').show();
				$('.order-details-invoice-write-personal').hide();
				$('.invoice-money').show();
				//清空个人发票信息
				$('.order-details-invoice-write-personal input').val('');
			}else if ( $('#personal-invoice').is(':checked') ) {
				$('.order-details-invoice-write-personal').show();
				$('.order-details-invoice-write-enterprise').hide();
				$('.invoice-money').show();
				//清空企业发票信息
				$('.order-details-invoice-write-enterprise input').val('');
			}else {
				$('.order-details-invoice-write-enterprise').hide();
				$('.order-details-invoice-write-personal').hide();
				$('.invoice-money').hide();
			}
			calcOrderTotal();
		} );
		
		//右侧订总价位置样式（随窗口大小不同改变）
		var Width = $(window).width();
		$('.order-details-right').css('right', (Width - 1200)/2 );
		$(window).resize(function(){
			var WidthR = $(window).width();
	        if( WidthR > 1210 ) {
	        	$(".order-details-right").stop().animate({
	            	right: (WidthR - 1200)/2
	        	},150);
	        	console.log(WidthR);
	        }else {
	        	$(".order-details-right").css('right', '44px' );
	        }
	    }); 
		
		// 联系人手机效验码验证
		var IntervalContactSend = 0, sub_send_second = 60, contact_phone='';
		$('#btnSendCode').click(function(data){			
			if ($(this).is(":disabled") == false) {
				contact_phone = $('#contact_phone').val();
				if (checkMobile(contact_phone) == false) {
					alert('电话号码有误');
					return false;
				}
				var jsonData = {
					type: 'send',
					tel: contact_phone,
					use: 'order_contact_phone',
					interval: 600,
					rd: '<?php echo ($pagerd); ?>',
				};
				
				$.post('<?php echo U("common/sms");?>', jsonData, function(data){
					if (data.result.errno == 0) {
						sub_send_second = 600
						$('#btnSendCode').val(sub_send_second+'秒后重新发送');
						$("#btnSendCode").attr("disabled", "disabled");
						IntervalContactSend = window.setInterval(refreshContactPhoneCode, 1000);
						$('.mark').show()
						$('#alert-modal').show();
						setTimeout(function(){
							$('.mark').hide()
							$('#alert-modal').hide();
						},3000);
						//alert(data.ds.code);
					} else {
						//alert(data.result.message);
						$('.mark').show()
						$('#alert-modal').show();
						$('#alert-modal').find('p').html(data.result.message);
						setTimeout(function(){
							$('.mark').hide()
							$('#alert-modal').hide();
						},3000);
					}
				});
			} else {
				$('.mark').show()
				$('#alert-modal').show();
				$('#alert-modal').find('p').html('验证码已经发送，请随后在此发送');
				setTimeout(function(){
					$('.mark').hide()
					$('#alert-modal').hide();
				},3000);
				//alert('验证码已经发送，请随后在此发送');
			}
		});
		
		// 刷新发送联系人手机验证码时间
		function refreshContactPhoneCode() {
			if (sub_send_second == 0) {
				window.clearInterval(IntervalContactSend);
				$('#btnSendCode').val('发送验证码');
				$('#btnSendCode').removeAttr('disabled');
			} else {
				sub_send_second--;
				$('#btnSendCode').val(sub_send_second+'秒后重新发送');
			}
		}
		
		// 更换联系人电话号码
		$('#contact_phone').blur(function(){
			var phone = $('#contact_phone').val();
			if (phone != contact_phone) {
				$('#contact_result').html('');
			}
		});
		
		// 验证联系人发送的验证码
		$('#contact_verify_code').blur(function(){
			if ($('#contact_result').html() != '') {
				return false;
			}
			var sCode = $(this).val();
			if (sCode == '') {
				$('.mark').show()
				$('#alert-modal').show();
				$('#alert-modal').find('p').html('验证码不能为空');
				setTimeout(function(){
					$('.mark').hide()
					$('#alert-modal').hide();
				},3000);
				//alert('验证码不能为空');
				return false;
			}
			var phone = $('#contact_phone').val();
			if (checkMobile(phone) == false) {
				$('.mark').show()
				$('#alert-modal').show();
				$('#alert-modal').find('p').html('验证码有误');
				setTimeout(function(){
					$('.mark').hide()
					$('#alert-modal').hide();
				},3000);
				//alert('验证码有误');
				return false;
			}
			var jsonData = {
				type: 'check',
				tel: phone,
				use: 'order_contact_phone',
				code: sCode,
			};
			
			$.post('<?php echo U("common/sms");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					$('#contact_result').html('验证通过');
					window.clearInterval(IntervalContactSend);
					$('#btnSendCode').val('发送验证码');
					$('#btnSendCode').removeAttr('disabled');
				} else {
					alert(data.result.message);
				}
			});
		});
		
		// 获取订单人数
		function getOrderMemberCount() {
			var memberCount = {adult:0, child:0, total:0};
			$('.order-details-people').find('.member_count').each(function(i, ev){
				if ($(this).parent().hasClass('children-num')) {
					memberCount.child = parseInt(memberCount.child) + parseInt($(this).html());
				} else {
					memberCount.adult = parseInt(memberCount.adult) + parseInt($(this).html());
				}
			});
			memberCount.total = parseInt(memberCount.adult) + parseInt(memberCount.child);
			return memberCount;
		}
		
		// 检查订单信息
		function checkOrder() {
			// 出游人数检查
			var memberCount = getOrderMemberCount();
			if (memberCount.total == 0) {
				$('.mark').show()
				$('#alert-modal').show();
				$('#alert-modal').find('p').html('出游人数不能为0');
				setTimeout(function(){
					$('.mark').hide()
					$('#alert-modal').hide();
				},3000);
				//alert('出游人数不能为0');
				return false;
			}
			
			// 联系人检查
			if ($('#contact_name').val() == '') {
				$('.mark').show()
				$('#alert-modal').show();
				$('#alert-modal').find('p').html('联系人姓名不能为空');
				setTimeout(function(){
					$('.mark').hide()
					$('#alert-modal').hide();
				},3000);
				//alert("联系人姓名不能为空");
				return false;
			}
			
			// 联系人手机确认
			if ('<?php echo ($user["id"]); ?>' == '') {
				if ($('#contact_result').html() != '验证通过') {
					$('.mark').show()
					$('#alert-modal').show();
					$('#alert-modal').find('p').html('联系人手机未验证确认');
					setTimeout(function(){
						$('.mark').hide()
						$('#alert-modal').hide();
					},3000);
					//alert("联系人手机未验证确认");
					return false;
				}	
			} else {
				var contactPhone = $('#contact_phone').val();
				if (checkMobile(contactPhone) == false && checkTel(contactPhone) == false) {	
					$('.mark').show()
					$('#alert-modal').show();
					$('#alert-modal').find('p').html('联系人电话有错误,'+contactPhone);
					setTimeout(function(){
						$('.mark').hide()
						$('#alert-modal').hide();
					},3000);				
					return false;
				};
				//TODO 用户登录后出现滑动验证
				if(!($('.handler').hasClass('handler_ok_bg'))){
					$('.mark').show()
					$('#alert-modal').show();
					$('#alert-modal').find('p').html('请滑动验证码完成验证');
					setTimeout(function(){
						$('.mark').hide()
						$('#alert-modal').hide();
					},3000);
					return false;
				};
			}
			
			return true;
		}
		
		// 获取赠品信息
		function getLargessData(obj) {
			var largess = [];
			$(obj).find('.largess_item').each(function(i,ev){
				var l = {
					largess_id: $(this).attr('data-id'),
					data_id: $(this).find('.largess_data').val(),
				};
				largess.push(l);
			});
			return largess;
		}
		
		// 获取参团人信息
		function getMemberData() {
			var adultObjs = $('.order-details-travel-people .adult-div').find('.adult-information');
			var childObjs = $('.order-details-travel-people .children-div').find('.children-information');
			
			var jsonData = new Array(), idx = 0;
			for (var i=0; i < $(adultObjs).length; i++,idx++) {
				var adult = $(adultObjs[i]);
				var mobilePhone = $(adult).find('.phone').val();
				if (mobilePhone != '' && checkMobile(mobilePhone) == false) {
					var typeDesc = $(adult).find('.adult-information-num').find('u').html();
					alert('第'+i+'位'+typeDesc+'的电话号码错误！');
					return false;
				}
								
				var certTypeObj = $(adult).find('.adult-information-card-choose').find('span');
				var cert = $(adult).find('.adult-information-card').find('.cert').val();
				var obj = {
					name: $(adult).find('.name').val(),
					type: $(adult).find('.adult-information-num').find('u').html(),
					certificate_type_id: $(certTypeObj).attr('data-id'),
					certificate_num: cert,
					tel: mobilePhone,
//					user_id: $(adult).find('.name').val(),
//					research: $(adult).find('.name').val(),
					largess: getLargessData(adult),
				}
				
				if ((obj.name != '' || obj.tel != '') && $(certTypeObj).html() == '身份证') {
					if (checkCard(obj['certificate_num']) == false) {
						return false;
					}	
				}
				
				if ($(certTypeObj).html() == '港澳证') {
					var y = $(adult).find('.adult-information-birth-year').find('span').html();
					var m = $(adult).find('.adult-information-birth-month').find('span').html();
					var d = $(adult).find('.adult-information-birth-day').find('span').html();
					var birth = y + '-' + m + '-' + d;
					obj['birthday'] = birth;
				}
				jsonData[idx] = obj;
			}
			
			for (var j=0; j < $(childObjs).length; j++,idx++) {
				var child = $(childObjs[j]);
				var mobilePhone = $(child).find('.phone').val();
				if (mobilePhone != '' && checkMobile(mobilePhone) == false) {
					var typeDesc = $(child).find('.children-information-num').find('u').html();
					alert('第'+i+'位'+typeDesc+'的电话号码错误！');
					return false;
				}
				
				var certTypeObj = $(child).find('.children-information-card-choose').find('span');
				var cert = $(child).find('.children-information-card').find('.cert').val();
				var obj = {
					name: $(child).find('.name').val(),
					type: $(child).find('.children-information-num').find('u').html(),
					certificate_type_id: $(certTypeObj).attr('data-id'),
					certificate_num: cert,
					tel: mobilePhone,
//					user_id: $(child).find('.name').val(),
//					research: $(child).find('.name').val(),
					largess: getLargessData(child),
				}
				
				if ((obj.name != '' || obj.tel != '') && $(certTypeObj).html() == '身份证') {
					if (checkCard(obj['certificate_num']) == false) {
						return false;
					}	
				}
				
				if ($(certTypeObj).html() == '港澳证') {
					var y = $(child).find('.children-information-birth-year').find('span').html();
					var m = $(child).find('.children-information-birth-month').find('span').html();
					var d = $(child).find('.children-information-birth-day').find('span').html();
					var birth = y + '-' + m + '-' + d;
					obj['birthday'] = birth;
				}
				jsonData[idx] = obj;
			}
			return jsonData;
		}
		
		// 获取订单数据
		function getOrderData() {
			var oldManHtml = $('.order-details-people-sure').find('.old-man').find('.choose-man').next().html();
			var foreignerHtml = $('.order-details-people-sure').find('.foreign-man').find('.choose-man').next().html();
			var HkMcHtml = $('.order-details-people-sure').find('.gat-man').find('.choose-man').next().html();
			var receiptType = $('.order-details-invoice').find('.order-details-invoice-choose').find('input:checked').val();
			var  manCount = $('.adult-num-man').find('span').html();
			var  womanCount = $('.adult-num-woman').find('span').html();
			var  childCount = $('.children-num').find('span').html();
			
			var memberData = getMemberData();
			if (memberData === false) {
				return false;
			}
			
			var memberCount = getOrderMemberCount();
			var jsonData = {
				op_type: 'create',
				lineid: $('.order-content').attr('data-id'),
				hdid: $('.cfrq-choose').find('span').attr('data-id'),
				userid: '<?php echo ($user["id"]); ?>',
				duid: '<?php echo ($duid); ?>',
				male: manCount == '' || manCount == null ? 0 : manCount,
				woman: womanCount == '' || womanCount == null ? 0 : womanCount,
				child: childCount == '' || childCount == null ? 0 : childCount,
				member_total_count: memberCount.total,
				types: '成人', //联系人类型
				names: $('#contact_name').val(), //联系人名称
				gendar: '男', // 联系人性别
				mob: $('#contact_phone').val(),
				members: memberData,
				oldman: oldManHtml == '没有' ? 0 : 1,
				foreigner: foreignerHtml == '没有' ? 0 : 1,
				hk_mc: HkMcHtml == '没有' ? 0 : 1,
				receipt_type: receiptType,
				book_account_type: '<?php echo ($user["account_type"]["id"]); ?>',
			}
			
			if ('<?php echo ($user["id"]); ?>' == '') {
				jsonData['mob_code'] = $('#contact_verify_code').val();
			}
			
			if (receiptType != 0) {
				var parentClass = receiptType == 1 ? '.order-details-invoice-write-enterprise' : '.order-details-invoice-write-personal';
				if (receiptType == 1) {
					jsonData['receipt_company'] = $(parentClass).find('.receipt_company').val();
					jsonData['receipt_company_no'] = $(parentClass).find('.receipt_company_no').val();
					jsonData['receipt_company_address'] = $(parentClass).find('.receipt_company_addr').val();
					jsonData['receipt_company_phone'] = $(parentClass).find('.receipt_company_tel').val();
				}
				jsonData['receipt_receiver'] = $(parentClass).find('.receipt_receiver').val();
				jsonData['receipt_receiver_phone'] = $(parentClass).find('.receipt_receiver_tel').val();
				jsonData['receipt_receiver_address'] = $(parentClass).find('.receipt_receiver_addr').val();
			}
			return jsonData;
		}		
		
		// 下单
		$('.order-details-submit').find('a').click(function(){
			var thisObj = this;
			if ($(thisObj).hasClass('btn-disabled')) {
				return false;
			}
			
			if (checkOrder() == false) {
				return false;
			}
			
			var jsonData = getOrderData();	
			if (jsonData === false) {
				return false;
			}
			
			if (parseInt(jsonData['member_total_count']) == 0) {
				$('.mark').show()
				$('#alert-modal').show();
				$('#alert-modal').find('p').html('出游人数总和不能为0');
				setTimeout(function(){
					$('.mark').hide()
					$('#alert-modal').hide();
				},3000);
				//alert('出游人数总和不能为0');
				return false;
			}
			
			$(thisObj).addClass('btn-disabled');			
			$.post('<?php echo U("line/order");?>', jsonData, function(data){
				$(thisObj).removeClass('btn-disabled');
				if (data.result.errno != 0) {
					alert(data.result.message);
				}
				if (data.jumpUrl != null && data.jumpUrl != 'undefined'){
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