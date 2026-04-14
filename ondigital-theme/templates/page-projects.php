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
}, 20 );

get_header();

// Section 1: Hero + Work Grid
get_template_part( 'template-parts/projects/hero' );

// Section 2: CTA (shared)
get_template_part( 'template-parts/shared/cta' );

get_footer();
