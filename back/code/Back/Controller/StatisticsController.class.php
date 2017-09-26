<?php

namespace Back\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackOrderHelp;
use Core\Model\BackLineHelp;

class StatisticsController extends BackBaseController {	
	
	// 获取统计的对比时间
	private function getStatsDate($datestr, $dateType, $dateDeep) {
		$md = explode(' / ', $datestr);
		if (count($md) != 2) {
			return error(-1, '对比时间段格式错误');
		}
				
		$ststr = date('Y-').$md[0].' 00:00:00';
		$etstr = date('Y-').$md[1].' 23:59:59';
		if ($dateType['type_key'] == 'stats_date_type_tongbi') { // 同比
			$dateUnit = 'year';
		} else { // 环比
			$dateUnit = 'month';
		}
		
		for ($i = 0; $i < $dateDeep; $i++) {
			if ($i == 0) {
				$date[$i][0] = strtotime($ststr);
				$date[$i][1] = strtotime($etstr);
			} else {
				$date[$i][0] = strtotime($ststr.' -'.$i.' '.$dateUnit);
				$date[$i][1] = strtotime($etstr.' -'.$i.' '.$dateUnit);
			}
		}
		return $date;
	}
	
	// 获取统计的对比列
	private function getStatsCol($tab, $statsDataType) {
		if ($tab == 'order') {
			if ($statsDataType['type_key'] == 'stats_data_order_member') {
				return array(
					'count(`male`)'=>'`male`',
					'count(`woman`)'=>'`woman`',
					'count(`child`)'=>'`child`',
				);					
			} else {
				return array('count(*)'=>'`count`');
			}
		} else {
			return '';
		}
	}
	
	// 得到统计数据的获取条件
	private function getStatsConds($statsType, $statsObjItem, &$showText) {
		if ($statsType == 'stats_type_line') {
			$line = $statsObjItem;
			$showText = $line['title'];
			if ($line['type'] == 1) { // 旧线路
				$conds = appendLogicExp('lineid', '=', $line['id']);
				$conds = appendLogicExp('new_line', '=', '0', 'AND', $conds);
			} else if ($line['type'] == 2) { // 小包团
				$conds = appendLogicExp('lineid', '=', $line['id']);
				$conds = appendLogicExp('order_sn', 'LIKE', 'YD-%', 'AND', $conds);
			} else {  // 新线路
				$conds = appendLogicExp('lineid', '=', $line['id']);
				$conds = appendLogicExp('new_line', '=', '1', 'AND', $conds);
			}
		} else if ($statsType == 'stats_type_domain') {	
			$showText = $statsObjItem;
			$conds = appendLogicExp('add_domain', '=', $statsObjItem);
		} else if ($statsType == 'stats_type_order_from') {
			$orderFrom = $statsObjItem;
			$showText = $orderFrom['type_desc'];
			$conds = appendLogicExp('from_id', '=', $orderFrom['id']);	
		} else if ($statsType == 'stats_type_customer_from') {
			$showText = $statsObjItem;
			$conds = appendLogicExp('customer_from', '=', $statsObjItem);
		} else {
			return error(-1, '要统计的类型不存在');
		}
		return $conds;
	}
	
	// 把获取的数据进行整理，得出统计数据
	private function getStatsData($tab, $statsDataType, $ds) {	
		if (!empty($ds)) {
			if ($tab == 'order') {	
				if ($statsDataType['type_key'] == 'stats_data_order_member') {
					return intval($ds[0]['male'])+intval($ds[0]['woman'])+intval($ds[0]['child']);
				} else {
					return $ds[0]['count'];
				}
			}
		}		
		return 0;
	}
	
