<?php
/**
 * Created by CodeLobster.
 * User: PF
 * Date: 2017-4-24
 * Time: 2017-4-24 15:42:47
 */

namespace Core\Model;

class BackFinancialHelp {
	/**
	* 
	* @param 条件 $conds
	* @param 开始索引 $startIndex
	* @param 页显示数量 $pageSize
	* @param 总条数 $total
	* @param 排序 $sort
	* @param 填充数据 $find
	* 
	* @return 返回消费项数据
	*/
	public static function getItemList($conds, $startIndex, $pageSize, &$total, $sort, $find=false) {		
		$itemObj = ModelBase::getInstance('cj_item');
		$ds = $itemObj->getAll($conds, $startIndex, $pageSize, $total, $sort);
		foreach ($ds as $dk=>$dv) {
			// 消费项所属对象类型
			$objType = json_decode($dv['obj_type'],true);
			$dv['obj_type_data'] = MyHelp::TypeDataKey2Value($objType['id'], true);
			
			// 消费项类型
			if (!empty($dv['type'])) {
				$type = json_decode($dv['type'], true);
				$dv['type_data'] = MyHelp::TypeDataKey2Value($type['id'], true);
				
				// 房间类型消费项
				if ($dv['type_data']['type_key'] == 'cj_item_type_room') {
					if (empty($roomObj)) {
						$roomObj = ModelBase::getInstance('cj_item_room');
					}
					// 合并房间类型消费项
					$room = $roomObj->getOne(appendLogicExp('item_id', '=', $dv['id']));
					if (!empty($room)) {						
						$room['extra_id'] = $room['id'];
						unset($room['id']);
						if (!empty($room['bed_width']) && $room['bed_width'] != '[]' && $room['bed_width'] != '{}') {
							$room['bed_width_data'] = json_decode($room['bed_width'], true);
							foreach ($room['bed_width_data'] as $rk=>$rv) {
								if (!empty($room['bed_width_show'])) {
									$room['bed_width_show'] .= ',';
								}
								$room['bed_width_show'] .= $rv['type_desc'];
							}
						}
						$dv = array_merge($dv,$room);
					}
				}
			}
			$ds[$dk] = $dv;
		}
		
		return $ds;
	}	
	
	/**
	* 获取消费项数据
	* @param 条件 $conds
	* @param 填充项 $find
	* 
	* @return 返回消费项数据
	*/
	public static function getItem($conds, $find=false) {
		$itemObj = ModelBase::getInstance('cj_item');
		$item = $itemObj->getOne($conds);
		if (!empty($item)) {
			// 消费项所属对象类型
			$objType = json_decode($item['obj_type'],true);
			$item['obj_type_data'] = MyHelp::TypeDataKey2Value($objType['id'], true);
			
			// 消费项类型
			if (!empty($item['type'])) {
				$type = json_decode($item['type'], true);
				$item['type_data'] = MyHelp::TypeDataKey2Value($type['id'], true);
				
				// 房间类型消费项
				if ($item['type_data']['type_key'] == 'cj_item_type_room') {
					if (empty($roomObj)) {
						$roomObj = ModelBase::getInstance('cj_item_room');
					}
					// 合并房间类型消费项
					$room = $roomObj->getOne(appendLogicExp('item_id', '=', $item['id']));
					if (!empty($room)) {						
						$room['extra_id'] = $room['id'];
						unset($room['id']);
						if (!empty($room['bed_width']) && $room['bed_width'] != '[]' && $room['bed_width'] != '{}') {
							$room['bed_width_data'] = json_decode($room['bed_width'], true);
							foreach ($room['bed_width_data'] as $rk=>$rv) {
								if (!empty($room['bed_width_show'])) {
									$room['bed_width_show'] .= ',';
								}
								$room['bed_width_show'] .= $rv['type_desc'];
							}
						}
						$item = array_merge($item,$room);
					}
				}
			}
		}
		return $item;
	}
	
	/**
	* 获取价格列表
	* @param 条件 $conds
	* @param 开始索引 $startIndex
	* @param 页显示数量 $pageSize
	* @param 总条数 $total
	* @param 排序 $sort
	* @param 填充数据 $find = {
	*	'obj'=>'对象数据',
	*	'item'=>'消费项'
	* }
	* 
	* @return 价格列表
	*/
	public static function getPriceList($conds, $startIndex, $pageSize, &$total, $sort, $find=false, &$out) {		
		$priceObj = ModelBase::getInstance('cj_price');
		$ds = $priceObj->getAll($conds, $startIndex, $pageSize, $total, $sort, false, $out);
		foreach ($ds as $dk=>$dv) {
			// 消费项所属对象类型
			$objType = json_decode($dv['obj_type'],true);
			$dv['obj_type_data'] = MyHelp::TypeDataKey2Value($objType['id'], true);
			
			// 消费对象
			if (!empty($find['obj']) || $find === true) {
				$sourceType = array('insurance','leader','hotel','driver','bus','view','agency','source');
				foreach ($sourceType as $stk=>$stv) {
					$cpType = 'cj_source_obj_'.$stv;
					if ($cpType === $objType['type_key']) {
						// 资源对象
						$dv['obj_data'] = BackFinancialHelp::getSource($sourceType[$stk], appendLogicExp('id', '=', $dv['obj_id']));
						break;
					}
				}
			}
			
			// 消费项
			if (!empty($find['item']) || $find === true) {
				$dv['item_data'] = BackFinancialHelp::getItem(appendLogicExp('id', '=', $dv['item_id']));
			}
			
			// 消费项审核类型
			if (!empty($dv['review_type'])) {
				$dv['review_type'] = json_decode($dv['review_type'], true);
			}
			if (!empty($dv['commit_admin'])) {
				$dv['commit_admin'] = json_decode($dv['commit_admin'], true);
			}
			if (!empty($dv['review_admin'])) {
				$dv['review_admin'] = json_decode($dv['review_admin'], true);
			}
			
			// 消费项显示文本
			$dv['show_name'] = $dv['title'].' / 报价:'.$dv['price'].'，实价:'.$dv['real_price'];
			if (!empty($dv['is_time'])) {
				$dv['show_name'] .=	' / [按时报价:'.$dv['start_time'].'至'.$dv['end_time'].']';
			}
			if (!empty($dv['is_member'])) {
				$dv['show_name'] .= ' / [按人报价:人数在'.$dv['min_num'].'至'.$dv['max_num'].']';
			}
			if (!empty($dv['is_day'])) {
				$dv['show_name'] .= ' / [按天报价:天数在'.$dv['min_day'].'至'.$dv['max_day'].']';
			}
			if (!empty($dv['is_line'])) {
				$line = json_decode($dv['line'],true);
				$dv['show_name'] .= ' / [按线路报价:'.$line['title'].']';
			}
			
			$ds[$dk] = $dv;
		}
		
		return $ds;
	}
	
