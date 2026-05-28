<?php
/**
 * Template Name: Projects Page
 *
 * @package OnDigital
 */

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style(
        'ondigital-projects-archive',
        get_template_directory_uri() . '/assets/css/components/projects-archive.css',
        array(),
        ONDIGITAL_VERSION
    );
    // Logo cloud for partners section
    wp_enqueue_style( 'ondigital-logo-cloud', get_template_directory_uri() . '/assets/css/components/logo-cloud.css', array(), ONDIGITAL_VERSION );
    wp_enqueue_script( 'ondigital-logo-cloud', get_template_directory_uri() . '/assets/js/components/logo-cloud.js', array(), ONDIGITAL_VERSION, true );
}, 20 );

get_header();

// Section 1: Hero + Partners marquee + Work Grid
get_template_part( 'template-parts/projects/hero' );

// Section 2: CTA (shared) — wrapped so we can center it via CSS
echo '<div class="projects-page-cta">';
get_template_part( 'template-parts/shared/cta' );
echo '</div>';

get_footer();
