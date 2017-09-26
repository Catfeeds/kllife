<?php
namespace Home\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackAccountHelp;
use Core\Model\BackLineHelp;
use Core\Model\BackOrderHelp;

class SubjectController extends HomeBaseController {
	
	public function _empty($name) {		
		$refresh = IS_POST ? I('post.refresh', false) : I('get.refresh', false); 
		if (!empty($refresh)) {
			$this->assign('refresh', $refresh);
		}
		
		$name = str_replace('Action', '', $name);
		if ($name == 'xinjiang') {
			$this->xinjiang();
		} else if ($name == 'xibei') {
			$this->xibei();
		} else if ($name == 'ejina') {
			$this->ejina();
		} else if ($name == 'silk') {
			$this->silk();
		} else if ($name == 'chuanxi') {
			$this->chuanxi();
		} else {
			$this->showPage($name);	
		}	
	}
	
	private function topSignupOrder($dest='', $showCount=20) {
		if ($showCount > 20) {
			$showCount = 20;
		}		
		if (!empty($dest)) {
			if (is_array($dest)) {
				foreach ($dest as $dk=>$dv) {
					$destConds = appendLogicExp('`q2`.`destination`', 'LIKE', '%'.$dv.'%', 'OR');
				}
			} else {
				$destConds = appendLogicExp('`q2`.`destination`', 'LIKE', '%'.$dest.'%', 'OR');
			}
		}		
		$conds = appendLogicExp('`q1`.`order_sn`', 'NOT LIKE', '%YD-%', 'AND', $conds);
		if (!empty($destConds)) {
			$conds = appendLogicExp('`q2`.`destination`', '=', $destConds, 'AND', $conds);
		}
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
		$params['limit'] = array(0, $showCount);
		
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$ds = $orderObj->queryData($params, $total);
		foreach ($ds as $dk=>$dv) {
			if (!empty($dv['mob']) && strlen($dv['mob']) == 11) {
				$dv['mob_show'] = substr($dv['mob'], 0, '3').'****'.substr($dv['mob'], 7);
				$ds[$dk] = $dv;	
			}
		}
		$this->assign('top_signup_orders', $ds);
	}
	
	/**
	* 推荐线路
	* @param 推荐线路的编号 $recommendLine=>'(180,200,210,291,35,228)';
	* @param 周边线路需要填充的内容 $fill=(batch,order_member_count)
	* 
	* @return 无
	*/
	private function recommendLine($subjectName, $recommendLine, $fill=false) {
		$refresh = IS_POST ? I('post.refresh', false) : I('get.refresh', false);
		
		// 推荐线路
		if (!empty($recommendLine)) {
			$recommendKey = 'subject_recommend_'.$subjectName;
			$cacheData = S($recommendKey);
			$recommends = $cacheData['data'];
			$overdue = MyHelp::checkConfigOverdue($recommendKey, $cacheData['config_update_time']);
			if (empty($cacheData) || empty($recommends) || !empty($refresh) || $overdue === true) {
				$conds = appendLogicExp('id', 'IN', $recommendLine);
				$recommends = BackLineHelp::getLineList($conds,0,0,$total,array('sort'=>'desc'),false);
				if (!empty($fill)) {
					foreach ($recommends as $rk=>$rv) {				
						// 线路批次
						if (!empty($fill['batch']) || $fill === true) {
							$conds = appendLogicExp('line_id', '=', $rv['id']);
							$conds = appendLogicExp('use_state', 'NOT LIKE', '%line_batch_use_offline%', 'AND', $conds);
							$conds = appendLogicExp('use_state', 'NOT LIKE', '%line_batch_use_forbid%', 'AND', $conds);
							$conds = appendLogicExp('state', 'NOT LIKE', '%line_batch_state_overdue%', 'AND', $conds);
							$conds = appendLogicExp('start_time', '>', fmtNowDateTime(), 'AND', $conds);
							$rv['batchs'] = BackLineHelp::getBatchList($conds);	
						}
						
						// 订单总人数
						if (!empty($fill['order_member_count']) || $fill === true) {
							$conds = appendLogicExp('lineid', '=', $rv['id']);
							$conds = appendLogicExp('new_line', '=', '1', 'AND', $conds);
							$orders = BackOrderHelp::getNewOrderList($conds,0,0,$total,array('addtime'=>'desc'));
							$rv['order_member_count'] = 0;
							foreach ($orders as $ok=>$ov) {
								$rv['order_member_count'] += intval($ov['male'])+intval($ov['woman'])+intval($ov['child']);
							}
						}
						$recommends[$rk] = $rv;
					}	
				}	
				// 获取更新时间
				$cacheData['data'] = $recommends;
				$cacheData['config_update_time'] = MyHelp::getConfigUpdateTime($recommendKey);
				S($recommendKey, $cacheData, 0);
			}		
			
			if (IS_POST) {
				$data['recommend'] = $recommends;
				$this->ajaxReturn($data);
			} else {
				$this->assign('recommend', $recommends);
			}
		}
	}
	
