<?php
/**
 * Created by CodeLobster.
 * User: PF
 * Date: 2016-4-12
 * Time: 2016-4-12 19:23:51
 */

namespace Core\Model;

class BackReviewHelp {	

	// 提交审核记录
	public static function commitOrderReview($orderInfo, $cash, $cashFuncId, $cashUseId, $payInfo=array(), $reason='', $extraCashId=0, &$output) {		
		$admin = MyHelp::getLoginAccount(true);
		if (is_error($admin)) {
			return error(-1, '1.用户未登陆，请登陆后再进行操作');			
		}
		$reviewData['admin_id'] = $admin['id'];
		
		if (!array_key_exists('order_id', $orderInfo)) {
			return error(-2, '2.错误的订单编号，不能提交审核记录');
		}
				
		$reviewData['order_id'] = $orderInfo['order_id'];
		if (array_key_exists('order_state_id', $orderInfo)) {
			$reviewData['order_state_id'] = $orderInfo['order_state_id'];
		} else {
			$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
			$order = $orderObj->getOne(appendLogicExp('id', '=', $orderInfo['order_id']));
			if (!empty($order)) {
				return error(-3, '3.未能获取到正确的订单信息，不能提交审核记录');
			}
			$reviewData['order_state_id'] = $order['zhuangtai'];	
		}
		
		$reviewData['extra_cash_id'] = $extraCashId;
		$reviewData['cash_func_id'] = $cashFuncId;
		$reviewData['cash_use_id'] = $cashUseId;
		$reviewData['cash'] = $cash;
		
		if (array_key_exists('pay_channel_id', $payInfo)) {
			$reviewData['pay_channel_id'] = $payInfo['pay_channel_id'];
		}
		
		if (array_key_exists('pay_type_id', $payInfo)) {
			$reviewData['pay_type_id'] = $payInfo['pay_type_id'];
		}
		
		if (array_key_exists('pay_bank_id', $payInfo)) {
			$reviewData['pay_bank_id'] = $payInfo['pay_bank_id'];
		}
		
		if (array_key_exists('bank_code', $payInfo)) {
			$reviewData['bank_code'] = $payInfo['bank_code'];
		}
		
		$reviewData['review_type_id'] = BackReviewHelp::reviewTypeKey2Value('reviewing');		
		$reviewData['create_time'] = fmtNowDateTime();
		$reviewData['request_reason'] = $reason;
		
		// 一键审核
		if ($orderInfo['flag'] === 'pass') {
			$reviewData['review_admin_id'] = $reviewData['admin_id'];
			$reviewData['review_type_id'] = BackReviewHelp::reviewTypeKey2Value('review_pass');
			$reviewData['update_time'] = $reviewData['create_time'];
			$reviewData['response_reason'] = '【系统】一键审核通过该请求';
		}
		
		$orderReviewObj = ModelBase::getInstance('order_review');
		$result = $orderReviewObj->create($reviewData, $instId);
		if (is_error($result) && error_ok($result) === false) {
			return $result;
		}
		return $instId;
	}
	
	// 审查审核订单
	public static function reviewOrder($reviewId, $bPass, $reason='') {
		$review_type_key = $bPass === true?'review_pass':'review_fail';
		BackReviewHelp($reviewId, $review_type_key, $reason);
	}
	
	// 设置订单状态根据Id
	public static function setReviewTypeById($reviewId, $reviewTypeId, $reason='') {
		$orderReviewObj = ModelBase::getInstance('order_review');
		$ds['review_type_id'] = $reviewTypeId;
		$ds['update_time'] = fmtNowDateTime();
		$ds['response_reason'] = $reason;		
		$admin = MyHelp::getLoginAccount(true);
		if (is_error($admin)) {
			return error(-1, '用户未登陆，请登陆后再进行操作');			
		}
		$ds['review_admin_id'] = $admin['id'];
		return $orderReviewObj->modify($ds, appendLogicExp('id','=',$reviewId));
	}
	
	// 设置订单状态根据状态键
	public static function setReviewTypeByKey($reviewId, $typeKey, $reason='') {
		$reviewTypeId = BackReviewHelp::reviewTypeKey2Value($typeKey);
		if (is_error($reviewTypeId)) {
			return $reviewTypeId;
		}
		return BackReviewHelp::setReviewTypeById($reviewId, $reviewTypeId, $reason);
	}
	
