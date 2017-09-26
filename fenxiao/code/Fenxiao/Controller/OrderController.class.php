<?php
namespace Fenxiao\Controller;
use Think\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackOrderHelp;

define('ORDER_PAGE_SHOW_COUNT', 10);

class OrderController extends FxBaseController {
	
	public function distributeOrder($requestType, $aa) {
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
		$startIndex = $thisPage * ORDER_PAGE_SHOW_COUNT;
		
		$fxOrderObj = ModelBase::getInstance('fx_order');
		$conds = appendLogicExp('user_id', '=', $user['id']);
		$fxOrders = $fxOrderObj->getAll($conds, $startIndex, ORDER_PAGE_SHOW_COUNT, $total, array('create_time'=>'desc'));
		
		$ds = array();
		$fill = array('state'=>true, 'line'=>true,'batch'=>true);
		foreach ($fxOrders as $k => $v) {
			$order = BackOrderHelp::getOrderInfo($v['order_id']);
			$order = BackOrderHelp::fillNewOrderInfo($order, $fill);
			
			if ($order['lineid_data_type'] == 'line') {
				$adultCount = intval($order['male']) + intval($order['woman']);
				$childCount = intval($order['child']);
				$order['sum_commision_adult'] = bcmul($adultCount, $v['commision_adult'], 2);
				$order['sum_commision_child'] = bcmul($childCount, $v['commision_child'], 2);
				$order['sum_commision'] = bcadd(floatval($order['sum_commision_adult']), floatval($order['sum_commision_child']), 2);
				$order['commision'] = '单人：'.$v['commision_adult'].'元/'.$v['commision_child'].'元<br />总计：'.$order['sum_commision'];
			} else {
				$order['commision'] = '单人：0.00元/0.00元<br />总计：0.00元';
			}
			
			$order['bind_user_id'] = $v['user_id'];
			$order['bind_id'] = $v['id'];
			$order['bind_settle_account'] = $v['settle_account'];
			$order['bind_create_time'] = $v['create_time'];
			array_push($ds, $order);
		}
		
		$pageCount = intval($total / ORDER_PAGE_SHOW_COUNT);
		if ($total % ORDER_PAGE_SHOW_COUNT > 0) {
			$pageCount += 1;
		}
				
		if ($requestType == 'get') {			
			// 获取总人数
			$params['table'] = '`kl_fx_order` AS `q1`';
			$params['col'] = array(
				'SUM(`q2`.`male`)'=>'`male`',
				'SUM(`q2`.`woman`)'=>'`woman`',
				'SUM(`q2`.`child`)'=>'`child`',
			);
			$conds = appendLogicExp('`q1`.`user_id`', '=', $user['id']);
			$conds = appendLogicExp('`q2`.`zhuangtai`', 'NOT IN', '(3,4,5,13)', 'AND', $conds);
			$params['join'] = array('LEFT JOIN `xz_lineenertname` AS `q2` ON `q1`.`order_id` = `q2`.`id`');
			$params['conds'] = $conds;
			$memberCount = $fxOrderObj->queryData($params, $total);
			$this->assign('sql', $fxOrderObj->getLastSql());
			if (!empty($memberCount)) {
				$memberCount = array('adult'=>0, 'male'=>$memberCount[0]['male'], 'woman'=>$memberCount[0]['woman'], 'child'=>$memberCount[0]['child']);
				$memberCount['adult'] = intval($memberCount['male']) + intval($memberCount['woman']);
			} else {
				$memberCount = array('adult'=>0, 'male'=>0, 'woman'=>0, 'child'=>0);
			}
			$this->assign('member_count', $memberCount);
			
			$this->assign('page_count', $pageCount);
			$this->assign('orders', $ds);
			$this->assign('modal_line_list', true);
			return $this->showPage('order', 'order', 'order', '我的订单');
		} else {
			$data['page_count'] = $pageCount;
			$data['ds'] = $ds;
			$data['result'] = error(0, '');
			return $this->ajaxReturn($data);
		}
	}
	
	public function listAction() {
		if (IS_POST) {
			$this->distributeOrder('post', $_POST);
		} else {
			$this->distributeOrder('get', $_GET);
		}
	}
	
}

?>