	/**
	* 专题热门线路
	* @param 专题标志名称 $subjectName
	* @param 专题编号 $subjectId
	* 
	* @return 无
	*/
	private function subjectHotLine($subjectName, $subjectId) {
		if (IS_POST) {
			$refresh = I('post.refresh', false);
		} else {
			$refresh = I('get.refresh',false);
		}
		
		$cacheKey = 'subject_hot_line_'.$subjectName;
		$cacheData = S($cacheKey);
		$hotLine = $cacheData['data'];
		$overdue = MyHelp::checkConfigOverdue($cacheKey, $cacheData['config_update_time']);
		if (empty($cacheData) || empty($hotLine) || !empty($refresh) || $overdue === true) {
			$hotLine = array();
			if (!empty($subjectId)) {
				$subjectDataObj = ModelBase::getInstance('subject_data');
				$conds = appendLogicExp('subject_id', '=', $subjectId);
				$conds = appendLogicExp('key', 'LIKE', 'hot_line_recommend%', 'AND', $conds);
				$subjectData = $subjectDataObj->getAll($conds,0,0,$total,array('sort'=>'asc'));			
				foreach ($subjectData as $hk=>$hv) {
					if (!empty($ids)) {
						$ids .= ',';
					}
					$ids .= $hv['value'];
					$dataMap['line_'.$hv['value']] = $hv;
				}
				if (!empty($ids)) {
					$lines = BackLineHelp::getLineList(appendLogicExp('id', 'IN', '('.$ids.')'));
					foreach ($lines as $lk=>$lv) {
						$ds = $dataMap['line_'.$lv['id']];
						$hotLine[$ds['key']] = $lv;
					}
				}
			}
			// 获取更新时间
			$cacheData['data'] = $hotLine;
			$cacheData['config_update_time'] = MyHelp::getConfigUpdateTime($cacheKey);
			S($cacheKey, $cacheData, 0);
		}		
		if (IS_POST) {
			$data['ds'] = $hotLine;
			$this->ajaxReturn($data);
		} else {
			$this->assign($cacheKey, $hotLine);
		}
	}
	
	/**
	* 专题游记
	* @param 专题标志名称 $subjectName
	* @param 专题编号 $subjectId
	* 
	* @return 无
	*/	
	private function subjectYouji($subjectName, $subjectId) {
		if (IS_POST) {
			$refresh = I('post.refresh', false);
		} else {
			$refresh = I('get.refresh',false);
		}
		
		$cacheKey = 'subject_youji_'.$subjectName;
		$cacheData = S($cacheKey);
		$youji = $cacheData['data'];
		$overdue = MyHelp::checkConfigOverdue($cacheKey, $cacheData['config_update_time']);
		if (empty($cacheData) || empty($youji) || !empty($refresh) || $overdue === true) {
			$youji = array();
			if (!empty($subjectId)) {
				$subjectDataObj = ModelBase::getInstance('subject_data');
				$conds = appendLogicExp('subject_id', '=', $subjectId);
				$conds = appendLogicExp('key', 'LIKE', 'youji%', 'AND', $conds);
				$subjectData = $subjectDataObj->getAll($conds,0,0,$total,array('sort'=>'asc'));
				foreach ($subjectData as $hk=>$hv) {
					if (!empty($hv['value'])) {
						$y = json_decode($hv['value'], true);
						if (!empty($y['url'])) {
							$youji[$hv['key']] = $y;
						}
					}
				}
			}
			// 获取更新时间
			$cacheData['data'] = $youji;
			$cacheData['config_update_time'] = MyHelp::getConfigUpdateTime($cacheKey);
			S($cacheKey, $cacheData, 0);
		}		
		if (IS_POST) {
			$data['ds'] = $youji;
			$this->ajaxReturn($data);
		} else {
			$this->assign($cacheKey, $youji);
		}
	}
	
