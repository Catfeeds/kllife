<?php
/**
 * Created by CodeLobster.
 * User: PF
 * Date: 2016-9-24
 * Time: 2016-9-24 14:17:52
 */

namespace Core\Model;

class BackAccountHelp {	
	// 缓存账户类型
	public static function cacheAccountType($returntype='key', $force=false) {
		return MyHelp::cacheTypeData('account_types', 'account_type', '', $returntype, $force);
	}
	
	// 缓存后台管理员账户类型
	public static function cacheAdminType($returntype='key', $force=false) {
		return MyHelp::cacheTypeData('back_admin_types', 'admin_type', '', $returntype, $force);
	}
	
	// 缓存后台管理员权限组类型
	public static function cacheAdminGroupType($returntype='key', $force=false) {
		return MyHelp::cacheTypeData('back_admin_group_types', 'grant_group', '', $returntype, $force);
	}
	
	// 缓存站点类型
	public static function cacheStationType($returntype='key', $force=false) {
		return MyHelp::cacheTypeData('station_types', 'station_info', '', $returntype, $force, 'key');
	}
		
	// 账号类型键值编号互转
	public static function AccountTypeKey2Value($param, $dataAll=false) {	
		// 缓存账号类型类型
		if (is_numeric($param)) {
			$typeIdMap = BackAccountHelp::cacheAccountType('id');
			if (empty($typeIdMap) || empty($typeIdMap[$param])) {
				return error(-1, '错误的账号类型源转换');
			}
			$type = $typeIdMap[$param];
			$valCol = 'type_key';
		} else {
			$typeKeyMap = BackAccountHelp::cacheAccountType('key');
			if (empty($typeKeyMap) || empty($typeKeyMap[$param])) {
				return error(-1, '错误的账号类型源转换');
			}
			$type = $typeKeyMap[$param];
			$valCol = 'id';
		}
		return $dataAll === false ? $type[$valCol] : $type;
	}
	
	// 后台管理员账户类型键值转换
	public static function AdminTypeKey2Value($param, $dataAll=false) {
		// 缓存账号类型类型
		if (is_numeric($param)) {
			$typeIdMap = BackAccountHelp::cacheAdminType('id');
			if (empty($typeIdMap) || empty($typeIdMap[$param])) {
				return error(-1, '错误的后台管理员账户类型源转换');
			}
			$type = $typeIdMap[$param];
			$valCol = 'type_key';
		} else {
			$typeKeyMap = BackAccountHelp::cacheAdminType('key');
			if (empty($typeKeyMap) || empty($typeKeyMap[$param])) {
				return error(-1, '错误的后台管理员账户类型源转换');
			}
			$type = $typeKeyMap[$param];
			$valCol = 'id';
		}
		return $dataAll === false ? $type[$valCol] : $type;
	}
	
	// 管理员权限组键值转换
	public static function AdminGroupKey2Value($param, $dataAll=false) {
		// 缓存账号类型类型
		if (is_numeric($param)) {
			$typeIdMap = BackAccountHelp::cacheAdminGroupType('id');
			if (empty($typeIdMap) || empty($typeIdMap[$param])) {
				return error(-1, '错误的管理员权限组类型源转换');
			}
			$type = $typeIdMap[$param];
			$valCol = 'type_key';
		} else {
			$typeKeyMap = BackAccountHelp::cacheAdminGroupType('key');
			if (empty($typeKeyMap) || empty($typeKeyMap[$param])) {
				return error(-1, '错误的管理员权限组类型源转换');
			}
			$type = $typeKeyMap[$param];
			$valCol = 'id';
		}
		return $dataAll === false ? $type[$valCol] : $type;
	}
		
	// 账号所属站点键值编号互转
	public static function StationTypeKey2Value($param, $dataAll=false) {
		// 缓存账号类型类型
		if (is_numeric($param)) {
			$typeIdMap = BackAccountHelp::cacheStationType('id');
			if (empty($typeIdMap) || empty($typeIdMap[$param])) {
				return error(-1, '错误的站点类型源转换');
			}
			$type = $typeIdMap[$param];
			$valCol = 'key';
		} else {
			$typeKeyMap = BackAccountHelp::cacheStationType('key');
			if (empty($typeKeyMap) || empty($typeKeyMap[$param])) {
				return error(-1, '错误的站点类型源转换');
			}
			$type = $typeKeyMap[$param];
			$valCol = 'id';
		}
		return $dataAll === false ? $type[$valCol] : $type;
	}
	
