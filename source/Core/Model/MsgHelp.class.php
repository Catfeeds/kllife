<?php
/**
 * Created by CodeLobster.
 * User: PF
 * Date: 2017-1-10
 * Time: 2017-1-10 15:09:27
 */
namespace Core\Model;
 
class MsgHelp {	
	
	/**
     *  手机短信发送
     *
     * @access    public
	 * @param     string  $phone      手机号码
	 * @param     string  $message    短信内容
	 * @param     string  $encode     编码
	 * @param     string  $sendTime   定时时间
	 * @param     int     $timeout    超时时间
     * @return    array
     */
	public static function sendSMS($phone, $message, $encode = "utf-8", $sendTime) {
			
		$uid = C('SMS_UID');
		$auth = md5("".C('SMS_CODE').C('SMS_PASSWORD')."");	
		
		if($sendTime != ''){
			$timeStr = "&time=".$sendTime;
		}
		$api_url = "http://sms.10690221.com:9011/hy/?uid=".$uid."&auth=".$auth."&mobile=".$phone."&msg=".$message."&expid=0&encode=".$encode.$timeStr;
		
		$ch = curl_init();
		$timeout = 5;
		curl_setopt ($ch, CURLOPT_URL, $api_url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$file_contents = curl_exec($ch);
		curl_close($ch);
		
		return $file_contents;
	
	}
	
	/**
	 * 邮件发送
	 * 
	 * @access    public
	 * @param     string   $email      邮箱地址	
	 * @param     string   $title      邮件标题  	
	 * @param     string   $content    邮件内容    	
	 * @return    array    
	 */
	 	
	public static function sendSimpleEmail($email, $title, $content) {
		
		import('Vendor.PHPMailer');
		Vendor ( 'PHPMailer.PHPMailerAutoload' );
		$mail = new \PHPMailer ();                 // 实例化
		$mail->IsSMTP (); 						  // 启用SMTP	
		$mail->Host = C('MAIL_HOST');             //smtp服务器的名称
		$mail->SMTPAuth = C('MAIL_SMTPAUTH');     //启用smtp认证
		$mail->Username = C('MAIL_USERNAME');     //你的邮箱名
		$mail->Password = C('MAIL_PASSWORD');     //邮箱密码
		$mail->From = C('MAIL_FROM');             //发件人地址（也就是你的邮箱地址）
		$mail->FromName = C('MAIL_FROMNAME');     //发件人姓名
		$mail->AddAddress ( $email, "尊敬的客户" );		
		$mail->WordWrap = 50;     				  // 设置每行字符长度
		$mail->IsHTML(C('MAIL_ISHTML')); 		  // 是否HTML格式邮件
		$mail->CharSet = C('MAIL_CHARSET'); 	  // 设置邮件编码
		$mail->Subject = $title; 				  // 邮件主题
		$mail->Body = $content; 				  // 邮件内容
		$mail->AltBody = ""; 					  //邮件正文不支持HTML的备用显示

		$r = $mail->Send ();

		if ($r) {
			$data ["sta"] = 1;
			$data ["msg"] = "发送成功";
		} else {
			$data ["sta"] = 2;
			$data ["msg"] = "发送失败";
		}
		return $data;
	
	}
	
	
	/**
	 * 网银支付接口调用（盛付通）
	 * 
	 * @access    public
	 * @param     string   $OrderNo          商户订单号	
	 * @param     string   $OrderAmount      支付金额  	
	 * @param     string   $OrderTime        商户订单提交时间
	 * @param     string   $PayChannel       支付渠道
	 * @param     string   $InstCode         银行编码	
	 * @param     string   $BackUrl          在收银台跳转到商户指定的地址  	
	 * @param     string   $ProductName      商品名称
	 * @param     string   $BuyerContact     支付人联系方式
	 * @param     string   $BuyerIp          买家IP地址
	 * @param     string   $Ext1             签名类型
	 * 
	 */
	public static function submit_shengpay($OrderNo, $OrderAmount, $OrderTime, $PayChannel, $InstCode, $SuccessUrl='', $BackUrl='', $ProductName, $BuyerContact='', $BuyerIp, $Ext1, &$out) {
		$shenPayKey = 'kllife8ed552d7fa';
		$params=array(
			'Name'=>'B2CPayment',          									//版本名称
			'Version'=>'V4.1.1.1.1',       									//版本号
			'Charset'=>'utf-8',            									//字符集
			'MsgSender'=>'276614',         									//发送方标识
			'SendTime'=>date("YmdHis",time()),								//发送支付请求时间
			'OrderNo'=>'',                 									//商户订单号
			'OrderAmount'=>'',             									//支付金额
			'OrderTime'=>'',               									//商户订单提交时间
			'Currency'=>'CNY',             									//货币类型
			'PayType'=>'PT001',                 							//支付类型编码
			'PayChannel'=>'',              									//支付渠道
			'InstCode'=>'',                									//银行编码
			'PageUrl'=>'http://www.kllife.com/shengpay/pageurl.php',        //支付成功后客户端浏览器回调地址
			'BackUrl'=>'',     												//在收银台跳转到商户指定的地址
			'NotifyUrl'=>'http://www.kllife.com/back/index.php?s=/back/external/payresult',    //服务端通知发货地址
			'ProductName'=>'',             									//商品名称
			'BuyerContact'=>'',            									//支付人联系方式
			'BuyerIp'=>'',                 									//买家IP地址
			'Ext1'=>'',                    									//扩展1
			'SignType'=>'MD5',             									//签名类型
			'SignMsg'=>'',                 									//签名串
		);
		$params['PageUrl']=$SuccessUrl;
//		$params['PayHost']="https://mas.shengpay.com/web-acquire-channel/cashier.htm";
		$params['OrderNo']=$OrderNo;
		$params['OrderAmount']=$OrderAmount;
		$params['OrderTime']=$OrderTime;
		$params['PayChannel']=$PayChannel;
		$params['InstCode']=$InstCode;
		$params['BackUrl']=$BackUrl;
		$params['ProductName']=$ProductName;
		$params['BuyerContact']=$BuyerContact;
		$params['BuyerIp']=$BuyerIp;
		$params['Ext1']=$Ext1;
		
		$payHost = "https://mas.shengpay.com/web-acquire-channel/cashier.htm";

		$origin='';
		foreach($params as $key=>$value){
			if(!empty($value)){
				$origin.=$value."|";
			}	
		}
		$out['source'] = $origin;		
		$out['source_key'] = $origin.$shenPayKey;
		$SignMsg=strtoupper(md5($origin.$shenPayKey));
		
		$params['SignMsg']=$SignMsg;		
		$html = '<meta http-equiv = "content-Type" content = "text/html; charset = '.$params['Charset'].'"/>';
		$html .= '<form id="myForm" method="post" action="'.$payHost.'">';
		foreach($params as $key=>$value){
			$html .= '<input type="hidden" name="'.$key.'" value="'.$value.'"/><br />';
		}
		$html .= '<input type="submit" name="submit" value="提交到盛付通" id="dh" style="display:none">';
		$html .= '<script>var a = document.getElementById("dh"); a.click();</script>';
		$html .= '</form>';
		return $html;
	}

	/**
	 * 支付宝、微信支付接口调用（盛付通）
	 * 
	 * @access    public
	 * @param     string   $OrderNo          商户订单号	
	 * @param     string   $OrderAmount      支付金额  	
	 * @param     string   $OrderTime        商户订单提交时间
	 * @param     string   $PayType          支付类型
	 * @param     string   $PayChannel       支付渠道
	 * @param     string   $InstCode         银行编码	
	 * @param     string   $ProductName      商品名称
	 * @param     string   $BuyerIp          买家IP地址
	 * @param     string   $Ext1             备注扩展
	 * 
	 */
	public static function submit_shengpay_s($OrderNo, $OrderAmount, $OrderTime, $PayType, $PayChannel, $InstCode, $SuccessUrl='', $ProductName='', $BuyerIp='', $Ext1='') {
		$shenPayKey = 'kllife8ed552d7fa';
		//支付宝、微信支付接口参数
		$params_s=array(
			'Name'=>'B2CPayment',          									//服务代码
			'Version'=>'V4.1.1.1.1',       									//版本号
			'Charset'=>'UTF-8',            									//字符集
			'TraceNo'=>uniqid(),            								//请求序列号
			'MsgSender'=>'276614',         									//发送方标识
			'SendTime'=>date("YmdHis",time()),								//发送支付请求时间
			'OrderNo'=>'',                 									//商户订单号
			'OrderAmount'=>'',             									//支付金额
			'OrderTime'=>'',               									//商户订单提交时间
			'ExpireTime'=>'',               								//订单过期时间
			'Currency'=>'CNY',             									//货币类型
			'PayType'=>'',                 							        //支付类型
			'PayChannel'=>'',              									//支付渠道
			'InstCode'=>'',                									//银行编码
			'CardValue'=>'',                								//指定的卡面值
			'Language'=>'',                									//页面显示的语言
			'PageUrl'=>'http://www.kllife.com/shengpay/pageurl.php',        //支付成功后客户端浏览器回调地址
			'NotifyUrl'=>'http://www.kllife.com/back/index.php?s=/back/external/payresult',    //服务端通知发货地址
			'ProductId'=>'',                                                //商品Id
			'ProductName'=>'',             									//商品名称
			'ProductNum'=>'',             									//商品数量
			'UnitPrice'=>'',             									//商品单价
			'ProductDesc'=>'',             									//商品描述
			'ProductUrl'=>'',             									//商品Url
			'BackUrl'=>'',             									    //商户再次支付地址
			'SellerId'=>'',             									//卖方标识
			'BuyerName'=>'',             									//买方姓名
			'BuyerId'=>'',             									    //买方标识
			'BuyerContact'=>'',            									//付款方联系方式
			'BuyerIp'=>'',                 									//买方IP
			'PayeeId'=>'',                 									//收款方标识
			'PayerId'=>'',                 									//收款方标识
			'SharingInfo'=>'',                 								//分帐规则
			'SharingNotifyUrl'=>'',                 						//分账通知地址
			'Ext1'=>'',                    									//扩展1
			'Ext2'=>'',                    									//扩展2
			'SignType'=>'MD5',             									//签名类型
			'SignMsg'=>'',                 									//签名串
		);	
		$params_s['PageUrl']=$SuccessUrl;
		$params_s['OrderNo']=$OrderNo;
		$params_s['OrderAmount']=$OrderAmount;
		$params_s['OrderTime']=$OrderTime;
		$params_s['PayType']=$PayType;
		$params_s['PayChannel']=$PayChannel;
		$params_s['InstCode']=$InstCode;
		$params_s['ProductName']=$ProductName;
		$params_s['BuyerIp']=$BuyerIp;
		$params_s['Ext1']=$Ext1;
		
		$payHost = "https://cardpay.shengpay.com/web-acquire-channel/cashier.htm";

		$origin='';
		foreach($params_s as $key=>$value){
			if(!empty($value)){
				$origin.=$value;
			}	
		}
		$SignMsg=strtoupper(md5($origin.$shenPayKey));		
		$params_s['SignMsg']=$SignMsg;
		
		$html = '<meta http-equiv = "content-Type" content = "text/html; charset = '.$params_s['Charset'].'"/>';
		$html .= '<form  method="post" action="'.$payHost.'">';
			foreach($params_s as $key=>$value){
				$html .= '<input type="hidden" name="'.$key.'" value="'.$value.'"/><br>';
			}
		$html .= '<input type="submit" name="submit" value="提交到盛付通2" id="dh" style="display:none">';
		$html .= '<script>var a=document.getElementById("dh");a.click();</script>';
		$html .= '</form>';
		return $html;
	}


	/**
	 * 支付宝支付接口
	 * 
	 * @access    public
	 * @param     string   $out_trade_no     商户订单号
	 * @param     string   $subject       	  商品的标题/交易标题/订单标题/订单关键字等
	 * @param     string   $total_fee        付款金额，精确到小数点后两位
	 * @param     string   $body       		  对一笔交易的具体描述信息。如果是多种商品，请将商品描述字符串累加传给body
	 * @param     string   $show_url       	  商品展示地址，收银台页面上，商品展示的超链接
	 * 
	 */
	
	public static function Alipay($out_trade_no, $subject, $total_fee, $body, $product_url, $notify_url, $success_url){
			
		header("Content-type:text/html;charset=utf-8");
		vendor('Alipay.Corefunction');
        vendor('Alipay.Md5function');
        vendor('Alipay.Notify');
        vendor('Alipay.Submit');
	     
//		'alipay'=>array(
//			'seller_email'=>'2287684289@qq.com',//这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号
//			'notify_url'=>'http://www.kllife.com/AliPay/notifyurl', //支付宝服务器主动通知商户网站里指定的页面http路径。
//			'return_url'=>'http://www.kllife.com/AliPay/returnurl',//支付宝处理完请求后，当前页面自动跳转到商户网站里指定页面的http路径。
//		),
//		'alipay_wap'=>array(
//			'seller_email'=>'2287684289@qq.com',//这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号
//			'notify_url'=>'http://www.kllife.com/AliPayWap/notifyurl', //支付宝服务器主动通知商户网站里指定的页面http路径。
//			'return_url'=>'http://www.kllife.com/AliPayWap/returnurl',//支付宝处理完请求后，当前页面自动跳转到商户网站里指定页面的http路径。
//		),
		
		//支付参数
		$alipay_config		= C('alipay_config'); 
        $payment_type 		= "1"; 
        $notify_url 		= $notify_url;
        $return_url 		= $success_url;
        $seller_email 		= '2287684289@qq.com';
        $out_trade_no 		= $out_trade_no;
        $subject 			= $subject;
        $total_fee 			= $total_fee;
        $body 				= $body;
        $show_url 			= $product_url;
        $anti_phishing_key 	= "";
        $exter_invoke_ip 	= get_client_ip();

        //构造要请求的参数数组，无需改动
    	$parameter = array(
	        "service" 			 => "create_direct_pay_by_user",
	        "partner" 			 => trim($alipay_config['partner']),
	        "payment_type"    	 => $payment_type,
	        "notify_url"    	 => $notify_url,
	        "return_url"    	 => $return_url,
	        "seller_email"    	 => $seller_email,
	        "out_trade_no"    	 => $out_trade_no,
	        "subject"    		 => $subject,
	        "total_fee"    		 => $total_fee,
	        "body"            	 => $body,
	        "show_url"    		 => $show_url,
	        "anti_phishing_key"  => $anti_phishing_key,
	        "exter_invoke_ip"    => $exter_invoke_ip,
	        "_input_charset"     => trim(strtolower($alipay_config['input_charset']))
        );
		
        //建立请求
        $alipaySubmit = new \ AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"post", "确认");
        return $html_text;		
	}	
	
	
	/**
	 * 支付宝手机网站支付接口
	 * 
	 * @access    public
	 * @param     string   $out_trade_no     商户订单号
	 * @param     string   $subject       	  商品的标题/交易标题/订单标题/订单关键字等
	 * @param     string   $total_fee        付款金额，精确到小数点后两位
	 * @param     string   $body       		  对一笔交易的具体描述信息。如果是多种商品，请将商品描述字符串累加传给body
	 * @param     string   $show_url       	  商品展示地址，收银台页面上，商品展示的超链接
	 * 
	 */
	 
