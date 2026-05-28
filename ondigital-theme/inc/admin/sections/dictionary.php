<?php
/**
 * OnDigital Panel — Dictionary / Glossary Page Section
 *
 * @package OnDigital
 * @var array $options  Loaded from get_option('ondigital_options')
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$langs = array( 'en' => '🇬🇧 EN', 'az' => '🇦🇿 AZ' );
?>
<div class="od-section active" data-section="dictionary">

    <!-- ── PAGE CONTENT ── -->
    <?php od_card_open( __( '1. Page Content', 'ondigital' ), 'dashicons-book-alt' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'dict_page_title_' . $lang,  __( 'Page Title', 'ondigital' ),       $options, __( 'e.g. Sözlük', 'ondigital' ) ); ?>
                <?php od_textarea( 'dict_page_desc_' . $lang, __( 'Page Description', 'ondigital' ), $options ); ?>
                <?php od_text( 'dict_search_placeholder_' . $lang, __( 'Search Placeholder', 'ondigital' ), $options, __( 'e.g. Axtar...', 'ondigital' ) ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
    <?php od_card_close(); ?>

    <!-- ── SEO ── -->
    <?php od_card_open( __( '2. SEO', 'ondigital' ), 'dashicons-search' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'dict_meta_title_' . $lang,    __( 'Meta Title', 'ondigital' ),       $options ); ?>
                <?php od_textarea( 'dict_meta_desc_' . $lang, __( 'Meta Description', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
    <?php od_card_close(); ?>

</div>
