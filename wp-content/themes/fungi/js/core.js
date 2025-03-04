(function ($) {
    "use strict";
    var CORE = {
        init: function () {
        },
    };

    CORE.headerSticky = {
        scroll_offset_before: 0,
        init: function () {
            this.setSticky();
            this.resize();
            this.scroll();
            this.processSticky();
            this.resetHeight();
        },
        setSticky: function () {
            if ($('body').hasClass('header_sticky')) {
                $('#header .inner-header').each(function () {
                    var $this = $(this);
                    if (!$this.is(':visible')) {
                        return;
                    }
                    if (!$this.parent().hasClass('sticky-area-wrap')) {
                        $this.wrap('<div class="sticky-area-wrap"></div>');
                    }
                    var $wrap = $this.parent();
                    var $nav_dashbard = $('.dashboard-nav');
                    $wrap.height($this.outerHeight());
                    if (window.matchMedia('(max-width: 1199px)').matches) {
                        $nav_dashbard.addClass('header-sticky-smart');
                    } else {
                        $nav_dashbard.removeClass('header-sticky-smart');
                    }
                });
            }
        },

        resize: function () {
            $(window).resize(function () {
                CORE.headerSticky.setSticky();
                CORE.headerSticky.processSticky();
            });
        },
        processSticky: function () {
            if ($('body').hasClass('header_sticky')) {
                var current_scroll_top = $(window).scrollTop();
                var $parent = $('.main-header');
                var is_dark = false;
                if ($parent.hasClass('navbar-dark') && !$parent.hasClass('bg-secondary')) {
                    is_dark = true;
                }
                $('#header .inner-header').each(function () {
                    var $this = $(this);
                    if (!$this.is(':visible')) {
                        return;
                    }

                    var $wrap = $this.parent(),
                        sticky_top = 0,
                        sticky_current_top = $wrap.offset().top;

                    if ($('#wpadminbar').length) {
                        sticky_top += parseInt($('#wpadminbar').height());
                    }

                    if (sticky_current_top - sticky_top < current_scroll_top) {
                        $this.css('position', 'fixed');
                        $this.css('top', sticky_top + 'px');
                        $wrap.addClass('sticky');
                        if (is_dark) {
                            $parent.removeClass('navbar-dark');
                            $parent.addClass('navbar-light');
                            $parent.addClass('navbar-light-sticky');
                        }

                    } else {
                        if ($parent.hasClass('navbar-light-sticky')) {
                            $parent.addClass('navbar-dark');
                            $parent.removeClass('navbar-light');
                            $parent.removeClass('navbar-light-sticky');
                        }
                        if ($wrap.hasClass('sticky')) {
                            $this.css('position', '').css('top', '');
                            $wrap.removeClass('sticky');
                        }
                    }

                });

                if ($('body').hasClass('header-show-on-scroll-up')) {
                    CORE.headerSticky.headerStickyMode();
                }
            }
        },


        headerStickyMode: function () {
            var current_scroll_top = $(window).scrollTop();
            if (CORE.headerSticky.scroll_offset_before > current_scroll_top) {
                $('.sticky-area-wrap .inner-header').each(function () {
                    if ($(this).hasClass('header-hidden')) {
                        $(this).removeClass('header-hidden');
                        $(this).parent().height($(this).outerHeight());
                    }
                });
            } else {
                // down
                $('.sticky-area-wrap .inner-header').each(function () {
                    var $wrCOREer = $(this).parent();
                    if ($wrCOREer.length) {
                        if ((CORE.headerSticky.scroll_offset_before > ($wrCOREer.offset().top + $(this).outerHeight())) && !$(this).hasClass('header-hidden')) {
                            $(this).addClass('header-hidden');
                        }
                    }

                });
            }
            CORE.headerSticky.scroll_offset_before = current_scroll_top;
        },

        scroll: function () {
            $(window).on('scroll', function () {
                CORE.headerSticky.processSticky();
            });
        },
        resetHeight: function () {
            CORE.headerSticky.scroll_offset_before = 0;
            $('#header .inner-header').each(function () {
                var $this = $(this),
                    $wrap = $this.parent();
                var Height = $this.outerHeight();
                $(window).on('scroll', function () {
                    var current_scroll_top = $(window).scrollTop();
                    if (current_scroll_top === 0) {
                        $wrap.height(Height);
                    }
                });
                $(window).resize(function () {
                    Height = $this.outerHeight();
                    $wrap.height(Height);
                });
            });
        },
    };
    CORE.scrollSpy = {
        init: function () {
            this.scrollSpyLanding();
        },
        scrollSpyLanding: function () {
            var is_onePage = $("body.is_one_page");
            if (!is_onePage.length) {
                return;
            }

            var $menu = $("#mainnav");
            var topMenuHeight = $menu.outerHeight() + 50;
            CORE.scrollSpy.menuScroll($menu, topMenuHeight);
        },
        menuScroll: function (element, offset) {
            // Declare all global variables
            var topMenu = element;
            var topOffset = offset ? offset : 0;
            var menuItems = $(topMenu).find("a");
            var lastId;

            // Save all menu items into scrollItems array
            var scrollItems = $(menuItems).map(function () {
                var item = $($(this).attr("href"));
                if (item.length) {
                    return item;
                }
            });

            // When the menu item is clicked, get the #id from the href value, then scroll to the #id element
            $('a[href*=#]:not([href=#])').click(function () {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html, body').animate({
                            scrollTop: target.offset().top
                        }, 0);
                        return false;
                    }
                }
            });

            // When page is scrolled
            $(window).scroll(function () {
                var nm = $("html").scrollTop();
                var nw = $("body").scrollTop();
                var fromTop = (nm > nw ? nm : nw) + topOffset;


                // When the page pass one #id section, return all passed sections to scrollItems and save them into new array current
                var current = $(scrollItems).map(function () {
                    if ($(this).offset().top <= fromTop)
                        return this;
                });

                // Get the most recent passed section from current array
                current = current[current.length - 1];
                var id = current && current.length ? current[0].id : "";
                if (lastId !== id) {
                    lastId = id;
                    // Set/remove active class
                    $(menuItems)
                        .parent().removeClass("active")
                        .end().filter("[href='#" + id + "']").parent().addClass("active");
                }

            });
        }

    };


    $(document).ready(function () {
        CORE.init();
        CORE.headerSticky.init();
        CORE.scrollSpy.init();
    });
})(jQuery);
