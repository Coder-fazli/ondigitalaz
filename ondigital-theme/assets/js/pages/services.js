/**
 * Services Page - Swiper Initializations
 */
(function ($) {
    'use strict';
    $(document).ready(function () {
        if (document.querySelector('.client-slider-active')) {
            new Swiper('.client-slider-active', {
                slidesPerView: 'auto',
                loop: true,
                autoplay: {
                    delay: 1,
                },
                spaceBetween: 130,
                speed: 3000,
            });
        }

        if (document.querySelector('.testimonial-slider')) {
            new Swiper('.testimonial-slider', {
                loop: false,
                slidesPerView: 1,
                spaceBetween: 60,
                speed: 1800,
                watchSlidesProgress: true,
                navigation: {
                    prevEl: '.testimonial-button-prev',
                    nextEl: '.testimonial-button-next',
                },
            });
        }
    });
})(jQuery);
