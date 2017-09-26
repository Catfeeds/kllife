<?php

namespace Back\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackOrderHelp;
use Core\Model\BackCouponHelp;
use Core\Model\BackReviewHelp;
use Core\Model\BackExtraCashHelp;
use Core\Model\BackLineHelp;
use Core\Model\BackAccountHelp;

class OrderController extends BackBaseController {

	protected function _initialize() {		
		$this->page_title = '订单列表';
		$this->content_title_show = 1;
		$this->menu_active = 'order';
	}
	
	public function _empty() {
		$this->content_title = '订单列表';
		$this->content_des = '这里你可以查看并客户的订单';
		$this->_setMenuLinkCurrent('管理员权限列表','order_list');
		$this->_initTemplateInfo();
		$this->display('list');
	}
	
	private function getFindListCDS($sessionKey) {
		session_start();
		$cds = session($sessionKey);        
		if (empty($cds['type'])){
			return array('find'=>false,'条件类型为空');
		}
		$findType = $cds['type'];
		if (empty($cds[$findType])) {
			return array('find'=>false,'条件数据不存在');
		}
		$cd['cddata'] = $cds;
		$cdData = $cds[$findType];
		$cdList = array();
//		if ($findType === 'order') {
			foreach ($cdData as $k=>$v) {
				switch($v['name']){
					case 'order_sn': $cdList['order_sn_like'] = $v['value']; break; //模糊查找，自定义条件
					case 'from': $cdList['from_id'] = $v['value']; break;
					case 'station': $cdList['station_id'] = $v['value']; break;
					case 'state': $cdList['zhuangtai'] = $v['value']; break;
					case 'cash_func': $cdList['cash_func_id'] = $v['value']; break;
//					case 'userid': $cdList['userid'] = $v['value']; break;
					case 'username': $cdList['uname'] = $v['value']; break;
					case 'contact': $cdList['my_names'] = $v['value']; break;
					case 'phone': $cdList['mob'] = $v['value']; break;
					case 'id': $cdList['id'] = $v['value']; break;
					case 'date_type': $cdList['date_type'] = $v['value']; break;
					case 'sdate': $cdList['sdate'] = $v['value']; break;
					case 'edate': $cdList['edate'] = $v['value']; break;
					
					case 'lid': $cdList['lineid'] = $v['value']; break;
					case 'aid': $cdList['hdid'] = $v['value']; break;
					case 'newline': $cdList['newline'] = $v['value']; break;
					case 'line_state': {
						if (empty($cdList['zhuangtai']) || $cdList['zhuangtai'] == -1){
							$cdList['zhuangtai'] = $v['value'];
						}  
					} break;
					case 'line_from':{
						if (empty($cdList['from_id']) || $cdList['from_id'] == -1){
							$cdList['from_id'] = $v['value'];
						}  
					} break;
					
					case 'member_name': $cdList['member_name'] = $v['value']; break;
					case 'member_phone': $cdList['member_tel'] = $v['value']; break;
					case 'member_certificate': $cdList['member_certificate'] = $v['value']; break;
					default: break;
				}
			}
//		} else if ($findType === 'line') {
//			foreach ($cdData as $k=>$v) {
//				switch($v['name']){
//					case 'lid': $cdList['lineid'] = $v['value']; break;
//					case 'aid': $cdList['hdid'] = $v['value']; break;
//					case 'state': $cdList['zhuangtai'] = $v['value']; break;
//					case 'from': $cdList['from_id'] = $v['value']; break;
//					default: break;
//				}
//			}
//		} else if ($findType === 'member') {
//			foreach ($cdData as $k=>$v) {
//				switch($v['name']){
//					case 'name': $cdList['name'] = $v['value']; break;
//					case 'phone': $cdList['tel'] = $v['value']; break;
//					case 'certificate': $cdList['certificate_num'] = $v['value']; break;
//					default: break;
//				}
//			}
//		}
		$cd['list_unfilter'] = $cdList;
		MyHelp::filterInvalidConds($cdList);
		$cd['find'] = $findType;
		$cd['list'] = $cdList;
		$cd['robot'] = $cds['robot'];
		return $cd;
	}
	
	// 获取列表查询日期条件
	private function getFindListDateConds($dateType, $stratdate, $enddate, &$errMsg, &$output) {
		$conds = array();		
		$usd = strtotime($stratdate);
		$ued = strtotime($enddate);			
		$sdate = $usd > $ued ? $ued : $usd;
		$edate = $usd > $ued ? $usd : $ued;
		$edate = strtotime('+23 hours 59 minutes 59 seconds', $edate);
		// 确保最多查询一个月
		$maxDate = strtotime('+1 months', $sdate);
		if ($edate > $maxDate) {
			$errMsg = '查询日志超出查询范围，日期查询无效';
			return $conds;
		}
		if ($dateType === 'create') {
			$conds = appendLogicExp('addtime', '>=', $sdate, 'AND', $conds);
			$conds = appendLogicExp('addtime', '<=', $edate, 'AND', $conds);	
		} else if ($dateType === 'pay') {
			$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
			
			// 线上支付1
//			$dateConds = appendJoinLogicExp('pay_log', 'SendTime', '>=', date('YmdHis',$sdate), 'AND', 'xz_');
//			$dateConds = appendJoinLogicExp('pay_log', 'SendTime', '<=', date('YmdHis',$edate), 'AND', 'xz_', $dateConds);
//			$payJoin = appendJoinExp('pay_log', 'order_sn', '=', 'order_sn', 'AND', 'inner', 'xz_', 'p1');
//			$showPayCols = appendJoinTableExp('lineenertname', array('id'), 'xz_');
//			$showPayCols = appendJoinTableExp('pay_log', array('SendTime'), 'xz_', 'p', $showPayCols);
//			$pays = $orderObj->getAllByJoin($dateConds, $payJoin, $showPayCols, 0, 0, $total, '', true);
			
			$payObj = ModelBase::getInstance('pay_log', 'xz_');
			$payConds = appendLogicExp('SendTime', '>=', date('YmdHis',$sdate));
			$payConds = appendLogicExp('SendTime', '<=', date('YmdHis',$edate), 'AND', $payConds);
			$pays = $payObj->getAll($payConds, 0, 0, $total, array('SendTime'=>'desc'));
			$output['pay1_sql'] = $payObj->getLastSql();
			$output['pay1'] = $pays;
			if (!empty($pays)) {
				foreach ($pays as $pk=>$pv) {
					if (!empty($pv['order_id'])) {
						if (!empty($cdsValues)) {
							$cdsValues .= ',';
						}
	//					$cdsValues .= $pv['my.id'];
						$cdsValues .= $pv['order_id'];
					}
				}
			}
			
			// 线上支付2
//			$dateConds = appendJoinLogicExp('pay_log2', 'SendTime', '>=', date('YmdHis',$sdate), 'AND', 'xz_');
//			$dateConds = appendJoinLogicExp('pay_log2', 'SendTime', '<=', date('YmdHis',$edate), 'AND', 'xz_', $dateConds);
//			$pay2Join = appendJoinExp('pay_log2', 'order_sn', '=', 'order_sn', 'AND', 'inner', 'xz_', 'p2');
//			$showPay2Cols = appendJoinTableExp('lineenertname', array('id'), 'xz_');
//			$pays2 = $orderObj->getAllByJoin($dateConds, $pay2Join, $showPay2Cols);

			$pay2Obj = ModelBase::getInstance('pay_log2', 'xz_');
			$payConds = appendLogicExp('SendTime', '>=', date('YmdHis',$sdate));
			$payConds = appendLogicExp('SendTime', '<=', date('YmdHis',$edate), 'AND', $payConds);
			$pays2 = $pay2Obj->getAll($payConds, 0, 0, $total, array('SendTime'=>'desc'));
			$output['pay2_sql'] = $pay2Obj->getLastSql();
			$output['pay2'] = $pays2;
			if (!empty($pays2)) {
				foreach ($pays2 as $p2k=>$p2v) {
					if (!empty($p2v['order_id'])) {
						if (!empty($cdsValues)) {
							$cdsValues .= ',';
						}
	//					$cdsValues .= $p2v['my.id'];
						$cdsValues .= $p2v['order_id'];
					}
				}
			}
			
			// 线下支付
			$dateConds = appendLogicExp('create_time', '>=', date('Y-m-d H:i:s',$sdate), 'AND');
			$dateConds = appendLogicExp('create_time', '<=', date('Y-m-d H:i:s',$edate), 'AND', $dateConds);
			$reviewObj = ModelBase::getInstance('order_review');
			$reviews = $reviewObj->getAll($dateConds);
			$output['pay3_sql'] = $reviewObj->getLastSql();
			$output['pay3'] = $reviews;
			if (!empty($reviews)) {
				foreach ($reviews as $rk=>$rv){
					if (!empty($rv['order_id'])) {
						if (!empty($cdsValues)) {
							$cdsValues .= ',';
						}
						$cdsValues .= $rv['order_id'];
					}
				}
			}
			if (!empty($cdsValues)) {
				$conds = appendLogicExp('id', 'IN', '('.$cdsValues.')', 'AND', $conds);
			}
		} else if ($dateType === 'start') {
			$dateConds = appendJoinLogicExp('lineactivity', 'startdate', '>=', $sdate, 'AND', 'xz_');
			$dateConds = appendJoinLogicExp('lineactivity', 'startdate', '<=', $edate, 'AND', 'xz_', $dateConds);
			$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
			
			// 线路表
			$activityJoin = appendJoinExp('lineactivity', 'hdid', '=', 'id', 'AND', 'inner', 'xz_', 'a');
			$showPay2Cols = appendJoinTableExp('lineenertname', array('id'), 'xz_');
			$activitys = $orderObj->getAllByJoin($dateConds, $activityJoin, $showPay2Cols);
			if (!empty($activitys)) {
				foreach ($activitys as $ak=>$av){
					if (!empty($cdsValues)) {
						$cdsValues .= ',';
					}
					$cdsValues .= $av['my.id'];
				}
			}
			
			if (!empty($cdsValues)) {
				$conds = appendLogicExp('id', 'IN', '('.$cdsValues.')', 'AND', $conds);
			}
		}
		$output['cds_valstr'] = $cdsValues;		
		return $conds;
	}
	
	// 获取列表
	private function getEspecialConds($sessionKey, $robotEnable, &$outputCDS) {
		$cds = $this->getFindListCDS($sessionKey);
		$cd = $cds['list'];	
		$outputCDS['cds'] = $cds;
		
		if (!empty($cd['lineid']) && !empty($cd['newline'])) {
			$cd['bind_lineid'] = $cd['lineid'];
			unset($cd['lineid']);
		}
		
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$lineCols = $orderObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$colCDS = coll_elements_giveup($lineCols, $cd);
		$conds = MyHelp::getLogicExp($colCDS, '=', 'AND');
		
//		if($cds['find'] === 'order'){
			if (!empty($cd['date_type']) && !empty($cd['sdate']) && !empty($cd['edate'])){
				$dateConds = $this->getFindListDateConds($cd['date_type'],$cd['sdate'],$cd['edate'],$errMsg, $dtOutput);
				if (!empty($dateConds)) {
					$conds = array_merge($conds, $dateConds);	
				}
				$outputCDS['errMsg'] = $errMsg;
				$outputCDS['date_output'] = $dtOutput;
			}
			
			if (array_key_exists('order_sn_like', $cd)) {				
				$conds = appendLogicExp('order_sn', 'LIKE', '%'.$cd['order_sn_like'].'%', 'AND', $conds);
			}
						
			if (array_key_exists('uname', $cd)) {
				$userObj = ModelBase::getInstance('user');
				$users = $userObj->getAll(appendLogicExp('username', 'LIKE', '%'.$cd['uname'].'%'));					
				$uids = '';
				foreach ($users as $uk=>$uv) {
					if (!empty($uids)) {
						$uids .= ',';
					}
					$uids .= $uv['id']; // 新表用户
					if (!empty($uv['uid'])) {
						$uids .= ','.$uv['uid']; // ucenter用户
					}
					if (!empty($uv['mid'])) {
						$uids .= ','.$uv['mid']; // 就表用户
					}
				}
				if (!empty($uids)) {
					$conds = appendLogicExp('userid', 'IN', '('.$mids.')', 'AND', $conds);	
				}
			}
			
			if (array_key_exists('my_names', $cd)) {
				$conds = appendLogicExp('names', 'LIKE', '%'.$cd['my_names'].'%', 'AND', $conds);
			}
			
			if (array_key_exists('cash_func_id', $cd)) {
				$orderReviewObj = ModelBase::getInstance('order_review');
				$orderReviews = $orderReviewObj->getAll(appendLogicExp('cash_func_id'));
				foreach ($orderReviews as $k=>$v) {
					$cashFuncConds = appendLogicExp('id', '=', $v['order_id'], 'OR', $cashFuncConds);
				}
				if (!empty($cashFuncConds)) {
					$conds = appendLogicExp('cash_func', '=', $cashFuncConds, 'AND', $conds);
				}			
			}
//		} else if($cds['find'] === 'line') {
			// 查询关联的旧线路
			if (array_key_exists('bind_lineid', $cd)) {
				$newLine = BackLineHelp::getLine(appendLogicExp('id', '=', $cd['bind_lineid']),false);
				if (empty($newLine)) {
					$conds = appendLogicExp('lineid', '=', $cd['bind_lineid'], 'AND', $conds);
				} else {
					if (!empty($newLine['old_pc_line'])) {
						$pcLine = json_decode($newLine['old_pc_line'],true);
						$bindLineConds = appendLogicExp('lineid', '=', $pcLine['id'], 'OR', $bindLineConds);	
					}
					if (!empty($newLine['old_phone_line'])) {
						$phoneLine = json_decode($newLine['old_phone_line'],true);
						$bindLineConds = appendLogicExp('lineid', '=', $phoneLine['id'], 'OR', $bindLineConds);	
					}
					if (empty($bindLineConds)) {
						$conds = appendLogicExp('lineid', '=', $cd['bind_lineid'], 'AND', $conds);
					} else {
						$bindLineConds = appendLogicExp('lineid', '=', $cd['bind_lineid'], 'OR', $bindLineConds);
						$conds = appendLogicExp('line', '=', $bindLineConds, 'AND', $conds);
					}
				}
			}
//			
//		} else if($cds['find'] === 'member') {			
			if (array_key_exists('member_name', $cd)) {
				$mconds = appendLogicExp('ct_names', 'LIKE', '%'.$cd['member_name'].'%', 'OR', $mconds);
				$m1Conds = appendLogicExp('name', 'LIKE', '%'.$cd['member_name'].'%', 'AND', $m1Conds);
			}
			
			if (array_key_exists('member_tel', $cd)) {
				$mconds = appendLogicExp('ct_sjnum', 'LIKE', '%'.$cd['member_tel'].'%', 'OR', $mconds);
				$m1Conds = appendLogicExp('tel', 'LIKE', '%'.$cd['tel'].'%', 'AND', $m1Conds);
			}
			
			if (array_key_exists('member_certificate', $cd)) {
				$mconds = appendLogicExp('ct_zjcode', 'LIKE', '%'.$cd['member_certificate'].'%', 'OR', $mconds);
				$m1Conds = appendLogicExp('certificate_num', 'LIKE', '%'.$cd['member_certificate'].'%', 'AND', $m1Conds);
			}
			if (!empty($m1Conds)) {
				$outputCDS['member_conds'] = $m1Conds;
				$memberObj = ModelBase::getInstance('signup_member');
				$members = $memberObj->getAll($m1Conds);
				$outputCDS['member_sql'] = $memberObj->getLastSql();
				$mids = '';
				foreach($members as $mk=>$mv) {
					if (!empty($mids)) {
						$mids .= ',';
					}
					$mids .= $mv['order_id'];
				}
				if (!empty($mids)) {
					$mconds = appendLogicExp('id', 'IN', '('.$mids.')', 'OR', $mconds);
				}
			}
			if (!empty($mconds)) {
				$conds = appendLogicExp('member', '=', $mconds, 'AND', $conds);	
			}			
//		}
		$conds = appendLogicExp('order_sn', '!=', '', 'AND', $conds);
		
		// 是否显示人气		
		if ($robotEnable === true && $cds['robot'] === 'filter') {
			$conds = appendLogicExp('names', 'NOT LIKE', '%人气%', 'AND', $conds);
		}
		
		// 各自站点订单
		$admin = MyHelp::getLoginAccount(false);
		if (is_error($admin) === false) {
			if ($admin['station_id_data']['key'] !== 'main') {
				$conds = appendLogicExp('station_id', '=', $admin['station_id'], 'AND', $conds);
			}
		}
		
		return $conds;
	}
	
