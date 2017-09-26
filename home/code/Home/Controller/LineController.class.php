<?php
namespace Home\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackLineHelp;
use Core\Model\BackOrderHelp;
use Core\Model\BackAccountHelp;
use Core\Model\BackReviewHelp;
use Core\Model\MsgHelp;
use Core\Model\BackTeamHelp;

define('LINE_LIST_SHOW_COUNT', 10);
define('ORDER_CENTER_LIST_SHOW_COUNT', 6);
define('LINE_QUESTION_LIST_SHOW_COUNT', 6);
define('LINE_ARTICLE_LIST_SHOW_COUNT', 6);
define('LINE_QUESTION_TEXT_SHOW_COUNT', 23);
define('LINE_VIDEO_LIST_SHOW_COUNT', 12);

class LineController extends HomeBaseController {	
	
	// 搜索框搜索产品
	public function searchAction() {
		session_start();						
		if (IS_POST) {
			$searchval = I('post.searchval', '');
			if (!empty($searchval))
			{
				session('line_search_val', $searchval);
				$data['jumpUrl'] = U('line/search');
				return $this->ajaxReturn($data);				
			} else {
				$searchval = session('line_search_val');
			}
			$pageIndex = I('post.page', 0);
			$sortstr = I('post.sorts', false);
		} else {
			$searchval = session('line_search_val');
			$pageIndex = 0;
		}		
		
		if (!empty($cdsstr)) {			
			$cdList = explode('|',$cdsstr);
			for($i = 0; $i < count($cdList); $i+=4){
				$cds[$cdList[$i]] = $cdList[$i+1];
				$conds = appendLogicExp($cdList[$i], $cdList[$i+1], $cdList[$i+2], $cdList[$i+3], $conds);
			}	
		}
		
		if (!empty($searchval)) {	
			$searchConds = appendLogicExp('title', 'LIKE', '%'.$searchval.'%', 'OR', $searchConds);
			$searchConds = appendLogicExp('subheading', 'LIKE', '%'.$searchval.'%', 'OR', $searchConds);
			$searchConds = appendLogicExp('theme_type', 'LIKE', '%'.$searchval.'%', 'OR', $searchConds);
			$searchConds = appendLogicExp('play_type', 'LIKE', '%'.$searchval.'%', 'OR', $searchConds);
			$searchConds = appendLogicExp('dismiss_place', 'LIKE', '%'.$searchval.'%', 'OR', $searchConds);
			$searchConds = appendLogicExp('assembly_point', 'LIKE', '%'.$searchval.'%', 'OR', $searchConds);
			$searchConds = appendLogicExp('destination', 'LIKE', '%'.$searchval.'%', 'OR', $searchConds);
			$searchConds = appendLogicExp('view_point', 'LIKE', '%'.$searchval.'%', 'OR', $searchConds);
			$searchConds = appendLogicExp('hotel_type', 'LIKE', '%'.$searchval.'%', 'OR', $searchConds);
		}		
		
		if (!empty($sortstr)) {
			$sortList = explode('|', $sortstr);
			for($i = 0; $i < count($sortList); $i+=2){
				$sorts[$sortList[$i]] = $sortList[$i+1];
			}
		} else {
			$sort = array('sort'=>'asc', 'create_time'=>'desc');	
		}
		
		if (!array_key_exists('recommend', $sorts)) {
			$sorts['recommend'] = 'desc';
		}
		if (!array_key_exists('hot', $sorts)) {
			$sorts['hot'] = 'desc';
		}
		array('sort'=>'asc');
		if (!array_key_exists('create_time', $sorts)) {
			$sorts['create_time'] = 'desc';
		}
		
		$conds = appendLogicExp('online', '=', '1', 'AND', $conds);
		$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
		if (!empty($searchConds)) {
			$conds = appendLogicExp('searchval', '=', $searchConds, 'AND', $conds);	
		}
		$find = array('batch'=>true);
		$startIndex = $pageIndex * LINE_LIST_SHOW_COUNT;
		$ds = BackLineHelp::getLineList($conds, $startIndex, LINE_LIST_SHOW_COUNT, $total, $sorts, $find, $out);
		$pageCount = intval($total / LINE_LIST_SHOW_COUNT);
		if ($total % LINE_LIST_SHOW_COUNT > 0) {
			$pageCount += 1;
		}
		
		if (IS_POST) {
			$data['out'] = $out;
			$data['ds'] = $ds;
			$data['page_count'] = $pageCount;
			$data['result'] = error(0, '');						
			return $this->ajaxReturn($data);
		} else {
			$this->assign('out', $out);
			$this->assign('searchval', $searchval);
			$this->assign('lines', $ds);
			$this->assign('page_count', $pageCount);			
			$this->showPage('search', 'line_search', 'line', '产品搜索', '产品搜索');
		}
	}
	
	// 处理首页导航信息
	private function homeNavigation($aa, &$homeNavigation) {		
		// 定义数据字典
		$dtMap = array('m0'=>'theme_type', 'm1'=>'destination', 'm2'=>'view_point', 'lm0'=>'theme_type', 'lm1'=>'destination', 'lm2'=>'view_point');
		
		$homeNavigation = array();
		foreach ($dtMap as $dk=>$dv) {
			if (!empty($aa[$dk])) {
				$menuTypeKey = stripos($dk, 'lm') === 0 ? 'pc_home_left_menu' : 'pc_home_menu';
				$item = MyHelp::MenuItemKey2Value($menuTypeKey, intval($aa[$dk]), true);
				if (is_error($item) === false) {
					array_push($homeNavigation, $item);
					if (!empty($cdsstr)) {
						$cdsstr .= '|';
					}
					$cdsstr .= $dtMap[$dk].'|'.$item['item_desc'];
				}
			}
		}
		return $cdsstr;
	}
	
	// 清除条件
	public function resetCDAction() {
		session_start();
		unset($_SESSION['line_list_cdsstr']);
		$data['result'] = error(0, '重置条件成功');
		$this->ajaxReturn($data);
	}

	// 产品列表展示
	public function listAction() {    	
		session_start();
		if (IS_POST) {
			$page = I('post.page', 0);	
			$cdsstr = I('post.cds', false);
			$sortstr = I('post.sorts', false);
			$refresh = I('post.refresh', false);
			$navcdsstr = session('line_navigation_cdsstr');
			if (!empty($cdsstr)) {
				session('line_list_cdsstr', $cdsstr);
				$cdsstr = empty($navcdsstr) ? $cdsstr : ($navcdsstr . '|' . $cdsstr);
			} else {
				unset($_SESSION['line_list_cdsstr']);
				$cdsstr = empty($navcdsstr) ? '' : $navcdsstr;
			}
		} else {
			$page = I('get.page', 0);	
			$cdsstr = I('get.cds', '');
			$cache = I('get.cache', 0);
			if (!empty($cache)) {
				session('line_list_cdsstr', $cdsstr);
				$listcdsstr = $cdsstr;
			} else {
				$listcdsstr = session('line_list_cdsstr');
				if (!empty($listcdsstr)) {
					$cdsstr = empty($cdsstr) ? $listcdsstr : ($cdsstr . '|' . $listcdsstr);
				}
			}
			// 处理首页导航
			$result = $this->homeNavigation($_GET, $navigationCondition);
			session('line_navigation_data', $navigationCondition);
			$this->assign('nav_get', $_GET);
			$this->assign('nav_result', $result);
			$this->assign('navigation', $navigationCondition);
			if (!empty($result)){
				session('line_navigation_cdsstr', $result);
				$cdsstr = empty($cdsstr) ? $result : ($result . '|' . $cdsstr);
			} else {
				unset($_SESSION['line_navigation_cdsstr']);
				$cdsstr = empty($cdsstr) ? $cdsstr : $cdsstr;
			}		
						
			$sortstr = I('get.sorts', false);
			$refresh = I('get.refresh', false);
		}	
		$startIndex = $page * LINE_LIST_SHOW_COUNT;
		
		if (!empty($cdsstr)) {
			$condList = array();
			$cdList = explode('|',$cdsstr);
			for($i = 0; $i < count($cdList); $i+=2) {
				if (intval($cdList[$i+1]) == -1) {
					continue;
				}
				if ($cdList[$i] == 'c0') {
					$conds = appendLogicExp('theme_type', 'LIKE', '%\"id\":\"'.$cdList[$i+1].'\"%', 'AND', $conds);
					$themeType = MyHelp::TypeDataKey2Value($cdList[$i+1], true);
					if (!empty($refresh)) {
						$jumpUrl = U('line/list');
						if (is_error($themeType) === false) {
							$menuItemObj = ModelBase::getInstance('menu_item');
							$menuItem = $menuItemObj->getOne(appendLogicExp('item_desc', '=', $themeType['type_desc']));
							if (!empty($menuItem)) {
								$jumpUrl = U('line/list', array('m0'=>$menuItem['id']));
							}
						}
						$data['jumpUrl'] = $jumpUrl;
						return $this->ajaxReturn($data);
					}
				} else if ($cdList[$i] == 'c1') {
					$conds = appendLogicExp('destination', 'LIKE', '%\"id\":\"'.$cdList[$i+1].'\"%', 'AND', $conds);
				} else if ($cdList[$i] == 'c2') {
					$viewConds = appendLogicExp('view_point', 'LIKE', '%\"id\":\"'.$cdList[$i+1].'\"%', 'OR', $viewConds);
				} else if ($cdList[$i] == 'c3') {
					$conds = appendLogicExp('assembly_point', 'LIKE', '%\"id\":\"'.$cdList[$i+1].'\"%', 'AND', $conds);
				} else if ($cdList[$i] == 'c4') {
					$conds = appendLogicExp('trip_month', 'LIKE', '%\"id\":\"'.$cdList[$i+1].'\"%', 'AND', $conds);
				} else if ($cdList[$i] == 'c5') {
					$conds = appendLogicExp('travel_day', '=', $cdList[$i+1], 'AND', $conds);
				} else if ($cdList[$i] == 'c6') {
					$conds = appendLogicExp('line_area', 'LIKE', '%\"id\":\"'.$cdList[$i+1].'\"%', 'AND', $conds);
				} else {
					$conds = appendLogicExp($cdList[$i], 'LIKE', '%'.$cdList[$i+1].'%', 'AND', $conds);
				}
			}
			if (!empty($viewConds)) {
				$conds = appendLogicExp('view_point', '=', $viewConds, 'AND', $conds);
			}
		}
		
		if (!empty($sortstr)) {
			$sortList = explode('|', $sortstr);
			for($i = 0; $i < count($sortList); $i+=2){
				$sorts[$sortList[$i]] = $sortList[$i+1];
			}
		} else {
			$sort = array('recommend'=>'desc', 'hot'=>'desc', 'create_time'=>'desc', 'sort'=>'asc');	
		}
		
		if (!array_key_exists('recommend', $sorts)) {
			$sorts['recommend'] = 'desc';
		}
		if (!array_key_exists('hot', $sorts)) {
			$sorts['hot'] = 'desc';
		}
		if (!array_key_exists('create_time', $sorts)) {
			$sorts['create_time'] = 'desc';
		}
		
		$conds = appendLogicExp('online', '=', '1', 'AND', $conds);
		$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
		$find = array('batch'=>true);		
		$ds = BackLineHelp::getLineList($conds, $startIndex, LINE_LIST_SHOW_COUNT, $total, $sorts, $find, $out);
		$pageCount = intval($total / LINE_LIST_SHOW_COUNT);
		if ($total % LINE_LIST_SHOW_COUNT > 0) {
			$pageCount += 1;
		}
		
		if (IS_POST) {
			$data['page_count'] = $pageCount;
			$data['result'] = error(0,"");
			$data['ds'] = $ds;
			$this->ajaxReturn($data);
		} else {				
			$this->assign('lines', $ds);
			$this->assign('page_count', $pageCount);
			$this->assign('cdsstr', $listcdsstr);
			
			// 产品主题
			$lineTheme = MyHelp::getTypeData('line_theme');
			if (is_error($lineTheme) === false) {
				$this->assign('line_theme', $lineTheme);	
			}
			
			// 产品区域
			$lineArea = MyHelp::getTypeData('line_area');
			if (is_error($lineArea) === false) {
				$this->assign('line_area', $lineArea);	
			}
			
			// 包含景点
			$view_point = MyHelp::getTypeData('line_view_point');
			if (is_error($view_point) === false) {
				$this->assign('view_point', $view_point);	
			}
			
			// 集合地
			$assemblyPlace = MyHelp::getTypeData('line_assembly_point');
			if (is_error($assemblyPlace) === false) {
				$this->assign('assembly_place', $assemblyPlace);	
			}
			
			// 目的地
			$dest = MyHelp::getTypeData('line_destination');
			if (is_error($dest) === false) {
				$this->assign('dest', $dest);	
			}
			
			// 旅行月份
			$month = MyHelp::getTypeData('month');
			if (is_error($months) === false) {
				$this->assign('month', $month);	
			}
			
			$this->showPage('list', 'line_list', 'line', '产品列表');
		}
	}
	
