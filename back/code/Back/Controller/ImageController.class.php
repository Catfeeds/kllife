<?php

namespace Back\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackImageHelp;

define('IMAGE_PAGE_SHOW', 16);

class ImageController extends BackBaseController {
	
	protected function _initialize(){		
		$this->page_title = '图片库';
		$this->content_title_show = 0;
	}
	
	private function filterConds($cds) {
		$cdList = array();				
		foreach ($cds as $k=>$v) {
			switch($k){
				case 'title': $cdList['title_like'] = $v; break;
				case 'author': $cdList['author_like'] = $v; break;
				case 'type_id': $cdList['type_id'] = $v; break;
				case 'from_type_id': $cdList['from_type_id'] = $v; break;
				case 'content_type_id': $cdList['content_type_id'] = $v; break;
				case 'domain_type_id': $cdList['domain_type_id'] = $v; break;
				case 'district_type_id': $cdList['district_type_id'] = $v; break;
				case 'distination_type_id': $cdList['distination_type_id'] = $v; break;
				case 'data_time_range':  {
					if (!empty($v)) {
						$split_pos = stripos($v, ' - ');
						$cdList['sdate'] = substr($v, 0, $split_pos); 
						$cdList['edate'] = substr($v, $split_pos+3); 	
					}
				}break;
				default: break;
			}
		}
		
		MyHelp::filterInvalidConds($cdList);
		return $cdList;
	}
	
	public function listAction() {		
		$conds = array();
		$pageIndex = 0;
		if (IS_POST) {
			$pageIndex = I('post.page_index', 0);
			// 查询条件
			$filterCDS = $this->filterConds($_POST);
			if (!empty($filterCDS)) {
				$imageObj = ModelBase::getInstance('image_info');
				$colNames = $imageObj->getUserDefine(ModelBase::DF_COL_NAMES);
				$cds = coll_elements_giveup($colNames, $filterCDS);
				$conds = MyHelp::getLogicExp($cds, '=', 'OR');
				// 图片题目
				if (!empty($filterCDS['title_like'])) {
					$conds = appendLogicExp('title', 'LIKE', '%'.$filterCDS['title_like'].'%', 'AND', $conds);
				}
				// 图片作者
				if (!empty($filterCDS['author_like'])) {
					$conds = appendLogicExp('author', 'LIKE', '%'.$filterCDS['author_like'].'%', 'AND', $conds);
				}
				// 日期段
				if (!empty($filterCDS['sdate']) && !empty($filterCDS['edate'])) {
					$dateConds = appendLogicExp('create_time', '>=', $filterCDS['sdate'], 'AND', $dateConds);
					$dateConds = appendLogicExp('create_time', '<=', $filterCDS['edate'], 'AND', $dateConds);
					$conds = appendLogicExp('', '', $dateConds, 'OR', $conds);
				}
			}
		}
		
		// 查找图片
		$startIndex = $pageIndex * IMAGE_PAGE_SHOW;
		$images = BackImageHelp::getImageList($conds, $startIndex, IMAGE_PAGE_SHOW, $total, array('create_time'=>'desc'));
		// 总页数
		$pages = intval($total / IMAGE_PAGE_SHOW);
		if (intval($total % IMAGE_PAGE_SHOW) > 0) {
			$pages += 1;
		}
		
		if (IS_POST) {
			$data['conds'] = $conds;
			$data['count'] = $total;
			$data['page_count'] = $pages;
			$data['ds'] = $images;
			$data['result'] = error('0', '');
			$this->ajaxReturn($data);
		} else {
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
			
			$this->assign('ImageCount', $total);
			$this->assign('ImageList',$images);
			$this->assign('PageCount', $pages);
			$this->assign('modal_look_image', true);
			$this->assign('modal_delete_image', true);
			$this->assign('modal_edit_image', true);			
			
			$this->_initBaseInfo('image_list', 'picture_library', '图片展示', '图片展示', '这里您展示并编辑并您的图片');
			$this->display('list');
		}
	}
	
