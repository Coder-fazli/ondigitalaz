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

$langs = array( 'en' => '🇬🇧 EN', 'az' => '🇦🇿 AZ' );

/**
 * Render one bilingual footer-link repeater row (EN/AZ label + URL).
 * Falls back to legacy single label/url for existing rows.
 */
if ( ! function_exists( 'od_footer_link_row' ) ) {
    function od_footer_link_row( int $i, array $row, string $name, string $label_word ): void {
        $head     = $row['label_en'] ?? $row['label'] ?? '';
        $head     = $head !== '' ? $head : sprintf( '%s %d', $label_word, $i + 1 );
        $en_label = $row['label_en'] ?? $row['label'] ?? '';
        $en_url   = $row['url_en']   ?? $row['url']   ?? '';
        $az_label = $row['label_az'] ?? '';
        $az_url   = $row['url_az']   ?? '';

        echo '<div class="od-repeater-row">';
        echo '<div class="od-repeater-row-head"><span>' . esc_html( $head ) . '</span><div class="od-row-actions"><button type="button" class="od-remove-row">&times;</button></div></div>';
        echo '<div class="od-lang-wrap"><div class="od-lang-tabs"><span class="od-lang-tab active" data-lang="en">🇬🇧 EN</span><span class="od-lang-tab" data-lang="az">🇦🇿 AZ</span></div>';

        echo '<div class="od-lang-pane active" data-lang="en"><div class="od-field-row">';
        echo '<div class="od-field"><label>' . esc_html__( 'Label', 'ondigital' ) . '</label><input type="text" name="' . esc_attr( $name ) . '[' . $i . '][label_en]" value="' . esc_attr( $en_label ) . '"></div>';
        echo '<div class="od-field"><label>' . esc_html__( 'URL', 'ondigital' ) . '</label><input type="url" name="' . esc_attr( $name ) . '[' . $i . '][url_en]" value="' . esc_url( $en_url ) . '" placeholder="https://"></div>';
        echo '</div></div>';

        echo '<div class="od-lang-pane" data-lang="az"><div class="od-field-row">';
        echo '<div class="od-field"><label>' . esc_html__( 'Label', 'ondigital' ) . '</label><input type="text" name="' . esc_attr( $name ) . '[' . $i . '][label_az]" value="' . esc_attr( $az_label ) . '"></div>';
        echo '<div class="od-field"><label>' . esc_html__( 'URL', 'ondigital' ) . '</label><input type="url" name="' . esc_attr( $name ) . '[' . $i . '][url_az]" value="' . esc_url( $az_url ) . '" placeholder="https://"></div>';
        echo '</div></div>';

        echo '</div></div>';
    }
}
?>
<div class="od-section active" data-section="footer">

    <!-- Brand Column -->
    <?php od_card_open( __( 'Brand Column', 'ondigital' ), 'dashicons-admin-appearance' ); ?>
        <?php od_image( 'footer_logo', __( 'Footer Logo', 'ondigital' ), $options ); ?>
        <?php od_divider(); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_textarea( 'footer_tagline_' . $lang, __( 'Tagline', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
    <?php od_card_close(); ?>

    <!-- Quick Links -->
    <?php
    $footer_quick_links = ondigital_get_repeater( 'footer_quick_links', array() );
    od_card_open( __( 'Quick Links Column', 'ondigital' ), 'dashicons-admin-links' );
    od_lang_open();
    foreach ( $langs as $lang => $label ) :
        od_lang_pane( $lang );
        od_text( 'footer_quick_links_title_' . $lang, __( 'Column Title', 'ondigital' ), $options );
        od_lang_pane_close();
    endforeach;
    od_lang_close();
    od_divider();
    od_repeater( $footer_quick_links, 'footer_quick_link', 'ondigital_footer_quick_links', function( $i, $row ) {
        od_footer_link_row( (int) $i, (array) $row, 'ondigital_footer_quick_links', __( 'Link', 'ondigital' ) );
    } );
    od_card_close();
    ?>

    <!-- Services Links -->
    <?php
    $footer_services_links = ondigital_get_repeater( 'footer_services_links', array() );
    od_card_open( __( 'Services Column', 'ondigital' ), 'dashicons-hammer' );
    od_lang_open();
    foreach ( $langs as $lang => $label ) :
        od_lang_pane( $lang );
        od_text( 'footer_services_col_title_' . $lang, __( 'Column Title', 'ondigital' ), $options );
        od_lang_pane_close();
    endforeach;
    od_lang_close();
    od_divider();
    od_repeater( $footer_services_links, 'footer_service_link', 'ondigital_footer_services_links', function( $i, $row ) {
        od_footer_link_row( (int) $i, (array) $row, 'ondigital_footer_services_links', __( 'Service', 'ondigital' ) );
    } );
    od_card_close();
    ?>

    <!-- Contact & Social Column -->
    <?php od_card_open( __( 'Contact & Social Column', 'ondigital' ), 'dashicons-phone' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'footer_contact_title_' . $lang, __( 'Column Title', 'ondigital' ), $options ); ?>
                <?php od_text( 'footer_social_title_' . $lang, __( 'Social Media Subtitle', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
        <div style="margin-top:16px;padding:14px 16px;background:#f0f6fc;border-left:3px solid #2271b1;border-radius:4px;">
            <p style="margin:0 0 8px;font-weight:600;color:#1d2327;font-size:13px;"><?php esc_html_e( 'Where to edit phone, email, address and social media links:', 'ondigital' ); ?></p>
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=ondigital' ) ); ?>" style="display:inline-block;margin-right:10px;">
                → <?php esc_html_e( 'General → Contact Info', 'ondigital' ); ?>
            </a>
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=ondigital' ) ); ?>">
                → <?php esc_html_e( 'General → Social Media', 'ondigital' ); ?>
            </a>
        </div>
    <?php od_card_close(); ?>

    <!-- Copyright & Terms -->
    <?php od_card_open( __( 'Copyright & Terms', 'ondigital' ), 'dashicons-editor-code' ); ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'footer_copyright_' . $lang, __( 'Copyright Text (use &lt;strong&gt; for bold)', 'ondigital' ), $options ); ?>
                <?php od_row_open(); ?>
                    <?php od_text( 'footer_terms_text_' . $lang, __( 'Terms Link Text', 'ondigital' ), $options ); ?>
                    <?php od_url( 'footer_terms_url_' . $lang, __( 'Terms Link URL', 'ondigital' ), $options ); ?>
                <?php od_row_close(); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
    <?php od_card_close(); ?>

</div>