	public static function AlipayWap($out_trade_no, $subject, $total_fee, $body, $product_url, $notify_url, $success_url){
			
		header("Content-type:text/html;charset=utf-8");
		vendor('AlipayWap.Corefunction');
        vendor('AlipayWap.Md5function');
        vendor('AlipayWap.Notify');
        vendor('AlipayWap.Submit');
		
		//支付参数
		$alipay_config		= C('alipay_config'); 
        $payment_type 		= "1"; 
        $notify_url 		= $notify_url;
        $return_url 		= $success_url;
        $out_trade_no 		= $out_trade_no;
        $subject 			= $subject;
        $total_fee 			= $total_fee;
		$show_url 			= $product_url;
        $body 				= $body;

        //构造要请求的参数数组，无需改动
    	$parameter = array(			
			"service"       	=> "alipay.wap.create.direct.pay.by.user",
			"partner"       	=> trim($alipay_config['partner']),
			"seller_id"  		=> trim($alipay_config['partner']),
			"payment_type"		=> $payment_type,
			"notify_url"		=> $notify_url,
			"return_url"		=> $return_url,
			"_input_charset"	=> trim(strtolower($alipay_config['input_charset'])),
			"out_trade_no"		=> $out_trade_no,
			"subject"			=> $subject,
			"total_fee"			=> $total_fee,
			"show_url"			=> $show_url,
			"body"				=> $body,
        );
        //建立请求
        $alipaySubmit = new \ AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
        return $html_text;		
	}


