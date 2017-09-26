<?php

namespace Back\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackOrderHelp;
use Core\Model\BackReviewHelp;
use Core\Model\BackExtraCashHelp;
use Core\Model\BackAccountHelp;
use Core\Model\BackLineHelp;

define('PAY_ONLINE_LIST_SHOW_COUNT', 25);

class ReviewController extends BackBaseController {	

	protected function _initialize() {		
		$this->page_title = '审核列表';
		$this->content_title_show = 1;
		$this->menu_active = 'review';
	}
	
	public function _empty() {
		$this->content_title = '审核列表';
		$this->content_des = '这里你可以查看并审核客户的订单';
		$this->_setMenuLinkCurrent('审核列表','review_list');
		$this->_initTemplateInfo();
		$this->display('list');
	}
		
	private function getFindListCDS($sessionKey) {
		session_start();
		$cds = session($sessionKey);        
		
		$cdList = array();
		foreach ($cds as $k=>$v) {
			switch($v['name']){
				case 'user': $cdList['user_name'] = $v['value']; break;
				case 'order_id': $cdList['order_sn_like'] = $v['value']; break;
				case 'contact': $cdList['names'] = $v['value']; break;
				case 'tel': $cdList['mob'] = $v['value']; break;
				case 'cash_use': $cdList['cash_use_id'] = $v['value']; break;
				case 'cash_func': $cdList['cash_func_id'] = $v['value']; break;
				case 'review_type': $cdList['review_type_id'] = $v['value']; break;
				case 'admin_acct': $cdList['account'] = $v['value']; break;
				case 'date_type': $cdList['date_type'] = $v['value']; break;
				case 'sdate': $cdList['sdate'] = $v['value']; break;
				case 'edate': $cdList['edate'] = $v['value']; break;
				default: break;
			}
		}
		
		MyHelp::filterInvalidConds($cdList);
		return $cdList;
	}
	
	private function getListData($params, &$totalCount, &$output) {
		if (!array_key_exists('cdkey', $params) || !array_key_exists('table', $params) || !array_key_exists('startindex', $params) || !array_key_exists('pagecount', $params)) {
			return error(-1, '参数不齐全，无法查询数据');
		}
		
		$sessionKey = $params['cdkey'];
		$table = $params['table'];
		$perfix = empty($params['perfix'])?'':$params['perfix'];
		$startIndex = $params['startindex'];
		$pageCount = $params['pagecount'];
		
		$orderReviewObj = ModelBase::getInstance($table, $perfix);
		$colNames = $orderReviewObj->getUserDefine(ModelBase::DF_COL_NAMES);
				
		$cds = $this->getFindListCDS($sessionKey);
		// 站点区分
		$admin = MyHelp::getLoginAccount(false);
		if ($admin['account'] != 'admin' && $admin['station_id_data']['key'] != 'main') {
			$cds['station'] = $admin['station_id']; 
		}
		
		// 获取过滤的订单ID
		if (!empty($cds)){
			$orderReviewCDS = coll_elements_giveup($colNames, $cds);
			$conds = MyHelp::getLogicExp($orderReviewCDS, '=', 'AND');
			
			// 订单编号
			if (!empty($cds['order_sn_like'])) {
				$lineCds = appendLogicExp('`xz_lineenertname`.`order_sn`', 'LIKE', '%'.$cds['order_sn_like'].'%', 'AND', $conds);	
			}
			
			// 站点限制
			if (!empty($cds['station'])) {
				$lineCds = appendLogicExp('`xz_lineenertname`.`station_id`', 'LIKE', $cds['station'], 'AND', $conds);	
			}
			
			// 联系人
			if (!empty($cds['names'])) {
				$lineCds = appendLogicExp('`xz_lineenertname`.`names`', 'LIKE', '%'.$cds['names'].'%', 'AND', $conds);
			}
			
			// 联系人电话
			if (!empty($cds['mob'])) {
				$lineCds = appendLogicExp('`xz_lineenertname`.`mob`', 'LIKE', '%'.$cds['mob'].'%', 'AND', $conds);
			}
			
			$output['line_cds'] = $lineCds;
			if (!empty($lineCds)) {
				$lineObj = ModelBase::getInstance('lineenertname', 'xz_');
				$lines = $lineObj->getAll($lineCds);
				if (!empty($lines)) {
					$cdsValues = '(';
					foreach ($lines as $lk=>$lv) {
						if ($cdsValues !== '(') {
							$cdsValues .= ',';
						}
						$cdsValues .= $lv['id'];
					}
					$cdsValues .= ')';
					if ($cdsValues !== '()') {
						$conds = appendLogicExp('order_id', 'IN', $cdsValues, 'AND', $conds);
					}
				}	
			}
			
			// 提交人
			if (!empty($cds['account'])) {
				$adminObj = ModelBase::getInstance('admin');
				$admin = $adminObj->getOne(appendLogicExp('account', '=', $cds['account']));
				if (!empty($admin)) {
					$conds = appendLogicExp('admin_id', '=', $admin['id'], 'AND', $conds);
				}		
			}
			
			// 核审人
			if (!empty($cds['review_account'])) {
				if (empty($adminObj)) {
					$adminObj = ModelBase::getInstance('admin');	
				}
				$admin = $adminObj->getOne(appendLogicExp('account', '=', $cds['review_account']));
				if (!empty($admin)) {
					$conds = appendLogicExp('review_admin_id', '=', $admin['id'], 'AND', $conds);
				}		
			}
			
			// 时间跨度
			if (!empty($cds['sdate'])) {
				$dateCol = $cds['date_type'] === 'request' ? 'create_time' : 'update_time';
				$conds = appendLogicExp($dateCol, '>=', $cds['sdate'].' 00:00:00', 'AND', $conds);
			}
			if (!empty($cds['edate'])) {
				$dateCol = $cds['date_type'] === 'request' ? 'create_time' : 'update_time';
				$conds = appendLogicExp($dateCol, '<=', $cds['edate'].' 23:59:59', 'AND', $conds);
			}
		}		
		
				
		// 审阅类型
		$reviewTypeObj = ModelBase::getInstance('review_type');
		$reviewType = $reviewTypeObj->getOne(appendLogicExp('type_key', '=', 'reviewing'));
		
		$output['conds'] = $conds;
						
		$conds_1 = $conds;
		$totalCount = 0; $count1 = 0; $count2 = 0;
		if (!array_key_exists('review_type_id', $cds)) {
			$conds_1 = appendLogicExp('review_type_id', '=', $reviewType['id'], 'AND', $conds);	
		}
		
		$ds = $orderReviewObj->getAllByCdStr($conds_1, $startIndex, $pageCount, $count1, 'create_time', true);
		if (empty($ds)) {
			$ds = array();
		}
		$sub_count = $pageCount - $count1;
		if ($sub_count > 0 && !array_key_exists('review_type_id', $cds)) {
			$conds_2 = $conds;
			if (!array_key_exists('review_type_id', $cds)) {
				$conds_2 = appendLogicExp('review_type_id', '!=', $reviewType['id'], 'AND', $conds);
			}
			$ds2 = $orderReviewObj->getAllByCdStr($conds_2, $startIndex, $sub_count, $count2, 'update_time', true);
			if (!empty($ds2)) {
				foreach ($ds2 as $dk2=>$dv2) {
					$idx = count($ds);
					$ds[$idx] = $dv2;
				}
			}
		}
		$totalCount = $count1 + $count2;		
		
		// 填充数据		
		if (!empty($ds)){
			// 根据菜单填充不同能容
			$fill = array(
				'admin_submit'=>true,
				'admin_review'=>true,
				'order'=>array('state'=>true, 'line'=>true,'batch'=>true, 'account'=>true),
				'order_state'=>true,
				'review_type'=>true,
			);	
			if ($params['table'] == 'order_review') {
				$fill['cash_func'] = true;
				$fill['cash_use'] = true;
				$fill['pay'] = true;
				$fill['order']['money']=true;
			} else if ($params['table'] == 'order_review_change_count') {
				
			} else if ($params['table'] == 'order_review_change_line') {
				$fill['new_line'] = true;
				$fill['new_batch'] = true;				
			} else if ($params['table'] == 'order_review_exit_member') {
				$fill['exit_member'] = true;				
			} else {
				$data['result'] = error(-1, '请求审核数据的表参数错误');
				$this->ajaxReturn($data);
			}
			// 填充数据
			$ds = BackReviewHelp::fillReviewInfo($ds, $fill);
				
			// 费用审核需要的额外数据
			foreach($ds as $dk=>$dv) {
				if ($params['table'] == 'order_review') { 
					if (!empty($dv['order_id'])) {											
						// 判断是否为第一次付款		
						$dv['first_log'] = false;				
						$firstCDS = appendLogicExp('order_id', '=', $dv['order_id'], 'AND');
						$firstCDS = appendLogicExp('create_time', '<', $dv['create_time'], 'AND', $firstCDS);
						$previewCount = $orderReviewObj->getCount($firstCDS);
						if (intval($previewCount) < 1) {
							$order_sn = BackOrderHelp::getRealOrderSN($dv['order_id_data']['order_sn']);						
							$payLogObj = ModelBase::getInstance('pay_log', 'xz_');
							$firstCDS = appendLogicExp('order_sn', 'LIKE', '%'.$order_sn.'%', 'AND');
							$thisSendTime = date('YmdHis',strtotime($dv['create_time']));
							$firstCDS = appendLogicExp('SendTime', '<', $thisSendTime, 'AND', $firstCDS);
							$previewCount = $payLogObj->getCount($firstCDS);
							if (intval($previewCount) < 1) {
								$payLog2Obj = ModelBase::getInstance('pay_log2', 'xz_');
								$previewCount = $payLog2Obj->getCount($firstCDS);
								if (intval($previewCount) < 1) {
									$dv['first_log'] = true;
								}
							}
						}					
					}				
					
					// 填充付款方式
					$dv['pay'] = '';
					if (!empty($dv['pay_type_id_data'])) {
						$dv['pay'] = $dv['pay_type_id_data']['item_desc'];
					}
					if (!empty($dv['pay_channel_id_data'])) {
						if (!empty($dv['pay'])) {
							$dv['pay'] .= '->';
						}
						$dv['pay'] .= $dv['pay_channel_id_data']['item_desc'];
					}
					if (!empty($dv['pay_bank_id_data'])) {
						if (!empty($dv['pay'])) {
							$dv['pay'] .= '->';
						}
						$dv['pay'] .= $dv['pay_bank_id_data']['item_desc'];
					}
				}
						
				$ds[$dk] = $dv;
			}		
		}		
		return $ds;
	}
	
	// 类型列表	
	protected function typeList($aa) {		
		$params['cdkey'] = 'review_list_cds';
		$params['table'] = 'order_review';		
		$params['startindex'] = $aa['iDisplayStart'];
		$params['pagecount'] = $aa['iDisplayLength'];
		
		$ds = $this->getListData($params, $totalCount, $out);
		if (count($ds) > 0) {
			$colNames = array();
			foreach($ds[0] as $dk=>$dv) {
				array_push($colNames, $dk);
			}
		}
		
		$data['out'] = $out;
		$data['sColumns'] = $colNames;
		$data['sEcho'] = $aa['sEcho'];	
		$data['iDisplayStart'] = $aa['iDisplayStart'];
		$data['iDisplayLength'] = $aa['iDisplayLength'];
		$data['iTotalRecords'] = $totalCount;
		$data['iTotalDisplayRecords'] = $totalCount;
		$data['aaData'] = $ds;
		$data['result'] = error(0,"");
		if (is_error($ds)) {
			$data['result'] = $ds;
		}
		$this->ajaxReturn($data);		
	}
	
