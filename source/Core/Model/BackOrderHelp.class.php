<?php
/**
 * Created by CodeLobster.
 * User: PF
 * Date: 2015/9/28
 * Time: 2015-9-28 04:05:10
 */

namespace Core\Model;
use Think\Log;

class BackOrderHelp {		
	// 缓存订单状态类型
	public static function cacheOrderStateType($returntype='key', $force=false) {
		return MyHelp::cacheTypeData('order_state_types', 'state_type', '', $returntype, $force);
	}
		
	// 缓存订单状态
	public static function cacheOrderState($returntype='key', $force=false) {
		return MyHelp::cacheTypeData('order_states', 'order_state', '', $returntype, $force);
	}
	
	// 缓存订单来源
	public static function cacheOrderFrom($returntype='key', $force=false) {
		return MyHelp::cacheTypeData('order_froms', 'order_from', '', $returntype, $force);
	}
	
	// 缓存订单成员类型
	public static function cacheMemberType($returntype='key', $force=false) {
		return MyHelp::cacheTypeData('member_types', 'member_type', '', $returntype, $force);
	}
	
	// 缓存订单成员证件类型
	public static function cacheCertType($returntype='key', $force=false) {
		return MyHelp::cacheTypeData('certificate_types', 'certificate_type', '', $returntype, $force);
	}
	
	// 缓存订单系统优惠类型
	public static function cacheSysCouponType($returntype='key', $force=false) {
		return MyHelp::cacheTypeData('sys_coupon_types', 'coupon_type', '', $returntype, $force);
	}
	
	// 订单操作检测
	public static function checkOrderOperate($opType, $orderId) {
		$types = array('change_team','change_count','exit_team');		
		if (array_search($opType, $types) === false) {
			return error(0, '订单操作不在检查范围内');
		}
		
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$order = $orderObj->getOne(appendLogicExp('id', '=', $orderId));
		if (empty($order)) {
			return error(-1, '根据条件未能查到指定订单信息,检测订单操作失败');
		}
		
		$stateObj = ModelBase::getInstance('order_state');
		$state = $stateObj->getOne(appendLogicExp('id', '=', $order['zhuangtai']));
		if (empty($order)) {
			return error(-1, '当前订单状态无效，检测订单操作失败');
		}
		
		$allowOperateStates = array('unreview', 'review', 'pay_advance', 'pay_part', 'pay_complate', 'pay_complate1', 'refund_wait', 'error_refund');
		$allowReviewStates = array('pay_advance', 'pay_part', 'pay_complate', 'pay_complate1', 'refund_wait', 'error_refund');
		
		$result['operate'] = true;
		if (array_search($state['type_key'], $allowOperateStates) === false) {
			$result['operate'] = error(-1, '当前订单状态下不允许次操作，订单操作检测失败');
		}
		$result['review'] = true;
		if (array_search($state['type_key'], $allowReviewStates) === false) {
			$result['review'] = error(0, '修改订单此订单信息在当前订单状态下不需要提交财务审核，检测通过');
		}
		
		return $result;
	}
	
	// 订单状态设置检测
	/**
	* 
	* @param undefined $orderId
	* @param undefined $stateId
	* @param undefined $checkMethod 检查模式"system"=系统操作状态改变正确性检测，"user"=用户操作状态改变正确性检测
	* @param undefined $thisState 当前订单状态的全数据
	* @param undefined $stateKeys
	* 
	* @return
	*/
	public static function checkSetOrderState($orderId, $stateId, $checkMethod='system', &$out) {		
		if (empty($orderId)) {
			return error(-1, '错误的订单编号，检查订单状态失败');	
		}
		
		// 缓存订单状态
		$stateIdMap = BackOrderHelp::cacheOrderState('id');
		$out['state_id_map'] = $stateIdMap;
		if (empty($stateIdMap)) {
			return error(-1, '错误的订单状态键');
		}
		
		$order = BackOrderHelp::getOrderInfo($orderId);
		if (empty($order)) {
			return error(-1, '根据条件未能查到指定订单信息,检查订单状态失败');
		}
		
		$nowStateId = $order['zhuangtai'];
		$newStateId = $stateId;
		
		$newStateKey = $stateIdMap[$newStateId]['type_key'];
		$nowStateKey = $stateIdMap[$nowStateId]['type_key'];		
		if (empty($newStateKey)) {
			return error(-1, '错误的订单状态编号，检测订单状态失败');
		}
		
		$nowStateDesc = empty($stateIdMap[$nowStateId]) ? '' : $stateIdMap[$nowStateId]['type_desc'];
		$newStateDesc = empty($stateIdMap[$newStateId]) ? '' : $stateIdMap[$newStateId]['type_desc'];
		
		$perv_states['unreview'] = array();
		$perv_states['review'] = array('unreview','unjoin', 'cancel_scheduling', 'pay_advance','pay_part','pay_complate','pay_complate1','refund_wait','error_refund','info_changing','paying','refunding');
		$perv_states['pay_complate1'] = array('review','pay_part','pay_advance','refund_wait','info_changing','error_refund','refunding','paying');
		$perv_states['invalid'] = array('unreview','review','unjoin');
		$perv_states['canceled'] = array('unreview','review','unjoin');
		$perv_states['unjoin'] = array('unreview','review');
		$perv_states['cancel_scheduling'] = array('unreview','review');
		$perv_states['paying'] = array('review','pay_advance','pay_part','pay_complate','pay_complate1','info_changing','error_refund','refund_wait');
		$perv_states['pay_advance'] = array('review','pay_part','pay_complate','pay_complate1','refund_wait','info_changing','error_refund','refunding','paying');
		$perv_states['pay_complate'] = array('review','pay_part','pay_advance','refund_wait','info_changing','error_refund','refunding','paying');
		$perv_states['refunding'] = array('review','pay_advance','pay_part','pay_complate','pay_complate1','refund_wait','info_changing','error_refund');
		$perv_states['pay_part'] = array('review','pay_advance','pay_complate','pay_complate1','refunding','paying','info_changing','refund_wait','error_refund');
		$perv_states['info_changing'] = array('review','pay_advance','pay_part','pay_complate','pay_complate1','error_refund','refund_wait');
		$perv_states['refund_wait'] = array('review','pay_advance','pay_part','pay_complate','pay_complate1','paying','refunding','info_changing','error_refund');
		$perv_states['exit_team'] = array('pay_advance','pay_part','pay_complate','pay_complate1','refund_wait','paying','refunding','info_changing');
		$perv_states['error_refund'] = array('review','pay_advance','pay_part','pay_complate','pay_complate1','refund_wait','refunding','paying','info_changing');
		$perv_states['complated'] = array('pay_complate','pay_complate1');
		
		$checkMethod = strtolower($checkMethod);
		if ($checkMethod === 'user') {
			$perv_states['review'] = array('unreview','unjoin', 'cancel_scheduling');
			$perv_states['unjoin'] = array('unreview','review');
			$perv_states['cancel_scheduling'] = array('unreview','review');
			$perv_states['canceled'] = array('unreview','review','unjoin');
		}
		
		if (!array_key_exists($newStateKey, $perv_states)) {
			return error(-1, '状态不在检测范围之中，检测失败');
		}
		
		if ($newStateKey === $nowStateKey) {
			return error(1, '订单状态('.$nowStateDesc.'='.$nowStateDesc.')相同，不需要再次设置');
		}
		
		$pervStates = $perv_states[$newStateKey];
		if (array_search($nowStateKey,$pervStates) === false) {
			return error(-1, '当前订单状态('.$nowStateDesc.')非设置订单状态('.$newStateDesc.')的前置状态，错误的操作流程，系统不允许设置此状态');
		}
		
		return error(0,'状态检测通过');
	}
	
	// 检查订单是否可报名(目前可报名的线路，均为新线路)
	public static function checkOrderCreate($ds, $createBefore) {		
		$order = BackOrderHelp::fillNewOrderInfo($ds, array('line'=>true, 'batch'=>true));
		$line = $order['lineid_data'];
		if (empty($line)) {
			return error(-1, '线路信息错误，不能继续报名，详情请咨询客服MM，谢谢支持！');
		}
		
		$checkResult = array(); 
		$result = error(0, '通过约束检查');
		if ($createBefore === false) {
			// 批次可报名情况检查，发生在报名后，目前新版更新只存在新线路
			if ($ds['new_line'] == 1) { // 新线路
				$batch = $order['hdid_data'];
				if (empty($batch)) {
					$result = error(-1, '选择的出行批次有误，不能报名');
				} else {
					// 已过期
					$signup_stop_time = strtotime($batch['stop_time']);
					if ($signup_stop_time - time() < 0) {
						$result = error(-2, '您选择的批次已经过了报名时间，不能继续报名');
					}
					
					$stateKey = $batch['state_data']['type_key'];
					if ($stateKey == 'line_batch_state_overdue' || $stateKey == 'line_batch_state_full' || $stateKey == 'line_batch_state_wait') {
						$result = error(-3, '您选择的批次状态为不可报名状态，具体详情请咨询客服MM，谢谢支持！');
					}
					
					$useState = json_decode($batch['use_state'], true);
					$useStateKey = MyHelp::TypeDataKey2Value($useState['id'],false);
					if ($useStateKey == 'line_batch_use_offline' || $useStateKey == 'line_batch_use_forbid'){
						$result = error(-4, '您选择的批次已被禁用或者还未上架，不能报名，具体详情请咨询客服MM，谢谢支持！');
					}
				}
			} else { // 旧线路
				
			}
		}
				
				
		// 可报名人员类型检查，报名前后都有涉及，仅新线路可能发生
		if ($ds['new_line'] == 1) {
			$adultCount = intval($ds['male']) + intval($ds['woman']);
			$childCount = intval($ds['child']);
			// 人员约束
			if (!empty($line['member_type_data'])) {
				$memberTypeKey = MyHelp::TypeDataKey2Value($line['member_type_data']['id']);
				if (is_error($memberTypeKey) === false) {
					if ($createBefore === true) {	// 报名前检查，用于控制前台报名人数显示
						if ($memberTypeKey == 'line_member_type_child') {
							$checkResult['only_child'] = 1;
						}
						if ($memberTypeKey == 'line_member_type_jcr') {
							$checkResult['only_adult'] = 1;
						}
					} else {	// 报名后检查用于，对数据正确性筛查
						if ($memberTypeKey == 'line_member_type_attach_child') {
							if ($adultCount == 0 || $childCount == 0) {
								$result = error(-1, '本产品线路需成人携带儿童才可报名');
							}
						} else if ($memberTypeKey == 'line_member_type_child') {
							if ($adultCount != 0 || $childCount == 0) {
								$result = error(-1, '本产品线路仅儿童才可报名');
							}
						} else if ($memberTypeKey == 'line_member_type_jcr') {
							if ($adultCount == 0 || $childCount != 0) {
								$result = error(-1, '本产品线路仅成人才可报名');
							}
						}
					}
				} else {
					$result = error(0, '人员类型需求未定义');
				}
			} else {
				$result = error(-1, '线路不存在或已经下架');
			}			
		}
		return $createBefore === true ? $checkResult : $result;
	}
	
	/**
	* 检测订单可支付
	* @param 订单信息 $order
	* @param 其他检测参数 $param
	* 
	* @return
	*/
	public static function checkOrderPay($order, $param=array()) {							
		if ($order['lineid_data_type'] === 'line') {	
			/**
			* 未核算不能支付审查
			*/
			if (empty($order['lineid_data']['check_price'])) {
				return error(-1, '您选择的产品还未核算价格，不能进行支付,请您核对后咨询客服人员');
			}
			
			/**
			* 
			* 非以下状态不允许支付
			* 
			*/
			$stateKey = BackOrderHelp::OrderStateKey2Value($order['zhuangtai']);
			if ($stateKey != 'review' && $stateKey != 'pay_advance' && $stateKey != 'pay_part') {
				return error(-1, '您的订单所在状态不允许支付，请咨询客服人员后再进行支付操作');
			}
			
			/**
			* 锁定订单不能支付
			*/
			if (!empty($order['locked'])) {
				return error(-1, '您的订单已经锁定，不能支付，详情求咨询客服人员');
			}
			
			$user = MyHelp::getLoginAccount(false);
			if (is_error($user) === false) {
				/**
				* 支付检测
				* 1.出团日期前36小时之前的订单不能支付
				* 2.出团日期前36小时之内的订单可以支付且只能付全款，直到出团后12小后不能支付			
				*/
				if (empty($order['hdid_data'])) {
//					$out['batch'] = 'new_find';
					$order = BackOrderHelp::fillNewOrderInfo($order, array('batch'=>true));	
				}			
				$batch = $order['hdid_data'];
				if (!empty($batch)) {
					$orderTime = $order['addtime'];
					$stopBeforePayTime = strtotime('-36 hours', strtotime($order['hdid_start_time']));
//					$out['order'] = date('Y-m-d H:i:s', $orderTime);
//					$out['batch_time'] = $order['hdid_start_time'];
//					$out['stop_before'] = date('Y-m-d H:i:s', $stopBeforePayTime);
//					$out['nuix_order'] = $orderTime;
//					$out['nuix_stop_before'] = $stopBeforePayTime;
					// 36小时之内下单
					if ($orderTime > $stopBeforePayTime) {
						$stopAfterPayTime = strtotime('12 hours', strtotime($order['hdid_start_time']));
						// 再次期间的订单需全款支付
//						$out['stop_after'] = date('Y-m-d H:i:s', $stopAfterPayTime);
//						$out['nuix_stop_after'] = $stopAfterPayTime;
						if (time() < $stopAfterPayTime) {
							if (empty($param['pay_type'])) {
								return error(-1, '您的订单是在出团前36小时内所创建，只能支付全部团款');	
							}
						} else {
							return error(-1, '您的订单是在出团前36小时内所创建，并且您的本次支付是在出团后12小时之后，所以不能支付');	
						}
					} else {
						if (time() > $stopBeforePayTime) {
							return error(-1, '您的订单是在出团前36小时之前所创建，只能在团前36小时之前完成支付');
						}
					}
				}	
			}		
		}
		return error(0, '审查通过');
	}
	
