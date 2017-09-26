<?php
namespace Home\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackAccountHelp;

class ThirdLoginController extends HomeBaseController {
	
	//登录地址
	public function loginAction($type = null){
		
		vendor('ThinkSDK.ThinkOauth#class');
        empty($type) && $this->error('参数错误');
        $sns = \ThinkOauth::getInstance($type);
        redirect($sns->getRequestCodeURL());
		
	}

	//授权回调地址
	public function callbackAction($type = null, $code = null){
				
		(empty($type) || empty($code)) && $this->error('参数错误');
        
        //加载ThinkOauth类并实例化一个对象
        vendor('ThinkSDK.ThinkOauth#class');
        $sns  = \ThinkOauth::getInstance($type);

        //腾讯微博需传递的额外参数
        $extend = null;
        if($type == 'tencent'){
            $extend = array('openid' => $_GET['openid'], 'openkey' => $_GET['openkey']);
        }

        //请妥善保管这里获取到的Token信息，方便以后API调用
        //调用方法，实例化SDK对象的时候直接作为构造函数的第二个参数传入
        //如： $qq = ThinkOauth::getInstance('qq', $token);
        $token = $sns->getAccessToken($code , $extend);
        //获取当前登录用户信息
        if(is_array($token)){
            if($type=='qq'){
                $qq   = \ThinkOauth::getInstance('qq', $token);
                $data = $qq->call('user/get_user_info');

                if($data['ret'] == 0){
                    /*echo("<h1>恭喜！使用 {$type} 用户登录成功</h1><br>");
                    echo("授权信息为：<br>");
                    dump($token);
                    echo("当前登录用户信息为：<br>");
                    dump($data);*/
                    $this->calllogin('qq',$token['openid']);
                }else{
                    throw_exception("获取腾讯QQ用户信息失败：{$data['msg']}");
                }
            }elseif($type=='weixin'){
            	$weixin   = \ThinkOauth::getInstance('weixin', $token);
		        $data = $weixin->call('sns/userinfo');				
		        if($data['ret'] == 0){
					/*echo "当前为微信登陆<br>";
					echo "----------------------------<br>";
					dump($data);*/
					$this->calllogin('weixin',$data['unionid']);
		        }else{
		            throw_exception("获取微信用户信息失败：{$data['errmsg']}");
		        }
            }else{
            	echo("授权失败！");
            }
        }
		
	}

	private function calllogin($type,$openid){
		
		if(empty($type) || empty($openid)){
			$data['result'] = error(-1, '请求参数不完整');
			return $this->ajaxReturn($data);
		}
		
		if($type == 'qq'){
			$ds['qq_openid'] = $openid;
			$conds = appendLogicExp('qq_openid', '=', $openid);
		}elseif($type == 'weixin'){
			$ds['unionid'] = $openid;
			$conds = appendLogicExp('unionid', '=', $openid);
		}else{
			$data['result'] = error(-2, '请求参数错误');
			return $this->ajaxReturn($data);
		}
		
		$userObj = ModelBase::getInstance('user');
		$user = $userObj->getOne($conds);
		if(empty($user)){
			/*******************绑定帐号*******************/
			$user = MyHelp::getLoginAccount(false);
			if(is_error($user) === false){				
				$this->redirect('ThirdLogin/bindAccount', array('op_type' => 'bind', 'userid' => $user['id'], 'logintype' => $type, 'openid' => $openid), 0, '');				
			}else{
				$this->assign('type', $type);
				$this->assign('openid', $openid);
				$this->showPage('bind_account');
			}
			
		}else{
			/*******************用户登陆*******************/
			// 更新登录记录
			$ds['last_login_time'] = $user['login_time'];
			$ds['last_login_ip'] = $user['login_ip'];
			$ds['login_time'] = fmtNowDateTime();
			$ds['login_ip'] = get_client_ip();								
			$data['modify_result'] = $userObj->modify($ds, $conds);
			
			$loginUser = BackAccountHelp::getAccount('account_user', $conds);
			
			// 写入缓存
			$loginUser['cert_type'] = json_decode($loginUser['cert_type'], ture);
			MyHelp::setLoginAccount($loginUser);
			$data['result'] = error(0, '登录成功');			
			$this->loginShequ($loginUser, $_SESSION['login_jump_url']);
			//header('Location:http://kllife.com');
		}
    }

	//登陆同步论坛
	private function loginShequ($loginUser, $jumpUrl){
		if(!empty($loginUser)){
			$this->assign('user', $loginUser);
			$this->assign('jumpUrl', $jumpUrl);
			$this->showPage('login_shequ');
		}else{
			$this->assign('user', '');
		}
	}

	//查找前台用户信息(用于第三方登陆绑定帐号)
	public function findUserAction(){
		if(IS_POST){
			$userObj = ModelBase::getInstance('user');		
			$account = I('post.account', false);
			if(!empty($account)){
				$conds = appendLogicExp('phone', '=', $account);	
				$user = BackAccountHelp::getAccount('account_user', $conds);
				if(is_error($user) === true){
					$conds = appendLogicExp('email', '=', $account);
					$user = BackAccountHelp::getAccount('account_user', $conds);
					if(is_error($user) === true){
						$conds = appendLogicExp('username', '=', $account);	
						$user = BackAccountHelp::getAccount('account_user', $conds);
					}
				}
			}else{
				$data['result'] = error(-3, '登录账号信息不能为空');
				return $this->ajaxReturn($data);
			}
			
			if(is_error($user) === true){
				$data['result'] = error(-2, '查无次登录账户，请再次确认后登录');
				return $this->ajaxReturn($data);
			}else{
				$data['user'] = $user;
				$data['result'] = error(0, '查找成功');
				return $this->ajaxReturn($data);
			}
			
		}else{
			$data['result'] = error(-1, '请求方式错误');
			return $this->ajaxReturn($data);
		}
		
	}

