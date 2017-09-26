<?php

namespace Home\Controller;
use Think\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackLineHelp;

define('UNLOGIN_URL', U('user/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI']))));

abstract class HomeBaseController extends Controller {
	
	// 当前页面标题
	protected $page_title = "";
	// 当前激活的菜单
	protected $menu_active = "";
	// 当前激活的菜单项
	protected $menu_current = "";	
	// 目录链接
	protected $menu_link = array();
	
	// 空访问
	public function _empty($name) {
		$name = str_replace('Action', '', $name);
		$this->showPage($name);
	}	
	
	// 设置当前菜单链接
	protected function _setMenuLinkCurrent($menuText, $menuPage) {
		$this->menu_current = $menuPage;
		$this->menu_link = array(
			'f' => array(
				'mt'	=> '首页', 
				'lk'	=> C('TMPL_PARSE_STRING.{__GLOBAL_APPLICATION_URL__}')
			),
			's'	=> array(
				'mt'	=> $this->page_title, 
				'lk'	=> U(CONTROLLER_NAME)//C('TMPL_PARSE_STRING.{__GLOBAL_APPLICATION_URL__}').'/'.CONTROLLER_NAME
			),
			't'	=> array(
				'mt'	=> $menuText, 
				'lk'	=> C('TMPL_PARSE_STRING.{__GLOBAL_HOST_URL__}').U(CONTROLLER_NAME.'/'.$menuPage)
			)
		);
	}
	
