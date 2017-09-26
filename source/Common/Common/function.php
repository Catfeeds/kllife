<?php

function MU() {
    
}

function WU() {
    
}

/**
 * @param string $url
 * @param string $vars
 * @return string
 */
function AU($url = '', $vars = '') {
    $entry = parse_name(MODULE_NAME);
    if($entry == 'app') {
        return AMU($url, $vars);
    } else {
        return AWU($url, $vars);
    }
}

function FAMU($addonName, $url = '', $vars = '') {
    if(!defined('MODULE_NAME')) {
        trigger_error('当前上下文不支持这个函数AU', E_USER_ERROR);
    }
    $addon = parse_name($addonName);
    $url = "/extend/{$addon}/{$url}";
    $url = U($url, $vars);
    $info = pathinfo(__APP__);
    if($info['dirname'] == '/') {
        $root = '/m';
    } else {
        $root = substr($info['dirname'], 0, -1) . 'm';
    }
    if($info['basename'] == 'index.php') {
        $root .= '/' . $info['basename'];
    }

    $len = strlen(__APP__);
    $url = substr($url, $len);
    return $root . $url;
}

function AMU($url = '', $vars = '') {
    if(!defined('ADDON_NAME')) {
        trigger_error('当前上下文不支持这个函数AU', E_USER_ERROR);
    }
    return FAMU(ADDON_NAME, $url, $vars);
}

function FAWU($addonName, $url = '', $vars = '') {
    if(!defined('MODULE_NAME')) {
        trigger_error('当前上下文不支持这个函数AU', E_USER_ERROR);
    }
    $entry = parse_name(MODULE_NAME);
    $addon = parse_name($addonName);
    $url = "/{$entry}/extend/{$addon}/{$url}";
    $url = U($url, $vars);
    $info = pathinfo(__APP__);
    if($info['dirname'] == '/') {
        $root = '/w';
    } else {
        $root = substr($info['dirname'], 0, -1) . 'w';
    }
    if($info['basename'] == 'index.php') {
        $root .= '/' . $info['basename'];
    }

    $len = strlen(__APP__);
    $url = substr($url, $len);
    return $root . $url;
}

function AWU($url = '', $vars = '') {
    if(!defined('ADDON_NAME')) {
        trigger_error('当前上下文不支持这个函数AU', E_USER_ERROR);
    }
    return FAWU(ADDON_NAME, $url, $vars);
}

function inputRaw($jsonDecode = true) {
    $post = file_get_contents('php://input');
    if($jsonDecode) {
        $post = @json_decode($post, true);
    }
    return $post;
}

function attach($path) {
    if(stripos($path, 'http://') === 0 || stripos($path, 'https://') === 0) {
        return $path;
    } else {
        return __SITE__ . 'attachment/' . $path;
    }
}

function coll_key($ds, $key) {
    if(!empty($ds) && !empty($key)) {
        $ret = array();
        foreach($ds as $row) {
            $ret[$row[$key]] = $row;
        }
        return $ret;
    }
    return array();
}

function coll_neaten($ds, $key) {
    if(!empty($ds) && !empty($key)) {
        $ret = array();
        foreach($ds as $row) {
            $ret[] = $row[$key];
        }
        return $ret;
    }
    return array();
}

function coll_walk($ds, $callback, $key = null) {
    if(!empty($ds) && is_callable($callback)) {
        $ret = array();
        if(!empty($key)) {
            foreach($ds as $k => $row) {
                $ret[$k] = call_user_func($callback, $row[$key]);
            }
        } else {
            foreach($ds as $k => $row) {
                $ret[$k] = call_user_func($callback, $row);
            }
        }
        return $ret;
    }
    return array();
}

/**
 * 该函数从一个数组中取得若干元素。
 * 该函数测试（传入）数组的每个键值是否在（目标）数组中已定义；
 * 如果一个键值不存在，该键值所对应的值将被置为FALSE，
 * 或者你可以通过传入的第3个参数来指定默认的值。
 *
 * @param array $keys 对比的键名列表
 * @param array $src 要进行筛选的数组
 * @param mixed $default 如果原数组未定义某个键，则使用此默认值返回
 * @return array
 */
