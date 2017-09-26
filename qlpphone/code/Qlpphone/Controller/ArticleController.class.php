<?php
namespace Qlpphone\Controller;
use Think\Controller;
use Core\Model\MyHelp;
use Core\Model\ModelBase;
use Core\Model\BackLineHelp;

define('ARTICLE_PAGE_SHOW_COUNT', 16);

class ArticleController extends QlpBaseController {
		
	public function listAction() {
		if (IS_POST) {
			$pageIndex = empty($aa['page']) ? 0 : $aa['page'];
			$startIndex = $pageIndex * ARTICLE_PAGE_SHOW_COUNT;
		} else {
			$startIndex = 0;
		}
		
		// 查询条件
//		if (!empty($aa['cds'])) {
//			$cds = explode('|', $aa['cds']);
//			for ($i = 0; i < count($cds); $i += 2) {
//				$cdList[$cds[$i]] = $cds[$i+1];	
//			}
//			MyHelp::filterInvalidConds($cdList);
//			$articleObj = ModelBase::getInstance('article');
//			$colNames = $articleObj->getUserDefine(ModelBase::DF_COLNAMES);
//			$cols = coll_elements_giveup($colNames, $cdList);
//			$conds = MyHelp::getLogicExp($cols, '=', 'AND');
//			if (!empty($cdList['cnt'])) {
//				$conds = appendLogicExp('content', 'LIKE', '%'.$cdList['cnt'].'%', 'AND', $conds);
//			}
//		}
		$conds = appendLogicExp('qinglvpai', '>', '0', 'AND', $conds);
		$conds = appendLogicExp('invalid', '!=', '1', 'AND', $conds);		
		$sort = array('recommend'=>'desc', 'hot'=>'desc', 'agree'=>'desc', 'read'=>'desc', 'create_time'=>'desc');
		$fill = array('content'=>1);
		$articles = BackLineHelp::getArticleList($conds, $startIndex, ARTICLE_PAGE_SHOW_COUNT, $total, $sort, $fill);
		// 页数
		$pageCount = intval($total / ARTICLE_PAGE_SHOW_COUNT);
		if (intval($total % ARTICLE_PAGE_SHOW_COUNT) > 0) {
			$pageCount += 1;
		}
		
		if (IS_POST) {			
			$data['page_size'] = ARTICLE_PAGE_SHOW_COUNT;			
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
			$this->assign('page_size', ARTICLE_PAGE_SHOW_COUNT);
			
			$this->_initTemplateInfo();
			$this->showPage('list', 'article_list', 'article', '旅拍作品-新旅拍');
		}
	}
	
	public function infoAction() {
		$id = I('get.id', 0);
		if (!empty($id)) {
			$article = BackLineHelp::getArticle(appendLogicExp('id', '=', $id), true);
			if (empty($article)) {
				return $this->showError('404', '作品不存在', '作品已过期', '该作品可能已过期或者已被删除');
			}
			$this->assign('article', $article);
			$this->showPage('info', 'article_info', 'article', '作品详细-新旅拍');
		} else {
			return $this->showError('404', '参数错误', '参数不足，不能找到相关信息', '不能找到相关信息');
		}
	}
}

?>