	//支付宝异步通知验证
	public static function AlipayNotify(){
		vendor('AlipayWap.Corefunction');
        vendor('AlipayWap.Md5function');
        vendor('AlipayWap.Notify');
        vendor('AlipayWap.Submit');
			
		$alipay_config=C('alipay_config');
        $alipayNotify = new  \  AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
		return $verify_result;
		
	}
	
	//支付宝同步通知验证
	public static function AlipayReturn(){			
		vendor('AlipayWap.Corefunction');
        vendor('AlipayWap.Md5function');
        vendor('AlipayWap.Notify');
        vendor('AlipayWap.Submit');
        
		$alipay_config=C('alipay_config');
        $alipayNotify = new  \ AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
		return $verify_result;
	}
	

	

	/**
	 * 微信支付 扫码支付模式二
	 * 
	 * @access    public
	 * @param     string   $body       		  商品描述---String(128)
	 * @param     string   $detail     		  商品详情	---String(6000)
	 * @param     string   $out_trade_no     商户订单号---String(32)
	 * @param     string   $total_fee        付款金额，单位为分---	Int
	 * @param     string   $notify_url       通知地址---	String(256)
	 * 
	 */
	
	public static function Wxpay($body, $detail, $out_trade_no, $total_fee, $notify_url, &$out){
		$out['body'] = $body;
		$out['detail'] = $detail;
		$out['out_trade_no'] = $out_trade_no;
		$out['total_fee'] = $total_fee;
		$out['notify_url'] = $notify_url;
		
		chdir(dirname(__FILE__));
		vendor('Wxpay.WxPayConfig');
		vendor('Wxpay.WxPayApi');
		vendor('Wxpay.WxPayData');
		vendor('Wxpay.WxPayException');
		vendor('Wxpay.WxPayNativePay');
		vendor('Wxpay.PhpqrCode.Phpqrcode');
	
		//模式二
		$input = new \ WxPayUnifiedOrder();
		$input->SetBody($body);
		$input->SetDetail($detail);
		$input->SetOut_trade_no($out_trade_no);
		$input->SetTotal_fee($total_fee);
		$input->SetTime_start(date("YmdHis"));
		$input->SetNotify_url($notify_url);
		$input->SetTrade_type("NATIVE");
		$input->SetProduct_id($out_trade_no);
		$notify = new \ NativePay();
		$result = $notify->GetPayUrl($input);
		
		$url2 = $result["code_url"];
		$value = $url2; //二维码内容   
		$errorCorrectionLevel = 'L';//容错级别   
		$matrixPointSize = 18;//生成图片大小  
		$pic_name = './../../Static/Upload/pay_qrcode/'.time().".png";//保存二维码
		//生成二维码图片
		$out['result'] = \ QRcode::png($value,$pic_name,$errorCorrectionLevel,$matrixPointSize, 2);
		
		$pic_name = C('TMPL_PARSE_STRING.{__GLOBAL_HOST_URL__}').C('LX_PAY_QRCODE_IMAGE_URL').time().".png";		
		return $pic_name;
	}