	// 显示订单列表
	private function showListPage() {	
		// 设置菜单		
		$this->page_title ='审核列表';
		$this->content_title = '审核列表';
		$this->content_des = '这里你可以审核的请求订单';
		$this->_setMenuLinkCurrent($contentTitle,'review_list');
		$this->_initTemplateInfo();	
		
		// 订单来源
		$orderFromObj = ModelBase::getInstance('order_from');
		$orderFroms = $orderFromObj->getAll();
		if (!empty($orderFroms)) {
			$this->assign('OrderFrom', $orderFroms);
		}
		
		// 费用用途
		$cashUseObj = ModelBase::getInstance('cash_use');
		$cashUses = $cashUseObj->getAll();
		if (!empty($cashUses)) {
			$this->assign('CashUse', $cashUses);
		}
		
		// 费用功能
		$cashFuncObj = ModelBase::getInstance('cash_function');
		$cashFunc = $cashFuncObj->getAll();
		if (!empty($cashFunc)) {
			$this->assign('CashFunc', $cashFunc);
		}
	
		// 审阅类型
		$reviewTypeObj = ModelBase::getInstance('review_type');
		$reviewTypes = $reviewTypeObj->getAll();
		if (!empty($reviewTypes)) {
			$this->assign('ReviewType', $reviewTypes);
		}
		
		$this->assign('grant_review', check_grant('response_finance_review'));
		$this->assign('ajaxReqUrl', U('review/list'));
		$this->display();	
	}
	
	// 订单列表
	public function listAction() {		
		if (IS_POST) {	
			$type = I('post.op_type', false);
			if ($type == 'list') {
				$this->typeList($_POST);
			} else if ($type == 'cddata'){
				$cds = I('post.cds', false);
				if (!empty($cds)) {
					session_start();
					session('review_list_cds', $cds);	
				}
			} else{
				$data['result'] = error(-1, '未知的类型动作请求');
				$this->ajaxReturn($data);
			}			
		} else {				
			$this->showListPage();
		}
	}
		
	private function showInfoPage() {
		$reviewId = I('get.rid', false);
						
		// 设置菜单		
		$this->page_title = empty($reviewId) ? '填写审核' : '审批详细';
		$this->content_title = empty($reviewId) ? '审核填写' : '审批详细';
		$this->content_des = '这里你可以查看完善并提交订单的审核详细内容';
		$this->_setMenuLinkCurrent('订单详细',empty($reviewId) ? 'review_request' : 'review_list');
		$this->_initTemplateInfo();	
		
		// 订单状态
		$orderStates = BackOrderHelp::getOrderStateList('order');
		$this->assign('OrderState', $orderStates);
		
		// 费用用途
		$cashUseObj = ModelBase::getInstance('cash_use');
		$cashUses = $cashUseObj->getAll();
		$this->assign('CashUse', $cashUses);
		
		// 费用功能
		$cashFuncObj = ModelBase::getInstance('cash_function');
		$cashFunc = $cashFuncObj->getAll();
		$this->assign('CashFunc', $cashFunc);
	
		// 审阅类型
		$reviewTypeObj = ModelBase::getInstance('review_type');
		$reviewTypes = $reviewTypeObj->getAll();
		$this->assign('ReviewType', $reviewTypes);
		
		// 获取根菜单
		$menuItems = MyHelp::getMenuList('pay_menu',0);
		$this->assign('MenuItem', $menuItems);
				
		$orderId = I('get.oid', false);		
		// 编辑详细		
		if ($reviewId !== false) {
			$orderReviewObj = ModelBase::getInstance('order_review');
			$orderReview = $orderReviewObj->getOne(appendLogicExp('id', '=', $reviewId));				
				
			if (!empty($orderReview)) {
				$fill = array(
					'admin_submit'=>true,
					'admin_review'=>true,
//					'order'=>array('state'=>true, 'money'=>true, 'line'=>true,'batch'=>true, 'account'=>true),
					'order_state'=>true,
					'cash_func'=>true,
					'cash_use'=>true,
					'pay'=>true,
					'review_type'=>true,
				);
				$orderReview = BackReviewHelp::fillReviewInfo($orderReview, $fill);
				$order = $orderReview['order_id_data'];				
				$this->assign('review', $orderReview);	
				
				if (empty($orderId)) {
					$orderId = $orderReview['order_id'];
				}
			}		
		}
		
		if (!empty($orderId)) {
			if (empty($order)) {
				$order = BackOrderHelp::getOrderInfo($orderId);						
				if (!empty($order)) {
					// 填充order
					$fill = array('state'=>true, 'money'=>true, 'line'=>true,'batch'=>true, 'account'=>true);
					$order = BackOrderHelp::fillNewOrderInfo($order, $fill);	
				}		
			}		
			$this->assign('order', $order);	
		}
		
		$this->assign('grant_submit_review', check_grant('submit_finance_review'));
		$this->assign('grant_response_review', check_grant('response_finance_review'));
				
		$complate = I('cp', false);
		if (!empty($complate)) {
			$this->assign('review_complate', $complate);
		}
		$this->display(empty($reviewId)? 'request':'info');
	}
		
	// 生成审核
	private function createReview($aa) {
		if (check_grant('submit_finance_review') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
														
		$orderReviewObj = ModelBase::getInstance('order_review');
		$colNames = $orderReviewObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNames, $aa);		
		
		// 检测订单是否已经被锁定
		$lockResult = BackOrderHelp::checkOrderLock($aa['order_id']);
		if (error_ok($lockResult) === false) {
			$data['result'] = $lockResult;
			$this->ajaxReturn($data);
		}
		
		// 原始订单状态
		$order = BackOrderHelp::getOrderInfo($aa['order_id']);
		if (is_error($order)) {
			$data['result'] = $order;
			return $this->ajaxReturn($data);
		}
		$ds['order_state_id'] = $order['zhuangtai'];
		
		// 一键创建并通过审核（flag=pass）或者普通（flag=create）
		$ds['flag'] = $aa['flag'];
		
		$refundFuncId = BackReviewHelp::cashFuncKey2Value('refund');
		if (is_error($refundFuncId)) {
			$data['result'] = error(-2, '获取退款费用功能编号失败');
			return $this->ajaxReturn($data);
		}
					
		// 额外费用对象
		$extraCashObj = ModelBase::getInstance('order_extra_cash');
		// 生成订单审核记录并绑定额外费用
		foreach ($aa['cash_datas'] as $cdk=>$cdv) {		
			if (floatval($cdv['cash']) > 0) {	
				$ds['cash'] = $cdv['cash'];			
				
//				$extraCashId = $cdv['cash_use_id'];	// 此时cash_use_id是额外费用		
//				$result = BackExtraCashHelp::getExtraCash($extraCashId);
//				if (is_error($result)) {
//					$data['result'] = error(-4, $data['result']['message'].'||'.$result['message']);
//					continue;
//				}
//				$extraCash = $result;
//							
//				$reviewId = BackReviewHelp::commitOrderReview($ds, $cdv['cash'], $ds['cash_func_id'], $extraCash['cash_use_id'], $ds, $ds['request_reason'], $extraCashId);	
				$reviewId = BackReviewHelp::commitOrderReview($ds, $cdv['cash'], $ds['cash_func_id'], $cdv['cash_use_id'], $ds, $ds['request_reason'], 0);	
				if (is_error($reviewId) && error_ok($reviewId) === false) {
					$data['result'] = error(-5, $data['result']['message'].'||'.$reviewId['message']);
				} else {
					// 绑定额外费用
//					$bindReviewIdCol = $refundFuncId === $ds['cash_func_id'] ? 'review_refund_id' : 'review_pay_id';
//					$bindExtraCashIds = array_push($bindExtraCashIds,array('id'=>$extraCashId, 'colName'=>$bindReviewIdCol, 'reviewId'=>$reviewId));
//					$result = $extraCashObj->modify(array($bindReviewIdCol=>$reviewId), appendLogicExp('id', '=', $extraCashId));
//					if (error_ok($result) === false) {
//						$data['result'] = error(-6, $data['result']['message'].'||'.$result['message']);
//					}
					
					// 记录改动数据的编号
					$delReviewCds = appendLogicExp('id', '=', $reviewId, 'OR', $delReviewCds);
					$changeState = true;
				}
			}
		}
						
		if (empty($data['result'])) {
			// 修改订单状态
			$result = BackOrderHelp::setOrderStateBySystem($aa['order_id']);
			if (is_error($result) === false && $result['errno'] !== 1) {
				$data['result'] = error(-7, $data['result']['message'].'||'.$result['message']);
			}
			$data['result'] = error(0, '提交审核成功');
		} else {			
			// 还原添加的审核记录
			if (!empty($delReviewCds)) {
				$result = $orderReviewObj->remove($delReviewCds);
				if (error_ok($result) === false){
					$data['result'] = error(-8, $data['result']['message'].'||提交审核失败时回滚审核记录失败'.$result['message']);
				}	
			}
			// 还原绑定的额外费用
//			if (!empty($bindExtraCashIds)) {
//				foreach ($bindExtraCashIds as $key=>$val) {
//					$result = $extraCashObj->modify(array($val['colName']=>''), appendLogicExp('id', '=', $val['id']));
//					if (error_ok($result) === false){
//						$data['result'] = error(-9, $data['result']['message'].'||提交审核失败时回滚额外费用绑定失败'.$result['message']);
//					}
//				}	
//			}
		}
		return $this->ajaxReturn($data);		
	}
	
	// 审核引起状态改变写入客服记录
	private function saveCustomerSupervise($orderReview) {		
		$order = BackOrderHelp::getOrderInfo($orderReview['order_id']);
		if (is_error($order)) {
			return $order;
		}
		
		// 状态未改变不写入记录
		if ($order['zhuangtai'] === $orderReview['order_state_id']) {
			return false;
		}
		
		// 写入订单状态改变记录	
		$admin = MyHelp::getLoginAccount(true);
		$log = $admin['type_id_type_desc'].$admin['account'];

		// 请求审核管理员
		if ($admin['id'] === $orderReview['admin_id']){
			$log .= '通过了'.$admin['type_id_type_desc'].$admin['account'];
		} else {
			$adminObj = ModelBase::getInstance('admin');
			$requestAdmin = $adminObj->getOne(appendLogicExp('id', '=', $orderReview['admin_id']));
			if ($requestAdmin) {
				$log .= '通过了';
				$adminTypeObj = ModelBase::getInstance('admin_type');
				$adminType = $adminTypeObj->getOne(appendLogicExp('id', '=', $requestAdmin['type_id']));
				if ($adminType) {
					$log .= $adminType['type_desc'];
				}
				$log .= $requestAdmin['account'];
			}
		}
		// 费用功能
		$cashFuncObj = ModelBase::getInstance('cash_function');
		$cashFunc = $cashFuncObj->getAll();
		foreach ($cashFunc as $cfk=>$cfv) {
			if ($cfv['id'] == $orderReview['cash_func_id']) {
				$log .= $cfv['type_desc'];
				break;
			}
		}
						
		// 费用用途
		$cashUseObj = ModelBase::getInstance('cash_use');
		$cashUses = $cashUseObj->getAll();
		foreach ($cashUses as $cuk=>$cuv) {
			if ($cuv['id'] == $orderReview['cash_use_id']) {
				$log .= $cuv['type_desc'];
				break;
			}
		}

		$log .= '的请求';

		// 订单状态
		$old_state = ''; $new_state = '';
		$orderStateObj = ModelBase::getInstance('order_state');
		$orderStates = $orderStateObj->getAll();
		foreach ($orderStates as $osk=>$osv) {
			if ($osv['id'] == $orderReview['order_state_id']) {
				$old_state = $osv['type_desc'];
			}
			if ($osv['id'] == $order['zhuangtai']) {
				$new_state = $osv['type_desc'];
			}
		}
		$log .= '，将订单状态从'.$old_state.'变为'.$new_state;
		// 写入记录
		$superviseObj = ModelBase::getInstance('order_supervise');
		$supervise['order_id'] = $order['id'];
		$supervise['admin_id'] = $admin['id'];
		$supervise['create_time'] = fmtNowDateTime();
		$supervise['reason'] = $log;
		$result = $superviseObj->create($supervise, $superviseId);
		if (error_ok($result) === false) {
			return $result;
		}
		return $superviseId;
	}
	
