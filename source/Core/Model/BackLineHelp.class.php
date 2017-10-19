<?php
/**
 * Created by CodeLobster.
 * User: PF
 * Date: 2016-9-24
 * Time: 2016-9-24 14:17:52
 */

namespace Core\Model;

define('LINE_SUBHEADING_SIMPLE_TEXT_COUNT', 25);
define('LINE_SEND_WORD_SIMPLE_TEXT_COUNT', 50);
define('ARTICLE_SEND_WORD_SIMPLE_TEXT_COUNT', 50);
define('VIDEO_SIMPLE_TEXT_COUNT', 10);

class BackLineHelp {
	
	// 获取产品最低最高价
	public static function getLinePrice($lineId, $themeList) {
		$freeLine = false;
		foreach ($themeList as $tk=>$tv) {
			$freeTypeId = MyHelp::TypeDataKey2Value('line_theme_mfhd');
			if ($freeTypeId == $tv['id']) {
				$freeLine = true;
				break;
			}
		}
		
		$batchs = BackLineHelp::getBatchList(appendLogicExp('line_id', '=', $lineId), 0, 0, $total, array('price_adult'=>'asc'), array('cut_money'=>true));
		if (empty($batchs)) {
			$data = array('min'=>array('price_state'=>1), 'max'=>array('price_state'=>1), 'min_cut'=>array('price_state'=>1), 'max_cut'=>array('price_state'=>1));
			$data['result'] = error(-1, '该线路没有相关批次报价');
			return $data;
		}		
		
		if ($freeLine === false) {
			foreach ($batchs as $bk=>$bv) {
				$st = strtotime($bv['start_time']);
				if (time() > $st) {
					continue;
				}
				if ($bv['price_adult'] == 0 && $bv['price_child'] == 0 && $bv['adult_cut'] == 0 && $bv['child_cut'] == 0) {
					continue;
				}
				$minPriceBatch = $bv;
				break;
			}
			// 没有定制价格，price_state存在代表没有定制价格
			if (empty($minPriceBatch)) {
				$batchs[0]['price_state'] = '1';
				$data['min'] = $batchs[0];
			} else {
				$data['min'] = $minPriceBatch;
			}
		} else {
			$data['min'] = $batchs[0];
		}
		$maxIndex = count($batchs)-1;
		$data['max'] = $batchs[$maxIndex];
		return $data;
	}
	
/**
* 获取线路设置
* @param 条件 $conds
* @param 开始索引 $startIndex
* @param 每页数量 $pageCount
* @param 数据总数 $totalCount
* @param 排序列 $sortCols
* @param 填充内容 $find = {
* 	line: 填充线路
* }
* 
* @return
*/
	public static function getLineSetList($conds, $startIndex, $pageCount, &$totalCount, $sortCols, $find=false, &$out) {
		$setObj = ModelBase::getInstance('line_set');
		$sets = $setObj->getAll($conds, $startIndex, $pageCount, $totalCount, $sortCols, false, $out);
		foreach ($sets as $sk=>$sv) {
			if (!empty($sv['value_type'])) {
				$valType = strtolower($sv['value_type']);
				if ($valType == 'json') {
					$sv['value'] = json_decode($sv['value'], true);
				} else if ($valType == 'line') {
					$sv['value'] = BackLineHelp::getLine(appendLogicExp('id', '=', $sv['value']), false);
				}
			}
			$sets[$sk] = $sv;
		}
		return $sets;
	}

/**
* 获取线路列表
* @param 条件 $conds
* @param 开始索引 $startIndex
* @param 每页数量 $pageCount
* @param 数据总数 $totalCount
* @param 排序列 $sortCols
* @param 填充内容 $find = {
	* min_batch: 价格最便宜的批次
	* point: 行程亮点
	* phone_point: 手机行程亮点
	* travel: 行程安排
	* scenery: 沿途风光
	* batch: 批次
	* offer: 线路优惠
	* question: 线路问题
	* article: 绑定文章
	* set: 线路其他设定 
}
* array('min_batch'=>true,'point'=>true,'travel'=>true,'scenery'=>true,'batch'=>true,'offer'=>true,'question'=>true, 'set'=>true);
* @return $lines // 线路列表
*/

