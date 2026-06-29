<?php
/**
 * Template Name: Blog Page
 *
 * @package OnDigital
 */

// SEO meta title/description handled centrally in inc/seo.php (via Rank Math).

get_header();

// Section 1: Hero / Featured
get_template_part( 'template-parts/blog/hero' );

// Section 2: Featured Posts
get_template_part( 'template-parts/blog/featured-posts' );

// Section 3: Blog Grid with Pagination
get_template_part( 'template-parts/blog/grid' );

get_footer();
