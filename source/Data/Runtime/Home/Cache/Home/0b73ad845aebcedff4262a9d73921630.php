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
	<link rel="stylesheet" href="/source/Static/home/css/account_management.css">
	<!-- 验证码 -->
	<link rel="stylesheet" href="/source/Static/home/common/css/drag.css">
	<style>
		#drag { display: block; margin-top: 7px; }
		.warning-length { position: relative; display: inline-block; width: 440px; height: 4px; background-color:#e6e6e6; vertical-align: middle; }
		.warning-length span { position:absolute; top:0; left:0; height: 4px; }
	</style>
	<div id="content">
		<div class="mine">
			<?php echo ($user["show_name"]); ?>
			<p>下午好！</p>
			<?php if(empty($user['face']) === false): ?><img class="face_image" src="<?php echo ($user["face"]); ?>" alt="">
			<?php else: ?>
				<img class="face_image" src="/source/Static/home/images/account_management_img/head.jpg" alt=""><?php endif; ?>
		</div>
		<div class="account-list">
			<a class="has-checked" href="javascript:;" alt='account-safe'>账号安全</a>
			<a href="javascript:;" alt='my-information'>个人信息</a>
			<a href="javascript:;" alt='bind-authorization'>绑定授权</a>
		</div>
		<div class="account">
			<!-- 账号安全 -->
			<div class="account-safe">
				<img src="/source/Static/home/images/account_management_img/4.png" alt="">
				<h3>
					安全等级 <strong><?php echo ($safe["score"]); ?></strong>分
					<!--<span class="warnin-color"><img src="/source/Static/home/images/account_management_img/1.png" alt=""></span><span></span>-->
					<p class="warning-length">
						<span></span>
					</p>
					<?php echo ($safe["tip"]); ?>
				</h3>
				<div class="account-psd">
					<h4>帐号密码</h4>
					<p>用于保护帐号信息和登录安全</p>
					<a href="javascript:;">修改</a>
					<i></i>
				</div>
				<div class="mail-safe">
					<?php if(empty($user['email'])): ?><h4>安全邮箱<i></i><span>未绑定</span></h4>
						<p class="warning">安全邮箱将可用于登录领袖帐号和重置密码，建议立即设置</p>
						<a href="javascript:;">添加</a>
						<i></i>
					<?php else: ?>
						<h4>安全邮箱<?php echo ($user["email"]); ?></h4>
						<p>安全邮箱将可用于登录领袖帐号和重置密码，建议立即设置</p>
						<a href="javascript:;">修改</a>
						<i></i><?php endif; ?>
				</div>
				<div class="phone-safe">
					<?php if(empty($user['phone_show'])): ?><h4>安全手机<i></i><span>未绑定</span></h4>
						<p class="warning">安全邮箱将可用于登录领袖帐号和重置密码，建议立即设置</p>
						<a href="javascript:;">添加</a>
						<i></i>
					<?php else: ?>
						<h4>安全手机<?php echo ($user["phone_show"]); ?></h4>
						<p>安全手机可以用于登录领袖帐号，重置密码或其他安全验证</p>
						<a href="javascript:;">修改</a>
						<i></i><?php endif; ?>
				</div>
			</div>
			<div class="my-information">
				<img src="/source/Static/home/images/account_management_img/4.png" alt="">
				<div class="my-head-img">
					<?php if(empty($user['face']) === false): ?><img class="face_image" src="<?php echo ($user["face"]); ?>" alt="">
					<?php else: ?>
						<img class="face_image" src="/source/Static/home/images/account_management_img/head.jpg" alt=""><?php endif; ?>
					<p>修改头像</p> <input type="file" class="hidden_ctrl" name="face_file" id="face_file"/>
				</div>
				<div class="basis-information">
					<h4>基础资料<span><img src="/source/Static/home/images/account_management_img/2.png" alt="">编辑</span></h4>					
					<?php if(empty($user['name'])): ?><p>姓名：<span>未知</span></p>
					<?php else: ?>
						<p>姓名：<span><?php echo ($user["name"]); ?></span></p><?php endif; ?>					
					<?php if(empty($user['nickname'])): ?><p>昵称：<span>未知</span></p>
					<?php else: ?>
						<p>昵称：<span><?php echo ($user["nickname"]); ?></span></p><?php endif; ?>
					<p>性别：<span><?php echo get_sex($user['sex']);?></span></p>
					<p>星座：<span><?php echo get_constellation($user['constellation']);?></span></p>
					<?php if(empty($user['sex'])): ?><p>生日：<span>未知</span></p>
					<?php else: ?>
						<p>生日：<span><?php echo ($user["birthday"]); ?></span></p><?php endif; ?>		
					<p>个性签名：<span><?php echo ($user["signature"]); ?></span></p>	
				</div>
			</div>
			<!-- 绑定授权 -->
			<div class="bind-authorization">
				<img src="/source/Static/home/images/account_management_img/4.png" alt=""> 
				<h3>绑定授权<span>领袖帐号绑定的第三方帐号，可用于直接登录领袖户外网站</span></h3>
				<div class="bind-qq">
					<u></u>
					<h6>QQ</h6>
					<?php if(empty($user['openid'])): ?><p><i></i>未绑定</p>
						<a href="<?php echo U('thirdLogin/login');?>/type/qq/" target="_blank">添加绑定</a>
					<?php else: ?>
						<p>已绑定</p><?php endif; ?>
				</div>
				<div class="bind-wx">
					<u></u>
					<h6>微信</h6>
					<?php if(empty($user['unionid'])): ?><p><i></i>未绑定</p>
						<a href="<?php echo U('thirdLogin/login');?>/type/weixin/" target="_blank">添加绑定</a>
					<?php else: ?>
						<p>已绑定</p><?php endif; ?>
					
				</div>
			</div>
		</div>
	</div>
	<!-- 修改密码弹框 -->
	<div class="mark"></div>
	<div class="revise-psd-content">
		<h5>修改密码<img src="/source/Static/home/images/account_management_img/close.png" alt="关闭"></h5>
		<div class="revise-psd">
			<h5>原密码</h5>
			<input id="old_password" type="password" placeholder="输入原密码">
			<h5>新密码</h5>
			<input id="new_password" type="password" placeholder="输入新密码">
			<input id="password_confirm" type="password" placeholder="重复新密码">
			<h5>验证码</h5>
			<p><span id="drag"></span></p>
			<p><a class="sure-psd" href="javascript:;">确定</a><a class="cancle-psd" href="javascript:;">取消</a></p>
		</div>
	</div>
	<!-- 绑定邮箱 -->
	<div class="bind-mail-content">
		<h5>领袖户外安全验证<img src="/source/Static/home/images/account_management_img/close.png" alt="关闭"></h5>
		<div class="bind-mail">
			<h5>为了保护帐号安全，需要验证邮箱有效性</h5>
			<input class="email_text" type="text" placeholder="输入邮箱">
			<input class="write-mail-code" type="text" placeholder="输入验证码">
			<a class="send-mail-code" href="javascript:;">发送验证码</a>
			<p><a class="sure-mail" href="javascript:;">确定</a><a class="cancle-mail" href="javascript:;">取消</a></p>
		</div>
	</div>
	<!-- 绑定手机 -->
	<div class="bind-phone-content">
		<h5>领袖户外安全验证<img src="/source/Static/home/images/account_management_img/close.png" alt="关闭"></h5>
		<div class="bind-phone">
			<h5>为了保护帐号安全，需要验证手机有效性</h5>
			<input class="phone_text" type="text" placeholder="输入手机号">
			<input class="write-phone-code" type="text" placeholder="输入验证码">
			<a class="send-phone-code" href="javascript:;">发送验证码</a>
			<p><a class="sure-phone" href="javascript:;">确定</a><a class="cancle-phone" href="javascript:;">取消</a></p>
		</div>
	</div>
	<!-- 编辑个人信息 -->
	<div class="write-personal-information">
		<h5>基础资料<img src="/source/Static/home/images/account_management_img/close.png" alt="关闭"></h5>
		<div class="personal-information">
			<p><strong>姓名：</strong><input id="name" type="text" placeholder="输入您的姓名" value="<?php echo ($user["name"]); ?>"></p>
			<p><strong>昵称：</strong><input id="nickname" type="text" placeholder="输入您的昵称" value="<?php echo ($user["nickname"]); ?>"></p>
			<div class="birth">
				<?php $birth = explode('-',$user['birthday']); ?>
				<strong>生日：</strong><div class="birth-year">
					<span><?php echo ($birth[0]); ?></span>
					<i></i>
					<ul></ul>
				</div>
				<div class="birth-month">
					<span><?php echo ($birth[1]); ?></span>
					<i></i>
					<ul></ul>
				</div>
				<div class="birth-day">
					<span><?php echo ($birth[2]); ?></span>
					<i></i>
					<ul></ul>
				</div>
			</div>
			<?php $boyClass = $user['sex'] == '1' ? 'sex-checked' : ''; $girlClass = $user['sex'] == '2' ? 'sex-checked' : ''; ?>
			<p class="sex"><strong>性别：</strong><span class="<?php echo ($boyClass); ?> boy"><i></i><b>男</b></span><span class="<?php echo ($girlClass); ?> girl"><i></i><b>女</b></span></p>
			
			<div class="constellation">
				
				<strong>星座：</strong></strong><div class="choose-constellation">
					<span class="constellation_value"><?php echo get_constellation($user['constellation']);?></span>
					<img src="/source/Static/home/images/account_management_img/3.png" alt="">
					<ul>
						<li>白羊座</li>
						<li>金牛座</li>
						<li>双子座</li>
						<li>巨蟹座</li>
						<li>狮子座</li>
						<li>处女座</li>
						<li>天秤座</li>
						<li>天蝎座</li>
						<li>射手座</li>
						<li>摩羯座</li>
						<li>水瓶座</li>
						<li>双鱼座</li>
					</ul>
				</div>
			</div>
			<div class="id-card">
				<strong>证件类型：</strong><div class="id-type">
					<?php $myCertType = json_decode($user['cert_type'], ture); ?>
					<span><?php echo ($myCertType["type_desc"]); ?></span>
					<img src="/source/Static/home/images/account_management_img/3.png" alt="">
					<ul>
						<?php if(is_array($certs)): $i = 0; $__LIST__ = $certs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cert): $mod = ($i % 2 );++$i;?><li data-id="<?php echo ($cert["id"]); ?>"><?php echo ($cert["type_desc"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<input id="card_id" type="text" placeholder="请输入您的证件号码" value="<?php echo ($user["cert"]); ?>">
			</div>
			
			<p><strong>个性签名：</strong><input id="signature" maxlength="20" type="text" id="signature" placeholder="输入您的个性签名" value="<?php echo ($user["signature"]); ?>"></p>
			<a class="sure-my-information" href="javascript:;">确定</a><a class="cancle-my-information" href="javascript:;">取消</a>
		</div>
	</div>
	
	<!-- 个人信息 -->
	<div id="div_upload_face" class="modal-face-image"></div>
	<div class="face-mark"></div>
		
	<div class="mark"></div>
	<div id="alert-modal">
		
		<div class="alert-modal-top">
			<a href="javascript:;"><img src="/source/Static/home/common/images/video_close.png"/></a>
		</div>
		<div class="alert-modal-content">
			<p></p>
		</div>
		
	</div>
	
	<!-- 生日 -->
	<script src="/source/Static/home/js/birthday.js"></script>
	<!-- 验证码 -->
	<script src="/source/Static/home/js/drag.js"></script>
	<!--美图秀秀-->
	<script src="http://open.web.meitu.com/sources/xiuxiu.js" type="text/javascript"></script>
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
		
		//根据分值判断进度条
		//获取分值
		var warnNum = parseInt($('.account-safe h3 strong').text());
		
		$('.warning-length span').width(warnNum + '%');
		if(warnNum >= 0 && warnNum <= 25){
			$('.warning-length span').removeClass();
			$('.warning-length span').addClass('warn01');
		}else if (warnNum >= 26 && warnNum <= 50){
			$('.warning-length span').removeClass();
			$('.warning-length span').addClass('warn02');
		}else if (warnNum >= 51 && warnNum <= 75){
			$('.warning-length span').removeClass();
			$('.warning-length span').addClass('warn03');
		}else if (warnNum >= 76 && warnNum <= 100){
			$('.warning-length span').removeClass();
			$('.warning-length span').addClass('warn04');
		}
				
		$('.my-head-img').find('p').click(function(){
			$('#xiuxiuEditor').show();
			$('.face-mark').show();
//			location.href = '<?php echo U("user/face");?>';
			/*第1个参数是加载编辑器div容器，第2个参数是编辑器类型，第3个参数是div容器宽，第4个参数是div容器高*/
			xiuxiu.embedSWF("div_upload_face",5,"100%","100%");
			//修改为您自己的图片上传接口
			xiuxiu.setUploadURL("<?php echo ($upload_url); ?>");
			xiuxiu.setUploadType(2);
			xiuxiu.setUploadDataFieldName("face_file");
			xiuxiu.onInit = function ()
			{
				xiuxiu.loadPhoto("http://open.web.meitu.com/sources/images/1.jpg");//修改为要处理的图片url
			}
			xiuxiu.onUploadResponse = function (ds)
			{
				var data = $.parseJSON(ds);
				if (data.result.errno == 0) {
					if (data.face_image != null && data.face_image != 'undefined') {
						$('.face_image').attr('src', data.face_image);						
					}
					$('.face-mark').hide();
					$('#xiuxiuEditor').hide();
				} else {
					alert(data.result.message);
				}				
			}
		});
		
		$('.face-mark').click(function(){
			$(this).hide();
			$('#xiuxiuEditor').hide();
		});
	
		//鼠标离开，关闭下拉框
		$('.choose-constellation').mouseleave(function(){
			$(this).children('ul').hide();
		});
		$('.choose-constellation').mouseleave(function(){
			$(this).children('ul').hide();
		});
		$('.id-type').mouseleave(function(){
			$(this).children('ul').hide();
		});
		$('.id-type').mouseleave(function(){
			$(this).children('ul').hide();
		});
	
		//验证码
		$('#drag').drag();
		//生日
		$('.personal-information').birthday('.birth-year', '.birth-month' , '.birth-day' , '.birth' , 100);
		//选择下拉框
		function chooseDown( f ) {
			$( '.' + f ).click( function () {
				$(this).children('ul').show();
			} );
			$( '.' + f + ' ul li').click( function (event) {
				event.stopPropagation();
				$(this).parents( '.' + f ).children('span').html($(this).html());
				$(this).parent('ul').hide();
			} );
		};
		chooseDown('birth-year');
		chooseDown('birth-month');
		chooseDown('birth-day');
		chooseDown('id-type');
		chooseDown('choose-constellation');
		//切换
		function tabChange(a,b){
			$(a).click( function () {
				$(this).parents(b).find('a').removeClass('has-checked');
				$(this).addClass('has-checked');
				var Alt = $(this).attr('alt');
				$('.' + Alt).siblings().hide();
				$('.' + Alt).show();
			} );
		}
		tabChange('.account-list a','.account-list');


		function showModel(c,d) {
			$(c).click( function () {
				$('.mark').show();
				$(d).show();
			} );
		};
		showModel('.account-psd a','.revise-psd-content');
		showModel('.mail-safe','.bind-mail-content');
		showModel('.phone-safe','.bind-phone-content');
		
		showModel('.basis-information > h4 span','.write-personal-information');

		function hideAndClear( h,i ) {
			$(h).click( function () {
				$('.mark').hide();
				$(i).hide();
			});
		};
		hideAndClear('.cancle-psd','.revise-psd-content');
		hideAndClear('.revise-psd-content > h5 img','.revise-psd-content');
		hideAndClear('.cancle-mail','.bind-mail-content');
		hideAndClear('.bind-mail-content h5 img','.bind-mail-content');
		hideAndClear('.cancle-phone','.bind-phone-content');
		hideAndClear('.bind-phone-content h5 img','.bind-phone-content');
		hideAndClear('.cancle-my-information','.write-personal-information');
		hideAndClear('.write-personal-information h5 img','.write-personal-information');
		
		//性别选择
		$('.sex span').click( function () {
			$(this).siblings().removeClass('sex-checked');
			$(this).addClass('sex-checked');
		} );
	</script>
	
	<script type="text/javascript">
		//modal关闭
		$('.alert-modal-top a').click(function(){
			$('.mark').hide();
			$('#alert-modal').hide();
		});
		// 修改密码
		$('.sure-psd').click(function(data){
			var newPassword = $('#new_password').val();
			var confirmPassword = $('#password_confirm').val();
			if (newPassword != confirmPassword) {
				alert('两次输入的密码不一致');
				return false;
			}
			//滑动验证码失败
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
			
			var userId = '<?php echo ($user["id"]); ?>';
			var jsonData = {
				type: 'modify_password',
				id: userId,
				password: $('#old_password').val(),
				new_password: newPassword,
			};
			$.post('<?php echo U("user/manager");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					location.href = '<?php echo U("user/manager");?>';
				} else {
					alert(data.result.message);
					if (data.jumpUrl != null) {
						location.href = data.jumpUrl;
					}
				}				
			});
		});
		
		// 发送邮箱验证码
		$('.send-mail-code').click(function(data){
			var email = $('.email_text').val();
			_ajaxEmail(email, '', 0);
		});
		
		// 修改邮箱
		$('.sure-mail').click(function(data){
			var email = $('.email_text').val();
			var code = $('.write-mail-code').val();
			_ajaxEmail(email, code, 1);
		});
		
		// 邮箱数据发送
		function _ajaxEmail(sEmail, sCode, nCheck) {
			if (sEmail == '') {
				$('.mark').show()
				$('#alert-modal').show();
				$('#alert-modal').find('p').html('邮件不能为空');
				setTimeout(function(){
					$('.mark').hide()
					$('#alert-modal').hide();
				},3000);
				//alert('邮件不能为空');
				return false;
			}
			if (nCheck == 1 && sCode == '') {
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
			var userId = '<?php echo ($user["id"]); ?>';
			var jsonData = {
				type: 'modify_email',
				user_id: userId,
				email: sEmail,
				code: sCode,
				check: nCheck,
			};
			$.post('<?php echo U("user/manager");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					if (nCheck == 0) {
						if (typeof(data.ds) != 'undefined') {
							$('.mark').show()
							$('#alert-modal').show();
							$('#alert-modal').find('p').html(data.ds.code);
							setTimeout(function(){
								$('.mark').hide()
								$('#alert-modal').hide();
							},3000);
							//alert(data.ds.code);
						}
					} else {
						location.href = '<?php echo U("user/manager");?>';	
					}
				} else {
					alert(data.result.message);
				}				
			});
		}
		
		// 发送电话验证码
		$('.send-phone-code').click(function(data){
			var phone = $('.phone_text').val();
			_ajaxPhone(phone, '', 0);
		});
		
		// 修改电话
		$('.sure-phone').click(function(data){
			var phone = $('.phone_text').val();
			var code = $('.write-phone-code').val();
			_ajaxPhone(phone, code, 1);
		});
		
		// 电话数据发送
		function _ajaxPhone(sPhone, sCode, nCheck) {
			if (sPhone == '') {
				$('.mark').show()
				$('#alert-modal').show();
				$('#alert-modal').find('p').html('电话不能为空');
				setTimeout(function(){
					$('.mark').hide()
					$('#alert-modal').hide();
				},3000);
				//alert('电话不能为空');
				return false;
			}
			if (nCheck == 1 && sCode == '') {
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
			var userId = '<?php echo ($user["id"]); ?>';
			var jsonData = {
				type: 'modify_phone',
				user_id: userId,
				phone: sPhone,
				code: sCode,
				check: nCheck,
			};
			$.post('<?php echo U("user/manager");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					if (nCheck == 0) {
						if (typeof(data.ds) != 'undefined') {
							$('.mark').show()
							$('#alert-modal').show();
							$('#alert-modal').find('p').html(data.ds.code);
							setTimeout(function(){
								$('.mark').hide()
								$('#alert-modal').hide();
							},3000);
							//alert(data.ds.code);
						}
					} else {
						location.href = '<?php echo U("user/manager");?>';
					}
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
		
		// 获取证件信息
		function getCertType() {
			var sel_desc = $('.id-card').find('span').html();
			var lisObj = $('.id-card').find('li');
			for (var i = 0; i < $(lisObj).length; i++) {
				var id = $(lisObj[i]).attr('data-id');
				var desc = $(lisObj[i]).html();
				if (desc == sel_desc) {
					return '{"id":"'+id+'","type_desc":"'+desc+'"}'
				}
			}
			return '';
		}
						
		// 修改基本信息
		$('.sure-my-information').click(function(data){
			var y = $('.birth-year').find('span').html();
			var m = $('.birth-month').find('span').html();
			var d = $('.birth-day').find('span').html();
			var birth = y + '-' + m + '-' + d;
			
			var userId = '<?php echo ($user["id"]); ?>';
			var jsonData = {
				type: 'modify_base',
				name: $('#name').val(),
				nickname: $('#nickname').val(),
				birthday: birth,
				sex: getSex($('.write-personal-information').find('.sex-checked b').html()),	
				constellation: getConstellation($('.constellation_value').html()),			
				cert_type: getCertType(),
				cert: $('#card_id').val(),
				signature: $('#signture').val(),
			};
			
			$.post('<?php echo U("user/manager");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					location.href = '<?php echo U("user/manager");?>';
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