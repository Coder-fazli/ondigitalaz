<?php
/**
 * Template Name: Home Page
 *
 * @package OnDigital
 */

get_header();

// Section 1: Hero
get_template_part( 'template-parts/home/hero' );

// Section 2: Partners / Client logos
get_template_part( 'template-parts/home/partners' );

// Section 3: Features (4-column grid)
get_template_part( 'template-parts/home/features' );

// Section 4: About
get_template_part( 'template-parts/home/about' );

// Section 5: Services (dark bg)
get_template_part( 'template-parts/home/services' );

// Section 6: Report / Conversion
get_template_part( 'template-parts/home/report' );

// Section 7: Projects slider
get_template_part( 'template-parts/home/projects' );

// Section 8: Fun Facts / Stats counters
get_template_part( 'template-parts/home/stats' );

// Section 10: Testimonials
get_template_part( 'template-parts/home/testimonials' );

// Section 11: Team
get_template_part( 'template-parts/home/team' );

// Section 12: Blog
get_template_part( 'template-parts/home/blog' );

// Section 13: Text Slider / Marquee
get_template_part( 'template-parts/home/text-slider' );

// Section 14: CTA (shared)
get_template_part( 'template-parts/shared/cta' );

get_footer();
