<?php
namespace Core\Model;

class PhotoOrderHelp {	
	
	/**
	 * 生成订单编号
	 * 当前时间 + 六位随机码
	 * @access    public static	 * 
	 */
	public static function createOrderSN(){		
	    $order_date = date('YmdHis', time());
		$order_sum = rand(100000,999999);
		return $order_date.$order_sum;
	}

	/**
	 * 获取订单扩展信息
	 * 
	 * @access    public static
	 * @param     array   $orderList       	  原始订单数据
	 * @param     array   $extendItem        要获取的扩展信息数组
	 * 
	 */
	public static function getOrderInfo($orderList, $extendItem){
		if(count($orderList)<1){
			return error(-1, '订单数量小于1，查询失败');
		}	
		for($i=0; $i<count($orderList); $i++){
			
			//线路信息
			if(in_array('line', $extendItem)){							
				$line = BackLineHelp::getLine(appendLogicExp('id', '=', $orderList[$i]['lineid']));
				if(!empty($line)) {
					$orderList[$i]['line_id'] = $orderList[$i]['lineid'];
					$orderList[$i]['line_title'] = $line['title'];
					$orderList[$i]['line_subheading'] = $line['subheading'];
				}
			}
			
			//批次信息
			if(in_array('hd', $extendItem)){				
				$hd = BackLineHelp::getBatch(appendLogicExp('id', '=', $orderList[$i]['hdid']));
				if(!empty($hd)){
					$orderList[$i]['hd_id'] = $orderList[$i]['hdid'];
					$orderList[$i]['hd_desc'] = $hd['start_date_show'].' - '.$hd['end_date_show'];
				}
			}
			
			//用户信息
			if(in_array('user', $extendItem)){				
				$user = BackAccountHelp::getAccount('account_user', appendLogicExp('id', '=', $orderList[$i]['userid']));
				if(!empty($user)){
					$orderList[$i]['user_name'] = $user['show_name'];
				}
			}
			
			//订单状态
			if(in_array('state', $extendItem)){				
				$stateObj = ModelBase::getInstance('order_state');
				$state = $stateObj->getOne(appendLogicExp('id', '=', $orderList[$i]['state']));
				if(!empty($state)){
					$orderList[$i]['state_desc'] = $state['type_desc'];
				}
			}
			
			//订单总价
			if(in_array('sumMoney', $extendItem)){				
				$sumMoney = PhotoOrderHelp::getOrderSumMoney($orderList[$i]['id']);
				if(!empty($sumMoney)){
					$orderList[$i]['sum_money'] = $sumMoney;
				}else{
					$orderList[$i]['sum_money'] = 0;
				}
			}
			
			//订单留言信息
			if(in_array('msgs', $extendItem)){				
				$msgObj = ModelBase::getInstance('photo_order_massage');
				$msgList = $msgObj->getAll(appendLogicExp('order_id', '=', $orderList[$i]['id']), 0, 0, $aa, array('id'=>'desc'));
				if(!empty($msgList)){
					for($j=0; $j < count($msgList); $j++){
						$admin = BackAccountHelp::getAccount('account_admin', appendLogicExp('id', '=', $orderList[$i]['admin_id']));
						if(!empty($admin)){
							$msgList[$j]['admin_id_account'] = $admin['account'];
						}			
					}
					$orderList[$i]['messages'] = $msgList;
				}
			}
			
			//订单跟踪信息
			if(in_array('supervises', $extendItem)){				
				$supObj = ModelBase::getInstance('photo_order_supervise');
				$supList = $supObj->getAll(appendLogicExp('order_id', '=', $orderList[$i]['id']), 0, 0, $aa, array('id'=>'desc'));
				if(!empty($supList)){
					for($s=0; $s < count($supList); $s++){
						$admin = BackAccountHelp::getAccount('account_admin', appendLogicExp('id', '=', $orderList[$i]['admin_id']));
						if(!empty($admin)){
							$supList[$s]['admin_id_account'] = $admin['account'];
						}			
					}
					$orderList[$i]['supervises'] = $supList;
				}
			}
			
			//订单额外费用
			if(in_array('extraCash', $extendItem)){
				$extraObj = ModelBase::getInstance('photo_order_extra_cash');
				$extraList = $extraObj->getAll(appendLogicExp('order_id', '=', $orderList[$i]['id']), 0, 0, $aa, array('id'=>'desc'));
				if(!empty($extraList)){
					for($e=0; $e < count($extraList); $e++){
						$admin = BackAccountHelp::getAccount('account_admin', appendLogicExp('id', '=', $orderList[$i]['admin_id']));
						if(!empty($admin)){
							$extraList[$e]['admin_id_account'] = $admin['account'];
						}	
						
						if($extraList[$e]['calc_mode'] == '0'){
							$extraList[$e]['calc_mode_desc'] = '增加';
						}else{
							$extraList[$e]['calc_mode_desc'] = '减免';
						}	
					}
					$orderList[$i]['extra_cash'] = $extraList;
				}
			}
			
			//线上付款记录
			if(in_array('pays_online', $extendItem)){
				$paysObj = ModelBase::getInstance('photo_pay_log');
				$pays = $paysObj->getAll(appendLogicExp('order_id', '=', $orderList[$i]['id']), 0, 0, $aa, array('id'=>'desc'));
				if(!empty($pays)){
					for($p=0; $p < count($pays); $p++){ 
						$pays[$p]['SendTime_show_text'] = date("Y年m月d日 H:i:s",strtotime($pays[$p]['SendTime']));
						$pays[$p]['DateTime_show_text'] = date('Y年m月d日 H:i:s', $pays[$p]['datetime']);
						$menuItem = MyHelp::MenuItemKey2Value('pay_menu', $pays[$p]['PayChannel'], true);
						$pays[$p]['PayChannel_show_text'] = $menuItem['item_desc'];
					}
					$orderList[$i]['pays_online'] = $pays;				
				}
			}
			
			//订单中详细产品、图片列表及价格计算
			if(in_array('photo_list', $extendItem)){
				$orderInfoObj =  ModelBase::getInstance('photo_orderinfo');
				$orderInfos = $orderInfoObj->getAll(appendLogicExp('order_id', '=', $orderList[$i]['id']), 0, 0, $aa, array('id'=>'asc'));
				if(!empty($orderInfos)){
					
					$proObj = ModelBase::getInstance('photo_product');
					for($p=0; $p < count($orderInfos); $p++){ 
						//分解图片字符串为数组
						$photoArr = explode(',', $orderInfos[$p]['photolist']);
						//获取产品信息					
						$pro = $proObj->getOne(appendLogicExp('id', '=', $orderInfos[$p]['productid']));
						$productType = PhotoOrderHelp::productTypeKey2Value($pro['type']);
						
						//计算产品价格	
						if($productType['type_key'] == 'jx_photo'){
							//产品为精修
							if(count($photoArr) > C('PHOTO_JX_MAXLENGHT')){
								$pro['sum_price'] = (count($photoArr) - C('PHOTO_JX_MAXLENGHT')) * C('PHOTO_JX_UNIT_PRICE');
							}else{
								$pro['sum_price'] = 0;
							}							 
						}elseif($productType['type_key'] == 'gift'){
							//产品为赠品
							$pro['sum_price'] = 0;
						}elseif($productType['type_key'] == 'ordinary'){
							//产品为普通产品
							$pro['sum_price'] = $pro['price'];
						}else{
							//其他产品
							$pro['sum_price'] = 0;
						}
						$orderInfos[$p]['product_type'] = $productType;
						$orderInfos[$p]['product'] = $pro;
						
						//获取图片信息
						$photoObj = ModelBase::getInstance('photo_info');
						for($ph=0; $ph < count($photoArr); $ph++){ 
							$photo = $photoObj->getOne(appendLogicExp('id', '=', $photoArr[$ph]));
							$photoArr[$ph] = $photo;
						}
						$orderInfos[$p]['photoArr'] = $photoArr;
					}
										
					$orderList[$i]['photo_list'] = $orderInfos;	
				}
			}
			
		}

		return $orderList;
	}
	
