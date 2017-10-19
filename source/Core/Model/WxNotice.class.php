<?php
namespace Core\Model;

use Core\Model\MyHelp;
 
class WxNotice {
	protected $appId = NULL;
	protected $appSecret = NULL;
	protected $wxAccessToken = NULL;
	protected $wxAccessTokenTime = NULL;
	
	function __construct($appId, $appSecret) {
		$this->appId = $appId;
		$this->appSecret = $appSecret;
	}
	
	public function refresh() {
		S('wx_'.$this->appId, $this, 7200);
	}
	
	public static function getInstance($appId, $appSecret, $refresh = false) {
		if (empty($appId)) {
			$appId = C('WX_APP_ID');
		}
		if (empty($appSecret)) {
			$appSecret = C('WX_APP_SECRET');
		}
		$wxObj = S('wx_'.$appId);
		if (empty($wxObj) || !empty($refresh)) {
			$wxObj = new WxNotice($appId, $appSecret);
			S('wx_'.$appId, $wxObj, 7200);
		}
		return $wxObj;
	}
	
		
	/**
     *  获取微信公众号开发ACCESS_TOKEN
     *
     * @access    public
	 * 
     * @return    array  $return_str
    */
    public function getAccessToken(){
    	if (empty($this->wxAccessTokenTime) || (intval(time()- $this->wxAccessTokenTime) > 7190)) {
			$accUrl = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appId.'&secret='.$this->appSecret;
			$result = MyHelp::curl_post($accUrl, '');
			$str = json_decode($result, true);
			
			if($str['access_token']!=''){
				$this->wxAccessToken = $str['access_token'];
				$this->wxAccessTokenTime = time();
				$this->refresh();
			}else{
				return error($str['errcode'], $str['errmsg'].'------------'.C('APP_ID').'-------'.$this->appSecret);
			}
		}
		return $this->wxAccessToken;
	}


		
	/**
     *  发送下单通知
     *
     * @access    public
     * 
	 * @param     string  $touser				接收者openid
	 * @param     string  $url					模板跳转链接  
	 * @param     string  $title				通知标题
	 * @param     string  $orderId				订单编号
	 * @param     string  $lineTitle			线路标题
	 * @param     string  $addTime				订单时间
	 * @param     string  $message				提示消息
	 * 
     * @return    array
    */
	public function sendCreateOrderNotice($touser, $url, $title, $orderId, $lineTitle, $addTime, $message){
		$accessToken = $this->getAccessToken();
		if(is_error($accessToken) == ture){
			$accessToken['message'] .= '，发送下单通知失败！';
			return $accessToken;
		}
		
		$sendUrl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$accessToken;
		$postData = array(
			'touser'=>$touser,
			'template_id'=>'12zVe5Qmk9GMFePNgKxVSPqsCOzg_hngvRNNSNLJFXY',
			'url'=>$url,          
			'data'=>array(
				'first'=>array(
					'value'=>$title
				),				
				'OrderID'=>array(
					'value'=>$orderId
				),
				'PkgName'=>array(
					'value'=>$lineTitle
				),
				'TakeOffDate'=>array(
					'value'=>$addTime
				),
				'Remark'=>array(
					'value'=>$message
				)
			)
		);
		
		$result = MyHelp::curl_post($sendUrl, json_encode($postData));
		$data['result'] = json_decode($result, true);
		$data['url'] = $sendUrl;
		$data['post'] = $postData;
		return $data;
	}
	
