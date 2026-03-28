<?php
/**
 * OnDigital Panel — Header Settings Section
 *
 * @package OnDigital
 * @var array $options  Loaded from get_option('ondigital_options')
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$langs = array( 'az' => '🇦🇿 AZ', 'en' => '🇬🇧 EN' );
?>
<div class="od-section active" data-section="header">

    <?php od_card_open( __( 'CTA Button', 'ondigital' ), 'dashicons-button' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_row_open(); ?>
                    <?php od_text( 'header_btn_text_' . $lang, __( 'Button Text', 'ondigital' ), $options, __( 'e.g. Başlayaq', 'ondigital' ) ); ?>
                    <?php od_url( 'header_btn_url_' . $lang, __( 'Button URL', 'ondigital' ), $options ); ?>
                <?php od_row_close(); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
    <?php od_card_close(); ?>

</div>
