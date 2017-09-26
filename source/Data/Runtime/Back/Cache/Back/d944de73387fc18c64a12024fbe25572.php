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
	<link rel="stylesheet" href="/source/Static/assets/js/wysihtml5/src/bootstrap-wysihtml5.css">
	<script src="/source/Static/assets/js/wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
	<script src="/source/Static/assets/js/wysihtml5/src/bootstrap-wysihtml5.js"></script>
	<script src="/source/Static/assets/js/formwizard/jquery.bootstrap.wizard.min.js"></script>	
	
	<div class="page-title">		
		<div class="title-env">
			<h1 class="title"><?php echo C('CONTENT_TITLE');?></h1>
			<p class="description"><?php echo C('CONTENT_DESC');?></p>
		</div>			
	</div>
	
	<input type="hidden" id="line_id" value="<?php echo ($lineId); ?>"/>	
	
	<!-- 游记模板开始 -->	
	<div class="row template_youji hidden_ctrl">
		<div class="col-md-9">
			<div class="form-group">
				<div class="youji_show_text hidden_ctrl"></div>
				<div class="youji_ct_text">
					<textarea class="form-control youji_text"></textarea>
				</div>
				<img class="youji_image" src="" alt=""/>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<div class="col-md-5">
					<div class="input-group">
						<span class="input-group-btn">
							<button class="btn btn-secondary btn_sort_offset btn_sort_up" type="button">上移</button>
						</span>
						<span class="input-group-btn">
							<button class="btn btn-secondary btn_sort_offset btn_sort_down" type="button">下移</button>	</span>					
						<input type="text" style="width: 50px;" maxlength="3" class="form-control form-focus-secondary offset_val" value="1">						
						
						
					</div>
				</div>
				<div class="col-md-5">
					<button class="btn btn-secondary btn_youji_edit">保存</button>
					<button class="btn btn-danger btn_youji_delete">删除</button>
				</div>
				<div class="add-three-btn col-md-12">
					<button class="btn btn-secondary btn_insert_text">插入文本</button>
					<button class="btn btn-secondary btn_select_image">选择图片</button>
					<button class="btn btn-secondary btn_upload_image">上传图片</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		function moveYoujiIndex(youjiObj, sortOffset) {			
			var jsonData = {
				op_type: 'sort_offset',
				id: $(youjiObj).attr('data-id'),
				offset: sortOffset,	// 目标索引，在他之前插入
				up: sortOffset < 0 ? 1 : 0,
			}
			
			var thisIndex = parseInt($(youjiObj).attr('data-index'));
			$.post('<?php echo U("line/linepoint");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					if (data.sort_index != null && typeof(data.sort_index) != 'undefined') {
						var newIndex = data.sort_index;				
						// 将对象移至指定位置
						$(youjiObj).parent().find('.youji').each(function(i,ev){
							var nowIndex = parseInt($(this).attr('data-index'));
							if ($(this).attr('id') != $(youjiObj).attr('id')) {
								if (sortOffset < 0) { // 上移
									if (nowIndex >= newIndex && nowIndex < thisIndex) {
										$(this).attr('data-index', nowIndex+1);
										$(this).find('.offset_val').val(nowIndex+1);
										if (nowIndex == newIndex) {
											$(this).before(youjiObj);
											console.log($(this).attr('id')+'/'+$(youjiObj).attr('id'));
										}
									}	
								} else {
									if (nowIndex > thisIndex && nowIndex <= newIndex) {
										$(this).attr('data-index', nowIndex-1);
										$(this).find('.offset_val').val(nowIndex-1);
										if (nowIndex == newIndex) {
											$(this).after(youjiObj);	
										}
									}									
								}
							}
						});
						// 设置新索引
						$(youjiObj).attr('data-index', data.sort_index);
						$(youjiObj).find('.offset_val').val(data.sort_index);
					}
				} else {
					toastr.error(data.result.message);
				}	
			});
		}
	
		// 排序偏移
		$('.btn_sort_offset').click(function(){
			var youjiObj = $(this).closest('.youji');
			var sortOffset = $(this).hasClass('btn_sort_down') == false ? 1 : 0;
			moveYoujiIndex(youjiObj, sortOffset);
		});
		
		// 设置排序插入的位置
		$('.offset_val').blur(function(){
			var youjiObj = $(this).closest('.youji');
			var thisIndex = parseInt($(youjiObj).attr('data-index'));
			var aimIndex = $(this).val();
			if (thisIndex == aimIndex) {
				return false;
			}
			
			var sortOffset = aimIndex - thisIndex;
			moveYoujiIndex(youjiObj, sortOffset);
		});
	
		// 绑定插入按钮
		function bindInsertButtonToYouji(obj) {
			if (typeof(obj) != 'object') {
				toastr.error('对象错误，绑定插入按钮失败');
				return false;
			}
			$(obj).append($('.template_youji').find('.add-three-btn').clone(true));
			return true;
		}
		
		function getTabPanelIndex(tabObj) {
			var idx = 0;
			$('.tab-pane').each(function(i, el) {
				if ($(tabObj).attr('id') == $(this).attr('id')) {
					idx = i;		
				}
			});
			return idx;
		}
		
		// 插入数据发送
		function _ajaxInsertYouji(tabObj, newIndex, cntType, content) {
			var tabId = $(tabObj).attr('id');
			var typeId = 1;
			if (tabId == 'fwv-2') {
				typeId = 1;
			} else if (tabId == 'fwv-3') {
				typeId = 4;
			} else if (tabId == 'fwv-6') {
				typeId = 2;
			} else {
				toastr.error('错误的内容类型')
				return 0;
			}
			
			var jsonData = {
				op_type: 'create',
				line_id: $('#line_id').val(),
				type_id: typeId,		// 行程亮点面板（类型：1）还是沿途风光面板（类型：2）
				'index': newIndex,	// 目标索引，在他之前插入
			}
			if (cntType == 0) {
				jsonData['content'] = content;
			} else {
				jsonData['image_url'] = content;
			}
			
			var result = 0;
			$.ajax({
				url: '<?php echo U("line/linepoint");?>',
				async: false,		// 同步执行，主要针对同时插入多个图片对象，是插入的图片按照顺序进行插入
				type: 'POST',
				data: jsonData,
				dataType: 'json',
				success: function(resp, data) {
//					console.log(JSON.stringify(resp));
					if (resp.result.errno == 0) {
						// 返回后处理所有游记插入内容的偏移情况，before:true,大于等于指定对象的索引偏移	,before:false,大于指定对象的索引偏移
						$(tabObj).find('.youji').each(function(i,el){
							var tempIndex = parseInt($(this).attr('data-index'));
							if (tempIndex >= newIndex) {
								$(this).attr('data-index', tempIndex + 1);
								$(this).find('.offset_val').val(tempIndex + 1);
							}
						});
						result = resp.id
					} else {
						console.log('插入游记信息结果错误：'+resp.result.message);
					}
				},
				error: function(resp, err, excp) {
					console.log('插入游记信息错误：'+JSON.stringify(err));
				}			
			});
			return result;
		}		
		
		var youji_ctrl_index = 1;
		// 插入文本
		function insertYoujiText(btnObj) {
			var newIndex = 1;
			var tabObj = $(btnObj).closest('.tab-pane');
			var containerObj = $(btnObj).closest('.add-three-btn');
			var youjiObj = $(btnObj).closest('.youji');
			if ($(youjiObj).length > 0) {
				newIndex = parseInt($(youjiObj).attr('data-index')) + 1;
				containerObj = youjiObj;
			}
			
			var idbasestr = '';
			var tabIndex = getTabPanelIndex(tabObj);
			if (tabIndex == 1) {
				idbasestr = 'line_point';
			} else if (tabIndex == 2) {
				idbasestr = 'line_phone_point';
			} else if (tabIndex == 5) {
				idbasestr = 'line_scenery';
			} else {
				return false;
			}
						
			// 添加新的文本输
			var insertId = _ajaxInsertYouji(tabObj, newIndex, 0, '');
			console.log('new_index:'+newIndex+',insert_id:'+insertId);
			if (insertId != 0) {	
				// 克隆并设置新增模块属性
				var youjiObj = $('.template_youji').clone(true);
				$(youjiObj).removeClass('hidden_ctrl');
				$(youjiObj).removeClass('template_youji');
				$(youjiObj).addClass('youji');				
				$(youjiObj).attr('data-id', insertId)
				$(youjiObj).attr('data-index', newIndex);
				$(youjiObj).attr('id', idbasestr + '_' + youji_ctrl_index);
				$(youjiObj).find('.offset_val').val(newIndex);
				youji_ctrl_index ++;
				
				// 设置新增加模块的其他内容
				$(youjiObj).find('.youji_image').remove();
				$(youjiObj).find('.youji_text').wysihtml5({
					size: 'white',
					stylesheets: "/source/Static/assets/js/wysihtml5/lib/css/wysiwyg-color.css",
					image: false,
				});		
				
				// 添加新模块到游记列表中					
				$(containerObj).after(youjiObj);
			} else {
				$(youjiObj).remove();
			}
		}
		
		// 添加下一张图片
		var gImageList = [];
		function appendNextImage(idbasestr, containerObj, tabObj, insertIndex, curImageIndex) {	
			if (curImageIndex >= gImageList.length) {		
				// 去除遮罩层
				showLoading(false);
				return false;
			}	
			
			if (curImageIndex > 30) {
				showLoading(false);
				return false;
			}
			
			if (gImageList[curImageIndex] == '') {
				appendNextImage(idbasestr, containerObj, tabObj, insertIndex, curImageIndex+1);
				return false;
			}
			
			// 添加遮罩层
			showLoading(true, '正在上传第'+(parseInt(curImageIndex)+1)+'张图片，请耐心等待...');
			
			// 插入游记内容
			var insertId = _ajaxInsertYouji(tabObj, insertIndex, 1, gImageList[curImageIndex]);
			console.log('new_index:'+insertIndex+',insert_id:'+insertId);
			if (insertId != 0) {	
				// 克隆并设置新增模块属性				
				var youjiObj = $('.template_youji').clone(true);
				$(youjiObj).removeClass('hidden_ctrl');
				$(youjiObj).removeClass('template_youji');
				$(youjiObj).addClass('youji');
				$(youjiObj).attr('data-id', insertId);
				$(youjiObj).attr('data-index', insertIndex);
				$(youjiObj).attr('id', idbasestr + '_' + youji_ctrl_index);
				$(youjiObj).find('.offset_val').val(insertIndex);
				youji_ctrl_index ++;
				
				// 设置新增模块其他元素属性
				$(youjiObj).find('.youji_show_text').remove()
				$(youjiObj).find('.youji_ct_text').remove();	
				$(youjiObj).find('.btn_youji_edit').remove();	
				$(youjiObj).find('.youji_image').attr('src', gImageList[curImageIndex]);
									
				// 添加新模块到游记列表中
				$(containerObj).after(youjiObj);
				insertIndex ++;
				
				// 继续下一张图片添加
				appendNextImage(idbasestr, youjiObj, tabObj, insertIndex, curImageIndex+1);
			} else {
				$(youjiObj).remove();
			}
		}
						
		// 插入图片
		function insertYoujiImage(btnObj, imageList) {				
			var newIndex = 1;
			var tabObj = $(btnObj).closest('.tab-pane');
			// 默认在按钮控件后添加内容
			var containerObj = $(btnObj).closest('.add-three-btn');
			// 查看按钮的父节点是否是游记			
			var youjiObj = $(btnObj).closest('.youji');
			if ($(youjiObj).length > 0) {
				newIndex = parseInt($(youjiObj).attr('data-index')) + 1;
				containerObj = youjiObj;
			}
			
			var idbasestr = '';
			var tabIndex = getTabPanelIndex(tabObj);
			if (tabIndex == 1) {
				idbasestr = 'line_point';
			} else if (tabIndex == 2) {
				idbasestr = 'line_phone_point';
			} else if (tabIndex == 5) {
				idbasestr = 'line_scenery';
			} else {
				return false;
			}
			
			// 选择图片和上传图片回调返回的图片数据不同	
			if (typeof(imageList) == 'string') {
				var imageurl = imageList;
				imageList = new Array(imageurl);
			}
			gImageList = imageList;	
			
			// 添加图片
			appendNextImage(idbasestr, containerObj, tabObj, newIndex, 0);						
		}
		
		// 保存文本数据
		function saveYoujiText(rootObj, bEdit) {				
			if ($(rootObj).find('.btn_youji_edit').html() == '编辑') {
				$(rootObj).find('.btn_youji_edit').html('保存');
				$(rootObj).find('.youji_show_text').addClass('hidden_ctrl');
				$(rootObj).find('.youji_ct_text').removeClass('hidden_ctrl');
				var vhtml = $(rootObj).find('.youji_show_text').html();
				$(rootObj).find('.youji_text').data('wysihtml5').editor.setValue(vhtml);
				return false;
			}
			
			var vhtml = $(rootObj).find('.youji_text').data('wysihtml5').editor.getValue();
			var jsonData = {
				op_type: 'save',
				id: $(rootObj).attr('data-id'),
				content: vhtml,
			}
			
			$.post('<?php echo U("line/linepoint");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					$(rootObj).find('.youji_ct_text').addClass('hidden_ctrl');
					$(rootObj).find('.youji_show_text').html(vhtml);
					$(rootObj).find('.youji_show_text').removeClass('hidden_ctrl');
					$(rootObj).find('.btn_youji_edit').html('编辑');
				} else {
					toastr.error(data.result.message);
				}
			});
		}
		
		// 删除数据
		function deleteYouji(rootObj) {
			var aid = $(rootObj).attr('data-id');
			if (aid == '0') {
				toastr.error('数据未存入数据库,不能删除');
				return false;
			}
			
			var delIndex = parseInt($(rootObj).attr('data-index'));
			$.post('<?php echo U("line/linepoint");?>', {op_type:'delete', id:aid}, function(data){
				if (data.result.errno == 0) {
					var tabObj = $(rootObj).closest('.tab-pane');
					$(rootObj).remove();
					$(tabObj).find('.youji').each(function(i, el){
						var elIndex = parseInt($(this).attr('data-index'));
						if (elIndex >= delIndex) {
							$(this).attr('data-index', elIndex-1);
							$(this).find('.offset_val').val(elIndex-1);
						}
					});
				} else {
					toastr.error(data.result.message);
				}	
			});
		}
		
		// 添加行程亮点
		function appendLinePoint(containerObj, ds) {
			if (ds == null || typeof(ds) == 'undefined') {
				return false;
			}
			
			var idbasestr = '';
			var tabIndex = getTabPanelIndex(containerObj);
			if (tabIndex == 1) {
				idbasestr = 'line_point';
			} else if (tabIndex == 2) {
				idbasestr = 'line_phone_point';
			} else if (tabIndex == 5) {
				idbasestr = 'line_scenery';
			} else {
				return false;
			}
			
			for (var i = 0; i < ds.length; i ++) {
				var p = ds[i];				
				// 克隆并设置新增模块属性
				var youjiObj = $('.template_youji').clone(true);
				$(youjiObj).removeClass('hidden_ctrl');
				$(youjiObj).removeClass('template_youji');
				$(youjiObj).addClass('youji');				
				$(youjiObj).attr('data-id', p.id)
				$(youjiObj).attr('data-index', p.index);
				$(youjiObj).attr('id', idbasestr + '_' + youji_ctrl_index);
				$(youjiObj).find('.offset_val').val(p.index);
				youji_ctrl_index ++;
				
				// 设置新增加模块的其他内容
//				console.log(p.content + ',type:' + typeof(p.content));
				if (p.content == '' || typeof(p.content) == 'undefined' || p.content == null) {
					$(youjiObj).find('.btn_youji_edit').remove();
					$(youjiObj).find('.youji_show_text').remove();
					$(youjiObj).find('.youji_ct_text').remove();
					$(youjiObj).find('.youji_image').attr('src', p.image_url);
				} else {
					$(youjiObj).find('.youji_image').remove();
					$(youjiObj).find('.youji_show_text').html(p.content);
					$(youjiObj).find('.youji_show_text').removeClass('hidden_ctrl');
					$(youjiObj).find('.btn_youji_edit').html('编辑');
					$(youjiObj).find('.youji_ct_text').addClass('hidden_ctrl');	
					$(youjiObj).find('.youji_text').wysihtml5({
						size: 'white',
						stylesheets: "/source/Static/assets/js/wysihtml5/lib/css/wysiwyg-color.css",
						image: false,
					});
				}					
				
				// 绑定插入按钮事件
				//bindInsertButtonToYouji(youjiObj);
				$(containerObj).append(youjiObj);	
			}
		}
				
		// 初始化游记
		$(document).ready(function(){
			// 插入文本
			$('.btn_insert_text').click(function(ev){
				ev.preventDefault();
				insertYoujiText(this);
			});
			
			// 选择并插入图片
			$('.btn_select_image').click(function(ev){
				ev.preventDefault();
				funcModalImageSelectorCallBack = insertYoujiImage;
				showModalSelectorImageDialog(this);
			});
			
			// 上传并插入图片
			$('.btn_upload_image').click(function(ev){
				ev.preventDefault();
				
				funcModalUploadCallBack = insertYoujiImage;
				showModalUploadImageDialog(this);
			});
			
			// 编辑文本
			$('.btn_youji_edit').click(function(ev){
				ev.preventDefault();
				var rootObj = $(this).closest('.youji');
				saveYoujiText(rootObj);
			});
			
			// 删除游记
			$('.btn_youji_delete').click(function(ev){
				ev.preventDefault();
				var rootObj = $(this).closest('.youji');
				deleteYouji(rootObj);				
			});
		});
	</script>
		<!-- css Reset -->
	<link rel="stylesheet" href="/source/Static/home/common/css/cssreset.css">
	<!-- 轮播样式 -->
	<link rel="stylesheet" href="/source/Static/home/common/css/slide.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="/source/Static/home/common/css/common.css">
	<!-- 私有样式 -->
	<link rel="stylesheet" href="/source/Static/home/css/content.css">
		
	<style type="text/css">
		.travel_my_pic_border{
			width: 350px;
			height:300px;
			border:1px solid #FCFCFC; 
    		overflow: hidden;
		}
		.travel_my_pic { 
   			position: relative;
		}
		.travel_day { position: relative; }
		.travel_day > .col-md-1 { position: absolute; bottom: 45px; right:0; }
		.days-img { margin-left: 15px; }
		.after_insert_travel { margin-top: 15px; }
		.show_intro { padding-left: 15px; line-height: 2; color: #666; font-size:14px; }
		.clean-img-out { position: absolute; right: 10px; top: 10px; background: rgba(0,0,0,.5); color: #fff !important; }
	</style>
	
	<!--行程模板功能按钮开始-->
	<div class="col-md-12 before_insert_travel hidden_ctrl">
		<div class="form-group">
			<button class="btn btn-secondary btn_insert_travel">添加行程</button>
		</div>
	</div>
	<div class="col-md-12 after_insert_travel hidden_ctrl">
		<div class="form-group">
			<button class="btn btn-secondary btn_insert_travel">添加行程</button>
		</div>
	</div>
	<script type="text/javascript">
		//图片距离顶部距离
		var imgOffsetTop;
		//沿途风光图片距离顶部距离
		var btnOffsetTop;
		var travel_ctrl_index = 1;
		// 添加行程操作功能按钮
		function appendInsertButtonToTravel(obj) {
			if (typeof(obj) != 'object') {
				alert('对象错误，添加插入按钮失败');
				return false;
			}
			var bFirst = $(obj).has('tab-pane');			
			if (bFirst == false) {
				if ( typeof($(obj).attr('id')) == 'undefined') {
					alert('对象错误，添加插入按钮失败');
					return false;
				}
				var beforeObj = $('.before_insert_travel').clone(true);
				var afterObj = $('.after_insert_travel').clone(true);
				$(beforeObj).removeClass('hidden_ctrl');
				$(afterObj).removeClass('hidden_ctrl');
				$(beforeObj).attr('data-id', '#'+$(obj).attr('id'));
				$(afterObj).attr('data-id', '#'+$(obj).attr('id'));
				$(obj).prepend(beforeObj);
				$(obj).append(afterObj);
			} else {
				var afterObj = $('.after_insert_travel').clone(true);
				$(afterObj).removeClass('hidden_ctrl');
				$(afterObj).attr('data-id', '.travel-arrangements-alldays');
				$(obj).find('.travel-arrangements-alldays').append(afterObj);
			}		
			return true;
		}
		
		// 移除插入按钮
		function removeInsertButtonFromTravel(obj) {
			if (typeof(obj) != 'object') {
				alert('对象错误，移除插入按钮失败');
				return false;
			}
			$(obj).find('.before_insert_travel').remove();
			$(obj).find('.after_insert_travel').remove();
			return true;
		}	
		
		// 绑定插入按钮
		function bindInsertButtonToTravel(obj) {
			if (typeof(obj) != 'object') {
				alert('对象错误，绑定插入按钮失败');
				return false;
			}
			
			$(obj).mouseenter(function(ev){
				ev.preventDefault();
				appendInsertButtonToTravel(obj);
			});
			$(obj).mouseleave(function(ev){
				ev.preventDefault();
				removeInsertButtonFromTravel(obj);
			});
			return true;
		}
		
		// 添加行程
		function insertTravelDay(obj) {
			var containerObj = $(obj).parent().parent();	// 添加按钮的容器
			var rootObj = $($(containerObj).attr('data-id'));
			var bFirst = $(rootObj).hasClass('travel-arrangements-alldays');
			var insertModebefore = false;
			var thisSortIndex = 0;
			if (bFirst == false) {
				rootObj = $(obj).closest('.travel_day');
				insertModebefore = $(containerObj).hasClass('before_insert_travel');
				thisSortIndex = parseInt($(rootObj).attr('data-index'));
			} else {
				if ($(rootObj).find('.travel_day:last').length > 0) {
					thisSortIndex = parseInt($(rootObj).find('.travel_day:last').attr('data-index'));					
				}
			}
			var new_day = insertModebefore == true ? thisSortIndex : thisSortIndex + 1;
			var jsonData = {
				op_type: 'create',
				line_id: $('#line_id').val(),
				day_id: new_day,
				day_count: $('#fwv-1').find('#travel_day').val(),
			}
			
			$.post('<?php echo U("line/travelday");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					var travelObj = $('.template_travel_day').clone(true);
					$(travelObj).removeClass('template_travel_day');
					$(travelObj).removeClass('hidden_ctrl');
					$(travelObj).addClass('travel_day');
					$(travelObj).attr('id', 'travel_day_'+travel_ctrl_index);
					$(travelObj).attr('data-id', data.id);
					$(travelObj).attr('data-index', new_day);
					travel_ctrl_index ++;
					$(travelObj).find('.day').html('第'+new_day+'天');
					$(travelObj).find('.intro').wysihtml5({
						size: 'white',
						stylesheets: "/source/Static/assets/js/wysihtml5/lib/css/wysiwyg-color.css",
						image: false,
					});
					$(travelObj).find('.kindly_reminder').wysihtml5({
						size: 'white',
						stylesheets: "/source/Static/assets/js/wysihtml5/lib/css/wysiwyg-color.css",
						image: false,
					});
					// 其他行程索引偏移
					if (bFirst == false) {
						$('.travel-arrangements-alldays').find('travel_day').each(function(i, el){
							var dayId = parseInt($(el).attr('data-index'));
							if (dayId >= new_day) {
								var realDayId = dayId+1;
								alert(realDayId);
								$(el).attr('data-index', realDayId);
								$(el).find('.show_day').html(realDayId);
								$(el).find('.day').html('第'+realDayId+'天');
							}
						});
					}
					// 绑定事件
					bindInsertButtonToTravel(travelObj);
					// 加入行程列表
					if (insertModebefore) {						
						bFirst == false ? $(rootObj).before(travelObj) : $(rootObj).prepend(travelObj);
					} else {
						bFirst == false ? $(rootObj).after(travelObj) : $(rootObj).append(travelObj);
					}
				} else {
					alert(data.result.message);
				}
			});			
		}
		
		// 显示编辑
		function showEditTravelDay(rootObj, bshow) {
			if (bshow) {
				$(rootObj).find('.hidden_ctrl').each(function(i, el){
					if ($(el).parent().parent().hasClass('travel_my_pic_border') == false){
						$(el).removeClass('hidden_ctrl');
						$(el).prev().addClass('hidden_ctrl');		
					}
				});
			} else {
				$(rootObj).find('.hidden_ctrl').each(function(i, el){
					if ($(el).parent().parent().hasClass('travel_my_pic_border') == false){
						$(el).removeClass('hidden_ctrl');
						$(el).next().addClass('hidden_ctrl');	
					}
				});
			}
		}
		
		// 编辑行程
		function editTravelDay(rootObj) {
			var travelObj = $(rootObj).find('.travel-arrangements-days');
			$(travelObj).find('.day').val('第'+$(travelObj).find('.show_day').html()+'天');
			$(travelObj).find('.title').val($(travelObj).find('.show_title').html());
			var vhtml = $(travelObj).find('.show_intro').html();
			$(travelObj).find('.intro').data('wysihtml5').editor.setValue(vhtml);
			$(travelObj).find('.hotel').val($(travelObj).find('.show_hotel').html());
			$(travelObj).find('.eat_way').val($(travelObj).find('.show_eat_way').html());
			$(travelObj).find('.view_point').val($(travelObj).find('.show_view_point').html());
			var vhtml = $(travelObj).find('.prompt').html();
			$(travelObj).find('.kindly_reminder').data('wysihtml5').editor.setValue(vhtml);
			showEditTravelDay(rootObj,true);
		}
		
		// 保存行程
		function saveTravelDay(rootObj) {
			var aid = $(rootObj).attr('data-id');
			var introText = $(rootObj).find('.intro').data('wysihtml5').editor.getValue();
			var kindlyText = $(rootObj).find('.kindly_reminder').data('wysihtml5').editor.getValue();
			var jsonData = {
				op_type: aid == 0 ? 'create' : 'save',
				id: aid,
				title: $(rootObj).find('.title').val(),
				intro: introText,
				hotel: $(rootObj).find('.hotel').val(),
				eat_way: $(rootObj).find('.eat_way').val(),
				view_point: $(rootObj).find('.view_point').val(),
				kindly_reminder: kindlyText,
			}
			
			for (var i = 1; i <= 3; i ++) {				
				var imgSrc = $(rootObj).find('.img'+i).attr('src');
				var imgDesc = $(rootObj).find('.img'+i).next().find('span').html();
				if (imgSrc != '') {
					var imgKey = 'img'+i;
					jsonData[imgKey] = imgSrc;
				} 				
				if (imgDesc != '双击设置描述,双击保存') {
					var imgDescKey = 'img'+i+'_desc';
					jsonData[imgDescKey] = imgDesc;
				}	
			}
			
			if (aid == 0) {
				jsonData['line_id'] = $('#line_id').val();
				jsonData['day_id'] = $(rootObj).attr('data-index');
			}
			
			$.post('<?php echo U("line/travelday");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					var travelObj = $(rootObj).find('.travel-arrangements-days');
					if (typeof(data.ds.id) != 'undefined') {
						$(rootObj).attr('data-id', data.ds.id);	
					}
					$(rootObj).attr('data-index', data.ds.day_id);
					$(travelObj).find('.show_day').html(data.ds.day_id);
					$(travelObj).find('.show_title').html(data.ds.title);
					$(travelObj).find('.show_intro').html(introText);
					$(travelObj).find('.show_hotel').html(data.ds.hotel);
					$(travelObj).find('.show_eat_way').html(data.ds.eat_way);
					$(travelObj).find('.show_view_point').html(data.ds.view_point);
					$(travelObj).find('.prompt').html(kindlyText);
					showEditTravelDay(rootObj,false);
				} else {
					alert(data.result.message);
				}
			});	
		}
		
		// 删除行程
		function deleteTravelDay(rootObj) {		
			var aid = $(rootObj).attr('data-id');
			if (aid == '0') {
				alert('数据未存入数据库,不能删除');
				return false;
			}
			var dayIndex = $(rootObj).attr('data-index');
			
			$.post('<?php echo U("line/travelday");?>', {op_type:'delete', id:aid}, function(data){
				if (data.result.errno == 0) {
					// 其他行程索引偏移
					$('.travel-arrangements-alldays').find('.travel_day').each(function(i, el){
						var dayId = parseInt($(el).attr('data-index'));
						if (dayId >= dayIndex) {
							var realDayId = dayId-1;
							$(el).attr('data-index', realDayId);
							$(el).find('.show_day').html(realDayId);
							$(el).find('.day').html('第'+realDayId+'天');
						}
					});					
					$(rootObj).remove();
				} else {
					alert(data.result.message);
				}
			});	
		}
		
		// 添加行程详细
		function appendTravelDay(ds) {
			if (ds == null || typeof(ds) == 'undefined') {
				return false;
			}
			var rootObj = $('.travel-arrangements-alldays');
			for (var i = 0; i < ds.length; i ++) {
				var t = ds[i];				
				var travelObj = $('.template_travel_day').clone(true);
				$(travelObj).removeClass('template_travel_day');
				$(travelObj).removeClass('hidden_ctrl');
				$(travelObj).addClass('travel_day');
				$(travelObj).attr('id', 'travel_day_'+travel_ctrl_index);
				$(travelObj).attr('data-id', t.id);
				$(travelObj).attr('data-index', t.day_id);
				travel_ctrl_index ++;
				
				$(travelObj).find('.kindly_reminder').wysihtml5({
					size: 'white',
					stylesheets: "/source/Static/assets/js/wysihtml5/lib/css/wysiwyg-color.css",
					image: false,
				});
				
				$(travelObj).find('.intro').wysihtml5({
					size: 'white',
					stylesheets: "/source/Static/assets/js/wysihtml5/lib/css/wysiwyg-color.css",
					image: false,
				});
				
				// 设置其他元素内容					
				$(travelObj).find('.show_day').html(t.day_id);
				$(travelObj).find('.show_title').html(t.title);
				$(travelObj).find('.show_intro').html(t.intro);
				$(travelObj).find('.show_hotel').html(t.hotel);
				$(travelObj).find('.show_eat_way').html(t.eat_way);
				$(travelObj).find('.show_view_point').html(t.view_point);
				$(travelObj).find('.prompt').html(t.kindly_reminder);
				
				var img1Desc = t.img1_desc == '点击添加选择图片' || t.img1_desc == '' || t.img1_desc == null ? '双击设置描述,再次双击保存' : t.img1_desc;
				$(travelObj).find('.img1').attr('src', t.img1);
				$(travelObj).find('.img1').next().find('span').html(img1Desc);
				
				var img2Desc = t.img2_desc == '点击添加选择图片' || t.img2_desc == '' || t.img2_desc == null ? '双击设置描述,再次双击保存' : t.img2_desc;
				$(travelObj).find('.img2').attr('src', t.img2);
				$(travelObj).find('.img2').next().find('span').html(img2Desc);
				
				var img3Desc = t.img3_desc == '点击添加选择图片' || t.img3_desc == '' || t.img3_desc == null ? '双击设置描述,再次双击保存' : t.img3_desc;
				$(travelObj).find('.img3').attr('src', t.img3);
				$(travelObj).find('.img3').next().find('span').html(img3Desc);
				
				$(travelObj).find('.btn_travel_edit').html('编辑');
				
				// 隐藏编辑
				showEditTravelDay(travelObj, false);
				
				// 绑定事件
				bindInsertButtonToTravel(travelObj);
				
				// 加入行程列表
				$(rootObj).append(travelObj)
			}
		}
		//回到点击位置
		function goImgTop(e){
			$(e).click(function(){
				$('body,html').animate({'scrollTop':imgOffsetTop - 100},100);
			})
		}
		
		function goBtnTop(e){
			$(e).click(function(){
				$('body,html').animate({'scrollTop':btnOffsetTop},100);
				console.log(btnOffsetTop);
			})
		}
		
		// 更换行程图片
		function changeTravelDayImage(imageObj, imageList) {
			var rootObj = $(imageObj).closest('.travel_day');
			var jsonData = {
				op_type: 'save',
				id: $(rootObj).attr('data-id'),
			};
			if ($(imageObj).hasClass('img1')) {
				jsonData['img1'] = imageList[0];
			} else if($(imageObj).hasClass('img2')) {
				jsonData['img2'] = imageList[0];
			} else {
				jsonData['img3'] = imageList[0];
			}
			$.post('<?php echo U("line/travelday");?>', jsonData, function(data){
				if (data.result.errno == 0)	{
					goBtnTop($('#gallery-image-upload-modal').find('.btn-use'));
					$(imageObj).attr('src', imageList[0]);
				} else {
					alert(data.result.message);
				}
			});
		}
		
		// 设置行程图片描述
		function setTravelDayImageDesc(pObj) {
			var rootObj = $(pObj).closest('.travel_day');
			var bset = $(pObj).find('span').hasClass('hidden_ctrl');
			if (bset) {
				var desc = $(pObj).find('input').val();
				var jsonData = {
					op_type: 'save',
					id: $(rootObj).attr('data-id'),
				};
				if ($(pObj).prev().hasClass('img1')) {
					jsonData['img1_desc'] = desc;
				} else if ($(pObj).prev().hasClass('img2')) {
					jsonData['img2_desc'] = desc;
				} else {
					jsonData['img3_desc'] = desc;
				}
				$.post('<?php echo U("line/travelday");?>', jsonData, function(data){
					if (data.result.errno == 0)	{
						$(pObj).find('span').html(desc);
					} else {
						alert(data.result.message);
					}
					$(pObj).find('span').removeClass('hidden_ctrl');
					$(pObj).find('span').next().addClass('hidden_ctrl');
				});
			} else {
				$(pObj).find('span').addClass('hidden_ctrl');
				$(pObj).find('span').next().removeClass('hidden_ctrl');
				$(pObj).find('input').focus();
				$(pObj).find('input').val($(pObj).find('span').html());
			}
		}		
			
		
		
		// 行程初始化
		$(document).ready(function(){
			// 添加行程
			$('.btn_insert_travel').click(function(ev){
				ev.preventDefault();
				insertTravelDay(this);
			});
			
			// 编辑行程
			$('.btn_travel_edit').click(function(ev){		
				ev.preventDefault();		
				var rootObj = $(this).closest('.travel_day');
				var btnText = $(this).html();
				if (btnText == '保存') {
					$(this).html('编辑');
					saveTravelDay(rootObj)
				} else {
					$(this).html('保存');
					editTravelDay(rootObj);	
				}
			});
			
			// 删除行程
			$('.btn_travel_delete').click(function(ev){		
				ev.preventDefault();		
				var rootObj = $(this).closest('.travel_day');
				deleteTravelDay(rootObj);
			});
			
			
			// 更换图片
			$('.travel_my_pic').click(function(ev){
				ev.preventDefault();
				//获取图片距离顶部距离
				imgOffsetTop = $(this).offset().top;
				
				funcModalImageSelectorCallBack = changeTravelDayImage;
				showModalSelectorImageDialog(this);
			});	
			
			
			$('.btn_select_image').click(function(){
				//获取图片距离顶部距离
				btnOffsetTop = $(this).offset().top;
			});
			$('.btn_upload_image').click(function(){
				//获取图片距离顶部距离
				btnOffsetTop = $(this).offset().top;
			});
			
			
			//showModalSelectorImageDialog  结束后可以归位
			
			goImgTop('.close');
			goImgTop($('#gallery-image-selector-modal').find('.btn-secondary'));
			goImgTop($('#gallery-image-selector-modal').find('.btn-white'));
			
			goBtnTop('.close');
			goBtnTop($('#gallery-image-selector-modal').find('.btn-secondary'));
			goBtnTop($('#gallery-image-selector-modal').find('.btn-white'));		
			goBtnTop($('#gallery-image-upload-modal').find('.btn-white'));
			goBtnTop($('#gallery-image-upload-modal').find('.btn-use'));
			
			
			// 设置图片描述
			$('.travel_my_pic_border p').dblclick(function(ev){
				ev.preventDefault();
				setTravelDayImageDesc(this);
			});	
			
			// 清除图片
			$(document).on('click','.travel_my_pic_border .clean-img-out',function(ev){
				ev.preventDefault();
				var imgObj = $(this).parent().find('.travel_my_pic');
				
				changeTravelDayImage(imgObj, ['']);				
			});
					
		});
	</script>
	<!--行程模板开始-->
	<div class="row template_travel_day hidden_ctrl" data-id="0">
		<div class="col-md-11">
			<div class="travel-arrangements-days">
				<div class="row">						
					<h4 class="hidden_ctrl">Day<span class="show_day">1</span>：<span class="show_title"></span></h4>				
					<div class="col-md-6">
						<div class="form-group">
							<h4 class="day"></h4>
						</div>
						<div class="form-group">
							<label class="control-label" for="title">行程标题：</label>
							<input class="form-control title" placeholder="请输入行程的标题" />
						</div>
					</div>
				</div>
				
				<div class="row">
					<p class="hidden_ctrl show_intro"></p>									
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="intro">行程描述：</label>
							<textarea class="form-control autogrow intro" placeholder="请输入行程的安排及描述"></textarea>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12 days-information hidden_ctrl">
						<span><i class="days-zs"></i>住宿：<span class="show_hotel"></span></span>
						<span><i class="days-cy"></i>餐饮：<span class="show_eat_way"></span></span>
						<span><i class="days-zd"></i>浏览重点：<span class="show_view_point"></span></span>
					</div>
					<div class="col-md-12">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="hotel">入驻宾馆：</label>
								<input class="form-control hotel" placeholder="请输入入驻宾馆"/>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="eat_way">就餐说明：</label>
								<input class="form-control eat_way" placeholder="请输入就餐说明"/>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="view_point">参观重点：</label>
								<input class="form-control view_point" placeholder="请输入重点参观项目"/>
							</div>
						</div>
					</div>
				</div>
								
				<div class="row">
					<div class="col-md-12 days-prompt hidden_ctrl">
						<span><i class="days-ts"></i>温馨提示：</span>
						<div class="prompt"></div>		
					</div>	
					<div class="col-md-12">							
						<div class="form-group">
							<label class="control-label" for="kindly_reminder">温馨提示：</label>
							<textarea class="form-control kindly_reminder" placeholder="请编辑温馨提示内容"></textarea>
						</div>
					</div>					
				</div>
				
				<div class="row">
					<div class="row days-img">
						<div class="days-img-left travel_my_pic_border">
							<img class="img1 travel_my_pic" src="" alt="请选择图片">
							<a href="javascript:;" class="btn clean-img-out">清除</a>
							<p style="bottom: -42px;">
								<span>双击设置描述,双击保存</span>
								<input type="text" class="form-control has-success hidden_ctrl" />
							</p>
						</div>
						<div class="days-img-left travel_my_pic_border">
							<img class="img2 travel_my_pic" src="" alt="请选择图片">
							<a href="javascript:;" class="btn clean-img-out">清除</a>
							<p style="bottom: -42px;">
								<span>双击设置描述,双击保存</span>
								<input type="text" class="form-control has-success hidden_ctrl"/>
							</p>
						</div>
						<div class="days-img-left travel_my_pic_border">
							<img class="img3 travel_my_pic" src="" alt="请选择图片">
							<a href="javascript:;" class="btn clean-img-out">清除</a>
							<p style="bottom: -42px;">
								<span>双击设置描述,双击保存</span>
								<input type="text" class="form-control has-success hidden_ctrl"/>
							</p>
						</div>
					</div>
					<div class="row">
						<span style="margin-left:50px; color: red;">行程图片新旅拍规格[650x450],其他规格[385x260]</span>
					</div>
				</div>
			</div> <!--结束一天安排-->
		</div>
		<div class="col-md-1">
			<div class="form-group">
				<button class="btn btn-secondary btn_travel_edit">保存</button>
				<button class="btn btn-danger btn_travel_delete">删除</button>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">		
		//days图片描述
		$('.days-img-left').hover(
			function () {
				$(this).children('p').stop().animate({ bottom: '0' }, 500);
			},
			function () {
				$(this).children('p').stop().animate({ bottom: '-42px' }, 500);
			}
		);
		$('.days-img-right').hover(
			function () {
				$(this).children('p').stop().animate({ bottom: '0' }, 500);
			},
			function () {
				$(this).children('p').stop().animate({ bottom: '-42px' }, 500);
			}
		);
	</script>
	<form role="forl" id="rootwizard" class="form-wizard validate">
		<ul class="tabs">
			<li class="active">
				<a href="#fwv-1" data-toggle="tab">
					基本信息
				</a>
			</li>
			<li>
				<a href="#fwv-2" data-toggle="tab">
					PC行程亮点
				</a>
			</li>
			<li>
				<a href="#fwv-3" data-toggle="tab">
					手机行程亮点
				</a>
			</li>
			<li>
				<a href="#fwv-4" data-toggle="tab">
					行程说明
				</a>
			</li>
			<li>
				<a href="#fwv-5" data-toggle="tab">
					其他设置
				</a>
			</li>
			<li>
				<a href="#fwv-6" data-toggle="tab">
					沿途风光
				</a>
			</li>
			<li>
				<a href="#fwv-7" data-toggle="tab">
					产品问答
				</a>
			</li>
			<li>
				<a href="#fwv-8" data-toggle="tab">
					产品批次
				</a>
			</li>
			<li>
				<a href="#fwv-9" data-toggle="tab">
					产品优惠
				</a>
			</li>
		</ul>
		
		<div class="progress-indicator">
			<span></span>
		</div>
		
		<div class="tab-content no-margin" style="background-color: 0f0;">
			
			<!-- Tabs Content -->
			<div class="tab-pane with-bg active" id="fwv-1">
				
				
				<style type="text/css">
					.line_my_pic_border{
						position: relative; 
						float: left;
						width: 350px;
						height:300px;
						border:1px solid #FCFCFC; 
			    		overflow: hidden;
					}
					.line_my_pic { 
			   			position: relative;
					}
				</style>
				
				<div class="row">					
					<div class="col-md-12">						
						<div class="form-group">
							<label class="control-label">产品展示图片 &nbsp;&nbsp;<span style="color:red;">(注:图1:新旅拍规格[936x702],其他规格[620x465];图2:新旅拍规格[1000x625],其他暂不使用;图3、图4暂无他用)</label>
							<div>
								<div class="line_my_pic_border">
									<img class="img1 line_my_pic" src="/source/Static/home/images/content_img/days1.jpg" alt="请点击选择图片" />
								</div>
								<div class="line_my_pic_border">
									<img class="img2 line_my_pic" src="/source/Static/home/images/content_img/days2.jpg" alt="请点击选择图片" />
								</div>
								<div class="line_my_pic_border">
									<img class="img3 line_my_pic" src="/source/Static/home/images/content_img/days3.jpg" alt="请点击选择图片" />
								</div>
								<div class="line_my_pic_border">
									<img class="img4 line_my_pic" src="/source/Static/home/images/content_img/days4.jpg" alt="请点击选择图片" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<br />
				<br />
	
				<div class="row">					
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="full_name">产品标题<span style="color: red;">(*产品标题不能超出11个字)</span></label> <!--data-validate="required"-->
							<input class="form-control" name="full_name" id="full_name" placeholder="请输入产品的标题,并控制内容在16个字符以内" maxlength="11" />
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="second_name">产品长标题</label> <!--data-validate="required"-->
							<input class="form-control" name="second_name" id="second_name" placeholder="请输入产品的副标题" />
						</div>
					</div>					
				</div>
				
				<div class="row">					
					<div class="col-md-1">
						<div class="form-group">
							<label class="control-label" for="adult_price">成人起步价格</label>
							<input class="form-control" name="adult_price" id="adult_price" data-validate="number" value="0.00" />
						</div>
					</div>
					
					<div class="col-md-1">
						<div class="form-group">
							<label class="control-label" for="child_price">小孩起步价</label>
							<input class="form-control" name="child_price" id="child_price" data-validate="number" value="0.00" />
						</div>
					</div>
					
					<!--<div class="col-md-1">
						<div class="form-group">
							<label class="control-label" for="receipt_price">发票邮费</label>
							<input class="form-control" name="receipt_price" id="receipt_price" data-validate="number" value="20.00" />
						</div>
					</div>-->
					
					<div class="col-md-1">
						<div class="form-group">
							<label class="control-label" for="line_score">线路积分</label>
							<input class="form-control" name="line_score" id="line_score" data-validate="number" value="1" />
						</div>
					</div>
					
					<div class="col-md-1">
						<div class="form-group">
							<label class="control-label" for="success_count">成团人数</label>
							<input class="form-control" name="success_count" id="success_count" data-validate="number" value="1"/>
						</div>
					</div>	
					
					<div class="col-md-1">
						<div class="form-group">
							<label class="control-label" for="max_count">满团人数</label>
							<input class="form-control" name="max_count" id="max_count" data-validate="number" value="1"/>
						</div>
					</div>	
					
					<div class="col-md-1">
						<div class="form-group">
							<label class="control-label" for="start_time">开始日期</label>
							<input class="form-control datepicker" name="start_time" id="start_time" data-start-view="1"  data-start-date="0d" placeholder="请选择开始日期" data-format="yyyy-mm-dd"  />
						</div>
					</div>
					
					<div class="col-md-1">
						<div class="form-group">
							<label class="control-label" for="end_time">截止日期</label>
							<input class="form-control datepicker" name="end_time" id="end_time" data-start-view="1"  data-start-date="+1d" placeholder="请选择结束日期" data-format="yyyy-mm-dd" />
						</div>
					</div>
					
					<div class="col-md-1">
						<div class="form-group">						
							<label class="control-label" for="travel_day">行程天数（天）</label>
							<script type="text/javascript">
								$(document).ready(function(){
									var travel_day_type = $("#travel_day").selectBoxIt();
									for (var i = 1; i < 31; i ++) {							
										$(travel_day_type).data('selectBox-selectBoxIt').add({value:i, text:i+'天'});
									}
								});
							</script>
							<select name="travel_day" id="travel_day" class="form-control">
							</select>						
						</div>
					</div>
					
					<div class="col-md-1">
						<div class="form-group">
							<label class="control-label" for="seek_qq">咨询QQ</label>
							<input class="form-control" name="seek_qq" id="seek_qq" data-validate="number" value="15"/>
						</div>
					</div>
					
					<div class="col-md-1">
						<div class="form-group">
							<label class="control-label" for="qq_verify">咨询QQ验证信息</label>
							<input class="form-control" name="qq_verify" id="qq_verify" data-validate="text" value="31"/>
						</div>
					</div>	
					
					<!--<div class="col-md-1">
						<div class="form-group">
							<label class="control-label" for="click_count">点击量</label>
							<input class="form-control" name="click_count" id="click_count" data-validate="number" value="10"/>
						</div>
					</div>-->	
				</div>
				
				<div class="row">										
				
					<?php if($admin['station_id_data']['attached'] === '1'): ?><div class="col-md-1">
							<div class="form-group">						
								<label class="control-label" for="qinglvpai">轻旅拍</label>
								<script type="text/javascript">
									$(document).ready(function(){
										var qinglvpai_type = $("#qinglvpai").selectBoxIt();
										$(qinglvpai_type).data('selectBox-selectBoxIt').add({value:0, text:'非轻旅拍产品'});
										$(qinglvpai_type).data('selectBox-selectBoxIt').add({value:1, text:'全部均可使用'});
										$(qinglvpai_type).data('selectBox-selectBoxIt').add({value:2, text:'仅轻旅拍使用'});
									});
								</script>
								<select name="qinglvpai" id="qinglvpai" class="form-control">
								</select>						
							</div>
						</div><?php endif; ?>
										
					<?php if($admin[account] === 'admin'): ?><div class="col-md-1">						
							<div class="form-group">
								<label class="control-label" for="distribute">分销线路</label><br />							
							    <input id="distribute" name="distribute" type="checkbox" class="iswitch iswitch-secondary">
							</div>						
						</div>
										
						<div class="col-md-1">
							<div class="form-group">
								<label class="control-label" for="commision_adult">成人分销佣金</label>
								<input class="form-control" name="commision_adult" id="commision_adult" data-validate="number" value="0.00" />
							</div>
						</div>
										
						<div class="col-md-1">
							<div class="form-group">
								<label class="control-label" for="commision_child">儿童分销佣金</label>
								<input class="form-control" name="commision_child" id="commision_child" data-validate="number" value="0.00" />
							</div>
						</div><?php endif; ?>
					<div class="col-md-1">						
						<div class="form-group">
							<label class="control-label" for="hot_line">全网爆款</label><br />							
						    <input id="hot_line" name="hot_line" type="checkbox" class="iswitch iswitch-secondary">
						</div>						
					</div>
					
					<div class="col-md-1">											
						<div class="form-group">
							<label class="control-label" for="recommend_line">极致体验</label><br />							
						    <input id="recommend_line" name="recommend_line"  type="checkbox" class="iswitch iswitch-secondary">
						</div>							
					</div>	
					
					<div class="col-md-1">						
						<div class="form-group">
							<label class="control-label" for="leader_recommend">高性价比</label><br />							
						    <input id="leader_recommend" name="leader_recommend" type="checkbox" class="iswitch iswitch-secondary">
						</div>						
					</div>
					
					<div class="col-md-1">											
						<div class="form-group">
							<label class="control-label" for="time_preference">限时特惠</label><br />							
						    <input id="time_preference" name="time_preference"  type="checkbox" class="iswitch iswitch-secondary">
						</div>							
					</div>	
					
					<div class="col-md-1">											
						<div class="form-group">
							<label class="control-label" for="check_price">价格核算中</label><br />							
						    <input id="check_price" name="check_price"  type="checkbox" class="iswitch iswitch-secondary">
						</div>							
					</div>
					
					<div class="col-md-1">						
						<div class="form-group">
							<label class="control-label" for="extra_line">外链线路</label><br />							
						    <input id="extra_line" name="extra_line" type="checkbox" class="iswitch iswitch-secondary">
						</div>						
					</div>				
				</div>
				
				<?php if($admin['station_id_data']['attached'] === '1'): ?><div class="row">
												
						<div class="col-md-5">						
							<div class="form-group">
								<label class="control-label" for="old_pc_line">绑定旧PC端线路</label>
								<input class="form-control" type="text" name="old_pc_line" id="old_pc_line" />
							</div>
						</div>
												
						<div class="col-md-5">						
							<div class="form-group">
								<label class="control-label" for="old_pc_line">绑定旧手机端线路</label>
								<input class="form-control" type="text" name="old_phone_line" id="old_phone_line" />
							</div>
						</div>						
					</div><?php endif; ?>
				
				<div class="row">							
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="start_price_explain">起价说明</label>
							<textarea class="form-control autogrow" name="start_price_explain" id="start_price_explain" placeholder="请输入产品起价说明"></textarea>
						</div>
					</div>		
											
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="send_word">产品寄语</label>
							<textarea class="form-control autogrow" name="send_word" id="send_word" placeholder="请输入产品寄语"></textarea>
						</div>
					</div>							
				</div>
				
				<div class="row">								
					<div class="col-md-2">						
						<div class="form-group">
							<label class="control-label" for="member_type">允许参团人类型<span style="color:red;">(*必选)</span></label>
							<input class="form-control" type="text" name="member_type" id="member_type" />
						</div>							
					</div>	
					
					<div class="col-md-2">
						<div class="form-group">						
							<label class="control-label" for="pay_type">付款方式<span style="color:red;">(*必选)</span></label>
							<input class="form-control" type="text" name="pay_type" id="pay_type" />						
						</div>
					</div>		
							
					<div class="col-md-2">						
						<div class="form-group">
							<label class="control-label" for="trip_traffic">出行方式</label>
							<input class="form-control" type="text" name="trip_traffic" id="trip_traffic" />
						</div>							
					</div>		
							
					<div class="col-md-2">						
						<div class="form-group">
							<label class="control-label" for="manager_admin">负责经理</label>
							<input class="form-control" type="text" name="manager_admin" id="manager_admin" />
						</div>							
					</div>		
							
					<div class="col-md-2">						
						<div class="form-group">
							<label class="control-label" for="operator_admin">负责计调</label>
							<input class="form-control" type="text" name="operator_admin" id="operator_admin" />
						</div>							
					</div>										
				</div>	
				
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="assembly_point">所属站点</label>
							<input class="form-control" type="text" name="station" id="station" />
						</div>
					</div>
								
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="assembly_point">集合地点</label>
							<input class="form-control" type="text" name="assembly_point" id="assembly_point" />
						</div>
					</div>
								
					<div class="col-md-4">
						<div class="form-group">				
							<label class="control-label" for="dismiss_place">散团地点</label>
							<input class="form-control" type="text" id="dismiss_place" />							
						</div>
					</div>							
				</div>
				
				<div class="row">
					<div class="col-md-3">						
						<div class="form-group">
							<label class="control-label" for="theme_type">旅行主题</label>
							<input class="form-control" type="text" id="theme_type" />
						</div>							
					</div>	
					
					<div class="col-md-3">						
						<div class="form-group">
							<label class="control-label" for="theme_type">产品区域</label>
							<input class="form-control" type="text" id="line_area" />
						</div>							
					</div>
					
					<div class="col-md-6">						
						<div class="form-group">
							<label class="control-label" for="play_type">体验内容</label>
							<input class="form-control" type="text" id="play_type" />
						</div>							
					</div>		
				</div>						
				
				<div class="row">
					
					<div class="col-md-6">
						<div class="form-group">						
							<label class="control-label" for="destination">目的地</label>
							<input class="form-control" type="text" id="destination" />			
						</div>
					</div>	
					
					<div class="col-md-6">						
						<div class="form-group">
							<label class="control-label" for="view_point">景点包含</label>
							<input class="form-control" type="text" id="view_point" />
						</div>							
					</div>	
				</div>
				
				<div class="row">					
					<div class="col-md-6">						
						<div class="form-group">
							<label class="control-label" for="hotel_type">酒店类别</label>
							<input class="form-control" type="text" id="hotel_type" />
						</div>							
					</div>										
							
					<div class="col-md-6">						
						<div class="form-group">
							<label class="control-label" for="trip_month">出行月份</label>
							<input class="form-control" type="text" id="trip_month" />
						</div>							
					</div>	
				</div>
				
				<div class="row">
					<div class="col-md-12">						
						<div class="form-group">
							<label class="control-label" for="largess">赠送物品</label>
							<input class="form-control" type="text" id="largess" />
						</div>							
					</div>	
				</div>
																
				<div class="row">					
					<div class="col-md-12">						
						<div class="form-group">
							<label class="control-label" for="cost_description">费用说明</label>
							<script type="text/javascript">
								$(document).ready(function(){
									$('#cost_description').wysihtml5({
										size: 'white',
										stylesheets: "/source/Static/assets/js/wysihtml5/lib/css/wysiwyg-color.css",
										image: false,
									});
								});
							</script>
							<textarea class="form-control" id="cost_description" name="cost_description"></textarea>
						</div>							
					</div>					
				</div>
				
				<div class="row">					
					<div class="col-md-12">						
						<div class="form-group">
							<label class="control-label" for="booking_notes">预订须知</label>
							<script type="text/javascript">
								$(document).ready(function(){
									$('#booking_notes').wysihtml5({
										size: 'white',
										stylesheets: "/source/Static/assets/js/wysihtml5/lib/css/wysiwyg-color.css",
										image: false,
									});
								});
							</script>
							<textarea class="form-control" id="booking_notes" name="booking_notes"></textarea>
						</div>							
					</div>					
				</div>
				<div class="row">					
					<div class="col-md-12">						
						<div class="form-group">
							<button class="btn btn-secondary btn_save_info">保存基本信息</button>
						</div>							
					</div>					
				</div>
				
				<script type="text/javascript">	
					$(document).ready(function(){						
						var ds = {tab:'archives', prefix: 'xz_', show_col:'title'}
						bindSelect2DropMenu($('#old_pc_line'), ds, '选择绑定的旧PC端线路', false, false);
						bindSelect2DropMenu($('#old_phone_line'), ds, '选择绑定的旧手机端线路', false, false);	
						bindTypeDataDropMenu($('#member_type'), 'line_member_type', '选择产品的参团人类型');
						bindTypeDataDropMenu($('#pay_type'), 'line_pay_type', '选择产品的付款方式');	
						bindTypeDataDropMenu($('#trip_traffic'), 'line_trip_traffic', '选择产品的出行交通');
						bindAdminDropMenu($('#manager_admin'), '', '选择产品的负责经理');
						bindAdminDropMenu($('#operator_admin'), 'operator', '选择产品的负责计调');
						ds = {tab:'station_info', show_col:'name'}
						bindSelect2DropMenu($('#station'), ds, '选择产品所属的站点', false, true);
						bindTypeDataDropMenu($('#assembly_point'), 'line_assembly_point', '选择产品的集合地点,可输入内容筛选', true, true, true);
						bindTypeDataDropMenu($('#dismiss_place'), 'line_dismiss_place', '选择产品的散团地点,可输入内容筛选', true, true, true);
						bindTypeDataDropMenu($('#theme_type'), 'line_theme', '选择产品的旅行主题,可输入内容筛选', false, false, true);
						bindTypeDataDropMenu($('#line_area'), 'line_area', '选择产品的区域,可输入内容筛选', false, false, true);
						bindTypeDataDropMenu($('#play_type'), 'line_play_type', '选择产品所提供的体验内容,可输入内容筛选', true, false, true);
						bindTypeDataDropMenu($('#destination'), 'line_destination', '选择产品到达的目的地,可输入内容筛选', true, false, true);
						bindTypeDataDropMenu($('#view_point'), 'line_view_point', '选择产品包含的项目景点,可输入内容筛选', true, false, true);
						bindTypeDataDropMenu($('#hotel_type'), 'line_hotel_type', '选择产品所提供的住宿特色,可输入内容筛选', true, false, true);
						bindTypeDataDropMenu($('#trip_month'), 'month', '选择产品所在的出行月份,可输入内容筛选', false, false, true);
						bindTypeDataDropMenu($('#largess'), 'line_largess', '请选择赠送物品,可输入内容筛选', false, false, true);
					});
				
					// 获取复选框值
					function getCheckBoxValueStr(ckObj) {
						var str = '';
						$(ckObj).find(':checked').each(function(i, el){
							if (str != '') {
								str += ',';
							}
							str += $(el).val();
						});
						return str;
					}
					
					// 设置复选框值
					function setCheckBoxValueByStr(ckObj, valstr){
						$(ckObj).each(function(i, el) {
							var val = $(el).attr('value');
							if (valstr.indexOf(val) != -1) {
								$(el).prop('checked', true);
							} else {
								$(el).prop('checked', false);
							}
						})
					}
					
					// 获取基本信息
					function getLineBaseInfo() {
						var costDescription = $('#cost_description').data('wysihtml5').editor.getValue();
						var bookingNotes = $('#booking_notes').data('wysihtml5').editor.getValue();
						var jsonData = {
							id: $('#line_id').val(),
							title: $('#full_name').val(),
							subheading: $('#second_name').val(),
							start_price_adult: $('#adult_price').val(),
							start_price_child: $('#child_price').val(),
//							receipt_price: $('#receipt_price').val(),
							line_score: $('#line_score').val(),
							success_team_count: $('#success_count').val(),
							max_team_count: $('#max_count').val(),
							start_time: $('#start_time').val(),
							end_time: $('#end_time').val(),
							travel_day: $('#travel_day').val(),
							seek_qq:$('#seek_qq').val(),
							qq_verify:$('#qq_verify').val(),
//							click_count:$('#click_count').val(),
							hot: $('#hot_line').prop('checked') ? 1 : 0,
							recommend: $('#recommend_line').prop('checked') ? 1 : 0,
							leader_recommend: $('#leader_recommend').prop('checked') ? 1 : 0,
							time_preference: $('#time_preference').prop('checked') ? 1 : 0,
							check_price: $('#check_price').prop('checked') ? 0 : 1,
							extra: $('#extra_line').prop('checked') ? 1 : 0,
							start_price_explain: $('#start_price_explain').val(),
							send_word: $('#send_word').val(),
							member_type: getSelect2Value('#member_type'),
							allow_pay_type: getSelect2Value('#pay_type'),
							trip_traffic: getSelect2Value('#trip_traffic'),
							manager_admin: getSelect2Value('#manager_admin',['id','account']),
							operator_admin: getSelect2Value('#operator_admin',['id','account']),
							station: getSelect2Value('#station',['id','key','name']),
							dismiss_place: getSelect2Value('#dismiss_place'),
							assembly_point: getSelect2Value('#assembly_point'),
							theme_type: getSelect2Value('#theme_type'),
							line_area: getSelect2Value('#line_area'),
							play_type: getSelect2Value('#play_type'),
							destination: getSelect2Value('#destination'),
							view_point: getSelect2Value('#view_point'),
							hotel_type: getSelect2Value('#hotel_type'),
							trip_month: getSelect2Value('#trip_month'),
							largess: getSelect2Value('#largess'),
							cost_description: costDescription,
							booking_notes: bookingNotes,
							img1: $('.line_my_pic .img1').attr('src'),
							img2: $('.line_my_pic .img2').attr('src'),
							img3: $('.line_my_pic .img3').attr('src'),
							img4: $('.line_my_pic .img4').attr('src'),
						}
						
						if ('<?php echo ($admin["station_id_data"]["attached"]); ?>' == '1') {
							qinglvpai: $('#qinglvpai').val();
							old_pc_line: getSelect2Value('#old_pc_line',['id','title']);
							old_phone_line: getSelect2Value('#old_phone_line',['id','title']);
						}
						
						if ('<?php echo ($admin["account"]); ?>' == 'admin') {
							jsonData['distribute'] = $('#distribute').prop('checked') ? 1 : 0;
							jsonData['commision_adult'] = $('#commision_adult').val();
							jsonData['commision_child'] = $('#commision_child').val();
						}
						
						return jsonData;
					}
					
					// 设置线路基本信息
					function setLineBaseInfo(ds) {
						if (ds != null && typeof(ds) == 'undefined') {
							return false;
						}
						$('#line_id').val(ds.id);
						$('#full_name').val(ds.title);
						$('#second_name').val(ds.subheading);
						$('#adult_price').val(ds.start_price_adult);
						$('#child_price').val(ds.start_price_child);
//						$('#receipt_price').val(ds.receipt_price);
						$('#line_score').val(ds.line_score);
						$('#success_count').val(ds.success_team_count);
						$('#max_count').val(ds.max_team_count);
						$('#start_time').val(ds.start_time).trigger('change');
						$('#end_time').val(ds.end_time).trigger('change');
						$('#travel_day').val(ds.travel_day).trigger('change');
						$('#seek_qq').val(ds.seek_qq);
						$('#qq_verify').val(ds.qq_verify);
//						$('#click_count').val(ds.click_count);
						$('#hot_line').prop('checked', ds.hot == 1 ? true : false).trigger('change');
						$('#recommend_line').prop('checked', ds.recommend == 1 ? true : false).trigger('change');
						$('#leader_recommend').prop('checked', ds.leader_recommend == 1 ? true : false).trigger('change');
						$('#time_preference').prop('checked', ds.time_preference == 1 ? true : false).trigger('change');
						$('#check_price').prop('checked', ds.check_price == 0 ? true : false).trigger('change');
						$('#extra_line').prop('checked', ds.extra == 1 ? true : false).trigger('change');
						if ('<?php echo ($admin["account"]); ?>' == 'admin') {
							$('#distribute').prop('checked', ds.distribute == 1 ? true : false).trigger('change');
							$('#commision_adult').val(ds.commision_adult);
							$('#commision_child').val(ds.commision_child);
						}
						if ('<?php echo ($admin["station_id_data"]["attached"]); ?>' == '1') {
							$('#qinglvpai').val(ds.qinglvpai).trigger('change');
							setSelect2Value('#old_pc_line',ds.old_pc_line);
							setSelect2Value('#old_phone_line',ds.old_phone_line);
						}
						$('#start_price_explain').val(ds.start_price_explain);
						$('#send_word').val(ds.send_word);
						setSelect2Value('#member_type',ds.member_type);
						setSelect2Value('#pay_type',ds.allow_pay_type);
						setSelect2Value('#trip_traffic',ds.trip_traffic);
						setSelect2Value('#manager_admin',ds.manager_admin);
						setSelect2Value('#operator_admin',ds.operator_admin);
						setSelect2Value('#station',ds.station);
						setSelect2Value('#dismiss_place',ds.dismiss_place);
						setSelect2Value('#assembly_point',ds.assembly_point);
						setSelect2Value('#theme_type',ds.theme_type);
						setSelect2Value('#line_area',ds.line_area);
						setSelect2Value('#play_type',ds.play_type);
						setSelect2Value('#destination',ds.destination);
						setSelect2Value('#view_point',ds.view_point);
						setSelect2Value('#hotel_type',ds.hotel_type);
						setSelect2Value('#trip_month',ds.trip_month);
						setSelect2Value('#largess',ds.largess);
						$('#cost_description').data('wysihtml5').editor.setValue(ds.cost_description);
						$('#booking_notes').data('wysihtml5').editor.setValue(ds.booking_notes);
						if (ds.img1 != null) {
							$('.line_my_pic.img1').attr('src', ds.img1);	
						}
						if (ds.img2 != null) {
							$('.line_my_pic.img2').attr('src', ds.img2);
						}
						if (ds.img3 != null) {
							$('.line_my_pic.img3').attr('src', ds.img3);
						}
						if (ds.img4 != null) {
							$('.line_my_pic.img4').attr('src', ds.img4);
						}
					}
		
					// 更换行程图片
					function changeLineImage(imageObj, imageList) {
						var lineId = $('#line_id').val();
						if (lineId == 0) {
							return false;
						}
						var jsonData = {
							op_type: 'edit',
							id: lineId,
						};
						if ($(imageObj).hasClass('img1')) {
							jsonData['img1'] = imageList[0];
						} else if($(imageObj).hasClass('img2')) {
							jsonData['img2'] = imageList[0];
						} else if($(imageObj).hasClass('img3')) {
							jsonData['img3'] = imageList[0];
						} else {
							jsonData['img4'] = imageList[0];
						}
						$.post('<?php echo U("line/create");?>', jsonData, function(data){
							if (data.result.errno == 0)	{
								$(imageObj).attr('src', imageList[0]);
							} else {
								alert(data.result.message);
							}
						});
					}
					
					
					// 更换图片
					$('.line_my_pic').click(function(ev){
						ev.preventDefault();
						funcModalImageSelectorCallBack = changeLineImage;
						showModalSelectorImageDialog(this);
					});	
					
					$('.btn_save_info').click(function(ev){
						ev.preventDefault();
						createLine();
					});
				</script>
			</div> <!--Tab1 End-->
			
			<div class="tab-pane with-bg" id="fwv-2">
				<script type="text/javascript">
					$(document).ready(function(){
						bindInsertButtonToYouji($('#fwv-2'));						
					});
				</script>
			</div> <!--Tab2 End-->
			
			<div class="tab-pane with-bg" id="fwv-3">
				<script type="text/javascript">
					$(document).ready(function(){
						bindInsertButtonToYouji($('#fwv-3'));						
					});
				</script>
			</div> <!--Tab3 End-->
			
			<div class="tab-pane with-bg" id="fwv-4">	
				<div class="travel-arrangements-alldays">	
				</div>
				<script type="text/javascript">
					$(document).ready(function(){
						bindInsertButtonToTravel($('#fwv-4'));
					});
				</script>	
			</div> <!--Tab3 End-->
				
			<div class="tab-pane with-bg" id="fwv-5">
				
	<!-- 私有样式 -->
	<link rel="stylesheet" href="/source/Static/home/css/article.css">
	
	<link rel="stylesheet" href="/source/Static/home/css/content.css">
	
	<link rel="stylesheet" href="/source/Static/home/css/list.css">
	<style>
		.article-operate { position: absolute; bottom: 10px; right: 10px; }
		.article-operate i { display: inline-block; width: 80px; height: 30px; line-height:30px; margin-left:10px; color:#fff; font-size: 14px; font-style: normal; text-align: center; cursor: pointer; }
		.article-delete { background-color: #e4393c; }
		.tanchu { background-color: #5ca323; color:#fff; }
		.travel-notes-lunbo ul li { position: relative; margin-top: 20px; }
		.notes-describe input { width: 100%; }
		.notes-describe textarea { width: 100%; height: 140px; resize: none; }
		.notes-describe h3 , .notes-xx { margin: 0; }
		.notes-save-btn { width:100%; margin-top:20px; color:#fff; background-color: #f9394c; }
		
		.notes-change-img { position: absolute; top: 0; left: 0; width: 520px; height:40px; line-height:40px; background-color: rgba(0,255,0,.5); text-align:center; }
		.notes-change-img i { display: inline-block; width:259.5px; font-size:14px; font-style: normal; cursor: pointer; color:#fff; }
		.notes-change-img i:hover { color: #000; }
		.notes-change-img i:first-child { border-right: 1px solid #fff; }
		
		/*线路推荐*/
		.recommend-line-list { width: 1200px; margin: 0 auto; }
		.single-row {display: block;}
		.single-row-describe-top { height: 243px; }		
		.single-row-describe-bottom { height: 37px; line-height: 37px; }
		
		/*.recommend-line-list { width: 1200px; margin: 0 auto; }
		.single-row {display: block; width: 100%; margin-top: 14px;}
		.single-row-content { position: relative; width: 100%; height: 280px; margin-bottom: 30px; background-color: #fff; overflow: hidden;}
		.single-row-img {width: 420; height: 280px; overflow: hidden;}
		.single-row-img img {width: 100%; height: 100%; }
		.single-row-img .single-row-describe {float: left;}
    	.btn-line {float: right; width: 90px; height: 36px; background-size: 100% 100%; border-color: #aaaa55;}
		.single-row-describe-top { position: relative; width:750px; height: 243px; padding-left:30px; }
		.single-row-describe-bottom { padding-left:30px; border-top:1px solid #e9e9e9; width:750px; height: 37px; line-height: 37px; overflow: hidden; }*/
	</style>
<div class="row">
	
	<!-- 游记攻略 -->
	<div class="travel-notes">
		<h3 id="travel-notes">游记攻略</h3>
		<div class="travel-notes-lunbo">
			<ul>
				<?php $__FOR_START_1714121049__=0;$__FOR_END_1714121049__=6;for($k=$__FOR_START_1714121049__;$k < $__FOR_END_1714121049__;$k+=1){ ?><li class="youji<?php echo ($k); ?>" data-key="youji<?php echo ($k); ?>" data-index="<?php echo ($k); ?>" data-type="youji">
						<img src="" alt="">
						<div class="notes-describe">
							<h3><span>主标题：</span><input class="title" type="text"/></h3>
							
							<div class="notes-xx">
								<p>描述：<textarea class="desc"></textarea></p>
								<p>链接：<input class="link" type="text"/></p>
								<p><button class="btn notes-save-btn">保存</button></p>
							</div>
							
							<div class="notes-change-img">
								<i>上传图片</i><i>图库图片</i>
							</div>
						</div>
					</li><?php } ?>
			</ul>
		</div>
	</div>
	
	<div class="separator"></div>

	<div class="recommend-line-list">
		<?php $__FOR_START_528798499__=0;$__FOR_END_528798499__=4;for($k=$__FOR_START_528798499__;$k < $__FOR_END_528798499__;$k+=1){ ?><div class="single-row recommend_line<?php echo ($k); ?>" data-key="recommend_line<?php echo ($k); ?>" data-index="<?php echo ($k); ?>" data-type="recommend_line">
				<div class="single-row-content">
					<div class="single-row-img">
						<img src="" alt="">
					</div>
					<div class="single-row-describe">
						<div class="single-row-describe-top">
							<h4 class="title"></h4>
							<h5 class="subheading"></h5>
							<span class="send_word"></span>
							<p>
								<u class="assembly">集合地点：</u>
								<u class="click_count">点击量：0次</u>
							</p>
							<p>
								<u class="destination">目的地：</u>
								<u class="station">站点：</u>
							</p>
							<div class="single-row-describe-price">
								<h6><s class="price">当前元</s><strong class="cut_price"></strong>元起</h6>
							</div>
							<span class="travel_date">旅行时间：</span>
						</div>
						<div class="single-row-describe-bottom">
							<a class="btn btn-success btn-line test btn-recommend-line" href="javascript:;">设置</a>
						</div>
					</div>
				</div>
			</div><?php } ?>
	</div>
	
	<!-- 自绑定 -->
	<script src="/source/Static/home/common/js/showAndHide.js"></script>
	
	<script type="text/javascript">		
		
		/////////////////////////////////////////////////////////////////////////////////////////////
		// 设置产品
		function  setRecommendLine(obj, ds) {	
			if ($(obj).length > 0 && ds != null) {
				$(obj).attr('data-id', ds.id);
				if (ds.value != null) {
					var d = ds.value;
					$(obj).find('.single-row-img img').attr('src', d.img1);					
					$(obj).find('.title').html(d.title);
					$(obj).find('.subheading').html(d.subheading);
					$(obj).find('.send_word').html(d.send_word_show);
					$(obj).find('.assembly').html('集合地点：'+d.assembly_point_show_text);
					$(obj).find('.click_count').html('点击量：'+d.click_count);
					$(obj).find('.destination').html('目的地：'+d.destination_show_text);
					$(obj).find('.station').html('站点：'+d.station_show);
					$(obj).find('.price').html(d.start_price_adult+'元');
					$(obj).find('.cut_price').html(d.start_price_adult);
					$(obj).find('.travel_date').html('旅行时间：'+d.start_time+' 至 '+d.end_time);
				}
			}
		}
		
		function _ajaxSetRecommendLine(obj, ids) {
//			console.log(JSON.stringify(ids));		
			if (ids.length == 0 || ids == null || ids == 'undefined') {
				toastr.error('未选取线路信息');
				return false;
			}			
			
			var jsonData = {
				op_type: 'set',
				id: $(obj).attr('data-id'),
				line_id: $('#line_id').val(),
				key: $(obj).attr('data-key'),
				value_type: 'line',
				sort: $(obj).attr('data-index'),
				value: ids[0],
			}
			
			$.post('<?php echo U("line/create");?>', jsonData, function(data){
				if (data.ds != null) {
					setRecommendLine(obj, data.ds);
				}
				
				if (data.result != null) {
					if (data.result.errno == 0) {
						toastr.success(data.result.message);	
					} else {
						toastr.error(data.result.message);	
					}
				}
			});
		}
		
		// 绑定线路
		$('.btn-recommend-line').click(function(ev){
			ev.preventDefault();			
			showModalLineSelect($(this).closest('.single-row'), _ajaxSetRecommendLine, '', true);
		});		
	
		/////////////////////////////////////////////////////////////////////////////////////////////
		// 绑定外链游记开始
		
		// 设置外链游记
		function setBindYouji(obj, ds) {
			if ($(obj).length > 0 && ds != null) {
				$(obj).attr('data-id', ds.id);
				if (ds.value != null) {
					var d = ds.value;
					$(obj).find('img').attr('src', d.img);
					$(obj).find('.title').val(d.title);
					$(obj).find('.desc').val(d.desc);
					$(obj).find('.link').val(d.url);
				}
			}
		}
		
		// 添加线路其他设置
		function appendLineSet(ds) {
			if (ds != null && ds.length > 0) {
				for (var i = 0; i < ds.length; i ++) {
					var obj = '.'+ds[i]['key'];
					var type = $(obj).attr('data-type');
					if (type == 'youji') {
						setBindYouji(obj, ds[i]);
					} else if (type == 'recommend_line') {
						setRecommendLine(obj, ds[i]);
					} else {
						console.log('未知线路设置类型，Error:key=>'+data[i]['key']);
					}
				}
			}
		}
		
		// 设置游记图片
		function setBindYoujiImage(obj, imageList) {
			if ($(obj).length == 0 || $(imageList).length == 0) {
				alert('选择图片错误');
				return false;
			}
			
			$(obj).closest('li').find('img').attr('src', imageList[0]);
		}
		
		// 上传游记链接图片
//		modalUploadMaxFileCount = 1; 
		$('.notes-change-img').find('i:first').click(function(){			
			funcModalUploadCallBack = setBindYoujiImage;
			showModalUploadImageDialog(this);
		});
		
		// 选择游记链接图片
		$('.notes-change-img').find('i:last').click(function(){
			funcModalImageSelectorCallBack = setBindYoujiImage;
			showModalSelectorImageDialog(this);
		});
		
		// 编辑游记
		$('.notes-save-btn').click(function(ev){
			ev.preventDefault();
		
			var liObj = $(this).closest('li');			
			var youji = {
				title: $(liObj).find('.title').val(),
				img: $(liObj).find('img').attr('src'),
				desc: $(liObj).find('.desc').val(),
				url: $(liObj).find('.link').val(),
			}
			
			var jsonData = {
				op_type: 'set',
				line_id: $('#line_id').val(),
				id: $(liObj).attr('data-id'),
				key: $(liObj).attr('data-key'),
				value_type: 'json',
				value: JSON.stringify(youji),
				sort: $(liObj).attr('data-index'),
			}
			
			$.post('<?php echo U("line/create");?>', jsonData, function(data){
				if (data.result != null) {
					if (data.result.errno == 0) {
						toastr.success(data.result.message);
					} else {
						toastr.error(data.result.message);
					}	
				}
			})
			
		});
	
	</script>
</div>
			</div> <!--Tab4 End-->
			
			<div class="tab-pane with-bg" id="fwv-6">
				<script type="text/javascript">
					$(document).ready(function(){
						bindInsertButtonToYouji($('#fwv-6'));						
					});
				</script>
			</div> <!--Tab5 End-->
			
			<div class="tab-pane with-bg" id="fwv-7">
				
	<!--问题模板-->
	<article class="timeline-story template_question hidden_ctrl" data-id="">
		
		<i class="fa-paper-plane-empty block-icon"></i>
		
		<!-- User info -->
		<header style="height: auto;">							
			<!-- Story Content Wrapped inside Paragraph -->
			<p class="content"></p>
			
			<p class="question_line"></p>
			
			<!-- Story Options Links -->
			<div class="story-options-links">
				
				<a href="#">
					<i class="linecons-heart"></i>
					点赞数 
					<span class="like_count">(0)</span>
				</a>
				
				<a href="#">
					<i class="linecons-comment"></i>
					评论数
					<span class="answer_count">(0)</span>
				</a>
				
				<time style="float: right;"></time>
				<span class="sign_name" style="float: right;"></span>&nbsp;&nbsp;&nbsp;&nbsp;
			</div>			
			
		</header>
		
		<div class="answer-content">
	
			<!-- Story Comments -->
			<ul class="list-unstyled story-comments">
				
			</ul>
		
			<form method="post" action="" class="story-comment-form">
			
				<textarea class="form-control input-unstyled autogrow answer_reply_textarea" placeholder="回复..."></textarea>
				
				<button id="answer_send" type="button" class="btn btn-single btn-xs btn-success">发送</button>
				
			</form>
		
		</div>
								
	</article>
	
	<!--回答模板-->
	<div class="story-comment template_answer hidden_ctrl" data-id="">
		
		<div class="story-comment-content">
		
			<a href="#" class="story-comment-user-name">
				<span class="answer_name"></span>
				<time></time>
			</a>
			
			<p class="answer_content"></p>
			
		</div>
		
	</div><!--结束回答-->

	<!--问题开始-->
	<section class="profile-env" style="background-color: fff;">
		<!-- User Post form and Timeline -->
		<form method="post" action="" class="profile-post-form">
			<textarea class="form-control input-unstyled input-lg autogrow" placeholder="请输入您的问题"></textarea>
			<i class="el-edit block-icon"></i><br />
			
			<button type="button" class="btn btn-single btn-xs btn-success post-story-button">发送</button>
		</form>
		<!-- User timeline stories -->
		<section class="user-timeline-stories">			
			
		</section>	<!--结束问题列表Section-->
		
		<div class="question_page_list" data-page-count="1" data-page-index="1"></div>
		
	</section> <!--结束整个问题系统Section-->	
	
	<!--翻页脚本-->
	<script src="/source/Static/home/js/page.js"></script>
	<script type="text/javascript">
		
		// 初始化翻页
		constructionPage('.question_page_list', 1, 1, changeQuestionPage);
				
		// 添加问题HTML
		function appendQuestionHtml(container, ds, pageIndex, pageCount, before) {									
			if (ds != null) {	
				for (var i = 0; i < $(ds).length; i ++) {
					var d = ds[i];
					var rootObj = $('.template_question').clone(true);
					$(rootObj).removeClass('template_question');
					$(rootObj).removeClass('hidden_ctrl');
					$(rootObj).attr('data-id', d.id);
					$(rootObj).attr('data-type-id', d.type_id);
					$(rootObj).find('.content').html(d.content);
					if (d.is_line != null && d.is_line == 1) {
						$(rootObj).find('.question_line').html(d.line.title);
					} else {
						$(rootObj).find('.question_line').remove();
					}
					$(rootObj).find('.like_count').html('('+d.agree+')');
					$(rootObj).find('.answer_count').html('('+d.answer_count+')');
					$(rootObj).find('.sign_name').html('['+d.account_id_data.account_type.type_desc+']'+d.account_id_show_name);
					$(rootObj).find('time').html(d.create_time);		
					// 初始化回答问题框
					$(rootObj).find('.answer_reply_textarea').wysihtml5({
						size: 'white',
						stylesheets: "/source/Static/assets/js/wysihtml5/lib/css/wysiwyg-color.css",
					});	
					
					//回复内容
					if (typeof(d.answers) != 'undefined' && d.answers != null) {
						for (var j = 0; j < d.answers.length; j++) {
							var a = d.answers[j];
							var answerObj = $('.template_answer').clone(true);
							$(answerObj).removeClass('template_answer');
							$(answerObj).removeClass('hidden_ctrl');
							$(answerObj).attr('data-id', a.id);
							$(answerObj).find('.answer_name').html('['+a.account_id_data.account_type.type_desc+']'+a.account_id_show_name);
							$(answerObj).find('time').html(a.create_time);
							$(answerObj).find('.answer_content').html(a.content);
							$(rootObj).find('.story-comments').append('<li></li>');
							$(rootObj).find('.story-comments').find('li:last').append(answerObj);
						}
					}
					
					if (typeof(before) == 'undefined'){
						$(container).append(rootObj);	
					} else {
						$(container).prepend(rootObj);
					}
				}						
			
				// 重构翻页
				if (pageCount != 0) {
					constructionPage('.question_page_list', pageIndex, pageCount, changeQuestionPage);					
				}
			}
		}
		
		// 切换问题页
		function changeQuestionPage(p) {
			var jsonData = {
				cds: 'type_id_key,question_type_line,line_id,'+$('#line_id').val(),
				op_type: 'list',
				page: p-1,
			}
			$.post('<?php echo U("line/question");?>', jsonData, function(data){
				if (data.result.errno == 0) {					
					$('.user-timeline-stories').empty();
					appendQuestionHtml('.user-timeline-stories', data.ds, p, data.page_count, false);
				} else {
					alert(data.result.message);
				}
			});
		}
		
		// 生成问题
		$('.post-story-button').click(function(){
			var content = $('.profile-post-form').find('textarea').val();			
			if (content == '') {
				alert('问题内容不能为空');
				return false;
			}	
			createQuestion('.user-timeline-stories', 0, content);
			$('.profile-post-form').find('textarea').val('');
		});
		
		// 回答问题
		$('#answer_send').click(function(){
			var rootObj = $(this).closest('article');
			var questionId = $(rootObj).attr('data-id');
			var content = $(rootObj).find('.answer_reply_textarea').data('wysihtml5').editor.getValue();
			if (content == '') {
				alert('回答内容不能为空');
				return false;
			}	
			var container = $(this).closest('.answer-content').find('.story-comments'); 
			createQuestion(container, questionId, content);
			$(rootObj).find('.answer_reply_textarea').data('wysihtml5').editor.setValue('');
		});
		
		// 添加问题HTML
		function appendQuestionOnlyHtml(container, ds, pageCount, before) {
			if (ds != null) {	
				for (var i = 0; i < $(ds).length; i ++) {
					var d = ds[i];
					var rootObj = $('.template_question').clone(true);
					$(rootObj).removeClass('template_question');
					$(rootObj).removeClass('hidden_ctrl');
					$(rootObj).attr('data-id', d.id);
					$(rootObj).attr('data-type-id', d.type_id);
					$(rootObj).find('.content').html(d.content);
					if (d.is_line != null && d.is_line == 1) {
						$(rootObj).find('.question_line').html(d.line.title);
					} else {
						$(rootObj).find('.question_line').remove();
					}
					$(rootObj).find('.like_count').html('('+d.agree+')');
					$(rootObj).find('.answer_count').html('('+d.answer_count+')');
					$(rootObj).find('.sign_name').html('['+d.account_id_data.account_type.type_desc+']'+d.account_id_show_name);
					$(rootObj).find('time').html(d.create_time);
					// 初始化回答问题框
					$(rootObj).find('.answer_reply_textarea').wysihtml5({
						size: 'white',
						stylesheets: "/source/Static/assets/js/wysihtml5/lib/css/wysiwyg-color.css",
					});	
					
					if (typeof(before) == 'undefined'){
						$(container).append(rootObj);	
					} else {
						$(container).prepend(rootObj);
					}
				}			
			
				// 重构翻页
				if (pageCount != 0) {
					constructionPage('.question_page_list', pageCount, changeQuestionPage);					
				}
			}
		}
		
		// 添加答案HTML
		function appendAnswerOnlyHtml(container, ds, before) {
			if (ds != null) {	
				for (var i = 0; i < $(ds).length; i ++) {
					var a = ds[i];
					var answerObj = $('.template_answer').clone(true);
					$(answerObj).removeClass('template_answer');
					$(answerObj).removeClass('hidden_ctrl');
					$(answerObj).attr('data-id', a.id);
					$(answerObj).find('.answer_name').html('['+a.account_id_data.account_type.type_desc+']'+a.account_id_show_name);
					$(answerObj).find('time').html(a.create_time);
					$(answerObj).find('.answer_content').html(a.content);
					
					if (typeof(before) == 'undefined'){
						$(container).append('<li></li>');
						$(container).find('li:last').append(answerObj);	
					} else {
						$(container).prepend('<li></li>');
						$(container).find('li:first').append(answerObj);
					}
				}			
			}
		}
		
		// 生成问题
		function createQuestion(container, questionId, content) {	
			var jsonData = {
				op_type: 'create',
				question_type: 'line_question',
				question_id: questionId,
				line_id: $('#line_id').val(),
				content: content,				
			}
			
//			console.log(JSON.stringify(jsonData));
//			return false;
			$.post('<?php echo U("line/question");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					if (data.ds != null) {
						var dss = new Array();
						dss[0] = data.ds;
						if (questionId == 0) {
							appendQuestionOnlyHtml(container, dss, 0, true);	
						} else {
							appendAnswerOnlyHtml(container, dss, true);
						}
					}
				} else {
					alert(data.result.message);
					if (data.jumpUrl != null) {
						location.href = data.jumpUrl;
					}
				}
			});
		}
		
		// 添加问题数据
		function appendQuestionData(ds, page_count) {
			if (ds == null || typeof(ds) == 'undefined') {
				return false;
			}
			var pageCount = (page_count == null || typeof(page_count) == 'undefined') ? 1 : page_count;
			appendQuestionHtml('.user-timeline-stories', ds, 1, pageCount, false);
		}
		
	</script>
			</div> <!--Tab6 End-->
			
			<div class="tab-pane with-bg" id="fwv-8">
								<style>
					table { margin-top: 0; }
					.fc th { width: 20%; }
					.fc-ltr .fc-basic-view .fc-day-number { text-align: center; }
					.fc .fc-day-header { background-color: #f4f4f4; padding: 5px 0; }
					.batch_item { width: 100%; height: 100%; text-align: left; line-height: 1.3; background-color: #A3D165;}
					.fc-row.fc-rigid .fc-content-skeleton { bottom: 0; }
					.fc-content-skeleton table { width: 100%; height: 100%; }
					td.fc-event-container { position: relative;}
					td.fc-event-container td { position: absolute; top: 0; left: 0; right: 0; bottom: 0; width: 100%; cursor: pointer; }
					.batch-checked {background-color: #ffff00 !important;}
					.border{border: 1px solid #dcdcdc; margin: 15px auto; position: relative;}
					.small-title{width: 100%; height: 60px; line-height: 60px; font-size: 14px;}
					.panel-body .table1 {margin-top: 20px;}
					.panel-body .table1 thead tr th, .panel-body .table2 thead tr th {height: 50px; padding-bottom: 15px; text-align: center;}
					.panel-body .table1 tr td, .panel-body .table2 tr td {padding-left: 0; padding-right: 0; text-align: center;}
					.taocan-list{padding-bottom: 15px;}
					.taocan-list .form-block{border-bottom: 1px solid #dcdcdc;}
				</style>		

				<div class="template_batch_item hidden_ctrl ">

					<input type="checkbox" class="check_batch" /><br>

					<span class="adult"></span><br>

					<span class="child"></span><br>

					<span class="sub_member"></span>

				</div>

				

				<div class="row batch_root">	

					<div class="col-md-6">	
						<div class="row">	

							<div class="col-md-12">

								<div class="form-group">
						
									<span style="color: red;">使用日期前请先将日历锁定到今天日期</span>
									
								</div>
						
							</div>
						
						</div>
						
						<div class="row">	

							<div class="col-md-12">

								<div class="form-group">

									<div id="calendar"></div>

								</div>

							</div>	

						</div>

					</div>

					<div class="col-md-6">					

						<div class="row">	

							<div class="col-md-12">

								<div class="form-group">

									<label class="control-label" for="batch_title">批次标题</label> <!--data-validate="required"-->

									<input class="form-control" name="batch_title" id="batch_title" placeholder="请输入批次的标题" />

									<input class="hidden_ctrl" name="batch_id" id="batch_id" value="0" />

								</div>

							</div>	

						</div>

						

						<div class="row">					

							<div class="col-md-6">

								<div class="form-group">

									<label class="control-label" for="price_adult">成人起步价格</label>

									<input class="form-control" name="price_adult" id="price_adult" data-validate="number" value="0.00" />

								</div>

							</div>

							

							<div class="col-md-6">

								<div class="form-group">

									<label class="control-label" for="price_child">小孩起步价</label>

									<input class="form-control" name="price_child" id="price_child" data-validate="number" value="0.00" />

								</div>

							</div>

							

						</div>

						

						<div class="row">					

							<div class="col-md-6">

								<div class="form-group">

									<label class="control-label" for="car_member">每车人次</label>

									<input class="form-control" name="car_member" id="car_member" data-validate="number" value="1" />

								</div>

							</div>

							

							<div class="col-md-6">

								<div class="form-group">

									<label class="control-label" for="car_number">车次</label>

									<input class="form-control" name="car_number" id="car_number" data-validate="number" value="1" />

								</div>

							</div>

						</div>

						

						<div class="row">						

							<div class="col-md-6">						

								<div class="form-group">

									<label class="control-label" for="batch_state">批次状态<span style="color:red;">(*必选)</span></label>

									<script type="text/javascript">

										$(document).ready(function(){

											$("#batch_state").select2({

		//										minimumInputLength: 1,

												minimumResultsForSearch: Infinity,

												placeholder: '选择批次的状态',

												ajax: {

													url: '<?php echo U("help/listtypedata");?>',

													type: 'post',

													dataType: 'json',

													quietMillis: 100,

													data: function(term, page) {

														return {op:term, type_key:'line_batch_state'};

													},

													results: function(data, page){

														if (data.result.errno == 0) {

															if (data.ds == null) {

																data.ds = new Array();	

															}

															data.ds[$(data.ds).length] = {'id':'-1','data_type_id':'-1','type_key':'','type_desc':'添加类型','can_delete':'0'};

															return { results: data.ds }

														} else {

															return { results: '' };	

														}

													},

													cache: true,

												},

												formatResult: function(data) { 					

													if (data.type_desc == '添加类型') {

														return '<button class="btn btn-blue btn-xs">添加类型</button>';

													} else {

														return '<div class="select2-user-result cx_border02">' + data.type_desc + '</div>';

													}							

												},	

												formatSelection: function(data) {

													if (data.type_desc == '添加类型') {													

														showModalTypeDataDialog('line_batch_state');

														return '添加后请移除我'

													} else {											

														return data.type_desc;	

													}

												},						

											});

										});

									</script>

									<input class="form-control" type="text" name="batch_state" id="batch_state" />

								</div>							

							</div>	

							

							<div class="col-md-6">

								<div class="form-group">						

									<label class="control-label" for="batch_holiday">节日备注</label>

									<script type="text/javascript">

										$(document).ready(function(){

											var payTypeObj = $("#batch_holiday").select2({

		//										minimumInputLength: 1,

												minimumResultsForSearch: Infinity,

												placeholder: '选择批次的节日状态',

												ajax: {

													url: '<?php echo U("help/listtypedata");?>',

													type: 'post',

													dataType: 'json',

													quietMillis: 100,

													data: function(term, page) {

														return {op:term, type_key:'line_batch_holiday'};

													},

													results: function(data, page){

														if (data.result.errno == 0) {

															if (data.ds == null) {

																data.ds = new Array();	

															}

															data.ds[$(data.ds).length] = {'id':'-1','data_type_id':'-1','type_key':'','type_desc':'添加类型','can_delete':'0'};

		//														console.log(JSON.stringify(data.ds));

															return { results: data.ds }

														} else {

															return { results: '' };	

														}

													},

													cache: true,

												},

												formatResult: function(data) { 					

													if (data.type_desc == '添加类型') {

														return '<button class="btn btn-blue btn-xs">添加类型</button>';

													} else {

														return '<div class="select2-user-result cx_border02">' + data.type_desc + '</div>';

													}							

												},	

												formatSelection: function(data) {

													if (data.type_desc == '添加类型') {													

														showModalTypeDataDialog('line_batch_holiday');

														return '添加后请移除我'

													} else {											

														return data.type_desc;	

													}

												},						

											});

										});

									</script>

									<input class="form-control" type="text" name="batch_holiday" id="batch_holiday" />						

								</div>

							</div>		

						</div>

						

						<div class="row">						

							<div class="col-md-6">						

								<div class="form-group">

									<label class="control-label" for="batch_use">使用状态<span style="color:red;">(*必选)</span></label>

									<script type="text/javascript">

										$(document).ready(function(){

											$("#batch_use").select2({

		//										minimumInputLength: 1,

												minimumResultsForSearch: Infinity,

												placeholder: '选择批次使用状态',

												ajax: {

													url: '<?php echo U("help/listtypedata");?>',

													type: 'post',

													dataType: 'json',

													quietMillis: 100,

													data: function(term, page) {

														return {op:term, type_key:'line_batch_use'};

													},

													results: function(data, page){

														if (data.result.errno == 0) {

															if (data.ds == null) {

																data.ds = new Array();	

															}

															data.ds[$(data.ds).length] = {'id':'-1','data_type_id':'-1','type_key':'','type_desc':'添加类型','can_delete':'0'};

															return { results: data.ds }

														} else {

															return { results: '' };	

														}

													},

													cache: true,

												},

												formatResult: function(data) { 					

													if (data.type_desc == '添加类型') {

														return '<button class="btn btn-blue btn-xs">添加类型</button>';

													} else {

														return '<div class="select2-user-result cx_border02">' + data.type_desc + '</div>';

													}							

												},	

												formatSelection: function(data) {

													if (data.type_desc == '添加类型') {													

														showModalTypeDataDialog('line_batch_use');

														return '添加后请移除我'

													} else {											

														return data.type_desc;	

													}

												},						

											});

										});

									</script>

									<input class="form-control" type="text" name="batch_use" id="batch_use" />

								</div>							

							</div>	

							

							<div class="col-md-6">

								<div class="form-group">

									<label class="control-label" for="start_before_day">报名截止到出团前（天）<span style="color:red;">(*必填,大于0:出团日期前推,小于0:出团日期后推)</span></label>

									<input class="form-control" name="start_before_day" id="start_before_day" data-validate="number" value="1" />

								</div>

							</div>	

						</div>

						

						<div class="row">				

							<div class="col-md-4">

								<div class="form-group">

									<label class="control-label" for="batch_stop_time">报名截止<span style="color:red;">(*必选，根据截至报名天数自动计算)</span></label>

									<!--<input class="form-control datepicker" name="batch_stop_time" id="batch_stop_time" data-start-view="1" data-start-date="0d" placeholder="请选择出团日期" data-format="yyyy-mm-dd"  />-->

									<input class="form-control" name="batch_stop_time" id="batch_stop_time" type="text" disabled="disabled"/>

								</div>

							</div>	

											

							<div class="col-md-4">

								<div class="form-group">

									<label class="control-label" for="batch_start_time">出团日期<span style="color:red;">(*必选，日历内选择出团日期)</span></label>

									<!--<input class="form-control datepicker" name="batch_start_time" id="batch_start_time" data-start-view="1" data-start-date="0d" placeholder="请选择出团日期" data-format="yyyy-mm-dd"  />-->

									<input class="form-control" name="batch_start_time" id="batch_start_time" type="text" disabled="disabled"/>

								</div>

							</div>			

							

							<div class="col-md-4">

								<div class="form-group">

									<label class="control-label" for="batch_end_time">散团日期<span style="color:red;">(*必选，根据行程天数自动计算)</span></label>

									<!--<input class="form-control datepicker" name="batch_end_time" id="batch_end_time" data-start-view="1" data-start-date="0d" placeholder="请选择出团日期" data-format="yyyy-mm-dd"  />-->

									<input class="form-control" name="batch_end_time" id="batch_end_time" type="text" disabled="disabled"/>

								</div>

							</div>				

						</div>							

							

						<div class="row">							

							<div class="col-md-12">

								<div class="form-group">

									<label class="control-label" for="batch_tip">批次备注提示</label>

									<input class="form-control" name="batch_tip" id="batch_tip" placeholder="请输入批次备注提示" />

								</div>

							</div>							

						</div>
						
												

						<div class="row">							

							<div class="col-md-12">

								<div class="form-group">

									<button class="btn btn-secondary btn_batch_append">添加批次</button>

									<button class="btn btn-danger btn_batch_remove hidden_ctrl">移除批次</button>

								</div>

							</div>							

						</div>
						

					</div>					

				</div>

				

				<div class="form-group-separator"></div>

				

				<div class="row">

					<div class="col-md-12">				

						<div class="form-group">

							<table id="table_batch" class="table text-left">

								<thead>

									<tr>
										<th width="80px" class="source_check"><input type="checkbox" class="cbr cbr-replaced cbr-secondary check_all_budget" /></th>
										
										<th width="200px">批次标题</th>
													   
										<th width="150px">批次价格</th>
													   
										<th width="150px">报名截止</th>
													   
										<th width="150px">起始时间</th>
													   
										<th width="150px">结束时间</th>
													   
										<th width="200px">批次/节日/使用状态</th>
													   
										<th width="150px">车次人数</th>
													   
										<th width="200px">编辑/删除</th>

									</tr>  

									<tbody>

									</tbody>

								</thead>

							</table>

						</div>	

					</div>

				</div>
				
				<!--套餐内容开始-->
				
				<div class="row source_budget taocan-box">
					<div class="col-sm-12">
						<div class="panel panel-default edit">
							<div class="panel-heading">
								<h3 class="panel-title">产品套餐</h3>
								<div class="panel-options">
									<a href="#" data-toggle="panel">
										<span class="collapse-icon">–</span>
										<span class="expand-icon">+</span>
									</a>
								</div>
							</div>
							
							<div class="panel-body">
								
								<div class="border">
									<div class="row" style="margin: 0;">
										<div class="col-md-12">
											<div class="small-title">批次</div>											
										</div>
										
										<div class="col-md-12">
											<div class="form-block taocan-selece-batch-list">
												
											</div>
										</div>
										<div class="col-md-12">											
											<button style="float: right;width:70px;" type="button" class="btn btn-primary btn-sm btn-clear-batch-select">清除</button>
										</div>
									</div>
								</div>
								<div class="border">
									<div class="row" style="margin: 0;">
										<div class="col-md-12">
											<div class="small-title">套餐</div>											
										</div>
										
										<?php if(is_array($taocans)): $i = 0; $__LIST__ = $taocans;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tcType): $mod = ($i % 2 );++$i;?><div class="col-md-12 taocan-list">
												<b><?php echo ($tcType["type"]["type_desc"]); ?></b>
												<div class="form-block">
													<?php if(is_array($tcType["data"])): $i = 0; $__LIST__ = $tcType["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tc): $mod = ($i % 2 );++$i;?><button class="btn btn-gray btn-sm select-taocan-btn" type="button" data-id="<?php echo ($tc["id"]); ?>"><?php echo ($tc["name"]); ?></button><?php endforeach; endif; else: echo "" ;endif; ?>
													<button style="float: right;width:70px;" type="button" class="btn btn-primary btn-sm btn-clear-taocan-select">清除</button>
												</div>
											</div><?php endforeach; endif; else: echo "" ;endif; ?>						
										
									</div>
								</div>
								
								<div class="border">
									<div class="row" style="margin: 0;">
										<div class="col-md-12">
											<div class="small-title">价格</div>											
										</div>
										<div class="col-md-12">
											<div class="col-md-3">
												<div class="form-group">			
													<label class="control-label" for="taocan_price_adult">成人价</label>			
													<input class="form-control" name="taocan_price_adult" id="taocan_price_adult" data-validate="number" value="0.00" aria-invalid="false">			
												</div>			
											</div>
											
											<div class="col-md-3">
												<div class="form-group">			
													<label class="control-label" for="taocan_price_child">儿童价</label>			
													<input class="form-control" name="taocan_price_child" id="taocan_price_child" data-validate="number" value="0.00" aria-invalid="false">			
												</div>			
											</div>
											
											<button type="button" style="float: right; width:70px;" class="btn btn-info btn-sm add-taocan-price-btn">保存</button>
										</div>
										
									</div>										
								</div>
								
								<table class="table table1 table_order">
									<thead>
										<tr>
											<th style="width: 10%;" align="center">价格编号</th>
											<th style="width: 20%;" align="center">批次</th>
											<th style="width: 20%;" align="center">套餐</th>
											<th style="width: 15%;" align="center">成人价</th>
											<th style="width: 15%;" align="center">儿童价</th>
											<th style="width: 20%;" align="center">操作</th>
										</tr>
									</thead>
									<tbody id="taocan-price-list">
										<?php if(is_array($taocanPrices)): $i = 0; $__LIST__ = $taocanPrices;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tp): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($tp["id"]); ?>">
												<td class="price-id"><?php echo ($tp["id"]); ?></td>
												<td class="batch-data" data-batch-id="<?php echo ($tp["batch_data"]["id"]); ?>"><?php echo ($tp["batch_data"]["start_date_show"]); ?></td>
												<td class="tacan-ids-desc" data-taocan-ids="<?php echo ($tp["taocan_ids"]); ?>"><?php echo ($tp["tc_name_str"]); ?></td>
												<td class="taocan-price-adult"><?php echo ($tp["price_adult"]); ?></td>
												<td class="taocan-price-child"><?php echo ($tp["price_child"]); ?></td>
												<td>
													<button class="btn btn-secondary edit-taocan-price" data-id="<?php echo ($tp["id"]); ?>" type="button">编辑</button>
													<button class="btn btn-danger remove-taocan-price" data-id="<?php echo ($tp["id"]); ?>" type="button">删除</button>
												</td>
											</tr><?php endforeach; endif; else: echo "" ;endif; ?>			
									</tbody>
								</table>
								
							</div>
							
						</div>
					</div>
				</div>
											
				<!--套餐内容结束-->
				
				<script type="text/javascript">

					function getDateTime(unixDateTime) {

						var d = new Date(unixDateTime);						

						return d.getFullYear()+'-'+parseInt(d.getMonth()+1)+'-'+d.getDate()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();

					}

				

					// 获取日期安排

					function getDayPlan(start, end, timezone, callback) {
						
						console.log('获取日期安排.....');

						var jsonData = {

							'op_type': 'list',

							'line_id': $('#line_id').val(),

							'start_begin': '>=,'+start.format('YYYY-MM-DD HH:mm:ss'),

							'start_end': '<=,'+end.format('YYYY-MM-DD HH:mm:ss'),

						}

						

						var events = new Array();

						$.post('<?php echo U("line/batch");?>', jsonData, function(data){

							if (data.result.errno == 0) {

								if (typeof(data.ds) != 'undefined' && data.ds != null) {

									for (var i = 0; i < data.ds.length; i ++) {

										var iData = data.ds[i];

										var obj = {

											id: iData.id,

											title: iData.title,

											start: iData.start_time,

//											end: iData.end_time,

//											batch_id: iData.id,

//											adult:iData.price_adult,

//											child:iData.price_child,

//											sub_member: iData.sub_member,

											ds: JSON.stringify(iData),

											rendering: 'background',

										}

//										console.log(JSON.stringify(obj));

										events.push(obj);

									}

									callback(events);

								}

							} else {

								alert(data.result.message);

							}

						});

//						console.log('start_type:'+typeof(start)+',start:'+start.format('YYYY-MM-DD HH:mm:ss')+',end:'+getDateTime(end)+',timezone:'+timezone);

					}

					

					// 绘制日历

					function renderDay(evnt, elemt, view) {

//						console.log('绘制事件......'+evnt.start.format('YYYY-MM-DD HH:mm:ss'));

						var iData = $.parseJSON(evnt.ds);						

						var itemObj = $('.template_batch_item').clone(true);

						$(itemObj).removeClass('hidden_ctrl');

						$(itemObj).removeClass('template_batch_item');

						$(itemObj).addClass('batch_item');

						$(itemObj).attr('data-id', iData.id);

						

						$(itemObj).find('.adult').html('成人￥'+iData.price_adult);

						$(itemObj).find('.child').html('儿童￥'+iData.price_child);

						$(itemObj).find('.sub_member').html('剩余'+iData.sub_member);

						
						var vhtml = $(itemObj).prop('outerHTML');
//						console.log(vhtml);
						return vhtml;

					}

					

					// 清除批次内容

					function cleanBatch() {

						$('#batch_id').val('');

						$('#batch_title').val('');

						$('#price_adult').val('0.00');

						$('#price_child').val('0.00');

						$('#car_member').val(1);

						$('#car_number').val(1);

						setSelect2Value('#batch_state', null);

						setSelect2Value('#batch_holiday', null);

						setSelect2Value('#batch_use', null);

						$('#start_before_day').val(1);

						$('#batch_stop_time').val('');

						$('#batch_start_time').val('');

						$('#batch_end_time').val('');

						$('#sub_member').val('');

						$('#batch_tip').val('');

						$('.btn_batch_append').html('添加批次');

						$('.btn_batch_remove').addClass('hidden_ctrl');

					}

					

					// 点击没有事件的日期

					function clickDayNotEvent(date, jsEvent, view) {

						console.log('点击没有事件的日期......'+date.format('YYYY-MM-DD HH:mm:ss'));
						
						console.log('title:'+view.title+',name:'+view.name);
						
						// 设置选中颜色
						$('.batch-checked').removeClass('batch-checked');
						
						$(this).addClass('batch-checked');
						
						var startDate = date.format('YYYY-MM-DD HH:mm:ss'); 
						
						// 判断该日期上是否有时间
						var jsonData = {
							
							op_type: 'find',
							
							line_id: $('#line_id').val(),
							
							start_time: startDate,
							
						}
						
						$.post('<?php echo U("line/batch");?>', jsonData, function(data){
							
							if (data.ds != null) {		
							
								$('.btn_batch_append').html('保存批次');
								
								$('.btn_batch_remove').removeClass('hidden_ctrl');
																						
			        			setLineBatch(data.ds);
			        			
							} else {
								
								cleanBatch();

								var endDate = moment(date);

								var stopDate = moment(date);

								$('#batch_start_time').val(date.format('YYYY-MM-DD HH:mm:ss'));

								var endDay = parseInt($('#travel_day').val());

								var endDateTime = endDate.add(endDay, 'days').subtract('1','seconds').format('YYYY-MM-DD HH:mm:ss');
//								var endDateTime = endDate.add(endDay, 'days').format('YYYY-MM-DD HH:mm:ss');

								$('#batch_end_time').val(endDateTime);

								var stopDay = parseInt($('#start_before_day').val());

								var stopDateTime = stopDate.subtract(stopDay, 'days').format('YYYY-MM-DD HH:mm:ss');						

								$('#batch_stop_time').val(stopDateTime);
							}
						})
					}

					

					// 点击有事件的日期

					function clickDayForEvent(evnt, jsEvent, view) {	

						console.log('点击有事件的日期......'+evnt.start.format('YYYY-MM-DD HH:mm:ss'));	

						console.log('color:'+evnt.color+',backgroundColor:'+evnt.backgroundColor);	

						$('.btn_batch_append').html('保存批次');

						$('.btn_batch_remove').removeClass('hidden_ctrl');						

			        	var ds = $.parseJSON(evnt.ds);

			        	setLineBatch(ds);
			        	
			        	// 设置选中颜色
			        	$('.batch-checked').removeClass('batch-checked');
						
						$(this).addClass('batch-checked');

					}

					

					// 初始化日历控件

					function initCarlendar() {
						
						console.log('初始化批次日历控件.....');

						var m = moment();

//						console.log(m.format('YYYY-MM-DD'));

						// Calendar Initialization

						$('#calendar').fullCalendar({

							theme: true,

							header: {

							    left: 'prevYear,nextYear,today',

							    center: 'title',

							    right: 'month,agendaWeek,agendaDay prev,next'

							},

							buttonIcons: {

								prev: 'prev fa-angle-left',

								next: 'next fa-angle-right',

							},

							monthNames: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],

							monthNamesShort: ["一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二"],

							dayNames: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"],

							dayNamesShort: ["日", "一", "二", "三", "四", "五", "六"],

							today: ["今天"],

							firstDay: 1,

							buttonText: {

							    today: '今天',

							    month: '月',

							    week: '周',

							    day: '日',

							    prev: '上一月',

							    next: '下一月',

							    prevYear: '上一年',

							    nextYear: '下一年',

							},

							defaultDate: m.format('YYYY-MM-DD'),

							defaultView: 'month',

							editable: true,

							eventLimit: true,

							eventRender: renderDay,

							events: getDayPlan,

							dayClick:clickDayNotEvent,

							eventClick:clickDayForEvent,

						});

					}

										

					// 添加一条批次信息

					function appendLineBatch(ds) {

						if (ds == null || typeof(ds) == 'undefined') {

							return false;

						}

						for (var i = 0; i < ds.length; i ++) {

							var b = ds[i];

							var vhtml = '<tr data-id="'+b.id+'">';
							
								vhtml += '<td class="source_check"><input type="checkbox" class="cbr cbr-replaced cbr-secondary selece-batch-taocan" /></td>';

								vhtml += '	<td><span class="batch_title">['+b.id+']'+b.title+'</span></td>';
												
								vhtml += '	<td><span class="batch_price">'+b.price_adult+'<br />'+b.price_child+'</span></td>';
												
								vhtml += '	<td><span class="batch_stop">'+b.stop_time+'</span></td>';
												
								vhtml += '	<td><span class="batch_start">'+b.start_time+'</span></td>';
												
								vhtml += '	<td><span class="batch_end">'+b.end_time+'</span></td>';
								
								var bstate_desc = '';
								
								if (b.state != '' && b.state != null && typeof(b.state) != 'undefined'){
									
									var bstate = JSON.parse(b.state);
									
									if (bstate.type_desc != null && typeof(bstate.type_desc) != 'undefined') {
										
										bstate_desc = bstate.type_desc;
										
									}
								} 
								
								var holiday_desc = '';
								
								if (b.holiday != '' && b.holiday != null && typeof(b.holiday) != 'undefined'){
									
									var holiday = JSON.parse(b.holiday);
									
									if (holiday.type_desc != null && typeof(holiday.type_desc) != 'undefined') {
										
										holiday_desc = holiday.type_desc;
										
									}
									
								} 
								
								var use_state_desc = '';
								
								if (b.use_state != '' && b.use_state != null && typeof(b.use_state) != 'undefined'){
									
									var use_state = JSON.parse(b.use_state);
									
									if (use_state.type_desc != null && typeof(use_state.type_desc) != 'undefined') {
										
										use_state_desc = use_state.type_desc;
										
									}
									
								}

								vhtml += '	<td class="col-md-1"><span class="batch_state">'+bstate_desc+'<br />'+holiday_desc+'<br />'+use_state_desc+'</span></td>';

								vhtml += '	<td class="col-md-1"><span class="batch_car">'+b.car_number+'车('+b.car_member+'人)</span></td>';

								vhtml += '	<td class="col-md-2">';

								vhtml += '		<button type="button" class="btn btn-secondary">编辑</button>';								

								vhtml += '		<button type="button" class="btn btn-danger">删除</button>';

								vhtml += '		<div class="batch_ds hidden_ctrl">'+JSON.stringify(b)+'</div>';				

								vhtml += '	</td>';

								vhtml += '</tr>';

							$('#table_batch').find('tbody').append(vhtml);

							$('#table_batch').find('tbody tr:last').find('.btn-secondary').click(function(ev){

								ev.preventDefault();

								$('.btn_batch_append').html('保存批次');

								$('.btn_batch_remove').removeClass('hidden_ctrl');

								var dsstr = $(this).parent().find('.batch_ds').html();

								var ds = JSON.parse(dsstr);

								setLineBatch(ds);								
								
        						$('body').animate({scrollTop:$('.batch_root').offset().top}, 500);

							});

							$('#table_batch').find('tbody tr:last').find('.btn-danger').click(function(ev){

								ev.preventDefault();

								var id = parseInt($(this).closest('tr').attr('data-id'));

								deleteLineBatch(id);

							});
							
							//绑定复选框事件
							$('#table_batch').find('tbody tr:last').find('.selece-batch-taocan').change(function(ev){
								ev.preventDefault();
								var id = parseInt($(this).closest('tr').attr('data-id'));
								addBatchToTaocan(id);
							});

						}

					}

					

					// 更新一条显示的优惠信息

					function updateLineBatch(ds) {

						if (ds == null || typeof(ds) == 'undefined') {

							return false;

						}

//						console.log(ds);

						var trObj = $('#table_batch').find('tr[data-id="'+ds.id+'"]');

						$(trObj).find('.batch_title').html(ds.title);

						$(trObj).find('.batch_price').html(ds.price_adult+'<br />'+ds.price_child);

						$(trObj).find('.batch_stop').html(ds.stop_time);

						$(trObj).find('.batch_start').html(ds.start_time);

						$(trObj).find('.batch_end').html(ds.end_time);
						
						var stateHtml = '';
						
						if (ds.state != null && ds.state != '') {
							
							var bstate = JSON.parse(ds.state);
							
							stateHtml += bstate.type_desc;
							
						}
						
						if (ds.holiday != null && ds.holiday != '') {
							
							var hstate = JSON.parse(ds.holiday);
							
							if (stateHtml != '') {
							
								stateHtml += '<br />';								
								
							} 
								
							stateHtml += hstate.type_desc;	
							
						}
						
						if (ds.use_state != null && ds.use_state != '') {
							
							var ustate = JSON.parse(ds.use_state);
							
							if (stateHtml != '') {
							
								stateHtml += '<br />';								
								
							} 
								
							stateHtml += ustate.type_desc;	
							
						}

						$(trObj).find('.batch_state').html(stateHtml);

						$(trObj).find('.batch_car').html(ds.car_number+'车('+ds.car_member+'人)');

						$(trObj).find('.batch_ds').html(JSON.stringify(ds));

					}

					

					// 设置编辑的批次信息

					function setLineBatch(ds) {     	

						$('#batch_id').val(ds.id);

						$('#batch_title').val(ds.title);

						$('#price_adult').val(ds.price_adult);

						$('#price_child').val(ds.price_child);

						$('#car_member').val(ds.car_member);

						$('#car_number').val(ds.car_number);

						setSelect2Value('#batch_state', ds.state);

						setSelect2Value('#batch_holiday', ds.holiday);

						setSelect2Value('#batch_use', ds.use_state);

						$('#start_before_day').val(ds.start_before_day);

						$('#batch_stop_time').val(ds.stop_time);

						$('#batch_start_time').val(ds.start_time);

						$('#batch_end_time').val(ds.end_time);

						$('#sub_member').val(ds.sub_member);

						$('#batch_tip').val(ds.tip);

					}

										

					// 添加批次发送数据

					function _ajaxAppendLineBatch(btnObj) {

						var carMember = parseInt($('#car_member').val());						

						var carNumber = parseInt($('#car_number').val());						

						if (carMember < 1 || carNumber < 1) {

							alert('每车人数和车数不能小于1');

							return false;

						}

						

						var opType = $(btnObj).html() == '添加批次' ? 'create' : 'save';

						var aid = $('#batch_id').val();						

						var jsonData = {

							op_type: opType,

							line_id: $('#line_id').val(),

							id: aid,

							title: $('#batch_title').val(),

							price_adult: $('#price_adult').val(),

							price_child: $('#price_child').val(),

							car_member: carMember,

							car_number: carNumber,

							state: getSelect2Value('#batch_state'),

							holiday: getSelect2Value('#batch_holiday'),

							use_state: getSelect2Value('#batch_use'),

//							stop_time: $('#batch_stop_time').val(),

							start_time: $('#batch_start_time').val(),

							start_before_day: $('#start_before_day').val(),

							tip: $('#batch_tip').val(),

						};

//						console.log(JSON.stringify(jsonData));
//						return false;

						$.post('<?php echo U("line/batch");?>', jsonData, function(data){

							if (data.result.errno == 0) {

								if (opType == 'save') {	

									$('#calendar').fullCalendar('removeEvents', aid);

									updateLineBatch(data.ds);

								} else {

									var temp = [data.ds];

									appendLineBatch(temp);

								}

								var evnt = {

									id: data.ds.id,

									title: data.ds.title,

									start: data.ds.start_time,

									ds: JSON.stringify(data.ds),

								}

								$('#calendar').fullCalendar('renderEvent', evnt);	

							} else {

								toastr.error(data.result.message);

							}

							cleanBatch();

						});

					}

										

					// 删除批次

					function deleteLineBatch(aid) {

						if (confirm('您确定删除该批次吗？') == false) {

							return false;

						}

						var jsonData = {

							op_type: 'delete',

							id: aid,

						}

						$.post('<?php echo U("line/batch");?>', jsonData, function(data){

							if (data.result.errno == 0) {

								$('#calendar').fullCalendar('removeEvents', aid);

								$('#table_batch').find('tr[data-id="'+aid+'"]').remove();

								cleanBatch();

							} else {

								alert(data.result.message);

							}

						});

					}

					

					// 当截止报名天数变化

					function stopDateTimeChanged() {

						if ($('#start_before_day').val() == '') {

							return false;

						}

						var m = moment($('#batch_start_time').val());

						var stopDay = parseInt($('#start_before_day').val());

						var stopDateTime = m.subtract(stopDay, 'days').format('YYYY-MM-DD HH:mm:ss');						

						$('#batch_stop_time').val(stopDateTime);

						return true;

					}

					

					$(document).ready(function(){

						// 初始化日历控件

						initCarlendar();

						

						// 截止报名天数发生变化

						$('#start_before_day').blur(stopDateTimeChanged);

						

						// 保存或添加批次

						$('.btn_batch_append').click(function(ev){

							ev.preventDefault();

							_ajaxAppendLineBatch(this);

						});

						

						// 删除批次

						$('.btn_batch_remove').click(function(ev){

							ev.preventDefault();

							var aid = parseInt($('#batch_id').val());	

							deleteLineBatch(aid);

						});																       

					});
					
					
					// 批次全选
					$('.check_all_budget').change(function(ev){
						ev.preventDefault();
						var ck = $(this).prop('checked');
						$(this).closest('table').find('tbody tr').each(function(i, ev){
							$(this).find('td:first').find('.cbr').prop('checked', ck).trigger('change');
						});
					});
					
					//添加批次信息到套餐版块
					function addBatchToTaocan(bid){
						var ck = $('#table_batch').find('tr[data-id="'+bid+'"]').find('.selece-batch-taocan');
						var aa = $('#table_batch').find('tr[data-id="'+bid+'"]').find('.batch_start').html();
						aa = aa.split(' ');
						if(ck.prop('checked')){
							var addhtml = '<button class="btn btn-success btn-sm" type="button" data-id="'+bid+'">'+aa[0]+'</button>';
							$('.taocan-selece-batch-list').append(addhtml);
						}else{
							$('.taocan-selece-batch-list').find('button[data-id="'+bid+'"]').remove();
						}
					}
					
					//清除套餐版块所选批次
					$('.btn-clear-batch-select').click(function(){
						$('#table_batch').find('tbody tr').each(function(i, ev){
							$(this).find('td:first').find('.cbr').prop('checked', false).trigger('change');
						});
					});
					
					//套餐按钮点击事件
					$('.select-taocan-btn').click(function(){
						if($(this).hasClass('btn-success')){
							$(this).removeClass('btn-success');
							$(this).addClass('btn-gray');
						}else{								
							$(this).parent().find('button.select-taocan-btn').each(function(){
								$(this).removeClass('btn-success');
								$(this).addClass('btn-gray');
							});
							
							$(this).removeClass('btn-gray');
							$(this).addClass('btn-success');
						}	
					});
					
					//清除套餐版块所选套餐
					$('.btn-clear-taocan-select').click(function(){
						$(this).parent().find('button.select-taocan-btn').each(function(){
							$(this).removeClass('btn-success');
							$(this).addClass('btn-gray');
						});
					});
					
					//增加套餐按钮点击事件
					$('.add-taocan-price-btn').click(function(){						
						if(window.confirm('你确定要保存套餐价格？') == false){
							return false;
						}
						
						//选中套餐
						var vtaocan_ids = ',',flagTcIds='',vttaocan_desc='';
						$('.taocan-list').find('button.btn-success').each(function(){
							vtaocan_ids += $(this).attr('data-id') + ',';
							flagTcIds += $(this).attr('data-id');
							vttaocan_desc += $(this).html() + ',';
						});
						
						if(vtaocan_ids == ','){
							toastr.error('请选择套餐信息!');
							return false;							
						}
						
						if($('.taocan-selece-batch-list').find('button.btn-success').length == 0){							
							toastr.error('请选择批次信息!');
							return false;
						}
						
						if ($('#taocan_price_adult').val() == '') {
							toastr.error('请填写套餐成人价格!');
							return false;
						}
						
						if ($('#taocan_price_child').val() == '') {
							toastr.error('请填写套餐儿童价格!');
							return false;
						}
							
						var jsonData = {
							op_type: 'create_taocan_price',
							datas:[],
						};
						
						$('.taocan-selece-batch-list').find('button.btn-success').each(function(){
							var batchId = $(this).attr('data-id');
							var dates = $(this).html().split(' ');
							var startDate = dates.length > 0 ? dates[0] : batchId; 
							var taocan = {
								id: $('.add-taocan-price-btn').attr('data-price-id'),
								line_id:$('#line_id').val(),
								batch_id: batchId,
								batch_date: startDate,
								taocan_ids:vtaocan_ids,
								taocan_ids_flag: flagTcIds,
								taocan_ids_descs:vttaocan_desc,
								price_adult:$('#taocan_price_adult').val(),
								price_child:$('#taocan_price_child').val(),
							}
							jsonData.datas.push(taocan);
						});
							
						$.post('<?php echo U("line/taocan");?>', jsonData, function(data) {
							if (data.jumpUrl != null) {
								location.href = data.jumpUrl;
								return false;
							}
							if (data.errorDS != null) {										
								console.log('未保存成功的数据:'+JSON.stringify(data.errorDS))
							}
					        if (data.result.errno == 0) {
					            toastr.success(data.result.message);
					            if (data.resultDS != null) {
					            	for (var i=0; i < data.resultDS.length; i++) {
					            		var d = data.resultDS[i];
										console.log(JSON.stringify(d));
					            		if (d.op == 'create') {
					            			appendPriceHtml(d);
					            		} else {
					            			updatePriceHtml(d);
					            		}		            		
					            	}
					            }
					        }else{
					            toastr.error(data.result.message);							        
					        }
						});						
					});
					
					// 添加新的套餐价格到页面
					function appendPriceHtml(addata) {
						var addHtml = 	'<tr data-id="'+addata.id+'">';
							addHtml += 	'	<td class="price-id">'+addata.id+'</td>';
							addHtml += 	'	<td class="batch-data" data-batch-id="'+addata.batch_id+'">'+addata.batch_date+'</td>';
							addHtml += 	'	<td class="tacan-ids-desc" data-taocan-ids="'+addata.taocan_ids+'">'+addata.taocan_ids_descs+'</td>';
							addHtml += 	'	<td class="taocan-price-adult">'+addata.price_adult+'</td>';
							addHtml += 	'	<td class="taocan-price-child">'+addata.price_child+'</td>';
							addHtml += 	'	<td>';
							addHtml += 	'		<button class="btn btn-secondary edit-taocan-price" data-id="'+addata.id+'" type="button">编辑</button>';
							addHtml += 	'		<button class="btn btn-danger remove-taocan-price" data-id="'+addata.id+'" type="button">删除</button>';
							addHtml += 	'	</td>';
							addHtml += 	'</tr>';
							
						$('#taocan-price-list').append(addHtml);
						
						var trObj = $('#taocan-price-list').find('tr:last');
						$(trObj).find('.edit-taocan-price').click(function(ev){
							ev.preventDefault();
							editTaocanPrice($(this).attr('data-id'));
						});
						
						$(trObj).find('.remove-taocan-price').click(function(ev){
							ev.preventDefault();
							removeTaocanPrice($(this).attr('data-id'));
						});
					}
					
					// 更新编辑套餐时页面数据
					function updatePriceHtml(update) {
						if (update == null || typeof(update) == 'undefined') {
							return false;
						}
						var trObj = $('#taocan-price-list').find('tr[data-id="'+update.id+'"]');						
						$(trObj).find('td.batch-data').html(update.batch_date);
						$(trObj).find('td.batch-data').attr('data-batch-id', update.batch_id);
						$(trObj).find('td.tacan-ids-desc').html(update.taocan_ids_descs);
						$(trObj).find('td.tacan-ids-desc').attr('data-taocan-ids', update.taocan_ids);
						$(trObj).find('td.taocan-price-adult').html(update.price_adult);
						$(trObj).find('td.taocan-price-child').html(update.price_child);		
					}
					
					// 开始编辑套餐
					function editTaocanPrice(tpid) {
						var tpObj = $('#taocan-price-list').find('tr[data-id="'+tpid+'"]');
						var tpBatchId = tpObj.find('td.batch-data').attr('data-batch-id');
						var tpTaocanIds = tpObj.find('td.tacan-ids-desc').attr('data-taocan-ids');
						// 设置套现价格编号
						$('.add-taocan-price-btn').attr('data-price-id', tpid);
						// 清除批次选中
						$('#table_batch').find('tbody tr').each(function(i, ev){
							$(this).find('td:first').find('.cbr').prop('checked', false).trigger('change');
						});
						// 选中该批次
						$('#table_batch').find('tbody tr[data-id="'+tpBatchId+'"]').find('.selece-batch-taocan').prop('checked', true).trigger('change');
						// 清除套餐选中
						$('.taocan-list').find('button.select-taocan-btn').each(function(){
							$(this).removeClass('btn-success');
							$(this).addClass('btn-gray');
						});
						// 选中该套餐
						tpTaocanIdsArr = tpTaocanIds.split(',');
						for(var i = 0; i < tpTaocanIdsArr.length; i++){
							if(tpTaocanIdsArr[i] != '') {								
								$('.taocan-list').find('button[data-id="'+tpTaocanIdsArr[i]+'"]').each(function(){
									$(this).removeClass('btn-gray');
									$(this).addClass('btn-success');
								});
							}
						}
						//设置成人价
						$('#taocan_price_adult').val(tpObj.find('td.taocan-price-adult').html());
						//设置儿童价						
						$('#taocan_price_child').val(tpObj.find('td.taocan-price-child').html());
						//滚动到套餐编辑处
						$('html,body').animate({scrollTop:$('.taocan-box').offset().top}, 500);
					}
					
					// 删除已编辑的套餐价格
					function removeTaocanPrice(tpid) {
						
						if (confirm('确定删除该批次套餐？') == false) {
							return false;
						}
						var jsonData = {
							op_type:'remove_taocan_price',
							tp_id:tpid,
						};
						
						$.post('<?php echo U("line/taocan");?>', jsonData, function(data){
							console.log(JSON.stringify(data));
							var trObj = $('#taocan-price-list').find('tr[data-id="'+tpid+'"]');
							if (data.jumpUrl != null) {
								location.href = data.jumpUrl;
							}
							
							if(data.result.errno == 0){
								toastr.success('批次套餐移除成功');
								$(trObj).remove();
							}else{
								toastr.error(data.result.message);
							}
						});
						
					}
					
					$('.edit-taocan-price').click(function(ev){
						ev.preventDefault();
						var tpid = $(this).attr('data-id');	
						editTaocanPrice(tpid);
					});
									
					$('.remove-taocan-price').click(function(ev){
						ev.preventDefault();
						var tpid = $(this).attr('data-id');	
						removeTaocanPrice(tpid);
					});
				</script>
			</div> <!--Tab7 End-->
			
			<div class="tab-pane with-bg" id="fwv-9">
				
				<div class="row">				
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="special_cut_start_date_time">开始日期<span style="color:red;">(*必选)</span></label>
							<div class="date-and-time">
								<input type="text" class="form-control datepicker" name="special_cut_start_date" id="special_cut_start_date" data-format="yyyy-mm-dd">
								<input type="text" class="form-control timepicker" name="special_cut_start_time" id="special_cut_start_time" data-template="dropdown" data-show-seconds="true" data-show-meridian="false" data-minute-step="5" data-second-step="5" />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="special_cut_end_time">截止日期<span style="color:red;">(*必选)</span></label>
							<div class="date-and-time">
								<input type="text" class="form-control datepicker" name="special_cut_end_date" id="special_cut_end_date" data-format="yyyy-mm-dd">
								<input type="text" class="form-control timepicker" name="special_cut_end_time" id="special_cut_end_time" data-template="dropdown" data-show-seconds="true" data-show-meridian="false" data-minute-step="5" data-second-step="5" />
							</div>
						</div>
					</div>		
				</div>
				
				<br>
				
				<div class="row">	
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="special_cut_percent">优惠百分比<span style="color:red;">(*与优惠金额至少选其一)</span></label>
							<input class="form-control" name="special_cut_percent" id="special_cut_percent" data-validate="number" placeholder="请输入优惠的百分比" />
						</div>
					</div>	
					
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="special_cut_money">优惠金额<span style="color:red;">(*与优惠百分比至少选其一)</span></label>
							<input class="form-control" name="special_cut_money" id="special_cut_money" data-validate="number" placeholder="请输入优惠的金额"/>
						</div>
					</div>	
				</div>
				
				<div class="row">					
					<div class="col-md-6">						
						<div class="form-group">
							<label class="control-label" for="special_cut_type">优惠条件类型<span style="color:red;">(*必选)</span></label>
							<script type="text/javascript">
								$(document).ready(function(){
									$("#special_cut_type").select2({
//										minimumInputLength: 1,
										minimumResultsForSearch: Infinity,
										placeholder: '选择产品的优惠条件类型',
										ajax: {
											url: '<?php echo U("help/listtypedata");?>',
											type: 'post',
											dataType: 'json',
											quietMillis: 100,
											data: function(term, page) {
												return {op:term, type_key:'line_special_offer'};
											},
											results: function(data, page){
												if (data.result.errno == 0) {
													if (data.ds == null) {
														data.ds = new Array();	
													}
													return { results: data.ds }
												} else {
													return { results: '' };	
												}
											},
											cache: true,
										},
										formatResult: function(data) { 					
											return '<div class="select2-user-result cx_border02">' + data.type_desc + '</div>';
										},	
										formatSelection: function(data) {
											selectSpecialCutType(data);						
											return data.type_desc;
										},						
									});
								});
							</script>
							<input class="form-control" type="text" name="special_cut_type" id="special_cut_type" />							
							<input type="hidden" id="special_cut_id" value=""/>	
						</div>							
					</div>	
				</div>
				
				<div class="row hidden_ctrl special_cut_condition line_special_offer_full_cut">					
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="special_cut_cond_full">订单金额<span style="color:red;">(*必须输入)</span></label>
							<input class="form-control" name="special_cut_cond_full" id="special_cut_cond_full" data-validate="number" placeholder="请输入达到满减的订单金额" />
						</div>
					</div>
				</div>
				
				<div class="row hidden_ctrl special_cut_condition line_special_offer_count">					
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="special_cut_cond_count">订单人数<span style="color:red;">(*必须输入)</span></label>
							<input class="form-control" name="special_cut_cond_count" id="special_cut_cond_count" data-validate="number" placeholder="请输入订单优惠需要达到的人数" />
						</div>
					</div>
					
					<div class="col-md-1">						
						<div class="form-group">
							<label class="control-label" for="special_cut_cond_count_child">包含小孩</label><br />							
						    <input id="special_cut_cond_count_child" name="special_cut_cond_count_child" type="checkbox" checked class="iswitch iswitch-secondary">
						</div>						
					</div>
				</div>
				
				<div class="row">					
					<div class="col-md-6">						
						<div class="form-group">
							<button class="btn btn-secondary btn_special_cut_save">添加优惠</button>
							<button class="btn btn-secondary btn_special_cut_reset">重置内容</button>
						</div>						
					</div>			
				</div>		
								
				<div class="row">
					<div class="col-md-12">				
						<div class="form-group">
							<table id="table_special_cut" class="table text-left" style="width: 80%;">
								<thead>
									<tr>
										<th class="col-md-2">起始时间</th>
										<th class="col-md-2">结束时间</th>
										<th class="col-md-1">优惠百分比</th>
										<th class="col-md-1">优惠金额</th>
										<th class="col-md-4">优惠条件</th>
										<th class="col-md-2">编辑/删除</th>
									</tr>
									<tbody>
									</tbody>
								</thead>
							</table>
						</div>	
					</div>
				</div>
			
				
				<script type="text/javascript">
					
					// 当选择优惠条件时
					function selectSpecialCutType(data) {
						$('.special_cut_condition').each(function(i, elmt) {
							if ($(elmt).hasClass(data.type_key)) {
								$(elmt).removeClass('hidden_ctrl');	
							} else {
								$(elmt).addClass('hidden_ctrl');
							}
						});
					}
					
					// 重置优惠信息
					function resetSpecialCut() {
						$('#special_cut_id').val();
						var m = moment(new Date());
						$('#special_cut_start_date').val(m.format('YYYY-MM-DD'));
						$('#special_cut_start_time').val(m.format('HH:mm:ss'));
						m.add(1, 'days');
						$('#special_cut_end_date').val(m.format('YYYY-MM-DD'));
						$('#special_cut_end_time').val(m.format('HH:mm:ss'));
						$('#special_cut_percent').val('');
						$('#special_cut_money').val('');
//						setSelect2Value('#special_cut_type', null);
						$('#special_cut_cond_full').val('');
						$('#special_cut_cond_count').val('');
						$('#special_cut_cond_count_child').prop('checked', true).trigger('change');
						$('.btn_special_cut_save').html('添加优惠');
					}
					
					// 添加一条显示的优惠信息
					function appendSpecialCut(ds) {
						if (ds == null || typeof(ds) == 'undefined') {
							return false;
						}
						for (var i = 0; i < ds.length; i ++) {
							var s = ds[i];
							var vhtml = '<tr data-id="'+s.id+'">';
								vhtml += '	<td class="col-md-2"><span class="special_cut_start_time">'+s.start_time+'</span></td>';
								vhtml += '	<td class="col-md-2"><span class="special_cut_end_time">'+s.end_time+'</span></td>';
								vhtml += '	<td class="col-md-1"><span class="special_cut_percent">'+s.cut_percent+'</span></td>';
								vhtml += '	<td class="col-md-1"><span class="special_cut_money">'+s.cut_money+'</span></td>';
								vhtml += '	<td class="col-md-4"><span class="special_cut_condition_text">'+s.condition+'</span></td>';
								vhtml += '	<td class="col-md-2">';
								vhtml += '		<button type="button" class="btn btn-secondary">编辑</button>';								
								vhtml += '		<button type="button" class="btn btn-danger">删除</button>';							
								vhtml += '	</td>';
								vhtml += '</tr>';
							$('#table_special_cut').find('tbody').append(vhtml);
							$('#table_special_cut').find('tbody tr:last').find('.btn-secondary').click(editSpecialCut);
							$('#table_special_cut').find('tbody tr:last').find('.btn-danger').click(deleteSpecialCut);
						}
					}
					
					// 更新一条显示的优惠信息
					function updateSpecialCut(ds) {
						if (ds == null || typeof(ds) == 'undefined') {
							return false;
						}
						console.log(ds);
						var trObj = $('#table_special_cut').find('tr[data-id="'+ds.id+'"]');
						$(trObj).find('.special_cut_start_time').html(ds.start_time);
						$(trObj).find('.special_cut_end_time').html(ds.end_time);
						$(trObj).find('.special_cut_percent').html(ds.cut_percent);
						$(trObj).find('.special_cut_money').html(ds.cut_money);
						$(trObj).find('.special_cut_condition_text').html(ds.condition);
					}
					
					// 设置优惠信息
					function setSpecialCutData(ds) {
						if (ds == null || typeof(ds) == 'undefined') {
							return false;
						}
						$('#special_cut_id').val(ds.id);
						var start = ds.start_time.split(' ');
						console.log(start);
						$('#special_cut_start_date').val(start[0]);
						$('#special_cut_start_time').val(start[1]);
						var end = ds.end_time.split(' ');
						console.log(end);
						$('#special_cut_end_date').val(end[0]);
						$('#special_cut_end_time').val(end[1]);
						$('#special_cut_percent').val(ds.cut_percent);
						$('#special_cut_money').val(ds.cut_money);
						setSelect2Value('#special_cut_type', ds.type_id);						
						var vals = JSON.parse(ds.type_id);
						selectSpecialCutType(vals);
						$('#special_cut_cond_full').val(ds.cond_full);
						$('#special_cut_cond_count').val(ds.cond_count);
						$('#special_cut_cond_count_child').prop('checked', ds.cond_count_child == 1 ? true : false).trigger('change');						
						$('.btn_special_cut_save').html('保存优惠');
					}
					
					// 获取优惠信息
					function getSpecialCutData() {
						var jsonData = {
							id: $('#special_cut_id').val(),
							line_id: $('#line_id').val(),
							start_time: $('#special_cut_start_date').val()+' '+$('#special_cut_start_time').val(),
							end_time: $('#special_cut_end_date').val()+' '+$('#special_cut_end_time').val(),
							cut_percent: $('#special_cut_percent').val(),
							cut_money: $('#special_cut_money').val(),
							type_id: getSelect2Value('#special_cut_type', ['id', 'type_key', 'type_desc']),
							cond_full: $('#special_cut_cond_full').val(),
							cond_count: $('#special_cut_cond_count').val(),
							cond_count_child: $('#special_cut_cond_count_child').prop('checked') ? 1 : 0,
						}
						return jsonData;
					}
					
					// 添加保存优惠信息
					function saveSpecialCut(ev) {
						ev.preventDefault();
						var btnText = $('.btn_special_cut_save').html();
						var opType = btnText == '添加优惠' ? 'create' : 'save';
						var jsonData = getSpecialCutData();
						jsonData['op_type'] = opType;
						
						$.post('<?php echo U("line/specialOffer");?>', jsonData, function(data){
							if (data.result.errno == 0) {
								if (opType == 'create') {
									var temp = [data.ds];
									appendSpecialCut(temp);	
								} else {
									updateSpecialCut(data.ds);
								}
								resetSpecialCut();
							} else {
								alert(data.result.message);
							}	
						});
					}
					
					// 编辑优惠信息
					function editSpecialCut(ev) {
						ev.preventDefault();
						var trObj = $(this).closest('tr');
						var jsonData = {
							op_type: 'find',
							id: $(trObj).attr('data-id'),
						}; 
						
						$.post('<?php echo U("line/specialOffer");?>', jsonData, function(data){
							if (data.result.errno == 0) {
								setSpecialCutData(data.ds);
							} else {
								alert(data.result.message);
							}	
						});
					}
					
					// 删除优惠信息
					function deleteSpecialCut(ev) {
						ev.preventDefault();
						var trObj = $(this).closest('tr');
						var jsonData = {
							op_type: 'delete',
							id: $(trObj).attr('data-id'),
						}; 
						
						$.post('<?php echo U("line/specialOffer");?>', jsonData, function(data){
							if (data.result.errno == 0) {
								$(trObj).remove();
							} else {
								alert(data.result.message);
							}	
						});
					}
					
					// 初始化
					$(document).ready(function(){
						// 初始化数据
						var m = moment(new Date());
						$("#special_cut_start_date").val(m.format('YYYY-MM-DD'));
						$('#special_cut_start_time').val(m.format('HH:mm:ss'));
						m.add(1, 'days');
						$("#special_cut_end_date").val(m.format('YYYY-MM-DD'));
						$('#special_cut_end_time').val(m.format('HH:mm:ss'));
						
						// 保存优惠信息
						$('.btn_special_cut_save').click(saveSpecialCut);
						// 重置优惠信息
						$('.btn_special_cut_reset').click(function(ev){							
							ev.preventDefault();
							resetSpecialCut();
						});
//						// 编辑优惠信息
//						$('.btn_special_cut_edit').click(editSpecialCut);
//						// 删除优惠信息
//						$('.btn_special_cut_remove').click(deleteSpecialCut);
					});
					
				</script>
			</div> <!--Tab8 End-->
			
			
			<!-- Tabs Pager -->
			
			<ul class="pager wizard">
				<li class="previous">
					<a href="#"><i class="entypo-left-open"></i> 上一步</a>
				</li>
				
				<li>
					<a href="#" class="btn_preview">预览 <i class="entypo-right-open"></i></a>
				</li>
				
				<li class="next">
					<a href="#">下一步 <i class="entypo-right-open"></i></a>
				</li>
			</ul>
			
		</div>
			
	</form>
	
	<script type="text/javascript">
		function getCurrentActiveTabPanelIndex(obj) {
			var idx = -1;
			$('.tabs li').each(function(i,el){
				if (el == obj) {
					idx = i;
				}
			});			
			return idx;
		}
	
		function getPreviewActiveTabPanelIndex() {
			var idx = -1;
			$('.tabs li').each(function(i,el){
				if ($(el).hasClass('active')) {
					idx = i;
				}
			});			
			return idx;
		}
		
		function createLine() {
			var jsonData = getLineBaseInfo();
			jsonData['op_type'] = parseInt($('#line_id').val()) > 0 ? 'edit' : 'create';
//			console.log(JSON.stringify(jsonData));
			$.post('<?php echo U("line/create");?>', jsonData, function(data){
				if (data.result.errno == 0) {
//					console.log(jsonData['op_type']+'==>'+JSON.stringify(data));
					if (jsonData['op_type'] == 'create') {
						$('#line_id').val(data.id);
					}
					
					toastr.success('保存信息成功','反馈信息');
				} else if (data.result.errno == -4) {
					toastr.warning(data.result.message,'提示信息');
				} else {
					toastr.error(data.result.message, '错误信息');
				}
			});
		}
		
		var initializedCalendar = false;
		function procStep(prevStep, curStep) {
			if (prevStep == 0) {			// 线路信息
				createLine();
			} else if (prevStep == 1) {		// 行程亮点
				
			} else if (curStep == 2) {		// 手机行程亮点
				
			} else if (curStep == 3) {		// 行程说明
				
			} else if (prevStep == 4) {		// 游记攻略
				
			} else if (prevStep == 5) {		// 沿途风光
				
			} else if (prevStep == 6) {		// 产品问答
				
			} else if (prevStep == 7) {		// 产品批次
			
			} else if (prevStep == 8) {		// 产品优惠
			
			}
			
			if (curStep == 0) {			// 线路信息
			
			} else if (curStep == 1) {		// PC行程亮点
				
			} else if (curStep == 2) {		// 手机行程亮点
				
			} else if (curStep == 3) {		// 行程说明
				
			} else if (curStep == 4) {		// 游记攻略
				
			} else if (curStep == 5) {		// 沿途风光
				
			} else if (curStep == 6) {		// 产品问答
				
			} else if (curStep == 7) {		// 产品批次
//				var m = moment();
				if (!initializedCalendar) {
					initializedCalendar = true;
					$('#fwv-8').show();
					$('#calendar').find('.fc-today-button').trigger('click');
				}
			} else if (curStep == 8) {		// 产品优惠
			
			}
		}
		
		// 是否继续上次编辑
		function initLine() {	
			showLoading(true, '等待数据填充完毕......');
			
			var aid = $('#line_id').val();
			var jsonData = {};
			if (aid != '' && parseInt(aid) > 0) {		
				jsonData['op_type'] = 'find';
				jsonData['id'] = aid;
			} else {
//				if (confirm('您是否要继续上次产品编辑?') == false) {
//					return false;
//				}
//				jsonData['op_type'] = 'last';
				showLoading(false);	
				return false;
			}
			
			$.post('<?php echo U("line/find");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					console.log('0.................');
					// 设置基本信息
					setLineBaseInfo(data.ds);
					console.log('1.................');
					// 添加PC行程亮点
					appendLinePoint('#fwv-2', data.ds.points);
					console.log('2.................');
					// 添加手机行程亮点
					appendLinePoint('#fwv-3', data.ds.phone_points);
					console.log('3.................');
					// 添加行程说明
					appendTravelDay(data.ds.travels);
					console.log('4.................');
					// 添加绑定的文章信息
//					appendBindArticles(data.ds.articles);
					// 产品的其他设置
					appendLineSet(data.ds.sets);
					console.log('5.................');
					// 添加沿途风光					
					appendLinePoint('#fwv-6', data.ds.scenery);
					console.log('6.................');
					// 添加问题信息
					appendQuestionData(data.ds.questions, data.ds.question_page_count);
					console.log('7.................');
					// 添加批次信息
					appendLineBatch(data.ds.batchs);
					console.log('8.................');
					// 添加优惠信息
					appendSpecialCut(data.ds.offers);
					console.log('9.................');
				} else {
					alert('未能获取到上次的编辑信息');
				}
				showLoading(false);				
			})
		}
		
		// 添加类型数据
		function appendTypeData() {
			var typeKey = $(this).attr('data-type-key');
			showModalTypeDataDialog(typeKey);
		}
		
		// 线路预览
		$('.btn_preview').click(function(ev){
			var lineId = $('#line_id').val();
			if (lineId == '' || lineId == 0) {
				alert('请先生成线路信息');
				return false;
			}
			
			var w = window.open();
			$.post('<?php echo U("line/create");?>',{op_type:'preview', id:lineId},function(data){
				if (data.result.errno != 0) {
					toastr.error(data.result.message);
				}
				if (data.salt != null) {
					w.location = 'http://kllife.com/home/index.php?s=/home/line/info/id/'+lineId+'/p/'+data.salt;
				} else {
					w.close();
				}
			});
		});
		
		$(document).ready(function(){
			// 初始化编辑信息
			initLine();
			
			// 添加类型
			$('.btn_append_type_data').click(appendTypeData);
			
			$('.tabs li').click(function(){
				procStep(getPreviewActiveTabPanelIndex(), getCurrentActiveTabPanelIndex(this));
			});
			$('.pager > .previous').click(function(){
				if ($(this).hasClass('disabled') === false) {
					var prevIndex = getPreviewActiveTabPanelIndex();
					procStep(prevIndex, prevIndex-1);	
				}
			});
			$('.pager > .next').click(function(){
				if ($(this).hasClass('disabled') === false) {
					var prevIndex = getPreviewActiveTabPanelIndex();
					procStep(prevIndex, prevIndex+1);
				}
			});
		});
		
	</script>
	
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