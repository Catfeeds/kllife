document.write('<script language="javascript" src="http://kllife.com/source/Static/common/js/jquery.lazyload.js"></script>');

// 自消失弹出框配置
toastr.options = {
  closeButton: true,
  debug: false,
  progressBar: true,
  positionClass: "toast-top-center",
  onclick: null,
  showDuration: "300",
  hideDuration: "1000",
  timeOut: "3000",
  extendedTimeOut: "1000",
  showEasing: "swing",
  hideEasing: "linear",
  showMethod: "fadeIn",
  hideMethod: "fadeOut"
}

// 更新缓存信息
function updateCache() {
	var jsonData = {
		op_type: 'update',
		key: $(this).attr('data-set'),
	};
	
	var opVal = $(this).attr('data-op');
	if (opVal != null && opVal != 'undefined' && opVal != '') {
		jsonData['op'] = opVal;
	}
	
	var stationId = $(this).attr('data-station');
	if (stationId != null && stationId != 'undefined' && stationId != '') {
		jsonData['station_id'] = stationId;
	}
	
	$.post('http://kllife.com/back/index.php?s=/back/help/cache', jsonData, function(data){
		if (data.result != null) {
			if (data.result.errno == 0) {
				toastr.success('更新缓存成功！！！');
				// 主动加载更新
				if (data.url1 != null) {
					$.getJSON(data.url1,{},function(){toastr.success('PC页面更新缓存成功！！！');});
				}
				if (data.url2 != null) {
					$.getJSON(data.url2,{},function(){toastr.success('手机页面更新缓存成功！！！');});
				}
			} else {
				toastr.error(data.result.message);
			}	
		} else {
			toastr.error('更新缓存失败！！！');
		}
	});
}

$(document).ready(function(){
	// 绑定跟新缓存
	$('.update_cache').click(updateCache);
	
	// 延时加载
    $(".lazyload").lazyload({
        placeholder : 'http://kllife.com/source/Static/common/images/grey.gif',
        effect      : "fadeIn",
        threshold : 100,
        failure_limit : 10
    });
});

// Element Attribute Helper
function attrDefault($el, data_var, default_val)
{
	if(typeof $el.data(data_var) != 'undefined')
	{
		return $el.data(data_var);
	}
	
	return default_val;
}

// 绑定气泡
// obj:绑定气泡的对象
// content:气泡的内容文字
// title:气泡的标题
// type:气泡的类型。默认:0=tooltip, 可选:1=popover
// pos:气泡的响应位置。 默认:0=top, 可选:1=right,2=bottom,3=left
// evnt:气泡响应事件。默认：0=划过事件, 可选:1=click
function bindToolTip(obj) {
	if (obj == null || $(obj).length == 0) {
		console.log('绑定气泡失败');
		return false;
	}
	
	var toggle = attrDefault(obj, 'data-toggle', 'tooltip'),
		vplacement = attrDefault(obj, 'data-placement', 'top'),
		vtriggle = attrDefault(obj, 'data-trigger', 'hover'),
		tooltip_class = null,
		show_evnt = '';
	
	if (toggle == 'popover') {
		show_evnt = 'show.bs.popover';
		tooltip_class = $(obj).get(0).className.match(/(popover-[a-z0-9]+)/i);
		$(obj).popover({
			placement: vplacement,
			trigger: vtriggle
		});		
	} else {
		show_evnt = 'show.bs.tooltip';
		tooltip_class = $(obj).get(0).className.match(/(tooltip-[a-z0-9]+)/i);
		$(obj).tooltip({
			placement: vplacement,
			trigger: vtriggle
		});		
	}
		
	if(tooltip_class && show_evnt)
	{
		$(obj).removeClass(tooltip_class[1]);		
		$(obj).on(show_evnt, function(ev)
		{
			setTimeout(function()
			{
				var $tooltip = $(obj).next();						
				$tooltip.addClass(tooltip_class[1]);				
			}, 0);
		});
	}
}