	// 获取账户信息
	public static function getAccount($acctType, $conds) {
		$acctTypeData = BackAccountHelp::AccountTypeKey2Value($acctType, true);		
		if ($acctTypeData['type_key'] === 'account_admin') {
			$tab = 'admin';
		} else if ($acctTypeData['type_key'] === 'account_user'){
			$tab = 'user';
		} else if ($acctTypeData['type_key'] === 'account_distribute'){
			$tab = 'fx_user';
		} else if ($acctTypeData['type_key'] === 'account_member') {
			$tab = 'member';			
			$perfix = 'xz_';
		} else if ($acctTypeData['type_key'] === 'account_seo'){
			$tab = 'seo_user';
		} else {
			return error(-2, '错误的账户类型');
		}
		
		$accountObj = ModelBase::getInstance($tab, $perfix);
		$account = $accountObj->getOne($conds);
		if (empty($account)) {
			return error(-3, '没有找到账户');
		}
		$account['account_type'] = $acctTypeData;
		if ($acctTypeData['type_key'] === 'account_admin') {
			if (!empty($account['nickname'])) {
				$account['show_name'] = $account['nickname'];
			} else if (!empty($account['account'])) {
				$account['show_name'] = $account['account'];
			}
		} else if ($acctTypeData['type_key'] === 'account_user'){
			if (!empty($account['nickname'])) {
				$account['show_name'] = $account['nickname'];
			} else if (!empty($account['name'])) {
				$account['show_name'] = $account['name'];
			} else if (!empty($account['phone'])) {
				$account['show_name'] = substr($account['phone'], 0, '3').'****'.substr($account['phone'], 7);
			} else if (!empty($account['email'])) {
				$account['show_name'] = $account['email'];
			} else if (!empty($account['username'])) {
				$account['show_name'] = $account['username'];
			}
		} else if ($acctTypeData['type_key'] === 'account_distribute'){
			if (!empty($account['nickname'])) {
				$account['show_name'] = $account['nickname'];
			} else if (!empty($account['name'])) {
				$account['show_name'] = $account['name'];
			} else if (!empty($account['username'])) {
				$account['show_name'] = $account['username'];
			} else if (!empty($account['phone'])) {
				$account['show_name'] = substr($account['phone'], 0, '3').'****'.substr($account['phone'], 7);
			} else if (!empty($account['email'])) {
				$account['show_name'] = $account['email'];
			}
		} else if ($acctTypeData['type_key'] === 'account_member') {
			$account['show_name'] = $account['uname'];
		}
		return $account;
	}
	
	// 获取账户信息
	public static function getAccountList($acctType, $conds, $startIndex, $pageCount, &$total, $sort, $fill) {
		$acctTypeData = BackAccountHelp::AccountTypeKey2Value($acctType, true);		
		if ($acctTypeData['type_key'] === 'account_admin') {
			$tab = 'admin';
		} else if ($acctTypeData['type_key'] === 'account_user'){
			$tab = 'user';
		} else if ($acctTypeData['type_key'] === 'account_distribute'){
			$tab = 'fx_user';
		} else if ($acctTypeData['type_key'] === 'account_member') {
			$tab = 'member';			
			$perfix = 'xz_';
		} else if ($acctTypeData['type_key'] === 'account_seo'){
			$tab = 'seo_user';
		} else {
			return error(-2, '错误的账户类型');
		}
		
		$accountObj = ModelBase::getInstance($tab, $perfix);
		$accounts = $accountObj->getAll($conds, $startIndex, $pageCount, $total, $sort);
		if (empty($accounts)) {
			return error(-3, '没有找到账户');
		}
		
		foreach ($accounts as $k=>$account) {
			$account['account_type'] = $acctTypeData;
			if ($acctTypeData['type_key'] === 'account_admin') {
				$account['show_name'] = $account['account'];
			} else if ($acctTypeData['type_key'] === 'account_user'){
				if (!empty($account['name'])) {
					$account['show_name'] = $account['name'];
				} else if (!empty($account['nickname'])) {
					$account['show_name'] = $account['nickname'];
				} else if (!empty($account['username'])) {
					$account['show_name'] = $account['username'];
				} else if (!empty($account['phone'])) {
					$account['show_name'] = substr($account['phone'], 0, '3').'****'.substr($account['phone'], 7);
				} else if (!empty($account['email'])) {
					$account['show_name'] = $account['email'];
				}
			} else if ($acctTypeData['type_key'] === 'account_distribute'){
				$account['show_name'] = $account['account'];
			} else if ($acctTypeData['type_key'] === 'account_member') {
				$account['show_name'] = $account['uname'];
			}
			$accounts[$k]=$account;
		}
		return $accounts;
	}
	
