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

        <?php
        $use_popup = ! empty( $options['header_btn_popup'] );
        ?>
        <div class="od-field" style="margin-bottom:20px;">
            <label><?php esc_html_e( 'Button Action', 'ondigital' ); ?></label>
            <div style="display:flex;gap:12px;margin-top:6px;">
                <label style="display:flex;align-items:center;gap:7px;cursor:pointer;font-weight:500;">
                    <input type="radio" name="options[header_btn_popup]" value="1" <?php checked( $use_popup, true ); ?>>
                    <?php esc_html_e( 'Open contact popup', 'ondigital' ); ?>
                </label>
                <label style="display:flex;align-items:center;gap:7px;cursor:pointer;font-weight:500;">
                    <input type="radio" name="options[header_btn_popup]" value="0" <?php checked( $use_popup, false ); ?>>
                    <?php esc_html_e( 'Use URL below', 'ondigital' ); ?>
                </label>
            </div>
        </div>

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

    <?php od_card_open( __( 'Promo Bar', 'ondigital' ), 'dashicons-megaphone' ); ?>

        <div class="od-field" style="margin-bottom:20px;">
            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-weight:500;">
                <input type="checkbox" name="options[promo_bar_enabled]" value="1" <?php checked( ! empty( $options['promo_bar_enabled'] ), true ); ?>>
                <?php esc_html_e( 'Enable Promo Bar', 'ondigital' ); ?>
            </label>
        </div>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <div class="od-field">
                    <label><?php esc_html_e( 'Promo Message', 'ondigital' ); ?></label>
                    <textarea
                        name="options[promo_bar_text_<?php echo esc_attr( $lang ); ?>]"
                        placeholder="<?php esc_attr_e( 'e.g. Ready to talk to us?', 'ondigital' ); ?>"
                        style="width:100%;min-height:60px;padding:8px;border:1px solid #ddd;border-radius:4px;font-family:inherit;"
                    ><?php echo esc_textarea( $options[ 'promo_bar_text_' . $lang ] ?? '' ); ?></textarea>
                </div>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

    <?php od_card_close(); ?>

</div>
