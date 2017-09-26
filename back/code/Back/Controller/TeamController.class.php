<?php

namespace Back\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackTeamHelp;
use Core\Model\BackOrderHelp;
use Core\Model\BackReviewHelp;
use Core\Model\BackLineHelp;
use Core\Model\BackAccountHelp;
use Core\Model\BackExtraCashHelp;

class TeamController extends BackBaseController {
	
	protected function _initialize(){	
		$this->page_title = '包团列表';
		$this->content_title_show = 0;
	}
		
	private function getFindListCDS($cds) {
		if (empty($cds)) {
			return array();
		}   
		
		$cdList = array();
		foreach ($cds as $k=>$v) {
			switch($k){
				case 'create_admin': $cdList['create_admin'] = $v; break;
				case 'dispose_admin': $cdList['dispose_admin'] = $v; break;
				case 'link_man': $cdList['linkman'] = $v; break;
				case 'link_tel': $cdList['tel'] = $v; break;
				case 'from_id': $cdList['from_id'] = $v; break;
				case 'state_id': $cdList['dispose_state_id'] = $v; break;
				case 'result_id': $cdList['team_result'] = $v; break;
				case 'date_type': $cdList['date_type'] = $v; break;
				case 'sdate': $cdList['sdate'] = $v; break;
				case 'edate': $cdList['edate'] = $v; break;
				default: break;
			}
		}
		
		MyHelp::filterInvalidConds($cdList);		
		return $cdList;
	}
	
