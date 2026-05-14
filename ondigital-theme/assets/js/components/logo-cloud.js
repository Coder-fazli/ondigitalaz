(function () {
    var track = document.querySelector('.logo-marquee-track');
    if (!track) return;

    var SPEED       = 0.7;  // px per frame at 60fps (normal)
    var SPEED_HOVER = 0.2;  // px per frame on hover (slow)
    var currentSpeed = SPEED;
    var targetSpeed  = SPEED;

    // Hide broken images
    track.querySelectorAll('.client-box img').forEach(function (img) {
        img.addEventListener('error', function () {
            img.style.display = 'none';
            var box = img.closest('.client-box');
            if (box) {
                var imgs = Array.from(box.querySelectorAll('img'));
                if (imgs.every(function (i) { return i.style.display === 'none'; })) {
                    box.style.display = 'none';
                }
            }
        });
    });

    function init() {
        // Measure the original set width (one set of logos)
        var origBoxes = Array.from(track.querySelectorAll('.client-box'));

        // Clone logo set until track fills at least 3× the viewport width
        // so there's always enough content in view during the loop
        var safeWidth = window.innerWidth * 3;
        while (track.scrollWidth < safeWidth) {
            origBoxes.forEach(function (box) {
                var clone = box.cloneNode(true);
                track.appendChild(clone);
            });
        }

        // Measure width of the ORIGINAL set (before clones)
        // = sum of each original box's offsetWidth + gap (64px)
        var GAP = 64;
        var origSetWidth = origBoxes.reduce(function (sum, box) {
            return sum + box.offsetWidth + GAP;
        }, 0);

        var pos = 0;

        function animate() {
            // Lerp speed
            currentSpeed += (targetSpeed - currentSpeed) * 0.05;

            pos -= currentSpeed;

            // When we've scrolled one full original set, teleport back — seamless
            if (pos <= -origSetWidth) {
                pos += origSetWidth;
            }

            track.style.transform = 'translateX(' + pos + 'px)';
            requestAnimationFrame(animate);
        }

        track.parentElement.addEventListener('mouseenter', function () {
            targetSpeed = SPEED_HOVER;
        });
        track.parentElement.addEventListener('mouseleave', function () {
            targetSpeed = SPEED;
        });

        animate();
    }

    // Run after layout so offsetWidth is accurate
    if (document.readyState === 'complete') {
        init();
    } else {
        window.addEventListener('load', init);
    }
})();