	/**
	* 周边线路
	* @param 周边线路需要填充的内容 $fill=(batch,order_member_count)
	* 
	* @return
	*/
	private function surroundingLine($subjectKey, $fill=false) {		
		$refresh = IS_POST ? I('post.refresh', false) : I('get.refresh', false);
				
		$station = MyHelp::getStationByIP();
		$surroundingKey = 'subject_surrouding_'.$subjectKey.'_'.$station['id'];
		$cacheData = S($surroundingKey);
		$surrounding = $cacheData['data'];
		$overdue = MyHelp::checkConfigOverdue($surroundingKey, $cacheData['config_update_time']);
		if (empty($cacheData) || empty($surrounding) || !empty($refresh) || $overdue === true) {
			$surrounding = array();
			$setData = MyHelp::getStationHomeSet($station['id']);			
			foreach ($setData as $sk=>$sv) {	
				if (!empty($sv['id']) && stripos($sk, 'surrounding_line_recommend') === 0) {
					// 线路批次
					if (!empty($fill['batch']) || $fill === true) {
						$conds = appendLogicExp('line_id', '=', $sv['id']);
						$conds = appendLogicExp('use_state', 'NOT LIKE', '%line_batch_use_offline%', 'AND', $conds);
						$conds = appendLogicExp('use_state', 'NOT LIKE', '%line_batch_use_forbid%', 'AND', $conds);
						$conds = appendLogicExp('state', 'NOT LIKE', '%line_batch_state_overdue%', 'AND', $conds);
						$conds = appendLogicExp('start_time', '>', fmtNowDateTime(), 'AND', $conds);
						$sv['batchs'] = BackLineHelp::getBatchList($conds);	
					}
					
					// 订单总人数
					if (!empty($fill['order_member_count']) || $fill === true) {
						$conds = appendLogicExp('lineid', '=', $sv['id']);
						$conds = appendLogicExp('new_line', '=', '1', 'AND', $conds);
						$orders = BackOrderHelp::getNewOrderList($conds,0,0,$total,array('addtime'=>'desc'));
						$sv['order_member_count'] = 0;
						foreach ($orders as $ok=>$ov) {
							$sv['order_member_count'] += intval($ov['male'])+intval($ov['woman'])+intval($ov['child']);
						}
					}
					array_push($surrounding, $sv);
				}
			}	
			// 获取更新时间
			$cacheData['data'] = $surrounding;
			$cacheData['config_update_time'] = MyHelp::getConfigUpdateTime($surroundingKey);
			S($surroundingKey, $cacheData, 0);
		}
			
		if (IS_POST) {
			$data['ds'] = $surrounding;
			$this->ajaxReturn($data);
		} else {
			$this->assign('surrounding', $surrounding);
		}
	}
	
