/**
 * OnDigital Admin Panel JS
 */
(function ($) {
    'use strict';

    // ── Language tabs ──────────────────────────────────────────────
    $(document).on('click', '.od-lang-tab', function () {
        var wrap = $(this).closest('.od-lang-wrap');
        var lang = $(this).data('lang');
        wrap.find('.od-lang-tab').removeClass('active');
        $(this).addClass('active');
        wrap.find('.od-lang-pane').removeClass('active');
        wrap.find('.od-lang-pane[data-lang="' + lang + '"]').addClass('active');
    });

    // ── Card collapse ──────────────────────────────────────────────
    $(document).on('click', '.od-card-head', function () {
        $(this).toggleClass('collapsed');
        $(this).next('.od-card-body').toggleClass('collapsed');
    });

    // ── Image upload ───────────────────────────────────────────────
    $(document).on('click', '.od-upload-img', function (e) {
        e.preventDefault();
        var btn     = $(this);
        var wrap    = btn.closest('.od-image-field');
        var input   = wrap.find('.od-img-id');
        var preview = wrap.find('.od-image-preview');

        var frame = wp.media({ title: 'Select Image', multiple: false, library: { type: 'image' } });
        frame.on('select', function () {
            var att = frame.state().get('selection').first().toJSON();
            input.val(att.id);
            preview.html('<img src="' + att.url + '">').removeClass('empty');
        });
        frame.open();
    });

    $(document).on('click', '.od-remove-img', function (e) {
        e.preventDefault();
        var wrap = $(this).closest('.od-image-field');
        wrap.find('.od-img-id').val('');
        wrap.find('.od-image-preview').html('').addClass('empty');
    });

    // ── Repeater: remove row ───────────────────────────────────────
    $(document).on('click', '.od-remove-row', function () {
        $(this).closest('.od-repeater-row').remove();
        reindex();
    });

    function reindex() {
        $('.od-repeater').each(function () {
            $(this).find('.od-repeater-row').each(function (i) {
                $(this).find('[name]').each(function () {
                    var name = $(this).attr('name');
                    name = name.replace(/\[\d+\]/, '[' + i + ']');
                    $(this).attr('name', name);
                });
            });
        });
    }

    // ── Repeater: add row ──────────────────────────────────────────
    var templates = {
        partner: function (i) {
            return '<div class="od-repeater-row">' +
                '<div class="od-repeater-row-head"><span>Partner ' + (i + 1) + '</span><div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>' +
                imgField('ondigital_partners[' + i + '][image_light]', 'Logo (Light)') +
                imgField('ondigital_partners[' + i + '][image_dark]', 'Logo (Dark)') +
                '<div class="od-field"><label>Alt Text</label><input type="text" name="ondigital_partners[' + i + '][alt]" value=""></div>' +
                '</div>';
        },
        feature: function (i) {
            return '<div class="od-repeater-row">' +
                '<div class="od-repeater-row-head"><span>Feature ' + (i + 1) + '</span><div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>' +
                '<div class="od-field"><label>Title</label><input type="text" name="ondigital_features[' + i + '][title]" value=""></div>' +
                '<div class="od-field"><label>Description</label><textarea name="ondigital_features[' + i + '][description]" rows="2"></textarea></div>' +
                '<div class="od-field-row">' +
                imgField('ondigital_features[' + i + '][icon_light]', 'Icon (Light)') +
                imgField('ondigital_features[' + i + '][icon_dark]', 'Icon (Dark)') +
                '</div></div>';
        },
        pricing: function (i) {
            return '<div class="od-repeater-row">' +
                '<div class="od-repeater-row-head"><span>Plan ' + (i + 1) + '</span><div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>' +
                '<div class="od-field-row">' +
                '<div class="od-field"><label>Plan Name</label><input type="text" name="ondigital_pricing[' + i + '][name]" value=""></div>' +
                '<div class="od-field"><label>Price</label><input type="text" name="ondigital_pricing[' + i + '][price]" value=""></div>' +
                '</div>' +
                '<div class="od-field"><label>Features (one per line)</label><textarea name="ondigital_pricing[' + i + '][features]" rows="4"></textarea></div>' +
                '<div class="od-field"><label>CTA URL</label><input type="url" name="ondigital_pricing[' + i + '][cta_url]" value=""></div>' +
                '</div>';
        },
        faq: function (i) {
            return '<div class="od-repeater-row">' +
                '<div class="od-repeater-row-head"><span>FAQ ' + (i + 1) + '</span><div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>' +
                '<div class="od-field"><label>Question</label><input type="text" name="ondigital_faq[' + i + '][question]" value=""></div>' +
                '<div class="od-field"><label>Answer</label><textarea name="ondigital_faq[' + i + '][answer]" rows="2"></textarea></div>' +
                '<label style="display:flex;align-items:center;gap:6px;font-size:13px;"><input type="checkbox" name="ondigital_faq[' + i + '][open]" value="1"> Open by default</label>' +
                '</div>';
        },
        stats: function (i) {
            return '<div class="od-repeater-row">' +
                '<div class="od-repeater-row-head"><span>Counter ' + (i + 1) + '</span><div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>' +
                '<div class="od-field-row">' +
                '<div class="od-field"><label>Number</label><input type="text" name="ondigital_stats[' + i + '][number]" value=""></div>' +
                '<div class="od-field"><label>Suffix</label><input type="text" name="ondigital_stats[' + i + '][suffix]" value="" style="max-width:80px;"></div>' +
                '<div class="od-field"><label>Label</label><input type="text" name="ondigital_stats[' + i + '][label]" value=""></div>' +
                '</div></div>';
        },
        testimonial: function (i) {
            return '<div class="od-repeater-row">' +
                '<div class="od-repeater-row-head"><span>Testimonial ' + (i + 1) + '</span><div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>' +
                '<div class="od-field"><label>Quote</label><textarea name="ondigital_testimonials[' + i + '][quote]" rows="3"></textarea></div>' +
                '<div class="od-field-row">' +
                '<div class="od-field"><label>Name</label><input type="text" name="ondigital_testimonials[' + i + '][name]" value=""></div>' +
                '<div class="od-field"><label>Role</label><input type="text" name="ondigital_testimonials[' + i + '][role]" value=""></div>' +
                '</div></div>';
        },
        text_slider: function (i) {
            return '<div class="od-repeater-row">' +
                '<div class="od-repeater-row-head"><span>Slide ' + (i + 1) + '</span><div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>' +
                '<div class="od-field-row">' +
                '<div class="od-field"><label>Text</label><input type="text" name="ondigital_text_slider[' + i + '][text]" value=""></div>' +
                '<div class="od-field"><label>Highlighted Word</label><input type="text" name="ondigital_text_slider[' + i + '][highlighted]" value=""></div>' +
                '</div></div>';
        },
        footer_quick_link: function (i) {
            return '<div class="od-repeater-row">' +
                '<div class="od-repeater-row-head"><span>Link ' + (i + 1) + '</span><div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>' +
                '<div class="od-field-row">' +
                '<div class="od-field"><label>Label</label><input type="text" name="ondigital_footer_quick_links[' + i + '][label]" value=""></div>' +
                '<div class="od-field"><label>URL</label><input type="url" name="ondigital_footer_quick_links[' + i + '][url]" value="" placeholder="https://"></div>' +
                '</div></div>';
        },
        footer_service_link: function (i) {
            return '<div class="od-repeater-row">' +
                '<div class="od-repeater-row-head"><span>Service ' + (i + 1) + '</span><div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>' +
                '<div class="od-field-row">' +
                '<div class="od-field"><label>Label</label><input type="text" name="ondigital_footer_services_links[' + i + '][label]" value=""></div>' +
                '<div class="od-field"><label>URL</label><input type="url" name="ondigital_footer_services_links[' + i + '][url]" value="" placeholder="https://"></div>' +
                '</div></div>';
        }
    };

    function imgField(name, label) {
        return '<div class="od-field"><label>' + label + '</label>' +
            '<div class="od-image-field">' +
            '<div class="od-image-preview empty"></div>' +
            '<div class="od-image-btns">' +
            '<input type="hidden" name="' + name + '" value="" class="od-img-id">' +
            '<button type="button" class="button od-upload-img">Select</button>' +
            '<button type="button" class="button od-remove-img">Remove</button>' +
            '</div></div></div>';
    }

    $(document).on('click', '.od-add-row', function () {
        var type      = $(this).data('repeater');
        var container = $('#repeater-' + type);
        var index     = container.find('.od-repeater-row').length;
        if (templates[type]) {
            container.append(templates[type](index));
        }
    });

    // ── AJAX Save ──────────────────────────────────────────────────
    $('#od-save-btn').on('click', function () {
        var btn    = $(this);
        var notice = $('#od-save-notice');
        var form   = $('#od-panel-form');

        btn.text(odPanel.saving).prop('disabled', true);
        notice.hide();

        // Collect scalar options
        var options = {};
        form.find('[name^="options["]').each(function () {
            var match = $(this).attr('name').match(/^options\[(.+)\]$/);
            if (match) {
                options[match[1]] = $(this).val();
            }
        });

        // Build FormData for repeaters
        var fd = new FormData();
        fd.append('action', 'ondigital_save');
        fd.append('nonce', odPanel.nonce);
        fd.append('options', JSON.stringify(options));

        // Append repeater fields by name
        var repeaterFields = form.find('[name^="ondigital_"]');
        repeaterFields.each(function () {
            if ($(this).is(':checkbox') && !$(this).is(':checked')) return;
            fd.append($(this).attr('name'), $(this).val());
        });

        $.ajax({
            url: odPanel.ajaxurl,
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            success: function (res) {
                btn.text('Save Changes').prop('disabled', false);
                if (res.success) {
                    notice.text(odPanel.saved).css('color', '#46b450').show();
                } else {
                    notice.text('Error saving.').css('color', '#dc3232').show();
                }
                setTimeout(function () { notice.fadeOut(); }, 3000);
            },
            error: function () {
                btn.text('Save Changes').prop('disabled', false);
                notice.text('Error saving.').css('color', '#dc3232').show();
            }
        });
    });

})(jQuery);
