<?php

namespace Core\Model;
use Think\Model;
use Think\Log;

class ModelBase extends Model {
	
	// 自定义表名
	const DF_TABLE_NAME = 'table_name';
	// 表名
	const DF_TABLE_REAL_NAME = 'table_real_name';
	// 表前缀
	const DF_TABLE_PREFIX = 'table_prefix';
	// 列名
	const DF_COL_NAMES = 'col_name';
	// 列描述
	const DF_COL_DESCS = 'col_desc';
	// 检查创建数据定义列是否已存在
	const DF_CHECK_COL_CREATE = 'check_col_create';
	// 检查修改数据定义列是否已存在
	const DF_CHECK_COL_MODIFY = 'check_col_modify';
	
	// 用户自定义变量
	protected $myUserDefine = array(
		ModelBase::DF_TABLE_NAME 		=> '',
		ModelBase::DF_COL_NAMES  		=> array(),
		ModelBase::DF_COL_DESCS  		=> array(),
		ModelBase::DF_CHECK_COL_CREATE	=> array(),
		ModelBase::DF_CHECK_COL_MODIFY	=> array());
	
	// 创建模型
	public static function getInstance($table_name, $prefix='') {
		if (empty($prefix)) {
			$prefix = C('DB_PREFIX');
		}
		
		$config[ModelBase::DF_TABLE_PREFIX] = $prefix;
		$config[ModelBase::DF_TABLE_REAL_NAME] = $table_name;
		$config[ModelBase::DF_TABLE_NAME] = $prefix.$table_name;
		$dt = D($config[ModelBase::DF_TABLE_NAME]);
		$cols = $dt->query('SHOW FULL COLUMNS FROM '.$config[ModelBase::DF_TABLE_NAME]);
		$config[ModelBase::DF_COL_NAMES] = array();
		foreach($cols as $k=>$v) {		
			array_push($config[ModelBase::DF_COL_NAMES], $v['Field']);
			$config[ModelBase::DF_COL_DESCS][$v['Field']] = $v['Comment'];
		}
		$t = new ModelBase();
		$t->intializeUserDefault($config);
		return $t;
	}
	
	// 是否存在列
	public function isExistColumn($colName) {
		$colNames = $this->getUserDefine(ModelBase::DF_COL_NAMES);
		foreach ($colNames as $name) {
			if ($name == $colName) {
				return true;
			}
		}
		return false;
	}
	
	// 初始化自定义变量
	public function intializeUserDefault($params) {
		$this->myUserDefine = $params;
	}	
	
	// 获取自定义变量
	public function getUserDefine($key) {
		if (!empty($this->myUserDefine[$key])) {
			return $this->myUserDefine[$key];	
		}
		return '';
	}
	
	// 设置自定义变量
	public function setUserDefine($name, $value) {
		$this->myUserDefine[$name] = $value;
	}
	
	// 记录是否写入日志
	private function IsWriteLog() {
    	$tableName = $this->getUserDefine(ModelBase::DF_TABLE_NAME);
    	if ($tableName === 'kl_op_log') {
			return false;
		}
    	
//    	$logTables = C('INIT_DATA.LOG_OP_TABLES');
		$logTables = C('OP_LOG_TABLE');
//    	foreach ($logTables['data'] as $k=>$v) {
    	foreach ($logTables as $k=>$v) {	
			if ($tableName === $v['table_name']) {
				return $k;
			}
		}
		return false;
	}
	
