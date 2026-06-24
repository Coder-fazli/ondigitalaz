<?php
/**
 * OnDigital Meta Boxes for CPTs
 *
 * @package OnDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// =============================================================================
// Default meta boxes to closed for service CPT
// =============================================================================

add_action( 'load-post.php',     'ondigital_default_closed_metaboxes' );
add_action( 'load-post-new.php', 'ondigital_default_closed_metaboxes' );
function ondigital_default_closed_metaboxes(): void {
    $screen = get_current_screen();
    if ( ! $screen || $screen->id !== 'service' ) {
        return;
    }
    $version = '2';
    $user_id = get_current_user_id();
    if ( get_user_meta( $user_id, 'od_service_boxes_closed_v', true ) === $version ) {
        return;
    }
    update_user_option( $user_id, 'closedpostboxes_service', array(
        'ondigital_service_meta',
        'ondigital_service_highlights',
        'ondigital_service_process',
        'ondigital_service_cta',
        'ondigital_service_included',
        'ondigital_service_wif',
        'ondigital_service_glossary',
        'ondigital_service_faq',
    ) );
    update_user_meta( $user_id, 'od_service_boxes_closed_v', $version );
}

// =============================================================================
// Register Meta Boxes
// =============================================================================

// =============================================================================
// Blog Post — Table of Contents metabox
// =============================================================================

add_action( 'add_meta_boxes', 'ondigital_register_post_toc_metabox' );
function ondigital_register_post_toc_metabox() {
    add_meta_box(
        'ondigital_post_toc',
        __( 'Table of Contents', 'ondigital' ),
        'ondigital_post_toc_render',
        'post',
        'side',
        'default'
    );
}

function ondigital_post_toc_render( $post ) {
    wp_nonce_field( 'ondigital_post_toc_save', 'ondigital_post_toc_nonce' );
    $depth   = get_post_meta( $post->ID, '_toc_depth', true ) ?: 'h2h3';
    $enabled = get_post_meta( $post->ID, '_toc_enabled', true );
    $enabled = $enabled === '' ? '1' : $enabled;
    ?>
    <p style="margin-bottom:10px;">
        <label style="display:flex;align-items:center;gap:8px;font-weight:600;">
            <input type="checkbox" name="_toc_enabled" value="1" <?php checked( $enabled, '1' ); ?>>
            <?php esc_html_e( 'Show Table of Contents', 'ondigital' ); ?>
        </label>
    </p>
    <p style="margin-bottom:6px;font-weight:600;"><?php esc_html_e( 'Include headings:', 'ondigital' ); ?></p>
    <p>
        <label style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
            <input type="radio" name="_toc_depth" value="h2" <?php checked( $depth, 'h2' ); ?>>
            <?php esc_html_e( 'H2 only', 'ondigital' ); ?>
        </label>
        <label style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
            <input type="radio" name="_toc_depth" value="h3" <?php checked( $depth, 'h3' ); ?>>
            <?php esc_html_e( 'H3 only', 'ondigital' ); ?>
        </label>
        <label style="display:flex;align-items:center;gap:8px;">
            <input type="radio" name="_toc_depth" value="h2h3" <?php checked( $depth, 'h2h3' ); ?>>
            <?php esc_html_e( 'H2 + H3', 'ondigital' ); ?>
        </label>
    </p>
    <?php
}

add_action( 'save_post_post', 'ondigital_post_toc_save' );
function ondigital_post_toc_save( $post_id ) {
    if ( ! isset( $_POST['ondigital_post_toc_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['ondigital_post_toc_nonce'], 'ondigital_post_toc_save' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    $enabled = isset( $_POST['_toc_enabled'] ) ? '1' : '0';
    update_post_meta( $post_id, '_toc_enabled', $enabled );

    $depth = sanitize_text_field( $_POST['_toc_depth'] ?? 'h2h3' );
    if ( ! in_array( $depth, array( 'h2', 'h3', 'h2h3' ), true ) ) $depth = 'h2h3';
    update_post_meta( $post_id, '_toc_depth', $depth );
}

// =============================================================================
// Register Meta Boxes
// =============================================================================

add_action( 'add_meta_boxes', 'ondigital_register_meta_boxes' );
function ondigital_register_meta_boxes() {

    // Service: hero image, icon, stat, features
    add_meta_box(
        'ondigital_service_meta',
        __( '1. Hero & Options', 'ondigital' ),
        'ondigital_service_meta_callback',
        'service',
        'normal',
        'high'
    );

    // Project: all content fields
    add_meta_box(
        'ondigital_project_hero',
        __( '1. Hero', 'ondigital' ),
        'ondigital_project_hero_callback',
        'project',
        'normal',
        'high'
    );
    add_meta_box(
        'ondigital_project_image',
        __( '2. Full-Width Image', 'ondigital' ),
        'ondigital_project_image_callback',
        'project',
        'normal',
        'high'
    );
    add_meta_box(
        'ondigital_project_results',
        __( '3. Results & Metrics', 'ondigital' ),
        'ondigital_project_results_callback',
        'project',
        'normal',
        'high'
    );
    add_meta_box(
        'ondigital_project_testimonial',
        __( '4. Testimonial / Quote', 'ondigital' ),
        'ondigital_project_testimonial_callback',
        'project',
        'normal',
        'high'
    );
    add_meta_box(
        'ondigital_project_process',
        __( '5. Process Steps', 'ondigital' ),
        'ondigital_project_process_callback',
        'project',
        'normal',
        'high'
    );
    add_meta_box(
        'ondigital_project_gallery',
        __( '6. Gallery', 'ondigital' ),
        'ondigital_project_gallery_callback',
        'project',
        'normal',
        'high'
    );
    add_meta_box(
        'ondigital_project_archive_card',
        __( '7. Archive Card (shown on projects grid)', 'ondigital' ),
        'ondigital_project_archive_card_callback',
        'project',
        'normal',
        'high'
    );

    // Service: highlights cards
    add_meta_box(
        'ondigital_service_highlights',
        __( '2. Highlights Cards', 'ondigital' ),
        'ondigital_service_highlights_callback',
        'service',
        'normal',
        'high'
    );

    // Service: process steps
    add_meta_box(
        'ondigital_service_process',
        __( '3. Process Steps', 'ondigital' ),
        'ondigital_service_process_callback',
        'service',
        'normal',
        'high'
    );

    // Service: CTA sections
    add_meta_box(
        'ondigital_service_cta',
        __( '4. CTA Sections', 'ondigital' ),
        'ondigital_service_cta_callback',
        'service',
        'normal',
        'high'
    );

    // Service: What's Included & Roadmap
    add_meta_box(
        'ondigital_service_included',
        __( '5. What\'s Included & Roadmap', 'ondigital' ),
        'ondigital_service_included_callback',
        'service',
        'normal',
        'high'
    );

    // Service: Who Is This For
    add_meta_box(
        'ondigital_service_wif',
        __( '6. Who Is This For', 'ondigital' ),
        'ondigital_service_wif_callback',
        'service',
        'normal',
        'high'
    );

    // Service: Glossary
    add_meta_box(
        'ondigital_service_glossary',
        __( '7. Glossary / Key Terms', 'ondigital' ),
        'ondigital_service_glossary_callback',
        'service',
        'normal',
        'high'
    );

    // Service: FAQ
    add_meta_box(
        'ondigital_service_faq',
        __( '8. FAQ', 'ondigital' ),
        'ondigital_service_faq_callback',
        'service',
        'normal',
        'high'
    );

    // Team Member
    add_meta_box(
        'ondigital_team_meta',
        __( 'Team Member Details', 'ondigital' ),
        'ondigital_team_meta_callback',
        'team_member',
        'normal',
        'high'
    );
}

// =============================================================================
// Helper: text input row
// =============================================================================
function od_mb_text( $name, $label, $value, $placeholder = '', $type = 'text' ) {
    ?>
    <tr>
        <th style="width:200px"><label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label></th>
        <td>
            <input type="<?php echo esc_attr( $type ); ?>"
                   name="<?php echo esc_attr( $name ); ?>"
                   id="<?php echo esc_attr( $name ); ?>"
                   value="<?php echo esc_attr( $value ); ?>"
                   placeholder="<?php echo esc_attr( $placeholder ); ?>"
                   class="regular-text">
        </td>
    </tr>
    <?php
}

function od_mb_textarea( $name, $label, $value, $placeholder = '' ) {
    ?>
    <tr>
        <th style="width:200px"><label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label></th>
        <td>
            <textarea name="<?php echo esc_attr( $name ); ?>"
                      id="<?php echo esc_attr( $name ); ?>"
                      rows="3"
                      placeholder="<?php echo esc_attr( $placeholder ); ?>"
                      class="large-text"><?php echo esc_textarea( $value ); ?></textarea>
        </td>
    </tr>
    <?php
}

function od_mb_image( $name, $label, $image_id ) {
    $url = $image_id ? wp_get_attachment_image_url( $image_id, 'medium' ) : '';
    ?>
    <tr>
        <th style="width:200px"><label><?php echo esc_html( $label ); ?></label></th>
        <td>
            <input type="hidden" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $image_id ); ?>">
            <div id="preview-<?php echo esc_attr( $name ); ?>" style="margin-bottom:8px;">
                <?php if ( $url ) : ?>
                    <img src="<?php echo esc_url( $url ); ?>" style="max-width:200px;height:auto;display:block;border-radius:4px;">
                <?php endif; ?>
            </div>
            <button type="button" class="button od-upload-btn" data-target="#<?php echo esc_attr( $name ); ?>" data-preview="#preview-<?php echo esc_attr( $name ); ?>"><?php esc_html_e( 'Select Image', 'ondigital' ); ?></button>
            <?php if ( $image_id ) : ?>
                <button type="button" class="button od-remove-btn" data-target="#<?php echo esc_attr( $name ); ?>" data-preview="#preview-<?php echo esc_attr( $name ); ?>"><?php esc_html_e( 'Remove', 'ondigital' ); ?></button>
            <?php endif; ?>
        </td>
    </tr>
    <?php
}

// =============================================================================
// Service Meta Box
// =============================================================================

function ondigital_service_meta_callback( $post ) {
    wp_nonce_field( 'ondigital_service_meta', 'ondigital_service_meta_nonce' );
    $icon_id     = get_post_meta( $post->ID, '_service_icon', true );
    $hero_img_id = get_post_meta( $post->ID, '_service_hero_image', true );
    $features    = get_post_meta( $post->ID, '_service_features', true );
    ?>
    <table class="form-table">
        <?php od_mb_image( '_service_hero_image', __( 'Hero Image', 'ondigital' ), $hero_img_id ); ?>
        <?php od_mb_image( '_service_icon', __( 'Service Icon (small)', 'ondigital' ), $icon_id ); ?>
        <?php
        od_mb_text( '_service_stat_number', __( 'Hero Stat Number', 'ondigital' ), get_post_meta( $post->ID, '_service_stat_number', true ), __( 'e.g. +240%', 'ondigital' ) );
        od_mb_text( '_service_stat_label',  __( 'Hero Stat Label',  'ondigital' ), get_post_meta( $post->ID, '_service_stat_label',  true ), __( 'e.g. Üzvi trafik artımı', 'ondigital' ) );
        od_mb_text( '_service_hero_badge',     __( 'Hero Badge / Eyebrow', 'ondigital' ),  get_post_meta( $post->ID, '_service_hero_badge', true ),     __( 'e.g. Ondigital — Xidmət', 'ondigital' ) );
        od_mb_text( '_service_hero_btn1_text', __( 'Primary Button — Text', 'ondigital' ), get_post_meta( $post->ID, '_service_hero_btn1_text', true ), __( 'e.g. Başlayaq', 'ondigital' ) );
        od_mb_text( '_service_hero_btn1_url',  __( 'Primary Button — Link', 'ondigital' ), get_post_meta( $post->ID, '_service_hero_btn1_url', true ),  __( 'e.g. /elaqe/ or full https:// link', 'ondigital' ) );
        od_mb_text( '_service_hero_btn2_text', __( 'Ghost Button — Text', 'ondigital' ),   get_post_meta( $post->ID, '_service_hero_btn2_text', true ), __( 'e.g. Prosesi gör', 'ondigital' ) );
        od_mb_text( '_service_hero_btn2_url',  __( 'Ghost Button — Link', 'ondigital' ),   get_post_meta( $post->ID, '_service_hero_btn2_url', true ),  __( 'e.g. #ss-process (scrolls to process) or /elaqe/', 'ondigital' ) );
        ?>
        <tr>
            <th><label for="_service_features"><?php esc_html_e( 'Feature List', 'ondigital' ); ?></label></th>
            <td>
                <textarea name="_service_features" id="_service_features" rows="7" class="large-text"><?php echo esc_textarea( $features ); ?></textarea>
                <p class="description"><?php esc_html_e( 'One feature per line.', 'ondigital' ); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

// =============================================================================
// Service — Highlights Cards
// =============================================================================

function ondigital_service_highlights_callback( $post ) {
    wp_nonce_field( 'ondigital_service_highlights', 'ondigital_service_highlights_nonce' );
    $id = $post->ID;
    ?>
    <table class="form-table">
        <?php od_mb_text( '_service_highlights_title', __( 'Section Title', 'ondigital' ), get_post_meta( $id, '_service_highlights_title', true ), __( 'e.g. Dərin Audit və Strategiya', 'ondigital' ) ); ?>
    </table>
    <?php for ( $ci = 1; $ci <= 3; $ci++ ) : ?>
    <h4 style="padding:12px 12px 0;margin:0;"><?php printf( esc_html__( 'Card %d', 'ondigital' ), $ci ); ?></h4>
    <table class="form-table">
        <?php
        od_mb_text( "_service_card_{$ci}_title", __( 'Title', 'ondigital' ), get_post_meta( $id, "_service_card_{$ci}_title", true ), __( 'e.g. Texniki Audit', 'ondigital' ) );
        od_mb_textarea( "_service_card_{$ci}_desc", __( 'Description', 'ondigital' ), get_post_meta( $id, "_service_card_{$ci}_desc", true ), __( 'Short description…', 'ondigital' ) );
        od_mb_text( "_service_card_{$ci}_icon", __( 'Font Awesome Icon Class', 'ondigital' ), get_post_meta( $id, "_service_card_{$ci}_icon", true ), __( 'e.g. fa-chart-line', 'ondigital' ) );
        ?>
    </table>
    <?php endfor;
}

// =============================================================================
// Service — Process Steps
// =============================================================================

function ondigital_service_process_callback( $post ) {
    wp_nonce_field( 'ondigital_service_process', 'ondigital_service_process_nonce' );
    $id    = $post->ID;
    $steps = get_post_meta( $id, '_service_steps', true );
    if ( ! is_array( $steps ) || empty( $steps ) ) {
        $steps = array_fill( 0, 4, array( 'title_az' => '', 'title_en' => '', 'desc_az' => '', 'desc_en' => '', 'duration' => '' ) );
    }
    ?>
    <table class="form-table">
        <?php
        od_mb_text( '_service_process_eyebrow', __( 'Eyebrow Label', 'ondigital' ), get_post_meta( $id, '_service_process_eyebrow', true ), __( 'e.g. İş Prosesi', 'ondigital' ) );
        od_mb_text( '_service_process_heading', __( 'Heading', 'ondigital' ),       get_post_meta( $id, '_service_process_heading', true ), __( 'e.g. Necə işləyirik', 'ondigital' ) );
        ?>
    </table>

    <style>
    .od-step-toggle { border:1px solid #ddd; border-radius:4px; margin-bottom:8px; background:#fff; overflow:hidden; }
    .od-step-toggle-head { display:flex; align-items:center; gap:8px; padding:10px 12px; cursor:pointer; background:#f9f9f9; user-select:none; }
    .od-step-toggle-head:hover { background:#f0f0f0; }
    .od-step-toggle-num { font-size:11px; font-weight:700; background:#2271b1; color:#fff; border-radius:3px; padding:2px 7px; flex-shrink:0; }
    .od-step-toggle-title { font-size:13px; font-weight:600; color:#1d2327; flex:1; min-width:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .od-step-toggle-title em { font-weight:400; color:#999; font-style:normal; }
    .od-step-chevron { margin-left:auto; font-size:12px; color:#666; transition:transform .2s; flex-shrink:0; }
    .od-step-toggle.open .od-step-chevron { transform:rotate(180deg); }
    .od-step-toggle-body { display:none; padding:12px; border-top:1px solid #eee; }
    .od-step-toggle.open .od-step-toggle-body { display:block; }
    .od-remove-step { background:none; border:none; color:#a00; cursor:pointer; font-size:18px; line-height:1; padding:0 4px; flex-shrink:0; }
    .od-remove-step:hover { color:#dc3232; }
    </style>

    <div id="service-steps-repeater" style="margin-top:12px;">
        <?php foreach ( $steps as $i => $step ) :
            $preview = ! empty( $step['title_az'] ) ? esc_html( $step['title_az'] ) : '<em>' . esc_html__( 'untitled', 'ondigital' ) . '</em>';
        ?>
        <div class="od-step-toggle<?php echo $i === 0 ? ' open' : ''; ?>">
            <div class="od-step-toggle-head">
                <span class="od-step-toggle-num"><?php esc_html_e( 'Step', 'ondigital' ); ?> <span class="step-num"><?php echo $i + 1; ?></span></span>
                <span class="od-step-toggle-title"><?php echo $preview; ?></span>
                <span class="od-step-chevron">&#9660;</span>
                <button type="button" class="od-remove-step" title="<?php esc_attr_e( 'Remove', 'ondigital' ); ?>">×</button>
            </div>
            <div class="od-step-toggle-body">
                <table class="form-table" style="margin:0;">
                    <tr>
                        <th style="width:180px;padding:6px 10px;"><?php esc_html_e( 'Title (AZ)', 'ondigital' ); ?></th>
                        <td style="padding:6px 10px;"><input type="text" name="_service_steps[<?php echo $i; ?>][title_az]" value="<?php echo esc_attr( $step['title_az'] ?? '' ); ?>" class="regular-text od-step-title-az" placeholder="<?php esc_attr_e( 'e.g. Kəşfiyyat', 'ondigital' ); ?>"></td>
                    </tr>
                    <tr>
                        <th style="padding:6px 10px;"><?php esc_html_e( 'Title (EN)', 'ondigital' ); ?></th>
                        <td style="padding:6px 10px;"><input type="text" name="_service_steps[<?php echo $i; ?>][title_en]" value="<?php echo esc_attr( $step['title_en'] ?? '' ); ?>" class="regular-text" placeholder="<?php esc_attr_e( 'e.g. Discovery', 'ondigital' ); ?>"></td>
                    </tr>
                    <tr>
                        <th style="padding:6px 10px;"><?php esc_html_e( 'Description (AZ)', 'ondigital' ); ?></th>
                        <td style="padding:6px 10px;"><textarea name="_service_steps[<?php echo $i; ?>][desc_az]" rows="3" class="large-text" placeholder="<?php esc_attr_e( 'Description in Azerbaijani', 'ondigital' ); ?>"><?php echo esc_textarea( $step['desc_az'] ?? '' ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th style="padding:6px 10px;"><?php esc_html_e( 'Description (EN)', 'ondigital' ); ?></th>
                        <td style="padding:6px 10px;"><textarea name="_service_steps[<?php echo $i; ?>][desc_en]" rows="3" class="large-text" placeholder="<?php esc_attr_e( 'Description in English', 'ondigital' ); ?>"><?php echo esc_textarea( $step['desc_en'] ?? '' ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th style="padding:6px 10px;"><?php esc_html_e( 'Duration', 'ondigital' ); ?></th>
                        <td style="padding:6px 10px;"><input type="text" name="_service_steps[<?php echo $i; ?>][duration]" value="<?php echo esc_attr( $step['duration'] ?? '' ); ?>" class="regular-text" placeholder="<?php esc_attr_e( 'e.g. Week 1–2', 'ondigital' ); ?>"></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <p><button type="button" id="add-service-step" class="button button-secondary">+ <?php esc_html_e( 'Add Step', 'ondigital' ); ?></button></p>
    <script>
    (function(){
        var container = document.getElementById('service-steps-repeater');
        var addBtn    = document.getElementById('add-service-step');

        function reindex() {
            container.querySelectorAll('.od-step-toggle').forEach(function(row, i) {
                row.querySelector('.step-num').textContent = i + 1;
                row.querySelectorAll('[name]').forEach(function(el) {
                    el.name = el.name.replace(/_service_steps\[\d+\]/, '_service_steps[' + i + ']');
                });
            });
        }

        function updatePreview(row) {
            var titleInput = row.querySelector('.od-step-title-az');
            var titleEl    = row.querySelector('.od-step-toggle-title');
            if (!titleInput || !titleEl) return;
            titleEl.innerHTML = titleInput.value.trim() || '<em><?php esc_html_e( 'untitled', 'ondigital' ); ?></em>';
        }

        container.addEventListener('input', function(e) {
            if (e.target.classList.contains('od-step-title-az')) {
                updatePreview(e.target.closest('.od-step-toggle'));
            }
        });

        container.addEventListener('click', function(e) {
            if (e.target.closest('.od-remove-step')) {
                if (container.querySelectorAll('.od-step-toggle').length > 1) {
                    e.target.closest('.od-step-toggle').remove();
                    reindex();
                }
                return;
            }
            var head = e.target.closest('.od-step-toggle-head');
            if (head) {
                head.closest('.od-step-toggle').classList.toggle('open');
            }
        });

        addBtn.addEventListener('click', function() {
            var idx = container.querySelectorAll('.od-step-toggle').length;
            var row = document.createElement('div');
            row.className = 'od-step-toggle open';
            row.innerHTML =
                '<div class="od-step-toggle-head">' +
                    '<span class="od-step-toggle-num"><?php esc_html_e( 'Step', 'ondigital' ); ?> <span class="step-num">' + (idx + 1) + '</span></span>' +
                    '<span class="od-step-toggle-title"><em><?php esc_html_e( 'untitled', 'ondigital' ); ?></em></span>' +
                    '<span class="od-step-chevron">&#9660;</span>' +
                    '<button type="button" class="od-remove-step" title="<?php esc_attr_e( 'Remove', 'ondigital' ); ?>">×</button>' +
                '</div>' +
                '<div class="od-step-toggle-body">' +
                    '<table class="form-table" style="margin:0;">' +
                        '<tr><th style="width:180px;padding:6px 10px;"><?php esc_html_e( 'Title (AZ)', 'ondigital' ); ?></th><td style="padding:6px 10px;"><input type="text" name="_service_steps[' + idx + '][title_az]" value="" class="regular-text od-step-title-az" placeholder="<?php esc_attr_e( 'e.g. Kəşfiyyat', 'ondigital' ); ?>"></td></tr>' +
                        '<tr><th style="padding:6px 10px;"><?php esc_html_e( 'Title (EN)', 'ondigital' ); ?></th><td style="padding:6px 10px;"><input type="text" name="_service_steps[' + idx + '][title_en]" value="" class="regular-text" placeholder="<?php esc_attr_e( 'e.g. Discovery', 'ondigital' ); ?>"></td></tr>' +
                        '<tr><th style="padding:6px 10px;"><?php esc_html_e( 'Description (AZ)', 'ondigital' ); ?></th><td style="padding:6px 10px;"><textarea name="_service_steps[' + idx + '][desc_az]" rows="3" class="large-text" placeholder="<?php esc_attr_e( 'Description in Azerbaijani', 'ondigital' ); ?>"></textarea></td></tr>' +
                        '<tr><th style="padding:6px 10px;"><?php esc_html_e( 'Description (EN)', 'ondigital' ); ?></th><td style="padding:6px 10px;"><textarea name="_service_steps[' + idx + '][desc_en]" rows="3" class="large-text" placeholder="<?php esc_attr_e( 'Description in English', 'ondigital' ); ?>"></textarea></td></tr>' +
                        '<tr><th style="padding:6px 10px;"><?php esc_html_e( 'Duration', 'ondigital' ); ?></th><td style="padding:6px 10px;"><input type="text" name="_service_steps[' + idx + '][duration]" value="" class="regular-text" placeholder="<?php esc_attr_e( 'e.g. Week 1–2', 'ondigital' ); ?>"></td></tr>' +
                    '</table>' +
                '</div>';
            container.appendChild(row);
            row.querySelector('.od-step-title-az').focus();
        });
    })();
    </script>
    <?php
}

// =============================================================================
// Service — CTA Sections
// =============================================================================

function ondigital_service_cta_callback( $post ) {
    wp_nonce_field( 'ondigital_service_cta', 'ondigital_service_cta_nonce' );
    $id = $post->ID;
    ?>
    <table class="form-table">
        <?php
        od_mb_text( '_service_footer_cta_eyebrow', __( 'Eyebrow (small label)', 'ondigital' ), get_post_meta( $id, '_service_footer_cta_eyebrow', true ), __( 'e.g. Növbəti addım', 'ondigital' ) );
        od_mb_text( '_service_footer_cta_title', __( 'Title', 'ondigital' ),    get_post_meta( $id, '_service_footer_cta_title', true ), __( 'e.g. Layihənizi birlikdə qurmağa hazırıq', 'ondigital' ) );
        od_mb_text( '_service_footer_cta_sub',   __( 'Subtitle', 'ondigital' ), get_post_meta( $id, '_service_footer_cta_sub',   true ), __( 'e.g. Bizimlə əlaqə saxlayın, pulsuz məsləhət alın.', 'ondigital' ) );
        od_mb_text( '_service_footer_cta_perk1', __( 'Perk 1', 'ondigital' ), get_post_meta( $id, '_service_footer_cta_perk1', true ), __( 'e.g. Pulsuz ilkin məsləhət', 'ondigital' ) );
        od_mb_text( '_service_footer_cta_perk2', __( 'Perk 2', 'ondigital' ), get_post_meta( $id, '_service_footer_cta_perk2', true ), __( 'e.g. 24 saat ərzində cavab', 'ondigital' ) );
        od_mb_text( '_service_footer_cta_perk3', __( 'Perk 3', 'ondigital' ), get_post_meta( $id, '_service_footer_cta_perk3', true ), __( 'e.g. Hər biznesə fərdi yanaşma', 'ondigital' ) );
        ?>
    </table>
    <?php
}

// =============================================================================
// Service — What's Included & Roadmap
// =============================================================================

function ondigital_service_included_callback( $post ) {
    wp_nonce_field( 'ondigital_service_included', 'ondigital_service_included_nonce' );
    $id = $post->ID;

    $wi_items = get_post_meta( $id, '_service_wi_items', true );
    if ( ! is_array( $wi_items ) ) $wi_items = array();
    while ( count( $wi_items ) < 6 ) $wi_items[] = array( 'title' => '', 'desc' => '' );

    $rm_items = get_post_meta( $id, '_service_rm_items', true );
    if ( ! is_array( $rm_items ) ) $rm_items = array();
    while ( count( $rm_items ) < 5 ) $rm_items[] = array( 'title' => '', 'desc' => '', 'prog' => '' );
    ?>
    <table class="form-table">
        <?php
        od_mb_text( '_service_wi_title',       __( 'Section Title', 'ondigital' ),       get_post_meta( $id, '_service_wi_title', true ),       __( 'e.g. Nə daxildir', 'ondigital' ) );
        od_mb_text( '_service_wi_header_desc', __( 'Header Description', 'ondigital' ),  get_post_meta( $id, '_service_wi_header_desc', true ),  __( 'Short intro below the title', 'ondigital' ) );
        od_mb_text( '_service_wi_tab1_label',  __( 'Tab 1 Label', 'ondigital' ),        get_post_meta( $id, '_service_wi_tab1_label', true ),  __( 'e.g. Nə daxildir', 'ondigital' ) );
        od_mb_text( '_service_wi_tab2_label',  __( 'Tab 2 Label', 'ondigital' ),        get_post_meta( $id, '_service_wi_tab2_label', true ),  __( 'e.g. Aylıq yol xəritəsi', 'ondigital' ) );

        // Per-service visibility toggles (default ON; only '0' hides).
        $wi_show_included = get_post_meta( $id, '_service_wi_show_included', true ) !== '0';
        $wi_show_roadmap  = get_post_meta( $id, '_service_wi_show_roadmap',  true ) !== '0';
        ?>
        <tr>
            <th><?php esc_html_e( 'Show tabs', 'ondigital' ); ?></th>
            <td>
                <label style="display:block;margin-bottom:6px;">
                    <input type="hidden" name="_service_wi_show_included" value="0">
                    <input type="checkbox" name="_service_wi_show_included" value="1" <?php checked( $wi_show_included ); ?>>
                    <?php esc_html_e( 'Show “What’s Included” tab', 'ondigital' ); ?>
                </label>
                <label style="display:block;">
                    <input type="hidden" name="_service_wi_show_roadmap" value="0">
                    <input type="checkbox" name="_service_wi_show_roadmap" value="1" <?php checked( $wi_show_roadmap ); ?>>
                    <?php esc_html_e( 'Show “Monthly Roadmap” tab', 'ondigital' ); ?>
                </label>
                <p class="description"><?php esc_html_e( 'Untick to hide a tab on this service. If both are unticked, the whole section is hidden.', 'ondigital' ); ?></p>
            </td>
        </tr>
        <?php
        ?>
    </table>

    <?php
    $wi_tab1 = get_post_meta( $id, '_service_wi_tab1_label', true ) ?: __( 'Nə daxildir', 'ondigital' );
    $wi_tab2 = get_post_meta( $id, '_service_wi_tab2_label', true ) ?: __( 'Aylıq yol xəritəsi', 'ondigital' );
    ?>

    <div class="od-mb-tabwrap" style="margin-top:8px;border-top:1px solid #ddd;padding-top:14px;">
        <div class="od-mb-tabs" style="display:flex;gap:6px;margin:0 0 12px;">
            <button type="button" class="button button-primary od-mb-tab" data-odtab="wi">
                <?php echo esc_html( $wi_tab1 ); ?>
            </button>
            <button type="button" class="button od-mb-tab" data-odtab="rm">
                <?php echo esc_html( $wi_tab2 ); ?>
            </button>
        </div>
        <p class="description" style="margin:0 0 10px;"><?php esc_html_e( 'Tab names come from the “Tab 1 Label” / “Tab 2 Label” fields above. Tab 1 holds up to 6 items, Tab 2 up to 5 phases.', 'ondigital' ); ?></p>

        <!-- Pane 1: Nə daxildir -->
        <div class="od-mb-pane" data-odpane="wi">
            <?php foreach ( $wi_items as $i => $item ) : ?>
            <h4 style="padding:10px 12px 0;margin:0;"><?php printf( esc_html__( 'Item %d', 'ondigital' ), $i + 1 ); ?></h4>
            <table class="form-table">
                <tr>
                    <th style="width:200px"><?php esc_html_e( 'Title', 'ondigital' ); ?></th>
                    <td><input type="text" name="_service_wi_items[<?php echo $i; ?>][title]" value="<?php echo esc_attr( $item['title'] ); ?>" class="regular-text" placeholder="<?php esc_attr_e( 'e.g. Texniki SEO Auditi', 'ondigital' ); ?>"></td>
                </tr>
                <tr>
                    <th><?php esc_html_e( 'Description', 'ondigital' ); ?></th>
                    <td><textarea name="_service_wi_items[<?php echo $i; ?>][desc]" rows="3" class="large-text" placeholder="<?php esc_attr_e( 'Short description…', 'ondigital' ); ?>"><?php echo esc_textarea( $item['desc'] ); ?></textarea></td>
                </tr>
            </table>
            <?php endforeach; ?>
        </div>

        <!-- Pane 2: Aylıq yol xəritəsi -->
        <div class="od-mb-pane" data-odpane="rm" style="display:none;">
            <?php foreach ( $rm_items as $i => $item ) : ?>
            <h4 style="padding:10px 12px 0;margin:0;"><?php printf( esc_html__( 'Phase %d', 'ondigital' ), $i + 1 ); ?></h4>
            <table class="form-table">
                <tr>
                    <th style="width:200px"><?php esc_html_e( 'Title', 'ondigital' ); ?></th>
                    <td><input type="text" name="_service_rm_items[<?php echo $i; ?>][title]" value="<?php echo esc_attr( $item['title'] ); ?>" class="regular-text" placeholder="<?php esc_attr_e( 'e.g. 1–2-ci Həftə — Audit', 'ondigital' ); ?>"></td>
                </tr>
                <tr>
                    <th><?php esc_html_e( 'Description', 'ondigital' ); ?></th>
                    <td><textarea name="_service_rm_items[<?php echo $i; ?>][desc]" rows="3" class="large-text" placeholder="<?php esc_attr_e( 'Phase description…', 'ondigital' ); ?>"><?php echo esc_textarea( $item['desc'] ); ?></textarea></td>
                </tr>
                <tr>
                    <th><?php esc_html_e( 'Progress %', 'ondigital' ); ?></th>
                    <td><input type="text" name="_service_rm_items[<?php echo $i; ?>][prog]" value="<?php echo esc_attr( $item['prog'] ); ?>" class="small-text" placeholder="<?php esc_attr_e( 'e.g. 55%', 'ondigital' ); ?>"></td>
                </tr>
            </table>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
    (function(){
        var wrap = document.currentScript.previousElementSibling;
        if ( ! wrap || ! wrap.classList.contains('od-mb-tabwrap') ) {
            wrap = document.querySelector('.od-mb-tabwrap');
        }
        if ( ! wrap ) return;
        var tabs  = wrap.querySelectorAll('.od-mb-tab');
        var panes = wrap.querySelectorAll('.od-mb-pane');
        tabs.forEach(function(tab){
            tab.addEventListener('click', function(){
                var key = this.getAttribute('data-odtab');
                tabs.forEach(function(t){ t.classList.remove('button-primary'); });
                this.classList.add('button-primary');
                panes.forEach(function(p){
                    p.style.display = ( p.getAttribute('data-odpane') === key ) ? '' : 'none';
                });
            });
        });
    })();
    </script>
    <?php
}

// =============================================================================
// Service — Who Is This For
// =============================================================================

function ondigital_service_wif_callback( $post ) {
    wp_nonce_field( 'ondigital_service_wif', 'ondigital_service_wif_nonce' );
    $id = $post->ID;

    $for_items = get_post_meta( $id, '_service_wif_for_items', true );
    if ( ! is_array( $for_items ) ) $for_items = array();
    while ( count( $for_items ) < 5 ) $for_items[] = array( 'title' => '', 'desc' => '' );

    $not_items = get_post_meta( $id, '_service_wif_not_items', true );
    if ( ! is_array( $not_items ) ) $not_items = array();
    while ( count( $not_items ) < 5 ) $not_items[] = array( 'title' => '', 'desc' => '' );
    ?>
    <table class="form-table">
        <?php
        od_mb_text( '_service_wif_title', __( 'Section Title', 'ondigital' ),   get_post_meta( $id, '_service_wif_title', true ), __( 'e.g. Bu xidmət kimə uyğundur?', 'ondigital' ) );
        od_mb_text( '_service_wif_sub',   __( 'Section Subtitle', 'ondigital' ), get_post_meta( $id, '_service_wif_sub', true ),   __( 'Short sentence below the title', 'ondigital' ) );
        od_mb_text( '_service_wif_for_label', __( 'Left Column Label (✓ for)', 'ondigital' ),  get_post_meta( $id, '_service_wif_for_label', true ), __( 'e.g. Bu xidmət sizin üçündür', 'ondigital' ) );
        od_mb_text( '_service_wif_not_label', __( 'Right Column Label (✗ not)', 'ondigital' ), get_post_meta( $id, '_service_wif_not_label', true ), __( 'e.g. Bu xidmət sizin üçün deyil', 'ondigital' ) );
        od_mb_text( '_service_wif_note_pre',      __( 'Bottom Note — text before link', 'ondigital' ), get_post_meta( $id, '_service_wif_note_pre', true ),      __( 'e.g. Əmin deyilsiniz?', 'ondigital' ) );
        od_mb_text( '_service_wif_note_link_text',__( 'Bottom Note — link text', 'ondigital' ),        get_post_meta( $id, '_service_wif_note_link_text', true ),__( 'e.g. Pulsuz məsləhət alın', 'ondigital' ) );
        od_mb_text( '_service_wif_note_link_url', __( 'Bottom Note — link URL', 'ondigital' ),         get_post_meta( $id, '_service_wif_note_link_url', true ), __( 'e.g. /elaqe/ or full https:// link', 'ondigital' ) );
        od_mb_text( '_service_wif_note_post',     __( 'Bottom Note — text after link', 'ondigital' ),  get_post_meta( $id, '_service_wif_note_post', true ),     __( 'e.g. — vəziyyətinizi birlikdə qiymətləndirək.', 'ondigital' ) );
        ?>
    </table>

    <h4 style="padding:14px 12px 4px;margin:0;border-top:1px solid #ddd;color:#2e7d32;"><?php esc_html_e( '— Bu xidmət sizin üçündür (up to 5)', 'ondigital' ); ?></h4>
    <?php foreach ( $for_items as $i => $item ) : ?>
    <h4 style="padding:10px 12px 0;margin:0;"><?php printf( esc_html__( 'Item %d', 'ondigital' ), $i + 1 ); ?></h4>
    <table class="form-table">
        <tr>
            <th style="width:200px"><?php esc_html_e( 'Title', 'ondigital' ); ?></th>
            <td><input type="text" name="_service_wif_for_items[<?php echo $i; ?>][title]" value="<?php echo esc_attr( $item['title'] ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><?php esc_html_e( 'Description', 'ondigital' ); ?></th>
            <td><textarea name="_service_wif_for_items[<?php echo $i; ?>][desc]" rows="2" class="large-text"><?php echo esc_textarea( $item['desc'] ); ?></textarea></td>
        </tr>
    </table>
    <?php endforeach; ?>

    <h4 style="padding:14px 12px 4px;margin:0;border-top:1px solid #ddd;color:#c62828;"><?php esc_html_e( '— Bu xidmət sizin üçün deyil (up to 5)', 'ondigital' ); ?></h4>
    <?php foreach ( $not_items as $i => $item ) : ?>
    <h4 style="padding:10px 12px 0;margin:0;"><?php printf( esc_html__( 'Item %d', 'ondigital' ), $i + 1 ); ?></h4>
    <table class="form-table">
        <tr>
            <th style="width:200px"><?php esc_html_e( 'Title', 'ondigital' ); ?></th>
            <td><input type="text" name="_service_wif_not_items[<?php echo $i; ?>][title]" value="<?php echo esc_attr( $item['title'] ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><?php esc_html_e( 'Description', 'ondigital' ); ?></th>
            <td><textarea name="_service_wif_not_items[<?php echo $i; ?>][desc]" rows="2" class="large-text"><?php echo esc_textarea( $item['desc'] ); ?></textarea></td>
        </tr>
    </table>
    <?php endforeach;
}

// =============================================================================
// Service — Glossary
// =============================================================================

function ondigital_service_glossary_callback( $post ) {
    wp_nonce_field( 'ondigital_service_glossary', 'ondigital_service_glossary_nonce' );
    $id = $post->ID;

    $terms = get_post_meta( $id, '_service_gl_terms', true );
    if ( ! is_array( $terms ) ) $terms = array();
    while ( count( $terms ) < 8 ) $terms[] = array( 'word' => '', 'def' => '' );
    ?>
    <table class="form-table">
        <?php
        od_mb_text( '_service_gl_title',       __( 'Section Title', 'ondigital' ),       get_post_meta( $id, '_service_gl_title', true ),       __( 'e.g. Lüğət', 'ondigital' ) );
        od_mb_text( '_service_gl_header_desc', __( 'Header Description', 'ondigital' ),  get_post_meta( $id, '_service_gl_header_desc', true ),  __( 'Short intro below the title', 'ondigital' ) );
        ?>
    </table>
    <h4 style="padding:14px 12px 4px;margin:0;border-top:1px solid #ddd;"><?php esc_html_e( '— Terms (up to 8)', 'ondigital' ); ?></h4>
    <?php foreach ( $terms as $i => $term ) : ?>
    <h4 style="padding:10px 12px 0;margin:0;"><?php printf( esc_html__( 'Term %d', 'ondigital' ), $i + 1 ); ?></h4>
    <table class="form-table">
        <tr>
            <th style="width:200px"><?php esc_html_e( 'Term / Word', 'ondigital' ); ?></th>
            <td><input type="text" name="_service_gl_terms[<?php echo $i; ?>][word]" value="<?php echo esc_attr( $term['word'] ); ?>" class="regular-text" placeholder="<?php esc_attr_e( 'e.g. Backlink', 'ondigital' ); ?>"></td>
        </tr>
        <tr>
            <th><?php esc_html_e( 'Definition', 'ondigital' ); ?></th>
            <td><textarea name="_service_gl_terms[<?php echo $i; ?>][def]" rows="2" class="large-text" placeholder="<?php esc_attr_e( 'Short definition…', 'ondigital' ); ?>"><?php echo esc_textarea( $term['def'] ); ?></textarea></td>
        </tr>
    </table>
    <?php endforeach;
}

// =============================================================================
// Service — FAQ
// =============================================================================

function ondigital_service_faq_callback( $post ) {
    wp_nonce_field( 'ondigital_service_faq', 'ondigital_service_faq_nonce' );
    $id = $post->ID;

    $faq_items = get_post_meta( $id, '_service_faq_items', true );
    if ( ! is_array( $faq_items ) ) {
        $faq_items = array();
    }
    ?>
    <table class="form-table">
        <?php
        od_mb_text( '_service_faq_panel_title', __( 'Left Panel Title', 'ondigital' ),       get_post_meta( $id, '_service_faq_panel_title', true ), __( 'e.g. Tez-tez soruşulan suallar', 'ondigital' ) );
        od_mb_text( '_service_faq_panel_desc',  __( 'Left Panel Description', 'ondigital' ), get_post_meta( $id, '_service_faq_panel_desc', true ),  __( 'Short text under the title', 'ondigital' ) );
        od_mb_text( '_service_faq_panel_btn_text', __( 'Button Text', 'ondigital' ),        get_post_meta( $id, '_service_faq_panel_btn_text', true ), __( 'e.g. Sualınız var?', 'ondigital' ) );
        od_mb_text( '_service_faq_panel_btn_url',  __( 'Button Link (URL)', 'ondigital' ),  get_post_meta( $id, '_service_faq_panel_btn_url', true ),  __( 'e.g. /elaqe/ or full https:// link', 'ondigital' ) );
        ?>
    </table>

    <style>
    .faq-mb-wrap { padding: 0 12px 12px; }
    .faq-mb-row { border: 1px solid #ddd; border-radius: 4px; margin: 6px 0; overflow: hidden; }
    .faq-mb-head {
        display: flex; align-items: center; gap: 10px; padding: 10px 14px;
        background: #f9f9f9; cursor: pointer; user-select: none;
        border-bottom: 1px solid transparent; transition: border-color .15s;
    }
    .faq-mb-row.open .faq-mb-head { border-bottom-color: #ddd; background: #f0f7ff; }
    .faq-mb-num { font-size: 11px; font-weight: 700; color: #999; min-width: 32px; }
    .faq-mb-q-preview { flex: 1; font-size: 13px; color: #3c3c3c; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .faq-mb-toggle { font-size: 16px; color: #999; margin-left: 4px; transition: transform .2s; }
    .faq-mb-row.open .faq-mb-toggle { transform: rotate(180deg); }
    .faq-mb-remove { background: none; border: none; color: #aaa; cursor: pointer; font-size: 18px; line-height: 1; padding: 0 4px; }
    .faq-mb-remove:hover { color: #c00; }
    .faq-mb-body { display: none; padding: 12px 14px 14px; }
    .faq-mb-row.open .faq-mb-body { display: block; }
    .faq-mb-body table { margin: 0; }
    .faq-mb-body .form-table th { width: 100px; }
    .faq-mb-add { margin: 10px 12px 0; }
    </style>

    <div class="faq-mb-wrap">
        <div id="faq-mb-rows">
            <?php foreach ( $faq_items as $i => $item ) : ?>
            <div class="faq-mb-row">
                <div class="faq-mb-head">
                    <span class="faq-mb-num"><?php printf( '#%d', $i + 1 ); ?></span>
                    <span class="faq-mb-q-preview"><?php echo esc_html( $item['q'] ?: __( '(sual daxil edilməyib)', 'ondigital' ) ); ?></span>
                    <span class="faq-mb-toggle">&#8964;</span>
                    <button type="button" class="faq-mb-remove" title="Remove">&times;</button>
                </div>
                <div class="faq-mb-body">
                    <table class="form-table">
                        <tr>
                            <th><?php esc_html_e( 'Question', 'ondigital' ); ?></th>
                            <td><input type="text" name="_service_faq_items[<?php echo $i; ?>][q]" value="<?php echo esc_attr( $item['q'] ); ?>" class="large-text faq-mb-q-input" placeholder="<?php esc_attr_e( 'e.g. Nə qədər müddətdə nəticə görəcəm?', 'ondigital' ); ?>"></td>
                        </tr>
                        <tr>
                            <th><?php esc_html_e( 'Answer', 'ondigital' ); ?></th>
                            <td><textarea name="_service_faq_items[<?php echo $i; ?>][a]" rows="3" class="large-text" placeholder="<?php esc_attr_e( 'Answer…', 'ondigital' ); ?>"><?php echo esc_textarea( $item['a'] ); ?></textarea></td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="button faq-mb-add" id="faq-mb-add">
            + <?php esc_html_e( 'Add Q&amp;A', 'ondigital' ); ?>
        </button>
    </div>

    <script>
    (function(){
        var wrap  = document.getElementById('faq-mb-rows');
        var addBtn = document.getElementById('faq-mb-add');
        var empty = <?php echo json_encode( __( '(sual daxil edilməyib)', 'ondigital' ) ); ?>;

        function getIndex( row ) {
            return Array.prototype.indexOf.call( wrap.children, row );
        }

        function reindex() {
            Array.prototype.forEach.call( wrap.children, function( row, idx ) {
                row.querySelector('.faq-mb-num').textContent = '#' + ( idx + 1 );
                row.querySelectorAll('[name]').forEach(function(el){
                    el.name = el.name.replace( /_service_faq_items\[\d+\]/, '_service_faq_items[' + idx + ']' );
                });
            });
        }

        function bindRow( row ) {
            var head    = row.querySelector('.faq-mb-head');
            var removeBtn = row.querySelector('.faq-mb-remove');
            var qInput  = row.querySelector('.faq-mb-q-input');
            var preview = row.querySelector('.faq-mb-q-preview');

            head.addEventListener('click', function(e){
                if ( e.target === removeBtn ) return;
                row.classList.toggle('open');
            });

            removeBtn.addEventListener('click', function(e){
                e.stopPropagation();
                if ( wrap.children.length === 1 || confirm( 'Remove this Q&A?' ) ) {
                    row.remove();
                    reindex();
                }
            });

            if ( qInput ) {
                qInput.addEventListener('input', function(){
                    preview.textContent = this.value || empty;
                });
            }
        }

        // Bind existing rows
        Array.prototype.forEach.call( wrap.children, bindRow );

        // Add new row
        addBtn.addEventListener('click', function(){
            var idx = wrap.children.length;
            var row = document.createElement('div');
            row.className = 'faq-mb-row open';
            row.innerHTML = '<div class="faq-mb-head">'
                + '<span class="faq-mb-num">#' + ( idx + 1 ) + '</span>'
                + '<span class="faq-mb-q-preview">' + empty + '</span>'
                + '<span class="faq-mb-toggle">&#8964;</span>'
                + '<button type="button" class="faq-mb-remove" title="Remove">&times;</button>'
                + '</div>'
                + '<div class="faq-mb-body">'
                + '<table class="form-table"><tr>'
                + '<th><?php esc_html_e( 'Question', 'ondigital' ); ?></th>'
                + '<td><input type="text" name="_service_faq_items[' + idx + '][q]" class="large-text faq-mb-q-input" placeholder="<?php esc_attr_e( 'e.g. Nə qədər müddətdə nəticə görəcəm?', 'ondigital' ); ?>"></td>'
                + '</tr><tr>'
                + '<th><?php esc_html_e( 'Answer', 'ondigital' ); ?></th>'
                + '<td><textarea name="_service_faq_items[' + idx + '][a]" rows="3" class="large-text" placeholder="<?php esc_attr_e( 'Answer…', 'ondigital' ); ?>"></textarea></td>'
                + '</tr></table>'
                + '</div>';
            wrap.appendChild( row );
            bindRow( row );
            row.querySelector('.faq-mb-q-input').focus();
        });
    })();
    </script>
    <?php
}

// =============================================================================
// Project — Hero
// =============================================================================

function ondigital_project_hero_callback( $post ) {
    wp_nonce_field( 'ondigital_project_all', 'ondigital_project_nonce' );
    $id = $post->ID;
    ?>
    <table class="form-table">
        <?php
        od_mb_text( '_od_tag',      __( 'Badge Text', 'ondigital' ),         get_post_meta( $id, '_od_tag', true ),      __( 'e.g. Case Study — Education · 2025', 'ondigital' ) );
        od_mb_text( '_od_title_main', __( 'Title Line 1', 'ondigital' ),     get_post_meta( $id, '_od_title_main', true ), __( 'e.g. Alas Academy', 'ondigital' ) );
        od_mb_text( '_od_title_hl',   __( 'Highlighted Word (green)', 'ondigital' ), get_post_meta( $id, '_od_title_hl', true ), __( 'e.g. Ondigital', 'ondigital' ) );
        od_mb_text( '_od_date',     __( 'Date', 'ondigital' ),               get_post_meta( $id, '_od_date', true ),     __( 'e.g. Jan – May 2025', 'ondigital' ) );
        od_mb_text( '_od_client',   __( 'Client', 'ondigital' ),             get_post_meta( $id, '_od_client', true ),   __( 'e.g. Alas Academy', 'ondigital' ) );
        od_mb_text( '_od_services', __( 'Services', 'ondigital' ),           get_post_meta( $id, '_od_services', true ), __( 'e.g. Web · SEO · Paid Ads · Email', 'ondigital' ) );
        od_mb_text( '_od_outcome',  __( 'Outcome', 'ondigital' ),            get_post_meta( $id, '_od_outcome', true ),  __( 'e.g. +340% Revenue · 4 months', 'ondigital' ) );
        od_mb_text( '_od_live_url', __( 'Live Site URL', 'ondigital' ),      get_post_meta( $id, '_od_live_url', true ), 'https://', 'url' );
        ?>
    </table>
    <?php
}

// =============================================================================
// Project — Full-Width Image
// =============================================================================

function ondigital_project_image_callback( $post ) {
    $id = $post->ID;
    ?>
    <table class="form-table">
        <?php od_mb_image( '_od_hero_image', __( 'Project Screenshot / Hero Image', 'ondigital' ), get_post_meta( $id, '_od_hero_image', true ) ); ?>
    </table>
    <?php
}

// =============================================================================
// Project — Results & Metrics
// =============================================================================

function ondigital_project_results_callback( $post ) {
    $id = $post->ID;
    ?>
    <table class="form-table">
        <?php
        od_mb_text(     '_od_results_title', __( 'Section Title', 'ondigital' ),       get_post_meta( $id, '_od_results_title', true ), __( 'e.g. Numbers that speak for themselves.', 'ondigital' ) );
        od_mb_textarea( '_od_results_desc',  __( 'Section Description', 'ondigital' ), get_post_meta( $id, '_od_results_desc', true ) );
        ?>
        <?php for ( $n = 1; $n <= 4; $n++ ) : ?>
        <tr><td colspan="2"><hr style="margin:8px 0"><strong><?php printf( esc_html__( 'Stat %d', 'ondigital' ), $n ); ?></strong></td></tr>
        <?php
            od_mb_text( "_od_stat{$n}_value",  sprintf( __( 'Stat %d — Value', 'ondigital' ), $n ),  get_post_meta( $id, "_od_stat{$n}_value", true ),  __( 'e.g. 340', 'ondigital' ) );
            od_mb_text( "_od_stat{$n}_suffix", sprintf( __( 'Stat %d — Suffix', 'ondigital' ), $n ), get_post_meta( $id, "_od_stat{$n}_suffix", true ), __( 'e.g. % or ×', 'ondigital' ) );
            od_mb_text( "_od_stat{$n}_label",  sprintf( __( 'Stat %d — Label', 'ondigital' ), $n ),  get_post_meta( $id, "_od_stat{$n}_label", true ),  __( 'e.g. Revenue growth in 4 months', 'ondigital' ) );
        ?>
        <?php endfor; ?>
    </table>
    <?php
}

// =============================================================================
// Project — Testimonial
// =============================================================================

function ondigital_project_testimonial_callback( $post ) {
    $id = $post->ID;
    ?>
    <table class="form-table">
        <?php
        od_mb_textarea( '_od_quote',          __( 'Quote Text', 'ondigital' ),     get_post_meta( $id, '_od_quote', true ) );
        od_mb_text(     '_od_author',         __( 'Author Name', 'ondigital' ),    get_post_meta( $id, '_od_author', true ),         __( 'e.g. Sara Khalil', 'ondigital' ) );
        od_mb_text(     '_od_author_role',    __( 'Author Role', 'ondigital' ),    get_post_meta( $id, '_od_author_role', true ),    __( 'e.g. Founder, Alas Academy', 'ondigital' ) );
        od_mb_text(     '_od_author_initials',__( 'Initials (avatar)', 'ondigital' ), get_post_meta( $id, '_od_author_initials', true ), __( 'e.g. SK', 'ondigital' ) );
        ?>
    </table>
    <?php
}

// =============================================================================
// Project — Process Steps
// =============================================================================

function ondigital_project_process_callback( $post ) {
    $id    = $post->ID;
    $steps = get_post_meta( $id, '_od_steps', true );
    if ( ! is_array( $steps ) || empty( $steps ) ) {
        $steps = array_fill( 0, 4, array( 'title_az' => '', 'title_en' => '', 'desc_az' => '', 'desc_en' => '', 'duration' => '' ) );
    }
    ?>
    <table class="form-table">
        <?php
        od_mb_text( '_od_process_eyebrow', __( 'Eyebrow Label', 'ondigital' ), get_post_meta( $id, '_od_process_eyebrow', true ), __( 'e.g. Our Process', 'ondigital' ) );
        od_mb_text( '_od_process_heading', __( 'Heading', 'ondigital' ),       get_post_meta( $id, '_od_process_heading', true ), __( 'e.g. How we made it happen.', 'ondigital' ) );
        ?>
    </table>

    <div id="od-steps-repeater" style="margin-top:12px;">
        <?php foreach ( $steps as $i => $step ) :
            $preview = ! empty( $step['title_az'] ) ? esc_html( $step['title_az'] ) : '<em>' . esc_html__( 'untitled', 'ondigital' ) . '</em>';
        ?>
        <div class="od-step-toggle<?php echo $i === 0 ? ' open' : ''; ?>">
            <div class="od-step-toggle-head">
                <span class="od-step-toggle-num"><?php esc_html_e( 'Step', 'ondigital' ); ?> <span class="step-num"><?php echo $i + 1; ?></span></span>
                <span class="od-step-toggle-title"><?php echo $preview; ?></span>
                <span class="od-step-chevron">&#9660;</span>
                <button type="button" class="od-remove-step" title="<?php esc_attr_e( 'Remove', 'ondigital' ); ?>">×</button>
            </div>
            <div class="od-step-toggle-body">
                <table class="form-table" style="margin:0;">
                    <tr>
                        <th style="width:180px;padding:6px 10px;"><?php esc_html_e( 'Title (AZ)', 'ondigital' ); ?></th>
                        <td style="padding:6px 10px;"><input type="text" name="_od_steps[<?php echo $i; ?>][title_az]" value="<?php echo esc_attr( $step['title_az'] ?? '' ); ?>" class="regular-text od-step-title-az" placeholder="<?php esc_attr_e( 'e.g. Kəşfiyyat', 'ondigital' ); ?>"></td>
                    </tr>
                    <tr>
                        <th style="padding:6px 10px;"><?php esc_html_e( 'Title (EN)', 'ondigital' ); ?></th>
                        <td style="padding:6px 10px;"><input type="text" name="_od_steps[<?php echo $i; ?>][title_en]" value="<?php echo esc_attr( $step['title_en'] ?? '' ); ?>" class="regular-text" placeholder="<?php esc_attr_e( 'e.g. Discovery', 'ondigital' ); ?>"></td>
                    </tr>
                    <tr>
                        <th style="padding:6px 10px;"><?php esc_html_e( 'Description (AZ)', 'ondigital' ); ?></th>
                        <td style="padding:6px 10px;"><textarea name="_od_steps[<?php echo $i; ?>][desc_az]" rows="3" class="large-text" placeholder="<?php esc_attr_e( 'Description in Azerbaijani', 'ondigital' ); ?>"><?php echo esc_textarea( $step['desc_az'] ?? '' ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th style="padding:6px 10px;"><?php esc_html_e( 'Description (EN)', 'ondigital' ); ?></th>
                        <td style="padding:6px 10px;"><textarea name="_od_steps[<?php echo $i; ?>][desc_en]" rows="3" class="large-text" placeholder="<?php esc_attr_e( 'Description in English', 'ondigital' ); ?>"><?php echo esc_textarea( $step['desc_en'] ?? '' ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th style="padding:6px 10px;"><?php esc_html_e( 'Duration', 'ondigital' ); ?></th>
                        <td style="padding:6px 10px;"><input type="text" name="_od_steps[<?php echo $i; ?>][duration]" value="<?php echo esc_attr( $step['duration'] ?? '' ); ?>" class="regular-text" placeholder="<?php esc_attr_e( 'e.g. Week 1–2', 'ondigital' ); ?>"></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <p><button type="button" id="add-od-step" class="button button-secondary">+ <?php esc_html_e( 'Add Step', 'ondigital' ); ?></button></p>
    <script>
    (function(){
        var container = document.getElementById('od-steps-repeater');
        var addBtn    = document.getElementById('add-od-step');

        function reindex() {
            container.querySelectorAll('.od-step-toggle').forEach(function(row, i) {
                row.querySelector('.step-num').textContent = i + 1;
                row.querySelectorAll('[name]').forEach(function(el) {
                    el.name = el.name.replace(/_od_steps\[\d+\]/, '_od_steps[' + i + ']');
                });
            });
        }

        function updatePreview(row) {
            var titleInput = row.querySelector('.od-step-title-az');
            var titleEl    = row.querySelector('.od-step-toggle-title');
            if (!titleInput || !titleEl) return;
            titleEl.innerHTML = titleInput.value.trim() || '<em><?php esc_html_e( 'untitled', 'ondigital' ); ?></em>';
        }

        container.addEventListener('input', function(e) {
            if (e.target.classList.contains('od-step-title-az')) {
                updatePreview(e.target.closest('.od-step-toggle'));
            }
        });

        container.addEventListener('click', function(e) {
            if (e.target.closest('.od-remove-step')) {
                if (container.querySelectorAll('.od-step-toggle').length > 1) {
                    e.target.closest('.od-step-toggle').remove();
                    reindex();
                }
                return;
            }
            var head = e.target.closest('.od-step-toggle-head');
            if (head) {
                head.closest('.od-step-toggle').classList.toggle('open');
            }
        });

        addBtn.addEventListener('click', function() {
            var idx = container.querySelectorAll('.od-step-toggle').length;
            var row = document.createElement('div');
            row.className = 'od-step-toggle open';
            row.innerHTML =
                '<div class="od-step-toggle-head">' +
                    '<span class="od-step-toggle-num"><?php esc_html_e( 'Step', 'ondigital' ); ?> <span class="step-num">' + (idx + 1) + '</span></span>' +
                    '<span class="od-step-toggle-title"><em><?php esc_html_e( 'untitled', 'ondigital' ); ?></em></span>' +
                    '<span class="od-step-chevron">&#9660;</span>' +
                    '<button type="button" class="od-remove-step" title="<?php esc_attr_e( 'Remove', 'ondigital' ); ?>">×</button>' +
                '</div>' +
                '<div class="od-step-toggle-body">' +
                    '<table class="form-table" style="margin:0;">' +
                        '<tr><th style="width:180px;padding:6px 10px;"><?php esc_html_e( 'Title (AZ)', 'ondigital' ); ?></th><td style="padding:6px 10px;"><input type="text" name="_od_steps[' + idx + '][title_az]" value="" class="regular-text od-step-title-az" placeholder="<?php esc_attr_e( 'e.g. Kəşfiyyat', 'ondigital' ); ?>"></td></tr>' +
                        '<tr><th style="padding:6px 10px;"><?php esc_html_e( 'Title (EN)', 'ondigital' ); ?></th><td style="padding:6px 10px;"><input type="text" name="_od_steps[' + idx + '][title_en]" value="" class="regular-text" placeholder="<?php esc_attr_e( 'e.g. Discovery', 'ondigital' ); ?>"></td></tr>' +
                        '<tr><th style="padding:6px 10px;"><?php esc_html_e( 'Description (AZ)', 'ondigital' ); ?></th><td style="padding:6px 10px;"><textarea name="_od_steps[' + idx + '][desc_az]" rows="3" class="large-text" placeholder="<?php esc_attr_e( 'Description in Azerbaijani', 'ondigital' ); ?>"></textarea></td></tr>' +
                        '<tr><th style="padding:6px 10px;"><?php esc_html_e( 'Description (EN)', 'ondigital' ); ?></th><td style="padding:6px 10px;"><textarea name="_od_steps[' + idx + '][desc_en]" rows="3" class="large-text" placeholder="<?php esc_attr_e( 'Description in English', 'ondigital' ); ?>"></textarea></td></tr>' +
                        '<tr><th style="padding:6px 10px;"><?php esc_html_e( 'Duration', 'ondigital' ); ?></th><td style="padding:6px 10px;"><input type="text" name="_od_steps[' + idx + '][duration]" value="" class="regular-text" placeholder="<?php esc_attr_e( 'e.g. Week 1–2', 'ondigital' ); ?>"></td></tr>' +
                    '</table>' +
                '</div>';
            container.appendChild(row);
            row.querySelector('.od-step-title-az').focus();
        });
    })();
    </script>
    <?php
}

// =============================================================================
// Project — Gallery
// =============================================================================

function ondigital_project_gallery_callback( $post ) {
    $id = $post->ID;
    ?>
    <table class="form-table">
        <?php for ( $n = 1; $n <= 3; $n++ ) : ?>
            <?php od_mb_image( "_od_gallery_{$n}", sprintf( __( 'Gallery Image %d', 'ondigital' ), $n ), get_post_meta( $id, "_od_gallery_{$n}", true ) ); ?>
        <?php endfor; ?>
    </table>
    <?php
}

// =============================================================================
// Project — Archive Card
// =============================================================================

function ondigital_project_archive_card_callback( $post ) {
    $id = $post->ID;
    ?>
    <p class="description" style="padding:0 12px 8px;"><?php esc_html_e( 'These fields appear on the projects archive grid card.', 'ondigital' ); ?></p>
    <table class="form-table">
        <?php
        od_mb_image( '_project_client_logo', __( 'Client Logo (shown on card header)', 'ondigital' ), get_post_meta( $id, '_project_client_logo', true ) );
        od_mb_text( 'project_result_number', __( 'Result Number', 'ondigital' ),  get_post_meta( $id, 'project_result_number', true ), __( 'e.g. +340%', 'ondigital' ) );
        od_mb_text( 'project_result_label',  __( 'Result Label', 'ondigital' ),   get_post_meta( $id, 'project_result_label', true ),  __( 'e.g. Gəlir artımı', 'ondigital' ) );
        od_mb_text( 'project_result_sub',    __( 'Result Subtitle', 'ondigital' ), get_post_meta( $id, 'project_result_sub', true ),    __( 'e.g. 4 ayda', 'ondigital' ) );
        ?>
    </table>
    <?php
}

// =============================================================================
// Team Member Meta Box
// =============================================================================

function ondigital_team_meta_callback( $post ) {
    wp_nonce_field( 'ondigital_team_meta', 'ondigital_team_meta_nonce' );
    $id = $post->ID;
    ?>
    <table class="form-table">
        <?php
        od_mb_text( '_team_role',      __( 'Job Title / Role', 'ondigital' ), get_post_meta( $id, '_team_role', true ) );
        od_mb_text( '_team_linkedin',  __( 'LinkedIn URL', 'ondigital' ),     get_post_meta( $id, '_team_linkedin', true ),  '', 'url' );
        od_mb_text( '_team_twitter',   __( 'Twitter URL', 'ondigital' ),      get_post_meta( $id, '_team_twitter', true ),   '', 'url' );
        od_mb_text( '_team_instagram', __( 'Instagram URL', 'ondigital' ),    get_post_meta( $id, '_team_instagram', true ), '', 'url' );
        od_mb_text( '_team_behance',   __( 'Behance URL', 'ondigital' ),      get_post_meta( $id, '_team_behance', true ),   '', 'url' );
        ?>
    </table>
    <?php
}

// =============================================================================
// Save Meta Boxes
// =============================================================================

add_action( 'save_post', 'ondigital_save_meta_boxes' );
function ondigital_save_meta_boxes( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( wp_is_post_revision( $post_id ) ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    if ( ! in_array( get_post_type( $post_id ), array( 'service', 'project', 'team_member' ), true ) ) return;

    // ── Service: base fields ──
    if ( isset( $_POST['ondigital_service_meta_nonce'] ) && wp_verify_nonce( $_POST['ondigital_service_meta_nonce'], 'ondigital_service_meta' ) ) {
        foreach ( array( '_service_icon', '_service_hero_image' ) as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, absint( $_POST[ $field ] ) );
            }
        }
        foreach ( array( '_service_stat_number', '_service_stat_label', '_service_hero_badge', '_service_hero_btn1_text', '_service_hero_btn2_text' ) as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
            }
        }
        foreach ( array( '_service_hero_btn1_url', '_service_hero_btn2_url' ) as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                // Allow in-page anchors (#ss-process) as well as URLs.
                $val = trim( wp_unslash( $_POST[ $field ] ) );
                update_post_meta( $post_id, $field, ( strpos( $val, '#' ) === 0 ) ? sanitize_text_field( $val ) : esc_url_raw( $val ) );
            }
        }
        if ( isset( $_POST['_service_features'] ) ) {
            update_post_meta( $post_id, '_service_features', sanitize_textarea_field( $_POST['_service_features'] ) );
        }
    }

    // ── Service: highlights ──
    if ( isset( $_POST['ondigital_service_highlights_nonce'] ) && wp_verify_nonce( $_POST['ondigital_service_highlights_nonce'], 'ondigital_service_highlights' ) ) {
        if ( isset( $_POST['_service_highlights_title'] ) ) {
            update_post_meta( $post_id, '_service_highlights_title', sanitize_text_field( $_POST['_service_highlights_title'] ) );
        }
        for ( $ci = 1; $ci <= 3; $ci++ ) {
            foreach ( array( 'title', 'icon' ) as $part ) {
                $key = "_service_card_{$ci}_{$part}";
                if ( isset( $_POST[ $key ] ) ) {
                    update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
                }
            }
            $desc_key = "_service_card_{$ci}_desc";
            if ( isset( $_POST[ $desc_key ] ) ) {
                update_post_meta( $post_id, $desc_key, sanitize_textarea_field( $_POST[ $desc_key ] ) );
            }
        }
    }

    // ── Service: process steps ──
    if ( isset( $_POST['ondigital_service_process_nonce'] ) && wp_verify_nonce( $_POST['ondigital_service_process_nonce'], 'ondigital_service_process' ) ) {
        foreach ( array( '_service_process_eyebrow', '_service_process_heading' ) as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
            }
        }
        if ( isset( $_POST['_service_steps'] ) && is_array( $_POST['_service_steps'] ) ) {
            $steps = array();
            foreach ( $_POST['_service_steps'] as $step ) {
                $steps[] = array(
                    'title_az' => sanitize_text_field( $step['title_az'] ?? '' ),
                    'title_en' => sanitize_text_field( $step['title_en'] ?? '' ),
                    'desc_az'  => sanitize_textarea_field( $step['desc_az'] ?? '' ),
                    'desc_en'  => sanitize_textarea_field( $step['desc_en'] ?? '' ),
                    'duration' => sanitize_text_field( $step['duration'] ?? '' ),
                );
            }
            update_post_meta( $post_id, '_service_steps', $steps );
        }
    }

    // ── Service: CTA sections ──
    if ( isset( $_POST['ondigital_service_cta_nonce'] ) && wp_verify_nonce( $_POST['ondigital_service_cta_nonce'], 'ondigital_service_cta' ) ) {
        foreach ( array( '_service_footer_cta_eyebrow', '_service_footer_cta_title', '_service_footer_cta_sub', '_service_footer_cta_perk1', '_service_footer_cta_perk2', '_service_footer_cta_perk3' ) as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
            }
        }
    }

    // ── Service: What's Included & Roadmap ──
    if ( isset( $_POST['ondigital_service_included_nonce'] ) && wp_verify_nonce( $_POST['ondigital_service_included_nonce'], 'ondigital_service_included' ) ) {
        foreach ( array( '_service_wi_title', '_service_wi_header_desc', '_service_wi_tab1_label', '_service_wi_tab2_label', '_service_wi_show_included', '_service_wi_show_roadmap' ) as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
            }
        }
        if ( isset( $_POST['_service_wi_items'] ) && is_array( $_POST['_service_wi_items'] ) ) {
            $items = array();
            foreach ( $_POST['_service_wi_items'] as $item ) {
                $items[] = array(
                    'title' => sanitize_text_field( $item['title'] ?? '' ),
                    'desc'  => sanitize_textarea_field( $item['desc'] ?? '' ),
                );
            }
            update_post_meta( $post_id, '_service_wi_items', $items );
        }
        if ( isset( $_POST['_service_rm_items'] ) && is_array( $_POST['_service_rm_items'] ) ) {
            $items = array();
            foreach ( $_POST['_service_rm_items'] as $item ) {
                $items[] = array(
                    'title' => sanitize_text_field( $item['title'] ?? '' ),
                    'desc'  => sanitize_textarea_field( $item['desc'] ?? '' ),
                    'prog'  => sanitize_text_field( $item['prog'] ?? '' ),
                );
            }
            update_post_meta( $post_id, '_service_rm_items', $items );
        }
    }

    // ── Service: Who Is This For ──
    if ( isset( $_POST['ondigital_service_wif_nonce'] ) && wp_verify_nonce( $_POST['ondigital_service_wif_nonce'], 'ondigital_service_wif' ) ) {
        foreach ( array( '_service_wif_title', '_service_wif_sub', '_service_wif_for_label', '_service_wif_not_label', '_service_wif_note_pre', '_service_wif_note_link_text', '_service_wif_note_post' ) as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
            }
        }
        if ( isset( $_POST['_service_wif_note_link_url'] ) ) {
            update_post_meta( $post_id, '_service_wif_note_link_url', esc_url_raw( $_POST['_service_wif_note_link_url'] ) );
        }
        foreach ( array( '_service_wif_for_items', '_service_wif_not_items' ) as $key ) {
            if ( isset( $_POST[ $key ] ) && is_array( $_POST[ $key ] ) ) {
                $items = array();
                foreach ( $_POST[ $key ] as $item ) {
                    $items[] = array(
                        'title' => sanitize_text_field( $item['title'] ?? '' ),
                        'desc'  => sanitize_textarea_field( $item['desc'] ?? '' ),
                    );
                }
                update_post_meta( $post_id, $key, $items );
            }
        }
    }

    // ── Service: Glossary ──
    if ( isset( $_POST['ondigital_service_glossary_nonce'] ) && wp_verify_nonce( $_POST['ondigital_service_glossary_nonce'], 'ondigital_service_glossary' ) ) {
        foreach ( array( '_service_gl_title', '_service_gl_header_desc' ) as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
            }
        }
        if ( isset( $_POST['_service_gl_terms'] ) && is_array( $_POST['_service_gl_terms'] ) ) {
            $terms = array();
            foreach ( $_POST['_service_gl_terms'] as $term ) {
                $terms[] = array(
                    'word' => sanitize_text_field( $term['word'] ?? '' ),
                    'def'  => sanitize_textarea_field( $term['def'] ?? '' ),
                );
            }
            update_post_meta( $post_id, '_service_gl_terms', $terms );
        }
    }

    // ── Service: FAQ ──
    if ( isset( $_POST['ondigital_service_faq_nonce'] ) && wp_verify_nonce( $_POST['ondigital_service_faq_nonce'], 'ondigital_service_faq' ) ) {
        foreach ( array( '_service_faq_panel_title', '_service_faq_panel_desc', '_service_faq_panel_btn_text' ) as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
            }
        }
        if ( isset( $_POST['_service_faq_panel_btn_url'] ) ) {
            update_post_meta( $post_id, '_service_faq_panel_btn_url', esc_url_raw( $_POST['_service_faq_panel_btn_url'] ) );
        }
        if ( isset( $_POST['_service_faq_items'] ) && is_array( $_POST['_service_faq_items'] ) ) {
            $items = array();
            foreach ( $_POST['_service_faq_items'] as $item ) {
                $items[] = array(
                    'q' => sanitize_text_field( $item['q'] ?? '' ),
                    'a' => sanitize_textarea_field( $item['a'] ?? '' ),
                );
            }
            update_post_meta( $post_id, '_service_faq_items', $items );
        }
    }

    // ── Project ──
    if ( isset( $_POST['ondigital_project_nonce'] ) && wp_verify_nonce( $_POST['ondigital_project_nonce'], 'ondigital_project_all' ) ) {

        // Text fields
        $text_fields = array(
            '_od_tag', '_od_title_main', '_od_title_hl',
            '_od_date', '_od_client', '_od_services', '_od_outcome',
            '_od_results_title', '_od_author', '_od_author_role', '_od_author_initials',
            '_od_process_eyebrow', '_od_process_heading',
            'project_result_number', 'project_result_label', 'project_result_sub',
        );
        foreach ( $text_fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
            }
        }

        // URL fields
        $url_fields = array( '_od_live_url' );
        foreach ( $url_fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, esc_url_raw( $_POST[ $field ] ) );
            }
        }

        // Textarea fields
        if ( isset( $_POST['_od_results_desc'] ) ) {
            update_post_meta( $post_id, '_od_results_desc', sanitize_textarea_field( $_POST['_od_results_desc'] ) );
        }
        if ( isset( $_POST['_od_quote'] ) ) {
            update_post_meta( $post_id, '_od_quote', sanitize_textarea_field( $_POST['_od_quote'] ) );
        }

        // Image IDs
        $image_fields = array( '_od_hero_image', '_od_gallery_1', '_od_gallery_2', '_od_gallery_3', '_project_client_logo' );
        foreach ( $image_fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, absint( $_POST[ $field ] ) );
            }
        }

        // Stats (4 sets)
        for ( $n = 1; $n <= 4; $n++ ) {
            foreach ( array( 'value', 'suffix', 'label' ) as $part ) {
                $key = "_od_stat{$n}_{$part}";
                if ( isset( $_POST[ $key ] ) ) {
                    update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
                }
            }
        }

        // Process steps
        if ( isset( $_POST['_od_steps'] ) && is_array( $_POST['_od_steps'] ) ) {
            $steps = array();
            foreach ( $_POST['_od_steps'] as $step ) {
                $steps[] = array(
                    'title_az' => sanitize_text_field( $step['title_az'] ?? '' ),
                    'title_en' => sanitize_text_field( $step['title_en'] ?? '' ),
                    'desc_az'  => sanitize_textarea_field( $step['desc_az'] ?? '' ),
                    'desc_en'  => sanitize_textarea_field( $step['desc_en'] ?? '' ),
                    'duration' => sanitize_text_field( $step['duration'] ?? '' ),
                );
            }
            update_post_meta( $post_id, '_od_steps', $steps );
        }
    }

    // ── Team member ──
    if ( isset( $_POST['ondigital_team_meta_nonce'] ) && wp_verify_nonce( $_POST['ondigital_team_meta_nonce'], 'ondigital_team_meta' ) ) {
        if ( isset( $_POST['_team_role'] ) ) {
            update_post_meta( $post_id, '_team_role', sanitize_text_field( $_POST['_team_role'] ) );
        }
        foreach ( array( '_team_linkedin', '_team_twitter', '_team_instagram', '_team_behance' ) as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, esc_url_raw( $_POST[ $field ] ) );
            }
        }
    }
}

// =============================================================================
// Enqueue admin scripts for media upload
// =============================================================================

add_action( 'admin_enqueue_scripts', 'ondigital_metabox_admin_scripts' );
function ondigital_metabox_admin_scripts( $hook ) {
    if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) return;
    $screen = get_current_screen();
    if ( ! $screen || ! in_array( $screen->post_type, array( 'service', 'project', 'team_member' ), true ) ) return;

    wp_enqueue_media();
    wp_add_inline_script( 'jquery', '
    jQuery(function($){
        $(document).on("click", ".od-upload-btn", function(e){
            e.preventDefault();
            var btn=$(this), target=$(btn.data("target")), preview=$(btn.data("preview"));
            var frame=wp.media({title:"Select Image",multiple:false,library:{type:"image"}});
            frame.on("select",function(){
                var att=frame.state().get("selection").first().toJSON();
                target.val(att.id);
                preview.html("<img src=\""+att.url+"\" style=\"max-width:200px;height:auto;display:block;border-radius:4px;\">");
            });
            frame.open();
        });
        $(document).on("click", ".od-remove-btn", function(e){
            e.preventDefault();
            var btn=$(this);
            $(btn.data("target")).val("");
            $(btn.data("preview")).html("");
        });
    });
    ' );
}
