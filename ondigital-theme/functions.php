<?php
/**
 * OnDigital Theme Functions
 *
 * @package OnDigital
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'ONDIGITAL_VERSION', '1.0.0' );
define( 'ONDIGITAL_DIR', get_template_directory() );
define( 'ONDIGITAL_URI', get_template_directory_uri() );

// Include files
require_once ONDIGITAL_DIR . '/inc/helpers.php';
require_once ONDIGITAL_DIR . '/inc/customizer.php';
require_once ONDIGITAL_DIR . '/inc/meta-boxes.php';
require_once ONDIGITAL_DIR . '/inc/admin-page.php';

// =============================================================================
// 1. THEME SETUP
// =============================================================================

add_action( 'after_setup_theme', 'ondigital_setup' );
function ondigital_setup() {
    // Translation support
    load_theme_textdomain( 'ondigital', ONDIGITAL_DIR . '/languages' );

    // HTML5 support
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Title tag
    add_theme_support( 'title-tag' );

    // Post thumbnails
    add_theme_support( 'post-thumbnails' );

    // Custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Navigation menus
    register_nav_menus( array(
        'primary'   => __( 'Primary Menu', 'ondigital' ),
        'footer'    => __( 'Footer Menu', 'ondigital' ),
        'services'  => __( 'Services Menu', 'ondigital' ),
    ) );

    // Image sizes
    add_image_size( 'ondigital-hero', 1920, 1080, true );
    add_image_size( 'ondigital-blog-card', 600, 400, true );
    add_image_size( 'ondigital-project-card', 800, 600, true );
    add_image_size( 'ondigital-service-icon', 120, 120, true );
}

/**
 * Create default pages and menus on theme activation.
 */
