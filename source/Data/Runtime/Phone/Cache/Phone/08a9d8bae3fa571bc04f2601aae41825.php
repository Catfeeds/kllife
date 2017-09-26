<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta name="baidu-site-verification" content="7JiPIVdZ6K" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- 优先使用 IE 最新版本和 Chrome -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <!-- 1:1显示 -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- 忽略页面中的数字识别为电话号码和邮箱 -->
	<meta name="format-detection" content="telephone=no,email=no" />
	<!-- 允许全屏浏览 ios -->
	<meta content="yes" name="apple-mobile-web-app-capable" />
	<!-- 启用360浏览器的极速模式(webkit) -->
    <meta name="renderer" content="webkit">
    <!-- 避免IE使用兼容模式 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 不让百度转码 -->
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!-- 针对手持设备优化，主要是针对一些老的不识别viewport的浏览器，比如黑莓 -->
    <meta name="HandheldFriendly" content="true">
    <!-- 微软的老式浏览器 -->
    <meta name="MobileOptimized" content="320">
    <!-- uc强制竖屏 -->
    <meta name="screen-orientation" content="portrait">
    <!-- QQ强制竖屏 -->
    <meta name="x5-orientation" content="portrait">
	<!-- windows phone 点击无高光 -->
    <meta name="msapplication-tap-highlight" content="no">    
	<meta content="领袖户外" name="author"/>
	<?php if(strpos($_SERVER['HTTP_HOST'], '.kllife.com') !== FALSE): ?><meta name="robots" content="noindex,nofollow"/><?php endif; ?>
	<!--分销标题关键字-->
	<?php if(empty($duid) == false): if(C('MENU_CURRENT') == 'line_content'): ?><title><?php echo ($line["title"]); ?>-<?php echo ($line["subheading"]); ?></title>
		<?php else: ?>
			<title><?php echo ($fxset["shop_title"]["data"]["value"]); ?></title><?php endif; ?>
	<!--特殊专题额济纳标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_ejina'): ?>
		<title>额济纳旅游的首选__领袖户外旅行网__好玩不贵的小团慢旅行</title>
		<meta content="额济纳旅游的首选,领袖户外旅行网,好玩不贵的小团慢旅行" name="title"/>
	    <meta content="额济纳旅游,额济纳旅游攻略,额济纳旅游费用,额济纳旅游价格,额济纳胡杨林,额济纳旅游景点大全" name="keywords"/>
	    <meta content="额济纳旗，掉落在童话里的秋日，颠覆传统旅行方式，化腐朽为神奇的国庆精品线路。领袖户外：好玩不贵的小团慢旅行！,精品小团，享受一次恰到好处的慢旅行！在最美的风景中漫步、深呼吸，为不期而遇的惊艳停车，品味夕阳晨曦的美好，尽可能与美景相拥而眠，旅途中从陌生，变成朋友……" name="description"/>	
	<!--特殊专题新疆标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_xinjiang'): ?>
	    <title>新疆旅游的首选_领袖户外旅行网_好玩不贵的小团慢旅行_领袖户外官方网站</title>	
	    <meta content="新疆旅游的首选,领袖户外旅行网,好玩不贵的小团慢旅行,领袖户外官方网站" name="title"/>
	    <meta content="新疆旅游,新疆旅游攻略,新疆旅游费用,新疆旅游价格,新疆旅游景点大全,新疆驴友网,禾木驴友网,新疆驴友攻略,喀纳斯驴友网,新疆定制游" name="keywords"/>
	    <meta content="新疆旅游攻略，小团慢旅行,新疆自助游攻略，包括小团慢旅行,新疆热门景点、户外俱乐部、游记攻略、出行交通、餐饮等旅游信息，以及小团慢旅行,新疆驴友交流、驴友俱乐部信息。小团慢旅行,新疆旅游怎么订制。" name="description"/>	
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
	
	<link rel="stylesheet" href="/source/Static/phone/common/css/light7.css">
	<link rel="stylesheet" href="/source/Static/common/css/common.css">
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="/source/Static/common/js/jquery-1.11.1.min.js"></script>
	<script src="/source/Static/common/js/functions.js"></script>

	<!-- jq -->
	<!--<script src="/source/Static/phone/common/js/jquery.min.js"></script>-->
	<style>
		.black-mark { display: none; position: fixed; top:0; left:0; width: 100%; height: 100%; text-align: center; color:#ececec; background: rgba(0,0,0,.5); z-index:3000; }
		.black-mark p { margin-top: 230px; color: #fff; text-align: center; }
	</style>
	<script>			
		function ShowMark(){
			$('.black-mark').show();
		};
		function HideMark(){
			$('.black-mark').hide();
		};		
	</script>
</head>
<body>
	<div class="black-mark">
		<p>稍等一会儿...</p>
	</div>
<div class="page">
	<!-- mycss -->
	<link rel="stylesheet" href="/source/Static/phone/css/line_list.css">
		<header class="bar bar-nav">
			<a class="button button-link button-nav pull-left back" href="<?php echo U('index/welcome');?>">
		      <i class="iconfont">&#xe606;</i>
		    </a>
		    <div class="searchbar">
				<!--<a class="searchbar-cancel">取消</a>-->
				<div class="search-input">
					<i class="iconfont">&#xe607;</i>
					<label class="icon icon-search" for="search"></label>	
					<input type="search" id="search" placeholder="搜索产品..." value="<?php echo ($search_value); ?>">
				</div>
		    </div>
		</header>
			    <nav class="bar bar-tab">
	    	<?php if(empty($duid)): ?><a class="tab-item active" href="<?php echo U('index/welcome');?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="http://shequ.kllife.com/" external>
			      <i class="iconfont">&#xe603;</i>
			      <p>游记</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a>
	    	<?php else: ?>
			    <a class="tab-item active" href="<?php echo U('fenxiao/welcome');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe605;</i>
			      <p>首页</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('line/book');?>" external>
			      <i class="iconfont">&#xe604;</i>
			      <p>定制游</p>
			    </a>
			    <a class="tab-item" href="<?php echo ($pcset["askfor_link"]); ?>" external>
			      <i class="iconfont">&#xe602;</i>
			      <p>咨询</p>
			    </a>
			    <a class="tab-item" href="<?php echo U('user/info');?>/duid/<?php echo ($duid); ?>" external>
			      <i class="iconfont">&#xe601;</i>
			      <p>我的</p>
			    </a><?php endif; ?>
		</nav>
		<!--<script src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>-->
		<script type="text/javascript">
//            jQuery(document).ready(function($){
//                $("img").lazyload({
//                    placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
//                    effect      : "fadeIn",
//                    threshold : 0,
//                    failure_limit : 10,
//                    skip_invisible : false
//                });
//            });

			$('nav').find('a:last-child').click(function(){
				$.post('<?php echo U("index/url");?>', {type:'nav_mine'}, function(data){
					if (data.result.errno == 0) {
						if (data.jumpUrl != null) {
							location.href = data.jumpUrl;
						}
					} else {
						alert(data.result.message);
					}
				});
			});
		</script>
		<div class="content">
			<!-- 筛选 -->
			<div class="row no-gutter">
				<div class="col-33">
					产品类型<i class="iconfont">&#xe608;</i>
					<input type="text" placeholder="类型" id="theme" readonly="" style="position: absolute; top: 0; left: 0; width: 100%; opacity: 0; border: none; font-size: .75rem;">
				</div>
				<div class="col-33">
					集合地点<i class="iconfont">&#xe608;</i>
					<input type="text" placeholder="集合地" id="assembly" readonly="" style="position: absolute; top: 0; left: 0; width: 100%; opacity: 0; border: none; font-size: .75rem;">
				</div>
				<!--<div class="col-33">
					目的地<i class="iconfont">&#xe608;</i>
					<input type="text" placeholder="目的地" id="dest" readonly="" style="position: absolute; top: 0; left: 0; width: 100%; opacity: 0; border: none; font-size: .75rem;">
				</div>
				<div class="col-33">
					景点<i class="iconfont">&#xe608;</i>
					<input type="text" placeholder="景点" id="view" readonly="" style="position: absolute; top: 0; left: 0; width: 100%; opacity: 0; border: none; font-size: .75rem;">
				</div>-->
				<div class="col-33">
					<i class="iconfont">&#xe609;</i>其他<i class="iconfont">&#xe608;</i>
					<input type="text" placeholder="其他" id="other" readonly="" style="position: absolute; top: 0; left: 0; width: 100%; opacity: 0; border: none; font-size: .75rem;">
				</div>
			</div>
			<!-- 列表内容 -->
			<div class="list">
				<div class="list-content">
					<div class="content infinite-scroll infinite-scroll-bottom" data-distance="100">
			          <div class="list-block">
			              <ul class="list-container">
			              </ul>
			          </div>
			          <!-- 加载提示符 -->
			          <div class="infinite-scroll-preloader" style="position: relative">
			              <span class="preloader" style="position: absolute;left:30%;"></span><span style="position: absolute;top:2px;left:40%;">正在加载中...</span>
			          </div>
			      </div>
				</div>
			</div>
		</div>
	</div>




<!-- light7 -->
<script src="/source/Static/phone/common/js/light7.js"></script>
<!-- i18n 中文 -->
<script src="/source/Static/phone/common/js/cn.js"></script>
<!--公用JS文件-->
<script src="/source/Static/common/js/functions.js"></script>

<script>		
    //加载指示
    function PageLoading() {
    	this.loaded = false;
    }
    
    PageLoading.prototype.isLoading = function () {
    	return this.loaded;
    }
    
    PageLoading.prototype.loading = function (bshow, bstyle) {
    	this.loaded = bshow;
    	if (bstyle == null || bstyle == true) {
	    	if (bshow) {
	       		$.showPreloader();
	    	} else {
	            $.hidePreloader();	
	    	}
    	}
    }
</script>
<script>

	// 获取条件
	function getConditions() {
		var cdsstr = '';
		// 线路标题
		var searchval = $('#search').val();	
		if (searchval != '') {
			cdsstr += 'title|'+searchval;
		}		
		// 主题
		var theme = $('#theme').val();	
		if (theme != '' && theme != '全部') {
			if (cdsstr != ''){
				cdsstr += '|';
			}
			cdsstr += 'theme_type|'+theme;
		}
		// 集合地点
		var assembly = $('#assembly').val();
		if (assembly != '' && assembly != '全部') {
			if (cdsstr != ''){
				cdsstr += '|';
			}
			cdsstr += 'assembly_point|'+assembly;
		}
		// 目的地、月份、行程天数
		var other = $('#other').val();
		if (other != '') {
			var vals = other.split(' ');
			var cols = ['destination','trip_month','travel_day'];
			for (var i=0; i < vals.length; i ++) {
				if (vals[i] != '全部') {
					if (cdsstr != ''){
						cdsstr += '|';
					}
					cdsstr += cols[i]+'|'+vals[i];
				}	
			}
		}			
		return cdsstr;
	}
	
	// 获取排序规则
	function getSorts() {
		
	}		
	
	// 查找产品		
	var loading = false;	// 是否在加载中
	var pageIndex = 0;
	var noMoreData = false;
	function loadMoreData(p) {
		var jsonData = {
			page: p,
			cds: getConditions(),
//				sorts: getSorts(),
		}
		
		console.log(JSON.stringify(jsonData));
		loading = true;
		$.post('<?php echo U("line/list");?>', jsonData, function(data){
			loading = false;
			var containerObj = $('.infinite-scroll-bottom .list-container');
			if (data.result.errno == 0) {
				if (data.ds != null && data.ds != 'undefined') {
					var html = '';
					for (var i=0; i < data.ds.length; i++) {
						var d = data.ds[i];
						var priceText = '<span>核算中</span>'
						if (d.check_price != 0) {
							priceText = '				<s>原价：'+d.start_price_adult+'</s>' +
										'				<span>￥'+d.start_price_adult+'</span>';
						}		
						html += '<li class="item-content">' + 
								'	<div class="travel-content-list">' +
								'		<div class="travel-content-sublist">' +
								'			<div class="travel-content-img">' +
								'				<img src="'+d.img1+'" alt="">' +
								'			</div>' +
								'			<div class="travel-content-word">' +
								'				<h4>'+d.title+'</h4>' +
								'				<p>出发地：'+d.assembly_point_show_text+'</p>' + priceText +								
								'			</div>' +
								'			<a href="'+'<?php echo U("line/info");?>/id/'+d.id+'" external></a>' +
								'		</div>' +
								'	</div>' + 
								'</li>';
					} // end for
					// 添加新条目
					$(containerObj).append(html);
					pageIndex ++;
				} else {
					if ($(containerObj).parent().find('.no-more-data').length > 0) {
						$(containerObj).find('.no-more-data').html('没有更多数据...');
					} else {
						var vhtml = '<div class="no-more-data">没有更多数据...</div>';
						$(containerObj).parent().append(vhtml);
					}
					noMoreData = true;
					// 处理么有数据可加载情况
					procLoadEnd();
				}
			} else {
				console.log(data.result.message);
			}
		});
	}
	
	// 添加筛选条件
	function attachSelect(obj, title, colList) {
		$(obj).picker({
			toolbarTemplate:'<header class="bar bar-nav">'+
							'	<button data-id="'+obj+'" class="button button-link pull-right close-picker">确定</button>'+
							'	<h1 class="title">'+title+'</h1>'+
							'</header>',
			cols: colList,
			onClose: function(){
				var containerObj = $('.infinite-scroll-bottom .list-container');
				$(containerObj).empty();
				$(containerObj).parent().find('.no-more-date').remove();
				pageIndex = 0;
				loadMoreData(pageIndex);
			}
		});
	}
		
	// 处理加载
	function procLoadEnd() {
//			??????????????
	}
	
	$(function (){
		$.init();				
		if ('<?php echo ($init_theme_type); ?>' != '') {	
			$('#theme').val('<?php echo ($init_theme_type); ?>');
		}
		// 产品类型
		var theme = $.parseJSON('<?php echo ($line_theme); ?>');
		var tempCols = [{textAlign:'center', values:theme}];
		attachSelect('#theme', '产品类型', tempCols);
		// 集合地点
		var assembly = $.parseJSON('<?php echo ($assembly_place); ?>');
		tempCols = [{textAlign:'center', values:assembly}];
		attachSelect('#assembly', '集合地点', tempCols);
		// 目的地点
		var dest = $.parseJSON('<?php echo ($dest); ?>');
		// 包含景点
//		var view = $.parseJSON('<?php echo ($view_point); ?>');
		// 出行月份
		var month = $.parseJSON('<?php echo ($month); ?>');
		var day = ['全部','1天','2天','3天','4天','5天','6天','7天','8天','9天','10天','11天','12天','13天','14天','15天'];
		
		tempCols = [
			{textAlign:'center', values:dest},
			{textAlign:'center', values:month},
			{textAlign:'center', values:day},
		];
		attachSelect('#other', '目的地   出行月份   出行天数', tempCols);		
		
		// 第一次加载
		loadMoreData(pageIndex);
		
		// 搜索框查询
		
		$("#search").keydown(function(event){ 
			if(event.which == 13){
				$('#search').blur();
			} 
		});
		$('#search').blur(function(){
			var containerObj = $('.infinite-scroll-bottom .list-container');
			$(containerObj).empty();
			$(containerObj).parent().find('.no-more-date').remove();
			pageIndex = 0;
			loadMoreData(pageIndex);
		});
		
		// 注册'infinite'事件处理函数
		$(document).on('infinite', '.infinite-scroll-bottom',function() {

			// 如果正在加载，则退出
			if (loading) return;

			// 设置flag
			loading = true;

			// 模拟1s的加载过程
			setTimeout(function() {
				// 重置加载flag
				loading = false;

				if (noMoreData == true) {
					// 加载完毕，则注销无限加载事件，以防不必要的加载
					$.detachInfiniteScroll($('.infinite-scroll'));
					// 删除加载提示符
					$('.infinite-scroll-preloader').hide();
					return;
				}
				loadMoreData(pageIndex);
				//容器发生改变,如果是js滚动，需要刷新滚动
				//$.refreshScroller();
				
			}, 1000);
		});

		
	});
	</script>
<!--百度统计-->
<script>
	var _hmt = _hmt || [];
	(function() {
		var hm = document.createElement("script");
		hm.src = "//hm.baidu.com/hm.js?a6f69a2a062b07c67a4ae301e0963ca8";
		var s = document.getElementsByTagName("script")[0]; 
		s.parentNode.insertBefore(hm, s);
	})();
</script> 
<!--商务通统计-->
<script language="javascript" src="http://pqt.zoosnet.net/JS/LsJS.aspx?siteid=PQT43116159&lng=cn"></script>
<!--CNZZ统计-->
<script type="text/javascript">
	var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
	document.write(unescape("%3Cdiv id='cnzz_stat_icon_1000019958'%3E%3C/div%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1000019958%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>