	/**
	* 获取价格
	* @param 条件 $conds
	* @param 填充数据 $find = {
	*	'obj'=>'对象数据',
	*	'item'=>'消费项'
	* }
	* 
	* @return 价格
	*/
	public static function getPrice($conds, $find=false) {
		$priceObj = ModelBase::getInstance('cj_price');
		$price = $priceObj->getOne($conds);
		if (!empty($price)) {
			// 消费项所属对象类型
			$objType = json_decode($price['obj_type'],true);
			$price['obj_type_data'] = MyHelp::TypeDataKey2Value($objType['id'], true);
			
			// 消费对象
			if (!empty($find['obj']) || $find === true) {
				$sourceType = array('insurance','leader','hotel','driver','bus','view','agency','source');
				foreach ($sourceType as $stk=>$stv) {
					$cpType = 'cj_source_obj_'.$stv;
					if ($cpType === $objType['type_key']) {
						// 资源对象
						$price['obj_data'] = BackFinancialHelp::getSource($sourceType[$stk], appendLogicExp('id', '=', $price['obj_id']));
						break;
					}
				}
			}
			
			// 消费项
			if (!empty($find['item']) || $find === true) {
				$price['item_data'] = BackFinancialHelp::getItem(appendLogicExp('id', '=', $price['item_id']));
			}
			
			
			// 消费项类型
			if (!empty($price['review_type'])) {
				$price['review_type'] = json_decode($price['review_type'], true);
			}
			if (!empty($price['commit_admin'])) {
				$price['commit_admin'] = json_decode($price['commit_admin'], true);
			}
			if (!empty($price['review_admin'])) {
				$price['review_admin'] = json_decode($price['review_admin'], true);
			}
			
			// 消费项显示文本
			$price['show_name'] = $price['title'].' / 价格:'.$price['real_price'];
			if (!empty($price['is_time'])) {
				$price['show_name'] .=	' / [按时报价:'.$price['start_time'].'至'.$price['end_time'].']';
			}
			if (!empty($price['is_member'])) {
				$price['show_name'] .= ' / [按人报价:人数在'.$price['min_num'].'至'.$price['max_num'].']';
			}
			if (!empty($price['is_day'])) {
				$price['show_name'] .= ' / [按天报价:天数在'.$price['min_day'].'至'.$price['max_day'].']';
			}
			if (!empty($price['is_line'])) {
				$line = json_decode($price['line'],true);
				$price['show_name'] .= ' / [按线路报价:'.$line['title'].']';
			}			
		}
		return $price;
	}
	
	/**
	* 获取资源列表
	* @param 资源类型 $srcType
	* @param 条件 $conds
	* @param 开始索引 $startIndex
	* @param 页显示数量 $pageSize
	* @param 总条数 $total
	* @param 排序 $sort
	* @param 填充数据 $find
	* 
	* @return 价格列表
	*/
	public static function getSourceList($srcType, $conds, $startIndex, $pageSize, $sort, $find=false) {	
		$sourceTable = array(
			'insurance'=>'cj_insurance',
			'leader'=>'cj_leader',
			'hotel'=>'cj_hotel',
			'driver'=>'cj_driver',
			'bus'=>'cj_bus',
			'view'=>'cj_view',
			'agency'=>'cj_agency',
			'source'=>'cj_source',
		);	
		
		if (empty($sourceTable[$srcType])) {
			return array('ds'=>'', 'page_count'=>0, 'total_count'=>0);
		}
		
		$sourceObj = ModelBase::getInstance($sourceTable[$srcType]);
		$ds = $sourceObj->getAll($conds, $startIndex, $pageSize, $total, $sort);	
		foreach ($ds as $dk=>$dv) {
			if ($srcType == 'leader') {		
				$dv['owner_data'] = json_decode($dv['owner'], true);
				$dv['type_data'] = json_decode($dv['type'], true);
				$dv['impression_list'] = explode(',', $dv['impression']);
			}	
			if ($srcType == 'leader' || $srcType == 'hotel') {
//				$dv['star_level_show'] = intval($dv['star_level']/2).'星';
//				if (intval($dv['star_level'] % 2) > 0) {
//					$dv['star_level_show'] .= '半';
//				}
				$dv['star_level_show'] = $dv['star_level'].'星';
			}
			
			// 资源对应表
			$dv['data_table'] = $sourceTable[$srcType];
			
			// 所属线路
			$dv['line_show'] = '';
			if (!empty($dv['line'])) {
				$dv['line_data'] = json_decode($dv['line'], true);
				foreach($dv['line_data'] as $lk=>$lv) {
					if (!empty($dv['line_show'])) {
						$dv['line_show'] .= ',';
					}
					$dv['line_show'] .= $lv['title'];
				}
			}
			
			// 结算类型
			$dv['pay_type_show'] = '';
			if (!empty($dv['pay_type'])) {
				$dv['pay_type_data'] = json_decode($dv['pay_type'], true);
				$dv['pay_type_show'] = $dv['pay_type_data']['type_desc'];
			}
		
			// 显示文本		
			$dv['show_name'] = '';
			if ($srcType == 'insurance') {
				$dv['show_name'] = $dv['name'];
			} else if ($srcType == 'leader') {
				if (!empty($dv['name'])) {
					$dv['show_name'] = $dv['name'];
				} else if (!empty($dv['nickname'])) {
					$dv['show_name'] = $dv['nickname'];
				}else if (!empty($dv['stagename'])) {
					$dv['show_name'] = $dv['stagename'];
				}
			} else if ($srcType == 'hotel') {
				$dv['show_name'] = $dv['name'].'['.$dv['city'].']';
			} else if ($srcType == 'driver') {
				$dv['show_name'] = $dv['name'];
			} else if ($srcType == 'bus') {
				$dv['show_name'] = $dv['seat'].'座'.$dv['bus_log'].'['.$dv['name'].']';
			} else if ($srcType == 'view') {
				$dv['show_name'] = $dv['name'].'['.$dv['city'].']['.$dv['province'].']';
			} else if ($srcType == 'agency') {
				$dv['show_name'] = $dv['name'];
				if (!empty($dv['agency_type'])){
					$type = json_decode($dv['agency_type'],true);
					$dv['show_name'] .= '['.$type['type_desc'].']';
					$dv['agency_type_data'] = $type;
				} 
			} else {
				$dv['show_name'] = $dv['name'];
			}
			if (!empty($dv['pay_type_show'])) {
				$dv['show_name'] .= '['.$dv['pay_type_show'].']';
			}
			
			$ds[$dk] = $dv;	
		}
		$result['ds'] = $ds;
		
		// 页数，总数
		$pageCount = intval($total / $pageSize);
		if (intval($total % $pageSize) > 0) {
			$pageCount += 1;
		}
		$result['page_count'] = $pageCount;
		$result['total_count'] = $total;
		
		return $result;
	}
	