function coll_elements($keys, $src, $default = false) {
    $return = array();
    if(!is_array($keys)) {
        $keys = array($keys);
    }
    foreach($keys as $key) {
        if(isset($src[$key])) {
            $return[$key] = $src[$key];
        } else {
            $return[$key] = $default;
        }
    }
    return $return;
}

/**
 * 该函数从一个数组中取得若干元素。
 * 该函数测试（传入）数组的每个键值是否在（目标）数组中已定义；
 * 如果一个键值不存在或者错误，该键值将被丢弃
 * 或者你可以通过传入的第3个参数来指定默认的值。
 *
 * @param array $cols 对比的键名列表
 * @param array $data 要进行筛选的数组
 * @param mixed $filterKey 如果原数组未定义某个键，则使用此默认值返回
 * @return array
 */
function coll_elements_giveup($cols, $data, $filterKey=false) {
    $return = array();
    if(!is_array($cols)) {
        $cols = array($cols);
    }
    foreach($cols as $key) {
        if(isset($data[$key])) {
            $return[$key] = $data[$key];
        } else {
			foreach ($data as $k=>$v) {
				if ($key === $v) {
            		$return[$k] = $v;
            		break;
				}
			}
		}
    }
    return $return;
}

/**
 * 生成分页数据
 * @param int $currentPage 当前页码
 * @param int $totalCount 总记录数
 * @param string $url 要生成的 url 格式，页码占位符请使用 *，如果未写占位符，系统将自动生成
 * @param int $pageSize 分页大小
 * @return string 分页HTML
 */
