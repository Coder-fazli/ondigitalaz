<?php
/**
 * Template Name: Team Page
 *
 * @package OnDigital
 */

get_header();

// Section 1: Hero
get_template_part( 'template-parts/team/hero' );

// Section 2: Team Grid
get_template_part( 'template-parts/team/grid' );

// Section 3: Counter
get_template_part( 'template-parts/team/counter' );

// Section 4: Community / Culture
get_template_part( 'template-parts/team/community' );

// Section 5: CTA (shared)
get_template_part( 'template-parts/shared/cta' );

get_footer();