	// 获取当前订单
	public static function getReviewInfo($reviewId) {
		$orderReviewObj = ModelBase::getInstance('order_review');
		$orderReview = $orderReviewObj->getOne(appendLogicExp('id', '=', $reviewId));
		if (empty($orderReview)) {
			return error(-1, '根据审核编号未能查到指定审核信息,获取审核信息失败');
		}
		return $orderReview;
	}
	
/**
* 填充审核订单的信息
* @param undefined $ds
* @param 填充内容 $fill = {
	* 'admin_submit'=>提交人
	* 'admin_review'=>审核人
	* 'order'=>订单信息
	* 'order_state'=>原订单状态
	* 'cash_func'=>费用功能
	* 'cash_use'=>费用用途
	* 'pay'=>付款渠道,类型,银行
	* 'review_type'=>审核类型
	* 'exit_member'=>退团人
	* 'new_line'=>新线路
	* 'new_batch'=>新批次
	* 'new_order'=>新套餐
	* 
}
* 
* @return review
*/
	public static function fillReviewInfo($ds,$fill=false) {
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
		
		foreach ($ds as $dk=>$dv) {				
			// 填充管理员	
			$adminCDS = array();	
			if (!empty($fill['admin_submit']) || $fill===true)	{
				if (!empty($dv['admin_id'])) {
					if (empty($AdminMap[$dv['admin_id']])) {
						$adminCDS = appendLogicExp('id', '=', $dv['admin_id'], 'OR', $adminCDS);	
					} else {
						$dv['admin_id_data'] = $AdminMap[$dv['admin_id']];
					}
				}				
			}
			if (!empty($fill['admin_review']) || $fill===true)	{
				if (!empty($dv['review_admin_id'])) {
					if (empty($AdminMap[$dv['review_admin_id']])) {
						$adminCDS = appendLogicExp('id', '=', $dv['review_admin_id'], 'OR', $adminCDS);	
					} else {
						$dv['review_admin_id_data'] = $AdminMap[$dv['review_admin_id']];
					}
				}
			}
			
			if (!empty($adminCDS)) {
				$admin = BackAccountHelp::getAccountList('account_admin', $adminCDS);	
				foreach ($admin as $ak => $av) {
					if (intval($av['id']) === intval($dv['admin_id'])) {
						$dv['admin_id_data'] = $av;
					}
					if (intval($av['id']) === intval($dv['review_admin_id'])){
						$dv['review_admin_id_data'] = $av;
					}
					
					if (empty($AdminMap[$v['id']])) {
						$AdminMap[$v['id']] = $v;
					}
				}
			}
			
			// 原订单状态
			if (!empty($fill['order_state']) || $fill===true)	{
				if (empty($OrderStateMap[$dv['order_state_id']])) {
					$state = BackOrderHelp::OrderStateKey2Value($dv['order_state_id'], true);
					if (is_error($state) === false) {
						$OrderStateMap[$order['order_state_id']] = $state;
						$dv['order_state_id_data'] = $state;
					}
				} else {
					$dv['order_state_id_data'] = $OrderStateMap[$dv['order_state_id']];
				}
			}
			
			// 填充审核订单类型	
			if (!empty($fill['review_type']) || $fill===true)	{
				if (empty($ReviewTypeMap[$dv['review_type_id']])) {
					$reviewType = BackReviewHelp::reviewTypeKey2Value($dv['review_type_id'], true);
					if (is_error($reviewType) === false) {
						$ReviewTypeMap[$dv['review_type_id']] = $reviewType;
					}
				} else {
					$reviewType = $ReviewTypeMap[$dv['review_type_id']];
				}
				$dv['review_type_id_data'] = $reviewType;
				
				// 是否可进行审批
				if ($reviewType['type_key'] === 'review_pass' || $reviewType['type_key'] === 'review_fail') {					
					$dv['review_complate'] = true;
				}		
			}			
			
			// 填充费用用途
			if (!empty($fill['cash_use']) || $fill===true)	{
				if (empty($CashUseMap[$dv['cash_use_id']])) {
					$cashUse = BackReviewHelp::cashUseKey2Value($dv['cash_use_id'], true);
					if (is_error($cashUse) === false) {
						$CashUseMap[$dv['cash_use_id']] = $cashUse;
						$dv['cash_use_id_data'] = $cashUse;
					}
				} else {
					$dv['cash_use_id_data'] = $CashUseMap[$dv['cash_use_id']];
				}
			}
			
			// 填充费用功能
			if (!empty($fill['cash_func']) || $fill===true)	{
				if (empty($CashFuncMap[$dv['cash_func_id']])) {
					$cashFunc = BackReviewHelp::cashFuncKey2Value($dv['cash_func_id'], true);
					if (is_error($cashFunc) === false) {
						$CashFuncMap[$dv['cash_func_id']] = $cashFunc;
						$dv['cash_func_id_data'] = $cashFunc;
					}
				} else {
					$dv['cash_func_id_data'] = $CashFuncMap[$dv['cash_func_id']];
				}
			}
				
			// 填充付款渠道、类型、银行		
			if (!empty($fill['pay']) || $fill===true)	{
				if (empty($MenuMap)) {
					$menuItems = MyHelp::getMenuList('pay_menu');			
					foreach ($menuItems as $mik=>$miv) {
						$MenuMap[$miv['id']] = $miv;
					}
				}
				if (!empty($MenuMap[$dv['pay_channel_id']])) {
					$dv['pay_channel_id_data'] = $MenuMap[$dv['pay_channel_id']];
				}
				
				if (!empty($MenuMap[$dv['pay_type_id']])) {
					$dv['pay_type_id_data'] = $MenuMap[$dv['pay_type_id']];
				}
				
				if (!empty($MenuMap[$dv['pay_bank_id']])) {
					$dv['pay_bank_id_data'] = $MenuMap[$dv['pay_bank_id']];
				}
			}	
			
			if (!empty($fill['order']) || $fill===true)	{
				if (empty($OrderMap[$dv['order_id']])) {
					$order = BackOrderHelp::getOrderInfo($dv['order_id']);			
					if (!empty($order)) {						
						$orderFill = is_array($fill['order']) ? $fill['order'] : false;
						$order = BackOrderHelp::fillNewOrderInfo($order, $orderFill);
						$OrderMap[$dv['order_id']] = $order;
					}
					$dv['order_id_data'] = $order;
				} else {
					$dv['order_id_data'] = $OrderMap[$dv['order_id']];
				}
			}
			
			// 填充退团人员
			if (!empty($fill['exit_member']) || $fill===true)	{				
				if (!empty($dv['member_id'])) {
					$exitConds = appendLogicExp('id', 'IN', '('.$dv['member_id'].')');
					$exitConds = appendLogicExp('order_id', '=', $dv['order_id'], 'AND', $exitConds);
					$memberObj = ModelBase::getInstance('signup_member');
					$members = $memberObj->getAll($exitConds);
					if (!empty($members)) {						
						$dv['member_id_data'] = $members;
						$dv['member_id_name_show'] = '';
						$dv['member_id_phone_show'] = '';
						foreach ($members as $mk=>$mv) {
							if (!empty($dv['member_id_name_show'])) {
								$dv['member_id_name_show'] .= '/';
								$dv['member_id_phone_show'] .= '/';
							}							
							$dv['member_id_name_show'] .= $mv['name'];
							$dv['member_id_phone_show'] .= $mv['tel'];
						}	
					}
				}
			}
			
			// 填充产品
			if (!empty($fill['new_line']) || $fill===true)	{
				// 不可能转到小包团直接进行新旧产品判断
				// 新订单线路
				$conds = appendLogicExp('id', '=', $dv['lineid']);
				if ($dv['new_line'] == 1) {
					$lineFill = is_array($fill['new_line']) ? $fill['new_line'] : false;
					$line = BackLineHelp::getLine($conds, $lineFill);
					if (!empty($line)) {
						$dv['lineid_data_type'] = 'line';
						$dv['lineid_data'] = $line;
						$dv['lineid_title'] = $line['title'];
						$dv['lineid_subheading'] = $line['subheading'];
					}
				} else {
					$archivesObj = ModelBase::getInstance('archives', 'xz_');
					$archives = $archivesObj->getOne($conds);
					if (!empty($archives)) {
						$dv['lineid_data_type'] = 'archives';
						$dv['lineid_data'] = $archives;
						$dv['lineid_title'] = $archives['title'];
						$dv['lineid_subheading'] = $archives['shorttitle'];
					}
				}
				// 原订单线路信息
				$conds = appendLogicExp('id', '=', $dv['old_lineid']);
				if ($dv['old_new_line'] == 1) {
					$lineFill = is_array($fill['new_line']) ? $fill['new_line'] : false;
					$line = BackLineHelp::getLine($conds, $lineFill);
					if (!empty($line)) {
						$dv['old_lineid_data_type'] = 'line';
						$dv['old_lineid_data'] = $line;
						$dv['old_lineid_title'] = $line['title'];
						$dv['old_lineid_subheading'] = $line['subheading'];
					}
				} else {
					$archivesObj = ModelBase::getInstance('archives', 'xz_');
					$archives = $archivesObj->getOne($conds);
					if (!empty($archives)) {
						$dv['old_lineid_data_type'] = 'archives';
						$dv['old_lineid_data'] = $archives;
						$dv['old_lineid_title'] = $archives['title'];
						$dv['old_lineid_subheading'] = $archives['shorttitle'];
					}
				}
			}
			
			// 填充批次
			if (!empty($fill['new_batch']) || $fill===true) {
				// 新批次填充
				$conds = appendLogicExp('id', '=', $dv['hdid']);
				if ($dv['new_line'] == 1) {
					$batchFill = is_array($fill['new_batch']) ? $fill['new_batch'] : false;
					$batch = BackLineHelp::getBatch($conds, $batchFill);
					if (!empty($batch)) {
						$dv['hdid_data_type'] = 'batch';
						$dv['hdid_data'] = $batch;
						$dv['hdid_show_text'] = date('Y年m月d日',strtotime($batch['start_time'])).' 至 '.date('Y年m月d日',strtotime($batch['end_time']));
						$dv['hdid_priceadult'] = $batch['price_adult'];
						$dv['hdid_pricechild'] = $batch['price_child'];
					}
				} else {
					$activityObj = ModelBase::getInstance('lineactivity', 'xz_');
					$activity = $activityObj->getOne($conds);
					if (!empty($activity)) {
						$dv['hdid_data_type'] = 'activity';
						$dv['hdid_data'] = $activity;
						$dv['hdid_show_text'] = date('Y年m月d日',$activity['startdate']).' 至 '.date('Y年m月d日',$activity['enddate']);
						$dv['hdid_priceadult'] = $activity['priceadult'];
						$dv['hdid_pricechild'] = $activity['pricechild'];
					}
				}
				// 旧批次填充
				$conds = appendLogicExp('id', '=', $dv['old_hdid']);
				if ($dv['old_new_line'] == 1) {
					$batchFill = is_array($fill['new_batch']) ? $fill['new_batch'] : false;
					$batch = BackLineHelp::getBatch($conds, $batchFill);
					if (!empty($batch)) {
						$dv['old_hdid_data_type'] = 'batch';
						$dv['old_hdid_data'] = $batch;
						$dv['old_hdid_show_text'] = date('Y年m月d日',strtotime($batch['start_time'])).' 至 '.date('Y年m月d日',strtotime($batch['end_time']));
						$dv['old_hdid_priceadult'] = $batch['price_adult'];
						$dv['old_hdid_pricechild'] = $batch['price_child'];
					}
				} else {
					$activityObj = ModelBase::getInstance('lineactivity', 'xz_');
					$activity = $activityObj->getOne($conds);
					if (!empty($activity)) {
						$dv['old_hdid_data_type'] = 'activity';
						$dv['old_hdid_data'] = $activity;
						$dv['old_hdid_show_text'] = date('Y年m月d日',$activity['startdate']).' 至 '.date('Y年m月d日',$activity['enddate']);
						$dv['old_hdid_priceadult'] = $activity['priceadult'];
						$dv['old_hdid_pricechild'] = $activity['pricechild'];
					}
				}
			}
			
			// 同时填充产品与批次，附赠显示组合内容
			if ((!empty($fill['new_line']) && !empty($fill['new_batch'])) || $fill === true) {
				$dv['lineid_hdid_show'] = $order['lineid_title'].'<br />'.$order['hdid_show_text'];
				$dv['old_lineid_hdid_show'] = $order['old_lineid_title'].'<br />'.$order['old_hdid_show_text'];
			}
			
			// 填充套餐信息
			if (!empty($fill['new_taocan']) || $fill === true) {
				$conds = appendLogicExp('tc_price_id', '=', $dv['tc_price_id']);
				$taocanFill = is_array($fill['new_taocan']) ? $fill['new_taocan'] : false;
				$dv['taocan'] = BackLineHelp::getTaocanPrice($conds, $taocanFill);
			}
			$ds[$dk] = $dv;
		}
		
		return $dsIsList === false ? $ds[0] : $ds;		
	}
	
