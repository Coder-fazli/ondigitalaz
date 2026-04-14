<?php
/**
 * Enqueue Styles & Scripts
 *
 * @package OnDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// =============================================================================
// Global assets (every page)
// =============================================================================

add_action( 'wp_enqueue_scripts', 'ondigital_enqueue_assets' );
function ondigital_enqueue_assets() {

    // --- Google Fonts ---
    wp_enqueue_style( 'tasa-orbiter', 'https://fonts.googleapis.com/css2?family=TASA+Orbiter:wght@400;500;600;700;800;900&display=swap', array(), null );

    // --- Global Vendor CSS ---
    wp_enqueue_style( 'bootstrap',       ONDIGITAL_URI . '/assets/css/vendor/bootstrap.min.css',      array(),            '5.3.0' );
    wp_enqueue_style( 'fontawesome',     ONDIGITAL_URI . '/assets/css/vendor/all.min.css',             array(),            '6.5.0' );
    wp_enqueue_style( 'swiper',          ONDIGITAL_URI . '/assets/css/vendor/swiper-bundle.min.css',   array(),            '11.0.0' );
    wp_enqueue_style( 'progressbar',     ONDIGITAL_URI . '/assets/css/vendor/progressbar.css',         array(),            '1.0.0' );
    wp_enqueue_style( 'meanmenu',        ONDIGITAL_URI . '/assets/css/vendor/meanmenu.min.css',        array(),            '2.0.8' );
    wp_enqueue_style( 'magnific-popup',  ONDIGITAL_URI . '/assets/css/vendor/magnific-popup.css',      array(),            '1.1.0' );

    // --- Shared footer styles ---
    wp_enqueue_style( 'ondigital-footer', ONDIGITAL_URI . '/assets/css/footer.css', array( 'bootstrap' ), ONDIGITAL_VERSION );

    // --- Nav overrides (global, loaded last so it overrides compiled page CSS) ---
    wp_enqueue_style( 'ondigital-nav', ONDIGITAL_URI . '/assets/css/components/nav.css', array( 'bootstrap' ), ONDIGITAL_VERSION );

    // --- Page-specific CSS / JS ---
    ondigital_enqueue_page_assets();

    // --- Global Vendor JS ---
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap-bundle',    ONDIGITAL_URI . '/assets/js/vendor/bootstrap.bundle.min.js',   array( 'jquery' ),  '5.3.0',  true );
    wp_enqueue_script( 'gsap',                ONDIGITAL_URI . '/assets/js/vendor/gsap.min.js',               array(),            '3.12.0', true );
    wp_enqueue_script( 'gsap-scroll-trigger', ONDIGITAL_URI . '/assets/js/vendor/ScrollTrigger.min.js',      array( 'gsap' ),    '3.12.0', true );
    wp_enqueue_script( 'gsap-scroll-smoother',ONDIGITAL_URI . '/assets/js/vendor/ScrollSmoother.min.js',     array( 'gsap' ),    '3.12.0', true );
    wp_enqueue_script( 'gsap-scroll-to',      ONDIGITAL_URI . '/assets/js/vendor/ScrollToPlugin.min.js',     array( 'gsap' ),    '3.12.0', true );
    wp_enqueue_script( 'gsap-split-text',     ONDIGITAL_URI . '/assets/js/vendor/SplitText.min.js',          array( 'gsap' ),    '3.12.0', true );
    wp_enqueue_script( 'swiper',              ONDIGITAL_URI . '/assets/js/vendor/swiper-bundle.min.js',       array(),            '11.0.0', true );
    wp_enqueue_script( 'magnific-popup',      ONDIGITAL_URI . '/assets/js/vendor/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
    wp_enqueue_script( 'meanmenu',            ONDIGITAL_URI . '/assets/js/vendor/jquery.meanmenu.min.js',    array( 'jquery' ),  '2.0.8',  true );
    wp_enqueue_script( 'counter-up',          ONDIGITAL_URI . '/assets/js/vendor/counter.js',                array(),            '2.1.0',  true );
    wp_enqueue_script( 'progressbar-js',      ONDIGITAL_URI . '/assets/js/vendor/progressbar.js',            array( 'jquery' ),  '1.0.0',  true );
    wp_enqueue_script( 'lottie',              ONDIGITAL_URI . '/assets/js/vendor/lottie.min.js',             array(),            '5.12.2', true );

    // --- Global Theme JS ---
    wp_enqueue_script( 'ondigital-global', ONDIGITAL_URI . '/assets/js/global.js', array( 'jquery', 'gsap', 'bootstrap-bundle' ), ONDIGITAL_VERSION, true );

    wp_localize_script( 'ondigital-global', 'ondigital_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'ondigital_nonce' ),
        'site_url' => home_url( '/' ),
    ) );
}

// =============================================================================
// Per-page assets
// =============================================================================

function ondigital_enqueue_page_assets() {

    // Page templates → CSS/JS slug map
    $page_styles = array(
        'page-home.php'                => 'home',
        'page-about.php'               => 'about',
        'page-services.php'            => 'services',
        'page-service-details.php'     => 'service-details',
        'page-projects.php'            => 'projects',
        'page-project-details.php'     => 'project-details-template',
        'page-blog.php'                => 'blog',
        'page-contact.php'             => 'contact',
        'page-quote.php'               => 'quote',
        'page-faq.php'                 => 'faq',
        'page-team.php'                => 'team',
    );

    foreach ( $page_styles as $template => $slug ) {
        if ( ! is_page_template( 'templates/' . $template ) ) {
            continue;
        }

        $css = ONDIGITAL_DIR . '/assets/css/pages/' . $slug . '.css';
        if ( file_exists( $css ) ) {
            wp_enqueue_style( 'ondigital-' . $slug, ONDIGITAL_URI . '/assets/css/pages/' . $slug . '.css', array( 'bootstrap' ), ONDIGITAL_VERSION );
        }

        $js = ONDIGITAL_DIR . '/assets/js/pages/' . $slug . '.js';
        if ( file_exists( $js ) ) {
            wp_enqueue_script( 'ondigital-' . $slug, ONDIGITAL_URI . '/assets/js/pages/' . $slug . '.js', array( 'jquery', 'swiper', 'ondigital-global' ), ONDIGITAL_VERSION, true );
        }

        // Home page: component CSS overrides (loaded after home.css)
        if ( 'home' === $slug ) {
            wp_enqueue_style( 'ondigital-hero-redesign', ONDIGITAL_URI . '/assets/css/components/hero-redesign.css', array( 'ondigital-home' ), ONDIGITAL_VERSION );
            wp_enqueue_style( 'ondigital-counter',       ONDIGITAL_URI . '/assets/css/components/counter.css',       array( 'ondigital-home' ), ONDIGITAL_VERSION );
            wp_enqueue_style( 'ondigital-services-home', ONDIGITAL_URI . '/assets/css/components/services-home.css', array( 'ondigital-home' ), ONDIGITAL_VERSION );
            wp_enqueue_style( 'ondigital-blog-home',     ONDIGITAL_URI . '/assets/css/components/blog-home.css',     array( 'ondigital-home' ), ONDIGITAL_VERSION );
            wp_enqueue_style( 'ondigital-projects-home', ONDIGITAL_URI . '/assets/css/components/projects-home.css', array( 'ondigital-home' ), ONDIGITAL_VERSION );
            wp_enqueue_script( 'ondigital-hero-redesign', ONDIGITAL_URI . '/assets/js/components/hero-redesign.js', array(), ONDIGITAL_VERSION, true );
            wp_enqueue_style( 'ondigital-faq', ONDIGITAL_URI . '/assets/css/pages/faq.css', array( 'ondigital-home' ), ONDIGITAL_VERSION );
        }

        break;
    }

    // CPT archives
    if ( is_post_type_archive( 'service' ) ) {
        $css = ONDIGITAL_DIR . '/assets/css/pages/services.css';
        if ( file_exists( $css ) ) {
            wp_enqueue_style( 'ondigital-services', ONDIGITAL_URI . '/assets/css/pages/services.css', array( 'bootstrap' ), ONDIGITAL_VERSION );
        }
        $js = ONDIGITAL_DIR . '/assets/js/pages/services.js';
        if ( file_exists( $js ) ) {
            wp_enqueue_script( 'ondigital-services', ONDIGITAL_URI . '/assets/js/pages/services.js', array( 'jquery', 'swiper', 'ondigital-global' ), ONDIGITAL_VERSION, true );
        }
    }

    // Project archive CSS/JS is handled directly in archive-project.php

    // Single CPT posts
    if ( is_singular( 'post' ) ) {
        $css = ONDIGITAL_DIR . '/assets/css/pages/blog-details.css';
        if ( file_exists( $css ) ) {
            wp_enqueue_style( 'ondigital-blog-details', ONDIGITAL_URI . '/assets/css/pages/blog-details.css', array( 'bootstrap' ), ONDIGITAL_VERSION );
        }
        $js = ONDIGITAL_DIR . '/assets/js/pages/blog-details.js';
        if ( file_exists( $js ) ) {
            wp_enqueue_script( 'ondigital-blog-details', ONDIGITAL_URI . '/assets/js/pages/blog-details.js', array( 'bootstrap' ), ONDIGITAL_VERSION, true );
        }
    }

    if ( is_singular( 'service' ) ) {
        $css = ONDIGITAL_DIR . '/assets/css/pages/service-details.css';
        if ( file_exists( $css ) ) {
            wp_enqueue_style( 'ondigital-service-details', ONDIGITAL_URI . '/assets/css/pages/service-details.css', array( 'bootstrap' ), ONDIGITAL_VERSION );
        }
    }

    if ( is_singular( 'project' ) ) {
        $css = ONDIGITAL_DIR . '/assets/css/pages/project-details.css';
        if ( file_exists( $css ) ) {
            wp_enqueue_style( 'ondigital-project-details', ONDIGITAL_URI . '/assets/css/pages/project-details.css', array( 'bootstrap' ), ONDIGITAL_VERSION );
        }
    }

    if ( is_post_type_archive( 'od_glossary' ) || is_tax( 'glossary_cat' ) || is_singular( 'od_glossary' ) ) {
        wp_enqueue_style( 'roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap', array(), null );
        // Load full base theme CSS first (same as global.css fallback) so offcanvas/nav/preloader styles are present
        wp_enqueue_style( 'ondigital-default', ONDIGITAL_URI . '/assets/css/global.css', array( 'bootstrap' ), ONDIGITAL_VERSION );
        wp_enqueue_style( 'ondigital-glossary', ONDIGITAL_URI . '/assets/css/pages/glossary.css', array( 'ondigital-default' ), ONDIGITAL_VERSION );
        if ( is_singular( 'od_glossary' ) ) {
            wp_enqueue_style( 'ondigital-glossary-single', ONDIGITAL_URI . '/assets/css/pages/glossary-single.css', array( 'ondigital-glossary' ), ONDIGITAL_VERSION );
        }
    }

    // 404
    if ( is_404() ) {
        $css = ONDIGITAL_DIR . '/assets/css/pages/404.css';
        if ( file_exists( $css ) ) {
            wp_enqueue_style( 'ondigital-404', ONDIGITAL_URI . '/assets/css/pages/404.css', array( 'bootstrap' ), ONDIGITAL_VERSION );
        }
        return;
    }

    // Fallback for any page not matched above
    $loaded = array( 'ondigital-home', 'ondigital-about', 'ondigital-services', 'ondigital-projects',
                     'ondigital-blog', 'ondigital-contact', 'ondigital-faq', 'ondigital-team',
                     'ondigital-quote', 'ondigital-blog-details', 'ondigital-service-details',
                     'ondigital-project-details', 'ondigital-project-details-template', 'ondigital-404' );

    foreach ( $loaded as $handle ) {
        if ( wp_style_is( $handle ) ) {
            return;
        }
    }

    wp_enqueue_style( 'ondigital-default', ONDIGITAL_URI . '/assets/css/global.css', array( 'bootstrap' ), ONDIGITAL_VERSION );
}