	// 填充查询数据
	private function fillTypeList($aa, $sessionKey) {
		$totalCount = 0;		
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$colNames = $orderObj->getUserDefine(ModelBase::DF_COL_NAMES);	
		$sortCols = MyHelp::getDataTableSortCol($aa);
		$sortCols = coll_elements_giveup($colNames,$sortCols);		
		$sortDesc = strcasecmp($aa['sSortDir_0'],'desc')==0 ? true : false;
		
		$output = array();
		
		$conds = $this->getEspecialConds($sessionKey, true, $outputCDS);		
		$data['output_cds'] = $outputCDS;
		$data['conds'] = $conds;
		$ds = $orderObj->getAllByCdStr($conds, $aa['iDisplayStart'], $aa['iDisplayLength'], $totalCount, 'addtime', true, $output);		
		$data['sql'] = $orderObj->getLastSql();
		
		if (empty($ds)) {
			$ds = array();
		}		
		
		// 填充数据		
		if (!is_error($ds)){
			// 获取所有订单状态
			$orderStates = BackOrderHelp::getOrderStateList('order');
			if (!empty($orderStates)) {
				foreach ($orderStates as $k => $v) {
					$states[$v['id']] = array('key'=>$v['type_key'], 'desc'=>$v['type_desc']);
					if ($v['type_key'] === 'pay_advance' || $v['type_key'] === 'pay_part' || $v['type_key'] === 'pay_complate' || $v['type_key'] === 'pay_complate1') {
						
						$stateColors[$v['id']] = '#f41507';
					} else if ($v['type_key'] === 'review') {
						
						$stateColors[$v['id']] = '#356b0b';	
					} else if ($v['type_key'] === 'unjoin') {
						
						$stateColors[$v['id']] = '#c97f10';	
					} else {
						
						$stateColors[$v['id']] = '#0a0909';		
					} 			 
				}
			}
						
			// 填充数据
			$fill = array('line'=>true, 'batch'=>array('cut_money'=>true), 'money'=>true, 'from'=>true, 'station'=>true, 'state'=>true, 'account'=>true);
			$ds = BackOrderHelp::fillNewOrderInfo($ds, $fill, $fillOut);
			$data['fill_out'] = $fillOut;
			foreach($ds as $dk=>$dv) {
				// 下单人信息
				$dv['userid_show_text'] = $dv['userid_data']['show_name'].'('.$dv['userid_data']['account_type']['type_desc'].')';
				
				// 线路显示
				$dv['lineid_show_text'] = $dv['lineid_title'] . '<br>' . $dv['hdid_show_text'];		
				
				// 线路单人价格
				if ($dv['new_order'] == 1) {
					$dv['price'] = '原价(成人:'.$dv['hdid_priceadult'].'/儿童:'.$dv['hdid_pricechild'].')<br>';
					$dv['price'] .= '折后(成人:'.$dv['hdid_data']['adult_cut'].'/儿童:'.$dv['hdid_data']['child_cut'].')';
				} else {
					$dv['price'] = '成人:'.$dv['hdid_priceadult'].'/儿童:'.$dv['hdid_pricechild'];
				}
				
				// 线路订单价格
				if ($dv['new_order'] == 1) {
					$dv['sum_price'] = '团费折后:'.$dv['team_cut_price'].'<br>订单总价:'.$dv['need_pay_money'];
				} else {
					$sumPrice = intval($dv['male']) + intval($dv['woman']) * floatval($dv['hdid_priceadult']) + intval($dv['child']) * floatval($dv['hdid_pricechild']);
					$dv['sum_price'] = '团费:'.$sumPrice.'<br>订单总价:'.$dv['need_pay_money'];
				}
				
				// 订单预计参团人数
				$dv['member_count'] = '成人男:'.$dv['male'].'<br>成人女:'.$dv['woman'].'<br>儿童:'.$dv['child'];
				
				// 订单参团人信息是否已完善
				$memberCount = BackOrderHelp::getOrderMemberCountFromData($dv, false);
				$memberRealCount = BackOrderHelp::getOrderMemberCountFromData($dv, true);
				$compated = intval($memberCount) - intval($memberRealCount);
				if ($compated == 0) {
					$members = BackOrderHelp::getOrderMembers($dv['id']);
					foreach ($members as $mk=>$mv) {
						if (empty($mv['name']) || empty($mv['tel']) || empty($mv['certificate_num'])) {
							$compated = 1;
							break;
						}
					}
				}
				$dv['member_complated'] = $compated;
				
				// 下单时间
				$dv['addtime_show_text'] = date('Y年m月d日 H:i:s', $dv['addtime']);
							
				// 订单状态下的特殊表现
				$dv['zhuangtai_show_btn_account'] = 'hide';
				if (!empty($states)) {
					$sta = $states[$dv['zhuangtai']];
					$dv['zhuangtai_type_desc'] = $sta['desc'];	
					$dv['zhuangtai_color'] = $stateColors[$dv['zhuangtai']];		
					// 不显示操作财务审核
					if ($sta['key'] !== 'unreview' && $sta['key'] !== 'complated' && $sta['key'] !== 'invalid' && $sta['key'] !== 'canceled' && 
						$sta['key'] !== 'paying' && $sta['key'] !== 'refunding' && $sta['key'] !== 'info_changing') {						
						$dv['zhuangtai_show_btn_account'] = 'show';
					}
				}				
				$ds[$dk] = $dv;
			}		
		}
		
		if (count($ds) > 0) {
			$colNames = array();
			foreach ($ds[0] as $dataKey=>$dataVal) {
				array_push($colNames, $dataKey);
			}
		}
 			
		$data['sColumns'] = $colNames;
		$data['sEcho'] = $aa['sEcho'];	
		$data['iDisplayStart'] = $aa['iDisplayStart'];
		$data['iDisplayLength'] = $aa['iDisplayLength'];
		$data['iTotalRecords'] = $totalCount;
		$data['iTotalDisplayRecords'] = $totalCount;
		$data['aaData'] = $ds;		
		$data['result'] = error(0,"");
		$data['robot'] = $output['robot'];
		if (is_error($ds)) {
			$data['result'] = $ds;
		}
		return $data;
	}
	
	private function fillTypeList1($aa, $sessionKey) {
		$totalCount = 0;		
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$colNames = $orderObj->getUserDefine(ModelBase::DF_COL_NAMES);	
		$sortCols = MyHelp::getDataTableSortCol($aa);
		$sortCols = coll_elements_giveup($colNames,$sortCols);		
		$sortDesc = strcasecmp($aa['sSortDir_0'],'desc')==0 ? true : false;
		
		$output = array();
		
		$conds = $this->getEspecialConds($sessionKey, true, $outputCDS);		
		$data['output_cds'] = $outputCDS;
		$data['conds'] = $conds;
		$ds = $orderObj->getAllByCdStr($conds, $aa['iDisplayStart'], $aa['iDisplayLength'], $totalCount, 'addtime', true, $output);		
		$data['sql'] = $orderObj->getLastSql();
		
		if (empty($ds)) {
			$ds = array();
		}		
		
		// 填充数据		
		if (!is_error($ds)){
			// 获取所有订单状态
			$orderStates = BackOrderHelp::getOrderStateList('order');
			if (!empty($orderStates)) {
				foreach ($orderStates as $k => $v) {
					$states[$v['id']] = array('key'=>$v['type_key'], 'desc'=>$v['type_desc']);
					if ($v['type_key'] === 'pay_advance' || $v['type_key'] === 'pay_part' || $v['type_key'] === 'pay_complate' || $v['type_key'] === 'pay_complate1') {
						
						$stateColors[$v['id']] = '#f41507';
					} else if ($v['type_key'] === 'review') {
						
						$stateColors[$v['id']] = '#356b0b';	
					} else if ($v['type_key'] === 'unjoin') {
						
						$stateColors[$v['id']] = '#c97f10';	
					} else {
						
						$stateColors[$v['id']] = '#0a0909';		
					} 			 
				}
			}
						
			// 填充数据
			$fill = array('line'=>true, 'batch'=>array('cut_money'=>true), 'money'=>true, 'from'=>true, 'station'=>true, 'state'=>true, 'account'=>true);
			$ds = BackOrderHelp::fillNewOrderInfo($ds, $fill, $fillOut);
			$data['fill_out'] = $fillOut;
			foreach($ds as $dk=>$dv) {
				// 下单人信息
				$dv['userid_show_text'] = $dv['userid_data']['show_name'].'('.$dv['userid_data']['account_type']['type_desc'].')';
				
				// 线路显示
				$dv['lineid_show_text'] = $dv['lineid_title'] . '<br>' . $dv['hdid_show_text'];		
				
				// 线路单人价格
				if ($dv['new_order'] == 1) {
					$dv['price'] = '原价(成人:'.$dv['hdid_priceadult'].'/儿童:'.$dv['hdid_pricechild'].')<br>';
					$dv['price'] .= '折后(成人:'.$dv['hdid_data']['adult_cut'].'/儿童:'.$dv['hdid_data']['child_cut'].')';
				} else {
					$dv['price'] = '成人:'.$dv['hdid_priceadult'].'/儿童:'.$dv['hdid_pricechild'];
				}
				
				// 线路订单价格
				if ($dv['new_order'] == 1) {
					$dv['sum_price'] = '团费折后:'.$dv['team_cut_price'].'<br>订单总价:'.$dv['need_pay_money'];
				} else {
					$sumPrice = intval($dv['male']) + intval($dv['woman']) * floatval($dv['hdid_priceadult']) + intval($dv['child']) * floatval($dv['hdid_pricechild']);
					$dv['sum_price'] = '团费:'.$sumPrice.'<br>订单总价:'.$dv['need_pay_money'];
				}
				
				// 订单预计参团人数
				$dv['member_count'] = '成人男:'.$dv['male'].'<br>成人女:'.$dv['woman'].'<br>儿童:'.$dv['child'];
				
				// 订单参团人信息是否已完善
				$memberCount = BackOrderHelp::getOrderMemberCountFromData($dv, false);
				$memberRealCount = BackOrderHelp::getOrderMemberCountFromData($dv, true);
				$compated = intval($memberCount) - intval($memberRealCount);
				if ($compated == 0) {
					$members = BackOrderHelp::getOrderMembers($dv['id']);
					foreach ($members as $mk=>$mv) {
						if (empty($mv['name']) || empty($mv['tel']) || empty($mv['certificate_num'])) {
							$compated = 1;
							break;
						}
					}
				}
				$dv['member_complated'] = $compated;
				
				// 下单时间
				$dv['addtime_show_text'] = date('Y年m月d日 H:i:s', $dv['addtime']);
							
				// 订单状态下的特殊表现
				$dv['zhuangtai_show_btn_account'] = 'hide';
				if (!empty($states)) {
					$sta = $states[$dv['zhuangtai']];
					$dv['zhuangtai_type_desc'] = $sta['desc'];	
					$dv['zhuangtai_color'] = $stateColors[$dv['zhuangtai']];		
					// 不显示操作财务审核
					if ($sta['key'] !== 'unreview' && $sta['key'] !== 'complated' && $sta['key'] !== 'invalid' && $sta['key'] !== 'canceled' && 
						$sta['key'] !== 'paying' && $sta['key'] !== 'refunding' && $sta['key'] !== 'info_changing') {						
						$dv['zhuangtai_show_btn_account'] = 'show';
					}
				}				
				$ds[$dk] = $dv;
			}		
		}
		
		if (count($ds) > 0) {
			$colNames = array();
			foreach ($ds[0] as $dataKey=>$dataVal) {
				array_push($colNames, $dataKey);
			}
		}
 			
		$data['sColumns'] = $colNames;
		$data['sEcho'] = $aa['sEcho'];	
		$data['iDisplayStart'] = $aa['iDisplayStart'];
		$data['iDisplayLength'] = $aa['iDisplayLength'];
		$data['iTotalRecords'] = $totalCount;
		$data['iTotalDisplayRecords'] = $totalCount;
		$data['aaData'] = $ds;		
		$data['result'] = error(0,"");
		$data['robot'] = $output['robot'];
		if (is_error($ds)) {
			$data['result'] = $ds;
		}
		return $data;
	}
	
	// 外部接口
	public function getOrderListAction() {
		if (IS_POST) {
			$aa = $_POST;
			session('external_list_cds', $aa['cds']);
			$data = $this->fillTypeList($aa, 'external_list_cds');			
		} else {
			$data['result'] = error(-1, '错误的请求类型');
		}
		return $this->ajaxReturn($data);
	}
	
	// 类型列表	
	protected function typeList($aa) {		
		G('begin');		
		session_start();
		if (empty($aa['test'])) {
			$data = $this->fillTypeList($aa, 'order_list_cds');	
		} else {
			$data = $this->fillTypeList1($aa, 'order_list_cds');
		}
		session('order_excel_export', $data['aaData']);
		G('end');
		$data['load_second'] = G('begin', 'end').'s';
		$this->ajaxReturn($data);		
	}
	
	// 查找类型
	protected function typeFind($aa) {	
		if (IS_POST) {
			$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
			$orderCols = $orderObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$cdCols = coll_elements_giveup($orderCols, $aa);						
			$conds = MyHelp::getLogicExp($cdCols);
			
			$admin = MyHelp::getLoginAccount(false);
			if (is_error($admin) === false) {
				if ($admin['station_id_data']['key'] !== 'main') {
					$conds = appendLogicExp('station_id', '=', $admin['station_id'], 'AND', $conds);
				}
			}
			
			$order = $orderObj->getOne($conds);
			if (empty($order)) {
				$data['result'] = error(-1, '未能查找到订单信息'.$aa['id']);
				return $this->ajaxReturn($data);
			}
			
			// 用户名
			$userObj = ModelBase::getInstance('member', 'xz_');
			$user = $userObj->getOne(appendLogicExp('id', '=', $order['userid']));
			if (!empty($user)) {
				$order['userid_userid'] = $user['userid'];
			}
			
			$data['ds'] = $order;
		} else {
			$data['result'] = error(-1, '错误的请求方式');
		}
		if (array_key_exists('id', $aa)) {
			$cds = appendLogicExp('id', '=', $aa['id']);
			$grantObj = ModelBase::getInstance('grant');
			$grant = $grantObj->getOne($cds);
			
			// 填充数据		
			$typeObj = ModelBase::getInstance('grant_type');
			if (!empty($grant)) {
				$cds = appendLogicExp('id', '=', $dv['type_id']);
				$typeData = $typeObj->getOne($cds);
				if (!empty($typeData)) {
					$grant['type_id.type_desc'] = $typeData['type_desc'];
				}				
			}
			$data['data'] = $grant;
			$data['result'] = error(0,'');			
		} else {
			$data['result'] = error(-1, '参数错误，查找数据失败');
		}
		$this->ajaxReturn($data);
	}
	
	// 显示订单列表
	private function showListPage() {	
		// 设置菜单		
		$this->page_title ='订单列表';
		$this->content_title = $contentTitle;
		$this->content_des = '这里你可以查看并管理客户的订单';
		$this->_setMenuLinkCurrent($contentTitle,'order_list');
		$this->_initTemplateInfo();	
		
		// 订单来源
		$orderFrom = BackOrderHelp::cacheOrderFrom();
		if (is_error($orderFrom) === false) {
			$this->assign('OrderFrom', $orderFrom);
		}
		
		// 订单状态
		$orderState = BackOrderHelp::getOrderStateList('order');
		if (is_error($orderState) === false) {
			$this->assign('OrderState', $orderState);
		}
		
		// 费用功能
		$cashFunc = BackReviewHelp::cashFuncKey2Value();
		if (is_error($cashFunc) === false) {
			$this->assign('CashFunc', $cashFunc);
		}
		
		// 所属站点
		$stationObj = ModelBase::getInstance('station_info');
		$stations = $stationObj->getAll();
		$this->assign('Stations', $stations);
		
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		
		$this->assign('grant_review', check_grant('submit_finance_review'));
				
		$this->assign('ajaxReqUrl', U('order/list'));
		$op = I('get.test', false);				
		if (!empty($op)) {
			$this->showPage('list1', 'order_list1', 'order', '订单列表1', '订单列表1');
		} else {
			$this->showPage('list', 'order_list', 'order', '订单列表', '订单列表');
		}			
	}
	
