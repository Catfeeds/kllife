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
<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/leader.css">
<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/chromagallery.css">
<div class="leader-info">
    <div class="banner">
        <div class="centent">
            <div class="left"><img src="<?php echo ($leader["face_image"]); ?>" alt=""></div>
            <div class="right">
                <?php if(!empty($leader["name"])): ?><h2><?php echo ($leader["name"]); ?></h2><?php endif; ?>
                <div class="name">
                	<?php if(!empty($leader["nickname"])): ?><span>昵称：<?php echo ($leader["nickname"]); ?></span><?php endif; ?>
                    <?php if(!empty($leader["stagename"])): ?><span>艺名：<?php echo ($leader["stagename"]); ?></span><?php endif; ?>
                    <span>星座：<?php echo get_constellation($leader['constellation']);?></span>
                    <span>血型：<?php echo get_blood_type($leader['blood_type']);?></span>
                </div>
                <?php if(!empty($leader["intro"])): ?><p><?php echo ($leader["intro"]); ?></p><?php endif; ?>
                <?php if(!empty($leader["impression"])): ?><div class="impress">
	                    <div class="impress-left">印象：</div>
	                    <div class="impress-right">
	                    	<?php if(is_array($leader["impression_list"])): $i = 0; $__LIST__ = $leader["impression_list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imp): $mod = ($i % 2 );++$i;?><span class="item background<?php echo mt_rand(0,4);?>"><?php echo ($imp); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
	                        <!--<p class="add">添加+</p>-->
	                    </div>
	                </div><?php endif; ?>
            </div>
            <!--<?php echo p_a($leader);?>-->
            <div class="absolute">
                <div class="tit">对他/她的印象 <span class="remove-impress"><i class="iconfont">&#xe66c;</i></span></div>
                <div class="add-impress">
                    <span id="1">暖男</span>
                    <span id="2">苗条</span>
                    <span id="3">学霸</span>
                    <span id="4">漂亮</span>
                    <span id="5">热情</span>
                    <span id="6">帅气</span>
                    <span id="7">亲切</span>
                    <span id="8">老司机</span>
                    <span id="9">有耐心</span>
                    <span id="10">小鲜肉</span>
                    <span id="11">老腊肉</span>
                    <span id="12">肌肉男</span>
                    <span id="13">责任心强</span>
                    <span id="14">风趣幽默</span>
                    <span id="15">文艺青年</span>
                    <span id="16">心宽体胖</span>
                    <span id="17">摄影技术好</span>
                </div>
                <a class="btn btn-submit">提交</a>
            </div>
        </div>
    </div>
    
    <?php if(!empty($questions)): ?><div class="problem">
	        <!--只用于下三角-->
	        <div class="down"><img src="http://kllife.com/source/Static/qinglvpai/images/leader/down.png" alt=""></div>

	        <?php if(is_array($questions)): $i = 0; $__LIST__ = $questions;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$quest): $mod = ($i % 2 );++$i;?><div class="item">
	            <div class="problem-two">
	                <div class="left">Q</div>
	                <div class="right"><?php echo ($quest["content"]); ?></div>
	            </div>
	            <?php if(is_array($quest["answers"])): $i = 0; $__LIST__ = $quest["answers"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$answer): $mod = ($i % 2 );++$i;?><div class="answer">
	                <div class="left">A</div>
	                <div class="right"><?php echo ($answer["content"]); ?></div>
	            </div><?php endforeach; endif; else: echo "" ;endif; ?>
	        </div><?php endforeach; endif; else: echo "" ;endif; ?>
	    </div><?php endif; ?>
    
    <?php if(!empty($pictures)): ?><div class="works">
	        <h2>个人作品</h2>
	        <div class="border"><!--此div只用于显示border--></div>
	        <div class="photolist">
	            <div class="content">
	                <div class="chroma-gallery mygallery">
	                    <?php if(is_array($pictures)): $i = 0; $__LIST__ = $pictures;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pic): $mod = ($i % 2 );++$i;?><img src="<?php echo ($pic["path"]); ?>" alt="<?php echo ($pic["title"]); ?>,<?php echo ($pic["tags"]); ?>,<?php echo ($pic["intro"]); ?>"><?php endforeach; endif; else: echo "" ;endif; ?>
	                    <div id="lg-img" style="position: fixed;;background:#666;display: none;z-index:1000;"></div>
	                </div>
	            </div>
	        </div>
	    </div><?php endif; ?>
