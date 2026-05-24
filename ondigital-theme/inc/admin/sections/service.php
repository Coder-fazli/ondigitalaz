<?php
/**
 * OnDigital Panel — Services Archive Section
 *
 * @package OnDigital
 * @var array $options  Loaded from get_option('ondigital_options')
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$langs = array( 'en' => '🇬🇧 EN', 'az' => '🇦🇿 AZ' );
?>
<div class="od-section active" data-section="service">

    <p style="color:#646970;font-size:13px;margin:0 0 20px;padding:12px 16px;background:#fff;border-left:4px solid #ffcd4d;border-radius:4px;">
        <?php esc_html_e( 'Individual service content (hero image, highlights, process steps, what\'s included, FAQ, etc.) is managed via meta boxes on each Service post in WordPress Admin → Services.', 'ondigital' ); ?>
    </p>

    <!-- ── SERVICES GRID HEADER ── -->
    <?php od_card_open( __( 'Services Grid — Section Header', 'ondigital' ), 'dashicons-editor-textcolor' ); ?>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'services_grid_title_' . $lang, __( 'Section Title', 'ondigital' ), $options, __( 'e.g. Our exclusive services', 'ondigital' ) ); ?>
                <?php od_textarea( 'services_grid_body_' . $lang, __( 'Section Description', 'ondigital' ), $options, __( 'Short text on the right side of the title', 'ondigital' ) ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

    <?php od_card_close(); ?>

    <!-- ── SERVICES GRID CARDS ── -->
    <?php od_card_open( __( 'Services Grid Cards', 'ondigital' ), 'dashicons-grid-view' ); ?>

    <p style="color:#646970;font-size:13px;margin:0 0 16px;">4 columns shown on the services page. Each column: icon, title (EN+AZ), bullet items with optional links.</p>

    <?php $cards = get_option( 'ondigital_services_cards', array() ); ?>
    <div class="od-repeater" id="repeater-services_card">
    <?php foreach ( $cards as $ci => $card ) :
        $icon_id  = absint( $card['icon'] ?? 0 );
        $icon_url = $icon_id ? wp_get_attachment_image_url( $icon_id, 'thumbnail' ) : '';
        $items    = $card['items'] ?? array();
    ?>
        <div class="od-repeater-row od-sc-row">
            <div class="od-repeater-row-head od-sc-toggle" style="cursor:pointer;user-select:none;">
                <span><?php printf( 'Column %d — %s', $ci + 1, esc_html( $card['title_en'] ?? '' ) ); ?></span>
                <div class="od-row-actions">
                    <span class="od-sc-arrow" style="margin-right:8px;font-size:11px;opacity:.5;">▼</span>
                    <button type="button" class="od-remove-row">&times;</button>
                </div>
            </div>
            <div class="od-sc-body" style="display:none;">

            <div class="od-field">
                <label><?php esc_html_e( 'Icon', 'ondigital' ); ?></label>
                <div class="od-image-field">
                    <div class="od-image-preview <?php echo $icon_url ? '' : 'empty'; ?>">
                        <?php if ( $icon_url ) : ?><img src="<?php echo esc_url( $icon_url ); ?>"><?php endif; ?>
                    </div>
                    <div class="od-image-btns">
                        <input type="hidden" name="ondigital_services_cards[<?php echo $ci; ?>][icon]" value="<?php echo esc_attr( $icon_id ); ?>" class="od-img-id">
                        <button type="button" class="button od-upload-img">Select</button>
                        <button type="button" class="button od-remove-img">Remove</button>
                    </div>
                </div>
            </div>

            <div class="od-field-row">
                <div class="od-field">
                    <label>Title (EN)</label>
                    <input type="text" name="ondigital_services_cards[<?php echo $ci; ?>][title_en]" value="<?php echo esc_attr( $card['title_en'] ?? '' ); ?>">
                </div>
                <div class="od-field">
                    <label>Title (AZ)</label>
                    <input type="text" name="ondigital_services_cards[<?php echo $ci; ?>][title_az]" value="<?php echo esc_attr( $card['title_az'] ?? '' ); ?>">
                </div>
            </div>

            <div class="od-field-row">
                <div class="od-field">
                    <label>URL (EN)</label>
                    <input type="text" name="ondigital_services_cards[<?php echo $ci; ?>][url_en]" value="<?php echo esc_attr( $card['url_en'] ?? $card['url'] ?? '' ); ?>" placeholder="/services/seo/">
                </div>
                <div class="od-field">
                    <label>URL (AZ)</label>
                    <input type="text" name="ondigital_services_cards[<?php echo $ci; ?>][url_az]" value="<?php echo esc_attr( $card['url_az'] ?? '' ); ?>" placeholder="/az/services/seo/">
                </div>
            </div>

            <div class="od-field">
                <label style="font-weight:600;display:block;margin-bottom:8px;">Feature Items <small style="font-weight:400;color:#888;">(EN text · AZ text · URL EN · URL AZ)</small></label>
                <div class="od-sc-items" data-card="<?php echo $ci; ?>">
                <?php foreach ( $items as $ii => $item ) : ?>
                    <div class="od-sc-item" style="display:flex;gap:6px;align-items:center;margin-bottom:6px;flex-wrap:wrap;">
                        <input type="text" name="ondigital_services_cards[<?php echo $ci; ?>][items][<?php echo $ii; ?>][text_en]" value="<?php echo esc_attr( $item['text_en'] ?? '' ); ?>" placeholder="EN text" style="flex:1;min-width:100px;">
                        <input type="text" name="ondigital_services_cards[<?php echo $ci; ?>][items][<?php echo $ii; ?>][text_az]" value="<?php echo esc_attr( $item['text_az'] ?? '' ); ?>" placeholder="AZ text" style="flex:1;min-width:100px;">
                        <input type="text" name="ondigital_services_cards[<?php echo $ci; ?>][items][<?php echo $ii; ?>][url_en]" value="<?php echo esc_attr( $item['url_en'] ?? $item['url'] ?? '' ); ?>" placeholder="URL (EN)" style="width:130px;">
                        <input type="text" name="ondigital_services_cards[<?php echo $ci; ?>][items][<?php echo $ii; ?>][url_az]" value="<?php echo esc_attr( $item['url_az'] ?? '' ); ?>" placeholder="URL (AZ)" style="width:130px;">
                        <button type="button" class="od-sc-remove-item" style="color:#c00;background:none;border:none;cursor:pointer;font-size:18px;line-height:1;">&times;</button>
                    </div>
                <?php endforeach; ?>
                </div>
                <button type="button" class="button od-sc-add-item" data-card="<?php echo $ci; ?>">+ Add Item</button>
            </div>

            </div><!-- .od-sc-body -->
        </div>
    <?php endforeach; ?>
    </div>
    <button type="button" class="button od-add-row" data-repeater="services_card" style="margin-top:10px;">+ Add Column</button>

    <?php od_card_close(); ?>

    <!-- ── SERVICES PAGE HERO ── -->
    <?php od_card_open( __( 'Services Page — Hero', 'ondigital' ), 'dashicons-format-image' ); ?>

        <?php od_image( 'services_hero_thumb', __( 'Hero Image', 'ondigital' ), $options ); ?>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'services_hero_title_' . $lang, __( 'Hero Title', 'ondigital' ), $options, __( 'e.g. Rəqəmsal dünyada fərq yaradan dizayn', 'ondigital' ) ); ?>
                <?php od_textarea( 'services_hero_body_' . $lang, __( 'Hero Description', 'ondigital' ), $options, __( 'Short description below the title', 'ondigital' ) ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

    <?php od_card_close(); ?>

    <!-- ── ARCHIVE PAGE ── -->
    <?php od_card_open( __( 'Services Archive Page', 'ondigital' ), 'dashicons-admin-tools' ); ?>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'services_archive_title_' . $lang, __( 'Page Title', 'ondigital' ), $options, __( 'e.g. Xidmətlərimiz', 'ondigital' ) ); ?>
                <?php od_textarea( 'services_archive_desc_' . $lang, __( 'Page Description', 'ondigital' ), $options, __( 'Short intro below the title', 'ondigital' ) ); ?>
                <?php od_row_open(); ?>
                    <?php od_text( 'services_archive_badge_' . $lang, __( 'Badge / Eyebrow Text', 'ondigital' ), $options, __( 'e.g. Xidmətlər', 'ondigital' ) ); ?>
                    <?php od_text( 'services_archive_cta_' . $lang, __( 'CTA Button Text', 'ondigital' ), $options, __( 'e.g. Ətraflı bax', 'ondigital' ) ); ?>
                <?php od_row_close(); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

    <?php od_card_close(); ?>

    <!-- ── SINGLE SERVICE HERO DEFAULTS ── -->
    <?php od_card_open( __( 'Single Service — Hero Defaults', 'ondigital' ), 'dashicons-star-filled' ); ?>

        <p style="color:#646970;font-size:13px;margin:0 0 16px;"><?php esc_html_e( 'These are the global default texts shown in the hero section when a service post has no custom meta set.', 'ondigital' ); ?></p>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'service_hero_badge_' . $lang,      __( 'Hero Badge Text', 'ondigital' ),       $options, __( 'e.g. Ondigital — Xidmət', 'ondigital' ) ); ?>
                <?php od_text( 'service_hero_btn_primary_' . $lang, __( 'Primary Button Label', 'ondigital' ),  $options, __( 'e.g. Başlayaq', 'ondigital' ) ); ?>
                <?php od_text( 'service_hero_btn_ghost_' . $lang,   __( 'Ghost Button Label', 'ondigital' ),   $options, __( 'e.g. Prosesi gör', 'ondigital' ) ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

    <?php od_card_close(); ?>

    <!-- ── AGENCY BLOCK ── -->
    <?php od_card_open( __( 'Agency Block (image + title + description)', 'ondigital' ), 'dashicons-admin-home' ); ?>

        <?php od_row_open(); ?>
            <?php od_image( 'about_content_thumb', __( 'Main Image (left)', 'ondigital' ), $options ); ?>
            <?php od_image( 'about_content_bg',    __( 'Background Image (right panel)', 'ondigital' ), $options ); ?>
        <?php od_row_close(); ?>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text(     'about_content_title_'    . $lang, __( 'Title', 'ondigital' ),       $options, __( 'e.g. Sadə amma peşəkar səviyyədə agentlik', 'ondigital' ) ); ?>
                <?php od_textarea( 'about_content_body_'     . $lang, __( 'Description', 'ondigital' ), $options, __( 'Supports <span class="..."> for accent word', 'ondigital' ) ); ?>
                <?php od_row_open(); ?>
                    <?php od_text( 'about_content_btn_text_' . $lang, __( 'Button Text', 'ondigital' ), $options, __( 'e.g. Ətraflı', 'ondigital' ) ); ?>
                    <?php od_text( 'about_content_btn_url_'  . $lang, __( 'Button URL', 'ondigital' ),  $options, __( '/elaqe/', 'ondigital' ) ); ?>
                <?php od_row_close(); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

    <?php od_card_close(); ?>

    <!-- ── SEO ── -->
    <?php od_card_open( __( 'Archive Page SEO', 'ondigital' ), 'dashicons-search' ); ?>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'services_meta_title_' . $lang, __( 'Meta Title', 'ondigital' ), $options ); ?>
                <?php od_textarea( 'services_meta_desc_' . $lang, __( 'Meta Description', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

    <?php od_card_close(); ?>

</div>
