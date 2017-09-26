<?php

namespace Core\Model;

class GrantBase extends ModelBase {
	
	// 填充未查找到类型错误提示语言
	const DF_ERRMSG_FILLTYPE = 'errmsg_fill_type';
	
	// 初始化自定义变量
	public function intializeUserDefault($params) {
		$cols = array('id', 'title', 'val');
		foreach ($params[ModelBase::DF_COL_NAMES] as $val) {
			$cols[count($cols)] = $val;
		}
		
		$params[ModelBase::DF_COL_NAMES] = $cols;
		$params[TypeBase::DF_ERRMSG_FILLTYPE] = "为查找到对象的目标类型";
		parent::intializeUserDefault($params);
	}
	
	// 填充一条数据类型
	public function fillOneType($data) {
		// 获取所有类型
		$grants = $this->getAll();
		if (is_error($grants)) {
			return $data;		
		}
		
		if (!empty($data['type'])) {
			$grantId = intval($data['type']);
			// 将权限列值加入到data数据中，于data重复的列值不予添加
			foreach ($this->getUserDefine(ModelBase::DF_COL_NAMES) as $col) {
				// 该列是否存在于数据	
				if (empty($data[$col])) {	
					$val = '错误数据';	
					foreach ($grants as $t) {
						if ($grantId == $t['id']) {
							$val = $t[$col];
							break;
						}
					}
					$data[$col] = $val;
				}		
			}
		}
		return $data;	
	}
	
	// 填充类型
	public function fillType($datas) {
		// 获取所有类型
		$grants = $this->getAll();
		if (is_error($grants)) {
			return $datas;
//			return error(-4, $this->getUserDefine(TypeBase::DF_ERRMSG_FILLTYPE));			
		}
		
		$newDatas = array();
		foreach ($datas as $data) {
			if (!empty($data['grant'])) {
				$grantId = intval($data['grant']);
				// 将权限列值加入到data数据中，于data重复的列值不予添加
				foreach ($this->getUserDefine(ModelBase::DF_COL_NAMES) as $col) {
					// 该列是否存在于数据	
					if (empty($data[$col])) {	
						$val = '错误数据';	
						foreach ($grants as $t) {
							if ($grantId == $t['id']) {
								$val = $t[$col];
								break;
							}
						}
						$data[$col] = $val;
					}		
				}
			}			
			$newDatas[count($newDatas)] = $data;
		}
		return $newDatas;
	}
}


?>