//精彩专题
	$('.special-exhibition').unslider({ 
		dots: true
	});
	$('.special-exhibition-product').fadeInAndOut('special-img', 'div');
//专业保证
	var unslider01 = $('.professional-guarantee-slide').unslider({
		dots: true
	}),
	data04 = unslider01.data('unslider');
	$('.unslider-arrow01').click(function() {
        var fn = this.className.split(' ')[1];
        data04[fn]();
    });
//搜索栏
	$('.search-header input').focus(
		function () {
			$(this).stop().animate({width: '250px'}, 1000);
			$(this).next().stop().animate({left: '286px'}, 1000);
		}
	);
	$('.search-header input').blur(
		function () {
			$(this).stop().animate({width: '135px'}, 1000);
			$(this).next().stop().animate({left: '171px'}, 1000);
		}
	);
//显示与隐藏
	$('.nav-list-top').showAndHide();
//headroom
	(function() {
	    var header = new Headroom(document.querySelector("header"), {
	        tolerance: 5,
	        offset : 100,
	        classes: {
				initial: "headroom",
				pinned: "headroom--pinned",
				unpinned: "headroom--unpinned"
	        }
	    });
	    header.init();
	}());
//右侧固定侧边栏
	$('.aside_hot').asideShow();
	$('.aside_mine').asideShow();
	$('.aside_order').asideShow();		
	$('.aside_tel').asideShow();
	$('.aside_qq').asideShow();
	$('.aside_weixin').hover( 
		function (){
			$(this).find('div').css('display', 'block');
			$(this).find('div').stop().animate({left: '-130px', opacity: '1'},500);
		},
		function (){
			$(this).find('div').stop().animate({left: '-168px', opacity: '0'},500);
			$(this).find('div').css('display', 'none');
		}
	);
//回到顶部隐藏于显示
	$(window).scroll( function (){
		if ($(this).scrollTop() > 10) {
			$('.aside_top').show();
		}else{
			$('.aside_top').hide();
		};
	});
//您的选择
	function less () {
		if ( $('.select-mine .select-body a').length < 2 ){
			$('.select-mine').hide();
		}
	};

	function YourChoice ( c , d) {
		$( "." + c ).find('a').click( function () {
			$('.select-mine').show();
			var myHtml = '';
			myHtml += '<a class="'+ c +'0" href="javascript:;">'
					+d
					+$(this).text()
					+' <span></span>'
					+'</a>';
			$('.select-mine .select-body' + ' .' + c + '0' ).remove();
			$('.select-mine .select-body').prepend(myHtml);
		} );
	};

	//景点的选择
	$('.select-jd a').click( function () {
		if ($('.select-checkbox').css('display') != 'none') {
			$('.select-mine').show();
			var myHtml = '';
			myHtml += '<a class="select-jd0" href="javascript:;">'
					+'包含景点-'
					+$(this).text()
					+' <span></span>'
					+'</a>';
			$('.select-mine .select-body .select-jd0').remove();
			$('.select-mine .select-body').prepend(myHtml);
		}else {
			return false;
		}
	} );
	//去除
	$(document).on('click', '.select-mine .select-body a span', function () {
		$(this).parent().remove();
		less();
	});
	//清楚所有
	$('.select-clear').click( function () {
		$(this).siblings('a').remove();
		$('.select-mine').hide();
	} );
	//非多选的选择
	YourChoice('select-cplx', '产品类型-');
	YourChoice('select-cfd', '出发地-');
	YourChoice('select-mdd', '目的地-');
	YourChoice('select-lxsj', '旅行时间-');
	YourChoice('select-xcts', '行程天数-');
	//多选
	$('.select-checkbox').click( function () {
		$(this).parents('li').find('.multiselect a .multiselect-span').removeClass('checked');
		$(this).parents('li').find('.multiselect a .multiselect-span').toggleClass('multiselect-hide');
		$(this).hide();
		$(this).next().html('收起<i class="close-more"></i>');
		$(this).parents('li').find('.select-list').css({ "overflow": "auto", "height": "74px" });
		$(this).parents('li').find('.btns').removeClass('btn-hide');
	} );
	//勾选
	$('.multiselect a').click( function () {
		$(this).children('.multiselect-span').toggleClass('checked');
	} );
	//取消
	$('.btn-cancel').click( function () {
		$(this).parents('li').find('.select-checkbox').show();
		$(this).parent('.btns').addClass('btn-hide');
		$(this).parents('li').find('.multiselect a .multiselect-span').addClass('multiselect-hide');
	} );
	//确定
	$('.btn-submit').click( function () {
		if ( !$(this).parents('li').find('.multiselect a .multiselect-span').hasClass('checked') ){
			alert('请至少选择其中一项');
			return false;
		}else {
			$('.select-mine .select-body .select-jd0').remove();
			$('.select-mine').show();
			$('.checked').each( function () {
				var myHtml = '';
				myHtml += '<a class="select-jd0" href="javascript:;">'
						+'包含景点-'
						+$(this).next().text()
						+' <span></span>'
						+'</a>';
				$('.select-mine .select-body').prepend(myHtml); 
			} );
			$(this).parents('li').find('.multiselect a .multiselect-span').removeClass('checked');
			$(this).parents('li').find('.multiselect a .multiselect-span').addClass('multiselect-hide');
			$(this).parents('li').find('.select-checkbox').show();
			$(this).parent('.btns').addClass('btn-hide');

		}
	} );
	//更多
	$('.select-more01').click( function () {	
		if( $(this).children('i').hasClass('show-more') ) {
			$(this).children('i').remove();
			$(this).parents('li').find('.select-list').css({ "overflow": "auto", "height": "74px" });
			$(this).html('收起<i class="close-more"></i>');
		}else {
			$(this).parents('li').find('.select-list').css({ "overflow": "hidden", "height": "37px" });
			$(this).html('更多<i class="show-more"></i>');
			$(this).parents('li').find('.multiselect a .multiselect-span').removeClass('checked');
			$(this).parents('li').find('.multiselect a .multiselect-span').addClass('multiselect-hide');
			$(this).parents('li').find('.select-checkbox').show();
			$(this).parents('li').find('.btns').addClass('btn-hide');
		}
	} );

	//显示更多
		function ShowMore ( b ) {
			$( b ).click( function () {	
				if( $(this).children('i').hasClass('show-more') ) {
					$(this).children('i').remove();
					$(this).parents('li').find('.select-list').css({ "overflow": "auto", "height": "74px" });
					$(this).html('收起<i class="close-more"></i>');
				}else {
					$(this).parents('li').find('.select-list').css({ "overflow": "hidden", "height": "37px" });
					$(this).html('更多<i class="show-more"></i>');
				}
			} );
		};
		ShowMore('.select-more02');
	//查看更多选项
		$('.select-up-down').click( function () {
			if( $('.select-hide').css('display') == 'none' ) {
				$(this).children('span').remove();
				$(this).html('<span>收起更多选项<i class="close-more"></i></span>');
			}else {
				$(this).html('<span>查看更多选项<i class="show-more"></i></span>');
			}
			$('.select-hide').slideToggle();
		} );
