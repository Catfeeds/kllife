<?php
/**
 * Created by CodeLobster.
 * User: PF
 * Date: 2015/9/28
 * Time: 2015-9-28 04:05:10
 */

namespace Core\Model;
use Think\Upload;

class MyHelp {	
	
	// 获取DataTable中的可搜索列并匹配值
	public static function getDataTableSearchs($aoData, $headerColNames) {
		$likes = array();
		if (empty($aoData['sSearch'])){
			return $likes;
		}
		for($i = 0; $i < count($headerColNames); $i++){
//			$searchName = 'bSearchable_' . strval($i);		
			$searchName = 'bSearchable_' . $i;			
			if ($aoData[$searchName]){
				$likes[$headerColNames[$i]] = $searchName . '|' . $aoData[$searchName] . '|' . $aoData['sSearch'];
			}
		}	
		return $likes;		
	}
	
	// 获取DataTables显示列名称
	public static function getDataTableCols($aoData) {
		$cols = array();
		for ($k = 0; ;$k++) {
			$key = 'mDataProp_'.$k;
			if (array_key_exists($key,$aoData)){
				array_push($cols, $aoData[$key]);
			} else {
				break;
			}
		}
		return $cols;
	}
	
	// 获取DataTables排序列
	public static function getDataTableSortCol($aoData, $usePrefiex=true){
		$sorts = array();
		$cols = MyHelp::getDataTableCols($aoData);
		for ($k = 0; ;$k++) {
			$sk = 'iSortCol_'.$k; 
			if (array_key_exists($sk,$aoData)) {	
				if (count($cols) > intval($aoData[$sk])) {
					$sortIndex = $aoData[$sk];
					$col = $cols[$sortIndex];
					if ($usePrefiex == true) {
						$temp = strchr($cols[$sortIndex],'.',true);
						if ($temp !== false) {
							$col = $temp;	
						}
					}		
					array_push($sorts, $col);
				}	
			} else {	
				break;
			}
		}
		return $sorts;
	}
	
	public static function getLogicExp($dataArray, $op, $lop) {
		$aa = array();
		foreach($dataArray as $k=>$v) {
			array_push($aa, logicExp($k, $op, $v, $lop));
		}
		return $aa;
	}
	
	public static function isLoginAccount() {
        session_start();
		if (MODULE_NAME == 'Back') {
       		$admin = session('admin');
		} else if (MODULE_NAME == 'Home') {
       		$admin = session('user');
		} else if (MODULE_NAME == 'Phone') {
       		$admin = session('phone_user');
		} else if (MODULE_NAME == 'Photo') {
			$admin = session('photo_user');
		} else if (MODULE_NAME == 'Fenxiao') {
			$admin = session('fx_user');
		} else if (MODULE_NAME == 'Qinglvpai') {
			$admin = session('qlp_user');
		} else if (MODULE_NAME == 'Qlpphone') {
			$admin = session('qlphone_user');
		} else if (MODULE_NAME == 'Seo') {
			$admin = session('seo_user');
		} else {
			return false;
		}
        if(empty($admin)) {
			return false;
        }
        return true;
	}
	
	public static function getLoginAccount($jump=false) {
        session_start();
		if (MODULE_NAME == 'Back') {
       		$admin = session('admin');
		} else if (MODULE_NAME == 'Home') {
       		$admin = session('user');
		} else if (MODULE_NAME == 'Phone') {
       		$admin = session('phone_user');
		} else if (MODULE_NAME == 'Photo') {
			$admin = session('photo_user');
		} else if (MODULE_NAME == 'Fenxiao') {
			$admin = session('fx_user');
		} else if (MODULE_NAME == 'Qinglvpai') {
			$admin = session('qlp_user');
		} else if (MODULE_NAME == 'Qlpphone') {
			$admin = session('qlphone_user');
		} else if (MODULE_NAME == 'Seo') {
			$admin = session('seo_user');
		}  else {
			return error(-1, '错误账户类型');
		}
        if(empty($admin)) {
        	if ($jump !== false) {
				redirect(UNLOGIN_URL);
			}
        	return error(-1, '账户未登陆');	
        }
        return $admin;
	}
	
	public static function setLoginAccount($admin) {
		session_start();
		if (!empty($admin)) {
			if (MODULE_NAME == 'Back') {
				session('admin', $admin);
			} else if (MODULE_NAME == 'Home') {
				session('user', $admin);
			} else if (MODULE_NAME == 'Phone') {
				session('phone_user', $admin);
			} else if (MODULE_NAME == 'Photo') {
				session('photo_user', $admin);
			} else if (MODULE_NAME == 'Fenxiao') {
				session('fx_user', $admin);
			} else if (MODULE_NAME == 'Qinglvpai') {
				session('qlp_user', $admin);
			} else if (MODULE_NAME == 'Qlpphone') {
				session('qlphone_user', $admin);
			}  else if (MODULE_NAME == 'Seo') {
				session('seo_user', $admin);
			} else {
				return error(-1, '错误账户类型');
			}
		}
	}	
	
	// 账户退出
	public static function logoutAccount() {
		session_start();
		if (MODULE_NAME == 'Back') {
			unset($_SESSION['admin']);
		} else if (MODULE_NAME == 'Home') {
			unset($_SESSION['user']);
		} else if (MODULE_NAME == 'Phone') {
			unset($_SESSION['phone_user']);
		} else if (MODULE_NAME == 'Photo') {
			unset($_SESSION['photo_user']);
		} else if (MODULE_NAME == 'Fenxiao') {
			unset($_SESSION['fx_user']);
		} else if (MODULE_NAME == 'Qinglvpai') {
			unset($_SESSION['qlp_user']);
		} else if (MODULE_NAME == 'Qlpphone') {
			unset($_SESSION['qlphone_user']);
		} else if (MODULE_NAME == 'Seo') {
			unset($_SESSION['seo_user']);
		} else {
			return error(-1, '错误账户类型');
		}		
	}
	
	public static function refreshAdminGrant() {// 获取权限组绑定的权限
		$admin = MyHelp::getLoginAccount(true);
		if (is_error($admin) === true) {
			return false;
		}
		
		$groupGrantBindObj = ModelBase::getInstance('grant_group_bind');
		$groupGrantBind = $groupGrantBindObj->getAll(appendLogicExp('group_id', '=', $admin['group_id']));
		if (!empty($groupGrantBind)) {
			$cds = array();
			foreach ($groupGrantBind as $ggk=>$ggv) {
				$cds = appendLogicExp('id', '=', $ggv['grant_id'], 'OR', $cds);
			}
			// 获取拥有的权限
			if (!empty($cds)) {
				$grantObj = ModelBase::getInstance('grant');
				$grants = $grantObj->getAll($cds);
				if (!empty($grants)) {
					$grantMap = array();
					foreach ($grants as $gk=>$gv) {
						$grantMap[$gv['grant_key']] = $gv;
					}
					$admin['grant'] = $grantMap;
				}	
			}
		}		
		
		MyHelp::setLoginAccount($admin);
	}
	
