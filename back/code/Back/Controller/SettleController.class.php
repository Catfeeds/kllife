<?php
namespace Back\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackLineHelp;
use Core\Model\BackAccountHelp;

define('SETTLE_SMS_TEMPLATE_PAGE_SIZE', 15);
define('SETTLE_KEYWORDS_PAGE_SIZE', 15);

class SettleController extends BackBaseController {

	protected function _initialize() {		
		$this->page_title = '设置模块';
		$this->content_title_show = 1;
		$this->menu_active = 'settle';
	}
	
	public function _empty() {
		$this->content_title = '管理员列表';
		$this->content_des = '这里你可以查看并管理其他管理员信息';
		$this->_setMenuLinkCurrent('管理员列表','list');
		$this->_initTemplateInfo();
		$this->display('list');
	} 
	
	public function testAction() {
		$aa['mDataProp_0'] = 'test0';
		$aa['mDataProp_1'] = 'test1';
		$aa['mDataProp_2'] = 'test2.test21';
		$aa['mDataProp_3'] = 'test3.test31';
		$aa['mDataProp_4'] = 'test4';
		$aa['mDataProp_5'] = 'test5';
		$aa['mDataProp_6'] = 'test6';
		
		$aa['iSortCol_0'] = '0';
		$aa['iSortCol_1'] = '1';
		$aa['iSortCol_2'] = '2';
		$aa['iSortCol_3'] = '3';
		$aa['iSortCol_4'] = '4';
		$aa['iSortCol_5'] = '5';
		$aa['iSortCol_6'] = '6';
		p_a($aa);
		$sortCols = MyHelp::getDataTableSortCol($aa);
		p_a($sortCols);
	}
	
	private function getFindListCDS($cds) {
		if (empty($cds)) {
			return array();
		}   
		
		$cdList = array();
		foreach ($cds as $k=>$v) {
			switch($k){
				case 'op_admin': $cdList['op_admin'] = $v; break;
				case 'op_admin_type': $cdList['op_admin_type'] = $v; break;
				case 'op_type': $cdList['op_type_id'] = $v; break;
				case 'op_table': $cdList['op_table'] = $v; break;
				case 'op_content': $cdList['op_content'] = $v; break;
				case 'date_type': $cdList['date_type'] = $v; break;
				case 'sdate': $cdList['sdate'] = $v; break;
				case 'edate': $cdList['edate'] = $v; break;
				default: break;
			}
		}
		
		MyHelp::filterInvalidConds($cdList);		
		return $cdList;
	}
	
