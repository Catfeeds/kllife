<?php
namespace Fenxiao\Controller;
use Think\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackAccountHelp;
use Core\Model\BackImageHelp;
use Core\Model\BackLineHelp;

class SettleController extends FxBaseController  {	
	
	// 设置店铺首图
	public function imageAction() {
		$user = MyHelp::getLoginAccount(true);
		if (IS_POST) {
			if (is_error($user)) {
				$data['result'] = error(-1, '您暂时还未登录');
				$data['jumpUrl'] = UNLOGIN_URL;
				return $this->ajaxReturn($data);
			}
			
			$key = I('post.set_name', false);
			if (empty($key)) {
				$data['result'] = error(-1, '设置图片的配置名称有误');
				return $this->ajaxReturn($data);
			}
			
			$savePath = FX_IMAGE_UPLOAD_PATH;
			$saveName = 'banner_'.$user['id'];
			$info = BackImageHelp::localUploadFiles($savePath, 'banner', $saveName, true);
			if (is_error($info) == false) {
				$imageInfo = $info['upload_file'];
				$host = C('TMPL_PARSE_STRING.{__GLOBAL_HOST_URL__}');
				
				// 更换为新的图片
				$imgUrl = $host.FX_IMAGE_UPLOAD_URL.$imageInfo['savepath'].$imageInfo['savename'];
				$fxSetObj = ModelBase::getInstance('fx_set');				
				$conds = appendLogicExp('user_id', '=', $user['id']);
				$conds = appendLogicExp('key', '=', $key, 'AND', $conds);
				$set = $fxSetObj->getOne($conds);
				if (empty($set)) {
					$ds['user_id'] = $user['id'];
					$ds['key'] = $key;
					$ds['value'] = $imgUrl;
					$ds['group'] = 0;
					$ds['sort'] = 0;
					$data['result'] = $fxSetObj->create($ds, $setId);
					if (error($data['result']) === true) {
						$ds['id'] = $setId;
					} else {						
						$data['image'] = $imgUrl;
						$data['result'] = error(0, '设置图像成功');
					}
				} else {
					$data['image'] = $imgUrl;
					$data['result'] = error(0, '设置图像成功');
				}		
			} else {
				$data['result'] = $info;
			}
			$this->ajaxReturn($data);			
		} else {
			$localUrl = substr(U('user/face'), 1);
			$uploadUrl = C('TMPL_PARSE_STRING.{__GLOBAL_HOST_URL__}').$localUrl;
			$this->assign('upload_url', $uploadUrl);
			$this->showPage('face');
		}
	}
	
	// 设置店铺装修
	public function shopAction() {
		if (IS_POST) {
			$user = MyHelp::getLoginAccount(false);
			if (is_error($user) === true) {
				$data['result'] = $user;
				$data['jumpUrl'] = U('user/login');
				return $this->ajaxReturn($data);
			}
			
			$key = I('post.key', false);
			if (empty($key)) {
				$data['result'] = error(-1, '设置的参数不明确');
				return $this->ajaxReturn($data);
			}						
			$ds[$key] = I('post.value', '');			
			
			$fxUserObj = ModelBase::getInstance('fx_user');
			$colName = $fxUserObj->getUserDefine(ModelBase::DF_COL_NAMES);
			$saveData = coll_elements_giveup($colName, $ds);
			if (empty($saveData)) {
				$data['result'] = error(-1, '无效的设置参数');
				return $this->ajaxReturn($data);
			}
			
			$data['result'] = $fxUserObj->modify($saveData, appendLogicExp('id', '=', $user['id']));
			if (error_ok($data['result']) === true) {
				$user[$key] = $ds[$key];
				MyHelp::setLoginAccount($user);
			}
			return $this->ajaxReturn($data);
			
		} else {
			return $this->showError('404', '请求错误', '错误的请求方式', '服务器收到的请求类型有误');
		}
	}
	
	// 获取配置
	private function getConfig($conds) {
		$fxSetObj = ModelBase::getInstance('fx_set');
		$fxSet = $fxSetObj->getAll($conds, 0, 0, $total, array('group'=>'asc', 'sort'=>'asc'));
		foreach ($fxSet as $sk=>$sv) {
			$set = array('data'=>$sv);
			if (strpos($sv['key'], '_line_') !== FALSE) {
				$set['line'] = BackLineHelp::getLine(appendLogicExp('id', '=', $sv['value']),false);
			}
			$sets[$sv['key']] = $set;
		}
		return $sets;
	}
	
	// 配置分销线路
	private function setConfigLine($userId, $ds) {
		$line = BackLineHelp::getLine(appendLogicExp('id', '=', $ds['value']),false);
		if (empty($line)) {
			$data['result'] = error(-1, '未能找到要绑定线路的相关信息,请查证后再进行绑定');
		} else {
			$data['line'] = $line;
			
			$conds = appendLogicExp('user_id', '=', $userId);
			$conds = appendLogicExp('line_id', '=', $ds['value'], 'AND', $conds);
			$fxSetObj = ModelBase::getInstance('fx_set');
			$setLine = $fxSetObj->getOne($conds);
			
			// 绑定或创建分销线路
			if (!empty($setLine)) {
				$setLine['value'] = $ds['value'];
				$data['ds'] = $setLine;
				$data['result'] = $fxSetObj->modify($setLine, $conds);
			} else {						
				$data['result'] = $fxSetObj->create($ds, $setId);
				$data['ds'] = $ds;
				$data['ds']['id'] = $setId;
			}
		}
		
		// 绑定分销产品
		if (error_ok($data['result']) === true) {
			$fxLineObj = ModelBase::getInstance('fx_line');
			$conds = appendLogicExp('user_id', '=', $userId);
			$conds = appendLogicExp('line_id', '=', $ds['value'], 'AND', $conds);
			$bindLine = $fxLineObj->getOne($conds);
			if (empty($bindLine)) {
				$newLine = array('user_id'=>$userId, 'line_id'=>$ds['value'], 'sort'=>1000);
				$data['bind_result'] = $fxLineObj->create($newLine, $bindId);
				if (error_ok($data['bind_result'])) {
					$data['bind_id'] = $bindId;	
				}
			} else {
				$data['bind_id'] = $bindLine['id'];
			}
		}	
		return $data;
	}
	