	// 初始化模板显示的相关信息
	protected function _initTemplateInfo() {
		// 用户登录信息				
		$user = MyHelp::getLoginAccount(false);
		if (is_error($user) === false) {
			if (!empty($user['phone']) && strlen($user['phone']) == 11) {
				if (empty($user['phone_show'])) {
					$user['phone_show'] = substr($user['phone'], 0, '3').'****'.substr($user['phone'], 7);	
				}
			}
			if (!empty($user['name'])) {
				if (empty($user['name_show'])){
					$user['name_show'] = mb_substr($user['name'], 0, 1, 'utf8').'**';
				}
			}
			
			if (empty($user['show_name'])) {
				if (!empty($user['name_show'])){
					$user['show_name'] = $user['name_show'];
				} else if (!empty($user['phone_show'])){
					$user['show_name'] = $user['phone_show'];
				} else if (!empty($user['email'])){
					$user['show_name'] = $user['email'];
				} else if (!empty($user['nickname'])){
					$user['show_name'] = $user['nickname'];
				} else if (!empty($user['username'])){
					$user['show_name'] = $user['username'];
				}
			}
			$this->assign('user', $user);	
		}	
		
		// 获取当前站点			
		$curStation = MyHelp::getStationByIP();
		$this->assign('station', $curStation);	
		
		// 获取所有站点
		$stationObj = ModelBase::getInstance('station_info');
		$stations = $stationObj->getAll();
		$this->assign('stations', $stations);
		
		
		// 底部问题链接
		$questType = S('pc_home_bottom_question');
		if (empty($questType) || MyHelp::checkConfigOverdue('pc_home_top_menu', $questType['config_update_time']) === true) {
			$questClass = array(
				'question_type_regist_login'=>'',
				'question_type_activity'=>'',
				'question_type_pay'=>'',
				'question_type_offen'=>'clear-footer-content-marginLeft',
			);
			
			$questType = array();
			$quest_type = MyHelp::getTypeData('question_type');
			if (is_error($quest_type) === false) {
				foreach ($quest_type as $qk=>$qv) {					
					if (!array_key_exists($qv['type_key'], $questClass)) {
						continue;
					}
					$conds = appendLogicExp('type_id', '=', $qv['id']);
					$conds = appendLogicExp('question_id', '=', '0', 'AND', $conds);
					$questions = BackLineHelp::getQuestionList($conds, 0, 5, $total, array('create_time'), false);
					$qv['questions'] = $questions;
					$qv['class'] = $questClass[$qv['type_key']];					
					array_push($questType, $qv);									
				}
			}		
			$questType['config_update_time'] = MyHelp::getConfigUpdateTime('pc_home_bottom_question');
			S('pc_home_bottom_question', $menuItems, 0);
		}
		$this->assign('question_type', $questType);	
		
		// 获取首页菜单
		$menuItems = S('pc_home_top_menu');
		if (empty($menuItems) || MyHelp::checkConfigOverdue('pc_home_top_menu', $menuItems['config_update_time']) === true) {
			$menuItems = MyHelp::getMenuList('pc_home_menu', 0, true, false, $out);
			foreach ($menuItems as $mk=>$mv) {
				$curWord = 0;
				foreach ($mv['child'] as $ck=>$cv) {
					$len = mb_strlen($cv['item_desc'] ,'utf8');
					$curWord += $len;
					if ($curWord > 24) {
						$cv['left_menu_not_show'] = true;
					}
					$mv['child'][$ck] = $cv;
				}
				$leftMenuItems[$mk] = $mv;
			}
			$menuItems['config_update_time'] = MyHelp::getConfigUpdateTime('pc_home_top_menu');
			S('pc_home_top_menu', $menuItems, 0);
		}
		$this->assign('menus', $menuItems);
		
		// 获取专题设置
		$config_subject = S('pc_home_index_subject');
		$sets = session('pc_home_index_set');
		foreach ($sets as $setKey=>$setVal) {
			if (strpos($setKey,'zhuanti') !== false) {
				$config_subject[$setKey] = $setVal;
			}
			if (strpos($setKey, 'cs_tel') !== false) {
				$cs_tel = $setVal;
			}
			if (strpos($setKey, 'lunbo') !== false) {
				$lunbo[$setKey] = $setVal;
			}	
		}
		$this->assign('cs_tel', $cs_tel);
		$this->assign('lunbo', $lunbo);		
		if (empty($config_subject) || MyHelp::checkConfigOverdue('pc_home_index', $config_subject['config_update_time']) === true) {
			$conds = appendLogicExp('station_id', '=', '1');
			$conds = appendLogicExp('type', '=', 'pc_home_index', 'AND', $conds);
			$conds = appendLogicExp('key', 'LIKE', 'zhuanti%', 'AND', $conds);
			$config_subject = MyHelp::getSet($conds,0,0,$total,array('sort'=>'asc'));
			$config_subject['config_update_time'] = MyHelp::getConfigUpdateTime('pc_home_index');
			S('pc_home_index_subject', $config_subject, 0);
		}
		$this->assign('set_subjects', $config_subject);
		
		// 获取轻旅拍首页设置
		$qlp_sets = S('qlp_pc_home_set');
		if (empty($qlp_sets) || MyHelp::checkConfigOverdue('qlp_pc_home_index', $qlp_sets['config_update_time']) === true) {
			$conds = appendLogicExp('type', '=', 'qlp_pc_home_index');
			$qlp_sets = MyHelp::getSet($conds);
			$qlp_sets['config_update_time'] = MyHelp::getConfigUpdateTime('qlp_pc_home_index');
			S('qlp_pc_home_set', $qlp_sets, 0);
		}
		$this->assign('qlp_set', $qlp_sets);
		
		// 获取前台设置		
		$pcset = S('pc_set');
		if (empty($pcset) || MyHelp::checkConfigOverdue('pc_set', $pcset['config_update_time']) === true) {
			$conds = appendLogicExp('type', '=', 'pc_set');
			$pcset = MyHelp::getSet($conds, 0, 0, $total, array('sort'=>'asc'));
			S('pc_set', $pcset, 0);
		}
		$this->assign('pcset', $pcset);
		
		// 获取顶部左侧链接		
		$pcset_top_link = S('pc_set_top_link');
		if (empty($pcset_top_link) || MyHelp::checkConfigOverdue('pc_set', $pcset_top_link['config_update_time']) === true) {
			$setObj = ModelBase::getInstance('set');
			$conds = appendLogicExp('type', '=', 'pc_set', 'AND');
			$conds = appendLogicExp('key', 'like', 'top_link_friend_link%', 'AND', $conds);					
			$pcset_top_link = $setObj->getAll($conds, 0, 0, $total, array('sort'=>'asc'), $out);
			S('pc_set_top_link', $pcset_top_link, 0);
		}
		$this->assign('pcset_top_link', $pcset_top_link);
		
		// 设置页面随机码
		$rd = substr(uniqid(rand()), -6);
		session_start();
		session('page_rand', $rd);
		$this->assign('pagerd', $rd);
							
		C('PAGE_TITLE', $this->page_title);
		C('MENU_ACTIVE', $this->menu_active);
		C('MENU_CURRENT', $this->menu_current);
		C('MENU_LINK', $this->menu_link);
	}
	
