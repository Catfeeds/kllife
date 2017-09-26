<?php

namespace Back\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackTaskHelp;

class TaskController extends BackBaseController {
	
	protected function _initialize(){		
		$this->page_title = '我的提醒';
		$this->content_title_show = 1;
		$this->menu_active = 'alert_task';
	}
		
	// 获取查询列表条件
	private function getFindListCDS($cds) {
		if (empty($cds)) {
			return array();
		}   
		
		$cdList = array();
		foreach ($cds as $k=>$v) {
			switch($k){
				case 'title': $cdList['title_like'] = $v; break; //模糊查找，自定义条件
				case 'writer': $cdList['writer_like'] = $v; break;
				case 'task_project_id': $cdList['task_project_id'] = $v; break;
				default: break;
			}
		}
			
		MyHelp::filterInvalidConds($cdList);
		return $cdList;
	}
	
	// 获取线路列表
	private function archiveList($aa) {	
		$totalCount = 0;
		$archivesObj = ModelBase::getInstance('archives', 'xz_');		
		$colNames = $archivesObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$sortCol = $colNames[intval($aa['iSortCol_0'])-1];
		$sortDesc = strcasecmp($aa['sSortDir_0'],'desc')==0 ? true : false;
				
		$startIndex = intval($aa['iDisplayStart']);
		$showLength = intval($aa['iDisplayLength']);
		$count1 = 0; $count2 = 0; $count3 = 0;
		
		$cds = array();
		$cdsstr = explode(',',$aa['cds']);
		for($i = 0; $i < count($cdsstr); $i+=2){
			$cds[$cdsstr[$i]] = $cdsstr[$i+1];
		}
		$cds = $this->getFindListCDS($cds);
		$thisCds = coll_elements_giveup($colNames, $cds);
		$conds = MyHelp::getLogicExp($thisCds, '=', 'AND');
		
		if (array_key_exists('title_like', $cds)) {
			$conds = appendLogicExp('title', 'LIKE', '%'.$cds['title_like'].'%', 'AND', $conds);
		}
		
		if (array_key_exists('writer_like', $cds)) {
			$conds = appendLogicExp('writer', 'LIKE', '%'.$cds['writer_like'].'%', 'AND', $conds);
		}
		
		$ds = $archivesObj->getAll($conds, $startIndex, $showLength, $totalCount, 'senddate', true);
		if (empty($ds)) {
			$ds = array();
		} else {
			$projectObj = ModelBase::getInstance('alert_task_project');
			$projects = $projectObj->getAll();
			foreach ($projects as $pk=>$pv) {
				$projectMap[$pv['id']] = $pv;
			}
			$data['project'] = $projects;
			
			foreach ($ds as $dk=>$dv) {		
				if ($dv['task_project_id'] === '0') {
					$dv['task_project_id.type_desc'] = '未知';
				} else {		
					if (!empty($projectMap)) {
						$project = $projectMap[$dv['task_project_id']];
						$dv['task_project_id.type_desc'] = $project['type_desc'];
					}
				}
				
				$dv['senddate.show_text'] = date('Y年m月d日 H:i:s', $dv['senddate']);
				$dv['pubdate.show_text'] = date('Y年m月d日 H:i:s', $dv['pubdate']);					
				$ds[$dk] = $dv;
			}
		}
		
		$data['sColumns'] = $colNames;
		$data['sEcho'] = $aa['sEcho'];	
		$data['iDisplayStart'] = $startIndex;
		$data['iDisplayLength'] = $showLength;
		$data['iTotalRecords'] = $totalCount;
		$data['iTotalDisplayRecords'] = $totalCount;
		$data['aaData'] = $ds;		
		$data['result'] = error(0,"");
		$this->ajaxReturn($data);		
	}
	
	// 线路编辑
	public function archiveEdit($aa) {
		if (array_key_exists('cd', $aa) === false || array_change_key_case('data', $aa) === false) {
			$data['result'] = error(-1, '参数错误，更新失败');
			return $this->ajaxReturn($data);
		}
		
		$archivesObj = ModelBase::getInstance('archives', 'xz_');	
		$colNames = $archivesObj->getUserDefine(ModelBase::DF_COL_NAMES);		
		$cds = coll_elements_giveup($colNames, $aa['cd']);
		$cds = MyHelp::getLogicExp($cds, '=', 'AND');
		$vals = coll_elements_giveup($colNames, $aa['data']);			
		$data['result'] = $archivesObj->modify($vals, $cds);
		$this->ajaxReturn($data);
	}
	
