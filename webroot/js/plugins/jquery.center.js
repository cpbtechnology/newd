// centerInClient Plugin from Rick Strahl
//

(function($) {
	$.fn.centerInClient = function(options) {

	    var opt = { forceAbsolute: false,
	                container: window,    // selector of element to center in
	                completeHandler: null
	              };

	    $.extend(opt, options);
   
	    return this.each(function(i) {
	        var el = $(this);
	        var jWin = $(opt.container);
	        var isWin = opt.container == window;

	        // force to the top of document to ENSURE that 
	        // document absolute positioning is available
	        if (opt.forceAbsolute) {
	            if (isWin)
	                el.remove().appendTo("body");
	            else
	                el.remove().appendTo(jWin.get(0));
	        }

	        // have to make absolute
	        el.css("position", "absolute");

	        // height is off a bit so fudge it
	        var heightFudge = isWin ? 2.0 : 1.8;

	        var x = (isWin ? jWin.width() : jWin.outerWidth()) / 2 - el.outerWidth() / 2;
	        var y = (isWin ? jWin.height() : jWin.outerHeight()) / heightFudge - el.outerHeight() / 2;

	        el.css("left", x + jWin.scrollLeft());
	        el.css("top", y + jWin.scrollTop());

	        // if specified make callback and pass element
	        if (opt.completeHandler)
	            opt.completeHandler(this);
	    });
	};
})(jQuery);