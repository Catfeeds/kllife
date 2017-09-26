<?php

namespace Back\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackOrderHelp;
use Core\Model\BackTeamHelp;
use Core\Model\BackAccountHelp;
use Core\Model\MsgHelp;
use Think\Log;

class ExternalController extends BackBaseController {

	protected function _initialize() {		
		$this->page_title = '外部接口';
		$this->content_title_show = 1;
		$this->menu_active = 'order';
	}
	
	// 外部接口
	private function getOrderList($param) {		
		if (!array_key_exists('cds', $param) || !array_key_exists('iDisplayStart', $param) || !array_key_exists('iDisplayLength', $param)) {
			$data['result'] = error(-1, '主要参数不齐全，获取数据失败');
			return $this->ajaxReturn($data);
		}
		
		
		$totalCount = 0;		
		$lineObj = ModelBase::getInstance('lineenertname', 'xz_');
		$colNames = $lineObj->getUserDefine(ModelBase::DF_COL_NAMES);	
		
		$output = array();
		$ds = BackOrderHelp::getOrderList($param['cds'], $param['iDisplayStart'], $param['iDisplayLength'], $totalCount, 'addtime', true, $output);
	
		if (is_error($ds)) {
			$data['result'] = $ds;
		} else {
			if (empty($ds)) {
				$ds = array();
			} else {
				$ds = BackOrderHelp::fillOrderInfo($ds);
				if (count($ds) > 0) {
					$k = 0;
					foreach ($ds[0] as $dataKey=>$dataVal) {
						$colNames[$k] = $dataKey;
						$k++;
					}
				}
			}		
		}
 			
		$data['sColumns'] = $colNames;
		$data['sEcho'] = $param['sEcho'];	
		$data['iDisplayStart'] = $param['iDisplayStart'];
		$data['iDisplayLength'] = $param['iDisplayLength'];
		$data['iTotalRecords'] = $totalCount;
		$data['iTotalDisplayRecords'] = $totalCount;
		$data['aaData'] = $ds;		
		$data['result'] = error(0,"");
		$data['robot'] = $output['robot'];
		if (is_error($ds)) {
			$data['result'] = $ds;
		}
		return $this->ajaxReturn($data);
	}
	
	// 刷新订单状态
	private function refreshOrderState($param) {	
		$data['admin_id'] = 0;
		$op_type_id = MyHelp::IdEachTypeKey('op_type', 'update');
		if (is_error($op_type_id) === false) {
			$data['op_type_id'] = $op_type_id;
		}
		$data['table_name'] = 'xz_lineenertname[订单信息]';
		$data['content'] = '收到客户端发起的刷新订单状态请求，订单编号='.a_2_s($param);
		$data['create_time'] = fmtNowDateTime();
		$logObj = ModelBase::getInstance('op_log');
		
		$rs = $logObj->create($data);
		if (error_ok($rs) === false) {
			Log::write('ModelBase::writeLog ['.fmtNowDateTime().'] errno:'. $rs['errno'] . ', errmsg:' . $rs['msg'], Log::ERR);
		}
		
		if (!array_key_exists('id', $param)) {
			$data['result'] = error(-1, '主要参数不齐全，获取数据失败'.a_2_s($param));
			return $this->ajaxReturn($data);
		}
		
		$data['result'] = BackOrderHelp::setOrderStateBySystem($param['id']);
		return $this->ajaxReturn($data);
	}
	
	// 获取类型数据
	private function getTypeData($param) {
		
		$data['result'] = error(0, '');
		
		$data['ds'] = BackTeamHelp::getTypeData();
		
		return $this->ajaxReturn($data);
		
	}
	
	// 创建小包团
	private function createTeamGroup($param) {
		
		$data['result'] = BackTeamHelp::createTeamGroup($param, $teamId);
		
		$data['team_id'] = $teamId;
		
		return $this->ajaxReturn($data);
		
	}
	
	private function checkNeedData($aa) {
		if ($aa['func'] === 'get_order_list' || 
			$aa['func'] === 'refresh_order_state' || 
			$aa['func'] === 'create_team_group' ||
			$aa['func'] === 'user_login') {
			if (!array_key_exists('data', $aa)) {
				return false;
			}
			return $aa['data'];
		}
		return true;
	}
	
