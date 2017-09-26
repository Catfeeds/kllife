<?php

namespace Back\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;

class MenuController extends BackBaseController {
	
	protected function _initialize(){		
		$this->page_title = '菜单管理';
		$this->content_title_show = 0;
	}
		
	// 获取查询列表条件
	private function getFindListCDS($cds) {
		if (empty($cds)) {
			return array();
		}   
		
		$cdList = array();
		foreach ($cds as $k=>$v) {
			switch($k){
				case 'item_type': $cdList['menu_type_id'] = $v; break; //模糊查找，自定义条件
				case 'item_parent': $cdList['parent_id'] = $v; break;
				default: break;
			}
		}
			
		MyHelp::filterInvalidConds($cdList);
		return $cdList;
	}
	
	// 菜单项列表
	private function typeList($aa) {
		if (check_grant('list_menu_item') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
				
		$totalCount = 0;
		$menuItemObj = ModelBase::getInstance('menu_item');		
		$colNames = $menuItemObj->getUserDefine(ModelBase::DF_COL_NAMES);
			
		$cds = array();
		$cdsstr = explode(',',$aa['cds']);
		for($i = 0; $i < count($cdsstr); $i+=2){
			$cds[$cdsstr[$i]] = $cdsstr[$i+1];
		}
		$cds = $this->getFindListCDS($cds);
		$thisCds = coll_elements_giveup($colNames, $cds);
		$conds = MyHelp::getLogicExp($thisCds, '=', 'AND');		
		
		if (!empty($aa['sSearch'])) {
			$searchConds = appendLogicExp('id', '=', $aa['sSearch'], 'OR' ,$searchConds);
			$searchConds = appendLogicExp('item_key', 'LIKE', '%'.$aa['sSearch'].'%', 'OR' ,$searchConds);
			$searchConds = appendLogicExp('item_desc', 'LIKE', '%'.$aa['sSearch'].'%', 'OR' ,$searchConds);
			$conds = appendLogicExp('search', '=', $searchConds, 'AND', $conds);
		}
				
		$sortCol = $colNames[intval($aa['iSortCol_0'])-1];
		if (empty($sortCol)) {
			$sortCol = 'id';
		}
		$sortDesc = strcasecmp($aa['sSortDir_0'],'desc')==0 ? 'desc' : 'asc';		
		$sortList = array($sortCol=>$sortDesc,'sort'=>'asc');		
		
		$ds = $menuItemObj->getAll($conds, $aa['iDisplayStart'], $aa['iDisplayLength'], $totalCount, $sortList);
		$data['sql'] = $menuItemObj->getLastSql();
		if (empty($ds)) {
			$ds = array();
		} else {						
			$menuTypeObj = ModelBase::getInstance('menu_type');
			foreach ($ds as $dk=>$dv) {
				// 菜单类型
				$menuType = $menuTypeObj->getOne(appendLogicExp('id', '=', $dv['menu_type_id']));
				if (!empty($menuType)) {
					$dv['menu_type_id_type_desc'] = $menuType['type_desc'];
				}
				
				// 父菜单项
				if (empty($dv['parent_id'])) {
					$dv['parent_id_item_desc'] = '根节点';
				} else {
					$menuItem = $menuItemObj->getOne(appendLogicExp('id', '=', $dv['parent_id']));
					if (!empty($menuItem)) {
						$dv['parent_id_item_desc'] = $menuItem['item_desc'];
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
	
	// 创建菜单项
	private function typeCreate($aa) {
		if (check_grant('create_menu_item') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		if (!array_key_exists('data', $aa)) {
			$data['result'] = error(-1, '参数不齐全，无法创建菜单项信息');
			return $this->ajaxReturn($data);
		}
		
		$menuItemObj = ModelBase::getInstance('menu_item');		
		$colNames = $menuItemObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$saveData = coll_elements_giveup($colNames, $aa['data']);
		if (!empty($saveData['parent_id'])) {
			$parentItemKey = MyHelp::MenuItemKey2Value($saveData['menu_type_id'], $saveData['parent_id']);
			if (is_error($parentItemKey) === false) {
				$saveData['item_key'] = $parentItemKey.'_'.$saveData['item_key'];
			}
		} else {
			$typeItemKey = MyHelp::MenuTypeKey2Value($saveData['menu_type_id']);
			if (is_error($typeItemKey) === false) {
				$saveData['item_key'] = $typeItemKey.'_'.$saveData['item_key'];
			}
		}
		$saveData['can_delete'] = 0;		
		$admin = MyHelp::getLoginAccount(true);
		if ($admin['account'] !== 'admin') {
			$saveData['can_delete'] = 1;
		}
		
		$data['result'] = $menuItemObj->create($saveData, $itemId);
		// 更新缓存
		if (error_ok($data['result']) === true) {
			if (stripos($menuItem['item_key'], 'pc_home_menu') !== FALSE) {
				$cacheKey = 'pc_home_top_menu';
			} else if (stripos($menuItem['item_key'], 'pc_home_left_menu') !== FALSE) {
				$cacheKey = 'pc_home_left_menu';
			}
			if (!empty($cacheKey)) {
				MyHelp::saveConfigUpdateTime($cacheKey);
			}
		}
		$data['itemId'] = $itemId;
		return $this->ajaxReturn($data);		
	}
	
	// 查找菜单
	public function typeFind($aa) {
		$data['aa'] = $aa;
		if (!array_key_exists('data_type', $aa)) {
			$data['result'] = error(-1, '参数不齐全，无法查找菜单项信息');
			return $this->ajaxReturn($data);
		}
		
		$data['result'] = error(0, '查找菜单信息成功');
		$menuItemObj = ModelBase::getInstance('menu_item');
		$colNames = $menuItemObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$cds = coll_elements_giveup($colNames, $aa);
		$conds = MyHelp::getLogicExp($cds, '=', 'AND');
		
		if (!empty($aa['menu_type'])) {
			if (is_numeric($aa['menu_type'])) {
				$menuTypeId =  intval($aa['menu_type']);
			} else {
				$menuTypeId =  MyHelp::IdEachTypeKey('menu_type', $aa['menu_type']);
				if (is_error($menuTypeId) === true) {
					$menuTypeId = 0;
				}
			}
			if (!empty($menuTypeId)) {
				$conds = appendLogicExp('menu_type_id', '=', $menuTypeId, 'AND', $conds);
			}
		}
		
		if ($aa['data_type'] === 'one') {
			$data['data'] = $menuItemObj->getOne($conds);
		} else {
			$data['data'] = $menuItemObj->getAll($conds);	
		}
		return $this->ajaxReturn($data);		
	}
	
	// 编辑菜单项
	private function typeEdit($aa) {
		if (check_grant('update_menu_item') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		if (!array_key_exists('id', $aa) || !array_key_exists('data', $aa)) {
			$data['result'] = error(-1, '参数不齐全，无法查找编辑菜单项信息');
			return $this->ajaxReturn($data);
		}
		
		$menuItemObj = ModelBase::getInstance('menu_item');		
		$colNames = $menuItemObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$saveData = coll_elements_giveup($colNames, $aa['data']);
		
		$conds = appendLogicExp('id', '=', $aa['id']);
		$data['result'] = $menuItemObj->modify($saveData, $conds);
		// 更新缓存
		if (error_ok($data['result']) === true) {
			$menuItem = $menuItemObj->getOne($conds);
			$data['item'] = $menuItem;
			$data['search_result'] = stripos($menuItem['item_key'], 'pc_home_menu');
			if (!empty($menuItem)) {
				if (stripos($menuItem['item_key'], 'pc_home_menu') !== FALSE) {
					$cacheKey = 'pc_home_top_menu';
				} else if (stripos($menuItem['item_key'], 'pc_home_left_menu') !== FALSE) {
					$cacheKey = 'pc_home_left_menu';
				}
				if (!empty($cacheKey)) {
					$data['cache_result'] = MyHelp::saveConfigUpdateTime($cacheKey);
				}
			}
		}
		return $this->ajaxReturn($data);		
	}
	
	// 删除菜单项
	private function typeDelete($aa) {
		if (check_grant('delete_menu_item') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		if (!array_key_exists('id', $aa)) {
			$data['result'] = error(-1, '参数不齐全，无法删除菜单项信息');
			return $this->ajaxReturn($data);
		}
		
		$cds = appendLogicExp('id', '=', $aa['id']);
		$menuItemObj = ModelBase::getInstance('menu_item');	
		$menuItem = $menuItemObj->getOne($cds);
		if (empty($menuItem)) {
			$data['result'] = error(-1, '要删除的对象不存在');
		} else if ($menuItem['can_delete'] == 0){		
			$admin = MyHelp::getLoginAccount(true);
			if ($admin['account'] !== 'admin') {
				$data['result'] = error(-1, '您没有权限进行此操作');
			} else {				
				$data['result'] = $menuItemObj->remove($cds);
			}
		} else {
			$data['result'] = $menuItemObj->remove($cds);
		}
		// 更新缓存
		if (error_ok($data['result']) === true) {
			if (stripos($menuItem['item_key'], 'pc_home_menu') !== FALSE) {
				$cacheKey = 'pc_home_top_menu';
			} else if (stripos($menuItem['item_key'], 'pc_home_left_menu') !== FALSE) {
				$cacheKey = 'pc_home_left_menu';
			}
			if (!empty($cacheKey)) {
				MyHelp::saveConfigUpdateTime($cacheKey);
			}
		}
			
		return $this->ajaxReturn($data);		
	}
	
	public function listAction() {
		if (IS_POST) {	
			$aa = $_POST;
			if (isset($aa['op_type'])) {
				$opType = $aa['op_type'];				
				if ($opType == 'create') {
					$this->typeCreate($aa);
				} else if ($opType == 'find') {
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
			$this->assign('grant_create_menu', check_grant('create_menu_item'));
			$this->assign('grant_update_menu', check_grant('update_menu_item'));		
			$this->assign('grant_delete_menu', check_grant('delete_menu_item'));
			
			$menuTypeObj = ModelBase::getInstance('menu_type');
			$menuTypes = $menuTypeObj->getAll();
			$this->assign('MenuItemTypes', $menuTypes);
				
			$this->assign('modal_data_edit', true);
			$this->assign('ajaxReqUrl', U('menu/list'));
				
			$this->_initBaseInfo('menu_item','menu','菜单项列表','菜单项列表','这里你可以创建、编辑管理菜单类型');
			$this->display('list');
		}
	}
	
}

?>