<?php
$c = array();

define('__SOURCE_PATH__', 'source/Static');
define('__UPLOAD_PATH__', 'Upload/back');

$c['SESSION_AUTO_START']            = false;
$c['DEFAULT_MODULE']                = 'Back';
$c['DEFAULT_CONTROLLER']            = 'Index';
$c['DEFAULT_ACTION']     		    = 'welcome';
$c['TMPL_ACTION_ERROR']             = 'Common/message';
$c['TMPL_ACTION_SUCCESS']           = 'Common/message';
$c['TMPL_PARSE_STRING']             = array(
    '__PUBLIC__'                    => __SITE__ . __SOURCE_PATH__ ,
    '__UPLOAD_REAL_PATH__'			=> MB_ROOT . __SOURCE_PATH__ . '/' . __UPLOAD_PATH__ . '/',
    '__UPLOAD_URL__'				=> '/'.__SOURCE_PATH__.'/'.__UPLOAD_PATH__.'/',
    '{__GLOBAL_APPLICATION__}'      => '领袖户外',
//    '{__GLOBAL_APPLICATION_URL__}'  => 'http:localhost/kllife/back',
//    '{__GLOBAL_HOST_URL__}'         => 'http:localhost/kllife',
//    '{__GLOBAL_APPLICATION_URL__}'  => 'http://manage.kllife.com/back',
//    '{__GLOBAL_HOST_URL__}'         => 'http://manage.kllife.com',
//    '{__GLOBAL_APPLICATION_URL__}'  => 'http://youzan.lechikeji.com/kllife/back',
//    '{__GLOBAL_HOST_URL__}'         => 'http://youzan.lechikeji.com/kllife',
    '{__GLOBAL_APPLICATION_URL__}'  => 'http://kllife.com/back',
    '{__GLOBAL_HOST_URL__}'         => 'http://kllife.com/',
    '{__GLOBAL_VERSION__}'          => MB_VERSION,
    '{__GLOBAL_HOST__}'             => '领袖户外',
    '{__GLOBAL_BEIAN__}'            => '陕ICP备14011728号-1',
    '{__GLOBAL_ABOUT_URL__}'        => 'http://kllife.com',
    '{__GLOBAL_ABOUT__}'            => '关于',
    '{__GLOBAL_HELP_URL__}'         => 'http://kllife.com',
    '{__GLOBAL_HELP__}'             => '帮助',
);

$c['INIT_DATA_SETTLED'] 			= true;	// 数据库数据已进行初始化

