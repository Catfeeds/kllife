<?php
namespace Seo\Controller;
use Think\Controller;


class IndexController extends SeoBaseController {
	
	public function welcomeAction() {
		$station = '[{"id":"1","name":"西安"}]';
		$idx = stripos($station, '西安');
		
		$this->assign('station', $idx === false ? 'false' : $idx);		
		$this->assign('mname', MODULE_NAME);		
		$this->showPage('welcome', 'mine', 'mine', '我的主页', '我的主页');
	}
	
}

?>