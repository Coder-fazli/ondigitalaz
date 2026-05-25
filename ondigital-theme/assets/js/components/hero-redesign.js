/**
 * Hero Redesign — count-up animation
 */
(function () {
    'use strict';

    var counters = document.querySelectorAll('.ond-count');
    if (!counters.length) return;

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            var el = entry.target;
            var target = +el.getAttribute('data-target');
            var duration = 1600;
            var step = target / (duration / 16);
            var current = 0;

            var timer = setInterval(function () {
                current += step;
                if (current >= target) {
                    el.textContent = target;
                    clearInterval(timer);
                } else {
                    el.textContent = Math.floor(current);
                }
            }, 16);

            observer.unobserve(el);
        });
    }, { threshold: 0.5 });

    counters.forEach(function (c) { observer.observe(c); });
})();
