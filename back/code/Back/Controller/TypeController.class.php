<?php

namespace Back\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;

class TypeController extends BackBaseController {
	protected $type_page_title = array(
		'account_type'				=> '账户类型',
		'admin_type'				=> '管理员类型',
		'admin_grant_group'			=> '管理员权限组',
		'admin_grant_type'			=> '管理员权限类型',
		'order_from'				=> '订单来源',
		'state_type'				=> '订单状态',
		'order_state'				=> '订单状态',
		'order_member_type'			=> '参团人类型',
		'order_certificate_type'	=> '证件类型',
		'order_coupon_type'			=> '优惠券类型',
		'review_type'				=> '审核类型',
		'review_cash_use'			=> '费用用途',
		'review_cash_function'		=> '费用功能',
		'review_pay_type'			=> '付款类型',
		'review_pay_channel'		=> '付款渠道',
		'review_pay_bank'			=> '付款银行',
		'menu_type'					=> '菜单类型',
		'request_data'				=> '需求数据',
		'data_type'					=> '数据类型',
		'view_location'				=> '景点地名',
		'alert_task_date_type'		=> '日期类型',
		'alert_task_project'		=> '项目类型',
		'settle_log_type'			=> '日志类型',
		'image_type'				=> '图片类型',
		'image_from'				=> '图片来源',
		'image_content'				=> '图片内容',
		);
		
	protected $type_menu_active = array(
		'account_type'				=> 'admin',
		'admin_type'				=> 'admin',
		'admin_grant_group'			=> 'admin',
		'admin_grant_type'			=> 'admin',
		'order_from'				=> 'order',
		'state_type'				=> 'order',
		'order_state'				=> 'order',
		'order_member_type'			=> 'order',
		'order_certificate_type'	=> 'order',
		'order_coupon_type'			=> 'order',
		'review_type'				=> 'review',
		'review_cash_use'			=> 'review',
		'review_cash_function'		=> 'review',
		'review_pay_type'			=> 'review',
		'review_pay_channel'		=> 'review',
		'review_pay_bank'			=> 'review',
		'menu_type'					=> 'menu',
		'request_data'				=> 'menu',
		'data_type'					=> 'menu',
		'view_location'				=> 'team_group',
		'alert_task_date_type'		=> 'alert_task',
		'alert_task_project'		=> 'alert_task',
		'settle_log_type'			=> 'settle',
		'image_type'				=> 'pictrue_library',
		'image_from'				=> 'pictrue_library',
		'image_content'				=> 'pictrue_library',
		);
		
	protected $type_menu_current = array(
		'account_type'				=> 'account_type',
		'admin_type'				=> 'admin_type',
		'admin_grant_group'			=> 'admin_grant_group',
		'admin_grant_type'			=> 'admin_grant_type',	
		'order_from'				=> 'order_from',
		'state_type'				=> 'state_type',
		'order_state'				=> 'order_state',
		'order_member_type'			=> 'order_member_type',
		'order_certificate_type'	=> 'order_certificate_type',
		'order_coupon_type'			=> 'coupon_type',
		'review_type'				=> 'review_type',
		'review_cash_use'			=> 'review_cash_use',
		'review_cash_function'		=> 'review_cash_function',	
		'review_pay_type'			=> 'review_pay_type',
		'review_pay_channel'		=> 'review_pay_channel',
		'review_pay_bank'			=> 'review_pay_bank',
		'menu_type'					=> 'menu_type',
		'request_data'				=> 'request_data',
		'data_type'					=> 'data_type',
		'view_location'				=> 'view_location',
		'alert_task_date_type'		=> 'alert_task_date_type',
		'alert_task_project'		=> 'alert_task_project',
		'settle_log_type'			=> 'settle_log_type',
		'image_type'				=> 'image_type',
		'image_from'				=> 'image_from',
		'image_content'				=> 'image_content',
		);
		