	private function logList($aa) {
		$totalCount = 0;		
		$logObj = ModelBase::getInstance('op_log');
		$colNames = $logObj->getUserDefine(ModelBase::DF_COL_NAMES);
		if (array_key_exists('iSortCol_0', $aa)) {
			if ($aa['iSortCol_0'] === '0') {
				$aa['iSortCol_0'] = 5;
				$aa['sSortDir_0'] = 'desc';
			}
		}
		$sortCols = MyHelp::getDataTableSortCol($aa);
		$sortCols = coll_elements_giveup($colNames,$sortCols);
		$sortDesc = strcasecmp($aa['sSortDir_0'],'desc')==0 ? true : false;
		
		$cds = array();
		$cdsstr = explode('|',$aa['cds']);
		for($i = 0; $i < count($cdsstr); $i+=2){
			$cds[$cdsstr[$i]] = $cdsstr[$i+1];
		}
//		$data['errMsg'] = '';
//		$data['cd_before'] = $cds;
		
		$cds = $this->getFindListCDS($cds);
		$thisCds = coll_elements_giveup($colNames, $cds);
		$conds = MyHelp::getLogicExp($thisCds, '=', 'AND');
		
		// 操作用户
		if (!empty($cds['op_admin'])) {
			if (is_numeric($cds['op_admin'])) {
				$conds = appendLogicExp('account', 'LIKE' , '%id:'.$cds['op_admin'].'%', 'AND', $conds);
			} else {
				$conds = appendLogicExp('account', 'LIKE' , '%'.$cds['op_admin'].'%', 'AND', $conds);
			}
		}
		
		// 操作用户类型
		if (!empty($cds['op_admin_type'])) {
			$conds = appendLogicExp('account', 'LIKE' , '%'.$cds['op_admin_type'].'%', 'AND', $conds);
		}
		
		// 表名查询
		if (!empty($cds['op_table'])) {
			$conds = appendLogicExp('table_name', 'LIKE', '%'.$cds['op_table'].'%', 'AND', $conds);
		}
		
		// 内容查询
		if (!empty($cds['op_content'])) {
			$conds = appendLogicExp('content', 'LIKE', '%'.$cds['op_content'].'%', 'AND', $conds);
		}
								
		// 时间查询条件
		if (!empty($cds['sdate']) && !empty($cds['edate'])) {			
			$usd = strtotime($cds['sdate']);
			$ued = strtotime($cds['edate']);			
			$sdate = $usd > $ued ? $ued : $usd;
			$edate = $usd > $ued ? $usd : $ued;
			$edate = strtotime('+23 hours 59 minutes 59 seconds', $edate);
			$conds = appendLogicExp('create_time', '>=', date('Y-m-d H:i:s', $sdate), 'AND', $conds);
			$conds = appendLogicExp('create_time', '<=', date('Y-m-d H:i:s', $edate), 'AND', $conds);
		}
//		$data['cds'] = $cds;
//		$data['conds'] = $conds;
				
		$ds = $logObj->getAll($conds, $aa['iDisplayStart'], $aa['iDisplayLength'], $totalCount, array('create_time'=>'desc'));
//		$data['sql'] = $logObj->getLastSql();
		
		// 操作类型		
		$opTypeObj = ModelBase::getInstance('op_type');
		$opTypes = $opTypeObj->getAll();
		foreach ($opTypes as $ok=>$ov) {
			$opTypeMap[$ov['id']] = $ov;
		}
		
		// 填充数据		
		foreach($ds as $dk=>$dv) {
			// 账户名称
			$dv['acct'] = json_decode($dv['account'], true);
			// 账户类型
			$acctType = BackAccountHelp::AccountTypeKey2Value($dv['acct']['account_type'], true);
			if (is_error($acctType) === false) {
				$dv['acct']['account_type'] = $acctType;				
			}
			// 操作类型
			$dv['op_type'] = $opTypeMap[$dv['op_type_id']];
			$ds[$dk] = $dv;
		}		
			
	
		$data['sColumns'] = $colNames;
		$data['sEcho'] = $aa['sEcho'];	
		$data['iDisplayStart'] = $aa['iDisplayStart'];
		$data['iDisplayLength'] = $aa['iDisplayLength'];
		$data['iTotalRecords'] = $totalCount;
		$data['iTotalDisplayRecords'] = $totalCount;
		$data['aaData'] = $ds;
		$data['result'] = error(0,"");
		$data['aa']=$aa;
		$this->ajaxReturn($data);
	}
	
	public function logFind($aa) {
		if (array_key_exists('id', $aa)) {
			$cds = appendLogicExp('id', '=', $aa['id']);
			$logObj = ModelBase::getInstance('op_log');
			$log = $logObj->getOne($cds);
			if (empty($log)) {
				$data['result'] = error(-1, '未能根据参数找到日志');
			} else {
				// 填充数据		
				$adminObj = ModelBase::getInstance('admin');
				$adminTypeObj = ModelBase::getInstance('admin_type');
				$opTypeObj = ModelBase::getInstance('op_type');
				
				// 账户名称
				if (empty($dv['admin_id'])) {
					$dv['admin_id.account']	= '未知管理员<'.$dv['admin_id'].'>';	
					$dv['admin_id.type_id.type_desc'] = '未知类型';
				} else {
					$cds = appendLogicExp('id', '=', $log['admin_id']);
					$admin = $adminObj->getOne($cds);		
					if (!empty($admin)){
						$log['admin_id.account']=$admin['account'];	
						$cds = appendLogicExp('id', '=', $admin['type_id']);
						$adminType = $adminTypeObj->getOne($cds);
						if (!empty($adminType)) {
							$log['admin_id.type_id.type_desc'] = $adminType['type_desc'];
						}
					}
				}		
				
				// 操作类型
				$cds = appendLogicExp('id', '=', $log['op_type_id']);
				$opType = $opTypeObj->getOne('$cds');	
				if (!empty($opType)){
					$log['op_type_id.type_desc']=$opType['type_desc'];	
				}	
				$data['data'] = $log;
				$data['result'] = error(0,'查找成功');
			}
		} else {
			$data['result'] = error(-1, '参数错误，查找数据失败');
		}
		$this->ajaxReturn($data);
	}
	
	
	// 删除类型
	protected function logDelete($aa) {
		if (check_grant('delete_log') === false) {
			$data['result'] = error(-1, '您没有次操作权限，请获得此权限后再进行此操作');
			return $this->ajaxReturn($data);
		}
		
		if (array_key_exists('id', $aa)) {	
			$cds = appendLogicExp('id', '=', $aa['id']);
			
			$logObj = ModelBase::getInstance('op_log');
			$ds = $logObj->getOne($cds);
			if (empty($ds)) {
				$data['result'] = error(-1, '要删除的对象不存在');
			} else {
				$data['result'] = $logObj->remove($cds);	
			}			
		} else {
			$data['result'] = error(-1, '参数错误，查找数据失败');
		}
		$this->ajaxReturn($data);
	}
	