	function destinationLine($destKey, $destConds, $pageSize = 0) {		
		if (IS_POST) {
			// 包含景点
			$view = I('post.view', false);
			if (!empty($view)) {
				if (stripos($view, '|') === FALSE) {
					$conds = appendLogicExp('view_point', 'LIKE', '%'.$view.'%', 'AND', $conds);
				} else {
					$views = explode('|',$view);
					foreach ($views as $vk=>$vv) {
						$viewConds = appendLogicExp('view_point', 'LIKE', '%'.$vv.'%', 'OR', $viewConds);
					}
					if (!empty($viewConds)) {
						$conds = appendLogicExp('view_point', '=', $viewConds, 'AND', $conds);
					}
				}
			}
			
			// 出行交通
			$traffic = I('post.traffic', false);
			if (!empty($traffic)) {
				if (stripos($traffic, '|') === FALSE) {
					$conds = appendLogicExp('trip_traffic', 'LIKE', '%'.$traffic.'%', 'AND', $conds);
				} else {
					$traffics = explode('|',$traffic);
					foreach ($traffics as $tk=>$tv) {
						$trafficConds = appendLogicExp('trip_traffic', 'LIKE', '%'.$tv.'%', 'OR', $trafficConds);
					}
					if (!empty($trafficConds)) {
						$conds = appendLogicExp('trip_traffic', '=', $trafficConds, 'AND', $conds);
					}
				}
			}
			
			// 包含主题
			$theme = I('post.theme', false);
			if (!empty($theme)) {
				if (stripos($theme, '|') === FALSE) {
					$conds = appendLogicExp('theme_type', 'LIKE', '%'.$theme.'%', 'AND', $conds);
				} else {
					$themes = explode('|',$theme);
					foreach ($themes as $tk=>$tv) {
						$themeConds = appendLogicExp('theme_type', 'LIKE', '%'.$tv.'%', 'OR', $themeConds);
					}
					if (!empty($viewConds)) {
						$conds = appendLogicExp('theme_type', '=', $themeConds, 'AND', $conds);
					}
				}
			}
			
			// 轻旅拍
			$qlp = I('post.qinglvpai', false);
			if (!empty($qlp)) {
				$conds = appendLogicExp('qinglvpai', '>', '0', 'AND', $conds);				
			}
			
			// 集合地点
			$assembly = I('post.assembly', false);
			if (!empty($assembly)) {
				if (stripos($assembly, '|') === FALSE) {
					$conds = appendLogicExp('assembly_point', 'LIKE', '%'.$assembly.'%', 'AND', $conds);
				} else {
					$assemblys = explode('|',$assembly);
					foreach ($assemblys as $ak=>$av) {
						$assemblyConds = appendLogicExp('assembly_point', 'LIKE', '%'.$av.'%', 'OR', $assemblyConds);
					}
					if (!empty($viewConds)) {
						$conds = appendLogicExp('assembly_point', '=', $assemblyConds, 'AND', $conds);
					}
				}
			}
			
			$season = I('post.season', false);
			if (!empty($season)) {
				if ($season == 'spring') {
					$seasonConds = appendLogicExp('trip_month', 'LIKE', '%三月%', 'OR', $seasonConds);
					$seasonConds = appendLogicExp('trip_month', 'LIKE', '%四月%', 'OR', $seasonConds);
					$seasonConds = appendLogicExp('trip_month', 'LIKE', '%五月%', 'OR', $seasonConds);
				} else if ($season == 'summer') {
					$seasonConds = appendLogicExp('trip_month', 'LIKE', '%六月%', 'OR', $seasonConds);
					$seasonConds = appendLogicExp('trip_month', 'LIKE', '%七月%', 'OR', $seasonConds);
					$seasonConds = appendLogicExp('trip_month', 'LIKE', '%八月%', 'OR', $seasonConds);					
				} else if ($season == 'autumn') {
					$seasonConds = appendLogicExp('trip_month', 'LIKE', '%九月%', 'OR', $seasonConds);
					$seasonConds = appendLogicExp('trip_month', 'LIKE', '%十月%', 'OR', $seasonConds);
					$seasonConds = appendLogicExp('trip_month', 'LIKE', '%十一月%', 'OR', $seasonConds);					
				} else if ($season == 'winter') {
					$seasonConds = appendLogicExp('trip_month', 'LIKE', '%十二月%', 'OR', $seasonConds);
					$seasonConds = appendLogicExp('trip_month', 'LIKE', '%一月%', 'OR', $seasonConds);
					$seasonConds = appendLogicExp('trip_month', 'LIKE', '%二月%', 'OR', $seasonConds);					
				}
				if ($seasonConds) {
					$conds = appendLogicExp('trip_month', '=', $seasonConds, 'AND', $conds);
				}
			}
			
			$play = I('post.play', false);
			if (!empty($play)) {
				$plays = explode('|',$play);
				foreach ($plays as $pk=>$pv) {
					$playConds = appendLogicExp('play_type', 'LIKE', '%'.$pv.'%', 'OR', $playConds);
				}
				if (!empty($playConds)) {
					$conds = appendLogicExp('play_type', '=', $playConds, 'AND', $conds);
				}
			}
			
			$min_price = I('post.min_price', false);
			if (!empty($min_price)) {
				$conds = appendLogicExp('start_price_adult', '>=', $min_price, 'AND', $conds);
			}
			$max_price = I('post.max_price', false);
			if (!empty($max_price)) {
				$conds = appendLogicExp('start_price_adult', '<=', $max_price, 'AND', $conds);
			}
			$min_day = I('post.min_day', false);
			if (!empty($min_day)) {
				$conds = appendLogicExp('travel_day', '>=', $min_day, 'AND', $conds);
			}
			$max_day = I('post.max_day', false);
			if (!empty($max_day)) {
				$conds = appendLogicExp('travel_day', '<=', $max_day, 'AND', $conds);
			}
			
			$refresh = I('post.refresh', false);
		} else {
			$refresh = I('get.refresh', false);
		}
		
		
		$conds = appendLogicExp('destination', '=', $destConds, 'AND', $conds);
		$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
		$conds = appendLogicExp('online', '=', '1', 'AND', $conds);
		
		$data['conds'] = $conds;
		// 强制刷新删除缓存
		$cacheCondsKey = 'subject_'.$destKey.'_cond_index_';
		$cacheDataCondsIndexList = S($cacheCondsKey);
		$condsIndexList = $cacheDataCondsIndexList['data'];
		$overdueCondsIndexList = MyHelp::checkConfigOverdue($cacheCondsKey, $cacheDataCondsIndexList['config_update_time']);		
		
		$cacheLineBaseKey = 'subject_'.$destKey.'_conds_line_';
		if (!empty($refresh) || $overdueCondsIndexList === true) {
			// 清除条件缓存
			S($cacheCondsKey, NULL);
			$condsIndexList = array();
			
			// 清除数据缓存
			for ($i = 0; ; $i++) {
				$line = S($cacheLineBaseKey.$i);
				if (empty($line)) {
					break;
				}
				S($cacheLineBaseKey.$i, NULL);
			}
		}		
		
		// 缓存条件并获取缓存的索引
		$condsstr = json_encode($conds);
		if (empty($cacheDataCondsIndexList) || empty($condsIndexList)) {
			$condIndex = 0;
			$condsIndexList = array($condsstr);
			$cacheDataCondsIndexList['data'] = $condsIndexList;
			$cacheDataCondsIndexList['config_update_time'] = MyHelp::getConfigUpdateTime($cacheCondsKey);
			S($surroundingKey, $cacheDataCondsIndexList, 0);
			
			$cacheTips['cache_line_index'] = '这是新数据';
		} else {
			foreach ($condsIndexList as $ck=>$cv) {
				if ($cv == $condsstr) {
					$condIndex = $ck;
					$cacheTips['cache_line_index'] = '这是缓存';
					break;
				}
			}
			if (isset($condIndex) === FALSE) {
				$condIndex = array_push($condsIndexList, $condsstr) - 1;
				$cacheDataCondsIndexList['data'] = $condsIndexList;
				$cacheDataCondsIndexList['config_update_time'] = MyHelp::getConfigUpdateTime($cacheCondsKey);
				S($surroundingKey, $cacheDataCondsIndexList, 0);
				
				$cacheTips['cache_line_index'] = '这是新数据';
			}
		}
		
		$cacheLineKey = $cacheLineBaseKey.$condIndex;
		$cacheDataLine = S($cacheLineKey);
		$line = $cacheDataLine['data'];
		$overdueLine = MyHelp::checkConfigOverdue($cacheLineKey, $cacheDataLine['config_update_time']);
		if (empty($cacheDataLine) || empty($line) || $overdueLine === true) {
			$line = BackLineHelp::getLineList($conds, 0, $pageSize, $total, array('sort'=>'asc', 'create_time'=>'asc'), false, $out);				
			$data['out'] = $out;
			
			$cacheDataLine['data'] = $line;
			$cacheDataLine['config_update_time'] = MyHelp::getConfigUpdateTime($cacheLineKey);
			S($cacheLineKey, $cacheDataLine, 0);
			
			$cacheTips['line'] = '这是新数据';
		} else{
			$cacheTips['line'] = '这是缓存';
		}
		
		if (IS_POST) {
//			$data['cache'] = $cacheTips;
			$data['ds'] = $line;
			$this->ajaxReturn($data);
		} else {
			$this->assign('dest_line_'.$destKey, $line);
		}
	}
	
