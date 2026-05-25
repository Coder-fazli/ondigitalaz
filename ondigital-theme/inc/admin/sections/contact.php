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
