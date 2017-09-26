<?php

namespace Qlpphone\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackAccountHelp;
use Core\Model\BackOrderHelp;
use Core\Model\BackLineHelp;
use Core\Model\BackImageHelp;

define('USER_INFO_ARTICLE_SHOW_COUNT', 6);

class UserController extends QlpBaseController {
	
	// 客户登录
	public function loginAction() {
        $forward = I('get.forward', false);
        if(empty($forward)) {
            $forward = U('Index/welcome');
        } else {
            $forward = base64_decode($forward);
        }
        
		if (IS_POST) {
			$userObj = ModelBase::getInstance('user');		
			$account = I('post.account', false);
			if (!empty($account)) {
				$conds = appendLogicExp('phone', '=', $account);	
				$user = BackAccountHelp::getAccount('account_user', $conds);
				if (is_error($user) === true) {
					$conds = appendLogicExp('email', '=', $account);
					$user = BackAccountHelp::getAccount('account_user', $conds);
					if (is_error($user) === true) {
						$conds = appendLogicExp('username', '=', $account);	
						$user = BackAccountHelp::getAccount('account_user', $conds);
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
			
			$password = I('post.password', '');
			$cmpPassword = md5(md5($password).$user['salt']);
			$data['cmp_pwd'] = $cmpPassword;
			if ($cmpPassword === $user['password']) {		
				// 如果禁用，不允许登录
				if ($user['forbidden'] == '1') {
					$data['result'] = error(-1, '您的账号已被禁用，不能登录，请联系客服MM咨询详细情况哦');
					$this->ajaxReturn($data);
				}
				
				
				// 更新登录记录
				$ds['last_login_time'] = $user['login_time'];
				$ds['last_login_ip'] = $user['login_ip'];
				$ds['login_time'] = fmtNowDateTime();
				$ds['login_ip'] = get_client_ip();								
				$data['modify_result'] = $userObj->modify($ds, $conds);
						
				$user['last_login_time'] = $user['login_time'];
				$user['last_login_ip'] = $user['login_ip'];
				$user['login_time'] = $ds['login_time'];
				$user['login_ip'] = $ds['login_ip'];
				$accountType = BackAccountHelp::AccountTypeKey2Value('account_user');
				$user['account_type'] = $accountType;
				// 写入缓存
				MyHelp::setLoginAccount($user);
				unset($user['password']);
				unset($user['salt']);	
				$data['user'] = $user;					
				$data['result'] = error(0, '登录成功');
			} else {
				$data['result'] = error(-3, '登录账户或密码错误');
			}
			$this->ajaxReturn($data);			
		} else {
			return $this->showPage('login', 'user_login', 'user', '用户登录');
		}
	}
	
	// 检查客户信息
	public function checkAction() {
		if (IS_POST) {
			$aa = $_POST;
			$userObj = ModelBase::getInstance('user');
			$colNames = $userObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$ds = coll_elements_giveup($colNames, $aa);
			$conds = MyHelp::getLogicExp($ds, '=', 'OR');			
			$user = $userObj->getOne($conds);
			$data['result'] = error(0, '数据不存在，可以使用');
			if (!empty($user)) {
				$data['result'] = error(-1, '数据已经存在');
			}
			$this->ajaxReturn($data);
		} else {
			$data['result'] = error(-1, '错误的请求方式');
			return $this->ajaxReturn($data);
		}
	}
		
	// 客户注册
	public function registerAction() {
		if (IS_POST) {			
			$aa = $_POST;
			$userObj = ModelBase::getInstance('user');
			$colNames = $userObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$ds = coll_elements_giveup($colNames, $aa);
			$ds['create_time'] = fmtNowDateTime();
			
			// 姓名唯一性确认
			if (array_key_exists('name', $ds)) {
				$conds = appendLogicExp('name', '=', $ds['name'], 'OR', $conds);
			}
			
			// 用户名唯一性确认
			if (array_key_exists('username', $ds)) {
				$conds = appendLogicExp('username', '=', $ds['username'], 'OR', $conds);
			}
			
			// 手机号码唯一性确认
			if (array_key_exists('phone', $ds)) {
				$code = I('post.code', 0);
				$result = MyHelp::checkSMS('phone_register', $ds['phone'], $code);
				if (error_ok($result) === false) {
					$data['result'] = $result;
					return $this->ajaxReturn($data);
				}
				$conds = appendLogicExp('phone', '=', $ds['phone'], 'OR', $conds);
			}
			
			// 电子邮件唯一性确认
			if (array_key_exists('email', $ds)) {
				$conds = appendLogicExp('email', '=', $ds['email'], 'OR', $conds);
			}
			
			$user = $userObj->getOne($conds);
			if (!empty($user)) {
				$data['result'] = error(-1, '姓名、用户名、手机号码或者电子邮件已经存在，请检查后再进行注册');
				$this->ajaxReturn($data);
			}
			
			$ds = coll_elements_giveup($colNames, $aa);
			$ds['create_time'] = fmtNowDateTime();
			
			$ds['salt'] = substr(uniqid(rand()), -6);
			$ds['password'] = md5(md5($ds['password']).$ds['salt']);
			
			$result = $userObj->create($ds, $userId);
			$data['result'] = error(0, '注册成功');
			if (error_ok($result) === false) {
				$data['result'] = $result;
			}
			return $this->ajaxReturn($data);
		} else {
			return $this->showPage('register', 'user_register', 'user', '用户注册');
		}
	}
	
	// 短信登录
	public function smsLoginAction() {
		if (IS_POST) {
			$phone = I('post.phone', false);
			$code = I('post.code', false);
			
			if ($phone == false || $code == false) {
				$data['result'] = error(-1, '参数错误，登录失败');
				return $this->ajaxReturn($data);
			}
			
			$data['result'] = MyHelp::checkSMS('phone_sms_login', $phone, $code);
			if (error_ok($data['result']) === true) {
				// 判断是否存在账户，不存在则创建
				$user = BackAccountHelp::getAccount('account_user', appendLogicExp('phone', '=', $phone));
				if (is_error($user) === true) {
					$ds['phone'] = $phone;
					$ds['create_time'] = fmtNowDateTime();
					
					$ds['salt'] = substr(uniqid(rand()), -6);
					$ds['password'] = md5(md5($code).$ds['salt']);
					
					$userObj = ModelBase::getInstance('user');
					$result = $userObj->create($ds, $userId);
					$data['result'] = error(0, '注册成功');
					if (error_ok($result) === false) {
						$data['result'] = $result;
						return $this->ajaxReturn($data);
					}
					$user = BackAccountHelp::getAccount('account_user', appendLogicExp('phone', '=', $phone));
				}
				
				// 保存用户登录信息
				MyHelp::setLoginAccount($user);
				unset($user['password']);
				unset($user['salt']);	
				$data['user'] = $user;	
				// 跳转到首页
				$data['jumpUrl'] = U('index/welcome');
			} 
			$this->ajaxReturn($data);
		} else {
			return $this->showPage('sms_login', 'user_sms_login', 'user', '短信登录');
		}
	}
	
	// 重置密码
	public function forgotPasswordAction() {
		if (IS_POST) {
			$phone = I('post.phone', false);
			$code = I('post.code', false);
			$password = I('post.password', false);
			
			if ($phone === false || $code === false || $password === false) {
				$data['result'] = error(-1, '错误的重置密码参数');
				return $this->ajaxReturn($data);
			}
			
			$conds = appendLogicExp('phone', '=', $phone);
			$user = BackAccountHelp::getAccount('account_user', $conds);
			if (is_error($user) === true) {
				$data['result'] = error('该电话号码未绑定账户，请查证后再次输入');
				return $this->ajaxReturn($data);
			}
			
			$result = MyHelp::checkSMS('phone_forgot_password', $phone, $code);
			if (error_ok($result) === true) {				
				$ds['salt'] = substr(uniqid(rand()), -6);
				$ds['password'] = md5(md5($password).$ds['salt']);
				$userObj = ModelBase::getInstance('user');
				$data['result'] = $userObj->modify($ds, $conds);				
			} else {
				$data['result'] = $result;
			}
			$this->ajaxReturn($data);			
		} else {
			return $this->showPage('forgot', 'user_forgot', 'user', '忘记密码');
		}
	}
	
	// 用户详细信息
	public function infoAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'article_list') {
				$page = I('post.page', 0);
				$startIndex = $page * LINE_ARTICLE_LIST_SHOW_COUNT;
				$sort = array('recommend'=>'desc', 'hot'=>'desc', 'agree'=>'desc', 'read'=>'desc', 'create_time'=>'desc');
				$articles = BackLineHelp::getArticleList($conds, $startIndex, LINE_ARTICLE_LIST_SHOW_COUNT, $total, $sort, array('content'=>1));
				if (is_error($articles) === false) {
					$data['ds'] = $articles;
					$data['result'] = error(0, '');
				} else {
					$data['result'] = $articles;
				}
			} else {
				$data['result'] = error(-1, '错误的操作类型');
			}
			return $this->ajaxReturn($data);
		} else {
			$user = MyHelp::getLoginAccount(true);
			if (is_error($user) === false) {				
				$conds = appendLogicExp('user_id', '=', $user['id']);
				// 获取用户消息
				$msg_check = 0;
				$msgs = BackAccountHelp::getUserMessage($user['id']);
				foreach ($msgs as $mk=>$mv) {
					if ($mv['check'] == 0) {
						$msg_check += 1;
					}
				}
				$this->assign('msg_check', $msg_check);
				$this->assign('messages', $msgs);
				
				// 用户订单数量
				$stateList = array(
					'OrderReviewCount'=>'review',
					'OrderPayPartCount'=>'pay_part',
					'OrderPayComplateCount'=>'pay_complate',
					'OrderComplatedCount'=>'complated',
				);
				$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
				foreach ($stateList as $sk=>$sv) {
					$stateId = BackOrderHelp::OrderStateKey2Value($sv);
					if (is_error($stateId) === false) {
						$conds = appendLogicExp('userid', '=', $user['id']);
						$conds = appendLogicExp('book_account_type', '=', $user['account_type']['id'], 'AND', $conds);
						$conds = appendLogicExp('zhuangtai', '=', $stateId, 'AND', $conds);
						$orderStateCount = $orderObj->getCount($conds);
						$this->assign($sk, $orderStateCount);
					}
				}
				$conds = appendLogicExp('userid', '=', $user['id']);
				$conds = appendLogicExp('book_account_type', '=', $user['account_type']['id'], 'AND', $conds);
				$orderStateCount = $orderObj->getCount($conds);
				$this->assign('OrderAllCount', $orderStateCount);
								
				// 优惠积分
				$couponConds = appendLogicExp('user_id', '=', $user['id']);
				$coupons = BackAccountHelp::getUserCoupon($couponConds);
				$invalid = array(); $use = array(); $normal = array();
				foreach ($coupons as $ck=>$cv) {					
					if ($cv['invalid'] == 1) {
						array_push($invalid, $cv);
					} else if ($cv['use'] == 1) {
						array_push($use, $cv);
					} else {
						array_push($normal, $cv);
					}
				}
				$this->assign('coupon_invalid', $invalid);
				$this->assign('coupon_use', $use);
				$this->assign('coupon_normal', $normal);				
								
				$this->showPage('info', 'user_info', 'user', '用户信息');
			} else {
				$this->showPage('login', 'user_login', 'user', '用户登录');	
			}
		}
	}
	