	/**
	* 获取资源
	* @param 资源类型 $srcType
	* @param 条件 $conds
	* @param 填充项 $find
	* 
	* @return 价格
	*/
	public static function getSource($srcType, $conds, $find=false) {
		$sourceTable = array(
			'insurance'=>'cj_insurance',
			'leader'=>'cj_leader',
			'hotel'=>'cj_hotel',
			'driver'=>'cj_driver',
			'bus'=>'cj_bus',
			'view'=>'cj_view',
			'agency'=>'cj_agency',
			'source'=>'cj_source',
		);	
		
		if (empty($sourceTable[$srcType])) {
			return '';
		}
		
		$sourceObj = ModelBase::getInstance($sourceTable[$srcType]);
		$source = $sourceObj->getOne($conds);
		if ($srcType == 'leader') {
			$source['owner_data'] = json_decode($source['owner'], true);
			$source['type_data'] = json_decode($source['type'], true);
			$source['impression_list'] = explode(',', $source['impression']);
		}	
		if ($srcType == 'leader' || $srcType == 'hotel') {
//			$source['star_level_show'] = intval($source['star_level']/2).'星';
//			if (intval($source['star_level'] % 2) > 0) {
//				$source['star_level_show'] .= '半';
//			}
			$source['star_level_show'] = $source['star_level'].'星';
		}
		// 资源对应表
		$source['data_table'] = $sourceTable[$srcType];
		
		// 所属线路
		$source['line_show'] = '';
		if (!empty($source['line'])) {
			$source['line_data'] = json_decode($source['line'], true);
			foreach($source['line_data'] as $lk=>$lv) {
				if (!empty($source['line_show'])) {
					$source['line_show'] .= ',';
				}
				$source['line_show'] .= $lv['title'];
			}
		}
		
		// 结算类型
		$source['pay_type_show'] = '';
		if (!empty($source['pay_type'])) {
			$source['pay_type_data'] = json_decode($source['pay_type'], true);
			$source['pay_type_show'] = $source['pay_type_data']['type_desc'];
		}
		
		// 显示文本		
		$source['show_name'] = '';
		if ($srcType == 'insurance') {
			$source['show_name'] = $source['name'];
		} else if ($srcType == 'leader') {
			if (!empty($source['name'])) {
				$source['show_name'] = $source['name'];
			} else if (!empty($source['nickname'])) {
				$source['show_name'] = $source['nickname'];
			}else if (!empty($source['stagename'])) {
				$source['show_name'] = $source['stagename'];
			}
		} else if ($srcType == 'hotel') {
			$source['show_name'] = $source['name'].'['.$source['city'].']';
		} else if ($srcType == 'driver') {
			$source['show_name'] = $source['name'];
		} else if ($srcType == 'bus') {
			$source['show_name'] = $source['seat'].'座'.$source['bus_log'].'['.$source['name'].']';
		} else if ($srcType == 'view') {
			$source['show_name'] = $source['name'].'['.$source['city'].']['.$source['province'].']';
		} else if ($srcType == 'agency') {
			$source['show_name'] = $source['name'];
			if (!empty($source['agency_type'])){
				$type = json_decode($source['agency_type'],true);
				$source['show_name'] .= '['.$type['type_desc'].']';
				$source['agency_type_data'] = $type;
			} 
		} else {
			$source['show_name'] = $source['name'];
		}
		if (!empty($source['pay_type_show'])) {
			$source['show_name'] .= '['.$source['pay_type_show'].']';
		}
		return $source;
	}
	
	/**
	* 获取团期参团人列表
	* @param 条件 $conds
	* @param 页显示数量 $startIndex
	* @param 页显示数量 $pageSize
	* @param 排序 $sort
	* @param 填充数据 $find = {	
	*	'order'=>所在订单
	* 	'type'=>成员类型
	* 	'cert'=>证件类型
	* }	
	* 
	* @return
	*/
	public static function getTeamMemberList($conds, $startIndex, $pageSize, $sort, $find=false) {				
		$memberObj = ModelBase::getInstance('signup_member');
		$members = $memberObj->getAll($conds, $startIndex, $pageSize, $total, $sort);
		foreach($members as $uk=>$uv) {
			if (empty($uv['order_id'])) {
				continue;
			}
			
			// 已经退团的参团人
			$order = array();
			if (!empty($uv['exit'])) {
				$order = BackOrderHelp::getOrderInfo($uv['order_id']);
				// 订单非退团状态不添加，退团状态则添加
				if (intval($order['zhuangtai']) != 13) {
					continue;
				}				
			}
			
			// 填充订单详细
			if (!empty($find['order']) || $find === true) {
				if (empty($orderMap[$uv['order_id']])) {
					if (empty($order)) {
						$order = BackOrderHelp::getOrderInfo($uv['order_id']);
					}
					$orderFind = is_array($find['order']) ? $find['order'] : false;
					$order = BackOrderHelp::fillNewOrderInfo($order, $orderFind);
					$orderMap[$uv['order_id']] = $order;	
				} else {
					$order = $orderMap[$uv['order_id']];
				}
				$uv['order_id_data'] = $order;
			}
			
			if (!empty($find['type']) || $find === true) {
				if (empty($MemberTypeMap[$uv['type_id']])) {
					$memberType = BackOrderHelp::MemberTypeKey2Value($uv['type_id'],true);
					$MemberTypeMap[$uv['type_id']] = $memberType;
				} else {
					$memberType = $MemberTypeMap[$uv['type_id']];
				}
				$uv['type_id_data'] = $memberType;
			}
			
			if (!empty($find['cert']) || $find === true) {
				if (empty($CertTypeMap[$uv['certificate_type_id']])) {
					$certType = BackOrderHelp::CertTypeKey2Value($uv['certificate_type_id'],true);
					$CertTypeMap[$uv['certificate_type_id']] = $certType;
				} else {
					$certType = $CertTypeMap[$uv['certificate_type_id']];
				}
				$uv['certificate_type_id_data'] = $certType;
			}
			$members[$uk] = $uv;
		}
		$result['ds'] = $members;
		
		// 页数，总数
		$pageCount = intval($total / $pageSize);
		if (intval($total % $pageSize) > 0) {
			$pageCount += 1;
		}
		$result['page_count'] = $pageCount;
		$result['total_count'] = $total;
		
		return $result;
	}
	
