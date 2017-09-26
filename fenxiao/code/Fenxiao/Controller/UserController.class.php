<?php

namespace Fenxiao\Controller;
use Core\Model\ModelBase;
use Core\Model\BackAccountHelp;
use Core\Model\BackReviewHelp;
use Core\Model\MyHelp;

class UserController extends FxBaseController {
		
	// 客户登录
	public function loginAction() {    
		if (IS_POST) {
			$userObj = ModelBase::getInstance('fx_user');		
			$account = I('post.acct', false);
			if (!empty($account)) {
				$conds = appendLogicExp('phone', '=', $account);	
				$user = BackAccountHelp::getAccount('account_distribute', $conds);
				if (is_error($user) === true) {
					$conds = appendLogicExp('email', '=', $account);
					$user = BackAccountHelp::getAccount('account_distribute', $conds);
					if (is_error($user) === true) {
						$conds = appendLogicExp('username', '=', $account);	
						$user = BackAccountHelp::getAccount('account_distribute', $conds);
					}
				}
			} else {
				$data['result'] = error(-1, '登录账号信息不能为空');
				return $this->ajaxReturn($data);
			}
			
			if (is_error($user) === true) {
				$data['result'] = error(-2, '查无次登录账户，请再次确认后登录');
				return $this->ajaxReturn($data);
			}
			$data['user'] = $user;
			
			$password = I('post.pwd', '');
			$cmpPassword = md5(md5($password).$user['salt']);
			$data['cmp_pwd'] = $cmpPassword;
			if ($cmpPassword === $user['password']) {
				$user['type_id_data'] = MyHelp::TypeDataKey2Value($user['type_id'],true);
				
				// 更新登录记录
				$ds['last_login_time'] = $user['login_time'];
				$ds['last_login_ip'] = $user['login_ip'];
				$ds['login_time'] = fmtNowDateTime();
				$ds['login_ip'] = get_user_ip();								
				$data['modify_result'] = $userObj->modify($ds, $conds);
						
				$user['last_login_time'] = $user['login_time'];
				$user['last_login_ip'] = $user['login_ip'];
				$user['login_time'] = $ds['login_time'];
				$user['login_ip'] = $ds['login_ip'];
				$accountType = BackAccountHelp::AccountTypeKey2Value('account_distribute');
				$user['account_type'] = $accountType;
												
				// 刷新入账订单
				$money = BackAccountHelp::refershFenxiaoOrder($user['id']);
				if (is_error($money) === false) {
					$user['money'] = $money;
				}
				
				// 写入缓存
				MyHelp::setLoginAccount($user);
				unset($user['password']);
				unset($user['salt']);	
				$data['user'] = $user;			
				$data['result'] = error(0, '登录成功');
				$data['jumpUrl'] = U('Index/welcome');
			} else {
				$data['result'] = error(-3, '登录账户或密码错误');
			}
			$this->ajaxReturn($data);			
		} else {
			$this->showPage('login', 'login', 'login', '登录', '分销系统');
		}
	}
	
	// 锁屏
	public function lockscreenAction() {
		$user = MyHelp::getLoginAccount(false);  
        	
		$this->page_title = '锁屏';
		$this->_initTemplateInfo();
         
        $forward = I('get.forward');
        if(empty($forward)) {
            $forward = U('Index/welcome');
        } else {
            $forward = base64_decode($forward);
        }
        $this->assign('jumpUrl', $forward);
        
        if(empty($user)) {
        	// 显示登录
			$this->showPage('login', '', '', '登录');
			
        } else {  
			if (IS_POST) {			
				$aa = $_POST;
				$cmpPassword = md5(md5($aa['pwd']).$user['salt']);
				if ($cmpPassword === $user['password']) {
					$data['result'] = error(0,'登陆成功!!!');
				} else {
					$data['result'] = error(-1,'登陆失败，密码错误!!!');
				}
				$this->ajaxReturn($data);
			} else {	
				// 显示锁屏
	        	$this->showPage('lockscreen', '', '', '锁屏');
			}
		}              
	}
	
	// 退出登录
	public function logoutAction() {
		MyHelp::logoutAccount();
		$this->showPage('login', '', '', '登录');
	}
	