	private function userLogin($param) {
		$userObj = ModelBase::getInstance('user');		
		if (!empty($aa['account'])) {
			$conds = appendLogicExp('phone', '=', $account);	
			$user =  BackAccountHelp::getAccount('account_user', $conds);
			if (is_error($user) === true) {
				$conds = appendLogicExp('email', '=', $account);	
				$user =  BackAccountHelp::getAccount('account_user', $conds);
				if (is_error($user) === true) {
					$conds = appendLogicExp('username', '=', $account);	
					$user = BackAccountHelp::getAccount('account_user', $conds);
				}
			}
		} else {
			$data['result'] = error(-1, '登录账号信息不能为空');
			return $this->ajaxReturn($data);
		}
		
		if (is_error($user)) {
			$data['result'] = error(-2, '查无次登录账户，请再次确认后登录');
			$this->ajaxReturn($data);
		}
		
		if (empty($param['password'])) {
			$data['result'] = error(-1, '登录密码不能为空');
			$this->ajaxReturn($data);
		}
		$cmpPassword = md5(md5($param['password']).$user['salt']);
		if ($cmpPassword === $user['password']) {
			// 更新登录记录
			$ds['last_login_time'] = $user['login_time'];
			$ds['last_login_ip'] = $user['login_ip'];
			$ds['login_time'] = fmtNowDateTime();
			$ds['login_ip'] = get_client_ip();								
			$data['modify_result'] = $userObj->modify($ds, $conds);						
			$user['last_login_time'] = $user['login_time'];
			$user['last_login_ip'] = $user['login_ip'];
			$user['login_time'] = $ds['login_time'];
			$user['login_ip'] = $ds['login_ip'];
			$data['result'] = error(0, '登录成功');
			$data['user'] = $user;
		} else {
			$data['result'] = error(-1, '登录账户或密码错误');
		}
		$this->ajaxReturn($data);
	}
	
	public function apiAction() {
//		header('Access-Control-Allow-Origin:http://kllife.com');
		header('Access-Control-Allow-Origin:*');
		if (IS_POST) {
			
			$func = I('post.func', false);
			if ($func === false) {
				$data['result'] = error(-1, '请求接口不明确'.a_2_s($aa));
				return $this->ajaxReturn($data);
			}
							
			$aa = $_POST;
			$param = $this->checkNeedData($aa);
			if (empty($param)) {
				$data['result'] = error(-1, '接口需要的必要数据不完整');
				return $this->ajaxReturn($data);
			}
						
			if ($func === 'get_order_list') {
				$this->getOrderList($param);
			} else if ($func === 'refresh_order_state') {
				$this->refreshOrderState($param);
			} else if ($func === 'get_type_data') {
				$this->getTypeData($param);
			} else if ($func === 'create_team_group') {
				$this->createTeamGroup($param);
			} else if ($func === 'user_login') {
				$this->userLogin($param);
			} else {
				$data['result'] = error(-1, '请求接口不存在');
				return $this->ajaxReturn($data);
			}
			
		} else {
			$data['result'] = error(-1, '错误的请求类型');
			return $this->ajaxReturn($data);
		}
	}
	
