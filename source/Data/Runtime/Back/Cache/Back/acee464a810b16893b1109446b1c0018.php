<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Xenon Boostrap Admin Panel" />
	<meta name="author" content="" />
	
	<title><?php echo C('PAGE_TITLE');?> - 领袖户外</title>

	<!--<link rel="stylesheet" href="http://fonts.useso.com/css?family=Arimo:400,700,400italic">-->
	<link rel="stylesheet" href="/source/Static/assets/css/fonts/linecons/css/linecons.css">
	<link rel="stylesheet" href="/source/Static/assets/css/fonts/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/source/Static/assets/css/fonts/elusive/css/elusive.css">
	<link rel="stylesheet" href="/source/Static/assets/css/bootstrap.css">
	<link rel="stylesheet" href="/source/Static/assets/css/xenon-core.css">
	<link rel="stylesheet" href="/source/Static/assets/css/xenon-forms.css">
	<link rel="stylesheet" href="/source/Static/assets/css/xenon-components.css">
	<link rel="stylesheet" href="/source/Static/assets/css/xenon-skins.css">
	<link rel="stylesheet" href="/source/Static/assets/css/custom.css">
	<!--Import dropzone css-->
	<link rel="stylesheet" href="/source/Static/assets/js/dropzone/css/dropzone.css">
	<!--Import fileupload css-->
	<link rel="stylesheet" href="/source/Static/assets/js/fileupload/css/jquery.fileupload.css">
	<link rel="stylesheet" href="/source/Static/assets/js/fileupload/css/jquery.fileupload-ui.css">
	
	<link rel="stylesheet" href="/source/Static/common/css/common.css">

	<script src="/source/Static/assets/js/jquery-1.11.1.min.js"></script>
	
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>
	
	<!--自己的全局JavaScript代码-->
	<script src="/source/Static/common/js/functions.js"></script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="/source/Static/assets/js/html5shiv.min.js"></script>
		<script src="/source/Static/assets/js/respond.min.js"></script>
	<![endif]-->
	
	<style>
		body { font-family: '微软雅黑'; }
		.loading { position: fixed; z-index: 999; background: rgba(0,0,0,.5); top: 0; left: 0; width: 100%; text-align: center; display: none;}
		.loading .dashboard { position: absolute;}
	</style>
	<script>
		$(document).ready(function(){
			var LoadingHeight = document.body.scrollHeight;
			$('.loading').css("height",LoadingHeight);	
		});
		
		function showLoading(bshow, tips) {
			if (bshow == false) {
				$('.loading').css('display', 'none');
			} else {
				$('.loading').css('display', 'block');
				if (tips != null && tips != 'undefined') {
					$('.loading').find('span').html(tips);	
				}
				
				var loadObj = $('.loading').find('.dashboard');
				var centerX = $(loadObj).parent().width() / 2, centerY = $(loadObj).parent().height() / 2;
				var loadW = $(loadObj).width() / 2, loadH = $(loadObj).height() / 2;
				$(loadObj).css('top', centerY - loadH);
				$(loadObj).css('left', centerX - loadW);
				$(loadObj).css('margin-top', -loadH * 1.3);
			}
		}
		
		
        var vurl = window.location.href;
        if (vurl.indexOf('www.') != -1) {
            vurl = window.location.href.replace(/www./g, '');
            window.location.href = vurl;
        }
	</script>
	
</head>
<body class="page-body">
	<?php if(!empty($modal_data_edit)): ?><!-- Modal -->                    
	<div id="modal_data_edit"  class="modal fade custom-width">
		<div class="modal-dialog" style="width: 40%;">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="lab_modal_data_edit_title" class="modal-title">窗口标题</h3>
				</div>
				
				<div class="modal-body pan">
					<form>
						<div class="form-group has-error">
							<label class="control-label col-sm-11" id="lab_modal_data_edit_errmsg"></label>
						</div>
					</form>
	        		<form class="form-horizontal" id="form_modal_data_edit">
	       			</form>							
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btn_modal_data_edit_confirm">确认</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript" >
		var modal_data_edit_init_data;
		$('document').ready(function(){
			_initModalDataEdit();		
		}); 
		
		// 设置操作提示语言
		function setModalDataEditTips(msg) {
			$('#lab_modal_data_edit_errmsg').html(msg);
		}
		
		// 重置窗口（需要重新初始化）
		function _resetModalDataEdit() {
			setModalDataEditTips('');
			$('#form_modal_data_edit').empty();
		}
		
		// 重置窗口Form（不许再次初始化）
		function _resetModalDataEditForm() {
			setModalDataEditTips('');
			var ds = modal_data_edit_init_data;
			var elmt = ds['elmt'];
			for (var i = 0; i < elmt.length; ++ i) {
				$('#field_modal_data_edit_'+elmt[i]['id']).val(elmt[i]['value']);
			}
		}
		
		// 初始化
		function _initModalDataEdit() {
			$('#modal_data_edit').on('show.bs.modal', function () {
			    $('body', document).addClass('modal-open');
			    $('<div class="modal-backdrop fade in"></div>').appendTo($('body', document));
			});
			$('#modal_data_edit').on('hide.bs.modal', function () {
			    $('body', document).removeClass('modal-open');
			    $('div.modal-backdrop').remove();
			    _resetModalDataEditForm();
			});
		}
		
		// 获取输入值
		function getModalDataEditInputValues(ds) {
			var vals = new Object();
			var elmt = ds['elmt'];
			for (var i = 0; i < elmt.length; ++ i) {
				var idText = '#field_modal_data_edit_'+elmt[i]['id'];				
				var tagName = $(idText).get(0).tagName				
				if (tagName == ''){
					vals[elmt[i]['id']] = $(idText).html();
				} else {
					vals[elmt[i]['id']] = $(idText).val();
				}
			}
			return vals;
		}
		
		// 填充输入值
		function setModalDataEditInputValues(ds) {
			var elmt = ds['elmt'];
			for (var i = 0; i < elmt.length; ++ i) {
				var attrs = elmt[i];
				var idText = '#field_modal_data_edit_'+attrs['id'];
				var tagName = $(idText).get(0).tagName
//				alert(tagName+'==>>'+JSON.stringify(attrs));
				if (tagName == 'SELECT') {
					$(idText).children('option').each(function(){
						if ($(this).val() == attrs['value']){
							$(this).prop('selected', true);
//							$(this).val(attrs['value']).trigger('change');
						} else {
							$(this).removeAttr('selected');
						}
					});
				} else {
					$(idText).val(attrs['value']);
				}
			}
		}
		
		// 添加可选值
		function appendModalDataEditInputValues(ds, clean) {
			var elmt = ds['elmt'];
			for (var i = 0; i < elmt.length; ++ i) {
				var idText = '#field_modal_data_edit_'+elmt[i]['id'];
				var tagName = $(idText).get(0).tagName
//				alert(tagName+'==>>'+JSON.stringify(elmt[i]));
				if (tagName == 'INPUT') {					
					var val = elmt[i]['value'];
					if (clean == false) {
						val = val + elmt[i]['value'];
					}
					$(idText).val(val);
				} else {			
					var html = elmt[i]['value'];
					if (clean == false) {
						html = html + elmt[i]['value'];
					}
					$(idText).html(html);	
				}
			}
		}
		
		// 绑定移除属性
		function bindModalDataEditInputAttr(ds) {
			var elmt = ds['elmt'];
			for (var i = 0; i < elmt.length; ++ i) {
				var d = elmt[i];
				if (d['id'] == 'undefined') {
					continue;
				}
				var idText = '#field_modal_data_edit_' + d['id'];
				if (d['op'] != 'undefined' && d['attr'] != 'undefined' && d['attr'].length > 0) {					
					for (var k = 0; k < d['attr'].length; ++ k) {
						var a = d['attr'][k];
						if (a['op'] == 'bind') {
							if (a['name'] != 'undefined' && a['value'] != 'undefined'){
								$(idText).attr(a['name'], a['value']);	
							}
						} else {
							if (a['name'] != 'undefined'){
								$(idText).removeAttr(a['name']);	
							}
						}
					}
				}
			}
		}
		
		// 绑定确认按钮事件
		function bindModalDataEditConfirmEvent(callback) {
			modal_data_edit_init_data['callback_confirm'] = callback;
		    // 重新绑定事件
		    $('#btn_modal_data_edit_confirm').off('click');
			$('#btn_modal_data_edit_confirm').on('click', function(){
				if (typeof(modal_data_edit_init_data['callback_confirm']) == 'function'){
					var vals = getModalDataEditInputValues(modal_data_edit_init_data);
					modal_data_edit_init_data['callback_confirm'](vals);
				}
			});
		}
		
		// 引入插件
		function bindModalDataEditPlugins(ds) {
			if (ds['elmt']=='undefined') {
				return false;
			}
			for (var i = 0; i < ds['elmt'].length; i++) {
				var elmt = ds['elmt'][i];
				var idText = '#field_modal_data_edit_' + elmt['id'];
				if (elmt['tag'] == 'select') {
//					alert(idText + '   ' + JSON.stringify(elmt));					
					$(idText).select2({
						placeholder: '请选择批次',
						allowClear: true,
						minimumResultsForSearch: -1, 
						// Hide the search bar
						formatResult: function(d){
							return "<div class='select2-user-result cx_border02'>" + d.text + "</div>"; 
						}
					});
				}
			}
		}
		
		// 添加元素
		function appendModalDataEditElement(ds) {
			if (ds['elmt']=='undefined') {
				return false;
			}
			var	html = $('#form_modal_data_edit').html();
			for (var i = 0; i < ds['elmt'].length; i++) {
				var elmt = ds['elmt'][i];
				html += '<div class="row">';
				html += '	<div class="col-md-2">';
				html += '		<label for="field_modal_data_edit_'+elmt['id']+'" class="control-label">'+elmt['lab']+'</label>';
				html += '	</div>';
				html += '	<div class="col-md-9">';
				html += '		<div class="form-group">';										
				html += '			<'+elmt['tag']+' id="field_modal_data_edit_'+elmt['id']+'" class="form-control"></'+elmt['tag']+'>';
				html += '		</div>';									
				html += '	</div>';
				html += '</div>';
			}
						
			$('#form_modal_data_edit').append(html);
			bindModalDataEditInputAttr(ds);
		}
		
		// 初始化页面
		function initModalDataEditPage(ds) {
			modal_data_edit_init_data = ds;
			// 初始化窗口输入
			appendModalDataEditElement(ds);
			// 初始化插件
//			bindModalDataEditPlugins(ds);
			// 其他控件初始化
			$('#lab_modal_data_edit_title').html(ds['lab_title_text']);
			$('#btn_modal_data_edit_confirm').html(ds['btn_confirm_text']);
			// 绑定事件
			bindModalDataEditConfirmEvent(ds['callback_confirm']);
		}
		
		// 显示窗口
		function showModalDataEdit() {		
			$("#modal_data_edit").modal('show', {backdrop: 'static'});
		}
		
		// 隐藏窗口
		function hideModalDataEdit() {
			$("#modal_data_edit").modal('hide');
		}
		
	</script><?php endif; ?>
<?php if(!empty($modal_type_data)): ?><!-- 添加数据类型 -->
	<div class="modal fade" id="gallery-type-data-modal" data-backdrop="static" style="z-index: 9999;">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<h4 class="modal-title">数据类型添加</h4>
				</div>
				
				<div class="modal-body">
					
					<div class="row">
						<div class="col-md-12">
							<label class="control-label" for="modal_data_key">主键<span style="color: red;">（*只能由字母、数字、短线、下划线其中任意类型组合而且不能为空）</span></label>
							<input class="form-control" name="modal_data_key" id="modal_data_key" data-validate="required"/>
						</div>						
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<label class="control-label" for="modal_data_desc">键值<span style="color: red;">（*只能由字母、数字、短线、下划线或者汉字其中任意类型组合而且不能为空）</span></label>
							<input class="form-control" name="modal_data_desc" id="modal_data_desc" data-validate="required"/>
						</div>						
					</div>
					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-secondary">添加</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">			
		// 添加类型
		var modal_type_key = null;
		$('#gallery-type-data-modal').find('.btn-secondary').click(function(){
			var jsonData = {
				'type_key': modal_type_key,
				'data_key': $('#modal_data_key').val(),
				'data_desc': $('#modal_data_desc').val(),
			}
			$.post('<?php echo U("help/appendtypedata");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					$('#gallery-type-data-modal').modal('hide');
				} else {
					alert(data.result.message);
				}
			});
		});
		
		// 显示类型数据添加界面
		function showModalTypeDataDialog(typeKey) {
			modal_type_key = typeKey;
			$('#modal_data_key').val('');
 			$('#modal_data_desc').val('');
			$("#gallery-type-data-modal").modal('show');
		}
	</script><?php endif; ?> 