	// 修改用户密码
	private function modifyPassword($aa) {		
		$user = MyHelp::getLoginAccount(false);
		if (is_error($user)) {
			$data['result'] = $user;
			$data['jumpUrl'] = U('user/login');
			return $this->ajaxReturn($data);
		}
			
		if (empty($aa['password']) || empty($aa['new_password'])) {
			$data['result'] = error(-1, '密码与新密码不能为空!!!');
			return $this->ajaxReturn($data);
		}
		
		$cmpPassword = md5(md5($aa['password']).$user['salt']);
		if ($cmpPassword !== $user['password']) {
			$data['result'] = error(-1, '原始密码输入错误，请检查后再次修改');
			return $this->ajaxReturn($data);
		}
		
		$ds['salt'] = substr(uniqid(rand()), -6);
		$ds['password'] = md5(md5($aa['new_password']).$ds['salt']);
		$userObj = ModelBase::getInstance('fx_user');
		$conds = appendLogicExp('id', '=', $user['id']);
		$data['result'] = $userObj->modify($ds, $conds);
		if (error_ok($data['result']) === true) {
			$fxUser = BackAccountHelp::getAccount('account_distribute', $conds);
			MyHelp::setLoginAccount($fxUser);
		}
		return $this->ajaxReturn($data);
	}
	
	// 修改手机号码
	private function modifyPhone($aa) {
		$user = MyHelp::getLoginAccount(false);
		if (is_error($user)) {
			$data['result'] = $user;
			$data['jumpUrl'] = U('user/login');
			return $this->ajaxReturn($data);
		}
		
		if (empty($aa['phone']) || empty($aa['code'])) {
			$data['result'] = error(-1, '手机号码与验证码不能为空!!!');
			return $this->ajaxReturn($data);
		}
		
		// 验证手机号码精确性
		if (check_mobile($aa['phone']) === false) {
			$data['result'] = error(-1, '手机号码有误');
			return $this->ajaxReturn($data);	
		}
		
		// 验证验证码的正确性
		$checkPhone = empty($user['phone']) ? $aa['phone'] : $user['phone'];
		$codeResult = MyHelp::checkSMS('fenxiao_modify_phone', $checkPhone, $aa['code']);
		if (error_ok($codeResult) === false) {
			$data['result'] = $codeResult;
			return $this->ajaxReturn($data);
		}
		
		$ds['phone'] = $aa['phone'];
		$userObj = ModelBase::getInstance('fx_user');
		$conds = appendLogicExp('id', '=', $user['id']);
		$data['result'] = $userObj->modify($ds, $conds);
		if (error_ok($data['result']) === true) {
			$fxUser = BackAccountHelp::getAccount('account_distribute', $conds);
			MyHelp::setLoginAccount($fxUser);
		}
		return $this->ajaxReturn($data);	
	}
	
	// 修改邮箱
	private function modifyEmail($aa) {
		$user = MyHelp::getLoginAccount(false);
		if (is_error($user)) {
			$data['result'] = $user;
			$data['jumpUrl'] = U('user/login');
			return $this->ajaxReturn($data);
		}
		
		if (empty($aa['email']) || empty($aa['code'])) {
			$data['result'] = error(-1, '邮箱与验证码不能为空!!!');
			return $this->ajaxReturn($data);
		}
		
		// 验证手机号码精确性
		if (check_email($aa['email']) === false) {
			$data['result'] = error(-1, '邮箱有误');
			return $this->ajaxReturn($data);	
		}
		
		// 验证验证码的正确性
		$codeResult = MyHelp::checkEmail('fenxiao_modify_email', $aa['email'], $aa['code']);
		if (error_ok($codeResult) === false) {
			$data['result'] = $codeResult;
			return $this->ajaxReturn($data);
		}
		
		$ds['email'] = $aa['email'];
		$userObj = ModelBase::getInstance('fx_user');
		$conds = appendLogicExp('id', '=', $user['id']);
		$data['result'] = $userObj->modify($ds, $conds);
		if (error_ok($data['result']) === true) {
			$fxUser = BackAccountHelp::getAccount('account_distribute', $conds);
			MyHelp::setLoginAccount($fxUser);
		}
		return $this->ajaxReturn($data);	
	}
		
	// 修改用户信息
	private function modifyUser($aa) {
		$user = MyHelp::getLoginAccount(false);
		if (is_error($user)) {
			$data['result'] = $user;
			$data['jumpUrl'] = U('user/login');
			return $this->ajaxReturn($data);
		}
		
		$userObj = ModelBase::getInstance('fx_user');
		$colNames = $userObj->getUserDefine(ModelBase::DF_COL_NAMES);
		
		$ds = coll_elements_giveup($colNames, $aa);		
		if (empty($ds)) {
			$data['result'] = error(-1, '没有可更新的信息');
			return $this->ajaxReturn($data);
		}
		
		$conds = appendLogicExp('id', '=', $user['id']);
		$data['result'] = $userObj->modify($ds, $conds);
		if (error_ok($data['result']) === true) {
			$fxUser = BackAccountHelp::getAccount('account_distribute', $conds);
			MyHelp::setLoginAccount($fxUser);
		}
		return $this->ajaxReturn($data);
	}
	