// 发送登录社区数据
function loginShequ(ds, jumpUrl, station) {
	console.log(JSON.stringify(ds));
	var asyncUrl = 'http://shequ.kllife.com/api/SetLogin/';
	var loginUrl = 'http://shequ.kllife.com/Index/setdologin.html';
	if (station != null && station != 'undefined') {
		if (station == 1) {	// 手机站
			asyncUrl = 'http://shequ.kllife.com/Mobile/api/SetLogin/';
			loginUrl = 'http://shequ.kllife.com/Mobile/index/setdologin.html';
		}
	}
	$.ajax({
		url: asyncUrl,
		async: false,		// 同步执行
		type: 'POST',
		data: ds,
		dataType: 'json',
		success: function(data) {
			console.log('同步:'+JSON.stringify(data));
			if (data.signature != null && data.signature != 'undefined') {
				location.href = loginUrl+'?s1='+data.signature+'&jump_url='+encodeURIComponent(jumpUrl);
//				var loginUrl = 'http://shequ.kllife.com/Index/setdologin.html';
//				$.getJSON(loginUrl,
//					{
//						s1: data.signature,
//						jump_url: jumpUrl,
//					},
//					function(data){
//						console.log('登录:'+JSON.stringify(resp));
//					});
//				$.ajax({
//					url: loginUrl,
//					async: false,		// 同步执行
//					type: 'POST',
//					data: {
//						s1: data.signature,
//						jump_url: jumpUrl,
//					},
//					dataType: 'json',
//					success: function(resp) {
//						location.href = jumpUrl;
//						console.log('登录:'+JSON.stringify(resp));
//					},
//					error: function(resp, err, excp) {
//						console.log('登录社区失败：'+JSON.stringify(err));
//					}			
//				});
			}			
		},
		error: function(resp, err, excp) {
			console.log('同步登录信息错误：'+JSON.stringify(err));
		}			
	});
//	$.post('http://shequ.kllife.com/api/SetLogin/', ds, function(data){
//		console.log(''+JSON.stringify(data));
//		var acct = $ds['phone'];
//		if (empty(acct)) {
//			acct = $ds['email'];
//			if (empty(acct)) {
//				acct = $ds['username'];
//			}
//		}
////		$.post('http://shequ.kllife.com/Index/dologin.html',{phone:acct, ds['password']},function(){
////			console.log('login:'+JSON.stringify(data));			
////		});
//	});
}

// 发送退出社区数据
function logoutShequ(exitUrl, station) {
	var logoutUrl = 'http://shequ.kllife.com/Index/logout.html';
	$.post(exitUrl, {}, function(){
		if (station != null && station != 'undefined') {
			if (station == 1) {	// 手机站
				logoutUrl = 'http://shequ.kllife.com/Mobile/index/logout.html';
			}
		}
		location.href = logoutUrl;	
	});
	$.post('http://shequ.kllife.com/api/LoginOut/', {}, function(data){
		console.log(JSON.stringify(data));
	});
}

// 绑定按键弹起事件
function bindKeyUp(obj, funcCallBack, param) {
	$(obj).on('keyup',function(e){
		if(e.keyCode === 13){
			funcCallBack(param);
		}
	});
}

// 获取性别编码
function getSex(sexstr, show) {
	if (show) {
		if (sexstr == 1) {
			return '男';
		} else if (sexstr == 1) {
			return '女';
		} else {
			return '未知';
		}
	} else {
		if (sexstr.indexOf('男') != -1) {
			return 1;
		} else if (sexstr.indexOf('女') != -1) {
			return 2;
		} else {
			return 0;
		}
	}
}

// 获取星级
function getStar(star, show) {
	if (show) {
//		var starstr = parseInt(star / 2) + '星';
//		if (parseInt(star % 2) > 0) {
//			starstr += '半';
//		}
		var starstr = star + '星';
		return starstr;
	} else {
		var starList = star.split('星');
		var starnumstr = 0;
		var firststr = starList[0];
		switch(firststr){
			case '一': starnumstr = 1; break;
			case '二': starnumstr = 2; break;
			case '三': starnumstr = 3; break;
			case '四': starnumstr = 4; break;
			case '五': starnumstr = 5; break;
			case '六': starnumstr = 6; break;
			case '七': starnumstr = 7; break;
			case '八': starnumstr = 8; break;
			case '九': starnumstr = 9; break;
			case '十': starnumstr = 10; break;
			default: starnumstr = 1; break;
		}
//		var starnum = starnumstr * 2;		
//		if (starList.length > 1) {
//			starnum += 1;		
//		}
		return starnum;
	}
}