add_action( 'after_switch_theme', 'ondigital_setup_demo_content' );
function ondigital_setup_demo_content() {
    // Only run once
    if ( get_option( 'ondigital_demo_installed' ) ) {
        return;
    }

    // Pages to create: slug => array( title, template )
    $pages = array(
        'ana-sehife'  => array( 'Ana Səhifə',  'templates/page-home.php' ),
        'haqqimizda'  => array( 'Haqqımızda',   'templates/page-about.php' ),
        'xidmetler'   => array( 'Xidmətlər',    'templates/page-services.php' ),
        'layiheler'   => array( 'Layihələr',     'templates/page-projects.php' ),
        'komanda'     => array( 'Komanda',       'templates/page-team.php' ),
        'blog'        => array( 'Blog',          'templates/page-blog.php' ),
        'elaqe'       => array( 'Əlaqə',        'templates/page-contact.php' ),
        'faq'         => array( 'FAQ',           'templates/page-faq.php' ),
        'teklif-al'   => array( 'Təklif Al',     'templates/page-quote.php' ),
    );

    $page_ids = array();
    foreach ( $pages as $slug => $data ) {
        $existing = get_page_by_path( $slug );
        if ( $existing ) {
            $page_ids[ $slug ] = $existing->ID;
            // Make sure template is set
            update_post_meta( $existing->ID, '_wp_page_template', $data[1] );
            continue;
        }
        $page_id = wp_insert_post( array(
            'post_title'   => $data[0],
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'page_template' => $data[1],
        ) );
        if ( ! is_wp_error( $page_id ) ) {
            $page_ids[ $slug ] = $page_id;
            update_post_meta( $page_id, '_wp_page_template', $data[1] );
        }
    }

    // Set homepage
    if ( isset( $page_ids['ana-sehife'] ) ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $page_ids['ana-sehife'] );
    }

    // Set permalinks to post name
    update_option( 'permalink_structure', '/%postname%/' );
    flush_rewrite_rules();

    // Create Primary Menu
    $menu_name = 'Primary Menu';
    $menu_exists = wp_get_nav_menu_object( $menu_name );
    if ( ! $menu_exists ) {
        $menu_id = wp_create_nav_menu( $menu_name );

        // Ana Səhifə
        if ( isset( $page_ids['ana-sehife'] ) ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'     => 'Ana Səhifə',
                'menu-item-object'    => 'page',
                'menu-item-object-id' => $page_ids['ana-sehife'],
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
            ) );
        }

        // Haqqımızda
        if ( isset( $page_ids['haqqimizda'] ) ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'     => 'Haqqımızda',
                'menu-item-object'    => 'page',
                'menu-item-object-id' => $page_ids['haqqimizda'],
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
            ) );
        }

        // Xidmətlər (parent)
        $services_id = 0;
        if ( isset( $page_ids['xidmetler'] ) ) {
            $services_id = wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'     => 'Xidmətlər',
                'menu-item-object'    => 'page',
                'menu-item-object-id' => $page_ids['xidmetler'],
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
            ) );
        }

        // Layihələr
        if ( isset( $page_ids['layiheler'] ) ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'     => 'Layihələr',
                'menu-item-object'    => 'page',
                'menu-item-object-id' => $page_ids['layiheler'],
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
            ) );
        }

        // Səhifələr (parent - custom link)
        $pages_parent_id = wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title'  => 'Səhifələr',
            'menu-item-url'    => '#',
            'menu-item-type'   => 'custom',
            'menu-item-status' => 'publish',
        ) );

        // Səhifələr children
        if ( isset( $page_ids['komanda'] ) ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'      => 'Komanda',
                'menu-item-object'     => 'page',
                'menu-item-object-id'  => $page_ids['komanda'],
                'menu-item-type'       => 'post_type',
                'menu-item-status'     => 'publish',
                'menu-item-parent-id'  => $pages_parent_id,
            ) );
        }
        if ( isset( $page_ids['faq'] ) ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'      => 'FAQ',
                'menu-item-object'     => 'page',
                'menu-item-object-id'  => $page_ids['faq'],
                'menu-item-type'       => 'post_type',
                'menu-item-status'     => 'publish',
                'menu-item-parent-id'  => $pages_parent_id,
            ) );
        }
        if ( isset( $page_ids['teklif-al'] ) ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'      => 'Təklif Al',
                'menu-item-object'     => 'page',
                'menu-item-object-id'  => $page_ids['teklif-al'],
                'menu-item-type'       => 'post_type',
                'menu-item-status'     => 'publish',
                'menu-item-parent-id'  => $pages_parent_id,
            ) );
        }

        // Blog
        if ( isset( $page_ids['blog'] ) ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'     => 'Blog',
                'menu-item-object'    => 'page',
                'menu-item-object-id' => $page_ids['blog'],
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
            ) );
        }

        // Əlaqə
        if ( isset( $page_ids['elaqe'] ) ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'     => 'Əlaqə',
                'menu-item-object'    => 'page',
                'menu-item-object-id' => $page_ids['elaqe'],
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
            ) );
        }

        // Assign menu to Primary location
        $locations = get_theme_mod( 'nav_menu_locations', array() );
        $locations['primary'] = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }

    update_option( 'ondigital_demo_installed', true );
}

/**
 * Fallback menu when no menu is assigned in wp-admin.
 */
function ondigital_fallback_menu() {
    echo '<ul>';
    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Ana Səhifə', 'ondigital' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/haqqimizda/' ) ) . '">' . esc_html__( 'Haqqımızda', 'ondigital' ) . '</a></li>';
    echo '<li class="menu-item-has-children"><a href="' . esc_url( home_url( '/xidmetler/' ) ) . '">' . esc_html__( 'Xidmətlər', 'ondigital' ) . '</a>';
    echo '<ul class="dp-menu">';
    echo '<li><a href="' . esc_url( home_url( '/xidmetler/' ) ) . '">' . esc_html__( 'Bütün Xidmətlər', 'ondigital' ) . '</a></li>';
    echo '</ul></li>';
    echo '<li><a href="' . esc_url( home_url( '/layiheler/' ) ) . '">' . esc_html__( 'Layihələr', 'ondigital' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/komanda/' ) ) . '">' . esc_html__( 'Komanda', 'ondigital' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/blog/' ) ) . '">' . esc_html__( 'Blog', 'ondigital' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/elaqe/' ) ) . '">' . esc_html__( 'Əlaqə', 'ondigital' ) . '</a></li>';
    echo '</ul>';
}


