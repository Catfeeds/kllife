<?php

namespace Back\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackLineHelp;
use Core\Model\BackAccountHelp;

define('LINE_LIST_SHOW_COUNT', 10);
define('LINE_QUESTION_LIST_SHOW_COUNT', 10);
define('LINE_ARTICLE_LIST_SHOW_COUNT', 10);
define('LINE_LEADER_LIST_SHOW_COUNT', 10);
define('LINE_BIND_ARTICLE_COUNT', 3);
define('LINE_QUESTION_TEXT_SHOW_COUNT', 23);
define('LINE_VIDEO_LIST_SHOW_COUNT', 12);
define('LINE_COUPON_USER_SHOW_COUNT', 20);
define('LINE_SUBJECT_LIST_SHOW_COUNT', 10);
define('LINE_TAOCAN_LIST_SHOW_COUNT', 10);

class LineController extends BackBaseController {

	protected function _initialize() {		
		$this->page_title = '产品模块';
		$this->content_title_show = 1;
		$this->menu_active = 'line';
	}
	
	public function _empty() {		
		$this->_initBaseInfo('list', 'line', '产品列表', '产品列表内容', '这里你可以查看并管理你的产品信息');
		$this->display('list');
	}
	
	private function getSelect2CDS($valstr) {
		if (empty($valstr)) {
			return '';
		}
		
		$arr = array();
		$vals = json_decode($valstr, true);
		foreach ($vals as $k=>$v) {
			// 对象数组
			if (is_numeric($k)) {
				foreach ($v as $vk=>$vv) {
					if (!empty($vals[$k]['type_desc'])) {
						$arr[count($arr)] = $vals[$k]['type_desc'];
					} else if (!empty($vals[$k]['account'])) {
						$arr[count($arr)] = $vals[$k]['account'];
					} else if (!empty($vals[$k]['name'])) {
						$arr[count($arr)] = $vals[$k]['name'];
					}
					break;
//					$arr[count($arr)] = json_encode($v);
				}
			// 单纯对象
			} else {	// 是否是对象判断
				if (!empty($vals['type_desc'])) {
					$arr[count($arr)] = $vals['type_desc'];
				} else if (!empty($vals['account'])) {
					$arr[count($arr)] = $vals['account'];
				} else if (!empty($vals['key'])) {
					$arr[count($arr)] = $vals['key'];
				}
//				$arr[count($arr)] = $vals;
				break;
			}
		}
		return $arr;
	}
	
	private function getFindListCDS($cds) { 	
		$cdList = array();
		foreach ($cds as $k=>$v) {
			switch($k){
				case 'id': $cdList['id'] = $v; break;
				case 'title': $cdList['title'] = $v; break;
				case 'subheading': $cdList['subheading'] = $v; break;
				case 'start_time': $cdList['start_time'] = $v; break;
				case 'end_time': $cdList['end_time'] = $v; break;
				case 'online': $cdList['online'] = $v; break;
				case 'invalid': $cdList['invalid'] = $v; break;
				case 'station': $cdList['station'] = $this->getSelect2CDS($v); break;
				case 'member_type': $cdList['member_type'] = $this->getSelect2CDS($v); break;
				case 'allow_pay_type': $cdList['allow_pay_type'] = $this->getSelect2CDS($v); break;
				case 'trip_include': $cdList['trip_include'] = $this->getSelect2CDS($v); break;
				case 'manager_admin': $cdList['manager_admin'] = $this->getSelect2CDS($v); break;
				case 'operator_admin': $cdList['operator_admin'] = $this->getSelect2CDS($v); break;
				case 'theme_type': $cdList['theme_type'] = $this->getSelect2CDS($v); break;
				case 'play_type': $cdList['play_type'] = $this->getSelect2CDS($v); break;
				case 'dismiss_place': $cdList['dismiss_place'] = $this->getSelect2CDS($v); break;
				case 'assembly_point': $cdList['assembly_point'] = $this->getSelect2CDS($v); break;
				case 'destination': $cdList['destination'] = $this->getSelect2CDS($v); break;
				case 'view_point': $cdList['view_point'] = $this->getSelect2CDS($v); break;
				case 'hotel_type': $cdList['hotel_type'] = $this->getSelect2CDS($v); break;
				case 'trip_month': $cdList['trip_month'] = $this->getSelect2CDS($v); break;
				default: break;
			}
		}
		
		MyHelp::filterInvalidConds($cdList);
		return $cdList;
	}
	
	// 产品列表展示
	public function listAction() {	
		$sort = array('online'=>'desc','recommend'=>'desc', 'hot'=>'desc','leader_recommend'=>'desc','sort'=>'asc','create_time'=>'desc');
		if (IS_POST) {
			$startIndex = 0;
			$pageIndex = I('post.page', false);
			if ($pageIndex !== false) {
				$startIndex = $pageIndex * LINE_LIST_SHOW_COUNT;
			}
			
			$postCDS = I('post.cds', false);
			if ($postCDS !== false) {
				$postCDS = htmlspecialchars_decode($postCDS);
				$postCDS = explode('|',$postCDS);
				for($i = 0; $i < count($postCDS); $i+=2){
					$pcds[$postCDS[$i]] = $postCDS[$i+1];
				}
				$cds = $this->getFindListCDS($pcds);
				foreach($cds as $k=>$v) {
					if ($k === 'start_time') {
						$conds = appendLogicExp('start_time', '>=', $v, 'AND', $conds);
						continue;
					}
					if ($k === 'end_time') {
						$conds = appendLogicExp('end_time', '<=', $v, 'AND', $conds);
						continue;
					}
					if (is_array($v)) {
						$arrayConds = array();				
						foreach($v as $vk=>$vv) {
							$arrayConds = appendLogicExp($k, 'LIKE', '%'.$vv.'%', 'OR', $arrayConds);
						}
						if (!empty($arrayConds)) {
							$conds = appendLogicExp($k, 'LIKE', $arrayConds, 'AND', $conds);
						}
					} else {
						if (is_numeric($v)) {
							$conds = appendLogicExp($k, '=', $v, 'AND', $conds);	
						} else {
							$conds = appendLogicExp($k, 'LIKE', '%'.$v.'%', 'AND', $conds);	
						}
					}
				}		
			}
		
			// 各自站点订单
			$admin = MyHelp::getLoginAccount(false);
			if (is_error($admin) === false) {
				if ($admin['station_id_data']['key'] !== 'main') {
					$conds = appendLogicExp('station', 'LIKE', '%\"id\":\"'.$admin['station_id'].'\"%', 'AND', $conds);
				}
			}
		
			$find = array('point'=>true,'travel'=>true,'scenery'=>true,'batch'=>true,'offer'=>true);
			$ds = BackLineHelp::getLineList($conds, $startIndex, LINE_LIST_SHOW_COUNT, $total, $sort, $find, $out);
			$data['out'] = $out;
		
			$pageCount = intval($total / LINE_LIST_SHOW_COUNT);
			if (intval($total % LINE_LIST_SHOW_COUNT) > 0) {
				$pageCount += 1;
			}
			$data['conds'] = $conds;
			$data['page_count'] = $pageCount;
			$data['total'] = $total;
			$data['result'] = error(0,"");
			$data['ds'] = $ds;
			$this->ajaxReturn($data);
		} else {
			// 各自站点订单
			$admin = MyHelp::getLoginAccount(false);
			if (is_error($admin) === false) {
				if ($admin['station_id_data']['key'] !== 'main') {
					$conds = appendLogicExp('station', 'LIKE', '%'.$admin['station_id_data']['name'].'%', 'AND', $conds);
				}
			}
			$find = array('point'=>true,'travel'=>true,'scenery'=>true,'batch'=>true,'offer'=>true);			
			$ds = BackLineHelp::getLineList($conds, 0, LINE_LIST_SHOW_COUNT, $total, $sort, $find);	
			$pageCount = intval($total / LINE_LIST_SHOW_COUNT);
			if (intval($total % LINE_LIST_SHOW_COUNT) > 0) {
				$pageCount += 1;
			}			
			$this->assign('page_count', $pageCount);				
			$this->assign('lines', $ds);
			$this->assign('show_count', LINE_LIST_SHOW_COUNT);
			$this->assign('modal_type_data', true);
		
			$this->_initBaseInfo('line_list', 'line', '产品列表', '产品列表内容', '这里你可以查看并管理你的产品信息');
			$this->display('list');
		}
	}
	
	// 查找产品
	public function findAction() {
		if (IS_POST) {
			$aa = $_POST;			
			$data['result'] = error(0, '');
			$lineObj = ModelBase::getInstance('line');
			$colNames = $lineObj->getUserDefine(ModelBase::DF_COL_NAMES);
			
			$find = array(
				'min_batch'=>true,
				'point'=>true,
				'phone_point'=>true,
				'travel'=>true,
				'scenery'=>true,
				'batch'=>true,
				'offer'=>true,
				'question'=>array('answer'=>true, 'account'=>true),
//				'article'=>array('content'=>true),
				'set'=>true,
			);
				
			$opType = I('post.op_type', false);
			
			$colCDS = coll_elements_giveup($colNames, $aa);
			$conds = MyHelp::getLogicExp($colCDS, '=', 'AND');
			// 各自站点订单
			$loginAcct = MyHelp::getLoginAccount(true);
			if (is_error($loginAcct) === false) {
				if ($loginAcct['station_id_data']['key'] !== 'main') {
					$conds = appendLogicExp('station', 'LIKE', '%\"id\":\"'.$loginAcct['station_id'].'\"%', 'AND', $conds);
				}
			}
			if ($opType == 'find') {			
				$line = BackLineHelp::getLine($conds, $find);
				if (!empty($line)) {
					$data['ds'] = $line;
				} else {
					$data['result'] = error(-1, '未能查找到产品');
				}
			} else if ($opType == 'last') {
				$conds = appendLogicExp('create_admin_id', '=', $loginAcct['id'], 'AND', $conds);
				$lines = BackLineHelp::getLineList($conds, 0, 1, $total, array('create_time'=>'desc'),$find);
				if (!empty($lines)) {
					$data['ds'] = $lines[0];	
				} else {
					$data['result'] = error(-1, '未能查找到产品');
				}
			} else {
				$data['result'] = error(-1, '错误的操作方式，查询线路信息失败');
			}
		} else {
			$data['result'] = error(-1, '错误的请求方式，查询线路信息失败');
		}
		$this->ajaxReturn($data);
	}
	