	// 统计订单相关
	private function statsOrder() {
		if (IS_POST) {
			$statsDataType = I('post.data_type', false);
			$statsDate = I('post.date', false);
			$statsDateType = I('post.date_type', false);
			$statsDateDeep = I('post.date_deep', false);
			$statsObjKey = I('post.stats_obj_key', false);
			$statsObj = I('post.stats_objs', false);
			if (empty($statsDataType) || empty($statsDate) || empty($statsDateType) || empty($statsDateDeep) || empty($statsObjKey) || empty($statsObj)) {
				$data['result'] = error(-1, '统计的参数不齐全');
				return $this->ajaxReturn($data);
			}
			
			// 获取对比时间
			$date = $this->getStatsDate($statsDate, $statsDateType, $statsDateDeep);
			if (is_error($date)) {
				$data['result'] = $date;
				return $this->ajaxReturn($data);
			}
			
			$ds = array();
			foreach ($date as $dk=>$dv) {
				$d['text'] = date('Y-m-d',$dv[0]).'至'.date('Y-m-d',$dv[1]);
				foreach($statsObj as $lk=>$lv) {
					// 获取统计列
					$params['col'] = $this->getStatsCol('order', $statsDataType);
					
					// 获取统计条件
					$conds = $this->getStatsConds($statsObjKey, $lv, $showText);
					if (is_error($conds) === true) {
						$data['result'] = $conds;
						return $this->ajaxReturn($data);
					}							
					$conds = appendLogicExp('addtime', '>', $dv[0], 'AND', $conds);
					$conds = appendLogicExp('addtime', '<=', $dv[1], 'AND', $conds);
					$conds = appendLogicExp('order_sn', 'NOT LIKE', 'RQ-%', 'AND', $conds);			
					$params['conds'] = $conds;
					
					$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
					$order = $orderObj->queryData($params, $total, $out);
					$d['data'][$lk]['out'] = $out;
					
					$d['data'][$lk]['text'] = $showText;
					$d['data'][$lk]['ds'] = $this->getStatsData('order', $statsDataType, $order);
				}
				array_push($ds, $d);
			}
		
			session_start();
			if (empty($ds)) {
				unset($_SESSION['stats_order_data']);
				$data['result'] = error(-1, '统计失败,未能找到相关信息');			
			} else {
				$data['result'] = error(0, '统计成功');
				$data['ds'] = $ds;
				if ($statsDataType['type_key'] == 'stats_data_order_member') {
					$sessionStats['title'] = '参团人数量统计';
				} else {
					$sessionStats['title'] = '订单数量统计';
				}
				$sessionStats['ds'] = $ds;
				$sessionStats['op_type'] = 'order';
				session('export_stats_data', $sessionStats);
			}
			$this->ajaxReturn($data);						
		} else {
			$this->showPage('order', 'statistics_order', 'statistics', '订单统计', '订单统计', '这里您可以根据某些条件统计参团人以及订单的数量');	
		}
	}
	
	// 订单相关统计的操作
	public function orderAction() {
		if (IS_POST) {
			$op = I('post.op_type', false);
			if ($op == 'stats') {
				$this->statsOrder();
			} else {
				$data['result'] = error(-1, '错误的请求');
				$this->ajaxReturn($data);
			}
		} else {
			$this->statsOrder();
		}
	}
	
