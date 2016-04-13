jQuery(function($) {

	/* color style
	------------------------------------------------------------------------- */
	function switchStyle(color) {
		$('link[rel*=alt]').each(function(i) {
			this.disabled = true;
			if (this.getAttribute('title') == color) {
				this.disabled = false;
			}
		});
		$.cookie('style', color, { expires: 7 });
	}
	$('#colorstyle a').click(function() {
		var color = $(this).attr('rel');
		switchStyle(color);
		return false;
	});
	var cookiestyle = $.cookie('style');
	if (cookiestyle) {
		switchStyle(cookiestyle);
	}

	/* layout width
	------------------------------------------------------------------------- */
	function switchWidth(width) {
		if (width == 'fluid') {
			$('body').addClass('fluid');
		} else {
			$('body').removeClass('fluid');
		}
		$.cookie('width', width, { expires: 7 });
	}
	$('#layoutwidth a').click(function() {
		var width = $(this).attr('rel');
		switchWidth(width);
		return false;
	});
	var cookiewidth = $.cookie('width');
	if (cookiewidth) {
		switchWidth(cookiewidth);
	}

});