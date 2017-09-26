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
	<!-- 引用jq -->
	<script src="/source/Static/home/common/js/jquery-1.11.3.min.js"></script>

	<!-- 日历 -->

	<link rel="stylesheet" href="/source/Static/home/common/css/jcDate.css">

	<!-- 私有样式 -->

	<link rel="stylesheet" href="/source/Static/home/css/content.css">
	
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

	<!-- 日历项模板 -->	

	<div class="information template_date_item hidden_ctrl">

		<img src="/source/Static/home/images/content_img/yellow_arrow_bottom.png" alt="" />

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

	<div class="enrol-mark"></div>

	<div class="enrol-list">

		<a class="close-enrol-list" href="javascript:;">

			<img src="/source/Static/home/images/content_img/close_enrol.png" alt="">

		</a>

		<a class="backTop-enrol-list" href="javascript:;">

			<img src="/source/Static/home/images/content_img/top_enrol.png" alt="">

		</a>

		<h2>报名列表 >> 【北疆金秋】喀纳斯-白哈巴-禾木-五彩滩-魔鬼城-可可托海 9日深度游</h2>

		<div class="enrol-list-content">

			<div class="enrol-list-content-head">

				<span>用户昵称</span><span>地区</span><span>申请人数</span><span>报名时间</span><span>审核状态</span>

			</div>

			<table>

				<thead>

					<tr>

						<th colspan="5">2016.09.10(周)--2016.09.18(周) 成人：4280.00元 (第1批)</th>

					</tr>

				</thead>

				<tbody>

					<tr>

						<td>鱼头1232009</td>

						<td>香港特别行政区</td>

						<td>5人</td>

						<td>2016-08-16</td>

						<td></td>

					</tr>

				</tbody>

			</table>

		</div>

	</div>



	<!-- 主要内容 -->

	<div id="content">

		<!-- 面包屑导航 -->

		<div class="bread-nav">

			<u>
				
							
				<?php $themeClasses=array('shendu','sheying','zhuti') ?>
				
				<?php if(is_array($line["theme_type_list"])): $i = 0; $__LIST__ = $line["theme_type_list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$theme): $mod = ($i % 2 );++$i; $theme_class = $themeClasses[$key % count(themeClasses)] ?>

					<a class="<?php echo ($theme_class); ?>" href="javascript:;"><?php echo ($theme["type_desc"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
				
				产品编号：<?php echo ($line["id"]); ?>
				
				<?php if($line["extra"] == 1): ?><span>本产品由领袖户外或领袖户外委托有资质的合作旅行社及户外机构提供相关服务<span>
				<?php else: ?>
				<span>本产品由领袖户外提供相关服务<span><?php endif; ?>
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

				<div class="travel-overview-right-content">

					<div class="right-content-top">

						<h2><?php echo ($line["title"]); ?></h2>

						<h3><?php echo ($line["subheading"]); ?></h3>

						<div class="right-content-money">

							<span>

								<?php if(empty($line['min_batch'])): ?>￥<strong>0</strong>元/成人

									<i>(0/儿童)</i>

								<?php else: ?>

									￥<strong><?php echo ($line["min_batch"]["adult_cut"]); ?></strong>元/成人

									<i>(<?php echo ($line["min_batch"]["child_cut"]); ?>/儿童)</i><?php endif; ?>	

							</span>

							<a href="javascript:;">起价说明</a>

							<div class="qj-explain">

								<img src="/source/Static/home/images/content_img/yellow_arrow_top.png" alt="">

								<div class="qj-explain-content">

									<h6>起价说明</h6>

									<p><?php echo ($line["start_price_explain"]); ?></p>

									<a href="javascript:;">查看详情</a>

								</div>

							</div>

						</div>

					</div>

				</div>

				<div class="right-content-bottom">

					<?php if(empty($line['min_batch'])): ?><p><i class="ctrs"></i><b>成团人数：</b>0人</p>

					<?php else: ?>

						<p><i class="ctrs"></i><b>成团人数：</b><?php echo ($line["min_batch"]["car_member"]); ?>人</p><?php endif; ?>

					<?php if(empty($line['assembly_point_show_text'])): ?><p><i class="jhdd"></i><b>集合地点：</b><?php echo ($line["assembly_point_show_text"]); ?></p>

					<?php else: ?>

						<p><i class="jhdd"></i><b>集合地点：</b>全国各地</p><?php endif; ?>

					<p><i class="rcsj"></i><b>日程时间：</b><?php echo ($line["start_time"]); ?>-<?php echo ($line["end_time"]); ?></p>

					<div id="xlcjl">

						<i class="xlcjl"></i><a href="javascript:;">线路成交量</a>：<?php echo ($line["sell_count"]); ?>

						<!-- 滚动报名 -->

						<div class="swiper_wrap">

							<ul class="font_inner">

								<li><a href="javascript:;">用户***810预订<帕劳订机票送帛琉大饭店5晚6</a></li>

								<li><a href="javascript:;">用户***211预订<帕劳订机票送太平洋酒店5晚6</a></li>

								<li><a href="javascript:;">用户***liu预订<帕劳三日出海游></a></li>

								<li><a href="javascript:;">用户***liu预订<帕劳订机票送帛琉大饭店5晚6</a></li>

							</ul>

						</div>

					</div>

					<p id="cpjy"><i class="cpjy"></i><span><b>产品寄语：</b><?php echo ($line["send_word"]); ?></span></p>

					<p id="xcgy"><i class="xcgy"></i><span><b>行程概要：</b>

						<?php $travelCount = count($line['travels']); foreach($line['travels'] as $tk=>$travel){ echo('D'.($tk+1).' > <u>'.$travel['view_point'].'</u>'); } ?>

					<div id="cfrq">

						<i class="cfrq"></i><b>出发日期：</b>

						<div class="cfrq-choose">

							<span class="cfrq_select_batch" data-id="0">请选择出发日期</span>

							<div class="cfrq-show hidden_ctrl">

								<u>未知时间</u>出发

								,

								<u>未知时间</u>返回

							</div>

							<img src="/source/Static/home/images/content_img/down.png" alt="">

							<ul class="cfrq_batch_list">

								<?php foreach($line['batchs'] as $bk=>$bv) { echo('<li data-id="'.$bv['id'].'" data-val="'.$bv['start_date_show'].'" data-end-date="'.$bv['end_date_show'].'">'.$bv['start_date_show'].'['.$bv['state_data']['type_desc'].']</li>'); } ?>

							</ul>

						</div>

					</div>

					<div id="cyrs">

						<i class="cyrs"></i><b>出游人数：</b>

						<div class="adult-num adult_male">
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
						</div>
						<div class="children-num">
							<u>儿童</u>
							<a class="add-children" href="javascript:;"><i class="children-add"></i></a>
							<span>0</span>
							<a class="minus-children" href="javascript:;"><i class="children-minus"></i></a>
						</div>

					</div>

					<div class="immediate-reservation">

						<p><img src="/source/Static/home/images/content_img/tel.png" alt=""></p>
						
						<span><img src="/source/Static/home/images/content_img/zixun.gif" alt=""></span>

						<a class="book_order_now" href="javascript:;">立即预定</a>
						
						<div>本产品在线咨询讨论QQ群：<em><?php echo ($line["seek_qq"]); ?></em></div>

					</div>

					<div class="srdz">

						<a href="<?php echo ($pcset["team_link"]); ?>" target="_blank"><img src="/source/Static/home/images/content_img/content_srdz.gif" alt=""></a>

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

			<a class="content-list-to-attention" href="#content-money">费用说明</a>

			|

			<a class="content-list-to-visa" href="#content-reserve">预定须知</a>

			|

			<a class="content-list-to-scenery" href="#content-scenery">沿途风光</a>

			|

			<a class="content-list-to-question" href="#ask-question">产品问答</a>

			<a class="content-list-to-reserve" href="">立即预定</a>

		</div>

	</div>



	<!-- 行程亮点 -->

	<div class="travel-highlights">

		<h3 id="travel-highlights">行程亮点</h3>

		<div style="width: 100%; overflow: hidden;">

			<?php if(is_array($line["points"])): $i = 0; $__LIST__ = $line["points"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lp): $mod = ($i % 2 );++$i; if($lp["content"] != ''): ?><p><?php echo ($lp["content"]); ?></p><?php endif; ?>

				<?php if($lp["image_url"] != ''): ?><img src="<?php echo ($lp["image_url"]); ?>" alt=""><?php endif; endforeach; endif; else: echo "" ;endif; ?>

		</div>

	</div>

	

	<!-- 行程说明 -->

	<div class="travel-arrangements">

		<div class="travel-arrangements-content">

			<h3 id="travel-arrangements">行程说明</h3>

			<div class="travel-arrangements-list">

				<span>

					<img src="/source/Static/home/images/content_img/travel_arrangements_day_begin.png" alt="">

				</span>

				——

				<?php $__FOR_START_760775743__=1;$__FOR_END_760775743__=$line['real_travel_day'];for($i=$__FOR_START_760775743__;$i <= $__FOR_END_760775743__;$i+=1){ ?><a class="day<?php echo ($i); ?>" href="#day<?php echo ($i); ?>">

						<p><?php echo ($i); ?></p>

						Day

					</a>

					——<?php } ?>

				<span>

					<img src="/source/Static/home/images/content_img/travel_arrangements_day_end.png" alt="">

				</span>

			</div>

			<div class="travel-arrangements-alldays">

				<input id="travel_day" type="hidden" value="<?php echo ($line["real_travel_day"]); ?>"/>

				<?php if(is_array($line["travels"])): $i = 0; $__LIST__ = $line["travels"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$travel): $mod = ($i % 2 );++$i;?><div id="day<?php echo ($travel["day_id"]); ?>" class="travel-arrangements-days">

						<h4>Day<?php echo ($travel["day_id"]); ?>：<?php echo ($travel["title"]); ?></h4>
						
						<span><i class="days-zd"></i>浏览重点：<?php echo ($travel["view_point"]); ?></span>

						<p><?php echo ($travel["intro"]); ?></p>

						<div class="days-information">

							<span><i class="days-zs"></i>住宿：<?php echo ($travel["hotal"]); ?></span>

							<span><i class="days-cy"></i>餐饮：<?php echo ($travel["eat_way"]); ?></span>


						</div>

						<div class="days-prompt">

							<span><i class="days-ts"></i>温馨提示：</span>

							<div class="prompt"><?php echo ($travel["kindly_reminder"]); ?></div>

						</div>

						<div class="days-img">							

							<div class="days-img-left">

								<img src="<?php echo ($travel["img1"]); ?>" alt="">

								<p><?php echo ($travel["img1_desc"]); ?></p>

							</div>

							<div class="days-img-left">

								<img src="<?php echo ($travel["img2"]); ?>" alt="">

								<p><?php echo ($travel["img2_desc"]); ?></p>

							</div>
							
							<div class="days-img-left">

								<img src="<?php echo ($travel["img3"]); ?>" alt="">

								<p><?php echo ($travel["img3_desc"]); ?></p>

							</div>

						</div>

					</div><?php endforeach; endif; else: echo "" ;endif; ?>

			</div>

		</div>	

	</div>

	<!-- 游记攻略 -->

	<div class="travel-notes">

		<h3 id="travel-notes">游记攻略</h3>

		<div class="travel-notes-lunbo">

			<ul>
				
				<?php $__FOR_START_198375601__=1;$__FOR_END_198375601__=3;for($k=$__FOR_START_198375601__;$k <= $__FOR_END_198375601__;$k+=1){ $youji = json_decode($line['youji'.$k], true); ?>
					
					<li>
					
						<a href="<?php echo ($youji["url"]); ?>"></a>
						
						<img src="<?php echo ($youji["img"]); ?>" alt="">

						<div class="notes-describe">

							<h3><?php echo ($youji["title"]); ?></h3>

							<div class="notes-xx">

								<p><?php echo ($youji["desc"]); ?></p>

							</div>

						</div>

					</li><?php } ?>
				
			</ul>

		</div>

	</div>

	<!-- 费用说明 -->

	<div class="content-money">

		<h3 id="content-money">费用说明</h3>

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
				
					<p style="padding: 10px 0; color: #00f;">公告：领袖户外的行程安排可能会根据实际突发情况和队员反馈进行调整和优化，但调整不会涉及费用包含的景区、游览天数、集散地点以及住宿标准，最终行程安排以合同内容为准。
</p>

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

	<!-- 产品提问 -->

	<!-- 产品提问 -->

	<div class="question-answer template_question" style="display: none;">

		<div class="question">

			<i class="good"></i>

			<span><a class="question_content" href=""></a></span>

			<u class="question_time"></u>

		</div>

		<div class="answer">

			<i class="question_agree">0</i>

			<span class="answer_content"></span>

			<u class="answer_time"></u>

		</div>

	</div>

	<div class="ask-question">

		<h3 id="ask-question">产品提问</h3>

		<div class="question-content">

			<div class="seacrch-question">

				<input id="question_content" type="text" placeholder="输入你的问题..."><a class="ask_question" href="javascript:;">提问</a>

			</div>

			<div class="question-list">

				<div class="question-choose">

					<a class="question-help question-checked" href="javascript:;">最有帮助</a>

					|

					<a class="question-new" href="javascript:;">最新</a>

				</div>

				<div>

					<div class="question-answer-list question-help-content">

					</div>

					<div class="question-answer-list question-new-content">
					
					</div>

				</div>

			</div>

			<div class="question-all-look">

				<a href="javascript:;">查看更多已回答的问题>></a>

			</div>

		</div>

	</div>




	

	<!-- 滚动 -->
	<script src="/source/Static/home/js/gundong.js"></script>

	<script src="/source/Static/common/js/functions.js"></script>
	<!-- 日期 -->
	<script src="/source/Static/home/common/js/jQuery-jcDate.js"></script>
	<!-- 轮播 -->
	<script src="/source/Static/home/js/unslider.min.js"></script>
	<!-- 自绑定 -->
	<script src="/source/Static/home/common/js/showAndHide.js"></script>

	
</body>
</html>



	<script>
	
		// 立即预定
		$('.book_order_now').click(function(){
			
			alert('预览页不能下单哦');
			
			return false;
			
			var batchId = $('.cfrq_select_batch').attr('data-id');
			
			if (batchId == '0') {
				
				alert('请选择出行的日期');
				
				return false;
				
			}
			
			var male = parseInt($('.adult_male').find('span').html());
			
			var woman = parseInt($('.adult_woman').find('span').html());
			
			var child = parseInt($('.children-num').find('span').html());
			
			if ((male + woman + child) == 0) {
				
				alert('出行的总人数不能小于1人');
				
				return false;
				
			}
						
			location.href = '<?php echo U('line/order');?>'+'/id/<?php echo ($line["id"]); ?>/type/create/b/'+batchId+'/m/'+male+'/w/'+woman+'/ch/'+child;
			
		});
		
		// 批次列表选择跳转
		$('.cfrq_batch_list').find('li').click(function(){			
		
			$('.cfrq_select_batch').attr('data-id', $(this).attr('data-id'));
			
			$('.cfrq_select_batch').html($(this).html());
			
			$('.cfrq-show').removeClass('hidden_ctrl');			
			
			var uObj = $('.cfrq-show').find('u');
			
			$(uObj[0]).html($(this).html());
			
			$(uObj[1]).html($(this).attr('data-end-date'));
			
		});
		
	
		// 页面加载完成
		$(document).ready(function(){
			
			var schedule = '<?php echo ($schedule); ?>';
			
			if (schedule != 'undefined') {
				
				$('html, body').stop().animate({scrollTop: $('.travel-arrangements-content').offset().top - 160 }, 0);
				
			}
			
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
			
			var sy = '>=,'+y+'-01-01 00:00:00';
			
			var ey = '<=,'+y+'-12-31 23:59:59';
			
			$.post('<?php echo U("line/batch");?>', {op_type:'list',line_id: lineId, start:sy, end:ey}, function(data){

				if (data.result.errno == 0) {

					var batchs = new Object();
					
					if (data.ds != null && typeof(data.ds) != 'undefined') {						
					
						for (var i = 0; i < data.ds.length; i++) {
							
							var d = data.ds[i];
							
							var tempDate = new Date(Date.parse(d.start_time.replace(/-/g,"/")));
							
							var td = tempDate.getFullYear()+'-'+(tempDate.getMonth()+1)+'-'+tempDate.getDate();	
													
							batchs[td] = d; 
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

							$(itemObj).find('.information-money').html(b.price_adult+'元');

							var state = $.parseJSON(b.state);

							$(itemObj).find('.information-state').html(state.type_desc);

							$(itemObj).find('.adult-money').html(b.price_adult);

							$(itemObj).find('.children-money').html(b.price_child);			
														
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
					
					$(dObj[0]).html($(this).html());
					
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

		

		$('.qj-explain').hover( 

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

		

		//精彩专题

		$('.special-exhibition').unslider({ 

			dots: true

		});

		$('.special-exhibition-product').fadeInAndOut('special-img', 'div');

		

		//专业保证

		var unslider01 = $('.professional-guarantee-slide').unslider({

			dots: true

		}),

		data04 = unslider01.data('unslider');

		$('.unslider-arrow01').click( function() {

	        var fn = this.className.split(' ')[1];

	        data04[fn]();

	    });

	    

	    //提问
		$(document).on('click','.question i',function(){
			$(this).addClass('question-zan');
			var zanNum = parseInt($(this).parents('.question-answer').children('.answer').find('i').html());		
			zanNum++;
			$(this).parents('.question-answer').children('.answer').find('i').html(zanNum);
		})

	    
		
		var question_help_end = false, question_new_end = false;
		
	    $('.question-choose a').click( function () {

	    	$(this).addClass('question-checked');

	    	$(this).siblings().removeClass('question-checked');
	    	
	    	// 切换page页面
	    	changeQuestionPage();
	    	
	    });

	    $('.question-help').clickShow('.question-help-content');

		$('.question-new').clickShow('.question-new-content');
		
		// 提问
		$('.ask_question').click(function(){
			
			var lineId = '<?php echo ($line["id"]); ?>';
			
			var jsonData = {
				
				op_type: 'create_question',
				
				line_id: lineId,
				
				content: $('#question_content').val(),
				
			}
			
			$.post('<?php echo U("line/question");?>', jsonData, function(data){					
									
				if (data.result.errno != 0) {
					
					if (data.jumpUrl != null) {
						
						location.href = data.jumpUrl;
												
					}	
									
				} else {
					
					$('#question_content').val('');
					
				}
					
				alert(data.result.message);
				
			});
			
		});
		

		
		// 获取问题列表
		function changeQuestionPage() {
			
			var lineId = '<?php echo ($line["id"]); ?>';
			
			var containerObj = $('.question-checked').hasClass('question-help') ? '.question-help-content' : '.question-new-content';
			
			var questType = $('.question-checked').hasClass('question-help') ? 'help' : 'new';
			
			var jsonData = {
				
				op_type: 'preview',
				
				query_type: questType,
				
				start: $(containerObj).find('.question-answer').length,
				
				line_id: lineId,
				
			}
			
			$.post('<?php echo U("line/question");?>', jsonData, function(data){
				
				if (data.result.errno == 0) {
					
					console.log(data.sql);
					
					if (data.ds != null && data.ds != 'undefined') {
						
						for (var i = 0; i < data.ds.length; i ++) {
							
							var d = data.ds[i];
					
//							console.log('q1_id:' + d.q1_id + ',q1_create_time:' + d.q1_create_time + ',q1_time_show:' + JSON.stringify(d.q1_time_show));							
//							
//							console.log('q2_id:' + d.q2_id + ',q2_create_time:' + d.q2_create_time + ',q2_time_show:' + JSON.stringify(d.q2_time_show));
						
							var rootObj = $('.template_question').clone();
							
							$(rootObj).removeClass('template_question');
							
							$(rootObj).addClass('question-answer');
							
							$(rootObj).addClass(i % 2 == 0 ? 'question-answer-left' : 'question-answer-right');
							
							$(rootObj).css('display', 'block');
							
							$(rootObj).find('.good').attr('data-id', d.q1_id);							
							
							$(rootObj).find('.question_content').html(d.q1_content_show);
							
//							$(rootObj).find('.question_content').attr('href', '<?php echo U("service/question");?>/id/'+d.q1_id);
														
							$(rootObj).find('.question_time').html(d.q1_time_show.ago_show_text);
							
							$(rootObj).find('.question_agree').html(d.q1_agree);
							
							$(rootObj).find('.answer_content').html(d.q2_content);
							
							$(rootObj).find('.answer_time').html(d.q2_time_show.ago_show_text);
							
							$(rootObj).find('.good').click(agreementQuestion);
							
							$(containerObj).append(rootObj);
							
						}
												
						$('.question-all-look').find('a').removeClass('no_more');
						
    					$('.question-all-look').find('a').html('查看更多已回答的问题');
						
					} else {				
						
						$('.question-all-look').find('a').addClass('no_more');
						
    					$('.question-all-look').find('a').html('没有更多问题可供查看');
	    					
					}
					
				} else {
					
					console.log(data.result.message);
					
					if (data.jumpUrl != null) {
						
						location.href = data.jumpUrl;
						
					}	
									
				}	
				
			});
			
		}
		
		// 点击翻页
		$('.question-all-look').find('a').click(function(){
			
			if ($(this).hasClass('no_more') == false) {
				
				changeQuestionPage();
				
			}		
			
		});
		
		// 问题点赞
		function agreementQuestion() {
			
			alert('预览页不允许其他操作');
			
			return falsel
		}
		
		// 初始化线路问题
		$(document).ready(function(){
			
			// 初始化线路问题
			changeQuestionPage();
			
		});		

		//报名列表弹出框

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
			$(".font_inner li:eq(0)").clone(true).appendTo($(".font_inner"));
			//克隆第一个放到最后(实现无缝滚动)
			var liHeight = $(".swiper_wrap").height();
			//一个li的高度
			//获取li的总高度再减去一个li的高度(再减一个Li是因为克隆了多出了一个Li的高度)
			var totalHeight = ($(".font_inner li").length *  $(".font_inner li").eq(0).height()) -liHeight;
			$(".font_inner").height(totalHeight);
			//给ul赋值高度
			var index = 0;
			var autoTimer = 0;
			//全局变量目的实现左右点击同步
			var clickEndFlag = true; 
			//设置每张走完才能再点击
			function tab(){
				$(".font_inner").stop().animate({
					top: -index * liHeight
				},400,function(){
					clickEndFlag = true;
					//图片走完才会true
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
					index = $(".font_inner li").size() - 2;
					//因为index的0 == 第一个Li，减二是因为一开始就克隆了一个LI在尾部也就是多出了一个Li，减二也就是_index = Li的长度减二
					$(".font_inner").css("top",- ($(".font_inner li").size() -1) * liHeight);
					//当_index为-1时执行这条，也就是走到li的最后一个
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