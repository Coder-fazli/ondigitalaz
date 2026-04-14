<?php
/**
 * OnDigital Forms — Admin Menu & Pages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// =============================================================================
// Menu registration
// =============================================================================

add_action( 'admin_menu', 'odf_admin_menu' );
function odf_admin_menu(): void {
    // Main menu → Templates list
    add_menu_page(
        'OnDigital Forms',
        'OD Forms',
        'manage_options',
        'odf-templates',
        'odf_render_templates',
        'dashicons-email-alt2',
        58
    );

    add_submenu_page( 'odf-templates', 'Templates',  'Templates',  'manage_options', 'odf-templates',  'odf_render_templates' );
    add_submenu_page( 'odf-templates', 'Settings',   'Settings',   'manage_options', 'odf-settings',   'odf_render_settings' );
}

// Enqueue admin assets
add_action( 'admin_enqueue_scripts', 'odf_admin_enqueue' );
function odf_admin_enqueue( string $hook ): void {
    if ( strpos( $hook, 'odf-' ) === false ) {
        return;
    }
    wp_enqueue_style( 'odf-admin', ODF_URI . 'assets/css/admin.css', array(), ODF_VERSION );
    wp_enqueue_script( 'odf-admin', ODF_URI . 'assets/js/admin.js', array( 'jquery' ), ODF_VERSION, true );
    wp_localize_script( 'odf-admin', 'odfAdmin', array(
        'nonce'   => wp_create_nonce( 'odf_save_settings' ),
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'saved'   => __( 'Saved!', 'odf' ),
        'saving'  => __( 'Saving...', 'odf' ),
    ) );
}

// Save settings AJAX
add_action( 'wp_ajax_odf_save_settings', 'odf_save_settings_handler' );
function odf_save_settings_handler(): void {
    check_ajax_referer( 'odf_save_settings', 'nonce' );
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Unauthorized' );
    }

    $raw  = isset( $_POST['options'] ) ? wp_unslash( $_POST['options'] ) : '{}';
    $data = json_decode( $raw, true );
    if ( ! is_array( $data ) ) {
        wp_send_json_error( 'Invalid data' );
    }

    $existing = get_option( 'odf_options', array() );
    $updated  = $existing;

    $toggle_keys = array( 'field_name', 'field_email', 'field_phone', 'field_company', 'field_radio', 'field_source' );

    foreach ( $data as $key => $value ) {
        $key = sanitize_key( $key );
        if ( is_array( $value ) ) {
            continue;
        }
        if ( $key === 'recipient_email' ) {
            $updated[ $key ] = sanitize_email( $value );
        } elseif ( in_array( $key, $toggle_keys, true ) ) {
            $updated[ $key ] = $value ? '1' : '0';
        } else {
            $updated[ $key ] = sanitize_text_field( $value );
        }
    }

    update_option( 'odf_options', $updated );
    wp_send_json_success( array( 'message' => 'Saved!' ) );
}

// =============================================================================
// Templates registry — add new templates here in the future
// =============================================================================

function odf_get_templates(): array {
    return array(
        'contact-popup' => array(
            'id'          => 'contact-popup',
            'name'        => 'Contact Popup',
            'description' => 'Full-screen popup form triggered by any button with data-od-form="contact". Includes name, email, phone, company, e-commerce question and source question.',
            'trigger'     => 'data-od-form="contact"',
            'icon'        => 'dashicons-format-chat',
            'status'      => 'active',
        ),
    );
}

// =============================================================================
// Templates list page
// =============================================================================

function odf_render_templates(): void {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // Handle edit mode
    $edit = isset( $_GET['edit'] ) ? sanitize_key( $_GET['edit'] ) : '';
    $templates = odf_get_templates();

    if ( $edit && isset( $templates[ $edit ] ) ) {
        odf_render_template_edit( $templates[ $edit ] );
        return;
    }
    ?>
    <div class="odf-admin-wrap">
        <div class="odf-topbar">
            <h1>Templates</h1>
        </div>

        <div class="odf-template-grid">
            <?php foreach ( $templates as $tpl ) :
                $edit_url = admin_url( 'admin.php?page=odf-templates&edit=' . $tpl['id'] );
            ?>
            <div class="odf-template-card">
                <div class="odf-tpl-icon">
                    <span class="dashicons <?php echo esc_attr( $tpl['icon'] ); ?>"></span>
                </div>
                <div class="odf-tpl-body">
                    <h3><?php echo esc_html( $tpl['name'] ); ?></h3>
                    <p><?php echo esc_html( $tpl['description'] ); ?></p>
                    <code class="odf-tpl-trigger"><?php echo esc_html( $tpl['trigger'] ); ?></code>
                </div>
                <div class="odf-tpl-footer">
                    <span class="odf-tpl-status odf-tpl-status--<?php echo esc_attr( $tpl['status'] ); ?>">
                        <?php echo esc_html( ucfirst( $tpl['status'] ) ); ?>
                    </span>
                    <a href="<?php echo esc_url( $edit_url ); ?>" class="odf-tpl-edit-btn">Edit Template</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}

// =============================================================================
// Template edit page
// =============================================================================

function odf_render_template_edit( array $tpl ): void {
    $opts = get_option( 'odf_options', odf_default_options() );
    $back = admin_url( 'admin.php?page=odf-templates' );

    $o = function( string $key ) use ( $opts ): string {
        return esc_attr( $opts[ $key ] ?? '' );
    };
    $checked = function( string $key ) use ( $opts ): string {
        return ! empty( $opts[ $key ] ) ? 'checked' : '';
    };
    ?>
    <div class="odf-admin-wrap">
        <div class="odf-topbar">
            <div style="display:flex;align-items:center;gap:12px;">
                <a href="<?php echo esc_url( $back ); ?>" class="odf-back-btn">← Templates</a>
                <h1><?php echo esc_html( $tpl['name'] ); ?></h1>
            </div>
            <div style="display:flex;align-items:center;gap:14px;">
                <span id="odf-save-notice"></span>
                <button id="odf-save-btn" class="odf-save-btn">Save Changes</button>
            </div>
        </div>

        <form id="odf-settings-form">

            <!-- Form Content -->
            <div class="odf-card">
                <div class="odf-card-head">
                    <span class="dashicons dashicons-edit"></span>
                    <h3>Form Content</h3>
                    <span class="dashicons dashicons-arrow-down odf-toggle-icon"></span>
                </div>
                <div class="odf-card-body">
                    <div class="odf-lang-wrap">
                        <div class="odf-lang-tabs">
                            <span class="odf-lang-tab active" data-lang="az">🇦🇿 AZ</span>
                            <span class="odf-lang-tab" data-lang="en">🇬🇧 EN</span>
                        </div>
                        <?php foreach ( array( 'az', 'en' ) as $lang ) : ?>
                        <div class="odf-lang-pane <?php echo $lang === 'az' ? 'active' : ''; ?>" data-lang="<?php echo $lang; ?>">
                            <div class="odf-field-row">
                                <div class="odf-field">
                                    <label>Form Title</label>
                                    <input type="text" name="options[form_title_<?php echo $lang; ?>]" value="<?php echo $o( 'form_title_' . $lang ); ?>">
                                </div>
                                <div class="odf-field">
                                    <label>Submit Button Text</label>
                                    <input type="text" name="options[btn_text_<?php echo $lang; ?>]" value="<?php echo $o( 'btn_text_' . $lang ); ?>">
                                </div>
                            </div>
                            <div class="odf-field">
                                <label>Success Message (shown after submit)</label>
                                <input type="text" name="options[success_<?php echo $lang; ?>]" value="<?php echo $o( 'success_' . $lang ); ?>">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Form Fields -->
            <div class="odf-card">
                <div class="odf-card-head">
                    <span class="dashicons dashicons-list-view"></span>
                    <h3>Form Fields</h3>
                    <span class="dashicons dashicons-arrow-down odf-toggle-icon"></span>
                </div>
                <div class="odf-card-body">
                    <p class="odf-desc">Toggle which fields appear in the popup form.</p>
                    <div class="odf-toggles">
                        <?php
                        $fields = array(
                            'field_name'    => 'Full Name',
                            'field_email'   => 'Email',
                            'field_phone'   => 'Phone',
                            'field_company' => 'Company Name',
                            'field_radio'   => 'E-commerce Question (Yes / No / Starting Up)',
                            'field_source'  => 'Source Question (How did you hear about us)',
                        );
                        foreach ( $fields as $key => $label ) :
                        ?>
                        <label class="odf-toggle-row">
                            <input type="checkbox" name="options[<?php echo esc_attr( $key ); ?>]" value="1" <?php echo $checked( $key ); ?>>
                            <span class="odf-toggle-slider"></span>
                            <?php echo esc_html( $label ); ?>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- E-commerce Question -->
            <div class="odf-card">
                <div class="odf-card-head">
                    <span class="dashicons dashicons-yes-alt"></span>
                    <h3>E-commerce Question &amp; Options</h3>
                    <span class="dashicons dashicons-arrow-down odf-toggle-icon"></span>
                </div>
                <div class="odf-card-body">
                    <div class="odf-lang-wrap">
                        <div class="odf-lang-tabs">
                            <span class="odf-lang-tab active" data-lang="az">🇦🇿 AZ</span>
                            <span class="odf-lang-tab" data-lang="en">🇬🇧 EN</span>
                        </div>
                        <?php foreach ( array( 'az', 'en' ) as $lang ) : ?>
                        <div class="odf-lang-pane <?php echo $lang === 'az' ? 'active' : ''; ?>" data-lang="<?php echo $lang; ?>">
                            <div class="odf-field">
                                <label>Question Label</label>
                                <input type="text" name="options[radio_question_<?php echo $lang; ?>]" value="<?php echo $o( 'radio_question_' . $lang ); ?>">
                            </div>
                            <div class="odf-field-row">
                                <div class="odf-field">
                                    <label>Option 1 — Yes</label>
                                    <input type="text" name="options[radio_opt1_<?php echo $lang; ?>]" value="<?php echo $o( 'radio_opt1_' . $lang ); ?>">
                                </div>
                                <div class="odf-field">
                                    <label>Option 2 — No</label>
                                    <input type="text" name="options[radio_opt2_<?php echo $lang; ?>]" value="<?php echo $o( 'radio_opt2_' . $lang ); ?>">
                                </div>
                                <div class="odf-field">
                                    <label>Option 3 — Starting Up</label>
                                    <input type="text" name="options[radio_opt3_<?php echo $lang; ?>]" value="<?php echo $o( 'radio_opt3_' . $lang ); ?>">
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Source Question -->
            <div class="odf-card">
                <div class="odf-card-head">
                    <span class="dashicons dashicons-megaphone"></span>
                    <h3>Source Question &amp; Options</h3>
                    <span class="dashicons dashicons-arrow-down odf-toggle-icon"></span>
                </div>
                <div class="odf-card-body">
                    <div class="odf-lang-wrap">
                        <div class="odf-lang-tabs">
                            <span class="odf-lang-tab active" data-lang="az">🇦🇿 AZ</span>
                            <span class="odf-lang-tab" data-lang="en">🇬🇧 EN</span>
                        </div>
                        <?php foreach ( array( 'az', 'en' ) as $lang ) : ?>
                        <div class="odf-lang-pane <?php echo $lang === 'az' ? 'active' : ''; ?>" data-lang="<?php echo $lang; ?>">
                            <div class="odf-field">
                                <label>Question Label</label>
                                <input type="text" name="options[source_question_<?php echo $lang; ?>]" value="<?php echo $o( 'source_question_' . $lang ); ?>">
                            </div>
                            <div class="odf-field-row">
                                <?php foreach ( array( 'instagram', 'tiktok', 'facebook', 'linkedin', 'youtube', 'other' ) as $src ) : ?>
                                <div class="odf-field">
                                    <label><?php echo esc_html( ucfirst( $src ) ); ?></label>
                                    <input type="text" name="options[src_<?php echo $src; ?>_<?php echo $lang; ?>]" value="<?php echo $o( 'src_' . $src . '_' . $lang ); ?>">
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <?php
}

// =============================================================================
// Settings page (global)
// =============================================================================

function odf_render_settings(): void {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    $opts = get_option( 'odf_options', odf_default_options() );
    $o    = function( string $key ) use ( $opts ): string {
        return esc_attr( $opts[ $key ] ?? '' );
    };
    ?>
    <div class="odf-admin-wrap">
        <div class="odf-topbar">
            <h1>Settings</h1>
            <div style="display:flex;align-items:center;gap:14px;">
                <span id="odf-save-notice"></span>
                <button id="odf-save-btn" class="odf-save-btn">Save Changes</button>
            </div>
        </div>

        <form id="odf-settings-form">
            <div class="odf-card">
                <div class="odf-card-head">
                    <span class="dashicons dashicons-email-alt"></span>
                    <h3>Notifications</h3>
                    <span class="dashicons dashicons-arrow-down odf-toggle-icon"></span>
                </div>
                <div class="odf-card-body">
                    <div class="odf-field">
                        <label>Recipient Email — all form submissions will be sent here</label>
                        <input type="email" name="options[recipient_email]" value="<?php echo $o( 'recipient_email' ); ?>">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php
}
