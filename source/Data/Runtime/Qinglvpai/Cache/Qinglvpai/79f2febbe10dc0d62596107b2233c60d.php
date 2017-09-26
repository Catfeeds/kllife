<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php if(empty($PageKeyword) == false): ?><meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
	<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
	<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
	<title><?php echo ($PageKeyword["title"]); ?></title>
	<?php else: ?>
	<title><?php echo C('PAGE_TITLE');?></title><?php endif; ?>
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/animate.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/style/style.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/style.css">
	<!-- css Reset -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/cssreset.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/common.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/common/css/common.css">
	<!--私有样式-->
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/article_info.css"/>
	<!-- 引用jq -->
	<script src="http://kllife.com/source/Static/home/common/js/jquery-1.11.3.min.js"></script>
</head>
<body>
<!-- 弹出图片 -->
<div class="popup">
	<div class="header">
		<a href="<?php echo U('index/welcome');?>" target="_blank"><img src="http://kllife.com/source/Static/qinglvpai/images/index/logo-qinglvpai.png" alt=""></a>
		<span>搞笑</span>
	</div>
	<div class="content">
		<a href="javascript:;" style="position: relative;display: inline-block;overflow: hidden;">
			<img class="img" src="http://kllife.com/source/Static/qinglvpai/images/index/banner.png" />
			<!--分享-->
			<a href="javascript:;" style="position: absolute;display: inline;top:0px;right:-50px;height:50px;width:80px;background:#26272b;padding-top:10px; "><img src="http://kllife.com/source/Static/qinglvpai/images/article/share.png" alt=""></a>
		</a>
		<div class="div_perview_button"><span><i class="iconfontyyy">&#xe6a4;</i></span></div>
		<div class="div_next_button"><span><i class="iconfontyyy">&#xe6a2;</i></span></div>
	</div>
</div>
<div class="word" style="position: fixed;padding-left:30px;font-size:16px;bottom:0px;color:#fff;width:100%;height:60px;line-height:60px;background: rgba(0,0,0,0.5);">
	这里是描述文字这里是描述文字这里是描述文字这里是描述文字这里是描述文字
</div>
</body>
<script type="text/javascript">
	
    //点击图片放大显示
    var gCurIndex = 0;
    var gShowArticle = null;    
    function initImage() {
    	var articleId = '<?php echo ($id); ?>';
        $.post('<?php echo U("article/list");?>', {op_type:'find', id: articleId}, function(data){
            if (data.ds != null) {
                gShowArticle = data.ds;
                var d = gShowArticle.image_text_list;
                if (d == '' || d == null || d == 'undefined' || d.length == 0) {
                    alert('没有可展示的图文信息');
                    return false;
                }
                $('.popup').find('.header span').html(gShowArticle.title);
                $('.popup').find('.content .img').attr('src', d[gCurIndex]['image']);
                $('.word').html(d[gCurIndex]['text']);
                $(".popup").show();
            } else {
                alert('没有可展示的图文信息');
                return false;
            }
        });
    }
    
    // 初始化图片显示
    initImage();    

    // 显示上张图片
    $('.div_perview_button').click(function(){
        if (gShowArticle == null) {
            alert('没有可展示的图文信息');
            return false;
        }

        var d = gShowArticle.image_text_list;
        if ((gCurIndex-1) < 0) {
            alert('已经是第一张图片了');
            return false;
        }

        gCurIndex--;
        $('.popup').find('.content .img').attr('src', d[gCurIndex]['image']);
        if (d[gCurIndex]['text'] == '' || d[gCurIndex]['text'] == null || d[gCurIndex]['text'] == 'undefined') {
            $('.word').html('');
        } else {
            $('.word').html(d[gCurIndex]['text']);
        }
    });

    // 显示下张图片
    $('.div_next_button').click(function(){
        if (gShowArticle == null) {
            alert('没有可展示的图文信息');
            return false;
        }

        var d = gShowArticle.image_text_list;
        if ((gCurIndex + 1) >= d.length) {
            alert('已经是最后一张图片了');
            return false;
        }

        gCurIndex++;
        $('.popup').find('.content .img').attr('src', d[gCurIndex]['image']);
        if (d[gCurIndex]['text'] == '' || d[gCurIndex]['text'] == null || d[gCurIndex]['text'] == 'undefined') {
            $('.word').html('');
        } else {
            $('.word').html(d[gCurIndex]['text']);
        }
    });



    //图片垂直居中
    $(document).ready(function(){
        $(".popup .content .img").on("load",function(){
            var imgh = $(this).height();
            var divh = $(".content").height();
            var top = (divh-imgh)/4;
            $(this).css("margin-top",top+"px");
        });
    });
</script>