	// 写入日志
	public function writeLog($opType, $logData, $logCd) {
		$tableIndex = $this->IsWriteLog();
    	if ($tableIndex === false) {
			return false;
		}
		
//    	$logTables = C('INIT_DATA.LOG_OP_TABLES');
//    	$table = $logTables[$tableIndex]['data'];
		$logTables = C('OP_LOG_TABLE');
    	$table = $logTables[$tableIndex];
		$data['admin_id'] = 0;
		$account = MyHelp::getLoginAccount();
		if (is_error($account) === false) {
			$data['admin_id'] = $account['id'];
			$data['account_type_id'] = $account['account_type']['id'];
			$cols = array('id','account','nickname','tel','username','name','phone','show_name','account_type');
			foreach ($cols as $ck=>$cv){
				if (!empty($account[$cv])) {
					$acct[$cv] = $account[$cv];
				}
			}
			if (!empty($acct)) {
				$data['account'] = my_json_encode($acct);
			}
		}
		
		$opTypeObj = ModelBase::getInstance('op_type');
		$opTypeData = $opTypeObj->getOne(appendLogicExp('type_key', '=', $opType));
		if (!empty($opTypeData)) {
			$data['op_type_id'] = $opTypeData['id'];	
		}
    	$data['table_name'] = $table['table_name'].'['.$table['table_desc'].']';
    	
    	$descs = $this->getUserDefine(ModelBase::DF_COL_DESCS); 
		if ($opType == 'add') { // 添加
			$data['content'] = '添加数据：';
			foreach ($logData as $k=>$v) {
				$data['content'] .= $k.'['.$descs[$k].']='.$v.'，';
			}
		} else if ($opType == 'update') {	// 修改
			$data['content'] = '条件满足：';
			$first = true;
			foreach ($logCd as $k=>$v) {
				if (isLogicExp($v)) {
					if ($first === false) {
						$data['content'] .= ' '.$v['lop'].' '.$v['var'].'['.$descs[$v['var']].']'.$v['op'].$v['val'];	
					} else {
						$data['content'] .= $v['var'].'['.$descs[$v['var']].']'.$v['op'].$v['val'];	
					}
					$first = false;
				}
			}			
			$data['content'] .= '，更新数据：';
			foreach ($logData as $k=>$v) {
				$data['content'] .= $k.'['.$descs[$k].']='.$v.'，';
			}	
			// 点击量不进行添加
			if (stripos($data['content'], '更新数据：click_count[点击量]=+1') !== false) {
				return false;
			}
		} else if ($opType == 'delete') {	// 删除
			$data['content'] = '条件满足：';
			$first = true;
			foreach ($logCd as $k=>$v) {
				if (isLogicExp($v)) {
					if ($first === false) {
						$data['content'] .= ' '.$v['lop'].' '.$v['var'].'['.$descs[$v['var']].']'.$v['op'].$v['val'];	
					} else {
						$data['content'] .= $v['var'].'['.$descs[$v['var']].']'.$v['op'].$v['val'];	
					}
				}
			}		
			$data['content'] .= '，删除数据';
		} else {
    		echo('日志记录错误，错误的操作类型');
			return false;
		}
		
		$data['create_time'] = fmtNowDateTime();
		$logObj = ModelBase::getInstance('op_log');
		
		$rs = $logObj->create($data);
		if (error_ok($rs) == false) {
			Log::write('ModelBase::writeLog ['.fmtNowDateTime().'] errno:'. $rs['errno'] . ', errmsg:' . $rs['msg'], Log::ERR);
		}
	} 
	
    // 创建数据
    public function create($entriy, &$instID=0, $needCheck = true) {
    	$tableName = $this->getUserDefine(ModelBase::DF_TABLE_NAME);
    	$colNames = $this->getUserDefine(ModelBase::DF_COL_NAMES);
    	$checkCols = $this->getUserDefine(ModelBase::DF_CHECK_COL_CREATE);    	
		$rec = coll_elements_giveup($colNames, $entriy);
		
		// 唯一检测条件组织	
		if ($needCheck === true) {
			$check = false;		
			$condition = '1=1';		
			foreach ($checkCols as $col) {
				if (!empty($rec[$col])) {
					$condition .= ' AND `'.$col.'`=:'.$col;
					$params[$col] = $rec[$col];
					$check = true;
				}
			}
			
			// 检查要创建值的唯一性
			if ($check) {
				$rs = $this->table($tableName)->where($condition)->bind($params)->find();
				if (!empty($rs)) {
					return error(-1, '数据已经存在');
				}
			}
		}			
		
		// 创建数据
		$rs = $this->table($tableName)->data($rec)->add();
		if ($rs === false) {
			return error(-1, '创建数据失败，请稍后重试,ERR:'.$this->getError().',DBERR:'.$this->getDbError());
		} 
		// 获取插入ID
		$instID = $this->getLastInsID();
		$rec['id'] = $instID;
		// 写入插入日志
		$this->writeLog('add', $rec, array());
		return error(0, '创建数据成功');
	}	
	