	protected $type_content_title = array(
		'account_type'				=> '账户类型列表',
		'admin_type'				=> '管理员类型列表',
		'admin_grant_group'			=> '管理员权限组列表',
		'admin_grant_type'			=> '管理员权限类型列表',
		'order_from'				=> '订单来源列表',
		'state_type'				=> '状态类型列表',
		'order_state'				=> '订单状态列表',
		'order_member_type'			=> '参团人类型列表',
		'order_certificate_type'	=> '证件类型列表',
		'order_coupon_type'			=> '优惠券类型列表',
		'review_type'				=> '审核后类型列表',
		'review_cash_use'			=> '费用类型列表',
		'review_cash_function'		=> '费用功能列表',
		'menu_type'					=> '菜单类型列表',
		'request_data'				=> '需求数据',
		'data_type'					=> '数据类型',
		'view_location'				=> '景点地名',
		'alert_task_date_type'		=> '任务提醒基准日期类型',
		'alert_task_project'		=> '提醒任务所属项目',
		'settle_log_type'			=> '日志类型列表',		
		'image_type'				=> '图片类型列表',
		'image_from'				=> '图片来源列表',
		'image_content'				=> '图片内容列表',
		);
		
	protected $type_content_des = array(
		'account_type'				=> '这里你可以创建、编辑管理所有账户的类型',
		'admin_type'				=> '这里你可以创建、编辑管理其他管理员类型',
		'admin_grant_group'			=> '这里你可以创建、编辑管理其他员权限组',
		'admin_grant_type'			=> '这里你可以创建、编辑管理其他管理员权限类型',
		'order_from'				=> '这里你可以创建、编辑管理订单来源类型',
		'state_type'				=> '这里你可以创建、编辑管理状态类型',
		'order_state'				=> '这里你可以创建、编辑管理订单状态',
		'order_member_type'			=> '这里你可以创建、编辑管理参团人类型',
		'order_certificate_type'	=> '这里你可以创建、编辑管理证件类型',
		'order_coupon_type'			=> '这里你可以创建、编辑管理优惠券类型',
		'review_type'				=> '这里你可以创建、编辑管理审核类型',
		'review_cash_use'			=> '这里你可以创建、编辑管理费用用途类型',
		'review_cash_function'		=> '这里你可以创建、编辑管理费用功能类型',
		'menu_type'					=> '这里你可以创建、编辑管理菜单类型',
		'request_data'				=> '这里你可以创建、编辑管理请求数据',
		'data_type'					=> '这里你可以创建、编辑管理数据类型',
		'view_location'				=> '这里你可以创建、编辑管理景点地名',
		'alert_task_date_type'		=> '这里你可以创建、编辑管理你的提醒任务基准日期类型',
		'alert_task_project'		=> '这里你可以创建、编辑管理你的提醒任务所属项目',
		'settle_log_type'			=> '这里你可以创建、编辑管理日志类型',
		'image_type'				=> '这里你可以创建、编辑管理你的图片类型',
		'image_from'				=> '这里你可以创建、编辑管理你的图片来源',
		'image_content'				=> '这里你可以创建、编辑管理你的图片内容',
		);
		
	protected $type_table_name = array(
		'account_type'				=> 'account_type',
		'admin_type'				=> 'admin_type',
		'admin_grant_group'			=> 'grant_group',
		'admin_grant_type'			=> 'grant_type',	
		'order_from'				=> 'order_from',
		'state_type'				=> 'state_type',
		'order_state'				=> 'order_state',
		'order_member_type'			=> 'member_type',
		'order_certificate_type'	=> 'certificate_type',
		'order_coupon_type'			=> 'coupon_type',
		'review_type'				=> 'review_type',
		'review_cash_use'			=> 'cash_use',
		'review_cash_function'		=> 'cash_function',	
		'menu_type'					=> 'menu_type',
		'request_data'				=> 'type_data',
		'data_type'					=> 'data_type',
		'view_location'				=> 'view_location',
		'alert_task_date_type'		=> 'alert_task_date_type',
		'alert_task_project'		=> 'alert_task_project',
		'settle_log_type'			=> 'op_type',
		'image_type'				=> 'image_type',
		'image_from'				=> 'image_from_type',
		'image_content'				=> 'image_content_type',
		);
		