	/**
	* 获取团期参团人
	* @param 条件 $conds
	* @param 查找数据 $find = {
	*	'line'=>所在线路
	* 	'type'=>成员类型
	* 	'cert'=>证件类型
	* }	
	* @return
	*/
	public static function getTeamMember($conds, $find=false) {				
		$memberObj = ModelBase::getInstance('signup_member');
		
		$member = $memberObj->getOne($conds);
		if (empty($member['order_id'])) {
			continue;
		}
		
		// 已经退团的参团人
		if (!empty($member['exit'])) {
			$order = BackOrderHelp::getOrderInfo($member['order_id']);
			// 订单非退团状态不添加，退团状态则添加
			if (intval($order['zhuangtai']) != 13) {
				continue;
			}				
		}
		
		// 填充订单详细
		if (!empty($find['order']) || $find === true) {
			if (is_array($find['order'])) {
				$orderFind = $find['order'];
			} else {
				$orderFind = false;
			}
			if (!empty($order)) {
				$order = BackOrderHelp::getOrderInfo($member['order_id']);	
			}
			$order = BackOrderHelp::fillNewOrderInfo($order, $orderFind);
			$member['order_id_data'] = $order;	
		}
		
		if (!empty($find['type']) || $find === true) {
			$member['type_id_data'] = BackOrderHelp::MemberTypeKey2Value($member['type_id'],true);
		}
		
		if (!empty($find['cert']) || $find === true) {
			$member['certificate_type_id_data'] = BackOrderHelp::CertTypeKey2Value($member['certificate_type_id'],true);
		}
		
		return $member;
	}
		
	/**
	* 
	* @param 条件 $conds
	* @param 起始索引 $startIndex
	* @param 页容量 $pageSize
	* @param 排序 $sort
	* @param 查找填充 $find = {
	*	item => '消费项'
	* 	price => '价格项'
	*	money => '资源费用'
	* 	review => '审核内容'
	* }
	* 
	* @return $result = {
	*	ds => '数据列表'
	* 	page_count => '总页数'
	*	total_count => '总数据量'
	* }
	*/
	public static function getTeamSourceList($conds, $startIndex, $pageSize, $sort, $find=false) {	
		$sourceObj = ModelBase::getInstance('cj_team_source');
		$sources = $sourceObj->getAll($conds, $startIndex, $pageSize, $total, $sort);
		$result['sql'] = $sourceObj->getLastSql();
		
		// 获取资源信息
		foreach ($sources as $sk=>$sv) {			
			// 资源对象类型
			$objType = json_decode($sv['obj_type'], true);			
			$sv['obj_type_data'] = $objType;
			
			$sourceIndex = false;
			$sourceType = array('insurance','leader','hotel','driver','bus','view','agency','source');
			foreach ($sourceType as $stk=>$stv) {
				$cpType = 'cj_source_obj_'.$stv;
				if ($cpType === $objType['type_key']) {
					$sourceIndex = $stk;
					break;
				}
			}
			if ($sourceIndex === false) {
				$sv['obj_data'] = error(-1, '没有匹配的资源类型'.$objType['type_key']);
			
				$sources[$sk] = $sv;
				continue;
			}
			
			// 资源对象
			$sv['obj_data'] = BackFinancialHelp::getSource($sourceType[$sourceIndex], appendLogicExp('id', '=', $sv['obj_id']));
			
			// 资源项
			if (!empty($find['item']) || !empty($find['money']) || $find === true) {
				$sv['item_data'] = BackFinancialHelp::getItem(appendLogicExp('id', '=', $sv['item_id']));
			}
			
			// 资金审批情况
			$sv['allow_review'] = 0;
			if (!empty($find['review']) || $find === true) {
				if (!empty($sv['review_id'])) {
					$sv['review_data'] = $reviewMap['review_'.$sv['review_id']];
					if (empty($sv['review_data'])) {
						$sv['review_data'] = BackFinancialHelp::getTeamDeposit(appendLogicExp('id', '=', $sv['review_id']), true);
						$reviewMap['review_'.$sv['review_id']] = $sv['review_data'];
					}	
					$reviewType = $sv['review_data']['review_type_data']['type_key'];
					if ($reviewType == 'reviewing' || $reviewType == 'review_fail' || $reviewType == 'review_confirm') {
						$sv['allow_review'] = 1;
					}				
				}
			}
			
			// 资源项价格
			if (!empty($find['price']) || !empty($find['money']) || $find === true) {
				$sv['price_data'] = BackFinancialHelp::getPrice(appendLogicExp('id', '=', $sv['price_id']));
			}
			
			// 资源总价
			if (!empty($find['money']) || $find === true) {
				$sv['money'] = '0.00';
				if (empty($sv['item_data']['is_free'])) {
					if (!empty($sv['price_data'])) {
						$sv['money_type'] = '支付';
						$sv['money'] = bcmul($sv['price_data']['real_price'], $sv['num'], 2);
						$sv['money'] = bcadd($sv['money'], $sv['extra_money'], 2);
						if (!empty($sv['price_data']['is_rebate'])) {
							$sv['money_type'] = '返点';
							$sv['money'] = bcsub(0, $sv['money'], 2);
						}
					}	
				}
			}
			
			$sources[$sk] = $sv;
		}
		
		$result['ds'] = $sources;
		
		// 页数，总数
		$pageCount = intval($total / $pageSize);
		if (intval($total % $pageSize) > 0) {
			$pageCount += 1;
		}
		$result['page_count'] = $pageCount;
		$result['total_count'] = $total;
		
		return $result;
	}
	