	private function getCondition($cdExp, $removeHeadLogic=true, $paramIndex=0) {
		if (count($cdExp) > 0) {
			$aa = array();
			foreach($cdExp as $k=>$v) {
				if (isLogicExp($v)) {
					array_push($aa, $v);
				} 
			}
			$cdExp = $aa;
		} else {
			if (!isLogicExp($cdExp)) {
				return array('cd'=>'', 'param'=>array(), 'paramIndex'=>$paramIndex);
			}
		}
		    
		// 基本条件
		$condition = "";
		$params = array();
		foreach($cdExp as $i=>$exp){
//			if ($this->isExistColumn($exp['var'])) {
				// 嵌套条件
				if (is_array($exp['val'])) {
					$innerCDS = $this->getCondition($exp['val'], $removeHeadLogic, $paramIndex);
					if (!empty($innerCDS['cd'])){
						if ($condition == "") {
							$condition .= ' ('.$innerCDS['cd'].') ';	
						} else {
							$condition .= $exp['lop'].' ('.$innerCDS['cd'].') ';	
						}
						$paramIndex = $innerCDS['paramIndex'];
						
						if (empty($params)) {
							$params = $innerCDS['params'];
						} else {
							array_merge($params, $innerCDS['params']);
						}
					}
				} else {
					$param = 'param'.$paramIndex;
					if ($removeHeadLogic == true) {
						if ($condition == "") {
							if (stripos($exp['var'], '`') === false) {
								$condition .= ' `'.$exp['var'].'` '.$exp['op'].' :'.$param;	
							} else {
								$condition .= ' '.$exp['var'].' '.$exp['op'].' :'.$param;	
							}
						} else {
							if (stripos($exp['var'], '`') === false) {
		            			$condition .= ' '.$exp['lop'].' `'.$exp['var'].'` '.$exp['op'].' :'.$param;
							} else {
		            			$condition .= ' '.$exp['lop'].' '.$exp['var'].' '.$exp['op'].' :'.$param;
							}
						}
					} else {
						if (stripos($exp['var'], '`') === false) {
		            		$condition .= ' '.$exp['lop'].' `'.$exp['var'].'` '.$exp['op'].' :'.$param;
						} else {
		            		$condition .= ' '.$exp['lop'].' '.$exp['var'].' '.$exp['op'].' :'.$param;
						}
					}
					$params[$param] = $exp['val']; 
					$paramIndex++;
				}
//			}
		}
		$cds['cd'] = $condition;
		$cds['params'] = $params;
		$cds['paramIndex'] = $paramIndex;		
		return $cds;
	}
	
	private function getConditionString($cdExp, $removeHeadLogic=true) {
		if (count($cdExp) > 0) {
			$aa = array();
			foreach($cdExp as $k=>$v) {
				if (isLogicExp($v)) {
					array_push($aa, $v);
				} 
			}
			$cdExp = $aa;
		} else {
			if (!isLogicExp($cdExp)) {
				return '';
			}
		}
		    
		// 基本条件
		$condition = "";
		$params = array();
		foreach($cdExp as $i=>$exp){
			// 嵌套条件
			if (is_array($exp['val'])) {
				$innerCDS = $this->getConditionString($exp['val'], $removeHeadLogic);
				if (!empty($innerCDS)){
					if ($condition == "") {
						$condition .= ' ('.$innerCDS.') ';	
					} else {
						$condition .= ' '.$exp['lop'].' ('.$innerCDS.') ';	
					}
				}
			} else {
				$op = strtoupper($exp['op']);
				if ($op != 'IN' && $op != 'NOT IN' && $op != 'IS NULL' && $op != 'IS NOT NULL') {
					$exp['val'] = '"'.$exp['val'].'"';
				}
				if ($removeHeadLogic == true) {
					if ($condition == "") {
						if (stripos($exp['var'], '`') === false) {
							$condition .= ' `'.$exp['var'].'` '.$exp['op'].' '.$exp['val'];	
						} else {
							$condition .= ' '.$exp['var'].' '.$exp['op'].' '.$exp['val'];	
						}
					} else {
						if (stripos($exp['var'], '`') === false) {
	            			$condition .= ' '.$exp['lop'].' `'.$exp['var'].'` '.$exp['op'].' '.$exp['val'];
						} else {
	            			$condition .= ' '.$exp['lop'].' '.$exp['var'].' '.$exp['op'].' '.$exp['val'];
						}
					}
				} else {
					if (stripos($exp['var'], '`') === false) {
	            		$condition .= ' '.$exp['lop'].' `'.$exp['var'].'` '.$exp['op'].' '.$exp['val'];
					} else {
	            		$condition .= ' '.$exp['lop'].' '.$exp['var'].' '.$exp['op'].' '.$exp['val'];
					}
				}
			}
		}	
		return $condition;
	}
	
