<?php

/**
 * Created by CodeLobster.
 * User: PF
 * Date: 2016-7-20
 * Time: 2016-7-20 14:47:13
 */

namespace Core\Model;
use Think\Upload\Driver\Qiniu;

class BackImageHelp {	
	/**
	 * 上传文件,反回文件数组
	 * array("sta"=>false/true,"msg"=>"错误信息","files"=>array("savename"))
	 *
	 * $allow = array（"jpg","png"）
	 */
	public static function qiniuUploadFiles($allow = array()) {
	    if (!empty($_FILES)) {
	        $setting = C('UPLOAD_SITEIMG_QINIU');
	        $setting['saveRule'] = 'time';
	        $setting["allowExts"] = $allow;
	        $upload = new \Think\Upload($setting);
	        $upload->imageClassPath = "Org.Util.Image";
	        $upload->thumb = true;
	        if (!$infos = $upload->upload()) {
	       		return error(-1, $upload->getError());
	        } else {
	        	return $infos;
	        }
	    } else {
	        return error(-2, "没有选择上传文件");
	    }
	}
	
	// 微信上传
	public static function wxQiniuUploadFiles($files, $allow = array()) {
		if (empty($files)) {
			return error(-1, '没有可以上传的文件');
		}
		
        $setting = C('UPLOAD_SITEIMG_QINIU');
        $setting['saveRule'] = 'time';
        $setting["allowExts"] = $allow;
        $upload = new \Think\Upload($setting);
        $upload->imageClassPath = "Org.Util.Image";
        $upload->thumb = false;
        
        // 打开服务器临时存储的文件
        foreach ($files as $key=>$file) {
        	if (file_exists($file) === true) {
	        	$_FILES[$key]['name'] = $key;
	        	$_FILES[$key]['type'] = filetype($file);
	        	$_FILES[$key]['size'] = filesize($file);
	        	$_FILES[$key]['tmp_name'] = $file;
	        	$_FILES[$key]['error'] = UPLOAD_ERR_OK;
			}
		}
        
        if (!$infos = $upload->upload()) {
       		return error(-1, $upload->getError());
        } else {
        	// 删除服务器临时存储的文件
	        foreach ($files as $key=>$file) {
	        	if (file_exists($file)) {
		        	$_FILES[$key]['tmp_name'] = $file;
		        	$_FILES[$key]['error'] = UPLOAD_ERR_OK;
		        	unlink($files[$key]['tmp_name']);
				}			
				clearstatcache();
				unset($_FILES[$key]);
			}        	
        	return $infos;
        }
	}
/**
* 
* @param undefined $savePath
* 
* @return {
	ext: 文件扩展名,例如："jpg"
	key: 上传文件的控件名称,例如："face_file"
	md5: MD5加密,例如："9b911bd7f0df851ece1a8398f7e66de5"
	name: 上传文件名称,例如："1.jpg"
	savename: 保存文件名称,例如："587cd61eb6764.jpg"
	savepath: 保存文件路径,例如："2017-01-16/"
	sha1: 未知,例如："b13cc887ddd2fb31fdcc7857b9d09550060afdd6"
	size: 文件类型,例如：9532
	type: 文件类型,例如： "image/jpeg"
}
*/
	// 本地上传
	public static function localUploadFiles($savePath, $subName='', $saveName='', $relpceFile=false) {							
		if (IS_POST) {				
//			$savePath = C('TMPL_PARSE_STRING.__UPLOAD_REAL_PATH__');
			if (checkDir($savePath) === false){
		    	return error(-1, '上传路径不存在,path:'.$savePath);
			} else {			    	
				
			    $upload = new \Think\Upload();// 实例化上传类
			    $upload->maxSize = 3145728 ;// 设置附件上传大小
			    $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			    $upload->rootPath = $savePath; // 设置附件上传根目录
			    $upload->replace = $relpceFile;
			    if (!empty($subName)) {
					$upload->subName = $subName;
				}
				if (!empty($saveName)) {
					$upload->saveName= $saveName;					
				}
				
			    // 上传文件 
			    $info = $upload->upload();	 			    
			    if(!$info) {// 上传错误提示错误信息		    	
			    	return error(-1, $upload->getError());
			    } 
					    
			    return $info;	
			}						
		} else {
		    return error(-1, '非post上传');
		}
	}
	
	// 删除本地图片
	public static function deleteLocalFile($files) {
		$errno = 0; $errMsg = '';
    	foreach ($files as $k=>$f) {
			// 删除已上传的图片
			if (file_exists($f)) {
				if (!unlink($f)) {
					$errno = -1;
					$errMsg .= '\n删除文件'. $f . '失败';
				} else {
					$errMsg .= '\n删除文件'. $f . '成功';
				}
			} else {
				$errno = -1;
				$errMsg .= '\n文件'. $f . '不存在,删除失败';
			}
		}
		return error($errno, $errMsg);	
	}
	
	// 删除图片
	public static function deleteFiles($files) {
		if (!empty($files)) {
	        $setting = C('UPLOAD_SITEIMG_QINIU');
	        $setting['saveRule'] = 'time';
	        $setting["allowExts"] = $allow;
	        $qiniuObj = new Qiniu($setting);        
	        if (is_array($files) === false) {
				$result['rs'] = $qiniuObj->delBatch($files);
			} else {
	        	$result['rs'] = $qiniuObj->del($files);
			}
			if ($result['rs'] === false) {
				$result['result'] = $qiniuObj->getError();
			}
		} else {
			$result = error(-1, '要删除的文件不能为空!!!');
		}
		return $result;
	}
	
	// 获取图片列表
	public static function getImageList($conds=array(), $startIndex=0, $pageCount=0, &$total=0, $sortCol=array()) {
		$imageObj = ModelBase::getInstance('image_info');
		$images = $imageObj->getAll($conds, $startIndex, $pageCount, $total, $sortCol);
		return $images;
	}
	
	// 获取图片
	public static function getImage($conds=array()) {		
		if (empty($conds)) {
			return error(-1, '错误的查询条件');
		}
		
		$imageObj = ModelBase::getInstance('image_info');
		$image = $imageObj->getOne($conds);
		if (empty($image)) {
			return error(-2, '没有查询到图片信息');
		}
		
		return $image;
	}
}

?>