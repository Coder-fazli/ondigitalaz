/***************************************************
 * OnDigital Theme - Global JS
 ****************************************************/

(function ($) {
    "use strict";

    var device_width = window.screen.width;

    // Register GSAP Plugins first
    if (typeof gsap !== 'undefined') {
        if (typeof ScrollTrigger !== 'undefined') gsap.registerPlugin(ScrollTrigger);
        if (typeof ScrollSmoother !== 'undefined') gsap.registerPlugin(ScrollSmoother);
        if (typeof ScrollToPlugin !== 'undefined') gsap.registerPlugin(ScrollToPlugin);
        if (typeof SplitText !== 'undefined') gsap.registerPlugin(SplitText);
    }

    // =====================================================
    // INIT
    // =====================================================
    $(document).ready(function () {
        initAnimations();
        initUI();
    });

    // =====================================================
    // ANIMATIONS
    // =====================================================
    function initAnimations() {
        if (typeof gsap === 'undefined') return;

        try {
            // Text Move Animation — simplified to subtle fade-up (no 3D flip)
            var text_animation = gsap.utils.toArray(".has_text_move_anim");
            if (text_animation.length) {
                text_animation.forEach(function (el) {
                    var delay_value = parseFloat(el.getAttribute("data-delay") || 0.1);
                    gsap.from(el, {
                        opacity: 0,
                        y: 24,
                        duration: 0.65,
                        delay: delay_value,
                        ease: "power2.out",
                        scrollTrigger: { trigger: el, start: 'top 88%' }
                    });
                });
            }

            // Character Animation
            if (typeof SplitText !== 'undefined') {
                document.querySelectorAll(".has_char_anim").forEach(function (item) {
                    var stagger_value = item.getAttribute("data-stagger") || 0.05;
                    var translateX_value = item.getAttribute("data-translateX") || 20;
                    var translateY_value = item.getAttribute("data-translateY") || false;
                    var onscroll_value = item.getAttribute("data-on-scroll") !== null ? item.getAttribute("data-on-scroll") : 1;
                    var data_delay = item.getAttribute("data-delay") || 0.1;
                    var data_duration = item.getAttribute("data-duration") || 1;
                    var ease_value = item.getAttribute("data-ease") || "power2.out";

                    var charAnimSettings = { duration: data_duration, delay: data_delay, autoAlpha: 0, stagger: stagger_value, ease: ease_value };
                    if (onscroll_value == 1) {
                        charAnimSettings.scrollTrigger = { trigger: item, start: 'top 85%' };
                    }
                    var split_char = new SplitText(item, { type: "chars, words" });
                    if (translateX_value && !translateY_value) {
                        charAnimSettings.x = translateX_value;
                    } else if (translateY_value && !translateX_value) {
                        charAnimSettings.y = translateY_value;
                    } else {
                        charAnimSettings.x = 50;
                    }
                    gsap.from(split_char.chars, charAnimSettings);
                });
            }

            // Word Animation
            if (typeof SplitText !== 'undefined') {
                document.querySelectorAll(".has_word_anim").forEach(function (item) {
                    var stagger_value = item.getAttribute("data-stagger") || 0.04;
                    var translateX_value = item.getAttribute("data-translateX") || false;
                    var translateY_value = item.getAttribute("data-translateY") || false;
                    var onscroll_value = item.getAttribute("data-on-scroll") !== null ? item.getAttribute("data-on-scroll") : 1;
                    var data_delay = item.getAttribute("data-delay") || 0.1;
                    var data_duration = item.getAttribute("data-duration") || 0.75;

                    var wordAnimSettings = { duration: data_duration, delay: data_delay, autoAlpha: 0, stagger: stagger_value };
                    if (onscroll_value == 1) {
                        wordAnimSettings.scrollTrigger = { trigger: item, start: 'top 85%' };
                    }
                    var split_word = new SplitText(item, { type: "chars, words" });
                    if (translateX_value && !translateY_value) {
                        wordAnimSettings.x = translateX_value;
                    } else if (translateY_value && !translateX_value) {
                        wordAnimSettings.y = translateY_value;
                    } else {
                        wordAnimSettings.x = 20;
                    }
                    gsap.from(split_word.words, wordAnimSettings);
                });
            }

            // Fade Animation
            var fadeItems = document.querySelectorAll(".has_fade_anim");
            if (fadeItems.length > 0) {
                gsap.utils.toArray(".has_fade_anim").forEach(function (item) {
                    var fade_direction = item.getAttribute("data-fade-from") || "bottom";
                    var onscroll_value = item.getAttribute("data-on-scroll") !== null ? item.getAttribute("data-on-scroll") : 1;
                    var duration_value = item.getAttribute("data-duration") || 0.6;
                    var fade_offset = item.getAttribute("data-fade-offset") || 20;
                    var delay_value = item.getAttribute("data-delay") || 0.1;
                    var ease_value = item.getAttribute("data-ease") || "power2.out";

                    var animation_settings = {
                        opacity: 0,
                        ease: ease_value,
                        duration: duration_value,
                        delay: delay_value,
                    };

                    if (fade_direction == "top") animation_settings.y = -fade_offset;
                    if (fade_direction == "left") animation_settings.x = -fade_offset;
                    if (fade_direction == "bottom") animation_settings.y = fade_offset;
                    if (fade_direction == "right") animation_settings.x = fade_offset;

                    if (onscroll_value == 1) {
                        animation_settings.scrollTrigger = { trigger: item, start: 'top 95%' };
                        animation_settings.immediateRender = false;
                    }
                    gsap.from(item, animation_settings);
                });
            }

            // Pin sections
            var mm = gsap.matchMedia();
            mm.add("(min-width: 1024px)", function () {
                document.querySelectorAll(".section-item").forEach(function (item) {
                    gsap.to(item, {
                        scrollTrigger: {
                            trigger: item,
                            pin: true,
                            pinSpacing: false,
                            start: "bottom bottom",
                            end: "bottom -=500"
                        },
                    });
                });
            });

            // Image Reveal Animation
            document.querySelectorAll(".img_anim_reveal").forEach(function (img_reveal) {
                var image = img_reveal.querySelector("img");
                if (!image) return;
                var tl = gsap.timeline({
                    scrollTrigger: { trigger: img_reveal, start: "top 50%" }
                });
                tl.set(img_reveal, { autoAlpha: 1 });
                tl.from(img_reveal, 1.5, { xPercent: -100, ease: "power2.out" });
                tl.from(image, 1.5, { xPercent: 100, scale: 1.3, delay: -1.5, ease: "power2.out" });
            });

            // Button move parallax
            var all_btn = gsap.utils.toArray(".btn-move");
            var all_btn_circle = gsap.utils.toArray(".btn-item");
            all_btn.forEach(function (btn, i) {
                $(btn).mousemove(function (e) {
                    var $this = $(btn);
                    var relX = e.pageX - $this.offset().left;
                    var relY = e.pageY - $this.offset().top;
                    gsap.to(all_btn_circle[i], 0.3, {
                        x: ((relX - $this.width() / 2) / $this.width()) * 80,
                        y: ((relY - $this.height() / 2) / $this.height()) * 80,
                        scale: 1.2,
                        ease: "power2.out",
                    });
                });
                $(btn).mouseleave(function () {
                    gsap.to(all_btn_circle[i], 0.3, { x: 0, y: 0, scale: 1, ease: "power2.out" });
                });
            });

            // Pin Active
            var pin_fixed = document.querySelector('.pin__element');
            if (pin_fixed && device_width > 991) {
                gsap.to(".pin__element", {
                    scrollTrigger: {
                        trigger: ".pin__area",
                        pin: ".pin__element",
                        start: "top top",
                        end: "bottom bottom",
                        pinSpacing: false,
                    }
                });
            }

            var schedule_fixed = document.querySelector('.pin__elem');
            if (schedule_fixed && device_width > 991) {
                gsap.utils.toArray(".pin__elem").forEach(function (panel, i, array) {
                    if (i === array.length - 1) return;
                    ScrollTrigger.create({
                        trigger: panel,
                        start: "top top",
                        pin: true,
                        pinSpacing: false
                    });
                });
            }

        } catch (error) {
            console.warn('OnDigital: Animation init error:', error);
        }
    }

    // =====================================================
    // UI COMPONENTS
    // =====================================================
    function initUI() {
        // Sticky Header
        var header = document.querySelector('header');
        if (header) {
            window.addEventListener('scroll', function () {
                if (window.scrollY > 500) {
                    header.classList.add('sticky');
                } else {
                    header.classList.remove('sticky');
                }
            });
        }

        // Magnific Image popup
        if ($('.image-popup').length && $.fn.magnificPopup) {
            $('.image-popup').magnificPopup({
                type: "image",
                gallery: { enabled: true },
            });
        }

        // Magnific Video popup
        if ($('.video-popup').length && $.fn.magnificPopup) {
            $('.video-popup').magnificPopup({ type: 'iframe' });
        }

        // Counter
        if (typeof window.counterUp !== 'undefined') {
            var skill_counter = window.counterUp.default;
            var IO = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    var el = entry.target;
                    if (entry.isIntersecting && !el.classList.contains('is-visible')) {
                        skill_counter(el, { duration: 1500, delay: 16 });
                        el.classList.add('is-visible');
                    }
                });
            }, { threshold: 1 });
            document.querySelectorAll('.wc-counter').forEach(function (el) { IO.observe(el); });
        }

        // Meanmenu
        if ($.fn.meanmenu) {
            $('.offcanvas__menu').meanmenu({
                meanScreenWidth: "5000",
                meanMenuContainer: '.offcanvas__menu-wrapper',
                meanMenuCloseSize: '28px',
            });
            $('.main-menu').meanmenu({
                meanScreenWidth: "1199",
                meanMenuContainer: '.offcanvas__menu-wrapper',
                meanMenuCloseSize: '28px',
            });
        }

        // Button Hover Animation
        var btn_hover_all = document.querySelectorAll(".btn-hover-bgchange");
        if (btn_hover_all.length) {
            btn_hover_all.forEach(function (ele) {
                ele.appendChild(document.createElement("span"));
            });
            $('.btn-hover-bgchange').on('mouseenter mouseleave', function (e) {
                var x = e.pageX - $(this).offset().left;
                var y = e.pageY - $(this).offset().top;
                $(this).find('span').css({ top: y, left: x });
            });
        }

        // Smooth scroll to top link
        $("a[href='#top']").on('click', function () {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        });

        // Toggle Switcher
        var $scope = $('.wcf__toggle_switcher');
        if ($scope.length) {
            $("input", $scope).change(function () {
                $(".toggle-pane", $scope).toggleClass('show');
                $(".before_label, .after_label", $scope).toggleClass('active');
            });
        }

        // Back to Top progress
        try {
            var progressPath = document.querySelector(".progress-wrap path");
            if (progressPath) {
                var pathLength = progressPath.getTotalLength();
                progressPath.style.transition = progressPath.style.WebkitTransition = "none";
                progressPath.style.strokeDasharray = pathLength + " " + pathLength;
                progressPath.style.strokeDashoffset = pathLength;
                progressPath.getBoundingClientRect();
                progressPath.style.transition = progressPath.style.WebkitTransition = "stroke-dashoffset 10ms linear";
                var updateProgress = function () {
                    var scroll = $(window).scrollTop();
                    var docHeight = $(document).height() - $(window).height();
                    var progress = pathLength - scroll * pathLength / docHeight;
                    progressPath.style.strokeDashoffset = progress;
                };
                updateProgress();
                $(window).scroll(updateProgress);
                $(window).on("scroll", function () {
                    $(this).scrollTop() > 50
                        ? $(".progress-wrap").addClass("active-progress")
                        : $(".progress-wrap").removeClass("active-progress");
                });
                $(".progress-wrap").on("click", function (e) {
                    e.preventDefault();
                    $("html, body").animate({ scrollTop: 0 }, 550);
                });
            }
        } catch (err) {}
    }

})(jQuery);


// =====================================================
// OFFCANVAS 3 (global scope for onclick handlers)
// =====================================================
function showCanvas3() {
    var area = document.querySelector('.offcanvas-3__area');
    if (area) {
        area.style.visibility = 'visible';
        area.style.opacity = '1';
        area.style.left = '0';
        area.style.transform = 'none';
    }
    document.querySelector('body').style.overflow = 'hidden';
}

function hideCanvas3() {
    var area = document.querySelector('.offcanvas-3__area');
    if (area) {
        area.style.visibility = 'hidden';
        area.style.opacity = '0';
    }
    document.querySelector('body').style.overflow = 'auto';
}
