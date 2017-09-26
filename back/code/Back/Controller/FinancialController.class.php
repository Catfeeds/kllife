<?php

namespace Back\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackFinancialHelp;
use Core\Model\BackAccountHelp;
use Core\Model\BackImageHelp;
use Core\Model\BackOrderHelp;
use Core\Model\BackReviewHelp;

define('LIST_SHOW_PAGE_COUNT', 20);
define('ITEM_SHOW_PAGE_COUNT', 5);
define('LEADER_QUESTION_SHOW_PAGE_COUNT', 10);
define('LEADER_PICTRUE_SHOW_PAGE_COUNT', 12);
define('TEAM_SHOW_PAGE_COUNT', 20);

class FinancialController extends BackBaseController {
	
	// 显示资源列表
	private function listSource($sourceType) {
		if (IS_POST) {
			$pageIndex = I('post.page', 0);
			$cdsstr = I('post.cdsstr', '');
			$sourceType = I('post.src', false);
		} else {
			$pageIndex = 0;
			$cdsstr = I('get.cdsstr', '');
			$sourceType = I('get.src', false);
		}
		
		$sourceTable = array(
			'insurance'=>'cj_insurance',
			'leader'=>'cj_leader',
			'hotel'=>'cj_hotel',
			'driver'=>'cj_driver',
			'bus'=>'cj_bus',
			'view'=>'cj_view',
			'agency'=>'cj_agency',
			'source'=>'cj_source',
		);
		
		if (empty($sourceType) || empty($sourceTable[$sourceType])) {
			if (IS_POST) {
				$data['result'] = error(-1, '错误的资源类型');
				$this->ajaxReturn($data);
			} else {
				$this->showError('501','类型错误','错误的资源类型','没有该类型的对应资源');
			}
		}
		
		$conds = appendLogicExp('invalid', '=', '0');
		$searchConds = MyHelp::getCondsByStr($cdsstr, 4);
		if (!empty($searchConds)) {
			$conds = appendLogicExp('search', '=', $searchConds, 'AND', $conds);
		}
		
		$result = MyHelp::getPageList1($sourceTable[$sourceType], $conds, $pageIndex, LIST_SHOW_PAGE_COUNT, array('id'=>'asc'), $out);
		$ds = $result['ds'];
		$pageCount = $result['page_count'];
		
		foreach($ds as $dk=>$dv){
			$dv['line_show'] = '';
			if (!empty($dv['line'])) {
				$dv['line_data'] = json_decode($dv['line'], true);
				foreach($dv['line_data'] as $lk=>$lv) {
					if (!empty($dv['line_show'])) {
						$dv['line_show'] .= ',';
					}
					$dv['line_show'] .= $lv['title'];
				}
			}
			
			$dv['pay_type_show'] = '';
			if (!empty($dv['pay_type'])) {
				$dv['pay_type_data'] = json_decode($dv['pay_type'], true);
				$dv['pay_type_show'] = $dv['pay_type_data']['type_desc'];
			}
			
			$ds[$dk] = $dv;
		}
		
		if (IS_POST) {
			$data['out'] = $out;
			$data['ds'] = $ds;
			$data['page_count'] = $pageCount;
			$data['result'] = error(0, '');
			$this->ajaxReturn($data);
		} else {
			$this->assign('datas', $ds);
			$this->assign('page_count', $pageCount);
			
			$this->assign('modal_cj_item', true);
			
			if ($sourceType == 'insurance') {
				$this->showPage('insurance', 'financial_resource_insurance', 'financial_resource', '保险资源', '保险资源录入', '创建、编辑、修改保险资源信息');	
			} else if ($sourceType == 'leader') {
				$this->showPage('leader', 'financial_resource_leader', 'financial_resource', '领队资源', '领队资源信息', '创建、编辑、修改领队资源信息');
			} else if ($sourceType == 'hotel') {
				$this->showPage('hotel', 'financial_resource_hotel', 'financial_resource', '酒店资源', '酒店资源信息', '创建、编辑、修改酒店资源信息');
			} else if ($sourceType == 'driver') {
				$this->showPage('driver', 'financial_resource_driver', 'financial_resource', '司机资源', '保险资源信息', '创建、编辑、修改司机资源信息');
			} else if ($sourceType == 'bus') {
				$this->showPage('bus', 'financial_resource_bus', 'financial_resource', '大巴资源', '大巴资源信息', '创建、编辑、修改大巴资源信息');
			} else if ($sourceType == 'view') {
				$this->showPage('view', 'financial_resource_view', 'financial_resource', '景点资源', '景点资源信息', '创建、编辑、修改景点资源信息');
			} else if ($sourceType == 'agency') {
				$this->showPage('agency', 'financial_resource_agency', 'financial_resource', '同行地接', '同行地接资源信息', '创建、编辑、修改同行地接资源信息');
			} else if ($sourceType == 'source') {
				$this->showPage('source', 'financial_resource_source', 'financial_resource', '其他资源', '其他资源信息', '创建、编辑、修改其他资源信息');
			} else {
				$this->showError('404','找不到该资源','错误的资源类型','没有该类型的对应资源');
			}
		}
	}
	
	// 查找资源
	private function findSource($aa) {			
		$sourceTable = array(
			'insurance'=>'cj_insurance',
			'leader'=>'cj_leader',
			'hotel'=>'cj_hotel',
			'driver'=>'cj_driver',
			'bus'=>'cj_bus',
			'view'=>'cj_view',
			'agency'=>'cj_agency',
			'source'=>'cj_source',
		);	
		
		if (empty($aa['src']) || empty($sourceTable[$aa['src']])) {
			if (IS_POST) {
				$data['result'] = error(-1, '错误的资源类型');
				$this->ajaxReturn($data);
			} else {
				$this->showError('501','类型错误','错误的资源类型','没有该类型的对应资源');
			}
		}
		
		$dataObj = ModelBase::getInstance($sourceTable[$aa['src']]);
		$colNames = $dataObj->getUserDefine(ModelBase::DF_COL_NAMES);		
		$cds = coll_elements_giveup($colNames, $aa);
		MyHelp::filterInvalidConds($cds);
		$conds = MyHelp::getLogicExp($cds, '=', 'AND');
		
		$ds = $dataObj->getOne($conds);
		
		if (!empty($ds)) {
			if ($aa['src'] == 'leader') {
				$ds['type_data'] = json_decode($ds['type'], true);
			}
			
			$ds['line_show'] = '';
			if (!empty($ds['line'])) {
				$ds['line_data'] = json_decode($ds['line'], true);
				foreach($ds['line_data'] as $lk=>$lv) {
					if (!empty($ds['line_show'])) {
						$ds['line_show'] .= ',';
					}
					$ds['line_show'] .= $lv['title'];
				}
			}
			
			$ds['pay_type_show'] = '';
			if (!empty($ds['pay_type'])) {
				$ds['pay_type_data'] = json_decode($ds['pay_type'], true);
				$ds['pay_type_show'] = $ds['pay_type_data']['type_desc'];
			}
		}
		
		$data['ds'] = $ds;
		$data['result'] = error(0, '');
		$this->ajaxReturn($data);		
	}
	