// 获取血型
function getBloodType(type, show) {
	if (show != null) {
		if (type == 1) {
			return 'A';
		} else if (type == 2) {
			return 'B';
		} else if (type == 3) {
			return 'AB';
		} else if (type == 4) {	
			return 'O';
		} else {
			return 0;
		}
	} else {
		var upperType = type.toUpperCase();
		if (upperType.indexOf('A') != -1) {
			return 1;
		} else if (upperType.indexOf('B') != -1) {
			return 2;
		} else if (upperType.indexOf('AB') != -1) {
			return 3;
		} else if (upperType.indexOf('O') != -1) {
			return 4;
		} else {
			return 0;
		}
	}
}

// 获取星座编码
function getConstellation(constr, show) {
	if (show != null) {
		var txt = '未知';
		switch (constr) {
			case '1': txt = '白羊座'; break;
			case '2': txt = '金牛座'; break;
			case '3': txt = '双子座'; break;
			case '4': txt = '巨蟹座'; break;
			case '5': txt = '狮子座'; break;
			case '6': txt = '处女座'; break;
			case '7': txt = '天秤座'; break;
			case '8': txt = '天蝎座'; break;
			case '9': txt = '射手座'; break;
			case '10': txt = '摩羯座'; break;
			case '11': txt = '水瓶座'; break;
			case '12': txt = '双鱼座'; break;
		}
		return txt;
	} else {
		if (constr.indexOf('白羊') != -1) {
			return 1;
		} else if (constr.indexOf('金牛') != -1) {
			return 2;
		} else if (constr.indexOf('双子') != -1) {
			return 3;
		} else if (constr.indexOf('巨蟹') != -1) {
			return 4;
		} else if (constr.indexOf('狮子') != -1) {
			return 5;
		} else if (constr.indexOf('处女') != -1) {
			return 6;
		} else if (constr.indexOf('天秤') != -1) {
			return 7;
		} else if (constr.indexOf('天蝎') != -1) {
			return 8;
		} else if (constr.indexOf('射手') != -1) {
			return 9;
		} else if (constr.indexOf('摩羯') != -1) {
			return 10;
		} else if (constr.indexOf('水瓶') != -1) {
			return 1;
		} else if (constr.indexOf('双鱼') != -1) {
			return 12;
		} else {
			return 0;
		}	
	}
}

