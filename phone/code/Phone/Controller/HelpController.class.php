<?php

namespace Phone\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;

class HelpController extends PhoneBaseController {
	
	public function listAction(){
		if (IS_POST) {
			$table = I('post.obj', false);
			if ($table === false) {
				$data['result'] = error(-1, '获取列表对象错误');
				return $this->ajaxReturn($data);
			}
			$prefix = I('post.prefix', '');
			$obj = ModelBase::getInstance($table, $prefix);
			$colNames = $obj->getUserDefine(ModelBase::DF_COL_NAMES);
			$cds = coll_elements_giveup($colNames, $_POST);
			$conds = MyHelp::getLogicExp($cds, '=', 'AND');
			$startIndex = I('post.start_index', 0);
			$pageCount = I('post.page_count', 0);			
			$orderColStr = I('post.sort_cols', '');
			$orderDescStr = I('post.sort_order', '');
			$sortCols = explode(',', $orderColStr);
			$orderDescs = explode(',', $orderDescStr);
			
			$sort = array();
			for($i = 0; $i < count($sortCols); $i++){
				if (!empty($sortCols[$$i])) {
					$sort[$sortCols[$i]] = 'asc';
					if (!empty($orderDescs[$i])) {
						$sort[$orderDescs[$i]];
					}	
				}
			}
			
			$data['sort'] = $sortCols;
			$data['result'] = error(0, '');
			$data['ds'] = $obj->getAll($conds, $startIndex, $pageCount, $total, $sort);
			$data['sql'] = $obj->getLastSql();
			if (is_error($data['ds'])) {
				$data['result'] = $data['ds'];
			}
		} else {
			$data['result'] = error(-1, '非法的请求方式');
		}
		$this->ajaxReturn($data);
	}
	
	public function findAction() {
		if (IS_POST) {
			$table = I('post.obj', false);
			if ($table === false) {
				$data['result'] = error(-1, '获取列表对象错误');
				return $this->ajaxReturn($data);
			}
			$prefix = I('post.prefix', '');
			$obj = ModelBase::getInstance($table, $prefix);
			$colNames = $obj->getUserDefine(ModelBase::DF_COL_NAMES);
			$cds = coll_elements_giveup($colNames, $_POST);
			$conds = MyHelp::getLogicExp($cds, '=', 'AND');
			
			$data['result'] = error(0, '');
			$data['ds'] = $obj->getOne($conds);
			if (is_error($data['ds'])) {
				$data['result'] = $data['ds'];
			}
		} else {
			$data['result'] = error(-1, '非法的请求方式');
		}
		$this->ajaxReturn($data);
	}
	
	private function opTypeData($type, $op) {
		if (count($op) == 3) {
			if (exist_chinese($op[1])){
				return error(-1, $op[0].'失败,参数2不能包含汉子与特殊字符');
			} else {
				if ($op[0] == '添加') {
					$newData['data_type_id'] = $type['id'];
					$newData['type_key'] = $type['type_key'].'_'.$op[1];
					$newData['type_desc'] = $op[2];
					$dataObj = ModelBase::getInstance('type_data');
					$conds = MyHelp::getLogicExp($newData, '=', 'AND');
					$count = $dataObj->getCount($conds);
					if ($count > 0) {
						return error(-2, '改参数的主键或者显示内容已经存在');
					} else {
						$newData['can_delete'] = '1';
						return $dataObj->create($newData,$dataId);
					}
				} else if ($op[0] == '删除') {
					$conds = appendLogicExp('data_type_id', '=', $type['id']);
					if (!empty($op[1])) {
						$conds = appendLogicExp('type_key', '=', $type['type_key'].'_'.$op[1], 'AND', $conds);
					}
					if (!empty($op[2])) {
						$conds = appendLogicExp('type_desc', '=', $op[2], 'AND', $conds);
					}
					return $dataObj->remove($conds);
				} else{
					return error(-3, '错误的操作');
				}	
			}
		} else {
			return error(-4, '参数不足，模式必须为"添加/删除,查询主键(字符串或者数字组成),显示内容"组成');
		}
	}
	
