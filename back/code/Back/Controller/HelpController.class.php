<?php

namespace Back\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackAccountHelp;
use Core\Model\BackLineHelp;

class HelpController extends BackBaseController {
	
	public function testAcion(){
		$this->showPage('Index/test');
	}
	
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
			MyHelp::filterInvalidConds($cds);
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
			
			if ($table == 'station_info') {
				$admin = MyHelp::getLoginAccount(false);
				if (is_error($admin) === false) {
					if ($admin['station_id_data']['key'] !== 'main') {
						$conds = appendLogicExp('id', '=', $admin['station_id'], 'AND', $conds);
					}
				}
			}
			
			$data['sort'] = $sortCols;
			$data['result'] = error(0, '');
			$data['ds'] = $obj->getAll($conds, $startIndex, $pageCount, $total, $sort);
			$data['sql'] = $obj->getLastSql();
			if (is_error($data['ds']) === true) {
				$data['result'] = $data['ds'];
			}
		} else {
			$data['result'] = error(-1, '非法的请求方式');
		}
		$this->ajaxReturn($data);
	}
	
	
	public function list1Action(){
		if (IS_POST) {
			$table = I('post.tab', false);
			if ($table === false) {
				$data['result'] = error(-1, '获取列表对象错误');
				return $this->ajaxReturn($data);
			}
			$prefix = I('post.prefix', '');
			$tabObj = ModelBase::getInstance($table, $prefix);
			$cdsstr = I('post.cdsstr', '');
			$cdtype = I('post.cdtype', false);
			if (!empty($cdsstr) && !empty($cdtype)) {	
				$conds = MyHelp::getCondsByStr($cdsstr, $cdtype, $condsOut);
//				$data['conds_out'] = $condsOut;
//				$data['conds'] = $conds;
			} 
//			$data['cdsstr'] = $cdsstr;
//			$data['cdtype'] = $cdtype;
			$startIndex = I('post.start_index', 0);
			$pageCount = I('post.page_count', 0);			
			
			$sortstr = I('post.sort', '');
			$sortList = explode('|', $sortstr);
			
			$sort = array();
			for($i = 0; $i < count($sortCols); $i+=2){
				if (empty($sortList[$i+1])) {
					continue;
				}
				$sort[$sortList[$i]] = $sortList[$i+1];
			}
			
			if ($table == 'station_info') {
				$admin = MyHelp::getLoginAccount(false);
				if (is_error($admin) === false) {
					if ($admin['station_id_data']['key'] !== 'main') {
						$conds = appendLogicExp('id', '=', $admin['station_id'], 'AND', $conds);
					}
				}
			}
			$findCol = I('post.search_col', false);
			$findStr = I('post.findstr', false);
			$searchCol = explode('|', $findCol);
			if (!empty($findCol) && !empty($findStr)) {	
				foreach ($searchCol as $sk=>$v) {
					$searchConds = appendLogicExp($v, 'LIKE', '%'.$findStr.'%', 'OR', $searchConds);
				}
				$conds = appendLogicExp('search', '=', $searchConds, 'AND', $conds);		
			}
						
			$data['result'] = error(0, '');
			$data['ds'] = $tabObj->getAll($conds, $startIndex, $pageCount, $total, $sort);
			$data['sql'] = $tabObj->getLastSql();
			if (is_error($data['ds']) === true) {
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
			
			$conds = appendLogicExp('data_type_id', '=', $type['id']);
			$opstr = I('post.op', false);
			if (!empty($opstr)) {
				$findConds = appendLogicExp('type_key', 'LIKE', '%'.$opstr.'%', 'OR', $findConds);
				$findConds = appendLogicExp('type_desc', 'LIKE', '%'.$opstr.'%', 'OR', $findConds);
				$conds = appendLogicExp('type', '=', $findConds, 'AND', $conds);
			}
			
			$dataObj = ModelBase::getInstance('type_data');
			$ds = $dataObj->getAll($conds);
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
			
			// 各自站点订单
			$admin = MyHelp::getLoginAccount(false);
			if (is_error($admin) === false) {
				if ($admin['station_id_data']['key'] !== 'main') {
					$conds = appendLogicExp('station_id', '=', $admin['station_id'], 'AND', $conds);
				}
			}
			$conds = appendLogicExp('forbidden', '!=', '1', 'AND', $conds);
			
			$findstr = I('post.findstr', false);
			if (!empty($findstr)) {
				$findConds = appendLogicExp('account', 'LIKE', '%'.$findstr.'%', 'OR', $findConds);
				$findConds = appendLogicExp('nickname', 'LIKE', '%'.$findstr.'%', 'OR', $findConds);
				$conds = appendLogicExp('search', '=', $findConds, 'AND', $conds);
			}
			
			$data['conds'] = $conds;
			$data['result'] = error(0, '');
			$dataObj = ModelBase::getInstance('admin');
			$ds = $dataObj->getAll($conds, 0, 0, $total, array('type_id'=>'asc'));
//			$data['sql'] = $dataObj->getLastSql();
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
		
	// 更新缓存
	private function updateCache($aa) {	
		if (empty($aa['key'])) {
			$data['result'] = error(-1, '更新缓存的参数错误，缓存更新失败');
			return $this->ajaxReturn($data);
		}
		
		$conds = appendLogicExp('key', '=', 'config_update_time');
		if (empty($aa['op'])) {
			$conds = appendLogicExp('type', '=', $aa['key'], 'AND', $conds);
		} else {
			$conds = appendLogicExp('type', 'LIKE', $aa['key'], 'AND', $conds);
		}
		
		if (!empty($aa['station_id'])) {
			$stationId = $aa['station_id'];
			$conds = appendLogicExp('station_id', '=', $stationId, 'AND', $conds);
		} else {
			if (empty($stationId)) {
				$stationId = BackAccountHelp::StationTypeKey2Value('main');
			}
			if ($aa['key'] != 'pc_home_index') {
				if (is_error($stationId) === false) {
					$conds = appendLogicExp('station_id', '=', $stationId, 'AND', $conds);
				}	
			}
		}
		
		if (stripos($ds['type'], 'cache_set_subject') !== FALSE) {
			$id = substr($station['type'], strlen('cache_set_subject_'));
			if (is_numeric($id) === FALSE) {
				$data['result'] = error(-1, '错误的专题编号，不能缓存，Error:'.$id);
				return $this->ajaxReturn($data);		
			}
		} else if (stripos($ds['type'], 'fenxiao_index_config') !== FALSE) {
			$id = substr($station['type'], strlen('fenxiao_index_config_'));
			if (is_numeric($id) === FALSE) {
				$data['result'] = error(-1, '错误的分销账户编号，不能缓存，Error:'.$id);
				return $this->ajaxReturn($data);		
			}
		}
		
		$setObj = ModelBase::getInstance('set');
		$cache = $setObj->getOne($conds);
		if (empty($cache)) {
			$ds['station'] = $stationId;
			$ds['type'] = $aa['key'];
			$ds['key'] = 'config_update_time';
			$ds['value'] = time();
			$ds['group'] = 0;
			$ds['sort'] = 0;			
			$data['result'] = $setObj->create($ds, $setId);
			if (error_ok($data['result']) === true) {
				$ds['id'] = $setId;
				$data['ds'] = $ds;	
			}
		} else {
			$data['result'] = $setObj->modify(array('value'=>time()), $conds);	
		}
		
//		if (error_ok($data['result']) === true) {
//			if (stripos($aa['key'], 'pc_home_index') !== FALSE || stripos($aa['key'], 'pc_home_top_menu') !== FALSE) {				
//				if (!empty($stationId) && is_error($stationId) === false) {
//					$station = MyHelp::TypeDataKey2Value($stationId,true);
//					$data['url1'] = 'http://kllife.com/home/index.php?s=/home/index/welcome/station/'.$station['key'];
//					$data['url2'] = 'http://kllife.com/phone/index.php?s=/phone/index/welcome/station/'.$station['key'];
//				}
//			} else if (stripos($aa['key'], 'cache_set_subject') !== FALSE) {
//				$id = substr($station['key'], strlen('cache_set_subject_')); 
//				$data['url1'] = 'http://kllife.com/home/index.php?s=/home/line/subject/id/'.$id;
//				$data['url2'] = 'http://kllife.com/phone/index.php?s=/phone/line/subject/id/'.$id;				
//			}
//		} 
		
		return $this->ajaxReturn($data);
	}
	
	// 缓存操作
	public function cacheAction() {
		header('Access-Control-Allow-Origin:*');	
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'update') {
				$this->updateCache($_POST);	
			} else {
				$data['result'] = error(-1, '非法的操作类型');
				$this->ajaxReturn($data);
			}
		} else {
			$errPage = errorPage('401', '错误的请求方式', '请求的类型有误', '非法请求');
			$this->assign($errPage);
			$this->display('common/error');
		}
	}
	
	
	// 线路模糊查找
	public function lineFindAction() {
		if (IS_POST) {
			$aa = $_POST;
			$findstr = $aa['q'];
			$data['aa'] = $aa;
			if (trim($findstr) === ""){
				$data['result'] = error(-1, '搜索条件为空');
			} else {
				if (!empty($aa['new_line'])) {
					$admin = MyHelp::getLoginAccount(false);
					if (is_error($admin) === false) {
						if ($admin['station_id_data']['key'] !== 'main') {
							$conds = appendLogicExp('station', 'LIKE', '%\"id\":\"'.$admin['station_id'].'\"%', 'AND', $conds);
						}
					}
					$conds = appendLogicExp('title', 'LIKE', '%'.$findstr.'%', 'AND', $conds);
					$conds = appendLogicExp('invalid', '!=', '1', 'AND', $conds);
					$ds = BackLineHelp::getLineList($conds, 0, 0, $total, array('create_time'=>'desc'), false);
				} else {
					// 线路
					$archiveObj = ModelBase::getInstance('archives', 'xz_');
					$cds = appendLogicExp('channel', '=', '17', 'AND');
					$cds = appendLogicExp('title', 'like', '%'.$findstr.'%', 'AND', $cds);
					$ds = $archiveObj->getAll($cds);
				}
				$data['conds'] = $conds;
				$data['result'] = error(0,'');
				$data['data'] = $ds;
			}
			$this->ajaxReturn($data);		
		} else {
			$data['result'] = error(-1, '请求方式非法');
			return $this->ajaxReturn($data);
		}
	}
	
	// 批次查找
	public function activityFindAction() {
		if (IS_POST) {
			$aa = $_POST;
			if (!empty($aa['new_line'])) {
				if (!empty($aa['aid'])) {
					$conds =  appendLogicExp('line_id', '=', $aa['aid']);
				}
				$ds = BackLineHelp::getBatchList($conds, 0, 0, $total, array('start_time'=>'desc'), false);
				if (!empty($ds)) {
					foreach ($ds as $k=>$v) {
						$ds[$k]['show_text'] = $v['start_date_show'].' -- '.$v['end_date_show'];
					}
				}
			} else {
				// 批次			
				$activityObj = ModelBase::getInstance('lineactivity', 'xz_');
				$colNames = $activityObj->getUserDefine(ModelBase::DF_COL_NAMES);
				$cols = coll_elements_giveup($colNames, $aa);
				$conds = MyHelp::getLogicExp($cols, '=', 'AND');
				// 过滤无效批次
	//			$conds = appendLogicExp('startdate', '>', time(), 'AND', $conds);
				$ds = $activityObj->getAll($conds, 0, 0, $total, 'startdate');
				if (!empty($ds)) {
					foreach ($ds as $k=>$v) {
						$ds[$k]['show_text'] = date('Y年m月d日', $v['startdate']).' -- '.date('Y年m月d日', $v['enddate']);
					}
				}
			}
			$data['data'] = $ds;
			$data['result'] = error(0,'');
			$this->ajaxReturn($data);			
		} else {
			$data['result'] = error(-1, '请求方式非法');
			return $this->ajaxReturn($data);
		}
	}
	
	// 验证码
	// 前台图片设置为
	public function verifyAction(){
		$verify = new \Think\Verify();
		if (IS_GET) {
			ob_clean();
			$verify->imageW = I('get.w', 150);
			$verify->imageH = I('get.h', 40);
			$verify->fontSize = I('get.f', 16); // 验证码字体大小
			$verify->length = I('get.l', 6); // 验证码位数
			$verify->useNoise = false;  // 关闭验证码杂点
			$verify->useCurve = true;  // 关闭曲线混淆
			$verify->useImgBg = false;  // 验证码背景图片 开启验证码背景图片功能 随机使用 ThinkPHP/Library/Think/Verify/bgs 目录下面的图片
			$verify->bg = array(238, 238, 238); // 背景颜色
			$verify->entry(I('get.id', 1));
		} else {
			$code = I('post.code', '');
			$pass = $verify->check($code, I('post.id', 1));
			$data['pass'] = $pass == false ? 0 : 1;
			$this->ajaxReturn($data);
		}
	}
	
	// 美拍
	public function meipaiAction() {
		if (IS_POST) {
			$op = I('post.op', 'list');
			if ($op == 'info') {
				$url = I('post.url', false);
				if (empty($url)) {
					$data['result'] = error(-1, '视频详情的url链接错误');
				}
			} else {
				$url = 'http://newapi.meipai.com/output/channels_topics_timeline.json';
				$id = I('post.id', false);
				if (!empty($id)) {					
					$param = '?id='.$id;
				}
				$topic_name = I('post.topic_name', false);
				if (!empty($topic_name)) {
					if (!empty($param)) {
						$param .= '&topic_name='.$topic_name;
					} else {
						$param = '?topic_name='.$topic_name;
					}
				}
				$count = I('post.count', false);
				if (!empty($count)) {
					if (!empty($param)) {
						$param .= '&count='.$count;
					} else {
						$param = '?count='.$count;
					}
				}
				$page = I('post.page', false);
				if (!empty($page)) {
					if (!empty($param)) {
						$param .= '&page='.$page;
					} else {
						$param = '?page='.$page;
					}
				}
				$feature = I('post.feature', false);
				if (!empty($feature)) {
					if (!empty($param)) {
						$param .= '&feature='.$feature;
					} else {
						$param = '?feature='.$feature;
					}
				}
				$max_id = I('post.max_id', false);
				if (!empty($max_id)) {
					if (!empty($param)) {
						$param .= '&max_id='.$max_id;
					} else {
						$param = '?max_id='.$max_id;
					}
				}
				$url .= $param;				
			}
			
			// 1. 初始化
			 $ch = curl_init();
			 // 2. 设置选项，包括URL
			 curl_setopt($ch,CURLOPT_URL, $url);
			 curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			 curl_setopt($ch,CURLOPT_HEADER,0);
			 // 3. 执行并获取HTML文档内容
			 $output = curl_exec($ch);
			 if($output === FALSE ){
			 	$errMsg = "CURL Error:".curl_error($ch);
			 }
			 // 4. 释放curl句柄
			 curl_close($ch);
			 
			 $data['result'] = empty($errMsg) ? error(0, '') : error(-1, $errMsg);
			 if ($op == 'info') {
			 	$output = substr($output, 16);
			 	$data['ds'] = $output;
			 } else {
			 	$data['ds'] = json_decode($output, true);
			 }
			 $this->ajaxReturn($data);
		}
	}
	
	
		
}

?>