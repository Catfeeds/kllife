// 文档结构载入完成后，显示Loading效果
$(function(){
	loading_container  = '<div id="loading_container" style="position:absolute;z-index:1000;width:100%;height:100%;padding:0;margin:0;text-align:center;background-color:#ffffff;">';
	loading_container += '<div id="loading_circle">';
	loading_container += '<span id="outer"><span id="inner"></span></span>';
	loading_container += 'Loading';
	loading_container += '<div id="loading_slow">网速有点慢，请继续等待或 <a href="#" id="loading_refresh">重载</a> 网页。</div>';
	loading_container += '</div>';
	loading_container += '</div>';
	$("body").prepend(loading_container);
	setTimeout(function(){
		$("#loading_slow").fadeIn(500)
	},
	5000);
	$("#loading_refresh").click(function() {
		location.reload();
		return ! 1;
	});
});

// 文档元素载入完成后，删除Loading效果
$(window).load(function(){
	$("#loading_container").fadeOut(500,function(){
		$(this).remove();
		
	});
});
// 音乐
$(".music").click(function(){
        if($(".icon-music").attr("num") == "1"){
            $(".icon-music").removeClass("open");
            $(".icon-music").attr("num","2")
            $(".music-span").css("display","none");
            document.getElementById("aud").pause();
            $(".music_text").html("关闭");
            $(".music_text").addClass("show_hide");
            setTimeout(musicHide,2000);
        }else{
            $(".icon-music").attr("num","1");
            $(".icon-music").addClass("open");
            $(".music-span").css("display","block");
            document.getElementById("aud").play();
            $(".music_text").html("开启");
            $(".music_text").addClass("show_hide");
            setTimeout(musicHide,2000);
        }
        function musicHide(){
            $(".music_text").removeClass("show_hide");
        }

	  });