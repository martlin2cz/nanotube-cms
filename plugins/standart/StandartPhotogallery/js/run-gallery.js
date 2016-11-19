$(function() {
	var config = {
			download: false
	};
	
	$('.gallery').each(function(i) {
		$(this).lightGallery(config);
	});
});