	private function statisticsOrder($aa) {				
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$conds = $this->getEspecialConds('order_list_cds', false, $outputCDS);
		
		$states = BackOrderHelp::getOrderStateList('order');
		if (is_error($states) === true) {
			$data['result'] = $states;
			return $this->ajaxReturn($data);
		}
				
		$orderCount = 0;
		$robotCount = 0;
		foreach ($states as $sk=>$sv) {
			$statistics[$sv['id']]['count'] = 0;
			$statistics[$sv['id']]['robot'] = 0;
			$statistics[$sv['id']]['desc'] = $sv['type_desc'];
			
			// 获取订单状态下的数量
			$stateCDS = appendLogicExp('zhuangtai', '=', $sv['id'], 'AND', $conds);
			$statistics[$sv['id']]['count'] += $orderObj->getCount($stateCDS);
			$orderCount += $statistics[$sv['id']]['count'];
			// 获取订单状态下的人气数量
			$stateCDS = appendLogicExp('names', 'LIKE', '%人气', 'AND', $stateCDS);
			$statistics[$sv['id']]['robot'] += $orderObj->getCount($stateCDS);
			$robotCount += $statistics[$sv['id']]['robot'];		
		}
		
		$data['total'] = $orderCount;
		$data['robot'] = $robotCount;
		
		$ds = array();
		foreach ($statistics as $stk=>$stv) {
			$st['tab'] = 'order';
			$st['search_ctrls'] = 'order_state';
			$st['search_vals'] = $stk;
			$st['show_text'] = $stv['desc'].':'.$stv['count'].'  人气:'.$stv['robot'];		
			array_push($ds,$st);
		}
		$data['ds'] = $ds;		
		$this->ajaxReturn($data);				
	}
	
	// 订单列表
	public function listAction() {		
		if (IS_POST) {	
			$aa = $_POST;
			if (isset($aa['op_type'])) {
				$opType = $aa['op_type'];
				if ($opType == 'find') {
					$this->typeFind($aa);
				} else if ($opType == 'list') {
					$this->typeList($aa);
				} else if ($opType == 'cddata'){
					session_start();
					session('order_list_cds', $aa['cds']);
				} else if ($opType == 'statistics'){
					$this->statisticsOrder($aa);
				} else{
					$data['result'] = error(-1, '未知的类型动作请求');
					$this->ajaxReturn($data);
				}
			} else {
				$data['result'] = error(-1, '获取类型动作失败');
				$this->ajaxReturn($data);
			}			
		} else {
			$this->showListPage();
		}
	}
	
//	// 给没有ID的参团人填充ID
//	private function checkMemberId($orderId) {		
//		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
//		$order = $orderObj->getOne(appendLogicExp('id', '=', $orderId));
//		if (empty($order)) {
//			return error(-1, '填充参团人ID失败，没有找到订单的信息');
//		}		
//		
//		// 旧数据
//		$ids = explode('&nbsp;', $order['ct_ids']);
//		$names = explode('&nbsp;', $order['ct_names']);
//		// 填充旧数据的参团人员编号
//		$saveMaxId = 0; $maxId = 0;
//		// 获取最大参团人ID
//		foreach ($ids as $k=>$v) {
//			if (intval($v) > $saveMaxId) {
//				$saveMaxId = $v;
//			}
//		}
//		
//		$bSaveData = false;
//		// 填充参团人Id		
//		$maxId = $saveMaxId + 1;
//		for($idx = 0; $idx < count($names); $idx++){
//			if (empty($ids[$idx])) {
//				$bSaveData = true;
//				$ids[$idx] = $maxId;
//				$maxId ++;
//			}
//			$idsstr .= $idx === 0 ? '' : '&nbsp;';
//			$idsstr .= $ids[$idx];
//		}
//		// 保存参团人Id数据
//		if ($bSaveData === true) {
//			return $orderObj->modify(array('ct_ids'=>$idsstr), appendLogicExp('id', '=', $orderId));
//		}
//	}
	
//	private function FindOrderOld2New($orderId) {
//		// 1.参团人类型数量分拆
//		$memberTypeObj = ModelBase::getInstance('member_type');
//		$memberTypes = $memberTypeObj->getAll();
//		$memberTypeMap = array();
//		foreach($memberTypes as $k => $v){
//			$memberTypeMap[$v['type_key']] = $v['id'];
//		}
//		
//		// 2.参团人信息分拆
//		$certificateObj = ModelBase::getInstance('certificate_type');
//		$certTypes = $certificateObj->getAll();
//		$certTypeMap = array();
//		foreach ($certTypes as $k => $v) {
//			$certTypeMap[$v['type_desc']] = array('id'=>$v['id'], 'desc'=>$v['type_desc']);
//		}
//		$certTypeMap['通行证'] = $certTypeMap['护照'];
//		
//		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
//		$order = $orderObj->getOne(appendLogicExp('id', '=', $orderId));
//		if (!empty($order)) {			
//			// 联系人证件类型
//			foreach ($certTypes as $k => $v) {
//				if ($v['id'] == $order['certificate_type_id']) {
//					$order['certificate_type_id_type_desc'] = $v['type_desc'];
//					break;
//				}
//			}
//		
//			/////////////////////////////////////////////////////
//			// 报名人员信息
//			// 新数据
//			$memberObj = ModelBase::getInstance('signup_member');
//			$members = $memberObj->getAll(appendLogicExp('order_id', '=', $orderId));
//			if (empty($member)) {
//				$members = array();
//			} 
//			
//			$ids = explode('&nbsp;', $order['ct_ids']);
//			$names = explode('&nbsp;', $order['ct_names']);
//			$certs = explode('&nbsp;', $order['ct_zhengjian']);
//			$codes = explode('&nbsp;', $order['ct_zjcode']);
//			$research = explode('&nbsp;', $order['ct_diaocha']);
//			$types = explode('&nbsp;', $order['ct_types']);
//			$tels = explode('&nbsp;', $order['ct_sjnum']);
//			$exits = explode('&nbsp;', $order['ct_exits']);
//				
//			for($k = 0; $k < count($names); $k++){				
//				if (empty($names[$k]) || !empty($exits[$k])) {
//					continue;
//				}
//				// 报名人信息拆分
//				$memberInfoData = array();
//				$memberInfoData['order_id'] = $order['id'];
//				$memberInfoData['id'] = $ids[$k];
//				$memberInfoData['name'] = $names[$k];
//				$memberInfoData['tel'] = empty($tels[$k])?'0':$tels[$k];
//				$memberInfoData['user_id'] = $order['userid'];
//				$memberInfoData['type_id'] = empty($types[$k])?'0':$types[$k];
//				
//				// 从名字识别男女
//				if (empty($types[$k])) {
//					if (stripos($names[$k], '男') !== false) {
//						$memberInfoData['type_id'] = $memberTypeMap['adult_man'];
//					} else if (stripos($names[$k], '女') !== false) {
//						$memberInfoData['type_id'] = $memberTypeMap['adult_woman'];
//					} else if (stripos($names[$k], '小孩') !== false) {
//						$memberInfoData['type_id'] = $memberTypeMap['child'];
//					}
//				}
//				
//				// 参团人类型
//				if (empty($memberInfoData['type_id'])) {
//					$memberInfoData['type_id_type_desc'] = '未知';
//				} else {
//					foreach($memberTypes as $tk => $tv){
//						if ($tv['id'] == $memberInfoData['type_id']) {
//							$memberInfoData['type_id_type_desc'] = $tv['type_desc'];
//						}
//					}
//				}
//				
//				$memberInfoData['research'] = empty($research)?'':$research[$k];
//				
//				// 证件划分
//				foreach($certTypeMap as $ck=>$cv)  {
//					if (stripos($certs[$k], $ck) !== false) {
//						$memberInfoData['certificate_type_id'] = $cv['id'];
//						$memberInfoData['certificate_type_id_type_desc'] = $cv['desc'];					
//						$memberInfoData['certificate_num'] = empty($codes[$k])?'':$codes[$k];
//						break;
//					}
//				}
//				
//				// 处理证件号码写到类型字段中的情况，无证件类型，默认身份证
//				if (empty($memberInfoData['certificate_type_id'])) {						
//					$cert_type = intval($certs[$k]);
//					if ($cert_type != 0) {
//						$memberInfoData['certificate_type_id'] = $certTypeMap['身份证']['id'];
//						$memberInfoData['certificate_type_id_type_desc'] = $certTypeMap['身份证']['desc'];	
//						$memberInfoData['certificate_num'] = empty($certs[$k])?'':$certs[$k];
//					}
//				}
//				array_push($members, $memberInfoData);
//			}
//			
//			$order['members'] = $members;
//			$memberCount =  BackOrderHelp::getOrderMemberCountFromData($order);
//			if (is_error($memberCount) === false) {
//				$order['member_sub_count'] = intval($memberCount) - count($members);	
//			} else {
//				$order['member_sub_count'] = 0;
//			}
//		}		
//		return $order;
//	}
		
	private function showInfoPage() {
		$orderId = I('get.id', false);
		$channel = I('get.ch', 0);
		
		// 订单来源
		$orderFrom = BackOrderHelp::cacheOrderFrom('id');
		if (is_error($orderFrom) === false) {
			$this->assign('orderFrom', $orderFrom);
		}
		
		// 订单状态
		$orderState = BackOrderHelp::getOrderStateList('order');
		if (!empty($orderState)) {
			$this->assign('orderState', $orderState);
		}
		
		// 审阅类型
		$reviewTypes = BackReviewHelp::cacheReviewType('id');
		if (is_error($reviewTypes) === false) {
			$this->assign('ReviewType', $reviewTypes);
		}
			
		// 费用用途
		$cashUses = BackReviewHelp::cacheCashUseType('id');
		if (is_error($cashUses) === false) {
			$this->assign('CashUse', $cashUses);
		}
		
		// 费用功能
		$cashFuncs = BackReviewHelp::cacheCashFuncType('id');
		if (is_error($cashFuncs) === false) {
			$this->assign('CashFunc', $cashFuncs);
		}
		
		// 获取根菜单
		$menuItemRoots = MyHelp::getMenuList('pay_menu', 0);
		if (!empty($menuItemRoots)) {
			$this->assign('MenuItem', $menuItemRoots);
		}		
		
		// 成员类型
		$memberTypeKeyMap = BackOrderHelp::cacheMemberType();
		
		// 证件类型
		$certType = BackOrderHelp::cacheCertType('id');
		if (is_error($certType) === false) {
			$this->assign('certType', $certType);
		}
				
		$update_order_line = check_grant('update_order_line');
		$improve_order = check_grant('improve_order');
		// 编辑详细		
		if (!empty($orderId)) {
			// 查询订单
			$order = BackOrderHelp::getOrderInfo($orderId);			
			if (!empty($order)) {						
				// 新旧参团人转换，先转换，再填充					
				$result = BackOrderHelp::memberTableChangeOld2New($order, $memberIds);
				if (is_error($result) === true) {
					$this->assign('change_member_result', $result);	
				}
				
				// 渠道订单判断
				$order_sn = BackOrderHelp::getRealOrderSN($order['order_sn'], $order_sn_prefix);
				if ($order_sn_prefix == 'QD') {
					$channel = 1;
				}
			
				// 填充参团人信息
				$fill = array(
					'line'=>true, 
					'batch'=>array('cut_money'=>true),
					'taocan'=>array('taocan'=>true), 
					'from'=>true, 
					'state'=>true, 
					'money'=>true,
					'account'=>true, 
					'use_coupon'=>true,
					'member'=>true,
					'extra_cash'=>true, 
					'order_coupon'=>true,
					'order_message'=>true,
					'pay_online'=>true,
					'pay_offline'=>true,
					'supervise'=>true);
				$order = BackOrderHelp::fillNewOrderInfo($order, $fill);
				
				// 下单人信息
				$dv['userid_show_text'] = $dv['userid_data']['show_name'].'('.$dv['userid_data']['account_type']['type_desc'].')';				
				// 线路显示
				$dv['lineid_show_text'] = $dv['lineid_title'] . '<br>' . $dv['hdid_show_text'];
				// 下单时间
				$dv['addtime_show_text'] = date('Y年m月d日 H:i:s', $dv['addtime']);		
										
							
				// 订单状态下的特殊表现
				$dv['zhuangtai_show_btn_account'] = 'hide';
				if (!empty($states)) {
					$sta = $states[$dv['zhuangtai']];
					$dv['zhuangtai_type_desc'] = $sta['desc'];	
					$dv['zhuangtai_color'] = $stateColors[$dv['zhuangtai']];		
					// 不显示操作财务审核
					if ($sta['key'] !== 'unreview' && $sta['key'] !== 'complated' && $sta['key'] !== 'invalid' && $sta['key'] !== 'canceled' && 
						$sta['key'] !== 'paying' && $sta['key'] !== 'refunding' && $sta['key'] !== 'info_changing') {						
						$dv['zhuangtai_show_btn_account'] = 'show';
					}
				}	
				
				// 小包团线路
				if ($order['lineid_data_type'] == 'team') {
					// 小包团不允许改团
					$update_order_line = false;	
//					// 小包团不允许完善信息	
//					$improve_order = false;
					
				// 老线路
				} else if ($order['lineid_data_type'] == 'archives') {
					
				// 新线路
				} else if ($order['lineid_data_type'] == 'line') {		
					// 可用套餐
					$taocans = BackLineHelp::getLineTaocan($order['lineid'], $order['hdid']);
					if (!empty($taocans)) {
						$taocanTypeList = array();
						foreach ($taocans as $tk=>$tv) {
							$tcType = $tv['type_data'];
							$typeData = $taocanTypeList[$tcType['type_key']];
							if (empty($typeData)) {
								$typeData['type'] = $tcType;
								$typeData['data'] = array($tv);
							} else {
								array_push($typeData['data'], $tv);	
							}
							$taocanTypeList[$tcType['type_key']] = $typeData;
						}
						$this->assign('taocan_types', $taocanTypeList);
					}					
				}
				
				// 填充付款方式
				foreach ($order['pays_offline'] as $pk=>$pv) {
					$pv['pay'] = '';
					if (!empty($pv['pay_type_id_data'])) {
						$pv['pay'] = $pv['pay_type_id_data']['item_desc'];
					}
					if (!empty($pv['pay_channel_id_data'])) {
						if (!empty($pv['pay'])) {
							$pv['pay'] .= '->';
						}
						$pv['pay'] .= $pv['pay_channel_id_data']['item_desc'];
					}
					if (!empty($pv['pay_bank_id_data'])) {
						if (!empty($pv['pay'])) {
							$pv['pay'] .= '->';
						}
						$pv['pay'] .= $dv['pay_bank_id_data']['item_desc'];
					}
					$order['pays_offline'][$pk] = $pv;
				}
				
				// 特殊参团人
				if (!empty($order['oldman'])) {
					$specialMember = '60岁以上80岁以下';
				}
				if (!empty($order['foreigner'])) {
					if (!empty($specialMember)) {
						$specialMember .= ',';
					}
					$specialMember .= '外籍友人';
				}
				if (!empty($order['hk_mc'])) {
					if (!empty($specialMember)) {
						$specialMember .= ',';
					}
					$specialMember .= '港澳同胞';
				}
				if (!empty($specialMember)) {
					$order['special_member'] = '包含'.$specialMember;
				}
				
				
				// 订单参团人信息是否已完善
				$memberCount = BackOrderHelp::getOrderMemberCountFromData($order, false);
				$memberRealCount = BackOrderHelp::getOrderMemberCountFromData($order, true);
				$order['sub_member_count'] = intval($memberCount) - intval($memberRealCount);
				
								
				// 人员类型数量新旧数据
				if ($order['new_order'] == '1') {
					foreach ($memberTypeKeyMap as $k=>$v) {
						if ($k == 'adult_man') {
							$v['count'] = $order['male'];
							$memberTypeKeyMap[$k] = $v;
						} else if ($k == 'adult_woman') {
							$v['count'] = $order['woman'];
							$memberTypeKeyMap[$k] = $v;
						} else if ($k == 'child') {
							$v['count'] = $order['child'];
							$memberTypeKeyMap[$k] = $v;
						}
					}
				} else {
					$memberObj = ModelBase::getInstance('order_member_type_count');
					foreach ($memberTypeKeyMap as $k=>$v) {
						$typeConds = appendLogicExp('order_id', '=', $orderId, 'AND');
						$typeConds = appendLogicExp('type_id', '=', $v['id'], 'AND', $typeConds);
						// 新数据类型人数
						$typeCount = $memberObj->getCount($typeConds);
						if (empty($typeCount)) {
							$typeCount = 0;
							// 老数据类型人数
							if (stripos($v['type_desc'], '男') !== false) {
								$typeCount += intval($order['male']);
							} else if (stripos($v['type_desc'], '女') !== false) {
								$typeCount += intval($order['woman']);
							} else if (stripos($v['type_desc'], '小孩') !== false) {
								$typeCount += intval($order['child']);
							}
						}
						$memberTypeKeyMap[$k]['count'] = $typeCount;
					}
				}								
			}			
			$this->assign('edit', true);		
			$this->assign('modal_data_edit', true);	
		}
		
		// 参团人类型人数
		if (!is_error($memberTypeKeyMap)) {				
			// 基本类型使用
			$listMemberType['adult_man'] = $memberTypeKeyMap['adult_man'];
			$listMemberType['adult_woman'] = $memberTypeKeyMap['adult_woman'];
			$listMemberType['child'] = $memberTypeKeyMap['child'];
			
			// 分房类型使用
			$roomMemberType = array('unknow'=>array('id'=>0, 'type_key'=>'unknow', 'type_desc'=>'未知', 'can_delete'=>0));
			$roomMemberType = array_merge($roomMemberType, $memberTypeKeyMap);
			
			$this->assign('memberType', $listMemberType);
			$this->assign('roomMemberType', $roomMemberType);
		}
				
		if (!empty($order)) {
			$this->assign('order', $order);	
		}
		
		$this->assign('grant_update_order', $update_order_line);
		$this->assign('grant_order_alternate', check_grant('order_alternate'));
		$this->assign('grant_order_cancel_scheduling', check_grant('order_cancel_scheduling'));			
		$this->assign('grant_order_cancel', check_grant('order_cancel'));
		$this->assign('grant_improve', $improve_order);
		$this->assign('grant_force_team', check_grant('force_team_group'));
		$this->assign('grant_improve_QD', stripos($order['order_sn'], 'QD-') !== FALSE ? true : false);
		$this->assign('grant_improve_review', check_grant('review_improve_order'));
		$this->assign('grant_create', check_grant('create_order'));
		$this->assign('grant_send_sms', check_grant('send_order_sms'));
		$this->assign('grant_review', check_grant('submit_finance_review'));
		$this->assign('grant_response_review', check_grant('response_finance_review'));
		
		$this->assign('order_id', $orderId);
		$this->assign('channel', $channel);
		
		
		// 设置菜单				
		$page = empty($orderId)? (empty($channel) ? 'new' : 'channel') : 'info';
		$curPage = empty($channel) ? 'create_order' : 'order_channel';
		$pageTitle = empty($orderId)? (empty($channel) ? '线下订单' : '渠道订单'): '订单详细';
		$pageContent = empty($orderId)? (empty($channel) ? '线下订单' : '渠道订单'): '订单详细';
		$this->showPage($page, $curPage, 'order', $pageTitle, $pageContent, '这里你可以完善或配置订单的详细内容');
	}
			