	// 字段自动加减
	public function fieldAddAndSub($cdExp, $field, $val, $bAdd=true) {
    	$tableName = $this->getUserDefine(ModelBase::DF_TABLE_NAME);
    	$colNames = $this->getUserDefine(ModelBase::DF_COL_NAMES);
    			
		// 至少存在一个不同数据，才可以更新
    	$cds = $this->getConditionString($cdExp);
		
		// 检查空条件修改
		if (empty($cds)) {
			return error(-1, '1.更新数据的条件非法，请检查后重试');
		}    	
		
		if (is_numeric($val) == false) {
			return error(-2, '2.加减的值类型必须为数值');
		}
				
		if ($bAdd===true) {
    		$rs = $this->table($tableName)->where($cds)->setInc($field, $val);	
		} else {
			$rs = $this->table($tableName)->where($cds)->setDec($field, $val);
		}
		if ($rs === 0) {
			return error(-4, '4.数据更新失败，更新数据可能与源数据相同');		
		} else if ($rs === false){			
			return error(-5, '5.数据更新失败，请稍后重试,'.'ERROR:'.$this->getError().',DBERR:'.$this->getDbError());
		}	
		$this->writeLog('update', array($field=>$bAdd===true?'+1':'-1'), $cdExp);
		return error(0, '数据更新成功');
	}
	
	// 修改数据
	public function modify($entriy, $cdExp=array()) {		
    	$tableName = $this->getUserDefine(ModelBase::DF_TABLE_NAME);
    	$colNames = $this->getUserDefine(ModelBase::DF_COL_NAMES);
    	
		// 检查空值修改
		if (count($entriy) == 0) {
			return error(-1, '1.更新数据非法，请检查后重试');
		}	
		
		// 合法性检查
		$rec = coll_elements_giveup($colNames, $entriy);
		
		// 至少存在一个不同数据，才可以更新
    	$cds = $this->getConditionString($cdExp);
		
		// 检查空条件修改
		if (empty($cds)) {
			return error(-2, '2.更新数据的条件非法，请检查后重试');
		}
		
//		$findResult = $this->table($tableName)->where($cds)->find();
//		if (!empty($findResult)) {
//			$same = true;
//			foreach ($rec as $k=>$v) {
//				if ($findResult['key'] !== $v) {
//					$same = false;
//				}
//			}
//			if ($same === true) {
//				return error(-3, '3.数据更新失败，新的记录并未发生改动');	
//			} 
//		} 			
		
		// 开始更新数据		
		$rs = $this->table($tableName)->data($rec)->where($cds)->save();
		if ($rs === 0) {
			return error(-4, '4.数据更新失败，更新数据可能与源数据相同');		
		} else if ($rs === false){			
			return error(-5, '5.数据更新失败，请稍后重试,'.'ERROR:'.$this->getError().',DBERR:'.$this->getDbError());
		}	
		$this->writeLog('update', $rec, $cdExp);
		return error(0, '数据更新成功');
	}
	
	// 删除数据
	public function remove($cdExp) {
    	$tableName = $this->getUserDefine(ModelBase::DF_TABLE_NAME);    	
		$cdstr = $this->getConditionString($cdExp);		
		
		$rs = $this->table($tableName)->where($cdstr)->delete();
		if ($rs !== false) {
			$this->writeLog('delete', array(), $cdExp);	
			return error(0, '删除数据成功'.$rs);
		} else {
			return error(-1, '删除数据失败,ERROR:'.$this->getError().',DBERR:'.$this->getDbError());
		}
	}
		
	// 获取一条数据
	public function getOne($cdExp) {
    	$tableName = $this->getUserDefine(ModelBase::DF_TABLE_NAME);
    	$colNames = $this->getUserDefine(ModelBase::DF_COL_NAMES);    	
    	$cds = $this->getCondition($cdExp);      
    	
        $ds = $this->table($tableName)->where($cds['cd'])->bind($cds['params'])->find();
        return $ds;
	}
	
