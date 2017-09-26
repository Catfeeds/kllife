<?php
/**
 * 启动位置
 */

define('MB_ROOT', str_replace("\\", '/', dirname(dirname(__FILE__))) . '/');

define('APP_MODE', 'common');
define('THINK_PATH', MB_ROOT . 'source/ThinkPHP/');
define('COMMON_PATH', MB_ROOT . 'source/Common/');
define('STORAGE_TYPE', 'File');

define('APP_DEBUG', true);

define('LOG_PATH', MB_ROOT . 'source/Data/Logs/');

// 主站APP
if(defined('IN_APP') && IN_APP === true) {
    define('APP_ROOT', MB_ROOT . 'app/');
    define('APP_PATH', APP_ROOT . 'code/');
    define('RUNTIME_PATH', MB_ROOT . 'source/Data/Runtime/App/');    
	require MB_ROOT . 'app/Conf/version.inc.php';

// 主站手机端
} else if(defined('IN_PHONE') && IN_PHONE === true) {
    define('APP_ROOT', MB_ROOT . 'phone/');
    define('APP_PATH', APP_ROOT . 'code/');
    define('RUNTIME_PATH', MB_ROOT . 'source/Data/Runtime/Phone/');    
	require MB_ROOT . 'phone/Conf/version.inc.php';
	
// 主站PC端
}  else if(defined('IN_HOME') && IN_HOME === true) {
    define('APP_ROOT', MB_ROOT . 'home/');
    define('APP_PATH', APP_ROOT . 'code/');
    define('RUNTIME_PATH', MB_ROOT . 'source/Data/Runtime/Home/');    
	require MB_ROOT . 'home/Conf/version.inc.php';

// 选片系统
}  else if(defined('IN_PHOTO') && IN_PHOTO === true) {
    define('APP_ROOT', MB_ROOT . 'photo/');
    define('APP_PATH', APP_ROOT . 'code/');
    define('RUNTIME_PATH', MB_ROOT . 'source/Data/Runtime/Photo/');    
	require MB_ROOT . 'photo/Conf/version.inc.php';

// 分销系统
}  else if(defined('IN_FENXIAO') && IN_FENXIAO === true) {
    define('APP_ROOT', MB_ROOT . 'fenxiao/');
    define('APP_PATH', APP_ROOT . 'code/');
    define('RUNTIME_PATH', MB_ROOT . 'source/Data/Runtime/fx/');    
	require MB_ROOT . 'fenxiao/Conf/version.inc.php';
	
// 轻旅拍PC端
}  else if(defined('IN_QINGLVPAI') && IN_QINGLVPAI === true) {
    define('APP_ROOT', MB_ROOT . 'qinglvpai/');
    define('APP_PATH', APP_ROOT . 'code/');
    define('RUNTIME_PATH', MB_ROOT . 'source/Data/Runtime/Qinglvpai/');    
	require MB_ROOT . 'qinglvpai/Conf/version.inc.php';

// 轻旅拍手机端
}  else if(defined('IN_QLP_PHONE') && IN_QLP_PHONE === true) {
    define('APP_ROOT', MB_ROOT . 'qlpphone/');
    define('APP_PATH', APP_ROOT . 'code/');
    define('RUNTIME_PATH', MB_ROOT . 'source/Data/Runtime/QLPPhone/');    
	require MB_ROOT . 'qlpphone/Conf/version.inc.php';
	
// SEO
}  else if(defined('IN_SEO') && IN_SEO === true) {
    define('APP_ROOT', MB_ROOT . 'seo/');
    define('APP_PATH', APP_ROOT . 'code/');
    define('RUNTIME_PATH', MB_ROOT . 'source/Data/Runtime/Seo/');    
	require MB_ROOT . 'seo/Conf/version.inc.php';
	
// 后台管理系统
} else {
    define('APP_ROOT', MB_ROOT . 'back/');
    define('APP_PATH', APP_ROOT . 'code/');
    define('RUNTIME_PATH', MB_ROOT . 'source/Data/Runtime/Back/');    
	require MB_ROOT . 'back/Conf/version.inc.php';
}


if(PHP_SAPI != 'cli') {
    $_dir_ = dirname(dirname($_SERVER['SCRIPT_NAME']));
    if($_dir_ == '/' || $_dir_ == '\\') {
        $_dir_ = '/';
    } else {
        $_dir_ .= '/';
    }
    define('__SITE__', $_dir_);
    $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
    $_host_ = "{$scheme}://{$_SERVER['HTTP_HOST']}";
//    if($_SERVER['REQUEST_SCHEME'] == 'http' && $_SERVER['SERVER_PORT'] != '80') {
//        $_host_ .= ":{$_SERVER['SERVER_PORT']}";
//    }
//    if($_SERVER['REQUEST_SCHEME'] == 'https' && $_SERVER['SERVER_PORT'] != '443') {
//        $_host_ .= ":{$_SERVER['SERVER_PORT']}";
//    }
    define('__HOST__', $_host_);
}
$cfgFile = MB_ROOT . 'source/Conf/config-db.php';
if(!is_file($cfgFile)) {
    header('location: ../install.php');
    exit;
}

define('MSG_TYPE_SUCCESS', 1);
define('MSG_TYPE_INFO', 2);
define('MSG_TYPE_WARNING', 3);
define('MSG_TYPE_DANGER', 4);
define('TIMESTAMP', time());

define('IN_CONTAINER_MOBILE', empty($_SERVER) && 0 < stripos($_SERVER['HTTP_USER_AGENT'], 'mobile'));
define('IN_CONTAINER_WEIXIN', empty($_SERVER) && 0 < stripos($_SERVER['HTTP_USER_AGENT'], 'micromessenger'));
define('IN_CONTAINER_YIXIN', empty($_SERVER) && 0 < stripos($_SERVER['HTTP_USER_AGENT'], 'yixin'));
define('IN_CONTAINER_ALIPAY', empty($_SERVER) && 0 < stripos($_SERVER['HTTP_USER_AGENT'], 'alipay'));
define('IN_CONTAINER_CLI', PHP_SAPI == 'cli');

?>