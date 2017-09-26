<?php

namespace Home\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\MsgHelp;
use Core\Model\BackAccountHelp;
use Core\Model\BackOrderHelp;

class IndexController extends HomeBaseController {
	
	protected function _initialize(){		
		$this->page_title = '首页';
		$this->menu_active = 'home';
	}
	
	//调用SEO文章
	private function seoArticleList(){
		if(IS_GET){
			$refresh = I('get.refresh', false);
			$seoinfo = S('pc_index_seo_cache');
			if(empty($seoinfo) || !empty($refresh)){
				$result = MyHelp::getPageList('seo_article', 'invalid|=|0|AND', 0, 6, array('id'=>'desc'), 4, $out);
				if(!empty($result['ds'])){
					$seoinfo = $result['ds'];
				}else{
					$seoinfo = '未查找到数据';
				}			
				S('pc_index_seo_cache', $seoinfo, 0);
			}
			$this->assign('seoout', $out);
			$this->assign('seoarticles', $seoinfo);
		}
	}
	
	public function welcomeAction(){		
		G('begin');		
		
		// 获取当前站点
		$station = MyHelp::getStationByIP();
		$thisStationKey = I('get.station', false);
		if (!empty($thisStationKey) && $thisStationKey != $station['key']) {
			$station = BackAccountHelp::StationTypeKey2Value($thisStationKey, true);
			if (!empty($station) && is_error($station) === false) {
				session_start();
				session('station', $station);
			}
		}
		
		// 获取首页设置
		$sets = MyHelp::getStationHomeSet($station['id']);
		$this->assign('set', $sets);
		
		// 获取首页左侧导航配置
//		$leftMenuItems = S('pc_home_left_menu');
//		if (empty($leftMenuItems) || MyHelp::checkConfigOverdue('pc_home_left_menu', $leftMenuItems['config_update_time']) === true) {
			$leftMenuItems = MyHelp::getMenuList('pc_home_left_menu', 0, true, false, $out);
			foreach ($leftMenuItems as $lk=>$lv) {
				$curWord = 0;
				foreach ($lv['child'] as $ck=>$cv) {
					$len = mb_strlen($cv['item_desc'] ,'utf8');
					$curWord += $len;
					if ($curWord > 24) {
						$cv['left_menu_not_show'] = true;
					}
					$lv['child'][$ck] = $cv;
				}
				$leftMenuItems[$lk] = $lv;
			}
//			$leftMenuItems['config_update_time'] = MyHelp::getConfigUpdateTime('pc_home_left_menu');
//			S('pc_home_left_menu', $leftMenuItems, 0);
//		}
		$this->assign('left_menus', $leftMenuItems);
		
		// 获取最前前十个报名客户
		$conds = appendLogicExp('`q1`.`order_sn`', 'NOT LIKE', '%YD-%', 'AND', $conds);
		$params['conds'] = $conds;
		$params['table'] = '`xz_lineenertname` AS `q1`';
		$params['col'] = array(
			'`q1`.`id`'=>'`id`',
			'`q1`.`lineid`'=>'`lineid`',
			'`q1`.`mob`'=>'`mob`',
			'`q1`.`order_sn`'=>'`order_sn`',
			'`q2`.`title`'=>'`lineid_title`',
		);
		$params['join'] = array('LEFT JOIN `kl_line` AS `q2` ON `q1`.`lineid` = `q2`.`id`');		
		$params['sort'] = array('`q1`.`addtime`'=>'desc');
		$params['limit'] = array(0, 10);
		
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$topSignupOrders = $orderObj->queryData($params, $total);
		$this->assign('sql', $orderObj->getLastSql());
		foreach ($topSignupOrders as $tk=>$tv) {
			if (!empty($tv['mob']) && strlen($tv['mob']) == 11) {
				$tv['mob_show'] = substr($tv['mob'], 0, '3').'****'.substr($tv['mob'], 7);
				$topSignupOrders[$tk] = $tv;	
			}
		}
		$this->assign('top_signup_orders', $topSignupOrders);
		
		//调用SEO文章
		$this->seoArticleList();
		G('end');
				
//		$this->assign('t1', G('begin', 'end').'s');		
		$this->showPage('welcome', 'index_welcome', 'index', '欢迎');
			// session时间结束，重新缓存
	}
	
	public function testAction() {	
		// 获取首页设计
		G('begin');				
		
		// 获取当前站点
		$station = MyHelp::getStationByIP();
		$thisStationKey = I('get.station', false);
		if (!empty($thisStationKey) && $thisStationKey != $station['key']) {
			$station = BackAccountHelp::StationTypeKey2Value($thisStationKey, true);
			if (!empty($station) && is_error($station) === false) {
				session_start();
				session('station', $station);
			}
		}
		
		// 获取首页设置
		$sets = MyHelp::getStationHomeSet($station['id']);
		$this->assign('set', $sets);
		
		// 获取首页左侧导航配置
//		$leftMenuItems = S('pc_home_left_menu');
//		if (empty($leftMenuItems) || MyHelp::checkConfigOverdue('pc_home_left_menu', $leftMenuItems['config_update_time']) === true) {
			$leftMenuItems = MyHelp::getMenuList('pc_home_left_menu', 0, true, false, $out);
			foreach ($leftMenuItems as $lk=>$lv) {
				$curWord = 0;
				foreach ($lv['child'] as $ck=>$cv) {
					$len = mb_strlen($cv['item_desc'] ,'utf8');
					$curWord += $len;
					if ($curWord > 24) {
						$cv['left_menu_not_show'] = true;
					}
					$lv['child'][$ck] = $cv;
				}
				$leftMenuItems[$lk] = $lv;
			}
//			$leftMenuItems['config_update_time'] = MyHelp::getConfigUpdateTime('pc_home_left_menu');
//			S('pc_home_left_menu', $leftMenuItems, 0);
//		}
		$this->assign('left_menus', $leftMenuItems);
		
		// 获取最前前十个报名客户
		$refresh = I('get.refresh', false);
		$topSignupOrders = S('top_signup_orders');
		if (empty($topSignupOrders) || !empty($refresh)) {
			$topSignupOrders = BackOrderHelp::getOrderList(array(),0,20,$total,array('addtime'=>'desc'));
			$topSignupOrders = BackOrderHelp::fillNewOrderInfo($topSignupOrders,array('line'=>true));
		}
		$this->assign('top_signup_orders', $topSignupOrders);
		
		G('end');
				
//		$this->assign('t1', G('begin', 'end').'s');		
		$this->showPage('test', 'index_welcome', 'index', '欢迎');
//		$this->showError('501', '错误测试', '这是一个错误测试', '没有什么原因,这就是一个错误测试', '建议您看看就得了');
	}


}

?>