// =============================================================================
// CUSTOM NAV WALKER - Matches Arolax HTML menu structure
// =============================================================================

class OnDigital_Nav_Walker extends Walker_Nav_Menu {

    /**
     * Starts the list before the elements are added.
     * Outputs `dp-menu` instead of WordPress default `sub-menu`.
     */
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat( "\t", $depth );
        $classes = array( 'dp-menu' );

        $class_names = implode( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $output .= "\n{$indent}<ul{$class_names}>\n";
    }

    /**
     * Starts the element output.
     * Adds `menu-item-has-children` class for parent items.
     */
    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        $item = $data_object;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $classes   = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // WordPress already adds menu-item-has-children, keep it
        $class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts           = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        $atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
        $atts['href']   = ! empty( $item->url ) ? $item->url : '';

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

        $item_output  = $args->before ?? '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= ( $args->link_before ?? '' ) . $title . ( $args->link_after ?? '' );
        $item_output .= '</a>';
        $item_output .= $args->after ?? '';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}


// =============================================================================
// 2. ENQUEUE STYLES & SCRIPTS
// =============================================================================

add_action( 'wp_enqueue_scripts', 'ondigital_enqueue_assets' );
function ondigital_enqueue_assets() {

    // --- Global Vendor CSS ---
    wp_enqueue_style( 'bootstrap', ONDIGITAL_URI . '/assets/css/vendor/bootstrap.min.css', array(), '5.3.0' );
    wp_enqueue_style( 'fontawesome', ONDIGITAL_URI . '/assets/css/vendor/all.min.css', array(), '6.5.0' );
    wp_enqueue_style( 'swiper', ONDIGITAL_URI . '/assets/css/vendor/swiper-bundle.min.css', array(), '11.0.0' );
    wp_enqueue_style( 'progressbar', ONDIGITAL_URI . '/assets/css/vendor/progressbar.css', array(), '1.0.0' );
    wp_enqueue_style( 'meanmenu', ONDIGITAL_URI . '/assets/css/vendor/meanmenu.min.css', array(), '2.0.8' );
    wp_enqueue_style( 'magnific-popup', ONDIGITAL_URI . '/assets/css/vendor/magnific-popup.css', array(), '1.1.0' );

    // --- Page-Specific Master CSS (each includes all needed styles) ---
    ondigital_enqueue_page_assets();

    // --- Global Vendor JS ---
    wp_enqueue_script( 'jquery' ); // WP bundled jQuery
    wp_enqueue_script( 'bootstrap-bundle', ONDIGITAL_URI . '/assets/js/vendor/bootstrap.bundle.min.js', array( 'jquery' ), '5.3.0', true );
    wp_enqueue_script( 'gsap', ONDIGITAL_URI . '/assets/js/vendor/gsap.min.js', array(), '3.12.0', true );
    wp_enqueue_script( 'gsap-scroll-trigger', ONDIGITAL_URI . '/assets/js/vendor/ScrollTrigger.min.js', array( 'gsap' ), '3.12.0', true );
    wp_enqueue_script( 'gsap-scroll-smoother', ONDIGITAL_URI . '/assets/js/vendor/ScrollSmoother.min.js', array( 'gsap' ), '3.12.0', true );
    wp_enqueue_script( 'gsap-scroll-to', ONDIGITAL_URI . '/assets/js/vendor/ScrollToPlugin.min.js', array( 'gsap' ), '3.12.0', true );
    wp_enqueue_script( 'gsap-split-text', ONDIGITAL_URI . '/assets/js/vendor/SplitText.min.js', array( 'gsap' ), '3.12.0', true );
    wp_enqueue_script( 'swiper', ONDIGITAL_URI . '/assets/js/vendor/swiper-bundle.min.js', array(), '11.0.0', true );
    wp_enqueue_script( 'magnific-popup', ONDIGITAL_URI . '/assets/js/vendor/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
    wp_enqueue_script( 'meanmenu', ONDIGITAL_URI . '/assets/js/vendor/jquery.meanmenu.min.js', array( 'jquery' ), '2.0.8', true );
    wp_enqueue_script( 'counter-up', ONDIGITAL_URI . '/assets/js/vendor/counter.js', array(), '2.1.0', true );
    wp_enqueue_script( 'progressbar-js', ONDIGITAL_URI . '/assets/js/vendor/progressbar.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'lottie', ONDIGITAL_URI . '/assets/js/vendor/lottie.min.js', array(), '5.12.2', true );

    // --- Global Theme JS ---
    wp_enqueue_script( 'ondigital-global', ONDIGITAL_URI . '/assets/js/global.js', array( 'jquery', 'gsap', 'bootstrap-bundle' ), ONDIGITAL_VERSION, true );

    // Localize for AJAX
    wp_localize_script( 'ondigital-global', 'ondigital_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'ondigital_nonce' ),
        'site_url' => home_url( '/' ),
    ) );
}

/**
 * Conditionally enqueue per-page CSS/JS based on the current template.
 */
function ondigital_enqueue_page_assets() {
    $page_styles = array(
        'page-home.php'            => 'home',
        'page-about.php'           => 'about',
        'page-services.php'        => 'services',
        'page-service-details.php' => 'service-details',
        'page-projects.php'        => 'projects',
        'page-blog.php'            => 'blog',
        'page-contact.php'         => 'contact',
        'page-quote.php'           => 'quote',
        'page-faq.php'             => 'faq',
        'page-team.php'            => 'team',
    );

    foreach ( $page_styles as $template => $slug ) {
        if ( is_page_template( 'templates/' . $template ) ) {
            $css_file = ONDIGITAL_DIR . '/assets/css/pages/' . $slug . '.css';
            if ( file_exists( $css_file ) ) {
                wp_enqueue_style( 'ondigital-' . $slug, ONDIGITAL_URI . '/assets/css/pages/' . $slug . '.css', array( 'bootstrap' ), ONDIGITAL_VERSION );
            }

            $js_file = ONDIGITAL_DIR . '/assets/js/pages/' . $slug . '.js';
            if ( file_exists( $js_file ) ) {
                wp_enqueue_script( 'ondigital-' . $slug, ONDIGITAL_URI . '/assets/js/pages/' . $slug . '.js', array( 'jquery', 'swiper', 'ondigital-global' ), ONDIGITAL_VERSION, true );
            }
            break;
        }
    }

    // Blog single post
    if ( is_singular( 'post' ) ) {
        $css_file = ONDIGITAL_DIR . '/assets/css/pages/blog-details.css';
        if ( file_exists( $css_file ) ) {
            wp_enqueue_style( 'ondigital-blog-details', ONDIGITAL_URI . '/assets/css/pages/blog-details.css', array( 'bootstrap' ), ONDIGITAL_VERSION );
        }
        $js_file = ONDIGITAL_DIR . '/assets/js/pages/blog-details.js';
        if ( file_exists( $js_file ) ) {
            wp_enqueue_script( 'ondigital-blog-details', ONDIGITAL_URI . '/assets/js/pages/blog-details.js', array( 'bootstrap' ), ONDIGITAL_VERSION, true );
        }
    }

    // Single Service
    if ( is_singular( 'service' ) ) {
        $css_file = ONDIGITAL_DIR . '/assets/css/pages/service-details.css';
        if ( file_exists( $css_file ) ) {
            wp_enqueue_style( 'ondigital-service-details', ONDIGITAL_URI . '/assets/css/pages/service-details.css', array( 'bootstrap' ), ONDIGITAL_VERSION );
        }
    }

    // Single Project
    if ( is_singular( 'project' ) ) {
        $css_file = ONDIGITAL_DIR . '/assets/css/pages/project-details.css';
        if ( file_exists( $css_file ) ) {
            wp_enqueue_style( 'ondigital-project-details', ONDIGITAL_URI . '/assets/css/pages/project-details.css', array( 'bootstrap' ), ONDIGITAL_VERSION );
        }
    }

    // 404
    if ( is_404() ) {
        $css_file = ONDIGITAL_DIR . '/assets/css/pages/404.css';
        if ( file_exists( $css_file ) ) {
            wp_enqueue_style( 'ondigital-404', ONDIGITAL_URI . '/assets/css/pages/404.css', array( 'bootstrap' ), ONDIGITAL_VERSION );
        }
        return;
    }

    // Fallback: if no page-specific CSS was loaded, use the corporate-agency (inner page) CSS
    if ( ! wp_style_is( 'ondigital-home' ) && ! wp_style_is( 'ondigital-about' ) && ! wp_style_is( 'ondigital-services' )
        && ! wp_style_is( 'ondigital-projects' ) && ! wp_style_is( 'ondigital-blog' ) && ! wp_style_is( 'ondigital-contact' )
        && ! wp_style_is( 'ondigital-faq' ) && ! wp_style_is( 'ondigital-team' ) && ! wp_style_is( 'ondigital-quote' )
        && ! wp_style_is( 'ondigital-blog-details' ) && ! wp_style_is( 'ondigital-service-details' )
        && ! wp_style_is( 'ondigital-project-details' ) && ! wp_style_is( 'ondigital-404' ) ) {
        wp_enqueue_style( 'ondigital-default', ONDIGITAL_URI . '/assets/css/global.css', array( 'bootstrap' ), ONDIGITAL_VERSION );
    }
}


// =============================================================================
// 2b. REMOVE WORDPRESS DEFAULT CSS (conflicts with Arolax theme)
// =============================================================================

add_action( 'wp_enqueue_scripts', 'ondigital_remove_wp_default_styles', 100 );
function ondigital_remove_wp_default_styles() {
    // Remove block library CSS (adds !important rules that override theme)
    wp_dequeue_style( 'wp-block-library' );
    wp_deregister_style( 'wp-block-library' );

    wp_dequeue_style( 'wp-block-library-theme' );
    wp_deregister_style( 'wp-block-library-theme' );

    // Remove classic theme styles
    wp_dequeue_style( 'classic-theme-styles' );
    wp_deregister_style( 'classic-theme-styles' );

    // Remove global styles (theme.json defaults that override colors, fonts, etc.)
    wp_dequeue_style( 'global-styles' );
    wp_deregister_style( 'global-styles' );

    // Remove core block inline styles
    wp_dequeue_style( 'core-block-supports' );
}

// Remove WP global styles and SVG filters (WordPress 6.x)
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );

// Remove emoji scripts and styles
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
add_filter( 'emoji_svg_url', '__return_false' );

// Remove img auto-sizes inline CSS
add_action( 'wp_enqueue_scripts', function() {
    wp_dequeue_style( 'wp-img-auto-sizes-contain' );
}, 100 );

// Completely block global styles inline CSS
add_filter( 'wp_theme_json_data_default', function( $theme_json ) {
    return class_exists( 'WP_Theme_JSON_Data' ) ? new WP_Theme_JSON_Data( array( 'version' => 3 ) ) : $theme_json;
} );

// Remove block editor styles from frontend
add_action( 'wp_print_styles', function() {
    wp_dequeue_style( 'global-styles' );
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'classic-theme-styles' );
}, 100 );

// =============================================================================
// 3. WIDGETS
// =============================================================================

add_action( 'widgets_init', 'ondigital_widgets_init' );
function ondigital_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Blog Sidebar', 'ondigital' ),
        'id'            => 'blog-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Column 1', 'ondigital' ),
        'id'            => 'footer-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Column 2', 'ondigital' ),
        'id'            => 'footer-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Column 3', 'ondigital' ),
        'id'            => 'footer-3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ) );
}


// =============================================================================
// 4. AUTO-UPDATES (ENABLED)
// =============================================================================