	// 处理线路信息
	public function archiveAction() {
		if (IS_POST) {	
			$aa = $_POST;
			if (isset($aa['op_type'])) {
				$opType = $aa['op_type'];
				if ($opType == 'list') {
					$this->archiveList($aa);
				} else if ($opType == 'edit') {
					$this->archiveEdit($aa);
				} else {
					$data['result'] = error(-1, '未知的类型动作请求');
					$this->ajaxReturn($data);
				}
			} else {
				$data['result'] = error(-1, '获取类型动作失败');
				$this->ajaxReturn($data);
			}		
				
		} else {	
				
			$this->content_title = '线路列表';
			$this->content_des = '这里你可以查看并管理线路信息';
			$this->_setMenuLinkCurrent('线路列表','alert_task_line');
			$this->_initTemplateInfo();
			
			$taskProjectObj = ModelBase::getInstance('alert_task_project');
			$taskProject = $taskProjectObj->getAll();
			if (!empty($taskProject)) {
				$this->assign('TaskProject', $taskProject);
			}
			
			$this->assign('modal_data_edit', true);
			$this->assign('ajaxReqUrl', U('task/archive'));
			$this->display('line-list');
		}
	}
	
	// 显示任务列表页
	private function showTaskListPage() {			
		$projectObj = ModelBase::getInstance('alert_task_project');
		$projects = $projectObj->getAll();
		
		$this->assign('TaskProject', $projects);
		$this->assign('ajaxReqUrl', U('task/task', 'op_type=list'));
		
		$adminObj = ModelBase::getInstance('admin');
		$admins = $adminObj->getAll();
		$this->assign('admins', $admins);
		
		$this->content_title = '任务列表';
		$this->content_des = '这里你可以查看并管理任务信息';
		$this->_setMenuLinkCurrent('任务列表', 'alert_task_list');
		$this->_initTemplateInfo();		
		$this->display('task-list');
	}
	
	// 获取任务列表数据
	private function taskList($aa) {
		$totalCount = 0;
		$taskObj = ModelBase::getInstance('alert_task');		
		$colNames = $taskObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$sortCol = $colNames[intval($aa['iSortCol_0'])-1];
		$sortDesc = strcasecmp($aa['sSortDir_0'],'desc')==0 ? true : false;
				
		$startIndex = intval($aa['iDisplayStart']);
		$showLength = intval($aa['iDisplayLength']);
		
		$conds = array();		
		$ds = $taskObj->getAll($conds, $startIndex, $showLength, $totalCount, $sortCol, $sortDesc);
		if (empty($ds)) {
			$ds = array();
		} else {
			$projectObj = ModelBase::getInstance('alert_task_project');
			$projects = $projectObj->getAll();
			foreach ($projects as $pk=>$pv) {
				$projectMap[$pv['id']] = $pv;
			}
			
			$dateTypeObj = ModelBase::getInstance('alert_task_date_type');
			$dateTypes = $dateTypeObj->getAll();
			foreach ($dateTypes as $dtk=>$dtv) {
				$dateTypeMap[$dtv['id']] = $dtv;
			}
			
			$adminTypeId = 0;
			$adminTypeObj = ModelBase::getInstance('admin_type');
			$adminTypes = $adminTypeObj->getAll();
			foreach ($adminTypes as $adtk=>$adtv) {
				$adminTypeMap[$adtv['id']] = $adtv;
				if ($adtv['type_key'] === 'administrator') {
					$adminTypeId = $adtv['id'];
				}
			}
			
			$adminObj = ModelBase::getInstance('admin');
			$admins = $adminObj->getAll();
			foreach ($admins as $adk=>$adv) {
				$type = $adminTypeMap[$adv['type_id']];
				if ($adminTypeId === $type['id'] || $adv['account'] === 'admin') {
					unset($admins[$adk]);
					continue;
				}
				$adv['type_id_type_desc'] = $type['type_desc'];
				$admins[$adk] = $adv;
			}		
			
			$projectStepObj = ModelBase::getInstance('alert_task_project_step');
			$taskAdminObj = ModelBase::getInstance('alert_task_admin');
			
			foreach ($ds as $dk=>$dv) {		
				if ($dv['task_project_id'] === '0') {
					$dv['task_project_id.type_desc'] = '未知';
				} else {		
					if (!empty($projectMap)) {
						$project = $projectMap[$dv['task_project_id']];
						$dv['task_project_id.type_desc'] = $project['type_desc'];
					}
				}
				
				if (!empty($dateTypeMap)) {
					$dateType = $dateTypeMap[$dv['notify_start_type']];
					$offset = intval($dv['start_date_offset']);
					if ($offset > 0) {
						$dv['start_date.show_text'] = $dateType['type_desc'].'后'.abs($offset).'天';
					} else if ($offset < 0) {
						$dv['start_date.show_text'] = $dateType['type_desc'].'前'.abs($offset).'天';
					} else {
						$dv['start_date.show_text'] = $dateType['type_desc'];
					}
					
					$dateType = $dateTypeMap[$dv['notify_end_type']];
					$offset = intval($dv['end_date_offset']);
					if ($offset > 0) {
						$dv['end_date.show_text'] = $dateType['type_desc'].'后'.abs($offset).'天';
					} else if ($offset < 0) {
						$dv['end_date.show_text'] = $dateType['type_desc'].'前'.abs($offset).'天';
					} else {
						$dv['end_date.show_text'] = $dateType['type_desc'];
					}
				}
				
				$holiday_offset = intval($dv['holiday_offset']);
				if ($holiday_offset > 0) {
					$dv['holiday.show_text'] = '推迟'.abs($holiday_offset).'天';
				} else if ($holiday_offset < 0) {
					$dv['holiday.show_text'] = '提前'.abs($holiday_offset).'天';
				} else {
					$dv['holiday.show_text'] = '正常';
				}
				
				
				$binds = array();
				foreach ($projects as $pk=>$pv) {
					$bind['id'] = $dv['id'];
					$bind['bind_id'] = $pv['id'];
					$bind['project'] = $pv['type_desc'];
					$bind['checked'] = '';
					$bind['step'] = '';
					$stepCDS = appendLogicExp('task_id', '=', $dv['id'], 'AND');
					$stepCDS = appendLogicExp('project_id', '=', $pv['id'], 'AND', $stepCDS);
					$projectStep = $projectStepObj->getOne($stepCDS);
					if (!empty($projectStep)) {
						$bind['checked'] = 'checked';
						$bind['step'] = $projectStep['step'];
					}
					$binds[count($binds)] = $bind;
				}
				$dv['binds'] = $binds;
				
				$bindAdmins = array();
				foreach ($admins as $ak=>$av) {
					$bindAd['id'] = $dv['id'];
					$bindAd['bind_id'] = $av['id'];
					$bindAd['admin_account'] = $av['account'];
					$bindAd['admin_type_id_type_desc'] = $av['type_id_type_desc'];
					$bindAd['selected'] = '';
					$adminCDS = appendLogicExp('task_id', '=', $dv['id'], 'AND');
					$adminCDS = appendLogicExp('admin_id', '=', $av['id'], 'AND', $adminCDS);
					$taskAdmin = $taskAdminObj->getOne($adminCDS);
					if (!empty($taskAdmin)) {
						$bindAd['selected'] = 'selected';
					}
					$bindAdmins[count($bindAdmins)] = $bindAd;
				}
				$dv['admins'] = $bindAdmins;
				
				$ds[$dk] = $dv;
			}
		}
		
		$data['sColumns'] = $colNames;
		$data['sEcho'] = $aa['sEcho'];	
		$data['iDisplayStart'] = $startIndex;
		$data['iDisplayLength'] = $showLength;
		$data['iTotalRecords'] = $totalCount;
		$data['iTotalDisplayRecords'] = $totalCount;
		$data['aaData'] = $ds;		
		$data['result'] = error(0,"");
		$this->ajaxReturn($data);	
	}
	