	// 页面关键字设置
	private function configPageKeywords($page) {
		session_start();
		$action_page = strtolower(CONTROLLER_NAME.'_'.$page);
		$pageKeywordObj = ModelBase::getInstance('page_keywords');
		$conds = appendLogicExp('type', '=', 'main');
		if ($action_page == 'index_welcome') {
			$station = session('station');
			if (!empty($station)) {
				$action_page = 'location_'.$action_page;
			}
		}
		$conds = appendLogicExp('page', '=', $action_page, 'AND', $conds);
		$pageKeyword = $pageKeywordObj->getOne($conds);
		if (!empty($pageKeyword)) {
			if ($action_page == 'location_index_welcome') {
				$stationName = $station['name'];
				if ($stationName == '主站') {
					$stationName = '领袖户外';
				}
				$pageKeyword['title'] = str_replace('{station_name}', $stationName, $pageKeyword['title']);
				$pageKeyword['keywords'] = str_replace('{station_name}', $stationName, $pageKeyword['keywords']);
				$pageKeyword['description'] = str_replace('{station_name}', $stationName, $pageKeyword['description']);				
			} else if ($action_page == 'line_list') {
				$navData = session('line_navigation_data');
				if (empty($navData)) {
					$navstr = '';
				} else {
					foreach ($navData as $nav){
						if (!empty($navstr)) {
							$navstr .= ',';
						}
						$navstr .= $nav['item_desc'];	
					}
				}
				
				$pageKeyword['title'] = str_replace('{nav}', $navstr, $pageKeyword['title']);
				$pageKeyword['keywords'] = str_replace('{nav}', $navstr, $pageKeyword['keywords']);
				$pageKeyword['description'] = str_replace('{nav}', $navstr, $pageKeyword['description']);				
			} else if ($action_page == 'line_content' || $action_page == 'line_qlp_content') {
				$id = I('get.id', 0);
				$line = BackLineHelp::getLine(appendLogicExp('id', '=', $id));
				if (!empty($line)) {
					$pageKeyword['title'] = str_replace('{title}', $line['title'], $pageKeyword['title']);
					$pageKeyword['title'] = str_replace('{subheading}', $line['subheading'], $pageKeyword['title']);
					$pageKeyword['keywords'] = str_replace('{view_point}', $line['view_point_show_text'], $pageKeyword['keywords']);
					$pageKeyword['description'] = str_replace('{destination}', $line['destination_show_text'], $pageKeyword['description']);
					$pageKeyword['description'] = str_replace('{view_point}', $line['view_point_show_text'], $pageKeyword['description']);
					$pageKeyword['description'] = str_replace('{send_word}', $line['send_word'], $pageKeyword['description']);
				}
			} else if ($action_page == 'line_search') {		
				$searchval = session('line_search_val');
				$pageKeyword['title'] = str_replace('{searchval}', $searchval, $pageKeyword['title']);
				$pageKeyword['keywords'] = str_replace('{searchval}', $searchval, $pageKeyword['keywords']);
			} else if ($action_page == 'line_article_info') {
				$id = I('get.id', 0);
				if (!empty($id)) {
					$article = BackLineHelp::getArticle(appendLogicExp('id', '=', $id), true);
					if (!empty($article)) {
						$pageKeyword['title'] = str_replace('{title}', $article['title'], $pageKeyword['title']);
						$pageKeyword['keywords'] = str_replace('{keywords}', $article['keywords'], $pageKeyword['keywords']);
						$pageKeyword['description'] = str_replace('{send_word}', $article['send_word'], $pageKeyword['description']);
					}
				}
			} else if ($action_page == 'service_question') {				
				$id = I('get.id', false);
				if (!empty($id)) {
					$conds = appendLogicExp('id', '=', $id);
					$question = BackLineHelp::getQuestion($conds, false);
					if (is_error($question) === false) {
						$pageKeyword['title'] = str_replace('{content}', $question['content'], $pageKeyword['title']);
					}
				}
			} else if ($action_page == 'line_subject') {	// 产品专题
				$id = I('get.id', false);
				if (!empty($id)) {
					$conds = appendLogicExp('id', '=', $id);
					$subject = BackLineHelp::getSubject($conds, false);
					if (is_error($subject) === false) {
//						$pageKeyword['title'] = str_replace('{title}', $subject['seo_title'], $pageKeyword['title']);
//						$pageKeyword['keywords'] = str_replace('{keywords}', $subject['seo_keywords'], $pageKeyword['keywords']);
//						$pageKeyword['description'] = str_replace('{subheading}', $subject['seo_desc'], $pageKeyword['description']);
						
						$pageKeyword['title'] = $subject['seo_title'];
						$pageKeyword['keywords'] = $subject['seo_keywords'];
						$pageKeyword['description'] = $subject['seo_desc'];
					}
				}
			}		
		} else {
			$pageKeyword = array('title'=>'好玩不贵的小团慢旅行-领袖户外旅行网', 'keywords'=>'小团慢旅行,周边游,民族行,跟拍游,领袖户外旅行网', 'description'=>'不止如此，还有更多线路-领袖户外旅行网');
		}
		$this->assign('PageKeyword', $pageKeyword);	
	}
	
	protected function showPage($page, $curMenu='', $rootMenu='', $pageTitle='', $contentTile='', $contentDesc='') {
		if (!empty($curMenu)) {
			$this->menu_current = $curMenu;
		}
		if (!empty($rootMenu)) {
			$this->menu_active = $rootMenu;
		}
		if (!empty($pageTitle)) {
			$this->page_title = $pageTitle;
		}
		if (!empty($contentTile)) {
			$this->content_title = $contentTile;
		}
		if (!empty($contentDesc)) {
			$this->content_des = $contentDesc;
		}
		$this->_initTemplateInfo();
		$this->configPageKeywords($page);
		return $this->display($page);
	}
	
	protected function showError($errno, $title, $content, $reason, $suggest) {
//		$err = errorPage($errno, $title, $content, $reason, $suggest);
		$err = errorPage($errno, '亲，', '世界太大总会迷路', '幸好还有领袖户外在你身边！', $suggest);
		$this->assign('err', $err);
		$this->showPage('Common/error',C('MENU_CURRENT'),C('MENU_ACTIVE'),'错误'.C('PAGE_TITLE'),C('CONTENT_TITLE'),C('CONTENT_DESC'));
	}
}

?>