	// 支付平台回执接口
	public function payresultAction() {
		header('Access-Control-Allow-Origin:*');
		$logObj = ModelBase::getInstance('op_log');	
		$logDS['table_name'] = 'xz_pay_log[在线支付]';
		$logDS['create_time'] = fmtNowDateTime();	
		
		// 是否收到银行的处理数据记录
//		$logDS['content'] = '收到银行反馈的付款消息，='.a_2_s($_POST);
//		$logObj->create($logDS);
		
		if (IS_POST) {
			// 以下为支付接口回调响应内容，
			$ext = I('post.Ext1', false);
			if ($ext === false) {
				$logDS['content'] = '反馈内容错误，返回的错误字符串如下：'.$ext;
				$logObj->create($logDS);
				//return $this->ajaxReturn('Error');
				echo 'Error';
			} else {
				$ds['datetime'] = time();
				$ds['SendTime'] = I('post.SendTime', date('YmdHis', time()));
				$ds['order_sn'] = I('post.OrderNo', '');
				
				$ds['InstCode'] = I('post.InstCode', '');
				$ds['TransNo'] = I('post.TransNo', '');
				$ds['TransAmount'] = I('post.TransAmount', 0);
				$payChannel = MyHelp::MenuItemKey2Value('pay_menu',$ext);
				if (is_error($payChannel) === true) {
					$logDS['content'] = '渠道类型错误，错误原因如下：'.a_2_s($payChannel).',Ext:'.$ext.',Post:'.a_2_s($_POST);
					$logObj->create($logDS);
					//return $this->ajaxReturn('OK');
					echo 'OK';
					exit();
				}
				$ds['PayChannel'] = $payChannel;
				
				// 订单支付重复信息判断
				$payObj = ModelBase::getInstance('pay_log', 'xz_');
				$conds = appendLogicExp('TransNO', '=', $ds['TransNo']);
				$payLogCount = $payObj->getCount($conds);
				if (intval($payLogCount) > 0) {
					//return $this->ajaxReturn('OK');
					echo 'OK';
					exit();
				}
				
				// 获取真实的订单编号
				$order_sn = BackOrderHelp::getRealOrderSN($ds['order_sn']);
				
				// 获取支付订单的信息, 信息入库成功失败判断以及后续处理	
				$orderObj = ModelBase::getInstance('lineenertname', 'xz_');	
				$order = $orderObj->getOne(appendLogicExp('order_sn', '=', $order_sn));
				if (!empty($order)) {
					$ds['order_id'] = $order['id'];	
				}
				
				// 支付信息入库		
				$colNames = $payObj->getUserDefine(ModelBase::DF_COL_NAMES);
				$ds = coll_elements_giveup($colNames, $ds);
				$result = $payObj->create($ds, $payId);				
				$data['result'] = $result;				
				
				
				// 根据订单支付写入结果处理后续事情
				if (!empty($order)) {
					$superviseContent = '订单支付';
					if (error_ok($result)===true) {					
						$superviseContent .= $ds['TransAmount'].'元成功,';
						// 交易成功确定使用优惠券
						$data['coupon_result'] = BackOrderHelp::getOrderUserCoupon($order['id'], 'use');
						$superviseContent .= '优惠券使用结果:'.$data['coupon_result']['message'].',';
						// 刷新订单的状态
						$data['state_result'] = BackOrderHelp::setOrderStateBySystem($order['id']);
						$superviseContent .= '状态刷新结果:'.$data['state_result']['message'];
						
					} else {					
						$superviseContent .= $ds['TransAmount'].'元失败,';
						// 交易失败，恢复优惠券
						$data['coupon_result'] = BackOrderHelp::getOrderUserCoupon($order['id'], 'recover');
						$superviseContent .= '优惠券恢复结果:'.$data['coupon_result']['message'];
					}
					// 即时跟踪支付情况记录
					$data['supervise_result'] = BackOrderHelp::writeSupervise($order['id'], $superviseContent);
				} else {
					$data['order_result'] = '订单编号'.$order_sn.'未能找到订单信息';
				}
								
				$logDS['content'] = '交易编号:'.$ds['TransNo'].'，订单'.$ds['order_sn'].'的处理结果如下：'.a_2_s($data);
				$logObj->create($logDS);
				// 反馈错误成功信息给银行
				//$this->ajaxReturn(error_ok($result)===true ? 'OK' : 'Error');
				if(error_ok($result)===true){
					echo 'OK';
					exit();
				}else{
					echo 'Error';
					exit();
				}
			}
		}
	}
	
