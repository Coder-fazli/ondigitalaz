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

$langs = array( 'az' => '🇦🇿 AZ', 'en' => '🇬🇧 EN' );
?>
<div class="od-section active" data-section="service">

    <p style="color:#646970;font-size:13px;margin:0 0 20px;padding:12px 16px;background:#fff;border-left:4px solid #ffcd4d;border-radius:4px;">
        <?php esc_html_e( 'Individual service content (hero image, highlights, process steps, what\'s included, FAQ, etc.) is managed via meta boxes on each Service post in WordPress Admin → Services.', 'ondigital' ); ?>
    </p>

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
