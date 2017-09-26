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
	<!--图标-->
	<link type="image/x-icon" rel="shortcut icon" href="/source/Static/home/common/images/favicon.ico" />
	<!-- echo -->
	
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
				<a class="go-welcome" href="<?php echo U('index/welcome');?>"><img src="/source/Static/home/common/images/logo.gif" alt="领袖户外"></a>
				<!--logo图片加链接会导致样式混乱-->
				<!--<img src="/source/Static/home/common/images/logo_header.png" alt="领袖户外">-->
				<ul>
					<?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; if (is_array($menu) === false) { continue; } $jumpToLineList = false; switch($menu['item_desc']) { case '首页': $href=U('index/welcome'); break; case '私人定制': { $href=$pcset['team_link']; $target = '_blank'; }break; case '论坛': { $href = "http://shequ.kllife.com"; $target = '_blank'; }break; default: { $jumpToLineList = true; $href=U('line/list'); } break; } ?>
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
				<div class="search-header">
					<img src="/source/Static/home/common/images/search_header.png" alt="">
					<input type="text" value="<?php echo ($searchval); ?>" placeholder="特惠线路..."/>
					<a href="javascript:;">搜索</a>
				</div>
				<script type="text/javascript">
					function topSearchLine() {
						var searchval = $('.search-header').find('input').val();
						if (searchval != '') {
							var cdsstr = 'title|LIKE|%'+searchval+'%|OR';
								cdsstr += '|subheading|LIKE|%'+searchval+'%|OR';
								cdsstr += '|theme_type|LIKE|%'+searchval+'%|OR';
								cdsstr += '|play_type|LIKE|%'+searchval+'%|OR';
								cdsstr += '|dismiss_place|LIKE|%'+searchval+'%|OR';
								cdsstr += '|assembly_point|LIKE|%'+searchval+'%|OR';
								cdsstr += '|destination|LIKE|%'+searchval+'%|OR';
								cdsstr += '|view_point|LIKE|%'+searchval+'%|OR';
								cdsstr += '|hotel_type|LIKE|%'+searchval+'%|OR';
							$.post('<?php echo U("line/search");?>', {cds:cdsstr}, function(data){
								if (data.jumpUrl != null) {
									location.href = data.jumpUrl;
								}
							});
						} else {
							alert('请输出查询内容');
						}
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

<link rel="stylesheet" href="/source/Static/home/css/404.css">
<!-- Universal preloader -->

<div id="universal-preloader">

    <div class="preloader">

        <img src="/source/Static/home/images/404_img/universal-preloader.gif" alt="universal-preloader" class="universal-preloader-preloader" />

    </div>

</div>

<!-- Universal preloader -->



<div id="wrapper">

<!-- 404 graphic -->

	<div class="graphic">
		<img src="/source/Static/home/images/404_img/4.png"/>
		<img src="/source/Static/home/images/404_img/0.png"/>
		<img src="/source/Static/home/images/404_img/4.png"/>
	</div>

<!-- 404 graphic -->

<!-- Not found text -->

	<div class="not-found-text">

    	<h1 class="not-found-text">页面走丢了！</h1>
    	<h2 class="not-found-text">页面走丢了！页面走丢了页面走丢了页面走丢了页面走丢了</h2>
    	<h3 class="not-found-text">页面走丢了！页面走丢了页面走丢了页面走丢了页面走丢了</h3>

    </div>

<!-- Not found text -->





<div class="dog-wrapper">

<!-- dog running -->

	<div class="dog"></div>

<!-- dog running -->

	

<!-- dog bubble talking -->

	<div class="dog-bubble">

    	

    </div>

    

    <!-- The dog bubble rotates these -->

    <div class="bubble-options">

    	<p class="dog-bubble">

        	你迷路了吗？点击领袖户外回到首页吧！

        </p>

    	<p class="dog-bubble">

	        <br />

        	fighting！

        </p>

        <p class="dog-bubble">

        	<br />

        	别紧张，我马上回来

        </p>

        <p class="dog-bubble">

        	我想吃<br /><img style="margin-top:8px" src="/source/Static/home/images/404_img/cookie.png" alt="cookie" />

        </p>

        <p class="dog-bubble">

        	<br />

        	哎呦！小汽车来了

        </p>

        <p class="dog-bubble">

        	<br />

        	小团慢旅行首选领袖户外

        </p>

        <p class="dog-bubble">

        	啊哈，我找到你啦！！！

        </p>

        <p class="dog-bubble">

        	<br />

            我现在知道为什么了

        </p>

        <p class="dog-bubble">

        	我想我看见了一只 <br /><img style="margin-top:8px" src="/source/Static/home/images/404_img/cat.png" alt="cat" />

        </p>

        <p class="dog-bubble">

        	你在找什么呢？

        </p>

    </div>

    <!-- The dog bubble rotates these -->

<!-- dog bubble talking -->

</div>



<!-- planet at the bottom -->

	<div class="planet"></div>

<!-- planet at the bottom -->

</div>

<script src="/source/Static/home/js/tipsy.js"></script>
<script>
	// JavaScript Document

//prepare variables
var degree = 0;

var maxtalk = 0;
var talkbubble = 1;


$(document).ready(function(){
	
	//clear input text when clicked
	inputTextFix();
	
	//count talk bubbles
	$("div.bubble-options p.dog-bubble").each(function(){
	
		maxtalk++;
									 
	});		
	
});

//function that implements a input text hotfix; remove if you don't like it
function inputTextFix(){

	$("input[type='text'], input[type='password']").each(function(){
			
		//each time a user clicks on a input field
		$(this).click(function(){
						
			//save the current value, if any
			if($(this).attr("value")!=""){
				
				$(this).attr("previous_value", $(this).attr("value"));
				$(this).attr("value","");   
			
			}

		});
		
		//on blur, if left empty, restore the saved value, if any
		$(this).blur(function(){
					
			if($(this).attr("value") == "")
				$(this).attr("value",$(this).attr("previous_value"));					  
							  
		});
										   
	});
	
}

//function that handles the universal preloader positioning and alignment
function universalPreloader(){
		
	var pre = $("#universal-preloader>div");
	
	//centering function
	jQuery.fn.center = function () {
		this.css("position","absolute");
		this.css("top", (($(window).height() - this.outerHeight()) / 2) + "px");
		this.css("left", (($(window).width() - this.outerWidth()) / 2) + "px");
		return this;
	}
	
	//center to the screen
	pre.center();
	
	//run each time user resizes window
	$(window).resize(function() {
	
		pre.center();
							  
	});
	
}

//function that disposes the universal preloader when everything is loaded; called on window.load event
function universalPreloaderRemove(){
		
	var parentD = $("#universal-preloader");
	var pre = $("#universal-preloader>div");
	
	var logo = $("#universal-preloader .universal-preloader-logo");
	var loader = $("#universal-preloader .universal-preloader-preloader");
	
	//when the logo and ajax-loader fades out, fade out the curtain; when that completes, remove the universal preloader from the DOM
	pre.delay(1000).animate({opacity:'0'},{duration:400, complete:function(){
	
		parentD.animate({opacity:'0'},{duration:400, complete:function(){
		
			parentD.remove();
		
		}});
																																		 
	}});
	
	
}


//function that handles the talking dog bubble animations
function dogTalk(){
		
	var timer = setTimeout(function() {
		
		//change the bubble html code
		$temp = "<p>"+$("div.bubble-options p.dog-bubble:nth-child("+talkbubble+")").html()+"</p>";		
		$("div.dog-bubble").html($temp);
		
		//browse through bubble-options
		if(talkbubble<maxtalk)
			talkbubble++;
		else
			talkbubble = 1;
				
		//show the bubble
		$(".dog-bubble").animate({"opacity":'1', "bottom":'10px'}, 400);
		
		//hide the bubble
		setTimeout(function() {
			
			$(".dog-bubble").animate({"opacity":'0', "bottom":'0px'}, 400);
			dogTalk();	
		
		}, 5000);		
		
	}, 2000);	
	
}

//function that handles the planet animation
function rotate() {

	$planet = $("div.planet");

	  //CSS3
	$planet.css({ 'transform' : 'rotate(' + degree + 'deg)'}); 
	  // For webkit browsers: e.g. Chrome
	$planet.css({ WebkitTransform : 'rotate(' + degree*2 + 'deg)'});
	  // For Mozilla browser: e.g. Firefox
	$planet.css({ '-moz-transform' : 'rotate(' + degree + 'deg)'});
	  //IE9
	$planet.css({ '-ms-transform' : 'rotate(' + degree + 'deg)'});
	  //Opera
	$planet.css({ '-o-transform' : 'rotate(' + degree + 'deg)'});
	
	// Animate rotation with a recursive call
	var timer = setTimeout(function() {
		degree-=0.1; 
		rotate();
	},10);

}

//function that handles dog movement animation
//function dogRun(){
//	
//	var dog = $("div.dog");
//	
//	var timer2 = setTimeout(function() {
//								 
//		if(dog.css("background-position") == "0px 0px")
//			dog.css({"background-position":"-80px -2px"});
//		else
//			dog.css({"background-position":"0px 0px"});							 
//			
//		dogRun();	
//		
//	}, 130);	
//	
//}
</script>
<script>
	



$(document).ready(function(){

			

	universalPreloader();

						   

});



$(window).load(function(){



	//remove Universal Preloader

	universalPreloaderRemove();

	

	rotate();

    //dogRun();

	dogTalk();

	

	//Tipsy implementation

	$('.with-tooltip').tipsy({gravity: $.fn.tipsy.autoNS});

						   

});




</script>





	<footer>
		<div class="footer-content">
			<div class="footer-content-left">
				<?php if(is_array($question_type)): $i = 0; $__LIST__ = $question_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$qt): $mod = ($i % 2 );++$i; if ($key == 'config_update_time') { continue; } ?>
					<ul class="<?php echo ($qt["class"]); ?>">
						<li><?php echo ($qt["type_desc"]); ?></li>
						<?php if(is_array($qt["questions"])): $i = 0; $__LIST__ = $qt["questions"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$quest): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('service/question');?>/id/<?php echo ($quest["id"]); ?>"><?php echo ($quest["content"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul><?php endforeach; endif; else: echo "" ;endif; ?>
				<!--<div class="small-link small-link-top">
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
				</div>-->
			</div>
			<div class="footer-content-right">
				<img src="/source/Static/home/common/images/footer_erweima.png" alt="">
			</div>
		</div>
	</footer>
	<div class="footer-bottom">
		<div class="footer-bottom-content">
			<!--<p>
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
			</p>-->
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
</body>
</html>