	// 创建产品
	private function createLine($aa) {
		if (check_grant('line_base_edit') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		$lineObj = ModelBase::getInstance('line');
		$colNames = $lineObj->getUserDefine(ModelBase::DF_COL_NAMES);	
		$ds = coll_elements_giveup($colNames,$aa);
		
		if (empty($ds['title'])) {
			$data['ds'] = $ds;
			$data['result'] = error(-1, '参数不齐全，不能创建线路');
			return $this->ajaxReturn($data);
		}
		
		$loginAcct = MyHelp::getLoginAccount(true);
		if (is_error($loginAcct)) {
			$data['result'] = $loginAcct;
			return $this->ajaxReturn($data);
		}
		
		if (!empty($ds['cost_description'])) {
			$ds['cost_description'] = htmlspecialchars($ds['cost_description']);
		}
		
		if (!empty($ds['booking_notes'])) {
			$ds['booking_notes'] = htmlspecialchars($ds['booking_notes']);
		}
		
		$adminStation = $loginAcct['station_id_data'];
		
		$ds['create_admin_id'] = $loginAcct['id'];
		$ds['lock_admin_id'] = $loginAcct['id'];
		$ds['station'] = json_encode(array(array('id'=>$adminStation['id'], 'key'=>$adminStation['key'], 'name'=>$adminStation['name'])));
		$ds['lock'] = 1;
		$ds['sell_count'] = 0;
		$ds['invalid'] = 0;
		$ds['create_time'] = fmtNowDateTime();	
		
		$data['ds'] = $ds;	
				
		$data['result'] = $lineObj->create($ds, $lineId);
		$data['id'] = $lineId;
		$this->ajaxReturn($data);
	}	
	
	// 修改产品
	private function updateLine($aa) {
		if (check_grant('line_base_edit') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		if (empty($aa['id'])) {
			$data['result'] = error(-1, '条件参数不齐全，更新产品线路失败');
			return $this->ajaxReturn($data);
		}
		$lineObj = ModelBase::getInstance('line');
		$colNames = $lineObj->getUserDefine(ModelBase::DF_COL_NAMES);	
		$ds = coll_elements_giveup($colNames, $aa);			
		unset($ds['id']);
		
		$conds = appendLogicExp('id', '=', $aa['id']);	
		// 检测行程天数
		if (!empty($ds['travel_day'])) {		
			$line = BackLineHelp::getLine($conds);
			if ($line['travel_day'] != $ds['travel_day']) {
				$travelObj = ModelBase::getInstance('travel_intro');
				$travelCount = $travelObj->getCount(appendLogicExp('line_id', '=', $aa['id']));
				if (intval($ds['travel_day']) < $travelCount) {
					$data['result'] = error(-1, '修改的行程天数少于现有设计的行程，请对行程详细进行删减后再次修改');
					return $this->ajaxReturn($data);
				}
				
				$batchObj = ModelBase::getInstance('batch');
				$travelSecond = intval($ds['travel_day']) * 24 * 60 * 60 - 1;
				$batchSql = 'UPDATE `kl_batch` SET `end_time`=FROM_UNIXTIME(UNIX_TIMESTAMP(`start_time`)+'.$travelSecond.') WHERE `line_id`='.$aa['id'];
				$data['batch_result'] = $batchObj->execute($batchSql);			
			}
		}
		
		// 上下线设置
		if (!empty($ds['online'])) {
			if ($ds['online'] == 1) {
				$ds['online_time'] = fmtNowDateTime();
			}
		}
		
		if (!empty($ds['cost_description'])) {
			$ds['cost_description'] = htmlspecialchars($ds['cost_description']);
		}
		
		if (!empty($ds['booking_notes'])) {
			$ds['booking_notes'] = htmlspecialchars($ds['booking_notes']);
		}
		
		$admin = MyHelp::getLoginAccount(false);
		if (is_error($admin) === false && $admin['account'] != 'admin') {
			if (!empty($ds['station'])) {
				unset($ds['station']);
			}	
		} 
		
		$data['result'] = $lineObj->modify($ds, $conds);
//		if ($data['result']['errno'] === -4) {
//			$data['result']['errno'] = 0;
//		}
		$this->ajaxReturn($data);
	}
	
	// 获取编辑链接
	private function lockEdit($aa) {
		if (empty($aa['id'])) {
			$data['result'] = error(-1, '线路的编号存在问题，不能编辑');
			return $this->ajaxReturn($data);
		}
		
		$line = BackLineHelp::getLine(appendLogicExp('id', '=', $aa['id']));
		if (empty($line)) {
			$data['result'] = error(-1, '未能找到线路信息，不能编辑');
			return $this->ajaxReturn($data);
		}
		
		if (empty($aa['unlock'])) {
			if ($line['lock'] == '1') {
				$admin = BackAccountHelp::getAccount('account_admin', $line['lock_admin_id']);
				if (is_error($admin)) {
					$data['result'] = error(-1, '这条线路出现锁定错误，请寻求管理员予以解锁');
				} else {
					$data['result'] = error(-1, '这条产品线路已经被管理员【'.$admin['show_name'].'】锁定，请联系此人或寻求管理员帮助解锁');	
				}
				return $this->ajaxReturn($data);
			}
			
			$data['result'] = error('0', '');
			$data['jumpUrl'] = U('line/create', array('id'=>$aa['id']));			
		} else {
			$admin = MyHelp::getLoginAccount(true);
			if (is_error($admin)) {
				$data['result'] = $admin;
				return $this->ajaxReturn($data);
			}
			
			if ($admin['account'] != 'admin') {
				if ($admin['id'] != $line['lock_admin_id']) {
					$lockAdmin = BackAccountHelp::getAccount('account_admin', appendLogicExp('id', '=', $line['lock_admin_id']));
					if (is_error($lockAdmin) === false) {
						$data['result'] = error(-1, '您并非加锁之人，没有解锁的权限，请向管理员【'.$lockAdmin['show_name'].'】寻求帮助');
					} else {
						$data['result'] = error(-1, '您并非加锁之人，没有解锁的权限，请向【超级管理员】寻求帮助');
					}
					return $this->ajaxReturn($data);
				}
			}
			$ds['lock'] = 0;
			$ds['lock_admin_id'] = 0;
			$lineObj = ModelBase::getInstance('line');
			$data['result'] = $lineObj->modify($ds, appendLogicExp('id', '=', $line['id']));
			if (error_ok($data['result']) === true) {
				$data['result'] = error(0, '解锁成功');
			}
		}
		$this->ajaxReturn($data);
	}
	
	// 预览产品
	private function previewLine($aa) {
		$lineObj = ModelBase::getInstance('line');
		$val['salt'] = substr(uniqid(rand()), -8);
		$val['time'] = fmtNowDateTime();
		$ds['preview_salt'] = json_encode($val);
		$data['result'] = $lineObj->modify($ds, appendLogicExp('id', '=', $aa['id']));
		$data['salt'] = $val['salt'];
		$this->ajaxReturn($data);
	}
	
	// 设置产品相关内容
	private function configLine($aa) {
		if (IS_POST) {
			$setObj = ModelBase::getInstance('line_set');
			$colNames = $setObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$ds = coll_elements_giveup($colNames, $aa);
						
			if (empty($ds['id'])) {
				$data['result'] = $setObj->create($ds, $ds['id']);
			} else {
				unset($ds['id']);
				$data['result'] = $setObj->modify($ds, appendLogicExp('id', '=', $aa['id']));				
			}
						
			if (error_ok($data['result']) == true) {				
				$valType = $ds['value_type'];
				if (!empty($valType)) {
					if (strtolower($valType) == 'line') {
						$ds['value'] = BackLineHelp::getLine(appendLogicExp('id', '=', $ds['value']));
					}
				}
			}
			$data['ds'] = $ds;			
			$this->ajaxReturn($data);
		}
	}
	
	// 创建产品
	public function createAction() {
		if (IS_POST) {
			$opType = I('post.op_type', false);
			if ($opType == 'create') {
				$this->createLine($_POST);
			} else if ($opType == 'edit') {
				$this->updateLine($_POST);
			} else if ($opType == 'lock') {
				$this->lockEdit($_POST);
			} else if ($opType == 'preview') {
				$this->previewLine($_POST);
			} else if ($opType == 'set') {
				$this->configLine($_POST);
			} else {
				$data['result'] = error(-1, '错误的处理类型，创建线路产品失败');
				$this->ajaxReturn($data);
			}
		} else {			
			$admin = MyHelp::getLoginAccount(true);
			if (is_error($admin) === true) {
				return $this->display('user/login');
			}
			
			// 是否是包团线路
			$isTeamGroup = I('get.tg', 0);
			// 锁定编辑
			$lineId = I('get.id', false);			
			if (!empty($lineId)) {
				$ds['lock'] = 1;
				$ds['lock_admin_id'] = $admin['id'];
				$lineObj = ModelBase::getInstance('line');
				$lineObj->modify($ds, appendLogicExp('id', '=', $lineId));
				$this->assign('lineId', $lineId);
				
				$line = $lineObj->getOne(appendLogicExp('id', '=', $lineId));
				if (!empty($line)) {
					$isTeamGroup = $line['team_group'];	
				}
			}			
			$this->assign('team_group', $isTeamGroup);
			
			// 套餐列表
			$taocans = BackLineHelp::getTaocanList(appendLogicExp('invalid', '=', 0),0,0);
			foreach ($taocans as $tk=>$tv) {
				$key = $tv['type_data']['id'];
				if (empty($taocanList[$key])) {
					$taocan['type'] = $tv['type_data'];
					$taocan['data'] = array($tv);
					$taocanList[$key] = $taocan;
				} else {
					$taocan = $taocanList[$key];
					array_push($taocan[data], $tv);
					$taocanList[$key] = $taocan;
				}
			}
			$this->assign('taocans', $taocanList);
			
			//套餐价格列表
			$find = array('batch'=>true,'taocan'=>true);
			$conds = appendLogicExp('line_id', '=', $lineId);
			$conds = appendLogicExp('invalid', '=', 0, 'AND', $conds);
			$taocanPrices = BackLineHelp::getTaocanPriceList($conds, 0, 0, $totalCount, array('batch_id'=>'asc'), $find);
			$this->assign('taocanPrices', $taocanPrices);
			
			// 图片类型
			$imageTypeObj = ModelBase::getInstance('image_type');
			$imageTypes = $imageTypeObj->getAll();
			$this->assign('ImageTypes', $imageTypes);	
			
			// 图片来源
			$fromTypeObj = ModelBase::getInstance('image_from_type');
			$fromTypes = $fromTypeObj->getAll();
			$this->assign('ImageFroms', $fromTypes);			
			
			// 内容类型
			$contentTypeObj = ModelBase::getInstance('image_content_type');			
			$contentTypes = $contentTypeObj->getAll();
			$this->assign('ImageContents', $contentTypes);
			
			// 地域类型
			$domainItemTypeId = MyHelp::IdEachTypeKey('menu_type', 'region_menu');
			if (is_error($domainItemTypeId) === false) {
				$domainTypeObj = ModelBase::getInstance('menu_item');
				$conds = appendLogicExp('menu_type_id', '=', $domainItemTypeId);
				$conds = appendLogicExp('parent_id', '=', '0', 'AND', $conds);
				$domainTypes = $domainTypeObj->getAll($conds);
				$this->assign('ImageDomains', $domainTypes);
			}
			
			$this->assign('modal_look_image', true);
			$this->assign('modal_type_data', true);
//			$this->assign('modal_line_article', true);
			$this->assign('modal_line_list', true);
			
			$this->_initFloatImageSelector();
			$this->_initBaseInfo('line_create', 'line', '产品生成', '产品生成', '这里你可以创建并生成一个产品');
			$this->display('new');
		}
	}
	
	// 更新产品
	public function updateAction() {
		if (IS_POST) {
			if (check_grant('line_base_edit') === false) {
				$data['result'] = error(-1, '您没有此操作权限');
				return $this->ajaxReturn($data);
			}
			$aa = $_POST;
			$cdList = explode(',',$aa['cds']);
			for($i = 0; $i < count($cdList); $i+=2){
				$cds[$cdList[$i]] = $cdList[$i+1];
			}
			$cds = $this->getFindListCDS($cds);
			$colCDS = coll_elements_giveup($colNames, $cds);
			$conds = MyHelp::getLogicExp($colCDS, '=', 'AND');
			
			$ds = coll_elements_giveup($colNames, $aa);
			$data['result'] = BackLineHelp::updateLine($ds, $conds);			
		} else {
			$data['result'] = error(-1, '错误的请求方式，产品更新失败');
		}
		$this->ajaxReturn($data);
	}
	
	// 创建行程亮点
	private function createLinePoint($aa) {
		if (check_grant('line_base_edit') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		if (empty($aa['line_id']) || empty($aa['index']) || empty($aa['type_id'])) {
			$data['result'] = error(-1, '参数不足，行程亮点创建失败');
			return $this->ajaxReturn($data);
		}
		
		$pointObj = ModelBase::getInstance('line_point_scenery');
		if ($aa['type_id'] == 1) {
			$typeId = MyHelp::IdEachTypeKey('type_data', 'line_point_content_pc_view');
		} else if ($aa['type_id'] == 2) {
			$typeId = MyHelp::IdEachTypeKey('type_data', 'line_point_content_scenery');
		} else if ($aa['type_id'] == 3) {
			$typeId = MyHelp::IdEachTypeKey('type_data', 'line_point_content_article');
		} else if ($aa['type_id'] == 4) {
			$typeId = MyHelp::IdEachTypeKey('type_data', 'line_point_content_phone_view');
		} else {
			$data['result'] = error(-1, '参数错误，内容类型有误');
			return $this->ajaxReturn($data);
		}
		// 索引偏移
		$conds = appendLogicExp('line_id', '=', $aa['line_id'], 'AND');
		$conds = appendLogicExp('type_id', '=', $typeId, 'AND', $conds);
		$conds = appendLogicExp('index', '>=', $aa['index'], 'AND', $conds);
		$data['update_result'] = $pointObj->fieldAddAndSub($conds, '`index`', 1, true);
		
		// 添加新数据
		$colName = $pointObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colName, $aa);
		if (!empty($ds['content'])) {
			$ds['content'] = htmlspecialchars($ds['content']);
		} 
		
		$ds['type_id'] = $typeId;
		$ds['create_time'] = fmtNowDateTime();
		$result = $pointObj->create($ds, $pointId);
		$data['result'] = $result;
		if (error_ok($result) === true) {
			$data['id'] = $pointId;
		}
		return $this->ajaxReturn($data);
	}
	
	// 行程亮点排序偏移
	private function offsetLinePoint($aa) {
		if (check_grant('line_base_edit') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		if (!array_key_exists('id', $aa) || !array_key_exists('offset', $aa) || !array_key_exists('up',$aa)) {
			$data['result'] = error(-1, '参数不足，行程亮点排序偏移失败');
			return $this->ajaxReturn($data);
		}
		
		if ($aa['offset'] == 0) {
			$data['result'] = error(-2, '偏移值不能为0，行程亮点排序失败');
			return $this->ajaxReturn($data);
		}
		
		$pointObj = ModelBase::getInstance('line_point_scenery');
		$point = $pointObj->getOne(appendLogicExp('id', '=', $aa['id']));
		if (empty($point)) {
			$data['result'] = error(-3, '未能找到行程亮点信息，排序失败');
			return $this->ajaxReturn($data);
		}
		
		$conds = appendLogicExp('line_id', '=', $point['line_id']);
		$conds = appendLogicExp('type_id', '=', $point['type_id'], 'AND', $conds);
		$maxmin = $pointObj->getEspicalCdStr(array('MIN(`index`)'=>'mi', 'MAX(`index`)'=>'ma'), $conds);
		if (empty($maxmin)) {
			$data['result'] = error(0, '没有最大最小信息');
			return $this->ajaxReturn($data);
		}
		
		$newIndex = intval($point['index']) + intval($aa['offset']);
		if ($newIndex < $maxmin[0]['mi']) {
			if ($point['index'] == $maxmin[0]['mi']) {
				$data['result'] = error(-4, '已经是最小索引了！不能再向前移动');
				return $this->ajaxReturn($data);
			}
			$newIndex = $maxmin[0]['mi'];
		}
		
		if ($newIndex > intval($maxmin[0]['ma'])) {
			if ($point['index'] == $maxmin[0]['ma']) {
				$data['result'] = error(-5, '已经是最大索引了！不能再向后移动');
				return $this->ajaxReturn($data);
			}
			$newIndex = $maxmin[0]['ma'];
		}
		if ($aa['up'] == 1) {
			$conds = appendLogicExp('index', '>=', $newIndex, 'AND', $conds);
			$conds = appendLogicExp('index', '<', $point['index'], 'AND', $conds);
			$bAdd = true;
		} else {
			$conds = appendLogicExp('index', '>', $point['index'], 'AND', $conds);
			$conds = appendLogicExp('index', '<=', $newIndex, 'AND', $conds);
			$bAdd = false;
		}
		$data['result'] = $pointObj->fieldAddAndSub($conds, '`index`', 1, $bAdd);
		if (error_ok($data['result']) === true) {
			$data['result'] = $pointObj->modify(array('index'=>$newIndex), appendLogicExp('id', '=', $aa['id']));
			if (error_ok($data['result']) === true) {
				$data['sort_index'] = $newIndex;
			}
		}
		$this->ajaxReturn($data);
	}
	
	// 行程亮点编辑
	private function editLinePoint($aa) {
		if (check_grant('line_base_edit') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		if (empty($aa['id'])) {
			$data['result'] = error(-1, '参数不足，行程亮点编辑失败');
			return $this->ajaxReturn($data);
		}
		$pointObj = ModelBase::getInstance('line_point_scenery');
		$colName = $pointObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colName, $aa);
		if (!empty($ds['content'])) {
			$ds['content'] = htmlspecialchars($ds['content']);
		} 
		unset($ds['id']);
		$data['result'] = $pointObj->modify($ds, appendLogicExp('id', '=', $aa['id']));
		if ($data['result']['errno'] == -4) {
			$data['result'] = error('0', $data['result']['message']);
		}
		return $this->ajaxReturn($data);
	}
	
	// 行程亮点删除
	private function deleteLinePoint($aa) {
		if (check_grant('line_base_edit') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		if (empty($aa['id'])) {
			$data['result'] = error(-1, '参数不足，行程亮点删除失败');
			return $this->ajaxReturn($data);
		}
		$pointObj = ModelBase::getInstance('line_point_scenery');
		$conds = appendLogicExp('id', '=', $aa['id']);
		$point = $pointObj->getOne($conds);
		if (empty($point)) {
			$data['result'] = error(-1, '要删除的行程亮点不存在');
			return $this->ajaxReturn($data);
		}
		
		$data['result'] = $pointObj->remove(appendLogicExp('id', '=', $aa['id']));
		if (error_ok($data['result']) === true) {
			// 偏移其他行程亮点索引
			$conds = appendLogicExp('index', '>', $point['index']);
			$conds = appendLogicExp('type_id', '=', $point['type_id'], 'AND', $conds);
			$conds = appendLogicExp('line_id', '=', $point['line_id'], 'AND', $conds);
			$data['offset_result'] = $pointObj->fieldAddAndSub($conds, '`index`', 1, false);;
		}
		return $this->ajaxReturn($data);
				
	}
	
	// 行程亮点与沿途风光
	public function linepointAction() {
		if (IS_POST) {
			$aa = $_POST;
			$opType = I('post.op_type', false);
			if ($opType == 'create') {
				return $this->createLinePoint($aa);
			} else if ($opType == 'sort_offset') {
				return $this->offsetLinePoint($aa);
			} else if($opType == 'save') {
				return $this->editLinePoint($aa);
			} else if($opType == 'delete') {
				return $this->deleteLinePoint($aa);
			} else {
				$data['result'] = error(-1, '错误的操作方式，行程亮点操作失败');
			}
		} else {
			$data['result'] = error(-1, '错误的请求方式，行程亮点操作失败');
		}
		return $this->ajaxReturn($data);
	}
	
	// 创建行程
	private function createTravelDay($aa) {
		if (check_grant('line_base_edit') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		if (empty($aa['line_id']) || empty($aa['day_id'])) {
			$data['result'] = error(-1, '参数不齐全，不能创建产品行程');
			return $this->ajaxReturn($data);
		}
		
		
		$travelObj = ModelBase::getInstance('travel_intro');
		$dayCount = $travelObj->getCount(appendLogicExp('line_id', '=', $aa['line_id']));
		if ($dayCount > intval($aa['day_count'])-1) {
			$data['result'] = error(-2, '行程天数超出范围，不能创建产品行程');
			return $this->ajaxReturn($data);
		}
		
		// 偏移其他行程天数
		$conds = appendLogicExp('day_id', '>=', $aa['day_id'], 'AND');
		$conds = appendLogicExp('line_id', '=', $aa['line_id'], 'AND', $conds);
		$data['offset_result'] = $travelObj->fieldAddAndSub($conds, 'day_id', 1);
		
		// 创建行程
		$colNames = $travelObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNames, $aa);
		
		
		if (!empty($ds['intro'])) {
			$ds['intro'] = htmlspecialchars($ds['intro']);
		}
		if (!empty($ds['kindly_reminder'])) {
			$ds['kindly_reminder'] = htmlspecialchars($ds['kindly_reminder']);
		}	
		
		
		$result = $travelObj->create($ds, $travelId);
		$data['result'] = $result;
		if (error_ok($result)) {
			$ds['id'] = $travelId;
			$data['id'] = $travelId;
			$data['ds'] = $ds;
		}
		return $this->ajaxReturn($data);
	}
	
	// 保存行程
	private function saveTravelDay($aa) {
		if (check_grant('line_base_edit') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		if (empty($aa['id'])) {
			$data['result'] = error(-1, '参数不齐全，不能保存产品行程');
			return $this->ajaxReturn($data);
		}
		
		$travelObj = ModelBase::getInstance('travel_intro');
		$conds = appendLogicExp('id', '=', $aa['id']);		
		
		$colNames = $travelObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$saveData = coll_elements_giveup($colNames, $aa);
		$ds = $saveData;
		unset($saveData['id']);	
		
		if (!empty($saveData['intro'])) {
			$saveData['intro'] = htmlspecialchars($saveData['intro']);
		}
		if (!empty($saveData['kindly_reminder'])) {
			$saveData['kindly_reminder'] = htmlspecialchars($saveData['kindly_reminder']);
		}		
		
		if (!empty($saveData)) {
			$data['result'] = $travelObj->modify($saveData, $conds);
			if (error_ok($data['result']) === true || $data['result']['errno'] == -4) {
				$data['result'] = error('0', $data['result']['message']);
				$data['ds'] = $ds;
 			}
		} else {
			$data = error(-2, '要更新的数据为空');			
		}
		unset($saveData);
		unset($colNames);
		return $this->ajaxReturn($data);
	}
	
	// 删除行程
	private function deleteTravelDay($aa) {
		if (check_grant('line_base_edit') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		if (empty($aa['id'])) {
			$data['result'] = error(-1, '参数不齐全，不能删除产品行程');
			return $this->ajaxReturn($data);
		}
			
		$travelObj = ModelBase::getInstance('travel_intro');
		$conds = appendLogicExp('id', '=', $aa['id']);
		$travel = $travelObj->getOne($conds);
		if (empty($travel)) {
			$data['result'] = error(-1, '要删除的行程不存在');
			return $this->ajaxReturn($data);
		}
		
		$data['result'] = $travelObj->remove($conds);
		if (error_ok($data['result']) === true) {
			// 偏移其他行程天数
			$conds = appendLogicExp('day_id', '>', $travel['day_id']);
			$conds = appendLogicExp('line_id', '=', $travel['line_id'], 'AND', $conds);
			$data['offset_result'] = $travelObj->fieldAddAndSub($conds, 'day_id', 1, false);;
		}
		return $this->ajaxReturn($data);
	}	
	
	// 行程安排
	public function traveldayAction(){
		if (IS_POST) {
			$aa = $_POST;
			$opType = I('post.op_type', false);
			if ($opType == 'create') {
				return $this->createTravelDay($aa);
			} else if($opType == 'save') {
				return $this->saveTravelDay($aa);
			} else if($opType == 'delete') {
				return $this->deleteTravelDay($aa);
			} else {
				$data['result'] = error(-1, '错误的操作方式，行程详细操作失败');
			}
		} else {
			$data['result'] = error(-1, '错误的请求方式，行程详细请求失败');
		}
		return $this->ajaxReturn($data);
	}
	
	// 创建批次
	private function createBatch($aa) {
		if (check_grant('line_batch_edit') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		
		if (empty($aa['line_id']) || empty($aa['start_time']) || empty($aa['state']) || empty($aa['use_state'])) {
			$data['result'] = error(-1, '产品起始日期、批次状态、使用状态不能为空，创建批次失败');
			return $this->ajaxReturn($data);
		}
		
		$batchObj = ModelBase::getInstance('batch');
		$colName = $batchObj->getUserDefine(ModelBase::DF_COL_NAMES);
		
		$line = BackLineHelp::getLine(appendLogicExp('id', '=', $aa['line_id']));
		if (empty($line)) {
			$data['result'] = error(-1, '产品线路不存在，创建批次失败');
			return $this->ajaxReturn($data);
		}
		
		$ds = coll_elements_giveup($colName, $aa);
		if (!empty($ds['start_time'])) {
			$unix_start_time = strtotime($aa['start_time']);
			if (!empty($aa['start_before_day'])) {
				$sign = intval($aa['start_before_day']) < 0 ? '+' : '-';
				$day = abs($aa['start_before_day']);
				$unix_stop_time = strtotime($sign.$day.' days', $unix_start_time);
				$ds['stop_time'] = date('Y-m-d H:i:s', $unix_stop_time);
			} else {
				$ds['stop_time'] = $aa['start_time'];
			}
			
			$unix_end_time = strtotime('+'.(intval($line['travel_day'])-1).' days 23 hours 59 minutes 59 seconds', $unix_start_time);
			$ds['end_time'] = date('Y-m-d H:i:s', $unix_end_time);
		}		
		$ds['sub_member'] = $ds['car_member'] * $ds['car_number'];
		$data['result'] = $batchObj->create($ds, $batchId);
		if (error_ok($data['result'])) {			
			$data['ds'] = BackLineHelp::getBatch(appendLogicExp('id', '=', $batchId));
		}
		$this->ajaxReturn($data);
	}
	
	// 编辑批次
	private function saveBatch($aa) {
		if (check_grant('line_batch_edit') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		if (!array_key_exists('id', $aa)) {
			$data['result'] = error(-1, '条件参数不齐全，不能修改产品批次');
			return $this->ajaxReturn($data);
		}
		
		$line = BackLineHelp::getLine(appendLogicExp('id', '=', $aa['line_id']));
		if (empty($line)) {
			$data['result'] = error(-1, '产品线路不存在，批次更新失败');
			return $this->ajaxReturn($data);
		}
		
		$batchObj = ModelBase::getInstance('batch');
		$colName = $batchObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colName, $aa);		
		if (!empty($ds['start_time'])) {
			$ds['start_time'] .= ' 00:00:00';
			$unix_start_time = strtotime($aa['start_time']);
			if (!empty($aa['start_before_day'])) {
				$sign = intval($aa['start_before_day']) < 0 ? '+' : '-';
				$day = abs($aa['start_before_day']);
				$unix_stop_time = strtotime($sign.$day.' days', $unix_start_time);
				$ds['stop_time'] = date('Y-m-d H:i:s', $unix_stop_time);
			} else {
				$ds['stop_time'] = $aa['start_time'];
			}
			
			$unix_end_time = strtotime('+'.(intval($line['travel_day'])-1).' days 23 hours 59 minutes 59 seconds', $unix_start_time);
			$ds['end_time'] = date('Y-m-d H:i:s', $unix_end_time);
		}
		
		if (array_key_exists('car_member', $ds) && array_key_exists('car_number', $ds)) {
			$ds['sub_member'] = $ds['car_member'] * $ds['car_number'];
		}
		
		unset($ds['id']);
		$data['result'] = $batchObj->modify($ds, appendLogicExp('id', '=', $aa['id']));
		if (error_ok($data['result'])) {			
			$data['ds'] = BackLineHelp::getBatch(appendLogicExp('id', '=', $aa['id']));
		}
		$this->ajaxReturn($data);
	}
	
	// 删除批次
	private function deleteBatch($aa) {
		if (check_grant('line_batch_edit') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		if (!array_key_exists('id', $aa)) {
			$data['result'] = error(-1, '条件参数不齐全，不能删除产品批次');
			return $this->ajaxReturn($data);
		}
		
		$batchObj = ModelBase::getInstance('batch');
		$data['result'] = $batchObj->modify(array('invalid'=>'1'), appendLogicExp('id', '=', $aa['id']));
		$this->ajaxReturn($data);		
	}
	
	// 查找批次
	private function findBatch($aa) {
		$batchObj = ModelBase::getInstance('batch');
		$colName = $batchObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colName, $aa);		
		$conds = MyHelp::getLogicExp($ds, '=', 'AND');
		
		$data['ds'] = BackLineHelp::getBatch($conds, array('cut_money'=>1));
		$data['result'] = error(0, ''); 
		$this->ajaxReturn($data);		
	}
	
	// 显示批次
	private function listBatch($aa) {
		$batchObj = ModelBase::getInstance('batch');
		$colName = $batchObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colName, $aa);
		
		$conds = MyHelp::getLogicExp($ds, '=', 'AND');
		
		if (array_key_exists('start_begin', $aa)) {
			$startList = explode(',', $aa['start_begin']);
			$conds = appendLogicExp('start_time', $startList[0], $startList[1], 'AND', $conds);
			unset($startList);
		}
		
		if (array_key_exists('start_end', $aa)) {
			$endList = explode(',', $aa['start_end']);
			$conds = appendLogicExp('start_time', $endList[0], $endList[1], 'AND', $conds);
			unset($endList);
		}
		
		$data['conds'] = $conds;
		$data['ds'] = BackLineHelp::getBatchList($conds, 0, 0, $total, array('start_time'=>'asc'));
		$data['result'] = error(0, ''); 
		$this->ajaxReturn($data);
	}
	
	// 批次处理
	public function batchAction() {
		if (IS_POST) {
			$aa = $_POST;
			$opType = I('post.op_type', false);
			if ($opType == 'create') {
				return $this->createBatch($aa);
			} else if($opType == 'save') {
				return $this->saveBatch($aa);
			} else if($opType == 'delete') {
				return $this->deleteBatch($aa);
			} else if($opType == 'find') {
				return $this->findBatch($aa);
			} else if($opType == 'list') {
				return $this->listBatch($aa);
			} else {
				$data['result'] = error(-1, '错误的操作方式，线路批次操作失败');
			}
		} else {
			$data['result'] = error(-1, '错误的请求方式，线路批次请求失败');
		}
		return $this->ajaxReturn($data);
	}
	
	// 复制产品
	private function copyLine() {
		$lineId = I('post.line_id', false);
		if (empty($lineId)) {
			$data['result'] = error(-1, '复制产品对象错误');
			return $this->ajaxReturn($data);
		}
		
		$lineObj = ModelBase::getInstance('line');
		$line = $lineObj->getOne(appendLogicExp('id', '=', $lineId));
		if (empty($line)) {
			$data['result'] = error(-1, '未能找到复制对象的数据');
			return $this->ajaxReturn($data);
		}
		
		$copyTitle = $line['title'].'[副本]';
		$lineCount = $lineObj->getCount(appendLogicExp('title', 'LIKE', $copyTitle.'%'));
		if (!empty($lineCount)) {
			$copyTitle .= '['.$lineCount.']';
		}
		unset($line['id']);
		$line['title'] = $copyTitle;
		$line['online'] = '0';
		$line['click_count'] = 0;
		$line['create_time'] = fmtNowDateTime();
		$data['result'] = $lineObj->create($line, $newLineId);
		if (error_ok($data['result']) === false) {
			return $this->ajaxReturn($data);
		}
		$line['id'] = $newLineId;
		$data['ds'] = $line;
		
		// 复制PC、手机行程亮点、沿途风光
		$pointObj = ModelBase::getInstance('line_point_scenery');
		$points = $pointObj->getAll(appendLogicExp('line_id', '=', $lineId));
		foreach ($points as $pk=>$pv) {
			$newPoint = $pv;
			unset($newPoint['id']);
			$newPoint['line_id'] = $newLineId;
			$data['result_point_'.$pv['id']] = $pointObj->create($newPoint, $pointId);
		}
		
		// 复制行程		
		$travelObj = ModelBase::getInstance('travel_intro');
		$travels = $travelObj->getAll(appendLogicExp('line_id', '=', $lineId));
		foreach ($travels as $tk=>$tv) {
			$newTravel = $tv;
			unset($newTravel['id']);
			$newTravel['line_id'] = $newLineId;
			$data['result_travel_'.$tv['id']] = $travelObj->create($newTravel, $travelId);
		}
		
//		// 复制批次	
//		$batchObj = ModelBase::getInstance('batch');
//		$batchs = $batchObj->getAll(appendLogicExp('line_id', '=', $lineId));
//		foreach ($batchs as $bk=>$bv) {
//			$newBatch = $bv;
//			unset($newBatch['id']);
//			$newBatch['line_id'] = $newLineId;
//			$data['result_batch_'.$bv['id']] = $travelObj->create($newBatch, $batchId);
//		}
		
		return $this->ajaxReturn($data);
	}
	
	public function copyAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'line') {
				$this->copyLine();				
			} else {
				$data['result'] = error(-1, '错误的操作方式');
				return $this->ajaxReturn($data);
			}
		} else {
			return $this->showError('404', '复制错误', '禁止访问的接口');
		}
	}
	
	// 获取导出的产品的所有批次
	private function getExportBatchInfo() {
		$lineId = I('get.id', false);
		if (empty($lineId)) {
			$this->showError('501', '产品错误', '导出的产品不能找到', '产品编号有误，不能导出');
			return false;
		}
		
		$line = BackLineHelp::getLine(appendLogicExp('id', '=', $lineId), array('batch'=>true));
		
		$worksheet = array();
		if (count($line) > 0) {
			$infos[0][0] = '产品编号';
			$infos[0][1] = '产品名称';
			$infos[0][2] = '产品主题';
			$infos[0][3] = '集合地点';
			$infos[0][4] = '行程天数';
			$infos[0][5] = '部门';
			$infos[0][6] = '批次编号';
			$infos[0][7] = '批次标题';
			$infos[0][8] = '出团日期';
			$infos[0][9] = '散团日期';
			$infos[0][10] = '成人价格';
			$infos[0][11] = '儿童价格';
						
			$index = 1;
			foreach($line['batchs'] as $k=>$v) {
				$infos[$index][0] = $line['id'];
				$infos[$index][1] = $line['title'];
				$infos[$index][2] = $line['theme_type_show_text'];
				$infos[$index][3] = $line['assembly_point_show_text'];
				$infos[$index][4] = $line['travel_day'];
				$infos[$index][5] = '未知';
				$infos[$index][6] = $v['id'];
				$infos[$index][7] = $v['title'];
				$infos[$index][8] = $v['start_date_show'];
				$infos[$index][9] = $v['end_date_show'];
				$infos[$index][10] = $v['price_adult'];
				$infos[$index][11] = $v['price_child'];
				$index++;
			}
			
			$worksheets[0]['title'] = '批次信息';
			$worksheets[0]['data'] = $infos;
		}	
		return $worksheets;
	}
	
	// 导出批次
	public function exportAction() {
		$type = I('get.type', false);
		if ($type == 'batch') {
			$worksheets = $this->getExportBatchInfo($lineId, $out);	
		} else {			
			return $this->showError('404', '导出错误', '导出的数据类型错误');
		}
		if (!empty($worksheets)) {				
			MyHelp::exportExcel('batch', $worksheets);
		} else {
			return $this->showError('501', '导出错误', '导出的数据为空');
		}	
	}
	
	// 创建线路优惠
	private function createSpecialOffer($aa) {
		if (check_grant('line_offer_edit') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		if (!array_key_exists('line_id', $aa) || !array_key_exists('start_time', $aa) || 
			!array_key_exists('end_time', $aa) || !array_key_exists('cut_percent', $aa) ||
			!array_key_exists('cut_money', $aa) || !array_key_exists('type_id', $aa)) {
			$data['result'] = error(-1, '参数不齐全，不能创建产品优惠信息');
			return $this->ajaxReturn($data);
		}
		
		
		$offerObj = ModelBase::getInstance('line_special_offer');
		$colName = $offerObj->getUserDefine(ModelBase::DF_COL_NAMES);		
		$ds = coll_elements_giveup($colName, $aa);
		MyHelp::filterInvalidConds($ds);
		unset($ds['id']);
		
		if (empty($ds['start_time']) || empty($ds['end_time'])) {
			$data['result'] = error(-1, '优惠的起始与结束时间不能为空');
			return $this->ajaxReturn($data);
		}
		
		if (empty($ds['cut_percent']) && empty($ds['cut_money'])) {
			$data['result'] = error(-1, '优惠内容必须选择一个，不能为空');
			return $this->ajaxReturn($data);
		}
		
		$ds['create_time'] = fmtNowDateTime();
		$data['result'] = $offerObj->create($ds, $offerId);
		if (error_ok($data['result'])) {			
			$data['ds'] = BackLineHelp::getSpecialOffer(appendLogicExp('id', '=', $offerId));
		}
		$this->ajaxReturn($data);
	}
	
	// 编辑线路优惠
	private function saveSpecialOffer($aa) {
		if (check_grant('line_offer_edit') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		if (!array_key_exists('id', $aa)) {
			$data['result'] = error(-1, '条件参数不齐全，不能修改产品优惠信息');
			return $this->ajaxReturn($data);
		}
		
		$line = BackLineHelp::getLine(appendLogicExp('id', '=', $aa['line_id']));
		if (empty($line)) {
			$data['result'] = error(-1, '产品线路不存在，优惠更新失败');
			return $this->ajaxReturn($data);
		}
		
		$offerObj = ModelBase::getInstance('line_special_offer');
		$colName = $offerObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colName, $aa);	
		MyHelp::filterInvalidConds($ds);	
		
		unset($ds['id']);
		$data['result'] = $offerObj->modify($ds, appendLogicExp('id', '=', $aa['id']));
		if (error_ok($data['result'])) {			
			$data['ds'] = BackLineHelp::getSpecialOffer(appendLogicExp('id', '=', $aa['id']));
		}
		$this->ajaxReturn($data);
	}
	
	// 删除线路优惠
	private function deleteSpecialOffer($aa) {
		if (check_grant('line_offer_edit') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		if (!array_key_exists('id', $aa)) {
			$data['result'] = error(-1, '条件参数不齐全，不能删除产品优惠信息');
			return $this->ajaxReturn($data);
		}
		
		$offerObj = ModelBase::getInstance('line_special_offer');
		$data['result'] = $offerObj->remove(appendLogicExp('id', '=', $aa['id']));
		$this->ajaxReturn($data);		
	}
	
	// 查找批次
	private function findSpecialOffer($aa) {
		$offerObj = ModelBase::getInstance('line_special_offer');
		$colName = $offerObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colName, $aa);
		
		$conds = MyHelp::getLogicExp($ds, '=', 'AND');
		$data['ds'] = BackLineHelp::getSpecialOffer($conds);
		$data['result'] = error(0, ''); 
		$this->ajaxReturn($data);		
	}
	
	// 显示线路优惠
	private function listSpecialOffer($aa) {
		$offerObj = ModelBase::getInstance('line_special_offer');
		$colName = $offerObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colName, $aa);
		
		$conds = MyHelp::getLogicExp($ds, '=', 'AND');
		$data['ds'] = BackLineHelp::getSpecialOfferList($conds, 0, 0, $total, array('start_time'=>'asc'));
		$data['result'] = error(0, ''); 
		$this->ajaxReturn($data);
	}
	
	// 优惠处理
	public function specialOfferAction() {
		if (IS_POST) {
			$aa = $_POST;
			$opType = I('post.op_type', false);
			if ($opType == 'create') {
				return $this->createSpecialOffer($aa);
			} else if($opType == 'save') {
				return $this->saveSpecialOffer($aa);
			} else if($opType == 'delete') {
				return $this->deleteSpecialOffer($aa);
			} else if($opType == 'find') {
				return $this->findSpecialOffer($aa);
			} else if($opType == 'list') {
				return $this->listSpecialOffer($aa);
			} else {
				$data['result'] = error(-1, '错误的操作方式，线路优惠操作失败');
			}
		} else {
			$data['result'] = error(-1, '错误的请求方式，线路优惠请求失败');
		}
		return $this->ajaxReturn($data);
	}
	
	private function listQuestion($requestType, $aa) {
		if ($requestType == 'post') {
			$pageIndex = empty($aa['page']) ? 0 : $aa['page'];
			$startIndex = $pageIndex * LINE_QUESTION_LIST_SHOW_COUNT;
		} else {
			$startIndex = 0;
		}
		
		// 查询条件
		if (!empty($aa['cds'])) {
			$cdsList = explode(',',$aa['cds']);
			for ($i=0; $i < count($cdsList); $i+=2) {
				if ($cdsList[$i] == 'type_id_key') {
					$cds['type_id'] = MyHelp::TypeDataKey2Value($cdsList[$i+1]);
				} else {
					$cds[$cdsList[$i]] = $cdsList[$i+1];
				}
			}
			MyHelp::filterInvalidConds($cds);
			$conds = MyHelp::getLogicExp($cds, '=', 'AND');
		}
		$conds = appendLogicExp('question_id', '=', 0, 'AND', $conds);
		
		$sort = array('create_time'=>'desc');
		$find = array('type'=>true,'account'=>true,'answer'=>true,'line'=>true);
		$questions = BackLineHelp::getQuestionList($conds, $startIndex, LINE_QUESTION_LIST_SHOW_COUNT, $total, $sort, $find);
				
		// 页数
		$pageCount = intval($total / LINE_QUESTION_LIST_SHOW_COUNT);
		if (intval($total % LINE_QUESTION_LIST_SHOW_COUNT) > 0) {
			$pageCount += 1;
		}
		
		if ($requestType == 'post') {
			$data['result'] = error(0, '');
			if ($total > 0) {
				$data['ds'] = $questions;
				$data['sort'] = $sort;
				$data['page_count'] = $pageCount;
			} else {
				$data['result'] = error(-1, '没有找到相应问题');
			}
			return $this->ajaxReturn($data);
		} else {
			$questionTypes = MyHelp::getTypeData('question_type');
			$this->assign('question_types', $questionTypes);
			$questionQinglvapiTypes = MyHelp::getTypeData('question_qinglvpai_type');
			$this->assign('question_qinglvpai_types', $questionQinglvapiTypes);
			
			$this->assign('questions', $questions);
			$this->assign('page_count', $pageCount);
			$this->assign('conds', $conds);
			
			$this->_initBaseInfo('line_question', 'line', '问题系统', '问题列表');
			$this->display('question');
		}
	}
	
	// 线路问题预览
	private function previewQuestion($requestType, $aa) {
		if ($requestType == 'post') {
			$startIndex = I('post.start', 0);
		} else {
			$startIndex = 0;
		}
		
		// 查询最有帮助的，也就是本线路问题
		if (!empty($aa['query_type']) && $aa['query_type'] == 'help') {
			
			$lineQuestionType = MyHelp::TypeDataKey2Value('question_type_line', true);	
			
		}
		
		$questObj = ModelBase::getInstance('question');
		$params['table'] = '`kl_question` AS `q1`';
		$params['col'] = array(
			'`q1`.`id`'=>'`q1_id`',
			'`q1`.`question_id`'=>'`q1_question_id`',
			'`q1`.`line_id`'=>'`q1_line_id`',
			'`q1`.`type_id`'=>'`q1_type_id`',
			'`q1`.`account_type_id`'=>'`q1_account_type_id`',
			'`q1`.`account_id`'=>'`q1_account_id`',
			'`q1`.`content`'=>'`q1_content`',
			'`q1`.`hot`'=>'`q1_hot`',
			'`q1`.`recommend`'=>'`q1_recommend`',
			'`q1`.`agree`'=>'`q1_agree`',
			'`q1`.`create_time`'=>'`q1_create_time`',
			'`q2`.`id`'=>'`q2_id`',
			'`q2`.`question_id`'=>'`q2_question_id`',
			'`q2`.`line_id`'=>'`q2_line_id`',
			'`q2`.`type_id`'=>'`q2_type_id`',
			'`q2`.`account_type_id`'=>'`q2_account_type_id`',
			'`q2`.`account_id`'=>'`q2_account_id`',
			'`q2`.`content`'=>'`q2_content`',
			'`q2`.`hot`'=>'`q2_hot`',
			'`q2`.`recommend`'=>'`q2_recommend`',
			'`q2`.`agree`'=>'`q2_agree`',
			'`q2`.`create_time`'=>'`q2_create_time`',
		);
		$params['join'] = array('INNER JOIN `kl_question` AS `q2` ON `q1`.`id` = `q2`.`question_id`');
		$params['conds'] = appendLogicExp('`q1`.`question_id`', '=', '0');	
		if (!empty($lineQuestionType) && is_error($lineQuestionType) === false) {
			$params['conds'] = appendLogicExp('`q1`.`type_id`', '=', $lineQuestionType['id'], 'AND', $params['conds']);	
			$params['conds'] = appendLogicExp('`q2`.`type_id`', '=', $lineQuestionType['id'], 'AND', $params['conds']);
		}
		if (!empty($aa['line_id']) && $aa['query_type'] == 'help') {
			$params['conds'] = appendLogicExp('`q1`.`line_id`', '=', $aa['line_id'], 'AND', $params['conds']);
		}
		$params['sort'] = array('`q1`.`create_time`'=>'desc');
		$params['group'] = '`q1`.`id`';
		$params['limit'] = array($startIndex, LINE_QUESTION_LIST_SHOW_COUNT);
		$data['params'] = $params;
		$questions = $questObj->queryData($params, $total);
		$data['sql'] = $questObj->getLastSql();
		
		foreach ($questions as $qk=>$qv) {			
			// 填充内容
			$qv['q1_content'] = htmlspecialchars_decode($qv['q1_content']);
			$qv['q1_content_show'] = $qv['q1_content'];
			if (mb_strlen($qv['q1_content'], 'utf8') > LINE_QUESTION_TEXT_SHOW_COUNT) {
				$qv['q1_content_show'] = mb_substr($qv['q1_content'], 0, LINE_QUESTION_TEXT_SHOW_COUNT, 'utf8');
				$qv['q1_content_show'] .= '...';
			}
			
			$qv['q2_content'] = htmlspecialchars_decode($qv['q2_content']);
			
			$qv['q1_time_show'] = fmtDateTimeToNow($qv['q1_create_time']);
			$qv['q2_time_show'] = fmtDateTimeToNow($qv['q2_create_time']);			
			$questions[$qk] = $qv;
		}	
			
		// 页数
		$pageCount = intval($total / LINE_QUESTION_LIST_SHOW_COUNT);
		if (intval($total % LINE_QUESTION_LIST_SHOW_COUNT) > 0) {
			$pageCount += 1;
		}
		
		if ($requestType == 'post') {
			$data['result'] = error(0, '');
			if ($total > 0) {
				$data['ds'] = $questions;
				$data['page_count'] = $pageCount;
			} else {
				$data['result'] = error(-1, '没有找到相应问题');
			}
			return $this->ajaxReturn($data);
		} else {
			$questionTypes = MyHelp::getTypeData('question_type');			
			$this->assign('question_types', $questionTypes);
			
			$this->assign('questions', $questions);
			$this->assign('page_count', $pageCount);
			
			$this->_initTemplateInfo();
			$this->display('question');
		}
	}
	
	// 查找问题
	private function findQuestion($aa) {
		if (IS_POST) {
			if (empty($aa['id'])) {
				$data['result'] = error(-1, '参数不足，不能找到该问题信息');
				return $this->ajaxReturn($data);
			}
			
			$conds = appendLogicExp('id', '=', $aa['id']);
			$find = array('type'=>true, 'account'=>true);
			$data['ds'] = BackLineHelp::getQuestion($conds,$find);
			$this->ajaxReturn($data);
		}
	}
	
	// 生成问题
	private function createQuestion($aa) {
		if (IS_POST) {
			if (check_grant('question_system') === false) {
				$data['result'] = error(-1, '您没有此操作权限');
				return $this->ajaxReturn($data);
			}
			$admin = MyHelp::getLoginAccount(false);
			if (is_error($admin) === true) {
				$data['jumpUrl'] = U('Admin/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI'])));
				$data['result'] = error(-1, '管理员未登陆，请登录后再发消息');
				return $this->ajaxReturn($data);
			}
			
			$questionObj = ModelBase::getInstance('question');
			$colNames = $questionObj->getUserDefine(ModelBase::DF_COL_NAMES);
			
			$ds = coll_elements_giveup($colNames, $aa);
			$ds['account_type_id'] = $admin['account_type']['id'];
			$ds['account_id'] = $admin['id'];
			$ds['create_time'] = fmtNowDateTime();
			$ds['content'] = htmlspecialchars($ds['content']);
			$ds['agree'] = 0;
			
			if ($aa['op_type'] == 'create_line') {
				$ds['type_id'] = MyHelp::TypeDataKey2Value('question_type_line');
			}
			
			$data['result'] = $questionObj->create($ds, $questionId);
			if (error_ok($data['result']) === true) {
				$ds['content'] = htmlspecialchars_decode($ds['content']);
				$ds['account_id_data'] = $admin;
				$ds['account_id_show_name'] = $admin['account'];
				$ds['answer_count'] = 0;
				$ds['id'] = $questionId;
				$data['ds'] = $ds;
				// 更新缓存
				MyHelp::saveConfigUpdateTime('pc_home_bottom_question');
			}
			$this->ajaxReturn($data);
		} else {
			$errPageData = errorPage('错误&nbsp;&nbsp;404', '找不到页面', '找不到所请求的页面');
			$this->assign('err', $errPageData);
			$this->display('index/error');
		}
	}
	
