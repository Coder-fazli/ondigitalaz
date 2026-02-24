/**
 * OnDigital Theme Options - Admin JS
 * Handles tab switching, media uploader, and repeater row add/remove.
 */
(function ($) {
    'use strict';

    // Tab switching
    $(document).on('click', '.ondigital-tab', function () {
        var tab = $(this).data('tab');
        $('.ondigital-tab').removeClass('active');
        $(this).addClass('active');
        $('.ondigital-tab-content').removeClass('active');
        $('.ondigital-tab-content[data-tab="' + tab + '"]').addClass('active');
    });

    // Remove row
    $(document).on('click', '.remove-row', function () {
        $(this).closest('.ondigital-repeater-row').remove();
        // Re-index all rows in the parent repeater
        $(this).closest('[id$="-repeater"]').find('.ondigital-repeater-row').each(function (index) {
            $(this).find('[name]').each(function () {
                var name = $(this).attr('name');
                name = name.replace(/\[\d+\]/, '[' + index + ']');
                $(this).attr('name', name);
            });
        });
    });

    // Image upload
    $(document).on('click', '.upload-img-btn', function (e) {
        e.preventDefault();
        var btn = $(this);
        var row = btn.closest('.ondigital-repeater-row, td');
        var input = btn.prevAll('.img-id-field:first');
        var preview = btn.prevAll('.img-preview:first');

        var frame = wp.media({
            title: 'Select Image',
            multiple: false,
            library: { type: 'image' }
        });

        frame.on('select', function () {
            var attachment = frame.state().get('selection').first().toJSON();
            input.val(attachment.id);
            preview.html('<img src="' + attachment.url + '" class="ondigital-img-preview">');
        });

        frame.open();
    });

    // Remove image
    $(document).on('click', '.remove-img-btn', function (e) {
        e.preventDefault();
        var btn = $(this);
        btn.prevAll('.img-id-field:first').val('');
        btn.prevAll('.img-preview:first').html('');
    });

    // Row templates for "Add" buttons
    var templates = {
        partner: function (i) {
            return '<div class="ondigital-repeater-row">' +
                '<button type="button" class="remove-row">&times;</button>' +
                '<label>Alt Text</label>' +
                '<input type="text" name="ondigital_partners[' + i + '][alt]" value="">' +
                '<label>Logo (Light)</label>' +
                '<input type="hidden" name="ondigital_partners[' + i + '][image_light]" value="" class="img-id-field">' +
                '<div class="img-preview"></div>' +
                '<button type="button" class="button upload-img-btn">Select</button>' +
                '<button type="button" class="button remove-img-btn">Remove</button>' +
                '<label>Logo (Dark)</label>' +
                '<input type="hidden" name="ondigital_partners[' + i + '][image_dark]" value="" class="img-id-field">' +
                '<div class="img-preview"></div>' +
                '<button type="button" class="button upload-img-btn">Select</button>' +
                '<button type="button" class="button remove-img-btn">Remove</button>' +
                '</div>';
        },
        feature: function (i) {
            return '<div class="ondigital-repeater-row">' +
                '<button type="button" class="remove-row">&times;</button>' +
                '<label>Title</label>' +
                '<input type="text" name="ondigital_features[' + i + '][title]" value="">' +
                '<label>Description</label>' +
                '<textarea name="ondigital_features[' + i + '][description]" rows="3"></textarea>' +
                '<label>Icon (Light)</label>' +
                '<input type="hidden" name="ondigital_features[' + i + '][icon_light]" value="" class="img-id-field">' +
                '<div class="img-preview"></div>' +
                '<button type="button" class="button upload-img-btn">Select</button>' +
                '<button type="button" class="button remove-img-btn">Remove</button>' +
                '<label>Icon (Dark)</label>' +
                '<input type="hidden" name="ondigital_features[' + i + '][icon_dark]" value="" class="img-id-field">' +
                '<div class="img-preview"></div>' +
                '<button type="button" class="button upload-img-btn">Select</button>' +
                '<button type="button" class="button remove-img-btn">Remove</button>' +
                '</div>';
        },
        pricing: function (i) {
            return '<div class="ondigital-repeater-row">' +
                '<button type="button" class="remove-row">&times;</button>' +
                '<label>Plan Name</label>' +
                '<input type="text" name="ondigital_pricing[' + i + '][name]" value="">' +
                '<label>Price</label>' +
                '<input type="text" name="ondigital_pricing[' + i + '][price]" value="">' +
                '<label>Features (one per line)</label>' +
                '<textarea name="ondigital_pricing[' + i + '][features]" rows="5"></textarea>' +
                '<label>CTA URL</label>' +
                '<input type="url" name="ondigital_pricing[' + i + '][cta_url]" value="">' +
                '</div>';
        },
        faq: function (i) {
            return '<div class="ondigital-repeater-row">' +
                '<button type="button" class="remove-row">&times;</button>' +
                '<label>Question</label>' +
                '<input type="text" name="ondigital_faq[' + i + '][question]" value="">' +
                '<label>Answer</label>' +
                '<textarea name="ondigital_faq[' + i + '][answer]" rows="3"></textarea>' +
                '<label><input type="checkbox" name="ondigital_faq[' + i + '][open]" value="1"> Open by default</label>' +
                '</div>';
        },
        stats: function (i) {
            return '<div class="ondigital-repeater-row">' +
                '<button type="button" class="remove-row">&times;</button>' +
                '<label>Number</label>' +
                '<input type="text" name="ondigital_stats[' + i + '][number]" value="">' +
                '<label>Suffix (e.g. +, %)</label>' +
                '<input type="text" name="ondigital_stats[' + i + '][suffix]" value="" style="max-width:80px;">' +
                '<label>Label (two lines, use Enter)</label>' +
                '<input type="text" name="ondigital_stats[' + i + '][label]" value="">' +
                '</div>';
        },
        testimonial: function (i) {
            return '<div class="ondigital-repeater-row">' +
                '<button type="button" class="remove-row">&times;</button>' +
                '<label>Quote</label>' +
                '<textarea name="ondigital_testimonials[' + i + '][quote]" rows="3"></textarea>' +
                '<label>Name</label>' +
                '<input type="text" name="ondigital_testimonials[' + i + '][name]" value="">' +
                '<label>Role</label>' +
                '<input type="text" name="ondigital_testimonials[' + i + '][role]" value="">' +
                '</div>';
        },
        text_slider: function (i) {
            return '<div class="ondigital-repeater-row">' +
                '<button type="button" class="remove-row">&times;</button>' +
                '<label>Text</label>' +
                '<input type="text" name="ondigital_text_slider[' + i + '][text]" value="">' +
                '<label>Highlighted Word</label>' +
                '<input type="text" name="ondigital_text_slider[' + i + '][highlighted]" value="">' +
                '</div>';
        },
        client: function (i) {
            return '<div class="ondigital-repeater-row">' +
                '<button type="button" class="remove-row">&times;</button>' +
                '<label>Logo (Light)</label>' +
                '<input type="hidden" name="ondigital_about_clients[' + i + '][img_light]" value="" class="media-id">' +
                '<button type="button" class="button upload-media-btn">Select Image</button>' +
                '<label>Logo (Dark)</label>' +
                '<input type="hidden" name="ondigital_about_clients[' + i + '][img_dark]" value="" class="media-id">' +
                '<button type="button" class="button upload-media-btn">Select Image</button>' +
                '<label>Alt Text</label>' +
                '<input type="text" name="ondigital_about_clients[' + i + '][alt]" value="">' +
                '</div>';
        },
        about_faq: function (i) {
            return '<div class="ondigital-repeater-row">' +
                '<button type="button" class="remove-row">&times;</button>' +
                '<label>Question</label>' +
                '<input type="text" name="ondigital_about_faq_items[' + i + '][question]" value="">' +
                '<label>Answer</label>' +
                '<textarea name="ondigital_about_faq_items[' + i + '][answer]" rows="3"></textarea>' +
                '<label><input type="checkbox" name="ondigital_about_faq_items[' + i + '][open]" value="1"> Open by default</label>' +
                '</div>';
        }
    };

    // Add row
    $(document).on('click', '.add-row-btn', function () {
        var repeater = $(this).data('repeater');
        var type = $(this).data('type');
        var container = $('#' + repeater + '-repeater');
        var index = container.find('.ondigital-repeater-row').length;

        if (templates[type]) {
            container.append(templates[type](index));
        }
    });

})(jQuery);