	/**
	 * 获取订单总金额
	 * 
	 * @access    public static
	 * @param     int    $orderId       	  单个订单ID
	 * 
	 */
	public static function getOrderSumMoney($orderId){
		$orderObj = ModelBase::getInstance('lineenertname', 'xz_');
		$order = $orderObj->getOne(appendLogicExp('id', '=', $orderId));
		if(empty($order)){
			return error(-1, '根据订单编号未能查到指定订单信息,获取订单总金额失败');
		}
		
		//获取订单详细
		$orderInfoObj = ModelBase::getInstance('photo_orderinfo');
		$orderInfo = $orderInfoObj->getAll(appendLogicExp('order_id', '=', $orderId));
		if(empty($orderInfo)){
			return error(-2, '根据订单编号未能查到指定订单详细信息,获取订单总金额失败');
		}
		
		//初始订单总金额
		$sumMoney = 0;
		
		//产品价格
		$proObj = ModelBase::getInstance('photo_product');
		for($i=0; $i < count($orderInfo); $i++){
			$ds = $orderInfo[$i];			
			//分解图片字符串为数组
			$photoArr = explode(',', $ds['photolist']);
			//获取产品信息					
			$pro = $proObj->getOne(appendLogicExp('id', '=', $ds['productid']));
			$productType = PhotoOrderHelp::productTypeKey2Value($pro['type']);
			
			if($productType['type_key'] == 'jx_photo'){
				if(count($photoArr) > C('PHOTO_JX_MAXLENGHT')){
					$sumMoney += (count($photoArr) - C('PHOTO_JX_MAXLENGHT')) * C('PHOTO_JX_UNIT_PRICE');
				}else{
					$sumMoney += 0;
				}
			}elseif($productType['type_key'] == 'gift'){
				$sumMoney += 0;
			}elseif($productType['type_key'] == 'ordinary'){
				$sumMoney += $pro['price'];
			}else{
				$sumMoney += 0;
			}
		}
		
		return $sumMoney;
	}