	// 设置订单状态根据Id
	public static function setOrderStateById($orderId, $stateId, $checkMode='system', &$out) {
		$result = BackOrderHelp::checkSetOrderState($orderId, $stateId, $checkMode, $out);
		$out['set_state_id_check_result'] = $result;
		if (error_ok($result) === false) {
			return $result;
		}
		if ($result['errno'] === 1) {
			return error(0, '无需设置订单('.$orderId.')状态', $result);
		}
		
//		$perv_states['unreview'] = '未审核';
//		$perv_states['review'] = '已审核';
//		$perv_states['complated'] = '已完成';
//		$perv_states['invalid'] = '无效';
//		$perv_states['canceled'] = '已取消';
//		$perv_states['unjoin'] = '替补';
//		$perv_states['paying'] = '付款中';
//		$perv_states['pay_advance'] = '已付预付款';
//		$perv_states['pay_complate'] = '已付全款';
//		$perv_states['refunding'] = '退款中';
//		$perv_states['pay_part'] = '已付部分款';
//		$perv_states['info_changing'] = '信息变更申请中';
//		$perv_states['refund_wait'] = '等待退款';
//		$perv_states['exit_team'] = '退团';
//		
//		BackOrderHelp::writeSupervise($orderId, )
		
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$result = $orderObj->modify(array('zhuangtai'=>$stateId), appendLogicExp('id','=',$orderId));
		$out['set_state_id'] = $stateId;
		$out['set_state_result'] = $result;
		if (error_ok($result) === false) {
			return error(-1, '设置订单状态失败', $result);
		} else {		
			// 缓存订单状态
			$stateIdMap = BackOrderHelp::cacheOrderState('id');
			if (!empty($stateIdMap)) {
				// 记录订单状态改变
				BackOrderHelp::writeSupervise($orderId, '订单状态变更为：'.$stateIdMap[$stateId]['type_desc']);
			}
			return error(0, '设置订单状态成功');
		}
	}
	
	
	// 设置订单状态根据状态键
	public static function setOrderStateByKey($orderId, $stateKey, &$out) {
		// 缓存订单状态
		$stateKeyMap = BackOrderHelp::cacheOrderState();
		$out['state_key_map'] = $stateKeyMap;
		$out['set_state_key'] = $stateKey;
		if (empty($stateKeyMap) || empty($stateKeyMap[$stateKey])) {
			return error(-1, '错误的订单状态键');
		}
		return BackOrderHelp::setOrderStateById($orderId, $stateKeyMap[$stateKey]['id'], 'system', $out);
	}
	
/**
* 获取订单支付次数
* @param 订单编号 $orderId
* @param 支付次数类型 $type= {
* 			0=>全部，
* 			1=>线上，
* 			2=>线下，
*		}
* @param 审核通过的线下付款 $reviewPass
* 
* @return $count 次数
*/
	public static function getOrderPayCount($orderId, $type=0, $reviewPass=true) {
		$order = BackOrderHelp::getOrderInfo($orderId);
		if (is_error($order)) {
			return $order;
		}
		
		$count = 0;
		// 线上
		if ($type == 0 || $type == 1) {		
			$order_sn = BackOrderHelp::getRealOrderSN($order['order_sn']);			
			$payLog1Obj = ModelBase::getInstance('pay_log', 'xz_');
			$payLog1Count = $payLog1Obj->getCount(appendLogicExp('order_sn', 'LIKE', $order_sn.'%'));
			$count += $payLog1Count;
			$payLog2Obj = ModelBase::getInstance('pay_log2', 'xz_');
			$payLog2Count = $payLog2Obj->getCount(appendLogicExp('order_sn', 'LIKE', $order_sn.'%'));
			$count += $payLog2Count;
		}
		
		// 线下
		if ($type == 0 || $type == 2) {
			// 线下付款记录
			$orderReviewObj = ModelBase::getInstance('order_review');
			$orderReviews = $orderReviewObj->getAll(appendLogicExp('order_id', '=', $order['id']));
			if (!empty($orderReviews)) {
				// 已审核
				if ($reviewPass === true) {
					$reviewType = BackReviewHelp::reviewTypeKey2Value('review_pass', true);	
					foreach ($orderReviews as $k3=>$v3) {
						if ($v3['review_type_id'] === $reviewType['id']) {
							$count ++;
						}
					}
				} else {
					$count += count($orderReviews);
				}
			}
		}
		return $count;
	}
	
	// 生成订单编号
	public static function createOrderSN($title, $fromId) {
		$dt = date('YmdHis', time());
		$subDT = substr($dt, 2);
		return $title.'-'.$subDT.getMillisecond().'0'.$fromId;
	}
		
	// 获取真实订单编号
	public static function getRealOrderSN($order_sn, &$header='', &$from=1, &$payCount=0) {		
		$orderList = explode('-', $order_sn);
		if ($orderList >= 2) {
			$header = $orderList[0];
			$from = substr($orderList[1], 18);
			if ($orderList >= 3) {
				$payCount = $orderList[2];
			}
			return $orderList[0].'-'.$orderList[1];
		}
		return $order_sn;
	}
	
	
	// 获取订单参团人类型人数
	public static function getOrderMemberTypeCount($orderId, $includeExit=false) {
		if ($includeExit === false) {
			$conds = appendLogicExp('exit', '=', 0);	
		} else {
			$conds = appendLogicExp('exit', '!=', 0);
		}
		
		$typeCount = array('male'=>0, 'woman'=>0, 'child'=>0, 'unknow'=>0);
		$members = BackOrderHelp::getOrderMembers($orderId, $conds);
		foreach($members as $mk=>$mv) {
			if (stripos($mv['type_id_data']['type_key'], 'woman') !== false) {
				$typeCount['woman'] = intval($typeCount['woman']) + 1;
			} else if (stripos($mv['type_id_data']['type_key'], 'man') !== false) {
				$typeCount['male'] = intval($typeCount['male']) + 1;
			} else if (stripos($mv['type_id_data']['type_key'], 'child') !== false) {
				$typeCount['child'] = intval($typeCount['child']) + 1;
			} else {
				$typeCount['unknow'] = intval($typeCount['unknow']) + 1;
			}
		}
		return $typeCount;
	}
	
	// 获取订单参团人数
	public static function getOrderMemberCount($orderId, $real=false, $includeExit=false) {
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$order = $orderObj->getOne(appendLogicExp('id', '=', $orderId));
		if (empty($order)) {
			return error(-1, '根据订单编号未能查到指定订单信息,获取订单参团人数失败');
		}
		
		return BackOrderHelp::getOrderMemberCountFromData($order, $real, $includeExit);
	}
	
	// 获取订单参团人数
	public static function getOrderMemberCountFromData($order, $real=false, $includeExit=false) {
		if (!array_key_exists('male', $order) || !array_key_exists('woman', $order) || !array_key_exists('child', $order) || !array_key_exists('ct_names', $order) || !array_key_exists('ct_exits', $order)) {
			return error(-1, '订单信息参数不全,获取订单参团人数失败');
		}
		
		if ($real === false) {
			return intval($order['male']) + intval($order['woman']) + intval($order['child']);
		} else {
			$count = 0;
			
			if ($order['new_order'] == 1) {
				$memberObj = ModelBase::getInstance('signup_member');
				$conds = appendLogicExp('order_id', '=', $order['id']);
				if ($includeExit === false) {
					$conds = appendLogicExp('exit', '=', 0, 'AND', $conds);
				}
				$count = $memberObj->getCount($conds);
			} else {
				$names = explode('&nbsp;', $order['ct_names']);
				$exits = explode('&nbsp;', $order['ct_exits']);			
				for($i = 0; $i < count($names); $i++){
					if (!empty($names[$i])) {
						if ($includeExit !== false) {
				 			$count ++;
						} else {
							if (intval($exits[$i]) !== 1) {
								$count ++;
							}
						}				
					}
				}
			}
			return $count;
		}
	}
	
	// 获取订单总金额
	public static function getOrderSumMoney($orderId, &$output) {		
		$cash = BackOrderHelp::getOrderSumTeamMoney($orderId);
		$output['team_cash'] = $cash;
		if (is_error($cash)) {
			return $cash;
		}
		
		$cash = bcadd($cash, BackOrderHelp::getExtraMoney($orderId), 2);
		return $cash;
	}
	
	// 获取额外费用
	public static function getExtraMoney($orderId) {
		$cash = 0.0;		
		// 额外费用
		$extraCashObj = ModelBase::getInstance('order_extra_cash');
		$extraConds = appendLogicExp('order_id', '=', $orderId, 'AND', $extraConds);
		$extraConds = appendLogicExp('invalid', '!=', 1, 'AND', $extraConds);
		$extraCashs = $extraCashObj->getAll($extraConds);
		if (!empty($extraCashs)) {
			foreach ($extraCashs as $eck=>$ecv) {
				$cash = bcadd($cash, floatval($ecv['cash']), 2);
				$output['extra'.$eck] = $ecv;
			}
		}
		
		// 优惠券类型
		$couponMap = array();
		
		// 优惠券
		$orderCouponObj = ModelBase::getInstance('order_coupon');
		$couponConds = appendLogicExp('order_id', '=', $orderId, 'AND', $couponConds);
		$couponConds = appendLogicExp('invalid', '!=', 1, 'AND', $couponConds);
		$orderCoupon = $orderCouponObj->getAll($couponConds);
		$output['coupon'] = $orderCoupon;
		if (!empty($orderCoupon)) {
			foreach ($orderCoupon as $ock=>$ocv) {
				// 查询优惠券类型，有该类型将不再查询
				if (!array_key_exists($ocv['coupon_type_id'], $couponMap)) {
					$couponTypeKey = MyHelp::IdEachTypeKey('coupon_type', intval($ocv['coupon_type_id']));
					if (is_error($couponType) === true) {
						continue;
					}
					$couponMap[$ocv['coupon_type_id']] = $couponTypeKey;
				}
				
				// 查看是否为【团期优惠券】,不计入总价格
				$teamKeyWords = '_TEAM';
				$couponTypeKey = $couponMap[$ocv['coupon_type_id']];	
				$subKeyWords = substr($couponTypeKey, -strlen($teamKeyWords));
				if ($subKeyWords === $teamKeyWords) {
					continue;
				}				
				
				$cash = bcsub($cash, floatval($ocv['cash']), 2);
				$output['coupon'.$ock] = $ocv;
			}
		}
		$output['coupon_type'] = $couponMap;		
		return $cash;
	}
	
	// 获取订单总团费
	public static function getOrderSumTeamMoney($orderId) {
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$order = $orderObj->getOne(appendLogicExp('id', '=', $orderId));
		if (empty($order)) {
			return error(-1, '根据订单编号未能查到指定订单信息,获取团费总金额失败');
		}
		
		if ($order['new_line'] == '1') {
			return $order['team_cut_price'];
		}
		
		$adult_price = 0;
		$child_price = 0;
								
		$order_sn = BackOrderHelp::getRealOrderSN($order['order_sn'], $order_sn_prefix);		
		//小包团订单价格特殊处理
		if ($order_sn_prefix === 'YD') {
			$teamObj = ModelBase::getInstance('team_group');
			$team = $teamObj->getOne(appendLogicExp('id', '=', $order['lineid']));
			if (empty($team)) {
				return error(-1, '根据线路编号未能查到指定批次信息,获取团费总金额失败');
			}			
			$adult_price = floatval($team['price_adult']);
			$child_price = floatval($team['price_child']);
			
		} else if ($order_sn_prefix == 'QD') {
			return $order['team_cut_price'];
		} else {		
			// 获取线路批次
			$activityObj = ModelBase::getInstance('lineactivity', 'xz_');
			$activity = $activityObj->getOne(appendLogicExp('id', '=', $order['hdid']));
			if (empty($activityObj)) {
				return error(-1, '根据线路编号未能查到指定批次信息,获取团费总金额失败');
			}
			$adult_price = floatval($activity['priceadult']);
			$child_price = floatval($activity['pricechild']);
		}
		
		$adultCount = intval($order['male']) + intval($order['woman']);
		$cash = bcmul($adult_price, $adultCount, 2);
		$cash = bcadd($cash, bcmul($child_price, intval($order['child']), 2), 2);
		
		return $cash;
	}
	