	/**
	* 获取团期预定资源
	* @param 条件 $conds
	* @param 填充数据 $find = {
	*	item => '消费项'
	* 	price => '价格项'
	*	money => '资源费用'
	* 	review => '审核内容'
	* }
	* 
	* @return
	*/
	public static function getTeamSource($conds, $find=false) {	
		$sourceObj = ModelBase::getInstance('cj_team_source');		
		$source = $sourceObj->getOne($conds);
		if (!empty($source)) {	
			// 资源对象类型
			$objType = json_decode($source['obj_type'], true);			
			$source['obj_type_data'] = $objType;
			
			$sourceIndex = false;
			$sourceType = array('insurance','leader','hotel','driver','bus','view','agency','source');
			foreach ($sourceType as $stk=>$stv) {
				$cpType = 'cj_source_obj_'.$stv;
				if ($cpType === $objType['type_key']) {
					$sourceIndex = $stk;
					break;
				}
			}	
			if ($sourceIndex === false) {
				return error(-1, '未知的团期资源类型');
			}
			
			// 资源对象
			$source['obj_data'] = BackFinancialHelp::getSource($sourceType[$sourceIndex], appendLogicExp('id', '=', $source['obj_id']));
						
			// 资金审批情况
			$source['allow_review'] = 0;
			if (!empty($find['review']) || $find === true) {
				if (!empty($source['review_id'])) {
					$source['review_data'] = $reviewMap['review_'.$source['review_id']];
					if (empty($source['review_data'])) {
						$source['review_data'] = BackFinancialHelp::getTeamDeposit(appendLogicExp('id', '=', $source['review_id']), true);
						$reviewMap['review_'.$source['review_id']] = $source['review_data'];
					}
					$reviewType = $source['review_data']['review_type_data']['type_key'];
					if ($reviewType == 'reviewing' || $reviewType == 'review_fail' || $reviewType == 'review_confirm') {
						$source['allow_review'] = 1;
					}				
				}
			}
			
			// 资源项
			if (!empty($find['item']) || !empty($find['money']) || $find === true) {
				$source['item_data'] = BackFinancialHelp::getItem(appendLogicExp('id', '=', $source['item_id']));
			}
			
			// 资源项价格
			if (!empty($find['price']) || !empty($find['money']) || $find === true) {
				$source['price_data'] = BackFinancialHelp::getPrice(appendLogicExp('id', '=', $source['price_id']));
			}	
			
			// 资源总价
			if (!empty($find['money']) || $find === true) {
				$source['money'] = '0.00';
				if (empty($source['item_data']['is_free'])) {
					if (!empty($source['price_data'])) {
						$source['money_type'] = '支付';
						$source['money'] = bcmul($source['price_data']['real_price'], $source['num'], 2);
						$source['money'] = bcadd($source['money'], $source['extra_money'], 2);
						if (!empty($source['price_data']['is_rebate'])) {
							$source['money_type'] = '返点';
							$source['money'] = bcsub(0, $source['money'], 2);
						}
					}	
				}
			}		
		}		
		return $source;
	}
		
	/**
	* 填充团期预交金
	* @param 获取条件 $conds
	* @param 填充数据 $find = {
	* 	obj_show => '提审预算对象展示数据'	
	* 	supervise => '提审记录的跟踪日志'
	* }
	* 
	* @return
	*/
	public static function getTeamDepostList($conds, $startIndex, $pageSize, $sort, $find=false, &$out) {	
		$depositObj = ModelBase::getInstance('cj_deposit');
		$deposits = $depositObj->getAll($conds, $startIndex, $pageSize, $total, $sort, false, $out);
		
		// 填充团期预交金信息
		foreach ($deposits as $sk=>$sv) {	
			// 预交金对象类型
			$sv['deposit_obj_data'] = json_decode($sv['deposit_obj'], true);
			
			// 预交金对象展示内容
			if (!empty($find['obj_show']) || $find === true) {
				$sv['team_data'] = BackFinancialHelp::getTeam(appendLogicExp('id', '=', $sv['team_id']));			
				if ($sv['deposit_obj_data']['type_key'] == 'cj_deposit_obj_source') {
					// 资源对象类型
					$objType = json_decode($sv['obj_type'], true);			
					$sv['obj_type_data'] = $objType;
					
					$sourceType = array('insurance','leader','hotel','driver','bus','view','agency','source');
					foreach ($sourceType as $stk=>$stv) {
						if ('cj_source_obj_'.$stv === $objType['type_key']) {
							$sourceIndex = $stk;
							break;
						}
					}	
					if (empty($sourceIndex)) {
						$sv['obj_data'] = error(-1, '没有匹配的资源类型');
						continue;
					}
					
					// 资源对象
					$sv['obj_data'] = BackFinancialHelp::getSource($sourceType[$sourceIndex], appendLogicExp('id', '=', $sv['obj_id']));
					$sv['deposit_obj_show'] = $sv['obj_data']['show_name'];
				} else {
					// 团期信息
					$sv['deposit_obj_show'] = $sv['team_data']['team_code'];
				}	
			}
			
			// 预交金类型
			$sv['deposit_type_data'] = json_decode($sv['deposit_type'], true);
			// 收款类型
			$sv['pay_type_data'] = json_decode($sv['pay_type'], true);
			// 申请管理员
			$sv['request_admin_data'] = json_decode($sv['request_admin'], true);
			// 审核类型
			$sv['review_type_data'] = json_decode($sv['review_type'], true);
			// 审核管理员
			$sv['review_admin_data'] = json_decode($sv['review_admin'], true);
			// 确认管理员
			$sv['confirm_admin_data'] = json_decode($sv['confirm_admin'], true);
			
			// 监督信息
			if (!empty($find['supervise']) || $find === true) {
				$superviseObj = ModelBase::getInstance('supervise');
				$conds = appendLogicExp('supervise_type', 'LIKE', '%supervise_type_cj_team%');
				$conds = appendLogicExp('supervise_id', '=', $deposit['id'], 'AND', $conds);
				$conds = appendLogicExp('bind_data', '=', $deposit['team_id'], 'AND', $conds);
				$sv['supervises'] = $superviseObj->getAll($conds, 0, 0, $total, array('id'=>'desc'));
				foreach ($deposit['supervises'] as $ssk=>$ssv) {
					$ssv['supervise_type'] = json_decode($ssv['supervise_type'], true);
					$ssv['admin'] = json_decode($ssv['admin'], true);						
					$sv['supervises'][$ssk] = $ssv;
				}			
			}
			
			$deposits[$sk] = $sv;
		}
		
		$result['ds'] = $deposits;
		
		// 页数，总数
		$pageCount = intval($total / $pageSize);
		if (intval($total % $pageSize) > 0) {
			$pageCount += 1;
		}
		$result['page_count'] = $pageCount;
		$result['total_count'] = $total;
		
		return $result;
	}
	
