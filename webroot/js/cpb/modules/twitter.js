// 
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

CPB.twitter = new CPB.remoteModule('twitter', {
	selector: '#Twitter',
	paginateBindPoint: '#Twitter p.Pagination a',
	autoUpdate: true,
	autoUpdateInterval: 120000,
	loader: '#Twitter p.Pagination span.loader',
	callback: function() {
		$('#Twitter div.MediaContainer ul li').hover(function() {
			$(this).addClass('hover');
		}, function() {
			$(this).removeClass('hover');
		});
		$('#Twitter .MediaContainer ul li img').each(function() {
			var image = this;
			var $this = $(this);
		});
		$('#Twitter .MediaContainer ul li').live('click', function() {
			var $this = $(this);
			window.open($this.find('a.twi_username').attr('href'));
			return false;
		});
		CPB.twitter.onLoad();
	}
});

CPB.twitter.onLoad = function() {
	$('#Twitter #twitter_feed img').load(function() {
		var $this = $(this);
		if(this.naturalHeight == 0) {
			$this.attr('src', '/img/failwhale.jpg');
		}
	});
};

CPB.twitter.view.update = function(data) {
	if(data.length > 0) {
		var $feed = $('#Twitter #twitter_feed');
		var posts = CPB.twitter.view.partial.posts(data);
		if(posts && posts != '') {
			var $obj = $(posts);
			$obj.find('span.twi_message').each(function() {
				var message = $(this).html().replace(/(ftp|http|https|file):\/\/[\S]+(\b|$)/gim,'<a href="$&" class="my_link" target="_blank">$&</a>');
				$(this).html(message);
			});
			$obj.addClass('staged').prependTo($feed);
			CPB.twitter.onLoad();
			var offset = $obj.outerHeight();
			$feed.css({
				top: -1*offset
			});
			$obj.removeClass('staged');
			$feed.animate({
				top: 0
			}, 250);
		}
	}
};

CPB.twitter.view.paginate = function(data) {
	if(data.length > 0) {
		var posts = CPB.twitter.view.partial.posts(data);
		if(posts && posts != '') {
			$('#Twitter #twitter_feed').append($(posts));
				CPB.twitter.onLoad();
			$('#Twitter .MediaContainer div:first').animate({
				height: $('#Twitter #twitter_feed').outerHeight()
			}, 500);
		}
	}
};

CPB.twitter.view.reload = function(data) {
	if(CPB.progressiveEnhance) {
		var $container = $('#Twitter .MediaContainer');
		$('div:first', $container).animate({
			height: '865px'
		}, 400);
		$('#Twitter #twitter_feed').animate({
			top: '866px'
		}, 400, 'swing', function() {
			var $this = $(this);
			$this.html(CPB.twitter.view.partial.posts(data)).css({
				top: -1 * $this.outerHeight()
			}).animate({
				top: 0
			}, 400);
		});
	} else {
		var $container = $('#Twitter .MediaContainer');
		$('div:first', $container).css({
			height: '865px'
		});
		$('#Twitter #twitter_feed').html(CPB.twitter.view.partial.posts(data));
		$('#Twitter #twitter_feed .twi_message').each(function() {
			var message = $(this).html().replace(/(ftp|http|https|file):\/\/[\S]+(\b|$)/gim,'<a href="$&" class="my_link" target="_blank">$&</a>');
			$(this).html(message);
		});
	}
	CPB.twitter.onLoad();
};

CPB.twitter.view.partial.posts = function(data) {
	var	duplicate = false,
			posts = '',
			dateTile = '',
			latestId = $('#Twitter #twitter_feed li:first').attr('id') || "-999999999";
			latestId = latestId.replace('twitter_','');
	for(var date in data) {
		if(date != 0) {
			posts += CPB.twitter.view.partial.date(data[date].date);
		}
		for(var post in data[date].posts) {
			if(data[date].posts[post].id == latestId) {
				duplicate = true;
				break;
			}
			posts += CPB.twitter.view.partial.post(data[date].posts[post]);
		}
		if(duplicate) {
			break;
		}
	}
	return posts;
};

CPB.twitter.view.partial.date = function(data) {
	var date =	'<li class="date">' +
							'<p class="' + window.location.hash.slice(2) + '">' +
							'<span class="date date_{date}">{date}</span>' +
							'<span class="month month_{month_abbr}">{month}</span>' +
							'<span class="year year_{year}">{year}</span>' +
							'<span class="day_of_week day_{day_abbr}">{day}</span>' +
							'</p>' +
							'</li>';
	date = date.replace(/\{[^\}]*\}/g, function(key) {
		return CPB.tokenize(key, data);
	});
	return date;
};

CPB.twitter.view.partial.post = function(data) {
	var post =	'<li class="{topic}" id="twitter_{id}">' +
							'<p>'+
							'<span class="twi_icon_overlay"></span>'+
							'<img src="{user.profile_image_url}" alt="{user.name}" />'+
							'<a href="http://www.twitter.com/{user.screen_name}" class="twi_username" rel="NewWindow">{user.name}</a> <abbr>{created_at}</abbr>'+
							'<span class="twi_message">{text}</span>'+
							'</p>'+
							'</li>';
	post = post.replace(/\{[^\}]*\}/g, function(key) {
		return CPB.tokenize(key, data);
	});
	return post;
};