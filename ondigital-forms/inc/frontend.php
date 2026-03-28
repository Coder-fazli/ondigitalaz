<?php
/**
 * OnDigital Forms — Frontend: Enqueue + Modal Injection
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// DEBUG: confirm plugin frontend is loading
add_action( 'wp_footer', function() {
    echo '<script>console.log("[ODF DEBUG] wp_footer fired, plugin frontend.php loaded");</script>';
}, 1 );

add_action( 'wp_enqueue_scripts', 'odf_enqueue_frontend' );
function odf_enqueue_frontend(): void {
    wp_enqueue_style( 'odf-forms', ODF_URI . 'assets/css/forms.css', array(), ODF_VERSION );
    wp_enqueue_script( 'odf-forms', ODF_URI . 'assets/js/forms.js', array(), ODF_VERSION, true );
    wp_localize_script( 'odf-forms', 'odfVars', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'odf_submit' ),
    ) );
}

add_action( 'wp_footer', 'odf_render_modal', 100 );
function odf_render_modal(): void {
    $opts = get_option( 'odf_options', odf_default_options() );
    $lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'az';
    $lang = in_array( $lang, array( 'az', 'en' ), true ) ? $lang : 'az';

    // Get lang-specific option, fall back to AZ
    $o = function( string $key ) use ( $opts, $lang ): string {
        return $opts[ $key . '_' . $lang ] ?? $opts[ $key . '_az' ] ?? '';
    };

    // Check if a field is enabled (default: on)
    $show = function( string $key ) use ( $opts ): bool {
        return ! isset( $opts[ $key ] ) || ! empty( $opts[ $key ] );
    };

    $title          = $o( 'form_title' );
    $btn_text       = $o( 'btn_text' );
    $success_msg    = $o( 'success' );
    $radio_question = $o( 'radio_question' );
    $src_question   = $o( 'source_question' );

    $radio_opts = array(
        array( 'value' => 'yes',      'label' => $o( 'radio_opt1' ), 'icon' => 'fa-solid fa-check' ),
        array( 'value' => 'no',       'label' => $o( 'radio_opt2' ), 'icon' => 'fa-solid fa-xmark' ),
        array( 'value' => 'starting', 'label' => $o( 'radio_opt3' ), 'icon' => 'fa-solid fa-clock' ),
    );

    $src_opts = array(
        array( 'value' => 'instagram', 'label' => $o( 'src_instagram' ), 'icon' => 'fa-brands fa-instagram' ),
        array( 'value' => 'tiktok',    'label' => $o( 'src_tiktok' ),    'icon' => 'fa-brands fa-tiktok' ),
        array( 'value' => 'facebook',  'label' => $o( 'src_facebook' ),  'icon' => 'fa-brands fa-facebook-f' ),
        array( 'value' => 'linkedin',  'label' => $o( 'src_linkedin' ),  'icon' => 'fa-brands fa-linkedin-in' ),
        array( 'value' => 'youtube',   'label' => $o( 'src_youtube' ),   'icon' => 'fa-brands fa-youtube' ),
        array( 'value' => 'other',     'label' => $o( 'src_other' ),     'icon' => 'fa-solid fa-star' ),
    );

    $labels = $lang === 'az' ? array(
        'name'       => 'Ad Soyad',
        'email'      => 'Email',
        'phone'      => 'Telefon',
        'company'    => 'Şirkət adı',
        'ph_name'    => 'Adınızı daxil edin',
        'ph_email'   => 'Email ünvanınız',
        'ph_phone'   => 'Telefon nömrəniz',
        'ph_company' => 'Şirkət adınız',
    ) : array(
        'name'       => 'Full Name',
        'email'      => 'Email',
        'phone'      => 'Phone',
        'company'    => 'Company Name',
        'ph_name'    => 'Your full name',
        'ph_email'   => 'Your email address',
        'ph_phone'   => 'Your phone number',
        'ph_company' => 'Company name',
    );
    ?>
    <div id="odf-overlay" class="odf-overlay" aria-hidden="true">
        <div class="odf-modal" role="dialog" aria-modal="true" aria-labelledby="odf-title">

            <div class="odf-modal-head">
                <h3 id="odf-title"><?php echo esc_html( $title ); ?></h3>
                <button class="odf-close" aria-label="Close">&times;</button>
            </div>

            <form id="odf-form" novalidate>
                <?php wp_nonce_field( 'odf_submit', 'odf_nonce' ); ?>
                <input type="text" name="odf_hp" class="odf-hp" tabindex="-1" autocomplete="off" aria-hidden="true">

                <?php if ( $show( 'field_name' ) || $show( 'field_email' ) ) : ?>
                <div class="odf-row">
                    <?php if ( $show( 'field_name' ) ) : ?>
                    <div class="odf-field">
                        <label><?php echo esc_html( $labels['name'] ); ?></label>
                        <input type="text" name="odf_name" placeholder="<?php echo esc_attr( $labels['ph_name'] ); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if ( $show( 'field_email' ) ) : ?>
                    <div class="odf-field">
                        <label><?php echo esc_html( $labels['email'] ); ?></label>
                        <input type="email" name="odf_email" placeholder="<?php echo esc_attr( $labels['ph_email'] ); ?>">
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if ( $show( 'field_phone' ) || $show( 'field_company' ) ) : ?>
                <div class="odf-row">
                    <?php if ( $show( 'field_phone' ) ) : ?>
                    <div class="odf-field">
                        <label><?php echo esc_html( $labels['phone'] ); ?></label>
                        <input type="tel" name="odf_phone" placeholder="<?php echo esc_attr( $labels['ph_phone'] ); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if ( $show( 'field_company' ) ) : ?>
                    <div class="odf-field">
                        <label><?php echo esc_html( $labels['company'] ); ?></label>
                        <input type="text" name="odf_company" placeholder="<?php echo esc_attr( $labels['ph_company'] ); ?>">
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if ( $show( 'field_radio' ) && $radio_question ) : ?>
                <div class="odf-group">
                    <p class="odf-group-label"><?php echo esc_html( $radio_question ); ?></p>
                    <div class="odf-choice-grid odf-choice-grid--3">
                        <?php foreach ( $radio_opts as $opt ) : ?>
                        <label class="odf-choice-btn">
                            <input type="radio" name="odf_ecommerce" value="<?php echo esc_attr( $opt['value'] ); ?>">
                            <span class="odf-choice-inner">
                                <i class="<?php echo esc_attr( $opt['icon'] ); ?>"></i>
                                <?php echo esc_html( $opt['label'] ); ?>
                            </span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $show( 'field_source' ) && $src_question ) : ?>
                <div class="odf-group">
                    <p class="odf-group-label"><?php echo esc_html( $src_question ); ?></p>
                    <div class="odf-choice-grid odf-choice-grid--3">
                        <?php foreach ( $src_opts as $opt ) : ?>
                        <label class="odf-choice-btn">
                            <input type="checkbox" name="odf_source[]" value="<?php echo esc_attr( $opt['value'] ); ?>">
                            <span class="odf-choice-inner">
                                <i class="<?php echo esc_attr( $opt['icon'] ); ?>"></i>
                                <?php echo esc_html( $opt['label'] ); ?>
                            </span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <button type="submit" class="odf-submit">
                    <i class="fa-solid fa-phone"></i>
                    <?php echo esc_html( $btn_text ); ?>
                </button>

                <div class="odf-error-msg" style="display:none;"></div>
            </form>

            <div class="odf-success-wrap" style="display:none;">
                <div class="odf-success-icon"><i class="fa-solid fa-circle-check"></i></div>
                <p class="odf-success-text"><?php echo esc_html( $success_msg ); ?></p>
            </div>

        </div>
    </div>
    <?php
}
