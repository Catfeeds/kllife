<?php
/**
 * Created by CodeLobster.
 * User: PF
 * Date: 2016-4-20
 * Time: 2016-4-20 11:49:12
 */

namespace Core\Model;

class BackCouponHelp {	

	// 绑定优惠券
	public static function bindOrderCoupon($orderId, $couponTypeId, $cash, $invalid=0, $reason='', &$refreshResult, &$output) {		
		$admin = MyHelp::getLoginAccount(true);
		if (is_error($admin) === true) {
			return $error(-1, '1.绑定优惠券失败，用户未登录', $admin);
		}
		
		// 检测订单是否已经被锁定
		$lockResult = BackOrderHelp::checkOrderLock($orderId);
		if (error_ok($lockResult) === false) {
			return $lockResult;
		}
		
		$ds['order_id'] = $orderId;
		$ds['coupon_type_id'] = $couponTypeId;
		$ds['cash'] = $cash;
		$ds['invalid'] = $invalid;
		$ds['reason'] = $reason;
		$ds['admin_id'] = $admin['id'];
		$ds['bind_time'] = fmtNowDateTime();
		
		$orderCouponObj = ModelBase::getInstance('order_coupon');
		$result = $orderCouponObj->create($ds, $bindId);
		if (error_ok($result) === false) {
			return $error(-2, '2.绑定优惠券失败', $result);
		}		
		
		// 刷新订单总价格
		$refreshResult = BackOrderHelp::getOrderNeedPayMoney($orderId, true);
		
		// 刷新订单状态
		$result = BackOrderHelp::setOrderStateBySystem($orderId, '', $output);			
		if (is_error($result) === false && $result['errno'] !== 1) {
			$resultCoupon = $orderCouponObj->remove(appendLogicExp('id', '=', $bindId));
			if (error_ok($resultCoupon) === false) {
				return error(-3, '3.绑定优惠券时设置状态失败', $result);
			}	
			// 刷新订单总价格
			$refreshMoneyResult = BackOrderHelp::getOrderNeedPayMoney($orderId, true);		
			return $result;
		}	
		return $bindId;
	}
	
	// 修改绑定的优惠券
	public static function modifyOrderCoupon($bindId, $saveData, &$refreshMoneyResult, &$output) {			
		$orderCoupon = BackCouponHelp::getOrderCoupon($bindId);
		if (is_error($orderCoupon)) {
			return error(-1, '1.修改绑定优惠券失败', $orderCoupon);
		}
		
		// 检测订单是否已经被锁定
		$lockResult = BackOrderHelp::checkOrderLock($orderCoupon['order_id']);
		if (error_ok($lockResult) === false) {
			return $lockResult;
		}
		
		$output['coupon'] = $orderCoupon;	
		$orderCouponObj = ModelBase::getInstance('order_coupon');
		$colNames = $orderCouponObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNames, $saveData);
		unset($ds['id']);
		$result = $orderCouponObj->modify($ds, appendLogicExp('id', '=', $bindId));	
		$output['sql'] = $orderCouponObj->getLastSql();
		$output['ds'] = $ds;
		if (error_ok($result) === true) {					
			// 刷新订单总价格
			$refreshMoneyResult = BackOrderHelp::getOrderNeedPayMoney($orderCoupon['order_id'], true);		
			// 刷新订单状态
			$result = BackOrderHelp::setOrderStateBySystem($orderCoupon['order_id'], '', $output);
			$output['result'] = $result;
			if (is_error($result) === true && $result['errno'] === 1) {
				$result = error(0, '修改绑定优惠券面值成功');
			} else {
				unset($orderCoupon['id']);
				$resultCallBack = $orderCouponObj->modify($orderCoupon, appendLogicExp('id', '=', $bindId));
				if (error_ok($resultCallBack) === false) {
					$result = error(-2, '2.修改绑定优惠券面值设置状态是错误，回滚失败', $result);
				}
				// 刷新订单总价格
				$refreshMoneyResult = BackOrderHelp::getOrderNeedPayMoney($orderCoupon['order_id'], true);
			}
		}
		return $result;
	}
	
	// 移除绑定的优惠券
	public static function removeOrderCoupon($bindId, &$refreshMoneyResult) {						
		$orderCoupon = BackCouponHelp::getOrderCoupon($bindId);
		if (is_error($orderCoupon)) {
			return error(-1, '1.移除绑定优惠券失败', $orderCoupon);
		}
		
		// 检测订单是否已经被锁定
		$lockResult = BackOrderHelp::checkOrderLock($orderCoupon['order_id']);
		if (error_ok($lockResult) === false) {
			return $lockResult;
		}
		
		// 修改优惠券信息
		$orderCouponObj = ModelBase::getInstance('order_coupon');				
		$result = $orderCouponObj->modify(array('invalid'=>'1'), appendLogicExp('id', '=', $bindId));
		if (error_ok($result) === false) {
			return error(-2, '2.移除绑定优惠券失败', $result);
		}
				
		// 刷新订单总价格
		$refreshMoneyResult = BackOrderHelp::getOrderNeedPayMoney($orderCoupon['order_id'], true);
		// 刷新订单状态
		$result = BackOrderHelp::setOrderStateBySystem($orderCoupon['order_id'], '', $output);			
		if (is_error($result) === false && $result['errno'] !== 1) {
			$resultCoupon = $orderCouponObj->modify(array('invalid'=>'0'), appendLogicExp('id', '=', $bindId));
			if (error_ok($resultCoupon) === false) {
				return error(-3, '3.绑定优惠券时设置状态失败', $result);
			}				
			// 刷新订单总价格
			$refreshMoneyResult = BackOrderHelp::getOrderNeedPayMoney($orderCoupon['order_id'], true);
			return $result;
		}
		return error(0, '移除绑定优惠券成功');
	}
	
	// 获取绑定的优惠券
	public static function getOrderCoupon($bindId) {
		$orderCouponObj = ModelBase::getInstance('order_coupon');
		$orderCoupon = $orderCouponObj->getOne(appendLogicExp('id', '=', $bindId));
		if (empty($orderCoupon)) {
			return error(-1, '未能获取正确的绑定优惠券信息');
		}
		return $orderCoupon;
	}	
}

?>