// Enable auto-updates for core
add_filter( 'allow_major_auto_core_updates', '__return_true' );
add_filter( 'allow_minor_auto_core_updates', '__return_true' );

// Enable auto-updates for plugins
add_filter( 'auto_update_plugin', '__return_true' );

// Enable auto-updates for themes
add_filter( 'auto_update_theme', '__return_true' );

// Enable auto-updates for translations
add_filter( 'auto_update_translation', '__return_true' );


// =============================================================================
// 5. SECURITY HARDENING
// =============================================================================

// Remove WordPress version from head and feeds
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );

// Remove version from enqueued styles and scripts
add_filter( 'style_loader_src', 'ondigital_remove_wp_version_strings', 9999 );
add_filter( 'script_loader_src', 'ondigital_remove_wp_version_strings', 9999 );
function ondigital_remove_wp_version_strings( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}

// Disable XML-RPC
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'wp_headers', 'ondigital_remove_x_pingback' );
function ondigital_remove_x_pingback( $headers ) {
    unset( $headers['X-Pingback'] );
    return $headers;
}

// Disable file editing in admin dashboard
if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
    define( 'DISALLOW_FILE_EDIT', true );
}

// Remove unnecessary head links
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );

// Disable REST API user enumeration for non-authenticated users
add_filter( 'rest_endpoints', 'ondigital_disable_user_enumeration_rest' );
function ondigital_disable_user_enumeration_rest( $endpoints ) {
    if ( ! is_user_logged_in() ) {
        if ( isset( $endpoints['/wp/v2/users'] ) ) {
            unset( $endpoints['/wp/v2/users'] );
        }
        if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
            unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
        }
    }
    return $endpoints;
}

