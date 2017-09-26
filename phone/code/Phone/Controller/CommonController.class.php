<?php

namespace Phone\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;

class CommonController extends PhoneBaseController {
	
	public function smsAction() {		
		if(IS_POST){
			$type = I('post.type', false);
			if ($type == 'send') {
				$tel = I('post.tel', false);
				$use = I('post.use', false);
				$interval = I('post.interval', 600);	
				$rd = I('post.rd', false);
				$data['result'] = MyHelp::sendSMS($use, $tel, $interval, $rd);
				return $this->ajaxReturn($data);
			} else if ($type == 'check') {
				$tel = I('post.tel', false);
				$use = I('post.use', false);
				$code = I('post.code', 0);
				$data['result'] = MyHelp::checkSMS($use, $tel, $code);
				return $this->ajaxReturn($data);
			} else {
				$data['result'] = error(-1, '错误短信类型');
				return $this->ajaxReturn($data);	
			}			
		} else {
			$data['result'] = error(-1, '错误的请求方式');
			return $this->ajaxReturn($data);
		}		
	}
	
	public function emailAction() {
		if(IS_POST){
			$type = I('post.type', false);
			if ($type == 'send') {
				$email = I('post.email', false);
				$use = I('post.use', false);
				$interval = I('post.interval', 600);	
				$data['result'] = MyHelp::sendEmail($use, $email, $interval);
				return $this->ajaxReturn($data);
			} else if ($type == 'check') {
				$email = I('post.email', false);
				$use = I('post.use', false);
				$code = I('post.code', 0);
				$data['result'] = MyHelp::checkEmail($use, $email, $code);
				return $this->ajaxReturn($data);
			} else {
				$data['result'] = error(-1, '错误短信类型');
				return $this->ajaxReturn($data);	
			}			
		} else {
			$data['result'] = error(-1, '错误的请求方式');
			return $this->ajaxReturn($data);
		}	
	}
	
}

?>