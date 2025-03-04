;(function ($) {

    "use strict";

    var tf_fancy_text = function ($scope) {
        var wrapper = $scope.find('.tf-fancy-text');
        if (wrapper.hasClass('style-01')) {
            var speed = wrapper.data('speed');
            wrapper.find('.tf-funcy-text-inner').textition({
                speed: 1,
                animation: 'ease-out',
                map: {x: 200, y: 100, z: 0},
                autoplay: true,
                interval: speed
            });
        }
        if (wrapper.hasClass('style-02')) {
            TyperSetup('tf-typer');
        }
    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/tf-fancy-text.default', tf_fancy_text);
    });

})(jQuery);