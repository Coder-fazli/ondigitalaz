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

$langs = array( 'en' => '🇬🇧 EN', 'az' => '🇦🇿 AZ' );
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

        <?php
        $promo_disabled = isset( $options['promo_bar_enabled'] ) && ( $options['promo_bar_enabled'] === '0' || $options['promo_bar_enabled'] === 0 );
        ?>
        <div class="od-field" style="margin-bottom:20px;">
            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-weight:500;">
                <input type="checkbox" name="options[promo_bar_enabled]" value="1" <?php checked( ! $promo_disabled, true ); ?>>
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
                <div style="display:flex;gap:16px;margin-top:12px;">
                    <div class="od-field" style="flex:1;">
                        <label><?php esc_html_e( 'Meet Button Label', 'ondigital' ); ?></label>
                        <input type="text" autocomplete="off" name="options[promo_btn_meet_<?php echo esc_attr( $lang ); ?>]" value="<?php echo esc_attr( $options[ 'promo_btn_meet_' . $lang ] ?? '' ); ?>" placeholder="<?php echo $lang === 'az' ? 'Görüş' : 'Meet'; ?>" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;">
                    </div>
                    <div class="od-field" style="flex:1;">
                        <label><?php esc_html_e( 'Call Button Label', 'ondigital' ); ?></label>
                        <input type="text" autocomplete="off" name="options[promo_btn_call_<?php echo esc_attr( $lang ); ?>]" value="<?php echo esc_attr( $options[ 'promo_btn_call_' . $lang ] ?? '' ); ?>" placeholder="<?php echo $lang === 'az' ? 'Zəng' : 'Call'; ?>" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;">
                    </div>
                </div>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
        <p style="margin-top:8px;font-size:12px;color:#888;"><?php esc_html_e( 'Call button dials the phone number set in General → Contact Info.', 'ondigital' ); ?></p>

    <?php od_card_close(); ?>

</div>
