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
<style>
	.vui-slider .vui-item{background: #333;text-align: center;text-align: -webkit-center;}\
	.left-aside {
		position: fixed;
		top: 300px;
		left: 13%;
		width: 100px;
		height: 404px;
		display: none;
	}
</style>
<!--产品编号-->
<div class="product-number">
    <span class="orange" style="padding:10px 0px;">产品编号：<?php echo ($line["id"]); ?></span>
    <span style="padding:10px 0px;">本产品由每刻美跟拍游独立策划并独立发团 <span id="block" style="cursor: pointer;"><img src="http://kllife.com/source/Static/qinglvpai/images/index/careful.png" alt="领袖户外"></span></span>
	<span id="none" style="position: relative;display:none;">
		<span style="background: #f3f5f7;padding:10px 5px;margin-left:10px;">每刻美是领袖户外旗下专注于女性旅行的子品牌，是跟拍游的开创者。</span>
		<span style="position: absolute;top:7px;left:3px;width:0;height:0;border-top:10px solid transparent;border-bottom:10px solid transparent;border-right:10px solid #f3f5f7;"></span>
	</span>
</div>
<!--产品详情-->
<div style="background:#f3f5f7;" id="product-detail">
    <div class="product-detail">
        <div class="left">
            <img class="img-responsive" src="<?php echo ($line["img1"]); ?>" alt="领袖户外">
        </div>
        <div class="right">
            <h2><?php echo ($line["title"]); ?></h2>
            <h4><?php echo ($line["subheading"]); ?></h4>
            <div class="div"><span class="price">￥<?php echo ($line["start_price_adult"]); ?></span>元起  <span style="padding-left:20px;">(<?php echo ($line["start_price_child"]); ?>元起/儿童)</span></div>
            <div class="div div1">成团人数：<span><?php echo ($line["success_team_count"]); ?></span>人 &nbsp;&nbsp; 满团人数：<span><?php echo ($line["max_team_count"]); ?></span>人</div>
            <div class="div div1">集合地点：<span><?php echo ($line["assembly_point_show_text"]); ?></span></div>
            <div class="div div1 volume">
                <div>线路成交量：<span><?php echo ($order_count); ?></span></div>
                <ul class="font_inner">
					<?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order_list): $mod = ($i % 2 );++$i; if(is_array($order_list["data"])): $i = 0; $__LIST__ = $order_list["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><li><a href="javascript:;">用户<?php echo ($order["mob_show"]); ?>预订<?php echo ($order["hdid_start_date"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="message">产品寄语：<?php echo ($line["send_word"]); ?></div>
            <div class="time-number">
                <div class="time">
                    <span>出发日期：</span>
                    <select name="select_batch" id="select_batch">
                        <option value="0">请选择出发日期</option>
						<?php foreach($line['batchs'] as $bk=>$bv) { echo('<option value="'.$bv['id'].'">'.$bv['start_date_show'].'['.$bv['state_data']['type_desc'].']</option>'); } ?>
                    </select>
                </div>
                <div class="number">
                    <span class="span">出游人数：</span>
                    <div>
						<?php if(empty($check['only_child']) == true): ?><div class="man">
	                            <span class="span-two">成人男</span>
	                            <div>
	                                <span class="reduce">-</span>
	                                <span class="number">0</span>
	                                <span class="add">+</span>
	                            </div>
	                        </div>
	                        <div class="woman">
	                            <span class="span-two">成人女</span>
	                            <div>
	                                <span class="reduce">-</span>
	                                <span class="number">0</span>
	                                <span class="add">+</span>
	                            </div>
	                        </div><br/><?php endif; ?>		
						<?php if(empty($check['only_adult']) == true): ?><div class="children">
	                            <span class="span-two">儿&nbsp;&nbsp;&nbsp;童</span>
	                            <div>
	                                <span class="reduce">-</span>
	                                <span class="number">0</span>
	                                <span class="add">+</span>
	                            </div>
	                        </div><?php endif; ?>
                    </div>
                </div>
            </div>
			<p>本产品在线咨询讨论QQ群：<?php echo ($line["seek_qq"]); ?></p>
            <div class="consult">
                <img class="tel" src="http://kllife.com/source/Static/qinglvpai/images/index/tel.png" alt="领袖户外">
                <div class="reserve">
                    <a href="<?php echo ($pcset["askfor_link"]); ?>" target="_blank"><img src="http://kllife.com/source/Static/qinglvpai/images/index/zx2.gif" alt="领袖户外"></a>
                    <a type="button" class="btn btn-orange book_order_now">立即预定</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--行程亮点-->
<div class="highlights" id="liangdian">
    <h2 class="tit">行程亮点</h2>
    <div class="border-bottom"><!-此div只用于显示birder-></div>
	<div>
		<?php if(is_array($line["points"])): $i = 0; $__LIST__ = $line["points"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$point): $mod = ($i % 2 );++$i; if($point["image_url"] != ''): ?><a href="javascript:;"><img src="<?php echo ($point["image_url"]); ?>" style="width: 1000px;" alt="领袖户外"></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
	</div>
    </div>
</div>

<!--行程说明-->
<div class="highlights explain" id="shuoming">
    <h2 class="tit">行程说明</h2>
    <div class="border-bottom"><!-此div只用于显示birder-></div>
	<?php if(is_array($line["travels"])): $i = 0; $__LIST__ = $line["travels"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$travel): $mod = ($i % 2 );++$i; if($key == 0): ?><div class="module">
		<?php else: ?>
	    <div class="module module-two"><?php endif; ?>
        	<?php if($key % 2 == 0): ?><div class="left">
	        		<?php if(empty($travel['img1']) == false): ?><a href="javascript:;"><img src="<?php echo ($travel['img1']); ?>" style="width: 600px;height: 450px;" alt="领袖户外"></a>
	        		<?php elseif(empty($travel['img2']) == false): ?>
	        			<a href="javascript:;"><img src="<?php echo ($travel['img2']); ?>" style="width: 600px;height: 450px;" alt="领袖户外"></a>
	        		<?php elseif(empty($travel['img3']) == false): ?>
	        			<a href="javascript:;"><img src="<?php echo ($travel['img3']); ?>" style="width: 600px;height: 450px;" alt="领袖户外"></a>
	        		<?php else: ?>
	        			<a href="javascript:;"><img style="width: 600px;height: 450px;" alt="领袖户外"></a><?php endif; ?>
		        </div>
        		<div class="right">
					<?php if($key == 0): ?><div class="active" style="background:#ff1c77">
					<?php else: ?>
		            <div class="active"><?php endif; ?>
		                <h2>Day<?php echo ($travel["day_id"]); ?>：<?php echo ($travel["title"]); ?></h2>
						<?php if(!empty($travel["view_point"])): ?><h4>游览重点：<?php echo ($travel["view_point"]); ?></h4><?php endif; ?>
		                <p class="show height"><?php echo ($travel["intro"]); ?></p>
		                <h4>
		                	<?php if(!empty($travel["hotel"])): ?>住宿：<?php echo ($travel["hotel"]); endif; ?>						
							<?php if(!empty($travel["eat_way"])): ?>餐饮：<?php echo ($travel["eat_way"]); endif; ?>
						</h4>
						<?php if(!empty($travel["kindly_reminder"])): ?><div class="prompt activ">温馨提示：<br/><span><?php echo ($travel["kindly_reminder"]); ?></span></div><?php endif; ?>
		            </div>
					<span class="none"><i class="iconfontyyy">&#xe610;</i></span>
		            <i class="iconfontyyy left-top">&#xe609;</i>
        		</div>
        	<?php else: ?>
        		<div class="right">
		            <div class="active">
		                <h2>Day<?php echo ($travel["day_id"]); ?>：<?php echo ($travel["title"]); ?></h2>						
						<?php if(!empty($travel["view_point"])): ?><h4>游览重点：<?php echo ($travel["view_point"]); ?></h4><?php endif; ?>
		                <p class="show height"><?php echo ($travel["intro"]); ?></p>
		                <h4>
		                	<?php if(!empty($travel["hotel"])): ?>住宿：<?php echo ($travel["hotel"]); endif; ?>						
							<?php if(!empty($travel["eat_way"])): ?>餐饮：<?php echo ($travel["eat_way"]); endif; ?>
						</h4>
						<?php if(!empty($travel["kindly_reminder"])): ?><div class="prompt">温馨提示：<br/><span><?php echo ($travel["kindly_reminder"]); ?></span></div><?php endif; ?>
		            </div>
					<span class="none"><i class="iconfontyyy">&#xe610;</i></span>
		            <i class="iconfontyyy left-top">&#xe609;</i>
        		</div>
		        <div class="left">
	        		<?php if(empty($travel['img1']) == false): ?><a href="javascript:;"><img src="<?php echo ($travel['img1']); ?>" style="width: 600px;height: 450px;" alt="领袖户外"></a>
	        		<?php elseif(empty($travel['img2']) == false): ?>
	        			<a href="javascript:;"><img src="<?php echo ($travel['img2']); ?>" style="width: 600px;height: 450px;" alt="领袖户外"></a>
	        		<?php elseif(empty($travel['img3']) == false): ?>
	        			<a href="javascript:;"><img src="<?php echo ($travel['img3']); ?>" style="width: 600px;height: 450px;" alt="领袖户外"></a>
	        		<?php else: ?>
	        			<a href="javascript:;"><img style="width: 600px;height: 450px;" alt="领袖户外"></a><?php endif; ?>
		        </div><?php endif; ?>
	    </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<!--费用详情、预定须知-->
<div class="expense-details">
    <div class="tit">
        <div class="left">
            <span class="active">费用详情</span>
        </div>
        <div class="right">
            <span>预定须知</span>
        </div>
    </div>
    <div class="background">
        <div class="detail cost">
        	<?php echo ($line["cost_description"]); ?>
            <div class="top"><!-此div只用于显示三角形-></div>
        </div>
        <div class="detail notice">
        	<?php echo ($line["booking_notes"]); ?>
            <div class="top"><!-此div只用于显示三角形-></div>
        </div>
    </div>
</div>

<!--沿途风光-->
<div class="highlights scenery">
    <h2 class="tit">沿途风光</h2>
    <div class="border-bottom"><!-此div只用于显示birder-></div>
    <div class="content">
        <div id="slider" style="width:818px;">
			<?php if(is_array($scenery)): $i = 0; $__LIST__ = $scenery;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sc): $mod = ($i % 2 );++$i;?><span>
	                <a href="javascript:;">
						<div style="background-image: url(<?php echo ($sc["image"]); ?>);height:625px;background-repeat: no-repeat;background-position: center center;"></div>
						<!--<img id="center-top" src="<?php echo ($sc["image"]); ?>"/>-->
						</a>
	                <?php if(!empty($sc["text"])): ?><div style="position:absolute;left:0px;bottom:0px;height:60px;line-height:60px;width:1000px;padding:0px 30px;background:rgba(0,0,0,.5);color:#fff;font-size: 14px;"><?php echo ($sc["text"]); ?></div><?php endif; ?>
	            </span><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>

