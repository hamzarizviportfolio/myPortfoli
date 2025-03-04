;(function ($) {

    "use strict";

    var animation_layer = function ($scope) {
        var wrapper = $scope.find('.tf-animation-layer');
        if (wrapper.hasClass('tf-animation-layer-type-ball-random')) {

            const colors = ["#d20962", "#0ebeff", "#7ac143", "#00a78e", "#00bce4", "8e43e7", "005be2"];
            var numBalls = 30;
            const hWrapper = wrapper.height();
            const wWrapper = wrapper.width();
            const balls = [];

            if (wrapper.data('ballnumber') !== undefined) {
                numBalls = wrapper.data('ballnumber')
            }

            for (let i = 0; i < numBalls; i++) {
                let ball = document.createElement("div");
                ball.classList.add("ball");
                ball.style.background = colors[Math.floor(Math.random() * colors.length)];
                ball.style.left = `${Math.floor(Math.random() * wWrapper)}px`;
                ball.style.top = `${Math.floor(Math.random() * hWrapper)}px`;
                ball.style.transform = `scale(${Math.random()})`;
                ball.style.width = `${Math.random()}em`;
                ball.style.height = ball.style.width;

                balls.push(ball);
                wrapper.find('.tf-animation-layer-inner').append(ball);
            }


            // Keyframes
            balls.forEach((el, i, ra) => {
                let to = {
                    x: Math.random() * (i % 2 === 0 ? -11 : 11),
                    y: Math.random() * 12
                };
                let anim = el.animate(
                    [
                        {transform: "translate(0, 0)"},
                        {transform: `translate(${to.x}rem, ${to.y}rem)`}
                    ],
                    {
                        duration: (Math.random() + 1) * 2000, // random duration
                        direction: "alternate",
                        fill: "both",
                        iterations: Infinity,
                        easing: "ease-in-out"
                    }
                );
            });
        }
        if (wrapper.hasClass('tf-animation-layer-type-image')) {
            wrapper.find(".glitch-img").mgGlitch();
        }
        if (wrapper.hasClass('tf-animation-layer-type-particles')) {
            var particlesNumber = 150,
                particlesColor = '#fff',
                particlesSpeed = 6;

            if (wrapper.data('particlesnumber') !== undefined) {
                particlesNumber = wrapper.data('particlesnumber')
            }

            if (wrapper.data('particlescolor') !== undefined) {
                particlesColor = wrapper.data('particlescolor')
            }

            console.log(particlesColor);

            if (wrapper.data('particlesspeed') !== undefined) {
                particlesSpeed = wrapper.data('particlesspeed')
            }

            particlesJS("particles-js", {
                "particles": {
                    "number": {
                        "value": particlesNumber,
                        "density": {
                            "enable": true,
                            "value_area": 1000
                        }
                    },
                    "color": {
                        "value": particlesColor
                    },

                    "opacity": {
                        "value": 0.5,
                        "random": false,
                        "anim": {
                            "enable": false,
                            "speed": 1,
                            "opacity_min": 0.1,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 3,
                        "random": true,
                        "anim": {
                            "enable": false,
                            "speed": 40,
                            "size_min": 0.1,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": particlesColor,
                        "opacity": 0.4,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": particlesSpeed,
                        "direction": "none",
                        "random": false,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false,
                        "attract": {
                            "enable": false,
                            "rotateX": 600,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "grab"
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 140,
                            "line_linked": {
                                "opacity": 1
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                        },
                        "repulse": {
                            "distance": 200,
                            "duration": 0.4
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": true
            });
        }

    };
    

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/tf-animation-layer.default', animation_layer);
    });

})(jQuery);

