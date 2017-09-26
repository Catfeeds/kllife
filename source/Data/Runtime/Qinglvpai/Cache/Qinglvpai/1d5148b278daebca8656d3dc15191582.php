<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo C('PAGE_TITLE');?></title>
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/style.css">
	<!-- css Reset -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/cssreset.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/common.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/common/css/common.css">
    <link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/iconfont.css">
    <style>
        .top-ask{position: fixed;right:50px;bottom:100px;display: none;z-index:1000;}
        .top-ask div{margin:2px 0px;cursor: pointer;}
    </style>
	<!-- 引用jq -->
	<script src="http://kllife.com/source/Static/home/common/js/jquery-1.11.3.min.js"></script>
</head>
<body>
<!--header-->
<div class="header">
    <?php if(C('MENU_CURRENT') === 'index_welcome'): ?><a href="<?php echo U('index/story');?>"><div class="banner" style="background-image: url(<?php echo ($set["banner"]); ?>);"></div></a>    	
   	<?php elseif(C('MENU_CURRENT') === 'line_list'): ?>
        <div class="banner" style="background-image: url(<?php echo ($set["content_banner"]); ?>);"></div>
    <?php elseif(C('MENU_CURRENT') === 'line_content'): ?>
        <div class="banner-content" style="background-image: url(<?php echo ($set["qinglvpai_content_banner"]); ?>);"></div>
   	<?php elseif(C('MENU_CURRENT') === 'line_main_list'): ?>
        <div class="banner" style="background-image: url(<?php echo ($set["xiaomantuan_banner"]); ?>);"></div>
    <?php elseif(C('MENU_CURRENT') === 'line_main_content'): ?>
        <div class="banner-content" style="background-image: url(<?php echo ($set["xiaomantuan_content_banner"]); ?>);"></div>
    <?php elseif(C('MENU_CURRENT') === 'line_list'): ?>
        <div class="banner" style="background-image: url(<?php echo ($set["content_banner"]); ?>);"></div>
    <?php elseif(C('MENU_CURRENT') === 'book_line' or C('MENU_CURRENT') === 'line_pay_result' or C('MENU_CURRENT') === 'index_story'): ?>
    <?php else: ?>
        <div class="banner" style="background-image: url(<?php echo ($set["content_banner"]); ?>);"></div><?php endif; ?>
    <div class="div-two">
        <div class="list">
            <a href="javascript:;"><img class="logo-white" src="http://kllife.com/source/Static/qinglvpai/images/index/logo-qinglvpai.png" alt=""></a>
            <ul>
            	<?php $navClass = array('index_welcome'=>'','index_story'=>'','line_list'=>'','line_main_line'=>'','article_line'=>''); $navClass[C('MENU_CURRENT')] = 'active'; ?>
                <a class="<?php echo ($navClass[0]); ?>" href="<?php echo U('index/welcome');?>">首页</a>
                <a class="<?php echo ($navClass[1]); ?>" href="<?php echo U('index/story');?>">品牌故事</a>
                <a class="<?php echo ($navClass[2]); ?>" href="<?php echo U('line/list');?>">新旅拍</a>
                <a class="<?php echo ($navClass[3]); ?>" href="<?php echo U('line/slowly');?>">小团慢旅行</a>
                <a class="<?php echo ($navClass[4]); ?>" href="<?php echo U('article/list');?>">新旅拍作品</a>
                <!--<a href="javascript:;">客户回顾</a>-->
            </ul>
            <div class="tel">
                <img style="height:auto;" src="http://kllife.com/source/Static/qinglvpai/images/index/tel-img.png" alt="">
                <img style="height:auto;" src="http://kllife.com/source/Static/qinglvpai/images/index/tel-number.png" alt="">
                <!--<em><?php echo ($pcset["askfor_tel"]); ?></em>-->
            </div>
            <div class="tel login" style="line-height:80px;color:#fff;font-size: 14px;width:170px;text-align: center;text-align: -webkit-center">
				<?php if(empty($user) == true): ?><a href="<?php echo U('user/login');?>">登录</a> |
					<a href="<?php echo U('user/register');?>">注册</a>
				<?php else: ?>
					<a href="<?php echo U('line/order');?>/type/center">我的订单</a> |
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
	<!-- 私有样式 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/css/order_details.css">
	<style>
		#content{margin-top:50px;}
		.order-details-top p span,.contact-information > p strong{color:#ff1c77;}
	</style>
	<!-- 主要内容 -->
	<div id="content">
		<div class="order-details-top">
			<p>亲爱的用户 <span><?php echo ($order["show_name"]); ?></span> ，您好！您于<?php echo ($order["addtime_show"]); ?>的订单（订单号：<?php echo ($order["order_sn"]); ?>）详情如下，请您再次认真核实该订单信息，如您发现当前订单错误或有任何疑问请与客服联系，客服电话：<span>400-080-5860</span>或咨询在线客服；当前订单状态为<span><?php echo ($order["zhuangtai_data"]["type_desc"]); ?></span>，请进入<a href="<?php echo U('line/order');?>/type/center"><span>订单中心</span></a>进行付款，以免耽误行程。</p>
		</div>
		<div class="order-details-content">
			<!-- 订单详情 -->
			<div class="order-details">
				<h3>订单详情</h3>
				<p>订 单 号：<?php echo ($order["order_sn"]); ?></p>
				<p>订单状态：<?php echo ($order["zhuangtai_data"]["type_desc"]); ?></p>
				<p>活动名称：<?php echo ($order["lineid_title"]); ?></p>
				<p>活动时间：<?php echo ($order["hdid_show_text"]); ?></p>
				<p>联系人：<?php echo ($order["names"]); ?></p>
				<p>联系人电话：<?php echo ($order["mob"]); ?></p>
				<p>参团人数：   <span><?php echo ($order["male"]); ?></span> 男[成人]     <span><?php echo ($order["woman"]); ?></span>  女[成人]      <span><?php echo ($order["child"]); ?></span> 儿童 </p>
				<p>订单总费用：<?php echo ($order["need_pay_money"]); ?></p>
				<p>订单总团费：<?php echo ($order["team_cut_price"]); ?></p>
				<p>已付费用：<?php echo ($order["pay_cash"]); ?></p>
				<p>其他费用:
					<?php if(empty($order["extra_cash"])): ?>无<?php endif; ?>
					<?php if(is_array($order["extra_cash"])): $i = 0; $__LIST__ = $order["extra_cash"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ec): $mod = ($i % 2 );++$i; echo ($ec["cash_use_id_data"]["type_desc"]); ?>  <i><?php echo ($ec["cash"]); ?>元</i><?php endforeach; endif; else: echo "" ;endif; ?>
				</p>
				<p>
					用户优惠券:
					<?php if(empty($order["extra_cash"])): ?>无<?php endif; ?>
					<?php if(is_array($order["use_coupon"])): $i = 0; $__LIST__ = $order["use_coupon"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$uc): $mod = ($i % 2 );++$i; echo ($uc["title"]); ?>  <i><?php echo ($uc["money"]); ?>元</i><?php endforeach; endif; else: echo "" ;endif; ?>
				</p>
				<p>
					系统优惠券:
					<?php if(empty($order["extra_cash"])): ?>无<?php endif; ?>
					<?php if(is_array($order["order_coupon"])): $i = 0; $__LIST__ = $order["order_coupon"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$oc): $mod = ($i % 2 );++$i; echo ($oc["coupon_type_id_data"]["type_desc"]); ?>  <i><?php echo ($oc["cash"]); ?>元</i><?php endforeach; endif; else: echo "" ;endif; ?>
				</p>
			</div>
			<!-- 发票信息 -->
			<?php if($order["receipt_type"] == 1): ?><div class="invoice-information">
					<h3>发票信息 <span>(企业发票)</span></h3>
					<p>单位名称：<?php echo ($oreder["receipt_company"]); ?></p>
					<p>纳税人识别号：<?php echo ($order["receipt_company_no"]); ?></p>
					<p>单位地址：<?php echo ($order["receipt_company_address"]); ?></p>
					<p>电话号码：<?php echo ($order["receipt_company_phone"]); ?></p>
					<p>收件人：<?php echo ($order["receipt_receiver"]); ?></p>
					<p>收件电话：<?php echo ($order["receipt_receiver_phone"]); ?></p>
					<p>收件地址：<?php echo ($order["receipt_receiver_address"]); ?></p>
				</div>
			<?php elseif($order["receipt_type"] == 2): ?>
				<div class="invoice-information">
					<h3>发票信息 <span>(个人发票)</span></h3>
					<p>收件人：<?php echo ($order["receipt_receiver"]); ?></p>
					<p>收件电话：<?php echo ($order["receipt_receiver_phone"]); ?></p>
					<p>收件地址：<?php echo ($order["receipt_receiver_address"]); ?></p>
				</div><?php endif; ?>
			<!-- 订单联系人信息 -->
			<div class="contact-information">
				<h3>订单参团人信息</h3>
				<table>
					<thead>
						<tr>
							<th>姓名</th>
							<th>手机号码</th>
							<th>证件</th>
							<th>性别</th>
							<th>退团</th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($order["members"])): $i = 0; $__LIST__ = $order["members"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?><tr>
								<td><?php echo ($m["name"]); ?></td>
								<td><?php echo ($m["tel"]); ?></td>
								<td>
									<p><?php echo ($m["certificate_type_id_data"]["type_desc"]); ?> <?php echo ($m["certificate_num"]); ?></p>
									<?php if(m.birthday != ''): ?><p>出生日期 <?php echo ($m["birthday"]); ?></p><?php endif; ?>
								</td>
								<td><?php echo ($m["type_id_data"]["type_desc"]); ?></td>
								<td>
									<?php if($m['exit'] == 0): ?>在团
									<?php else: ?>
										已退团<?php endif; ?>
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
				<p>订单总金额：<strong>￥<?php echo ($order["need_pay_money"]); ?></strong> 元</p>
			</div>
		</div>
	</div>

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
			<span style="margin-top: 20px;">Copyright  2017 <a href="http://www.kllife.com/qinglvpai" style="color:#fff;">xinlvpai.com</a> | 杭州浪客国际旅行社有限公司版权所有</span>
			<br>
			<span>旅行社经营许可证号：ZJ30301 浙ICP备17010959号
			<span>
				<!--商务通代码--> 
				<script language="javascript" src="http://pqt.zoosnet.net/JS/LsJS.aspx?siteid=PQT43116159&float=1&lng=cn"></script>
				<script language="javascript" type="text/javascript" src="http://kllife.com/swt_xlp/js/swt.js"></script>
				<!--CNZZ统计--> 
				<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1261595265'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1261595265%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
			</span>
		</div>
	</div>
	
	<!-- Imported toastr -->
	<script src="http://kllife.com/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="http://kllife.com/source/Static/common/js/functions.js"></script>
	
	
</body>
</html>