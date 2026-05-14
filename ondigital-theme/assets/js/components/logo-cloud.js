(function () {
    var tracks = document.querySelectorAll('.logo-marquee-track');
    if (!tracks.length) return;

    var SPEED       = 0.7;
    var SPEED_HOVER = 0.15;
    var targetSpeed = SPEED;

    function initTrack(track) {
        var direction = track.getAttribute('data-direction') === 'right' ? 1 : -1;

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

        // Clone until 3× viewport
        var origBoxes = Array.from(track.querySelectorAll('.client-box'));
        while (track.scrollWidth < window.innerWidth * 3) {
            origBoxes.forEach(function (box) {
                track.appendChild(box.cloneNode(true));
            });
        }

        // Measure original set width
        var GAP = 64;
        var origSetWidth = origBoxes.reduce(function (sum, box) {
            return sum + box.offsetWidth + GAP;
        }, 0);

        // Right-direction tracks start at -origSetWidth so they scroll right
        var pos = direction === 1 ? -origSetWidth : 0;
        var currentSpeed = SPEED;

        function animate() {
            currentSpeed += (targetSpeed - currentSpeed) * 0.05;
            pos += direction * currentSpeed;

            if (direction === -1 && pos <= -origSetWidth) pos += origSetWidth;
            if (direction === 1  && pos >= 0)             pos -= origSetWidth;

            track.style.transform = 'translateX(' + pos + 'px)';
            requestAnimationFrame(animate);
        }

        animate();
    }

    function init() {
        tracks.forEach(initTrack);

        // Shared hover — slow both tracks together
        var slider = document.querySelector('.client-slider');
        if (slider) {
            slider.addEventListener('mouseenter', function () { targetSpeed = SPEED_HOVER; });
            slider.addEventListener('mouseleave', function () { targetSpeed = SPEED; });
        }
    }

    if (document.readyState === 'complete') {
        init();
    } else {
        window.addEventListener('load', init);
    }
})();
