<?php
	function code_out($array) {
		$s = "[";
		if (is_array($array)) {
			foreach($array as $k => $v) {
				if (is_array($v)) {
					$s .= '<br />'.$k . ':';
					$s .= code_out($v);
				} else {
					$s .= '<br />{' . $k . '=>' . $v . '}';	
				}
			}
		} else {
			$s .= $array;
		}
		$s .= "<br />]";
		return $s;
	}

	if (isset($_GET['token']) && isset($_GET['appid'])) {
		$appid = $_GET['appid'];
		$url = 'http://kllife.com/wx_card/code.php';
		$redirect_url = urlencode($url);
		$state = $_GET['token'];
		$codeUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$redirect_url.'&response_type=code&scope=snsapi_userinfo&state='.$state.'#wechat_redirect';				   
		header('location:'.$codeUrl);
	} else  if (isset($_GET['code'])) {
		$state = urldecode($_GET['state']);
		$codeUrl = 'http://wsq.kllife.com/app/index.php?s=/app/weixin/code/c/'.$_GET['code'];
		header('location:'.$codeUrl);
	} else {
		echo('获取Code失败,error:'.code_out($_GET));
	}

?>