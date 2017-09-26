<?php
/**
 * Created by CodeLobster.
 * User: PF
 * Date: 2016-5-6
 * Time: 2016-5-6 16:34:16
 */

namespace Core\Model;

class BackTeamHelp {
	
	// 创建小包团
	public static function createTeamGroup($aa, &$teamId, &$output) {				
		$groupTeamObj = ModelBase::getInstance('team_group');		
		$colNames = $groupTeamObj->getUserDefine(ModelBase::DF_COL_NAMES);		
		$saveData = coll_elements_giveup($colNames, $aa);
		
		if ($saveData['tel'] == '') {
			return error(-1, '手机号码不能为空，创建小包团失败');
		}
			
		if (check_mobile($saveData['tel']) === false && check_tel($saveData['tel']) === false) {
			return error(-1, '手机号码错误，创建小包团失败');
		}
		
//		if ($saveData['start_date'] == '') {
//			return error(-1, '出团日期不能不为空，创建小包团失败');
//		}
		
		if (array_key_exists('from_id', $aa)) {
			if ($aa['from_id'] === 'client') {
				$fromId = BackOrderHelp::OrderFromKey2Value('guanwang');
				if (is_error($fromId)) {
					$data['result'] = error(-2, '错误的来源状态');
					return $this->ajaxReturn($data);
				}
				$saveData['from_id'] = $fromId;
			} else {
				$saveData['from_id'] = $aa['from_id'];
		
				// 接团管理员
				$admin = MyHelp::getLoginAccount(true);
				$saveData['create_admin_id'] = $admin['id'];
			}
		}		
		
		
		$nowDate = fmtNowDate();
		$startDate = date('Y-m-d H:i:s', strtotime('-5 days'));
		$endDate = date('Y-m-d H:i:s', time());
		
		
		
		$conds = appendLogicExp('tel', '=', $saveData['tel'], 'AND');
		$conds = appendLogicExp('create_time', '>=', $startDate, 'AND', $conds);
		$conds = appendLogicExp('create_time', '<=', $endDate, 'AND', $conds);
		$count = $groupTeamObj->getCount($conds);
//		$output['count'] = $count;
//		$output['conds'] = $conds;
//		$output['sql'] = $groupTeamObj->getLastSql();
		if ($count > 0) {
			return error(-1, '该手机号码的订单已被录入，五天内不允许再次录入，请检查后再次提交');
		}
		
		$saveData['create_time'] = fmtNowDateTime();
		$statWaitAssgin = BackOrderHelp::OrderStateKey2Value('team_assign_wait');
		if (is_error($statWaitAssgin)) {
			return error(-1, '状态设置错误，创建小包团失败');
		}
		$saveData['dispose_state_id'] = $statWaitAssgin;
		return $groupTeamObj->create($saveData, $teamId);		
	}
	
	// 获取类型数据信息
	public static function getTypeData() {
		$typeDataObj = ModelBase::getInstance('type_data');
		return $typeDataObj->getAll();
	}
}

?>