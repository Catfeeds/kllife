<?php
		
	//配置参数
	$App_ID = "wxefc029d4373dcac0";
	$App_Secret = "e44e9b95b4bfc2e34948b95064d2cace"; 
	
	//参数接收
	$CODE = $_GET['code'];
	if(empty($CODE)){
		//用户同意授权，获取code
		$redirect_url = urlencode('http://kllife.com/weixin/index.php');
		header("Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$App_ID."&redirect_uri=".$redirect_url."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect");
		exit();
	}


	//请求URL
	function get_message($url){
		if(function_exists('file_get_contents')){
			$file_contents = file_get_contents($url);
		}else{
			$ch = curl_init();
			$timeout = 5;
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$file_contents = curl_exec($ch);
			curl_close($ch);
		}
		return $file_contents;
	}

	
	//通过code换取网页授权access_token
	$acc_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$App_ID.'&secret='.$App_Secret.'&code='.$CODE.'&grant_type=authorization_code';
	
	$acc_result = get_message($acc_url);
	$acc_arr = (json_decode($acc_result,true));
	if(!empty($acc_arr['access_token'])){
		$access_token = $acc_arr['access_token'];
		$openid = $acc_arr['openid'];
	}else{
		$return_str = array("errcode"=>1,"errmsg"=>"获取[access_token]失败！");
	}
	
	//拉取用户信息
	$userinfo_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
	$userinfo_result = get_message($userinfo_url);
	$userinfo_arr = (json_decode($userinfo_result,true));
	if(!empty($userinfo_arr['unionid'])){
		$return_str = $userinfo_arr;
	}else{
		$return_str = array("errcode"=>2,"errmsg"=>"获取[unionid]失败！");
	}
	
	header('Location:http://kllife.com/phone/index.php?s=/phone/thirdLogin/OpenWXLogin/type/weixin/openid/'.$return_str['unionid']);
?>