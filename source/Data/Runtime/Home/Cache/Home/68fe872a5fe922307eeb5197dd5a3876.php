<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>领袖户外</title>
	<!-- css Reset -->
	<link rel="stylesheet" href="/source/Static/home/common/css/cssreset.css">
	<!-- 轮播样式 -->
	<link rel="stylesheet" href="/source/Static/home/common/css/slide.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="/source/Static/home/common/css/common.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="/source/Static/common/css/common.css">
	<!-- echo -->
	<script src="/source/Static/home/common/js/echo.min.js"></script>
	<!-- 引用jq -->
	<script src="/source/Static/home/common/js/jquery-1.11.3.min.js"></script>
	<script>
		//echo
		echo.init({
		    offset: 0, //离可视区域多少像素的图片可以被加载
		    throttle: 0 //图片延迟多少毫秒加载
		});
	</script>
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
				window.location.href = window.location.href.replace(/home/g,'phone');
				
			}else{
				
			}
		}
		browserRedirect();
	
	</script>
	
	
</head>
<body>
	<header>
		<div class="nav01">
			<div class="nav-top">
				<div class="nav-top-left">
					<?php if(is_array($stations)): $i = 0; $__LIST__ = $stations;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$station): $mod = ($i % 2 );++$i;?><a href="javascript:;" target="_blank"><?php echo ($station["name"]); ?> |<?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
				<div class="nav-top-right">
					<img src="/source/Static/home/common/images/login_header.png" alt=""></a>
					<?php if(empty($user) == true): ?><a href="<?php echo U('user/login');?>">登录</a> |
						<a href="<?php echo U('user/register');?>">注册</a>
					<?php else: ?>
						你好<a href="<?php echo U('user/info');?>" style="color: blue;"><?php echo ($user["show_name"]); ?></a>欢迎光临，
						<a href="<?php echo U('user/exit');?>" style="color: blue;">安全退出</a>！<?php endif; ?>
					<a href="<?php echo U('line/order');?>/type/center" target="_blank"> | 我的订单</a>
					<a href="javascript:;" target="_blank"> | 加入收藏</a>
					<a href="<?php echo U('service/center');?>" target="_blank"> | 服务中心</a>
					<img src="/source/Static/home/common/images/tel_header.png" alt="联系电话">
					<span><?php echo ($set["cs_tel"]); ?></span>
				</div>
			</div>
		</div>
		<div class="nav02">
			<div class="nav-list">
				<a class="go-welcome" href="<?php echo U('index/welcome');?>"><img src="/source/Static/home/common/images/logo_header.png" alt="领袖户外"></a>
				<!--logo图片加链接会导致样式混乱-->
				<!--<img src="/source/Static/home/common/images/logo_header.png" alt="领袖户外">-->
				<ul>
					<?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; switch($menu['item_desc']) { case '首页': $href=U('index/welcome'); break; case '私人订制': { $href="http://kllife.com/zt/dzyzt/"; $target = '_blank'; }break; case '论坛': { $href = "http://shequ.kllife.com"; $target = '_blank'; }break; default: { $jumpToLineList = true; $href=U('line/list'); } break; } ?>
						<li class="nav-list-top">
							<?php $nav = $href; if (!empty($jumpToLineList)) { $nav = $href.'/m0/'.$menu['id']; } ?>
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
				<div class="search-header">
					<img src="/source/Static/home/common/images/search_header.png" alt="">
					<input type="text" placeholder="特惠线路...">
					<a href="javascript:;">搜索</a>
				</div>
				<script type="text/javascript">
					$('.search-header').find('a').click(function(){
						location.href = '<?php echo U("line/list");?>/cds/title|'+$(this).prev().val();						
					});
				</script>
			</div>
		</div>		
	</header>	
<!-- 私有样式 -->
<link rel="stylesheet" href="/source/Static/home/css/special.css">
<!--主要内容-->
	