	// 显示创建页面
	private function showTaskNewPage() {	
		$dateTypeObj = ModelBase::getInstance('alert_task_date_type');
		$dateTypes = $dateTypeObj->getAll();
		
		$this->assign('DateTypes', $dateTypes);
		$this->assign('ajaxRequestUrl', U('task/task', 'op_type=create'));
		$this->assign('ajaxResponseUrl', U('task/task', 'op_type=list'));
			
		$this->content_title = '创建任务';
		$this->content_des = '这里你可以创建消息提醒任务';
		$this->_setMenuLinkCurrent('创建任务', 'alert_task_list');
		$this->_initTemplateInfo();
		$this->display('task-new');
	}
	
	// 创建任务
	private function taskCreate($aa) {		
		$taskObj = ModelBase::getInstance('alert_task');
		$colNames = $taskObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$saveData = coll_elements_giveup($colNames, $aa);		
		$data['result'] = $taskObj->create($saveData, $taskId);
		return $this->ajaxReturn($data);
	}
	
	// 绑定提醒管理员
	private function taskBindAdmin($aa) {
		$bind = $aa['op_type'] === 'bind_admin' ? true : false;		
		$taskAdminObj = ModelBase::getInstance('alert_task_admin');	
		$colNames = $taskAdminObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNames, $aa);
			