<?php if(!empty($modal_upload_image)): ?><!-- 上传图片确认 -->
	<div class="modal fade custom-width" id="gallery-image-upload-modal" data-backdrop="static">
		<div class="modal-dialog" style="width: 90%">
			<div class="modal-content">
				
				<div class="modal-header">
					<h4 class="modal-title">上传图片</h4>
				</div>
				
				<div class="modal-body">
	
					<section class="gallery-env">
											
						<!-- Gallery Album Optipns and Images -->
						<div class="col-sm-9 gallery-right">
				
							<!-- Auto initialization -->
							<form id="ModalImageUpload" class="dropzone"></form>	
							
						</div>
						
						<!-- Gallery Sidebar -->
						<div class="col-sm-3 gallery-left">
							
							<!-- Album Header -->
							<div class="album-header">
								<h2>筛选</h2>
							</div>		
									
												
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片标题：</p><br />
										<input type="text" style="height: 32px;" class="dingdan_bianji col-sm-12 modal_img_title">
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片作者：</p><br />
										<input type="text" style="height: 32px;" class="dingdan_bianji col-sm-12 modal_img_author">
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_type_obj = $('.gallery-image-selector-modal').find(".modal_img_type").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													
													// 默认选择第一个
													var initVal = $(modal_image_type_obj).find('option:first').attr('value');									
													$(modal_image_type_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_type">
												<option value="-1">不限</option>
												<?php if(is_array($ImageTypes)): $i = 0; $__LIST__ = $ImageTypes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgType): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgType["id"]); ?>"><?php echo ($imgType["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片来源：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_from_obj = $('.gallery-image-selector-modal').find(".modal_img_from").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_from_obj).find('option:first').attr('value');									
													$(modal_image_from_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_from">
												<option value="-1">不限</option>
												<?php if(is_array($ImageFroms)): $i = 0; $__LIST__ = $ImageFroms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgFrom): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgFrom["id"]); ?>"><?php echo ($imgFrom["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>内容类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_content_obj = $('.gallery-image-selector-modal').find(".modal_img_content").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_content_obj).find('option:first').attr('value');									
													$(modal_image_content_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_content">
												<option value="-1">不限</option>
												<?php if(is_array($ImageContents)): $i = 0; $__LIST__ = $ImageContents;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgContent): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgContent["id"]); ?>"><?php echo ($imgContent["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>地域类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												function getMenuItem(parentObj, childObj) {
													if ($(parentObj).val() == null) {
														return false;
													}
													
													var jsonData = {
														op_type: 'find',
														data_type: 'all',
														parent_id: $(parentObj).val(),
													};
																				
													$.post('<?php echo U("menu/list");?>', jsonData, function(backData){
														if (backData.result.errno == 0) {
															$(childObj).data('selectBox-selectBoxIt').remove();
															if (backData.data != null) {
																for (var k=0; k < backData.data.length; k++) {		
																	var d = backData.data[k];													
																	$(childObj).data('selectBox-selectBoxIt').add({value:d['id'], text:d['item_desc']});
																}	
															}
														}
													});
												}
												
												var modal_image_domain_obj=null, modal_image_district_obj=null, modal_image_distination_obj=null;	
												jQuery(document).ready(function($)
												{
													modal_image_domain_obj = $('.gallery-image-selector-modal').find(".modal_img_domain").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													
													// 初始化
													var initVal = $(modal_image_domain_obj).find('option:first').attr('value');									
													$(modal_image_domain_obj).val(initVal).trigger('change');
													
													// 选项改变
													$(modal_image_domain_obj).change(function(){	
														if (modal_image_domain_obj != null && modal_image_district_obj != null) {
															getMenuItem(modal_image_domain_obj, modal_image_district_obj);
														}									
													});
													
												});
											</script>
											<select class="form-control modal_img_domain">
												<option value="-1">不限</option>
												<?php if(is_array($ImageDomains)): $i = 0; $__LIST__ = $ImageDomains;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgDomain): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgDomain["id"]); ?>"><?php echo ($imgDomain["item_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>辖区类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													modal_image_district_obj = $('.gallery-image-selector-modal').find(".modal_img_district").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_district_obj).find('option:first').attr('value');									
													$(modal_image_district_obj).val(initVal).trigger('change');
												});
													
												// 选项改变
												$(modal_image_district_obj).change(function(){	
													if (modal_image_district_obj != null && modal_image_distination_obj != null) {
														getMenuItem(modal_image_district_obj, modal_image_distination_obj);
													}									
												});
											</script>
											<select class="form-control modal_img_district">
												<option value="-1">不限</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>目的地：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_distination_obj = $('.gallery-image-selector-modal').find(".modal_img_distination").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_distination_obj).find('option:first').attr('value');									
													$(modal_image_distination_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_distination">
												<option value="-1">不限</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
																					
						</div> <!--End Left-->
									
					</section>
					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-secondary btn-use">上传并使用</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		// 上传成功的回调函数
		var funcModalUploadCallBack = null;
		var modalUploadCallBack = null;
		var modalDropZone = null;
		var modalImageList = null;
		var modalUploadMaxFileCount = 20;
		var modalUploadMaxFileSize = 3;
		var modalUploadInitialized = false; // 已初始化
				
		// 显示上传插件
		function showModalUploadImageDialog(obj) {
			if (modalUploadInitialized == false) {
				_modalInitDropZone();
				// 一键上传所有图片
				$('#gallery-image-upload-modal').find('.btn-use').click(_modalUploadAllImage);
			}
			modalUploadCallBack = obj;
			_modalClearAllImage();
			$("#gallery-image-upload-modal").modal('show');
		}
		
		// 初始化上传插件
//		$(document).ready(function()
//			{
//			Dropzone.autoDiscover = false;
//			Dropzone.options.myAwesomeDropzone = false;
//			_modalInitDropZone();	
//			
//			// 上传所有图片
//			$('#gallery-image-upload-modal').find('.btn-use').click(_modalUploadAllImage);
//		});	
		
		// 初始化dropzone
		function _modalInitDropZone() {
			$('#ModalImageUpload').dropzone({
				url: '<?php echo U("image/fupload");?>',
				maxFiles: modalUploadMaxFileCount,	// 允许上传的文件个数
				maxFilesize: modalUploadMaxFileSize,	// 单个文件最大上传大小，3MB
				acceptFiles:'.jpg,.jpeg,.png,.gif',
				addRemoveLinks: true,
				uploadMultiple: false,
				autoProcessQueue: false,
				dictDefaultMessage: '点击此处添加图片',
				dictRemoveFile: '删除',
				init:function(){
					modalDropZone = this;
					this.on('addedfile', _modalAddUploadImage);
					this.on('removedfile', _modalRemoveUploadImage);
					this.on('error', _modalImageError);
					this.on('processing', _modalImageProcessing);
					this.on('uploadprogress', _modalImageUploadProgress);
					this.on('sending', _modalImageSending);
					this.on('success', _modalImageSucess);
					this.on('complete', _modalImageComplete);
					this.on('canceled', _modalImagecanceled);
					this.on('maxfilesreached', _modalImageMaxFilesReached);
					this.on('maxfilesexceeded', _modalImageMaxFilesExceeded);
									
				},
			});
			modalUploadInitialized = true;
		}
		
		
		// 检测是否可以添加图片
		var modalFileCount = 0;
		function _modalCheckAllowUpload() {
			modalFileCount = modalDropZone.getAcceptedFiles().length;	
			if (modalFileCount < 1) {
				alert('请上传照片...');
				return false;
			}
			if (modalFileCount > 20) {
				alert('您一次上传的照片不应该超过20张');
				return false;
			}
			return true;
		}
		
		// 检查编辑图片的信息
		function _modalcheckImageInfo() {
			var rootObj = $('#gallery-image-upload-modal');
			var title = $(rootObj).find('.modal_img_title').val();
			if (title == '') {
				alert('图片的标题不能为空，可能的话请尽量补全其它图片信息，谢谢合作!');
				return false;
			}
			return true;
		}
		
		// 添加所有图片
		function _modalUploadAllImage(){
			// 检查是否允许上传
		    if (_modalCheckAllowUpload() == false) {
		    	return false;
		    }
		    // 检查图片描述
		    if (_modalcheckImageInfo() == false) {
		    	return false;
		    }
			
			// 加载上传等待层
			showLoading(true);
			// 开始上传
			modalDropZone.processQueue();
			
			modalImageList = new Array();
//			var fs = modalDropZone.getAcceptedFiles();
//			for (var i = 0; i < fs.length; ++ i) {
//			}
			
		}
		
		// 清除所有添加的图片
		function _modalClearAllImage(){	
			// console.log('_modalClearAllImage->清除所有图片');
			modalDropZone.removeAllFiles(true);
		}
		
		// 添加图片
		function _modalAddUploadImage(f) {	
			// console.log('_modalAddUploadImage->'+JSON.stringify(f));		
			//alert('add:' + f.name);
//			f.previewElement.addEventListener("click", function(f) {
//				alert(111);
//				modalDropZone.removeFile(f);
//			});
			
		}
		
		// 删除图片
		function _modalRemoveUploadImage(f) {
			// console.log('_modalRemoveUploadImage->'+JSON.stringify(f));	
		}
		
		// 出错时. 接受 errorMessage 作为第二个参数，并且如果错误是 XMLHttpRequest对象， 那就作为第三个参数.
		function _modalImageError(f, errMsg, xhr) {
			// console.log('_modalImageError->'+ JSON.stringify(f) + ",error:" + errMsg);	
		}
		
		// 当一个文件获取处理 （因为不是所有的文件会立即得到处理的队列）。以前，此事件被称为 processingfile
		function _modalImageProcessing(f) {
			// console.log('_modalImageProcessing->'+JSON.stringify(f));	
		}
		
		//	无论文件在什么时候被改变都会调用此函数.
		//	处理进度作为第二个参数，范围为(0-100); 发送到服务的字节数作为第三个参数
		//	当上传文件完成确保至少一次处理进度被设置为100%
		//	警告: 函数可能同时被多次调用
		function _modalImageUploadProgress(f, p, b) {
			// console.log('_modalImageUploadProgress->'+JSON.stringify(f) + ",process" + p + ",byte:" + b + "KB");
		}
		
		// 在每个文件被发送前调用. 得到 xhr 对象 和 formData 对象作为第二个和第三个参数, 所以你可以修改他们(add a CSRF token) 或者追加额外的数据.
		function _modalImageSending(f, xhr, formData) {	
			var rootObj = $('#gallery-image-upload-modal');
			formData.append('title', $(rootObj).find('.modal_img_title').val());
			formData.append('author', $(rootObj).find('.modal_img_author').val());
			formData.append('intro', $(rootObj).find('.img_intro').val());
//			formData.append('type_id', $(rootObj).find('.modal_img_type').val());
			formData.append('from_type_id', $(rootObj).find('.modal_img_from').val());
			formData.append('content_type_id', $(rootObj).find('.modal_img_content').val());
			formData.append('tags', $(rootObj).find('.modal_img_domain').val());
			formData.append('domain_type_id', $(rootObj).find('.img_domain').val());
			formData.append('district_type_id', $(rootObj).find('.modal_img_district').val());
			formData.append('distination_type_id', $(rootObj).find('.modal_img_distination').val());
			// console.log('_modalImageSending->'+JSON.stringify(f)+JSON.stringify(formData));	
		}
		
		// 文件已经成功上传，获得服务器返回信息作为第二个参数(这个时间又被称作finished)
		function _modalImageSucess(f, backData) {
			// console.log('_modalImageSucess->'+JSON.stringify(f)+JSON.stringify(backData));
			if (backData['result']['errno'] == 0) {
				// 调用上传成功图片函数
				var imageUrl = backData.ds.url;
				modalImageList.push(imageUrl);
				// 上传成功后移除该文件
				modalDropZone.removeFile(f);
				
				
			} else {
				alert('上传失败,原因如下:\n' + backData['result']['message']);
			}
		}
		
		// 当上传完成，成功或者出现错误时调用
		function _modalImageComplete(f) {
			// console.log('_modalImageComplete->'+JSON.stringify(f));
//			goBtnTop($('#gallery-image-upload-modal').find('.btn-use'));
//			console.log(123);
			modalFileCount--;
			if (modalFileCount == 0) {
				if (typeof(funcModalUploadCallBack) == 'function') {
					funcModalUploadCallBack(modalUploadCallBack, modalImageList);
					
				}
				showLoading(false);
				// 关闭窗口
				$('#gallery-image-upload-modal').modal('hide');
				
			}
			if (f.accepted != false) {
				modalDropZone.processQueue();	
			}
		}
		
		// 当取消文件上传式调用
		function _modalImagecanceled(f) {
			// console.log('_modalImagecanceled->'+JSON.stringify(f));
		}
		
		// 当文件的数量达到maxFiles限制时调用
		function _modalImageMaxFilesReached(f) {
			// console.log('_modalImageMaxFilesReached->'+JSON.stringify(f));
		}
		
		// 由于文件数量达到 maxFiles 限制数量被拒绝时调用
		function _modalImageMaxFilesExceeded(f) {
			// console.log('_modalImageMaxFilesExceeded->'+JSON.stringify(f));
			modalDropZone.removeFile(f);
		}		
		
	</script><?php endif; ?>
<?php if(!empty($modal_leader_upload_image)): ?><!-- 上传图片确认 -->
	<div class="modal fade custom-width" id="gallery-leader-upload-modal" data-backdrop="static">
		<div class="modal-dialog" style="width: 60%">
			<div class="modal-content">
				
				<div class="modal-header">
					<h4 class="modal-title">上传图片</h4>
				</div>
				
				<div class="modal-body">
						
					<div class="row">
					
						<div class="row">					
							<div class="col-md-12">
								<div class="form-group">
									<p>作品标题：</p><br />
									<input type="text" style="height: 32px;" class="dingdan_bianji col-sm-12 modal_img_title" placeholder="请输入作品标题">
								</div>
							</div>
						</div>
						<br />
						
						<div class="row">					
							<div class="col-md-12">
								<div class="form-group">
									<p>作品描述：</p><br />
									<input type="text" style="height: 32px;" class="dingdan_bianji col-sm-12 modal_img_intro" placeholder="请输入作品描述">
								</div>
							</div>
						</div>
						
						<div class="row">					
							<div class="col-md-12">
								<div class="form-group">
									<p>作品标签：</p><br />
									<input type="text" style="height: 32px;" class="dingdan_bianji col-sm-12 modal_img_tags" placeholder="多个标签请用','隔开">
								</div>
							</div>
						</div>
						
					</div>
					
					<div class="row">
			
						<!-- Auto initialization -->
						<form id="ModalImageUpload" class="dropzone"></form>
						
					</div>
					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-secondary btn-use">上传并使用</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		// 上传成功的回调函数
		var funcModalUploadCallBack = null;
		var modaLeaderlUploadCallBack = null;
		var modaLeaderlId = null;
		var modalLeaderDropZone = null;
		var modalLeaderImageList = null;
		var modaLeaderlUploadMaxFileCount = 20;
		var modaLeaderlUploadMaxFileSize = 3;
		var modaLeaderlUploadInitialized = false; // 已初始化
				
		// 显示上传插件
		function showModalLeaderUploadDialog(obj, leaderId) {
			if (modaLeaderlUploadInitialized == false) {
				_modalInitDropZone();
				// 一键上传所有图片
				$('#gallery-leader-upload-modal').find('.btn-use').click(_modaLeaderlUploadAllImage);
			}
			modaLeaderlUploadCallBack = obj;
			modaLeaderlId = leaderId;
			_modalClearAllImage();
			$("#gallery-leader-upload-modal").modal('show');
		}
		
		// 初始化上传插件
//		$(document).ready(function() {
//			Dropzone.autoDiscover = false;
//			Dropzone.options.myAwesomeDropzone = false;
//			_modalInitDropZone();	
//			
//			// 上传所有图片
//			$('#gallery-leader-upload-modal').find('.btn-use').click(_modaLeaderlUploadAllImage);
//		});	
		
		// 初始化dropzone
		function _modalInitDropZone() {
			$('#ModalImageUpload').dropzone({
				url: '<?php echo U("image/fuploadleader");?>',
				maxFiles: modaLeaderlUploadMaxFileCount,	// 允许上传的文件个数
				maxFilesize: modaLeaderlUploadMaxFileSize,	// 单个文件最大上传大小，3MB
				acceptFiles:'.jpg,.jpeg,.png,.gif',
				addRemoveLinks: true,
				uploadMultiple: false,
				autoProcessQueue: false,
				dictDefaultMessage: '点击此处添加图片',
				dictRemoveFile: '删除',
				init:function(){
					modalLeaderDropZone = this;
					this.on('addedfile', _modalAddUploadImage);
					this.on('removedfile', _modalRemoveUploadImage);
					this.on('error', _modalLeaderImageError);
					this.on('processing', _modalLeaderImageProcessing);
					this.on('uploadprogress', _modalLeaderImageUploadProgress);
					this.on('sending', _modalLeaderImageSending);
					this.on('success', _modalLeaderImageSucess);
					this.on('complete', _modalLeaderImageComplete);
					this.on('canceled', _modalLeaderImagecanceled);
					this.on('maxfilesreached', _modalLeaderImageMaxFilesReached);
					this.on('maxfilesexceeded', _modalLeaderImageMaxFilesExceeded);
									
				},
			});
			modaLeaderlUploadInitialized = true;
		}
		
		
		// 检测是否可以添加图片
		var modalFileCount = 0;
		function _modalCheckAllowUpload() {
			modalFileCount = modalLeaderDropZone.getAcceptedFiles().length;	
			if (modalFileCount < 1) {
				alert('请上传照片...');
				return false;
			}
			if (modalFileCount > 20) {
				alert('您一次上传的照片不应该超过20张');
				return false;
			}
			return true;
		}
		
		// 检查编辑图片的信息
		function _modalcheckImageInfo() {
			var rootObj = $('#gallery-leader-upload-modal');
			var title = $(rootObj).find('.modal_img_title').val();
			if (title == '') {
				alert('图片的标题不能为空，可能的话请尽量补全其它图片信息，谢谢合作!');
				return false;
			}
			return true;
		}
		
		// 添加所有图片
		function _modaLeaderlUploadAllImage(){
			// 检查是否允许上传
		    if (_modalCheckAllowUpload() == false) {
		    	return false;
		    }
		    // 检查图片描述
		    if (_modalcheckImageInfo() == false) {
		    	return false;
		    }
			
			// 加载上传等待层
			showLoading(true);
			// 开始上传
			modalLeaderDropZone.processQueue();
			
			modalLeaderImageList = new Array();
//			var fs = modalLeaderDropZone.getAcceptedFiles();
//			for (var i = 0; i < fs.length; ++ i) {
//			}			
		}
		
		// 清除所有添加的图片
		function _modalClearAllImage(){	
			// console.log('_modalClearAllImage->清除所有图片');
			modalLeaderDropZone.removeAllFiles(true);
		}
		
		// 添加图片
		function _modalAddUploadImage(f) {	
			// console.log('_modalAddUploadImage->'+JSON.stringify(f));		
			//alert('add:' + f.name);
//			f.previewElement.addEventListener("click", function(f) {
//				alert(111);
//				modalLeaderDropZone.removeFile(f);
//			});			
		}
		
		// 删除图片
		function _modalRemoveUploadImage(f) {
			// console.log('_modalRemoveUploadImage->'+JSON.stringify(f));	
		}
		
		// 出错时. 接受 errorMessage 作为第二个参数，并且如果错误是 XMLHttpRequest对象， 那就作为第三个参数.
		function _modalLeaderImageError(f, errMsg, xhr) {
			// console.log('_modalLeaderImageError->'+ JSON.stringify(f) + ",error:" + errMsg);	
		}
		
		// 当一个文件获取处理 （因为不是所有的文件会立即得到处理的队列）。以前，此事件被称为 processingfile
		function _modalLeaderImageProcessing(f) {
			// console.log('_modalLeaderImageProcessing->'+JSON.stringify(f));	
		}
		
		//	无论文件在什么时候被改变都会调用此函数.
		//	处理进度作为第二个参数，范围为(0-100); 发送到服务的字节数作为第三个参数
		//	当上传文件完成确保至少一次处理进度被设置为100%
		//	警告: 函数可能同时被多次调用
		function _modalLeaderImageUploadProgress(f, p, b) {
			// console.log('_modalLeaderImageUploadProgress->'+JSON.stringify(f) + ",process" + p + ",byte:" + b + "KB");
		}
		
		// 在每个文件被发送前调用. 得到 xhr 对象 和 formData 对象作为第二个和第三个参数, 所以你可以修改他们(add a CSRF token) 或者追加额外的数据.
		function _modalLeaderImageSending(f, xhr, formData) {	
			var rootObj = $('#gallery-leader-upload-modal');
			var tags = $(rootObj).find('.modal_img_tags').val().replace(/，/g, ',');
			formData.append('leader_id', modaLeaderlId);
			formData.append('title', $(rootObj).find('.modal_img_title').val());
			formData.append('intro', $(rootObj).find('.modal_img_intro').val());
			formData.append('tags', tags);
		}
		
		// 文件已经成功上传，获得服务器返回信息作为第二个参数(这个时间又被称作finished)
		function _modalLeaderImageSucess(f, backData) {
			// console.log('_modalLeaderImageSucess->'+JSON.stringify(f)+JSON.stringify(backData));
			if (backData['result']['errno'] == 0) {
				// 调用上传成功图片函数
				var imageUrl = backData.ds.url;
				modalLeaderImageList.push(imageUrl);
				// 上传成功后移除该文件
				modalLeaderDropZone.removeFile(f);			
				
			} else {
				toastr.error('上传失败,原因如下:\n' + backData['result']['message']);
			}
		}
		
		// 当上传完成，成功或者出现错误时调用
		function _modalLeaderImageComplete(f) {
			// console.log('_modalLeaderImageComplete->'+JSON.stringify(f));
//			goBtnTop($('#gallery-leader-upload-modal').find('.btn-use'));
//			console.log(123);
			modalFileCount--;
			if (modalFileCount == 0) {
				if (typeof(funcModalUploadCallBack) == 'function') {
					funcModalUploadCallBack(modaLeaderlUploadCallBack, modalLeaderImageList);
					
				}
				showLoading(false);
				// 关闭窗口
				$('#gallery-leader-upload-modal').modal('hide');
				
			}
			if (f.accepted != false) {
				modalLeaderDropZone.processQueue();	
			}
		}
		
		// 当取消文件上传式调用
		function _modalLeaderImagecanceled(f) {
			// console.log('_modalImagecanceled->'+JSON.stringify(f));
		}
		
		// 当文件的数量达到maxFiles限制时调用
		function _modalLeaderImageMaxFilesReached(f) {
			// console.log('_modalLeaderImageMaxFilesReached->'+JSON.stringify(f));
		}
		
		// 由于文件数量达到 maxFiles 限制数量被拒绝时调用
		function _modalLeaderImageMaxFilesExceeded(f) {
			// console.log('_modalLeaderImageMaxFilesExceeded->'+JSON.stringify(f));
			modalLeaderDropZone.removeFile(f);
		}		
		
	</script><?php endif; ?>
<?php if(!empty($modal_select_image)): if(empty($modal_upload_image) == true): ?><!-- 上传图片确认 -->
	<div class="modal fade custom-width" id="gallery-image-upload-modal" data-backdrop="static">
		<div class="modal-dialog" style="width: 90%">
			<div class="modal-content">
				
				<div class="modal-header">
					<h4 class="modal-title">上传图片</h4>
				</div>
				
				<div class="modal-body">
	
					<section class="gallery-env">
											
						<!-- Gallery Album Optipns and Images -->
						<div class="col-sm-9 gallery-right">
				
							<!-- Auto initialization -->
							<form id="ModalImageUpload" class="dropzone"></form>	
							
						</div>
						
						<!-- Gallery Sidebar -->
						<div class="col-sm-3 gallery-left">
							
							<!-- Album Header -->
							<div class="album-header">
								<h2>筛选</h2>
							</div>		
									
												
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片标题：</p><br />
										<input type="text" style="height: 32px;" class="dingdan_bianji col-sm-12 modal_img_title">
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片作者：</p><br />
										<input type="text" style="height: 32px;" class="dingdan_bianji col-sm-12 modal_img_author">
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_type_obj = $('.gallery-image-selector-modal').find(".modal_img_type").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													
													// 默认选择第一个
													var initVal = $(modal_image_type_obj).find('option:first').attr('value');									
													$(modal_image_type_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_type">
												<option value="-1">不限</option>
												<?php if(is_array($ImageTypes)): $i = 0; $__LIST__ = $ImageTypes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgType): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgType["id"]); ?>"><?php echo ($imgType["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片来源：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_from_obj = $('.gallery-image-selector-modal').find(".modal_img_from").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_from_obj).find('option:first').attr('value');									
													$(modal_image_from_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_from">
												<option value="-1">不限</option>
												<?php if(is_array($ImageFroms)): $i = 0; $__LIST__ = $ImageFroms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgFrom): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgFrom["id"]); ?>"><?php echo ($imgFrom["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>内容类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_content_obj = $('.gallery-image-selector-modal').find(".modal_img_content").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_content_obj).find('option:first').attr('value');									
													$(modal_image_content_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_content">
												<option value="-1">不限</option>
												<?php if(is_array($ImageContents)): $i = 0; $__LIST__ = $ImageContents;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgContent): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgContent["id"]); ?>"><?php echo ($imgContent["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>地域类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												function getMenuItem(parentObj, childObj) {
													if ($(parentObj).val() == null) {
														return false;
													}
													
													var jsonData = {
														op_type: 'find',
														data_type: 'all',
														parent_id: $(parentObj).val(),
													};
																				
													$.post('<?php echo U("menu/list");?>', jsonData, function(backData){
														if (backData.result.errno == 0) {
															$(childObj).data('selectBox-selectBoxIt').remove();
															if (backData.data != null) {
																for (var k=0; k < backData.data.length; k++) {		
																	var d = backData.data[k];													
																	$(childObj).data('selectBox-selectBoxIt').add({value:d['id'], text:d['item_desc']});
																}	
															}
														}
													});
												}
												
												var modal_image_domain_obj=null, modal_image_district_obj=null, modal_image_distination_obj=null;	
												jQuery(document).ready(function($)
												{
													modal_image_domain_obj = $('.gallery-image-selector-modal').find(".modal_img_domain").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													
													// 初始化
													var initVal = $(modal_image_domain_obj).find('option:first').attr('value');									
													$(modal_image_domain_obj).val(initVal).trigger('change');
													
													// 选项改变
													$(modal_image_domain_obj).change(function(){	
														if (modal_image_domain_obj != null && modal_image_district_obj != null) {
															getMenuItem(modal_image_domain_obj, modal_image_district_obj);
														}									
													});
													
												});
											</script>
											<select class="form-control modal_img_domain">
												<option value="-1">不限</option>
												<?php if(is_array($ImageDomains)): $i = 0; $__LIST__ = $ImageDomains;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgDomain): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgDomain["id"]); ?>"><?php echo ($imgDomain["item_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>辖区类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													modal_image_district_obj = $('.gallery-image-selector-modal').find(".modal_img_district").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_district_obj).find('option:first').attr('value');									
													$(modal_image_district_obj).val(initVal).trigger('change');
												});
													
												// 选项改变
												$(modal_image_district_obj).change(function(){	
													if (modal_image_district_obj != null && modal_image_distination_obj != null) {
														getMenuItem(modal_image_district_obj, modal_image_distination_obj);
													}									
												});
											</script>
											<select class="form-control modal_img_district">
												<option value="-1">不限</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>目的地：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_distination_obj = $('.gallery-image-selector-modal').find(".modal_img_distination").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_distination_obj).find('option:first').attr('value');									
													$(modal_image_distination_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_distination">
												<option value="-1">不限</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
																					
						</div> <!--End Left-->
									
					</section>
					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-secondary btn-use">上传并使用</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		// 上传成功的回调函数
		var funcModalUploadCallBack = null;
		var modalUploadCallBack = null;
		var modalDropZone = null;
		var modalImageList = null;
		var modalUploadMaxFileCount = 20;
		var modalUploadMaxFileSize = 3;
		var modalUploadInitialized = false; // 已初始化
				
		// 显示上传插件
		function showModalUploadImageDialog(obj) {
			if (modalUploadInitialized == false) {
				_modalInitDropZone();
				// 一键上传所有图片
				$('#gallery-image-upload-modal').find('.btn-use').click(_modalUploadAllImage);
			}
			modalUploadCallBack = obj;
			_modalClearAllImage();
			$("#gallery-image-upload-modal").modal('show');
		}
		
		// 初始化上传插件
//		$(document).ready(function()
//			{
//			Dropzone.autoDiscover = false;
//			Dropzone.options.myAwesomeDropzone = false;
//			_modalInitDropZone();	
//			
//			// 上传所有图片
//			$('#gallery-image-upload-modal').find('.btn-use').click(_modalUploadAllImage);
//		});	
		
		// 初始化dropzone
		function _modalInitDropZone() {
			$('#ModalImageUpload').dropzone({
				url: '<?php echo U("image/fupload");?>',
				maxFiles: modalUploadMaxFileCount,	// 允许上传的文件个数
				maxFilesize: modalUploadMaxFileSize,	// 单个文件最大上传大小，3MB
				acceptFiles:'.jpg,.jpeg,.png,.gif',
				addRemoveLinks: true,
				uploadMultiple: false,
				autoProcessQueue: false,
				dictDefaultMessage: '点击此处添加图片',
				dictRemoveFile: '删除',
				init:function(){
					modalDropZone = this;
					this.on('addedfile', _modalAddUploadImage);
					this.on('removedfile', _modalRemoveUploadImage);
					this.on('error', _modalImageError);
					this.on('processing', _modalImageProcessing);
					this.on('uploadprogress', _modalImageUploadProgress);
					this.on('sending', _modalImageSending);
					this.on('success', _modalImageSucess);
					this.on('complete', _modalImageComplete);
					this.on('canceled', _modalImagecanceled);
					this.on('maxfilesreached', _modalImageMaxFilesReached);
					this.on('maxfilesexceeded', _modalImageMaxFilesExceeded);
									
				},
			});
			modalUploadInitialized = true;
		}
		
		
		// 检测是否可以添加图片
		var modalFileCount = 0;
		function _modalCheckAllowUpload() {
			modalFileCount = modalDropZone.getAcceptedFiles().length;	
			if (modalFileCount < 1) {
				alert('请上传照片...');
				return false;
			}
			if (modalFileCount > 20) {
				alert('您一次上传的照片不应该超过20张');
				return false;
			}
			return true;
		}
		
		// 检查编辑图片的信息
		function _modalcheckImageInfo() {
			var rootObj = $('#gallery-image-upload-modal');
			var title = $(rootObj).find('.modal_img_title').val();
			if (title == '') {
				alert('图片的标题不能为空，可能的话请尽量补全其它图片信息，谢谢合作!');
				return false;
			}
			return true;
		}
		
		// 添加所有图片
		function _modalUploadAllImage(){
			// 检查是否允许上传
		    if (_modalCheckAllowUpload() == false) {
		    	return false;
		    }
		    // 检查图片描述
		    if (_modalcheckImageInfo() == false) {
		    	return false;
		    }
			
			// 加载上传等待层
			showLoading(true);
			// 开始上传
			modalDropZone.processQueue();
			
			modalImageList = new Array();
//			var fs = modalDropZone.getAcceptedFiles();
//			for (var i = 0; i < fs.length; ++ i) {
//			}
			
		}
		
		// 清除所有添加的图片
		function _modalClearAllImage(){	
			// console.log('_modalClearAllImage->清除所有图片');
			modalDropZone.removeAllFiles(true);
		}
		
		// 添加图片
		function _modalAddUploadImage(f) {	
			// console.log('_modalAddUploadImage->'+JSON.stringify(f));		
			//alert('add:' + f.name);
//			f.previewElement.addEventListener("click", function(f) {
//				alert(111);
//				modalDropZone.removeFile(f);
//			});
			
		}
		
		// 删除图片
		function _modalRemoveUploadImage(f) {
			// console.log('_modalRemoveUploadImage->'+JSON.stringify(f));	
		}
		
		// 出错时. 接受 errorMessage 作为第二个参数，并且如果错误是 XMLHttpRequest对象， 那就作为第三个参数.
		function _modalImageError(f, errMsg, xhr) {
			// console.log('_modalImageError->'+ JSON.stringify(f) + ",error:" + errMsg);	
		}
		
		// 当一个文件获取处理 （因为不是所有的文件会立即得到处理的队列）。以前，此事件被称为 processingfile
		function _modalImageProcessing(f) {
			// console.log('_modalImageProcessing->'+JSON.stringify(f));	
		}
		
		//	无论文件在什么时候被改变都会调用此函数.
		//	处理进度作为第二个参数，范围为(0-100); 发送到服务的字节数作为第三个参数
		//	当上传文件完成确保至少一次处理进度被设置为100%
		//	警告: 函数可能同时被多次调用
		function _modalImageUploadProgress(f, p, b) {
			// console.log('_modalImageUploadProgress->'+JSON.stringify(f) + ",process" + p + ",byte:" + b + "KB");
		}
		
		// 在每个文件被发送前调用. 得到 xhr 对象 和 formData 对象作为第二个和第三个参数, 所以你可以修改他们(add a CSRF token) 或者追加额外的数据.
		function _modalImageSending(f, xhr, formData) {	
			var rootObj = $('#gallery-image-upload-modal');
			formData.append('title', $(rootObj).find('.modal_img_title').val());
			formData.append('author', $(rootObj).find('.modal_img_author').val());
			formData.append('intro', $(rootObj).find('.img_intro').val());
//			formData.append('type_id', $(rootObj).find('.modal_img_type').val());
			formData.append('from_type_id', $(rootObj).find('.modal_img_from').val());
			formData.append('content_type_id', $(rootObj).find('.modal_img_content').val());
			formData.append('tags', $(rootObj).find('.modal_img_domain').val());
			formData.append('domain_type_id', $(rootObj).find('.img_domain').val());
			formData.append('district_type_id', $(rootObj).find('.modal_img_district').val());
			formData.append('distination_type_id', $(rootObj).find('.modal_img_distination').val());
			// console.log('_modalImageSending->'+JSON.stringify(f)+JSON.stringify(formData));	
		}
		
		// 文件已经成功上传，获得服务器返回信息作为第二个参数(这个时间又被称作finished)
		function _modalImageSucess(f, backData) {
			// console.log('_modalImageSucess->'+JSON.stringify(f)+JSON.stringify(backData));
			if (backData['result']['errno'] == 0) {
				// 调用上传成功图片函数
				var imageUrl = backData.ds.url;
				modalImageList.push(imageUrl);
				// 上传成功后移除该文件
				modalDropZone.removeFile(f);
				
				
			} else {
				alert('上传失败,原因如下:\n' + backData['result']['message']);
			}
		}
		
		// 当上传完成，成功或者出现错误时调用
		function _modalImageComplete(f) {
			// console.log('_modalImageComplete->'+JSON.stringify(f));
//			goBtnTop($('#gallery-image-upload-modal').find('.btn-use'));
//			console.log(123);
			modalFileCount--;
			if (modalFileCount == 0) {
				if (typeof(funcModalUploadCallBack) == 'function') {
					funcModalUploadCallBack(modalUploadCallBack, modalImageList);
					
				}
				showLoading(false);
				// 关闭窗口
				$('#gallery-image-upload-modal').modal('hide');
				
			}
			if (f.accepted != false) {
				modalDropZone.processQueue();	
			}
		}
		
		// 当取消文件上传式调用
		function _modalImagecanceled(f) {
			// console.log('_modalImagecanceled->'+JSON.stringify(f));
		}
		
		// 当文件的数量达到maxFiles限制时调用
		function _modalImageMaxFilesReached(f) {
			// console.log('_modalImageMaxFilesReached->'+JSON.stringify(f));
		}
		
		// 由于文件数量达到 maxFiles 限制数量被拒绝时调用
		function _modalImageMaxFilesExceeded(f) {
			// console.log('_modalImageMaxFilesExceeded->'+JSON.stringify(f));
			modalDropZone.removeFile(f);
		}		
		
	</script><?php endif; ?>
	
	<link rel="stylesheet" href="/source/Static/home/common/css/page.css">
	<style type="text/css">		
		.selectboxit-btn { background: #fff; border-color: #4EC83B; }
		.selectboxit-list { background-color: #fff; border: 1px solid #4EC83B; }
		.selectboxit-list .selectboxit-option-anchor { color: #979898; }
		.form-control:focus { border-color: #4EC83B; }
		a { color: #979898; }
		.dingdan_bianji { border: 1px solid #4EC83B; }
		.dingdan_bottom > p , .dingdan_bottom > span{ margin-top: 7px; }
		.dingdan_bottom { margin-bottom: 10px; }
		
		.hidden_ctrl {
			display: none;
		}
		.modal_my_pic_border{
			height: 180px;
			border:1px solid #4EC83B; 
    		overflow: hidden;
		}
		.modal_my_pic { 
   			position: relative;
		}
		#filter_button {
			background-color: #68b828;
			color: #fff;
		}
		.modal_my_pic_border i { position: absolute; bottom:0; left:0; display: block; width:100%; height: 32px; line-height:32px; text-align: center; font-style:normal; background-color:#5ca323; color:#fff; cursor: pointer; z-index: 9; }
		.gallery-env .album-images .album-image .thumb img { max-height: 146px; }
		.pagination > li { display: inline-block; margin-top:5px; }
	</style>
	<script type="text/javascript">
	// Sample Javascript code for this page
	jQuery(document).ready(function($)
	{
		// Sample Select all images
		$("#gallery-image-selector-modal").find('#select-all').on('change', function(ev)
		{
			ev.preventDefault();
			var is_checked = $(this).is(':checked');			
//			$(".album-image input[type='checkbox']").prop('checked', is_checked).trigger('change');
			if (is_checked) {
				$(".image-checkbox img").removeClass('hidden_ctrl');
			} else {
				$(".image-checkbox img").addClass('hidden_ctrl');
			}
			
		});		
	});
	</script>
	
	<!-- 选择图片确认 -->
	<div class="modal fade custom-width" id="gallery-image-selector-modal" data-backdrop="static">
		<div class="modal-dialog" style="width: 90%">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h1 class="modal-title">选择图片</h1>
				</div>
				
				<div class="modal-body">
	
					<section class="gallery-env">
											
						<!-- Gallery Album Optipns and Images -->
						<div class="col-sm-9 gallery-right">
							
							<!-- Album Header -->
							<div class="album-header">
								<h2>图片列表</h2>
								
								<ul class="album-options list-unstyled list-inline">
									<li>
										<input type="checkbox" class="cbr" id="select-all" />
										<label for="select-all">全选</label>
									</li>
									<li>
										<a class="modal_select_image_upload" href="javascript:;">
											<i class="fa-upload"></i>
											上传
										</a>
									</li>
								</ul>
							</div>			
								
							<!-- Template Album Image -->
							<div class="col-md-3 col-sm-4 col-xs-6 template_ablum hidden_ctrl">
								<div class="album-image" data-id="">									
									<div class="image-checkbox">
										<!--<input type="checkbox" class="cbr" />-->
										<img class="hidden_ctrl" src="/source/Static/back/images/ok.png" />
									</div>
									
									<a href="#" class="thumb modal_my_pic_border">
										<img src="" class="img-responsive modal_my_pic" />
										<i>选择并使用</i>
									</a>
									
									<a href="#" class="name">
										<span></span>
										<p></p>
									</a>
								</div>
							</div>
										
							<div class="list-page"></div>
							<!--<ul class="pagination">
							</ul>-->
							
							<!-- Album Images -->
							<div class="album-images row">					
							</div>
										
							<!--<ul class="pagination">
							</ul>-->
							
							<div class="list-page"></div>
							
						</div>
						
						<!-- Gallery Sidebar -->
						<div class="col-sm-3 gallery-left">
							
							<!-- Album Header -->
							<div class="album-header">
								<h2>筛选</h2>
							</div>		
							
							<!--<div class="gallery-sidebar">-->		
												
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片标题：</p><br />
										<input type="text" style="height: 32px;" class="dingdan_bianji col-sm-12 modal_img_title">
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片作者：</p><br />
										<input type="text" style="height: 32px;" class="dingdan_bianji col-sm-12 modal_img_author">
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_type_obj = $('.gallery-image-selector-modal').find(".modal_img_type").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													
													// 默认选择第一个
													var initVal = $(modal_image_type_obj).find('option:first').attr('value');									
													$(modal_image_type_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_type">
												<option value="-1">不限</option>
												<?php if(is_array($ImageTypes)): $i = 0; $__LIST__ = $ImageTypes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgType): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgType["id"]); ?>"><?php echo ($imgType["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片来源：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_from_obj = $('.gallery-image-selector-modal').find(".modal_img_from").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_from_obj).find('option:first').attr('value');									
													$(modal_image_from_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_from">
												<option value="-1">不限</option>
												<?php if(is_array($ImageFroms)): $i = 0; $__LIST__ = $ImageFroms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgFrom): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgFrom["id"]); ?>"><?php echo ($imgFrom["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>内容类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_content_obj = $('.gallery-image-selector-modal').find(".modal_img_content").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_content_obj).find('option:first').attr('value');									
													$(modal_image_content_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_content">
												<option value="-1">不限</option>
												<?php if(is_array($ImageContents)): $i = 0; $__LIST__ = $ImageContents;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgContent): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgContent["id"]); ?>"><?php echo ($imgContent["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>地域类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												function getMenuItem(parentObj, childObj) {
													if ($(parentObj).val() == null) {
														return false;
													}
													
													var jsonData = {
														op_type: 'find',
														data_type: 'all',
														parent_id: $(parentObj).val(),
													};
																				
													$.post('<?php echo U("menu/list");?>', jsonData, function(backData){
														if (backData.result.errno == 0) {
															$(childObj).data('selectBox-selectBoxIt').remove();
															if (backData.data != null) {
																for (var k=0; k < backData.data.length; k++) {		
																	var d = backData.data[k];													
																	$(childObj).data('selectBox-selectBoxIt').add({value:d['id'], text:d['item_desc']});
																}	
															}
														}
													});
												}
												
												var modal_image_domain_obj=null, modal_image_district_obj=null, modal_image_distination_obj=null;	
												jQuery(document).ready(function($)
												{
													modal_image_domain_obj = $('.gallery-image-selector-modal').find(".modal_img_domain").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													
													// 初始化
													var initVal = $(modal_image_domain_obj).find('option:first').attr('value');									
													$(modal_image_domain_obj).val(initVal).trigger('change');
													
													// 选项改变
													$(modal_image_domain_obj).change(function(){	
														if (modal_image_domain_obj != null && modal_image_district_obj != null) {
															getMenuItem(modal_image_domain_obj, modal_image_district_obj);
														}									
													});
													
												});
											</script>
											<select class="form-control modal_img_domain">
												<option value="-1">不限</option>
												<?php if(is_array($ImageDomains)): $i = 0; $__LIST__ = $ImageDomains;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgDomain): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgDomain["id"]); ?>"><?php echo ($imgDomain["item_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>辖区类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													modal_image_district_obj = $('.gallery-image-selector-modal').find(".modal_img_district").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_district_obj).find('option:first').attr('value');									
													$(modal_image_district_obj).val(initVal).trigger('change');
												});
													
												// 选项改变
												$(modal_image_district_obj).change(function(){	
													if (modal_image_district_obj != null && modal_image_distination_obj != null) {
														getMenuItem(modal_image_district_obj, modal_image_distination_obj);
													}									
												});
											</script>
											<select class="form-control modal_img_district">
												<option value="-1">不限</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>目的地：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_distination_obj = $('.gallery-image-selector-modal').find(".modal_img_distination").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_distination_obj).find('option:first').attr('value');									
													$(modal_image_distination_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_distination">
												<option value="-1">不限</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>日期时间段：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<div class="daterange daterange-inline add-ranges modal_img_datetime" data-time-picker="true" data-time-picker-increment="5" data-format="YYYY-MM-DD HH:mm:ss">
												<i class="fa-calendar"></i>
												<span></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p id="filter_button" class="btn btn-block btn-icon btn-icon-standalone btn-icon-standalone-right">
											<i class="linecons-photo"></i>
											<span>筛选</span>
										</p>
									</div>
								</div>
							</div>
							
						</div> <!--End Left-->
									
					</section>
					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-secondary">选择并使用</button>
				</div>
			</div>
		</div>
	</div>
	
	<script src="/source/Static/home/js/page.js"></script>
	<script type="text/javascript">
		// 页面切换回调函数
		var funcModalImageSelectorPageChanged = null;
		// 选择图片回调函数传入的对象
		var modalImageSelectorCallBackObj = null;
		// 选择图片回调函数
		var funcModalImageSelectorCallBack = null;
		$(document).ready(function(){
			// 绑定页面切换回调函数
			funcModalImageSelectorPageChanged = _modalImageSelectorAjaxImageList;
									
			// 查看当前点击的图片
			$('.modal_my_pic_border img').click(function(ev){								
//				showLookImageModal();
//				setModalLookImage($(this).find('img'));
				ev.preventDefault();
				var ckObj = $(this).parents('.album-image').find('.image-checkbox img');
				if ($(ckObj).hasClass('hidden_ctrl')) {
					$(ckObj).removeClass('hidden_ctrl');
				} else {
					$(ckObj).addClass('hidden_ctrl');
				}
			});
			
			
			// 筛选图片
			$('#filter_button').click(modalImageSelectorfilterImages);
			
			// 确认使用已选图片事件
			function modalImageSelectorSure(){
				if (typeof(funcModalImageSelectorCallBack) == 'function') {
					var idx = 0;
					var imageList = new Array();
					$(".image-checkbox img").each(function(i, el){
						if ($(el).parent().parent().parent().hasClass('hidden_ctrl') == false) {
							if ($(el).hasClass('hidden_ctrl') == false) {
								imageList[idx] = $(el).closest('.album-image').find('.modal_my_pic').attr('src');
								idx ++;
							}	
						}
					});	
					funcModalImageSelectorCallBack(modalImageSelectorCallBackObj, imageList);					
				}					
				
				// 显示模态对话框
				$("#gallery-image-selector-modal").modal('hide');
			};
			
			// 确认使用选择的图片
			$('#gallery-image-selector-modal').find('.btn-secondary').click(modalImageSelectorSure);
			
			// 选择并使用图片
			$('.modal_my_pic_border i').click(function(ev){
				ev.preventDefault();
				var ckObj = $(this).parents('.album-image').find('.image-checkbox img');
				if ($(ckObj).hasClass('hidden_ctrl')) {
					$(ckObj).removeClass('hidden_ctrl');
				}
				modalImageSelectorSure();
			});
		});
		
		// 显示图片选择
		function showModalSelectorImageDialog(obj) {
			modalImageSelectorCallBackObj = obj;
			// 初始图片列表
			_modalImageSelectorAjaxImageList(0, true);
			// 绑定显示回调函数
			funcGetImageUrl = modalSelectorLookImage;
			// 显示模态对话框
			$("#gallery-image-selector-modal").modal('show');
		}
		
		// 筛选图片
		function modalImageSelectorfilterImages(ev) {
			ev.preventDefault();
//			var pageIndex = parseInt($('.pagination').find('.active').attr('data-id'));
			
			var pageIndex = $('#gallery-image-selector-modal').find('.list-page').attr('data-page-index');
			_modalImageSelectorAjaxImageList(pageIndex, true);
		}
	
		// 获取当前点击图片的
		function modalSelectorLookImage(obj, imgIndex) {	
//			alert(obj + ',index:'+imgIndex);			
			var imageObj = obj;
			if (typeof(obj) != 'object') {
				if (parseInt(imgIndex) > 0) {
					imageObj = $('.album-image').eq(-1);
				} else {
					imageObj = $('.album-image').eq(0);
				}
			} else {
				if (parseInt(imgIndex) < 0) {
					var imgRoot = $(obj).closest('.album-image').parent().prev();
//					alert($(imgRoot).length);
					return $(imgRoot).length == 0 ? -1 : $(imgRoot).find('.modal_my_pic_border').find('img');
				} else if (parseInt(imgIndex) > 0) {			
					var imgRoot = $(obj).closest('.album-image').parent().next();
//					alert($(imgRoot).length);
					return $(imgRoot).length == 0 ? 1 : $(imgRoot).find('.modal_my_pic_border').find('img');
				} else {
					imgRoot = obj;
				}
			}
			return imageObj;
		}
		
		// 重新添加页码
		function modalImageSelectorInitPageNum(pageCount, pageIndex) {
			var rootObj = $('.pagination');
			// 清空页码
			$(rootObj).empty();			
			// 重新添加页码
			if (pageCount > 1) {
				var vhtml = '<li class="disabled" data-id="0"><a href="#"><i class="fa-angle-double-left"></i></a></li>';
					vhtml += '<li class="disabled" data-id="-1"><a href="#"><i class="fa-angle-left"></i></a></li>';
				var activeIndex = pageIndex >= 0 && pageIndex < pageCount ? pageIndex : 0;
				for (var i=0; i<pageCount; i++) {
					var showPageIndex = i+1;
					if (i == activeIndex) {
						vhtml += '<li class="active" data-id="'+i+'"><a href="#">'+showPageIndex+'</a></li>';
					} else {
						vhtml += '<li data-id="'+i+'"><a href="#">'+showPageIndex+'</a></li>';
					}
				}
				vhtml += '<li data-id="+1"><a href="#"><i class="fa-angle-right"></i></a></li>';
				vhtml += '<li data-id="'+parseInt(pageCount-1)+'"><a href="#"><i class="fa-angle-double-right"></i></a></li>';				
				$(rootObj).append(vhtml);
				
				// 绑定翻页事件
				$(rootObj).find('li').click(function(){
					if ($(this).hasClass('disabled') == false && $(this).hasClass('active') == false) {
						var tempPageIndex = 0;
						var dataId = $(this).attr('data-id');
						if (dataId == '-1') {
							var page = $(this).parent().find('.active').attr('data-id');
							tempPageIndex = parseInt(page)-1;
						} else if (dataId == '+1') {
							var page = $(this).parent().find('.active').attr('data-id');
							tempPageIndex = parseInt(page)+1;
						} else {
							tempPageIndex = parseInt(dataId);
						}
						
						if (typeof(funcModalImageSelectorPageChanged) == 'function'){
							funcModalImageSelectorPageChanged(tempPageIndex);	
						}
					}
				});
			}			
		}
		
		// 刷新页码样式
		function modalImageSelectorRefreshPageStyle(pageIndex, pageCount) {
			var pageObj = $('#gallery-image-selector-modal').find('.list-page');
			constructionPage(pageObj, pageIndex, pageCount, _modalImageSelectorAjaxImageList,false);
			return false;
			
			if (pageIndex == 0) {
				$('.pagination').find('li').eq(0).addClass('disabled');
				$('.pagination').find('li').eq(1).addClass('disabled');
				$('.pagination').find('li').eq(-1).removeClass('disabled');
				$('.pagination').find('li').eq(-2).removeClass('disabled');
			} else if (pageIndex == (pageCount - 1)){		
				$('.pagination').find('li').eq(0).removeClass('disabled');
				$('.pagination').find('li').eq(1).removeClass('disabled');
				$('.pagination').find('li').eq(-1).addClass('disabled');
				$('.pagination').find('li').eq(-2).addClass('disabled');
			} else {
				$('.pagination').find('li').eq(0).removeClass('disabled');
				$('.pagination').find('li').eq(1).removeClass('disabled');
				$('.pagination').find('li').eq(-1).removeClass('disabled');
				$('.pagination').find('li').eq(-2).removeClass('disabled');
			}
			
			$('.pagination').find('li').removeClass('active');
			$('.pagination').find('li').eq(pageIndex+2).addClass('active');	
		}
				
		// 请求图片列表
		function _modalImageSelectorAjaxImageList(pageIndex, bInitPage){
			var rootObj = $('#gallery-image-selector-modal');
			var jsonData = {
				page_index: pageIndex,
				title: $(rootObj).find('.modal_img_title').val(),
				author: $(rootObj).find('.modal_img_author').val(),
				type_id: $(rootObj).find('.modal_img_type').val(),
				from_type_id: $(rootObj).find('.modal_img_from').val(),
				content_type_id: $(rootObj).find('.modal_img_content').val(),
				domain_type_id: $(rootObj).find('.modal_img_domain').val(),
				district_type_id: $(rootObj).find('.modal_img_district').val(),
				distination_type_id: $(rootObj).find('.modal_img_distination').val(),
				data_time_range: $(rootObj).find('.modal_img_datetime').find('span').html(),
			}
			
//			console.log(JSON.stringify(jsonData));
			showLoading(true);
			$.post('<?php echo U("image/list");?>', jsonData, function(data){
				showLoading(false);
				if (data.result.errno == 0) {
					// 清空图片容器				
					var containerObj = $('.album-images');
					$(containerObj).empty();
					// 填充新图片
					if (data.ds != null && data.ds != 'undefined') {
						for (var i = 0; i < data.ds.length; i++) {
							var iData = data.ds[i];
							var rootObj = $('.template_ablum').clone(true);
							$(rootObj).removeClass('template_ablum');
							$(rootObj).removeClass('hidden_ctrl');
							
							$(rootObj).find('.album-image').attr('data-id', iData.id);
							$(rootObj).find('.modal_my_pic').attr('src', iData.path);
							
							var infoObj = $(rootObj).find('.name');
							$(infoObj).find('span').html(iData.title);
							$(infoObj).find('p').html(iData.create_time);
							$(containerObj).append(rootObj);						
						}
					}
					
					var pageObj = $('#gallery-image-selector-modal').find('.list-page');
					// 刷新页码
					if (typeof(bInitPage) != 'undefined') {
						constructionPage(pageObj, pageIndex, data.page_count, _modalImageSelectorAjaxImageList,true);
//						modalImageSelectorInitPageNum(data.page_count, pageIndex);
					} else {
						modalImageSelectorRefreshPageStyle(pageIndex, data.page_count);
					}								
				} else {
					toastr.error(data.result.message);
				}
			});
		}
		
		// 调用上传界面
		$('.modal_select_image_upload').click(function(ev){
			ev.preventDefault();
			
			// 关闭图片选择对话框
			$("#gallery-image-selector-modal").modal('hide');
			
			funcModalUploadCallBack = funcModalImageSelectorCallBack;
			showModalUploadImageDialog(modalImageSelectorCallBackObj);
		});
				
	</script><?php endif; ?>
<?php if(!empty($modal_crop_image)): ?>这是图片裁剪页面<?php endif; ?>
<?php if(!empty($modal_look_image)): ?><!--Modal-->
	<div id="modal_look_image"  class="modal fade custom-width">
		<div class="modal-dialog" style="width: 80%">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="modal_select_image_title" class="modal-title">图片浏览</h3>
				</div>
				
				<div class="modal-body">
					<div class="row div_container">
						<div class="div_image_show">
							<img class="image_show_block" src="" />
						</div>
						<div class="div_perview_button"></div>
						<div class="div_next_button"></div>
					</div>					
				</div>			
				<div class="modal-footer">
					<p class="modal_look_image_msg" style="color: red;"></p>
					<button type="button" class="btn btn-info" data-dismiss="modal">关闭窗口</button>
				</div>	
			</div>
		</div>
	</div>
	<style type="text/css">
		.div_container {
			width: 900px;
			height: 600px;
		}
		.div_perview_button{
			position: absolute;
			left: 0px;
			width: 50%;
			height: 95%;
		}
		.div_next_button{
			position: absolute;
			right: 0px;
			width: 50%;
			height: 95%;
		}
		.div_image_show {
			position: absolute;
			left: 0px;
			right: 0px;
			width: 100%;
			height: 95%;
		}
		.image_show_block {
			clear: both;
			display: block;
			margin: auto;			
			max-width: 100%;
			max-height: 100%;
			vertical-align: middle;
		}
		.select_border {
			border-style: dotted;
			border-width: 1px;		
			border-color: #f00;	 
		}
		.select_border1 {
			border-style: dotted;
			border-width: 1px;		
			border-color: #00f;	 
		}
	</style>
	<script type="text/javascript">
		var modalLookImageUrlList;
		var modalLookCurIndex=0;
		
		var funcGetImageUrl = null;
		var modalLookCurImageObj = null;
		
		$(document).ready(function(){
			// 初始化窗口
			_initLookImageModal();
		});
		
		// 重置选择图片Modal
		function resetLookImageModal() {	
		}
		
		// 鼠标进入
		function _modalLookImageChange(obj, addCount, selected) {
			if (selected === true) {	
				if (!$(obj).hasClass("select_border")) {
					$(obj).addClass("select_border");
				}	
			} else {	
				if ($(obj).hasClass("select_border")) {
					$(obj).removeClass("select_border");	
				}
			}
			
			modalLookCurImageObj = funcGetImageUrl(modalLookCurImageObj, addCount);			
			if (typeof(modalLookCurImageObj) != 'object') {
				if (parseInt(modalLookCurImageObj) < 0) {
					$('.modal_look_image_msg').show();
					$('.modal_look_image_msg').html('前面没有更多图片可供浏览了');
					$('.modal_look_image_msg').fadeOut(5000);					
				} else if (parseInt(modalLookCurImageObj) > 0) {
					$('.modal_look_image_msg').show();
					$('.modal_look_image_msg').html('已经是最后一张图片了');
					$('.modal_look_image_msg').fadeOut(5000);
				} else {
					alert('错误浏览对象!!!!');
				}
				return false;
			}
			
			var imageUrl = $(modalLookCurImageObj).prop('src');
			$('.image_show_block').prop('src', imageUrl);
			
//			if (modalLookImageUrlList == 'undefined') {
//				return;
//			}
//			if (addCount == 0) {
//				return;
//			}
//			modalLookCurIndex += addCount;
//			var len = modalLookImageUrlList.length;	
//			if (modalLookCurIndex < 0) {
//				modalLookCurIndex = len-1;
//			}
//			if (modalLookCurIndex >= len) {
//				modalLookCurIndex = 0;
//			}
//			_refreshModalLookImage();
		}
		
		// 初始化
		function _initLookImageModal() {
			// 窗口显示
			$('#modal_look_image').on('show.bs.modal', function () {
			});
			
			// 窗口关闭
			$('#modal_look_image').on('hide.bs.modal', function () {
				resetLookImageModal();
			});
			
			// 鼠标进入
			$('.div_perview_button').mouseenter(function(){_modalLookImageChange(this, 0, true)});
			$('.div_next_button').mouseenter(function(){_modalLookImageChange(this, 0, true)});
			// 鼠标离开
			$('.div_perview_button').mouseleave(function(){_modalLookImageChange(this, 0, false)});
			$('.div_next_button').mouseleave(function(){_modalLookImageChange(this, 0, false)});
			// 鼠标点击			
			$('.div_perview_button').click(function(){_modalLookImageChange(this, -1, true)});
			$('.div_next_button').click(function(){_modalLookImageChange(this, 1, true)});
		}
		
		// 刷新当前图片
		function _refreshModalLookImage() {
			if (modalLookImageUrlList.length == 0) {
				alert('图片列表中没有可供浏览的图片');
				return;
			}
			
			if (modalLookCurIndex < 0 || modalLookCurIndex >= modalLookImageUrlList.length) {
				alert('浏览图片的索引错误');
				return;
			}
			
			$('.image_show_block').prop('src', modalLookImageUrlList[modalLookCurIndex]);
		}
		
		// 设置浏览的图片列表
		function setModalLookImageList(imageList, curIndex) {
			modalLookImageUrlList = imageList;
			modalLookCurIndex = curIndex;
			_refreshModalLookImage();
		}
		
		// 设置当前图片对象
		function setModalLookImage(imageObj) {
			modalLookCurImageObj = imageObj;
			if ($(imageObj).get(0).tagName == 'img') {
				$('.image_show_block').prop('src', $(imageObj).prop('src'));
			}
		}
		
		// 显示窗口
		function showLookImageModal() {
			$("#modal_look_image").modal('show', {backdrop: 'static'});
		}
		
		// 隐藏窗口
		function hideLookImageModal() {
			resetLookImageModal();
			$("#modal_look_image").modal('hide');
		}
		
	</script><?php endif; ?>
<?php if(!empty($modal_delete_image)): ?><!-- 删除图片确认 -->
	<div class="modal fade" id="gallery-image-delete-modal" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<h4 class="modal-title">图片删除确认</h4>
				</div>
				
				<div class="modal-body">
				
					您确定要删除这些图片吗?
					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-danger">删除</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		var funcModalDeleteImageCallBack = null;			
		// 删除图片
		$('#gallery-image-delete-modal').find('.btn-danger').click(function(){
			if (typeof(funcModalDeleteImageCallBack) == 'function') {
				funcModalDeleteImageCallBack();
			}
			$('#gallery-image-delete-modal').modal('hide');
		});
		
		// 显示删除界面
		function showModalDeleteImageDialog() {
			$("#gallery-image-delete-modal").modal('show');
		}
	</script><?php endif; ?>
<?php if(!empty($modal_edit_image)): ?><!-- Gallery Modal Image -->
	<div class="modal fade" id="gallery-image-edit-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-gallery-image">
					<img src="" class="img-responsive" />
				</div>
				
				<div class="modal-body">
									
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label for="modal_img_title" class="control-label">图片标题：</label>
								<input id="modal_img_title" type="text" class="form-control" style="border-color: #4EC83B;" placeholder="图片标题不能为空">
							</div>						
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label for="modal_img_author" class="control-label">图片作者：</label>
								<input id="modal_img_author" type="text" class="form-control" style="border-color: #4EC83B;">
							</div>							
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label for="modal_img_tags" class="control-label">图片标签：</label>
								<input id="modal_img_tags" type="text" class="form-control" style="border-color: #4EC83B;" placeholder="多个标签之间用逗号分隔开">
							</div>							
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label for="modal_img_intro" class="control-label">图片描述：</label>
								<textarea id="modal_img_intro" class="form-control autogrow" style="border-color: #4EC83B;" placeholder="请输出图片描述" style="min-height: 80px;"></textarea>
							</div>							
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label for="modal_img_type" class="control-label">图片类型：</label>
								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										var image_type_obj = $("#modal_img_type").selectBoxIt().on('open', function()
										{
											// Adding Custom Scrollbar
											$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
										});	
										// 默认选择第一个
										var initVal = $(image_type_obj).find('option:first').attr('value');									
										$(image_type_obj).val(initVal).trigger('change');
									});
								</script>
								<select id="modal_img_type" class="form-control">
									<option value="-1">不限</option>
									<?php if(is_array($ImageTypes)): $i = 0; $__LIST__ = $ImageTypes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgType): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgType["id"]); ?>"><?php echo ($imgType["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</div>							
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label for="modal_img_from" class="control-label">图片来源：</label>
								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										var image_from_obj = $("#modal_img_from").selectBoxIt().on('open', function()
										{
											// Adding Custom Scrollbar
											$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
										});	
										var initVal = $(image_from_obj).find('option:first').attr('value');									
										$(image_from_obj).val(initVal).trigger('change');
									});
								</script>
								<select id="modal_img_from" class="form-control">
									<option value="-1">不限</option>
									<?php if(is_array($ImageFroms)): $i = 0; $__LIST__ = $ImageFroms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgFrom): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgFrom["id"]); ?>"><?php echo ($imgFrom["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</div>								
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label for="modal_img_content" class="control-label">内容类型：</label>
								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										var image_content_obj = $("#modal_img_content").selectBoxIt().on('open', function()
										{
											// Adding Custom Scrollbar
											$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
										});	
										var initVal = $(image_content_obj).find('option:first').attr('value');									
										$(image_content_obj).val(initVal).trigger('change');
									});
								</script>
								<select id="modal_img_content" class="form-control">
									<option value="-1">不限</option>
									<?php if(is_array($ImageContents)): $i = 0; $__LIST__ = $ImageContents;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgContent): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgContent["id"]); ?>"><?php echo ($imgContent["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</div>								
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label for="modal_img_domain" class="control-label">地域类型：</label>
								<script type="text/javascript">
									function getMenuItem(parentObj, childObj) {
										if ($(parentObj).val() == null) {
											return false;
										}
										
										var jsonData = {
											op_type: 'find',
											data_type: 'all',
											parent_id: $(parentObj).val(),
										};
																	
										$.post('<?php echo U("menu/list");?>', jsonData, function(backData){
											if (backData.result.errno == 0) {
												$(childObj).data('selectBox-selectBoxIt').remove();
												if (backData.data != null) {
													for (var k=0; k < backData.data.length; k++) {		
														var d = backData.data[k];													
														$(childObj).data('selectBox-selectBoxIt').add({value:d['id'], text:d['item_desc']});
													}	
												}
											}
										});
									}
									
									var modal_image_domain_obj=null, modal_image_district_obj=null, modal_image_distination_obj=null;	
									jQuery(document).ready(function($)
									{
										modal_image_domain_obj = $("#modal_img_domain").selectBoxIt().on('open', function()
										{
											// Adding Custom Scrollbar
											$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
										});	
										
										// 初始化
										var initVal = $(modal_image_domain_obj).find('option:first').attr('value');									
										$(modal_image_domain_obj).val(initVal).trigger('change');
										
										// 选项改变
										$(modal_image_domain_obj).change(function(){
											if (modal_image_domain_obj != null && modal_image_district_obj != null) {
												getMenuItem(modal_image_domain_obj, modal_image_district_obj);
												if ($.isEmptyObject(modal_image_data) == false) {
													$(modal_image_district_obj).val(modal_image_data.district_type_id).trigger('change');
												}
											}									
										});
										
									});
								</script>
								<select id="modal_img_domain" class="form-control">
									<option value="-1">不限</option>
									<?php if(is_array($ImageDomains)): $i = 0; $__LIST__ = $ImageDomains;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgDomain): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgDomain["id"]); ?>"><?php echo ($imgDomain["item_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</div>								
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							
							<div class="form-group">
								<label for="modal_img_district" class="control-label">辖区类型：</label>
								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										modal_image_district_obj = $("#modal_img_district").selectBoxIt().on('open', function()
										{
											// Adding Custom Scrollbar
											$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
										});	
										var initVal = $(modal_image_district_obj).find('option:first').attr('value');									
										$(modal_image_district_obj).val(initVal).trigger('change');
									});
										
									// 选项改变
									$(modal_image_district_obj).change(function(){	
										if (modal_image_district_obj != null && modal_image_distination_obj != null) {
											getMenuItem(modal_image_district_obj, modal_image_distination_obj);
											if ($.isEmptyObject(modal_image_data) == false) {
												$(modal_image_distination_obj).val(modal_image_data.distination_type_id).trigger('change');	
											}
										}									
									});
								</script>
								<select id="modal_img_district" class="form-control">
									<option value="-1">不限</option>
								</select>
							</div>	
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label for="modal_img_distination" class="control-label">目的地：</label>
								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										var modal_image_distination_obj = $("#modal_img_distination").selectBoxIt().on('open', function()
										{
											// Adding Custom Scrollbar
											$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
										});	
									});
								</script>
								<select id="modal_img_distination" class="form-control">
									<option value="-1">不限</option>
								</select>
							</div>	
						</div>
					</div>
					
					
				</div>
				
				<div class="modal-footer modal-gallery-top-controls">
					<button type="button" class="btn btn-xs btn-white" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-xs btn-info">图片裁减</button>
					<button type="button" class="btn btn-xs btn-secondary">保存</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		var modal_image_ids = '';
		var modal_image_data = '';
		var funcModalImageEditCallBack = null;
	
		// 查询图片信息
		function _getImageInfo(pid) {
			var rs = false;
			$.ajaxSetup('async', true);
			console.log(rs);
			return rs;
		}
	
		// 显示编辑窗口
		function showModalImageEdit(ids) {
			if (ids == '') {
				return false;
			}
			
			var firstId = 0;
			var split_index = ids.indexOf(',');
			if (split_index == -1) {
				firstId = parseInt(ids);
			} else {
				firstId = parseInt(ids.substr(0, split_index));
			}
			
			$.post('<?php echo U("image/find");?>', {id: firstId}, function(data){
				if (data.result.errno == 0) {
					modal_image_data = data.ds;
					var iData = modal_image_data;
					var rootObj = $('#gallery-image-edit-modal');
					$(rootObj).find('.modal-gallery-image img').attr('src', iData.path);
					$(rootObj).find('#modal_img_title').val(iData.title);
					$(rootObj).find('#modal_img_author').val(iData.author);
					$(rootObj).find('#modal_img_tags').val(iData.tags);
					$(rootObj).find('#modal_img_intro').val(iData.intro);
					$(rootObj).find('#modal_img_type').val(iData.type_id).trigger('change');
					$(rootObj).find('#modal_img_from').val(iData.from_type_id).trigger('change');
					$(rootObj).find('#modal_img_content').val(iData.content_type_id).trigger('change');
					$(modal_image_domain_obj).val(iData.domain_type_id).trigger('change');
//					$(rootObj).find('#modal_img_domain').val(iData.domain_type_id).trigger('change');
//					$(rootObj).find('#modal_img_district').val(iData.district_type_id).trigger('change');
//					$(rootObj).find('#modal_img_distination').val(iData.distination_type_id).trigger('change');
					$(rootObj).modal('show');
				} else {
					alert(data.result.message);					
				}
			});
		}
		
		// 保存编辑的图片
		$('#gallery-image-edit-modal').find('.btn-secondary').click(function(){
			if (typeof(funcModalImageEditCallBack) == 'function' && typeof(modal_image_data) == 'object') {
				var rootObj = $('#gallery-image-edit-modal');
				var temp = {
					'title': $(rootObj).find('#modal_img_title').val(),
					'author': $(rootObj).find('#modal_img_author').val(),
					'intro': $(rootObj).find('#modal_img_intro').val(),
					'type_id': $(rootObj).find('#modal_img_type').val(),
					'from_type_id': $(rootObj).find('#modal_img_from').val(),
					'content_type_id': $(rootObj).find('#modal_img_content').val(),
					'tags': $(rootObj).find('#modal_img_tags').val(),
					'domain_type_id': $(rootObj).find('#modal_img_domain').val(),
					'district_type_id': $(rootObj).find('#modal_img_district').val(),
					'distination_type_id': $(rootObj).find('#modal_img_distination').val(),
				};
				
				var ds = new Object();
				if (temp.title != modal_image_data.title) {
					ds['title'] = temp.title;
				}
				if (temp.author != modal_image_data.author) {
					ds['author'] = temp.author;
				}
//				if (temp.type_id != modal_image_data.type_id) {
//					ds['type_id'] = temp.type_id;
//				}
				if (temp.from_type_id != modal_image_data.from_type_id) {
					ds['from_type_id'] = temp.from_type_id;
				}
				if (temp.content_type_id != modal_image_data.content_type_id) {
					ds['content_type_id'] = temp.content_type_id;
				}
				if (temp.tags != modal_image_data.tags) {
					ds['tags'] = temp.tags;
				}
				if (temp.domain_type_id != modal_image_data.domain_type_id) {
					ds['domain_type_id'] = temp.domain_type_id;
				}
				if (temp.district_type_id != modal_image_data.district_type_id) {
					ds['district_type_id'] = temp.district_type_id;
				}
				if (temp.distination_type_id != modal_image_data.distination_type_id) {
					ds['distination_type_id'] = temp.distination_type_id;
				}
				
				if ($.isEmptyObject(ds) == false) {
					funcModalImageEditCallBack(modal_image_ids, ds);	
				} else {
					alert('数据未改变,请修改后再次保存');
				}
				modal_image_ids = null;
				$(rootObj).modal('hide');
			}
		});
		
	</script><?php endif; ?>