	protected $grant_key = array(
		'admin_type'				=> array('list'=>'list_admin_type', 'create'=>'create_admin_type', 'update'=>'update_admin_type', 'delete'=>'delete_admin_type'),
		'admin_grant_group'			=> array('list'=>'list_grant_group', 'create'=>'create_grant_group', 'update'=>'update_grant_group', 'delete'=>'delete_grant_group'),
		'admin_grant_type'			=> array('list'=>'list_grant_type', 'create'=>'create_grant_type', 'update'=>'update_grant_type', 'delete'=>'delete_grant_type'),
		'order_from'				=> array('list'=>'list_order_from', 'create'=>'create_order_from', 'update'=>'update_order_from', 'delete'=>'delete_order_from'),
		'state_type'				=> array('list'=>'list_state_type', 'create'=>'create_state_type', 'update'=>'update_state_type', 'delete'=>'delete_state_type'),
		'order_state'				=> array('list'=>'list_order_state', 'create'=>'create_order_state', 'update'=>'update_order_state', 'delete'=>'delete_order_state'),
		'order_member_type'			=> array('list'=>'list_member_type', 'create'=>'create_member_type', 'update'=>'update_member_type', 'delete'=>'delete_member_type'),
		'order_certificate_type'	=> array('list'=>'list_certificate_type', 'create'=>'create_certificate_type', 'update'=>'update_certificate_type', 'delete'=>'delete_certificate_type'),
		'order_coupon_type'			=> array('list'=>'list_coupon_type', 'create'=>'create_coupon_type', 'update'=>'update_coupon_type', 'delete'=>'delete_coupon_type'),
		'review_type'				=> array('list'=>'list_review_type', 'create'=>'create_review_type', 'update'=>'update_review_type', 'delete'=>'delete_review_type'),
		'review_cash_use'			=> array('list'=>'list_cash_use', 'create'=>'create_cash_use', 'update'=>'update_cash_use', 'delete'=>'delete_cash_use'),
		'review_cash_function'		=> array('list'=>'list_cash_function', 'create'=>'create_cash_function', 'update'=>'update_cash_function', 'delete'=>'delete_cash_function'),
		'menu_type'					=> array('list'=>'list_menu_type', 'create'=>'create_menu_type', 'update'=>'update_menu_type', 'delete'=>'delete_menu_type'),
		'data_type'					=> array('list'=>'list_data_type', 'create'=>'create_data_type', 'update'=>'update_data_type', 'delete'=>'delete_data_type'),
		'alert_task_date_type'		=> array('list'=>'list_alert_task_date_type', 'create'=>'create_alert_task_date_type', 'update'=>'update_alert_task_date_type', 'delete'=>'delete_alert_task_date_type'),
		'alert_task_project'		=> array('list'=>'list_alert_task_project', 'create'=>'create_alert_task_project', 'update'=>'update_alert_task_project', 'delete'=>'delete_alert_task_project'),
		'settle_log_type'			=> array('list'=>'list_log_type', 'create'=>'create_log_type', 'update'=>'update_log_type', 'delete'=>'delete_log_type'),
	);
		
	protected function _initialize() {	
		$this->content_title_show = 1;	
		$this->setCurrentType('order_state');
	}	
	
	public function _empty() {
		$this->setCurrentType('order_state');
		$this->display('list');
	}
	
	// 设置当前处理的类型
	protected function setCurrentType($typeObj) {
		$this->page_title = $this->type_page_title[$typeObj];
		$this->menu_active = $this->type_menu_active[$typeObj];
		$this->menu_current = $this->type_menu_current[$typeObj];
		$this->content_title = $this->type_content_title[$typeObj];
		$this->content_des = $this->type_content_des[$typeObj];
		$this->_setMenuLinkCurrent($typeObj, $this->type_menu_current[$typeObj]);
		$this->_initTemplateInfo();
	}
	
