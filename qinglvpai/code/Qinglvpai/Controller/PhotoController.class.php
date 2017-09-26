<?php
namespace Qinglvpai\Controller;
use Think\Controller;
use Core\Model\ModelBase;
use Core\Model\BackLineHelp;
use Core\Model\MyHelp;

define('PHOTO_LIST_SHOW_PAGE_SIZE', 12);
define('PRODUCT_POST_LIST_SHOW_PAGE_SIZE', 20);
class PhotoController extends QlpBaseController {

	public function photoListAction(){
		if(IS_POST){
			$pageIndex = I('post.page', 0);
			$cdsstr = I('post.cdsstr', false);
		}else{
			$lineid = I('get.lineid', '');
			$hdid = I('get.hdid', '');
			$zzorderid = I('get.zzorderid', '');
			if($lineid == '' or $hdid == '' or $zzorderid ==''){
				$data['result'] = error(-1, '请求参数不完整！');
				return $this->ajaxReturn($data);
			}else{
				$cdsstr .= 'lineid|=|'.$lineid.'|AND|';
				$line = BackLineHelp::getLine(appendLogicExp('id', '=', $lineid));
				if(!empty($line)) {
					$lineInfo['lineid'] = $lineid;
					$lineInfo['lineTitle'] = $line['title'];
					$lineInfo['subheading'] = $line['subheading'];
				}
				
				$cdsstr .= 'hdid|=|'.$hdid.'|AND|';
				$hd = BackLineHelp::getBatch(appendLogicExp('id', '=', $hdid));
				if(!empty($hd)){
					$lineInfo['hdid'] = $hdid;
					$lineInfo['hd'] = $hd['start_date_show'].'---'.$hd['end_date_show'];
				}
				//赠品列表
				$giftObj = ModelBase::getInstance('photo_product');
				$giftcds = appendLogicExp('enabled', '=', '1', 'AND', $giftcds);
				$giftcds = appendLogicExp('isgift', '=', '1', 'AND', $giftcds);
				$giftcds = appendLogicExp('classid', '<>', '5', 'AND', $giftcds);				
				$giftList = $giftObj->getAll($giftcds, 0, 0, $aa, array('id'=>'desc'));
				
				//产品列表
				$proObj = ModelBase::getInstance('photo_product');
				$procds = appendLogicExp('enabled', '=', '1', 'AND', $procds);
				$procds = appendLogicExp('classid', '<>', '5', 'AND', $procds);
				$proList = $proObj->getAll($procds, 0, 0, $aa, array('id'=>'desc'));
				$lineInfo['zzorderid'] = $zzorderid;
			}				
		}

		$result = MyHelp::getPageList('photo_info', $cdsstr, $pageIndex, PHOTO_LIST_SHOW_PAGE_SIZE, array('id'=>'desc'), 4, $out);
		$ds = $result['ds'];
		$pageCount = $result['page_count'];
		$totalCount = $result['total_count'];
		if(IS_POST){
			$data['pageindex'] = $pageIndex;
			$data['cdsstr'] = $cdsstr;
			$data['ds'] = $ds;
			$data['page_count'] = $pageCount;
			$data['result'] = error(0, '');						
			return $this->ajaxReturn($data);
		}else{
			$this->assign('photoList', $ds);
			$this->assign('page_count', $pageCount);
			$this->assign('totalCount', $totalCount);
			$this->assign('lineInfo', $lineInfo);
			$this->assign('giftList', $giftList);
			$this->assign('proList', $proList);
			$account = MyHelp::getLoginAccount(true);
			$this->assign('userid', $account['id']);
			$this->showPage('list', 'photo', 'photo', '照片中心', '产品列表', '');
		}

	}

	public function ordersAction(){
		if(IS_POST){
			$type = I('post.op_type', false);
			if($type =='creat_order'){
				$this->cteatOrder('post',$_POST);
			}
		}else{
			$type = I('get.type', false);
			if($type == 'orderInfo'){
				$this->orderInfo('get',$_GET);
			}			
		}
	}
	
