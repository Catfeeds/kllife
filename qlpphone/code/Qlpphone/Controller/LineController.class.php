<?php
namespace Qlpphone\Controller;
use Think\Controller;
use Core\Model\MyHelp;
use Core\Model\ModelBase;
use Core\Model\BackLineHelp;
use Core\Model\BackOrderHelp;
use Core\Model\BackAccountHelp;
use Core\Model\BackReviewHelp;
use Core\Model\MsgHelp;

define('LINE_PAGE_SHOW_COUNT', 5);
define('LINE_ARTICLE_LIST_SHOW_COUNT', 16);

class LineController extends QlpBaseController {
	
	// 获取Tab线路产品
	private function findConfig($aa) {
		if (!empty($aa['type'])) {
			$conds = appendLogicExp('type', '=', $aa['type']);
		}
		
		if (!empty($aa['key'])){
			$op = empty($aa['op']) ? '=' : $aa['op'];
			$conds = appendLogicExp('key', $op, $aa['key'], 'AND', $conds);
		}
		
		if (!empty($aa['station_id'])){
			$conds = appendLogicExp('station_id', $aa['station_id'], 'AND', $conds);
		}
		
		$data['ds'] = MyHelp::getSet($conds);
		return $this->ajaxReturn($data);		
	}
	
