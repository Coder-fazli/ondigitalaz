/**
 * About Page - Swiper Initializations
 */
(function ($) {
    'use strict';
    $(document).ready(function () {
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
