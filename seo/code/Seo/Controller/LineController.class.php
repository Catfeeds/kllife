<?php
namespace Seo\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackLineHelp;
use Core\Model\BackAccountHelp;

define('LINE_ARTICLE_LIST_SHOW_COUNT', 10);

class LineController extends SeoBaseController {
		
	// 创建文章
	private function createArticle($requestType, $aa) {				
		if ($requestType == 'post') {
			
			$articleObj = ModelBase::getInstance('seo_article');
			$colNames = $articleObj->getUserDefine(ModelBase::DF_COL_NAMES);
			
			$ds = coll_elements_giveup($colNames, $aa);
			if (!empty($ds['keywords'])) {				
				$ds['keywords'] = str_replace('，', ',',$ds['keywords']);
			}	
						
			if (empty($ds['id'])) {
				$data['cols'] = $colNames;
				if (empty($ds['title'])) {
					$data['result'] = error(-1, '标题不能为空');
					$this->ajaxReturn($data);
				}
				
				$count = $articleObj->getCount(appendLogicExp('title', '=', $ds['title']));
				if ($count > 0) {
					$data['result'] = error(-1, '该标题的文章已经存在');
					return $this->ajaxReturn($data);
				}			
				
				$account = MyHelp::getLoginAccount(false);
				if (is_error($account) === true) {
					$data['result'] = error(-1, '账户未登陆');
					$data['jumpUrl'] = U('User/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI'])));
					return $this->ajaxReturn($data);
				}
				
				$ds['account_type_id'] = $account['account_type']['id'];
				$ds['account_id'] = $account['id'];
				$ds['create_time'] = fmtNowDateTime();
				
				$data['result'] = $articleObj->create($ds, $articleId);
				$data['id'] = $articleId;
			} else {
				if (array_key_exists('title', $ds)) {
					if (empty($ds['title'])) {
						$data['result'] = error(-1, '标题不能为空');
						$this->ajaxReturn($data);
					}
				}
				
				$data['id'] = $ds['id'];
				$conds = appendLogicExp('id', '=', $ds['id']);
				unset($ds['id']);
				$data['result'] = $articleObj->modify($ds,$conds);
			}			
			$this->ajaxReturn($data);			
		} else {	
			if (!empty($aa['id'])) {
				$conds = appendLogicExp('id', '=', $aa['id']);
				$find = array('content'=>1);
				$article = BackLineHelp::getSeoArticle($conds, $find);
				$this->assign('article', $article);
			}
			
			$this->_initFloatImageSelector();
			$this->showPage('article_new', 'line', 'line_article', '编辑文章', '编辑文章');
		}
	}
	
	// 显示文章
	private function listArticle($requestType, $aa) {
		if ($requestType == 'post') {
			$pageIndex = empty($aa['page']) ? 0 : $aa['page'];
			$startIndex = $pageIndex * LINE_ARTICLE_LIST_SHOW_COUNT;
		} else {
			$startIndex = 0;
		}
		
		$conds = appendLogicExp('invalid', '!=', '1', 'AND', $conds);
		
		$sort = array('id'=>'desc', 'create_time'=>'desc');
		$fill = array('content'=>1);
		$articles = BackLineHelp::getSeoArticleList($conds, $startIndex, LINE_ARTICLE_LIST_SHOW_COUNT, $total, $sort, $fill);
		// 页数
		$pageCount = intval($total / LINE_ARTICLE_LIST_SHOW_COUNT);
		if (intval($total % LINE_ARTICLE_LIST_SHOW_COUNT) > 0) {
			$pageCount += 1;
		}
		
		if ($requestType == 'post') {			
			$data['conds'] = $conds;
			$data['total'] = $total;
			$data['pindex'] = $startIndex;
			$data['pcount'] = LINE_ARTICLE_LIST_SHOW_COUNT;
			$data['sort'] = $sort;
			$data['fill'] = $fill;
			
			$data['result'] = error(0, '');
			if ($total > 0) {
				$data['ds'] = $articles;
				$data['page_count'] = $pageCount;
			} else {
				$data['result'] = error(-1, '没有找到相应文章');
			}
			return $this->ajaxReturn($data);
		} else {
			$this->assign('articles', $articles);
			$this->assign('page_count', $pageCount);
			$this->showPage('article_list', 'line', 'line_article', '文章列表', '优化系统');
		}
	}
	
	// 移除隐藏文章显示
	private function removeArticle($requestType, $aa) {
		if ($requestType == 'post') {
			if (check_grant('article_system') === false) {
				$data['result'] = error(-1, '您没有此操作权限');
				return $this->ajaxReturn($data);
			}
			if (empty($aa['id'])) {
				$data['result'] = error(-1, '参数不齐全不能移除文章');
				return $this->ajaxReturn($data);
			}
			
			$ds['invalid'] = 1;
			$articleObj = ModelBase::getInstance('seo_article');
			$data['result'] = $articleObj->modify($ds, appendLogicExp('id', '=', $aa['id']));
			$this->ajaxReturn($data);
		} else {
			$errPageData = errorPage('404', '错误', '找不到页面', '您所请求的页面走丢了');
			$this->assign('err', $errPageData);
			$this->display('index/error');
		}
	}
	
	// 显示文章预览界面
	private function articleShow($aa) {
		if (empty($aa['id'])) {
			$errPageData = errorPage('501', '错误', '参数错误', '找不到所请求的文章信息');
			$this->assign('err', $errPageData);
			$this->display('index/error');
		}
		
		$article = BackLineHelp::getSeoArticle(appendLogicExp('id', '=', $aa['id']), true);
		$this->assign('article', $article);
		
		$this->showPage('article_show', 'line', 'line_article', '文章系统', '文章预览');
	}
	
	// 文章系统
	public function articleAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'create') {
				$this->createArticle('post', $_POST);
			} else if ($type == 'list') {
				$this->listArticle('post', $_POST);
			} else if ($type == 'bind_line') {
				$this->articleBindLine('post', $_POST);
			} else if ($type == 'remove') {
				$this->removeArticle('post', $_POST);
			} else {
				$data['result'] = error('错误的请求类型');
				$this->ajaxReturn($data);
			}			
		} else {
			$type = I('get.type', false);
			if ($type == 'list') {
				$this->listArticle('get');
			} else if ($type == 'create') {
				$this->createArticle('get',$_GET);
			} else if ($type == 'show') {
				$this->articleShow($_GET);
			} else {
				$errPageData = errorPage('404', '错误', '找不到页面', '找不到所请求的页面');
				$this->assign('err', $errPageData);
				$this->display('index/error');
			}
		}
	}
	 	
}

?>