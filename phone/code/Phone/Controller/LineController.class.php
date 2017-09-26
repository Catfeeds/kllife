<?php
namespace Phone\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackLineHelp;
use Core\Model\BackOrderHelp;
use Core\Model\BackAccountHelp;
use Core\Model\BackReviewHelp;
use Core\Model\MsgHelp;
use Core\Model\BackTeamHelp;

define('LINE_LIST_SHOW_COUNT', 5);
define('ORDER_CENTER_LIST_SHOW_COUNT', 6);
define('LINE_QUESTION_LIST_SHOW_COUNT', 6);
define('LINE_ARTICLE_LIST_SHOW_COUNT', 8);
define('LINE_QUESTION_TEXT_SHOW_COUNT', 23);
define('LINE_VIDEO_LIST_SHOW_COUNT', 12);

class LineController extends PhoneBaseController {
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
				$searchval = I('post.cdval', false);
			}
			$pageIndex = I('post.page', 0);
			$sortstr = I('post.sorts', false);
		} else {
			$searchval = session('line_search_val');
			$pageIndex = 0;
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
		if (!empty($searchConds)) {
			$conds = appendLogicExp('searchval', '=', $searchConds, 'AND', $conds);	
		}
//		$find = array('batch'=>true);
		$startIndex = $pageIndex * LINE_LIST_SHOW_COUNT;
		$ds = BackLineHelp::getLineList($conds, $startIndex, LINE_LIST_SHOW_COUNT, $total, $sorts, false, $out);
		$pageCount = intval($total / LINE_LIST_SHOW_COUNT);
		if ($total % LINE_LIST_SHOW_COUNT > 0) {
			$pageCount += 1;
		}
		
		if (IS_POST) {
//			$data['out'] = $out;
			$data['ds'] = $ds;
			$data['page_count'] = $pageCount;
			$data['result'] = error(0, '');						
			return $this->ajaxReturn($data);
		} else {
			$this->assign('searchval', $searchval);
			$this->assign('lines', $ds);
			$this->assign('page_count', $pageCount);			
			$this->showPage('search', 'line_search', 'line', '产品搜索', '产品搜索');
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
	
			
	// 产品列表展示
	public function listAction() {
		if (IS_POST) {
			$page = I('post.page', 0);	
			$cdsstr = I('post.cds', false);
			$sortstr = I('post.sorts', false);
		} else {
			$page = I('get.page', 0);	
			$cdsstr = I('get.cds', false);						
			$sortstr = I('get.sorts', false);
			
			// 首页专题导航
			$t = I('get.t', false);
			if (!empty($t)) {				
				$theme = array('zb'=>'周边游', 'sd'=>'小团慢旅行', 'qlp'=>'跟拍游', 'sy'=>'摄影游', 'mz'=>'民族行');
				if (!empty($theme[$t])) {
					$cdsstr = 'theme_type|'.$theme[$t];
					$this->assign('init_theme_type', $theme[$t]);
				}
			}
		}	
		$startIndex = $page * LINE_LIST_SHOW_COUNT;
		
		if (!empty($cdsstr)) {
			$cdList = explode('|',$cdsstr);
			for($i = 0; $i < count($cdList); $i+=2){
				if ($cdList[$i+1] == '跟拍游') {
					$xzlxConds = appendLogicExp('theme_type', 'LIKE', '%line_theme_qlp%', 'OR');
					$xzlxConds = appendLogicExp('qinglvpai', '>', '0', 'OR', $xzlxConds);
					$conds = appendLogicExp('theme_type', '=', $xzlxConds, 'AND', $conds);	
				} else if ($cdList[$i+1] == '深度游') {
					$smhConds = appendLogicExp('theme_type', 'LIKE', '%line_theme_shendu%', 'OR', $smhConds);
					$smhConds = appendLogicExp('theme_type', 'LIKE', '%line_theme_minzuxing%', 'OR', $smhConds);
					$smhConds = appendLogicExp('theme_type', 'LIKE', '%line_theme_cjy%', 'OR', $smhConds);
					$conds = appendLogicExp('theme_type', '=', $smhConds, 'AND', $conds);	
				} else {
					$conds = appendLogicExp($cdList[$i], 'LIKE', '%'.$cdList[$i+1].'%', 'AND', $conds);	
				}
			}	
		}
		
		if (!empty($sortstr)) {
			$sortList = explode('|', $sortstr);
			for($i = 0; $i < count($sortList); $i+=2){
				$sorts[$sortList[$i]] = $sortList[$i+1];
			}
		} else {
			$sort = array('sort'=>'asc', 'create_time'=>'desc');	
		}
		
		$sorts['sort'] = 'asc';
		if (!array_key_exists('create_time', $sorts)) {
			$sorts['create_time'] = 'desc';
		}
		
//		$searchval = session('line_search_val');
//		if (!empty($searchval)) {	
//			$searchConds = appendLogicExp('title', 'LIKE', '%'.$searchval.'%', 'OR', $searchConds);
//			$searchConds = appendLogicExp('subheading', 'LIKE', '%'.$searchval.'%', 'OR', $searchConds);
//			$searchConds = appendLogicExp('theme_type', 'LIKE', '%'.$searchval.'%', 'OR', $searchConds);
//			$searchConds = appendLogicExp('play_type', 'LIKE', '%'.$searchval.'%', 'OR', $searchConds);
//			$searchConds = appendLogicExp('dismiss_place', 'LIKE', '%'.$searchval.'%', 'OR', $searchConds);
//			$searchConds = appendLogicExp('assembly_point', 'LIKE', '%'.$searchval.'%', 'OR', $searchConds);
//			$searchConds = appendLogicExp('destination', 'LIKE', '%'.$searchval.'%', 'OR', $searchConds);
//			$searchConds = appendLogicExp('view_point', 'LIKE', '%'.$searchval.'%', 'OR', $searchConds);
//			$searchConds = appendLogicExp('hotel_type', 'LIKE', '%'.$searchval.'%', 'OR', $searchConds);
//			$conds = appendLogicExp('search', '=', $searchConds, 'AND', $conds);
//		}	
		
		$conds = appendLogicExp('online', '=', '1', 'AND', $conds);
		$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
//		$find = array('batch'=>true);
		$ds = BackLineHelp::getLineList($conds, $startIndex, LINE_LIST_SHOW_COUNT, $total, $sorts, false, $out);
		$pageCount = intval($total / LINE_LIST_SHOW_COUNT);
		if ($total % LINE_LIST_SHOW_COUNT > 0) {
			$pageCount += 1;
		}
		
		if (IS_POST) {
			$data['out'] = $out;
			$data['page_count'] = $pageCount;
			$data['result'] = error(0,"");
			$data['ds'] = $ds;
			$this->ajaxReturn($data);
		} else {				
			$this->assign('lines', $ds);
			$this->assign('page_count', $pageCount);
			$cds['test'] = 'test';
			$this->assign('cds', $cds);
			
			// 其他地方标题搜索
			if (!empty($cds['title'])) {
				$this->assign('search_value', $cds['title']);
			}
			
			// 产品包含
			$lineTheme = MyHelp::getTypeData('line_theme');
			if (is_error($lineTheme) === false) {
				$themes = array('全部');
				foreach ($lineTheme as $tk=>$tv) {
					array_push($themes, $tv['type_desc']);
				}				
				$this->assign('line_theme', json_encode($themes));
			}
			
			// 集合地
			$assemblyPlace = MyHelp::getTypeData('line_assembly_point');
			if (is_error($assemblyPlace) === false) {
				$assemblys = array('全部');
				foreach ($assemblyPlace as $tk=>$tv) {
					array_push($assemblys, $tv['type_desc']);
				}
				$this->assign('assembly_place', json_encode($assemblys));	
			}
			
			// 目的地
			$destination = MyHelp::getTypeData('line_destination');
			if (is_error($destination) === false) {
				$dests = array('全部');
				foreach ($destination as $tk=>$tv) {
					array_push($dests, $tv['type_desc']);
				}
				$this->assign('dest', json_encode($dests));	
			}
			
			// 包含景点
			$view_point = MyHelp::getTypeData('line_view_point');
			if (is_error($view_point) === false) {
				$views = array('全部');
				foreach ($view_point as $tk=>$tv) {
					array_push($views, $tv['type_desc']);
				}
				$this->assign('view_point', json_encode($views));	
			}
			
			// 旅行月份
			$months = MyHelp::getTypeData('month');
			if (is_error($months) === false) {
				$month = array('全部');
				foreach ($months as $tk=>$tv) {
					array_push($month, $tv['type_desc']);
				}
				$this->assign('month', json_encode($month));	
			}
		
			$this->showPage('list', 'line_line', 'line', '产品列表');
		}
	}
	
	public function infoAction() {
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
			} else {
				$data['result'] = error(-1, '错误的请求方式');
				return $this->ajaxReturn($data);
			}
		} else {
			$id = I('get.id', false);
			if (!empty($id)){				
				$find = array(
					'phone_point'=>true,
					'travel'=>true,
					'scenery'=>true,
//					'batch'=>true,
					'offer'=>true,
//					'article'=>array('content'=>true),
					'set'=>true,					
				);
				$line = BackLineHelp::getLine(appendLogicExp('id', '=', $id), $find);
				$batchConds = appendLogicExp('line_id', '=', $line['id']);
				$batchConds = appendLogicExp('use_state', 'NOT LIKE', '%line_batch_use_forbid%', 'AND', $batchConds);
				$line['batchs'] = BackLineHelp::getBatchList($batchConds, 0, 0, $total, array('start_time'=>'asc'));	
				
				if ($line['online'] == '0' || $line['invalid'] == '1') {
					return $this->showError('502', '线路错误', '线路未上架', '该线路可能已经下架或者不存在');
				}
				
				$weekarray = array('周日', '周一', '周二', '周三', '周四', '周五', '周六');
				$batch_top = array();
				foreach ($line['batchs'] as $bk=>$bv) {
					if ($bv['state_data']['type_desc'] != '已过期') {
						$timeArr = explode('-',$bv['start_date_show']);
						$timeStr = $timeArr[1].'/'.$timeArr[2];	
						$batch_top[$bk] = $bv;
						$batch_top[$bk]['start_date_show_str'] = $timeStr;						
						$batch_top[$bk]['start_date_show_week'] = $weekarray[date("w", strtotime($bv['start_date_show']))];
					}					
				}
				$line['batch_top'] = $batch_top;
				
							
				// 是否存在游记与推荐线路
				$line['exist_youji'] = 0;
				$line['exist_recommend_line'] = 0;
				foreach ($line['sets'] as $sk=>$sv) {
					if (stripos($sv['key'], 'youji') !== FALSE) {
						$line['exist_youji'] = 1;
					}
					if (stripos($sv['key'], 'recommend_line') !== FALSE) {
						$line['exist_recommend_line'] = 1;
					}
				}
							
				$this->assign('line', $line);
				$this->assign('select_batch_id', $aa['b']);
				
				// 分销用户
				$duid = I('get.duid', false);
				if (!empty($duid)) {
					$this->assign('duid', $duid);
				}			
		
				// 下单前约束检查
				$ds = array('lineid'=>$line['id'], 'new_line'=>1, 'new_order'=>1);
				$check = BackOrderHelp::checkOrderCreate($ds,true);
				$this->assign('check', $check);					
				
				if (!empty($line['is_xinlvpai'])) {
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
				
				// 点击量
				$lineObj = ModelBase::getInstance('line');
				$lineObj->fieldAddAndSub(appendLogicExp('id', '=', $line['id']), 'click_count', 1, true);
				
				if (empty($line['is_xinlvpai'])) {
					$pageTitle = $line['title'].'-'.$line['subheading'];
					$this->showPage('content', 'line_content', 'line', $pageTitle);					
				} else {
					$this->showPage('qlp_content', 'line_qlp_content', 'line', '跟拍游产品-领袖户外');
				}
			} else {
				$this->display('common/error');
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
	
	// 获取赠品的可选项
	public function largessAction() {
		if (IS_POST) {
			$dataType = I('post.data_type', false);
			$typeDatas = MyHelp::getTypeData($dataType);
			if (is_error($typeDatas) === false) {
				$ds = array();
				foreach($typeDatas as $tk=>$tv) {
					array_push($ds, array('id'=>$tv['id'], 'text'=>$tv['type_desc']));
				}
				$data['ds'] = $ds;
				$data['result'] = error(0, '');
			} else {
				$data['result'] = error(-1, '查找赠品信息错误');
			}
			$this->ajaxReturn($data);
		}
	}
	
	// 生成订单
	public function testOrderAction() {
		if (IS_GET) {
			$aa = $_GET;
			$line = BackLineHelp::getLine(appendLogicExp('id', '=', $aa['id']), false);
			$batchList = array();
			$batchIdList = array();
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
				$item_text = $bv['start_date_show'] . '至' . $bv['end_date_show'];
				array_push($batchList, array(
					'id'=>$bv['id'], 
					'text'=>$item_text, 
					'invalid'=>$bv['signup_invalid'],
					'use'=>$bv['can_use'],
					));
			}
			$this->assign('cur_batch', $curBatch);
			$this->assign('batch_list', json_encode($batchList));			
			$this->assign('line', $line);
			
			// 下单前约束检查
			$ds = array('lineid'=>$line['id'], 'new_line'=>1, 'new_order'=>1);
			$check = BackOrderHelp::checkOrderCreate($ds,true);
			$this->assign('check', $check);
			
			$this->assign('member_male_count', empty($aa['m']) ? 0 : $aa['m']);
			$this->assign('member_woman_count', empty($aa['w']) ? 0 : $aa['w']);
			$this->assign('member_child_count', empty($aa['ch']) ? 0 : $aa['ch']);
			
			$memberTypes = BackOrderHelp::getMemberTypes();
			
			foreach ($memberTypes as $mk=>$mv) {
				if ($mv['type_key'] == 'adult_man') {
					$adultMan = $mv;
				}
				if ($mv['type_key'] == 'adult_woman') {
					$adultWoman = $mv;
				}
				if ($mv['type_key'] == 'child') {
					$adultChild = $mv;
				}
			}
			
			$members = array();
			if (!empty($aa['m']) && !empty($adultMan)) {
				for ($m = 0; $m < intval($aa['m']); $m++) {
					array_push($members, $adultMan);
				}
			}
			if (!empty($aa['w']) && !empty($adultWoman)) {
				for ($w = 0; $w < intval($aa['w']); $w++) {
					array_push($members, $adultWoman);
				}
			}
			if (!empty($aa['c']) && !empty($adultChild)) {
				for ($c = 0; $c < intval($aa['c']); $c++) {
					array_push($members, $adultChild);
				}
			}
			$this->assign('members', $members);
			$this->assign('member_types', json_encode($memberTypes));			
			
			$certs = array();
			$certTypes = BackOrderHelp::getMemberCertTypes();
			foreach($certTypes as $ck=>$cv) {
				array_push($certs, array('id'=>$cv['id'],'text'=>$cv['type_desc']));
			}
			$this->assign('certs', json_encode($certs));			
			
			// 是否包含赠送物品
			if (!empty($line['largess_list'])) {
				$largess = $line['largess_list'];
				$this->assign('largess', $largess);
			}
				
			// 分销用户
			$duid = I('get.duid', false);
			if (!empty($duid)) {
				$this->assign('duid', $duid);
			}	
			
			$this->_initTemplateInfo();
			$this->showPage('order_create_test', 'line_order_create', 'line', '创建订单');
		} else {			
			$aa = $_POST;
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
			$ds['from_id'] = BackOrderHelp::OrderFromKey2Value('phone');
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
				$data['result'] = error(-1, '订单线路存在问题，不能生成订单:'.$ds['lineid']);
				return $this->ajaxReturn($data);
			}
			$data['line'] = $line;
			$ds['station_id'] = $line['station_data'][0]['id'];
			
			// 获取套餐价格编号
			$ds['tc_price_id'] = 0;
			if (!empty($aa['taocan_ids'])) {
				$conds = appendLogicExp('batch_id', '=', $ds['hdid']);
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
						if (!empty($mv['type'])) {
							$mds['type_id'] = BackOrderHelp::MemberTypeKey2Value($types[$mv['type']]);	
						}
						$data['member'.$mk.'_result'] = $memberObj->create($mds, $memberId);
						if (error_ok($result)) {
//							$data['member'.$mk.'_result'] = error(-1, $result['message'].'/'.$data['member_result']['message']);
							
							$data['member'.$mk.'_ds'] = $mds;
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
										$data['member'.$mk.'_largess'.$lk.'_ds'] = $lds;
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
					$fxUser = BackAccountHelp::getAccount('distribute_account', appendLogicExp('id', '=', $aa['duid']));
					$fxUser['type_id_data'] = MyHelp::TypeDataKey2Value($fxUser['type_id']);
					if (!empty($fxUser['type_id_data']) && $fxUser['type_id_data']['type_key'] == 'distribute_user_vip1') {
						$fxDS['commision_adult'] = 0.00;
						$fxDS['commision_child'] = 0.00;
					} else {
						$fxDS['commision_adult'] = $line['commision_adult'];
						$fxDS['commision_child'] = $line['commision_child'];
					}
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
	
	// 生成订单
	private function createOrder($requestType, $aa) {
		if ($requestType == 'get') {
			$line = BackLineHelp::getLine(appendLogicExp('id', '=', $aa['id']), false);
			$batchList = array();
			$batchIdList = array();
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
				$item_text = $bv['start_date_show'] . '至' . $bv['end_date_show'];
				array_push($batchList, array(
					'id'=>$bv['id'], 
					'text'=>$item_text, 
					'invalid'=>$bv['signup_invalid'],
					'use'=>$bv['can_use'],
					));
			}
			
			
			
			// 获取产品已添加的套餐价格
			$tplConds = appendLogicExp('line_id', '=',  $aa['id']);
			$tplConds = appendLogicExp('invalid', '=', '0', 'AND', $tplConds);
			$tplFind = array('taocan'=>true);
			$taocanPrices = BackLineHelp::getTaocanPriceList($tplConds, 0, 0, $total, array('id'=>'asc'), $tplFind);
			$taocanMap = array();
			foreach ($taocanPrices as $tk=>$tv) {
				foreach ($tv['taocans'] as $tvk=>$tvv){
					$taocanMap[$tvv['id']] = $tvv;
				}
			}
			
			$line['taocan_list'] = $taocanMap;
			$this->assign('cur_batch', $curBatch);
			$this->assign('batch_list', json_encode($batchList));			
			$this->assign('line', $line);
			
			// 下单前约束检查
			$ds = array('lineid'=>$line['id'], 'new_line'=>1, 'new_order'=>1);
			$check = BackOrderHelp::checkOrderCreate($ds,true);
			$this->assign('check', $check);
			
			$this->assign('member_male_count', empty($aa['m']) ? 0 : $aa['m']);
			$this->assign('member_woman_count', empty($aa['w']) ? 0 : $aa['w']);
			$this->assign('member_child_count', empty($aa['ch']) ? 0 : $aa['ch']);
			
			$memberTypes = BackOrderHelp::getMemberTypes();
			
			foreach ($memberTypes as $mk=>$mv) {
				if ($mv['type_key'] == 'adult_man') {
					$adultMan = $mv;
				}
				if ($mv['type_key'] == 'adult_woman') {
					$adultWoman = $mv;
				}
				if ($mv['type_key'] == 'child') {
					$adultChild = $mv;
				}
			}
			
			$members = array();
			if (!empty($aa['m']) && !empty($adultMan)) {
				for ($m = 0; $m < intval($aa['m']); $m++) {
					array_push($members, $adultMan);
				}
			}
			if (!empty($aa['w']) && !empty($adultWoman)) {
				for ($w = 0; $w < intval($aa['w']); $w++) {
					array_push($members, $adultWoman);
				}
			}
			if (!empty($aa['c']) && !empty($adultChild)) {
				for ($c = 0; $c < intval($aa['c']); $c++) {
					array_push($members, $adultChild);
				}
			}
			$this->assign('members', $members);
			$this->assign('member_types', json_encode($memberTypes));			
			
			$certs = array();
			$certTypes = BackOrderHelp::getMemberCertTypes();
			foreach($certTypes as $ck=>$cv) {
				array_push($certs, array('id'=>$cv['id'],'text'=>$cv['type_desc']));
			}
			$this->assign('certs', json_encode($certs));			
			
			// 是否包含赠送物品
			if (!empty($line['largess_list'])) {
				$largess = $line['largess_list'];
				$this->assign('largess', $largess);
			}
				
			// 分销用户
			$duid = I('get.duid', false);
			if (!empty($duid)) {
				$this->assign('duid', $duid);
			}	
			
			$this->_initTemplateInfo();
			$this->showPage('order_create', 'line_order_create', 'line', '创建订单');
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
			$ds['from_id'] = BackOrderHelp::OrderFromKey2Value('phone');
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
				$data['result'] = error(-1, '订单线路存在问题，不能生成订单:'.$ds['lineid']);
				return $this->ajaxReturn($data);
			}
			$data['line'] = $line;
			$ds['station_id'] = $line['station_data'][0]['id'];
			
			// 获取套餐价格编号
			$ds['tc_price_id'] = 0;
			if (!empty($aa['taocan_ids'])) {
				$conds = appendLogicExp('batch_id', '=', $ds['hdid']);
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
						if (!empty($mv['type'])) {
							$mds['type_id'] = BackOrderHelp::MemberTypeKey2Value($types[$mv['type']]);	
						}
						$data['member'.$mk.'_result'] = $memberObj->create($mds, $memberId);
						if (error_ok($result)) {
//							$data['member'.$mk.'_result'] = error(-1, $result['message'].'/'.$data['member_result']['message']);
							
							$data['member'.$mk.'_ds'] = $mds;
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
										$data['member'.$mk.'_largess'.$lk.'_ds'] = $lds;
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
					$fxUser = BackAccountHelp::getAccount('distribute_account', appendLogicExp('id', '=', $aa['duid']));
					$fxUser['type_id_data'] = MyHelp::TypeDataKey2Value($fxUser['type_id']);
					if (!empty($fxUser['type_id_data']) && $fxUser['type_id_data']['type_key'] == 'distribute_user_vip1') {
						$fxDS['commision_adult'] = 0.00;
						$fxDS['commision_child'] = 0.00;
					} else {
						$fxDS['commision_adult'] = $line['commision_adult'];
						$fxDS['commision_child'] = $line['commision_child'];
					}
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
		$user = MyHelp::getLoginAccount(false);
		
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
		
		$orderList = BackOrderHelp::getNewOrderList($conds, $startIndex, ORDER_CENTER_LIST_SHOW_COUNT, $total, $sort);
		$fill = array('state'=>1,'line'=>1,'batch'=>1, 'money'=>1);
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
			$orderList[$ok] = $ov;
		}
		
		$pageCount = intval($total / ORDER_CENTER_LIST_SHOW_COUNT);
		if (intval($total % ORDER_CENTER_LIST_SHOW_COUNT) == 1) {
			$pageCount += 1;
		}
		
		if ($requestType == 'post') {
			$data['result'] = error(0, '');
			if ($total > 0) {
				$data['ds'] = $orderList;
				$data['page_count'] = $pageCount;
			} else {
				$data['result'] = error(-1, '没有找到相应订单');
			}
			return $this->ajaxReturn($data);
		} else {			
			$order_list_key = $aa['state'].'_orders';
			$this->assign('state', $aa['state']);
			$this->assign($order_list_key, $orderList);
			$this->assign('test_order', $orderList);
			$this->assign('conds', $conds);
			$this->assign('page_count', $pageCount);
			
			return $this->showPage('order_center', 'line_order_center', 'line', '订单中心');
		}			
	}
	
	// 订单详情
	private function orderInfo($requestType, $aa) {
		if ($requestType == 'get') {
			$order = BackOrderHelp::getOrderInfo($aa);
			$fill = array('state'=>1,'line'=>1, 'batch'=>1, 'use_coupon'=>1, 'member'=>1, 'extra_cash'=>1, 'order_coupon'=>1);
			$order = BackOrderHelp::fillNewOrderInfo($order, $fill);
			$order['other_money'] = BackOrderHelp::getExtraMoney($aa);			
			$order['coupon_money'] = 0;
			if (!empty($order['use_coupons'])) {
				foreach ($order['use_coupons'] as $k=>$v) {
					$order['coupon_money'] += floatval($v['money']);
				}
			}
			$order['pay_money'] = BackOrderHelp::getOrderPaySumMoney($order['id'], $payCount, false);			
			$this->assign('order', $order);
			
			return $this->showPage('order_detail', 'line_order_detail', 'line', '订单详细');
		}
	}
	
	// 处理订单支付确认
	private function orderPayment($requestType, $aa) {
		if ($requestType == 'get') {
			$order = BackOrderHelp::getOrderInfo($aa);
			$fill = array('state'=>1,'line'=>1, 'batch'=>1, 'use_coupon'=>1, 'member'=>1, 'extra_cash'=>1, 'order_coupon'=>1);
			$order = BackOrderHelp::fillNewOrderInfo($order, $fill);
			
			// 计算订单总价
			$needPayMoney = BackOrderHelp::getOrderNeedPayMoney($order['id'], true);
			if (is_error($needPayMoney)) {
				return $this->showError('502', '订单确认错误', '核算订单总价错误');
			}
			$order['need_pay_money'] = $needPayMoney['need'];			
			// 已支付的钱
			$paidMoney = BackOrderHelp::getOrderPaySumMoney($order['id']);
			// 剩余要支付的钱
			$finalPayMoney = floatval($needPayMoney['need']) - floatval($paidMoney);
			$order['final_pay_money'] = $finalPayMoney;		
				
			$this->assign('order', $order);
			
			$couponConds = appendLogicExp('user_id', '=', $order['userid']);
			$couponConds = appendLogicExp('use', '=', '0', 'AND', $couponConds);
			$coupons = BackAccountHelp::getUserCoupon($couponConds, 'account_user');
			$this->assign('user_coupons', $coupons);
			
			return $this->showPage('order_payment', 'line_order_payment', 'line', '订单订单确认');
		}
	}
	
	// 处理订单支付
	private function orderPay($requestType, $aa) {
		if ($requestType == 'get') {
			// 登录判断
			MyHelp::getLoginAccount(true);
			
			if (empty($aa['id'])){
				$data['result'] = error(-1, '错误的订单编号');
				return $this->display('common/error');
			}
			$order = BackOrderHelp::getOrderInfo($aa['id']);
			if (is_error($order)) {
				return $this->display('common/error');
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
			
			// 计算要支付金额,此时计算的总金额要减去绑定的优惠券，因为当前已支付不包含只绑定未使用的优惠券
			$needPayMoney = BackOrderHelp::getOrderNeedPayMoney($order['id'], false, true);
			// 已支付的钱，包含已绑定并且使用的优惠券，因为上面要支付金额已经减过优惠券，所以这里不再计算在内
			$paidMoney = BackOrderHelp::getOrderPaySumMoney($order['id'], $payCount, false);
			// 存在支付记录不能再支付部分款
			$order['exist_pay_log'] = 0;
			if ($paidMoney > 0 || !empty($onlyPayAll)) {
				$order['exist_pay_log'] =  1;	
			}
			
			$order['paid_money'] = $paidMoney;
			// 剩余要支付的尾款
			$finalPayMoney = bcsub(floatval($needPayMoney['need']), floatval($paidMoney), 2);			
			$order['final_pay_money'] = $finalPayMoney;
			$this->assign('need_pay_money', $needPayMoney);
			$this->assign('order', $order);
			
			// 获取可用优惠券			
			$user = MyHelp::getLoginAccount(true);			
			$couponConds = appendLogicExp('user_id', '=', $user['id']);
			$couponConds = appendLogicExp('use', '!=', '1', 'AND', $couponConds);			
			$coupons = BackAccountHelp::getUserCoupon($couponConds);
			$this->assign('coupons', $coupons);				
			return $this->showPage('order_pay', 'line_order_pay', 'line', '订单订单支付');
		} else {
			// 登录判断
			$user = MyHelp::getLoginAccount(false);
			if (empty($user)) {
				$data['result'] = error(-1, '您还没有登录，请登录后再进行支付');
				return $this->ajaxReturn($data);
			}
			
			if (empty($aa['id'])){
				$data['aa'] = $aa;
				$data['result'] = error(-1, '错误的订单编号');
				return $this->ajaxReturn($data);
			}
			
			$order = BackOrderHelp::getOrderInfo($aa['id']);
			if (is_error($order)) {
				$data['result'] = error(-1, '订单不存在');
				return $this->ajaxReturn($data);
			}
			$order = BackOrderHelp::fillNewOrderInfo($order, array('line'=>true));
			if ($order['lineid_data_type'] === 'line') {
				// 支付前审核
				$checkPayParam['pay_type'] = $aa['pay_money_all'];
				$data['result'] = BackOrderHelp::checkOrderPay($order, $checkPayParam);
				if (error_ok($data['result']) === false) {
					return $this->ajaxReturn($data);
				}
			}
			
			// 计算要支付金额,此时计算的总金额要减去绑定的优惠券，因为当前已支付不包含只绑定未使用的优惠券
			$needPayMoney = BackOrderHelp::getOrderNeedPayMoney($order['id'], false, true);
			// 已支付的钱，包含已绑定并且使用的优惠券，因为上面要支付金额已经减过优惠券，所以这里不再计算在内
			$paidMoney = BackOrderHelp::getOrderPaySumMoney($order['id'], $payCount, false);
			// 剩余要支付的尾款
			$finalPayMoney = floatval($needPayMoney['need']) - floatval($paidMoney);			
			if ($aa['pay_money_all'] == 0) {
				$finalPayMoney = floatval($finalPayMoney) * 0.50;
			}
			
			// 使用优惠券
			if (!empty($aa['coupon_id'])) {
				// 获取并检测优惠券
				$couponObj = ModelBase::getInstance('user_coupon');
				$couponConds = appendLogicExp('id', '=', $aa['coupon_id']);
				$couponConds = appendLogicExp('user_id', '=', $order['userid'], 'AND', $couponConds);
				$coupons = BackAccountHelp::getUserCoupon($couponConds);
				if (empty($coupons)) {
					$data['result'] = error(-1, '您的优惠券存在问题,请咨询客服人员后再次使用');
					return $this->ajaxReturn($data);
				}
				
				// 支付金钱必须大于优惠券金额
				$coupon = $coupons[0];
				if ($finalPayMoney <= intval($coupon['money'])) {
					$data['result'] = error(-1, '您的优惠券存大于支付金额，不能使用优惠券');
					return $this->ajaxReturn($data);
				}
				
				// 查看该订单是否已使用过优惠券
				$couponMoney = BackOrderHelp::getOrderUserCoupon($order['id']);
				if ($couponMoney > 0) {
					$data['result'] = error(-1, '该订单您已经使用过优惠券了，不能再次使用');
					return $this->ajaxReturn($data);
				}
				
				$finalPayMoney = $finalPayMoney - intval($coupon['money']);
				
				$ds['use'] = 1;
				$ds['use_time'] = fmtNowDateTime();
				$ds['order_id'] = $order['id'];
				$data['coupon_result'] = $couponObj->modify($ds, appendLogicExp('id', '=', $coupon['id']));
				if (error_ok($data['coupon_result']) === false) {
					$data['result'] = error(-1, '使用优惠券错误');
 					return $this->ajaxReturn($data);
				}
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
//			$count = BackOrderHelp::getOrderPayCount($order['id'], 2);
//			$orderSN = $order['order_sn'].'-'.intval($count+1);
			$orderSN = $order['order_sn'].'-'.substr(uniqid(rand()),-1);
			$orderTitle = $order['lineid_title'];
			if (mb_strlen($order['lineid_title'], 'utf8') > 20) {
				$orderTitle = mb_substr($order['lineid_title'], 0, 20, 'utf8');
				$orderTitle .= '...';
			}
			$orderSubheading = $order['lineid_subheading'];
			$data['title'] = $orderTitle;
			$data['subheading'] = $orderSubheading;
			
			// 在此调用支付接口
			if ($aa['pay_type'] == 'wangyin') {
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
					$aa['pay_channel']
					);
			} else {									
				if ($aa['pay_channel'] == 'zhifubao') {
					// 支付宝
					$productUrl = 'http://kllife.com'.U('line/info').'/id/'.$order['lineid'];
					$successUrl = 'http://kllife'.U('line/alipayresult');
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
			} else if ($type == 'find_batch') {
				$this->findBatchByDate();
			} else if ($type == 'find_taocan_batch') {
				$taocanIds = I('post.taocan_ids',false);
				$batchId = I('post.batch_id', false);
				if (empty($taocanIds) && empty($batchId)) {
					$this->findBatchByDate();
				} else {
					$this->findBatchByTaocan();
				}
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
	
	private function findBatchByDate() {
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
			$ds[$tk] = $tv;
			
			//截取开始时间、结束时间
			$start_date = explode(' ', $tv['start_time']);
			$ds[$tk]['start_date_show'] = $start_date[0]; 
			$end_date = explode(' ', $tv['end_time']);
			$ds[$tk]['end_date_show'] = $end_date[0];
		}				
		$data['result'] = error(0, '');
		$data['taocan_ids'] = array_values($taocanIdList);
		$data['batch_ids'] = $batchIdList;
		$data['ds'] = $ds;
		$data['total'] = $total;
		$data['line_id'] = $lineId;
		return $this->ajaxReturn($data);
	}
	
	// 处理进入订单中心
	private function ordercenterAction() {
		$user = MyHelp::getLoginAccount(false);
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
		
		$orderList = BackOrderHelp::getNewOrderList($conds, $startIndex, ORDER_CENTER_LIST_SHOW_COUNT, $total, $sort);
		$fill = array('state'=>1,'line'=>1,'batch'=>1, 'money'=>1);
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
			$orderList[$ok] = $ov;
		}
		
		$pageCount = intval($total / ORDER_CENTER_LIST_SHOW_COUNT);
		if (intval($total % ORDER_CENTER_LIST_SHOW_COUNT) == 1) {
			$pageCount += 1;
		}
		
		if ($requestType == 'post') {
			$data['result'] = error(0, '');
			if ($total > 0) {
				$data['ds'] = $orderList;
				$data['page_count'] = $pageCount;
			} else {
				$data['result'] = error(-1, '没有找到相应订单');
			}
			return $this->ajaxReturn($data);
		} else {			
			$order_list_key = $aa['state'].'_orders';
			$this->assign('state', $aa['state']);
			$this->assign($order_list_key, $orderList);
			$this->assign('test_order', $orderList);
			$this->assign('conds', $conds);
			$this->assign('page_count', $pageCount);			
			return $this->showPage('order_center', 'line_order_center', 'line', '订单中心');
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
		
		$order = BackOrderHelp::getOrderInfo(appendLogicExp('id', '=', $aa['id']));
		if (is_error($order) === true) {
			return $this->display('Common/error');
		}
		$this->assign('trans_no', $transNo);
		$this->assign('order_sn', $order_sn);
		$this->assign('money', $money);	
		$this->assign('state', $state);
		$this->assign('err_msg', $errMsg);
		$this->showPage('pay_result', 'line_pay_result', 'pay_result', '支付结果');	
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
			$thisurl = str_replace('http://kllife.com/phone/index.php?s=/phone/line/xianBankResult/?', 'http://kllife.com/phone/index.php?s=/phone/line/xianBankResult/?PAY_TYPE=xianBank&', $thisurl);		
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
		$this->showPage('pay_result', 'line_pay_result', 'pay_result', '支付结果');	
	}
	
	public function wxpayresultAction() {
		$payObj = ModelBase::getInstance('pay_log', 'xz_');
		if (IS_POST) {
			$order_sn = I('post.order_sn', false);
			if (empty($order_sn)) {
				$data['result'] = error(-1, '错误订单编号');
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
			$data['sql'] = $payObj->getLastSql();
			$data['pay'] = $pay;
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
			$id = I('get.id', false);
			if (empty($id)) {
				return $this->showError('502', '专题错误', '专题的内容不存在或者已经下架');	
			}
//			
//			$hotLines = S('pc_hot_line_set');
//			if (empty($hotLines) || MyHelp::checkConfigOverdue('pc_home_index', $hotLines['config_update_time']) === true) {
//				$conds = appendLogicExp('type', '=', 'pc_home_index');
//				$conds = appendLogicExp('key', 'LIKE', 'hot_line_%', 'AND', $conds);
//				$hotLines = MyHelp::getSet($conds, 0, 0, $total, array('sort'=>'asc'));
//				$hotLines['config_update_time'] = MyHelp::getConfigUpdateTime('pc_home_index');
//				S('pc_hot_line_set', $hotLines, 0);
//			}
//			$this->assign('set', $hotLines);

			
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
			$this->showPage('subject', 'line_subject', 'subject', '产品专题');			
		}
	}
	
	// 定制游
	public function bookAction() {
		if (IS_POST) {
			$data['result'] = BackTeamHelp::createTeamGroup($_POST, $teamId);
			return $this->ajaxReturn($data);
		} else {			
			$type = I('get.type', false);
			if (empty($type)) {
				$this->showPage('private_book', 'book_line', 'line', '私人订制');		
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
				
				$this->showPage('private_book1', 'book_line', 'line', '私人订制');
			}
		}
	}
	
}

?>