	/**
	* 普通主题线路
	* @param 专题编号 $subjectId
	* @param 专题首推页 $firstTab
	* 
	* @return 无
	*/
	private function subjectLine($key, $subjectId, $firstTab) {
		if (empty($key) || empty($subjectId)) {
			if (IS_POST) {
				$data['result'] = error(-1,'错误的专题');
				return $this->ajaxReturn($data);
			} else {
				return $this->showError('404', '专题错误', '没有找到你想要的专题线路');
			}
		}
		
		if (IS_POST) {
			$refresh = I('post.refresh', false);
			$tab = I('post.tab', '');
		} else {
			$refresh = I('get.refresh', false);
			
			$cacheTabKey = 'subject_'.$subjectId.'_line_tab';
			$cacheDataTab = S($cacheTabKey);
			$subjectTab = $cacheDataTab['data'];
			$overdueTab = MyHelp::checkConfigOverdue($cacheTabKey, $cacheDataTab['config_update_time']);
			if (empty($cacheDataTab) || empty($subjectTab) || !empty($refresh) || $overdueTab === true) {			
				$conds = appendLogicExp('subject_id', '=', $subjectId);
				$conds = appendLogicExp('key', 'LIKE', 'tab_%', 'AND', $conds);
				$subjectDataObj = ModelBase::getInstance('subject_data');
				$subjectData = $subjectDataObj->getAll($conds, 0, 0, $total, array('sort'=>'asc'));
				foreach ($subjectData as $sk=>$sv) {
					$subjectTab[$sk] = json_decode($sv['value'], true);
				}
				$cacheDataTab['data'] = $subjectTab;
				$cacheDataTab['config_update_time'] = MyHelp::getConfigUpdateTime($cacheTabKey);
				S($cacheTabKey, $cacheDataTab, 0);
			}
			$tab = $subjectTab[0]['type_key'];
		}
			
		$cacheKey = 'subject_'.$subjectId.'_'.$tab.'_data';
		$cacheData = S($cacheKey);
		$line = $cacheData['data'];
		$overdue = MyHelp::checkConfigOverdue($cacheKey, $cacheData['config_update_time']);
		if (empty($cacheData) || empty($line) || !empty($refresh) || $overdue === true) {
			$conds = appendLogicExp('subject_id', '=', $subjectId);
			$conds = appendLogicExp('key', '=', $tab, 'AND', $conds);
			if (empty($subjectDataObj)) {
				$subjectDataObj = ModelBase::getInstance('subject_data');	
			}
			$subjectData = $subjectDataObj->getOne($conds);
			$line = array();
			if (!empty($subjectData['value'])) {
				$data['subject_data'] = $subjectData;
				$lineList = json_decode($subjectData['value'], true);		
				foreach ($lineList as $lk=>$lv) {
					if (!empty($ids)) {
						$ids .= ','.$lv['id'];
					} else {
						$ids = $lv['id'];
					}
					$lineMap[$lv['id']] = true;
				} 
				$conds = appendLogicExp('id', 'IN', '('.$ids.')');
				$line = BackLineHelp::getLineList($conds, 0, 0, $total, array('sort'=>'asc', 'create_time'=>'asc'), false, $out);				
				foreach ($line as $lk=>$lv) {
					// 线路批次
					$conds = appendLogicExp('line_id', '=', $lv['id']);
					$conds = appendLogicExp('use_state', 'NOT LIKE', '%line_batch_use_offline%', 'AND', $conds);
					$conds = appendLogicExp('use_state', 'NOT LIKE', '%line_batch_use_forbid%', 'AND', $conds);
					$conds = appendLogicExp('state', 'NOT LIKE', '%line_batch_state_overdue%', 'AND', $conds);
					$conds = appendLogicExp('start_time', '>', fmtNowDateTime(), 'AND', $conds);
					$lv['batchs'] = BackLineHelp::getBatchList($conds);
					
					// 订单总人数
					$conds = appendLogicExp('lineid', '=', $lv['id']);
					$conds = appendLogicExp('new_line', '=', '1', 'AND', $conds);
					$orders = BackOrderHelp::getNewOrderList($conds,0,0,$total,array('addtime'=>'desc'));
					$lv['order_member_count'] = 0;
					foreach ($orders as $ok=>$ov) {
						$lv['order_member_count'] += intval($ov['male'])+intval($ov['woman'])+intval($ov['child']);
					}
					$line[$lk] = $lv;
					$lineMap[$lv['id']] = $lv;
				}
			}
			
			// 按照专题排序重新排序
			$line = array();
			foreach ($lineMap as $lmk=>$lmv) {
				array_push($line, $lmv);
			}
			// 获取更新时间
			$cacheData['data'] = $line;
			$cacheData['config_update_time'] = MyHelp::getConfigUpdateTime($cacheKey);
			S($cacheKey, $cacheData, 0);
			$data['line_ids'] = $ids;
		}
		
		if (IS_POST) {
			$data['ds'] = $line;
			$this->ajaxReturn($data);
		} else {
			$this->assign('subject_line_tab_'.$key, $subjectTab);			
			$this->assign('subject_line_'.$key, $line);
		}
	}