	// 用户信息
	public function infoAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'modify_password') {
				$this->modifyPassword($_POST);
			} else if ($type == 'modify_phone') {
				$this->modifyPhone($_POST);
			} else if ($type == 'modify_email') {
				$this->modifyEmail($_POST);
			} else if ($type == 'modify_user') {
				$this->modifyUser($_POST);
			} else {
				$data['result'] = error(-1, '错误的请求方式');
				$this->ajaxReturn($data);
			}
		} else {
			
			$this->assign('modal_modify_password', true);
			$this->showPage('info', 'mine', 'mine', '我的主页');
		}
	}
	
	// 提现
	public function takecashAction() {
		if (IS_POST) {
			$user = MyHelp::getLoginAccount(false);
			if (is_error($user)) {
				$data['result'] = $user;
				$data['jumpUrl'] = U('user/login');
				return $this->ajaxReturn($data);
			}
			$user = BackAccountHelp::getAccount('account_distribute',appendLogicExp('id', '=', $user['id']));
			
			$ds['user_id'] = $user['id'];
			
			$takeType = I('post.take_type', false);
			if (empty($takeType)) {
				$data['result'] = error(-1, '请选择提款渠道');
				return $this->ajaxReturn($data);
			}
			
			$channelTypeId = MyHelp::MenuItemKey2Value('pay_menu', $takeType);
			if (is_error($channelTypeId) === true) {
				$data['result'] = error(-1, '您选择的提款方式错误');
				return $this->ajaxReturn($data);
			}
			
			$ds['pay_channel_id'] = $channelTypeId;
			if ($takeType == 'chuxuka') {
				if (!empty($user['bank_card']) && !empty($user['bank_deposit'])) {
					$ds['pay_account'] = '卡号:'.$user['bank_card'].',开户行:'.$user['bank_deposit'];
				} else {
					$data['result'] = error(-1, '提款银行资料不完善，请完善后再次提交');
					return $this->ajaxReturn($data);
				}
			} else if ($takeType == 'weixin_pay') {
				if (!empty($user['weixin'])) {
					$ds['pay_account'] = $user['weixin'];
				} else {
					$data['result'] = error(-1, '提款微信账户不完善，请完善后再次提交');
					return $this->ajaxReturn($data);
				}
			} else if ($takeType == 'zhifubao') {
				if (!empty($user['zhifubao'])) {
					$ds['pay_account'] = $user['zhifubao'];
				} else {
					$data['result'] = error(-1, '提款支付宝账户不完善，请完善后再次提交');
					return $this->ajaxReturn($data);
				}
			} else {
				$data['result'] = error(-1, '不支持该提款类型');
				return $this->ajaxReturn($data);
			}
			
			if (bccomp($user['money'], 1000, 2) < 0) {
				$data['result'] = error(-1, '小于1000元不能提款');
				return $this->ajaxReturn($data);
			}
			$ds['cash'] = $user['money'];
			$ds['review_type_id'] = BackReviewHelp::reviewTypeKey2Value('reviewing');
			$ds['take_time'] = fmtNowDateTime();
			
			$fxTakeCashObj = ModelBase::getInstance('fx_take_cash');
			$data['result'] = $fxTakeCashObj->create($ds, $takeId);
			if (error_ok($data['result']) === true) {
				$fxUserObj = ModelBase::getInstance('fx_user');
				$result = $fxUserObj->modify(array('money'=>'0.00'), appendLogicExp('id', '=', $user['id']));
				if (error_ok($result) === false) {
					// 移除添加
					$data['recover_result'] = $fxTakeCashObj->remove(appendLogicExp('id', '=', $takeId));										
					$data['result'] = $result;
					return $this->ajaxReturn($data);
				}
				
				$user['money'] = '0.00';
				MyHelp::setLoginAccount($user);
				$data['money'] = '0.00';
				$data['result'] = error(0, '提款审核成功');
				return $this->ajaxReturn($data);
			} else {
				$data['result'] = error(-1, '提款审核失败');
				return $this->ajaxReturn($data);
			}
			
			
			
		} else {
			return $this->showError('404', '请求错误', '错误的请求方式', '服务器收到的请求类型有误');
		}
	}
}

?>