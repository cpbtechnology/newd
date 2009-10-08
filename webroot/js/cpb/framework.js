// This file is part of Newd.
// 
// Newd is free software: you can redistribute it and/or modify
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
// along with Newd.  If not, see <http://www.gnu.org/licenses/>.
// 
// Copyright 2009, Crispin Porter + Bogusky

//= require "utilities"

var CPB = CPB || {};

CPB.progressiveEnhance = $.browser.safari && $.browser.version >= 4;

CPB.topic = window.location.pathname == '/' ? '/topics/cpb' : window.location.pathname;

CPB.defaults = {
	updatePath: '/update/{shortName}.json',
	paginatePath: '/more/{shortName}',
	defaultLoaded: 12,
	paginateLimit: 12
};

// CONTROLLERS

CPB.modules = [];
CPB.reload = function(event, data) {
	CPB.topic = data.path == '/' ? '/topics/cpb' : data.path;
	var topic_shortname = CPB.topic.replace(/^#!/,'');
	$("#PageWrapper").removeAttr("class").addClass(topic_shortname);

	CPB.deepLinking.currentLocation = window.location.hash = CPB.hashPath(CPB.topic);
	CPB.dispatcher.reset();
	
	$('div.Loader').show();

	CPB.updateShareLinks();
	CPB.updatePageTitle();

	CPB.dispatcher.process(CPB.topic.replace(/\/$/, '') + '.json', function(data) {
		for( var i in CPB.modules ) {
			var module = CPB.modules[i];
			module.render(module.view.reload, data[module.shortName]);
			module.paginateOffset = module.defaultLoaded || CPB.defaults.defaultLoaded;
		}
		$('div.Loader').hide();
	});
};

CPB.initOnReady = function(reloadBindPoint) {
	for( var i in CPB.modules ) {
		CPB.modules[i].initOnReady();
	}

	CPB.deepLinking = new CPB.history(function(data) {
		var reloadUrl = window.location.hash ? '/topics/'+window.location.hash.slice(1) : '/topics/cpb';
		$(reloadBindPoint).filter(function() {
			return $(this).attr('href') == reloadUrl;
		}).trigger('mousedown');
	});

	CPB.updateShareLinks();
	CPB.updatePageTitle();

	$(reloadBindPoint).bind('mousedown.reload', function(event) {
		event.preventDefault();
		if(!$(this).closest('li').hasClass('active')) {
			var reloadUrl = $(this).attr('href').replace('#!', '/topics/');
			CPB.reload(event, { path: reloadUrl });
		}
	});
	
	$(reloadBindPoint).bind('click.reload', function(event) {
		event.preventDefault();
	});

};

CPB.module = function() {};
CPB.module.prototype.constructor = CPB.module;
CPB.module.prototype.reload = function(event, data) {
	var module = this;
	module.lastUpdate = CPB.timestamp();
	module.path = data.path;
	CPB.dispatcher.process(data.path, function(data) {
		module.render(module.view.reload, data[module.shortName]);
	});
	module.lastUpdate = CPB.timestamp();
};
CPB.module.prototype.render = function(view, data) {
	view(data);
};

CPB.remoteModule = function(shortName, options) {
	var module = this;
	
	// if no shortname is set, throw an error
	// all event bindings are predicated on this shortname matching the module
	if(!shortName || shortName == '') {
		throw 'module shortname can not be blank: ' + this;
	}
	
	// instantiate module variables
	module.shortName = shortName;
	module.topicPrefix = options.topicPrefix || CPB.defaults.topicPrefix;
	module.lastUpdate = CPB.timestamp();
	module.updatePath = options.updatePath || CPB.defaults.updatePath.replace(/\{[^\}]*\}/g, function(key) {
		return module[key.slice(1,-1)];
	});
	module.updateBindPoint = options.updateBindPoint;
	module.paginatePath = options.paginatePath || CPB.defaults.paginatePath.replace(/\{[^\}]*\}/g, function(key) {
		return module[key.slice(1,-1)];
	});
	module.defaultLoaded = options.defaultLoaded || CPB.defaults.defaultLoaded;
	module.paginateOffset = module.defaultLoaded;
	module.paginateLimit = options.paginateLimit || CPB.defaults.paginateLimit;
	module.paginateBindPoint = options.paginateBindPoint;
	module.autoUpdate = options.autoUpdate || false;
	module.autoUpdateInterval = options.autoUpdateInterval || 60000;
	module.loader = options.loader;
	if(options.callback && typeof(options.callback) == 'function') {
		module.initOnReadyCallback = options.callback;
	}
	
	// register module with reload stack
	CPB.modules.push(this);
	
	// set up necessary views and empty partial object
	module.view = {
		reload: null,
		update: null,
		paginate: null,
		partial: {}
	};
	
	// register event listeners for primary methods
	$(document).bind('reload.'+shortName, function(event, data) {
		module.reload(event, data);
	});
	$(document).bind('update.'+shortName, function(event, data) {
		module.update(event, data);
	});
	$(document).bind('paginate.'+shortName, function(event, data) {
		module.paginate(event, data);
	});
	
	
};
CPB.remoteModule.prototype = new CPB.module;
CPB.remoteModule.prototype.constructor = CPB.remoteModule;
CPB.remoteModule.prototype.initOnReady = function() {
	var module = this;
	if(module.paginateBindPoint) {
		$(module.paginateBindPoint).bind('click.paginate', function(event) {
			event.preventDefault();
			$(document).trigger('paginate.'+module.shortName, { path: module.paginatePath }); 
		});	
	}
	if(module.updateBindPoint) {
		$(module.updateBindPoint).bind('click.update', function(event) {
			event.preventDefault();
			$(document).trigger('update.'+module.shortName, { path: module.updatePath }); 
		});	
	}
	if(module.autoUpdate) {
		module.autoUpdate = setInterval(function() {
			$(document).trigger('update.'+module.shortName, { path: module.updatePath }); 
		}, module.autoUpdateInterval);
	}
	
	if(module.initOnReadyCallback) {
		module.initOnReadyCallback();
	}
	
	module.lastUpdate = CPB.timestamp();
};
CPB.remoteModule.prototype.update = function(event, data) {
	var module = this;
	CPB.dispatcher.process(CPB.topic + module.updatePath, function(data) {
		module.render(module.view.update, data[module.shortName]);
	});
	module.lastUpdate = CPB.timestamp();
};
CPB.remoteModule.prototype.paginate = function(event, data) {
	var module = this;
	$(module.loader).show();
	CPB.dispatcher.process(CPB.topic + module.paginatePath + '/' + module.paginateLimit + '/' + module.paginateOffset + '.json', function(data) {
		module.render(module.view.paginate, data[module.shortName]);
		module.paginateOffset += module.paginateOffset;
		$(module.loader).hide();
	});
};