	/**
     *  行程即将开始提醒
     *
     * @access    public
     * 
	 * @param     string  $touser				接收者openid
	 * @param     string  $url					模板跳转链接  
	 * @param     string  $title				通知标题
	 * @param     string  $lineTitle			线路标题
	 * @param     string  $startTime			行程开始时间
	 * @param     string  $message				提示消息
	 * 
     * @return    array
    */
    public function sendTripStartNotice($touser, $url, $title, $lineTitle, $startTime, $message){
    	$accessToken = $this->getAccessToken();
		if(is_error($accessToken) == ture){
			$accessToken['message'] .= '，发送行程即将开始提醒失败！';
			return $accessToken;
		}
		
		$sendUrl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$accessToken;
		$postData = array(
			'touser'=>$touser,
			'template_id'=>'0SStiq4K4zj8r7WyI3XFKPIw0153Nm_d5vrcQ07RDhs',
			'url'=>$url,          
			'data'=>array(
				'first'=>array(
					'value'=>$title
				),
				'keyword1'=>array(
					'value'=>$lineTitle
				),
				'keyword2'=>array(
					'value'=>$startTime
				),
				'remark'=>array(
					'value'=>$message
				)
			)
		);
		
		$result = MyHelp::curl_post($sendUrl, json_encode($postData));
		$data['result'] = json_decode($result, true);
		$data['url'] = $sendUrl;
		$data['post'] = $postData;
		return $data;
    }
    
    /**
     *  好友出行通知
     *
     * @access    public
     * 
	 * @param     string  $touser				接收者openid
	 * @param     string  $url					模板跳转链接  
	 * @param     string  $title				通知标题
	 * @param     string  $fName				好友名称
	 * @param     string  $lineTitle			线路标题
	 * @param     string  $startTime			结束日期
	 * @param     string  $message				提示消息
	 * 
     * @return    array
    */
    public function sendFriendsTravelNotice($touser, $url, $title, $fName, $lineTitle, $endTime, $message){
		$accessToken = $this->getAccessToken();
		if(is_error($accessToken) == ture){
			$accessToken['message'] .= '，发送好友出行通知失败！';
			return $accessToken;
		}
		
		$sendUrl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$accessToken;
		$postData = array(
			'touser'=>$touser,
			'template_id'=>'AprpMWGDuBboBPgNSHubddHFNMbCaSHDxvJjTOKnEek',
			'url'=>$url,          
			'data'=>array(
				'first'=>array(
					'value'=>$title
				),
				'keyword1'=>array(
					'value'=>$fName
				),
				'keyword2'=>array(
					'value'=>$lineTitle
				),
				'keyword3'=>array(
					'value'=>$endTime
				),
				'remark'=>array(
					'value'=>$message
				)
			)
		);
		
		$result = MyHelp::curl_post($sendUrl, json_encode($postData));
		$data['result'] = json_decode($result, true);
		$data['url'] = $sendUrl;
		$data['post'] = $postData;
		return $data;
	}
	
	/**
     *  订单支付成功通知
     *
     * @access    public
     * 
	 * @param     string  $touser				接收者openid
	 * @param     string  $url					模板跳转链接  
	 * @param     string  $title				通知标题
	 * @param     string  $orderId				订单编号
	 * @param     string  $lineTitle			线路标题
	 * @param     string  $payamount			支付金额
	 * @param     string  $message				提示消息
	 * 
     * @return    array
    */
    public function sendPaySuccessNotice($touser, $url, $title, $orderId, $lineTitle, $payamount, $message){
		$accessToken = $this->getAccessToken();
		if(is_error($accessToken) == ture){
			$accessToken['message'] .= '，发送订单支付成功通知失败！';
			return $accessToken;
		}
		
		$sendUrl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$accessToken;
		$postData = array(
			'touser'=>$touser,
			'template_id'=>'KcsIQ_0MVMVYsU3mQn_HNGtxGqvZuHE7nGLq1BLzgd8',
			'url'=>$url,          
			'data'=>array(
				'first'=>array(
					'value'=>$title
				),
				'keyword1'=>array(
					'value'=>$orderId
				),
				'keyword2'=>array(
					'value'=>$lineTitle
				),
				'keyword3'=>array(
					'value'=>$payamount
				),
				'remark'=>array(
					'value'=>$message
				)
			)
		);
		
		$result = MyHelp::curl_post($sendUrl, json_encode($postData));
		$data['result'] = json_decode($result, true);
		$data['url'] = $sendUrl;
		$data['post'] = $postData;
		return $data;
	}
	