	private function constructionQuery($params) {
		if (empty($params['table'])) {
			$tableName = $this->getUserDefine(ModelBase::DF_TABLE_NAME);                
	        $query = $this->table($tableName); 	
		} else {
			$query = $this->table($params['table']);	
		}
		
        // 查询列
        if (!empty($params['col']) && is_array($params['col'])) {
			$query->field($params['col']);
		}       
		
		// 连接表
		if (!empty($params['join']) && is_array($params['join'])) {
			$query->join($params['join']);
		}
		 	
		// 查询条件
		if (!empty($params['conds'])) {
	    	$cds = $this->getConditionString($params['conds']); 
	        if ($cds !== '') {        	
				$query->where($cds);			
			}
		}
		
		// 排序
		if (!empty($params['sort']) && is_array($params['sort'])) {
			$query->order($params['sort']);
		}
		
		// 分组
		if (!empty($params['group'])) {
			$query->group($params['group']);
		}
		
		// 分页当前页码
		if (!empty($params['page'])) {
			if (is_array($params['page'])) {
				if (count($params['page']) == 2) {
					$query->page($params['page'][0], $params['page'][1]);
				} else if (count($params['page']) == 1) {
					$query->page($params['page'][0]);
				}
			} else {
				$query->page($params['page']);	
			}
		}
		
		// 分页页面显示数量
		if (!empty($params['limit'])) {
			if (is_array($params['limit'])) {
				if (count($params['limit']) == 2) {
					$query->limit($params['limit'][0], $params['limit'][1]);
				} else if (count($params['limit']) == 1) {
					$query->limit($params['limit'][0]);
				}
			} else {
				$query->limit($params['limit']);	
			}
		}
		
		return $query;
	}
	
	/**
	* 原始查询
	* @param 查询参数 $params = {
	* 	table: 要查询的表，字符串类型，例如：'`table` as `t`'，默认为实例对象的表名，	
	* 	col: 查询集合中要显示的列，数组类型，例如：array('`col1`'=>'别名', 'SUM(`col2`)'=>'别名', '`col3`')
	* 	join: 连接表，数组类型，例如：array('连接方式 `连接表名` AS `连接表别名` ON `主表名/主表别名`.`主表参照列` 算数操作符 `连接表名/连接表别名`.`连接表参照列`',....)
	* 	conds: 查询条件，数组类型， 例如：array(array(
	*										@param string $var 表达式变量
	*										@param string $op 表达式操作符，为+、-、*、/、%、=、>、<、IN、LIKE等一系列的逻辑符号
	*										@param string $val 表达式的值
	*										@param string $lop 表达式操作符，为AND、OR等一系列的逻辑符号))
	* 	sort: 排序方式，数组类型，例如：array=('`col1`'=>'desc')
	* 	group: 分组，字符串类型，例如：'`col1`,`col2`'
	* 	page: 查询的页码，可直接表示分页，如: (页码，页显示数量)，也可与limit组合，如: page(页码)->limit(页显示数量)
	* 	limit: 查询页显示的数量，可直接表示分页，如:(起始索引，页显示数量)，也可与page组合，如: page(页码)->limit(页显示数量)
	* }
	* 
	* @return
	*/
	public function queryData($params, &$total, &$out) {		
		$query = $this->constructionQuery($params);
		$total = $query->count();
		
		$query = $this->constructionQuery($params);
		$ds = $query->select();
		$out['sql'] = $query->getLastSql();
		return $ds;
	}
	
	// 获取别名列表
	private function getColNickName($tabname, $perfix, $cols, $nickname='', $exp=array()) {
		$tabObj = ModelBase::getInstance($tabname, $perfix);
    	$tableName = $tabObj->getUserDefine(ModelBase::DF_TABLE_NAME);
		$colNames = $tabObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$cols = coll_elements_giveup($colNames, $cols);
		
		// 表别名定义
		$thisTableName = $this->getUserDefine(ModelBase::DF_TABLE_NAME);		
		if ($thisTableName === $tableName) {
			$nickname = 'my';
		} else {
			if (empty($nickname)) {
				$nickname = $tableName;
			}
		}		
		
		foreach ($cols as $ck=>$cv) {
			$exp["`".$tableName."`.`".$cv."`"] = "`".$nickname.".".$cv."`";
		}
		return $exp;
	}
	
