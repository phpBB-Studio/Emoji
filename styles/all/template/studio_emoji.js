jQuery(function($) {
	let studio = {
		result: $('#emoji_search_result'),
		init: function() {
			studio.lazyLoad();
			studio.getData();
			studio.bindSearch();

			studio.result.empty = studio.result.find('> .error');
		},
		lazyLoad: function() {
			$('#studio_emoji img[data-src]').each(function() {
				$(this).attr('src', $(this).data('src'));
				$(this).removeAttr('data-src');
			});
		},
		getData: function() {
			let $data = $('#studio_emoji').find('> :first-child');

			this.emoji = $.parseJSON($data.text());
			this.ext = $data.data('ext');
			this.cdn = $data.data('cdn');

			$data.remove();
		},
		bindSearch: function() {
			$('#emoji_search').on('keyup', function() {
				let search = $(this).val().replace(' ', '_');

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

	$(window).on('load', studio.init);
});
