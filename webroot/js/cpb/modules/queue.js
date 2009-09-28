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

// global function for youtube player external interface.
function initYouTubePlayer() {
	var videos = CPB.queue.createPlayList();
	setVideoData(videos);
};

CPB.queue = new CPB.localModule('queue', {
	paginateNextBindPoint: '#Queue ul.Pagination li.Next a',
	paginatePreviousBindPoint: '#Queue ul.Pagination li.Previous a'
});

// Extend the localModule init function to handle video player
CPB.queue.superInit = CPB.queue.initOnReady;
CPB.queue.initOnReady = function() {
	CPB.queue.superInit();
	this.initializeYouTubePlayer();
};

CPB.queue.swfid = SWFID = "VideoPlayer";

CPB.queue.updateHTML = function(id, value) {
	document.getElementByID(id).innerHTML = value;
};

CPB.queue.updateytplayerInfo = function() {
  updateHTML("bytesloaded", getBytesLoaded());
  updateHTML("bytestotal", getBytesTotal());
  updateHTML("videoduration", getDuration());
  updateHTML("videotime", getCurrentTime());
  updateHTML("startbytes", getStartBytes());
  updateHTML("volume", getVolume());
};

CPB.queue.extractVideoIdFromUrl = function(url) {
	var results = /[\\?&]v=([^&#]*)/.exec(url);
	var id = "";
	if( results != null ) {
		id = results[1];
	}
	return id;
};

CPB.queue.initializeYouTubePlayer = function() {
	CPB.queue.bindLinksToPlayer();

	var flashvars = { autoStart: "true"},
			params = { menu: "false",
								 allowScriptAccess: "always",
								 scale: "noscale",
								 wmode: "opaque" },
			attributes = {},
			player_path = "/swf/ASYouTubeWrapper.swf",
			flash_version = swfobject.getFlashPlayerVersion();
			
	if(flash_version.major > 9) {
		swfobject.embedSWF(player_path, CPB.queue.swfid, "430", "260", "9.0.115", 'playerProductInstall.swf', flashvars, params, attributes);
	} else {
		$('#VideoPlayer p.no_flash').show().html('<a href="http://get.adobe.com/flashplayer/">You must have Flash and Javascript enabled to watch videos.</a>');
	}
	
	
};

CPB.queue.loadFirstVideo = function() {
	var first_video_id = $("#youtube_module .MediaContainer ul li a").get(0).href,
			yt_id = CPB.queue.extractVideoIdFromUrl(first_video_id);

	loadVideoById(yt_id);
};

CPB.queue.bindLinksToPlayer = function() {
		$('#youtube_module #Player .Pagination .Next').click(function(e) {
			e.preventDefault();
			nextVideo();
		});
		$('#youtube_module #Player .Pagination .Previous').click(function(e) {
			e.preventDefault();
			prevVideo();
		});
	
	var links = $("#youtube_module .MediaContainer ul li a");
	links.each(function() {
		var $this = $(this),
				yt_id = CPB.queue.extractVideoIdFromUrl($this.get(0).href);
		
		$this.click(function(ev) {
			ev.preventDefault();
			loadVideoById(yt_id);
		});
	});
};

CPB.queue.createPlayList = function() {
	var links = $("#youtube_module .MediaContainer ul li a"),
			client = $('#youtube_module .MediaContainer ul li').attr('class'),
			videos = [],
			video = {};

	links.each(function() {
		var $this = $(this),
		    title = $this.attr('title'),
		    yt_id = CPB.queue.extractVideoIdFromUrl($this.attr('href'));
		
		videos.push({'client': client, 'title': title, 'id': yt_id});
	});
	return videos;
};

CPB.queue.view.paginate = function(data) {
	var	$obj = $('#Queue .MediaContainer ul');
			distance = data.direction * CPB.queue.settings.height;
	CPB.media.paginate($obj.parent(), $obj, CPB.queue.paginateNextBindPoint, CPB.queue.paginatePreviousBindPoint, data.direction, distance, CPB.queue.settings.visible, CPB.queue.settings.height, CPB.queue.settings.offset);
};

CPB.queue.view.reload = function(data) {
	CPB.media.reload(CPB.queue.view.partial.entries(data.posts), '#Queue div.MediaContainer', '#Queue div.MediaContainer ul', CPB.queue.paginateNextBindPoint, CPB.queue.paginatePreviousBindPoint, CPB.queue.settings.visible, CPB.queue.settings.height, CPB.queue.settings.offset, function() {
		var videos = CPB.queue.createPlayList();
		setVideoData(videos);
		CPB.queue.bindLinksToPlayer();
	});
};

CPB.queue.view.partial.entries = function(data) {
	var entries = '';
	for(var i in data) {
		var entry =	'<li class="{topic}">' +
								'<a href="http://www.youtube.com/watch?v={video_id}">' +
								'<img src="{image_url}" alt=\'{title}\' width="84" height="63"/>' +
								'<span class="overlay"></span>' +
								'</a>' +
								'</li>';
		entries += entry.replace(/\{[^\}|^\s]*\}/g, function(key) {
			return CPB.tokenize(key, data[i], true);
		});
	}
	return entries;
};

CPB.queue.settings = {
	visible: 6,
	height: 219,
	offset: 7
};