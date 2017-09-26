<?php
	header('Access-Control-Allow-Origin:*');
	
	// 检测设备类型
	function is_mobile_device(&$out) {
		if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
			$out = 1;
			return true;
		}
		
	//	if (isset($_SERVER['HTTP_VIA'])) {
	//		$out = 2;
	//		return stripos(strtolower($_SERVER['HTTP_VIA']), 'wap') ? true : false;
	//	}
		
		$out = 3;
		$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
		if ( stripos($agent, 'android') !== FALSE ||
			stripos($agent, 'ipad') !== FALSE ||
			stripos($agent, 'iphone') !== FALSE ||
			stripos($agent, 'rim tablet os') !== FALSE ||
			stripos($agent, 'touch') !== FALSE ||
			stripos($agent, 'windows phone') !== FALSE ||
			stripos($agent, 'kfapwi build') !== FALSE ||
			stripos($agent, 'meego') !== FALSE ) {
				return true;
		} else {
			return false;
		}
	}
	
 	$code = $_GET['code'];  	
 	if (empty($code)) {
 		echo '授权失败！';
		
	} 
	header( "HTTP/1.1 301 Moved Permanently" ); 
	$url = "http://kllife.com/home/index.php?s=/home/thirdLogin/callback/type/qq/code/".$code; 
	$isMobileDevice = is_mobile_device($out);
	if($isMobileDevice){
		if ($_SERVER['SERVER_NAME'] == 'kllife.com') {
			$url = str_replace('home', 'phone', $url);
		} else if ($_SERVER['SERVER_NAME'] == 'xinlvpai.com') {
			$host = 'm.'.$host;
			$url = str_replace('qinglvpai', 'qlpphone', $url);
		}
	}else{
		if ($_SERVER['SERVER_NAME'] == 'kllife.com') {
			$url = str_replace('phone', 'home', $url);
		} else if ($_SERVER['SERVER_NAME'] == 'xinlvpai.com') {
			$host = str_replace('m.', '', $host);
			$url = str_replace('qlpphone', 'qinglvpai', $url);
		}
	}
	header( "Location: $url" );
	
	
  ?>