	protected function cteatOrder($type, $aa){		
		if (!array_key_exists('data', $aa)) {
			$data['result'] = error(-1, '参数1错误，创建失败');
			return $this->ajaxReturn($data);
		}
		if(!array_key_exists('prolist', $aa)){
			$data['result'] = error(-2, '订单信息不完善！');
			return $this->ajaxReturn($data);
		}
		
		//订单参数
		$ds['order_sn'] = PhotoOrderHelp::createOrderSN();
		$account = MyHelp::getLoginAccount(true);
		$ds['userid'] = $account['id'];
		$ds['lineid'] = $aa['lineid'];	
		$ds['hdid'] = $aa['hdid'];
		$ds['zzorderid'] = $aa['zzorderid'];
		$ds['creat_time'] = $aa['creat_time'];
		$ds['state'] = 1;
		
		//插入订单主信息
		$orderObj = ModelBase::getInstance('photo_orders');
		$orderCols = $orderObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$order = coll_elements_giveup($orderCols, $ds);
		$result = $orderObj->create($order, $orderId);
		if(error_ok($result) === false){
			$data['result'] = error(-3, '订单生成失败！');
			return $this->ajaxReturn($data);
		}
		
		//插入订单产品信息
		$prolist = $aa['prolist'];
		foreach ($prolist as $pro){
			$pro['order_id'] = $orderId;
	    	$proObj = ModelBase::getInstance('photo_orderinfo');
			$proCols = $proObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$prodata = coll_elements_giveup($proCols, $pro);
			$result = $orderObj->create($prodata);
			if(error_ok($result) === false){
				$data['result'] = error(-4, '订单生成失败！');
				return $this->ajaxReturn($data);
			}
	    }
		
		$data['result'] = error(0, '订单生成成功！');
		return $this->ajaxReturn($data);

	}
	
	protected function orderInfo($type, $aa){		
		if($type == 'get'){			
			if (!array_key_exists('data', $aa)) {
				$data['result'] = error(-1, '参数1错误，创建失败');
				return $this->ajaxReturn($data);
			}
			if(!array_key_exists('id', $aa)){
				$data['result'] = error(-2, '订单信息不完善！');
				return $this->ajaxReturn($data);
			}
			
			$conds = appendLogicExp('id', '=', $aa['id']);
			$orderObj = ModelBase::getInstance('photo_orders');
			$order = $orderObj->getOne($conds);
			$this->assign('order', $order);
			$this->showPage('orderInfo', 'order', '订单详情', '订单详情');				
		}else{
			$data['result'] = error(-1, '请求参数错误！');
			return $this->ajaxReturn($data);
		}	
		
	}
	
	public function productAction(){
		if(IS_POST){
			$type = I('post.op_type', false);
			if($type =='order_list'){
				$this->productList('post',$_POST);
			}
		}else{
			
		}
	}
	
	protected function productList($type, $aa){
		if($type == 'post'){
			if (!array_key_exists('data', $aa)) {
				$data['result'] = error(-1, '参数1错误，创建失败');
				return $this->ajaxReturn($data);
			}
			$ds = $aa['data'];
			if(!array_key_exists('cdsstr', $ds)){
				$data['result'] = error(-2, '请求参数不完善！');
				return $this->ajaxReturn($data);
			}
			
			$cdsstr = I('post.cdsstr', '');
			$pageIndex = I('post.page', 0);
					
			$result = MyHelp::getPageList('photo_product', $cdsstr, $pageIndex, PRODUCT_POST_LIST_SHOW_PAGE_SIZE, array('id'=>'desc'), $out);
			$ds = $result['ds'];		
			if(count($ds) < 1){
				$data['result'] = error(-3, '为查询到产品信息');						
				return $this->ajaxReturn($data);
			}
			if(!empty($ds)){
				foreach ($ds as $key => $value) {
					if($value['topid'] == 0){
						$ds[$key]['topclass'] = '顶级分类';
					}else{
						$classObj = ModelBase::getInstance('photo_productclass');
						$conds = appendLogicExp('id', '=', $value['topid']);
						$class = $classObj->getOne($conds);
						$ds[$key]['topclass'] = $class['classname'];
					}
				}
			}
			$data['ds'] = $ds;
			$data['page_count'] = $pageCount;
			$data['result'] = error(0, '');						
			return $this->ajaxReturn($data);
		}else{
			$data['result'] = error(-3, '错误的请求类型！');
			return $this->ajaxReturn($data);
		}
	}
	
}

?>