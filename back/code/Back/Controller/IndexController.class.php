<?php

namespace Back\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackOrderHelp;
use Core\Model\MyLog;
use Core\Model\BackAccountHelp;
use Core\Model\BackLineHelp;

define('SQL_PAGE_SIZE', 30);

class IndexController extends BackBaseController {
	
	protected function _initialize(){		
		$this->page_title = '首页';
		$this->content_title_show = 0;
	}
	
	public function welcomeAction(){
		session_start();		
		$showList = session('index_background');
		if (empty($showList) || count($showList) > 81) {
			$showList = array();
		}
		
		while (true) {
			$cur = rand(0, 80);
			if (!array_key_exists($cur, $showList)) {
				$showList[$cur] = true;
				break;
			}
		}
		session('index_background', $showList);
		
		if (IS_POST) {
			$data['image_name'] = $cur;
			$this->ajaxReturn($data);
		} else {
			$this->assign('image_name', $cur);
			$this->_setMenuLinkCurrent('欢迎', 'welcome');
			$this->menu_active = 'home';
			$this->_initTemplateInfo();
			$this->showPage('welcome');				
		}			
	}	
	
	public function questionAction() {
		$this->_setMenuLinkCurrent('常见问题', 'question');
		$this->menu_active = 'question';
		$this->_initTemplateInfo();
		
		$this->display('question');
	}	
	
	public function helpAction() {
		$this->_setMenuLinkCurrent('帮助文档', 'help');
		$this->menu_active = 'help';
		$this->_initTemplateInfo();
		
		$this->display('help');
	}	
	
	public function aboutAction() {
		$this->_setMenuLinkCurrent('关于', 'about');
		$this->menu_active = 'about';
		$this->_initTemplateInfo();
		
		$this->display('about');
	}
	
	private function combineUser() {
		$page = 0;
		if (IS_POST) {
			$page = I('post.page', 0);
		}
		$startIndex = $page * 20;
				
		$umObj = ModelBase::getInstance('members', 'uc_');
		$params['table'] = '`uc_members` AS `q1`';
		$params['col'] = array(
			'`q1`.`uid`'=>'`uid`',
			'`q1`.`username`'=>'`username`',
			'`q1`.`password`'=>'`password`',
			'`q1`.`salt`'=>'`salt`',
			'`q1`.`email`'=>'`q1_email`',
			'`q1`.`phone`'=>'`q1_phone`',
			'`q1`.`regip`'=>'`q1_regip`',
			'`q1`.`regdate`'=>'`q1_regdate`',
			'`q1`.`lastloginip`'=>'`q1_lastloginip`',
			'`q1`.`lastlogintime`'=>'`q1_lastlogintime`',
			'`q1`.`touxiang`'=>'`q1_face`',
			'`q2`.`mid`'=>'`mid`',
			'`q2`.`sex`'=>'`q2_sex`',
			'`q2`.`email`'=>'`q2_email`',
			'`q2`.`phone`'=>'`q2_phone`',
			'`q2`.`face`'=>'`q1_face`',
			'`q2`.`loginip`'=>'`q2_loginip`',
			'`q2`.`logintime`'=>'`q2_logintime`',
		);
		$params['join'] = array('LEFT JOIN `xz_member` AS `q2` ON `q1`.`username` = `q2`.`userid`');
		$params['sort'] = array('`q1`.`uid`'=>'asc');
		$params['limit'] = array($startIndex, 20);
		$ds = $umObj->queryData($params, $total);
		$sql = $umObj->getLastSql();
		
		$pageCount = intval($total / 20) + ($total % 20 > 0 ? 1 : 0);
		
		if (IS_POST) {
			$userObj = ModelBase::getInstance('user');
			$colNames = $userObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$data = array('ds'=>$ds, 'result'=>array());
			foreach($ds as $dk=>$dv) {
				$result['dv'] = $dv;
				$user = coll_elements_giveup($colNames, $dv);
				if (empty($user['uid'])) {
					$user['uid'] = 0;
				}
				if (empty($user['mid'])) {
					$user['mid'] = 0;
				}
				$user['email'] = empty($dv['q1_email']) === false ? $dv['q1_email'] : $dv['q2_email'];
				$user['phone'] = empty($dv['q1_phone']) === false ? $dv['q1_phone'] : $dv['q2_phone'];
				$user['face'] = empty($dv['q1_face']) === false ? $dv['q1_face'] : $dv['q2_face'];
				$user['sex'] = get_sex($dv['q2_sex']);
				$user['create_time'] = date('Y-m-d H:i:s', $dv['q1_regdate']);
				$user['login_time'] = date('Y-m-d H:i:s', $dv['q2_logintime']);
				$user['login_ip'] = date('Y-m-d H:i:s', $dv['q2_loginip']);
				$user['last_login_time'] = date('Y-m-d H:i:s', $dv['q1_lastlogintime']);
				$user['last_login_ip'] = date('Y-m-d H:i:s', $dv['q1_lastloginip']);
								
				$conds = appendLogicExp('uid', '=', $user['uid']);
				$conds = appendLogicExp('mid', '=', $user['mid'], 'AND', $conds);
				$count = $userObj->getCount($conds);
				if ($count > 0) {
					$result['result'] = error(-1, '这条数据已经存在');
					$result['user'] = $user;
					array_push($data['result'], $result);
				}
				
				$result['result'] = $userObj->create($user, $userId);
				$user['id'] = $userId;
				$result['user'] = $user;
				array_push($data['result'], $result);
			}
		}
		
		if (IS_POST) {
			$this->ajaxReturn($data);
		} else {
			$this->assign('sql', $sql);
			$this->assign('ds', $ds);
			$this->assign('data', $data);			
			$this->assign('page_count', $pageCount);
			$this->display('sql');
		}
	}
	
