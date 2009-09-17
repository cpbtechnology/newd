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

CPB.jobs = CPB.jobs || {};

CPB.jobs.paginate = function(direction) {
	var $previous = $('#Jobs .Pagination .Previous a'),
			$next = $('#Jobs .Pagination .Next a'),
			height = $('#Jobs .MediaContainer ul').height(), 
			currentOffset = Math.abs(parseInt($('#Jobs .MediaContainer ul').css('top'), 10)), 
			offset = 7,
			distance = 134;
			
	if(height < currentOffset + offset + (2*distance) && direction == 1) {
		$next.addClass('disabled');
	} else if (Math.abs(distance) > currentOffset && direction == -1) {
		$previous.addClass('disabled');
	}
	if(direction == 1) {
		$previous.removeClass('disabled');
	} else if(direction == -1) {
		$next.removeClass('disabled');
	}
	
	$('#Jobs .MediaContainer ul').animate({
		top: '-=' + (direction * distance) + 'px'
	}, 200);
};

$(document).ready(function() {
	$("#Jobs .MediaContainer ul li").click(function() {
		var url = $(this).find('a').attr('href');
		pause();
		window.open(url);
		return false;
	});
	
	$('#Jobs .Pagination .Next a').click(function(e) {
		e.preventDefault();
		if(!$(this).hasClass('disabled')) {
			CPB.jobs.paginate(1);
		}
	});
	$('#Jobs .Pagination .Previous a').click(function(e) {
		e.preventDefault();
		if(!$(this).hasClass('disabled')) {
			CPB.jobs.paginate(-1);
		}
	});
});