	/**
	* 获取团期团期预交金
	* @param 获取条件 $conds
	* @param 填充数据 $find = {
	* 	obj_show => '提审预算对象展示数据'	
	* 	supervise => '提审记录的跟踪日志'
	* }
	* 
	* @return
	*/
	public static function getTeamDeposit($conds, $find=false) {	
		$depositObj = ModelBase::getInstance('cj_deposit');		
		$deposit = $depositObj->getOne($conds);
		if (!empty($deposit)) {			
			// 预交金对象类型
			$deposit['deposit_obj_data'] = json_decode($deposit['deposit_obj'], true);
			
			// 预交金对象展示内容
			if (!empty($find['obj_show']) || $find === true) {
				$deposit['team_data'] = BackFinancialHelp::getTeam(appendLogicExp('id', '=', $deposit['team_id']));			
				if ($deposit['deposit_obj_data']['type_key'] == 'cj_deposit_obj_source') {
					// 资源对象类型
					$objType = json_decode($deposit['obj_type'], true);			
					$deposit['obj_type_data'] = $objType;
					
					$sourceType = array('insurance','leader','hotel','driver','bus','view','agency','source');
					foreach ($sourceType as $stk=>$stv) {
						if ('cj_source_obj_'.$stv === $objType['type_key']) {
							$sourceIndex = $stk;
							break;
						}
					}	
					if (empty($sourceIndex)) {
						$deposit['obj_data'] = error(-1, '没有匹配的资源类型');
					}
					
					// 资源对象
					$deposit['obj_data'] = BackFinancialHelp::getSource($sourceType[$sourceIndex], appendLogicExp('id', '=', $deposit['obj_id']));
					$deposit['deposit_obj_show'] = $deposit['obj_data']['show_name'];
				} else {
					// 团期信息
					$deposit['deposit_obj_show'] = $deposit['team_data']['team_code'];
				}
			}	
			
			// 预交金类型
			$deposit['deposit_type_data'] = json_decode($deposit['deposit_type'], true);
			// 收款类型
			$deposit['pay_type_data'] = json_decode($deposit['pay_type'], true);
			// 申请管理员
			$deposit['request_admin_data'] = json_decode($deposit['request_admin'], true);
			// 审核类型
			$deposit['review_type_data'] = json_decode($deposit['review_type'], true);
			// 审核管理员
			$deposit['review_admin_data'] = json_decode($deposit['review_admin'], true);
			// 确认管理员
			$deposit['confirm_admin_data'] = json_decode($deposit['confirm_admin'], true);
			
			// 监督信息
			if (!empty($find['supervise']) || $find === true) {
				$superviseObj = ModelBase::getInstance('supervise');
				$conds = appendLogicExp('supervise_type', 'LIKE', '%supervise_type_cj_team%');
				$conds = appendLogicExp('supervise_id', '=', $deposit['id'], 'AND', $conds);
				$conds = appendLogicExp('bind_data', '=', $deposit['team_id'], 'AND', $conds);
				$deposit['supervises'] = $superviseObj->getAll($conds, 0, 0, $total, array('id'=>'desc'));
				foreach ($deposit['supervises'] as $sk=>$sv) {
					$sv['supervise_type'] = json_decode($sv['supervise_type'], true);
					$sv['admin'] = json_decode($sv['admin'], true);						
					$deposit['supervises'][$sk] = $sv;
				}				
			}
		}		
		return $deposit;
	}
	
	// 获取团期订单资金
	public static function getTeamOrderMoney($teamId, &$out) {
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$orders = $orderObj->getAll(appendLogicExp('team_id', '=', $teamId));		
		foreach ($orders as $ok=>$ov) {
			$orderMoney = BackOrderHelp::getOrderNeedPayMoney($ov['id'],false,true);
			$out[$ov['order_sn']] = $orderMoney;
			if (!empty($sumMoney)) {
				foreach ($sumMoney as $sk=>$sv) {
					$sumMoney[$sk] = bcadd($sumMoney[$sk], $orderMoney[$sk], 2);
				}
			} else {
				$sumMoney = $orderMoney;
			}
		}
		if (empty($sumMoney)) {			
			return array('full'=>0.00, 'cut'=>0.00, 'pay'=>0.00, 'sub'=>0.00, 'extra'=>0.00, 'coupon'=>0.00, 'need'=>0.00);
		} else {
			$sumMoney['sub'] = bcsub($sumMoney['need'], $sumMoney['pay'], 2);
			return $sumMoney;	
		}
	}
	
	// 获取订单团期同行
	public static function getTeamTonghang($teamId) {
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$orders = $orderObj->getAll(appendLogicExp('team_id', '=', $teamId));	
	}
		
