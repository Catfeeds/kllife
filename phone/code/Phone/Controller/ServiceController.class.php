<?php
namespace Phone\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackLineHelp;

class ServiceController extends PhoneBaseController {	
	public function questionAction() {
		if (IS_GET) {
			$id = I('get.id', false);
			if (!empty($id)) {
				$conds = appendLogicExp('id', '=', $id);
				$showQuestion = BackLineHelp::getQuestion($conds, array('answer'=>true));
				if (is_error($showQuestion) === false) {
					$this->assign('show_question', $showQuestion);	
				}
			}
			
			$this->showPage('question');
			
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