	private function getAdminType() {
		$conds = array();
		$objType = ModelBase::getInstance('admin_type');
		$admin = MyHelp::getLoginAccount(true);
		if ($admin['account'] !== 'admin') {
			$conds = appendLogicExp('id', '=', $admin['type_id'], 'OR');				
			$thisType = $objType->getOne(appendLogicExp('id', '=', $admin['type_id']));
			if (!empty($thisType) && $thisType['type_key'] === 'administrator') {
				$types = $objType->getAll();
				if (!empty($types)) {
					foreach($types as $tk=>$tv) {
						if ($tv['id'] !== $admin['type_id'] && $tv['type_key'] !== 'super_admin'){
							$conds = appendLogicExp('id', '=', $tv['id'], 'OR', $conds);
						}
					}
				}
			}
		}
		
		return $objType->getAll($conds);		
	}
	
	// 填充数据
	private function fillData($ds, $tab, $keyCol, $showCols, $prefix) {
		$dataObj = ModelBase::getInstance($tab, $prefix);
		$datas = $dataObj->getAll();
		if (!empty($datas)) {
			foreach ($datas as $dk=>$dv) {
				$dataMap[$dv['id']] = $dv;
			}
			
			foreach ($ds as $dsk=>$dsv) {
				$data = $dataMap[$dsv[$keyCol]];
				foreach ($showCols as $ck=>$cv) {
					$dsv[$keyCol.'_'.$cv] = $data[$cv];
				}
				$ds[$dsk] = $dsv;
			}
		}
		return $ds;
	}
	
