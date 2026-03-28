(function () {
    'use strict';

    // ── Open trigger — always listen, look up overlay at click time ────────────
    document.addEventListener('click', function (e) {
        var trigger = e.target.closest('[data-od-form]');
        if (!trigger) return;
        e.preventDefault();

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

    // ── Close on overlay background click ─────────────────────────────────────
    document.addEventListener('click', function (e) {
        if (!e.target.matches('#odf-overlay')) return;
        closeModal();
    });

    // ── Close button ───────────────────────────────────────────────────────────
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.odf-close')) return;
        closeModal();
    });

    // ── ESC key ────────────────────────────────────────────────────────────────
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

    // ── Radio choice buttons ───────────────────────────────────────────────────
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

    // ── Form submit ────────────────────────────────────────────────────────────
    document.addEventListener('submit', function (e) {
        if (!e.target.matches('#odf-form')) return;
        e.preventDefault();

        var form       = e.target;
        var overlay    = document.getElementById('odf-overlay');
        var successWrap = overlay ? overlay.querySelector('.odf-success-wrap') : null;
        var errorMsg   = overlay ? overlay.querySelector('.odf-error-msg') : null;
        var submitBtn  = form.querySelector('.odf-submit');

        var data = new FormData(form);
        data.append('action', 'odf_submit');

        if (errorMsg) errorMsg.style.display = 'none';
        if (submitBtn) { submitBtn.disabled = true; submitBtn.style.opacity = '0.6'; }

        fetch(odfVars.ajaxurl, { method: 'POST', body: data })
            .then(function (r) { return r.json(); })
            .then(function (res) {
                if (submitBtn) { submitBtn.disabled = false; submitBtn.style.opacity = ''; }
                if (res.success) {
                    form.style.display = 'none';
                    if (successWrap) successWrap.style.display = 'block';
                    setTimeout(function () {
                        closeModal();
                        setTimeout(function () {
                            form.reset();
                            form.style.display = '';
                            if (successWrap) successWrap.style.display = 'none';
                        }, 300);
                    }, 2800);
                } else {
                    var msg = (res.data && res.data.message) ? res.data.message : 'An error occurred.';
                    if (errorMsg) { errorMsg.textContent = msg; errorMsg.style.display = 'block'; }
                }
            })
            .catch(function () {
                if (submitBtn) { submitBtn.disabled = false; submitBtn.style.opacity = ''; }
                if (errorMsg) { errorMsg.textContent = 'Network error. Please try again.'; errorMsg.style.display = 'block'; }
            });
    });

})();