	// 用户退出
	public function exitAction() {
		header('Access-Control-Allow-Origin:*');
		MyHelp::logoutAccount();
		if (IS_POST) {
			$this->ajaxReturn('退出成功');
		} else {
	        redirect(U('index/welcome'));		
		}
	}
		
	// 修改用户信息
	private function modifyUser($userId, $ds) {		
		$user = MyHelp::getLoginAccount(false);
		if (is_error($user) === false) {
			$userObj = ModelBase::getInstance('user');
			$colNames = $userObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$ds = coll_elements_giveup($colNames, $ds);
			$result = $userObj->modify($ds, appendLogicExp('id', '=', $userId));
			if (error_ok($result) == true) {
				foreach ($ds as $dk=>$dv) {
					$user[$dk]=$dv;
				}
				$loginUser = MyHelp::getLoginAccount(false);
				if (is_error($loginUser) === false && $user['id'] == $loginUser['id'] && $user['account_type']['id'] == $loginUser['account_type']['id']) {					
					MyHelp::setLoginAccount($user);	
				}
			}
			return $result;
		} else {
			return error(-1, '用户没有登录');
		}
	}
	
	// 修改密码
	private function modifyPassword($aa) {		
		$user = MyHelp::getLoginAccount(false);
		if (is_error($user) === false) {		
			$cmpPassword = md5(md5($aa['password']).$user['salt']);
			$data['cmp_pwd'] = $cmpPassword;
			if ($cmpPassword === $user['password']) {
				$ds['salt'] = substr(uniqid(rand()), -6);
				$ds['password'] = md5(md5($aa['new_password']).$ds['salt']);
				$data['result'] = $this->modifyUser($aa['id'], $ds);
				return $this->ajaxReturn($data);
			} else {
				$data['result'] = error(-1, '原始密码错误');
				return $this->ajaxReturn($data);
			}
		} else {
			$data['result'] = error(-1, '用户登录超时');
			$data['jumpUrl'] = U('user/login');
			return $this->ajaxReturn($data);
		}
	}
	
