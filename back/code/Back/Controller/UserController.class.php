<?php

namespace Back\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackAccountHelp;
use Core\Model\BackOrderHelp;

define('USER_CENTER_SHOW_PAGE_SIZE', 20);
define('DISTRIBUTE_USER_SHOW_PAGE_SIZE', 20);
define('FIND_USER_SHOW_COUNT', 20);
define('COUPON_SHOW_COUNT', 20);

class UserController extends BackBaseController {
	
	protected function _initialize(){		
		$this->page_title = '用户中心';
		$this->content_title_show = 0;
	}
	
	// 用户列表
	private function listUser($requestType, $aa) {				
		if ($requestType == 'post') {
			$cdsstr = I('post.cdsstr', '');
			$pageIndex = I('post.page', 0);
		} else {
			$cdsstr = '';
			$pageIndex = 0;
		}
		
		$result = MyHelp::getPageList('user', $cdsstr, $pageIndex, USER_CENTER_SHOW_PAGE_SIZE, array('blacklist'=>'desc', 'forbidden'=>'desc'), 4, $out);
		$ds = $result['ds'];
		$pageCount = $result['page_count'];
		
		if ($requestType == 'post') {
			$data['ds'] = $ds;
			$data['page_count'] = $pageCount;
			$data['result'] = error(0, '');						
			return $this->ajaxReturn($data);
		} else {
			$this->assign('users', $ds);
			$this->assign('page_count', $pageCount);
			
			$this->assign('modal_data_edit', true);
			$this->_initBaseInfo('user', 'user_center', '用户中心', '用户列表', '这里你可以对用户信息进行修改、禁用、拉黑等操作');
			$this->display('center');	
		}
	}
	
	// 修改用户
	private function modifyUser($aa) {
		if (empty($aa['id'])) {
			$data['result'] = error(-1, '参数错误，用户编号有误');
			$this->ajaxReturn($data);
		}
		
		$userObj = ModelBase::getInstance('user');
		$colNams = $userObj->getUserDefine(ModelBase::DF_COL_NAMES);
		
		$ds = coll_elements_giveup($colNams, $aa);		
		if (!empty($ds['password'])) {
			$ds['salt'] = substr(uniqid(rand()), -6);
			$ds['password'] = md5(md5($ds['password']).$ds['salt']);
		}
		
		$data['result'] = $userObj->modify($ds, appendLogicExp('id', '=', $aa['id']));
		return $this->ajaxReturn($data);
	}	
	
	// 用户中心
	public function centerAction(){
		if (IS_POST) {
			$type = I('post.op_type', false);			
			if ($type == 'list') {
				$this->listUser('post', $_POST);
			} else if($type == 'modify') {
				$this->modifyUser($_POST);
			} else {
				$data['result'] = error(-1, '错误的操作类型');
				return $this->ajaxReturn($data);
 			}
		} else {
			$this->listUser('get', $_GET);
		}
	}	
	
	// 显示优惠券
	private function showCouponInfo() {
		if (IS_POST) {
			$page = I('post.page', 0);
			$cdsstr = I('post.cds', '');
			$cdType = I('post.cd_type', 4);
		} else {
			$page = I('get.p', 0);
		}
		
		$conds = MyHelp::getCondsByStr($cdsstr, $cdType);
		$pageIndex = $pageIndex * COUPON_SHOW_COUNT;		
		$coupons = BackAccountHelp::getUserCoupon($conds, $pageIndex, COUPON_SHOW_COUNT, $total, array('send_time'), array('user'=>true));
		
		$pageCount = $total / COUPON_SHOW_COUNT;
		if ($total % COUPON_SHOW_COUNT > 0) {
			$pageCount ++;
		}
		
		if (IS_POST) {
			$data['ds'] = $coupons;
			$data['page_count'] = $pageCount;
			$this->ajaxReturn($data);
		} else {		
			$this->assign('coupons', $coupons);
			$this->assign('page_count', $pageCount);
			$this->showPage('coupon', 'user_coupon', 'user', '优惠券', '用户优惠券');
		}
	}
	
