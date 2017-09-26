<?php
namespace Home\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackLineHelp;

class ServiceController extends HomeBaseController {	
	public function questionAction() {
		if (IS_GET) {
			$questClass = array(
				'question_type_book'=>'about-reserve',
				'question_type_account'=>'account-management',
				'question_type_agreement'=>'about-contract',
				'question_type_pay'=>'pay-invoice',
				'question_type_insurance'=>'travel-insurance',
				'question_type_other'=>'else-problem',
			);
			
			$questType = array();
			$quest_type = MyHelp::getTypeData('question_type');
			if (is_error($quest_type) === false) {
				foreach ($quest_type as $qk=>$qv) {					
					if (!array_key_exists($qv['type_key'], $questClass)) {
						continue;
					}
					$conds = appendLogicExp('type_id', '=', $qv['id']);
					$conds = appendLogicExp('question_id', '=', '0', 'AND', $conds);
					$questions = BackLineHelp::getQuestionList($conds, 0, 0, $total, array('create_time'), false);
					$qv['questions'] = $questions;
					$qv['class'] = $questClass[$qv['type_key']];					
					array_push($questType, $qv);									
				}
			}			
			$this->assign('service_question', $questType);	
			
			$id = I('get.id', false);
			if (!empty($id)) {
				$conds = appendLogicExp('id', '=', $id);
				$showQuestion = BackLineHelp::getQuestion($conds, array('answer'=>true));
				if (is_error($showQuestion) === false) {
					$this->assign('show_question', $showQuestion);	
				}
			}
			
			$this->showPage('question');
			
		} else if (IS_POST) {			
			$id = I('post.id', false);
			if (empty($id)) {
				$data['result'] = error(-1, '参数不齐全');
				return $this->ajaxReturn($data);
			}
			
			$conds = appendLogicExp('id', '=', $id);
			$question = BackLineHelp::getQuestion($conds, array('answer'=>true));
			if (is_error($question) === false) {
				$data['ds'] = $question;
				$data['result'] = error(0, '');
			} else {
				$data['result'] = $question;					
			}
			$this->ajaxReturn($data);
		} else {
			$this->showError('502', '请求错误', '问题的请求类型错误', '问题的请求类型错误');
		}
	}
	
	public function centerAction() {
		if (IS_GET) {
			$questClass = array(
				'question_type_book'=>'',
				'question_type_account'=>'clear-right-border',
				'question_type_agreement'=>'clear-bottom-border',
				'question_type_pay'=>'',
				'question_type_insurance'=>'clear-bottom-border',
				'question_type_other'=>'clear-right-border clear-bottom-border',
			);
			
			$questType = array();
			$quest_type = MyHelp::getTypeData('question_type');
			if (is_error($quest_type) === false) {
				foreach ($quest_type as $qk=>$qv) {
					if (!array_key_exists($qv['type_key'], $questClass)) {
						continue;
					}
					$conds = appendLogicExp('type_id', '=', $qv['id']);
					$conds = appendLogicExp('question_id', '=', '0', 'AND', $conds);
					$questions = BackLineHelp::getQuestionList($conds, 0, 0, $total, array('create_time'), false);
					$qv['questions'] = $questions;
					$qv['class'] = $questClass[$qv['type_key']];					
					array_push($questType, $qv);
				}
			}		
			$this->assign('service_question', $questType);
			$this->showPage('service_center');
		} else {
			$this->display('Common/error');
		}
	}
}

?>