	// 多个删除
	protected function logDeleteMulti($aa) {
		if (check_grant('delete_log') === false) {
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
			
			$logObj = ModelBase::getInstance('op_log');
			$ds = $logObj->getAll($cds);
			if (empty($ds)) {
				$data['result'] = error(-1, '要删除的对象不存在,Err:'.$logObj->getDbError().',SQL:'.$logObj->getLastSql());
			} else {
				$data['result'] = $logObj->remove($cds);	
			}			
		} else {
			$data['result'] = error(-1, '参数错误，查找数据失败');
		}
		$this->ajaxReturn($data);
	}
	
	public function logListAction() {		
		if (IS_POST) {
			$op = I('post.op_type', false);	
			if ($op == 'find') {
				$this->logFind($_POST);
			} else if ($op == 'delete') {
				$this->logDelete($_POST);
			} else if ($op == 'delete_multi') {
				$this->logDeleteMulti($_POST);
			} else if ($op == 'list') {
				$this->logList($_POST);
			} else{
				$data['result'] = error(-1, '未知的类型动作请求');
				$this->ajaxReturn($data);
			}
		} else {
			$this->content_title = '日志列表';
			$this->content_des = '这里你可以查看并管理其他管理员信息';
			$this->_setMenuLinkCurrent('日志列表','settle_log');
			$this->_initTemplateInfo();
			
			// 账户类型
			$acctTypeObj = ModelBase::getInstance('account_type');
			$acctTypes = $acctTypeObj->getAll();
			$this->assign('acctTypes', $acctTypes);
			
			// 监督的表
			$this->assign('tabs', C('OP_LOG_TABLE'));
			
			// 操作类型
			$opTypeObj = ModelBase::getInstance('op_type');
			$opTypes = $opTypeObj->getAll();
			$this->assign('opType', $opTypes);
			
			$this->assign('modal_data_edit', true);
			$this->display('loglist');			
		}		
	}
	
	public function modifyPasswordAction() {	
		if (IS_POST) {
			$aa = $_POST;	
			if (array_key_exists('old_pwd', $aa) === false || array_change_key_case('new_pwd', $aa) === false) {
				$data['result'] = error(-1, '参数错误，更新失败');
				return $this->ajaxReturn($data);
			}
			
			$oPwd = $aa['old_pwd'];
			$nPwd = $aa['new_pwd'];
			
			if ($oPwd === $nPwd) {
				$data['result'] = error(-1, '新密码必须和原密码不一致');
				return $this->ajaxReturn($data);
			}
			
			$admin = MyHelp::getLoginAccount(true);			
			$cmpPassword = md5(md5($oPwd).$admin['salt']);
			if ($cmpPassword !== $admin['password']) {
				$data['result'] = error(-1,'原始密码错误,请重新输入');
				return $this->ajaxReturn($data);
			}
			
			$cds = appendLogicExp('account', '=', $admin['account'], 'AND');
			$cds = appendLogicExp('type_id', '=', $admin['type_id'], 'AND', $cds);			
			$adminObj = ModelBase::getInstance('admin');			
			$vals['salt'] = substr(uniqid(rand()), -6);
			$vals['password'] = md5(md5($nPwd).$vals['salt']);									
			$data['result'] = $adminObj->modify($vals, $cds);
			if (error_ok($data['result'])) {
				$admin['salt'] = $vals['salt'];
				$admin['password'] = $vals['password'];
				MyHelp::setLoginAccount($admin);
			}
			$this->ajaxReturn($data);
		} else {
			$this->content_title = '密码设置';
			$this->content_des = '这里你可以重新设置你的管理员密码';
			$this->_setMenuLinkCurrent('密码设置','settle_modify_passwd');
			$this->_initTemplateInfo();
			
			$this->display('modifypwd');			
		}		
	}	
	
	// 修改电话邮箱
	public function modifyAdminAction() {	
		if (IS_POST) {
			$aa = $_POST;
			$adminObj = ModelBase::getInstance('admin');	
			$colNames = $adminObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$vals = coll_elements_giveup($colNames, $aa);
			
			$admin = MyHelp::getLoginAccount(true);
			if (empty($admin)) {
				$data['result'] = error(-1, '您还未登录，请登录后进行此操作');
				$this->ajaxReturn($data);
			}
			
			$data['result'] = $adminObj->modify($vals, appendLogicExp('id', '=', $admin['id']));
			$this->ajaxReturn($data);			
		} else {
			$data['result'] = error(-1, '错误的请求方式');
			$this->ajaxReturn($data);
		}
	}
	
