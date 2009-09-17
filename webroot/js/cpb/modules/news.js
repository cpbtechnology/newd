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

CPB.news = new CPB.remoteModule('articles', {
	selector: '#News',
	paginateBindPoint: '#News p.Pagination a',
	autoUpdate: true,
	autoUpdateInterval: 240000,
	loader: '#News p.Pagination span.loader',
	callback: function() {
		$('#News .MediaContainer ul li').live('click', function() {
			$(this).find('a').trigger('click');
		});
	}
});

CPB.news.view.update = function(data) {
	if(data.length > 0) {
		var $feed = $('#News #news_feed');
		var posts = CPB.news.view.partial.posts(data);
		if(posts && posts != '') {
			var $obj = $(posts);
			$obj.addClass('staged').prependTo($feed);
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

CPB.news.view.paginate = function(data) {
	if(data.length > 0) {
		var posts = CPB.news.view.partial.posts(data);
		if(posts && posts != '') {
			$('#News #news_feed').append($(posts));
			$('#News .MediaContainer div:first').animate({
				height: $('#News #news_feed').outerHeight()
			}, 500);
		}
	}
};

CPB.news.view.reload = function(data) {
	if(CPB.progressiveEnhance) {
		var $container = $('#News .MediaContainer');
		$('div:first', $container).animate({
			height: '865px'
		}, 400);
		$('#News #news_feed').animate({
			top: '1055px'
		}, 400, 'swing', function() {
			var $this = $(this);
			$this.html(CPB.news.view.partial.posts(data)).css({
				top: -1 * $this.outerHeight()
			}).animate({
				top: 0
			}, 400);
		});
	} else {
		var $container = $('#News .MediaContainer');
		$('div:first', $container).css({
			height: '865px'
		});
		$('#News #news_feed').html(CPB.news.view.partial.posts(data));	
	}
};

CPB.news.view.partial.posts = function(data) {
	var	duplicate = false,
			posts = '',
			dateTile = '',
			latestId = $('#News #news_feed li:first').attr('id') || "-9999999";
			latestId = latestId.replace('news_','');
	for(var date in data) {		
		if(date != 0) {
			posts += CPB.news.view.partial.date(data[date].date);
		}
		for(var post in data[date].posts) {
			if(data[date].posts[post].id == latestId) {
				duplicate = true;
				break;
			}
			posts += CPB.news.view.partial.post(data[date].posts[post]);
		}
		if(duplicate) {
			break;
		}
	}
	return posts;
};

CPB.news.view.partial.date = function(data) {
	var date =	'<li class="date">' +
							'<p class="' + window.location.hash.slice(1) + '">' +
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

CPB.news.view.partial.post = function(data) {
	var post =	'<li class="{topic}" id="news_{id}">' +
							'<p>' +
							'<a href="{location}" rel="NewWindow">{title}</a> ' +
							'<abbr>{created_at} - by {source.name}</abbr>' +
							'</p>' +
							'</li>';
	post = post.replace(/\{[^\}]*\}/g, function(key) {
		return CPB.tokenize(key, data);
	});
	return post;
};