	// 缓存审核类型
	public static function cacheReviewType($returntype='key', $force=false) {
		return MyHelp::cacheTypeData('review_types', 'review_type', '', $returntype, $force);
	}
	
	// 缓存审核类型
	public static function cacheCashFuncType($returntype='key', $force=false) {
		return MyHelp::cacheTypeData('cash_func_types', 'cash_function', '', $returntype, $force);
	}
	
	// 缓存审核类型
	public static function cacheCashUseType($returntype='key', $force=false) {
		return MyHelp::cacheTypeData('cash_use_types', 'cash_use', '', $returntype, $force);
	}
	
	// 审核类型键值编号互转
	public static function reviewTypeKey2Value($param, $dataAll=false) {	
		// 缓存审核类型
		if (is_numeric($param)) {
			$typeIdMap = BackReviewHelp::cacheReviewType('id');
			if (empty($typeIdMap) || empty($typeIdMap[$param])) {
				return error(-1, '错误的审核类型源转换');
			}
			$type = $typeIdMap[$param];
			$valCol = 'type_key';
		} else {
			$typeKeyMap = BackReviewHelp::cacheReviewType('key');
			if (empty($typeKeyMap) || empty($typeKeyMap[$param])) {
				return error(-1, '错误的审核类型源转换');
			}
			$type = $typeKeyMap[$param];
			$valCol = 'id';
		}
		return $dataAll === false ? $type[$valCol] : $type;
	}
	