	// 导出EXCEL表格
	public static function exportExcel($fileName, $data) {		
		import('Vendor.PHPExcel');
        import("Vendor.PHPExcel.Writer.Excel5");
        import("Vendor.PHPExcel.IOFactory.php");

        $date = date("Y_m_d",time());
        $fileName = $fileName."_{$date}.xls";

        //创建PHPExcel对象，注意，不能少了\
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();
		
		foreach ($data as  $k=>$v) {
			$sheetCount =  $objPHPExcel->getSheetCount();
			if ($k >= $sheetCount) {
				$objPHPExcel->createSheet();
			}
			
			$objActSheet = $objPHPExcel->setActiveSheetIndex($k);
	        $ds = $v['data'];
	        //设置表头
	        foreach($ds as $rowIndex=>$rows){ //行写入
	            $rowIndex = intval($rowIndex)+1;
	            foreach($rows as $colIndex=>$colVal){// 列写入
					$col = \PHPExcel_Cell::stringFromColumnIndex($colIndex);
	                $objActSheet->setCellValueExplicit($col.$rowIndex, $colVal);
	            }
	        }
	        //重命名表
	        $objPHPExcel->getActiveSheet()->setTitle($v['title']);
		}
        
        $fileName = iconv("utf-8", "gb2312", $fileName);

//       	//设置字体大小
//        $objPHPExcel->getDefaultStyle()->getFont()->setSize(14);
//        //设置单元格宽度
//        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
//        //设置默认行高
//        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(23);
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        
        $objPHPExcel->setActiveSheetIndex(0);
        ob_end_clean();//清除缓冲区,避免乱码
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
	}
	
	// 上传文件
	public static function uploadFiles($savePath, $exts, $maxSize=3145728) {
		if (checkDir($savePath) === false){
			return error(-1, '上传路径不存在,path:'.$savePath);
		} else {
		    $upload = new Upload();// 实例化上传类
		    $upload->maxSize = $maxSize ;// 设置附件上传大小
		    $upload->exts = $exts;// 设置附件上传类型
		    $upload->rootPath = $savePath; // 设置附件上传根目录
			$info = $upload->upload();			    
		    if($info === false) {// 上传错误提示错误信息		    	
		    	return error(-1, $upload->getError());
		    }else{// 上传成功
		    	return $info;
		    }
		} 
	}	
	
	// 导入EXCEL表格
	public static function importExcel() {
        header("Content-Type:text/html;charset=utf-8");
		$savePath = C('TMPL_PARSE_STRING.__UPLOAD_REAL_PATH__').'temp/';
		$err = MyHelp::uploadFiles($savePath, array('xls', 'xlsx'));
		if (error_ok($err) === true) {
			return $err;
		}
		
		$info = $err[0];
        $filename = $savePath.$info['savepath'].$info['savename'];
        $exts = $info['ext'];
        		
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
		import('Vendor.PHPExcel');
        //创建PHPExcel对象，注意，不能少了\
        $PHPExcel=new \PHPExcel();
        //如果excel文件后缀名为.xls，导入这个类
        if($exts == 'xls'){
            import("Vendor.PHPExcel.Reader.Excel5");
            $PHPReader=new \PHPExcel_Reader_Excel5();
        }else if($exts == 'xlsx'){
            import("Vendor.PHPExcel.Reader.Excel2007");
            $PHPReader=new \PHPExcel_Reader_Excel2007();
        }
		
		$data['filename'] = $filename;

        //载入文件
        $PHPExcel=$PHPReader->load($filename);
        //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
        $currentSheet=$PHPExcel->getSheet(0);
        //获取总列数
        $allColumn=$currentSheet->getHighestColumn();
        $maxCol = \PHPExcel_Cell::columnIndexFromString($allColumn);
        //获取总行数
        $allRow=$currentSheet->getHighestRow();
        
        $cells = array();        
        //循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
        for($currentRow=1;$currentRow<=$allRow;$currentRow++){
            //从哪列开始，A表示第一列
            for($currentColumn=0;$currentColumn<=$maxCol;$currentColumn++){
                //数据坐标
                $address=\PHPExcel_Cell::stringFromColumnIndex($currentColumn).$currentRow;
                //读取到的数据，保存到数组$arr中
                $cell =$currentSheet->getCell($address)->getValue();
                array_push($cells, $cell);
                //$cell = $data[$currentRow][$currentColumn];
//                if($cell instanceof PHPExcel_RichText){
//                    $cell  = $cell->__toString();
//                    array_push($cells, $cell);
//                }
            }
        }
        $data['ds'] = $cells;
        $data['col'] = $maxCol;
        $data['row'] = $allRow;
        $data['info'] = $info;
		return $data;		
	}
	
	// 检测管理员权限
	public static function check_admin_grant($admin_id, $grant_key) {
		$adminObj = ModelBase::getInstance('admin');
		$admin = $adminObj->getOne(appendLogicExp('id', '=', $admin_id));
		if (empty($admin)) {
			return false;
		}
		
		if ($admin['account'] === 'admin') {
			return true;
		}
		
		$grantGroupBindObj = ModelBase::getInstance('grant_group_bind');
		$conds = appendLogicExp('group_id', '=', $admin['group_id']);
		$grantGroupBind = $grantGroupBindObj->getAll($conds);
		if (empty($grantGroupBind)) {
			return false;
		}
		
		$grantObj = ModelBase::getInstance('grant');
		$grants = $grantObj->getAll();
		if (empty($grants)) {
			return false;
		}
		
		foreach ($grants as $gk=>$gv){
			$grantMap[$gv['id']] = $gv;
		}
		
		foreach ($grantGroupBind as $ggk=>$ggv) {
			if (!empty($grantMap[$ggv['grant_id']])) {
				$grant = $grantMap[$ggv['grant_id']];
				if ($grant['grant_key'] === $grant_key) {
					return true;
				}
			}
		}
		return false;
	}	
	
	// 过滤无效条件	
	public static function filterInvalidConds(&$list) {
		if (is_array($list)) {
			foreach($list as $k=>$v) {
				if ($v === '' || $v === -1 || $v === '-1' || $v === null || $v === array()) {
					unset($list[$k]);
				}
			}
		}
	}
	