	// 获取JSON内容
	private function getJoin($joins, &$out) {		
		$data = array('tab'=>array(),'join'=>array(), 'cols'=>array());
		if (count($joins) > 0) {
			$aa = array();
			foreach($joins as $k=>$v) {
				if (isJoinExp($v)) {
					array_push($aa, $v);
				} 
			}
			$joins = $aa;
		} else {
			if (!isJoinExp($joins)) {
				return $data;
			}
		}
		    		
    	$tabs = array();
		if (!empty($joins)) {	
    		$tableName = $this->getUserDefine(ModelBase::DF_TABLE_NAME);
    		$colNames = $this->getUserDefine(ModelBase::DF_COL_NAMES); 
    		   
			foreach($joins as $i=>$join){
				if (array_search($join['mycol'], $colNames) === false){
					continue;
				}
								
				$joinTable = ModelBase::getInstance($join['tab'], $join['pfx']);
				$joinTableName = $joinTable->getUserDefine(ModelBase::DF_TABLE_NAME);
				$joinColNames = $joinTable->getUserDefine(ModelBase::DF_COL_NAMES);
				
				if (array_search($join['cpcol'], $joinColNames) === false) {
					continue;
				}
								
				$tab = array('tab'=>$joinTableName, 'cols'=>array(), 'join'=>'');
				if (array_key_exists($joinTableName, $tabs)) {
					$tab = $tabs[$joinTableName];
				}
				
				$lopJoin = ' INNER JOIN';
				if (!empty($join['lop_join'])) {
					$opJoin = strtolower($join['lop']);
					if ($opJoin=='left') {
						$lopJoin = ' LEFT JOIN';
					} else if ($opJoin=='right') {
						$lopJoin = ' RIGHT JOIN';
					} else if ($opJoin=='full') {
						$lopJoin = ' FULL JOIN';
					}
				}
				
				// 连接列
				if (empty($tab['cols'])) {
					$tab['cols'] = $this->getColNickName($join['tab'], $join['pfx'], $joinColNames, $join['tab_nickname']);
				}
				
				// 连接条件字符串
				if ($tab['join'] === '') {
					$tab['join'] = $lopJoin.' `'.$joinTableName.'` ON `'.$tableName.'`.`'.$join['mycol'].'` '.$join['op'].' `'.$joinTableName.'`.`'.$join['cpcol'].'`';
				} else {
					$tab['join'] .= ' '.$join['lop_cd'].' `'.$tableName.'`.`'.$join['mycol'].'` '.$join['op'].' `'.$joinTableName.'`.`'.$join['cpcol'].'`';
				}
				$tabs[$joinTableName] = $tab;
			}
		}	
		
		if (!empty($tabs)) {
			foreach($tabs as $tk=>$tv) {
				array_push($data['tab'], $tv['tab']);
				array_push($data['join'], $tv['join']);
				array_push($data['cols'], $tv['cols']);
			}   
		}		
		return $data;
	}
	