	/**
     *  订单状态变更通知
     *
     * @access    public
     * 
	 * @param     string  $touser				接收者openid
	 * @param     string  $url					模板跳转链接  
	 * @param     string  $title				通知标题
	 * @param     string  $orderId				订单编号
	 * @param     string  $orderPrice			订单金额
	 * @param     string  $orderStatus			订单状态
	 * @param     string  $lineTitle			线路标题
	 * @param     string  $message				提示消息
	 * 
     * @return    array
    */
    public function sendOrderStatusChangeNotice($touser, $url, $title, $orderId, $orderPrice, $orderStatus, $lineTitle, $message){
		$accessToken = $this->getAccessToken();
		if(is_error($accessToken) == ture){
			$accessToken['message'] .= '，发送订单状态变更通知失败！';
			return $accessToken;
		}
		
		$sendUrl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$accessToken;
		$postData = array(
			'touser'=>$touser,
			'template_id'=>'N5kZH3QSNI81gwjjFNwIZQXdJCOoaZx3EXChFQyGYpc',
			'url'=>$url,          
			'data'=>array(
				'first'=>array(
					'value'=>$title
				),
				'orderId'=>array(
					'value'=>$orderId
				),
				'orderPrice'=>array(
					'value'=>$orderPrice
				),
				'orderStatus'=>array(
					'value'=>$orderStatus
				),
				'productName'=>array(
					'value'=>$lineTitle
				),
				'remark'=>array(
					'value'=>$message
				)
			)
		);
		
		$result = MyHelp::curl_post($sendUrl, json_encode($postData));
		$data['result'] = json_decode($result, true);
		$data['url'] = $sendUrl;
		$data['post'] = $postData;
		return $data;
	}
	
	/**
     *  出团集合通知
     *
     * @access    public
     * 
	 * @param     string  $touser				接收者openid
	 * @param     string  $url					模板跳转链接  
	 * @param     string  $title				通知标题
	 * @param     string  $setTime 				集合时间
	 * @param     string  $setPlace				集合地点
	 * @param     string  $leaderName			领队导游信息
	 * @param     string  $message				提示消息
	 * 
     * @return    array
    */
    public function sendTravelSetNotice($touser, $url, $title, $setTime, $setPlace, $leaderName, $message){
		$accessToken = $this->getAccessToken();
		if(is_error($accessToken) == ture){
			$accessToken['message'] .= '，发送出团集合通知失败！';
			return $accessToken;
		}
		
		$sendUrl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$accessToken;
		$postData = array(
			'touser'=>$touser,
			'template_id'=>'NxSm8XEDgkwj_XI-ROtdunIktJ0XkT1ihXTIpsgT-KA',
			'url'=>$url,          
			'data'=>array(
				'first'=>array(
					'value'=>$title
				),
				'keyword1'=>array(
					'value'=>$setTime
				),
				'keyword2'=>array(
					'value'=>$setPlace
				),
				'keyword3'=>array(
					'value'=>$leaderName
				),
				'remark'=>array(
					'value'=>$message
				)
			)
		);
		
		$result = MyHelp::curl_post($sendUrl, json_encode($postData));
		$data['result'] = json_decode($result, true);
		$data['url'] = $sendUrl;
		$data['post'] = $postData;
		return $data;
	}
	