	/**
	* 填充团期预定资源
	* @param 团期信息 $ds
	* @param 填充数据 $find = {
	*		'member'=>绑定的参团人 = {
	*			'line'=>所在线路
	* 			'batch'=>所在批次
	* 			'order'=>所在订单
	*		},
	* 		source => '团期资源' = {
	*			item => '消费项'
	* 			price => '价格项'
	*		}
	* 		order_money=> '订单总金额'
	* 		deposit=> '团期预交金'
	* 		supervise=> '跟踪记录'
	* }
	* 
	* @return
	*/
	public static function fillTeam($ds, $find) {
		if (is_array($ds) == false) {
			$ds;
		} 
		
		$dsIsList = true;
		foreach($ds as $testK=>$testV) {
			if (is_numeric($testK) === false) {
				$ds = array($ds);
				$dsIsList = false;
			}
			break;
		}
		
		foreach ($ds as $dk=>$dv) {			
			// 填充团期所在线路
			if (!empty($dv['line'])) {
				$dv['line_data'] = json_decode($dv['line'], true);
				if (!empty($dv['is_team'])) {
					$dv['batch_show_text'] = $dv['line_data']['meet_time'];
				}
			}
			
			// 填充团期所属批次
			if (!empty($dv['batch'])) {
				$dv['batch_data'] = json_decode($dv['batch'], true);
				$dv['batch_show_text'] = '';
				if (!empty($dv['batch_data']['start_time'])) {
					$dv['batch_show_text'] = getDateTime($dv['batch_data']['start_time'], false, true, 1);
				}
				if (!empty($dv['batch_data']['end_time'])) {
					if (!empty($dv['batch_show_text'])) {
						$dv['batch_show_text'] .= ' 至 ';
					}
					$dv['batch_show_text'] .= getDateTime($dv['batch_data']['end_time'], false, true, 1);
				}
			}
			
			// 填充团期领队
			if (!empty($dv['leader'])) {
				$dv['leader_data'] = json_decode($dv['leader'], true);
				$dv['leader_show_text'] = '';
				if (!empty($dv['leader_data']['name'])) {
					$dv['leader_show_text'] = $dv['leader_data']['name'];
				} else if (!empty($dv['leader_data']['nickname'])) {
					$dv['leader_show_text'] = $dv['leader_data']['nickname'];
				} else if (!empty($dv['leader_data']['stagename'])) {
					$dv['leader_show_text'] = $dv['leader_data']['stagename'];
				}
			}
			
			// 填充团期管理员
			if (!empty($dv['admin'])) {
				$dv['admin_data'] = json_decode($dv['admin'], true);
				$dv['admin_show_text'] = $dv['admin_data']['account'];
			}
			
			// 填充团期地接
			if (!empty($dv['dijie'])) {
				$dv['dijie_data'] = json_decode($dv['dijie'], true);				
			}
			
			// 填充团期地接
			if (!empty($dv['insurance'])) {
				$dv['insurance_data'] = json_decode($dv['insurance'], true);				
			}
			
			// 填充团期参团人
			if (!empty($find['member']) || $find === true) {
				if ($find === true || $find['member'] === true) {
					$memberFind = array('order'=>array('state'=>true, 'batch'=>true, 'line'=>true), 'type'=>true, 'cert'=>true);
				} else {
					$memberFind = $find['member'];
				}
				$dv['memberFind'] = $memberFind;
				$conds = appendLogicExp('team_id', '=', $dv['id']);
				$members = BackFinancialHelp::getTeamMemberList($conds, 0, 0, array('id'=>'asc'), $memberFind);
				$dv['members'] = $members['ds'];
			}
			
			// 资源总金额
			$dv['money'] = 0.00;
			
			// 填充资源
			if (!empty($find['source']) || $find === true) {
				$sourceFind = $find['source'];
				if ($find === true || $sourceFind === true) {
					$sourceFind = true;
				}
				$conds = appendLogicExp('team_id', '=', $dv['id']);
				$sources = BackFinancialHelp::getTeamSourceList($conds, 0, 0, array('obj_type'=>'asc', 'obj_id'=>'asc', 'item_id'=>'asc'), $sourceFind);
				$dv['sources'] = $sources['ds'];
				foreach ($dv['sources'] as $sk=>$sv) {
					$dv['money'] = bcadd($dv['money'], floatval($sv['money']), 2);
				}
			}
			
			// 团期订单金额
			if (!empty($find['order_money']) || $find === true) {
				$dv['order_money'] = BackFinancialHelp::getTeamOrderMoney($dv['id'],$out);
				$dv['order_out'] = $out;
			}
			
			// 团期提审总预算
			$dv['deposit_money'] = 0.00;
			// 团期提审总减免
			$dv['deposit_derate'] = 0.00;
			// 团期提审总支付
			$dv['deposit_complated_money'] = 0.00;
			
			// 团期预交金
			if (!empty($find['deposit']) || $find === true) {
				$depositFind = $find['source'];
				if ($find === true || $depositFind === true) {
					$depositFind = true;
				}
				$conds = appendLogicExp('team_id', '=', $dv['id']);
				$deposits = BackFinancialHelp::getTeamDepostList($conds, 0, 0, array('id'=>'asc'), $depositFind);
				$dv['deposits'] = $deposits['ds'];
				foreach ($dv['deposits'] as $ddk=>$ddv) {
					if (stripos($ddv['deposit_type'], 'cj_deposit_type_pay') !== FALSE) { // 支付
						$dv['deposit_money'] = bcadd($dv['deposit_money'], $ddv['money'], 2);
						$dv['deposit_derate'] = bcadd($dv['deposit_derate'], $ddv['derate'], 2);
						$dv['deposit_complated_money'] = bcadd($dv['deposit_complated_money'], $ddv['complated_money'], 2);
					} else { // 收回、同行返利
						$dv['deposit_money'] = bcsub($dv['deposit_money'], $ddv['money'], 2);
						$dv['deposit_derate'] = bcsub($dv['deposit_derate'], $ddv['derate'], 2);
						$dv['deposit_complated_money'] = bcsub($dv['deposit_complated_money'], $ddv['complated_money'], 2);
					}
				}
			}
			
			// 预算结余
			$dv['budget_sub'] = bcsub($dv['money'], $dv['order_money']['sub'], 2);
			$dv['budget_sub'] = bcsub($dv['budget_sub'], $dv['deposit_derate'], 2);
			$dv['budget_sub'] = bcsub($dv['budget_sub'], $dv['deposit_complated_money'], 2);
			
			// 跟踪记录
			if (!empty($find['supervise']) || $find === true) {
				$conds = appendLogicExp('supervise_type', 'LIKE', '%supervise_type_cj_team%');
				$conds = appendLogicExp('bind_data', '=', $dv['id'], 'AND', $conds);
				$supervises = MyHelp::getSuperviseList($conds, 0, 0, array('create_time'=>'desc', 'id'=>'desc'));
				$dv['supervise'] = $supervises['ds'];
			}
			
			$ds[$dk] = $dv;
		}
		
		if ($dsIsList === false) {
			return $ds[0];
		}
		return $ds;
	}
	
	/**
	* 获取团期列表
	* @param 条件 $conds
	* @param 开始索引 $startIndex
	* @param 页显示数量 $pageSize
	* @param 排序 $sort
	* 
	* @return 团期列表
	*/
	public static function getTeamList($conds, $startIndex, $pageSize, $sort) {				
		$teamObj = ModelBase::getInstance('cj_team');
		$ds = $teamObj->getAll($conds, $startIndex, $pageSize, $total, $sort);
		$result['ds'] = $ds;
		
		// 页数，总数
		$pageCount = intval($total / $pageSize);
		if (intval($total % $pageSize) > 0) {
			$pageCount += 1;
		}
		$result['page_count'] = $pageCount;
		$result['total_count'] = $total;
		
		return $result;
	}
	