	// 线路统计
	private function statsLine() {
		if (IS_POST) {
			$statsDate = I('post.date', false);
			$statsObj = I('post.stats_objs', false);
			if (empty($statsDate) || empty($statsObj)) {
				$data['result'] = error(-1, '统计的参数不齐全');
				return $this->ajaxReturn($data);
			}
			
			// 时间条件
			$md = explode(' / ', $statsDate);
			if (count($md) != 2) {
				$data['result'] = error(-1, '时间段格式错误');
				return $this->ajaxReturn($data);
			}					
			$startTime = strtotime($md[0].' 00:00:00');
			$endTime = strtotime($md[1].' 23:59:59');
			
			// 订单状态
			$stateIdMap = BackOrderHelp::cacheOrderState('id');
			if (empty($stateIdMap)) {
				$data['result'] = error(-1, '获取订单状态列表错误');
				return $this->ajaxReturn($data);
			}
			foreach ($stateIdMap as $sk=>$sv) {
				$tk = $sv['type_key'];
				if ($tk == 'pay_advance' || $tk == 'pay_part' || $tk == 'pay_complate' || $tk == 'pay_complate1' || $tk == 'refund_wait' || $tk == 'error_refund' || $tk == 'complated') {
					$payStateMap[$sk] = $sv;
				}
				if ($tk == 'unjoin' || $tk == 'canceled' || $tk == 'invalid' || $tk == 'cancel_scheduling') {
					$invalidStateMap[$sk] = $sv;
				}
			}
			
			// 订单来源
			$fromIdMap = BackOrderHelp::cacheOrderFrom('id');
			if (empty($fromIdMap)) {
				$data['result'] = error(-1, '获取订单来源列表错误');
				return $this->ajaxReturn($data);
			}
			
			foreach($statsObj as $lk=>$lv) {
				$lv['sum_order'] = 0;
				$lv['sum_member'] = 0;
				$lv['day_order'] = 0;
				$lv['day_member'] = 0;
				$lv['main_station_order'] = 0;
				$lv['main_station_pay'] = 0;
				$lv['channel_order'] = 0;
				$lv['channel_member'] = 0;
				
				// 渠道订单人数与订单数
				foreach ($fromIdMap as $fk=>$fv) {
					$fv['order_count'] = 0;
					$fv['member_count'] = 0;
					$lv['stats_channels'][$fk] = $fv;
				}
				
				// 产品条件
				$lineType = $lv['type'];
				$conds = appendLogicExp('lineid', '=', $lv['line']['id']);
				if ($lineType == 0) {
					if (!empty($lv['batch'])) {
						$conds = appendLogicExp('hdid', '=', $lv['batch']['id'], 'AND', $conds);
					}
					$conds = appendLogicExp('new_line', '=', '1', 'AND', $conds);
				} else if ($lineType == 1) {
					if (!empty($lv['batch'])) {
						$conds = appendLogicExp('hdid', '=', $lv['batch']['id'], 'AND', $conds);
					}
					$conds = appendLogicExp('new_line', '=', '0', 'AND', $conds);
				} else if ($lineType == 2) {					
					$conds = appendLogicExp('order_sn', 'LIKE', 'YD-', 'AND', $conds);
				} else {
					$statsObj[$lk] = $lv;
					continue;
				}
				
				
				$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
				$orders = $orderObj->getAll($conds);
				$lv['sum_order'] = count($orders);
				foreach ($orders as $ok=>$ov) {
					// 剔除人气报名
					if (stripos($ov['order_sn'], 'RQ-') !== FALSE || !empty($invalidStateMap[$ov['zhuangtai']])) {
						continue;
					}
					
					$memberCount = intval($ov['male']) + intval($ov['woman']) + intval($ov['child']);
					
					// 累计订单及人数统计
					$lv['sum_member'] += $memberCount;
					
					// 指定日期订单数
					$addtime = intval($ov['addtime']);
					if ($addtime >= $startTime && $addtime <= $endTime) {
						$lv['day_order'] += 1;
						$lv['day_member'] += $memberCount;
					}
					
					// 主站订单
					if ($ov['station_id'] == 1) {
						$lv['main_station_order'] += 1;
						if (!empty($payStateMap[$ov['zhuangtai']])) {
							$lv['main_station_pay'] += 1;
						}
					}
					
					// 渠道订单
					if (stripos($ov['order_sn'], 'QD-') !== FALSE) {
						$lv['channel_order'] += 1;
						$lv['channel_member'] += $memberCount;
					} 
					
					// 根据订单来源划分渠道
					if (!empty($lv['stats_channels'][$ov['from_id']])) {
						$lv['stats_channels'][$ov['from_id']]['order_count'] += 1;
						$lv['stats_channels'][$ov['from_id']]['member_count'] += $memberCount;
					}
				}
				
				$statsObj[$lk] = $lv;
			}
			$ds = $statsObj;
			
			session_start();
			if (empty($ds)) {
				unset($_SESSION['stats_order_data']);
				$data['result'] = error(-1, '统计失败,未能找到相关信息');			
			} else {
				$data['result'] = error(0, '统计成功');
				$data['ds'] = $ds;
				$sessionStats['title'] = '线路统计';
				$sessionStats['ds'] = $ds;
				$sessionStats['op_type'] = 'line';
				session('export_stats_data', $sessionStats);
			}
			$this->ajaxReturn($data);			
		} else {
			
			// 订单来源
			$fromIdMap = BackOrderHelp::cacheOrderFrom('id');
			if (!empty($fromIdMap)) {
				$this->assign('order_from', $fromIdMap);
			}
			
			// 线路目的地
			$destination = MyHelp::getTypeData('line_destination');
			$this->assign('destination', $destination);
			
			$this->assign('today', date('Y-m-d'));
			$this->showPage('line', 'statistics_line', 'statistics', '线路统计', '线路统计', '这里您可以根据某些条件统计某天的参团人以及订单的数量');	
		}
	}
	