	//调用新疆专题SEO文章
	private function seoArticleList(){
		if(IS_GET){
			$refresh = I('get.refresh', false);
			$subjectId = I('get.id', false);
			$seoinfo = S('pc_subject_xinjiang_seo_cache');			
			if(empty($seoinfo) || !empty($refresh)){
				$result = MyHelp::getPageList('seo_article', 'invalid|=|0|AND|classid|=|1|AND|', 0, 6, array('id'=>'desc'), 4, $out);
				if(!empty($result['ds'])){
					$seoinfo = $result['ds'];
				}else{
					$seoinfo = '未查找到数据';
				}			
				S('pc_subject_xinjiang_seo_cache', $seoinfo, 0);
			}
			//$this->assign('seoout', $out);
			$this->assign('seoarticles', $seoinfo);
		}
	}
	
	// 新疆专题
	private function xinjiang() {
		if (IS_POST) {
			$type = I('post.op', false);
			if ($type == 'dest') {
				// 调用目的地新疆线路
				$this->destinationLine('xinjiang', appendLogicExp('destination', 'LIKE', '%新疆%'), 3);
			} else if ($type == 'subject') {
				// 调用专题线路
				$this->subjectLine('xinjiang', 44);
			} else {
				$data['result'] = error(-1, '错误的请求');
				$this->ajaxReturn($data);
			}
		} else {
			// 调用SEO文章
			$this->seoArticleList();
//			// 调用目的地新疆线路
//			$this->destinationLine('xinjiang', appendLogicExp('destination', 'LIKE', '%新疆%'), 3);
			// 调用专题线路
			$this->subjectLine('xinjiang', 44);
			// 调用新疆的推荐线路
			$this->recommendLine('xinjiang', '(361,338,209,35,180,365)');
			// 显示新疆
			$this->showPage('xinjiang', 'subject_xinjiang', 'subject');
		}
	}
	
