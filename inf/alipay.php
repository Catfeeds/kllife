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
		
	$logHandler= new CLogFileHandler("./logs/".date('Y-m-d').'.log');
	$log = Log::Init($logHandler, 15);
		
 	Log::INFO('----------------------------------------');
 	$pst = json_encode($_POST); 	
 	Log::INFO($pst);
 	
 	if (empty($pst)) {
		echo ('fail');
 		Log::WARN('alipay数据接口接受到的数据为空');
 		exit();
	} else {
		echo ('success');
	}
	
	$post_url = "http://kllife.com/back/index.php?s=/back/external/alipayresult";
	$post_str = json_decode($pst,true);
	$post_str = http_build_query($post_str,'&');	
	$get_post_str =  curl_post($post_url,$post_str,$referer = '');
	$get_post_str = json_decode($get_post_str,true);
	
	if(empty($get_post_str)){
		Log::WARN('数据存储反馈为空！');
 		exit();
	}else{
		if($get_post_str == 'success'){
			Log::INFO('数据存储反馈成功！');
		}else{
			Log::WARN('数据存储反馈失败！');
		}
	}
	Log::INFO($get_post_str);	
 	Log::INFO('写入结束!!!');
 
  ?>