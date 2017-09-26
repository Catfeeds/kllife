<?php

namespace Core\Model;

class GrantBase extends ModelBase {
	
	// ���δ���ҵ����ʹ�����ʾ����
	const DF_ERRMSG_FILLTYPE = 'errmsg_fill_type';
	
	// ��ʼ���Զ������
	public function intializeUserDefault($params) {
		$cols = array('id', 'title', 'val');
		foreach ($params[ModelBase::DF_COL_NAMES] as $val) {
			$cols[count($cols)] = $val;
		}
		
		$params[ModelBase::DF_COL_NAMES] = $cols;
		$params[TypeBase::DF_ERRMSG_FILLTYPE] = "Ϊ���ҵ������Ŀ������";
		parent::intializeUserDefault($params);
	}
	
	// ���һ����������
	public function fillOneType($data) {
		// ��ȡ��������
		$grants = $this->getAll();
		if (is_error($grants)) {
			return $data;		
		}
		
		if (!empty($data['type'])) {
			$grantId = intval($data['type']);
			// ��Ȩ����ֵ���뵽data�����У���data�ظ�����ֵ�������
			foreach ($this->getUserDefine(ModelBase::DF_COL_NAMES) as $col) {
				// �����Ƿ����������	
				if (empty($data[$col])) {	
					$val = '��������';	
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
	
	// �������
	public function fillType($datas) {
		// ��ȡ��������
		$grants = $this->getAll();
		if (is_error($grants)) {
			return $datas;
//			return error(-4, $this->getUserDefine(TypeBase::DF_ERRMSG_FILLTYPE));			
		}
		
		$newDatas = array();
		foreach ($datas as $data) {
			if (!empty($data['grant'])) {
				$grantId = intval($data['grant']);
				// ��Ȩ����ֵ���뵽data�����У���data�ظ�����ֵ�������
				foreach ($this->getUserDefine(ModelBase::DF_COL_NAMES) as $col) {
					// �����Ƿ����������	
					if (empty($data[$col])) {	
						$val = '��������';	
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