	// 西北专题
	private function xibei() {
		if (IS_POST) {
			$type = I('post.op', false);
			if ($type == 'xibei1') {
				// 调用专题线路
				$this->subjectLine('xibei1', 25);
			}else if ($type == 'xibei2') {
				// 调用专题线路
				$this->subjectLine('xibei2', 43);
			}  else {
				$data['result'] = error(-1, '错误的请求');
				$this->ajaxReturn($data);
			}
		} else {
			// 调用专题线路
			$this->subjectLine('xibei1', 25);
			// 调用专题线路
			$this->subjectLine('xibei2', 43);
			// 调用新疆的推荐线路
			$this->recommendLine('xibei', '(186,329,35,180,354,236)', true);
			// 调用周边线路
			$this->surroundingLine('xibei', true);
			// 显示新疆
			$this->showPage('xibei', 'subject_xibei', 'subject');
		}
	}
	
	// 额济纳专题
	private function ejina() {
		if (IS_POST) {
			$type = I('post.op', false);
			if ($type == 'ejina') {
				// 调用目的地额济纳线路
				$this->destinationLine('ejina', appendLogicExp('destination', 'LIKE', '%额济纳%'));
			} else {
				$data['result'] = error(-1, '错误的请求');
				$this->ajaxReturn($data);
			}
		} else {
			// 调用额济纳最新报名信息
			$this->topSignupOrder('额济纳');
			// 调用目的地额济纳线路
			$this->destinationLine('ejina', appendLogicExp('destination', 'LIKE', '%额济纳%'));
//			// 调用额济纳的推荐线路
//			$this->recommendLine('ejina', '(348,347,209,338,346,349)');
			// 调用推荐线路
			$this->recommendLine('ejina', '(277)');
			// 调用热卖线路
			$this->subjectHotLine('ejina', 43);
			// 调用游记
			$this->subjectYouji('ejina', 43);
			// 显示额济纳HTML页面
			$this->showPage('ejina', 'subject_ejina', 'subject');
		}
	}
	
