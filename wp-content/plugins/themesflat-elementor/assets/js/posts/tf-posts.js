;(function($) {

    "use strict";

    var blogPostsOwl = function ($scope, $)  {
        var owl_carousel =$scope.find(".themesflat-posts-slider");
        var option = {};
        var options_default = {
            slidesToScroll: 1,
            slidesToShow: 1,
            adaptiveHeight: false,
            arrows: true,
            dots: true,
            autoplay: false,
            autoplaySpeed: 3000,
            centerMode: false,
            centerPadding: "50px",
            draggable: true,
            fade: false,
            focusOnSelect: true,
            infinite: false,
            pauseOnHover: false,
            responsive: [],
            rtl: false,
            speed: 300,
            asNavFor: '',
            vertical: false,
            prevArrow: '<div class="slick-prev" aria-label="Previous"><i class="fas fa-chevron-left"></i></div>',
            nextArrow: '<div class="slick-next" aria-label="Next"><i class="fas fa-chevron-right"></i></div>',
            customPaging: function (slider, i) {
                return $('<span></span>');
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
    } ;

    $(window).on('elementor/frontend/init', function() {        
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tfposts.default', blogPostsOwl );
    });

})(jQuery);
