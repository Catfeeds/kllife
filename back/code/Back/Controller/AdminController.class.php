<?php

namespace Back\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackAccountHelp;

class AdminController extends BackBaseController {	

	protected function _initialize() {		
		$this->page_title = '管理员模块';
		$this->content_title_show = 1;
		$this->menu_active = 'admin';
	}
	
	public function _empty() {
		$this->content_title = '管理员列表';
		$this->content_des = '这里你可以查看并管理其他管理员信息';
		$this->_setMenuLinkCurrent('管理员列表','adminlist');
		$this->_initTemplateInfo();
		$this->display('adminlist');
	}

	public function loginAction(){		
        session_start();        
        $admin = session('admin');   
        	
		$this->page_title = '登录';
		$this->_initTemplateInfo();
         
        $forward = I('get.forward');
        if(empty($forward)) {
            $forward = U('Index/welcome');
        } else {
            $forward = base64_decode($forward);
        }
        if(!empty($admin)) {
            redirect($forward);
        }     
                
		if (IS_POST) {
			$adminObj = ModelBase::getInstance('admin');
			$aa = $_POST;
			$cds = appendLogicExp('account', '=', $aa['acct'], 'AND');
//			$cds = appendLogicExp('type_id', '=', $aa['type'], 'AND', $cds);
			$admin = BackAccountHelp::getAccount('account_admin', $cds);
			if (empty($admin)) {
				$data['result'] = error(-1,'登录失败，账户不存在!!!');
			} else {
				if ($admin['forbidden'] == 1) {
					$data['result'] = error(-1,'账户已被禁用，请联系管理员!!!');
				} else {
					$cmpPassword = md5(md5($aa['pwd']).$admin['salt']);
					if ($cmpPassword === $admin['password']) {						
						// 管理员所属站点
						$station = BackAccountHelp::StationTypeKey2Value($admin['station_id'], true);
						if (is_error($station) === false) {
							$admin['station_id_data'] = $station;
						}
												
						// 管理员类型
						$typeObj = ModelBase::getInstance('admin_type');
						$type = $typeObj->getOne(appendLogicExp('id', '=', $admin['type_id']));
						if (!empty($type)) {
							$admin['type_id_type_desc'] = $type['type_desc'];
							$admin['type_id_data'] = $type;
						}
						
						// 管理员权限组
						$groupObj = ModelBase::getInstance('grant_group');
						$group = $groupObj->getOne(appendLogicExp('id', '=', $admin['group_id']));
						if (!empty($group)) {
							$admin['group_id_type_desc'] = $group['type_desc'];	
							$admin['group_id_data'] = $group;					
						}
						
						// 获取权限组绑定的权限
						$groupGrantBindObj = ModelBase::getInstance('grant_group_bind');
						$groupGrantBind = $groupGrantBindObj->getAll(appendLogicExp('group_id', '=', $admin['group_id']));
						if (!empty($groupGrantBind)) {
							$cds = array();
							foreach ($groupGrantBind as $ggk=>$ggv) {
								$cds = appendLogicExp('id', '=', $ggv['grant_id'], 'OR', $cds);
							}
							// 获取拥有的权限
							if (!empty($cds)) {
								$grantObj = ModelBase::getInstance('grant');
								$grants = $grantObj->getAll($cds);
								if (!empty($grants)) {
									$grantMap = array();
									foreach ($grants as $gk=>$gv) {
										$grantMap[$gv['grant_key']] = $gv;
									}
									$admin['grant'] = $grantMap;
								}	
							}
						}		
						
						$accountType = BackAccountHelp::AccountTypeKey2Value('account_admin');
						$admin['account_type'] = $accountType;												
						$admin['last_login_time'] = $admin['login_time'];
						$admin['last_login_ip'] = $admin['login_ip'];
						$admin['login_time'] = fmtNowDateTime();
						$admin['login_ip'] = get_client_ip();
						// 写入缓存
						MyHelp::setLoginAccount($admin);
//						session('admin', $admin);
						
						// 保存本次登录时间						
						$saveData['last_login_time'] = $admin['last_login_time'];
						$saveData['last_login_ip'] = $admin['last_login_ip'];
						$saveData['login_time'] = $admin['login_time'];
						$saveData['login_ip'] = $admin['login_ip'];
						$data['login_result'] = $adminObj->modify($saveData, appendLogicExp('id', '=', $admin['id']));
						
						// 记录登录日志												
						$logData['admin_id'] = $admin['id'];
						$logData['content'] = $admin['type_id_type_desc'].$admin['account'].'在'.$admin['login_time'].'登录了系统，登录IP为：'.$admin['login_ip'];
						$logData['create_time'] = fmtNowDateTime();
						$adminLogObj = ModelBase::getInstance('admin_log');
						$data['log_result'] = $adminLogObj->create($logData);						
						$data['result'] = error(0,'登陆成功!!!');
					} else {
						$data['result'] = error(-1,'登陆失败，密码错误!!!');
					}
				} // end forbidden
			}
			return $this->ajaxReturn($data);
		} else {		
	        if(empty($admin)) {
//	        	$adminTypeObj = ModelBase::getInstance('admin_type');
//	        	$typeList = $adminTypeObj->getAll();
//	        	$this->assign('typeList', $typeList);	      	
				$this->display('Admin/login');
	        } else {
	        	$this->assign('jumpUrl', $forward);
	        	$this->display('Index/welcome');
			}
		}
	}
	