// Block author archive enumeration
add_action( 'template_redirect', 'ondigital_block_author_enum' );
function ondigital_block_author_enum() {
    if ( is_author() && ! is_user_logged_in() ) {
        wp_safe_redirect( home_url(), 301 );
        exit;
    }
}

// Add security headers
add_action( 'send_headers', 'ondigital_security_headers' );
function ondigital_security_headers() {
    if ( ! is_admin() ) {
        header( 'X-Content-Type-Options: nosniff' );
        header( 'X-Frame-Options: SAMEORIGIN' );
        header( 'X-XSS-Protection: 1; mode=block' );
        header( 'Referrer-Policy: strict-origin-when-cross-origin' );
        header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()' );
    }
}

// Limit login attempts (basic)
add_filter( 'authenticate', 'ondigital_limit_login_attempts', 30, 3 );
function ondigital_limit_login_attempts( $user, $username, $password ) {
    if ( empty( $username ) ) {
        return $user;
    }

    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $transient_key = 'login_attempts_' . md5( $ip );
    $attempts = (int) get_transient( $transient_key );

    if ( $attempts >= 5 ) {
        return new WP_Error(
            'too_many_attempts',
            __( 'Too many login attempts. Please try again in 15 minutes.', 'ondigital' )
        );
    }

    // Increment on failed attempts
    if ( is_wp_error( $user ) ) {
        set_transient( $transient_key, $attempts + 1, 15 * MINUTE_IN_SECONDS );
    }

    return $user;
}

// Disable application passwords for non-admin users
add_filter( 'wp_is_application_passwords_available_for_user', 'ondigital_restrict_app_passwords', 10, 2 );
function ondigital_restrict_app_passwords( $available, $user ) {
    if ( ! user_can( $user, 'manage_options' ) ) {
        return false;
    }
    return $available;
}


// =============================================================================
// 6. CUSTOM POST TYPES
// =============================================================================