	// 线路列表
	public function xiezhenlvxingAction() {
		if (IS_POST) {
			$page = I('post.page', 0);
			$cds = I('post.cds', false);
			if (!empty($cds)) {
				$cdList = explode('|', $cds);	
				for ($i = 0; $i < count($cdList); $i+=3) {
					$conds = appendLogicExp($cdList[$i], $cdList[$i+1], $cdList[$i+2], 'AND', $conds);
				}
			}			
		} else {
			$page = I('get.page', 0);
		}
		
		$startIndex = $page * LINE_LIST_SHOW_COUNT;
		$conds = appendLogicExp('qinglvpai', '>', '0', 'AND', $conds);
		$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
		$conds = appendLogicExp('online', '=', '1', 'AND', $conds);
		$sort = array('online'=>'desc','recommend'=>'desc', 'hot'=>'desc','leader_recommend'=>'desc','create_time'=>'desc','sort'=>'asc');
		$find = array('batch'=>true);
		$ds = BackLineHelp::getLineList($conds, $startIndex, LINE_LIST_SHOW_COUNT, $total, $sort, $find);
		
		$pageCount = intval($total / LINE_LIST_SHOW_COUNT);
		if (intval($total % LINE_LIST_SHOW_COUNT) > 0) {
			$pageCount += 1;
		}
		
		if (IS_POST) {
			$data['result'] = error(0,'');
			$data['ds'] = $ds;
			$data['page_count'] = $pageCount;
			$data['page_size'] = LINE_PAGE_SHOW_COUNT;
			$this->ajaxReturn($data);
		} else {
			$this->assign('conds', $conds);
			$this->assign('page_count', $pageCount);
			$this->assign('lines', $ds);
			$this->assign('page_size', LINE_PAGE_SHOW_COUNT);	
			$this->showPage('qlp_list', 'line_qlp_list', 'line', '新旅拍线路-领袖户外');
		}
	}
	
	private function findBatchByDate() {
		$lineId = I('post.line_id',false);
		if (empty($lineId)) {
			$data['result'] = error(-1, '产品编号无效');
			return $this->ajaxReturn($data);
		}
		$line = BackLineHelp::getLine(appendLogicExp('id', '=', $lineId));
		
		$conds = appendLogicExp('line_id', '=', $lineId);
		$year = I('post.year', false); 
		if (!empty($year)) {
			$conds = appendLogicExp('start_time', 'LIKE', '%'.$year.'%', 'AND', $conds);
		}
		$data['result'] = error(0, '');
		$conds = appendLogicExp('use_state', 'NOT LIKE', '%line_batch_use_forbid%', 'AND', $conds);
		$ds = BackLineHelp::getBatchList($conds, 0, 0, $total, array('start_time'=>'asc'));	
		foreach ($ds as $bk=>$bv) {
			$bv['sub_member'] = BackLineHelp::getBatchSubMember($bv['id'], $line['max_team_count'], $out);
			$bv['out'] = $out;
			$ds[$bk] = $bv;
		}							
		$data['ds'] = $ds;
		$data['total'] = $total;
		$data['line_id'] = $lineId;
		return $this->ajaxReturn($data);
	}
	
	private function findBatchByTaocan() {
		$lineId = I('post.line_id',false);
		$date = I('post.year', false);
		$taocanIds = I('post.taocan_ids',false);
		$batchId = I('post.batch_id', false);
		if (empty($lineId) || empty($date)) {
			$data['result'] = error(-1, '请求参数不完整');
			$this->ajaxReturn($data);
		}
		$line = BackLineHelp::getLine(appendLogicExp('id', '=', $lineId));
		
		$params['table'] = '`kl_batch` AS `q1`';
		$params['col'] = array(
			'`q1`.`id`'=>'`id`',
			'`q1`.`price_adult`'=>'`price_adult`',
			'`q1`.`price_child`'=>'`price_child`',
			'`q1`.`start_time`'=>'`start_time`',
			'`q1`.`end_time`'=>'`end_time`',
			'`q1`.`state`'=>'`state`',
			'`q1`.`sub_member`'=>'`sub_member`',
			'`q2`.`id`'=>'`price_id`',
			'`q2`.`batch_id`'=>'`batch_id`',
			'`q2`.`taocan_ids`'=>'`taocan_ids`',
			'`q2`.`price_adult`'=>'`tc_price_adult`',
			'`q2`.`price_child`'=>'`tc_price_child`',
		);
		
		$params['join'] = array('RIGHT JOIN `kl_taocan_price` AS `q2` ON `q1`.`id` = `q2`.`batch_id`');
		$conds = appendLogicExp('`q1`.`start_time`', 'LIKE', $date.'%', 'AND', $conds);
		$conds = appendLogicExp('`q1`.`use_state`', 'NOT LIKE', '%line_batch_use_forbid%', 'AND', $conds);
		$conds = appendLogicExp('`q2`.`invalid`', '!=', '1', 'AND', $conds);
		$conds = appendLogicExp('`q2`.`line_id`', '=', $lineId, 'AND', $conds);
		if (!empty($taocanIds)) {
			$conds = appendLogicExp('`q2`.`taocan_ids`', '=', $taocanIds, 'AND', $conds);
		}
		if (!empty($batchId)) {
			$conds = appendLogicExp('`q2`.`batch_id`', '=', $batchId, 'AND', $conds);
		}
		$params['conds'] = $conds;
		$batchObj = ModelBase::getInstance('batch');
		$ds = $batchObj->queryData($params, $total);
		//$data['sql'] = $batchObj->getLastSql();	
		
		foreach($ds as $tk => $tv){
			if (!empty($tv['price_id'])) {
				// 使用套餐价格
				$tv['price_adult'] = $tv['tc_price_adult'];
				$tv['price_child'] = $tv['tc_price_child'];
				
				// 套餐去重
				$ids = BackLineHelp::TaocanPriceIds2RealIds($tv['taocan_ids']);
				if (empty($taocanIdList)) {
					$taocanIdList = $ids;
				} else {
					foreach ($ids as $ik=>$iv) {
						if (!in_array($iv, $taocanIdList)) {
							array_push($taocanIdList, $iv);
						}
					}
					
						
				}
				
				// 批次去重
				if (empty($batchIdList)) {
					$batchIdList = array($tv['batch_id']);
				} else {
					if (!in_array($tv['batch_id'], $batchIdList)) {
						array_push($batchIdList, $tv['batch_id']);
					}
				}
			}
			
			// 截取开始时间、结束时间
			$start_date = explode(' ', $tv['start_time']);
			$tv['start_date_show'] = $start_date[0]; 
			$end_date = explode(' ', $tv['end_time']);
			$tv['end_date_show'] = $end_date[0];
			
			// 剩余人数
			$bv['sub_member'] = BackLineHelp::getBatchSubMember($bv['id'], $line['max_team_count']);			
			
			$ds[$tk] = $tv;
		}				
		$data['result'] = error(0, '');
		$data['taocan_ids'] = array_values($taocanIdList);
		$data['batch_ids'] = $batchIdList;
		$data['ds'] = $ds;
		$data['total'] = $total;
		$data['line_id'] = $lineId;
		return $this->ajaxReturn($data);
	}
	