	public function lockscreenAction() {	
        session_start();        
        $admin = session('admin');   
        	
		$this->page_title = '锁屏';
		$this->_initTemplateInfo();
         
        $forward = I('get.forward');
        if(empty($forward)) {
            $forward = U('Index/welcome');
        } else {
            $forward = base64_decode($forward);
        }
        $this->assign('jumpUrl', $forward);
        
        if(empty($admin)) {
        	$adminTypeObj = ModelBase::getInstance('admin_type');
        	$typeList = $adminTypeObj->getAll();
        	$this->assign('typeList', $typeList);   	
			$this->display('Admin/login');
        } else {  
			if (IS_POST) {			
				$aa = $_POST;
				$cmpPassword = md5(md5($aa['pwd']).$admin['salt']);
				if ($cmpPassword === $admin['password']) {
					$data['result'] = error(0,'登陆成功!!!');
				} else {
					$data['result'] = error(-1,'登陆失败，密码错误!!!');
				}
				$this->ajaxReturn($data);
			} else {		      
	        	$this->display('Admin/lockscreen');
			}
		}              
	}
	
	public function logoutAction() {		
		session_start();
        unset($_SESSION['admin']);
        redirect(U('Admin/login'));	
	}
	
	// 类型列表	
	protected function typeList($aa) {
		if (check_grant('list_account') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		$totalCount = 0;		
		$adminObj = ModelBase::getInstance('admin');
		$colNames = $adminObj->getUserDefine(ModelBase::DF_COL_NAMES);	
		$sortCols = MyHelp::getDataTableSortCol($aa);
		$sortCols = coll_elements_giveup($colNames,$sortCols);
		$sortDesc = strcasecmp($aa['sSortDir_0'],'desc')==0 ? true : false;
		
		$cds = array();
		$admin = MyHelp::getLoginAccount(true);
		$typeObj = ModelBase::getInstance('admin_type');
		if (!empty($admin) && $admin['account'] !== 'admin') {			
//			// 特殊处理administrator类型
//			$thisType = $typeObj->getOne(appendLogicExp('id', '=', $admin['type_id']));			
//			$data['thisType'] = $thisType;
//			if (!empty($thisType) && $thisType['type_key'] === 'administrator') {
//				$types = $typeObj->getAll();
//				if (!empty($types)) {
//					foreach($types as $tk=>$tv) {
//						if ($tv['id'] !== $admin['type_id'] && $tv['type_key'] !== 'super_admin'){
//							$cds = appendLogicExp('type_id', '=', $tv['id'], 'OR', $cds);
//						}
//					}
//				}
//			}
			
			$adminType = BackAccountHelp::AdminTypeKey2Value('super_admin', true);
			$administratorType = BackAccountHelp::AdminTypeKey2Value('administrator', true);
			
			if (!empty($admin['type_id_data'])) {
				$cds = appendLogicExp('type_id', '!=', $adminType['id'], 'AND', $cds);
				if ($admin['type_id_data']['type_key'] !== 'administrator') {
					$cds = appendLogicExp('type_id', '=', $admin['type_id'], 'AND');
					$cds = appendLogicExp('type_id', '!=', $administratorType['id'], 'AND', $cds);
				}
			}
			
		
			// 站点
			if (!empty($admin['station_id_data'])) {
				if ($admin['station_id_data']['key'] !== 'main') {
					$cds = appendLogicExp('station_id', '=', $admin['station_id'], 'AND', $cds);
				}
			} else {
				$station = BackAccountHelp::AccountTypeKey2Value($admin['station_id']);
				if (is_error($station) === false && $station['key'] !== 'main') {					
					$cds = appendLogicExp('station_id', '=', $admin['station_id'], 'AND', $cds);
				}
			}
			
		}
		
		// 用户筛选
		if (!empty($aa['cds'])) {
			// 编号
			$conds = appendLogicExp('id', '=', $aa['cds'], 'OR', $conds);
			// 账户
			$conds = appendLogicExp('account', 'LIKE', '%'.$aa['cds'].'%', 'OR', $conds);
			// 昵称
			$conds = appendLogicExp('nickname', 'LIKE', '%'.$aa['cds'].'%', 'OR', $conds);
			// 电话
			$conds = appendLogicExp('tel', 'LIKE', '%'.$aa['cds'].'%', 'OR', $conds);
			// 电子邮件
			$conds = appendLogicExp('email', 'LIKE', '%'.$aa['cds'].'%', 'OR', $conds);
			// 站点
			$stationObj = ModelBase::getInstance('station_info');
			$station = $stationObj->getOne(appendLogicExp('name', '=', $aa['cds']));
			if (!empty($station)) {
				$conds = appendLogicExp('station_id', '=', $station['id'], 'OR', $conds);
			}
			// 类型
			$adminTypeObj = ModelBase::getInstance('admin_type');
			$adminType = $adminTypeObj->getOne(appendLogicExp('type_desc', '=', $aa['cds']));
			if (!empty($adminType)) {
				$conds = appendLogicExp('type_id', '=', $adminType['id'], 'OR', $conds);
			}
			// 权限组
			$groupObj = ModelBase::getInstance('grant_group');
			$group = $groupObj->getOne(appendLogicExp('type_desc', '=', $aa['cds']));
			if (!empty($group)) {
				$conds = appendLogicExp('group_id', '=', $group['id'], 'OR', $conds);
			}
			$cds = appendLogicExp('cds', '=', $conds, 'AND', $cds);
		}
				
		
		$ds = $adminObj->getAll($cds, $aa['iDisplayStart'], $aa['iDisplayLength'], $totalCount, $sortCols[0], $sortDesc);
		if (empty($ds)) {
			$ds = array();
		}
				
		// 填充数据	
		if (!empty($ds)) {
			$groupObj = ModelBase::getInstance('grant_group');
			foreach($ds as $dk=>$dv) {
				// 账户类型
				$cds = appendLogicExp('id', '=', $dv['type_id']);
				$adminType = $typeObj->getOne($cds);
				if (!empty($adminType)) {
					$dv['type_id_type_desc'] = $adminType['type_desc'];
				}	
				
				// 账户所属站点
				if (empty($stationMap[$dv['station_id']])) {
					$station = BackAccountHelp::StationTypeKey2Value($dv['station_id'], true);
				} else {
					$station = $stationMap[$dv['station_id']];
				}
				if (is_error($station) === false) {
					$dv['station_id_name'] = $station['name'];
				}
				$dv['station_id_data'] = $station;
				
				// 所在权限组
				$cds = appendLogicExp('id', '=', $dv['group_id']);
				$grantGroup = $groupObj->getOne($cds);	
				if (!empty($grantGroup)){
					$dv['group_id_type_desc']=$grantGroup['type_desc'];	
				}
				
				// 禁用账户
				$dv['forbidden_show_text'] = '否';
				if ($dv['forbidden'] == 1){
					$dv['forbidden_show_text'] = '是';
				}
				
//				$dv['show_forbid_button'] = true;
//				$dv['show_delete_button'] = true;
				if ($admin['id'] == $dv['id'] || $dv['account'] === 'admin') {
					$dv['show_forbid_button'] = false;
					$dv['show_delete_button'] = false;					
				}
				
				unset($dv['password']);
				unset($dv['salt']);
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
			$adminObj = ModelBase::getInstance('admin');
			$admin = $adminObj->getOne($cds);
			
			// 填充数据
			$stationObj = ModelBase::getInstance('station_info');
			$typeObj = ModelBase::getInstance('admin_type');
			$groupObj = ModelBase::getInstance('grant_group');
			if (!empty($admin)) {
				$cds = appendLogicExp('id', '=', $admin['station_id']);
				$stationType = $stationObj->getOne($cds);
				if (!empty($stationType)) {
					$admin['station_id_name'] = $stationType['name'];
				}
				
				$cds = appendLogicExp('id', '=', $admin['type_id']);
				$adminType = $typeObj->getOne($cds);
				if (!empty($adminType)) {
					$admin['type_id_type_desc'] = $adminType['type_desc'];
				}	
				
				// 操作类型
				$cds = appendLogicExp('id', '=', $admin['grant_group_id']);
				$grantGroup = $groupObj->getOne($cds);	
				if (!empty($grantGroup)){
					$admin['grant_group_id_type_desc']=$grantGroup['type_desc'];	
				}	
			}
			$data['data'] = $admin;
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
		
		$data['aa'] = $aa;
		if (!array_key_exists('data', $aa)) {
			$data['result'] = error(-1, '参数1错误，创建失败');
			return $this->ajaxReturn($data);
		}
		$ds = $aa['data'];
		if (!array_key_exists('account', $ds) || !array_key_exists('type_id', $ds)) {
			$data['result'] = error(-1, '参数2错误，创建失败');
			return $this->ajaxReturn($data);
		}
					
		$cds = appendLogicExp('account', '=', $ds['account'], 'AND');
//		$cds = appendLogicExp('type_id', '=', $ds['type_id'], 'AND', $cds);
		$adminObj = ModelBase::getInstance('admin');
		$admin = $adminObj->getOne($cds);
		if (empty($admin)) {
			$adminCols = $adminObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$admin = coll_elements_giveup($adminCols, $ds);
			$admin['salt'] = substr(uniqid(rand()), -6);
			$admin['password'] = md5(md5($admin['password']).$admin['salt']);
			$admin['can_delete'] = 1;
			$loginAdmin = MyHelp::getLoginAccount(true);
			if ($loginAdmin['account'] === 'admin') {
				$admin['can_delete'] = 0;
			}
			$admin['create_time'] = fmtNowDateTime();
			$admin['forbidden'] = 0;
			$data['result'] = $adminObj->create($admin);
			$data['admin'] = $admin;
		} else {
			$data['result'] = error(-1, '该账户已经存在');
		}
		return $this->ajaxReturn($data);
	}
	
	// 禁用账户
	protected function typeForbidden($aa) {
		if (check_grant('forbidden_admin_account') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		if (array_key_exists('id', $aa) === false) {
			$data['result'] = error(-1, '参数错误，禁用失败');
			return $this->ajaxReturn($data);
		}
		
		$loginAdmin = MyHelp::getLoginAccount(false);
		if (is_error($loginAdmin) === true) {
			$data['jumpUrl'] = UNLOGIN_URL;
			return $this->ajaxReturn($data);
		}
		
		$adminObj = ModelBase::getInstance('admin');	
		$admin = $adminObj->getOne(appendLogicExp('id', '=', $aa['id']));
		if (empty($admin)) {
			$data['result'] = error(-1, '未能找到管理员信息，禁用失败');
			return $this->ajaxReturn($data);
		}
		
		$saveData['forbidden'] = $admin['forbidden'] == 1 ? 0 : 1;
		$data['forbid'] = $saveData['forbidden'];
		$data['result'] = $adminObj->modify($saveData, appendLogicExp('id', '=', $aa['id']));
		if (error_ok($data['result']) === true) {			
			if ($admin['id'] == $loginAdmin['id']) {
				$loginAdmin['forbidden'] = $saveData['forbidden'];
				MyHelp::setLoginAccount($loginAdmin);
			}
		}
		
		return $this->ajaxReturn($data); 		
	}
	
	// 修改账号
	protected function typeModify($aa) {
		if (check_grant('update_account') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		if (array_key_exists('cd', $aa) === false || array_change_key_case('data', $aa) === false) {
			$data['result'] = error(-1, '参数错误，更新失败');
			return $this->ajaxReturn($data);
		}
		
		$loginAdmin = MyHelp::getLoginAccount(false);
		if (is_error($loginAdmin) === true) {
			$data['jumpUrl'] = UNLOGIN_URL;
			return $this->ajaxReturn($data);
		}
		
		$adminObj = ModelBase::getInstance('admin');	
		$colNames = $adminObj->getUserDefine(ModelBase::DF_COL_NAMES);		
		$cds = coll_elements_giveup($colNames, $aa['cd']);
		$cds = MyHelp::getLogicExp($cds, '=', 'AND');
		$vals = coll_elements_giveup($colNames, $aa['data']);	
				
		$admin = $adminObj->getOne($cds);
		// 判断是否修改密码(要修改的密码与加密后的旧密码一样就不进行修改密码)
		if (array_key_exists('password', $vals)) {
			if (array_key_exists(password, $admin)) {
				$newPwd = md5(md5($vals['password']).$admin['salt']);
				if ($admin['password'] === $vals['password'] || $admin['password'] === $newPwd) {
					unset($vals['password']);
					$data['pwd'] = '不修改密码';
				} else {
					$vals['password'] = $newPwd;
					$data['pwd'] = '修改密码';
				}
			}
		}
		
		$data['vals'] = $vals;
//		$data['cds'] = $cds;
		
		$data['result'] = $adminObj->modify($vals, $cds);
		if (error_ok($data['result']) === true) {		
			if ($admin['id'] == $loginAdmin['id']) {
				// 刷新权限
				if (array_key_exists('group_id', $vals)) {
					if ($admin['group_id'] != $vals['group_id']){
						$loginAdmin['group_id_data'] = BackAccountHelp::AdminGroupKey2Value($vals['group_id']);
						$loginAdmin['group_id_type_desc'] = $loginAdmin['group_id_data']['type_desc'];
						MyHelp::refreshAdminGrant();
					}
				}
				
				$loginAdmin = MyHelp::getLoginAccount(false);
				foreach($vals as $vk=>$vv) {
					$loginAdmin[$vk] = $vv;
					if (!empty($vals['type_id']) && $vals['type_id'] != $loginAdmin['type_id']) {
						$loginAdmin['type_id'] = $vals['type_id'];
						$loginAdmin['type_id_data'] = BackAccountHelp::AdminTypeKey2Value($vals['type_id']);
						$loginAdmin['type_id_type_desc'] = $loginAdmin['type_id_data']['type_desc'];
					}
					if (!empty($vals['station_id']) && $vals['station_id'] != $loginAdmin['station_id']) {
						$loginAdmin['station_id'] = $vals['station_id'];
						$loginAdmin['station_id_data'] = BackAccountHelp::AdminTypeKey2Value($vals['station_id']);
					}
				}								
				MyHelp::setLoginAccount($loginAdmin);
			}
		}
		$this->ajaxReturn($data);
	}
	
	// 删除类型
	protected function typeDelete($aa) {
		if (check_grant('delete_account') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		if (array_key_exists('id', $aa)) {
			$cds = appendLogicExp('id', '=', $aa['id']);		
			$adminObj = ModelBase::getInstance('admin');		
			$admin = $adminObj->getOne($cds);
			if (array_key_exists('account', $admin) && $admin['account'] == 'admin') {
				$data['result'] = error(-1, '该账户不能被删除');
			} else {
				$data['result'] = $adminObj->remove($cds);
			}
		} else {
			$data['result'] = error(-1, '参数错误，删除数据失败');
		}
		$this->ajaxReturn($data);
	}
	
	// 多个删除
	protected function typeDeleteMulti($aa) {
		if (check_grant('delete_account') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		if (array_key_exists('ids', $aa)) {				
			$cdval = $aa['ids'];
			$cds = array();
			if (is_array($cdval)) {
				foreach ($cdval as $ck=>$cv) {
					$cds = appendLogicExp('id', '=', $cv, 'OR', $cds);
				}
			}		
			
			$adminObj = ModelBase::getInstance('admin');
			$ds = $adminObj->getAll($cds);
			if (empty($ds)) {
				$data['result'] = error(-1, '要删除的对象不存在,Err:'.$adminObj->getDbError().',SQL:'.$adminObj->getLastSql());
			} else {
				$data['result'] = $adminObj->remove($cds);	
			}			
		} else {
			$data['result'] = error(-1, '参数错误，查找数据失败');
		}
		$this->ajaxReturn($data);
	}
	
	// 管理员列表
	public function listAction() {	
		$this->content_title = '管理员列表';
		$this->content_des = '这里你可以查看并管理你的合作管理员';
		$this->_setMenuLinkCurrent('资讯列表','admin_acct_list');
		$this->_initTemplateInfo();
		
						
		if (IS_POST) {	
			$aa = $_POST;
			if (isset($aa['op_type'])) {
				$opType = $aa['op_type'];
				if ($opType == 'find') {
					$this->typeFind($aa);
				} else if ($opType == 'create') {
					$this->typeCreate($aa);	
				} else if ($opType == 'forbid') {
					$this->typeForbidden($aa);	
				} else if ($opType == 'edit') {
					$this->typeModify($aa);	
				} else if ($opType == 'delete') {
					$this->typeDelete($aa);				
				} else if ($opType == 'delete_multi'){
					$this->typeDeleteMulti($aa);
				} else if ($opType == 'list') {
					$this->typeList($aa);
				} else{
					$data['result'] = error(-1, '未知的类型动作请求');
					$this->ajaxReturn($data);
				}
			} else {
				$data['result'] = error(-1, '获取类型动作失败');
				$this->ajaxReturn($data);
			}			
		} else {				
			$this->assign('grant_create', check_grant('create_account'));
			$this->assign('grant_update', check_grant('update_account'));
			$this->assign('grant_delete', check_grant('delete_account'));
			$this->assign('grant_forbid', check_grant('forbidden_admin_account'));
			$this->assign('typeObj', 'admin');
			$this->assign('modal_data_edit', true);
			$this->assign('ajaxReqUrl', U('admin/list'));
			$this->display('adminlist');	
		}
	}
	
	// 显示详细信息
	private function showInfoPage($adminId) {
		$adminObj = ModelBase::getInstance('admin');
		$admin = $adminObj->getOne(appendLogicExp('id', '=', $adminId));
		
		$typeConds = array();
		$groupConds = array();
		$stationObj = ModelBase::getInstance('station_info');
		$typeObj = ModelBase::getInstance('admin_type');
		$loginAdmin = MyHelp::getLoginAccount(true);
		if ($loginAdmin['account'] !== 'admin') {			
			$typeCdVals = '('.$loginAdmin['type_id'];
			$thisType = $typeObj->getOne(appendLogicExp('id', '=', $loginAdmin['type_id']));
			// 管理员可分配的类型除去超管之外的所有类型
			if (!empty($thisType) && $thisType['type_key'] === 'administrator') {
				$types = $typeObj->getAll();
				foreach($types as $tk=>$tv) {
					if ($tv['id'] !== $loginAdmin['type_id'] && $tv['type_key'] !== 'super_admin'){
						$typeCdVals .= ','.$tv['id'];
					}
				}
			}
			$typeCdVals .= ')';
			$typeConds = appendLogicExp('id', 'IN', $typeCdVals);		
			
			$groupAdminTypeBindObj = ModelBase::getInstance('group_admin_type_bind');
			$groupAdminTypes = $groupAdminTypeBindObj->getAll(appendLogicExp('admin_type_id', '=', $loginAdmin['type_id']));
			foreach ($groupAdminTypes as $gatk=>$gatv) {
				if (empty($groupCdVals)) {
					$groupCdVals = '('.$gatv['group_id'];
				} else {
					$groupCdVals .= ','.$gatv['group_id'];
				}
			}
			if (!empty($groupCdVals)) {
				$groupCdVals .= ')';
				$groupConds = appendLogicExp('id', 'IN', $groupCdVals);
			}
		}
		
		$stations = $stationObj->getAllByCdStr();
		foreach ($stations as $sk=>$sv) {
			if ($sv['id'] === $admin['station_id']) {
				$admin['station_id_name'] = $sv['name'];
				break;
			}
		}
		
		$types = $typeObj->getAllByCdStr($typeConds);
		foreach ($types as $tk=>$tv) {
			if ($tv['id'] === $admin['type_id']) {
				$admin['type_id_type_desc'] = $tv['type_desc'];
				break;
			}
		}
		
		$groupObj = ModelBase::getInstance('grant_group');
		$groups = $groupObj->getAllByCdStr($groupConds);
		foreach ($groups as $gk=>$gv) {
			if ($gv['id'] === $admin['group_id']) {
				$admin['group_id_type_desc'] = $gv['type_desc'];
				break;
			}
		}
		
		$admin['forbidden_show_text'] = '启用';
		if ($admin['forbidden'] == '1') {
			$admin['forbidden_show_text'] = '禁用';
		}
		
		unset($admin['password']);
		unset($admin['salt']);
		
		$this->assign('adminStation', $stations);
		$this->assign('adminGroup', $groups);
		$this->assign('adminType', $types);
		$this->assign('admin123', $admin);
		
		$adminLogObj = ModelBase::getInstance('admin_log');
		$adminLogs = $adminLogObj->getAll(appendLogicExp('admin_id', '=', $adminId), 0,0,$total,'create_time', true);
		$this->assign('adminLog', $adminLogs);
		
		$this->content_title = '管理员信息';
		$this->content_des = '这里你可以查看并修改管理员信息';
		$this->_setMenuLinkCurrent('管理员信息','admin_acct_list');
		$this->_initTemplateInfo();
		
		$this->assign('grant_update_admin', check_grant('update_account'));
		$this->assign('modal_data_edit', true);
		$this->display('admininfo');
	}
	
	// 详细信息
	public function infoAction() {					
		if (IS_POST) {	
			$aa = $_POST;
			if (isset($aa['op_type'])) {
				$opType = $aa['op_type'];
				if ($opType == 'edit') {
					if (array_key_exists('data', $aa)){
						foreach($aa['data'] as $ak=>$av) {
							$ds[$av['name']] = $av['value'];
						}
						if (!empty($ds)) {
							$aa['data'] = $ds;
						}
					}
					$this->typeModify($aa);	
				} else if ($opType == 'url') {
					if (empty($aa['id'])) {
						$data['result'] = error(-1, '管理员编号错误');
					} else {						
						$data['jumpUrl'] = U('admin/info', 'id='.$aa['id']);
					}
					$this->ajaxReturn($data);
				} else{
					$data['result'] = error(-1, '未知的类型动作请求');
					$this->ajaxReturn($data);
				}
			} else {
				$data['result'] = error(-1, '获取类型动作失败');
				$this->ajaxReturn($data);
			}			
		} else {
			$adminId = I('get.id', false);
			if (empty($adminId)) {
				$errPageData = errorPage('500', '错误', '参数错误', '错误的管理员编号，无法获取管理员信息');
				$this->assign('err', $errPageData);
				$this->display('index/error');
			} else {
				$this->showInfoPage($adminId);
			}
		}
	}	
	
	// 站点列表	
	protected function typeStationList($aa) {
//		if (check_grant('list_station') === false) {
//			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
//			return $this->ajaxReturn($data);
//		}
		
		$totalCount = 0;		
		$stationObj = ModelBase::getInstance('station_info');
		$colNames = $stationObj->getUserDefine(ModelBase::DF_COL_NAMES);	
		$sortCols = MyHelp::getDataTableSortCol($aa);
		$sortCols = coll_elements_giveup($colNames,$sortCols);
		$sortDesc = strcasecmp($aa['sSortDir_0'],'desc')==0 ? true : false;
		
		$admin = MyHelp::getLoginAccount(true);
		$ds = $stationObj->getAll($conds, 0, 0, $totalCount, $sortCols, $sortDesc);
			
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
	
	// 查找站点
	protected function typeStationFind($aa) {	
		if (array_key_exists('id', $aa)) {
			$cds = appendLogicExp('id', '=', $aa['id']);
			$stationObj = ModelBase::getInstance('station_info');
			$station = $stationObj->getOne($cds);			
			$data['data'] = $station;
			$data['result'] = error(0,'');			
		} else {
			$data['result'] = error(-1, '参数错误，查找数据失败');
		}
		$this->ajaxReturn($data);
	}
	
	// 创建站点
	protected function typeStationCreate($aa) {
//		if (check_grant('create_account') === false) {
//			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
//			return $this->ajaxReturn($data);
//		}
		
		if (!array_key_exists('data', $aa) || !array_key_exists('key', $aa['data']) || !array_key_exists('name', $aa['data'])) {
			$data['result'] = error(-1, '参数1错误，创建失败');
			return $this->ajaxReturn($data);
		}
		$ds = $aa['data'];
					
		$cds = appendLogicExp('key', '=', $ds['key'], 'AND');
		$cds = appendLogicExp('name', '=', $ds['name'], 'AND', $cds);
		$stationObj = ModelBase::getInstance('station_info');
		$station = $stationObj->getOne($cds);
		if (empty($station)) {
			$colNames = $stationObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$station = coll_elements_giveup($colNames, $ds);
			
			$station['create_time'] = fmtNowDateTime();
			$data['result'] = $stationObj->create($station, $stationId);
			$station['id'] = $stationId;
			$data['station'] = $station;
		} else {
			$data['result'] = error(-1, '该站点已经存在');
		}
		return $this->ajaxReturn($data);
	}
		
	// 修改站点
	protected function typeStationModify($aa) {
//		if (check_grant('update_account') === false) {
//			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
//			return $this->ajaxReturn($data);
//		}
		
		if (array_key_exists('cd', $aa) === false || array_change_key_case('data', $aa) === false) {
			$data['result'] = error(-1, '参数错误，更新失败');
			return $this->ajaxReturn($data);
		}
		
		$stationObj = ModelBase::getInstance('station_info');	
		$colNames = $stationObj->getUserDefine(ModelBase::DF_COL_NAMES);		
		$cds = coll_elements_giveup($colNames, $aa['cd']);
		$cds = MyHelp::getLogicExp($cds, '=', 'AND');
		$vals = coll_elements_giveup($colNames, $aa['data']);	
				
		$station = $stationObj->getOne($cds);		
		$data['vals'] = $vals;
		$data['cds'] = $cds;
		
		$data['result'] = $stationObj->modify($vals, $cds);
		$this->ajaxReturn($data);
	}
	
	// 删除站点
	protected function typeStationDelete($aa) {
//		if (check_grant('delete_account') === false) {
//			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
//			return $this->ajaxReturn($data);
//		}
		
		if (array_key_exists('id', $aa)) {
			$cds = appendLogicExp('id', '=', $aa['id']);		
			$stationObj = ModelBase::getInstance('station_info');		
			$station = $stationObj->getOne($cds);
			if (array_key_exists('key', $station) && $station['key'] == 'xian') {
				$data['result'] = error(-1, '该站点不能被删除');
			} else {
				$data['result'] = $stationObj->remove($cds);
			}
		} else {
			$data['result'] = error(-1, '参数错误，删除站点失败');
		}
		$this->ajaxReturn($data);
	}
	
	// 删除多个站点
	protected function typeStationDeleteMulti($aa) {
		if (check_grant('delete_account') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		if (array_key_exists('ids', $aa)) {				
			$cdval = $aa['ids'];
			$cds = array();
			if (is_array($cdval)) {
				foreach ($cdval as $ck=>$cv) {
					$cds = appendLogicExp('id', '=', $cv, 'OR', $cds);
				}
			}		
			
			$stationObj = ModelBase::getInstance('station_info');
			$ds = $stationObj->getAll($cds);
			if (empty($ds)) {
				$data['result'] = error(-1, '要删除的站点不存在,Err:'.$stationObj->getDbError().',SQL:'.$stationObj->getLastSql());
			} else {
				$data['result'] = $stationObj->remove($cds);	
			}			
		} else {
			$data['result'] = error(-1, '参数错误，查找数据失败');
		}
		$this->ajaxReturn($data);
	}
	
	// 处理站点
	public function stationAction() {	
		$this->content_title = '站点列表';
		$this->content_des = '这里你可以查看并管理你的站点';
		$this->_setMenuLinkCurrent('站点列表','admin_station_list');
		$this->_initTemplateInfo();
		
						
		if (IS_POST) {	
			$aa = $_POST;
			if (isset($aa['op_type'])) {
				$opType = $aa['op_type'];
				if ($opType == 'find') {
					$this->typeStationFind($aa);
				} else if ($opType == 'create') {
					$this->typeStationCreate($aa);	
				} else if ($opType == 'edit') {
					$this->typeStationModify($aa);	
				} else if ($opType == 'delete') {
					$this->typeStationDelete($aa);				
				} else if ($opType == 'delete_multi'){
					$this->typeStationDeleteMulti($aa);
				} else if ($opType == 'list') {
					$this->typeStationList($aa);
				} else{
					$data['result'] = error(-1, '未知的类型动作请求');
					$this->ajaxReturn($data);
				}
			} else {
				$data['result'] = error(-1, '获取类型动作失败');
				$this->ajaxReturn($data);
			}			
		} else {				
			$this->assign('grant_create', check_grant('create_account'));
			$this->assign('grant_update', check_grant('update_account'));
			$this->assign('grant_delete', check_grant('delete_account'));
			$this->assign('modal_data_edit', true);
			$this->assign('ajaxReqUrl', U('admin/station'));
			$this->display('station');	
		}
	}
	
	// 测试动作
	public function testAction() {		
		$totalCount = 0;
		$adminObj = UtilModel::createModelBaseChild(UtilModel::UTIL_ADMIN);
		$ds = $adminObj->getAll(array(), 0, 5, $totalCount, 'update_time', true);
//		$objGrant = UtilModel::createGrantBaseChild(UtilModel::UTIL_ADMIN);	
//		$ds = $objGrant->fillType($ds);	
		p_a($ds);
	}	
}

?>