	// 保存页面关键字
	private function saveSource($aa) {
		if (check_grant('cj_source_append') === false && check_grant('cj_source_update') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		$sourceTable = array(
			'insurance'=>'cj_insurance',
			'leader'=>'cj_leader',
			'hotel'=>'cj_hotel',
			'driver'=>'cj_driver',
			'bus'=>'cj_bus',
			'view'=>'cj_view',
			'agency'=>'cj_agency',
			'source'=>'cj_source',
		);
		
		if (empty($aa['src']) || empty($sourceTable[$aa['src']])) {
			if (IS_POST) {
				$data['result'] = error(-1, '错误的资源类型');
				$this->ajaxReturn($data);
			} else {
				$this->showError('501','类型错误','错误的资源类型','没有该类型的对应资源');
			}
		}
		
		$dataObj = ModelBase::getInstance($sourceTable[$aa['src']]);
		$colNames = $dataObj->getUserDefine(ModelBase::DF_COL_NAMES);		
		$ds = coll_elements_giveup($colNames, $aa);
		
		if (empty($ds['id'])) {
			$data['op'] = 'create';
			$data['result'] = $dataObj->create($ds, $dataId);
			if (error_ok($data['result']) === true) {
				$ds['id'] = $dataId;
			}
		} else {
			$data['op'] = 'edit';
			unset($ds['id']);
			$data['result'] = $dataObj->modify($ds, appendLogicExp('id', '=', $aa['id']));
		}
		
		if (!empty($ds)) {
			$ds['id'] = $aa['id'];
			if ($aa['src'] == 'leader') {
				$ds['type_data'] = json_decode($ds['type'], true);
			}
			
			$ds['line_show'] = '';
			if (!empty($ds['line'])) {
				$ds['line_data'] = json_decode($ds['line'], true);
				foreach($ds['line_data'] as $lk=>$lv) {
					if (!empty($ds['line_show'])) {
						$ds['line_show'] .= ',';
					}
					$ds['line_show'] .= $lv['title'];
				}
			}
			
			$ds['pay_type_show'] = '';
			if (!empty($ds['pay_type'])) {
				$ds['pay_type_data'] = json_decode($ds['pay_type'], true);
				$ds['pay_type_show'] = $ds['pay_type_data']['type_desc'];
			}
		}
		
		$data['ds'] = $ds;
		$this->ajaxReturn($data);
	}
	
	// 删除页面关键字
	private function deleteSource() {
		if (check_grant('cj_source_delete') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
			
		$sourceTable = array(
			'insurance'=>'cj_insurance',
			'leader'=>'cj_leader',
			'hotel'=>'cj_hotel',
			'driver'=>'cj_driver',
			'bus'=>'cj_bus',
			'view'=>'cj_view',
			'agency'=>'cj_agency',
			'source'=>'cj_source',
		);
		
		$sourceType = I('post.src', false);
		if (empty($sourceType) || empty($sourceTable[$sourceType])) {
			if (IS_POST) {
				$data['result'] = error(-1, '错误的资源类型');
				$this->ajaxReturn($data);
			} else {
				$this->showError('501','类型错误','错误的资源类型','没有该类型的对应资源');
			}
		}
		
		$did = I('post.id', false);		
		if (empty($did)) {
			$data['result'] = error(-1, '删除资源，编号错误');
			$this->ajaxReturn($data);
		}
		
		$dataObj = ModelBase::getInstance($sourceTable[$sourceType]);
		$data['result'] = $dataObj->modify(array('invalid'=>'1'), appendLogicExp('id', '=', $did));		
		$this->ajaxReturn($data);
	}
	
	// 资源处理
	public function sourceAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'list') {
				$this->listSource();
			} else if ($type == 'find') {
				$this->findSource($_POST);
			} else if ($type == 'save') {
				$this->saveSource($_POST);	
			} else if ($type == 'delete') {
				$this->deleteSource();
			} else {
				$data['result'] = error(-1, '错误的操作方式');
				$this->ajaxReturn($data);
			}
		} else {				
			$this->listSource($sourceType);
		}
 	}
	
	// 显示资源列表
	private function listItem() {
		if (IS_POST) {
			$pageIndex = I('post.page', 0);
			$cdsstr = I('post.cdsstr', '');
			$objType = I('post.obj_type', '');
		} else {
			return $this->showError('501', '访问错误', '无效的请求', '错误的访问方法');
		}
		
		if (!empty($objType)) {
			switch($objType){
				case 'insurance': $objKey = 'cj_source_obj_insurance'; break;
				case 'leader': $objKey = 'cj_source_obj_leader'; break;
				case 'hotel': $objKey = 'cj_source_obj_hotel'; break;
				case 'driver': $objKey = 'cj_source_obj_driver'; break;
				case 'bus': $objKey = 'cj_source_obj_bus'; break;
				case 'view': $objKey = 'cj_source_obj_view'; break;
				case 'agency': $objKey = 'cj_source_obj_agency'; break;
				case 'source': $objKey = 'cj_source_obj_source'; break;
			}
			if (!empty($objKey)) {
				$conds = appendLogicExp('obj_type', 'LIKE', '%'.$objKey.'%', 'AND', $conds);	
			}
		}
	
		$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
		$searchConds = MyHelp::getCondsByStr($cdsstr, 4);
		if (!empty($searchConds)) {
			$conds = appendLogicExp('search', '=', $searchConds, 'AND', $conds);
		}
		
		$startIndex = $pageIndex * ITEM_SHOW_PAGE_COUNT;
		$ds = BackFinancialHelp::getItemList($conds, $startIndex, ITEM_SHOW_PAGE_COUNT, $total, array('id'=>'desc'));
		
		$pageCount = intval($total / ITEM_SHOW_PAGE_COUNT);
		if (intval($total) % ITEM_SHOW_PAGE_COUNT > 0) {
			$pageCount ++;
		}
		
		if (IS_POST) {
			$data['conds'] = $conds;
			$data['total'] = $total;
			$data['ds'] = $ds;
			$data['page_size'] = ITEM_SHOW_PAGE_COUNT;
			$data['page_count'] = $pageCount;
			$data['result'] = error(0, '');
			$this->ajaxReturn($data);
		}
	}
	
	// 查找消费项
	private function findItem($aa) {
		if (!empty($aa['cdtype']) && !empty($aa['cdsstr'])) {
			$conds = MyHelp::getCondsByStr($aa['cdsstr'], $aa['cdtype']);	
		}
		
		if (!empty($aa['obj_type'])) {
			switch($aa['obj_type']){
				case 'insurance': $objTypeKey = 'cj_source_obj_insurance'; break;
				case 'leader': $objTypeKey = 'cj_source_obj_leader'; break;
				case 'hotel': $objTypeKey = 'cj_source_obj_hotel'; break;
				case 'driver': $objTypeKey = 'cj_source_obj_driver'; break;
				case 'bus': $objTypeKey = 'cj_source_obj_bus'; break;
				case 'view': $objTypeKey = 'cj_source_obj_view'; break;
				case 'agency': $objTypeKey = 'cj_source_obj_agency'; break;
				case 'source': $objTypeKey = 'cj_source_obj_source'; break;
			}
			
			$objType = MyHelp::TypeDataKey2Value($objTypeKey, true);
			if (empty($objTypeKey) || is_error($objType) === true) {
				$data['result'] = error(-1, '无效的资源类型');
				$this->ajaxReturn($data);
			}
			$conds = appendLogicExp('obj_type', 'LIKE', '%'.$objType['type_key'].'%', 'AND', $conds);
		}
		
		$data['conds'] = $conds;
		$ds = BackFinancialHelp::getItem($conds);
		$data['ds'] = $ds;
		$data['result'] = error(0, '');
		$this->ajaxReturn($data);		
	}
	
	// 保存页面关键字
	private function saveItem($aa) {
		if (check_grant('cj_source_append') === false && check_grant('cj_source_update') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		$dataObj = ModelBase::getInstance('cj_item');
		$colNames = $dataObj->getUserDefine(ModelBase::DF_COL_NAMES);		
		$ds = coll_elements_giveup($colNames, $aa);
		
		// 对象类型
		if (!empty($ds['obj_type'])) {			
			switch($ds['obj_type']){
				case 'insurance': $objTypeKey = 'cj_source_obj_insurance'; break;
				case 'leader': $objTypeKey = 'cj_source_obj_leader'; break;
				case 'hotel': $objTypeKey = 'cj_source_obj_hotel'; break;
				case 'driver': $objTypeKey = 'cj_source_obj_driver'; break;
				case 'bus': $objTypeKey = 'cj_source_obj_bus'; break;
				case 'view': $objTypeKey = 'cj_source_obj_view'; break;
				case 'agency': $objTypeKey = 'cj_source_obj_agency'; break;
				case 'source': $objTypeKey = 'cj_source_obj_source'; break;
			}
			
			$objType = MyHelp::TypeDataKey2Value($objTypeKey, true);
			if (empty($objTypeKey) || is_error($objType) === true) {
				$data['result'] = error(-1, '无效的资源类型');
				$this->ajaxReturn($data);
			}
			$ds['obj_type'] = my_json_encode($objType);
		}
		
		if (stripos($aa['type'],'cj_item_type_room') !== FALSE) {
			$extraObj = ModelBase::getInstance('cj_item_room');
			$extraColNames = $extraObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$extraDS = coll_elements_giveup($extraColNames, $aa);
		}
		
		$type = json_decode($ds['type'], true);
		
		if (empty($ds['id'])) {
			$data['op'] = 'create';
			$data['result'] = $dataObj->create($ds, $dataId);
			if (error_ok($data['result']) === true) {
				if ($type == 'cj_item_type_room') {
					$extraDS['item_id'] = $dataId;
					$data['extra_result'] = $extraObj->create($extraDS, $extraId);
				}				
				$data['ds'] = BackFinancialHelp::getItem(appendLogicExp('id', '=', $dataId));
			}
		} else {
			$data['op'] = 'edit';
			$data['mds'] = $ds;
			$itemId = $ds['id'];			
			unset($ds['id']);
			$data['result'] = $dataObj->modify($ds, appendLogicExp('id', '=', $itemId));
			if ($type == 'cj_item_type_room') {
				unset($extraDS['id']);
				$data['extra_result'] = $extraObj->modify($extraDS, appendLogicExp('item_id', '=', $itemId));
			}
			$data['mextra'] = $extraDS;
			$data['ds'] = BackFinancialHelp::getItem(appendLogicExp('id', '=', $itemId));
		}
		$this->ajaxReturn($data);
	}
	
	// 删除页面关键字
	private function deleteItem() {		
		if (check_grant('cj_source_delete') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		$did = I('post.id', false);		
		if (empty($did)) {
			$data['result'] = error(-1, '删除资源，编号错误');
			$this->ajaxReturn($data);
		}
		
		$dataObj = ModelBase::getInstance('cj_item');
		$ds = $dataObj->getOne(appendLogicExp('id', '=', $did));
		
		$data['result'] = $dataObj->modify(array('invalid'=>'1'), appendLogicExp('id', '=', $did));
		if (error_ok($data['result']) === true) {		
			if (stripos($ds['type'], 'cj_item_type_room') !== FALSE) {
				$extraObj = ModelBase::getInstance('cj_item_room');
				$data['extra_result'] = $extraObj->remove(appendLogicExp('item_id', '=', $did));
			}
		}
		$this->ajaxReturn($data);
	}
 	
 	// 消费项处理
 	public function itemAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'list') {
				$this->listItem();	
			} else if ($type == 'find') {
				$this->findItem($_POST);	
			} else if ($type == 'save') {
				$this->saveItem($_POST);	
			} else if ($type == 'delete') {
				$this->deleteItem();	
			} else {
				$data['result'] = error(-1, '错误的操作方式');
				$this->ajaxReturn($data);
			}
		} else {				
			$this->showError('501', '访问错误', '访问接口错误，没有该接口', '错误的访问被拒绝');
		}
	}	
	
	// 显示资源列表
	private function listPrice() {
		if (IS_POST) {
			$pageIndex = I('post.page', 0);
			$cdsstr = I('post.cdsstr', '');
			$itemId = I('post.item_id', '');
		} else {
			return $this->showError('501', '访问错误', '无效的请求', '错误的访问方法');
		}
		
		$conds = appendLogicExp('item_id', '=', $itemId, 'AND', $conds);
		$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
		$searchConds = MyHelp::getCondsByStr($cdsstr, 4);
		if (!empty($searchConds)) {
			$conds = appendLogicExp('search', '=', $searchConds, 'AND', $conds);
		}
		
		$ds = BackFinancialHelp::getPriceList($conds, 0, 0, $total, array('id'=>'desc'));

		if (IS_POST) {
			$data['conds'] = $conds;
			$data['total'] = $total;
			$data['ds'] = $ds;
			$data['result'] = error(0, '');
			$this->ajaxReturn($data);
		}
	}
	
	// 查找消费项
	private function findPrice($aa) {		
		$dataObj = ModelBase::getInstance('cj_price');
		$colNames = $dataObj->getUserDefine(ModelBase::DF_COL_NAMES);		
		$cds = coll_elements_giveup($colNames, $aa);
		MyHelp::filterInvalidConds($cds);
		$conds = MyHelp::getLogicExp($cds, '=', 'AND');
		$data['conds'] = $conds;
		$ds = BackFinancialHelp::getPrice($conds);
		$data['ds'] = $ds;
		$data['result'] = error(0, '');
		$this->ajaxReturn($data);		
	}
	
	// 保存页面关键字
	private function savePrice($aa) {
		if (check_grant('cj_source_append') === false && check_grant('cj_source_update') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		$dataObj = ModelBase::getInstance('cj_price');
		$colNames = $dataObj->getUserDefine(ModelBase::DF_COL_NAMES);		
		$ds = coll_elements_giveup($colNames, $aa);
		
		// 对象类型
		if (!empty($ds['obj_type'])) {			
			switch($ds['obj_type']){
				case 'insurance': $objTypeKey = 'cj_source_obj_insurance'; break;
				case 'leader': $objTypeKey = 'cj_source_obj_leader'; break;
				case 'hotel': $objTypeKey = 'cj_source_obj_hotel'; break;
				case 'driver': $objTypeKey = 'cj_source_obj_driver'; break;
				case 'bus': $objTypeKey = 'cj_source_obj_bus'; break;
				case 'view': $objTypeKey = 'cj_source_obj_view'; break;
				case 'agency': $objTypeKey = 'cj_source_obj_agency'; break;
				case 'source': $objTypeKey = 'cj_source_obj_source'; break;
			}
			
			$objType = MyHelp::TypeDataKey2Value($objTypeKey, true);
			if (empty($objTypeKey) || is_error($objType) === true) {
				$data['result'] = error(-1, '无效的价格类型');
				$this->ajaxReturn($data);
			}
			$ds['obj_type'] = my_json_encode($objType);
		}
		
		if (empty($ds['id'])) {
			$data['op'] = 'create';
			if (empty($ds['review_type'])) {
				$loginAcct = MyHelp::getLoginAccount(false);
				if (is_error($loginAcct) === false) {
					$ds['commit_admin'] = my_json_encode(array('id'=>$loginAcct['id'], 'account'=>$loginAcct['account'], 'show_name'=>$loginAcct['show_name']));
				} else {
					$data['jumpUrl'] = UNLOGIN_URL;
				}
				$reviewType = BackReviewHelp::reviewTypeKey2Value('reviewing', true);
				if (is_error($reviewType) === false) {
					$ds['review_type'] = my_json_encode(array('id'=>$reviewType['id'], 'type_key'=>$reviewType['type_key'], 'type_desc'=>$reviewType['type_desc']));	
				}
			}			
			$data['result'] = $dataObj->create($ds, $dataId);
			if (error_ok($data['result']) === true) {			
				$data['ds'] = BackFinancialHelp::getPrice(appendLogicExp('id', '=', $dataId));
			}
		} else {
			$data['op'] = 'edit';
			$data['mds'] = $ds;
			$itemId = $ds['id'];			
			unset($ds['id']);
			if (empty($ds['review_type'])) {
				$loginAcct = MyHelp::getLoginAccount(false);
				if (is_error($loginAcct) === false) {
					$ds['commit_admin'] = my_json_encode(array('id'=>$loginAcct['id'], 'account'=>$loginAcct['account'], 'show_name'=>$loginAcct['show_name']));
				} else {
					$data['jumpUrl'] = UNLOGIN_URL;
				}
				$reviewType = BackReviewHelp::reviewTypeKey2Value('reviewing', true);
				if (is_error($reviewType) === false) {
					$ds['review_type'] = my_json_encode(array('id'=>$reviewType['id'], 'type_key'=>$reviewType['type_key'], 'type_desc'=>$reviewType['type_desc']));	
				}
			}	
			$data['result'] = $dataObj->modify($ds, appendLogicExp('id', '=', $itemId));
			if (error_ok($data['result']) === true) {
				$data['ds'] = BackFinancialHelp::getPrice(appendLogicExp('id', '=', $itemId));	
			}
		}
		$this->ajaxReturn($data);
	}
	
	// 删除价格
	private function deletePrice() {	
		if (check_grant('cj_source_delete') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
			
		$did = I('post.id', false);		
		if (empty($did)) {
			$data['result'] = error(-1, '删除价格，编号错误');
			$this->ajaxReturn($data);
		}
		
		$dataObj = ModelBase::getInstance('cj_price');
		$data['result'] = $dataObj->modify(array('invalid'=>'1'), appendLogicExp('id', '=', $did));
		$this->ajaxReturn($data);
	}
	
	// 审核价格
	private function reviewPrice() {
		if (IS_POST) {
			$op = I('post.op');
			if ($op == 'review') {
				if (check_grant('cj_price_review') === false) {
					$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
					return $this->ajaxReturn($data);
				}
				$price_id = I('post.price_id', false);
				$review = I('post.review', false);
				$money = I('post.price', false);
				if (empty($price_id) || empty($review) || empty($money)) {
					$data['result'] = error(-1, '审批的参数不齐全');
					return $this->ajaxReturn($data);	
				}
				$ds['real_price'] = $money;
				$loginAcct = MyHelp::getLoginAccount(false);
				if (is_error($loginAcct) === false) {
					$ds['review_admin'] = my_json_encode(array('id'=>$loginAcct['id'], 'account'=>$loginAcct['account'], 'show_name'=>$loginAcct['show_name']));
				} else {
					$data['jumpUrl'] = UNLOGIN_URL;
					return $this->ajaxReturn($data);
				}
				$reviewKey = $review == 'pass' ? 'review_pass' : 'review_fail';
				$reviewType = BackReviewHelp::reviewTypeKey2Value($reviewKey, true);
				if (is_error($reviewType) === false) {
					$ds['review_type'] = my_json_encode(array('id'=>$reviewType['id'], 'type_key'=>$reviewType['type_key'], 'type_desc'=>$reviewType['type_desc']));					
					$data['review_type'] = $reviewType;
					$priceObj = ModelBase::getInstance('cj_price');
					$data['result'] = $priceObj->modify($ds, appendLogicExp('id', '=', $price_id));
				} else {
					$data['result'] = error(-1, '审核类型错误');
				}				
				return $this->ajaxReturn($data);
			}			
			$pageIndex = I('post.page', 0);
			$cdsstr = I('post.cdsstr', '');
			if (!empty($cdsstr)) {
				$cdList = explode('|', $cdsstr);
				for ($i = 0; $i < count($cdList); $i += 4) {
					if ($cdList[$i] == 'objstr') {
						$sourceType = array('insurance','leader','hotel','driver','bus','view','agency','source');
						foreach ($sourceType as $sk=>$sv) {
							$source = BackFinancialHelp::getSource(appendLogicExp('name', $cdList[$i+1], $cdList[$i+2]));
							if (!empty($source)) {
								$searchConds = appendLogicExp('obj_id', '=', $source['id'], $cdList[$i+3], $searchConds);
							}
						}
					} else if ($cdList[$i] == 'itemstr') {
						$item = BackFinancialHelp::getItem(appendLogicExp('name', $cdList[$i+1], $cdList[$i+2]));
						if (!empty($item)) {
							$searchConds = appendLogicExp('item_id', '=', $item['id'], $cdList[$i+3], $searchConds);
						}
					} else {
						$searchConds = appendLogicExp($cdList[$i], $cdList[$i+1], $cdList[$i+2], $cdList[$i+3], $searchConds);
					}
				}
			}
		} else {
			$pageIndex = I('get.page', 0);
		}
		
		$startIndex = $pageIndex * 20;
//		$conds = appendLogicExp('review_type', 'LIKE', '%reviewing%', 'AND', $conds);
		$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
		if (!empty($searchConds)) {
			$conds = appendLogicExp('search', '=', $searchConds, 'AND', $conds);
		}
		$data['conds'] = $conds;
		$prices = BackFinancialHelp::getPriceList($conds, $startIndex, 20, $total, array('review_type'=>'asc','id'=>'desc'),array('obj'=>true,'item'=>true), $out);
		$data['out'] = $out;
		
		$pageCount = intval($total / 20);
		if ($total % 20 > 0) {
			$pageCount += 1;
		}
		
		if (IS_POST) {
			$data['result'] = error(0, '');
			$data['ds'] = $prices;
			$data['page_count'] = $pageCount;
			$data['page_index'] = $pageIndex;
			$data['page_size'] = 20;
			$this->ajaxReturn($data);
		} else {
			$this->assign('prices', $prices);
			$this->assign('page_count', $pageCount);
			$this->assign('grant_review_price', check_grant('cj_price_review'));
			$this->showPage('price_review', 'financial_review_price', 'financial', '资源价审核');
		}
	}
 	
 	// 消费项费用处理
 	public function priceAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'list') {
				$this->listPrice();	
			} else if ($type == 'find') {
				$this->findPrice($_POST);	
			} else if ($type == 'save') {
				$this->savePrice($_POST);	
			} else if ($type == 'delete') {
				$this->deletePrice();	
			} else if ($type == 'review') {
				$this->reviewPrice();
			} else {
				$data['result'] = error(-1, '错误的操作方式');
				$this->ajaxReturn($data);
			}
		} else {
			$this->reviewPrice();
//			$this->showError('501', '访问错误', '访问接口错误，没有该接口', '错误的访问被拒绝');
		}
	}
	
	// 领队问题列表
	private function leaderQuestion() {
		$page = 0;
		if (IS_POST) {
			$page = I('post.page', 0);
			$leader_id = I('post.leader_id', 0);
			if (empty($leader_id)) {
				$data['result'] = error(-1, '错误的领队');
				return $this->ajaxReturn($data);
			}
		} else {
			$leader_id = I('get.id', false);
			if (empty($leader_id)) {
				$data['result'] = error(-1, '错误的领队');
				return $this->showError('501', '领队错误', '领队编号有误', '领队编号参数有误');
			}
		}
		
		$startIndex = $page * LEADER_QUESTION_SHOW_PAGE_COUNT;
		
		$qeustObj = ModelBase::getInstance('cj_leader_question');
		$conds = appendLogicExp('leader_id', '=', $leader_id);
		$conds = appendLogicExp('question_id', '=', 0, 'AND', $conds);
		$question = $qeustObj->getAll($conds, $startIndex, LEADER_QUESTION_SHOW_PAGE_COUNT, $total, array('create_time'=>'desc'));
		foreach ($question as $qk=>$qv) {			
			$answerConds = appendLogicExp('leader_id', '=', $leader_id);	
			$answerConds = appendLogicExp('question_id', '=', $qv['id'], 'AND', $answerConds);
			$account = BackAccountHelp::getAccount($qv['account_type_id'], $qv['account_id']);
			$qv['account_id_data'] = $account;
			$qv['account_id_show_name'] = $account['show_name'];			
			$answers = $qeustObj->getAll ($answerConds, 0, 0, $answerTotal, array('create_time'=>'desc'));
			foreach ($answers as $ak=>$av) {
				$account = BackAccountHelp::getAccount($qv['account_type_id'], $qv['account_id']);
				$av['account_id_data'] = $account;
				$av['account_id_show_name'] = $account['show_name'];
				$answers[$ak] = $av;
			}
			$qv['answers'] = $answers;
			$question[$qk] = $qv;
		}
		
		$pageCount = intval($total / LEADER_QUESTION_SHOW_PAGE_COUNT);
		if (intval($total % LEADER_QUESTION_SHOW_PAGE_COUNT) > 0) {
			$pageCount ++;
		}
		
		if (IS_POST) {
			$data['page_size'] = LEADER_QUESTION_SHOW_PAGE_COUNT;
			$data['page_count'] = $pageCount;
			$data['ds'] = $question;
			$this->ajaxReturn($data);
		} else {
			$this->assign('questions', $question);
			$this->assign('question_page_count', $pageCount);
			$this->assign('question_page_size', LEADER_QUESTION_SHOW_PAGE_COUNT);
		}
	}
	
	// 保存领队问题
	private function saveQuestion($aa) {
		if (check_grant('cj_source_append') === false && check_grant('cj_source_update') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		$admin = MyHelp::getLoginAccount(false);
		if (is_error($admin) === true) {
			$data['jumpUrl'] = U('Admin/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI'])));
			$data['result'] = error(-1, '管理员未登陆，请登录后再发消息');
			return $this->ajaxReturn($data);
		}
		
		$questionObj = ModelBase::getInstance('cj_leader_question');
		$colNames = $questionObj->getUserDefine(ModelBase::DF_COL_NAMES);			
		$ds = coll_elements_giveup($colNames, $aa);
		
		if (empty($aa['id'])) {
			$ds['content'] = htmlspecialchars($ds['content']);
			$ds['create_time'] = fmtNowDateTime();
			$ds['account_type_id'] = $admin['account_type']['id'];
			$ds['account_id'] = $admin['id'];
			
			
			$data['result'] = $questionObj->create($ds, $questionId);
			if (error_ok($data['result']) === true) {
				$ds['content'] = htmlspecialchars_decode($ds['content']);
				$ds['account_id_data'] = $admin;
				$ds['account_id_show_name'] = $admin['account'];
				$ds['answer_count'] = 0;
				$ds['id'] = $questionId;
				$data['ds'] = $ds;
			}
		} else {
			unset($ds['id']);
			$data['result'] = $questionObj->modify($ds, appendLogicExp('id', '=', $aa['id']));
		}
		return $this->ajaxReturn($data);
	}
	
	// 删除领队问题
	private function deleteQuestion() {
		if (check_grant('cj_source_delete') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		$questionId = I('post.id', false);
		if (empty($questionId)) {
			$data['result'] = error(-1, '参数不足，删除问题失败');
			return $this->ajaxReturn($data);
		}
		
		$questionObj = ModelBase::getInstance('cj_leader_question');
		$conds = appendLogicExp('id', '=', $questionId);
		$conds = appendLogicExp('question_id', '=', $questionId, 'OR', $conds);
		$data['result'] = $questionObj->remove($conds);
		$this->ajaxReturn($data);
	}
	
	// 添加作品
	private function leaderPicture() {
		$page = 0;
		if (IS_POST) {
			$page = I('post.page', 0);
			$leader_id = I('post.leader_id', 0);
			if (empty($leader_id)) {
				$data['result'] = error(-1, '错误的领队');
				return $this->ajaxReturn($data);
			}
		} else {
			$leader_id = I('get.id', false);
			if (empty($leader_id)) {
				$data['result'] = error(-1, '错误的领队');
				return $this->showError('501', '领队错误', '领队编号有误', '领队编号参数有误');
			}
		}
		
		$startIndex = $page * LEADER_PICTRUE_SHOW_PAGE_COUNT;
		
		$pictureObj = ModelBase::getInstance('cj_leader_picture');
		$conds = appendLogicExp('leader_id', '=', $leader_id);
		$conds = appendLogicExp('invalid', '!=', '1', 'AND', $conds);
		$pictures = $pictureObj->getAll($conds, $startIndex, LEADER_PICTRUE_SHOW_PAGE_COUNT, $total, array('create_time'=>'desc'));
		$data['sql'] = $pictureObj->getLastSql();
		
		$pageCount = intval($total / LEADER_PICTRUE_SHOW_PAGE_COUNT);
		if (intval($total % LEADER_PICTRUE_SHOW_PAGE_COUNT) > 0) {
			$pageCount ++;
		}
		
		if (IS_POST) {
			$data['page_size'] = LEADER_PICTRUE_SHOW_PAGE_COUNT;
			$data['page_count'] = $pageCount;
			$data['ds'] = $pictures;
			$this->ajaxReturn($data);
		} else {
			$this->assign('pictures', $pictures);
			$this->assign('picture_page_count', $pageCount);
			$this->assign('picture_page_size', LEADER_PICTRUE_SHOW_PAGE_COUNT);
		}
	}
	
	// 删除领队作品
	private function deletePicture() {
		if (check_grant('cj_source_delete') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		$pictureId = I('post.id', false);
		if (empty($pictureId)) {
			$data['result'] = error(-1, '参数不足，删除作品失败');
			return $this->ajaxReturn($data);
		}
		
		$pictureObj = ModelBase::getInstance('cj_leader_picture');
		$conds = appendLogicExp('id', '=', $pictureId);
//		$pic = $pictureObj->getOne($conds);		
//		$data['result'] = error(-1, '测试服务器图片删除');
//		$data['del_result'] = BackImageHelp::deleteFiles('2017-05-14_59181be4deaa7');
		$data['result'] = $pictureObj->modify(array('invalid'=>1), $conds);
		$this->ajaxReturn($data);
	}
	
	// 上传领队的本地图片
	private function localUploadImage() {
		if (check_grant('cj_source_append') === false && check_grant('cj_source_update') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		$leaderId = I('post.leader_id', '');
		$imageName = I('post.image_name', '');
		if (empty($leaderId) || empty($imageName)) {
			$data['result'] = error(-1, '领队编号或者保存的图片名称有误');
			return $this->ajaxReturn($data);
		}
		
		$savePath = C('TMPL_PARSE_STRING.__UPLOAD_REAL_PATH__');
		$data['save_path'] = $savePath;
		$info = BackImageHelp::localUploadFiles($savePath, 'leader', $imageName.'_'.$leaderId, true);
		if (is_error($info) == false) {
			$imageInfo = $info['input_file_xiuxiu'];
			$ds[$imageName] = C('TMPL_PARSE_STRING.{__GLOBAL_HOST_URL__}').C('TMPL_PARSE_STRING.__UPLOAD_URL__').'leader/'.$imageInfo['savename'];
			$leaderObj = ModelBase::getInstance('cj_leader');
			$colName = $leaderObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$ds = coll_elements_giveup($colName, $ds);
			if (empty($ds)) {
				$data['result'] = error(-1, '要保存的图片名称有误');
				return $this->ajaxReturn($data);
			}
			$result = $leaderObj->modify($ds, appendLogicExp('id', '=', $leaderId));
			if ($result['errno'] == 0 || $result['errno'] == -4) {
	 			$ds['image_name'] = $imageName;
				$ds['image_url'] = $ds[$imageName];
				$data['ds'] = $ds;	
			} else {
				$data['result'] = $result;
			}
		} else {
			$data['result'] = $info;
		}
		$this->ajaxReturn($data);	
	}
	
	// 领队资源其他内容
	public function leaderAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'list_question') {
				$this->leaderQuestion();
			} else if ($type == 'save_question') {
				$this->saveQuestion($_POST);
			} else if ($type == 'delete_question') {
				$this->deleteQuestion();
			} else if ($type == 'list_picture') {
				$this->leaderPicture();
			} else if ($type == 'delete_picture') {
				$this->deletePicture();
			} else if ($type == 'local_upload_image') {
				$this->localUploadImage();
			} else {
				$data['post'] = $_POST;
				$data['result'] = error(-1, '无效的操作类型');
				$this->ajaxReturn($data);
			}
			
		} else {
			$id = I('get.id', false);
			if (empty($id)) {
				return $this->showError('404', '领队有误', '您所查看的领队详细信息有误', '领队不存在或者领队信息有误');
			}
			
			$leaderObj = ModelBase::getInstance('cj_leader');
			$leader = $leaderObj->getOne(appendLogicExp('id', '=', $id));
			$this->assign('leader', $leader);
			
			// 领队问答
			$this->leaderQuestion();			
			// 领队作品
			$this->leaderPicture();
			
			$this->assign('modal_type_data', true);	
			$this->assign('modal_xiuxiu', true);
			$this->assign('modal_leader_upload_image', true);			
			$this->showPage('leader_info', 'financial_resource_leader', 'financial_resource', '领队详情');
		}
	}
	
	// 团期列表
	private function listTeam() {
		if (IS_POST) {
			$page = I('post.page', 0);
			$cdsstr = I('post.cdsstr', '');
			$cdstype = I('post.cdstype', 0);
			
			if (!empty($cdsstr) && $cdstype > 2 && $cdstype < 6) {
				$findConds = MyHelp::getCondsByStr($cdsstr, $cdstype);	
			}
		} else {
			$page = I('get.page', 0);
		}
		
		$startIndex = $page * TEAM_SHOW_PAGE_COUNT;
		
		$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
		if (!empty($findConds)) {
			$conds = appendLogicExp('search', '=', $findConds, 'AND', $conds);
		}
		$result = BackFinancialHelp::getTeamList($conds, $startIndex,TEAM_SHOW_PAGE_COUNT,array('id'=>'desc', 'create_time'=>'desc'));
		$teams = BackFinancialHelp::fillTeam($result['ds'], false);
		
		if (IS_POST) {
			$data['conds'] = $conds;
			$data['total_count'] = $result['total_count'];
			$data['ds'] = $teams;
			$data['page_count'] = $result['page_count'];
			$data['page_size'] = $result['page_size'];
			$this->ajaxReturn($data);
		} else {			
			$this->assign('page_count', $result['page_count']);
			$this->assign('page_size', $result['page_size']);
			$this->assign('teams', $teams);			
			$this->showPage('team_list', 'financial_team_list', 'financial_team', '团期管理', '团期列表', '这里您查看所有团期');	
		}
	}
	
	// 团期创建
	private function saveTeam($aa) {
		if (IS_POST) {
			if (check_grant('cj_team_edit') === false) {
				$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
				return $this->ajaxReturn($data);
			}
			if (empty($aa['line']) || $aa['line'] == '{}' || empty($aa['batch']) || $aa['batch'] == '{}') {
				$data['result'] = error(-1, '创建团期的参数不足，请选择产品与批次后再创建');
				return $this->ajaxReturn($data);
			}
			
			$force = I('post.force', false);
			$teamObj = ModelBase::getInstance('cj_team');
			$colName = $teamObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$ds = coll_elements_giveup($colName, $aa);
			
			if (empty($ds['id'])) {				
				$line = json_decode($aa['line'], true);
				if (empty($ds['is_team'])) {
					$batch = json_decode($aa['batch'], true);
					$codeBase = $line['title'].date('Ymd', strtotime($batch['start_time']));	
				} else {
					if (!empty($line['meet_time'])) {
						$codeBase = '[包团]'.$line['title'].date('Ymd', strtotime($line['meet_time']));	
					} else{
						$codeBase = '[包团]'.$line['title'];
					}
				}
				
				$carOrder = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
				foreach ($carOrder as $k=>$v) {
					$ds['team_code'] = $codeBase.$v;
					$count = $teamObj->getCount(appendLogicExp('team_code', '=', $ds['team_code']));
					if (empty($count)) {
						if ($k != 0 && empty($force)) {
							$data['result'] = error(1, '该产品已经存在团期了，是否仍要新创建一个团期');
							return $this->ajaxReturn($data);
						}
						break;
					} else {
						if ($k == (count($carOrder) - 1)) {
							$data['result'] = error(-1, '该产品的本批次车次已经用尽');
							return $this->ajaxReturn($data);
						}
					}
				}
				$ds['create_time'] = fmtNowDateTime();
				$data['result'] = $teamObj->create($ds, $teamId);
				if (error_ok($data['result'])) {
					$ds['id'] = $teamId;
					$data['ds']	= $ds;
				}
			} else {
				unset($ds['id']);
				$data['result'] = $teamObj->modify($ds, appendLogicExp('id', '=', $aa['id']));
			}
			$this->ajaxReturn($data);
		} else {					
			$id = I('get.id', false);
			if (!empty($id)) {
				$team = BackFinancialHelp::getTeam(appendLogicExp('id', '=', $id));
				$team = BackFinancialHelp::fillTeam($team, true);
				
				$this->assign('team', $team);
			}
			// 可动态添加类型数据
			$this->assign('modal_type_data', true);
			// 可动态添加消费项
			$this->assign('modal_fcj_item', true);
			// 可动态添加价格项
			$this->assign('modal_fcj_price', true);
			// 资金审批提交浮动框
			$this->assign('modal_fcj_deposit', true);
			// 响应审核财务计调权限
			$this->assign('grant_response_review', check_grant('response_finance_review'));
			
			$this->showPage('team_new', 'financial_team_new', 'financial_team', '团期管理', '团期编辑', '这里您可以编辑、管理您的团期内容');		
		}
	}
	
	// 锁定订单
	private function lockOrder() {
		if (check_grant('response_finance_review') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$colNames = $orderObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$cds = coll_elements_giveup($colNames, $_POST);
		if (empty($cds)) {
			$data['result'] = error(-1, '条件不足以锁定订单');
			return $this->ajaxReturn($data);
		}
		
		$conds = MyHelp::getLogicExp($cds, '=', 'AND');
		$data['result'] = $orderObj->modify(array('locked'=>'1'), $conds);
		if (error_ok($data['result'])) {
			$data['result'] = error(0, '锁定订单成功');
		}
		$this->ajaxReturn($data);
	}
	
	// 编辑参团人
	private function editMember() {
		if (check_grant('cj_team_edit') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		$bAdd = I('post.op', 'add') == 'add' ? true : false;
		$teamId = I('post.team_id', 0);
		$memberId = I('post.member_id', 0);
		$orderId = I('post.order_id', 0);
		if ($bAdd === true) {
			if (empty($teamId) || (empty($memberId) && empty($orderId))) {
				$data['result'] = error(-1, '添加参团人参数不足');	
				return $this->ajaxReturn($data);
			}
		} else {
			if (empty($teamId) && empty($memberId)) {
				$data['result'] = error(-1, '移除参团人参数不足');	
			}
		}	
		
		if (!empty($memberId)) {
			$conds = appendLogicExp('id', '=', $memberId);
		}
		if (!empty($orderId)) {
			$conds = appendLogicExp('order_id', '=', $orderId);
		}
		if ($bAdd === false && !empty($teamId)) {
			$conds = appendLogicExp('team_id', '=', $teamId);
		}
		
		if (empty($conds)) {
			$data['result'] = error(-1, '操作条件有误');
			return $this->ajaxReturn($data);
		}
		// 排除退团的人员
		$includeExit = I('post.include_exit', 0);
		if ($bAdd === true && $includeExit == 0) {
			$conds = appendLogicExp('exit', '=', '0', 'AND', $conds);	
		}
		$data['conds'] = $conds;
		
		// 开始处理
		$members = BackOrderHelp::getOrderMembers($conds);
		if (empty($members)) {
			$data['result'] = error(-1, '参团人错误，未能找到参团人信息');
			return $this->ajaxReturn($data);
		}
		foreach ($members as $mk=>$mv) {
			// 记录涉及到的订单编号
			$orderIdMap[$mv['order_id']] = $mv;
			// 获取团期编号
			if (empty($teamId)) {
				$teamId = $mv['team_id'];
			}
			
			// 获取有效无效的参团人
			$exit = $includeExit == 0 ? !empty($mv['exit']) : false;
			$existTeam = !empty($mv['team_id']) && $teamId != $mv['team_id']; // 存在团期，并且团期为非当前要绑定的团期
			
			if (($bAdd === true && ($existTeam || $exit)) || ($bAdd === false && $existTeam)) {
				if (!empty($invalidName)) {
					$invalidName .= ',';
				}
				$invalidName .= $mv['name'];	
			} else {
				if (!empty($validName)) {
					$validName .= ',';
				}
				$validName .= $mv['name'];	
			}
		}
		if (!empty($invalidName)) {
			if ($bAdd === true) {
				$data['result'] = error(-1, '参团人'.$invalidName.'已经参与了其他团期或者已经退团');	
			} else {				
				$data['result'] = error(-1, '参团人'.$invalidName.'已经不在该团期内');
			}
			return $this->ajaxReturn($data);
		}
		
		$memberObj = ModelBase::getInstance('signup_member');
		
		// 判断人数是否超出范围
		if ($bAdd === true) {
			$memberCount = $memberObj->getCount(appendLogicExp('team_id', '=', $teamId));
			$newMemberCount = intval($memberCount) + count($members);
			
			$team = BackFinancialHelp::getTeam(appendLogicExp('id', '=', $teamId));
			$data['new'] = $newMemberCount;
			$data['team'] = $team['max_member'];
			if ($newMemberCount > intval($team['max_member'])) {
				$data['result'] = error(-1, '参团人超出团期最大容纳人数,请核对后再添加');
				return $this->ajaxReturn($data);
			}
		}
		
		
		$ds['team_id'] = $bAdd === true ? $teamId : '0';
		$data['result'] = $memberObj->modify($ds, $conds);
		if (error_ok($data['result']) === true) {
			if ($bAdd === true) {
				$data['result'] = error(0, '添加参团人['.$validName.']到团期成功');	
			} else {				
				$data['result'] = error(0, '从团期移除参团人['.$validName.']成功');
			}
			
			// 处理涉及到的订单
			$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
			foreach ($orderIdMap as $orderId=>$ov) {
				$conds = appendLogicExp('order_id', '=', $orderId);
				$conds = appendLogicExp('team_id', '!=', 0, 'AND', $conds);
				$memberCount = $memberObj->getCount($conds);
				$orderTeamId = empty($memberCount) ? 0 : ($bAdd === true ? $teamId : $ov['team_id']);
				$data['order_'.$orderId.'_result'] = $orderObj->modify(array('team_id'=>$orderTeamId), appendLogicExp('id', '=', $orderId));
				$refresh_order_money = error_ok($data['order_'.$orderId.'_result']) === false ? 0 : 1;
			}
			// 重新计算订单总价
			if (!empty($refresh_order_money)) {
				$data['order_money'] = BackFinancialHelp::getTeamOrderMoney($teamId);
			}
		}		
		return $this->ajaxReturn($data);
	}
	
	// 编辑资源
	public function editSource($aa) {
		$op = I('post.op', '');
		if ($op !== 'find' && check_grant('cj_team_edit') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		$sourceObj = ModelBase::getInstance('cj_team_source');
		$colNames = $sourceObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNames, $aa);
		
		if ($op === 'remove') {
			$data['op'] = 'remove';
			$conds = MyHelp::getLogicExp($ds, '=', 'AND');
			$sourceType = I('post.source', false);
			if (!empty($sourceType)) {
				if (stripos($sourceType, 'agency') !== FALSE){
					$agencyType = explode('_', $sourceType);
					$conds = appendLogicExp('obj_type', 'LIKE', '%agency%', 'AND', $conds);
					$sources = BackFinancialHelp::getTeamSourceList($conds, 0, 0, array('id'=>'asc'), false);
					foreach ($sources as $sk=>$sv) {
						if (stripos($sv['obj_data']['agency_type'], $agencyType) !== FALSE) {
							$sourceAgencyIds = empty($sourceAgencyIds) ? $sv['id'] : ','.$sv['id'];
						}
					}
					if (!empty($sourceAgencyIds)) {
						$conds = appendLogicExp('id', 'IN', '('.$sourceAgencyIds.')', 'AND', $conds);
					}
				} else {
					$conds = appendLogicExp('obj_type', 'LIKE', '%'.$sourceType.'%', 'AND', $conds);
				}
			}
			if (empty($conds)) {
				$data['result'] = error(-1, '删除资源的条件不足');
			} else {
				// 存在审核,不能删除
				$sources = $sourceObj->getAll($conds);
				foreach ($source as $sk=>$sv) {
					if (empty($sv['review_id'])) {
						$existReview = true;
						break;
					}
				}
				if (empty($existReview)) {
					$data['result'] = $sourceObj->remove($conds);	
				} else {
					$data['result'] = error(-1, '此次删除的内容包含已提交资金审批的资源预算');
				}
			}
		} else if ($op == 'find') {
			$data['op'] = 'find';
			$conds = MyHelp::getLogicExp($ds, '=', 'AND');
			$cdsstr = I('post.cdsstr', false);
			$cdtype = I('post.cdtype', false);
			if (!empty($cdsstr) && !empty($cdtype)) {
				$conds = MyHelp::getCondsByStr($cdsstr, $cdtype);
			}
			if (empty($conds)) {
				$data['result'] = error(-1, '获取资源的条件不足');
			} else {
				$findAll = I('post.find_all', false);
				if (empty($findAll)) {
					$data['ds'] = BackFinancialHelp::getTeamSource($conds, true);	
				} else {
					$page = I('post.page', 0);
					$pageSize = I('post.page_zie', 0);
					$pageIndex = $page * $pageSize;
					$result = BackFinancialHelp::getTeamSourceList($conds, $pageIndex, $pageSize, array('id'=>'asc'), true);	
					$sumMoney = 0.00;
					foreach ($result['ds'] as $dk=>$dv) {
						$sumMoney = bcadd($sumMoney, floatval($dv['money']), 2);
					}
					$data['ds'] = $result['ds'];
					$data['sum_money'] = $sumMoney;
					session_start();
					session('back_financial_deposit_submit_findall', $data);
				}
			}
		} else {
			if (empty($ds['id'])) {
				$data['op'] = 'create';
				if (empty($ds['team_id']) || empty($ds['obj_type']) || empty($ds['obj_id']) || empty($ds['item_id']) || empty($ds['price_id']) || empty($ds['num'])) {
					$data['result'] = error(-1, '添加的团期资源数据不齐全');
				} else {
					$data['result'] = $sourceObj->create($ds, $bindId);
					if (error_ok($data['result']) === true) {
						$ds['id'] = $bindId;
						$data['ds'] = BackFinancialHelp::getTeamSource(appendLogicExp('id', '=', $bindId), true);
					}
				}
			} else {			
				unset($ds['id']);
				$data['op'] = 'save';
				if (empty($ds) || empty($aa['id'])) {
					$data['result'] = error(-1, '更新条件不足或者数据不齐全');
				} else {
					// 存在审核,不能删除
					$conds = appendLogicExp('id', '=', $aa['id']);
					$source = BackFinancialHelp::getTeamSource($conds, array('review'=>true));
					foreach ($source as $sk=>$sv) {
						if (empty($sv['review_id'])) {
							$existReview = true;
							break;
						}
					}
					
					// 未审核与可重新提交情况下可以编辑
					if (empty($source['review_id']) || $source['allow_review'] == 1) {
						$data['result'] = $sourceObj->modify($ds, $conds);
						if (error_ok($data['result']) === true) {
							$data['ds'] = BackFinancialHelp::getTeamSource($conds, true);
						}	
					} else {
						$data['result'] = error(-1, '此资源预算的审批状态不允许编辑');
					}
				}
			}
		}
		if (error_ok($data['result']) === false) {
			if ($data['op'] === 'remove') {
				$data['result'] = error(-1, '移除团期资源失败, Error:'.a_2_s($data['result']));
			} else if ($data['op'] === 'create') {
				$data['result'] = error(-1, '添加团期资源失败, Error:'.a_2_s($data['result']));
			} else if ($data['op'] === 'save') {
				$data['result'] = error(-1, '更新团期资源失败, Error:'.a_2_s($data['result']));
			}
		}
		$this->ajaxReturn($data);
	}
	
	// 资源请款
	private function requestMoney() {
		if (check_grant('cj_deposit_submit') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		$depositId = I('post.review_id', false);
		$sourceIds = I('post.ids', false);
		if (empty($depositId) && empty($sourceIds)) {
			$data['result'] = error(-1, '错误的资源预算资金请款，请款参数不足');
			return $this->ajaxReturn($data);
		}
		
		// 获取审批内容
		$depositObj = ModelBase::getInstance('cj_deposit');	
		$colNames = $depositObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNames, $_POST);	
		$sourceObj = ModelBase::getInstance('cj_team_source');
		
		// 获取提审管理员信息
		$loginAcct = MyHelp::getLoginAccount(false);
		if (is_error($loginAcct) === false) {
			$requestAdmin = array('id'=>$loginAcct['id'], 'account'=>$loginAcct['account'], 'show_name'=>$loginAcct['show_name']);
			$acctJsonData = my_json_encode($requestAdmin);
			if (empty($depositId)) {
				$ds['request_admin'] = my_json_encode($requestAdmin);
				$ds['request_time'] = fmtNowDateTime();
			}
			$reviewType = BackReviewHelp::reviewTypeKey2Value('reviewing', true);
			$ds['review_type'] = my_json_encode($reviewType);
		} else {
			$data['jumpUrl'] = UNLOGIN_URL;
			$data['result'] = error(-1, '您未登录，请登录后再进行操作');
			return $this->ajaxReturn($data);
		}
				
		if (empty($depositId)) {
			$data['op'] = 'create';
			if (empty($sourceIds) || empty($ds['team_id']) || empty($ds['payee'])) {
				$data['result'] = error(-1, '添加的团期预交金数据不齐全');
				return $this->ajaxReturn($data);
			}
			
			if (empty($ds['money'])) {
				session_start();
				$depositSource = session('back_financial_deposit_submit_findall');
				if (empty($depositSource)) {
					$conds = appendLogicExp('id', 'IN', '('.$sourceIds.')');
					$result = BackFinancialHelp::getTeamSourceList($conds, $pageIndex, $pageSize, array('id'=>'asc'), true);	
					$sumMoney = 0.00;
					foreach ($result['ds'] as $dk=>$dv) {
						$sumMoney = bcadd($sumMoney, floatval($dv['money']), 2);
					}
					$ds['money'] = $sumMoney['sum_money'];	
				} else {
					$ds['money'] = $depositSource['sum_money'];	
				}
			}
			
			// 审批来源为资源类型
			$depositObject = MyHelp::TypeDataKey2Value('cj_deposit_obj_source', true);
			$ds['deposit_obj'] = my_json_encode($depositObject);
			
			// 资金方式为支付
			$depositType = MyHelp::TypeDataKey2Value('cj_deposit_type_pay', true);
			$ds['deposit_type'] = my_json_encode($depositType);
							
			$data['result'] = $depositObj->create($ds, $depositId);
			if (error_ok($data['result']) === true) {
				// 记录提交资金审批的情况
				$finnalMoney = bcsub($ds['money'], $ds['derate'], 2);
				$superviseContent = '编号为['.$sourceIds.']资源预算提审到资金审批，审批编号为【'.$depositId.'】，预算金额【'.$ds['money'].'】元,减免金额【'.$ds['derate'].'】元,提审金额【'.$ds['approval_amount'].'】元,已交易金额【0.00】元,最终预算【'.$finnalMoney.'】元，总金额为【'.$ds['money'].'】元,备注:'.$ds['beizhu'];
				$data['supervise_result'] = MyHelp::appendSupervise('supervise_type_cj_team', $depositId, $ds['team_id'], $acctJsonData, $superviseContent);
				$ds['id'] = $depositId;
				
				// 修改与资金审批绑定的资源对象
				$conds = appendLogicExp('id', 'IN', '('.$sourceIds.')');
				$sourceObj->modify(array('review_id'=>$depositId), $conds);
				
				// 获取最新的资金审批数据
				$conds = appendLogicExp('id', '=', $depositId);
				$data['ds'] = BackFinancialHelp::getTeamDeposit($conds, false);
			}
		} else {
			session_start();
			$depositSource = session('back_financial_deposit_submit_findall');
			if (empty($depositSource)) {
				$conds = appendLogicExp('review_id', '=', $depositId);
				$result = BackFinancialHelp::getTeamSourceList($conds, 0, $pageSi0ze, array('id'=>'asc'), true);	
				$sumMoney = 0.00;
				foreach ($result['ds'] as $dk=>$dv) {
					$sumMoney = bcadd($sumMoney, floatval($dv['money']), 2);
				}
				$ds['money'] = $sumMoney['sum_money'];	
			} else {
				$ds['money'] = $depositSource['sum_money'];	
			}		
						
			$conds = appendLogicExp('id', '=', $depositId);
			$deposit = BackFinancialHelp::getTeamDeposit($conds);
			$reviewType = $deposit['review_type_data']['type_key'];
			
			// 计算可请款金额
			$canRequestMoney = true;
			$requestMoney = bcsub($ds['money'], bcadd($ds['complated_money'], $ds['derate'], 2), 2);
			if ($reviewType == 'review_confirm' &&  abs($requestMoney)  < 0.001) {
				$canRequestMoney = false;
			}
			
			// 判断是否可请款
			if ($reviewType != 'reviewing' && $reviewType != 'review_fail' && $canRequestMoney != true) {
				$data['result'] = error(-1, '团期预算资金审批内容已经被接受并处于【'.$deposit['review_type_data']['type_desc'].'】状态，不能修改');
				return $this->ajaxReturn($data);
			}
			
			$depositAdmin = $deposit['request_admin_data'];
			if ($loginAcct['id'] != $depositAdmin['id']) {
//				$data['login_acct'] = $loginAcct;
//				$data['request_admin'] = $depositAdmin;
				$data['result'] = error(-1, '您并非该条信息的提审人，无权修改，如有需要请联系提审人【'.$depositAdmin['account'].'】');
				return $this->ajaxReturn($data);
			}
			
			$data['result'] = $depositObj->modify($ds, appendLogicExp('id', '=', $depositId));
			if (error_ok($data['result']) === true) {
				// 记录提交资金审批的情况
				foreach ($ds as $dk=>$dv) {
					if ($dk == 'review_type') {
						$src = $dk.':'.$deposit['review_type_data']['type_desc'].',';
						$newReviewType = json_decode($dv, true);
						$new = $dk.':'.$newReviewType['type_desc'].',';	
					} else {
						$src = $dk.':'.$deposit[$dk].',';
						$new = $dk.':'.$dv.',';	
					}
				}
				$superviseContent = '资金审批编号为【'.$depositId.'】资源预算资金审批被修改，修改前内容:'.$src.',修改后:'.$new;
				$data['supervise_result'] = MyHelp::appendSupervise('supervise_type_cj_team', $depositId, $ds['team_id'], $acctJsonData, $superviseContent);
				
				// 获取最新的资金审批数据
				$conds = appendLogicExp('id', '=', $depositId);
				$data['ds'] = BackFinancialHelp::getTeamDeposit($conds, true);
			}
		}
		$this->ajaxReturn($data);
	}
	
	// 回收资源
	private function recycleSource() {
		$bindId = I('id', 0);
		$recycleCount = I('count', 0);
		if (empty($bindId) || empty($recycleCount)) {
			$data['result'] = error(-1, '回收参数有问题，不能回收');
			$this->ajaxReturn($data);
		}
		
		$ds['recycle'] = $recycleCount;
		$sourceObj = ModelBase::getInstance('cj_team_source');
		$data['result'] = $sourceObj->modify($ds, appendLogicExp('id', '=', $bindId));
		$this->ajaxReturn($data);
	}
	
	// 刷新团期预算
	public function refreshTeamMoney(){		
		$teamId = I('post.team_id', false);
		if (empty($teamId)) {
			$data['result'] = error(-1, '刷新团期预算参数错误');
			$this->ajaxReturn($data);
		}
		
		$team = BackFinancialHelp::getTeam(appendLogicExp('id', '=', $teamId));
		if (empty($team)) {
			$data['result'] = error(-1, '未能找到团期的资源预算与资金审批');
		} else {
			$team = BackFinancialHelp::fillTeam($team, array('source'=>true, 'order_money'=>true, 'deposit'=>true));
			$data['team'] = $team;
			$data['result'] = error(0, '');	
		}
		return $this->ajaxReturn($data);
	}
	
	// 刷新团期余额
	public function refreshTeamBalance(){
		$teamId = I('post.team_id', false);
		if (empty($teamId)) {
			$data['result'] = error(-1, '刷新团期余额参数错误');
			$this->ajaxReturn($data);
		}
		
		$team = BackFinancialHelp::getTeam(appendLogicExp('id', '=', $teamId));
		$data['ds'] = $team;
		$data['result'] = error(0, '刷新余额成功');
		return $this->ajaxReturn($data);
	}
	
	// 编辑预交金审核
	public function editDeposit($aa) {
		$op = I('post.op', '');
		if ($op != 'find' && check_grant('cj_deposit_submit') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		$depositObj = ModelBase::getInstance('cj_deposit');
		$colNames = $depositObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNames, $aa);		
		if ($op === 'remove') {
			$data['op'] = 'remove';
			$conds = MyHelp::getLogicExp($ds, '=', 'AND');
			if (empty($conds)) {
				$data['result'] = error(-1, '删除团期预交金的条件不足');
			} else {
				$deposit = BackFinancialHelp::getTeamDeposit($conds);
				if ($deposit['review_type_data']['type_key'] != 'reviewing') {
					$data['result'] = error(-1, '团期预交金已经被接受并处于【'.$deposit['review_type_data']['type_desc'].'】状态，不能删除');
				} else {
					$data['result'] = $depositObj->remove($conds);		
				}
			}
		} else if ($op == 'find') {
			$data['op'] = 'find';
			$conds = MyHelp::getLogicExp($ds, '=', 'AND');
			if (empty($conds)) {
				$data['result'] = error(-1, '获取团期预交金的条件不足');
			} else {
				$data['ds'] = BackFinancialHelp::getTeamDeposit($conds, true);	
			}
		} else {
			if (empty($ds['id'])) {
				$data['op'] = 'create';
//				if (empty($ds['team_id']) || empty($ds['deposit_obj']) || empty($ds['deposit_type']) || empty($ds['payee']) || empty($ds['bank_card']) || empty($ds['money'])) {
				if (empty($ds['team_id']) || empty($ds['payee']) || empty($ds['bank_card']) || empty($ds['money'])) {
					$data['result'] = error(-1, '添加的团期预交金数据不齐全');
					return $this->ajaxReturn($data);
				} else {
					$depositTypeKey = I('post.deposit_type', false);
					if (empty($depositTypeKey)) {
						$data['result'] = error(-1, '团期预交金申请数据不齐全');
						return $this->ajaxReturn($data);
					}
					
					$loginAcct = MyHelp::getLoginAccount(false);
					if (is_error($loginAcct) === false) {
						$requestAdmin = array('id'=>$loginAcct['id'], 'account'=>$loginAcct['account'], 'show_name'=>$loginAcct['show_name']);
						$acctJsonData = my_json_encode($requestAdmin);
						
						$depositObject = MyHelp::TypeDataKey2Value('cj_deposit_obj_source', true);
						$ds['deposit_obj'] = my_json_encode($depositObject);
						
						// 资金方式为回收
						$depositType = MyHelp::TypeDataKey2Value('cj_deposit_type_'.$depositTypeKey, true);
						if (is_error($depositType) === true) {
							$data['result'] = error(-1, '提审资金操作方式类型有误');
							return $this->ajaxReturn($data);
						}
						unset($depositType['data_type_id']);
						unset($depositType['sort']);
						unset($depositType['can_delete']);
						$ds['deposit_type'] = my_json_encode($depositType);
						
						// 同行返利
						if ($depositTypeKey == 'rebate') {
							$sourceObjType = MyHelp::TypeDataKey2Value('cj_source_obj_agency', true);
							unset($sourceObjType['data_type_id']);
							unset($sourceObjType['sort']);
							unset($sourceObjType['can_delete']);
							$ds['obj_type'] = my_json_encode($sourceObjType);
						}
						
						$ds['request_admin'] = $acctJsonData;
						$reviewType = BackReviewHelp::reviewTypeKey2Value('reviewing', true);
						$ds['review_type'] = my_json_encode($reviewType);
						$ds['request_time'] = fmtNowDateTime();
						
						$data['result'] = $depositObj->create($ds, $depositId);
						if (error_ok($data['result']) === true) {
							// 记录提交资金审批的情况
							$finnalMoney = bcsub($ds['money'], $ds['derate'], 2);
							$superviseContent = '审批编号为【'.$depositId.'】的【'.$depositType['type_desc'].'】被提交审批，提审金额【'.$ds['approval_amount'].'】元,备注:'.$ds['beizhu'];
							$data['supervise_result'] = MyHelp::appendSupervise('supervise_type_cj_team', $depositId, $ds['team_id'], $acctJsonData, $superviseContent);
							$ds['id'] = $depositId;
							$data['ds'] = BackFinancialHelp::getTeamDeposit(appendLogicExp('id', '=', $depositId), true);
						}
					} else {
						$data['jumpUrl'] = UNLOGIN_URL;
						$data['result'] = error(-1, '您未登录，请登录后再进行操作');
					}
				}
			} else {			
				unset($ds['id']);
				$data['op'] = 'save';
				if (empty($ds) || empty($aa['id'])) {
					$data['result'] = error(-1, '更新条件不足或者数据不齐全');
				} else {
					$loginAcct = MyHelp::getLoginAccount(false);
					if (is_error($loginAcct) === false) {						
						$deposit = BackFinancialHelp::getTeamDeposit($conds);
						if ($loginAcct['id'] == $deposit['request_admin_data']['id']) {
							if ($deposit['review_type_data']['type_key'] != 'reviewing') {
								$data['result'] = error(-1, '团期预交金已经被接受并处于【'.$deposit['review_type_data']['type_desc'].'】状态，不能修改');
							} else {
								$data['result'] = $depositObj->modify($ds, appendLogicExp('id', '=', $aa['id']));
								if (error_ok($data['result']) === true) {
									$data['ds'] = BackFinancialHelp::getTeamDeposit(appendLogicExp('id', '=', $aa['id']), true);
								}
							}
						} else {
							$data['login_acct'] = $loginAcct;
							$data['request_admin'] = $deposit['request_admin_data'];
							$data['result'] = error(-1, '您并非该条信息的提审人，无权修改，如有需要请联系提审人【'.$deposit['request_admin_data']['account'].'】');
						}
					} else {
						$data['jumpUrl'] = UNLOGIN_URL;
						$data['result'] = error(-1, '您未登录，请登录后再进行操作');
					}
				}
			}
		}
		if (error_ok($data['result']) === false) {
			if ($data['op'] === 'remove') {
				$data['result'] = error(-1, '移除团期预交金失败, Error:'.a_2_s($data['result']));
			} else if ($data['op'] === 'create') {
				$data['result'] = error(-1, '添加团期预交金失败, Error:'.a_2_s($data['result']));
			} else if ($data['op'] === 'save') {
				$data['result'] = error(-1, '更新团期预交金失败, Error:'.a_2_s($data['result']));
			}
		}
		$this->ajaxReturn($data);
	}
	
	// 导出保单
	private function exportInsurance() {
		$id = I('get.id', '');
//		if (!empty($id)) {
//			$team = BackFinancialHelp::getTeam(appendLogicExp('id', '=', $id));
//			if (!empty($team)) {
//				$find = array('member'=>true);
//				$team = BackFinancialHelp::fillTeam($team, $find);
////				BackFinancialHelp::getSource('insurance', appendLogicExp('id', '=', $team['obj_id']))
//			}
//		}
//		if (!empty($team)) {	
//			BackFinancialHelp::writePolicy('team', $worksheets);
//		} else {
			echo ('<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><script type="text/javascript">alert("数据为空，导出失败");</script><head></html>');
//		}
	}
	
	// 导出派团单
	private function exportTeam() {
		$id = I('get.id', '');
		if (!empty($id)) {
			$team = BackFinancialHelp::getTeam(appendLogicExp('id', '=', $id));
			if (!empty($team)) {
				$find = array('source'=>true);
				$team = BackFinancialHelp::fillTeam($team, $find);
				
				$teamData[0][0] = '团期编号';
				$teamData[0][1] = '团期编码';
				$teamData[0][2] = '团期线路';
				$teamData[0][3] = '团期批次';
				$teamData[0][4] = '容纳人数';
				$teamData[0][5] = '负责领队';
				$teamData[0][6] = '负责计调';
				$teamData[0][7] = '负责地接';
				$teamData[0][8] = '团期余额';
				$teamData[0][9] = '建团时间';
				$teamData[0][10] = '建团备注';
				
				$teamData[1][0] = $team['id'];
				$teamData[1][1] = $team['team_code'];
				$teamData[1][2] = $team['line_data']['title'];
				$teamData[1][3] = $team['batch_show_text'];
				$teamData[1][4] = $team['max_member'];
				$teamData[1][5] = $team['leader_show_text'];
				$teamData[1][6] = $team['admin_show_text'];
				$teamData[1][7] = $team['dijie_data']['name'];
				$teamData[1][8] = $team['balance'];
				$teamData[1][9] = $team['create_time'];
				$teamData[1][10] = $team['beizhu'];
				
				$worksheets[0]['title'] = '团期信息';
				$worksheets[0]['data']	= $teamData;
				
				$sourceData[0][0] = '资源编号';
				$sourceData[0][1] = '资源类型';
				$sourceData[0][2] = '资源名称';
				$sourceData[0][3] = '消费项';
				$sourceData[0][4] = '消费数量';
				$sourceData[0][5] = '消费价格';
				$sourceData[0][6] = '总价格';
				$sourceData[0][7] = '回收状态';
				foreach ($team['sources'] as $sk=>$sv) {
					$sourceData[$sk+1][0] = $sv['obj_id'];
					$sourceData[$sk+1][1] = $sv['obj_type_data']['type_desc'];
					$sourceData[$sk+1][2] = $sv['obj_data']['show_name'];
					$sourceData[$sk+1][3] = $sv['item_data']['name'];
					$sourceData[$sk+1][4] = $sv['num'];
					$sourceData[$sk+1][5] = $sv['price_data']['show_name'];
					$sourceData[$sk+1][6] = $sv['money'];
					if (empty($sv['item_data']['is_recycle'])) {
						$sourceData[$sk+1][7] = '不可回收资源';	
					} else {
						$sourceData[$sk+1][7] = $sv['recycle'];	
					}
				}				
				$worksheets[1]['title'] = '资源列表';
				$worksheets[1]['data']	= $sourceData;
			}
		}
//		p_a($worksheets);
		if (!empty($worksheets)) {	
//			$this->assign('out', $out);	
//			$this->display('Index/test');
			MyHelp::exportExcel('team', $worksheets);
		} else {
			echo ('<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><script type="text/javascript">alert("数据为空，导出失败");</script><head></html>');
//			echo ($_SERVER['REQUEST_URI']);
//			$this->redirect($_SERVER['REQUEST_URI'], 5, '5秒后页面将进行跳转');
//			redirect($_SERVER['REQUEST_URI']);
		}
	}
	
	// 团期处理
	public function teamAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'list') {
				$this->listTeam();
			} else if ($type == 'save') {
				$this->saveTeam($_POST);
			} else if ($type == 'lock_order') {
				$this->lockOrder();
			} else if ($type == 'member') {
				$this->editMember();
			} else if ($type == 'source') {
				$this->editSource($_POST);
			} else if ($type == 'request_money') {
				$this->requestMoney($_POST);
			} else if ($type == 'recycle_source') {
				$this->recycleSource();
			} else if ($type == 'refresh_money') {
				$this->refreshTeamMoney();
			} else if ($type == 'refresh_balance') {
				$this->refreshTeamBalance();
			} else if ($type == 'deposit') {
				$this->editDeposit($_POST);
			} else {
				$data['result'] = error(-1, '错误的请求类型');
				$this->ajaxReturn($data);
			}
		} else {
			$export = I('get.export', '');
			if ($export == 'insurance') {
				$this->exportInsurance();
			} else if ($export == 'team') {
				$this->exportTeam();
			}
			
			$op = I('get.op', '');
			if ($op == 'new') {
				$this->saveTeam($_GET);
			} else {
				$this->listTeam();
			}
		}
	}
	
	// 资金审批列表
	private function depositList() {
		if (IS_POST) {
			$startIndex = I('post.iDisplayStart', 0);
			$pageSize = I('post.iDisplayLength', 0);
			$cds = I('post.cds', '');
			
			if (!empty($cds)) {
				$findConds = appendLogicExp('id', '=', $cds, 'OR', $findConds);
				$findConds = appendLogicExp('team_id', '=', $cds, 'OR', $findConds);
				$findConds = appendLogicExp('deposit_type', 'LIKE', '%'.$cds.'%', 'OR', $findConds);
				$findConds = appendLogicExp('bank_address', 'LIKE', '%'.$cds.'%', 'OR', $findConds);
				$findConds = appendLogicExp('bank_card', 'LIKE', '%'.$cds.'%', 'OR', $findConds);
				$findConds = appendLogicExp('payee', 'LIKE', '%'.$cds.'%', 'OR', $findConds);
				$findConds = appendLogicExp('request_admin', 'LIKE', '%'.$cds.'%', 'OR', $findConds);
				$findConds = appendLogicExp('review_type', 'LIKE', '%'.$cds.'%', 'OR', $findConds);
				$findConds = appendLogicExp('review_admin', 'LIKE', '%'.$cds.'%', 'OR', $findConds);
				$findConds = appendLogicExp('confirm_admin', 'LIKE', '%'.$cds.'%', 'OR', $findConds);
			}
			
			
			$conds1 = appendLogicExp('review_type', 'LIKE', '%review_pass%');
			$conds1 = appendLogicExp('review_type', 'LIKE', '%reviewing%', 'OR', $conds1);
			$conds1 = appendLogicExp('review_type', 'LIKE', '%review_confirm_fail%', 'OR', $conds1);
			$conds = appendLogicExp('cond1', '=', $conds1);
			if (!empty($findConds)) {
				$conds = appendLogicExp('condfind', '=', $findConds, 'AND', $conds);
			}
			
			$deposit = BackFinancialHelp::getTeamDepostList($conds, $startIndex, $pageSize, array('review_type'=>'desc', 'team_id'=>'desc', 'request_time'=>'desc', 'review_time'=>'desc'), array('obj_show'=>true), $out);			
			$subCount = $pageSize - count($deposit);
			$data['d1'] = $deposit;
			if ($subCount > 0) {
				$conds2 = appendLogicExp('review_type', 'NOT LIKE', '%review_pass%');
				$conds2 = appendLogicExp('review_type', 'NOT LIKE', '%reviewing%', 'AND', $conds2);
				$conds2 = appendLogicExp('review_type', 'LIKE', '%review_confirm_fail%', 'OR', $conds2);
				$conds = appendLogicExp('cond2', '=', $conds2);
				if (!empty($findConds)) {
					$conds = appendLogicExp('condfind', '=', $findConds, 'AND', $conds);
				}			
				$deposit1 = BackFinancialHelp::getTeamDepostList($conds, $startIndex, $subCount, array('review_time'=>'desc', 'team_id'=>'desc', 'request_time'=>'desc','confirm_time'=>'desc'), array('obj_show'=>true));
				$data['d2'] = $deposit1;
				if (!empty($deposit1['ds'])) {
					if (empty($deposit['ds'])) {
						$deposit = $deposit1;
					} else { 
						$deposit['ds'] = array_merge($deposit['ds'],$deposit1['ds']);
						$deposit['total_count'] += $deposit1['total_count'];
					}
				}
			}
			if (count($deposit['ds']) > 0) {
				$colNames = array();
				foreach($deposit['ds'][0] as $dk=>$dv) {
					array_push($colNames, $dk);
				}
			}
			
			$data['sColumns'] = $colNames;
			$data['sEcho'] = I('post.sEcho', '');	
			$data['iDisplayStart'] = $startIndex;
			$data['iDisplayLength'] = $pageSize;
			$data['iTotalRecords'] = $deposit['total_count'];
			$data['iTotalDisplayRecords'] = $deposit['total_count'];
			$data['aaData'] = $deposit['ds'];
			$data['result'] = error(0,"");
		
			$data['aa'] = $_POST;
			$this->ajaxReturn($data);
		} else {
			
			$this->showPage('deposit_list', 'financial_review_deposit', 'financial_review', '资金审批列表');
		}
	}
	
	// 处理审核资金去向
	private function procDepositResult($reviewId, &$out) {
		// 登陆状态判断
		$acct = MyHelp::getLoginAccount(false);
		if (is_error($acct) === true) {
			return error(-1, '用户未登陆，处理资金审核去向失败');
		}
		$acctData = array('id'=>$acct['id'], 'account'=>$acct['account'], 'show_name'=>$acct['show_name']);
		$acctJsonData = my_json_encode($acctData);
		
		// 审核情况查询
		$conds = appendLogicExp('id', '=', $reviewId);
		$deposit = BackFinancialHelp::getTeamDeposit($conds, array('obj_show'=>true));
		if (empty($deposit)) {
			return error(-1, '未能找到审核资金详细');
		}
		
		$bAdd = $deposit['deposit_type_data']['type_key'] == 'cj_deposit_type_recycle' ? false : true;
		
		if ($deposit['deposit_obj_data']['type_key'] == 'cj_deposit_obj_source') {
			$source = $deposit['obj_data'];
			// 签单类型资源资金入账
			if ($source['pay_type_data']['type_key'] == 'cj_pay_type_sign') {
				$sourceObj = ModelBase::getInstance($source['data_table']);
				if (empty($sourceObj)) {
					return error(-1, '处理审核资金入账时，资源数据表对象错误，Error：'.$source['data_table']);
				}
				if ($bAdd === true) {
					$ds['balance'] = bcadd(floatval($source['balance']), $deposit['confirm_money'],2);
				} else {
					$ds['balance'] = bcsub(floatval($source['balance']), $deposit['confirm_money'],2);
				}
				$result = $sourceObj->modify($ds, appendLogicExp('id', '=', $source['id']));
				if (error_ok($result) === true) {
					$superviseContent = '【'.$deposit['obj_type_data']['type_desc'].'】【'.$source['show_name'].'】由于资金审核确认通过【'.$source['pay_type_data']['type_desc'].'】入账'.$deposit['confirm_money'].'元,入账前'.$source['balance'].'元,入账后'.$ds['balance'].'元';
					$out['supervise_result'] = MyHelp::appendSupervise('supervise_type_cj_team', $deposit['id'], $deposit['team_id'], $acctJsonData, $superviseContent);
				}
			} else{
				$result = error(-1, $deposit['obj_type_data']['type_desc'].'采用现金入账，无需签单入账');
				$superviseContent = '【'.$deposit['obj_type_data']['type_desc'].'】【'.$source['show_name'].'】由于资金审核确认通过【'.$source['pay_type_data']['type_desc'].'】方式入账'.$deposit['confirm_money'].'元';
				$out['supervise_result'] = MyHelp::appendSupervise('supervise_type_cj_team', $deposit['id'], $deposit['team_id'], $acctJsonData, $superviseContent);
			}
		} else {
			$team = $deposit['team_data'];
			if ($bAdd === true) {
				$ds['balance'] = bcadd(floatval($team['balance']), $deposit['confirm_money'],2);
			} else {
				$ds['balance'] = bcsub(floatval($team['balance']), $deposit['confirm_money'],2);
			}
			$teamObj = ModelBase::getInstance('cj_team');
			$result = $teamObj->modify($ds, appendLogicExp('id', '=', $team['id']));
			if (error_ok($result) === true) {
				$superviseContent = '团期【'.$team['team_code'].'】由于资金审核确认通过入账'.$deposit['confirm_money'].'元,入账前'.$team['balance'].'元,入账后'.$ds['balance'].'元';
				$out['supervise_result'] = MyHelp::appendSupervise('supervise_type_cj_team', $deposit['id'], $deposit['team_id'], $acctJsonData, $superviseContent);
			}
		}
		return $result;
	}
	
	// 审批资金
	private function reviewDeposit() {
		$depositId = I('post.id', false);
		$opState = I('post.op_state', false);
		if (empty($depositId) || empty($opState) || ($opState != 'pass' && $opState != 'fail' && $opState != 'confirm' && $opState != 'confirm_fail')) {
			$data['result'] = error(-1, '错误的审批参数');
			return $this->ajaxReturn($data);
		}
		
		$conds = appendLogicExp('id', '=', $depositId);
		$deposit = BackFinancialHelp::getTeamDeposit($conds);
		if (empty($deposit)) {
			$data['result'] = error(-1, '未能找到资金审批的信息');
			return $this->ajaxReturn($data);
		}
		
		// 前置状态判断
		$reviewKey = $deposit['review_type_data']['type_key'];
		$data['review'] = $deposit['review_type_data'];
		if ($reviewKey != 'reviewing' && $reviewKey != 'review_confirm_fail' && ($opState == 'pass' || $opState == 'fail')) {
			$data['result'] = error(-1, '此状态下不能进行资金审核');
			return $this->ajaxReturn($data);
		}
		
		if ($reviewKey != 'review_pass' && ($opState == 'confirm' || $opState == 'confirm_fail')) {
			$data['result'] = error(-1, '此状态下不能进行资金审核确认');
			return $this->ajaxReturn($data);
		}
		
		$acct = MyHelp::getLoginAccount(false);
		if (is_error($acct) === true) {
			$data['jumpUrl'] = UNLOGIN_URL;
			$data['result'] = $acct;
			return $this->ajaxReturn($data);
		}
		$acctData = array('id'=>$acct['id'], 'account'=>$acct['account'], 'show_name'=>$acct['show_name']);
		$acctJsonData = my_json_encode($acctData);
		
		// 最终需支付金额
		$finalMoney = bcsub($deposit['money'], $deposit['derate'], 2);
		
		// 开始审核
		$depositObj = ModelBase::getInstance('cj_deposit');
		
		// 审核处理
		if ($opState == 'pass' || $opState == 'fail') {
			if (check_grant('cj_deposit_review') === false) {
				$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
				return $this->ajaxReturn($data);
			}
			$reviewstr = $opState == 'pass' ? 'review_pass' : 'review_fail';
			$reviewType = BackReviewHelp::reviewTypeKey2Value($reviewstr, true);
			if (is_error($reviewstr)) {
				$data['result'] = error(-1, '错误的审核状态类型');
				return $this->ajaxReturn($data);
			}
			unset($reviewType['can_delete']);
			$ds['review_type'] = my_json_encode($reviewType);
			$ds['finnal_money'] = I('post.money', '0.00');
			$ds['review_beizhu'] = I('post.beizhu', '');
			$ds['review_admin'] = $acctJsonData;
			$ds['review_time'] = fmtNowDateTime();
			$data['result'] = $depositObj->modify($ds, $conds);
			if (error_ok($data['result']) === true) {
				$superviseReviewType = $opState == 'pass' ? '通过了' : '拒绝了';
				$superviseContent = $superviseReviewType.'编号【'.$depositId.'】的资金审核，审批资金为【'.$ds['finnal_money'].'】元，最终预算金额为【'.$finalMoney.'】,含减免费用【'.$deposit['derate'].'】元，原因如下:'.$ds['review_beizhu'];
				$data['supervise_result'] = MyHelp::appendSupervise('supervise_type_cj_team', $depositId, $deposit['team_id'], $acctJsonData, $superviseContent);
			}
		} else if ($opState == 'confirm' || $opState == 'confirm_fail') {
			if (check_grant('cj_deposit_commit') === false) {
				$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
				return $this->ajaxReturn($data);
			}
			$reviewstr = $opState == 'confirm' ? 'review_confirm' : 'review_confirm_fail';
			$reviewType = BackReviewHelp::reviewTypeKey2Value($reviewstr, true);
			if (is_error($reviewstr)) {
				$data['result'] = error(-1, '错误的审核状态类型');
				return $this->ajaxReturn($data);
			}
			unset($reviewType['can_delete']);
			$ds['review_type'] = my_json_encode($reviewType);
			$ds['confirm_money'] = I('post.money', '0.00');
			// 累加付款资金
			if ($opState == 'confirm') {
				$ds['complated_money'] = bcadd($deposit['complated_money'], $ds['confirm_money'], 2);
			}
			$ds['confirm_beizhu'] = I('post.beizhu', '');
			$ds['confirm_admin'] = $acctJsonData;
			$ds['confirm_time'] = fmtNowDateTime();
			$data['result'] = $depositObj->modify($ds, $conds);
			if (error_ok($data['result']) === true) {
				// 跟踪确认审核记录
				$superviseReviewType = $opState == 'confirm' ? '确认了' : '拒绝确认';
				$superviseContent = '编号【'.$depositId.'】的资金审核，最终确认资金为【'.$ds['confirm_money'].'】元，累计支付【'.$ds['complated_money'].'】元，最终预算金额为【'.$finalMoney.'】,含减免费用【'.$deposit['derate'].'】元，原因如下:'.$ds['confirm_beizhu'];
				$data['supervise_result'] = MyHelp::appendSupervise('supervise_type_cj_team', $depositId, $deposit['team_id'], $acctJsonData, $superviseContent);
				
				// 处理资金入账
				if ($opState == 'confirm') {
					$data['deposit_result'] = $this->procDepositResult($depositId, $out);
					$data['deposit_out'] = $out;	
				}
			}
		}
		return $this->ajaxReturn($data);
	}
	
	// 资金审批详细
	private function depositInfo() {
		if (IS_POST) {
			$type = I('post.op', false);
			if ($type == 'review') {
				$this->reviewDeposit();
			} else {
				$data['result'] = error(-1, '错误的请求类型');
				$this->ajaxReturn($data);
			}			
		} else {
			$id = I('get.id', false);
			if (empty($id)) {
				return $this->depositList();
			}
			
			$deposit = BackFinancialHelp::getTeamDeposit(appendLogicExp('id', '=', $id), true);			
			$this->assign('deposit', $deposit);
			// 预算提审界面
			$this->assign('modal_fcj_deposit', true);
			
			// 可审核判断
			$canBeReview = false;
			if (check_grant('cj_deposit_review') && (stripos($deposit['review_type'], 'reviewing') !== FALSE || stripos($deposit['review_type'], 'confirm_fail') !== FALSE)) {
				$canBeReview = true;
			}
			$this->assign('can_be_review', $canBeReview);
			
			// 可确认判断
			$canBeCommit = false;
			if (check_grant('cj_deposit_commit') && stripos($deposit['review_type'], 'review_pass') !== FALSE) {
				$canBeCommit = true;
			}
			$this->assign('can_be_commit', $canBeCommit);
			
			return $this->showPage('deposit_info', 'financial_review_deposit', 'financial_review', '资金审批详细');
		}
		
	}
	
	// 团期外资金提审
	private function depositCommit() {
		if (IS_POST) {
			if (check_grant('cj_deposit_submit') === false) {
				$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
				return $this->ajaxReturn($data);
			}
			
			$depositId = I('post.id', false);			
			// 获取审批内容
			$depositObj = ModelBase::getInstance('cj_deposit');	
			$colNames = $depositObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$ds = coll_elements_giveup($colNames, $_POST);	
			$sourceObj = ModelBase::getInstance('cj_team_source');
			
			// 获取提审管理员信息
			$loginAcct = MyHelp::getLoginAccount(false);
			if (is_error($loginAcct) === false) {
				$requestAdmin = array('id'=>$loginAcct['id'], 'account'=>$loginAcct['account'], 'show_name'=>$loginAcct['show_name']);
				$acctJsonData = my_json_encode($requestAdmin);
				if (empty($depositId)) {
					$ds['request_admin'] = my_json_encode($requestAdmin);
					$ds['request_time'] = fmtNowDateTime();
				}
				$reviewType = BackReviewHelp::reviewTypeKey2Value('reviewing', true);
				$ds['review_type'] = my_json_encode($reviewType);
			} else {
				$data['jumpUrl'] = UNLOGIN_URL;
				$data['result'] = error(-1, '您未登录，请登录后再进行操作');
				return $this->ajaxReturn($data);
			}
			
			
			if (empty($ds['money']) || empty($ds['payee']) || empty($ds['bank_card']) ) {
				$data['result'] = error(-1, '错误的资金请款，请款参数不足');
				return $this->ajaxReturn($data);
			}
					
			if (empty($depositId)) {
				$data['op'] = 'create';
				
				// 审批来源为资源类型
				$depositObject = MyHelp::TypeDataKey2Value('cj_deposit_obj_source', true);
				$ds['deposit_obj'] = my_json_encode($depositObject);
								
				$data['result'] = $depositObj->create($ds, $depositId);
				if (error_ok($data['result']) === true) {
					// 记录提交资金审批的情况
					$finnalMoney = bcsub($ds['money'], $ds['derate'], 2);
					$superviseContent = '审批编号为【'.$depositId.'】的资金请求被提审，预算金额【'.$ds['money'].'】元,减免金额【'.$ds['derate'].'】元,提审金额【'.$ds['approval_amount'].'】元,已交易金额【0.00】元,最终预算【'.$finnalMoney.'】元，总金额为【'.$ds['money'].'】元,备注:'.$ds['beizhu'];
					$data['supervise_result'] = MyHelp::appendSupervise('supervise_type_cj_team', $depositId, $ds['team_id'], $acctJsonData, $superviseContent);
					$ds['id'] = $depositId;
					
					// 获取最新的资金审批数据
					$conds = appendLogicExp('id', '=', $depositId);
					$data['ds'] = BackFinancialHelp::getTeamDeposit($conds, false);
				}
			} else {
							
				$conds = appendLogicExp('id', '=', $depositId);
				$deposit = BackFinancialHelp::getTeamDeposit($conds);
				$reviewType = $deposit['review_type_data']['type_key'];
				
				// 判断是否可请款
				if ($reviewType != 'reviewing' && $reviewType != 'review_fail' && $canRequestMoney != true) {
					$data['result'] = error(-1, '团期预算资金审批内容已经被接受并处于【'.$deposit['review_type_data']['type_desc'].'】状态，不能修改');
					return $this->ajaxReturn($data);
				}
				
				$depositAdmin = $deposit['request_admin_data'];
				if ($loginAcct['id'] != $depositAdmin['id']) {
					$data['result'] = error(-1, '您并非该条信息的提审人，无权修改，如有需要请联系提审人【'.$depositAdmin['account'].'】');
					return $this->ajaxReturn($data);
				}
				
				$data['result'] = $depositObj->modify($ds, appendLogicExp('id', '=', $depositId));
				if (error_ok($data['result']) === true) {
					// 记录提交资金审批的情况
					foreach ($ds as $dk=>$dv) {
						if ($dk == 'review_type') {
							$src = $dk.':'.$deposit['review_type_data']['type_desc'].',';
							$newReviewType = json_decode($dv, true);
							$new = $dk.':'.$newReviewType['type_desc'].',';	
						} else {
							$src = $dk.':'.$deposit[$dk].',';
							$new = $dk.':'.$dv.',';	
						}
					}
					$superviseContent = '资金审批编号为【'.$depositId.'】资源预算资金审批被修改，修改前内容:'.$src.',修改后:'.$new;
					$data['supervise_result'] = MyHelp::appendSupervise('supervise_type_cj_team', $depositId, $ds['team_id'], $acctJsonData, $superviseContent);
					
					// 获取最新的资金审批数据
					$conds = appendLogicExp('id', '=', $depositId);
					$data['ds'] = BackFinancialHelp::getTeamDeposit($conds, true);
				}
			}
			$this->ajaxReturn($data);
		} else {
			$depositId = I('get.id', false);			
			if (!empty($depositId)) {
				$deposit = BackFinancialHelp::getTeamDeposit(appendLogicExp('id', '=', $depositId), true);
				if (!empty($deposit['obj_data'])) {
					$deposit['json_obj_data'] = my_json_encode($deposit['obj_data']);
				}
				$this->assign('deposit', $deposit);					
			}			
						
			// 可动态添加类型数据
			$this->assign('modal_type_data', true);
			// 可动态添加消费项
			$this->assign('modal_fcj_item', true);
			// 可动态添加价格项
			$this->assign('modal_fcj_price', true);
			
			return $this->showPage('deposit_new', 'financial_review_commit', 'financial_review', '资金提审');
		}
	}
	
	// 资金审批管理
	public function depositAction(){
		if (IS_POST) {
			$type = I('post.op_type', '');
			if ($type == 'list') {
				$this->depositList();
			} else if ($type == 'info') {
				$this->depositInfo();
			} else if ($type == 'review') {
				$this->depositCommit();
			} else {
				$data['result'] = error(-1, '错误的请求类型');
				$this->ajaxReturn($data);
			}
		} else {			
			$op = I('get.op', false);
			if ($op == 'new') {
				$this->depositCommit();
			} else {
				$id = I('get.id', false);
				if (!empty($id)) {
					$this->depositInfo();
				} else {
					$this->depositList();	
				}
			}
		}
	}
}

?>