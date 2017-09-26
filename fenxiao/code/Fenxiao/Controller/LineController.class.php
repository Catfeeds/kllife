<?php
namespace Fenxiao\Controller;
use Think\Controller;
use Core\Model\MyHelp;
use Core\Model\ModelBase;
use Core\Model\BackLineHelp;

define('LINE_PAGE_SHOW_COUNT', 10);

class LineController extends FxBaseController {
	
	private function lineList($aa) {
		if (!empty($aa['cds'])) {
			$postCDS = htmlspecialchars_decode($aa['cds']);
			$postCDS = explode('|',$postCDS);
			for($i = 0; $i < count($postCDS); $i+=3){
				if ($postCDS[$i] == 'set_type') {
					$condSetType = $postCDS[$i+2];
					continue;
				}
				$conds = appendLogicExp($postCDS[$i], $postCDS[$i+1], $postCDS[$i+2], 'AND', $conds);
			}
		}
		
		$thisPage = $aa['page'];
		if (empty($thisPage)) {
			$thisPage = 0;
		}
		$startIndex = $thisPage * LINE_PAGE_SHOW_COUNT;
		
		// 设置查找线路模式
		if (!empty($condSetType)) {
			if ($condSetType == 'slowly') {
				$themeType = MyHelp::TypeDataKey2Value('line_theme_xtmlx', true);
				if (is_error($themeType) === false) {
					$conds = appendLogicExp('theme_type', 'LIKE', '%'.$themeType['type_desc'].'%', 'AND', $conds);
				}
			} else if ($condSetType == 'qinglvpai'){
				$conds = appendLogicExp('qinglvpai', '>', '0', 'AND', $conds);
			} else if ($condSetType == 'sheying') {
				$themeType = MyHelp::TypeDataKey2Value('line_theme_sheying', true);
				if (is_error($themeType) === false) {
					$conds = appendLogicExp('theme_type', 'LIKE', '%'.$themeType['type_desc'].'%', 'AND', $conds);
				}
			}
		}
		
		$user = MyHelp::getLoginAccount();
		if (empty($user)) {
			$data['jumpUrl'] = UNLOGIN_URL;
			return $this->ajaxReturn($data);
		}
		
		if ($user['type_id_data']['type_key'] != 'distribute_user_vip1') {
			$conds = appendLogicExp('distribute', '=', '1', 'AND', $conds);		
		} 
		$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
		$conds = appendLogicExp('online', '=', '1', 'AND', $conds);
		
		$sort = array('online'=>'desc','recommend'=>'desc', 'hot'=>'desc','leader_recommend'=>'desc','create_time'=>'desc','sort'=>'asc');
		$find = array('min_batch'=>true,'batch'=>true);
		$ds = BackLineHelp::getLineList($conds, $startIndex, LINE_PAGE_SHOW_COUNT, $total, $sort, $find);
		
		$pageCount = intval($total / LINE_PAGE_SHOW_COUNT);
		if ($total % LINE_PAGE_SHOW_COUNT > 0) {
			$pageCount += 1;
		}
		
		$data['result'] = error(0,'');
		$data['page_count'] = $pageCount;
		$data['ds'] = $ds;
		return $this->ajaxReturn($data);
	}
	