	// 日报表统计
	public function lineAction() {
		if (IS_POST) {
			$op = I('post.op_type', false);
			if ($op == 'stats') {
				$this->statsLine();
			} else if ($op == 'dest_line') {
				$this->destinationLine();
			}  else {
				$data['result'] = error(-1, '错误的请求');
				$this->ajaxReturn($data);
			}
		} else {
			$this->statsLine();
		}
	}
	
	
	private function statsPay() {
		if (IS_POST) {
			$batchDate = I('post.batch_date', false);
			$statsDate = I('post.stats_date', false);
			$statsObj = I('post.stats_objs', false);
			if (empty($statsObj)) {
				$data['result'] = error(-1, '统计的参数不齐全');
				return $this->ajaxReturn($data);
			}
			
			// 时间条件
			$md1 = explode(' / ', $batchDate);
			$md2 = explode(' / ', $statsDate);
			// 批次不选日期从今天开始
			if (count($md1) != 2) {
				$md1 = array(date('Y-m-d', time()), '');
			}	
			// 统计不选日期就统计全部内容
			if (count($md2) != 2) {
				$md2 = array('', '');
			}
			if (!empty($md1[0])){
				$bsTime = strtotime($md1[0].' 00:00:00');	
			}
			if (!empty($md1[1])){
				$beTime = strtotime($md1[1].' 23:59:59');
			}
			if (!empty($md2[0])){
				$ssTime = strtotime($md2[0].' 00:00:00');	
			}
			if (!empty($md2[1])){
				$seTime = strtotime($md2[1].' 23:59:59');
			}
			
			// 订单状态
			$stateIdMap = BackOrderHelp::cacheOrderState('id');
			if (empty($stateIdMap)) {
				$data['result'] = error(-1, '获取订单状态列表错误');
				return $this->ajaxReturn($data);
			}
			
			$invalidStateIds = '';
			foreach ($stateIdMap as $sk=>$sv) {
				$tk = $sv['type_key'];
				if ($tk == 'pay_advance' || $tk == 'pay_part' || $tk == 'pay_complate' || $tk == 'pay_complate1' || $tk == 'refund_wait' || $tk == 'error_refund' || $tk == 'complated') {
					$payStateMap[$sk] = $sv;
				}
				if ($tk == 'unjoin' || $tk == 'canceled' || $tk == 'invalid' || $tk == 'cancel_scheduling') {
					$invalidStateIds .= empty($invalidStateIds) ? $sk : (','.$sk);
					$invalidStateMap[$sk] = $sv;
				}
			}		
			
			$batchs = array();			
			foreach($statsObj as $lk=>$lv) {
				// 产品条件
				$lineType = $lv['type'];
				if ($lineType == 0) {
					$batchObj = ModelBase::getInstance('batch');
					$dateConds = appendLogicExp('line_id', '=', $lv['line']['id']);
					if (!empty($bsTime)) {
						$stTime = date('Y-m-d H:i:s', $bsTime);
						$dateConds = appendLogicExp('start_time', '>=', $stTime, 'AND', $dateConds);	
					}
					if (!empty($beTime)) {
						$etTime = date('Y-m-d H:i:s', $beTime);
						$dateConds = appendLogicExp('end_time', '<=', $etTime, 'AND', $dateConds);
					}
					$batchList = $batchObj->getAll($dateConds);
					foreach ($batchList as $bk=>$bv) {
						$start_date = explode(' ', $bv['start_time']);
						$batch = array(
							'id'=>$bv['id'],
							'date'=>$start_date[0],
							'pay_order'=> 0,
							'unpay_order'=> 0,
							'pay_member'=> 0,
							'unpay_member'=> 0,
							'member'=> 0,
							'exist_batch'=>0,
						);
						$lv['batch'][$batch['id']] = $batch;
						unset($batch['id']);
						$batchs[$batch['date']] = $batch;
					}
				} else if ($lineType == 1) {
					$batchObj = ModelBase::getInstance('lineactivity', 'xz_');
					$dateConds = appendLogicExp('aid', '=', $lv['line']['id']);
					if (!empty($bsTime)) {
						$dateConds = appendLogicExp('startdate', '>=', $bsTime, 'AND', $dateConds);	
					}
					if (!empty($beTime)) {
						$dateConds = appendLogicExp('enddate', '<=', $beTime, 'AND', $dateConds);
					}
					$batchList = $batchObj->getAll($dateConds);
					foreach ($batchList as $bk=>$bv) {
						$batch = array(
							'id'=>$bv['id'],
							'date'=>date('Y-m-d', $bv['startdate']),
							'pay_order'=> 0,
							'unpay_order'=> 0,
							'pay_member'=> 0,
							'unpay_member'=> 0,
							'member'=> 0,
							'exist_batch'=>0,
						);
						$lv['batch'][$batch['id']] = $batch;
						unset($batch['id']);
						$batchs[$batch['date']] = $batch;
					}
				} else if ($lineType == 2) {
					$meetTime = strtotime($lv['meet_time']);
					if ((!empty($bsTime) && $meetTime < $bsTime) || (!empty($beTime) && $meetTime > $beTime)) {
						continue;
					}
					$batch = array(
						'id'=>$bv['id'],
						'date'=>date('Y-m-d', $lv['meet_time']),
						'pay_order'=> 0,
						'unpay_order'=> 0,
						'pay_member'=> 0,
						'unpay_member'=> 0,
						'member'=> 0,
						'exist_batch'=>0,
					);
					$lv['batch'][$batch['id']] = $batch;
					unset($batch['id']);
					$batchs[$batch['date']] = $batch;
				} else {
					continue;
				}		
				$statsObj[$lk] = $lv;
			}
//			$data['batchs'] = $batchs;		
			
			if (empty($batchs)) {
				$data['result'] = error(-1, '所选日期内没有批次，无法进行统计');
				return $this->ajaxReturn($data);
			}			
			
			// 对批次进行排序
			ksort($batchs);
			
			foreach($statsObj as $lk=>$lv) {
				$lv['sum_order'] = 0;
				$lv['sum_member'] = 0;
				$lv['batchs'] = $batchs;
				
				// 标注属于本线路的批次
				foreach ($lv['batch'] as $bk=>$bv) {
					$lv['batchs'][$bv['date']]['exist_batch'] = 1;
				}
				
				// 产品条件
				$lineType = $lv['type'];
				$conds = appendLogicExp('lineid', '=', $lv['line']['id']);
				if ($lineType == 0) {
					$conds = appendLogicExp('new_line', '=', '1', 'AND', $conds);
				} else if ($lineType == 1) {
					$conds = appendLogicExp('new_line', '=', '0', 'AND', $conds);
				} else if ($lineType == 2) {					
					$conds = appendLogicExp('order_sn', 'LIKE', 'YD-', 'AND', $conds);
				} else {
					$statsObj[$lk] = $lv;
					continue;
				}				
				
				$conds = appendLogicExp('order_sn', 'NOT LIKE', 'RQ-', 'AND', $conds);
				if (!empty($invalidStateIds)) {
					$conds = appendLogicExp('zhuangtai', 'NOT IN', '('.$invalidStateIds.')', 'AND', $conds);
				}
				if (!empty($ssTime)) {
					$conds = appendLogicExp('addtime', '>=', $ssTime, 'AND', $conds);	
				}
				if (!empty($seTime)) {
					$conds = appendLogicExp('addtime', '<=', $seTime, 'AND', $conds);
				}
				$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
				$orders = $orderObj->getAll($conds, 0, 0, $total, array('hdid'=>'asc', 'addtime'=>'asc'));
				$lv['sql'] = $orderObj->getLastSql();
				$lv['sum_order'] = count($orders);
				foreach ($orders as $ok=>$ov) {
					// 订单总人数
					$memberCount = intval($ov['male']) + intval($ov['woman']) + intval($ov['child']);
					// 累计订单及人数统计
					$lv['sum_member'] += $memberCount;			
									
					// 支付情况
					$payKey = empty($payStateMap[$ov['zhuangtai']]) ? 'unpay' : 'pay';															
					// 包团订单
					if (stripos($ov['order_sn'], 'YD-') !== FALSE) {
						$dateKey = $lv['batch'][$ov['lineid']]['date'];
						// 只统计日期范围内的
						if (!empty($lv['batchs'][$dateKey])) {
							$lv['batchs'][$dateKey]['id'] = $lv['batch'][$ov['lineid']]['id'];
							$lv['batchs'][$dateKey][$payKey.'_order'] += 1;
							$lv['batchs'][$dateKey][$payKey.'_member'] += $memberCount;
							
							$lv['batch'][$ov['lineid']][$payKey.'_order'] += 1;
							$lv['batch'][$ov['lineid']][$payKey.'_member'] += $memberCount;
							$lv['batch'][$ov['lineid']]['member'] += $memberCount;
						}
						
					} else {
						// 新旧线路订单
						$dateKey = $lv['batch'][$ov['hdid']]['date'];
						// 只统计日期范围内的
						if (!empty($lv['batchs'][$dateKey])) {
							$lv['batchs'][$dateKey]['id'] = $lv['batch'][$ov['hdid']]['id'];
							$lv['batchs'][$dateKey][$payKey.'_order'] += 1;
							$lv['batchs'][$dateKey][$payKey.'_member'] += $memberCount;
							
							$lv['batch'][$ov['hdid']][$payKey.'_order'] += 1;
							$lv['batch'][$ov['hdid']][$payKey.'_member'] += $memberCount;
							$lv['batch'][$ov['hdid']]['member'] += $memberCount;
						}
					}					
				}						
				$statsObj[$lk] = $lv;
			}
			$ds = $statsObj;
			
			session_start();
			if (empty($ds)) {
				unset($_SESSION['stats_order_data']);
				$data['result'] = error(-1, '统计失败,未能找到相关信息');			
			} else {
				$data['result'] = error(0, '统计成功');
				$data['ds'] = $ds;
				$sessionStats['title'] = '支付统计';
				$sessionStats['ds'] = $ds;
				$sessionStats['op_type'] = 'pay';
				session('export_stats_data', $sessionStats);
			}
			$this->ajaxReturn($data);			
		} else {
			// 订单来源
			$fromIdMap = BackOrderHelp::cacheOrderFrom('id');
			if (!empty($fromIdMap)) {
				$this->assign('order_from', $fromIdMap);
			}
			
			// 线路目的地
			$destination = MyHelp::getTypeData('line_destination');
			$this->assign('destination', $destination);
			
			$this->assign('today', date('Y-m-d'));
			$this->showPage('pay', 'statistics_pay', 'statistics', '支付统计', '支付统计', '这里您可以根据某些条件统计某端时间的支付数量');	
		}
	}
	
