<?php
namespace Qinglvpai\Controller;
use Think\Controller;
use Core\Model\MyHelp;
use Core\Model\ModelBase;
use Core\Model\BackFinancialHelp;

define('LEADER_PAGE_SHOW_COUNT', 10);
define('LEADER_QUESTION_SHOW_PAGE_COUNT', 20);
define('LEADER_PICTRUE_SHOW_PAGE_COUNT', 20);

class LeaderController extends QlpBaseController {
	
	// 查找领队列表
	private function listLeader($requestType) {
		if ($requestType == 'post') {
			$page = I('post.page', 0);
			$cds = I('post.cds', false);
			if (!empty($cds)) {
				$cdList = explode('|', $cds);	
				for ($i = 0; $i < count($cdList); $i+=3) {
					$conds = appendLogicExp($cdList[$i], $cdList[$i+1], $cdList[$i+2], 'AND', $conds);
				}
			}			
		} else {
			$page = I('get.page', 0);
		}
		
		$startIndex = $page * LEADER_PAGE_SHOW_COUNT;
		$conds = appendLogicExp('type', 'LIKE', '%cj_leader_type_sheying%', 'AND', $conds);
		$conds = appendLogicExp('owner', 'LIKE', '%cj_leader_owner_main_mkm%', 'AND', $conds);
		$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
		$result = BackFinancialHelp::getSourceList('leader', $conds, $startIndex, LEADER_PAGE_SHOW_COUNT, array('star_level'=>'desc'));
		
		foreach ($result['ds'] as $dk=>$dv) {
			if (!empty($dv['nickname'])) {
				$dv['show_name'] = $dv['nickname'];	
			} else if (!empty($dv['stagename'])) {
				$dv['show_name'] = $dv['stagename'];
			} else if (!empty($dv['name'])) {
				$dv['show_name'] = $dv['name'];
			} 
			$result['ds'][$dk] = $dv;
		}
				
		if ($requestType == 'get') {
			$this->assign('page_count', $result['page_count']);
			$this->assign('leaders', $result['ds']);
			$this->assign('page_size', LEADER_PAGE_SHOW_COUNT);	
			$this->showPage('list', 'leader_list', 'leader', '领队列表');
		} else {
			$data['result'] = error(0,'');
			$data['ds'] = $result['ds'];
			$data['page_count'] = $result['page_count'];
			$data['page_size'] = LEADER_PAGE_SHOW_COUNT;
			$this->ajaxReturn($data);
		}
	}
	
	// 查找领队列表
	private function findLeader($requestType) {
		if ($requestType == 'post') {
			$id = I('post.id', false);
			if (empty($id)) {
				$data['result'] = error(-1, '查找的参数不足');
				return $this->ajaxReturn($data);
			}
			
			$conds = appendLogicExp('id', '=', $id);
//			$ds = BackLineHelp::getLeader($conds, true);
			
			$imageTextList = array();
			if (!empty($ds['content'])) {
				foreach ($ds['content'] as $ck=>$cv) {
					if (empty($cv['content'])) {
						if (!empty($imageList['image'])) {
							array_push($imageTextList, $imageList);
						}
						$imageList = array('image'=>$cv['image_url']);
					} else {
						if (empty($imageList['text'])) {
							$imageList['text'] = $cv['content'];
						} else {					
							$imageList['text'] = $imageList['text'].'<br />'.$cv['content'];
						}
					}
				}	
			}
			if (!empty($imageList)) {
				array_push($imageTextList, $imageList);
			}
			$ds['image_text_list'] = $imageTextList;			
			$data['result'] = error(0,'');
			$data['ds'] = $ds;
			
			$this->ajaxReturn($data);
		}
	}
	
