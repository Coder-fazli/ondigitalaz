(function () {
    'use strict';

    var THANK_YOU_URL = window.odFormRedirect && window.odFormRedirect.thankYouUrl
        ? window.odFormRedirect.thankYouUrl
        : '/thank-you/';

    // Watch for active trigger to capture service context
    var pendingService = '';
    document.addEventListener('click', function (e) {
        var trigger = e.target.closest('[data-od-form]');
        if (!trigger) return;
        pendingService = trigger.getAttribute('data-od-service') || '';
    });

    // Watch popup form success — redirect instead of closing after 2.8s
    var observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (m) {
            if (m.type !== 'attributes' && m.type !== 'childList') return;
            var successWrap = document.querySelector('#odf-overlay .odf-success-wrap');
            if (!successWrap) return;
            if (successWrap.style.display !== 'none' && successWrap.style.display !== '') {
                var url = THANK_YOU_URL;
                if (pendingService) url += '?xidmet=' + encodeURIComponent(pendingService);
                setTimeout(function () {
                    window.location.href = url;
                }, 1500);
            }
        });
    });

    // Start observing once DOM ready
    document.addEventListener('DOMContentLoaded', function () {
        var overlay = document.getElementById('odf-overlay');
        if (overlay) {
            observer.observe(overlay, { attributes: true, childList: true, subtree: true });
        }

        // Also handle inline forms (contact page, service page) — redirect on success
        document.addEventListener('submit', function (e) {
            var form = e.target;
            if (!form.matches('#odf-cp-form, #odf-sp-form, #odf-ap-form')) return;

            // Wait for success element to appear then redirect
            var checkInterval = setInterval(function () {
                var wrap = form.closest('[class*="odf-"]');
                if (!wrap) { clearInterval(checkInterval); return; }
                var success = wrap.querySelector('[class*="-success"]');
                if (success && success.style.display !== 'none' && success.style.display !== '') {
                    clearInterval(checkInterval);
                    var service = form.querySelector('[name="odf_service"]');
                    var url = THANK_YOU_URL;
                    if (service && service.value) url += '?xidmet=' + encodeURIComponent(service.value);
                    setTimeout(function () {
                        window.location.href = url;
                    }, 1500);
                }
            }, 200);

            // Stop checking after 10s
            setTimeout(function () { clearInterval(checkInterval); }, 10000);
        }, true);
    });
})();