	// 自开发阿里支付数据返回接口	
	public function alipayresultAction() {
		header('Access-Control-Allow-Origin:*');
		$logObj = ModelBase::getInstance('op_log');	
		$logDS['table_name'] = 'xz_pay_log[在线支付]';
		$logDS['create_time'] = fmtNowDateTime();	
		
		// 是否收到银行的处理数据记录
		$logDS['content'] = '收到银行反馈的付款消息，='.a_2_s($_POST);
		$logObj->create($logDS);
				
		if (IS_POST) {
			// 以下为支付接口回调响应内容，
			$ds['datetime'] = time();
			$notifyTime = I('post.notify_time','');
			if (empty($notifyTime)) {
				$notifyTime = date('YmdHis', time());
			} else {
				$notifyTime = date('YmdHis', strtotime($notifyTime));
			}
			$ds['SendTime'] = $notifyTime;
			$ds['order_sn'] = I('post.out_trade_no', '');
			$ds['InstCode'] = 'ALZF';
			$ds['TransNo'] = I('post.trade_no', '');
			$ds['TransAmount'] = I('post.total_fee', 0);
			$payChannel = MyHelp::MenuItemKey2Value('pay_menu', 'zhifubao');
			if (is_error($payChannel) === true) {
				$logDS['content'] = '渠道类型错误，错误原因如下：'.a_2_s($payChannel).'/'.a_2_s($_POST);
				$logObj->create($logDS);
				return $this->ajaxReturn('fail');
			}
			$ds['PayChannel'] = $payChannel;
			
			// 订单支付重复信息判断
			$payObj = ModelBase::getInstance('pay_log', 'xz_');
			$conds = appendLogicExp('TransNO', '=', $ds['TransNo']);
			$payLogCount = $payObj->getCount($conds);
			if (intval($payLogCount) > 0) {
				return $this->ajaxReturn('success');
			}
			
			// 获取真实的订单编号
			$order_sn = BackOrderHelp::getRealOrderSN($ds['order_sn']);
			
			// 获取支付订单的信息, 信息入库成功失败判断以及后续处理	
			$orderObj = ModelBase::getInstance('lineenertname', 'xz_');	
			$order = $orderObj->getOne(appendLogicExp('order_sn', '=', $order_sn));
			if (!empty($order)) {
				$ds['order_id'] = $order['id'];	
			}
			
			// 支付信息入库		
			$colNames = $payObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$ds = coll_elements_giveup($colNames, $ds);
			$result = $payObj->create($ds, $payId);				
			$data['result'] = $result;				
			
			// 根据订单支付写入结果处理后续事情
			if (!empty($order)) {
				$superviseContent = '订单支付';
				if (error_ok($result)===true) {					
					$superviseContent .= $ds['TransAmount'].'元成功,';
					// 交易成功确定使用优惠券
					$data['coupon_result'] = BackOrderHelp::getOrderUserCoupon($order['id'], 'use');
					$superviseContent .= '优惠券使用结果:'.$data['coupon_result']['message'].',';
					// 刷新订单的状态
					$data['state_result'] = BackOrderHelp::setOrderStateBySystem($order['id']);
					$superviseContent .= '状态刷新结果:'.$data['state_result']['message'];
					
				} else {					
					$superviseContent .= $ds['TransAmount'].'元失败,';
					// 交易失败，恢复优惠券
					$data['coupon_result'] = BackOrderHelp::getOrderUserCoupon($order['id'], 'recover');
					$superviseContent .= '优惠券恢复结果:'.$data['coupon_result']['message'];
				}
				// 即时跟踪支付情况记录
				$data['supervise_result'] = BackOrderHelp::writeSupervise($order['id'], $superviseContent);
			} else {
				$data['order_result'] = '订单编号'.$order_sn.'未能找到订单信息';
			}
							
			$logDS['content'] = '交易编号:'.$ds['TransNo'].'，订单'.$ds['order_sn'].'的处理结果如下：'.a_2_s($data);
			$logObj->create($logDS);
			// 反馈错误成功信息给银行
			$this->ajaxReturn(error_ok($result)===true ? 'success' : 'fail');
		} else {
			echo ('get 访问无效!!!');
		}
	}
		
	
	// 自开发微信支付数据返回接口	
	public function wxpayresultAction() {
		header('Access-Control-Allow-Origin:*');
		$logObj = ModelBase::getInstance('op_log');	
		$logDS['table_name'] = 'xz_pay_log[在线支付]';
		$logDS['create_time'] = fmtNowDateTime();	
		
		// 是否收到银行的处理数据记录
		$logDS['content'] = '收到银行反馈的付款消息，='.a_2_s($_POST);
		$logObj->create($logDS);
				
		if (IS_POST) {
			// 以下为支付接口回调响应内容，
			$ds['datetime'] = time();
			$ds['SendTime'] = I('post.time_end', date('YmdHis', time()));
			$ds['order_sn'] = I('post.out_trade_no', '');
			$ds['InstCode'] = I('post.bank_type', '');
			$ds['TransNo'] = I('post.transaction_id', '');
			$ds['TransAmount'] = I('post.total_fee', 0.00);
			$payChannel = MyHelp::MenuItemKey2Value('pay_menu', 'weixin_pay');
			if (is_error($payChannel) === true) {
				$logDS['content'] = '渠道类型错误，错误原因如下：'.a_2_s($payChannel).'/'.a_2_s($_POST);
				$logObj->create($logDS);
				return $this->ajaxReturn('fail');
			}
			$ds['PayChannel'] = $payChannel;
			
			// 订单支付重复信息判断
			$payObj = ModelBase::getInstance('pay_log', 'xz_');
			$conds = appendLogicExp('TransNO', '=', $ds['TransNo']);
			$payLogCount = $payObj->getCount($conds);
			if (intval($payLogCount) > 0) {
				return $this->ajaxReturn('success');
			}
			
			// 获取真实的订单编号
			$order_sn = BackOrderHelp::getRealOrderSN($ds['order_sn']);
			
			// 获取支付订单的信息, 信息入库成功失败判断以及后续处理	
			$orderObj = ModelBase::getInstance('lineenertname', 'xz_');	
			$order = $orderObj->getOne(appendLogicExp('order_sn', '=', $order_sn));
			if (!empty($order)) {
				$ds['order_id'] = $order['id'];
			}
			
			// 支付信息入库		
			$colNames = $payObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$ds = coll_elements_giveup($colNames, $ds);
			$result = $payObj->create($ds, $payId);				
			$data['result'] = $result;				
						
			// 根据订单支付写入结果处理后续事情
			if (!empty($order)) {
				// 根据订单支付写入结果处理后续事情
				$superviseContent = '订单支付';
				if (error_ok($result)===true) {					
					$superviseContent .= $ds['TransAmount'].'元成功,';
					// 交易成功确定使用优惠券
					$data['coupon_result'] = BackOrderHelp::getOrderUserCoupon($order['id'], 'use');
					$superviseContent .= '优惠券使用结果:'.$data['coupon_result']['message'].',';
					// 刷新订单的状态
					$data['state_result'] = BackOrderHelp::setOrderStateBySystem($order['id']);
					$superviseContent .= '状态刷新结果:'.$data['state_result']['message'];
					
				} else {					
					$superviseContent .= $ds['TransAmount'].'元失败,';
					// 交易失败，恢复优惠券
					$data['coupon_result'] = BackOrderHelp::getOrderUserCoupon($order['id'], 'recover');
					$superviseContent .= '优惠券恢复结果:'.$data['coupon_result']['message'];
				}
				// 即时跟踪支付情况记录
				$data['supervise_result'] = BackOrderHelp::writeSupervise($order['id'], $superviseContent);
			} else {
				$data['order_result'] = '订单编号'.$order_sn.'未能找到订单信息';
			}
							
			$logDS['content'] = '交易编号:'.$ds['TransNo'].'，订单'.$ds['order_sn'].'的处理结果如下：'.a_2_s($data);
			$logObj->create($logDS);
			// 反馈错误成功信息给银行
			$this->ajaxReturn(error_ok($result)===true ? $payId : 'fail');
		} else {
			echo ('get 访问无效!!!');
		}
	}



