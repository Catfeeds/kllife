<?php

namespace Home\Controller;
use Core\Model\ModelBase;
use Core\Model\BackAccountHelp;
use Core\Model\BackLineHelp;

class FenxiaoController extends HomeBaseController {
	
	protected function _initialize(){		
		$this->page_title = '首页';
		$this->menu_active = 'home';
	}
	
	// 显示分销线路
	private function distributeList($requestType, $aa) {
		if ($requestType == 'get') {
			$dUserId = I('get.duid', false);	
		} else {
			$dUserId = I('post.duid', false);	
		}
			
		$duser = BackAccountHelp::getAccount('account_distribute', appendLogicExp('id', '=', $dUserId));		
		if (is_error($duser) === true) {
			if ($requestType == 'get') {
				return $this->showError('404', '分销用户错误', '找不到分销用户', '该用户可能不存在或者被拉黑');
			} else {
				$data['result'] = $duser;
				return $this->ajaxReturn($data);
			}
		}
		
		if ($requestType == 'get') {
			$thisPage = I('get.page', 0);
		} else {
			$thisPage = I('post.page', 0);
		}
		
		if (empty($thisPage)) {
			$thisPage = 0;
		}		
		$startIndex = $thisPage * LINE_PAGE_SHOW_COUNT;
		
		$fxLineObj = ModelBase::getInstance('fx_line');
		$conds = appendLogicExp('user_id', '=', $duser['id']);
		$fxLines = $fxLineObj->getAll($conds, $startIndex, LINE_PAGE_SHOW_COUNT, $total, array('sort'=>'asc'));
		
		$ds = array();
		$find = array('min_batch'=>true,'batch'=>true);
		foreach ($fxLines as $k => $v) {
			$line = BackLineHelp::getLine(appendLogicExp('id', '=', $v['line_id']), $find);
			$line['bind_user_id'] = $v['user_id'];
			$line['bind_id'] = $v['id'];
			$line['bind_sort'] = $v['sort'];
			array_push($ds, $line);
		}
		
		$pageCount = intval($total / LINE_PAGE_SHOW_COUNT);
		if ($total % LINE_PAGE_SHOW_COUNT > 0) {
			$pageCount += 1;
		}
		
		if ($requestType == 'get') {
			$this->assign('duser', $duser);		
			$this->assign('page_count', $pageCount);
			$this->assign('lines', $ds);
			return $this->showPage('fenxiao/welcome', 'fenxiao_welcome', 'fenxiao', '旅游+');
		} else {
			$data['page_count'] = $pageCount;
			$data['ds'] = $ds;
			return $this->ajaxReturn($data);
		}
	}
	
	public function welcomeAction(){
		if (IS_POST) {
			$this->distributeList('post', $_POST);
		} else {
			$this->distributeList('get', $_GET);	
		}
	}
}

?>