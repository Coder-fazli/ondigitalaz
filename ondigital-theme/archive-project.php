<?php
/**
 * Projects archive template.
 *
 * @package OnDigital
 */

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style(
        'inter-font',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap',
        array(),
        null
    );
    wp_enqueue_style(
        'ondigital-projects-archive',
        get_template_directory_uri() . '/assets/css/components/projects-archive.css',
        array( 'inter-font' ),
        ONDIGITAL_VERSION
    );
}, 20 );

get_header(); ?>

<?php get_template_part( 'template-parts/projects/hero' ); ?>

<?php get_footer();
