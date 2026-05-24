(function ($) {
    'use strict';

    // ── Card collapse ──────────────────────────────────────────────────────────
    $(document).on('click', '.odf-card-head', function () {
        $(this).closest('.odf-card').toggleClass('is-collapsed');
    });

    // ── Language tabs ──────────────────────────────────────────────────────────
    $(document).on('click', '.odf-lang-tab', function () {
        var lang = $(this).data('lang');
        var $wrap = $(this).closest('.odf-lang-wrap');
        $wrap.find('.odf-lang-tab').removeClass('active');
        $wrap.find('.odf-lang-pane').removeClass('active');
        $(this).addClass('active');
        $wrap.find('.odf-lang-pane[data-lang="' + lang + '"]').addClass('active');
    });

    // ── Save ───────────────────────────────────────────────────────────────────
    $('#odf-save-btn').on('click', function () {
        var $btn    = $(this);
        var $notice = $('#odf-save-notice');
        var action  = $btn.data('action') || 'odf_save_settings';
        var options = {};

        $('#odf-settings-form').find('[name]').each(function () {
            var name = $(this).attr('name');
            if (!name) return;
            var match = name.match(/^options\[(.+)\]$/);
            if (!match) return;
            var key = match[1];
            if ($(this).attr('type') === 'checkbox') {
                options[key] = $(this).is(':checked') ? '1' : '0';
            } else {
                options[key] = $(this).val() || '';
            }
        });

        $btn.text(odfAdmin.saving).prop('disabled', true);
        $notice.text('').css('color', '');

        $.post(odfAdmin.ajaxurl, {
            action:  action,
            nonce:   odfAdmin.nonce,
            options: JSON.stringify(options),
        })
            .done(function (res) {
                $btn.text('Save Changes').prop('disabled', false);
                if (res.success) {
                    $notice.css('color', '#3c9e52').text(odfAdmin.saved);
                    setTimeout(function () { $notice.text(''); }, 2500);
                } else {
                    $notice.css('color', '#c00').text('Error saving. Please try again.');
                }
            })
            .fail(function () {
                $btn.text('Save Changes').prop('disabled', false);
                $notice.css('color', '#c00').text('Network error.');
            });
    });

})(jQuery);