	// 获取所有支付记录
	public static function getOrderPays($orderId) {
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$order = $orderObj->getOne(appendLogicExp('id', '=', $orderId));
		if (empty($order)) {
			return error(-1, '根据订单编号未能查到指定订单信息,获取已支付订单总金额失败');
		}				
		$order_sn = BackOrderHelp::getRealOrderSN($order['order_sn']);
		
		$payCash = 0;
		// 线上付款记录1
		$pay1Obj = ModelBase::getInstance('pay_log', 'xz_');
		$pay1 = $pay1Obj->getAll(appendLogicExp('order_sn', 'LIKE', '%'.$order_sn.'%'));
		$data['online'] = $pay1;
		
		// 线上付款记录2
		$pay2Obj = ModelBase::getInstance('pay_log2', 'xz_');
		$pay2 = $pay2Obj->getAll(appendLogicExp('order_sn', 'LIKE', '%'.$order_sn.'%'));
		if (!empty($pay2)) {
			if (empty($pay1)) {
				$data['online'] = $pay2;
			} else {
				$data['online'] = array_merge($pay1, $pay2);
			}	
		}
		
		// 线下付款记录
		$orderReviewObj = ModelBase::getInstance('order_review');
		$orderReviews = $orderReviewObj->getAll(appendLogicExp('order_id', '=', $order['id']));
		$data['offline'] = $orderReviews;
		return $data;
	}
	
	// 获取已支付总金额
	public static function getOrderPaySumMoney($orderId, &$count=0, $includeUserCoupon = true) {
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$order = $orderObj->getOne(appendLogicExp('id', '=', $orderId));
		if (empty($order)) {
			return error(-1, '根据订单编号未能查到指定订单信息,获取已支付订单总金额失败');
		}		
		$order_sn = BackOrderHelp::getRealOrderSN($order['order_sn']);
		
		$payCash = 0;
		// 线上付款记录1
		$pay1Obj = ModelBase::getInstance('pay_log', 'xz_');
		$pay1 = $pay1Obj->getAll(appendLogicExp('order_sn', 'LIKE', '%'.$order_sn.'%'));
		if (!empty($pay1)) {
			foreach ($pay1 as $k1=>$v1) {
				$payCash = bcadd($payCash, floatval($v1['TransAmount']), 2);
				$count++;
			}
		}
		
		// 线上付款记录2
		$pay2Obj = ModelBase::getInstance('pay_log2', 'xz_');
		$pay2 = $pay2Obj->getAll(appendLogicExp('order_sn', 'LIKE', '%'.$order_sn.'%'));
		if (!empty($pay2)) {
			foreach ($pay2 as $k2=>$v2) {
				$payCash = bcadd($payCash, floatval($v2['TransAmount']), 2);
				$count++;
			}
		}
		
		// 使用的优惠券
		if ($includeUserCoupon === true) {
			$conds = appendLogicExp('user_id', '=', $order['userid']);
			$conds = appendLogicExp('order_id', '=', $orderId);
			$conds = appendLogicExp('use', '=', 1, 'AND', $conds);
			$userCoupons = BackAccountHelp::getUserCoupon($conds);
			foreach($userCoupons as $uk=>$uv) {
				$payCash = bcadd($payCash, floatval($uv['money']), 2);
			}
		}
		
		// 费用功能
		$cashFuncObj = ModelBase::getInstance('cash_function');
		$cashFuncs = $cashFuncObj->getAll();
		if (!empty($cashFuncs)) {
			foreach ($cashFuncs as $cfk=>$cfv) {
				$funcIds[$cfv['type_key']] = $cfv['id'];
			}	
		}
		
		// 已审核
		$reviewType = BackReviewHelp::reviewTypeKey2Value('review_pass', true);
				
		// 线下付款记录
		$orderReviewObj = ModelBase::getInstance('order_review');
		$orderReviews = $orderReviewObj->getAll(appendLogicExp('order_id', '=', $order['id']));
		if (!empty($orderReviews)) {
			$payId = empty($funcIds['pay'])?'':$funcIds['pay'];
			$refundId = empty($funcIds['refund'])?'':$funcIds['refund'];
			foreach ($orderReviews as $k3=>$v3) {
				if ($v3['review_type_id'] === $reviewType['id']) {
					if ($v3['cash_func_id'] === $payId) {
						$payCash = bcadd($payCash, floatval($v3['cash']), 2);
						$count++;
					} else if ($v3['cash_func_id'] == $refundId) {
						$payCash = bcsub($payCash, floatval($v3['cash']), 2);
						$count++;
					}
				}
			}
		}
		return $payCash;		
	}
	
	// 获取已支付总团费
	public static function getOrderPaySumTeamMoney($orderId, &$output=array()) {
		$output['order_id'] = $orderId;
		
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$order = $orderObj->getOne(appendLogicExp('id', '=', $orderId));
		if (empty($order)) {
			return error(-1, '根据订单编号未能查到指定订单信息,获取已支付团费总金额失败');
		}
		$order_sn = BackOrderHelp::getRealOrderSN($order['order_sn']);
		
		$payCash = 0;
		// 线上付款记录1
		$pay1Obj = ModelBase::getInstance('pay_log', 'xz_');
		$pay1 = $pay1Obj->getAll(appendLogicExp('order_sn', 'LIKE', '%'.$order_sn.'%'));
		if (!empty($pay1)) {
			foreach ($pay1 as $k1=>$v1) {
				$payCash = bcadd($payCash, floatval($v1['TransAmount']), 2);
			}
		}
		// 线上付款记录2
		$pay2Obj = ModelBase::getInstance('pay_log2', 'xz_');
		$pay2 = $pay2Obj->getAll(appendLogicExp('order_sn', 'LIKE', '%'.$order_sn.'%'));
		if (!empty($pay2)) {
			foreach ($pay2 as $k2=>$v2) {
				$payCash = bcadd($payCash, floatval($v2['TransAmount']), 2);
			}
		}
		
		
		// 线下付款记录
		$cash_use_id = BackReviewHelp::cashUseKey2Value('team');
		$output['use'] = $cash_use_id;
		if (is_error($cash_use_id) === false) {		
			$review_pass_id = BackReviewHelp::reviewTypeKey2Value('review_pass');
			$output['review'] = $review_pass_id;
			if (is_error($review_pass_id) === false) {
				
				$orderReviewObj = ModelBase::getInstance('order_review');
				$conds = appendLogicExp('order_id', '=', $orderId, 'AND');
				$conds = appendLogicExp('cash_use_id', '=', $cash_use_id, 'AND', $conds);
				$conds = appendLogicExp('review_type_id', '=', $review_pass_id, 'AND', $conds);
				
				$orderReviews = $orderReviewObj->getAll($conds);
				if (!empty($orderReviews)) {
					
					$payId = BackReviewHelp::cashFuncKey2Value('pay');
					$refundId = BackReviewHelp::cashFuncKey2Value('refund');
					$output['pay'] = $payId;
					$output['refund'] = $refundId;
					if (is_error($payId) === false && is_error($refundId) === false) {
						
						foreach ($orderReviews as $k3=>$v3) {
							if ($v3['cash_func_id'] === $payId) {
								$payCash = bcadd($payCash, floatval($v3['cash']), 2);
							} else if ($v3['cash_func_id'] == $refundId) {
								$payCash = bcsub($payCash, floatval($v3['cash']), 2);
							}
						}
					}					
				}
			}			
		}
		return $payCash;			
	}
	
	// 设置订单状态系统定义
	public static function setOrderStateBySystem($orderId, $defaultStateKey='', &$output = array()) {		
		$output['order_id'] = $orderId;
		$output['default'] = $defaultStateKey;
		
		// 获取待审核类型编号
		$reviewingId = BackReviewHelp::reviewTypeKey2Value('reviewing');
		if (is_error($reviewingId)) {
			return error(-1, '1.设置状态错误', $reviewingId);
		}
		
		// 查找剩余未审核的
		$reviewingCDS = appendLogicExp('order_id', '=', $orderId, 'AND');
		$reviewingCDS = appendLogicExp('review_type_id', '=', $reviewingId, 'AND', $reviewingCDS);
		$orderReviewObj = ModelBase::getInstance('order_review');
		$orderReviews = $orderReviewObj->getAll($reviewingCDS);
		
		// 判断是否存在未审核的订单
		if (!empty($orderReviews)) {
			// 取第一条请求审核记录，根据费用功能将订单设置为付款中或者退款中
			$cashFuncKey = BackReviewHelp::cashFuncKey2Value($orderReviews[0]['cash_func_id']);
			if (is_error($cashFuncKey)) {
				return error(-2, '2.设置状态错误', $cashFuncKey);
			}
			
			if ($cashFuncKey === 'pay') {
				$state_key = 'paying';
			} else if ($cashFuncKey === 'refund') {
				$state_key = 'refunding';	
			} else {
				return error(-3, '3.设置状态错误,错误的费用功能类型数据');
			}
			$output['state'] = $state_key;
			return BackOrderHelp::setOrderStateByKey($orderId, $state_key, $output);
		}
			
		$output['orderId'] = $orderId;
		
		// 订单可参团人数
		$memberCount = BackOrderHelp::getOrderMemberCount($orderId);
		if (is_error($memberCount)) {
			return $memberCount;
		}
		$output['memberCount'] = $memberCount;
		
		$order = BackOrderHelp::getOrderInfo($orderId);
		if (is_error($order)) {
			return error(-4, '订单编号错误，找不到该订单，状态更改失败');
		}
		$order = BackOrderHelp::fillNewOrderInfo($order, array('line'=>true));
		
		// 订单总金额
		if ($order['new_order'] == 1) {
			$sumMoney = $order['need_pay_money'];
		} else {
			$sumMoney = BackOrderHelp::getOrderSumMoney($orderId);
			if (is_error($sumMoney)) {
				return $sumMoney;
			}
		}
		$output['sumMoney'] = $sumMoney;
		
		// 已付总金额
		$sumPayMoney = BackOrderHelp::getOrderPaySumMoney($orderId, $payCount);
		if (is_error($sumPayMoney)) {
			return $sumPayMoney;
		}
		$output['sumPayMoney'] = $sumPayMoney;
		
		// 免费活动特殊处理
		if ($order['lineid_data_type'] == 'line' && $order['lineid_data']['free_line'] == 1) {			
			// 判断已付全款
			if (bccomp($sumMoney, $sumPayMoney, 2) === 0) {
				$output['state'] = 'pay_complate';
				return BackOrderHelp::setOrderStateByKey($orderId, 'pay_complate', $output);
			}	
		}
		
		// 团费总金额
		if ($order['new_order'] == 1) {
			$teamSumMoney = $order['team_cut_price'];
		} else {
			$teamSumMoney = BackOrderHelp::getOrderSumTeamMoney($orderId);
			if (is_error($teamSumMoney)) {
				return $teamSumMoney;
			}
		}
		$output['teamSumMoney'] = $teamSumMoney;
		
		// 已付团费
		$teamPaySumMoney = BackOrderHelp::getOrderPaySumTeamMoney($orderId, $outputTeamPay);
		if (is_error($teamPaySumMoney)) {
			return $teamPaySumMoney;
		}
		$output['teamPaySumMoney'] = $teamPaySumMoney;
		$output['teamSumOutput'] = $outputTeamPay;
		
		// 款项小于0，错误状态
		if ($sumPayMoney < 0 || $teamPaySumMoney < 0 || $sumMoney < 0 || $teamSumMoney < 0) {			
			return BackOrderHelp::setOrderStateByKey($orderId, 'error_refund', $output);
		}
		
		// 订单可参团人数0
		if ($memberCount === 0) {	
						
			// 支付金额小于总金额，已付部分款	
			if (bccomp($sumMoney, $sumPayMoney, 2) > 0) {
				$output['state'] = 'pay_part1';
				return BackOrderHelp::setOrderStateByKey($orderId, 'pay_part', $output);
				
			// 支付金额大于总金额，等待退款			
			} else if (bccomp($sumMoney, $sumPayMoney, 2) < 0) {
				$output['state'] = 'refund_wait1';
				return BackOrderHelp::setOrderStateByKey($orderId, 'refund_wait', $output);
				
			// 支付金额等于总金额
			} else {				
				
				// 存在付款记录，人数为0，总金额和已付金额持平，标记为已退团
				if ($payCount > 0) {
					$output['state'] = 'exit_team';
					return BackOrderHelp::setOrderStateByKey($orderId, 'exit_team', $output);	
					
				// 不存在付款记录，人数为0，总金额和已付金额持平，标记为已审核
				} else {
					$output['state'] = 'review';
					return BackOrderHelp::setOrderStateByKey($orderId, 'review', $output);
				}
			}
		}
				
		
		// 存在付款状态判断
		if ($sumPayMoney > 0) {
			
			// 预付款截至金额
			$teamMoney = $teamSumMoney * 0.5;
			$output['advanceMoney'] = $teamMoney;
			
			//判断团费预付款
			if (abs($teamMoney - $teamPaySumMoney) == 0) {
				$output['state'] = 'pay_advance';
				return BackOrderHelp::setOrderStateByKey($orderId, 'pay_advance', $output);
			}			
			
			// 判断已付全款
			if (bccomp($sumMoney, $sumPayMoney, 2) === 0) {
				$output['state'] = 'pay_complate';
				return BackOrderHelp::setOrderStateByKey($orderId, 'pay_complate', $output);
			
			// 判断已付部分款
			} else if (bccomp($sumMoney, $sumPayMoney, 2) > 0) {	
				$output['state'] = 'pay_part2';
				return BackOrderHelp::setOrderStateByKey($orderId, 'pay_part', $output);	
				
			// 判断等待付款
			} else if (bccomp($sumMoney, $sumPayMoney, 2) < 0) {	// 等待退款
				$output['state'] = 'refund_wait2';
				return BackOrderHelp::setOrderStateByKey($orderId, 'refund_wait', $output);
			}
			
		} else{
						
			// 判断已审核
			if (empty($defaultStateKey)) {
				$output['state'] = 'review';
				return BackOrderHelp::setOrderStateByKey($orderId, 'review', $output);
							
			// 默认状态
			} else {
				$output['state'] = $defaultStateKey;
				return BackOrderHelp::setOrderStateByKey($orderId, $defaultStateKey, $output);
			}			
		}
				
		// 系统不能设置的状态
		return error(0, '没有可供设置的信息状态，订单状态保持原样');
	}
	