	public static function getLineList($conds, $startIndex, $pageCount, &$totalCount, $sortCols, $find=false, &$out) {
		$lineObj = ModelBase::getInstance('line');
		$lines = $lineObj->getAll($conds, $startIndex, $pageCount, $totalCount, $sortCols, false, $out);
		if (!empty($lines)) {
			$pointObj = ModelBase::getInstance('line_point_scenery');
			$travelObj = ModelBase::getInstance('travel_intro');
			$batchObj = ModelBase::getInstance('batch');
			$specialObj = ModelBase::getInstance('line_special_offer');
			$pointTypeId = MyHelp::TypeDataKey2Value('line_point_content_pc_view');
			$pointPhoneTypeId = MyHelp::TypeDataKey2Value('line_point_content_phone_view');
			$sceneryTypeId = MyHelp::TypeDataKey2Value('line_point_content_scenery');
			$questionTypeId = MyHelp::TypeDataKey2Value('question_type_line');
			foreach ($lines as $lk=>$lv) {
				$lv['cost_description'] = htmlspecialchars_decode($lv['cost_description']);
				$lv['booking_notes'] = htmlspecialchars_decode($lv['booking_notes']);	
			
				$lv['subheading_show'] = $lv['subheading'];
				if (mb_strlen($lv['subheading'], 'utf8') > LINE_SUBHEADING_SIMPLE_TEXT_COUNT) {
					$lv['subheading_show'] = mb_substr($lv['subheading'], 0, LINE_SUBHEADING_SIMPLE_TEXT_COUNT, 'utf8');
					$lv['subheading_show'] .= '...';
				}
			
				$lv['send_word_show'] = $lv['send_word'];
				if (mb_strlen($lv['send_word'], 'utf8') > LINE_SEND_WORD_SIMPLE_TEXT_COUNT) {
					$lv['send_word_show'] = mb_substr($lv['send_word'], 0, LINE_SEND_WORD_SIMPLE_TEXT_COUNT, 'utf8');
					$lv['send_word_show'] .= '...';
				}
			
				// 特殊标记图片
				if (!empty($lv['time_preference'])) {
					$lv['line_especial_icon'] = 'indulgence.png';
				} else if (!empty($lv['hot'])) {
					$lv['line_especial_icon'] = 'today_hot.png';
				} else if (!empty($lv['recommend'])) {
					$lv['line_especial_icon'] = 'recommend.png';
				} else if (!empty($lv['leader_recommend'])) {
					$lv['line_especial_icon'] = 'leader_recommend.png';
				} 
				
			
				// 线路所属站点
				if (!empty($lv['station'])) {
					$stations = json_decode($lv['station'], true);
					foreach ($stations as $sk=>$sv) {
						$lv['station_data'][$sk] = BackAccountHelp::StationTypeKey2Value($sv['id'], true);
						if (is_error($lv['station_data'][$sk]) === false) {
							if (empty($lv['station_show'])) {
								$lv['station_show'] = $lv['station_data'][$sk]['name'];	
							} else {
								$lv['station_show'] .= ','.$lv['station_data'][$sk]['name'];	
							}
						}
					}				
				}
			
				// 线路特色主题
				$lv['is_xinlvpai'] = intval($lv['qinglvpai']) > 0 ? 1 : 0;
				if (!empty($lv['theme_type'])) {
					$lv['free_line'] = 0;
					// 免费线路
					$freeTypeId = MyHelp::TypeDataKey2Value('line_theme_mfhd');
					// 新旅拍线路
					$xinlvpaiId = MyHelp::TypeDataKey2Value('line_theme_qlp');
					$tt = json_decode($lv['theme_type'], true);
					foreach ($tt as $tk=>$tv) {
						if (empty($lv['theme_type_show_text'])) {
							$lv['theme_type_show_text'] = $tv['type_desc'];	
						} else {
							$lv['theme_type_show_text'] .= ','.$tv['type_desc'];
						}
						$tv['type_key'] = MyHelp::TypeDataKey2Value($tv['id']);
						if ($freeTypeId == $tv['id']) {
							$lv['free_line'] = 1;							
						}
						if ($xinlvpaiId == $tv['id']) {
							$lv['is_xinlvpai'] = 1;
						}
						$tt[$tk] = $tv;
					}
					$lv['theme_type_list'] = $tt;
				}
				
				// 集合地点
				if (!empty($lv['assembly_point'])) {
					$ap = json_decode($lv['assembly_point'], true);
					$lv['assembly_point_list'] = $ap;
					foreach ($ap as $ak=>$av) {
						if (empty($lv['assembly_point_show_text'])) {
							$lv['assembly_point_show_text'] = $av['type_desc'];	
						} else {
							$lv['assembly_point_show_text'] .= ','.$av['type_desc'];
						}
					}
				}
				
				// 目的地点
				if (!empty($lv['destination'])) {
					$dest = json_decode($lv['destination'], true);
					$lv['destination_list'] = $dest;
					foreach ($dest as $dk=>$dv) {
						if (empty($lv['destination_show_text'])) {
							$lv['destination_show_text'] = $dv['type_desc'];	
						} else {
							$lv['destination_show_text'] .= ','.$dv['type_desc'];
						}
					}
				}	
				
				// 包含景点
				if (!empty($lv['view_point'])) {
					$view_point = json_decode($lv['view_point'], true);
					$lv['view_point_list'] = $view_point;
					foreach ($view_point as $vk=>$vv) {
						if (empty($lv['view_point_show_text'])) {
							$lv['view_point_show_text'] = $vv['type_desc'];	
						} else {
							$lv['view_point_show_text'] .= ','.$vv['type_desc'];
						}
					}
				}		
			
				// 赠品
				if (!empty($lv['largess'])) {
					$largess = json_decode($lv['largess'], true);
					$lv['largess_list'] = $largess;
					foreach ($largess as $llk=>$llv) {
						if (empty($lv['largess_show_text'])) {
							$lv['largess_show_text'] = $llv['type_desc'];	
						} else {
							$lv['largess_show_text'] .= ','.$llv['type_desc'];
						}
					}
				}		 			
				
				// 最大最小价格批次
				if (!empty($find['min_batch']) || $find === true) {
					// 最大最小价格批次
					$price = BackLineHelp::getLinePrice($lv['id'], $lv['theme_type_list']);
					if (empty($price['result'])) {
						$lv['min_batch'] = $price['min'];
						$lv['max_batch'] = $price['max'];
					} else {
						$lv['price_result'] = $price;
					}
				}
					
				// PC行程亮点
				if (!empty($find['point']) || $find === true) {
					$conds = appendLogicExp('line_id', '=', $lv['id']);
					$conds = appendLogicExp('type_id', '=', $pointTypeId, 'AND', $conds);
					$lv['points'] = $pointObj->getAll($conds, 0, 0, $total, array('index'=>'asc'));
					foreach($lv['points'] as $pk=>$pv) {
						if (!empty($pv['content'])) {
							$pv['content'] = htmlspecialchars_decode($pv['content']);
							$lv['points'][$pk] = $pv;
						}
					}
				}
					
				// 手机行程亮点
				if (!empty($find['phone_point']) || $find === true) {
					$conds = appendLogicExp('line_id', '=', $lv['id']);
					$conds = appendLogicExp('type_id', '=', $pointPhoneTypeId, 'AND', $conds);
					$lv['phone_points'] = $pointObj->getAll($conds, 0, 0, $total, array('index'=>'asc'));
					foreach($lv['phone_points'] as $pk=>$pv) {
						if (!empty($pv['content'])) {
							$pv['content'] = htmlspecialchars_decode($pv['content']);
							$lv['phone_points'][$pk] = $pv;
						}
					}
				}
				
				// 行程描述
				if (!empty($find['travel']) || $find === true) {
					$conds = appendLogicExp('line_id', '=', $lv['id']);
					$lv['travels'] = $travelObj->getAll($conds, 0, 0, $total, array('day_id'=>'asc'));
					foreach ($lv['travels'] as $tk=>$tv) {						
						$tv['intro'] = htmlspecialchars_decode($tv['intro']);
						$tv['kindly_reminder'] = htmlspecialchars_decode($tv['kindly_reminder']);
						$lv['travels'][$tk] = $tv;
					}
					$lv['real_travel_day'] = count($lv['travels']);
				}
				
				// 沿途风光	
				if (!empty($find['scenery']) || $find === true) {
					$conds = appendLogicExp('line_id', '=', $lv['id']);
					$conds = appendLogicExp('type_id', '=', $sceneryTypeId, 'AND', $conds);
					$lv['scenery'] = $pointObj->getAll($conds, 0, 0, $total, array('index'=>'asc'));
					foreach($lv['scenery'] as $pk=>$pv) {
						if (!empty($pv['content'])) {
							$pv['content'] = htmlspecialchars_decode($pv['content']);
							$lv['scenery'][$pk] = $pv;
						}
					}
				}
				
				// 批次
				$conds = appendLogicExp('line_id', '=', $lv['id']);
				if (!empty($find['batch']) || $find === true) {
					if (is_array($find['batch'])) {
						$batchFind = $find['batch'];
					} else {
						$batchFind = false;
					}
					$lv['batchs'] = BackLineHelp::getBatchList($conds, 0, 0, $total, array('start_time'=>'asc'),$batchFind);
				}
				
				// 优惠
				if (!empty($find['offer']) || $find === true) {
					$lv['offers'] = BackLineHelp::getSpecialOfferList($conds, 0, 0, $total, array('start_time'=>'desc'));
				}		
					
				// 问题
				if (!empty($find['question']) || $find === true) {
					$conds = appendLogicExp('type_id', '=', $questionTypeId);
					$conds = appendLogicExp('line_id', '=', $lv['id'], 'AND', $conds);
					$conds = appendLogicExp('question_id', '=', '0', 'AND', $conds);
					$sort = array('create_time'=>'desc');
					$questionFind = false;
					if (is_array($find['question'])) {
						$questionFind = $find['question'];
					}
					$lv['questions'] = BackLineHelp::getQuestionList($conds, 0, LINE_QUESTION_LIST_SHOW_COUNT, $total, $sort, $questionFind);				
					// 页数
					$pageCount = intval($total / LINE_QUESTION_LIST_SHOW_COUNT);
					if (intval($total % LINE_QUESTION_LIST_SHOW_COUNT) == 1) {
						$pageCount += 1;
					}
					$lv['question_page_count'] = $pageCount;
				}
								
				// 线路设置
				if (!empty($find['set']) || $find === true) {
					$conds = appendLogicExp('line_id', '=', $lv['id']);
					$setSort = array('key'=>'asc', 'sort'=>'asc');
					$setFind = is_array($find['set']) ? $find['set'] : false;
					$lv['sets'] = BackLineHelp::getLineSetList($conds, 0, 0, $total, $setSort, $setFind);
				}
				
				// 绑定文章
//				if (!empty($find['article']) || $find === true) {
//					if (!empty($lv['articles'])) {
//						$conds = appendLogicExp('id', 'IN', '('.$lv['articles'].')');
//						$articleSort = array('create_time'=>'desc');
//						$articleFind = false;
//						if (is_array($find['article'])) {
//							$articleFind = $find['article'];
//						}
//						$lv['articles'] = BackLineHelp::getArticleList($conds, 0, 0, $total, $articleSort, $articleFind);
//					}
//				}
				$lines[$lk] = $lv;
			}
		}
		return $lines;
	}
	
/**
* 获取线路信息
* @param 条件 $conds
* @param 填充内容 $find = {	
	* min_batch: 价格最便宜的批次
	* point: 行程亮点
	* phone_point: 手机行程亮点
	* travel: 行程安排
	* scenery: 沿途风光
	* batch: 批次
	* offer: 线路优惠
	* question: 线路问题
	* article: 绑定文章
	* set: 线路其他设定 
}
* 
* @return
*/
	public static function getLine($conds, $find=false) {
		$lineObj = ModelBase::getInstance('line');
		$line = $lineObj->getOne($conds);
		if (!empty($line)) {
			$line['cost_description'] = htmlspecialchars_decode($line['cost_description']);
			$line['booking_notes'] = htmlspecialchars_decode($line['booking_notes']);
			
			$line['subheading_show'] = $line['subheading'];
			if (mb_strlen($line['subheading'], 'utf8') > LINE_SUBHEADING_SIMPLE_TEXT_COUNT) {
				$line['subheading_show'] = mb_substr($line['subheading'], 0, LINE_SUBHEADING_SIMPLE_TEXT_COUNT, 'utf8');
				$line['subheading_show'] .= '...';
			}
			
			$line['send_word_show'] = $line['send_word'];
			if (mb_strlen($line['send_word'], 'utf8') > LINE_SEND_WORD_SIMPLE_TEXT_COUNT) {
				$line['send_word_show'] = mb_substr($line['send_word'], 0, LINE_SEND_WORD_SIMPLE_TEXT_COUNT, 'utf8');
				$line['send_word_show'] .= '...';
			}
			
			// 特殊标记图片
			if (!empty($line['time_preference'])) {
				$line['line_especial_icon'] = 'indulgence.png';
			} else if (!empty($line['hot'])) {
				$line['line_especial_icon'] = 'today_hot.png';
			} else if (!empty($line['recommend'])) {
				$line['line_especial_icon'] = 'recommend.png';
			} else if (!empty($line['leader_recommend'])) {
				$line['line_especial_icon'] = 'leader_recommend.png';
			} 
			
			
			// 线路所属站点
			if (!empty($line['station'])) {
				$stations = json_decode($line['station'], true);
				foreach ($stations as $sk=>$sv) {
					$line['station_data'][$sk] = BackAccountHelp::StationTypeKey2Value($sv['id'], true);
					if (is_error($line['station_data'][$sk]) === false) {
						if (empty($line['station_show'])) {
							$line['station_show'] = $line['station_data'][$sk]['name'];	
						} else {
							$line['station_show'] .= ','.$line['station_data'][$sk]['name'];	
						}
					}
				}				
			}
			
			// 线路特色主题
			$line['is_xinlvpai'] = intval($line['qinglvpai']) > 0 ? 1 : 0;
			if (!empty($line['theme_type'])) {
				$line['free_line'] = 0;
				// 免费线路
				$freeTypeId = MyHelp::TypeDataKey2Value('line_theme_mfhd');
				// 新旅拍线路
				$xinlvpaiId = MyHelp::TypeDataKey2Value('line_theme_qlp');
				$tt = json_decode($line['theme_type'], true);
				foreach ($tt as $tk=>$tv) {
					if (empty($line['theme_type_show_text'])) {
						$line['theme_type_show_text'] = $tv['type_desc'];	
					} else {
						$line['theme_type_show_text'] .= ','.$tv['type_desc'];
					}
					$tv['type_key'] = MyHelp::TypeDataKey2Value($tv['id']);
					if ($freeTypeId == $tv['id']) {
						$line['free_line'] = 1;							
					}
					if ($xinlvpaiId == $tv['id']) {
						$line['is_xinlvpai'] = 1;
					}
					$tt[$tk] = $tv;
				}
				$line['theme_type_list'] = $tt;
			}	
			// 集合地点
			if (!empty($line['assembly_point'])) {
				$ap = json_decode($line['assembly_point'], true);
				$line['assembly_point_list'] = $ap;
				foreach ($ap as $ak=>$av) {
					if (empty($line['assembly_point_show_text'])) {
						$line['assembly_point_show_text'] = $av['type_desc'];	
					} else {
						$line['assembly_point_show_text'] .= ','.$av['type_desc'];
					}
				}
			}
			// 人员类型约束
			if (!empty($line['member_type'])) {
				$mt = json_decode($line['member_type'], true);
				$line['member_type_data'] = $mt;
			}
			
			// 目的地点
			if (!empty($line['destination'])) {
				$dest = json_decode($line['destination'], true);
				$line['destination_list'] = $dest;
				foreach ($dest as $dk=>$dv) {
					if (empty($line['destination_show_text'])) {
						$line['destination_show_text'] = $dv['type_desc'];	
					} else {
						$line['destination_show_text'] .= ','.$dv['type_desc'];
					}
				}
			}	
				
			// 包含景点
			if (!empty($line['view_point'])) {
				$view_point = json_decode($line['view_point'], true);
				$line['view_point_list'] = $view_point;
				foreach ($view_point as $vk=>$vv) {
					if (empty($line['view_point_show_text'])) {
						$line['view_point_show_text'] = $vv['type_desc'];	
					} else {
						$line['view_point_show_text'] .= ','.$vv['type_desc'];
					}
				}
			}
			
			// 赠品
			if (!empty($line['largess'])) {
				$largess = json_decode($line['largess'], true);
				$line['largess_list'] = $largess;
				foreach ($largess as $lk=>$lv) {
					if (empty($line['largess_show_text'])) {
						$line['largess_show_text'] = $lv['type_desc'];	
					} else {
						$line['largess_show_text'] .= ','.$lv['type_desc'];
					}
				}
			}	
							
			// 最大最小价格批次
			if (!empty($find['min_batch']) || $find === true) {
				$price = BackLineHelp::getLinePrice($line['id'],$line['theme_type_list']);
				if (empty($price['result'])) {
					$line['min_batch'] = $price['min'];
					$line['max_batch'] = $price['max'];
				} else {
					$line['price_result'] = $price;
				}
			}
				
			// PC行程亮点
			if (!empty($find['point']) || $find === true) {
				$typeId = MyHelp::TypeDataKey2Value('line_point_content_pc_view');
				$pointObj = ModelBase::getInstance('line_point_scenery');
				$conds = appendLogicExp('line_id', '=', $line['id']);
				$conds = appendLogicExp('type_id', '=', $typeId, 'AND', $conds);
				$line['points'] = $pointObj->getAll($conds, 0, 0, $total, array('index'=>'asc'));
				foreach($line['points'] as $pk=>$pv) {
					if (!empty($pv['content'])) {
						$pv['content'] = htmlspecialchars_decode($pv['content']);
						$line['points'][$pk] = $pv;
					}
				}
			}
				
			// 手机行程亮点
			if (!empty($find['phone_point']) || $find === true) {
				$typeId = MyHelp::TypeDataKey2Value('line_point_content_phone_view');
				$pointObj = ModelBase::getInstance('line_point_scenery');
				$conds = appendLogicExp('line_id', '=', $line['id']);
				$conds = appendLogicExp('type_id', '=', $typeId, 'AND', $conds);
				$line['phone_points'] = $pointObj->getAll($conds, 0, 0, $total, array('index'=>'asc'));
				foreach($line['phone_points'] as $pk=>$pv) {
					if (!empty($pv['content'])) {
						$pv['content'] = htmlspecialchars_decode($pv['content']);
						$line['phone_points'][$pk] = $pv;
					}
				}
			}
			
			// 行程描述
			if (!empty($find['travel']) || $find === true) {
				$travelObj = ModelBase::getInstance('travel_intro');
				$conds = appendLogicExp('line_id', '=', $line['id']);
				$line['travels'] = $travelObj->getAll($conds, 0, 0, $total, array('day_id'=>'asc'));
				foreach ($line['travels'] as $tk=>$tv) {						
					$tv['intro'] = htmlspecialchars_decode($tv['intro']);
					$tv['kindly_reminder'] = htmlspecialchars_decode($tv['kindly_reminder']);
					$line['travels'][$tk] = $tv;
				}
				$line['real_travel_day'] = count($line['travels']);
			}
			// 沿途风光	
			if (!empty($find['scenery']) || $find === true) {
				$typeId = MyHelp::IdEachTypeKey('type_data', 'line_point_content_scenery');
				$conds = appendLogicExp('line_id', '=', $line['id']);
				$conds = appendLogicExp('type_id', '=', $typeId, 'AND', $conds);
				$line['scenery'] = $pointObj->getAll($conds, 0, 0, $total, array('index'=>'asc'));
				foreach($line['scenery'] as $pk=>$pv) {
					if (!empty($pv['content'])) {
						$pv['content'] = htmlspecialchars_decode($pv['content']);
						$line['scenery'][$pk] = $pv;
					}
				}
			}
			// 批次
			$conds = appendLogicExp('line_id', '=', $line['id']);
			if (!empty($find['batch']) || $find === true) {
				if (is_array($find['batch'])) {
					$batchFind = $find['batch'];
				} else {
					$batchFind = false;
				}
				$line['batchs'] = BackLineHelp::getBatchList($conds, 0, 0, $total, array('start_time'=>'asc'),$batchFind);
			}
			// 优惠
			if (!empty($find['offer']) || $find === true) {
				$line['offers'] = BackLineHelp::getSpecialOfferList($conds, 0, 0, $total, array('start_time'=>'desc'));
			}			
			// 问题
			if (!empty($find['question']) || $find === true) {
				$conds = appendLogicExp('type_id', '=', $questionTypeId);
				$conds = appendLogicExp('line_id', '=', $line['id'], 'AND', $conds);
				$sort = array('create_time'=>'desc');
				$questionFind = false;
				if (is_array($find['question'])) {
					$questionFind = $find['question'];
				}
				$line['questions'] = BackLineHelp::getQuestionList($conds, 0, LINE_QUESTION_LIST_SHOW_COUNT, $total, $sort, $questionFind);
				// 页数
				$pageCount = intval($total / LINE_QUESTION_LIST_SHOW_COUNT);
				if (intval($total % LINE_QUESTION_LIST_SHOW_COUNT) == 1) {
					$pageCount += 1;
				}
				$line['question_page_count'] = $pageCount;
			}				
			// 线路设置
			if (!empty($find['set']) || $find === true) {
				$conds = appendLogicExp('line_id', '=', $line['id']);
				$setSort = array('key'=>'asc', 'sort'=>'asc');
				$setFind = is_array($find['set']) ? $find['set'] : false;
				$line['sets'] = BackLineHelp::getLineSetList($conds, 0, 0, $total, $setSort, $setFind, $out);
				$line['set_out'] = $out;
			}
//			// 绑定文章
//			if (!empty($find['article']) || $find === true) {
//				if (!empty($line['articles'])) {
//					$conds = appendLogicExp('id', 'IN', '('.$line['articles'].')');
//					$articleSort = array('create_time'=>'desc');
//					$articleFind = false;
//					if (is_array($find['article'])) {
//						$articleFind = $find['article'];
//					}
//					$line['articles'] = BackLineHelp::getArticleList($conds, 0, 0, $total, $articleSort, $articleFind);
//				}
//			}
		}
		return $line;
	}
	
