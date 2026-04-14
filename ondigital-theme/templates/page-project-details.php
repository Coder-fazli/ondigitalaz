<?php
/**
 * Template Name: Project Details
 *
 * @package OnDigital
 */

// Enqueue project CSS/JS — nav.css (global) already fixes progress-wrap and nav overrides
add_action( 'wp_enqueue_scripts', function() {
    // Force global.css — provides nav/header base styles (progress-wrap is constrained by nav.css)
    wp_enqueue_style( 'ondigital-default', get_template_directory_uri() . '/assets/css/global.css', array( 'bootstrap' ), '1.0' );
    // Project CSS loads after global so .cs-wrap styles override any conflicts
    wp_enqueue_style( 'ondigital-project-details-template', get_template_directory_uri() . '/assets/css/pages/project-details-template.css', array( 'ondigital-default' ), '1.0.7' );
    wp_enqueue_script( 'ondigital-project-details-template', get_template_directory_uri() . '/assets/js/pages/project-details-template.js', array( 'jquery' ), '1.0.7', true );
    // Dequeue meanmenu — it creates overlays that block scroll on this page
    wp_dequeue_script( 'meanmenu' );
}, 99 );

get_header();
?>
<style>
/* Kill ScrollSmoother + smooth scroll — normal browser scroll only */
html { scroll-behavior: auto !important; overflow: auto !important; height: auto !important; }
body { overflow: auto !important; height: auto !important; }
#smooth-wrapper, #smooth-content { overflow: visible !important; position: static !important; height: auto !important; transform: none !important; will-change: auto !important; }
</style>
<div class="cs-wrap">
    <?php get_template_part( 'template-parts/project-details/hero' ); ?>
    <?php get_template_part( 'template-parts/project-details/image' ); ?>
    <?php get_template_part( 'template-parts/project-details/results' ); ?>
    <?php get_template_part( 'template-parts/project-details/testimonial' ); ?>
    <?php get_template_part( 'template-parts/project-details/process' ); ?>
    <?php get_template_part( 'template-parts/project-details/gallery' ); ?>
    <?php get_template_part( 'template-parts/project-details/cta' ); ?>
</div>
<?php
get_footer();
