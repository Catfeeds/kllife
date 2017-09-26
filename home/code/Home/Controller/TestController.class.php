<?php
namespace Home\Controller;
use Core\Model\ModelBase;
use Core\Model\MsgHelp;
use Core\Model\BackAccountHelp;

class TestController extends HomeBaseController {
	
	
	public function xapaytestAction(){
		header("Content-type:text/html;charset=utf-8");	
		$order_no		=	'LX-16081116164478634-w';
		$pay_amt		=	1980000;
		$pay_card_type	=	0;
		$order_info		=	'骑游欧洲';
		$aa = MsgHelp::xianBankPay($order_no, $pay_amt, $pay_card_type, $order_info);
		
		print_r($aa);
		exit;
	}
	
	public function getMPVideoUrlAction(){
		$url = I('post.MPurl', false);
		$con = $this->get_message($url);
		$data['con'] = $con;			
		$data['result'] = error(0, '获取成功');
		$this->ajaxReturn($data);	
	}
	
	//post函数
	protected function curl_post($url, $post_str, $referer = '') {
		$cookie_file = "./";
		
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, $url); //要访问的地址 即要登录的地址页面	
	    //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
		//curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr );
	    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_str); // Post提交的数据包
	    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
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

	//请求URL
	protected function get_message($url){
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
}

?>