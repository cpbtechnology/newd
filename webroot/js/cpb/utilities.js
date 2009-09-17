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

//= require <jquery>

var CPB = CPB || {};

/* UTILITIES */

CPB.preloadImages = function() {
	for(var i = 0; i<arguments.length; i++) {
		$("<img>").attr("src", arguments[i]);
	}
};

CPB.tokenize = function(key, object, addSlashes) {
	var index, key, token = key.slice(1,-1);
	if(token.indexOf('.') >= 0) {
		var multiToken = token.split('.');
		for(i=0; i<multiToken.length; i++) {
			object = object[multiToken[i]];
		}
		key = object;
	} else {
		key = object[token];
	}
	if(addSlashes) {
		return key.replace(/\'/g,'\\\'') || '';
	} else {
		return key;
	}
};

CPB.hashPath = function(str) {
	return '#'+str.replace(/^\/topics\//, '');
};

CPB.timestamp = function() {
	var date = new Date();
	return date.getTime();
};

// If there's no hash in the URL, assume we're on the homepage and set the
// hash for history.  If there is a hash load that topic's content.  This
// function can only be called on first load.
CPB.hashHandler = function() {
	var default_nav = $("Nav > li a"),
	    default_hash = '#cpb',
	    topic_path,
	    reloadLink;

	if (!(/^#/.test(window.location.hash))) {
		window.location.hash = default_hash;
	} else if (window.location.hash != default_hash){
		topic_path = '/topics/' + window.location.hash.replace(/^#/, '');
		$reloadLink = $("#Nav a[href=" + topic_path + "]");
		$reloadLink.trigger('mousedown');
	}
};

CPB.history = function(callback) {
	if(typeof(callback) != 'function') {
		throw "History mapping received invalid callback function: " + callback;
	}
	var history = this;
	history.currentLocation = window.location.hash;
	history.historyCheck = setInterval(function() {
		if(window.location.hash != history.currentLocation) {
			history.currentLocation = window.location.hash;
			callback(history.currentLocation);
		}
	}, 200);
};

CPB.history.prototype.constructor  = CPB.history;
CPB.history.prototype.setLocation = function(hash) {
	
};

CPB.updateShareLinks = function() {

	var $share_links = $("#Share a");
	$share_links.each(function() {
		var $this = $(this),
				link = $this.get(0),
				site_url = "[YOUR SITE URL]",
				current_hash = window.location.hash;

		if("" == current_hash) {
			_clearHash(link);
		} else {
			_updateHash(link, current_hash);
		}
	});

	function _clearHash(link) {
		link.href = link.href.replace(/#[^\W]*/,'');
	}

	function _updateHash(link, hash) {
		if(/#/.test(link.href)) {
			link.href = link.href.replace(/#[^\W]*/, hash);
		} else {
			// TODO: match site_url in the href, currently assumes URLs end with link to site.
			link.href += hash;
		}
		
	}
};

// TODO: Map client IDs to user friendly names
CPB.updatePageTitle = function() {

	var title = document.getElementsByTagName("title")[0],
			divider = " : ",
			current_topic = window.location.hash.replace(/#/, ""),
			default_title = "Newd";

	if("" == current_topic) {
		title.text = default_title;
	} else {
		if(/:/.test(title.text)) {
			title.text = title.text.replace(/:.*$/, divider + current_topic);
		} else {
			title.text += divider + current_topic;
		}
	}
};

CPB.dispatcher = {
	retrieving: {
		set: function(state, targetURL, callback) {
			if(state) {
				this.active = true;
				this.targetURL = targetURL;
				this.callback = callback;
			} else {
				this.active = false;
				this.targetURL = null;
				this.callback = null;
			}
		},
		active: false,
		targetURL: null,
		callback: null
	},
	xhr: null,
	queue: [],
	process: function(targetURL, callback, interrupt) {
		if(typeof(callback) != 'function') {
			// to do: handle exceptions
			throw "Syntax error, unrecognized expression: " + callback;
		}

		if(!this.retrieving.active) {
			this.dispatch(targetURL, callback);
		} else {
			this.queue.push({
				"targetURL": targetURL,
				"callback": callback
			});
		}
	},
	dispatch: function(targetURL, callback) {
		var dispacther = this;
		dispacther.xhr = $.ajax({
			url: targetURL,
			type: 'get',
			dataType: 'json',
			beforeSend: function() {
				dispacther.retrieving.set(true, targetURL, callback);
			},
			success: function(data) {
				callback(data);
			},
			complete: function() {
				dispacther.retrieving.set(false);
				dispacther.processQueue();
			}
		});
	},
	processQueue: function() {
		if(this.queue.length > 0) {
			this.dispatch(this.queue[0].targetURL, this.queue[0].callback);
			this.queue.shift();
		}
	},
	abort: function() {
		this.xhr.abort();
	},
	interrupt: function(targetURL, callback) {
		this.abort();
		this.queue.unshift({
			"targetURL": this.retrieving.targetURL,
			"callback": this.retrieving.callback
		});
		this.dispatch(targetURL, callback);
	},
	reset: function() {
		this.queue = [];
		if(this.xhr) {
			this.abort();
		}
	}
};