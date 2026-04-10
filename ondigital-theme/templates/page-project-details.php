<?php
/**
 * Template Name: Project Details
 *
 * @package OnDigital
 */

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