<div class="zt-top">
	<img src="/source/Static/home/images/special_img/topimg.jpg" />
</div>
	
<div id="content">
	
	<div class="zt-main">
		
		<h3>追求完美旅行的工匠 推敲您每厘米触及的景色</h3>.
		
		<p class="zt-slogan">2016年，40人次，47天，2万公里，超20万元，只为寻找陌生和解构熟悉。经历沙尘暴、爆胎、大雪、车震......只为给您打磨最美的旅行。</p>
		
		<ul>
			
			<li class="clear-margin">
			
				<a href="javascript:;">
					
					<img src="/source/Static/home/images/special_img/xinjiang_caixian.jpg" alt="">
					
					<div class="zt-content">
					
						<div class="zt-img">
							
							<img src="/source/Static/home/images/special_img/xinjiang_text.png" alt="">
						</div>
						
						<div class="zt-text">

	                        <div class="zt-text-introduce">

	                            <p class="zt-text-title">新疆</p>

	                            <p>为了寻找遗落在新疆最后一公里的美，<span class="cool-color">3</span>男<span class="cool-color">1</span>女4位旅行摄影师，从长安出发沿着古丝绸之路穿越<span class="cool-color">5</span>省直达西域，<span class="cool-color">18</span>个日月交替，<span class="cool-color">11500</span>公里地奔腾中，有惊无险地在高速公路上爆过一次胎。他们经历了一场辽阔而奇幻的公路电影般的旅程，为我们带回了最新最好玩的新疆旅行线路。</p>

	                        </div>

	                    </div>
					
					</div>
					
				</a>
				
			</li>
			<li>
			
				<a href="javascript:;">
					
					<img src="/source/Static/home/images/special_img/bashang_caixian.png" alt="">
					
					<div class="zt-content">
					
						<div class="zt-img">
							
							<img src="/source/Static/home/images/special_img/bashang_text.png" alt="">
						</div>
						
						<div class="zt-text">

	                        <div class="zt-text-introduce">

	                            <p class="zt-text-title">坝上</p>

                            	<p><span class="cool-color">1</span>男<span class="cool-color">1</span>女<span class="cool-color">1</span>狗，生活家、美食家、摄影家、旅行家重走坝上草原。开辟新玩法，射箭、滑沙、篝火晚会、自助野餐，一起<span class="cool-color">玩嗨草原</span>；考察亲子路线，故事会、运动会、喂羊羔、抚摸梅花鹿，一起亲近草原；深入草原腹地，为摄影师寻找夏秋冬三季不同的私藏摄影点。</p>

	                        </div>

	                    </div>
					
					</div>
					
				</a>
				
			</li>
			<li>
			
				<a href="javascript:;">
					
					<img src="/source/Static/home/images/special_img/chuanxi_caixian.png" alt="">
					
					<div class="zt-content">
					
						<div class="zt-img">
							
							<img src="/source/Static/home/images/special_img/chuanxi_text.png" alt="">
						</div>
						
						<div class="zt-text">

	                        <div class="zt-text-introduce">

	                            <p class="zt-text-title">川西</p>

                            	<p>在横断山脉中隐藏了中国最小众的旅游目的地，在川西高原上有中国乃至世界上最殊胜的宗教圣地。为了这场信仰之旅，我们反复奔波<span class="cool-color">5000</span>公里，在一段<span class="cool-color">500</span>多公里的<span class="cool-color">砾石路</span>上越野车被震坏了三根减震，差点翻车，方向盘颠到旷量达30°。但我们找到了一条信仰觉醒、返璞归真的旅行线路。</p>

	                        </div>

	                    </div>
					
					</div>
					
				</a>
				
			</li>
			<li>
			
				<a href="javascript:;">
					
					<img src="/source/Static/home/images/special_img/xibei_caixian.png" alt="">
					
					<div class="zt-content">
					
						<div class="zt-img">
							
							<img src="/source/Static/home/images/special_img/xibei_text.png" alt="">
						</div>
						
						<div class="zt-text">

	                        <div class="zt-text-introduce">

	                            <p class="zt-text-title">西北</p>

                            <p>我们在甘肃、青海深耕<span class="cool-color">十余年</span>，为了精益求精，一支由领队和同行组成的<span class="cool-color">30</span>人的踩线团队再次出发。我们对美有极致的追求，我们对细节有病态的苛求，我们醉心于把客户服务做到最佳，青海、甘南、丝绸之路线路不断升级，线路玩法不断翻新、增多，只为最美的季节带你去最美的地方。</p>

	                        </div>

	                    </div>
					
					</div>
					
				</a>
				
			</li>
			
		</ul>
	</div>
	
	<div class="zt-list main">
		
		<ul class="tab-list">
			
			<li><a href="javascript:;" title="zt-tuijian" class="g">推荐线路</a></li>
			<li><a href="javascript:;" title="zt-shendu" class="">深度游</a></li>
			<li><a href="javascript:;" title="zt-sheying" class="">摄影游</a></li>
			
		</ul>
		
		<div class="zt-sublist" id="zt-tuijian">
			
			<div class="zt-sublist-content">
				
				<div class="zt-sublist-img">
					<img src="/source/Static/home/images/special_img/zt_sublist01.jpg"/>
				</div>
				<div class="zt-sublist-describe">
					<h5><a href="javascript:;" target="_blank">【坝上冬摄】12-2月 冰雪童话：北京—内蒙坝上雪原—激情摄影5日创作团（安排坝上整3天摄影创作）第9期</a></h5>
					<p class="zt-sublist-line">线路简介：<span>这是一条精心设计的坝上雪原冬季摄影路线，冬天的坝上，银装素裹、雾凇树挂、牧村篱笆、移动的骏马驼队。我们将全程越野车深入坝上最经典的雪景摄影点拍摄。</span></p>
					<p>价格：<strong>成人：￥<em>2280</em></strong></p>
					<p>活动时间：
						<select>
							<option value ="" disabled="">第1期：2016.12.01-----2016.12.05</option>
							<option value ="">第2期：2016.12.01-----2016.12.05</option>
							<option value="">第3期：2016.12.01-----2016.12.05</option>
							<option value="">第4期：2016.12.01-----2016.12.05</option>
						</select>
					</p>
					<p>集合地点：<span>北京</span></p>
					<p>报名人数：<span>24人</span></p>
					<p>目的地：<span>内蒙古</span></p>
				</div>

			</div>
			
			<div class="zt-sublist-content">
				
				<div class="zt-sublist-img">
					<img src="/source/Static/home/images/special_img/zt_sublist01.jpg"/>
				</div>
				<div class="zt-sublist-describe">
					<h5><a href="javascript:;" target="_blank">【坝上冬摄】12-2月 冰雪童话：北京—内蒙坝上雪原—激情摄影5日创作团（安排坝上整3天摄影创作）第9期</a></h5>
					<p class="zt-sublist-line">线路简介：<span>这是一条精心设计的坝上雪原冬季摄影路线，冬天的坝上，银装素裹、雾凇树挂、牧村篱笆、移动的骏马驼队。我们将全程越野车深入坝上最经典的雪景摄影点拍摄。</span></p>
					<p>价格：<strong>成人：￥<em>2280</em></strong></p>
					<p>活动时间：
						<select>
							<option value ="" disabled="">第1期：2016.12.01-----2016.12.05</option>
							<option value ="">第2期：2016.12.01-----2016.12.05</option>
							<option value="">第3期：2016.12.01-----2016.12.05</option>
							<option value="">第4期：2016.12.01-----2016.12.05</option>
						</select>
					</p>
					<p>集合地点：<span>北京</span></p>
					<p>报名人数：<span>24人</span></p>
					<p>目的地：<span>内蒙古</span></p>
				</div>
				
			</div>
			
		</div>
		
		<!--深度-->
		<div class="zt-sublist" id="zt-shendu">
			
			<div class="zt-sublist-content">
				
				<div class="zt-sublist-img">
					<img src="/source/Static/home/images/special_img/zt_sublist01.jpg"/>
				</div>
				<div class="zt-sublist-describe">
					<h5><a href="javascript:;" target="_blank">【坝上冬摄】12-2月 冰雪童话：北京—内蒙坝上雪原—激情摄影5日创作团（安排坝上整3天摄影创作）第9期</a></h5>
					<p class="zt-sublist-line">线路简介：<span>这是一条精心设计的坝上雪原冬季摄影路线，冬天的坝上，银装素裹、雾凇树挂、牧村篱笆、移动的骏马驼队。我们将全程越野车深入坝上最经典的雪景摄影点拍摄。</span></p>
					<p>价格：<strong>成人：￥<em>2280</em></strong></p>
					<p>活动时间：
						<select>
							<option value ="" disabled="">第1期：2016.12.01-----2016.12.05</option>
							<option value ="">第2期：2016.12.01-----2016.12.05</option>
							<option value="">第3期：2016.12.01-----2016.12.05</option>
							<option value="">第4期：2016.12.01-----2016.12.05</option>
						</select>
					</p>
					<p>集合地点：<span>北京</span></p>
					<p>报名人数：<span>24人</span></p>
					<p>目的地：<span>内蒙古</span></p>
				</div>

			</div>
			
			<div class="zt-sublist-content">
				
				<div class="zt-sublist-img">
					<img src="/source/Static/home/images/special_img/zt_sublist01.jpg"/>
				</div>
				<div class="zt-sublist-describe">
					<h5><a href="javascript:;" target="_blank">【坝上冬摄】12-2月 冰雪童话：北京—内蒙坝上雪原—激情摄影5日创作团（安排坝上整3天摄影创作）第9期</a></h5>
					<p class="zt-sublist-line">线路简介：<span>这是一条精心设计的坝上雪原冬季摄影路线，冬天的坝上，银装素裹、雾凇树挂、牧村篱笆、移动的骏马驼队。我们将全程越野车深入坝上最经典的雪景摄影点拍摄。</span></p>
					<p>价格：<strong>成人：￥<em>2280</em></strong></p>
					<p>活动时间：
						<select>
							<option value ="" disabled="">第1期：2016.12.01-----2016.12.05</option>
							<option value ="">第2期：2016.12.01-----2016.12.05</option>
							<option value="">第3期：2016.12.01-----2016.12.05</option>
							<option value="">第4期：2016.12.01-----2016.12.05</option>
						</select>
					</p>
					<p>集合地点：<span>北京</span></p>
					<p>报名人数：<span>24人</span></p>
					<p>目的地：<span>内蒙古</span></p>
				</div>
				
			</div>
			
		</div>
		
		<!--摄影-->
		
		<div class="zt-sublist" id="zt-sheying">
			
			<div class="zt-sublist-content">
				
				<div class="zt-sublist-img">
					<img src="/source/Static/home/images/special_img/zt_sublist01.jpg"/>
				</div>
				<div class="zt-sublist-describe">
					<h5><a href="javascript:;" target="_blank">【坝上冬摄】12-2月 冰雪童话：北京—内蒙坝上雪原—激情摄影5日创作团（安排坝上整3天摄影创作）第9期</a></h5>
					<p class="zt-sublist-line">线路简介：<span>这是一条精心设计的坝上雪原冬季摄影路线，冬天的坝上，银装素裹、雾凇树挂、牧村篱笆、移动的骏马驼队。我们将全程越野车深入坝上最经典的雪景摄影点拍摄。</span></p>
					<p>价格：<strong>成人：￥<em>2280</em></strong></p>
					<p>活动时间：
						<select>
							<option value ="" disabled="">第1期：2016.12.01-----2016.12.05</option>
							<option value ="">第2期：2016.12.01-----2016.12.05</option>
							<option value="">第3期：2016.12.01-----2016.12.05</option>
							<option value="">第4期：2016.12.01-----2016.12.05</option>
						</select>
					</p>
					<p>集合地点：<span>北京</span></p>
					<p>报名人数：<span>24人</span></p>
					<p>目的地：<span>内蒙古</span></p>
				</div>

			</div>
			
			<div class="zt-sublist-content">
				
				<div class="zt-sublist-img">
					<img src="/source/Static/home/images/special_img/zt_sublist01.jpg"/>
				</div>
				<div class="zt-sublist-describe">
					<h5><a href="javascript:;" target="_blank">【坝上冬摄】12-2月 冰雪童话：北京—内蒙坝上雪原—激情摄影5日创作团（安排坝上整3天摄影创作）第9期</a></h5>
					<p class="zt-sublist-line">线路简介：<span>这是一条精心设计的坝上雪原冬季摄影路线，冬天的坝上，银装素裹、雾凇树挂、牧村篱笆、移动的骏马驼队。我们将全程越野车深入坝上最经典的雪景摄影点拍摄。</span></p>
					<p>价格：<strong>成人：￥<em>2280</em></strong></p>
					<p>活动时间：
						<select>
							<option value ="" disabled="">第1期：2016.12.01-----2016.12.05</option>
							<option value ="">第2期：2016.12.01-----2016.12.05</option>
							<option value="">第3期：2016.12.01-----2016.12.05</option>
							<option value="">第4期：2016.12.01-----2016.12.05</option>
						</select>
					</p>
					<p>集合地点：<span>北京</span></p>
					<p>报名人数：<span>24人</span></p>
					<p>目的地：<span>内蒙古</span></p>
				</div>
				
			</div>
			
		</div>
		
	</div>
	
	<!--精彩游记-->
	
	<div class="wonderful-travels">
		
		<h3>精彩游记</h3>
		
		<ul>
			
			<li>
				<a href="javascript:;">
					<img src="/source/Static/home/images/special_img/zzz.jpg"/>
					<div class="wonderful-describe">
						<p>[08.19-08.24坝上休闲之旅]这个夏天，你应该在这里</p>
					</div>
				</a>
			</li>
			
			<li>
				<a href="javascript:;">
					<img src="/source/Static/home/images/special_img/zzz.jpg"/>
					<div class="wonderful-describe">
						<p>[08.19-08.24坝上休闲之旅]这个夏天，你应该在这里</p>
					</div>
				</a>
			</li>
			
			<li>
				<a href="javascript:;">
					<img src="/source/Static/home/images/special_img/zzz.jpg"/>
					<div class="wonderful-describe">
						<p>[08.19-08.24坝上休闲之旅]这个夏天，你应该在这里</p>
					</div>
				</a>
			</li>
			
			<li>
				<a href="javascript:;">
					<img src="/source/Static/home/images/special_img/zzz.jpg"/>
					<div class="wonderful-describe">
						<p>[08.19-08.24坝上休闲之旅]这个夏天，你应该在这里</p>
					</div>
				</a>
			</li>
			
			<li>
				<a href="javascript:;">
					<img src="/source/Static/home/images/special_img/zzz.jpg"/>
					<div class="wonderful-describe">
						<p>[08.19-08.24坝上休闲之旅]这个夏天，你应该在这里</p>
					</div>
				</a>
			</li>
			
			<li>
				<a href="javascript:;">
					<img src="/source/Static/home/images/special_img/zzz.jpg"/>
					<div class="wonderful-describe">
						<p>[08.19-08.24坝上休闲之旅]这个夏天，你应该在这里</p>
					</div>
				</a>
			</li>
			
			<li>
				<a href="javascript:;">
					<img src="/source/Static/home/images/special_img/zzz.jpg"/>
					<div class="wonderful-describe">
						<p>[08.19-08.24坝上休闲之旅]这个夏天，你应该在这里</p>
					</div>
				</a>
			</li>
			
			<li>
				<a href="javascript:;">
					<img src="/source/Static/home/images/special_img/zzz.jpg"/>
					<div class="wonderful-describe">
						<p>[08.19-08.24坝上休闲之旅]这个夏天，你应该在这里</p>
					</div>
				</a>
			</li>
			
		</ul>
		
	</div>
	
