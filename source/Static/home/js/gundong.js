//滚动指定位置
$(function() {
	function toTag(c, d) {
			$(c).click(
				function( event ){
					var $anchor = $(this);
                    $('html, body').stop().animate({scrollTop: $($anchor.attr('href')).offset().top - d }, 600);
					event.preventDefault();
				}
			);
		};
		//导航菜单固定
		$(window).scroll( function () {
			if ($(this).scrollTop() > 1130) {
				$('.content-list').addClass('fixed-top');
				$('.content-list-to-reserve').css('display' , 'inline-block');
			}else {
				$('.content-list').removeClass('fixed-top');
				$('.content-list-to-reserve').hide();
			};
		} );
		if ($(this).scrollTop() > 1130) {
			$('.content-list').addClass('fixed-top');
		}else {
			$('.content-list').removeClass('fixed-top');
		};

		//行程安排固定
		function travelScroll() {
			if ($('.travel-arrangements-content').length == 0 ||
				$('.travel-notes').length == 0) {
				return false;
			}
			if ($(this).scrollTop() > $('.travel-arrangements-content').offset().top && $(this).scrollTop() < ($('.travel-notes').offset().top - 500)) {
				$('.travel-arrangements-list').addClass('fixed-bottom');
			}else {
				$('.travel-arrangements-list').removeClass('fixed-bottom');
			};
		}
		$(window).scroll(travelScroll);
		travelScroll();

		$(window).scroll(function () {
			for (var i = 1; ; i++) {
				var dayId = '#day'+i;
				var dayClass = '.day'+i;
				if ($(dayId).length == 0) {
					break;
				}

				var sub = i == 1 ? 180 : 400;
				var nextSub = 400;

				var nextDay = parseInt(i)+1;
				var nextDayId = '#day'+nextDay;
				if ($(nextDayId).length == 0) {
					nextSub = 500;
					nextDayId = '.travel-notes';
				}
				if (($(this).scrollTop() > $(dayId).offset().top - sub) && ($(this).scrollTop() < $(nextDayId).offset().top - nextSub )) {
					$(dayClass).addClass('arrangements-checked');
					$(dayClass).siblings('a').removeClass('arrangements-checked');
					console.log(sub);
				} else {
					var totalDay = $('#travel_day').val();
					//$('.day1').removeClass('arrangements-checked');
					$('.day'+totalDay).removeClass('arrangements-checked');
				}
			}
		});

		//行程亮点菜单
		$(window).scroll(function () {
			if ($('.travel-highlights') > 0 && ($(this).scrollTop() > $('.travel-highlights').offset().top - 180) && ($(this).scrollTop() < $('.travel-arrangements-content').offset().top - 180 )) {
				$('.content-list-to-highlights').addClass('font-color');
				$('.content-list-to-highlights').siblings('a').removeClass('font-color');
			}else if ($('.travel-recommend') > 0 && ($(this).scrollTop() > $('.travel-recommend').offset().top - 180)) {
                $('.recommend').addClass('font-color');
                $('.recommend').siblings('a').removeClass('font-color');
            } else if ($('.travel-arrangements-content').length > 0 && ($(this).scrollTop() > $('.travel-arrangements-content').offset().top - 180) && ($(this).scrollTop() < $('.travel-notes').offset().top - 180 )){
				$('.content-list-to-arrangements').addClass('font-color');
				$('.content-list-to-arrangements').siblings('a').removeClass('font-color');
			}else if ($('.travel-notes').length > 0 && ($(this).scrollTop() > $('.travel-notes').offset().top - 180) && ($(this).scrollTop() < $('.content-money').offset().top - 180 )){
				$('.content-list-to-notes').addClass('font-color');
				$('.content-list-to-notes').siblings('a').removeClass('font-color');
			}else if (($(this).scrollTop() > $('.content-money').offset().top - 180) && ($(this).scrollTop() < $('.content-reserve').offset().top - 180 )){
				$('.content-list-to-attention').addClass('font-color');
				$('.content-list-to-attention').siblings('a').removeClass('font-color');
			}else if (($(this).scrollTop() > $('.content-reserve').offset().top - 180) && ($(this).scrollTop() < $('.content-scenery').offset().top - 180 )){
				$('.content-list-to-visa').addClass('font-color');
				$('.content-list-to-visa').siblings('a').removeClass('font-color');
			}else if ($('.content-scenery') > 0 && ($(this).scrollTop() >= $('.content-scenery').offset().top - 180)){
				$('.content-list-to-scenery').addClass('font-color');
				$('.content-list-to-scenery').siblings('a').removeClass('font-color');
			};
		});
		//行程亮点等
		$('.content-list-to-highlights').click( function(){
			$("html,body").animate({scrollTop: 1127}, 1000);
		} );
		toTag('#xcgy a', $('.travel-arrangements-content').offset().top - 160);
    	toTag('.recommend', 160);
		toTag('.content-list-to-arrangements', 160);
		toTag('.content-list-to-notes', 160);
		toTag('.content-list-to-attention', 160);
		toTag('.content-list-to-visa', 160);
		toTag('.content-list-to-scenery', 180);

		//day1-15
		toTag('.day1', 200);
		toTag('.day2', 180);
		toTag('.day3', 180);
		toTag('.day4', 180);
		toTag('.day5', 180);
		toTag('.day6', 180);
		toTag('.day7', 180);
		toTag('.day8', 160);
		toTag('.day9', 180);
		toTag('.day10', 180);
		toTag('.day11', 180);
		toTag('.day12', 180);
		toTag('.day13', 180);
		toTag('.day14', 180);
		toTag('.day15', 180);
		toTag('.day16', 180);
		toTag('.day17', 180);
		toTag('.day18', 180);
		toTag('.day19', 180);
		toTag('.day20', 180);
		toTag('.day21', 180);
	});