	// 获取当前订单
	public static function getOrderInfo($orderId) {
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$order = $orderObj->getOne(appendLogicExp('id', '=', $orderId));
		if (empty($order)) {
			return error(-1, '根据订单编号未能查到指定订单信息,获取订单失败');
		}
		
		return $order;
	}
	
	// 过滤条件值
	public static function filterInvalidCDS($cds) {
		if (is_array($cds)) {
			foreach($cds as $k=>$v) {
				if ($v === '' || $v === -1 || $v === '-1') {
					unset($cds[$k]);
				}
			}
		}
		return $cds;
	}
	
	// 获取查找订单的条件	
	public static function getFindListCDS($cds) {     
		if (empty($cds['type'])){
			return error(-1, '条件类型为空');
		}
		$findType = $cds['type'];
		$cd['cddata'] = $cds;
		$cdData = $cds[$findType];
		$cdList = array();
		if ($findType === 'order') {
			foreach ($cdData as $k=>$v) {
				switch($v['name']){
					case 'id': $cdList['order_sn_like'] = $v['value']; break; //模糊查找，自定义条件
					case 'from': $cdList['from_id'] = $v['value']; break;
					case 'state': $cdList['zhuangtai'] = $v['value']; break;
					case 'cash_func': $cdList['cash_func_id'] = $v['value']; break;
					case 'userid': $cdList['userid'] = $v['value']; break;
					case 'username': $cdList['uname'] = $v['value']; break;
					case 'contact': $cdList['names'] = $v['value']; break;
					case 'phone': $cdList['mob'] = $v['value']; break;
					case 'sdate': $cdList['sdate'] = $v['value']; break;
					case 'edate': $cdList['edate'] = $v['value']; break;
					default: break;
				}
			}
		} else if ($findType === 'line') {
			foreach ($cdData as $k=>$v) {
				switch($v['name']){
					case 'lid': $cdList['lineid'] = $v['value']; break;
					case 'aid': $cdList['hdid'] = $v['value']; break;
					case 'state': $cdList['zhuangtai'] = $v['value']; break;
					case 'from': $cdList['from_id'] = $v['value']; break;
					default: break;
				}
			}
		} else if ($findType === 'member') {
			foreach ($cdData as $k=>$v) {
				switch($v['name']){
					case 'name': $cdList['name'] = $v['value']; break;
					case 'phone': $cdList['tel'] = $v['value']; break;
					case 'certificate': $cdList['certificate_num'] = $v['value']; break;
					default: break;
				}
			}
		}
		$cdList = BackOrderHelp::filterInvalidCDS($cdList);
		$cd['find'] = $findType;
		$cd['list'] = $cdList;
		$cd['robot'] = $cds['robot'];
		return $cd;
	}
	
	// 获取订单列表
	public static function getOrderList($cds, $istart, $pageCount, &$total, $sortCol, $sortDesc, &$outputCDS) {
		$cd = array();
		if (!empty($cds)) {
			$cds = BackOrderHelp::getFindListCDS($cds);
			$outputCDS['cddata'] = $cds;
			$cd = $cds['list'];	
		}
		
		$lineObj = ModelBase::getInstance('lineenertname', 'xz_');
		$lineCols = $lineObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$lineCols = coll_elements_giveup($lineCols, $cd);
		$conds = MyHelp::getLogicExp($lineCols, '=', 'AND');
		
		if($cds['find'] === 'order'){
			if (!empty($cd['sdate']) && !empty($cd['edate'])){
				$usd = strtotime($cd['sdate']);
				$ued = strtotime($cd['edate']);			
				$sdate = $usd > $ued ? $ued : $usd;
				$edate = $usd > $ued ? $usd : $ued;
				$edate = strtotime('+23 hours 59 minutes 59 seconds', $edate);
				$conds = appendLogicExp('addtime', '>=', $sdate, 'AND', $conds);
				$conds = appendLogicExp('addtime', '<=', $edate, 'AND', $conds);
			}
			
			if (array_key_exists('order_sn_like', $cd)) {				
				$conds = appendLogicExp('order_sn', 'LIKE', '%'.$cd['order_sn_like'].'%', 'AND', $conds);
			}
						
			if (array_key_exists('uname', $cd)) {
				$memberObj = ModelBase::getInstance('member', 'xz_');
				$members = $memberObj->getAll('useid', 'like', '%'.$cd['uname'].'%');
				if (!empty($members)) {
					foreach ($members as $k=>$v) {
						$conds = appendLogicExp('userid', '=', $v['mid'], 'AND', $conds);
					}
				}
			}
			
			if (array_key_exists('cash_func_id', $cd)) {
				$orderReviewObj = ModelBase::getInstance('order_review');
				$orderReviews = $orderReviewObj->getAll(appendLogicExp('cash_func_id'));
				if (!empty($orderReviews)) {
					foreach ($orderReviews as $k=>$v) {
						$conds = appendLogicExp('id', '=', $v['order_id'], 'AND', $conds);
					}
				}			
			}
		} else if($cds['find'] === 'line') {
			
		} else if($cds['find'] === 'member') {
			$memberObj = ModelBase::getInstance('sign_member');
			$memberCols = $memberObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$mcols = coll_elements_giveup($cd, $memberCols);
			if (!empty($mcols)) {				
				$mcds = MyHelp::getLogicExp($mcols, '=', 'AND');
				$members = $memberObj->getAll($mcds);
				if (!empty($members)) {
					foreach ($members as $k=>$v) {
						$conds = appendLogicExp('id', '=', $v['order_id'], 'AND', $conds);
					}
				}
			}
			
			if (array_key_exists('name', $cd)) {
				$conds = appendLogicExp('ct_names', 'LIKE', '%'.$cd['name'].'%', 'AND', $conds);
			}
			
			if (array_key_exists('certificate_num', $cd)) {
				$conds = appendLogicExp('ct_zhengjian', 'LIKE', '%'.$cd['certificate_num'].'%', 'AND', $conds);
			}
		}
		$conds = appendLogicExp('order_sn', '!=', '', 'AND', $conds);
		
		// 是否显示人气
		if ($cds['robot'] === 'filter') {
			$conds = appendLogicExp('names', 'NOT LIKE', '%人气%', 'AND', $conds);
		}
		
		$outputCDS['cds'] = $conds;
		if ($sortCol == 'id') {
			$sortDesc = true;
		}
		
		$outputCDS['pCount'] = $pageCount;
		$outputCDS['start'] = $istart;
		return $lineObj->getAll($conds, $istart, $pageCount, $total, $sortCol, $sortDesc);
	}
	
	// 获取订单列表
	public static function getNewOrderList($conds, $pageIndex, $pageCount, &$total, $sort, &$out) {
		$lineObj = ModelBase::getInstance('lineenertname', 'xz_');
		$lines = $lineObj->getAll($conds, $pageIndex, $pageCount, $total, $sort, true, $out);
		return $lines;
	}
	