	// 修改产品信息
	public static function updateLine($ds, $conds) {
		if (empty($ds) || empty($conds)) {
			return error(-1, '条件或者更新数据不能为空');
		}
		$lineObj = ModelBase::getInstance('line');
		return $lineObj->modify($ds, $conds);		
	}
	
	// 获取该批次内的报名总人数
	public static function getBatchSubMember($batchId, $carMemberCount, &$out) {
		if (empty($batchId)) {
			return $carMemberCount;
		}
		$carMemberCount = intval($carMemberCount);
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$conds = appendLogicExp('hdid', '=', $batchId);
		$conds = appendLogicExp('new_line', '=', '1', 'AND', $conds);
		$conds = appendLogicExp('order_sn', 'NOT LIKE', 'RQ-', 'AND', $conds);
		$conds = appendLogicExp('zhuangtai', 'IN', '(2,7,8,10)', 'AND', $conds);
		$orders = $orderObj->getAll($conds);
//		$out['sql'] = $orderObj->getLastSql();
		
		$memberCount = 0;
		foreach ($orders as $ok=>$ov) {
			$memberCount += intval($ov['male']);
			$memberCount += intval($ov['woman']);
			$memberCount += intval($ov['child']);
		}		
//		$out['member_count'] = $memberCount;
//		$out['car_member'] = $carMemberCount;
		if (empty($memberCount)) {
			return $carMemberCount;
		}		
		$subMember = $carMemberCount - ($memberCount % $carMemberCount);
//		$out['sub_member'] = $subMember;
		return $subMember;
	}
	
/**
* 获取批次列表
* @param 条件 $conds
* @param 开始索引 $startIndex
* @param 每页数量 $pageCount
* @param 数据总数 $totalCount
* @param 排序列 $sortCols
* @param 填充内容 $find = {
	* cut_money: 优惠后最小最大价格
}
* array('cut_money'=>true);
* @return $batchs // 批次列表
*/
	public static function getBatchList($conds, $startIndex, $pageCount, &$totalCount, $sortCols, $fill=false) {
		$offerList = array();
		
		$overdue = MyHelp::TypeDataKey2Value('line_batch_state_overdue',true);
		
		$batchObj = ModelBase::getInstance('batch');
		$conds = appendLogicExp('invalid', '=', appendLogicExp('invalid', '=', '0', 'AND'), 'AND', $conds);
		$batchs = $batchObj->getAll($conds, $startIndex, $pageCount, $totalCount, $sortCols, false);
		if (!empty($batchs)) {
			foreach ($batchs as $bk=>$bv) {			
				$unix_start_time = strtotime($bv['start_time']);
				$unix_stop_time = strtotime($bv['stop_time']);	
				$unix_end_time = strtotime($bv['end_time']);
				$bv['start_before_day'] = intval(($unix_start_time - $unix_stop_time) / 86400);
				$start_date = explode(' ', $bv['start_time']);
				$bv['start_date_show'] = $start_date[0]; 
				$end_date = explode(' ', $bv['end_time']);
				$bv['end_date_show'] = $end_date[0]; 
				$stop_date = explode(' ', $bv['stop_time']);
				$bv['stop_date_show'] = $stop_date[0]; 
				// 已过报名时间
				$bv['signup_invalid'] = $unix_stop_time - time() < 0 ? 1 : 0;
				// 是否可使用			
				$bv['can_use'] = 1;
				$useState = json_decode($batch['use_state'], true);					
				$useStateKey = MyHelp::TypeDataKey2Value($useState['id'],false);
				if ($useStateKey == 'line_batch_use_offline' || $useStateKey == 'line_batch_use_forbid'){				
					$bv['can_use'] = 0;
				}
				
				$bv['old_state'] = $bv['state'];
				// 批次状态改为无效
				if ($bv['signup_invalid'] == 1) {
					if (is_error($overdue) === false) {
						$state = json_decode($bv['state'], true);
						$bv['state'] = json_encode($overdue);
						if ($state['id'] != $overdue['id']) {
							$batchObj->modify(array('state'=>$bv['state']), appendLogicExp('id', '=', $bv['id']));
						}
					}
				}
				
				if (!empty($bv['state'])) {
					$bv['state_data'] = json_decode($bv['state'],true);
				}
				
				if (!empty($fill['cut_money']) || $fill === true) {
					if (empty($offerList[$bv['line_id']])) {
						$offers = BackLineHelp::getSpecialOfferList(appendLogicExp('line_id', '=', $bv['line_id']));
						if (!empty($offers)) {
							$offerList[$bv['line_id']] = $offers;
						}
					} else {
						$offers = $offerList[$bv['line_id']];
					}
					$result = BackLineHelp::getBatchPriceByData($bv, $offers);
					if (empty($result['result'])) {
						$bv['adult_cut'] = $result['adult_cut_price'];
						$bv['child_cut'] = $result['child_cut_price'];
					} else {
						$bv['cut_result'] = $result['result'];
					}
				}
				
				$batchs[$bk] = $bv;
			}
		}
		return $batchs;
	}
	
/**
* 获取批次信息
* @param 条件 $conds
* @param 填充内容 $find = {
	* cut_money: 优惠后最小最大价格
}
* array('cut_money'=>true);
* @return $batch
*/
	public static function getBatch($conds, $fill=false) {
		$batchObj = ModelBase::getInstance('batch');
		$batch = $batchObj->getOne($conds);
		if (!empty($batch)) {
			$unix_start_time = strtotime($batch['start_time']);
			$unix_stop_time = strtotime($batch['stop_time']);	
			$unix_end_time = strtotime($bv['end_time']);
			$batch['start_before_day'] = intval(($unix_start_time - $unix_stop_time) / 86400);
			$start_date = explode(' ', $batch['start_time']);
			$batch['start_date_show'] = $start_date[0]; 
			$end_date = explode(' ', $batch['end_time']);
			$batch['end_date_show'] = $end_date[0];
			$stop_date = explode(' ', $batch['stop_time']);
			$batch['stop_date_show'] = $stop_date[0]; 
			// 已过报名时间
			$batch['signup_invalid'] = $unix_stop_time - time() < 0 ? 1 : 0;
			// 是否可使用			
			$batch['can_use'] = 1;
			$useState = json_decode($batch['use_state'], true);			
			$useStateKey = MyHelp::TypeDataKey2Value($useState['id'],false);
			if ($useStateKey == 'line_batch_use_offline' || $useStateKey == 'line_batch_use_forbid'){				
				$batch['can_use'] = 0;
			}
			
			// 批次状态改为无效
			$batch['old_state'] = $batch['state'];
			if ($batch['signup_invalid'] == 1) {
				$overdue = MyHelp::TypeDataKey2Value('line_batch_state_overdue',true);
				if (is_error($overdue) === false) {
					$state = json_decode($batch['state'], true);
					$batch['state'] = json_encode($overdue);
					if ($state['id'] != $overdue['id']) {
						$batchObj->modify(array('state'=>$batch['state']), appendLogicExp('id', '=', $batch['id']));
					}
				}
			}
				
			if (!empty($batch['state'])) {
				$batch['state_data'] = json_decode($batch['state'],true);
			}
			
			if (!empty($fill['cut_money'])) {
				$offers = BackLineHelp::getSpecialOfferList(appendLogicExp('line_id', '=', $batch['line_id']));
				$result = BackLineHelp::getBatchPriceByData($batch, $offers);
				if (empty($result['result'])) {
					$batch['adult_cut'] = $result['adult_cut_price'];
					$batch['child_cut'] = $result['child_cut_price'];
				} else {
					$batch['cut_result'] = $result['result'];
				}
			}
		}
		return $batch;
	}
	