	// 查询用户
	private function findUser($aa) {
		$pageIndex = empty($aa['page']) ? 0 : $aa['page'];
		$startIndex = $pageIndex * FIND_USER_SHOW_COUNT;
		
		// 查询条件		
		if (!empty($aa['cd_type']) && !empty($aa['cds'])) {
			$conds = MyHelp::getCondsByStr($aa['cds'], $aa['cd_type']);
			if (empty($conds)) {
				$data['result'] = error(-1, '查询用户的条件不足');
				return $this->ajaxReturn($data);
			}
		}
		
		$sort = array('create_time'=>'desc');
		$accounts = BackAccountHelp::getAccountList('account_user', $conds, $startIndex, FIND_USER_SHOW_COUNT, $total, $sort, true);
				
		// 页数
		$pageCount = intval($total / FIND_USER_SHOW_COUNT);
		if (intval($total % FIND_USER_SHOW_COUNT) > 0) {
			$pageCount += 1;
		}
		
		$data['ds'] = $accounts;
		$data['page_count'] = $pageCount;
		$data['result'] = error(0,'');
		$this->ajaxReturn($data);
	}
	
	// 发放优惠券
	private function sendCoupon($aa) {
		$loginAcct = MyHelp::getLoginAccount(false);
		if (is_error($loginAcct) === true) {
			$data['jumpUrl'] = UNLOGIN_URL;
			$data['result'] = error(-1, '您还未登录不能发放优惠券');
			return $this->ajaxReturn($data);
		}
		
		if (empty($aa['type']) || empty($aa['money'])) {
			$data['result'] = error(-1, '优惠券的类型和金额不能为空');
			return $this->ajaxReturn($data);
		}		
		
		if (empty($aa['valid_time']) || empty($aa['invalid_time'])) {
			$data['result'] = error(-1, '有效时间与结束时间不能为空');
			return $this->ajaxReturn($data);
		}
		
		$validTime = strtotime($aa['valid_time']);
		$invalidTime = strtotime($aa['invalid_time']);
		if ($invalidTime <= $validTime) {
			$data['result'] = error(-1, '结束时间必须大于有效时间');
			return $this->ajaxReturn($data);
		}		
		$validSecond = $invalidTime-$validTime;
		
		if (empty($aa['accounts'])) {
			$data['result'] = error(-1, '您还没有选择发送优惠券的用户');
			return $this->ajaxReturn($data);
		}
		$accounts = $aa['accounts'];
		
		$acctType = BackAccountHelp::AccountTypeKey2Value('account_admin', true);
		$sendAdmin = array(
			'id'=>$loginAcct['id'],
			'name'=>$loginAcct['account'],
			'nickname'=>$loginAcct['nickname'],
			'show_name'=>$loginAcct['show_name'],
			'acct_type'=>$acctType,
		);
		$sendadminstr = my_json_encode($sendAdmin);
		$overlying = empty($aa['overlying']) ? 0 : 1;
		$forever = empty($aa['forever']) ? 0 : 1;
		
		$ds = array();
		$useCouponObj = ModelBase::getInstance('user_coupon');		
		foreach ($accounts as $ak=>$acct) {
			$userCoupon['user_id'] = $acct['id'];
			$userCoupon['type'] = $aa['type'];
			$userCoupon['money'] = $aa['money'];
			$userCoupon['overlying'] = $overlying;
			$userCoupon['forever'] = $forever;
			$userCoupon['send_acct'] = $sendadminstr;
			$userCoupon['send_time'] = fmtNowDateTime();
			$userCoupon['valid_time'] = $aa['valid_time'];
			$userCoupon['valid_second'] = $validSecond;
			$userCoupon['use'] = 0;
			$result = $useCouponObj->create($userCoupon, $userCouponId);
			if (error_ok($result) == false) {
				if (!empty($failIds)) {
					$failIds .= ',';
				} 
				$failIds .= '[优惠券编号:'.$userCouponId.',用户类型编号:'.$acct['type_id'].',用户编号:'.$acct['id'].',result:'.$result['message'].']<br />';
			} else {
				if (!empty($successIds)) {
					$successIds .= ',';
				} 
				$successIds .= '[优惠券编号:'.$userCouponId.',用户类型编号:'.$acct['type_id'].',用户编号:'.$acct['id'].']<br />';
			}
		}
		
		if (empty($failIds)) {
			$data['result'] = error(0, '恭喜你，所有的优惠券都发送成功，具体信息如下:<br />'.$successIds);
		} else {
			$data['result'] = error(-1, '发送优惠券成功的用户如下:<br />'.$successIds.'发送优惠券失败的用户如下:<br />'.$failIds);
		}		
		return $this->ajaxReturn($data);
	}
	