<?php if(!empty($modal_xiuxiu)): ?><style type="text/css">
	/* 美图秀秀*/
	#xiuxiuEditor { position: fixed; width: 1024px; height: 768px; z-index: 999; }
	.xiuxiu-mark { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgb(0, 0, 0); filter: alpha(opacity=50); opacity: 0.5 !important;  z-index: 100; }
</style>
<input type="file" id="input_file_xiuxiu" name="input_file_xiuxiu" style="display: none"/>
<div id="div_xiuxiu"></div>	
<div class="xiuxiu-mark"></div>
<!--美图秀秀-->
<script src="http://open.web.meitu.com/sources/xiuxiu.js" type="text/javascript"></script>
<script type="text/javascript">	

/*
url: 上传地址
callFunc: 上传结束的回调地址
vobj: 绑定的对象（可选，填写后会自动绑定触发函数）
vargs: 上传附带的参数（可选，此参数会被一并上传到服务器，类型为json）
*/
function myxiuxiu(url, callFunc, vobj, vargs) {
	this.request_url = url;
	this.call_func = callFunc;
	this.bind_obj = vobj
	this.upload_args = vargs;
	
	// 处理点击显示秀秀
	if (this.bind_obj != null && this.bind_obj != 'undefined') {
		$(this.bind_obj).bind('click', {obj:this}, this.xiuxiuProcess);	
	}
	
	// 处理点击隐藏秀秀
	$('.xiuxiu-mark').bind('click', {obj:this}, this.hideModal);
}

// 显示美图秀秀，没有绑定对象时手动触发
myxiuxiu.prototype.showModal = function(argList){
	var thisObj = this;
	$('#xiuxiuEditor').show();
	$('.xiuxiu-mark').show();
//			location.href = '<?php echo U("user/face");?>';
	/*第1个参数是加载编辑器div容器，第2个参数是编辑器类型，第3个参数是div容器宽，第4个参数是div容器高*/
	xiuxiu.embedSWF("div_xiuxiu", 1, "100%", "100%");
	//修改为您自己的图片上传接口
	console.log(thisObj.request_url);
	xiuxiu.setUploadURL(thisObj.request_url);
	xiuxiu.setUploadType(2);
	xiuxiu.setLaunchVars("sizeTipVisible", 1);  
	xiuxiu.setLaunchVars("cropPresets", "");
	if (argList != null && argList != 'undefined') {
		console.log(JSON.stringify(argList));
		xiuxiu.setUploadArgs(argList);	
	}
	xiuxiu.setUploadDataFieldName("input_file_xiuxiu");
//	xiuxiu.onInit = function ()
//	{
//		xiuxiu.loadPhoto("http://open.web.meitu.com/sources/images/1.jpg");//修改为要处理的图片url
//	}
	xiuxiu.onUploadResponse = function (ds)
	{
		var data = $.parseJSON(ds);
		if (data.result != null) {
			if (data.result.errno != 0) {
				alert(data.result.message);
			}
		}
		if (thisObj.call_func) {
			thisObj.call_func(data);
		}
		$('.xiuxiu-mark').hide();
		$('#xiuxiuEditor').hide();			
	}
	
	// 设置秀秀位置
	var ww = $(window).width();
	var wh = $(window).height();
	var xw = $('#xiuxiuEditor').width();
	var xh = $('#xiuxiuEditor').height();
	var mtop = (wh - xh) * 0.5;
	var mleft = (ww - xw) * 0.5;
	$('#xiuxiuEditor').css('margin-top', mtop);
	$('#xiuxiuEditor').css('margin-left', mleft);	
}

// 显示美图秀秀，绑定对象时自动触发
myxiuxiu.prototype.xiuxiuProcess = function(e) {
	if (e.data == null || e.data.obj == null) {
		console.log('未绑定对象，不能触发事件');
		return false;
	}
	var thisObj = e.data.obj;
	$('#xiuxiuEditor').show();
	$('.xiuxiu-mark').show();
//			location.href = '<?php echo U("user/face");?>';
	/*第1个参数是加载编辑器div容器，第2个参数是编辑器类型，第3个参数是div容器宽，第4个参数是div容器高*/
	xiuxiu.embedSWF("div_xiuxiu", 5, "100%", "100%");
	//修改为您自己的图片上传接口
	xiuxiu.setUploadURL(thisObj.request_url);
	xiuxiu.setUploadType(2);
	xiuxiu.setLaunchVars("sizeTipVisible", 1);  
	xiuxiu.setLaunchVars("cropPresets", "");
	if (thisObj.upload_args != null && thisObj.upload_args != 'undefined') {
		xiuxiu.setUploadArgs(argList);	
	}
	xiuxiu.setUploadDataFieldName("input_file_xiuxiu");
	xiuxiu.onInit = function ()
	{
		xiuxiu.loadPhoto("http://open.web.meitu.com/sources/images/1.jpg");//修改为要处理的图片url
	}
	xiuxiu.onUploadResponse = function (ds)
	{
		var data = $.parseJSON(ds);
		if (data.result != null) {
			if (data.result.errno != 0) {
				alert(data.result.message);
			}
		}
		if (thisObj.call_func) {
			thisObj.call_func(data);
		}
		$('.xiuxiu-mark').hide();
		$('#xiuxiuEditor').hide();
	}
	
	// 设置秀秀位置
	var ww = $(window).width();
	var wh = $(window).height();
	var xw = $('#xiuxiuEditor').width();
	var xh = $('#xiuxiuEditor').height();
	var mtop = (wh - xh) * 0.5;
	var mleft = (ww - xw) * 0.5;
	$('#xiuxiuEditor').css('margin-top', mtop);
	$('#xiuxiuEditor').css('margin-left', mleft);
	
}

// 隐藏美图秀秀
myxiuxiu.prototype.hideModal = function(){
	$(this).hide();
	$('#xiuxiuEditor').hide();
}
</script><?php endif; ?>
<?php if(!empty($modal_admin_question)): endif; ?> 
<?php if(!empty($modal_line_article)): ?><!-- css Reset -->
<link rel="stylesheet" href="/source/Static/home/common/css/cssreset.css">
<link rel="stylesheet" href="/source/Static/home/css/farticle_list.css"/>
<style>
	.article-information-img {
	    position: relative;
	    width: 1000px !important;
	    height: 210px;
	    margin: 0 auto;
	    margin-bottom: 33px;
	    background-color: #fff;
	    overflow: visible !important;
	}
	.article-information-word {
		width: 1000px !important;	
	}
	.article-information-img a , .article-information-word a { position: absolute; top:0; left:0; width: 100%; height: 100%; }
</style>

<div class="modal fade custom-width" id="modalArticleSelect">
	<div class="modal-dialog" style="width: 80%;">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2 class="modal-title">文章选择</h2>
			</div>
			
			<div class="modal-body">
				<div class="modal-search">
					<input id="article_cnt" type="text" placeholder="输入您想要的文章标题"><a class="modal_farticle_search" href="javascript:;">搜索</a>
				</div>
				<div class="modal-list">
				</div>
				<!-- 翻页 -->
				<div class="modal-page" data-page-count="1" data-page-index="1"></div>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>

<script src="/source/Static/home/js/page.js"></script>
<script>
		//打开modal
		var funcModalArticleCallBack = null;
		var modalArticleFireObject = null;
		function showModalArticleSelect(obj, func) {
			modalArticleFireObject = obj;
			funcModalArticleCallBack = func;		
			// 清空所有选项
			modalArticleSelectClear();	
			$("#modalArticleSelect").modal('show', {backdrop: 'static'});	
		}
		
		// 切换选择
		function modalArticleSelectChangeChecked (){
			$(this).toggleClass('article-choosed');
		}
		
		// 清空选中
		function modalArticleSelectClear (){
			$("#modalArticleSelect").find('.article-choosed').removeClass('article-choosed');
		}
		
		//切换选中
		$('#modalArticleSelect').find('.article-choose').click(function(){
			$(this).toggleClass('article-choosed');
		})
		
		$('#modalArticleSelect').find('.modal_farticle_search').click(function(){
			changeModalArticleSelectPage($('.modal-page').attr('data-page-index'));
		});

		// 初始化翻页
		constructionPage('.modal-page', 1, 1, changeModalArticleSelectPage, true);
	    
	    // 切换页码
	    function changeModalArticleSelectPage(p) {
	    	var cdsstr = 'cnt|' + $('#article_cnt').val();
	    	var jsonData = {
	    		op_type: 'list',
	    		cds: cdsstr,
	    		page: p - 1 ,
	    	}
	    	$.post('<?php echo U("line/article");?>', jsonData, function(data){	    		
				if (typeof(data.ds) != 'undefined' && data.ds != null) {
					$('.modal-list').empty();
					for (var i=0; i<data.ds.length; i++) {
						var d = data.ds[i];
						var include_image = typeof(d.face_image)=='undefined' ? false : true;
						var vhtml = '<div class="article-information-img">';
						if (include_image == false) {
							vhtml = '<div class="article-information-word">'
						}
						
						vhtml +='<div class="article-choose-content">'+
								'	<i class="article-choose" data-id="'+d.id+'">选中</i>'+
								'	<i class="article-choose-use">选中并使用</i>'+
								'</div>';
						if (include_image == true) {
							vhtml +='	<div class="article-information-img-left">'+
									'		<img src="'+d.face_image+'" alt="">'+
									'	</div>';
						}
						if (include_image == false) {
							vhtml +='	<div class="article-information-word-div">';
						} else {
							vhtml +='	<div class="article-information-img-right">';
						}
						vhtml +='		<h3>'+ d.title +'</h3>'+
								'		<p>'+d.send_word+'</p>'+
								'		<h6>'+d.create_time+'</h6>'+
								'		<a href="'+'<?php echo U("line/article");?>/type/show/id/'+d.id+'" target="_blank"></a>'+
								'	</div>'+
								'</div>';
						$('#modalArticleSelect').find('.modal-list').append(vhtml);
						$('#modalArticleSelect').find('.article-choose-use:last').click(modalArticleSelectComfirm);
						$('#modalArticleSelect').find('.article-choose:last').click(modalArticleSelectChangeChecked);
					}
					
					// 根据情况判断是否重构分页
					constructionPage('.modal-page', p, data.page_count, changeModalArticleSelectPage);
				} 
	    	});
	    }
	    
	    $(document).ready(function(){
	    	changeModalArticleSelectPage(1);
	    });
	    
	    function modalArticleSelectComfirm() {
	    	if ($(this).prev().hasClass('article-choosed') == false) {
	    		$(this).prev().addClass('article-choosed');
	    	}
	    	
	    	var selIds = [];	    	
	    	$('#modalArticleSelect').find('.article-choosed').each(function(i,ev){
	    		selIds.push($(this).attr('data-id'));
	    	});
	    	
			$("#modalArticleSelect").modal('hide');	
	    	funcModalArticleCallBack(modalArticleFireObject, selIds);
	    }
</script><?php endif; ?> 
<?php if(!empty($modal_line_list)): ?><link rel="stylesheet" href="/source/Static/home/common/css/cssreset.css" />

<link rel="stylesheet" href="/source/Static/home/css/fline_list.css"/>

<div class="modal fade custom-width" id="modalLineSelect">
	<div class="modal-dialog" style="width: 90%;">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2 class="modal-title">线路选择</h2>
			</div>
			
			<div class="modal-body">
				<div class="modal-search">
					<input id="line_title" type="text" placeholder="输入您想要的线路标题"><a class="modal_fline_search" href="javascript:;">搜索</a>
				</div>
				<div class="modal-list">
				</div>
				<!-- 翻页 -->
				<div class="modal-page"></div>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>

<script src="/source/Static/home/js/page.js"></script>
<script>
	//打开modal
	var funcModalLineCallBack = null;
	var modalLineFireObject = null;
	var modalLineFindConds = null;
	function showModalLineSelect(obj, func, cds, send) {
		modalLineFireObject = obj;
		funcModalLineCallBack = func;
		modalLineFindConds = cds;
		if (send != null && send != 'undefined'){
			changeModalLineSelectPage(1);
		}		
		modalLineSelectClearChecked();
		$("#modalLineSelect").modal('show', {backdrop: 'static'});	
	}
	
	// 清除所有选择
	function modalLineSelectClearChecked () {
		$("#modalLineSelect").find('.article-choosed').removeClass('article-choosed');
	}
	
	// 切换选择
	function modalLineSelectChangeChecked (){
		$(this).toggleClass('article-choosed');
	}
	
	//切换选中
	$("#modalLineSelect").find('.article-choose').click(function(){
		$(this).toggleClass('article-choosed');
	});
	
	$("#modalLineSelect").find('.modal_fline_search').click(function(){
		changeModalLineSelectPage($('.modal-page').attr('data-page-index'));
	});

	// 初始化翻页
	constructionPage($('#modalLineSelect').find('.modal-page'), 1, 1, changeModalLineSelectPage, true);
    
    // 切换页码
    function changeModalLineSelectPage(p) {
    	var conds = modalLineFindConds;
    	var title = $('#line_title').val();
    	if (title != '') {
    		conds == null || conds == '' ? conds = 'title|'+title : conds += '|title|'+title;
    	}
    	var jsonData = {
    		op_type: 'list',
    		page: p - 1 ,
    	}
    	
    	    	
    	if (conds != null) {
    		conds += '|online|1|invalid|0'
    	}
    	jsonData['cds'] = conds;
    	
    	$.post('<?php echo U("line/list");?>', jsonData, function(data){	
			$("#modalLineSelect").find('.modal-list').empty();
			if (typeof(data.ds) != 'undefined' && data.ds != null) {
//				console.log('===================================================');
				for (var i=0; i<$(data.ds).length; i++) { 
					var d = data.ds[i];   	
					var assemblyPoint = '';
					if (d.assembly_point != null && d.assembly_point != '') {
						var apData = $.parseJSON(d.assembly_point);
						for (var ap = 0; ap < apData.length; ap ++) {
							assemblyPoint += apData[ap].type_desc + ' ';
						}
					}
					var destination = '';
					if (d.destination != null && d.destination != '') {
						var apData = $.parseJSON(d.destination);
						for (var ap = 0; ap < apData.length; ap ++) {
							destination += apData[ap].type_desc + ' ';
						}
					}   	
					var batchCount = d.batchs = null ? 0 : $(d.batchs).length;
					var clickCount = d.click_count = null ? 0 : d.click_count;
					var img_src = d.img1 == null ? '' : d.img1;
//    				console.log(d.id + ':' + d.title+',assembly:'+assemblyPoint+',dest:'+destination+',batch_count:'+batchCount+',img:'+img_src);    				
					
					var vhtml = '<div class="single-row">'+
								'	<div class="single-row-content">'+
								'		<div class="article-choose-content">'+
								'			<i class="article-choose" data-id="'+d.id+'">选中</i>'+
								'			<i class="article-choose-use">选中并使用</i>'+
								'		</div>'+
								'		<div class="single-row-img">'+
								'			<a href="'+'<?php echo U("line/preview");?>/id/'+d.id+'" target="_blank">'+
								'				<img src="'+img_src+'" alt="">'+
								'			</a>'+
								'		</div>'+
								'		<div class="single-row-describe">'+
								'			<div class="single-row-describe-top">'+
								'				<h4><a href="'+'<?php echo U("line/preview");?>/id/'+d.id+'" target="_blank">'+d.title+'</a></h4>'+
								'				<h5><a href="'+'<?php echo U("line/preview");?>/id/'+d.id+'" target="_blank">'+d.subheading+'</a></h5>'+
								'				<span><a href="'+'<?php echo U("line/preview");?>/id/'+d.id+'" target="_blank">'+d.send_word_show+'</a></span>'+
								'				<p><u>集合地点：'+assemblyPoint+'</u><u>批次：全年'+batchCount+'期</u><u>点击量：'+clickCount+'次</u></p>'+
								'				<p><u>目的地：'+destination+'</u><u>主题类型：'+d.theme_type_show_text+'</u></p>'+
								'				'+
								'			</div>'+
								'			<div class="single-row-describe-bottom">'+
								'				<span>旅行时间： '+d.start_time+'至'+d.end_time+'</span>'+
								'			</div>'+
								'		</div>'+
								'	</div>'+
								'</div>';
					$("#modalLineSelect").find('.modal-list').append(vhtml);
					$("#modalLineSelect").find('.article-choose-use:last').click(modalLineSelectComfirm);
					$("#modalLineSelect").find('.article-choose:last').click(modalLineSelectChangeChecked);
				}
				
				// 根据情况判断是否重构分页
				constructionPage($('#modalLineSelect').find('.modal-page'), p, data.page_count, changeModalLineSelectPage);
			} 
    	});
    }
    
    $(document).ready(function(){
//    	changeModalLineSelectPage(1);
    });
    
    function modalLineSelectComfirm() {
    	if ($(this).prev().hasClass('article-choosed') == false) {
    		$(this).prev().addClass('article-choosed');
    	}
    	
    	var selIds = [];	    	
    	$("#modalLineSelect").find('.article-choosed').each(function(i,ev){
    		selIds.push($(this).attr('data-id'));
    	});
    	
		$("#modalLineSelect").modal('hide');
    	funcModalLineCallBack(modalLineFireObject, selIds);
    }	    