	// 更新审核信息
	private function updateReview($aa) {
		if (check_grant('response_finance_review') === false) {
			$data['result'] = error(-1, '1.您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		if (empty($aa['id']) || empty($aa['review'])) {
			$data['result'] = error(-2, '2.数据非法，更新订单审核失败');
			return $this->ajaxReturn($data);
		}
		$orderReviewObj = ModelBase::getInstance('order_review');
		$conds = appendLogicExp('id', '=', $aa['id']);
		$orderReview = $orderReviewObj->getOne($conds);
		if (empty($orderReview)) {
			$data['result'] = error(-3, '3.参数错误，未能根据参数找到审核信息，审核失败');
			return $data;
		}	
							
		// 检测订单是否已经被锁定
		$lockResult = BackOrderHelp::checkOrderLock($orderReview['order_id']);
		if (error_ok($lockResult) === false) {
			$data['result'] = $lockResult;
			$this->ajaxReturn($data);
		}
		$orderId = $orderReview['order_id'];
		
		$reviewResult = stripos($aa['review'], 'pass') !== false ? 'review_pass' : 'review_fail';
		$data['result'] = BackReviewHelp::setReviewTypeByKey($aa['id'], $reviewResult, $aa['reason']);				
		if (error_ok($data['result'])) {
			// 刷新订单状态，没有后续审核有可能将订单恢复为支付中/退款中之前的原有状态
//			$stateKey = BackOrderHelp::OrderStateKey2Value($orderReview['order_state_id']);
			$result = BackOrderHelp::setOrderStateBySystem($orderId, '', $output);
//			$data['output'] = $output;				
			
			// 存在错误，回滚审核记录
			if (is_error($result)) {
				if ($result['errno'] !== 0 && $result['errno'] !== 1) {
					$data['result'] = error(-4, '4.'.$data['result']['message'].'||'.$result['message']);
					// 回退审核
					$backReviewData['review_admin_id'] = null;		
					$backReviewData['response_reason'] = '';
					$backReviewData['update_time'] = $orderReview['create_time'];
					$backReviewData['review_type_id'] = $orderReview['review_type_id'];
					$backReviewCDS = $conds;
				}
			}
			// 写入客服记录
			$result = $this->saveCustomerSupervise($orderReview);	
			if (is_error($result) && error_ok($result) == false) {
				$data['result'] = error(-5, '5.'.$data['result']['message'].'||'.$result['message']);
			} else {
				$superviseId = $result;
			}
			
//			$refundFuncId = BackReviewHelp::cashFuncKey2Value('refund');
//			$invalid = $refundFuncId === $orderReview['cash_func_id'] ? ($reviewResult === 'review_pass' ? 1 : 0) : 0;
//			// 不存在绑定额外费用创建额外费用
//			if (empty($orderReview['extra_cash_id'])) {
//				$backReviewData['extra_cash_id'] = 0;
//				
//				$review_pay_id = $refundFuncId === $orderReview['cash_func_id'] ? 0 : $orderReview['id'];
//				$review_refund_id = $refundFuncId === $orderReview['cash_func_id'] ? $orderReview['id'] : 0;
//				$result = BackExtraCashHelp::appendExtraCash($cdv['order_id'], $cdv['cash_use_id'], $cdv['cash'], $review_pay_id, $review_refund_id, $invalid, '创建订单审核时添加');
//				if (is_error($result)) {
//					$data['result'] = error(-6, '6.'.$data['result']['message'].'||'.$result['message']);
//				}
//				$extraCashId = $result;
//				$result = $orderReviewObj->modify(array('extra_cash_id'=>$extraCashId), appendLogicExp('id', '=', $orderReview['id']));
//				if (is_error($result) && $result['errno'] !== 0 &&  $result['errno'] !== -4) {
//					$data['result'] = error(-7, '7.'.$data['result']['message'].'||'.$result['message']);
//				}
//			} else {
//				$extraCashId = $orderReview['extra_cash_id'];
//				if ($refundFuncId === $orderReview['cash_func_id']) {
//					$saveData['review_refund_id'] = $review_refund_id;
//					$backExtraData['review_refund_id'] = 0;
//				} else {
//					$saveData['review_pay_id'] = $review_pay_id;
//					$backExtraData['review_pay_id'] = 0;	
//				}
//				$saveData['invalid'] = $invalid;
//				$backExtraData['invalid'] = 0;	
//				$result = BackExtraCashHelp::modifyExtraCash($extraCashId,$saveData);
//				if (is_error($result) && $result['errno'] !== 0 &&  $result['errno'] !== -4) {
//					$data['result'] = error(-8, '8.'.$data['result']['message'].'||'.$result['message']);
//				}
//			}
		}
		
		if (error_ok($data['result']) === false) {
			// 回滚审核记录
			if (!empty($backReviewCDS) && !empty($backReviewData)) {				
				$result = $orderReviewObj->modify($backReviewData, $backReviewCDS);
				if (error_ok($result) === false) {
					$data['result'] = error(-9, '9..审核失败，回滚审核记录失败'.$data['result']['message'].'||'.$result['message']);
				}
			}
			// 回滚订单跟踪
			if (!empty($superviseId)) {
				$superviseObj = ModelBase::getInstance('order_supervise');
				$result = $superviseObj->remove(appendLogicExp('id', '=', $superviseId));
				if (error_ok($result) === false) {
					$data['result'] = error(-10, '10.审核失败，回滚订单跟踪失败'.$data['result']['message'].'||'.$result['message']);
				}
			}
			
//			// 回滚额外费用处理
//			if (!empty($extraCashId)) {
//				$extraCashObj = ModelBase::getInstance('order_extra_cash');
//				if (!empty($backExtraData)) {
//					$result = $extraCashObj->modify($backExtraData, appendLogicExp('id', '=', $extraCashId));
//					if (error_ok($result) === false) {
//						$data['result'] = error(-11, '11.审核失败，回滚额外费用失败'.$data['result']['message'].'||'.$result['message']);
//					}
//				} else {
//					$result = $extraCashObj->remove(appendLogicExp('id', '=', $extraCashId));
//					if (error_ok($result) === false) {
//						$data['result'] = error(-12, '12.审核失败，回滚额外费用失败'.$data['result']['message'].'||'.$result['message']);
//					}
//				}
//			}			
		} else {
			$data['result'] = error(0, '审核订单成功');
		}
		return $this->ajaxReturn($data);				
	}
	
	// 更新审核信息
	private function updateOrderState($aa) {		
		if (!array_key_exists('id', $aa) || !array_key_exists('state', $aa)) {
			$data['result'] = error(-1, '数据非法，更新订单失败');
			return $this->ajaxReturn($data);
		}
		
		$orderId = $aa['id'];
		$state_key = $aa['state'];	
		
		$manualState = false;
		if ($state_key == 'review') {
			if (check_grant('review_improve_order') === false) {
				$data['result'] = error(-2, '您没有次操作权限，请获得此权限后再进行此操作');
				return $this->ajaxReturn($data);
			}
			$manualState = true;
		} else if ($state_key == 'unjoin') {
			if (check_grant('order_alternate') === false) {
				$data['result'] = error(-2, '您没有次操作权限，请获得此权限后再进行此操作');
				return $this->ajaxReturn($data);
			}	
			$manualState = true;		
		} else if ($state_key == 'cancel_scheduling') {
			if (check_grant('order_cancel_scheduling') === false) {
				$data['result'] = error(-2, '您没有次操作权限，请获得此权限后再进行此操作');
				return $this->ajaxReturn($data);
			}			
			$manualState = true;	
		} else if ($state_key == 'canceled') {
			if (check_grant('review_improve_order') === false) {
				$data['result'] = error(-2, '您没有次操作权限，请获得此权限后再进行此操作');
				return $this->ajaxReturn($data);
			}			
			$manualState = true;	
		}
		
		if ($manualState === true) {
			$pay = BackOrderHelp::getOrderPays($orderId);
			$payCount = count($pay['online']) + count($pay['offline']);
			if ($payCount > 0) {
				$data['result'] = error(-3, '存在付款记录的情况下不允许对订单进行此操作!!!');
				return $this->ajaxReturn($data);
			}
		}
		
		$data['result'] = BackOrderHelp::setOrderStateByKey($aa['id'], $state_key);	
		if ($state_key == 'review') {
			$result = BackOrderHelp::setOrderStateBySystem($aa['id'], 'review', $out);
		}
					
		return $this->ajaxReturn($data);
	}	
	
	// 生成订单申请页面请求处理
	public function requestAction() {
		if (IS_POST) {
			$aa = $_POST;
			$op = I('post.op', false);
			if ($op === 'review_request') {
				$this->createReview($aa);
			} else if ($op === 'review_response') {
				$this->updateReview($aa);
			} else if ($op === 'order_state') {
				$this->updateOrderState($aa);
			} else {
				$data['result'] = error(-1, '未知操作');
				return $this->ajaxReturn($data);
			}
		} else {			
			$op = I('get.op', false);
			if ($op === 'review_request') {
				$orderId = I('get.id', 0);
				$data['jumpUrl'] = U('review/request', 'oid='.$orderId);				
				$this->ajaxReturn($data);	
			} else if ($op === 'review_response') {
				$reviewId = I('get.id', 0);
				$complate = I('get.complate', 0);
				$data['jumpUrl'] = U('review/request', 'rid='.$reviewId.'&cp='.$complate);
				$this->ajaxReturn($data);	
			} else {
				$this->showInfoPage();	
			}
		}
	}
	
	// 请求未审核
	public function getWaitReviewAction() {
		if (IS_POST) {
			$reviewingId = BackReviewHelp::reviewTypeKey2Value('reviewing');
			if (is_error($reviewingId)) {
				$data['result'] = error(-1, '获取审核数量错误', $reviewingId);
				return  $this->ajaxReturn($data);
			}
			
			$data['result'] = error(0, '');
			// 财务审核
			$orderReviewObj = ModelBase::getInstance('order_review');	
			$data['review_account'] = $orderReviewObj->getCount(appendLogicExp('review_type_id', '=', $reviewingId));
			
			// 改团审核
			$changeLineObj = ModelBase::getInstance('order_review_change_line');	
			$data['change_line'] = $changeLineObj->getCount(appendLogicExp('review_type_id', '=', $reviewingId));
			
			// 参团人数审核
			$changeCountObj = ModelBase::getInstance('order_review_change_count');	
			$data['member_count'] = $changeCountObj->getCount(appendLogicExp('review_type_id', '=', $reviewingId));
			
			// 退团审核
			$exitMemberObj = ModelBase::getInstance('order_review_exit_member');	
			$data['exit_team'] = $exitMemberObj->getCount(appendLogicExp('review_type_id', '=', $reviewingId));
			
			// 总审核数量
			$data['review_sum'] = intval($data['review_account']) + intval($data['change_line']) + intval($data['member_count']) + intval($data['exit_team']);
			
		} else {
			$data['result'] = error(-1, '位置请求动作');
		}
		return $this->ajaxReturn($data);
	}
	
	// 显示在线付款信息
	private function typeOnlineList($requestType) {
		$admin = MyHelp::getLoginAccount(false);
		if ($requestType == 'get') {
			if (is_error($admin) === true) {
				redirect(UNLOGIN_URL);	
				return false;
			}
			
			$pageIndex = I('get.page', 0);
		} else {			
			$cdsstr = I('post.cds', '');
			$pageIndex = I('post.page', 0);
			
			if (is_error($admin) === true) {
				$data['jumpUrl'] = UNLOGIN_URL;
				return $this->ajaxReturn($data);
			}
		}
		
			
		$payLogObj = ModelBase::getInstance('pay_log', 'xz_');
		if (!empty($cdsstr)) {
			$cdList = explode('|', $cdsstr);
			for ($i=0; $i<count($cdList); $i+=2) {
				$condList[$cdList[$i]] = $cdList[$i+1];
			}				
			MyHelp::filterInvalidConds($condList);			
			foreach ($condList as $ck=>$cv) {
				if ($ck == 'date_type' || $ck == 'date') {
					continue;
				}
				$conds = appendLogicExp('`q2`.`'.$ck.'`', 'LIKE', '%'.$cv.'%', 'AND', $conds);
			}
			
			if (!empty($condList['date_type']) && !empty($condList['date'])) {
				$dt = explode(' / ', $condList['date']);
				if (count($dt) == 2) {
					$dateCol = $condList['date_type'] === 'request' ? 'SendTime' : 'datetime';
					$st = $cds['date_type'] === 'request'? (implode('',explode('-'.$dt[0])).'000000') : (strtotime($dt[0].' 00:00:00'));
					$et = $cds['date_type'] === 'request'? (implode('',explode('-'.$dt[0])).'235959') : (strtotime($dt[0].' 23:59:59'));
					$conds = appendLogicExp('`q1`.`'.$dateCol.'`', '>=', $st, 'AND', $conds);				
					$conds = appendLogicExp('`q1`.`'.$dateCol.'`', '<=', $et, 'AND', $conds);
				}
			}
			
		}
		
		// 站点筛选
		if ($admin['station_id_data']['key'] != 'main') {
			$conds = appendLogicExp('`q2`.`station_id`', '=', $admin['station_id'], 'AND', $conds);
		}
		
		$startIndex = $pageIndex * PAY_ONLINE_LIST_SHOW_COUNT;
		
		
		$params['table'] = '`xz_pay_log` AS `q1`';
		$params['col'] = array(
			'`q1`.`id`'=>'`q1_id`',
			'`q1`.`datetime`'=>'`q1_datetime`',
			'`q1`.`SendTime`'=>'`q1_SendTime`',
			'`q1`.`order_sn`'=>'`q1_order_sn`',
			'`q1`.`TransAmount`'=>'`q1_TransAmount`',
			'`q1`.`InstCode`'=>'`q1_InstCode`',
			'`q1`.`PayChannel`'=>'`q1_PayChannel`',
			'`q1`.`TransNo`'=>'`q1_TransNo`',
			'`q2`.`id`'=>'`q2_id`',
			'`q2`.`lineid`'=>'`q2_lineid`',
			'`q2`.`hdid`'=>'`q2_hdid`',
			'`q2`.`userid`'=>'`q2_userid`',
			'`q2`.`book_account_type`'=>'`q2_book_account_type`',
			'`q2`.`names`'=>'`q2_names`',
			'`q2`.`mob`'=>'`q2_mob`',
			'`q2`.`zhuangtai`'=>'`q2_zhuangtai`',
			'`q2`.`order_sn`'=>'`q2_order_sn`',
			'`q2`.`new_order`'=>'`q2_new_order`',
			'`q2`.`new_line`'=>'`q2_new_line`',
			'`q2`.`team_price`'=>'`q2_team_price`',
			'`q2`.`team_cut_price`'=>'`q2_team_cut_price`',
			'`q2`.`need_pay_money`'=>'`q2_need_pay_money`',
		);
		$params['join'] = array('LEFT JOIN `xz_lineenertname` AS `q2` ON `q1`.`order_id` = `q2`.`id`');		
		$params['conds'] = $conds;
		$params['sort'] = array('`q1`.`SendTime`'=>'desc');
		$params['limit'] = array($startIndex, PAY_ONLINE_LIST_SHOW_COUNT);
		$ds = $payLogObj->queryData($params, $total);
		$data['sql'] = $payLogObj->getLastSql();
		
		$data['page_index'] = $pageIndex;
		$data['page_size'] = PAY_ONLINE_LIST_SHOW_COUNT;
		$data['page_count'] = intval($total / PAY_ONLINE_LIST_SHOW_COUNT) + (intval($total % PAY_ONLINE_LIST_SHOW_COUNT) > 0 ? 1 : 0);
				
		// 填充数据		
		if (!is_error($ds)){					
			// 填充数据			
			foreach($ds as $dk=>$dv) {				
				// 填充订单
				$order = BackOrderHelp::getOrderInfo($dv['q2_id']);
				$order = BackOrderHelp::fillNewOrderInfo($order, array('line'=>true, 'batch'=>true));				
				if (!empty($order)) {
					$dv['q2_lineid_hdid_show'] = $order['lineid_hdid_show'];
							
					// 判断是否为第一次付款		
					$dv['q1_first_log'] = false;				
					$thisSendTime = date('Y-m-d H:i:s',strtotime($dv['q1_SendTime']));
					$firstCDS = appendLogicExp('create_time', '<', $thisSendTime, 'AND');
					$firstCDS = appendLogicExp('order_id', '=', $order['id'], 'AND', $firstCDS);
					$orderReviewObj = ModelBase::getInstance('order_review');
					$previewCount = $orderReviewObj->getCount($firstCDS);
					if (intval($previewCount) < 1) {						
						$firstCDS = appendLogicExp('order_sn', 'LIKE', '%'.$dv['q2_order_sn'].'%', 'AND');
						$firstCDS = appendLogicExp('SendTime', '<', $dv['q1_SendTime'], 'AND', $firstCDS);
						$previewCount = $payLogObj->getCount($firstCDS);
						if (intval($previewCount) < 1) {
							$dv['q1_first_log'] = true;
						}
					}
				}
				
				
				// 填充费用功能
				$dv['q1_PayChannel_data'] = MyHelp::MenuItemKey2Value('pay_menu',$dv['q1_PayChannel'], true);
				$t = $dv['q1_SendTime'];
				$dv['q1_SendTime_show_text'] = substr($t,0,4).'-'.substr($t,4,2).'-'.substr($t,6,2).' '.substr($t,8,2).':'.substr($t,10,2).':'.substr($t,12,2);
				$dv['q1_datetime_show_text'] = date('Y-m-d H:i:s', $dv['q1_datetime']);					
				$ds[$dk] = $dv;
			}		
		}
		
		$data['result'] = error(0, '');
		$data['ds'] = $ds;
		$this->ajaxReturn($data);	
	}
	
	// 在线付款列表
	public function payonlineAction() {
		if (IS_POST) {
			$aa = $_POST;
			if (isset($aa['op_type'])) {
				$opType = $aa['op_type'];
				if ($opType == 'list') {
					$this->typeOnlineList($aa);
				} else{
					$data['result'] = error(-1, '未知的类型动作请求');
					$this->ajaxReturn($data);
				}
			} else {
				$data['result'] = error(-1, '获取类型动作失败');
				$this->ajaxReturn($data);
			}
		} else {			
			$this->showPage('online', 'pay_log_online', 'review', '线上付款', '线上付款', '这里你可以查看线上的付款记录');
		}
	}
	
	// 显示审核详细
	private function showReviewInfo($table, $reviewId, $page, $complate) {
		// 根据菜单填充不同能容
		$fill = array(
			'admin_submit'=>true,
			'admin_review'=>true,
			'order'=>array('state'=>true, 'line'=>true, 'batch'=>true, 'taocan'=>array('taocan'=>true), 'account'=>true),
			'order_state'=>true,
			'review_type'=>true,
		);	
		// 设置菜单				
		if ($page === 'count-info') {
			$this->page_title = '人数审批';
			$this->content_title = '人数审批';
			$this->content_des = '这里你可以查看修改可参团人数的请求或审批情况';
			$this->_setMenuLinkCurrent('修改人数', 'change_count');
		} else if ($page === 'line-info') {
			$fill['new_line'] = true;
			$fill['new_batch'] = true;
			$fill['new_taocan'] = array('taocan'=>true);
			$this->page_title = '改团审批';
			$this->content_title = '改团审批';
			$this->content_des = '这里你可以查看修改改团的请求或审批情况';
			$this->_setMenuLinkCurrent('改团审批', 'change_line');
		} else if ($page === 'exit-info') {
			$fill['exit_member'] = true;
			$this->page_title = '退团审批';
			$this->content_title = '退团审批';
			$this->content_des = '这里你可以查看修改退团的请求或审批情况';
			$this->_setMenuLinkCurrent('退团审批', 'exit_team');
		}
		$this->_initTemplateInfo();	
				
		$reviewObj = ModelBase::getInstance($table);
		$review = $reviewObj->getOne(appendLogicExp('id', '=', $reviewId));
		if (empty($review)) {			
			$errPageData = errorPage('500', '错误', '参数错误', '找不到审核信息');
			$this->assign('err', $errPageData);
			$this->display('index/error');
		}
		
		if ($page === 'exit-info') {
			$order = BackOrderHelp::getOrderInfo($review['order_id']);
			if (empty($order)) {
				$result = error(-1, '未能转换参团人到新表，订单信息有误。Error:'.$order['message']);
			} else {
				$result = BackOrderHelp::memberTableChangeOld2New($order,$memberIds,$exitRS);
				$this->assign('exit_member_result', $exitRS);
				if (error_ok($result) === true) {
					$review = $reviewObj->getOne(appendLogicExp('id', '=', $reviewId));
				}
			}
			$this->assign('change_member_result', $result);
		}				
		$review = BackReviewHelp::fillReviewInfo($review, $fill);
		
		$this->assign('review', $review);
		if ($complate == 1) {
			$this->assign('review_complate', $complate);
		}
		return $this->display($page);
	}
	
	// 显示修改人数审核列表
	private function typeChangeCountList($aa) {		
		$params['cdkey'] = 'change_count_list_cds';
		$params['table'] = 'order_review_change_count';		
		$params['startindex'] = $aa['iDisplayStart'];
		$params['pagecount'] = $aa['iDisplayLength'];
		
		$ds = $this->getListData($params, $totalCount);
		
		$data['sColumns'] = $colNames;
		$data['sEcho'] = $aa['sEcho'];	
		$data['iDisplayStart'] = $aa['iDisplayStart'];
		$data['iDisplayLength'] = $aa['iDisplayLength'];
		$data['iTotalRecords'] = $totalCount;
		$data['iTotalDisplayRecords'] = $totalCount;
		$data['aaData'] = $ds;		
		$data['result'] = error(0,"");
		if (is_error($ds)) {
			$data['result'] = $ds;
		}
		$this->ajaxReturn($data);		
	}
	
	// 创建修改人数信息审核
	private function createOrderReviewForCount($aa) {
		if (!array_key_exists('order_id', $aa)) {
			$data = error(-1, '参数信息有误,创建订单审核信息失败');
			return $this->ajaxReturn($data);
		}
		
		// 检测该状态是否可改变人数
		$result = BackOrderHelp::checkOrderOperate('change_count', $aa['order_id']);
		if ($result[operate] !== true) {
			if (error_ok($result['operate']) === false) {
				$data['result'] = $result['operate'];
				return $this->ajaxReturn($data);
			}
		}
							
		// 检测订单是否已经被锁定
		$lockResult = BackOrderHelp::checkOrderLock($aa['order_id']);
		if (error_ok($lockResult) === false) {
			$data['result'] = $lockResult;
			$this->ajaxReturn($data);
		}
		
		// 获取订单信息
		$order = BackOrderHelp::getOrderInfo($aa['order_id']);
		if (empty($order)) {
			$data['result'] = error(-1, '未能根据订单编号获取到订单信息');
			return $this->ajaxReturn($data);
		}
		
		$manCount = 0;
		$womanCount = 0;
		$childCount = 0;
		
		// 计算真实参团人数
		$members = BackOrderHelp::getOrderMembers($order['id'],appendLogicExp('exit','=',0));
		foreach ($members as $mk=>$mv) {
			$memberTypeKey = $mv['type_id_data']['type_key'];
			if (stripos($memberTypeKey, 'child') !== false) {
				$childCount ++;
			} else if (stripos($memberTypeKey, 'woman') !== false) {
				$womanCount ++;
			} else {
				$manCount ++;
			}
 		}
		
		$data['real_type_key'] = $realTypeKey;
		$data['real_man'] = $manCount;
		$data['real_woman'] = $womanCount;
		$data['real_child'] = $childCount; 
				
		
		$saveData['male'] = $order['male'];
		$saveData['woman'] = $order['woman'];
		$saveData['child'] = $order['child'];	
		
		if (array_key_exists('type', $aa)) {
			foreach ($aa['type'] as $tck=>$tcv) {
				if ($tcv['name'] === 'adult_man') {
					$saveData['male'] = $tcv['value'];
				} else if ($tcv['name'] === 'adult_woman') {
					$saveData['woman'] = $tcv['value'];
				} else if ($tcv['name'] === 'child') {
					$saveData['child'] = $tcv['value'];
				}
			}		
		}
		
		if (intval($saveData['male']) < $manCount || intval($saveData['woman']) < $womanCount || intval($saveData['child']) < $childCount) {
			$data['result'] = error(-1, '修改的参团人员类型数量小于现有的参团人员类型数量');
			return $this->ajaxReturn($data);
		}
				
		$data['type'] = $aa['type'];
		$data['save'] = $saveData;
		if ($order['male'] === $saveData['male'] && $order['woman'] === $saveData['woman'] && $order['child'] === $saveData['child']) {
			$data['result'] = error(-1, '信息未更改');
			return $this->ajaxReturn($data);
		}
		
		$data['review'] = false;
		// 不需要提交审核
		if (is_error($result['review'])) {
			$orderObj = ModelBase::getInstance('lineenertname','xz_');
			$data['result'] = $orderObj->modify($saveData, appendLogicExp('id', '=', $aa['order_id']));	
			if (error_ok($data['result']) === true) {
				// 审核重新核算价格
				$data['refresh_money'] = BackOrderHelp::getOrderNeedPayMoney($aa['order_id'], true);
				// 更改订单状态
				BackOrderHelp::setOrderStateBySystem($aa['order_id']);			
			}		
			return $this->ajaxReturn($data);
		}	
		
		$admin = MyHelp::getLoginAccount(true);		
		$saveData['order_id'] = $aa['order_id'];
		$saveData['order_state_id'] = $order['zhuangtai'];
		$saveData['admin_id'] = $admin['id'];
		$saveData['old_male'] = $order['male'];
		$saveData['old_woman'] = $order['woman'];
		$saveData['old_child'] = $order['child'];
		
		// 审核状态
		$saveData['review_type_id'] = BackReviewHelp::reviewTypeKey2Value('reviewing');
		$saveData['create_time'] = fmtNowDateTime();
		
		$reviewCountObj = ModelBase::getInstance('order_review_change_count');
		$data['result'] = $reviewCountObj->create($saveData);
		if (error_ok($data['result'])) {
			$data['result'] = BackOrderHelp::setOrderStateByKey($aa['order_id'], 'info_changing');
		}
		$data['review'] = true;
		// 设置为信息提交审核中
		return $this->ajaxReturn($data);		
	}
	
	// 更新修改人数信息审核结果
	private function responseOrderReviewForCount($aa) {
		if (!array_key_exists('review_id', $aa) || !array_key_exists('review_result', $aa)) {
			$data = error(-1, '参数信息有误,审核订单审核信息失败');
			return $this->ajaxReturn($data);
		}
		
		$reviewCountObj = ModelBase::getInstance('order_review_change_count');
		$reviewCount = $reviewCountObj->getOne(appendLogicExp('id', '=', $aa['review_id']));
		if (empty($reviewCount)) {
			$data['result'] = error(-1, '未能找到审核记录，审核修改人数失败');
			return $this->ajaxReturn($data);
		}
							
		// 检测订单是否已经被锁定
		$lockResult = BackOrderHelp::checkOrderLock($reviewCount['order_id']);
		if (error_ok($lockResult) === false) {
			$data['result'] = $lockResult;
			$this->ajaxReturn($data);
		}
		
		$reviewResult = $aa['review_result'] === 'pass' ? 'review_pass' : 'review_fail';
		
		// 审核状态
		$reviewData['review_type_id'] = BackReviewHelp::reviewTypeKey2Value($reviewResult);
		// 审核其他信息
		$reviewData['update_time'] = fmtNowDateTime();
		$reviewData['response_reason'] = empty($aa['reason'])?'':$saveData['reason'];
		
		
		$admin = MyHelp::getLoginAccount(true);
		$reviewData['review_admin_id'] = $admin['id'];
		$data['result'] = $reviewCountObj->modify($reviewData, appendLogicExp('id', '=', $aa['review_id']));
		if (error_ok($data['result'])) {
			if ($reviewResult === 'review_pass') {
				$lineData['male'] = $reviewCount['male'];
				$lineData['woman'] = $reviewCount['woman'];
				$lineData['child'] = $reviewCount['child'];
				
				$orderObj = ModelBase::getInstance('lineenertname', 'xz_');	
				$data['result'] = $orderObj->modify($lineData, appendLogicExp('id', '=', $reviewCount['order_id']));
				if (error_ok($data['result']) === true) {					
					// 审核重新核算价格
					$data['refresh_money'] = BackOrderHelp::getOrderNeedPayMoney($reviewCount['order_id'], true);
				}
			}
			$data['result'] = BackOrderHelp::setOrderStateBySystem($reviewCount['order_id'], $reviewCount['order_state_id']);
			if ($data['result']['errno'] === 1) {
				$data['result']['errno'] = 0;
			}
		}
		return $this->ajaxReturn($data);	
	}
	
	// 修改人数信息审核
	public function changeCountAction() {
		if (IS_POST) {
			$aa = $_POST;
			if (isset($aa['op_type'])) {
				$opType = $aa['op_type'];
				if ($opType == 'list') {
					$this->typeChangeCountList($aa);
				} else if ($opType == 'cddata'){
					session_start();
					session('change_count_list_cds', $aa['cds']);
				} else if ($opType == 'request'){
					$this->createOrderReviewForCount($aa);
				} else if ($opType == 'response'){
					$this->responseOrderReviewForCount($aa);
				} else{
					$data['result'] = error(-1, '未知的类型动作请求');
					$this->ajaxReturn($data);
				}
			} else {
				$data['result'] = error(-1, '获取类型动作失败');
				$this->ajaxReturn($data);
			}
		} else {
			$op = I('get.op', false);
			if ($op === 'review_response') {
				$reviewId = I('get.id', 0);
				$complate = I('get.complate', 0);
				$data['jumpUrl'] = U('review/changeCount', 'op=show_info&rid='.$reviewId.'&cp='.$complate);
				$this->ajaxReturn($data);	
			} else if ($op === 'show_info') {
				$reviewId = I('get.rid', 0);
				$complate = I('get.cp', 0);
				$this->showReviewInfo('order_review_change_count',$reviewId,'count-info',$complate);	
			} else {
				// 设置菜单		
				$this->page_title = '人数变动审批';
				$this->content_title = '人数变动审批';
				$this->content_des = '这里你可以查看修改人数的请求或审批情况';
				$this->_setMenuLinkCurrent('人数变动审批', 'change_count');
				$this->_initTemplateInfo();	
				
				$this->assign('grant_review', check_grant('response_finance_review'));
				$this->assign('ajaxReqUrl', U('review/changeCount'));
				$this->display('change-count');	
			}
		}
	}
	
	// 显示线路变更审核列表
	private function typeChangeLineList($aa) {		
		$params['cdkey'] = 'change_line_list_cds';
		$params['table'] = 'order_review_change_line';		
		$params['startindex'] = $aa['iDisplayStart'];
		$params['pagecount'] = $aa['iDisplayLength'];
		
		$ds = $this->getListData($params, $totalCount);
		
		$data['sColumns'] = $colNames;
		$data['sEcho'] = $aa['sEcho'];	
		$data['iDisplayStart'] = $aa['iDisplayStart'];
		$data['iDisplayLength'] = $aa['iDisplayLength'];
		$data['iTotalRecords'] = $totalCount;
		$data['iTotalDisplayRecords'] = $totalCount;
		$data['aaData'] = $ds;		
		$data['result'] = error(0,"");
		if (is_error($ds)) {
			$data['result'] = $ds;
		}
		$this->ajaxReturn($data);
	}
	
	// 创建修改线路信息审核
	private function createOrderReviewForLine($aa) {	
		// 线路改变记录改变线路的日志
		if (check_grant('update_order_line') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
		}
			
		if (!array_key_exists('order_id', $aa)) {
			$data = error(-1, '参数信息有误,创建订单审核信息失败');
			return $this->ajaxReturn($data);
		}
							
		// 检测订单是否已经被锁定
		$lockResult = BackOrderHelp::checkOrderLock($aa['order_id']);
		if (error_ok($lockResult) === false) {
			$data['result'] = $lockResult;
			$this->ajaxReturn($data);
		}
		
		$result = BackOrderHelp::checkOrderOperate('change_team', $aa['order_id']);
		if ($result[operate] !== true) {
			if (error_ok($result['operate']) === false) {
				$data['result'] = $result['operate'];
				return $this->ajaxReturn($data);
			}
		}
		
		$order = BackOrderHelp::getOrderInfo($aa['order_id']);
		if (empty($order)) {
			$data['result'] = error(-1, '未能根据订单编号获取到订单信息');
			return $this->ajaxReturn($data);
		}		
		$fill = array('line'=>true, 'batch'=>true, 'taocan'=>true);
		$order = BackOrderHelp::fillNewOrderInfo($order, $fill);
		$data['order'] = $order;
		
		$saveData['lineid'] = $order['lineid'];
		$saveData['hdid'] = $order['hdid'];
		$saveData['tc_price_id'] = $order['tc_price_id'];
		$saveData['new_line'] = $order['new_line'];
		
		
		$recoverData = $saveData;
		if (array_key_exists('lineid', $aa)) {
			$saveData['lineid'] = $aa['lineid'];
		}
		
		if (array_key_exists('hdid', $aa)) {
			$saveData['hdid'] = $aa['hdid'];
		}
		
		if (array_key_exists('new_line', $aa)) {
			$saveData['new_line'] = $aa['new_line'];
		}
		
		if (!empty($aa['tc_price_id'])) {
			$conds = appendLogicExp('id', '=', $aa['tc_price_id']);
			$taocan = BackLineHelp::getTaocanPrice($conds, array('taocan'=>true));
			if (is_error($taocan) === false) {
				$saveData['tc_price_id'] = $data['taocan']['id'];	
			}
		}
		
		// 不需要提交审核
		$data['review'] = false;
		if (is_error($result['review'])) {					
			$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
			$data['result'] = $orderObj->modify($saveData, appendLogicExp('id', '=', $aa['order_id']));
			if (error_ok($data['result'])) {
				// 审核重新核算价格
				$data['refresh_money'] = BackOrderHelp::getOrderNeedPayMoney($aa['order_id'], true);
				// 刷新订单状态
				$result = BackOrderHelp::setOrderStateBySystem($aa['order_id']);
				if (is_error($result) && ($result['errno'] === 0 || $result['errno'] === 1)) {
					$data['result'] = error(0, '修改线路成功!');
					$lineObj = ModelBase::getInstance('line');
					$line = $lineObj->getOne(appendLogicExp('id', '=', $aa['lineid']));
					$data['line'] = $line;
					$batchObj = ModelBase::getInstance('batch');
					$batch = $batchObj->getOne(appendLogicExp('id', '=', $aa['hdid']));
					$batch['show_text'] = date('Y年m月d日', strtotime($batch['start_time'])).' 至 '.date('Y年m月d日', strtotime($batch['end_time']));
					$data['batch'] = $batch;
					if (!empty($taocan)) {
						$data['taocan'] = $taocan;
					}
					
					// 写入跟踪记录
					$data['save_log'] = '从线路【'.$order['lineid_title'].'】中的【'.$order['hdid_show_text'].'】批次【'.$order['taocan']['tc_name_str'].'】套餐转入线路【'.$line['title'].'】中的【'.$batch['show_text'].'】批次【'.$taocan['tc_name_str'].'】套餐';
					BackOrderHelp::writeSupervise($aa['order_id'], $data['save_log']);
					
					// 修改分销订单的分销价格
					$newLine = BackLineHelp::getLine(appendLogicExp('id', '=', $saveData['lineid']));
					if (!empty($newLine)) {
						$fxOrderObj = ModelBase::getInstance('fx_order');
						$fxDS['commision_adult'] = $newLine['commision_adult'];
						$fxDS['commision_child'] = $newLine['commision_child'];
						$data['distribute_result'] = $fxOrderObj->modify($fxDS, appendLogicExp('id', '=', $aa['order_id']));
					}
					
				} else {
					$data['result'] = $result;
					$result = $orderObj->modify($recoverData, appendLogicExp('id', '=', $aa['order_id']));
					if ($result['errno'] === 0) {
						// 审核重新核算价格
						$data['refresh_money'] = BackOrderHelp::getOrderNeedPayMoney($aa['order_id'], true);
					}
				}
			}		
			return $this->ajaxReturn($data);
		}	
		
		$admin = MyHelp::getLoginAccount(true);		
		$saveData['order_id'] = $aa['order_id'];
		$saveData['order_state_id'] = $order['zhuangtai'];
		$saveData['admin_id'] = $admin['id'];
		$saveData['old_lineid'] = $order['lineid'];
		$saveData['old_hdid'] = $order['hdid'];
		$saveData['old_tc_price_id'] = $order['tc_price_id'];
		$saveData['old_new_line'] = $order['new_line'];
		
		// 审核状态
		$reviewTypeObj = ModelBase::getInstance('review_type');
		$reviewType = $reviewTypeObj->getOne(appendLogicExp('type_key', '=', 'reviewing'));
		if (!empty($reviewType)) {
			$saveData['review_type_id'] = $reviewType['id'];
		}
		$saveData['create_time'] = fmtNowDateTime();
		
		$reviewLineObj = ModelBase::getInstance('order_review_change_line');
		$data['result'] = $reviewLineObj->create($saveData);
		if (error_ok($data['result'])) {
			$result = BackOrderHelp::setOrderStateByKey($aa['order_id'], 'info_changing');
			if (is_error($result) && $result['errno'] === 0) {
				$data['result'] = error(0, '提交修改线路成功!');
			} else {
				$data['result'] = $result;
			}
		}
		$data['review'] = true;
		return $this->ajaxReturn($data);	
	}
	
	// 更新修改人数信息审核结果
	private function responseOrderReviewForLine($aa) {
		if (!array_key_exists('review_id', $aa) || !array_key_exists('review_result', $aa)) {
			$data = error(-1, '参数信息有误,审核订单审核信息失败');
			return $this->ajaxReturn($data);
		}
		
		$reviewLineObj = ModelBase::getInstance('order_review_change_line');
		$reviewLine = $reviewLineObj->getOne(appendLogicExp('id', '=', $aa['review_id']));
		if (empty($reviewLine)) {
			$data['result'] = error(-1, '未能找到审核记录，审核修改线路失败');
			return $this->ajaxReturn($data);
		}
							
		// 检测订单是否已经被锁定
		$lockResult = BackOrderHelp::checkOrderLock($reviewLine['order_id']);
		if (error_ok($lockResult) === false) {
			$data['result'] = $lockResult;
			$this->ajaxReturn($data);
		}
		
		$reviewResult = $aa['review_result'] === 'pass' ? 'review_pass' : 'review_fail';
		// 审核状态
		$reviewTypeObj = ModelBase::getInstance('review_type');
		$reviewType = $reviewTypeObj->getOne(appendLogicExp('type_key', '=', $reviewResult));
		if (!empty($reviewType)) {
			$reviewData['review_type_id'] = $reviewType['id'];	
		}		
		$reviewData['update_time'] = fmtNowDateTime();
		$reviewData['response_reason'] = empty($aa['reason'])?'':$saveData['reason'];
		
		$admin = MyHelp::getLoginAccount(true);
		$reviewData['review_admin_id'] = $admin['id'];
		$data['result'] = $reviewLineObj->modify($reviewData, appendLogicExp('id', '=', $aa['review_id']));
		if (error_ok($data['result'])) {
			if ($reviewResult === 'review_pass') {
				$lineData['lineid'] = $reviewLine['lineid'];
				$lineData['hdid'] = $reviewLine['hdid'];
				$lineData['tc_price_id'] = $reviewLine['tc_price_id'];
				$lineData['new_line'] = $reviewLine['new_line'];
				
				$order = BackOrderHelp::getOrderInfo($reviewLine['order_id']);
				if (empty($order)) {
					$data['result'] = error(-1, '未能根据订单编号获取到订单信息');
					return $this->ajaxReturn($data);
				}		
				$fill = array('line'=>true, 'batch'=>true);
				$order = BackOrderHelp::fillNewOrderInfo($order, $fill);
					
				// 修改分销订单的分销价格
				$newLine = $order['lineid_data'];
				if (!empty($newLine)) {
					$fxOrderObj = ModelBase::getInstance('fx_order');
					$fxDS['commision_adult'] = $newLine['commision_adult'];
					$fxDS['commision_child'] = $newLine['commision_child'];
					$data['distribute_result'] = $fxOrderObj->modify($fxDS, appendLogicExp('id', '=', $aa['order_id']));
				}
				
				// 写入跟踪记录
				$data['save_log'] = '从线路【'.$order['lineid_title'].'】中的【'.$order['hdid_show_text'].'】批次转出';
				$result = BackOrderHelp::writeSupervise($reviewLine['order_id'], $data['save_log']);
				if (is_error($result)) {
					$data['result'] = $result;
				}
				
				$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
				$data['result'] = $orderObj->modify($lineData, appendLogicExp('id', '=', $reviewLine['order_id']));
				if (error_ok($data['result']) === true) {				
					// 审核重新核算价格
					$data['refresh_money'] = BackOrderHelp::getOrderNeedPayMoney($reviewLine['order_id'], true);
				}
			}
			
			if (error_ok($data['result'])) {
				$orderStateKey = BackOrderHelp::OrderStateKey2Value($reviewLine['order_state_id']);
				$result = BackOrderHelp::setOrderStateBySystem($reviewLine['order_id'], $orderStateKey, $out);
				$data['out'] = $out;
				if (is_error($result) && $result['errno'] === 0) {
					$data['result'] = error(0, '修改线路审核成功!');
				} else {
					$data['result'] = $result;
				}
			}
		}
		return $this->ajaxReturn($data);
	}
	
	// 修改人数信息审核
	public function changeLineAction() {
		if (IS_POST) {			
			$opType = I('post.op_type', false);
			if ($opType == 'list') {
				$this->typeChangeLineList($_POST);
			} else if ($opType == 'cddata'){
				session_start();
				session('change_line_list_cds', $_POST['cds']);
			} else if ($opType == 'request'){
				$this->createOrderReviewForLine($_POST);
			} else if ($opType == 'response'){
				$this->responseOrderReviewForLine($_POST);
			} else{
				$data['result'] = error(-1, '未知的类型动作请求');
				$this->ajaxReturn($data);
			}
		} else {	
			$op = I('get.op', false);
			if ($op === 'review_response') {
				$reviewId = I('get.id', 0);
				$complate = I('get.complate', 0);
				$data['jumpUrl'] = U('review/changeLine', 'op=show_info&rid='.$reviewId.'&cp='.$complate);
				$this->ajaxReturn($data);	
			} else if ($op === 'show_info') {
				$reviewId = I('get.rid', 0);
				$complate = I('get.cp', 0);
				$this->showReviewInfo('order_review_change_line',$reviewId,'line-info',$complate);
			} else {		
				// 设置菜单		
				$this->page_title = '线路审批';
				$this->content_title = '线路审批';
				$this->content_des = '这里你可以查看修改线路批次的请求或审批情况';
				$this->_setMenuLinkCurrent('线路审批', 'change_line');
				$this->_initTemplateInfo();	
				
				$this->assign('grant_review', check_grant('response_finance_review'));
				$this->assign('ajaxReqUrl', U('review/changeLine'));
				$this->display('change-line');
			}
		}
	}
	
	// 显示退团审核列表
	private function typeExitTeamList($aa) {	
		$params['cdkey'] = 'exit_team_list_cds';
		$params['table'] = 'order_review_exit_member';		
		$params['startindex'] = $aa['iDisplayStart'];
		$params['pagecount'] = $aa['iDisplayLength'];
		
		$ds = $this->getListData($params, $totalCount);
		
		$data['sColumns'] = $colNames;
		$data['sEcho'] = $aa['sEcho'];	
		$data['iDisplayStart'] = $aa['iDisplayStart'];
		$data['iDisplayLength'] = $aa['iDisplayLength'];
		$data['iTotalRecords'] = $totalCount;
		$data['iTotalDisplayRecords'] = $totalCount;
		$data['aaData'] = $ds;		
		$data['result'] = error(0,"");
		if (is_error($ds)) {
			$data['result'] = $ds;
		}
		$this->ajaxReturn($data);		
	}
	
	// 获取退团人中的男/女/儿童
	private function getExitTeamMemberTypeCount($newExitMemberIds, &$exitNames, &$out) {
		$typeCount = array('male'=>0,'woman'=>0,'child'=>0);		
		$exitIdStr = implode(',', $newExitMemberIds);
		$exitMemberConds = appendLogicExp('id', 'IN', '('.$exitIdStr.')');
		$members = BackOrderHelp::getOrderMembers(0,$exitMemberConds);
		$out['members'] = $members;
		foreach ($members as $mk=>$mv) {
			if (!empty($exitNames)) {
				$exitNames .= '、';
			}
			$exitNames .= $mv['name'];
			$type_key = $mv['type_id_data']['type_key'];
			if (stripos($type_key, 'child') !== false) {
				$typeCount['child'] = intval($typeCount['child'])+1;
			} else if (stripos($type_key, 'woman') !== false) {
				$typeCount['woman'] = intval($typeCount['woman'])+1;
			} else if (stripos($type_key, 'man') !== false)  {
				$typeCount['male'] = intval($typeCount['male'])+1;
			} else {
				return error(-1, '退团人类型错误，不能退团');
			}
		}
		return $typeCount;
	}
	
	// 创建退团信息审核
	private function createOrderReviewForTeam($aa) {		
		if (!array_key_exists('order_id', $aa) || !array_key_exists('ids', $aa)) {
			$data = error(-1, '参数信息有误,创建订单审核信息失败');
			return $this->ajaxReturn($data);
		}
		
		// 检测订单是否已经被锁定
		$lockResult = BackOrderHelp::checkOrderLock($aa['order_id']);
		if (error_ok($lockResult) === false) {
			$data['result'] = $lockResult;
			$this->ajaxReturn($data);
		}
		
		// 是否存在退团人编号
		$exitIds = explode(',', $aa['ids']);
		if (empty($exitIds)) {
			$data['result'] = error(-1, '不存在要退团的参团人');
			return $this->ajaxReturn($data);
		}	
		
		// 是否可退团订单状态检测
		$result = BackOrderHelp::checkOrderOperate('exit_team', $aa['order_id']);
		if ($result[operate] !== true) {
			if (error_ok($result['operate']) === false) {
				$data['result'] = $result['operate'];
				return $this->ajaxReturn($data);
			}
		}
		
		$data['refresh'] = 0;
		$newExitMemberIds = $exitIds;
		
		// 获取订单信息
		$order = BackOrderHelp::getOrderInfo($aa['order_id']);
		if (empty($order)) {
			$data['result'] = error(-1, '未能根据订单编号获取到订单信息');
			return $this->ajaxReturn($data);
		}		
		// 新创建的在订单详细中已经转换为新参团人，创建不需要再次转换
		
		// 退团人类型数量
		$exitTypeCount = $this->getExitTeamMemberTypeCount($newExitMemberIds, $exitNames, $out);
		if (is_error($exitTypeCount) === true) {
			$data['result'] = $exitTypeCount;
			return $this->ajaxReturn($data);
		}
								
		// 退出后订单人数变化		
		$newData['child'] = intval($order['child']) - intval($exitTypeCount['child']);
		$newData['woman'] = intval($order['woman']) - intval($exitTypeCount['woman']);
		$newData['male'] = intval($order['male']) - intval($exitTypeCount['male']);	
				
		// 检查退团人数是否大于订单参团人数
		if (intval($newData['child']) < 0 || intval($newData['woman']) < 0 || intval($newData['male']) < 0) {
			$data['out'] = $out;
			$data['result'] = error(-1, '可供退团的人数小于退团人数，请拒绝通过审核');
			return $this->ajaxReturn($data);
		}
				
		$data['review'] = false;
		// 不需要提交审核
		if (is_error($result['review'])) {	
				
			if (intval($newData['child']) < 0 || intval($newData['woman']) < 0 || intval($newData['male']) < 0) {
				$data['result'] = error(-1, '可供退团的人数小于退团人数，不能提交审核');
				return $this->ajaxReturn($data);
			}
				
			// 修改参团人状态
			$memberObj = ModelBase::getInstance('signup_member');		
			$exitIdStr = implode(',', $newExitMemberIds);
			$data['result'] = $memberObj->modify(array('exit'=>2), appendLogicExp('id', 'IN', '('.$exitIdStr.')'));
			if (error_ok($data['result']) === false) {
				return $this->ajaxReturn($data);
			}
			
			$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
			$data['result'] = $orderObj->modify($newData, appendLogicExp('id', '=', $aa['order_id']));
			if (error_ok($data['result']) === true) {						
				// 审核重新核算价格
				$data['refresh_money'] = BackOrderHelp::getOrderNeedPayMoney($aa['order_id'], true);
				// 刷新订单状态
				$data['state_result'] = BackOrderHelp::setOrderStateBySystem($aa['order_id']);
				
				// 写跟踪记录
				$exitNames .= '在不需要审核的情况下退出了团队';
				BackOrderHelp::writeSupervise($aa['order_id'], $exitNames);
			}		
			
			return $this->ajaxReturn($data);
		}	
		
		$admin = MyHelp::getLoginAccount(true);
		$saveData['order_id'] = $aa['order_id'];
		$saveData['order_state_id'] = $order['zhuangtai'];
		$saveData['admin_id'] = $admin['id'];
		$saveData['member_id'] = implode(',',$newExitMemberIds);	// 新表参团人退团
		
		// 审核状态
		$saveData['review_type_id'] = BackReviewHelp::reviewTypeKey2Value('reviewing');
		$saveData['create_time'] = fmtNowDateTime();
		
		$reviewLineObj = ModelBase::getInstance('order_review_exit_member');
		$data['result'] = $reviewLineObj->create($saveData);
		if (error_ok($data['result']) === true) {
			$data['result'] = error(0, '您提交的退团申请已经成功记录，请耐心等待管理员的审批');
			$data['state_change_result'] = BackOrderHelp::setOrderStateByKey($aa['order_id'], 'info_changing');
			$exitNames .= '请求退出团队';
			BackOrderHelp::writeSupervise($aa['order_id'], $exitNames);
		}
		$data['review'] = true;
		return $this->ajaxReturn($data);
	}
	
	// 更新退团信息审核结果
	private function responseOrderReviewForTeam($aa) {
		if (!array_key_exists('review_id', $aa) || !array_key_exists('review_result', $aa)) {
			$data = error(-1, '参数信息有误,审核订单审核信息失败');
			return $this->ajaxReturn($data);
		}
		
		// 获取审核信息
		$reviewExitObj = ModelBase::getInstance('order_review_exit_member');
		$reviewExit = $reviewExitObj->getOne(appendLogicExp('id', '=', $aa['review_id']));
		if (empty($reviewExit)) {
			$data['result'] = error(-1, '未能找到审核记录，审核修改线路失败');
			return $this->ajaxReturn($data);
		}
							
		// 检测订单是否已经被锁定
		$lockResult = BackOrderHelp::checkOrderLock($reviewExit['order_id']);
		if (error_ok($lockResult) === false) {
			$data['result'] = $lockResult;
			$this->ajaxReturn($data);
		}
		
		// 审核状态
		$reviewResult = $aa['review_result'] === 'pass' ? 'review_pass' : 'review_fail';
		$reviewData['review_type_id'] = BackReviewHelp::reviewTypeKey2Value($reviewResult);
		
		// 审核原因时间
		$reviewData['update_time'] = fmtNowDateTime();
		$reviewData['response_reason'] = empty($aa['reason'])?'':$aa['reason'];
		
		// 审核人编号
		$admin = MyHelp::getLoginAccount(true);
		$reviewData['review_admin_id'] = $admin['id'];
		
		// 执行审核结果写入
		$data['result'] = $reviewExitObj->modify($reviewData, appendLogicExp('id', '=', $aa['review_id']));
		if (error_ok($data['result'])) {
			// 通过审核后续处理
			if ($reviewResult === 'review_pass') {				
				// 获取订单信息
				$order = BackOrderHelp::getOrderInfo($reviewExit['order_id']);
				if (empty($order)) {
					$data['result'] = error(-1, '未能根据订单编号获取到订单信息');
					return $this->ajaxReturn($data);
				}
										
				// 退团人类型数量
				$exitIds = explode(',',$reviewExit['member_id']);
				
				// 旧时提交的审核订单，未打开过订单详细，也就是未转换的参团人在此进行转换
				$changeResult = BackOrderHelp::memberTableChangeOld2New($order, $memberIds);
				if (error_ok($changeResult) === true) {
					$newExitMemberIds = array();
					// 获取要退团人员的新表编号
					foreach ($exitIds as $ik=>$iv) {
						// 如果在新表转换失败情况处理
						if (empty($memberIds[$ik]) || is_error($memberIds[$ik]) === true) {
							$data['result'] = error(-1, '新旧数据转换引起修退团错误:'.$updateMemberId['message']);
							return $this->ajaxReturn(data);
						}
						array_push($newExitMemberIds, $memberIds[$ik]);
					}
				} else {
					// $changeResult['errno']==1，代表无需转换,其他为转换错误
					if ($changeResult['errno'] == 1) {
						$newExitMemberIds = $exitIds;
					} else {
						$data['result'] = $changeResult;
						return $this->ajaxReturn($data);	
					}
				}
				
				$exitTypeCount = $this->getExitTeamMemberTypeCount($newExitMemberIds, $exitNames);
				if (is_error($exitTypeCount) === true) {
					$data['result'] = $exitTypeCount;
					return $this->ajaxReturn($data);
				}
									
				// 退出后订单人数变化			
				$newData['child'] = intval($order['child']) - intval($exitTypeCount['child']);
				$newData['woman'] = intval($order['woman']) - intval($exitTypeCount['woman']);
				$newData['male'] = intval($order['male']) - intval($exitTypeCount['male']);	
				
				// 检查退团人数是否大于订单参团人数
				if (intval($newData['child']) < 0 || intval($newData['woman']) < 0 || intval($newData['male']) < 0) {
					$data['new_count'] = $order;
					$data['exit_count'] = $exitTypeCount;
					$data['result'] = error(-1, '可供退团的人数小于退团人数，请拒绝通过审核');
					$rs = $reviewExitObj->modify($reviewExit, appendLogicExp('id', '=', $aa['review_id']));		
					if (error_ok($rs) === false) {
						$data['result']['message'] .= ',还原审核信息失败';
					}
					return $this->ajaxReturn($data);
				}
				
				// 修改参团人状态
				$memberObj = ModelBase::getInstance('signup_member');
				$data['member_exit_result'] = $memberObj->modify(array('exit'=>2), appendLogicExp('id', 'IN', '('.$reviewExit['member_id'].')'));
				if (error_ok($data['result']) === false) {
					$rs = $reviewExitObj->modify($reviewExit, appendLogicExp('id', '=', $aa['review_id']));		
					if (error_ok($rs) === false) {
						$data['result']['message'] .= ',还原审核信息失败';
					}
					return $this->ajaxReturn($data);
				}
				
				// 修改订单人数变化
				$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
				$data['result'] = $orderObj->modify($newData, appendLogicExp('id', '=', $reviewExit['order_id']));
				if (error_ok($data['result'])) {				
					// 审核重新核算价格
					$data['refresh_money'] = BackOrderHelp::getOrderNeedPayMoney($reviewExit['order_id'], true);
					
					// 写入订单跟踪					
					$exitNames .= '退出了团队';
					BackOrderHelp::writeSupervise($reviewExit['order_id'], $exitNames);
				} else {
					$rs = $reviewExitObj->modify($reviewExit, appendLogicExp('id', '=', $aa['review_id']));		
					if (error_ok($rs) === false) {
						$data['result']['message'] .= ',还原审核信息失败';
					}
					return $this->ajaxReturn($data);
				}				
			}  
			BackOrderHelp::setOrderStateBySystem($reviewExit['order_id'], $reviewExit['order_state_id'], $output);
			$data['output'] = $output;
		}
		return $this->ajaxReturn($data);
	}
	
	// 修改退团信息审核
	public function exitTeamAction() {
		if (IS_POST) {
			$aa = $_POST;
			if (isset($aa['op_type'])) {
				$opType = $aa['op_type'];
				if ($opType == 'list') {
					$this->typeExitTeamList($aa);
				} else if ($opType == 'cddata'){
					session_start();
					session('exit_team_list_cds', $aa['cds']);
				} else if ($opType == 'request'){
					$this->createOrderReviewForTeam($aa);
				} else if ($opType == 'response'){
					$this->responseOrderReviewForTeam($aa);
				} else{
					$data['result'] = error(-1, '未知的类型动作请求');
					$this->ajaxReturn($data);
				}
			} else {
				$data['result'] = error(-1, '获取类型动作失败');
				$this->ajaxReturn($data);
			}
			
		} else {	
			$op = I('get.op', false);
			if ($op === 'review_response') {
				$reviewId = I('get.id', 0);
				$complate = I('get.complate', 0);
				$data['jumpUrl'] = U('review/exitTeam', 'op=show_info&rid='.$reviewId.'&cp='.$complate);
				$this->ajaxReturn($data);	
			} else if ($op === 'show_info') {
				$reviewId = I('get.rid', 0);
				$complate = I('get.cp', 0);
				$this->showReviewInfo('order_review_exit_member',$reviewId,'exit-info',$complate);
			} else {	
				// 设置菜单		
				$this->page_title = '退团审批';
				$this->content_title = '退团审批';
				$this->content_des = '这里你可以查看修改退团的请求或审批情况';
				$this->_setMenuLinkCurrent('退团审批', 'exit_team');
				$this->_initTemplateInfo();	
				
				$this->assign('grant_review', check_grant('response_finance_review'));
				$this->assign('ajaxReqUrl', U('review/exitTeam'));
				$this->display('exit-team');
			}
		}
	}	
	
	// 显示提款审核列表
	private function typeTakeCashList($aa) {						
		$cds = $this->getFindListCDS('take_cash_list_cds');
		$data['cds'] = $cds;
		if (!empty($cds['user_name'])) {
			$fxUserObj = ModelBase::getInstance('fx_user');
			$fxUsers = $fxUserObj->getAll(appendLogicExp('name', 'LIKE', '%'.$cds['user_name'].'%'));
			foreach ($fxUsers as $fk=>$fv) {
				if (!empty($userIds)) {
					$userIds .= ',';
				}
				$userIds = $fxUsers['id'];
			}
			if (!empty($userIds)) {
				$conds = appendLogicExp('user_id', '=', '('.$userIds.')', 'AND', $conds);
			}
		}
		
		// 时间跨度
		if (!empty($cds['sdate'])) {
			$dateCol = $cds['date_type'] === 'request' ? 'take_time' : 'review_time';
			$conds = appendLogicExp($dateCol, '>=', $cds['sdate'].' 00:00:00', 'AND', $conds);
		}
		if (!empty($cds['edate'])) {
			$dateCol = $cds['date_type'] === 'request' ? 'take_time' : 'review_time';
			$conds = appendLogicExp($dateCol, '<=', $cds['edate'].' 23:59:59', 'AND', $conds);
		}
		$data['conds'] = $conds;
		
		$fxTakeCashObj = ModelBase::getInstance('fx_take_cash');
		$colNames = $fxTakeCashObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = $fxTakeCashObj->getAll($conds, $aa['iDisplayStart'], $aa['iDisplayLength'], $totalCount, array('take_time'=>'desc'));
		$data['sql'] = $fxTakeCashObj->getLastSql();
		
		foreach ($ds as $dk=>$dv) {
			$dv['user_id_data'] = BackAccountHelp::getAccount('account_distribute', appendLogicExp('id', '=', $dv['user_id']));
			$dv['admin_id_data'] = BackAccountHelp::getAccount('account_admin', appendLogicExp('id', '=', $dv['admin_id']));
			$dv['pay_channel_id_data'] = MyHelp::MenuItemKey2Value('pay_menu', $dv['pay_channel_id'], true);
			$dv['review_type_id_data'] = BackReviewHelp::reviewTypeKey2Value($dv['review_type_id'], true);
			
			$reviewKey = $dv['review_type_id_data']['type_key'];
			if ($reviewKey == 'review_pass' || $reviewKey == 'review_fail') {
				$dv['review_complate'] = true;
			}
			$ds[$dk] = $dv;
		}		
				
		$data['sColumns'] = $colNames;
		$data['sEcho'] = $aa['sEcho'];	
		$data['iDisplayStart'] = $aa['iDisplayStart'];
		$data['iDisplayLength'] = $aa['iDisplayLength'];
		$data['iTotalRecords'] = $totalCount;
		$data['iTotalDisplayRecords'] = $totalCount;
		$data['aaData'] = $ds;		
		$data['result'] = error(0,"");
		if (is_error($ds)) {
			$data['result'] = $ds;
		}
		$this->ajaxReturn($data);		
	}
	
	// 显示提款审核详细
	private function showTakeCashInfo($aa) {
		if (empty($aa['id'])) {
			$data['result'] = error(-1, '参数不齐全');
			return $this->ajaxReturn($data);
		}
		
		$fxTakeCashObj = ModelBase::getInstance('fx_take_cash');
		$fxTakeCash = $fxTakeCashObj->getOne(appendLogicExp('id', '=', $aa['id']));
		
		$fxTakeCash['user_id_data'] = BackAccountHelp::getAccount('account_distribute', appendLogicExp('id', '=', $fxTakeCash['user_id']));
		$fxTakeCash['admin_id_data'] = BackAccountHelp::getAccount('account_admin', appendLogicExp('id', '=', $fxTakeCash['admin_id']));
		$fxTakeCash['pay_channel_id_data'] = MyHelp::MenuItemKey2Value('pay_menu', $fxTakeCash['pay_channel_id'], true);
		$fxTakeCash['review_type_id_data'] = BackReviewHelp::reviewTypeKey2Value($fxTakeCash['review_type_id'], true);
		
		$this->assign('review', $fxTakeCash);	
		
		$reviewKey = $fxTakeCash['review_type_id_data']['type_key'];
		if ($reviewKey == 'review_pass' || $reviewKey == 'review_fail') {
			$this->assign('review_complate', true);
		}
		
		$this->page_title = '提现审核';
		$this->content_title = '提现审核';
		$this->content_des = '这里你可以审批、处理分销用户提出的提现请求';
		$this->_setMenuLinkCurrent('提现审核', 'take_cash');
		$this->_initTemplateInfo();	
		
		$this->assign('grant_review', check_grant('response_finance_review'));
		$this->display('take-cash-info');		
	}
	
	// 更新提款信息结果
	private function responseReviewForTakeCash($aa) {
		if (!array_key_exists('id', $aa) || !array_key_exists('review', $aa)) {
			$data = error(-1, '参数信息有误,提款审核信息失败');
			return $this->ajaxReturn($data);
		}
		
		// 获取审核信息
		$fxTakeCashObj = ModelBase::getInstance('fx_take_cash');
		$fxTakeCash = $fxTakeCashObj->getOne(appendLogicExp('id', '=', $aa['id']));
		if (empty($fxTakeCash)) {
			$data['result'] = error(-1, '未能找到提款审核记录');
			return $this->ajaxReturn($data);
		}
		
		// 审核状态
		$reviewResult = $aa['review'] === 'pass' ? 'review_pass' : 'review_fail';
		$fxTakeCash['review_type_id'] = BackReviewHelp::reviewTypeKey2Value($reviewResult);
		
		// 审核原因时间
		$fxTakeCash['review_time'] = fmtNowDateTime();
		$fxTakeCash['beizhu'] = empty($aa['reason'])?'':$aa['reason'];
		
		// 审核人编号
		$admin = MyHelp::getLoginAccount(true);
		$fxTakeCash['admin_id'] = $admin['id'];
		
		// 执行审核结果写入
		$data['result'] = $fxTakeCashObj->modify($fxTakeCash, appendLogicExp('id', '=', $aa['id']));
		if (error_ok($data['result'])) {
			// 通过审核后续处理
			if ($reviewResult === 'review_fail') {
				$fxUserObj = ModelBase::getInstance('fx_user');
				$fxUserData = $fxUserObj->getOne(appendLogicExp('id', '=', $fxTakeCash['user_id']));
				if (!empty($fxUserData)) {
					$data['recover_old_money'] = $fxUserData['money'];
					$data['recover_money'] = $fxTakeCash['cash'];
					$fxUserData['money'] = bcadd($fxUserData['money'], $fxTakeCash['cash'], 2);
					$data['recover_result'] = $fxUserObj->modify($fxUserData, appendLogicExp('id', '=', $fxUserData['id']));
				}
			}
			$data['output'] = $output;
		}
		return $this->ajaxReturn($data);
	}
	
	// 提款审核
	public function takecashAction() {
		if (IS_POST) {
			$aa = $_POST;
			if (isset($aa['op_type'])) {
				$opType = $aa['op_type'];
				if ($opType == 'list') {
					$this->typeTakeCashList($aa);
				} else if ($opType == 'cddata'){
					session_start();
					session('take_cash_list_cds', $aa['cds']);
				} else if ($opType == 'response'){
					$this->responseReviewForTakeCash($aa);
				} else{
					$data['result'] = error(-1, '未知的类型动作请求');
					$this->ajaxReturn($data);
				}
			} else {
				$data['result'] = error(-1, '获取类型动作失败');
				$this->ajaxReturn($data);
			}
			
		} else {	
			$op = I('get.op', false);
			if ($op === 'info') {
				$this->showTakeCashInfo($_GET);
			} else {
				// 设置菜单		
				$this->page_title = '提现审核';
				$this->content_title = '提现审核';
				$this->content_des = '这里你可以审批、处理分销用户提出的提现请求';
				$this->_setMenuLinkCurrent('提现审核', 'take_cash');
				$this->_initTemplateInfo();	
				
				$this->assign('grant_review', check_grant('response_finance_review'));
				$this->assign('ajaxReqUrl', U('review/takecash'));
				$this->display('take-cash');
			}
		}
	}
}

?>