	// 根据目的地获取线路
	private function destinationLine() {
		if (IS_POST) {
			$destKey = I('post.dest', false);
			if (empty($destKey)) {
				$data['result'] = error(-1, '错误我的目的地对象');
				return $this->ajaxReturn($data);
			}
			
			$conds = appendLogicExp('destination', 'LIKE', '%'.$destKey.'%');
			$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
			$conds = appendLogicExp('online', '=', '1', 'AND', $conds);
			$line = BackLineHelp::getLineList($conds);
			$data['ds'] = $line;
			$data['result'] = error(0, '获取线路成功');
			$this->ajaxReturn($data);
		} else {
			$this->showError('404', '访问错误', '您访问的页面不存在', '页面不存在，或者您没有此访问权限');
		}
	}
	
	// 支付表统计
	public function payAction() {
		if (IS_POST) {
			$op = I('post.op_type', false);
			if ($op == 'stats') {
				$this->statsPay();
			} else if ($op == 'dest_line') {
				$this->destinationLine();
			} else {
				$data['result'] = error(-1, '错误的请求');
				$this->ajaxReturn($data);
			}
		} else {
			$this->statsPay();
		}
	}
	
	// 导出订单统计的数据
	private function getExportOrderStats($exportDatas, &$out) {
		$sheet = array();
		$dataTitle = array('时间段');
		foreach ($exportDatas['ds'] as $dk=>$dv) {
			$totalStats = 0;
			$dataValue = array($dv['text']);
			foreach ($dv['data'] as $ddk=>$ddv){
				if ($dk == 0) {
					array_push($dataTitle, $ddv['text']);
				}
				array_push($dataValue, $ddv['ds']);
				if (is_numeric($ddv['ds'])) {
					$totalStats += $ddv['ds'];
				}
			}
			if (!empty($dataTitle)) {
				array_push($dataTitle, '总人数');
				array_push($sheet, $dataTitle);
				unset($dataTitle);
			}
			array_push($dataValue, $totalStats);
			array_push($sheet, $dataValue);
		}
		
		$worksheets = array();
		if (!empty($sheet)) {
			array_push($worksheets, array('title'=>$exportDatas['title'], 'data'=>$sheet));
		}
		return $worksheets;
	}
	