</script><?php endif; ?>
<?php if(!empty($modal_video_list)): ?><!-- css Reset -->
<link rel="stylesheet" href="/source/Static/home/common/css/cssreset.css">
<link rel="stylesheet" href="/source/Static/home/css/farticle_list.css"/>
<style>
	.article-information-img {
	    position: relative;
	    width: 1000px !important;
	    height: 210px;
	    margin: 0 auto;
	    margin-bottom: 33px;
	    background-color: #fff;
	    overflow: visible !important;
	}
	.article-information-word {
		width: 1000px !important;	
	}
	.article-information-img a , .article-information-word a { position: absolute; top:0; left:0; width: 100%; height: 100%; }
	
	.video-modal-list { width: 1200px; margin: 0 auto; padding-top: 22px; overflow: hidden; }
	.video-modal-product-content-describe { position: relative; padding: 16px 10px; background: #fff; border: 1px solid #e5e5e5; border-top: none; }
	.video-modal-product-content-describe h5 { padding-bottom: 9px; }
	.video-modal-product-content-describe a:hover { color: #f90; }
	.video-modal-product-content-describe { text-align: center; }
	.video-modal-product-content-describe h5 { font-size: 14px; }
	.video-modal-product-content-describe p { color: #999; }	
	.video-modal-product-content { position: relative; float: left; width:285px; height: 270px; margin: 10px 7px; overflow: hidden; }
	.video-modal-product-content .video_more { height: 270px; }
	.video-modal-product-content > a { position: relative; display: inline-block; width: 285px; height: 200px; overflow: hidden; }

	.video-img button { margin-top: 20px; }
	.video-sure { position:absolute; bottom: 10px; right: 50px; }
	.haschoosed-video-img { width: 285px; height:200px; margin-top:20px; border: 1px solid #dcdcdc; }
	.video-modal-choose { position: absolute; top:0; left:0; width: 285px; height:30px; background-color:rgba(0,0,0,.3); color:#fff; }
	.video-modal-choose i { display: inline-block; width:50%; height: 30px; line-height: 30px; text-align: center; font-style:normal; cursor: pointer; }
	.video-modal-choose .video-choose-use { background-color:rgba(0,255,0,.3); }
	.video-modal-choose .video-has-choosed { background-color:rgba(255,0,0,.7); }
</style>

<div class="modal fade custom-width" id="modalVideoSelect">
	<div class="modal-dialog" style="width: 80%;">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2 class="modal-title">视频选择</h2>
			</div>
			
			<div class="modal-body">
				<div class="modal-search">
					<input id="video_title" type="text" placeholder="输入您想要的视频标题"><a class="modal_fvideo_search" href="javascript:;">搜索</a>
				</div>
				<div class="video-modal-list">
				</div>
				<!-- 翻页 -->
				<div class="modal-page" data-page-count="1" data-page-index="1"></div>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>

<script src="/source/Static/home/js/page.js"></script>
<script>
		//打开modal
		var funcModalVideoCallBack = null;
		var modalVideoFireObject = null;
		function showModalVideoSelect(obj, func) {
			modalVideoFireObject = obj;
			funcModalVideoCallBack = func;	
			modalVideoSelectClear();		
			$("#modalVideoSelect").modal('show', {backdrop: 'static'});	
		}
		
		// 切换选择
		function modalVideoSelectChangeChecked (){
			$(this).toggleClass('video-has-choosed');
		}
		
		// 清空选中
		function modalVideoSelectClear (){
			$("#modalVideoSelect").find('.video-has-choosed').removeClass('video-has-choosed');
		}
		
		//切换选中
		$(document).on('click','.video-choose',function(){
			$(this).toggleClass('video-has-choosed');
		});
		
		$('.modal_fvideo_search').click(function(){
			changeModalVideoSelectPage($("#modalVideoSelect").find('.modal-page').attr('data-page-index'));
		});

		// 初始化翻页
		constructionPage($("#modalVideoSelect").find('.modal-page'), 1, changeModalVideoSelectPage, true);
	    
	    // 切换页码
	    function changeModalVideoSelectPage(p) {
	    	var title = $("#modalVideoSelect").find('#video_title').val();
	    	var cdsstr = 'tl|' +title+'|stl|'+title;
	    	var jsonData = {
	    		op_type: 'list',
	    		cds: cdsstr,
	    		page: p - 1 ,
	    	}
	    	$.post('<?php echo U("line/video");?>', jsonData, function(data){	    		
				if (typeof(data.ds) != 'undefined' && data.ds != null) {
					$('.video-modal-list').empty();
					for (var i=0; i<data.ds.length; i++) {
						var d = data.ds[i];
						var include_image = typeof(d.face_image)=='undefined' ? false : true;
						var vhtml = '<div class="video-modal-product-content">'
//						           +	'<a href="javascript:;" onclick="addIframe(' + d.title +',' + d.href +');">'
						           +	'<a href="javascript:;">'
								   +		'<img src="'+d.img+'" alt="">'
								   +	'</a>'
						           +	'<div class="video-modal-product-content-describe">'
//							       +    	'<h5><a href="javascript:;" onclick="addIframe('+ d.title + ',' + d.href +');">' + d.title + '</a></h5>'
							       +    	'<h5><a href="javascript:;">' + d.title + '</a></h5>'
								   +	 	'<p>' + d.subheading + '</p>'
								   +    '</div>'
								   +	'<div class="video-modal-choose">'
								   +		'<i class="video-choose" data-id="'+d.id+'">选中</i><i class="video-choose-use">选中并使用</i>'
								   +	'</div>'
								   +'</div>';
						
						
						$("#modalVideoSelect").find('.video-modal-list').append(vhtml);
						$("#modalVideoSelect").find('.video-choose-use:last').click(modalVideoSelectComfirm);
						//$("#modalVideoSelect").find('.video-choose:last').click(modalVideoSelectChangeChecked);
					
					}
					
					// 根据情况判断是否重构分页
					constructionPage($("#modalVideoSelect").find('.modal-page'), p, data.page_count, changeModalVideoSelectPage);
				} 
	    	});
	    }
	    
	    $(document).ready(function(){
	    	changeModalVideoSelectPage(1);
	    });
	    
	    function modalVideoSelectComfirm() {
	    	if ($(this).prev().hasClass('video-has-choosed') == false) {
	    		$(this).prev().addClass('video-has-choosed');
	    	}
	    	
	    	var selIds = [];	    	
	    	$("#modalVideoSelect").find('.video-has-choosed').each(function(i,ev){
	    		selIds.push($(this).attr('data-id'));
	    	});
	    	
			$("#modalVideoSelect").modal('hide');
	    	funcModalVideoCallBack(modalVideoFireObject, selIds);
	    }
</script><?php endif; ?> 
<?php if(!empty($modal_tab_data)): ?><!-- 添加数据类型 -->
	<div class="modal fade" id="gallery-tab-data-modal" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<h4 class="modal-title">标签添加</h4>
				</div>
				
				<div class="modal-body">
					
					<div class="row">
						<div class="col-md-12">
							<label class="control-label" for="modal_data_key">标签键<span style="color: red;">（*只能由字母、数字、短线、下划线其中任意类型组合而且不能为空）</span></label>
							<input class="form-control" name="modal_data_key" id="modal_data_key" data-validate="required"/>
						</div>						
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<label class="control-label" for="modal_data_desc">标签文本<span style="color: red;">（*只能由字母、数字、短线、下划线或者汉字其中任意类型组合而且不能为空）</span></label>
							<input class="form-control" name="modal_data_desc" id="modal_data_desc" data-validate="required"/>
						</div>						
					</div>
					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-secondary">添加</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">	
		var modalTabDataObj = $("#gallery-tab-data-modal");
		var modalTabDataCallBack = null;		
		// 添加类型
		$(modalTabDataObj).find('.btn-secondary').click(function(){
			var jsonData = {
				'key': $(modalTabDataObj).find('#modal_data_key').val(),
				'desc': $(modalTabDataObj).find('#modal_data_desc').val(),
			}
			if (modalTabDataCallBack != null) {
				modalTabDataCallBack(jsonData);
			}
			$(modalTabDataObj).modal('hide');
		});
		
		// 显示类型数据添加界面
		function showModalTabDataDialog(backcallFunc) {
			modalTabDataCallBack = backcallFunc;
			$(modalTabDataObj).find('#modal_data_key').val('');
 			$(modalTabDataObj).find('#modal_data_desc').val('');
			$(modalTabDataObj).modal('show');
		}
	</script><?php endif; ?> 
<?php if(!empty($modal_cj_item)): ?><style type="text/css">
	.item-title { font-family: '微软雅黑'; font-size:18px; color:#333; }
	.item-border { margin-top:10px; border-top: 3px solid #eee; }
	.item-footer { margin-top: 15px; }
	.item { border-left: 5px solid #5ca323; margin-top: 10px; padding-left: 30px; }
	.item-opreate > a { margin-left: 30px; cursor: pointer; text-decoration: underline; }
	.item-price { margin-top: 10px; padding-left: 30px; }
	.btn-item-append { margin-left: 20px; font-family: '微软雅黑'; font-size: 14px; text-decoration: underline; color: #8e262a; cursor: pointer; }
	.expand-fold { margin-right: 20px; font-family: '微软雅黑'; font-size: 14px; color: #666666; cursor: pointer;}
	.separator-line { border-top:1px dashed #00b19d; margin-top: 15px; margin-bottom: 15px; }
		
	.twinkle {border-color:red;-webkit-box-shadow:0 15px 30px rgba(255,33,33,0.3); box-shadow:0 15px 30px rgba(255,33,33,0.3); -webkit-transform:translate3d(0, -2px, 0); transform:translate3d(0, -2px, 0);}
</style>


	<!-- 添加数据类型 -->
	<div class="modal fade" id="gallery-type-data-modal" data-backdrop="static" style="z-index: 9999;">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<h4 class="modal-title">数据类型添加</h4>
				</div>
				
				<div class="modal-body">
					
					<div class="row">
						<div class="col-md-12">
							<label class="control-label" for="modal_data_key">主键<span style="color: red;">（*只能由字母、数字、短线、下划线其中任意类型组合而且不能为空）</span></label>
							<input class="form-control" name="modal_data_key" id="modal_data_key" data-validate="required"/>
						</div>						
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<label class="control-label" for="modal_data_desc">键值<span style="color: red;">（*只能由字母、数字、短线、下划线或者汉字其中任意类型组合而且不能为空）</span></label>
							<input class="form-control" name="modal_data_desc" id="modal_data_desc" data-validate="required"/>
						</div>						
					</div>
					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-secondary">添加</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">			
		// 添加类型
		var modal_type_key = null;
		$('#gallery-type-data-modal').find('.btn-secondary').click(function(){
			var jsonData = {
				'type_key': modal_type_key,
				'data_key': $('#modal_data_key').val(),
				'data_desc': $('#modal_data_desc').val(),
			}
			$.post('<?php echo U("help/appendtypedata");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					$('#gallery-type-data-modal').modal('hide');
				} else {
					alert(data.result.message);
				}
			});
		});
		
		// 显示类型数据添加界面
		function showModalTypeDataDialog(typeKey) {
			modal_type_key = typeKey;
			$('#modal_data_key').val('');
 			$('#modal_data_desc').val('');
			$("#gallery-type-data-modal").modal('show');
		}
	</script>
<style type="text/css">
	.row { margin-top:15px; }
	.fitem-room { display: none; }
</style>
<!-- 添加数据类型 -->
<div class="modal fade custom-width" id="gallery-fcj-item-modal" data-backdrop="static">
	<div class="modal-dialog" style="width: 60%">
		<div class="modal-content">
			
			<div class="modal-header">
				<h4 class="modal-title">编辑价格项</h4>
			</div>
			
			<div class="modal-body">
				
				<div class="row">
					<div class="col-md-4 data_fitem_name">
						<label class="control-label" for="data_fitem_name">名称：<span style="color:red;">(*必选)</span></label>
						<input class="form-control" name="data_fitem_name" id="data_fitem_name" />
					</div>
													
					<div class="col-md-4 data_fitem_type">
						<label class="control-label" for="data_fitem_type">项特殊类型<span style="color:red;">(*必选)</span></label>
						<input class="form-control" name="data_fitem_type" id="data_fitem_type" />				
						<script type="text/javascript">
							$(document).ready(function(){
				
								// 绑定切换价格项类型事件		
								bindTypeDataDropMenu($('#data_fitem_type'), 'cj_item_type', '选择价格项类型', false, null, false, itemTypeChanged);
										
							});
						</script>
					</div>
					<div class="col-md-4 data_fitem_stock">
						<label class="control-label" for="data_fitem_stock">库存数量：</label>
						<input class="form-control" name="data_fitem_stock" id="data_fitem_stock" type="number" placeholder="请输入价格项所剩的库存数量" />
					</div>
				</div>
				<div class="row fitem-room">
					<div class="col-md-2 data_fitem_room_area">
						<label class="control-label" for="data_fitem_room_area">房间面积：</label>
						<input class="form-control" name="data_fitem_room_area" id="data_fitem_room_area" type="number" />
					</div>
					<div class="col-md-2 data_fitem_window">
						<label class="control-label" for="data_fitem_window">窗户数量：</label>
						<input class="form-control" name="data_fitem_window" id="data_fitem_window" type="number" />
					</div>
					<div class="col-md-2 data_fitem_air">
						<label class="control-label" for="data_fitem_air">空调数量：</label>
						<input class="form-control" name="data_fitem_air" id="data_fitem_air" type="number" />
					</div>
					<div class="col-md-6 data_fitem_bed_type">
						<label class="control-label" for="data_fitem_bed_type">床宽</label>
						<script type="text/javascript">
							$(document).ready(function(){		
								bindTypeDataDropMenu($('#data_fitem_bed_type'), 'cj_bed_type', '选择房间包含的床铺类型', true, false, true);
							});
						</script>
						<input class="form-control" name="data_fitem_bed_type" id="data_fitem_bed_type" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-1 form-group fitem-room data_fitem_wash_supplies">
						<label class="control-label" for="data_fitem_free">洗漱用品</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fitem_wash_supplies" id="data_fitem_wash_supplies" />
					</div>
					<div class="col-md-1 form-group fitem-room data_fitem_bathroom_curtain">
						<label class="control-label" for="data_fitem_bathroom_curtain">卫浴窗帘</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fitem_bathroom_curtain" id="data_fitem_bathroom_curtain" />
					</div>
					<div class="col-md-1 form-group fitem-room data_fitem_double_breakfast">
						<label class="control-label" for="data_fitem_double_breakfast">双早</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fitem_double_breakfast" id="data_fitem_double_breakfast" />
					</div>
					<div class="col-md-1 form-group fitem-room data_fitem_append_bed">
						<label class="control-label" for="data_fitem_append_bed">加床</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fitem_append_bed" id="data_fitem_append_bed" />
					</div>
					<div class="col-md-1 form-group fitem-room data_fitem_wifi">
						<label class="control-label" for="data_fitem_wifi">WIFI</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fitem_wifi" id="data_fitem_wifi" />
					</div>
					<div class="col-md-1 form-group data_fitem_necessary">
						<label class="control-label" for="data_fitem_necessary">必须项</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fitem_necessary" id="data_fitem_necessary" />
					</div>
					<div class="col-md-1 form-group data_fitem_free">
						<label class="control-label" for="data_fitem_free">赠品</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fitem_free" id="data_fitem_free" />
					</div>
					<div class="col-md-1 form-group data_fitem_recycle">
						<label class="control-label" for="data_fitem_recycle">回收物品</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fitem_recycle" id="data_fitem_recycle" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 data_fitem_beizhu">
						<label class="control-label" for="data_fitem_beizhu">备注：</label>
						<input class="form-control" name="data_fitem_beizhu" id="data_fitem_beizhu" />
					</div>
				</div>
				
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-white btn-fitem-close" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-secondary btn-fitem-add">保存</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	// 价格项类型被选择
	function itemTypeChanged(evt) {
		if (evt.added != null) {
			var sel_data = evt.added;
			if (sel_data.type_key.indexOf('room') != -1) {
				$('.fitem-room').css('display', 'block');
				return false;
			}
		}		
		$('.fitem-room').css('display', 'none');
	}

	function ModalFCJItem() {
		this.root = $('#gallery-fcj-item-modal');
		this.item_obj = null;
		this.obj_type = null;
		this.obj_id = null;
		this.item_id = null;
		this.callbackFunc = null;	
		
		// 绑定取消事件
		$(this.root).find('.btn-fitem-close').bind('click', {obj:this}, this.cancelItem);
	}
	
	ModalFCJItem.prototype.showModal = function(itemObj, objType, objId, itemId, confirmCallBack){
		this.item_obj = itemObj;
		this.obj_type = objType;
		this.obj_id = objId;
		this.item_id = itemId;
		this.callbackFunc = confirmCallBack;
		
		// 显示面板
		$(this.root).modal('show');	
		
		// 填充价格项数据
		this.fillItem();	
				
		// 绑定确认事件
		$(this.root).find('.btn-fitem-add').unbind();
		$(this.root).find('.btn-fitem-add').bind('click', {obj:this}, this.confirmItem);
	}
	
	ModalFCJItem.prototype.clearItem = function (){
		this.item_obj = null;
		this.item_id = null;
		this.callbackFunc = null;
					
		var modalRootObj = this.root;
		$(modalRootObj).attr('data-id', '');												
		// 名称
		$(modalRootObj).find('.data_fitem_name input').val('');
		// 特殊项类型			
		setSelect2Value($(modalRootObj).find('#data_fitem_type'), null);							
		// 库存
		$(modalRootObj).find('.data_fitem_stock input').val('0');
		// 房间特殊类型				
		$(modalRootObj).find('.fitem-room').css('display', 'none');												
		// 房间面积
		$(modalRootObj).find('.data_fitem_room_area input').val('');					
		// 窗户数量
		$(modalRootObj).find('.data_fitem_window input').val('');
		// 空调数量
		$(modalRootObj).find('.data_fitem_air input').val('');							
		// 床宽
		setSelect2Value($(modalRootObj).find('#data_fitem_bed_type'), null);
		
		// 洗漱用品
		$(modalRootObj).find('#data_fitem_wash_supplies').prop('checked', false).trigger('change');
		// 卫浴窗帘
		$(modalRootObj).find('#data_fitem_bathroom_curtain').prop('checked', false).trigger('change');					
		// 双早
		$(modalRootObj).find('#data_fitem_double_breakfast').prop('checked', false).trigger('change');					
		// 加床
		$(modalRootObj).find('#data_fitem_append_bed').prop('checked', false).trigger('change');					
		// WIFI
		$(modalRootObj).find('#data_fitem_wifi').prop('checked', false).trigger('change');
		
		// 必须项
		$(modalRootObj).find('#data_fitem_necessary').prop('checked', false).trigger('change');				
		// 赠品
		$(modalRootObj).find('#data_fitem_free').prop('checked', false).trigger('change');				
		// 回收物品
		$(modalRootObj).find('#data_fitem_recycle').prop('checked', false).trigger('change');					
		// 库存
		$(modalRootObj).find('.data_fitem_beizhu input').val('');
	}
	
	ModalFCJItem.prototype.fillItem = function() {		
		var thisObj = this;
		if (this.item_id != null) {
			$.post('<?php echo U("financial/item");?>', {op_type: 'find', cdtype:2, cdsstr:'id|'+this.item_id}, function(data){
				if (data.ds != null) {					
					var d = data.ds;			
					var modalRootObj = thisObj.root;
					$(modalRootObj).attr('data-id', d.id);															
					// 名称
					$(modalRootObj).find('.data_fitem_name input').val(d.name);					
					// 特殊项类型			
					setSelect2Value($(modalRootObj).find('#data_fitem_type'), d.type);									
					// 库存
					$(modalRootObj).find('.data_fitem_stock input').val(d.stock);
					
					if (d.type != null && d.type != 'undefined' && d.type != '[]' && d.type != '{}') {
						var typeData = $.parseJSON(d.type);	
						if (typeData.type_key == 'cj_item_type_room') {						
							$(modalRootObj).find('.fitem-room').css('display', 'block');												
							// 房间面积
							$(modalRootObj).find('.data_fitem_room_area input').val(d.room_area);					
							// 窗户数量
							$(modalRootObj).find('.data_fitem_window input').val(d.window);					
							// 空调数量
							$(modalRootObj).find('.data_fitem_air input').val(d.air_conditioner);							
							// 床宽
							setSelect2Value($(modalRootObj).find('#data_fitem_bed_type'),d.bed_width);
							
							// 洗漱用品
							$(modalRootObj).find('#data_fitem_wash_supplies').prop('checked', d.wash_supplies == 1 ? true : false).trigger('change');
							// 卫浴窗帘
							$(modalRootObj).find('#data_fitem_bathroom_curtain').prop('checked', d.bathroom_curtain == 1 ? true : false).trigger('change');					
							// 双早
							$(modalRootObj).find('#data_fitem_double_breakfast').prop('checked', d.double_breakfast == 1 ? true : false).trigger('change');					
							// 加床
							$(modalRootObj).find('#data_fitem_append_bed').prop('checked', d.append_bed == 1 ? true : false).trigger('change');					
							// WIFI
							$(modalRootObj).find('#data_fitem_wifi').prop('checked', d.wifi == 1 ? true : false).trigger('change');
										
						} else {
							$(modalRootObj).find('.item-room').addClass('hidden_ctrl');
						}
					} else {
						$(modalRootObj).find('.item-room').addClass('hidden_ctrl');
					}
					
					// 必须项
					$(modalRootObj).find('#data_fitem_necessary').prop('checked', d.necessary == 1 ? true : false).trigger('change');				
					// 赠品
					$(modalRootObj).find('#data_fitem_free').prop('checked', d.is_free == 1 ? true : false).trigger('change');
					// 回收物品
					$(modalRootObj).find('#data_fitem_recycle').prop('checked', d.is_recycle == 1 ? true : false).trigger('change');					
					// 库存
					$(modalRootObj).find('.data_fitem_beizhu input').val(d.beizhu);
				}
			});
		}
	}
	
	// 确认添加/修改数据
	ModalFCJItem.prototype.confirmItem = function(e){
		if (e.data == null || e.data.obj == null) {
			console.log('未绑定对象，不能触发事件');
			return false;
		}
					
		var param = {
			'op_type': 'save',
			'obj_type': e.data.obj.obj_type,
			'obj_id': e.data.obj.obj_id,
			'id': e.data.obj.item_id,
			'name': $(e.data.obj.root).find('#data_fitem_name').val(),
			'type': getSelect2Value($(e.data.obj.root).find('#data_fitem_type')),
			'stock': $(e.data.obj.root).find('#data_fitem_stock').val(),
			'room_area': $(e.data.obj.root).find('#data_fitem_room_area').val(),
			'window': $(e.data.obj.root).find('#data_fitem_window').val(),
			'air_conditioner': $(e.data.obj.root).find('#data_fitem_air').val(),
			'bed_width': getSelect2Value($(e.data.obj.root).find('#data_fitem_bed_type')),
			'wash_supplies': $(e.data.obj.root).find('#data_fitem_wash_supplies').prop('checked') ? 1 : 0,
			'bathroom_curtain': $(e.data.obj.root).find('#data_fitem_bathroom_curtain').prop('checked') ? 1 : 0,
			'double_breakfast': $(e.data.obj.root).find('#data_fitem_double_breakfast').prop('checked') ? 1 : 0,
			'append_bed': $(e.data.obj.root).find('#data_fitem_append_bed').prop('checked') ? 1 : 0,
			'wifi': $(e.data.obj.root).find('#data_fitem_wifi').prop('checked') ? 1 : 0,
			'necessary': $(e.data.obj.root).find('#data_fitem_necessary').prop('checked') ? 1 : 0,
			'is_free': $(e.data.obj.root).find('#data_fitem_free').prop('checked') ? 1 : 0,
			'is_recycle': $(e.data.obj.root).find('#data_fitem_recycle').prop('checked') ? 1 : 0,
			'beizhu': $(e.data.obj.root).find('#data_fitem_beizhu').val(),
		}
		
//		console.log(e.data.obj.obj_type +'/'+ e.data.obj.obj_id);
//		console.log(JSON.stringify(param));
		if (e.data.obj.obj_type == null || e.data.obj.obj_id == null || param.name == '' || param.type == '') {
			toastr.warning('保存消费项的参数不足，可能缺少资源类型、资源对象、消费项名称、消费项类型其中的一项，所以价格不能保存');
			return false;
		}
		
		var callbackFunc = e.data.obj.callbackFunc;
		var itemObj = e.data.obj.item_obj;		
		$.post('<?php echo U("financial/item");?>', param, function(data){
			if (data.result != null) {
				if (data.extra_result != null) {
					if (data.result.errno != 0 && data.extra_result.errno != 0){
						toastr.error(data.result.message + '<br />' + data.extra_result.message);
						return false;	
					}
				} else {
					if (data.result.errno != 0){
						toastr.error(data.result.message);
						return false;	
					}	
				}
			}
			
			toastr.success('修改价格项成功!!!');
			if (callbackFunc != 'undefined' && callbackFunc != null && typeof(callbackFunc) == 'function') {				
				callbackFunc(itemObj, data.ds, data.op);
			}
		});
		e.data.obj.hideModal();
	}
	
	ModalFCJItem.prototype.hideModal = function() {
		this.clearItem();
		$(this.root).modal('hide');
	}
	
	// 取消编辑项
	ModalFCJItem.prototype.cancelItem = function(e) {
		if (e.data == null || e.data.obj == null) {
			console.log('未绑定对象，不能触发事件');
			return false;
		}
		e.data.obj.hideModal();
	}
	
</script>
<style type="text/css">
	.price-container { margin-top:10px; padding-top:10px; border-top: 3px solid #eee; }
	.price-title { font-family: '微软雅黑'; font-size:18px; }
	.price-border { margin-top:10px; border-top: 3px solid #eee; }
	.price-footer { margin-top: 15px; }
	.price { border-left: 5px solid #f1871d; margin-top: 10px; padding-left: 30px; }
	.price-opreate > a { margin-left: 30px; cursor: pointer; text-decoration: underline; }
	.price-price { border-left: 5px solid #5ca323; margin-top: 10px; padding-left: 30px; }
	.btn-price-append { margin-left: 20px; font-family: '微软雅黑'; font-size: 14px; text-decoration: underline; color: #8e262a; }
	.separator-line { border-top:1px dashed #00b19d; margin-top: 15px; margin-bottom: 15px; }
</style>

<style type="text/css">
	.row { margin-top:15px; }
	.range-input { width: 46%!important; }
	.range-input-seperator { width: 8%!important; }
	.fprice_limit { margin-left: 15px; }
</style>
<!-- 添加数据类型 -->
<div class="modal fade custom-width" id="gallery-fcj-price-modal" data-backdrop="static">
	<div class="modal-dialog" style="width: 60%">
		<div class="modal-content">
			
			<div class="modal-header">
				<h4 class="modal-title">编辑价格</h4>
			</div>
			
			<div class="modal-body">
				
				<div class="row">
					<div class="col-md-4 data_fprice_title">
						<label class="control-label" for="data_fprice_title">名称：<span style="color:red;">(*必选)</span></label>
						<input class="form-control" name="data_fprice_title" id="data_fprice_title" />
					</div>
					<div class="col-md-1 form-group fprice_limit">
						<label class="control-label" for="data_fprice_rebate">返利：</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fprice_rebate" id="data_fprice_rebate" />
					</div>
					<div class="col-md-3 data_fprice_price">
						<label class="control-label" for="data_fprice_price">报价：</label>
						<input class="form-control" name="data_fprice_price" id="data_fprice_price" type="number" placeholder="请输入报价金额" />
					</div>
					<!--<div class="col-md-3 data_fprice_real_price">
						<label class="control-label" for="data_fprice_real_price">实价：</label>
						<input class="form-control" name="data_fprice_real_price" id="data_fprice_real_price" type="number" placeholder="请输入实价金额" />
					</div>-->
				</div>
				<div class="row">
					<div class="form-group fprice_limit" style="width: 10%; float: left;">
						<label class="control-label" for="data_fprice_time">按时报价</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fprice_time" id="data_fprice_time" />
					</div>
					<div class="hidden_ctrl data_fprice_time" style="width: 38%; float: left;">
						<label>有效时间：</label>
						<div class="input-group" style="border-color: #40bbea;">
							<input type="text" id="data_fprice_time_limit" readonly class="form-control daterange" data-format="YYYY-MM-DD" data-separator=" / " placeholder="点击选择日期"/>							
							<div class="input-group-addon">							
								<a href="javascript:;"><i class="linecons-calendar"></i></a>								
							</div>
						</div>
					</div>
					<div class="form-group fprice_limit" style="width: 10%; float: left;">
						<label class="control-label" for="data_fprice_line">按线路报价</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fprice_line" id="data_fprice_line" />
					</div>
					<div class="hidden_ctrl data_fprice_line" style="width: 38%; float: left;">
						<label>有效线路：</label>
						<div>
							<script type="text/javascript">
								$(document).ready(function(){
									var ds = {tab:'line', show_col:'title', cdsstr: 'invalid|=|0|AND', cdtype:4}
									bindSelect2DropMenu($('#data_fprice_line_data'), ds, '请选择线路', 1, false);	
								});
							</script>
							<input class="form-control" name="data_fprice_line_data" id="data_fprice_line_data" style="width: 100%" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group fprice_limit" style="width: 10%; float: left;">
						<label class="control-label" for="data_fprice_member">按人报价</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fprice_member" id="data_fprice_member" />
					</div>
					<div class="hidden_ctrl data_fprice_member" style="width: 38%; float: left;">
						<label>有效人数：</label>
						<div class="input-group">
							<input class="form-control range-input" name="data_fprice_member_min" id="data_fprice_member_min" type="number" value="0" />
							<span class="form-control range-input-seperator"> - </span>
							<input class="form-control range-input" name="data_fprice_member_max" id="data_fprice_member_max" type="number" value="0" />
						</div>
					</div>
					<div class="form-group fprice_limit" style="width: 10%; float: left;">
						<label class="control-label" for="data_fprice_day">按天报价</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fprice_day" id="data_fprice_day" />
					</div>
					<div class="hidden_ctrl data_fprice_day" style="width: 38%; float: left;">
						<label>有效天数：</label>
						<div class="input-group">
							<input class="form-control range-input" name="data_fprice_day_min" id="data_fprice_day_min" type="number" value="0" />
							<span class="form-control range-input-seperator"> - </span>
							<input class="form-control range-input" name="data_fprice_day_max" id="data_fprice_day_max" type="number" value="0" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 data_fprice_beizhu">
						<label class="control-label" for="data_fprice_beizhu">备注：</label>
						<input class="form-control" name="data_fprice_beizhu" id="data_fprice_beizhu" />
					</div>
				</div>
				
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-white btn-fprice-close" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-secondary btn-fprice-add">保存</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	function ModalFCJPrice() {
		this.root = $('#gallery-fcj-price-modal');
		this.price_obj = null;
		this.obj_type = null;
		this.obj_id = null;
		this.item_id = null;
		this.price_id = null;
		this.callbackFunc = null;		
		
		// 限制项改变
		$(this.root).find('.fprice_limit input').bind('change', {obj:this}, this.limitChanged)		
		// 绑定取消事件
		$(this.root).find('.btn-fprice-close').bind('click', {obj:this}, this.cancelPrice);		
	}
	
	ModalFCJPrice.prototype.showModal = function(priceObj, objType, objId, itemId, priceId, confirmCallBack){
		this.price_obj = priceObj;
		this.obj_type = objType;
		this.obj_id = objId;
		this.item_id = itemId;
		this.price_id = priceId;
		this.callbackFunc = confirmCallBack;
		
		// 显示面板
		$(this.root).modal('show');	
		
		// 填充价格数据
		this.fillPrice();		
			
		// 绑定确认事件
		$(this.root).find('.btn-fprice-add').unbind();
		$(this.root).find('.btn-fprice-add').bind('click', {obj:this}, this.confirmPrice);
	}
	
	ModalFCJPrice.prototype.clearPrice = function (){
		this.price_obj = null;
		this.price_id = null;
		this.callbackFunc = null;
					
		var modalRootObj = this.root;
		$(modalRootObj).attr('data-id', '');
		// 名称
		$(modalRootObj).find('#data_fprice_title').val('');
		// 返利
		$(modalRootObj).find('#data_fprice_rebate').prop('checked', false).trigger('change');
		// 报价
		$(modalRootObj).find('#data_fprice_price').val('');
		// 实价
//		$(modalRootObj).find('#data_fprice_real_price').val('');
		// 按时报价
		$(modalRootObj).find('#data_fprice_time').prop('checked', false).trigger('change');
		$(modalRootObj).find('#data_fprice_time_limit').val('');		
		// 按人报价
		$(modalRootObj).find('#data_fprice_member').prop('checked', false).trigger('change');
		$(modalRootObj).find('#data_fprice_member_min').val('');
		$(modalRootObj).find('#data_fprice_member_max').val('');	
		// 按天报价
		$(modalRootObj).find('#data_fprice_day').prop('checked', false).trigger('change');
		$(modalRootObj).find('#data_fprice_day_min').val('');
		$(modalRootObj).find('#data_fprice_day_max').val('');
		// 按线路报价
		$(modalRootObj).find('#data_fprice_line').prop('checked', false).trigger('change');
		setSelect2Value($(modalRootObj).find('#data_fprice_line_data'), null);
		// 备注
		$(modalRootObj).find('#data_fprice_beizhu').val('');
	}
	
	ModalFCJPrice.prototype.fillPrice = function() {		
		var thisObj = this;
		if (this.price_id != null) {
			$.post('<?php echo U("financial/price");?>', {op_type: 'find', id: this.price_id}, function(data){
				if (data.ds != null) {					
					var d = data.ds;
					console.log(JSON.stringify(d));	
					var modalRootObj = thisObj.root;
					$(modalRootObj).attr('data-id', d.id);
					// 名称
					$(modalRootObj).find('#data_fprice_title').val(d.title);
					// 返利
					$(modalRootObj).find('#data_fprice_rebate').prop('checked', d.is_rebate == 1 ? true : false).trigger('change');
					// 报价
					$(modalRootObj).find('#data_fprice_price').val(d.price);
					// 实价
//					$(modalRootObj).find('#data_fprice_real_price').val(d.real_price);
					// 按时报价
					$(modalRootObj).find('#data_fprice_time').prop('checked', d.is_time == 1 ? true : false).trigger('change');
					$(modalRootObj).find('#data_fprice_time_limit').val(d.start_time+' / '+d.end_time);
					// 按人报价
					$(modalRootObj).find('#data_fprice_member').prop('checked', d.is_member == 1 ? true : false).trigger('change');
					$(modalRootObj).find('#data_fprice_member_min').val(d.min_num);
					$(modalRootObj).find('#data_fprice_member_max').val(d.max_num);
					// 按天报价
					$(modalRootObj).find('#data_fprice_day').prop('checked', d.is_day == 1 ? true : false).trigger('change');
					$(modalRootObj).find('#data_fprice_day_min').val(d.min_day);
					$(modalRootObj).find('#data_fprice_day_max').val(d.max_day);
					// 按线路报价
					$(modalRootObj).find('#data_fprice_line').prop('checked', d.is_line == 1 ? true : false).trigger('change');
					setSelect2Value($(modalRootObj).find('#data_fprice_line_data'), d.line);
					// 备注
					$(modalRootObj).find('#data_fprice_beizhu').val(d.beizhu);
				}
			});
		}
	}
	
	// 价格类型被选择
	ModalFCJPrice.prototype.limitChanged = function(evt) {
		var rootObj = $(this).closest('#gallery-fcj-price-modal');
		var className = $(this).attr('name');
		if ($(this).prop('checked') ==  false) {
			$(rootObj).find('.'+className).addClass('hidden_ctrl');
		} else {
			$(rootObj).find('.'+className).removeClass('hidden_ctrl');
		}
	}
	
	// 确认添加/修改数据
	ModalFCJPrice.prototype.confirmPrice = function(e){
		if (e.data == null || e.data.obj == null) {
			console.log('未绑定对象，不能触发事件');
			return false;
		}
		var thisObj = e.data.obj;
		if (thisObj.obj_type == null || thisObj.obj_id == null || thisObj.item_id == null) {
			toastr.warning('保存价格的参数不足，可能缺少资源类型、资源对象、消费项其中的一项，所以价格不能保存');
			return false;
		}
		
		var date = $(thisObj.root).find('#data_fprice_time_limit').val();
		var dateList = date.split(' / ');
		var param = {
			'op_type': 'save',
			'obj_type': thisObj.obj_type,
			'obj_id': thisObj.obj_id,
			'item_id': thisObj.item_id,
			'id': thisObj.price_id,
			'is_rebate': $(thisObj.root).find('#data_fprice_rebate').prop('checked') ? 1 : 0,
			'title': $(thisObj.root).find('#data_fprice_title').val(),
			'price': $(thisObj.root).find('#data_fprice_price').val(),
//			'real_price': $(thisObj.root).find('#data_fprice_real_price').val(),
			'is_time': $(thisObj.root).find('#data_fprice_time').prop('checked') ? 1 : 0,
			'is_member': $(thisObj.root).find('#data_fprice_member').prop('checked') ? 1 : 0,
			'is_day': $(thisObj.root).find('#data_fprice_day').prop('checked') ? 1 : 0,
			'is_line': $(thisObj.root).find('#data_fprice_line').prop('checked') ? 1 : 0,
			'start_time': dateList[0],
			'end_time': dateList[1],
			'min_num': $(thisObj.root).find('#data_fprice_member_min').val(),
			'max_num': $(thisObj.root).find('#data_fprice_member_max').val(),
			'min_day': $(thisObj.root).find('#data_fprice_day_min').val(),
			'max_day': $(thisObj.root).find('#data_fprice_day_max').val(),
			'line': getSelect2Value($(thisObj.root).find('#data_fprice_line_data'),['id','title']),
			'beizhu': $(thisObj.root).find('#data_fprice_beizhu').val(),
		}
		
		var callbackFunc = thisObj.callbackFunc;
		var priceObj = thisObj.price_obj;
		$.post('<?php echo U("financial/price");?>', param, function(data){
			if (data.jumpUrl != null) {
				location.href = data.jumpUrl;
			}
			if (data.result != null) {
				if (data.extra_result != null) {
					if (data.result.errno != 0 && data.extra_result.errno != 0){
						toastr.error(data.result.message + '<br />' + data.extra_result.message);
						return false;	
					}
				} else {
					if (data.result.errno != 0){
						toastr.error(data.result.message);
						return false;	
					}	
				}
			}
			toastr.success('修改价格成功!!!');
			if (callbackFunc != 'undefined' && callbackFunc != null && typeof(callbackFunc) == 'function') {			
				callbackFunc(priceObj, data.ds, data.op);
			}
		});
		thisObj.hideModal();
	}
	
	ModalFCJPrice.prototype.hideModal = function() {
		this.clearPrice();
		$(this.root).modal('hide');
	}
	
	// 取消编辑项
	ModalFCJPrice.prototype.cancelPrice = function(e) {
		if (e.data == null || e.data.obj == null) {
			console.log('未绑定对象，不能触发事件');
			return false;
		}
		var thisObj = e.data.obj;
		thisObj.hideModal();
	}
	
</script>

<div class="price template_price hidden_ctrl" data-id="">
	<div class="row">
		<div class="col-md-3 data_price_title">
			<label>名称：</label>
			<span></span>
		</div>
		<div class="col-md-1 data_price_rebate">
			<label>返利：</label>
			<span></span>
		</div>
		<div class="col-md-1 data_price_price">
			<label>报价：</label>
			<span></span>
		</div>
		<div class="col-md-1 data_price_real_price">
			<label>实价：</label>
			<span></span>
		</div>		
		<div class="col-md-1 data_price_review">
			<label>状态：</label>
			<span></span>
		</div>
	</div>
	<div class="row price-condition">
		<div class="col-md-3 data_price_time">
			<label>有效时间：</label>
			<span></span>		
		</div>
		<div class="col-md-3 data_price_member">
			<label>有效人数：</label>
			<span></span>
		</div>
		<div class="col-md-3 data_price_day">
			<label>有效天数：</label>
			<span></span>
		</div>
		<div class="col-md-3 data_price_line">
			<label>有效线路：</label>
			<span></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 data_price_beizhu">
			<label>备注：</label>
			<span></span>
		</div>
	</div>
	<div class="row price-opreate">
		<a class="btn-price-edit"><i>编辑信息</i></a>
		<a class="btn-price-delete"><i style="color: red">删除信息</i></a>
	</div>
</div>

<!--详细内容，消费项，价格详细-->
<div class="source-container price-container template_price_container hidden_ctrl">
	<div class="title" style="background-color: rgba(241,135,29,0.5);">
		<span class="price-title">价格列表</span>
		<a class="btn-price-append"><i>添加价格</i></a>
		<a class="expand-fold" style="float: right; "><b>折叠</b><i class="fa-chevron-down"></i></a>
	</div>
	<div class="price-border">
	</div>
</div>

<script type="text/javascript">
	function ModalCJPrice(vobj, objType, objId, itemId) {
		if (vobj == null || objType == null || objId == null || itemId == null) {
			toastr.error('Error:显示价格的参数有误');
			return false;
		}
		
		this.root = $('.template_price_container').clone(true);
		$(this.root).removeClass('template_price_container');
		this.obj = vobj;
		this.obj_type = objType;
		this.obj_id = objId;
		this.item_id = itemId;
		this.page = 0;
		this.max_page = 1;
		this.modal_price = new ModalFCJPrice();
			
		// 添加价格到表格
		$(this.obj).append(this.root);
			
		// 加载消费项
		this.loadMorePrices();
		
		// 显示添加消费项弹出框
		$(this.root).find('.btn-price-append').bind('click', {obj:this}, this.showAppendPrice);
	}

	ModalCJPrice.prototype.showPrices = function(){	
		$(this.root).removeClass('hidden_ctrl');
	}

	// 显示添加消费项弹出框
	ModalCJPrice.prototype.showAppendPrice = function(ev) {
		if (ev.data != null && ev.data.obj != null) {
			var thisObj = ev.data.obj;
			var price_id = null;
			if ($(this).closest('.price').length > 0) {
				price_id = $(this).closest('.price').attr('data-id');	
			}		
			ev.data.obj.modal_price.showModal(thisObj, thisObj.obj_type, thisObj.obj_id, thisObj.item_id,  price_id, thisObj._ajaxSavePrice);	
		} else {
			console.log('没有绑定对象');
		}
	}

	// 添加编辑消费项
	ModalCJPrice.prototype._ajaxSavePrice = function(priceObj, d, op) {
		if (d != null) {
			var rootObj = null;
			if (op == 'create') {
				rootObj = $('.template_price').clone();
				$(rootObj).removeClass('template_price');
				$(rootObj).removeClass('hidden_ctrl');
				$(rootObj).attr('data-id', d.id);
			} else {
				rootObj = $('.price[data-id="'+d.id+'"]');
			}
							
			// 标题
			$(rootObj).find('.data_price_title span').html(d.title);				
			// 返利
			$(rootObj).find('.data_price_rebate span').html(d.is_rebate == 0 ? '非返利' : '返利');					
			// 报价
			$(rootObj).find('.data_price_price span').html(d.price);				
			// 实价
			$(rootObj).find('.data_price_real_price span').html(d.real_price);				
			// 审核状态
			if (d.review_type != null) {
				$(rootObj).find('.data_price_real_price span').html(d.review_type.type_desc);	
			}
			
			var existCondition = false;
			// 按时报价
			if (d.is_time != null && d.is_time != '0') {
				$(rootObj).find('.data_price_time').removeClass('hidden_ctrl');
				$(rootObj).find('.data_price_time span').html(d.start_time+' 至 '+d.end_time);	
				existCondition = true;
			} else {
				$(rootObj).find('.data_price_time').addClass('hidden_ctrl');
			}
			
			// 按人报价
			if (d.is_member != null && d.is_member != '0') {
				$(rootObj).find('.data_price_member').removeClass('hidden_ctrl');
				$(rootObj).find('.data_price_member span').html(d.min_num+' 至 '+d.max_num);	
				existCondition = true;
			} else {
				$(rootObj).find('.data_price_member').addClass('hidden_ctrl');
			}
			
			// 按天报价
			if (d.is_day != null && d.is_day != '0') {
				$(rootObj).find('.data_price_day').removeClass('hidden_ctrl');
				$(rootObj).find('.data_price_day span').html(d.min_day+' 至 '+d.max_day);	
				existCondition = true;
			} else {
				$(rootObj).find('.data_price_day').addClass('hidden_ctrl');
			}
			
			// 按线路报价
			if (d.is_line != null && d.is_line != '0') {
				$(rootObj).find('.data_price_line').removeClass('hidden_ctrl');
				if (d.line != null && d.line != '') {
					var l = $.parseJSON(d.line);
					$(rootObj).find('.data_price_line span').html(l.title);	
				}
				existCondition = true;
			} else {
				$(rootObj).find('.data_price_line').addClass('hidden_ctrl');
			}
				
			if (existCondition == false) {
				$(rootObj).find('.price-condition').addClass('hidden_ctrl');
			} else {
				$(rootObj).find('.price-condition').removeClass('hidden_ctrl');
			}
						
			// 备注
			$(rootObj).find('.data_price_beizhu span').html(d.beizhu);
						
			// 添加消费项
			if (op == 'create') {
				$(priceObj.root).find('.price-border').prepend('<hr class="separator-line"/>');
				$(priceObj.root).find('.price-border').prepend(rootObj);
				
				// 绑定编辑事件
				$(rootObj).find('.btn-price-edit').bind('click', {obj:priceObj}, priceObj.showAppendPrice);
				// 绑定删除事件
				$(rootObj).find('.btn-price-delete').bind('click', {obj:priceObj}, priceObj._ajaxDeletePrice);
			}
		}
	}

	// 删除消费项
	ModalCJPrice.prototype._ajaxDeletePrice = function(e) {
		if (e.data == null || e.data.obj == null) {
			toastr.warning('未绑定对象，不能触发事件');
			return false;
		}
		var thisObj = e.data.obj;
		
		if (!confirm('您确定要删除该价格')) {
			console.log('取消删除价格');
			return false;
		}
		
		var rootObj = $(this).closest('.price');
		var price_id = $(rootObj).attr('data-id');
		if (price_id == 'null' || price_id == 'undefined' || price_id == '') {
			toastr.warning('价格编号无效');
			return false;
		}	
		$.post('<?php echo U("financial/price");?>',{op_type:'delete', id:price_id}, function(data){
			if (data.result.errno == 0) {
				$(rootObj).remove();
				// 移除分割线
				$(rootObj).next().remove();
			} else {
				toastr.error(data.result.message);
			}
		})
	}

	// 加载更多消费项
	ModalCJPrice.prototype.loadMorePrices = function() {
		var thisRootObj = this.root;
		if ($(thisRootObj).find('.price-more').attr('data-more') == '0') {
			console.log('没有更多的价格项');
			return false;
		}
		
		var jsonData = {
			op_type: 'list',
			item_id: this.item_id,
		}
		
		var thisObj = this;
		$.post('<?php echo U("financial/price");?>', jsonData, function(data){
			if (data.ds != null) {
				for (var i=0; i < data.ds.length; i++) {
					var d = data.ds[i];
					var rootObj = $('.template_price').clone();
					$(rootObj).removeClass('template_price');
					$(rootObj).removeClass('hidden_ctrl');
					$(rootObj).attr('data-id', d.id);
								
					// 标题
					$(rootObj).find('.data_price_title span').html(d.title);			
					// 返利
					$(rootObj).find('.data_price_rebate span').html(d.is_rebate == 0 ? '非返利' : '返利');					
					// 报价
					$(rootObj).find('.data_price_price span').html(d.price);				
					// 实价
					$(rootObj).find('.data_price_real_price span').html(d.real_price);				
					// 审核状态
					if (d.review_type != null) {
						$(rootObj).find('.data_price_review span').html(d.review_type.type_desc);	
					}
					
					var existCondition = false;
					// 有效时间
					if (d.is_time != null && d.is_time != '0') {
						$(rootObj).find('.data_price_time').removeClass('hidden_ctrl');
						$(rootObj).find('.data_price_time span').html(d.start_time+' 至 '+d.end_time);	
						existCondition = true;
					} else {
						$(rootObj).find('.data_price_time').addClass('hidden_ctrl');
					}
					
					// 有效人数
					if (d.is_member != null && d.is_member != '0') {
						$(rootObj).find('.data_price_member').removeClass('hidden_ctrl');
						$(rootObj).find('.data_price_member span').html(d.min_num+' 至 '+d.max_num);
						existCondition = true;	
					} else {
						$(rootObj).find('.data_price_member').addClass('hidden_ctrl');
					}
					
					// 有效天数
					if (d.is_day != null && d.is_day != '0') {
						$(rootObj).find('.data_price_day').removeClass('hidden_ctrl');
						$(rootObj).find('.data_price_day span').html(d.min_day+' 至 '+d.max_day);
						existCondition = true;
					} else {
						$(rootObj).find('.data_price_day').addClass('hidden_ctrl');
					}
					
					// 有效线路
					if (d.is_line != null && d.is_line != '0') {
						$(rootObj).find('.data_price_line').removeClass('hidden_ctrl');
						if (d.line != null && d.line != null && d.line != '') {
							var l = $.parseJSON(d.line);
							$(rootObj).find('.data_price_line span').html(l.title);
						}
						existCondition = true;
					} else {
						$(rootObj).find('.data_price_line').addClass('hidden_ctrl');
					}
					
					if (existCondition == false) {
						$(rootObj).find('.price-condition').addClass('hidden_ctrl');
					} else {
						$(rootObj).find('.price-condition').removeClass('hidden_ctrl');
					}
								
					// 备注
					$(rootObj).find('.data_price_beizhu span').html(d.beizhu);
					
					// 添加消费项
					$(thisRootObj).find('.price-border').append(rootObj);
					$(thisRootObj).find('.price-border').append('<hr class="separator-line"/>');
					
					// 绑定编辑事件
					$(rootObj).find('.btn-price-edit').bind('click', {obj:thisObj}, thisObj.showAppendPrice);
					// 绑定删除事件
					$(rootObj).find('.btn-price-delete').bind('click', {obj:thisObj}, thisObj._ajaxDeletePrice);
				}
				
				if (data.ds.length < data.page_size) {
					var aObj = $(thisRootObj).find('.price-more').find('a');
					$(aObj).attr('data-more', '0');
					$(aObj).html('没有更多价格内容');
				}
			} else {
				var aObj = $(thisRootObj).find('.price-more').find('a');
				$(aObj).attr('data-more', '0');
				$(aObj).html('没有更多价格内容');
			}
		});
	}

	// 隐藏消费项
	ModalCJPrice.prototype.hidePrices = function() {
		$(this.root).addClass('hidden_ctrl');
	}

	// 销毁消费项
	ModalCJPrice.prototype.destoryPrices = function() {
		this.obj_type = null;
		this.obj_id = null;
		this.page = 0;
		this.max_page = 1;
		$(this.root).remove();
	}

</script>

<div class="item template_item hidden_ctrl" data-id="">
	<div class="row">
		<div class="col-md-3 data_item_name">
			<label>名称：</label>
			<span></span>
		</div>
										
		<div class="col-md-2 data_item_type">
			<label>项特殊类型：</label>
			<span></span>		
		</div>
		<div class="col-md-1 data_item_stock">
			<label>库存：</label>
			<span></span>
		</div>
		<div class="col-md-2 item-room data_item_room_area">
			<label>房间面积：</label>
			<span></span>平米
		</div>
		<div class="col-md-1 item-room data_item_window">
			<label>窗户数量：</label>
			<span></span>
		</div>
		<div class="col-md-1 item-room data_item_air">
			<label>空调数量：</label>
			<span></span>
		</div>
		<div class="col-md-2 item-room data_item_bed_type">
			<label>床宽：</label>
			<span></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1 item-room data_item_wash_supplies">
			<label><input type="checkbox">洗漱用品</label>
		</div>
		<div class="col-md-1 item-room data_item_bathroom_curtain">
			<label><input type="checkbox">卫浴窗帘</label>
		</div>
		<div class="col-md-1 item-room data_item_double_breakfast">
			<label><input type="checkbox">双早</label>
		</div>
		<div class="col-md-1 item-room data_item_append_bed">
			<label><input type="checkbox">加床</label>
		</div>
		<div class="col-md-1 item-room data_item_wifi">
			<label><input type="checkbox">WIFI</label>
		</div>
		<div class="col-md-1 data_item_necessary">
			<label><input type="checkbox">必须项</label>
		</div>
		<div class="col-md-1 data_item_free">
			<label><input type="checkbox">赠品</label>
		</div>
		<div class="col-md-1 data_item_recycle">
			<label><input type="checkbox">回收物品</label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 data_item_beizhu">
			<label>备注：</label>
			<span></span>
		</div>
	</div>
	<div class="row item-opreate">
		<a class="btn-item-price"><i>价格详细</i></a>
		<a class="btn-item-edit"><i>编辑信息</i></a>
		<a class="btn-item-delete"><i style="color: red">删除信息</i></a>
	</div>
	<div class="row item-price"></div>
</div>

<!--详细内容，价格项，价格详细-->
<div class="source-container item-container template-item_container hidden_ctrl">
	<div class="title" style="background-color: rgba(96,163,35,0.5);">
		<span class="item-title">价格项</span>
		<a class="btn-item-append"><i>添加价格项</i></a>
		<a class="expand-fold" style="float: right; "><b>折叠</b><i class="fa-chevron-down"></i></a>
	</div>
	<div class="item-border">
	</div>
	<div class="item-footer" style="text-align: center;">
		<a href="javascript:;" style="width: 10%;" class="item-more" data-more="1">点击加载更多价格项<i class="fa-arrow-down"></i></a>		
	</div>
</div>

<script type="text/javascript">
	//点击闪烁操作区域
    var timerObj = null, timeCount = 0;
	function lightEdit(){
        timeCount++;
	    $('.create').toggleClass("twinkle");
	    if (timeCount >5) {
	        clearInterval(timerObj);
		}
	}

	function flicker(focusObj) {
        timeCount = 0;
        $('body').animate({scrollTop:100}, 500);
        $(focusObj).focus();
        timerObj = setInterval(lightEdit, 500);
	}
	
	$('.source-container .title').click(function(){
		var thisObj = $(this).find('.expand-fold');
		var expand = $(thisObj).find('i').attr('class').indexOf('up') < 0 ? false : true;
		var btext = expand ? '展开' : '折叠';
		var iclass = expand ? 'fa-chevron-down' : 'fa-chevron-up';
		$(thisObj).find('b').html(btext);
		$(thisObj).find('i').attr('class', iclass);
		$(thisObj).parent().next().css('display', expand ? 'block' : 'none');
	})
	
	function ModalCJItem(vobj, objType, objId) {
		if (vobj == null || objType == null || objId == null) {
			toastr.error('Error:显示价格项的参数有误');
			return false;
		}
		
		this.root = $('.template-item_container').clone(true);
		$(this.root).removeClass('template-item_container');
		this.obj = vobj;
		this.obj_type = objType;
		this.obj_id = objId;
		this.page = 0;
		this.max_page = 1;
		this.modal_item = new ModalFCJItem();
		this.price_panel = null;
			
		// 添加价格项到表格
		var trObj = $(vobj).closest('tr');
		var colLen = $(trObj).find('td').length;
		$(trObj).after('<tr><td colspan="'+colLen+'"></td></tr>');
		$(trObj).next().find('td').append(this.root);
			
		// 加载价格项
		this.loadMoreItems();
		
		// 显示添加价格项弹出框
		$(this.root).find('.btn-item-append').bind('click', {obj:this}, this.showAppendItem);
		$(this.root).find('.item-more').bind('click', {obj:this}, this.findMoreItem);
	}

	ModalCJItem.prototype.showItems = function(){	
		$(this.root).removeClass('hidden_ctrl');
	}

	// 显示添加价格项弹出框
	ModalCJItem.prototype.showAppendItem = function(ev) {
		ev.stopPropagation();
		if (ev.data != null && ev.data.obj != null) {
			var thisObj = ev.data.obj;
			var item_id = null;
			if ($(this).closest('.item').length > 0) {
				item_id = $(this).closest('.item').attr('data-id');	
			}		
			ev.data.obj.modal_item.showModal(thisObj, thisObj.obj_type, thisObj.obj_id, item_id, thisObj._ajaxSaveItem);	
		} else {
			console.log('没有绑定对象');
		}
	}
	
	// 加载更多价格项
	ModalCJItem.prototype.findMoreItem = function(ev) {
		if (ev.data != null && ev.data.obj != null) {
			ev.data.obj.loadMoreItems();
		} else {
			console.log('没有绑定对象');
		}
	}
	
	// 显示价格详细
	ModalCJItem.prototype.showPriceList = function(ev) {
		if (ev.data != null && ev.data.obj != null) {
			var thisObj = ev.data.obj;
			var item_id = null;
			if ($(this).closest('.item').length > 0) {
				var itemObj = $(this).closest('.item');
				var item_id = $(itemObj).attr('data-id');
				// 显示或者创建价格
				var priceKey = 'price_'+item_id;
				if (thisObj.price_panel == null) {
					thisObj.price_panel = [];
				}
				var priceObj = thisObj.price_panel[priceKey];
				if (priceObj == null) {
					var priceRootObj = $(this).closest('.item').find('.item-price');
					priceObj = new ModalCJPrice(priceRootObj, thisObj.obj_type, thisObj.obj_id, item_id);
					thisObj.price_panel[priceKey] = priceObj;
				}
				priceObj.showPrices();
			} else {
				toastr.warning('价格项对象错误');
			}	
		} else {
			toastr.warning('没有绑定对象');
		}
	}

	// 添加编辑价格项
	ModalCJItem.prototype._ajaxSaveItem = function(itemObj, d, op) {
		if (d != null) {
			var rootObj = null;
			if (op == 'create') {
				rootObj = $('.template_item').clone();
				$(rootObj).removeClass('template_item');
				$(rootObj).removeClass('hidden_ctrl');
				$(rootObj).attr('data-id', d.id);
			} else {
				rootObj = $('.item[data-id="'+d.id+'"]');
			}
							
			// 名称
			$(rootObj).find('.data_item_name span').html(d.name);				
			// 特殊项类型
			$(rootObj).find('.data_item_type span').html(d.type_data.type_desc);				
			// 库存
			$(rootObj).find('.data_item_stock span').html(d.stock);
			
			if (d.type != null && d.type != 'undefined' && d.type != '[]' && d.type != '{}') {
				var typeData = $.parseJSON(d.type);	
				console.log(JSON.stringify(typeData));
				if (typeData.type_key == 'cj_item_type_room') {	
					$(rootObj).find('.item-room').removeClass('hidden_ctrl');
					// 房间面积
					$(rootObj).find('.data_item_room_area span').html(d.room_area);				
					// 窗户数量
					$(rootObj).find('.data_item_window span').html(d.window);				
					// 空调数量
					$(rootObj).find('.data_item_air span').html(d.air_conditioner);						
					// 床宽
					$(rootObj).find('.data_item_bed_type span').html(d.bed_width_show);
					// 洗漱用品
					$(rootObj).find('.data_item_wash_supplies input').prop('checked', d.wash_supplies == 1 ? true : false).trigger('change');
					// 卫浴窗帘
					$(rootObj).find('.data_item_bathroom_curtain input').prop('checked', d.bathroom_curtain == 1 ? true : false).trigger('change');
					// 双早	
					$(rootObj).find('.data_item_double_breakfast input').prop('checked', d.double_breakfast == 1 ? true : false).trigger('change');
					// 加床	
					$(rootObj).find('.data_item_append_bed input').prop('checked', d.append_bed == 1 ? true : false).trigger('change');
					// WIFI	
					$(rootObj).find('.data_item_wifi input').prop('checked', d.wifi == 1 ? true : false).trigger('change');
							
				} else {
					$(rootObj).find('.item-room').addClass('hidden_ctrl');
				}
			} else {
				$(rootObj).find('.item-room').addClass('hidden_ctrl');
			}
			
			// 必须项
			$(rootObj).find('.data_item_necessary input').prop('checked', d.necessary == 1 ? true : false).trigger('change');
			// 回收物品	
			$(rootObj).find('.data_item_recycle input').prop('checked', d.is_recycle == 1 ? true : false).trigger('change');
			// 赠品	
			$(rootObj).find('.data_item_free input').prop('checked', d.is_free == 1 ? true : false).trigger('change');
			// 库存
			$(rootObj).find('.data_item_beizhu span').html(d.beizhu);
						
			// 添加价格项
			if (op == 'create') {
				$(itemObj.root).find('.item-border').prepend('<hr class="separator-line"/>');
				$(itemObj.root).find('.item-border').prepend(rootObj);
				
				// 绑定显示价格时间
				$(rootObj).find('.btn-item-price').bind('click', {obj:itemObj}, itemObj.showPriceList);
				// 绑定编辑事件
				$(rootObj).find('.btn-item-edit').bind('click', {obj:itemObj}, itemObj.showAppendItem);
				// 绑定删除事件
				$(rootObj).find('.btn-item-delete').bind('click', {obj:itemObj}, itemObj._ajaxDeleteItem);
			}
		}
	}

	// 删除价格项
	ModalCJItem.prototype._ajaxDeleteItem = function(e) {
		if (e.data == null || e.data.obj == null) {
			toastr.warning('未绑定对象，不能触发事件');
			return false;
		}
		var thisObj = e.data.obj;
		
		if (!confirm('您确定要删除该价格项')) {
			console.log('取消删除价格项');
			return false;
		}
		
		var rootObj = $(this).closest('.item');
		var item_id = $(rootObj).attr('data-id');
		if (item_id == 'null' || item_id == 'undefined' || item_id == '') {
			toastr.warning('价格项编号无效');
			return false;
		}	
		$.post('<?php echo U("financial/item");?>',{op_type:'delete', id:item_id}, function(data){
			if (data.result.errno == 0) {
				$(rootObj).remove();
				// 移除分割线
				$(rootObj).next().remove();
			} else {
				toastr.error(data.result.message);
			}
		})
	}

	// 加载更多价格项
	ModalCJItem.prototype.loadMoreItems = function() {
		var thisRootObj = this.root;
		if ($(thisRootObj).find('.item-more').attr('data-more') == '0') {
			return false;
		}
		
		var str = 'obj_id|=|'+this.obj_id+'|AND';
		var jsonData = {
			op_type: 'list',
			obj_type: this.obj_type,
			cdtype: 4,
			cdsstr: str,
			page: this.page,
		}
		
		var thisObj = this;
		$.post('<?php echo U("financial/item");?>', jsonData, function(data){
			thisObj.page ++;
			if (data.page_count != null) {
				thisObj.max_page = data.page_count;	
			}
			if (data.ds != null) {
				for (var i=0; i < data.ds.length; i++) {
					var d = data.ds[i];
					var rootObj = $('.template_item').clone();
					$(rootObj).removeClass('template_item');
					$(rootObj).removeClass('hidden_ctrl');
					$(rootObj).attr('data-id', d.id);
					
					// 名称
					$(rootObj).find('.data_item_name span').html(d.name);			
					// 特殊项类型
					if (d.type_data != null) {
						$(rootObj).find('.data_item_type span').html(d.type_data.type_desc);	
					}
					// 库存
					$(rootObj).find('.data_item_stock span').html(d.stock);
					
					if (d.type != null && d.type != 'undefined' && d.type != '[]' && d.type != '{}') {
						var typeData = $.parseJSON(d.type);	
						if (typeData.type_key == 'cj_item_type_room') {
							$(rootObj).find('.item-room').removeClass('hidden_ctrl');				
							// 房间面积
							$(rootObj).find('.data_item_room_area span').html(d.room_area);				
							// 窗户数量
							$(rootObj).find('.data_item_window span').html(d.window);				
							// 空调数量
							$(rootObj).find('.data_item_air span').html(d.air_conditioner);						
							// 床宽
							$(rootObj).find('.data_item_bed_type span').html(d.bed_width_show);
							// 洗漱用品
							$(rootObj).find('.data_item_wash_supplies input').prop('checked', d.wash_supplies == 1 ? true : false).trigger('change');
							// 卫浴窗帘
							$(rootObj).find('.data_item_bathroom_curtain input').prop('checked', d.bathroom_curtain == 1 ? true : false).trigger('change');
							// 双早	
							$(rootObj).find('.data_item_double_breakfast input').prop('checked', d.double_breakfast == 1 ? true : false).trigger('change');
							// 加床	
							$(rootObj).find('.data_item_append_bed input').prop('checked', d.append_bed == 1 ? true : false).trigger('change');
							// WIFI	
							$(rootObj).find('.data_item_wifi input').prop('checked', d.wifi == 1 ? true : false).trigger('change');
						} else {
							$(rootObj).find('.item-room').addClass('hidden_ctrl');
						}
					} else {
						$(rootObj).find('.item-room').addClass('hidden_ctrl');						
					}
					
					// 必须项
					$(rootObj).find('.data_item_necessary input').prop('checked', d.necessary == 1 ? true : false).trigger('change');
					// 赠品	
					$(rootObj).find('.data_item_free input').prop('checked', d.is_free == 1 ? true : false).trigger('change');	
					// 回收物品	
					$(rootObj).find('.data_item_recycle input').prop('checked', d.is_recycle == 1 ? true : false).trigger('change');	
					// 库存
					$(rootObj).find('.data_item_beizhu span').html(d.beizhu);
					
					// 添加价格项
					$(thisRootObj).find('.item-border').append(rootObj);
					$(thisRootObj).find('.item-border').append('<hr class="separator-line"/>');
										
					// 绑定显示价格时间
					$(rootObj).find('.btn-item-price').bind('click', {obj:thisObj}, thisObj.showPriceList);
					// 绑定编辑事件
					$(rootObj).find('.btn-item-edit').bind('click', {obj:thisObj}, thisObj.showAppendItem);
					// 绑定删除事件
					$(rootObj).find('.btn-item-delete').bind('click', {obj:thisObj}, thisObj._ajaxDeleteItem);
				}
				
				if (data.ds.length < data.page_size) {
					var aObj = $(thisRootObj).find('.item-more');
					$(aObj).attr('data-more', '0');
					$(aObj).html('没有更多价格内容');
					$(aObj).css('color', 'red');
				}
			} else {
				var aObj = $(thisRootObj).find('.more');
				$(aObj).attr('data-more', '0');
				$(aObj).html('没有更多价格内容');
				$(aObj).css('color', 'red');
			}
		});
	}

	// 隐藏价格项
	ModalCJItem.prototype.hideItems = function() {
		$(this.root).addClass('hidden_ctrl');
	}

	// 销毁价格项
	ModalCJItem.prototype.destoryItems = function() {
		this.obj_type = null;
		this.obj_id = null;
		this.page = 0;
		this.max_page = 1;
		$(this.root).remove();
	}

</script><?php endif; ?> 
<?php if(!empty($modal_fcj_item)): ?><style type="text/css">
	.row { margin-top:15px; }
	.fitem-room { display: none; }
</style>
<!-- 添加数据类型 -->
<div class="modal fade custom-width" id="gallery-fcj-item-modal" data-backdrop="static">
	<div class="modal-dialog" style="width: 60%">
		<div class="modal-content">
			
			<div class="modal-header">
				<h4 class="modal-title">编辑价格项</h4>
			</div>
			
			<div class="modal-body">
				
				<div class="row">
					<div class="col-md-4 data_fitem_name">
						<label class="control-label" for="data_fitem_name">名称：<span style="color:red;">(*必选)</span></label>
						<input class="form-control" name="data_fitem_name" id="data_fitem_name" />
					</div>
													
					<div class="col-md-4 data_fitem_type">
						<label class="control-label" for="data_fitem_type">项特殊类型<span style="color:red;">(*必选)</span></label>
						<input class="form-control" name="data_fitem_type" id="data_fitem_type" />				
						<script type="text/javascript">
							$(document).ready(function(){
				
								// 绑定切换价格项类型事件		
								bindTypeDataDropMenu($('#data_fitem_type'), 'cj_item_type', '选择价格项类型', false, null, false, itemTypeChanged);
										
							});
						</script>
					</div>
					<div class="col-md-4 data_fitem_stock">
						<label class="control-label" for="data_fitem_stock">库存数量：</label>
						<input class="form-control" name="data_fitem_stock" id="data_fitem_stock" type="number" placeholder="请输入价格项所剩的库存数量" />
					</div>
				</div>
				<div class="row fitem-room">
					<div class="col-md-2 data_fitem_room_area">
						<label class="control-label" for="data_fitem_room_area">房间面积：</label>
						<input class="form-control" name="data_fitem_room_area" id="data_fitem_room_area" type="number" />
					</div>
					<div class="col-md-2 data_fitem_window">
						<label class="control-label" for="data_fitem_window">窗户数量：</label>
						<input class="form-control" name="data_fitem_window" id="data_fitem_window" type="number" />
					</div>
					<div class="col-md-2 data_fitem_air">
						<label class="control-label" for="data_fitem_air">空调数量：</label>
						<input class="form-control" name="data_fitem_air" id="data_fitem_air" type="number" />
					</div>
					<div class="col-md-6 data_fitem_bed_type">
						<label class="control-label" for="data_fitem_bed_type">床宽</label>
						<script type="text/javascript">
							$(document).ready(function(){		
								bindTypeDataDropMenu($('#data_fitem_bed_type'), 'cj_bed_type', '选择房间包含的床铺类型', true, false, true);
							});
						</script>
						<input class="form-control" name="data_fitem_bed_type" id="data_fitem_bed_type" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-1 form-group fitem-room data_fitem_wash_supplies">
						<label class="control-label" for="data_fitem_free">洗漱用品</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fitem_wash_supplies" id="data_fitem_wash_supplies" />
					</div>
					<div class="col-md-1 form-group fitem-room data_fitem_bathroom_curtain">
						<label class="control-label" for="data_fitem_bathroom_curtain">卫浴窗帘</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fitem_bathroom_curtain" id="data_fitem_bathroom_curtain" />
					</div>
					<div class="col-md-1 form-group fitem-room data_fitem_double_breakfast">
						<label class="control-label" for="data_fitem_double_breakfast">双早</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fitem_double_breakfast" id="data_fitem_double_breakfast" />
					</div>
					<div class="col-md-1 form-group fitem-room data_fitem_append_bed">
						<label class="control-label" for="data_fitem_append_bed">加床</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fitem_append_bed" id="data_fitem_append_bed" />
					</div>
					<div class="col-md-1 form-group fitem-room data_fitem_wifi">
						<label class="control-label" for="data_fitem_wifi">WIFI</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fitem_wifi" id="data_fitem_wifi" />
					</div>
					<div class="col-md-1 form-group data_fitem_necessary">
						<label class="control-label" for="data_fitem_necessary">必须项</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fitem_necessary" id="data_fitem_necessary" />
					</div>
					<div class="col-md-1 form-group data_fitem_free">
						<label class="control-label" for="data_fitem_free">赠品</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fitem_free" id="data_fitem_free" />
					</div>
					<div class="col-md-1 form-group data_fitem_recycle">
						<label class="control-label" for="data_fitem_recycle">回收物品</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fitem_recycle" id="data_fitem_recycle" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 data_fitem_beizhu">
						<label class="control-label" for="data_fitem_beizhu">备注：</label>
						<input class="form-control" name="data_fitem_beizhu" id="data_fitem_beizhu" />
					</div>
				</div>
				
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-white btn-fitem-close" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-secondary btn-fitem-add">保存</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	// 价格项类型被选择
	function itemTypeChanged(evt) {
		if (evt.added != null) {
			var sel_data = evt.added;
			if (sel_data.type_key.indexOf('room') != -1) {
				$('.fitem-room').css('display', 'block');
				return false;
			}
		}		
		$('.fitem-room').css('display', 'none');
	}

	function ModalFCJItem() {
		this.root = $('#gallery-fcj-item-modal');
		this.item_obj = null;
		this.obj_type = null;
		this.obj_id = null;
		this.item_id = null;
		this.callbackFunc = null;	
		
		// 绑定取消事件
		$(this.root).find('.btn-fitem-close').bind('click', {obj:this}, this.cancelItem);
	}
	
	ModalFCJItem.prototype.showModal = function(itemObj, objType, objId, itemId, confirmCallBack){
		this.item_obj = itemObj;
		this.obj_type = objType;
		this.obj_id = objId;
		this.item_id = itemId;
		this.callbackFunc = confirmCallBack;
		
		// 显示面板
		$(this.root).modal('show');	
		
		// 填充价格项数据
		this.fillItem();	
				
		// 绑定确认事件
		$(this.root).find('.btn-fitem-add').unbind();
		$(this.root).find('.btn-fitem-add').bind('click', {obj:this}, this.confirmItem);
	}
	
	ModalFCJItem.prototype.clearItem = function (){
		this.item_obj = null;
		this.item_id = null;
		this.callbackFunc = null;
					
		var modalRootObj = this.root;
		$(modalRootObj).attr('data-id', '');												
		// 名称
		$(modalRootObj).find('.data_fitem_name input').val('');
		// 特殊项类型			
		setSelect2Value($(modalRootObj).find('#data_fitem_type'), null);							
		// 库存
		$(modalRootObj).find('.data_fitem_stock input').val('0');
		// 房间特殊类型				
		$(modalRootObj).find('.fitem-room').css('display', 'none');												
		// 房间面积
		$(modalRootObj).find('.data_fitem_room_area input').val('');					
		// 窗户数量
		$(modalRootObj).find('.data_fitem_window input').val('');
		// 空调数量
		$(modalRootObj).find('.data_fitem_air input').val('');							
		// 床宽
		setSelect2Value($(modalRootObj).find('#data_fitem_bed_type'), null);
		
		// 洗漱用品
		$(modalRootObj).find('#data_fitem_wash_supplies').prop('checked', false).trigger('change');
		// 卫浴窗帘
		$(modalRootObj).find('#data_fitem_bathroom_curtain').prop('checked', false).trigger('change');					
		// 双早
		$(modalRootObj).find('#data_fitem_double_breakfast').prop('checked', false).trigger('change');					
		// 加床
		$(modalRootObj).find('#data_fitem_append_bed').prop('checked', false).trigger('change');					
		// WIFI
		$(modalRootObj).find('#data_fitem_wifi').prop('checked', false).trigger('change');
		
		// 必须项
		$(modalRootObj).find('#data_fitem_necessary').prop('checked', false).trigger('change');				
		// 赠品
		$(modalRootObj).find('#data_fitem_free').prop('checked', false).trigger('change');				
		// 回收物品
		$(modalRootObj).find('#data_fitem_recycle').prop('checked', false).trigger('change');					
		// 库存
		$(modalRootObj).find('.data_fitem_beizhu input').val('');
	}
	
	ModalFCJItem.prototype.fillItem = function() {		
		var thisObj = this;
		if (this.item_id != null) {
			$.post('<?php echo U("financial/item");?>', {op_type: 'find', cdtype:2, cdsstr:'id|'+this.item_id}, function(data){
				if (data.ds != null) {					
					var d = data.ds;			
					var modalRootObj = thisObj.root;
					$(modalRootObj).attr('data-id', d.id);															
					// 名称
					$(modalRootObj).find('.data_fitem_name input').val(d.name);					
					// 特殊项类型			
					setSelect2Value($(modalRootObj).find('#data_fitem_type'), d.type);									
					// 库存
					$(modalRootObj).find('.data_fitem_stock input').val(d.stock);
					
					if (d.type != null && d.type != 'undefined' && d.type != '[]' && d.type != '{}') {
						var typeData = $.parseJSON(d.type);	
						if (typeData.type_key == 'cj_item_type_room') {						
							$(modalRootObj).find('.fitem-room').css('display', 'block');												
							// 房间面积
							$(modalRootObj).find('.data_fitem_room_area input').val(d.room_area);					
							// 窗户数量
							$(modalRootObj).find('.data_fitem_window input').val(d.window);					
							// 空调数量
							$(modalRootObj).find('.data_fitem_air input').val(d.air_conditioner);							
							// 床宽
							setSelect2Value($(modalRootObj).find('#data_fitem_bed_type'),d.bed_width);
							
							// 洗漱用品
							$(modalRootObj).find('#data_fitem_wash_supplies').prop('checked', d.wash_supplies == 1 ? true : false).trigger('change');
							// 卫浴窗帘
							$(modalRootObj).find('#data_fitem_bathroom_curtain').prop('checked', d.bathroom_curtain == 1 ? true : false).trigger('change');					
							// 双早
							$(modalRootObj).find('#data_fitem_double_breakfast').prop('checked', d.double_breakfast == 1 ? true : false).trigger('change');					
							// 加床
							$(modalRootObj).find('#data_fitem_append_bed').prop('checked', d.append_bed == 1 ? true : false).trigger('change');					
							// WIFI
							$(modalRootObj).find('#data_fitem_wifi').prop('checked', d.wifi == 1 ? true : false).trigger('change');
										
						} else {
							$(modalRootObj).find('.item-room').addClass('hidden_ctrl');
						}
					} else {
						$(modalRootObj).find('.item-room').addClass('hidden_ctrl');
					}
					
					// 必须项
					$(modalRootObj).find('#data_fitem_necessary').prop('checked', d.necessary == 1 ? true : false).trigger('change');				
					// 赠品
					$(modalRootObj).find('#data_fitem_free').prop('checked', d.is_free == 1 ? true : false).trigger('change');
					// 回收物品
					$(modalRootObj).find('#data_fitem_recycle').prop('checked', d.is_recycle == 1 ? true : false).trigger('change');					
					// 库存
					$(modalRootObj).find('.data_fitem_beizhu input').val(d.beizhu);
				}
			});
		}
	}
	
	// 确认添加/修改数据
	ModalFCJItem.prototype.confirmItem = function(e){
		if (e.data == null || e.data.obj == null) {
			console.log('未绑定对象，不能触发事件');
			return false;
		}
					
		var param = {
			'op_type': 'save',
			'obj_type': e.data.obj.obj_type,
			'obj_id': e.data.obj.obj_id,
			'id': e.data.obj.item_id,
			'name': $(e.data.obj.root).find('#data_fitem_name').val(),
			'type': getSelect2Value($(e.data.obj.root).find('#data_fitem_type')),
			'stock': $(e.data.obj.root).find('#data_fitem_stock').val(),
			'room_area': $(e.data.obj.root).find('#data_fitem_room_area').val(),
			'window': $(e.data.obj.root).find('#data_fitem_window').val(),
			'air_conditioner': $(e.data.obj.root).find('#data_fitem_air').val(),
			'bed_width': getSelect2Value($(e.data.obj.root).find('#data_fitem_bed_type')),
			'wash_supplies': $(e.data.obj.root).find('#data_fitem_wash_supplies').prop('checked') ? 1 : 0,
			'bathroom_curtain': $(e.data.obj.root).find('#data_fitem_bathroom_curtain').prop('checked') ? 1 : 0,
			'double_breakfast': $(e.data.obj.root).find('#data_fitem_double_breakfast').prop('checked') ? 1 : 0,
			'append_bed': $(e.data.obj.root).find('#data_fitem_append_bed').prop('checked') ? 1 : 0,
			'wifi': $(e.data.obj.root).find('#data_fitem_wifi').prop('checked') ? 1 : 0,
			'necessary': $(e.data.obj.root).find('#data_fitem_necessary').prop('checked') ? 1 : 0,
			'is_free': $(e.data.obj.root).find('#data_fitem_free').prop('checked') ? 1 : 0,
			'is_recycle': $(e.data.obj.root).find('#data_fitem_recycle').prop('checked') ? 1 : 0,
			'beizhu': $(e.data.obj.root).find('#data_fitem_beizhu').val(),
		}
		
//		console.log(e.data.obj.obj_type +'/'+ e.data.obj.obj_id);
//		console.log(JSON.stringify(param));
		if (e.data.obj.obj_type == null || e.data.obj.obj_id == null || param.name == '' || param.type == '') {
			toastr.warning('保存消费项的参数不足，可能缺少资源类型、资源对象、消费项名称、消费项类型其中的一项，所以价格不能保存');
			return false;
		}
		
		var callbackFunc = e.data.obj.callbackFunc;
		var itemObj = e.data.obj.item_obj;		
		$.post('<?php echo U("financial/item");?>', param, function(data){
			if (data.result != null) {
				if (data.extra_result != null) {
					if (data.result.errno != 0 && data.extra_result.errno != 0){
						toastr.error(data.result.message + '<br />' + data.extra_result.message);
						return false;	
					}
				} else {
					if (data.result.errno != 0){
						toastr.error(data.result.message);
						return false;	
					}	
				}
			}
			
			toastr.success('修改价格项成功!!!');
			if (callbackFunc != 'undefined' && callbackFunc != null && typeof(callbackFunc) == 'function') {				
				callbackFunc(itemObj, data.ds, data.op);
			}
		});
		e.data.obj.hideModal();
	}
	
	ModalFCJItem.prototype.hideModal = function() {
		this.clearItem();
		$(this.root).modal('hide');
	}
	
	// 取消编辑项
	ModalFCJItem.prototype.cancelItem = function(e) {
		if (e.data == null || e.data.obj == null) {
			console.log('未绑定对象，不能触发事件');
			return false;
		}
		e.data.obj.hideModal();
	}
	
</script><?php endif; ?> 
<?php if(!empty($modal_fcj_price)): ?><style type="text/css">
	.row { margin-top:15px; }
	.range-input { width: 46%!important; }
	.range-input-seperator { width: 8%!important; }
	.fprice_limit { margin-left: 15px; }
</style>
<!-- 添加数据类型 -->
<div class="modal fade custom-width" id="gallery-fcj-price-modal" data-backdrop="static">
	<div class="modal-dialog" style="width: 60%">
		<div class="modal-content">
			
			<div class="modal-header">
				<h4 class="modal-title">编辑价格</h4>
			</div>
			
			<div class="modal-body">
				
				<div class="row">
					<div class="col-md-4 data_fprice_title">
						<label class="control-label" for="data_fprice_title">名称：<span style="color:red;">(*必选)</span></label>
						<input class="form-control" name="data_fprice_title" id="data_fprice_title" />
					</div>
					<div class="col-md-1 form-group fprice_limit">
						<label class="control-label" for="data_fprice_rebate">返利：</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fprice_rebate" id="data_fprice_rebate" />
					</div>
					<div class="col-md-3 data_fprice_price">
						<label class="control-label" for="data_fprice_price">报价：</label>
						<input class="form-control" name="data_fprice_price" id="data_fprice_price" type="number" placeholder="请输入报价金额" />
					</div>
					<!--<div class="col-md-3 data_fprice_real_price">
						<label class="control-label" for="data_fprice_real_price">实价：</label>
						<input class="form-control" name="data_fprice_real_price" id="data_fprice_real_price" type="number" placeholder="请输入实价金额" />
					</div>-->
				</div>
				<div class="row">
					<div class="form-group fprice_limit" style="width: 10%; float: left;">
						<label class="control-label" for="data_fprice_time">按时报价</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fprice_time" id="data_fprice_time" />
					</div>
					<div class="hidden_ctrl data_fprice_time" style="width: 38%; float: left;">
						<label>有效时间：</label>
						<div class="input-group" style="border-color: #40bbea;">
							<input type="text" id="data_fprice_time_limit" readonly class="form-control daterange" data-format="YYYY-MM-DD" data-separator=" / " placeholder="点击选择日期"/>							
							<div class="input-group-addon">							
								<a href="javascript:;"><i class="linecons-calendar"></i></a>								
							</div>
						</div>
					</div>
					<div class="form-group fprice_limit" style="width: 10%; float: left;">
						<label class="control-label" for="data_fprice_line">按线路报价</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fprice_line" id="data_fprice_line" />
					</div>
					<div class="hidden_ctrl data_fprice_line" style="width: 38%; float: left;">
						<label>有效线路：</label>
						<div>
							<script type="text/javascript">
								$(document).ready(function(){
									var ds = {tab:'line', show_col:'title', cdsstr: 'invalid|=|0|AND', cdtype:4}
									bindSelect2DropMenu($('#data_fprice_line_data'), ds, '请选择线路', 1, false);	
								});
							</script>
							<input class="form-control" name="data_fprice_line_data" id="data_fprice_line_data" style="width: 100%" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group fprice_limit" style="width: 10%; float: left;">
						<label class="control-label" for="data_fprice_member">按人报价</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fprice_member" id="data_fprice_member" />
					</div>
					<div class="hidden_ctrl data_fprice_member" style="width: 38%; float: left;">
						<label>有效人数：</label>
						<div class="input-group">
							<input class="form-control range-input" name="data_fprice_member_min" id="data_fprice_member_min" type="number" value="0" />
							<span class="form-control range-input-seperator"> - </span>
							<input class="form-control range-input" name="data_fprice_member_max" id="data_fprice_member_max" type="number" value="0" />
						</div>
					</div>
					<div class="form-group fprice_limit" style="width: 10%; float: left;">
						<label class="control-label" for="data_fprice_day">按天报价</label><br />
						<input type="checkbox" class="iswitch iswitch-secondary" name="data_fprice_day" id="data_fprice_day" />
					</div>
					<div class="hidden_ctrl data_fprice_day" style="width: 38%; float: left;">
						<label>有效天数：</label>
						<div class="input-group">
							<input class="form-control range-input" name="data_fprice_day_min" id="data_fprice_day_min" type="number" value="0" />
							<span class="form-control range-input-seperator"> - </span>
							<input class="form-control range-input" name="data_fprice_day_max" id="data_fprice_day_max" type="number" value="0" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 data_fprice_beizhu">
						<label class="control-label" for="data_fprice_beizhu">备注：</label>
						<input class="form-control" name="data_fprice_beizhu" id="data_fprice_beizhu" />
					</div>
				</div>
				
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-white btn-fprice-close" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-secondary btn-fprice-add">保存</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	function ModalFCJPrice() {
		this.root = $('#gallery-fcj-price-modal');
		this.price_obj = null;
		this.obj_type = null;
		this.obj_id = null;
		this.item_id = null;
		this.price_id = null;
		this.callbackFunc = null;		
		
		// 限制项改变
		$(this.root).find('.fprice_limit input').bind('change', {obj:this}, this.limitChanged)		
		// 绑定取消事件
		$(this.root).find('.btn-fprice-close').bind('click', {obj:this}, this.cancelPrice);		
	}
	
	ModalFCJPrice.prototype.showModal = function(priceObj, objType, objId, itemId, priceId, confirmCallBack){
		this.price_obj = priceObj;
		this.obj_type = objType;
		this.obj_id = objId;
		this.item_id = itemId;
		this.price_id = priceId;
		this.callbackFunc = confirmCallBack;
		
		// 显示面板
		$(this.root).modal('show');	
		
		// 填充价格数据
		this.fillPrice();		
			
		// 绑定确认事件
		$(this.root).find('.btn-fprice-add').unbind();
		$(this.root).find('.btn-fprice-add').bind('click', {obj:this}, this.confirmPrice);
	}
	
	ModalFCJPrice.prototype.clearPrice = function (){
		this.price_obj = null;
		this.price_id = null;
		this.callbackFunc = null;
					
		var modalRootObj = this.root;
		$(modalRootObj).attr('data-id', '');
		// 名称
		$(modalRootObj).find('#data_fprice_title').val('');
		// 返利
		$(modalRootObj).find('#data_fprice_rebate').prop('checked', false).trigger('change');
		// 报价
		$(modalRootObj).find('#data_fprice_price').val('');
		// 实价
//		$(modalRootObj).find('#data_fprice_real_price').val('');
		// 按时报价
		$(modalRootObj).find('#data_fprice_time').prop('checked', false).trigger('change');
		$(modalRootObj).find('#data_fprice_time_limit').val('');		
		// 按人报价
		$(modalRootObj).find('#data_fprice_member').prop('checked', false).trigger('change');
		$(modalRootObj).find('#data_fprice_member_min').val('');
		$(modalRootObj).find('#data_fprice_member_max').val('');	
		// 按天报价
		$(modalRootObj).find('#data_fprice_day').prop('checked', false).trigger('change');
		$(modalRootObj).find('#data_fprice_day_min').val('');
		$(modalRootObj).find('#data_fprice_day_max').val('');
		// 按线路报价
		$(modalRootObj).find('#data_fprice_line').prop('checked', false).trigger('change');
		setSelect2Value($(modalRootObj).find('#data_fprice_line_data'), null);
		// 备注
		$(modalRootObj).find('#data_fprice_beizhu').val('');
	}
	
	ModalFCJPrice.prototype.fillPrice = function() {		
		var thisObj = this;
		if (this.price_id != null) {
			$.post('<?php echo U("financial/price");?>', {op_type: 'find', id: this.price_id}, function(data){
				if (data.ds != null) {					
					var d = data.ds;
					console.log(JSON.stringify(d));	
					var modalRootObj = thisObj.root;
					$(modalRootObj).attr('data-id', d.id);
					// 名称
					$(modalRootObj).find('#data_fprice_title').val(d.title);
					// 返利
					$(modalRootObj).find('#data_fprice_rebate').prop('checked', d.is_rebate == 1 ? true : false).trigger('change');
					// 报价
					$(modalRootObj).find('#data_fprice_price').val(d.price);
					// 实价
//					$(modalRootObj).find('#data_fprice_real_price').val(d.real_price);
					// 按时报价
					$(modalRootObj).find('#data_fprice_time').prop('checked', d.is_time == 1 ? true : false).trigger('change');
					$(modalRootObj).find('#data_fprice_time_limit').val(d.start_time+' / '+d.end_time);
					// 按人报价
					$(modalRootObj).find('#data_fprice_member').prop('checked', d.is_member == 1 ? true : false).trigger('change');
					$(modalRootObj).find('#data_fprice_member_min').val(d.min_num);
					$(modalRootObj).find('#data_fprice_member_max').val(d.max_num);
					// 按天报价
					$(modalRootObj).find('#data_fprice_day').prop('checked', d.is_day == 1 ? true : false).trigger('change');
					$(modalRootObj).find('#data_fprice_day_min').val(d.min_day);
					$(modalRootObj).find('#data_fprice_day_max').val(d.max_day);
					// 按线路报价
					$(modalRootObj).find('#data_fprice_line').prop('checked', d.is_line == 1 ? true : false).trigger('change');
					setSelect2Value($(modalRootObj).find('#data_fprice_line_data'), d.line);
					// 备注
					$(modalRootObj).find('#data_fprice_beizhu').val(d.beizhu);
				}
			});
		}
	}
	
	// 价格类型被选择
	ModalFCJPrice.prototype.limitChanged = function(evt) {
		var rootObj = $(this).closest('#gallery-fcj-price-modal');
		var className = $(this).attr('name');
		if ($(this).prop('checked') ==  false) {
			$(rootObj).find('.'+className).addClass('hidden_ctrl');
		} else {
			$(rootObj).find('.'+className).removeClass('hidden_ctrl');
		}
	}
	
	// 确认添加/修改数据
	ModalFCJPrice.prototype.confirmPrice = function(e){
		if (e.data == null || e.data.obj == null) {
			console.log('未绑定对象，不能触发事件');
			return false;
		}
		var thisObj = e.data.obj;
		if (thisObj.obj_type == null || thisObj.obj_id == null || thisObj.item_id == null) {
			toastr.warning('保存价格的参数不足，可能缺少资源类型、资源对象、消费项其中的一项，所以价格不能保存');
			return false;
		}
		
		var date = $(thisObj.root).find('#data_fprice_time_limit').val();
		var dateList = date.split(' / ');
		var param = {
			'op_type': 'save',
			'obj_type': thisObj.obj_type,
			'obj_id': thisObj.obj_id,
			'item_id': thisObj.item_id,
			'id': thisObj.price_id,
			'is_rebate': $(thisObj.root).find('#data_fprice_rebate').prop('checked') ? 1 : 0,
			'title': $(thisObj.root).find('#data_fprice_title').val(),
			'price': $(thisObj.root).find('#data_fprice_price').val(),
//			'real_price': $(thisObj.root).find('#data_fprice_real_price').val(),
			'is_time': $(thisObj.root).find('#data_fprice_time').prop('checked') ? 1 : 0,
			'is_member': $(thisObj.root).find('#data_fprice_member').prop('checked') ? 1 : 0,
			'is_day': $(thisObj.root).find('#data_fprice_day').prop('checked') ? 1 : 0,
			'is_line': $(thisObj.root).find('#data_fprice_line').prop('checked') ? 1 : 0,
			'start_time': dateList[0],
			'end_time': dateList[1],
			'min_num': $(thisObj.root).find('#data_fprice_member_min').val(),
			'max_num': $(thisObj.root).find('#data_fprice_member_max').val(),
			'min_day': $(thisObj.root).find('#data_fprice_day_min').val(),
			'max_day': $(thisObj.root).find('#data_fprice_day_max').val(),
			'line': getSelect2Value($(thisObj.root).find('#data_fprice_line_data'),['id','title']),
			'beizhu': $(thisObj.root).find('#data_fprice_beizhu').val(),
		}
		
		var callbackFunc = thisObj.callbackFunc;
		var priceObj = thisObj.price_obj;
		$.post('<?php echo U("financial/price");?>', param, function(data){
			if (data.jumpUrl != null) {
				location.href = data.jumpUrl;
			}
			if (data.result != null) {
				if (data.extra_result != null) {
					if (data.result.errno != 0 && data.extra_result.errno != 0){
						toastr.error(data.result.message + '<br />' + data.extra_result.message);
						return false;	
					}
				} else {
					if (data.result.errno != 0){
						toastr.error(data.result.message);
						return false;	
					}	
				}
			}
			toastr.success('修改价格成功!!!');
			if (callbackFunc != 'undefined' && callbackFunc != null && typeof(callbackFunc) == 'function') {			
				callbackFunc(priceObj, data.ds, data.op);
			}
		});
		thisObj.hideModal();
	}
	
	ModalFCJPrice.prototype.hideModal = function() {
		this.clearPrice();
		$(this.root).modal('hide');
	}
	
	// 取消编辑项
	ModalFCJPrice.prototype.cancelPrice = function(e) {
		if (e.data == null || e.data.obj == null) {
			console.log('未绑定对象，不能触发事件');
			return false;
		}
		var thisObj = e.data.obj;
		thisObj.hideModal();
	}
	
</script><?php endif; ?> 
<?php if(!empty($modal_fcj_deposit)): ?><style type="text/css">
	table, thead, th, tbody, tr, td {text-align: center;}
</style>

<div class="modal fade custom-width" id="gallery-fcj-deposit-modal" data-backdrop="static">
	<div class="modal-dialog" style="width: 80%;">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">预算资金提交</h4>
			</div>
			
			<div class="modal-body">
				
				<div class="row edit_area">
					<div class="col-md-3">
						<div class="form-group">
							<label for="field-1" class="control-label">资源类型</label>	
							<input type="text" class="form-control" id="data_fdeposit_source_type">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="field-1" class="control-label">资源</label>	
							<input type="text" class="form-control" id="data_fdeposit_source_obj" placeholder="请选择资源">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="field-1" class="control-label">指定审批人</label>
							<input type="text" class="form-control" id="data_fdeposit_review_admin" placeholder="请指定审核人员">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="field-1" class="control-label">结算方式</label>
							<input type="text" class="form-control" id="data_fdeposit_pay_type" placeholder="请选择结算方式">
						</div>
					</div>
				</div>
			
				<div class="row edit_area">
					<div class="col-md-3">						
						<div class="form-group">
							<label for="field-1" class="control-label">收款人</label>							
							<input type="text" class="form-control" id="data_fdeposit_payee" placeholder="请输入收款人姓名">
						</div>						
					</div>
					
					<div class="col-md-3">						
						<div class="form-group">
							<label for="field-2" class="control-label">收款账号</label>							
							<input type="text" class="form-control" id="data_fdeposit_bank_card" placeholder="请输入收款人账号">
						</div>					
					</div>
					
					<div class="col-md-3">						
						<div class="form-group">
							<label for="field-2" class="control-label">减免金额</label>							
							<input type="number" class="form-control" id="data_fdeposit_derate" placeholder="请输入结算要减免的金额" value="0.00">
						</div>					
					</div>
					
					<div class="col-md-3">						
						<div class="form-group">
							<label for="field-2" class="control-label">审批金额</label>							
							<input type="number" class="form-control" id="data_fdeposit_approval_amount" placeholder="请输入此次要审批的金额" value="0.00">
						</div>					
					</div>
				</div>
			
				<div class="row edit_area">
					<div class="col-md-12">						
						<div class="form-group">
							<label for="field-3" class="control-label">开户银行与其他支付</label>							
							<input type="text" class="form-control" id="data_fdeposit_bank_address" placeholder="请输入开户行地址或者其他支付相关信息">
						</div>							
					</div>
				</div>
			
				<div class="row edit_area">
					<div class="col-md-12">
						<div class="form-group">
							<label for="field-3" class="control-label">提审备注</label>
							<input type="text" class="form-control" id="data_fdeposit_beizhu" placeholder="请输入此次提审预算资金审批的备注信息">
						</div>
					</div>
				</div>
				
				<div class="row">					
					<div class="col-md-12">						
						<table class="table table_budget_submit">
							<thead>
								<tr>
									<th style="width: 100px;">资源类型</th>
									<th style="width: 200px;">资源名称</th>
									<th style="width: 100px;">消费项</th>
									<th style="width: 60px;">数量</th>
									<th style="width: 500px;">价格</th>
									<th style="width: 80px;">预算类型</th>
									<th style="width: 110px;">总价</th>
									<th style="width: 500px;">备注</th>
									<th style="width: 110px;">提审状态</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>						
					</div>		
					<div class="col-md-12">
						<p style="float: right; text-align: right; /*border-top: 1px solid #eee; width: 300px;*/ padding-top: 10px;">
							<span style="font-size: 18px; margin-left: 20px;">预算金额：<b class="submit_budget_money" style="color: red;">0.00</b>元</span>
							<span style="font-size: 18px; margin-left: 20px;">减免金额：<b class="submit_derate_money" style="color: red;">0.00</b>元</span>
							<span style="font-size: 18px; margin-left: 20px;">提审金额：<b class="submit_approval_money" style="color: red;">0.00</b>元</span>
							<span style="font-size: 18px; margin-left: 20px;">已交易金额：<b class="submit_complated_money" style="color: red;">0.00</b>元</span>
							<span style="font-size: 18px; margin-left: 20px;">最终预算：<b class="submit_confirm_money" style="color: red;">0.00</b>元</span>
						</p>
					</div>				
				</div>
				
				<!--<div class="row">		
				</div-->
				
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-info edit_area btn_fdeposit_submit">提审预算</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	// select2 对象	
	var select2FDepositSourceType = null;
	var select2FDepositSourceObj = null;
	
	// 切换资源类型
	function changeFDepositSourceType(ev) {
		setSelect2Value($('#data_fdeposit_source_obj'), null);
		if (select2FDepositSourceObj != null) {
			var typestr = getSelect2Value($('#data_fdeposit_source_type'));				
			if (typestr != {} && typestr != '') {
				var type = $.parseJSON(typestr);
				if (type.type_key.indexOf('insurance') != -1) {
					select2FDepositSourceObj.ds.tab = 'cj_insurance';
				} else if (type.type_key.indexOf('leader') != -1) {
					select2FDepositSourceObj.ds.tab = 'cj_leader';
				} else if (type.type_key.indexOf('hotel') != -1) {
					select2FDepositSourceObj.ds.tab = 'cj_hotel';
				} else if (type.type_key.indexOf('driver') != -1) {
					select2FDepositSourceObj.ds.tab = 'cj_driver';
				} else if (type.type_key.indexOf('bus') != -1) {
					select2FDepositSourceObj.ds.tab = 'cj_bus';
				} else if (type.type_key.indexOf('view') != -1) {
					select2FDepositSourceObj.ds.tab = 'cj_view';
				} else if (type.type_key.indexOf('agency') != -1) {
					select2FDepositSourceObj.ds.tab = 'cj_agency';
				} else {
					select2FDepositSourceObj.ds.tab = 'cj_source';
				}
			}
		}
	}
	
	// 初始化资源类型
	function initFDepositSourceType() {											
		var voption = {obj:$('#data_fdeposit_source_type'), search:1, placeholder: '请选择资源类型', show_col:'type_desc', select_col:'type_desc', func_select_changed:changeFDepositSourceType};
		var vds = {tab:'type_data', search_col: 'type_desc', cdsstr: 'type_key|LIKE|cj_source_obj_%', cdtype:3, sort:'sort|asc'}
		select2FDepositSourceType = new MySelect2(voption, vds);
	}
	
	// 显示选择资源文本
	function fdepositSourceObjShowText(ds) {
		if (select2FDepositSourceObj == null) {
			return '未初始化资源下拉框';
		}
		
		if (ds.show_name != null) {
			return ds.show_name;
		}
		
		var vtab = select2FDepositSourceObj.ds.tab;
		if (vtab.indexOf('insurance') != -1) {
			return ds.name;
		} else if (vtab.indexOf('leader') != -1) {
			if (ds.name != null && ds.name != '') {
				return ds.name;
			} else if (ds.nickname != null && ds.nickname != '') {
				return ds.nickname;
			}else if (ds.stagename != null && ds.stagename != '') {
				return ds.stagename;
			}
		} else if (vtab.indexOf('hotel') != -1) {
			return ds.name+'['+ds.city+']';
		} else if (vtab.indexOf('driver') != -1) {
			return ds.name;
		} else if (vtab.indexOf('bus') != -1) {
			return ds.seat+'座'+ds.bus_log+'['+ds.name+']';
		} else if (vtab.indexOf('view') != -1) {
			return ds.name+'['+ds.city+']['+ds.province+']';
		} else if (vtab.indexOf('agency') != -1) {
			var type = '';
			if (ds.agency_type != '' && ds.agency_type != null && ds.agency_type != '{}'){
				var typeObj = $.parseJSON(ds.agency_type);
				type = typeObj.type_desc;
			} 
			return ds.name+'['+type+']';
		} else {
			return ds.name;
		}
	}
	
	// 改变资源对象
	function changeFDepositSourceObj() {
		var objstr = getSelect2Value($('#data_fdeposit_source_obj'),['id', 'payee', 'bank_card', 'bank_address']);
//		console.log(objstr);
		if (objstr != null && objstr != '') {
			var obj = $.parseJSON(objstr);
			$('#data_fdeposit_payee').val(obj.payee);
			$('#data_fdeposit_bank_card').val(obj.bank_card);
			$('#data_fdeposit_bank_address').val(obj.bank_address);			
		}		
	}
	
	// 初始化资源
	function initFDepositSourceObj() {				
		var voption = {obj:$('#data_fdeposit_source_obj'), search:1, placeholder: '请选择资源', show_col:fdepositSourceObjShowText, select_col:fdepositSourceObjShowText, func_select_changed:changeFDepositSourceObj};
		var vds = {tab:'cj_leader', search_col: 'name', cdsstr: 'invalid|=|0|AND', cdtype:4}
		select2FDepositSourceObj = new MySelect2(voption, vds);
	}
	
	// 初始化审批管理员
	function initFDepositReviewAdmin() {
		bindAdminDropMenu($('#data_fdeposit_review_admin'), '', '点击选择审批管理员或者输入关键字查询');
	}
	
	// 初始化结算类型
	function initFDepositPayType() {
		bindTypeDataDropMenu($('#data_fdeposit_pay_type'), 'cj_pay_type', '选择结算类型');	
	}
	
	$(document).ready(function(){
		initFDepositSourceType();
		initFDepositSourceObj();	
		initFDepositReviewAdmin();
		initFDepositPayType();
	});
	
	function ModalFCJDeposit() {
		this.root = $('#gallery-fcj-deposit-modal');
		
		this.obj = null;
		this.team_id = null;
		this.ids = null;
		this.review_id = null;
		this.callbackFunc = null;
		this.money = null;
		this.review_data = null;
		
		// 绑定取消事件
		$(this.root).find('.btn-fitem-close').bind('click', {obj:this}, this.cancelItem);
		// 绑定费用减免事件
		$(this.root).find('#data_fdeposit_derate').bind('blur', {obj:this}, this.derateMoney);
		// 绑定审批金额事件
		$(this.root).find('#data_fdeposit_approval_amount').bind('blur', {obj:this}, this.approvalAmountMoney);		
	}
	
	// showMode: 展示模式(0:编辑模式，1:查看模式，默认：0)
	ModalFCJDeposit.prototype.showModal = function(vobj, teamId, ids, reviewId, confirmCallBack, showMode){
		// 隐藏编辑区域
		if (showMode != null && showMode == 1) {
			$(this.root).find('.edit_area').addClass('hidden_ctrl');
		} else {
			$(this.root).find('.edit_area').removeClass('hidden_ctrl');
		}
		
		if (this.obj = vobj || this.team_id != teamId || this.ids != ids || this.review_id != reviewId || this.callbackFunc != confirmCallBack) {
			// 清除之前的信息
			this.clearItem();
			
			this.obj = vobj;
			this.team_id = teamId;
			this.ids = ids;
			this.review_id = reviewId;
			this.callbackFunc = confirmCallBack;
			// 填充价格项数据
			this.fillItem();	
					
			// 绑定确认事件
			$(this.root).find('.btn_fdeposit_submit').unbind();
			$(this.root).find('.btn_fdeposit_submit').bind('click', {obj:this}, this.confirmItem);
		}
		
		// 显示面板
		$(this.root).modal('show');	
	}
	
	ModalFCJDeposit.prototype.clearItem = function (){
		setSelect2Value('#data_fdeposit_source_type', null);
		setSelect2Value('#data_fdeposit_source_obj', null);
		setSelect2Value('#data_fdeposit_pay_type', null);
		$('#data_fdeposit_payee').val('');		
		$('#data_fdeposit_bank_card').val('');	
		$('#data_fdeposit_derate').val('0.00');	
		$('#data_fdeposit_approval_amount').val('0.00');	
		$('#data_fdeposit_bank_address').val('');
		$('#data_fdeposit_beizhu').val('');
		$('.table_budget_submit').find('tbody').children().remove();		
		$('.submit_budget_money').html('0.00');		// 预算金额
		$('.submit_derate_money').html('0.00');		// 减免金额
		$('.submit_approval_amount').html('0.00');	// 提审金额
		$('.submit_complated_money').html('0.00');	// 已完成金额
		$('.submit_confirm_money').html('0.00');	// 最终预算金额
			
		this.obj = null;
		this.team_id = null;
		this.ids = null;
		this.review_id = null;
		this.callbackFunc = null;
		this.money = null;
		this.review_data = null;
					
		var modalRootObj = this.root;
	}
	
	ModalFCJDeposit.prototype.fillItem = function() {
		var jsonData = {
			op_type: 'source', 
			op:'find',
			find_all: 1,			
		}
		
		var firstSubmit = null;
		if (this.ids != null && this.ids != '') {
			jsonData['cdsstr'] = 'id|IN|('+this.ids+')|AND';
			jsonData['cdtype'] = 4;
			firstSubmit = true;
		}
		
		if (this.review_id != null && this.review_id != '') {
			jsonData['review_id'] = this.review_id;
			firstSubmit = true;
		}		
						
		setSelect2Value('#data_fdeposit_review_admin', '{"id":"85","account":"郭煜","show_name":"郭煜"}');	
		setSelect2Value('#data_fdeposit_pay_type', '{"id":"914","type_key":"cj_pay_type_cash","type_desc":"现结"}');	
		if (firstSubmit == null || this.team_id == null) {
			this.hideModal();
			return false;
		}
				
		var thisObj = this;
		$.post('<?php echo U("financial/team");?>', jsonData, function(data){
			if (data.ds != null) {			
				var modalRootObj = thisObj.root;
				var fill = false;
				var budgetCash = 0.00, approvalAmount = 0.00;
				if (data.sum_money != null) {
					$('.submit_budget_money').html(data.sum_money);	
					budgetCash = parseFloat(data.sum_money);
					approvalAmount = budgetCash;
					thisObj.money = data.sum_money;		
				}
				for (var i=0; i < data.ds.length; i ++) {							
					var d = data.ds[i];										
					if (d.review_data != null && fill == false) {
						fill = true;
						var r = d.review_data;
						thisObj.review_data = d.review_data;
						setSelect2Value('#data_fdeposit_source_type', r.obj_type);
						if (r.obj_data != null) {
//							console.log(JSON.stringify(r.obj_data))
							setSelect2Value('#data_fdeposit_source_obj', JSON.stringify(r.obj_data));	
						}
						setSelect2Value('#data_fdeposit_review_admin', r.review_admin);	
						setSelect2Value('#data_fdeposit_pay_type', r.pay_type);	
						console.log(r.review_admin);
						$('#data_fdeposit_payee').val(r.payee);
						$('#data_fdeposit_bank_card').val(r.bank_card);
						$('#data_fdeposit_bank_address').val(r.bank_address);
						$('#data_fdeposit_derate').val(r.derate);
						$('#data_fdeposit_beizhu').val(r.beizhu);					
						$('.submit_derate_money').html(r.derate);
						// 最终预算金额
						budgetCash = budgetCash - parseFloat(r.derate);
						if (r.approval_amount != null && parseFloat(r.approval_amount) > 0) {
							approvalAmount = r.approval_amount	
						} else {
							approvalAmount = budgetCash - approvalAmount(r.complated_money);
						}
						// 已经完成审批的金额
						$('.submit_complated_money').html(r.complated_money);
					}
					
					
					var sourceType = 'other', sourceTypeId = 0, sourceTypeDesc = '未知资源';
					if (d.obj_type_data != null) {
						sourceTypeId = d.obj_type_data.id;
						typeKey = d.obj_type_data.type_key;	
						var basetypestr = 'cj_source_obj_';
						sourceType = typeKey.substr(basetypestr.length);
						sourceTypeDesc = d.obj_type_data.type_desc;
					}				
					
					var obj_show_text = d.obj_data != null ? d.obj_data.show_name : '';
					var item_name = d.item_data != null ? d.item_data.name : '';
					var price_show_text = d.price_data != null ? d.price_data.show_name : '';
					var recycle_text = d.item_data.is_recycle > 0 ? d.recycle : '不可回收资源';
					var review_text = d.review_data != null ? d.review_data.review_type_data.type_desc : '未提审';
					var vhtml = '<tr class="source" data-id="'+d.id+'" data-type="'+sourceType+'" data-review-id="'+d.review_id+'">';
						vhtml +='	<td class="source_type" data-obj-type-id="'+sourceTypeId+'">'+sourceTypeDesc+'</td>';
						vhtml +='	<td class="source data-obj-id="'+d.obj_id+'">'+obj_show_text+'</td>';
						vhtml +='	<td class="source_item">'+item_name+'</td>';
						vhtml +='	<td class="source_num">'+d.num+'</td>';
						vhtml +='	<td class="source_price">'+price_show_text+'</td>';
						vhtml +='	<td class="source_money_type">'+d.money_type+'</td>';
						vhtml +='	<td class="source_money">'+d.money+'</td>';
						vhtml +='	<td class="source_beizhu">'+d.beizhu+'</td>';
						vhtml +='	<td class="source_review">'+review_text+'</td>';
						vhtml +='</tr>';
					$(thisObj.root).find('.table_budget_submit').find('tbody').append(vhtml);
				}	
				// 最终预算金额
				$('.submit_confirm_money').html(budgetCash);
				// 本次提审金额
				$('#data_fdeposit_approval_amount').val(approvalAmount);
				$('.submit_approval_money').html(approvalAmount);
			} else {
				toastr.error('未能找到提审资源预算信息');
			}
		});
	}
	
	// 减免费用
	ModalFCJDeposit.prototype.derateMoney = function(e){
		if (e.data == null || e.data.obj == null) {
			console.log('未绑定对象，不能触发事件');
			return false;
		}
		$('.submit_derate_money').html($(this).val());
		if (e.data.obj.money != null) {				
			$('.submit_confirm_money').html(e.data.obj.money-$(this).val());
		} else {
			$('.submit_confirm_money').html(0-$(this).val());
		}		
	}
	
	// 审批金额
	ModalFCJDeposit.prototype.approvalAmountMoney = function(e) {
		if (e.data == null || e.data.obj == null) {
			console.log('未绑定对象，不能触发事件');
			return false;
		}
		
		var approvalAmount = parseInt($(this).val());
		$('.submit_approval_money').html(approvalAmount);
	}
	
	
	// 确认添加/修改数据
	ModalFCJDeposit.prototype.confirmItem = function(e){
		if (e.data == null || e.data.obj == null) {
			console.log('未绑定对象，不能触发事件');
			return false;
		}
		
		if (e.data.obj.ids == null && e.data.obj.review_id == null) {
			toastr.warning('您未选择任何资源预算');
			return false;
		}
		
		var srctypstr = getSelect2Value('#data_fdeposit_source_type');
		var srcobjstr = getSelect2Value('#data_fdeposit_source_obj', ['id','pay_type']);		
		var adminstr = getSelect2Value($('#data_fdeposit_review_admin'), ['id', 'account', 'nickname']);
		if (srctypstr == '' || srcobjstr == '' || adminstr == '') {
			toastr.warning('入账的资源对象或是审批审批人员未设置');
			return false;
		}
		srcobjstr = srcobjstr.replace(/"\{/g,'{').replace(/}"/g, '}');
		console.log(srcobjstr);
		var srcObj = JSON.parse(srcobjstr);
					
		if (e.data.obj.review_data != null) {
			if (srctypstr != e.data.obj.review_data.obj_type || srcObj.id != e.data.obj.review_data.obj_id) {
				toastr.warning('您所提交的审批信息【资源类型】【资源对象】与上一次提交的并非同一资源，请确认后再次提交');
				return false;
			}
		}
		
		// 支付类型
		var paytypestr = getSelect2Value('#data_fdeposit_pay_type');		
					
		var jsonData = {
			op_type: 'request_money',
			obj_type: srctypstr,
			obj_id: srcObj.id,
			team_id: e.data.obj.team_id,
			ids: e.data.obj.ids,
			review_id: e.data.obj.review_id,
			money: e.data.obj.money,
			derate: $('#data_fdeposit_derate').val(),
			approval_amount: $('#data_fdeposit_approval_amount').val(),
			pay_type: paytypestr, //JSON.stringify(srcObj.pay_type),
			payee: $('#data_fdeposit_payee').val(),
			bank_card: $('#data_fdeposit_bank_card').val(),
			bank_address: $('#data_fdeposit_bank_address').val(),
			beizhu: $('#data_fdeposit_beizhu').val(),
		}
		var admin = $.parseJSON(adminstr);
		admin['show_name'] = admin.nickname != '' && admin.nickname != 'undefined' ? admin.nickname : admin.account;
		jsonData['review_admin'] = JSON.stringify(admin);
		
		// 检测提审金额是否合法
		var approvalAmount = parseInt($('#data_fdeposit_approval_amount').val());
		var derate = parseInt($('#data_fdeposit_derate').val());
		var complated = parseInt($('.submit_complated_money').html());
		var finalApproval = e.data.obj.money - derate - complated;
		if (finalApproval < approvalAmount) {
			toastr.warning('提审金额，不能大于最终预算金额')
			return false;
		}
		
		$.post('<?php echo U("financial/team");?>', jsonData, function(data){
			if (data.result != null) {
				if (data.result.errno != 0){
					toastr.error(data.result.message);
					return false;	
				}
			}
			
			if (data.jumpUrl != null){
				location.href = data.jumpUrl;
				return false;
			}
			
			toastr.success('提交资源预算资金审批成功!!!');
			if (e.data.obj.callbackFunc != 'undefined' && e.data.obj.callbackFunc != null && typeof(e.data.obj.callbackFunc) == 'function') {				
				console.log('通知提交审核成功，'+JSON.stringify(data.ds));
				e.data.obj.callbackFunc(e.data.obj.obj, data);
			}			
			e.data.obj.hideModal();
		});
	}
	
	ModalFCJDeposit.prototype.hideModal = function() {
		this.clearItem();
		$(this.root).modal('hide');
	}
	
	// 取消编辑项
	ModalFCJDeposit.prototype.cancelItem = function(e) {
		if (e.data == null || e.data.obj == null) {
			console.log('未绑定对象，不能触发事件');
			return false;
		}
		e.data.obj.hideModal();
	}
</script><?php endif; ?> 

	<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
		<!--菜单-->
				<!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
		<!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
		<!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
		<div class="sidebar-menu toggle-others collapsed">
			
			<div class="sidebar-menu-inner">	
				
				<header class="logo-env" style="z-index: -1; height: 50px;">
					
					<!-- logo -->
					<div class="logo">
						<a href="http://kllife.com/back" class="logo-expanded">
							<img src="/source/Static/assets/images/logo.png" width="80" alt="" />
						</a>
						
						<a href="http://kllife.com/back" class="logo-collapsed">
							<img src="/source/Static/assets/images/logo.png" width="40" alt="" />
						</a>
					</div>
					
					<!-- This will toggle the mobile menu and will be visible only on mobile devices -->
					<div class="mobile-menu-toggle visible-xs">
						<a href="http://kllife.com/back" data-toggle="user-info-menu">
							<i class="fa-bell-o"></i>
							<span class="badge badge-success">7</span>
						</a>
						
						<a href="http://kllife.com/back" data-toggle="mobile-menu">
							<i class="fa-bars"></i>
						</a>
					</div>
					
					<!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
					<!--<div class="settings-icon">
						<a href="#" data-toggle="settings-pane" data-animate="true">
							<i class="linecons-cog"></i>
						</a>
					</div>-->		
								
				</header>
						
				
						
				<ul id="main-menu" class="main-menu">
					<!-- add class "multiple-expanded" to allow multiple submenus to open -->
					<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
					<li <?php echo C('MENU_ACTIVE')=='home' ? 'class="active opened"' : '';?>><!-- class="active opened"-->
						<a href="http://kllife.com/back">
							<i class="fa-home"><!--<i class="linecons-cog">--></i>
							<span class="title">后台首页</span>
						</a>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='admin' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="el-user"></i>
							<span class="title">管理员</span>
						</a>
						<ul>
							<?php if(check_grant('list_account') == true): ?><li <?php echo C('MENU_CURRENT')=='admin_acct_list' ? 'class="active"' : '';?>>
									<a href="<?php echo U('admin/list');?>"><span class="title">账号管理</span></a>
								</li><?php endif; ?>
							<?php if($admin['account'] === 'admin'): ?><li <?php echo C('MENU_CURRENT')=='admin_station_list' ? 'class="active"' : '';?>>
									<a href="<?php echo U('admin/station');?>"><span class="title">站点管理</span></a>
								</li><?php endif; ?>
							<?php if($admin['account'] === 'admin'): ?><li <?php echo C('MENU_CURRENT')=='account_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=account_type');?>"><span class="title">账户类型</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_admin_type') == true): ?><li <?php echo C('MENU_CURRENT')=='admin_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=admin_type');?>"><span class="title">管理员类型</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_grant') == true and $admin['account'] === 'admin'): ?><li <?php echo C('MENU_CURRENT')=='admin_grant' ? 'class="active"' : '';?>>
									<a href="<?php echo U('grant/list');?>"><span class="title">权限管理</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_grant_group') == true and $admin['account'] === 'admin'): ?><li <?php echo C('MENU_CURRENT')=='admin_grant_group' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=admin_grant_group');?>"><span class="title">权限组管理</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_grant_type') == true and $admin['account'] === 'admin'): ?><li <?php echo C('MENU_CURRENT')=='admin_grant_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=admin_grant_type');?>"><span class="title">权限类型管理</span></a>
								</li><?php endif; ?>
						</ul>
					</li>
					<?php if($line_system == true or $admin['account'] == 'admin'): ?><li <?php echo C('MENU_ACTIVE')=='line' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="fa-th"></i>
							<span class="title">产品管理</span>
						</a>
						<ul>
							<li <?php echo C('MENU_CURRENT')=='line_list' ? 'class="active"' : '';?>>
								<a href="<?php echo U('line/list');?>"><span class="title">产品列表</span></a>
							</li>
							<?php if(check_grant('line_edit') == true): ?><li <?php echo C('MENU_CURRENT')=='line_create' ? 'class="active"' : '';?>>
									<a href="<?php echo U('line/create');?>"><span class="title">产品生成</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('line_subject') == true and $admin['station_id_data']['attached'] === '1'): ?><li <?php echo C('MENU_CURRENT')=='line_subject' ? 'class="active"' : '';?>>
									<a href="<?php echo U('line/subject');?>"><span class="title">产品专题</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('question_system') == true and $admin['station_id_data']['attached'] === '1'): ?><li <?php echo C('MENU_CURRENT')=='line_question' ? 'class="active"' : '';?>>
									<a href="<?php echo U('line/question');?>"><span class="title">问题系统</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('article_system') == true and $admin['station_id_data']['attached'] === '1'): ?><li <?php echo C('MENU_CURRENT')=='line_article' ? 'class="active"' : '';?>>
									<a href="<?php echo U('line/article');?>/type/list"><span class="title">文章系统</span></a>
								</li><?php endif; ?>
							<!--<li <?php echo C('MENU_CURRENT')=='line_leader' ? 'class="active"' : '';?>>
								<a href="<?php echo U('line/leader');?>/type/list"><span class="title">领队系统</span></a>
							</li>-->
							<?php if(check_grant('video_center') == true and $admin['station_id_data']['attached'] === '1'): ?><li <?php echo C('MENU_CURRENT')=='line_video' ? 'class="active"' : '';?>>
									<a href="<?php echo U('line/video');?>"><span class="title">视频中心</span></a>
								</li><?php endif; ?>
							
							<li <?php echo C('MENU_CURRENT')=='line_taocan' ? 'class="active"' : '';?>>
								<a href="<?php echo U('line/taocan');?>"><span class="title">套餐系统</span></a>
							</li>
						</ul>
					</li><?php endif; ?>
					<?php if(check_grant('user_center') == true and $admin['account'] === 'admin'): ?><li <?php echo C('MENU_ACTIVE')=='user' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="fa-users"></i>
							<span class="title">用户中心</span>
						</a>
						<ul>
							<li <?php echo C('MENU_CURRENT')=='user_center' ? 'class="active"' : '';?>>
								<a href="<?php echo U('user/center');?>"><span class="title">用户中心</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='user_distribute' ? 'class="active"' : '';?>>
								<a href="<?php echo U('user/distribute');?>"><span class="title">分销用户</span></a>
							</li>
							<?php if(check_grant('user_coupon') == true): ?><li <?php echo C('MENU_CURRENT')=='user_coupon' ? 'class="active"' : '';?>>
									<a href="<?php echo U('user/coupon');?>"><span class="title">优惠券</span></a>
								</li><?php endif; ?>
						</ul>
					</li><?php endif; ?>
					<li <?php echo C('MENU_ACTIVE')=='order' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="fa-tty"></i>
							<span class="title">订单管理</span>
						</a>
						<ul>
							<?php if(check_grant('list_order') == true): ?><li <?php echo C('MENU_CURRENT')=='order_list' ? 'class="active"' : '';?>>
									<a href="<?php echo U('order/list', 'obj=order_list');?>"><span class="title">订单列表</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_order') == true and $admin['account'] === 'admin'): ?><li <?php echo C('MENU_CURRENT')=='order_list1' ? 'class="active"' : '';?>>
									<a href="<?php echo U('order/list', 'test=1');?>"><span class="title">订单列表1</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('create_order') == true): ?><li <?php echo C('MENU_CURRENT')=='order_create' ? 'class="active"' : '';?>>
									<a href="<?php echo U('order/info', 'obj=order_create');?>"><span class="title">线下报名</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('create_order') == true): ?><li <?php echo C('MENU_CURRENT')=='order_channel' ? 'class="active"' : '';?>>
									<a href="<?php echo U('order/info', 'ch=1');?>"><span class="title">渠道订单</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('order_robot') == true and $admin['station_id_data']['attached'] === '1'): ?><li <?php echo C('MENU_CURRENT')=='order_robot' ? 'class="active"' : '';?>>
									<a href="<?php echo U('order/robot', 'obj=order_robot');?>"><span class="title">人气报名</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_order_from') == true and $admin['station_id_data']['attached'] === '1'): ?><li <?php echo C('MENU_CURRENT')=='order_from' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=order_from');?>"><span class="title">订单来源</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_state_type') == true and $admin['account'] === 'admin'): ?><li <?php echo C('MENU_CURRENT')=='state_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=state_type');?>"><span class="title">状态类型</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_order_state') == true): ?><li <?php echo C('MENU_CURRENT')=='order_state' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=order_state');?>"><span class="title">订单状态</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_member_type') == true): ?><li <?php echo C('MENU_CURRENT')=='order_member_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=order_member_type');?>"><span class="title">人员类型</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_certificate_type') == true): ?><li <?php echo C('MENU_CURRENT')=='order_certificate_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=order_certificate_type');?>"><span class="title">证件类型</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_coupon_type') == true and $admin['account'] === 'admin'): ?><li <?php echo C('MENU_CURRENT')=='order_coupon_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=order_coupon_type');?>"><span class="title">优惠券类型</span></a>
								</li><?php endif; ?>
							<!--<li <?php echo C('MENU_CURRENT')=='order_import' ? 'class="active"' : '';?>>
								<a href="#"><span class="title">订单导入</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='order_export' ? 'class="active"' : '';?>>
								<a href="#"><span class="title">订单导出</span></a>
							</li>-->
						</ul>
					</li>
					<script type="text/javascript">
						$(document).ready(function(){
//							$.post('<?php echo U("review/getWaitReview");?>',{},function(data){
////								console.log('getWaitReview=>'+JSON.stringify(data));
//								if (data.result.errno != 0) {
//									alert(data.result.message);
//								} else {
//									$('#review_sum').html(data.review_sum);
//									$('#review_account').html(data.review_account);
//									$('#review_change_line').html(data.change_line);
//									$('#review_member_count').html(data.member_count);
//									$('#review_exit_team').html(data.exit_team);
//								}
//							})
						});
					</script>
					<li <?php echo C('MENU_ACTIVE')=='review' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="fa-dollar"></i>
							<span class="title">审核管理</span>
							<?php if(check_grant('list_order_review') == true and $admin['station_id_data']['attached'] === '1'): ?><span id="review_sum" class="badge badge-purple">0</span><?php endif; ?>
						</a>
						<ul>
							<?php if(check_grant('list_order_review') == true and $admin['station_id_data']['attached'] === '1'): ?><li <?php echo C('MENU_CURRENT')=='review_list' ? 'class="active"' : '';?>>
									<a href="<?php echo U('review/list');?>">
										<span class="title">审核查询</span>
										<span id="review_account" class="badge badge-purple">0</span>
									</a>
								</li><?php endif; ?>
							<!--<?php if(check_grant('submit_finance_review') == true): ?><li <?php echo C('MENU_CURRENT')=='review_request' ? 'class="active"' : '';?>>
									<a href="<?php echo U('review/request');?>"><span class="title">审核请求</span></a>
								</li><?php endif; ?>-->
							<?php if(check_grant('list_online_pay') == true): ?><li <?php echo C('MENU_CURRENT')=='pay_log_online' ? 'class="active"' : '';?>>
									<a href="<?php echo U('review/payonline');?>">
										<span class="title">线上支付</span>
									</a>
								</li><?php endif; ?>
							<?php if(check_grant('list_order_review') == true and $admin['station_id_data']['attached'] === '1'): ?><li <?php echo C('MENU_CURRENT')=='change_line' ? 'class="active"' : '';?>>
									<a href="<?php echo U('review/changeLine');?>">
										<span class="title">改团审核</span>
										<span id="review_change_line" class="badge badge-purple">0</span>
									</a>
								</li><?php endif; ?>
							<?php if(check_grant('list_order_review') == true and $admin['station_id_data']['attached'] === '1'): ?><li <?php echo C('MENU_CURRENT')=='change_count' ? 'class="active"' : '';?>>
									<a href="<?php echo U('review/changeCount');?>">
										<span class="title">人数审核</span>
										<span id="review_member_count" class="badge badge-purple">0</span>
									</a>
								</li><?php endif; ?>
							<?php if(check_grant('list_order_review') == true and $admin['station_id_data']['attached'] === '1'): ?><li <?php echo C('MENU_CURRENT')=='exit_team' ? 'class="active"' : '';?>>
									<a href="<?php echo U('review/exitTeam');?>">
										<span class="title">退团审核</span>
										<span id="review_exit_team" class="badge badge-purple">0</span>
									</a>
								</li><?php endif; ?>
							<?php if(check_grant('list_order_review') == true and $admin['station_id_data']['key'] === 'main'): ?><li <?php echo C('MENU_CURRENT')=='take_cash' ? 'class="active"' : '';?>>
									<a href="<?php echo U('review/takecash');?>">
										<span class="title">提现审核</span>
										<span id="review_take_cash" class="badge badge-purple">0</span>
									</a>
								</li><?php endif; ?>
							<?php if(check_grant('list_review_type') == true and $admin['account'] === 'admin'): ?><li <?php echo C('MENU_CURRENT')=='review_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=review_type');?>"><span class="title">审核状态</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_cash_use') == true and $admin['account'] === 'admin'): ?><li <?php echo C('MENU_CURRENT')=='review_cash_use' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=review_cash_use');?>"><span class="title">费用用途</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_cash_function') == true and $admin['account'] === 'admin'): ?><li <?php echo C('MENU_CURRENT')=='review_cash_function' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=review_cash_function');?>"><span class="title">费用功能</span></a>
								</li><?php endif; ?>
						</ul>
					</li>
					<li <?php echo stripos(C('MENU_CURRENT'), 'financial') === false ? '' : 'class="active opened"';?>>
						<a href="javascript:;">
							<i class="fa-cny"></i>
							<span class="title">财务计调</span>
						</a>
						<ul>							
							<li <?php echo stripos(C('MENU_CURRENT'), 'financial_team') === false ? '' : 'class="active opened"';?>>
								<a href="<?php echo U('type/list');?>"><span class="title">团期管理</span></a>
								<ul>
									<li <?php echo stripos(C('MENU_CURRENT'), 'financial_team_list') === false ? '' : 'class="active opened"';?>>
										<a href="<?php echo U('financial/team', 'op=list');?>"><span class="title">团期列表</span></a>
									</li>
									<li <?php echo stripos(C('MENU_CURRENT'), 'financial_team_new') === false ? '' : 'class="active"';?>>
										<a href="<?php echo U('financial/team', 'op=new');?>"><span class="title">创建团期</span></a>
									</li>
								</ul>
							</li>				
							<li <?php echo stripos(C('MENU_CURRENT'), 'financial_review') === false ? '' : 'class="active opened"';?>>
								<a href="<?php echo U('type/list');?>"><span class="title">审核管理</span></a>
								<ul>
									<li <?php echo stripos(C('MENU_CURRENT'), 'financial_review_commit') === false ? '' : 'class="active"';?>>
										<a href="<?php echo U('financial/deposit', 'op=new');?>"><span class="title">预交金提审</span></a>
									</li>
									<li <?php echo stripos(C('MENU_CURRENT'), 'financial_review_deposit') === false ? '' : 'class="active"';?>>
										<a href="<?php echo U('financial/deposit', 'op=list');?>"><span class="title">预交金审核</span></a>
									</li>
									<li <?php echo stripos(C('MENU_CURRENT'), 'financial_review_price') === false ? '' : 'class="active"';?>>
										<a href="<?php echo U('financial/price', 'op=review');?>"><span class="title">资源价审核</span></a>
									</li>
								</ul>
							</li>
							
							<li <?php echo stripos(C('MENU_CURRENT'), 'financial_resource') === false ? '' : 'class="active opened"';?>>
								<a href="javascript:;"><span class="title">资源录入</span></a>
								<ul>
									<li <?php echo stripos(C('MENU_CURRENT'), 'financial_resource_insurance') === false ? '' : 'class="active opened"';?>>
										<a href="<?php echo U('financial/source', 'src=insurance');?>"><span class="title">保险资源</span></a>
									</li>
									<li <?php echo stripos(C('MENU_CURRENT'), 'financial_resource_leader') === false ? '' : 'class="active"';?>>
										<a href="<?php echo U('financial/source', 'src=leader');?>"><span class="title">领队资源</span></a>
									</li>
									<li <?php echo stripos(C('MENU_CURRENT'), 'financial_resource_hotel') === false ? '' : 'class="active"';?>>
										<a href="<?php echo U('financial/source', 'src=hotel');?>"><span class="title">酒店资源</span></a>
									</li>
									<li <?php echo stripos(C('MENU_CURRENT'), 'financial_resource_driver') === false ? '' : 'class="active"';?>>
										<a href="<?php echo U('financial/source', 'src=driver');?>"><span class="title">司机资源</span></a>
									</li>
									<li <?php echo stripos(C('MENU_CURRENT'), 'financial_resource_bus') === false ? '' : 'class="active"';?>>
										<a href="<?php echo U('financial/source', 'src=bus');?>"><span class="title">大巴资源</span></a>
									</li>
									<li <?php echo stripos(C('MENU_CURRENT'), 'financial_resource_view') === false ? '' : 'class="active"';?>>
										<a href="<?php echo U('financial/source', 'src=view');?>"><span class="title">景点资源</span></a>
									</li>
									<li <?php echo stripos(C('MENU_CURRENT'), 'financial_resource_agency') === false ? '' : 'class="active"';?>>
										<a href="<?php echo U('financial/source', 'src=agency');?>"><span class="title">同行地接</span></a>
									</li>
									<li <?php echo stripos(C('MENU_CURRENT'), 'financial_resource_source') === false ? '' : 'class="active"';?>>
										<a href="<?php echo U('financial/source', 'src=source');?>"><span class="title">其他资源</span></a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<script type="text/javascript">
