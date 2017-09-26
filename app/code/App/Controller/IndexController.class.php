<?php
namespace App\Controller;
use Think\Controller;


class IndexController extends AppBaseController {
	public function welcomeAction() {
		$this->assign("t1", "This is dynamic text!!!");
		
		$stra=array("start");
		$str = "This is string array test!!!";
		for ($i=0; $i<strlen($str);$i++){
			array_push($stra, $str[$i]);
		}
		$this->assign("stra", $stra);
		$this->display();
	}
	
	public function ajaxTestAction() {
		$this->ajaxReturn(array('t2'=>"This is add text!!!"));		
	}
}

?>