	// 获取类型数据列表
	public function listTypeDataAction() {
		if (IS_POST) {
			$typeKey = I('post.type_key', false);
			if ($typeKey != false) {
				$typeConds = appendLogicExp('type_key', '=', $typeKey, 'AND', $typeConds);
			}
			$typeId = I('post.type_id', false);
			if ($typeId != false) {
				$typeConds = appendLogicExp('id', '=', $typeId, 'AND', $typeConds);
			}
			$typeDesc = I('post.type_desc', false);
			if ($typeDesc != false) {
				$typeConds = appendLogicExp('type_desc', '=', $typeDesc, 'AND', $typeConds);
			}
			$typeObj = ModelBase::getInstance('data_type');
			$type = $typeObj->getOne($typeConds);
			if (empty($type)) {
				$data['result'] = error(-1, '未能找出类型数据');
				return $this->ajaxReturn($data);
			}
			
//			$opstr = I('post.op', false);
//			if ($op != false) {
//				$op = explode(',',$opstr);
//				$data['op_result'] = $this->opTypeData($type, $op);
//			}
			
			$dataObj = ModelBase::getInstance('type_data');
			$ds = $dataObj->getAll(appendLogicExp('data_type_id', '=', $type['id']));
			$data['result'] = error(0, '');
			if (empty($ds)) {
				$data['result'] = error(0, '该类型没有数据');
			}
			$data['ds'] = $ds;
			$this->ajaxReturn($data);
			
		} else {
			$data['result'] = error(-1, '非法的请求方式');
		}
		$this->ajaxReturn($data);
	}
	
	// 添加新的类型数据
	public function appendTypeDataAction() {
		if (IS_POST) {
			$typeKey = I('post.type_key', false);
			if ($typeKey != false) {
				$typeConds = appendLogicExp('type_key', '=', $typeKey, 'AND', $typeConds);
			}
			$typeId = I('post.type_id', false);
			if ($typeId != false) {
				$typeConds = appendLogicExp('id', '=', $typeId, 'AND', $typeConds);
			}
			$typeDesc = I('post.type_desc', false);
			if ($typeDesc != false) {
				$typeConds = appendLogicExp('type_desc', '=', $typeDesc, 'AND', $typeConds);
			}
			$typeObj = ModelBase::getInstance('data_type');
			$type = $typeObj->getOne($typeConds);
			if (empty($type)) {
				$data['result'] = error(-1, '未能找出类型数据');
				return $this->ajaxReturn($data);
			}
			
			$ds['data_type_id'] = $type['id'];
			$ds['type_key'] = I('post.data_key', false);
			$ds['type_desc'] = I('post.data_desc', false);
			
			if (empty($ds['type_key']) || empty($ds['type_desc'])) {
				$data['result'] = error(-1, '数据参数不足，创建失败');
				return $this->ajaxReturn($data);
			}
			
			if (preg_match('/^[0-9a-zA-Z_\-]+$/', $ds['type_key'])==FALSE) {
				$data['result'] = error(-1, '数据主键格式错误，创建失败');
				return $this->ajaxReturn($data);
			}
			
			if (preg_match('/^[0-9a-zA-Z_\-\x7f-\xff]+$/', $ds['type_desc'])==FALSE) {
				$data['result'] = error(-1, '数据键值格式错误，创建失败');
				return $this->ajaxReturn($data);
			}
			
			$ds['type_key'] = $type['type_key'] .'_'.$ds['type_key'];
			
			$dataObj = ModelBase::getInstance('type_data');
			$conds = MyHelp::getLogicExp($ds, '=', 'AND');
			$dataCount = $dataObj->getCount($conds);
			if ($dataCount > 0) {
				$data['result'] = error(-1, '创建的数据已经存在，创建失败');
				return $this->ajaxReturn($data);
			}
			$ds['can_delete'] = 1;
			$data['result'] = $dataObj->create($ds, $dataId);
			$data['id'] = $dataId;
			$this->ajaxReturn($data);
			
		} else {
			$data['result'] = error(-1, '非法的请求方式');
		}
		$this->ajaxReturn($data);
	}
	
