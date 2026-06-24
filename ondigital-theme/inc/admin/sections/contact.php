<?php
/**
 * OnDigital Panel — Contact Page Section
 *
 * @package OnDigital
 * @var array $options  Loaded from get_option('ondigital_options')
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$langs = array( 'en' => '🇬🇧 EN', 'az' => '🇦🇿 AZ' );
?>
<div class="od-section active" data-section="contact">

    <!-- ── HERO ── -->
    <?php od_card_open( __( 'Hero Section', 'ondigital' ), 'dashicons-admin-home' ); ?>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'contact_badge_' . $lang, __( 'Badge / Eyebrow Text', 'ondigital' ), $options, __( 'e.g. Bizimlə əlaqə', 'ondigital' ) ); ?>
                <?php od_text( 'contact_title_' . $lang, __( 'Hero Title', 'ondigital' ), $options, __( 'You can use <em>text</em> for mint color', 'ondigital' ) ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

    <?php od_card_close(); ?>

    <!-- ── CONTACT SIDEBAR (INFO PANEL) ── -->
    <?php od_card_open( __( 'Contact Sidebar (Info Panel)', 'ondigital' ), 'dashicons-phone' ); ?>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'contact_info_title_'  . $lang, __( 'Panel Heading — line 1', 'ondigital' ),        $options, __( 'e.g. Əlaqə', 'ondigital' ) ); ?>
                <?php od_text( 'contact_info_title2_' . $lang, __( 'Panel Heading — line 2 (mint)', 'ondigital' ), $options, __( 'e.g. Məlumatları', 'ondigital' ) ); ?>
                <?php od_textarea( 'contact_info_desc_' . $lang, __( 'Panel Description', 'ondigital' ),           $options ); ?>
                <?php od_text( 'contact_address_' . $lang, __( 'Address', 'ondigital' ),                          $options, __( 'e.g. Bakı, Azərbaycan', 'ondigital' ) ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

        <?php od_divider(); ?>
        <?php od_row_open(); ?>
            <?php od_text( 'contact_phone', __( 'Phone Number', 'ondigital' ), $options, __( 'e.g. +994 50 123 45 67', 'ondigital' ) ); ?>
            <?php od_text( 'contact_email', __( 'Email Address', 'ondigital' ), $options, __( 'e.g. office@ondigital.az', 'ondigital' ) ); ?>
        <?php od_row_close(); ?>
        <p style="color:#646970;font-size:12px;margin:8px 0 0;"><?php esc_html_e( 'Social icons are managed in Appearance → Customize → Social Media Links.', 'ondigital' ); ?></p>

    <?php od_card_close(); ?>

    <!-- ── SEO ── -->
    <?php od_card_open( __( 'Page SEO', 'ondigital' ), 'dashicons-search' ); ?>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'contact_meta_title_' . $lang, __( 'Meta Title', 'ondigital' ), $options ); ?>
                <?php od_textarea( 'contact_meta_desc_' . $lang, __( 'Meta Description', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

    <?php od_card_close(); ?>

</div>
