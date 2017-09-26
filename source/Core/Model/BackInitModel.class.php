<?php

namespace Core\Model;
use Think\Log;

class BackInitModel {	
	public static function checkInit() {
		if (C('INIT_DATA_SETTLED') !== true){
//			echo('数据初始化开始<br>');
			// 数据初始化
			BackInitModel::InitData();
			// 管理员初始化
			BackInitModel::checkSuperAdmin();	
//			// 旧数据拆分
//			BackInitModel::OrderOld2New();
		}
	}
	
	public static function getSelfConfig($key) {		
		$cfgObj = ModelBase::getInstance('self_config');
		return $cfgObj->getOne(appendLogicExp('key', '=', $key));
	}
	
	public static function setSelfConfig($key, $value) {
		$cfgObj = ModelBase::getInstance('self_config');
		$cfg = BackInitModel::getSelfConfig($key);
		if (empty($cfg)) {
			$cfgObj->create(array('key'=>$key, 'value'=>$value));
		} else {
			$exps = appendLogicExp('key', '=', $key);
			$err = $cfgObj->modify(array('value'=>$value), $exps);
		}
	}
	
	public static function InitData() {
		$initData = C('INIT_DATA');
		foreach ($initData as $dataKey=>$dataValue) {
			BackInitModel::checkInitData($dataValue['data_save_flag'], $dataValue['table_name'], $dataValue['data']);
		}
	}
	
	// 数据初始化
	public static function checkInitData($cfg, $table, $dataList) {		
		// 检测操作类型数据是否已初始化
		$typeInit = BackInitModel::getSelfConfig($cfg);
		echo('tablename:'.$table.', flag:'.$cfg.'<br>');
//		p_a($typeInit);
		if (empty($typeInit) || $typeInit['value'] != 'settled') {
			$typeObj = ModelBase::getInstance($table);
			foreach ($dataList as $k=>$v) {
				// 查找是否存在条件
				$cdExp = array();
				foreach ($v as $key=>$val) {
					$cdExp = appendLogicExp($key, '=', $val, 'AND', $cdExp);
					break;
				}
				// 查找存在
				$findData = $typeObj->getOne($cdExp);
				// 要修改的值
				$data = array();
				foreach ($v as $key=>$val) {
					$data[$key] = $val;
				}
				if (empty($findData)) {
					$err = $typeObj->create($data);
				} else {
					$cdExp = array();
					foreach($findData as $key=>$val) {						
						$cdExp = appendLogicExp($key, '=', $val, 'AND', $cdExp);
					}
					$err = $typeObj->modify($data,$cdExp);					
				}
				p_a($err);
			}
			BackInitModel::setSelfConfig($cfg, 'settled');
		}
	}
	
	// 管理员初始化
	public static function checkSuperAdmin() {
		$adminObj = ModelBase::getInstance('admin');
		$admin = $adminObj->getOne(appendLogicExp('account', '=', 'admin'));
		if (empty($admin)) {
			$admin['salt'] = substr(uniqid(rand()), -6);
			$admin['account']='admin';
			$admin['password']= md5(md5('admin').$admin['salt']);
			
			$admin['grant_group_id']=0;
			$grant_group = C('GRANT_GROUP');
			$groupObj = ModelBase::getInstance('grant_group');
			$groupData = $groupObj->getOne(appendLogicExp('type_name', '=', $grant_group[0]['type_name']));
			if (!empty($groupData)) {
				$admin['grant_group_id'] = $groupData['id'];
			}
			
			$admin['type_id'] = 0;
			$admin_type = C('ADMIN_TYPE');
			$typeObj = ModelBase::getInstance('admin_type');
			$typeData = $typeObj->getOne(appendLogicExp('type_name', '=', $admin_type[0]['type_name']));
			if (!empty($typeData)) {
				$admin['type_id'] = $typeData['id'];
			}
			
			$admin['can_delete'] = 0;
			$result = $adminObj->create($admin);
		}
	}
	
