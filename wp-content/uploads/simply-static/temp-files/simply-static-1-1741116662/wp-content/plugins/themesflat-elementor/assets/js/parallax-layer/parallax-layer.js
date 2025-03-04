;(function ($) {

    "use strict";

    var parallax_layer = function ($scope) {


        var parallax = $scope.find('[data-tilt]');
        if (parallax.length > 0) {
            var max = parallax.data('tilt-max');
            VanillaTilt.init(document.querySelectorAll("[data-tilt]"));
        }
    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/tf-parallax-layer.default', parallax_layer);
    });

})(jQuery);