	private function smsSet() {
		$setObj = ModelBase::getInstance('set');
		if (IS_POST) {
			$setId = I('post.id', false);
			if (empty($setId)) {
				$ds['station_id'] = 1;
				$ds['type'] = 'sms_set';
				$ds['key'] = 'send_forbidden';
				$val['forbidden'] = I('post.s', 0);
				$val['time'] = fmtNowDateTime();
				$ds['value'] = my_json_encode($val);
				$data['result'] = $setObj->create($ds, $ds['id']);	
			} else {					
				$val['forbidden'] = I('post.s', 0);
				$val['time'] = fmtNowDateTime();
				$ds['value'] = my_json_encode($val);
				$data['result'] = $setObj->modify($ds, appendLogicExp('id', '=', $setId));	
			}
			$this->ajaxReturn($data);
		} else {
			$setConds = appendLogicExp('station_id', '=', 1);
			$setConds = appendLogicExp('type', '=', 'sms_set', 'AND', $setConds);
			$setConds = appendLogicExp('key', '=', 'send_forbidden', 'AND', $setConds);
			$smsset = $setObj->getOne($setConds);
			if (!empty($smsset)) {
				$smsset['value'] = json_decode($smsset['value'], true);
				$this->assign('sms_set', $smsset);
			}
		}
	}
	
