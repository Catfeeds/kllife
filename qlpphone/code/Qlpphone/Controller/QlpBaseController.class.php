<?php

namespace Qlpphone\Controller;
use Think\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackLineHelp;
use Core\Model\BackFinancialHelp;

define('UNLOGIN_URL', U('user/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI']))));

abstract class QlpBaseController extends Controller {
	
	// 当前页面标题
	protected $page_title = "";
	// 当前激活的菜单
	protected $menu_active = "";
	// 当前激活的菜单项
	protected $menu_current = "";	
	// 目录链接
	protected $menu_link = array();
	
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
		
		// 获取轻旅拍首页设置
		$sets = S('qlp_phone_home_set');
		if (empty($sets) || MyHelp::checkConfigOverdue('qlp_pc_home_index', $sets['config_update_time']) === true) {
			$conds = appendLogicExp('type', '=', 'qlp_pc_home_index');
			$sets = MyHelp::getSet($conds);
			$sets['config_update_time'] = MyHelp::getConfigUpdateTime('qlp_pc_home_index');
			S('qlp_phone_home_set', $sets, 0);
		}
		$this->assign('set', $sets);
					
		// 获取前台设置		
		$pcset = S('pc_set');
		if (empty($pcset) || MyHelp::checkConfigOverdue('pc_set', $pcset['config_update_time']) === true) {
			$conds = appendLogicExp('type', '=', 'pc_set');
			$pcset = MyHelp::getSet($conds, 0, 0, $total, array('sort'=>'asc'));
			S('pc_set', $pcset, 0);
		}
		$this->assign('pcset', $pcset);
		
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
		$action_page = strtolower(CONTROLLER_NAME.'_'.$page);
		$pageKeywordObj = ModelBase::getInstance('page_keywords');
		$conds = appendLogicExp('type', '=', 'qinglvpai');
		$conds = appendLogicExp('page', '=', $action_page, 'AND', $conds);
		$pageKeyword = $pageKeywordObj->getOne($conds);
		if (!empty($pageKeyword)) {
			if ($action_page == 'line_content' || $action_page == 'line_main_content') {
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
				$searchval = '';
				$cdsstr = session('line_search_conditions');
				if (!empty($cdsstr)) {
					$cdList = explode('|',$cdsstr);
					if (count($cdList) > 4) {
						$searchval = str_replace('%', '', $cdList[2]);
					}
				}
				$pageKeyword['title'] = str_replace('{searchval}', $searchval, $pageKeyword['title']);
				$pageKeyword['keywords'] = str_replace('{searchval}', $searchval, $pageKeyword['keywords']);
			} else if ($action_page == 'leader_info') {
				$id = I('get.id', 0);
				if (!empty($id)) {
					$leader = BackFinancialHelp::getSource('leader', appendLogicExp('id', '=', $id), true);
					if (!empty($leader)) {
						$pageKeyword['title'] = str_replace('{name}', $leader['name'], $pageKeyword['title']);
						$pageKeyword['title'] = str_replace('{nickname}', $leader['nickname'], $pageKeyword['title']);
						$pageKeyword['title'] = str_replace('{stagename}', $leader['stagename'], $pageKeyword['title']);
						$pageKeyword['keywords'] = str_replace('{name}', $leader['name'], $pageKeyword['keywords']);
						$pageKeyword['keywords'] = str_replace('{nickname}', $leader['nickname'], $pageKeyword['keywords']);
						$pageKeyword['keywords'] = str_replace('{stagename}', $leader['stagename'], $pageKeyword['keywords']);
						$pageKeyword['description'] = str_replace('{name}', $leader['name'], $pageKeyword['description']);
						$pageKeyword['description'] = str_replace('{nickname}', $leader['nickname'], $pageKeyword['description']);
						$pageKeyword['description'] = str_replace('{stagename}', $leader['stagename'], $pageKeyword['description']);
						$pageKeyword['description'] = str_replace('{intro}', $leader['intro'], $pageKeyword['description']);
					}
				}
			} else if ($action_page == 'line_article_info' || $action_page == 'article_info') {
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
			}		
		}
		// 产品专题
		if ($action_page == 'line_subject') {				
			$id = I('get.id', false);
			if (!empty($id)) {
				$conds = appendLogicExp('id', '=', $id);
				$subject = BackLineHelp::getSubject($conds, false);
				if (is_error($subject) === false) {
					$pageKeyword['title'] = $subject['title'];
					$pageKeyword['keywords'] = $subject['keywords'];
					$pageKeyword['description'] = $subject['desc'];
				}
			}
		}
		$this->assign('action_page', $action_page);
		$this->assign('PageKeyword', $pageKeyword);	
	}
		
	// 显示页面
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
	
	// 显示错误页面
	protected function showError($errno, $title, $content, $reason, $suggest='您可以点击返回到上一步的操作，或是回到首页') {
//		$err = errorPage($errno, $title, $content, $reason, $suggest);
		$err = errorPage($errno, '亲，世界太大总会迷路', '幸好还有每刻美在你身边！', '', $suggest);
		$this->assign('err', $err);	
		$this->showPage('Common/error',C('MENU_CURRENT'),C('MENU_ACTIVE'),'走得再远也有摄影师相伴-每刻美跟拍游'.C('PAGE_TITLE'),C('CONTENT_TITLE'),C('CONTENT_DESC'));
	}
}

?>