	// 修改电子邮电
	private function modifyEmail($aa) {
		$user = MyHelp::getLoginAccount(false);
		if (is_error($user) === false) {	
			if (!array_key_exists('check', $aa)) {
				$data['result'] = error(-1, '电子邮件信息操作类型不明确');
				return $this->ajaxReturn($data);
			}
			
			if (!array_key_exists('email', $aa)) {
				$data['result'] = error(-2, '电子邮件信息不能为空');
				return $this->ajaxReturn($data);			
			}
			
			// 存在此电子邮件，不能修改
			$user = BackAccountHelp::getAccount('account_user', appendLogicExp('email', '=', $aa['email']));
			if (is_error($user) === false) {
				$data['result'] = error(-3, '该电子邮件已被使用，不能绑定此电子邮件');
				return $this->ajaxReturn($data);
			}
			
			if ($aa['check'] == 0) {
				$data['result'] = MyHelp::sendEmail('phone_modify_email', $aa['email'], 600);
			} else {
				if (!array_key_exists('code', $aa)) {
					$data['result'] = error(-4, '验证码不能为空');
					return $this->ajaxReturn($data);
				}
				$data['result'] = MyHelp::checkEmail('phone_modify_email', $aa['email'], $aa['code']);
				if (error_ok($data['result']) == true) {
					$data['check_result'] = $data['result'];
					$data['result'] = $this->modifyUser($aa['user_id'], array('email'=>$aa['email']));
				}
			}
			return $this->ajaxReturn($data);
		} else {
			$data['result'] = error(-1, '用户登录超时');
			$data['jump_url'] = U('user/login');
			return $this->ajaxReturn($data);
		}
	}
	