	public function especialAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type = 'sms_inf') {
				$this->smsSet();
			} else {
				$data['result'] = error(-1, '操作错误');
				$this->ajaxReturn($data);
			}
		} else {
			$acct = MyHelp::getLoginAccount(true);
			if (is_error($acct) === false) {
				if ($acct['account'] === 'admin' || $acct['account'] === '彭飞' || $acct['account'] === '陈小五' || $acct['account'] === '赵国强') {										
					$this->smsSet();
					$this->showPage('especial');
				} else {
					$this->showError('501', '访问错误', '您没有访问的权限', '访问错误，您咩有访问的权限');
				}				
			}
		}
	}
	
	// 更新缓存配置
	private function updateCacheConfig($opType, $ds) {
		$admin = MyHelp::getLoginAccount(false);
		if (is_error($admin) === true) {
			return false;
		}
		
		if ($ds['type'] == 'pc_home_index') {
			$cacheName = 'pc_home_index_set_'.$admin['station_id'];			
		} else if ($ds['type'] == 'phone_home_index') {	
			$cacheName = 'phone_home_index_set_'.$admin['station_id'];
		} else if ($ds['type'] == 'qlp_pc_home_index') {
			$cacheName = 'qlp_pc_home_index_set_'.$admin['station_id'];
		} else {
			return false;
		}
		
		$sets = S($cacheName);
		if ($opType == 'append' || $opType == 'modify') {
			if (strpos($ds['key'],'zhuanti') !== FALSE || 
			strpos($ds['key'],'line_tab') !== FALSE ||
			strpos($ds['key'],'article') !== FALSE ||
			strpos($ds['key'],'activity') !== FALSE ||
			strpos($ds['key'],'video') !== FALSE ||
			strpos($ds['key'],'leader') !== FALSE) {
				$sets[$ds['key']] = json_decode($ds['value'],true);
			} else if (strpos($ds['key'],'_line_') !== FALSE && strpos($ds['key'],'_line_image_') == FALSE) {	
				$val = json_decode($ds['value'],true);
				$line = BackLineHelp::getLine(appendLogicExp('id', '=', $val['id']), false);
				if (!empty($line)) {
					$sets[$ds['key']] = $line;	
				} else {		
					$sets[$ds['key']] = $val;
				}
			} else {
				$sets[$ds['key']] = $ds['value'];
			}
			if ($opType == 'append') {
				$sets['id_'.$ds['key']] = $ds['id'];
				$sets['sort_'.$ds['key']] = $ds['sort'];
			}
		} else if ($opType == 'remove') {
			unset($sets[$ds['key']]);
			unset($sets['id_'.$ds['key']]);
			unset($sets['sort_'.$ds['key']]);
		} else {
			return false;
		}
		S($cacheName, $sets, 0);
	}
	
	// 设置后台配置
	private function setConfig($requestType, $aa) {
		$admin = MyHelp::getLoginAccount(false);
		if (is_error($admin)) {
			$data['jumpUrl'] = UNLOGIN_URL;
			$data['result'] = $admin;
			return $this->ajaxReturn($data);
		}
		
		$setObj = ModelBase::getInstance('set');
		$colNames = $setObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNames, $aa);
		
		$station_id = $admin['station_id'];
		if (!empty($aa['station_id'])) {
			$station_id = $aa['station_id'];
		}		
		$ds['station_id'] = $station_id;
		
		if (empty($ds['type']) || (empty($ds['key']) && empty($aa['key_like']))) {
			$data['result'] = error(-1, '配置类型和配置键值不能为空');
			return $this->ajaxReturn($data);
		}
		
		$conds = appendLogicExp('station_id', '=', $station_id, 'AND', $conds);
		$conds = appendLogicExp('type', '=', $ds['type'], 'AND', $conds);
		if (empty($aa['key_like'])) {
			$conds = appendLogicExp('key', '=', $ds['key'], 'AND', $conds);					
		} else {
			$conds = appendLogicExp('key', 'LIKE', '%'.$ds['key'].'%', 'AND', $conds);
		}
		
		if (empty($conds)) {
			$data['result'] = error(-1, '设置的参数不齐全');
			return $this->ajaxReturn($data);
		}
		
		if (!empty($aa['sql_type'])) {
			if ($aa['sql_type'] == 'append') {	// 用于设置tab页
				$set = $setObj->getOne($conds);
				if (!empty($set)) {
					$data['set'] = $set;
					if (empty($set['value']) || $set['value'] === '[]') {
						$appendDS['value'] = $ds['value'];
					} else {
						$vals = json_decode($set['value'], true);
						$appendVals = json_decode($ds['value'], true);
						$newVals = array_merge($vals, $appendVals);
						$appendDS['value'] = my_json_encode($newVals);
					}
					$data['result'] = $setObj->modify($appendDS, $conds);
					if (error_ok($data['result']) === true) {
						$ds['value'] = $appendDS['value'];
						$this->updateCacheConfig('modify', $ds);
					}
				} else {
					$data['result'] = $setObj->create($ds, $setId);	
					$ds['id'] = $setId;
					if (error_ok($data['result']) === true) {
						$this->updateCacheConfig('append', $ds);
					}
				}
			} else if ($aa['sql_type'] == 'find') {
				$sets = MyHelp::getSet($conds);
				$data['ds'] = $sets;			
			} else if ($aa['sql_type'] == 'line') {
				$line = BackLineHelp::getLine(appendLogicExp('id', '=', $ds['value']),false);
				if (empty($line)) {
					$data['result'] = error(-1, '未能找到要绑定线路的相关信息,请查证后再进行绑定');
				} else {
					$vals['id'] = $line['id'];
					$vals['img'] = $line['img1'];
					$vals['title'] = $line['title'];
					$vals['subheading'] = $line['subheading'];
					$vals['send_word'] = $line['send_word_show'];
					$vals['cut_price'] = $line['start_price_adult'];
					$vals['destination'] = $line['destination_show_text'];
					$vals['leader_recommend'] = $line['leader_recommend'];
					$data['line'] = $line;
					$data['ds'] = $vals;
					$set = $setObj->getOne($conds);
					if (!empty($set)) {
						$data['set_id'] = $set['id'];
						$newDS['value'] = my_json_encode($vals);
						$data['result'] = $setObj->modify($newDS, $conds);
						if (error_ok($data['result']) === true) {
							$ds['value'] = $newDS['value'];
							$this->updateCacheConfig('modify', $ds);
						}
					} else {						
						$ds['value'] = my_json_encode($vals);
						$data['result'] = $setObj->create($ds, $setId);
						$ds['id'] = $setId;
						if (error_ok($data['result']) === true) {
							$this->updateCacheConfig('append', $ds);
						}
						$data['set_id'] = $setId;
					}
				}				
			} else if ($aa['sql_type'] == 'video') {
				$video = BackLineHelp::getVideo(appendLogicExp('id', '=', $ds['value']), false);
				if (empty($video)) {
					$data['result'] = error(-1, '未能找到要绑定视频的相关信息,请查证后再进行绑定');
				} else {
					$data['ds'] = $video;
					unset($video['src_type']);
					unset($video['href']);
					unset($video['uploader']);
					$set = $setObj->getOne($conds);
					if (!empty($set)) {
						$newDS['value'] = my_json_encode($video);
						$data['result'] = $setObj->modify($newDS, $conds);
						if (error_ok($data['result']) === true) {
							$ds['value'] = $newDS['value'];
							$this->updateCacheConfig('modify', $ds);
						}
					} else {						
						$ds['value'] = my_json_encode($video);
						$data['result'] = $setObj->create($ds, $setId);
						$ds['id'] = $setId;
						if (error_ok($data['result']) === true) {
							$this->updateCacheConfig('append', $ds);
						}
					}
				}
			} else if ($aa['sql_type'] == 'article') {
				$article = BackLineHelp::getArticle(appendLogicExp('id', '=', $ds['value']), true);
				if (empty($article)) {
					$data['result'] = error(-1, '未能找到要绑定文章的相关信息,请查证后再进行绑定');
				} else {
					$vals['id'] = $article['id'];
					$vals['title'] = $article['title'];
					$vals['short_title'] = $article['short_title'];
					$vals['send_word'] = $article['send_word_show'];
					$vals['face_image'] = $article['face_image'];
					$vals['author'] = $article['account']['show_name'];
					$vals['create_time'] = $article['create_time'];
					$data['ds'] = $vals;
					$set = $setObj->getOne($conds);
					$data['sets'] = $set;
					if (!empty($set)) {
						$newDS['value'] = my_json_encode($vals);
						$data['result'] = $setObj->modify($newDS, $conds);
						if (error_ok($data['result']) === true) {
							$ds['value'] = $newDS['value'];
							$this->updateCacheConfig('modify', $ds);
						}
					} else {						
						$ds['value'] = my_json_encode($vals);
						$data['result'] = $setObj->create($ds, $setId);
						$ds['id'] = $setId;
						if (error_ok($data['result']) === true) {
							$this->updateCacheConfig('append', $ds);
						}
					}
				}
			} else if ($aa['sql_type'] == 'remove') {
				$set = $setObj->getOne($conds);
				if (!empty($set)) {
					if (empty($set['value']) || $set['value'] === '[]') {
						$data['result'] = error(-1, '没有可移除的设置');
					} else {
						$vals = json_decode($set['value'], true);
						$removeVals = json_decode($ds['value'], true);
						foreach($vals as $vk=>$vv) {
							if ($vv['id'] == $removeVals['id']) {
								unset($vals[$vk]);
								break;
							}
						}
						$subDS['value'] = empty($vals) ? '' : my_json_encode($vals);
					}
					$data['result'] = $setObj->modify($subDS, $conds);
					if (error_ok($data['result']) === true) {
						$ds['value'] = $subDS['value'];
						$this->updateCacheConfig('modify', $ds);
					}
				} else {
					$data['result'] = error(-1, '移除配置失败');
				}	
			} else if ($aa['sql_type'] == 'delete') {
				$data['result'] = $setObj->remove($conds);
				if (error_ok($data['result']) === true) {
					$this->updateCacheConfig('remove', $ds);
				}
			} else {
				$data['result'] = error(-1, '错误的设置操作');
			}
		} else {
			$setCount = $setObj->getCount($conds);		
			if ($setCount > 0) {
				$data['result'] = $setObj->modify($ds, $conds);
				if (error_ok($data['result']) === true) {
					$this->updateCacheConfig('modify', $ds);
				}
			} else {
				$data['result'] = $setObj->create($ds, $setId);
				$ds['id'] = $setId;
				if (error_ok($data['result']) === true) {
					$this->updateCacheConfig('append', $ds);
				}
			}
		}	
		
