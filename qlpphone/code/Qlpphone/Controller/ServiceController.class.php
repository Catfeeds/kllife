<?php
namespace Qlpphone\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackLineHelp;

class ServiceController extends QlpBaseController {	
	public function questionAction() {
		if (IS_GET) {
			$questClass = array(
				'question_qinglvpai_type_offen'=>'about-reserve',
				'question_qinglvpai_type_regist_login'=>'account-management',
				'question_qinglvpai_type_activity'=>'about-contract',
				'question_qinglvpai_type_pay'=>'pay-invoice',
			);
			
			$questType = array();
			$quest_type = MyHelp::getTypeData('question_qinglvpai_type');
			if (is_error($quest_type) === false) {
				foreach ($quest_type as $qk=>$qv) {					
					if (!array_key_exists($qv['type_key'], $questClass)) {
						continue;
					}
					$conds = appendLogicExp('type_id', '=', $qv['id']);
					$conds = appendLogicExp('question_id', '=', '0', 'AND', $conds);
					$questions = BackLineHelp::getQuestionList($conds, 0, 0, $total, array('create_time'=>'desc'), false);
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
			$this->showPage('question', 'service_question', 'service', '问题详细');
			
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
				'question_qinglvpai_type_offen'=>'about-reserve',
				'question_qinglvpai_type_regist_login'=>'account-management',
				'question_qinglvpai_type_activity'=>'about-contract',
				'question_qinglvpai_type_pay'=>'pay-invoice',
			);
			
			$questType = array();
			$quest_type = MyHelp::getTypeData('question_qinglvpai_type');
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
			$this->showPage('service_center', 'service-center', 'service', '帮助中心');
		} else {
			$data['result'] = error(-1, '错误的请求');
			$this->ajaxReturn($data);
		}
	}
}

?>