	// 修改电话号码
	private function modifyPhone($aa) {
		$user = MyHelp::getLoginAccount(false);
		if (is_error($user) === false) {	
			if (!array_key_exists('check', $aa)) {
				$data['result'] = error(-1, '电话号码信息操作类型不明确');
				return $this->ajaxReturn($data);
			}
			
			if (!array_key_exists('phone',$aa)) {
				$data['result'] = error(-2, '电话号码信息不能为空');
				return $this->ajaxReturn($data);			
			}
			
			// 存在此电话号码，不能修改
			$user = BackAccountHelp::getAccount('account_user', appendLogicExp('phone', '=', $aa['phone']));
			if (is_error($user) === false) {
				$data['result'] = error(-3, '该电话号码已被使用，不能绑定此电话');
				return $this->ajaxReturn($data);
			}
			
			if ($aa['check'] == 0) {
				$data['result'] = MyHelp::sendSMS('phone_modify_phone', $aa['phone'], 600, $aa['rd']);
			} else {
				if (!array_key_exists('code', $aa)) {
					$data['result'] = error(-4, '验证码不能为空');
					return $this->ajaxReturn($data);
				}
				$data['result'] = MyHelp::checkSMS('phone_modify_phone', $aa['phone'], $aa['code']);
				if (error_ok($data['result']) == true) {
					$data['check_result'] = $data['result'];
					$data['result'] = $this->modifyUser($aa['user_id'], array('phone'=>$aa['phone']));
				}
			}
			return $this->ajaxReturn($data);
		} else {
			$data['result'] = error(-1, '用户登录超时');
			$data['jump_url'] = U('user/login');
			return $this->ajaxReturn($data);
		}
	}
	