	// 获取批次价格根据批次编号
	public static function getBatchPriceById($batchId) {
		$batch = BackLineHelp::getBatch(appendLogicExp('id', '=', $batchId));
		if (empty($batch)) {
			$data = array('adult_price'=>0, 'child_price'=>0, 'adult_cut_price'=>0, 'child_cut_price'=>0);
			$data['result'] = error(-1, '该线路没有相关批次报价');
			return $data;
		}
		
		$offers = BackLineHelp::getSpecialOfferList(appendLogicExp('line_id', '=', $batch['line_id']));
		return BackLineHelp::getBatchPriceByData($batch, $offers);
	}
	
	// 获取批次价格根据批次数据
	public static function getBatchPriceByData($batch, $offers) {
		$adult_price = floatval($batch['price_adult']);
		$child_price = floatval($batch['price_child']);
		
		$data = array('adult_price'=>$adult_price, 'child_price'=>$child_price, 'adult_cut_price'=>$adult_price, 'child_cut_price'=>$child_price);
//		$data['cut_price_adult'] = 0.00;
//		$data['cut_price_child'] = 0.00;
		if (!empty($offers)) {
			foreach($offers as $ok=>$ov) {
				$nowTime = strtotime('now');
				// 确保优惠在有效期内
				if ($nowTime < strtotime($ov['start_time']) || $nowTime > strtotime($ov['end_time'])) {
					continue;
				}
				if (!empty($ov['type_id'])) {
					// 计算对比优惠力度大的优惠
					$curAdultPrice = floatval($adult_price) * $ov['cut_percent'] * 0.01 + floatval($ov['cut_money']);
					$curChildPrice = floatval($child_price) * $ov['cut_percent'] * 0.01 + floatval($ov['cut_money']);
					$adult_cut = 0.00; $child_cut = 0.00;
					
					$type = json_decode($ov['type_id'],true);
					if (empty($offerList[$type['id']])){
						$offerList[$type['id']] = $ov;						
						if ($type['type_key'] == 'line_special_offer_adult') {
							$adult_cut = $curAdultPrice;							
						} else if ($type['type_key'] == 'line_special_offer_child') {
							$child_cut = $curChildPrice;
						} else if ($type['type_key'] == 'line_special_offer_full_cut' || $type['type_key'] == 'line_special_offer_count') {
							$adult_cut = $curAdultPrice;
							$child_cut = $curChildPrice;
						}										
					} else {						
						$cmp = $offerList[$type['id']];
						$cmpAdultPrice = floatval($cmp['cut_percent']) * 0.01 * $adult_price + floatval($cmp['cut_money']);
						$cmpChildPrice = floatval($cmp['cut_percent']) * 0.01 * $child_price + floatval($cmp['cut_money']);
						
						if ($type['type_key'] == 'line_special_offer_adult') {
							if ($curAdultPrice > $cmpAdultPrice) {
								$adult_cut = $curAdultPrice;
							}
						} else if ($type['type_key'] == 'line_special_offer_child') {
							if ($curChildPrice > $cmpChildPrice) {
								$child_cut = $curChildPrice;
							}							
						} else if ($type['type_key'] == 'line_special_offer_full_cut' || $type['type_key'] == 'line_special_offer_count') {
							if (($curAdultPrice + $curChildPrice) > ($cmpAdultPrice + $cmpChildPrice)) {
								$adult_cut = $curAdultPrice;
								$child_cut = $curChildPrice;
							}	
						}
					}
					$data['adult_cut_price'] = floatval($data['adult_cut_price'] - $adult_cut); 
					$data['child_cut_price'] = floatval($data['child_cut_price'] - $child_cut);
				}
			}
		}
		return $data;
	}
	
