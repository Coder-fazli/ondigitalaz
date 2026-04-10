/**
 * Project Details Template — JS
 * Handles: scroll-fade, animated counters
 */
(function () {
    'use strict';

    // ── Scroll-fade ──
    var fadeObs = new IntersectionObserver(
        function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('cs-in');
                    fadeObs.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.1, rootMargin: '0px 0px -24px 0px' }
    );
    document.querySelectorAll('.cs-wrap .cs-fade').forEach(function (el) {
        fadeObs.observe(el);
    });

    // ── Counter animation ──
    function runCounter(el) {
        var target   = parseInt(el.dataset.target, 10);
        var duration = 1600;
        var start    = performance.now();
        function frame(now) {
            var progress = Math.min((now - start) / duration, 1);
            var eased    = 1 - Math.pow(1 - progress, 4);
            el.textContent = Math.round(eased * target);
            if (progress < 1) {
                requestAnimationFrame(frame);
            } else {
                el.textContent = target;
            }
        }
        requestAnimationFrame(frame);
    }

    var counterObs = new IntersectionObserver(
        function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    runCounter(entry.target);
                    counterObs.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.5 }
    );
    document.querySelectorAll('.cs-wrap .cs-counter').forEach(function (el) {
        counterObs.observe(el);
    });
})();
