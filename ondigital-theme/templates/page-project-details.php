<?php
/**
 * Template Name: Project Details
 *
 * @package OnDigital
 */

// Load global.css (needed for nav) + project CSS after it so .cs-wrap overrides content styles
add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'ondigital-default', get_template_directory_uri() . '/assets/css/global.css', array( 'bootstrap' ), '1.0.0' );
    wp_enqueue_style( 'ondigital-project-details-template', get_template_directory_uri() . '/assets/css/pages/project-details-template.css', array( 'ondigital-default' ), '1.0.3' );
    wp_enqueue_script( 'ondigital-project-details-template', get_template_directory_uri() . '/assets/js/pages/project-details-template.js', array( 'jquery' ), '1.0.3', true );
}, 99 );

get_header();
?>
<div class="cs-wrap">
    <?php get_template_part( 'template-parts/project-details/hero' ); ?>
    <?php get_template_part( 'template-parts/project-details/image' ); ?>
    <?php get_template_part( 'template-parts/project-details/results' ); ?>
    <?php get_template_part( 'template-parts/project-details/testimonial' ); ?>
    <?php get_template_part( 'template-parts/project-details/process' ); ?>
    <?php get_template_part( 'template-parts/project-details/gallery' ); ?>
</div>
<?php
get_footer();