//						$(document).ready(function(){
//							$.post('<?php echo U("team/getWaitDispose");?>',{},function(data){
////								console.log('getWaitDispose=>'+JSON.stringify(data));
//								$('#team_assign_count').html(data.assign_count);
//								$('#team_dispose_count').html(data.dispose_count);
//							})
//						});
					</script>
					<li <?php echo C('MENU_ACTIVE')=='team_group' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="el-flag"></i>
							<span class="title">小包团</span>
							<?php if(check_grant('list_team_group') == true and $admin['station_id_data']['attached'] === '1'): ?><span id="team_assign_count" class="badge badge-purple">0</span><?php endif; ?>
						</a>
						<ul>
							<?php if(check_grant('list_team_group') == true and $admin['station_id_data']['attached'] === '1'): ?><li <?php echo C('MENU_CURRENT')=='list' ? 'class="active"' : '';?>>
									<a href="<?php echo U('team/list');?>">
										<span class="title">包团列表</span>
										<span id="team_dispose_count" class="badge badge-green">0</span>
									</a>									
								</li><?php endif; ?>
                
			                <?php if(check_grant('create_team_group') == true and $admin['station_id_data']['attached'] === '1'): ?><li <?php echo C('MENU_CURRENT')=='create' ? 'class="active"' : '';?>>
									<a href="<?php echo U('team/create');?>"><span class="title">创建包团</span></a>									
								</li><?php endif; ?>
						</ul>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='statistics' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="fa-bar-chart"></i>
							<span class="title">数据统计</span>
						</a>
						<ul>
							<li <?php echo C('MENU_CURRENT')=='statistics_order' ? 'class="active"' : '';?>>
								<a href="<?php echo U('statistics/order');?>"><span class="title">订单统计</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='statistics_line' ? 'class="active"' : '';?>>
								<a href="<?php echo U('statistics/line');?>"><span class="title">报名统计</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='statistics_pay' ? 'class="active"' : '';?>>
								<a href="<?php echo U('statistics/pay');?>"><span class="title">支付统计</span></a>
							</li>
						</ul>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='menu' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="el-indent-left"></i>
							<span class="title">菜单管理</span>
						</a>
						<ul>
							<?php if(check_grant('list_menu_type') == true and $admin['station_id_data']['key'] === 'main'): ?><li <?php echo C('MENU_CURRENT')=='menu_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=menu_type');?>"><span class="title">菜单类型</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_menu_item') == true and $admin['station_id_data']['key'] === 'main'): ?><li <?php echo C('MENU_CURRENT')=='menu_item' ? 'class="active"' : '';?>>
									<a href="<?php echo U('menu/list');?>"><span class="title">菜单项</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_need_data') == true): ?><li <?php echo C('MENU_CURRENT')=='request_data' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=request_data');?>"><span class="title">需求数据</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_data_type') == true): ?><li <?php echo C('MENU_CURRENT')=='data_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=data_type');?>"><span class="title">数据类型</span></a>
								</li><?php endif; ?>
							<?php if($admin['account'] === 'admin'): ?><li <?php echo C('MENU_CURRENT')=='list_procedure' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=data_type');?>"><span class="title">流程设计</span></a>
								</li><?php endif; ?>
						</ul>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='picture_library' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="el-picture"></i>
							<span class="title">图片库</span>
						</a>
						<ul>
							<li <?php echo C('MENU_CURRENT')=='image_list' ? 'class="active"' : '';?>>
								<a href="<?php echo U('image/list');?>"><span class="title">图片展示</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='image_uplaod' ? 'class="active"' : '';?>>
								<a href="<?php echo U('image/upload');?>"><span class="title">图片上传</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='image_type' ? 'class="active"' : '';?>>
								<a href="<?php echo U('type/list', 'obj=image_type');?>"><span class="title">图片类型</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='image_from' ? 'class="active"' : '';?>>
								<a href="<?php echo U('type/list', 'obj=image_from');?>"><span class="title">图片来源</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='image_content' ? 'class="active"' : '';?>>
								<a href="<?php echo U('type/list', 'obj=image_content');?>"><span class="title">图片内容</span></a>
							</li>
						</ul>
					</li>
					<?php if($task_alert == true or $admin['account'] === 'admin'): ?><li <?php echo C('MENU_ACTIVE')=='alert_task' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="el-megaphone"></i>
							<span class="title">任务提醒</span>
						</a>
						<ul>
							<li <?php echo C('MENU_CURRENT')=='alert_task_activity' ? 'class="active"' : '';?>>
								<a href="<?php echo U('task/alert', 'op_type=list');?>"><span class="title">我的提醒</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='alert_task_line' ? 'class="active"' : '';?>>
								<a href="<?php echo U('task/archive');?>"><span class="title">线路列表</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='alert_task_list' ? 'class="active"' : '';?>>
								<a href="<?php echo U('task/task','op_type=list');?>"><span class="title">任务列表</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='alert_task_date_type' ? 'class="active"' : '';?>>
								<a href="<?php echo U('type/list', 'obj=alert_task_date_type');?>"><span class="title">日期类型</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='alert_task_project' ? 'class="active"' : '';?>>
								<a href="<?php echo U('type/list', 'obj=alert_task_project');?>"><span class="title">项目类型</span></a>
							</li>
						</ul>
					</li><?php endif; ?>
					<li <?php echo C('MENU_ACTIVE')=='settle' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="el-cog-circled"></i>
							<span class="title">个人中心</span>
						</a>
						<ul>
							<?php if(check_grant('list_log_type') == true and $admin['account'] === 'admin'): ?><li <?php echo C('MENU_CURRENT')=='settle_log_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=settle_log_type');?>"><span class="title">日志类型</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_log') == true and $admin['account'] === 'admin'): ?><li <?php echo C('MENU_CURRENT')=='settle_log' ? 'class="active"' : '';?>>
									<a href="<?php echo U('settle/loglist');?>"><span class="title">查看日志</span></a>
								</li><?php endif; ?>
							<li <?php echo C('MENU_CURRENT')=='settle_modify_passwd' ? 'class="active"' : '';?>>
								<a href="<?php echo U('settle/modifypassword');?>"><span class="title">管理员信息</span></a>
							</li>
							<?php if(empty($allow_especial_set) == false): ?><li <?php echo C('MENU_CURRENT')=='settle_especial' ? 'class="active"' : '';?>>
									<a href="<?php echo U('settle/especial');?>"><span class="title">特殊设置</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('pc_home_set') == true): ?><li <?php echo C('MENU_CURRENT')=='settle_pc_home' ? 'class="active"' : '';?>>
									<a href="<?php echo U('settle/settle');?>/type/pchome"><span class="title">PC首页设置</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('pc_set') == true and $admin[station_id_data]['key'] === 'main'): ?><li <?php echo C('MENU_CURRENT')=='settle_pcset' ? 'class="active"' : '';?>>
									<a href="<?php echo U('settle/pcset');?>"><span class="title">PC主站设置</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('phone_home_set') == true and $admin[station_id_data]['key'] === 'main'): ?><li <?php echo C('MENU_CURRENT')=='settle_phone_home' ? 'class="active"' : '';?>>
									<a href="<?php echo U('settle/settle');?>/type/phonehome"><span class="title">手机首页设置</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('qinglvpai_home_set') == true and $admin[station_id_data]['key'] === 'main'): ?><li <?php echo C('MENU_CURRENT')=='settle_qlp_home' ? 'class="active"' : '';?>>
									<a href="<?php echo U('settle/settle');?>/type/qinglvpai"><span class="title">轻旅拍设置</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('sms_set') == true and $admin[station_id_data]['key'] === 'main'): ?><li <?php echo C('MENU_CURRENT')=='settle_sms_template' ? 'class="active"' : '';?>>
									<a href="<?php echo U('settle/smstemplate');?>"><span class="title">短信模板</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('sms_set') == true and $admin[station_id_data]['key'] === 'main'): ?><li <?php echo C('MENU_CURRENT')=='settle_keywords' ? 'class="active"' : '';?>>
									<a href="<?php echo U('settle/keywords');?>"><span class="title">页面关键字</span></a>
								</li><?php endif; ?>
						</ul>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='lock_screen' ? 'class="active opened"' : '';?>>
						<a href="<?php echo U('admin/lockscreen');?>">
							<i class="el-off"></i>
							<span class="title">锁屏</span>
						</a>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='question' ? 'class="active opened"' : '';?>>
						<a href="<?php echo U('index/question');?>">
							<i class="el-help"></i>
							<span class="title">常见问题</span>
						</a>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='help' ? 'class="active opened"' : '';?>>
						<a href="<?php echo U('index/help');?>">
							<i class="linecons-cloud"></i>
							<span class="title">帮助文档</span>
						</a>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='update' ? 'class="active opened"' : '';?>>
						<a href="<?php echo U('index/about');?>">
							<i class="fa-refresh"></i>
							<span class="title">关于&更新</span>
						</a>
					</li>
					<?php if($admin['account'] === 'admin'): ?><li <?php echo C('MENU_ACTIVE')=='sql' ? 'class="active opened"' : '';?>>
							<a href="<?php echo U('index/sql');?>">
								<i class="fa-refresh"></i>
								<span class="title">数据库</span>
							</a>
						</li><?php endif; ?>
				</ul>
						
			</div> <!--div:sidebar-menu-inner-->						
		</div> <!--div:sidebar-menu-->
		
		<!--<script type="text/javascript">
			var mainNavPrevOpenedLi = $('#main-menu').find('.opened');
			var mainNavPrevActiveLi = $('#main-menu').find('.active');
			$('#main-menu').find('li').click(function(){
				$(mainNavPrevOpenedLi).remove('opened');
				$(mainNavPrevActiveLi).remove('active');
				
				$(this).addClass('expanded');
				var firstUl = $(this).find('ul:first');
				if ($(firstUl).length > 0) {
					$(firstUl).slideDown();
				}
				mainNavPrevActiveLi = this;
			});
		</script>--> 
		<!--内容页-->
		<div class="main-content">
			<!--操作员信息-->
			
			<!-- User Info, Notifications and Menu Bar -->
			<nav class="navbar user-info-navbar" role="navigation" style="background-color: #dddddd;">
				
				<!-- Left links for user info navbar -->
				<ul class="user-info-menu left-links list-inline list-unstyled">
					
					<li class="hidden-sm hidden-xs" style="border: #cccccc;">
						<a href="#" data-toggle="sidebar">
							<i class="fa-bars"></i>
						</a>
					</li>
					
					<!--<li class="dropdown hover-line">
						<a href="#" data-toggle="dropdown">
							<i class="fa-envelope-o"></i>
							<span class="badge badge-green">15</span>
						</a>
					</li>-->					
					
					<!--<?php if(check_grant('list_order_review') == true): ?><li class="dropdown hover-line">
							<a href="<?php echo U('review/list');?>">
								<i class="fa-bell-o"></i>
								<span class="badge badge-purple">0</span>
							</a>
						</li>
						<script type="text/javascript">
							$(document).ready(function(){
								$.post('<?php echo U("review/getWaitReview");?>',{},function(data){
									if (data.result.errno != 0) {
										alert(data.result.message);
									} else {
										$('.badge-purple').html(data.waitCount);
									}
								})
							});
						</script><?php endif; ?>-->
					
				</ul>
				
				<!-- Right links for user info navbar -->
				<ul class="user-info-menu right-links list-inline list-unstyled">
					
					<li class="dropdown user-profile" style="border: #cccccc;">
						<a href="#" data-toggle="dropdown">
							<img src="/source/Static/assets/images/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
							<span>
								欢迎~!&nbsp;[<strong><?php echo ($admin["type_id_data"]["type_desc"]); ?>][<?php echo ($admin["show_name"]); ?></strong>]&nbsp;登录，您的所处权限为[<strong><?php echo ($admin["group_id_data"]["type_desc"]); ?></strong>]								
							</span>
							<i class="fa-angle-down"></i>
						</a>
						
						<ul class="dropdown-menu user-profile-menu list-unstyled" style="border: #cccccc;">
							<!--<li>
								<a href="<?php echo U('admin/login');?>">
									<i class="fa-tty"></i>
									客服
								</a>
							</li>
							<li>
								<a href="<?php echo U('admin/login');?>">
									<i class="fa-dollar"></i>
									财务
								</a>
							</li>
							<li>
								<a href="<?php echo U('admin/login');?>">
									<i class="fa fa-spin fa-cog"></i>
									管理员
								</a>
							</li>-->
							<li class="last">
								<a href="<?php echo U('admin/logout');?>">
									<i class="el-export"></i>
									退 出
								</a>
							</li>
						</ul>
					</li>					
				</ul>
			</nav>
			<!--加载页-->
			<div class="loading">		
				<div class="dashboard">
					<img src="/source/Static/back/images/aa.gif"/><br />
					<span class="tips" style="color: red;"></span>
				</div>
			</div>
	