	public function infoAction() {
		if (IS_POST) {
			$type = I('post.type', false);
			if ($type == 'find_batch') {
				$this->findBatchByDate();
			} elseif ($type = 'find_taocan_batch') {
				$taocanIds = I('post.taocan_ids',false);
				$batchId = I('post.batch_id', false);
				if (empty($taocanIds) && empty($batchId)) {
					$this->findBatchByDate();
				} else {
					$this->findBatchByTaocan();
				}
			} else {
				$data['result'] = error(-1, '错误的请求方式');
				return $this->ajaxReturn($data);
			}
		} else {
			$id = I('get.id', false);
			if (!empty($id)){				
				$find = array(
//					'min_batch'=>true,
					'point'=>true,
					'travel'=>true,
					'scenery'=>true,
//					'batch'=>true,
					'offer'=>true,
//					'article'=>array('content'=>true)
					'set'=>true,
				);
				$line = BackLineHelp::getLine(appendLogicExp('id', '=', $id), $find);
				$batchConds = appendLogicExp('line_id', '=', $line['id']);
				$batchConds = appendLogicExp('use_state', 'NOT LIKE', '%line_batch_use_forbid%', 'AND', $batchConds);
				$line['batchs'] = BackLineHelp::getBatchList($batchConds, 0, 0, $total, array('start_time'=>'asc'));
				foreach ($line['batchs'] as $bk=>$bv) {
					$bv['sub_member'] = BackLineHelp::getBatchSubMember($bv['id'], $line['max_team_count']);
					$line['batchs'][$bk] = $bv;
				}
				
				//获取产品已添加的套餐价格
				$tplConds = appendLogicExp('line_id', '=', $line['id']);
				$tplConds = appendLogicExp('invalid', '=', '0', 'AND', $tplConds);
				$tplFind = array('taocan'=>true);				
				$taocanPrices = BackLineHelp::getTaocanPriceList($tplConds, 0, 0, $total, array('id'=>'asc'), $tplFind);
				foreach ($taocanPrices as $tk=>$tv) {
					foreach ($tv['taocans'] as $tvk=>$tvv){
						$taocanMap[$tvv['id']] = $tvv;	
					}
				}			 
				$line['taocanList'] = $taocanMap;
				
				// 预览相关
				$setObj = ModelBase::getInstance('set');
				$setConds = appendLogicExp('type', '=', 'back_line_preview');
				$setConds = appendLogicExp('key', '=', 'preview_line_'.$id, 'AND', $setConds);
				$set = $setObj->getOne($setConds);
				if (!empty($set)) {
					$setval = json_decode($set['value'], true);
					if (time() - strtotime($setval['time']) > 10){
						$deleteSetPreview = true;
					}
				}
				
				$preview = I('get.p', '');
				if (empty($preview)) {					
					if ($line['online'] == '0' || $line['invalid'] == '1') {
						$forbiddenShow = true;
					}	
				} else {
					$deleteSetPreview = true;
					if (empty($setval) || $preview !== $setval['salt']) {
						$forbiddenShow = true;
					}
				}
				
				if (!empty($deleteSetPreview)) {
					$setObj->remove($setConds);
				}
				
				if (!empty($forbiddenShow)) {
					return $this->showError('502', '线路错误', '线路未上架', '该线路可能已经下架或者不存在');
				}
				
				if (empty($line['is_xinlvpai'])) {
					//问题填充
					if (!empty($line['questions'])) {
						foreach($line['questions'] as $qk=>$qv) {
							if ($qv['question_id'] != 0) {
								$dt = fmtDateTimeToNow($qv['create_time']);
								$qv['before_now'] = $dt['ago_show_text'];
								$line['questions'][$qk] = $qv;
							}
						}
					}
					// 是否存在游记
					$line['exist_youji'] = 0;
					$line['exist_recommend_line'] = 0;
					$subRecommendLineCount = 4;
					$recommendLineKey = 0;
					foreach ($line['sets'] as $sk=>$sv) {
						if (stripos($sv['key'], 'youji') !== FALSE) {
							$line['exist_youji'] = 1;
						}
						if (stripos($sv['key'], 'recommend_line') !== FALSE) {
							$subRecommendLineCount --;
							$recommendLineKey ++;
							$line['exist_recommend_line'] = 1;
						}
					}
					
					// 没有推荐时默认从产品库调用
					if ($subRecommendLineCount > 0) {
						$conds = appendLogicExp('id', '!=', $line['id']);
						$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
						$conds = appendLogicExp('online', '=', '1', 'AND', $conds);
						$subConds = $conds;
						foreach($line['destination_list'] as $dk=>$dv) {
							$destConds = appendLogicExp('destination', 'LIKE', '%'.$dv['type_desc'].'%', 'OR', $destConds);
						}
						if (!empty($destConds)) {
							$conds = appendLogicExp('dest', '=', $destConds, 'AND', $conds);
						}
						$recommendLines = BackLineHelp::getLineList($conds, 0, $subRecommendLineCount, $total, array('sort'=>'asc', 'create_time'=>'desc'), false, $out);
						$subRecommendLineCount -= count($recommendLines);
						if ($subRecommendLineCount > 0) {
							$subLines = BackLineHelp::getLineList($subConds, 0, $subRecommendLineCount, $total, array('sort'=>'asc', 'create_time'=>'desc'), false, $out);
							if (empty($recommendLines)) {
								$recommendLines = $subLines;
							} else {
								$recommendLines = array_merge($recommendLines, $subLines);	
							}
						}
						if (!empty($recommendLines)) {
							$line['exist_recommend_line'] = 1;
							if (empty($line['sets'])) {
								$line['sets'] = array();	
							}						
							foreach ($recommendLines as $rk=>$rv) {
								$recommendLine['id'] = 0;
								$recommendLine['key'] = 'recommend_line'.intval($recommendLineKey+$rk);
								$recommendLine['value_type'] = 'json';
								$recommendLine['value'] = $rv;
								array_push($line['sets'], $recommendLine);
							}
						}
					}
								
					// 专题信息
					$conds = appendLogicExp('type', '=', 'pc_home_index');
					$conds = appendLogicExp('type', 'LIKE', '%zhuanti%', 'AND', $conds);
					$zhuanti = MyHelp::getSet($conds, 0, 0, $total, array('sort'=>'asc'));
					$this->assign('set', $zhuanti);
				
					// 行程定位
					$schedule = I('get.schedule', 'undefined');
					$this->assign('schedule', $schedule);
				} else {		
					// 沿途风光
					$sceneryList = array();
					foreach($line['scenery'] as $pk=>$pv) {
						if (empty($pv['content'])) {
							if (!empty($scenery['image'])) {
								array_push($sceneryList, $scenery);
							}
							$scenery = array('image'=>$pv['image_url']);
						} else {
							if (empty($scenery['text'])) {
								$scenery['text'] = $pv['content'];
							} else {					
								$scenery['text'] = $scenery['text'].'<br />'.$pv['content'];
							}
						}
					}		
					if (!empty($scenery)) {
						array_push($sceneryList, $scenery);
					}
					$this->assign('scenery', $sceneryList);
				}		
				$this->assign('line', $line);
				
				// 下单前约束检查
				$ds = array('lineid'=>$line['id'], 'new_line'=>1, 'new_order'=>1);
				$check = BackOrderHelp::checkOrderCreate($ds,true);
				$this->assign('check', $check);
			
				// 最新预定的信息
				$order_member_count = 0;
				$conds = appendLogicExp('lineid', '=', $id);
				$conds = appendLogicExp('new_line', '=', '1', 'AND', $conds);
				$orders = BackOrderHelp::getNewOrderList($conds,0,0,$total,array('addtime'=>'desc'));
				$fill = array('state'=>true,'batch'=>true);
				$orders = BackOrderHelp::fillNewOrderInfo($orders,$fill);
				foreach ($orders as $ok=>$ov) {
					$ov['member_total_count'] = intval($ov['male'])+intval($ov['woman'])+intval($ov['child']);
					$order_member_count += $ov['member_total_count'];
					
					$sk = $ov['zhuangtai_data']['type_key'];
					if ($sk == 'pay_complate1' || $sk == 'paying' || $sk == 'pay_advance' || $sk == 'pay_complate' || $sk == 'pay_part') {						
						$ov['zhuangtai_color'] = '#E80B2C';
					} else if ($sk == 'review') {
						$ov['zhuangtai_color'] = '#000DF4';
					} else {
						$ov['zhuangtai_color'] = '#2F343C';
					}
						
					
					$key = $ov['hdid_start_time'];
					if (is_numeric($ov['hdid_start_time']) == false) {
						$key = strtotime($ov['hdid_start_time']);
					}
					
					if (empty($orderList[$key])) {
						$showData['hdid_show_text'] = $ov['hdid_show_text'];
						$showData['data'] = array($ov);
					} else {
						$showData = $orderList[$key];						
						array_push($showData['data'], $ov);
					}		
					
					$orderList[$key] = $showData;		
				}
				
				if (!empty($orderList)) {
					krsort($orderList);
					$this->assign('orders', $orderList);	
				}
				$this->assign('order_member_count', $order_member_count);
				
				// 分销用户
				$duid = I('get.duid', false);
				if (!empty($duid)) {
					$this->assign('duid', $duid);
				}				
				
				// 点击量
				$lineObj = ModelBase::getInstance('line');
				$lineObj->fieldAddAndSub(appendLogicExp('id', '=', $line['id']), 'click_count', 1, true);
				
				if (empty($line['is_xinlvpai'])) {
					$this->showPage('content', 'line_content', 'line', '产品详细-领袖户外');	
				} else {	
					$this->showPage('qlp_content', 'line_qlp_content', 'line', '新旅拍产品详细-领袖户外');
				}
			} else {
				$this->showError('502','线路错误', '线路编号错误', '该线路可能已经下架或者不存在');
			}
		}
	}
	
	//线路详情页测试调试
	public function infotestAction() {
		if (IS_POST) {
			$type = I('post.type', false);
			if ($type == 'find_batch') {
				$lineId = I('post.line_id',false);
				if (empty($lineId)) {
					$data['result'] = error(-1, '产品编号无效');
					return $this->ajaxReturn($data);
				}
				$conds = appendLogicExp('line_id', '=', $lineId);
				$year = I('post.year', false); 
				if (!empty($year)) {
					$conds = appendLogicExp('start_time', 'LIKE', '%'.$year.'%', 'AND', $conds);
				}
				$data['result'] = error(0, '');
				$conds = appendLogicExp('use_state', 'NOT LIKE', '%line_batch_use_forbid%', 'AND', $conds);
				$ds = BackLineHelp::getBatchList($conds, 0, 0, $total, array('start_time'=>'asc'));								
				$data['ds'] = $ds;
				$data['total'] = $total;
				$data['line_id'] = $lineId;
				return $this->ajaxReturn($data);
			} elseif ($type = 'find_taocan_batch') {
				$lineId = I('post.line_id',false);
				$taocanId = I('post.taocan_id',false);
				$conds = appendLogicExp('line_id', '=', $lineId);
				$conds = appendLogicExp('invalid', '=', 0, 'AND', $conds);
				$conds = appendLogicExp('taocan_ids', 'LIKE', ','.$taocanId.',', 'AND', $conds);
				$tplFind = array('batch'=>true);
				$taocanPrices = BackLineHelp::getTaocanPriceList($conds, 0, 0, $total, array('id'=>'asc'), $tplFind);
				if (!empty($taocanPrices)) {
					$data['result'] = error(0, '');
					$data['ds'] = $taocanPrices;
					$data['total'] = $total;
					$data['line_id'] = $lineId;
				} else {
					$data['result'] = error(-1, '未找到相关信息');
				}
				
				$this->ajaxReturn($data);
				
			} else {
				$data['result'] = error(-1, '错误的请求方式');
				return $this->ajaxReturn($data);
			}
		} else {
			$id = I('get.id', false);
			if (!empty($id)){				
				$find = array(
//					'min_batch'=>true,
					'point'=>true,
					'travel'=>true,
					'scenery'=>true,
//					'batch'=>true,
					'offer'=>true,
//					'article'=>array('content'=>true)
					'set'=>true,
				);
				$line = BackLineHelp::getLine(appendLogicExp('id', '=', $id), $find);
				$batchConds = appendLogicExp('line_id', '=', $line['id']);
				$batchConds = appendLogicExp('use_state', 'NOT LIKE', '%line_batch_use_forbid%', 'AND', $batchConds);
				$line['batchs'] = BackLineHelp::getBatchList($batchConds, 0, 0, $total, array('start_time'=>'asc'));
				
				//获取产品已添加的套餐价格
				$tplConds = appendLogicExp('line_id', '=', $line['id']);
				$tplConds = appendLogicExp('invalid', '=', '0', 'AND', $tplConds);
				$tplFind = array('taocan'=>true);				
				$taocanPrices = BackLineHelp::getTaocanPriceList($tplConds, 0, 0, $total, array('id'=>'asc'), $tplFind);
				foreach ($taocanPrices as $tk=>$tv) {
					foreach ($tv['taocans'] as $tvk=>$tvv){
						$taocanMap[$tvv['id']] = $tvv;	
					}
				}			 
				$line['taocanList'] = $taocanMap;
				
				// 预览相关
				$setObj = ModelBase::getInstance('set');
				$setConds = appendLogicExp('type', '=', 'back_line_preview');
				$setConds = appendLogicExp('key', '=', 'preview_line_'.$id, 'AND', $setConds);
				$set = $setObj->getOne($setConds);
				if (!empty($set)) {
					$setval = json_decode($set['value'], true);
					if (time() - strtotime($setval['time']) > 10){
						$deleteSetPreview = true;
					}
				}
				
				$preview = I('get.p', '');
				if (empty($preview)) {					
					if ($line['online'] == '0' || $line['invalid'] == '1') {
						$forbiddenShow = true;
					}	
				} else {
					$deleteSetPreview = true;
					if (empty($setval) || $preview !== $setval['salt']) {
						$forbiddenShow = true;
					}
				}
				
				if (!empty($deleteSetPreview)) {
					$setObj->remove($setConds);
				}
				
				if (!empty($forbiddenShow)) {
					return $this->showError('502', '线路错误', '线路未上架', '该线路可能已经下架或者不存在');
				}
				
				if (empty($line['is_xinlvpai'])) {
					//问题填充
					if (!empty($line['questions'])) {
						foreach($line['questions'] as $qk=>$qv) {
							if ($qv['question_id'] != 0) {
								$dt = fmtDateTimeToNow($qv['create_time']);
								$qv['before_now'] = $dt['ago_show_text'];
								$line['questions'][$qk] = $qv;
							}
						}
					}
					// 是否存在游记
					$line['exist_youji'] = 0;
					$line['exist_recommend_line'] = 0;
					$subRecommendLineCount = 4;
					$recommendLineKey = 0;
					foreach ($line['sets'] as $sk=>$sv) {
						if (stripos($sv['key'], 'youji') !== FALSE) {
							$line['exist_youji'] = 1;
						}
						if (stripos($sv['key'], 'recommend_line') !== FALSE) {
							$subRecommendLineCount --;
							$recommendLineKey ++;
							$line['exist_recommend_line'] = 1;
						}
					}
					
					// 没有推荐时默认从产品库调用
					if ($subRecommendLineCount > 0) {
						$conds = appendLogicExp('id', '!=', $line['id']);
						$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
						$conds = appendLogicExp('online', '=', '1', 'AND', $conds);
						$subConds = $conds;
						foreach($line['destination_list'] as $dk=>$dv) {
							$destConds = appendLogicExp('destination', 'LIKE', '%'.$dv['type_desc'].'%', 'OR', $destConds);
						}
						if (!empty($destConds)) {
							$conds = appendLogicExp('dest', '=', $destConds, 'AND', $conds);
						}
						$recommendLines = BackLineHelp::getLineList($conds, 0, $subRecommendLineCount, $total, array('sort'=>'asc', 'create_time'=>'desc'), false, $out);
						$subRecommendLineCount -= count($recommendLines);
						if ($subRecommendLineCount > 0) {
							$subLines = BackLineHelp::getLineList($subConds, 0, $subRecommendLineCount, $total, array('sort'=>'asc', 'create_time'=>'desc'), false, $out);
							if (empty($recommendLines)) {
								$recommendLines = $subLines;
							} else {
								$recommendLines = array_merge($recommendLines, $subLines);	
							}
						}
						if (!empty($recommendLines)) {
							$line['exist_recommend_line'] = 1;
							if (empty($line['sets'])) {
								$line['sets'] = array();	
							}						
							foreach ($recommendLines as $rk=>$rv) {
								$recommendLine['id'] = 0;
								$recommendLine['key'] = 'recommend_line'.intval($recommendLineKey+$rk);
								$recommendLine['value_type'] = 'json';
								$recommendLine['value'] = $rv;
								array_push($line['sets'], $recommendLine);
							}
						}
					}
								
					// 专题信息
					$conds = appendLogicExp('type', '=', 'pc_home_index');
					$conds = appendLogicExp('type', 'LIKE', '%zhuanti%', 'AND', $conds);
					$zhuanti = MyHelp::getSet($conds, 0, 0, $total, array('sort'=>'asc'));
					$this->assign('set', $zhuanti);
				
					// 行程定位
					$schedule = I('get.schedule', 'undefined');
					$this->assign('schedule', $schedule);
				} else {		
					// 沿途风光
					$sceneryList = array();
					foreach($line['scenery'] as $pk=>$pv) {
						if (empty($pv['content'])) {
							if (!empty($scenery['image'])) {
								array_push($sceneryList, $scenery);
							}
							$scenery = array('image'=>$pv['image_url']);
						} else {
							if (empty($scenery['text'])) {
								$scenery['text'] = $pv['content'];
							} else {					
								$scenery['text'] = $scenery['text'].'<br />'.$pv['content'];
							}
						}
					}		
					if (!empty($scenery)) {
						array_push($sceneryList, $scenery);
					}
					$this->assign('scenery', $sceneryList);
				}		
				$this->assign('line', $line);
				
				// 下单前约束检查
				$ds = array('lineid'=>$line['id'], 'new_line'=>1, 'new_order'=>1);
				$check = BackOrderHelp::checkOrderCreate($ds,true);
				$this->assign('check', $check);
			
				// 最新预定的信息
				$order_member_count = 0;
				$conds = appendLogicExp('lineid', '=', $id);
				$conds = appendLogicExp('new_line', '=', '1', 'AND', $conds);
				$orders = BackOrderHelp::getNewOrderList($conds,0,0,$total,array('addtime'=>'desc'));
				$fill = array('state'=>true,'batch'=>true);
				$orders = BackOrderHelp::fillNewOrderInfo($orders,$fill);
				foreach ($orders as $ok=>$ov) {
					$ov['member_total_count'] = intval($ov['male'])+intval($ov['woman'])+intval($ov['child']);
					$order_member_count += $ov['member_total_count'];
					
					$sk = $ov['zhuangtai_data']['type_key'];
					if ($sk == 'pay_complate1' || $sk == 'paying' || $sk == 'pay_advance' || $sk == 'pay_complate' || $sk == 'pay_part') {						
						$ov['zhuangtai_color'] = '#E80B2C';
					} else if ($sk == 'review') {
						$ov['zhuangtai_color'] = '#000DF4';
					} else {
						$ov['zhuangtai_color'] = '#2F343C';
					}
						
					
					$key = $ov['hdid_start_time'];
					if (is_numeric($ov['hdid_start_time']) == false) {
						$key = strtotime($ov['hdid_start_time']);
					}
					
					if (empty($orderList[$key])) {
						$showData['hdid_show_text'] = $ov['hdid_show_text'];
						$showData['data'] = array($ov);
					} else {
						$showData = $orderList[$key];						
						array_push($showData['data'], $ov);
					}		
					
					$orderList[$key] = $showData;		
				}
				
				if (!empty($orderList)) {
					krsort($orderList);
					$this->assign('orders', $orderList);	
				}
				$this->assign('order_member_count', $order_member_count);
				
				// 分销用户
				$duid = I('get.duid', false);
				if (!empty($duid)) {
					$this->assign('duid', $duid);
				}				
				
				// 点击量
				$lineObj = ModelBase::getInstance('line');
				$lineObj->fieldAddAndSub(appendLogicExp('id', '=', $line['id']), 'click_count', 1, true);
				
				if (empty($line['is_xinlvpai'])) {
					$this->showPage('content_test', 'line_content', 'line', '产品详细-领袖户外');	
				} else {	
					$this->showPage('qlp_content', 'line_qlp_content', 'line', '新旅拍产品详细-领袖户外');
				}
			} else {
				$this->showError('502','线路错误', '线路编号错误', '该线路可能已经下架或者不存在');
			}
		}
	}
	