	// 通用缓存键值快捷查询数据
	public static function cacheTypeData($cacheName, $tab, $conds=array(), $returntype='key', $force=false, $cacheKey="type_key", $cacheTime=3600) {
		$typeIdMap = S($cacheName.'_idmap');
		$typeKeyMap = S($cacheName.'_keymap');
		if (empty($typeIdMap) || empty($typeKeyMap) || !empty($force)) {
			$typeObj = ModelBase::getInstance($tab);
			$types = $typeObj->getAll($conds);
			foreach($types as $k=>$v) {
				$typeIdMap[$v['id']] = $v;
				$typeKeyMap[$v[$cacheKey]] = $v;
			}
			S($cacheName.'_idmap', $typeIdMap, $cacheTime);
			S($cacheName.'_keymap', $typeKeyMap, $cacheTime);
		}	
		return $returntype == 'key' ? 	$typeKeyMap : $typeIdMap;
	}
	
	// 键值编号互转
	public static function IdEachTypeKey($tab,$param,$perfix='') {
		$thisObj = ModelBase::getInstance($tab,$perfix);
		$cdCol = is_numeric($param) ? 'id' : 'type_key';
		$valCol = is_numeric($param) ? 'type_key' : 'id';
		
		$result = $thisObj->getOne(appendLogicExp($cdCol, '=', $param));
		if (empty($result)) {
			$tableName = $thisObj->getUserDefine(ModelBase::DF_TABLE_NAME);
			return error(-1, '错误的编号键值转换，table:'.$tableName);
		}
		return $result[$valCol];
	}
	
	// 获取数据
	public static function findDataById($tab, $id, $perfix='') {
		$thisObj = ModelBase::getInstance($tab,$perfix);
		$result = $thisObj->getOne(appendLogicExp('id', '=', $id));
		if (empty($result)) {
			$tableName = $thisObj->getUserDefine(ModelBase::DF_TABLE_NAME);
			return error(-1, '未能获取到相关数据，table:'.$tableName);
		}
		return $result;
	}
	
	// 数据类型键值转换
	public static function DataTypeKey2Value($param, $dataAll=false) {
		$dataTypeObj = ModelBase::getInstance('data_type');
		$cdCol = is_numeric($param) ? 'id' : 'type_key';
		$valCol = is_numeric($param) ? 'type_key' : 'id';
		
		$dataType = $dataTypeObj->getOne(appendLogicExp($cdCol, '=', $param));
		if (empty($dataType)) {
			return error(-1, '错误的类型数据转换');
		}
		return $dataAll === false ? $dataType[$valCol] : $dataType;
	}
	
	// 类型数据键值转换
	public static function TypeDataKey2Value($param, $dataAll=false) {
		$typeDataObj = ModelBase::getInstance('type_data');
		$cdCol = is_numeric($param) ? 'id' : 'type_key';
		$valCol = is_numeric($param) ? 'type_key' : 'id';
		
		$typeData = $typeDataObj->getOne(appendLogicExp($cdCol, '=', $param));
		if (empty($typeData)) {
			return error(-1, '错误的类型数据转换');
		}
		return $dataAll === false ? $typeData[$valCol] : $typeData;
	}	
	
	// 获取类型数据的所有数据
	public static function getTypeData($type) {
		if (is_numeric($type)) {
			$typeId = $type;
		} else {
			$typeId = MyHelp::IdEachTypeKey('data_type', $type);
			if (is_error($typeId)) {
				return error(-1, '错误的数据类型');
			}
		}
		
		$conds = appendLogicExp('data_type_id', '=', $typeId);
		$typeDataObj = ModelBase::getInstance('type_data');
		$typeDatas = $typeDataObj->getAll($conds, 0, 0, $total, array('data_type_id'=>'asc', 'sort'=>'asc'));
		if (empty($typeDatas)) {
			return error(-2, '没有找到更多的类型数据');
		}
		return $typeDatas;
	}
	
	// 菜单类型键值转换
	public static function MenuTypeKey2Value($param, $dataAll=false) {
		$typeObj = ModelBase::getInstance('menu_type');
		$cdCol = is_numeric($param) ? 'id' : 'type_key';
		$valCol = is_numeric($param) ? 'type_key' : 'id';
		
		$type = $typeObj->getOne(appendLogicExp($cdCol, '=', $param));
		if (empty($type)) {
			return error(-1, '错误的菜单项转换');
		}
		return $dataAll === false ? $type[$valCol] : $type;
	}
	
	// 菜单项键值转换
	public static function MenuItemKey2Value($type, $param, $dataAll=false) {
		$type = MyHelp::MenuTypeKey2Value($type, true);
		if (is_error($type)) {
			return $type;
		}
		
		$itemObj = ModelBase::getInstance('menu_item');
		$cdCol = is_numeric($param) ? 'id' : 'item_key';
		$valCol = is_numeric($param) ? 'item_key' : 'id';
		
		$conds = appendLogicExp('menu_type_id', '=', $type['id']);
		$conds = appendLogicExp($cdCol, '=', $param, 'AND', $conds);
		$item = $itemObj->getOne($conds);
		if (empty($item)) {
			return error(-1, '错误的菜单项转换');
		}
		$item['menu_type_id_data'] = $type;
		return $dataAll === false ? $item[$valCol] : $item;
	}
	
