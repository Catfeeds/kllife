<?php
$c = array();

define('__SOURCE_PATH__', 'source/Static');
define('__UPLOAD_PATH__', 'Upload/home');

$c['SESSION_AUTO_START']            = false;
$c['DEFAULT_MODULE']                = 'Home';
$c['DEFAULT_CONTROLLER']            = 'Index';
$c['DEFAULT_ACTION']     		    = 'welcome';
$c['TMPL_ACTION_ERROR']             = 'Common/message';
$c['TMPL_ACTION_SUCCESS']           = 'Common/message';
$c['TMPL_PARSE_STRING']             = array(
    '__SITE__'                      => __SITE__,
    '__PUBLIC__'                    => __SITE__ . __SOURCE_PATH__ ,
//    '{__TEMPLATE_THEME__}'          => '',
    '{__GLOBAL_APPLICATION__}'      => '领袖户外',
//    '{__GLOBAL_APPLICATION_URL__}'  => 'http://localhost/kllife/home', //本地
//    '{__GLOBAL_HOST_URL__}'         => 'http://localhost/', //本地
//    '{__GLOBAL_APPLICATION_URL__}'=> 'http://youzan.lechikeji.com/kllife', //nginx测试
//    '{__GLOBAL_HOST_URL__}'  		=> 'http://youzan.lechikeji.com/', //nginx测试
    '{__GLOBAL_APPLICATION_URL__}'  => 'http://kllife.com/home',
    '{__GLOBAL_HOST_URL__}'         => 'http://kllife.com/',
    '{__GLOBAL_VERSION__}'          => MB_VERSION,
    '{__GLOBAL_HOST__}'             => '领袖户外',
    '{__GLOBAL_BEIAN__}'            => '陕ICP备14011728号-1',
    '{__GLOBAL_ABOUT_URL__}'        => 'http://kllife.com',
    '{__GLOBAL_ABOUT__}'            => '关于',
    '{__GLOBAL_HELP_URL__}'         => 'http://kllife.com',
    '{__GLOBAL_HELP__}'             => '帮助',
);

return $c;
?>