	// 获取优惠列表
	public static function getSpecialOfferList($conds, $startIndex, $pageCount, &$totalCount, $sortCols) {
		$offerObj = ModelBase::getInstance('line_special_offer');
		$offers = $offerObj->getAll($conds, $startIndex, $pageCount, $totalCount, $sortCols);
		if (!empty($offers)) {
			foreach ($offers as $ok=>$ov) {
				$typeObj = json_decode($ov['type_id'], true);
				$type = MyHelp::IdEachTypeKey('type_data',$typeObj['id']);
				$ov['type_result'] = $type;
				if (is_error($type) === false) {
					if ($type === 'line_special_offer_adult') {
						$ov['condition'] = '仅成人享受优惠';
					} else if($type === 'line_special_offer_child') {
						$ov['condition'] = '仅小孩享受优惠';
					} else if($type === 'line_special_offer_full_cut') {
						$ov['condition'] = '订单消费满'.$ov['cond_full'].'元享受优惠';
					} else if($type === 'line_special_offer_count') {
						$childCDS = $ov['cond_count_child'] == 1 ? '(含小孩)' : '(不含小孩)';
						$ov['condition'] = '订单参团人数满'.$ov['cond_count'].'人'.$childCDS.'享受优惠';
					}
					$typeObj['type_key'] = $type;
					$ov['type_id'] = json_encode($typeObj);
				}	
				$offers[$ok] = $ov;
			}
		}
		return $offers;
	}
	
	// 获取优惠
	public static function getSpecialOffer($conds) {
		$offerObj = ModelBase::getInstance('line_special_offer');
		$offer = $offerObj->getOne($conds, $startIndex, $pageCount, $totalCount, $sortCols);
		if (!empty($offer)) {
			$typeObj = json_decode($offer['type_id'], true);
			$type = MyHelp::IdEachTypeKey('type_data',$typeObj['id']);
			if (is_error($type) === false) {
				if ($type === 'line_special_offer_adult') {
					$offer['condition'] = '仅成人享受优惠';
				} else if($type === 'line_special_offer_child') {
					$offer['condition'] = '仅小孩享受优惠';
				} else if($type === 'line_special_offer_full_cut') {
					$offer['condition'] = '订单消费满'.$offer['cond_full'].'元享受优惠';
				} else if($type === 'line_special_offer_count') {
					$childCDS = $offer['cond_count_child'] == 1 ? '(含小孩)' : '(不含小孩)';
					$offer['condition'] = '订单参团人数满'.$offer['cond_count'].'人'.$childCDS.'享受优惠';
				}				
				$typeObj['type_key'] = $type;
				$offer['type_id'] = json_encode($typeObj);
			}
		}
		return $offer;
	}

/**
* 获取问题列表
* @param 条件 $conds
* @param 开始索引 $startIndex
* @param 每页数量 $pageCount
* @param 数据总数 $totalCount
* @param 排序列 $sortCols
* @param 填充内容 $find = {
	* type: 问题类型,
	* answer: 回答内容,
	* account: 账户数据,
	* line: 所属产品内容，只对产品问题有效	
}
* 
* @return
*/

