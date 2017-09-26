<?php

namespace Phone\Controller;
use Core\Model\ModelBase;
use Core\Model\BackAccountHelp;
use Core\Model\BackLineHelp;
use Core\Model\MyHelp;

define('LINE_PAGE_SHOW_COUNT', 8);

class FenxiaoController extends PhoneBaseController {
	
	protected function _initialize(){		
		$this->page_title = '首页';
		$this->menu_active = 'home';
	}	
	
	public function welcomeAction(){
		if (IS_GET) {
			$dUserId = I('get.duid', false);	
		} else {
			$dUserId = I('post.duid', false);	
		}
			
		$duser = BackAccountHelp::getAccount('account_distribute', appendLogicExp('id', '=', $dUserId));		
		if (is_error($duser) === true) {
			if (IS_GET) {
				return $this->showError('404', '分销用户错误', '找不到分销用户', '该用户可能不存在或者被拉黑');
			} else {
				$data['result'] = $duser;
				return $this->ajaxReturn($data);
			}
		}
		
		if (IS_GET) {			
			$this->assign('duid', $dUserId);
			
			$fxset = S('fenxiao_index_set_'.$dUserId);
			if (empty($fxset) || MyHelp::checkConfigOverdue('fenxiao_index_config_'.$dUserId, $fxset['config_update_time']) === true) {		
				$conds = appendLogicExp('user_id', '=', $duser['id']);
				$fxset = $this->getFenxiaoConfig($conds);
				$fxset['config_update_time'] = MyHelp::getConfigUpdateTime('fenxiao_index_config_'.$dUserId);
				S('fenxiao_index_set_'.$dUserId, $fxset, 0);
			}
			$this->assign('fxset', $fxset);
						
			$modalTypes[0] = array('title'=>'精选线路', 'type'=>'choiceness');
			$modalTypes[1] = array('title'=>'小团慢旅行','type'=>'slowly');
			$modalTypes[2] = array('title'=>'摄影游','type'=>'sheying');
			$modalTypes[3] = array('title'=>'新旅拍','type'=>'qinglvpai');
			
			foreach ($modalTypes as $mk=>$mv) {
				$mv['show'] = 0;
				foreach($fxset as $sk=>$sv) {
					if (strpos($sk, $mv['type']) !== FALSE) {
						$mv['show'] = 1;
						break;
					}
				}
				$modalTypes[$mk] = $mv;
			}
			
			$this->assign('modal_types', $modalTypes);			
			
			$pageTitle = $fxset['shop_title']['data']['value'];
			if (empty($pageTitle)) {
				$pageTitle = '分销首页';
			}		
			return $this->showPage('fenxiao/welcome', 'fenxiao_welcome', 'fenxiao', $pageTitle);
		}
	}
		
	// 显示分销线路
	public function listAction() {
		if (IS_POST) {
			$dUserId = I('post.duid', false);	
			$thisPage = I('post.page', 0);
		} else {	
			$dUserId = I('get.duid', false);
			$thisPage = I('get.page', 0);
		}
			
		$duser = BackAccountHelp::getAccount('account_distribute', appendLogicExp('id', '=', $dUserId));		
		if (is_error($duser) === true) {
			if (IS_POST) {
				$data['result'] = $duser;
				return $this->ajaxReturn($data);
			} else {
				return $this->showError('404', '分销用户错误', '找不到分销用户', '该用户可能不存在或者被拉黑');
			}
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
		
		if (IS_POST) {
			$data['result'] = error(0,'');
			$data['page_size'] = LINE_PAGE_SHOW_COUNT;
			$data['page_count'] = $pageCount;
			$data['ds'] = $ds;
			return $this->ajaxReturn($data);					
		} else {
			$this->assign('duser', $duser);	
			$this->assign('duid', $duser['id']);		
			$this->assign('page_count', $pageCount);
			$this->assign('lines', $ds);
			return $this->showPage('fenxiao/list', 'fenxiao_list', 'fenxiao', '首页');
		}
	}
}

?>