		if ($bind === false) {
			$conds = MyHelp::getLogicExp($ds,'=', 'AND');
			$data['result'] = $taskAdminObj->remove($conds);
		} else {
			$ds['admin_account'] = $aa['account'];
			$data['result'] = $taskAdminObj->create($ds, $bindId);
		}
		$this->ajaxReturn($data);
	}
	
	// 绑定项目所属
	private function taskBindProject($aa) {
		$bind = $aa['op_type'] === 'bind_project' ? true : false;
		$taskProjectObj = ModelBase::getInstance('alert_task_project_step');	
		$colNames = $taskProjectObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNames, $aa);
			
		if ($bind === false) {
			$conds = MyHelp::getLogicExp($ds,'=', 'AND');			
			$taskProject = $taskProjectObj->getOne($conds);
			$result = $taskProjectObj->remove($conds);
			if (error_ok($result) === false) {
				if ($taskProject) {
					$newStep['step'] = '`step`-1';
					$conds = appendLogicExp('project_id', '=', $ds['project_id'], 'AND');
					$conds = appendLogicExp('step', '>', $taskProject['step'], 'AND', $conds);
					$result = $taskProjectObj->modify($newStep, $conds);
					if (error_ok($result) === false) {
						$taskProjectObj->create($taskProject);
					}
				}
			}			
			$data['result'] = $result;
		} else {
			$field = 'MAX(`step`) AS `max_step`';
			$maxConds = appendLogicExp('project_id', '=', $ds['project_id']);
			$taskProject = $taskProjectObj->getEspicalCdStr($field, $maxConds, 0, 0, $total, '', false, $output);
			if (empty($taskProject)) {
				$maxStep = 0;
			} else {
				$maxStep = $taskProject[0]['max_step'];
			}
			$data['max_step'] = $maxStep;
			$ds['step'] = $maxStep + 1;
			$data['result'] = $taskProjectObj->create($ds, $bindId);
		}
		$this->ajaxReturn($data);
 	}
 	
 	// 调整任务阶段
 	public function adjustTaskStep($aa) {
 		if (!array_key_exists('task_id', $aa) || !array_key_exists('task_id', $aa)) {
 			$data['result'] = error(-1, '参数不齐全，不能执行调整任务');
			return $this->ajaxReturn($data);
		}
 		
		$step_down = $aa['op_type'] === 'step_up' ? false : true;	
		$taskProjectObj = ModelBase::getInstance('alert_task_project_step');		
		$conds = appendLogicExp('project_id', '=', $ds['project_id']);
		$taskProjects = $taskProjectObj->getAll($conds, 0, 0, $total, 'step', false);
		if (empty($taskProjects)) {
			$data['result'] = error(-2, '找不到任务绑定的项目');
			return $this->ajaxReturn($data);
		}
		
		foreach ($taskProjects as $tk=>$tv) {			
			if (!empty($thisTask) && empty($nextTask)) {
				$nextTask = $tv;	
			}
			
			if ($tv['task_id'] === $aa['task_id']) {
				$thisTask = $tv;
			}	
			
			if (empty($thisTask)) {
				$previewTask = $tv;
			}
		}
		
		$data['list'] = $taskProjects;
		$data['this'] = $thisTask;
		$data['preview'] = $previewTask;
		$data['next'] = $nextTask;
		
		if (empty($thisTask)) {
			$data['result'] = error(-3, '未能找到调整任务，请稍后再试');
			return $this->ajaxReturn($data);
		}
			
		// 阶段上移
		if ($step_down === false) {
			if (empty($previewTask)) {
				$data['result'] = error(-4, '任务已经是第一阶段，不能再上移了');
				return $this->ajaxReturn($data);
			}
			
			$newStep['step'] = $previewTask['step'];
			$thisConds = appendLogicExp('task_id', '=', $thisTask['task_id'], 'AND');
			$thisConds = appendLogicExp('project_id', '=', $thisTask['project_id'], 'AND', $thisConds);
			$result = $taskProjectObj->modify($newStep, $thisConds);
			if (error_ok($result) !== false) {
				$newStep['step'] = $thisTask['step'];
				$previewConds = appendLogicExp('task_id', '=', $previewTask['task_id'], 'AND');
				$previewConds = appendLogicExp('project_id', '=', $previewTask['project_id'], 'AND', $previewConds);
				$result = $taskProjectObj->modify($newStep, $previewConds);
				// 失败还原				
				if (error_ok($result) === false) {
					$newStep['step'] = $thisTask['step'];
					$thisConds = appendLogicExp('task_id', '=', $thisTask['task_id'], 'AND');
					$thisConds = appendLogicExp('project_id', '=', $thisTask['project_id'], 'AND', $thisConds);
					$result = $taskProjectObj->modify($newStep, $thisConds);
				}
			}
			$data['result'] = $result;
			
		// 阶段下移
		} else {
			if (empty($nextTask)) {
				$data['result'] = error(-5, '任务已经是最后阶段，不能再下移了');
				return $this->ajaxReturn($data);
			}
			
			$newStep['step'] = $nextTask['step'];
			$thisConds = appendLogicExp('task_id', '=', $thisTask['task_id'], 'AND');
			$thisConds = appendLogicExp('project_id', '=', $thisTask['project_id'], 'AND', $thisConds);
			$result = $taskProjectObj->modify($newStep, $thisConds);
			if (error_ok($result) !== false) {
				$newStep['step'] = $thisTask['step'];
				$nextConds = appendLogicExp('task_id', '=', $nextTask['task_id'], 'AND');
				$nextConds = appendLogicExp('project_id', '=', $nextTask['project_id'], 'AND', $nextConds);
				$result = $taskProjectObj->modify($newStep, $nextConds);
				// 失败还原				
				if (error_ok($result) === false) {
					$newStep['step'] = $thisTask['step'];
					$thisConds = appendLogicExp('task_id', '=', $thisTask['task_id'], 'AND');
					$thisConds = appendLogicExp('project_id', '=', $thisTask['project_id'], 'AND', $thisConds);
					$result = $taskProjectObj->modify($newStep, $thisConds);
				}
			}
			$data['result'] = $result;
		}
		$this->ajaxReturn($data);
	}
	
	// 获取编辑任务链接
	private function getTaskEditUrl(){
		$taskId = I('get.id', false);
		if ($taskId !== false) {
			$data['jumpUrl'] = U('task/task', 'op_type=edit&id='.$taskId);	
		} else {
			$data['result'] = error(-1, '错误任务编号，不能编辑任务');
		}
		return $this->ajaxReturn($data);
	}	
	
	// 显示可编辑任务
	private function showTaskEditPage() {
		$taskId = I('get.id');
		$taskObj = ModelBase::getInstance('alert_task');
		$task = $taskObj->getOne(appendLogicExp('id', '=', $taskId));
		if (empty($task)) {
			$errPageData = errorPage('500', '错误', '任务不存在', '找不到目标任务，请确保参数正确');
			$this->assign('err', $errPageData);
			$this->display('index/error');
		}		
		$this->assign('task', $task);
		
		$dateTypeObj = ModelBase::getInstance('alert_task_date_type');
		$dateTypes = $dateTypeObj->getAll();	
		$this->assign('DateTypes', $dateTypes);
		
		$this->assign('ajaxRequestUrl', U('task/task', 'op_type=edit'));
		$this->assign('ajaxResponseUrl', U('task/task', 'op_type=list'));
			
		$this->content_title = '编辑任务';
		$this->content_des = '这里你可以编辑消息提醒任务';
		$this->_setMenuLinkCurrent('编辑任务', 'alert_task_list');
		$this->_initTemplateInfo();
		$this->display('task-new');
	}	
	
	// 编辑任务
	private function taskEdit($aa) {
		if (!array_key_exists('task_id', $aa)) {
			$data['result'] = error(-1, '参数不齐全，不能修改任务');			
			return $this->ajaxReturn($data);
		}
		
		$taskObj = ModelBase::getInstance('alert_task');
		$colNames = $taskObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$saveData = coll_elements_giveup($colNames, $aa);		
		$data['result'] = $taskObj->modify($saveData, appendLogicExp('id', '=', $aa['task_id']));
		return $this->ajaxReturn($data);
	}
	
	// 删除任务
	private function taskDelete($aa) {
		if (!array_key_exists('id', $aa)) {
			$data['result'] = error(-1, '参数不齐全，不能删除任务');			
			return $this->ajaxReturn($data);
		}
		
		$data['result'] = BackTaskHelp::deleteTask($aa['id']);
		return $this->ajaxReturn($data);
	}
	
	// 任务列表
	public function taskAction() {
		if (IS_POST) {
			$aa = $_POST;
			if (isset($aa['op_type'])) {
				$opType = $aa['op_type'];
				if ($opType === 'list') {
					$this->taskList($aa);
				} else if ($opType === 'create') {
					$this->taskCreate($aa);
				} else if ($opType === 'bind_admin' || $opType === 'unbind_admin') {
					$this->taskBindAdmin($aa);
				} else if ($opType === 'bind_project' || $opType === 'unbind_project') {
					$this->taskBindProject($aa);
				} else if ($opType === 'step_up' || $opType === 'step_down') {
					$this->adjustTaskStep($aa);
				} else if ($opType === 'edit') {
					$this->taskEdit($aa);
				} else if ($opType === 'remove') {
					$this->taskDelete($aa);
				} else {
					$data['result'] = error(-1, '未知的类型动作请求');
					$this->ajaxReturn($data);
				}
			} else {
				$data['result'] = error(-1, '获取类型动作失败');
				$this->ajaxReturn($data);
			}
			
		} else {									
			$opType = I('get.op_type', false);
			if ($opType !== false) {
				if ($opType === 'list') {		
					$this->showTaskListPage();
				} else if ($opType == 'create') {			
					$this->showTaskNewPage();
				} else if ($opType == 'edit_url') {
					$this->getTaskEditUrl();
				} else if ($opType == 'edit') {
					$this->showTaskEditPage();
				}
			} else {
				$errPageData = errorPage('404', '错误', '找不到页面', '找不到所请求的页面');
				$this->assign('err', $errPageData);
				$this->display('index/error');
			}
			
		}
	}
	
	// 显示提醒列表
	private function showAlertListPage() {
		$this->assign('ajaxReqUrl', U('task/alert', 'op_type=list'));
		
		$this->content_title = '任务列表';
		$this->content_des = '这里你可以查看并管理任务信息';
		$this->_setMenuLinkCurrent('任务列表', 'alert_task_list');
		$this->_initTemplateInfo();		
		$this->display('alert-list');
	}
	
	// 获取提醒列表数据
	private function alertList() {
		$totalCount = 0;
		$taskActivityObj = ModelBase::getInstance('alert_task_activity');		
		$colNames = $taskActivityObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$sortCol = $colNames[intval($aa['iSortCol_0'])-1];
		$sortDesc = strcasecmp($aa['sSortDir_0'],'desc')==0 ? true : false;
				
		$startIndex = intval($aa['iDisplayStart']);
		$showLength = intval($aa['iDisplayLength']);
		
		$conds = array();		
		$ds = $taskActivityObj->getAll($conds, $startIndex, $showLength, $totalCount, $sortCol, $sortDesc);
		if (empty($ds)) {
			$ds = array();
		} else {
			$taskObj = ModelBase::getInstance('alert_task');
			$tasks = $taskObj->getAll();
			foreach ($tasks as $tk=>$tv) {
				$taskMap[$tv['id']] = $tv;
			}
						
			$adminTypeObj = ModelBase::getInstance('admin_type');
			$adminTypes = $adminTypeObj->getAll();
			foreach ($adminTypes as $adtk=>$adtv) {
				$adminTypeMap[$adtv['id']] = $adtv;
			}
			
			$adminObj = ModelBase::getInstance('admin');
			$admins = $adminObj->getAll();
			foreach ($admins as $adk=>$adv) {
				$type = $adminTypeMap[$adv['type_id']];
				if ($adminTypeId === $type['id'] || $adv['account'] === 'admin') {
					unset($admins[$adk]);
					continue;
				}
				$adv['type_id_type_desc'] = $type['type_desc'];
				$adminMap[$adv['id']] = $adv;
			}
			
			$stateObj = ModelBase::getInstance();
			$state_type_id = MyHelp::IdEachTypeKey('state_type', 'alert_task');
			$states = $stateObj->getAll(appendLogicExp('state_type_id', '=', $state_type_id));
			foreach($states as $sk=>$sv) {
				$stateMap[$sv['id']] = $sv;
			}
						
			foreach ($ds as $dk=>$dv) {
				// 线路
				if (!empty($dv['line_id'])) {
					$archivesObj = ModelBase::getInstance('archives', 'xz_');				
					$archive = $archivesObj->getOne(appendLogicExp('id', '=', $dv['line_id']));
					if (!empty($archive)) {
						$dv['line_id.title'] = $archive['title'];
						$dv['alert_show_text'] = $dv['line_id.title'];
					}	
				}
				
				// 批次
				if (!empty($dv['activity_id'])) {
					$activityObj = ModelBase::getInstance('lineactivity', 'xz_');
					$activity = $activityObj->getOne(appendLogicExp('id', '=', $dv['activity_id']));
					if (!empty($activity)) {
						$dv['activity_id.show_text'] = date('Y年m月d日 H:i:s', $dv['startdate']).'--'.date('Y年m月d日 H:i:s', $dv['startdate']);
						if (empty($dv['alert_show_text'])) {
							$dv['alert_show_text'] = $dv['activity_id.show_text'];
						} else {
							$dv['alert_show_text'] .= '<br />'.$dv['activity_id.show_text'];
						}
					}
				}
				
				if (!empty($taskMap[$dv['task_id']])) {
					$task = $taskMap[$dv['task_id']];
					$dv['task_id.name'] = $task['name'];
				}
				
				if (!empty($adminMap[$dv['admin_id']])) {
					$admin = $adminMap[$dv['admin_id']];
					$dv['admin_id.account'] = $admin['account'];
				}
				
				if (!empty($stateMap[$dv['state_id']])) {
					$state = $stateMap[$dv['state_id']];
					$dv['state_id.type_desc'] = $state['type_desc'];
				}
				
				$ds[$dk] = $dv;
			}
		}
		
		$data['sColumns'] = $colNames;
		$data['sEcho'] = $aa['sEcho'];	
		$data['iDisplayStart'] = $startIndex;
		$data['iDisplayLength'] = $showLength;
		$data['iTotalRecords'] = $totalCount;
		$data['iTotalDisplayRecords'] = $totalCount;
		$data['aaData'] = $ds;		
		$data['result'] = error(0,"");
		$this->ajaxReturn($data);	
	}
	
	// 接受任务
	private function acceptAlertTask($aa) {
		// 参数判断
		if (!array_key_exists('id', $aa)) {
			$data['result'] = error(-1, '参数不齐全，不能接受此任务');
			return $this->ajaxReturn($data);
		}
		
		// 查找任务
		$alertObj = ModelBase::getInstance('alert_task_activity');
		$alert = $alertObj->getOne(appendLogicExp('id', '=', $aa['id']));
		if (empty($alert)) {
			$data['result'] = error(-2, '未能找到提醒任务，不能接受此任务');
			return $this->ajaxReturn($data);
		}
		
		// 分配判断
		$admin = MyHelp::getLoginAccount(true);
		if ($admin['id'] !== $alert['admin_id']) {
			$data['result'] = error(-3, '此任务未分配给您，您不能接受任务');
			return $this->ajaxReturn($data);
		}
		
		// 任务状态判断
		$stateDisposeWaitId = MyHelp::IdEachTypeKey('order_state', 'alert_dispose_wait');
		if ($stateDisposeWaitId !== $alert['state_id']) {
			$data['result'] = error(-4, '此任务状态下，您不能接受任务');
			return $this->ajaxReturn($data);
		}
		
		// 任务排他性判断
		$stateAcceptOtherId = MyHelp::IdEachTypeKey('order_state', 'alert_accept_other');
		if ($alert['state_id'] === $stateAcceptOtherId) {
			$data['result'] = error(-5, '此任务已经被其他管理员处理');
			return $this->ajaxReturn($data);
		}
		
		
		// 修改消息提醒状态
		$stateDisposingId = MyHelp::IdEachTypeKey('order_state', 'alert_disposing');
		$saveData['state_id'] = $stateDisposingId;
		$result = $alertObj->modify($saveData, appendLogicExp('id', '=', $alert['id']));
		if (error_ok($result) === true) {
			// 获取任务
			$taskObj = ModelBase::getInstance('alert_task');
			$task = $taskObj->getOne(appendLogicExp('id', '=', $alert['task_id']));
			$msg['alert_id'] = $alert['id'];
			$msg['create_time'] = fmtNowDateTime();
			
			// 排他处理
			$lineMsg = '';
			$thisMsg = '管理员【'.$admin['account'].'】接受了';
			$onlyConds = appendLogicExp('task_id', '=', $alert['task_id']);
			$onlyConds = appendLogicExp('state_id', '=', $alert['state_id'], 'AND', $onlyConds);
			if (!empty($alert['line_id'])) {
				$onlyConds = appendLogicExp('line_id', '=', $alert['line_id'], 'AND', $onlyConds);
				$archivesObj = ModelBase::getInstance('archives', 'xz_');
				$archives = $archivesObj->getOne(appendLogicExp('id', '=', $alert['line_id']));
				if (!empty($archives)) {
					$lineMsg .= '【'.$archives['title'].'】';
				}
			}
			if (!empty($alert['activity_id'])) {
				$onlyConds = appendLogicExp('activity_id', '=', $alert['activity_id'], 'AND', $onlyConds);
				$activityObj = ModelBase::getInstance('lineactivity', 'xz_');
				$activity = $activityObj->getOne(appendLogicExp('id', '=', $alert['activity_id']));
				if (!empty($activity)) {
					$lineMsg .= '【'.date('Y年m月d日 H:i:s', $activity['startdate']).'--'.date('Y年m月d日 H:i:s', $activity['enddate']).'】';
				}
			}
									
			// 本次任务消息记录
			$messageObj = ModelBase::getInstance('alert_task_activity_message');
			$msg['message'] = $thisMsg.$lineMsg.'【'.$task['name'].'】任务';		
			$messageObj->create($msg);
			
			// 其他任务消息记录
			$msg['message'] = $lineMsg.'【'.$task['name'].'】任务被管理员'.$admin['account'].'接受了,此任务状态变更为【他人处理】';
			$otherAlerts = $alertObj->getAll($onlyConds);
			if (!empty($otherAlerts)) {
				// 修改其他同一消息提醒的状态
				$ids = '(';
				foreach ($otherAlerts as $oak=>$oav) {
					if ($ids !== '(') {
						$ids .= ',';
					}
					$ids .= $oav['id'];
					
					// 写入其他任务日志
					$msg['alert_id'] = $oav['id'];
					$messageObj->create($msg);
				}
				$ids .= ')';
				$conds = appendLogicExp('id', 'IN', $ids);
				$saveData['state_id'] = $stateAcceptOtherId;
				$result = $alertObj->modify($saveData, $conds);
			}
		} 
		
		$data['result'] = $result;
		return $this->ajaxReturn($data);
	}
	
	// 获取提醒任务详细链接
	private function getAlertInfoUrl() {
		$alertId = I('get.id', false);
		if ($alertId !== false) {
			$data['jumpUrl'] = U('task/alert', 'op_type=info&id='.$alertId);	
		} else {
			$data['result'] = error(-1, '错误任务编号，不能编辑任务');
		}
		return $this->ajaxReturn($data);
	}
	
	// 显示提醒任务详细
	private function showAlertInfoPage() {
		$alertId = I('get.id');
		$alertObj = ModelBase::getInstance('alert_task_activity');
		$alert = $alertObj->getOne(appendLogicExp('id', '=', $alertId));
//		if (empty($alert)) {
//			$errPageData = errorPage(500, '错误', '提醒不存在', '找不到提醒记录，请确保参数正确');
//			$this->assign('err', $errPageData);
//			$this->display('index/error');
//		}		
		
		$taskObj = ModelBase::getInstance('alert_task');
		$task = $taskObj->getOne(appendLogicExp('id', '=', $alert['task_id']));
		if (!empty($task)) {
			$alert['task_id_name'] = $task['name'];
		}
		
		if (!empty($alert['line_id'])) {
			$archivesObj = ModelBase::getInstance('archives', 'xz_');
			$archives = $archivesObj->getOne(appendLogicExp('id', '=', $alert['line_id']));
			if (!empty($archives)) {
				$alert['line_id_title'] = $archives['title'];
			}
		}
		if (!empty($alert['activity_id'])) {
			$activityObj = ModelBase::getInstance('lineactivity', 'xz_');
			$activity = $activityObj->getOne(appendLogicExp('id', '=', $alert['activity_id']));
			if (!empty($activity)) {
				$alert['activity_id_show_text'] .= date('Y年m月d日 H:i:s', $activity['startdate']).'--'.date('Y年m月d日 H:i:s', $activity['enddate']);
			}
		}
		
		$this->assign('alert', $alert);		
		
		$alertMessageObj = ModelBase::getInstance('alert_task_activity_message');
		$cds = appendLogicExp('alert_id', '=', $alertId);
		$alertMessage = $alertMessageObj->getAllByCdStr($cds, 0, 0, $total, 'create_time');	
		
		$bk = array('success', 'primary', 'info', 'warning', 'gray');
		$icon = array('fa-paper-plane-o', 'fa-comment-o', 'fa-location-arrow', 'fa-camera-retro', 'fa-calendar');
		
		$index = 0;
		foreach ($alertMessage as $amk=>$amv) {
			$bkIdx = $index % count($bk);
			$iconIdx = $index % count($icon);
			$amv['timeline_bk'] = $bk[$bkIdx];
			$amv['timeline_icon'] = $icon[$iconIdx];
			$index ++;
		}
		
		$this->assign('message', $alertMessage);
							
		$this->content_title = '消息提醒详细信息';
		$this->content_des = '这里你可以查看消息提醒任务详细';
		$this->_setMenuLinkCurrent('消息提醒详细', 'alert_task_list');
		$this->_initTemplateInfo();
		$this->display('alert-info');
	}
	
	// 标志提醒任务完成
	private function complateAlertTask($aa) {
		// 参数判断
		if (!array_key_exists('id', $aa)) {
			$data['result'] = error(-1, '参数不齐全，不能接受此任务');
			return $this->ajaxReturn($data);
		}
		
		// 查找任务
		$alertObj = ModelBase::getInstance('alert_task_activity');
		$alert = $alertObj->getOne(appendLogicExp('id', '=', $aa['id']));
		if (empty($alert)) {
			$data['result'] = error(-2, '未能找到提醒任务，不能接受此任务');
			return $this->ajaxReturn($data);
		}
		
		$taskObj = ModelBase::getInstance('alert_task');
		$task = $taskObj->getOne(appendLogicExp('id', '=', $alert['task_id']));
		
		// 分配判断
		$admin = MyHelp::getLoginAccount(true);
		if ($admin['id'] !== $alert['admin_id']) {
			$data['result'] = error(-3, '此任务未分配给您，您不能接受任务');
			return $this->ajaxReturn($data);
		}
		
		// 任务状态判断
		$stateDisposingId = MyHelp::IdEachTypeKey('order_state', 'alert_disposing');
		if ($stateDisposeWaitId !== $alert['state_id']) {
			$data['result'] = error(-4, '此任务状态下，您不能完成任务');
			return $this->ajaxReturn($data);
		}
		
		// 修改消息提醒状态
		$stateComplatedId = MyHelp::IdEachTypeKey('order_state', 'alert_complated');
		$saveData['state_id'] = $stateComplatedId;
		$result = $alertObj->modify($saveData, appendLogicExp('id', '=', $alert['id']));
		if (error_ok($result) === true) {
			
			$lineMsg = '';
			if (!empty($alert['line_id'])) {
				$archivesObj = ModelBase::getInstance('archives', 'xz_');
				$archives = $archivesObj->getOne(appendLogicExp('id', '=', $alert['line_id']));
				if (!empty($archives)) {
					$lineMsg .= '【'.$archives['title'].'】';
				}
			}
			if (!empty($alert['activity_id'])) {
				$activityObj = ModelBase::getInstance('lineactivity', 'xz_');
				$activity = $activityObj->getOne(appendLogicExp('id', '=', $alert['activity_id']));
				if (!empty($activity)) {
					$lineMsg .= '【'.date('Y年m月d日 H:i:s', $activity['startdate']).'--'.date('Y年m月d日 H:i:s', $activity['enddate']).'】';
				}
			}
			
			$messageObj = ModelBase::getInstance('alert_task_activity_message');
			$msg['alert_id'] = $alert['id'];
			$msg['message'] = '管理员【'+$admin['account']+'】完成了'+$lineMsg+'的【'+$task['name']+'】任务';
			$msg['create_time'] = fmtNowDateTime();
			$result = $messageObj->create($msg, $msgId);
		} 
		
		$data['result'] = $result;
		return $this->ajaxReturn($data);
	}
	
	// 任务提醒
	public function alertAction() {
		if (IS_POST) {
			$aa = $_POST;
			if (isset($aa['op_type'])) {
				$opType = $aa['op_type'];
				if ($opType === 'list') {
					$this->alertList($aa);
				} else if ($opType === 'accept') {
					$this->acceptAlertTask($aa);
				} else if ($opType === 'complated') {
					$this->complateAlertTask($aa);
				} else {
					$data['result'] = error(-1, '未知的类型动作请求');
					$this->ajaxReturn($data);
				}
			} else {
				$data['result'] = error(-1, '获取类型动作失败');
				$this->ajaxReturn($data);
			}
			
		} else {									
			$opType = I('get.op_type', false);
			if ($opType !== false) {
				if ($opType === 'list') {		
					$this->showAlertListPage();
				} else if ($opType == 'info_url') {
					$this->getAlertInfoUrl();
				} else if ($opType == 'info') {
					$this->showAlertInfoPage();
				}
			} else {
				$errPageData = errorPage('404', '错误', '找不到页面', '找不到所请求的页面');
				$this->assign('err', $errPageData);
				$this->display('index/error');
			}
			
		}
	}	
	
}

?>