	// 把旧订单表的某些项拆分到新表中，如下
	// 1.xz_lineenertname表中报名人数字段：male、woman、child信息由kl_signup_member表中的type字段可以统计到，所以取消
	// 2.xz_lineenertname表中报名人员信息字段：ct_names、ct_zhengjian、ct_zjcode保存到kl_signup_member表中，由订单id与报名人员信息id与之对应
	public static function OrderOld2New() {
		$lineObj = ModelBase::getInstance('lineenertname', 'xz_');
		$memberObj = ModelBase::getInstance('signup_member');
		
		// 1.参团人类型数量分拆
		$memberTypeObj = ModelBase::getInstance('member_type');
		$memberTypes = $memberTypeObj->getAll();
		$memberTypeMap = array();
		foreach($memberTypes as $k => $v){
			$memberTypeMap[$v['type_key']] = $v['id'];
		}
		
		// 2.参团人信息分拆
		$certificateObj = ModelBase::getInstance('certificate_type');
		$certTypes = $certificateObj->getAll();
		$certTypeMap = array();
		foreach ($certTypes as $k => $v) {
			$certTypeMap[$v['type_desc']] = $v['id'];
		}
		$certTypeMap['通行证'] = $certTypeMap['护照'];
		
		$orderCount = $lineObj->getCount(appendLogicExp('ct_names', '!=', ''));
		$pageCount = 100;
		$page = ($orderCount / $pageCount) + ($orderCount%$pageCount > 0 ? 1 : 0);
		// 分页执行以免数源过大
//		for($p = 0; $p < $page; $p++){
			$errorList = array();
			$startIndex = 2 * $pageCount;
			$orders = $lineObj->getAll(appendLogicExp('ct_names', '!=', ''), $startIndex, $pageCount);
			if (empty($order)) {
				echo('没有更多的订单数据');
			}
			foreach ($orders as $order) {				
				// 报名人数
				$memberCount = intval($order['male'])+intval($order['woman'])+intval($order['child']);
				$lineObj->modify(array('member_total_count'=>$memberCount), appendLogicExp('id', '=', $order['id']));
				
				// 报名人员信息
				$names = explode('&nbsp;', $order['ct_names']);
				$certs = explode('&nbsp;', $order['ct_zhengjian']);
				$codes = explode('&nbsp;', $order['ct_zjcode']);
				$research = explode('&nbsp;', $order['ct_diaocha']);
				
				for($k = 0; $k < count($names); $k++){				
					if (empty($names[$k])) {
						$rs['errno'] = error($order['id'], '姓名为空');
						array_push($errorList, $rs);
						continue;
					}
					// 报名人信息拆分
					$memberInfoData = array();
					$memberInfoData['order_id'] = $order['id'];
					$memberInfoData['name'] = $names[$k];
					$memberInfoData['tel'] = '';
					$memberInfoData['user_id'] = $order['userid'];
					$memberInfoData['type_id'] = $memberTypeMap['adult_man'];
					$memberInfoData['research'] = empty($research[$k])?'':$research[$k];
					
					// 证件划分
					foreach($certTypeMap as $ck=>$cv)  {
						if (stripos($certs[$k], $ck) !== false) {
							$memberInfoData['certificate_type_id'] = $cv;
							$memberInfoData['certificate_num'] = empty($codes[$k])?'':$codes[$k];
							break;
						}
					}
					
					// 处理证件号码写到类型字段中的情况，无证件类型，默认身份证
					if (empty($memberInfoData['certificate_type_id'])) {						
						$cert_type = intval($certs[$k]);
						if ($cert_type != 0) {
							$memberInfoData['certificate_type_id'] = $certTypeMap['身份证'];
							$memberInfoData['certificate_num'] = empty($certs[$k])?'':$certs[$k];
						}
					}					
					$rs = $memberObj->create($memberInfoData);
					if (!error_ok($rs)) {
						$rs['errno'] = $order['id'];
						array_push($errorList, $rs);
					}
				}
			}
			if (count($errorList) > 0) {
				p_a($errorList);
			}
//		} // end for
	}
}

?>