function pagination($tcount, $pindex, $psize = 15, $url = '', $context = array('before' => 5, 'after' => 4, 'ajaxcallback' => '')) {
    global $_W;
    $pdata = array(
        'tcount' => 0,
        'tpage' => 0,
        'cindex' => 0,
        'findex' => 0,
        'pindex' => 0,
        'nindex' => 0,
        'lindex' => 0,
        'options' => ''
    );
    if($context['ajaxcallback']) {
        $context['isajax'] = true;
    }

    $pdata['tcount'] = $tcount;
    $pdata['tpage'] = ceil($tcount / $psize);
    if($pdata['tpage'] <= 1) {
        return '';
    }
    $cindex = $pindex;
    $cindex = min($cindex, $pdata['tpage']);
    $cindex = max($cindex, 1);
    $pdata['cindex'] = $cindex;
    $pdata['findex'] = 1;
    $pdata['pindex'] = $cindex > 1 ? $cindex - 1 : 1;
    $pdata['nindex'] = $cindex < $pdata['tpage'] ? $cindex + 1 : $pdata['tpage'];
    $pdata['lindex'] = $pdata['tpage'];

    if($context['isajax']) {
        if(!$url) {
            $url = $_W['script_name'] . '?' . http_build_query($_GET);
        }
        $pdata['faa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['findex'] . '\', ' . $context['ajaxcallback'] . ')"';
        $pdata['paa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['pindex'] . '\', ' . $context['ajaxcallback'] . ')"';
        $pdata['naa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['nindex'] . '\', ' . $context['ajaxcallback'] . ')"';
        $pdata['laa'] = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $pdata['lindex'] . '\', ' . $context['ajaxcallback'] . ')"';
    } else {
        if($url) {
            $pdata['faa'] = 'href="?' . str_replace('*', $pdata['findex'], $url) . '"';
            $pdata['paa'] = 'href="?' . str_replace('*', $pdata['pindex'], $url) . '"';
            $pdata['naa'] = 'href="?' . str_replace('*', $pdata['nindex'], $url) . '"';
            $pdata['laa'] = 'href="?' . str_replace('*', $pdata['lindex'], $url) . '"';
        } else {
            $_GET['page'] = $pdata['findex'];
            $pdata['faa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
            $_GET['page'] = $pdata['pindex'];
            $pdata['paa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
            $_GET['page'] = $pdata['nindex'];
            $pdata['naa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
            $_GET['page'] = $pdata['lindex'];
            $pdata['laa'] = 'href="' . $_W['script_name'] . '?' . http_build_query($_GET) . '"';
        }
    }

    $html = '<div><ul class="pagination pagination-centered">';
    if($pdata['cindex'] > 1) {
        $html .= "<li><a {$pdata['faa']} class=\"pager-nav\">首页</a></li>";
        $html .= "<li><a {$pdata['paa']} class=\"pager-nav\">&laquo;上一页</a></li>";
    }
    //页码算法：前5后4，不足10位补齐
    if(!$context['before'] && $context['before'] != 0) {
        $context['before'] = 5;
    }
    if(!$context['after'] && $context['after'] != 0) {
        $context['after'] = 4;
    }

    if($context['after'] != 0 && $context['before'] != 0) {
        $range = array();
        $range['start'] = max(1, $pdata['cindex'] - $context['before']);
        $range['end'] = min($pdata['tpage'], $pdata['cindex'] + $context['after']);
        if ($range['end'] - $range['start'] < $context['before'] + $context['after']) {
            $range['end'] = min($pdata['tpage'], $range['start'] + $context['before'] + $context['after']);
            $range['start'] = max(1, $range['end'] - $context['before'] - $context['after']);
        }
        for ($i = $range['start']; $i <= $range['end']; $i++) {
            if($context['isajax']) {
                $aa = 'href="javascript:;" onclick="p(\'' . $_W['script_name'] . $url . '\', \'' . $i . '\', ' . $context['ajaxcallback'] . ')"';
            } else {
                if($url) {
                    $aa = 'href="?' . str_replace('*', $i, $url) . '"';
                } else {
                    $_GET['page'] = $i;
                    $aa = 'href="?' . http_build_query($_GET) . '"';
                }
            }
            $html .= ($i == $pdata['cindex'] ? '<li class="active"><a href="javascript:;">' . $i . '</a></li>' : "<li><a {$aa}>" . $i . '</a></li>');
        }
    }

    if($pdata['cindex'] < $pdata['tpage']) {
        $html .= "<li><a {$pdata['naa']} class=\"pager-nav\">下一页&raquo;</a></li>";
        $html .= "<li><a {$pdata['laa']} class=\"pager-nav\">尾页</a></li>";
    }
    $html .= '</ul></div>';
    return $html;
}

function util_random($length, $numeric = false) {
    $seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
    $seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
    if($numeric) {
        $hash = '';
    } else {
        $hash = chr(rand(1, 26) + rand(0, 1) * 32 + 64);
        $length--;
    }
    $max = strlen($seed) - 1;
    for($i = 0; $i < $length; $i++) {
        $hash .= $seed{mt_rand(0, $max)};
    }
    return $hash;
}

/**
 * 判断一个数是否介于一个区间或将一个数转换为此区间的数.
 *
 * @param string $num 输入参数
 * @param int $downline 参数下限
 * @param int $upline 参数上限
 * @param string $returnNear 对输入参数是判断还是返回
 * @return boolean | number
 * <pre>
 *  boolean 判断输入参数是否介于 $downline 和 $upline 之间
 *  number 将输入参数转换为介于  $downline 和 $upline 之间的整数
 * </pre>
 */
function util_limit($num, $downline, $upline, $returnNear = true) {
    $num = intval($num);
    $downline = intval($downline);
    $upline = intval($upline);
    if($num < $downline){
        return empty($returnNear) ? false : $downline;
    } elseif ($num > $upline) {
        return empty($returnNear) ? false : $upline;
    } else {
        return empty($returnNear) ? true : $num;
    }
}

/**
 * 向浏览器端返回JSON格式数据
 * @param $val
 */
function util_json($val) {
    header('Content-Type: application/json');
    echo json_encode($val);
}

/**
 * 返回二维码地址
 * @param $raw
 * @return string
 */
function util_qr($raw) {
    $url = U('bench/utility/qr', array('raw'=>base64_encode($raw)));
    return $url;
}

/**
* 构造逻辑条件表达式数组
* @param string $var 表达式变量
* @param string $op 表达式操作符，为+、-、*、/、%、=、>、<等一系列的逻辑符号
* @param string $val 表达式的值
* @param string $lop 表达式操作符，为AND、OR等一系列的逻辑符号
* 
* @return array 构成条件表达式以及所需的逻辑连接符数组
*/
function logicExp($var, $op, $val, $lop) {
	return array(
		'var' 	=> $var,
		'op'	=> $op,
		'val'	=> $val,
		'lop'	=> $lop,
	);
}

/**
* 构造逻辑条件表达式数组
* @param string $var 表达式变量
* @param string $op 表达式操作符，为+、-、*、/、%、=、>、<、IN、LIKE等一系列的逻辑符号
* @param string $val 表达式的值
* @param string $lop 表达式操作符，为AND、OR等一系列的逻辑符号
* 
* @return array 构成条件表达式以及所需的逻辑连接符数组
*/
function appendLogicExp($var, $op, $val, $lop='AND', $exps=array()) {
	if (empty($exps)) {
		$exps = array();
	}
	
	array_push($exps, array(
			'var' 	=> $var,
			'op'	=> $op,
			'val'	=> $val,
			'lop'	=> $lop,
		));
	return $exps;
}

/**
*
* 产生错误则返回true，否则返回false
*
* @param mixed $exp 待检测的数据
* @return boolean
*/
function isJoinLogicExp($exp) {
	if (is_array($exp) && isset($exp['tab']) && isset($exp['var']) && isset($exp['op']) && isset($exp['val'])) {
		return true;
	}
	return false;
}

/**
* 构造JOIN逻辑条件WHERE表达式数组
* @param string $tab 加入的表
* @param string $var 表达式变量
* @param string $op 表达式操作符，为+、-、*、/、%、=、>、<、IN、LIKE等一系列的逻辑符号
* @param string $val 表达式的值
* @param string $lop 表达式操作符，为AND、OR等一系列的逻辑符号
* @param string $pfx 加入表的前缀
* 
* @return array 构成条件表达式以及所需的逻辑连接符数组
*/
function appendJoinLogicExp($tab, $var, $op, $val, $lop='AND', $pfx='', $exps=array()) {
	if (empty($exps)) {
		$exps = array();
	}
	
	array_push($exps, array(
			'tab'		=> $tab,
			'pfx'		=> $pfx,
			'var' 		=> $var,
			'op'		=> $op,
			'val'		=> $val,
			'lop'		=> $lop,
		));
	return $exps;
}

/**
*
* 产生错误则返回true，否则返回false
*
* @param mixed $exp 待检测的数据
* @return boolean
*/
function isLogicExp($exp) {
	if (is_array($exp) && isset($exp['var']) && isset($exp['op']) && isset($exp['val'])) {
		return true;
	}
	return false;
}

/**
* 构造JOIN条件ON表达式数组
* @param string $tab 加入的表
* @param string $mycol 本表的参照列
* @param string $op 表达式操作符，为+、-、*、/、%、=、>、<、LIKE等一系列的逻辑符号
* @param string $cpcol 加入表的参照列
* @param string $lopCd 表达式操作符，为AND、OR 等一系列的逻辑符号,默认为AND
* @param string $lopJoin 表达式操作符，为inner、left、right、full等一系列的逻辑符号,默认为inner
* @param string $pfx 加入表的前缀, 默认为空
* @param string $tabNickname 表的别名, 默认为空
* 
* @return array 构成条件表达式以及所需的逻辑连接符数组
*/
function appendJoinExp($tab, $mycol, $op, $cpcol, $lopCd='AND', $lopJoin='inner', $pfx='', $tabNickname='', $exps=array()) {
	if (empty($exps)) {
		$exps = array();
	}
	
	array_push($exps, array(
			'lop_join'		=> $lop,
			'tab' 			=> $tab,
			'tab_nickname' 	=> $tabNickname,
			'mycol'			=> $mycol,
			'op'			=> $op,
			'cpcol'			=> $cpcol,
			'lop_cd'		=> $lopCd,
			'pfx'			=> $pfx,
		));
	return $exps;
}

/**
*
* 产生错误则返回true，否则返回false
*
* @param mixed $exp 待检测的数据
* @return boolean
*/
function isJoinExp($exp) {
	if (is_array($exp) && array_key_exists('tab',$exp) && array_key_exists('mycol',$exp) && array_key_exists('cpcol',$exp) && array_key_exists('op',$exp)) {
		return true;
	}
	return false;
}

/**
* 构造JOIN查询要显示的列
* @param string $tab 加入的表
* @param string $cols 显示的列名列表
* @param string $pfx 加入表的前缀
* @param string $nickname 表的别名
* 
* @return array 构成条件表达式以及所需的逻辑连接符数组
*/
function appendJoinTableExp($tab, $cols, $pfx='', $nickname='', $exps) {
	if (empty($exps)) {
		$exps = array();
	}
	
	array_push($exps, array(
			'tab' 			=> $tab,
			'cols'			=> $cols,
			'pfx'			=> $pfx,
			'nickname' 		=> $nickname,
		));
	return $exps;
}

/**
*
* 产生错误则返回true，否则返回false
*
* @param mixed $exp 待检测的数据
* @return boolean
*/
function isJoinTableData($exp) {
	if (is_array($exp) && array_key_exists('tab',$exp) && array_key_exists('cols',$exp)) {
		return true;
	}
	return false;
}

/**
 * 构造错误页数组
 *
 * @param string $title 错误标题
 * @param string $content 错误的内容
 * @param string $reason 错误原因
 * @param string $suggest 错误后的提示建议操作
 * @return array
 */
function errorPage($errno, $title, $content, $reason, $suggest='您可以点击返回到上一步的操作，或是回到首页') {
	return array (
		'errno' => $errno,
        'title' => $title,
        'content' => $content,
        'reason' => $reason,
        'suggest' => $suggest,
	);
}

/**
 * 构造错误数组
 *
 * @param int $errno 错误码，0为无任何错误。
 * @param string $errormsg 错误信息，通知上层应用具体错误信息。
 * @param data 叠加错误信息时候使用，可以是字符串或者error错误对象。
 * @return array
 */
function error($errno, $message = '', $data = '') {
	if (empty($data)) {
	    return array(
	        'errno' => $errno,
	        'message' => $message,
	    );
	} else {
		if (is_error($data)) {
			return array (
		        'errno' => $errno,
		        'message' => $message.'[errno:'.$data['errno'].'=>message:'.$data['message'].']',
			);
		} else {
			return array (
		        'errno' => $errno,
		        'message' => $message.'['.a_2_s($data).']',
			);
		}
	}
}

/**
 * 检测返回值是否产生错误
 *
 * 产生错误则返回true，否则返回false
 *
 * @param mixed $data 待检测的数据
 * @return boolean
 */
function is_error($data) {
    if (empty($data) || !is_array($data) || !array_key_exists('errno', $data) || !array_key_exists('message', $data)) {
        return false;
    } else {
        return true;
    }
}

function error_ok($data) {
	if (is_error($data)) {
		if (intval($data['errno']) === 0) {
			return true;
		}
	}
	return false;
}

function import_third($class) {
    import('Third.' . $class, MB_ROOT . 'source/Core/', '.php');
}

function p_a($array){
	dump($array, 1, "<pre>", 0);
}

function get_sex($sex) {
	if (is_numeric($sex)) {
		return $sex == 0 ? '未知' : ($sex == 1 ? '男' : '女');	
	} else {
		return $sex == '男' ? 1 : ($sex == '女' ? 2 : 0);	
	}
}

// 获取星级
function get_star($star) {
	if (is_numeric($star)) {
//		$starstr = intval($star / 2).'星';
//		if (intval($star % 2) > 0) {
//			$starstr .= '半';
//		}
		$starstr = $star.'星';
		return $starstr;
	} else {
		$starList = explode('星', $star);		
		$firststr = $starList[0];
		if (is_numeric($firststr) == false) {
			switch($firststr){
				case '一': $starnumstr = 1; break;
				case '二': $starnumstr = 2; break;
				case '三': $starnumstr = 3; break;
				case '四': $starnumstr = 4; break;
				case '五': $starnumstr = 5; break;
				case '六': $starnumstr = 6; break;
				case '七': $starnumstr = 7; break;
				case '八': $starnumstr = 8; break;
				case '九': $starnumstr = 9; break;
				case '十': $starnumstr = 10; break;
				default: $starnumstr = 0.5; break;
			}
		} else {
			$starnumstr = $firststr;
		}
//		$starnum = intval($starnumstr) * 2;		
//		if (count($starList) > 1) {
//			$starnum += 1;		
//		}
		return $starnum;
	}
}

function get_blood_type($type) {
	if (is_numeric($type)) {
		switch ($type) {
			case 1: $v = 'A'; break;
			case 2: $v = 'B'; break;
			case 3: $v = 'AB'; break;
			case 4: $v = 'O'; break;
			default: $v = '未知'; break;
		}
	} else {
		$upperType = strtoupper($type);
		switch ($upperType) {
			case 'A': $v = 1; break;
			case 'B': $v = 2; break;
			case 'AB': $v = 3; break;
			case 'O': $v = 4; break;
			case 'a': $v = 1; break;
			case 'b': $v = 2; break;
			case 'ab': $v = 3; break;
			case 'o': $v = 4; break;
			case 'Ab': $v = 3; break;
			case 'aB': $v = 3; break;
			default: $v = 0; break;
		}
	}
	return $v;
}

function get_constellation($c) {
	if (empty($c)) {
		return '未知';
	}
	if (is_numeric($c)) {
		switch ($c) {
			case 1: $v = '白羊座'; break;
			case 2: $v = '金牛座'; break;
			case 3: $v = '双子座'; break;
			case 4: $v = '巨蟹座'; break;
			case 5: $v = '狮子座'; break;
			case 6: $v = '处女座'; break;
			case 7: $v = '天秤座'; break;
			case 8: $v = '天蝎座'; break;
			case 9: $v = '射手座'; break;
			case 10: $v = '摩羯座'; break;
			case 11: $v = '水瓶座'; break;
			case 12: $v = '双鱼座'; break;
			default: $v = '未知'; break;
		}
	} else {
		switch ($c) {
			case '白羊座': $v = 1; break;
			case '金牛座': $v = 2; break;
			case '双子座': $v = 3; break;
			case '巨蟹座': $v = 4; break;
			case '狮子座': $v = 5; break;
			case '处女座': $v = 6; break;
			case '天枰座': $v = 7; break;
			case '天蝎座': $v = 8; break;
			case '射手座': $v = 9; break;
			case '摩羯座': $v = 10; break;
			case '水瓶座': $v = 11; break;
			case '双鱼座': $v = 12; break;
			default: $v = 0; break;
		}
	}
	return $v;
}

function a_2_s($array) {
	$s = "[";
	if (is_array($array)) {
		foreach($array as $k => $v) {
			if (is_array($v)) {
				$s .= $k . ':';
				$s .= a_2_s($v);
			} else {
				$s .= '{' . $k . '=>' . $v . '}';	
			}
		}
	} else {
		$s .= $array;
	}
	$s .= "]";
	return $s;
}

/**
* 时间转换
* @param 传入时间 $dt
* @param 转换为UNIX时间 $tounix
* @param 只显示日期 $date
* @param 显示格式 $ch = 0:没格式，1:中文格式，2:英文格式
* 
* @return
*/
function getDateTime($dt, $tounix=false, $date=true, $ch=1) {
	if ($tounix === false) {
		if ($date == false) {
			if ($ch == 1) {
				return date('Y年m月d日 H时i分s秒', strtotime($dt));
			} else if ($ch == 2) {
				return date('Y-m-d H:i:s', strtotime($dt));
			} else {
				return date('YmdHis', strtotime($dt));
			}
		} else {
			if ($ch == 1) {
				return date('Y年m月d日', strtotime($dt));
			} else if ($ch == 2) {
				return date('Y-m-d', strtotime($dt));
			} else {
				return date('Ymd', strtotime($dt));
			}
		}
	} else {
		return strtotime($dt);
	}
}

function fmtNowDateTime() {
	return date('Y-m-d H:i:s', time());
}

function fmtNowDate() {
	return date('Y-m-d', time());
}

function fmtDateTimeToNow($dateTime, $unixTime=false) {
	if ($unixTime === false) {
		$sub = time() - strtotime($dateTime);	
	} else {		
		$sub = time() - $dateTime;
	}
	$dt['day'] = intval($sub / 86400);
	$dt['hour'] = intval(intval($sub % 86400) / 3600);
	$dt['minute'] = intval(intval($sub % 3600) / 60);
	$dt['second'] = intval($sub % 60);
	$dt['ago_show_text'] = $sub > 0 ? '以前' : '以后';
	if ($dt['day'] != 0) {
		$dt['ago_show_text'] = $dt['day'].'天'.$dt['ago_show_text'];
	} else if ($dt['hour'] != 0) {
		$dt['ago_show_text'] = $dt['hour'].'小时'.$dt['ago_show_text'];
	} else if ($dt['minute'] != 0) {
		$dt['ago_show_text'] = $dt['minute'].'分钟'.$dt['ago_show_text'];
	} else if ($dt['second'] != 0) {
		$dt['ago_show_text'] = $dt['second'].'秒'.$dt['ago_show_text'];
	}
	
	return $dt;
}

function getMillisecond() {
	list($s1, $s2) = explode(' ', microtime());
	$ms = (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
	return $ms - time()*1000;
}

function getUniqueFileName() {
	return date('YmdHisu',time());
}
	
function checkDir($path, $bCreate=true) {
	if (file_exists($path)) {
		return true;
	}
	if ($bCreate === true) {
		return mkdir($path, 0x0777, true);
	}
	return false;
}

function get_real_ip(){
    $ip=false;
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }

    if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ips=explode (', ', $_SERVER['HTTP_X_FORWARDED_FOR']);
        if($ip){ array_unshift($ips, $ip); $ip=FALSE; }
        for ($i=0; $i < count($ips); $i++){
            if(!eregi ('^(10│172.16│192.168).', $ips[$i])){
                $ip=$ips[$i];
                break;
            }
        }
    }
    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}

/**
* 验证手机号是否正确
* @param INT $mobile
*/
function check_mobile($mobile) {
    return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,1,3,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
}

/**
* 验证d电话号码是否正确
* @param INT $tel
*/
function check_tel($tel) {
    return preg_match('#^[0[\d]{2,3}|[\d]{4}][\d]{7,8}$#', $tel) ? true : false;
}

/**
* 验证邮箱是否正确
* @param INT $mobile
*/
function check_email($email) {
    return preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i', $email) ? true : false;
}

/**
* 权限验证
*/
function check_grant($grant_key) {
    session_start();
    $admin = session('admin');
    if(empty($admin)) {
		redirect(U('Admin/Login'));
		return false;
    }
    
    if (!array_key_exists('account', $admin)) {
		return false;
	}
    
    // 超管账号
    if ($admin['account'] === 'admin') {
		return true;
	}
	
	// 超管类型
	if (!empty($admin['type_id_data']) && $admin['type_id_data']['type_key'] === 'super_admin') {
		return true;	
	}
	
	if (!array_key_exists('grant', $admin)) {
		return false;
	}
	
	return array_key_exists($grant_key, $admin['grant']) ? true : false;
}

function get_login_admin() {
    session_start();
    $admin = session('admin');
    if(empty($admin)) {
		redirect(U('Admin/Login'));
		return false;
    }
    return $admin;	
}

function exist_chinese($str) {
//if (preg_match("/^[".chr(0xa1)."-".chr(0xff)."]+$/", $str)) { //只能在GB2312情况下使用
//if (preg_match("/^[\x7f-\xff]+$/", $str)) { //兼容gb2312,utf-8  //判断字符串是否全是中文
	if (preg_match("/[\x7f-\xff]/", $str)) {  //判断字符串中是否有中文
		return true;
	} else {
		return false;
	}
}

function url_encode($data) {
	if (is_array($data)) {
		foreach ($data as $dk=>$dv) {
			$data[$dk] = url_encode($dv);
		}
	} else {
		$data = urlencode($data);
	}
	return $data;
}

function my_json_encode($data) {
	return urldecode(json_encode(url_encode($data)));
}

function my_json_decode($str, $assoc=false) {
    $str = str_replace("\\", '\\\\', $str);
    $str = str_replace("\r\n", '\n', $str);
	return json_decode($str, $assoc);
}

// 检测设备类型
function is_mobile_device(&$out) {
	if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
		$out = 1;
		return true;
	}
	
//	if (isset($_SERVER['HTTP_VIA'])) {
//		$out = 2;
//		return stripos(strtolower($_SERVER['HTTP_VIA']), 'wap') ? true : false;
//	}
	
	$out = 3;
	$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if ( stripos($agent, 'android') !== FALSE ||
		stripos($agent, 'ipad') !== FALSE ||
		stripos($agent, 'iphone') !== FALSE ||
		stripos($agent, 'rim tablet os') !== FALSE ||
		stripos($agent, 'touch') !== FALSE ||
		stripos($agent, 'windows phone') !== FALSE ||
		stripos($agent, 'kfapwi build') !== FALSE ||
		stripos($agent, 'meego') !== FALSE ) {
			return true;
	} else {
		return false;
	}
}
?>