	public static function getQuestionList($conds, $startIndex, $pageCount, &$totalCount, $sortCols, $find=false) {
		$questionObj = ModelBase::getInstance('question');
		$questions = $questionObj->getAll($conds, $startIndex, $pageCount, $totalCount, $sortCols);
		if (!empty($questions)) {
			
			if (!empty($find['line']) || $find === true) {
				$lineQuestionTypeId = MyHelp::TypeDataKey2Value('question_type_line');
			}
			
			foreach ($questions as $qk=>$qv) {
				$qv['content'] = htmlspecialchars_decode($qv['content']);			
				// 填充内容
				if (!empty($find['type']) || $find === true) {
					$qv['type_id_data'] = MyHelp::TypeDataKey2Value($qv['type_id'], true);
				}
				
				if (!empty($find['account']) || $find === true) {
					$conds = appendLogicExp('id', '=', $qv['account_id']);
					$qv['account_id_data'] = BackAccountHelp::getAccount($qv['account_type_id'], $conds);
					if (is_error($qv['account_id_data']) === false) {
						$qv['account_type_id_data'] = $qv['account_type'];
						$qv['account_id_show_name'] = $qv['account_id_data']['show_name'];
					}
				}
				if (!empty($find['answer']) || $find === true) {
					$answerConds = appendLogicExp('question_id', '=', $qv['id']);
					$qv['answers'] = BackLineHelp::getQuestionList($answerConds,0,0,$answerCount,$sortCols, $find);
					$qv['answer_count'] = is_error($qv['answers']) === false ? count($qv['answers']) : 0;
				}
				
				if (!empty($find['line']) || $find === true) {
					if ($qv['type_id'] == $lineQuestionTypeId) {
						$lineFind = false;
						if (is_array($find['line'])) {
							$lineFind = $find['line'];
						}
						$qv['is_line'] = 1;
						$qv['line'] = BackLineHelp::getLine(appendLogicExp('id', '=', $qv['line_id']), $lineFind);
					}
				}
				$questions[$qk] = $qv;
			}
		}
		return $questions;
	}
/**
* 获取问题
* @param 条件 $conds
* @param 填充内容 $find = {
	* type: 问题类型,
	* answer: 回答内容,
	* account: 账户数据,
}
* 
* @return $question;	// 问题
*/
	public static function getQuestion($conds, $find=false) {
		$questionObj = ModelBase::getInstance('question');
		$question = $questionObj->getOne($conds, $startIndex, $pageCount, $totalCount, $sortCols);
		if (!empty($question)) {
			$question['content'] = htmlspecialchars_decode($question['content']);
			// 填充内容
			if (!empty($find['type']) || $find === true) {
				$question['type_id_data'] = MyHelp::TypeDataKey2Value($question['type_id'], true);
			}
			if (!empty($find['account']) || $find === true) {
				$conds = appendLogicExp('id', '=', $question['account_id']);
				$question['account_id_data'] = BackAccountHelp::getAccount($question['account_type_id'], $conds);
				if (is_error($question['account_id_data']) === false) {
					$question['account_type_id_data'] = $question['account_type'];
					$question['account_id_show_name'] = $question['account_id_data']['show_name'];
				}
			}
			if (!empty($find['answer']) || $find === true) {
				$answerConds = appendLogicExp('question_id', '=', $question['id']);
				$question['answers'] = BackLineHelp::getQuestionList($answerConds,0,0,$answerCount,$sortCols, $find);
				$question['answer_count'] = is_error($question['answers']) === false ? count($question['answers']) : 0;
			}
				
			if (!empty($find['line']) || $find === true) {
				$lineQuestionTypeId = MyHelp::TypeDataKey2Value('question_type_line');
				if ($question['type_id'] == $lineQuestionTypeId) {
					$lineFind = false;
					if (is_array($find['line'])) {
						$lineFind = $find['line'];
					}
					$question['is_line'] = 1;
					$question['line'] = BackLineHelp::getLine(appendLogicExp('id', '=', $question['line_id']), $lineFind);
				}
			}
		}
		return $question;
	}

/**
* 获取文章列表
* @param 条件 $conds
* @param 开始索引 $startIndex
* @param 每页数量 $pageCount
* @param 数据总数 $totalCount
* @param 排序列 $sortCols
* @param 填充内容 $find = {
	* content：文章内容,
	* account: 发文人员,
}
* 
* @return $article;	// 文章
*/
	public static function getArticleList($conds, $startIndex, $pageCount, &$totalCount, $sortCols, $find=false) {
		$articleObj = ModelBase::getInstance('article');
		$articles = $articleObj->getAll($conds, $startIndex, $pageCount, $totalCount, $sortCols);
		if (!empty($articles)) {
			$contentObj = ModelBase::getInstance('line_point_scenery');
			$typeId = MyHelp::TypeDataKey2Value('line_point_content_article');
			foreach ($articles as $ak=>$av) {
				
				$av['send_word_show'] = $av['send_word'];
				if (mb_strlen($av['send_word'], 'utf8') > ARTICLE_SEND_WORD_SIMPLE_TEXT_COUNT) {
					$av['send_word_show'] = mb_substr($av['send_word'], 0, ARTICLE_SEND_WORD_SIMPLE_TEXT_COUNT, 'utf8');
					$av['send_word_show'] .= '...';
					$av['send_word_simple'] = '1';
				}
				
				// 填充内容
				if (!empty($find['content']) || $find === true) {
					$conds = appendLogicExp('line_id', '=', $av['id']);
					$conds = appendLogicExp('type_id', '=', $typeId, 'AND', $conds);
					$av['content'] = $contentObj->getAll($conds, 0, 0, $total, array('index'=>'asc'));
					foreach ($av['content'] as $avk=>$avv) {
						if (!empty($avv['image_url']) && empty($av['face_image'])) {
							$av['face_image'] = $avv['image_url'];
						}
						if (!empty($avv['content'])) {
							$avv['content'] = htmlspecialchars_decode($avv['content']);
							$av['content'][$avk] = $avv;
						}
					}
				}
			
				if (!empty($find['account']) || $find === true) {
					$conds = appendLogicExp('id', '=', $av['account_id']);
					$av['account'] = BackAccountHelp::getAccount($av['account_type_id'], $conds);
				}
				$articles[$ak] = $av;
			}
		}
		return $articles;
	}

	public static function getSeoArticleList($conds, $startIndex, $pageCount, &$totalCount, $sortCols, $find=false) {
		$articleObj = ModelBase::getInstance('seo_article');
		$articles = $articleObj->getAll($conds, $startIndex, $pageCount, $totalCount, $sortCols);
		if (!empty($articles)) {
			foreach ($articles as $ak=>$av) {
				
				$av['send_word_show'] = $av['send_word'];
				if (mb_strlen($av['send_word'], 'utf8') > ARTICLE_SEND_WORD_SIMPLE_TEXT_COUNT) {
					$av['send_word_show'] = mb_substr($av['send_word'], 0, ARTICLE_SEND_WORD_SIMPLE_TEXT_COUNT, 'utf8');
					$av['send_word_show'] .= '...';
					$av['send_word_simple'] = '1';
				}

			
				if (!empty($find['account']) || $find === true) {
					$conds = appendLogicExp('id', '=', $av['account_id']);
					$av['account'] = BackAccountHelp::getAccount($av['account_type_id'], $conds);
				}
				$articles[$ak] = $av;
			}
		}
		return $articles;
	}
	
/**
* 获取文章
* @param 条件 $conds
* @param 填充内容 $find = {
	* content：文章内容,
	* account: 发文人员,
	
}
* 
* @return $article;	// 文章
*/
	public static function getArticle($conds, $find=false) {
		$articleObj = ModelBase::getInstance('article');
		$article = $articleObj->getOne($conds, $startIndex, $pageCount, $totalCount, $sortCols);
		if (!empty($article)) {
				
			$article['send_word_show'] = $article['send_word'];
			if (mb_strlen($article['send_word'], 'utf8') > ARTICLE_SEND_WORD_SIMPLE_TEXT_COUNT) {
				$article['send_word_show'] = mb_substr($article['send_word'], 0, ARTICLE_SEND_WORD_SIMPLE_TEXT_COUNT, 'utf8');
				$article['send_word_show'] .= '...';
				$article['send_word_simple'] = '1';
			}
			// 填充内容
			if (!empty($find['content']) || $find === true) {
				$contentObj = ModelBase::getInstance('line_point_scenery');
				$conds = appendLogicExp('line_id', '=', $article['id']);
				$typeId = MyHelp::TypeDataKey2Value('line_point_content_article');
				$conds = appendLogicExp('type_id', '=', $typeId, 'AND', $conds);
				$article['content'] = $contentObj->getAll($conds, 0, 0, $total, array('index'=>'asc'));
				foreach ($article['content'] as $avk=>$avv) {
					if (!empty($avv['image_url']) && empty($article['face_image'])) {
						$article['face_image'] = $avv['image_url'];
					}
					
					if (!empty($avv['content'])) {
						$avv['content'] = htmlspecialchars_decode($avv['content']);
						$article['content'][$avk] = $avv;
					}
				}
			}
			
			if (!empty($find['account']) || $find === true) {
				$conds = appendLogicExp('id', '=', $article['account_id']);
				$article['account'] = BackAccountHelp::getAccount($article['account_type_id'], $conds);
			}
		}
		return $article;
	}

	public static function getSeoArticle($conds, $find=false) {
		$articleObj = ModelBase::getInstance('seo_article');
		$article = $articleObj->getOne($conds, $startIndex, $pageCount, $totalCount, $sortCols);
		if (!empty($article)) {
				
			$article['send_word_show'] = $article['send_word'];
			if (mb_strlen($article['send_word'], 'utf8') > ARTICLE_SEND_WORD_SIMPLE_TEXT_COUNT) {
				$article['send_word_show'] = mb_substr($article['send_word'], 0, ARTICLE_SEND_WORD_SIMPLE_TEXT_COUNT, 'utf8');
				$article['send_word_show'] .= '...';
				$article['send_word_simple'] = '1';
			}
			
			if (!empty($find['account']) || $find === true) {
				$conds = appendLogicExp('id', '=', $article['account_id']);
				$article['account'] = BackAccountHelp::getAccount($article['account_type_id'], $conds);
			}
		}
		return $article;
	}
	
	// 获取领队列表
	public static function getLeaderList($conds, $startIndex, $pageCount, &$totalCount, $sortCols) {
		$leaderObj = ModelBase::getInstance('leader');
		$leaders = $leaderObj->getAll($conds, $startIndex, $pageCount, $totalCount, $sortCols);
//		if (!empty($leaders)) {
//			foreach ($leaders as $lk=>$lv) {
//				$leaders[$lk] = $lv;
//			}
//		}
		return $leaders;
	}
	