	private function combineAdmin() {				
		$adminObj = ModelBase::getInstance('admin');
		$params['table'] = '`kl_menu_item` AS `q1`';
		$params['col'] = array(
			'`q1`.`id`'=>'`q1_id`',
			'`q1`.`item_desc`'=>'`q1_item_desc`',
			'`q2`.`id`'=>'`q2_id`',
			'`q2`.`item_desc`'=>'`q2_item_desc`',
		);
		$params['join'] = array('INNER JOIN `kl_menu_item_old` AS `q2` ON `q1`.`item_desc` = `q2`.`item_desc`');
		$ds = $adminObj->queryData($params, $total);
		
		$table = array(
			'order_review'=>array('col'=>array('pay_channel_id')),
//			'order_review'=>array('col'=>array('admin_id','review_admin_id')),
//			'order_message'=>array('col'=>array('admin_id')),
//			'order_supervise'=>array('col'=>array('admin_id')),
//			'order_coupon'=>array('col'=>array('admin_id')),
//			'team_group'=>array('col'=>array('create_admin_id', 'dispose_admin_id')),
//			'team_message'=>array('col'=>array('admin_id')),
		);
		
		foreach ($table as $tk=>$tv) {
			$tabObj = ModelBase::getInstance($tk);
			foreach($tv['col'] as $ck=>$col) {
				foreach ($ds as $dk=>$dv) {
					$result = $tabObj->modify(array($col=>$dv['q1_id']), appendLogicExp($col, '=', $dv['q2_id']));	
					$table[$tk][$col][$dk]['result'] = $result;
					$table[$tk][$col][$dk]['update'] = 'old:'.$dv['q2_id'].'=>new:'.$dv['q1_id'];
				}
			}
		}
		
		$this->assign('ds', $ds);
		$this->assign('data', $table);	
		$this->display('sql');
	}
	
	private function changePayOrder() {
		if (IS_POST) {
			$page = I('post.page', 0);			
			$startIndex = $page * SQL_PAGE_SIZE;
							
			$message = '';
			$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
			$payObj = ModelBase::getInstance('pay_log', 'xz_');
			$ds = $payObj->getAll(appendLogicExp('order_id', '=', '0'), $startIndex, SQL_PAGE_SIZE, $total, array('SendTime'=>'desc'));
			foreach($ds as $dk=>$dv) {				
				$order_sn =BackOrderHelp::getRealOrderSN($dv['order_sn']);				
				$order = $orderObj->getOne(appendLogicExp('order_sn', 'LIKE', $order_sn.'%'));
				if (!empty($order)) {
					$result = $payObj->modify(array('order_id'=>$order['id']), appendLogicExp('id', '=', $dv['id']));
					if (error_ok($result) === false) {
						$message = $message . '支付记录=>'.$dv['id'].'写入订单（'.$dv['order_sn'].'）编号失败,Error:'.$result['message'].'<br />';	
					} else {
						$message = $message . '支付记录=>'.$dv['id'].'写入订单（'.$dv['order_sn'].'）编号成功<br />';	
					}
				} else {
					$message = $message . '支付记录=>'.$dv['id'].'的订单'.$dv['order_sn'].'未能找到<br />';
				}
			}
			if (empty($ds)) {
				$data['result'] = error(-1, '没有可供转化的记录<br />');
			} else {
				$data['result'] = error(0, $message);	
			}
			$this->ajaxReturn($data);
		}
	}
	
	public function sqlAction() {
		if (IS_POST) {
			$this->changePayOrder();
		} else {
			$payObj = ModelBase::getInstance('pay_log', 'xz_');
			$total = $payObj->getCount(appendLogicExp('order_id', '=', '0'));
			$pageCount = intval($total / SQL_PAGE_SIZE) + ($total % SQL_PAGE_SIZE > 0 ? 1 : 0);
			$this->assign('page_count', $pageCount);
			$this->display('sql');	
		}
	}
	