<!--资金审批-->
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default edit">
			<div class="panel-heading">
				<h3 class="panel-title">资金审批</h3>
				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">–</span>
						<span class="expand-icon">+</span>
					</a>
				</div>
			</div>
			<div class="panel-body">
				<!--在此地编辑内容-->
				<div class="row name cash_review_edit">
					<div class="col-xs-12 row data_cash_source">
						<div class="col-xs-4">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">资源类型</span>
								<input type="text" class="form-control data_cash_source_type">
							</div>
						</div>
						<div class="col-xs-4">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon2">资源</span>
								<input type="text" class="form-control data_cash_source_obj" placeholder="请选择资源">
								<span class="input-group-btn">
    								<button class="btn btn-default btn_cash_source_append" type="button" style="border:1px solid #ccc; height: 37px;"><span class="glyphicon glyphicon-pencil"></span></button>
  								</span>
							</div>
						</div>
					</div>
					<div class="col-xs-12 row">
						<div class="col-xs-4">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">请款用途</span>				
								<script type="text/javascript">
									$(document).ready(function(){
										bindTypeDataDropMenu($('.data_cash_type'), 'cj_deposit_type', '选择资金用途', false, null, false, null);		
									});
								</script>
								<input type="text" class="form-control data_cash_type">
							</div>
						</div>
						<div class="col-xs-4">
							<div class="input-group">
								<div class="input-group-addon">
									<i style="font-style: normal;">指定审批人</i>
								</div>
								<script type="text/javascript">
									$(document).ready(function(){
										bindAdminDropMenu($('.data_cash_review_admin'), '', '点击选择审批管理员或者输入关键字查询');
										setSelect2Value('.data_cash_review_admin', '{"id":"85","account":"郭煜","show_name":"郭煜"}');	
									});
								</script>
								<input type="text" class="form-control data_cash_review_admin">
							</div>
						</div>
					</div>
					<div class="col-xs-12 row">
						<div class="col-xs-4">
							<div class="input-group">
								<div class="input-group-addon">
									<i style="font-style: normal;">结算方式</i>
								</div>
								<script type="text/javascript">
									$(document).ready(function(){
										bindTypeDataDropMenu($('.data_cash_pay_type'), 'cj_pay_type', '选择结算类型');
									});
								</script>
								<input type="text" class="form-control data_cash_pay_type">
							</div>
						</div>
						<div class="col-xs-4">
							<div class="input-group">
								<div class="input-group-addon">
									<i style="font-style: normal;">收款人</i>
								</div>
								<input type="text" class="form-control data_cash_payee" value="<?php echo ($deposit["payee"]); ?>">
							</div>
						</div>
						<div class="col-xs-4">
							<div class="input-group">
								<div class="input-group-addon">
									<i style="font-style: normal;">收款账号</i>
								</div>
								<input type="number" class="form-control data_cash_bank_card" maxlength="16" value="<?php echo ($deposit["bank_card"]); ?>">
							</div>
						</div>
					</div>
					<div class="col-xs-12 row">
						<div class="col-xs-12">
							<div class="input-group">
								<div class="input-group-addon">
									<i style="font-style: normal;">开户行与地址</i>
								</div>
								<input type="text" class="form-control data_cash_bank_address" value="<?php echo ($deposit["bank_address"]); ?>">
							</div>
						</div>
					</div>
					<div class="col-xs-12 row">
						<div class="col-xs-3">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon5">请款金额</span>
								<input type="number" class="form-control data_cash_money" placeholder="请输入申请金额" maxlength="8" value="<?php echo ($deposit["approval_amount"]); ?>">
							</div>
						</div>
						<div class="col-xs-9">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon6">备注</span>
								<input type="text" class="form-control data_cash_beizhu" placeholder="请输入要备注的内容" value="<?php echo ($deposit["beizhu"]); ?>" >
							</div>
						</div>
					</div>
					<div class="col-xs-12 row">
						<button style="float: right;width:70px; margin-left: 20px;" type="button" class="btn btn-info btn-sm btn_cash_clear">清空资料</button>
						<button style="float: right;width:70px;" type="button" class="btn btn-primary btn-sm btn_cash_review">资金送审</button>
					</div>
				</div>
				<br /><br /><br />
				<table class="table table1 table_cash_review">
					<thead>
					<tr>
						<th>送审对象</th>
						<th>操作方式</th>
						<th>提审内容</th>
						<th>收款人信息</th>
						<th>审核状态</th>
						<th>审核内容</th>
						<th>确认内容</th>
						<th>信息操作</th>
					</tr>
					</thead>
					<tbody>		
						<?php if(empty($deposit) == false): ?><tr class="insurance" data-id="<?php echo ($deposit["id"]); ?>">
								<td><?php echo ($deposit["deposit_obj_data"]["type_desc"]); ?><br/><?php echo ($deposit["deposit_obj_show"]); ?></td>
								<td><?php echo ($deposit["deposit_type_data"]["type_desc"]); ?></td>
								<td>送审人员:<?php echo ($deposit["request_admin_data"]["account"]); ?><br />预算金额:<?php echo ($deposit["money"]); ?><br />减免金额:<?php echo ($deposit["derate"]); ?><br />请款金额:<?php echo ($deposit["approval_amount"]); ?><br />送审时间:<?php echo ($deposit["request_time"]); ?><br />送审附言:<?php echo ($deposit["beizhu"]); ?></td>	
								<td>收款方式:<?php echo ($deposit["pay_type_data"]["type_desc"]); ?><br />收款人:<?php echo ($deposit["payee"]); ?><br />收款账号:<?php echo ($deposit["bank_card"]); ?><br />开户行地址:<?php echo ($depositd["bank_address"]); ?></td>
								<td><?php echo ($deposit["review_type_data"]["type_desc"]); ?></td>
								<td>审核人员:<?php echo ($deposit["review_admin_data"]["account"]); ?><br />审批资金:<?php echo ($deposit["finnal_money"]); ?><br />审核时间:<?php echo ($deposit["review_time"]); ?><br />审核附言:<?php echo ($deposit["review_beizhu"]); ?></td>
								<td>确认人员:<?php echo ($deposit["confirm_admin_data"]["account"]); ?><br />已支付金额:<?php echo ($deposit["complated_money"]); ?><br />本次确认金额:<?php echo ($deposit["confirm_money"]); ?><br />确认时间:<?php echo ($deposit["confirm_time"]); ?><br />审核附言:<?php echo ($deposit["confirm_beizhu"]); ?></td>
								<td>
									<button style="float: right;" type="button" class="btn btn-secondary btn-sm btn_cash_source_review">审批详细</button>
								</td>
							</tr><?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">	
	// select2 对象	
	var select2CashSourceType = null;
	var select2CashSourceObj = null;
	
	// 切换资源类型
	function changeCashSourceType(ev) {
		setSelect2Value($('.data_cash_source_obj'), null);
		if (select2CashSourceObj != null) {
			var typestr = getSelect2Value($('.data_cash_source_type'));				
			if (typestr != {} && typestr != '') {
				var type = $.parseJSON(typestr);
				if (type.type_key.indexOf('insurance') != -1) {
					select2CashSourceObj.ds.tab = 'cj_insurance';
				} else if (type.type_key.indexOf('leader') != -1) {
					select2CashSourceObj.ds.tab = 'cj_leader';
				} else if (type.type_key.indexOf('hotel') != -1) {
					select2CashSourceObj.ds.tab = 'cj_hotel';
				} else if (type.type_key.indexOf('driver') != -1) {
					select2CashSourceObj.ds.tab = 'cj_driver';
				} else if (type.type_key.indexOf('bus') != -1) {
					select2CashSourceObj.ds.tab = 'cj_bus';
				} else if (type.type_key.indexOf('view') != -1) {
					select2CashSourceObj.ds.tab = 'cj_view';
				} else if (type.type_key.indexOf('agency') != -1) {
					select2CashSourceObj.ds.tab = 'cj_agency';
				} else {
					select2CashSourceObj.ds.tab = 'cj_source';
				}
			}
		}
	}
	
	// 初始化资源类型
	function initCashSourceType() {											
		var voption = {obj:$('.data_cash_source_type'), search:1, placeholder: '请选择资源类型', show_col:'type_desc', select_col:'type_desc', func_select_changed:changeCashSourceType};
		var vds = {tab:'type_data', search_col: 'type_desc', cdsstr: 'type_key|LIKE|cj_source_obj_%', cdtype:3, sort:'sort|asc'}
		select2CashSourceType = new MySelect2(voption, vds);
	}
	
	// 显示选择资源文本
	function cashSourceObjShowText(ds) {
		if (select2CashSourceObj == null) {
			return '未初始化资源下拉框';
		}
		
		setSelect2Value($('.data_cash_pay_type'), ds.pay_type);
		$('.data_cash_payee').val(ds.payee);					
		$('.data_cash_bank_address').val(ds.bank_address);
		$('.data_cash_bank_card').val(ds.bank_card);
		
		var vtab = select2CashSourceObj.ds.tab;
		if (vtab.indexOf('insurance') != -1) {
			return ds.name;
		} else if (vtab.indexOf('leader') != -1) {
			if (ds.name != null && ds.name != '') {
				return ds.name;
			} else if (ds.nickname != null && ds.nickname != '') {
				return ds.nickname;
			}else if (ds.stagename != null && ds.stagename != '') {
				return ds.stagename;
			}
		} else if (vtab.indexOf('hotel') != -1) {
			return ds.name+'['+ds.city+']';
		} else if (vtab.indexOf('driver') != -1) {
			return ds.name;
		} else if (vtab.indexOf('bus') != -1) {
			return ds.seat+'座'+ds.bus_log+'['+ds.name+']';
		} else if (vtab.indexOf('view') != -1) {
			return ds.name+'['+ds.city+']['+ds.province+']';
		} else if (vtab.indexOf('agency') != -1) {
			var type = '';
			if (ds.agency_type != '' && ds.agency_type != null && ds.agency_type != '{}'){
				var typeObj = $.parseJSON(ds.agency_type);
				type = typeObj.type_desc;
			} 
			return ds.name+'['+type+']';
		} else {
			return ds.name;
		}
	}
	
	
	// 初始化资源
	function initCashSourceObj() {				
		var voption = {obj:$('.data_cash_source_obj'), search:1, placeholder: '请选择资源', show_col:cashSourceObjShowText, select_col:cashSourceObjShowText};
		var vds = {tab:'cj_leader', search_col: 'name', cdsstr: 'invalid|=|0|AND', cdtype:4}
		select2CashSourceObj = new MySelect2(voption, vds);
	}
	
	// 初始化审批信息
	function initCashSourceData() {		
		$('.cash_review_edit').attr('data-id', '<?php echo ($deposit["id"]); ?>');
		setSelect2Value($('.data_cash_source_type'), '<?php echo ($deposit["obj_type"]); ?>');
		if ('<?php echo ($deposit["json_obj_data"]); ?>' != '') {
			setSelect2Value($('.data_cash_source_obj'), '<?php echo ($deposit["json_obj_data"]); ?>');	
		}
		setSelect2Value($('.data_cash_type'), '<?php echo ($deposit["deposit_type"]); ?>');
		setSelect2Value($('.data_cash_pay_type'), '<?php echo ($deposit["pay_type"]); ?>');		
		$('.data_cash_payee').val('<?php echo ($deposit["payee"]); ?>');
		$('.data_cash_bank_card').val('<?php echo ($deposit["bank_card"]); ?>');
		$('.data_cash_money').val('<?php echo ($deposit["approval_amount"]); ?>');
		$('.data_cash_bank_address').val('<?php echo ($deposit["bank_address"]); ?>');
		$('.data_cash_beizhu').val('<?php echo ($deposit["beizhu"]); ?>');
		
	}
	
	// JS初始化
	$(document).ready(function(){
		// 初始化资金审批的资源类型
		initCashSourceType();	
		// 初始化资金审批的资源
		initCashSourceObj();
		// 初始化审批信息
		initCashSourceData();		
	});
	
	// 添加新审批信息
	$('.btn_cash_source_append').click(function(){
		var sourcetypestr = getSelect2Value($('.data_cash_source_type'));
		if (sourcetypestr == '' || sourcetypestr == '{}') {
			toastr.warning('请选择要添加资源的类型');
			return false;
		}
		
		var vhref = '';
		var sourceType = $.parseJSON(sourcetypestr);
		if (sourceType.type_key != null) {
			var typeKey = sourceType.type_key;			
			var basestr = 'cj_source_obj_';
			vhref = '<?php echo U("financial/source");?>/src/'+typeKey.substr(basestr.length);
			window.open(vhref);
		} else {
			toastr.warning('错误的资源类型');
		}			
	});	
	
	// 审批详细跳转
	function _ajaxCashReviewInfo() {
		var reviewId = $(this).closest('tr').attr('data-id');
		window.open('<?php echo U("financial/deposit");?>/id/'+reviewId);
	}
	// 绑定跳转审批详细事件
	$('.btn_cash_source_review').click(_ajaxCashReviewInfo);
	
	// 保存审批信息
	function _ajaxCashReviewSave() {		
		var cashtypestr = getSelect2Value($('.data_cash_type'));
		if (cashtypestr == '' || cashtypestr == '{}') {
			toastr.warning('请选择资金操作方式');
			return false;
		}			
		
		var vpayee = $('.data_cash_payee').val();
		var bankCard = $('.data_cash_bank_card').val();
		var vmoney = parseFloat($('.data_cash_money').val());
		if (vpayee == '' || bankCard == '' || vmoney <= 0) {
			toastr.warning('收款人、收款账号、提审金额不能为空，且提审金额必须大于0');
			return false;
		}
		var jsonData = {
			op_type: 'review',
			id: $('.cash_review_edit').attr('data-id'),
			team_id: 0,
			deposit_type: cashtypestr,
			bank_address: $('.data_cash_bank_address').val(),
			bank_card: bankCard,
			payee: vpayee,
			pay_type: getSelect2Value($('.data_cash_pay_type')),
			money: vmoney,
			approval_amount: vmoney,
			beizhu: $('.data_cash_beizhu').val(),
		}
		
		var sourcetypestr = getSelect2Value($('.data_cash_source_type'));
		if (sourcetypestr == '' || sourcetypestr == '{}') {
			toastr.warning('请选择资源类型');
			return false;
		}
		
		var sourceobjstr = getSelect2Value($('.data_cash_source_obj'),['id']);
		if (sourceobjstr == '' || sourceobjstr == '{}') {
			toastr.warning('请选择资源对象');
			return false;
		}
		var adminstr = getSelect2Value($('.data_cash_review_admin'), ['id', 'account', 'nickname']);
		if (adminstr == '' || adminstr == '{}') {
			toastr.warning('请指定审批管理员');
			return false;
		}
		var sourceObj = $.parseJSON(sourceobjstr);
		jsonData['obj_type'] = sourcetypestr
		jsonData['obj_id'] = sourceObj.id
		
		var admin = $.parseJSON(adminstr);
		admin['show_name'] = admin.nickname != '' && admin.nickname != 'undefined' ? admin.nickname : admin.account;
		jsonData['review_admin'] = JSON.stringify(admin);
		
		$.post('<?php echo U("financial/deposit");?>', jsonData, function(data){
			if (data.result.errno == 0) {
				if (data.op != 'remove' && data.ds != null) {
					var d = data.ds;
					var depositObjContent = d.deposit_obj_data != null ? d.deposit_obj_data.type_desc : '';
					var depositTypeContent = d.deposit_type_data != null ? d.deposit_type_data.type_desc : '';
					var reviewTypeContent = d.review_type_data != null ? d.review_type_data.type_desc : '';
					var requestAdmin = d.request_admin_data != null ? d.request_admin_data.account : '';
					var payType = d.pay_type_data != null ? d.pay_type_data.type_desc : '';
					var reviewAdmin = d.review_admin_data != null ? d.review_admin_data.account : '';
					var confirmAdmin = d.confirm_admin_data != null ? d.confirm_admin_data.account : '';
					var requestContent = '送审人员:'+d.requestAdmin+'<br />预算金额:'+d.money+'<br />减免金额:'+d.derate+'<br />请款金额:'+d.approval_amount+'<br />送审时间:'+d.request_time+'<br />送审附言:'+d.beizhu;
					var payeeContent = '收款方式:'+payType+'<br />收款人:'+d.payee+'<br />收款账号:'+d.bank_card+'<br />开户行地址:'+d.bank_address;
					var reviewContent = '审核人员:'+reviewAdmin+'<br />审核金额:'+d.finnal_money+'<br />审核时间:'+d.review_time+'<br />审核附言:'+d.review_beizhu;
					var confirmContent = '审核人员:'+confirmAdmin+'<br />已支付金额:'+d.complated_money+'<br />审核金额:'+d.confirm_money+'<br />审核时间:'+d.confirm_time+'<br />审核附言:'+d.confirm_beizhu;
					if (data.op == 'create') {
						var vhtml = '<tr class="insurance" data-id="'+d.id+'">';
							vhtml +='	<td>'+depositObjContent+'<br />'+d.deposit_obj_show+'</td>';
							vhtml +='	<td>'+depositTypeContent+'</td>';
							vhtml +='	<td>'+requestContent+'</td>';
							vhtml +='	<td>'+payeeContent+'</td>';
							vhtml +='	<td>'+reviewTypeContent+'</td>';
							vhtml +='	<td>'+reviewContent+'</td>';
							vhtml +='	<td>'+confirmContent+'</td>';
							vhtml +='	<td>';
							vhtml +='		<button style="float: right;" type="button" class="btn btn-secondary btn-sm btn_cash_source_review">审批详细</button>';
							vhtml +='	</td>';
							vhtml +='</tr>';
						$('.table_cash_review').find('tbody').append(vhtml);
						var trObj = $('.table_cash_review').find('tbody').find('tr:last');
						$(trObj).find('.btn_cash_source_review').click(_ajaxCashReviewInfo);
					} else {
						var trObj = $('.table_cash_review').find('tbody').find('tr[data-id="'+d.id+'"]');
						$(trObj).find('td:eq(0)').html(d.deposit_obj_show);
						$(trObj).find('td:eq(1)').html(depositTypeContent);
						$(trObj).find('td:eq(2)').html(requestContent);
						$(trObj).find('td:eq(3)').html(payeeContent);
						$(trObj).find('td:eq(4)').html(reviewTypeContent);
						$(trObj).find('td:eq(5)').html(reviewContent);
						$(trObj).find('td:eq(6)').html(confirmContent);
					}
				}	
				clearCashReview();
				toastr.success(data.result.message);
			} else {
				toastr.error(data.result.message);
			}	
		});
	
	}		
	// 绑定保存资源
	$('.btn_cash_review').click(_ajaxCashReviewSave);
	
	// 清空编辑的审批信息
	function clearCashReview(){
		$('.cash_review_edit').attr('data-id', '');
		setSelect2Value($('.data_cash_type'), null);
		setSelect2Value($('.data_source_type'), null);
		setSelect2Value($('.data_source_obj'), null);
		setSelect2Value($('.data_cash_pay_type'), null);
		$('.data_cash_payee').val('');
		$('.data_cash_bank_card').val('');
		$('.data_cash_bank_address').val('');
		$('.data_cash_money').val('');
		$('.data_cash_beizhu').val('');
	}
	$('.btn_cash_clear').click(clearCashReview);
	
