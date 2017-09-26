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
			console.log($(this).scrollTop());		
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
		$(window).scroll( function () {		
			if ($(this).scrollTop() > $('.travel-arrangements-content').offset().top && $(this).scrollTop() < ($('.travel-notes').offset().top - 500)) {
				$('.travel-arrangements-list').addClass('fixed-bottom');
			}else {
				$('.travel-arrangements-list').removeClass('fixed-bottom');
			};
		} );
		if ($(this).scrollTop() > $('.travel-arrangements-content').offset().top && $(this).scrollTop() < ($('.travel-notes').offset().top - 500)) {
				$('.travel-arrangements-list').addClass('fixed-bottom');
			}else {
				$('.travel-arrangements-list').removeClass('fixed-bottom');
			};
		$(window).scroll(function () {
			if (($(this).scrollTop() > $('#day1').offset().top - 160) && ($(this).scrollTop() < $('#day2').offset().top - 560 )) {
				$('.day1').addClass('arrangements-checked');
				$('.day1').siblings('a').removeClass('arrangements-checked');
			}else if (($(this).scrollTop() > $('#day2').offset().top - 560) && ($(this).scrollTop() < $('#day3').offset().top - 560 )){
				$('.day2').addClass('arrangements-checked');
				$('.day2').siblings('a').removeClass('arrangements-checked');
			}else if (($(this).scrollTop() > $('#day3').offset().top - 560) && ($(this).scrollTop() < $('#day4').offset().top - 560 )){
				$('.day3').addClass('arrangements-checked');
				$('.day3').siblings('a').removeClass('arrangements-checked');
			}else if (($(this).scrollTop() > $('#day4').offset().top - 560) && ($(this).scrollTop() < $('#day5').offset().top - 560 )){
				$('.day4').addClass('arrangements-checked');
				$('.day4').siblings('a').removeClass('arrangements-checked');
			}else if (($(this).scrollTop() > $('#day5').offset().top - 560) && ($(this).scrollTop() < $('#day6').offset().top - 560 )){
				$('.day5').addClass('arrangements-checked');
				$('.day5').siblings('a').removeClass('arrangements-checked');
			}else if (($(this).scrollTop() > $('#day6').offset().top - 560) && ($(this).scrollTop() < $('#day7').offset().top - 560 )){
				$('.day6').addClass('arrangements-checked');
				$('.day6').siblings('a').removeClass('arrangements-checked');
			}else if (($(this).scrollTop() > $('#day7').offset().top - 560) && ($(this).scrollTop() < $('.travel-notes').offset().top - 500 )){
				$('.day7').addClass('arrangements-checked');
				$('.day7').siblings('a').removeClass('arrangements-checked');
			}else {
				$('.day1').removeClass('arrangements-checked');
				$('.day7').removeClass('arrangements-checked');
			};
		});
		//行程亮点菜单
		$(window).scroll(function () {
			if (($(this).scrollTop() > $('.travel-highlights').offset().top - 180) && ($(this).scrollTop() < $('.travel-arrangements-content').offset().top - 180 )) {
				$('.content-list-to-highlights').addClass('font-color');
				$('.content-list-to-highlights').siblings('a').removeClass('font-color');
			}else if (($(this).scrollTop() > $('.travel-arrangements-content').offset().top - 180) && ($(this).scrollTop() < $('.travel-notes').offset().top - 180 )){
				$('.content-list-to-arrangements').addClass('font-color');
				$('.content-list-to-arrangements').siblings('a').removeClass('font-color');
			}else if (($(this).scrollTop() > $('.travel-notes').offset().top - 180) && ($(this).scrollTop() < $('.content-money').offset().top - 180 )){
				$('.content-list-to-notes').addClass('font-color');
				$('.content-list-to-notes').siblings('a').removeClass('font-color');
			}else if (($(this).scrollTop() > $('.content-money').offset().top - 180) && ($(this).scrollTop() < $('.content-reserve').offset().top - 180 )){
				$('.content-list-to-attention').addClass('font-color');
				$('.content-list-to-attention').siblings('a').removeClass('font-color');
			}else if (($(this).scrollTop() > $('.content-reserve').offset().top - 180) && ($(this).scrollTop() < $('.content-scenery').offset().top - 180 )){
				$('.content-list-to-visa').addClass('font-color');
				$('.content-list-to-visa').siblings('a').removeClass('font-color');
			}else if (($(this).scrollTop() >= $('.content-scenery').offset().top - 180) && ($(this).scrollTop() < $('.ask-question').offset().top - 180 )){
				$('.content-list-to-scenery').addClass('font-color');
				$('.content-list-to-scenery').siblings('a').removeClass('font-color');
			}else if (($(this).scrollTop() > $('.ask-question').offset().top - 180)){
				$('.content-list-to-question').addClass('font-color');
				$('.content-list-to-question').siblings('a').removeClass('font-color');
			};
		});
		//行程亮点等
		$('.content-list-to-highlights').click( function(){
			$("html,body").animate({scrollTop: 1127}, 1000);
		} );
		toTag('#xcgy a', $('.travel-arrangements-content').offset().top - 160);
		toTag('.content-list-to-arrangements', 160);
		toTag('.content-list-to-notes', 160);
		toTag('.content-list-to-attention', 160);
		toTag('.content-list-to-visa', 160);
		toTag('.content-list-to-scenery', 180);
		toTag('.content-list-to-question', 160);
		
		//day1-7
		toTag('.day1', 160);
		toTag('.day2', 180);
		toTag('.day3', 180);
		toTag('.day4', 180);
		toTag('.day5', 180);
		toTag('.day6', 180);
		toTag('.day7', 180);
	});