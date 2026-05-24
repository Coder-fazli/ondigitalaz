<?php
/**
 * Template Name: Services Page
 *
 * @package OnDigital
 */

get_header();

// Section 1: Hero
get_template_part( 'template-parts/services/hero' );

// Section 2: Partners/Clients Marquee (shared with projects page)
get_template_part( 'template-parts/projects/partners' );

// Section 3: Services Grid
get_template_part( 'template-parts/services/services-grid' );

// Section 4: About Content (shared)
get_template_part( 'template-parts/about/about-content' );

// Section 5: Clients (shared)
get_template_part( 'template-parts/about/clients' );

// Section 6: CTA (shared)
get_template_part( 'template-parts/shared/cta' );

get_footer();
