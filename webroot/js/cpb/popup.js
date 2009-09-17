// 
// This file is part of Nude.
// 
// Nude is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
// 
// Foobar is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with Nude.  If not, see <http://www.gnu.org/licenses/>.
// 
// Copyright 2009, Crispin Porter + Bogusky

(function($) {

  $.fn.popup = function(options) {

    // build main options before element iteration
    var opts = $.extend({}, $.fn.popup.defaults, options);

    // iterate and reformat each matched element
    return this.each(function() {
      $this = $(this);

      // build element specific options
      var o = $.meta ? $.extend({}, opts, $this.data()) : opts;

			$this.click(renderPopup);
    });
  };

	function renderPopup() {
		var stored = retrieveStoredPopup(),
		    $this = $(this);

		clearPopups();
		if(stored) {
			// TODO: handed stored popups
		} else {
			fetchContent($this);
		}
		return false;
	};

	function clearPopups() {
		$('.popup').remove();
	}

	function fetchContent(link) {
		var url = link.attr("href");
		$.ajax({
			url: url,
			type: "GET",
			dataType: "html",
			complete: function() {
		    //called when complete
			},
			success: function(html) {
				$('#PageWrapper').append(html);
				$('.popup > div').centerInClient();
				$('.popup_close', '.popup').click(function() { $('.popup').remove(); return false; });
			},
			error: function() {
				//called when there is an error
			}
		});
	};

	// rather than reload content via ajax on each request, we store the data
	// on the trigger element based on the rel attribute.
	function retrieveStoredPopup() {
		var popup = false;
		// TODO: implement storage retrieval
		return popup;
	};

  // private function for debugging
  function debug(obj) {
    if (window.console && window.console.log)
      window.console.log(obj);
  };

  // define and expose our format function
  $.fn.popup.format = function(txt) {
    return '<strong>' + txt + '</strong>';
  };

  // plugin defaults
  $.fn.popup.defaults = {
    foreground: 'red',
    background: 'yellow'
  };

})(jQuery);