	// 给新增的参团人分配编号
	private function assignNewMemberId($line, $ds, $newName) {		
		$data['result'] = error(0, '分配成功');
		
		$maleCount = $line['male'];
		$womanCount = $line['woman'];
		$childCount = $line['child'];
		
		// 新增参团人信息分配编号
		if (array_key_exists('ct_ids', $ds)) {
			$saveMaxId = 1; $maxId = 1;
			$lineIds = explode('&nbsp;', $line['ct_ids']);			
			$ids = explode('&nbsp;', $ds['ct_ids']);
			$names = explode('&nbsp;', $ds['ct_names']);
			$types = explode('&nbsp;', $ds['ct_types']);
			$tels = explode('&nbsp;', $ds['ct_sjnum']);
			$zjs = explode('&nbsp;', $ds['ct_zhengjian']);
			$zjNums = explode('&nbsp;', $ds['ct_zjnum']);
			$exits = explode('&nbsp;', $ds['ct_exits']);
			$diaochas = explode('&nbsp;', $ds['ct_diaocha']);
			
			$saveMaxId = 0; $maxId = 0;
			// 获取最大参团人ID
			foreach ($lineIds as $k=>$v) {
				if (intval($v) > $saveMaxId) {
					$saveMaxId = $v;
				}
			}
			
			$bUseNewIds = false;
			// 填充参团人Id
			$maxId = $saveMaxId+1;
			for($idx = 0; $idx < count($names); $idx++){
				if (empty($names[$idx])) {
					continue;
				}	
				
				if (empty($ids[$idx]) || $ids[$idx] === 'undefined') {
					$bUseNewIds = true;
					$ids[$idx] = $maxId;
					$maxId ++;
				}
				$idsstr .= $idx === 0 ? $ids[$idx] : '&nbsp;'.$ids[$idx];
				$namesstr .= $idx === 0 ? $names[$idx] : '&nbsp;'.$names[$idx];
				$typesstr .= $idx === 0 ? $types[$idx] : '&nbsp;'.$types[$idx];
				$telsstr .= $idx === 0 ? $tels[$idx] : '&nbsp;'.$tels[$idx];
				$zjsstr .= $idx === 0 ? $zjs[$idx] : '&nbsp;'.$zjs[$idx];
				$zjNumsstr .= $idx === 0 ? $zjNums[$idx] : '&nbsp;'.$zjNums[$idx];
				$exitsstr .= $idx === 0 ? '0' : '&nbsp;0';
				$dzsstr .= $idx === 0 ? '' : '&nbsp;';		
					
				$type_key = BackOrderHelp::MemberTypeKey2Value($types[$idx]);				
				// 参团人员类型人数判断
				if (is_error($type_key) === false) {
					if (stripos($type_key, 'child') !== false) {
						$childCount --;
					} else if (stripos($type_key, 'woman') !== false) {
						$womanCount --;
					} else if (stripos($type_key, 'man') !== false)  {
						$maleCount --;
					}
				}
					
				if ($maleCount < 0 || $womanCount < 0 || $childCount < 0) {
					$data['result'] = error(-1, '该参团人员类型已达上限');
					return $data;
				}
								
				// 返回新添加的ID给客户端
				if (!empty($newName)) {
					if ($names[$idx] === $newName) {
						$data['new_member_id'] = $ids[$idx];
					}	
				}
			}
			
			$ds['ct_ids'] = $idsstr;
			$ds['ct_names'] = $namesstr;
			$ds['ct_types'] = $typesstr;
			$ds['ct_sjnum'] = $telsstr;
			$ds['ct_zhengjian'] = $zjsstr;
			$ds['ct_zjnum'] = $zjNumsstr;
			$ds['ct_exits'] = $exitsstr;
			$ds['ct_diaocha'] = $dzsstr;
			
			// 添加已退团的人
			$lineNames = explode('&nbsp;', $line['ct_names']);
			$lineTels = explode('&nbsp;', $line['ct_sjnum']);
			$lineZJs = explode('&nbsp;', $line['ct_zhengjian']);
			$lineZJNums = explode('&nbsp;', $line['ct_zjnum']);
			$lineTypes = explode('&nbsp;', $line['ct_types']);
			$lineExits = explode('&nbsp;', $line['ct_exits']);
			$lineDiaochas = explode('&nbsp;', $line['ct_diaocha']);
			for ($v=0; $v < count($lineNames); $v++) {
				if (intval($lineExits[$v]) === 1) {
					$ds['ct_ids'] .= '&nbsp;'.$lineIds[$v];
					$ds['ct_names'] .= '&nbsp;'.$lineNames[$v];
					$ds['ct_sjnum'] .= '&nbsp;'.$lineTels[$v];
					$ds['ct_zhengjian'] .= '&nbsp;'.$lineZJs[$v];
					$ds['ct_zjcode'] .= '&nbsp;'.$lineZJNums[$v];
					$ds['ct_types'] .= '&nbsp;'.$lineTypes[$v];
					$ds['ct_exits'] .= '&nbsp;'.$lineExits[$v];
					$ds['ct_diaocha'] .= '&nbsp;'.$lineDiaochas[$v];
				}	
			}
		}
		
		$data['ds'] = $ds;		
		return $data;
	}
	
	// 保存参团人信息
	private function saveMember($aa) {
		if (empty($aa['order_id'])) {
			$data['result'] = error(-1, '参团人参数不齐全');
			return $this->ajaxReturn($data);
		}		
		
		$memberObj = ModelBase::getInstance('signup_member');
		$colNames = $memberObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$member = coll_elements_giveup($colNames, $aa);
		
		// 修改参团人员类型，并统计类型是否超出，如果超出，则还原修改的类型
		if (!empty($member['id']) && !empty($member['type_id'])) {
			$recoverMember = $memberObj->getOne(appendLogicExp('id', '=', $member['id']));
			$data['modify_member_type_result'] = $memberObj->modify(array('type_id'=>$member['type_id']), appendLogicExp('id', '=', $member['id']));
		}
		
		// 检测该类型用户是否已超出上线		
		$memberTypeCount = BackOrderHelp::getOrderMemberTypeCount($aa['order_id']);
		$data['type_count'] = $memberTypeCount;
		$memberTypeKey = BackOrderHelp::MemberTypeKey2Value($member['type_id']);
		if (is_error($memberTypeKey) === true) {
			$data['result'] = error(-1, '参团人的类型错误1');
			return $this->ajaxReturn($data);
		}
		$data['type_key'] = $memberTypeKey;
		$order = BackOrderHelp::getOrderInfo($aa['order_id']);
		if (is_error($order) == true) {
			$data['result'] = error(-1, '订单号错误，参团人操作失败');
			return $this->ajaxReturn($data);
		}
//		// 判断该类型参团人是否已到上线
//		if (stripos($memberTypeKey, 'woman') !== false) {
//			$memberTypeCount['woman'] = intval($memberTypeCount['woman']);		
//			if (intval($order['woman']) < intval($memberTypeCount['woman'])) {
//				$data['result'] = error(-1, '该类型的参团人已达上线，请修改订单参团人数量后再编辑此类型参团人');
//			}
//		} else if (stripos($memberTypeKey, 'man') !== false) {
//			$memberTypeCount['man'] = intval($memberTypeCount['man']);		
//			if (intval($order['male']) < intval($memberTypeCount['male'])) {
//				$data['result'] = error(-1, '该类型的参团人已达上线，请修改订单参团人数量后再编辑此类型参团人');
//			}
//		} else if (stripos($memberTypeKey, 'child') !== false) {
//			$memberTypeCount['child'] = intval($memberTypeCount['child']);		
//			if (intval($order['child']) < intval($memberTypeCount['child'])) {
//				$data['result'] = error(-1, '该类型的参团人已达上线，请修改订单参团人数量后再编辑此类型参团人');
//			}
//		} else {
//			$data['result'] = error(-2, '参团人的类型错误2');
//		}
		
		if (!empty($data['result']) && error_ok($data['result']) === false) {
			// 恢复已修改的人员类型
			if (error_ok($data['modify_member_type_result'])) {
				$data['recover_member_type_result'] = $memberObj->modify($recoverMember, appendLogicExp('id', '=', $member['id']));
			}
			return $this->ajaxReturn($data);
		}
		
		$data['type_count1'] = $memberTypeCount;
 		
		// 为空时需要创建参团人
		if (empty($member['id'])) {
			// 同名去除		
			if (!empty($member['name'])) {
				$conds = appendLogicExp('name', '=', $member['name']);			
			}
			if (!empty($member['tel'])) {
				$conds = appendLogicExp('tel', '=', $member['tel'], 'AND', $conds);
			}
			
			if (!empty($conds)) {
				$conds = appendLogicExp('order_id', '=', $aa['order_id'], 'AND', $conds);
				$existMember = $memberObj->getOne($conds);
				if (!empty($existMember)) {
					if ($existMember['exit'] != 0) {
						$member['id'] = $existMember['id'];
						$member['exit'] = 0;
						$data['recover_member'] = 1;
						$data['result'] = $memberObj->modify($member, appendLogicExp('id', '=', $existMember['id']));
					} else {
						$data['result'] = error(-1, '您所添加的参团已存在');	
					}
				} else {			
					$data['result'] = $memberObj->create($member, $memberId);
					if (error_ok($data['result']) === true) {
						$member['id'] = $memberId;
					}
				}
			} else {			
				$data['result'] = $memberObj->create($member, $memberId);
				if (error_ok($data['result']) === true) {
					$member['id'] = $memberId;
				}
			}		
		} else { // 修改
			unset($member['id']);
			$conds = appendLogicExp('id', '=', $aa['id']);
			$data['result'] = $memberObj->modify($member, $conds);
			if ($data['result']['errno'] == -4) {
				$data['result']['errno'] = 0;
			}
			$member['id'] = $aa['id'];
		}
		$data['ds'] = $member;
		$this->ajaxReturn($data);
	}
	
	// 获取参团人信息
	private function listMember($aa) {
		$data['result'] = error(0, '');
		$memberObj = ModelBase::getInstance('signup_member');		
		if (!empty($aa['cds'])) {
			$cds = json_decode($aa['cds'], true);
			$colNames = $memberObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$cds = coll_elements_giveup($colNames, $cds);
			MyHelp::filterInvalidConds($cds);
			$conds = MyHelp::getLogicExp($cds, '=', 'AND');			
		}
		
		$cdsstr = $aa['cdsstr'];
		if (!empty($cdsstr)) {
			$conds1 = MyHelp::getCondsByStr($cdsstr,4);
			if (empty($conds)) {
				$conds = $conds1;
			} else {
				$conds = array_merge($conds, $conds1);	
			}
		}
		
		$data['ds'] = BackOrderHelp::getOrderMembers(0, $conds);
		return $this->ajaxReturn($data);
	}
	
