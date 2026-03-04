<?php
/**
 * Template Name: About Page
 *
 * @package OnDigital
 */

get_header();

// Section 1: Hero
get_template_part( 'template-parts/about/hero' );

// Section 2: Counter
get_template_part( 'template-parts/about/counter' );

// Section 3: Awards / Who We Are
get_template_part( 'template-parts/about/awards' );

// Section 4: About Content
get_template_part( 'template-parts/about/about-content' );

// Section 5: Testimonials
get_template_part( 'template-parts/about/testimonials' );

// Section 6: FAQ
get_template_part( 'template-parts/about/faq' );

// Section 7: Clients
get_template_part( 'template-parts/about/clients' );

// Section 9: CTA (shared)
get_template_part( 'template-parts/shared/cta' );

get_footer();