	// 获取菜单
	public static function getMenuList($type, $parentId=-1, $includeChild=false, $includeForbidden=false, &$out) {
		if (is_numeric($type)) {
			$typeId = $type;
		} else {
			$typeId = MyHelp::IdEachTypeKey('menu_type', $type);
			if (is_error($typeId)) {
				return error(-1, '错误的菜单类型');
			}
		}
		
		$conds = appendLogicExp('menu_type_id', '=', $typeId, 'AND');
		if (intval($parentId) >= 0) {
			$conds = appendLogicExp('parent_id', '=', $parentId, 'AND', $conds);
		}
		if (empty($includeForbidden)) {
			$conds = appendLogicExp('forbidden', '=', '0', 'AND', $conds);
		}
		$menuObj = ModelBase::getInstance('menu_item');
		$menus = $menuObj->getAll($conds, 0, 0, $total, array('parent_id'=>'asc', 'sort'=>'asc', 'id'=>'asc'));
		$out['sql_'.$parentId] = $menuObj->getLastSql();
		if (empty($menus)) {
			return error(-2, '没有找到更多菜单项');
		} else {
			if ($includeChild === true) {
				foreach($menus as $k=>$v) {
					$children = MyHelp::getMenuList($typeId, $v['id'], $includeChild, $includeForbidden, $out);
					if (is_error($children) === false) {
						$menus[$k]['child'] = $children;
					}
				}
			}
			return $menus;	
		}		
	}
	
/**
* 获取分页条件值类型数据,处理一列多对比情况，出现次情况一般采用LIKE比较符
* @param json类型字符串 $valstr
* 
* @return json数组或者对象
*/
	public static function getPageListJson($valstr) {
		if (empty($valstr)) {
			return '';
		}
		
		$arr = array();
		$vals = json_decode($valstr, true);
		foreach ($vals as $k=>$v) {
			// 对象数组
			if (is_numeric($k)) {
				foreach ($v as $vk=>$vv) {
					// 嵌套数组
					if (is_numeric($vk)) {
						$childArr = MyHelp::getPageListJson(json_encode($v));
						array_merge($arr, $childArr);
					} else {
						array_push($arr, $vv);
					}
				}
			// 单纯对象
			} else {	// 是否是对象判断
				foreach ($vals as $vk=>$vv) {
					array_push($arr, $vv);
				}
				break;
			}
		}
		return $arr;
	}
	
/**
* 获取分页的表数据
* @param 表名 $tab
* @param 条件字符串 $cdList
* @param 页码 $pageIndex
* @param 每页数据量 $pageSize
* @param 排序类型 $sortList
* 
* @return
*/
	// 获取分页数据
	public static function getPageList($tab, $cdstr, $pageIndex=0, $pageSize=0, $sortList=array('id'=>'asc'), $cdtype=2, &$out) {
		// 表名
		$tabName = $tab;
		if (is_array($tab)) {
			$tabName = $tab[0];
			$tabPerfix = $tab[1];
		}	
		
		// 获取条件
		if (!empty($cdstr) && intval($cdtype) > 1 && intval($cdtype) < 6) {
			$cdsList = explode('|',$cdstr);
			// 支持条件以字符串组合方式有以下几种：
			$cdCount = count($cdsList);
			$cdDataList = array();
			$out['cdList'] = $cdsList;
			$out['cdcount'] = $cdCount;
			$out['cdIndex'] = $cdCount % 4;
			// 5数据：1->列名，2->比较符号，3->列值，5->逻辑连接符号，5->列值类型
			if ($cdtype == 5) {
				for ($i=0; $i < count($cdsList); $i+=5) {
					$cdData['col'] = $cdsList[$i];
					$cdData['op'] = $cdsList[$i+1];
					$cdData['val'] = $cdsList[$i+2];
					$cdData['lop'] = $cdsList[$i+3];					
					$cdData['val_type'] = empty($cdsList[$i+4]) ? 'normal' : $cdsList[$i+4];
					array_push($cdDataList, $cdData);
				}
			}		
			// 4数据：1->列名，2->比较符号，3->列值，4->逻辑连接符号，默认参数：值类型->默认为常规类型(数值/字符串)
			else if ($cdtype == 4) {
				$cdData['val_type'] = 'normal';
				for ($i=0; $i < count($cdsList); $i+=4) {
					$cdData['col'] = $cdsList[$i];
					$cdData['op'] = $cdsList[$i+1];
					$cdData['val'] = $cdsList[$i+2];
					$cdData['lop'] = $cdsList[$i+3];
					array_push($cdDataList, $cdData);
				}
			}
			// 3数据：1->列名，2->比较符号，3->列值，默认参数：逻辑连接符->'AND'，值类型->默认为常规类型(数值/字符串)			
			else if ($cdtype == 3) {
				$cdData['lop'] = 'AND';
				$cdData['val_type'] = 'normal';
				for ($i=0; $i < count($cdsList); $i+=3) {
					$cdData['col'] = $cdsList[$i];
					$cdData['op'] = $cdsList[$i+1];
					$cdData['val'] = $cdsList[$i+2];
					array_push($cdDataList, $cdData);
				}
			}	
			// 2数据：1->列名，2->列值，默认参数：比较符号->'='，逻辑连接符->'AND'，值类型->默认为常规类型(数值/字符串)
			else if ($cdtype == 2) {
				$cdData['op'] = '=';
				$cdData['lop'] = 'AND';
				$cdData['val_type'] = 'normal';
				for ($i=0; $i < count($cdsList); $i+=2) {
					$cdData['col'] = $cdsList[$i];
					$cdData['val'] = $cdsList[$i+1];
					array_push($cdDataList, $cdData);
				}
			} 
			
			$out['cdDataList'] = $cdDataList;
			foreach ($cdDataList as $k=>$v) {
				if ($v === '' || $v === -1 || $v === '-1' || $v === null || $v === array()) {
					continue;
				}
				$val = $v['val'];
				if ($v['val_type'] == 'json') {
					$val = MyHelp::getPageListJson($v['val']);
				}
				
				if (is_array($val)) {
					foreach ($val as $vk=>$vv) {
						$conds = appendLogicExp($k, 'LIKE', '%'.$vv.'%', $v['lop'], $conds);
					}
				} else {
					$conds = appendLogicExp($v['col'], $v['op'], $val, $v['lop'], $conds);
				}
			}
		}		
		$out['conds'] = $conds;
		
		// 起始索引
		$startIndex = $pageIndex * $pageSize;			
		$out['page_index'] = $pageIndex;
		$out['page_size'] = $pageSize;
		$out['start_index'] = $startIndex;
		
		$tabObj = ModelBase::getInstance($tabName, $tabPerfix);
		$result['ds'] =  $tabObj->getAll($conds, $startIndex, $pageSize, $total, $sortList);
		$out['sql'] = $tabObj->getLastSql();
		
		// 页数
		$pageCount = intval($total / $pageSize);
		if (intval($total % $pageSize) > 0) {
			$pageCount += 1;
		}
		$result['page_count'] = $pageCount;
		$result['total_count'] = $total;
		$out['result'] = $result;
		return $result;
	}
	