CPB.localModule = function(shortName, options) {
	var module = this;

	// if no shortname is set, throw an error
	// all event bindings are predicated on this shortname matching the module
	if(!shortName || shortName == '') {
		throw 'module shortname can not be blank: ' + this;
	}
	
	// instantiate module variables
	module.shortName = shortName;
	module.paginateNextBindPoint = options.paginateNextBindPoint;
	module.paginatePreviousBindPoint = options.paginatePreviousBindPoint;
	if(options.callback && typeof(options.callback) == 'function') {
		module.initOnReadyCallback = options.callback;
	}
		
	// register module with reload stack
	CPB.modules.push(this);
	
	// set up necessary views and empty partial object
	module.view = {
		reload: null,
		partial: {}
	};
	
	// register event listeners for primary methods
	$(document).bind('reload.'+shortName, function(event, data) {
		module.reload(event, data);
	});
	$(document).bind('paginate.'+shortName, function(event, data) {
		module.paginate(event, data);
	});
	
};
CPB.localModule.prototype = new CPB.module;
CPB.localModule.prototype.constructor = CPB.localModule;
CPB.localModule.prototype.initOnReady = function() {
	var module = this;
	
	if(module.paginateNextBindPoint) {
		$(module.paginateNextBindPoint).bind('click.paginate.next', function(event) {
			event.preventDefault();
			$(document).trigger('paginate.'+module.shortName, { direction: 1 }); 
		});
	}
	if(module.paginatePreviousBindPoint) {
		$(module.paginatePreviousBindPoint).bind('click.paginate.previous', function(event) {
			event.preventDefault();
			$(document).trigger('paginate.'+module.shortName, { direction: -1 }); 
		});
	}
	
	if(module.initOnReadyCallback) {
		module.initOnReadyCallback();
	}
};
CPB.localModule.prototype.paginate = function(event, data) {
	var module = this;
	module.render(module.view.paginate, data);
};