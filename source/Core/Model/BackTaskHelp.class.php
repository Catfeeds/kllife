<?php
/**
 * Created by CodeLobster.
 * User: PF
 * Date: 2016-6-28
 * Time: 2016-6-28 17:58:44
 */

namespace Core\Model;

class BackTaskHelp {
	
	// 创建小包团
	public static function deleteTask($taskId, $includeRelated=true) {		
		$taskObj = ModelBase::getInstance('alert_task');
		$result = $taskObj->remove(appendLogicExp('id', '=', $taskId));
		if (error_ok($result) === true) {	
			// 不进行级联删除		
			if ($includeRelated === false) {
				return $result;
			}
			
			// 移除绑定的提醒管理员
			$taskAdminObj = ModelBase::getInstance('alert_task_admin');
			$adminResult = $taskAdminObj->remove(appendLogicExp('task_id', '=', $taskId));
			if (error_ok($adminResult) === false) {
				$result = $adminResult;
			}
			
			// 移除所属项目
			$taskProjectObj = ModelBase::getInstance('alert_task_project_step');
			$projectResult = $taskProjectObj->remove(appendLogicExp('task_id', '=', $taskId));
			if (error_ok($projectResult) === false) {
				if (error_ok($result) === false) {
					$result = error($result['error'], $result['message'], $projectResult);
				} else {
					$result = $projectResult;
				}
			}
			
			// 移除提醒的任务
			$taskActivityObj = ModelBase::getInstance('alert_task_activity');
			$activityResult = $taskActivityObj->remove(appendLogicExp('task_id', '=', $taskId));
			if (error_ok($activityResult) === false) {
				if (error_ok($result) === false) {
					$result = error($result['error'], $result['message'], $activityResult);
				} else {
					$result = $activityResult;
				}
			}		
		}		
		return $result;
	}
}

?>