add_action( 'init', 'ondigital_register_post_types' );
function ondigital_register_post_types() {
    // Projects CPT
    register_post_type( 'project', array(
        'labels' => array(
            'name'               => __( 'Projects', 'ondigital' ),
            'singular_name'      => __( 'Project', 'ondigital' ),
            'add_new_item'       => __( 'Add New Project', 'ondigital' ),
            'edit_item'          => __( 'Edit Project', 'ondigital' ),
            'view_item'          => __( 'View Project', 'ondigital' ),
            'all_items'          => __( 'All Projects', 'ondigital' ),
            'search_items'       => __( 'Search Projects', 'ondigital' ),
            'not_found'          => __( 'No projects found.', 'ondigital' ),
        ),
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => array( 'slug' => 'layiheler' ),
        'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'menu_icon'    => 'dashicons-portfolio',
        'show_in_rest' => true,
    ) );

    // Services CPT
    register_post_type( 'service', array(
        'labels' => array(
            'name'               => __( 'Services', 'ondigital' ),
            'singular_name'      => __( 'Service', 'ondigital' ),
            'add_new_item'       => __( 'Add New Service', 'ondigital' ),
            'edit_item'          => __( 'Edit Service', 'ondigital' ),
            'view_item'          => __( 'View Service', 'ondigital' ),
            'all_items'          => __( 'All Services', 'ondigital' ),
            'search_items'       => __( 'Search Services', 'ondigital' ),
            'not_found'          => __( 'No services found.', 'ondigital' ),
        ),
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => array( 'slug' => 'xidmetler' ),
        'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
        'menu_icon'    => 'dashicons-admin-tools',
        'show_in_rest' => true,
    ) );

    // Team CPT
    register_post_type( 'team_member', array(
        'labels' => array(
            'name'               => __( 'Team', 'ondigital' ),
            'singular_name'      => __( 'Team Member', 'ondigital' ),
            'add_new_item'       => __( 'Add New Team Member', 'ondigital' ),
            'edit_item'          => __( 'Edit Team Member', 'ondigital' ),
            'view_item'          => __( 'View Team Member', 'ondigital' ),
            'all_items'          => __( 'All Team Members', 'ondigital' ),
        ),
        'public'       => true,
        'has_archive'  => false,
        'rewrite'      => array( 'slug' => 'komanda' ),
        'supports'     => array( 'title', 'editor', 'thumbnail' ),
        'menu_icon'    => 'dashicons-groups',
        'show_in_rest' => true,
    ) );
}

// Project Categories Taxonomy
add_action( 'init', 'ondigital_register_taxonomies' );
function ondigital_register_taxonomies() {
    register_taxonomy( 'project_category', 'project', array(
        'labels' => array(
            'name'          => __( 'Project Categories', 'ondigital' ),
            'singular_name' => __( 'Project Category', 'ondigital' ),
        ),
        'public'       => true,
        'hierarchical' => true,
        'rewrite'      => array( 'slug' => 'layihe-kateqoriya' ),
        'show_in_rest' => true,
    ) );
}


// =============================================================================
// 7. THEME CUSTOMIZER — moved to inc/customizer.php
// =============================================================================

// =============================================================================
// 8. HELPER FUNCTIONS — core helpers moved to inc/helpers.php
// =============================================================================

/**
 * Get social media links as array.
 */
function ondigital_get_social_links() {
    $socials = array( 'facebook', 'instagram', 'linkedin', 'tiktok', 'youtube', 'behance', 'pinterest' );
    $links = array();
    foreach ( $socials as $social ) {
        $url = ondigital_get_option( $social );
        if ( ! empty( $url ) ) {
            $links[ $social ] = $url;
        }
    }
    return $links;
}

/**
 * Sanitize SVG output.
 */
function ondigital_kses_svg( $svg ) {
    $allowed = array(
        'svg'  => array( 'class' => true, 'xmlns' => true, 'viewbox' => true, 'width' => true, 'height' => true, 'fill' => true ),
        'path' => array( 'd' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true ),
        'g'    => array( 'fill' => true, 'transform' => true ),
    );
    return wp_kses( $svg, $allowed );
}


// =============================================================================
// 9. EXCERPT CUSTOMIZATION
// =============================================================================

add_filter( 'excerpt_length', function() { return 25; } );
add_filter( 'excerpt_more', function() { return '...'; } );


// =============================================================================
// 10. DISABLE COMMENTS SITE-WIDE (optional — remove if you need comments)
// =============================================================================

add_action( 'admin_init', function() {
    // Redirect comments page
    global $pagenow;
    if ( $pagenow === 'edit-comments.php' ) {
        wp_safe_redirect( admin_url() );
        exit;
    }
    // Remove comments metabox from dashboard
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    // Disable support for comments on post types
    foreach ( get_post_types() as $post_type ) {
        if ( post_type_supports( $post_type, 'comments' ) ) {
            remove_post_type_support( $post_type, 'comments' );
            remove_post_type_support( $post_type, 'trackbacks' );
        }
    }
} );

add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );
add_filter( 'comments_array', '__return_empty_array', 10, 2 );

add_action( 'admin_menu', function() {
    remove_menu_page( 'edit-comments.php' );
} );

add_action( 'wp_before_admin_bar_render', function() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'comments' );
} );