//列表菜单
	//菜单排序
	$('.list-menu-sort-comprehensive').click ( function () {
		$(this).addClass('sort-checked');
		$(this).siblings().removeClass('sort-checked');
	} );
	$('.list-menu-sort-sales').click( function () {
		$(this).children('i').toggleClass('sort-sales');
		$(this).addClass('sort-checked');
		$(this).siblings().removeClass('sort-checked');
	} );
	$('.list-menu-sort-price').click( function () {
		$(this).children('i').toggleClass('sort-price');
		$(this).addClass('sort-checked');
		$(this).siblings().removeClass('sort-checked');
	} );
	$('.list-menu-sort-x').click( function () {
		$(this).children('i').toggleClass('sort-x');
		$(this).siblings().children('i').removeClass('sort-y');
		$('.single-row').hide();
		$('.double-row').show();
	} );
	$('.list-menu-sort-y').click( function () {
		$(this).children('i').toggleClass('sort-y');
		$(this).siblings().children('i').removeClass('sort-x');
		$('.single-row').show();
		$('.double-row').hide();
	} );


	//双排菜单效果
	function double( h, i ) {
		$(h).hover( 
			function () {		
				$(this).children(i).stop().animate({top: '-90px'}, 500);
				$(this).children('.double-row-describe').find('p').stop().animate({opacity: '1'}, 500);
				$(this).children('.double-row-describe').stop().animate({top: '258px'}, 1000);
			},
			function () {
				$(this).children(i).stop().animate({top: '0'}, 500);
				$(this).children('.double-row-describe').find('p').stop().animate({opacity: '0'}, 500);
				$(this).children('.double-row-describe').stop().animate({top: '348px'}, 1000);
				
			}
		);
	}
	double('.double-row-left', '.double-row-left-top');
	double('.double-row-right', '.double-row-right-top');
	
	//分页
    $(".list-page").createPage({
        pageCount:10, //总页数
        current:1,
        backFn:function(p){
        	//当前页数
            console.log(p);
        }
    });
