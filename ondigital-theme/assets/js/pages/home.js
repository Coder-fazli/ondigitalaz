/**
 * OnDigital - Home Page JS
 * Swiper slider initializations for the homepage
 */

(function ($) {
    "use strict";

    $(document).ready(function () {

        // Services slider
        if (document.querySelector('#services-slider')) {
            new Swiper("#services-slider", {
                loop: false,
                slidesPerView: 1,
                spaceBetween: 30,
                speed: 800,
                pagination: {
                    el: ".services-pagination",
                    clickable: true,
                },
                breakpoints: {
                    576: { slidesPerView: 2 },
                    992: { slidesPerView: 3 },
                    1200: { slidesPerView: 4 },
                }
            });
        }

        // Client logos auto-scroll slider
        if (document.querySelector('.client-slider-active')) {
            new Swiper(".client-slider-active", {
                slidesPerView: 'auto',
                loop: true,
                autoplay: {
                    delay: 1,
                },
                spaceBetween: 110,
                speed: 3000,
            });
        }

        // Project carousel slider
        if (document.querySelector('.project-slider')) {
            new Swiper(".project-slider", {
                loop: false,
                slidesPerView: 1,
                spaceBetween: 40,
                speed: 1800,
                watchSlidesProgress: true,
                navigation: {
                    prevEl: ".project-button-prev",
                    nextEl: ".project-button-next",
                },
                breakpoints: {
                    576: { slidesPerView: 1 },
                    768: { slidesPerView: 2 },
                    992: { slidesPerView: 3 },
                    1201: { slidesPerView: 3 },
                    1367: { slidesPerView: 4 },
                }
            });
        }

        // Testimonial slider
        if (document.querySelector('.testimonial-slider')) {
            new Swiper(".testimonial-slider", {
                loop: false,
                slidesPerView: 1,
                spaceBetween: 60,
                speed: 1800,
                watchSlidesProgress: true,
                navigation: {
                    prevEl: ".testimonial-button-prev",
                    nextEl: ".testimonial-button-next",
                },
            });
        }

        // Text marquee slider
        if (document.querySelector('.text-slider-active')) {
            new Swiper(".text-slider-active", {
                slidesPerView: 'auto',
                loop: true,
                autoplay: {
                    delay: 1,
                },
                spaceBetween: 30,
                speed: 10000,
            });
        }

    });

})(jQuery);