	// 注册用户
	public static function registerUser($user) {		
		$userObj = ModelBase::getInstance('user');
		$colNames = $userObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNames, $user);
		$ds['create_time'] = fmtNowDateTime();
		
		// 姓名唯一性确认
//		if (array_key_exists('name', $ds)) {
//			$conds = appendLogicExp('name', '=', $ds['name'], 'OR', $conds);
//		}
		
		// 用户名唯一性确认
		if (array_key_exists('username', $ds)) {
			$conds = appendLogicExp('username', '=', $ds['username'], 'OR', $conds);
		}
		
		// 手机号码唯一性确认
		if (array_key_exists('phone', $ds)) {
			$conds = appendLogicExp('phone', '=', $ds['phone'], 'OR', $conds);
		}
		
		// 电子邮件唯一性确认
		if (array_key_exists('email', $ds)) {
			$conds = appendLogicExp('email', '=', $ds['email'], 'OR', $conds);
		}
		
		$user = $userObj->getOne($conds);
		if (!empty($user)) {
			return error(-1, '姓名、用户名、手机号码或者电子邮件已经存在，请检查后再进行注册');
		}
		
		$ds['create_time'] = fmtNowDateTime();		
		$ds['salt'] = substr(uniqid(rand()), -6);
		$ds['password'] = md5(md5($ds['password']).$ds['salt']);
		