	/**
	 * 保存订单跟踪记录
	 * 
	 * @access    public static
	 * @param     int      $orderId       	  单个订单ID
	 * @param     int      $adminId       	  管理员ID
	 * @param     string   $content       	  跟踪内容
	 * 
	 */
	public static function saveOrderSupervise($orderId, $adminId, $content){
		if($orderId == '' or $adminId == ''){
			return error(-1, '请求参数不完整！');
		}
				
		$lineObj = ModelBase::getInstance('photo_orders');
		$line = $lineObj->getOne(appendLogicExp('id', '=', $orderId));
		if(empty($line)){
			return error(-2, '未获取到订单信息！');
		}
		
		$userObj = ModelBase::getInstance('admin');
		$user = $userObj->getOne(appendLogicExp('id', '=', $adminId));
		if(empty($user)){
			return error(-3, '管理员信息错误！');
		}
		
		$ds['order_id'] = $orderId;		
		$ds['admin_id'] = $adminId;
		$ds['create_time'] = fmtNowDateTime();
		$ds['content'] = $content;
		
		
		$orderMsgObj = ModelBase::getInstance('photo_order_supervise');		
		$orderMsgCols = $orderMsgObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$saveData = coll_elements_giveup($orderMsgCols, $ds);		
		$result = $orderMsgObj->create($saveData);
		return error(0, $result);
	}
	
	/**
	 * 产品类型键值、编号查询类型数据
	 * 
	 * @access    public static
	 * @param     int    $typeid       	  单个属性ID
	 * 
	 */
	public static function productTypeKey2Value($param){
		$typeObj = ModelBase::getInstance('photo_product_type');
		$cdCol = is_numeric($param) ? 'id' : 'type_key';
		
		$type = $typeObj->getOne(appendLogicExp($cdCol, '=', $param));
		if (empty($type)) {
			return error(-1, '错误的订单状态转换');
		}
		return $type;
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