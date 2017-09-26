<?php
/**
 * 行为嵌入点定义
 */
$tags = array();
//$tags['app_init'][] = 'Common\Behaviors\AppInitBehavior';

if(defined('IN_DESK') && IN_DESK === true) {
//    $tags['view_begin'][]       = 'App\Behaviors\AuthBehavior';
} else {
    $tags['view_begin'][]       = 'Common\Behaviors\WebTemplateBehavior';
    $tags['action_begin'][]     = 'Common\Behaviors\BackAuthorBehavior';
    $tags['action_end'][]     = 'Common\Behaviors\ActionEndBehavior';
}

return $tags;
?>