<!--私人定制-->
<div class="customized">
    <h1 style="color:#fff;">上述产品不满足您的需求？</h1>
    <h3>欢迎填写下表提交，即刻联系每刻美跟拍游的私人旅行顾问</h3>
    <h3>我们将为您和您的亲友量身定制专属行程</h3>
    <a type="button" href="<?php echo U('line/book');?>" class="btn btn-customized" target="_blank">私人定制</a>
</div>

<!--左侧定位导航-->
<div class="left-aside" id="left-aside">
    <div class="left-aside-problem active">行 程<br>亮 点</div>
    <div class="left-aside-explain">行 程<br>说 明</div>
    <div class="left-aside-detail">费 用<br>详 情</div>
    <div class="left-aside-reserve">预定<br>须知</div>
    <div class="left-aside-scenery">沿 途<br>风 光</div>
</div>

<script type="text/javascript" src="http://kllife.com/source/Static/qinglvpai/js/vmc.slider.full.min.js"></script>
<script>
    //头部点击选中状态
    $(".header ul a").on("click",function(){
        $(this).addClass("active").siblings("a").removeClass("active");
    })
	//
    $('#block').hover(
        function () {
            $('#none').show();
        } ,
        function () {
            $('#none').hide();
        }

    );


    //预订用户滚动显示
    $(function(){
        $(".font_inner li:eq(0)").clone(true).appendTo($(".font_inner"));//克隆第一个放到最后(实现无缝滚动)

        var liHeight = $(".volume").height();                            //一个li的高度

        var totalHeight = ($(".font_inner li").length *  $(".font_inner li").eq(0).height()) -liHeight;

        $(".font_inner").height(totalHeight);//给ul赋值高度

        var index = 0;

        function tab(){
            $(".font_inner").stop().animate({
                top: -index * liHeight
            },400,function(){
                if(index == $(".font_inner li").length -1) {
                    $(".font_inner").css({top:0});
                    index = 0;
                }
            })
        };

        function topword() {
            index++;
            if(index > $(".font_inner li").length - 1) {
                //判断index为最后一个Li时index为0
                index = 0;
            }
            tab();
        };

        autoTimer = setInterval(topword,3000);
        $(".font_inner li").hover(function(){
            clearInterval(autoTimer);
        },function() {
            autoTimer = setInterval(topword,3000);
        });
    })
    //人数递减
    $(".reduce").on("click",function(){
        var temp = $(this);
        var number = temp.next(".number").html();
        number--;
        if($(this).next(".number").html()=="0"){
            return false;
        }else{
            temp.next(".number").html(number);
        }
    })
    //人数递增
    $(".add").on("click",function(){
        var temp = $(this);
        var number = temp.prev(".number").html();
        number++;
        temp.prev(".number").html(number);
    })

    //行程说明鼠标滑入显示详情
    $(document).ready(function(){
        $(".explain .right").mouseover(function(){
            var p=$(this).find(".show");
            p.removeClass("height");
            $(this).find(".none").hide();

            $(this).find(".prompt").removeClass("activ");
        })
    })
    //行程说明鼠标滑出收起详情
    $(document).ready(function(){
        $(".explain .right").mouseout(function(){
            var p=$(this).find(".show");
            p.addClass("height")
            $(this).find(".none").show();

            $(this).find(".prompt").addClass("activ");
        })
    })

    //费用详情、预定须知切换
    $(".expense-details .left span").on("click",function(){
        $(".background .cost").show();
        $(".background .notice").hide();
    })
    $(".expense-details .right span").on("click",function(){
        $(".background .notice").show();
        $(".background .cost").hide();

    })
    $(".expense-details .tit div span").on("click",function(){
        $(this).addClass("active").parents("div").siblings("div").find("span").removeClass("active");
    })



    //点赞
    $(".zan i").on("click",function(){
        $(this).toggleClass("active");
    })


    $(".expense-details .left span").on("click",function(){
        $(".left-aside-detail").addClass("active").siblings().removeClass('active');
    })
    $(".expense-details .right span").on("click",function(){
        $(".left-aside-reserve").addClass("active").siblings().removeClass('active');
    })
    $(".left-aside .left-aside-reserve").on("click",function(){
        $(this).addClass("active").siblings().removeClass('active');
        $(".notice").show();
        $(".cost").hide();
        $(".expense-details .right span").addClass("active");
        $(".expense-details .left span").removeClass("active");

    })
    $(".left-aside .left-aside-detail").on("click",function(){
        $(this).addClass("active").siblings().removeClass('active');
        $(".cost").show();
        $(".notice").hide();
        $(".expense-details .left span").addClass("active");
        $(".expense-details .right span").removeClass("active");

    })
    window.onload=function (){
        var h1;
        var h2;
        var h3;
        var h4;
        var h5;
        var h6;
        var h7;
        $(function(){
            h1 = 1100;  										//行程亮点锚点处
            h2 = $("#liangdian").outerHeight(true) + 1110;      //行程说明锚点处
            h3 = $("#shuoming").outerHeight(true)+h2;			//费用详情锚点出
            h4 =  $(".cost").outerHeight(true)+h3+110;			//沿途风光锚点出
            h5 =  $(".notice").outerHeight(true)+h3+110;		//沿途风光锚点出
            h6 =  500+h4;									    //隐藏高度
            h7 =  500+h5;									    //隐藏高度


            //浮动定位导航
            function toTag(g, h) {
                $(g).click(
                    function(){
                        $("html,body").animate({scrollTop: h}, 1000);
                    }
                );
            };
            toTag('.left-aside .left-aside-problem', h1);
            toTag('.left-aside .left-aside-explain', h2+1);
            toTag('.left-aside .left-aside-detail', h3);
            toTag('.left-aside .left-aside-reserve', h3);
            $(".left-aside-scenery").on("click",function(){
                if($(".cost").css("display") == 'block'){
                    $("html,body").animate({scrollTop: h4}, 1000);
                }else{
                    $("html,body").animate({scrollTop: h5}, 1000);
                }
            })
        })



        $(window).scroll( function (){
            if($(".cost").css("display") == 'block') {
                if ($(this).scrollTop() > 1099 && $(this).scrollTop() < h6 && $(window).width() > 1490 ) {
                    $('.left-aside').fadeIn();
                }else{
                    $('.left-aside').fadeOut();
                };

                if ($(this).scrollTop() >= h1 && $(this).scrollTop() < h2) {
                    $('.left-aside-problem').addClass('active').siblings().removeClass('active');
                }else if($(this).scrollTop() > h2 && $(this).scrollTop() < h3) {
                    $('.left-aside-explain').addClass('active').siblings().removeClass('active');
                }else if ($(this).scrollTop() >= h3 && $(this).scrollTop() < h4 && $(".cost").css("display") == 'block') {
                    $('.left-aside-detail').addClass('active').siblings().removeClass('active');
                }else if ($(this).scrollTop() >= h3 && $(this).scrollTop() < h5 && $(".notice").css("display") == 'block') {
                    $('.left-aside-reserve').addClass('active').siblings().removeClass('active');
                } else if ($(this).scrollTop() >= h3 && $(this).scrollTop() < h5 && $(".cost").css("display") == 'block'){
                    $('.left-aside-scenery').addClass('active').siblings().removeClass('active');
                }
            }else{
                if ($(this).scrollTop() > 1099 && $(this).scrollTop() < h7 && $(window).width() > 1490) {
                    $('.left-aside').fadeIn();
                }else{
                    $('.left-aside').fadeOut();
                };

                if ($(this).scrollTop() >= h1 && $(this).scrollTop() < h2) {
                    $('.left-aside-problem').addClass('active').siblings().removeClass('active');
                }else if($(this).scrollTop() > h2 && $(this).scrollTop() < h3) {
                    $('.left-aside-explain').addClass('active').siblings().removeClass('active');
                }else if ($(this).scrollTop() >= h3 && $(this).scrollTop() < h4 && $(".cost").css("display") == 'block') {
                    $('.left-aside-detail').addClass('active').siblings().removeClass('active');
                }else if ($(this).scrollTop() >= h3 && $(this).scrollTop() < h5 && $(".notice").css("display") == 'block') {
                    $('.left-aside-reserve').addClass('active').siblings().removeClass('active');
                }else if ($(this).scrollTop() >= h5 && $(this).scrollTop() < h7 && $(".notice").css("display") == 'block') {
                    $('.left-aside-scenery').addClass('active').siblings().removeClass('active');
                }
            }

        });
	}

    /* 配置选项 */
    var options = {
        width: 1000, // 宽度
        height: 625, // 高度
        gridCol: 10, // 网格列数
        gridRow: 5, // 网格行数
        gridVertical: 20, // 栅格列数
        gridHorizontal: 10, // 栅格行数
        autoPlay: true, // 自动播放
        ascending: true, // 图片按照升序播放
//        effects: [ // 使用的转场动画效果
//            'fade', 'fadeLeft', 'fadeRight', 'fadeTop', 'fadeBottom', 'fadeTopLeft', 'fadeBottomRight',
//            'blindsLeft', 'blindsRight', 'blindsTop', 'blindsBottom', 'blindsTopLeft', 'blindsBottomRight',
//            'curtainLeft', 'curtainRight', 'interlaceLeft', 'interlaceRight', 'mosaic', 'bomb', 'fumes'
//        ],
        ie6Tidy: false, // IE6下精简效果
        random: false, // 随机使用转场动画效果
        duration: 3000, // 图片停留时长（毫秒）
        speed: 900, // 转场效果时长（毫秒）
    };
    /* 创建轮播效果 */
    $('#slider').vmcSlider(options);