$c['INIT_DATA'] = array(
	'ADMIN_TYPE'					=> array(
		'table_name'				=> 'admin_type',
		'data_save_flag'			=> 'admin_type_init',
		'data'						=> array(
			array('type_key'=>'super_admin', 'type_desc'=> '超级管理员', 'can_delete'=>0),
			array('type_key'=>'administrator', 'type_desc'=> '管理员', 'can_delete'=>0),
			array('type_key'=>'finance', 'type_desc'=> '财务', 'can_delete'=>0),
			array('type_key'=>'customer_service', 'type_desc'=> '客服', 'can_delete'=>0),
			array('type_key'=>'operator', 'type_desc'=> '基调', 'can_delete'=>0),
		)
	),
	'GRANT_GROUP'					=> array(
		'table_name'				=> 'grant_group',
		'data_save_flag'			=> 'grant_group_init',
		'data'						=> array(
			array('admin_id'=>1, 'type_key'=>'base', 'type_desc'=>'基本权限', 'can_delete'=>0),
		)
	),
	'GRANT_TYPE'					=> array(
		'table_name'				=> 'grant_type',
		'data_save_flag'			=> 'grant_type_init',
		'data'						=> array(
			array('type_key'=>'data', 'type_desc'=>'数据权限', 'can_delete'=>0),
			array('type_key'=>'web', 'type_desc'=>'页面权限', 'can_delete'=>0),
		)
	),
	'CASH_USE'					=> array(
		'table_name'				=> 'cash_use',
		'data_save_flag'			=> 'cash_use_init',
		'data'						=> array(
			array('type_key'=>'team', 'type_desc'=>'团费', 'can_delete'=>0),
			array('type_key'=>'hotel', 'type_desc'=>'酒店房价差', 'can_delete'=>0),
			array('type_key'=>'book_room', 'type_desc'=>'代订房', 'can_delete'=>0),
			array('type_key'=>'book_car', 'type_desc'=>'代订车', 'can_delete'=>0),
			array('type_key'=>'penalty', 'type_desc'=>'违约金', 'can_delete'=>0),
		)
	),
	'CASH_FUNCTION'						=> array(
		'table_name'				=> 'cash_function',
		'data_save_flag'			=> 'cash_function_init',
		'data'						=> array(
			array('type_key'=>'pay', 'type_desc'=>'支付', 'can_delete'=>0),
			array('type_key'=>'refund', 'type_desc'=>'退款', 'can_delete'=>0),
		)
	),
	'ORDER_FROM'					=> array(
		'table_name'				=> 'order_from',
		'data_save_flag'			=> 'order_from_init',
		'data'						=> array(
			array('type_key'=>'guanwang', 'type_desc'=> '官网', 'can_delete'=>0),
			array('type_key'=>'qunaer', 'type_desc'=> '去哪儿', 'can_delete'=>0),
			array('type_key'=>'xiecheng', 'type_desc'=> '携程', 'can_delete'=>0),
			array('type_key'=>'xianxia', 'type_desc'=> '线下', 'can_delete'=>0),
			array('type_key'=>'popular', 'type_desc'=> '人气', 'can_delete'=>0),
			array('type_key'=>'baidu', 'type_desc'=> '百度', 'can_delete'=>0),
			array('type_key'=>'weixin', 'type_desc'=> '微信', 'can_delete'=>0),
			array('type_key'=>'today_news', 'type_desc'=> '今日头条', 'can_delete'=>0),
			array('type_key'=>'netease_news', 'type_desc'=> '网易新闻', 'can_delete'=>0),
			array('type_key'=>'tencent_news', 'type_desc'=> '腾讯新闻', 'can_delete'=>0),
			array('type_key'=>'other_search_engine', 'type_desc'=> '其他搜索引擎', 'can_delete'=>0),
			array('type_key'=>'QQ_Group', 'type_desc'=> 'QQ群', 'can_delete'=>0),
			array('type_key'=>'friend_intro', 'type_desc'=> '朋友介绍', 'can_delete'=>0),
			array('type_key'=>'old_customer', 'type_desc'=> '老客户', 'can_delete'=>0),
		)
	),
	'STATE_TYPE'					=> array(
		'table_name'				=> 'state_type',
		'data_save_flag'			=> 'state_type_init',
		'data'						=> array(
			array('id'=>1,'type_key'=>'order', 'type_desc'=>'订单状态', 'can_delete'=>0),
			array('id'=>2,'type_key'=>'team_group', 'type_desc'=>'小包团状态', 'can_delete'=>0),
			array('id'=>3,'type_key'=>'alert_task', 'type_desc'=>'提醒状态', 'can_delete'=>0),
		)
	),
	'ORDER_STATE'					=> array(
		'table_name'				=> 'order_state',
		'data_save_flag'			=> 'order_state_init',
		'data'						=> array(
			array('id'=>0,'type_key'=>'unreview', 'type_desc'=>'未审核', 'state_type_id'=>1, 'can_delete'=>0),
			array('id'=>1,'type_key'=>'review', 'type_desc'=>'已审核', 'state_type_id'=>1, 'can_delete'=>0),
			array('id'=>2,'type_key'=>'pay_complate1', 'type_desc'=>'已付全款', 'state_type_id'=>1, 'can_delete'=>0),
			array('id'=>3,'type_key'=>'invalid', 'type_desc'=>'无效', 'state_type_id'=>1, 'can_delete'=>0),
			array('id'=>4,'type_key'=>'canceled', 'type_desc'=>'已取消', 'state_type_id'=>1, 'can_delete'=>0),
			array('id'=>5,'type_key'=>'unjoin', 'type_desc'=>'替补', 'state_type_id'=>1, 'can_delete'=>0),
			array('id'=>6,'type_key'=>'paying', 'type_desc'=>'付款中', 'state_type_id'=>1, 'can_delete'=>0),	
			array('id'=>7,'type_key'=>'pay_advance', 'type_desc'=>'已付预付款', 'state_type_id'=>1, 'can_delete'=>0),
			array('id'=>8,'type_key'=>'pay_complate', 'type_desc'=>'已付全款', 'state_type_id'=>1, 'can_delete'=>0),
			array('id'=>9,'type_key'=>'refunding', 'type_desc'=>'退款中', 'state_type_id'=>1, 'can_delete'=>0),		
			array('id'=>10,'type_key'=>'pay_part', 'type_desc'=>'已付部分款', 'state_type_id'=>1, 'can_delete'=>0),		
			array('id'=>11,'type_key'=>'info_changing', 'type_desc'=>'信息变更申请中', 'state_type_id'=>1, 'can_delete'=>0),
			array('id'=>12,'type_key'=>'refund_wait', 'type_desc'=>'等待退款', 'state_type_id'=>1, 'can_delete'=>0),
			array('id'=>13,'type_key'=>'exit_team', 'type_desc'=>'退团', 'state_type_id'=>1, 'can_delete'=>0),
			array('id'=>14,'type_key'=>'error_refund', 'type_desc'=>'退款错误', 'state_type_id'=>1, 'can_delete'=>0),
			array('id'=>15,'type_key'=>'complated', 'type_desc'=>'已完成', 'state_type_id'=>1, 'can_delete'=>0),
			array('id'=>16,'type_key'=>'team_assign_wait', 'type_desc'=>'等待分配', 'state_type_id'=>2, 'can_delete'=>0),
			array('id'=>17,'type_key'=>'team_dispose_wait', 'type_desc'=>'等待处理', 'state_type_id'=>2, 'can_delete'=>0),
			array('id'=>18,'type_key'=>'team_disposing', 'type_desc'=>'处理中', 'state_type_id'=>2, 'can_delete'=>0),
			array('id'=>19,'type_key'=>'team_created_order', 'type_desc'=>'已创建订单', 'state_type_id'=>2, 'can_delete'=>0),
			array('id'=>20,'type_key'=>'team_complated', 'type_desc'=>'处理完成', 'state_type_id'=>2, 'can_delete'=>0),
			array('id'=>21,'type_key'=>'team_canceled', 'type_desc'=>'已取消', 'state_type_id'=>2, 'can_delete'=>0),
			array('id'=>22,'type_key'=>'alert_dispose_wait', 'type_desc'=>'等待处理', 'state_type_id'=>3, 'can_delete'=>0),
			array('id'=>23,'type_key'=>'alert_disposing', 'type_desc'=>'处理中', 'state_type_id'=>3, 'can_delete'=>0),
			array('id'=>24,'type_key'=>'alert_complated', 'type_desc'=>'已完成', 'state_type_id'=>3, 'can_delete'=>0),
			array('id'=>25,'type_key'=>'alert_dispose_timeout', 'type_desc'=>'处理超时', 'state_type_id'=>3, 'can_delete'=>0),
			array('id'=>26,'type_key'=>'alert_accept_timeout', 'type_desc'=>'接受超时', 'state_type_id'=>3, 'can_delete'=>0),
			array('id'=>27,'type_key'=>'alert_accept_other', 'type_desc'=>'他人处理', 'state_type_id'=>3, 'can_delete'=>0),
			array('id'=>28,'type_key'=>'cancel_scheduling', 'type_desc'=>'取消行程', 'state_type_id'=>1, 'can_delete'=>0),
		)
	),
	'MEMBER_TYPE'					=> array(
		'table_name'				=> 'member_type',
		'data_save_flag'			=> 'member_type_init',
		'data'						=> array(
			array('type_key'=>'adult_man', 'type_desc'=>'成人男', 'can_delete'=>0),
			array('type_key'=>'adult_woman', 'type_desc'=>'成人女', 'can_delete'=>0),
			array('type_key'=>'child', 'type_desc'=>'小孩', 'can_delete'=>0),
			array('type_key'=>'single_man', 'type_desc'=>'单男', 'can_delete'=>0),
			array('type_key'=>'single_woman', 'type_desc'=>'单女', 'can_delete'=>0),
			array('type_key'=>'room_single_man', 'type_desc'=>'单住男', 'can_delete'=>0),
			array('type_key'=>'room_single_woman', 'type_desc'=>'单住女', 'can_delete'=>0),
			array('type_key'=>'room_family_man', 'type_desc'=>'家庭男', 'can_delete'=>0),
			array('type_key'=>'room_family_woman', 'type_desc'=>'家庭女', 'can_delete'=>0),
		)
	),
	'CERTIFICATE_TYPE'					=> array(
		'table_name'				=> 'certificate_type',
		'data_save_flag'			=> 'certificate_type_init',
		'data'						=> array(
			array('type_key'=>'id_card', 'type_desc'=>'身份证', 'can_delete'=>0),
			array('type_key'=>'passport', 'type_desc'=>'护照', 'can_delete'=>0),
			array('type_key'=>'driving_licence', 'type_desc'=>'驾驶执照', 'can_delete'=>0),
			array('type_key'=>'household', 'type_desc'=>'户口本', 'can_delete'=>0),
			array('type_key'=>'student', 'type_desc'=>'学生证', 'can_delete'=>0),
			array('type_key'=>'army', 'type_desc'=>'军官证', 'can_delete'=>0),
			array('type_key'=>'police', 'type_desc'=>'警官证', 'can_delete'=>0),
			array('type_key'=>'official', 'type_desc'=>'干部证', 'can_delete'=>0),
			array('type_key'=>'gohome', 'type_desc'=>'回乡证', 'can_delete'=>0),
		)
	),
	'MENU_ITEM'					=> array(
		'table_name'				=> 'menu_item',
		'data_save_flag'			=> 'menu_item_init',
		'data'						=> array(
			array('id'=>15,'type_key'=>'weixin', 'type_desc'=>'微信支付', 'can_delete'=>0),
			array('id'=>19,'type_key'=>'chuxuka', 'type_desc'=>'储蓄卡', 'can_delete'=>0),
			array('id'=>24,'type_key'=>'xunyongka', 'type_desc'=>'信用卡', 'can_delete'=>0),
		)
	),
	'REVIEW_TYPE'			=> array(
		'table_name'				=> 'review_type',
		'data_save_flag'			=> 'review_type_init',
		'data'						=> array(		
			array('type_key'=>'unreview', 'type_desc'=>'未提交', 'can_delete'=>0),
			array('type_key'=>'reviewing', 'type_desc'=>'待审核', 'can_delete'=>0),
			array('type_key'=>'review_fail', 'type_desc'=>'审核失败', 'can_delete'=>0),
			array('type_key'=>'review_pass', 'type_desc'=>'审核成功', 'can_delete'=>0),
		)
	),
	'LOG_OP_TYPE'					=> array(
		'table_name'				=> 'op_type',
		'data_save_flag'			=> 'log_op_type_init',
		'data'						=> array(
			array('type_key'=>'add', 'type_desc'=> '添加', 'can_delete'=>0),
			array('type_key'=>'update', 'type_desc'=> '更新', 'can_delete'=>0),
			array('type_key'=>'delete', 'type_desc'=> '删除', 'can_delete'=>0),
		)
	),
	'LOG_OP_TABLES'					=> array(
		'table_name'				=> 'tables',
		'data_save_flag'			=> 'log_op_table_init',
		'data'						=> array(	
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
		)
	),
);

return $c;
?>