	// 费用功能键值编号互转
	public static function cashFuncKey2Value($param, $dataAll=false) {
		// 缓存费用功能类型
		if (is_numeric($param)) {
			$typeIdMap = BackReviewHelp::cacheCashFuncType('id');
			if (empty($typeIdMap) || empty($typeIdMap[$param])) {
				return error(-1, '错误的费用功能类型源转换');
			}
			$type = $typeIdMap[$param];
			$valCol = 'type_key';
		} else {
			$typeKeyMap = BackReviewHelp::cacheCashFuncType('key');
			if (empty($typeKeyMap) || empty($typeKeyMap[$param])) {
				return error(-1, '错误的费用功能类型源转换');
			}
			$type = $typeKeyMap[$param];
			$valCol = 'id';
		}
		return $dataAll === false ? $type[$valCol] : $type;
	}
	
	// 费用用途键值编号互转
	public static function cashUseKey2Value($param, $dataAll=false) {
		// 缓存费用用途类型
		if (is_numeric($param)) {
			$typeIdMap = BackReviewHelp::cacheCashUseType('id');
			if (empty($typeIdMap) || empty($typeIdMap[$param])) {
				return error(-1, '错误的费用用途类型源转换');
			}
			$type = $typeIdMap[$param];
			$valCol = 'type_key';
		} else {
			$typeKeyMap = BackReviewHelp::cacheCashUseType('key');
			if (empty($typeKeyMap) || empty($typeKeyMap[$param])) {
				return error(-1, '错误的费用用途类型源转换');
			}
			$type = $typeKeyMap[$param];
			$valCol = 'id';
		}
		return $dataAll === false ? $type[$valCol] : $type;
	}
	
	// 写入订单跟踪记录
	public static function writeSupervise($orderId, $reason) {			
		$lineObj = ModelBase::getInstance('lineenertname', 'xz_');
		$line = $lineObj->getOne(appendLogicExp('id', '=', $orderId));
		if (empty($line)) {
			return error(-1, '无法获取订单信息');
		}
		
		$admin = MyHelp::getLoginAccount(true);
		if (is_error($admin) === true) {
			return error(-1, '用户未登陆，请登录后再进行操作');
		}
		$aa['order_id'] = $orderId;
		$aa['admin_id'] = $admin['id'];
		$aa['create_time'] = fmtNowDateTime();
		$aa['reason'] = $reason;		
		
		$superviseObj = ModelBase::getInstance('order_supervise');
		$superviseCols = $superviseObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$saveData = coll_elements_giveup($superviseCols, $aa);
		$result = $superviseObj->create($saveData);
		if (error_ok($result) === false) {
			return $result;
		}
		
		$aa['id'] = $superviseObj->getLastInsID();
		$aa['admin_id_account'] = $admin['account'];
		return $aa;
	}
}

?>