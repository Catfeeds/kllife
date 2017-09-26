<?php

	require_once"WxPayConfig.php";
	require_once"WxPayApi.php";
	require_once"WxPayData.php";
	require_once"WxPayException.php";
	require_once"WxPayNativePay.php";
	require_once"PhpqrCode/PhpqrCode.php";
	
	//接收支付数据
	$zf_body       	 = "丝绸之路精华游";//线路标题
	$zf_detail       = "2017年青海湖-茶卡盐湖-敦煌-嘉峪关-张掖丹霞七日游";//线路标题
	$zf_out_trade_no = "LX-17022108484036306";//订单号
	$zf_total_fee    = "1";//总金额


	//模式二
	$input = new WxPayUnifiedOrder();
	$input->SetBody($zf_body);
	$input->SetDetail($zf_detail);
	$input->SetOut_trade_no($zf_out_trade_no);
	$input->SetTotal_fee($zf_total_fee);
	$input->SetTime_start(date("YmdHis"));
	$input->SetNotify_url("http://kllife.com/wx_pay/notify.php");
	$input->SetTrade_type("NATIVE");
	$input->SetProduct_id($zf_out_trade_no);
	$notify = new NativePay();
	$result = $notify->GetPayUrl($input);
	
	print_r($result)."<br>";
	$url2 = $result["code_url"];
	echo $url2;
	$value = $url2; //二维码内容   
	$errorCorrectionLevel = 'L';//容错级别   
	$matrixPointSize = 18;//生成图片大小  
	$pic_name = "pic/qrcode_".time().".png";
	//生成二维码图片
	   
	QRcode::png($value,$pic_name,$errorCorrectionLevel,$matrixPointSize, 2); 
	
	echo '<center><p><img alt="模式二扫码支付" src="'.$pic_name.'" style="width:260px;height:260px; margin:0 auto;"/></p></center>';

?>