	// 填充订单信息
	public static function fillOrderInfo($ds) {		
		// 获取所有订单状态
		$orderStateObj = ModelBase::getInstance('order_state');
		$orderStates = $orderStateObj->getAll();
		if (!empty($orderStates)) {
			foreach ($orderStates as $k => $v) {
				$states[$v['id']] = array('key'=>$v['type_key'], 'desc'=>$v['type_desc']);
			}
		}
		
		// 填充数据			
		foreach($ds as $dk=>$dv) {
			// 查找用户
			if (!empty($dv['userid'])) {
				if ($dv['new_order'] == 1) {
					
				} else {
					$userObj = ModelBase::getInstance('member', 'xz_');
					$user = $userObj->getOne(appendLogicExp('mid', '=', $dv['userid']));
					if (!empty($user)) {
						$dv['userid.userid'] = $user['userid'];
					}
				}
			}			
			
			$order_sn = BackOrderHelp::getRealOrderSN($order['order_sn'], $order_sn_prefix);
			// 特殊处理小包团
			if ($order_sn_prefix === 'YD') {
				$teamObj = ModelBase::getInstance('team_group');
				$team = $teamObj->getOne(appendLogicExp('id', '=', $dv['lineid']));
				
				$dv['lineid.title'] = $team['title'] . '<br />' . $team['meet_time'];
				$dv['hdid.show_text'] = $team['meet_time'];
				$dv['hdid.priceadult'] = $team['price_adult'];
				$dv['hdid.pricechild'] = $team['price_child'];
								
			} else {
				if ($dv['new_order'] == 1) {
					$line = BackLineHelp::getLine(appendLogicExp('id', '=', $dv['lineid']), array('batch'=>true));
					$dv['lineid.title'] = $line['title'];
					foreach ($line['batchs'] as $bk=>$bv) {
						if ($bv['id'] == $dv['hdid']) {
							$dv['hdid.show_text'] = $bv['start_date_show'].' - '.$bv['stop_date_show'];
						}
					}
					
				} else {
					// 线路名称
					$archivesObj = ModelBase::getInstance('archives', 'xz_');
					$archives = $archivesObj->getOne(appendLogicExp('id', '=', $dv['lineid']));
					if (!empty($archives)) {
						$dv['lineid.title'] = $archives['title'];	
					}
					
					// 线路批次
					$activityObj = ModelBase::getInstance('lineactivity', 'xz_');
					$activity = $activityObj->getOne(appendLogicExp('id', '=', $dv['hdid']));
					if (!empty($activity)) {
						$dv['hdid.show_text'] = date('Y年m月d日',$activity['startdate']).' - '.date('Y年m月d日',$activity['enddate']);
						$dv['hdid.priceadult'] = $activity['priceadult'];
						$dv['hdid.pricechild'] = $activity['pricechild'];
					}
					$dv['lineid.title'] .= '<br>' . $dv['hdid.show_text'];
				}
								
			}
			
			if ($dv['new_order'] == 1) {
				
			} else {
				$dv['price'] = '成人价:'.$dv['hdid.priceadult'].'<br>儿童价:'.$dv['hdid.pricechild'];
				$sumPrice = ($dv['male'] + $dv['woman']) * $dv['hdid.priceadult'] + $dv['child'] * $dv['hdid.pricechild'];
				$dv['sum_price'] = $sumPrice;				
				$dv['member_count'] = '成人男:'.$dv['male'].'<br>成人女:'.$dv['woman'].'<br>儿童:'.$dv['child'];
				
				$memberCount = BackOrderHelp::getOrderMemberCountFromData($dv, false);
				$memberRealCount = BackOrderHelp::getOrderMemberCountFromData($dv, true);
				$dv['member_complated'] = intval($memberCount) - intval($memberRealCount);
				
			}
			
			// 下单时间
			$dv['addtime.show_text'] = date('Y年m月d日 H:i:s', $dv['addtime']);
						
			// 订单状态
			$dv['zhuangtai.show_btn_account'] = 'hide';
			if (!empty($states)) {
				$sta = $states[$dv['zhuangtai']];
				$dv['zhuangtai.type_desc'] = $sta['desc'];				
				// 不显示操作财务审核
				if ($sta['key'] !== 'unreview' && $sta['key'] !== 'complated' && $sta['key'] !== 'invalid' && $sta['key'] !== 'canceled' && 
					$sta['key'] !== 'paying' && $sta['key'] !== 'refunding' && $sta['key'] !== 'info_changing') {						
					$dv['zhuangtai.show_btn_account'] = 'show';
				}
			}				
					
			$ds[$dk] = $dv;
		}	
		
		return $ds;	
	}
/**
* 
* @param 批次编号 $batchId		
* @param 成人数量 $adultCount
* @param 小孩数量 $childCount
* 
* @return 
*/
	// 计算订单总价仅团费与优惠部分
	public static function calcOrderMoney($batchId, $taocanPriceId, $adultCount, $childCount, &$offerMap){
		$conds = appendLogicExp('id', '=', $batchId);
		$batch = BackLineHelp::getBatch($conds, false);
		if (empty($batch)) {
			return error(-1, '计算错误，批次错误');
		}
		$adultPrice = floatval($batch['price_adult']);
		$childPrice = floatval($batch['price_child']);
		if (!empty($taocanPriceId)) {
			$conds = appendLogicExp('id', '=', $taocanPriceId);
			$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
			$taocan = BackLineHelp::getTaocanPrice($conds, false);
			$adultPrice = floatval($taocan['price_adult']);
			$childPrice = floatval($taocan['price_child']);
		}
		
		$money['full'] = bcadd(bcmul($adultPrice, $adultCount, 2), bcmul($childPrice, $childCount, 2), 2);
		$money['price_adult'] = $adultPrice;
		$money['price_child'] = $childPrice;
				
		// 计算优惠
		$conds = appendLogicExp('line_id', '=', $batch['line_id']);
		$offers = BackLineHelp::getSpecialOfferList($conds, 0,0,$total,array('create_time'));
		
		// 单价优惠
		foreach ($offers as $k=>$v) {
			// 时间条件判断
			$nowTime = time();
			$startTime = strtotime($v['start_time']);
			$endTime = strtotime($v['end_time']);
			if ($nowTime < $startTime || $nowTime > $endTime) {
				unset($offers[$k]);
			}
			
			$offerMoney = 0;
			$type = json_decode($v['type_id'], true);
			$type_key = $type['type_key'];			
			// 硬性条件判断
			$precent = 0.00;
			if (!empty($v['cut_precent'])){
				$precent = bcmul(floatval($v['cut_precent']), 0.01, 2);	
			}
			if ($type['type_key'] == 'line_special_offer_adult') {	// 成人优惠
				if ($adultCount > 0) {
					$offerMoney = bcmul($precent, bcsub($adultPrice, floatval($v['cut_money']), 2), 2);
				}
			} else if ($type['type_key'] == 'line_special_offer_child') { // 小孩优惠
				if ($childCount > 0) {
					$offerMoney = bcmul($precent, bcsub($childPrice, floatval($v['cut_money']), 2), 2);
				}		
			} else {	// 类型错误
				continue;
			}
			
			// 记录价格
			if (!empty($offerMoney)) {
				if (empty($offerMap[$type_key]) || $offerMoney < $offerMap[$type_key]['money']) {
					$offerMap[$type_key]['money'] = $offerMoney;
					$offerMap[$type_key]['data'] = $type;
				}	
			}
		}
		
		// 重新设置单价
		if (!empty($offerMap['line_special_offer_adult']['money'])) {
			$adultPrice = floatval($offerMap['line_special_offer_adult']['money']);
		}
		
		if (!empty($offerMap['line_special_offer_child']['money'])) {
			$childPrice = floatval($offerMap['line_special_offer_child']['money']);
		}
		
		// 总价格
		$totalMoney = bcadd(bcmul($adultPrice, $adultCount, 2), bcmul($childPrice, $childCount), 2);
		
		// 总价优惠
		foreach ($offers as $k=>$v) {
			// 时间条件判断
			$nowTime = time();
			$startTime = strtotime($v['start_time']);
			$endTime = strtotime($v['end_time']);
			if ($nowTime < $startTime || $nowTime > $endTime) {
				continue;
			}
			
			$type = json_decode($v['type_id'], true);
			$type_key = $type['type_key'];	
			$offerMoney = 0;		
			// 硬性条件判断
			$precent = 0.00;
			if (!empty($v['cut_precent'])){
				$precent = bcsub(1.00, bcmul(floatval($v['cut_precent']), 0.01, 2), 2);	
			}
			if ($type['type_key'] == 'line_special_offer_full_cut') { // 满减
				if ($totalMoney >= floatval($v['cond_full'])) {
					$offerMoney = bcmul($precent, bcadd($totalMoney, floatval($v['cut_money']), 2), 2);
				}
			} else if ($type['type_key'] == 'line_special_offer_count') { // 人数优惠
				$totalCount = $adultCount;
				if ($v['cound_count_child'] == 1) {
					$totalCount += $childCount;
				}
				if ($totalCount >= intval($v['cond_count'])) {
					$offerMoney = bcmul($precent, bcadd($totalMoney, floatval($v['cut_money']), 2), 2);
				}
			} else {	// 类型错误
				continue;
			}
			
			// 记录价格
			if (!empty($offerMoney)) {
				if (empty($offerMap[$type_key]) || $offerMoney > $offerMap[$type_key]['money']) {
					$offerMap[$type_key]['money'] = $offerMoney;
					$offerMap[$type_key]['data'] = $type;
				}
			}
		}
		
		// 计算减免
		foreach ($offerMap as $ok=>$ov) {
			$totalMoney = bcsub($totalMoney, floatval($ov['money']), 2);
		}		
		$money['cut'] = $totalMoney;
		
		return $money;
	}	
	
/**
* 获取下单用户对订单使用的优惠券
* @param undefined $orderId
* @param 查询类型 $type={
* 		money:获取所有抵用金额，
* 		recover:恢复优惠券,解除优惠券与订单绑定
* 		use:将绑定的优惠券改为使用状态
* 
* @return
*/
	public static function getOrderUserCoupon($orderId, $type='money') {
		$order = BackOrderHelp::getOrderInfo($orderId);
		if (is_error($order) === true) {
			return error(-1, '获取优惠券错误，订单错误');
		}
		
		$conds = appendLogicExp('user_id', '=', $order['userid']);
//		$conds = appendLogicExp('account_type_id', '=', $order['book_account_type'], 'AND', $conds);
		$conds = appendLogicExp('order_id', '=', $order['id'], 'AND', $conds);
		$userCoupons = BackAccountHelp::getUserCoupon($conds);
		
		if ($type == 'money') {
			$money = 0.00;
			foreach ($userCoupons as $k=>$v) {
				$money += $v['money'];
			}
			return $money;
		} else if ($type == 'recover') {
			if (empty($userCoupons)) {
				return error(0, '没有可供恢复的优惠券');
			}
			$ds['use'] = 0;
			$ds['use_time'] = '';
			$ds['order_id'] = '';		
			foreach ($userCoupons as $k=>$v) {
				if (!empty($ids)) {
					$ids += ',';
				}
				$ids += $v['id'];
			}
			$conds = appendLogicExp('id', 'IN', '('.$ids.')');
			$userCouponObj = ModelBase::getInstance('user_coupon');	
			return $userCouponObj->modify($ds, $conds);
		} else if ($type == 'use') {
			if (empty($userCoupons)) {
				return error(0, '没有可供改为使用的优惠券');
			}
			$ds['use'] = 1;
			$ds['use_time'] = fmtNowDateTime();
			$ds['order_id'] = $orderId;		
			foreach ($userCoupons as $k=>$v) {
				if (!empty($ids)) {
					$ids += ',';
				}
				$ids += $v['id'];
			}
			$conds = appendLogicExp('id', 'IN', '('.$ids.')');
			$userCouponObj = ModelBase::getInstance('user_coupon');	
			return $userCouponObj->modify($ds, $conds);
		} else {
			return $userCoupons;	
		}
	}
	
	public static function checkOrderLock($orderId) {
		$order = BackOrderHelp::getOrderInfo($orderId);
		if (is_error($order) === false) {
			return error($order['locked'], $order['locked'] == 0 ? '订单未加锁' : '订单已锁定，不允许再次修改');	
		} else {
			return $order;
		}
	}

/**
* 计算订单的支付费用,包含总团费、发票价格、额外费用、系统优惠等
* 【需支付费】用不包含用户使用的优惠券，如需计算【还需支付】的价格可以包含在内计算，但不能写入订单的支付价格中
* @param 订单编号 $orderId
* @param 是否写入列中 $write
* 
* @return 需支付费用，或者错误信息
*/
	public static function getOrderNeedPayMoney($orderId, $write=false, $userCoupon=false, $bCompare=false) {
		$order = BackOrderHelp::getOrderInfo($orderId);
		if (is_error($order) === true) {
			return error(-1, '计算错误，订单错误');
		}
		
		$money = array('full'=>0.00, 'cut'=>0.00, 'pay'=>0.00, 'extra'=>0.00, 'coupon'=>0.00, 'need'=>0.00, tip=>'未计算');
		
		// 小包团团费计算
		$orderSN = BackOrderHelp::getRealOrderSN($order['order_sn'], $header);
		
		if ($header == 'QD') {
			$money['full'] = $order['team_cut_price'];
			$money['cut'] = $order['team_cut_price'];
			$money['need'] = $order['team_cut_price'];
			$money['tip'] = '渠道订单不参与团费比价计算';
		} else if ($header == 'YD') {
			$teamObj = ModelBase::getInstance('team_group');
			$team = $teamObj->getOne(appendLogicExp('id', '=', $order['lineid']));
			if (!empty($team)) {
				$adultCount = intval($order['male']) + intval($order['woman']);				
				$adultCash = bcmul(floatval($team['price_adult']), $adultCount, 2);
				$childCash = bcmul(floatval($team['price_child']), intval($order['child']), 2);
				$money['full'] = bcadd($adultCash, $childCash, 2);
				$money['cut'] = $money['full'];
				$money['need'] = $money['full'];
				$money['tip'] = '小包团订单不参与团费比价计算';
			}
		} else {
			// 计算团费与邮费
			if ($order['new_line'] == 1) {
				$adultCount = intval($order['male']) + intval($order['woman']);
				$teamMoney = BackOrderHelp::getNeedPayMoney($order['lineid'], $order['hdid'], $order['tc_price_id'], $adultCount, $order['child'], $order['receipt_type']);
				if (is_error($teamMoney) === true) {
					return $teamMoney;
				}			
				if ($bCompare === false) {
					$money['full'] = $teamMoney['full'];
					$money['cut'] = $teamMoney['cut'];
					$money['need'] = $teamMoney['need'];
					$money['tip'] = '非比价，直接计算价格';
				} else {
					$orderTeam = intval($order['team_cut_price']);
					$subPrice = bcsub($order['team_cut_price'], $teamMoney['cut'], 2);
					if (empty($orderTeam) || $subPrice > 0.01) {
						$money['full'] = $teamMoney['full'];
						$money['cut'] = $teamMoney['cut'];
						$money['need'] = $teamMoney['need'];
						$money['tip'] = '空团费，或者当前团费大于计算的即时团费，团费重写成功';
					} else {
						$money['full'] = $order['team_price'];
						$money['cut'] = $order['team_cut_price'];
						$money['need'] = $order['team_cut_price'];
						$money['tip'] = '当前团费小于或等于计算的即时团费，团费以订单当前金额为准';
					}
				}
			} else {
				$teamMoney = BackOrderHelp::getOrderSumTeamMoney($order[id]);
				if (is_error($teamMoney) === true) {
					return $teamMoney;
				}		
				$money['full'] = $teamMoney;
				$money['cut'] = $money['full'];
				$money['need'] = $money['full'];
				$money['tip'] = '老订单不参与团费比价计算';
			}
		}		
		
		// 计算额外费用与系统减免
		$extraMoney = BackOrderHelp::getExtraMoney($orderId);
		if (is_error($extraMoney) === true) {
			return $extraMoney;
		}
		$money['extra'] = $extraMoney;
		$money['need'] = bcadd(floatval($money['need']), floatval($extraMoney), 2);	
		
		// 订单总费用不包含已支付费用
		if ($write === true) {			
			$ds['team_price'] = $money['full'];
			$ds['team_cut_price'] = $money['cut'];
			$ds['need_pay_money'] = $money['need'];
			$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
			$money['write_result'] = $orderObj->modify($ds, appendLogicExp('id', '=', $order['id']));
		}	
		
		// 计算已支付的费用
		$money['pay'] = BackOrderHelp::getOrderPaySumMoney($orderId);
		
		// 用户优惠券，包含绑定未使用的，和已经使用
		if ($userCoupon === true) {
			$conds = appendLogicExp('user_id', '=', $order['userid']);
			$conds = appendLogicExp('order_id', '=', $order['id'], 'AND', $conds);			
			$userCoupons = BackAccountHelp::getUserCoupon($conds);
			if (is_error($userCoupons) === true) {
				$result = $userCoupons;
			}
			$userCouponMoney = 0.00;
			foreach ($userCoupons as $uk=>$uv) {
				$userCouponMoney = bcadd($userCouponMoney, floatval($uv['money'], 2));
			}
			$money['coupon'] = $userCouponMoney;
			$money['need'] = bcsub(floatval($money['need']), floatval($userCouponMoney), 2);
		}
		
		return $money;
	}
	
/**
* 计算下单需要支付价格,仅限新线路
* @param 线路编号 $lineId
* @param 批次编号 $batchId
* @param 成人数量 $adultCount
* @param 儿童数量 $childCount
* @param 发票邮递费 $receipt, $receipt=0时没有邮递费用
* 
* @return 需支付费用，或者错误信息
*/
	public static function getNeedPayMoney($lineId, $batchId, $taocanPriceId, $adultCount, $childCount, $receipt) {	
		$line = BackLineHelp::getLine(appendLogicExp('id', '=', $lineId), false);
		if (empty($line)) {
			return error(-1, '计算错误，线路错误');
		}
			
		$result = BackOrderHelp::calcOrderMoney($batchId, $taocanPriceId, $adultCount, $childCount, $offer);
		if (is_error($result) === true) {
			return $result;
		}
		
		$result['need'] = $result['cut'];
		
		if (!empty($receipt)) {
			$result['need'] = bcadd(floatval($result['need']), floatval($line['receipt_price']), 2);	
		}
		return $result;
	}
	
