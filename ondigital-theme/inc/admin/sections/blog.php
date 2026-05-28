<?php
/**
 * OnDigital Panel — Blog / Materials Archive Section
 *
 * @package OnDigital
 * @var array $options  Loaded from get_option('ondigital_options')
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$langs = array( 'en' => '🇬🇧 EN', 'az' => '🇦🇿 AZ' );
?>
<div class="od-section active" data-section="blog">

    <!-- ── HERO ── -->
    <?php od_card_open( __( '1. Hero', 'ondigital' ), 'dashicons-admin-home' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'blog_hero_title_' . $lang,   __( 'Heading', 'ondigital' ),       $options, $lang === 'az' ? 'Həmişə düşünürük' : 'Always thinking' ); ?>
                <?php od_textarea( 'blog_hero_desc_' . $lang, __( 'Description', 'ondigital' ),   $options ); ?>
                <?php od_text( 'blog_counter1_label_' . $lang, __( 'Counter 1 Label', 'ondigital' ), $options, $lang === 'az' ? 'Ümumi məqalə' : 'Total articles' ); ?>
                <?php od_text( 'blog_counter2_label_' . $lang, __( 'Counter 2 Label', 'ondigital' ), $options, $lang === 'az' ? 'Blog yazarı' : 'Blog authors' ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
    <?php od_card_close(); ?>

    <!-- ── LATEST POSTS SECTION ── -->
    <?php od_card_open( __( '2. Latest Posts Section', 'ondigital' ), 'dashicons-list-view' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'blog_grid_title_' . $lang,       __( 'Section Heading', 'ondigital' ),   $options, $lang === 'az' ? 'Son yazılar' : 'Latest posts' ); ?>
                <?php od_textarea( 'blog_grid_desc_' . $lang,    __( 'Section Description', 'ondigital' ), $options ); ?>
                <?php od_text( 'blog_featured_tag_' . $lang,     __( 'Featured tag label', 'ondigital' ), $options, $lang === 'az' ? 'Seçilmiş Məqalə' : 'Featured Article' ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
    <?php od_card_close(); ?>

    <!-- ── SEO ── -->
    <?php od_card_open( __( '2. SEO', 'ondigital' ), 'dashicons-search' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'blog_meta_title_' . $lang,    __( 'Meta Title', 'ondigital' ),       $options ); ?>
                <?php od_textarea( 'blog_meta_desc_' . $lang, __( 'Meta Description', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
    <?php od_card_close(); ?>

</div>
