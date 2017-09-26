<?php
/**
 * Created by CodeLobster.
 * User: PF
 * Date: 2016-4-12
 * Time: 2016-4-12 19:24:20
 */

namespace Core\Model;

class BackExtraCashHelp {	

	// 添加额外费用
	public static function appendExtraCash($orderId, $cashUseId, $cash, $reviewPayId=0, $reviewRefundId=0, $invalid=0, $reason='', &$refreshMoneyResult, &$output) {
	
		// 检测订单是否已经被锁定
		$lockResult = BackOrderHelp::checkOrderLock($orderId);
		if (error_ok($lockResult) === false) {
			return $lockResult;
		}
		
		$ds['order_id'] = $orderId;
		$ds['cash_use_id'] = $cashUseId;
		$ds['cash'] = $cash;
		$ds['review_pay_id'] = $reviewPayId;		
		$ds['review_refund_id'] = $reviewRefundId;
		$ds['invalid'] = $invalid;
		$ds['reason'] = $reason;
		$ds['bind_time'] = fmtNowDateTime();
		
		$extraCashObj = ModelBase::getInstance('order_extra_cash');
		$result = $extraCashObj->create($ds, $extraId);
		if (error_ok($result) === false) {
			return $error(-1, '1.添加额外费用失败，'.$result['message']);
		}
		
		// 刷新订单总价格
		$refreshMoneyResult = BackOrderHelp::getOrderNeedPayMoney($orderId, true);	
		// 刷新订单状态		
		$result = BackOrderHelp::setOrderStateBySystem($orderId, '', $output);			
		if (is_error($result) === false && $result['errno'] !== 1) {
			$resultExtra = $extraCashObj->remove(appendLogicExp('id', '=', $extraId));
			if (error_ok($resultExtra) === false) {
				return error(-2, '2.绑定额外费用时设置状态失败', $result);
			}
			// 刷新订单总价格
			$refreshMoneyResult = BackOrderHelp::getOrderNeedPayMoney($orderId, true);	
			return $result;
		}
		return $extraId;
	}
	
	// 修改额外费用
	public static function modifyExtraCash($extraId, $saveData, &$refreshMoneyResult, &$output) {			
		$extraCash = BackExtraCashHelp::getExtraCash($extraId);
		if (is_error($extraCash)) {
			return $extraCash;
		}
		
		// 检测订单是否已经被锁定
		$lockResult = BackOrderHelp::checkOrderLock($extraCash['order_id']);
		if (error_ok($lockResult) === false) {
			return $lockResult;
		}
			
		$extraCashObj = ModelBase::getInstance('order_extra_cash');
		$colNames = $extraCashObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNames, $saveData);
		$result = $extraCashObj->modify($ds, appendLogicExp('id', '=', $extraId));		
		if (error_ok($result)) {	
			// 刷新订单总价格
			$refreshMoneyResult = BackOrderHelp::getOrderNeedPayMoney($extraCash['order_id'], true);			
			// 刷新订单状态	
			$result = BackOrderHelp::setOrderStateBySystem($extraCash['order_id'], '', $output);			
			if (is_error($result) === true || $result['errno'] === 1) {				
				$result = error(0, '修改额外费用成功');		
			} else {
				unset($extraCash['id']);
				$output['extraCash'] = $extraCash;
				$resultCallBack = $extraCashObj->modify($extraCash, appendLogicExp('id', '=', $extraId));
				if (error_ok($resultCallBack) === false) {
					$result = error(-1, '1.修改额外费用设置状态是错误，回滚失败', $result);
				}
				// 刷新订单总价格
				$refreshMoneyResult = BackOrderHelp::getOrderNeedPayMoney($extraCash['order_id'], true);	
			}
		}
		return $result;
	}
	
	// 移除额外费用
	public static function removeExtraCash($extraId, &$refreshMoneyResult, &$output) {		
		// 获取额外费用
		$extraCashObj = ModelBase::getInstance('order_extra_cash');
		$extraCash = $extraCashObj->getOne(appendLogicExp('id', '=', $extraId));
		if (empty($extraCash)) {
			return error(-1, '1.未能获取正确的额外费用信息，移除失败');
		}
		
		// 检测订单是否已经被锁定
		$lockResult = BackOrderHelp::checkOrderLock($extraCash['order_id']);
		if (error_ok($lockResult) === false) {
			return $lockResult;
		}
		
		$cash_use_key = BackReviewHelp::cashFuncKey2Value($extraCash['cash_use_id']);
		if ($cash_use_key === 'team') {
			return error(-2, '2.额外费用为团费时不能删除');
		}
		
//		// 如果存在已审核支付记录，则提交退费申请
//		if (!empty($extraCash['review_pay_id']) && empty($extraCash['review_refund_id'])) {
//			$review = BackReviewHelp::getReviewInfo($extraCash['review_pay_id']);
//			if (is_error($review) && error_ok($review) === false) {
//				return error(-2, '2.额外费用对应的支付审核无法找到，移除失败'.$review['message']);
//			}
//			
//			// 提交退款审核
//			$funcId = BackReviewHelp::cashFuncKey2Value('refund');			
//			$reason = '额外费用移除产生的退费';
//			$newReviewId = BackReviewHelp::commitOrderReview($review['order_id'],$review['cash'],$funcId,$review['cash_use_id'],$review, $reason, $extraCash['id']);
//			if (is_error($newReviewId)) {
//				return $newReviewId;
//			} else {
//				// 刷新订单状态
//				$data['result'] = BackOrderHelp::setOrderStateBySystem($review['order_id']);
//			}
//			
//			return error(-3, '3.移除额外费用申请已提交，请耐心等待审核');
//		}
		
		$result = $extraCashObj->modify(array('invalid'=>'1'), appendLogicExp('id', '=', $extraId));
		if (error_ok($result) === false) {
			return error(-4, '4.移除额外费用失败，'.$result['message']);
		}
		
		// 刷新订单总价格
		$refreshMoneyResult = BackOrderHelp::getOrderNeedPayMoney($extraCash['order_id'], true);		
		// 刷新订单状态
		$result = BackOrderHelp::setOrderStateBySystem($extraCash['order_id'], '', $output);			
		if (is_error($result) === false && $result['errno'] !== 1) {
			$resultExtra = $extraCashObj->modify(array('invalid'=>'0'), appendLogicExp('id', '=', $extraId));
			if (error_ok($resultExtra) === false) {
				return error(-5, '5.绑定额外费用时设置状态失败', $result);
			}
			// 刷新订单总价格
			$refreshMoneyResult = BackOrderHelp::getOrderNeedPayMoney($extraCash['order_id'], true);	
			return $result;
		}
		return error(0, '移除额外费用成功');
	}
	
	// 获取额外费用
	public static function getExtraCash($extraId) {
		// 获取额外费用
		$extraCashObj = ModelBase::getInstance('order_extra_cash');
		$extraCash = $extraCashObj->getOne(appendLogicExp('id', '=', $extraId));
		if (empty($extraCash)) {
			return error(-1, '未能获取正确的额外费用信息');
		}
		return $extraCash;
	}

}

?>