	// 导出线路统计的数据
	private function getExportLineStats($exportDatas, &$out) {
		$sheetMain['title'] = '综合统计';
		$sheetMain['header'] = array('线路批次', '状态', '累计订单数', '累计报名人数', '当天订单数', '当天报名人数', '主站订单', '缴费人数', '渠道订单', '渠道缴费人数');
		$sheetMain['data'] = array();
		$sheetOrder['title'] = '渠道订单数';
		$sheetOrder['header'] = array('线路批次');
		$sheetOrder['data'] = array();
		$sheetMember['title'] = '渠道报名人数';
		$sheetMember['header'] = array('线路批次');
		$sheetMember['data'] = array();
		foreach ($exportDatas['ds'] as $dk=>$dv) {
			$totalStats = 0;
			$dataValue = array($dv['title']);
			array_push($dataValue, $dv['line']['online'] == 0 ? '下架' : '上架');
			array_push($dataValue, $dv['sum_order']);
			array_push($dataValue, $dv['sum_member']);
			array_push($dataValue, $dv['day_order']);
			array_push($dataValue, $dv['day_member']);
			array_push($dataValue, $dv['main_station_order']);
			array_push($dataValue, $dv['main_station_pay']);
			array_push($dataValue, $dv['channel_order']);
			array_push($dataValue, $dv['channel_member']);
			array_push($sheetMain['data'], $dataValue);
			
			$orders = array($dv['title']); $member = array($dv['title']);
			foreach ($dv['stats_channels'] as $sk=>$sv) {
				if (array_search($sv['type_desc'], $sheetOrder['header']) === FALSE) {
					array_push($sheetOrder['header'], $sv['type_desc']);
					array_push($sheetMember['header'], $sv['type_desc']);
				}
				array_push($orders, $sv['order_count']);
				array_push($member, $sv['member_count']);
			}
			array_push($sheetOrder['data'], $orders);
			array_push($sheetMember['data'], $member);
		}
		
		array_unshift($sheetMain['data'], $sheetMain['header']);
		array_unshift($sheetOrder['data'], $sheetOrder['header']);
		array_unshift($sheetMember['data'], $sheetMember['header']);
		$worksheets = array();
		array_push($worksheets, array('title'=>$sheetMain['title'], 'data'=>$sheetMain['data']));
		array_push($worksheets, array('title'=>$sheetOrder['title'], 'data'=>$sheetOrder['data']));
		array_push($worksheets, array('title'=>$sheetMember['title'], 'data'=>$sheetMember['data']));
		return $worksheets;
	}
	
