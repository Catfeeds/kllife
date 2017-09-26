function Verify(obj, w, h, l, f, id) {
	if ($(obj).get(0).tagName != 'IMG') {
		console.log('这不是一个图片DOM');
	}
	
	this.imgObj = obj;
	this.vid = id == null || id == '' ? 1 : vid;
	this.vwidth = w;
	this.vheight = h;
	this.vlength = l;
	this.vfont = f;
	
	// 设置验证码
	this.refresh();
	
    this.imgObj.bind('click', {obj:this}, this.refreshEvent);
}

Verify.prototype.refreshEvent = function(e) {
	if (e.data.obj != null) {		
		var url = 'http://kllife.com/back/index.php?s=/back/help/verify';
		if (e.data.obj.vwidth != null && e.data.obj.vwidth != '') {
			url += '/w/'+e.data.obj.vwidth;
		}
		if (e.data.obj.vheight != null && e.data.obj.vheight != '') {
			url += '/h/'+e.data.obj.vheight;
		}
		if (e.data.obj.vlength != null && e.data.obj.vlength != '') {
			url += '/l/'+e.data.obj.vlength;
		}
		if (e.data.obj.vfont != null && e.data.obj.vfont != '') {
			url += '/f/'+e.data.obj.vfont;
		}
		if (e.data.obj.vid != null && e.data.obj.vid != '') {
			url += '/id/'+e.data.obj.vid;
		}
		e.data.obj.imgObj.attr('src', url);
	}
}

Verify.prototype.refresh = function() {
    var url = 'http://kllife.com/back/index.php?s=/back/help/verify';
    if (this.vwidth != null && this.vwidth != '') {
        url += '/w/'+this.vwidth;
    }
    if (this.vheight != null && this.vheight != '') {
        url += '/h/'+this.vheight;
    }
    if (this.vlength != null && this.vlength != '') {
        url += '/l/'+this.vlength;
    }
    if (this.vfont != null && this.vfont != '') {
        url += '/f/'+this.vfont;
    }
	if (this.vid != null && this.vid != '') {
		url += '/id/'+this.vid;
	}
    this.imgObj.attr('src', url);
}

Verify.prototype.check = function(vcode) {
	if (vcode == null || vcode == '') {
		alert('您输入的验证码不能为空');
		return false;
	}
	var jsonData = {
		id: this.vid,
		code: vcode
	}
	
	var vpass = false;
	$.ajax({
		url: 'http://kllife.com/back/index.php?s=/back/help/verify',
		type: 'POST',
		async: false,
		data: jsonData,
		dataType: 'json',
		success: function(data) {
			vpass = data.pass == null || data.pass == 0 ? false : true;
		}
	});
	return vpass;
}