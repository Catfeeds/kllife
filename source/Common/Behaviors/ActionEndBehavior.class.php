<?php
/**
 * 会话处理
 */
namespace Common\Behaviors;
use Core\Model\MyLog;

class ActionEndBehavior {
		
    public function run(&$params) { 
    
    	if (MODULE_NAME == 'Back') {
    		// 内存消耗
	    	$mu = memory_get_usage();
	    	$memeryConsumption = floatval($mu / 1024);
	    	
	    	// 执行耗时
	    	G('end');
	    	$spendTime = G('begin', 'end');
	    	$spendMemery = G('begin', 'end', 'm');
	    	MyLog::INFO('本次执行内存消耗：'.$memeryConsumption.'KB,共计耗时'.$spendTime.'秒,共计内容消耗：'.$spendMemery.'KB');
		}
    }
}

?>