	public function uploadAction() {
		if (IS_POST) {				
			set_time_limit(1800);
			
			$ds['title'] = I('post.title', '');
			$ds['author'] = I('post.author', '');
			$ds['intro'] = I('post.intro', '');
			$ds['create_time'] = fmtNowDateTime();
//			$ds['type_id'] = I('post.type_id', 0);
			$ds['from_type_id'] = I('post.from_type_id', 0);
			$ds['content_type_id'] = I('post.content_type_id', 0);
			$ds['tags'] = I('post.tags', '');
			$account = MyHelp::getLoginAccount(true);
			$ds['exhibitor_type_id'] = $account['account_type']['id'];
			$ds['exhibitor_id'] = $account['id'];
			$ds['domain_type_id'] = I('post.domain_type_id', 0);
			$ds['district_type_id'] = I('post.district_type_id', 0);
			$ds['distination_type_id'] = I('post.distination_type_id', 0);
			
			if (empty($_FILES)) {
				$data['result'] = error(-1, '没有可供上传的图片资源');
				return $this->ajaxReturn($data);
			}
			
			$data['result'] = error('0', '上传数据成功');
			if ($ds['title'] === '') {
				$data['result'] = error(-1, '上传文件失败，图片标题不能为空');
			} else {
				//图片上传
				$filesta = BackImageHelp::qiniuUploadFiles(array("jpg","png","gif","jpeg"));
				if(is_error($filesta) === false){
					$data['files'] = $filesta;		
					$config =C('UPLOAD_SITEIMG_QINIU');
					if($config['driver']=='Qiniu'){
						$errNo = 0; $errMsg = '';
						$imageObj = ModelBase::getInstance('image_info');
						foreach ($filesta as $fk=>$fv) {
							$ds['path'] = $fv['url'];
							$result = $imageObj->create($ds, $imageId);
							if (error_ok($result) === true) {								
								$errNo = $result['errno'];
								$errMsg = '['.'file:'.$fv['savename'].'保存失败,'.$result['errno'].','.$result['mssage'].']';
							}
						}
						$data['result'] = error($errNo, $errMsg);
					}
				}else{
					$data['result'] = error(-2, $filesta['errno'].'=>'.$filesta['message']);
				}				
			}			
			$this->ajaxReturn($data);
		} else {			
			// 图片类型
//			$imageTypeObj = ModelBase::getInstance('image_type');
//			$imageTypes = $imageTypeObj->getAll();
//			$this->assign('ImageTypes', $imageTypes);	
			
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
			
			$this->_initBaseInfo('image_upload', 'picture_library', '图片上传', '图片上传', '这里你编辑并上传多张图片');
			$this->display('upload');
		}
	}
	
	// 删除图片
	public function deleteAction() {
		if (IS_POST) {
			$ids = I('post.ids', false);
			if ($ids === false) {
				$data['result'] = error(-1, '错误的图片编号，删除失败');
				return $this->ajaxReturn($data);
			}
			if ($ids.stripos(',') == false) {
				$conds = appendLogicExp('id', '=', $ids);	
			} else {
				$conds = appendLogicExp('id', 'IN', '('.$ids.')');	
			}
			$imageObj = ModelBase::getInstance('image_info');
			$data['result'] = $imageObj->remove($conds);
			$this->ajaxReturn($data);
		} else {
			$data['result'] = error(-1, '删除的请求方式错误');
			$this->ajaxReturn($data);
		}
	}
	
	// 查找图片
	public function findAction() {
		if (IS_POST) {
			$id = I('post.id', 0);
			if ($id === 0) {
				$data['result'] = error(-1, '错误的图片编号，查询失败');
				return $this->ajaxReturn($data);
			}
			$image = BackImageHelp::getImage(appendLogicExp('id', '=', $id));
			if (is_error($image)) {
				$data['result'] = $image;
				return $this->ajaxReturn($data);
			}
			$data['ds'] = $image;
			$data['result'] = error(0,'');
			$this->ajaxReturn($data);
		} else {
			$data['result'] = error(-1, '查询图片信息的请求方式错误');
			$this->ajaxReturn($data);
		}
	}
	
	// 编辑图片信息
	public function editAction() {
		if (IS_POST) {
			$ids = I('post.ids', false);
			if ($ids == false) {
				$data['result'] = error(-1, '要更新的图片编号错误，更新失败');
				return $this->ajaxReturn($data);
			}
			if ($ids.stripos(',') == false) {
				$conds = appendLogicExp('id', '=', $ids);	
			} else {
				$conds = appendLogicExp('id', 'IN', '('.$ids.')');	
			}
			$imageObj = ModelBase::getInstance('image_info');
			$data['result'] = $imageObj->modify($_POST, $conds);
			$this->ajaxReturn($data);			
		} else {
			$data['result'] = error(-1, '更新图片信息的请求方式错误');
			$this->ajaxReturn($data);
		}
	}
	
