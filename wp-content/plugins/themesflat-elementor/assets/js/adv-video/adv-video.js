;(function ($) {

    "use strict";

    var advVideo = function ($scope, $) {
        var owl_carousel = $scope.find(".tf-adv-video-main");
        var owl_dot = $scope.find(".tf-adv-video-dot");
        var option = {};
        var options_default = {
            slidesToScroll: 1,
            slidesToShow: 1,
            adaptiveHeight: false,
            arrows: false,
            dots: false,
            autoplay: false,
            autoplaySpeed: 3000,
            infinite: false,
            fade: false,
            draggable: true,
            focusOnSelect: true,
            responsive: [],
            rtl: false,
            speed: 300,
            asNavFor: owl_dot,
            customPaging: function (slider, i) {
                return $('<span class=""></span>');
            }
        };
        if (owl_carousel.length > 0) {
            owl_carousel.each(function () {
                var $this = $(this);
                option = $this.data('slick-options');
                option = $.extend({}, options_default, option);

                $(this).slick(option);
            });
        }

        if (owl_dot.length > 0) {

            var dot_options_default = {
                slidesToScroll: 1,
                slidesToShow: 5,
                adaptiveHeight: false,
                arrows: false,
                dots: false,
                autoplaySpeed: 3000,
                speed: 300,
                asNavFor: owl_carousel,
                focusOnSelect: true,
            };

            owl_dot.each(function () {
                var $this = $(this);
                option = $this.data('dot-options');
                option = $.extend({}, dot_options_default, option);

                $(this).slick(option);
            });
        }
    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tf_adv_video_popup.default', advVideo );

    });

})(jQuery);
