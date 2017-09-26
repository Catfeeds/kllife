
function delayLoader(rimg) {
	this.loadImages = array();
	this.replace_image = rimg;
}

delayLoader.prototype.Init = function(){
	var replaceImage = this.replace_image;
	if (this.replace_image != null && this.replace_image != null) {
		$('.delay-img').each(function(i,ev){
			var tName = $(this).get(0).tagName;
			if (tName == 'IMG') {
				$(this).attr('src', replaceImage);
			}
		});	
	}
}