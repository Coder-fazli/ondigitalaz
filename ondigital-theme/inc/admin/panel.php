<?php
/**
 * OnDigital Admin Panel
 * Jannah-style theme options panel with AZ/EN language support.
 *
 * @package OnDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once ONDIGITAL_DIR . '/inc/admin/save.php';
require_once ONDIGITAL_DIR . '/inc/admin/fields.php';

// =============================================================================
// Register Menu
// =============================================================================

add_action( 'admin_menu', 'ondigital_panel_menu' );
function ondigital_panel_menu(): void {
    add_menu_page(
        'OnDigital',
        'OnDigital',
        'manage_options',
        'ondigital',
        'ondigital_panel_render',
        'dashicons-admin-customizer',
        3
    );

    add_submenu_page( 'ondigital', __( 'General', 'ondigital' ),   __( 'General', 'ondigital' ),   'manage_options', 'ondigital',                   'ondigital_panel_render' );
    add_submenu_page( 'ondigital', __( 'Header', 'ondigital' ),   __( 'Header', 'ondigital' ),    'manage_options', 'ondigital&section=header',    'ondigital_panel_render' );
    add_submenu_page( 'ondigital', __( 'Home Page', 'ondigital' ), __( 'Home Page', 'ondigital' ), 'manage_options', 'ondigital&section=home',     'ondigital_panel_render' );
    add_submenu_page( 'ondigital', __( 'About Page', 'ondigital' ), __( 'About Page', 'ondigital' ), 'manage_options', 'ondigital&section=about', 'ondigital_panel_render' );
    add_submenu_page( 'ondigital', __( 'Project Page', 'ondigital' ), __( 'Project Page', 'ondigital' ), 'manage_options', 'ondigital&section=project', 'ondigital_panel_render' );
    add_submenu_page( 'ondigital', __( 'Service Page', 'ondigital' ), __( 'Service Page', 'ondigital' ), 'manage_options', 'ondigital&section=service', 'ondigital_panel_render' );
    add_submenu_page( 'ondigital', __( 'Contact Page', 'ondigital' ), __( 'Contact Page', 'ondigital' ), 'manage_options', 'ondigital&section=contact', 'ondigital_panel_render' );
    add_submenu_page( 'ondigital', __( 'Blog Page', 'ondigital' ), __( 'Blog Page', 'ondigital' ), 'manage_options', 'ondigital&section=blog', 'ondigital_panel_render' );
    add_submenu_page( 'ondigital', __( 'Checklist Page', 'ondigital' ), __( 'Checklist Page', 'ondigital' ), 'manage_options', 'ondigital&section=checklist',  'ondigital_panel_render' );
    add_submenu_page( 'ondigital', __( 'Dictionary Page', 'ondigital' ), __( 'Dictionary Page', 'ondigital' ), 'manage_options', 'ondigital&section=dictionary', 'ondigital_panel_render' );
    add_submenu_page( 'ondigital', __( 'Footer', 'ondigital' ),    __( 'Footer', 'ondigital' ),    'manage_options', 'ondigital&section=footer',   'ondigital_panel_render' );
}

// =============================================================================
// Enqueue Admin Assets
// =============================================================================

add_action( 'admin_enqueue_scripts', 'ondigital_panel_assets' );
function ondigital_panel_assets( string $hook ): void {
    if ( ! in_array( $hook, array( 'toplevel_page_ondigital', 'ondigital_page_ondigital' ), true ) ) {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_style( 'ondigital-panel', ONDIGITAL_URI . '/assets/css/admin/panel.css', array(), ONDIGITAL_VERSION );
    wp_enqueue_script( 'ondigital-panel', ONDIGITAL_URI . '/assets/js/admin/panel.js', array( 'jquery' ), ONDIGITAL_VERSION, true );
    wp_localize_script( 'ondigital-panel', 'odPanel', array(
        'nonce'   => wp_create_nonce( 'ondigital_save' ),
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'saved'   => __( 'Saved!', 'ondigital' ),
        'saving'  => __( 'Saving...', 'ondigital' ),
    ) );
}

// =============================================================================
// Panel Sections Config
// =============================================================================

function ondigital_panel_sections(): array {
    return array(
        'general' => array(
            'title' => __( 'General', 'ondigital' ),
            'icon'  => 'dashicons-admin-settings',
            'file'  => 'general',
        ),
        'header' => array(
            'title' => __( 'Header', 'ondigital' ),
            'icon'  => 'dashicons-minus',
            'file'  => 'header',
        ),
        'home' => array(
            'title' => __( 'Home Page', 'ondigital' ),
            'icon'  => 'dashicons-admin-home',
            'file'  => 'home',
        ),
        'about' => array(
            'title' => __( 'About Page', 'ondigital' ),
            'icon'  => 'dashicons-info',
            'file'  => 'about',
        ),
        'project' => array(
            'title' => __( 'Project Page', 'ondigital' ),
            'icon'  => 'dashicons-portfolio',
            'file'  => 'project',
        ),
        'service' => array(
            'title' => __( 'Service Page', 'ondigital' ),
            'icon'  => 'dashicons-admin-tools',
            'file'  => 'service',
        ),
        'contact' => array(
            'title' => __( 'Contact Page', 'ondigital' ),
            'icon'  => 'dashicons-email-alt2',
            'file'  => 'contact',
        ),
        'blog' => array(
            'title' => __( 'Blog Page', 'ondigital' ),
            'icon'  => 'dashicons-edit',
            'file'  => 'blog',
        ),
        'checklist' => array(
            'title' => __( 'Checklist Page', 'ondigital' ),
            'icon'  => 'dashicons-yes-alt',
            'file'  => 'checklist',
        ),
        'dictionary' => array(
            'title' => __( 'Dictionary Page', 'ondigital' ),
            'icon'  => 'dashicons-book-alt',
            'file'  => 'dictionary',
        ),
        'footer' => array(
            'title' => __( 'Footer', 'ondigital' ),
            'icon'  => 'dashicons-layout',
            'file'  => 'footer',
        ),
    );
}

// =============================================================================
// Render Panel
// =============================================================================

function ondigital_panel_render(): void {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $sections       = ondigital_panel_sections();
    $active_section = isset( $_GET['section'] ) ? sanitize_key( $_GET['section'] ) : 'general';
    if ( ! array_key_exists( $active_section, $sections ) ) {
        $active_section = 'general';
    }

    $logo_url = ONDIGITAL_URI . '/assets/imgs/logo/logo.png';
    ?>
    <div id="ondigital-panel">

        <!-- Sidebar -->
        <div id="ondigital-sidebar">
            <div class="od-logo">
                <img src="<?php echo esc_url( $logo_url ); ?>" alt="OnDigital">
            </div>

            <div class="od-nav-head"><?php esc_html_e( 'Settings', 'ondigital' ); ?></div>
            <ul>
                <?php foreach ( $sections as $key => $section ) :
                    $url    = admin_url( 'admin.php?page=ondigital' . ( $key !== 'general' ? '&section=' . $key : '' ) );
                    $active = $active_section === $key ? 'active' : '';
                ?>
                    <li class="<?php echo esc_attr( $active ); ?>">
                        <a href="<?php echo esc_url( $url ); ?>">
                            <span class="dashicons <?php echo esc_attr( $section['icon'] ); ?>"></span>
                            <?php echo esc_html( $section['title'] ); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Content -->
        <div id="ondigital-content">

            <!-- Top bar -->
            <div id="ondigital-topbar">
                <h2><?php echo esc_html( $sections[ $active_section ]['title'] ); ?></h2>
                <div style="display:flex;align-items:center;gap:16px;">
                    <span id="od-save-notice"></span>
                    <button type="button" class="od-save-btn" id="od-save-btn">
                        <?php esc_html_e( 'Save Changes', 'ondigital' ); ?>
                    </button>
                </div>
            </div>

            <!-- Section content -->
            <form id="od-panel-form">
                <?php
                $section_file = ONDIGITAL_DIR . '/inc/admin/sections/' . $sections[ $active_section ]['file'] . '.php';
                if ( file_exists( $section_file ) ) {
                    $options = get_option( 'ondigital_options', array() );
                    include $section_file;
                }
                ?>
            </form>

        </div>
    </div>

    <!-- Floating Save Button -->
    <button type="button" class="od-save-btn od-save-float" id="od-save-float">
        <?php esc_html_e( 'Save Changes', 'ondigital' ); ?>
    </button>
    <?php
}