	// 获取领队
	public static function getLeader($conds) {
		$leaderObj = ModelBase::getInstance('leader');
		$leaders = $leaderObj->getOne($conds, $startIndex, $pageCount, $totalCount, $sortCols);
//		if (!empty($leaders)) {
//		}
		return $leaders;
	}
	
	// 获取领队列表
	public static function getVideoList($conds, $startIndex, $pageCount, &$totalCount, $sortCols, $find) {
		$videoObj = ModelBase::getInstance('video');
		$videos = $videoObj->getAll($conds, $startIndex, $pageCount, $totalCount, $sortCols);
		if (!empty($videos)) {
			foreach ($videos as $vk=>$vv) {
				$vv['title_show'] = $vv['title'];
				if (mb_strlen($vv['title'], 'utf8') > VIDEO_SIMPLE_TEXT_COUNT) {
					$vv['title_show'] = mb_substr($vv['title'], 0, VIDEO_SIMPLE_TEXT_COUNT, 'utf8');
					$vv['title_show'] .= '...';
					$vv['title_simple'] = '1';
				}
				
				$vv['subheading_show'] = $vv['subheading'];
				if (mb_strlen($vv['subheading'], 'utf8') > VIDEO_SIMPLE_TEXT_COUNT) {
					$vv['subheading_show'] = mb_substr($vv['subheading'], 0, VIDEO_SIMPLE_TEXT_COUNT, 'utf8');
					$vv['subheading_show'] .= '...';
					$vv['subheading_simple'] = '1';
				}
				$videos[$vk] = $vv;
			}
		}
		return $videos;
	}
	
	// 获取领队
	public static function getVideo($conds) {
		$videoObj = ModelBase::getInstance('video');
		$video = $videoObj->getOne($conds, $startIndex, $pageCount, $totalCount, $sortCols);
//		if (!empty($videos)) {
//		}
		return $video;
	}
	
	// 获取专题列表
	public static function getSubjectList($conds, $startIndex, $pageCount, &$totalCount, $sortCols, $find=false) {
		$subjectObj = ModelBase::getInstance('subject');
		$subjects = $subjectObj->getAll($conds, $startIndex, $pageCount, $totalCount, $sortCols);
		if (!empty($subjects)) {
			$dataObj = ModelBase::getInstance('subject_data');
			foreach ($subjects as $sk=>$sv) {
				if (!empty($find['data']) || $find == true) {
					// 线路tab页
					$sv['line_tab'] = array();
					// 专题的内容数据
					$data = array(); $findList = true;
					// 获取专题数据，并组合值
					$ds = $dataObj->getAll(appendLogicExp('subject_id', '=', $sv['id']), 0, 0, $total, array('sort'=>'asc'));
					// 获取第一个Tab页			
					$firstConds = appendLogicExp('subject_id', '=', $sv['id']);
					$firstConds = appendLogicExp('key', 'LIKE', 'tab_%', 'AND', $firstConds);
					$firstConds = appendLogicExp('sort', '=', '0', 'AND', $firstConds);
					$firstTab = $dataObj->getOne($firstConds);
					$firstTabLineKey = substr($firstTab['key'], 4);
					foreach ($ds as $dk=>$dv) {
						$vals = json_decode($dv['value'],true);						
						if ($dv['key'] == 'recommend_subject_subheading') {
							$vals['text'] = htmlspecialchars_decode($vals['text']);
						}
						
						$data[$dv['key']] = $vals;
					
						if (stripos($dv['key'], 'hot_line_recommend') === 0) {
							$data[$dv['key']] = BackLineHelp::getLine(appendLogicExp('id', '=', $dv['value']), false);
						}
					
						if (stripos($dv['key'], 'tab_line') === 0) {
							$sv['line_tab'][$dv['sort']] = $vals;
							// 显示第一个Tab页的线路
							if ($dv['sort'] == 0) {
								$findList = true;
							}
						}
						
						if (!empty($firstTab) && $dv['key'] == $firstTabLineKey) {
							$lineMap = array();
							foreach($vals as $ak=>$av){
								if (!empty($ids)) {
									$ids .= ',';							
								}
								$ids .= $av['id'];
								$lineMap[$av['id']] = '';
							}
							$lineConds = appendLogicExp('id', 'IN', '('.$ids.')');
							$valList = BackLineHelp::getLineList($lineConds, 0, 0, $total, array('id'=>'asc'), false); 
							// 线路排序
							foreach ($valList as $vk=>$vv) {
								$lineMap[$vv['id']] = $vv;
							}	
							$valList = array();
							foreach ($lineMap as $lmk=>$lmv) {
								array_push($valList, $lmv);
							}
							$data['show_tab_line_data'] = $valList;	
							$findList = false;
						}
					}
					$sv = array_merge($sv, $data);
				}
				$subjects[$sk] = $sv;
			}
		}
		return $subjects;
	}
	
	// 获取专题
	public static function getSubject($conds, $find=false) {
		$subjectObj = ModelBase::getInstance('subject');
		$subject = $subjectObj->getOne($conds);
		if (!empty($subject)) {
			if (!empty($find['data']) || $find == true) {
				// 线路tab页
				$subject['line_tab'] = array();
				// 专题的内容数据
				$data = array(); $firstLine = '';
				// 获取专题数据，并组合值
				$dataObj = ModelBase::getInstance('subject_data');
				$ds = $dataObj->getAll(appendLogicExp('subject_id', '=', $subject['id']), 0, 0, $total, array('sort'=>'asc'));
				// 获取第一个Tab页
				$firstConds = appendLogicExp('subject_id', '=', $subject['id']);
				$firstConds = appendLogicExp('key', 'LIKE', 'tab_%', 'AND', $firstConds);
				$firstConds = appendLogicExp('sort', '=', '0', 'AND', $firstConds);
				$firstTab = $dataObj->getOne($firstConds);
				$firstTabLineKey = substr($firstTab['key'], 4);
				foreach ($ds as $dk=>$dv) {
					$vals = json_decode($dv['value'], true);					
					if ($dv['key'] == 'recommend_subject_subheading') {
						$vals['text'] = htmlspecialchars_decode($vals['text']);
					}
					$data[$dv['key']] = $vals;
					
					if (stripos($dv['key'], 'hot_line_recommend') === 0) {
						$data[$dv['key']] = BackLineHelp::getLine(appendLogicExp('id', '=', $dv['value']), false);
					}
					
					// 线路tab页数据排序
					if (stripos($dv['key'], 'tab_line') === 0) {
						$subject['line_tab'][$dv['sort']] = $vals;
					}
					
					// 产品显示的tab页的产品数据
					if (!empty($firstTab) && $dv['key'] == $firstTabLineKey) {
						$lineMap = array();
						foreach($vals as $ak=>$av){
							if (!empty($ids)) {
								$ids .= ',';							
							}
							$ids .= $av['id'];
							$lineMap[$av['id']] = $av;
						}
						$lineConds = appendLogicExp('id', 'IN', '('.$ids.')');
						$valList = BackLineHelp::getLineList($lineConds, 0, 0, $total, array('id'=>'asc'), false); 
						// 线路排序
						foreach ($valList as $vk=>$vv) {
							$lineMap[$vv['id']] = $vv;
						}	
						$data['show_tab_line_list'] = $valList;
						$data['show_tab_line_map'] = $lineMap;
						$valList = array();
						foreach ($lineMap as $lmk=>$lmv) {
							array_push($valList, $lmv);
						}
						$data['show_tab_line_data'] = $valList;
					}	
												
				}
				$subject = array_merge($subject, $data);
			}
		}
		return $subject;
	}

	//解析套餐价格编号
	public static function TaocanPriceIds2RealIds($ids) {
		if (is_array($ids)) {
			return ','.implode(',', $ids).',';
		}
		if (is_string($ids)) {
			$ids = explode(',', $ids);
			if (!empty($ids) && count($ids) > 0) {
				array_shift($ids);
				if (!empty($ids) && count($ids) > 0) {
					array_pop($ids);	
				}	
			}
			return $ids;			
		}
		return error(-1, '解析套餐价格编号错误，类型错误');
	}

