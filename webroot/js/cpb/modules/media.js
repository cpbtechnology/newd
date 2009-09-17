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

CPB.media = {
	paginate: function(container, slidingPane, next, previous, direction, distance, visible, height, offset) {
		var	deltaOffset,
				$previous = $(previous),
				$next = $(next),
				$slidingPane = $(slidingPane),
				currentOffset = Math.abs(parseInt($slidingPane.css('top'), 10)),
				height = $slidingPane.outerHeight(true),
				$container = $(container);
		
		if(!$next.hasClass('disabled') && direction == 1 || !$previous.hasClass('disabled') && direction == -1) {
			if(height < currentOffset + (2*distance) && direction == 1) {
				distance = height - (currentOffset + offset) - distance;
				$next.addClass('disabled');
			} else if (Math.abs(distance) > currentOffset && direction == -1) {
				distance = (-1 * currentOffset) - offset;
				$previous.addClass('disabled');
			}
			if(direction == 1) {
				$previous.removeClass('disabled');
			} else if(direction == -1) {
				$next.removeClass('disabled');
			}
			$slidingPane.animate({
				top: '-=' + distance + 'px'
			}, 100, 'swing', function() {
			});
		}
		
	},
	reload: function(html, container, slidingPane, next, previous, visible, height, offset, callback) {
		if(CPB.progressiveEnhance) {
			$(slidingPane).animate({
				top: '255px'
			}, 400, 'swing', function() {
				$(this).html(html);
				$(this).css({
					top: -1 * $(this).outerHeight()
				}).animate({
					top: 7
				}, 400, 'swing');
			});			
		} else {
			$(slidingPane).html(html);
			if(typeof(callback) == 'function') {
				callback();
			}
		}
			
	}
};
