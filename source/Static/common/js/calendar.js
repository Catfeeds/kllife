(function($){
	var $window = $(window);
	function UTCDate(){
		return new Date(Date.UTC.apply(Date, arguments));
	}
	
	function UTCToday(offset_y, offset_m, offset_d){
		var today = new Date();
		var y = today.getUTCFullYear();
		var m = today.getUTCMonth();
		var d = today.getUTCDate();
		if (offset_y != null && offset_y != 0) {
			y += offset_y;
		}
		if (offset_m != null && offset_m != 0) {
			m += offset_m;
		}
		if (offset_d != null && offset_d != 0) {
			d += offset_d;
		}
		return UTCDate(y, m, d);
	}
	
	function ToFullShowDate(y, m, d) {
		return y + '-' + ToFullMonthDay(m) + '-' + ToFullMonthDay(d);
	}
	
	function GetFullShowDate(d) {
		return ToFullShowDate(d.y, d.m+1, d.d);
	}
	
	function FormatDate(dObj) {
		var d = {
			y:dObj.getUTCFullYear(),
			m:dObj.getUTCMonth(),
			d:dObj.getUTCDate(),
			h:dObj.getUTCHours(),
			i:dObj.getUTCMinutes(),
			s:dObj.getUTCSeconds(),
			ms:dObj.getUTCMilliseconds(),
			w:dObj.getUTCDay(),
			utc:dObj.getTime(),
		}
		d['str_ym'] = d.y + '-' + ToFullMonthDay(d.m+1);
		d['str_ymd'] = d.y + '-' + ToFullMonthDay(d.m+1) + '-' + ToFullMonthDay(d.d);
		return d;
	}
	
	function ToFullMonthDay(m) {
		return m.toString().length > 1 ? m : '0'+m;
	}
	
	function ToShowYear(n) {
		var ds = {'0':'零','1':'一','2':'二','3':'三','4':'四','5':'五','6':'六','7':'七','8':'八','9':'九'};
		var nlist = n.toString().split('');
		var rs = '';
		for (var i=0; i<nlist.length; i++) {
			rs += ds[nlist[i]];
		}
		return rs;
	}
	
	function ToShowMonth(m) {
		var ms = ['一','二','三','四','五','六','七','八','九','十','十一','十二'];
		return ms[m];
	}
	
	function ToShowDay(n) {
		var ds = {'0':'零','1':'一','2':'二','3':'三','4':'四','5':'五','6':'六','7':'七','8':'八','9':'九'}
		var d = ['','十','百','千','万','十万'];
		var nlist = n.toString().split('');
		var rs = '', len = nlist.length, dl = len;
		for (var i=0,dl=len-1; i<len; i++,dl--) {
			rs += ds[nlist[i]];
			rs += d[dl];
		}
		return rs;		
	}
		
	var BCGlobal = {
		titleTemplate:  '<div  class="calendar-nav">'+
						'	<a href="javascript:;" class="fa fa-2x fa-angle-left arrow month-prev"><i class="iconfont">&#xe649;</i></a>'+
						'	<div class="calendar-month"></div>'+
						'	<a href="javascript:;" class="fa fa-2x fa-angle-right arrow month-next"><i class="iconfont">&#xe600;</i></a>'+
						'</div>',
		weekTemplate: 	'<ul class="calendar-week">'+
						'	<li class="week" data-week="1">一</li>'+
						'	<li class="week" data-week="2">二</li>'+
						'	<li class="week" data-week="3">三</li>'+
						'	<li class="week" data-week="4">四</li>'+
						'	<li class="week" data-week="5">五</li>'+
						'	<li class="week" data-week="6">六</li>'+
						'	<li class="week" data-week="0">日</li>'+
						'</ul>',
		contTemplate: 	'<div class="calendar_content"></div>',
	}
	BCGlobal.template = '<div class="calendar">'+
							BCGlobal.titleTemplate+
							BCGlobal.weekTemplate+
							BCGlobal.contTemplate+
						'</div>';
	
	var BatchCalendar = function (element, options) {
		var that = this;
		this._process_options(options);
		$(element).append(BCGlobal.template)
		this.element = $(element).find('.calendar');
		this._buildEvents(this.element);
		this._fillMonths();
	}	
	
	//	months: 指定月份,例如 [{year:2017,month:[3,5,12]}]
	//  show_month_count: 最大显示几个月份，默认
	BatchCalendar.prototype = {
		constructor: BatchCalendar,
		_process_options: function(opts) {
			this._o = $.extend({}, this._o, opts);
			// Processed options
			var o = this.o = $.extend({}, this._o);
		},
		_events: [],
		// 绑定指定的事件
		_applyEvents: function(evs) {
			for (var i=0, el, ev; i<evs.length; i++) {
				el = evs[i][0];
				ev = evs[i][1];
				el.on(ev);
			}
		},
		// 解除指定的绑定事件
		_unapplyEvents: function(evs) {
			for (var i=0, el, ev; i<evs.length; i++) {
				el = evs[i][0];
				ev = evs[i][1];
				el.off(ev);
			}
		},
		// 绑定日历触发事件
		_attachEvents: function() {
			this.detachEvents();
			this._applyEvents(this._events);
		},
		// 卸载日期的触发时间
		_detachEvents: function() {
			this._unapplyEvents(this._events);
		},
		// 绑定一个月内的触发事件
		_buildEvents: function(obj) {
			var newEvents = [];
			var prevObj = $(obj).find('.calendar-nav').find('.month-prev');
			if ($(prevObj).length > 0) {
				newEvents.push([prevObj, {'click': $.proxy(this._clickPrevMonth, this)}]);
			}
			var nextObj = $(obj).find('.calendar-nav').find('.month-next');
			if ($(nextObj).length > 0) {
				newEvents.push([nextObj, {'click': $.proxy(this._clickNextMonth, this)}]);
			}
			var monthObj = $(obj).find('.calendar-nav').find('.month');
			if ($(monthObj).length > 0) {
				newEvents.push([monthObj, {'click': $.proxy(this._clickMonth, this)}]);
			}
			var weekObj = $(obj).find('.calendar-week').find('.week');
			if ($(weekObj).length > 0) {
				newEvents.push([weekObj, {'click': $.proxy(this._clickWeek, this)}]);
			}
			var dayObj = $(obj).find('.day');
			if ($(dayObj).length > 0) {
				newEvents.push([dayObj, {
					'click': $.proxy(this._clickDay, this),
					'mouseenter': $.proxy(this._mouseEnterDay, this),
					'mouseleave': $.proxy(this._mouseLeaveDay, this)
				}]);
			}
			if (newEvents.length > 0) {
				this._applyEvents(newEvents);
				this._events = this._events.concat(newEvents);	
			}
		},
		// 添加一个事件到事件列表
		_appendEvent: function(obj) {
			var newEvents = [];
			if ($(obj).hasClass('month-prev')) {	
				newEvents.push([obj, {'click': $.proxy(this._clickPrevMonth, this)}]);			
			} else if ($(obj).hasClass('month-next')) {
				newEvents.push([obj, {'click': $.proxy(this._clickNextMonth, this)}]);				
			} else if ($(obj).hasClass('month')) {
				newEvents.push([obj, {'click': $.proxy(this._clickMonth, this)}]);
			} else if ($(obj).hasClass('week')) {
				newEvents.push([obj, {'click': $.proxy(this._clickWeek, this)}]);
			} else if ($(obj).hasClass('day')) {
				newEvents.push([obj, {
					'click': $.proxy(this._clickDay, this),
					'mouseenter': $.proxy(this._mouseEnterDay, this),
					'mouseleave': $.proxy(this._mouseLeaveDay, this)
				}]);
			}
			
			if (newEvents.length > 0) {
				this._applyEvents(newEvents);
				this._events = this._events.concat(newEvents);	
			}
		},	
		// 填充一个月的DOM元素
		_fillDays: function(year, month) {	
			var fd = FormatDate(UTCDate(year,parseInt(month)-1,1));	
			var monthstr = year+'-'+ToFullMonthDay(month);
			// 判断是否已经添加
			if ($(this.element).find('.month-day[data-key="'+fd.str_ym+'"]').length > 0) {
				return false;
			}
			
			// 添加月份标题，并保证插入顺序
			var inserted = false;
			var monthObj = $('<span class="month"></span>');				
			$(monthObj).attr('data-id', fd.utc);
			$(monthObj).attr('data-key', fd.str_ym);
			$(monthObj).attr('data-year', year);
			$(monthObj).attr('data-month', month);
			$(monthObj).html(year+'年'+ToFullMonthDay(month)+'月');
			$(monthObj).hide();
			$(this.element).find('.calendar-month').find('.month').each(function(i, ev){
				var utcTime = parseInt($(this).attr('data-id'));
				if (inserted == false && utcTime > fd.utc) {
					inserted = true;l
					$(this).before(monthObj);
				}
			});
			if (inserted == false) {
				$(this.element).find('.calendar-month').append(monthObj);	
			}
			// 添加月份标题事件
			this._appendEvent(monthObj);
			
			
			// 月份的详细日期			
			var vhtml = '<div class="month-day"><table><tbody></tbody></table></div>';				
			var rootObj = $(vhtml);	
			rootObj.attr('data-id', fd.utc);
			rootObj.attr('data-key', monthstr);	
			rootObj.hide();
			
			// 今天
			var today = FormatDate(UTCToday());
			
			// 填充日期			
			var week = (fd.w == 0 ? 7 : fd.w)-1;
			var sd = FormatDate(UTCDate(fd.y,fd.m,fd.d-week));
			for (var r=0; r<6; r++) {
				var trObj = $('<tr></tr>');
				for (var c=0; c<7; c++) {
					var offset = r*7+c;
					var tdate = FormatDate(UTCDate(sd.y, sd.m, sd.d+offset));
					var tdObj = $('<td class="day"></td>');
					$(trObj).append(tdObj);
					if ((tdate.m+1) != month) {
						$(tdObj).addClass('different-month-day');
					}
					if (today.y == tdate.y && today.m == tdate.m && today.d == tdate.d) {
						$(tdObj).addClass('current-day');
					}
					if (c == 6) {
						$(tdObj).addClass('last-day');
					}
					$(tdObj).attr('data-date', GetFullShowDate(tdate));
					$(tdObj).attr('data-year', tdate.y);
					$(tdObj).attr('data-month', tdate.m+1);
					$(tdObj).attr('data-day', tdate.d);
					$(tdObj).append('<span>'+tdate.d+'</span>')
				}
				$(rootObj).find('tbody').append(trObj);
			}		
			// 保证日历插入顺序
			inserted = false;
			$(this.element).find('.month-day').each(function(i,ev){
				var utcTime = parseInt($(this).attr('data-id'));
				if (inserted == false && utcTime > fd.utc) {
					inserted = true;
					$(this).before(rootObj);
				}
			});
			if (inserted == false) {
				this.element.find('.calendar_content').append(rootObj);	
			}
			// 绑定触发时间
			this._buildEvents(rootObj);
		},
		// 填充所有月份的DOM元素
		_fillMonths: function() {
			var tdate = FormatDate(UTCToday());
			// 未指定月份
			if (this.o.months == null) {
				// 获取当前月前3后8个月
				for (var i=0; i<12; i++) {
					var d = FormatDate(UTCDate(tdate.y,tdate.m+i-3,1));
					this._fillDays(d.y, d.m+1);
				}
			// 指定月份
			} else {
				for (var i=0; i<this.o.months.length; i++) {
					var m = this.o.months[i];
					this._fillDays(m.year, m.month);
				}
			}
			// 绑定日期数据
			this._bindData();
			// 设置显示的月份
			var firstDate = FormatDate(UTCDate(tdate.y,tdate.m,1));
			var show_month = 0, shown = false, that = this;
			$(this.element).find('.month').each(function(i,ev){
				var unixTime = $(this).attr('data-id');
//				console.log($(this).attr('data-key')+'->'+unixTime+','+show_month+':'+that.o.show_month_count);				
				if (show_month < that.o.show_month_count && unixTime >= firstDate.utc) {
					$(this).show();
					if (shown == false) {
						var y = $(this).attr('data-year');
						var m = $(this).attr('data-month');
						that.setMonth(y,m);
						shown = true;
					}
					show_month++;
				}
			});
			// 如果显示的月份不足，反向添加月份
			if (show_month < that.o.show_month_count) {
				var subCount = that.o.show_month_count - show_month;
				var fsm = $(that.element).find('.month:visible:first');
				if ($(fsm).length == 0) {
					fsm = $(that.element).find('.month:last');
					var thisMonth = fsm;
				} else {
					var thisMonth = $(fsm).prev();
				}
				for (var i=0; i<subCount; i++) {
					$(thisMonth).show();
					if (shown == false) {
						var y = $(thisMonth).attr('data-year');
						var m = $(thisMonth).attr('data-month');
						that.setMonth(y,m);
						shown = true;
					}
					thisMonth = $(thisMonth).prev();
				}
			}
			// 配置翻月按钮
			that._updateChangeMonthArray();
		},
		// 刷新翻月按钮样式
		_updateChangeMonthArray: function() {
			var fsm = $(this.element).find('.month:visible:first');
			if ($(fsm).prev().length == 0) {
				$(this.element).find('.month-prev').hide();
			} else {
				$(this.element).find('.month-prev').show();
			}
			var lsm = $(this.element).find('.month:visible:last');
			if ($(lsm).next().length == 0) {
				$(this.element).find('.month-next').hide();
			} else {
				$(this.element).find('.month-next').show();
			}
		},
		// 绑定数据
		_bindData: function() {
			if (this.o.data != null) {
				var len = this.o.data.length;
				for (var i=0; i<len; i++){
					var d = this.o.data[i];
					if (d.date != null && d.date != '') {
						var dayObj = $(this.element).find('.day[data-date="'+d.date+'"]');
						var dayTextObj = $(dayObj).find('.day-text');
						if (d.text != null) {
							if ($(dayTextObj).length > 0) {
								$(dayTextObj).html(d.text);	
							} else {
								$(dayObj).append('<div class="day-text">'+d.text+'</div>');
								dayTextObj = $(dayObj).find('.day-text');
							}
						}
						if (d.tip != null) {
							var downArrayHtml = '<span class="day-text-tip-array-img"></span>';
							if ($(dayTextObj).length == 0) {
								$(dayObj).append('<div class="day-text"></div>');
								dayTextObj = $(dayObj).find('.day-text');
							}
							var dayTextTipObj = $(dayTextObj).find('.day-text-tip');
							if ($(dayTextTipObj).length > 0) {
								$(dayTextTipObj).html(d.tip+downArrayHtml);	
							} else {
								$(dayTextObj).append('<div class="day-text-tip">'+d.tip+downArrayHtml+'</div>');	
							}
						}
						if (d.data != null) {
							$(dayTextObj).data('ds', d.data);
						}
					}
				}
			}
		},
		// 加载新的月份
		_loadNewMonth: function(prev) {
			if (this.o.months == null) {
				// 当前选中的月份
				var selMonth = $(this.element).find('.select-month');
				var year = $(selMonth).attr('data-year');
				var month = $(selMonth).attr('data-month');
				if (prev == false) {
					var nextMonth = $(selMonth).next();
					if ($(nextMonth).length == 0) {
						var d = FormatDate(UTCDate(year, month, 1));
						this._fillDays(d.y, d.m+1);
					}
				} else {
					var prevMonth = $(selMonth).prev();
					if ($(prevMonth).length == 0) {
						var d = FormatDate(UTCDate(year, month-1, 1));
						this._fillDays(d.y, d.m+1);
					}
				}
			}
		},
		// 设置月份
		setMonth: function(year, month) {
//			console.log('设置月份：'+year+'-'+month);
			// 隐藏旧月份
			var selObj = $(this.element).find('.select-month');
			$(selObj).removeClass('select-month');
			// 隐藏旧月份日期
			var key = $(selObj).attr('data-key');
			$(this.element).find('.month-day[data-key="'+key+'"]').hide();
			// 显示新月份
			var newkey = year+'-'+ToFullMonthDay(month);
			var newObj = $(this.element).find('.month[data-key="'+newkey+'"]');
			$(newObj).addClass('select-month');
			// 显示新月份日期
			$(this.element).find('.month-day[data-key="'+newkey+'"]').show();
		},		
		// 点击切换上一月
		_clickPrevMonth: function(e) {
//			console.log('点击了翻月按钮，翻至上月...');
			this._loadNewMonth(true);
			var prevObj = $(this.element).find('.select-month').prev();
			if ($(prevObj).length > 0) {
				// 非显示月份，滚动到显示月份
				if ($(prevObj).is(':visible') == false) {
					$(this.element).find('.month:visible:last').hide();
					$(prevObj).show();
				}
				var year = $(prevObj).attr('data-year');
				var month = $(prevObj).attr('data-month');
				this.setMonth(year, month);
			} else {
				console.log('已经到第一个月了');
			}
			// 配置翻月按钮
			this._updateChangeMonthArray();
		},		
		// 点击切换下一月
		_clickNextMonth: function(e) {
//			console.log('点击了翻月按钮，翻至下月...');
			this._loadNewMonth(false);
			var nextObj = $(this.element).find('.select-month').next();
			if ($(nextObj).length > 0) {
				// 非显示月份，滚动到显示月份
				console.log($(nextObj).is('visible'));
				if ($(nextObj).is(':visible') == false) {
					$(this.element).find('.month:visible:first').hide();
					$(nextObj).show();
				}
				var year = $(nextObj).attr('data-year');
				var month = $(nextObj).attr('data-month');
				this.setMonth(year, month);
			} else {
				console.log('已经到第一个月了');
			}			
			// 配置翻月按钮
			this._updateChangeMonthArray();
		},
		// 鼠标点击月份
		_clickMonth: function(e) {
			var year = $(e.target).attr('data-year');
			var month = $(e.target).attr('data-month');
			this.setMonth(year, month);
		},
		// 鼠标点击周
		_clickWeek: function(e) {
//			console.log('点击了周份切换...');			
		},
		// 鼠标点击日期
		_clickDay: function(e) {
//			console.log('点击了日期...');
			$(this.element).find('.day').removeClass('select-day')
			var dayObj = $(e.target);
			if ($(dayObj).hasClass('day') == false){
				dayObj = $(dayObj).closest('.day');
			}
			$(dayObj).addClass('select-day');
			var date = $(dayObj).attr('data-date');
			if (this.o.clickDay != null && typeof this.o.clickDay == 'function') {
				this.o.clickDay(date, this);
			}
			var dataObj = $(dayObj).find('.day-text');
			if (this.o.clickEventDay != null && typeof this.o.clickEventDay == 'function' && $(dataObj).length > 0) {
				this.o.clickEventDay(date, this, $(dataObj).data('ds'));
			}
		},
		// 鼠标进入
		_mouseEnterDay: function(e) {
			var dayObj = $(e.target);
			if ($(dayObj).hasClass('day-text-tip')) {
				return false;
			}
			if ($(dayObj).hasClass('day') == false){
				dayObj = $(dayObj).closest('.day');
			}
			$(dayObj).addClass('hover-day');
			$(dayObj).find('.day-text-tip').fadeIn();	
		},
		// 鼠标移出
		_mouseLeaveDay: function(e) {
			$(this.element).find('.day').removeClass('hover-day');
			var dayObj = $(e.target);
			if ($(dayObj).hasClass('day') == false){
				dayObj = $(dayObj).closest('.day');
			}
			$(dayObj).find('.day-text-tip').fadeOut();
		},
		// 设置日期
		setMonthDate: function(year, month, day) {
			this.setMonth(year, month);
			var newkey = year+'-'+ToFullMonthDay(month)+'-'+ToFullMonthDay(day);
			$(this.element).find('.month-day:visible').find('[data-date="'+newkey+'"]').trigger('click');
		},
		// 设置属性
		setData: function(option) {
			var options = typeof option == 'object' && option;
			this._process_options(options);
			if (options['months'] != null){
				this.reset();
			}
			if (options['data'] != null) {
				this.refreshBindData();
			}
		},
		// 获取属性
		getData: function(attrName) {
			if (attrName == null && attrName == '') {
				return '';
			}
			return this.o[attrName] != null ? this.o[attrName] : '';
		},
		// 刷新绑定数据
		refreshBindData: function() {
			$(this.element).find('.day-text').remove();
			this._bindData();
		},
		// 重置表格
		reset: function(){
			$(this.element).find('.calendar-month').children().remove();
			$(this.element).find('.calendar_content').children().remove();
			$(this.element).find('.day-text').remove();
			this._fillMonths();
		}	
	}
	
	$.fn.BatchCalendar = function ( option ) {
		if ($(this).get(0).tagName == 'DIV') {
			var options = typeof option == 'object' && option;
			var xop = $.extend({}, defaults, options);
			return new BatchCalendar(this, xop);
		} else {
			return this;
		}
	};
	
	var defaults = $.fn.BatchCalendar.defaults = {
		show_month_count: 6,
		months: null,
		data: null,
	};
	
}( window.jQuery ));