(function () {
    'use strict';

    var THANK_YOU = (window.odFormRedirect && window.odFormRedirect.thankYouUrl)
        ? window.odFormRedirect.thankYouUrl
        : '/thank-you/';

    function redirectSuccess(service) {
        var url = THANK_YOU;
        if (service) url += '?xidmet=' + encodeURIComponent(service);
        setTimeout(function () { window.location.href = url; }, 800);
    }

    function btnLoading(btn) {
        if (!btn) return;
        btn._origHTML = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span class="odf-spinner"></span>';
        btn.style.opacity = '1';
        btn.style.minWidth = btn.offsetWidth + 'px';
    }

    function btnReset(btn) {
        if (!btn || !btn._origHTML) return;
        btn.disabled = false;
        btn.innerHTML = btn._origHTML;
        btn.style.minWidth = '';
    }

    // ── Open trigger ──────────────────────────────────────────────────────────
    var lastService = '';
    document.addEventListener('click', function (e) {
        var trigger = e.target.closest('[data-od-form]');
        if (!trigger) return;
        e.preventDefault();
        lastService = trigger.getAttribute('data-od-service') || '';

        var overlay = document.getElementById('odf-overlay');
        if (!overlay) return;
        overlay.classList.add('is-open');
        overlay.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        setTimeout(function () {
            var first = overlay.querySelector('input[type="text"], input[type="email"], input[type="tel"]');
            if (first) first.focus();
        }, 280);
    });

    // ── Close on overlay background click ────────────────────────────────────
    document.addEventListener('click', function (e) {
        if (!e.target.matches('#odf-overlay')) return;
        closeModal();
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.odf-close')) return;
        closeModal();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
    });

    function closeModal() {
        var overlay = document.getElementById('odf-overlay');
        if (!overlay) return;
        overlay.classList.remove('is-open');
        overlay.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    // ── Radio choice buttons ──────────────────────────────────────────────────
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('#odf-overlay .odf-choice-btn');
        if (!btn) return;
        var input = btn.querySelector('input[type="radio"]');
        if (!input) return;
        var overlay = document.getElementById('odf-overlay');
        var group = overlay.querySelectorAll('input[name="' + input.name + '"]');
        group.forEach(function (s) { s.checked = false; });
        input.checked = true;
    });

    // ── Contact page inline form ──────────────────────────────────────────────
    document.addEventListener('submit', function (e) {
        if (!e.target.matches('#odf-cp-form')) return;
        e.preventDefault();

        var form      = e.target;
        var errorMsg  = form.querySelector('.odf-cp-error');
        var submitBtn = form.querySelector('.odf-cp-submit');

        var data = new FormData(form);
        data.append('action', 'odf_submit');

        if (errorMsg) errorMsg.style.display = 'none';
        btnLoading(submitBtn);

        fetch(odfVars.ajaxurl, { method: 'POST', body: data })
            .then(function (r) { return r.json(); })
            .then(function (res) {
                btnReset(submitBtn);
                if (res.success) {
                    redirectSuccess('contact');
                } else {
                    var msg = (res.data && res.data.message) ? res.data.message : 'An error occurred.';
                    if (errorMsg) { errorMsg.textContent = msg; errorMsg.style.display = 'block'; }
                }
            })
            .catch(function () {
                btnReset(submitBtn);
                if (errorMsg) { errorMsg.textContent = 'Network error. Please try again.'; errorMsg.style.display = 'block'; }
            });
    });

    // ── Service page inline form ──────────────────────────────────────────────
    document.addEventListener('submit', function (e) {
        if (!e.target.matches('#odf-sp-form')) return;
        e.preventDefault();

        var form      = e.target;
        var errorMsg  = form.querySelector('.odf-sp-error');
        var submitBtn = form.querySelector('.odf-sp-submit');
        var service   = lastService || (form.querySelector('[name="odf_service"]') ? form.querySelector('[name="odf_service"]').value : '');

        var data = new FormData(form);
        data.append('action', 'odf_submit');

        if (errorMsg) errorMsg.style.display = 'none';
        btnLoading(submitBtn);

        fetch(odfVars.ajaxurl, { method: 'POST', body: data })
            .then(function (r) { return r.json(); })
            .then(function (res) {
                btnReset(submitBtn);
                if (res.success) {
                    redirectSuccess(service);
                } else {
                    var msg = (res.data && res.data.message) ? res.data.message : 'An error occurred.';
                    if (errorMsg) { errorMsg.textContent = msg; errorMsg.style.display = 'block'; }
                }
            })
            .catch(function () {
                btnReset(submitBtn);
                if (errorMsg) { errorMsg.textContent = 'Network error. Please try again.'; errorMsg.style.display = 'block'; }
            });
    });

    // ── About page inline form ────────────────────────────────────────────────
    document.addEventListener('submit', function (e) {
        if (!e.target.matches('#odf-ap-form')) return;
        e.preventDefault();

        var form      = e.target;
        var errorMsg  = form.querySelector('.odf-ap-error');
        var submitBtn = form.querySelector('.odf-ap-submit');

        var data = new FormData(form);
        data.append('action', 'odf_submit');

        if (errorMsg) errorMsg.style.display = 'none';
        btnLoading(submitBtn);

        fetch(odfVars.ajaxurl, { method: 'POST', body: data })
            .then(function (r) { return r.json(); })
            .then(function (res) {
                btnReset(submitBtn);
                if (res.success) {
                    redirectSuccess('contact');
                } else {
                    var msg = (res.data && res.data.message) ? res.data.message : 'An error occurred.';
                    if (errorMsg) { errorMsg.textContent = msg; errorMsg.style.display = 'block'; }
                }
            })
            .catch(function () {
                btnReset(submitBtn);
                if (errorMsg) { errorMsg.textContent = 'Network error. Please try again.'; errorMsg.style.display = 'block'; }
            });
    });

    // ── Popup modal form ──────────────────────────────────────────────────────
    document.addEventListener('submit', function (e) {
        if (!e.target.matches('#odf-form')) return;
        e.preventDefault();

        var form      = e.target;
        var overlay   = document.getElementById('odf-overlay');
        var errorMsg  = overlay ? overlay.querySelector('.odf-error-msg') : null;
        var submitBtn = form.querySelector('.odf-submit');

        var data = new FormData(form);
        data.append('action', 'odf_submit');

        if (errorMsg) errorMsg.style.display = 'none';
        btnLoading(submitBtn);

        fetch(odfVars.ajaxurl, { method: 'POST', body: data })
            .then(function (r) { return r.json(); })
            .then(function (res) {
                btnReset(submitBtn);
                if (res.success) {
                    redirectSuccess(lastService);
                } else {
                    var msg = (res.data && res.data.message) ? res.data.message : 'An error occurred.';
                    if (errorMsg) { errorMsg.textContent = msg; errorMsg.style.display = 'block'; }
                }
            })
            .catch(function () {
                btnReset(submitBtn);
                if (errorMsg) { errorMsg.textContent = 'Network error. Please try again.'; errorMsg.style.display = 'block'; }
            });
    });

})();
