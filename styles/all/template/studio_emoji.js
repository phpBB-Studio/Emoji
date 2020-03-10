(function($) {  // Avoid conflicts with other libraries

'use strict';

let studio = {
	enter: 13,
	search: $('#emoji_search'),
	result: $('#emoji_search_result'),
	panels: $('#emoji a[data-subpanel]'),
	init: function() {
		studio.getData();
		studio.bindSearch();

		studio.panels.on('click', studio.lazyLoad);
		$('#emoji_toggle, #abbc3_emoji_toggle').on('click', studio.lazyLoad);

		studio.result.empty = studio.result.find('> .error');
	},
	lazyLoad: function() {
		let panel = $(this).data('subpanel') || studio.panels.first().data('subpanel');

		if (panel === 'emoji-search-panel') {

			setTimeout(function() {
				studio.search.focus();
			}, 0);
		} else {
			$(`#${panel} img[data-src]`).each(function() {
				$(this).attr('src', $(this).data('src')).removeAttr('data-src');
			});
		}
	},
	getData: function() {
		let $data = $('#studio_emoji').find('> :first-child');

		this.emoji = $.parseJSON($data.text());
		this.ext = $data.data('ext');
		this.cdn = $data.data('cdn');

		$data.remove();
	},
	bindSearch: function() {
		studio.search.on('keydown', function(e) {
			if (e.keyCode === studio.enter) {
				e.preventDefault();

				return false;
			}
		});

		studio.search.on('keyup', function() {


			let search = $(this).val().replace(' ', '_').toLowerCase();

			studio.clearResult();

			if (search.length > 2) {
				$.each(studio.emoji, function(name, src) {
					if (name.indexOf(search) > -1) {
						studio.result.append(studio.createImg(name, src))
					}
				});
			}

			studio.checkEmpty();
		});
	},
	createImg: function(name, src) {
		return `<a href="#" onclick="insert_text('${name}', true); return false;"><img class="emoji smilies" src="${studio.cdn + src + studio.ext}" alt="${name}" title="${name}" /></a>`;
	},
	clearResult: function() {
		studio.result.children().not(studio.result.empty).remove();
	},
	checkEmpty: function() {
		studio.result.empty.toggle(studio.result.empty.is(':only-child'));
	},
};

$(function() {
	studio.init();
});

})(jQuery); // Avoid conflicts with other libraries
