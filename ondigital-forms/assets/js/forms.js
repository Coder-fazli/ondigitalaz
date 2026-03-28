(function () {
    'use strict';

    var overlay     = document.getElementById('odf-overlay');
    if (!overlay) return;

    var form        = document.getElementById('odf-form');
    var successWrap = overlay.querySelector('.odf-success-wrap');
    var errorMsg    = overlay.querySelector('.odf-error-msg');
    var submitBtn   = overlay.querySelector('.odf-submit');
    var closeBtn    = overlay.querySelector('.odf-close');

    // ── Open ───────────────────────────────────────────────────────────────────
    document.addEventListener('click', function (e) {
        var trigger = e.target.closest('[data-od-form]');
        if (!trigger) return;
        e.preventDefault();
        openModal();
    });

    function openModal() {
        overlay.classList.add('is-open');
        overlay.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        // Focus first input for accessibility
        setTimeout(function () {
            var first = overlay.querySelector('input[type="text"], input[type="email"], input[type="tel"]');
            if (first) first.focus();
        }, 280);
    }

    function closeModal() {
        overlay.classList.remove('is-open');
        overlay.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    // ── Close triggers ─────────────────────────────────────────────────────────
    if (closeBtn) closeBtn.addEventListener('click', closeModal);

    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closeModal();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && overlay.classList.contains('is-open')) closeModal();
    });

    // ── Choice buttons (radio only — checkboxes are native) ────────────────────
    overlay.addEventListener('click', function (e) {
        var btn = e.target.closest('.odf-choice-btn');
        if (!btn) return;
        var input = btn.querySelector('input[type="radio"]');
        if (!input) return;
        // Deselect all siblings in same group
        var group = overlay.querySelectorAll('input[name="' + input.name + '"]');
        group.forEach(function (s) { s.checked = false; });
        input.checked = true;
    });

    // ── Submit ─────────────────────────────────────────────────────────────────
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        var data = new FormData(form);
        data.append('action', 'odf_submit');

        if (errorMsg) errorMsg.style.display = 'none';
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.6';
        }

        fetch(odfVars.ajaxurl, { method: 'POST', body: data })
            .then(function (r) { return r.json(); })
            .then(function (res) {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '';
                }
                if (res.success) {
                    // Show success state
                    form.style.display = 'none';
                    if (successWrap) successWrap.style.display = 'block';

                    // Auto-close after 2.8s, then reset
                    setTimeout(function () {
                        closeModal();
                        setTimeout(function () {
                            form.reset();
                            form.style.display = '';
                            if (successWrap) successWrap.style.display = 'none';
                        }, 300);
                    }, 2800);
                } else {
                    var msg = (res.data && res.data.message) ? res.data.message : 'An error occurred. Please try again.';
                    if (errorMsg) {
                        errorMsg.textContent = msg;
                        errorMsg.style.display = 'block';
                    }
                }
            })
            .catch(function () {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '';
                }
                if (errorMsg) {
                    errorMsg.textContent = 'Network error. Please try again.';
                    errorMsg.style.display = 'block';
                }
            });
    });

})();