	public static function getCondsByStr($cdsstr, $cdtype, &$out) {
		$conds == array();
		// 获取条件
		if (!empty($cdsstr) && intval($cdtype) > 1 && intval($cdtype) < 7) {
			$cdsList = explode('|',$cdsstr);
			// 支持条件以字符串组合方式有以下几种：
			$cdCount = count($cdsList);
			$cdDataList = array();
			// 6数据：1->列名，2->比较符号，3->列值，4->逻辑连接符号，5->列值类型，6->分组类型
			if ($cdtype == 6) {
				for ($i=0; $i < count($cdsList); $i+=6) {
					$cdData['col'] = $cdsList[$i];
					$cdData['op'] = $cdsList[$i+1];
					$cdData['val'] = $cdsList[$i+2];
					$cdData['lop'] = $cdsList[$i+3];					
					$cdData['val_type'] = empty($cdsList[$i+4]) ? 'normal' : $cdsList[$i+4];
					$cdData['group'] = empty($cdsList[$i+5]) ? '0' : $cdsList[$i+5];
					array_push($cdDataList, $cdData);
				}
			// 5数据：1->列名，2->比较符号，3->列值，4->逻辑连接符号，5->列值类型，分组类型->同一组
			} else if ($cdtype == 5) {
				$cdData['gourp'] = '0';
				for ($i=0; $i < count($cdsList); $i+=5) {
					$cdData['col'] = $cdsList[$i];
					$cdData['op'] = $cdsList[$i+1];
					$cdData['val'] = $cdsList[$i+2];
					$cdData['lop'] = $cdsList[$i+3];					
					$cdData['val_type'] = empty($cdsList[$i+4]) ? 'normal' : $cdsList[$i+4];
					array_push($cdDataList, $cdData);
				}
			}		
			// 4数据：1->列名，2->比较符号，3->列值，4->逻辑连接符号，值类型->默认为常规类型(数值/字符串)，分组类型->同一组
			else if ($cdtype == 4) {
				$cdData['gourp'] = '0';
				$cdData['val_type'] = 'normal';
				for ($i=0; $i < count($cdsList); $i+=4) {
					$cdData['col'] = $cdsList[$i];
					$cdData['op'] = $cdsList[$i+1];
					$cdData['val'] = $cdsList[$i+2];
					$cdData['lop'] = $cdsList[$i+3];
					array_push($cdDataList, $cdData);
				}
			}
			// 3数据：1->列名，2->比较符号，3->列值，默认参数：逻辑连接符->'AND'，值类型->默认为常规类型(数值/字符串)，分组类型->同一组			
			else if ($cdtype == 3) {
				$cdData['gourp'] = '0';
				$cdData['lop'] = 'AND';
				$cdData['val_type'] = 'normal';
				for ($i=0; $i < count($cdsList); $i+=3) {
					$cdData['col'] = $cdsList[$i];
					$cdData['op'] = $cdsList[$i+1];
					$cdData['val'] = $cdsList[$i+2];
					array_push($cdDataList, $cdData);
				}
			}	
			// 2数据：1->列名，2->列值，默认参数：比较符号->'='，逻辑连接符->'AND'，值类型->默认为常规类型(数值/字符串)，分组类型->同一组
			else if ($cdtype == 2) {
				$cdData['gourp'] = '0';
				$cdData['op'] = '=';
				$cdData['lop'] = 'AND';
				$cdData['val_type'] = 'normal';
				for ($i=0; $i < count($cdsList); $i+=2) {
					$cdData['col'] = $cdsList[$i];
					$cdData['val'] = $cdsList[$i+1];
					array_push($cdDataList, $cdData);
				}
			}
			 		
			$out['data_list'] = $cdDataList;	
			foreach ($cdDataList as $k=>$v) {
				if ($v === '' || $v === -1 || $v === '-1' || $v === null || $v === array()) {
					continue;
				}
				$val = $v['val'];
				if ($v['val_type'] == 'json') {
					$val = MyHelp::getPageListJson($v['val']);
				}
				
				$groupKey = 'gourp'.$v['group'];
				$conds = $groups[$groupKey];
				
				if (is_array($val)) {
					foreach ($val as $vk=>$vv) {
						$conds = appendLogicExp($k, 'LIKE', '%'.$vv.'%', $v['lop'], $conds);
					}
				} else {
					$conds = appendLogicExp($v['col'], $v['op'], $val, $v['lop'], $conds);
				}
				$groups[$groupKey] = $conds;
			}
		}	
		$out['group'] = $groups;
		
		if (!empty($groups) > 0) {
			$conds = '';
			foreach ($groups as $gk=>$gv) {
				if (empty($conds)) {
					$conds = $gv;
				} else {
					$conds = appendLogicExp($gk, '=', $gv, 'AND', $conds);	
				}
			}
			return $conds;	
		} else {
			return '';
		}		
	}
	
/**
* 获取分页的表数据
* @param 表名 $tab
* @param 条件列表 $conds
* @param 页码 $pageIndex
* @param 每页数据量 $pageSize
* @param 排序类型 $sortList
* 
* @return
*/
	// 获取分页数据
	public static function getPageList1($tab, $conds, $pageIndex=0, $pageSize=0, $sortList=array('id'=>'asc'), &$out) {
		// 表名
		$tabName = $tab;
		if (is_array($tab)) {
			$tabName = $tab[0];
			$tabPerfix = $tab[1];
		}
		
		// 起始索引
		$startIndex = $pageIndex * $pageSize;			
		$out['page_index'] = $pageIndex;
		$out['page_size'] = $pageSize;
		$out['start_index'] = $startIndex;
		
		$tabObj = ModelBase::getInstance($tabName, $tabPerfix);
		$result['ds'] =  $tabObj->getAll($conds, $startIndex, $pageSize, $total, $sortList);
		$out['sql'] = $tabObj->getLastSql();
		
		// 页数
		$pageCount = intval($total / $pageSize);
		if (intval($total % $pageSize) > 0) {
			$pageCount += 1;
		}
		$result['page_count'] = $pageCount;
		$result['total_count'] = $total;
		$out['result'] = $result;
		return $result;
	}
		
