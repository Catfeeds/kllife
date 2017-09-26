function MyVideo(eClickCallBack, vWidth, vHeight) {
	this.clickCallback = eClickCallBack;	
	if (vWidth == null || vWidth == '' || parseInt(vWidth) <= 0) {
		vWidth = 880;
	}
	
	if (vHeight == null || vHeight == '' || parseInt(vHeight) <= 0) {
		vHeight = 536;
	}
	
	this.width = vWidth;
	this.height = vHeight;
}

MyVideo.prototype.showMyVideo = function(videoId){	
	var jsonData = {
		obj: 'video',
		id: videoId,
	}
	var thisObj = this;
	$.post('http://kllife.com/back/index.php?s=/back/help/find', jsonData, function(data){
		if (data.ds != null) {
			var d = data.ds;
			var vt_key = 'youku';
			if (d.src_type != null && d.src_type != '') {
				var vt = $.parseJSON(d.src_type);
				vt_key = vt.type_key;
			}
			
			var vhtml = '';
			if (vt_key.indexOf('meipai') != -1) {
				var flashvars = 'initCallback=onMTPlayerInitCallback&amp;startPlayVideoCallback=onMTPlayerPlayCallback&amp;pauseVideoCallback=onMTPlayerPauseCallback&amp;toggleBarrageCallback=onToggleBarrageCallback&amp;playVideoCallback=onPlayVideoCallback&amp;objectID='+d.src_id+'&amp;'+d.href;
				vhtml = '<object type="application/x-shockwave-flash" id="'+d.src_id+'" name="'+d.src_id+'" align="middle" data="http://img.app.meitudata.com/meitumv/mtplayer5/swf/mp4Player.swf?1.3.00" width="'+thisObj.width+'" height="'+thisObj.height+'">'+
						'	<param name="quality" value="high">'+
						'	<param name="allowscriptaccess" value="always">'+
						'	<param name="allowfullscreen" value="true">'+
						'	<param name="wmode" value="transparent">'+
						'	<param name="bgcolor" value="#ffffff">'+
						'	<param name="flashvars" value="'+flashvars+'">'+
						'</object>';
			} else {
				vhtml = '<iframe id="videoIframe" height="'+thisObj.height+'" width="'+thisObj.width+'" src="'+d.href+'" frameborder=0 allowfullscreen></iframe>';
			}
			
			
			if (thisObj.clickCallback != null && typeof(thisObj.clickCallback) == 'function') {
				thisObj.clickCallback(d, vhtml);
			}	
		} else {
			if (data.result != null) {
				console.log(data.result.message);
			} else {
				console.log('加载视频信息失败');
			}
		}			
	});	
}

