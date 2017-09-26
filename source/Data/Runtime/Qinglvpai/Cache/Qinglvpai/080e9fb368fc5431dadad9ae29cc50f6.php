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
<!-- 轮播样式 -->
<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/slide.css">
<!-- 私有样式 -->
<link rel="stylesheet" href="http://kllife.com/source/Static/home/css/list.css">
<style type="text/css">
	body { background-color:#f3f5f6; }
	.select > .select-list {height: 60px; }
	.select-list { min-height: 35px; }
	.select-all { width: 50px !important; }
	.select-body { max-width: 1000px; }
	.select-body a { max-width: 160px !important; }
	.select-checkbox { min-width: 50px; }
	.select-head .select-all,.select-up-down,.select-body a:hover,.select-more:hover,.double-row-describe-price h6 strong,.list-page a,.list-menu-sort-left .sort-checked{color:#ff1c77;}
	.list-page span.current{background: #ff1c77;border-color:#ff1c77;color:#fff;}
	.select-up-down i,.select-more i,.list-menu-sort-right i,.list-menu-sort-right i,.select-mine .select-body span,.list-menu-sort-left i{background-image: url(http://kllife.com/source/Static/qinglvpai/images/list/small_icon.png);}
	.jiriyou p,.select-mine .select-body a:hover{background: #ff1c77;}
	.select-mine .select-body span,.btns button:hover,.select-mine .select-body a{border-color:#ff1c77;color:#ff1c77;}
	.select-up-down:hover,.list-menu-sort-left a:hover,.single-row-describe-price h6 strong,.select-up-down:focus{color:#ff1c77;}
	.single-row-describe-bottom .appointment{background: url(http://kllife.com/source/Static/qinglvpai/images/list/appointment.jpg)}
</style>
	<!-- 主要内容 -->
	<div id="content" style="margin-top: 20px; margin-bottom: 50px;">
		<div class="commodity-menu">
			<ul class="select">
				<li class="select-mine">
					<div class="select-head">
						<span>您的选择:</span>
					</div>
					<div class="select-body">
						<a class="select-clear" href="javascript:;">清除筛选条件</a>
					</div>
				</li>
				<li class="select-list">
					<div class="select-head">
						<span>产品主题:</span>
						<a class="select-all" href="javascript:;">全部</a>
					</div>
					<div class="select-body select-cpzt select-list">
						<?php if(is_array($line_theme)): $i = 0; $__LIST__ = $line_theme;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lt): $mod = ($i % 2 );++$i;?><a href="javascript:;" data-id="<?php echo ($lt["id"]); ?>"><?php echo ($lt["type_desc"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<div class="select-foot">

					</div>
				</li>
				<li class="select-list">
					<div class="select-head">
						<span>产品区域:</span>
						<a class="select-all" href="javascript:;">全部</a>
					</div>
					<div class="select-body select-cpqy select-list">
						<?php if(is_array($line_area)): $i = 0; $__LIST__ = $line_area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$la): $mod = ($i % 2 );++$i;?><a href="javascript:;" data-id="<?php echo ($la["id"]); ?>"><?php echo ($la["type_desc"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<div class="select-foot">

					</div>
				</li>
				<li>
					<div class="select-head">
						<span>目的地:</span>
						<a class="select-all" href="javascript:;">全部</a>
					</div>
					<div class="select-body select-mdd select-list">
						<?php if(is_array($dest)): $i = 0; $__LIST__ = $dest;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$d): $mod = ($i % 2 );++$i;?><a href="javascript:;" data-id="<?php echo ($d["id"]); ?>"><?php echo ($d["type_desc"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<div class="select-foot">
						<a class="select-more select-more02" href="javascript:;">更多<i class="show-more"></i></a>
					</div>
				</li>
				<li class="select-hide">
					<div class="select-head">
						<span>包含景点:</span>
						<a class="select-all" href="javascript:;">全部</a>
					</div>
					<div class="select-body select-jd select-list multiselect">
						<?php if(is_array($view_point)): $i = 0; $__LIST__ = $view_point;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vp): $mod = ($i % 2 );++$i;?><a href="javascript:;"  data-id="<?php echo ($vp["id"]); ?>">
								<span class="no-checked multiselect-span multiselect-hide"></span>
								<span><?php echo ($vp["type_desc"]); ?></span>
							</a><?php endforeach; endif; else: echo "" ;endif; ?>
						<div class="btns btn-hide">
							<button type="button" class="btn-submit">确定</button>
							<button type="button" class="btn-cancel">取消</button>
						</div>
					</div>
					<div class="select-foot">
						<a class="select-checkbox" href="javascript:;"><span>+</span>多选</a>
						<a class="select-more select-more01" href="javascript:;">更多<i class="show-more"></i></a>
					</div>
				</li>
				<li class="select-hide">
					<div class="select-head">
						<span>集合地:</span>
						<a class="select-all" href="javascript:;">全部</a>
					</div>
					<div class="select-body select-cfd select-list">
						<?php if(is_array($assembly_place)): $i = 0; $__LIST__ = $assembly_place;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ap): $mod = ($i % 2 );++$i;?><a href="javascript:;" data-id="<?php echo ($ap["id"]); ?>"><?php echo ($ap["type_desc"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</li>

				<li class="select-hide">
					<div class="select-head">
						<span>旅行时间:</span>
						<a class="select-all" href="javascript:;">全部</a>
					</div>
					<div class="select-body select-lxsj select-list">
						<?php if(is_array($month)): $i = 0; $__LIST__ = $month;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?><a href="javascript:;" data-id="<?php echo ($m["id"]); ?>"><?php echo ($m["type_desc"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</li>
				<li class="select-hide">
					<div class="select-head">
						<span>行程天数:</span>
						<a class="select-all" href="javascript:;">全部</a>
					</div>
					<div class="select-body select-xcts select-list ">
						<?php $__FOR_START_416378497__=1;$__FOR_END_416378497__=31;for($i=$__FOR_START_416378497__;$i < $__FOR_END_416378497__;$i+=1){ ?><a href="javascript:;" data-id="<?php echo ($i); ?>"><?php echo ($i); ?>天</a><?php } ?>
					</div>
				</li>
			</ul>
			<a class="select-up-down" href="javascript:;">
				<span>查看更多选项<i class="show-more"></i></span>
			</a>
		</div>
		<!--单排列表模板-->		
		<div class="single-row-content template_single_row hidden_ctrl">
			<a href="javascript:;" target="_blank"></a>
			<div class="single-row-img">
				<img src="" alt="">
			</div>
			<div class="jiriyou">
				<p><span class="day"></span>日游</p>
			</div>
			<div class="single-row-describe">
				<div class="single-row-describe-top">
					<h4 class="title"></h4>
					<h5 class="subheading"></h5>
					<span class="send_word"></span>
					<p><u class="assembly">集合地点：</u><u class="batch">批次：全年0期</u></p>
					<p class="destination">目的地：</p>
					<div class="single-row-describe-price">
						<h6><!--<s class="price">0元</s>--><strong class="cut_price"></strong>元起</h6>
					</div>
				</div>
				<div class="single-row-describe-bottom">
					<span class="travel_date">旅行时间：</span>
					<em class="appointment""></em>
				</div>
			</div>
		</div>
		
		<!--双排列表模板-->		
		<div class="double-row-content template_double_row hidden_ctrl">
			<div class="template_content"> <!--double-row-left/double-row-right-->
				<a href="javascript:;" target="_blank"></a>
				<div class="template_img"> <!--double-row-left-top/double-row-right-top-->
					<img src="" alt="">
				</div>
				<div class="jiriyou">
					<p><span class="day"></span>日游</p>
				</div>
				<div class="double-row-describe">
					<h4 class="title"></h4>
					<h5 class="subheading"></h5>
					<p class="send_word describe-content"></p>
					<p><u class="assembly">集合地点：</u><u class="batch">批次：全年0期</u></p>
					<p class="destination">目的地：</p>
					<div class="double-row-describe-price">
						<h6><!--<s class="price">0元</s>--><strong class="cut_price"></strong>元起</h6>
					</div>
				</div>
			</div>
		</div>
		<!-- 列表菜单 -->
		<div class="list-menu">
			<div class="list-menu-sort">
				<div class="list-menu-sort-left">
					<a class="list-menu-sort-comprehensive sort-checked" href="javascript:;">综合排序</a>
					<a class="list-menu-sort-sales" href="javascript:;">销量<i></i></a>
					<!--<a class="list-menu-sort-price" href="javascript:;">价格<i></i></a>-->
				</div>
				<div class="list-menu-sort-right">
					<a class="list-menu-sort-x" href="javascript:;"><i class="sort-x"></i></a>
					<a class="list-menu-sort-y" href="javascript:;"><i></i></a>
				</div>
			</div>
			<?php if(empty($lines) == true): ?><span class="no-more-data" style="text-indent:2em;">领袖户外暂时没有你所要查询的信息，产品经理们正在努力开发线路中...</span><?php endif; ?>
			
			<!-- 单排列表 -->
			<div class="single-row">
				<?php if(is_array($lines)): $i = 0; $__LIST__ = $lines;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$line): $mod = ($i % 2 );++$i;?><div class="single-row-content" data-id="<?php echo ($line["id"]); ?>">
						<a href="<?php echo U("line/content");?>/id/<?php echo ($line["id"]); ?>" target="_blank"></a>
						<div class="single-row-img">
							<img src="<?php echo ($line["img1"]); ?>" alt="">
						</div>
						<div class="jiriyou">
							<p><span class="day"><?php echo ($line["travel_day"]); ?></span>日游</p>
						</div>
						<div class="single-row-describe">
							<div class="single-row-describe-top">
								<h4 class="title"><?php echo ($line["title"]); ?></h4>
								<h5 class="subheading"><?php echo ($line["subheading_show"]); ?></h5>
								<span class="send_word"><?php echo ($line["send_word_show"]); ?></span>
								<p>
									<u class="assembly">集合地点：<?php echo ($line["assembly_point_show_text"]); ?></u>
									<u class="batch">批次：全年<?php echo count($line['batchs']);?>期</u>
								</p>
								<p class="destination">目的地：<?php echo ($line["destination_show_text"]); ?></p>
								<div class="single-row-describe-price">
									<h6>
										<?php if(empty($line['check_price'])): ?><strong class="cut_price">核算中</strong>
										<?php else: ?>
											<strong class="cut_price"><?php echo ($line["start_price_adult"]); ?></strong>元起<?php endif; ?>
									</h6>
								</div>
							</div>
							<div class="single-row-describe-bottom">
								<span class="travel_date">旅行时间： <?php echo ($line["start_time"]); ?>&nbsp;至&nbsp;<?php echo ($line["end_time"]); ?></span>
								<em class="appointment" href="<?php echo U("line/content");?>/id/<?php echo ($line["id"]); ?>"></em>
							</div>
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<!-- 双排列表 -->
			<div class="double-row">
				<?php if(is_array($lines)): $i = 0; $__LIST__ = $lines;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$line): $mod = ($i % 2 );++$i; if($key % 2 == 0): ?><div class="double-row-content">
							<div class="double-row-left">
								<div class="double-row-left-top">
					<?php else: ?>
							<div class="double-row-right">
								<div class="double-row-right-top"><?php endif; ?>
									<img src="<?php echo ($line["img1"]); ?>" alt="">
								</div>
								<div class="jiriyou">
									<p><span class="day"><?php echo ($line["travel_day"]); ?></span>日游</p>
								</div>
								<a href="<?php echo U("line/content");?>/id/<?php echo ($line["id"]); ?>" target="_blank"></a>
								<div class="double-row-describe">
									<h4 class="title"><?php echo ($line["title"]); ?></h4>
									<h5 class="subheading"><?php echo ($line["subheading_show"]); ?></h5>
									<p class="send_word describe-content"><?php echo ($line["send_word_show"]); ?></p>
									<p>
										<u class="assembly">集合地点：<?php echo ($line["assembly_point_show_text"]); ?></u>
										<u class="batch">批次：全年<?php echo count($line['batchs']);?>期</u>
									</p>
									<p class="destination">目的地：<?php echo ($line["destination_show_text"]); ?></p>
									<div class="double-row-describe-price">
										<h6>
											<?php if(empty($line['check_price'])): ?><strong class="cut_price">核算中</strong>
											<?php else: ?>
												<strong class="cut_price"><?php echo ($line["start_price_adult"]); ?></strong>元起<?php endif; ?>
										</h6>
									</div>
								</div>
							</div>					
					<?php if($key % 2 > 0): ?></div> <!--double-row-content 结束符--><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					<!--数据为单数时添加double-row-content 结束符-->
					<?php if(count($lines) % 2 > 0): ?></div> <!--double-row-content 结束符--><?php endif; ?>
			</div>
			<!-- 翻页 -->
			<div class="list-page" data-page-count="<?php echo ($page_count); ?>" data-page-index="1"></div>
		</div>
	</div>
	<!-- 私人定制 -->
	
	<!-- 精彩专题 -->
	
	<!-- 为什么选择我们 -->
	
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
	<script type="text/javascript">
		
		// 获取基本信息
		function getConditions() {
			var cdsstr = '';			
			var aObj = $('.select-mine').find('.select-body').find('a').each(function(i,ev){
				var cdstr = '';
				var did = $(this).attr('data-id');
				if ($(this).hasClass('select-cpzt0')) {
					cdstr = 'c0|'+did;
				} else if ($(this).hasClass('select-mdd0')) {
					cdstr = 'c1|'+did;
				} else if ($(this).hasClass('select-jd0')) {
//					var t = textstr.replace(/(^\s*)|(\s*$)/g, ""); 
					cdstr = 'c2|'+did;
				} else if ($(this).hasClass('select-cfd0')) {
					cdstr = 'c3|'+did;
				} else if ($(this).hasClass('select-lxsj0')) {
					cdstr = 'c4|'+did;
				} else if ($(this).hasClass('select-xcts0')) {
//					var day = daystr.substring(0,daystr.length - 1);
					cdstr = 'c5|'+did;
				} else if ($(this).hasClass('select-cpqy0')) {
					cdstr = 'c6|'+did;
				}
				if (cdstr != '') {
					if (cdsstr != '') {
						cdsstr += '|';
					}
					cdsstr += cdstr;
				}
			});
			return cdsstr;
		}
		
		// 获取排序规则
		function getSorts() {
			var ssort = '';
			var sortObj = $('.list-menu-sort').find('.sort-checked');
			var iclass = $(sortObj).find('i').attr('class');
			if ($(sortObj).hasClass('list-menu-sort-sales')) {		
				ssort = 'sell_count|'+(iclass == ''?'desc':'asc');
			} else if ($(sortObj).hasClass('list-menu-sort-price')) {				
				ssort = 'start_price_adult|'+(iclass == ''?'desc':'asc');
			}
			return ssort;
		}
		
		// 初始化页码数据
		constructionPage('.list-page', 1, '<?php echo ($page_count); ?>', findLine, true);
		
		// 查找产品
		function findLine(pageIndex) {
			var jsonData = {
				page: pageIndex - 1,
				cds: getConditions(),
				sorts: getSorts(),
			}
			
			console.log(JSON.stringify(jsonData));
			
			$.post('<?php echo U("line/slowly");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					$('.single-row').empty();
					$('.double-row').empty();
					if (data.ds != null && data.ds != 'undefined') {
						if ($('.no-more-data').length > 0) {
							$('.no-more-data').addClass('hidden_ctrl');
						}
						
						for (var i=0; i < data.ds.length; i++) {
							var d = data.ds[i];		
							// 单排
							var lineObj = $('.template_single_row').clone(true);
							$(lineObj).removeClass('hidden_ctrl');
							$(lineObj).removeClass('template_single_row');
							$(lineObj).attr('data-id', d.id);
							
							$(lineObj).find('img').attr('src',d.img1);
							$(lineObj).find('.day').html(d.travel_day);
							$(lineObj).find('.title').html(d.title);
							$(lineObj).find('.subheading').html(d.subheading);
							$(lineObj).find('.send_word').html(d.send_word_show);
							$(lineObj).find('a').attr('href','<?php echo U("line/content");?>/id/'+ d.id);
							$(lineObj).find('.assembly').html('集合地点：'+d.assembly_point_show_text);
							$(lineObj).find('.batch').html('批次：全年'+d.batchs==null?0:$(d.batchs).length+'期');
							$(lineObj).find('.destination').html('目的地：'+d.destination_show_text);
							if (d.check_price == 0) {
								$(lineObj).find('.cut_price').parent().html('<strong class="cut_price">核算中</strong>');								
							} else {
								$(lineObj).find('.cut_price').html(d.min_batch.adult_cut+'元起');
							}
							$(lineObj).find('.travel_date').html('旅行时间： '+d.start_time+'&nbsp;至&nbsp;'+d.end_time);			
							$('.single-row').append(lineObj);
							
							// 双排
							var mLineObj = null, mRootObj = null, mContentClass = '', mImageClass = '';
							if (i % 2 == 0) {
								mRootObj = $('.template_double_row').clone(true);
								$(mRootObj).removeClass('template_double_row');
								$(mRootObj).removeClass('hidden_ctrl');
								mLineObj = $(mRootObj).find('.template_content');
								mContentClass = 'double-row-left'; 
								mImageClass = 'double-row-left-top';
							} else {
								mRootObj = $('.double-row').find('.double-row-content:last');
								mLineObj = $('.template_double_row').find('.template_content').clone(true);
								mContentClass = 'double-row-right'; 
								mImageClass = 'double-row-right-top';
							}
							
							$(mLineObj).removeClass('template_content');
							$(mLineObj).addClass(mContentClass);
							$(mLineObj).attr('data-id', d.id);
							var imgObj = $(mLineObj).find('.template_img');
							$(imgObj).removeClass('template_img');
							$(imgObj).addClass(mImageClass);
							$(imgObj).find('img').attr('src',d.img1);	
							$(mLineObj).find('.day').html(d.travel_day);
							$(mLineObj).find('.title').html(d.title);
							$(mLineObj).find('.subheading').html(d.subheading_show);
							$(mLineObj).find('.send_word').html(d.send_word_show);
							$(mLineObj).find('a').attr('href','<?php echo U("line/content");?>/id/'+ d.id);
							$(mLineObj).find('.assembly').html('集合地点：'+d.assembly_point_show_text);
							$(mLineObj).find('.batch').html('批次：全年'+d.batchs==null?0:$(d.batchs).length+'期');
							$(mLineObj).find('.destination').html('目的地：'+d.destination_show_text);
							if (d.check_price == 0) {
								$(mLineObj).find('.cut_price').parent().html('<s class="price">核算中</s><strong class="cut_price">核算中</strong>');								
							} else {
								$(mLineObj).find('.price').html(d.start_price_adult+'元');
								$(mLineObj).find('.cut_price').html(d.start_price_adult);
							}
							if (i % 2 == 0) {		
								$('.double-row').append(mRootObj);
							} else {
								$(mRootObj).append(mLineObj);
							}
						} // end for
					} else {
						if ($('.no-more-data').length > 0) {
							$('.no-more-data').removeClass('hidden_ctrl');	
						} else {
							var vhtml = '<span class="no-more-data" style="text-indent:2em;">领袖户外暂时没有你所要查询的信息，产品经理们正在努力开发线路中...</span>';
							$('.list-menu-sort').after(vhtml);
						}
					}
					
					// 判断页面总数是否发生变化  	
					constructionPage('.list-page', pageIndex, data.page_count, findLine);
					double('.double-row-left', '.double-row-left-top');
					double('.double-row-right', '.double-row-right-top');
				} else {
					console.log(data.result.message);
				}
			});
		}
		
		// 查询线路
		function refreshLine() {    	
			var thisPageIndex = $('.list-page').attr('data-page-index');
			findLine(thisPageIndex);
		}
	</script>

<script type="text/javascript">
	
//您的选择

	function less () {

		if ( $('.select-mine .select-body a').length < 2 ){

			$('.select-mine').hide();

		}

	};



	function YourChoice ( c , d) {

		$( "." + c ).find('a').click( function () {

			$('.select-mine').show();
			
			var did = $(this).attr('data-id');
			
			console.log('您选择了->id:'+did+',content:'+$(this).html());

			var myHtml = '';

			myHtml += '<a class="'+ c +'0" href="javascript:;" data-id="'+did+'">'

					+'<b class="b0">'+d+'</b>'

					+'<b class="b1">'+$(this).text()+'</b>'

					+' <span></span>'

					+'</a>';

			$('.select-mine .select-body' + ' .' + c + '0' ).remove();

			$('.select-mine .select-body').prepend(myHtml);

			refreshLine();

		} );

	};



	//景点的选择

	$('.select-jd a').click( function () {

		if ($('.select-checkbox').css('display') != 'none') {

			$('.select-mine').show();

			var myHtml = '';

			myHtml += '<a class="select-jd0" href="javascript:;">'

					+'包含景点-'

					+'<b class="b1">'+$(this).text()+'</b>'

					+' <span></span>'

					+'</a>';

			$('.select-mine .select-body .select-jd0').remove();

			$('.select-mine .select-body').prepend(myHtml);

			refreshLine();

		}else {

			return false;

		}

	} );

	//去除

	$(document).on('click', '.select-mine .select-body a span', function () {

		$(this).parent().remove();

		less();

		refreshLine();

	});

	//清楚所有

	$('.select-clear').click( function () {

		$(this).siblings('a').remove();

		$('.select-mine').hide();

		refreshLine();

	} );

	//非多选的选择

	YourChoice('select-cpzt', '产品主题-');
	
	YourChoice('select-cpqy', '产品区域-');

	YourChoice('select-cfd', '集合地-');

	YourChoice('select-mdd', '目的地-');

	YourChoice('select-lxsj', '旅行时间-');

	YourChoice('select-xcts', '行程天数-');

	//多选

	$('.select-checkbox').click( function () {

		$(this).parents('li').find('.multiselect a .multiselect-span').removeClass('checked');

		$(this).parents('li').find('.multiselect a .multiselect-span').toggleClass('multiselect-hide');

		$(this).hide();

		$(this).next().html('收起<i class="close-more"></i>');

		$(this).parents('li').find('.select-list').css({ "overflow": "auto", "height": "74px" });

		$(this).parents('li').find('.btns').removeClass('btn-hide');

	} );

	//勾选

	$('.multiselect a').click( function () {

		$(this).children('.multiselect-span').toggleClass('checked');

	} );

	//取消

	$('.btn-cancel').click( function () {

		$(this).parents('li').find('.select-checkbox').show();

		$(this).parent('.btns').addClass('btn-hide');

		$(this).parents('li').find('.multiselect a .multiselect-span').addClass('multiselect-hide');

	} );

	//确定

	$('.btn-submit').click( function () {

		if ( !$(this).parents('li').find('.multiselect a .multiselect-span').hasClass('checked') ){

			alert('请至少选择其中一项');

			return false;

		}else {

			$('.select-mine .select-body .select-jd0').remove();

			$('.select-mine').show();

			$('.checked').each( function () {

				var myHtml = '';

				myHtml += '<a class="select-jd0" href="javascript:;">'

						+'包含景点-'

						+'<b class="b1">'+$(this).next().text()+'</b>'

						+' <span></span>'

						+'</a>';

				$('.select-mine .select-body').prepend(myHtml); 

			} );

			$(this).parents('li').find('.multiselect a .multiselect-span').removeClass('checked');

			$(this).parents('li').find('.multiselect a .multiselect-span').addClass('multiselect-hide');

			$(this).parents('li').find('.select-checkbox').show();

			$(this).parent('.btns').addClass('btn-hide');

			refreshLine();

		}

	} );

	//更多

	$('.select-more01').click( function () {	

		if( $(this).children('i').hasClass('show-more') ) {

			$(this).children('i').remove();

			$(this).parents('li').find('.select-list').css({ "overflow": "auto", "height": "74px" });

			$(this).html('收起<i class="close-more"></i>');

		}else {

			$(this).parents('li').find('.select-list').css({ "overflow": "hidden", "height": "37px" });

			$(this).html('更多<i class="show-more"></i>');

			$(this).parents('li').find('.multiselect a .multiselect-span').removeClass('checked');

			$(this).parents('li').find('.multiselect a .multiselect-span').addClass('multiselect-hide');

			$(this).parents('li').find('.select-checkbox').show();

			$(this).parents('li').find('.btns').addClass('btn-hide');

		}

	} );



	//显示更多

		function ShowMore ( b ) {

			$( b ).click( function () {	

				if( $(this).children('i').hasClass('show-more') ) {

					$(this).children('i').remove();

					$(this).parents('li').find('.select-list').css({ "overflow": "auto", "height": "74px" });

					$(this).html('收起<i class="close-more"></i>');

				}else {

					$(this).parents('li').find('.select-list').css({ "overflow": "hidden", "height": "37px" });

					$(this).html('更多<i class="show-more"></i>');

				}

			} );

		};

		ShowMore('.select-more02');

	//查看更多选项

		$('.select-up-down').click( function () {

			if( $('.select-hide').css('display') == 'none' ) {

				$(this).children('span').remove();

				$(this).html('<span>收起更多选项<i class="close-more"></i></span>');

			}else {

				$(this).html('<span>查看更多选项<i class="show-more"></i></span>');

			}

			$('.select-hide').slideToggle();

		} );

//列表菜单

	//菜单排序

	$('.list-menu-sort-comprehensive').click ( function () {

		$(this).addClass('sort-checked');

		$(this).siblings().removeClass('sort-checked');

		refreshLine();

	} );

	$('.list-menu-sort-sales').click( function () {

		$(this).children('i').toggleClass('sort-sales');

		$(this).addClass('sort-checked');

		$(this).siblings().removeClass('sort-checked');

		refreshLine();

	} );

	$('.list-menu-sort-price').click( function () {

		$(this).children('i').toggleClass('sort-price');

		$(this).addClass('sort-checked');

		$(this).siblings().removeClass('sort-checked');

		refreshLine();

	} );

	$('.list-menu-sort-x').click( function () {

		$(this).children('i').toggleClass('sort-x');

		$(this).siblings().children('i').removeClass('sort-y');

		$('.single-row').hide();

		$('.double-row').show();

	} );

	$('.list-menu-sort-y').click( function () {

		$(this).children('i').toggleClass('sort-y');

		$(this).siblings().children('i').removeClass('sort-x');

		$('.single-row').show();

		$('.double-row').hide();

	} );





	//双排菜单效果

	function double( h, i ) {

		$(h).hover( 

			function () {		

				$(this).children(i).stop().animate({top: '-90px'}, 500);

				$(this).children('.double-row-describe').find('p').stop().animate({opacity: '1'}, 500);

				$(this).children('.double-row-describe').stop().animate({top: '258px'}, 1000);

			},

			function () {

				$(this).children(i).stop().animate({top: '0'}, 500);

				$(this).children('.double-row-describe').find('p').stop().animate({opacity: '0'}, 500);

				$(this).children('.double-row-describe').stop().animate({top: '348px'}, 1000);

				

			}

		);

	}

	double('.double-row-left', '.double-row-left-top');

	double('.double-row-right', '.double-row-right-top');
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
<!-- 头部js -->
<script src="http://kllife.com/source/Static/home/js/unslider.min.js"></script>
<script src="http://kllife.com/source/Static/home/common/js/showAndHide.js"></script>
<script src="http://kllife.com/source/Static/home/common/js/headroom.js"></script>