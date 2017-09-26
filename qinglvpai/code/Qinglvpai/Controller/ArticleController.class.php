<?php
namespace Qinglvpai\Controller;
use Think\Controller;
use Core\Model\MyHelp;
use Core\Model\ModelBase;
use Core\Model\BackLineHelp;

define('ARTICLE_PAGE_SHOW_COUNT', 12);

class ArticleController extends QlpBaseController {
	
	// 查找旅拍作品列表
	private function listArticle($requestType) {
		if ($requestType == 'post') {
			$page = I('post.page', 0);
			$cds = I('post.cds', false);
			if (!empty($cds)) {
				$cdList = explode('|', $cds);	
				for ($i = 0; $i < count($cdList); $i+=3) {
					$conds = appendLogicExp($cdList[$i], $cdList[$i+1], $cdList[$i+2], 'AND', $conds);
				}
			}			
		} else {
			$page = I('get.page', 0);
		}
		
		$startIndex = $page * ARTICLE_PAGE_SHOW_COUNT;
		$conds = appendLogicExp('qinglvpai', '>', '0', 'AND', $conds);
		$conds = appendLogicExp('invalid', '=', '0', 'AND', $conds);
		$sort = array('recommend'=>'desc', 'hot'=>'desc', 'agree'=>'desc', 'read'=>'desc', 'create_time'=>'desc');
		$ds = BackLineHelp::getArticleList($conds, $startIndex, ARTICLE_PAGE_SHOW_COUNT, $total, $sort, true);
		
		$pageCount = intval($total / ARTICLE_PAGE_SHOW_COUNT);
		if (intval($total % ARTICLE_PAGE_SHOW_COUNT) > 0) {
			$pageCount += 1;
		}
		
		if ($requestType == 'get') {
			$this->assign('conds', $conds);
			$this->assign('page_count', $pageCount);
			$this->assign('articles', $ds);
			$this->assign('page_size', ARTICLE_PAGE_SHOW_COUNT);	
			$this->showPage('list', 'article_list', 'article', '旅拍作品');
		} else {
			$data['result'] = error(0,'');
			$data['ds'] = $ds;
			$data['page_count'] = $pageCount;
			$data['page_size'] = ARTICLE_PAGE_SHOW_COUNT;
			$this->ajaxReturn($data);
		}
	}
	
	// 查找旅拍作品
	private function findArticle($requestType) {
		if ($requestType == 'post') {
			$id = I('post.id', false);
			if (empty($id)) {
				$data['result'] = error(-1, '查找的参数不足');
				return $this->ajaxReturn($data);
			}
			
			$conds = appendLogicExp('id', '=', $id);
			$ds = BackLineHelp::getArticle($conds, true);
			
			$imageTextList = array();
			if (!empty($ds['content'])) {
				foreach ($ds['content'] as $ck=>$cv) {
					if (empty($cv['content'])) {
						if (!empty($imageList['image'])) {
							array_push($imageTextList, $imageList);
						}
						$imageList = array('image'=>$cv['image_url']);
					} else {
						if (empty($imageList['text'])) {
							$imageList['text'] = $cv['content'];
						} else {					
							$imageList['text'] = $imageList['text'].'<br />'.$cv['content'];
						}
					}
				}	
			}
			if (!empty($imageList)) {
				array_push($imageTextList, $imageList);
			}
			$ds['image_text_list'] = $imageTextList;			
			$data['result'] = error(0,'');
			$data['ds'] = $ds;
			
			$this->ajaxReturn($data);
		}
	}
	
	public function listAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'list') {
				$this->listArticle('post');
			} if ($type == 'find') {
				$this->findArticle('post');
			} else {
				$data['result'] = error(-1, '错误的处理类型');
				return $this->ajaxReturn($data);	
			}
		} else {
			$this->listArticle('get');
		}
	}
	
	public function infoAction() {
		$id = I('get.id', false);
		if (empty($id)) {
			return $this->showError('501', '参数错误', '参数错误，页面无法正常显示');
		}
		$this->assign('id', $id);
		$this->showPage('info', 'article_info', 'article', '旅拍作品详细');
	}
}

?>