</div>
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
<script src="http://kllife.com/source/Static/qinglvpai/js/chromagallery.pkgd.min.js"></script>
<script type="text/javascript">
    //取消点击事件
    $(document).ready(function(){
        $(".mygallery").chromaGallery();
    });
    //初始化瀑布流
    $(document).ready(function(){
        $(".mygallery").chromaGallery({
            color:'#000',
            gridMargin:20,
            maxColumns:4,
            dof:true,
            screenOpacity:0.8
        });
    });

    //鼠标移动显示放大图
     $('body').on("mousemove",".chrg-item",function(e) {
         //创建一个新对象获取图片的原始尺寸用来显示放大图
         var img = new Image();
         img.src = $(this).find("img").attr("src");

         var xx = e.originalEvent.x+5 || e.originalEvent.layerX+5 || 0; //鼠标X坐标
         var yy = e.originalEvent.y+5 || e.originalEvent.layerY+5 || 0; //鼠标Y坐标
         var width = $(window).width(); //屏幕可视宽度
         var height = $(window).height(); //屏幕可视高度
         var middlew = width/2; //屏幕可视宽度中间点
         var middleh = height/2; //屏幕可视高度中间点
         var imgsrc = $(this).find("img").attr("src");    //放大图路径

         //将放大图的路径复制给显示的div
         $("#lg-img").css({'background-image':'url('+imgsrc+')','background-repeat':'no-repeat','background-size':'100% 100%','width':img.width/2,'height':img.height/2,})
         //显示放大图div
         $("#lg-img").show();
         //通过鼠标划入的坐标来判断放大图显示在左边还是右边
         if(yy < middleh){
             if(xx < middlew){                          //如果鼠标划入左半边放大图显示在鼠标当前位置右边
                 $("#lg-img").css({top:yy,left:xx})
             }else{                                    //如果鼠标划入右半边放大图显示在鼠标当前位置左边
                 $("#lg-img").css({top:yy,left:xx-img.width/2})
             }
         }else{
             if(xx < middlew){                          //如果鼠标划入左半边放大图显示在鼠标当前位置右边
                 $("#lg-img").css({top:(yy-img.height/2)-8,left:xx})
             }else{                                    //如果鼠标划入右半边放大图显示在鼠标当前位置左边
                 $("#lg-img").css({top:(yy-img.height/2)-8,left:xx-img.width/2})
             }
         }
     });
     //鼠标离开元素隐藏放大图
     $('body').on("mouseout",".chrg-item",function(e) {
         $("#lg-img").hide();
     });
	//点击添加弹出添加标签div
    $(".add").on("click",function(){
        $(".absolute").show();
    });
    //点击右上角关闭按钮关闭标签列表
    $(".remove-impress").on("click",function(){
        $(".absolute").hide();
    });

    //点击选择标签按钮存储到数组
    var tagList=[];  //选中的标签名称
    $(".add-impress span").on("click",function(){
        var name = $(this).html();
        var id = $(this).attr("id");
        if($(this).hasClass("active") == true){
            for(i=0; i<tagList.length; i++){
                if(tagList[i][0] == $(this).attr('id')){
                    tagList.splice(i,1);
                }
            }
            $(this).removeClass('active');
        }else{
            var v = [];
            v[0] = $(this).attr('id');
            v[1] = $(this).html();
            tagList[tagList.length] = v;
            $(this).addClass('active');
        }
    });

    tagNames=[];//已有选中标签
    //点击提交按钮提交
    $(".btn-submit").on("click",function(){
        //已有的标签保存到一个数组用来做判断
        $(".impress-right .item").each(function(){
            var d = [];
            d[0] = $(this).attr("id");
            d[1] = $(this).html();
            tagNames[tagNames.length] = d;
        });
        //没有被选中的标签时先追加标签
        if ($(".impress-right").find('span').length < 1) {
            for(var i=0;i<tagList.length;i++) {
                var number = Math.floor(Math.random() * 5) //随机生成随机数用于拼接随机背景颜色
                var span = "<span class='item background" + number + "' id=" + tagList[i][0] + ">" + tagList[i][1] + "<span>0</span></span>"
                $(".impress-right .add").before(span);
            }
        }else{
            for(var i=0;i<tagList.length;i++) {
                for (var j = 0; j < tagNames.length; j++) {
                    if (tagList[i][0] == tagNames[j][0]) {
                        var numbertwo = $(".impress-right").find("[id='" + tagNames[j][0] + "']").find("span").html();
                        numbertwo++;
                        $(".impress-right").find("[id='" + tagNames[j][0] + "']").find("span").html(numbertwo);
                    }else{
                        var number = Math.floor(Math.random()*5) //随机生成0-4五个随机数用于拼接随机背景颜色
                        var span = "<span class='item background" +number + "' id=" +tagList[i][0]+ ">"+tagList[i][1]+"<span>0</span></span>"
                        $(".impress-right .add").before(span);
                    }
                }

            }
        }
        tagList=[];
        $(".absolute").hide();
        $(".add-impress span").removeClass("active");
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