	public function listAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'list') {
				$this->listLeader('post');
			} if ($type == 'find') {
				$this->findLeader('post');
			} else {
				$data['result'] = error(-1, '错误的处理类型');
				return $this->ajaxReturn($data);	
			}
		} else {
			$this->listLeader('get');
		}
	}
	
	// 领队问题列表
	private function leaderQuestion() {
		$page = 0;
		if (IS_POST) {
			$page = I('post.page', 0);
			$leader_id = I('post.leader_id', 0);
			if (empty($leader_id)) {
				$data['result'] = error(-1, '错误的领队');
				return $this->ajaxReturn($data);
			}
		} else {
			$leader_id = I('get.id', false);
			if (empty($leader_id)) {
				$data['result'] = error(-1, '错误的领队');
				return $this->showError('501', '领队错误', '领队编号有误', '领队编号参数有误');
			}
		}
		
		$startIndex = $page * LEADER_QUESTION_SHOW_PAGE_COUNT;
		
		$qeustObj = ModelBase::getInstance('cj_leader_question');
		$conds = appendLogicExp('leader_id', '=', $leader_id);
		$conds = appendLogicExp('question_id', '=', 0, 'AND', $conds);
		$question = $qeustObj->getAll($conds, $startIndex, LEADER_QUESTION_SHOW_PAGE_COUNT, $total, array('create_time'=>'asc'));
		foreach ($question as $qk=>$qv) {			
			$answerConds = appendLogicExp('leader_id', '=', $leader_id);	
			$answerConds = appendLogicExp('question_id', '=', $qv['id'], 'AND', $answerConds);
			$qv['answers'] = $qeustObj->getAll ($answerConds, 0, 0, $answerTotal, array('create_time'=>'desc'));
			$question[$qk] = $qv;
		}
		
		$pageCount = intval($total / LEADER_QUESTION_SHOW_PAGE_COUNT);
		if (intval($total % LEADER_QUESTION_SHOW_PAGE_COUNT) > 0) {
			$pageCount ++;
		}
		
		if (IS_POST) {
			$data['page_size'] = LEADER_QUESTION_SHOW_PAGE_COUNT;
			$data['page_count'] = $pageCount;
			$data['ds'] = $question;
			
		} else {
			$this->assign('questions', $question);
			$this->assign('question_page_count', $pageCount);
			$this->assign('question_page_size', LEADER_QUESTION_SHOW_PAGE_COUNT);
		}
	}
	
	//领队作品列表
	private function leaderPicture() {
		$page = 0;
		if (IS_POST) {
			$page = I('post.page', 0);
			$leader_id = I('post.leader_id', 0);
			if (empty($leader_id)) {
				$data['result'] = error(-1, '错误的领队');
				return $this->ajaxReturn($data);
			}
		} else {
			$leader_id = I('get.id', false);
			if (empty($leader_id)) {
				$data['result'] = error(-1, '错误的领队');
				return $this->showError('501', '领队错误', '领队编号有误', '领队编号参数有误');
			}
		}
		
		$startIndex = $page * LEADER_PICTRUE_SHOW_PAGE_COUNT;
		
		$pictureObj = ModelBase::getInstance('cj_leader_picture');
		$conds = appendLogicExp('leader_id', '=', $leader_id);
		$conds = appendLogicExp('invalid', '!=', '1', 'AND', $conds);
		$pictures = $pictureObj->getAll($conds, $startIndex, LEADER_PICTRUE_SHOW_PAGE_COUNT, $total, array('create_time'=>'desc'));
		
		$pageCount = intval($total / LEADER_PICTRUE_SHOW_PAGE_COUNT);
		if (intval($total % LEADER_PICTRUE_SHOW_PAGE_COUNT) > 0) {
			$pageCount ++;
		}
		
		if (IS_POST) {
			$data['page_size'] = LEADER_PICTRUE_SHOW_PAGE_COUNT;
			$data['page_count'] = $pageCount;
			$data['ds'] = $question;
			
		} else {
			$this->assign('pictures', $pictures);
			$this->assign('picture_page_count', $pageCount);
			$this->assign('picture_page_size', LEADER_PICTRUE_SHOW_PAGE_COUNT);
		}
	}
	
	// 领队详细
	public function infoAction() {
		$id = I('get.id', false);
		if (empty($id)) {
			return $this->showError('501', '参数错误', '参数错误，页面无法正常显示');
		}
		
		$leader = BackFinancialHelp::getSource('leader', appendLogicExp('id', '=', $id));				
		if (strpos($leader['owner'], 'cj_leader_owner_main_mkm') === FALSE ||
			strpos($leader['type'], 'cj_leader_type_sheying') === FALSE ||
			$leader['invalid'] != 0) {
			return $this->showError('503', '无法访问', '领队不存在或者访问的信息有误，页面无法正常显示');
		}
				
		$this->assign('leader', $leader);
		
		// 领队问答
		$this->leaderQuestion();			
		// 领队作品
		$this->leaderPicture();
		
		
		$this->assign('leader', $leader);
		$this->showPage('info', 'leader_info', 'leader', '领队详细');
	}
	
	
}

?>