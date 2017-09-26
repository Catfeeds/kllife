<?php
/**
 * 会话处理
 */
namespace Common\Behaviors;
use Core\Model\BackInitModel;
use Core\Model\MyHelp;
use Core\Model\MyLog;

class BackAuthorBehavior {
	
	// 检查登录
	private function checkBackLogin() {		
		if (CONTROLLER_NAME === 'External' || CONTROLLER_NAME === 'Help') {
			return false;
		}
		
		if (CONTROLLER_NAME === 'Admin' && ACTION_NAME === 'login') {
			return false;
		}
        session_start();
        $admin = session('admin');
        if(!empty($admin)) {
            $session = array();
            $session['ADMIN'] = array_change_key_case($admin, CASE_UPPER);
            C('SESSION', $session);
        }
		
        //无用户身份, 只能访问登录
        if (CONTROLLER_NAME !== 'Admin') {
        	$account = empty($admin) ? 'unknow' : $admin['account'];
        	MyLog::INFO(CONTROLLER_NAME.',admin:'.$account.',ip:'.get_client_ip().',url:'.$_SERVER['REQUEST_URI']);
	        if((empty($session) || empty($session['ADMIN']))) {
		    	redirect(U('Admin/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI']))));
	        }		
		}
	}
	
	// 分销登录检测
	private function checkFenxiaoLogin() {		
		if (CONTROLLER_NAME === 'User' && ACTION_NAME === 'login') {
			return false;
		}
		
		$user = MyHelp::getLoginAccount(false);
				
        //无用户身份, 只能访问登录
        if ($controller !== 'User') {
	        if(is_error($user) === true) {
		    	redirect(U('User/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI']))));
	        }	
		}
	}
	
	// SEO登录检测
	private function checkSeoLogin() {		
		if (CONTROLLER_NAME === 'User' && ACTION_NAME === 'login') {
			return false;
		}
		
		$user = MyHelp::getLoginAccount(false);
				
        //无用户身份, 只能访问登录
        if ($controller !== 'User') {
	        if(is_error($user) === true) {
		    	redirect(U('User/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI']))));
	        }	
		}
	}
	
	// 站点检测跳转
	private function jumpUrl() {
		$host = $_SERVER['HTTP_HOST'];
		$url = $_SERVER['REQUEST_URI'];
		if (stripos($host, 'www.') !== FALSE) {
			$host = str_replace('www.','',$host);
		}
		
		$isMobileDevice = is_mobile_device($out);
		$data['is_mobile'] = $isMobileDevice ? '移动端' : 'PC端';
		$data['out'] = $out;
		if ($isMobileDevice) {
			if (stripos($_SERVER['SERVER_NAME'],'kllife.com') !== FALSE) {
				$url = str_replace('home', 'phone', $url);
			} else if (stripos($_SERVER['SERVER_NAME'],'xinlvpai.com') !== FALSE) {
				if (stripos($host, 'm.') !== 0) {
					$host = 'm.'.$host;
				}
				$url = str_replace('qinglvpai', 'qlpphone', $url);
			}
		} else {
			if (stripos($_SERVER['SERVER_NAME'],'kllife.com') !== FALSE) {
				$url = str_replace('phone', 'home', $url);
			} else if (stripos($_SERVER['SERVER_NAME'], 'xinlvpai.com') !== FALSE) {
				$host = str_replace('m.', '', $host);
				$url = str_replace('qlpphone', 'qinglvpai', $url);
			}
		}	
		$data['new_host'] = $host;
		$data['new_url'] = $url;
		$data['host'] = $_SERVER['HTTP_HOST'];
		$data['url'] = $_SERVER['REQUEST_URI'];
		$data['server_name'] = $_SERVER['SERVER_NAME'];
		$data['server_via'] = $_SERVER['HTTP_VIA'];
		$data['result'] = '页面未跳转';
		
		session_start();
		if ($host != $_SERVER['HTTP_HOST'] || $url != $_SERVER['REQUEST_URI']) {
			$data['finnal_url'] = 'http://'.$host.$url;
			$data['result'] = '页面跳转成功';
			session('jump_test', $data);
			redirect('http://'.$host.$url);
			return true;
		}	
		session('jump_test', $data);
		return false;
	} 
	
	
    public function run(&$params) {
    	// PC移动端识别跳转
    	if(MODULE_NAME != 'Back' && (CONTROLLER_NAME != 'External' || CONTROLLER_NAME != 'Help')){
    		if ($this->jumpUrl()) {
				exit();
			}
    	}    	
        
		if (MODULE_NAME == "Back") {
			G('begin');		
			
	        // 检查初始数据是否存在
	        BackInitModel::checkInit();
			// 登录检查
			$this->checkBackLogin();
		} 
		
		if (MODULE_NAME == "Fenxiao") {
			
			// 分销登录检查
			$this->checkFenxiaoLogin();
		}
		
		if (MODULE_NAME == "Seo") {
			
			// 分销登录检查
			$this->checkSeoLogin();
		}
    }
}
?>