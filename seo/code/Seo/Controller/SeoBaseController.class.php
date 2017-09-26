<?php

namespace Seo\Controller;
use Think\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;

define('UNLOGIN_URL', U('User/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI']))));

abstract class SeoBaseController extends Controller {
	
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
				$user['phone_show'] = substr($user['phone'], 0, '3').'****'.substr($user['phone'], 7);
			}
			$this->assign('user', $user);	
		}	
					
		C('PAGE_TITLE', $this->page_title);
		C('MENU_ACTIVE', $this->menu_active);
		C('MENU_CURRENT', $this->menu_current);
		C('MENU_LINK', $this->menu_link);
	}
	
	// 初始化图片选择浮动层
	protected function _initFloatImageSelector() {	
		// 图片类型
		$imageTypeObj = ModelBase::getInstance('image_type');
		$imageTypes = $imageTypeObj->getAll();
		$this->assign('ImageTypes', $imageTypes);	
		
		// 图片来源
		$fromTypeObj = ModelBase::getInstance('image_from_type');
		$fromTypes = $fromTypeObj->getAll();
		$this->assign('ImageFroms', $fromTypes);			
		
		// 内容类型
		$contentTypeObj = ModelBase::getInstance('image_content_type');			
		$contentTypes = $contentTypeObj->getAll();
		$this->assign('ImageContents', $contentTypes);
		
		// 地域类型
		$domainItemTypeId = MyHelp::IdEachTypeKey('menu_type', 'region_menu');
		if (is_error($domainItemTypeId) === false) {
			$domainTypeObj = ModelBase::getInstance('menu_item');
			$conds = appendLogicExp('menu_type_id', '=', $domainItemTypeId);
			$conds = appendLogicExp('parent_id', '=', '0', 'AND', $conds);
			$domainTypes = $domainTypeObj->getAll($conds);
			$this->assign('ImageDomains', $domainTypes);
		}
		$this->assign('modal_upload_image', true);
		$this->assign('modal_select_image', true);
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
		return $this->display($page);
	}
	
	// 显示错误页面
	protected function showErrorPage($errno, $title, $content, $reason, $suggest='您可以点击返回到上一步的操作，或是回到首页') {
		$err = errorPage($errno, $title, $content, $reason, $suggest);
		$this->assign('err', $err);
		$this->display('Common/error');
	}
}

?>