	// 计算订单价格
	private function calcOrderMoney($aa) {
		if (empty($aa['batch_id'])) {
			$data['result'] = error(-1, '参数不足，不能计算订单总价');
		}
		
		$conds = appendLogicExp('id', '=', $aa['batch_id']);
		$batch = BackLineHelp::getBatch($conds, $fill);
		$data['batch'] = $batch;
		
		$data['result'] = error(0, '');
		if (empty($aa['adult_count']) && empty($aa['child_count'])) {
			$data['money'] = array('full'=>'0.00', 'cut'=>'0.00');
			return $this->ajaxReturn($data);
		}
		
		// 获取套餐价格编号
		$ds['tc_price_id'] = 0;
		if (!empty($aa['taocan_ids'])) {
			$tpconds = appendLogicExp('batch_id', '=', $aa['batch_id']);
			$tpconds = appendLogicExp('invalid', '=', '0', 'AND', $tpconds);
			$tpconds = appendLogicExp('taocan_ids', '=', $aa['taocan_ids'], 'AND', $tpconds);
			$taocanPrice = BackLineHelp::getTaocanPrice($tpconds);
			$ds['tc_price_id'] = $taocanPrice['id'];
			$data['tc_price'] = $taocanPrice;
		}
		
		$result = BackOrderHelp::calcOrderMoney($aa['batch_id'], $ds['tc_price_id'], intval($aa['adult_count']), intval($aa['child_count']), $offer);
		if (is_error($result) === false) {
			$data['money'] = $result;
		} else {
			$data['money'] = array('full'=>'0.00', 'cut'=>'0.00');
			$data['result'] = $result;
		}
		$data['offer'] = $offer;
		return $this->ajaxReturn($data);		
	}
	
