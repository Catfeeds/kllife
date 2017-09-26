<?php
namespace Phone\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackOrderHelp;
use Core\Model\BackAccountHelp;


class IndexController extends PhoneBaseController {
	
	protected function _initialize(){		
		$this->page_title = '首页';
		$this->menu_active = 'home';
	}
	
	public function welcomeAction(){
		// 获取当前站点
		$station = MyHelp::getStationByIP();
		$thisStationKey = I('get.station', false);
		if (!empty($thisStationKey) && $thisStationKey != $station['key']) {
			$station = MyHelp::getStationByIP('', true);
		}
		
		// 获取首页设置
		$sets = MyHelp::getStationHomeSet($station['id']);
		$this->assign('set', $sets);
		
		// 获取首页菜单
		$menuItems = S('pc_home_top_menu');
		if (empty($menuItems) || MyHelp::checkConfigOverdue('pc_home_top_menu', $menuItems['config_update_time']) === true) {
			$menuItems = MyHelp::getMenuList('pc_home_menu', 0, true, false, $out);
			$menuItems['config_update_time'] = MyHelp::getConfigUpdateTime('pc_home_top_menu');
			S('pc_home_top_menu', $menuItems, 0);
		}
		$this->assign('menus', $menuItems);
		
		// 获取首页左侧导航配置
		$leftMenuItems = S('pc_home_left_menu');
		if (empty($leftMenuItems) || MyHelp::checkConfigOverdue('pc_home_left_menu', $leftMenuItems['config_update_time']) === true) {
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
			$leftMenuItems['config_update_time'] = MyHelp::getConfigUpdateTime('pc_home_left_menu');
			S('pc_home_left_menu', $leftMenuItems, 0);
		}
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
			'`q1`.`addtime`'=>'`addtime`',
			'`q2`.`title`'=>'`lineid_title`',
		);
		$params['join'] = array('LEFT JOIN `kl_line` AS `q2` ON `q1`.`lineid` = `q2`.`id`');		
		$params['sort'] = array('`q1`.`addtime`'=>'desc');
		$params['limit'] = array(0, 10);
		
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$topSignupOrders = $orderObj->queryData($params, $total);
		foreach ($topSignupOrders as $tk=>$tv) {
			if (!empty($tv['mob']) && strlen($tv['mob']) == 11) {
				$tv['mob_show'] = substr($tv['mob'], 0, '3').'****'.substr($tv['mob'], 7);
				$tv['order_time'] = date('Y-m-d H:i:s', $tv['addtime']);		
				$agoTime = fmtDateTimeToNow(intval($tv['addtime']), true);
				$tv['addtime_short_show'] = $agoTime['ago_show_text'];
				$tv['title_short_show'] = $tv['lineid_title'];
				if (mb_strlen($tv['lineid_title'],'utf8') > 8) {
					$tv['title_short_show'] = mb_substr($tv['lineid_title'], 0, 8, 'utf8').'...';	
				}
				$topSignupOrders[$tk] = $tv;	
			}
		}
		$this->assign('orders', $topSignupOrders);	
		
		$this->showPage('welcome', 'index_welcome', 'index', '欢迎', '欢迎来到领袖户外');
	}
	
	public function welcome1Action(){
		// 获取当前站点
		$station = MyHelp::getStationByIP();
		$thisStationKey = I('get.station', false);
		if (!empty($thisStationKey) && $thisStationKey != $station['key']) {
			$station = MyHelp::getStationByIP('', true);
		}
		
		// 获取首页设置
		$sets = MyHelp::getStationHomeSet($station['id']);
		$this->assign('set', $sets);
		
		// 获取首页菜单
		$menuItems = S('pc_home_top_menu');
		if (empty($menuItems) || MyHelp::checkConfigOverdue('pc_home_top_menu', $menuItems['config_update_time']) === true) {
			$menuItems = MyHelp::getMenuList('pc_home_menu', 0, true, false, $out);
			$menuItems['config_update_time'] = MyHelp::getConfigUpdateTime('pc_home_top_menu');
			S('pc_home_top_menu', $menuItems, 0);
		}
		$this->assign('menus', $menuItems);
		
		// 获取首页左侧导航配置
		$leftMenuItems = S('pc_home_left_menu');
		if (empty($leftMenuItems) || MyHelp::checkConfigOverdue('pc_home_left_menu', $leftMenuItems['config_update_time']) === true) {
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
			$leftMenuItems['config_update_time'] = MyHelp::getConfigUpdateTime('pc_home_left_menu');
			S('pc_home_left_menu', $leftMenuItems, 0);
		}
		$this->assign('left_menus', $leftMenuItems);
		
		// 获取最前前十个报名客户
		$orders = BackOrderHelp::getOrderList(array(),0,10,$total,array('addtime'=>'desc'));
		$fill = array('line'=>true);
		$orders = BackOrderHelp::fillNewOrderInfo($orders,$fill);
		foreach ($orders as $ok=>$ov) {	
			$ov['order_time'] = date('Y-m-d H:i:s', $ov['addtime']);		
			$agoTime = fmtDateTimeToNow(intval($ov['addtime']), true);
			$ov['addtime_short_show'] = $agoTime['ago_show_text'];
			$ov['title_short_show'] = $ov['lineid_title'];
			if (mb_strlen($ov['lineid_title'],'utf8') > 8) {
				$ov['title_short_show'] = mb_substr($ov['lineid_title'], 0, 8, 'utf8').'...';	
			}
			$orders[$ok] = $ov;
		}
		$this->assign('orders', $orders);	
			
		$this->showPage('welcome1', 'index_welcome', 'index', '欢迎', '欢迎来到领袖户外');
	}
	
	public function urlAction() {
		if (IS_POST) {
			$type = I('post.type',false);
			if ($type == 'nav_mine') {
				if (MyHelp::isLoginAccount() === false) {
					$data['jumpUrl'] = U('user/login');
				} else {
					$data['jumpUrl'] = U('user/info');
				}
				$data['result'] = error(0, '');
			} else {
				$data['result'] = error(-1, '请求的链接类型不明确');
			}
			$this->ajaxReturn($data);
		} else {
			$this->display('common/error');
		}
	}
	
	public function testAction() {
		
		$this->showError('501', '错误测试', '这是一个错误测试', '没有什么原因,这就是一个错误测试', '建议您看看就得了');
	}
}

?>