	// 导出订单支付的数据
	private function getExportPayStats($exportDatas, &$out) {
		$out['export'] = $exportDatas;
		$sheet['title'] = '付款统计';
		$sheet['header'] = array('线路批次');
		$sheet['data'] = array();
		foreach ($exportDatas['ds'] as $dk=>$dv) {
			$totalStats = 0;
			array_push($sheet['header'], $dv['title'].'[订单已付款]');
			array_push($sheet['header'], $dv['title'].'[订单未付款]');
			array_push($sheet['header'], $dv['title'].'[人数已付款]');
			array_push($sheet['header'], $dv['title'].'[人数未付款]');
			
			$batchIndex = 0;
			foreach ($dv['batchs'] as $bk=>$bv) {
				if ($dk == 0) {
					$sheet['data'][$batchIndex][0] = $bv['date'];
					$sheet['data'][$batchIndex][($dk*4)+1] = empty($bv['pay_order']) ? '' : $bv['pay_member'];
					$sheet['data'][$batchIndex][($dk*4)+2] = empty($bv['unpay_order']) ? '' : $bv['unpay_order'];
					$sheet['data'][$batchIndex][($dk*4)+3] = empty($bv['pay_member']) ? '' : $bv['pay_member'];
					$sheet['data'][$batchIndex][($dk*4)+4] = empty($bv['unpay_member']) ? '' : $bv['unpay_member'];
				} else {					  
					$sheet['data'][$batchIndex][($dk*4)+1] = empty($bv['pay_order']) ? '' : $bv['pay'];
					$sheet['data'][$batchIndex][($dk*4)+2] = empty($bv['unpay_order']) ? '' : $bv['unpay_order'];
					$sheet['data'][$batchIndex][($dk*4)+3] = empty($bv['pay_member']) ? '' : $bv['pay_member'];
					$sheet['data'][$batchIndex][($dk*4)+4] = empty($bv['unpay_member']) ? '' : $bv['unpay_member'];	
				}
				$batchIndex++;
			}
		}
//		$out['sheet'] = $sheet;
		array_unshift($sheet['data'], $sheet['header']);
		$worksheets = array();
		array_push($worksheets, array('title'=>$sheet['title'], 'data'=>$sheet['data']));
		return $worksheets;
	}
	
	// 获取订单统计的导出数据
	private function getExportStats(&$out) {
		$exportDatas = $_SESSION['export_stats_data'];
		if (empty($exportDatas)) {
			return false;
		}
				
		if ($exportDatas['op_type'] == 'order') {
			return $this->getExportOrderStats($exportDatas, $out);
		} else if ($exportDatas['op_type'] == 'line') {
			return $this->getExportLineStats($exportDatas, $out);
		} else if ($exportDatas['op_type'] == 'pay') {
			return $this->getExportPayStats($exportDatas, $out);
		} else {
			return array();
		}
	}
	
	// 导出统计数据
	public function exportAction() {
		$type = I('get.type', false);
		if (!empty($type)) {
			if ($type == 'order') {
				$excelTitle = '统计';
				$worksheets = $this->getExportStats($out);	
			}
			if (!empty($worksheets)) {
				MyHelp::exportExcel($excelTitle, $worksheets);
			} else {				
				echo ('<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><head><body>没用可供导出的数据!!!<br>'.p_a($out).'</body></html>');	
			}
		} else {
			echo ('<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><head><body>导出数据的类型错误!!!</body></html>');
		}
	}
}

?>