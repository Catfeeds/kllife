<?php
	header('Access-Control-Allow-Origin:*');
	require_once('./log.php');
	
	//post函数	
	function curl_post($url, $post_str, $referer = '') {	
		$cookie_file = "./";	
		$curl = curl_init();	
		curl_setopt($curl, CURLOPT_URL, $url); //要访问的地址 即要登录的地址页面		
		//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在	
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查	
		//curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr );	
		curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求	
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_str); // Post提交的数据包	
		//curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转	
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);	
		curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file); // 存放Cookie信息的文件名称	
		curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file); // 读取上面所储存的Cookie信息	
		curl_setopt($curl, CURLOPT_REFERER, $referer); //设置Referer	
		//	curl_setopt ( $curl, CURLOPT_USERAGENT, $_SERVER ['HTTP_USER_AGENT'] ); // 模拟用户使用的浏览器	
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0(iphone;CPU iphone OS 5_1_1 like Mac OS X) AppleWebKit/534.46(KHTML,like Geocko)Mobile/9B206 MicroMessenger/6.0"); // 模拟用户使用的浏览器	
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回	
		curl_setopt($curl, CURLOPT_HEADER, false); //获取header信息	
		$result = curl_exec($curl);	
		// print_r($result);	
		return $result;
	
	}
 	
 	 //将XML转为array
    function xmlToArray($xml)
    {    
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);        
        return $values;
    }

	function a_2_s($array) {
		$s = "[";
		if (is_array($array)) {
			foreach($array as $k => $v) {
				if (is_array($v)) {
					$s .= $k . ':';
					$s .= a_2_s($v);
				} else {
					$s .= '{' . $k . '=>' . $v . '}';	
				}
			}
		} else {
			$s .= $array;
		}
		$s .= "]";
		return $s;
	}
    
//    XML:{
//		"appid":"wxefc029d4373dcac0",
//		"bank_type":"CFT",
//		"cash_fee":"1",
//		"fee_type":"CNY",
//		"is_subscribe":"Y",
//		"mch_id":"1244967502",
//		"nonce_str":"zs74uhj1s6yjxzxck0tzq2vr2xanboav",
//		"openid":"orYumuAFxLGdyO7Su3wb9ENumlPo",
//		"out_trade_no":"LX-17021412244065201-1",
//		"result_code":"SUCCESS",
//		"return_code":"SUCCESS",
//		"sign":"BFCB69D10F45C7F58D5ABDB627E2453F",
//		"time_end":"20170224183355",
//		"total_fee":"1",
//		"trade_type":"NATIVE",
//		"transaction_id":"4000442001201702241161739475"
//	}
	
	$logHandler= new CLogFileHandler("./logs1/".date('Y-m-d').'.log');
	$log = Log::Init($logHandler, 15);
		
	$ds = xmlToArray($GLOBALS['HTTP_RAW_POST_DATA']);
 	Log::INFO('----------------------------------------');
 	Log::INFO('XML_DATA111:'.a_2_s($ds));
 	
 	foreach ($ds as $k=>$v) {
 		Log::INFO('k:'.$k.'=>'.$v);
 		if ($k == 'cash_fee' || $k == 'total_fee') {
 			$ds[$k] = bcmul($v, 0.01, 2);
		} else {
 			$ds[$k] = $v;	
		}
	}
		
 	Log::INFO('----------------------------------------');
 	Log::INFO('XML_DATA222:'.json_encode($ds));
 	
 	if (empty($ds)) {
		echo ('fail');
 		Log::WARN('alipay数据接口接受到的数据为空');
 		exit();
	} else {
		echo ('success');
	}
	
	$post_url = "http://kllife.com/back/index.php?s=/back/external/wxpayresult";
	$post_str = http_build_query($ds,'&');	
	$get_post_str =  curl_post($post_url,$post_str,$referer = '');
	$get_post_str = json_decode($get_post_str,true);
	
	if(empty($get_post_str)){
		Log::WARN('数据存储反馈为空！');
 		exit();
	}else{
		if($get_post_str == 'success'){
			Log::INFO('收到重复信息，并处理反馈成功！');
		} else if ($get_post_str == 'fail') {
			Log::WARN('数据存储反馈失败！');
			redirect('http://kllife.com/home/index.php?s=/home/line/wxpayresult/sn/'.$ds['out_trade_no'].'/no/'.$ds['transaction_id'].'/m/'.$ds['total_fee']);
		} else {
			Log::WARN('数据存储成功，并成功返回记录编号'.$get_post_str.'！');
			redirect('http://kllife.com/home/index.php?s=/home/line/wxpayresult/id/'.$get_post_str);
		}
	}
	Log::INFO($get_post_str);	
 	Log::INFO('写入结束!!!');
?>