	// 检测手机发送信息刷单
	private static function checkSendSMSRefresh($rd, $use, $phone) {			
//		if ($use == 'qinglvpai_sms_login') {
//			return error(-1, '您的操作行为存在恶意操作，系统已经禁用您的操作');
//		}
		session_start();
		if ($rd !== session('page_rand')) {
			return error(-1, '您的本次发送的随机码有误，操作已被拒绝');
		}
		
		// 短信接口是否打开
		$setObj = ModelBase::getInstance('set');
		$setConds = appendLogicExp('station_id', '=', '1');
		$setConds = appendLogicExp('type', '=', 'sms_set', 'AND', $setConds);
		$setConds = appendLogicExp('key', '=', 'send_forbidden', 'AND', $setConds);
		$set = $setObj->getOne($setConds);
		if (!empty($set['value']) === false) {
			$val = json_decode($set['value'], true);
			if ($val['forbidden'] == '1') {
//				$subMinute = time() - strtotime($val['time']);
//				// 禁用时间大于1200秒自动开启
//				if ($subMinute > 1200) {
//					$setObj->modify(ds)
//					return true;
//				} else {
					return error(-1, '接口升级中，请耐心等待.......');	
//				}
			}
		}
		
			
		// 检查验证码是否已经发送
		$codeObj = ModelBase::getInstance('sms_verify');		
		
		// 短信刷单验证
		// 第三级验证:5秒内发送超过5次短信发送
		$st = date('Y-m-d H:i:s', strtotime('-10 second'));
		$et = fmtNowDateTime();
		$conds = appendLogicExp('send_time', '>=', $st, 'AND', $conds);
		$conds = appendLogicExp('send_time', '<=', $et, 'AND', $conds);
		$conds3 = $conds;
		
		// 第二级验证:同一IP5秒内发送超过5此发送
		$userIp = get_user_ip();
//		$conds = appendLogicExp('ip', '=', $userIp, 'AND', $conds);
//		$conds2 = $conds;
		
		// 第一级验证:同一来源同一IP5秒内发送超过5次
		$conds = appendLogicExp('use', '=', $use, 'AND', $conds);
		if (!empty($use)) {
			$sms = $codeObj->getAll($conds);
			if (count($sms) > 5) {
				// 给管理员发送监督消息保证5分钟内不在发送
				$sysConds = appendLogicExp('tel', '=', '15991164339');
				$sysConds = appendLogicExp('use', '=', 'system_refresh_supervise', 'AND', $sysConds);
				$sysMsg = $codeObj->getOne($sysConds);
				if (empty($sysMsg) || (time() - strtotime($smsMsg['send_time'])) > 300) {
					// 记录给管理员发送信息
					$sysds['code'] = '000000';//substr(uniqid(rand()), -6);
					$sysds['send_time'] = fmtNowDateTime();
					$sysds['use'] = 'system_refresh_supervise';
					$$sysdsds['tel'] = '15991164339';
					$sysds['ip'] = get_user_ip();
					$sysds['interval'] = 0; //$interval;
					$sysds['datetime'] = date('YmdHis', time());
					$sysds['salt'] = $rd;
					$codeObj->create($sysds, $sysds['id']);
					// 给管理员发送刷单信息
					$smsMsg = '同一来源['.$use.']5秒内发送超过5次,当前IP['.$userIp.']';
					MsgHelp::sendSMS('15991164339', $smsMsg);
				}
				
				$val['forbidden'] = 1;
				$val['time'] = fmtNowDateTime();
				if (empty($set)) {
					$ds['station_id'] = 1;
					$ds['type'] = 'sms_set';
					$ds['key'] = 'send_forbidden';
					$ds['value'] = my_json_encode($val);
					$setObj->create($ds, $ds['id']);
				} else {
					$setObj->modify(array('value'=>my_json_encode($val)), appendLogicExp('id', '=', $set['id']));	
				}
				return error(-1, '您的操作行为存在恶意操作，系统已经禁用您的操作');
			}
		}
		return error(0, '刷单验证成功');
	}
	
	
	// 发送手机验证码
	public static function sendSMS($use, $tel, $interval, $rd, &$ds) {		
		if (empty($tel)) {
			return error(-1, '请检查是否填写电话号码');
		}
		
		if (check_mobile($tel) === false) {
			return error(-2, '电话号码错误，请查证后再次发送');
		} 
		
		// 短信刷单验证
		$checkRefresh = MyHelp::checkSendSMSRefresh($rd, $use, $tel);
		if (error_ok($checkRefresh) === false) {
			return $checkRefresh;
		}		
		
		// 检查验证码是否已经发送		
		$codeObj = ModelBase::getInstance('sms_verify');
		$conds = appendLogicExp('tel', '=', $tel, 'AND', $conds);
		$conds = appendLogicExp('use', '=', $use, 'AND', $conds);
		$code = $codeObj->getOne($conds);
		if (!empty($code)) {
			$nt = strtotime(fmtNowDateTime());
			$st = strtotime($code['send_time']);
			// 验证码未失效，不在发送
			if (intval($nt-$st) < intval($code['interval'])) {
				return error(-3, '验证码未失效');
			}
		}
		
		// 获取短信模板
		$templateObj = ModelBase::getInstance('sms_template');
		$template = $templateObj->getOne(appendLogicExp('key', '=', $use));
		if (empty($template)) {
			return error(-4, '短信发送失败');
		}
				
		// 获取发送的验证码
		$ds['code'] = substr('00000'.rand(0, 999999), -6);//substr(uniqid(rand()), -6);
		$ds['send_time'] = fmtNowDateTime();
		$ds['use'] = $use;
		$ds['tel'] = $tel;
		$ds['ip'] = get_user_ip();
		$ds['interval'] = 600; //$interval;
		$ds['datetime'] = date('YmdHis', time());
		$ds['salt'] = $rd;
		
		$msg = str_replace('#code', $ds['code'], $template['content']); 
		// 发送验证码到手机
		MsgHelp::sendSMS($tel, $msg);
		
		// 记录验证码
		$result = $codeObj->create($ds, $codeId);
		if (error_ok($result) === false) {
			return $result;
		}		
		$ds['id'] = $codeId;
		
		// 发送验证码
		
		return error(0, '验证码发送成功');
	}
	
	// 检查手机验证码
	public static function checkSMS($use, $tel, $code) {	
		if (empty($tel)) {
			return error(-1, '请检查是否填写电话号码，错误代码:001');
		}
		
		if (check_mobile($tel) === false) {
			return error(-2, '电话号码错误，请查证后再次发送，错误代码:002');
		}
		
		if (empty($code)) {
			return error(-3, '验证不能为空，请重新输入，错误代码:003');
		}
		
		// 检查验证码是否已经发送
		$codeObj = ModelBase::getInstance('sms_verify');
		
		$conds = appendLogicExp('tel', '=', $tel, 'AND');
		$conds = appendLogicExp('use', '=', $use, 'AND', $conds);
		$conds = appendLogicExp('code', '=', $code, 'AND', $conds);
		$code = $codeObj->getOne($conds);
		if (!empty($code)) {
			$nt = strtotime(fmtNowDateTime());
			$st = strtotime($code['send_time']);
			// 验证码未失效，不在发送
			if (intval($nt-$st) > intval($code['interval'])) {
				return error(-4, '验证码失效，错误代码:004');
			}
			
			$codeObj->modify(array('interval'=>0), $conds);
			return error(0, '验证通过');
		} else {
			return error(-5, '验证码错误，错误代码:005');
		}
	}
	
	// 发送邮件验证码
	public static function sendEmail($use, $email, $interval, &$ds) {		
		if (empty($email)) {
			return error(-1, '请检查是否填写邮件');
		}
		
//		if (check_email($email) === false) {
//			return error(-2, '邮件错误，请查证后再次发送');
//		} 
		
		// 检查验证码是否已经发送
		$codeObj = ModelBase::getInstance('sms_verify');
		
		$conds = appendLogicExp('tel', '=', $email, 'AND', $conds);
		$conds = appendLogicExp('use', '=', $use, 'AND', $conds);
		$code = $codeObj->getOne($conds);
		if (!empty($code)) {
			$nt = strtotime(fmtNowDateTime());
			$st = strtotime($code['send_time']);
			// 验证码未失效，不在发送
			if (intval($nt-$st) < intval($code['interval'])) {
				return error(-3, '验证码未失效');
			}
		}
		// 获取短信模板
		$templateObj = ModelBase::getInstance('sms_template');
		$template = $templateObj->getOne(appendLogicExp('key', '=', $use));
		if (empty($template)) {
			return error(-4, '邮箱发送失败');
		}
		
		// 获取发送的验证码
		$ds['code'] = substr('00000'.rand(0, 999999), -6); //substr(uniqid(rand()), -6);
		$ds['send_time'] = fmtNowDateTime();
		$ds['use'] = $use;
		$ds['tel'] = $email;
		$ds['interval'] = 600; //$interval;
		
		$msg = str_replace('#code', $ds['code'], $template['content']); 
		// 发送验证码到手机
		MsgHelp::sendSimpleEmail($email, '领袖户外邮箱验证', $msg);
		
		// 记录验证码
		$result = $codeObj->create($ds, $codeId);
		if (error_ok($result) === false) {
			return $result;
		}		
		$ds['id'] = $codeId;
		
		// 发送验证码
		
		return error(0, '验证码发送成功');
	}
	