	// 获取join的条件
	private function getJoinCondition($cdExp, $removeHeadLogic=true) {
		if (count($cdExp) > 0) {
			$aa = array();
			foreach($cdExp as $k=>$v) {
				if (isJoinLogicExp($v)) {
					array_push($aa, $v);
				} 
			}
			$cdExp = $aa;
		} else {
			if (!isJoinLogicExp($cdExp)) {
				return '';
			}
		}
		    
		// 基本条件
		$condition = "";
		$params = array();
		foreach($cdExp as $i=>$exp){
			// 嵌套条件
			if (is_array($exp['val'])) {
				$innerCDS = $this->getJoinCondition($exp['val'], $removeHeadLogic);
				if (!empty($innerCDS)){
					if ($condition == "") {
						$condition .= ' ('.$innerCDS.') ';	
					} else {
						$condition .= ' '.$exp['lop'].' ('.$innerCDS.') ';	
					}
				}
			} else {
				
				if ($exp['pfx']=='') {
					$prefix = C('DB_PREFIX');
				}
		    	$tabname = $exp['pfx'].$exp['tab'];
				
				if ($removeHeadLogic == true) {
					if ($condition == "") {
						if (stripos($exp['var'], '`') === false) {
							$condition .= ' `'.$tabname.'`.`'.$exp['var'].'` '.$exp['op'].' '.$exp['val'];	
						} else {
							$condition .= ' '.$tabname.'.'.$exp['var'].' '.$exp['op'].' '.$exp['val'];	
						}
					} else {
						if (stripos($exp['var'], '`') === false) {
	            			$condition .= ' '.$exp['lop'].' `'.$tabname.'`.`'.$exp['var'].'` '.$exp['op'].' '.$exp['val'];
						} else {
	            			$condition .= ' '.$exp['lop'].' '.$tabname.'.'.$exp['var'].' '.$exp['op'].' '.$exp['val'];
						}
					}
				} else {
					if (stripos($exp['var'], '`') === false) {
	            		$condition .= ' '.$exp['lop'].' `'.$tabname.'`.`'.$exp['var'].'` '.$exp['op'].' '.$exp['val'];
					} else {
	            		$condition .= ' '.$exp['lop'].' '.$tabname.'.'.$exp['var'].' '.$exp['op'].' '.$exp['val'];
					}
				}
			}
		}	
		return $condition;
	}
	
	
	// 填充查询内容
	private function fillJoinCondition($cdExp=array(), $joins='', $cols=array(), $startIndex = 0, $pageSize = 0, $sortCol='', $desc=true, $group='') {
    	$tableName = $this->getUserDefine(ModelBase::DF_TABLE_NAME);                
        $query = $this->table($tableName); 
        // 查询列
    	if (empty($cols)) {
    		$colNames = $this->getUserDefine(ModelBase::DF_COL_NAMES);  
			$prefix = $this->getUserDefine(ModelBase::DF_TABLE_PREFIX);
			$tname = $this->getUserDefine(ModelBase::DF_TABLE_REAL_NAME); 
			$thisCols = $this->getColNickName($tname, $prefix, $colNames, 'my');
			$field = array_merge($thisCols, $joinData['cols']);
		} else {
			foreach ($cols as $ck=>$cv) {
				if (isJoinTableData($cv) !== false) {
					$field = $this->getColNickName($cv['tab'], $cv['pfx'], $cv['cols'], $cv['nickname'], $field);	
				}
			}
		}
        if (!empty($field)) {
			$query->field($field);
		}       
		
		// 连接表
		if (!empty($joins)) {
	    	$joinData = $this->getJoin($joins, $out);
	    	$joinstr = $joinData['join'];
			$query->join($joinstr);
		}
		 	
		// 查询条件
		if (!empty($cdExp)) {
	    	$cds = $this->getJoinCondition($cdExp); 
	        if ($cds !== '') {        	
				$query->where($cds);			
			}
		}
		
		// 排序
		if (!empty($sortCol)) {
			if (is_array($sortCol)) {
				$query->order($sortCol);
			} else {
	        	$strDesc = $desc == true ? 'DESC' : 'ASC';
				$query->order("`{$sortCol}` {$strDesc}");	
			}
		}
		
		// 分组
		if (!empty($group)) {
			$query->group($group);
		}
		
		// 分页
		if ($pageSize > 0) {
			$query->limit($startIndex, $pageSize);
		}
		return $query;
	}
	
	// 获取列表
	public function getAllByJoin($cdExp=array(), $joins=array(), $cols=array(), $startIndex = 0, $pageSize = 0, &$total = 0, $sortCol="", $desc=true, $group="", &$output="") {		
    	$query = $this->fillJoinCondition($cdExp, $joins, $cols, $startIndex, $pageSize, $sortCol, $desc, $group); 	
		$ds = $query->select();
		return $ds;		
	}
	
	// 填充查询内容
	private function fillCondition($field='', $cdExp=array(), $startIndex = 0, $pageSize = 0, $sortCol='', $desc=true, &$output) {
    	$tableName = $this->getUserDefine(ModelBase::DF_TABLE_NAME);                
        $query = $this->table($tableName); 
        if ($field !== '') {
			$query->field($field);
		}       
		
		$cds = $this->getConditionString($cdExp);
        if ($cds !== '') {        	
			$query->where($cds);			
		}
		if ($pageSize > 0) {
			$query->limit($startIndex, $pageSize);
		}
		if (!empty($sortCol)) {
			if (is_array($sortCol)) {
				$query->order($sortCol);
			} else {
	        	$strDesc = $desc == true ? 'DESC' : 'ASC';
				$query->order("`{$sortCol}` {$strDesc}");	
			}
		}
		return $query;
	}
	
