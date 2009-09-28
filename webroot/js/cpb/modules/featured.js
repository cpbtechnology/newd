// This file is part of Newd.
// 
// Newd is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
// 
// Newd is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with Newd.  If not, see <http://www.gnu.org/licenses/>.
// 
// Copyright 2009, Crispin Porter + Bogusky

CPB.featured = new CPB.localModule('featured', {
	paginateNextBindPoint: '#Featured ul.Pagination li.Next a',
	paginatePreviousBindPoint: '#Featured ul.Pagination li.Previous a'
});

CPB.featured.view.paginate = function(data) {
	var	$obj = $('#Featured .MediaContainer ul'),
			distance = data.direction * CPB.featured.settings.height;
	CPB.media.paginate($obj.parent(), $obj, CPB.featured.paginateNextBindPoint, CPB.featured.paginatePreviousBindPoint, data.direction, distance, CPB.featured.settings.visible, CPB.featured.settings.height, CPB.featured.settings.offset);
};

CPB.featured.view.reload = function(data) {
	CPB.media.reload(CPB.featured.view.partial.entries(data.posts), '#Featured div.MediaContainer', '#Featured div.MediaContainer ul', CPB.featured.paginateNextBindPoint, CPB.featured.paginatePreviousBindPoint, CPB.featured.settings.visible, CPB.featured.settings.height, CPB.featured.settings.offset, function() {
		if($('#Featured div.MediaContainer ul li').size() <= CPB.featured.settings.visible) {
			$('#Featured .Pagination a').addClass('disabled');
		} else {
			$('#Featured .Pagination .Next a').removeClass('disabled');
		}
	});
};

CPB.featured.view.partial.entries = function(data) {
	var entries = '';
	for(var i in data) {
		var entry =	'<li class="{topic}">' +
								'<a href="{location}" class="{ title: \'{title}\' }" rel="NewWindow" title="{title}">' +
								'<img src="{image_url}" alt="{title}" />' +
								'<span class="overlay"></span>' +
								'</a>' +
								'</li>';
		entries += entry.replace(/\{[^\}|^\s]*\}/g, function(key) {
			return CPB.tokenize(key, data[i], true);
		});
	}
	return entries;
};

CPB.featured.settings = {
	visible: 9,
	height: 252,
	offset: 7
};
