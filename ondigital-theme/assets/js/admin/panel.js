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
            return '<div class="od-repeater-row od-sc-row">' +
                '<div class="od-repeater-row-head od-sc-toggle" style="cursor:pointer;user-select:none;">' +
                '<span>Feature ' + (i + 1) + '</span>' +
                '<div class="od-row-actions"><span class="od-sc-arrow" style="margin-right:8px;font-size:11px;opacity:.5;">▼</span><button type="button" class="od-remove-row">&times;</button></div>' +
                '</div>' +
                '<div class="od-sc-body" style="display:none;">' +
                '<div class="od-lang-wrap">' +
                '<div class="od-lang-tabs">' +
                '<span class="od-lang-tab active" data-lang="en">🇬🇧 EN</span>' +
                '<span class="od-lang-tab" data-lang="az">🇦🇿 AZ</span>' +
                '</div>' +
                '<div class="od-lang-pane active" data-lang="en">' +
                '<div class="od-field"><label>Title (EN)</label><input type="text" autocomplete="off" name="ondigital_features[' + i + '][title_en]" value=""></div>' +
                '<div class="od-field"><label>Description (EN)</label><textarea autocomplete="off" name="ondigital_features[' + i + '][description_en]" rows="2"></textarea></div>' +
                '</div>' +
                '<div class="od-lang-pane" data-lang="az">' +
                '<div class="od-field"><label>Title (AZ)</label><input type="text" autocomplete="off" name="ondigital_features[' + i + '][title_az]" value=""></div>' +
                '<div class="od-field"><label>Description (AZ)</label><textarea autocomplete="off" name="ondigital_features[' + i + '][description_az]" rows="2"></textarea></div>' +
                '</div>' +
                '</div>' +
                '<div class="od-field-row">' +
                imgField('ondigital_features[' + i + '][icon_light]', 'Icon (Light)') +
                imgField('ondigital_features[' + i + '][icon_dark]', 'Icon (Dark)') +
                '</div>' +
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
                '<div class="od-lang-wrap"><div class="od-lang-tabs">' +
                '<span class="od-lang-tab active" data-lang="az">🇦🇿 AZ</span>' +
                '<span class="od-lang-tab" data-lang="en">🇬🇧 EN</span>' +
                '</div>' +
                '<div class="od-lang-pane active" data-lang="az">' +
                '<div class="od-field"><label>Question (AZ)</label><input type="text" name="ondigital_faq[' + i + '][question_az]" value=""></div>' +
                '<div class="od-field"><label>Answer (AZ)</label><textarea name="ondigital_faq[' + i + '][answer_az]" rows="2"></textarea></div>' +
                '</div>' +
                '<div class="od-lang-pane" data-lang="en">' +
                '<div class="od-field"><label>Question (EN)</label><input type="text" name="ondigital_faq[' + i + '][question_en]" value=""></div>' +
                '<div class="od-field"><label>Answer (EN)</label><textarea name="ondigital_faq[' + i + '][answer_en]" rows="2"></textarea></div>' +
                '</div></div>' +
                '<label style="display:flex;align-items:center;gap:6px;font-size:13px;margin-top:8px;"><input type="checkbox" name="ondigital_faq[' + i + '][open]" value="1"> Open by default</label>' +
                '</div>';
        },
        about_faq: function (i) {
            return '<div class="od-repeater-row">' +
                '<div class="od-repeater-row-head"><span>FAQ ' + (i + 1) + '</span><div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>' +
                '<div class="od-lang-wrap"><div class="od-lang-tabs">' +
                '<span class="od-lang-tab active" data-lang="az">🇦🇿 AZ</span>' +
                '<span class="od-lang-tab" data-lang="en">🇬🇧 EN</span>' +
                '</div>' +
                '<div class="od-lang-pane active" data-lang="az">' +
                '<div class="od-field"><label>Question (AZ)</label><input type="text" name="ondigital_about_faq[' + i + '][question_az]" value=""></div>' +
                '<div class="od-field"><label>Answer (AZ)</label><textarea name="ondigital_about_faq[' + i + '][answer_az]" rows="2"></textarea></div>' +
                '</div>' +
                '<div class="od-lang-pane" data-lang="en">' +
                '<div class="od-field"><label>Question (EN)</label><input type="text" name="ondigital_about_faq[' + i + '][question_en]" value=""></div>' +
                '<div class="od-field"><label>Answer (EN)</label><textarea name="ondigital_about_faq[' + i + '][answer_en]" rows="2"></textarea></div>' +
                '</div></div>' +
                '<label style="display:flex;align-items:center;gap:6px;font-size:13px;margin-top:8px;"><input type="checkbox" name="ondigital_about_faq[' + i + '][open]" value="1"> Open by default</label>' +
                '</div>';
        },
        stats: function (i) {
            return '<div class="od-repeater-row od-sc-row">' +
                '<div class="od-repeater-row-head od-sc-toggle" style="cursor:pointer;user-select:none;">' +
                '<span>Counter ' + (i + 1) + '</span>' +
                '<div class="od-row-actions"><span class="od-sc-arrow" style="margin-right:8px;font-size:11px;opacity:.5;">▼</span><button type="button" class="od-remove-row">&times;</button></div>' +
                '</div>' +
                '<div class="od-sc-body" style="display:none;">' +
                '<div class="od-field-row">' +
                '<div class="od-field"><label>Number</label><input type="text" name="ondigital_stats[' + i + '][number]" value=""></div>' +
                '<div class="od-field"><label>Suffix</label><input type="text" name="ondigital_stats[' + i + '][suffix]" value="" style="max-width:80px;"></div>' +
                '</div>' +
                '<div class="od-lang-wrap"><div class="od-lang-tabs">' +
                '<span class="od-lang-tab active" data-lang="en">🇬🇧 EN</span>' +
                '<span class="od-lang-tab" data-lang="az">🇦🇿 AZ</span>' +
                '</div>' +
                '<div class="od-lang-pane active" data-lang="en">' +
                '<div class="od-field"><label>Label (EN)</label><input type="text" autocomplete="off" name="ondigital_stats[' + i + '][label_en]" value=""></div>' +
                '</div>' +
                '<div class="od-lang-pane" data-lang="az">' +
                '<div class="od-field"><label>Label (AZ)</label><input type="text" autocomplete="off" name="ondigital_stats[' + i + '][label_az]" value=""></div>' +
                '</div></div>' +
                '</div></div>';
        },
        testimonial: function (i) {
            return '<div class="od-repeater-row od-sc-row">' +
                '<div class="od-repeater-row-head od-sc-toggle" style="cursor:pointer;user-select:none;">' +
                '<span>Testimonial ' + (i + 1) + '</span>' +
                '<div class="od-row-actions"><span class="od-sc-arrow" style="margin-right:8px;font-size:11px;opacity:.5;">▼</span><button type="button" class="od-remove-row">&times;</button></div>' +
                '</div>' +
                '<div class="od-sc-body" style="display:none;">' +
                '<div class="od-lang-wrap"><div class="od-lang-tabs">' +
                '<span class="od-lang-tab active" data-lang="az">🇦🇿 AZ</span>' +
                '<span class="od-lang-tab" data-lang="en">🇬🇧 EN</span>' +
                '</div>' +
                '<div class="od-lang-pane active" data-lang="az">' +
                '<div class="od-field"><label>Quote (AZ)</label><textarea name="ondigital_testimonials[' + i + '][quote_az]" rows="3"></textarea></div>' +
                '<div class="od-field"><label>Role (AZ)</label><input type="text" name="ondigital_testimonials[' + i + '][role_az]" value=""></div>' +
                '</div>' +
                '<div class="od-lang-pane" data-lang="en">' +
                '<div class="od-field"><label>Quote (EN)</label><textarea name="ondigital_testimonials[' + i + '][quote_en]" rows="3"></textarea></div>' +
                '<div class="od-field"><label>Role (EN)</label><input type="text" name="ondigital_testimonials[' + i + '][role_en]" value=""></div>' +
                '</div></div>' +
                '<div class="od-field"><label>Name</label><input type="text" name="ondigital_testimonials[' + i + '][name]" value=""></div>' +
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
        },
        services_card: function (i) {
            return '<div class="od-repeater-row od-sc-row">' +
                '<div class="od-repeater-row-head od-sc-toggle" style="cursor:pointer;user-select:none;">' +
                '<span>Column ' + (i + 1) + '</span>' +
                '<div class="od-row-actions"><span class="od-sc-arrow" style="margin-right:8px;font-size:11px;opacity:.5;">▼</span><button type="button" class="od-remove-row">&times;</button></div>' +
                '</div>' +
                '<div class="od-sc-body" style="display:none;">' +
                imgField('ondigital_services_cards[' + i + '][icon]', 'Icon') +
                '<div class="od-field-row">' +
                '<div class="od-field"><label>Title (EN)</label><input type="text" name="ondigital_services_cards[' + i + '][title_en]" value=""></div>' +
                '<div class="od-field"><label>Title (AZ)</label><input type="text" name="ondigital_services_cards[' + i + '][title_az]" value=""></div>' +
                '</div>' +
                '<div class="od-field-row">' +
                '<div class="od-field"><label>URL (EN)</label><input type="text" name="ondigital_services_cards[' + i + '][url_en]" value="" placeholder="/services/seo/"></div>' +
                '<div class="od-field"><label>URL (AZ)</label><input type="text" name="ondigital_services_cards[' + i + '][url_az]" value="" placeholder="/az/services/seo/"></div>' +
                '</div>' +
                '<div class="od-field"><label style="font-weight:600;display:block;margin-bottom:8px;">Feature Items <small style=\'font-weight:400;color:#888;\'>(EN · AZ · URL)</small></label>' +
                '<div class="od-sc-items" data-card="' + i + '"></div>' +
                '<button type="button" class="button od-sc-add-item" data-card="' + i + '">+ Add Item</button>' +
                '</div>' +
                '</div></div>';
        },
        project_step: function (i) {
            return '<div class="od-repeater-row">' +
                '<div class="od-repeater-row-head"><span>Step ' + (i + 1) + '</span><div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>' +
                '<div class="od-field-row">' +
                '<div class="od-field"><label>Title (AZ)</label><input type="text" name="ondigital_project_steps[' + i + '][title_az]" value=""></div>' +
                '<div class="od-field"><label>Title (EN)</label><input type="text" name="ondigital_project_steps[' + i + '][title_en]" value=""></div>' +
                '</div>' +
                '<div class="od-field"><label>Description (AZ)</label><textarea name="ondigital_project_steps[' + i + '][desc_az]" rows="2"></textarea></div>' +
                '<div class="od-field"><label>Description (EN)</label><textarea name="ondigital_project_steps[' + i + '][desc_en]" rows="2"></textarea></div>' +
                '<div class="od-field"><label>Duration Badge</label><input type="text" name="ondigital_project_steps[' + i + '][duration]" value="" placeholder="e.g. 2 weeks"></div>' +
                '</div>';
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

    // ── Services card: toggle collapse ────────────────────────────
    $(document).on('click', '.od-sc-toggle', function (e) {
        if ($(e.target).closest('.od-remove-row').length) return;
        var body   = $(this).next('.od-sc-body');
        var arrow  = $(this).find('.od-sc-arrow');
        var isOpen = body.is(':visible');
        body.slideToggle(150);
        arrow.text(isOpen ? '▼' : '▲');
    });

    // ── Services card: add item ────────────────────────────────────
    $(document).on('click', '.od-sc-add-item', function () {
        var ci   = $(this).data('card');
        var list = $(this).closest('.od-field').find('.od-sc-items');
        var ii   = list.find('.od-sc-item').length;
        list.append(
            '<div class="od-sc-item" style="display:flex;gap:6px;align-items:center;margin-bottom:6px;flex-wrap:wrap;">' +
            '<input type="text" name="ondigital_services_cards[' + ci + '][items][' + ii + '][text_en]" placeholder="EN text" style="flex:1;min-width:100px;">' +
            '<input type="text" name="ondigital_services_cards[' + ci + '][items][' + ii + '][text_az]" placeholder="AZ text" style="flex:1;min-width:100px;">' +
            '<input type="text" name="ondigital_services_cards[' + ci + '][items][' + ii + '][url_en]" placeholder="URL (EN)" style="width:130px;">' +
            '<input type="text" name="ondigital_services_cards[' + ci + '][items][' + ii + '][url_az]" placeholder="URL (AZ)" style="width:130px;">' +
            '<button type="button" class="od-sc-remove-item" style="color:#c00;background:none;border:none;cursor:pointer;font-size:18px;line-height:1;">&times;</button>' +
            '</div>'
        );
    });

    // ── Services card: remove item ─────────────────────────────────
    $(document).on('click', '.od-sc-remove-item', function () {
        var list = $(this).closest('.od-sc-items');
        $(this).closest('.od-sc-item').remove();
        var ci = list.data('card');
        list.find('.od-sc-item').each(function (ii) {
            $(this).find('[name]').each(function () {
                $(this).attr('name', $(this).attr('name').replace(/\[items\]\[\d+\]/, '[items][' + ii + ']'));
            });
        });
    });

    // ── Services card: reindex cards after remove ──────────────────
    $(document).on('click', '#repeater-services_card .od-remove-row', function () {
        setTimeout(function () {
            $('#repeater-services_card .od-sc-row').each(function (ci) {
                $(this).find('.od-repeater-row-head span').text('Column ' + (ci + 1));
                $(this).find('.od-sc-items').attr('data-card', ci);
                $(this).find('.od-sc-add-item').attr('data-card', ci);
                // reindex card-level fields
                $(this).find('[name^="ondigital_services_cards"]').each(function () {
                    $(this).attr('name', $(this).attr('name').replace(/ondigital_services_cards\[\d+\]/, 'ondigital_services_cards[' + ci + ']'));
                });
                // reindex item fields
                $(this).find('.od-sc-items .od-sc-item').each(function (ii) {
                    $(this).find('[name]').each(function () {
                        $(this).attr('name', $(this).attr('name').replace(/\[items\]\[\d+\]/, '[items][' + ii + ']'));
                    });
                });
            });
        }, 10);
    });

    $(document).on('click', '.od-add-row', function () {
        var type      = $(this).data('repeater');
        var container = $('#repeater-' + type);
        var index     = container.find('.od-repeater-row').length;
        if (templates[type]) {
            container.append(templates[type](index));
        }
    });

    // ── Floating save button triggers main save ────────────────────
    $('#od-save-float').on('click', function () {
        $('#od-save-btn').trigger('click');
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
            if (!match) return;
            var type = $(this).attr('type');
            if (type === 'radio' && !$(this).is(':checked')) return;
            if (type === 'checkbox') {
                options[match[1]] = $(this).is(':checked') ? '1' : '0';
            } else {
                options[match[1]] = $(this).val();
            }
        });

        // Build FormData for repeaters
        var fd = new FormData();
        fd.append('action', 'ondigital_save');
        fd.append('nonce', odPanel.nonce);
        fd.append('options', JSON.stringify(options));

        // Append repeater fields by name — log every field for debugging
        var repeaterFields = form.find('[name^="ondigital_"]');
        var debugPayload = {};
        repeaterFields.each(function () {
            if ($(this).is(':checkbox') && !$(this).is(':checked')) return;
            var fieldName = $(this).attr('name');
            var fieldVal  = $(this).val();
            fd.append(fieldName, fieldVal);
            // Group by repeater key for cleaner console output
            var topKey = fieldName.split('[')[0];
            if (!debugPayload[topKey]) debugPayload[topKey] = [];
            debugPayload[topKey].push({ name: fieldName, value: fieldVal });
        });

        console.group('[OD Save] Repeater fields being sent');
        Object.keys(debugPayload).forEach(function (key) {
            console.group(key);
            debugPayload[key].forEach(function (f) {
                console.log(f.name + ' =', JSON.stringify(f.value));
            });
            console.groupEnd();
        });
        console.log('[OD Save] Scalar options:', options);
        console.groupEnd();

        $.ajax({
            url: odPanel.ajaxurl,
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            success: function (res) {
                btn.text('Save Changes').prop('disabled', false);
                console.log('[OD Save] Server response:', res);
                if (res.success) {
                    notice.text(odPanel.saved).css('color', '#46b450').show();
                } else {
                    console.error('[OD Save] Server returned error:', res);
                    notice.text('Error saving.').css('color', '#dc3232').show();
                }
                setTimeout(function () { notice.fadeOut(); }, 3000);
            },
            error: function (xhr, status, err) {
                btn.text('Save Changes').prop('disabled', false);
                console.error('[OD Save] AJAX error:', status, err, xhr.responseText);
                notice.text('Error saving.').css('color', '#dc3232').show();
            }
        });
    });

})(jQuery);