// 初始化绑定的下拉菜单
function bindAdminDropMenu(obj, typeKey, placeHolder, bmultiple, changeFunc) {
	var voption = {
		minimumResultsForSearch: 1,
		placeholder: placeHolder,
		ajax: {
			url: 'http://kllife.com/back/index.php?s=/back/help/listadmin',
			type: 'post',
			dataType: 'json',
			quietMillis: 100,
			data: function(term, page) {
				return {findstr:term, type_key: typeKey};
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
			return '<div class="select2-user-result cx_border02">' + data.account + '</div>';	
		},	
		formatSelection: function(data) {						
			return data.account;
		},						
	}
	
	if (bmultiple != null && bmultiple != false && bmultiple != '') {
		voption['multiple'] = true;
	}
	
	var sel2 = $(obj).select2(voption);	
	
	if (changeFunc != null && typeof(changeFunc) == 'function') {
		sel2.on('change', changeFunc);	
	}
}
		
// 绑定类型数据的下拉菜单
function bindTypeDataDropMenu(obj, typeKey, placeHolder, allowAddItem, bsearch, bmultiple, changeFunc) {	
	var voption = {
		placeholder: placeHolder,
		ajax: {
			url: 'http://kllife.com/back/index.php?s=/back/help/listtypedata',
			type: 'post',
			dataType: 'json',
			quietMillis: 100,
			data: function(term, page) {
				return {op:term, type_key: typeKey};
			},
			results: function(data, page){
				if (data.result.errno == 0) {
					if (data.ds == null) {
						data.ds = new Array();	
					}
					if (allowAddItem != null && allowAddItem != 'undefined' && allowAddItem != false) {
						data.ds[$(data.ds).length] = {'id':'-1','data_type_id':'-1','type_key':'','type_desc':'添加类型','can_delete':'0'};	
					}
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
				showModalTypeDataDialog(typeKey);
				return '添加后请移除我'
			} else {											
				return data.type_desc;	
			}
		},						
	}
	if ( bsearch == null || bsearch == false ) {
		voption['minimumResultsForSearch'] = -1;
	} else {
		voption['minimumResultsForSearch'] = 1;
	}
	if (bmultiple != null && bmultiple != false) {
		voption['multiple'] = true;
		voption['closeOnSelect'] = false;
	}
	var sel2 = $(obj).select2(voption);	
	
	if (changeFunc != null && typeof(changeFunc) == 'function') {
		sel2.on('change', changeFunc);	
	}
}

/* 初始化绑定的下拉菜单
	var obj=>绑定的对象
	var ds = {
		'obj': '表名',
		'prefix': '表前缀',
		'cdsstr': '条件字符串',例如:"id|1"、"id|=|1"、"id|=|1|AND"
		'cdtype': '条件分隔类型',仅支持2,3,4,5
		'start_index': '起始索引',
		'page_count': '每页查询数量',
		'sort': '排序',例如：'id|desc|name|asc|sex|desc'
		'show_col': '显示文本(必须)'
		'select_col': '选择文本(必须)'
	}
	var placeholder=>空白提示文字
	var bsearch=>是否允许搜索
	var bmultiple=>是否允许多选
	var changeFunc=>选择改变时触发函数
*/
function bindSelect2DropMenu(obj, ds, placeHolder, bsearch, bmultiple, changeFunc) {
	if (ds == 'null' || ds == 'undefined' || ds.show_col == null || ds.show_col == 'undefined') {
		alert('初始化选择下拉列表失败');
		return false;
	}
	ds['search_col'] = ds.show_col;
	
	var voption = {
		placeholder: placeHolder,
		multiple: bmultiple == null ? false : bmultiple,
		ajax: {
			url: 'http://kllife.com/back/index.php?s=/back/help/list1',
			type: 'post',
			dataType: 'json',
			quietMillis: 100,
			data: function(term, page) {
				var cdList = {findstr: term};
				for (x in ds) {				
					cdList[x] = ds[x];
				}
				return cdList;
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
			return '<div class="select2-user-result cx_border02">' + data[ds.show_col] + '</div>';	
		},	
		formatSelection: function(data) {						
			return data[ds.show_col];
		},						
	}
	
	if (bsearch == null || bsearch == false || bsearch == '' || $.isNumeric(bsearch) == false) {
		voption['minimumResultsForSearch'] = -1;
	} else {
		voption['minimumResultsForSearch'] = bsearch;
	}
	
	if (bmultiple != null && bmultiple != false && bmultiple != '') {
		voption['multiple'] = true;
		voption['closeOnSelect'] = false;
	}
	
	var sel2 = $(obj).select2(voption);	
	
	if (changeFunc != null && typeof(changeFunc) == 'function') {
		sel2.on('change', changeFunc);	
	}
}


/* 初始化绑定的下拉菜单
	var option = {
		'obj': 绑定对象
		'placeholder': 空白提示文字
		'search': 是否支持查找索引，不启用 默认为Infinity, 大于0表示开启, 数值为多少字符开始查询
		'multiple': '是否支持多选'
		'show_col': '要显示的列，可以是返回字符串的函数'
		'select_col': '选择后要显示的列，可以是返回字符串的函数'
		'func_select_changed': 选择改变时触发函数
	}绑定的对象
	var ds = {
		'tab': '表名',
		'prefix': '表前缀',
		'cdsstr': '条件字符串',例如:"id|1"、"id|=|1"、"id|=|1|AND"
		'cdtype': '条件分隔类型',仅支持2,3,4,5
		'func_dynamic_conds': '动态获取条件',类型必须和'cdtype'指定的类型一致
		'start_index': '起始索引',
		'page_count': '每页查询数量',
		'sort': '排序',例如：'id|desc|name|asc|sex|desc'
		'search_col': '要查找的列名',只有当开启查询功能，也就是option.search大于0并且不等于Infinity的时候
	}
*/
function MySelect2(voption, vds) {
	this.option = voption;
	this.ds = vds;
	this.sel2 = null;
	if (voption != null && vds !=null) {
		this.init();
	}
}

MySelect2.prototype.init = function(){
	var thisObj = this;	
	var vurl = 'http://kllife.com/back/index.php?s=/back/help/list1';
	if (thisObj.option.url != null && thisObj.option.url != '') {
		vurl = thisObj.option.url;	
	}
	var voption = {
		placeholder: thisObj.option.placeholder != null ? thisObj.option.placeholder : '请选择内容',
		ajax: {
			url: vurl,
			type: 'post',
			dataType: 'json',
			quietMillis: 100,
			data: function(term, page) {
				var cdList = {findstr: term, p: page};
				for (x in thisObj.ds) {				
					cdList[x] = thisObj.ds[x];
				}
				if (thisObj.ds.func_dynamic_conds != null && typeof(thisObj.ds.func_dynamic_conds) == 'function') {
					var attach_conds = thisObj.ds.func_dynamic_conds();
					if (attach_conds != '' && attach_conds != null) {
						if (cdList.cdsstr != null && cdList.cdsstr != '' && cdList.cdsstr.substr(-1,1) != '|') {
							cdList.cdsstr += '|';
						} else {
							cdList['cdsstr'] = '';
						}
						cdList.cdsstr += attach_conds;
					}
				}
				return cdList;
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
			var txt = '';
			if (typeof(thisObj.option.show_col) == 'function') {
				txt = thisObj.option.show_col(data);	
			} else if (typeof(thisObj.option.show_col) == 'string') {
				txt = data[thisObj.option.show_col];
			}
			return '<div class="select2-user-result cx_border02">'+txt+'</div>';
		},	
		formatSelection: function(data) {
			var txt = '';
			if (typeof(thisObj.option.select_col) == 'function') {
				txt = thisObj.option.select_col(data);	
			} else if (typeof(thisObj.option.select_col) == 'string') {
				txt = data[thisObj.option.select_col];
			}
			return txt;
		},						
	}
	
	if (thisObj.option.search == null || thisObj.option.search == false || thisObj.option.search == '' || $.isNumeric(thisObj.option.search) == false) {
		voption['minimumResultsForSearch'] = -1;
	} else {
		voption['minimumResultsForSearch'] = thisObj.option.search;
	}
	
	if (thisObj.option.multiple != null && thisObj.option.multiple != false && thisObj.option.multiple != '') {
		voption['multiple'] = true;
		voption['closeOnSelect'] = false;
	}
	thisObj.sel2 = $(thisObj.option.obj).select2(voption);
	if (thisObj.option.func_select_changed) {
		thisObj.sel2.bind('change', {obj: thisObj}, thisObj.option.func_select_changed);
	}
}

// 获取下拉多选列表(Select2)的值
function getSelect2Value(idstr, fields) {
	var vals = $(idstr).select2('data');
	if (vals == null) {
		return '';
	}
	
	var cols = new Array('id', 'type_key', 'type_desc');
	if (typeof(fields) != 'undefined' && fields != null && $.isArray(fields)) {
		cols = fields;
	}
	var jsonstr = '';
	if ($.isArray(vals)) {
		jsonstr += '[';
		for (var i = 0; i < $(vals).length; i ++) {
			if (i != 0) {
				jsonstr += ',';
			}					
			jsonstr += '{';
			for (var j=0; j < $(cols).length; j++) {
				if (j != 0) {
					jsonstr += ',';
				}
				jsonstr += '"'+cols[j]+'\":';
				jsonstr += '"'+vals[i][cols[j]]+'"';
			}
			jsonstr += '}';
		}
		jsonstr += ']';	
	} else {	
		jsonstr += '{';
		for (var j=0; j < $(cols).length; j++) {
			if (j != 0) {
				jsonstr += ',';
			}
			jsonstr += '"'+cols[j]+'":';
			jsonstr += '"'+vals[cols[j]]+'"';
		}
		jsonstr += '}';
	}
	return jsonstr;
}

// 设置下拉多选列表(Select2)的值
function setSelect2Value(idstr, valstr) {
	if (valstr == null || valstr == '' || valstr == '[]' || typeof(valstr) == 'undefined') {
//		$(idstr).select2('data', []);
		$(idstr).select2('val', '');
		return false;
	}
	if (valstr.indexOf('添加类型') != -1) {	
		return true;
	}
	var vals = JSON.parse(valstr);
	$(idstr).select2('data', vals).trigger('change');
	return true;
}

// 转换UnixTime为字符串日期，如："年-月-日 时:分:秒
function UnixtimeToDatetime(unixTime, noShowTime) {
	unixTime = parseInt(unixTime);
	if (typeof(unixTime) == 'number' && isNaN(unixTime) == false) {
		var unixTime = unixTime*1000;
		if (unixTime == 0) {
			unixTime = new Date().getTime();
		}
        var dateObj = new Date(unixTime);
        var dt = [
	        String(dateObj.getUTCFullYear()),
        	String(dateObj.getUTCMonth() + 1),
	        String(dateObj.getUTCDate()),
	        String(dateObj.getUTCHours()),
	        String(dateObj.getUTCMinutes()),
	        String(dateObj.getUTCSeconds()),
		];
		
		for (var i=0; i < 6; i ++) {
			if (dt[i].length < 2) {
				dt[i] = '0'+dt[i];
			}
		}
		
        var dateTime = dt[0] + '-' + dt[1] + '-' + dt[2];
        if (noShowTime == null || noShowTime == false) {
			dateTime += ' ' + dt[3] + ':' + dt[4] + ':' + dt[5];
		}
       	return dateTime;
	} else {
		return '';
	}
}

// 转换字符串为UnixTime时间，字符串格式: '2017-8-7 13:00:00'
function DatetimeToUnixtime(dateTime, notUseNowTime) {	
    var now = new Date(new Date().getTime());
    var nowList = [
    	now.getUTCFullYear(),
    	now.getUTCMonth()+1,
    	now.getUTCDate(),
    	now.getUTCHours(),
    	now.getUTCMinutes(),
    	now.getUTCSeconds(),   	
    ];
    
	var dtList = [];
	var datetimeList = dateTime.split(' ');
	console.log(JSON.stringify(datetimeList));
	if (datetimeList.length == 2) {
		var dateList = datetimeList[0].split('-');
		var timeList = datetimeList[1].split(':');
		dtList = dateList.concat(timeList);
	} else if (datetimeList.length == 1) {
		dateList = datetimeList[0].split('-');
		timeList = [0,0,0];
		dtList = dateList.concat(timeList);
	} else {
		if (notUseNowTime == null || notUseNowTime == false) {
			dtList = nowList;
		} else {
			return 0;
		}
	}
	// 检测位数是否足够
	if (dtList.length != 6) {
		if (notUseNowTime == null || notUseNowTime == false) {
			dtList = nowList;
		} else {
			return 0;	
		}
	}
	
	// 检测是否存在非数字字符
	for (var i = 0; i < 6; i ++) {
		dtList[i] = parseInt(dtList[i]);
		if (isNaN(dtList[i])) {
			if (notUseNowTime == null || notUseNowTime == false) {
				dtList[i] = nowList[i];
			} else {
				return 0;
			}
		}
	}
	
	// 月份减1
	dtList[1] -= 1;
	
    var UnixTime = new Date(Date.UTC(dtList[0],dtList[1],dtList[2],dtList[3],dtList[4],dtList[5]));
    return UnixTime/1000;
}

// 检测手机号码
function checkMobile(mobile) {
	var regBox = {
        regEmail : /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/,//邮箱
        regName : /^[a-z0-9_-]{3,16}$/,//用户名
        regMobile : /^0?1[3|4|5|7|8][0-9]\d{8}$/,//手机
        regTel : /^0[\d]{2,3}[\d]{7,8}$/
    }    
    return regBox.regMobile.test(mobile);
}

// 检测电话号码
function checkTel(tel) {
	var regBox = {
        regEmail : /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/,//邮箱
        regName : /^[a-z0-9_-]{3,16}$/,//用户名
        regMobile : /^0?1[3|4|5|7|8][0-9]\d{8}$/,//手机
        regTel : /^[0[\d]{2,3}|[\d]{4}][\d]{7,8}$/
    } 
    return regBox.regTel.test(tel);
}

// 检测Email
function checkEmail(email) {
	var regBox = {
        regEmail : /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/,//邮箱
        regName : /^[a-z0-9_-]{3,16}$/,//用户名
        regMobile : /^0?1[3|4|5|7|8][0-9]\d{8}$/,//手机
        regTel : /^0[\d]{2,3}[\d]{7,8}$/
    } 
    return regBox.regEmail.test(email);
}

// 检测身份证号
/*
根据〖中华人民共和国国家标准 GB 11643-1999〗中有关公民身份号码的规定，公民身份号码是特征组合码，由十七位数字本体码和一位数字校验码组成。排列顺序从左至右依次为：六位数字地址码，八位数字出生日期码，三位数字顺序码和一位数字校验码。
    地址码表示编码对象常住户口所在县(市、旗、区)的行政区划代码。
    出生日期码表示编码对象出生的年、月、日，其中年份用四位数字表示，年、月、日之间不用分隔符。
    顺序码表示同一地址码所标识的区域范围内，对同年、月、日出生的人员编定的顺序号。顺序码的奇数分给男性，偶数分给女性。
    校验码是根据前面十七位数字码，按照ISO 7064:1983.MOD 11-2校验码计算出来的检验码。

出生日期计算方法。
    15位的身份证编码首先把出生年扩展为4位，简单的就是增加一个19或18,这样就包含了所有1800-1999年出生的人;
    2000年后出生的肯定都是18位的了没有这个烦恼，至于1800年前出生的,那啥那时应该还没身份证号这个东东，⊙﹏⊙b汗...
下面是正则表达式:
 出生日期1800-2099  (18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])
 身份证正则表达式 /^\d{6}(18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i            
 15位校验规则 6位地址编码+6位出生日期+3位顺序号
 18位校验规则 6位地址编码+8位出生日期+3位顺序号+1位校验位
 
 校验位规则     公式:∑(ai×Wi)(mod 11)……………………………………(1)
                公式(1)中： 
                i----表示号码字符从由至左包括校验码在内的位置序号； 
                ai----表示第i位置上的号码字符值； 
                Wi----示第i位置上的加权因子，其数值依据公式Wi=2^(n-1）(mod 11)计算得出。
                i 18 17 16 15 14 13 12 11 10 9 8 7 6 5 4 3 2 1
                Wi 7 9 10 5 8 4 2 1 6 3 7 9 10 5 8 4 2 1

*/
//身份证号合法性验证 
//支持15位和18位身份证号
//支持地址编码、出生日期、校验位验证
function checkIDCard(code) { 
	var city={11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",23:"黑龙江 ",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",42:"湖北 ",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",52:"贵州",53:"云南",54:"西藏 ",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外 "};
	var tip = "";
	var pass= true;
    
    code = strtoupper(code);
    	   strtoupper

	if(!code || !/^\d{6}(18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i.test(code)){
		tip = "身份证号格式错误";
		pass = false;
	} else if(!city[code.substr(0,2)]){
		tip = "地址编码错误";
		pass = false;
	} else{
		//18位身份证需要验证最后一位校验位
		if(code.length == 18) {
			code = code.split('');
			//∑(ai×Wi)(mod 11)
			//加权因子610428198710203610
			var factor = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2 ];
			//校验位
			var parity = [ 1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2 ];
			var sum = 0;
			var ai = 0;
			var wi = 0;
			for (var i = 0; i < 17; i++)
			{
			    ai = code[i];
			    wi = factor[i];
			    sum += ai * wi;
			}
			var last = parity[sum % 11];
			if(parity[sum % 11] != code[17]){
			    tip = "校验位错误";
			    pass =false;
			}
		}
	}
	if(!pass) alert(tip);
	return pass;
}

var vcity={ 11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",  
            21:"辽宁",22:"吉林",23:"黑龙江",31:"上海",32:"江苏",  
            33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",  
            42:"湖北",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",  
            51:"四川",52:"贵州",53:"云南",54:"西藏",61:"陕西",62:"甘肃",  
            63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外"  
           };  
  
function checkCard(card) {
    //是否为空  
    if(card === '')  
    {  
        alert('请输入身份证号，身份证号不能为空');  
        return false;  
    }  
    
    card = card.toUpperCase();
    
    //校验长度，类型  
    if(isCardNo(card) === false)  
    {  
        alert('您输入的身份证号码长度不正确，请重新输入');
        return false;  
    }  
    //检查省份  
    if(checkProvince(card) === false)  
    {  
        alert('您输入的身份证号码不正确,请重新输入');
        return false;  
    }  
    //校验生日  
    if(checkBirthday(card) === false)  
    {  
        alert('您输入的身份证号码生日不正确,请重新输入');
        return false;  
    }  
    return true;
    
    //检验位的检测  
    if(checkParity(card) === false)  
    {  
        alert('您的身份证校验位不正确,请重新输入'); 
        return false;  
    }    
    return true;  
}
  
  
//检查号码是否符合规范，包括长度，类型  
function isCardNo(card) {  
    //身份证号码为15位或者18位，15位时全为数字，18位前17位为数字，最后一位是校验位，可能为数字或字符X  
    var reg = /(^\d{15}$)|(^\d{17}(\d|X)$)|(^\d{18}$)/;  
    if(reg.test(card) === false) {  
        return false;  
    }    
    return true;  
}
  
//取身份证前两位,校验省份  
function checkProvince(card) {
    var province = card.substr(0,2);  
    if(vcity[province] == undefined)  
    {  
        return false;  
    }  
    return true;  
}
  
//检查生日是否正确  
function checkBirthday(card) {  
    var len = card.length;  
    //身份证15位时，次序为省（3位）市（3位）年（2位）月（2位）日（2位）校验位（3位），皆为数字  
    if(len == '15')  
    {  
        var re_fifteen = /^(\d{6})(\d{2})(\d{2})(\d{2})(\d{3})$/;   
        var arr_data = card.match(re_fifteen);  
        var year = arr_data[2];  
        var month = arr_data[3];  
        var day = arr_data[4];  
        var birthday = new Date('19'+year+'/'+month+'/'+day);  
        return verifyBirthday('19'+year,month,day,birthday);  
    }  
    //身份证18位时，次序为省（3位）市（3位）年（4位）月（2位）日（2位）校验位（4位），校验位末尾可能为X  
    if(len == '18')  
    {  
        var re_eighteen = /^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$/;  
        var arr_data = card.match(re_eighteen);  
        var year = arr_data[2];  
        var month = arr_data[3];  
        var day = arr_data[4];  
        var birthday = new Date(year+'/'+month+'/'+day);  
        return verifyBirthday(year,month,day,birthday);  
    }  
    return false;  
}
  
//校验日期  
function verifyBirthday(year,month,day,birthday) {
    var now = new Date();  
    var now_year = now.getFullYear();  
    //年月日是否合理  
    if(birthday.getFullYear() == year && (birthday.getMonth() + 1) == month && birthday.getDate() == day)  
    {  
        //判断年份的范围（3岁到100岁之间)  
        var time = now_year - year;  
        if(time >= 3 && time <= 100)  
        {  
            return true;  
        }  
        return false;  
    }  
    return false;  
}
  
//校验位的检测  
function checkParity(card) { 
    //15位转18位  
    card = changeFivteenToEighteen(card);  
    var len = card.length;  
    if(len == '18')  
    {  
        var arrInt = new Array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);   
        var arrCh = new Array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');   
        var cardTemp = 0, i, valnum;   
        for(i = 0; i < 17; i ++)   
        {   
            cardTemp += card.substr(i, 1) * arrInt[i];   
        }   
        valnum = arrCh[cardTemp % 11];   
        if (valnum == card.substr(17, 1))   
        {  
            return true;  
        }  
        return false;  
    }  
    return false;  
}
  
//15位转18位身份证号  
function changeFivteenToEighteen(card) { 
    if(card.length == '15')  
    {  
        var arrInt = new Array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);   
        var arrCh = new Array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');   
        var cardTemp = 0, i;     
        card = card.substr(0, 6) + '19' + card.substr(6, card.length - 6);  
        for(i = 0; i < 17; i ++)   
        {   
            cardTemp += card.substr(i, 1) * arrInt[i];   
        }   
        card += arrCh[cardTemp % 11];   
        return card;  
    }  
    return card;  
}