	// 更新参团人信息
	public function memberAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'save') {
				$this->saveMember($_POST);
			} else if ($type == 'list') {
				$this->listMember($_POST);
			} else {
				$data = error(-1, '错误的操作方式');
				return $this->ajaxReturn($data);
			}
		} else {
			$errPageData = errorPage('500', '错误', '错误请求', '您请求的方式有误');
			$this->assign('err', $errPageData);
			$this->display('index/error');
		}
	}
			
	// 更新订单信息
	private function updateOrder($aa) {		
		if (empty($aa['cds']) || empty($aa['data'])) {
			$data['result'] = error(-1, '数据非法，更新订单失败');
			return $this->ajaxReturn($data);
		}
		
		// 组织修改条件
		$cds = array();
		foreach($aa['cds'] as $k=>$v) {
			$cds[$v['name']] = $v['value'];
		}
		
		// 组织改动数据
		$ds = array();
		foreach($aa['data'] as $k=>$v) {
			$ds[$v['name']] = $v['value'];
		}
		
		if (isset($ds['team_cur_pirce'])) {
			$lockResult = BackOrderHelp::checkOrderLock($orderId);
			if (error_ok($lockResult) === false) {
				$data['result'] = $lockResult;
				$this->ajaxReturn($data);
			}		
		}
		
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$lineCols = $orderObj->getUserDefine(ModelBase::DF_COL_NAMES);		
		$cds = coll_elements_giveup($lineCols, $cds);
		$conds = MyHelp::getLogicExp($cds, '=', 'AND');
		$ds = coll_elements_giveup($lineCols, $ds);		
		$order = $orderObj->getOne($conds);
		if (empty($order)) {
			$data['result'] = error(-1, '未能找到要修改的订单');
			return $this->ajaxReturn($data);
		}
		
		if (!empty($ds['team_cut_price']) && stripos($order['order_sn'], 'QD-') !== 0) {
			$data['result'] = error(-1, '订单的总团费不能修改');
			return $this->ajaxReturn($data);
		}
		
		if (check_grant('improve_order') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
/**
* 旧参团人修改处理
*/
//		if (!empty($aa['op_info'])) {		
//			// 编辑参团人
//			if ($aa['op_info'] === 'member_edit') {
//				// 新参团人分配ID
//				$result = $this->assignNewMemberId($order, $ds, $aa['new_name']);
////				$data['output'] = $result;
//				if (error_ok($result['result']) === false) {
//					$data['result'] = $result['result'];
//					return $this->ajaxReturn($data);
//				}
//				$data['new_member_id'] = $result['new_member_id'];
//				$ds = $result['ds'];
//							
//			}			
//		}		

		if (!empty($ds['team_cut_price'])) {
			$ds['team_price'] = $ds['team_cut_price'];
		}
					
		$data['result'] = $orderObj->modify($ds, $conds);
		if (error_ok($data['result']) === true) {
			
			// 重新获取订单需支付金额
			if (!empty($ds['team_cut_price'])) {
				$data['refresh_money'] = BackOrderHelp::getOrderNeedPayMoney($order['id'], true);
				// 刷新订单状态
				$data['state_result'] = BackOrderHelp::setOrderStateBySystem($order['id']);
				// 重新获取状态
				$order = BackOrderHelp::getOrderInfo($order['id']);
				if (!empty($order)) {
					$data['state'] = BackOrderHelp::OrderStateKey2Value($order['zhuangtai'], true);
				}
			}
								
			// 分销情况下处理
			if (!empty($ds['zhuangtai'])) {
				$stateKey = BackOrderHelp::OrderStateKey2Value($ds['zhuangtai']);
			}
		}
		return $this->ajaxReturn($data);				
	}
	
	// 创建订单
	private function createOrder($aa) {
		if (check_grant('create_order') === false) {
			$data['result'] = error(-1, '1.您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}	
		
		$admin = MyHelp::getLoginAccount(false);
		if (is_error($admin) === true) {
			$data['result'] = $admin;
			$data['jumpUrl'] = UNLOGIN_URL;
			return $this->ajaxReturn($data);
		}
		
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$colNames = $orderObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNames, $aa);
		// 获取线路
		$line = BackLineHelp::getLine(appendLogicExp('id', '=', $ds['lineid']));
		if (empty($line)) {
			$data['result'] = error(-1, '订单线路存在问题，不能生成订单:'.$ds['lineid']);
			return $this->ajaxReturn($data);
		}
		
		// 订单加入到用户订单列表
		$userConds = appendLogicExp('phone', '=', $ds['mob']);
		$user = BackAccountHelp::getAccount('account_user', $userConds);
		if (is_error($user)) {
			// 账户未注册
			if (check_mobile($ds['mob']) === false && check_tel($ds['mob']) === false) {
				$data['result'] = error(-1, '联系人手机号码有误，请检查后再次下单');
				return $this->ajaxReturn($data);
			}
			// 未注册则注册
			$user_data['name'] = $ds['names'];
			$user_data['phone'] = $ds['mob'];
			$user_data['password'] = '123456';
			$user = BackAccountHelp::registerUser($user_data);
			if (is_error($user)) {
				$data['result'] = $user;
				return $this->ajaxReturn($data);
			}
		} else {						
			// 如果禁用，不允许下单
			if ($user['forbidden'] == '1') {
				$data['result'] = error(-1, '联系人账号已被禁用，不能下单，请联系客服MM咨询详细情况哦');
				$this->ajaxReturn($data);
			}
					
			// 如果被拉黑，不允许下单
			if ($user['backlist'] == '1') {
				$data['result'] = error(-1, '联系人账号已被拉黑，不能下单，请联系客服MM咨询详细情况哦');
				$this->ajaxReturn($data);
			}
		}		
		$ds['userid'] = $user['id'];
		$ds['book_account_type'] = $user['account_type']['id'];
		$ds['station_id'] = $line['station_data'][0]['id'];	
/**
* 旧参团人员保存在订单表中
*/
//		$result = $this->assignNewMemberId($ds, $ds, '');
//		if (error_ok($result['result']) === false) {
//			$data['result'] = $result['result'];
//			return $this->ajaxReturn($data);
//		}
//		$ds['ct_ids'] = $result['ds']['ct_ids'];
//		$ds['ct_names'] = $result['ds']['ct_names'];
//		$ds['ct_sjnum'] = $result['ds']['ct_sjnum'];
//		$ds['ct_zhengjian'] = $result['ds']['ct_zhengjian'];
//		$ds['ct_zjcode'] = $result['ds']['ct_zjcode'];
//		$ds['ct_types'] = $result['ds']['ct_types']; 
//		$ds['ct_exits'] = $result['ds']['ct_exits'];
//		$ds['ct_diaocha'] = $result['ds']['ct_diaocha'];
		
		$ds['member_total_count'] = intval($ds['male'])+intval($ds['woman'])+intval($ds['child']);
		if (empty($ds)) {
			$ds['from_id'] = BackOrderHelp::OrderFromKey2Value('xianxia');	
		}
		$channel = I('post.channel', 0);
		if (!empty($channel)) {
			$ds['order_sn'] = BackOrderHelp::createOrderSN('QD', $ds['from_id']);
		} else {
			$ds['order_sn'] = BackOrderHelp::createOrderSN('XX', $ds['from_id']);
		}
		$ds['addtime'] = time();
		$ds['addip'] = get_real_ip();
		$orderStateId = BackOrderHelp::OrderStateKey2Value('review');
		$ds['zhuangtai'] = $orderStateId;		
		$data['result'] = $orderObj->create($ds, $orderId);
		
		if (error_ok($data['result']) === false) {
			return $this->ajaxReturn($data);	
		}		
		
		if (empty($orderId)) {
			$data['result'] = error(-1, '1.未能获取到正确的订单号码生成订单失败');
			return $this->ajaxReturn($data);
		}	
		$data['orderId'] = $orderId;
		
		// 目前生成的订单全部为新线路订单，此计算方法只适用于新线路
		$money = BackOrderHelp::getOrderNeedPayMoney($orderId, true);
		
		// 保存参团人员信息
		if (!empty($aa['members'])) {
			$memberIds = array();
			$memberObj = ModelBase::getInstance('signup_member');
			$members = json_decode($aa['members'], true);
			foreach ($members as  $mk=>$mv) {
				$mv['order_id'] = $orderId;		
				$memberResult = $memberObj->create($mv, $memberId);		
				if (error_ok($memberResult) == false) {
					array_push($memberIds, $memberResult);
				} else {
					array_push($memberIds, $memberId);
				}
			}
			$data['member_result'] = $memberIds;
		}
		
		// 保存创建记录
		$superviseResult = BackOrderHelp::writeSupervise($orderId, "创建线下订单");
		if (is_error($superviseResult) === false) {
			$superviseId = $superviseResult['id'];
		}
		
		// 保存留言
		if (!empty($aa['order_message'])) {
			$result = BackOrderHelp::writeMessage($orderId, $aa['order_message']);
			if (is_error($result)) {
				$data['result'] = error(-2, '2'.$result['message']);
			} else {
				$msgId = $result;	
			}
		}
		$data['msgId'] = $msgId;
		
		// 审核对象
		$orderReviewObj = ModelBase::getInstance('order_review');
		// 额外费用对象
		$extraCashObj = ModelBase::getInstance('order_extra_cash');
		// 提交审核
		$cash_datas = $aa['cash_datas'];
		if (!empty($cash_datas)) {						
			$colNames = $orderReviewObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$ds = coll_elements_giveup($colNames, $aa);
			$ds['order_id'] = $orderId;
			$ds['order_state_id'] = $orderStateId;	
		
//			$refundFuncId = BackReviewHelp::cashFuncKey2Value('refund');
//			if (is_error($refundFuncId)) {
//				$data['result'] = error(-3, '2'.'获取退款费用功能编号失败');
//				return $this->ajaxReturn($data);
//			}
			
			$changeState = false;
			foreach($cash_datas as $cdk=>$cdv) {				
				if (floatval($cdv['cash']) > 0) {					
					$extraCashId = 0;
					$cash_use_key = BackReviewHelp::cashUseKey2Value($cdv['cash_use_id']);
					// 审核费用的用途不为团费的情况下，给订单添加额外费用
					if (is_error($cash_use_key) === false && $cash_use_key !== 'team') {
						// 创建额外费用
						$result = BackExtraCashHelp::appendExtraCash($orderId, $cdv['cash_use_id'], $cdv['cash'], 0, 0, 0, '创建订单与订单审核时添加');
						if (is_error($result)) {
							$data['result'] = error(-4, '4.'.$data['result']['message'].'||创建额外费用失败'.$result['message']);
							continue;
						}
						$extraCashId = $result;
						$data['extraId'] .= '/'.$extraCashId;
						
//						$result = BackExtraCashHelp::getExtraCash($extraCashId);
//						if (is_error($result)) {
//							$data['result'] = error(-5, '5.'.$data['result']['message'].'||'.$result['message']);
//							continue;
//						}					
//						$extraCash = $result;
					}
					
					$reviewId = BackReviewHelp::commitOrderReview($ds, $cdv['cash'], $cdv['cash_func_id'], $cdv['cash_use_id'], $cdv, $cdv['request_reason'], $extraCashId);	
					if (is_error($reviewId) && error_ok($reviewId) === false) {
						$data['result'] = error(-6, '6.'.$data['result']['message'].'||'.$reviewId['message']);
					} else {
//						// 绑定额外费用
//						$bindReviewIdCol = $refundFuncId === $ds['cash_func_id'] ? 'review_refund_id' : 'review_pay_id';
//						$bindExtraCashIds = array_push($bindExtraCashIds,array('id'=>$extraCashId, 'colName'=>$bindReviewIdCol, 'reviewId'=>$reviewId));
//						$result = $extraCashObj->modify(array($bindReviewIdCol=>$reviewId), appendLogicExp('id', '=', $extraCashId));
//						if (error_ok($result) === false) {
//							$data['result'] = error(-7, '7.'.$data['result']['message'].'||'.$result['message']);
//						}
						
						// 记录改动数据的编号
						$delExtraCds = appendLogicExp('id', '=', $extraCashId, 'OR', $delExtraCds);
						$delReviewCds = appendLogicExp('id', '=', $reviewId, 'OR', $delReviewCds);
						$changeState = true;
						$data['reviewId'] .= '/'.$reviewId;
					}
				}
			}
			// 设置当前订单状态
			if ($changeState === true) {
				$result = BackOrderHelp::setOrderStateBySystem($orderId);
				if (is_error($result) === false && $result['errno'] !== 1) {
					$data['result'] = error(-8, '8.'.$data['result']['message'].'||'.$result['message']);
				}				
			}
		}
		
		// 判断其他附加数据是否添加成功（额外费用、审核费用）
		if (error_ok($data['result'])) {
			$data['result'] = error(0, '生成订单成功');
		} else {
			// 还原生成的订单
			if (!empty($orderId)) {
				$result = $orderObj->remove(appendLogicExp('id', '=', $orderId));
				if (error_ok($result) === false){
					$data['result'] = error(-9, '9.'.$data['result']['message'].'||生成订单失败时回滚留言记录失败'.$result['message']);
				}	
			}
			
			// 还原监督消息
			if (!empty($superviseId)) {
				$superviseObj = ModelBase::getInstance('order_supervise');
				$result = $superviseResult->remove(appendLogicExp('id', '=', $superviseId));
				if (error_ok($result) === false) {
					$data['result'] = error(-10, '10.'.$data['result']['message'].'||生成订单失败时回滚监督记录失败'.$result['message']);
				}
			}
			
			// 还原留言记录
			if (!empty($msgId)) {
				$orderMsgObj = ModelBase::getInstance('order_message');	
				$result = $orderMsgObj->remove(appendLogicExp('id', '=', $msgId));
				if (error_ok($result) === false){
					$data['result'] = error(-11, '11.'.$data['result']['message'].'||生成订单失败时回滚留言记录失败'.$result['message']);
				}	
			}
			
			// 还原添加的审核记录
			if (!empty($delReviewCds)) {
				$result = $orderReviewObj->remove($delReviewCds);
				if (error_ok($result) === false){
					$data['result'] = error(-12, '12.'.$data['result']['message'].'||生成订单失败时回滚审核记录失败'.$result['message']);
				}	
			}
			// 还原生成的额外费用
			if (!empty($delExtraCds)) {
				$result = $extraCashObj->remove($delExtraCds);
				if (error_ok($result) === false){
					$data['result'] = error(-13, '13.'.$data['result']['message'].'||生成订单失败时回滚产生的额外费用失败'.$result['message']);
				}	
			}
		}		
		return $this->ajaxReturn($data);
	}
	
	// 保存跟踪订单记录
	private function saveSupervise($aa) {
		if (!array_key_exists('order_id', $aa)) {
			$data['result'] = error(-1, '参数错误，无法获取订单信息');
			return $this->ajaxReturn($data);
		}
		
		$result = BackOrderHelp::writeSupervise($aa['order_id'], $aa['reason']);
		if (is_error($result)) {
			$data['result'] = $result;
			return $this->ajaxReturn($data);
		}
		
		$data['result'] = error(0, '写入成功');
		$data['supervise'] = $result;
		return $this->ajaxReturn($data);	
	}
	
	// 保存订单留言
	private function saveOrderMessage($aa) {
		if (!array_key_exists('order_id', $aa)) {
			$data['result'] = error(-1, '参数错误，无法获取订单信息');
			return $this->ajaxReturn($data);
		}
		
		$lineObj = ModelBase::getInstance('lineenertname', 'xz_');
		$line = $lineObj->getOne(appendLogicExp('id', '=', $aa['order_id']));
		if (empty($line)) {
			$data['result'] = error(-1, '无法获取订单信息');
			return $this->ajaxReturn($data);
		}
		
		$admin = MyHelp::getLoginAccount(true);
		$aa['admin_id'] = $admin['id'];
		$aa['create_time'] = fmtNowDateTime();
		
		
		$orderMsgObj = ModelBase::getInstance('order_message');
		$orderMsgCols = $orderMsgObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$saveData = coll_elements_giveup($orderMsgCols, $aa);
		$data['result'] = $orderMsgObj->create($saveData);
		
		$saveData['admin_id_account'] = $admin['account'];
		$data['message'] = $saveData;
		return $this->ajaxReturn($data);	
	}
	
	// 发送短信给手机
	private function sendSMSToPhone($aa) {
		if (check_grant('send_order_sms') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		if (!array_key_exists('data', $aa)) {
			$data['result'] = error(-1, '参数错误，无法发送短信');
			return $this->ajaxReturn($data);
		}
		$phones = $aa['data'];
		if (count($phones) < 1) {
			$data['result'] = error(-1, '电话号码为空');
			return $this->ajaxReturn($data);
		}
		
		foreach ($phones as $k=>$v) {
			if (check_mobile($v['tel']) === false) {
				$data['result'] = error(-1, '号码中存在无效的电话号码，请检查后再次发送');
				return $this->ajaxReturn($data);
			}
		}
		
		$data['result'] = error(0, '发送成功');
		$this->ajaxReturn($data);
	}
	
	// 订单对比当前批次价格刷新团费
	private function compareTeamPrice() {
		$orderId = I('id', false);
		if (empty($orderId)) {
			$data['result'] = error(-1, '错误的订单编号');
			$this->ajaxReturn($data);
		}
		
		$lockResult = BackOrderHelp::checkOrderLock($orderId);
		if (error_ok($lockResult) === false) {
			$data['result'] = $lockResult;
			$this->ajaxReturn($data);
		}
		
		$data['refresh_money'] = BackOrderHelp::getOrderNeedPayMoney($orderId, true, false, true);
		$writeResult = $data['refresh_money']['write_result'];
		if ($writeResult['errno'] != 0 && $writeResult['errno'] != -4) {
			$data['result'] = $writeResult;
		} else {
			if (error_ok($writeResult)) {
				// 重新计算金额后刷新订单状态
				$data['order_state_result'] = BackOrderHelp::setOrderStateBySystem($orderId);
			}
			$data['result'] = error(0, $data['refresh_money']['tip']);			
		}
		return $this->ajaxReturn($data);
	}
	
	// 显示创建订单
	public function infoAction() {
		if (IS_POST) {
			$aa = $_POST;
			$op = I('post.op', false);
			if ($op === 'update_order') {
				$this->updateOrder($aa);
			} else if ($op === 'create_order') {
				$this->createOrder($aa);
			} else if ($op === 'save_supervise') {
				$this->saveSupervise($aa);
			} else if ($op === 'save_message') {
				$this->saveOrderMessage($aa);
			} else if ($op === 'sms') {
				$this->sendSMSToPhone($aa);
			} else if ($op === 'compare_price') {
				$this->compareTeamPrice();
			} else {
				$data['result'] = error(-1, '未知操作');
				return $this->ajaxReturn($data);
			}
		} else {
			$op = I('get.op', false);
			if ($op === 'order_info') {
				$orderId = I('get.id', 0);
				$data['jumpUrl'] = U('order/Info', 'id='.$orderId);				
				$this->ajaxReturn($data);	
			} else {
				$this->showInfoPage();	
			}
		}
	}
	
	// 赠品
	public function largessAction() {
		if (IS_POST) {			
			$largessObj = ModelBase::getInstance('member_largess');
			$op = I('post.op_type', false);
			if ($op == 'find' || $op == 'remove') {
				$largessId = I('post.id', false);
				if (empty($largessId)) {
					$data['result'] = error(-1, '查找的参数错误');
					return $this->ajaxReturn($data);
				}
				$data['result'] = error(0, '');
				if ($op == 'remove') {
					$data['result'] = $largessObj->remove(appendLogicExp('id', '=', $largessId));
				} else {
					$data['ds'] = $largessObj->getOne(appendLogicExp('id', '=', $largessId));	
				}
			} else {
				$colNames = $largessObj->getUserDefine(ModelBase::DF_COL_NAMES);
				$ds = coll_elements_giveup($colNames, $_POST);
				if (empty($ds['id'])) {
					$data['result'] = $largessObj->create($ds, $largessId);
					if (error_ok($data['result']) === true) {
						$ds['id'] = $largessId;
						$member = I('post.member', false);
						if (!empty($member)) {
							$member['type_id_data'] = BackOrderHelp::MemberTypeKey2Value($member['type_id'], true);
							$member['certificate_type_id_data'] = BackOrderHelp::CertTypeKey2Value($member['certificate_type_id'], true);
							$ds['member_data'] = $member;
						}
						$ds['largess_data'] = json_decode($ds['largess'], true);
						$ds['data_info'] = json_decode($ds['data'], true);
						$data['ds'] = $ds;							
					}
				} else {
					$conds = appendLogicExp('id', '=', $ds['id']);
					unset($ds['id']);
					$data['result'] = $largessObj->modify($ds, $conds);
				}
			}
			return $this->ajaxReturn($data);
		}
	}
	
	// 显示人气报名页
	private function showRobotPage() {
		$orderId = I('get.id', false);		
		
		// 设置菜单		
		$this->page_title = '人气报名';
		$this->content_title = '人气报名';
		$this->content_des = '这里你可以为订单添加系统自动生成的订单';
		$this->_setMenuLinkCurrent('人气报名', 'order_robot');
		$this->_initTemplateInfo();	
				
		// 订单状态
		$orderState = BackOrderHelp::getOrderStateList('order');
		if (!empty($orderState)) {
			$this->assign('orderState', $orderState);
		}
		
		return $this->display('robot');
	}
	
	// 获取订单数量
	private function getRobotOrderCount($aa) {
		if (empty($aa)) {
			$data['result'] = error(-1, '条件为空，不能找到相关数据');			
			$this->ajaxReturn($data);
		}
		
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$orderCols = $orderObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$cds = coll_elements_giveup($orderCols, $aa);
		$cds = MyHelp::getLogicExp($cds, '=', 'AND');
		$cds = appendLogicExp('names', 'like', '%人气%', 'AND', $cds);
		$orderCount = $orderObj->getCount($cds);
		$data['result'] = error(0, '');
		$data['count'] = $orderCount;
		$this->ajaxReturn($data);		
	}	
	
	// 创建人气订单
	private function createRobotOrder($aa) {
		if (check_grant('order_robot') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		if (!array_key_exists('lineid', $aa) || !array_key_exists('hdid', $aa) || !array_key_exists('order_count', $aa) || 
			!array_key_exists('min_count', $aa) || !array_key_exists('max_count', $aa) || !array_key_exists('new_line', $aa)) {
			$data['result'] = error(-1, '订单信息不完全，请检查后再提交');
			return $this->ajaxReturn($data);
		}
		
		$order_count = $aa['order_count'];
		$member_min = intval($aa['min_count']) > intval($aa['max_count']) ? intval($aa['max_count']) : intval($aa['min_count']) ;
		$member_max = intval($aa['min_count']) > intval($aa['max_count']) ? intval($aa['min_count']) : intval($aa['max_count']) ;
		
		if ($order_count > 10) {
			$data['result'] = error(-1, '生成的最大人气订单数量超出单次生成上线，请修改后再次提交');
			return $this->ajaxReturn($data);
		}
		
		$names = array('李','王','张','刘','陈','杨','赵','黄','周','吴','徐','孙','胡','朱','高',
					   '林','何','郭','马','罗','梁','宋','郑','谢','韩','唐','冯','于','董','萧',
					   '程','曹','袁','邓','许','傅','沈','曾','彭','吕','苏','卢','蒋','蔡','贾',
					   '丁','魏','薛','叶','阎','余','潘','杜','戴','夏','锺','汪','田','任','姜',
					   '范','方','石','姚','谭','廖','邹','熊','金','陆','郝','孔','白','崔','康',
					   '毛','邱','秦','江','史','顾','侯','邵','孟','龙','万','段','雷','钱','汤',
					   '尹','黎','易','常','武','乔','贺','赖','龚','文');
		
		$provinces = array('上海市','江苏省','浙江省','安徽省','北京市','天津市','广东省','河北省','河南省','山东省','湖北省','湖南省','江西省','福建省','四川省','重庆市','广西壮族自治区','山西省','辽宁省','吉林省','黑龙江省','贵州省','陕西省','云南省','内蒙古自治区','甘肃省','青海省','宁夏回族自治区','新疆维吾尔族自治区','海南省','西藏藏族自治区','香港特别行政区','澳门特别行政区');
		$tels = array('130','131','132','133','134','135','136','137','138','139','150','151','152','153','154','155','156','157','158','159','180','181','182','183','184','185','186','187','188','189');
		
		$stridx = stripos($aa['create_time'], ' / ');
		$start_time = substr($aa['create_time'], 0, $stridx).' 00:00:00';
		$end_time = substr($aa['create_time'], $stridx + 3);
		$nowDate = date('Y-m-d', time());
		$end_time .= $end_time == $nowDate ? date(' H:i:s', time()-1) : ' 23:59:59';
		
		$start = strtotime($start_time);
		$end = strtotime($end_time);
		if ($end > time()) {
//			$data['result'] = error(-1, '您生成的人气订单结束时间大于当前时间,end:'.$end_time.',cur:'.fmtNowDateTime().'('.$end.'/'.time().')');
			$data['result'] = error(-1, '您生成的人气订单结束时间大于当前时间');
			return $this->ajaxReturn($data);
		}
		
		$orderFrom = BackOrderHelp::OrderFromKey2Value('guanwang', true);
		$data['from'] = $orderFrom;
		
		$admin = MyHelp::getLoginAccount(false);
		if (empty($admin)) {
			$data['jumpUrl'] = UNLOGIN_URL;
			$data['result'] = error(-1, '您还未登陆系统，请登陆后在进行操作');
			return $this->ajaxReturn($data);
		}
		
		// 初始人气订单状态
		$state = BackOrderHelp::OrderStateKey2Value('unreview', true);
							
		$data['result'] = error(0, '');
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$orderCols = $orderObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$saveData = coll_elements_giveup($orderCols, $aa);
		// 获取线路
		$line = BackLineHelp::getLine(appendLogicExp('id', '=', $saveData['lineid']));
		if (empty($line)) {
			$data['result'] = error(-1, '订单线路存在问题，不能生成订单:'.$saveData['lineid']);
			return $this->ajaxReturn($data);
		}
		$saveData['station_id'] = $line['station_data'][0]['id'];
		for ($i = 0; $i < $order_count; $i++) {
			$saveData['order_sn'] = BackOrderHelp::createOrderSN('RQ', $from_id);
			$saveData['names'] = $names[mt_rand(0,count($names)-1)].'人气';
			$saveData['male'] = 0;
			$saveData['woman'] = 0;
			$saveData['child'] = 0;
			$saveData['from_id'] = is_error($orderFrom) === true ? 1 : $orderFrom['id'];
			$saveData['station_id'] = $admin['station_id_data']['id'];	
			$sexCountColName = mt_rand(0,1)===1?'male':'woman';
			$member_count = mt_rand($member_min, $member_max);
			$saveData[$sexCountColName] = $member_count;
			$saveData['shengfen'] = $provinces[mt_rand(0,count($provinces)-1)];
			$saveData['mob'] = $tels[mt_rand(0,count($tels)-1)].mt_rand(1000,9999).mt_rand(1000,9999);
			$saveData['certificate_type_id'] = 1;
			$saveData['shenfenid'] = 0;
			$saveData['gender'] = mt_rand(0,1)===1?'男':'女';
			$saveData['types'] = '成人';
			$saveData['userid'] = $admin['id'];
			$saveData['book_account_type'] = $admin['account_type']['id'];
			$saveData['addip'] = get_client_ip();
			$saveData['addtime'] = mt_rand(intval($start), intval($end));
			$saveData['zhuangtai'] = is_error($state) === false ? $state['id'] : 1;
			
			$rs = $orderObj->create($saveData);
			if (error_ok($rs) === false) {
				$data['result']['message'] .= "\norder:" . $saveData['order_sn'] . $rs['message'];
			}
			$data['result']['message'] .= "<br />order:" . $saveData['order_sn'];
		}

		$this->ajaxReturn($data);
	}
	
	// 修改人气报名状态
	private function modifyRobotOrderState($aa) {
		if (check_grant('order_robot') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		if (!array_key_exists('lineid', $aa) || !array_key_exists('hdid', $aa) || !array_key_exists('new_line', $aa) || 
			!array_key_exists('zhuangtai', $aa) || !array_key_exists('state_count', $aa)) {
			$data['result'] = error(-1, '修改信息不完全，请检查后再提交');
			return $this->ajaxReturn($data);
		}
		
		$state_count = $aa['state_count'];
		if ($state_count < 1) {
			$data['result'] = error(-1, '修改状态数量不能小于1');
			return $this->ajaxReturn($data);
		}
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$cds = appendLogicExp('lineid', '=', $aa['lineid'], 'AND');
		$cds = appendLogicExp('hdid', '=', $aa['hdid'], 'AND', $cds);
		$cds = appendLogicExp('new_line', '=', $aa['new_line'], 'AND', $cds);
		$cds = appendLogicExp('names', 'LIKE', '%人气%', 'AND', $cds);
		$orders =  $orderObj->getAll($cds);
		if (empty($orders)) {
			$data['result'] = error(-1, '该线路批次没有人气报名');
			return $this->ajaxReturn($data);	
		} else {			
			// 找出可修改的订单
			$pstate = array();
			foreach ($orders as $lk=>$lv) {
				if (intval($lv['zhuangtai']) !== intval($aa['zhuangtai'])) {
					$data['hah'] .= 'hah'.$lk;
					array_push($pstate, $lv);
				}
			}			
			
			// 随机抽取订单
			$cstate = array();
			if (count($pstate) > $state_count) {
				for($i = 0; $i < $state_count; $i++){
					$idx = rand(0, count($pstate)-1);
					array_push($cstate, $pstate[$idx]);
					unset($pstate[$idx]);
				}				
			} else if (count($pstate) == $state_count){
				$cstate = $pstate;
			} else {
				$data['result'] = error(-1, '该线路批次可修改为设定状态的人气报名订单数量过少，设置失败!');
				return $this->ajaxReturn($data);
			}
			
			if (empty($cstate)) {
				$data['result'] = error(-1, '该线路批次可修改为设定状态的人气报名订单数量过少，设置失败!!');
				return $this->ajaxReturn($data);
			}
			
			// 组织改变订单状态的条件
			foreach ($cstate as $csk=>$csv) {
				$conds = appendLogicExp('id', '=', $csv['id'], 'OR', $conds);
			}
			
			$data['result'] = $orderObj->modify(array('zhuangtai'=>$aa['zhuangtai']), $conds);
			return $this->ajaxReturn($data);
		}	
	}
	
	// 删除人气报名
	private function deleteRobotOrder($aa) {
		if (check_grant('order_robot') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		if (!array_key_exists('lineid', $aa) || !array_key_exists('hdid', $aa) || !array_key_exists('count', $aa)) {
			$data['result'] = error(-1, '信息不完全，请检查后再提交');
			return $this->ajaxReturn($data);
		}
		
		$count = $aa['count'];
		if ($count < 1) {
			$data['result'] = error(-1, '删除的数量不能小于1');
			return $this->ajaxReturn($data);
		}
		
		$lineObj = ModelBase::getInstance('lineenertname', 'xz_');
		$cds = appendLogicExp('lineid', '=', $aa['lineid'], 'AND');
		$cds = appendLogicExp('hdid', '=', $aa['hdid'], 'AND', $cds);
		$cds = appendLogicExp('names', 'LIKE', '%人气%', 'AND', $cds);
		$lines =  $lineObj->getAll($cds);
		if (empty($lines)) {
			$data['result'] = error(-1, '该线路批次没有人气报名');
			return $this->ajaxReturn($data);	
		} else {
			$data['result'] = error(0, '');
			$delCds = array();
			foreach ($lines as $k=>$v) {
				if ($count < 1) {
					break;
				}
				$delCds = appendLogicExp('id','=',$v['id'],'OR',$delCds);
				$count--;
			}
			if (empty($delCds)) {
				$data['result'] = error(-1, '没有可供删除的人气报名');
			} else {
				$data['cds'] = $delCds;
				$data['result'] = $lineObj->remove($delCds);
				if (error_ok($data['result'])) {
					$data['count'] = $lineObj->getCount($cds);
				}
			}
			return $this->ajaxReturn($data);
		}
	}
	
	// 人气报名
	public function robotAction() {
		if (IS_POST) {
			$aa = $_POST;
			$op = I('post.op', false);
			if ($op == 'order_count'){
				$this->getRobotOrderCount($aa);
			} else if ($op == 'order_create') {
				$this->createRobotOrder($aa);
			} else if ($op == 'order_state_modify') {
				$this->modifyRobotOrderState($aa);
			} else if ($op == 'order_delete') {
				$this->deleteRobotOrder($aa);
			} else {
				$data['result'] = error(-1, '未知参数类型');
				$this->ajaxReturn($data);
			}
		} else {
			$op = I('get.op', false);
			if ($op === 'order_info') {
				$orderId = I('get.id', 0);
				$data['jumpUrl'] = U('order/Info', 'id='.$orderId);				
				$this->ajaxReturn($data);	
			} else {
				$this->showRobotPage();	
			}
		}
	}
	
	// 绑定额外费用
	private function bindExtraCash($aa) {
		if (!array_key_exists('order_id', $aa) || !array_key_exists('cash_use_id', $aa) || !array_key_exists('cash', $aa)) {
			$data['param'] = $aa;
			$data['result'] = error(-1, '参数不齐全，绑定额外费用失败');
			return $this->ajaxReturn($data);
		}
		
		$extraId =  BackExtraCashHelp::appendExtraCash($aa['order_id'], $aa['cash_use_id'], $aa['cash'], 0, 0, 0, $aa['reason'], $refreshMoneyResult, $out);
		if (is_error($extraId) && error_ok($extraId) === false) {
			$data['result'] = $extraId;
		} else {
			$data['result'] = error(0, '绑定额外费用成功');
			$data['ds'] = BackExtraCashHelp::getExtraCash($extraId);
			
			// 刷新订单总价格
			$data['refresh_money'] = $refreshMoneyResult;
		}
		$data['out'] = $out;
		// 订单状态设置
		$order = BackOrderHelp::getOrderInfo($aa['order_id']);
		if (is_error($order) === false) {
			$orderState = BackOrderHelp::OrderStateKey2Value($order['zhuangtai'], true);
			$data['order_state'] = $orderState;
		}
		
		$data['ds']['cash_use_id_data'] = BackReviewHelp::cashUseKey2Value($aa['cash_use_id'], true);
		return $this->ajaxReturn($data);
	}
	
	// 移除额外费用
	private function removeExtraCash($aa) {
		if (!array_key_exists('id', $aa)) {
			$data['result'] = error(-1, '参数不齐全，移除绑定额外费用失败');
			return $this->ajaxReturn($data);
		}
		
		$extraCash = BackExtraCashHelp::getExtraCash($aa['id']);	
		$data['result'] = BackExtraCashHelp::removeExtraCash($aa['id'], $refreshMoneyResult, $out);
		// 刷新订单总价格
		$data['refresh_money'] = $refreshMoneyResult;
		$data['out'] = $out;		
		// 重新设置订单状态
		if (is_error($extraCash) == false) {	
			$order = BackOrderHelp::getOrderInfo($extraCash['order_id']);
			if (is_error($order) === false) {
				$orderState = BackOrderHelp::OrderStateKey2Value($order['zhuangtai'], true);
				$data['order_state'] = $orderState;
			}
		}
		return $this->ajaxReturn($data);
	}
	
	// 编辑额外费用
	public function editExtraCash($aa) {
		$data['aa'] = $aa;
		if (!array_key_exists('id', $aa) || !array_key_exists('cash', $aa)) {
			$data['result'] = error(-1, '参数不齐全，编辑额外费用失败');
			return $this->ajaxReturn($data);
		}
		
		$data['result'] = BackExtraCashHelp::modifyExtraCash($aa['id'], $aa, $refreshMoneyResult, $out);
		// 刷新订单总价格
		$data['refresh_money'] = $refreshMoneyResult;		
		// 重新设置订单状态
		$extraCash = BackExtraCashHelp::getExtraCash($aa['id']);	
		if (is_error($extraCash) == false) {	
			$order = BackOrderHelp::getOrderInfo($extraCash['order_id']);
			if (is_error($order) === false) {
				$orderState = BackOrderHelp::OrderStateKey2Value($order['zhuangtai'], true);
				$data['order_state'] = $orderState;
			}
		}
		
		$data['out'] = $out;
		
		return $this->ajaxReturn($data);
	} 
	
	// 查找额外费用
	public function findExtraCash($aa) {
		if (!array_key_exists('order_id', $aa) || !array_key_exists('func_id', $aa)) {
			$data['result'] = error(-1, '参数不齐全，获取额外费用失败');
			return $this->ajaxReturn($data);
		}
		
		$refundFuncId = BackReviewHelp::cashFuncKey2Value('refund');
		
		$conds = appendLogicExp('order_id', '=', $aa['order_id'], 'AND');
		$conds = appendLogicExp('invalid', '!=', '1', 'AND', $conds);	
		if ($refundFuncId === $aa['func_id']) {
			$conds = appendLogicExp('review_pay_id', '!=', '0', 'AND', $conds);	
		} else {
			$conds = appendLogicExp('review_pay_id', '=', '0', 'AND', $conds);	
			$conds = appendLogicExp('review_refund_id', '=', '0', 'AND', $conds);
		}
		
		$cashUseObj = ModelBase::getInstance('cash_use');
		$cashUses = $cashUseObj->getAll();
		
		$extraCashObj = ModelBase::getInstance('order_extra_cash');
		$extraCashs = $extraCashObj->getAll($conds);
		foreach ($extraCashs as $k=>$v) {
			foreach ($cashUses as $ck=>$cv) {
				if ($cv['id'] === $v['cash_use_id']) {
					$v['cash_use_id_type_desc'] = $cv['type_desc'];
					$extraCashs[$k] = $v;
				}
			}
		}
		$data['use'] = $extraCashs;
		$data['result'] = error(0, '');
		return $this->ajaxReturn($data);
	} 
	
	// 额外费用
	public function extraCashAction() {
		if (IS_POST) {
			$aa = $_POST;
			$op = I('post.op', false);
			if ($op == 'bind'){
				$this->bindExtraCash($aa);
			} else if ($op == 'edit') {
				$this->editExtraCash($aa);
			} else if ($op == 'remove') {
				$this->removeExtraCash($aa);
			} else if ($op == 'find') {
				$this->findExtraCash($aa);
			} else {
				$data['result'] = error(-1, '未知参数类型');
				$this->ajaxReturn($data);
			}
		} else {
			$data['result'] = error(-1, '未知请求类型');
			$this->ajaxReturn($data);
		}
	}
	
	// 绑定优惠券
	private function bindCoupon($aa) {
		if (!array_key_exists('order_id', $aa) || !array_key_exists('coupon_type_id', $aa) || !array_key_exists('cash', $aa)) {
			$data['param'] = $aa;
			$data['result'] = error(-1, '参数不齐全，绑定优惠券失败');
			return $this->ajaxReturn($data);
		}
		
		$bindId = BackCouponHelp::bindOrderCoupon($aa['order_id'], $aa['coupon_type_id'], $aa['cash'], 0, $aa['reason'], $refreshResult, $out);
		if (is_error($bindId) && error_ok($bindId) === false) {
			$data['result'] = $bindId;
		} else {
			$data['bindid'] = $bindId;
			$data['result'] = error(0, '绑定额优惠券成功');
			$coupon = BackCouponHelp::getOrderCoupon($bindId);
			if (is_error($coupon) === false) {
				$adminObj = ModelBase::getInstance('admin');
				$admin = $adminObj->getOne(appendLogicExp('id', '=', $coupon['admin_id']));
				if (!empty($admin)) {
					$coupon['admin_id_account'] = $admin['account'];
				}
				
				// 刷新订单总价格
				$data['refresh_money'] = $refreshResult;
			
				$couponType = BackOrderHelp::CouponTypeKey2Value($aa['coupon_type_id'],true);
				if (!empty($couponType)) {							
					// 查看是否为【团期优惠券】,不计入总价格
					$teamKeyWords = '_TEAM';	
					$subKeyWords = substr($couponType['type_key'], -strlen($teamKeyWords));
					if ($subKeyWords === $teamKeyWords) {
						$data['coupon_team'] = true;
					}	
					
					$coupon['coupon_type_id_data'] = $couponType;
				}
				
				// 订单状态设置
				$order = BackOrderHelp::getOrderInfo($aa['order_id']);
				if (is_error($order) === false) {
					$orderState = BackOrderHelp::OrderStateKey2Value($order['zhuangtai'], true);
					$data['order_state'] = $orderState;
				}
				
				$data['ds'] = $coupon;
			}
		}			
		
		return $this->ajaxReturn($data);
	}
	
	// 移除优惠券
	private function removeBindCoupon($aa) {
		if (!array_key_exists('id', $aa)) {
			$data['result'] = error(-1, '参数不齐全，移除绑定额外费用失败');
			return $this->ajaxReturn($data);
		}
		
		$coupon = BackCouponHelp::getOrderCoupon($aa['id']);
		$data['coupon'] = $coupon;
		if (is_error($coupon) === false) {
			// 查看是否为【团期优惠券】,不计入总价格
			$teamKeyWords = '_TEAM';	
			$couponTypeKey = MyHelp::IdEachTypeKey('coupon_type', $coupon['coupon_type_id']);	
			$data['coupon_key'] = $couponTypeKey;
			if (is_error($couponTypeKey) === false) {
				$subKeyWords = substr($couponTypeKey, -strlen($teamKeyWords));
				$data['sub_key'] = $subKeyWords;
				if ($subKeyWords === $teamKeyWords) {
					$data['coupon_team'] = true;
				}	
			}
		}
		
		$data['result'] = BackCouponHelp::removeOrderCoupon($aa['id'], $refreshMoneyResult);
		// 刷新订单总价格
		$data['refresh_money'] = $refreshMoneyResult;		
		// 重新设置订单状态
		$order = BackOrderHelp::getOrderInfo($coupon['order_id']);
		if (is_error($order) === false) {
			$orderState = BackOrderHelp::OrderStateKey2Value($order['zhuangtai'], true);
			$data['order_state'] = $orderState;
		}
		return $this->ajaxReturn($data);
	}
	
	// 编辑优惠券
	public function editBindCoupon($aa) {
		$data['aa'] = $aa;
		if (!array_key_exists('id', $aa) || !array_key_exists('cash', $aa)) {
			$data['result'] = error(-1, '参数不齐全，编辑额外费用失败');
			return $this->ajaxReturn($data);
		}
		
		$data['result'] = BackCouponHelp::modifyOrderCoupon($aa['id'], $aa, $refreshMoneyResult, $out);
		// 刷新订单总价格
		$data['refresh_money'] = $refreshMoneyResult;		
		$data['out'] = $out;
		// 重新设置订单状态
		$coupon = BackCouponHelp::getOrderCoupon($aa['id']);
		if (is_error($coupon) == false) {	
			$order = BackOrderHelp::getOrderInfo($coupon['order_id']);
			if (is_error($order) === false) {
				$orderState = BackOrderHelp::OrderStateKey2Value($order['zhuangtai'], true);
				$data['order_state'] = $orderState;
			}
		}		
		return $this->ajaxReturn($data);
	} 
	
	// 查找优惠券
	public function findBindCoupon($aa) {
		if (!array_key_exists('order_id', $aa) || !array_key_exists('func_id', $aa)) {
			$data['result'] = error(-1, '参数不齐全，获取额外费用失败');
			return $this->ajaxReturn($data);
		}
		
		$conds = appendLogicExp('order_id', '=', $aa['order_id'], 'AND');
		$conds = appendLogicExp('invalid', '!=', '1', 'AND', $conds);
		
		$couponTypeObj = ModelBase::getInstance('coupon_type');
		$couponTypes = $couponTypeObj->getAll();
		
		$orderCouponObj = ModelBase::getInstance('order_extra_cash');
		$orderCoupons = $orderCouponObj->getAll($conds);
		foreach ($orderCoupons as $k=>$v) {
			foreach ($couponTypes as $ctk=>$ctv) {
				if ($ctv['id'] === $v['cash_use_id']) {
					$v['coupon_type_id_type_desc'] = $ctv['type_desc'];
					$orderCoupons[$k] = $v;
				}
			}
		}
		$data['coupon'] = $orderCoupons;
		$data['result'] = error(0, '');
		return $this->ajaxReturn($data);
	} 
	
	// 优惠券
	public function couponAction() {
		if (IS_POST) {
			$aa = $_POST;
			$op = I('post.op', false);
			if ($op == 'bind'){
				$this->bindCoupon($aa);
			} else if ($op == 'edit') {
				$this->editBindCoupon($aa);
			} else if ($op == 'remove') {
				$this->removeBindCoupon($aa);
			} else if ($op == 'find') {
				$this->findBindCoupon($aa);
			} else {
				$data['result'] = error(-1, '未知参数类型');
				$this->ajaxReturn($data);
			}
		} else {
			$data['result'] = error(-1, '未知请求类型');
			$this->ajaxReturn($data);
		}
	}
	
	// 线路模糊查找
	public function lineFindAction() {
		if (IS_POST) {
			$aa = $_POST;
			$findstr = $aa['q'];
			$data['aa'] = $aa;
			if (trim($findstr) === ""){
				$data['result'] = error(-1, '搜索条件为空');
			} else {
				if (!empty($aa['new_line'])) {
					$admin = MyHelp::getLoginAccount(false);
					if (is_error($admin) === false) {
						if ($admin['station_id_data']['key'] !== 'main') {
							$conds = appendLogicExp('station', 'LIKE', '%\"id\":\"'.$admin['station_id'].'\"%', 'AND', $conds);
						}
					}
					$conds = appendLogicExp('title', 'LIKE', '%'.$findstr.'%', 'AND', $conds);
					$conds = appendLogicExp('invalid', '!=', '1', 'AND', $conds);
					$ds = BackLineHelp::getLineList($conds, 0, 0, $total, array('create_time'=>'desc'), false);
				} else {
					// 线路
					$archiveObj = ModelBase::getInstance('archives', 'xz_');
					$cds = appendLogicExp('channel', '=', '17', 'AND');
					$cds = appendLogicExp('title', 'like', '%'.$findstr.'%', 'AND', $cds);
					$ds = $archiveObj->getAll($cds);
				}
				$data['conds'] = $conds;
				$data['result'] = error(0,'');
				$data['data'] = $ds;
			}
			$this->ajaxReturn($data);		
		} else {
			$data['result'] = error(-1, '请求方式非法');
			return $this->ajaxReturn($data);
		}
	}
	
	// 批次查找
	public function activityFindAction() {
		if (IS_POST) {
			$aa = $_POST;
			if (!empty($aa['new_line'])) {
				if (!empty($aa['aid'])) {
					$conds =  appendLogicExp('line_id', '=', $aa['aid']);
				}
				$ds = BackLineHelp::getBatchList($conds, 0, 0, $total, array('start_time'=>'desc'), false);
				if (!empty($ds)) {
					foreach ($ds as $k=>$v) {
						$ds[$k]['show_text'] = $v['start_date_show'].' -- '.$v['end_date_show'];
					}
				}
			} else {
				// 批次			
				$activityObj = ModelBase::getInstance('lineactivity', 'xz_');
				$colNames = $activityObj->getUserDefine(ModelBase::DF_COL_NAMES);
				$cols = coll_elements_giveup($colNames, $aa);
				$conds = MyHelp::getLogicExp($cols, '=', 'AND');
				// 过滤无效批次
	//			$conds = appendLogicExp('startdate', '>', time(), 'AND', $conds);
				$ds = $activityObj->getAll($conds, 0, 0, $total, 'startdate');
				if (!empty($ds)) {
					foreach ($ds as $k=>$v) {
						$ds[$k]['show_text'] = date('Y年m月d日', $v['startdate']).' -- '.date('Y年m月d日', $v['enddate']);
					}
				}
			}
			$data['data'] = $ds;
			$data['result'] = error(0,'');
			$this->ajaxReturn($data);			
		} else {
			$data['result'] = error(-1, '请求方式非法');
			return $this->ajaxReturn($data);
		}
	}
	
	// 订单编号查找
	public function ordersnFindAction() {
		if (IS_POST) {
			$aa = $_POST;
			// 订单对象
			$lineObj = ModelBase::getInstance('lineenertname', 'xz_');
			$lineColNames = $lineObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$cds = coll_elements_giveup($lineColNames, $aa); 
			$conds = MyHelp::getLogicExp($cds, '=', 'AND');
			$data['cds'] = $cds;
			$data['conds'] = $conds;
			$data['aa'] = $aa;
			$lines = $lineObj->getAll($conds, 0, 0, $total, 'addtime');
			$data['data'] = $lines;
			$data['result'] = error(0,'');
			$this->ajaxReturn($data);			
		} else {
			$data['result'] = error(-1, '请求方式非法');
			return $this->ajaxReturn($data);
		}
	}
	
	// 获取订单中参团人数量
	public function getOrderMemberCountAction() {
		if (IS_POST) {
			$aa = $_POST;
			$data['result'] = error(0, '');
			// 订单对象
			$lineObj = ModelBase::getInstance('lineenertname', 'xz_');
			$lineColNames = $lineObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$cds = coll_elements_giveup($lineColNames, $aa); 
			$conds = MyHelp::getLogicExp($cds, '=', 'AND');
			$line = $lineObj->getOne($conds, 0, 0, $total, 'addtime');
			if (!empty($line)) {
				$data['count'] = intval($line['male']) + intval($line['woman']) + intval($line['child']);
			} else {
				$data['count'] = 0;
			}
			$this->ajaxReturn($data);			
		} else {
			$data['result'] = error(-1, '请求方式非法');
			return $this->ajaxReturn($data);
		}
	}
	
	// 获取参团人信息
	private function getExportOrderMembers($orderidstr, $orderMap, &$out) {
		if (empty($orderidstr) || empty($orderMap)) {
			return array();
		}
				
		$memberObj = ModelBase::getInstance('signup_member');
		$params['table'] = '`kl_signup_member` AS `q1`';
		$params['col'] = array(
			'`q1`.`order_id`'=>'`order_id`',
			'`q1`.`name`'=>'`name`',
			'`q1`.`tel`'=>'`tel`',
			'`q2`.`type_desc`'=>'`type_id_desc`',
			'`q3`.`type_desc`'=>'`certificate_type_id_desc`',
			'`q1`.`certificate_num`'=>'`certificate_num`',
			'`q1`.`exit`'=>'`exit`'
		);
		$params['join'] = array(
			'LEFT JOIN `kl_member_type` AS `q2` ON `q1`.`type_id` = `q2`.`id`',
			'LEFT JOIN `kl_certificate_type` AS `q3` ON `q1`.`certificate_type_id` = `q3`.`id`',
		);
		$params['conds'] = appendLogicExp('`q1`.`order_id`', 'IN', '('.$orderidstr.')');
		$params['sort'] = array('`q1`.`order_id`'=>'desc');
		$ds = $memberObj->queryData($params, $total, $out);
		
		$members = array();
		foreach ($ds as $dk=>$dv) {
			$order = $orderMap['order_'.$dv['order_id']];
			$member = array();
			array_push($member,$order['order_sn']);
			array_push($member,$order['lineid']);
			array_push($member,$order['lineid_title']);
			array_push($member,$order['hdid_show_text']);
			array_push($member,$order['addtime_show_text']);
			array_push($member,$order['hdid_start_time']);
			array_push($member, empty($order['zhuangtai_data']['type_desc']) ? '未知' : $order['zhuangtai_data']['type_desc']);
			array_push($member, $order['pay_cash']);
			array_push($member, $order['team_cut_price']);
			array_push($member, $order['need_pay_money']);
			array_push($member,$dv['name']);
			array_push($member,$dv['type_id_desc']);
			array_push($member,$dv['tel']);
			array_push($member,$dv['certificate_type_id_desc']);
			array_push($member,$dv['certificate_num']);
			array_push($member,'');
			array_push($member,$dv['exit'] == 2 ? '已退团' : '');
			array_push($member,$order['kefu_beizhu']);
			array_push($member,$dv['beizhu']);
			array_push($members, $member);
		}		
		return $members;		
	}
	
	// 获取订单支付记录	
	private function getExportOrderPayments($orderidstr, $orderMap, &$out) {
		if (empty($orderidstr) || empty($orderMap)) {
			return array();
		}		
		
		$orderPayCash = array();
		$pays = array();
		
		$payObj = ModelBase::getInstance('pay_log');
		$params['table'] = '`xz_pay_log` AS `q1`';
		$params['col'] = array(
			'`q1`.`datetime`'=>'`datetime`',
			'`q1`.`SendTime`'=>'`SendTime`',
			'`q1`.`order_id`'=>'`order_id`',
			'`q1`.`TransAmount`'=>'`TransAmount`',
			'`q1`.`InstCode`'=>'`InstCode`',
			'`q1`.`TransNo`'=>'`TransNo`',
			'`q2`.`item_desc`'=>'`PayChannel_item_desc`',
		);
		$params['join'] = array(
			'LEFT JOIN `kl_menu_item` AS `q2` ON `q1`.`PayChannel` = `q2`.`id`',
		);
		$conds = appendLogicExp('`q1`.`order_id`', 'IN', '('.$orderidstr.')');
		$conds = appendLogicExp('`q1`.`TransAmount`', '!=', '', 'AND', $conds);
		$params['conds'] = $conds;
		$params['sort'] = array('`q1`.`order_id`'=>'desc');
		$ds = $payObj->queryData($params, $total,  $out['pay']);
		foreach ($ds as $dk=>$dv) {
			$pay = array();
			$order = $orderMap['order_'.$dv['order_id']];
			array_push($pay, $order['order_sn']);
			array_push($pay, $order['lineid']);
			array_push($pay, $order['lineid_title']);
			array_push($pay, $order['hdid_show_text']);
			array_push($pay, $order['names']);
			array_push($pay, $order['mob']);
			array_push($pay, '支付');
			array_push($pay, '团费');
			array_push($pay, $dv['TransAmount']);
			array_push($pay, empty($dv['PayChannel_item_desc']) ? '未知' : $dv['PayChannel_item_desc']);
			array_push($pay, '在线支付');
			array_push($pay, $dv['InstCode']);
			array_push($pay, $dv['TransNo']);
			array_push($pay, '完成');
			array_push($pay, date('Y-m-d H:i:s', strtotime($dv['SendTime'])));
			array_push($pay, date('Y-m-d H:i:s', $dv['datetime']));
			array_push($pays, $pay);
			$order_pay_cash = empty($orderPayCash['order_'.$dv['order_id']]) ? 0.00 : $orderPayCash['order_'.$dv['order_id']];
			$orderPayCash['order_'.$dv['order_id']] = bcadd($order_pay_cash, floatval($pv['TransAmount']), 2);
		}
		
		$reviewObj = ModelBase::getInstance('order_review');
		$params['table'] = '`kl_order_review` AS `q1`';
		$params['col'] = array(
			'`q1`.`order_id`'=>'`order_id`',
			'`q2`.`type_desc`'=>'`cash_func_id_desc`',
			'`q2`.`type_key`'=>'`cash_func_id_key`',
			'`q3`.`type_desc`'=>'`cash_use_id_desc`',
			'`q4`.`item_desc`'=>'`pay_channel_id_desc`',
			'`q5`.`item_desc`'=>'`pay_type_id_desc`',
			'`q6`.`item_desc`'=>'`pay_bank_id_desc`',
			'`q7`.`type_desc`'=>'`review_type_id_desc`',
			'`q1`.`cash`'=>'`cash`',
			'`q1`.`bank_code`'=>'`bank_code`',
			'`q1`.`create_time`'=>'`create_time`',
			'`q1`.`update_time`'=>'`update_time`',
		);
		$params['join'] = array(
			'LEFT JOIN `kl_cash_function` AS `q2` ON `q1`.`cash_func_id` = `q2`.`id`',
			'LEFT JOIN `kl_cash_use` AS `q3` ON `q1`.`cash_use_id` = `q3`.`id`',
			'LEFT JOIN `kl_menu_item` AS `q4` ON `q1`.`pay_channel_id` = `q4`.`id`',
			'LEFT JOIN `kl_menu_item` AS `q5` ON `q1`.`pay_type_id` = `q5`.`id`',
			'LEFT JOIN `kl_menu_item` AS `q6` ON `q1`.`pay_bank_id` = `q6`.`id`',
			'LEFT JOIN `kl_review_type` AS `q7` ON `q1`.`review_type_id` = `q7`.`id`',
		);
		$conds = appendLogicExp('`q1`.`order_id`', 'IN', '('.$orderidstr.')');
		$conds = appendLogicExp('`q7`.`type_key`', '=', 'review_pass', 'AND', $conds);
		$params['conds'] = $conds;
 		$params['sort'] = array('`q1`.`order_id`'=>'desc');
		$ds = $reviewObj->queryData($params, $total, $out['review']);
		foreach ($ds as $dk=>$dv) {
			$pay = array();
			$order = $orderMap['order_'.$dv['order_id']];
			array_push($pay, $order['order_sn']);
			array_push($pay, $order['lineid']);
			array_push($pay, $order['lineid_title']);
			array_push($pay, $order['hdid_show_text']);
			array_push($pay, $order['names']);
			array_push($pay, $order['mob']);
			array_push($pay, $dv['cash_func_id_desc']);
			array_push($pay, $dv['cash_use_id_desc']);
			if ($dv['cash_func_id_key'] == 'pay') {
				$order_pay_cash = empty($orderPayCash['order_'.$dv['order_id']]) ? 0.00 : $orderPayCash['order_'.$dv['order_id']];
				$orderPayCash['order_'.$dv['order_id']] = bcadd($order_pay_cash, floatval($dv['cash']), 2);
				array_push($pay, $dv['cash']);
			} else {
				$order_pay_cash = empty($orderPayCash['order_'.$dv['order_id']]) ? 0.00 : $orderPayCash['order_'.$dv['order_id']];
				$orderPayCash['order_'.$dv['order_id']] = bcsub($order_pay_cash, floatval($dv['cash']), 2);
				array_push($pay, '-'.$dv['cash']);
			}
			array_push($pay, empty($dv['pay_channel_id_desc']) ? '未知' : $dv['pay_channel_id_desc']);
			array_push($pay, empty($dv['pay_type_id_desc']) ? '未知' : $dv['pay_type_id_desc']);
			array_push($pay, empty($dv['pay_bank_id_desc']) ? '未知' : $dv['pay_bank_id_desc']);
			array_push($pay, $dv['bank_code']);
			array_push($pay, $dv['review_type_id_desc']);
			array_push($pay, $dv['create_time']);
			array_push($pay, $dv['update_time']);
			array_push($pays, $pay);
		}
		
		// 按照create_time进行排序
		if (!empty($pays)) {
			$sortArray = array();
			foreach($pays as $pk=>$pv) {
				$payUnixTime = strtotime($pv[14]);
				$payMap[$pk] = $pv;
				$sortArray[$pk] = $payUnixTime;
			}
			if (arsort($sortArray, SORT_NUMERIC) === true) {
				$newPays = array();
				foreach ($sortArray as $k=>$v) {
					array_push($newPays, $payMap[$k]);
				}
				$pays = $newPays;
			}
		}
		
		$payDatas['sumpays'] = $orderPayCash;
		$payDatas['data'] = $pays;
		return $payDatas;		
	}
	
	// 获取订单额外费用
	private function getExportOrderExtraCash($orderidstr, $orderMap, &$out) {		
		$extraObj = ModelBase::getInstance('order_extra_cash');
		$params['table'] = '`kl_order_extra_cash` AS `q1`';
		$params['col'] = array(
			'`q1`.`order_id`'=>'`order_id`',
			'`q2`.`type_desc`'=>'`cash_use_id_desc`',
			'`q1`.`cash`'=>'`cash`',
			'`q1`.`bind_time`'=>'`bind_time`',
			'`q1`.`reason`'=>'`reason`',
		);
		$params['join'] = array(
			'LEFT JOIN `kl_cash_use` AS `q2` ON `q1`.`cash_use_id` = `q2`.`id`',
		);
		$conds = appendLogicExp('`q1`.`order_id`', 'IN', '('.$orderidstr.')');
		$conds = appendLogicExp('`q1`.`invalid`', '=', '0', 'AND', $conds);
		$params['conds'] = $conds;
		$params['sort'] = array('`q1`.`order_id`'=>'desc');
		$ds = $extraObj->queryData($params, $total, $out);
		
		$extras = array();
		foreach ($ds as $dk=>$dv) {
			$extra = array();
			$order = $orderMap['order_'.$dv['order_id']];
			array_push($extra, $order['order_sn']);
			array_push($extra, $order['lineid']);
			array_push($extra, $order['lineid_title']);
			array_push($extra, $order['hdid_show_text']);
			array_push($extra, $dv['cash_use_id_desc']);
			array_push($extra, $dv['cash']);
			array_push($extra, $dv['bind_time']);
			array_push($extra, $dv['reason']);
			array_push($extras, $extra);
		}		
		return $extras;	
	}
	
	// 获取订单减除费用
	private function getExportOrderSysCoupon($orderidstr, $orderMap, &$out) {		
		$couponObj = ModelBase::getInstance('order_coupon');
		$params['table'] = '`kl_order_coupon` AS `q1`';
		$params['col'] = array(
			'`q1`.`order_id`'=>'`order_id`',
			'`q2`.`type_desc`'=>'`coupon_type_id_desc`',
			'`q1`.`cash`'=>'`cash`',
			'`q1`.`bind_time`'=>'`bind_time`',
			'`q1`.`reason`'=>'`reason`',
		);
		$params['join'] = array(
			'LEFT JOIN `kl_coupon_type` AS `q2` ON `q1`.`coupon_type_id` = `q2`.`id`',
		);
		$conds = appendLogicExp('`q1`.`order_id`', 'IN', '('.$orderidstr.')');
		$conds = appendLogicExp('`q1`.`invalid`', '=', '0', 'AND', $conds);
		$params['conds'] = $conds;
		$params['sort'] = array('`q1`.`order_id`'=>'desc');
		$ds = $couponObj->queryData($params, $total, $out);
		
		$coupons = array();
		foreach ($ds as $dk=>$dv) {
			$coupon = array();
			$order = $orderMap['order_'.$dv['order_id']];
			array_push($coupon, $order['order_sn']);
			array_push($coupon, $order['lineid']);
			array_push($coupon, $order['lineid_title']);
			array_push($coupon, $order['hdid_show_text']);
			array_push($coupon, $dv['coupon_type_id_desc']);
			array_push($coupon, $dv['cash']);
			array_push($coupon, $dv['bind_time']);
			array_push($coupon, $dv['reason']);
			array_push($coupons, $coupon);
		}		
		return $coupons;	
	}
	
	// 获取导出订单信息
	private function getExportOrderInfo(&$out) {
		$out['export_name'] = 'testsetsetestse';
		session_start();
		$orders = session('order_excel_export');
//		p_a($orders);
		$worksheet = array();
		if (count($orders) > 0) {
			$infos[0] = array('订单编号', '线路编号', '线路名称', '批次', '用户名', '订单来源', '客户来源', '渠道订单号', '联系人姓名', '联系人手机', '成人男', '成人女', '小孩', '订单状态', '线路成人价', '线路小孩价', '已支付金额', '总团费', '总金额', '下单时间', '客服备注', '客户备注');
			$members[0] = array('订单编号', '线路编号', '线路名称', '批次', '报名日期', '出团日期', '订单状态', '已支付定金', '总团费', '总金额', '参团人姓名', '参团人类型', '参团人手机', '参团人证件类型', '参团人证件', '房间信息', '退团', '客服备注', '客户备注');
			$pays[0] = array('订单编号', '线路编号', '线路名称', '批次', '联系人', '联系人电话', '费用功能', '费用用途', '交易金额', '支付渠道', '支付类型', '支付银行', '回执编号', '交易结果', '支付时间', '回执时间');
			$extras[0] = array('订单编号', '线路编号', '线路名称', '批次', '费用用途', '额外费用', '绑定时间', '绑定原因');
			$coupons[0] = array('订单编号', '线路编号', '线路名称', '批次', '减除类型', '减除费用', '减除时间', '减除原因');
						
			// 要导出的订单编辑成条件和快速查找Map表
			foreach($orders as $k=>$v) {
				if (!empty($ordercds)) {
					$ordercds .= ',';
				}
				$ordercds .= $v['id'];
				// 转换参团人到新表
				$result = BackOrderHelp::memberTableChangeOld2New($order, $memberIds, $exitRS);
				// 保存订单Map表
				$orderMap['order_'.$v['id']] = $v;
			}
			
			// 参团人
			$memberDatas = $this->getExportOrderMembers($ordercds, $orderMap, $outmb);
			$out['member'] = $outmb;
			$members = array_merge($members, $memberDatas);
			// 付款信息
			$payDatas = $this->getExportOrderPayments($ordercds, $orderMap, $outpay);
			$out['pay'] = $outpay;
			$pays = array_merge($pays, $payDatas['data']);
			// 额外费用
			$extraDatas = $this->getExportOrderExtraCash($ordercds, $orderMap, $outextra);
			$out['extra'] = $outextra;
			$extras = array_merge($extras, $extraDatas);
			// 减除费用
			$couponDatas = $this->getExportOrderSysCoupon($ordercds, $orderMap, $outcoupon);
			$out['coupon'] = $outcoupon;
			$coupons = array_merge($coupons, $couponDatas);
			// 订单信息			
			$index = 1; $mIndex = 1; $pIndex = 1;
			foreach($orders as $k=>$v) {
				$info = array();
				array_push($info, $v['order_sn']);
				array_push($info, $v['lineid']);
				array_push($info, $v['lineid_title']);
				array_push($info, $v['hdid_show_text']);
				array_push($info, $v['userid_show_text']);
				array_push($info, empty($v['from_id_data']['type_desc']) ? '未知' : $v['from_id_data']['type_desc']);
				array_push($info, empty($v['customer_from']) ? '未知' : $v['customer_from']);
				array_push($info, $v['channel_order_sn']);
				array_push($info, $v['names']);
				array_push($info, $v['mob']);
				array_push($info, $v['male']);
				array_push($info, $v['woman']);
				array_push($info, $v['child']);
				array_push($info, empty($v['zhuangtai_data']['type_desc']) ? '未知' : $v['zhuangtai_data']['type_desc']);
				array_push($info, $v['hdid_priceadult']);
				array_push($info, $v['hdid_pricechild']);
//				$payCash = $payDatas['sumpays']['order_'.$v['id']];
				array_push($info, $v['pay_cash']);
				array_push($info, $v['team_cut_price']);
				array_push($info, $v['need_pay_money']);
				array_push($info, $v['addtime_show']);
				array_push($info, $v['kefu_beizhu']);
				array_push($info, $v['beizhu']);
				array_push($infos, $info);
			}
			
			$worksheets[0]['title'] = '订单信息';
			$worksheets[0]['data'] = $infos;
			$worksheets[1]['title'] = '参团人信息';
			$worksheets[1]['data'] = $members;
			$worksheets[2]['title'] = '支付信息';			
			$worksheets[2]['data'] = $pays;
			$worksheets[3]['title'] = '额外费用';			
			$worksheets[3]['data'] = $extras;
			$worksheets[4]['title'] = '系统减除';			
			$worksheets[4]['data'] = $coupons;
		}	
		return $worksheets;
	}
	
	// 导出订单
	public function exportExcelAction() {
		$worksheets = $this->getExportOrderInfo($out);
		if (!empty($worksheets)) {	
//			$data['ds'] = $worksheets[4];
//			$data['out'] = $out;
//			$this->assign('data', $data);	
//			$this->display('Index/test');
			MyHelp::exportExcel('order', $worksheets);
		} else {
			echo ('<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><script type="text/javascript">console.log("'.a_2_s($out).'");alert("数据为空，导出失败");</script><head></html>');
//			echo ($_SERVER['REQUEST_URI']);
//			$this->redirect($_SERVER['REQUEST_URI'], 5, '5秒后页面将进行跳转');
//			redirect($_SERVER['REQUEST_URI']);
		}	
	}
	
	// 导入订单
	public function importExcelAction() {
		$info = MyHelp::importExcel();
		if (is_error($info) === true) {
			return $this->ajaxReturn($info);
		}
		
		if (empty($info['ds'])) {
			$data['result'] = error(-1, '导入文件不存在数据');
			return $this->ajaxReturn($data);			
		}
		$ds = $info['ds'];
		
		$headArr=array('id', 'lineid', 'hdid', 'userid', 'male', 'woman', 'child', 'from_id', 'qz_num1', 'qz_num2', 'qz_num3', 'qz_num4', 'types'
			, 'names', 'gender', 'certificate_type_id', 'shenfenid', 'mob', 'ct_diaocha', 'ct_zjcode', 'ct_zhengjian', 'ct_names', 'ct_sjnum', 
			'ct_types', 'beizhu', 'addtime', 'addip', 'zhuangtai', 'shengfen', 'order_sn', 'pay_type', 'ispay', 'paytime', 'PayChannel', 'InstCode', 
			'isdj', 'paycishu', 'card_id', 'card_code', 'card_is', 'lineid.title', 'hdid.show_text', 'member_total_count', 'addtime.show_text', 'zhuangtai.type_desc');
		
		$saveData = array();
		foreach ($ds as $k=>$v) {
			if ($headArr[$k] == 'id') {
				continue;
			} else if ($headArr[$k] == 'addtime') {
				$v = time();				
			} else if ($headArr[$k] === 'order_sn') {
				$v = 'LX-'.date('YmdHis', time()).getMillisecond().$ds['from_id'];
			}
			$saveData[$headArr[$k]] = $v;
		}
		
		if (empty($saveData)) {
			$line = ModelBase::getInstance('lineenertname', 'xz_');
			$result = $line->create($saveData);
		}
				
		$data['result'] = error(0, '导入数据成功');
		if (error_ok($result) === false) {
			$data['result'] = $result;
		}
		return $this->ajaxReturn($data);
	}
	
	// 测试动作
	public function testAction() {		
		$totalCount = 0;
		$grantObj = UtilModel::createModelBaseChild(UtilModel::UTIL_ADMIN);
		$ds = $grantObj->getAll(array(), 0, 5, $totalCount, 'update_time', true);
//		$objGrant = UtilModel::createGrantBaseChild(UtilModel::UTIL_ADMIN);	
//		$ds = $objGrant->fillType($ds);	
		p_a($ds);
	}	
}

?>