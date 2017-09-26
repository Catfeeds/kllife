<?php
$cfgFile = MB_ROOT . 'source/Conf/config-db.php';
if(!is_file($cfgFile)) {
    header('location: ../install.php');
    exit;
}
$config = require $cfgFile;
$db = $config['db'];


$cfg = array(
    'VIEW_PATH'             =>  APP_ROOT . 'skins/',
    'CHECK_APP_DIR'         =>  false,
//    'SHOW_PAGE_TRACE'       =>  defined('APP_DEBUG') && APP_DEBUG,
    'ACTION_SUFFIX'         =>  'Action',
    'VAR_ADDON'             =>  '____',
    'LOG_RECORD'            =>  false,
    'LOG_PATH'              =>  LOG_PATH,

    'DEFAULT_MODULE'        =>  'Home',
    'DEFAULT_CONTROLLER'    =>  'Home',
    'DEFAULT_ACTION'        =>  'index',
    'DEFAULT_THEME'         =>  'default',
    'URL_HTML_SUFFIX'       =>  '',
    'URL_MODEL'				=>	3,

//    'TAGLIB_BUILD_IN'       =>  'cx,Core\Util\Tags',

    'AUTOLOAD_NAMESPACE'    =>  array(
        'Common'            =>  COMMON_PATH,
        'Core'              =>  MB_ROOT . 'source/Core/',
        'Addon'             =>  MB_ROOT . 'addons/',
        'Vendor'			=>	THINK_PATH . 'Library/Vendor/',
        'Extend'			=>	THINK_PATH . 'Library/Extend/',
    ),

    'DB_TYPE'   			=>  'PDO',
    'DB_USER'   			=>  $db['default']['username'],
    'DB_PWD'    			=>  $db['default']['password'],
    'DB_DSN'    			=>  "mysql:host={$db['default']['host']};port={$db['default']['port']};dbname={$db['default']['database']}",
    'DB_CHARSET'			=>  $db['default']['charset'],
    'DB_PREFIX' 			=>  $db['default']['tablepre'],
    'SHOW_PAGE_TRACE'		=>	false,
        
    // 用户图像的服务器URL
    'LX_FACE_IMAGE_URL'		=> '/source/Static/Upload/face/',
    // 用户图片服务器上传地址	    
    'LX_FACE_UPLOAD_PATH'	=> MB_ROOT.'source/Static/Upload/face/',
    // 付款二维码服务器地址	    
    'LX_PAY_QRCODE_IMAGE_URL'	=> '/source/Static/Upload/pay_qrcode/',
    // 付款二维码服务器地址	    
    'LX_PAY_QRCODE_UPLOAD_PATH'	=> MB_ROOT.'source/Static/Upload/pay_qrcode/',
    
   	// 七牛API配置
    'UPLOAD_SITEIMG_QINIU' 	=> array(
        'maxSize' => 5 * 1024 * 1024, //文件大小
        'rootPath' => 'kllife',
//        'savePath' => 'kllife',
        'saveName' => array('uniqid', ''),
        'driver' => 'Qiniu',
        'driverConfig' => array(
            'secrectKey' => 'WYU30NwWfNBJNZ3HU8KV7Bax0aLJ15CUsSB78Y0T',
            'accessKey' => 'GT-2skwjNxT_vmRXhNpwyWDBCD-vB_CWG6pV7-OA',
            'domain' => 'img.kllife.com',
            'bucket' => 'kllifeimg',
            'watermark'=>'http://7xosrp.com1.z0.glb.clouddn.com/youji2016-05-27_5747fcd71997c.png',
        )
    ),
    
	// 选片系统七牛API配置
	'UPLOAD_SITEIMG_QINIU_PHOTO'	=> array(
	    'maxSize' => 5 * 1024 * 1024, //文件大小
	    'rootPath' => 'kllife',
	    'saveName' => array('uniqid', ''),
	    'driver' => 'Qiniu',
	    'driverConfig' => array(
	        'secrectKey' => 'WYU30NwWfNBJNZ3HU8KV7Bax0aLJ15CUsSB78Y0T',
	        'accessKey' => 'GT-2skwjNxT_vmRXhNpwyWDBCD-vB_CWG6pV7-OA',
	        'domain' => 'xlp.photo.kllife.com',
	        'bucket' => 'xinlvpaiphoto',
	        'watermark'=>'http://7xosrp.com1.z0.glb.clouddn.com/youji2016-05-27_5747fcd71997c.png',
	    )
	),
	
	//选片系统配置
	'PHOTO_JX_MAXLENGHT'  => 5, 	//赠送精修照片数
	'PHOTO_JX_UNIT_PRICE' => 9.99,  //多选精修照单价

//手机短信发送配置
	'SMS_UID'       => '50533',  	        //短信平台用户名
    'SMS_CODE'      => 'hwlx',              //企业代码
    'SMS_PASSWORD'  => 'KLLIFE88225622s', 	//平台密码

	
	//支付宝配置参数
	'alipay_config'=>array(
		'partner' 		=> '2088421286007493',//合作身份者ID，签约账号
		'key'			=> 'tc7am7cx9gcfar3v3d9kba7n8tl8x8th',// MD5密钥，安全检
		'sign_type'		=> strtoupper('MD5'),//签名方式
		'input_charset'	=> strtolower('utf-8'),//字符编码格
		'cacert'		=> getcwd().'\\cacert.pem',//ca证书路径地址，用于curl中ssl校验
		'transport'		=> 'http',//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		
	),
	
	//第三方登陆配置
	//腾讯QQ登录配置
	'THINK_SDK_QQ' => array(
		'APP_KEY'    => '101378087', //应用注册成功后分配的 APP ID
		'APP_SECRET' => 'b5a88524844e06eb6b0d33a9c8ecfa63', //应用注册成功后分配的KEY
		'CALLBACK'   => 'http://kllife.com/inf/qqlogin.php',
	),
	//微信登录
	'THINK_SDK_WEIXIN' => array(
		'APP_KEY'    => 'wxe1304d26a8d807de', //应用注册成功后分配的 APP ID
		'APP_SECRET' => '5684b5774ad186ed950ed6d692ea7cba', //应用注册成功后分配的KEY
		'CALLBACK'   => 'http://kllife.com/home/index.php?s=/home/thirdLogin/callback/type/weixin/',
	),


//邮件发送服务器配置
//下载附件PHPMailer解压到ThinkPHP\Library\Vendor

	'MAIL_HOST'      => 'smtp.ym.163.com',  	//smtp服务器的名称
    'MAIL_SMTPAUTH'  => TRUE,               	//启用smtp认证
    'MAIL_USERNAME'  => 'admin@kllife.com', 	//你的邮箱名
    'MAIL_FROM'      => 'admin@kllife.com', 	//发件人地址
    'MAIL_FROMNAME'  => '领袖户外旅行网',         //发件人姓名
    'MAIL_PASSWORD'  => 'kllife88225622',   	//邮箱密码
    'MAIL_CHARSET'   => 'utf-8',            	//设置邮件编码
    'MAIL_ISHTML'    => TRUE,               	// 是否HTML格式邮件
    
    // 数据库表数据添加、更新、删除监督表
    'OP_LOG_TABLE'	 => array(
		array('table_name'=>'kl_account_type', 'table_desc'=> '账户类型'),
		array('table_name'=>'kl_admin', 'table_desc'=> '管理员'),
		array('table_name'=>'kl_admin_type', 'table_desc'=> '管理员类型'),
		array('table_name'=>'kl_cash_function', 'table_desc'=> '费用功能'),
		array('table_name'=>'kl_article', 'table_desc'=> '文章信息表'),
		array('table_name'=>'kl_batch', 'table_desc'=> '产品批次表'),
		array('table_name'=>'kl_cash_function', 'table_desc'=> '费用功能表'),
		array('table_name'=>'kl_cash_use', 'table_desc'=> '费用用途'),
		array('table_name'=>'kl_certificate_type', 'table_desc'=> '证件类型'),
		array('table_name'=>'kl_cj_agency', 'table_desc'=> '同行地接表'),
		array('table_name'=>'kl_cj_bus', 'table_desc'=> '大巴资源表'),
		array('table_name'=>'kl_cj_deposit', 'table_desc'=> '预交金审核表'),
		array('table_name'=>'kl_cj_driver', 'table_desc'=> '司机资源表'),
		array('table_name'=>'kl_cj_hotel', 'table_desc'=> '酒店资源表'),
		array('table_name'=>'kl_cj_insurance', 'table_desc'=> '保险资源表'),
		array('table_name'=>'kl_cj_item', 'table_desc'=> '消费项表'),
		array('table_name'=>'kl_cj_item_room', 'table_desc'=> '房间消费项扩展表'),
		array('table_name'=>'kl_cj_leader', 'table_desc'=> '领队资源表'),
		array('table_name'=>'kl_cj_price', 'table_desc'=> '资源价格表'),
		array('table_name'=>'kl_cj_source', 'table_desc'=> '其他资源'),
		array('table_name'=>'kl_cj_team', 'table_desc'=> '团期表'),
		array('table_name'=>'kl_cj_team_source', 'table_desc'=> '团期资源'),
		array('table_name'=>'kl_cj_view', 'table_desc'=> '景点资源表'),
		array('table_name'=>'kl_coupon_type', 'table_desc'=> '优惠券类型'),
		array('table_name'=>'kl_data_type', 'table_desc'=> '数据类型'),
		array('table_name'=>'kl_fx_line', 'table_desc'=> '分销线路表'),
		array('table_name'=>'kl_fx_order', 'table_desc'=> '分销订单表'),
		array('table_name'=>'kl_fx_set', 'table_desc'=> '分销设置表'),
		array('table_name'=>'kl_fx_take_cash', 'table_desc'=> '分销提款表'),
		array('table_name'=>'kl_fx_user', 'table_desc'=> '分销用户表'),
		array('table_name'=>'kl_grant', 'table_desc'=> '权限'),
		array('table_name'=>'kl_grant_admin_type_bind', 'table_desc'=> '权限绑定管理员类型'),
		array('table_name'=>'kl_grant_group', 'table_desc'=> '权限组'),
		array('table_name'=>'kl_grant_group_bind', 'table_desc'=> '权限绑定组权限组'),
		array('table_name'=>'kl_grant_type', 'table_desc'=> '权限类型'),
		array('table_name'=>'kl_group_admin_type_bind', 'table_desc'=> '权限组绑定管理员类型'),
		array('table_name'=>'kl_line', 'table_desc'=> '线路产品表'),
		array('table_name'=>'kl_line_point_scenery', 'table_desc'=> '线路行程亮点与沿途风光'),
		array('table_name'=>'kl_line_special_offer', 'table_desc'=> '线路特价表'),
		array('table_name'=>'kl_member_largess', 'table_desc'=> '参团人赠品表'),
		array('table_name'=>'kl_member_type', 'table_desc'=> '参团客户类型'),
		array('table_name'=>'kl_menu_item', 'table_desc'=> '菜单项'),
		array('table_name'=>'kl_menu_type', 'table_desc'=> '菜单类型'),
		array('table_name'=>'kl_op_type', 'table_desc'=> '日志类型'),
		array('table_name'=>'kl_order_coupon', 'table_desc'=> '订单优惠券'),
		array('table_name'=>'kl_order_extra_cash', 'table_desc'=> '订单额外费用'),
		array('table_name'=>'kl_order_from', 'table_desc'=> '订单来源'),
		array('table_name'=>'kl_order_member_type_count', 'table_desc'=> '订单参团人类型数量'),
		array('table_name'=>'kl_order_review', 'table_desc'=> '订单审核'),
		array('table_name'=>'kl_order_review_change_count', 'table_desc'=> '订单参团人数改变审核'),
		array('table_name'=>'kl_order_review_change_line', 'table_desc'=> '订单线路改变审核'),
		array('table_name'=>'kl_order_review_exit_member', 'table_desc'=> '订单退团审核'),
		array('table_name'=>'kl_order_state', 'table_desc'=> '订单状态'),
		array('table_name'=>'kl_question', 'table_desc'=> '问答列表'),
		array('table_name'=>'kl_review_type', 'table_desc'=> '审核类型'),
		array('table_name'=>'kl_self_config', 'table_desc'=> '项目配置'),
		array('table_name'=>'kl_signup_member', 'table_desc'=> '参团客户'),
		array('table_name'=>'kl_state_type', 'table_desc'=> '状态类型'),
		array('table_name'=>'kl_station_info', 'table_desc'=> '站点表'),
		array('table_name'=>'kl_subject', 'table_desc'=> '专题表'),
		array('table_name'=>'kl_subject_data', 'table_desc'=> '专题附加数据表'),
		array('table_name'=>'kl_station_info', 'table_desc'=> '站点表'),
		array('table_name'=>'kl_team_group', 'table_desc'=> '小包团'),
		array('table_name'=>'kl_team_scheduling', 'table_desc'=> '小包团行程'),
		array('table_name'=>'kl_travel_intro', 'table_desc'=> '线路行程表'),
		array('table_name'=>'kl_type_data', 'table_desc'=> '类型数据'),
		array('table_name'=>'kl_user', 'table_desc'=> '前台用户表'),
		array('table_name'=>'kl_user_coupon', 'table_desc'=> '前台用户优惠券表'),
		array('table_name'=>'kl_user_coupon_type', 'table_desc'=> '前台用户优惠券类型表'),
		array('table_name'=>'xz_lineenertname', 'table_desc'=> '订单信息'),
		array('table_name'=>'xz_pay_log', 'table_desc'=> '在线支付信息'),		
    ),
);