	// 生成订单
	private function createOrder($requestType, $aa) {
		if ($requestType == 'get') {
			$line = BackLineHelp::getLine(appendLogicExp('id', '=', $aa['id']), false);		
			$batchConds = appendLogicExp('line_id', '=', $line['id']);
			$batchConds = appendLogicExp('use_state', 'NOT LIKE', '%line_batch_use_forbid%', 'AND', $batchConds);
			$line['batchs'] = BackLineHelp::getBatchList($batchConds, 0, 0, $total, array('start_time'=>'asc'));	
			foreach ($line['batchs'] as $bk=>$bv) {
				if ($bk == 0) {						
					$curBatch = $bv;
				}
				if (!empty($aa['b'])) {
					if (intval($bv['id']) === intval($aa['b'])) {
						$curBatch = $bv;
					}	
				}
			}
			
			//获取产品已添加的套餐价格
			$tplConds = appendLogicExp('line_id', '=', $line['id']);
			$tplConds = appendLogicExp('invalid', '=', '0', 'AND', $tplConds);
			$tplFind = array('taocan'=>true);
			$taocanPrices = BackLineHelp::getTaocanPriceList($tplConds, 0, 0, $total, array('id'=>'asc'), $tplFind);
			foreach ($taocanPrices as $tk=>$tv) {
				foreach ($tv['taocans'] as $tvk=>$tvv){
					$taocanMap[$tvv['id']] = $tvv;	
				}
			}
			$line['taocanList'] = $taocanMap;
			
			//已经选择的套餐
			if (!empty($aa['tpids'])) {
				$tpids = str_replace('|', ',', $aa['tpids']);
				$tcpConds = appendLogicExp('line_id', '=', $line['id']);
				$tcpConds = appendLogicExp('batch_id', '=', $aa['b']);
				$tcpConds = appendLogicExp('taocan_ids', '=', $tpids);
				$tcpConds = appendLogicExp('invalid', '=', '0', 'AND', $tcpConds);
				$tcp = BackLineHelp::getTaocanPrice($tcpConds);
				$curBatch['taocan_price_adult'] = $tcp['price_adult'];
				$curBatch['taocan_price_child'] = $tcp['price_child'];
				$adultPrice = $tcp['price_adult'];
				$childPrice = $tcp['price_child'];
				$this->assign('tcp', $tcp);
			} else {
				$adultPrice = $curBatch['price_adult'];
				$childPrice = $curBatch['price_child'];
			}			
			
			$this->assign('cur_batch', $curBatch);			
			$this->assign('line', $line);			
			
			$maleCount = empty($aa['m']) ? 0 : $aa['m'];
			$femaleCount = empty($aa['w']) ? 0 : $aa['w'];
			$childCount = empty($aa['ch']) ? 0 : $aa['ch'];
			$this->assign('member_male_count', $maleCount);
			$this->assign('member_woman_count', $femaleCount);
			$this->assign('member_child_count', $childCount);
			
			// 下单前约束检查
			$ds = array('lineid'=>$line['id'], 'new_line'=>1, 'new_order'=>1);
			$check = BackOrderHelp::checkOrderCreate($ds,true);
			$this->assign('check', $check);			
			
			$adultCount = intval($maleCount)+intval($femaleCount);
			$this->assign('member_adult_count', $adultCount);
			
			if (!empty($curBatch) && $adultCount > 0) {
				
				$result = BackOrderHelp::calcOrderMoney($curBatch['id'], 0, $adultCount, intval($childCount), $offer);	
				if (is_error($result) == false) {
					$money = $result;
				}
				$this->assign('line_offer', $offer);
				
				// 优惠后的成人价格
				if (!empty($offer['line_special_offer_adult'])) {
					$adultPrice = $offer['line_special_offer_adult']['money'];
				}
				// 优惠后的儿童价格
				if (!empty($offer['line_special_offer_child'])) {
					$childPrice = $offer['line_special_offer_child']['money'];
				}
			}
			$this->assign('adult_price', $adultPrice);
			$this->assign('child_price', $childPrice);
			$this->assign('adult_total_price', $adultCount * floatval($adultPrice));
			$this->assign('child_total_price', $childCount * floatval($childPrice));
			if (empty($money)) {
				$money['full'] = empty($curBatch) ? 0 : floatval($curBatch['price_adult']) * $adultCount;
				$money['cut'] = $money['full'];
			}
			$this->assign('team_money', $money);
			
			$certTypeObj = ModelBase::getInstance('certificate_type');
			$certTypes = $certTypeObj->getAll();
			$this->assign('certs', $certTypes);
				
			// 分销用户
			$duid = I('get.duid', false);
			if (!empty($duid)) {
				$this->assign('duid', $duid);
			}
			
			// 是否包含赠送物品
			if (!empty($line['largess_list'])) {
				$largess = $line['largess_list'];
				foreach ($largess as $lk=>$lv) {
					$typeData = MyHelp::getTypeData($lv['type_key']);
					if (is_error($typeData) === false) {
						$lv['data'] = $typeData;
					}
					$largess[$lk] = $lv;
				}
				$this->assign('largess', $largess);
			}
			
			return $this->showPage('order_create', 'order_create', 'order', '创建订单');
		} else {
			$user = MyHelp::getLoginAccount(false);
			// 账户未登陆情况下判断用户是否注册
			if (is_error($user)) {
				if (check_mobile($aa['mob']) === false || empty($aa['mob_code'])) {
					$data['result'] = error(-1, '联系人手机号码或者手机验证码有误，请检查后再次下单');
					return $this->ajaxReturn($data);
				}
				// 已注册则登陆
				$user = BackAccountHelp::getAccount('account_user', appendLogicExp('phone', '=', $aa['mob']));
				if (is_error($user)) {
					// 未注册则注册并登陆
					$user_data['name'] = $aa['names'];
					$user_data['phone'] = $aa['mob'];
					$user_data['password'] = '123456';
					$user = BackAccountHelp::registerUser($user_data);
					if (is_error($user)) {
						$data['result'] = $user;
						return $this->ajaxReturn($data);
					}
					$user['account_type'] = BackAccountHelp::AccountTypeKey2Value('account_user', true);
					$aa['book_account_type'] = $user['account_type']['id'];
				}						
				// 如果禁用，不允许下单
				if ($user['forbidden'] == '1') {
					$data['result'] = error(-1, '您的账号已被禁用，不能下单，请联系客服MM咨询详细情况哦');
					$this->ajaxReturn($data);
				}
						
				// 如果禁用，不允许下单
				if ($user['backlist'] == '1') {
					$data['result'] = error(-1, '您的账号已被拉黑，不能下单，请联系客服MM咨询详细情况哦');
					$this->ajaxReturn($data);
				}
				MyHelp::setLoginAccount($user);
			}
			
			$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
			$colNames = $orderObj->getUserDefine(ModelBase::DF_COL_NAMES);		
			$ds = coll_elements_giveup($colNames, $aa);
			$ds['userid'] = $user['id'];
			$ds['new_order'] = 1;
			$ds['new_line'] = 1;
			$ds['from_id'] = BackOrderHelp::OrderFromKey2Value('guanwang');
			if (is_error($ds['from_id']) === true) {
				$ds['from_id'] = 1;
			}
			$ds['order_sn'] = BackOrderHelp::createOrderSN('LX', $ds['from_id']);
			$ds['book_account_type'] = $user['account_type']['id'];
			$ds['addtime'] = time();
			$ds['addip'] = get_client_ip();
			$ds['add_domain'] = $_SERVER['HTTP_HOST'];
			
			// 下单后数据约束检查
			$result = BackOrderHelp::checkOrderCreate($ds, false);
			if (error_ok($result) === false) {
				$data['result'] = $result;
				return $this->ajaxReturn($data);
			}
			
			// 获取线路
			$line = BackLineHelp::getLine(appendLogicExp('id', '=', $ds['lineid']));
			if (empty($line)) {
				$data['result'] = error(-1, '次订单线路存在问题，不能生成订单:'.$ds['lineid']);
				return $this->ajaxReturn($data);
			}
			$ds['line'] = $line;
			$ds['station_id'] = $line['station_data'][0]['id'];
			
			// 获取套餐价格编号
			$ds['tc_price_id'] = 0;
			if (!empty($aa['taocan_ids'])) {
				$conds = appendLogicExp('batch_id', '=', $ds['hdid']);
				$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
				$conds = appendLogicExp('taocan_ids', '=', $aa['taocan_ids'], 'AND', $conds);
				$taocanPrice = BackLineHelp::getTaocanPrice($conds);
				$ds['tc_price_id'] = $taocanPrice['id'];
			}
			
			// 计算所需支付金额
			$adultCount = intval($ds['male']) + intval($ds['woman']);
			$money = BackOrderHelp::getNeedPayMoney($ds['lineid'], $ds['hdid'], $ds['tc_price_id'], $adultCount, intval($ds['child']), $ds['receipt_type']);
			if (is_error($money) === true) {
				$data['result'] = $money;
				return $this->ajaxReturn($data);
			}
			$ds['team_price'] = $money['full'];
			$ds['team_cut_price'] = $money['cut'];
			$ds['need_pay_money'] = $money['need'];			
			
//			if (floatval($ds['team_cut_price']) == 0) {
//				$ds['zhuangtai'] = BackOrderHelp::OrderStateKey2Value('pay_complate');
//			} else {
//				$ds['zhuangtai'] = BackOrderHelp::OrderStateKey2Value('unreview');
//			}	
			$ds['zhuangtai'] = BackOrderHelp::OrderStateKey2Value('unreview');
				
			$data['result'] = error(0, '订单生成成功');
			$result = $orderObj->create($ds, $orderId);
			if (error_ok($result)) {
				$ds['id'] = $orderId;
				if (count($aa['members']) > 0) {
					$data['members'] = $aa['members'];
					$memberObj = ModelBase::getInstance('signup_member');
					$memberColNames = $memberObj->getUserDefine(ModelBase::DF_COL_NAMES);
					$types = array('成人男'=>'adult_man', '成人女'=>'adult_woman', '儿童'=>'child');
					foreach ($aa['members'] as $mk=>$mv) {
						$mds = coll_elements_giveup($memberColNames, $mv);
						$mds['order_id'] = $orderId;
						$mds['type_id'] = BackOrderHelp::MemberTypeKey2Value($types[$mv['type']]);
						$data['member'.$mk.'_result'] = $memberObj->create($mds, $memberId);
						if (error_ok($result)) {
//							$data['member'.$mk.'_result'] = error(-1, $result['message'].'/'.$data['member_result']['message']);

							// 处理赠品信息
							if (!empty($mv['largess'])) {
								$largessObj = ModelBase::getInstance('member_largess');
								foreach ($mv['largess'] as $lk=>$lv) {
									$lds['member_id'] = $memberId;
									$largess = MyHelp::TypeDataKey2Value($lv['largess_id'],true);
									$largessData = MyHelp::TypeDataKey2Value($lv['data_id'],true);
									
									if (is_error($largess) === true || is_error($largessData) === true) {	
										$data['member'.$mk.'_largess'.$lk.'_result'] = error(-1, '错误的赠品，不能创建赠品对象');			
									} else {
										if (empty($lv['data_id'])) {
											$typeDataObj = ModelBase::getInstance('type_data');
											$largessData = $typeDataObj->getOne('data_type_id', '=', $largess['id']);
										}
										unset($largess['can_delete']);
										unset($largess['sort']);
										unset($largessData['can_delete']);
										unset($largessData['sort']);
										$lds['largess'] = my_json_encode($largess);
										$lds['data'] = my_json_encode($largessData);
										$data['member'.$mk.'_largess'.$lk.'_result'] = $largessObj->create($lds, $largessId);
									}									
								}
							}
						}
					}	
				}
				
				// 分销订单
				if (!empty($aa['duid'])) {
					$fxOrderObj = ModelBase::getInstance('fx_order');
					$fxDS['user_id'] = $aa['duid'];
					$fxDS['order_id'] = $orderId;
					$fxDS['commision_adult'] = $line['commision_adult'];
					$fxDS['commision_child'] = $line['commision_child'];
					$fxDS['create_time'] = fmtNowDateTime();
					$data['fenxiao_result'] = $fxOrderObj->create($fxDS, $fxOrderId);
					$data['fenxiao_order_id'] = $fxOrderId;
				}
				
				$data['jumpUrl'] = U('line/order', 'type=center');
			} else {
				$data['result'] = $result;
			}		
			$data['ds'] = $ds;			
			$this->ajaxReturn($data);
		}
	}
	
	// 处理进入订单中心
	private function orderCenter($requestType, $aa) {
		$user = MyHelp::getLoginAccount(true);		
		if (is_error($user) === true) {
			return $this->display('User/login');
		}
		
		// 旧用户订单兼容
		$userTypeId = BackAccountHelp::AccountTypeKey2Value('account_user');
		$conds1 = appendLogicExp('userid', '=' , $user['id']);		
		$conds1 = appendLogicExp('book_account_type', '=', $userTypeId, 'AND', $conds1);
		$userConds = appendLogicExp('', '', $conds1, 'OR');		
		if (empty($user['mid']) === false) {
			$memberTypeId = BackAccountHelp::AccountTypeKey2Value('account_member');
			$conds2 = appendLogicExp('userid', '=' , $user['mid']);		
			$conds2 = appendLogicExp('book_account_type', '=', $memberTypeId, 'AND', $conds2);		
			$userConds = appendLogicExp('', '', $conds2, 'OR', $userConds);	
		}
		$conds = appendLogicExp('', '', $userConds, 'AND');
		
		if ($requestType == 'post') {
			$curPage = empty($aa['page']) ? 0 : intval($aa['page']);
			$startIndex = $curPage * ORDER_CENTER_LIST_SHOW_COUNT;
		} else {
			$startIndex = 0;			
		}
		
		if (!empty($aa['state'])) {
			$stateId = BackOrderHelp::OrderStateKey2Value($aa['state']);
			if (is_error($stateId) === false) {
				$conds = appendLogicExp('zhuangtai', '=', $stateId, 'AND', $conds);	
			}
		} else {
			$aa['state'] = 'all';
		}
		
		$data['conds'] = $conds;
		$sort = array('addtime'=>'desc');
		
		$orderList = BackOrderHelp::getNewOrderList($conds, $startIndex, ORDER_CENTER_LIST_SHOW_COUNT, $total, $sort, $out);
		$fill = array('state'=>1,'line'=>1,'batch'=>1,'money'=>1);
		$orderList = BackOrderHelp::fillNewOrderInfo($orderList, $fill);
		
		foreach($orderList as $ok=>$ov) {
			// 判断合同生效
			$sk = $ov['zhuangtai_data']['type_key'];
			if ($sk == 'pay_advance' || $sk == 'pay_part' || $sk == 'pay_complate') {
				$ov['agreenment'] = true;
			} else {
				$ov['agreenment'] = false;
			}
			
			// 判断可支付
			if ($sk == 'review' || $sk == 'pay_advance' || $sk == 'pay_part') {
				$ov['operate'] = 'pay'; 	
			} else if ($sk == 'unreview') {
				$ov['operate'] = 'wait_review';
			} else if ($sk == 'exit_team' || $sk == 'complated' || $sk == 'canceled' || $sk == 'invalid') {
				$ov['operate'] = 'team_end';
			}
						
			// 判断是否可退团
//			$result = BackOrderHelp::checkOrderOperate('exit_team', $ov['id']);
			
			$orderList[$ok] = $ov;
		}
		
		$pageCount = intval($total / ORDER_CENTER_LIST_SHOW_COUNT);
		if (intval($total % ORDER_CENTER_LIST_SHOW_COUNT) > 0) {
			$pageCount += 1;
		}
		
		if ($requestType == 'post') {
			$data['out'] = $out;
			$data['result'] = error(0, '');
			if ($total > 0) {
				$data['ds'] = $orderList;
				$data['page_count'] = $pageCount;
			} else {
				$data['result'] = error(-1, '没有找到相应订单');
			}
			return $this->ajaxReturn($data);
		} else {
			
			$questClass = array(
				'question_type_pay'=>0,
				'question_type_agreement'=>1,
				'question_type_insurance'=>2,
				'question_type_other'=>3,
			);
			
			$questType = array(0=>'',1=>'',2=>'',3=>'');
			$quest_type = MyHelp::getTypeData('question_type');
			if (is_error($quest_type) === false) {
				foreach ($quest_type as $qk=>$qv) {
					if (!array_key_exists($qv['type_key'], $questClass)) {
						continue;
					}
					$conds = appendLogicExp('type_id', '=', $qv['id']);
					$conds = appendLogicExp('question_id', '=', '0', 'AND', $conds);
					$questions =BackLineHelp::getQuestionList($conds, 0, 0, $total, array('create_time'), false);
					
					$idx = $questClass[$qv['type_key']];
					$qv['questions'] = $questions;
					$questType[intval($idx)] = $qv;
				}
			}		
			$this->assign('order_center_question', $questType);
			
			$this->assign($aa['state'].'_orders', $orderList);
			$this->assign('state', $aa['state']);
			$this->assign('page_count', $pageCount);
			
			return $this->showPage('order_center');
		}			
	}
	