	/**
     *  预约旅行支付尾款通知
     *
     * @access    public
     * 
	 * @param     string  $touser				接收者openid
	 * @param     string  $url					模板跳转链接  
	 * @param     string  $title				通知标题
	 * @param     string  $orderId 				订单编号
	 * @param     string  $lineTitle			产品名称
	 * @param     string  $tripTime 			出行日期
	 * @param     string  $message				提示消息
	 * 
     * @return    array
    */
    public function sendPaySurplusNotice($touser, $url, $title, $orderId, $lineTitle, $tripTime, $message){
		$accessToken = $this->getAccessToken();
		if(is_error($accessToken) == ture){
			$accessToken['message'] .= '，发送预约旅行支付尾款通知失败！';
			return $accessToken;
		}
		
		$sendUrl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$accessToken;
		$postData = array(
			'touser'=>$touser,
			'template_id'=>'SDD3jIZcwgRroRcyc02omNIf5azcBS592uB_s2DBn4I',
			'url'=>$url,          
			'data'=>array(
				'first'=>array(
					'value'=>$title
				),
				'keyword1'=>array(
					'value'=>$orderId
				),
				'keyword2'=>array(
					'value'=>$lineTitle
				),
				'keyword3'=>array(
					'value'=>$tripTime
				),
				'remark'=>array(
					'value'=>$message
				)
			)
		);
		
		$result = MyHelp::curl_post($sendUrl, json_encode($postData));
		$data['result'] = json_decode($result, true);
		$data['url'] = $sendUrl;
		$data['post'] = $postData;
		return $data;
	}
	
	/**
     *  活动取消通知
     *
     * @access    public
     * 
	 * @param     string  $touser				接收者openid
	 * @param     string  $url					模板跳转链接  
	 * @param     string  $title				通知标题
	 * @param     string  $lineTitle 			活动名称
	 * @param     string  $tripTime				活动时间
	 * @param     string  $cause 				取消原因
	 * @param     string  $message				提示消息
	 * 
     * @return    array
    */
    public function sendTravelCancelNotice($touser, $url, $title, $lineTitle, $tripTime, $cause, $message){
		$accessToken = $this->getAccessToken();
		if(is_error($accessToken) == ture){
			$accessToken['message'] .= '，发送活动取消通知失败！';
			return $accessToken;
		}
		
		$sendUrl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$accessToken;
		$postData = array(
			'touser'=>$touser,
			'template_id'=>'SWJlhvRttR8zxUOIM5MCMLyF_HQ8rPpq6ihrEjHLgN8',
			'url'=>$url,          
			'data'=>array(
				'first'=>array(
					'value'=>$title
				),
				'keyword1'=>array(
					'value'=>$lineTitle
				),
				'keyword2'=>array(
					'value'=>$tripTime
				),
				'keyword3'=>array(
					'value'=>$cause
				),
				'remark'=>array(
					'value'=>$message
				)
			)
		);
		
		$result = MyHelp::curl_post($sendUrl, json_encode($postData));
		$data['result'] = json_decode($result, true);
		$data['url'] = $sendUrl;
		$data['post'] = $postData;
		return $data;
	}
	
	/**
     *  旅行评价通知
     *
     * @access    public
     * 
	 * @param     string  $touser				接收者openid
	 * @param     string  $url					模板跳转链接  
	 * @param     string  $title				通知标题
	 * @param     string  $lineTitle 			活动名称
	 * @param     string  $startTime			活动出发时间
	 * @param     string  $message				提示消息
	 * 
     * @return    array
    */
    public function sendTravelEvaluateNotice($touser, $url, $title, $lineTitle, $startTime, $message){
		$accessToken = $this->getAccessToken();
		if(is_error($accessToken) == ture){
			$accessToken['message'] .= '，发送旅行评价通知失败！';
			return $accessToken;
		}
		
		$sendUrl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$accessToken;
		$postData = array(
			'touser'=>$touser,
			'template_id'=>'Sh3DxhkH0PvpqR2OPknFuyGc_TtIeH2OxUKUhp2VFiI',
			'url'=>$url,          
			'data'=>array(
				'first'=>array(
					'value'=>$title
				),
				'keyword1'=>array(
					'value'=>$lineTitle
				),
				'keyword2'=>array(
					'value'=>$startTime
				),
				'remark'=>array(
					'value'=>$message
				)
			)
		);
		
		$result = MyHelp::curl_post($sendUrl, json_encode($postData));
		$data['result'] = json_decode($result, true);
		$data['url'] = $sendUrl;
		$data['post'] = $postData;
		return $data;
	}
}
?>