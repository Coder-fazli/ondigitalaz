<?php
/**
 * OnDigital Panel — Footer Section
 *
 * @package OnDigital
 * @var array $options  Loaded from get_option('ondigital_options')
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$langs = array( 'az' => '🇦🇿 AZ', 'en' => '🇬🇧 EN' );
?>
<div class="od-section active" data-section="footer">

    <!-- 1. Brand Column -->
    <?php od_card_open( __( '1. Brand & Partner', 'ondigital' ), 'dashicons-admin-appearance' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_textarea( 'footer_tagline_' . $lang, __( 'Tagline Text', 'ondigital' ), $options ); ?>
                <?php od_text( 'footer_partner_label_' . $lang, __( 'Partner Label (e.g. Partner with)', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
        <?php od_divider(); ?>
        <?php od_image( 'footer_partner_badge', __( 'Partner Badge Image', 'ondigital' ), $options ); ?>
    <?php od_card_close(); ?>

    <!-- 2. Quick Links -->
    <?php
    $footer_quick_links = ondigital_get_repeater( 'footer_quick_links', array() );
    od_card_open( __( '2. Quick Links', 'ondigital' ), 'dashicons-admin-links' );
    od_lang_open();
    foreach ( $langs as $lang => $label ) :
        od_lang_pane( $lang );
        od_text( 'footer_quick_links_title_' . $lang, __( 'Column Title', 'ondigital' ), $options );
        od_lang_pane_close();
    endforeach;
    od_lang_close();
    od_divider();
    od_repeater( $footer_quick_links, 'footer_quick_link', 'ondigital_footer_quick_links', function( $i, $row ) {
        echo '<div class="od-repeater-row">';
        echo '<div class="od-repeater-row-head"><span>' . ( ! empty( $row['label'] ) ? esc_html( $row['label'] ) : sprintf( __( 'Link %d', 'ondigital' ), $i + 1 ) ) . '</span>';
        echo '<div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>';
        echo '<div class="od-field-row">';
        echo '<div class="od-field"><label>' . esc_html__( 'Label', 'ondigital' ) . '</label><input type="text" name="ondigital_footer_quick_links[' . $i . '][label]" value="' . esc_attr( $row['label'] ?? '' ) . '"></div>';
        echo '<div class="od-field"><label>' . esc_html__( 'URL', 'ondigital' ) . '</label><input type="url" name="ondigital_footer_quick_links[' . $i . '][url]" value="' . esc_url( $row['url'] ?? '' ) . '" placeholder="https://"></div>';
        echo '</div></div>';
    } );
    od_card_close();
    ?>

    <!-- 3. Services Links -->
    <?php
    $footer_services_links = ondigital_get_repeater( 'footer_services_links', array() );
    od_card_open( __( '3. Services Links', 'ondigital' ), 'dashicons-hammer' );
    od_lang_open();
    foreach ( $langs as $lang => $label ) :
        od_lang_pane( $lang );
        od_text( 'footer_services_col_title_' . $lang, __( 'Column Title', 'ondigital' ), $options );
        od_lang_pane_close();
    endforeach;
    od_lang_close();
    od_divider();
    od_repeater( $footer_services_links, 'footer_service_link', 'ondigital_footer_services_links', function( $i, $row ) {
        echo '<div class="od-repeater-row">';
        echo '<div class="od-repeater-row-head"><span>' . ( ! empty( $row['label'] ) ? esc_html( $row['label'] ) : sprintf( __( 'Service %d', 'ondigital' ), $i + 1 ) ) . '</span>';
        echo '<div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>';
        echo '<div class="od-field-row">';
        echo '<div class="od-field"><label>' . esc_html__( 'Label', 'ondigital' ) . '</label><input type="text" name="ondigital_footer_services_links[' . $i . '][label]" value="' . esc_attr( $row['label'] ?? '' ) . '"></div>';
        echo '<div class="od-field"><label>' . esc_html__( 'URL', 'ondigital' ) . '</label><input type="url" name="ondigital_footer_services_links[' . $i . '][url]" value="' . esc_url( $row['url'] ?? '' ) . '" placeholder="https://"></div>';
        echo '</div></div>';
    } );
    od_card_close();
    ?>

    <!-- 4. Contact Column -->
    <?php od_card_open( __( '4. Contact Column', 'ondigital' ), 'dashicons-phone' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'footer_contact_title_' . $lang, __( 'Column Title (e.g. Əlaqə)', 'ondigital' ), $options ); ?>
                <?php od_text( 'footer_social_title_' . $lang, __( 'Social Media Subtitle (e.g. Sosial media)', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
        <p style="color:#646970;font-size:12px;margin-top:10px;"><?php esc_html_e( 'Phone, Email, Address → General → Contact Info. Social links → General → Social Media.', 'ondigital' ); ?></p>
    <?php od_card_close(); ?>

    <!-- 5. Copyright -->
    <?php od_card_open( __( '5. Copyright & Terms', 'ondigital' ), 'dashicons-editor-code' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'footer_copyright_' . $lang, __( 'Copyright Text (use <strong> for bold)', 'ondigital' ), $options ); ?>
                <?php od_row_open(); ?>
                    <?php od_text( 'footer_terms_text_' . $lang, __( 'Terms Link Text', 'ondigital' ), $options ); ?>
                    <?php od_url( 'footer_terms_url_' . $lang, __( 'Terms Link URL', 'ondigital' ), $options ); ?>
                <?php od_row_close(); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
    <?php od_card_close(); ?>

</div>
