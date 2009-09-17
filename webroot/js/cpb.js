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

//= require <jquery>
//= require "plugins/jquery.metadata"
//= require "plugins/jquery.center"
//= require "swfobject"
//= require "youTubeLoader"
//= require "cpb/popup"

// auto-redirect on matched pattern if javascript is available
if(window.location.pathname.match(/^\/topics\//)) {
	window.location.replace('/' + window.location.pathname.replace(/^\/topics\//, '#'));
}

// setup namespace
var CPB = CPB || {};

//= require "cpb/framework"
//= require "cpb/modules"

// debug non-implemented links
$.fn.debug_links = function() {
  return this.each(function() {
		$(this).live('click', function() {
			alert("Sorry, this link is not implemented yet.");
			return false;
		});
	});
};


// Functions applied on page load and on the inserted DOM in any XHR request,
// don't forget to scope the Selectors.
CPB.onload = function () {
	var scope = scope || $(document);
	
	$(".Popup", scope).popup();
};

// Functions only applied on DOM ready, includes CPB.onload.
CPB.load_once = function() {
	CPB.onload();
	CPB.initOnReady('#Nav a');
		
	// open new window links on click (replaces target="_blank")
	$('a[rel=NewWindow]').live('click', function(e) {
		window.open($(this).attr('href'), 'new');
		pause();
		return false;
	});
	$('a[href=CPB_TEST]').debug_links();
	
	// handle load errors
	$(document).bind('loaderror', function() {
		$('div.Loader').hide();
	});

	// Handle deep linking
	CPB.hashHandler();
	
	//global ajax setup
	$(document).ajaxError(function() {
			$('div.Loader').hide();
	});
	
	$.ajaxSetup({
		timeout: 15000
	});
};

// global OnDOMReady()
$(document).ready(function() {
	CPB.load_once();
});

$(window).load(function() {
	CPB.preloadImages("/img/popups/bkg.contact.jpg", "/img/popups/bkg.developers.jpg");
});
//write javascript.css link
var jsCss = document.createElement('link');
jsCss.rel = 'stylesheet';
jsCss.href = '/css/javascript.css';
jsCss.type = 'text/css';
document.getElementsByTagName('head')[0].appendChild(jsCss);


if ( window.addEventListener ) {
	var kkeys = [], konami = "82";
	window.addEventListener("keydown", function(e){
		kkeys.push( e.keyCode );
		if ( kkeys.toString().indexOf( konami ) >= 0 ) {
			kkeys = [];
			CPB.twitter.update();
		}
	}, true);
}