	// 弹出框图片上传
	public function fuploadAction() {
		if (IS_POST) {
			$ds['title'] = I('post.title', '');
			$ds['author'] = I('post.author', '');
			$ds['intro'] = I('post.intro', '');
			$ds['create_time'] = fmtNowDateTime();
			$ds['type_id'] = I('post.type_id', 0);
			$ds['from_type_id'] = I('post.from_type_id', 0);
			$ds['content_type_id'] = I('post.content_type_id', 0);
			$ds['tags'] = I('post.tags', '');
			$account = MyHelp::getLoginAccount(true);
			$ds['exhibitor_type_id'] = $account['account_type']['id'];
			$ds['exhibitor_id'] = $account['id'];
			$ds['domain_type_id'] = I('post.domain_type_id', 0);
			$ds['district_type_id'] = I('post.district_type_id', 0);
			$ds['distination_type_id'] = I('post.distination_type_id', 0);
			
			if (empty($_FILES)) {
				$data['result'] = error(-1, '没有可供上传的图片资源');
				return $this->ajaxReturn($data);
			}
			
			$data['result'] = error('0', '上传数据成功');
			if ($ds['title'] === '') {
				$data['result'] = error(-1, '上传文件失败，图片标题不能为空');
			} else {
				//图片上传
				$filesta = BackImageHelp::qiniuUploadFiles(array("jpg","png","gif","jpeg"));
				if(is_error($filesta) === false){
					$data['files'] = $filesta;	
					$config =C('UPLOAD_SITEIMG_QINIU');
					if($config['driver']=='Qiniu'){
						$errNo = 0; $errMsg = '';
						$imageObj = ModelBase::getInstance('image_info');
						foreach ($filesta as $fk=>$fv) {
							$ds['path'] = $fv['url'];
							$ds['url'] = $fv['url'];
							$result = $imageObj->create($ds, $imageId);
							if (error_ok($result) === true) {								
								$errNo = $result['errno'];
								$errMsg = '['.'file:'.$fv['savename'].'保存失败,'.$result['errno'].','.$result['mssage'].']';
							}
						}	
						$data['ds'] = $ds;
						$data['result'] = error($errNo, $errMsg);
					}
				}else{
					$data['result'] = error(-2, $filesta['errno'].'=>'.$filesta['message']);
				}				
			}			
			$this->ajaxReturn($data);
			/////////////////////////////////////
//			$data['result'] = error(0,'');
//			//图片上传
//			$filesta = BackImageHelp::qiniuUploadFiles(array("jpg","png","gif","jpeg"));
//			if(is_error($filesta) === false){
//				$data['files'] = $filesta;		
//				$config =C('UPLOAD_SITEIMG_QINIU');
//				if($config['driver']=='Qiniu'){
//					foreach ($filesta as $fk=>$fv) {
//						$ds['url'] = $fv['url'];
//					}
//				}
//				$data['ds'] = $ds;
//			}else{
//				$data['result'] = error(-1, $filesta['errno'].'=>'.$filesta['message']);
//			}
		} else {
			$data['result'] = error(-1, '错误的上传方式');
		}	
		$this->ajaxReturn($data);
	}
	
	// 上传领队作品
	public function fuploadLeaderAction() {
		if (IS_POST) {
			$ds['leader_id'] = I('post.leader_id', '');
			if (empty($ds['leader_id'])) {
				$data['result'] = error(-1, '错误的领队对象');
				return $this->ajaxReturn($data);
			}
			
			$ds['title'] = I('post.title', '');
			$ds['intro'] = I('post.intro', '');
			$ds['tags'] = I('post.author', '');
			$ds['create_time'] = fmtNowDateTime();
			
			if (empty($_FILES)) {
				$data['result'] = error(-1, '没有可供上传的图片资源');
				return $this->ajaxReturn($data);
			}
			
			$data['result'] = error('0', '上传数据成功');
			if ($ds['title'] === '') {
				$data['result'] = error(-1, '上传文件失败，图片标题不能为空');
			} else {
				//图片上传
				$filesta = BackImageHelp::qiniuUploadFiles(array("jpg","png","gif","jpeg"));
				$data['filesta'] = $filesta;
				if(is_error($filesta) === false){
					$data['files'] = $filesta;	
					$config =C('UPLOAD_SITEIMG_QINIU');
					if($config['driver']=='Qiniu'){
						$errNo = 0; $errMsg = '';
						$pictureObj = ModelBase::getInstance('cj_leader_picture');
						foreach ($filesta as $pk=>$pv) {
							$ds['path'] = $pv['url'];
							$result = $pictureObj->create($ds, $imageId);
							if (error_ok($result) === true) {
								$ds['id'] = $imageId;					
								$errNo = $result['errno'];
								$errMsg = '['.'file:'.$pv['savename'].'保存失败,'.$result['errno'].','.$result['mssage'].']';
							}
						}	
						$data['ds'] = $ds;
						$data['result'] = error($errNo, $errMsg);
					}
				}else{
					$data['result'] = error(-2, $filesta['errno'].'=>'.$filesta['message']);
				}				
			}	
		} else {
			$data['result'] = error(-1, '错误的上传方式');
		}	
		$this->ajaxReturn($data);
	}
	
	// 获取附属属性的相关数据
	public function helpAction() {
		if (IS_POST) {
			$type = I('post.op_type');
			if ($type == 'get_list') {
//				MyHelp::getDataTableSearchs();
			} else {
				$data['result'] = error(-1, '错误的操作类型');
			}
		} else {			
			$errPageData = errorPage('500', '错误', '错误请求', '您请求的方式有误,错误位置:ImageController::helpAction');
			$this->assign('err', $errPageData);
			$this->display('index/error');
		}
	}
	
}

?>