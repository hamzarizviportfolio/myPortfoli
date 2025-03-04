;(function ($) {

	"use strict";

	var parallax_layer = function ($scope) {
		var $icon_box = document.querySelector(".tficonbox .content-wrapper");
		if ($icon_box.classList.contains('hover-style-02')) {
			VanillaTilt.init($icon_box, {});
		}

	};

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/tficonbox.default', parallax_layer);
	});

})(jQuery);