	// 获取参团人类型
	public static function getMemberTypes($conds) {
		$memberTypeObj = ModelBase::getInstance('member_type');
		$memberTypes = $memberTypeObj->getAll($conds);
		return $memberTypes;
	}	
 	
	// 获取证件类型
	public static function getMemberCertTypes($conds) {
		$certTypeObj = ModelBase::getInstance('certificate_type');
		$certTypes = $certTypeObj->getAll($conds);
		return $certTypes;
	}	
	
	// 获取订单参团人
	public static function getOrderMember($conds=array()) {
		// 两种保存方式只会存在一种，但由于旧表参团人信息转换后会全部保存到新表，所以需要同时读取新、旧两种表数据
		$memberObj = ModelBase::getInstance('signup_member');
		if (!empty($orderId)) {
			$conds = appendLogicExp('order_id', '=', $orderId, 'AND', $conds);
		}
		$member = $memberObj->getOne($conds);
		if (!empty($member)) {
			$member['type_id_data'] = BackOrderHelp::MemberTypeKey2Value($member['type_id'],true);
			$member['certificate_type_id_data'] = BackOrderHelp::CertTypeKey2Value($uv['certificate_type_id'],true);	
		}
		return $members;
	}
	
	// 获取订单参团人
	public static function getOrderMembers($orderId=0, $conds=array(), $startIndex=0, $pageCount=0, &$total, $sort=array('id'=>'asc')) {
		$members = array();
		// 两种保存方式只会存在一种，但由于旧表参团人信息转换后会全部保存到新表，所以需要同时读取新、旧两种表数据
		$memberObj = ModelBase::getInstance('signup_member');
		if (!empty($orderId)) {
			$conds = appendLogicExp('order_id', '=', $orderId, 'AND', $conds);
		}
		$members = $memberObj->getAll($conds, $startIndex, $pageCount, $total, $sort);
		foreach($members as $uk=>$uv) {
			if (empty($MemberTypeMap[$uv['type_id']])) {
				$memberType = BackOrderHelp::MemberTypeKey2Value($uv['type_id'],true);
				if (is_error($memberType) == false) {
					$MemberTypeMap[$uv['type_id']] = $memberType;
				}
			} else {
				$memberType = $MemberTypeMap[$uv['type_id']];
			}
			$uv['type_id_data'] = $memberType;
			if (empty($CertTypeMap[$uv['certificate_type_id']])) {
				$certType = BackOrderHelp::CertTypeKey2Value($uv['certificate_type_id'],true);
				if (is_error($certType) === false) {
					$CertTypeMap[$uv['certificate_type_id']] = $certType;
				}
			} else {
				$certType = $CertTypeMap[$uv['certificate_type_id']];
			}
			$uv['certificate_type_id_data'] = $certType;
			$members[$uk] = $uv;
		}
		
		// 旧数据
		$order = BackOrderHelp::getOrderInfo($orderId);
		if (!empty($order['ct_names'])) {
			$ids = explode('&nbsp;', $order['ct_ids']);	
			$names = explode('&nbsp;', $order['ct_names']);
			$tels = explode('&nbsp;', $order['ct_sjnum']);
			$certTypes = explode('&nbsp;', $order['ct_zhengjian']);
			$certNums = explode('&nbsp;', $order['ct_zjcode']);
			$types = explode('&nbsp;', $order['ct_types']);
			$exits = explode('&nbsp;', $order['ct_exits']);
			for ($i = 0; $i < count($names); $i ++) {
				$user['id'] = $ids[$i];
				$user['order_id'] = $order['id'];
				$user['name'] = $names[$i];
				$user['type_id'] = $types[$i];
				$user['certificate_type_id'] = $certTypes[$i];
				$user['certificate_num'] = $certNums[$i];
				$user['tel'] = $tels[$i];
				$user['exit'] = $exits[$i];
				$user['count'] = count($names);
				$user['names'] = $names;
				
				$loprs = true;
				foreach($conds as $ck=>$cv) {
					if ($cv['op'] == '=') {
						$rs = $user[$cv['var']] == $cv['val'] ? true : false;
					} else if($cv['op'] == '!=') {
						$rs = $user[$cv['var']] != $cv['val'] ? true : false;
					} else if($cv['op'] == 'LIKE') {
						$cv['val'] = str_replace('%','',$cv['val']);
						$rs = stripos($cv['val'], $user[$cv['var']]) !== false ? true : false;
					} else if($cv['op'] == '>') {
						$rs = $user[$cv['var']] > $cv['val'] ? true : false;
					} else if($cv['op'] == '>=') {
						$rs = $user[$cv['var']] >= $cv['val'] ? true : false;
					} else if($cv['op'] == '<') {
						$rs = $user[$cv['var']] < $cv['val'] ? true : false;
					} else if($cv['op'] == '<=') {
						$rs = $user[$cv['var']] <= $cv['val'] ? true : false;
					} else if($cv['op'] == 'IN') {
						$rs = stripos($user[$cv['var']], $cv['val']) !== false ? true : false;
					} else {
						$rs = false;
					}
					
					if ($cv['lop'] == 'AND') {
						$loprs = ($loprs && $rs);
					} else if($cv['lop'] == 'OR') {
						$loprs = ($loprs || $rs);
					} else {
						$loprs = $rs;
					}
				}
				if ($loprs) {
					// 参团类型
					if (empty($MemberTypeMap[$user['type_id']])) {
						$memberType = BackOrderHelp::MemberTypeKey2Value($user['type_id'],true);
						if (is_error($memberType) == false) {
							$MemberTypeMap[$user['type_id']] = $memberType;
						}
					} else {
						$memberType = $MemberTypeMap[$user['type_id']];
					}
					$user['type_id_data'] = $memberType;
					// 参团人证件类型
					if (empty($CertTypeMap[$user['certificate_type_id']])) {
						$certType = BackOrderHelp::CertTypeKey2Value($user['certificate_type_id'],true);
						if (is_error($certType) === false) {
							$CertTypeMap[$user['certificate_type_id']] = $certType;
						}
					} else {
						$certType = $CertTypeMap[$user['certificate_type_id']];
					}
					$user['certificate_type_id_data'] = $certType;
					
					array_push($members, $user);
				}	
			}
		}
		return $members;
	}
	
/**
* @param 订单信息 $ds
* @param 填充内容 $fill = {
	* 'state'=>订单状态
	* 'from'=>订单来源	
	* 'station'=>所属站点	
	* 'money'=>计算价格
	* 'line'=>线路信息, 
	* 'batch'=>批次信息, 
	* 'taocan'=>所选套餐组合
	* 'account'=>下单人账户信息
	* 'use_coupon'=>订单使用的优惠券信息,
	* 'member'=>参团人信息, 
	* 'extra_cash'=>额外费用信息, 
	* 'order_coupon'=>订单优惠券,
	* 'order_message'=>订单留言,
	* 'pay_online'=>线上支付记录,
	* 'pay_offline'=>线下支付记录,
	* 'supervise'=>订单跟踪记录,
}
* 
* @return order
*/
	public static function fillNewOrderInfo($ds, $fill, &$output) {	
		if (is_array($ds) == false) {
			$ds;
		} 
		
		$dsIsList = true;
		foreach($ds as $testK=>$testV) {
			if (is_numeric($testK) === false) {
				$ds = array($ds);
				$dsIsList = false;
			}
			break;
		}
		
		$fxOrderObj = ModelBase::getInstance('fx_order');		
		foreach ($ds as $dk=>$order) {		
			$order['addtime_show'] = date('Y年m月d日 H时i分s秒', $order['addtime']);
			if (!empty($order['names'])) {
				$order['names_show'] = mb_substr($order['names'], 0, 1, 'utf8').'**';
			}
			if (!empty($order['mob'])) {
				$order['mob_show'] = substr($order['mob'], 0, 3).'****'.substr($order['mob'], 7);
			}
			
			// 状态填充
			if (!empty($fill['state']) || $fill===true) {
				if (empty($OrderStateMap[$order['zhuangtai']])) {
					$state = BackOrderHelp::OrderStateKey2Value($order['zhuangtai'], true);
					if (is_error($state) === false) {
						$OrderStateMap[$order['zhuangtai']] = $state;
						$order['zhuangtai_data'] = $state;
					}
				} else {
					$order['zhuangtai_data'] = $OrderStateMap[$order['zhuangtai']];
				}
			}
			 
			// 来源填充
			if (!empty($fill['from']) || $fill===true) {
				if (empty($OrderFromMap[$order['from_id']])) {
					$from = BackOrderHelp::OrderFromKey2Value($order['from_id'], true);	
					if (is_error($from) === false) {
						$OrderFromMap[$order['from_id']] = $from;
						$order['from_id_data'] = $from;
					}
				} else {
					$order['from_id_data'] = $OrderFromMap[$order['from_id']];
				}
				$fxOrder = $fxOrderObj->getOne(appendLogicExp('order_id','=', $order['id']));
				if (!empty($fxOrder)) {
					$fxUser = BackAccountHelp::getAccount('account_distribute', appendLogicExp('id', '=', $fxOrder['user_id']));
					if (is_error($fxUser) === false) {
						$fxOrder['user_id_data'] = $fxUser;
					}
					$order['fenxiao_data'] = $fxOrder;
				}
			}
			 
			// 站点填充
			if (!empty($fill['station']) || $fill===true) {
				if (empty($OrderStationMap[$order['station_id']])) {
					$station = BackAccountHelp::StationTypeKey2Value($order['station_id'], true);	
					if (is_error($station) === false) {
						$OrderStationMap[$order['station_id']] = $station;
						$order['station_id_data'] = $station;
					}
				} else {
					$order['station_id_data'] = $OrderStationMap[$order['station_id']];
				}
			}
			 
			// 同行填充
			if (!empty($order['tonghang'])){
				$order['tonghang_data'] = json_decode($order['tonghang'], true);
			}
			 
			// 地接填充
			if (!empty($order['dijie'])) {
				$order['dijie_data'] = json_decode($order['dijie'], true);
			}
			
			// 订单价格填充
			if (!empty($fill['money']) || $fill === true) {
				// 旧订单价格处理
				if ($order['new_order'] == 0) {
					$teamMoney = BackOrderHelp::getOrderSumTeamMoney($order['id']);
					if (is_error($teamMoney) === false) {
						$order['team_price'] = $teamMoney;
						$order['team_cut_price'] = $teamMoney;	
					}
					$sumMoney = BackOrderHelp::getOrderSumMoney($order['id']);
					if (is_error($sumMoney) === false) {
						$order['need_pay_money'] = $sumMoney;	
					}					
				} 
				$order['pay_cash'] = BackOrderHelp::getOrderPaySumMoney($order['id']);
			}
			
			// 订单线路信息
			$order_sn = BackOrderHelp::getRealOrderSN($order['order_sn'], $order_sn_prefix);
			if (!empty($fill['line']) || $fill === true) {
				// 特殊处理小包团
				if ($order_sn_prefix === 'YD') {
					$teamObj = ModelBase::getInstance('team_group');
					$team = $teamObj->getOne(appendLogicExp('id', '=', $order['lineid']));
					$order['lineid_data_type'] = 'team';
					$order['lineid_data'] = $team;
					$order['lineid_title'] = $team['title'];
					$order['lineid_subheading'] = $team['title'];
					$order['hdid_show_text'] = $team['meet_time'];
					$order['hdid_priceadult'] = $team['price_adult'];
					$order['hdid_pricechild'] = $team['price_child'];
					$order['hdid_start_time'] = $team['start_date'];
					$order['hdid_end_time'] = $team['meet_time'];
				} else {
					$conds = appendLogicExp('id', '=', $order['lineid']);
					if ($order['new_line'] == 1) {
						$lineFill = is_array($fill['line']) ? $fill['line'] : false;
						$line = BackLineHelp::getLine($conds, $lineFill);
						if (!empty($line)) {
							$order['lineid_data_type'] = 'line';
							$order['lineid_data'] = $line;
							$order['lineid_title'] = $line['title'];
							$order['lineid_subheading'] = $line['subheading'];
						}
					} else {
						$archivesObj = ModelBase::getInstance('archives', 'xz_');
						$archives = $archivesObj->getOne($conds);
						if (!empty($archives)) {
							$order['lineid_data_type'] = 'archives';
							$order['lineid_data'] = $archives;
							$order['lineid_title'] = $archives['title'];
							$order['lineid_subheading'] = $archives['shorttitle'];
						}
					}
				}
			} // end line fill
			
			// 订单批次信息
			if ((!empty($fill['batch']) || $fill === true) && $order_sn_prefix !== 'YD') {
				if ($order['new_line'] == 1) {
					$conds = appendLogicExp('id', '=', $order['hdid']);
					$batchFill = is_array($fill['batch']) ? $fill['batch'] : false;
					$batch = BackLineHelp::getBatch($conds, $batchFill);
					if (!empty($batch)) {
						$order['hdid_data_type'] = 'batch';
						$order['hdid_data'] = $batch;
						$order['hdid_show_text'] = date('Y年m月d日',strtotime($batch['start_time'])).' 至 '.date('Y年m月d日',strtotime($batch['end_time']));
						$order['hdid_priceadult'] = $batch['price_adult'];
						$order['hdid_pricechild'] = $batch['price_child'];
						$order['hdid_start_time'] = $batch['start_time'];
						$order['hdid_start_date'] = date('Y年m月d日',strtotime($batch['start_time']));
						$order['hdid_end_time'] = $batch['end_time'];
					}
				} else {
					$activityObj = ModelBase::getInstance('lineactivity', 'xz_');
					$activity = $activityObj->getOne(appendLogicExp('id', '=', $order['hdid']));
					if (!empty($activity)) {
						$order['hdid_data_type'] = 'activity';
						$order['hdid_data'] = $activity;
						$order['hdid_show_text'] = date('Y年m月d日',$activity['startdate']).' 至 '.date('Y年m月d日',$activity['enddate']);
						$order['hdid_priceadult'] = $activity['priceadult'];
						$order['hdid_pricechild'] = $activity['pricechild'];
						$order['hdid_start_time'] = $activity['startdate'];
						$order['hdid_start_date'] = date('Y年m月d日',strtotime($activity['startdate']));
						$order['hdid_end_time'] = $activity['enddate'];
					}
				}
			} // end batch fill
			
			if ((!empty($fill['line']) && !empty($fill['batch'])) || $fill === true) {
				$order['lineid_hdid_show'] = $order['lineid_title'].'<br />'.$order['hdid_show_text'];
			}
			
			if (!empty($fill['taocan']) || $fill === true) {
				$taocanFill = is_array($fill['taocan']) ? $fill['taocan'] : false;
				$conds = appendLogicExp('id', '=', $order['tc_price_id']);
				$order['taocan'] = BackLineHelp::getTaocanPrice($conds, $taocanFill);
			}
			
			// 下单的账户信息
			if (!empty($fill['account']) || $fill === true) {
				if (empty($AccountMap[$order['book_account_type']][$order['userid']])) {					
					if ($order['new_order'] == 1) {
						$conds = appendLogicExp('id', '=', $order['userid']);
					} else {
						$conds = appendLogicExp('mid', '=', $order['userid']);
					}
					$account = BackAccountHelp::getAccount($order['book_account_type'], $conds);
					if (is_error($account) === false) {
						$AccountMap[$order['book_account_type']][$order['userid']] = $account;
					}
				} else {
					$account = $AccountMap[$order['book_account_type']][$order['userid']];
				}
				if (!empty($account)) {
					$order['userid_data'] = $account;
					$order['userid_data_type'] = $account['account_type']['type_key'];
				}
			} // end account fill
			
			// 用户使用的用优惠券
			if (!empty($fill['use_coupon']) || $fill === true) {
				$order['use_coupons'] = array(); 
				if ($order['new_order'] == 1) {
					if (empty($AcctTypeMap[$order['book_account_type']])) {
						$acctType = BackAccountHelp::AccountTypeKey2Value($order['book_account_type'], true);
						if (is_error($acctType) === false) {						
							$AcctTypeMap[$acctType['id']] = $acctType;
						}
					} else {
						$acctType = $AcctTypeMap[$order['book_account_type']];
					}
					
					if ($acctType['type_key'] == 'account_user') {
						$couponConds = appendLogicExp('user_id', '=', $order['userid']);
						$couponConds = appendLogicExp('use', '=', '1', 'AND', $couponConds);
						$couponConds = appendLogicExp('order_id', '=', $order['id'], 'AND', $couponConds);
						$coupons = BackAccountHelp::getUserCoupon($couponConds);
						if (is_error($coupons) === false) {
							$order['use_coupons'] = $coupons;
						}
					}
				}
			} // end coupon fill
			
			// 订单参团人信息
			if (!empty($fill['member']) || $fill === true) {
				$conds = appendLogicExp('exit', '=', '0');
				$order['members'] = BackOrderHelp::getOrderMembers($order['id'],$conds);
				
				$largessObj = ModelBase::getInstance('member_largess');
				foreach ($order['members'] as $mk=>$mv) {
					$largess = $largessObj->getAll(appendLogicExp('member_id', '=', $mv['id']));
					foreach ($largess as $lk=>$lv) {
						$lv['member_data'] = $mv;
						$lv['largess_data'] = json_decode($lv['largess'], true);
						$lv['data_info'] = json_decode($lv['data'], true);
						$largess[$lk] = $lv;
					}
					$mv['largess'] = $largess;
					$order['members'][$mk] = $mv;
				}
			}
			
			// 订单额外费用
			if (!empty($fill['extra_cash']) || $fill === true) {
				$order['extra_cash'] = array();
				$extraCashObj = ModelBase::getInstance('order_extra_cash');
				$extraCashCDS = appendLogicExp('order_id', '=', $order['id']);
				$extraCashCDS = appendLogicExp('invalid', '!=', 1, 'AND', $extraCashCDS);
				$extraCash = $extraCashObj->getAll($extraCashCDS);
				foreach ($extraCash as $eck=>$ecv) {
					if (empty($CashUseMap[$ecv['cash_use_id']])) {
						$cashUse = BackReviewHelp::cashUseKey2Value($ecv['cash_use_id'], true);
						if (is_error($cashUse) === false) {
							$CashUseMap[$ecv['cash_use_id']] = $cashUse;
						}
					} else {
						$cashUse = $CashUseMap[$ecv['cash_use_id']];					
					}
					$ecv['cash_use_id_data'] = $cashUse;
					array_push($order['extra_cash'], $ecv);	
				}
			}
			
			// 订单后台发放的优惠券
			if (!empty($fill['order_coupon']) || $fill === true) {
				$order['coupons'] = array();
				$orderCouponObj = ModelBase::getInstance('order_coupon');
				$couponConds = appendLogicExp('order_id', '=', $order['id']);
				$couponConds = appendLogicExp('invalid', '!=', 1, 'AND', $couponConds);
				$orderCoupon = $orderCouponObj->getAll($couponConds);
				foreach ($orderCoupon as $ock=>$ocv) {
					// 查询优惠券类型，有该类型将不再查询
					if (empty($couponMap[$ocv['coupon_type_id']])) {
						$couponType = BackOrderHelp::CouponTypeKey2Value($ocv['coupon_type_id'], true);
						if (is_error($couponType) === true) {
							continue;
						}
						$couponMap[$ocv['coupon_type_id']] = $couponType;
					} else {
						$couponType = $couponMap[$ocv['coupon_type_id']];
					}
					$ocv['coupon_type_id_data'] = $couponType;
					
					// 发放人员
					if (empty($AccountMap['kl_admin'][$ocv['admin_id']])) {
						$conds = appendLogicExp('id', '=', $ocv['admin_id']);
						$account = BackAccountHelp::getAccount('account_admin', $conds);
						if (is_error($account) === false) {
							$AccountMap['kl_admin'][$ocv['admin_id']] = $account;
						}
					} else {
						$account = $AccountMap['kl_admin'][$ocv['admin_id']];
					}					
					$ocv['admin_id_account'] = $account['show_name'];	
					array_push($order['coupons'], $ocv);
				}
			}
						
			// 订单留言
			if (!empty($fill['order_message']) || $fill === true) {				
				$order['messages'] = array();
				$messageObj = ModelBase::getInstance('order_message');
				$message = $messageObj->getAll(appendLogicExp('order_id', '=', $order['id']), 0,0,$total,array('create_time'=>'desc'));
				foreach ($message as $sk=>$sv) {
					// 留言人员
					if (empty($AccountMap['kl_admin'][$sv['admin_id']])) {
						$conds = appendLogicExp('id', '=', $sv['admin_id']);
						$account = BackAccountHelp::getAccount('account_admin', $conds);
						if (is_error($account) === false) {
							$AccountMap['kl_admin'][$sv['admin_id']] = $account;
						}
					} else {
						$account = $AccountMap['kl_admin'][$sv['admin_id']];
					}
					
					$sv['admin_id_account'] = $account['show_name'];	
					array_push($order['messages'], $sv);
				}					
			}
			
			if (!empty($fill['pay_online']) || $fill === true) {
				$order_sn = BackOrderHelp::getRealOrderSN($order['order_sn']);
				
				$order['pays_online'] = array();
				// 线上付款记录条件
				$sort = array('SendTime'=>'desc');
				$conds = appendLogicExp('order_sn', 'LIKE', $order_sn.'%');
				
				// 线上付款记录1
				$payLogObj = ModelBase::getInstance('pay_log', 'xz_');	
				$payLog = $payLogObj->getAll($conds, 0, 0, $total, $sort);
				
				// 线上付款记录2
				$payLog2Obj = ModelBase::getInstance('pay_log2', 'xz_');
				$payLog2 = $payLog2Obj->getAll($conds, 0, 0, $total, $sort);
				if (!empty($payLog2)) {
					$payLog = array_merge($payLog, $payLog2);
				}
				
				foreach($payLog as $plk=>$plv) {
					$plv['SendTime_show_text'] = substr($plv['SendTime'],0,4).'年'.substr($plv['SendTime'],4,2).'月'.substr($plv['SendTime'],6,2).'日 '.substr($plv['SendTime'],8,2).':'.substr($plv['SendTime'],10,2).':'.substr($plv['SendTime'],12,2);
					$plv['datetime_show_text'] = date('Y年m月d日 H:i:s', $plv['datetime']);
					if (!empty($MenuMaps)) {
						$menuItem = $MenuMaps[$plv['PayChannel']];
					} else {
						$menuItem = MyHelp::MenuItemKey2Value('pay_menu', $plv['PayChannel'], true);
						$MenuMaps[$plv['PayChannel']] = $menuItem;
					}
					$plv['PayChannel_data'] = $menuItem;
					array_push($order['pays_online'], $plv);
				}
			}
									
			// 线下付款记录
			if (!empty($fill['pay_offline']) || $fill === true) {
				$order['pays_offline'] = array();
				$reviewOrderObj = ModelBase::getInstance('order_review');
				$reviewOrder = $reviewOrderObj->getAll(appendLogicExp('order_id', '=', $order['id']), 0, 0, $total, 'create_time');
				
				$reviewFill = array(
					'admin_submit'=>true,
					'admin_review'=>true,
					'order_state'=>true,
					'review_type'=>true,
					'cash_func' => true,
					'cash_use' => true,
					'pay' => true,
				);	
				$order['pays_offline'] = BackReviewHelp::fillReviewInfo($reviewOrder,$reviewFill);
			}	
			
			// 跟踪记录
			if (!empty($fill['supervise']) || $fill === true) {				
				$order['supervises'] = array();	
				$superviseObj = ModelBase::getInstance('order_supervise');
				$supervises = $superviseObj->getAll(appendLogicExp('order_id', '=', $order['id']), 0,0,$total,'create_time');
				foreach ($supervises as $sk=>$sv) {
					// 操作人员
					if (empty($AccountMap['kl_admin'][$sv['admin_id']])) {
						$conds = appendLogicExp('id', '=', $sv['admin_id']);
						$account = BackAccountHelp::getAccount('account_admin', $conds);
						if (is_error($account) === false) {
							$AccountMap['kl_admin'][$sv['admin_id']] = $account;
						}
					} else {
						$account = $AccountMap['kl_admin'][$sv['admin_id']];
					}
					
					$sv['admin_id_account'] = $account['show_name'];
					array_push($order['supervises'], $sv);
				}
			}	
			
			$ds[$dk] = $order;	
		} // end foreach
		
		return $dsIsList === false ? $ds[0] : $ds;
	}	
	