	// 查找线路
	public function findAction(){
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'find_config') {
				$this->findConfig($_POST);
			} else {
				$data['result'] = error(-1, '错误的处理类型');
				return $this->ajaxReturn($data);	
			}			
		} else {
			$this->showError('404', '请求错误', '服务器拒绝请求访问', '访问服务器错误');
		}
	}
		
	// 查询线路
	public function listAction(){
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
		
		$startIndex = $page * LINE_PAGE_SHOW_COUNT;
		
		$conds = appendLogicExp('qinglvpai', '>', '0', 'AND', $conds);	
		$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
		$conds = appendLogicExp('online', '=', '1', 'AND', $conds);
		$sort = array('recommend'=>'desc', 'hot'=>'desc','leader_recommend'=>'desc','create_time'=>'desc', 'sort'=>'asc');
		$find = array('batch'=>true);
		$ds = BackLineHelp::getLineList($conds, $startIndex, LINE_PAGE_SHOW_COUNT, $total, $sort, $find);
		
		$pageCount = intval($total / LINE_PAGE_SHOW_COUNT);
		if (intval($total % LINE_PAGE_SHOW_COUNT) > 0) {
			$pageCount += 1;
		}
		
		if (IS_POST) {
			$data['conds'] = $conds;
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
			$this->showPage('list', 'line_list', 'line', '旅拍线路-新旅拍');
		}
	}

	// 产品列表展示
	public function slowlyAction() {
		if (IS_POST) {
			$page = I('post.page', 0);	
			$cdsstr = I('post.cds', false);
			$sortstr = I('post.sorts', false);
		} else {
			$page = I('get.page', 0);	
			$cdsstr = I('get.cds', false);						
			$sortstr = I('get.sorts', false);
		}	
		$startIndex = $page * LINE_PAGE_SHOW_COUNT;
		
		if (!empty($cdsstr)) {
			$cdList = explode('|',$cdsstr);
			for($i = 0; $i < count($cdList); $i+=2){
				$conds = appendLogicExp($cdList[$i], 'LIKE', '%'.$cdList[$i+1].'%', 'AND', $conds);
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
		
		$conds = appendLogicExp('qinglvpai', '<', '2', 'AND', $conds);	
		$conds = appendLogicExp('online', '=', '1', 'AND', $conds);
		$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
		$themeConds = appendLogicExp('theme_type', 'LIKE', '%小团慢旅行%', 'OR');
		$themeConds = appendLogicExp('theme_type', 'LIKE', '%摄影游%', 'OR', $themeConds);
		$conds = appendLogicExp('theme_type', '=', $themeConds, 'AND', $conds);
		$find = array('batch'=>true);		
		$ds = BackLineHelp::getLineList($conds, $startIndex, LINE_PAGE_SHOW_COUNT, $total, $sorts, $find);
		$pageCount = intval($total / LINE_PAGE_SHOW_COUNT);
		if ($total % LINE_PAGE_SHOW_COUNT > 0) {
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
			$this->showPage('main_list', 'line_main_list', 'line', '慢旅行线路-新旅拍');
		}
	}
	
	// 线路详情
	public function infoAction() {
		$id = I('get.id', false);
		if (empty($id)) {
			return $this->showError('404', '请求错误', '服务器拒绝请求访问', '访问服务器错误');
		}
		
		$line = BackLineHelp::getLine(appendLogicExp('id', '=', $id));
		if (empty($line)) {
			return $this->showError('404', '产品不存在', '线路未上架', '该线路可能已经下架或者不存在');
		}
			
		$find = array(
			'phone_point'=>true,
			'travel'=>true,
			'scenery'=>true,
			'offer'=>true,
			'article'=>array('content'=>true)
		);
		$line = BackLineHelp::getLine(appendLogicExp('id', '=', $id), $find);
		if ($line['online'] == '0' || $line['invalid'] == '1') {
			return $this->showError('502', '线路错误', '线路未上架', '该线路可能已经下架或者不存在');
		}
		$batchConds = appendLogicExp('line_id', '=', $line['id']);
		$batchConds = appendLogicExp('use_state', 'NOT LIKE', '%line_batch_use_forbid%', 'AND', $batchConds);
		$line['batchs'] = BackLineHelp::getBatchList($batchConds, 0, 0, $total, array('start_time'=>'asc'));
		$this->assign('line', $line);
		
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
		
		// 下单前约束检查
		$ds = array('lineid'=>$line['id'], 'new_line'=>1, 'new_order'=>1);
		$check = BackOrderHelp::checkOrderCreate($ds,true);
		$this->assign('check', $check);
	
		// 最新预定的信息
		$conds = appendLogicExp('lineid', '=', $id);
		$conds = appendLogicExp('new_line', '=', '1', 'AND', $conds);
		$orders = BackOrderHelp::getNewOrderList($conds,0,0,$total,array('addtime'=>'desc'),$out);
		$fill = array('state'=>true,'batch'=>true);
		$orders = BackOrderHelp::fillNewOrderInfo($orders,$fill);
		foreach ($orders as $ok=>$ov) {
			$ov['member_total_count'] = intval($ov['male'])+intval($ov['woman'])+intval($ov['child']);
			if (empty($orderList[$ov['hdid']])) {
				$showData['hdid_show_text'] = $ov['hdid_show_text'];
				$showData['data'] = array($ov);
			} else {
				$showData = $orderList[$ov['hdid']];						
				array_push($showData['data'], $ov);
			}			
			$orderList[$ov['hdid']] = $showData;		
		}
		
		$order_count = 0;
		if (!empty($orderList)) {
			$order_count = count($orders);
			$this->assign('orders', $orderList);	
		}
		$this->assign('order_count', $order_count);
		
		$this->assign('out', $out);
				
		// 点击量
		$lineObj = ModelBase::getInstance('line');
		$lineObj->fieldAddAndSub(appendLogicExp('id', '=', $line['id']), 'click_count', 1, true);	
		
		$this->showPage('content', 'line_content', 'line', '旅拍线路-新旅拍');
	}
	
	// 线路详情
	public function contentAction() {
		$id = I('get.id', false);
		if (empty($id)) {
			return $this->showError('404', '参数错误', '参数不足，不能找到相关信息', '不能找到相关信息');
		}
		
		$line = BackLineHelp::getLine(appendLogicExp('id', '=', $id));
		if (empty($line)) {
			return $this->showError('404', '产品不存在', '线路未上架', '该线路可能已经下架或者不存在');
		}
			
		$find = array(
			'phone_point'=>true,
			'travel'=>true,
			'scenery'=>true,
			'offer'=>true,
			'article'=>array('content'=>true)
		);
		$line = BackLineHelp::getLine(appendLogicExp('id', '=', $id), $find);
		if ($line['online'] == '0' || $line['invalid'] == '1') {
			return $this->showError('502', '线路错误', '线路未上架', '该线路可能已经下架或者不存在');
		}
		$batchConds = appendLogicExp('line_id', '=', $line['id']);
		$batchConds = appendLogicExp('use_state', 'NOT LIKE', '%line_batch_use_forbid%', 'AND', $batchConds);
		$line['batchs'] = BackLineHelp::getBatchList($batchConds, 0, 0, $total, array('start_time'=>'asc'));
		$this->assign('line', $line);
		
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
		
		// 下单前约束检查
		$ds = array('lineid'=>$line['id'], 'new_line'=>1, 'new_order'=>1);
		$check = BackOrderHelp::checkOrderCreate($ds,true);
		$this->assign('check', $check);
	
		// 最新预定的信息
		$conds = appendLogicExp('lineid', '=', $id);
		$conds = appendLogicExp('new_line', '=', '1', 'AND', $conds);
		$orders = BackOrderHelp::getNewOrderList($conds,0,0,$total,array('addtime'=>'desc'),$out);
		$fill = array('state'=>true,'batch'=>true);
		$orders = BackOrderHelp::fillNewOrderInfo($orders,$fill);
		foreach ($orders as $ok=>$ov) {
			$ov['member_total_count'] = intval($ov['male'])+intval($ov['woman'])+intval($ov['child']);
			if (empty($orderList[$ov['hdid']])) {
				$showData['hdid_show_text'] = $ov['hdid_show_text'];
				$showData['data'] = array($ov);
			} else {
				$showData = $orderList[$ov['hdid']];						
				array_push($showData['data'], $ov);
			}			
			$orderList[$ov['hdid']] = $showData;		
		}
		
		$order_count = 0;
		if (!empty($orderList)) {
			$order_count = count($orders);
			$this->assign('orders', $orderList);	
		}
		$this->assign('order_count', $order_count);
		
		$this->assign('out', $out);
				
		// 点击量
		$lineObj = ModelBase::getInstance('line');
		$lineObj->fieldAddAndSub(appendLogicExp('id', '=', $line['id']), 'click_count', 1, true);
		
		$this->showPage('main_content', 'line_main_content', 'line', '慢旅行线路-新旅拍');
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
		
		$result = BackOrderHelp::calcOrderMoney($aa['batch_id'], 0, intval($aa['adult_count']), intval($aa['child_count']), $offer);
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
			$line = BackLineHelp::getLine(appendLogicExp('id', '=', $aa['id']), $find);
			$batchConds = appendLogicExp('line_id', '=', $line['id']);
			$batchConds = appendLogicExp('use_state', 'NOT LIKE', '%line_batch_use_forbid%', 'AND', $batchConds);
			$line['batchs'] = BackLineHelp::getBatchList($batchConds, 0, 0, $total, array('start_time'=>'asc'));
			$batchList = array();
			$batchIdList = array();
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
			$this->assign('member_types', json_encode($memberTypes));
			
			
			$certs = array();
			$certTypes = BackOrderHelp::getMemberCertTypes();
			foreach($certTypes as $ck=>$cv) {
				array_push($certs, array('id'=>$cv['id'],'text'=>$cv['type_desc']));
			}
			$this->assign('certs', json_encode($certs));
				
			// 分销用户
			$duid = I('get.duid', false);
			if (!empty($duid)) {
				$this->assign('duid', $duid);
			}	
			
			$this->_initTemplateInfo();
			$this->showPage('order_create', 'line_order_create', 'line', '订单创建-新旅拍');
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
					$user_data['password'] = $aa['123456'];
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
			// 获取线路
			$line = BackLineHelp::getLine(appendLogicExp('id', '=', $ds['lineid']));
			if (empty($line)) {
				$data['result'] = error(-1, '订单线路存在问题，不能生成订单:'.$ds['lineid']);
				return $this->ajaxReturn($data);
			}
			$ds['station_id'] = $line['station_data'][0]['id'];
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
	//					if (error_ok($result)) {
	//						$data['member'.$mk.'_result'] = error(-1, $result['message'].'/'.$data['member_result']['message']);
	//					}
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
			
			return $this->showPage('order_center', 'line_order_center', 'line', '订单中心-新旅拍');
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
			
			return $this->showPage('order_detail', 'line_order_detail', 'line', '订单详细-新旅拍');
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
			
			return $this->showPage('order_payment', 'line_order_payment', 'line', '订单确认-新旅拍');
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
			return $this->showPage('order_pay', 'line_order_pay', 'line', '订单支付-新旅拍');
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
					$productUrl = 'http://m.xinlvpai'.U('line/info').'/id/'.$order['lineid'];
					$successUrl = 'http://m.xinlvpai'.U('line/alipayresult');
					$notifyUrl = 'http://kllife.com/inf/alipay.php';
					$data['html'] = MsgHelp::Alipay(
						$orderSN, 
						$orderTitle, 
						$finalPayMoney, 
						$orderSubheading, 
						$productUrl,
						$notifyUrl,
						$successUrl);
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
			}
			return $this->orderCenter('get', $_GET);
		}
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
			return $this->showError(501, '订单错误', '未能找到订单编号为['.$order_sn.']的支付记录!');
		}
		$this->assign('trans_no', $transNo);
		$this->assign('order_sn', $order_sn);
		$this->assign('money', $money);	
		$this->assign('state', $state);
		$this->assign('err_msg', $errMsg);
		$this->showPage('pay_result', 'line_pay_result', 'pay_result', '支付结果-新旅拍');	
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
			
			$this->assign('trans_no', $pay['TransNo']);
			$this->assign('order_sn', $pay['order_sn']);
			$this->assign('money', $pay['TransAmount']);	
			$this->assign('state', 1);			
			$this->showPage('pay_result', 'line_pay_result', 'pay_result', '支付结果-新旅拍');	
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