	// 获取账户列表
	public function listAccountAction() {
		if (IS_POST) {
			$typeId = I('post.id', false);
			if ($typeId != false) {
				$typeConds = appendLogicExp('id', '=', $typeId, 'AND', $typeConds);
			}
			$typeKey = I('post.type_key', false);
			if ($typeKey != false) {
				$typeConds = appendLogicExp('type_key', '=', $typeKey, 'AND', $typeConds);
			}
			$typeDesc = I('post.type_desc', false);
			if ($typeDesc != false) {
				$typeConds = appendLogicExp('type_desc', '=', $typeDesc, 'AND', $typeConds);
			}
			$accountTypeObj = ModelBase::getInstance('account_type');
			$accountType = $accountTypeObj->getOne($typeConds);
			if (empty($accountType)) {
				$data['result'] = error(-1, '未能找出账户类型数据');
				return $this->ajaxReturn($data);
			}
			
			$data['result'] = error(0, '');
			if ($accountType['type_key'] === 'account_admin') {
				$dataObj = ModelBase::getInstance('admin');
				$ds = $dataObj->getAll();
			} else if ($accountType['type_key'] === 'account_user') {
				$dataObj = ModelBase::getInstance('type_data');
				$ds = $dataObj->getAll();
			} else if ($accountType['type_key'] === 'account_distribute') {
				$dataObj = ModelBase::getInstance('type_data');
				$ds = $dataObj->getAll();
			} else {
				$data['result'] = error(-1, '未知的账户类型');
				return $this->ajaxReturn($data);
			}
			if (empty($ds)) {
				$data['result'] = error(0, '该类型没有数据');
			}
			$data['ds'] = $ds;
			$this->ajaxReturn($data);
			
		} else {
			$data['result'] = error(-1, '非法的请求方式');
		}
		$this->ajaxReturn($data);
	}
	
	// 获取管理员账户列表
	public function listAdminAction() {
		if (IS_POST) {
			$typeId = I('post.id', false);
			if ($typeId != false) {
				$typeConds = appendLogicExp('id', '=', $typeId, 'AND', $typeConds);
			}
			$typeKey = I('post.type_key', false);
			if ($typeKey != false) {
				$typeConds = appendLogicExp('type_key', '=', $typeKey, 'AND', $typeConds);
			}
			$typeDesc = I('post.type_desc', false);
			if ($typeDesc != false) {
				$typeConds = appendLogicExp('type_desc', '=', $typeDesc, 'AND', $typeConds);
			}
			
			$conds = array();
			if (!empty($typeConds)) {
				$typeObj = ModelBase::getInstance('admin_type');
				$type = $typeObj->getOne($typeConds);
				if (!empty($type)) {
					$conds = appendLogicExp('type_id', '=', $type['id']);
				}
			}
			
			$data['result'] = error(0, '');
			$dataObj = ModelBase::getInstance('admin');
			$ds = $dataObj->getAll($conds, 0, 0, $total, array('type_id'=>'asc'));
			foreach ($ds as $dk=>$dv) {
				if (!empty($type)) {
					$dv['type_id_type_key'] = $type['type_key'];
					$dv['type_id_type_desc'] = $type['type_desc'];
					$ds[$dk] = $dv;	
				} else {
					$tempType = MyHelp::findDataById('admin_type', $dv['type_id']);
					if (is_error($tempType) === false) {
						$dv['type_id_type_key'] = $tempType['type_key'];
						$dv['type_id_type_desc'] = $tempType['type_desc'];
						$ds[$dk] = $dv;	
					}
				}
			}
			$data['ds'] = $ds;
			$this->ajaxReturn($data);			
		} else {
			$data['result'] = error(-1, '非法的请求方式');
		}
		$this->ajaxReturn($data);
	}
	
}

?>