	private function dbDataChange() {
			$tabObj = ModelBase::getInstance('line');
			$conds = appendLogicExp('member_type', 'LIKE', '%undefined%');
			$ds = $tabObj->getAll($conds,0,0,$total,'create_time',false,$out);
			$data['out'] = $out;
			foreach ($ds as $dk=>$dv) {
				$aps = json_decode($dv['member_type'], true);
				// 单个对象转换
				$type = MyHelp::TypeDataKey2Value($aps['id'], true);
				if (is_error($type) === FALSE) {	
					$updataData['member_type'] = my_json_encode(array('id'=>$type['id'], 'type_key'=>$type['type_key'], 'type_desc'=>$type['type_desc']));					
//					$data['type_'.$dv['id']] = $updataData;
					$data['result_'.$dv['id']] = $tabObj->modify($updataData, appendLogicExp('id', '=', $dv['id']));
				}
				
				// 数组对象转换
//				$newaps = '';
//				foreach ($aps as $tk=>$tv) {
//					$type = MyHelp::TypeDataKey2Value($tv['id'], true);
//					if (is_error($type) === FALSE) {
//						if (!empty($newaps)) {
//							$newaps .= ',';
//						}
//						$newaps .= my_json_encode(array('id'=>$type['id'], 'type_key'=>$type['type_key'], 'type_desc'=>$type['type_desc']));
//					}					
//				}
//				$updataData['trip_month'] = '['.$newaps.']';
//				$data['type_'.$dv['id']] = $updataData;
//				$data['result_'.$dv['id']] = $tabObj->modify($updataData, appendLogicExp('id', '=', $dv['id']));		
			}
	}
	
	public function testAction() {
		if (IS_POST) {
			$data['post'] = $_POST;
			$data['post1'] = json_decode($_POST);			
			$data['post2'] = $GLOBALS['HTTP_RAW_POST_DATA'];
			$data['post3'] = file_get_contents('php://input');
			$this->ajaxReturn($data);
		} else {
//			$verify = new \Think\Verify();
//			$verify = entry();
//			$setObj = ModelBase::getInstance('set');
//			$set = $setObj->getOne(appendLogicExp('id', '=', '1789'));
//			$data['set'] = $set;
//			$data['set_val'] = my_json_decode($set['value'],true);
//			$data['set_val1'] = json_decode($set['value'],true);
			
			$data['salt'] = substr(uniqid(rand()), -6);
			$data['password'] = md5(md5('123456').$ds['salt']);
			$data['php_version'] = PHP_VERSION;
			$this->assign('data', $data);
			$this->showPage('test');
		}
	}
	
	public function excelExportAction() {
					      
        $ds[0][]='产品ID';
        $ds[0][]='产品名称';
        $ds[0][]='零件号';
        $ds[0][]='原厂参考零件号';
        $ds[0][]='原厂参考面价';
        $ds[0][]='品牌';
        $ds[0][]='类别';
        $ds[0][]='适用机型';
        $ds[0][]='添加时间';
        $ds[0][]='添加时间1';
        $ds[0][]='添加时间2';
        $ds[0][]='添加时间3';
        $ds[0][]='添加时间4';
        $ds[0][]='添加时间5';
        $ds[0][]='添加时间6';
        $ds[0][]='添加时间7';
        $ds[0][]='添加时间8';
        $ds[0][]='添加时间9';
        $ds[0][]='添加时间10';
        $ds[0][]='添加时间11';
        $ds[0][]='添加时间12';
        $ds[0][]='添加时间13';
        $ds[0][]='添加时间14';
        $ds[0][]='添加时间15';
        $ds[0][]='添加时间16';
        $ds[0][]='添加时间17';
        $ds[0][]='添加时间18';
        $ds[0][]='添加时间19';
        $ds[0][]='添加时间20';
		
		$ds[1][] = 7;
		$ds[1][] = '是多钱啊';
		$ds[1][] = 467;
		$ds[1][] = 1234;
		$ds[1][] = 54.568;
		$ds[1][] = '45,79';
		$ds[1][] = 4;
		$ds[1][] = 1;
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
		$ds[1][] = '2016-1-21 12:43:56';
			  		
		$data[0]['title'] = '测试页111';
		$data[0]['data'] = $ds;
		$data[1]['title'] = '测试页222';
		$ds[1][0] = '1111111';
		$data[1]['data'] = $ds;
		
		MyHelp::exportExcel('excel', $data);
		
//		p_a($data);
//		$rs['result'] = error(-1, '测试导出EXCEL');
//		$rs['data'] = $data;
//		$this->ajaxReturn($rs);
	}
	
	public function excelImportAction() {
		$info = MyHelp::importExcel();
		$this->ajaxReturn($info);
	}
}

?>