	// 删除优惠券
	private function deleteCoupon() {
		$couponId = I('post.id', false);
		if (empty($couponId)) {
			$data['result'] = error(-1, '错误的删除参数');
			return $this->ajaxReturn($data);
		}
		
		$couponObj = ModelBase::getInstance('user_coupon');
		$result = $couponObj->modify(array('invalid'=>1), appendLogicExp('id', '=', $couponId));
		if (error_ok($result) === false) {
			$data['result'] = error(-1, '移除优惠券失败,ERR:'.$result['message']);
		} else {
			$data['result'] = error(0, '移除优惠券成功');
		}
		return $this->ajaxReturn($data);		
	}
	
	// 优惠券  
	public function couponAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'coupon_list') {
				$this->showCouponInfo();
			} else if ($type == 'find_user') {
				$this->findUser($_POST);
			} else if ($type == 'send_coupon') {
				$this->sendCoupon($_POST);
			} else if ($type == 'delete_coupon') {
				$this->deleteCoupon();
			} else {
				$data['result'] = error(-1, '错误的操作类型');
				return $this->ajaxReturn($data);
			}
		} else {			
			$this->showCouponInfo();
		}
	}
	
	// 查找分销用户
	private function findDistributeUser($aa) {
		if (empty($aa['id'])) {
			$data['result'] = error(-1, '查询的条件不足');
			return $this->ajaxReturn($data);
		}
		
		$fxUserObj = ModelBase::getInstance('fx_user');
		$fxUser = $fxUserObj->getOne(appendLogicExp('id', '=', $aa['id']));
		if (!empty($fxUser)) {
			if (!empty($fxUser['type_id'])) {
				$fxUser['type_id_data'] = MyHelp::TypeDataKey2Value($fxUser['type_id']);	
			}
			$data['ds'] = $fxUser;			
		} else {
			$data['result'] = error('没有找到用户信息');
		}
		return $this->ajaxReturn($data);
	}
	
	// 显示所有分销用户
	private function listDistributeUser($requestType) {				
		if ($requestType == 'post') {
			$cdsstr = I('post.cdsstr', '');
			$pageIndex = I('post.page', 0);
		} else {
			$cdsstr = '';
			$pageIndex = 0;
		}
		
		$result = MyHelp::getPageList('fx_user', $cdsstr, $pageIndex, DISTRIBUTE_USER_SHOW_PAGE_SIZE, array('forbidden'=>'desc'), 4, $out);
		$ds = $result['ds'];
		$pageCount = $result['page_count'];
		
		foreach($ds as $dk=>$dv) {
			$dv['type_id_data'] = MyHelp::TypeDataKey2Value($dv['type_id'],true);
			$dv['order_complated'] = 0;
			$dv['order_uncomplated'] = 0;
			$dv['member_adult_complated'] = 0;
			$dv['member_child_complated'] = 0;
			$dv['member_adult_uncomplated'] = 0;
			$dv['member_child_uncomplated'] = 0;
			$unincomeOrderCount = 0;
			$fxOrderObj = ModelBase::getInstance('fx_order');
			$fxOrders = $fxOrderObj->getAll(appendLogicExp('user_id', '=', $dv['id']));
			if (!empty($fxOrders)) {
				foreach ($fxOrders as $fok=>$fov) {
					if (!empty($idstr)) {
						$idstr .= ',';
					}
					$idstr .= $fov['order_id'];
				}
				
				if (!empty($idstr)) {
					$orders = BackOrderHelp::getNewOrderList(appendLogicExp('id', 'IN', '('.$idstr.')'));
					if (!empty($orders)) {
						$complateState = BackOrderHelp::OrderStateKey2Value('complated', false);
						if (is_error($complateState) === false) {
							foreach ($orders as $ok=>$ov) {
								$adultCount = intval($ov['male']) + intval($ov['child']);
								if (intval($orders['zhuangtai']) === intval($complateState)) {									
									$dv['member_adult_complated'] = intval($dv['member_adult_complated']) + intval($adultCount);
									$dv['member_child_complated'] = intval($dv['member_child_complated']) + intval($ov['child']);
									$dv['order_complated'] ++;
								} else {
									$dv['member_adult_uncomplated'] = intval($dv['member_adult_uncomplated']) + intval($adultCount);
									$dv['member_child_uncomplated'] = intval($dv['member_child_uncomplated']) + intval($ov['child']);
									$dv['order_uncomplated'] ++;
								}
							}
						}
					}		
				}
			}
			$ds[$dk] = $dv;
		}
		
		if ($requestType == 'post') {
			$data['out'] = $out;
			$data['ds'] = $ds;
			$data['page_count'] = $pageCount;
			$data['result'] = error(0, '');						
			return $this->ajaxReturn($data);
		} else {
			$this->assign('users', $ds);
			$this->assign('page_count', $pageCount);
			
			$userType = MyHelp::getTypeData('distribute_user');
			$this->assign('user_types', $userType);
			
			$this->assign('modal_data_edit', true);
			$this->_initBaseInfo('user', 'user_distribute', '分销用户', '用户列表', '这里你可以对分销用户信息进行修改、禁用、删除等操作');
			$this->display('distribute');	
		}
	}
	
	// 修改用户
	private function modifyDistributeUser($aa) {
		if (empty($aa['id'])) {
			$data['result'] = error(-1, '参数错误，用户编号有误');
			$this->ajaxReturn($data);
		}
		
		$userObj = ModelBase::getInstance('fx_user');
		$colNams = $userObj->getUserDefine(ModelBase::DF_COL_NAMES);
		
		$ds = coll_elements_giveup($colNams, $aa);		
		if (!empty($ds['password'])) {
			$ds['salt'] = substr(uniqid(rand()), -6);
			$ds['password'] = md5(md5($ds['password']).$ds['salt']);
		}
		
		$data['result'] = $userObj->modify($ds, appendLogicExp('id', '=', $aa['id']));
		return $this->ajaxReturn($data);
	}
	
	// 保存分销用户
	private function saveDistributeUser($aa) {		
		$fxUserObj = ModelBase::getInstance('fx_user');
		$colNams = $fxUserObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNams, $aa);
		
		if (empty($aa['id'])) {
			$data['type'] = 'create';
			$ds['salt'] = substr(uniqid(rand()), -6);
			$ds['password'] = md5(md5($ds['password']).$ds['salt']);
			$ds['forbidden'] = 0;
			$ds['create_time'] = fmtNowDateTime();
			$data['result'] = $fxUserObj->create($ds, $userId);
			if (error_ok($data['result']) === true) {
				$ds['id'] = $userId;
			}
		} else {
			$data['type'] = 'save';			
			if (!empty($ds['type_id'])) {
				$ds['type_id_data'] = MyHelp::TypeDataKey2Value($ds['type_id'], true);
			}
			$data['ds'] = $ds;
			unset($ds['id']);
			
			$fxUser = $fxUserObj->getOne(appendLogicExp('id', '=', $aa['id']));
			if (!empty($fxUser)) {
				if (empty($ds['password']) || $fxUser['password'] == $ds['password']) {
					unset($ds['password']);
				}
			}
			
			$data['result'] = $fxUserObj->modify($ds, appendLogicExp('id', '=', $aa['id']));
		}
		return $this->ajaxReturn($data);
	}
	
	// 删除分销用户
	private function deleteDistributeUser($aa) {
		if (empty($aa['id'])) {
			$data['result'] = error(-1, '参数错误，删除分销用户失败');
			$this->ajaxReturn($data);
		}
		
		$fxUserObj = ModelBase::getInstance('fx_user');
		$data['result'] = $fxUserObj->remove(appendLogicExp('id', '=', $aa['id']));
		return $this->ajaxReturn($data);
	}
	
	// 分销用户
	public function distributeAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'save') {
				$this->saveDistributeUser($_POST);
			} else if ($type == 'password') {
				$this->modifyDistributeUser($_POST);
			} else if ($type == 'delete') {
				$this->deleteDistributeUser($_POST);
			} else if ($type == 'find') {
				$this->findDistributeUser( $_POST);
			} else if ($type == 'list') {
				$this->listDistributeUser('post', $_POST);
			} else {
				$data['result'] = error(-1, '错误的操作类型');
				return $this->ajaxReturn($data);
			}
		} else {			
			$this->listDistributeUser('get', $_GET);
		}
	} 
}

?>