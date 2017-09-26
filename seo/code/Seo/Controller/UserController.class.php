<?php

namespace Seo\Controller;
use Core\Model\ModelBase;
use Core\Model\BackAccountHelp;
use Core\Model\BackReviewHelp;
use Core\Model\MyHelp;

class UserController extends SeoBaseController {
		
	// 客户登录
	public function loginAction() {    
		if (IS_POST) {
			$userObj = ModelBase::getInstance('seo_user');		
			$account = I('post.acct', false);
			if (!empty($account)) {
				$conds = appendLogicExp('phone', '=', $account);	
				$user = BackAccountHelp::getAccount('account_seo', $conds);
				if (is_error($user) === true) {
					$conds = appendLogicExp('email', '=', $account);
					$user = BackAccountHelp::getAccount('account_seo', $conds);
					if (is_error($user) === true) {
						$conds = appendLogicExp('username', '=', $account);	
						$user = BackAccountHelp::getAccount('account_seo', $conds);
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
				$accountType = BackAccountHelp::AccountTypeKey2Value('account_seo');
				$user['account_type'] = $accountType;
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
			$this->showPage('login', 'login', 'login', '登录', '优化系统');
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
		$userObj = ModelBase::getInstance('seo_user');
		$conds = appendLogicExp('id', '=', $user['id']);
		$data['result'] = $userObj->modify($ds, $conds);
		if (error_ok($data['result']) === true) {
			$fxUser = BackAccountHelp::getAccount('account_user', $conds);
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
		$userObj = ModelBase::getInstance('seo_user');
		$conds = appendLogicExp('id', '=', $user['id']);
		$data['result'] = $userObj->modify($ds, $conds);
		if (error_ok($data['result']) === true) {
			$fxUser = BackAccountHelp::getAccount('account_user', $conds);
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
		$userObj = ModelBase::getInstance('seo_user');
		$conds = appendLogicExp('id', '=', $user['id']);
		$data['result'] = $userObj->modify($ds, $conds);
		if (error_ok($data['result']) === true) {
			$fxUser = BackAccountHelp::getAccount('account_user', $conds);
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
		
		$userObj = ModelBase::getInstance('seo_user');
		$colNames = $userObj->getUserDefine(ModelBase::DF_COL_NAMES);
		
		$ds = coll_elements_giveup($colNames, $aa);		
		if (empty($ds)) {
			$data['result'] = error(-1, '没有可更新的信息');
			return $this->ajaxReturn($data);
		}
		
		$conds = appendLogicExp('id', '=', $user['id']);
		$data['result'] = $userObj->modify($ds, $conds);
		if (error_ok($data['result']) === true) {
			$fxUser = BackAccountHelp::getAccount('account_user', $conds);
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
}

?>