	/**
	 * 西安银行在线支付后台回调		请求方式：POST
	 * 
	 * @access    public
	 * @param     string   	ORDER_NO		订单号---String
	 * @param     Int   	PAY_STATUS		支付状态---Int(成功：1,失败：0)
	 * @param     Int   	BANK_TYPE		银行类别---Int(他行：1,本行：0)
	 * @param     String   	PAY_LOG_ID		支付流水号---String
	 * @param     Int   	ORDER_AMT		支付金额，单位为分---Int
	 * @param     string   	ACC_NO   		卡号---String
	 * @param     string   	SIGNATURE   	签名值---String
	 * 
	 * 
	 * @return    int		RETURN_CODE			响应码
	 * @return    string	RETURN_MSG			响应信息
	 * 
	 */
	
	public function xianBankCallBackAction(){
		header('Access-Control-Allow-Origin:*');
		$logObj = ModelBase::getInstance('op_log');	
		$logDS['table_name'] = 'xz_pay_log[在线支付]';
		$logDS['create_time'] = fmtNowDateTime();

		// 是否收到银行的处理数据记录
		$post_str = json_decode(@file_get_contents("php://input"), true);
		if($post_str == ''){
			$result['RETURN_CODE'] = '6';
			$result['RETURN_MSG'] = 'POST参数为空，请重试';			
			$this->ajaxReturn($result,'JSON');
		}else{
			//$result['RETURN_CODE'] = '7';
			//$result['RETURN_POST'] = $post_str;
			//$result['RETURN_ORDER_NO'] = $post_str['ORDER_NO'];;
			//$result['RETURN_POST_STR'] = a_2_s($post_str);			
			//$this->ajaxReturn($result,'JSON');	
				
			$logDS['content'] = '收到银行反馈的付款消息，='.a_2_s($post_str);
			$logObj->create($logDS);
		}
		
		if(IS_POST){
			$ds['datetime'] = time();
			$ds['SendTime'] = date('YmdHis', time());
			$ds['order_sn'] = $post_str['ORDER_NO'];
			$ds['InstCode'] = $post_str['BANK_TYPE'];
			$ds['TransNo'] = $post_str['PAY_LOG_ID'];
			$ds['TransAmount'] = bcdiv($post_str['ORDER_AMT'], 100, 2);
			$payChannel = MyHelp::MenuItemKey2Value('pay_menu', 'pay_menu_xianbank_pay');
			if (is_error($payChannel) === true) {
				$logDS['content'] = '渠道类型错误，错误原因如下：'.a_2_s($payChannel).'/'.a_2_s($post_str);
				$logObj->create($logDS);
				$result['RETURN_CODE'] = '3';
				$result['RETURN_MSG'] = '支付渠道类型错误';
				$this->ajaxReturn($result,'JSON');		
			}
			$ds['PayChannel'] = $payChannel;
			
			// 订单支付重复信息判断
			$payObj = ModelBase::getInstance('pay_log', 'xz_');
			$conds = appendLogicExp('TransNO', '=', $ds['TransNo']);
			$payLogCount = $payObj->getCount($conds);
			if (intval($payLogCount) > 0) {
				$result['RETURN_CODE'] = '4';
				$result['RETURN_MSG'] = '该笔支付信息已经录入';
				$this->ajaxReturn($result,'JSON');
				
			}
			
			// 获取真实的订单编号
			$order_sn = BackOrderHelp::getRealOrderSN($ds['order_sn']);
			
			// 获取支付订单的信息, 信息入库成功失败判断以及后续处理	
			$orderObj = ModelBase::getInstance('lineenertname', 'xz_');	
			$order = $orderObj->getOne(appendLogicExp('order_sn', '=', $order_sn));
			if (!empty($order)) {
				$ds['order_id'] = $order['id'];	
			}
			
			// 支付信息入库		
			$colNames = $payObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$ds = coll_elements_giveup($colNames, $ds);
			$intresult = $payObj->create($ds, $payId);				
			$data['intresult'] = $intresult;
			
			// 根据订单支付写入结果处理后续事情
			if (!empty($order)) {
				// 根据订单支付写入结果处理后续事情
				$superviseContent = '订单支付';
				if (error_ok($intresult)===true) {					
					$superviseContent .= $ds['TransAmount'].'元成功,';
					// 交易成功确定使用优惠券
					$data['coupon_result'] = BackOrderHelp::getOrderUserCoupon($order['id'], 'use');
					$superviseContent .= '优惠券使用结果:'.$data['coupon_result']['message'].',';
					// 刷新订单的状态
					$data['state_result'] = BackOrderHelp::setOrderStateBySystem($order['id']);
					$superviseContent .= '状态刷新结果:'.$data['state_result']['message'];
					
				} else {					
					$superviseContent .= $ds['TransAmount'].'元失败,';
					// 交易失败，恢复优惠券
					$data['coupon_result'] = BackOrderHelp::getOrderUserCoupon($order['id'], 'recover');
					$superviseContent .= '优惠券恢复结果:'.$data['coupon_result']['message'];
				}
				// 即时跟踪支付情况记录
				$data['supervise_result'] = BackOrderHelp::writeSupervise($order['id'], $superviseContent);
			} else {
				$data['order_result'] = '订单编号'.$order_sn.'未能找到订单信息';
			}
							
			$logDS['content'] = '交易编号:'.$ds['TransNo'].'，订单'.$ds['order_sn'].'的处理结果如下：'.a_2_s($data);
			$logObj->create($logDS);
			
			// 反馈错误成功信息给银行
			if(error_ok($intresult)===true){
				$result['RETURN_CODE'] = '1';
				$result['RETURN_MSG'] = '响应成功';
				$this->ajaxReturn($result,'JSON');
			}else{
				$result['RETURN_CODE'] = '5';
				$result['RETURN_MSG'] = '相应失败';
				$this->ajaxReturn($result,'JSON');
			}
				
			
		}else{
			$result['RETURN_CODE'] = '2';
			$result['RETURN_MSG'] = '错误的请求类型';
			$this->ajaxReturn($result,'JSON');
		}	
		
	}
}

?>