	/**
	 * 西安银行在线支付
	 * 
	 * @access    public static
	 * @param     string   	$order_no			订单号---String
	 * @param     Int   	$pay_amt			支付金额，单位为分---Int
	 * @param     string   	$order_info			订单详情---String
	 */
	 
	public static function xianBankPay($order_no, $pay_amt, $order_info){
		vendor('XianBankPay.XianBankPay');
		
		$out['ORDER_NO']		=	$order_no;
		$out['MCHNT_NO']		=	'444791054117788'; //商户号
		$out['PAY_AMT']	 		=	$pay_amt;
		$out['CHANNEL_ID']		=	'10008'; //渠道ID
		$out['ORDER_INFO']		=	$order_info;
		
		$signclass = new \ XianBankPay();
		//$signature = urlencode($signclass->getSign($out));
		$signature = $signclass->getSign($out);
		$certId = $signclass->getCertId();
		if(empty($signature)){
			$result['errcode'] = '1';
			$result['errmsg'] = '签名失败';
			$result['data'] = $out;
			$result['certId'] = $certId;
			return $result;
		}
		
		//$plain = urlencode('ORDER_NO='.$order_no.'$$MCHNT_NO='.$out['MCHNT_NO'].'$$PAY_AMT='.$pay_amt.'$$CHANNEL_ID='.$out['CHANNEL_ID'].'$$ORDER_INFO='.$order_info);
		$plain = 'ORDER_NO='.$order_no.'$$MCHNT_NO='.$out['MCHNT_NO'].'$$PAY_AMT='.$pay_amt.'$$CHANNEL_ID='.$out['CHANNEL_ID'].'$$ORDER_INFO='.$order_info;
		
		//header("Location: http://sit.m.xacbank.com/XAWBank/toPayee.xa?PLAIN=".$plain."&SIGNATURE=".$signature."");
		//$url['url'] = "http://sit.m.xacbank.com/XAWBank/toPayee.xa?PLAIN=".$plain."&SIGNATURE=".$signature."";
		//$url['out'] = $out;
		//return $url;
		
		$html = '<meta http-equiv = "content-Type" content = "text/html; charset = "utf-8"/>';
		$html .= '<form  method="get" action="http://sit.m.xacbank.com/XAWBank/toPayee.xa">';
		$html .= '<input type="hidden" name="PLAIN" value="'.$plain.'"/><br>';
		$html .= '<input type="hidden" name="SIGNATURE" value="'.$signature.'"/><br>';
		$html .= '<input type="submit" value="提交支付" id="dh" style="display:none">';
		$html .= '<script>var a=document.getElementById("dh");a.click();</script>';
		$html .= '</form>';
		return $html;
	}
	

}
?>