	// 把老订单的参团人员添加到新表中
	public static function memberTableChangeOld2New($order, &$memberIds, &$exitRS) {		
		if (empty($order['id'])) {
			return error(-1, '订单编号为空，不能转换参团人信息');
		}
		if (empty($order['ct_ids']) && empty($order['ct_names']) && empty($order['ct_sjnum'])) {
			return error(1, '参团人信息已转换');
		}
		$ids = explode('&nbsp;', $order['ct_ids']);	
		$names = explode('&nbsp;', $order['ct_names']);
		$tels = explode('&nbsp;', $order['ct_sjnum']);
		$certTypes = explode('&nbsp;', $order['ct_zhengjian']);
		$certNums = explode('&nbsp;', $order['ct_zjcode']);
		$types = explode('&nbsp;', $order['ct_types']);
		$exits = explode('&nbsp;', $order['ct_exits']);
		
		$memberCount = count($ids);
		if (empty($memberCount)) {
			$memberCount = count($names);
		}
		if (empty($memberCount)) {
			$memberCount = count($tels);
		}
		if (empty($memberCount)) {
			return error(-1, '旧参团人解析错误');
		}
		
		$certTypeObj = ModelBase::getInstance('certificate_type');
		$allCertTypes = $certTypeObj->getAll();
		
		$memberObj = ModelBase::getInstance('signup_member');
		for ($i = 0; $i < $memberCount; $i ++) {
			$member['order_id'] = $order['id'];
			$member['name'] = $names[$i];
			$member['type_id'] = $types[$i];
			$certTypeId = 0;
			foreach($allCertTypes as $ck=>$cv) {
				if ($cv['type_desc'] == $certTypes[$i]) {
					$certTypeId = $cv['id'];	
					break;
				}				
			}
			$member['certificate_type_id'] = $certTypeId;
			$member['certificate_num'] = $certNums[$i];
			$member['tel'] = $tels[$i];
			$member['exit'] = empty($exits[$i]) ? 0 : 2;
			$rs = $memberObj->create($member, $memberId);
			if (error_ok($rs) === false) {
				$temp_msg .= '/'.$member['name'].'=>'.$rs['message'];
				$memberIds[$ids[$i]] = $rs;	
				return error(-1, $rs['message'].$temp_msg);
			} else {
				$temp_msg .= '/'.$member['name'].'=>'.$memberId;
				$memberIds[$ids[$i]] = $memberId;	
			}
		}
				
		// 清空原表数据
		$emptyMember = array('ct_ids'=>'','ct_names'=>'','ct_sjnum'=>'','ct_zjcode'=>'','ct_zhengjian'=>'','ct_zjcode'=>'','ct_types'=>'','ct_exits'=>'','ct_diaocha'=>'','new_order'=>1);
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$result = $orderObj->modify($emptyMember, appendLogicExp('id', '=', $order['id']));
		if (error_ok($result) === true) {
			// 退团人编号转换
			if (!empty($memberIds)) {
				$exitMemberObj = ModelBase::getInstance('order_review_exit_member');
				$reviews = $exitMemberObj->getAll(appendLogicExp('order_id', '=', $order['id']));
				foreach ($reviews as $rk=>$rv){
					$newIds = '';
					$oldIds = explode(',', $rv['member_id']);
					foreach ($oldIds as $ok=>$ov) {
						// 新的编号不为空,并且新的编号没有错误
						if (!empty($memberIds[$ov]) && is_error($memberIds[$ov]) === false) {
							if (!empty($newIds)) {
								$newIds .= ',';
							}
							$newIds .= $memberIds[$ov];
						}
					}
					$exitRS[$rv['id']] = $exitMemberObj->modify(array('member_id'=>$newIds), appendLogicExp('id', '=', $rv['id']));
				}
			}
		}
		return $result;
	}
	