	// 检查邮件验证码
	public static function checkEmail($use, $email, $code) {	
		if (empty($email)) {
			return error(-1, '请检查是否填写邮件，错误代码:001');
		}
		
//		if (check_email($email) === false) {
//			return error(-2, '邮件错误，请查证后再次发送，错误代码:002');
//		}
		
		if (empty($code)) {
			return error(-3, '验证不能为空，请重新输入，错误代码:003');
		}
		
		// 检查验证码是否已经发送
		$codeObj = ModelBase::getInstance('sms_verify');
		
		$conds = appendLogicExp('tel', '=', $email, 'AND');
		$conds = appendLogicExp('use', '=', $use, 'AND', $conds);
		$conds = appendLogicExp('code', '=', $code, 'AND', $conds);
		$code = $codeObj->getOne($conds);
		if (!empty($code)) {
			$nt = strtotime(fmtNowDateTime());
			$st = strtotime($code['send_time']);
			// 验证码未失效，不在发送
			if (intval($nt-$st) > intval($code['interval'])) {
				return error(-4, '验证码失效，错误代码:004');
			}
			
			$codeObj->modify(array('interval'=>0), $conds);
			return error(0, '验证通过');
		} else {
			return error(-5, '验证码错误，错误代码:005');
		}
	}
	
	// 获取设置
	public static function getSet($conds, $start=0, $page=0, &$total='', $sort=array('group'=>'asc', 'sort'=>'asc', 'key'=>'asc'), &$out) {
		$setObj = ModelBase::getInstance('set');		
		$sets = $setObj->getAll($conds, $start, $page, $total, $sort);
		$out['sql'] = $setObj->getLastSql();
		$out['ds'] = $sets;
		foreach ($sets as $sk=>$sv) {
			if (strpos($sv['key'],'zhuanti') !== FALSE || 
			strpos($sv['key'],'line_tab') !== FALSE ||
			strpos($sv['key'],'article') !== FALSE ||
			strpos($sv['key'],'activity') !== FALSE ||
			strpos($sv['key'],'video') !== FALSE ||
			strpos($sv['key'],'leader') !== FALSE) {
				$set[$sv['key']] = my_json_decode($sv['value'],true);
			} else if (strpos($sv['key'],'_line_') !== FALSE && strpos($sv['key'],'_line_image_') == FALSE) {	
				$val = my_json_decode($sv['value'],true);
//				$find = array('min_batch'=>true);
				$line = BackLineHelp::getLine(appendLogicExp('id', '=', $val['id']), false);
				if (!empty($line)) {
					$set[$sv['key']] = $line;	
				} else {		
					$set[$sv['key']] = $val;
				}
			} else {
				$set[$sv['key']] = $sv['value'];
			}
			$set['id_'.$sv['key']] = $sv['id'];
			$set['sort_'.$sv['key']] = $sv['sort'];
		}
		return $set;
	}
	
	// 根据IP获取当前站点
	public static function getStationByIP($ipstr='', $force=false, $forbidden=true) {
		session_start();
		$station = session('station');
		if (empty($force) && !empty($station)) {
			return $station;
		}
		
		if (empty($ipstr)) {
			$ipstr = get_user_ip();
		}	
		$ipData = get_ip_location($ipstr);		
		$stationObj = ModelBase::getInstance('station_info');
		if (!empty($forbidden)) {
			$conds = appendLogicExp('forbidden', '=', '0', 'AND', $conds);	
		}
		$stationList = $stationObj->getAll($conds);
		
		// 先找出市级代理点
		foreach ($stationList as $sk=>$sv) {			
			if (stripos($ipData['city'], $sv['name']) !== FALSE) {
				$existCityStation = true;
				$station = $sv;
			}
			// 默认主站
			if (empty($station) && $sv['key'] === 'main') {
				$station = $sv;
			}
		}
		
		// 再找出省级代理点
		if (empty($existCityStation)) {
			if ($ipData['province'] === '浙江省' || $ipData['province'] === '江苏省' || $ipData['province'] === '上海市') {
				$station = BackAccountHelp::StationTypeKey2Value('hangzhou', true);
			} else {
				foreach ($stationList as $sk=>$sv) {		
					if (stripos($ipData['province'],$sv['name']) !== FALSE) {
						$station = $sv;
						break;
					}	
				}
			}	
		}		
		session('station', $station);
		return $station;
	}
	
	// 记录配置更新时间点
	public static function saveConfigUpdateTime($type, $del=false, $stationId=1) {
		$setObj = ModelBase::getInstance('set');
		$conds = appendLogicExp('type', '=', $type);
		$conds = appendLogicExp('station_id', '=', $stationId, 'AND', $conds);
	 	$conds = appendLogicExp('key', '=', 'config_update_time', 'AND', $conds);
		if ($del === true) {
			return $setObj->remove($conds);
		} else {
			$set = $setObj->getOne($conds);
			if (empty($set)) {
				$ds = array('type'=>$type, 'station_id'=>$stationId, 'key'=>'config_update_time', 'value'=>time(), 'sort'=>0);
				return $setObj->create($ds, $setId);
			} else {
				return $setObj->modify(array('value'=>time()), $conds);
			}
		}
	}
	
	// 获取配置更新时间点
	public static function checkConfigOverdue($type, $lastTime, $stationId=1, &$out) {
		$setObj = ModelBase::getInstance('set');
		$conds = appendLogicExp('station_id', '=', $stationId);
		$conds = appendLogicExp('type', '=', $type, 'AND', $conds);
		$conds = appendLogicExp('key', '=', 'config_update_time', 'AND', $conds);
		$set = $setObj->getOne($conds);
		$out['set'] = $set;
		if (!empty($set)) {
			return intval($lastTime) == intval($set['value']) ? false : true;
		} else {
			MyHelp::saveConfigUpdateTime($type, false, $stationId);
		}
		return true;
	}
	