</div>

<!--私人定制-->

<div class="private-custom">
	<h2>上述产品不符合您的需求？</h2>
	<p>欢迎填写下表提交，即刻联系领袖户外的私人旅行顾问</p>
	<p>我们将为您和您的亲友量身定制专属行程</p>
	<a href="http://kllife.com/zt/dzyzt/" target="_blank">私人定制</a>
</div>

<!-- 精选热卖 -->
	<div class="bg-white">
		<div class="hot-sale main">                                     
			<h2>精选热卖</h2>
			<p><a href="javascript:;">更多</a></p>
			<ul class="tab-list">
				<?php if(is_array($set["hot_line_tab"])): $i = 0; $__LIST__ = $set["hot_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><li><a href="javascript:;" class="g cur" title="<?php echo ($tab["type_key"]); ?>" data-id="<?php echo ($tab["id"]); ?>"><?php echo ($tab["type_desc"]); ?></a></li>
					<?php else: ?>
						<li><a href="javascript:;" title="<?php echo ($tab["type_key"]); ?>" data-id="<?php echo ($tab["id"]); ?>"><?php echo ($tab["type_desc"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				<div class="move-bg"></div>
			</ul>			
			<?php if(is_array($set["hot_line_tab"])): $i = 0; $__LIST__ = $set["hot_line_tab"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i;?><div class="hot-sale-product" id="<?php echo ($tab["type_key"]); ?>">
					<div class="hot-sale-product-small">
						<?php $k0 = $tab['type_key'].'0'; ?>
						<a href="<?php echo U('line/info');?>/id/<?php echo ($set[$k0]['id']); ?>">
							<img src="<?php echo ($set[$k0]['img']); ?>" alt="">
							<!--<img class="hot-sale-img" src="/source/Static/home/images/index_img/hot01_01.png" alt="">-->
							<div class="aaa" data-id="<?php echo ($set[$k0]['id']); ?>">
								<h4><?php echo ($set[$k0]['title']); ?></h4>
								<span><?php echo ($set[$k0]['send_word']); ?></span>
								<p>￥<em><?php echo ($set[$k0]['cut_price']); ?></em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
						<?php $k1 = $tab['type_key'].'1'; ?>
						<a href="<?php echo U('line/info');?>/id/<?php echo ($set[$k1]['id']); ?>">
							<img src="<?php echo ($set[$k1]['img']); ?>" alt="">
							<!--<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">-->
							<div data-id="<?php echo ($set[$k1]['id']); ?>">
								<h4><?php echo ($set[$k1]['title']); ?></h4>
								<span><?php echo ($set[$k1]['send_word']); ?></span>
								<p>￥<em><?php echo ($set[$k1]['cut_price']); ?></em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
					</div>
					<?php $k2 = $tab['type_key'].'2'; ?>
					<a href="<?php echo U('line/info');?>/id/<?php echo ($set[$k2]['id']); ?>" class="hot-sale-big">
						<img src="<?php echo ($set[$k2]['img']); ?>" alt="">
						<!--<img class="hot-sale-img" src="/source/Static/home/images/index_img/special01_01.png" alt="">-->
						<div data-id="<?php echo ($set[$k2]['id']); ?>">
							<h4><?php echo ($set[$k2]['title']); ?></h4>
							<span><?php echo ($set[$k2]['send_word']); ?></span>
							<p>￥<em><?php echo ($set[$k2]['cut_price']); ?></em>起</p>
							<strong>查看详情></strong>
						</div>
					</a>
					<div class="hot-sale-product-small">
						<?php $k3 = $tab['type_key'].'3'; ?>
						<a href="<?php echo U('line/info');?>/id/<?php echo ($set[$k3]['id']); ?>">
							<img src="<?php echo ($set[$k3]['img']); ?>" alt="">
							<!--<img class="hot-sale-img" src="/source/Static/home/images/index_img/hot01_01.png" alt="">-->
							<div data-id="<?php echo ($set[$k3]['id']); ?>">
								<h4><?php echo ($set[$k3]['title']); ?></h4>
								<span><?php echo ($set[$k3]['send_word']); ?></span>
								<p>￥<em><?php echo ($set[$k3]['cut_price']); ?></em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
						<?php $k4 = $tab['type_key'].'4'; ?>
						<a href="<?php echo U('line/info');?>/id/<?php echo ($set[$k4]['id']); ?>">
							<img src="<?php echo ($set[$k4]['img']); ?>" alt="">
							<!--<img class="hot-sale-img" src="/source/Static/home/images/index_img/hot02_01.png" alt="">-->
							<div data-id="<?php echo ($set[$k4]['id']); ?>">
								<h4><?php echo ($set[$k4]['title']); ?></h4>
								<span><?php echo ($set[$k4]['send_word']); ?></span>
								<p>￥<em><?php echo ($set[$k4]['cut_price']); ?></em>起</p>
								<strong>查看详情></strong>
							</div>
						</a>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>

<!-- 超级目的地 -->



	<div class="bg-gray">

		<div class="special main">

			<h2>超级目的地</h2>

			<div class="special-exhibition">

				<ul>
				
					<?php $__FOR_START_1839542321__=0;$__FOR_END_1839542321__=12;for($k=$__FOR_START_1839542321__;$k < $__FOR_END_1839542321__;$k+=1){ if($k % 4 == 0): ?><li><?php endif; ?>
						
						<?php $zt = $set['zhuanti'.$k] ?>

						<a class="special-exhibition-product" href="<?php echo ($zt["url"]); ?>">

							<img src="<?php echo ($zt["img_main"]); ?>" alt="">

							<img class="special-img" src="<?php echo ($zt["img_banner"]); ?>" alt="">

							<div class="special-exhibition-describe">

								<h4><?php echo ($zt["title"]); ?></h4>

								<h4><?php echo ($zt["subheading"]); ?></h4>

								<p><?php echo ($zt["desc"]); ?></p>

							</div>

						</a>
						
						<?php if($k % 4 == 3): ?></li><?php endif; } ?>

				</ul>

			</div>

		</div>

	</div>
	<!-- 顶部轮播 -->
<script src="/source/Static/home/common/js/showAndHide.js"></script>
<script src="/source/Static/home/js/unslider.min.js"></script>
	


<!-- 更改tab-bg -->
<script src="/source/Static/home/common/js/movebg.js"></script>
<!-- tab -->
<script src="/source/Static/home/common/js/tab.js"></script>

<script>
	$('.special-exhibition').unslider({ 
		dots: true
	});


	$('.zt-main ul li').mouseenter( function () {

    	$(this).find('.zt-text').stop().animate({top: 0}, 500);

    	$(this).find('.zt-img').stop().fadeOut(1000);

  	} );

  	$('.zt-main ul li').mouseleave( function () {

    	$(this).find('.zt-text').stop().animate({top: "-369px"}, 1000);

    	$(this).find('.zt-img').stop().fadeIn(1500);

  	} );
  	
  	 //精彩游记

	$('.wonderful-travels ul li').mouseenter( function () {

	 	$(this).find('.wonderful-describe').stop().fadeIn();

	} );

	$('.wonderful-travels ul li').mouseleave( function () {

	  	$(this).find('.wonderful-describe').stop().fadeOut();

	} );
</script>




	<!-- 右侧侧边栏 -->
	<aside>
		<div class="join-us">
			<a href="javascript:;"></a>
		</div>
		<a class="aside_hot" href="javascript:;">
			<i></i>
			<div class="aside_show aside_show_hot">
				<p>热门推荐</p>
			</div>
		</a>
		<a class="aside_mine" href="<?php echo U('user/info');?>">
			<i></i>
			<div class="aside_show aside_show_mine">
				<p>个人中心</p>
			</div>
		</a>
		<a class="aside_order" href="<?php echo U('line/order');?>/type/center">
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
		<a class="aside_qq" href="http://pqt.zoosnet.net/LR/Chatpre.aspx?id=PQT43116159&lng=cn" target="_blank">
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
				<?php if(is_array($question_type)): $i = 0; $__LIST__ = $question_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$qt): $mod = ($i % 2 );++$i;?><ul class="<?php echo ($qt["class"]); ?>">
						<li><?php echo ($qt["type_desc"]); ?></li>
						<?php if(is_array($qt["questions"])): $i = 0; $__LIST__ = $qt["questions"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$quest): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('service/question');?>/id/<?php echo ($quest["id"]); ?>"><?php echo ($quest["content"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul><?php endforeach; endif; else: echo "" ;endif; ?>
				<div class="small-link small-link-top">
					<p>
						主题旅游：
						<a href="javascript:;">华东</a>
						<a href="javascript:;">坝上</a>
						<a href="javascript:;">柬埔寨</a>
						<a href="javascript:;">西藏</a>
						<a href="javascript:;">额济纳旗</a>
						<a href="javascript:;">雪乡旅游</a>
						<a href="javascript:;">云南摄影</a>
						<a href="javascript:;">行摄陕西</a>
						<a href="javascript:;">黔东南</a>
						<a href="javascript:;">四川</a>
						<a href="javascript:;">青海</a>
						<a href="javascript:;">新疆</a>
						<a href="javascript:;">甘南</a>
						<a href="javascript:;">川藏</a>
						<a href="javascript:;">呼伦贝尔</a>
					</p>
				</div>
				<div class="small-link small-link-bottom">
					<p>
						友情链接：
						<a href="javascript:;">蓬莱</a>
						<a href="javascript:;">北京会展</a>
						<a href="javascript:;">驴友论坛</a>
						<a href="javascript:;">天涯户外</a>
						<a href="javascript:;">户外轨迹路线</a>
						<a href="javascript:;">张家界旅游</a>
						<a href="javascript:;">渭南户外港</a>
						<a href="javascript:;">农家院旅游</a>
						<a href="javascript:;">行者物语网</a>
						<a href="javascript:;">携程主题游</a>
					</p>
				</div>
			</div>
			<div class="footer-content-right">
				<img src="/source/Static/home/common/images/footer_erweima.png" alt="">
			</div>
		</div>
	</footer>
	<div class="footer-bottom">
		<div class="footer-bottom-content">
			<p>
				领袖户外服务信息：
				<a href="javascript:;">关于我们</a>
				|
				<a href="javascript:;">联系我们</a>
				|
				<a href="javascript:;">招贤纳士</a>
				|
				<a href="javascript:;">帮助中心</a>
				|
				<a href="javascript:;">商务合作</a>
			</p>
			<span>Copyright © 2006-2014 kllife.com | 陕西浪客国际旅行社有限责任公司版权所有</span><em>公司地址：陕西省西安市雁塔区太白南路上上国际</em>
			<br>
			<span>领袖户外经营许可证号：L-SNX00306 陕ICP备14011728号-1</span>
		</div>
	</div>
	
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
</body>
</html>