//		if (error_ok($data['result']) === true) {
//			MyHelp::saveConfigUpdateTime($ds['type'], false, $station_id);
//		}
		return $this->ajaxReturn($data);
	}
	
	// 移除牌值
	private function removeConfig($requestType, $aa) {
		if ($requestType == 'post') {
			if (empty($aa['id'])) {
				$data['result'] = error(-1, '参数不足');
				return $this->ajaxReturn($data);
			}
						
			$setObj = ModelBase::getInstance('set');
			$set = $setObj->getOne(appendLogicExp('id', '=', $aa['id']));
			if (empty($set)) {
				$data['result'] = error(-1, '要删除的对象不存在');
				return $this->ajaxReturn($data);
			}
			
			$result = $setObj->remove(appendLogicExp('id', '=', $aa['id']));
			if (error_ok($result) === true) {
				$data['result'] = error(0, '移除配置成功');
//				MyHelp::saveConfigUpdateTime($set['type']);
			} else {
				$data['result'] = error(-1, '移除配置失败,Error:'.$result['errno'].','.$result['message']);
			}
			
			$this->ajaxReturn($data);
		}
	}
	
	// 更新缓存
	private function updateCache() {
		$setObj = ModelBase::getInstance('set');
		$data['result'] = $setObj->modify(array('value'=>time()), appendLogicExp('key', '=', 'config_update_time'));
		return $this->ajaxReturn($data);
	}
	
	// 首页设置
	public function settleAction() {
		$setObj = ModelBase::getInstance('set');
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'set') {
				$this->setConfig('post', $_POST);
			} else if ($type == 'remove') {
				$this->removeConfig('post', $_POST);
			} else if ($type == 'update_cache') {
				$this->updateCache();
			} else {
				$data['result'] = error(-1, '错误的操作方式');
				$this->ajaxReturn($data);
			}
		} else {			
			$admin = MyHelp::getLoginAccount(true);
			if (is_error($admin) === true) {
				return false;
			}
			
			// 线路选择
			$this->assign('modal_line_list', true);
			// 文章选择
			$this->assign('modal_line_article', true);
			// 浮动图片选择
			$this->_initFloatImageSelector();
			
			$use_cache = 1;
			
			$type = I('get.type', false);
			if ($type == 'pchome') {	
				// 视频选择
				$this->assign('modal_video_list', true);
				$use_cache = 1;
				// 初始化设置			
				$sets = S('pc_home_index_set_'.$admin['station_id']);
				$this->assign('config_update_time', $sets['config_update_time']);			
				if (empty($sets) || MyHelp::checkConfigOverdue('pc_home_index', $sets['config_update_time']) === true) {
					$conds = appendLogicExp('station_id', '=', $admin['station_id']);
					$conds = appendLogicExp('type', '=', 'pc_home_index', 'AND', $conds);
					$sets = MyHelp::getSet($conds);
					S('pc_home_index_set_'.$admin['station_id'], $sets, 0);
					$use_cache = 0;
				}
				$this->assign('set', $sets);
				// 站点
				$stationObj = ModelBase::getInstance('station_info');
				$stations = $stationObj->getAll();
				$this->assign('stations', $stations);
				// 线路目的地筛选
				$destinations = MyHelp::getTypeData('line_destination');
				$this->assign('line_dest', $destinations);
				$this->assign('use_cache', $use_cache);
				
				$this->showPage('pchome', 'settle_pc_home', 'settle', '前台首页设置', '前台首页设置');
			} else if ($type == 'phonehome') {	
				// 视频选择
				$this->assign('modal_video_list', true);			
				// 初始化设置			
				$sets = S('phone_home_index_set_'.$admin['station_id']);
				if (empty($sets) || MyHelp::checkConfigOverdue('phone_home_index', $sets['config_update_time']) === true) {
					$conds = appendLogicExp('station_id', '=', $admin['station_id']);
					$conds = appendLogicExp('type', '=', 'phone_home_index', 'AND', $conds);
					$sets = MyHelp::getSet($conds);
					S('phone_home_index_set_'.$admin['station_id'], $sets, 0);
					$use_cache = 0;
				}
				$this->assign('set', $sets);
				$this->assign('use_cache', $use_cache);
							
				$this->showPage('phonehome', 'settle_phone_home', 'settle', '手机首页设置', '手机首页前台设置');
			} else if ($type == 'qinglvpai') {
				// 标签添加
				$this->assign('modal_tab_data', true);		
				// 初始化设置			
				$sets = S('qlp_pc_home_index_set_'.$admin['station_id']);
				if (empty($sets) || MyHelp::checkConfigOverdue('qlp_pc_home_index', $sets['config_update_time']) === true) {
					$conds = appendLogicExp('station_id', '=', $admin['station_id']);
					$conds = appendLogicExp('type', '=', 'qlp_pc_home_index', 'AND', $conds);
					$sets = MyHelp::getSet($conds);
					S('qlp_pc_home_index_set_'.$admin['station_id'], $sets, 0);
					$use_cache = 0;
				}
				$this->assign('set', $sets);
				$this->assign('use_cache', $use_cache);
				
				$this->showPage('qinglvpai', 'settle_qlp_home', 'settle', '轻旅拍设置', '轻旅拍前台设置');
			} else {
				
				$this->showError('404','错误', '找不到页面', '您所请求的页面走丢了');
			}
		}
	}
	
	// 前台PC设置
	public function pcsetAction() {
		if (IS_POST) {
			
		} else {			
			$conds = appendLogicExp('type', '=', 'pc_set');
			$pcset = MyHelp::getSet($conds, 0, 0, $total, array('sort'=>'asc'));
			$this->assign('pcset', $pcset);
			
			$this->_initBaseInfo('settle', 'settle_pcset', '主站设置', 'PC主站后台设置');
			$this->display('pcset');
		}
	}
	
	// 显示短信模板列表
	private function getSMSTemplateList($requestType, $aa) {
		if ($requestType == 'get') {
			$pageIndex = 0;
		} else {
			$pageIndex = empty($aa['page']) ? 0 : intval($aa['page']);
		}
		
		$result = MyHelp::getPageList('sms_template', '', $pageIndex, SETTLE_SMS_TEMPLATE_PAGE_SIZE, array('id'=>'asc'), 0, $out);
		$ds = $result['ds'];
		$pageCount = $result['page_count'];
		
		if ($requestType == 'post') {
			$data['ds'] = $ds;
			$data['page_count'] = $pageCount;
			$data['result'] = error(0, '');
			$this->ajaxReturn($data);
		} else {
			$this->assign('out', $out);
			$this->assign('templates', $ds);
			$this->assign('page_count', $pageCount);
			
			$this->_initBaseInfo('settle_sms_template', 'settle', '短信模板', '短信模板设置');
			$this->display('smstemplate');
		}
	}
	
	// 保存短信模板
	private function saveSMSTemplate($aa) {
		if (empty($aa['name']) || empty($aa['key']) || empty($aa['content'])) {
			$data['result'] = error(-1, '错误的数据信息，名称、键值、内容不能为空');
			$this->ajaxReturn($data);
		}
		
		$tempObj = ModelBase::getInstance('sms_template');
		$colNames = $tempObj->getUserDefine(ModelBase::DF_COL_NAMES);		
		$ds = coll_elements_giveup($colNames, $aa);
		
		if (empty($ds['id'])) {
			$data['op'] = 'create';
			$data['result'] = $tempObj->create($ds, $templateId);
			if (error_ok($data['result']) === true) {
				$ds['id'] = $templateId;
			}
		} else {
			$data['op'] = 'edit';
			unset($ds['id']);
			$data['result'] = $tempObj->modify($ds, appendLogicExp('id', '=', $aa['id']));
			$data['ds'] = $aa;
		}
		$this->ajaxReturn($data);
	}
	
	// 删除短信模板
	private function deleteSMSTemplate($aa) {
		if (empty($aa['id'])) {
			$data['result'] = error(-1, '删除模板错误，模板编号错误');
			$this->ajaxReturn($data);
		}
		
		$tempObj = ModelBase::getInstance('sms_template');
		$data['result'] = $tempObj->remove(appendLogicExp('id', '=', $aa['id']));		
		$this->ajaxReturn($data);
	}
	
	// 短信模板处理
	public function smstemplateAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'list') {
				$this->getSMSTemplateList('post', $_POST);
			} else if ($type == 'save') {
				$this->saveSMSTemplate($_POST);	
			} else if ($type == 'delete') {
				$this->deleteSMSTemplate($_POST);
			} else {
				$data['result'] = error(-1, '错误的操作方式');
				$this->ajaxReturn($data);
			}
		} else {				
			$this->getSMSTemplateList('get', $_GET);
		}		
	}
	
	// 显示页面关键字列表
	private function getKeywordsList($requestType, $aa) {
		if ($requestType == 'get') {
			$pageIndex = 0;
			$cdsstr = I('get.cdsstr', '');
		} else {
			$pageIndex = empty($aa['page']) ? 0 : intval($aa['page']);
			$cdsstr = I('post.cdsstr', '');
		}
		
		$result = MyHelp::getPageList('page_keywords', $cdsstr, $pageIndex, SETTLE_KEYWORDS_PAGE_SIZE, array('id'=>'asc'), 4, $out);
		$ds = $result['ds'];
		$pageCount = $result['page_count'];
		
		if ($requestType == 'post') {
			$data['ds'] = $ds;
			$data['page_count'] = $pageCount;
			$data['result'] = error(0, '');
			$this->ajaxReturn($data);
		} else {
			$this->assign('datas', $ds);
			$this->assign('page_count', $pageCount);			
			$this->showPage('keywords', 'settle_keywords', 'settle', '页面关键字', '页面关键字设置', '这里您可以设置所有页面的关键字');
		}
	}
	
	// 保存页面关键字
	private function saveKeywords($aa) {
		if (empty($aa['page']) || empty($aa['type'])) {
			$data['result'] = error(-1, '错误的数据信息，页面、页面所属类型不能为空');
			$this->ajaxReturn($data);
		}
		
		$dataObj = ModelBase::getInstance('page_keywords');
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
			$data['ds'] = $aa;
		}
		$this->ajaxReturn($data);
	}
	
	// 删除页面关键字
	private function deleteKeywords($aa) {
		if (empty($aa['id'])) {
			$data['result'] = error(-1, '删除页面关键字，编号错误');
			$this->ajaxReturn($data);
		}
		
		$dataObj = ModelBase::getInstance('page_keywords');
		$data['result'] = $dataObj->remove(appendLogicExp('id', '=', $aa['id']));		
		$this->ajaxReturn($data);
	}
	
	// 页面关键字处理
	public function keywordsAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'list') {
				$this->getKeywordsList('post', $_POST);
			} else if ($type == 'save') {
				$this->saveKeywords($_POST);	
			} else if ($type == 'delete') {
				$this->deleteKeywords($_POST);
			} else {
				$data['result'] = error(-1, '错误的操作方式');
				$this->ajaxReturn($data);
			}
		} else {				
			$this->getKeywordsList('get', $_GET);
		}
 	}
}

?>