	// 编辑问题
	private function saveQuestion($aa) {
		if (check_grant('question_system') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		
		if (empty($aa['id']) || empty($aa['content'])) {
			$data['result'] = error(-1, '参数不足，编辑问题失败');
			return $this->ajaxReturn($data);
		}
		
		$questionObj = ModelBase::getInstance('question');
		$colNames = $questionObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNames, $aa);
		unset($ds['id']);
		$data['result'] = $questionObj->modify($ds, appendLogicExp('id', '=', $aa['id']));
		if (error_ok($data['result']) === true) {
			// 更新缓存
			MyHelp::saveConfigUpdateTime('pc_home_bottom_question');
		}
		$this->ajaxReturn($data);
	}
	
	// 删除问题
	private function deleteQuestion($aa) {
		if (check_grant('question_system') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		
		if (empty($aa['id'])) {
			$data['result'] = error(-1, '参数不足，删除问题失败');
			return $this->ajaxReturn($data);
		}
		
		$questionObj = ModelBase::getInstance('question');
		$conds = appendLogicExp('id', '=', $aa['id']);
		$conds = appendLogicExp('question_id', '=', $aa['id'], 'OR', $conds);
		$data['result'] = $questionObj->remove($conds);
		// 更新缓存
		if (error_ok($data['result']) === true) {
			MyHelp::saveConfigUpdateTime('pc_home_bottom_question');
		}
		$this->ajaxReturn($data);
	}
	
	// 问题系统
	public function questionAction() {
		if (IS_POST) {
			$opType = I('post.op_type', false);
			if ($opType == 'list') {
				$this->listQuestion('post', $_POST);
			} else if ($opType == 'preview') {
				$this->previewQuestion('post', $_POST);
			} else if ($opType == 'find') {
				$this->findQuestion($_POST);
			} else if ($opType == 'create') {
				$this->createQuestion($_POST);
			} else if ($opType == 'edit') {
				$this->saveQuestion($_POST);
			} else if ($opType == 'delete') {
				$this->deleteQuestion($_POST);
			} else {
				$data['result'] = error(-1, '错误的请求操作类型');
				$this->ajaxReturn($data);
			}
			
		} else {
			$this->listQuestion('get', $_GET);
		}
	}
		
	// 创建文章
	private function createArticle($requestType, $aa) {				
		if ($requestType == 'post') {
			if (check_grant('article_system') === false) {
				$data['result'] = error(-1, '您没有此操作权限');
				return $this->ajaxReturn($data);
			}
			
			$articleObj = ModelBase::getInstance('article');
			$colNames = $articleObj->getUserDefine(ModelBase::DF_COL_NAMES);
			
			$ds = coll_elements_giveup($colNames, $aa);
			if (!empty($ds['keywords'])) {				
				$ds['keywords'] = str_replace('，', ',',$ds['keywords']);
			}	
						
			if (empty($ds['id'])) {
				$data['cols'] = $colNames;
				if (empty($ds['title'])) {
					$data['result'] = error(-1, '标题不能为空');
					$this->ajaxReturn($data);
				}
				
				$count = $articleObj->getCount(appendLogicExp('title', '=', $ds['title']));
				if ($count > 0) {
					$data['result'] = error(-1, '该标题的文章已经存在');
					return $this->ajaxReturn($data);
				}			
				
				$account = MyHelp::getLoginAccount(false);
				if (is_error($account) === true) {
					$data['result'] = error(-1, '账户未登陆');
					$data['jumpUrl'] = U('Admin/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI'])));
					return $this->ajaxReturn($data);
				}
				
				$ds['account_type_id'] = $account['account_type']['id'];
				$ds['account_id'] = $account['id'];
				$ds['create_time'] = fmtNowDateTime();
				
				$data['result'] = $articleObj->create($ds, $articleId);
				$data['id'] = $articleId;
			} else {
				if (array_key_exists('title', $ds)) {
					if (empty($ds['title'])) {
						$data['result'] = error(-1, '标题不能为空');
						$this->ajaxReturn($data);
					}
				}
				
				$data['id'] = $ds['id'];
				$conds = appendLogicExp('id', '=', $ds['id']);
				unset($ds['id']);
				$data['result'] = $articleObj->modify($ds,$conds);
			}			
			$this->ajaxReturn($data);			
		} else {	
			if (!empty($aa['id'])) {
				$conds = appendLogicExp('id', '=', $aa['id']);
				$find = array('content'=>1);
				$article = BackLineHelp::getArticle($conds, $find);
				$this->assign('article', $article);
			}
			
			$this->_initFloatImageSelector();
			$this->_initBaseInfo('line_article', 'line', '编辑文章', '编辑文章');	
			$this->display('article_new');
		}
	}
	
	// 显示文章
	private function listArticle($requestType, $aa) {
		if ($requestType == 'post') {
			$pageIndex = empty($aa['page']) ? 0 : $aa['page'];
			$startIndex = $pageIndex * LINE_ARTICLE_LIST_SHOW_COUNT;
		} else {
			$startIndex = 0;
		}
		
		// 查询条件
//		if (!empty($aa['cds'])) {
//			$cds = explode('|', $aa['cds']);
//			for ($i = 0; i < count($cds); $i += 2) {
//				$cdList[$cds[$i]] = $cds[$i+1];	
//			}
//			MyHelp::filterInvalidConds($cdList);
//			$articleObj = ModelBase::getInstance('article');
//			$colNames = $articleObj->getUserDefine(ModelBase::DF_COLNAMES);
//			$cols = coll_elements_giveup($colNames, $cdList);
//			$conds = MyHelp::getLogicExp($cols, '=', 'AND');
//			if (!empty($cdList['cnt'])) {
//				$conds = appendLogicExp('content', 'LIKE', '%'.$cdList['cnt'].'%', 'AND', $conds);
//			}
//		}
		$conds = appendLogicExp('invalid', '!=', '1', 'AND', $conds);
		
		$sort = array('recommend'=>'desc', 'hot'=>'desc', 'agree'=>'desc', 'read'=>'desc', 'create_time'=>'desc');
		$fill = array('content'=>1);
		$articles = BackLineHelp::getArticleList($conds, $startIndex, LINE_ARTICLE_LIST_SHOW_COUNT, $total, $sort, $fill);
		// 页数
		$pageCount = intval($total / LINE_ARTICLE_LIST_SHOW_COUNT);
		if (intval($total % LINE_ARTICLE_LIST_SHOW_COUNT) > 0) {
			$pageCount += 1;
		}
		
		if ($requestType == 'post') {			
			$data['conds'] = $conds;
			$data['total'] = $total;
			$data['pindex'] = $startIndex;
			$data['pcount'] = LINE_ARTICLE_LIST_SHOW_COUNT;
			$data['sort'] = $sort;
			$data['fill'] = $fill;
			
			$data['result'] = error(0, '');
			if ($total > 0) {
				$data['ds'] = $articles;
				$data['page_count'] = $pageCount;
			} else {
				$data['result'] = error(-1, '没有找到相应文章');
			}
			return $this->ajaxReturn($data);
		} else {
			$this->assign('articles', $articles);
			$this->assign('page_count', $pageCount);
			
			$this->_initBaseInfo('line_article', 'line', '文章列表', '文章列表');
			$this->display('article_list');
		}
	}
	
	// 文章绑定线路
	private function articleBindLine($requestType, $aa) {
		if ($requestType == 'post') {
			if (check_grant('line_base_edit') === false) {
				$data['result'] = error(-1, '您没有此操作权限');
				return $this->ajaxReturn($data);
			}
			if (empty($aa['line_id']) || empty($aa['ids']) || $aa['ids'] == '()') {
				$data = error(-1, '线路编号参数错误');
				return $this->ajaxReturn($data);
			}
			
			$conds = appendLogicExp('id', '=', $aa['line_id']);
			$line = BackLineHelp::getLine($conds,false);
			if (empty($line)) {
				$data = error(-1, '绑定的线路错误，找不到该线路信息');
				return $this->ajaxReturn($data);
			}
			$articles = array();
			if (!empty($line['articles'])) {
				$articles = explode(',', $line['articles']);
			}
			$ids = explode(',', $aa['ids']);
			foreach ($ids as $ik=>$iv) {
				$idsMap[$iv] = strval($ik);
			}
			
			$lineObj = ModelBase::getInstance('line');
			// 添加绑定
			if ($aa['add'] == '1') {
				// 重复文章过滤				
				foreach($articles as $ak=>$av) {
					if (isset($idsMap[$av])){
						unset($idsMap[$av]);
					}
				}
				
				$data['out_article'] = $articles;
				$data['out_idsMap'] = $idsMap;
				
				//判断是否存在可添加文章
				if (count($idsMap) == 0) {
					$data['result'] = error(-1, '没有可绑定的文章');
					if (count($ids) > 0) {
						$data['result'] = error(-1, '过滤重复添加文章后，没有可绑定的文章');
					}
					return $this->ajaxReturn($data);
				}
				
				// 计算可添加文章数量
				$canAddCount = LINE_BIND_ARTICLE_COUNT - count($articles);
				if ($canAddCount <= 0) {
					$data['result'] = error(-1, '可绑定的文章数量超出上限(最大绑定'.LINE_BIND_ARTICLE_COUNT.'篇文章)');
					return $this->ajaxReturn($data);
				}
				
				// 获取新的绑定文章编号以及被添加的文章
				$newAritcleIds = $line['articles'];	
				foreach ($idsMap as $ik=>$iv) {
					if ($canAddCount <= 0) {
						break;
					}
					$canAddCount--;
					// 线路绑定的文章列表编号
					$newAritcleIds .= empty($newAritcleIds) ? $ik : ','.$ik; 
					// 被选择绑定的文章，将进行详细信息读取
					$selArticleIds .= empty($selArticleIds) ? $ik : ','.$ik; 
					// 按文章选择的id添加（data代表将被赋值的数据）
					$articleSort[$ik] = 'data';
				}
							
				$result = $lineObj->modify(array('articles'=>$newAritcleIds), $conds);
				if (error_ok($result) === true) {
					if (!empty($selArticleIds) && !empty($articleSort)) {
						$conds = appendLogicExp('id', 'IN', '('.$selArticleIds.')');
						$sort = array('create_time'=>'desc');
						$fill = array('content'=>true);
						$articles = BackLineHelp::getArticleList($conds, 0, 0, $total, $sort, $fill);
						foreach ($articles as $ak=>$av) {
							$articleSort[$av['id']] = $av;
						}
						foreach ($articleSort as $ak=>$av){
							if (empty($sortds)) {								
								$sortds = array($av);
							} else {
								array_push($sortds, $av);
							}
						}
						$data['ds'] = $sortds;
					}
				}
				
			// 移除绑定
			} else if ($aa['remove'] == '1') {
				// 修改的文章编号与删除的文章编号
				foreach ($articles as $ak=>$av) {
					if (empty($idsMap[$av])) {
						empty($newAritcleIds) ? $newAritcleIds=$av : $newAritcleIds.=','.$av;
					} else {
						array_push($delArticleIds, $av);
					}
				}
				
				if (empty($delArticleIds)) {
					$data['result'] = error(-1, '没有可移除的文章');
					return $this->ajaxReturn($data);
				}
							
				$result = $lineObj->modify(array('articles'=>$newAritcleIds), appendLogicExp('id', '=', $aa['line_id']));
				$data['ds'] = $delArticleIds;
			} else {
				$result = error(-1, '错误的数据操作方式');
			}
			
			$data['result'] = $result;
			$this->ajaxReturn($data);
		} else {
			$this->display('index/error');
		}
	}
	
	// 移除隐藏文章显示
	private function removeArticle($requestType, $aa) {
		if ($requestType == 'post') {
			if (check_grant('article_system') === false) {
				$data['result'] = error(-1, '您没有此操作权限');
				return $this->ajaxReturn($data);
			}
			if (empty($aa['id'])) {
				$data['result'] = error(-1, '参数不齐全不能移除文章');
				return $this->ajaxReturn($data);
			}
			
			$ds['invalid'] = 1;
			$articleObj = ModelBase::getInstance('article');
			$data['result'] = $articleObj->modify($ds, appendLogicExp('id', '=', $aa['id']));
			$this->ajaxReturn($data);
		} else {
			$errPageData = errorPage('404', '错误', '找不到页面', '您所请求的页面走丢了');
			$this->assign('err', $errPageData);
			$this->display('index/error');
		}
	}
	
	// 显示文章预览界面
	private function articleShow($aa) {
		if (empty($aa['id'])) {
			$errPageData = errorPage('501', '错误', '参数错误', '找不到所请求的文章信息');
			$this->assign('err', $errPageData);
			$this->display('index/error');
		}
		
		$article = BackLineHelp::getArticle(appendLogicExp('id', '=', $aa['id']), true);
		$this->assign('article', $article);
		
		$this->_initBaseInfo('line_article', 'line', '文章系统', '文章预览');
		$this->display('article_show');
	}
	
	// 文章系统
	public function articleAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'create') {
				$this->createArticle('post', $_POST);
			} else if ($type == 'list') {
				$this->listArticle('post', $_POST);
			} else if ($type == 'bind_line') {
				$this->articleBindLine('post', $_POST);
			} else if ($type == 'remove') {
				$this->removeArticle('post', $_POST);
			} else {
				$data['result'] = error('错误的请求类型');
				$this->ajaxReturn($data);
			}			
		} else {
			$type = I('get.type', false);
			if ($type == 'list') {
				$this->listArticle('get');
			} else if ($type == 'create') {
				$this->createArticle('get',$_GET);
			} else if ($type == 'show') {
				$this->articleShow($_GET);
			} else {
				$errPageData = errorPage('404', '错误', '找不到页面', '找不到所请求的页面');
				$this->assign('err', $errPageData);
				$this->display('index/error');
			}
		}
	}
	
	// 显示文章
	private function listLeader($requestType, $aa) {
		if ($requestType == 'post') {
			$pageIndex = empty($aa['page']) ? 0 : $aa['page'];
			$startIndex = $pageIndex * LINE_LEADER_LIST_SHOW_COUNT;
		} else {
			$startIndex = 0;
		}
		
		// 查询条件
		if (!empty($aa['content'])) {
			
		}
		
		$sort = array('create_time'=>'desc');
		$leaders = BackLineHelp::getLeaderList($conds, $startIndex, LINE_LEADER_LIST_SHOW_COUNT, $total, $sort);
		// 页数
		$pageCount = intval($total / LINE_LEADER_LIST_SHOW_COUNT);
		if (intval($total % LINE_LEADER_LIST_SHOW_COUNT) > 0) {
			$pageCount += 1;
		}
		
		if ($requestType == 'post') {
			$data['result'] = error(0, '');
			if ($total > 0) {
				$data['ds'] = $leaders;
				$data['page_count'] = $pageCount;
			} else {
				$data['result'] = error(-1, '没有找到相应领队列表');
			}
			return $this->ajaxReturn($data);
		} else {
			$this->assign('$leaders', $leaders);
			$this->assign('page_count', $pageCount);
			
			$this->_initBaseInfo('line_leader', 'line', '领队系统', '领队列表');
			$this->display('leader_list');
		}
	}
	
	// 创建文章
	private function createLeader($requestType, $aa) {				
		if ($requestType == 'post') {
			$leaderObj = ModelBase::getInstance('leader');
			$colNames = $leaderObj->getUserDefine(ModelBase::DF_COL_NAMES);
			
			$ds = coll_elements_giveup($colNames, $aa);
						
			if (empty($ds['id'])) {
				$count = $leaderObj->getCount(appendLogicExp('name', '=', $ds['name']));
				if ($count > 0) {
					$data['result'] = error(-1, '该名字的领队已经存在');
					return $this->ajaxReturn($data);
				}			
				
				$account = MyHelp::getLoginAccount(false);
				if (is_error($account) === true) {
					$data['result'] = error(-1, '账户未登陆');
					$data['jumpUrl'] = U('Admin/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI'])));
					return $this->ajaxReturn($data);
				}
				
				$ds['account_type_id'] = $account['account_type']['id'];
				$ds['account_id'] = $account['id'];
				
				$data['result'] = $leaderObj->create($ds, $leaderId);
				$ds['id'] = $leaderId;
				$data['id'] = $leaderId;
			} else {
				$conds = appendLogicExp('id', '=', $ds['id']);
				unset($ds['id']);
				$data['result'] = $leaderObj->modify($ds,$conds);
			}			
			$this->ajaxReturn($data);			
		} else {		
			if (!empty($aa['id'])) {
				$conds = appendLogicExp('id', '=', $aa['id']);
				$article = BackLineHelp::getLeader($conds);
				$this->assign('article', $article);
			}
			
			$this->_initFloatImageSelector();
			$this->_initBaseInfo('line_leader', 'line', '领队系统', '编辑领队');	
			$this->display('leader_new');
		}
	}
	
	// 文章系统
	public function leaderAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'list') {
				$this->listLeader('post', $_POST);
			} else if ($type == 'create') {
				$this->createLeader('post', $_POST);
			} else {
				$data['result'] = error('错误的请求类型');
				$this->ajaxReturn($data);
			}			
		} else {
			$type = I('get.type', false);
			if ($type == 'list') {
				$this->listLeader('get');
			} else if ($type == 'create') {
				$this->createLeader('get',$_GET);
			} else {
				$errPageData = errorPage('404', '错误&nbsp;&nbsp;404', '找不到页面', '找不到所请求的页面');
				$this->assign('err', $errPageData);
				$this->display('index/error');
			}
		}
	}
	
	// 显示视频列表
	private function listVideo($requestType, $aa) {
		if ($requestType == 'post') {
			$pageIndex = empty($aa['page']) ? 0 : $aa['page'];
			$startIndex = $pageIndex * LINE_VIDEO_LIST_SHOW_COUNT;
		} else {
			$startIndex = 0;
		}
		
		if (!empty($aa['cds'])) {
			$cdsList = explode(',',$aa['cds']);
			for ($i=0; $i < count($cdsList); $i+=2) {
				$cds[$cdsList[$i]] = $cdsList[$i+1];
			}
			MyHelp::filterInvalidConds($cds);
			if (!empty($cds)) {
				$conds = MyHelp::getLogicExp($cds, '=', 'AND');	
			}
			if (!empty($cds['tl'])) {
				$conds = appendLogicExp('title', 'LIKE', '%'.$cds['tl'].'%', 'AND', $conds);
			}
			if (!empty($cds['stl'])) {
				$conds = appendLogicExp('subheading', 'LIKE', '%'.$cds['tl'].'%', 'AND', $conds);
			}
		}
		
		$videos = BackLineHelp::getVideoList($conds,$startIndex,LINE_VIDEO_LIST_SHOW_COUNT,$total,array('create_time'=>'desc'));
		// 页数
		$pageCount = intval($total / LINE_VIDEO_LIST_SHOW_COUNT);
		if (intval($total % LINE_VIDEO_LIST_SHOW_COUNT) > 0) {
			$pageCount += 1;
		}
		
		if ($requestType == 'post') {
			$data['result'] = error(0, '');
			$data['ds'] = $videos;
			$data['page_count'] = $pageCount;
			$this->ajaxReturn($data);
		} else {
			$this->assign('videos', $videos);		
			$this->assign('page_count', $pageCount);
			$this->assign('modal_type_data', true);
			$this->_initFloatImageSelector();
			
			$this->showPage('video', 'line_video', 'line', '视频中心', '视频列表');
		}
	}
	
	// 查询视频
	private function findVideo() {
		if (IS_POST) {
			$videoObj = ModelBase::getInstance('video');
			$colNames = $videoObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$cds = coll_elements_giveup($colNames, $_POST);
			$conds = MyHelp::getLogicExp($cds, '=', 'AND');
			
			$findType = I('post.find_type', '');
			if ($findType == 'all') {
				$data['ds'] = BackLineHelp::getVideoList($conds);
			} else {
				$data['ds'] = BackLineHelp::getVideo($conds);
			}
			$this->ajaxReturn($data);
		} else {
			$this->showError('404', '访问错误', '您访问的页面不存在', '错误的访问链接');
		}
	}
	
	// 创建保存视频信息
	private function saveVideo($aa) {
		if (check_grant('video_center') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		$videoObj = ModelBase::getInstance('video');
		$colNames = $videoObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNames, $aa);
		
		if (empty($ds['title']) || empty($ds['href'])) {
			$data['result'] = error(-1, '视频的标题和链接不能为空');
			return $this->ajaxReturn($data);
		}	
		
		$account = MyHelp::getLoginAccount(false);
		if (is_error($account)) {
			$data['jumpUrl'] = U('user/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI'])));
			$data['result'] = error(-1, '您还未登陆，请登陆后在进行操作');
			return $this->ajaxReturn($data);
		}
		
		if (!empty($ds['id'])) {			
			$conds = appendLogicExp('id', '=', $ds['id']);
			$data['result'] = $videoObj->modify($ds, $conds);
		} else {			
			$conds = appendLogicExp('title', '=', $ds['title']);
			$conds = appendLogicExp('href', '=', $ds['href'], 'AND', $conds);
			$count = $videoObj->getCount($conds);			
			if ($count > 0) {
				$data['result'] = error(-1, '该视频已经存在,请检查你的标题和链接');
				return $this->ajaxReturn($data);
			}
			unset($ds['id']);
			$ds['create_time'] = fmtNowDateTime();
			$acct = array('account_type_id'=>$account['account_type']['id'], 'id'=>$account['id']);
			$ds['uploader'] = json_encode($acct);
			$data['result'] = $videoObj->create($ds, $videoId);
			$ds['id'] = $videoId;
			$data['ds'] = $ds;
		}
		return $this->ajaxReturn($data);
	}
	
	// 删除视频
	private function deleteVideo($aa) {
		if (check_grant('video_center') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		if (empty($aa['id'])) {
			$data['result'] = error(-1, '删除视频的参数不足');
			return $data['result'];
		}
		$videoObj = ModelBase::getInstance('video');
		$data['result'] = $videoObj->remove(appendLogicExp('id', '=', $aa['id']));
		return $this->ajaxReturn($data);
	}
	
	// 视频中心
	public function videoAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'list') {
				$this->listVideo('post', $_POST);
			} else if ($type == 'find') {
				$this->findVideo();
			} else if ($type == 'save') {
				$this->saveVideo($_POST);
			} else if ($type == 'delete') {
				$this->deleteVideo($_POST);
			} else {
				$data['result'] = error(-1, '错误的操作类型');
				return $this->ajaxReturn($data);
			}
		} else {
			$this->listVideo('get', $_GET);
		}
	}
	
	// 展示专题
	private function listSubject($requestType, $aa) {			
		if ($requestType == 'post') {
			$cdsstr = I('post.cdsstr', '');
			$pageIndex = I('post.page', 0);
		} else {
			$cdsstr = '';
			$pageIndex = 0;
		}
		$startIndex = $pageIndex * LINE_SUBJECT_LIST_SHOW_COUNT;
		
				
		$sort = array('sort'=>'asc', 'create_time'=>'desc');
		$ds = BackLineHelp::getSubjectList($conds, $startIndex, LINE_SUBJECT_LIST_SHOW_COUNT, $total, $sort, false);
		
		// 获取页数
		$pageCount = intval($total / LINE_SUBJECT_LIST_SHOW_COUNT);
		if ($total % LINE_SUBJECT_LIST_SHOW_COUNT > 0) {
			$pageCount += 1;
		}
		
		if ($requestType == 'post') {
			$data['ds'] = $ds;
			$data['page_count'] = $pageCount;
			$data['result'] = error(0, '');						
			return $this->ajaxReturn($data);
		} else {
			$this->assign('subjects', $ds);
			$this->assign('page_count', $pageCount);
			
			$this->showPage('subject_list', 'line_subject', 'line', '产品专题', '专题列表', '这里你可以查看并删除专题的信息');
		}
	}
	
	// 保存专题
	private function saveSubject($requestType, $aa) {
		if ($requestType == 'post') {	
			if (check_grant('line_subject') === false) {
				$data['result'] = error(-1, '您没有此操作权限');
				return $this->ajaxReturn($data);
			}
			$subjectObj = ModelBase::getInstance('subject');
			$colName = $subjectObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$ds = coll_elements_giveup($colName, $aa);
			
			if (empty($ds)) {
				$data['result'] = error(-1, '数据内容不能为空');
				return $this->ajaxReturn($data);
			}				
			
			if ($ds['key'] == 'recommend_subject_subheading') {
				$ds['value'] = htmlspecialchars($ds['value']);
			}
			
			if (empty($ds['id'])) {
				$ds['create_time'] = fmtNowDateTime();
				$data['result'] = $subjectObj->create($ds, $subjectId);
				if (error_ok($data['result']) === true) {
					$data['id'] = $subjectId;
					// 刷新缓存
					MyHelp::saveConfigUpdateTime('cache_set_subject_'.$subjectId);
				}
				return $this->ajaxReturn($data);
			} else {
				unset($ds['id']);
				$data['result'] = $subjectObj->modify($ds, appendLogicExp('id', '=', $aa['id']));
				if (error_ok($data['result']) === true) {
					// 刷新缓存
					MyHelp::saveConfigUpdateTime('cache_set_subject_'.$subjectId);
				}
				return $this->ajaxReturn($data);
			}
			
		} else {
			if (!empty($aa['id'])) {
				$subject = BackLineHelp::getSubject(appendLogicExp('id', '=', $aa['id']), array('data'=>true));
				$this->assign('subject', $subject);				
			}
			$this->assign('aa', $aa);
			// 线路目的地筛选
			$themes = MyHelp::getTypeData('line_theme');
			$rd['id'] = '0';
			$rd['data_type_id'] = MyHelp::IdEachTypeKey('data_type', 'line_theme');
			$rd['type_key'] = 'line_theme_recommend';
			$rd['type_desc'] = '推荐';
			array_push($themes, $rd);			
			$this->assign('line_theme', $themes);			
			// 线路选择
			$this->assign('modal_line_list', true);
			
			$this->_initFloatImageSelector();
			$this->_initBaseInfo('line_subject', 'line', '产品专题', '专题编辑', '这里您可以创建、编辑、修改您的专题信息');
			$this->display('subject_new');	
		}
	}
	
	// 处理专题的数据
	private function subjectData($aa) {
		if (check_grant('line_subject') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		if (empty($aa['subject_id'])) {
			$data['result'] = error(-1, '请先给专题设置一个标题、副标题、或者首图吧');
			return $this->ajaxReturn($data);
		}
		
		if (empty($aa['key'])) {
			$data['result'] = error(-1, '专题的数据的类型不能为空');
			return $this->ajaxReturn($data);
		}
		
		$dataObj = ModelBase::getInstance('subject_data');
		$colName = $dataObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$newDS = coll_elements_giveup($colName, $aa);
		
		$dataConds = appendLogicExp('subject_id', '=', $aa['subject_id']);
		if (empty($aa['key_like'])) {
			$dataConds = appendLogicExp('key', '=', $aa['key'], 'AND', $dataConds);					
		} else {
			$dataConds = appendLogicExp('key', 'LIKE', '%'.$aa['key'].'%', 'AND', $dataConds);
		}
		$ds = $dataObj->getOne($dataConds);
		$bCreate = empty($ds) ? true : false;
		$data['aa'] = $aa;
		$data['find_ds'] = $ds;
		$data['new_ds'] = $newDS;
		
		if (!empty($aa['sql_type'])) {
			if ($aa['sql_type'] == 'find') {
				$data['result'] = $bCreate === true ? error(-1,'没有可用的数据') : error(0, '');
				$vals = json_decode($ds['value'], true);
				if (stripos($ds['key'], 'line_') === 0) {
					foreach($vals as $ak=>$av){
						if (!empty($ids)) {
							$ids .= ',';							
						}
						$ids .= $av['id'];
						$lineMap[$av['id']] = '';
					}
					$conds = appendLogicExp('id', 'IN', '('.$ids.')');
					$find = array('batch'=>true, 'min_batch'=>true);
					$valList = BackLineHelp::getLineList($conds, 0, 0, $total, array(), $find); 
					// 线路排序
					foreach ($valList as $vk=>$vv) {
						$lineMap[$vv['id']] = $vv;
					}	
					$valList = array();
					foreach ($lineMap as $lmk=>$lmv) {
						array_push($valList, $lmv);
					}
					$data['ds'] = $valList;
				} else {
					$data['ds'] = $vals;
				}	
				return $this->ajaxReturn($data);		
			} else if ($aa['sql_type'] == 'append') {
				if (!empty($ds['value'])) {
					$vals = json_decode($ds['value'], true);
					$newVals = json_decode($newDS['value'], true);
					$vals = array_merge($vals, $newVals);
					$ds['value'] = json_encode($vals);
				} else {
					$ds = $newDS;
					$newVals = json_decode($ds['value'], true);
				}													
				if (stripos($ds['key'], 'line_') === 0) {
					foreach($newVals as $ak=>$av){
						if (!empty($ids)) {
							$ids .= ',';							
						}
						$ids .= $av['id'];
					}
					$conds = appendLogicExp('id', 'IN', '('.$ids.')');
					$find = array('batch'=>true, 'min_batch'=>true);
					$data['lines'] = BackLineHelp::getLineList($conds, 0, 0, $total, array('id'=>'desc'), $find); 
				}
			} else if (stripos($aa['sql_type'], 'sort_tab') === 0) {
				if (!empty($ds)) {
					if ($aa['value'] == 'left') {
						if ($ds['sort'] == 0) {
							$data['result'] = error(-1, '已经到最左边了，不能再左移了');
							return $this->ajaxReturn($data);
						}	
						$new_sort = intval($ds['sort']) - 1;
						$moveConds = appendLogicExp('subject_id', '=', $aa['subject_id']);
						$moveConds = appendLogicExp('key', 'LIKE', 'tab_%', 'AND', $moveConds);
						$moveConds = appendLogicExp('sort', '=', $new_sort, 'AND', $moveConds);
						$changeDS = $dataObj->getOne($moveConds);
						if (empty($changeDS)) {
							$data['result'] = error(-1, '要交换的目标对象不存在,移动失败');
							return $this->ajaxReturn($data);
						}
						// 自己减一
						$data['self_result'] = $dataObj->fieldAddAndSub(appendLogicExp('id', '=', $ds['id']), 'sort', 1, false);
						// 目标加一
						$data['aim_result'] = $dataObj->fieldAddAndSub(appendLogicExp('id', '=', $changeDS['id']), 'sort', 1, true);
					} else {
						$maxConds = appendLogicExp('subject_id', '=', $aa['subject_id']);	
						$maxConds = appendLogicExp('key', 'LIKE', 'tab_%', 'AND', $maxConds);			
						$max = $dataObj->getEspicalCdStr(array('MAX(`sort`)'=>'max_sort'), $maxConds);
						if (empty($max)) {
							$data['result'] = error(-1, '您还没有添加Tab页');
							return $this->ajaxReturn($data);
						}
						if ($ds['sort'] == $max[0]['max_sort']) {
							$data['result'] = error(-1, '已经到最右边了，不能再右移了');
							return $this->ajaxReturn($data);
						}
						$new_sort = intval($ds['sort']) + 1;
						$moveConds = appendLogicExp('subject_id', '=', $aa['subject_id']);
						$moveConds = appendLogicExp('key', 'LIKE', 'tab_%', 'AND', $moveConds);
						$moveConds = appendLogicExp('sort', '=', $new_sort, 'AND', $moveConds);
						$changeDS = $dataObj->getOne($moveConds);
						if (empty($changeDS)) {
							$data['result'] = error(-1, '要交换的目标对象不存在,移动失败');
							return $this->ajaxReturn($data);
						}
						// 自己加一
						$data['self_result'] = $dataObj->fieldAddAndSub(appendLogicExp('id', '=', $ds['id']), 'sort', 1, true);
						// 目标减一
						$data['aim_result'] = $dataObj->fieldAddAndSub(appendLogicExp('id', '=', $changeDS['id']), 'sort', 1, false);						
					}						
					// 刷新缓存
					if (error_ok($data['self_result']) === true || error_ok($data['aim_result']) === true) {
						MyHelp::saveConfigUpdateTime('cache_set_subject_'.$aa['subject_id']);
					}
					return $this->ajaxReturn($data);					
				} else {
					$data['result'] = error(-1, '没有可供排序的标签页');
					return $this->ajaxReturn($data);
				}
			} else if (stripos($aa['sql_type'], 'sort_line') === 0) {
				if (!empty($ds)) {					
					$thisIndex = -1;
					$vals = json_decode($ds['value'], true);
					foreach ($vals as $vk=>$vv) {
						if ($vv['id'] != $aa['value']) {
							if ($thisIndex == -1) {
								$forwardIndex = $vk;	
							}
						} else {
							$thisIndex = $vk;
							continue;
						}
						if ($thisIndex != -1) {
							$nextIndex = $vk;
							break;
						}
					}
					
					if ($thisIndex == -1) {
						$data['result'] = error(-1, '未能找到该线路');
						return $this->ajaxReturn($data);
					}
					
					if (stripos($aa['sql_type'], '_up') !== false) {
						if ($thisIndex == 0) {
							$data['result'] = error(-1, '已经到最上边了，不能再上移了');
							return $this->ajaxReturn($data);
						}
						$temp = $vals[$forwardIndex];
						$vals[$forwardIndex] = $vals[$thisIndex];
						$vals[$thisIndex] = $temp;
					} else {
						if ($thisIndex == intval(count($vals)-1)) {
							$data['result'] = error(-1, '已经到最下边了，不能再下移了');
							return $this->ajaxReturn($data);
						}
						$temp = $vals[$thisIndex];
						$vals[$thisIndex] = $vals[$nextIndex];
						$vals[$nextIndex] = $temp;
					}
					$ds['value'] = json_encode($vals);
				} else {
					$data['result'] = error(-1, '没有可供排序的线路');
					return $this->ajaxReturn($data);
				}
			} else if ($aa['sql_type'] == 'remove') {
				if (empty($ds['value']) || $ds['value'] === '[]') {
					$data['result'] = error(-1, '没有可移除的数据');
				} else {
					$vals = json_decode($ds['value'], true);
					$tempVals = array();
					foreach($vals as $vk=>$vv) {
						if ($vv['id'] != $aa['value']) {
							array_push($tempVals, $vv);
						}
					}
					$ds['value'] = empty($tempVals) ? '' : json_encode($tempVals);
				}
			} else if ($aa['sql_type'] == 'delete') {
				$data['result'] = $dataObj->remove($dataConds);
				if (error_ok($data['result']) === true) {
					if (stripos($ds['key'], 'tab_') == 0) {
						// 移除tab页下面的线路信息
						$lineKey = substr($ds['key'], '4');
						$conds = appendLogicExp('subject_id', '=', $aa['subject_id']);
						$conds = appendLogicExp('key', '=', $lineKey, 'AND', $conds);
						$data['line_result'] = $dataObj->remove($conds);
						// 移动线路tab页后面的序号
						$moveConds = appendLogicExp('subject_id', '=', $ds['subject_id']);
						$moveConds = appendLogicExp('key', 'LIKE', 'tab_%', 'AND', $moveConds);
						$moveConds = appendLogicExp('sort', '>', $ds['sort'], 'AND', $moveConds);
						$data['move_result'] = $dataObj->fieldAddAndSub($moveConds, 'sort', '1', false);
					}
				}
				return $this->ajaxReturn($data);
			} else {
				$data['result'] = error(-1, '未知的配置类型');
				return $this->ajaxReturn($data);
			}
		} else {
			$ds = $newDS;
		}
		if (stripos($ds['key'], 'hot_line_recommend') == 0) {
			$data['line'] = BackLineHelp::getLine(appendLogicExp('id', '=', $ds['value']), array('min_batch'=>true));
		}
		
		$data['last_ds'] = $ds;
		if ($bCreate) {				
			if (stripos($ds['key'], 'tab_') == 0) {
				$countConds = appendLogicExp('subject_id', '=', $ds['subject_id']);
				$countConds = appendLogicExp('key', 'LIKE', 'tab_%', 'AND', $countConds);
				$tabCount = $dataObj->getCount($countConds);
				$data['count'] = $tabCount;
				if (intval($tabCount) > 5) {
					$data['result'] = error(-1, '线路Tab页已达上限，不能再继续添加');
					return $this->ajaxReturn($data);
				}
			}	
			$data['result'] = $dataObj->create($ds, $dataId);
			$data['id'] = $dataId;
		} else {					
			unset($ds['subject_id']);
			unset($ds['key']);
			$data['result'] = $dataObj->modify($ds, $dataConds);
		}
		
		if (error_ok($data['result']) === true) {
			// 刷新缓存
			MyHelp::saveConfigUpdateTime('cache_set_subject_'.$aa['subject_id']);
		}
		$this->ajaxReturn($data);
	}
	
	// 生成预览专题的链接
	private function subjectPreviewUrl($aa) {
		if (empty($aa['id'])) {
			$data['result'] = error(-1, '生成预览链接错误，参数信息有误');
			$this->ajaxReturn($data);
		}
		$subject = BackLineHelp::getSubject(appendLogicExp('id','=',$aa['id']));
		
		$val['salt'] = substr(uniqid(rand()), -8);
		$val['time'] = fmtNowDateTime();
		$ds['preview_salt'] = my_json_encode($val);
		$subjectObj = ModelBase::getInstance('subject');
		$data['result'] = $subjectObj->modify($ds, appendLogicExp('id', '=', $aa['id']));
		$data['salt'] = $val['salt'];
		
		$data['result'] = error(0, '');
		$host = C('TMPL_PARSE_STRING.{__GLOBAL_HOST_URL__}');
		$url = U('line/subject',array('id'=>$aa['id'], 'p'=>$data['salt']));
		$url = str_replace('back','home',$url);
		$data['jumpUrl'] = $host.substr($url, 1);
		$this->ajaxReturn($data);
	}	
	
	// 删除专题
	private function deleteSubject($aa) {
		if (check_grant('line_subject') === false) {
			$data['result'] = error(-1, '您没有此操作权限');
			return $this->ajaxReturn($data);
		}
		if (empty($aa['id'])) {
			$data['result'] = error(-1, '删除专题的参数不足');
			return $this->ajaxReturn($data);
		}
		$subjectObj = ModelBase::getInstance('subject');
		$data['result'] = $subjectObj->remove(appendLogicExp('id', '=', $aa['id']));
		
		$dataObj = ModelBase::getInstance('subject_data');
		$data['data_result'] = $subjectObj->remove(appendLogicExp('subject_id', '=', $aa['id']));
		if (error_ok($data['result']) === true) {
			// 刷新缓存
			MyHelp::saveConfigUpdateTime('cache_set_subject_'.$aa['subject_id'], true);
		}
		return $this->ajaxReturn($data);
	}
	
	// 产品专题
	public function subjectAction() {
		if (IS_POST){
			$type = I('post.op_type', false);
			if ($type == 'list') {
				$this->listSubject('post', $_POST);
			} else if ($type == 'edit') {
				$this->saveSubject('post', $_POST);
			} else if ($type == 'data') {
				$this->subjectData($_POST);
			} else if ($type == 'preview_url') {
				$this->subjectPreviewUrl($_POST);
			} else if ($type == 'delete') {
				$this->deleteSubject($_POST);
			} else {
				$data['result'] = error(-1, '错误的操作类型，专题操作');
				$this->ajaxReturn($data);
			}
		} else {
			$type = I('get.type', false);
			if ($type == 'edit') {
				$this->saveSubject('get', $_GET);
			} else {
				$this->listSubject('get', $_GET);
			}
		}
	}
	
	//套餐列表
	private function listTaocan($requestType, $param){
		if($requestType == 'post'){
			$pageIndex = empty($param['page']) ? 0 : $param['page'];
			$startIndex = $pageIndex * LINE_TAOCAN_LIST_SHOW_COUNT;
		}else{
			$startIndex = 0;
		}
		
		$sort = array('id'=>'desc');
		$taocans = BackLineHelp::getTaocanList($conds, $startIndex, LINE_TAOCAN_LIST_SHOW_COUNT, $total, $sort);
		// 页数
		$pageCount = intval($total / LINE_TAOCAN_LIST_SHOW_COUNT);
		if (intval($total % LINE_TAOCAN_LIST_SHOW_COUNT) > 0) {
			$pageCount += 1;
		}
		
		if ($requestType == 'post') {
			$data['result'] = error(0, '');
			if ($total > 0) {
				$data['ds'] = $taocans;
				$data['page_count'] = $pageCount;
			} else {
				$data['result'] = error(-1, '未找到相关套餐信息');
			}
			return $this->ajaxReturn($data);
		} else {
			$this->assign('taocans', $taocans);
			$this->assign('page_count', $pageCount);
			$this->assign('modal_type_data', true);
			$this->_initBaseInfo('line_taocan', 'line', '套餐系统', '套餐列表');
			$this->display('taocan_list');
		}
	}
	
	//新建套餐
	private function createTaocan($requestType, $param){
		if($requestType == 'post'){						
			if(array_key_exists('name', $param)){
				if(empty($param['name'])){
					$data['result'] = error(-1, '套餐名称不能为空');
					$this->ajaxReturn($data);
				}
			}
				
			$account = MyHelp::getLoginAccount(false);
			if(is_error($account) === true){
				$data['result'] = error(-1, '账户未登陆');
				$data['jumpUrl'] = U('Admin/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI'])));
				return $this->ajaxReturn($data);
			}
						
			$taocanObj = ModelBase::getInstance('taocan');
			$colNames = $taocanObj->getUserDefine(ModelBase::DF_COL_NAMES);
			
			$ds = coll_elements_giveup($colNames, $param);	

			if(empty($ds['id'])){
				$data['cols'] = $colNames;
				if(empty($ds['name'])){
					$data['result'] = error(-1, '套餐名称不能为空');
					$this->ajaxReturn($data);
				}				
				$count = $taocanObj->getCount(appendLogicExp('name', '=', $ds['name']));
				if($count > 0){
					$data['result'] = error(-1, '该名称的套餐已经存在');
					return $this->ajaxReturn($data);
				}				
				$data['result'] = $taocanObj->create($ds, $taocanId);
				$data['id'] = $taocanId;
			}else{				
				$data['id'] = $ds['id'];
				$conds = appendLogicExp('id', '=', $ds['id']);
				unset($ds['id']);
				$data['result'] = $taocanObj->modify($ds,$conds);
			}			
			$this->ajaxReturn($data);		
			
		}else{			
			$data['result'] = error(-1, '请求类型错误');
			$this->ajaxReturn($data);
		}
	}
	
	// 查询套餐
	private function findTaocan($requestType, $param) {
		if ($requestType == 'post') {
			$taocanObj = ModelBase::getInstance('taocan');
			$colNames = $taocanObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$cds = coll_elements_giveup($colNames, $param);
			$conds = MyHelp::getLogicExp($cds, '=', 'AND');
			
			$findType = I('post.find_type', '');
			if ($findType == 'all') {
				$data['ds'] = BackLineHelp::getTaocanList($conds);
			} else {
				$data['ds'] = BackLineHelp::getTaocan($conds);
			}
			$this->ajaxReturn($data);
		} else {
			$this->showError('404', '访问错误', '您访问的页面不存在', '错误的访问链接');
		}
	}

	//编辑套餐
	private function editTaocan($requestType, $param){
		if($requestType == 'post'){						
			if(array_key_exists('id', $param)){
				if(empty($param['id'])){
					$data['result'] = error(-4, '套餐名称不能为空');
					$this->ajaxReturn($data);
				}
			}
				
			$account = MyHelp::getLoginAccount(false);
			if(is_error($account) === true){
				$data['result'] = error(-3, '账户未登陆');
				$data['jumpUrl'] = U('Admin/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI'])));
				return $this->ajaxReturn($data);
			}
			
			$taocanObj = ModelBase::getInstance('taocan');
			$colNames = $taocanObj->getUserDefine(ModelBase::DF_COL_NAMES);
			
			$ds = coll_elements_giveup($colNames, $param);	
						
			$data['id'] = $ds['id'];
			$conds = appendLogicExp('id', '=', $ds['id']);
			unset($ds['id']);
			$data['result'] = $taocanObj->modify($ds,$conds);
			return $this->ajaxReturn($data);
		}else{
			$data['result'] = error(-1, '请求类型错误');
			return $this->ajaxReturn($data);
		}
	}
	
	//套餐设为无效
	private function removeTaocan($requestType, $param){
		if($requestType == 'post'){
			if(array_key_exists('id', $param)){
				if(empty($param['id'])){
					$data['result'] = error(-4, '套餐名称不能为空');
					$this->ajaxReturn($data);
				}
			}
				
			$account = MyHelp::getLoginAccount(false);
			if(is_error($account) === true){
				$data['result'] = error(-3, '账户未登陆');
				$data['jumpUrl'] = U('Admin/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI'])));
				return $this->ajaxReturn($data);
			}			
			
			$ds['invalid'] = 1;
			$taocanObj = ModelBase::getInstance('taocan');
			$data['result'] = $taocanObj->modify($ds, appendLogicExp('id', '=', $param['id']));
			$this->ajaxReturn($data);
			
		}else{
			$data['result'] = error(-1, '请求类型错误');
			return $this->ajaxReturn($data);
		}
	}
	
	// 检查套餐价格
	private function checkTaocanPrice($requestType, $param){
		if ($requestType == 'post') {
			if(empty($param['datas']) || count($param['datas']) < 1){
				$data['result'] = error(-3, '请求参数不完整');
				$this->ajaxReturn($data);
	 		}
			
			$account = MyHelp::getLoginAccount(false);
			if(is_error($account) === true){
				$data['result'] = error(-4, '账户未登陆');
				$data['jumpUrl'] = U('Admin/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI'])));
				$this->ajaxReturn($data);
			}
			
			$conds = appendLogicExp('taocan_ids', '=', $param['datas'][0]['taocan_ids']);
			$conds = appendLogicExp('invalid', '=', 0, 'AND', $conds);
			$tcPrices = BackLineHelp::getTaocanPriceList($conds);
			foreach ($tcPrices as $tk=>$tv) {
				$priceMap[$tv['batch_id']] = $tv;
			}
			$data['price'] = $tcPrices;
			
			unset($tcPrices);
			
			$existData = array();
			$data['ds'] = array();
			$data['ds_test'] = '11111111111';
			foreach($param['datas'] as $tk => $tv){	
				$tv['exist'] = 0;
				if (!empty($priceMap[$tv['batch_id']])) {
					$tv['exist'] = 1;
					array_push($existData, $tv);
				}
				$tv['id'] = $priceMap[$tv['batch_id']]['id'];
				array_push($data['ds'], $tv);
			}

			if (!empty($existData)) {
				$data['exists'] = $existData;				
				$data['result'] = error(1, '有重复信息');
			} else {
				$data['result'] = error(0, '未找到重复数据');
			}
			return $this->ajaxReturn($data);
		} else {
			$data['result'] = error(-1, '请求类型错误!');
			return $this->ajaxReturn($data);
		}
	}

	// 创建套餐价格
	private function createTaocanPrice($requestType, $param){
	 	if($requestType == 'post'){			
			$account = MyHelp::getLoginAccount(false);
			if(is_error($account) === true){
				$data['result'] = error(-4, '账户未登陆');
				$data['jumpUrl'] = U('Admin/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI'])));
				$this->ajaxReturn($data);
			}
			
	 		if(empty($param['datas']) || count($param['datas']) < 1){
				$data['result'] = error(-3, '请求参数不完整');
				$this->ajaxReturn($data);
	 		}
			
			$data['result'] = error(0, '保存成功');
			$tpObj = ModelBase::getInstance('taocan_price');
			$colName = $tpObj->getUserDefine(ModelBase::DF_COL_NAMES);
			
			$resultDS = array(); $errorDS = array();
			foreach($param['datas'] as $tk => $tv){
				$ds = coll_elements_giveup($colName,$tv);
				
				// 价格编号为空创建套餐价格
				if(empty($tv['id']) && empty($tv['exist'])){					
					$result = $tpObj->create($ds, $priceId);
					$tv['id'] = $priceId;
					$tv['op'] = 'create';
					if (error_ok($result) === false) {
						$data['result'] = error(-1, '存在未创建成功的数据,详情请看输出打印');
//						$tv['sql'] = $tpObj->getLastSql();
						array_push($errorDS,$tv);
					} else {
						array_push($resultDS, $tv);
					}	
					
					
				// 价格编号不为空编辑套餐价格			
				}else{
					unset($ds['id']);
					$result = $tpObj->modify($ds, appendLogicExp('id', '=', $tv['id']));
					$tv['op'] = 'save';
					if (error_ok($result) === false) {
						$data['result'] = error(-1, '存在未保存成功的数据,详情请看输出打印');
//						$tv['sql'] = $tpObj->getLastSql();
						array_push($errorDS,$tv);
					} else {
						array_push($resultDS, $tv);
					}				
				}
			}			
			$data['resultDS'] = $resultDS;	
			$data['errorDS'] = $errorDS;			
			$this->ajaxReturn($data);
			
	 	}else{
	 		$data['result'] = error(-1, '请求类型错误!');
			$this->ajaxReturn($data);
	 	}
	}
	
	//移除套餐价格
	private function removeTaocanPrice($requestType, $param){
		if ($requestType == 'post') {
			if (empty($param['tp_id'])) {
				$data['result'] = error(-2, '请求参数不完整');
				$this->ajaxReturn($data);
	 		}
	 		
	 		$account = MyHelp::getLoginAccount(false);
			if (is_error($account) === true) {
				$data['result'] = error(-4, '账户未登陆');
				$data['jumpUrl'] = U('Admin/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI'])));
				$this->ajaxReturn($data);
			}
			
			$ds['invalid'] = 1;
			$taocanObj = ModelBase::getInstance('taocan_price');
			$data['result'] = $taocanObj->modify($ds, appendLogicExp('id', '=', $param['tp_id']));
			$this->ajaxReturn($data);
			
		} else {
			$data['result'] = error(-1, '错误的请求类型!');
			$this->ajaxReturn($data);
		}
	}
	
	// 获取套餐价格
	private function findTaocanPrice() {
		$cdsstr = I('post.cdsstr', '');
		$cdType = I('post.cdtype', false);
		if (empty($cdsstr) || empty($cdType)) {
			$data['result'] = error(-1, '获取套餐的条件不足');
			return $this->ajaxReturn($data);
		}
		
		$data['result'] = error(0, '');
		$conds = MyHelp::getCondsByStr($cdsstr,$cdType);
		$data['ds'] = BackLineHelp::getTaocanPriceList($conds, 0, 0, $total, array('price_adult'), array('taocan'=>true));
		$this->ajaxReturn($data);
	}
	
	// 根据价格获取套餐(过滤重复的套餐)
	private function getTaocanByPrice() {
		$cdsstr = I('post.cdsstr', '');
		$cdType = I('post.cd_type', false);
		if (empty($cdsstr) || empty($cdType)) {
			$data['result'] = error(-1, '获取套餐的条件不足');
			return $this->ajaxReturn($data);
		}
		$conds = MyHelp::getCondsByStr($cdsstr,$cdType);
		$data['price_conds'] = $conds;
		$prices = BackLineHelp::getTaocanPriceList($conds);
		$data['prices'] = $prices;
		$taocanIds = array();
		foreach ($prices as $pk=>$pv) {
			$tempIds = BackLineHelp::TaocanPriceIds2RealIds($pv['taocan_ids']);
			if (is_error($tempIds) === false) {
				$taocanIds = array_merge($taocanIds, $tempIds);
			}
		}
		$data['ids0'] = $taocanIds;
		$taocanIds = array_unique($taocanIds);
		$data['ids1'] = $taocanIds;
		$idsstr = implode(',', $taocanIds);
		$data['ids2'] = $idsstr;
		$conds = appendLogicExp('id', 'IN', '('.$idsstr.')');
		$taocans = BackLineHelp::getTaocanList($conds);
		foreach ($taocans as $tk=>$tv) {
			$type = $tv['type_data'];
			if (empty($ds[$type['type_key']])) {
				$ds[$type['type_key']]['type'] = $type;
				$ds[$type['type_key']]['data'] = array($tv);
			} else {				
				$tempData = $ds[$type['type_key']]['data'];
				array_push($tempData, $tv);
				$ds[$type['type_key']]['data'] = $tempData;
			}
		}
		$data['ds'] = $ds;
		return $this->ajaxReturn($data);
	}

	//产品套餐
	public function taocanAction(){
		if(IS_POST){
			$type = I('post.op_type', false);
			if($type == 'create_taocan'){
				$this->createTaocan('post', $_POST);
			} elseif($type == 'edit_taocan') {
				$this->editTaocan('post', $_POST);
			} elseif($type == 'remove_taocan') {
				$this->removeTaocan('post', $_POST);
			} elseif($type == 'list_taocan') {
				$this->listTaocan('post', $_POST);
			} elseif($type == 'find_taocan') {
				$this->findTaocan('post', $_POST);
			} elseif($type == 'create_taocan_price') {
				$this->createTaocanPrice('post', $_POST);
			} elseif($type == 'check_taocan_price') {
				$this->checkTaocanPrice('post', $_POST);
			} elseif($type == 'remove_taocan_price') {
				$this->removeTaocanPrice('post', $_POST);
			} elseif($type == 'find_taocan_price') {
				$this->findTaocanPrice('post', $_POST);
			} elseif($type == 'taocan_by_price') {
				$this->getTaocanByPrice('post', $_POST);
			} else{
				
				$data['result'] = error(-1, '错误的请求类型');
				$this->ajaxReturn($data);
			}
			
		}else{
			$type = I('get.type', false);
			if($type == 'create'){
				$this->createTaocan('get', $_GET);
			}elseif($type == 'edit'){
				$this->editTaocan('get', $_GET);
			}else{
				$this->listTaocan('get', $_GET);
			}
		}
	}
}

?>