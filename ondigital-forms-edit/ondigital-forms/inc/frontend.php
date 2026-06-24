<?php
/**
 * OnDigital Forms — Frontend: Enqueue + Modal Injection
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_enqueue_scripts', 'odf_enqueue_frontend' );
function odf_enqueue_frontend(): void {
    // Use filemtime so any uploaded file change busts the browser cache automatically.
    $v = function( string $rel ): string {
        $path = ODF_DIR . $rel;
        return file_exists( $path ) ? (string) filemtime( $path ) : ODF_VERSION;
    };

    // Shared styles (loading spinner, etc.) — needed on every form, was missing.
    wp_enqueue_style( 'odf-forms-base', ODF_URI . 'assets/css/forms.css', array(), $v( 'assets/css/forms.css' ) );

    wp_enqueue_style( 'odf-contact-popup', ODF_URI . 'assets/css/forms-contact-popup.css', array(), $v( 'assets/css/forms-contact-popup.css' ) );

    if ( is_page_template( 'templates/page-contact.php' ) ) {
        wp_enqueue_style( 'odf-contact-page', ODF_URI . 'assets/css/forms-contact-page.css', array(), $v( 'assets/css/forms-contact-page.css' ) );
    }

    if ( is_page_template( 'templates/page-about-new.php' ) ) {
        wp_enqueue_style( 'odf-about-page', ODF_URI . 'assets/css/forms-about-page.css', array(), $v( 'assets/css/forms-about-page.css' ) );
    }

    if ( is_singular( 'service' ) ) {
        wp_enqueue_style( 'odf-service-page', ODF_URI . 'assets/css/forms-service-page.css', array(), $v( 'assets/css/forms-service-page.css' ) );
    }

    wp_enqueue_script( 'odf-forms', ODF_URI . 'assets/js/forms.js', array(), $v( 'assets/js/forms.js' ), true );
    wp_localize_script( 'odf-forms', 'odfVars', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'odf_submit' ),
    ) );
}

add_action( 'upgrader_process_complete', 'odf_purge_caches', 10, 0 );
add_action( 'activated_plugin',          'odf_purge_caches' );
function odf_purge_caches(): void {
    // WP Rocket
    if ( function_exists( 'rocket_clean_domain' ) ) {
        rocket_clean_domain();
    }
    // LiteSpeed Cache
    if ( class_exists( 'LiteSpeed_Cache_API' ) ) {
        LiteSpeed_Cache_API::purge_all();
    }
    // W3 Total Cache
    if ( function_exists( 'w3tc_flush_all' ) ) {
        w3tc_flush_all();
    }
    // WP Super Cache
    if ( function_exists( 'wp_cache_clear_cache' ) ) {
        wp_cache_clear_cache();
    }
    // WP Fastest Cache
    if ( isset( $GLOBALS['wp_fastest_cache'] ) && method_exists( $GLOBALS['wp_fastest_cache'], 'deleteCache' ) ) {
        $GLOBALS['wp_fastest_cache']->deleteCache();
    }
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
    $ph = array(
        'name'    => $o( 'ph_name' ),
        'email'   => $o( 'ph_email' ),
        'phone'   => $o( 'ph_phone' ),
        'message' => $o( 'ph_message' ),
    );

    // Fetch published services (Polylang-aware)
    $services_lang = $lang;
    $services_query_args = array(
        'post_type'      => 'service',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'post_status'    => 'publish',
    );
    if ( function_exists( 'pll_current_language' ) ) {
        $services_query_args['lang'] = $services_lang;
    }
    $services_q = new WP_Query( $services_query_args );
    $service_items = array();
    if ( $services_q->have_posts() ) {
        while ( $services_q->have_posts() ) {
            $services_q->the_post();
            $service_items[] = array( 'id' => get_the_ID(), 'title' => get_the_title() );
        }
        wp_reset_postdata();
    }

    $services_label = $lang === 'az'
        ? 'Hansı xidmətlərlə maraqlanırsınız?'
        : 'Which services are you interested in?';
    ?>
    <div class="odf-cp-wrap">
        <h3 class="odf-cp-title"><?php echo esc_html( $title ); ?></h3>
        <form id="odf-cp-form" class="odf-cp-form" novalidate>
            <?php wp_nonce_field( 'odf_submit', 'odf_nonce' ); ?>
            <input type="text" name="odf_hp" class="odf-hp" tabindex="-1" autocomplete="off" aria-hidden="true">
            <input type="hidden" name="odf_form_source" value="contact-page">
            <input type="hidden" name="odf_lang" value="<?php echo esc_attr( $lang ); ?>">

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
                    <input type="tel" name="odf_phone" inputmode="tel" placeholder="<?php echo esc_attr( $ph['phone'] ); ?>">
                </div>
            </div>

            <?php if ( ! empty( $service_items ) ) : ?>
            <div class="odf-cp-services">
                <p class="odf-cp-services-label"><?php echo esc_html( $services_label ); ?></p>
                <div class="odf-cp-services-grid">
                    <?php foreach ( $service_items as $svc ) : ?>
                    <label class="odf-cp-service-pill">
                        <input type="checkbox" name="odf_services[]" value="<?php echo esc_attr( $svc['title'] ); ?>">
                        <span><?php echo esc_html( $svc['title'] ); ?></span>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
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
            <input type="hidden" name="odf_form_source" value="service-page">
            <input type="hidden" name="odf_lang" value="<?php echo esc_attr( $lang ); ?>">

            <div class="odf-sp-row">
                <div class="odf-sp-group">
                    <input type="text" name="odf_name" placeholder="<?php echo esc_attr( $ph['name'] ); ?>">
                </div>
                <div class="odf-sp-group">
                    <input type="email" name="odf_email" placeholder="<?php echo esc_attr( $ph['email'] ); ?>">
                </div>
            </div>
            <div class="odf-sp-group">
                <input type="tel" name="odf_phone" inputmode="tel" placeholder="<?php echo esc_attr( $ph['phone'] ); ?>">
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
            <input type="hidden" name="odf_form_source" value="about-page">
            <input type="hidden" name="odf_lang" value="<?php echo esc_attr( $lang ); ?>">
            <div class="odf-ap-row">
                <div class="odf-ap-group">
                    <input type="text" name="odf_name" placeholder="<?php echo esc_attr( $ph['name'] ); ?>">
                </div>
                <div class="odf-ap-group">
                    <input type="email" name="odf_email" placeholder="<?php echo esc_attr( $ph['email'] ); ?>">
                </div>
            </div>
            <div class="odf-ap-group">
                <input type="tel" name="odf_phone" inputmode="tel" placeholder="<?php echo esc_attr( $ph['phone'] ); ?>">
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

    $popup_services_args = array(
        'post_type'      => 'service',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'post_status'    => 'publish',
    );
    if ( function_exists( 'pll_current_language' ) ) {
        $popup_services_args['lang'] = $lang;
    }
    $popup_services_q     = new WP_Query( $popup_services_args );
    $popup_service_items  = array();
    if ( $popup_services_q->have_posts() ) {
        while ( $popup_services_q->have_posts() ) {
            $popup_services_q->the_post();
            $popup_service_items[] = get_the_title();
        }
        wp_reset_postdata();
    }

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
                <input type="hidden" name="odf_form_source" value="popup">
            <input type="hidden" name="odf_lang" value="<?php echo esc_attr( $lang ); ?>">

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
                        <input type="tel" name="odf_phone" inputmode="tel" placeholder="<?php echo esc_attr( $labels['ph_phone'] ); ?>">
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

                <?php if ( $show( 'field_source' ) && $src_question && ! empty( $popup_service_items ) ) : ?>
                <div class="odf-group">
                    <p class="odf-group-label"><?php echo esc_html( $src_question ); ?></p>
                    <div class="odf-cp-services-grid">
                        <?php foreach ( $popup_service_items as $svc_title ) : ?>
                        <label class="odf-cp-service-pill">
                            <input type="checkbox" name="odf_services[]" value="<?php echo esc_attr( $svc_title ); ?>">
                            <span><?php echo esc_html( $svc_title ); ?></span>
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