	// 特殊查询
	public function getEspicalCdStr($field="", $cdExp=array(), $startIndex = 0, $pageSize = 0, &$total = 0, $sortCol='', $desc=true, &$output) {
    	$query = $this->fillCondition($field, $cdExp, $startIndex, 0, $sortCol, $desc, $opt);
		$total = $query->count();
//		$output['cds'] = $opt;
//		$output['sql'] = $this->getLastSql();
//		$output['db_error'] = $this->getDbError();
		
		$query = $this->fillCondition($field, $cdExp, $startIndex, $pageSize, $sortCol, $desc, $opt);
		$ds = $query->select();	
//		$output['cds1'] = $opt;
//		$output['sql1'] = $this->getLastSql();
//		$output['db_error1'] = $this->getDbError();
		return $ds;		
	}
	
	// 特殊条件查询
	public function getAllByCdStr($cdExp=array(), $startIndex = 0, $pageSize = 0, &$total = 0, $sortCol="", $desc=true, &$output) {		
    	$tableName = $this->getUserDefine(ModelBase::DF_TABLE_NAME);
    	$colNames = $this->getUserDefine(ModelBase::DF_COL_NAMES);
    	$cds = $this->getConditionString($cdExp);
		$output['cds'] = $cds;
        $strDesc = $desc == true ? 'DESC' : 'ASC';
		if ($cds !== '') {
			if($pageSize > 0) {
				$total = $this->table($tableName)->where($cds)->limit($startIndex,$pageSize)->count();
			    if ($sortCol != "") {
			    	$query = $this->table($tableName)->where($cds)->order("`{$sortCol}` {$strDesc}")->limit($startIndex,$pageSize);
				} else {
					$query = $this->table($tableName)->where($cds)->limit($startIndex,$pageSize);
				}
			} else {
				$total = $this->table($tableName)->where($cds)->count();
				if ($sortCol != "") {
					if (is_array($sortCol)) {
						$query = $this->table($tableName)->where($cds)->order($sortCol);
					} else {
						$query = $this->table($tableName)->where($cds)->order("`{$sortCol}` {$strDesc}");
					}
				} else {
					$query = $this->table($tableName)->where($cds);
				}
			}
		} else {
			if($pageSize > 0) {
				$total = $this->table($tableName)->limit($startIndex,$pageSize)->count();
			    if ($sortCol != "") {
					if (is_array($sortCol)) {
			    		$query = $this->table($tableName)->order($sortCol)->limit($startIndex,$pageSize);
					} else {
			    		$query = $this->table($tableName)->order("`{$sortCol}` {$strDesc}")->limit($startIndex,$pageSize);
					}
				} else {
					$query = $this->table($tableName)->limit($startIndex,$pageSize);
				}
			} else {
				$total = $this->table($tableName)->count();
				if ($sortCol != "") {
					if (is_array($sortCol)) {
						$query = $this->table($tableName)->order($sortCol);
					} else {
						$query = $this->table($tableName)->order("`{$sortCol}` {$strDesc}");
					}
				} else {
					$query = $this->table($tableName);
				}
			}
		}
		
		$ds = $query->select();
		$output['sql'] = $this->getLastSql();
		$output['db_error'] = $this->getDbError();
		return $ds;		
	}
	
	
	// 获取列表
	public function getAll($cdExp=array(), $startIndex = 0, $pageSize = 0, &$total = 0, $sortCol="", $desc=true, &$output=array()) {        
        $query = $this->fillCondition('', $cdExp, $startIndex, 0, $sortCol, $desc, $opt1);
		$total = $query->count();
		$output['cds'] = $opt1;
		$output['sql'] = $this->getLastSql();
		$output['db_error'] = $this->getDbError();
		
		$query = $this->fillCondition('', $cdExp, $startIndex, $pageSize, $sortCol, $desc, $opt2);
		$ds = $query->select();	
		$output['cds1'] = $opt2;
		$output['sql1'] = $this->getLastSql();
		$output['db_error1'] = $this->getDbError();
		return $ds;		
	}
	
	// 获取数量
	public function getCount($cdExp=array()) {
    	$tableName = $this->getUserDefine(ModelBase::DF_TABLE_NAME);
    	$colNames = $this->getUserDefine(ModelBase::DF_COL_NAMES);
    	$cdsstr = $this->getConditionString($cdExp);  
    	if ($cdsstr != '') {
			$total = $this->table($tableName)->where($cdsstr)->count();
		} else {
			$total = $this->table($tableName)->count();
		}
		return $total;
	} 
	
}

?>