	// 获取配置更新时间点
	public static function getConfigUpdateTime($type, $stationId=1) {
		$setObj = ModelBase::getInstance('set');
		$conds = appendLogicExp('station_id', '=', $stationId);
		$conds = appendLogicExp('type', '=', $type, 'AND', $conds);
		$conds = appendLogicExp('key', '=', 'config_update_time', 'AND', $conds);
		$set = $setObj->getOne($conds);
		if (!empty($set)) {
			return intval($set['value']);
		}
		return 0;
	}
	
	// 获取站点首页配置
	public static function getStationHomeSet($stationId, $force=false) {
		$cacheKey = 'station_home_set'.$stationId;
		$sets = S($cacheKey);
		$cacheUpdate = MyHelp::checkConfigOverdue('pc_home_index', $sets['config_update_time'], $stationId);
		if (empty($sets) || $force === true || $cacheUpdate === true) {
			$conds = appendLogicExp('station_id', '=', $stationId);
			$conds = appendLogicExp('type', '=', 'pc_home_index', 'AND', $conds);
			$stationSets = MyHelp::getSet($conds);
			if ($stationId != 1) {
				$sets = MyHelp::getStationHomeSet(1);
				foreach($stationSets as $sk => $sv){
					$sets[$sk] = $sv;
				}				
			} else {
				$sets = $stationSets;
			}
			S($cacheKey, $sets, 0);
		}
		return $sets;
	}	
	
	// 站点切换
	public static function changeStation($stationId, $force=false, &$out) {
		session_start();
		session('station_id', $stationId);
		// 配置切换	
		$pcHomeIndexStationId = 'pc_home_index_set_'.$stationId;
		$set = S($pcHomeIndexStationId);
		$out['cache_name'] = $pcHomeIndexStationId;
		$out['cache_time'] = $set['config_update_time'];
		$out['refresh'] = 'false';
		// 判断是否更新时间点
		$checked = MyHelp::checkConfigOverdue('pc_home_index', $set['config_update_time'], $stationId);
		if (empty($set) || $checked === true) {		
			$conds = appendLogicExp('type', '=', 'pc_home_index');
			$mainStation = BackAccountHelp::StationTypeKey2Value('main', true);
			if (is_error($mainStation) === false) {
				$conds = appendLogicExp('station_id', '=', $mainStation['id'], 'AND', $conds);
			}
			// 获取主站的配置
			$set = MyHelp::getSet($conds);
			// 当前切换站点不是主站，获取其他站点配置	
			if ($stationId != $mainStation['id']) {
				$conds = appendLogicExp('type', '=', 'pc_home_index');
				$conds = appendLogicExp('station_id', '=', $stationId, 'AND', $conds);
				$stationSet = MyHelp::getSet($conds);
				// 其他站点有配置的覆盖主站配置
				foreach ($stationSet as $sk=>$sv) {
					$set[$sk] = $sv;
				}
			}
			$out['refresh'] = 'true';
			S($pcHomeIndexStationId, $set, 0);
		}
		session('pc_home_index_set', $set);
	}
	
	// 添加监督内容
	public static function appendSupervise($type, $superviseId, $bindData, $admin, $content, $createTime) {
		$superviseObj = ModelBase::getInstance('supervise');
		
		if (empty($superviseId) || empty($content)) {
			return error(-1, '监督对象编号或者监督内容不能为空');
		}
		
		$superviseType = MyHelp::TypeDataKey2Value($type, true);
		if (is_error($superviseType) === true) {
			return $superviseType;
		}
		unset($superviseType['sort']);
		unset($superviseType['can_delete']);
		$ds['supervise_type'] = my_json_encode($superviseType);
		$ds['supervise_id'] = $superviseId;
		$ds['bind_data'] = $bindData;
		if (empty($admin)) {
			$acct = MyHelp::getLoginAccount(false);
			if (is_error($acct)) {
				return $acct;
			}
			$acctData = array('id'=>$acct['id'], 'account'=>$acct['account'], 'show_name'=>$acct['show_name']);
			$ds['admin'] = my_json_encode($acctData);
		} else {
			if (is_string($admin) === true) {
				$ds['admin'] = $admin;	
			} else if (is_array($admin) === true) {
				$ds['admin'] = my_json_encode($admin);
			}
		}
		$ds['content'] = $content;
		if (empty($createTime)) {
			$ds['create_time'] = fmtNowDateTime();
		} else {
			$ds['create_time'] = $createTime;
		}
		
		
		$result = $superviseObj->create($ds, $id);
		if (error_ok($result) === true) {
			return $id;
		}
		return $result;
	}
	
	// 获取监督内容
	public static function getSuperviseList($conds, $pageIndex, $pageSize, $sort) {
		$superviseObj = ModelBase::getInstance('supervise');
		$startIndex = $pageIndex * $pageSize;
		$supervises = $superviseObj->getAll($conds, $startIndex, $pageIndex, $total, $sort);
		$result['sql'] = $superviseObj->getLastSql();
		
		foreach($supervises as $sk=>$sv) {
			$sv['supervise_type_data'] = json_decode($sv['supervise_type'],true);
			$sv['admin_data'] = json_decode($sv['admin'],true);
			$supervises[$sk] = $sv;
		}
		
		$pageCount = intval($total / $pageSize);
		if (intval($total % $pageSize) > 0) {
			$pageCount += 1;
		}
		
		$result['page_count'] = $pageCount;
		$result['page_size']  = $pageSize;
		$result['ds'] = $supervises;		
		return $result;
	}
	
	/**
     *  POST请求URL获取返回值
     *
     * @access    public static
     * 
	 * @param     string  $url        请求URL
	 * @param     string  $post_str   POST数据
	 * @param     string  $referer    设置Referer
	 * 
     * @return    $result
    */
    public static function curl_post($url, $post_str, $referer = '') {
		$cookie_file = "./";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url); //要访问的地址 即要登录的地址页面	
		//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
		//curl_setopt($curl, CURLOPT_HTTPHEADER, $header_arr );
		curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_str); // Post提交的数据包
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file); // 存放Cookie信息的文件名称
		curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file); // 读取上面所储存的Cookie信息
		curl_setopt($curl, CURLOPT_REFERER, $referer); //设置Referer
		//	curl_setopt ( $curl, CURLOPT_USERAGENT, $_SERVER ['HTTP_USER_AGENT'] ); // 模拟用户使用的浏览器
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0(iphone;CPU iphone OS 5_1_1 like Mac OS X) AppleWebKit/534.46(KHTML,like Geocko)Mobile/9B206 MicroMessenger/6.0"); // 模拟用户使用的浏览器
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
		curl_setopt($curl, CURLOPT_HEADER, false); //获取header信息
		$result = curl_exec($curl);
		
		return $result;
	}
	
}
?>