</script>


<!--跟踪记录-->
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default edit">
			<div class="panel-heading">
				<h3 class="panel-title">跟踪记录</h3>
				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">–</span>
						<span class="expand-icon">+</span>
					</a>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table1 table_supervise">
					<thead>
					<tr>
						<th>跟踪编号</th>
						<th>操作人员</th>
						<th>操作内容</th>
						<th>操作时间</th>
					</tr>
					</thead>
					<tbody>
						<?php if(is_array($team["supervise"])): $i = 0; $__LIST__ = $team["supervise"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><tr class="insurance" data-id="<?php echo ($s["id"]); ?>">
								<td><?php echo ($s["id"]); ?></td>
								<td><?php echo ($s["admin_data"]["show_name"]); ?></td>
								<td style="text-align: left;"><?php echo ($s["content"]); ?></td>	
								<td><?php echo ($s["create_time"]); ?></td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
			<!-- Main Footer -->
			<!-- Choose between footer styles: "footer-type-1" or "footer-type-2" -->
			<!-- Add class "sticky" to  always stick the footer to the end of page (if page contents is small) -->
			<!-- Or class "fixed" to  always fix the footer to the end of page -->
			<footer class="main-footer sticky footer-type-1">
				
				<div class="footer-inner">
				
					<!-- Add your copyright text here -->
					<div style="text-align: center; font-family: '微软雅黑';">
						&copy; 版权所有&nbsp;[领袖户外-后台系统]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						更多信息请关注<a href="http://kllife.com/" target="_blank" title="领袖户外">[<strong><u>领袖户外</u></strong>]</a>
					</div>
					
					
				</div>
				
			</footer>
		</div>		
		
	</div> <!--div:page-container-->	
				
	<a class="main_scroll_top" href="javascript:;" style="position: fixed; left: 80px; bottom: 10px; display: block; width: 50px; height: 50px; z-index: 999; background-image: url(/source/Static/back/images/up.png); background-size: 100% 100%;"></a>
	<div class="page-loading-overlay">
		<div class="loader-2"></div>
	</div>
	
	<script type="text/javascript">
		$('.main_scroll_top').click(function(){
			$('html,body').animate({scrollTop: 0}, 1000);
		})
	</script>
	

	<link rel="stylesheet" href="/source/Static/assets/js/select2/select2.css">
	<link rel="stylesheet" href="/source/Static/assets/js/select2/select2-bootstrap.css">
	<!--Import daterangepicker css-->
	<link rel="stylesheet" href="/source/Static/assets/js/daterangepicker/daterangepicker-bs3.css">
	<link rel="stylesheet" href="/source/Static/assets/js/datetimepicker/css/bootstrap-datetimepicker.min.css">	
	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="/source/Static/assets/js/fullcalendar/fullcalendar.min.css">
	
	<!-- Bottom Scripts -->
	<script src="/source/Static/assets/js/bootstrap.min.js"></script>
	<script src="/source/Static/assets/js/TweenMax.min.js"></script>
	<script src="/source/Static/assets/js/resizeable.js"></script>
	<script src="/source/Static/assets/js/joinable.js"></script>
	<script src="/source/Static/assets/js/xenon-api.js"></script>
	<script src="/source/Static/assets/js/xenon-toggles.js"></script>
	<script src="/source/Static/assets/js/moment.min.js"></script>
	
	<!-- Imported scripts on this page -->
	<script src="/source/Static/assets/js/fullcalendar/fullcalendar.min.js"></script>
	<script src="/source/Static/assets/js/jquery-ui/jquery-ui.min.js"></script>
	
	<!-- Imported scripts on this page -->
	<script src="/source/Static/assets/js/daterangepicker/daterangepicker.js"></script>
	<script src="/source/Static/assets/js/datepicker/bootstrap-datepicker.js"></script>
	<script src="/source/Static/assets/js/timepicker/bootstrap-timepicker.min.js"></script>
	<script src="/source/Static/assets/js/datetimepicker/js/bootstrap-datetimepicker.js"></script>
	<script src="/source/Static/assets/js/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>

	<!-- Imported scripts on this page -->
	<script src="/source/Static/assets/js/jquery-validate/jquery.validate.min.js"></script>
	
	<!-- Imported dropzone scripts -->
	<script src="/source/Static/assets/js/dropzone/dropzone.min.js"></script>
	
	<!-- Imported dataTables scripts -->
	<script src="/source/Static/assets/js/datatables/js/jquery.dataTables.min.js"></script>
	<script src="/source/Static/assets/js/datatables/dataTables.bootstrap.js"></script>
	<script src="/source/Static/assets/js/datatables/yadcf/jquery.dataTables.yadcf.js"></script>
	<script src="/source/Static/assets/js/datatables/tabletools/dataTables.tableTools.min.js"></script>
		
	<!-- Imported scripts on this page -->
	<script src="/source/Static/assets/js/ckeditor/ckeditor.js"></script>
	<script src="/source/Static/assets/js/ckeditor/adapters/jquery.js"></script>
		
	<!-- Imported selectBoxIt on this page -->
	<script src="/source/Static/assets/js/select2/select2.min.js"></script>
	<script src="/source/Static/assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<script src="/source/Static/assets/js/multiselect/js/jquery.multi-select.js"></script>
	<script src="/source/Static/assets/js/tagsinput/bootstrap-tagsinput.min.js"></script>
	
	<!-- JavaScripts initializations and stuff -->
	<script src="/source/Static/assets/js/xenon-custom.js"></script>

	<!-- Import fileupload on this page -->
	<script src="/source/Static/assets/js/fileupload/js/jquery.fileupload.js"></script>
	<script src="/source/Static/assets/js/fileupload/js/vendor/jquery.ui.widget.js"></script>
	<script src="/source/Static/assets/js/fileupload/js/jquery.iframe-transport.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){$('footer').css('margin-top', '10px');});
	</script>
</body>
</html>
<script type="text/javascript">
</script>