	// 用户管理
	public function managerAction() {
		if (IS_POST) {
			$aa = $_POST;
			$type = I('post.type', false);
			if ($type == 'modify_password') {
				$this->modifyPassword($aa);
			} else if ($type == 'modify_email') {
				$this->modifyEmail($aa);
			} else if ($type == 'modify_phone') {
				$this->modifyPhone($aa);
			} else if ($type == 'modify_base') {
				$user = MyHelp::getLoginAccount(false);
				if (is_error($user) == false) {
					$data['result'] = $this->modifyUser($user['id'], $aa);
				} else {
					$data['result'] = $user;
				}
				$this->ajaxReturn($data);
			} else {
				$data['result'] = error(-1, '未知操作');
				$this->ajaxReturn($data);
			}
		} else {
			// 未登陆自动跳转至登陆
			$user = MyHelp::getLoginAccount(true);
			if (is_error($user) === false) {
//				$conds = appendLogicExp('user_id', '=', $user['id']);
				
				$certTypeObj = ModelBase::getInstance('certificate_type');
				$certTypes = $certTypeObj->getAll();
				$this->assign('certs', $certTypes);
				
				$this->showPage('manager', 'user_manager', 'user', '用户管理中心');
			}
		}
	}
	
	// 用户图像上传
	public function faceAction() {
		$user = MyHelp::getLoginAccount(true);
		if (IS_POST) {
			if (is_error($user)) {
				$data['result'] = error(-1, '您暂时还未登录');
				return $this->ajaxReturn($data);
			}
			$savePath = C('LX_FACE_UPLOAD_PATH');
			$info = BackImageHelp::localUploadFiles($savePath);
			if (is_error($info) == false) {
				$imageInfo = $info['face_file'];
				$host = C('TMPL_PARSE_STRING.{__GLOBAL_HOST_URL__}');
				// 如果是本站图像，删除之前的图像
				if (stripos($user['face'], $host) !== false) {
					$urls =  explode('/',$user['face']);
					$len = count($urls);
					if ($len > 2) {
						$localFile = $savePath.$urls[$len-2].'/'.$urls[$len-1];
						$data['delete_source_result'] = BackImageHelp::deleteLocalFile(array($localFile));
					}
				}
				// 更换为新的图片
				$imgUrl = $host.C('LX_FACE_IMAGE_URL').$imageInfo['savepath'].$imageInfo['savename'];
				$userObj = ModelBase::getInstance('user');
				$result = $userObj->modify(array('face'=>$imgUrl), appendLogicExp('id', '=', $user['id']));
				if (error_ok($result) === false) {
					$data['result'] = error(-1, '设置图像失败,原因如下:'.$result['message']);
					// 删除上传的图片
					$uploadFile = $savePath.$imageInfo['savepath'].$imageInfo['savename'];
					$data['delete_upload_result'] = BackImageHelp::deleteLocalFile(array($uploadFile));
				} else {			
					$user['face'] = $imgUrl;
					MyHelp::setLoginAccount($user);		
					$data['face_image'] = $imgUrl;
					$data['result'] = error(0, '设置图像成功');
				}
//				$data['info'] = $info;
//				$data['upload_path'] = $savePath;				
			} else {
				$data['result'] = $info;
			}
			$this->ajaxReturn($data);			
		} else {
			$localUrl = substr(U('user/face'), 1);
			$uploadUrl = C('TMPL_PARSE_STRING.{__GLOBAL_HOST_URL__}').$localUrl;
			$this->assign('upload_url', $uploadUrl);
			$this->showPage('face');
		}
	}	
}

?>