//    //垂直居中
//
//    function margintop(){
//        $("#center-top").on("load",function(){
//            var imgh = $(this).height();
//            var top = parseInt((625-imgh))/2;
//            alert(top)
//            if(top<200){
//                $(this).css("margin-top",top+"px");
//            }
//        });
//    }
//    // 初始化回调函数
//    $('#slider').vmcSlider({
//        flip: margintop(),
//    });
//    // 绑定vmcsliderflip事件
//    $('#slider').on('vmcsliderflip', margintop());
//
//    // 初始化回调函数
//    $('#slider').vmcSlider({
//        create: margintop(),
//    });
//    // 绑定vmcslidercreate事件
//    $('#slider').on('vmcslidercreate', margintop());


	// 立即预定
	$('.book_order_now').click(function(){		
		var batchId = $('#select_batch').val();		
		if (batchId == '0') {
			alert('请选择出行的日期');			
			return false;			
		}
		
		var male = 0;
		if ($('.man').find('.number').length > 0) {
			male = parseInt($('.man').find('.number').html());
		}
		var woman = 0;
		if ($('.woman').find('.number').length > 0) {
			woman = parseInt($('.woman').find('.number').html());
		}
		var child = 0;
		if ($('.children').find('.number').length > 0) {
			child = parseInt($('.children').find('.number').html());
		}				
		if ((male + woman + child) == 0) {
			alert('出行的总人数不能小于1人');			
			return false;			
		}

        window.open( '<?php echo U("line/order");?>/type/create/id/<?php echo ($line["id"]); ?>/b/'+batchId+'/m/'+male+'/w/'+woman+'/ch/'+child);
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