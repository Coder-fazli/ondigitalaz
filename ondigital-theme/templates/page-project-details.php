<?php
/**
 * Template Name: Project Details
 *
 * @package OnDigital
 */

// Enqueue project CSS/JS — nav.css (global) already fixes progress-wrap and nav overrides
add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'ondigital-project-details-template', get_template_directory_uri() . '/assets/css/pages/project-details-template.css', array( 'bootstrap' ), '1.0.4' );
    wp_enqueue_script( 'ondigital-project-details-template', get_template_directory_uri() . '/assets/js/pages/project-details-template.js', array( 'jquery' ), '1.0.4', true );
    // Dequeue global.css fallback — nav.css handles what we need globally
    wp_dequeue_style( 'ondigital-default' );
    // Dequeue meanmenu — it creates overlays that block scroll on this page
    wp_dequeue_script( 'meanmenu' );
}, 99 );

get_header();
?>
<div class="cs-wrap">
    <?php get_template_part( 'template-parts/project-details/hero' ); ?>
    <?php get_template_part( 'template-parts/project-details/image' ); ?>
    <?php get_template_part( 'template-parts/project-details/results' ); ?>
    <?php get_template_part( 'template-parts/project-details/testimonial' ); ?>
    <?php get_template_part( 'template-parts/project-details/process' ); ?>
</div>
<?php
get_footer();