	/**
	* 获取资源
	* @param 条件 $conds
	* 
	* @return 团期信息
	*/
	public static function getTeam($conds) {				
		$teamObj = ModelBase::getInstance('cj_team');
		$team = $teamObj->getOne($conds);	
		return $team;
	}
	
	
	/**
     *  生成团期保险投保单
     *
     * @access		public static
	 * @param		string		$agent			经办人
	 * @param		string		$lineDesc		旅游线路、团期名称
	 * @param		string		$hdDesc			保险期间、团期时间起止
	 * @param		array		$names   		投保人
     * @return		string		$downloadUrl	文件下载地址
     */
	public static function writePolicy($agent, $lineDesc, $hdDesc, $names){
		if($agent == '' or $lineDesc == '' or $hdDesc == '' or count($names) < 1){
			return error(-1, '请求参数有误！');
		}
		vendor('Fpdf.Chinese');		
		$pdf = new \ PDF_Chinese();
		
		//引入GB字体
		$pdf->AddGBFont();
		
		//设定页面边距
		$pdf->SetMargins(24, 26, 24);
		
		//合同第一页
		$pdf->AddPage();
		
		$pdf->SetFont('GB','',11);
		$pdf->MultiCell(0, 8, iconv("UTF-8", "gbk", "中国人民人寿保险股份有限公司"), 0, C);
		$pdf->MultiCell(0, 8, iconv("UTF-8", "gbk", "旅游意外伤害保险投保单"), 0, C);
		$pdf->MultiCell(0, 8, iconv("UTF-8", "gbk", "经办人：".$agent), 0, L);
		$pdf->MultiCell(0, 8, iconv("UTF-8", "gbk", "旅游线路：".$lineDesc), 0, L);
		$pdf->MultiCell(0, 8, iconv("UTF-8", "gbk", "保险期间：".$hdDesc), 0, L);
		$pdf->MultiCell(0, 8, iconv("UTF-8", "gbk", "保险金额：30万元"), 0, L);
		
		$text1 = '　　欢迎您到中国人民人寿保险股份有限公司投保！在您填写投保单前请详细阅读我公司的旅游意外伤害保险条款，阅读条款时请特别注意条款中的保险责任、责任免除、投保人义务、被保险人义务等内容，同意以此作订立保险合同的依据。被保险人年龄（180天-80周岁，80周岁以上不予承保）。70岁---80岁保险金额最高为5万元。（';
		$text2 = '客人参加游泳、潜水、摩托艇、滑沙、滑雪、骑马、漂流、自驾等高风险项目需购买户外特约保险';
		$text3 = '）';
		
		$pdf->Write(6, iconv("UTF-8", "gbk", $text1));
		$pdf->SetTextColor(255, 0, 0);
		$pdf->SetFont('GB','B',11);
		$pdf->Write(6, iconv("UTF-8", "gbk", $text2));
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFont('GB','',11);
		$pdf->Write(6, iconv("UTF-8", "gbk", $text3));
		
		$pdf->Rect(24, 105, 160, 71, D);
		$pdf->Ln();	
		$pdf->MultiCell(80, 1, '', 0, L);	 
		$pdf->MultiCell(80, 7, '', R, L);	  
		$pdf->MultiCell(80, 8, iconv("UTF-8", "gbk", '投保公司：陕西浪客国际旅行社有限责任公司'), R, L);
		$pdf->MultiCell(80, 8, iconv("UTF-8", "gbk", '投保部门：'), R, L);
		$pdf->MultiCell(80, 8, iconv("UTF-8", "gbk", '经办人：'), R, L);
		$pdf->MultiCell(80, 8, iconv("UTF-8", "gbk", '手机：'), R, L);
		$pdf->MultiCell(80, 8, iconv("UTF-8", "gbk", '传真：029—88225297'), R, L);
		$pdf->MultiCell(80, 8, iconv("UTF-8", "gbk", '地址：西安市高新区太白南路与科创路十字西北角 上上国际1903室'), R, L);
		$pdf->MultiCell(80, 8, '', R, L);
		
		$pdf->SetXY(104, 110);		
		$pdf->MultiCell(80, 8, iconv("UTF-8", "gbk", '保险人：中国人民人寿保险股份有限公司陕西省分公司'), 0, L);
		$pdf->SetX(104);
		$pdf->MultiCell(80, 8, iconv("UTF-8", "gbk", '经办人：王  丁'), 0, L);
		$pdf->SetX(104);
		$pdf->MultiCell(80, 8, iconv("UTF-8", "gbk", '电  话：  18049278604'), 0, L);
		$pdf->SetX(104);
		$pdf->MultiCell(80, 8, iconv("UTF-8", "gbk", '传  真：89386768'), 0, L);
		$pdf->SetX(104);
		$pdf->MultiCell(80, 8, iconv("UTF-8", "gbk", 'E-mail：45464095@qq.com'), 0, L);
		$pdf->SetX(104);
		$pdf->MultiCell(80, 8, iconv("UTF-8", "gbk", '地  址：西安市科技路48号创业广场B座308'), 0, L);
		
		$pdf->Ln();
		$pdf->MultiCell(0, 4, '', 0, L);	
		$pdf->SetTextColor(255, 0, 0);
		$pdf->SetFont('GB','B',11);
		$pdf->MultiCell(0, 8, iconv("UTF-8", "gbk", '投保人数：'.count($names).'人'), 0, L);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFont('GB','',11);
		
		$pdf->Cell(20, 8, iconv("UTF-8", "gbk", '序号'), TRL, 0, C);
		$pdf->Cell(25, 8, iconv("UTF-8", "gbk", '姓名'), TR, 0, C);
		$pdf->Cell(30, 8, iconv("UTF-8", "gbk", '证件类型'), TR, 0, C);
		$pdf->Cell(45, 8, iconv("UTF-8", "gbk", '身份证号'), TR, 0, C);
		$pdf->Cell(40, 8, iconv("UTF-8", "gbk", '电话'), TRL, 1, C);
		
		for($i=0; $i < count($names); $i++){
			$pdf->Cell(20, 8, $i + 1, TRL, 0, C);
			$pdf->Cell(25, 8, iconv("UTF-8", "gbk", $names[$i]['name']), TR, 0, C);
			$pdf->Cell(30, 8, iconv("UTF-8", "gbk", $names[$i]['certificate_type_id_data']['type_desc']), TR, 0, C);
			$pdf->Cell(45, 8, iconv("UTF-8", "gbk", $names[$i]['certificate_num']), TR, 0, C);
			$pdf->Cell(40, 8, iconv("UTF-8", "gbk", $names[$i]['tel']), TRL, 1, C);
		}
				
		$pdf->Cell(160, 1, '', T, 1, C);		
		
		//保存PDF文件
		$pdf->Output("policy".date("YmdHis", time()).".pdf","D");
	}
}

?>