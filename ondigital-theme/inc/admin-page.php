<?php
/**
 * OnDigital Theme Options Admin Page
 *
 * Tabbed admin page for managing repeater data: Partners, Features,
 * Pricing Plans, FAQ Items, Stats, Testimonials, Text Slider.
 *
 * @package OnDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// =============================================================================
// Register Admin Page
// =============================================================================

add_action( 'admin_menu', 'ondigital_add_theme_options_page' );
function ondigital_add_theme_options_page() {
    add_theme_page(
        __( 'Theme Options', 'ondigital' ),
        __( 'Theme Options', 'ondigital' ),
        'manage_options',
        'ondigital-theme-options',
        'ondigital_theme_options_page_render'
    );
}

// =============================================================================
// Enqueue Admin Assets
// =============================================================================

add_action( 'admin_enqueue_scripts', 'ondigital_theme_options_scripts' );
function ondigital_theme_options_scripts( $hook ) {
    if ( $hook !== 'appearance_page_ondigital-theme-options' ) {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script(
        'ondigital-theme-options',
        ONDIGITAL_URI . '/assets/js/admin/theme-options.js',
        array( 'jquery' ),
        ONDIGITAL_VERSION,
        true
    );
    wp_add_inline_style( 'wp-admin', '
        .ondigital-tabs{display:flex;gap:0;border-bottom:2px solid #ccc;margin-bottom:20px}
        .ondigital-tab{padding:10px 20px;cursor:pointer;background:#f1f1f1;border:1px solid #ccc;border-bottom:none;margin-bottom:-2px;font-weight:600}
        .ondigital-tab.active{background:#fff;border-bottom:2px solid #fff}
        .ondigital-tab-content{display:none}
        .ondigital-tab-content.active{display:block}
        .ondigital-repeater-row{background:#f9f9f9;border:1px solid #ddd;padding:15px;margin-bottom:10px;position:relative}
        .ondigital-repeater-row .remove-row{position:absolute;top:10px;right:10px;color:#a00;cursor:pointer;background:none;border:none;font-size:14px}
        .ondigital-repeater-row .remove-row:hover{color:#dc3232}
        .ondigital-img-preview{max-width:100px;height:auto;display:block;margin-top:5px}
        .ondigital-repeater-row label{font-weight:600;display:block;margin-top:8px;margin-bottom:3px}
        .ondigital-repeater-row input[type=text],.ondigital-repeater-row input[type=url],.ondigital-repeater-row textarea{width:100%}
    ' );
}

// =============================================================================
// Save Handler
// =============================================================================

add_action( 'admin_init', 'ondigital_theme_options_save' );
function ondigital_theme_options_save() {
    if ( ! isset( $_POST['ondigital_theme_options_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['ondigital_theme_options_nonce'], 'ondigital_theme_options_save' ) ) {
        return;
    }
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // Partners
    if ( isset( $_POST['ondigital_partners'] ) && is_array( $_POST['ondigital_partners'] ) ) {
        $partners = array();
        foreach ( $_POST['ondigital_partners'] as $item ) {
            $partners[] = array(
                'image_light' => absint( $item['image_light'] ?? 0 ),
                'image_dark'  => absint( $item['image_dark'] ?? 0 ),
                'alt'         => sanitize_text_field( $item['alt'] ?? '' ),
            );
        }
        update_option( 'ondigital_partners', $partners );
    } else {
        update_option( 'ondigital_partners', array() );
    }

    // Features
    if ( isset( $_POST['ondigital_features'] ) && is_array( $_POST['ondigital_features'] ) ) {
        $features = array();
        foreach ( $_POST['ondigital_features'] as $item ) {
            $features[] = array(
                'title'       => sanitize_text_field( $item['title'] ?? '' ),
                'description' => sanitize_textarea_field( $item['description'] ?? '' ),
                'icon_light'  => absint( $item['icon_light'] ?? 0 ),
                'icon_dark'   => absint( $item['icon_dark'] ?? 0 ),
            );
        }
        update_option( 'ondigital_features', $features );
    } else {
        update_option( 'ondigital_features', array() );
    }

    // Pricing Plans
    if ( isset( $_POST['ondigital_pricing'] ) && is_array( $_POST['ondigital_pricing'] ) ) {
        $pricing = array();
        foreach ( $_POST['ondigital_pricing'] as $item ) {
            $pricing[] = array(
                'name'     => sanitize_text_field( $item['name'] ?? '' ),
                'price'    => sanitize_text_field( $item['price'] ?? '' ),
                'features' => sanitize_textarea_field( $item['features'] ?? '' ),
                'cta_url'  => esc_url_raw( $item['cta_url'] ?? '' ),
            );
        }
        update_option( 'ondigital_pricing', $pricing );
    } else {
        update_option( 'ondigital_pricing', array() );
    }

    // FAQ Items
    if ( isset( $_POST['ondigital_faq'] ) && is_array( $_POST['ondigital_faq'] ) ) {
        $faq = array();
        foreach ( $_POST['ondigital_faq'] as $item ) {
            $faq[] = array(
                'question' => sanitize_text_field( $item['question'] ?? '' ),
                'answer'   => sanitize_textarea_field( $item['answer'] ?? '' ),
                'open'     => ! empty( $item['open'] ) ? 1 : 0,
            );
        }
        update_option( 'ondigital_faq', $faq );
    } else {
        update_option( 'ondigital_faq', array() );
    }

    // Stats
    if ( isset( $_POST['ondigital_stats'] ) && is_array( $_POST['ondigital_stats'] ) ) {
        $stats = array();
        foreach ( $_POST['ondigital_stats'] as $item ) {
            $stats[] = array(
                'number' => sanitize_text_field( $item['number'] ?? '' ),
                'label'  => sanitize_text_field( $item['label'] ?? '' ),
            );
        }
        update_option( 'ondigital_stats', $stats );
    } else {
        update_option( 'ondigital_stats', array() );
    }

    // Testimonials
    if ( isset( $_POST['ondigital_testimonials'] ) && is_array( $_POST['ondigital_testimonials'] ) ) {
        $testimonials = array();
        foreach ( $_POST['ondigital_testimonials'] as $item ) {
            $testimonials[] = array(
                'quote' => sanitize_textarea_field( $item['quote'] ?? '' ),
                'name'  => sanitize_text_field( $item['name'] ?? '' ),
                'role'  => sanitize_text_field( $item['role'] ?? '' ),
            );
        }
        update_option( 'ondigital_testimonials', $testimonials );
    } else {
        update_option( 'ondigital_testimonials', array() );
    }

    // Text Slider
    if ( isset( $_POST['ondigital_text_slider'] ) && is_array( $_POST['ondigital_text_slider'] ) ) {
        $slider = array();
        foreach ( $_POST['ondigital_text_slider'] as $item ) {
            $slider[] = array(
                'text'        => sanitize_text_field( $item['text'] ?? '' ),
                'highlighted' => sanitize_text_field( $item['highlighted'] ?? '' ),
            );
        }
        update_option( 'ondigital_text_slider', $slider );
    } else {
        update_option( 'ondigital_text_slider', array() );
    }

    add_settings_error( 'ondigital_theme_options', 'settings_updated', __( 'Settings saved.', 'ondigital' ), 'updated' );
}

// =============================================================================
// Render Page
// =============================================================================

function ondigital_theme_options_page_render() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    settings_errors( 'ondigital_theme_options' );

    $tabs = array(
        'partners'     => __( 'Partners', 'ondigital' ),
        'features'     => __( 'Features', 'ondigital' ),
        'pricing'      => __( 'Pricing Plans', 'ondigital' ),
        'faq'          => __( 'FAQ Items', 'ondigital' ),
        'stats'        => __( 'Stats', 'ondigital' ),
        'testimonials' => __( 'Testimonials', 'ondigital' ),
        'text_slider'  => __( 'Text Slider', 'ondigital' ),
    );

    $active_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'partners';
    if ( ! array_key_exists( $active_tab, $tabs ) ) {
        $active_tab = 'partners';
    }

    // Load data
    $partners     = get_option( 'ondigital_partners', array() );
    $features     = get_option( 'ondigital_features', array() );
    $pricing      = get_option( 'ondigital_pricing', array() );
    $faq          = get_option( 'ondigital_faq', array() );
    $stats        = get_option( 'ondigital_stats', array() );
    $testimonials = get_option( 'ondigital_testimonials', array() );
    $text_slider  = get_option( 'ondigital_text_slider', array() );
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'OnDigital Theme Options', 'ondigital' ); ?></h1>

        <div class="ondigital-tabs">
            <?php foreach ( $tabs as $key => $label ) : ?>
                <div class="ondigital-tab <?php echo $active_tab === $key ? 'active' : ''; ?>" data-tab="<?php echo esc_attr( $key ); ?>">
                    <?php echo esc_html( $label ); ?>
                </div>
            <?php endforeach; ?>
        </div>

        <form method="post" action="">
            <?php wp_nonce_field( 'ondigital_theme_options_save', 'ondigital_theme_options_nonce' ); ?>

            <!-- Partners Tab -->
            <div class="ondigital-tab-content <?php echo $active_tab === 'partners' ? 'active' : ''; ?>" data-tab="partners">
                <h2><?php esc_html_e( 'Partner Logos', 'ondigital' ); ?></h2>
                <div id="partners-repeater">
                    <?php if ( ! empty( $partners ) ) : ?>
                        <?php foreach ( $partners as $i => $partner ) : ?>
                            <?php ondigital_render_partner_row( $i, $partner ); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button type="button" class="button add-row-btn" data-repeater="partners" data-type="partner"><?php esc_html_e( 'Add Partner', 'ondigital' ); ?></button>
            </div>

            <!-- Features Tab -->
            <div class="ondigital-tab-content <?php echo $active_tab === 'features' ? 'active' : ''; ?>" data-tab="features">
                <h2><?php esc_html_e( 'Feature Items', 'ondigital' ); ?></h2>
                <div id="features-repeater">
                    <?php if ( ! empty( $features ) ) : ?>
                        <?php foreach ( $features as $i => $feature ) : ?>
                            <?php ondigital_render_feature_row( $i, $feature ); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button type="button" class="button add-row-btn" data-repeater="features" data-type="feature"><?php esc_html_e( 'Add Feature', 'ondigital' ); ?></button>
            </div>

            <!-- Pricing Tab -->
            <div class="ondigital-tab-content <?php echo $active_tab === 'pricing' ? 'active' : ''; ?>" data-tab="pricing">
                <h2><?php esc_html_e( 'Pricing Plans', 'ondigital' ); ?></h2>
                <div id="pricing-repeater">
                    <?php if ( ! empty( $pricing ) ) : ?>
                        <?php foreach ( $pricing as $i => $plan ) : ?>
                            <?php ondigital_render_pricing_row( $i, $plan ); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button type="button" class="button add-row-btn" data-repeater="pricing" data-type="pricing"><?php esc_html_e( 'Add Plan', 'ondigital' ); ?></button>
            </div>

            <!-- FAQ Tab -->
            <div class="ondigital-tab-content <?php echo $active_tab === 'faq' ? 'active' : ''; ?>" data-tab="faq">
                <h2><?php esc_html_e( 'FAQ Items', 'ondigital' ); ?></h2>
                <div id="faq-repeater">
                    <?php if ( ! empty( $faq ) ) : ?>
                        <?php foreach ( $faq as $i => $item ) : ?>
                            <?php ondigital_render_faq_row( $i, $item ); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button type="button" class="button add-row-btn" data-repeater="faq" data-type="faq"><?php esc_html_e( 'Add FAQ Item', 'ondigital' ); ?></button>
            </div>

            <!-- Stats Tab -->
            <div class="ondigital-tab-content <?php echo $active_tab === 'stats' ? 'active' : ''; ?>" data-tab="stats">
                <h2><?php esc_html_e( 'Stats / Counters', 'ondigital' ); ?></h2>
                <div id="stats-repeater">
                    <?php if ( ! empty( $stats ) ) : ?>
                        <?php foreach ( $stats as $i => $stat ) : ?>
                            <?php ondigital_render_stats_row( $i, $stat ); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button type="button" class="button add-row-btn" data-repeater="stats" data-type="stats"><?php esc_html_e( 'Add Stat', 'ondigital' ); ?></button>
            </div>

            <!-- Testimonials Tab -->
            <div class="ondigital-tab-content <?php echo $active_tab === 'testimonials' ? 'active' : ''; ?>" data-tab="testimonials">
                <h2><?php esc_html_e( 'Testimonials', 'ondigital' ); ?></h2>
                <div id="testimonials-repeater">
                    <?php if ( ! empty( $testimonials ) ) : ?>
                        <?php foreach ( $testimonials as $i => $test ) : ?>
                            <?php ondigital_render_testimonial_row( $i, $test ); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button type="button" class="button add-row-btn" data-repeater="testimonials" data-type="testimonial"><?php esc_html_e( 'Add Testimonial', 'ondigital' ); ?></button>
            </div>

            <!-- Text Slider Tab -->
            <div class="ondigital-tab-content <?php echo $active_tab === 'text_slider' ? 'active' : ''; ?>" data-tab="text_slider">
                <h2><?php esc_html_e( 'Text Slider Items', 'ondigital' ); ?></h2>
                <div id="text_slider-repeater">
                    <?php if ( ! empty( $text_slider ) ) : ?>
                        <?php foreach ( $text_slider as $i => $slide ) : ?>
                            <?php ondigital_render_text_slider_row( $i, $slide ); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button type="button" class="button add-row-btn" data-repeater="text_slider" data-type="text_slider"><?php esc_html_e( 'Add Slide', 'ondigital' ); ?></button>
            </div>

            <?php submit_button( __( 'Save Settings', 'ondigital' ) ); ?>
        </form>
    </div>
    <?php
}

// =============================================================================
// Row Render Functions
// =============================================================================

function ondigital_render_partner_row( $i, $data ) {
    $light_url = ! empty( $data['image_light'] ) ? wp_get_attachment_image_url( $data['image_light'], 'thumbnail' ) : '';
    $dark_url  = ! empty( $data['image_dark'] ) ? wp_get_attachment_image_url( $data['image_dark'], 'thumbnail' ) : '';
    ?>
    <div class="ondigital-repeater-row">
        <button type="button" class="remove-row">&times;</button>
        <label><?php esc_html_e( 'Alt Text', 'ondigital' ); ?></label>
        <input type="text" name="ondigital_partners[<?php echo esc_attr( $i ); ?>][alt]" value="<?php echo esc_attr( $data['alt'] ?? '' ); ?>">
        <label><?php esc_html_e( 'Logo (Light)', 'ondigital' ); ?></label>
        <input type="hidden" name="ondigital_partners[<?php echo esc_attr( $i ); ?>][image_light]" value="<?php echo esc_attr( $data['image_light'] ?? '' ); ?>" class="img-id-field">
        <div class="img-preview"><?php if ( $light_url ) : ?><img src="<?php echo esc_url( $light_url ); ?>" class="ondigital-img-preview"><?php endif; ?></div>
        <button type="button" class="button upload-img-btn"><?php esc_html_e( 'Select', 'ondigital' ); ?></button>
        <button type="button" class="button remove-img-btn"><?php esc_html_e( 'Remove', 'ondigital' ); ?></button>
        <label><?php esc_html_e( 'Logo (Dark)', 'ondigital' ); ?></label>
        <input type="hidden" name="ondigital_partners[<?php echo esc_attr( $i ); ?>][image_dark]" value="<?php echo esc_attr( $data['image_dark'] ?? '' ); ?>" class="img-id-field">
        <div class="img-preview"><?php if ( $dark_url ) : ?><img src="<?php echo esc_url( $dark_url ); ?>" class="ondigital-img-preview"><?php endif; ?></div>
        <button type="button" class="button upload-img-btn"><?php esc_html_e( 'Select', 'ondigital' ); ?></button>
        <button type="button" class="button remove-img-btn"><?php esc_html_e( 'Remove', 'ondigital' ); ?></button>
    </div>
    <?php
}

function ondigital_render_feature_row( $i, $data ) {
    $light_url = ! empty( $data['icon_light'] ) ? wp_get_attachment_image_url( $data['icon_light'], 'thumbnail' ) : '';
    $dark_url  = ! empty( $data['icon_dark'] ) ? wp_get_attachment_image_url( $data['icon_dark'], 'thumbnail' ) : '';
    ?>
    <div class="ondigital-repeater-row">
        <button type="button" class="remove-row">&times;</button>
        <label><?php esc_html_e( 'Title', 'ondigital' ); ?></label>
        <input type="text" name="ondigital_features[<?php echo esc_attr( $i ); ?>][title]" value="<?php echo esc_attr( $data['title'] ?? '' ); ?>">
        <label><?php esc_html_e( 'Description', 'ondigital' ); ?></label>
        <textarea name="ondigital_features[<?php echo esc_attr( $i ); ?>][description]" rows="3"><?php echo esc_textarea( $data['description'] ?? '' ); ?></textarea>
        <label><?php esc_html_e( 'Icon (Light)', 'ondigital' ); ?></label>
        <input type="hidden" name="ondigital_features[<?php echo esc_attr( $i ); ?>][icon_light]" value="<?php echo esc_attr( $data['icon_light'] ?? '' ); ?>" class="img-id-field">
        <div class="img-preview"><?php if ( $light_url ) : ?><img src="<?php echo esc_url( $light_url ); ?>" class="ondigital-img-preview"><?php endif; ?></div>
        <button type="button" class="button upload-img-btn"><?php esc_html_e( 'Select', 'ondigital' ); ?></button>
        <button type="button" class="button remove-img-btn"><?php esc_html_e( 'Remove', 'ondigital' ); ?></button>
        <label><?php esc_html_e( 'Icon (Dark)', 'ondigital' ); ?></label>
        <input type="hidden" name="ondigital_features[<?php echo esc_attr( $i ); ?>][icon_dark]" value="<?php echo esc_attr( $data['icon_dark'] ?? '' ); ?>" class="img-id-field">
        <div class="img-preview"><?php if ( $dark_url ) : ?><img src="<?php echo esc_url( $dark_url ); ?>" class="ondigital-img-preview"><?php endif; ?></div>
        <button type="button" class="button upload-img-btn"><?php esc_html_e( 'Select', 'ondigital' ); ?></button>
        <button type="button" class="button remove-img-btn"><?php esc_html_e( 'Remove', 'ondigital' ); ?></button>
    </div>
    <?php
}

function ondigital_render_pricing_row( $i, $data ) {
    ?>
    <div class="ondigital-repeater-row">
        <button type="button" class="remove-row">&times;</button>
        <label><?php esc_html_e( 'Plan Name', 'ondigital' ); ?></label>
        <input type="text" name="ondigital_pricing[<?php echo esc_attr( $i ); ?>][name]" value="<?php echo esc_attr( $data['name'] ?? '' ); ?>">
        <label><?php esc_html_e( 'Price', 'ondigital' ); ?></label>
        <input type="text" name="ondigital_pricing[<?php echo esc_attr( $i ); ?>][price]" value="<?php echo esc_attr( $data['price'] ?? '' ); ?>">
        <label><?php esc_html_e( 'Features (one per line)', 'ondigital' ); ?></label>
        <textarea name="ondigital_pricing[<?php echo esc_attr( $i ); ?>][features]" rows="5"><?php echo esc_textarea( $data['features'] ?? '' ); ?></textarea>
        <label><?php esc_html_e( 'CTA URL', 'ondigital' ); ?></label>
        <input type="url" name="ondigital_pricing[<?php echo esc_attr( $i ); ?>][cta_url]" value="<?php echo esc_url( $data['cta_url'] ?? '' ); ?>">
    </div>
    <?php
}

function ondigital_render_faq_row( $i, $data ) {
    ?>
    <div class="ondigital-repeater-row">
        <button type="button" class="remove-row">&times;</button>
        <label><?php esc_html_e( 'Question', 'ondigital' ); ?></label>
        <input type="text" name="ondigital_faq[<?php echo esc_attr( $i ); ?>][question]" value="<?php echo esc_attr( $data['question'] ?? '' ); ?>">
        <label><?php esc_html_e( 'Answer', 'ondigital' ); ?></label>
        <textarea name="ondigital_faq[<?php echo esc_attr( $i ); ?>][answer]" rows="3"><?php echo esc_textarea( $data['answer'] ?? '' ); ?></textarea>
        <label>
            <input type="checkbox" name="ondigital_faq[<?php echo esc_attr( $i ); ?>][open]" value="1" <?php checked( ! empty( $data['open'] ) ); ?>>
            <?php esc_html_e( 'Open by default', 'ondigital' ); ?>
        </label>
    </div>
    <?php
}

function ondigital_render_stats_row( $i, $data ) {
    ?>
    <div class="ondigital-repeater-row">
        <button type="button" class="remove-row">&times;</button>
        <label><?php esc_html_e( 'Number', 'ondigital' ); ?></label>
        <input type="text" name="ondigital_stats[<?php echo esc_attr( $i ); ?>][number]" value="<?php echo esc_attr( $data['number'] ?? '' ); ?>">
        <label><?php esc_html_e( 'Label', 'ondigital' ); ?></label>
        <input type="text" name="ondigital_stats[<?php echo esc_attr( $i ); ?>][label]" value="<?php echo esc_attr( $data['label'] ?? '' ); ?>">
    </div>
    <?php
}

function ondigital_render_testimonial_row( $i, $data ) {
    ?>
    <div class="ondigital-repeater-row">
        <button type="button" class="remove-row">&times;</button>
        <label><?php esc_html_e( 'Quote', 'ondigital' ); ?></label>
        <textarea name="ondigital_testimonials[<?php echo esc_attr( $i ); ?>][quote]" rows="3"><?php echo esc_textarea( $data['quote'] ?? '' ); ?></textarea>
        <label><?php esc_html_e( 'Name', 'ondigital' ); ?></label>
        <input type="text" name="ondigital_testimonials[<?php echo esc_attr( $i ); ?>][name]" value="<?php echo esc_attr( $data['name'] ?? '' ); ?>">
        <label><?php esc_html_e( 'Role', 'ondigital' ); ?></label>
        <input type="text" name="ondigital_testimonials[<?php echo esc_attr( $i ); ?>][role]" value="<?php echo esc_attr( $data['role'] ?? '' ); ?>">
    </div>
    <?php
}

function ondigital_render_text_slider_row( $i, $data ) {
    ?>
    <div class="ondigital-repeater-row">
        <button type="button" class="remove-row">&times;</button>
        <label><?php esc_html_e( 'Text', 'ondigital' ); ?></label>
        <input type="text" name="ondigital_text_slider[<?php echo esc_attr( $i ); ?>][text]" value="<?php echo esc_attr( $data['text'] ?? '' ); ?>">
        <label><?php esc_html_e( 'Highlighted Word', 'ondigital' ); ?></label>
        <input type="text" name="ondigital_text_slider[<?php echo esc_attr( $i ); ?>][highlighted]" value="<?php echo esc_attr( $data['highlighted'] ?? '' ); ?>">
    </div>
    <?php
}
