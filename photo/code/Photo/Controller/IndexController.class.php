<?php
namespace Photo\Controller;
use Think\Controller;


class IndexController extends PhotoBaseController {
	
	public function welcomeAction() {
		$this->assign("t1", "This is dynamic text!!!");
		
		$stra=array("start");
		$str = "This is string array test!!!";
		for ($i=0; $i<strlen($str);$i++){
			array_push($stra, $str[$i]);
		}
		$this->assign("stra", $stra);
		
		if (IS_POST) {
			$cdsstr = I('post.cdsstr', '');
			$result = MyHelp::getPageList('line', $cdsstr, 0, 10, array('id'=>'desc'), 2 $out);
			$this->assign($result);
		} else {
	
		}
		$this->display();
	}
	
	public function ajaxTestAction() {
		$this->ajaxReturn(array('t2'=>"This is add text!!!"));		
	}
	
	public function dqwjdoqwAction() {
		
		$tabObj = ModelBase::getInstance('line');
		$colName = $tabObj->getUserDefine(ModelBase::DF_COL_NAMES);
		
		$ds = coll_elements_giveup($colName, $_POST);
		
		$conds = MyHelp::getLogicExp($ds, '=', 'AND');
		
		$result = $tabObj->modify($ds,$conds);
		if (error_ok($result) === true) {
			$this->assign('result', '成功');
		} else {
			$this->assign('result', '错误');
		}
		
		$conds = appendLogicExp('id', '=', '1');
		$result = $tabObj->remove($conds);
		
		$tabObj->getOne($conds);
		$tabObj->getAll($conds, 0，5, $count, array('id'=>'asc'), false, $out);
	}
}

?>