/*jslint browser: true*/
/*global $, jQuery*/

$(function() {
	"use strict";

	function equalheight(container) {

		var currentTallest = 0,
			currentRowStart = 0,
			rowDivs = [],
			$el,
			topPosition = 0,
			currentDiv;

		$(container).each(function() {

			$el = $(this);
			$($el).height('auto');
			topPosition = $el.position().top;

			if (currentRowStart != topPosition) {
				for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
					rowDivs[currentDiv].height(currentTallest);
				}
				rowDivs.length = 0; // empty the array
				currentRowStart = topPosition;
				currentTallest = $el.height();
				rowDivs.push($el);
			} else {
				rowDivs.push($el);
				currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
			}
			for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
				rowDivs[currentDiv].height(currentTallest);
			}
		});
	}

	function attachEvents() {
		$(window).load(function() {
			equalheight('.panel');
		});

		$(window).resize(function(){
			equalheight('.panel');
		});
	}

	function init() {
		attachEvents();
	}


	init();

});
