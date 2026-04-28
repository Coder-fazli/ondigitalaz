<?php
/**
 * OnDigital Forms — Frontend: Enqueue + Modal Injection
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_enqueue_scripts', 'odf_enqueue_frontend' );
function odf_enqueue_frontend(): void {
    // Contact Popup — loaded on every page (modal renders in footer globally)
    wp_enqueue_style( 'odf-contact-popup', ODF_URI . 'assets/css/forms-contact-popup.css', array(), ODF_VERSION );

    // Contact Page form CSS
    if ( is_page_template( 'templates/page-contact.php' ) ) {
        wp_enqueue_style( 'odf-contact-page', ODF_URI . 'assets/css/forms-contact-page.css', array(), ODF_VERSION );
    }

    // About Page form CSS
    if ( is_page_template( 'templates/page-about-new.php' ) ) {
        wp_enqueue_style( 'odf-about-page', ODF_URI . 'assets/css/forms-about-page.css', array(), ODF_VERSION );
    }

    // Service Page — only on service single pages
    if ( is_singular( 'service' ) ) {
        wp_enqueue_style( 'odf-service-page', ODF_URI . 'assets/css/forms-service-page.css', array(), ODF_VERSION );
    }

    wp_enqueue_script( 'odf-forms', ODF_URI . 'assets/js/forms.js', array(), ODF_VERSION, true );
    wp_localize_script( 'odf-forms', 'odfVars', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'odf_submit' ),
    ) );
}

function odf_render_contact_page_inline(): void {
    $opts = get_option( 'odf_contact_page_options', odf_default_contact_page_options() );
    $lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'az';
    $lang = in_array( $lang, array( 'az', 'en' ), true ) ? $lang : 'az';

    $o = function( string $key ) use ( $opts, $lang ): string {
        return $opts[ $key . '_' . $lang ] ?? $opts[ $key . '_az' ] ?? '';
    };

    $title       = $o( 'form_title' );
    $btn_text    = $o( 'btn_text' );
    $success_msg = $o( 'success' );
    $show_subject = ! isset( $opts['field_subject'] ) || ! empty( $opts['field_subject'] );

    $ph = array(
        'name'    => $o( 'ph_name' ),
        'email'   => $o( 'ph_email' ),
        'phone'   => $o( 'ph_phone' ),
        'subject' => $o( 'ph_subject' ),
        'message' => $o( 'ph_message' ),
    );
    ?>
    <div class="odf-cp-wrap">
        <h3 class="odf-cp-title"><?php echo esc_html( $title ); ?></h3>
        <form id="odf-cp-form" class="odf-cp-form" novalidate>
            <?php wp_nonce_field( 'odf_submit', 'odf_nonce' ); ?>
            <input type="text" name="odf_hp" class="odf-hp" tabindex="-1" autocomplete="off" aria-hidden="true">

            <div class="odf-cp-row">
                <div class="odf-cp-group">
                    <input type="text" name="odf_name" placeholder="<?php echo esc_attr( $ph['name'] ); ?>">
                </div>
                <div class="odf-cp-group">
                    <input type="email" name="odf_email" placeholder="<?php echo esc_attr( $ph['email'] ); ?>">
                </div>
            </div>
            <div class="odf-cp-row">
                <div class="odf-cp-group">
                    <input type="tel" name="odf_phone" placeholder="<?php echo esc_attr( $ph['phone'] ); ?>">
                </div>
                <?php if ( $show_subject ) : ?>
                <div class="odf-cp-group">
                    <input type="text" name="odf_company" placeholder="<?php echo esc_attr( $ph['subject'] ); ?>">
                </div>
                <?php endif; ?>
            </div>
            <div class="odf-cp-group">
                <textarea name="odf_message" placeholder="<?php echo esc_attr( $ph['message'] ); ?>"></textarea>
            </div>
            <div class="odf-cp-footer">
                <button type="submit" class="odf-cp-submit">
                    <?php echo esc_html( $btn_text ); ?>
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </button>
            </div>
            <div class="odf-cp-error" style="display:none;"></div>
        </form>
        <div class="odf-cp-success" style="display:none;">
            <div class="odf-cp-success-icon"><i class="fa-solid fa-circle-check"></i></div>
            <p><?php echo esc_html( $success_msg ); ?></p>
        </div>
    </div>
    <?php
}

function odf_render_service_page_inline(): void {
    $opts = get_option( 'odf_service_page_options', odf_default_service_page_options() );
    $lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'az';
    $lang = in_array( $lang, array( 'az', 'en' ), true ) ? $lang : 'az';

    $o = function( string $key ) use ( $opts, $lang ): string {
        return $opts[ $key . '_' . $lang ] ?? $opts[ $key . '_az' ] ?? '';
    };

    $btn_text    = $o( 'btn_text' );
    $success_msg = $o( 'success' );

    $ph = array(
        'name'    => $o( 'ph_name' ),
        'email'   => $o( 'ph_email' ),
        'phone'   => $o( 'ph_phone' ),
        'message' => $o( 'ph_message' ),
    );
    ?>
    <div class="odf-sp-wrap">
        <form id="odf-sp-form" class="odf-sp-form" novalidate>
            <?php wp_nonce_field( 'odf_submit', 'odf_nonce' ); ?>
            <input type="text" name="odf_hp" class="odf-hp" tabindex="-1" autocomplete="off" aria-hidden="true">

            <div class="odf-sp-row">
                <div class="odf-sp-group">
                    <input type="text" name="odf_name" placeholder="<?php echo esc_attr( $ph['name'] ); ?>">
                </div>
                <div class="odf-sp-group">
                    <input type="email" name="odf_email" placeholder="<?php echo esc_attr( $ph['email'] ); ?>">
                </div>
            </div>
            <div class="odf-sp-group">
                <input type="tel" name="odf_phone" placeholder="<?php echo esc_attr( $ph['phone'] ); ?>">
            </div>
            <div class="odf-sp-group">
                <textarea name="odf_message" placeholder="<?php echo esc_attr( $ph['message'] ); ?>"></textarea>
            </div>
            <button type="submit" class="odf-sp-submit">
                <?php echo esc_html( $btn_text ); ?>
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>
            <div class="odf-sp-error" style="display:none;"></div>
        </form>
        <div class="odf-sp-success" style="display:none;">
            <div class="odf-sp-success-icon"><i class="fa-solid fa-circle-check"></i></div>
            <p><?php echo esc_html( $success_msg ); ?></p>
        </div>
    </div>
    <?php
}

function odf_render_about_page_inline(): void {
    $opts = get_option( 'odf_about_page_options', odf_default_about_page_options() );
    $lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'az';
    $lang = in_array( $lang, array( 'az', 'en' ), true ) ? $lang : 'az';

    $o = function( string $key ) use ( $opts, $lang ): string {
        return $opts[ $key . '_' . $lang ] ?? $opts[ $key . '_az' ] ?? '';
    };

    $title       = $o( 'form_title' );
    $btn_text    = $o( 'btn_text' );
    $success_msg = $o( 'success' );

    $ph = array(
        'name'    => $o( 'ph_name' ),
        'email'   => $o( 'ph_email' ),
        'phone'   => $o( 'ph_phone' ),
        'message' => $o( 'ph_message' ),
    );
    ?>
    <div class="odf-ap-wrap">
        <h3 class="odf-ap-title"><?php echo esc_html( $title ); ?></h3>
        <form id="odf-ap-form" class="odf-ap-form" novalidate>
            <?php wp_nonce_field( 'odf_submit', 'odf_nonce' ); ?>
            <input type="text" name="odf_hp" class="odf-hp" tabindex="-1" autocomplete="off" aria-hidden="true">
            <div class="odf-ap-row">
                <div class="odf-ap-group">
                    <input type="text" name="odf_name" placeholder="<?php echo esc_attr( $ph['name'] ); ?>">
                </div>
                <div class="odf-ap-group">
                    <input type="email" name="odf_email" placeholder="<?php echo esc_attr( $ph['email'] ); ?>">
                </div>
            </div>
            <div class="odf-ap-group">
                <input type="tel" name="odf_phone" placeholder="<?php echo esc_attr( $ph['phone'] ); ?>">
            </div>
            <div class="odf-ap-group">
                <textarea name="odf_message" placeholder="<?php echo esc_attr( $ph['message'] ); ?>"></textarea>
            </div>
            <div class="odf-ap-footer">
                <button type="submit" class="odf-ap-submit">
                    <?php echo esc_html( $btn_text ); ?>
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </button>
            </div>
            <div class="odf-ap-error" style="display:none;"></div>
        </form>
        <div class="odf-ap-success" style="display:none;">
            <div class="odf-ap-success-icon"><i class="fa-solid fa-circle-check"></i></div>
            <p><?php echo esc_html( $success_msg ); ?></p>
        </div>
    </div>
    <?php
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