	//第三方登陆绑定网站帐号
	public function bindAccountAction(){
		
		if(IS_POST){
			$op_type	= $_POST['op_type'];
			$userid		= $_POST['userid'];
			$logintype	= $_POST['logintype'];
			$openid		= $_POST['openid'];
			$password	= $_POST['password'];
			$nickname	= $_POST['nickname'];
			
			if($op_type == '' or $logintype == '' or $openid == ''){
				$data['result'] = error(-1, '请求参数不完整');
				return $this->ajaxReturn($data);
			}
			
			if($op_type == 'bind'){
				//绑定帐号
				$userObj = ModelBase::getInstance('user');
				$conds = appendLogicExp('id', '=', $userid);				
				$user = $userObj->getOne($conds);
				if(empty($user)){
					$data['result'] = error(-3, '绑定帐号信息错误');
					return $this->ajaxReturn($data);
				}
				
				if($logintype == 'qq'){
					$saveData['qq_openid'] = $openid;				
				}elseif($logintype == 'weixin'){
					$saveData['unionid'] = $openid;
				}else{
					$data['result'] = error(-4, '绑定帐号错误的第三方登录');
					return $this->ajaxReturn($data);				
				}
				
				$result = $userObj->modify($saveData, $conds);
				if(error_ok($result) === true){
					$loginUser = BackAccountHelp::getAccount('account_user', $conds);
					
					// 更新登录记录
					$ds['last_login_time'] = $user['login_time'];
					$ds['last_login_ip'] = $user['login_ip'];
					$ds['login_time'] = fmtNowDateTime();
					$ds['login_ip'] = get_client_ip();								
					$data['modify_result'] = $userObj->modify($ds, $conds);
					
					// 写入缓存
					MyHelp::setLoginAccount($loginUser);
					
					$data['result'] = error(0, '绑定并登录成功');
					$this->ajaxReturn($data);
				}
				
			}elseif($op_type == 'creat'){
				//创建帐号
				$userObj = ModelBase::getInstance('user');
				$saveData['create_time'] = fmtNowDateTime();
				$saveData['salt'] = substr(uniqid(rand()), -6);
				$saveData['password'] = md5(md5($password).$saveData['salt']);
				if($nickname == ''){
					$nickname = $logintype.rand('10000000','99999999');
				}
				$saveData['nickname'] = $nickname;
				
				if($logintype == 'qq'){
					$saveData['qq_openid'] = $openid;
				}elseif($logintype == 'weixin'){
					$saveData['unionid'] = $openid;				
				}else{
					$data['result'] = error(-5, '第三方登录创建帐号错误');
					return $this->ajaxReturn($data);				
				}
					
				$result = $userObj->create($saveData, $userId);			
				if(error_ok($result) === true){
					$conds = appendLogicExp('id', '=', $userId);
					$loginUser = BackAccountHelp::getAccount('account_user', $conds);
					
					// 更新登录记录
					$ds['last_login_time'] = $user['login_time'];
					$ds['last_login_ip'] = $user['login_ip'];
					$ds['login_time'] = fmtNowDateTime();
					$ds['login_ip'] = get_client_ip();								
					$data['modify_result'] = $userObj->modify($ds, $conds);
					
					// 写入缓存
					MyHelp::setLoginAccount($loginUser);
					
					$data['result'] = error(0, '创建并登录成功');
					$this->ajaxReturn($data);
				}
				
			}else{
				$data['result'] = error(-2, '错误的请求类型');
				return $this->ajaxReturn($data);
			}
					
		}else{
			$op_type	= $_GET['op_type'];
			$userid		= $_GET['userid'];
			$logintype	= $_GET['logintype'];
			$openid		= $_GET['openid'];
			
			if($op_type == '' or $userid == '' or $logintype == '' or $openid == ''){
				$data['result'] = error(-1, '请求参数不完整');
				return $this->ajaxReturn($data);
			}
			
			if($op_type == 'bind'){
				//绑定帐号
				$userObj = ModelBase::getInstance('user');
				$conds = appendLogicExp('id', '=', $userid);				
				$user = $userObj->getOne($conds);
				if(empty($user)){
					$data['result'] = error(-3, '绑定帐号信息错误');
					return $this->ajaxReturn($data);
				}
				
				if($logintype == 'qq'){
					$saveData['qq_openid'] = $openid;				
				}elseif($logintype == 'weixin'){
					$saveData['unionid'] = $openid;
				}else{
					$data['result'] = error(-4, '绑定帐号错误的第三方登录');
					return $this->ajaxReturn($data);				
				}
				
				$result = $userObj->modify($saveData, $conds);
				if(error_ok($result) === true){
					$loginUser = BackAccountHelp::getAccount('account_user', $conds);
					
					// 更新登录记录
					$ds['last_login_time'] = $user['login_time'];
					$ds['last_login_ip'] = $user['login_ip'];
					$ds['login_time'] = fmtNowDateTime();
					$ds['login_ip'] = get_client_ip();								
					$data['modify_result'] = $userObj->modify($ds, $conds);
					
					// 写入缓存
					MyHelp::setLoginAccount($loginUser);
					
					header('Location:http://kllife.com/home/index.php?s=/home/user/manager');
				}
				
			}else{
				$data['result'] = error(-2, '错误的请求类型');
				return $this->ajaxReturn($data);
			}
		}
		
	}
}

?>