	// 小包团列表
	private function typeList($aa) {
		if (check_grant('list_team_group') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		$totalCount = 0;			
		$cdsstr = I('post.cdsstr', '');
		$conds = MyHelp::getCondsByStr($cdsstr,4);
		$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
		$data['cdsstr'] = $cdsstr;
		
		$startIndex = intval($aa['iDisplayStart']);
		$showLength = intval($aa['iDisplayLength']);
		
		
		if (check_grant('list_all_team_group') === false) {
			$admin = MyHelp::getLoginAccount(true);		
			$adminCDS = appendLogicExp('create_admin_id', '=', $admin['id'], 'OR', $adminCDS);
			$adminCDS = appendLogicExp('dispose_admin_id', '=', $admin['id'], 'OR', $adminCDS);
			$myconds = appendLogicExp('admin_id', '=', $adminCDS, 'AND', $conds);
		} else {
			$myconds = $conds;
		}
				
		$data['conds'] = $myconds;
		$groupTeamObj = ModelBase::getInstance('team_group');	
		$ds = $groupTeamObj->getAll($myconds, $startIndex, $showLength, $totalCount, 'create_time', true);
		if (empty($ds)) {
			$ds = array();
		}	
		
		if (!empty($ds)) {
			$typeDataObj = ModelBase::getInstance('type_data');
			$typeDatas = $typeDataObj->getAll(ap);
			foreach ($typeDatas as $tdk=>$tdv) {			
				$typeDataMap[$tdv['id']] = $tdv;
			}
			
			$stateObj = ModelBase::getInstance('order_state');
			$states = $stateObj->getAll();
			foreach($states as $sk=>$sv) {
				$stateMap[$sv['id']] = $sv;
			}
			
			$fromObj = ModelBase::getInstance('order_from');
			$froms = $fromObj->getAll();
			foreach($froms as $fk=>$fv) {
				$fromMap[$fv['id']] = $fv;
			}
			
			$adminTypeObj = ModelBase::getInstance('admin_type');
			$adminTypes = $adminTypeObj->getAll();
			foreach($adminTypes as $atk=>$atv) {
				$adminTypeMap[$atv['id']] = $atv;
			}
			
			$adminObj = ModelBase::getInstance('admin');
			$admins = $adminObj->getAll();
			foreach($admins as $ak=>$av) {
				if (!empty($adminTypeMap[$av['type_id']])){
					$adminType = $adminTypeMap[$av['type_id']];
					$av['type_id_type_desc'] = $adminType['type_desc'];
				}
				$adminMap[$av['id']] = $av;				
			}
			
			$assign_enabled = check_grant('assgin_team_group');
			$dispose_enabled = check_grant('dispose_team_group');
			$admin = MyHelp::getLoginAccount(true);	
						
			foreach ($ds as $dk=>$dv) {	
				$dv['show_assign_btn'] = false;
				$dv['show_dispose_btn'] = false;
				$dv['dispose_admin_id.show_text'] = '无';
				
				// 创建人
				if (!empty($dv['create_admin_id'])) {
					$createAdmin = $adminMap[$dv['create_admin_id']];
					$dv['create_admin_id.account'] = $createAdmin['account'];
					$dv['create_admin_id.show_text'] = $createAdmin['type_id_type_desc'].'->'.$createAdmin['account'];
				} else {
					$dv['create_admin_id.show_text'] = '客户->'.$dv['linkman'];
				}
				
				// 显示接受按钮
				if (!empty($dv['dispose_admin_id'])) {
					$disposeAdmin = $adminMap[$dv['dispose_admin_id']];
					$dv['dispose_admin_id.account'] = $disposeAdmin['account'];
					$dv['dispose_admin_id.show_text'] = $disposeAdmin['type_id_type_desc'].'->'.$disposeAdmin['account'];
					if ($dispose_enabled === true && $admin['id'] === $dv['dispose_admin_id']) {
						$stateKey = $stateMap[$dv['dispose_state_id']]['type_key'];
						if ($stateKey === 'team_assign_wait' || $stateKey === 'team_dispose_wait') {
							$dv['show_dispose_btn'] = true;
						}
					}	
				} else {
					// 显示分配按钮
					$dv['show_assign_btn'] = $assign_enabled;					
				}
				
				$dv['show_delete_btn'] = false;				
				if ($admin['account'] === 'admin' || check_grant('force_team_group')) {
					$dv['show_assign_btn'] = true;
					$dv['show_delete_btn'] = true;
				}
				
				// 填充小包团状态
				if (!empty($dv['dispose_state_id'])) {
					$dv['dispose_state_id.type_desc'] = $stateMap[$dv['dispose_state_id']]['type_desc'];
				}
				
				// 填充订单来源状态
				if (!empty($dv['from_id'])) {
					$dv['from_id.type_desc'] = $fromMap[$dv['from_id']]['type_desc'];
				}
				
				// 酒店要求
				$typeData = $typeDataMap[$dv['hotel_request']];
				$dv['hotel_request.type_desc'] = $typeData['type_desc'];
				
				// 领队要求
				$typeData = $typeDataMap[$dv['leader_request']];
				$dv['leader_request.type_desc'] = $typeData['type_desc'];
				
				// 车辆需求
				$typeData = $typeDataMap[$dv['car_request']];
				$dv['car_request.type_desc'] = $typeData['type_desc'];
				
				// 特色服务
				$typeData = $typeDataMap[$dv['especial_request']];
				$dv['especial_request.type_desc'] = $typeData['type_desc'];
				
				// 联系时间
				$typeData = $typeDataMap[$dv['contact_time']];
				$dv['contact_time.type_desc'] = $typeData['type_desc'];
				
				// 去程交通
				$typeData = $typeDataMap[$dv['go_traffic']];
				$dv['go_traffic.type_desc'] = $typeData['type_desc'];
				
				// 回城交通
				$typeData = $typeDataMap[$dv['back_traffic']];
				$dv['back_traffic.type_desc'] = $typeData['type_desc'];
				
				// 处理结果
				$typeData = $typeDataMap[$dv['team_result']];
				$dv['team_result.type_desc'] = $typeData['type_desc'];
				
				$ds[$dk] = $dv;
			}
		}
		
		$data['sColumns'] = $colNames;
		$data['sEcho'] = $aa['sEcho'];	
		$data['iDisplayStart'] = $startIndex;
		$data['iDisplayLength'] = $showLength;
		$data['iTotalRecords'] = $totalCount;
		$data['iTotalDisplayRecords'] = $totalCount;
		$data['aaData'] = $ds;		
		$data['result'] = error(0,"");
		$this->ajaxReturn($data);		
	}
	
	// 创建小包团
	private function typeCreate($aa) {
		if (check_grant('create_team_group') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
			
		$data['result'] = BackTeamHelp::createTeamGroup($aa, $teamId, $output);
		$data['output'] = $output;
		$data['groupTeamId'] = $teamId;
		return $this->ajaxReturn($data);		
	}
	
	// 查找小包团
	private function typeFind($aa) {
		if (!array_key_exists('data_type', $aa)) {
			$data['result'] = error(-1, '参数不齐全，无法查找小包团信息');
			return $this->ajaxReturn($data);
		}
		
		$data['result'] = error(0, '查找小包团信息成功');
		$groupTeamObj = ModelBase::getInstance('team_group');
		$colNames = $groupTeamObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$cds = coll_elements_giveup($colNames, $aa);
		
		$conds = MyHelp::getLogicExp($cds, '=', 'AND');
		if ($aa['data_type'] === 'one') {
			$data['data'] = $groupTeamObj->getOne($conds);
		} else {
			$data['data'] = $groupTeamObj->getAll($conds);	
		}
		return $this->ajaxReturn($data);		
	}
	
	// 编辑小包团
	private function typeEdit($aa) {		
		if (!array_key_exists('cds', $aa) || !array_key_exists('data', $aa)) {
			$data['result'] = error(-1, '参数不齐全，无法查找编辑小包团信息');
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
		
		$data['cds'] = $cds;
		$data['ds'] = $ds;
		// 判断是否在指定状态下
		$teamObj = ModelBase::getInstance('team_group');
		$conds = MyHelp::getLogicExp($cds, '=', 'AND');
		$team = $teamObj->getOne($conds);
		if (empty($team)) {
			$data['result'] = error(-1, '小包团不存在，修改信息失败');
			return $this->ajaxReturn($data);
		}
		
		$admin = MyHelp::getLoginAccount(true);
		if ($admin['account'] !== 'admin') {
			if (check_grant('force_team_group') === false && ($admin['id'] !== $team['dispose_admin_id'] || check_grant('update_team_group') === false)) {
				$data['result'] = error(-1, '您没有操作权限或者改小包团未分配给您，请获得此权限后再进行此操作');
				return $this->ajaxReturn($data);
			}
		}
		
		if ($admin['account'] !== 'admin' && check_grant('force_team_group') === false) {
			$stateObj = ModelBase::getInstance('order_state');
			$state = $stateObj->getOne(appendLogicExp('type_key', '=', 'team_disposing'));
			if (empty($state)) {
				$data['result'] = error(-1, '小包团状态错误，修改信息失败');
				return $this->ajaxReturn($data);
			}
			
			if ($team['dispose_state_id'] !== $state['id']) {
				$data['result'] = error(-1, '当前小包团状态不允许修改信息');
				return $this->ajaxReturn($data);
			}	
		}				
					
		$colNames = $teamObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$conds = coll_elements_giveup($colNames, $cds);
		$conds = MyHelp::getLogicExp($conds, '=', 'AND');
		$saveData = coll_elements_giveup($colNames, $ds);
		
		$team = $teamObj->getOne($conds);
		if (empty($team)) {
			$data['result'] = error(-1, '包团信息错误，未能找到小包团');
			return $this->ajaxReturn($data);
		}
		
		$data['ds'] = $saveData;
		$data['result'] = $teamObj->modify($saveData, $conds);
		if (error_ok($data['result'])) {
			$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
			$conds = appendLogicExp('lineid', '=', $team['id']);
			$conds = appendLogicExp('order_sn', 'LIKE', 'YD-%', 'AND', $conds);
			$order = $orderObj->getOne($conds);
			if (!empty($saveData['price_adult']) || !empty($saveData['price_child'])) {
				$data['refresh_money'] = BackOrderHelp::getOrderNeedPayMoney($order['id'], true);
				$data['refresh_money']['order'] = $order;
			}
		}
		return $this->ajaxReturn($data);		
	}
	
	// 删除小包团
	private function typeDelete($aa) {
		if (!array_key_exists('id', $aa)) {
			$data['result'] = error(-1, '参数不齐全，无法删除小包团信息');
			return $this->ajaxReturn($data);
		}
		
		// 判断是否在指定状态下
		$teamObj = ModelBase::getInstance('team_group');
		$team = $teamObj->getOne(appendLogicExp('id', '=', $aa['id']));
		if (empty($team)) {
			$data['result'] = error(-1, '小包团不存在，删除失败');
			return $this->ajaxReturn($data);
		}
		
		$admin = MyHelp::getLoginAccount(true);
		if ($admin['account'] !== 'admin') {
			if (check_grant('force_team_group') === false && ($admin['id'] !== $team['dispose_admin_id'] || check_grant('delete_team_group') === false)) {
				$data['result'] = error(-1, '您没有操作权限或者改小包团未分配给您，请获得此权限后再进行此操作');
				return $this->ajaxReturn($data);
			}		
			
//			$stateObj = ModelBase::getInstance('order_state');
//			$state = $stateObj->getOne(appendLogicExp('type_key', '=', 'team_disposing'));
//			if (empty($state)) {
//				$data['result'] = error(-1, '小包团状态错误，删除失败');
//				return $this->ajaxReturn($data);
//			}
//			
//			if ($team['dispose_state_id'] !== $state['id']) {
//				$data['result'] = error(-1, '当前小包团状态不允许删除');
//				return $this->ajaxReturn($data);
//			}
		}
				
		$data['result'] = $teamObj->modify(array('invalid'=>'1'),appendLogicExp('id', '=', $aa['id']));
		return $this->ajaxReturn($data);		
	}
	
	private function showList() {
		// 获取包团来源
		$fromObj = ModelBase::getInstance('order_from');
		$from = $fromObj->getAll();
		$this->assign('TeamFrom', $from);	
				
		// 获取包团状态
		$stateObj = ModelBase::getInstance('order_state');		
		$stateTypeId = MyHelp::IdEachTypeKey('state_type', 'team_group');
		if (is_error($stateTypeId) === false) {
			$state = $stateObj->getAll(appendLogicExp('state_type_id', '=', $stateTypeId));
			$this->assign('TeamState', $state);	
		}		
		
		// 获取包团处理结果
		$resultTypeId = MyHelp::IdEachTypeKey('data_type', 'team_proc_result');
		if (is_error($resultTypeId) === false) {
			$resultObj = ModelBase::getInstance('type_data');
			$result = $resultObj->getAll(appendLogicExp('data_type_id', '=', $resultTypeId));
			$this->assign('TeamResult', $result);	
		}
		
		$this->menu_active = 'team_group';
		$this->menu_current = 'list';
		$this->content_title = '包团列表';
		$this->content_des = '这里你可以创建、编辑管理包团列表';
		$this->_setMenuLinkCurrent('包团列表', 'list');
		$this->_initTemplateInfo();				
			
		$this->assign('modal_data_edit', true);
		$this->assign('ajaxReqUrl', U('team/list'));
		$this->display('list');
	}
	
	public function listAction(){		
		if (IS_POST) {	
			$aa = $_POST;
			if (isset($aa['op_type'])) {
				$opType = $aa['op_type'];				
				if ($opType == 'find') {
					$this->typeFind($aa);
				} else if ($opType == 'edit') {
					$this->typeEdit($aa);
				} else if ($opType == 'delete') {
					$this->typeDelete($aa);
				} else if ($opType == 'list') {
					$this->typeList($aa);
				} else {
					$data['result'] = error(-1, '未知的类型动作请求');
					$this->ajaxReturn($data);
				}
			} else {
				$data['result'] = error(-1, '获取类型动作失败');
				$this->ajaxReturn($data);
			}			
		} else {
			$this->showList();
		}	
	}
	
	public function createAction() {		
		if (IS_POST) {
			$aa = $_POST;
			$this->typeCreate($aa);
		} else {					
			$this->menu_active = 'team_group';
			$this->menu_current = 'create';
			$this->content_title = '创建小包团';
			$this->content_des = '这里你可以创建、编辑管理小包团';
			$this->_setMenuLinkCurrent('创建小包团', 'create');
			$this->_initTemplateInfo();
			
			$dataTypeKeys = array('hotel_request', 'leader_request', 'car_request', 'especial_request', 'contact_time', 'team_proc_result');
			$assignDataKeys = array('hotelRequest', 'leaderRequest', 'carRequest', 'especialRequest', 'contactRequest', 'teamResult'); 
			$dataTypeObj = ModelBase::getInstance('data_type');
			$typeDataObj = ModelBase::getInstance('type_data');
			foreach ($dataTypeKeys as $dtk=>$dtv) {				
				$conds = appendLogicExp('type_key', '=', $dtv);
				$dataType = $dataTypeObj->getOne($conds);	
				if (!empty($dataType)) {
					$conds = appendLogicExp('data_type_id', '=', $dataType['id']);
					$typeDatas = $typeDataObj->getAll($conds);
					$this->assign($assignDataKeys[$dtk], $typeDatas);
				}
			}	
					
			// 包团来源		
			$fromObj = ModelBase::getInstance('order_from');
			$froms = $fromObj->getAll();
			if (!empty($froms)) {
				$this->assign('teamFrom', $froms);
			}
			$this->display('new');
		}
	}
	
	private function showInfo($teamId) {			
		$groupTeamObj = ModelBase::getInstance('team_group');
		$ds = $groupTeamObj->getOne(appendLogicExp('id', '=', $teamId));
			
		$dataTypeObj = ModelBase::getInstance('data_type');
		$dataTypes = $dataTypeObj->getAll();
		foreach ($dataTypes as $dtk=>$dtv) {			
			$dataTypeMap[$dtv['id']] = $dtv;
		}
					
		$dt = array();					
		$typeDataObj = ModelBase::getInstance('type_data');
		$typeDatas = $typeDataObj->getAll();
		foreach ($typeDatas as $tdk=>$tdv) {			
			$typeDataMap[$tdv['id']] = $tdv;
			if (!empty($dataTypeMap[$tdv['data_type_id']])) {
				$dataType = $dataTypeMap[$tdv['data_type_id']];
				$tdv['data_type_id_type_desc'] = $dataType['type_desc'];
				if (empty($dt[$dataType['type_key']])) {
					$dt[$dataType['type_key']] = array();
				}
				array_push($dt[$dataType['type_key']], $tdv);
			}
		}
		
		$this->assign('test', $dt);
		
		if (!empty($dt)) {
			foreach ($dt as $kk=>$vv) {
				$this->assign($kk, $vv);
			}
		}
		
		// 包团来源		
		$fromObj = ModelBase::getInstance('order_from');
		$froms = $fromObj->getAll();
		if (!empty($froms)) {
			foreach ($froms as $fk=>$fv) {
				if ($fv['id'] === $ds['from_id']) {
					$ds['from_id_type_desc'] = $fv['type_desc'];
				}
			}
			$this->assign('teamFrom', $froms);
		}
			
		// 酒店要求
		$typeData = $typeDataMap[$ds['hotel_request']];
		$ds['hotel_request_type_desc'] = $typeData['type_desc'];
		
		// 领队要求
		$typeData = $typeDataMap[$ds['leader_request']];
		$ds['leader_request_type_desc'] = $typeData['type_desc'];
		
		// 车辆需求
		$typeData = $typeDataMap[$ds['car_request']];
		$ds['car_request_type_desc'] = $typeData['type_desc'];
		
		// 特色服务
		$typeData = $typeDataMap[$ds['especial_request']];
		$ds['especial_request_type_desc'] = $typeData['type_desc'];
		
		// 联系时间
		$typeData = $typeDataMap[$ds['contact_time']];
		$ds['contact_time_type_desc'] = $typeData['type_desc'];
		
		// 去程交通
		$typeData = $typeDataMap[$ds['go_traffic']];
		$ds['go_traffic_type_desc'] = $typeData['type_desc'];
		
		// 回城交通
		$typeData = $typeDataMap[$ds['back_traffic']];
		$ds['back_traffic_type_desc'] = $typeData['type_desc'];
		
		// 回城交通
		$typeData = $typeDataMap[$ds['team_result']];
		$ds['team_result_type_desc'] = $typeData['type_desc'];
		
		// 接手管理员
		if (!empty($ds['dispose_admin_id'])) {
			$adminObj = ModelBase::getInstance('admin');
			$disposeAdmin = $adminObj->getOne(appendLogicExp('id', '=', $ds['dispose_admin_id']));
			if (!empty($disposeAdmin)) {
				$adminTypeObj = ModelBase::getInstance('admin_type');
				$adminType = $adminTypeObj->getOne(appendLogicExp('id', '=', $disposeAdmin['type_id']));
				if (!empty($adminType)) {
					$ds['dispose_admin_id_show_text'] = $adminType['type_desc'].'->'.$disposeAdmin['account'];
				}
			}
			$ds['dispose_admin_id_type_desc'] = $disposeAdmin['account'];
		}
		
		// 小包团状态
		if (!empty($ds['dispose_state_id'])) {
			$stateObj = ModelBase::getInstance('order_state');
			$state = $stateObj->getOne(appendLogicExp('id', '=', $ds['dispose_state_id']));
			$ds['dispose_state_id_type_desc'] = $state['type_desc'];
		}
		
				
		// 小包团跟进信息
		$messageObj = ModelBase::getInstance('team_message');
		$message = $messageObj->getAll(appendLogicExp('team_id', '=', $ds['id']), 0,0,$total,'create_time');
		if (!empty($message)) {
			foreach ($message as $sk=>$sv) {
				$adminObj = ModelBase::getInstance('admin');
				$admin = $adminObj->getOne(appendLogicExp('id', '=', $sv['admin_id']));
				if (!empty($admin)) {
					$sv['admin_id_account'] = $admin['account'];
					$message[$sk] = $sv;	
				}
			}
			$this->assign('message', $message);					
		}	
		
		$this->assign('team', $ds);
		
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$conds = appendLogicExp('lineid', '=', $ds['id']);
		$conds = appendLogicExp('order_sn', 'LIKE', 'YD-%', 'AND', $conds);
		$order = $orderObj->getOne($conds);
		if (!empty($order)) {
			$this->assign('order', $order);
		}
		
		$grant_enabled = false;
		$admin = MyHelp::getLoginAccount(true);		
		$especialGrant = $admin['account'] === 'admin' || check_grant('force_team_group');
		$checkAdminGrant = $admin['id'] === $ds['dispose_admin_id'] && check_grant('update_team_group') === true && !empty($state) && $state['type_key'] === 'team_disposing';
		if (empty($checkAdminGrant) === false) {
			$grant_enabled = true;	
		}
		
		$this->assign('grant_force_team', $especialGrant);		
		$this->assign('grant_update_team', $grant_enabled);		
		$this->assign('grant_list_scheduling', check_grant('list_team_scheduling'));
		 			
		$this->showPage('info', 'list', 'team_group', '详细信息', '小包团详细信息', '这里你可以编辑管理小包团详细信息');
	}
	
	// 保存包团跟进信息
	private function saveTeamMessage($aa) {
		if (!array_key_exists('team_id', $aa)) {
			$data['result'] = error(-1, '参数错误，无法获取小包团信息');
			return $this->ajaxReturn($data);
		}
		
		$teamObj = ModelBase::getInstance('team_group');
		$team = $teamObj->getOne(appendLogicExp('id', '=', $aa['team_id']));
		if (empty($team)) {
			$data['result'] = error(-1, '无法获取订单信息');
			return $this->ajaxReturn($data);
		}
		
		$admin = MyHelp::getLoginAccount(true);
		$aa['admin_id'] = $admin['id'];
		$aa['create_time'] = fmtNowDateTime();
		
		
		$teamMsgObj = ModelBase::getInstance('team_message');
		$teamMsgCols = $teamMsgObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$saveData = coll_elements_giveup($teamMsgCols, $aa);
		$data['result'] = $teamMsgObj->create($saveData);
		
		$saveData['admin_id_account'] = $admin['account'];
		$data['message'] = $saveData;
		return $this->ajaxReturn($data);	
	}
	
	public function infoAction() {
		if (IS_POST) {
			$aa = $_POST;			
			if (array_key_exists('op_type', $aa)) {
				$opType = $aa['op_type'];
				if ($opType == 'edit') {
					$this->typeEdit($aa);	
				} else if ($opType === 'save_message') {
					$this->saveTeamMessage($aa);
				} else {
					$data['result'] = error(-1, '未知的操作类型');
					return $this->ajaxReturn($data);
				}
			} else {
				$data['result'] = error(-1, '未知的请求类型');
				return $this->ajaxReturn($data);
			}
		} else {
			$op = I('get.op', false);
			if ($op === 'team_info') {
				$teamId = I('get.id', false);
				if ($teamId === false) {
					$data['result'] = error(-1, '参数错误，无法显示小包团信息');
				} else {
					$data['jumpUrl'] = U('team/info', 'id='.$teamId);
					$data['result'] = error(0, '');
				}
				return $this->ajaxReturn($data);		
			}
			
			$teamId = I('get.id', false);
			if ($teamId === false) {				
				return $this->display('list');
			}
			
			$this->showInfo($teamId);
		}
	}
	
	private function showScheduling($teamId) {
		$this->assign('team_id', $teamId);
	
		$schedulingObj = ModelBase::getInstance('team_scheduling');
		$ds = $schedulingObj->getAll(appendLogicExp('team_group_id', '=', $teamId));
				
		$dayChar = array('一','二','三','四','五','六','七','八','九','十','十一','十二','十三','十四','十五','十六','十七','十八','十九','二十','二十一','二十二','二十三','二十四','二十五','二十六','二十七','二十八','二十九','三十','三十一','三十二','三十三');
		foreach ($ds as $dk=>$dv) {
			$dv['day_num'] = 'D'.(intval($dv['day_id'])+1);
			$dv['day_char'] = '第'.$dayChar[$dv['day_id']].'天';
			$ds[$dk] = $dv;
		}				
		$this->assign('scheduling', $ds);
		
		$teamObj = ModelBase::getInstance('team_group');
		$team = $teamObj->getOne(appendLogicExp('id', '=', $teamId));
		$stateAllow = false;
		if (!empty($team)) {
			$stateObj = ModelBase::getInstance('order_state');
			$state = $stateObj->getOne(appendLogicExp('id', '=', $team['dispose_state_id']));
			if (!empty($state) && $state['type_key'] === 'team_disposing') {
				$stateAllow = true;
			}
		}
		
		$grant_create_enabled = false;
		$grant_update_enabled = false;
		$grant_delete_enabled = false;
		$admin = MyHelp::getLoginAccount(true);
		if ($admin['id'] === $team['dispose_admin_id'] && $stateAllow === true) {
			if (check_grant('create_team_scheduling') === true) {
				$grant_create_enabled = true;
			}
			if (check_grant('update_team_scheduling') === true) {
				$grant_update_enabled = true;
			}
			if (check_grant('delete_team_scheduling') === true) {
				$grant_delete_enabled = true;
			}
		}
		
		$this->assign('grant_create_scheduling', $grant_create_enabled);
		$this->assign('grant_update_scheduling', $grant_update_enabled);
		$this->assign('grant_delete_scheduling', $grant_delete_enabled);
		 	
		$this->menu_active = 'team_group';
		$this->menu_current = 'list';
		$this->content_title = '小包团行程安排';
		$this->content_des = '这里你可以编辑管理小包团的行程安排';
		$this->_setMenuLinkCurrent('包团列表', 'list');
		$this->_initTemplateInfo();
		
		$this->display('scheduling');
	}
	
	// 创建行程
	public function createScheduling($aa) {
		// 判断是否在指定状态下
		$teamObj = ModelBase::getInstance('team_group');
		$team = $teamObj->getOne(appendLogicExp('id', '=', $aa['tid']));
		if (empty($team)) {
			$data['result'] = error(-1, '小包团不存在，创建行程失败');
			return $this->ajaxReturn($data);
		}
		
		$grant_enabled = false;
		$admin = MyHelp::getLoginAccount(true);
		if ($admin['id'] === $team['dispose_admin_id']) {
			if (check_grant('create_team_scheduling') === true) {
				$grant_enabled = true;
			}
		}
		
		if ($grant_enabled === false) {
			$data['result'] = error(-1, '您没有操作权限或者修改小包团未分配给您，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
				
		if (!array_key_exists('tid', $aa)) {
			$data['result'] = error(-1, '小包团编号错误，不能生成行程');
			return $this->ajaxReturn($data);
		}		
		
		$stateObj = ModelBase::getInstance('order_state');
		$state = $stateObj->getOne(appendLogicExp('type_key', '=', 'team_disposing'));
		if (empty($state)) {
			$data['result'] = error(-1, '小包团状态错误，创建行程失败');
			return $this->ajaxReturn($data);
		}
		
		if ($team['dispose_state_id'] !== $state['id']) {
			$data['result'] = error(-1, '当前小包团状态不允许创建行程');
			return $this->ajaxReturn($data);
		}
				
		$schedulingObj = ModelBase::getInstance('team_scheduling');
		$scheduling = $schedulingObj->getAll(appendLogicExp('team_group_id', '=', $aa['tid']));
		
		$day = 0;
		if (!empty($scheduling)) {
			foreach ($scheduling as $sk=>$sv) {
				if (intval($sv['day_id']) >= $day) {
					$day = intval($sv['day_id']) + 1;
				}
			}
		}		
		$data['sche'] = $scheduling;
		$data['day'] = $day;
		
		$colNames = $schedulingObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNames, $aa);
		$ds['team_group_id'] = $aa['tid'];
		$ds['day_id'] = $day;
		$data['day_num'] = 'D'.($day+1);
		$dayChar = array('一','二','三','四','五','六','七','八','九','十','十一','十二','十三','十四','十五','十六','十七','十八','十九','二十','二十一','二十二','二十三','二十四','二十五','二十六','二十七','二十八','二十九','三十','三十一','三十二','三十三');
		$data['day_char'] = '第'.$dayChar[$day].'天';
		
		$data['result'] = $schedulingObj->create($ds, $schedulingId);
		$data['schedulingId'] = $schedulingId;
		$this->ajaxReturn($data);
	}
	
	// 修改行程
	public function modifyScheduling($aa) {
		if (!array_key_exists('id', $aa) || !array_key_exists('data', $aa)) {
			$data['result'] = error(-1, '参数不完成，修改行程失败');
			return $this->ajaxReturn($data);
		}
		
		$conds = appendLogicExp('id', '=', $aa['id']);
		foreach ($aa['data'] as $ak=>$av) {
			$saveData[$av['name']] = $av['value'];
		}
		
		if (empty($saveData)) {
			$data['result'] = error(-1, '没有可供修改的数据');
			return $this->ajaxReturn($data);
		}
		
		$schedulingObj = ModelBase::getInstance('team_scheduling');
		$scheduling = $schedulingObj->getOne(appendLogicExp('id', '=', $aa['id']));
		if (empty($scheduling)) {
			$data['result'] = error(-1, '行程不存在，修改行程失败');
			return $this->ajaxReturn($data);
		}
		
		// 判断是否在指定状态下
		$teamObj = ModelBase::getInstance('team_group');
		$team = $teamObj->getOne(appendLogicExp('id', '=', $scheduling['team_group_id']));
		if (empty($team)) {
			$data['result'] = error(-1, '小包团不存在，修改行程失败');
			return $this->ajaxReturn($data);
		}
		
		$grant_enabled = false;
		$admin = MyHelp::getLoginAccount(true);
		if ($admin['id'] === $team['dispose_admin_id']) {
			if (check_grant('update_team_scheduling') === true) {
				$grant_enabled = true;
			}
		}
		
		if ($grant_enabled === false) {
			$data['result'] = error(-1, '您没有操作权限或者修改小包团未分配给您，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		
		$stateObj = ModelBase::getInstance('order_state');
		$state = $stateObj->getOne(appendLogicExp('type_key', '=', 'team_disposing'));
		if (empty($state)) {
			$data['result'] = error(-1, '小包团状态错误，修改行程失败');
			return $this->ajaxReturn($data);
		}
		
		if ($team['dispose_state_id'] !== $state['id']) {
			$data['result'] = error(-1, '当前小包团状态不允许修改行程');
			return $this->ajaxReturn($data);
		}
		
		$colNames = $schedulingObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNames, $saveData);
		
		$data['result'] = $schedulingObj->modify($ds, $conds);
		return $this->ajaxReturn($data);
	}	
	
	// 删除行程
	public function deleteScheduling($aa) {
		if (!array_key_exists('id', $aa)) {
			$data['result'] = error(-1, '参数不完成，删除行程失败');
			return $this->ajaxReturn($data);
		}
		
		$schedulingObj = ModelBase::getInstance('team_scheduling');
		$scheduling = $schedulingObj->getOne(appendLogicExp('id', '=', $aa['id']));
		if (empty($scheduling)) {
			$data['result'] = error(-1, '行程不存在，删除失败');
			return $this->ajaxReturn($data);
		}
		
		// 判断是否在指定状态下
		$teamObj = ModelBase::getInstance('team_group');
		$team = $teamObj->getOne(appendLogicExp('id', '=', $scheduling['team_group_id']));
		if (empty($team)) {
			$data['result'] = error(-1, '小包团不存在，删除失败');
			return $this->ajaxReturn($data);
		}
		
		$grant_enabled = false;
		$admin = MyHelp::getLoginAccount(true);
		if ($admin['id'] === $team['dispose_admin_id']) {
			if (check_grant('delete_team_scheduling') === true) {
				$grant_enabled = true;
			}
		}
		
		if ($grant_enabled === false) {
			$data['result'] = error(-1, '您没有操作权限或者修改小包团未分配给您，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}		
		
		$stateObj = ModelBase::getInstance('order_state');
		$state = $stateObj->getOne(appendLogicExp('type_key', '=', 'team_disposing'));
		if (empty($state)) {
			$data['result'] = error(-1, '小包团状态错误，删除失败');
			return $this->ajaxReturn($data);
		}
		
		if ($team['dispose_state_id'] !== $state['id']) {
			$data['result'] = error(-1, '当前小包团状态不允许删除');
			return $this->ajaxReturn($data);
		}
		
		$data['jumpUrl'] = '';
		$data['result'] = $schedulingObj->remove(appendLogicExp('id', '=', $aa['id']));
		if ($data['result']['errno'] == 0) {
			$day = $scheduling['day_id'];
			$cond = appendLogicExp('team_group_id', '=', $scheduling['team_group_id'], 'AND');
			$cond = appendLogicExp('day_id', '>', $day, 'AND', $cond);
			$schs =  $schedulingObj->getAll($cond, 0, 0, $total, 'day_id', false);
			if (!empty($schs)) {
				foreach ($schs as $sk=>$sv) {
					$conds = appendLogicExp('id', '=', $sv['id']);
					$save_day = intval($sv['day_id'])-1;
					$schedulingObj->modify(array('day_id'=>$save_day), $conds);	
				}
				$data['jumpUrl'] = U('team/scheduling', 'id='.$scheduling['team_group_id']);
			}
		}
		$this->ajaxReturn($data);
	}
	
	public function schedulingAction() {
		if (IS_POST) {
			$op = I('post.op', false);
			if ($op === false) {
				$data['result'] = error(-1, '不明的操作类型');
				return $this->ajaxReturn($data);
			}
			
			$aa = $_POST;			
			if ($op === 'create') {
				$this->createScheduling($aa);
			} else if ($op === 'modify') {
				$this->modifyScheduling($aa);
			} else if ($op === 'delete') {
				$this->deleteScheduling($aa);
			} else {
				$data['result'] = error(-1, '未知的操作类型');
				return $this->ajaxReturn($data);
			}			
		} else {
			$op = I('get.op', false);						
			if ($op === 'info_url') {
				$teamId = I('get.id', false);
				if ($teamId === false) {
					$data['result'] = error(-1, '参数错误，无法显示小包团信息');
				} else {
					$data['jumpUrl'] = U('team/scheduling', 'id='.$teamId);
					$data['result'] = error(0, '');
				}
				return $this->ajaxReturn($data);		
			}
			
			$teamId = I('get.id', false);
			if ($teamId === false) {				
				return $this->display('list');
			}
			
			$this->showScheduling($teamId);
		}
	}
	
	// 获取处理小包团的计调人员列表
	private function getDisposeAdminList($aa) {
				
		$adminTypeObj = ModelBase::getInstance('admin_type');
		$adminType = $adminTypeObj->getOne(appendLogicExp('type_key', '=', 'operator'));
		if (!empty($adminType)) {
			$adminObj = ModelBase::getInstance('admin');
			$conds = appendLogicExp('type_id', '=', $adminType['id'], 'AND', $conds);
			$conds = appendLogicExp('forbidden', '=', '0', 'AND', $conds);
			$admins = $adminObj->getAll($conds);	
			
			if (!empty($admins)) {
				foreach ($admins as $ak=>$av) {
					$ads[$ak] = array('id'=>$av['id'], 'account'=>$av['account']);
				}
				$data['ds'] = $ads;
				$data['result'] = error(0, '');
			}
		}
		
		if (empty($data['ds'])) {
			$data['ds'] = false;
			$data['result'] = error(-1, '没有可供分配的计调人员');		
		}
		
		return $this->ajaxReturn($data);		
	}
	
	// 分配小包团
	private function assignDisposeAdmin($aa) {		
		$loginAcct = MyHelp::getLoginAccount(true);
		if (check_grant('assgin_team_group') === false) {
			$data['result'] = error(-1, '你没有分配处理小包团信息的权限');
			return $this->ajaxReturn($data);
		}
			
		if (!array_key_exists('id', $aa) || !array_key_exists('admin_id', $aa)) {
			$data['result'] = error(-1, '参数不完整，不能分配处理小包团的管理员');
			return $this->ajaxReturn($data);			
		}
		$teamObj = ModelBase::getInstance('team_group');
		$team = $teamObj->getOne(appendLogicExp('id', '=', $aa['id']));
		if (empty($team)) {
			$data['result'] = error(-1, '根据信息未能获取小包团信息');
		} else {	
			$adminObj = ModelBase::getInstance('admin');
			$admin = $adminObj->getOne(appendLogicExp('id', '=', $aa['admin_id']));
			if (empty($admin)) {
				$data['result'] = error(-1, '分配的管理员非法');
				return $this->ajaxReturn($data);
			}
			$data['admin'] = $admin;
				
			$stateObj = ModelBase::getInstance('order_state');
			$states = $stateObj->getAll();
			foreach ($states as $sk=>$sv) {
				$stateMap[$sv['type_key']] = $sv;
			}
			$stateAssignWait = $stateMap['team_assign_wait'];
			$statedisposeWait = $stateMap['team_dispose_wait'];
 			
			if ($loginAcct['account'] !== 'admin') {
				if (MyHelp::check_admin_grant($loginAcct['id'], 'dispose_team_group') === false) {			
					$data['result'] = error(-1, '您分配的管理员没有处理小包团的权限');
					return $this->ajaxReturn($data);
				}
				
				// 等待分配与等待处理状态下可分配管理员
//				if ($team['dispose_state_id'] !== $stateAssignWait['id'] && $team['dispose_state_id'] !== $statedisposeWait['id']) {
//					$data['result'] = error(-1, '小包团状态并非分配处理管理员的前置状态，不能分配管理员');
//					return $this->ajaxReturn($data);
//				}
				
				if (empty($stateMap['team_disposing'])) {
					$data['result'] = error(-1, '未能找到表达该小包团情形的状态');
					return $this->ajaxReturn($data);
				}
			}
			
			$ds['dispose_state_id'] = $statedisposeWait['id'];
			$ds['dispose_admin_id'] = $admin['id'];			
			$data['result'] = $teamObj->modify($ds, appendLogicExp('id', '=', $aa['id']));
		}
		
		return $this->ajaxReturn($data);	
	}
	
	// 接受处理小包团
	private function acceptDisposeTeam($aa) {	
		$admin = MyHelp::getLoginAccount(true);
		if (check_grant('dispose_team_group') === false) {
			$data['result'] = error(-1, '你没有处理小包团信息的权限');
			return $this->ajaxReturn($data);
		}
			
		if (!array_key_exists('id', $aa)) {
			$data['result'] = error(-1, '参数不完整，不能接受处理小包团信息');
			return $this->ajaxReturn($data);			
		}
		
		$teamObj = ModelBase::getInstance('team_group');
		$team = $teamObj->getOne(appendLogicExp('id', '=', $aa['id']));
		if (empty($team)) {
			$data['result'] = error(-1, '根据信息未能获取小包团信息');
		} else {	
						
			if ($admin['id'] !== $team['dispose_admin_id']) {
				$data['result'] = error(-1, '该小包团没有被分配给你，请确认后再进行操作');
				return $this->ajaxReturn($data);
			}			
			
			$stateObj = ModelBase::getInstance('order_state');
			$states = $stateObj->getAll();
			foreach ($states as $sk=>$sv) {
				$stateMap[$sv['type_key']] = $sv;
			}
			
			$statedisposeWait = $stateMap['team_dispose_wait'];
			if ($team['dispose_state_id'] !== $statedisposeWait['id']) {
				$data['result'] = error(-1, '小包团状态并非接受处理的前置状态，不能接受处理小包团');
				return $this->ajaxReturn($data);
			}
			
			if (!empty($stateMap['team_disposing'])) {
				$stateDisposing = $stateMap['team_disposing'];
				$data['result'] = $teamObj->modify(array('dispose_state_id'=>$stateDisposing['id']), appendLogicExp('id', '=', $aa['id']));
			} else {
				$data['result'] = error(-1, '未能找到表达该小包团情形的状态');
			}
		}
		
		return $this->ajaxReturn($data);		
	}
		
	public function disposeAdminAction() {
		if (IS_POST) {
			$op = I('post.op', false);		
			if ($op === 'list') {
				$this->getDisposeAdminList($_POST);
			} else if ($op === 'assign') {
				$this->assignDisposeAdmin($_POST);
			} else if ($op === 'accept') {
				$this->acceptDisposeTeam($_POST);
			} else {
				$data['result'] = error(-1, '错误的操作参数');
				return $this->ajaxReturn($data);	
			}
			
		} else {
			$data['result'] = error(-1, '未知的请求类型');
			return $this->ajaxReturn($data);	
		}
	}
	
	private function showOrderCreate($teamId) {		
		// 订单来源
		$orderFromObj = ModelBase::getInstance('order_from');
		$orderFrom = $orderFromObj->getAll();
		if (!empty($orderFrom)) {
			$this->assign('orderFrom', $orderFrom);
		}
		
		// 审阅类型
		$reviewTypeObj = ModelBase::getInstance('review_type');
		$reviewTypes = $reviewTypeObj->getAll();
		if (!empty($reviewTypes)) {
			$this->assign('ReviewType', $reviewTypes);
		}
			
		// 费用用途
		$cashUseObj = ModelBase::getInstance('cash_use');
		$cashUses = $cashUseObj->getAll();
		if (!empty($cashUses)) {
			$this->assign('CashUse', $cashUses);
		}
		
		// 费用功能
		$cashFuncObj = ModelBase::getInstance('cash_function');
		$cashFuncs = $cashFuncObj->getAll();
		if (!empty($cashFuncs)) {
			$this->assign('CashFunc', $cashFuncs);
		}
		
		// 获取根菜单
		$menuItemObj = ModelBase::getInstance('menu_item');
		$menuItemRoots = $menuItemObj->getAll(appendLogicExp('parent_id', '=', '0'));
		if (!empty($menuItemRoots)) {
			$this->assign('MenuItem', $menuItemRoots);
		}
		
		// 成员类型
		$memberTypeObj = ModelBase::getInstance('member_type');
		$memberType = $memberTypeObj->getAll();
		if (!empty($memberType)) {	
			for ($m = 0; $m < count($memberType) && $m < 3; $m ++){
				$listMemberType[] = $memberType[$m];
			}
			$this->assign('memberType', $listMemberType);
			$this->assign('roomMemberType', $memberType);
		}
		
		// 证件类型
		$certificateTypeObj = ModelBase::getInstance('certificate_type');
		$certType = $certificateTypeObj->getAll();
		if (!empty($certType)) {
			$this->assign('certType', $certType);
		}
		
		// 订单来源
		$orderFromObj = ModelBase::getInstance('order_from');
		$orderFrom = $orderFromObj->getAll();
		if (!empty($orderFrom)) {
			$this->assign('orderFrom', $orderFrom);
		}
	
		// 订单状态
		$orderStateObj = ModelBase::getInstance('order_state');
		$orderStates = $orderStateObj->getAll();
		if (!empty($orderStates)) {
			$this->assign('OrderState', $orderStates);
		}
		
		$teamObj = ModelBase::getInstance('team_group');
		$team = $teamObj->getOne(appendLogicExp('id', '=', $teamId));
		if (!empty($team)) {
			$this->assign('team', $team);			
		}
		
		$this->menu_active = 'team_group';
		$this->menu_current = 'list';
		$this->content_title = '小包团订单';
		$this->content_des = '这里你可以创建小包团的订单';
		$this->_setMenuLinkCurrent('包团列表', 'list');
		$this->_initTemplateInfo();
		
		$this->display('order');
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
			$zjNums = explode('&nbsp;', $ds['ct_zjcode']);
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
				if (stripos($type_key, 'child') !== false) {
					$childCount --;
				} else if (stripos($type_key, 'woman') !== false) {
					$womanCount --;
				} else  {
					$maleCount --;
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
			$ds['ct_zjcode'] = $zjNumsstr;
			$ds['ct_exits'] = $exitsstr;
			$ds['ct_diaocha'] = $dzsstr;
			
			// 添加已退团的人
			$lineNames = explode('&nbsp;', $line['ct_names']);
			$lineTels = explode('&nbsp;', $line['ct_sjnum']);
			$lineZJs = explode('&nbsp;', $line['ct_zhengjian']);
			$lineZJNums = explode('&nbsp;', $line['ct_zjcode']);
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
	
	private function createTeamOrder($aa) {	
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$colNames = $orderObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNames, $aa);
		
		// 检查创建包团信息是否充足
		$teamObj = ModelBase::getInstance('team_group');
		$team = $teamObj->getOne(appendLogicExp('id', '=', $ds['lineid']));
		if (empty($team)) {
			$data['result'] = error(-1, '1.小包团编号错误，不存在的小包团，不能生成小包团订单');
			return $this->ajaxReturn($data);
		}		
		
		if (empty($team['title'])) {
			$data['result'] = error(-2, '2.小包团的行程标题不能为空，不能生成小包团订单');
			return $this->ajaxReturn($data);
		}		
		
		if ($team['price_adult'] == '' || $team['price_adult'] == '') {
			$data['result'] = error(-3, '3.小包团的成人、小孩单价不能为空，不能生成小包团订单');
			return $this->ajaxReturn($data);
		}
		// 订单加入到用户订单列表
		$userConds = appendLogicExp('name', '=', $ds['names']);
		$userConds = appendLogicExp('phone', '=', $ds['mob'], 'OR', $userConds);
		$user = BackAccountHelp::getAccount('account_user', $userConds);
		if (is_error($user)) {
			// 账户未注册
			if (check_mobile($ds['mob']) === false) {
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
		if (empty($ds['from_id']) || $ds['from_id'] == -1) {
			$ds['from_id'] = 1;
		}
		$ds['order_sn'] = BackOrderHelp::createOrderSN('YD',$ds['from_id']);
		$ds['addtime'] = time();
//		$ds['addip'] = get_real_ip();
		$orderStateId = BackOrderHelp::OrderStateKey2Value('review');
		$ds['zhuangtai'] = $orderStateId;
		$data['result'] = $orderObj->create($ds, $orderId);
		$teamId = $ds['lineid'];
		
		if (error_ok($data['result']) === false) {
			return $this->ajaxReturn($data);	
		}
		
		if (empty($orderId)) {
			$data['result'] = error(-4, '4.未能获取到正确的订单号码生成订单失败');
			$this->ajaxReturn($data);
		}	
		$data['orderId'] = $orderId;
		
		// 目前生成的订单全部为新线路订单，此计算方法只适用于新线路
		$money =BackOrderHelp::getOrderNeedPayMoney($orderId, true);
		
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
		
		
		// 保存留言
		if (!empty($aa['order_message'])) {
			$result = BackOrderHelp::writeMessage($orderId, $aa['order_message']);
			if (is_error($result)) {
				$data['result'] = error(-5, '5'.$result['message']);
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
		
			$refundFuncId = BackReviewHelp::cashFuncKey2Value('refund');
			if (is_error($refundFuncId)) {
				$data['result'] = error(-6, '6'.'获取退款费用功能编号失败');
				return $this->ajaxReturn($data);
			}
			
			$changeState = false;
			foreach($cash_datas as $cdk=>$cdv) {				
				if (floatval($cdv['cash']) > 0) {					
					$ds['cash_use_id'] = $cdv['cash_use_id'];
					$ds['cash'] = $cdv['cash'];
					
					$extraCashId = 0;
					$cash_use_key = BackReviewHelp::cashUseKey2Value($ds['cash_use_id']);
					// 团费不创建额外费用
					if (is_error($cash_use_key) === false && $cash_use_key !== 'team') {
						// 创建额外费用
						$result = BackExtraCashHelp::appendExtraCash($orderId, $cdv['cash_use_id'], $cdv['cash'], 0, 0, 0, '创建订单与订单审核时添加');
						if (is_error($result)) {
							$data['result'] = error(-7, '7.'.$data['result']['message'].'||创建额外费用失败'.$result['message']);
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
					
					$reviewId = BackReviewHelp::commitOrderReview($ds, $cdv['cash'], $ds['cash_func_id'], $ds['cash_use_id'], $ds, $ds['request_reason'], $extraCashId);	
					if (is_error($reviewId) && error_ok($reviewId) === false) {
						$data['result'] = error(-8, '8.'.$data['result']['message'].'||'.$reviewId['message']);
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
					$data['result'] = error(-9, '9.'.$data['result']['message'].'||'.$result['message']);
				}				
			}
		}
		
		// 改变小包团信息状态
		if (error_ok($data['result'])) {
			$stateCreateOrder = BackOrderHelp::OrderStateKey2Value('team_created_order');
			if (is_error($stateCreateOrder)) {
				$data['result'] = error(-10, '10.'.$data['result']['message'].'||'.$stateCreateOrder['message']);
			} else {
				$teamObj = ModelBase::getInstance('team_group');
				$data['result'] = $teamObj->modify(array('dispose_state_id'=>$stateCreateOrder), appendLogicExp('id', '=', $teamId));
			}
		}
		
		if (error_ok($data['result'])) {
			$data['result'] = error(0, '生成订单成功');
		} else {
			// 还原生成的订单
			if (!empty($orderId)) {
				$result = $orderObj->remove(appendLogicExp('id', '=', $orderId));
				if (error_ok($result) === false){
					$data['result'] = error(-11, '11.'.$data['result']['message'].'||生成订单失败时回滚留言记录失败'.$result['message']);
				}	
			}
			
			// 还原留言记录
			if (!empty($msgId)) {
				$orderMsgObj = ModelBase::getInstance('order_message');	
				$result = $orderMsgObj->remove(appendLogicExp('id', '=', $msgId));
				if (error_ok($result) === false){
					$data['result'] = error(-12, '12.'.$data['result']['message'].'||生成订单失败时回滚留言记录失败'.$result['message']);
				}	
			}
			
			// 还原添加的审核记录
			if (!empty($delReviewCds)) {
				$result = $orderReviewObj->remove($delReviewCds);
				if (error_ok($result) === false){
					$data['result'] = error(-13, '13.'.$data['result']['message'].'||生成订单失败时回滚审核记录失败'.$result['message']);
				}	
			}
			// 还原生成的额外费用
			if (!empty($delExtraCds)) {
				$result = $extraCashObj->remove($delExtraCds);
				if (error_ok($result) === false){
					$data['result'] = error(-14, '14.'.$data['result']['message'].'||生成订单失败时回滚产生的额外费用失败'.$result['message']);
				}	
			}
		}		
		return $this->ajaxReturn($data);
	}
	
	// 小包团完善跳转生成包团订单
	private function teamJumpOrder() {
		$teamId = I('post.id', false);
		if (empty($teamId)) {
			$data['result'] = error(-1, '错误的订单编号，无法跳转生成订单');
			return $this->ajaxReturn($data);
		}
		
		$teamObj = ModelBase::getInstance('team_group');
		$team = $teamObj->getOne(appendLogicExp('id', '=', $teamId));
		if (empty($team)) {
			$data['result'] = error(-1, '未能找到包团信息，无法跳转生成订单');
			return $this->ajaxReturn($data);
		}
		
		if (empty($team['title']) || empty($team['meet_time'])) {
			$data['result'] = error(-1, '包团行程标题、集合时间不能为空');
			return $this->ajaxReturn($data);
		}
		
		$data['jumpUrl'] = U('team/order', array('id'=>$teamId));
		return $this->ajaxReturn($data);
	}
	
	// 处理小包团订单
	public function orderAction() {
		if (IS_POST) {
			$op = I('post.op', false);
			if ($op === 'jump_order') {
				$this->teamJumpOrder();
			} else if ($op == 'create') {
				$this->createTeamOrder($_POST);
			} else {
				$data['result'] = error(-1, '错误的操作参数');
				return $this->ajaxReturn($data);	
			}			
		} else {
			$teamId = I('get.id', false);
			if (empty($teamId)) {
				$this->showError('404', '生成小包团订单错误', '错误的包团参数', '包团参数错误');
			} else {
				$this->showOrderCreate($teamId);
			} 			
		}
	}
	
	
	public function getWaitDisposeAction() {		
		$teamObj = ModelBase::getInstance('team_group');		
		// 可分配小包团数量
		$data['assign_count'] = 0;
		if (check_grant('assgin_team_group') === true) {
			$assignStateId = MyHelp::IdEachTypeKey('order_state', 'team_assign_wait');
			$data['assign_count'] = $teamObj->getCount(appendLogicExp('dispose_state_id', '=', $assignStateId));
		}
		
		// 可处理小包团数量
		$admin = MyHelp::getLoginAccount(true);
		$disposeStateId = MyHelp::IdEachTypeKey('order_state', 'team_dispose_wait');
		$conds = appendLogicExp('dispose_state_id', '=', $disposeStateId, 'AND');
		$conds = appendLogicExp('dispose_admin_id', '=', $admin['id'], 'AND', $conds);
		$data['dispose_count'] = $teamObj->getCount($conds);
		
		$this->ajaxReturn($data);
	}
}

?>