	// 丝绸之路专题
	private function silk() {
		if (IS_POST) {
			$type = I('post.op', false);
			if ($type == 'silk') {
				// 调用目的地丝绸之路线路
				$this->destinationLine('silk', appendLogicExp('destination', 'LIKE', '%丝绸之路%'));
			} else {
				$data['result'] = error(-1, '错误的请求');
				$this->ajaxReturn($data);
			}
		} else {
			// 调用丝绸之路最新报名信息
			$this->topSignupOrder('丝绸之路');
			// 调用目的地丝绸之路线路
			$this->destinationLine('silk', appendLogicExp('destination', 'LIKE', '%丝绸之路%'));
			// 调用丝绸之路的推荐线路
			$this->recommendLine('silk', '(186,180,35,291,236,166)');
			// 调用周边游线路
			$this->surroundingLine('silk');
			// 显示丝绸之路HTML页面
			$this->showPage('silk', 'subject_silk', 'subject');
		}
	}
	
	// 川西甘南专题
	private function chuanxi() {
		if (IS_POST) {
			$type = I('post.op', false);
			if ($type == 'gannan') {
				// 调用专题线路
				$this->subjectLine('gannan', 22);
			} else if ($type == 'seda') {
				// 调用专题线路
				$this->subjectLine('seda', 46);
			} else if ($type == 'chuanxi') {
				// 调用专题线路
				$this->subjectLine('chuanxi', 47);
			}  else {
				$data['result'] = error(-1, '错误的请求');
				$this->ajaxReturn($data);
			}
		} else {
			// 调用丝绸之路最新报名信息
			$this->topSignupOrder(array('甘南','四川'));
			// 调用专题线路
			$this->subjectLine('gannan', 22);
			// 调用专题线路
			$this->subjectLine('seda', 46);
			// 调用专题线路
			$this->subjectLine('chuanxi', 47);
			// 调用热卖线路
			$this->subjectHotLine('gannan', 22);
			// 调用游记
			$this->subjectYouji('gannan', 22);
			// 调用游记
			$this->subjectYouji('seda', 46);
			// 调用游记
			$this->subjectYouji('chuanxi', 47);
			// 显示新疆
			$this->showPage('chuanxi', 'subject_chuanxi', 'subject');
		}
	}
}

?>