	// 设置配置	
	private function setConfig($requestType, $aa) {
		$user = MyHelp::getLoginAccount(false);
		if (is_error($user)) {
			$data['jumpUrl'] = UNLOGIN_URL;
			$data['result'] = $user;
			return $this->ajaxReturn($data);
		}
		
		$fxSetObj = ModelBase::getInstance('fx_set');
		$colNames = $fxSetObj->getUserDefine(ModelBase::DF_COL_NAMES);
		$ds = coll_elements_giveup($colNames, $aa);
		$ds['user_id'] = $user['id'];
		
		if (empty($ds['key'])) {
			$data['result'] = error(-1, '配置类型和配置键值不能为空');
			return $this->ajaxReturn($data);
		}
		
		$conds = appendLogicExp('user_id', '=', $ds['user_id']);
		if (empty($aa['key_like'])) {
			$conds = appendLogicExp('key', '=', $ds['key'], 'AND', $conds);					
		} else {
			$conds = appendLogicExp('key', 'LIKE', '%'.$ds['key'].'%', 'AND', $conds);
		}
		
		if (empty($conds)) {
			$data['result'] = error(-1, '设置的参数不齐全');
			return $this->ajaxReturn($data);
		}
		
		if (!empty($aa['sql_type'])) {
			// 查找配置
			if ($aa['sql_type'] == 'find') {
				$data['ds'] = MyHelp::getConfig($conds);
			
			// 配置线路
			} else if ($aa['sql_type'] == 'line') {
				$data = $this->setConfigLine($user['id'], $ds);
				
			// 配置线路的排序
			} else if ($aa['sql_type'] == 'sort') {
				$data['result'] = $fxSetObj->modify(array('sort'=>$ds['value']), $conds);
				$data['jumpUrl'] = U('settle/settle');
			} else {
				$data['result'] = error(-1, '错误的设置操作');
			}
		} else {
			$fxSet = $fxSetObj->getCount($conds);		
			if (empty($fxSet)) {
				$data['result'] = $fxSetObj->create($ds, $setId);
			} else {
				$data['result'] = $fxSetObj->modify($ds, $conds);
			}
		}	
		return $this->ajaxReturn($data);
	}
	
	// 移除配置
	private function removeConfig($requestType, $aa) {
		if ($requestType == 'post') {
			if (empty($aa['id'])) {
				$data['result'] = error(-1, '参数不足');
				return $this->ajaxReturn($data);
			}
						
			$fxSetObj = ModelBase::getInstance('fx_set');
			$set = $fxSetObj->getOne(appendLogicExp('id', '=', $aa['id']));
			if (empty($set)) {
				$data['result'] = error(-1, '要删除的对象不存在');
				return $this->ajaxReturn($data);
			}
			
			$result = $fxSetObj->remove(appendLogicExp('id', '=', $aa['id']));
			if (error_ok($result) === true) {
				$data['result'] = error(0, '移除配置成功');
			} else {
				$data['result'] = error(-1, '移除配置失败,Error:'.$result['errno'].','.$result['message']);
			}
			
			$this->ajaxReturn($data);
		}
	}
	
	// 分销首页设置
	public function settleAction() {
		if (IS_POST) {
			$type = I('post.op_type', false);
			if ($type == 'set') {
				$this->setConfig('post', $_POST);
			} else if ($type == 'remove') {
				$this->removeConfig('post', $_POST);
			} else {
				$data['result'] = error(-1, '操作类型错误');
				$this->ajaxReturn($data);
			}
		} else {
			$user = MyHelp::getLoginAccount(false);
			if (is_error($user) === true) {
				$this->showPage('login', 'user_login', 'user', '用户登录');	
			} 
			
			$modalTypes[0] = array('title'=>'精选线路', 'type'=>'choiceness');
			$modalTypes[1] = array('title'=>'小团慢旅行','type'=>'slowly');
			$modalTypes[2] = array('title'=>'摄影游','type'=>'sheying');
			$modalTypes[3] = array('title'=>'新旅拍','type'=>'qinglvpai');
			$this->assign('modal_types', $modalTypes);
						
			$conds = appendLogicExp('user_id', '=', $user['id']);
			$sets = $this->getConfig($conds);
			$this->assign('sets', $sets);
			
			// 上传图片路径
			$localUrl = substr(U('line/banner'), 1);
			$uploadUrl = C('TMPL_PARSE_STRING.{__GLOBAL_HOST_URL__}').$localUrl;
			$this->assign('upload_url', $uploadUrl);
			
			// 美图秀秀
			$this->assign('modal_choose_image', true);
			// 线路选择
			$this->assign('modal_line_list', true);
			return $this->showPage('settle', 'settle', 'settle', '首页设置');
		}
	}
}


?>