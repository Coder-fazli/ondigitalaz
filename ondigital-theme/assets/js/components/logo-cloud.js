(function () {
    var track = document.querySelector('.logo-marquee-track');
    if (!track) return;

    // Hide client-box items where the visible image fails to load
    track.querySelectorAll('.client-box img').forEach(function (img) {
        img.addEventListener('error', function () {
            img.style.display = 'none';
            // If all imgs in this box are hidden, hide the box
            var box = img.closest('.client-box');
            if (box && Array.from(box.querySelectorAll('img')).every(function (i) { return i.style.display === 'none'; })) {
                box.style.display = 'none';
            }
        });
    });

    var BASE_DURATION  = 35;   // seconds — normal speed
    var HOVER_DURATION = 90;   // seconds — slowed speed on hover
    var current = BASE_DURATION;
    var target  = BASE_DURATION;
    var raf     = null;

    function lerp(a, b, t) { return a + (b - a) * t; }

    function tick() {
        current = lerp(current, target, 0.06);
        track.style.animationDuration = current.toFixed(3) + 's';

        if (Math.abs(current - target) > 0.01) {
            raf = requestAnimationFrame(tick);
        } else {
            current = target;
            track.style.animationDuration = current + 's';
            raf = null;
        }
    }

    function startLerp() {
        if (raf) cancelAnimationFrame(raf);
        raf = requestAnimationFrame(tick);
    }

    track.addEventListener('mouseenter', function () {
        target = HOVER_DURATION;
        startLerp();
    });

    track.addEventListener('mouseleave', function () {
        target = BASE_DURATION;
        startLerp();
    });
})();