	// 显示分销线路
	private function distributeList($requestType, $aa) {
		$user = MyHelp::getLoginAccount('false');
		if (is_error($user) === true) {
			if ($requestType == 'get') {
				redirect(UNLOGIN_URL);
			} else {
				$data['result'] = $user;
				$data['jumpUrl'] = U('user/login');
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
		$conds = appendLogicExp('user_id', '=', $user['id']);
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
			$this->assign('page_count', $pageCount);
			$this->assign('lines', $ds);
			$this->assign('modal_line_list', true);
			return $this->showPage('list', 'line', 'line', '我的分销');
		} else {
			$data['page_count'] = $pageCount;
			$data['ds'] = $ds;
			return $this->ajaxReturn($data);
		}
	}
	
	public function listAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'find_list') {
				$this->lineList($_POST);
			} else if ($type == 'list') {
				$this->distributeList('post', $_POST);
			} else {
				$data['result'] = error(-1, '错误的处理类型');
				return $this->ajaxReturn($data);	
			}			
		} else {
			$this->distributeList('get', $_GET);
		}
	}
	
	// 添加分销线路
	private function appendLineList($type) {	
		$user = MyHelp::getLoginAccount(false);
		if (is_error($user) === true) {
			$data['result'] = $user;
			$data['jumpUrl'] = U('user/login');
			return $this->ajaxReturn($data);
		}
		
		if ($type == 'list') {
			$idstr = I('post.idsstr', false);
			if (empty($idstr)) {
				$data['result'] = error(-1, '没有选择线路产品');
				return $this->ajaxReturn($data);
			}		
			$ids = explode('|', $idstr);
		} else if ($type == 'all') {
			$ids = array();
			$conds = appendLogicExp('distribute', '=', '1', 'AND', $conds);
			$conds = appendLogicExp('online', '=', '1', 'AND', $conds);
			$conds = appendLogicExp('extra', '!=', '1', 'AND', $conds);
			$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
			$lines = BackLineHelp::getLineList($conds, 0, 0, $total, array('sort'=>'asc'), false);
			foreach ($lines as $lk=>$lv) {
				
				array_push($ids, $lv['id']);
			}
		} 
		
		if (empty($ids)) {
			$data['result'] = error(-1, '没有可供添加的分销产品');
			return $this->ajaxReturn($data);
		}			
		
		$lineObj = ModelBase::getInstance('fx_line');		
		$rs = array();
		$isSuccess = true;
		$appendCount = 0;
		foreach($ids as $k=>$v) {
			$conds = appendLogicExp('user_id', '=', $user['id']);
			$conds = appendLogicExp('line_id', '=', $v, 'AND', $conds);
			$existCount = $lineObj->getCount($conds);
			array_push($rs, '[线路编号为:'.$v.'在分销列表存在'.$existCount.'个]');
			if (!empty($existCount)) {
				array_push($rs, '[线路编号为:'.$v.'的产品已被加入分销列表，请勿重复添加]');
				continue;
			}
			
			$ds['user_id'] = $user['id'];
			$ds['line_id'] = $v;
			$ds['sort'] = 1000;
			$result = $lineObj->create($ds, $bindId);
			if (error_ok($result) === false) {
				$isSuccess = false;					
			}
			array_push($rs, '['.a_2_s($result).',bindid:'.$bindId.',lineid:'.$v.']<br/>');
			$appendCount ++;
		}
		
		if ($isSuccess === true && $appendCount > 0) {
			$data['jumpUrl'] = U('line/list');
			$data['result'] = error(0, '添加分销线路成功'.a_2_s($rs));
		} else {
			$data['result'] = error(-1, '添加分销线路失败'.a_2_s($rs));
		}
		return $this->ajaxReturn($data);
	}
	
	// 添加分销线路
	public function appendAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'list') {
				$this->appendLineList($type);
			} else if ($type == 'all') {
				$this->appendLineList($type);
			} else {
				$data['result'] = error(-1, '错误的操作类型');
				return $this->ajaxReturn($data);
			}
		} else {
			return $this->showError('404', '请求错误', '错误的请求方式', '服务器收到的请求类型有误');
		}
	}
	
	// 排序分销线路
	public function sortAction() {
		if (IS_POST) {
			$bindId = I('post.bind_id', false);
			$sortIndex = I('post.sort_index', false);
			if (empty($bindId) || empty($sortIndex)) {
				$data['result'] = error(-1, '参数不全，不能进行排序调整');
				return $this->ajaxReturn($data);
			}
			
			$ds['sort'] = $sortIndex;
			$fxLineObj = ModelBase::getInstance('fx_line');
			$data['result'] = $fxLineObj->modify($ds, appendLogicExp('id', '=', $bindId));
			return $this->ajaxReturn($data);			
		} else {
			return $this->showError('404', '请求错误', '错误的请求方式', '服务器收到的请求类型有误');
		}
	}
	
	// 移除分销线路
	private function removeLine() {
		$bindId = I('post.bind_id', false);
		if (empty($bindId)) {
			$data['result'] = error(-1, '参数不全，不能移除该分销线路');
			return $this->ajaxReturn($data);
		}
		
		$fxLineObj = ModelBase::getInstance('fx_line');
		$result = $fxLineObj->remove(appendLogicExp('id', '=', $bindId));
		if (error_ok($result) === true) {
			$data['result'] = error(0, '移除分销线路成功');
		} else {
			$data['result'] = error(-1, '移除分销线路失败,Error:'.a_2_s($result));
		}
		return $this->ajaxReturn($data);
	}
	
	// 移除下架分销线路
	private function removeOffline() {
		$user = MyHelp::getLoginAccount(false);
		if (is_error($user) === true) {
			$data['result'] = $user;
			$data['jumpUrl'] = U('user/login');
			return $this->ajaxReturn($data);
		}
		
		$fxLineObj = ModelBase::getInstance('fx_line');
		$fxLines = $fxLineObj->getAll(appendLogicExp('user_id', '=', $user['id']));
		$data['ds'] = $fxLines;
		foreach ($fxLines as $lk=>$lv) {
			$line = BackLineHelp::getLine(appendLogicExp('id', '=', $lv['line_id']));
			if (!empty($line)) {
				if (intval($line['online']) === 0 || 
					intval($line['distribute']) === 0 || 
					intval($line['invalid']) === 1) {
					if (empty($idstr)) {
						$idstr = $lv['id'];
					} else {
						$idstr .= ','.$lv['id'];
					}
				}
			}
		}
		
		if (empty($idstr)) {
			$data['result'] = error(-1, '没有下架的分销产品');
			return $this->ajaxReturn($data);
		}
		
		$conds = appendLogicExp('id', 'IN', '('.$idstr.')');
		$result = $fxLineObj->remove($conds);
		if (error_ok($result) === true) {
			$data['jumpUrl'] = U('line/list');
			$data['result'] = error(0, '移除下架分销产品成功');
		} else {
			$data['result'] = error(-1, '移除下架分销产品失败,Error:'.a_2_s($result));
		}
		return $this->ajaxReturn($data);
	}
	
	// 移除分销线路
	public function removeAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'one') {
				$this->removeLine();
			} else if ($type == 'offline') {
				$this->removeOffline();
			} else {
				$data['result'] = error(-1, '错误的操作类型');
				return $this->ajaxReturn($data);
			}
		} else {
			return $this->showError('404', '请求错误', '错误的请求方式', '服务器收到的请求类型有误');
		}
	}
}

?>