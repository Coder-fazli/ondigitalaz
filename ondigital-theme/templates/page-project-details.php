<?php
/**
 * Template Name: Project Details
 *
 * @package OnDigital
 */

// Force-enqueue CSS/JS directly from the template — bypasses is_page_template() check
add_action( 'wp_head', function() {
    wp_enqueue_style( 'ondigital-project-details-template', get_template_directory_uri() . '/assets/css/pages/project-details-template.css', array( 'bootstrap' ), '1.0.1' );
}, 5 );
add_action( 'wp_footer', function() {
    wp_enqueue_script( 'ondigital-project-details-template', get_template_directory_uri() . '/assets/js/pages/project-details-template.js', array( 'jquery' ), '1.0.1', true );
}, 5 );

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
