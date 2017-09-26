<?php

namespace Back\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;

class GrantController extends BackBaseController {	

	protected function _initialize() {		
		$this->page_title = '管理员权限';
		$this->content_title_show = 1;
		$this->menu_active = 'admin';
	}
	
	public function _empty() {
		$this->content_title = '管理员权限列表';
		$this->content_des = '这里你可以查看并管理权限信息';
		$this->_setMenuLinkCurrent('管理员权限列表','grantlist');
		$this->_initTemplateInfo();
		$this->display('grantlist');
	}
	
	// 类型列表	
	protected function typeList($aa) {
		$totalCount = 0;		
		$grantObj = ModelBase::getInstance('grant');
		$colNames = $grantObj->getUserDefine(ModelBase::DF_COL_NAMES);	
		$sortCols = MyHelp::getDataTableSortCol($aa);
		$sortCols = coll_elements_giveup($colNames,$sortCols);
		$sortDesc = strcasecmp($aa['sSortDir_0'],'desc')==0 ? true : false;
						
		$cds = array();
		$admin = MyHelp::getLoginAccount(true);
		if (is_error($admin) === false && $admin['account'] !== 'admin') {
			$conds = appendLogicExp('admin_type_id', '=', $admin['type_id']);
			$bindObj = ModelBase::getInstance('grant_admin_type_bind');
			$binds = $bindObj->getAll($conds);
			foreach($binds as $bk=>$bv) {
				$cds = appendLogicExp('id', '=', $bv['grant_id'], 'OR', $cds);
			}
		}
		if (!empty($aa['sSearch'])) {
			$cds = appendLogicExp('id', '=', $aa['sSearch'], 'OR', $cds);
			$cds = appendLogicExp('grant_key', 'LIKE', '%'.$aa['sSearch'].'%', 'OR', $cds);
			$cds = appendLogicExp('grant_desc', 'LIKE', '%'.$aa['sSearch'].'%', 'OR', $cds);
		}
		$ds = $grantObj->getAll($cds, $aa['iDisplayStart'], $aa['iDisplayLength'], $totalCount, $sortCols[0], $sortDesc);
		if (empty($ds)) {
			$ds = array();
		}
		
		// 填充数据		
		if (!empty($ds)) {
			$adminTypeObj = ModelBase::getInstance('admin_type');
			$adminTypes = $adminTypeObj->getAll();
			$grantAdminTypeObj = ModelBase::getInstance('grant_admin_type_bind');
			
			$typeObj = ModelBase::getInstance('grant_type');
			foreach($ds as $dk=>$dv) {
				// 权限类型
				$cds = appendLogicExp('id', '=', $dv['type_id']);
				$typeData = $typeObj->getOne($cds);
				if (!empty($typeData)) {
					$dv['type_id.type_desc'] = $typeData['type_desc'];
				}				
				// 绑定的使用对象类型
				$grantUseTypes = $adminTypes;
				foreach ($grantUseTypes as $atk=>$atv) {
					$bindCds = appendLogicExp('grant_id', '=', $dv['id'], 'AND');
					$bindCds = appendLogicExp('admin_type_id', '=', $atv['id'], 'AND', $bindCds);
					$bind = $grantAdminTypeObj->getOne($bindCds);
					$atv['checked'] = empty($bind)?'':'checked';
					$grantUseTypes[$atk] = $atv;
				}
				$dv['use_obj'] = $grantUseTypes;
				$ds[$dk] = $dv;
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
	
	// 查找类型
	protected function typeFind($aa) {	
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
	
	// 创建账号
	protected function typeCreate($aa) {
		if (check_grant('create_account') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		if (array_key_exists('grant_key', $aa) === false || array_key_exists('grant_value', $aa) === false) {
			$data['result'] = error(-1, '参数错误，创建失败');
			return $this->ajaxReturn($data);
		}
		
		$grantObj = ModelBase::getInstance('grant');
		$grantCols = $grantObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$saveData = coll_elements_giveup($grantCols, $aa);
				
		$cds = appendLogicExp('grant_key', '=', $saveData['grant_key']);
		$grant = $grantObj->getOne($cds);
		if (empty($grant)) {	
			$saveData['can_delete'] = 0;
			$data['result'] = $grantObj->create($saveData);
			if (error_ok($data['result'])) {
				$grant = $grantObj->getOne($cds);
				$bindData['grant_id'] = $grant['id'];
				
				$bindObj = ModelBase::getInstance('grant_admin_type_bind');
				foreach ($aa['bind'] as $k=>$v) {
					$bindData['admin_type_id'] = $v;
					$data['result'] = $bindObj->create($bindData);	
				}
			}
		} else {
			$data['result'] = error(-1, '该权限键已经存在');
		}
		$data['aa'] = $aa;
		return $this->ajaxReturn($data);
	}
	
	// 修改账号
	protected function typeModify($aa) {
		if (check_grant('update_grant') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		$admin = MyHelp::getLoginAccount(true);
		if ($admin['account'] !== 'admin') {
			$data['result'] = error(-1,'您没有权限进行此项操作');
			return $this->ajaxReturn($data);
		}
				
		$grantObj = ModelBase::getInstance('grant');	
		$colNames = $grantObj->getUserDefine(ModelBase::DF_COL_NAMES);	
		$vals = coll_elements_giveup($colNames, $aa);	
		
		if(empty($vals['id'])){
			$data['result'] = error(-1, '条件非法，更新失败');
			return $this->ajaxReturn($data);
		}
				
		// 键值唯一性检测
		if (array_key_exists('grant_key', $vals)) {
			$cds = appendLogicExp('grant_key', '=', $vals['grant_key']);
			$grant = $grantObj->getOne($cds);
			if (!empty($grant) && $grant['id'] != $vals[id]) {
				$data['result'] = error(-1, '该权限键已经存在');
				return $this->ajaxReturn($data);
			}			
		}
			
		$cds = appendLogicExp('id', '=', $vals['id']);								
		$data['result'] = $grantObj->modify($vals, $cds);
		$this->ajaxReturn($data);
	}
	
	// 删除类型
	protected function typeDelete($aa) {
		if (check_grant('delete_grant') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		$admin = MyHelp::getLoginAccount(true);
		if ($admin['account'] !== 'admin') {
			$data['result'] = error(-1,'您没有权限进行此项操作');
			return $this->ajaxReturn($data);
		}
		
		if (array_key_exists('id', $aa)) {
			$cds = appendLogicExp('id', '=', $aa['id']);		
			$grantObj = ModelBase::getInstance('grant');		
			$data['result'] = $grantObj->remove($cds);
			if (error_ok($data['result'])) {
				$cds = appendLogicExp('grant_id', '=', $aa['id']);
				$bindAdminTypeObj = ModelBase::getInstance('grant_admin_type_bind');
				if ($bindAdminTypeObj->getCount($cds) > 0) {
					$data['result'] = $bindAdminTypeObj->remove($cds);	
				}
				
				if (error_ok($data['result'])){
					$bindGroupObj = ModelBase::getInstance('grant_group_bind');
					if ($bindGroupObj->getCount($cds) > 0) {
						$data['result'] = $bindGroupObj->remove($cds);	
					}
				}
			}
		} else {
			$data['result'] = error(-1, '参数错误，删除数据失败');
		}
		$this->ajaxReturn($data);
	}
	
	// 多个删除
	protected function typeDeleteMulti($aa) {
		if (check_grant('delete_grant') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		$admin = MyHelp::getLoginAccount(true);
		if ($admin['account'] !== 'admin') {
			$data['result'] = error(-1,'您没有权限进行此项操作');
			return $this->ajaxReturn($data);
		}
		
		if (array_key_exists('ids', $aa)) {				
			$cdval = $aa['ids'];
			$cds = array();
			$bindCDS = array();
			if (is_array($cdval)) {
				foreach ($cdval as $ck=>$cv) {
					$cds = appendLogicExp('id', '=', $cv, 'OR', $cds);
					$bindCDS = appendLogicExp('grant_id', '=', $cv, 'OR', $bindCDS);
				}
			}		
			
			$grantObj = ModelBase::getInstance('grant');
			$ds = $grantObj->getAll($cds);
			if (empty($ds)) {
				$data['result'] = error(-1, '要删除的对象不存在,Err:'.$grantObj->getDbError().',SQL:'.$grantObj->getLastSql());
			} else {
				$data['result'] = $grantObj->remove($cds);
				if (error_ok($data['result'])) {
					$bindAdminTypeObj = ModelBase::getInstance('grant_admin_type_bind');
					if ($bindAdminTypeObj->getCount($bindCDS) > 0) {
						$data['result'] = $bindAdminTypeObj->remove($bindCDS);	
					}
					
					if (error_ok($data['result'])){
						$bindGroupObj = ModelBase::getInstance('grant_group_bind');
						if ($bindGroupObj->getCount($bindCDS) > 0) {
							$data['result'] = $bindGroupObj->remove($bindCDS);	
						}
					}
				}	
			}			
		} else {
			$data['result'] = error(-1, '参数错误，查找数据失败');
		}
		$this->ajaxReturn($data);
	}
	
	// 唯一性检测
	public function typeUnique($aa) {
		if (array_key_exists('data', $aa)) {
			$grantObj = ModelBase::getInstance('grant');
			$grantCols = $grantObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$cds = coll_elements_giveup($grantCols, $aa['data']);
			$conds = MyHelp::getLogicExp($cds, '=', 'AND');
			$grant = $grantObj->getOne($conds);
			if (empty($grant)) {
				$data['result'] = error(0, '检测通过');				
			} else {
				$data['grant'] = $grant;
				$data['result'] = error(-1, '数据不唯一');				
			}
		} else {
			$data['result'] = error(-1, '参数错误，检测数据失败');
		}
		$this->ajaxReturn($data);
	}
	
	// 权限绑定权限组
	private function typeBind($aa) {
		if (check_grant('bind_grant_use_object') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}		
		
		if (array_key_exists('grant_id', $aa)===false || array_key_exists('admin_type_id', $aa)===false){
			$data['result'] = error(-1, '参数不完整');
			$this->ajaxReturn($data);
		}
		
		$bindObj = ModelBase::getInstance('grant_admin_type_bind');
		$bindCols = $bindObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$saveData = coll_elements_giveup($bindCols, $aa);
		
		$conds = MyHelp::getLogicExp($saveData, '=', 'AND');
		$bindData = $bindObj->getOne($conds);
		if (empty($bindData)) {
			if ($aa['op_type'] == 'bind') {
				$data['result'] = $bindObj->create($saveData);
			} else {
				$data['result'] = error(-1, '该权限未被绑定');
			}
		} else {	
			if ($aa['op_type'] == 'unbind') {
				$data['result'] = $bindObj->remove($conds);
			} else {
				$data['result'] = error(-1, '该权限已被绑定');
			}
		}
		$this->ajaxReturn($data);
	}
	
	// 权限组绑定使用对象
	private function typeGroupBind($aa) {
		if (check_grant('bind_group_use_object') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}		
		
		if (array_key_exists('group_id', $aa)===false || array_key_exists('admin_type_id', $aa)===false){
			$data['result'] = error(-1, '参数不完整');
			$this->ajaxReturn($data);
		}
		
		$bindObj = ModelBase::getInstance('group_admin_type_bind');
		$bindCols = $bindObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$saveData = coll_elements_giveup($bindCols, $aa);
		
		$conds = MyHelp::getLogicExp($saveData, '=', 'AND');
		$bindData = $bindObj->getOne($conds);
		if (empty($bindData)) {
			if ($aa['op_type'] == 'group_bind') {
				$data['result'] = $bindObj->create($saveData);
			} else {
				$data['result'] = error(-1, '该权限组未被绑定');
			}
		} else {	
			if ($aa['op_type'] == 'group_unbind') {
				$data['result'] = $bindObj->remove($conds);
			} else {
				$data['result'] = error(-1, '该权限组已被绑定');
			}
		}
		$this->ajaxReturn($data);
	}
	
	// 管理员列表
	public function listAction() {	
		$this->content_title = '权限列表';
		$this->content_des = '这里你可以查看并管理你的所有权限';
		$this->_setMenuLinkCurrent('权限列表','admin_grant');
		$this->_initTemplateInfo();
		
						
		if (IS_POST) {	
			$aa = $_POST;
			if (isset($aa['op_type'])) {
				$opType = $aa['op_type'];
				if ($opType == 'find') {
					$this->typeFind($aa);
				} else if ($opType == 'create') {
					$this->typeCreate($aa);	
				} else if ($opType == 'edit') {
					$this->typeModify($aa);	
				} else if ($opType == 'delete') {
					$this->typeDelete($aa);				
				} else if ($opType == 'delete_multi'){
					$this->typeDeleteMulti($aa);
				} else if ($opType == 'list') {
					$this->typeList($aa);
				} else if ($opType == 'unique') {
					$this->typeUnique($aa);
				} else if ($opType == 'bind') {
					$this->typeBind($aa);
				} else if ($opType == 'unbind') {
					$this->typeBind($aa);
				}	else if ($opType == 'group_bind') {
					$this->typeGroupBind($aa);
				} else if ($opType == 'group_unbind') {
					$this->typeGroupBind($aa);
				}  else{
					$data['result'] = error(-1, '未知的类型动作请求');
					$this->ajaxReturn($data);
				}
			} else {
				$data['result'] = error(-1, '获取类型动作失败');
				$this->ajaxReturn($data);
			}			
		} else {
			$adminTypeObj = ModelBase::getInstance('admin_type');
			$adminType = $adminTypeObj->getAll();
			
			$op = I('get.op', false);				
			if ($op !== false) {
				$grantId = I('get.id', false);
				if ($op === 'show_edit'){
					$data['url'] = U('grant/list', 'op=edit&id='.$grantId);
					return $this->ajaxReturn($data);
				}
				
				$grantTypeObj = ModelBase::getInstance('grant_type');
				$grantType = $grantTypeObj->getAll();
				
				if ($grantId !== false) {
					$grantObj = ModelBase::getInstance('grant');
					$grant = $grantObj->getOne(appendLogicExp('id', '=', $grantId));
					foreach ($grantType as $k=>$v) {
						if ($v['id'] === $grant['type_id']) {
							$v['selected'] = true;
							$grantType[$k] = $v;
							break;
						}
					}
					$this->assign('grant', $grant);
					
					$grantAdminTypeObj = ModelBase::getInstance('grant_admin_type_bind');
					$grantAdminType = $grantAdminTypeObj->getAll(appendLogicExp('grant_id', '=', $grantId));
					foreach ($grantAdminType as $gatk=>$gatv) {
						foreach ($adminType as $atk=>$atv) {
							if ($gatv['admin_type_id'] === $atv['id']){
								$atv['checked'] = 'checked';
								$adminType[$atk] = $atv;
								break;
							}
						}
					}
					$this->assign('grant_save', check_grant('update_grant'));
				} else {
					$this->assign('grant_save', check_grant('create_grant'));
				}
				
				$this->assign('adminType', $adminType);
				$this->assign('grantType', $grantType);
				$this->display('grantinfo');
			} else {
				$this->assign('grant_create', check_grant('create_grant'));
				$this->assign('grant_update', check_grant('update_grant'));
				$this->assign('grant_delete', check_grant('delete_grant'));
				$this->assign('adminType', $adminType);
				$this->assign('typeObj', 'grant');
				$this->assign('modal_data_edit', true);
				$this->assign('ajaxReqUrl', U('grant/list'));
				$this->display('grantlist');		
			}
		}
	}
	
	// 绑定权限组
	private function bindGrantToGroup($aa) {
		if (check_grant('assign_grant') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		if (array_key_exists('grant_id', $aa)===false || array_key_exists('group_id', $aa)===false){
			$data['result'] = error(-1, '参数不完整，绑定失败');
			$this->ajaxReturn($data);
		}
		
		$bindObj = ModelBase::getInstance('grant_group_bind');
		$bindCols = $bindObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$saveData = coll_elements_giveup($bindCols, $aa);
				
		$conds = MyHelp::getLogicExp($saveData, '=', 'AND');
		$bindData = $bindObj->getOne($conds);
		$data['bind_conds'] = $conds;
		$data['binddata'] = $bindData;
		if (empty($bindData)) {
			if ($aa['op'] == 'bind') {
				$data['result'] = $bindObj->create($saveData);
				if (error_ok($data['result'])) {
					MyHelp::refreshAdminGrant();	
				}
			} else {
				$data['result'] = error(-1, '该权限未被绑定');
			}
		} else {	
			if ($aa['op'] == 'unbind') {
				$data['result'] = $bindObj->remove($conds);
				if (error_ok($data['result'])) {
					MyHelp::refreshAdminGrant();	
				}
			} else {
				$data['result'] = error(-1, '该权限已被绑定');
			}
		}
		$this->ajaxReturn($data);
	}
	
	// 显示已分配权限类表
	private function groupGrantList($aa) {
		$totalCount = 0;		
		$grantObj = ModelBase::getInstance('grant');
		$colNames = $grantObj->getUserDefine(ModelBase::DF_COL_NAMES);	
		$sortCols = MyHelp::getDataTableSortCol($aa);
		$sortCols = coll_elements_giveup($colNames,$sortCols);
		$sortDesc = strcasecmp($aa['sSortDir_0'],'desc')==0 ? true : false;
		
		$admin = MyHelp::getLoginAccount(true);
		if (is_error($admin) === false && $admin['account'] !== 'admin') {
			$conds = appendLogicExp('admin_type_id', '=', $admin['type_id']);
			$bindObj = ModelBase::getInstance('grant_admin_type_bind');
			$binds = $bindObj->getAll($conds);
			
			$cdsVal = '';
			foreach($binds as $bk=>$bv) {
				$cdsVal .= empty($cdsVal) ? '(' : ',';
				$cdsVal .= $bv['grant_id'];
			}
			if (!empty($cdsVal)) {
				$cdsVal .= ')';
				$cds = appendLogicExp('id', '=', $cdsVal, 'AND', $cds);
			}
		}
		$ds = $grantObj->getAll($cds, $aa['iDisplayStart'], $aa['iDisplayLength'], $totalCount, 'id', false);
		if (empty($ds)) {
			$ds = array();
		}
		
		// 填充数据		
		if (!empty($ds)) {
			// 获取权限组	
			$groupCDS = array();
			$admin = MyHelp::getLoginAccount(true);
			if (is_error($admin) === false && $admin['account'] !== 'admin') {
				$groupCDS = appendJoinLogicExp('group_admin_type_bind', 'admin_type_id', '=', $admin['type_id']);
			}			
			$showCols = appendJoinTableExp('grant_group', array('id', 'type_key', 'type_desc'), 'kl_', 'group');
			$showCols = appendJoinTableExp('group_admin_type_bind', array('id', 'group_id', 'admin_type_id'), 'kl_', 'bind', $showCols);
			$join = appendJoinExp('group_admin_type_bind', 'id', '=', 'group_id', 'AND', 'INNERT', 'kl_', 'bind');
			
			$grantGroupObj = ModelBase::getInstance('grant_group');
			$grantGroups = $grantGroupObj->getAllByJoin($groupCDS,$join,$showCols);
//			$data['bind'] = $grantGroups;
						
			$grantGroupBind = ModelBase::getInstance('grant_group_bind');
			// 填充权限在权限组的可用状态
			foreach($ds as $dk=>$dv) {				
				foreach ($grantGroups as $gk=>$gv) {
					$groupKey = 'group'.$gk;
					$dv[$groupKey]['checked'] = '';
					$dv[$groupKey]['group_id'] = $gv['my.id'];
					$bindCDS = appendLogicExp('grant_id', '=', $dv['id']);
					$bindCDS = appendLogicExp('group_id', '=', $gv['my.id'], 'AND', $bindCDS);				
					$bindCount = $grantGroupBind->getCount($bindCDS);
					if (!empty($bindCount) && $bindCount > 0){
						$dv[$groupKey]['checked'] = 'checked';
					}
				}
				$ds[$dk] = $dv;
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
	
	// 分配权限组
	public function groupAction() {
		if (IS_POST) {
			$aa = $_POST;
			if (isset($aa['op'])) {
				$opType = $aa['op'];
				if ($opType == 'bind') {
					$this->bindGrantToGroup($aa);
				} else if ($opType == 'unbind') {
					$this->bindGrantToGroup($aa);
				} else if ($opType == 'list') {
					$this->groupGrantList($aa);
				} else {
					$data['result'] = error(-1, '未知操作');
					$this->ajaxReturn($data);
				}
			} else {
				$data['aa'] = $aa;
				$data['result'] = error(-1, '未设置操作参数');
				$this->ajaxReturn($data);
			}
		} else {			
			$op = I('get.op', false);
			if ($op == 'jumpGroup') {
				$groupId = I('get.id', false);
				if ($groupId === false) {
					$data['result'] = error(-1, '参数错误');
					return $this->ajaxReturn($data);
				}
				$data['url'] = U('grant/group', 'gid='.$groupId);
				$this->ajaxReturn($data);	
			} else if ($op == 'all') {
				$this->content_title = '权限组权限分配';
				$this->content_des = '这里你可以查看并分配所能分配的权限组权限';
				$this->_setMenuLinkCurrent('权限组列表','admin_grant_group');
				$this->_initTemplateInfo();
				
				$groupCDS = array();
				$admin = MyHelp::getLoginAccount(true);
				if (is_error($admin) === false && $admin['account'] !== 'admin') {
					$groupCDS = appendJoinLogicExp('group_admin_type_bind', 'admin_type_id', '=', $admin['type_id']);
				}	
				$join = appendJoinExp('group_admin_type_bind', 'id', '=', 'group_id', 'AND', 'INNER', 'kl_', 'bind');
				$showCols = appendJoinTableExp('grant_group', array('id', 'type_key', 'type_desc'), 'kl_', 'group');
				$showCols = appendJoinTableExp('group_admin_type_bind', array('id', 'group_id', 'admin_type_id'), 'kl_', 'bind', $showCols);			
				
				$groupObj = ModelBase::getInstance('grant_group');
				$groups = $groupObj->getAllByJoin($groupCDS, $join, $showCols);
				$output['sql'] = $groupObj->getLastSql();
				$this->assign('output', $output);
				
				$this->assign('groups', $groups);
				$this->display('grantgroup1');
			} else {
				$this->content_title = '权限组管理';
				$this->content_des = '这里你可以查看并管理权限组下面的所有权限';
				$this->_setMenuLinkCurrent('权限组列表','admin_grant_group');
				$this->_initTemplateInfo();
				$groupId = I('get.gid', false);				
				
				// 获取所有权限
				$grantObj = ModelBase::getInstance('grant');
				$grants = $grantObj->getAll();
				
				if ($groupId !== false) {
					$groupObj = ModelBase::getInstance('grant_group');
					$group = $groupObj->getOne(appendLogicExp('id', '=', $groupId));
					$this->assign('group', $group);
					
					$bindObj = ModelBase::getInstance('grant_group_bind');
					$binds = $bindObj->getAll(appendLogicExp('group_id', '=', $groupId));
					foreach ($grants as $k=>$v) {
						foreach ($binds as $bk=>$bv) {
							if ($v['id'] === $bv['grant_id']) {
								$v['checked'] = 'checked';
								$grants[$k] = $v;
								break;
							}	
						}
					}
				}
				$this->assign('grants', $grants);
				
				$this->assign('gid', $groupId);
				$this->display('grantgroup');
			}
		}
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