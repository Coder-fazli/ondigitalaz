<?php
/**
 * Template Name: Quote Page
 *
 * @package OnDigital
 */

get_header();

// Section 1: Quote Form
get_template_part( 'template-parts/quote/form' );

// Section 2: CTA (shared)
get_template_part( 'template-parts/shared/cta' );

get_footer();
