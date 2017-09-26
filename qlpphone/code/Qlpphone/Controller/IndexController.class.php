<?php
namespace Qlpphone\Controller;
use Think\Controller;
use Core\Model\BackFinancialHelp;

class IndexController extends QlpBaseController {
	
	public function welcomeAction() {
		// 显示领队
		$conds = appendLogicExp('type', 'LIKE', '%cj_leader_type_sheying%', 'AND', $conds);
		$conds = appendLogicExp('owner', 'LIKE', '%cj_leader_owner_main_mkm%', 'AND', $conds);
		$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
		$result = BackFinancialHelp::getSourceList('leader', $conds, 0, 4, array('star_level'=>'desc'));
		$this->assign('leaders', $result['ds']);
		
		$this->showPage('welcome', 'index_welcome', 'index', '首页', '首页');
	}
	
	
	public function storyAction() {		
		$this->showPage('story', 'index_story', 'index', '品牌故事', '品牌故事');		
	}
	
	public function testAction() {
		
		$this->showError('501', '错误测试', '这是一个错误测试', '没有什么原因,这就是一个错误测试', '建议您看看就得了');
		
	}
	
}

?>