	// 订单详情
	private function orderInfo($requestType, $aa) {
		if ($requestType == 'get') {
			$order = BackOrderHelp::getOrderInfo($aa);
			$ds = array($order);
			$fill = array('state'=>1, 'money'=>1, 'line'=>1, 'batch'=>1, 'use_coupon'=>1, 'member'=>1, 'extra_cash'=>1, 'order_coupon'=>1);
			$ds = BackOrderHelp::fillNewOrderInfo($ds, $fill);
			$order = $ds[0];
			
			$this->assign('order', $order);
			
			$this->_initTemplateInfo();
			$this->showPage('order_detail');
		}
	}
	
	// 处理订单支付确认
	private function orderPayment($requestType, $aa) {
		if ($requestType == 'get') {
			$order = BackOrderHelp::getOrderInfo($aa);
			$fill = array('state'=>1,'line'=>1, 'batch'=>1, 'use_coupon'=>1, 'member'=>1, 'extra_cash'=>1, 'order_coupon'=>1);
			$order = BackOrderHelp::fillNewOrderInfo($order, $fill);	
			
//			if ($line['free_line'] == 0 && $batch['price_adult'] == 0 && $batch['price_child'] == 0) {
//				$result = error(-3, '您选择的批次还未核算价格，不能继续报名');
//			}
			
			// 计算订单总价
			$needPayMoney = BackOrderHelp::getOrderNeedPayMoney($order['id'], true);
			if (is_error($needPayMoney)) {
				return $this->showError('501', '订单确认错误', '核算订单总价错误');
			}
			$this->assign('need', $needPayMoney);
			$order['need_pay_money'] = $needPayMoney['need'];
			// 剩余要支付的钱
			$finalPayMoney = bcsub(floatval($needPayMoney['need']), floatval($needPayMoney['pay']), 2);
			$order['final_pay_money'] = $finalPayMoney;		
			$this->assign('order', $order);
			
			$couponConds = appendLogicExp('user_id', '=', $order['userid']);
			$couponConds = appendLogicExp('use', '=', '0', 'AND', $couponConds);
			$coupons = BackAccountHelp::getUserCoupon($couponConds);
			$this->assign('user_coupons', $coupons);
			
			$this->showPage('order_payment');
		}
	}
	
	// 处理订单支付
	private function orderPay($requestType, $aa) {
		if ($requestType == 'get') {
			// 登录判断
			MyHelp::getLoginAccount(true);
			
			if (empty($aa['id'])){
				$err = errorPage('500', '订单错误', '您的订单编号错误，请咨询客服人员后再次使用', '请您核对后咨询客服人员');
				$this->assign('err', $err);
				return $this->display('Common/error');
			}
			
			$order = BackOrderHelp::getOrderInfo($aa['id']);
			if (is_error($order)) {
				return $this->showError('502', '订单错误', '您的订单信息错误，请咨询客服人员后再次使用', '请您核对后咨询客服人员');
			}	
			
			$order = BackOrderHelp::fillNewOrderInfo($order, array('line'=>true));
			
			if ($order['lineid_data_type'] === 'line') {				
				// 判断付款方式（全款/预付款）
				$allowPay = json_decode($order['allow_pay_type'], true);
				$allowType = MyHelp::TypeDataKey2Value($allowPay['id'], true);
				if (is_error($allowType) == false) {
					if ($allowType['type_key'] == 'line_pay_type_complate') {
						$onlyPayAll = true;
					}
				}
			}
			
			// 计算要支付金额
			$needPayMoney = BackOrderHelp::getOrderNeedPayMoney($order['id'], false);
			// 存在支付记录不能再支付部分款
			$order['exist_pay_log'] = 0;
			if ($needPayMoney['pay'] > 0 || !empty($onlyPayAll)) {
				$order['exist_pay_log'] =  1;	
			}
			// 剩余要支付的尾款
			$finalPayMoney = bcsub(floatval($needPayMoney['need']), floatval($needPayMoney['pay']), 2);
			
			// 查看优惠券是否存在
			if (!empty($aa['cid'])) {	
				$couponObj = ModelBase::getInstance('user_coupon');			
				// 获取并检测优惠券
				$couponConds = appendLogicExp('user_id', '=', $order['userid']);
				$couponConds = appendLogicExp('id', '=', $aa['cid'], 'AND', $couponConds);
				$coupons = BackAccountHelp::getUserCoupon($couponConds);
				if (empty($coupons) === true) {
					return $this->showError('502', '使用优惠券错误', '您的优惠券不存在，请咨询客服人员后再次使用', '请您核对后咨询客服人员');
				}
				
				// 支付金钱必须大于优惠券金额
				$coupon = $coupons[0];
				if ($finalPayMoney <= intval($coupon['money'])) {
					return $this->showError('502', '使用优惠券错误', '您的优惠券存大于支付金额，不能使用优惠券', '请您核对后咨询客服人员');
				}
				
				// 查看该订单是否已使用过优惠券
				$couponList = BackOrderHelp::getOrderUserCoupon($order['id'],'list');
				foreach ($couponList as $clk=>$clv) {
					if (!empty($clv['order_id'])) {
						if (empty($clv['use']) && empty($clv['use_time'])) {
							$removeBindIds .= $clv['id'];
						}
						if ( $clv['use'] == 1 && $clv['use_time'] != '') {
							$existUseCoupon = true;
						}
					}
				}
				if (!empty($removeBindIds)) {
					$conds = appendLogicExp('id', 'IN', '('.$removeBindIds.')');
					$removeBindCouponResult = $couponObj->modify(array('use'=>0, 'create_time'=>'', 'order_id'=>''),$conds);
					$this->assign('remove_bind_coupon_result', $removeBindCouponResult);
				}
//				$couponMoney = BackOrderHelp::getOrderUserCoupon($order['id'],'list');
				if (!empty($existUseCoupon)) {
					return $this->showError('502', '使用优惠券错误', '该订单您已经使用过优惠券了，不能再次使用', '请您核对后咨询客服人员');
				}
				
				// 减去优惠券上的金额
				$finalPayMoney = bcsub($finalPayMoney, floatval($coupon['money']), 2);
				
				// 现在不写入，只绑定订单， 在支付成功后写入
				$ds['order_id'] = $order['id'];
				
				$reuslt = $couponObj->modify($ds, appendLogicExp('id', '=', $coupon['id']));
				if (error_ok($reuslt) === false) {
					return $this->showError('502', '使用优惠券错误', '订单绑定优惠券信息错误', '请您核对后咨询客服人员');
				}
			}			
			$order['final_pay_money'] = $finalPayMoney;
			
			$this->assign('order', $order);	
			$this->showPage('order_pay');
		} else {
			// 登录判断
			$user = MyHelp::getLoginAccount(false);
			if (empty($user)) {
				$data['result'] = error(-1, '您还没有登录，请登录后再进行支付');
				return $this->ajaxReturn($data);
			}
			
			if (empty($aa['id'])){
				$data['result'] = error(-1, '订单编号错误，提交失败，请咨询客服人员或重新提交');
				return $this->ajaxReturn($data);
			}
			
			$order = BackOrderHelp::getOrderInfo($aa['id']);
			if (is_error($order)) {
				$data['result'] = error(-1, '您所要支付的订单信息有误，请咨询客服人员后再次提交');
				return $this->ajaxReturn($data);
			}
			$order = BackOrderHelp::fillNewOrderInfo($order, array('line'=>true));
			if ($order['lineid_data_type'] === 'line') {
				// 支付前审核
				$data['result'] = BackOrderHelp::checkOrderPay($order);
				if (error_ok($data['result']) === false) {
					return $this->ajaxReturn($data);
				}
			}
			
			// 计算要支付金额,此时计算的总金额要减去绑定的优惠券，因为当前已支付不包含只绑定未使用的优惠券
			$needPayMoney = BackOrderHelp::getOrderNeedPayMoney($aa['id'], false, true);
			// 已支付的钱，包含已绑定并且使用的优惠券，因为上面要支付金额已经减过优惠券，所以这里不再计算在内
			$paidMoney = BackOrderHelp::getOrderPaySumMoney($order['id'], $payCount, false);
			// 剩余要支付的尾款
			$finalPayMoney = bcsub(floatval($needPayMoney['need']), floatval($needPayMoney['pay']), 2);
			
			if ($aa['pay_money_all'] == 0) {
				$finalPayMoney = floatval($finalPayMoney) * 0.50;
			}
			
			if ($aa['pay_channel'] == 'weixin') {
				$aa['pay_channel'] = 'weixin_pay';
			}
			
			$payChannel = MyHelp::MenuItemKey2Value('pay_menu', $aa['pay_channel']);
			if (is_error($payChannel) === true) {
				$data['result'] = error(-1, '订单支付渠道数据错误');
				return $this->ajaxReturn($data);
			}
			
			// 在线支付接口链接
			$successUrl = 'http://kllife.com'.U('line/payresult');
			$backUrl = 'http://kllife.com'.U("line/ordercenter");
			
			// 订单重组
//			$payCount = BackOrderHelp::getOrderPayCount($order['id'], 2);
//			$orderSN = $order['order_sn'].'-'.intval($count+1);
			$orderSN = $order['order_sn'].'-'.substr(uniqid(rand()),-1);	
			$orderTitle = $order['lineid_title'];
			if (mb_strlen($order['lineid_title'], 'utf8') > 20) {
				$orderTitle = mb_substr($order['lineid_title'], 0, 20, 'utf8');
				$orderTitle .= '...';
			}
			$orderSubheading = $order['lineid_subheading'];
			
			// 在此调用支付接口
			if ($aa['pay_type'] == 'chuxuxinyong') {
				// 网银
				$data['html'] = MsgHelp::submit_shengpay(
					$orderSN, 
					$finalPayMoney, 
					date('YmdHis', time()), 
					$payChannel, 
					$aa['pay_bank'],
					$successUrl,
					$backUrl,
					$orderTitle,
					'contactor',
					get_client_ip(),
					$aa['pay_channel'],
					$out
					);
				$data['out'] = $out;
			} else {									
				if ($aa['pay_channel'] == 'zhifubao') {
					// 支付宝
					$productUrl = 'http://kllife.com'.U('line/info').'/id/'.$order['lineid'];
					$successUrl = 'http://kllife.com'.U('line/alipayresult');
					$notifyUrl = 'http://kllife.com/inf/alipay.php';
					$data['html'] = MsgHelp::Alipay(
						$orderSN, 
						$orderTitle, 
						$finalPayMoney, 
						$orderSubheading, 
						$productUrl,
						$notifyUrl,
						$successUrl);
				}elseif($aa['pay_channel'] == 'pay_menu_xianbank_pay'){
					//西银在线
					$finalPayMoney = bcmul($finalPayMoney, 100, 0);
					$data['html'] = MsgHelp::xianBankPay(
						$orderSN, 
						$finalPayMoney,
						$orderTitle);
					
				} else {
					// 微信
					$successUrl = 'http://kllife.com/inf/wxpay.php';
					$finalPayMoney = bcmul($finalPayMoney, 100, 0);
					$data['image'] = MsgHelp::Wxpay(
						$orderTitle,
						$orderSubheading,
						$orderSN,
						$finalPayMoney,
						$successUrl,
						$out);
					$data['order_sn'] = $orderSN;
					$data['out'] = $out;
				}
			}			
			return $this->ajaxReturn($data);
		}
	}
		