	// 类型列表	
	protected function typeList($typeObj, $aa) {
		if (array_key_exists($typeObj, $this->grant_key)) {
			if (check_grant($this->grant_key[$typeObj]['list']) === false) {
				$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
				return $this->ajaxReturn($data);
			}
		}
			
		$tableName = $this->type_table_name[$typeObj];
		$objType = ModelBase::getInstance($tableName);
		
		$totalCount = 0;
		$colNames = $objType->getUserDefine(ModelBase::DF_COL_NAMES);
		$sortCol = $colNames[intval($aa['iSortCol_0'])-1];		
		if (!empty($sortCol)) {
			$sort[$sortCol] = $aa['sSortDir_0'];
		}
		
		if ($typeObj == 'request_data') {
			$sort['data_type_id'] = 'asc';
			$sort['sort'] = 'asc';	
		}
		
		
		$conds = array();
		if (array_key_exists('cds', $aa)) {
			$cds = coll_elements_giveup($colNames, $aa['cds']);
			$conds = MyHelp::getLogicExp($cds, '=', 'OR');
		}
		
		$admin = MyHelp::getLoginAccount(true);
		if ($admin['account'] !== 'admin') {
			if ($typeObj == 'admin_type') {		// 确保
				$conds = appendLogicExp('id', '=', $admin['type_id'], 'OR', $conds);				
				$thisType = $objType->getOne(appendLogicExp('id', '=', $admin['type_id']));
				if (!empty($thisType) && $thisType['type_key'] === 'administrator') {
					$types = $objType->getAll();
					if (!empty($types)) {
						foreach($types as $tk=>$tv) {
							if ($tv['id'] !== $admin['type_id'] && $tv['type_key'] !== 'super_admin'){
								$conds = appendLogicExp('id', '=', $tv['id'], 'OR', $conds);
							}
						}
					}
				}
			} else if ($typeObj == 'admin_grant_group') {		// 确保每个管理员只能看见自己可使用的权限组，超级管理员除外
				$groupAdminTypeBindObj = ModelBase::getInstance('group_admin_type_bind');
				$groupAdminTypes = $groupAdminTypeBindObj->getAll(appendLogicExp('admin_type_id', '=', $admin['type_id']));
				foreach ($groupAdminTypes as $gatk=>$gatv) {
					$conds = appendLogicExp('id', '=', $gatv['group_id'], 'OR', $conds);	
				}
			}
		}
		
		if (!empty($aa['sSearch'])) {
			$searchConds = appendLogicExp('id', '=', $aa['sSearch'], 'OR', $searchConds);
			$searchConds = appendLogicExp('type_key', 'LIKE', '%'.$aa['sSearch'].'%', 'OR', $searchConds);
			$searchConds = appendLogicExp('type_desc', 'LIKE', '%'.$aa['sSearch'].'%', 'OR', $searchConds);
			if ($tableName == 'type_data') {
				$dataTypeObj = ModelBase::getInstance('data_type');
				$dataTypeConds = appendLogicExp('id', '=', $aa['sSearch'], 'OR', $dataTypeConds);
				$dataTypeConds = appendLogicExp('type_key', '=', '%'.$aa['sSearch'].'%', 'OR', $dataTypeConds);
				$dataTypeConds = appendLogicExp('type_desc', '=', '%'.$aa['sSearch'].'%', 'OR', $dataTypeConds);
				$dataType = $dataTypeObj->getOne($dataTypeConds);
				if (!empty($dataType)) {
					$searchConds = appendLogicExp('data_type_id', '=', $dataType, 'OR', $searchConds);	
				}
			}
			if (empty($conds)) {
				$conds = $searchConds;
			} else {
				$conds = appendLogicExp('searche', '=', $searchConds, 'AND', $conds);
			}
		}
		
		$data['conds'] = $conds;
		$ds = $objType->getAll($conds, $aa['iDisplayStart'], $aa['iDisplayLength'], $totalCount, $sort);
		if (empty($ds)) {
			$ds = array();
		} else {
			// 权限组可以被那些管理员类型使用
			if ($typeObj == 'admin_grant_group') {
				$groupAdminTypeBindObj = ModelBase::getInstance('group_admin_type_bind');
				$adminTypes = $this->getAdminType();
				if (!empty($adminTypes)) {
					foreach ($ds as $dk=>$dv) {
						$binds = array();
						foreach ($adminTypes as $atk=>$atv) {
							$bind['group_id'] = $dv['id'];
							$bind['type_id'] = $atv['id'];
							$bind['checked'] = '';
							$groupCDS = appendLogicExp('group_id', '=', $dv['id'], 'AND');
							$groupCDS = appendLogicExp('admin_type_id', '=', $atv['id'], 'AND', $groupCDS);
							$groupBind = $groupAdminTypeBindObj->getOne($groupCDS);
							if (!empty($groupBind)) {
								$bind['checked'] ='checked';
							}
							$binds[count($binds)] = $bind;
						}
						$dv['binds'] = $binds;
						$ds[$dk] = $dv;
					}	
				}
			} else if ($typeObj == 'request_data') {
				$ds = $this->fillData($ds, 'data_type', 'data_type_id', array('type_desc'));
			} else if ($typeObj == 'order_state') {
				$ds = $this->fillData($ds, 'state_type', 'state_type_id', array('type_desc'));
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
		$this->ajaxReturn($data);		
	}
	
	// 创建类型
	protected function typeCreate($typeObj, $aa) {	
		if (array_key_exists($typeObj, $this->grant_key)) {
			if (check_grant($this->grant_key[$typeObj]['create']) === false) {
				$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
				return $this->ajaxReturn($data);
			}
		}
		
		$tableName = $this->type_table_name[$typeObj];
		$objType = ModelBase::getInstance($tableName);
		if (empty($aa['data'])) {
			$data['result'] = error(-1, '创建的数据不正确');
		} else {
			$newData = $aa['data'];			
			$newData['can_delete'] = 1;
			$admin = MyHelp::getLoginAccount(true);
			if ($admin['account'] === 'admin') {
				$newData['can_delete'] = 0;
			}
			if ($tableName == 'type_data') {
				$dataTypeKey = MyHelp::DataTypeKey2Value($newData['data_type_id']);
				if (is_error($dataTypeKey) === false) {
					$newData['type_key'] = $dataTypeKey.'_'.$newData['type_key'];	
				}
			}
			$newData['admin_id'] = $admin['id'];
			$data['result'] = $objType->create($newData);	
		}
		$this->ajaxReturn($data);
	}
	
	// 查找类型
	protected function typeFind($typeObj, $aa) {
		$tableName = $this->type_table_name[$typeObj];
		$objType = ModelBase::getInstance($tableName);
		
		$colNames = $objType->getUserDefine(ModelBase::DF_COL_NAMES);		
		$cds = coll_elements_giveup($colNames, $aa);
		$cds = MyHelp::getLogicExp($cds, '=', 'AND');
		
		$ds = $objType->getOne($cds);
		if (empty($ds)) {
			$data['result'] = error(-1,'未能查找到该条记录');
		} else {
			$data['data'] = $ds;
			$data['result'] = error(0,'');			
		}
		$this->ajaxReturn($data);
	}
	
	// 查找类型
	protected function typeFindAll($typeObj, $aa) {
		if (!array_key_exists('cds', $aa)) {
			$data['result'] = error(-1, '错误的查找方式，不存在的查找条件');
			return $this->ajaxReturn($data);
		}
		$tableName = $this->type_table_name[$typeObj];
		$objType = ModelBase::getInstance($tableName);
		
		$colNames = $objType->getUserDefine(ModelBase::DF_COL_NAMES);		
		$cds = coll_elements_giveup($colNames, $aa['cds']);
		$cds = MyHelp::getLogicExp($cds, '=', 'AND');
		
		$ds = $objType->getAll($cds);
		if (empty($ds)) {
			$data['result'] = error(-1,'未能查找到该条记录');
		} else {
			if ($typeObj == 'request_data') {
				$dataTypeObj = ModelBase::getInstance('data_type');
				$dataTypes = $dataTypeObj->getAll();
				foreach ($dataTypes as $dtk=>$dtv) {
					$dataTypeMap[$dtv['id']] = $dtv;
				}
				foreach ($ds as $dk=>$dv) {
					$dv['data_type_id_type_desc'] = $dataTypeMap[$dv['data_type_id']]; 
					$ds[$dk] = $dv;
				}
			}
			$data['data'] = $ds;
			$data['result'] = error(0,'获取数据成功');			
		}
		$this->ajaxReturn($data);
	}
	
	// 编辑类型
	protected function typeEdit($typeObj, $aa) {
		if (array_key_exists($typeObj, $this->grant_key)) {
			if (check_grant($this->grant_key[$typeObj]['update']) === false) {
				$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
				return $this->ajaxReturn($data);
			}
		}
		
		$tableName = $this->type_table_name[$typeObj];
		$objType = ModelBase::getInstance($tableName);
		
		$colNames = $objType->getUserDefine(ModelBase::DF_COL_NAMES);		
		$cds = coll_elements_giveup($colNames, $aa['cd']);
		$cds = MyHelp::getLogicExp($cds, '=', 'AND');
		$vals = coll_elements_giveup($colNames, $aa['data']);
						
		$data['result'] = $objType->modify($vals, $cds);
		$this->ajaxReturn($data);
	}
	
	// 删除类型
	protected function typeDelete($typeObj, $aa) {
		if (array_key_exists($typeObj, $this->grant_key)) {
			if (check_grant($this->grant_key[$typeObj]['delete']) === false) {
				$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
				return $this->ajaxReturn($data);
			}
		}
		
		$tableName = $this->type_table_name[$typeObj];
		$objType = ModelBase::getInstance($tableName);
		
		$colNames = $objType->getUserDefine(ModelBase::DF_COL_NAMES);		
		$cds = coll_elements_giveup($colNames,$aa);
		$cds = MyHelp::getLogicExp($cds, '=', 'AND');
		
		$ds = $objType->getOne($cds);
		if (empty($ds)) {
			$data['result'] = error(-1, '要删除的对象不存在');
		} else if ($ds['can_delete'] == 0){		
			$admin = MyHelp::getLoginAccount(true);
			if ($admin['account'] !== 'admin') {
				$data['result'] = error(-1, '您没有权限进行此操作');
			} else {				
				$data['result'] = $objType->remove($cds);
			}
		} else {
			$data['result'] = $objType->remove($cds);
		}		
		$this->ajaxReturn($data);
	}
	
	// 多个删除
	protected function typeDeleteMulti($typeObj, $aa) {
		if (array_key_exists($typeObj, $this->grant_key)) {
			if (check_grant($this->grant_key[$typeObj]['delete']) === false) {
				$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
				return $this->ajaxReturn($data);
			}
		}
		
		$tableName = $this->type_table_name[$typeObj];
		$objType = ModelBase::getInstance($tableName);
		
		$colNames = $objType->getUserDefine(ModelBase::DF_COL_NAMES);		
		$tempCDS = coll_elements_giveup($colNames, $aa);
		// 合成删除条件
		$cds = array();
		foreach ($tempCDS as $k=>$cd){
			if (is_array($cd)) {
				$cdstr = '(';
				foreach ($cd as $ck=>$cv) {
					$cds = appendLogicExp($k, '=', $cv, 'OR', $cds);
				}
			} else {
				appendLogicExp($k, '=', $cd, 'OR', $cds);
			}
		}		
		
		$ds = $objType->getAll($cds);
		if (empty($ds)) {
			$data['result'] = error(-1, '要删除的对象不存在');
		} else{ 
			$admin = MyHelp::getLoginAccount(true);
			foreach ($ds as $k=>$v) {
				if ($v['can_delete'] == 0){		
					if ($admin['account'] !== 'admin') {
						$data['result'] = error(-1, '您没有权限进行此操作');
						return $this->ajaxReturn($data);
					}
				}	
			}
			$data['result'] = $objType->remove($cds);
		}	
		return $this->ajaxReturn($data);							
	}
		
	// 测试
	public function testAction() {		
//		$objType = UtilModel::createTypeBaseChild($this->type_table_name['cooperation']);
		$aa['sEcho'] = '1';	
		$aa['iDisplayStart'] = 0;
		$aa['iDisplayLength'] = 5;
		$aa['bSearchable_0'] = false;
		$aa['bSearchable_1'] = false;
		$aa['bSearchable_2'] = false;
		$aa['iSortCol_0'] = 1;
		$aa['sSortDir_0'] = 'asc';		
		$this->typeList('cooperation', $aa);	
	}
		
	// 处理类型动作
	public function listAction() {
		if (IS_POST) {	
			$aa = $_POST;		
			if (empty($aa['type_obj'])) {
				$data['result'] = error(-1, '获取类型对象失败');
				$this->ajaxReturn($data);
			} else {
				$typeObj = $aa['type_obj'];
				if (isset($aa['op_type'])) {
					$opType = $aa['op_type'];				
					if ($opType == 'create') {
						$this->typeCreate($typeObj, $aa);
					} else if ($opType == 'find') {
						$this->typeFind($typeObj, $aa);
					} else if ($opType == 'find_all') {
						$this->typeFindAll($typeObj, $aa);
					} else if ($opType == 'edit') {
						$this->typeEdit($typeObj, $aa);
					} else if ($opType == 'delete') {
						$this->typeDelete($typeObj, $aa);
					} else if ($opType == 'delete_multi') {
						$this->typeDeleteMulti($typeObj, $aa);
					} else if ($opType == 'list') {
						$this->typeList($typeObj, $aa);
					} else {
						$data['result'] = error(-1, '未知的类型动作请求');
						$this->ajaxReturn($data);
					}
				} else {
					$data['result'] = error(-1, '获取类型动作失败');
					$this->ajaxReturn($data);
				}
			}
			
		} else {	
			if (empty($_GET['obj'])) {
				echo('类型处理出错');
				// 导向错误页面
			} else {
				$typeObj = $_GET['obj'];
				
				$this->assign('grant_create', check_grant($this->grant_key[$typeObj]['create']));
				$this->assign('grant_update', check_grant($this->grant_key[$typeObj]['update']));
				$this->assign('grant_delete', check_grant($this->grant_key[$typeObj]['delete']));
				
				
				if ($typeObj == 'admin_grant_group') {
					$this->assign('group_bind_grant', check_grant('assign_grant'));	
					$this->assign('group_bind_admin_type', check_grant('bind_group_use_object'));
					$adminTypes = $this->getAdminType();
					if (!empty($adminTypes)) {
						$this->assign('adminType', $adminTypes);	
					}
				}
				
				$this->setCurrentType($_GET['obj']);				
				$this->assign('typeObj', $_GET['obj']);
				$this->assign('modal_data_edit', true);
				$this->assign('ajaxReqUrl', U('type/list'));
				$this->display('list');
			}	
		}
	}
}

?>