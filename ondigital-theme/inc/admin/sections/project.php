<?php
/**
 * OnDigital Panel — Projects Archive Section
 *
 * @package OnDigital
 * @var array $options  Loaded from get_option('ondigital_options')
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$langs = array( 'en' => '🇬🇧 EN', 'az' => '🇦🇿 AZ' );
?>
<div class="od-section active" data-section="project">

    <p style="color:#646970;font-size:13px;margin:0 0 20px;padding:12px 16px;background:#fff;border-left:4px solid #ffcd4d;border-radius:4px;">
        <?php esc_html_e( 'Individual project content (hero, images, results, testimonial, process, gallery) is managed via meta boxes on each Project post in WordPress Admin → Projects.', 'ondigital' ); ?>
    </p>

    <!-- ── ARCHIVE PAGE ── -->
    <?php od_card_open( __( 'Projects Archive Page', 'ondigital' ), 'dashicons-portfolio' ); ?>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'projects_archive_title_' . $lang, __( 'Page Title', 'ondigital' ), $options, __( 'e.g. Our Projects', 'ondigital' ) ); ?>
                <?php od_textarea( 'projects_archive_desc_' . $lang, __( 'Page Description', 'ondigital' ), $options ); ?>
                <?php od_row_open(); ?>
                    <?php od_text( 'projects_archive_badge_' . $lang, __( 'Badge / Eyebrow Text', 'ondigital' ), $options, __( 'e.g. Case Studies', 'ondigital' ) ); ?>
                <?php od_row_close(); ?>
                <?php od_text( 'partners_title_' . $lang, __( 'Partners Section Title', 'ondigital' ), $options, __( 'e.g. Bizim tərəfdaşlarımız', 'ondigital' ) ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

    <?php od_card_close(); ?>

    <!-- ── SEO ── -->
    <?php od_card_open( __( 'Archive Page SEO', 'ondigital' ), 'dashicons-search' ); ?>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'projects_meta_title_' . $lang, __( 'Meta Title', 'ondigital' ), $options ); ?>
                <?php od_textarea( 'projects_meta_desc_' . $lang, __( 'Meta Description', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

    <?php od_card_close(); ?>

</div>
