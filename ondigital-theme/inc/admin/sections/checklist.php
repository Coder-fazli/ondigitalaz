<?php
/**
 * OnDigital Panel — Checklist Landing Page Section
 *
 * @package OnDigital
 * @var array $options  Loaded from get_option('ondigital_options')
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$langs = array( 'az' => '🇦🇿 AZ', 'en' => '🇬🇧 EN' );
?>
<div class="od-section active" data-section="checklist">

    <!-- ── ANNOUNCEMENT BAR ── -->
    <?php od_card_open( __( '1. Announcement Bar', 'ondigital' ), 'dashicons-megaphone' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'cl_topbar_text_' . $lang, __( 'Bold Label', 'ondigital' ), $options, __( 'e.g. Free download', 'ondigital' ) ); ?>
                <?php od_text( 'cl_topbar_note_' . $lang, __( 'Note Text', 'ondigital' ), $options, __( 'e.g. No credit card. No catch. Instant access.', 'ondigital' ) ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
    <?php od_card_close(); ?>

    <!-- ── HERO ── -->
    <?php od_card_open( __( '2. Hero', 'ondigital' ), 'dashicons-admin-home' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'cl_hero_kicker_' . $lang, __( 'Kicker Label', 'ondigital' ), $options, __( 'e.g. Free Resource — 2025 Edition', 'ondigital' ) ); ?>
                <?php od_text( 'cl_hero_h1_1_' . $lang, __( 'Headline Line 1', 'ondigital' ), $options, __( 'e.g. The digital marketing', 'ondigital' ) ); ?>
                <?php od_row_open(); ?>
                    <?php od_text( 'cl_hero_h1_2_' . $lang, __( 'Headline Line 2', 'ondigital' ), $options, __( 'e.g. checklist that', 'ondigital' ) ); ?>
                    <?php od_text( 'cl_hero_h1_hl_' . $lang, __( 'Highlighted Word', 'ondigital' ), $options, __( 'e.g. actually', 'ondigital' ) ); ?>
                <?php od_row_close(); ?>
                <?php od_text( 'cl_hero_h1_3_' . $lang, __( 'Headline Line 3', 'ondigital' ), $options, __( 'e.g. works.', 'ondigital' ) ); ?>
                <?php od_textarea( 'cl_hero_body_' . $lang, __( 'Body Text', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

        <?php od_divider(); ?>
        <p style="font-weight:600;margin:0 0 12px;font-size:13px;"><?php esc_html_e( 'Stats Bar', 'ondigital' ); ?></p>

        <?php
        $stat_defaults = array(
            1 => array( '150', '+', 'Businesses',     'Businesses' ),
            2 => array( '40',  '',  'Checklist items', 'Checklist items' ),
            3 => array( '8',   'x', 'Avg. client ROI', 'Avg. client ROI' ),
        );
        foreach ( $stat_defaults as $n => $d ) :
        ?>
        <div style="background:#f9f9f9;border:1px solid #e5e5e5;border-radius:6px;padding:14px 16px;margin-bottom:12px;">
            <p style="font-weight:600;font-size:12px;color:#666;margin:0 0 10px;text-transform:uppercase;letter-spacing:.05em;"><?php printf( esc_html__( 'Stat %d', 'ondigital' ), $n ); ?></p>
            <?php od_row_open(); ?>
                <?php od_text( 'cl_stat' . $n . '_num', __( 'Number', 'ondigital' ), $options, $d[0] ); ?>
                <?php od_text( 'cl_stat' . $n . '_sup', __( 'Suffix (e.g. + or x)', 'ondigital' ), $options, $d[1] ); ?>
            <?php od_row_close(); ?>
            <?php od_row_open(); ?>
                <?php od_text( 'cl_stat' . $n . '_lbl_az', '🇦🇿 ' . __( 'Label', 'ondigital' ), $options, $d[2] ); ?>
                <?php od_text( 'cl_stat' . $n . '_lbl_en', '🇬🇧 ' . __( 'Label', 'ondigital' ), $options, $d[3] ); ?>
            <?php od_row_close(); ?>
        </div>
        <?php endforeach; ?>

    <?php od_card_close(); ?>

    <!-- ── FORM CARD ── -->
    <?php od_card_open( __( '3. Form Card', 'ondigital' ), 'dashicons-email-alt' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'cl_form_title_' . $lang, __( 'Form Heading', 'ondigital' ), $options, __( 'e.g. Get instant access', 'ondigital' ) ); ?>
                <?php od_text( 'cl_form_subtitle_' . $lang, __( 'Form Subheading', 'ondigital' ), $options, __( 'e.g. We\'ll send it straight to your inbox.', 'ondigital' ) ); ?>
                <?php od_text( 'cl_form_btn_' . $lang, __( 'Submit Button Text', 'ondigital' ), $options, __( 'e.g. Send me the checklist', 'ondigital' ) ); ?>
                <?php od_divider(); ?>
                <?php od_text( 'cl_form_success_h_' . $lang, __( 'Success Heading', 'ondigital' ), $options, __( 'e.g. It\'s on its way.', 'ondigital' ) ); ?>
                <?php od_textarea( 'cl_form_success_p_' . $lang, __( 'Success Message', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
    <?php od_card_close(); ?>

    <!-- ── TESTIMONIAL ── -->
    <?php od_card_open( __( '4. Testimonial', 'ondigital' ), 'dashicons-format-quote' ); ?>
        <?php od_textarea( 'cl_testi_quote', __( 'Quote Text', 'ondigital' ), $options ); ?>
        <?php od_row_open(); ?>
            <?php od_text( 'cl_testi_name',     __( 'Name', 'ondigital' ), $options ); ?>
            <?php od_text( 'cl_testi_role',     __( 'Role / Company', 'ondigital' ), $options ); ?>
            <?php od_text( 'cl_testi_initials', __( 'Initials (avatar)', 'ondigital' ), $options, 'ES' ); ?>
        <?php od_row_close(); ?>
    <?php od_card_close(); ?>

    <!-- ── BOTTOM CTA ── -->
    <?php od_card_open( __( '5. Bottom CTA', 'ondigital' ), 'dashicons-arrow-right-alt' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'cl_bottom_h2_' . $lang,   __( 'Headline', 'ondigital' ), $options, __( 'e.g. Start with the right foundation.', 'ondigital' ) ); ?>
                <?php od_text( 'cl_bottom_em_' . $lang,   __( 'Italic Ending', 'ondigital' ), $options, __( 'e.g. It\'s free.', 'ondigital' ) ); ?>
                <?php od_text( 'cl_bottom_note_' . $lang, __( 'Note Text', 'ondigital' ), $options ); ?>
                <?php od_text( 'cl_bottom_btn_' . $lang,  __( 'Button Text', 'ondigital' ), $options, __( 'e.g. Get the checklist', 'ondigital' ) ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
    <?php od_card_close(); ?>

</div>
