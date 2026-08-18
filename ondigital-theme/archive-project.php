<?php
/**
 * Projects archive template.
 *
 * @package OnDigital
 */

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style(
        'ondigital-projects-archive',
        get_template_directory_uri() . '/assets/css/components/projects-archive.css',
        array(),
        ondigital_asset_ver( '/assets/css/components/projects-archive.css' )
    );
}, 20 );

get_header(); ?>

<?php get_template_part( 'template-parts/projects/hero' ); ?>

<?php get_footer();