		$result = $userObj->create($ds, $userId);
		if (error_ok($result) === false) {
			return $result;
		}
		$ds['account_type'] = BackAccountHelp::AccountTypeKey2Value('account_user');
		$ds['id'] = $userId;
		return $ds;
	}
	
	// 获取优惠券列表
	public static function getCoupon($conds) {
		$infoObj = ModelBase::getInstance('user_coupon_type');
		$info = $infoObj->getOne($conds);
		return $info;
	}
	
	/**
	*  获取用户优惠券
	* @param undefined $conds
	* @param undefined $startIndex
	* @param undefined $pageSize
	* @param undefined $total
	* @param undefined $sort
	* @param undefined $find = array(
	* 	'user' => '用户数据',
	* 	'order' => '订单数据'
	* )
	* 
	* @return 优惠券数据列表
	*/
	public static function getUserCoupon($conds, $startIndex, $pageSize, &$total, $sort, $find) {
		if (empty($sort)) {
			$sort = array('send_time'=>'desc');
		}
				
		// 查询用户优惠券
		$couponObj = ModelBase::getInstance('user_coupon');
		$coupons = $couponObj->getAll($conds, $startIndex, $pageSize, $total, $sort);
		foreach ($coupons as $ck=>$cv) {	
			// 优惠券类型		
			$cv['type_data'] = my_json_decode($cv['type'], true);
			
			// 优惠券所属用户
			if (!empty($find['user']) || $find === true) {
				if (empty($userMap[$cv['user_id']])) {
					$user = BackAccountHelp::getAccount('account_user', appendLogicExp('id', '=', $cv['user_id']));				
					$userMap[$cv['user_id']] = $user;
				} else {
					$user = $userMap[$cv['user_id']];
				}
				unset($user['password']);
				$cv['user'] = $user;
			}
			
			// 优惠券使用的订单
			if (!empty($cv['order_id']) && (!empty($find['order']) || $find === true)) {
				if (!empty($cv['order_id'])) {
					if (empty($orderMap[$cv['order_id']])) {
						$order = BackOrderHelp::getOrderInfo($cv['order_id']);
						$orderMap[$cv['order_id']] = $order;
					} else {
						$order = $orderMap[$cv['order_id']];
					}
					$cv['order_id_data'] = $order;
				}				
			}
			
			// 发放优惠券管理员
			$cv['send_acct_data'] = my_json_decode($cv['send_acct'],true);
			
			// 是否有效				
			$st = time();
			$vt = strtotime($cv['valid_time']);
			$et = $vt + intval($cv['valid_second']);
			if (!empty($cv['forever'])) {
				$et = $st + 1;
			}
			
			$cv['invalid_time'] = date('Y-m-d H:i:s', $et);
			$cv['due'] = $st > $et ? 1 : 0;
			$cv['disabled'] = $st < $vt ? 1 : 0;
			
			$cv['valid_date'] = date('Y-m-d', $vt);
			$cv['invalid_date'] = date('Y-m-d', $et);
			$coupons[$ck] = $cv;
		}
		return $coupons;
	}
	
	// 获取用户消息
	public static function getUserMessage($userId) {
		// 消息类型
		$msgTypes = MyHelp::getTypeData('sys_msg');
		foreach ($msgTypes as $mk=>$mv) {
			$msgMap[$mv['id']] = $mv;
		}
		
		$acctType = BackAccountHelp::AccountTypeKey2Value('account_user');
		if (empty($acctType)) {
			return '';
		}
		
		// 查询用户消息
		$sysMsgObj = ModelBase::getInstance('system_message');
		$conds = appendLogicExp('account_type_id', '=', $acctType['id'], 'AND', $conds);
		$conds = appendLogicExp('account_id', '=', $userId, 'AND', $conds);
		$msgs = $sysMsgObj->getAll($conds, 0, 0, $total, array('send_time'=>'desc'));
		foreach ($msgs as $mk=>$mv) {
			if (!empty($msgMap[$mv['type_id']])) {
				$msgType = $msgMap[$mv['type_id']];
				$mv['type_id_data'] = $msgType;
			}
			$msgs[$mk] = $mv;
		}
		return $msgs;
	}	
	
	// 刷新分销用户订单入账信息
	public static function refershFenxiaoOrder($userId) {
		$fxUser = BackAccountHelp::getAccount('account_distribute', $userId);
		if (is_error($fxUser)) {
			return $fxUser;
		}
		
		$userType = MyHelp::TypeDataKey2Value($fxUser['type_id'], true);
		if (is_error($userType) === true) {
			return error(-1, $userType);
		}
		
		if ($userType === 'distribute_user_vip1') {
			return 0.00;
		}
		
		$fxLogObj = ModelBase::getInstance('fx_log');
		$fxOrderObj = ModelBase::getInstance('fx_order');
		$conds = appendLogicExp('user_id', '=', $userId);
		$conds = appendLogicExp('settle_account', '=', '0', 'AND', $conds);
		$fxOrder = $fxOrderObj->getAll($conds);
		
		$commision_money = $fxUser['money'];
		foreach ($fxOrder as $ok=>$ov) {
			$order = BackOrderHelp::getOrderInfo($ov['order_id']);
			$fill = array('state'=>true,'batch'=>true);			
			$order = BackOrderHelp::fillNewOrderInfo($order,$fill);
			
			if (empty($order['hdid_end_time'])) {
				continue;
			}
			$vt = strtotime('-1 week');
			$et = strtotime($order['hdid_end_time']);
			$stateKey = $order['zhuangtai_data']['type_key'];
			if ($vt < $et || ($stateKey != 'pay_complate1' && $stateKey != 'pay_complate' && $stateKey != 'complated')) {
				continue;
			}
			
			$log['content'] = '由于编号为['.$order['id'].']订单号为['.$order['order_sn'].
			']的订单距离出团日期以超过7天，并且订单状态为['.$order['zhuangtai_data']['type_desc'].
			']，导致编号为['.$fxUser['id'].']类型为['.$userType['type_desc'].']的分销用户['.
			$fxUser['name'].'],于'.fmtNowDateTime();
			
			// 分销金额为线路指定的分销佣金
			if ($userType['type_key'] == 'distribute_user_normal' || $userType['type_key'] == 'distribute_user_percent') {
				$adultCount = intval($order['male']) + intval($order['woman']);
				$childCount = intval($order['child']);
				
				$adultMoney = bcmul(floatval($ov['commision_adult']), $adultCount, 2);
				$childMoney = bcmul(floatval($ov['commision_child']), $childCount, 2);		
				// 分销佣金为线路分销佣金的百分比(80%)
				if ($userType['type_key'] == 'distribute_user_percent') {
					$adultMoney = bcmul($adultMoney, 0.8, 2);
					$childMoney = bcmul($childMoney, 0.8, 2);
				}		
				$totalMoney = bcadd($adultMoney, $childMoney, 2);
				$commision_money = bcadd($commision_money, $totalMoney, 2);
				
				$log['content'] .= '收入增加'.$totalMoney.'元，增加前已有佣金:'.$fxUser['money'].
				'元，增加后佣金：'.$commision_money.'元，其中成人佣金：'.$adultMoney.'元，儿童佣金：'.
				$childMoney.'元，人数：'.$adultCount.'/'.$childMoney.'(成人/儿童)，佣金基础价：'.
				$ov['commision_adult'].'元/'.$ov['commision_child'].'元(成人/儿童)';
				// 分销佣金为线路分销佣金的百分比(80%)
				if ($userType['type_key'] == 'distribute_user_percent') {
					$log['content'] .= '，由于该用户为'.$userType['type_desc'].'类型，所以其佣金为基础佣金的80%';
				}
				
			// 分销佣金为订单团费的百分比(15%)
			} else if ($userType['type_key'] == 'distribute_user_line') {
				$teamMoney = floatval($order['team_cut_price']);
				$totalMoney = bcmul($teamMoney,0.15,2);				
				$commision_money = bcadd($commision_money, $totalMoney, 2);
				
				$log['content'] .= '收入增加'.$totalMoney.'元，增加前已有佣金:'.$fxUser['money'].
				'元，增加后佣金：'.$commision_money.'元，由于该用户为'.$userType['type_desc'].
				'类型，所以其佣金为优惠后团费（'.$teamMoney.'元）的15%';
			}
			
						
			// 该订单标注为已入账
			$result = $fxOrderObj->modify(array('settle_account'=>'1'), appendLogicExp('id', '=', $ov['id']));
			if (error_ok($result) === false) {
				$commision_money = bcsub($commision_money, $totalMoney, 2);
				// 记录分销佣金入账失败内容
				$log['admin'] = '';
				$log['create_time'] = fmtNowDateTime();
				$log['content'] = '编号为['.$fxUser['id'].']类型为['.$userType['type_desc'].']的分销用户['.
				$fxUser['name'].']对订单编号为['.$order['id'].']订单号为['.$order['order_sn'].
				'的订单收款时失败，失败原因:'.$result['message'];
				$fxLogObj->create($log, $logId);
			} else {
				// 记录分销佣金入账内容
				$log['admin'] = '';
				$log['create_time'] = fmtNowDateTime();
				$fxLogObj->create($log, $logId);
			}			
		}
		
		if (bccomp($commision_money, $fxUser['money'], 2) == 0) {
			return $commision_money;
		}
		
		$log['admin'] = '';
		$log['create_time'] = fmtNowDateTime();
		$fxUserObj = ModelBase::getInstance('fx_user');
		$result = $fxUserObj->modify(array('money'=>$commision_money), appendLogicExp('id', '=', $fxUser['id']));
		if (error_ok($result) === false) {
			// 记录分销佣金入账失败内容
			$log['content'] = '编号为['.$fxUser['id'].']类型为['.$userType['type_desc'].']的分销用户['.
			$fxUser['name'].']入账金额变更为['.$commision_money.'元]失败，变更前金额为['.$fxUser['money'].
			'元]，失败原因:'.$result['message'];
		} else {
			$log['content'] = '编号为['.$fxUser['id'].']类型为['.$userType['type_desc'].']的分销用户['.
			$fxUser['name'].']入账金额变更为['.$commision_money.'元]成功，变更前金额为['.$fxUser['money'].'元]';
		}
		$fxLogObj->create($log, $logId);
		return $commision_money;
	}
}

?>