$cfg['COMMON'] = array_change_key_case($config['common'], CASE_UPPER);

if(defined('IN_APP') && IN_APP === true) {
    $c = require MB_ROOT . 'source/Common/Conf/config-app.php';
    $cfg = array_merge($cfg, $c);
} else if(defined('IN_PHONE') && IN_PHONE === true) {
    $c = require MB_ROOT . 'source/Common/Conf/config-phone.php';
    $cfg = array_merge($cfg, $c);
} else if(defined('IN_HOME') && IN_HOME === true) {
    $c = require MB_ROOT . 'source/Common/Conf/config-home.php';
    $cfg = array_merge($cfg, $c);
} else if(defined('IN_PHOTO') && IN_PHOTO === true) {
    $c = require MB_ROOT . 'source/Common/Conf/config-photo.php';
    $cfg = array_merge($cfg, $c);
} else if(defined('IN_FENXIAO') && IN_FENXIAO === true) {
    $c = require MB_ROOT . 'source/Common/Conf/config-fenxiao.php';
    $cfg = array_merge($cfg, $c);
} else if(defined('IN_QINGLVPAI') && IN_QINGLVPAI === true) {
    $c = require MB_ROOT . 'source/Common/Conf/config-qinglvpai.php';
    $cfg = array_merge($cfg, $c);
} else if(defined('IN_QLP_PHONE') && IN_QLP_PHONE === true) {
    $c = require MB_ROOT . 'source/Common/Conf/config-qlpphone.php';
    $cfg = array_merge($cfg, $c);
} else if(defined('IN_SEO') && IN_SEO === true) {
    $c = require MB_ROOT . 'source/Common/Conf/config-seo.php';
    $cfg = array_merge($cfg, $c);
}  else {
    $c = require MB_ROOT . 'source/Common/Conf/config-back.php';
    $cfg = array_merge($cfg, $c);
}

return $cfg;

?>