	public function orderAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'calc_money') {
				$this->calcOrderMoney($_POST);
			} else if ($type == 'create') {
				$this->createOrder('post', $_POST);
			} else if ($type == 'list') {
				$this->orderCenter('post', $_POST);
			} else if ($type == 'pay') {
				$this->orderPay('post', $_POST);
			} else {
				$data['result'] = error(-1, '产品订单操作类型错误');
				$this->ajaxReturn($data);
			}
		} else {
			$id = I('get.id', false);
			$type = I('get.type', false);
			if (!empty($type)){
				if (!empty($id)) {
					if ($type == 'create') {	
						return $this->createOrder('get', $_GET);	
					} else if ($type == 'info') {
						return $this->orderInfo('get', $id);
					} else if ($type == 'payment') {
						return $this->orderPayment('get', $id);
					} else if ($type == 'pay') {	
						return $this->orderPay('get', $_GET);
					}
				}
				if ($type == 'center') {
					return $this->orderCenter('get', $_GET);
				}
			}
			$this->display('common/error');	
		}
	}
	
	// 订单支付跳转到订单中心
	public function ordercenterAction() {
		$user = MyHelp::getLoginAccount(true);		
		if (is_error($user) === true) {
			return $this->display('User/login');
		}
		
		// 旧用户订单兼容
		$userTypeId = BackAccountHelp::AccountTypeKey2Value('account_user');
		$conds1 = appendLogicExp('userid', '=' , $user['id']);		
		$conds1 = appendLogicExp('book_account_type', '=', $userTypeId, 'AND', $conds1);
		$userConds = appendLogicExp('', '', $conds1, 'OR');		
		if (empty($user['mid']) === false) {
			$memberTypeId = BackAccountHelp::AccountTypeKey2Value('account_member');
			$conds2 = appendLogicExp('userid', '=' , $user['mid']);		
			$conds2 = appendLogicExp('book_account_type', '=', $memberTypeId, 'AND', $conds2);		
			$userConds = appendLogicExp('', '', $conds2, 'OR', $userConds);	
		}
		$conds = appendLogicExp('', '', $userConds, 'AND');
		
		if ($requestType == 'post') {
			$curPage = empty($aa['page']) ? 0 : intval($aa['page']);
			$startIndex = $curPage * ORDER_CENTER_LIST_SHOW_COUNT;
		} else {
			$startIndex = 0;			
		}
		
		if (!empty($aa['state'])) {
			$stateId = BackOrderHelp::OrderStateKey2Value($aa['state']);
			if (is_error($stateId) === false) {
				$conds = appendLogicExp('zhuangtai', '=', $stateId, 'AND', $conds);	
			}
		} else {
			$aa['state'] = 'all';
		}
		
		$data['conds'] = $conds;
		$sort = array('addtime'=>'desc');
		
		$orderList = BackOrderHelp::getNewOrderList($conds, $startIndex, ORDER_CENTER_LIST_SHOW_COUNT, $total, $sort, $out);
		$fill = array('state'=>1,'line'=>1,'batch'=>1,'money'=>1);
		$orderList = BackOrderHelp::fillNewOrderInfo($orderList, $fill);
		
		foreach($orderList as $ok=>$ov) {
			// 判断合同生效
			$sk = $ov['zhuangtai_data']['type_key'];
			if ($sk == 'pay_advance' || $sk == 'pay_part' || $sk == 'pay_complate') {
				$ov['agreenment'] = true;
			} else {
				$ov['agreenment'] = false;
			}
			
			// 判断可支付
			if ($sk == 'review' || $sk == 'pay_advance' || $sk == 'pay_part') {
				$ov['operate'] = 'pay'; 	
			} else if ($sk == 'unreview') {
				$ov['operate'] = 'wait_review';
			} else if ($sk == 'exit_team' || $sk == 'complated' || $sk == 'canceled' || $sk == 'invalid') {
				$ov['operate'] = 'team_end';
			}
			
			// 判断是否可退团
//			$result = BackOrderHelp::checkOrderOperate('exit_team', $ov['id']);
			
			$orderList[$ok] = $ov;
		}
		
		$pageCount = intval($total / ORDER_CENTER_LIST_SHOW_COUNT);
		if (intval($total % ORDER_CENTER_LIST_SHOW_COUNT) > 0) {
			$pageCount += 1;
		}
		
		if ($requestType == 'post') {
			$data['out'] = $out;
			$data['result'] = error(0, '');
			if ($total > 0) {
				$data['ds'] = $orderList;
				$data['page_count'] = $pageCount;
			} else {
				$data['result'] = error(-1, '没有找到相应订单');
			}
			return $this->ajaxReturn($data);
		} else {
			
			$questClass = array(
				'question_type_pay'=>0,
				'question_type_agreement'=>1,
				'question_type_insurance'=>2,
				'question_type_other'=>3,
			);
			
			$questType = array(0=>'',1=>'',2=>'',3=>'');
			$quest_type = MyHelp::getTypeData('question_type');
			if (is_error($quest_type) === false) {
				foreach ($quest_type as $qk=>$qv) {
					if (!array_key_exists($qv['type_key'], $questClass)) {
						continue;
					}
					$conds = appendLogicExp('type_id', '=', $qv['id']);
					$conds = appendLogicExp('question_id', '=', '0', 'AND', $conds);
					$questions =BackLineHelp::getQuestionList($conds, 0, 0, $total, array('create_time'), false);
					
					$idx = $questClass[$qv['type_key']];
					$qv['questions'] = $questions;
					$questType[intval($idx)] = $qv;
				}
			}		
			$this->assign('order_center_question', $questType);
			
			$this->assign($aa['state'].'_orders', $orderList);
			$this->assign('state', $aa['state']);
			$this->assign('page_count', $pageCount);
			
			$this->_initTemplateInfo();
			return $this->showPage('order_center');
		}		
	}

/**
* 订单支付跳转返回的post内容
*	"TransNo":"C20170127130810741750",
*	"PaymentNo":"CP20170127130813163443",
*	"OrderAmount":"0.01",
*	"TransTime":"20170127130829",
*	"paymentDetail":"",
*	"SendTime":"20170127130836",
*	"TraceNo":"a8a887a3-ac90-47a4-99a9-71e4d1d2c111",
*	"TransAmount":"0.01",
*	"Charset":"UTF-8",
*	"OrderNo":"LX-201701271307332041",
*	"TransType":"PT314",
*	"PayableFee":"0.00",
*	"Version":"V4.1.2.1.1",
*	"Ext1":"weixin_pay",
*	"Ext2":"",
*	"TransStatus":"01",
*	"PayChannel":"wp",
*	"SignType":"MD5",
*	"ReceivableFee":"0.00",
*	"Name":"REP_B2CPAYMENT",
*	"InstCode":"SFT",
*	"MerchantNo":"276614",
*	"MsgSender":"SFT",
*	"SignMsg":"09C23AEB31C5AA4277B9D69A40A3C6EB",
*	"ErrorMsg":"",
*	"ErrorCode":""
* 
* @return
*/
	public function payresultAction() {		
		// 获取热卖设置信息
		$conds = appendLogicExp('type', '=', 'pc_home_index');
		$conds = appendLogicExp('key', 'LIKE', 'hot_line%', 'AND', $conds);
		$set = MyHelp::getSet($conds, 0, 0, $total, array('sort'=>'asc'));
		$this->assign('set', $set);
				
		$transNo = I('post.TransNo', '');
		$order_sn = I('post.OrderNo', '');
		$money = I('post.TransAmount', 0);
		$state = I('post.ErrorCode', 0);
		$errMsg = I('post.ErrorMsg', '');
		
		/*$order = BackOrderHelp::getOrderInfo(appendLogicExp('id', '=', $aa['id']));
		if (is_error($order) === true) {
			return $this->display('Common/error');
		}*/
		$this->assign('trans_no', $transNo);
		$this->assign('order_sn', $order_sn);
		$this->assign('money', $money);	
		$this->assign('state', $state);
		$this->assign('err_msg', $errMsg);
		$this->showPage('pay_result', '','','支付结果','支付结果');
	}
	
	/**
	 * 西安银行在线支付前台回调请求方式：GET
	 * 
	 * @access    public
	 * @param     string   	ORDER_NO		订单号---String
	 * @param     Int   	PAY_STATUS		支付状态---Int(成功：1,失败：0)
	 * @param     Int   	BANK_TYPE		银行类别---Int(他行：1,本行：0)
	 * @param     String   	PAY_LOG_ID		支付流水号---String
	 * @param     Int   	ORDER_AMT		支付金额，单位为分---Int
	 * 
	 */
	 
	public function xianBankResultAction(){
		// 获取热卖设置信息
		$conds = appendLogicExp('type', '=', 'pc_home_index');
		$conds = appendLogicExp('key', 'LIKE', 'hot_line%', 'AND', $conds);
		$set = MyHelp::getSet($conds, 0, 0, $total, array('sort'=>'asc'));
		$this->assign('set', $set);
		
		$thisurl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		if(strpos($thisurl,'PAY_TYPE=xianBank') === false){
			$thisurl = str_replace('http://kllife.com/home/index.php?s=/home/line/xianBankResult/?', 'http://kllife.com/home/index.php?s=/home/line/xianBankResult/?PAY_TYPE=xianBank&', $thisurl);		
			header('Location: '.$thisurl.'');
		}		
						
		$transNo = I('get.PAY_LOG_ID', '');
		$order_sn = I('get.ORDER_NO', '');
		$money = I('get.ORDER_AMT', 0);
		$money = bcdiv($money, 100, 2);
		$state = I('get.PAY_STATUS', 0);
		$errMsg = I('get.ErrorMsg', ''); //西银在线未返回当前参数
		
		/*$order = BackOrderHelp::getOrderInfo(appendLogicExp('id', '=', $aa['id']));
		if (is_error($order) === true) {
			return $this->display('Common/error');
		}*/
		$this->assign('trans_no', $transNo);
		$this->assign('order_sn', $order_sn);
		$this->assign('money', $money);	
		$this->assign('state', $state);
		$this->assign('err_msg', $errMsg);
		$this->showPage('pay_result', '','','支付结果','支付结果');
	}
	