	/**
	* 获取套餐列表信息
	* @param	查询条件		$conds
	* @param	开始索引		$startIndex
	* @param	每页数量		$pageCount
	* @param	数据总数		$totalCount
	* @param	排序列			$sortCols
	* @param	填充内容		$find = {
	* 								batch		批次信息
	* 								taocan		套餐信息
	* 							}
	* 
	* 
	* @return	价格列表		$prices		
	*/
	public static function getTaocanPriceList($conds, $startIndex, $pageCount, &$totalCount, $sortCols, $find) {
		$priceObj = ModelBase::getInstance('taocan_price');
		$prices = $priceObj->getAll($conds, $startIndex, $pageCount, $totalCount, $sortCols);
		foreach ($prices as $pk=>$pv) {
			if (!empty($find['batch']) || $find === true) {
				if (empty($batchMap[$pv['batch_id']])) {
					$batch = BackLineHelp::getBatch(appendLogicExp('id', '=', $pv['batch_id']));
					$batchMap[$pv['batch_id']] = $batch;				
					$pv['batch_data'] = $batch;	
				} else {
					$pv['batch_data'] = $batchMap[$pv['batch_id']];
				}
			}
			
			if (!empty($find['taocan']) || $find === true) {
				$idsList = BackLineHelp::TaocanPriceIds2RealIds($pv['taocan_ids']);
				if (is_error($idsList)) {
					$pv['taocans'] = $idsList;
				} else {
					if (empty($taocanMap[$pv['taocan_ids']])) {
						$conds = appendLogicExp('id', 'IN', '('.implode(',', $idsList).')');
						$taocans = BackLineHelp::getTaocanList($conds, 0, 0, $tcTotal);
						$tcList = array();
						foreach ($taocans as $tk=>$tv) {
							$tcList[$tv['id']] = $tv;
						}
						$taocanMap[$pv['taocan_ids']] = $tcList;
						$pv['taocans'] = $tcList;
					} else {
						$pv['taocans'] = $taocanMap[$pv['taocan_ids']];
					}
					$pv['tc_name_str'] = '';
					foreach ($pv['taocans'] as $tk=>$tv) {
						if (empty($pv['tc_name_str'])) {
							$pv['tc_name_str'] = '套餐:';
						} else {
							$pv['tc_name_str'] .= '->';
						}
						$pv['tc_name_str'] .= '['.$tv['type_data']['type_desc'].']'.$tv['name'];
					}
					$pv['tc_name_str'] .= ' 价格[成人]'.$pv['price_adult'].'元/人 [儿童]'.$pv['price_child'].'元/人';
				}
			}
			$prices[$pk] = $pv;		
		}
		
		return $prices;
	}

	/**
	* 获取套餐价格
	* @param	查询条件		$conds
	* @param	填充内容		$find = {
	* 							batch		批次信息
	* 							taocan		套餐信息
	* 						}
	* 
	* 
	* @return	价格信息		$price
	*/
	public static function getTaocanPrice($conds, $find) {
		$priceObj = ModelBase::getInstance('taocan_price');
		$price = $priceObj->getOne($conds);
		if (!empty($find['batch']) || $find === true) {
			if (empty($batchMap[$price['batch_id']])) {
				$batch = BackLineHelp::getBatch(appendLogicExp('id', '=', $price['batch_id']));
				$batchMap[$price['batch_id']] = $batch;				
				$price['batch_data'] = $batch;	
			} else {
				$price['batch_data'] = $batchMap[$price['batch_id']];
			}
		}
		
		if (!empty($find['taocan']) || $find === true) {
			$idsList = BackLineHelp::TaocanPriceIds2RealIds($price['taocan_ids']);
			if (is_error($idsList)) {
				$price['taocans'] = $idsList;
			} else {
				$price['tc_name_str'] = '';
				if (empty($taocanMap[$price['taocan_ids']])) {
					$conds = appendLogicExp('id', 'IN', '('.implode(',', $idsList).')');
					$taocans = BackLineHelp::getTaocanList($conds, 0, 0, $tcTotal);
					foreach ($taocans as $tk=>$tv) {
						$tcList[$tv['id']] = $tv;
					}
					$price['taocans'] = $tcList;
				} else {
					$price['taocans'] = $taocanMap[$price['taocan_ids']];
				}
				$price['tc_name_str'] = '';
				foreach ($price['taocans'] as $tk=>$tv) {
					if (empty($price['tc_name_str'])) {
						$price['tc_name_str'] = '套餐:';
					} else {
						$price['tc_name_str'] .= '->';
					}
					$price['tc_name_str'] .= '['.$tv['type_data']['type_desc'].']'.$tv['name'];
				}
				$price['tc_name_str'] .= ' 价格[成人]'.$price['price_adult'].'元/人 [儿童]'.$price['price_child'].'元/人';
			}
		}
		
		return $price;
	}

	/**
	* 获取套餐列表信息
	* @param	查询条件		$conds
	* @param	开始索引		$startIndex
	* @param	每页数量		$pageCount
	* @param	数据总数		$totalCount
	* @param	排序列		$sortCols
	* @param	填充内容		$find = {
	* 							price		套餐价格
	* 						}
	* 
	* 
	* @return	套餐列表		$taocans		
	*/
	public static function getTaocanList($conds, $startIndex, $pageCount, &$totalCount, $sortCols, $find) {
		$taocanObj = ModelBase::getInstance('taocan');
		$taocans = $taocanObj->getAll($conds, $startIndex, $pageCount, $totalCount, $sortCols);
		foreach ($taocans as $tk=>$tv) {
			$tv['type_data'] = my_json_decode($tv['type'], true);
			if (!empty($find['price']) || $find === true){
				$conds = appendLogicExp('ids', 'LIKE', ','.$tv['id'].',');
				$tv['price'] = BackLineHelp::getTaocanPrice($conds);
			}
			$taocans[$tk] = $tv;
		
		}
		return $taocans;
	}
	
	/**
	* 获取套餐信息
	* @param	查询条件		$conds
	* @param	填充内容		$find = {
	* 							price		套餐价格
	* 						}
	* 
	* 
	* @return	套餐信息		$taocan
	*/
	public static function getTaocan($conds, $find) {
		$taocanObj = ModelBase::getInstance('taocan');
		$taocan = $taocanObj->getOne($conds);
		$taocan['type_data'] = my_json_decode($taocan['type'], true);
		if (!empty($find['price']) || $find === true){
			$conds = appendLogicExp('ids', 'LIKE', ','.$tv['id'].',');
			$taocan['price'] = BackLineHelp::getTaocanPrice($conds);
		}

		return $taocan;
	}
	
	/**
	* 获取线路所有可用套餐 
	* 
	*/
	public static function getLineTaocan($lineId, $batchId, &$out) {		
		$taocanObj = ModelBase::getInstance('taocan');
		$params['table'] = '`kl_taocan` AS `q1`';
		$params['col'] = array(
			'`q1`.`id`'=>'`id`',
			'`q1`.`type`'=>'`type`',
			'`q1`.`name`'=>'`name`',
			'`q1`.`desc`'=>'`desc`',
			'`q2`.`id`'=>'`pid`',
			'`q2`.`line_id`'=>'`line_id`',
			'`q2`.`batch_id`'=>'`batch_id`',
			'`q2`.`taocan_ids`'=>'`taocan_ids`',
			'`q2`.`price_adult`'=>'`price_adult`',
			'`q2`.`price_child`'=>'`price_child`'
		);
		$params['join'] = array('INNER JOIN `kl_taocan_price` AS `q2` ON CONCAT(",",`q1`.`id`,",") LIKE `q2`.`taocan_ids`');
		$params['sort'] = array('`q1`.`type`'=>'asc');
		$conds = appendLogicExp('`q1`.`invalid`', '=', '0', 'AND', $conds);
		$conds = appendLogicExp('`q2`.`invalid`', '=', '0', 'AND', $conds);
		if (!empty($lineId)) {
			if (is_array($lineId)) {
				$lineIds = implode(',',$lineId);
				$conds = appendLogicExp('`q2`.`line_id`', 'IN', '('.$lineIds.')', 'AND', $conds);
			} else {
				$conds = appendLogicExp('`q2`.`line_id`', '=', $lineId, 'AND', $conds);
			}
		}
		if (!empty($batchId)) {
			if (is_array($batchId)) {
				$batchIds = implode(',',$batchId);
				$conds = appendLogicExp('`q2`.`batch_id`', 'IN', '('.$batchIds.')', 'AND', $conds);
			} else {
				$conds = appendLogicExp('`q2`.`batch_id`', '=', $batchId, 'AND', $conds);
			}
		}
		$params['conds'] = $conds;
		$ds = $taocanObj->queryData($params, $total);
		$out['sql'] = $taocanObj->getLastSql();
		
		foreach ($ds as $dk=>$dv) {
			$dv['type_data'] = my_json_decode($dv['type'],true);
			$ds[$dk] = $dv;
		}
		return $ds;
	}
	
}

?>