	// 订单状态类型键值编号互转
	public static function OrderStateTypeKey2Value($param, $dataAll=false) {		
		// 缓存订单状态类型
		if (is_numeric($param)) {
			$stateTypeIdMap = BackOrderHelp::cacheOrderStateType('id');
			if (empty($stateTypeIdMap) || empty($stateTypeIdMap[$param])) {
				return error(-1, '错误的订单状态类型转换');
			}
			$stateType = $stateTypeIdMap[$param];
			$valCol = 'type_key';
		} else {
			$stateTypeKeyMap = BackOrderHelp::cacheOrderStateType('key');
			if (empty($stateTypeKeyMap) || empty($stateTypeKeyMap[$param])) {
				return error(-1, '错误的订单状态类型转换');
			}
			$stateType = $stateTypeKeyMap[$param];
			$valCol = 'id';
		}
		return $dataAll === false ? $stateType[$valCol] : $stateType;
	}
		
	// 订单状态键值编号互转
	public static function OrderStateKey2Value($param, $dataAll=false) {		
		// 缓存订单状态
		if (is_numeric($param)) {
			$stateIdMap = BackOrderHelp::cacheOrderState('id');
			if (empty($stateIdMap) || empty($stateIdMap[$param])) {
				return error(-1, '错误的订单状态转换');
			}
			$state = $stateIdMap[$param];
			$valCol = 'type_key';
		} else {
			$stateKeyMap = BackOrderHelp::cacheOrderState('key');
			if (empty($stateKeyMap) || empty($stateKeyMap[$param])) {
				return error(-1, '错误的订单状态转换');
			}
			$state = $stateKeyMap[$param];
			$valCol = 'id';
		}
		return $dataAll === false ? $state[$valCol] : $state;
	}
	
	// 订单来键值编号互转
	public static function OrderFromKey2Value($param, $dataAll=false) {		
		// 缓存订单来源
		if (is_numeric($param)) {
			$fromIdMap = BackOrderHelp::cacheOrderFrom('id');
			if (empty($fromIdMap) || empty($fromIdMap[$param])) {
				return error(-1, '错误的订单来源转换');
			}
			$from = $fromIdMap[$param];
			$valCol = 'type_key';
		} else {
			$fromKeyMap = BackOrderHelp::cacheOrderFrom('key');
			if (empty($fromKeyMap) || empty($fromKeyMap[$param])) {
				return error(-1, '错误的订单来源转换');
			}
			$from = $fromKeyMap[$param];
			$valCol = 'id';
		}
		return $dataAll === false ? $from[$valCol] : $from;
	}
	
	// 订单参团人员类型键值编号互转
	public static function MemberTypeKey2Value($param, $dataAll=false) {		
		// 缓存参团人类型
		if (is_numeric($param)) {
			$typeIdMap = BackOrderHelp::cacheMemberType('id');
			if (empty($typeIdMap) || empty($typeIdMap[$param])) {
				return error(-1, '错误的参团人类型源转换');
			}
			$type = $typeIdMap[$param];
			$valCol = 'type_key';
		} else {
			$typeKeyMap = BackOrderHelp::cacheMemberType('key');
			if (empty($typeKeyMap) || empty($typeKeyMap[$param])) {
				return error(-1, '错误的参团人类型源转换');
			}
			$type = $typeKeyMap[$param];
			$valCol = 'id';
		}
		return $dataAll === false ? $type[$valCol] : $type;
	}
	
	// 订单参团人员证件类型键值编号互转
	public static function CertTypeKey2Value($param, $dataAll=false) {		
		// 缓存参团人证件类型
		if (is_numeric($param)) {
			$typeIdMap = BackOrderHelp::cacheCertType('id');
			if (empty($typeIdMap) || empty($typeIdMap[$param])) {
				return error(-1, '错误的参团人证件类型源转换');
			}
			$type = $typeIdMap[$param];
			$valCol = 'type_key';
		} else {
			$typeKeyMap = BackOrderHelp::cacheCertType('key');
			if (empty($typeKeyMap) || empty($typeKeyMap[$param])) {
				return error(-1, '错误的参团人证件类型源转换');
			}
			$type = $typeKeyMap[$param];
			$valCol = 'id';
		}
		return $dataAll === false ? $type[$valCol] : $type;
	}
	
	// 订单优惠券键值编号互转
	public static function CouponTypeKey2Value($param, $dataAll=false) {	
		// 缓存订单系统优惠类型
		if (is_numeric($param)) {
			$typeIdMap = BackOrderHelp::cacheSysCouponType('id');
			if (empty($typeIdMap) || empty($typeIdMap[$param])) {
				return error(-1, '错误的订单系统优惠类型源转换');
			}
			$type = $typeIdMap[$param];
			$valCol = 'type_key';
		} else {
			$typeKeyMap = BackOrderHelp::cacheSysCouponType('key');
			if (empty($typeKeyMap) || empty($typeKeyMap[$param])) {
				return error(-1, '错误的订单系统优惠类型源转换');
			}
			$type = $typeKeyMap[$param];
			$valCol = 'id';
		}
		return $dataAll === false ? $type[$valCol] : $type;
	}
	
	// 获取订单状态
	public static function getOrderStateList($stateType) {
		$stateTypeId = $stateType;
		if (is_numeric($stateType) == false) {
			$stateTypeId = BackOrderHelp::OrderStateTypeKey2Value($stateType);
			if (is_error($stateTypeId) === true) {
				return error(-1, '获取订单状态列表时，转换订单状态类型错误');
			}
		}
		
		if (empty($stateTypeId)) {
			return error(-1, '订单状态列表获取错误，错误的订单状态类型参数');
		}
		
		// 缓存订单状态
		$stateIdMap = BackOrderHelp::cacheOrderState('id');
		if (empty($stateIdMap)) {
			return error(-1, '获取订单状态列表错误');
		}
		
		// 获取需要类型的订单状态
		$states = array();
		foreach($stateIdMap as $sk=>$sv) {
			if ($sv['state_type_id'] == $stateTypeId) {
				array_push($states, $sv);
			}
		}
		return $states;
	}
	
	// 写入订单留言记录
	public static function writeMessage($orderId, $msg) {
		if (empty($msg)) {
			return error(-1, '1.留言信息不能为空');
		}
		
		$admin = MyHelp::getLoginAccount(true);	
		if (is_error($admin) === true) {
			return error(-1, '用户未登陆，请登录后再进行操作');
		}	
		$orderMsgObj = ModelBase::getInstance('order_message');
		$msgData['order_id'] = $orderId;
		$msgData['admin_id'] = $admin['id'];
		$msgData['create_time'] = fmtNowDateTime();
		$msgData['content'] = $msg;		
		
		$orderMsgCols = $orderMsgObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$saveData = coll_elements_giveup($orderMsgCols, $msgData);
		$result = $orderMsgObj->create($saveData, $msgId);
		if (error_ok($result) === false) {
			return error(-2, '2'.$result['message']);
		}
		return $msgId;
	}
	
	// 写入订单跟踪记录
	public static function writeSupervise($orderId, $reason) {			
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$order = $orderObj->getOne(appendLogicExp('id', '=', $orderId));
		if (empty($order)) {
			return error(-1, '无法获取订单信息');
		}
		
		$admin = MyHelp::getLoginAccount(false);
//		if (is_error($admin) === true) {
//			return error(-1, '用户未登陆，请登录后再进行操作');
//		} 
		if (is_error($admin) === false) {
			$aa['admin_id'] = $admin['id'];
			$aa['admin_id_account'] = $admin['account'];
		}
		$aa['order_id'] = $orderId;
		$aa['create_time'] = fmtNowDateTime();
		$aa['reason'] = $reason;		
		
		$superviseObj = ModelBase::getInstance('order_supervise');
		$superviseCols = $superviseObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$saveData = coll_elements_giveup($superviseCols, $aa);
		$result = $superviseObj->create($saveData, $superviseId);
		if (error_ok($result) === true) {
			$aa['id'] = $superviseId;
			return $aa;
		}
		return $result;
	}
}

?>