/**
* 阿里巴巴订单支付返回
* [is_success] => "是否付款成功，成功返回'T',失败返回'F'",
* [notify_id] => RqPnCoPT3K9%2Fvwbh3InZdJz4hPAenG2kMC84wbGSO4IcH6p0Y3ZFkzsyrt2cN2GMHV28
* [notify_time] => 2017-02-21 15:10:08
* [notify_type] => trade_status_sync
* [out_trade_no] => "订单编号，例如：LX-17021412244065201-3"
* [payment_type] => 1
* [seller_id] => 2088421286007493
* [service] => alipay.wap.create.direct.pay.by.user
* [subject] => "订单线路的标题"
* [total_fee] => "订单付款金额"
* [trade_no] => "交易编号：2017022121001004910217666149"
* [trade_status] => "交易状态，TRADE_SUCCESS"
* [sign] => 47cd8e3c01327ab137b8ca2d6367e831
* [sign_type] => MD5
* @return
*/
	public function alipayresultAction() {
		$result = MsgHelp::AlipayReturn();
		if ($result) {
			// 获取热卖设置信息
			$this->assign('aa', $_GET);
			$conds = appendLogicExp('type', '=', 'pc_home_index');
			$conds = appendLogicExp('key', 'LIKE', 'hot_line%', 'AND', $conds);
			$set = MyHelp::getSet($conds, 0, 0, $total, array('sort'=>'asc'));
			$this->assign('set', $set);
					
			$transNo = I('get.trade_no', '');
			$order_sn = I('get.out_trade_no', '');
			$money = I('get.total_fee', 0);
			$state = I('get.is_success', 'F');
			if ($state == 'T') {
				$state = '1';
			} else {
				$errMsg = '支付失败!';
				$state = '0';
			}
			
			$orderSN = BackOrderHelp::getRealOrderSN($order_sn);
			$order = BackOrderHelp::getOrderInfo(appendLogicExp('order_sn', 'LIKE', $orderSN.'%'));
			if (is_error($order) === true) {
				return $this->display('Common/error');
			}
			$this->assign('trans_no', $transNo);
			$this->assign('order_sn', $order_sn);
			$this->assign('money', $money);	
			$this->assign('state', $state);
			$this->assign('err_msg', $errMsg);
		} else {
			$errMsg = error(-1, '返回验证失败');			
			$this->assign('err_msg', $errMsg);
		}
		$this->showPage('pay_result', 'line_pay_result', 'pay_result', '支付结果');	
	}
	
	public function wxpayresultAction() {
		$payObj = ModelBase::getInstance('pay_log', 'xz_');
		if (IS_POST) {
			$order_sn = I('post.order_sn', false);
			if (empty($order_sn)) {
				$data['result'] = error(-1, '错误订单编号');
				return $this->ajaxReturn($data);
			} else {				
				$data['jumpUrl'] = U('line/wxpayresult', array('order_sn'=>$order_sn));
				return $this->ajaxReturn($data);
			}
		} else {
			$order_sn = I('get.order_sn', false);
		}
		
		
		$pay = $payObj->getOne(appendLogicExp('order_sn', '=', $order_sn));		
		
		if (IS_POST) {			
			if (empty($pay)) {
				$data['result'] = error(-1, '您的支付结果还未到账，请稍后点击查询');
				return $this->ajaxReturn($data);
			}
			
			$data['jumpUrl'] = U('line/wxpayresult', array('order_sn'=>$order_sn));
			return $this->ajaxReturn($data);
		} else {		
			if (empty($pay)) {
				return $this->showError(501, '订单错误', '未能找到订单编号为['.$order_sn.']的支付记录!');
			}
			
			// 获取热卖设置信息
			$conds = appendLogicExp('type', '=', 'pc_home_index');
			$conds = appendLogicExp('key', 'LIKE', 'hot_line%', 'AND', $conds);
			$set = MyHelp::getSet($conds, 0, 0, $total, array('sort'=>'asc'));
			$this->assign('set', $set);
			
			$this->assign('trans_no', $pay['TransNo']);
			$this->assign('order_sn', $pay['order_sn']);
			$this->assign('money', $pay['TransAmount']);	
			$this->assign('state', 1);			
			$this->showPage('pay_result', 'line_pay_result', 'pay_result', '支付结果');	
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
			
			$this->_initTemplateInfo();
			$this->showPage('article_list');
		}
	}
	
	public function articleAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'list') {
				$this->listArticle('post', $_POST);
			} else {
				$data['result'] = error(-1, '错误的操作类型');
				$this->ajaxReturn($data);
			}
		} else {
			$id = I('get.id', 0);
			if (!empty($id)) {
				$article = BackLineHelp::getArticle(appendLogicExp('id', '=', $id), true);
				$this->assign('article', $article);
				
				$this->_initTemplateInfo();
				$this->showPage('article_info');
			} else {
				$this->listArticle('get', $_GET);
			}
		}
	}
	
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
			$this->_initTemplateInfo();
			$this->showPage('video_list');	
		}
	}
	
	public function videoAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'list') {
				$this->listVideo('post', $_POST);
			} else {
				$data['result'] = error(-1, '错误的操作类型');
				$this->ajaxReturn($data);
			}
		} else {
			$this->listVideo('get', $_GET);
		}
	}
	
	// 问题列表
	private function listQuestion($requestType, $aa) {
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
	
	// 生成问题
	public function createQuestion($aa) {
		if (IS_POST) {
			$user = MyHelp::getLoginAccount(false);
			if (is_error($user) === true) {
				$data['jumpUrl'] = U('User/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI'])));
				$data['result'] = error(-1, '提问题需要您登录');
				return $this->ajaxReturn($data);
			}
			
			$questionObj = ModelBase::getInstance('question');
			$colNames = $questionObj->getUserDefine(ModelBase::DF_COL_NAMES);
			
			$ds = coll_elements_giveup($colNames, $aa);
			$ds['account_type_id'] = $user['account_type']['id'];
			$ds['account_id'] = $user['id'];
			$ds['create_time'] = fmtNowDateTime();
			$ds['content'] = htmlspecialchars($ds['content']);
			$ds['agree'] = 0;
			
			if ($aa['op_type'] == 'create_line_question') {
				$ds['type_id'] = MyHelp::TypeDataKey2Value('question_type_line');
			}
			
			$data['result'] = $questionObj->create($ds, $questionId);
			if (error_ok($data['result']) === true) {
				$data['result'] = error(0, '您的问题已经收到，正在快马加鞭送往您的专属客服处，请耐心等待。这个空隙您可以偷阅其他人的提问哦。');
				$ds['content'] = htmlspecialchars_decode($ds['content']);
				$ds['account_id_data'] = $user;
				$ds['account_id_show_name'] = $user['name'];
				$ds['answer_count'] = 0;
				$ds['id'] = $questionId;
				$data['ds'] = $ds;
			}
			$this->ajaxReturn($data);
		} else {
			$errPageData = errorPage('404','错误', '找不到页面', '找不到所请求的页面');
			$this->assign('err', $errPageData);
			$this->showPage('index/error');
		}
	}
	
	private function agreeQuestion($aa) {
		if (empty($aa['id'])) {
			$data['result'] = error(-1, '问题编号错误');
			return $this->ajaxReturn($data);			
		}
		$questionObj = ModelBase::getInstance('question');
		$conds = appendLogicExp('id', '=', $aa['id']);
		$data['result'] = $questionObj->fieldAddAndSub($conds, 'agree', 1);
		if (error_ok($data['result']) === false) {
			$data['sql'] = $questionObj->getLastSql();
			$data['db_error'] = $questionObj->getDbError();
		} else {
			$data['ds'] = BackLineHelp::getQuestion($conds);
		}	
		return $this->ajaxReturn($data);		
	}
	
	public function questionAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'list') {
				$this->listQuestion('post', $_POST);
			} else if ($type == 'create_line_question') {
				$this->createQuestion($_POST);
			} else if ($type == 'agree') {
				$this->agreeQuestion($_POST);
			} else {
				$data['result'] = error(-1, '错误的操作方式');
				$this->ajaxReturn($data);
			}
		} else {			
			$this->display('Index/error');			
		}
	}
	
	// 处理专题的数据
	private function subjectData($aa) {
		if (empty($aa['subject_id'])) {
			$data['result'] = error(-1, '专题的类型错误参数类型错误');
			return $this->ajaxReturn($data);
		}
		
		if (empty($aa['key'])) {
			$data['result'] = error(-1, '查找的专题数据类型不能为空');
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
					$find = array('batch'=>true);
					$valList = BackLineHelp::getLineList($conds, 0, 0, $total, array('id'=>'desc'), $find); 
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
			} else {
				$data['result'] = error(-1, '未知的配置类型');
				return $this->ajaxReturn($data);
			}
		} else {
			$data['result'] = error(-1, '未知的配置类型');
			return $this->ajaxReturn($data);
		}
	}
	
	
	public function subjectAction() {
		if (IS_POST) {
			$type = I('post.op_type');
			if ($type == 'data') {
				$this->subjectData($_POST);
			} else {
				$data['result'] = error(-1, '错误的请求操作方式');
				$this->ajaxReturn($data);
			}
			
		} else {
			session_start();
			$id = I('get.id', false);
			if (empty($id)) {
				return $this->showError('502', '专题错误', '专题的内容不存在或者已经下架');	
			}
			
			// IP定位
			$station = MyHelp::getStationByIP();			
			$stationId = $station['id'];
			// 周边游数据
			$surroundingKey = 'subject_surrounding_cache'.$stationId;
			$sets = S($surroundingKey);
			$checked = MyHelp::checkConfigOverdue('pc_home_index', $sets['config_update_time'], $stationId);
			if (empty($sets) || $checked == true) {
				$conds = appendLogicExp('station_id', '=', $stationId);
				$conds = appendLogicExp('key', 'LIKE', '%surrounding%', 'AND', $conds);
				$sets = MyHelp::getSet($conds);
				// 获取更新时间
				$sets['config_update_time'] = MyHelp::getConfigUpdateTime('pc_home_index', $stationId);
				S($surroundingKey, $sets, 0);
			}
			
			$showSurrounding = 0;
			foreach ($sets as $sk=>$sv) {
				if (stripos($sk, 'surrounding_line') !== FALSE && stripos($sk, 'surrounding_line_tab') === FALSE) {
					$showSurrounding = 1;
					break;
				}
			}
			$this->assign('show_surrounding', $showSurrounding);
			$this->assign('set', $sets);
			
									
			$realIds = preg_split('/\D/s',$id);
			if (!empty($realIds[0])) {
				$realId = $realIds[0];
				$cacheSubjectKey = 'cache_set_subject_'.$realId;
				$subject = S($cacheSubjectKey);
				if (empty($subject) || MyHelp::checkConfigOverdue($cacheSubjectKey, $subject['config_update_time']) === true) {
					$subject = BackLineHelp::getSubject(appendLogicExp('id', '=', $realId), array('data'=>true));
					$subject['config_update_time'] = MyHelp::getConfigUpdateTime($cacheSubjectKey);
					S($cacheSubjectKey, $subject, 0);
				}
				$this->assign('subject', $subject);
			}	
			
			//调用SEO文章
			$this->seoArticleList();
				
			$this->showPage('subject', 'line_subject', 'line', '专题');			
		}
	}

	//调用SEO文章
	private function seoArticleList(){
		if(IS_GET){
			$refresh = I('get.refresh', false);
			$subjectId = I('get.id', false);
			$seoinfo = S('pc_subject_seo_cache');			
			if(empty($seoinfo) || !empty($refresh)){
				$result = MyHelp::getPageList('seo_article', 'invalid|=|0|AND|classid|=|'.$subjectId.'|AND|', 0, 6, array('id'=>'desc'), 4, $out);
				if(!empty($result['ds'])){
					$seoinfo = $result['ds'];
				}else{
					$seoinfo = '未查找到数据';
				}			
				S('pc_subject_seo_cache', $seoinfo, 0);
			}
			//$this->assign('seoout', $out);
			$this->assign('seoarticles', $seoinfo);
		}
	}
	
	
	// 定制游
	public function bookAction() {
		if (IS_POST) {
			$data['result'] = BackTeamHelp::createTeamGroup($_POST, $teamId);
			return $this->ajaxReturn($data);
		} else {
			// 住宿要求
			$hotelRequest = MyHelp::getTypeData('hotel_request');
			$this->assign('hotel_request', $hotelRequest);
			
			// 领队要求
			$leaderRequest = MyHelp::getTypeData('leader_request');
			$this->assign('leader_request', $leaderRequest);
			
			// 特色服务
			$especialRequest = MyHelp::getTypeData('especial_request');
			$this->assign('especial_request', $especialRequest);
			
			// 联系时间
			$contactRequest = MyHelp::getTypeData('contact_time');
			$this->assign('contact_time', $contactRequest);
			
			$this->showPage('private_book', 'book_line', 'line', '私人订制');
		}
	}
		
	//优化文章
	public function newsAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'list') {
				$this->listNews('post', $_POST);
			} else {
				$data['result'] = error(-1, '错误的操作类型');
				$this->ajaxReturn($data);
			}
		} else {
			$id = I('get.id', 0);
			if (!empty($id)) {
				$article = BackLineHelp::getSeoArticle(appendLogicExp('id', '=', $id), true);
				$this->assign('article', $article);
				
				$this->_initTemplateInfo();
				$this->showPage('news_info');
			} else {
				$this->listNews('get', $_GET);
			}
		}
	}
	
	// 显示文章
	private function listNews($requestType, $aa) {
		if ($requestType == 'post') {
			$pageIndex = empty($aa['page']) ? 0 : $aa['page'];
			$startIndex = $pageIndex * LINE_ARTICLE_LIST_SHOW_COUNT;
		} else {
			$startIndex = 0;
			$classid = I('get.classid', false);
			if(!empty($classid)){
				$conds = appendLogicExp('classid', '=', $classid, 'AND', $conds);
			}
		}

		$conds = appendLogicExp('invalid', '!=', '1', 'AND', $conds);		
		$sort = array('recommend'=>'desc', 'hot'=>'desc', 'agree'=>'desc', 'read'=>'desc', 'create_time'=>'desc');
		$fill = array('content'=>1);
		$articles = BackLineHelp::getSeoArticleList($conds, $startIndex, LINE_ARTICLE_LIST_SHOW_COUNT, $total, $sort, $fill);
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
			
			$this->_initTemplateInfo();
			$this->showPage('news_list');
		}
	}
}

?>
